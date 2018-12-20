<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => 'Compte_rendu1_0',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include('config/inc_apsie/Compte_rendu.php');
	

	
$cpte_rendu = new compte_rendu();

?><html>
<head><!-- <link rel="stylesheet" href="css/compte_rendu.css" type="text/css" media="screen" />--> 
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
function verifForm() {
  if (((document.form_compte_rendu.theme_1.value == "") || (document.form_compte_rendu.theme_1.value == "Autre")) &&(document.form_compte_rendu.theme_autre_1.value == "")) {
    alert("thème obligatoire.\n");
    document.form_compte_rendu.theme_1.focus();
	document.form_compte_rendu.theme_autre_1.focus();
    return false;
  }
 
  return true;
}
</script>

</head>
<body>

<form action="" method="get" name="form_compte_rendu">

<!--Div etape 1-->


<div id="etape_1" name='etape_1' style="display:block; font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 1</p><br/>

Quels ont été les thèmes abordés au cours de la séance ? <br/><br/>



<table><tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC">
<td width="180px">Thème</td><td width="180px">Points traites :</td> <td width="180px">Objectif :</td><td width="180px">Résultat :</td><td width="180px">Observation :</td></tr></table>
<table>
<tr id="id_theme1" style="display: block;">
<td width="180px"><div style="display:block" id="theme1">*<select name="theme_1" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre1').style.display = 'block'; document.getElementById ('theme1').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_theme2').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre1"><input type="text" name="theme_autre_1" size="25" ></div></td><td width="180px"><textarea name="theme_point_traite_1" cols="20" rows="4" ></textarea></td><td width="180px"><textarea name="theme_objectif_1" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_resultat_1" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_observation_1" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme2" style="display: none;">
<td width="180px"><div style="display:block" id="theme2"><select name="theme_2" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre2').style.display = 'block'; document.getElementById ('theme2').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_theme3').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre2"><input type="text" name="theme_autre_2" size="25" ></div></td><td width="180px"><textarea name="theme_point_traite_2" cols="20" rows="4"></textarea></td><td><textarea name="theme_objectif_2" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_resultat_2" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_observation_2" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme3" style="display: none;">
<td width="180px"><div style="display:block" id="theme3"><select name="theme_3" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre3').style.display = 'block'; document.getElementById ('theme3').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_theme4').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre3"><input type="text" name="theme_autre_3" size="25" ></div></td><td width="180px"><textarea name="theme_point_traite_3" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_objectif_3" cols="20" rows="4"></textarea></td><td><textarea name="theme_resultat_3" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_observation_3" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme4" style="display: none;">
<td width="180px"><div style="display:block" id="theme4"><select name="theme_4" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre4').style.display = 'block'; document.getElementById ('theme4').style.display = 'none';}"><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre4"><input type="text" name="theme_autre_4" size="25" ></div></td><td width="180px"><textarea name="theme_point_traite_4" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_objectif_4" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_resultat_4" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="theme_observation_4" cols="20" rows="4"></textarea></td>
</tr></table>

<br/>

<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px">Etape suivante <a href="javascript::void();" onClick="document.getElementById('etape_2').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/right_16.png" border="0" /></a> </p> <br/><br/>

</div>
<!--Fin Div etape 1-->

<!--Div etape 2-->
<div id="etape_2" name='etape_2' style="display:none;  font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 2</p><br/>


