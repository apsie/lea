<?php 
require('./inc/class.epce.inc.php');
$epce = new epce();
$categorie = $_GET['categorie'];
	$mot = $_GET['mot'];
	$valid = $_GET['valid'];
	$choix = $_GET['choix'];

?>
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


	<!-- we don't need body tags anymore, do we?) we do!!! onload!! LK -->
	<div id="divMain">


<!-- BEGIN eTemplate etemplate.popup.manual -->

<style type="text/css">
<!--
.popupManual { position: absolute; right: 27px; top: 24px; }
-->
</style>

<div class="popupManual">
<a href="" onclick="window.open('/lea_/index.php?menuaction=manual.uimanual.view&amp;referer=http%3A%2F%2F127.0.0.1%2Flea_%2Findex.php%3F%3D%26menuaction%3Daddressbook.uicontacts.edit','manual','width=800,height=600,scrollbars=yes,resizable=yes'); return false;return submitit(eTemplate,'');; return false;" onmouseover="self.status='Open the online help.*'; return true;" onmouseout="self.status=''; return true;" onfocus="self.status='Open the online help.*'; return true;" onblur="self.status=''; return true;"><img src="../index.php_fichiers/manual-small.png" title="Manuel / Aide" border="0"></a></div>
<!-- END eTemplate etemplate.popup.manual -->
<form name="form_b" id="form_b" action="index.php" method="get"><table width="468" align="center"><tr >
		<td width="460" height="43" align="left"><img src="./index.php_fichiers/personal.png" border="0">
		<input type="hidden"  name="valid" value="1"/><input type="hidden"  name="page" value="presentation"/><select name="categorie"><option value="">Catégorie</option><option value="8">Bénéficiaire</option><option value="7">Prescripteur</option><option value="6">Employeur</option></select> 
		<?php  
	if($valid==1)
	{
		$epce->chercher_beneficiaire($mot,$categorie);
	}
	else
	{
	echo'<input name="mot" type="text" />';
	
	}
	
	
	?>		<input type="image" <?php 
	if($valid==1)
	{
		echo'src="./images/down_16.png" title="Afficher les données" ';	
	}
	else
	{
		echo'src="./images/search_16.png  title="Rechercher" ' ;
	}
	
	?>onclick="submit()" /><?php 
	if($valid==1)
	{
	echo' ou <a href="index.php?page=presentation">Nouvelle recherche</a>';
	}?> </td>
	
	</tr></table>
	
	</form><br/><?php 
	if($choix!=NULL)
	{
		$epce->afficher_contact($choix);
	}
	?>

<form method="POST" name="form" action="test.php" enctype="multipart/form-data" onsubmit="set_element2(this,'exec[link_to][file_path]','exec[link_to][file]')">
<input name="etemplate_exec_id" value="addressbook:126544982731" type="hidden">
<script language="javascript">
document.write('<input type="hidden" name="java_script" value="1" />');
if (document.getElementById) {
	document.write('<input type="hidden" name="dom_enabled" value="1" />');
}
</script><input name="java_script" value="1" type="hidden"><input name="dom_enabled" value="1" type="hidden">
<input name="submit_button" value="" type="hidden">
<input name="innerWidth" value="" type="hidden">


<!-- BEGIN eTemplate addressbook.edit -->



<div align="center">


<!-- BEGIN grid  -->
<table>
	<tbody><tr>
		<td colspan="2" align="left">

<!-- BEGIN grid  -->
<table>
	<tbody><tr>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table>
<!-- END grid  -->

</td>
	</tr>
	<tr valign="top">
		<td width="825" align="left">

<!-- BEGIN eTemplate etemplate.tab_widget -->

<style type="text/css">
<!--
.etemplate_tab,.etemplate_tab_active { border-style:solid; border-width:1px 1px 0px; border-color:black; padding:3px; padding-left: 6px; padding-right: 6px; width: 60px; white-space: nowrap; }
.etemplate_tab { cursor: pointer; cursor: hand; }
.etemplate_tab_active { border-width:2px 2px 0px; }
.tab_body { border: black solid 2px; }
-->
</style>



