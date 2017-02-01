<?php echo $this->start("script");?>
<script>

</script>
<?php echo $this->end(); ?>
<?php
  echo $this->Session->flash();
?>
<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Import File</h5>
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
							<h6>Import file</h6>
						</div>
						<?php
              echo $this->Form->input('import_file_type_id', array(
                'label'			=>	'File Type',
                'div' 			=> 'formRow',
                'between'		=> '<div class="formRight">',
                'after' 		=> '</div>',
                "required"		=>	"",
                "autocomplete"	=>	"off",
                'options'	=>	$importFileTypes,
                'empty' => 'please choose',
                'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
              ));
            ?>

            <div class="formRow">
                <label>Upload File:</label>
                <div class="formRight">
                	<input type="file" id="ImportFileImage" name="data[ImportFile][image]" />
                </div>
            </div>

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
