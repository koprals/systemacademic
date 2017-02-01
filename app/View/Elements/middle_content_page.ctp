<?php
  // Title And Description
  if($page['WebPage']['web_page_type_id'] == 1) {
    ?>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-10 col-md-offset-1" style="margin-top:20px;">
			<h2 style="font-family:Square;margin-top:10px;"><?php echo strtoupper($page['WebPage']['title']); ?></h2>
			<br>
			<p style="font-family:Square;"><?php echo nl2br($page['WebPage']['description']); ?></p>
		</div>
	</div>
    <?php

    //Title, Description, 1 Picture Big Below
  } else if($page['WebPage']['web_page_type_id'] == 2) {
    ?>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-10 col-md-offset-1" style="margin-top:20px;">
			<h2 style="font-family:Square;margin-top:10px;"><?php echo strtoupper($page['WebPage']['title']); ?></h2>
			<?php if(!empty($page['WebPage']['description'])):?>
			<br>
			<p style="font-family:Square;"><?php echo nl2br($page['WebPage']['description']); ?></p>
			<?php endif;?>
		</div>
	</div>
	<?php if(!empty($page['ImageBig']['host'])):?>
	<br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<img src="<?php echo $page['ImageBig']['host'].$page['ImageBig']['url']; ?>" class="img-responsive img-red-white-border" />
		</div>
	</div>
	<?php endif;?>
    <?php

    //Title, Description, small picture in the right
  } else if($page['WebPage']['web_page_type_id'] == 3) {
    ?>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-10 col-md-offset-1" style="margin-top:20px;">
			<h2 style="font-family:Square;margin-top:10px;"><?php echo strtoupper($page['WebPage']['title']); ?></h2>
			<p style="font-family:Square;margin-top:10px;">
				<?php if(!empty($page['ImageBig']['host'])):?>
					&nbsp;<br>
					<img src="<?php echo $page['ImageBig']['host'].$page['ImageBig']['url']; ?>?time=<?php echo time()?>"  class="img-responsive img-red-white-border" style="float:right;display:inline; margin-top:5px;" width="300"/>
					
				<?php endif;?>
				<?php echo nl2br($page['WebPage']['description']); ?>
			</p>
		</div>
	</div>
    <?php
  } else if($page['WebPage']['web_page_type_id'] == 4) {
    ?>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-10 col-md-offset-1" style="margin-top:20px;">
			<h2 style="font-family:Square;margin-top:10px;"><?php echo strtoupper($page['WebPage']['title']); ?></h2>
			<p style="font-family:Square;margin-top:10px;">
				<?php if(!empty($page['ImageBig']['host'])):?>
					<div style="float:right;display:inline; padding-left:10px; padding-top:5px;">
						&nbsp;<br>
						<img src="<?php echo $page['ImageBig']['host'].$page['ImageBig']['url']; ?>?time=<?php echo time()?>"  class="img-responsive img-red-white-border"  width="300"/>
						<a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Reservations'));?>" class="button-book-now" style="float:right;margin-top:20px; margin-bottom:20px;"><span>Book Now</span></a>
					</div>
				<?php endif;?>
				<br>
				<font style="font-family:Square;"><?php echo nl2br($page['WebPage']['description']); ?></font>
			</p>
		</div>
	</div>
    <?php
  }
?>
