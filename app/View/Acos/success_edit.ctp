<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Success Edit Module Object</h5>
            <span><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>

<div class="line"></div>
<div class="wrapper">
	<div class="nNote nSuccess">
		<p><strong>SUCCESS: </strong>Success edit Module Object</p>
	</div>
	<div class="widget">
		<div class="body textC">
			<a href="<?php echo $settings["cms_url"].$ControllerName?>/Edit/<?php echo $ID?>/<?php echo $page?>/<?php echo $viewpage?>" title="Back to Edit" class="button redB" style="margin: 5px;"><span>Edit this module</span></a>
			<a href="<?php echo $settings["cms_url"].$ControllerName?>/Add" title="Back to List" class="button greyishB" style="margin: 5px;"><span>Add More</span></a>
			<a href="<?php echo $settings["cms_url"].$ControllerName?>/Index/<?php echo $page?>/<?php echo $viewpage?>" title="Back to List" class="button blueB" style="margin: 5px;"><span>Back to List</span></a>
		</div>
	</div>
</div>
