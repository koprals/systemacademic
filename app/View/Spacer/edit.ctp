<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Edit <?php echo $ModelName?></h5>
            <span><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>

<div class="line"></div>

<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">
		<?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Edit",$ID,"?"=>"debug=1"),'class' => 'form')); ?>
		<?php
			echo $this->Form->input('id', array(
				'type'		=>	'hidden',
				'readonly'	=>	'readonly',
			));
		?>
			<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit <?php echo ucfirst($ModelName)?></h6>
						</div>
						<?php
							echo $this->Form->input('name', array(
								'label'			=>	'Name (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Spacer Name'
							));
						?>
						<?php
							echo $this->Form->input('file', array(
								'label'			=> 'Sound Preview (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '&nbsp;(*.mp3 Only)</div><br>
								<object type="application/x-shockwave-flash" data="'.$this->webroot.'player/dewplayer-mini.swf?mp3='.$detail["Detail"]["host"].$detail["Detail"]["url"].'?time='.time().'" width="160" height="20" id="dewplayer-mini">
								<param name="wmode" value="transparent" />
								<param name="movie" value="'.$detail["Detail"]["host"].$detail["Detail"]["url"].'?time='.time().'" />
								</object>
								',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"type"			=>	"file"
							));
						?>
						<?php
							echo $this->Form->input('status', array(
								'label'			=> 'Status (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> false,
								"default"		=> "1",
								'options' 		=> array("0"=>"Not Active","1"=>"Active")
							));
						?>
						<div class="formSubmit">
							<input type="submit" value="Edit" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>