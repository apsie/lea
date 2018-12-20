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
<head><!-- <link rel="stylesheet" href="css/compte_rendu.css" type="text/css" media="screen" />--> </head>
<body>

<form>





<!--Div etape 1-->


<div id="etape_1" name='etape_1' style="display:block; font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 1</p><br/>

Quels ont été les thèmes abordés au cours de la séance ? <br/><br/>

<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC">
<td>Thème</td><td>Points traites :</td><td>Objectif :</font></td><td>Résultat :</font></td><td>Observation :</font></td>
</tr>
<tr>
<td><div style="display: block;" id="theme1"><select name="theme_1" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre1').style.display = 'block'; document.getElementById ('theme1').style.display = 'none';} if ((this.value == 'Autre') || (this.value !='')) {document.getElementById ('id_theme2').style.display = 'block';} "><option value=""></option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre1"><textarea name="theme_autre_1" cols="20" rows="4"></textarea></div></td><td><textarea name="theme_point_traite_1" cols="20" rows="4"></textarea></td><td><textarea name="theme_objectif_1" cols="20" rows="4" ></textarea></td><td><textarea name="theme_resultat_1" cols="20" rows="4"></textarea></td><td><textarea name="theme_observation_1" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme2" style="display: none;">
<td><div style="display:block" id="theme2"><select name="theme_2" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre2').style.display = 'block'; document.getElementById ('theme2').style.display = 'none';} "><option value=""></option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre2"><textarea name="theme_autre_1" cols="20" rows="4"></textarea></div></td><td><textarea name="theme_point_traite_2" cols="20" rows="4"></textarea></td><td><textarea name="theme_objectif_2" cols="20" rows="4"></textarea></td><td><textarea name="theme_resultat_2" cols="20" rows="4"></textarea></td><td><textarea name="theme_observation_2" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme3" style="display: none;">
<td><div style="display:block" id="theme3"><select name="theme_3" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre3').style.display = 'block'; document.getElementById ('theme3').style.display = 'none';}"><option value=""></option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre3"><textarea name="theme_autre_1" cols="20" rows="4"></textarea></div></td><td><textarea name="theme_point_traite_3" cols="20" rows="4"></textarea></td><td><textarea name="theme_objectif_3" cols="20" rows="4"></textarea></td><td><textarea name="theme_resultat_3" cols="20" rows="4"></textarea></td><td><textarea name="theme_observation_3" cols="20" rows="4"></textarea></td>
</tr>
<tr id="id_theme4" style="display: none;">
<td><div style="display:block" id="theme4"><select name="theme_4" onChange="if (this.value == 'Autre') {document.getElementById ('theme_autre4').style.display = 'block'; document.getElementById ('theme4').style.display = 'none';}"><option value=""></option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></div><div style="display:none" id="theme_autre4"><textarea name="theme_autre_1" cols="20" rows="4"></textarea></div></td><td><textarea name="theme_point_traite_4" cols="20" rows="4"></textarea></td><td><textarea name="theme_objectif_4" cols="20" rows="4"></textarea></td><td><textarea name="theme_resultat_4" cols="20" rows="4"></textarea></td><td><textarea name="theme_observation_4" cols="20" rows="4"></textarea></td>
</tr></table>

<br/>

<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px">Etape suivante <a href="javascript::void();" onClick="document.getElementById('etape_2').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_4').style.display='none'; document.getElementById('etape_5').style.display='none'; " ><img src="images/right_16.png" border="0" /></a> </p> <br/><br/>

</div>
<!--Fin Div etape 1-->

<!--Div etape 2-->
<div id="etape_2" name='etape_2' style="display:none;  font-size:12px;color:#006699 ">
<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px">Etape 2</p><br/>


