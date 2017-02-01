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
					<h6><?php echo $detail['Pasien']['name'] ?></h6>
				</div>
	            <div class="formRow">
	                <label>ID:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['id'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Doctor Name:</label>
	                <div class="formRight">
	                    <?php echo $detail['Admin']['fullname'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Pasien Name:</label>
	                <div class="formRight">
	                    <?php echo $detail['Pasien']['name'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Jenis Surat:</label>
	                <div class="formRight">
	                    <?php echo $detail['LetterType']['name'] ?>
	                </div>
	            </div>
              <div class="formRow">
	                <label>Isi Surat:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['keterangan'] ?>
	                </div>
	            </div>
	        </div>
			<div class="widget">
				<div class="body textC">
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Pdf/<?php echo $ID ?>.pdf" title="Export To PDF" class="button redB" style="margin: 5px;"><span>Export PDF</span></a>
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
