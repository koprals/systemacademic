<?php
App::uses('Sanitize','Utility');

class Login extends AppModel
{
	public $name 		= 	"Login";
	public $useTable	=	"pasiens";

	function ValidateLogin()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'username' 	=>	array(
				'notEmpty' => array(
					'rule'			=>	"notEmpty",
					'message'		=>	"Please put your username"
				),
        'alphaNumeric' => array(
					'rule' 			=>	'alphaNumeric',
					'message'		=>	'No special character or space, [A-Z,a-z,0-9] only'
				),
				'minLength' => array(
					'rule'    		=>	array('minLength', 4),
					'message'		=>	'Username is too short'
				),
				'maxLength' => array(
					'rule'    		=>	array('maxLength', 30),
					'message'		=>	'Username is too long'
				),
			),
			'passcode' 	=>	array(
				'notEmpty' => array(
					'rule'			=>	"notEmpty",
					'message'		=>	"Please put your password"
				),
        'numeric' => array(
					'rule' 			=>	'numeric',
					'message'		=>	'Numbers only'
				),
        'CheckLogin' => array(
          'rule' => 'CheckLogin',
          'message' => 'Username and password do not match. '
        )
			)
		);
	}

  function CheckLogin()
	{
		$username	=	$this->data[$this->name]['username'];
		$password	=	$this->data[$this->name]['password'];

		$data		=	$this->find('first',array(
							'conditions'	=>	array(
                array(
                  "username"	=>	$username,
                  'password'	=>	$password
                ),
								"status"			=>	"1"
							),
							"order"	=>	array("{$this->name}.id ASC")
						));
		if(!empty($data)) return true;
		return false;
	}
}
