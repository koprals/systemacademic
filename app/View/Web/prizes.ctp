<?php echo $this->start("script");?>
<script>
$(document).ready(function(){

});

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "prizesActive" => "active"
));
?>
<!-- Prizes Section -->
<section id="prize" style="background-image:url(<?php echo $prizePage['ImageBig']['host'].$prizePage['ImageBig']['url'] ?>);">
    <div class="container" style="background-color:rgba(255,255,255,.7);border-radius:30px;padding:30px;">
        <div class="row">
         <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo $prizePage['WebPage']['title']; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $prizePage['WebPage']['sub_title_1']; ?></h3>
            </div>
        </div>
        <div class="row">
            <?php
              if(isset($dailyPrize) && !empty($dailyPrize)) {
                ?>
                <div class="col-sm-4">
                    <div class="team-member">
                         <a href="#prizemodal<?php echo $dailyPrize['Prize']['id'] ?>" class="portfolio-link" data-toggle="modal"><img src="" data-src="<?php echo $dailyPrize['ImageThumb']['host'].$dailyPrize['ImageThumb']['url'] ?>" class="img-responsive img-circle lazy" alt=""></a>

                         <h4><?php echo strtoupper($dailyPrize['PrizeType']['name']); ?></h4>
                         <p class="text-muted"><strong><?php echo $dailyPrize['Prize']['sub_title_1'] ?><a><br><?php echo $dailyPrize['Prize']['sub_title_2'] ?></a></strong></p>
                    </div>
                </div>
                <?php
              }
            ?>
            <?php
              if(isset($weeklyPrize) && !empty($weeklyPrize)) {
                ?>
                <div class="col-sm-4">
                    <div class="team-member">
                         <a href="#prizemodal<?php echo $weeklyPrize['Prize']['id'] ?>" class="portfolio-link" data-toggle="modal"><img src="" data-src="<?php echo $weeklyPrize['ImageThumb']['host'].$weeklyPrize['ImageThumb']['url'] ?>" class="img-responsive img-circle lazy" alt=""></a>

                         <h4><?php echo strtoupper($weeklyPrize['PrizeType']['name']); ?></h4>
                         <p class="text-muted"><strong><?php echo $weeklyPrize['Prize']['sub_title_1'] ?><a><br><?php echo $weeklyPrize['Prize']['sub_title_2'] ?></a></strong></p>
                    </div>
                </div>
                <?php
              }
            ?>
            <?php
              if(isset($grandPrize) && !empty($grandPrize)) {
                ?>
                <div class="col-sm-4">
                    <div class="team-member">
                         <a href="#prizemodal<?php echo $grandPrize['Prize']['id'] ?>" class="portfolio-link" data-toggle="modal"><img src="" data-src="<?php echo $grandPrize['ImageThumb']['host'].$grandPrize['ImageThumb']['url'] ?>" class="img-responsive img-circle lazy" alt=""></a>

                         <h4><?php echo strtoupper($grandPrize['PrizeType']['name']); ?></h4>
                         <p class="text-muted"><strong><?php echo $grandPrize['Prize']['sub_title_1'] ?><a><br><?php echo $grandPrize['Prize']['sub_title_2'] ?></a></strong></p>
                    </div>
                </div>
                <?php
              }
            ?>
        </div>
        <div class="row">
            <!--div class="col-lg-12">
             <div style="background-color:rgba(255,255,255,0.9);width:100%;height:100px;padding-top:10px;border-radius:20px;">

                 <div class="col-lg-6 text-right">Join HSBC Daytripper, a game that challenge you to  collect 4 unique badges by spending your HSBC card in our partner merchant, and win a special e-voucher from HSBC. CLick this banner for further <br>info of our merchant partners</div>
                <div class="col-lg-6 text-right"><img src="<?php echo $this->webroot ?>img/bannertripper2.png"> </div>

             </div>

             <br>
           </div-->

           <div class="col-lg-8 col-lg-offset-2 text-center">
           <a href="#"><img src="<?php echo $this->webroot ?>img/sharetwit.png"></a>
           <a href="#"><img src="<?php echo $this->webroot ?>img/shareface.png"></a>
           </div>
        </div>
        <!--
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center" style="color:#fff;">
                <p class="large">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
            </div>
        </div>
        -->
    </div>
</section>


