<!-- HEADER -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5><?php echo $ModelName?></h5>
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
	                <label>Name:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['title'] ?>
	                </div>
	            </div>
				<div class="formRow">
	                <label>Description:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['description'] ?>
	                </div>
	            </div>
				<div class="formRow">
	                <label>Photo:</label>
	                <div class="formRight">
	                    <a rel="lightbox" title="<?php echo $detail[$ModelName]['title'] ?>" href="<?php echo $detail["Big"]["host"].$detail["Big"]["url"]?>?time=<?php echo time()?>">
							<img src="<?php echo $detail["Big"]["host"].$detail["Big"]["url"]?>?time=<?php echo time()?>" width="100" id="preview"/>
						</a>
	                </div>
	            </div>
				<div class="formRow">
	                <label>Created:</label>
	                <div class="formRight">
	                    <?php echo date("d/M/Y H:i:s",strtotime($detail[$ModelName]['created']))?>
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