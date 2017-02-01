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
            <h5>Contact Us</h5>
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
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Add"),'class' => 'form',"type"=>"file")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Upload new file</h6>
						</div>
						<?php
            ?>
						<?php
							echo $this->Form->input('title', array(
                'type'      =>  'text',
								'label'			=>	'Title',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('office_address', array(
                'label'     =>  'Address (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('hotel_address', array(
                'label'     =>  'Address (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('phone_number', array(
								'div' 			=>	'formRow',
                'label'     =>  'Phone Number (*)',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('faxx_number', array(
                'label'     => 'Fax Number',
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('email', array(
                'label'     =>  'Email (*)',
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('email_2', array(
                'label'     =>  'Email (*)',
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('google_map_frame', array(
                'label'     =>  'Emed Google Map (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'<span class="formNote"><a href="https://support.google.com/maps/answer/3544418?hl=en" target="_blank">How to embed map?</a></span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('status', array(
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
                'options' => array(0 => 'Not Active', 1 => 'Active'),
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

						?>

						<div class="formSubmit">
							<input type="submit" value="Add" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
							<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $settings["cms_url"].$ControllerName?>/Index'"/>
						</div>
					</div>
				</fieldset>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
