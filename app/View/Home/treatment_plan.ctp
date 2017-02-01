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
						<?php echo $this->Form->create('Appointment', array('url' => array("controller"=>'Home',"action"=>"treatmentPlan", $appointment_id),'class' => 'form',"type"=>"file")); ?>
						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>Treatment Plan</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Observation Results</a></li>
                      <li><a href="#tabs-8">Treatment Plan</a></li>
                      <li><a href="#tabs-9">Set Product</a></li>
                      <li><a href="#tabs-10">Treatment Resume</a></li>
                      <li><a href="#tabs-11">Lab Test</a></li>
                  </ul>
                  <div id="tabs-7">
                      <fieldset>
                        <div class="formRow">
                          <label>Patient Name : </label>
                          <div class="formRight">
                            <a target="_BLANK" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'View', $appointment['Patient']['id'])) ?>"><span class="blueBack"><?php echo $appointment['Patient']['name']; ?></span></a>
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
                            'readonly'   =>  'readonly',
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));
												?>
                        <div class="widget">
                            <div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/images2.png" alt="" class="titleIcon" /><h6>Observation Images</h6></div>
                            <div class="gallery">
                               <ul>
                                    <?php
                                      if(isset($appointment['AppointmentImage']) && !empty($appointment['AppointmentImage'])) {
                                        foreach($appointment['AppointmentImage'] as $image) {
                                            ?>
                                            <li><a href="<?php echo $image['Image']['host'].$image['Image']['url'] ?>" title="" rel="lightbox"><img width="100" height="100" src="<?php echo $image['ImageThumb']['host'].$image['ImageThumb']['url'] ?>" alt="" /></a>
                                            </li>
                                            <?php
                                        }
                                      }
                                    ?>
                               </ul>
                               <div class="fix"></div>
                           </div>
                        </div>
											</fieldset>
                  </div>
                  <div id="tabs-8">
                    <fieldset>
                      <div class="span12">
                        <?php $counterItem = count($this->request->data['AppointmentItem']); ?>
                        <?php
                          foreach($treatments as $category) {
                            ?>
                            <div class="toggle">
                              <div class="title opened" id="toggleOpened"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon"/><h6><?php echo $category['ItemCategory']['name'] ?></h6></div>
                              <div class="body">
                                <?php
                                  foreach($category['Item'] as $item) {
                                    ?>
                                    <div class="formRow">
                                      <label><?php echo $item['Item']['name'] ?></label>
                                      <div class="formRight">
                                        <?php
                                          $keyArray = array_search($item['Item']['id'],  array_column($this->request->data['AppointmentItem'], 'item_id'));

                                          $stringKeyArray = strval($keyArray);

                                          if($stringKeyArray != "") {

                                            echo $this->Form->input('AppointmentItem.'.$keyArray.'.item_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $item['Item']['id']
                                            ));
                                            echo $this->Form->input('AppointmentItem.'.$keyArray.'.appointment_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $appointment_id
                                            ));

                                            echo $this->Form->checkbox('AppointmentItem.'.$keyArray.'.status', array(

                                            ));

                                            if(isset($this->request->data['AppointmentItem'][$keyArray]['id'])) {
                                              echo $this->Form->input('AppointmentItem.'.$keyArray.'.id', array(
                                                'type' => 'hidden',
                                                'value' =>  $this->request->data['AppointmentItem'][$keyArray]['id']
                                              ));
                                            }


                                          } // ini belum ada di database nih
                                          else {
                                            echo $this->Form->input('AppointmentItem.'.$counterItem.'.item_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $item['Item']['id']
                                            ));
                                            echo $this->Form->input('AppointmentItem.'.$counterItem.'.appointment_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $appointment_id
                                            ));

                                            echo $this->Form->checkbox('AppointmentItem.'.$counterItem.'.status', array(

                                            ));

                                            $counterItem++;

                                          }

                                        ?>
                                      </div>
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                            </div>
                            <?php
                          }
                        ?>
                      </div>
                    </fieldset>
        					</div>
                  <div id="tabs-9">
                    <fieldset>
                      <div class="span12">
                        <?php
                          foreach($products as $category) {
                            ?>
                            <div class="toggle">
                              <div class="title opened" id="toggleOpened"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon"/><h6><?php echo $category['ItemCategory']['name'] ?></h6></div>
                              <div class="body">
                                <?php
                                  foreach($category['Item'] as $item) {
                                    ?>
                                    <div class="formRow">
                                      <label><?php echo $item['Item']['name'] ?></label>
                                      <div class="formRight">
                                        <?php
                                          $keyArray = array_search($item['Item']['id'],  array_column($this->request->data['AppointmentItem'], 'item_id'));

                                          $stringKeyArray = strval($keyArray);

                                          if($stringKeyArray != "") {

                                            echo $this->Form->input('AppointmentItem.'.$keyArray.'.item_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $item['Item']['id']
                                            ));
                                            echo $this->Form->input('AppointmentItem.'.$keyArray.'.appointment_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $appointment_id
                                            ));

                                            echo $this->Form->checkbox('AppointmentItem.'.$keyArray.'.status', array(

                                            ));

                                            if(isset($this->request->data['AppointmentItem'][$keyArray]['id'])) {
                                              echo $this->Form->input('AppointmentItem.'.$keyArray.'.id', array(
                                                'type' => 'hidden',
                                                'value' =>  $this->request->data['AppointmentItem'][$keyArray]['id']
                                              ));
                                            }


                                          } // ini belum ada di database nih
                                          else {
                                            echo $this->Form->input('AppointmentItem.'.$counterItem.'.item_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $item['Item']['id']
                                            ));
                                            echo $this->Form->input('AppointmentItem.'.$counterItem.'.appointment_id', array(
                                              'type' => 'hidden',
                                              'value' =>  $appointment_id
                                            ));

                                            echo $this->Form->checkbox('AppointmentItem.'.$counterItem.'.status', array(

                                            ));

                                            $counterItem++;

                                          }

                                        ?>
                                      </div>
                                    </div>
                                    <?php
                                  }
                                ?>
                              </div>
                            </div>
                            <?php
                          }
                        ?>
                      </div>
                    </fieldset>
        					</div>
                  <div id="tabs-10">
                      <fieldset>
                        <?php
													echo $this->Form->input('treatment_resume', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));
												?>
											</fieldset>
                  </div>
                  <div id="tabs-11">
                      <fieldset>
                        <?php
													echo $this->Form->input('lab_test', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));
												?>
											</fieldset>
                  </div>
              </div>
              <div class="span12">
                <fieldset>
                  <div class="formSubmit" style="margin-right:30px;">
                    <input type="submit" value="Save" class="redB" />
                    <input type="reset" value="Reset" class="blueB"/>
                    <input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $this->webroot ?>Home/Index'"/>
                  </div>
                </fieldset>
              </div>
              <?php echo $this->Form->end(); ?>
          </div>
          <!-- Images gallery -->

      </div>
  </div>
	<div class="fluid">
	</div>
</div>
