<script>
$(document).ready(function(){
	
	$("#contents_area").css("opacity","0.5");
	$("#contents_area").load("<?php echo $settings['cms_url'] . $ControllerName?>/ListItem",function(){
		$("#contents_area").css("opacity","1");
		$("a[rel^='lightbox']").prettyPhoto({
			social_tools :''									
		});
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
	$("#SearchSalesId").val(0);
	$("#SearchStartDate").val("");
	$("#SearchEndDate").val("");
	$('#reset').val('1');
	SearchAdvance();
}
</script>

<!-- HEADER -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5><?php echo $ControllerName?></h5>
            <span>Index</span>
        </div>
        <div class="middleNav">
	        <ul>
	            <li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName?>/Add" title="Add New <?php echo $ControllerName?>"><span class="addnewuser"></span></a></li>
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
	                  <a href="<?php echo $this->Html->url(array('controller' => 'Home')) ?>">Dashboard</a>
	             </li>
	             <li class="current">
	                  <a href="#"><?php echo $ControllerName?></a>
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
	                    	echo $this->Form->input('Search.start', array(
								'label'			=>	'Start date / single date',
	                    		'div'			=>	array("class"=>"dataTables_filter"),
	                    		'between'		=>	'<div class="formRight">',
	                    		'after'			=>	'</div>',
	                    		'class'			=>	'datepicker'
	                    	));
						?>
						<?php
	                    	echo $this->Form->input('Search.end', array(
								'label'			=>	'End date',
	                    		'div'			=>	array("class"=>"dataTables_filter"),
	                    		'between'		=>	'<div class="formRight">',
	                    		'after'			=>	'</div>',
	                    		'class'			=>	'datepicker'
	                    	));
						?>
					</fieldset>
					<fieldset>
						<?php
	                    	echo $this->Form->input('Search.id', array(
								'label'			=>	'ID',
	                    		'div'			=>	array("class"=>"dataTables_filter"),
	                    		'between'		=>	'<div class="formRight"><span class="span3">',
	                    		'after'			=>	'</span></div>'
	                    	));
						?>
						<?php
	                    	echo $this->Form->input('Search.name', array(
								'label'			=>	'Name',
	                    		'div'			=>	array("class"=>"dataTables_filter"),
	                    		'between'		=>	'<div class="formRight">',
	                    		'after'			=>	'</div>'
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