<?php
class ImportShell extends AppShell {

    public function passcode() {
      $startTime = microtime(true);

      //cari dulu apakah ada file yang belum di import.
      $this->out(ROOT."/contents/importFiles/1");

      $this->loadModel('ImportFile');
      $importFiles = $this->ImportFile->find('all', array(
        'conditions' => array(
          'ImportFile.finish' => 0,
          'ImportFile.import_file_type_id' => 1//passcode
        ),
        'order' => array('ImportFile.created desc')
      ));

      set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
      App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));

      foreach($importFiles as $importFile) {
        $this->out('start to import file : '.$importFile['ImportFile']['filename']);
        $inputFileName = APP."webroot".DS."contents".DS."importFiles".DS."1".DS.$importFile['ImportFile']['filename'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $this->out("total line : ".count($sheetData));

        $this->ImportFile->id = $importFile['ImportFile']['id'];
        $saveField = $this->ImportFile->saveField('total_line', count($sheetData));

        if($saveField) {
          $this->out("Saving total_line to DB");
        }

        $this->loadModel('Passcode');
        if($importFile['ImportFile']['last_line'] < count($sheetData)) {

          if($importFile['ImportFile']['last_line'] == 0) {
            $startLine = 1;
          } else {
            $startLine = $importFile['ImportFile']['last_line'];
          }

          for($ctr = $startLine; $ctr <= count($sheetData); $ctr++) {

            $passcode = $sheetData[$ctr]['A'];
            $this->out($passcode);

            if(isset($passcode) && $passcode != "Passcode") {
              $data = $this->Passcode->find('first', array(
                'conditions' => array(
                  'Passcode.passcode' => $passcode
                )
              ));

              if($data == false) {
                //$this->out($passcode);
                $savePasscode['Passcode'] = array(
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
                $this->out($passcode.' ===== passcode already exist');
              }
            }

            $this->ImportFile->saveField('last_line', $ctr);
            $this->out('Save last line is '.$ctr);

          }
        } else {

          $this->ImportFile->saveField('finish', 1);
          $this->out('Finish import');
        }

      }

      /*
      $this->loadModel('Passcode');
      set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
      App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));
      $inputFileName = '/Library/WebServer/Documents/amaya-004-hsbc/app/webroot/passcodes.xlsx';
      $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
      $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

      $this->out("total line : ".count($sheetData));

      foreach($sheetData as $data) {
        $passcode = $data['A'];

        if(isset($passcode) && $passcode != "Passcode") {
          $data = $this->Passcode->find('first', array(
            'conditions' => array(
              'Passcode.passcode' => $passcode
            )
          ));

          if($data == false) {
            //$this->out($passcode);
          } else {
            //$this->out('===== passcode already exist');
          }

        }

      }

      $duration = microtime(true)-$startTime;
      $hours = (int)($duration/60/60);
      $minutes = (int)($duration/60)-$hours*60;
      $seconds = (int)$duration-$hours*60*60-$minutes*60;

      $this->out('Exec time: '.$seconds);
      */

      $duration = microtime(true)-$startTime;
      $hours = (int)($duration/60/60);
      $minutes = (int)($duration/60)-$hours*60;
      $seconds = (int)$duration-$hours*60*60-$minutes*60;

      $this->out('Exec time: '.$seconds);
    }


}
