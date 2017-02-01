<?php
class ImportEstatementShell extends AppShell {

    public function estatement() {
      $startTime = microtime(true);

      //cari dulu apakah ada file yang belum di import.
      $this->out(ROOT."/contents/importFiles/1");

      $this->loadModel('EstatementFile');
      $estatementFiles = $this->EstatementFile->find('all', array(
        'conditions' => array(
          'EstatementFile.finished' => 0,
          'EstatementFile.started' => 0,
          'EstatementFile.status' => 0//passcode
        ),
        'order' => array('EstatementFile.id asc')
      ));

      //$this->out(print_r($passcodeFiles));

      set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
      App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));

      //kalo ada files nya baru kita berusan dengan import2an ya.
      foreach($estatementFiles as $estatementFile) {
        $inputFileName = ROOT . DS . "app" . DS . "webroot" . DS . $estatementFile['EstatementFile']['url'] . $estatementFile['EstatementFile']['file_name'];
        $this->out($inputFileName);
        if(is_file($inputFileName)) {
          $this->out('ada file nya');

          $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
          $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
          $this->out("total line : ".count($sheetData));

          $this->out(print_r($sheetData));

          $this->out('start import stuff');

          $this->EstatementFile->id = $estatementFile['EstatementFile']['id'];
          $saveField = $this->EstatementFile->saveField('file_rows', count($sheetData));
          $saveField = $this->EstatementFile->saveField('started', 1);
          $saveField = $this->EstatementFile->saveField('start_process_time', date("Y-m-d H:i:s"));

          if($saveField) {

            $this->loadModel('Estatement');
            if($estatementFile['EstatementFile']['last_line'] < count($sheetData)) {

              if($estatementFile['EstatementFile']['last_line'] == 0) {
                $startLine = 1;
              } else {
                $startLine = $estatementFile['EstatementFile']['last_line'];
              }

              for($ctr = $startLine; $ctr <= count($sheetData); $ctr++) {

                $estatement = trim(strtoupper($sheetData[$ctr]['A']));
                $this->out($sheetData[$ctr]['A']);

                if(isset($sheetData[$ctr]['A']) && !empty($sheetData[$ctr]['A']) || $ctr != 1) {

                  //cek dulu apakah passcode sudah pernah ada atau belum
                  $data = $this->Estatement->find('first', array(
                    'conditions' => array(
                      'Estatement.passcode' => trim($sheetData[$ctr]['A']),
                    )
                  ));

                  if($data == false) {
                    //$this->out($passcode);
                    $saveEstatement['Estatement'] = array(
                      'passcode' => trim($sheetData[$ctr]['A']),
                      'cardno' => trim($sheetData[$ctr]['B']),
                      'email' => trim($sheetData[$ctr]['C']),
                      'points' => trim($sheetData[$ctr]['D']),
                    );

                    $this->Estatement->create();
                    $this->Estatement->set($saveEstatement);
                    $this->Estatement->save($saveEstatement);

                    // baru di tambain ke point log nya nih.
                    //cek dulu apakah point log untuk passcode sudah ada atau belum$this->loadModel('PointLog');
                    $this->loadModel('PointLog');
        						$pointLog = $this->PointLog->find('all', array(
        							'conditions' => array(
        								'PointLog.passcode' => trim($sheetData[$ctr]['A']),
        								'PointLog.point_log_type_id' => 3, //untuk Estatment subscriber,
        								'PointLog.status' => 1
        							)
        						));

                    if($pointLog == false) {
                      $savePointLog['PointLog'] = array(
                        'passcode' => trim($sheetData[$ctr]['A']),
                        'point_log_type_id' => 3,
                        'status' => 1,
                        'point' => trim($sheetData[$ctr]['D']),
                        'date' => date('Y-m-d')
                      );

                      $this->PointLog->create();
                      $this->PointLog->set($savePointLog);
                      $this->PointLog->save($savePointLog);

                    }

                    $this->out($sheetData[$ctr]['A'].' has been added to DB');

                  } else {

                    $this->loadModel('ErrorEstatementFileLog');
                    $this->ErrorEstatementFileLog->create();

                    $dataError = "Data already exist, \n\n Passcode = ".$sheetData[$ctr]['A']."\nCardno =".$sheetData[$ctr]['B']."\nemail = ".$sheetData[$ctr]['C']."\npoint =".$sheetData[$ctr]['D'];

                    $errorData['ErrorEstatementFileLog'] = array(
                      'estatment_file_id' => $estatementFile['EstatementFile']['id'],
                      'line_number' => $ctr,
                      'data' => $dataError
                    );

                    $this->ErrorEstatementFileLog->save($errorData);

                    $this->out($sheetData[$ctr]['A'].' ===== passcode already exist');
                  }
                } else {
                  if($passcode == "") {
                    $this->loadModel('ErrorEstatementFileLog');
                    $this->ErrorEstatementFileLog->create();

                    $errorData['ErrorEstatementFileLog'] = array(
                      'estatement_file_id' => $estatementFile['EstatementFile']['id'],
                      'line_number' => $ctr,
                      'data' => "No passcode available"
                    );

                    $this->ErrorEstatementFileLog->save($errorData);
                  }
                }

                $this->EstatementFile->saveField('last_line', $ctr);
                $this->out('Save last line is '.$ctr);

                if($ctr == count($sheetData)) {
                  $this->EstatementFile->saveField('finished', 1);
                  $this->EstatementFile->saveField('finished_time', date('Y-m-d H:i:s'));
                  $this->EstatementFile->saveField('status', 1);
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

      $this->out('Exec time: '.$seconds);
    }


}