<!-- BEGIN grid  -->
<table width="100%" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="left">

<!-- BEGIN hbox -->

<table width="426">
	<tbody><tr>
		<td width="78" class="etemplate_tab_active th" id="addressbook.edit.personal-tab" onclick="activate_tab('addressbook.edit.personal','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation|details|links|evaluation]');">Bénéficiaire </td>
		<td width="60" class="etemplate_tab row_on" id="addressbook.edit.organisation-tab" onclick="activate_tab('addressbook.edit.organisation','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation||details|links|evaluation]');">Société du bénéficiaire</td>
		<td width="48" class="etemplate_tab row_on" id="addressbook.edit.home-tab" onclick="activate_tab('addressbook.edit.home','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation|details|links|evaluation]');">Addresse du bénéficiaire</td>
		<td width="81" class="etemplate_tab row_on" id="addressbook.edit.formation-tab" onclick="activate_tab('addressbook.edit.formation','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation|details|links|evaluation]');">Prescripteur</td>
		<td width="135" class="etemplate_tab row_on" id="addressbook.edit.details-tab" onclick="activate_tab('addressbook.edit.details','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation|details|links|evaluation]');">Infos prescripteur</td>
		<td width="81" class="etemplate_tab row_on" id="addressbook.edit.links-tab" onclick="activate_tab('addressbook.edit.links','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation|details|links|evaluation]');">Employeur  </td>
		<td width="81" class="etemplate_tab row_on" id="addressbook.edit.evaluation-tab" onclick="activate_tab('addressbook.edit.evaluation','personal|organisation|home|formation|details|links|evaluation','exec[personal|organisation|home|formation||details|links|evaluation]');">Infos Employeur</td>
	</tr>
</tbody></table>


<!-- END hbox -->

</td>
	</tr>
	<tr class="row_off">
		<td class="tab_body" align="left"><input name="exec[personal|organisation|home|formation|details|links|evaluation]" value="addressbook.edit.personal" type="hidden">
<div style="display: inline;" id="addressbook.edit.personal">


<!-- BEGIN eTemplate addressbook.edit.personal -->





<!-- BEGIN grid  -->
<table width="824"><tr><td width="415" ><table height="250">
	<tbody><tr>
		<td align="left"></td>
		<td align="left">Civilité</td>
		<td align="left"><select name="n_prefix" id="n_prefix"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Prénom </td>
		<td align="left"><input name="n_given" id="n_given" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxième prénom </td>
		<td align="left"><input name="n_middle" id="n_middle" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom </td>
		<td align="left"><input name="n_family" id="n_family" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom de jeune fille</td>
		<td align="left"><input name="n_suffix" id="n_suffix" size="45" maxlength="64">
</td>
	</tr>
	
	<tr valign="top">
		<td align="left"><img src="../index.php_fichiers/folder.png" border="0"></td>
		<td align="left">Catégorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_id" value="Usager_10"/> Usager_10 <?php //$epce->liste_categorie(); ?>
</div></td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private">Privé</label> </td>
		<td align="left"><input name="private" value="1" id="private" type="checkbox">
</td>
	</tr><tr><td></td><td>&nbsp;</td><td><input name="details" value="Etat civil" id="details" accesskey="m" onclick="showphones(this.form); return false;" type="submit" /></td></tr>
</tbody></table></td><td style="background-color: #F3F3F3; border-left:1px dashed #000" width="397" valign="top"><table align="center">
  <tbody><tr>
		<td height="45" colspan="3" align="center" ><img src="./images/address_16.png" /> Contact du bénéficiaire</strong>
		 </td>
	</tr>
	<tr >
		<td align="left"> </td>
		<td align="left"> </td>
		<td align="left"> </td>
	</tr>
	<tr>
		<td align="left">Tél Bureau </td>
		<td align="left"><input name="tel_work" id="tel_work" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Tél portable </td>
		<td align="left"><input name="tel_cell" id="tel_cell" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Privé </td>
		<td align="left"><input name="tel_home" id="tel_home" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Site web </td>
		<td align="left"><input name="url" id="url"  value="http://" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email bureau </td>
		<td align="left"><input name="email" id="email" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email domicile</td>
		<td align="left"><input name="email_home" id="email_home" size="30">
