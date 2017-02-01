<?php echo $this->start("header");?>
<!-- HEADER -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li>
					<a href="<?php echo $settings["cms_url"]?>Account/Login" title="Login">
						<img src="<?php echo $this->webroot?>img/icons/topnav/profile.png" alt="loginBtn" />
						<span>Login</span>
					</a>
				</li>
            </ul>
        </div>
    </div>
</div>
<!-- HEADER -->
<?php echo $this->end();?>

<div class="loginWrapper" >
	<div class="loginLogo" style="text-align:center; height:auto; top:-100px;">
		<img src="<?php echo $this->webroot?>img/logo.png" alt="" width="120"/>
	</div>
    <div class="widget" style="height:auto; padding-bottom:10px; margin-top:100px; margin-bottom:50px;">
        <div class="title">
			<img src="<?php echo $this->webroot?>img/icons/dark/files.png" alt="files" class="titleIcon" />
			<h6>SIGN UP</h6>
		</div>
		<?php echo $this->Form->create("User",array("url"=>array("controller"=>"Account","action"=>"Register","?"=>"debug=0"),"class"=>"form"));?>
            <fieldset>
				<?php echo $this->Form->input("User.fullname",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Fullname",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"type"			=>	"text",
						"placeholder"	=>	"Johny Edward"
					)
				)?>
				<?php echo $this->Form->input("User.company",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Company",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"type"			=>	"text",
						"placeholder"	=>	"Coda, LTD."
					)
				)?>
				<?php echo $this->Form->input("User.username",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Username",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"type"			=>	"text",
						"placeholder"	=>	"johny27"
					)
				)?>
				<?php echo $this->Form->input("User.email",
					array(
						"div"			=>	array("class"=>"formRow"),
						"label"			=>	"Email",
						"between"		=>	'<div class="loginInput">',
						"after"			=>	"</div>",
						"type"			=>	"text",
						"placeholder"	=>	"johny@domain.com",
						"autocomplete"	=>	"off"
					)
				)?>
                <?php echo $this->Form->input("User.password",
					array(
						"div"		=>	array("class"=>"formRow"),
						"label"		=>	"Password",
						"between"	=>	'<div class="loginInput">',
						"after"		=>	"</div>",
						"type"		=>	"password",
						"placeholder"	=>	"Easy to remember and, hard to guess",
						"autocomplete"	=>	"off"
					)
				)?>
                
				<div class="body textC">
					<input class="wButton redwB ml15 m10" value="Register" type="submit" />
					<input class="wButton bluewB ml15 m10"  value="SIGN IN" type="button" onclick="location.href='<?php echo $settings["cms_url"]?>Account/Login'"/>
				</div>
            </fieldset>
		<?php echo $this->Form->end()?>
    </div>
</div>