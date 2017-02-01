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
            <h5>Prizes</h5>
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
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Edit", $ID),'class' => 'form',"type"=>"file")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit Prize</h6>
						</div>
						<?php
            ?>
						<?php
              echo $this->Form->input('id');
							echo $this->Form->input('title', array(
                'type'      =>  'text',
								'label'			=>	'Title / Alt Text (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('web_page_type_id', array(
								'label'			=>	'Page Type',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
                'options'   =>  $webPageTypes,
                'empty'     =>  'Please choose',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('sub_title_1', array(
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('sub_title_2', array(
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('description', array(
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'</div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));

              echo $this->Form->input('sort', array(
                'type'      =>  'text',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight">',
								'after' 		=>	'<span class="formNote">Bigger number will come first.(1 - 999)</span></div>',
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
            <div class="formRow">
                <label>Imgae 1:</label>
                <div class="formRight">
                  <img src="<?php echo $detail['ImageThumb']['host'].$detail['ImageThumb']['url']; ?>?time=<?php echo time()?>" />
                </div>
            </div>
            <div class="formRow">
                <label>Upload File 1:</label>
                <div class="formRight">
                	<?php
                    echo $this->Form->file('image1', array(
                      'accept' => "image/gif, image/jpeg, image/png, image/gif"
                    ));
                  ?>
                  <span class="formNote">Min. Image Size 300x300 px</span>
                </div>
            </div>

						<div class="formSubmit">
							<input type="submit" value="Submit" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
							<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $settings["cms_url"].$ControllerName?>/Index'"/>
						</div>
					</div>
				</fieldset>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
