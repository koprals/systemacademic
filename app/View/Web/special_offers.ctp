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
              <h1>Special Offers</h1>
            </div>
          </div>
        </div>
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <?php
          echo $this->element('middle_content_page', array(
            'page' => $page
          ));
        ?>

        <?php
          if(isset($specialOffers) && count($specialOffers) > 0) {
            ?>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php
                    foreach($specialOffers as $ctr => $specialOffer) {
                      ?>
                      <div class="panel panel-default bedrock-accordion">
                        <div class="panel-heading" role="tab" id="heading<?php echo $ctr ?>">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ctr; ?>" aria-expanded="true" aria-controls="collapse<?php echo $ctr; ?>">
                              <?php echo $specialOffer['SpecialOffer']['name']; ?>
                              <span style="float:right"><img src="<?php echo $this->webroot ?>img/btn_arrow_bawah.png" /></span>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $ctr; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $ctr ?>">
                          <div class="panel-body">
                            <p>
                              <img src="<?php echo $specialOffer['ImageThumb']['host'].$specialOffer['ImageThumb']['url']; ?>?time=<?php echo time()?>"  class="img-responsive img-red-white-border" style="float:left;display:inline;margin:20px;" />
                              <?php echo nl2br($specialOffer['SpecialOffer']['description']); ?>
                            </p>
                            <div class="clearfix"></div>
                            <span style="float:right"><?php echo $this->Number->currency($specialOffer['SpecialOffer']['price'], 'IDR') ?><a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Reservations'));?>" class="button-book-now"><span>Book Now</span></a></span>
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
            <?php
          }
        ?>
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <div class="row footer">
          <?php echo $this->element('footer_sosmed'); ?>
        </div>
    </div>
  </div>
</div>
<!-- /#page-content-wrapper -->
