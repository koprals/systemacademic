<?php echo $this->start("script");?>
<script>
$(document).ready(function(){
	$("#uniform-WebPageWebPageTypeId").css("width","280px");
	$("#uniform-WebPageWebPageTypeId span").css("width","280px");
	$("#uniform-WebPageWebPageTypeId select").css("width","290px");
});
</script>
<?php echo $this->end(); ?>
<?php
  echo $this->Session->flash();
?>
<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>About Us</h5>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser">
					<a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a>
				</li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
	<div class="fluid">
		<div class="users form span10">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Index"),'class' => 'form',"type"=>"file","novalidate")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit About Us</h6>
						</div>
						<?php
            ?>
						<?php
              echo $this->Form->input('id');
							echo $this->Form->input('title', array(
                'type'      =>  'text',
								'label'			=>	'Title(*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('web_page_type_id', array(
								'label'			=>	'Page Type (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'options'  	 	=>  $webPageTypes,
								'empty'     	=>  'Please choose',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
			
			  echo $this->Form->input('description', array(
								'label'			=>	'Description (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span12">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"style"			=>	"height:300px;",
								"type"			=>	"textarea",
								"escape"		=>	false,
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>
						
            <div class="formRow">
                <label>Image :</label>
                <div class="formRight">
                  <a href="<?php echo $detail['ImageBig']['host'].$detail['ImageBig']['url']; ?>?time=<?php echo time()?>" rel="lightbox" title="About Us">
				  	<img src="<?php echo $detail['ImageThumb']['host'].$detail['ImageThumb']['url']; ?>?time=<?php echo time()?>" />
				  </a>
                </div>
            </div>
			
			<?php
				echo $this->Form->input('image1', array(
					'label'			=> 'Upload File',
					'div' 			=> 'formRow',
					'between'		=> '<div class="formRight">',
					'after' 		=> '&nbsp;(Width: 800px, Height: 800px)</div>',
					'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
					"type"			=>	"file",
					"required"		=>	"",
					'accept' 		=> "image/gif, image/jpeg, image/png, image/gif"
				));
			?>
			<?php
			 /*echo $this->Form->input('status', array(
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
                'options' => array(0 => 'Not Active', 1 => 'Active'),
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));*/
			?>

						<div class="formSubmit">
							<input type="submit" value="Edit" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
						</div>
					</div>
				</fieldset>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
