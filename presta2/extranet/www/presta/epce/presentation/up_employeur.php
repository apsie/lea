<?php
$id=$_GET['id'];
$choix=$_GET['choix'];
$categorie=$_GET['categorie'];
include('../inc/class.epce.inc.php');
$epce = new epce();
$retour=$epce->variable_beneficiaire($id);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" href="http://127.0.0.1/lea_/phpgwapi/templates/idots/images/favicon.ico" type="image/x-ico">
		<link rel="shortcut icon" href="http://127.0.0.1/lea_/phpgwapi/templates/idots/images/favicon.ico">
		<link href="index.php_fichiers/idots.css" type="text/css" rel="StyleSheet">
		<link href="index.php_fichiers/print.css" type="text/css" media="print" rel="StyleSheet">
        <title>Création d'un employeur</title>
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
<!-- END eTemplate etemplate.popup.manual -->
<form method="POST" name="form" action="../test.php" enctype="multipart/form-data" onsubmit="set_element2(this,'exec[link_to][file_path]','exec[link_to][file]')">
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

<!-- BEGIN grid  --><div align="center" style="font-size:14px">
  <p><strong>Modifier l'employeur <font color="#6699CC"><?php echo $retour[6]; ?></font></strong></p>
  <p>&nbsp;</p>
</div>
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
		
		<td width="81" class="etemplate_tab_active th" id="addressbook.edit.personal-tab" onclick="activate_tab('addressbook.edit.personal','personal|organisation','exec[personal|organisation]');">Employeur</td>
		<td width="135" class="etemplate_tab row_on" id="addressbook.edit.organisation-tab" onclick="activate_tab('addressbook.edit.organisation','personal|organisation','exec[personal|organisation]');">Infos Employeur</td>
		
	</tr>
</tbody></table>


<!-- END hbox -->

</td>
	</tr>
	<tr class="row_off">
		<td class="tab_body" align="left"><input name="exec[personal|organisation]" value="addressbook.edit.personal" type="hidden">
<div style="display: inline;" id="addressbook.edit.personal">


<!-- BEGIN eTemplate addressbook.edit.personal -->





<!-- BEGIN grid  -->
<table><tr><td width="415"><table height="250">
	<tbody><tr>
		<td align="left"><img src="./index.php_fichiers/personal.png" border="0"></td>
		<td align="left">Civilité</td>
		<td align="left"><select name="n_prefix_e" id="n_prefix_e"><option value="<?php echo $retour[0]; ?>"><?php echo $retour[0]; ?></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select> <input type="hidden" name="id" value="<?php echo $id; ?>" /><input type="hidden" name="choix" value="<?php echo $choix; ?>" /><input type="hidden" name="update_employeur" value="1" />
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Prénom </td>
		<td align="left"><input name="n_given_e" id="n_given_e" size="45" value="<?php echo $retour[1]; ?>" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxième prénom </td>
		<td align="left"><input name="n_middle_e" id="n_middle_e" size="45"value="<?php echo $retour[2]; ?>"  maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom </td>
		<td align="left"><input name="n_family_e" id="n_family_e" size="45" value="<?php echo $retour[3]; ?>" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Suffixe </td>
		<td align="left"><input name="n_suffix_e" id="n_suffix_e" size="45" value="<?php echo $retour[4]; ?>" maxlength="64">
</td>
	</tr>
	
	<tr valign="top">
		<td align="left"><img src="../index.php_fichiers/folder.png" border="0"></td>
		<td align="left">Catégorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_employeur" value="employeur"/> 
		Employeur 
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
		<td align="left"><input name="tel_work_e" id="tel_work_e" value="<?php echo $retour[7]; ?>" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Tél portable </td>
		<td align="left"><input name="tel_cell_e" id="tel_cell_e" value="<?php echo $retour[8]; ?>" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Privé </td>
		<td align="left"><input name="tel_home_e" id="tel_home_e"  value="<?php echo $retour[9]; ?>"size="30">
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Site web </td>
		<td align="left"><input name="url_e" id="url_e"  value="<?php echo $retour[10]; ?>"  size="30" />
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email bureau </td>
		<td align="left"><input name="email_e" id="email_e" value="<?php echo $retour[11]; ?>" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">Email domicile</td>
		<td align="left"><input name="email_home_e" value="<?php echo $retour[12]; ?>" id="email_home_e" size="30">
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
<table height="250">
	<tbody><tr height="40">
		<td align="left"><img src="./index.php_fichiers/gohome.png" border="0"></td>
		<td align="left"><label for="org_name_e">Nom de la société</label> </td>
		<td align="left"><input name="org_name_e" id="org_name_e" value="<?php echo $retour[6]; ?>" size="45" maxlength="64">
</td>
	</tr><tr>
		<td align="left"><img src="./index.php_fichiers/gear.png" border="0"></td>
		<td align="left">Service </td>
		<td align="left"><input name="title_e" id="title_e" value="<?php echo $retour[22]; ?>"  size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Fonction </td>
		<td align="left"><input name="org_unit_e" id="org_unit_e" value="<?php echo $retour[23]; ?>" size="45" maxlength="64">
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
		<td align="left"><input name="adr_one_street_e" id="adr_one_street_e" value="<?php echo $retour[18]; ?>" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 2 </td>
		<td align="left"><input name="address2_e" id="address2_e" size="45" value="<?php echo $retour[16]; ?>" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 3 </td>
		<td align="left"><input name="address3_e" id="address3_e" size="45" value="<?php echo $retour[17]; ?>" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><input name="adr_one_locality_e" id="adr_one_locality_e" value="<?php echo $retour[19]; ?>" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><input name="adr_one_postalcode_e" id="adr_one_postalcode_e" value="<?php echo $retour[21]; ?>" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Région </td>
		<td align="left"><input name="adr_one_region_e" id="adr_one_region_e" value="<?php echo $retour[20]; ?>" size="45" maxlength="64">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><input name="adr_one_countryname_e" id="adr_one_countryname_e" value="<?php echo $retour[22]; ?>" size="45" maxlength="64">
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

<input type="button" value="Retour" OnClick="window.location='../index.php?page=presentation&domain=default&<?php echo 'categorie='.$categorie.'&choix='.$choix;?>'"></td>

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
