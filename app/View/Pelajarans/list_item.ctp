<?php if(!empty($data)): ?>
<?php
	$order		=	array_keys($this->params['paging'][$ModelName]['order']);
	$direction	=	$this->params['paging'][$ModelName]["order"][$order[0]];
	$ordered	=	($order[0]!==0) ? "/sort:".$order[0]."/direction:".$direction: "";
?>
<?php $this->Paginator->options(array(
				'url'	=> array(
					'controller'	=> $ControllerName,
					'action'		=> 'ListItem/limit:'.$viewpage,
				),
				'onclick'=>"return onClickPage(this,'#contents_area');")
			);
?>

<script>
function ChangeStatus(msg,id,status)
{
	var a	=	confirm(msg);
	if(a)
	{
		$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/ChangeStatus/"+id+"/"+status,function(result){
			alert(result.data.message);
			if(result.data.status == "1")
			{
				$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:<?php echo $page?>/limit:<?php echo $viewpage.$ordered?>",function(){
					$("#view, input:checkbox, #action").uniform();
					$('.tipS').tipsy({gravity: 's',fade: true});
				});
			}
		});
	}
	return false;
}

function Delete(msg,id)
{

	var a	=	confirm(msg);
	if(a)
	{
		$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/Delete/"+id,function(result){
			alert(result.data.message);
			if(result.data.status == "1")
			{
				$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:<?php echo $page?>/limit:<?php echo $viewpage.$ordered?>",function(){
					$("#view, input:checkbox, #action").uniform();
					$('.tipS').tipsy({gravity: 's',fade: true});
				});
			}
		});
	}

	return false;
}

function ActionChecked()
{
	var checked	=	"";
	$("input[id^=chck_]").each(function(index){
		if($(this).prop("checked"))
		{
			checked			+=		$(this).val()+",";
		}
	});
	checked		=	checked.substring(0,checked.length-1);

	if(checked.length == 0)
	{
		alert("Please check item!");
	}
	else
	{
		if($("#action").val() == "")
		{
			alert("Please select action!");
		}
		else
		{
			if( $("#action").val() == "delete" )
			{
				var a	=	confirm("Do you realy want to delete all selected item ?");
				if(a)
				{
					/*
					$("#loadingAction").show();

					$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/DeleteMultiple/",{
						"id":checked
					},function(result){
						$("#loadingAction").hide();
						alert(result.data.message);
						if(result.data.status == "1")
						{
							$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:1/limit:<?php echo $viewpage.$ordered?>",function(result){
								$("#view, input:checkbox, #action").uniform();
								$('.tipS').tipsy({gravity: 's',fade: true});
							});
						}
					});
					*/
				}
			}
			else if( $("#action").val() == "hide" )
			{
				var a	=	confirm("Do you realy want hide all selected item ?");
				if(a)
				{
					$("#loadingAction").show();
					$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/ChangeStatusMultiple/",{
						"id":checked,
						"status":"0",
						"child":"0",
					},function(result){
						$("#loadingAction").hide();
						alert(result.data.message);
						if(result.data.status == "1")
						{
							$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:1/limit:<?php echo $viewpage.$ordered?>",function(result){
								$("#view, input:checkbox, #action").uniform();
								$('.tipS').tipsy({gravity: 's',fade: true});
							});
						}
					});
				}
			}
			else if( $("#action").val() == "publish" )
			{
				var a	=	confirm("Do you realy want publish all selected item ?");
				if(a)
				{
					$("#loadingAction").show();
					$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/ChangeStatusMultiple/",{
						"id":checked,
						"status":"1",
						"child":"0",
					},function(result){
						$("#loadingAction").hide();
						alert(result.data.message);
						if(result.data.status == "1")
						{
							$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:1/limit:<?php echo $viewpage.$ordered?>",function(result){
								$("#view, input:checkbox, #action").uniform();
								$('.tipS').tipsy({gravity: 's',fade: true});
							});
						}
					});
				}
			}
		}
	}
}

function CheckAll(el)
{
	if($(el).prop("checked"))
	{
		$("input[id^=chck_]").prop('checked', true);
		$("input[id^=chck_]").parent("span").addClass("checked");
	}
	else
	{
		$("input[id^=chck_]").prop('checked', false);
		$("input[id^=chck_]").parent("span").removeClass("checked");
	}
}
</script>

