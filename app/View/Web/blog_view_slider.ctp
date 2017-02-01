<?php echo $this->start("script");?>
<script type="text/javascript" src="<?php echo $this->webroot ?>newjs/responsiveslides.min.js"></script>
<script>
$(document).ready(function(){
  $("#slider").responsiveSlides({
    auto: false,
    pager: false,
    nav: true,
    speed: 500,
    maxwidth: 800,
    namespace: "centered-btns"
  });
});

</script>
<script>
	// You can also use "$(window).load(function() {"
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

.tips-slide .share img{
 width:80px;
 padding:10px 10px 5px 0;
}
.rslides {
  position: relative;
  list-style: none;
  overflow: hidden;
  width: 100%;
  padding: 0;
  margin: auto;
}

.rslides li {
  -webkit-backface-visibility: hidden;
  position: absolute;
  display: none;
  width: 100%;
  left: 0;
  top: 0;
}

.rslides li:first-child {
  position: relative;
  display: block;
  float: left;
}

.rslides img {
  display: block;
  height: auto;
  float: left;
  width: 100%;
  border: 0;
}

.centered-btns_nav {
  z-index: 3;
  position: absolute;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
  top: 250px;
  left: 0;
  opacity: 0.7;
  text-indent: -9999px;
  overflow: hidden;
  text-decoration: none;
  /**
  height: 121px;
  width: 67px;
  **/
  max-height: 121px;
  max-width: 67px;
  height: 15vw;
  width: 8vw;
  background: transparent url("<?php echo $this->webroot ?>img/arrows.png") no-repeat left top;
  background-size:cover;
  margin-top: -45px;
  }

.centered-btns_nav:active {
  opacity: 1.0;
  }

.centered-btns_nav.next {
  left: auto;
  background-position: right top;
  right: 0;
  }

  .centered-btns_nav:focus,
  .transparent-btns_nav:focus,
  .large-btns_nav:focus {
    outline: none;
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
      <div class="row" style="text-align:center;">
        <div class="col-lg-12 text-center">
          <div id="rslides-wrapper">
    				<div class="rslides-container">
    					<ul class="rslides" id="slider">
    						<?php
                  if(isset($detail['BlogImage']) && count($detail['BlogImage']) > 0) {
                    foreach($detail['BlogImage'] as $blogImage) {
                      ?>
                      <li class="tips-slide">
                        <div class="image"><img src="<?php echo $blogImage['ImageBig']['host'].$blogImage['ImageBig']['url'] ?>" alt=""></div>
                        <div class="detail">
                          <div class="title">&nbsp;</div>
                          <div class="desc"><?php echo $blogImage['title']; ?></div>
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
</section>
