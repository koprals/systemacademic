<?php echo $this->start("script");?>
<script>
$(document).ready(function(){

});

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<?php
echo $this->element('navbar_multiple_page', array(
    "blogActive" => "active"
));
?>
<style>
#full-tips-share{
  max-width:1024px;
 text-align:left;
 position:relative;
 padding-left:3.2vw;
}

#full-tips-share img{
 padding:10px 10px 5px 0;
 width:80px;
}

#full-tips-content .content{

}

#rslides-wrapper {

}

.rslides {
  margin: 0 auto;
  position:relative;
}

.rslides-container {
  position: relative;
  float: left;
  width: 100%;
  margin-bottom:30px;
}
#slider {
  box-shadow: none;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  margin: 0 auto;
}

#slider-pager li{
  display: inline-block;
  margin:5px;
}

#slider-pager a {
  display: inline-block;
}

#slider-pager img {
  float: left;
  max-width:60px;
  max-height:60px;
  width:100%;
  height:100%;
}

#slider-pager .rslides_here a {
  background: transparent;
  box-shadow: 0 0 0 2px #666;
}

#slider-pager a {
  padding: 0;
}

.tips-slide{
 width:100%;
 position:relative;
 background:#f3f3f3;
 margin-top:30px;
}

.tips-slide .image{
 overflow: hidden;
 position: relative;
 max-width:460px;
 width:100%;
 height:100%;
}

.tips-slide .image img{
 max-width:470px;
 width:100%;
}

@media screen{
	.tips-slide .detail{
	 position:absolute;
	 width:40%;
	 right:10px;
	 top:20%;
	}
}

@media only screen and (max-device-width: 640px) {
	.tips-slide .detail{
	 width:100%;
	 position:relative;
	 display:block;
	 bottom:0;
	 right:0;
	 transform:translateY(0);
	 margin: auto 5px auto 5px;
	}
}


.tips-slide .detail .title{
 color:#ee3423;
 font-size:35px;
 text-align:left;
}

.tips-slide .detail .desc{
 color:#6d6e71;
 font-size:20px;
 text-align:left;
}

@media screen{
	.tips-slide .share{
	 bottom:0;
	 right:0;
	 text-align:left;
	 position:absolute;
	}
}

@media only screen and (max-device-width: 640px) {
	.tips-slide .share{
	 text-align:left;
	 position:relative;
	}
}

</style>
<!-- Prizes Section -->
<section id="blog" style="background-image:url(<?php echo $blogPage['ImageBig']['host'].$blogPage['ImageBig']['url'] ?>);">
    <div class="container">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 text-center">
                <div id="rslides-wrapper">
                  <div class="rslides-container">
                    <ul class="rslides" id="slider">
                      <?php
                        if(isset($blogs) && count($blogs) > 0) {
                          foreach($blogs as $blog) {
                            ?>
                            <li class="tips-slide">
                              <div class="image"><img src="<?php echo $blog['ImageBig']['host'].$blog['ImageBig']['url']; ?>" alt=""></div>
                              <div class="detail">
                                <div class="title"><?php echo $this->Html->link($blog['Blog']['title'], array('controller' => 'Web', 'action' => 'BlogView', $blog['Blog']['id']), array('style' => 'color:#000;')); ?></div>
                                <div class="desc">By <span><?php echo $blog['Blog']['author_name']; ?></span></div>
                                <div id="full-tips-share">
                                  <a name="fbStyle Tips to Look Instantly Slimmer" class="share_url" href="
                                    https://www.facebook.com/dialog/feed?app_id=1566547340275386&display=popup&link=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&redirect_uri=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&name=Style+Tips+to+Look+Instantly+Slimmer&caption=There+are+so+many+ways+to+style+yourself+to+get+slimmer+look+without+being+on+diet.+Just+open+your+closet+and+start+to+play+with+your+fashion+stuff.+Here+are+5+fashion+tips+to+look+instantly+slimmer.&picture=https%3A%2F%2Fwww.icelebratestyle.com%2Fasset%2Fimages%2Fbanner%2Ffashion-banner-5520151430831277.jpg" target="_blank" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >
                                    <img src="<?php echo $this->webroot ?>img/fb-btn.png"/></a>
                                  <a name="twStyle Tips to Look Instantly Slimmer" class="share_url" href="
                                    http://twitter.com/share?url=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&text=Style+Tips+to+Look+Instantly+Slimmer+%23iCelebrateStyle" target="_blank" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >
                                    <img src="<?php echo $this->webroot ?>img/tw-btn.png"/></a>
                                </div>
                              </div>
                            </li>
                            <?php
                          }
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</section>
