<?php
class UsersController extends AppController
{
	var $uses				=	"User";
	var $ControllerName		=	"Users";
	var $ModelName			=	"User";
	var $helpers			=	array("Text","Tree");

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"7");

		//CHECK PRIVILEGES
		$this->loadModel("MyAco");
		$find					=	$this->MyAco->find("first",array(
										"conditions"	=>	array(
											"LOWER(MyAco.alias)"	=>	strtolower("Users")
										)
									));
		$this->aco_id			=	$find["MyAco"]["id"];
		$this->set("aco_id",$this->aco_id);

    $provinces = $this->{$this->ModelName}->Province->find('list', array(
      'order' => array('Province.name asc')
    ));

    $this->set('provinces', $provinces);

	}

	function Index($page=1,$viewpage=50)
	{
		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}

		$this->Session->delete("Search.".$this->ControllerName);
		$this->Session->delete('Search.'.$this->ControllerName.'Operand');
		$this->Session->delete('Search.'.$this->ControllerName.'ViewPage');
		$this->Session->delete('Search.'.$this->ControllerName.'Sort');
		$this->Session->delete('Search.'.$this->ControllerName.'Page');
		$this->Session->delete('Search.'.$this->ControllerName.'Conditions');

		$this->set(compact("page","viewpage"));
	}

	function ListItem()
	{
		$this->layout	=	"ajax";

		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$data			=	array();
			$this->set(compact("data"));
			return;
		}

		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->BindDefault(false);
		$this->{$this->ModelName}->BindImageContent();
		$this->{$this->ModelName}->VirtualFieldActivated();


		//DEFINE LAYOUT, LIMIT AND OPERAND
		$viewpage			=	empty($this->params['named']['limit']) ? 50 : $this->params['named']['limit'];
		$order				=	array("{$this->ModelName}.id" => "ASC");
		$operand			=	"AND";

		//DEFINE SEARCH DATA
		if(!empty($this->request->data))
		{
			$cond_search	=	array();
			if(isset($this->request->data[$this->ModelName]['operator'])) {
				$operand		=	$this->request->data[$this->ModelName]['operator'];
			} else {
				$operand		=	null;
			}

			$this->Session->delete('Search.'.$this->ControllerName);

			if(!empty($this->request->data['Search']['id']))
			{
				$cond_search["{$this->ModelName}.id"]					=	$this->data['Search']['id'];
			}

			if(!empty($this->request->data['Search']['name']))
			{
				$cond_search["{$this->ModelName}.name LIKE "]			=	"%".$this->data['Search']['name']."%";
			}

      if(!empty($this->request->data['Search']['username']))
			{
				$cond_search["{$this->ModelName}.username LIKE "]			=	"%".$this->data['Search']['username']."%";
			}

      if(!empty($this->request->data['Search']['email']))
			{
				$cond_search["{$this->ModelName}.email LIKE "]			=	"%".$this->data['Search']['email']."%";
			}

			if($this->request->data["Search"]['reset']=="0")
			{
				$this->Session->write("Search.".$this->ControllerName,$cond_search);
				$this->Session->write('Search.'.$this->ControllerName.'Operand',$operand);
			}
		}

		$this->Session->write('Search.'.$this->ControllerName.'Viewpage',$viewpage);
		$this->Session->write('Search.'.$this->ControllerName.'Sort',(empty($this->params['named']['sort']) or !isset($this->params['named']['sort'])) ? $order : $this->params['named']['sort']." ".$this->params['named']['direction']);

		$cond_search		=	array();
		$filter_paginate	=	array();
		$this->paginate		=	array(
									"{$this->ModelName}"	=>	array(
										"order"				=>	$order,
										'limit'				=>	$viewpage
									)
								);

		$ses_cond			=	$this->Session->read("Search.".$this->ControllerName);
		$cond_search		=	isset($ses_cond) ? $ses_cond : array();
		$ses_operand		=	$this->Session->read("Search.".$this->ControllerName."Operand");
		$operand			=	isset($ses_operand) ? $ses_operand : "AND";
		$merge_cond			=	empty($cond_search) ? $filter_paginate : array_merge($filter_paginate,array($operand => $cond_search) );
		$data				=	$this->paginate("{$this->ModelName}",$merge_cond);


		$this->Session->write('Search.'.$this->ControllerName.'Conditions',$merge_cond);

		if(isset($this->params['named']['page']) && $this->params['named']['page'] > $this->params['paging'][$this->ModelName]['pageCount'])
		{
			$this->params['named']['page']	=	$this->params['paging'][$this->ModelName]['pageCount'];
		}
		$page				=	empty($this->params['named']['page']) ? 1 : $this->params['named']['page'];
		$this->Session->write('Search.'.$this->ControllerName.'Page',$page);
		$this->set(compact('data','page','viewpage'));
	}


	function Excel()
	{
		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}

		if(isset($_GET['debug']) && $_GET['debug'] == "1")
			$this->layout		=	"ajax";
		else
		{
			$this->layout		=	"xls";
			$this->response->type(array('xls' => 'application/vnd.ms-excel'));
			$this->response->type('xls');
		}

		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->BindDefault(false);
		$this->{$this->ModelName}->BindImage(false);
		$this->{$this->ModelName}->ProductImage->BindImage(false);
		$this->{$this->ModelName}->ProductCategory->BindCategory(false);
		$this->{$this->ModelName}->VirtualFieldActivated();

		$order				=	$this->Session->read("Search.".$this->ControllerName."Sort");
		$viewpage			=	$this->Session->read("Search.".$this->ControllerName."Viewpage");
		$page				=	$this->Session->read("Search.".$this->ControllerName."Page");
		$conditions			=	$this->Session->read("Search.".$this->ControllerName."Conditions");

		$this->paginate		=	array(
									"{$this->ModelName}"	=>	array(
										"order"				=>	$order,
										"limit"				=>	$viewpage,
										"conditions"		=>	$conditions,
										"page"				=>	$page,
										"group"				=>	array("Product.id"),
										"recursive"			=>	2
									)
								);
		$data				=	$this->paginate("{$this->ModelName}",$conditions);
		$title				=	$this->ModelName;
		$filename			=	$this->ModelName."_".date("dMY");
		$this->set(compact("data","title","page","viewpage","filename"));
	}


	function Add()
	{
		if($this->access[$this->aco_id]["_create"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}

		if(!empty($this->request->data))
		{

      $saveData = $this->request->data;

      //kalau join datenya ga diisi
      if(empty($saveData[$this->ModelName]['join_date'])) {
        $saveData[$this->ModelName]['join_date'] = date("Y-m-d");
      }

			$this->{$this->ModelName}->set($saveData);

      if ($this->{$this->ModelName}->save($saveData)) {
        //update password nya jadi di decrypt
				if(isset($this->request->data['User']['password'])) {
					$this->{$this->ModelName}->saveField('password', $this->General->my_encrypt($this->request->data['User']['password']));
				}


        if(!empty($this->request->data[$this->ModelName]["images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["images"]["name"];
					$tmp								  =	$this->request->data[$this->ModelName]["images"]["tmp_name"];
					$mime_type						=	$this->request->data[$this->ModelName]["images"]["type"];

					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);

					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name			=	md5(time());
					$tmp_images1_img		=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 						=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["original"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$this->{$this->ModelName}->id,
																$this->ModelName,
																"original",
																$mime_type,
																300,
																300,
																"cropRatio"
															);

					}
					@unlink($tmp_images1_img);
				}
				else
				{
					$tmp_images1_img				=	ROOT.DS.'app'.DS.'webroot'.DS.'img'.DS."user_default.png";
					$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
                                $this->{$this->ModelName}->id,
																$this->ModelName,
																"original",
																"image\/png",
																300,
																300,
																"cropRatio"
															);
				}

        $this->redirect(array("action"=>"SuccessAdd",$this->{$this->ModelName}->id));

      } else {
        //not validate
        $this->Session->setFlash('Please try again. ');
      }


		}//END IF NOT EMPTY

	}

	function Edit($ID=NULL,$page=1,$viewpage=50)
	{
		if($this->access[$this->aco_id]["_update"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}

    $detail = $this->{$this->ModelName}->find('first', array(
      'conditions' => array(
        $this->ModelName.'.id' => $ID
      )
    ));

    if(!empty($this->request->data))
		{
      $this->{$this->ModelName}->id = $ID;
      $saveData = $this->request->data;

      //kalau join datenya ga diisi
      if(empty($saveData[$this->ModelName]['join_date'])) {
        $saveData[$this->ModelName]['join_date'] = date("Y-m-d");
      }

			$this->{$this->ModelName}->set($saveData);

      if ($this->{$this->ModelName}->save($saveData)) {
        //update password nya jadi di decrypt
        if($this->request->data[$this->ModelName]['new_password'] != "") {
          $this->{$this->ModelName}->saveField('password', $this->General->my_encrypt($this->request->data['User']['new_password']));
        }

        if(!empty($this->request->data[$this->ModelName]["images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["images"]["name"];
					$tmp								  =	$this->request->data[$this->ModelName]["images"]["tmp_name"];
					$mime_type						=	$this->request->data[$this->ModelName]["images"]["type"];

					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);

					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name			=	md5(time());
					$tmp_images1_img		=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 						=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["original"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$this->{$this->ModelName}->id,
																$this->ModelName,
																"original",
																$mime_type,
																300,
																300,
																"cropRatio"
															);

					}
					@unlink($tmp_images1_img);
				}

        $this->redirect(array("action"=>"SuccessEdit",$this->{$this->ModelName}->id));

      } else {
        //not validate
        $this->Session->setFlash('Please try again. ');
      }
		}//END IF NOT EMPTY
    else {
      $detail['User']['password'] = "";
      $this->request->data = $detail;
    }

		$this->loadModel('Appointment');
		$this->Appointment->unbindModel(array(
			'hasMany' => array(
				'AppointmentImage', 'AppointmentItem'
			)
		));

		$appointments = $this->Appointment->find('all', array(
			'conditions' => array(
				'Appointment.step' => 7,
				'Appointment.patient_id' => $ID
			),
			'recursive' => 1,
			'order' => array('Appointment.id desc')
		));

    $this->set(compact('detail', 'ID', 'page', 'viewpage', 'appointments'));
	}

	function View($ID=NULL)
	{
		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}
		$detail = $this->{$this->ModelName}->find('first', array(
      'conditions' => array(
        $this->ModelName.'.id' => $ID
      )
    ));

		$this->loadModel('Appointment');
		$this->Appointment->unbindModel(array(
			'hasMany' => array(
				'AppointmentImage', 'AppointmentItem'
			)
		));

		$appointments = $this->Appointment->find('all', array(
			'conditions' => array(
				'Appointment.step' => 7,
				'Appointment.patient_id' => $ID
			),
			'recursive' => 1,
			'order' => array('Appointment.id desc')
		));

		$this->request->data = $detail;

    $this->set(compact('detail', 'ID', 'page', 'viewpage', 'appointments'));
	}

	function ChangeStatus($ID=NULL,$status)
	{
		if($this->access[$this->aco_id]["_update"] != "1")
		{
			echo json_encode(array("data"=>array("status" => "0", "message"=>"No privileges")));
			$this->autoRender	=	false;
			return;
		}
		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			)
		));

		$resultStatus		=	"0";
		if(empty($detail))
		{
			$message		=	"Item not found.";
		}
		else
		{
			$data[$this->ModelName]["id"]		=	$ID;
			$data[$this->ModelName]["status"]	=	$status;
			$this->{$this->ModelName}->save($data);
			$message							=	"Data has updated.";
			$resultStatus						=	"1";
		}

		echo json_encode(array("data"=>array("status" => $resultStatus,"message"=>$message)));
		$this->autoRender	=	false;
	}

	function Delete($ID=NULL)
	{
		if($this->access[$this->aco_id]["_delete"] != "1")
		{
			echo json_encode(array("data"=>array("status" => "0","message"=>"No privileges")));
			$this->autoRender	=	false;
			return;
		}

		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			)
		));

		$resultStatus		=	"0";

		if(empty($detail))
		{
			$message		=	"Item not found.";
			$resultStatus	=	"0";
		}
		else
		{
			$this->{$this->ModelName}->delete($ID,false);
			$message		=	"Data has deleted.";
			$resultStatus	=	"1";
		}

		echo json_encode(array("data"=>array("status" => $resultStatus ,"message"=>$message)));
		$this->autoRender	=	false;
	}

	function SuccessAdd($ID=NULL)
	{
		$data = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=> $ID
			)
		));
		if(empty($data))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
		}
		$this->set(compact("ID"));
	}

	function SuccessEdit($ID=NULL,$page=1,$viewpage=50)
	{
		$data = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id" 		=> $ID
			)
		));

		if(empty($data))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
		}
		$this->set(compact("ID","page","viewpage"));
	}

	function testExcel() {
		set_include_path(get_include_path(). PATH_SEPARATOR."phpexcel/Classes/");
    App::import('Vendor','PHPExcel_IOFactory' ,array('file'=>'phpexcel/Classes/PHPExcel/IOFactory.php'));
    $inputFileName = 'passcodes.xlsx';
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		debug($sheetData);

		$this->autoRender = false;

	}

	function phpinfo() {
		phpinfo();
		$this->autoRender = false;
	}

}
?>
