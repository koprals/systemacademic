<?php echo $this->start("script");?>
<script>
$(document).ready(function(){
  changeFileType();
});

function changeFileType() {

  if($("#FileFileType").val() == "video") {
    $("#videoUrlDiv").show();
  } else {
    $("#videoUrlDiv").hide();
  }
}

</script>
<?php echo $this->end(); ?>
<?php
  echo $this->Session->flash();
?>
<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Settings</h5>
        </div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
	<div class="fluid">
		<div class="users form span10">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Edit", $ID),'class' => 'form',"type"=>"file")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit Setting</h6>
						</div>
						<?php
            ?>
						<?php
              echo $this->Form->input('id', array('type'  =>  'hidden'));
              echo $this->Form->input('site_name', array(
                'type'      =>  'text',
								'label'			=>	'Site Name',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
              echo $this->Form->input('site_title', array(
                'type'      =>  'text',
								'label'			=>	'Site Title',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
              echo $this->Form->input('site_description', array(
                'type'      =>  'text',
								'label'			=>	'Site Description',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('facebook_url', array(
                'type'      =>  'text',
								'label'			=>	'Facebook (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('gplus_url', array(
                'type'      =>  'text',
								'div' 			=>	'formRow',
                'label'     =>  'Google Plus',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('twitter_url', array(
								'div' 			=>	'formRow',
                'label'     =>  'Twitter',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('instagram_url', array(
                'type'      =>  'text',
                'label'     =>  'Instagram',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
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
