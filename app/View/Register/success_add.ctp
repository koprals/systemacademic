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

<body class="nobg errorPage">

<!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="welcome"><a href="#" title=""><img src="<?php echo $this->webroot ?>img/userPic.png" alt="" /></a><span>Welcome to 8th Avenue</span></div>
    </div>
</div>

<!-- Main content wrapper -->
<div class="errorWrapper">

    <span class="errorTitle">Data Has Been saved</span>
    <span class="errorNum offline" style="color:#5bd5d3">8th Avenue</span>
    <span class="errorDesc" style="color:#5bd5d3">Thank You</span>
    <a href="<?php echo $this->webroot ?>Register/Index" title="" class="button dredB"><span>Back to Register Page</span></a>
</div>

</body>
</html>
