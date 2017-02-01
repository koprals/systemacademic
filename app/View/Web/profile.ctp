<?php echo $this->start("script");?>
<script>
$(document).ready(function(){

});

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "profileActive" => "active"
));
?>
<header style="color:#000;background-image:url(<?php echo $profilePage['ImageBig']['host'].$profilePage['ImageBig']['url'] ?>);">
    <div class="container">
        <div class="intro-login">
          <div class="container-fluid">
              <div class="row">
                    <div class="col-lg-5 bg-tw1 padding1" style="background:url(<?php echo $this->webroot ?>img/bg-white-transparent1.png) repeat;">
                        <div class="col-lg-4" style="padding:0;">
                            <img src="<?php echo $this->webroot ?>img/avatars_for_home/<?php echo $profile['User']['user_avatar_id'] ?>.png" class="img-circle img-responsive center-block">
                        </div>
                        <div class="col-lg-8">
                            <h4 style="margin:0;" class="text-left">Hello,</h4>
                            <h3 style="margin:0;" class="text-left"><?php echo $profile['User']['username']; ?>!</h3>
                            <p style="margin:0;font-size:12px;" class="text-left text-lowercase"><?php echo $profile['User']['email']; ?></p>
                            <div class="container-fluid">
                                <div class="row">
                                    <?php
                                      echo $this->Form->create('Feedback', array('url' => array("controller"=>'Web',"action"=>"Profile")));
                                    ?>
                                    <?php
                                      echo $this->Form->input('description', array(
                                        'class' => 'form-control',
                                        'style' => 'border-radius:0; height:50px;',
                                        'label' => false,
                                        'div'   =>  false
                                      ));
                                    ?>
                                    <button class="btn" type="submit" style=" width:100%;border-radius:0;background-color:#ff0000;color:#fff;font-size:12px;margin:0;">
                                        <span class="pull-right">SEND FEEDBACK <i class="fa fa-envelope"></i></span>
                                    </button>
                                    <?php
                                      echo $this->Form->end();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row" style="background-color:#ff0000;color:#fff;">
                            <h5 class="text-center">YOUR FUELS</h5>
                            <hr style="margin:5px;border-color:#ffffff;">
                            <h1 class="text-center" style="margin:9px;"><?php echo $profile['User']['points'] ?></h1>
                            <div style="background-color:#000;padding:15px 0 14px 0;">
                                <a href="<?php echo $this->Html->url(array('action' => 'logout')); ?>" class="text-center"><h4 style="margin:8px;"><i class="fa fa-sign-in fa-2x"></i> <span style="color:#ffffff;">Sign Out</span></h4></a>
                            </div>
                        </div>
                    </div>
                    <!-- added kossa -->
                    <div class="col-lg-4 bg-tw1" style="background:url(<?php echo $this->webroot ?>img/bg-white-transparent2.png) repeat;">
                        <div class="row" style="color:#000;">
                            <div class="container-fluid">
                                <h5 class="text-center">HOW TO GAIN YOUR FUELS</h5>
                                <hr style="margin:5px;border-color:#000;">
                                <table class="table table-condensed" style="margin-bottom:32px;">
                                    <tbody>
                                        <tr bgcolor="#d6d6d6">
                                            <td bgcolor="black"><h1 class="text-center" style="margin:0px;color:#fff;">1</h1></td>
                                            <td><a href="#prizemodalhow1" data-toggle="modal"><h5 class="text-center" style="color:#000">Use HSBC Credit Card</h5></a></td>
                                            <td><i class="fa fa-chevron-circle-right fa-3x"></i></td>
                                        </tr>
                                        <tr bgcolor="#d6d6d6">
                                            <td bgcolor="black"><h1 class="text-center" style="margin:0px;color:#fff;">2</h1></td>
                                            <td><a href="#prizemodalhow2" data-toggle="modal"><h5 class="text-center" style="color:#000;">Play The Mini Game</h5></a></td>
                                            <td><i class="fa fa-chevron-circle-right fa-3x"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:4px;">
                  <div class="col-lg-5">
                      <div class="row">
                      <a href="#"><img src="<?php echo $this->webroot ?>img/play-game.png" class="img-responsive" style="width:100%;"></a>
                        </div>
                        <?php
                          if(isset($blogs[1]) && !empty($blogs[1])) {
                            ?>
                            <div class="row bg-tw2" style="margin-top:4px;background:url(<?php echo $this->webroot ?>img/bg-white-transparent2.png) repeat;">
                                <div class="col-lg-4 padding2" style="margin-top:10px">
                                  <img src="<?php echo $blogs[1]['ImageThumb']['host'].$blogs[1]['ImageThumb']['url'] ?>" class="img-responsive" style="width:100%;">
                                </div>
                                <div class="col-lg-8" style="text-align:left;">
                                  <h4 style="margin-bottom:0;"><a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'BlogView', $blogs[1]['Blog']['id'])); ?>" style="color:#000;"><?php echo $blogs[1]['Blog']['title'] ?></a></h4>
                                    <p><strong>Blog Post By <a href="#"><?php echo $blogs[1]['Admin']['fullname'] ?></a></strong></p>
                                    <span class="clearfix" style="font-size:10px"><?php echo $this->Text->truncate($blogs[1]['Blog']['description'],100,array("ending"=>"..  ","html"=>true))?>
                                    </span>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'BlogView', $blogs[1]['Blog']['id'])); ?>" class="btn" style="margin-top:6px;padding:0;"><p>READ MORE</p></a>
                                </div>
                            </div>
                            <?php
                          }
                        ?>
                        <?php
                          if(isset($blogs[2]) && !empty($blogs[2])) {
                            ?>
                            <div class="row bg-tw2" style="margin-top:4px;background:url(<?php echo $this->webroot ?>img/bg-white-transparent2.png) repeat;">
                                <div class="col-lg-4 padding2" style="margin-top:10px">
                                  <img src="<?php echo $blogs[2]['ImageThumb']['host'].$blogs[2]['ImageThumb']['url'] ?>" class="img-responsive" style="width:100%;">
                                </div>
                                <div class="col-lg-8" style="text-align:left;">
                                  <h4 style="margin-bottom:0;"><a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'BlogView', $blogs[2]['Blog']['id'])); ?>" style="color:#000;"><?php echo $blogs[2]['Blog']['title'] ?></a></h4>
                                    <p><strong>Blog Post By <a href="#"><?php echo $blogs[2]['Admin']['fullname'] ?></a></strong></p>
                                    <span class="clearfix" style="font-size:10px"><?php echo $this->Text->truncate($blogs[2]['Blog']['description'],100,array("ending"=>"..  ","html"=>true))?>
                                    </span>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'BlogView', $blogs[2]['Blog']['id'])); ?>" class="btn" style="margin-top:6px;padding:0;"><p>READ MORE</p></a>
                                </div>
                            </div>
                            <?php
                          }
                        ?>
                  </div>
                    <div class="col-lg-7">
                      <?php
                        if(isset($blogs[0]) && !empty($blogs[0])) {
                          ?>
                          <div class="row" style="margin-left:-10px;position:relative;min-height:418px;">
                              <div class="bg-tw1" style="background:url(<?php echo $this->webroot ?>img/bg-white-transparent1.png) repeat;position:absolute;bottom:0;width:100%;">
                                  <div class="container-fluid" style="text-align:left;">
                                    <h3><?php echo $this->Html->link($blogs[0]['Blog']['title'], array('controller' => 'Web', 'action' => 'BlogView', $blogs[0]['Blog']['id']), array('style' => 'color:#000')); ?></h3>
                                        <h5 class=""><strong>Blog Post By <a href="#"><?php echo $blogs[0]['Admin']['fullname'] ?></a></strong></h5>
                                        <p style="font-size:12px;">
                                          <?php echo $this->Text->truncate($blogs[0]['Blog']['description'],250,array("ending"=>"..  ","html"=>true))?>
                                          <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'BlogView', $blogs[0]['Blog']['id'])); ?>" class="small"><br><strong>READ MORE</strong></a>
                                        </p>
                                    </div>
                                </div>
                              <img src="<?php echo $blogs[0]['ImageBig']['host'].$blogs[0]['ImageBig']['url'] ?>" class="img-responsive" width="100%">
                            </div>
                          <?php
                        }
                      ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- prize Modal how 1 -->
