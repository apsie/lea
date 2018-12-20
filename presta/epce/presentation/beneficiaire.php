

	<!-- we don't need body tags anymore, do we?) we do!!! onload!! LK -->
	<div id="divMain">


<!-- BEGIN eTemplate etemplate.popup.manual -->
<!-- END eTemplate etemplate.popup.manual -->
<br/>


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
<table width="701">
	<tbody><tr>
		<td colspan="2" align="left">

<!-- BEGIN grid  -->
<table>
	<tbody><tr>
		<td align="left"><strong><?php echo $retour[6].' : '. $retour[0].' '.$retour[1].' '.$retour[2].' '.$retour[3].' '.$retour[4];?></strong></td>
	</tr>
</tbody></table>
<!-- END grid  -->

</td>
	</tr>
	<tr valign="top">
		<td width="688" align="left">

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

<table width="552">
	<tbody><tr>
		<td width="173" class="etemplate_tab_active th" id="addressbook.edit.personal-tab" onclick="activate_tab('addressbook.edit.personal','personal|organisation|home','exec[personal|organisation|home]');">B&eacute;n&eacute;ficiaire </td>
		<td width="177" class="etemplate_tab row_on" id="addressbook.edit.organisation-tab" onclick="activate_tab('addressbook.edit.organisation','personal|organisation|home','exec[personal|organisation|home]');">Soci&eacute;t&eacute; du b&eacute;n&eacute;ficiaire</td>
		<td width="186" class="etemplate_tab row_on" id="addressbook.edit.home-tab" onclick="activate_tab('addressbook.edit.home','personal|organisation|home','exec[personal|organisation|home]');">Addresse du b&eacute;n&eacute;ficiaire</td>
		
	</tr>
</tbody></table>


<!-- END hbox -->

</td>
	</tr>
	<tr class="row_off">
		<td class="tab_body" align="left"><input name="exec[personal|organisation|home]" value="addressbook.edit.personal" type="hidden">
<div style="display: inline;" id="addressbook.edit.personal">


<!-- BEGIN eTemplate addressbook.edit.personal -->





<!-- BEGIN grid  -->
<table width="681"><tr><td width="310" ><table height="250">
	<tbody><tr>
		<td align="left"></td>
		<td align="left">Civilit&eacute;</td>
		<td align="left"><strong><?php echo $retour[0]; ?></strong></td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom </td>
		<td align="left"><strong><?php echo $retour[3]; ?></strong></td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxi&egrave;me pr&eacute;nom </td>
		<td align="left"><strong><?php echo $retour[2]; ?></strong>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Prenom</td>
		<td align="left"><strong><?php echo $retour[1]; ?></strong>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Nom de jeune fille</td>
		<td align="left"><strong><?php echo $retour[4]; ?></strong></td>
	</tr>
	
	
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private">Priv&eacute;</label> </td>
		<td align="left"><?php if($retour[5]=="private"){echo"oui";}else{echo"non";} ?>
</td>
	</tr><tr><td></td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody></table></td><td style="background-color: #F3F3F3; border-left:1px dashed #000" width="359" valign="top"><table align="center">
  <tbody><tr>
		<td height="45" colspan="3" align="center" ><img src="../images/address_16.png" /> Contact du b&eacute;n&eacute;ficiaire</strong>
		 </td>
	</tr>
	<tr >
		<td align="left"> </td>
		<td align="left"> </td>
		<td align="left"> </td>
	</tr>
	<tr>
		<td height="27" align="left">T&eacute;l Bureau </td>
		<td align="left"><strong><?php echo $retour[7]; ?></strong></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td height="26" align="left">T&eacute;l portable </td>
		<td align="left"><strong><?php echo $retour[9]; ?></strong>
</td>
		<td align="left">
	</tr>
	<tr>
		<td height="27" align="left">Tel Priv&eacute; </td>
		<td align="left"><strong><?php echo $retour[8]; ?></strong>
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td height="26" align="left">Site web </td>
		<td align="left"><strong><a target="_blank" href="<?php echo $retour[10]; ?>"><?php echo $retour[10]; ?></a></strong>
</td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td height="27" align="left">Email bureau </td>
		<td align="left"><strong><?php echo $retour[11]; ?></strong></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td height="25" align="left">Email domicile</td>
		<td align="left"><strong><?php echo $retour[12]; ?></strong>
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
<table width="458"><tr><td width="410"><table width="410" height="250">
	<tbody><tr height="40">
		<td align="left"><img src="./index.php_fichiers/gohome.png" border="0"></td>
		<td  width="150" align="left"><label for="org_name">Nom de la soci&eacute;t&eacute;</label> </td>
		<td align="left"><strong><?php echo $retour[6]; ?></strong>
</td>
	</tr><tr>
		<td align="left"><img src="./index.php_fichiers/gear.png" border="0"></td>
		<td align="left">Titre </td>
		<td align="left"><strong><?php echo $retour[23]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Fonction </td>
		<td align="left"><strong><?php echo $retour[24]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	
	<tr>
		<td align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td align="left">Rue </td>
		<td align="left"><strong><?php echo $retour[18]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 2 </td>
		<td align="left">
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Adresse ligne 3 </td>
		<td align="left">
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><strong><?php echo $retour[19]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><strong><?php echo $retour[21]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">R&eacute;gion </td>
		<td align="left"><strong><?php echo $retour[20]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><strong><?php echo $retour[22]; ?></strong>