</td>
		<td align="left">
</td>
	</tr>
	
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
</tbody></table></td></tr></table>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.personal -->

</div>
<div style="display: none;" id="addressbook.edit.organisation">


<!-- BEGIN eTemplate addressbook.edit.organisation -->





<!-- BEGIN grid  -->
<table  height="250">
	<tbody><tr height="40">
		<td align="left"><img src="./index.php_fichiers/gohome.png" border="0"></td>
		<td align="left"><label for="org_name">Nom de la société</label> </td>
		<td align="left"><input name="org_name" id="org_name" size="45" maxlength="64">
</td>
	</tr><tr>
		<td align="left"><img src="./index.php_fichiers/gear.png" border="0"></td>
		<td align="left">Titre </td>
		<td align="left"><input name="title" id="title" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Département </td>
		<td align="left"><input name="org_unit" id="org_unit" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	
	<tr>
		<td align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td align="left">Rue </td>
		<td align="left"><input name="adr_one_street" id="adr_one_street" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 2 </td>
		<td align="left"><input name="address2" id="address2" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 3 </td>
		<td align="left"><input name="address3" id="address3" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><input name="adr_one_locality" id="adr_one_locality" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><input name="adr_one_postalcode" id="adr_one_postalcode" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Région </td>
		<td align="left"><input name="adr_one_region" id="adr_one_region" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><input name="adr_one_countryname" id="adr_one_countryname" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.organisation -->

</div>
<div style="display: none;" id="addressbook.edit.home">


<!-- BEGIN eTemplate addressbook.edit.home -->





<!-- BEGIN grid  -->
<table   height="250">
	<tbody><tr>
		<td align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td align="left">Rue </td>
		<td align="left"><input name="adr_two_street" id="adr_two_street" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><input name="adr_two_locality" id="adr_two_locality" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><input name="adr_two_postalcode" id="adr_two_postalcode" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Région </td>
		<td align="left"><input name="adr_two_region" id="adr_two_region" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><input name="adr_two_countryname" id="adr_two_countryname" size="45" maxlength="64">
</td>
	</tr>
	<tr><td></td><td></td>
	<!--<tr><td></td>
		<td align="left"><label for="exec[tz]">Fuseau horaire</label> </td>
		<td align="left"><select name="exec[tz]" id="exec[tz]">
<option value="-23">-23</option>
<option value="-22">-22</option>
<option value="-21">-21</option>
<option value="-20">-20</option>
<option value="-19">-19</option>
<option value="-18">-18</option>
<option value="-17">-17</option>
<option value="-16">-16</option>
<option value="-15">-15</option>
<option value="-14">-14</option>
<option value="-13">-13</option>
<option value="-12">-12</option>
<option value="-11">-11</option>
<option value="-10">-10</option>
<option value="-9">-9</option>
<option value="-8">-8</option>
<option value="-7">-7</option>
<option value="-6">-6</option>
<option value="-5">-5</option>
<option value="-4">-4</option>
<option value="-3">-3</option>
<option value="-2">-2</option>
<option value="-1">-1</option>
<option value="0" selected="selected">0</option>
<option value="1">+1</option>
<option value="2">+2</option>
<option value="3">+3</option>
<option value="4">+4</option>
<option value="5">+5</option>
<option value="6">+6</option>
<option value="7">+7</option>
<option value="8">+8</option>
<option value="9">+9</option>
<option value="10">+10</option>
<option value="11">+11</option>
<option value="12">+12</option>
<option value="13">+13</option>
<option value="14">+14</option>
<option value="15">+15</option>
<option value="16">+16</option>
<option value="17">+17</option>
<option value="18">+18</option>
<option value="19">+19</option>
<option value="20">+20</option>
<option value="21">+21</option>
<option value="22">+22</option>
<option value="23">+23</option>
</select>
</td>
	</tr>-->
	<!--<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Clé publique </td>
		<td align="left"><textarea name="exec[pubkey]" id="exec[pubkey]" rows="2" cols="45"></textarea>
