<?php
class AboutUsController extends AppController
{
	var $ControllerName		=	"AboutUs";
	var $ModelName			=	"WebPage";
	var $helpers			=	array("Text","General");
	var $uses				=	"WebPage";
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"27");

		//CHECK PRIVILEGES
		$this->loadModel("MyAco");
		$find					=	$this->MyAco->find("first",array(
										"conditions"	=>	array(
											"LOWER(MyAco.alias)"	=>	strtolower("AboutUs")
										)
									));
		$this->aco_id			=	$find["MyAco"]["id"];
		$this->set("aco_id",$this->aco_id);

	}

	function Index($page=1,$viewpage=50)
	{
		if($this->access[$this->aco_id]["_update"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}
		$ID					=	9;
		
		
		$this->{$this->ModelName}->BindImageBig();
   	 	$this->{$this->ModelName}->BindImageThumb();
		$detail 			=	$this->{$this->ModelName}->find('first', array(
									'conditions' => array(
										"{$this->ModelName}.id"		=>	$ID
									)
								));
		
		if(empty($detail))
		{
			$this->layout	=	"error";
			return;
		}
							
		if (empty($this->data))
		{
			$this->data = $detail;
		}
		else
		{
			$this->{$this->ModelName}->set($this->data);
			if($this->{$this->ModelName}->validates())
			{
				$save		=	$this->{$this->ModelName}->save($this->data,false);
				
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
						//RESIZE THUMB
						$error_upload["thumb"]		=	"Sorry, there is problem when upload file.";
            			$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"thumb",
																$mime_type,
																225,
																225,
																"cropResize"
															);
						
						//RESIZE BIG
						$error_upload["big"]		=		"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																800,
																800,
																"resizeMaxWidth"
															);
					}
					@unlink($tmp_images1_img);
				}

				$this->redirect(array('action' => 'SuccessEdit', $ID,$page,$viewpage));
			}
		}
		
		
		$webPageTypes = $this->{$this->ModelName}->WebPageType->find('list');
		
		$this->set(compact(
			"ID",
			"detail",
			"page",
			"viewpage",
			"webPageTypes"
		));
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
		$order				=	array("{$this->ModelName}.id" => "DESC");
		$operand			=	"AND";
		
		//DEFINE SEARCH DATA
		if(!empty($this->request->data))
		{
			$cond_search	=	array();
			$operand		=	$this->request->data[$this->ModelName]['operator'];
			$this->Session->delete('Search.'.$this->ControllerName);
			
			if(!empty($this->request->data['Search']['id']))
			{
				$cond_search["{$this->ModelName}.id"]					=	$this->data['Search']['id'];
			}
			
			if(!empty($this->request->data['Search']['name']))
			{
				$cond_search["{$this->ModelName}.name LIKE "]			=	"%".$this->data['Search']['name']."%";
			}
			
			if(!empty($this->data['Search']['start_date']) && empty($this->data['Search']['end_date']))
			{
				$cond_search["{$this->ModelName}.created >= "] 			=	$this->data['Search']['created']. " 00:00:00";
			}
			
			if(empty($this->data['Search']['start_date']) && !empty($this->data['Search']['end_date']))
			{
				$cond_search["{$this->ModelName}.created <= "] 			=	$this->data['Search']['created']. " 23:59:59";
			}
			
			if(!empty($this->data['Search']['start_date']) && !empty($this->data['Search']['end_date']))
			{
				$tmp				=	$this->data['Search']['start_date'];
				$START				=	(strtotime($this->data['Search']['end_date']) < strtotime($this->data['Search']['start_date'])) ? $this->data['Search']['end_date'] : $this->data['Search']['start_date'];
				$END				=	($this->data['Search']['end_date'] < $tmp) ? $tmp : $this->data['Search']['end_date'];
				$cond_search["{$this->ModelName}.created BETWEEN ? AND ? "]			=	array($START." 00:00:00",$END." 23:59:59");
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
	
		$this->{$this->ModelName}->BindDefault(false);
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
										"page"				=>	$page
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
		
		//DEFINE PRESIDENT LIST
		$this->loadModel("User");
		$this->User->VirtualFieldActivated();
		
		$president_id_list	=	$this->User->find("list",array(
									"fields"		=>	array(
										"User.id",
										"User.fullname"
									),
									"conditions"	=>	array(
										"User.is_president"	=>	0,
										"User.is_governor"	=>	0,
										"User.is_walikota"	=>	0
									)	
								));
		
		
		if(!empty($this->request->data))
		{
			
			$this->{$this->ModelName}->set($this->request->data);
			$this->{$this->ModelName}->ValidateAdd();
			if($this->{$this->ModelName}->validates())
			{
				$save	=	$this->{$this->ModelName}->save($this->request->data);
				$ID		=	$this->{$this->ModelName}->getLastInsertId();
				
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["flag_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["flag_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["flag_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["flag_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["big"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																200,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE EMBLEM/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["emblem_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["emblem_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["emblem_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["emblem_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["emblem"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"emblem",
																$mime_type,
																300,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["background_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["background_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["background_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["background_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["background"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"background",
																$mime_type,
																1024,
																678,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE MAPS/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["map_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["map_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["map_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["map_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["maps"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"maps",
																$mime_type,
																600,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE MAPS/////////////////////////////////////////////
				
				$this->redirect(array("action"=>"SuccessAdd",$ID));
			}//END IF VALIDATE
		}//END IF NOT EMPTY
		
		$this->set(compact(
			"president_id_list"
		));
	}
	
	function Edit($ID=NULL,$page=1,$viewpage=50)
	{
		if(($ID == $this->super_admin_id && $this->profile["Admin"]["id"] != $this->super_admin_id) or $this->access[$this->aco_id]["_update"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}
		
		$this->{$this->ModelName}->BindDefault(false);
		$this->{$this->ModelName}->BindImageContent(false);
		$detail 			=	$this->{$this->ModelName}->find('first', array(
									'conditions' => array(
										"{$this->ModelName}.id"		=>	$ID
									)
								));
		pr($detail);	
		if(empty($detail))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
			return;
		}
		
		
		//DEFINE PRESIDENT LIST
		$this->loadModel("User");
		$this->User->VirtualFieldActivated();
		$president_id_list	=	$this->User->find("list",array(
									"fields"		=>	array(
										"User.id",
										"User.fullname"
									),
									"conditions"	=>	array(
										"OR"		=>	array(
											array(
												"User.is_president"		=>	1,
												"User.id"				=>	$detail[$this->ModelName]['president_id']
											),
											array(
												"User.is_president"		=>	0,
												"User.is_governor"		=>	0,
												"User.is_walikota"		=>	0,
												"User.country_id"		=>	$ID
											)
										)
									)
								));
								
								
		if (empty($this->data))
		{
			$this->data = $detail;
		}
		else
		{
			$this->{$this->ModelName}->set($this->data);
			$this->{$this->ModelName}->ValidateAdd();
			
			if($this->{$this->ModelName}->validates())
			{
				$save		=	$this->{$this->ModelName}->save($this->data,false);
				
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["flag_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["flag_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["flag_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["flag_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["big"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																200,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				
				
				//////////////////////////////////////START SAVE EMBLEM/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["emblem_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["emblem_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["emblem_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["emblem_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE EMBLEM
						$error_upload["emblem"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"emblem",
																$mime_type,
																300,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE EMBLEM/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["background_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["background_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["background_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["background_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE EMBLEM
						$error_upload["background"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"background",
																$mime_type,
																1024,
																678,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE MAPS/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["map_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["map_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["map_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["map_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE EMBLEM
						$error_upload["maps"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$ID,
																$this->ModelName,
																"maps",
																$mime_type,
																600,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				$this->redirect(array('action' => 'SuccessEdit', $ID,$page,$viewpage));
			}
		}
		$this->set(compact(
			"ID",
			"detail",
			"president_id_list",
			"page",
			"viewpage",
			"marital_status_id_list"
		));
	}
	
	function CopyRow($ID=NULL,$page=1,$viewpage=50)
	{
		if(($ID == $this->super_admin_id && $this->profile["Admin"]["id"] != $this->super_admin_id) or $this->access[$this->aco_id]["_update"] != "1")
		{
			$this->layout	=	"no_access";
			return;
		}
		
		$this->{$this->ModelName}->BindDefault(false);
		$this->{$this->ModelName}->BindImageContent(false);
		$detail 			=	$this->{$this->ModelName}->find('first', array(
									'conditions' => array(
										"{$this->ModelName}.id"		=>	$ID
									)
								));
								
		if(empty($detail))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
			return;
		}
		
		//DEFINE PRESIDENT LIST
		$this->loadModel("User");
		$this->User->VirtualFieldActivated();
		
		$president_id_list	=	$this->User->find("list",array(
									"fields"		=>	array(
										"User.id",
										"User.fullname"
									),
									"conditions"	=>	array(
										"User.is_president"	=>	0,
										"User.is_governor"	=>	0,
										"User.is_walikota"	=>	0
									)	
								));
								
		if (empty($this->data))
		{
			$this->data = $detail;
		}
		else
		{
			$this->{$this->ModelName}->set($this->data);
			$this->{$this->ModelName}->ValidateCopy();
			
			if($this->{$this->ModelName}->validates())
			{
				$save		=	$this->{$this->ModelName}->save($this->data,false);
				$afterId	=	$this->{$this->ModelName}->getLastInsertId();
				
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["flag_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["flag_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["flag_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["flag_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BIG
						$error_upload["big"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																200,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				else
				{
					$tmp_images1_img					=	$detail['Image']['path'];
					$mime_type							=	$detail['Image']['mime_type'];
					
					if(file_exists($tmp_images1_img))
					{
						//RESIZE BIG
						$error_upload["big"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"big",
																$mime_type,
																300,
																200,
																"cropResize"
															);
					}
				}
				//////////////////////////////////////START SAVE FOTO/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE EMBLEM/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["emblem_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["emblem_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["emblem_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["emblem_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE EMBLEM
						$error_upload["emblem"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"emblem",
																$mime_type,
																300,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				else
				{
					$tmp_images1_img					=	$detail['Emblem']['path'];
					$mime_type							=	$detail['Emblem']['mime_type'];
					if(file_exists($tmp_images1_img))
					{
						//RESIZE BIG
						$error_upload["big"]			=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"emblem",
																$mime_type,
																300,
																300,
																"cropResize"
															);
					}
				}
				//////////////////////////////////////START SAVE EMBLEM/////////////////////////////////////////////
				
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["background_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["background_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["background_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["background_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BACKGROUND
						$error_upload["background"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"background",
																$mime_type,
																1024,
																678,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				else
				{
					$tmp_images1_img					=	$detail['Background']['path'];
					$mime_type							=	$detail['Background']['mime_type'];
					
					if(file_exists($tmp_images1_img))
					{
						//RESIZE BIG
						$error_upload["background"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,

																$this->ModelName,
																"background",
																$mime_type,
																1024,
																678,
																"cropResize"
															);
					}
				}
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				
				
				//////////////////////////////////////START SAVE MAPS/////////////////////////////////////////////
				if(!empty($this->request->data[$this->ModelName]["map_images"]["name"]))
				{
					$tmp_name							=	$this->request->data[$this->ModelName]["map_images"]["name"];
					$tmp								=	$this->request->data[$this->ModelName]["map_images"]["tmp_name"];
					$mime_type							=	$this->request->data[$this->ModelName]["map_images"]["type"];
					
					$path_tmp							=	ROOT.DS.'app'.DS.'tmp'.DS.'upload'.DS;
						if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
						
					$ext								=	pathinfo($tmp_name,PATHINFO_EXTENSION);
					$tmp_file_name						=	md5(time());
					$tmp_images1_img					=	$path_tmp.$tmp_file_name.".".$ext;
					$upload 							=	move_uploaded_file($tmp,$tmp_images1_img);
					if($upload)
					{
						//RESIZE BACKGROUND
						$error_upload["background"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"maps",
																$mime_type,
																600,
																300,
																"cropResize"
															);
					}
					@unlink($tmp_images1_img);
				}
				else
				{
					$tmp_images1_img					=	$detail['Maps']['path'];
					$mime_type							=	$detail['Maps']['mime_type'];
					$source								=	$detail['Maps']['source'];
					if(file_exists($tmp_images1_img))
					{
						//RESIZE BIG
						$error_upload["maps"]		=	"Sorry, there is problem when upload file.";
						$resize							=	$this->General->ResizeImageContent(
																$tmp_images1_img,
																$this->settings["cms_url"],
																$afterId,
																$this->ModelName,
																"maps",
																$mime_type,
																600,
																300,
																"cropResize"
															);
					}
				}
				//////////////////////////////////////START SAVE BACKGROUND/////////////////////////////////////////////
				
				$this->redirect(array('action' =>'SuccessCopy',$ID,$afterId,$page,$viewpage));
			}
		}
		$this->set(compact(
			"ID",
			"detail",
			"page",
			"viewpage",
			"marital_status_id_list",
			"president_id_list"
		));
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
			$this->{$this->ModelName}->delete($ID,true);
			$message		=	"Data has deleted.";
			$resultStatus	=	"1";
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
		),false, true);
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
	
	function SuccessCopy($beforeId=NULL,$afterId=NULL,$page=1,$viewpage=50)
	{
		$before = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id" 		=> $beforeId
			)
		));
		
		$after = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id" 		=> $afterId
			)
		));
		
		if(empty($before))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
		}
		$this->set(compact("ID","page","viewpage","before","after","beforeId","afterId"));
	}
}
?>