Thème prévu pour le prochain RDV : <select name="theme_prochain"><option value="Plan d'évaluation">Plan d'évaluation</option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commerciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="">Autre</option></select>
<br/><br/>
Actions à réaliser pour le prochain RDV :
<br/><br/>
<table>
<tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#CCCCCC" >
<td>Thème</td><td>Démarches/actions prévues :</font></td><td>A faire par :</font></td><td>Objectif :</font></td><td>Résultat :</font></td><td>Observation :</font></td></tr>
<tr>
<td><select onChange=""><option value=""></option><option value="Cohérence H/P">Cohérence H/P</option><option value="Aspects commeciaux">Aspects commerciaux</option><option value="Aspects financiers">Aspects financiers</option><option value="Aspects juridiques">Aspects juridiques</option><option value="Bilan d'évaluation">Bilan d'évaluation</option><option value="Montage">Montage</option><option value="Suivi entreprise">Suivi entreprise</option><option value="Autre">Autre</option></select></td><td><textarea name="action_description_1" cols="25" rows="4"></textarea></td><td valign="top"><select name="action_attribue_a_1"><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td><textarea name="action_objectif_1" cols="25" rows="4"></textarea></td><td><textarea name="action_resultat_1" cols="25" rows="4"></textarea></td><td><textarea name="action_observation_1" cols="25" rows="4"></textarea></td>
</tr>
<tr>
<td></td><td><textarea name="action_description_2" cols="25" rows="4"></textarea></td><td><select name="action_attribue_a_2"><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td><textarea name="action_objectif_2" cols="25" rows="4"></textarea></td><td><textarea name="action_resultat_2" cols="25" rows="4"></textarea></td><td><textarea name="action_observation_2" cols="25" rows="4"></textarea></td>
</tr>
<tr>
<td></td><td><textarea name="action_description_3" cols="25" rows="4"></textarea></td><td><select name="action_attribue_a_3"><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td><textarea name="action_objectif_3" cols="25" rows="4"></textarea></td><td><textarea name="action_resultat_3" cols="25" rows="4"></textarea></td><td><textarea name="action_observation_3" cols="25" rows="4"></textarea></td>
</tr>
<tr>
<td></td><td><textarea name="action_description_4" cols="25" rows="4"></textarea></td><td><select name="action_attribue_a_4"><option value="Conseiller">Conseiller</option><option value="Porteur de projet">Porteur de projet</option></select></td><td><textarea name="action_objectif_4" cols="25" rows="4"></textarea></td><td><textarea name="action_resultat_4" cols="25" rows="4"></textarea></td><td><textarea name="action_observation_4" cols="25" rows="4"></textarea></td>
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
<td><input name="documents_elabores_1" type="text" size="50" /></td></tr>
<tr>
<td><input name="documents_elabores_2" type="text" size="50" /></td></tr>
<tr>
<td><input name="documents_elabores_3" type="text" size="50" /></td></tr>
<tr>
<td><input name="documents_elabores_4" type="text" size="50" /></td></tr>
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
<td><input name="support_1" type="text" size="50"/></td></tr>
<tr>
<td><input name="support_2" type="text" size="50"/></td></tr>
<tr>
<td><input name="support_3" type="text" size="50"/></td></tr>
<tr>
<td><input name="support_4" type="text" size="50"/></td></tr>
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
<td><input name="liens_web_1" type="text" size="50" /></td></tr>
<tr>
<td><input name="liens_web_2" type="text" size="50" /></td></tr>
<tr>
<td><input name="liens_web_3" type="text" size="50" /></td></tr>
<tr>
<td><input name="liens_web_4" type="text" size="50" /></td></tr>
</table><br/>
<br/>

<br/>
<p align="center"><input name="enregistrer" type="submit" value="Enregistrer"></p><br/>

<br/>

<p align="center" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:13px"><a href="javascript::void();" onClick="document.getElementById('etape_4').style.display ='block'; document.getElementById('etape_1').style.display='none'; document.getElementById('etape_2').style.display='none'; document.getElementById('etape_3').style.display='none'; document.getElementById('etape_5').style.display='none';" ><img src="images/left_16.png" border="0" /></a>Etape précédente </p> <br/><br/>

</div>
<!--Fin Div etape 5-->


</form>
<?php 
if (isset($_GET['enregistrer']))
{
	$cpte_rendu->inserer_compte_rendu('2085', '2200', '12500', '1003', '3', $_GET['point_aborde_1'], $_GET['point_aborde_2'], $_GET['point_aborde_3'], $_GET['theme'], $_GET["documents_elabores_1"]. ',' .$_GET["documents_elabores_2"]. ',' .$_GET["documents_elabores_3"]. ',' .$_GET["documents_elabores_4"], $_GET["liens_web_1"]. ',' .$_GET["liens_web_2"]. ',' .$_GET["liens_web_3"]. ',' .$_GET["liens_web_4"], $_GET["support_1"]. ',' .$_GET["support_2"]. ',' .$_GET["support_3"]. ',' .$_GET["support_4"]);	
	$cpte_rendu->inserer_compte_rendu_theme_aborde('7', $_GET['theme_point_traite_1'], $_GET['theme_objectif_1'], $_GET['theme_resultat_1'], $_GET['theme_observation_1']);
	
	if($_GET['theme_point_traite_2']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde('7', $_GET['theme_point_traite_2'], $_GET['theme_objectif_2'], $_GET['theme_resultat_2'], $_GET['theme_observation_2']);
	}
	if($_GET['theme_point_traite_3']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde('7', $_GET['theme_point_traite_3'], $_GET['theme_objectif_3'], $_GET['theme_resultat_3'], $_GET['theme_observation_3']);
	}
	if($_GET['theme_point_traite_4']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_theme_aborde('7', $_GET['theme_point_traite_4'], $_GET['theme_objectif_4'], $_GET['theme_resultat_4'], $_GET['theme_observation_4']);
	}
	
	$cpte_rendu->inserer_compte_rendu_action('7', $_GET['action_description_1'],  $_GET['action_attribue_a_1'], $_GET['action_objectif_1'], $_GET['action_resultat_1'], $_GET['action_observation_1']);
	
	if($_GET['action_description_2']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action('7', $_GET['action_description_2'],  $_GET['action_attribue_a_2'], $_GET['action_objectif_2'], $_GET['action_resultat_2'], $_GET['action_observation_2']);
	}
	if($_GET['action_description_3']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action('7', $_GET['action_description_3'],  $_GET['action_attribue_a_3'], $_GET['action_objectif_3'], $_GET['action_resultat_3'], $_GET['action_observation_3']);
	}
	if($_GET['action_description_4']!=NULL)
	{
	$cpte_rendu->inserer_compte_rendu_action('7', $_GET['action_description_4'],  $_GET['action_attribue_a_4'], $_GET['action_objectif_4'], $_GET['action_resultat_4'], $_GET['action_observation_4']);
	}

echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="window.location.href=\'impression.php\'";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);

  </script>';	

}


?>

</body></html>
<?php
echo $GLOBALS['egw']->common->egw_footer();
?>