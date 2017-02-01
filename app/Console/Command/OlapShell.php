<?php
class OlapShell extends AppShell {
	
	public function main() {
		$this->out('Start Olap');
		
		$ts = 1298826000;
		$t = explode('/', strftime('%M/%H/%w/%d/%j/%m/%Y', $ts));
		$inputarr = array(
			'id'         => $ts,
			'Minute'     => $t[0],
			'Hour'       => $t[1],
			'DayOfWeek'  => $t[2],
			'DayOfMonth' => $t[3],
			'DayOfYear'  => $t[4],
			'Month'      => $t[5],
			'Quarter'    => ceil($t[5] / 4),
			'Year'       => $t[6],
			'Holiday'    => (in_array($t[2], array(0, 6))),
			'Weekend'    => (in_array($t[2], array(0, 6)))
		);
		
		$this->out($inputarr);
		
		/*
		//cari awal minggu ini, dan hasilnya nanti di delete semua
		$newTs = mktime(0, 0, 0, 2, 26, 2014);
		list($d, $w, $m, $y) = explode('-', date('d-w-m-Y', $newTs));
		$days_since_fdow = (0 < $w) ? ($w-1) : 6;
		$ts = mktime(0, 0, 0, $m, $d, $y) - ($days_since_fdow * 86400);
		
		$this->out($days_since_fdow);
		*/
	}
	
	
	public function createTimeDimension() {
		$this->out("helo");
		
		$this->loadModel('OlapTimeDimension');
		
		$month = date("n");
		$day = date("j");
		$year = date("Y");
		$minute = 0;
		
		$ts = mktime(0,$minute,0,$month,$day,$year);
		$t 	= explode('/', strftime('%M/%H/%w/%d/%j/%m/%Y', $ts));
		$inputarr['OlapTimeDimension'] = array(
			'id'         => $ts,
			'Minute'     => $t[0],
			'Hour'       => $t[1],
			'DayOfWeek'  => $t[2],
			'DayOfMonth' => $t[3],
			'DayOfYear'  => $t[4],
			'Month'      => $t[5],
			'Quarter'    => ceil($t[5] / 4),
			'Year'       => $t[6],
			'Holiday'    => (in_array($t[2], array(0, 6))),
			'Weekend'    => (in_array($t[2], array(0, 6)))
		);
		
		$count = $this->OlapTimeDimension->find('count', array(
			'conditions' => array(
				'OlapTimeDimension.DayOfMonth' =>  $inputarr['OlapTimeDimension']['DayOfMonth'],
				'OlapTimeDimension.Month' =>  $inputarr['OlapTimeDimension']['Month'],
				'OlapTimeDimension.Year' =>  $inputarr['OlapTimeDimension']['Year'],
			)
		));
		
		if($count == 0) {
			$this->out('menjalankan perulangan hari');
			
			$tempDayOfYear = $inputarr['OlapTimeDimension']['DayOfYear'];
			while($tempDayOfYear == $inputarr['OlapTimeDimension']['DayOfYear']) {
				
				$ts = mktime(0,$minute,0,$month,$day,$year);
				$t 	= explode('/', strftime('%M/%H/%w/%d/%j/%m/%Y', $ts));
				$inputarr['OlapTimeDimension'] = array(
					'id'         => $ts,
					'Minute'     => $t[0],
					'Hour'       => $t[1],
					'DayOfWeek'  => $t[2],
					'DayOfMonth' => $t[3],
					'DayOfYear'  => $t[4],
					'Month'      => $t[5],
					'Quarter'    => ceil($t[5] / 4),
					'Year'       => $t[6],
					'Holiday'    => (in_array($t[2], array(0, 6))),
					'Weekend'    => (in_array($t[2], array(0, 6)))
				);
				
				if($tempDayOfYear == $inputarr['OlapTimeDimension']['DayOfYear']) {
					$this->OlapTimeDimension->set($inputarr);
					$this->OlapTimeDimension->create();
					$this->OlapTimeDimension->save($inputarr);
					
					$minute += 5;
					
					$this->out("menyimpan id ".$inputarr['OlapTimeDimension']['id']);
				}
				
			};
			
		}
	}
	
	public function generateDaily() {
		$this->loadModel('ScheduleVenueBrand');
		$this->ScheduleVenueBrand->BindBrand(false);
		
		$this->ScheduleVenueBrand->ScheduleVenue->unbindModel(array(
			'hasMany' => array(
				'ScheduleVenueBrand'
			)
		));
		
		$this->out('start generate');
		
		$brands = $this->ScheduleVenueBrand->Brand->find('list', array(
			'conditions' => array(
			)
		));
		
		$data = $this->ScheduleVenueBrand->find('all', array(
			'conditions' => array(
				'DAY(ScheduleVenueBrand.created)' => "13",
				'MONTH(ScheduleVenueBrand.created)' => "2",
				'YEAR(ScheduleVenueBrand.created)' => "2014",
				'ScheduleVenueBrand.brand_id'		=>	1,
				
			),
			'order' => array('ScheduleVenueBrand.created asc'),
			'recursive'	=>	3
		));
		var_dump($data);
	}
	
}