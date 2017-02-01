<?php if(!empty($ads)):?>
<div id="diningCarousel" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        
		<?php foreach($ads as  $k=>$ads):?>
		<?php $class = ($k==0) ? "item active" : "item";?>
		<div class="<?php echo $class?>">
          <img class="img-centered" src="<?php echo $ads['ImageBig']['host'].$ads['ImageBig']['url']; ?>?time=<?php echo time()?>">
          <div class="carousel-caption">
            <?php echo $ads['Advertisement']['title'];?>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#diningCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#diningCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<?php endif;?>