</td>
	</tr>-->
</tbody></table>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.home -->

</div>
<div style="display: none;" id="addressbook.edit.formation">
<table><tr><td width="415"><table height="250">
	<tbody><tr>
		<td align="left"><img src="./index.php_fichiers/personal.png" border="0"></td>
		<td align="left">Civilité</td>
		<td align="left"><select name="n_prefix_" id="n_prefix_"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Prénom </td>
		<td align="left"><input name="n_given_" id="n_given_" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxième prénom </td>
		<td align="left"><input name="n_middle_" id="n_middle_" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom </td>
		<td align="left"><input name="n_family_" id="n_family_" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Suffixe </td>
		<td align="left"><input name="n_suffix_" id="n_suffix_" size="45" maxlength="64">
</td>
	</tr>
	
	<tr valign="top">
		<td align="left"><img src="../index.php_fichiers/folder.png" border="0"></td>
		<td align="left">Catégorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_prescripteur" value="Prescripteur"/> Prescripteur <?php //$epce->liste_categorie(); ?>
</div></td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private2">Privé</label> </td>
		<td align="left"><input name="private_" value="1" id="private2" type="checkbox">
</td>
	</tr><tr><td></td><td>&nbsp;</td><td></td></tr>
</tbody></table></td><td style="background-color: #F3F3F3; border-left:1px dashed #000" width="397" valign="top"><table align="center">
  <tbody><tr>
		<td height="45" colspan="3" align="center" ><img src="./images/address_16.png" /> Contact du prescripteur</strong>
		 </td>
	</tr>
	<tr >
		<td align="left"> </td>
		<td align="left"> </td>
		<td align="left"> </td>
	</tr>
	<tr>
		<td align="left">Tél Bureau </td>
		<td align="left"><input name="tel_work_" id="tel_work_" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Tél portable </td>
		<td align="left"><input name="tel_cell_" id="tel_cell_" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Privé </td>
		<td align="left"><input name="tel_home_" id="tel_home_" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Site web </td>
		<td align="left"><input name="url_" id="url_"  value="http://" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email bureau </td>
		<td align="left"><input name="email_" id="email_" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email domicile</td>
		<td align="left"><input name="email_home_" id="email_home_" size="30">
</td>
		<td align="left">
</td>
	</tr>
	
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
</tbody></table></td></tr></table>
</div>
<div style="display: none;" id="addressbook.edit.details">


<!-- BEGIN eTemplate addressbook.edit.details -->





<!-- BEGIN grid  -->
<div style="overflow: auto; width: 100%; height: 100%;">
<table height="250">
	<tbody><tr height="40">
		<td align="left"><img src="./index.php_fichiers/gohome.png" border="0"></td>
		<td align="left"><label for="org_name_">Nom de la société</label> </td>
		<td align="left"><input name="org_name_" id="org_name_" size="45" maxlength="64">
</td>
	</tr><tr>
		<td align="left"><img src="./index.php_fichiers/gear.png" border="0"></td>
		<td align="left">Titre </td>
		<td align="left"><input name="title_" id="title_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Département </td>
		<td align="left"><input name="org_unit_" id="org_unit_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td align="left">Rue </td>
		<td align="left"><input name="adr_one_street_" id="adr_one_street_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 2 </td>
		<td align="left"><input name="address2_" id="address2_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 3 </td>
		<td align="left"><input name="address3_" id="address3_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><input name="adr_one_locality_" id="adr_one_locality_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><input name="adr_one_postalcode_" id="adr_one_postalcode_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Région </td>
		<td align="left"><input name="adr_one_region_" id="adr_one_region_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><input name="adr_one_countryname_" id="adr_one_countryname_" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table>
</div>
<!-- END grid  --></div>
<div style="display: none;" id="addressbook.edit.links">


<!-- BEGIN eTemplate addressbook.edit.links -->





<!-- BEGIN grid  -->
<div style="overflow: auto; width: 100%; height: 100%;">
<table width="100%">
	<tbody>
	<tr>
		<td align="left">

<!-- BEGIN eTemplate etemplate.link_widget.search -->

