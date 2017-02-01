<?php echo $this->start("header");?>
<!-- HEADER -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            &nbsp;
        </div>
    </div>
</div>
<!-- HEADER -->
<?php echo $this->end();?>

<div class="loginWrapper" >
    <div class="widget" style="height:auto; padding-bottom:10px;">
        <div class="title">
			<img src="<?php echo $this->webroot?>img/icons/dark/files.png" alt="files" class="titleIcon" />
			<h6>CHOOSE ACCOUNT</h6>
		</div>
		<div class="statsRow" style="margin-bottom:20px;">
			<div class="wrapper">
				<div class="controlB">
					<ul>
						<?php foreach($profile["Group"] as $Group):?>
						<li>
							<a href="<?php echo $settings["web_url"]?>Account/ChooseAccount/<?php echo $Group["id"]?>" title="">
								<img src="<?php echo $this->webroot?>img/icons/control/32/plus.png" alt="" />
								<span><?php echo $Group["name"]?></span>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
    </div>
</div>