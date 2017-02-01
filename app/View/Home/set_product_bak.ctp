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

						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>Treatment Plan</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Observation Results</a></li>
                      <li><a href="#tabs-8">Treatment Plan</a></li>
                      <li><a href="#tabs-9">Treatment Done</a></li>
                      <li><a href="#tabs-10">Set Product</a></li>
                  </ul>
                  <div id="tabs-7">
                    <form class="form">
                      <fieldset>
                        <div class="formRow">
                          <label>Patient Name : </label>
                          <div class="formRight">
                            <a target="_BLANK" href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'View', $appointment['Patient']['id'])) ?>"><span class="blueBack"><?php echo $appointment['Patient']['name']; ?></span></a>
                          </div>
                        </div>
                        <?php

													echo $this->Form->input('observation_notes', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
                            'readonly'   =>  'readonly',
                            'value'     =>  $appointment['Appointment']['observation_notes'],
                            'rows'      =>  6,
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
                    </form>
                  </div>
                  <div id="tabs-8">
                    <fieldset>
                      <?php $counterItem = count($this->request->data['AppointmentItem']); ?>
                      <div class="span12">
                        <!-- Toggles group -->
                        <div class="toggle">
                            <div class="title opened" id="toggleOpened"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon"/><h6>Procedure</h6></div>
                            <div class="body">
                              <?php
                                foreach($procedures as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Procedures - Laser</h6></div>
                            <div class="body">
                              <?php
                                foreach($lasers as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Procedures - RF</h6></div>
                            <div class="body">
                              <?php
                                foreach($rfs as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Procedures - Injections</h6></div>
                            <div class="body">
                              <?php
                                foreach($injections as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Serums</h6></div>
                            <div class="body">
                              <?php
                                foreach($serums as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Maskers</h6></div>
                            <div class="body">
                              <?php
                                foreach($maskers as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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

                            <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Post Lasers</h6></div>
                            <div class="body">
                              <?php
                                foreach($postLasers as $item) {
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
                                              'disabled' => true
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
                                              'disabled' => true
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
                      </div>
                    </fieldset>
        					</div>
                  <div id="tabs-9">
                    <fieldset>

                      <?php
                        foreach($appointment['AppointmentItem'] as $item) {
                          if(in_array($item['Item']['ItemCategory']['id'], $categoriesTreatment) && $item['done'] == 1) {
                            ?>
                            <div class="formRow">
                              <label><?php echo $item['Item']['ItemCategory']['name']." - ".$item['Item']['name'] ?></label>
                              <div class="formRight">
                                <?php

                                  if($item['done']) {
                                    echo $this->Form->checkbox('AppointmentItemDash.'.$item['id'].'.done', array(
                                      'checked' => 'checked',
                                      'disabled' => true
                                    ));
                                  } else {
                                    echo $this->Form->checkbox('AppointmentItemDash.'.$item['id'].'.done', array(
                                      'disabled' => true
                                    ));
                                  }

                                ?>
                              </div>
                            </div>
                            <?php
                          }
                        }
                      ?>

                    </fieldset>
                  </div>
                  <div id="tabs-10">
                    <?php echo $this->Form->create('Appointment', array('url' => array("controller"=>'Home',"action"=>"setProduct", $appointment_id),'class' => 'form',"type"=>"file")); ?>

                    <?php
                    echo $this->Form->input('id');
                    ?>

                    <fieldset>
                      <div class="span12">
                        <!-- Toggles group -->
                        <div class="toggle">

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Sun Blocks</h6></div>
                          <div class="body">
                            <?php
                              foreach($sunBlocks as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Day Creams</h6></div>
                          <div class="body">
                            <?php
                              foreach($dayCreams as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Night Creams</h6></div>
                          <div class="body">
                            <?php
                              foreach($nightCreams as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Night Creams Acne</h6></div>
                          <div class="body">
                            <?php
                              foreach($nightCreamAcnes as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Cleansing Series</h6></div>
                          <div class="body">
                            <?php
                              foreach($cleansingSeries as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Serum Products</h6></div>
                          <div class="body">
                            <?php
                              foreach($serumProducts as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Masker Products</h6></div>
                          <div class="body">
                            <?php
                              foreach($maskerProducts as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Post Lasers</h6></div>
                          <div class="body">
                            <?php
                              foreach($postLasers as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Loose Powders</h6></div>
                          <div class="body">
                            <?php
                              foreach($loosePowders as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Body Lotions</h6></div>
                          <div class="body">
                            <?php
                              foreach($bodyLotions as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
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

                          <div class="title closed"><img src="<?php echo $this->webroot ?>img/icons/dark/transfer.png" alt="" class="titleIcon" /><h6>Products - Lab tests</h6></div>
                          <div class="body">
                            <?php
                              foreach($labTests as $item) {
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

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.quantity', array(
                                            'default' => 0
                                          ));

                                          echo $this->Form->input('AppointmentItem.'.$keyArray.'.lab_test', array(
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

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.quantity', array(
                                            'default' => 0
                                          ));

                                          echo $this->Form->input('AppointmentItem.'.$counterItem.'.lab_test', array(

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
                      </div>

                      <?php

                        echo $this->Form->input('suggestion', array(
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
              </div>

          </div>
          <!-- Images gallery -->

      </div>
  </div>
	<div class="fluid">
	</div>
</div>