<style type="text/css">
<!--
.redItalic { font-style: italic; color: red; }
.hide_comment { display: none; }
-->
</style>



<!-- BEGIN grid  -->
<table><tr><td width="415"><table height="250">
	<tbody><tr>
		<td align="left"><img src="./index.php_fichiers/personal.png" border="0"></td>
		<td align="left">Civilité</td>
		<td align="left"><select name="n_prefix_e" id="n_prefix_e"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Prénom </td>
		<td align="left"><input name="n_given_e" id="n_given_e" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxième prénom </td>
		<td align="left"><input name="n_middle_e" id="n_middle_e" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom </td>
		<td align="left"><input name="n_family_e" id="n_family_e" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Suffixe </td>
		<td align="left"><input name="n_suffix_e" id="n_suffix_e" size="45" maxlength="64">
</td>
	</tr>
	
	<tr valign="top">
		<td align="left"><img src="../index.php_fichiers/folder.png" border="0"></td>
		<td align="left">Catégorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_employeur" value="Employeur"/> Employeur <?php //$epce->liste_categorie(); ?>
</div></td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private_e">Privé</label> </td>
		<td align="left"><input name="private_e" value="1" id="private_e" type="checkbox">
</td>
	</tr><tr><td></td><td>&nbsp;</td><td></td></tr>
</tbody></table></td><td style="background-color: #F3F3F3; border-left:1px dashed #000" width="397" valign="top"><table align="center">
  <tbody><tr>
		<td height="45" colspan="3" align="center" ><img src="./images/address_16.png" /> Contact de l'employeur</strong>
		 </td>
	</tr>
	<tr >
		<td align="left"> </td>
		<td align="left"> </td>
		<td align="left"> </td>
	</tr>
	<tr>
		<td align="left">Tél Bureau </td>
		<td align="left"><input name="tel_work_e" id="tel_work_e" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Tél portable </td>
		<td align="left"><input name="tel_cell_e" id="tel_cell_e" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Privé </td>
		<td align="left"><input name="tel_home_e" id="tel_home_e" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Site web </td>
		<td align="left"><input name="url_e" id="url_e"  value="http://" size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email bureau </td>
		<td align="left"><input name="email_e" id="email_e" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email domicile</td>
		<td align="left"><input name="email_home_e" id="email_home_e" size="30">
</td>
		<td align="left">
</td>
	</tr>
	
	<tr>
		<td colspan="3" align="center">&nbsp;</td>
	</tr>
</tbody></table></td></tr></table>
<!-- END grid  -->


<!-- END eTemplate etemplate.link_widget.search -->

</td>
	</tr>
	
	<tr>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table>
</div>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.links -->

</div>


<div style="display: none;" id="addressbook.edit.evaluation">


<!-- BEGIN eTemplate addressbook.edit.evaluation -->





<!-- BEGIN grid  -->
<div style="overflow: auto; width: 100%; height: 100%;">
<table height="250">
	<tbody><tr height="40">
		<td align="left"><img src="./index.php_fichiers/gohome.png" border="0"></td>
		<td align="left"><label for="org_name_e">Nom de la société</label> </td>
		<td align="left"><input name="org_name_e" id="org_name_e" size="45" maxlength="64">
</td>
	</tr><tr>
		<td align="left"><img src="./index.php_fichiers/gear.png" border="0"></td>
		<td align="left">Titre </td>
		<td align="left"><input name="title_e" id="title_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Département </td>
		<td align="left"><input name="org_unit_e" id="org_unit_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td align="left">Rue </td>
		<td align="left"><input name="adr_one_street_e" id="adr_one_street_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 2 </td>
		<td align="left"><input name="address2_e" id="address2_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 3 </td>
		<td align="left"><input name="address3_e" id="address3_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><input name="adr_one_locality_e" id="adr_one_locality_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><input name="adr_one_postalcode_e" id="adr_one_postalcode_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Région </td>
		<td align="left"><input name="adr_one_region_e" id="adr_one_region_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><input name="adr_one_countryname_e" id="adr_one_countryname_e" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table>
</div>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.evaluation -->

</div>
</td>
	</tr>
</table>
<!-- END grid  -->