<div class="portfolio-modal modal fade" id="prizemodalhow1" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h2>USE HSBC CREDIT CARD</h2>
                        <p class="item-intro text-muted"></p>
                        <img class="img-responsive img-centered" src="<?php echo $this->webroot ?>img/ccimage.png" alt="">
                        <h4>
 
                          <li><a>Spend Rp.10,000</a> on Garuda Online and get 100 Points</li><br>
                          <li><a>Spend Rp.10,000</a> on Supporting Merchants and get 50 Points </li><br>
                          <li><a>Spend Rp.10,000</a> online (non-supporting merchants) and get 10 Points </li><br>
                          <li><a>Spend Rp.10,000</a> on any Hotel, Airline, or Travel merchants (non-supporting merchants) and get 10 Points</li><br>
</p>
                        </h4>
                           </a></p>
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


<!-- prize Modal how 2 -->
<div class="portfolio-modal modal fade" id="prizemodalhow2" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h2>PLAY THE MINI GAME</h2>
                        <p class="item-intro text-muted"></p>
                        <img class="img-responsive img-centered" src="<?php echo $this->webroot ?>img/gameimage.png" alt="">
                        <h4><a>Try your luck and get 3 chances everyday</a><br> You can win e-vouchers from merchants</h4>
                        <p>
                           </a></p>
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
