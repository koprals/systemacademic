<?php
class AccountController extends AppController
{
	public $components		=	array("General","Acl");

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout	=	"login";
	}

	public function Login()
	{
		//var_dump($this->General->my_decrypt("2sXP4s+SqZI="));
		if(!empty($this->request->data))
		{
			$this->loadModel("Admin");
			$this->Admin->set($this->request->data);
			$this->Admin->ValidateAdmin();
			if($this->Admin->validates())
			{
				$data			=	$this->Admin->find("first",array(
										"conditions"	=>	array(
											"LOWER(Admin.username)"	=>	strtolower($this->request->data["Admin"]["username"])
										),
										"order"		=>	array(
											"Admin.id DESC"
										)
									));
				//CREATE COOKIE
				$user_id		=	$data['Admin']['id'];
				$this->Cookie->write('userlogin',	$this->General->my_encrypt($user_id),false,"1 days");
				$this->redirect(array('controller' => 'Home', 'action' => 'index'));
			}
		}
	}

	public function Test()
	{

	}

	public function Logout()
	{
		$this->Cookie->delete('userlogin');
		$this->Cookie->destroy();
		return $this->redirect(array('controller' => 'Account', 'action' => 'login'));
	}
}
?>
