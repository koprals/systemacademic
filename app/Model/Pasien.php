<?php
class Pasien extends AppModel
{
	public $name = "Pasien";

	public function beforeSave($options = array())
	{
		App::Import("Components","General");
		$General		=	new GeneralComponent();
		if (!empty($this->data[$this->name]['password'])) {
		    $this->data[$this->name]['password'] 	=	$General->my_encrypt($this->data[$this->name]['password']);
			$this->data[$this->name]['username']	=	strtolower($this->data[$this->name]['username']);
		}


		return true;
	}

	public function afterFind($results, $primary = false) {
		App::Import("Components","General");
		$General		=	new GeneralComponent();

		foreach ($results as $key => $val)
		{
			if(isset($results[$key][$this->name]['password']))
			{
				$results[$key][$this->name]['password'] 	=	$General->my_decrypt($val[$this->name]['password']);
			}
		}
		return $results;
	}

	function ValidatePasien()
	{
		$this->validate 	= array(
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Please insert your username.'
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Please insert your password.'
				),
				'CheckPassword' => array(
					'rule' 		=> "CheckPassword",
					'message' 	=> 'Username or password is wrong!.'
				)
			)
		);
	}

	function ValidateAdd()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'code' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				"Unique" => array(
					'rule' => "isUnique",
					'message' => "This code already exists"
				),
			),
			'name' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				"Unique" => array(
					'rule' => "isUnique",
					'message' => "This name already exists"
				),
			),
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				'minLength' => array(
					'rule' 		=> array("minLength","4"),
					'message'	=> "Please insert less than 4 characters"
				),
				'maxLength' => array(
					'rule' 		=> array("maxLength","20"),
					'message'	=> "Please insert greater or equal than 20 characters"
				),
				"UniqueName" => array(
					'rule' => "UniqueName",
					'message' => "This name already exists"
				),
				"NoSpcaeAndOtherCharacter"	=> array(
					'rule'		=> "NoSpcaeAndOtherCharacter",
					'message'	=> "Not allowed character, please insert A-Z,a-z,0-9,_ and no space"
				),
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter password"
				),
				'minLength' => array(
					'rule' 		=> array("minLength","6"),
					'message'	=> "Please insert less than 6 characters"
				),
				'maxLength' => array(
					'rule' 		=> array("maxLength","20"),
					'message'	=> "Please insert greater or equal than 20 characters"
				),
				"NoSpcaeAndOtherCharacter"	=> array(
					'rule'		=> "NoSpcaeAndOtherCharacter",
					'message'	=> "Not allowed character, please insert A-Z,a-z,0-9,_ and no space"
				),
			)
		);
	}


	function ValidateEdit()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			"id"	=>	array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Sorry we cannot find your ID.'
				),
				'IsExists' => array(
					'rule' => "IsExists",
					'message' => 'Sorry we cannot find your details data.'
				)
			),
			'code' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				"Unique" => array(
					'rule' => "isUnique",
					'message' => "This code already exists"
				),
			),
			'name' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				"Unique" => array(
					'rule' => "isUnique",
					'message' => "This name already exists"
				),
			),
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter username"
				),
				'minLength' => array(
					'rule' 		=> array("minLength","4"),
					'message'	=> "Please insert less than 4 characters"
				),
				'maxLength' => array(
					'rule' 		=> array("maxLength","20"),
					'message'	=> "Please insert greater or equal than 20 characters"
				),
				"UniqueNameEdit" => array(
					'rule' => "UniqueNameEdit",
					'message' => "This name already exists"
				),
				"NoSpcaeAndOtherCharacter"	=> array(
					'rule'		=> "NoSpcaeAndOtherCharacter",
					'message'	=> "Not allowed character, please insert A-Z,a-z,0-9,_ and no space"
				),
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter password"
				),
				'minLength' => array(
					'rule' 		=> array("minLength","6"),
					'message'	=> "Please insert less than 6 characters"
				),
				'maxLength' => array(
					'rule' 		=> array("maxLength","20"),
					'message'	=> "Please insert greater or equal than 20 characters"
				),
				"NoSpcaeAndOtherCharacter"	=> array(
					'rule'		=> "NoSpcaeAndOtherCharacter",
					'message'	=> "Not allowed character, please insert A-Z,a-z,0-9,_ and no space"
				),
			)
		);
	}

	function CheckPassword()
	{
		App::Import("Components","General");
		$General	=	new GeneralComponent();
		$username	=	$this->data[$this->name]['username'];
		$password	=	$General->my_encrypt($this->data[$this->name]['password']);

		$data		=	$this->find('first',array(
							'conditions'	=>	array(
								"username"	=>	$username,
								'password'	=>	$password
							),
							"order"	=>	array("{$this->name}.id ASC")
						));
		if(!empty($data)) return true;
		return false;
	}

	function NoSpcaeAndOtherCharacter($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$regex	=	"/^[a-zA-Z0-9_]{1,}$/";
			$out	=	preg_match($regex,$value);
			return $out;
		}
		return false;
	}

	function UniqueName($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->find("first",array(
							"conditions"	=>	array(
								"LOWER({$this->name}.username)"	=>	strtolower($value)
							)
						));

			return empty($data);
		}
		return false;
	}

	function UniqueNameEdit($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->find("first",array(
							"conditions"	=>	array(
								"LOWER({$this->name}.username)"	=>	strtolower($value),
								"NOT"							=>	array(
									"{$this->name}.id"			=>	$this->data[$this->name]["id"]
								)
							)
						));

			return empty($data);
		}
		return false;
	}

	function IsExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findById($value);
			if(!empty($data)) return true;
		}
		return false;
	}

	/**public $validate 	= array(
		'id' => array(
			'notEmpty' => array(
				'rule' 		=>	"notEmpty",
				'message' 	=>	"Data not found",
				"on"		=>	"update"
			)
		),
		'name' => array(
			'notEmpty'		=>	array(
				'rule' 		=>	"notEmpty",
				'message' 	=>	"Please insert sales name"
			),
			'minLength' 	=>	array(
				'rule' 		=>	array("minLength","3"),
				'message'	=>	"Sales name is to sort"
			),
			'maxLength' 	=>	array(
				'rule' 		=>	array("maxLength","100"),
				'message'	=>	"Sales name is too long"
			)
		),
		'description' => array(
			'notEmpty'		=>	array(
				'rule' 		=>	"notEmpty",
				'message' 	=>	"Please insert sales description"
			),
			'minLength' 	=>	array(
				'rule' 		=>	array("minLength","10"),
				'message'	=>	"Sales description is to sort"
			)
		),
		'sort' => array(
			'notEmpty' => array(
				'rule' 		=> 'notEmpty',
				'message' 	=> 'Sort cannot be empty'
			),
			'numeric' => array(
				'rule' 		=> 'numeric',
				'message' 	=> 'Please provide valid numbers'
			),
			'between' => array(
				'rule'	=> array('between', 1, 999),
				'message'	=> 'Between 1 to 999 numbers'
			)
		),
		'image1' => array(
			'imagewidth'	=> array(
				'rule' 		=> array('imagewidth',600),
				'message' 	=> 'Please upload image with minimum width is 600px'
			),
			'size' => array(
				'rule' 		=> array('size',3145728),
				'message' 	=> 'Your image size is too big, please upload less than 3 Mb.'
			),
			'extension' => array(
				'rule' => array('validateName', array('gif','jpeg','jpg','png')),
				'message' => 'Only (*.gif,*.jpeg,*.jpg,*.png) are allowed.'
			)
		)
	);**/

	public function BindImageBig($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"ImageBig"	=>	array(
					"className"	=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"ImageBig.model"	=>	$this->name,
						"ImageBig.type"	=>	"big"
					)
				)
			)
		),$reset);
	}

	public function BindImageThumb($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"ImageThumb"	=>	array(
					"className"	=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"ImageThumb.model"	=>	$this->name,
						"ImageThumb.type"	=>	"thumb"
					)
				)
			)
		),$reset);
	}

	public function afterDelete()
	{
		//DELETE IMAGE CONTENT
		App::import('Component','General');
		$General		=	new GeneralComponent();
		$General->DeleteContent($this->id,$this->name);
	}

	function VirtualFieldActivated()
	{
		$this->virtualFields = array(
			'SStatus'		=> "IF((".$this->name.".status='0'), 'Hide', IF((".$this->name.".status='1'), 'Publish', 'Draft'))"

		);
	}

	function rand_number( $length ) {
		$chars	=	"0123456789";
		$str	=	"";

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}

	function notEmptyLength($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			return (strlen($value) > 0);
		}
	}

	function notEmptyImage($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			if(empty($value['name']))
			{
				return false;
			}
		}

		return true;
	}

	function validateName($file=array(),$ext=array())
	{
		$err	=	array();
		$i=0;

		foreach($file as $file)
		{
			$i++;

			if(!empty($file['name']))
			{
				if(!Validation::extension($file['name'], $ext))
				{
					return false;
				}
			}
		}
		return true;
	}

	function imagewidth($field=array(), $allowwidth=0)
	{

		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$width		= $imgInfo[0];

				if($width < $allowwidth)
				{
					return false;
				}
			}
        }
        return TRUE;
	}

	function imageheight($field=array(), $allowheight=0)
	{

		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$height		= $imgInfo[1];

				if($height < $allowheight)
				{
					return false;
				}
			}
        }
        return TRUE;
	}
}
