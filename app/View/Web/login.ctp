<?php echo $this->start('header');?>
<!-- HEADER -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li>
					<a href="#">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</a>
				</li>
            </ul>
        </div>
    </div>
</div>
<!-- HEADER -->
<?php echo $this->end();?>

<div class="loginWrapper" >
	<div class="loginLogo" style="margin-left:-90px; margin-top:-80px;">
		<img src="<?php echo $this->webroot?>img/logo.png" alt="" width="150"/>
	</div>
    <div class="widget" style="height:auto;">
        <div class="title">
			<img src="<?php echo $this->webroot?>img/icons/dark/files.png" alt="files" class="titleIcon" />
			<h6>SIGN IN PASIEN</h6>
		</div>
		<?php echo $this->Form->create("Pasien",array("url"=>array("controller"=>"Web","action"=>"Login","?"=>"debug=0"),"class"=>"form"));?>
            <fieldset>
			<?php echo $this->Form->input("username",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Username",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"autocomplete"	=>	"off",
						"type"			=>	"text"
					)
				)?>
                <?php echo $this->Form->input("password",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Password",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"autocomplete"	=>	"off",
						"type"			=>	"password"
					)
				)?>
				<div class="body textC">
					<input class="wButton redwB ml15 m10" value="Log In" type="submit" />
          <a href="<?php echo $settings["cms_url"] ?>Account/Login" title="Log as admin" class="button blueB" style="margin: 5px;"><span>LOG AS ADMIN</span></a>
				</div>
            </fieldset>
		<?php echo $this->Form->end()?>
    </div>
</div>
<div id="footer">
    <!--div class="wrapper"><a href="http://www.centroone.com" title="" target="_blank">Centro Media Indonesia</a></div-->
</div>
