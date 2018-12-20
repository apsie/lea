<?php
include("./inc/class.epce.inc.php");
$epce=new epce();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>eGroupWare [Calendrier - Recherche de disponibilité]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="eGroupWare" />
		<meta name="description" content="eGroupware" />
		<meta name="keywords" content="eGroupWare" />
		<meta name="copyright" content="eGroupWare http://www.egroupware.org (c) 2003" />
		<meta name="language" content="fr" />
		<meta name="author" content="eGroupWare http://www.egroupware.org" />
		<meta name="robots" content="none" />
		<link rel="icon" href="http://82.224.197.142:81/lea0/phpgwapi/templates/jerryr/images/favicon.ico" type="image/x-ico" />
		<link rel="shortcut icon" href="http://82.224.197.142:81/lea0/phpgwapi/templates/jerryr/images/favicon.ico" />
		<link href="http://82.224.197.142:81/lea0/phpgwapi/templates/jerryr/css/jerryr.css" type="text/css" rel="StyleSheet" />
		<script src="http://82.224.197.142:81/lea0/phpgwapi/templates/jerryr/js/slidereffects.js" type="text/javascript">
		</script>
		
		<!-- This solves the Internet Explorer PNG-transparency bug, but only for IE 5.5 and higher --> 
		<!--[if gte IE 5.5000]>
		<script src="http://82.224.197.142:81/lea0/phpgwapi/templates/jerryr/js/pngfix.js" type="text/javascript">
		</script>
		<![endif]-->
		<style type="text/css">