Quels sont les thèmes prévus pour le prochain RDV ? 
<br/><br/>
Actions à réaliser pour le prochain RDV :
<br/><br/>
<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC" >
<td width="170px">Thème</td><td width="180px">Démarches/actions prévues :</td><td width="115px">A faire par :</td><td width="180px">Objectif :</font></td><td width="180px">Résultat :</td><td width="180px">Observation :</td></tr>
</table>
<table>
<tr id="id_action1" style="display: block;">
<td width="170px">*<select name="theme_action_1" id="theme_action1" onChange="if (this.value == 'Autre') {document.getElementById ('theme_action_autre1').style.display = 'block'; document.getElementById ('theme_action1').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_action2').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select><input type="text" name="theme_action_autre_1" size="25" style="display:none" id="theme_action_autre1" ></td><td width="180px"><textarea name="action_description_1" cols="20" rows="4"></textarea></td><td width="115px"><select name="action_attribue_a_1"><option value="">A faire par</option><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td width="180px"><textarea name="action_objectif_1" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_resultat_1" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_observation_1" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_action2" style="display: none;">
<td width="170px"><select name="theme_action_2" id="theme_action2" onChange="if (this.value == 'Autre') {document.getElementById ('theme_action_autre2').style.display = 'block'; document.getElementById ('theme_action2').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_action3').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select><input type="text" name="theme_action_autre_2" size="25" style="display:none" id="theme_action_autre2" ></td><td width="180px"><textarea name="action_description_2" cols="20" rows="4"></textarea></td><td width="115px"><select name="action_attribue_a_2"><option value="">A faire par</option><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td width="180px"><textarea name="action_objectif_2" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_resultat_2" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_observation_2" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_action3" style="display: none;">
<td width="170px"><select name="theme_action_3" id="theme_action3" onChange="if (this.value == 'Autre') {document.getElementById ('theme_action_autre3').style.display = 'block'; document.getElementById ('theme_action3').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_action4').style.display = 'block';} "><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select><input type="text" name="theme_action_autre_3" size="25" style="display:none" id="theme_action_autre3" ></td><td width="180px"><textarea name="action_description_3" cols="20" rows="4"></textarea></td><td width="115px"><select name="action_attribue_a_3"><option value="">A faire par</option><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td width="180px"><textarea name="action_objectif_3" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_resultat_3" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_observation_3" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_action4" style="display: none;">
<td width="170px"><select name="theme_action_4" id="theme_action4" onChange="if (this.value == 'Autre') {document.getElementById ('theme_action_autre4').style.display = 'block'; document.getElementById ('theme_action4').style.display = 'none';}"><option value="">Choisir un thème</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select><input type="text" name="theme_action_autre_4" size="25" style="display:none" id="theme_action_autre4" ></td><td width="180px"><textarea name="action_description_4" cols="20" rows="4"></textarea></td><td width="115px"><select name="action_attribue_a_4"><option value="">A faire par</option><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td><textarea name="action_objectif_4" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_resultat_4" cols="20" rows="4"></textarea></td><td width="180px"><textarea name="action_observation_4" cols="20" rows="4"></textarea></td>
</tr></table><br/>

<table width="100%"><tr><td align="left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px"><a href="javascript::void();" onClick="document.getElementById('etape_1').style.display ='block'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/left_16.png" border="0" /></a>Etape précédente</td><td align="right" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px">Etape suivante <a href="javascript::void();" onClick="document.getElementById('etape_3').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/right_16.png" border="0" /></a></td></tr></table>
<!--Fin Div etape 2-->
</div>

<!--Div etape 3-->
<div id="etape_3" name='etape_3' style="display:none;  font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 3</p><br/>

Avez-vous élaboré des documents ? Si oui lesquels?
<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC" >
<td>Documents élaborés au cours de la séance :</font></td></tr>
<tr>
<td><select name="documents_elabores_1" id="doc1" onChange="if (this.value == 'Autre') {document.getElementById ('doc_input1').style.display = 'block'; document.getElementById ('doc1').style.display = 'none';}"><option value="">Séléctionner un document</option><option value="Autre">Autre</option></select><input name="documents_elabores_autre_1" type="text" size="50" style="display:none" id="doc_input1" /></td></tr>
<tr>
<td><select name="documents_elabores_2" id="doc2" onChange="if (this.value == 'Autre') {document.getElementById ('doc_input2').style.display = 'block'; document.getElementById ('doc2').style.display = 'none';}"><option value="">Séléctionner un document</option><option value="Autre">Autre</option></select><input name="documents_elabores_autre_2" type="text" size="50" style="display:none" id="doc_input2" /></td></tr>
<tr>
<td><select name="documents_elabores_3" id="doc3" onChange="if (this.value == 'Autre') {document.getElementById ('doc_input3').style.display = 'block'; document.getElementById ('doc3').style.display = 'none';}"><option value="">Séléctionner un document</option><option value="Autre">Autre</option></select><input name="documents_elabores_autre_3" type="text" size="50" style="display:none" id="doc_input3" /></td></tr>
<tr>
<td><select name="documents_elabores_4" id="doc4" onChange="if (this.value == 'Autre') {document.getElementById ('doc_input4').style.display = 'block'; document.getElementById ('doc4').style.display = 'none';}"><option value="">Séléctionner un document</option><option value="Autre">Autre</option></select><input name="documents_elabores_autre_4" type="text" size="50" style="display:none" id="doc_input4" /></td></tr>
</table>

<br/><br/>

<table width="100%"><tr><td align="left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px"><a href="javascript::void();" onClick="document.getElementById('etape_2').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/left_16.png" border="0" /></a>Etape précédente</td><td align="right" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px">Etape suivante <a href="javascript::void();" onClick="document.getElementById('etape_4').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/right_16.png" border="0" /></a></td></tr></table>

