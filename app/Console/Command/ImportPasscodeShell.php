<?php
class ImportPasscodeShell extends AppShell {

    public function passcode() {
      $startTime = microtime(true);

      //cari dulu apakah ada file yang belum di import.
      $this->out(ROOT."/contents/importFiles/1");

      $this->loadModel('PasscodeFile');
      $passcodeFiles = $this->PasscodeFile->find('all', array(
        'conditions' => array(
          'PasscodeFile.finished' => 0,
          'PasscodeFile.started' => 0,
          'PasscodeFile.status' => 0//passcode
        ),
        'order' => array('PasscodeFile.id asc')
      ));

      $this->out(print_r($passcodeFiles));

      set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
      App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));

      //kalo ada files nya baru kita berusan dengan import2an ya.
      foreach($passcodeFiles as $passcodeFile) {
        $inputFileName = ROOT . DS . "app" . DS . "webroot" . DS . $passcodeFile['PasscodeFile']['url'] . $passcodeFile['PasscodeFile']['file_name'];
        $this->out($inputFileName);
        if(is_file($inputFileName)) {
          $this->out('ada file nya');

          $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
          $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
          $this->out("total line : ".count($sheetData));

          $this->out(print_r($sheetData));

          $this->out('start import stuff');

          $this->PasscodeFile->id = $passcodeFile['PasscodeFile']['id'];
          $saveField = $this->PasscodeFile->saveField('file_rows', count($sheetData));
          $saveField = $this->PasscodeFile->saveField('started', 1);
          $saveField = $this->PasscodeFile->saveField('start_process_time', date("Y-m-d H:i:s"));

          if($saveField) {

            $this->loadModel('Passcode');
            if($passcodeFile['PasscodeFile']['last_line'] < count($sheetData)) {

              if($passcodeFile['PasscodeFile']['last_line'] == 0) {
                $startLine = 1;
              } else {
                $startLine = $passcodeFile['PasscodeFile']['last_line'];
              }

              for($ctr = $startLine; $ctr <= count($sheetData); $ctr++) {

                $passcode = trim(strtoupper($sheetData[$ctr]['E']));
                $this->out($passcode);

                if(isset($passcode) && $passcode != "PASSCODE" && !empty($passcode)) {

                  $data = $this->Passcode->find('first', array(
                    'conditions' => array(
                      'Passcode.cardno' => trim($sheetData[$ctr]['A']),
                      'Passcode.custno' => trim($sheetData[$ctr]['B']),
                      'Passcode.passcode' => $passcode
                    )
                  ));

                  if($data == false) {
                    //$this->out($passcode);
                    $savePasscode['Passcode'] = array(
                      'cardno' => trim($sheetData[$ctr]['A']),
                      'custno' => trim($sheetData[$ctr]['B']),
                      'mobile_phone' => trim($sheetData[$ctr]['C']),
                      'dob' => trim($sheetData[$ctr]['D']),
                      'passcode' => $passcode,
                      'status'  =>  1,
                      'is_active' => 0,
                      'user_id' => 0
                    );

                    $this->Passcode->create();
                    $this->Passcode->set($savePasscode);
                    $this->Passcode->save($savePasscode);

                    $this->out($passcode.' has been added to DB');

                  } else {

                    $this->loadModel('ErrorPasscodeFileLog');
                    $this->ErrorPasscodeFileLog->create();

                    $dataError = "Data already exist, \n\n Cardno = ".$sheetData[$ctr]['A']."\nCustNo =".$sheetData[$ctr]['B']."\nmobile_phone = ".$sheetData[$ctr]['C']."\ndob =".$sheetData[$ctr]['D']."\npasscode = ".$passcode;

                    $errorData['ErrorPasscodeFileLog'] = array(
                      'passcode_file_id' => $passcodeFile['PasscodeFile']['id'],
                      'line_number' => $ctr,
                      'data' => $dataError
                    );

                    $this->ErrorPasscodeFileLog->save($errorData);

                    $this->out($passcode.' ===== passcode already exist');
                  }
                } else {
                  if($passcode == "") {
                    $this->loadModel('ErrorPasscodeFileLog');
                    $this->ErrorPasscodeFileLog->create();

                    $errorData['ErrorPasscodeFileLog'] = array(
                      'passcode_file_id' => $passcodeFile['PasscodeFile']['id'],
                      'line_number' => $ctr,
                      'data' => "No passcode available"
                    );

                    $this->ErrorPasscodeFileLog->save($errorData);
                  }
                }

                $this->PasscodeFile->saveField('last_line', $ctr);
                $this->out('Save last line is '.$ctr);

                if($ctr == count($sheetData)) {
                  $this->PasscodeFile->saveField('finished', 1);
                  $this->PasscodeFile->saveField('finished_time', date('Y-m-d H:i:s'));
                  $this->PasscodeFile->saveField('status', 1);
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
