<?php
class WebController extends AppController
{
	public $components	=	array('SwiftMailer', 'Cookie', 'DebugKit.Toolbar', 'General');
	public $settings = array();
	public $profile = array();

	public function beforeFilter()
	{
		$this->layout = "ajax";

		if(isset($_GET['debug']) && $_GET['debug'] == "1") {
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
		$this->settings = $settings['Setting'];
		$this->set('settings',		$settings['Setting']);
		$this->set("title_for_layout", $settings['Setting']["site_title"]);

		//Check Login
		$psnlogin		=	$this->Cookie->read("pasienlogin");
		if(!empty($psnlogin))
		{
			$this->profile	=	$this->CheckProfile();
			$this->set('pasienloginCookie',$this->Cookie->read("pasienlogin") );
			if(empty($this->profile))
			{
				$this->Cookie->delete("pasienlogin");
			}
		}

		$this->set('profile', $this->profile);
	}

	public function CheckProfile() {
		$id		=	$this->General->my_decrypt($this->Cookie->read("pasienlogin"));
		$this->loadModel('Pasien');
		$find	=	$this->Pasien->find('first',array(
						'conditions'	=>	array(
							'Pasien.id'		=>	$id
						),
						"recursive"		=>	2
					));

		return $find;
	}

	public function temp() {
		$this->layout = "ajax";
	}

  public function Login() {
    $this->layout	=	"login";

		if(!empty($this->request->data))
		{
			$this->loadModel("Pasien");
			$this->Pasien->set($this->request->data);
			$this->Pasien->ValidatePasien();
			if($this->Pasien->validates())
			{
				$data			=	$this->Pasien->find("first",array(
										"conditions"	=>	array(
											"LOWER(Pasien.username)"	=>	strtolower($this->request->data["Pasien"]["username"])
										),
										"order"		=>	array(
											"Pasien.id DESC"
										)
									));
				//CREATE COOKIE
				$pasien_id		=	$data['Pasien']['id'];
				$this->Cookie->write('pasienlogin',	$this->General->my_encrypt($pasien_id),false,"1 days");
				$this->redirect(array('controller' => 'Web', 'action' => 'index'));
			}
		}
  }

	public function index() {
		//cari home slider
		$this->layout = "ajax";

		$id		=	$this->General->my_decrypt($this->Cookie->read("pasienlogin"));
		$this->loadModel('Pasien');
		$pasienID	=	$this->Pasien->find('first',array(
						'conditions'	=>	array(
							'Pasien.id'		=>	$id
						),
						"recursive"		=>	2
				));

		$this->set('pasienID', $pasienID);

		//Find Medial Record
		$this->loadModel('MedicalRecord');
		$records = $this->MedicalRecord->find('all', array(
			'conditions'	=> array(
				'MedicalRecord.pasien_id' => $pasienID['Pasien']['id']
			),
			'order' => 'MedicalRecord.created ASC'
		));

		$this->set('records', $records);
	}

	public function Logout()
	{
		$this->Cookie->delete('pasienlogin');
		$this->Cookie->destroy();
		return $this->redirect(array('controller' => 'Web', 'action' => 'login'));
	}
}
?>
