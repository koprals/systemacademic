<script>
$(document).ready(function(){
	$("#contents_area").css("opacity","0.5");
	$("#contents_area").load("<?php echo $settings['cms_url'] . $ControllerName?>/ListItem/page:<?php echo $page?>/limit:<?php echo $viewpage?>/?time=<?php echo time()?>",function(){
		$("#contents_area").css("opacity","1");
		$("a[rel^='lightbox']").prettyPhoto({
			social_tools :''
		});

		$("#view, input:checkbox, #action").uniform();
		$('.tipS').tipsy({gravity: 's',fade: true});
	});
});

function onClickPage(el,divName)
{
	$(divName).css("opacity","0.5");
	$(divName).load(el.toString(),function(){
		$(divName).css("opacity","1");
		$("a[rel^='lightbox']").prettyPhoto({
			social_tools :''
		});
		$("#view, input:checkbox, #action").uniform();
		$('.tipS').tipsy({gravity: 's',fade: true});
	});
	return false;
}
function SearchAdvance()
{
	$("#SearchAdvance").ajaxSubmit({
		url:"<?php echo $settings['cms_url'].$ControllerName ?>/ListItem",
		type:'POST',
		dataType: "html",
		clearForm:false,
		beforeSend:function()
		{
			$("#reset").val("0");
			$("#contents_area").css("opacity","0.5");
		},
		complete:function(data,html)
		{
			$("#contents_area").css("opacity","1");
		},
		error:function(XMLHttpRequest, textStatus,errorThrown)
		{
			alert(textStatus);
		},
		success:function(data)
		{
			$("#contents_area").html(data);
		}
	});

	return false;
}
function ClearSearchAdvance()
{
	$("#SearchId, #SearchName").val("");
	$('#reset').val('1');
	SearchAdvance();
}
</script>
<!-- HEADER -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Files</h5>
            <span>List</span>
        </div>
    </div>
</div>
<div class="line"></div>
<div class="statsRow">
	<div class="wrapper">
		<div class="controlB">
			<ul>
				<li>
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Add" title="Add New <?php echo $ControllerName?>">
						<img src="<?php echo $this->webroot?>img/icons/control/32/plus.png" alt="" />
					<span>Add new row</span></a>
				</li>
				<li>
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Excel" title="Export to Excel" target="_top">
						<img src="<?php echo $this->webroot?>img/icons/control/32/spreadsheet.png" alt="" />
					<span>Export to Excel</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="line"></div>
<!-- HEADER -->

<!-- CONTENT -->
<div class="wrapper">
	<!-- START SEARCH  -->
	<div class="span6">
		<div class="bc">
	        <ul id="breadcrumbs" class="breadcrumbs">
	             <li>
	                  <a href="javascript:void(0)">Files</a>
	             </li>
	             <li class="current">
	                  <a href="javascript:void(0)">List</a>
	             </li>
	        </ul>
	    </div>
		<div class="toggle" style="border-color:#a0a0a0;">
			<div class="title closed" id="toggleOpened" style="border-color:#a0a0a0;">
				<img src="<?php echo $this->webroot?>img/icons/dark/magnify.png" alt="" class="titleIcon"/>
				<h6 class="red">Search</h6>
			</div>
			<div class="body" style="border-color:#a0a0a0;">
				<?php echo $this->Form->create("Search",array("onsubmit"=>"return SearchAdvance()","url"=>"","id"=>"SearchAdvance"))?>
					<input name="data[Search][reset]" type="hidden" value="0" id="reset">
					<fieldset>

						<?php
	                    	echo $this->Form->input('Search.id', array(
								'label'			=>	'ID',
	                    		'div'			=>	array("class"=>"dataTables_filter"),
	                    		'between'		=>	'<div class="formRight"><span class="span3">',
	                    		'after'			=>	'</span></div>',
								"style"			=>	"width:50px"
	                    	));
						?>
						<?php
							echo $this->Form->input('Search.name', array(
								'label'			=>	'Name',
								'div'			=>	array("class"=>"dataTables_filter"),
								'between'		=>	'<div class="formRight"><span class="span3">',
								'after'			=>	'</span></div>'
							));

						?>

						<div class="dataTables_filter">
							<label for="SearchYear">Upload Year</label>
							<div class="formRight">
								<span class="span1">
									<?php
									echo $this->Form->year('Search.year', 2014, date('Y'));
									?>
								</span>
							</div>
						</div>
						<div class="dataTables_filter">
							<label for="SearchMonth">Upload Month</label>
							<div class="formRight">
								<span class="span1">
									<?php
									echo $this->Form->month('Search.month');
									?>
								</span>
							</div>
						</div>

						<?php
							echo $this->Form->input('Search.file_type', array(
								'label'			=>	'File Type',
								'div'			=>	array("class"=>"dataTables_filter"),
								'between'		=>	'<div class="formRight"><span class="span3">',
								'after'			=>	'</span></div>',
								'options'		=>	array('image' => 'image', 'video' => 'video', 'sound' => 'sound'),
								'empty'			=>	'Please choose'
							));

						?>

					</fieldset>
				<?php echo $this->Form->end()?>
				<a href="javascript:void(0);" title="" class="wButton bluewB ml15 m10" onclick="return SearchAdvance();"><span>Search</span></a>
				<a href="javascript:void(0);" title="" class="wButton redwB ml15 m10" onclick="ClearSearchAdvance();"><span>Reset</span></a>
			</div>
		</div>
	</div>
	<!-- END SEARCH  -->
	<div id="contents_area">
	</div>
</div>
<!-- CONTENT -->
