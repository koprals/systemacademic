<?php echo $this->start("script");?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot ?>gamecss.css" />
<script src="<?php echo $this->webroot ?>phaser.min.js" type="text/javascript"></script>

<script>
var theCookie = "asdflmfs";
$(document).ready(function(){

});

function GetCookie(cname) {
    return "<?php echo $userloginWebCookie ?>";
}

</script>
<script src="<?php echo $this->webroot ?>_div_foodrain.js" type="text/javascript"></script>
<script type="text/javascript">
  function SetW(){
    var val = document.getElementById("text1").value;
    SetGameWidth(parseInt(val));
  }
  function SetH(){
    var val = document.getElementById("text2").value;
    SetGameHeight(parseInt(val));
  }
</script>
<?php echo $this->end(); ?>

<?php echo $this->start("css");?>
<style>
.kossa-content-parent{
  background-color:#ffffff;
  color:#000;
  padding:5px;
  margin:10px;
}
.kossa-content-parent h3{
  margin:0;
}
.kossa-content-parent hr{
  margin:5px;
}
.font-kossa {
  font-size:80px;
  font-weight:bold;
}
</style>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "miniGameActive" => "active"
));
?>
<input type="text" id="text1" />
<input type="button" value="SetGameWidth()" onclick="SetW();" />
<br/>
<input type="text" id="text2" />
<input type="button" value="SetGameHeight()" onclick="SetH();" />
<br/>
<!-- Prizes Section -->
<section id="prize" style="background-image:url(<?php echo $prizePage['ImageBig']['host'].$prizePage['ImageBig']['url'] ?>);">
  <div class="container" style="background-color:rgba(255,255,255,.7);border-radius:30px;padding:30px;">
    <div class="row">
      <div class="col-lg-6 text-center">
        <div class="fontPreload" style="font-family: AmateurComic;">.</div>
        <textArea class="textHelp" id="textHelp"></textArea>

        <div style="display:table;margin:0 auto;">
          <div style="display:table-cell" class="gamediv" id="gamediv">
          </div>
        </div>
      </div>
      <div class="col-lg-6 text-center" style="background-color:rgba(255,255,255,.7);border-radius:30px;padding:30px;min-height:600px;">
        <div class="kossa-content-parent">
          <h3>Your Current Fuel</h3>
          <hr style="border:1px solid black;">
          <span class="font-kossa"><?php echo $profile['User']['points'] ?></span>
        </div>
        <div class="kossa-content-parent">
          <h3>You Have Played</h3>
          <hr style="border:1px solid black;">
          <span class="font-kossa"><?php echo $playCount ?></span>
        </div>
        <div class="kossa-content-parent">
          <h3>Your Current Rank</h3>
          <hr style="border:1px solid black;">
          <span class="font-kossa"><?php echo $leaderboard['Leaderboard']['rank'] ?></span>
        </div>
      </div>
    </div>
  </div>
</section>
