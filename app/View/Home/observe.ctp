<?php
/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey (http://benramsey.com)
 * @license http://opensource.org/licenses/MIT MIT
 */
if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}
?>
<?php echo $this->start("script");?>
<script>
  var totalImage		=	0;
  var counterImage	=	0;

$(document).ready(function(){

  <?php
    if(isset($this->request->data['Appointment']["photo"])) {
      foreach($this->request->data['Appointment']["photo"] as $k => $photo) {

        if(isset($errorImg[$k])) {
          ?>
          AddImage('<?php echo $errorImg[$k]; ?>','<?php echo $photo["url"]?>');
          <?php
        } else {
          ?>
          AddImage('','<?php echo $photo["url"]?>');
          <?php
        }


      }
    }
  ?>
});

function AddImage(errorImg,defaultImage)
	{
		if(counterImage<5)
		{
			var b	=	'\
			<div class="formRow" id="uploadForm'+totalImage+'">\
				<label id="labelImages'+totalImage+'"></label>\
				<div class="formRight">\
					<div style="float:left; display:block;">\
						<a rel="lightbox" href="'+defaultImage+'" id="lighbox'+totalImage+'" title="Image - '+(totalImage+1)+'"><img width="100" height="50" src="'+defaultImage+'?time=<?php echo time()?>" id="previewImg'+totalImage+'"></a>\
					</div>\
					<div style="float:left; display:block; margin-left:10px;width:260px;">\
						<input type="file" style="float: left; display: block; opacity: 0;" name="data[Appointment][photo][]" size="25" onchange="PreviewImage(\'file'+totalImage+'\',\'previewImg'+totalImage+'\',\'#lighbox'+totalImage+'\')" id="file'+totalImage+'">\
						<div style="float:left; display:block;">(Width: 500px, Height: 250px)</div>\
						<div style="float:left; display:block;color:#a73939; width:100%;">'+errorImg+'\
						</div>\
					</div>\
					<a href="javascript:void(0);" onclick="javascript:$(\'#uploadForm'+totalImage+'\').remove();counterImage--;ReorderLable();if(counterImage==0){$(\'#submitImage\').hide();$(\'#cancelImage\').hide()}" class="tipS smallButton" title="Delete" style="margin-left:10px;padding: 5px 7px;">\
						<img src="<?php echo $this->webroot?>img/icons/color/cross.png" alt="Delete"/>\
					</a>\
				</div>\
			</div>\
			';
			$("#submitImage").show();
			$("#cancelImage").show();
			$("#image-lyt").append(b);
			$("#file"+totalImage).uniform();
			totalImage++;
			counterImage++;
			ReorderLable();
			$("a[rel^='lightbox']").prettyPhoto({
				social_tools :''
			});
		}
		else
		{
			alert("Maximum photos is 5");
		}
	}

  function ReorderLable()
	{
		$("#image-lyt").find("label[id^=labelImages]").each(function(k,item){
			$(this).html("Image - "+(k+1));
		});
	}

  function PreviewImage(fileId,imageId,lighbox) {
        if ( window.FileReader && window.File && window.FileList && window.Blob )
		{
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById(fileId).files[0]);
			oFReader.onload = function (oFREvent) {
				document.getElementById(imageId).src = oFREvent.target.result;
				$(lighbox).attr("href",oFREvent.target.result);
			};
		}
  }

</script>
<?php echo $this->end();?>

<?php echo $this->start("css");?>
<?php echo $this->end();?>



<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Patient Name : <?php echo $appointment['Patient']['name']; ?></h5>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser">
					<a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'index')) ?>" title="Dashboard"><span class="list"></span></a>
				</li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">
  <?php echo $this->Session->flash(); ?>
	<!-- Tabs -->
  <div class="fluid">
      <div class="span12">
          <div class="widget">
						<?php echo $this->Form->create('Appointment', array('url' => array("controller"=>'Home',"action"=>"Observe", $appointment_id),'class' => 'form',"type"=>"file")); ?>
						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>Analyze patient</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Mandatory Fields</a></li>
                      <li><a href="#tabs-8">Photos</a></li>
                  </ul>
                  <div id="tabs-7">
                      <fieldset>
                        <div class="formRow">
                          <label>Patient Name : </label>
                          <div class="formRight">
                            <a target="_BLANK" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'View', $appointment['Patient']['id'])) ?>"><span class="blueBack"><?php echo $appointment['Patient']['name']; ?></span></a>
                          </div>
                        </div>
                        <div class="formRow">
                          <label>Patient Name : </label>
                          <div class="formRight">
                            <span class="greenBack"><?php echo $appointment['Doctor']['fullname']; ?></span>
                          </div>
                        </div>
                        <?php
                          echo $this->Form->input('id');
													echo $this->Form->input('observation_notes', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));
												?>
												<div class="span12">
													<div class="formSubmit">
														<input type="submit" value="Save" class="redB" />
														<input type="reset" value="Reset" class="blueB"/>
														<input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $this->webroot ?>Home/Index'"/>
													</div>
												</div>
											</fieldset>
											<?php echo $this->Form->end(); ?>
                  </div>
                  <div id="tabs-8">
        						<div id="image-lyt">
        						</div>
        						<a href="javascript:void(0);" title="Add Images" class="button blueB" style="color:white;" onclick="AddImage('')">
        							<img src="<?php echo $this->webroot?>img/icons/light/add.png" alt="" class="icon" />
        							<span>Add Images</span>
        						</a>
        						<input type="submit" value="Save" class="redB" id="submitImage" style="display:none;"/>
        						<input type="button" value="Cancel" class="blackB" id="cancelImage" style="display:none;" onclick="location.href = '<?php echo $this->webroot; ?>Home/Index'"/>
        					</div>
              </div>
          </div>
      </div>
  </div>
	<div class="fluid">
	</div>
</div>
