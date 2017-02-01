
<?php echo $this->start("script");?>
<script>
	$(document).ready(function() {
		
	});
</script>
<?php echo $this->end();?>


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
              <h1>Photo Gallery</h1>
            </div>
          </div>
        </div>
        <div class="clearfix" style="height:20px;">
          <br>
        </div>
        <?php
          echo $this->element('middle_content_page', array(
            'page' => $page
          ));
        ?>

        <?php
          if(isset($photoGalleries) && count($photoGalleries) > 0) {
            ?>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php
                    foreach($photoGalleries as $ctr => $photoGallery) {
                      ?>
                      <div class="panel panel-default bedrock-accordion">
                        <div class="panel-heading" role="tab" id="heading<?php echo $ctr ?>">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ctr; ?>" aria-expanded="true" aria-controls="collapse<?php echo $ctr; ?>">
                              <?php echo $photoGallery['PhotoGallery']['name']; ?>
                              <span style="float:right"><img src="<?php echo $this->webroot ?>img/btn_arrow_bawah.png" /></span>
                            </a>
                          </h4>
                        </div>
						
                        <div id="collapse<?php echo $ctr; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $ctr ?>">
                          <div class="panel-body">
						  	  <?php if(!empty($photoGallery["PhotoGalleryImage"])):?>
                              <?php foreach($photoGallery["PhotoGalleryImage"] as $k => $PhotoGalleryImage):?>
							  <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="margin-bottom:30px;">
                                  <a rel="prettyPhoto[gallery1]" title="Photo - <?php echo ($k+1)?>" href="<?php echo $PhotoGalleryImage['ImageBig']['host'].$PhotoGalleryImage['ImageBig']['url']; ?>?time=<?php echo time()?>" style="border:0px;">
                                      <img class="img-responsive img-red-white-border" src="<?php echo $PhotoGalleryImage['ImageThumb']['host'].$PhotoGalleryImage['ImageThumb']['url']; ?>?time=<?php echo time()?>" alt="">
                                  </a>
                              </div>
							  <?php endforeach;?>
							  <script>
								$("#collapse<?php echo $ctr; ?>").find("a[rel^='prettyPhoto']").prettyPhoto({social_tools :'',animation_speed:'normal',slideshow:3000, autoplay_slideshow: true});
								</script>
							  <?php else:?>
							  <p>No photo found!</p>
							  <?php endif;?>
                            <div class="clearfix"></div>
							
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