<!-- END eTemplate etemplate.tab_widget -->

</td>
		<td width="14" align="left">

<!-- BEGIN vbox -->
<!-- END vbox -->

</td>
	</tr>
	<tr>
		<td align="left">

<!-- BEGIN hbox -->

<table>
	<tbody><tr>
		<td><input name="exec[button][save]" value="Enregistrer" id="exec[button][save]" accesskey="s" type="submit">
</td>
		<td><!--<input name="exec[button][apply]" value="Appliquer" id="exec[button][apply]" type="submit">-->
</td>
		<td><input name="exec[button][cancel]" value="Annuler" id="exec[button][cancel]"  type="reset">
</td>
		<td>

<!-- BEGIN eTemplate addressbook.editphones -->





<!-- BEGIN grid  -->
<table class="editphones">
	<tbody><tr>
		<td colspan="3" class="windowheader" align="center"><strong>Etat civil du bénéficiaire</strong></td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td><td>Lieu de naissance</td><td><input name="lieu_naissance" id="lieu_naissance" size="45" maxlength="64"></td></tr><tr>
		<td align="left">&nbsp;</td><td>Situation maritale</td><td><select   name="situation_maritale"><option></option><option value="Célibataire">Célibataire</option><option value="Marié(e)">Marié(e)</option></select></td></tr><tr>
		<td align="left">&nbsp;</td><td>Enfants à charges</td><td><select  name="enfant_charges"><option></option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></td></tr><tr>
		<td align="left">&nbsp;</td><td>Nationalité</td><td><select name="nationailte"><option></option><option value="Francaise">Francaise</option><option value="Autre">Autre</option></select></td></tr><tr>
		<td align="left">&nbsp;</td><td>Situation professionnelle</td><td><select name="situation_professionnelle"><option></option><option value="Sans activité">Sans activité</option><option value="Salarié">Salarié</option></select></td></tr><tr>
		<td align="left">&nbsp;</td><td>Statut 1</td><td><select name="statut1"><option></option><option value="DEI">DEI</option></select></td></tr>
        <tr>
		<td align="left">&nbsp;</td><td>Statut 2</td><td><select name="statut2"><option></option><option value="RMISTE">RMISTE</option></select></td></tr>
        
		<td align="left">&nbsp;</td><td>Identifiant Pôle emploi</td><td><input name="id_pole" id="id_pole" size="45" maxlength="64"></td></tr>	<tr height="30">
		<td align="left">&nbsp;</td>
		<td align="left"><label for="exec[bday]">Anniversaire</label> </td>
		<td align="left">

<!-- BEGIN eTemplate *** generated fields for date -->





<!-- BEGIN grid  -->
<table cellspacing="0">
	<tbody><tr>
		<td align="left"><input id="date_inscription" name="date_inscription" size="10" onfocus="self.status='*'; return true;" onblur="self.status=''; return true;" type="text">
<script type="text/javascript">
	document.writeln('<img id="date_inscription-trigger" src="/lea_/phpgwapi/templates/default/images/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_inscription",
		button      : "date_inscription-trigger"
	}
	);
</script><img id="date_inscription-trigger" src="../index.php_fichiers/datepopup.gif" title="Sélectionner la date" style="cursor: pointer;">

</td>
	</tr>
</tbody></table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
	</tr>
        
        
        <tr>
		<td colspan="3" align="center"><input name="exec[]" value="OK" id="exec[]" onclick="hidephones(this.form); return false;" type="submit">
</td>
	</tr>
</table>
<!-- END grid  -->

<!-- END eTemplate addressbook.editphones -->

</td>

	</tr>
</tbody></table>


<!-- END hbox -->

</td>
		<td align="right">&nbsp;</td>
	</tr>
</tbody></table>
<!-- END grid  -->

</div>
<!-- END eTemplate addressbook.edit -->

</form>
		 							
									</div>
		  <!-- Applicationbox Column -->
		  
		  
  


	
<div id="divPoweredBy"><br>
</div>	
<!-- enable wz_tooltips -->
<script src="../index.php_fichiers/wz_tooltip.js" type="text/javascript"></script>
