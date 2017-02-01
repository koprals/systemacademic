<?php echo $this->start("script");?>
<script src="<?php echo $this->webroot?>wysiwyg/minified/jquery.sceditor.bbcode.min.js"></script>
<script>
	$(document).ready(function() {
	});
</script>
<?php echo $this->end();?>

<?php echo $this->start("css");?>
<?php echo $this->end();?>

<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Edit Medical Record</h5>
			<span><?php echo $detail[$ModelName]["name"]?></span>
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
			<?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Edit", $ID,$page,$viewpage),'class' => 'form','novalidate')); ?>
				<?php
					echo $this->Form->input('id', array(
						'type'			=>	'hidden',
						'readonly'		=>	'readonly'
					));
				?>

				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit - Medical Record </h6>
						</div>

						<?php
							echo $this->Form->input('doctor_id', array(
								'label'			=> 'Nama Doctor',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> false,
								'options' 		=> $find_doctor
							));
						?>

            <?php
							echo $this->Form->input('pasien_id', array(
								'label'			=> 'Nama Pasien',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> false,
								'options' 		=> $find_pasien
							));
						?>

            <?php
							echo $this->Form->input('keluhan', array(
								'label'			=>	'Keluhan',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span12">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"style"			=>	"height:200px;",
								"type"			=>	"textarea",
								"escape"		=>	false,
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

            <?php
							echo $this->Form->input('diagnosa', array(
								'label'			=>	'Diagnosa',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span12">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"style"			=>	"height:200px;",
								"type"			=>	"textarea",
								"escape"		=>	false,
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

						<div class="formSubmit">
							<input type="submit" value="Edit" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
							<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $settings["cms_url"].$ControllerName?>/Index'"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
