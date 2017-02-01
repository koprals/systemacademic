<?php
App::uses('Sanitize','Utility');
class User extends AppModel
{
	public $name = "User";

	public $validate = array(
		'id' => array(
        'blank' => array(
					'rule' => 'blank',
	        'on' => 'create'
				),
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'on' => 'edit',
					'message' => 'id cannot be empty'
				)
    ),
		/*
    'username' => array(
          'alphaNumeric' => array(
              'rule' => 'alphaNumeric',
              'required' => true,
              'message' => 'Letters and numbers only'
          ),
          'between' => array(
              'rule'    => array('between', 3, 40),
              'message' => 'Between 3 to 40 characters'
          ),
          'isUnique' => array(
            'rule'  =>  'isUnique',
            'message' => 'Username already taken, please choose another'
          )
    ),
		*/
    'first_name' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'First name cannot be empty'
      )
    ),
/*
    'password' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'on' => 'create',
        'message' => 'Password cannot be empty'
      ),
      'between' => array(
          'rule'    => array('between', 8, 40),
          'on' => 'create',
          'message' => 'Between 8 to 40 characters'
      )
    ),
    're_type_password' => array(
      'equalToField' => array(
        'rule' => array('equalToField', 'password'),
        'on' => 'create',
        'message' => 'Field must be equal to password'
      )
    ),
    'new_password' => array(
      'between' => array(
          'rule'    => array('between', 8, 40),
          'on' => 'update',
          'message' => 'Between 8 to 40 characters',
          'allowEmpty' => true
      )
    ),
    'new_re_type_password' => array(
      'equalToField' => array(
        'rule' => array('equalToField', 'new_password'),
        'on' => 'update',
        'message' => 'Field must be equal to password',
      )
    ),
*/
    'mobile_number' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Mobile Number cannot be empty',
      ),
/*
      'email' => array(
        'rule' => 'email',
        'message' => 'Please input a valid email address'
      ),
*/
      'isUnique' => array(
        'rule'  =>  'isUnique',
        'message' => 'Mobile Number  already taken, please choose another'
      )
    )
	);

  public $belongsTo = array(
    'Province',
		'Leaderboard' => array(
			'className' => 'Leaderboard',
			'foreignKey' => 'passcode'
		)
  );

	public function BindImageContent($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Image"	=>	array(
					"className"	=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Image.model"	=>	$this->name,
						"Image.type"	=>	"original"
					)
				)
			)
		),$reset);
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
			'SStatus'		=> "IF((".$this->name.".status='0'), 'Not Active', IF((".$this->name.".status='1'), 'Active', ''))",
      'name' => 'CONCAT('.$this->name.'.first_name, " ", '.$this->name.'.last_name)',
			'name_email' => 'CONCAT('.$this->name.'.first_name, " ", '.$this->name.'.last_name, " ( " , '.$this->name.'.email, " ) ")',
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

  function equalToField($field, $equalToField) {

    foreach($field as $key => $value) {

      if($value === $this->data[$this->name][$equalToField]) {
        return true;
      } else {
        return false;
      }

    }
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

	function paginateCount($conditions = null, $recursive = 0, $extra = array())
	{
		$parameters 			=	compact('conditions');
		$parameters["fields"]	=	array('Product.id');
	    $this->recursive 		=	$recursive;

		if (isset($extra['group']))
		{
			$paginationcount = $this->find('all', array_merge($parameters, $extra));
			$paginationcount = count($paginationcount);
		}
		else
		{
			$paginationcount = $this->find('count', array_merge($parameters, $extra));
		}
		return $paginationcount;
	}

	//Function need in API
	function getUserByUserIdPasscodeEmail($user_id, $passcode, $email) {
		return $this->find('first', array(
			'conditions' => array(
				'User.status' => 1,
				'User.id' => $user_id,
				'User.passcode' => $passcode,
				'User.email' => $email
			)
		));
	}

}
