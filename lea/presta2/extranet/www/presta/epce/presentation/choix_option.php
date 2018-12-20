<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<link rel="icon" href="http://127.0.0.1/lea_/phpgwapi/templates/idots/images/favicon.ico" type="image/x-ico">
		<link rel="shortcut icon" href="http://127.0.0.1/lea_/phpgwapi/templates/idots/images/favicon.ico">
		<link href="index.php_fichiers/idots.css" type="text/css" rel="StyleSheet">
		<link href="index.php_fichiers/print.css" type="text/css" media="print" rel="StyleSheet">
		<script src="index.php_fichiers/slidereffects.js" type="text/javascript">
		</script>
		
		<!-- This solves the Internet Explorer PNG-transparency bug, but only for IE 5.5 and higher --> 
		<!--[if gte IE 5.5000]>
		<script src="/lea_/phpgwapi/templates/idots/js/pngfix.js" type="text/javascript">
		</script>
		<![endif]-->
		<style type="text/css">

	.row_on { color: #000000; background-color: #F1F1F1; }
	.row_off { color: #000000; background-color: #ffffff; }
	.th { color: #000000; background-color: #D3DCE3; }
	.narrow_column { width: 1%; white-space: nowrap; }
	@media screen {	.onlyPrint { display: none; } }
	@media print {	.noPrint { display: none; } }
	

#dhtmltooltip
{
	position: absolute;
	width: 150px;
	border: 1px solid #ff7a0a;
	padding: 2px;
    background-color:#f9f400;
	visibility: hidden;
	z-index: 100;
}

</style>
<link href="index.php_fichiers/app.css" type="text/css" rel="StyleSheet">

		<!--JS Imports from phpGW javascript class -->
<script type="text/javascript" src="index.php_fichiers/jsapi.js"></script>
<script language="JavaScript">
		
		function showphones(form) 
		{
			set_style_by_class("table","editphones","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		function showphones2(form) 
		{
			set_style_by_class("table","editphones2","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		function showphones3(form) 
		{
			set_style_by_class("table","editphones3","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		
		function hidephones(form) 
		{
			set_style_by_class("table","editphones","display","none");
			if (form) {
				copyvalues(form,"tel_home2","tel_home");
				copyvalues(form,"tel_work2","tel_work");
				copyvalues(form,"tel_cell2","tel_cell");
			}
		}
		
		function copyvalues(form,src,dst){
			var srcelement = getElement(form,src);  //ById("exec["+src+"]");
			var dstelement = getElement(form,dst);  //ById("exec["+dst+"]");
			if (srcelement && dstelement) {
				dstelement.value = srcelement.value;
			}
		}
		
		function getElement(form,pattern){
			for (i = 0; i < form.length; i++){
				if(form.elements[i].name){
					var found = form.elements[i].name.search(pattern);
					if (found != -1){
						return form.elements[i];
					}
				}
			}
		}
		
		</script><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>
<body>
<p align="center" style="font-size:14px; font-weight:bold">Choix des options
</p>

<?php


	
include("../inc/class.epce.inc.php");
$choix=$_GET['choix'];

$epce = new epce();
$epce->liste_option($choix);

?>
</body>