<!-- HEADER -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5><?php echo $ControllerName?></h5>
            <span>View</span>
        </div>
        <div class="middleNav">
	        <ul>
	            <li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<!-- HEADER -->

<!-- CONTENT -->
<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">
            <div class="widget">
	            <div class="title">
					<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
					<h6><?php echo $detail[$ModelName]['name'] ?></h6>
				</div>
	            <div class="formRow">
	                <label>ID:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['id'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Code:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['code'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Name:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['name'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Username:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['username'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Password:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['password'] ?>
	                </div>
	            </div>
				      <div class="formRow">
	                <label>Address:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['address'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Gol. Darah:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['gol_darah'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Phone:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['phone'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Tempat Lahir:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['place_of_birth'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Tanggal Lahir:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['date_of_birth'] ?>
	                </div>
	            </div>
	        </div>
			<div class="widget">
				<div class="body textC">
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Edit/<?php echo $ID?>" title="Back to Edit" class="button redB" style="margin: 5px;"><span>Edit this <?php echo $ControllerName?></span></a>
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Add" title="Back to List" class="button greyishB" style="margin: 5px;"><span>Add More</span></a>
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Index" title="Back to List" class="button blueB" style="margin: 5px;"><span>Back to List</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CONTENT -->
<script>
$(document).ready(function(){
	$("#ajaxVenueEvent").css("opacity","0.5");
	$("#ajaxVenueEvent").load("<?php echo $this->Html->url(array('controller' => $ControllerName, 'action' => 'ajaxListEvent', $ID))?>",function(){
		$("#ajaxVenueEvent").css("opacity","1");
	});
});
</script>
