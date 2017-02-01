<div class="cLine"></div>
<div class="smalldd">
	<span class="goTo"><img src="<?php echo $this->webroot ?>img/icons/light/home.png" alt="" />Dashboard</span>
	<ul class="smallDropdown">
		<?php foreach($menu as $menu):
			$current	=	($menu["CmsMenu"]["id"] == $lft_menu_category_id ) ? "class='active'" : "";
		?>
		<li>
			<a href="<?php echo $this->webroot . $menu["CmsMenu"]["url"]?>" title="<?php echo $menu["CmsMenu"]["name"]?>">
				<img src="<?php echo $this->webroot ?>img/icons/light/stats.png" alt="" />
				<?php echo $menu["CmsMenu"]["name"]?>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>
<div class="cLine"></div>