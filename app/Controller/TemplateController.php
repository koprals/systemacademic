<?php
class TemplateController extends AppController
{
	public $components	=	array("Paginator");

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout	=	"ajax";
	}
	public function LeftMenu($lft_menu_category_id=1)
	{
		$this->loadModel("CmsMenu");
		$this->CmsMenu->BindDefault();
		$menu			=	$this->CmsMenu->find("all",array(
								'order' 		=> 	array('CmsMenu.sort asc'),
								"conditions"	=>	array(
									"CmsMenu.status"	=>	"1"
								)
							));
		$this->set(compact("menu","lft_menu_category_id"));
	}

	function LeftMenuSmall()
	{
		$this->loadModel("CmsMenu");
		$this->CmsMenu->BindDefault();
		$admin_level	=	$this->profile["User"]["user_level"];
		$menu			=	$this->CmsMenu->find("all",array(
								'order' => array('CmsMenu.sort asc'),
								"conditions"	=>	array(
									"CmsMenu.status"	=>	"1"
								)
							));
		$this->set(compact("menu","lft_menu_category_id"));
	}


	//untuk perhitungan point untuk leader board nya. harusnya tinggal tembak aja ke dalam sini nih.

	function reCountLeaderboards() {
		$this->autoRender = false;
		$this->loadModel("User");

		$queryReCount = "
		create temporary table tmp_leaderboards (rank integer primary key auto_increment, passcode VARCHAR(10), points integer)
		select passcode, points from users order by points desc;

		delete from leaderboards;
		insert into leaderboards (rank, passcode, points)
		  select rank, passcode, points from tmp_leaderboards;

		drop table tmp_leaderboards;";

		$this->User->query($queryReCount);

	}

}
?>