<?php
  if(isset($dailyPrize) && !empty($dailyPrize)) {
    ?>
    <!-- prize Modal 1 -->
    <div class="portfolio-modal modal fade" id="prizemodal<?php echo $dailyPrize['Prize']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2><?php echo strtoupper($dailyPrize['PrizeType']['name']); ?></h2>
                            <p class="item-intro text-muted"><?php echo $dailyPrize['Prize']['title']; ?></p>
                            <div id="carouselDailyPrize" class="carousel slide" data-ride="carousel">
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <?php
                                  if(!empty($dailyPrize['ImageBig']['url'])) {
                                    ?>
                                    <div class="item active">
                                      <img class="img-responsive img-centered" src="<?php echo $dailyPrize['ImageBig']['host'].$dailyPrize['ImageBig']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($dailyPrize['Image2']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $dailyPrize['Image2']['host'].$dailyPrize['Image2']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($dailyPrize['Image3']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $dailyPrize['Image3']['host'].$dailyPrize['Image3']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <!-- Left and right controls -->
                              <a class="left carousel-control" href="#carouselDailyPrize" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carouselDailyPrize" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <p><?php echo nl2br($dailyPrize['Prize']['description']); ?></p>
                            <p><?php echo $dailyPrize['Prize']['sub_title_1'] ?><a href="#">&nbsp; <?php echo $dailyPrize['Prize']['sub_title_2'] ?></a></p>
                            <!--<ul class="list-inline">
                                <li>Promo Date: until July 2015 |</li>
                                <li>For HSBC Gold Only </li>

                            </ul>-->
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

<?php
  if(isset($weeklyPrize) && !empty($weeklyPrize)) {
    ?>
    <!-- prize Modal 1 -->
    <div class="portfolio-modal modal fade" id="prizemodal<?php echo $weeklyPrize['Prize']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2><?php echo strtoupper($weeklyPrize['PrizeType']['name']); ?></h2>
                            <p class="item-intro text-muted"><?php echo $weeklyPrize['Prize']['title']; ?></p>
                            <div id="carouselWeeklyPrize" class="carousel slide" data-ride="carousel">
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <?php
                                  if(!empty($weeklyPrize['ImageBig']['url'])) {
                                    ?>
                                    <div class="item active">
                                      <img class="img-responsive img-centered" src="<?php echo $weeklyPrize['ImageBig']['host'].$weeklyPrize['ImageBig']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($weeklyPrize['Image2']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $weeklyPrize['Image2']['host'].$weeklyPrize['Image2']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($weeklyPrize['Image3']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $weeklyPrize['Image3']['host'].$weeklyPrize['Image3']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <!-- Left and right controls -->
                              <a class="left carousel-control" href="#carouselWeeklyPrize" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carouselWeeklyPrize" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <p><?php echo nl2br($weeklyPrize['Prize']['description']); ?></p>
                            <p><?php echo $weeklyPrize['Prize']['sub_title_1'] ?><a href="#">&nbsp; <?php echo $weeklyPrize['Prize']['sub_title_2'] ?></a></p>
                            <!--<ul class="list-inline">
                                <li>Promo Date: until July 2015 |</li>
                                <li>For HSBC Gold Only </li>

                            </ul>-->
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

<?php
  if(isset($grandPrize) && !empty($grandPrize)) {
    ?>
    <!-- prize Modal 1 -->
    <div class="portfolio-modal modal fade" id="prizemodal<?php echo $grandPrize['Prize']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2><?php echo strtoupper($grandPrize['PrizeType']['name']); ?></h2>
                            <p class="item-intro text-muted"><?php echo $grandPrize['Prize']['title']; ?></p>
                            <div id="carouselGrandPrize" class="carousel slide" data-ride="carousel">
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner" role="listbox">
                                <?php
                                  if(!empty($grandPrize['ImageBig']['url'])) {
                                    ?>
                                    <div class="item active">
                                      <img class="img-responsive img-centered" src="<?php echo $grandPrize['ImageBig']['host'].$grandPrize['ImageBig']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($grandPrize['Image2']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $grandPrize['Image2']['host'].$grandPrize['Image2']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>

                                <?php
                                  if(!empty($grandPrize['Image3']['url'])) {
                                    ?>
                                    <div class="item">
                                      <img class="img-responsive img-centered" src="<?php echo $grandPrize['Image3']['host'].$grandPrize['Image3']['url'] ?>" alt="">
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                              <!-- Left and right controls -->
                              <a class="left carousel-control" href="#carouselGrandPrize" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#carouselGrandPrize" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <p><?php echo nl2br($grandPrize['Prize']['description']); ?></p>
                            <p><?php echo $grandPrize['Prize']['sub_title_1'] ?><a href="#">&nbsp; <?php echo $grandPrize['Prize']['sub_title_2'] ?></a></p>
                            <!--<ul class="list-inline">
                                <li>Promo Date: until July 2015 |</li>
                                <li>For HSBC Gold Only </li>

                            </ul>-->
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