<!--Fin Div etape 3-->
</div>
<!--Div etape 4-->
<div id="etape_4" name='etape_4' style="display:none;  font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 4</p><br/>


<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC" >
<td>Supports d'information communiqués :</td></tr>
<tr>
<td><select name="support_1" id="support1" onChange="if (this.value == 'Autre') {document.getElementById ('support_input1').style.display = 'block'; document.getElementById ('support1').style.display = 'none';}"><option value="">Séléctionner un support</option><option value="Autre">Autre</option></select><input name="support_autre_1" type="text" size="50" style="display:none" id="support_input1" /></td></tr>
<tr>
<td><select name="support_2" id="support2" onChange="if (this.value == 'Autre') {document.getElementById ('support_input2').style.display = 'block'; document.getElementById ('support2').style.display = 'none';}"><option value="">Séléctionner un support</option><option value="Autre">Autre</option></select><input name="support_autre_2" type="text" size="50" style="display:none" id="support_input2" /></td></tr>
<tr>
<td><select name="support_3" id="support3" onChange="if (this.value == 'Autre') {document.getElementById ('support_input3').style.display = 'block'; document.getElementById ('support3').style.display = 'none';}"><option value="">Séléctionner un support</option><option value="Autre">Autre</option></select><input name="support_autre_3" type="text" size="50" style="display:none" id="support_input3" /></td></tr>
<tr>
<td><select name="support_4" id="support4" onChange="if (this.value == 'Autre') {document.getElementById ('support_input4').style.display = 'block'; document.getElementById ('support4').style.display = 'none';}"><option value="">Séléctionner un support</option><option value="Autre">Autre</option></select><input name="support_autre_4" type="text" size="50" style="display:none" id="support_input4" /></td></tr>
</table>

<table width="100%"><tr><td align="left" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px"><a href="javascript::void();" onClick="document.getElementById('etape_3').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/left_16.png" border="0" /></a>Etape précédente</td><td align="right" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px">Etape suivante <a href="javascript::void();" onClick="document.getElementById('etape_5').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_4').style.display='none';" ><img src="images/right_16.png" border="0" /></a></td></tr></table>
</div>
<!--Fin Div etape 4-->

<!--Div etape 5-->
<div id="etape_5" name='etape_5' style="display:none;  font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 5</p><br/>

<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC" >
<td>Liens web communiqués :</td></tr>
<tr>
<td><select name="liens_web_1" id="lien1" onChange="if (this.value == 'Autre') {document.getElementById ('lien_input1').style.display = 'block'; document.getElementById ('lien1').style.display = 'none';}"><option value="">Séléctionner un lien web</option><option value="Autre">Autre</option></select><input name="liens_web_autre_1" type="text" size="50" style="display:none" id="lien_input1" /></td></tr>
<tr>
<td><select name="liens_web_2" id="lien2" onChange="if (this.value == 'Autre') {document.getElementById ('lien_input2').style.display = 'block'; document.getElementById ('lien2').style.display = 'none';}"><option value="">Séléctionner un lien web</option><option value="Autre">Autre</option></select><input name="liens_web_autre_2" type="text" size="50" style="display:none" id="lien_input2" /></td></tr>
<tr>
<td><select name="liens_web_3" id="lien3" onChange="if (this.value == 'Autre') {document.getElementById ('lien_input3').style.display = 'block'; document.getElementById ('lien3').style.display = 'none';}"><option value="">Séléctionner un lien web</option><option value="Autre">Autre</option></select><input name="liens_web_autre_3" type="text" size="50" style="display:none" id="lien_input3" /></td></tr>
<tr>
<td><select name="liens_web_4" id="lien4" onChange="if (this.value == 'Autre') {document.getElementById ('lien_input4').style.display = 'block'; document.getElementById ('lien4').style.display = 'none';}"><option value="">Séléctionner un lien web</option><option value="Autre">Autre</option></select><input name="liens_web_autre_4" type="text" size="50" style="display:none" id="lien_input4" /></td></tr>
</table><br/>
<br/>

<br/>
<p align="center"><input name="enregistrer" type="submit" onClick="verifForm(this.form)" value="Enregistrer"></p><br/>

<br/>

<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px"><a href="javascript::void();" onClick="document.getElementById('etape_4').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_5').style.display='none';" ><img src="images/left_16.png" border="0" /></a>Etape précédente </p> <br/><br/>

</div>
<!--Fin Div etape 5-->