<div class="widget">
	<div class="title">
		<img src="<?php echo $this->webroot ?>img/icons/dark/frames.png" alt="" class="titleIcon">
		<h6>
			Pelajarans - Page <?php echo $this->Paginator->counter(); ?>
		</h6>
	</div>
	<div class="title">
		<div class="itemsPerPage">
			<?php
			if(
				$access[$aco_id]["_update"] == 1 or
				$access[$aco_id]["_delete"] == 1
			):
			?>
			<div class="dataTables_left">
				<label>
					<span>Action Selected:</span>
					<?php
						$updateAction	=	array(
							"hide"			=>	"Hide",
							"publish"		=>	"Publish"
						);
						$deleteAction	=	array(
							"delete"		=>	"Delete"
						);
						$action			=	array();

						if($access[$aco_id]["_delete"] == 1)
							$action		=	array_merge($action,$deleteAction);
						if($access[$aco_id]["_update"] == 1)
							$action		=	array_merge($action,$updateAction);
					?>

					<?PHP echo $this->Form->select("action",$action,
					array(
						"empty"	=>	"Select Action"
					));?>
					<a href="javascript:void(0);" class="smallButton blueB" title="See Child" style=" cursor:default; padding:3px 15px 1px 15px; margin-left:10px; float:left;" onclick="ActionChecked()" >Go</a>
					<span style="float:left; margin-left:10px;display:none;;" id="loadingAction">
						<img src="<?php echo $this->webroot?>img/loaders/loader2.gif" /> Loading..
					</span>
				</label>
			</div>
			<?php endif;?>
			<div id="DataTables_Table_0_length" class="dataTables_length">
				<label>
					<span>Show entries:</span>
					<?PHP echo $this->Form->select("view",array(1=>1,5=>5,10=>10,20=>20,50=>50,100=>100,200=>200,1000=>1000),array("onchange"=>"onClickPage('".$settings["cms_url"].$ControllerName."/ListItem/limit:'+this.value+'".$ordered."','#contents_area')","empty"=>false,"default"=>$viewpage))?>
				</label>
			</div>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable">
		<thead>
			<tr>
				<?php
				if(
					$access[$aco_id]["_update"] == 1 or
					$access[$aco_id]["_delete"] == 1
				):
				?>
				<td style="width:5%;text-align:center;" >
					<input type="checkbox" onclick="CheckAll(this)"/>
				</td>
				<?php endif;?>
				<td style="width:5%;">
					No
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.kd_pelajaran",'Kode Pelajaran');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.nm_pelajaran",'Nama Pelajaran');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.nip",'Guru Pengajar');?>
				</td>
				<?php
				if(
					$access[$aco_id]["_update"] == 1 or
					$access[$aco_id]["_delete"] == 1
				):
				?>
				<td style="width:15%;">
					Action
				</td>
				<?php endif;?>
			</tr>
		</thead>
		<tbody>
			<?php $count = 0;?>
			<?php foreach($data as $data): ?>
				<?php $count++;?>
				<?php $no		=	(($page-1)*$viewpage) + $count;?>
				<?php $class	=	($data[$ModelName]['status'] == "0") ? "style='background-color:#FFDDDE'" : "";?>
				<tr <?php echo $class?>>
					<?php
					if(
						$access[$aco_id]["_update"] == 1 or
						$access[$aco_id]["_delete"] == 1
					):
					?>
					<td style="text-align:center;">
						<input type="checkbox" id="chck_<?php echo $data[$ModelName]['kd_pelajaran']?>" value="<?php echo $data[$ModelName]['kd_pelajaran']?>"/>
					</td>
					<?php endif;?>
					<td>
						<?php echo $no ?>
					</td>
					<td><?php echo $data[$ModelName]['kd_pelajaran'] ?></td>
					<td><?php echo $data[$ModelName]['nm_pelajaran'] ?></td>
					<td><?php echo $data[$ModelName]['nip'] ?></td>
					<?php
					if(
						$access[$aco_id]["_update"] == 1 or
						$access[$aco_id]["_delete"] == 1
					):
					?>
					<td style="text-align:center;">
						<?php if($access[$aco_id]["_update"] == 1):?>
							<a href="<?php echo $settings['cms_url'].$ControllerName?>/Edit/<?php echo $data[$ModelName]["kd_pelajaran"]?>/<?php echo $page?>/<?php echo $viewpage?>" class="tipS smallButton blueB" title="Edit">
								<img src="<?php echo $this->webroot?>img/icons/topnav/pencil.png" alt="Edit" />
							</a>
						<?php endif;?>
						<?php if($access[$aco_id]["_delete"] == 1):?>
							<a href="javascript:void(0);" onclick="Delete('Do you realy want to delete this item?','<?php echo $data[$ModelName]['kd_pelajaran']?>')" class="tipS smallButton redB" title="Delete">
								<img src="<?php echo $this->webroot?>img/icons/topnav/subTrash.png" alt="Delete"/>
							</a>
						<?php endif;?>
					</td>
					<?php endif;?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<?php
				if(
					$access[$aco_id]["_update"] == 1 or
					$access[$aco_id]["_delete"] == 1
				):
				?>
				<td colspan="11">
				<?php else:?>
				<td colspan="10">
				<?php endif;?>
					<div class="itemActions">
						<label><?php echo $this->Paginator->counter(array('format' => 'Showing %start% to %end% of %count% entries'));?></label>
					</div>
					<?php if($this->Paginator->hasPrev() or $this->Paginator->hasNext()):?>
					<div class="tPagination">
						<ul class="pages">
							<?php echo $this->Paginator->prev("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"prev"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>	"li",
										"escape"	=>	false,
										"class"		=>	"prev"
									)
								);
							?>

							<?php
								echo $this->Paginator->numbers(array(
									'separator'		=>	null,
									'tag'			=>	"li",
									'currentclass'	=>	'active',
									'modulus'		=>	4
								));
							?>
							<?php echo $this->Paginator->next("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"next"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>"li",
										"escape"	=>	false,
										"class"		=>	"next"
									)
								);
							?>
						</ul>
					</div>
					<?php endif;?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php else:?>
<div class="nNote nFailure">
	<p><strong>DATA IS EMPTY!</strong></p>
</div>
<?php endif;?>
