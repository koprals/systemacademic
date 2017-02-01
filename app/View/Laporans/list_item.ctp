<?php if(!empty($data)): ?>
<?php
	$order		=	array_keys($this->params['paging'][$ModelName]['order']);
	$direction	=	$this->params['paging'][$ModelName]["order"][$order[0]];
	$ordered	=	($order[0]!==0) ? "/sort:".$order[0]."/direction:".$direction: "";
?>
<?php $this->Paginator->options(array(
				'url'	=> array(
					'controller'	=> $ControllerName,
					'action'		=> 'Result/limit:'.$viewpage,
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
				$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/Result/page:<?php echo $page?>/limit:<?php echo $viewpage.$ordered?>",function(){
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
							$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/Result/page:1/limit:<?php echo $viewpage.$ordered?>",function(result){
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
							$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/Result/page:1/limit:<?php echo $viewpage.$ordered?>",function(result){
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
			Laporan - Page <?php echo $this->Paginator->counter(); ?>
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
			</div>
			<?php endif;?>
			<div id="DataTables_Table_0_length" class="dataTables_length">
				<label>
					<span>Show entries:</span>
					<?PHP echo $this->Form->select("view",array(1=>1,5=>5,10=>10,20=>20,50=>50,100=>100,200=>200,1000=>1000),array("onchange"=>"onClickPage('".$settings["cms_url"].$ControllerName."/Result/limit:'+this.value+'".$ordered."','#contents_area')","empty"=>false,"default"=>$viewpage))?>
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
				<?php endif;?>
				<td style="width:5%;">
					No
				</td>
				<td style="width:5%;">
					<?php echo $this->Paginator->sort("$ModelName.id",'ID');?>
				</td>
				<td style="width:15%;">
					<?php echo $this->Paginator->sort("$ModelName.name",'Name');?>
				</td>
				<td style="width:15%;">
					<?php echo $this->Paginator->sort("$ModelName.phone",'No. Telefon ');?>
				</td>
				<td style="width:15%;">
					<?php echo $this->Paginator->sort("$ModelName.address",'Alamat');?>
				</td>
				<?php
				if(
					$access[$aco_id]["_update"] == 1 or
					$access[$aco_id]["_delete"] == 1
				):
				?>
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
					<?php endif;?>
					<td>
						<?php echo $no ?>
					</td>
					<td><?php echo $data[$ModelName]['id'] ?></td>
					<td><?php echo chunk_split($data[$ModelName]['name'],20,"<br/>") ?></td>
					<td><?php echo $data[$ModelName]['phone'] ?></td>
					<td><?php echo chunk_split($data[$ModelName]['address'],20,"<br/>") ?></td>
					<?php
					if(
						$access[$aco_id]["_update"] == 1 or
						$access[$aco_id]["_delete"] == 1
					):
					?>
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
	<a href="<?php echo $settings["cms_url"].$ControllerName?>/Excel" title="export to excel" class="wButton bluewB ml15 m10"><span>Export</span></a>
</div>
<?php else:?>
<div class="nNote nFailure">
	<p><strong>DATA IS EMPTY!</strong></p>
</div>
<?php endif;?>
