<?php
class ImportFilesController extends AppController
{
	var $uses				=	"ImportFile";
	var $ControllerName		=	"ImportFiles";
	var $ModelName			=	"ImportFile";
	var $helpers			=	array("Text","Tree");

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"2");

		//CHECK PRIVILEGES
		$this->loadModel("MyAco");
		$find					=	$this->MyAco->find("first",array(
										"conditions"	=>	array(
											"LOWER(MyAco.alias)"	=>	strtolower("ImportFiles")
										)
									));
		$this->aco_id			=	$find["MyAco"]["id"];
		$this->set("aco_id",$this->aco_id);

    $importFileTypes = $this->{$this->ModelName}->ImportFileType->find('list');
    $this->set('importFileTypes', $importFileTypes);

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
				$cond_search["{$this->ModelName}.title LIKE "]			=	"%".$this->data['Search']['name']."%";
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

		//$this->{$this->ModelName}->BindDefault(false);

		if(!empty($this->request->data))
		{

      if($this->request->data['ImportFile']['image']['error'] == 0) {

        $ext = pathinfo($this->request->data['ImportFile']['image']['name'], PATHINFO_EXTENSION);

        if($ext == "xls" || $ext == "xlsx") {

          $this->{$this->ModelName}->create();
          $this->{$this->ModelName}->set($this->request->data);

          if($this->{$this->ModelName}->save($this->request->data)) {
            $ID		=	$this->{$this->ModelName}->getLastInsertId();
            //uploading process
            $fileUrl = "contents/importFiles/".$this->request->data['ImportFile']['import_file_type_id']."/".$ID.".".strtolower($ext);
            $fileLocation = ROOT.DS.'app'.DS.'webroot'.DS.$fileUrl;
            $folder = ROOT.DS.'app'.DS.'webroot'.DS.'contents'.DS.'importFiles'.DS;
              if(!is_dir($folder)) mkdir($folder,0755);
            $folder = $folder.$this->request->data['ImportFile']['import_file_type_id'].DS;
              if(!is_dir($folder)) mkdir($folder,0755);

            $upload =	move_uploaded_file($this->request->data['ImportFile']['image']['tmp_name'],$fileLocation);

            $this->{$this->ModelName}->saveField('filename', $ID.".".strtolower($ext));

            $this->redirect(array('action' => 'SuccessAdd', $ID));

          } else {
            // ga bisa di save, tau kenapa
            var_dump("ga bisa di save, tau kenapa");
          }

        } else {
          //cuman boleh excel aja nih say
          var_dump("cuman boleh excel aja nih say");
        }

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

      if($this->{$this->ModelName}->save($this->request->data)) {
        $this->redirect(array("action"=>"SuccessEdit", $this->{$this->ModelName}->id));
      } else {
        $this->Session->setFlash('Please try again.');
      }

		}//END IF NOT EMPTY
		else {
			$this->request->data = $detail;
		}

    $fileinfo = array();

    if(in_array($detail['File']['mime_type'], $this->arrayListMimeImage)) {
      list($fileinfo['width'], $fileinfo['height'], $fileinfo['type'], $fileinfo['attr']) = getimagesize(WWW_ROOT.$detail['File']['url']);
			$fileinfo['file_size'] = round(filesize(WWW_ROOT.$detail['File']['url']) / 1024, 2);

    } else if($detail['File']['mime_type'] == "video/mp4") {

			$explodeUrl  = explode($this->settings['cms_url'], $detail['File']['video_url']);
			$fileinfo['file_size'] = round(filesize(WWW_ROOT.$explodeUrl[1]) / 1024, 2);
		}

		$this->set(compact("detail", "ID", "fileinfo"));
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

		$detail = $this->{$this->ControllerName}->find('first', array(
			'conditions' => array(
				"{$this->ControllerName}.id"		=>	$ID
			)
		));
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

				@unlink(WWW_ROOT.$detail['File']['url']);
				@unlink(WWW_ROOT.$detail['File']['url_thumb']);

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
