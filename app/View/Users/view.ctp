<?php echo $this->start("script");?>
<script>

		$(document).ready(function(){
			$( "#<?php echo $ModelName ?>BirthDate" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
				showOn: "button",
				buttonImage: "<?php echo $this->webroot ?>img/calendar-24.png",
	      buttonImageOnly: true,
				dateFormat: "yy-mm-dd",
				yearRange: "1930:<?php echo date('Y'); ?>"
	    });

			$( "#<?php echo $ModelName ?>JoinDate" ).datepicker({
	      changeMonth: true,
	      changeYear: true,
				showOn: "button",
	      buttonImage: "<?php echo $this->webroot ?>img/calendar-24.png",
	      buttonImageOnly: true,
				dateFormat: "yy-mm-dd"
	    });

			countAge();
			$("#UserBirthDate").change(function(){
				countAge();
			});

		});

		function calcAge(dateString) {
		  var birthday = +new Date(dateString);
		  return~~ ((Date.now() - birthday) / (31557600000));
		}

		function countAge() {
			var date = $("#UserBirthDate").val();

			if(date != "") {
				$("#UserAge").val(calcAge(date));
			} else {
				$("#UserAge").val("");
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
            <h5>View User</h5>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser">
					<a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a>
				</li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<div class="wrapper">

	<!-- Tabs -->
  <div class="fluid">
      <div class="span12">
          <div class="widget">
						<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"View", $ID),'class' => 'form',"type"=>"file")); ?>
						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>View User</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Mandatory Fields</a></li>
											<li><a href="#tabs-8">History</a></li>
											<li><a href="#tabs-9">Patient Lifestyle</a></li>
											<li><a href="#tabs-10">Past Treatment</a></li>
                  </ul>
                  <div id="tabs-7">
                      <fieldset>
												<?php
													echo $this->Form->input('id');
												?>
												<div class="formRow">
													<label>User Registered : </label>
													<div class="formRight">
														<?php echo $this->Time->nice($detail['User']['created']); ?>
													</div>
												</div>
												<div class="formRow">
													<label>Modified : </label>
													<div class="formRight">
														<?php echo $this->Time->nice($detail['User']['modified']); ?>
													</div>
												</div>
												<?php
													echo $this->Form->input('email', array(
														'type'			=>	'text',
														'label'			=>	'Email (*)',
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
												<div class="formRow">
													<?php
														echo $this->Form->input('first_name', array(
															'label'			=>	'First Name',
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('last_name', array(
															'label'			=>	'Last Name',
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('new_password', array(
															'type'			=>	'password',
															'label'			=>	'Password',
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('new_re_type_password', array(
															'type'			=>	'password',
															'label'			=>	'Re-type password',
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('birth_date', array(
															'type'			=>	'text',
															'label'			=>	'Birth Date',
															'div' 			=> false,
															'before'		=>	'<span class="span4">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'readonly'	=> 'readonly',
															'style'			=>	'margin-left:20px;width:100px;',
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('age', array(
															'type'			=>	'text',
															'label'			=>	'Age',
															'div' 			=> false,
															'before'		=>	'<span class="span4">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'readonly'	=>	'readonly',
															'style'			=>	'margin-left:20px;width:100px;',
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<?php
													echo $this->Form->input('gender', array(
														'label'			=>	'Gender',
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'options'		=>	array('1' => 'Male', '2' => 'Female', '3' => 'Dont want to disclose'),
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
												<?php
													echo $this->Form->input('address', array(
														'label'			=>	'Address',
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
												<div class="formRow">
													<?php
														echo $this->Form->input('phone_number', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('mobile_number', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('religion', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('citizenship', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('occupation', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('martial_status', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'options'		=>	array(2 => 'Single', 1 => 'Married', 3 => 'Widow', 4 => 'Divorced'),
															'empty'			=>	'Please choose',
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('spouse_name', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('children', array(
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<div class="formRow">
													<?php
														echo $this->Form->input('height', array(
															'div' 			=> false,
															'before'		=>	'<span class="span4">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('weight', array(
															'div' 			=> false,
															'before'		=>	'<span class="span4">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
													<?php
														echo $this->Form->input('waist', array(
															'div' 			=> false,
															'before'		=>	'<span class="span4">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                              'disabled'  =>  'disabled',
														));
													?>
												</div>
												<?php
													echo $this->Form->input('status', array(
														'label'			=>	'Status',
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'options'		=>	array('1' => 'Active', '0' => 'Not Active'),
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
											</fieldset>

                  </div>
									<!-- HISTORY -->
                  <div id="tabs-8">
										<fieldset>
											<?php
												echo $this->Form->input('home_care_products', array(
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));

												echo $this->Form->input('previous_treatment', array(
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));

												echo $this->Form->input('allergy', array(
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));

												echo $this->Form->input('medical_history', array(
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));

												echo $this->Form->input('contraindictions', array(
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));
											?>
										</fieldset>
                  </div>
									<!-- Lifestyle -->
									<div id="tabs-9">
										<fieldset>
											<?php
												echo $this->Form->input('water_per_day', array(
													'type'			=>	'text',
													'label'			=>	'How many glasses of water intake/day?',
													'div' 			=> 'formRow',
													'between'		=> '<div class="formRight">',
													'after' 		=> '</div>',
													"required"		=>	"",
													"autocomplete"	=>	"off",
													'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                          'disabled'  =>  'disabled',
												));
											?>
											<div class="formRow">
												<?php
													echo $this->Form->input('coffee_per_day', array(
														'type'			=>	'text',
														'div' 			=> false,
														'before'		=>	'<span class="span4">',
														'after' 		=> '</span>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
												<?php
													echo $this->Form->input('tea_per_day', array(
														'type'			=>	'text',
														'div' 			=> false,
														'before'		=>	'<span class="span4">',
														'after' 		=> '</span>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
												<?php
													echo $this->Form->input('alcohol_per_day', array(
														'type'			=>	'text',
														'div' 			=> false,
														'before'		=>	'<span class="span4">',
														'after' 		=> '</span>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
                            'disabled'  =>  'disabled',
													));
												?>
											</div>
											<div class="formRow">
												<label>Smoking ?</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('smoking', array(0 => 'No', 1 => 'Yes'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
											<div class="formRow">
												<label>Exercise Regularly</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('excersise', array(0 => 'No', 1 => 'Yes'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
											<div class="formRow">
												<label>Diet</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('diet', array(1 => 'Healty', 2 => 'Balanced', 3 => 'Poor'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
											<div class="formRow">
												<label>Lifestyle</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('lifestyle', array(1 => 'Active', 2 => 'Sedentary'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
											<div class="formRow">
												<label>Work</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('work', array(1 => 'Shifts', 2 => 'Night', 3 => 'Irregular'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
											<div class="formRow">
												<label>Energy Level</label>
												<div class="formRight">
												<?php
													echo $this->Form->radio('energy_level', array(1 => 'Normal', 2 => 'Nervous', 3 => 'Anxious', 4 => 'Depression'), array(
														'legend' => false,
                            'disabled'  =>  'disabled',
													));
												?>
												</div>
											</div>
										</fieldset>
                  </div>
									<div id="tabs-10">
										<div class="widget">
											<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/frames.png" alt="" class="titleIcon"><h6>Details</h6></div>
												<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
														<thead>
																<tr>
																		<td>Date</td>
																		<td>Doctor</td>
																		<td>Action</td>
																</tr>
														</thead>
														<tbody>
																<?php
																	$theTotal = 0;
																	foreach($appointments as $ctr => $appointment) {
																		?>
																			<tr>
																				<td><?php echo $this->Time->nice($appointment['Appointment']['created']) ?></td>
																				<td><?php echo $appointment['Doctor']['fullname'] ?></td>
																				<td>
																					<a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'viewAppointment', $appointment['Appointment']['id'])) ?>" title="" class="button greenB" style="margin: 5px;"><img src="<?php echo $this->webroot ?>img/icons/light/check.png" alt="" class="icon">
					                                  <span>View History</span>
					                                </a>
																				</td>
																			</tr>
																		<?php
																	}
																?>
														</tbody>
												</table>
										</div>
									</div>
              </div>
          </div>
					<?php echo $this->Form->end(); ?>
      </div>
  </div>
	<div class="fluid">
	</div>
</div>
