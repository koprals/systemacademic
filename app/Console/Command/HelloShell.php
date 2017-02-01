<?php
class HelloShell extends AppShell {
    public function main() {
      $startTime = microtime(true);
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

    }


}
