<?php
class MedicalRecordsController extends AppController
{

	//hello world
  var $uses				=	"MedicalRecord";
	var $ControllerName		=	"MedicalRecords";
	var $ModelName			=	"MedicalRecord";
	var $helpers			=	array("Text","Tree");
  var $components = array("RequestHandler");

	var $arrayListMime = array(
		'image/gif',
		'image/jpeg',
		'image/png',
		'image/gif',
		'audio/mpeg',
		'audio/ogg',
		'video/avi',
		'video/mpeg',
		'video/mp4'
	);

	var $arrayListMimeImage = array(
		'image/gif',
		'image/jpeg',
		'image/png',
		'image/gif'
	);

	var $arrayListMimeVideo = array(
		'video/avi',
		'video/mpeg',
		'video/mp4'
	);

	var $arrayListMimeSound = array(
		'audio/mpeg',
		'audio/ogg'
	);

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"3");

		//CHECK PRIVILEGES
		$this->loadModel("MyAco");
		$find					=	$this->MyAco->find("first",array(
										"conditions"	=>	array(
											"LOWER(MyAco.alias)"	=>	strtolower("MedicalRecords")
										)
									));
		$this->aco_id			=	$find["MyAco"]["id"];
		$this->set("aco_id",$this->aco_id);

    //DEFINE DOCTOR
    $this->loadModel('Admin');
    $find_doctor  = $this->Admin->find('list', array(
      "conditions"  =>  array(
        "Admin.aro_id" => 4
      ),
      'fields' => array(
        'Admin.fullname'
      )
    ));
    $this->set("find_doctor", $find_doctor);

    //DEFINE PASIEN
    $this->loadModel('Pasien');
    $find_pasien  = $this->Pasien->find("list", array(
      'conditions'  =>  array(
        'Pasien.status' =>  1
      )
    ));
    $this->set('find_pasien', $find_pasien);
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

	function ListItem($typeListItem = null)
	{
		$this->layout	=	"ajax";

		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$data			=	array();
			$this->set(compact("data"));
			return;
		}

		$this->loadModel($this->ModelName);
    $this->{$this->ModelName}->BindImageBig();
    $this->{$this->ModelName}->BindImageThumb();
		$this->{$this->ModelName}->VirtualFieldActivated();

		//DEFINE LAYOUT, LIMIT AND OPERAND
		$viewpage			=	empty($this->params['named']['limit']) ? 50 : $this->params['named']['limit'];
		$order				=	array("{$this->ModelName}.id" => "DESC");
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
				$cond_search["Pasien.name LIKE "]			=	"%".$this->data['Search']['name']."%";
			}

			if(!empty($this->request->data['Search']['file_type']))
			{
				switch($this->request->data['Search']['file_type']) {
						case "image" : $cond_search["{$this->ModelName}.mime_type"] = $this->arrayListMimeImage; break;
						case "video" : $cond_search["{$this->ModelName}.mime_type"] = $this->arrayListMimeVideo; break;
						case "sound" : $cond_search["{$this->ModelName}.mime_type"] = $this->arrayListMimeSound; break;
				}
			}

			if(!empty($this->request->data['Search']['year']['year'])) {
				$cond_search["YEAR({$this->ModelName}.created)"] = $this->request->data['Search']['year']['year'];
			}

			if(!empty($this->request->data['Search']['month']['month'])) {
				$cond_search["MONTH({$this->ModelName}.created)"] = $this->request->data['Search']['month']['month'];
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
										'limit'				=>	$viewpage,
                    'recursive'   => 2
									)
								);

		$ses_cond			=	$this->Session->read("Search.".$this->ControllerName);
		$cond_search		=	isset($ses_cond) ? $ses_cond : array();
		$ses_operand		=	$this->Session->read("Search.".$this->ControllerName."Operand");
		$operand			=	isset($ses_operand) ? $ses_operand : "AND";
		$merge_cond			=	empty($cond_search) ? $filter_paginate : array_merge($filter_paginate,array($operand => $cond_search) );
		$data				=	$this->paginate("{$this->ModelName}",$merge_cond);
		pr($data);
		$this->Session->write('Search.'.$this->ControllerName.'Conditions',$merge_cond);

		if(isset($this->params['named']['page']) && $this->params['named']['page'] > $this->params['paging'][$this->ModelName]['pageCount'])
		{
			$this->params['named']['page']	=	$this->params['paging'][$this->ModelName]['pageCount'];
		}
		$page				=	empty($this->params['named']['page']) ? 1 : $this->params['named']['page'];
		$this->Session->write('Search.'.$this->ControllerName.'Page',$page);

		//untuk di pake di tempalte
		if ($this->request->is('requested')) {
				$dataAction['data'] = $data;
				$dataAction['page']	=	$page;
				$dataAction['viewpage']	=	$viewpage;
        return $dataAction;
    }

		$this->set(compact('data','page','viewpage'));

		if($typeListItem != null) {
			$this->render("small_list_item");
		}

	}

  function Pdf($ID=NULL)
  {
    if($this->access[$this->aco_id]["_read"] != "1")
    {
      $this->layout	=	"no_access";
      return;
    }

    $this->pdfConfig = array(
						'orientation' => 'portrait',//or landscape
						'filename' => "testpdf",
						'download' => false,
						'margin' => array(
              'bottom' => 15,
              'left' => 50,
              'right' => 30,
              'top' => 45
					),
					'engine' => 'CakePdf.DomPdf',
				);

    $this->loadModel($this->ModelName);
    $this->{$this->ModelName}->BindImageBig(false);
    $this->{$this->ModelName}->VirtualFieldActivated();

    $detail = $this->{$this->ModelName}->find('first', array(
      'conditions' => array(
        "{$this->ModelName}.id"		=>	$ID
      ),
      'recursive' =>  2
    ));

    $title				=	$this->ModelName;
		$filename			=	$this->ModelName."_".date("dMY");

    $this->set(compact("ID","detail","title","filename"));
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
			$this->{$this->ModelName}->create();
			$this->{$this->ModelName}->set($this->request->data);

      var_dump($this->request->data);
			if($this->{$this->ModelName}->validates())
			{
				$save	=	$this->{$this->ModelName}->save($this->request->data);
				$ID		=	$this->{$this->ModelName}->getLastInsertId();

				if(!empty($this->request->data[$this->ModelName]["image1"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["image1"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["image1"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["image1"]["type"];

					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);

					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);

					if($upload)
					{
						//RESIZE BIG
						$error_upload["original"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"thumb",
																$mime_type,
																300,
																300,
																"crop"
															);

						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																600,
																"cropResize"
															);

					}
					@unlink($tmp_images1_img);
				}

				$this->Session->setFlash("Image has been added", 'flash_success');
				$this->redirect(array('action' => 'SuccessAdd', $ID));
			}
			else
			{
				$errors = $this->{$this->ModelName}->validationErrors;
				$this->set('errors', $errors);
			}
		}
	}

	function Edit($ID=NULL,$page=1,$viewpage=50)
	{
		if($this->access[$this->aco_id]["_update"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}

    $this->{$this->ModelName}->BindImageBig();
    $this->{$this->ModelName}->BindImageThumb();

		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			),
			"recursive"						=>	2
		));

		if(empty($detail))
		{
			$this->layout	=	"error";
			return;
		}

		if(!empty($this->request->data))
		{
      $this->{$this->ModelName}->id = $ID;
      $this->{$this->ModelName}->set($this->request->data);

			if($this->{$this->ModelName}->validates()) {

        $save	=	$this->{$this->ModelName}->save($this->request->data);
        $ID		=	$this->{$this->ModelName}->id;

        if(!empty($this->request->data[$this->ModelName]["image1"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["image1"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["image1"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["image1"]["type"];

					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);

					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["original"]		=	"Sorry, there is problem when upload file.";
            $resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"thumb",
																$mime_type,
																225,
																225,
																"crop"
															);

            $resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																600,
																"resizeMaxWidth"
															);

					}
					@unlink($tmp_images1_img);
				}

				if(!empty($this->request->data[$this->ModelName]["image2"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["image2"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["image2"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["image2"]["type"];

					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);

					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["original"]		=	"Sorry, there is problem when upload file.";

            $resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																450,
																320,
																"resizeMaxWidth"
															);

					}
					@unlink($tmp_images1_img);
				}

        $this->redirect(array('action' => 'successEdit', $ID));

      }

		}//END IF NOT EMPTY
		else {
			$this->request->data = $detail;
		}

		$this->set(compact("detail", "ID"));
	}

	function View($ID=NULL)
	{
		if($this->access[$this->aco_id]["_read"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}
		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->BindImageBig(false);
		$this->{$this->ModelName}->VirtualFieldActivated();

		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			),
      'recursive' =>  2
		));
    //debug($detail);
		if(empty($detail))
		{
			$this->layout	=	"ajax";
			$this->set(compact("ID","data"));
			$this->render("/errors/error404");
			return;
		}
		$this->set(compact("ID","detail"));
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

	function ChangeStatusMultiple()
	{
		if($this->access[$this->aco_id]["_update"] != "1")
		{
			echo json_encode(array("data"=>array("status" => "0","message"=>"No privileges")));
			$this->autoRender	=	false;
			return;
		}

		$ID									=	explode(",",$_REQUEST["id"]);
		$status								=	$_REQUEST["status"];


		$this->{$this->ModelName}->updateAll(
			array(
				"status"					=>	"'".$status."'"
			),
			array(
				"{$this->ModelName}.id"		=>	$ID
			)
		);
		$message							=	"Data has updated.";
		echo json_encode(array("data"=>array("status" => "1","message"=>$message)));
		$this->autoRender					=	false;
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
			if($this->{$this->ModelName}->delete($ID,false)) {

				//@unlink(WWW_ROOT.$detail['SponsoredFile']['url']);
				//@unlink(WWW_ROOT.$detail['SponsoredFile']['url_thumb']);

				$message		=	"Data has deleted.";
				$resultStatus	=	"1";
			} else {
				$message		=	"Please try again.";
				$resultStatus	=	"0";
			}

		}

		echo json_encode(array("data"=>array("status" => $resultStatus ,"message"=>$message)));
		$this->autoRender	=	false;
	}

	function DeleteMultiple()
	{
		if($this->access[$this->aco_id]["_delete"] != "1")
		{
			echo json_encode(array("data"=>array("status"	=>	"0", "message"=>"No privileges")));
			$this->autoRender	=	false;
			return;
		}

		$id		=	explode(",",$_REQUEST["id"]);

		$this->{$this->ModelName}->deleteAll(array(
			"{$this->ModelName}.id"	=>	$id
		),true, true);
		$message	=	"Data has deleted.";

		echo json_encode(array("data"=>array("status"	=>	"1","message"=>$message)));
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
}
?>
