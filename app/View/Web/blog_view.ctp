<?php echo $this->start("script");?>
<script>
$(document).ready(function(){

});

</script>
<?php echo $this->end(); ?>
<!-- Navigation -->
<style>
#content-header .header-image{
 max-width:1024px;
 width:100%;
}

#content-header iframe{
 max-width:1024px;
 max-height:582px;
 width:100%;
 height:50vw;
}

#full-tips-header{
 position:relative;
 text-align:left;
 color:#fff;
 max-width:1024px;
}

#full-tips-header .wrapper{

 position:absolute;
 bottom:0;
 width:100%;
 background:rgba(255,0,0,0.8);
 background-size:cover;
}

#full-tips-header .wrapper .title{
 font-size:3.2vw;
 margin:.5vw 0 0 2.5vw;
}

#full-tips-header .wrapper .author{
 font-size:22px;
 margin:0 0 10px 2.5vw;
}

#full-tips-header .slider{
 position:absolute;
 max-width:197px;
 max-height:121px;
 width:20vw;
 height:10vw;

 bottom:50%;
 right:0;
 background:url(<?php echo $this->webroot ?>img/fashion-slider.png);
 background-size:cover;
 font-family: "Oswald-light", Verdana, Sans-serif;
}

#full-tips-header .slider .desc-wrapper {
 bottom:50%;
 transform:translateY(50%);
 position:absolute;
 width:80%;
 text-align:center;
}

#full-tips-header a{
 color:#fff;
 text-decoration:none;
}

#full-tips-header .slider .desc-wrapper .desc{
 margin-top:10px;
 font-size:1.3vw;
}

#full-tips-header .slider .desc-wrapper .photos{
 font-size:1.1vw;
 font-style:italic;
}

#full-tips-share{
  max-width:1024px;
 background:#fff;
 text-align:left;
 position:relative;
 padding-left:3.2vw;
}

#full-tips-share img{
 padding:10px 10px 5px 0;
 width:80px;
}
#lower-wrapper{
 background-color: rgba(255,255,255, .5);
 max-width:1024px;
 text-align:justify;
}

#lower-wrapper span{
 width: 100%;
 display: inline-block;
 font-size: 0;
 line-height: 0
}
#inner-banner-wrapper{
 height:100%;
 margin:0 3vw 1vw 3vw;
}

#full-tips-content{
  max-width:1024px;
 padding:20px 0 20px 0;
 font-size:18px;
 font-family: 'DinPro', Verdana, Sans-serif;
}

#full-tips-content .author{
 padding-right:20px;
}

#full-tips-content .author .avatar{
 position:relative;
}

@media screen{
	#full-tips-content .author .avatar .photo{
	 width:80px;
	 height:80px;
	}

	#full-tips-content .author .avatar .bubble-tip{
	 width:9px;
	 height:18px;

	 position:absolute;
	 right:0;
	 top:30px;
	}

}

@media only screen and (max-device-width: 640px) {
	#full-tips-content .author .avatar .photo{
	 width:40px;
	 height:40px;
	}

	#full-tips-content .author .avatar .bubble-tip{
	 width:4px;
	 height:9px;
	 background:url(<?php echo $this->webroot ?>img/bubble-tip.png);
	 position:absolute;
	 right:0;
	 top:10px;
	}

}

#full-tips-content .content{

}

</style>
<?php
echo $this->element('navbar_multiple_page', array(
    "blogActive" => "active"
));
?>
<!-- Prizes Section -->
<section id="blog" style="background-image:url(<?php echo $blogPage['ImageBig']['host'].$blogPage['ImageBig']['url'] ?>);">
    <div class="container">
        <div class="row" style="text-align:center;border:0px solid black;margin:0 auto;">
          <div class="col-lg-12 text-center" style="margin-left:auto;">
            <div id="content-header">
              <div id="full-tips-header">
                <img class="header-image" src="<?php echo $detail['ImageBig']['host'].$detail['ImageBig']['url'] ?>" alt="">
                <div class="wrapper">
                  <div class="title"><?php echo $detail['Blog']['title']; ?></div>
                  <div class="author">by <?php echo $detail['Blog']['author_name'] ?></div>
                </div>
                <a href="<?php echo $this->Html->url(array('action' => 'BlogViewSlider', $detail['Blog']['id'])) ?>">
                  <div class="slider">
                    <div class="desc-wrapper">
                      <div class="desc">FOR YOUR INSPIRATION</div>
                      <div class="photos"><?php echo count($detail['BlogImage']) ?> photos</div>
                    </div>
                  </div>
                          </a>
              </div>
              <div>
                <div id="full-tips-share">
                  <a name="fbStyle Tips to Look Instantly Slimmer" class="share_url" href="
                    https://www.facebook.com/dialog/feed?app_id=1566547340275386&display=popup&link=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&redirect_uri=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&name=Style+Tips+to+Look+Instantly+Slimmer&caption=There+are+so+many+ways+to+style+yourself+to+get+slimmer+look+without+being+on+diet.+Just+open+your+closet+and+start+to+play+with+your+fashion+stuff.+Here+are+5+fashion+tips+to+look+instantly+slimmer.&picture=https%3A%2F%2Fwww.icelebratestyle.com%2Fasset%2Fimages%2Fbanner%2Ffashion-banner-5520151430831277.jpg" target="_blank" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >
                    <img src="<?php echo $this->webroot ?>img/fb-btn.png"/></a>
                  <a name="twStyle Tips to Look Instantly Slimmer" class="share_url" href="
                    http://twitter.com/share?url=https%3A%2F%2Fwww.icelebratestyle.com%2Ffashion_tips%2Ffull_page%2F13%2Fc51ce410c124a10e0db5e4b97fc2af39&text=Style+Tips+to+Look+Instantly+Slimmer+%23iCelebrateStyle" target="_blank" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >
                    <img src="<?php echo $this->webroot ?>img/tw-btn.png"/></a>
                </div>
              </div>
            </div>
            <div id="lower-wrapper" style="background:#f3f3f3;">
              <div id="inner-banner-wrapper">
                <div id="full-tips-content">
                  <table>
                    <tr>
                      <td class="author" valign="top">
                        <div class="avatar">
                          <img class="photo" src="<?php echo $detail['ImageAuthor']['host'].$detail['ImageAuthor']['url']; ?>"/>
                          <div class="bubble-tip"><img src="<?php echo $this->webroot ?>img/bubble-tip.png" /></div>
                        </div>
                      </td>
                      <td class="content"><?php echo nl2br($detail['Blog']['description']); ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
