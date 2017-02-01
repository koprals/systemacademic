<?php
class Route extends AppModel
{
	function afterSave($created,$options = array())
	{
		$Settings		=	ClassRegistry::Init("Setting");
		$setting		=	$Settings->find("first");
		$fileLocation	=	$setting['Setting']['path_web']."app/Config/routes.php";
		
		$data			=	$this->find("all",array(
								"order"	=>	array(
									"id"	=>	"asc"
								)
							));
		
		$start			=	"";
		foreach($data as $data)
		{
			$param	=	"";
			if(!empty($data[$this->name]["param"]))
			{
				$param							=	explode(",",$data[$this->name]["param"]);
				$param							=	array_map(function($val){return "'".$val."'";},$param);
				$param							=	implode(",",$param);
				$param							=	",".$param;
			}	
			
			$start	.=	"Router::connect('".$data[$this->name]["name"]."', array('controller' => '".$data[$this->name]["controller"]."', 'action' => '".$data[$this->name]["action"]."'".$param."));\n";
		}
		$ending			=	"\nCakePlugin::routes();\nrequire CAKE . 'Config' . DS . 'routes.php';\nRouter::parseExtensions('pdf', 'json');";
		
		if (is_writable($fileLocation))
		{
			if (!$handle = fopen($fileLocation, 'wb')) {
				 return true;
			}
			if (fwrite($handle,"<?php\n\n".$start.$ending) === FALSE) {
				return true;
			}
			fclose($handle);
		}
	}
	
	public function afterDelete()
	{
		$Settings		=	ClassRegistry::Init("Setting");
		$setting		=	$Settings->find("first");
		$fileLocation	=	$setting['Setting']['path_web']."app/Config/routes.php";
		
		$data			=	$this->find("all",array(
								"order"	=>	array(
									"id"	=>	"asc"
								)
							));
		
		$start			=	"";
		foreach($data as $data)
		{
			$param	=	"";
			if(!empty($data[$this->name]["param"]))
			{
				$param							=	explode(",",$data[$this->name]["param"]);
				$param							=	array_map(function($val){return "'".$val."'";},$param);
				$param							=	implode(",",$param);
				$param							=	",".$param;
			}	
			
			$start	.=	"Router::connect('".$data[$this->name]["name"]."', array('controller' => '".$data[$this->name]["controller"]."', 'action' => '".$data[$this->name]["action"]."'".$param."));\n";
		}
		$ending			=	"\nCakePlugin::routes();\nrequire CAKE . 'Config' . DS . 'routes.php';\nRouter::parseExtensions('pdf', 'json');";
		
		if (is_writable($fileLocation))
		{
			if (!$handle = fopen($fileLocation, 'wb')) {
				 return true;
			}
			if (fwrite($handle,"<?php\n\n".$start.$ending) === FALSE) {
				return true;
			}
			fclose($handle);
		}
	}
}
?>