<!--
	.row_on { color: #000000; background-color: #DDDDDD; }
	.row_off { color: #000000; background-color: #EEEEEE; }
	.th { color: #000000; background-color: #D3DCE3; }
	.narrow_column { width: 1%; white-space: nowrap; }
	@media screen {	.onlyPrint { display: none; } }
	@media print {	.noPrint { display: none; } }
	
-->
</style>
<LINK href="http://82.224.197.142:81/lea0/calendar/templates/default/app.css" type=text/css rel=StyleSheet>

		<script src="http://82.224.197.142:81/lea0/phpgwapi/js/foldertree/foldertree.js" type="text/javascript"></script>
		<!--JS Imports from phpGW javascript class -->
<script type="text/javascript" src="http://82.224.197.142:81/lea0/phpgwapi/js/jsapi/./jsapi.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="http://82.224.197.142:81/lea0/phpgwapi/js/jscalendar/calendar-blue.css" title="blue" />
<script type="text/javascript" src="http://82.224.197.142:81/lea0/phpgwapi/js/jscalendar/calendar.js"></script>
<script type="text/javascript" src="http://82.224.197.142:81/lea0/phpgwapi/inc/jscalendar-setup.php"></script>
<script>
window.focus();
</script>
<script type="text/javascript" src="http://82.224.197.142:81/lea0/etemplate/js/etemplate.js"></script>
<script>

function checkAllInput(form, action)
{
	
   var i = document.forms[form].getElementsByTagName("input");
    for ( var cpt = 0; cpt < i.length; cpt++)
                              i[cpt].checked = (action)? true : false ;
}

</script>



	</head>
	<!-- we don't need body tags anymore, do we?) we do!!! onload!! LK -->
	<body  bgcolor="#FFFFFF" alink="red" link="blue" vlink="blue"  onLoad="set_style_by_class('table','end_hide','visibility','hidden');"><div id="divMain">
<form method="POST" name="eTemplate" action="" >
<input type="hidden" name="etemplate_exec_id" value="calendar:126691300009" />
<script language="javascript">
document.write('<input type="hidden" name="java_script" value="1" />');
if (document.getElementById) {
	document.write('<input type="hidden" name="dom_enabled" value="1" />');
}
</script>
<input type="hidden" name="submit_button" value="" />
<input type="hidden" name="innerWidth" value="" />


<!-- BEGIN eTemplate calendar.freetimesearch -->

<style type="text/css">
<!--
.size120b { text-size: 120%; font-weight: bold; }
.redItalic { color: red; font-style: italic; }
.end_hide { visibility: hidden; }
-->
</style>



<!-- BEGIN grid  -->
<table >
	<tr >
		<td  align="left" class="size120b">Options pour</td>
		<td  align="left" ><?php $epce->selectionner_conseiller(); echo' à '; ?> <select name="lieu"><option value="Aubervilliers">Aubervilliers</option><option value="Bagnolet">Bagnolet_2</option><option value="Bobigny">Bobigny_2</option><option value="Epinay">Epinay</option><option value="La Courneuve">La Courneuve</option><option value="Pierrefitte">Pierrefitte</option><option value="Saint-Denis">Saint-Denis_W</option><option value="Saint-Ouen">Saint-Ouen</option><option value="Stains">Stains</option></select></td>
	</tr>
	<tr >
		<td  align="left">Date/heure de début </td>
		<td  align="left">

<!-- BEGIN eTemplate *** generated fields for date -->





<!-- BEGIN grid  -->
<table  cellspacing="0">
	<tr >
		<td  align="left"><input type="text" id="exec[start][str]" name="date_start" size="10" value="<?php echo date('Y/m/d');?>" onFocus="self.status='Date/heure de début de recherche'; return true;" onBlur="self.status=''; return true;"/>
<script type="text/javascript">
	document.writeln('<img id="exec[start][str]-trigger" src="http://82.224.197.142:81/lea0/phpgwapi/templates/default/images/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "exec[start][str]",
		button      : "exec[start][str]-trigger"
	}
	);
</script>
</td>
		<td  align="left"> &nbsp; &nbsp; </td>
		<td  align="left"><!--<select name="heure_start" id="exec[start][H]"  onFocus="self.status='Heure: Date/heure de début de recherche*'; return true;" onBlur="self.status=''; return true;">
<option value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9" selected="selected">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select>
</td>
		<td  align="left"><label for="exec[start][i]" >:</label> <select name="min_start" id="exec[start][i]"  onFocus="self.status='Minute: Date/heure de début de recherche*'; return true;" onBlur="self.status=''; return true;">
<option value="0">00</option>
<option value="5">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select>-->
</td>
	</tr>
</table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
	</tr>
	<tr >
		<td  align="left">Duration* </td>
		<td  align="left">

<!-- BEGIN hbox -->

<table >
	<tr >
		<td ><select name="duree" id="exec[duration]"  onFocus="self.status='Durée de la réunion'; return true;" onBlur="self.status=''; return true;" onChange="set_style_by_class('table','end_hide','visibility',this.value == '' ? 'visible' : 'hidden');">

<!--<option value="900">0:15</option>
<option value="1800">0:30</option>
<option value="2700">0:45</option>-->
<option value="3600" selected="selected">1:00</option>
<!--<option value="5400">1:30</option>
<option value="7200">2:00</option>
<option value="9000">2:30</option>
<option value="10800">3:00</option>
<option value="12600">3:30</option>
<option value="14400">4:00</option>
<option value="18000">5:00</option>
<option value="21600">6:00</option>
<option value="25200">7:00</option>
<option value="28800">8:00</option>-->
</select>
</td>
		<td  class="end_hide">

<!-- BEGIN eTemplate *** generated fields for date -->



<!-- BEGIN grid  -->
<table  class="end_hide" cellspacing="0">
	
</table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
	</tr>
</table>


<!-- END hbox -->

</td>
	</tr>
	<tr >
		<td  align="left">Plage horaire </td>
		<td  align="left">

<!-- BEGIN hbox -->

<table >
	<tr >
		<td >

<!-- BEGIN eTemplate *** generated fields for date -->



<!-- BEGIN grid  -->
<table  cellspacing="0">
	<tr >
		<td  align="left"><select name="plage1" id="exec[start_time][H]"  onFocus="self.status='Heure: Plage horaire de recherche*'; return true;" onBlur="self.status=''; return true;">


<option value="9" selected="selected" >09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>

</select>
</td>
	</tr>
</table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
		<td >jusqu'à </td>
		<td >

<!-- BEGIN eTemplate *** generated fields for date -->



<!-- BEGIN grid  -->
<table  cellspacing="0">
	<tr >
		<td  align="left"><select name="plage2" id="exec[end_time][H]"  onFocus="self.status='Heure: Plage horaire de recherche*'; return true;" onBlur="self.status=''; return true;">


<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17" selected="selected">17</option>
<option value="18">18</option>

</select>
</td>
	</tr>
    
</table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
		<!--<td >Jours de la semaine </td>
		<td ><div id="exec[weekdays]"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" style="height: 5.1em; width: 12.45em; background-color: white; overflow: auto; border: lightgray 2px inset;">
<label for="exec[weekdays][62]" ><input type="checkbox" name="exec[weekdays][]" value="62" checked="1"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][62]" />
working days*</label><br />
<label for="exec[weekdays][127]" ><input type="checkbox" name="exec[weekdays][]" value="127"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][127]" />
all days*</label><br />
<label for="exec[weekdays][65]" ><input type="checkbox" name="exec[weekdays][]" value="65"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][65]" />
weekend*</label><br />
<label for="exec[weekdays][2]" ><input type="checkbox" name="exec[weekdays][]" value="2"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][2]" />
Lundi</label><br />
<label for="exec[weekdays][4]" ><input type="checkbox" name="exec[weekdays][]" value="4"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][4]" />
Mardi</label><br />
<label for="exec[weekdays][8]" ><input type="checkbox" name="exec[weekdays][]" value="8"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][8]" />
Mercredi</label><br />
<label for="exec[weekdays][16]" ><input type="checkbox" name="exec[weekdays][]" value="16"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][16]" />
Jeudi</label><br />
<label for="exec[weekdays][32]" ><input type="checkbox" name="exec[weekdays][]" value="32"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][32]" />
Vendredi</label><br />
<label for="exec[weekdays][64]" ><input type="checkbox" name="exec[weekdays][]" value="64"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][64]" />
Samedi</label><br />
<label for="exec[weekdays][1]" ><input type="checkbox" name="exec[weekdays][]" value="1"  onFocus="self.status='Jour de la semaine à inclure dans la recherche'; return true;" onBlur="self.status=''; return true;" id="exec[weekdays][1]" />
Dimanche</label><br />
</div>
</td>-->
	</tr>