</form>
<?php 
if (isset($_GET['enregistrer']))
{		
if(($_GET["documents_elabores_1"]!=NULL) || ($_GET["documents_elabores_1"]!='Autre'))
{
	$doc1=$_GET["documents_elabores_1"];
}
elseif ($_GET["documents_elabores_autre_1"]!=NULL)
{
	$doc1=$_GET["documents_elabores_autre_1"];
}

if(($_GET["documents_elabores_2"]!=NULL) and ($_GET["documents_elabores_2"]!='Autre'))
{
	$doc2=$_GET["documents_elabores_2"];
}
elseif ($_GET["documents_elabores_autre_2"]!=NULL)
{
	$doc2=$_GET["documents_elabores_autre_2"];
}

if(($_GET["documents_elabores_3"]!=NULL) and ($_GET["documents_elabores_3"]!='Autre'))
{
	$doc3=$_GET["documents_elabores_3"];
}
elseif ($_GET["documents_elabores_autre_3"]!=NULL)
{
	$doc3=$_GET["documents_elabores_autre_3"];
}

if(($_GET["documents_elabores_4"]!=NULL) and ($_GET["documents_elabores_4"]!='Autre'))
{
	$doc4=$_GET["documents_elabores_4"];
}
elseif ($_GET["documents_elabores_autre_4"]!=NULL)
{
	$doc4=$_GET["documents_elabores_autre_4"];
}

if(($_GET["liens_web_1"]!=NULL) and ($_GET["liens_web_1"]!='Autre'))
{
	$lien1=$_GET["liens_web_1"];
}
elseif ($_GET["liens_web_autre_1"]!=NULL)
{
	$lien1=$_GET["liens_web_autre_1"];
}

if(($_GET["liens_web_2"]!=NULL) and ($_GET["liens_web_2"]!='Autre'))
{
	$lien2=$_GET["liens_web_2"];
}
elseif ($_GET["liens_web_autre_2"]!=NULL)
{
	$lien2=$_GET["liens_web_autre_2"];
}
if(($_GET["liens_web_3"]!=NULL) and ($_GET["liens_web_3"]!='Autre'))
{
	$lien3=$_GET["liens_web_3"];
}
elseif ($_GET["liens_web_autre_3"]!=NULL)
{
	$lien3=$_GET["liens_web_autre_3"];
}

if(($_GET["liens_web_4"]!=NULL) and ($_GET["liens_web_4"]!='Autre'))
{
	$lien4=$_GET["liens_web_4"];
}
elseif ($_GET["liens_web_autre_4"]!=NULL)
{
	$lien4=$_GET["liens_web_autre_4"];
}

if(($_GET["support_1"]!=NULL) and ($_GET["support_1"]!='Autre'))
{
	$support1=$_GET["support_1"];
}
elseif ($_GET["support_autre_1"]!=NULL)
{
	$support1=$_GET["support_autre_1"];
}

if(($_GET["support_2"]!=NULL) and ($_GET["support_2"]!='Autre'))
{
	$support2=$_GET["support_2"];
}
elseif ($_GET["support_autre_2"]!=NULL)
{
	$support2=$_GET["support_autre_2"];
}

if(($_GET["support_3"]!=NULL) and ($_GET["support_3"]!='Autre'))
{
	$support3=$_GET["support_3"];
}
elseif ($_GET["support_autre_3"]!=NULL)
{
	$support3=$_GET["support_autre_3"];
}

if(($_GET["support_4"]!=NULL) and ($_GET["support_4"]!='Autre'))
{
	$support4=$_GET["support_4"];
}
elseif ($_GET["support_autre_4"]!=NULL)
{
	$support4=$_GET["support_autre_4"];
}

if($_GET['theme_point_traite_1']!=NULL and $_GET['theme_action_1']!=NULL)
	{

	$cpte_rendu->inserer_compte_rendu('2085', '2200', '12500', '1003', $doc1. ',' .$doc2. ',' .$doc3. ',' .$doc4, $lien1. ',' .$lien2. ',' .$lien3. ',' .$lien4, $support1. ',' .$support2. ',' .$$support3. ',' .$$support4);		
		
	$test=$cpte_rendu->get_id_compte_rendu('2085', '2200');
	
	
	if ($_GET['theme_1']!=NULL and $_GET['theme_1']!='Autre')
	{
		$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_1'], $_GET['theme_point_traite_1'], $_GET['theme_objectif_1'], $_GET['theme_resultat_1'], $_GET['theme_observation_1']);
	}
	
	elseif ($_GET['theme_autre_1']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_autre_1'], $_GET['theme_point_traite_1'], $_GET['theme_objectif_1'], $_GET['theme_resultat_1'], $_GET['theme_observation_1']);
	}
	
	if($_GET['theme_point_traite_2']!=NULL)
	{
		if ($_GET['theme_2']!=NULL and $_GET['theme_2']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_2'], $_GET['theme_point_traite_2'], $_GET['theme_objectif_2'], $_GET['theme_resultat_2'], $_GET['theme_observation_2']);
	}
	elseif ($_GET['theme_autre_2']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_autre_2'], $_GET['theme_point_traite_2'], $_GET['theme_objectif_2'], $_GET['theme_resultat_2'], $_GET['theme_observation_2']);
	}}
	
	
	
	if($_GET['theme_point_traite_3']!=NULL )
	{
		if ($_GET['theme_3']!=NULL and $_GET['theme_3']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_3'], $_GET['theme_point_traite_3'], $_GET['theme_objectif_3'], $_GET['theme_resultat_3'], $_GET['theme_observation_3']);
	}
	elseif ($_GET['theme_autre_3']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_autre_3'], $_GET['theme_point_traite_3'], $_GET['theme_objectif_3'], $_GET['theme_resultat_3'], $_GET['theme_observation_3']);
	}}
		
	
	if($_GET['theme_point_traite_4']!=NULL)
	{
		if ($_GET['theme_4']!=NULL and $_GET['theme_4']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_4'], $_GET['theme_point_traite_4'], $_GET['theme_objectif_4'], $_GET['theme_resultat_4'], $_GET['theme_observation_4']);
	}
		elseif ($_GET['theme_autre_4']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde($test, $_GET['theme_autre_4'], $_GET['theme_point_traite_4'], $_GET['theme_objectif_4'], $_GET['theme_resultat_4'], $_GET['theme_observation_4']);
	}}
	
	if ($_GET['theme_action_1']!=NULL and $_GET['theme_action_1']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_1'], $_GET['action_description_1'],  $_GET['action_attribue_a_1'], $_GET['action_objectif_1'], $_GET['action_resultat_1'], $_GET['action_observation_1']);
	}
	elseif ($_GET['theme_action_autre_1']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_autre_1'], $_GET['action_description_1'],  $_GET['action_attribue_a_1'], $_GET['action_objectif_1'], $_GET['action_resultat_1'], $_GET['action_observation_1']);
	}	
	
	if($_GET['action_description_2']!=NULL)
	{
		if ($_GET['theme_action_2']!=NULL and $_GET['theme_action_2']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_2'], $_GET['action_description_2'],  $_GET['action_attribue_a_2'], $_GET['action_objectif_2'], $_GET['action_resultat_2'], $_GET['action_observation_2']);
	}
	elseif ($_GET['theme_action_autre_2']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_autre_2'], $_GET['action_description_2'],  $_GET['action_attribue_a_2'], $_GET['action_objectif_2'], $_GET['action_resultat_2'], $_GET['action_observation_2']);
	}}
	
	
	if($_GET['action_description_3']!=NULL)
	{
		if ($_GET['theme_action_3']!=NULL and $_GET['theme_action_3']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_3'], $_GET['action_description_3'],  $_GET['action_attribue_a_3'], $_GET['action_objectif_3'], $_GET['action_resultat_3'], $_GET['action_observation_3']);
	}
	elseif ($_GET['theme_action_autre_3']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_autre_3'], $_GET['action_description_3'],  $_GET['action_attribue_a_3'], $_GET['action_objectif_3'], $_GET['action_resultat_3'], $_GET['action_observation_3']);
	}}
	
	
	
	if($_GET['action_description_4']!=NULL)
	{
		if ($_GET['theme_action_4']!=NULL and $_GET['theme_action_4']!='Autre')
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_4'], $_GET['action_description_4'],  $_GET['action_attribue_a_4'], $_GET['action_objectif_4'], $_GET['action_resultat_4'], $_GET['action_observation_4']);
	}
	if ($_GET['theme_action_autre_4']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action($test, $_GET['theme_action_autre_4'], $_GET['action_description_4'],  $_GET['action_attribue_a_4'], $_GET['action_objectif_4'], $_GET['action_resultat_4'], $_GET['action_observation_4']);
	}}
	
	
	

echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="window.location.href=\'impression.php?id_compte_rendu='.$test.' \'";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);

  </script>';	
  
  }
	else
	{
		
	echo '<script language="JavaScript" type="text/javascript">alert("Veuillez remplir les champs* obligatoires.")</script>
<input type="button" value="Retour arrière" name="Retour" onclick = "history.back()"/>' ;
		

	}
  
  

}


?>

</body></html>
<?php
echo $GLOBALS['egw']->common->egw_footer();
?>