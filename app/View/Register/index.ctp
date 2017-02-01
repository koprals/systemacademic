<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>8th Avenue</title>
<?php

//FAVICON
echo $this->Html->meta('icon',$this->webroot."img/favicon.ico",array("type"=>"ico"));

//************ CSS NEEDED ****************//
echo $this->Html->css("main");
//************ CSS NEEDED ****************//

//BLOCK CSS
echo $this->fetch('css');

//************ JS NEEDED ******************/
echo $this->Html->script(array(
	"jquery-1.7.2.min",
	"jquery-ui-1.8.21.custom.min",
	"/js/plugins/spinner/jquery.mousewheel.js",

	"/js/globalize/globalize.js",
	"/js/globalize/globalize.culture.de-DE.js",
	"/js/globalize/globalize.culture.ja-JP.js",

	"/js/plugins/charts/excanvas.min.js",
	"/js/plugins/charts/jquery.flot.js",
	"/js/plugins/charts/jquery.flot.orderBars.js",
	"/js/plugins/charts/jquery.flot.pie.js",
	"/js/plugins/charts/jquery.flot.resize.js",
	"/js/plugins/charts/jquery.sparkline.min.js",

	"/js/plugins/forms/uniform.js",
	"/js/plugins/forms/jquery.cleditor.js",
	"/js/plugins/forms/jquery.validationEngine-en.js",
	"/js/plugins/forms/jquery.validationEngine.js",
	"/js/plugins/forms/jquery.tagsinput.min.js",
	"/js/plugins/forms/jquery.autosize.js",
	"/js/plugins/forms/jquery.maskedinput.min.js",
	"/js/plugins/forms/jquery.dualListBox.js",
	"/js/plugins/forms/jquery.inputlimiter.min.js",
	"/js/plugins/forms/chosen.jquery.min.js",

	"/js/plugins/wizard/jquery.form.js",
	"/js/plugins/wizard/jquery.validate.min.js",
	"/js/plugins/wizard/jquery.form.wizard.js",
	"/js/plugins/uploader/plupload.js",
	"/js/plugins/uploader/plupload.html5.js",
	"/js/plugins/uploader/plupload.html4.js",
	"/js/plugins/uploader/jquery.plupload.queue.js",
	"/js/plugins/tables/datatable.js",
	"/js/plugins/tables/tablesort.min.js",
	"/js/plugins/tables/resizable.min.js",
	"/js/plugins/ui/jquery.tipsy.js",
	"/js/plugins/ui/jquery.collapsible.min.js",
	"/js/plugins/ui/jquery.prettyPhoto.js",
	"/js/plugins/ui/jquery.progress.js",
	"/js/plugins/ui/jquery.timeentry.min.js",
	"/js/plugins/ui/jquery.colorpicker.js",
	"/js/plugins/ui/jquery.jgrowl.js",
	"/js/plugins/ui/jquery.breadcrumbs.js",
	"/js/plugins/ui/jquery.sourcerer.js",
	"/js/plugins/jquery.fullcalendar.js",
	"/js/plugins/jquery.elfinder.js",
	"/js/jquery-ui.multidatespicker.js",
	"/js/custom.js",
	"/js/jquery.timeentry.js",
	"/js/jquery.jCounter-0.1.4.js",
	"/js/jquery.lazy.min.js" //http://jquery.eisbehr.de/lazy/
));
//************ JS NEEDED ******************/

//BLOCK JAVASCRIPT
echo $this->fetch('script');


?>


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
</head>

<body class="nobg ">

<!-- Top fixed navigation -->


<div class="wrapper">
  <div class="widget">
    <?php
      echo $this->Session->flash();
    ?>
  </div>
	<!-- Tabs -->
  <div class="fluid">
      <div class="span12">
          <div class="widget">
						<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>'Register',"action"=>"Index"),'class' => 'form',"type"=>"file")); ?>
						<div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/settings.png" alt="" class="titleIcon" /><h6>8th Avenue Patient Registration</h6>
						</div>
              <div class="tabs tabs-sortable">
                  <ul>
                      <li><a href="#tabs-7">Mandatory Fields</a></li>
                  </ul>
                  <div id="tabs-7">
                      <fieldset>
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
														));
													?>
												</div>
												<div class="formRow">
													<?php
/*
														echo $this->Form->input('new_password', array(
															'type'			=>	'password',
															'label'			=>	'Password',
															'div' 			=> false,
															'before'		=>	'<span class="span6">',
															'after' 		=> '</span>',
															"required"		=>	"",
															"autocomplete"	=>	"off",
															'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
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
														));
*/													?>
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
														));
													?>
												</div>

												<?php
													echo $this->Form->input('home_care_products', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));

													echo $this->Form->input('previous_treatment', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));

													echo $this->Form->input('allergy', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));

													echo $this->Form->input('medical_history', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));

													echo $this->Form->input('contraindictions', array(
														'div' 			=> 'formRow',
														'between'		=> '<div class="formRight">',
														'after' 		=> '</div>',
														"required"		=>	"",
														"autocomplete"	=>	"off",
														'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
													));
												?>

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
														));
													?>
												</div>
												<div class="formRow">
													<label>Smoking ?</label>
													<div class="formRight">
													<?php
														echo $this->Form->radio('smoking', array(0 => 'No', 1 => 'Yes'), array(
															'legend' => false,
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
														));
													?>
													</div>
												</div>

												<div class="formRow">
													<div class="formRight">
														<?php
															echo $this->Form->checkbox('accept_aggreement', array(
															));
														?>
														<label for="UserAcceptAggreement">I certify that the above medical history information is accurate and correct.</label>
													</div>
												</div>



												<?php
													echo $this->Form->input('status', array(
                            'type'      =>  'hidden',
                            'value'     =>  1,
													));
												?>
											</fieldset>

                  </div>
              </div>
          </div>
					<div class="span12">
						<div class="formSubmit">
							<input type="submit" value="Register" class="redB" />
						</div>
					</div>
					<?php echo $this->Form->end(); ?>
      </div>
  </div>
	<div class="fluid">
	</div>
</div>

</body>
</html>