</td>
		<td align="left">&nbsp;</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>
</tbody></table></td> <td style="font-weight:bold" align="center" width="141"><p>Google map</p>
    <p><a target="_blank" href="<?php echo 'http://maps.google.fr/maps?f=q&hl=fr&q='.$retour[18].'+'.$retour[21]. '+'.$retour[19]; ?>"><img height="100" width="100" src="./images/google_earth.jpg" border="0" title="Localiser l'adresse du bénéficiaire" /></a></p></td></tr></table>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.organisation -->

</div>
<div style="display: none;" id="addressbook.edit.home">


<!-- BEGIN eTemplate addressbook.edit.home -->





<!-- BEGIN grid  -->
<table width="563"><tr><td width="280">
<table   height="250">
	<tbody><tr>
		<td width="32" align="left"><img src="../index.php_fichiers/gohome.png" border="0"></td>
		<td width="98" align="left">Rue </td>
		<td width="237" align="left"><strong><?php echo $retour[13]; ?></strong>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Ville </td>
		<td align="left"><strong><?php echo $retour[14]; ?></strong>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Code postal </td>
		<td align="left"><strong><?php echo $retour[16]; ?></strong>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">R&eacute;gion </td>
		<td align="left"><strong><?php echo $retour[15]; ?></strong>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pays </td>
		<td align="left"><strong><?php echo $retour[17]; ?></strong></td>
	</tr>
	
		
</tbody></table></td>
  <td style="font-weight:bold" align="center" width="118"><p>Google map</p>
    <p><a target="_blank" href="<?php echo 'http://maps.google.fr/maps?f=q&hl=fr&q='.$retour[13].'+'.$retour[16]. '+'.$retour[14]; ?>"><img height="100" width="100" src="./images/google_earth.jpg" border="0" title="Localiser l'adresse du bénéficiaire" /></a></p></td></tr></table>
<!-- END grid  -->

<!-- END eTemplate addressbook.edit.home -->

</div>
<div style="display: none;" id="addressbook.edit.formation">
<table><tr><td width="415"><table height="250">
	<tbody><tr>
		<td align="left"><img src="./index.php_fichiers/personal.png" border="0"></td>
		<td align="left">Civilit&eacute;</td>
		<td align="left"><select name="n_prefix_" id="n_prefix_"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pr&eacute;nom </td>
		<td align="left"><input name="n_given_" id="n_given_" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxi&egrave;me pr&eacute;nom </td>
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
		<td align="left">Cat&eacute;gorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_prescripteur" value="Prescripteur"/> Prescripteur <?php //$epce->liste_categorie(); ?>
</div></td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private2">Priv&eacute;</label> </td>
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
		<td align="left">T&eacute;l Bureau </td>
		<td align="left"><input name="tel_work_" id="tel_work_" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">T&eacute;l portable </td>
		<td align="left"><input name="tel_cell_" id="tel_cell_" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Priv&eacute; </td>
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
		<td align="left"><label for="org_name_">Nom de la soci&eacute;t&eacute;</label> </td>
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
		<td align="left">D&eacute;partement </td>
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
		<td align="left">R&eacute;gion </td>
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
		<td align="left">Civilit&eacute;</td>
		<td align="left"><select name="n_prefix_e" id="n_prefix_e"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select>
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Pr&eacute;nom </td>
		<td align="left"><input name="n_given_e" id="n_given_e" size="45" maxlength="64">
</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">Deuxi&egrave;me pr&eacute;nom </td>
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
		<td align="left">Cat&eacute;gorie </td>
		<td colspan="4" align="left"><div id="cat_id" style="border: 2px inset lightgray; overflow: auto; width: 99%; height: 5.1em; background-color: white;"><input type="radio" checked="checked" name="cat_employeur" value="Employeur"/> Employeur <?php //$epce->liste_categorie(); ?>
</div></td>
	</tr>
	<tr>
		<td align="left"><img src="../index.php_fichiers/password.png" border="0"></td>
		<td align="left"><label for="private_e">Priv&eacute;</label> </td>
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
		<td align="left">T&eacute;l Bureau </td>
		<td align="left"><input name="tel_work_e" id="tel_work_e" size="30" /></td>
		<td align="left">
</td>
	</tr>
	<tr>
		<td align="left">T&eacute;l portable </td>
		<td align="left"><input name="tel_cell_e" id="tel_cell_e" size="30">
</td>
		<td align="left">
	</tr>
	<tr>
		<td align="left">Tel Priv&eacute; </td>
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
		<td align="left"><label for="org_name_e">Nom de la soci&eacute;t&eacute;</label> </td>
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
		<td align="left">D&eacute;partement </td>
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
		<td align="left">R&eacute;gion </td>
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
		<td width="1" align="left">

<!-- BEGIN vbox -->
<!-- END vbox -->

</td>
	</tr>
	<tr>
		<td align="left">

<!-- BEGIN hbox -->
<!-- END hbox -->

<input type="button"  value="Modifier" OnClick="window.open('./../index.php?menuaction=addressbook.uicontacts.edit&contact_id=<?php echo $choix;?>')" /></td>
		<td align="right">&nbsp;</td>
	</tr>
</tbody></table>
<!-- END grid  -->

</div>
<!-- END eTemplate addressbook.edit -->


		 							
	</div>
		  <!-- Applicationbox Column -->
		  
		  
  


	
<div id="divPoweredBy"><br>
</div>	
<!-- enable wz_tooltips -->

