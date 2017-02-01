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
						<?php echo $this->Form->create('Appointment', array('url' => array("controller"=>'Home',"action"=>"doTreatment", $appointment_id),'class' => 'form',"type"=>"file")); ?>
						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>Treatment Plan</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Observation Results</a></li>
                      <li><a href="#tabs-8">Treatment Plan</a></li>
                      <li><a href="#tabs-9">Treatment Resume</a></li>
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

                      <?php
                        foreach($appointment['AppointmentItem'] as $item) {

                          if(in_array($item['Item']['ItemCategory']['id'], $categoriesTreatment)) {
                            ?>
                            <div class="formRow">
                              <label><?php echo $item['Item']['ItemCategory']['name']." - ".$item['Item']['name'] ?></label>
                              <div class="formRight">
                                <?php
                                  echo $this->Form->input("AppointmentItem.".$item['id'].".id", array('type' => 'hidden', 'value' => $item['id']));

                                  if($item['done']) {
                                    echo $this->Form->checkbox('AppointmentItem.'.$item['id'].'.done', array(
                                      'checked' => 'checked'
                                    ));
                                  } else {
                                    echo $this->Form->checkbox('AppointmentItem.'.$item['id'].'.done', array(
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
                  <div id="tabs-9">
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
              </div>
              <div class="span12">
                <div class="formSubmit" style="margin-right:30px;">
                  <input type="submit" value="Save" class="redB" />
                  <input type="reset" value="Reset" class="blueB"/>
                  <input type="button" value="Cancel" class="blackB" onclick="location.href = '<?php echo $this->webroot ?>Home/Index'"/>
                </div>
              </div>
              <?php echo $this->Form->end(); ?>
          </div>
          <!-- Images gallery -->

      </div>
  </div>
	<div class="fluid">
	</div>
</div>
