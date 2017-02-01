<?php
class ImportPointShell extends AppShell {

    public function test() {
      $cronFileName = ROOT . DS . "app" . DS . "tmp" . DS . "point.txt";
      if(!is_file($cronFileName)) {
        $content = "0";
        $fp = fopen($cronFileName,"wb");
        fwrite($fp,$content);
        fclose($fp);
      }

      $contentCronFile = file_get_contents($cronFileName);

      if(trim($contentCronFile) == "0") {
        $this->out('zero');

        $content = "1";
        $fp = fopen($cronFileName,"wb");
        fwrite($fp,$content);
        fclose($fp);

      } else {
        exit;
        $this->out('not zero');
      }

    }

    public function point() {

      //check apakah file nya 1 atau 0, kalau 0 ubah dulu jadi satu trus jalan. kalo 1 exit;
      $cronFileName = ROOT . DS . "app" . DS . "tmp" . DS . "point.txt";
      if(!is_file($cronFileName)) {
        $content = "0";
        $fp = fopen($cronFileName,"wb");
        fwrite($fp,$content);
        fclose($fp);
      }

      $contentCronFile = file_get_contents($cronFileName);

      if(trim($contentCronFile) == "0") {
        $content = "1";
        $fp = fopen($cronFileName,"wb");
        fwrite($fp,$content);
        fclose($fp);
      } else {
        //karena cron nya lagi jalan di tempat lain
        exit;
      }


      $startTime = microtime(true);

      $this->loadModel('PointFile');
      $pointFiles = $this->PointFile->find('all', array(
        'conditions' => array(
          'PointFile.finished' => 0,
          'PointFile.started' => 0,
          'PointFile.status' => 0//passcode
        ),
        'order' => array('PointFile.id asc')
      ));

      $this->out(print_r($pointFiles));

      set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
      App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));

      //kalo ada files nya baru kita berusan dengan import2an ya.
      foreach($pointFiles as $pointFile) {
        $inputFileName = ROOT . DS . "app" . DS . "webroot" . DS . $pointFile['PointFile']['url'] . $pointFile['PointFile']['file_name'];
        $this->out($inputFileName);
        if(is_file($inputFileName)) {
          $this->out('ada file nya');

          $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
          $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
          $this->out("total line : ".count($sheetData));

          $this->out(print_r($sheetData));

          $this->out('start import stuff');

          $this->PointFile->id = $pointFile['PointFile']['id'];
          $saveField = $this->PointFile->saveField('file_rows', count($sheetData));
          $saveField = $this->PointFile->saveField('started', 1);
          $saveField = $this->PointFile->saveField('start_process_time', date("Y-m-d H:i:s"));

          if($saveField) {

            $this->loadModel('Point');
            if($pointFile['PointFile']['last_line'] < count($sheetData)) {

              if($pointFile['PointFile']['last_line'] == 0) {
                $startLine = 1;
              } else {
                $startLine = $pointFile['PointFile']['last_line'];
              }

              for($ctr = $startLine; $ctr <= count($sheetData); $ctr++) {

                $passcode = trim(strtoupper($sheetData[$ctr]['A']));
                $this->out($passcode);

                if(isset($passcode) && $passcode != "PASSCODE") {

                  if(!empty($passcode)) {
                    $data = $this->Point->find('first', array(
                      'conditions' => array(
                        'Point.cardno' => trim($sheetData[$ctr]['A']),
                        'Point.point_file_id' => $pointFile['PointFile']['id'],
                        'Point.passcode' => $passcode
                      )
                    ));
                  } else {

                    //cari dulu dari passcode cardno tertentu
                    $this->loadModel('Passcode');
                    $dataPasscode = $this->Passcode->find('first', array(
                      'conditions' => array(
                        'Passcode.cardno' => trim($sheetData[$ctr]['B']),
                      )
                    ));

                    if($dataPasscode != false) {
                      $passcode = $dataPasscode['Passcode']['passcode'];
                      $data = $this->Point->find('first', array(
                        'conditions' => array(
                          'Point.cardno' => trim($sheetData[$ctr]['A']),
                          'Point.point_file_id' => $pointFile['PointFile']['id'],
                          'Point.passcode' => $passcode
                        )
                      ));
                    }
                  }



                  if($data == false && $passcode != "") { // ini kalo passcode nya bukan empty boy. kalau passcodenya empty berarti belum ada di database
                    //$this->out($passcode);
                    $savePoint['Point'] = array(
                      'passcode' => $passcode,
                      'point_file_id' => $pointFile['PointFile']['id'],
                      'cardno' => trim($sheetData[$ctr]['B']),
                      'spending_garuda_online' => trim($sheetData[$ctr]['C']),
                      'spending_supporting_merchant' => trim($sheetData[$ctr]['D']),
                      'spending_hat' => trim($sheetData[$ctr]['E']),
                      'spending_online' => trim($sheetData[$ctr]['F']),
                      'point' => trim($sheetData[$ctr]['G']),
                      'status'  =>  1,
                    );

                    $this->Point->create();
                    $this->Point->set($savePoint);
                    $this->Point->save($savePoint);

                    //harus nambain ke point log nih..
                    $this->loadModel('PointLog');

        						$pointLog = $this->PointLog->find('all', array(
        							'conditions' => array(
        								'PointLog.passcode' => $passcode,
        								'PointLog.point_log_type_id' => 2, //untuk Import Point
                        'PointLog.point_id' => $this->Point->id,
        								'PointLog.status' => 1
        							)
        						));

                    if($pointLog == false) {
                      $savePointLog['PointLog'] = array(
                        'passcode' => $passcode,
                        'point_id' => $this->Point->id,
                        'point_log_type_id' => 2,
                        'status' => 1,
                        'point' => trim($sheetData[$ctr]['G']),
                        'date' => date('Y-m-d')
                      );

                      $this->PointLog->create();
                      $this->PointLog->set($savePointLog);
                      $this->PointLog->save($savePointLog);

                    }

                    $this->out($passcode.' has been added to DB');

                  } else {
                    if($passcode == "") { // berarti belum ada di database

                      $this->loadModel('ErrorPointFileLog');
                      $this->ErrorPointFileLog->create();

                      $dataError = "passcode is not in the database or cannot find passcode from the card number";

                      $errorData['ErrorPointFileLog'] = array(
                        'point_file_id' => $pointFile['PointFile']['id'],
                        'line_number' => $ctr,
                        'data' => $dataError
                      );

                      $this->ErrorPointFileLog->save($errorData);
                      $this->out('data already exist');

                    } else {
                      //berarti datanya sudah ada di database gan, untuk upload file yang sama
                      $this->loadModel('ErrorPointFileLog');
                      $this->ErrorPointFileLog->create();

                      $dataError = "Data already exist, \n\n Cardno = ".$sheetData[$ctr]['B']."\nCustNo =".$sheetData[$ctr]['B']."\line = ".$ctr."\npasscode = ".$passcode;

                      $errorData['ErrorPointFileLog'] = array(
                        'point_file_id' => $pointFile['PointFile']['id'],
                        'line_number' => $ctr,
                        'data' => $dataError
                      );

                      $this->ErrorPointFileLog->save($errorData);
                      $this->out('data already exist');
                    }
                  }
                } else {
                  //ini tau deh ga ke urus gitu
                  $this->loadModel('ErrorPointFileLog');
                  $this->ErrorPointFileLog->create();

                  $dataError = "passcode is not detected";

                  $errorData['ErrorPointFileLog'] = array(
                    'point_file_id' => $pointFile['PointFile']['id'],
                    'line_number' => $ctr,
                    'data' => $dataError
                  );

                  $this->ErrorPointFileLog->save($errorData);
                  $this->out('data already exist');
                }

                $this->PointFile->saveField('last_line', $ctr);
                $this->out('Save last line is '.$ctr);

                if($ctr == count($sheetData)) {
                  $this->PointFile->saveField('finished', 1);
                  $this->PointFile->saveField('finished_time', date('Y-m-d H:i:s'));
                  $this->PointFile->saveField('status', 1);
                  $this->out('Finish import');
                }

              }
            }

          } else {
            $this->out('cannot start import');
          }

        } else {
          // ga usah di urus
          $this->out('tak ada file nya');
        }
      }

      $duration = microtime(true)-$startTime;
      $hours = (int)($duration/60/60);
      $minutes = (int)($duration/60)-$hours*60;
      $seconds = (int)$duration-$hours*60*60-$minutes*60;

      //biar bisa di jalanin cron lainnya.
      $content = "0";
      $fp = fopen($cronFileName,"wb");
      fwrite($fp,$content);
      fclose($fp);

      $this->out('Exec time: '.$seconds);
    }


}
