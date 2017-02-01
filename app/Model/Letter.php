<?php
App::uses('Sanitize','Utility');
class Letter extends AppModel
{
	public $name = "Letter";

	public $belongsTo = array(
    'Admin' => array(
      'className' => 'Admin',
      'foreignKey'  =>  'doctor_id'
    ),
    'Pasien'  =>  array(
      'className' =>  'Pasien',
      'foreignKey'  => 'pasien_id'
    ),
		'LetterType'	=>	array(
			'className'	=>	'LetterType',
			'foreignKey'	=>	'letter_type_id'
		)
  );

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

	public function beforeSave($options = array())
	{
		if(!empty($this->data))
		{
			foreach($this->data[$this->name] as $key => $name)
			{
				if(isset($this->data[$this->name][$key]) && !is_array($this->data[$this->name][$key]))
					$this->data[$this->name][$key]		=	trim($this->data[$this->name][$key]);

				if($key == "name")
				{
					$this->data[$this->name][$key]	=	Sanitize::html($this->data[$this->name][$key]);
				}

				if($key == "description")
				{
					$this->data[$this->name][$key]	=	Sanitize::html($this->data[$this->name][$key]);
				}

				if($key == "position")
				{
					$this->data[$this->name][$key]	=	Sanitize::html($this->data[$this->name][$key]);
				}
			}
		}
	}

	public function afterFind($results, $primary = false)
	{
		return $results;
	}

	public function afterDelete()
	{
		//DELETE IMAGE CONTENT
		App::import('Component','General');
		$General		=	new GeneralComponent();
		$General->DeleteContent($this->id,$this->name);
	}

	public function beforeValidate($options = array())
	{
		return true;
	}

	public function BindImage($reset	=	true)
	{
	}

	function BindDefault($reset	=	true)
	{
	}

	function UnBindDefault($reset	=	true)
	{
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
	function IsExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findById($value);
			if(!empty($data)) return true;
		}
		return false;
	}

	function size( $field=array(), $aloowedsize)
    {
		foreach( $field as $key => $value ){
            $size = intval($value['size']);
            if($size > $aloowedsize) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
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
