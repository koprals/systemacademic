<?php
App::uses('AppHelper', 'View/Helper');

class AimfoxHelper extends AppHelper {

	public $helpers = array('Html');

	public function IsEmptyText($text)
	{
		$text	=	trim($text);
		if(empty($text))
			return "-";
		else
			return $text;
	}

	//Kamis, 09 Apr 2015 - 15.00 WIB
	public function convertToCentroTime($text = null) {


		$arrayHari = array(1 => 'Senin',2 => 'Selasa',3 => 'Rabu',4 => 'Kamis',5 => 'Jumat',6 => 'Sabtu',7 => 'Minggu');
		$arrayBulan = array(
			1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ags', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
		);

		if(empty($text)) {
			$date = new DateTime();
		} else {
			$date = new DateTime($text);
		}

		$timestamp = $date->getTimeStamp();

		$namaHari = $arrayHari[date('N', $timestamp)];
		$tanggalHari = date('d', $timestamp);
		$namaBulan = $arrayBulan[date('n', $timestamp)];

		return $namaHari.", ".$tanggalHari." ".$namaBulan." ".date('Y - H.i', $timestamp)." WIB";
	}
}
