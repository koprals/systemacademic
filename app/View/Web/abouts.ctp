<!-- Page Content -->
<div id="page-content-wrapper">
	<div id="main-content">
		<div class="container-fluid">
			<?php
				echo $this->element('header_reservation');
			?>
			<?php
				echo $this->element('header_navigation', array(
					"active" => ""
				));
			?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1 diningCarousel" >
					<?php
					echo $this->element('slider_advertisement');
					?>
				</div>
			</div>
			<div class="row innerMenuHr">
				<div class="col-md-10 col-md-offset-1 text-center" >
					<div class="innerMenuTitle" >
						<h1>About Us</h1>
					</div>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<?php
				echo $this->element('middle_content_page', array(
					'page' => $page
				));
			?>
			<div class="clearfix" style="height:120px;">&nbsp;</div>
			<div class="row footer">
				<?php echo $this->element('footer_sosmed'); ?>
			</div>
		</div>
	</div>
</div>
<!-- /#page-content-wrapper -->
