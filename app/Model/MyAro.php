<?php
App::uses('Sanitize','Utility');
class MyAro extends AppModel
{
	public $actsAs		=	array('Tree');
	public $useTable	=	"aros";

	public function beforeSave($options = array())
	{
		if(!empty($this->data))
		{
			foreach($this->data[$this->name] as $key => $name)
			{
				$this->data[$this->name][$key]		=	trim($this->data[$this->name][$key]);
				if($key == "name")
				{
					$this->data[$this->name][$key]	=	Sanitize::html($this->data[$this->name][$key]);
				}
				if($key == "description")
				{
					$this->data[$this->name][$key]	=	Sanitize::html($this->data[$this->name][$key]);
				}
			}
		}
		return true;
	}

	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {
			if (isset($val[$this->name]['description'])) {
				$results[$key][$this->name]['description'] = $this->DecodeBBCode($val[$this->name]['description']);
			}
		}
		return $results;
	}


	function DecodeBBCode($string)
	{
		return false;
	}


	function ValidateAdd()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'alias' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter Modul Name"
				),
				"UniqueName" => array(
					'rule' => "UniqueName",
					'message' => "This name already exists"
				),
				"NoOtherCharacter"	=> array(
					'rule'		=> "NoOtherCharacter",
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
			'alias_name' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter Group Name"
				),
				"UniqueNameEdit" => array(
					'rule' => "UniqueNameEdit",
					'message' => "This name already exists"
				),
				"NoOtherCharacter"	=> array(
					'rule'		=> "NoOtherCharacter",
					'message'	=> "Not allowed character, please insert A-Z,a-z,0-9,_ or space"
				),
			)
		);
	}

	function BindDefault($reset	=	true)
	{
		$this->bindModel(array(
			"belongsTo"	=>	array(
				"Parent"	=>	array(
					"className"	=>	"MyAro"
				)
			)
		),$reset);
	}

	function VirtualFieldActivated()
	{
		$this->virtualFields = array(
			'SStatus'		=> 'IF(('.$this->name.'.status=\'1\'),\'Active\',\'Hide\')',
			'alias_name'		=> 'REPLACE('.$this->name.'.alias,"_"," ")'
		);
	}

	function NoOtherCharacter($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$regex	=	"/^[a-zA-Z0-9_ ]{1,}$/";
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
								"LOWER({$this->name}.alias)"	=>	strtolower(str_replace(" ","_",$value))
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
								"LOWER({$this->name}.alias)"	=>	strtolower(str_replace(" ","_",$value)),
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
}
?>