</table>


<!-- END hbox -->

</td>
	</tr><tr><tr><td>Sur</td><td><select name="selection"><option value="1">Un jour</option><option value="7">Une semaine</option><option value="14">Deux semaines</option><option value="21">Trois semaines</option><option value="28">Quatre semaines</option></select></td></tr>
	 
	<tr >
		<td  align="left"><input type="submit" name="exec[search]" value="Nouvelle recherche" id="exec[search]"  onMouseOver="self.status='Nouvelle recherche avec les paramètres notifiés au-dessus'; return true;" onMouseOut="self.status=''; return true;" onFocus="self.status='Nouvelle recherche avec les paramètres notifiés au-dessus'; return true;" onBlur="self.status=''; return true;" />
</td>
		<td  align="left">

<!-- BEGIN hbox -->
<!-- END hbox -->

</td>
	</tr>
	<tr >
		<td  colspan="2" align="left">

<!-- BEGIN eTemplate calendar.freetimesearch.rows -->





<!-- BEGIN grid  -->
<!-- END grid  -->

<!-- END eTemplate calendar.freetimesearch.rows -->

</td>
	</tr>
</table>
<!-- END grid  -->

<!-- END eTemplate calendar.freetimesearch -->

</form>
		 							  <?php
//$_POST['date_']. $_POST['prestation']. $_POST['option']. $_POST['lieu'];

if($_POST['date_start']!=null)
$epce->chercher_options($_POST['date_start'],$_POST['selection'],$_POST['plage1'],$_POST['plage2'],$_POST['duree'],$_POST['conseiller_id'],$_POST['lieu']);

?></td>
								</tr>
							</table>
							</div>
		  	<!-- Applicationbox Column -->
		  	</td>
			<td width=8 class="calRightShadow"></td>
		 </tr>
	</table>
	<table border=0 width=100% cellpadding=0 cellspacing=0>
		<tr>
			<td>
				<table width=100% cellpadding=0 cellspacing=0>
					<tr class="calRowBottomShadow">
						<td width=8 class="calLtLtFoot"></td>
						<td width=8 class="calLtMidFoot"></td>
						<td>&nbsp;</td>
						<td width=8 class="calRtMidFoot"></td>
						<td width=8 class="calRtRtFoot"></td>
					</tr>	
				</table>
			</td>
		</tr>
	</table>
  
</div>
</div>
	
<div id="divPoweredBy"><br/><span>Motorisé par <a href="http://www.egroupware.org">eGroupWare</a> version 1.2.106</span></div>	
<!-- enable wz_tooltips -->
<script src="http://82.224.197.142:81/lea0/phpgwapi/js/wz_tooltip/wz_tooltip.js" type="text/javascript"></script>

</body>
</html>
