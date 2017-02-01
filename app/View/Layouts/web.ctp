<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><h1><?php echo $profile["Pasien"]["name"]?></h1></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>

	<?php echo $this->Html->meta('icon',$this->webroot."img/favicon.ico",array("type"=>"ico"));?>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->webroot ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $this->webroot ?>css/web-bedrock.css" rel="stylesheet">
    <link href="<?php echo $this->webroot ?>css/prettyPhoto.css" rel="stylesheet">

    <link href="<?php echo $this->webroot ?>css/reset.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	 <!-- jQuery -->
    <script src="<?php echo $this->webroot ?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->webroot ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->webroot ?>js/jquery.prettyPhoto.js"></script>

    <!-- Menu Toggle Script -->
    <script>
	$(document).ready(function(){
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	});
    </script>

    <?php
      //BLOCK JAVASCRIPT
      echo $this->fetch('script');
      echo $this->fetch('css');
    ?>

    <script>
    $(document).ready(function(){
      var windowHeight = $(window).height();
      var placeholderHeight = windowHeight - 615;
      $(".placeholder").css("height", placeholderHeight + "px");

      //cari height inner menu nya nih.
      var innerMenuHeight = $(".innerMenu ul").height();
      $(".innerMenu").css("height", (innerMenuHeight) + 23);

    });
    </script>

</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="overflow-x:hidden;">
            <div class="logo">
              <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Index')) ?>">
                <img width="120" height="120" src="<?php echo $this->webroot ?>img/logo_bedrock.jpg" />
              </a>
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Index')) ?>"><?php echo $profile["Pasien"]["name"]?></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Reservations')) ?>">Reservations</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'SpecialOffers')) ?>">Special Offers</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'PhotoGalleries')) ?>">Photo Gallery</a>
                </li>
				        <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'ContactUs')) ?>">Contact Us</a>
                </li>
            </ul>

            <div class="footer" style="margin-top:40px;">

              <?php if(!empty($contacts['office_address'])):?>
			  <div class="item">
                <h4>Office</h4>
                <p>
                  <?php echo nl2br($contacts['office_address'])?>

				  <?php if(!empty($contacts['phone_number'])):?>
				   <br/>
				   Phone : <?php echo nl2br($contacts['phone_number'])?>
				  <?php endif;?>

				  <?php if(!empty($contacts['faxx_number'])):?>
				  <br/>
				   Fax : <?php echo nl2br($contacts['faxx_number'])?>
				  <?php endif;?>
                </p>
              </div>
			  <br/>
			  <?php endif;?>
			  <?php if(!empty($contacts['hotel_address'])):?>
              <div class="item">
                <h4>Hotel</h4>
                <p>
                 <?php echo nl2br($contacts['hotel_address'])?>
                 <?php if(!empty($contacts['hotel_phone_number'])):?>
				  <br/>
				  Phone : <?php echo nl2br($contacts['hotel_phone_number'])?>
				 <?php endif;?>
				 <?php if(!empty($contacts['hotel_fax_number'])):?>
                  <br/>
				  Fax : <?php echo nl2br($contacts['hotel_fax_number'])?>
				 <?php endif;?>
                </p>
              </div>
			  <br/>
			  <?php endif;?>
			  <?php if(!empty($contacts['email']) && !empty($contacts['email_2'])):?>
              <div class="item">
                <h4>Email</h4>
                <p>
				  <?php if(!empty($contacts['email'])):?>
                  <?php echo nl2br($contacts['email'])?>
				  <?php endif;?>
				  <?php if(!empty($contacts['email_2'])):?>
				  <br>
                  <?php echo nl2br($contacts['email_2'])?>
				  <?php endif;?>
                </p>
              </div>
			  <?php endif;?>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <?php echo $this->fetch('content'); ?>
		<?php echo $this->element('sql_dump'); ?>
    </div>
    <!-- /#wrapper -->



</body>

</html>
