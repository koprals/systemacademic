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
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
	<div class="fluid">
		<div class="users form span10">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Edit", $ID),'class' => 'form',"type"=>"file","novalidate")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit Contact Us</h6>
						</div>
						<?php
            ?>
            <?php
              

              echo $this->Form->input('office_address', array(
                'label'     =>  'Office Address (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
			  
			  echo $this->Form->input('phone_number', array(
								'div' 			=>	'formRow',
                				'label'    	 	=>  'Office Phone Number (*)',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('faxx_number', array(
               					'label'     	=>  'Office Fax Number (*)',
                				'type'      	=>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('hotel_address', array(
                'label'     =>  'Hotel Address (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              
			  echo $this->Form->input('hotel_phone_number', array(
								'div' 			=>	'formRow',
                				'label'    	 	=>  'Hotel Phone Number (*)',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('hotel_fax_number', array(
               					'label'     	=>  'Hotel Fax Number (*)',
                				'type'      	=>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
							
              echo $this->Form->input('email', array(
                'label'     =>  'Primary Email (*)',
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('email_2', array(
                'label'     =>  'Secondary Email',
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"type"			=>	"text",
								"escape"		=>	false,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('google_map_frame', array(
                'label'     =>  'Embed Google Map (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'<span class="formNote"><a href="https://support.google.com/maps/answer/3544418?hl=en" target="_blank">How to embed map?</a></span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
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
