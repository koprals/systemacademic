<?php
header("Access-Control-Allow-Origin: *");
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ApiController extends AppController
{
	public $uses	=	NULL;
	public $settings;
	public $components = array("General", "RequestHandler");
	public $gamePlayPerDay = 3;
	public $pointPerGame = 10;
	public $validToken = true;

	public function beforeFilter()
	{
		define("ERR_00","Success");
		define("ERR_01","Wrong username or password");
		define("ERR_02","Data not found");
		define("ERR_03","Validate Failed");
		define("ERR_04","Parameter Not Completed!");
		define("ERR_05","Failed send verification code!");
		define("ERR_06","Play quota is empty, please play again tomorow");
		define("ERR_07","Cannot update point log, please try again");
		define("ERR_08","Session hash doesn't match");
		$token		=	(isset($_REQUEST['token'])) ? $_REQUEST['token'] : "";

		if($token !== "461fd77b-1f04-4cf9-a045-49fb07435913")
		{
			$data = array("status"=>false,"message"=>"Invalid Token","data"=>$_REQUEST,"code"=>"01");
			$this->set('data', $data);
      $this->set('_serialize', array('data'));
			$this->validToken = false;
		}

		//SETTING
		if(isset($_REQUEST['debug']) && $_REQUEST['debug'] == "1") {
			$this->loadModel("Setting");
			$settings		=	$this->Setting->find("first");
			Cache::write('settings', $settings, 'short');
		} else {
			$settings = Cache::read('settings', 'short');
			if(!$settings) {
				$this->loadModel("Setting");
				$settings		=	$this->Setting->find("first");
				Cache::write('settings', $settings, 'short');
			}
		}
		$this->settings		=	$settings["Setting"];
	}

	/**
		REQUEST
		cookieValue : diambil dari cookie userLoginWeb
	**/

	public function getLoginStatus() {
		//icelebratefood[userLoginWeb]	q5Xe5NDV7MLD7sXLsZWi4M7D4s2Q3NDP	.www.icelebratefood.com	/	June 2, 2015 at 9:19:34 AM GMT+7	60 B	✓

		if($this->validToken) {
			if(isset($_REQUEST['cookieValue']) && $_REQUEST['cookieValue'] != "") {

				$profile = $this->CheckProfileWithHash($_REQUEST['cookieValue']);
				if($profile != false) {

					$hash['user_id'] = $profile['User']['id'];
					$hash['user_session_hash'] = $this->General->my_encrypt($profile['User']['id']."|".$profile['User']['passcode']."|".$profile['User']['email']);

					$data = array("status"=>true,"message"=>ERR_00,"data"=>$hash,"code"=>"00");
					$this->set('data', $data);
					$this->set('_serialize', array('data'));
				} else {
					$data = array("status"=>false,"message"=>ERR_03,"data"=>NULL,"code"=>"03");
					$this->set('data', $data);
					$this->set('_serialize', array('data'));
				}

			} else {
				$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"02");
				$this->set('data', $data);
				$this->set('_serialize', array('data'));
			}
		}
	}

	public function getProfile() {
		if($this->validToken) {
			//q5XeqpKTqpOUq5OVrd3N6NTV2sLX3cqaraHJ5sLL5Y\/F6M4=
			if((isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") && (isset($_REQUEST['user_session_hash']) && $_REQUEST['user_session_hash'] != "")) {

				$user_id = $_REQUEST['user_id'];
				$user_session_hash = $_REQUEST['user_session_hash'];
				$user_session_hash = explode("|", $this->General->my_decrypt($user_session_hash));

				if($user_id == $user_session_hash[0]) {
					$this->loadModel('User');
					$user = $this->User->getUserByUserIdPasscodeEmail($user_session_hash[0], $user_session_hash[1], $user_session_hash[2]);
					if($user != false) {
						$data = array("status"=>true,"message"=>ERR_00,"data"=>$user,"code"=>"00");
					} else {
						$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"06");
					}
				} else {
					$data = array("status"=>false,"message"=>ERR_08,"data"=>NULL,"code"=>"05");
				}

			} else {
				$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"04");
			}
			$this->set('data', $data);
			$this->set('_serialize', array('data'));
		}
	}

	public function setPoint() {

		var_dump($_SERVER['SERVER_ADDR']);
		var_dump($_SERVER['REMOTE_ADDR']);

		$this->set('data', $data);
		$this->set('_serialize', array('data'));
	}

	function CheckProfileWithHash($hash)
	{
		$id		=	$this->General->my_decrypt($hash);
		$explodeId = explode("|", $id);
		$this->loadModel('User');
		$find	=	$this->User->find('first',array(
						'conditions'	=>	array(
							'User.id'		=>	$explodeId[0],
							'User.email'		=>	$explodeId[1],
						),
						"recursive"		=>	2
					));

		return $find;
	}

	/**
		input,
		token :
		user_id :
		user_session_hash q5XeqpKTqpOUq5OVrd3N6NTV2sLX3cqaraHJ5sLL5Y\/F6M4=
	*/

	function getPlayCount() {
		if($this->validToken) {
			if((isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") && (isset($_REQUEST['user_session_hash']) && $_REQUEST['user_session_hash'] != "")) {

				$user_id = $_REQUEST['user_id'];
				$user_session_hash = $_REQUEST['user_session_hash'];
				$user_session_hash = explode("|", $this->General->my_decrypt($user_session_hash));

				if($user_id == $user_session_hash[0]) {
					$this->loadModel('User');
					$user = $this->User->getUserByUserIdPasscodeEmail($user_session_hash[0], $user_session_hash[1], $user_session_hash[2]);
					if($user != false) {

						//cek di pointLog
						$this->loadModel('PointLog');
						$pointLogs = $this->PointLog->find('all', array(
							'conditions' => array(
								'PointLog.passcode' => $user['User']['passcode'],
								'PointLog.point_log_type_id' => 1, //untuk API tipenya,
								'PointLog.date' => date("Y-m-d"),
								'PointLog.status' => 1
							)
						));

						$totalCount = count($pointLogs);
						$data = array("status"=>true,"message"=>ERR_00,"data"=>array('game_left' => $this->gamePlayPerDay - $totalCount),"code"=>"00");

					} else {
						$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"09");
					}
				} else {
					$data = array("status"=>false,"message"=>ERR_08,"data"=>NULL,"code"=>"08");
				}

			} else {
				$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"07");
			}

			$this->set('data', $data);
			$this->set('_serialize', array('data'));
		}
	}

	/**
		input,
		token :
		user_id :
		user_session_hash
	*/

	function playGame() {
		if($this->validToken) {
			if((isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") && (isset($_REQUEST['user_session_hash']) && $_REQUEST['user_session_hash'] != "")) {

				$user_id = $_REQUEST['user_id'];
				$user_session_hash = $_REQUEST['user_session_hash'];
				$user_session_hash = explode("|", $this->General->my_decrypt($user_session_hash));

				if($user_id == $user_session_hash[0]) {
					$this->loadModel('User');
					$user = $this->User->getUserByUserIdPasscodeEmail($user_session_hash[0], $user_session_hash[1], $user_session_hash[2]);
					if($user != false) {

						//cek di pointLog
						$this->loadModel('PointLog');

						$pointLogs = $this->PointLog->find('all', array(
							'conditions' => array(
								'PointLog.passcode' => $user['User']['passcode'],
								'PointLog.point_log_type_id' => 1, //untuk API tipenya,
								'PointLog.date' => date("Y-m-d"),
								'PointLog.status' => 1
							)
						));

						$totalCount = count($pointLogs);
						if($totalCount >= $this->gamePlayPerDay) {
							$data = array("status"=>false,"message"=>ERR_06,"data"=>NULL,"code"=>"10");
						} else {
							$gameHash = $this->General->my_encrypt($user_session_hash[0]."|".time());
							$savePointLog['PointLog'] = array(
								'passcode' => $user['User']['passcode'],
								'point_log_type_id' => 1,
								'game_hash' => $gameHash,
								'point' => 0,
								'status' => 1,
								'win' => 0,
								'date' => date('Y-m-d')
							);

							$this->PointLog->create();
							$this->PointLog->set($savePointLog);
							$save = $this->PointLog->save($savePointLog);
							if($save) {

								$apiData['user_session_hash'] = $_REQUEST['user_session_hash'];
								$apiData['user_id'] = $user_session_hash[0];
								$apiData['game_hash'] = $gameHash;
								$apiData['game_left'] = $this->gamePlayPerDay - $totalCount - 1;

								$data = array("status"=>true,"message"=>ERR_00,"data"=>$apiData,"code"=>"00");
							} else {
								$data = array("status"=>false,"message"=>ERR_07,"data"=>NULL,"code"=>"11");
							}

						}


					} else {
						$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"12");
					}
				} else {
					$data = array("status"=>false,"message"=>ERR_08,"data"=>NULL,"code"=>"13");
				}

			} else {
				$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"14");
			}

			$this->set('data', $data);
			$this->set('_serialize', array('data'));
		}
	}

	/**
		input :
		token,
		user_id,
		game_hash, q5XeqpWVrJSWrJaSqg==
		prize, 1 untuk energy : prize, 2 untuk voucher
	*/

	function claimPrize() {
		if($this->validToken) {
			if((isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "") && (isset($_REQUEST['user_session_hash']) && $_REQUEST['user_session_hash'] != "") && (isset($_REQUEST['game_hash']) && $_REQUEST['game_hash'] != "") && (isset($_REQUEST['prize']) && $_REQUEST['prize'] != "")) {

				$user_id = $_REQUEST['user_id'];
				$user_session_hash = $_REQUEST['user_session_hash'];
				$user_session_hash = explode("|", $this->General->my_decrypt($user_session_hash));

				if($user_id == $user_session_hash[0]) {
					$this->loadModel('User');
					$user = $this->User->getUserByUserIdPasscodeEmail($user_session_hash[0], $user_session_hash[1], $user_session_hash[2]);
					if($user != false) {

						//cek di pointLog
						$this->loadModel('PointLog');

						$pointLog = $this->PointLog->find('first', array(
							'conditions' => array(
								'PointLog.passcode' => $user['User']['passcode'],
								'PointLog.point_log_type_id' => 1, //untuk API tipenya,
								'PointLog.date' => date("Y-m-d"),
								'PointLog.status' => 1,
								'PointLog.point' => 0, //karena belum main,
								'PointLog.voucher' => 0, //karena belum main,
								'PointLog.win' => 0,
								'PointLog.game_hash' => $_REQUEST['game_hash']
							)
						));

						if($pointLog != false) {
							//baru save dah nih.

							if($_REQUEST['prize'] == 1) {
								$savePointLog['PointLog'] = array(
									'point' => $this->pointPerGame,
									'win' => 1,
									'id' => $pointLog['PointLog']['id']
								);

								$this->PointLog->id = $pointLog['PointLog']['id'];
								$this->PointLog->set($savePointLog);
								$save = $this->PointLog->save($savePointLog);

								if($save) {
									/*
									//kita handle aja di point log ini. afterSavePointLog
									$this->User->id = $user['User']['id'];
									$this->User->saveField('points', $user['User']['points'] + $this->pointPerGame);
									*/
								}

							} else if($_REQUEST['prize'] == 2) { //VOUCEHRE

								$savePointLog['PointLog'] = array(
									'point' => 0,
									'win' => 1,
									'voucher' => 1,
									'id' => $pointLog['PointLog']['id']
								);

								$this->PointLog->id = $pointLog['PointLog']['id'];
								$this->PointLog->set($savePointLog);
								$save = $this->PointLog->save($savePointLog);

								//KIRIM EMAIL VOUCHER
								App::uses('CakeEmail', 'Network/Email');
								$email = new CakeEmail('mandrill');

								$viewVars = array(
								    'username' => 'wowwww',
								    'passcode' => 'oooooooo',
										'webUrl' => $this->settings['web_url']
								);

								$email->to($user['User']['email']);

								$email->template('welcome', 'default');
								$email->viewVars($viewVars);

								$email->subject('YATTAAA Voucher sent');
								$as = $email->send();

							}

							$data = array("status"=>true,"message"=>ERR_00,"data"=>array('prize' => $_REQUEST['prize']),"code"=>"00");

						} else {
							$data = array("status"=>false,"message"=>ERR_07,"data"=>NULL,"code"=>"23", "request" => $_REQUEST);
						}

					} else {
						$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"22");
					}
				} else {
					$data = array("status"=>false,"message"=>ERR_08,"data"=>NULL,"code"=>"13");
				}

			} else {
				$data = array("status"=>false,"message"=>ERR_04,"data"=>NULL,"code"=>"14");
			}

			$this->set('data', $data);
			$this->set('_serialize', array('data'));
		}
	}
}
