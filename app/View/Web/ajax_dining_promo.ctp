<script>
$(document).ready(function(){
jQuery("img.lazy").lazy({
    chainable: false,
    bind: "event"
});
});
</script>

<style>
.kossanav {
  margin-left: 20px;
  margin-bottom: 20px;
}
.kossanav li a{
  color:rgb(255, 255, 255);
  font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
  text-transform: uppercase;
}
.kossanav li.active a{
  background-color: #f1331d;
}
</style>

<!-- Portfolio Grid Section -->

<section id="portfolio" style="background-image:url(<?php echo $onlineDiningPromoPage['ImageBig']['host'].$onlineDiningPromoPage['ImageBig']['url'] ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading" style="color:#fff;"><?php echo $onlineDiningPromoPage['WebPage']['title'] ?></h2>
              <h3 class="section-subheading text-muted"><?php echo $onlineDiningPromoPage['WebPage']['sub_title_1'] ?></h3>
            </div>
        </div>
        <div class="row">
          <ul class="nav nav-pills kossanav">
            <?php
              foreach($categories as $category) {
                if($category_id == $category['Category']['id']) {
                  ?>
                    <li role="presentation" class="active"><a href="javascript:void(0);" onclick="changeTab(<?php echo $category['Category']['id']; ?>)"><?php echo $category['Category']['name']; ?></a></li>
                  <?php
                } else {
                    ?>
                      <li role="presentation"><a href="javascript:void(0);" onclick="changeTab(<?php echo $category['Category']['id']; ?>)"><?php echo $category['Category']['name']; ?></a></li>
                    <?php
                }
              }
            ?>
          </ul>
        </div>
        <?php

        if(isset($totalItemSliderOnlineDining)) {
          $totalItemPerpage = $totalItemSliderOnlineDining;
        } else {
          $totalItemPerpage = 8;
        }

        $totalPage = ceil(count($onlineDiningPromos) / $totalItemPerpage);
        ?>
        <div id="carouselWiw" class="carousel slide" data-ride="carousel">
          <?php
            if($totalPage > 1) {
              ?>
              <ol class="carousel-indicators" style="z-index:100;position:relative">

                <?php

                  for($ctr = 0; $ctr < $totalPage; $ctr++) {
                    if($ctr == 0) {
                      ?>
                      <li data-target="#carouselWiw" data-slide-to="<?php echo $ctr ?>" class="active"></li>
                      <?php
                    } else {
                      ?>
                      <li data-target="#carouselWiw" data-slide-to="<?php echo $ctr ?>"></li>
                      <?php
                    }
                  }

                ?>
              </ol>
              <?php
            }
          ?>
          <div class="carousel-inner row" role="listbox">

            <?php
              for($ctr = 0; $ctr < count($onlineDiningPromos); $ctr++) {
                if($ctr % $totalItemPerpage == 0 && $ctr == 0) {
                  ?>
                    <div class="item active">
                  <?php
                } else if($ctr % $totalItemPerpage == 0){
                  ?>
                    <div class="item">
                  <?php
                }

                ?>
                <div class="col-md-3 col-sm-6 portfolio-item" style="min-height:300px;">
                    <a href="#portfolioModal<?php echo $onlineDiningPromos[$ctr]['OnlineDiningPromo']['id'] ?>" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="" data-src="<?php echo $onlineDiningPromos[$ctr]['ImageThumb']['host'].$onlineDiningPromos[$ctr]['ImageThumb']['url']; ?>" class="lazy img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo $onlineDiningPromos[$ctr]['OnlineDiningPromo']['title']; ?></h4>
                        <p class="text-muted"><?php echo $onlineDiningPromos[$ctr]['OnlineDiningPromo']['sub_title']; ?></p>
                    </div>
                </div>
                <?php

                $afterThisCtr = $ctr + 1;
                if($afterThisCtr % $totalItemPerpage == 0 || $ctr == count($onlineDiningPromos) - 1) {
                  ?>
                    </div>
                  <?php
                }

              }
            ?>
          </div>

          <?php
            if($totalPage > 1) {
              ?>
                <a class="left carousel-control" href="#carouselWiw" role="button" data-slide="prev" style="left:-110px;">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carouselWiw" role="button" data-slide="next" style="right:-80px;">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              <?php
            }
          ?>

        </div>
    </div>
</section>

<!-- Portfolio Modals -->
<?php
  foreach($onlineDiningPromos as $onlineDiningPromo) {
    ?>
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $onlineDiningPromo['OnlineDiningPromo']['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2><?php echo $onlineDiningPromo['OnlineDiningPromo']['title']; ?></h2>
                            <p class="item-intro text-muted"><?php echo $onlineDiningPromo['OnlineDiningPromo']['sub_title']; ?></p>
                            <img class="lazy img-responsive img-centered" src="" data-src="<?php echo $onlineDiningPromo['ImageBig']['host'].$onlineDiningPromo['ImageBig']['url']; ?>" alt="">
                            <p><?php echo nl2br($onlineDiningPromo['OnlineDiningPromo']['description']); ?></p>
                            <p>
                                You can visit <a href="<?php echo $onlineDiningPromo['OnlineDiningPromo']['web_url']; ?>"><?php echo $onlineDiningPromo['OnlineDiningPromo']['web_text']; ?></a></p>
                            <ul class="list-inline">
                                <li>Promo Date: <?php echo $onlineDiningPromo['OnlineDiningPromo']['promo_date_text']; ?> |</li>
                                <li>For <?php echo $onlineDiningPromo['OnlineDiningPromo']['for_text']; ?> </li>

                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
  }
?>
