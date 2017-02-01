<?php echo $this->start("script");?>
<script>
$(document).ready(function(){

});

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "leaderboardActive" => "active"
));
?>

<style>
#awan1{
  -webkit-animation:firstAwan 10s; /* Chrome, Safari, Opera */
  animation:firstAwan 10s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
#awan2{
  -webkit-animation:firstAwan 15s; /* Chrome, Safari, Opera */
  animation:firstAwan 15s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
#awan3{
  -webkit-animation:firstAwan 20s; /* Chrome, Safari, Opera */
  animation:firstAwan 20s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
#awan4{
  -webkit-animation:firstAwan 12s; /* Chrome, Safari, Opera */
  animation:firstAwan 12s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
#awan5{
  -webkit-animation:firstAwan 8s; /* Chrome, Safari, Opera */
  animation:firstAwan 8s;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
/* Chrome, Safari, Opera */
@-webkit-keyframes firstAwan
{
  from {
    right:-20%;
  }
  to {
    right:120%;
  }
}
/* Standard syntax */
@keyframes firstAwan
{
  from {
    right:-20%;
  }
  to {
    right:120%;
  }
}

</style>
<!-- Prizes Section -->
<section id="leaderboardStyle" style="background:#e7fffe url(<?php echo $this->webroot ?>img/leaderboardKossa/background.png) no-repeat center;">
  <div class="container">
    <div class="row" style="min-height:500px;border:solid 0px black;">
     <div class="col-lg-12 text-center">
      <?php
        //ini untuk yang pertama
       ?>
      <h2 class="section-heading">Leaderboard</h2>
      <?php
        if(isset($leaderboards[0])) {
          ?>
          <div style="position:absolute;top:100px;right:10%;z-index:2;">
           <img src="<?php echo $this->webroot ?>img/leaderboardKossa/pesawat<?php echo $leaderboards[0]['UserPasscode']['user_avatar_id'] ?>.png" height="181" width="237" style="vertical-align:middle;">
           <h5 style="position:absolute;right:90px;bottom:73px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[0]['UserPasscode']['username'] ?></h5>
           <h4 style="position:absolute;right:90px;bottom:57px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[0]['UserPasscode']['points'] ?></h4>
          </div>
          <?php
        }
       ?>
       <?php
        if(isset($leaderboards[1])) {
          ?>
          <div style="position:absolute;top:30px;right:30%;z-index:2;">
           <img src="<?php echo $this->webroot ?>img/leaderboardKossa/pesawat<?php echo $leaderboards[1]['UserPasscode']['user_avatar_id'] ?>.png" height="181" width="237" style="vertical-align:middle;">
           <h5 style="position:absolute;right:90px;bottom:73px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[1]['UserPasscode']['username'] ?></h5>
           <h4 style="position:absolute;right:90px;bottom:57px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[1]['UserPasscode']['points'] ?></h4>
          </div>
          <?php
        }
        ?>
      <?php
        if(isset($leaderboards[2])) {
          ?>
          <div style="position:absolute;top:150px;right:40%;z-index:2;">
           <img src="<?php echo $this->webroot ?>img/leaderboardKossa/pesawat<?php echo $leaderboards[2]['UserPasscode']['user_avatar_id'] ?>.png" height="181" width="237" style="vertical-align:middle;">
           <h5 style="position:absolute;right:90px;bottom:73px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[2]['UserPasscode']['username'] ?></h5>
           <h4 style="position:absolute;right:90px;bottom:57px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[2]['UserPasscode']['points'] ?></h4>
          </div>
          <?php
        }
      ?>

      <?php
        if(isset($leaderboards[3])) {
          ?>
          <div style="position:absolute;top:230px;right:55%;z-index:2;">
           <img src="<?php echo $this->webroot ?>img/leaderboardKossa/pesawat<?php echo $leaderboards[3]['UserPasscode']['user_avatar_id'] ?>.png" height="181" width="237" style="vertical-align:middle;">
           <h5 style="position:absolute;right:90px;bottom:73px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[3]['UserPasscode']['username'] ?></h5>
           <h4 style="position:absolute;right:90px;bottom:57px;width:97px;color:#fff;text-align:right;"><?php echo $leaderboards[3]['UserPasscode']['points'] ?></h4>
          </div>
          <?php
        }
      ?>

      <div style="position:absolute;top:70px;right:70%;z-index:2;">
       <img src="<?php echo $this->webroot ?>img/leaderboardKossa/pesawat<?php echo $profile['User']['user_avatar_id'] ?>.png" height="181" width="237" style="vertical-align:middle;">
       <h5 style="position:absolute;right:90px;bottom:73px;width:97px;color:#fff;text-align:right;">YOU</h5>
       <h4 style="position:absolute;right:90px;bottom:57px;width:97px;color:#fff;text-align:right;"><?php echo $profile['User']['points']; ?></h4>
      </div>
       <div style=" position:absolute;top:150px;right:70%;z-index:1;" id="awan1">
         <img src="<?php echo $this->webroot ?>img/leaderboardKossa/awan.png" style="vertical-align:middle;">
       </div>
       <div style=" position:absolute;top:50px;right:70%;z-index:1;" id="awan2">
         <img src="<?php echo $this->webroot ?>img/leaderboardKossa/awan.png" style="vertical-align:middle;">
       </div>
       <div style=" position:absolute;top:230px;right:70%;z-index:1;" id="awan3">
         <img src="<?php echo $this->webroot ?>img/leaderboardKossa/awan.png" style="vertical-align:middle;">
       </div>
       <div style=" position:absolute;top:300px;right:70%;z-index:1;" id="awan4">
         <img src="<?php echo $this->webroot ?>img/leaderboardKossa/awan.png" style="vertical-align:middle;">
       </div>
       <div style=" position:absolute;top:100px;right:70%;z-index:1;" id="awan5">
         <img src="<?php echo $this->webroot ?>img/leaderboardKossa/awan.png" style="vertical-align:middle;">
       </div>
     </div>
    </div>
  </div>
</section>
