<!-- Page Content -->
<div id="page-content-wrapper">
  <div id="main-content">
    <div class="container-fluid">
        <?php
          echo $this->element('header_reservation');
        ?>
        <?php
          echo $this->element('header_navigation', array(
            "active" => ""
          ));
        ?>
        <div class="row">
          <div class="col-md-10 col-md-offset-1 diningCarousel" >
            <?php
              echo $this->element('slider_advertisement');
            ?>
          </div>
        </div>
        <div class="row innerMenuHr">
          <div class="col-md-10 col-md-offset-1 text-center">
            <div class="innerMenuTitle">
              <h1>Contact Us</h1>
            </div>
          </div>
        </div>
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>Bedrock Hotel</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-lg-9" style="padding:0 10px 0 0;">
                    <?php echo $contacts['google_map_frame']; ?>
                </div>
                <div class="col-lg-3">
					<?php if(!empty($contacts['hotel_phone_number'])):?>
                    <p><strong>Phone:</strong><br />
                        <?php echo $contacts['hotel_phone_number']; ?>
                    </p>
					<?php endif;?>
					
					<?php if(!empty($contacts['email']) && !empty($contacts['email_2'])):?>
                    <p>
						<strong>Email:</strong>
						<br />
						<a href="mailto:<?php echo $contacts['email']; ?>">
							<?php echo $contacts['email']; ?>
						</a>
						
						<?php if(!empty($contacts['email_2']) && !empty($contacts['email_2'])):?>
							<br/>
							<a href="mailto:<?php echo $contacts['email_2']; ?>">
								<?php echo $contacts['email_2']; ?>
							</a>
						<?php endif;?>
                    </p>
					<?php endif;?>
					<?php if(!empty($contacts['office_address'])):?>
						<p><strong>Office:</strong><br />
						  <?php echo $contacts['office_address']; ?>
						</p>
					<?php endif;?>
					<?php if(!empty($contacts['hotel_address'])):?>
                    <p><strong>Hotel:</strong><br />
                      <?php echo $contacts['hotel_address']; ?>
                    </p>
					<?php endif;?>
                </div>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>

        
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <div class="row footer">
          <?php echo $this->element('footer_sosmed'); ?>
        </div>
    </div>
  </div>
</div>