<?php echo $this->start("script");?>
<script src="<?php echo $this->webroot?>wysiwyg/minified/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript">
      	// When the document is ready
        $(document).ready(function () {
        $('#ttl').datepicker({
          dateFormat:"yy-mm-dd",
					yearRange: '-100:+0',
					changeMonth: true,
      		changeYear: true
        });
    });
</script>
<?php echo $this->end();?>

<?php echo $this->start("css");?>
<?php echo $this->end();?>

<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Add New Doctor</h5>
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
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Add"),'class' => 'form',"type"=>"file","novalidate")); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Add new doctor</h6>
						</div>

						<?php
							echo $this->Form->input('code', array(
								'label'			=>	'Kode Dokter (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span4">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
								"type"			=>	"text",
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

            <?php
							echo $this->Form->input('username', array(
								'label'			=>	'Username (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight"><span class="span4">',
								'after' 		=> '</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"maxlength"		=>	20,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

            <?php
							echo $this->Form->input('password', array(
								'label'			=> 'Password (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight"><span class="span4">',
								'after' 		=> '</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"maxlength"		=>	16,
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

						<?php
							echo $this->Form->input('fullname', array(
								'label'			=>	'Nama (*)',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span4">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
								"type"			=>	"text",
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

						<?php
							echo $this->Form->input('address', array(
								'label'			=>	'Alamat',
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
							echo $this->Form->input('gender', array(
								'label'			=> 'Jenis Kelamin',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> false,
								'options' 		=> array("0"=>"Laki-Laki","1"=>"Perempuan")
							));
						?>

						<?php
							echo $this->Form->input('phone', array(
								'label'			=>	'No. Telefon',
								'div' 			=>	'formRow',
								'between'		=>	'<div class="formRight"><span class="span4">',
								'after' 		=>	'</span></div>',
								"required"		=>	"",
								"autocomplete"	=>	"off",
								"escape"		=>	false,
								"type"			=>	"text",
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>

            <?php
							echo $this->Form->input('status', array(
                'type'      => 'hidden',
								'label'			=> 'Status',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> false,
                'default'   => 1,
								'options' 	=> array("0"=>"Not Active","1"=>"Active")
							));
						?>

						<div class="formSubmit">
							<input type="submit" value="Add" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
							<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $settings["cms_url"].$ControllerName?>/Index'"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
