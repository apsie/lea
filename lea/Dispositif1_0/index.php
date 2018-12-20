<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'Dispositif1_0',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.dispositif.inc.php");

$dispositif = new dispositif();

?><html><body>
<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>

<div style="border:1px solid  #999 ; background: #E9E9E9" align="center"><input onClick="document.getElementById('dispositif').style.display='block'" type="button" value="Ajouter un dispositif" /></div><br/>
<?php 

$dispositif->voir_dispositif();
?>
<br/><br/><br/><br/><br/><br/>
<form action="" method="get"><div id="objectif" style="background-color:#E4E4E4;display:none; padding:5px; position:absolute; border:1px solid #000; left:40%; top: 40%;"><center>
  <strong><img src="images/script.png" /> AJOUTER UN OBJECTIF</strong>
</center><br/><table ><tr><td width="112">ID_dispositif</td><td width="157"><font color="#FF0000"><?php echo $_GET['id_dispositif']; ?></font><input type="hidden" name="id_dispo" value="<?php echo $_GET['id_dispositif']; ?>" /><input type="hidden" name="domain" value="default" /></td></tr><tr>
  <td width="112">Crit&egrave;re</td>
<td width="157"><?php $dispositif->selectionner_critere();?></td></tr><tr><td width="112">Objectif du critère</td><td width="157"><input type="text" name="objectif_critere" /></td></tr><tr><td width="112">Valeur du critère</td><td width="157"><select name="valeur_critere"><option value="=">=</option><option value="<="><=</option><option value=">=">>=</option></select></td><tr><td width="112">Degré du critère</td><td width="157"><select name="degre_critere"><option value="1">Obligatoire</option><option value="0">Facultatif</option></select></td></tr><tr><td width="112" height="55" align="right"><input onClick="document.getElementById('objectif').style.display='none'" type="button" value="Fermer" /></td><td width="157"><input type="submit" name="enregistrer_objectif" value="Enregistrer" /></td></tr></table></div></form>


<form action="" method="get"><input type="hidden" name="domain" value="default" /><div id="dispositif" style="background-color:#E4E4E4; display:none; padding:5px; position:absolute; border:1px solid #000; left:35%; top: 40%; width: 444px;"><center>
  <strong><img src="images/wallet_16.png" /> AJOUTER UN DISPOSITIF</strong>
</center><br/><table ><tr>
  <td width="120">Nom du dispositif</td>
<td width="300"><select name="nom_dispositif"><option value="OEM">OEM</option><option value="TVE">TVE</option><option value="CAP">CAP</option><option value="OPCRE">OPCRE</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="EPI_BP">EPI_BP</option><option value="BC">BC</option><option value="VAE">VAE</option><option value="EPCE">EPCE</option></select></td></tr><tr>
<td width="120">Num&eacute;ro de march&eacute;</td><td width="300"><input type="text" name="numero_marche" /></td></tr><tr>
<td width="120">Objet</td><td width="300"><input type="text" size="50" name="objet" /></td><tr>
  <td width="120">Date de d&eacute;but</td>
  <td width="300"><input type="text" name="date_debut" id="date_debut" value="" /> <script type="text/javascript">

	document.writeln('<img id="date_debut-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_debut",
		button      : "date_debut-trigger"
	}
	);
</script></td></tr><tr>
  <td width="120">Date de fin</td>
  <td width="300"><input type="text" name="date_fin" id="date_fin" /> <script type="text/javascript">

	document.writeln('<img id="date_fin-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin",
		button      : "date_fin-trigger"
	}
	);
</script></td></tr><tr><td width="120" height="55" align="right"><input onClick="document.getElementById('dispositif').style.display='none'" type="button" value="Fermer" /></td><td width="300"><input type="submit" name="enregistrer_dispositif" value="Enregistrer" /></td></tr></table></div></form>


<form action="" method="get"><input type="hidden" name="domain" value="default" /><input type="hidden" name="id_dispositif_edit" value="<?php echo $_GET['id_dispositif_edit'];?>" /><div id="modifier_dispositif" style="background-color:#E4E4E4; display:none; padding:5px; position:absolute; border:1px solid #000; left:35%; top: 40%; width: 444px;"><center>
  <strong><img src="images/wallet_16.png" /> MODIFIER UN DISPOSITIF</strong>
</center><br/><table ><tr>
<td width="120">Id_Dispositif</td>
<td style="color:#F00" width="300"><?php echo $_GET['id_dispositif_edit'];?></td></tr><tr>
  <td width="120">Nom du dispositif</td>
<td width="300"><select name="nom_dispositif"><option value="<?php echo $_GET['nom_dispositif'];?>"><?php echo $_GET['nom_dispositif'];?></option><option value="OEM">OEM</option><option value="TVE">TVE</option><option value="CAP">CAP</option><option value="OPCRE">OPCRE</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="EPI_BP">EPI_BP</option><option value="BC">BC</option><option value="VAE">VAE</option><option value="EPCE">EPCE</option></select></td></tr><tr>
<td width="120">Num&eacute;ro de march&eacute;</td><td width="300"><input type="text" name="numero_marche" value="<?php echo $_GET['numero_marche'];?>" /></td></tr><tr>
<td width="120">Objet</td><td width="300"><input type="text" size="50" name="objet" value="<?php echo $_GET['objet'];?>" /></td><tr>
  <td width="120">Date de d&eacute;but</td>
  <td width="300"><input type="text" name="date_debut_m" id="date_debut_m" value="<?php echo date("d/m/Y",$_GET['date_debut']);?>" /> <script type="text/javascript">

	document.writeln('<img id="date_debut_m-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_debut_m",
		button      : "date_debut_m-trigger"
	}
	);
</script></td></tr><tr>
  <td width="120">Date de fin</td>
  <td width="300"><input type="text" name="date_fin_m" id="date_fin_m" value="<?php echo date("d/m/Y",$_GET['date_fin']);?>" /> <script type="text/javascript">

	document.writeln('<img id="date_fin_m-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin_m",
		button      : "date_fin_m-trigger"
	}
	);
</script></td></tr><tr><td width="120" height="55" align="right"><input onClick="document.getElementById('modifier_dispositif').style.display='none'" type="button" value="Fermer" /></td><td width="300"><input type="submit" name="enregistrer_dispositif_modifier" value="Enregistrer" /></td></tr></table></div></form>

<div id="statistique_dispositif" style="background-color:#E4E4E4; display:none; padding:5px; position:absolute; border:1px solid #000; left:20%; top: 10%; width: 758px;"><center>
  <strong><img src="images/wallet_16.png" /> STATISTIQUES DU DISPOSITIF</strong>
</center><br/><table width="729" ><tr><td width="236"><strong>Objet du dispositif</strong></td><td width="481" style="color:#F00"><?php echo $_GET['objet_dispositif_statistique'];?></td></tr></table><br/>
<strong>Liste des crit&egrave;res</strong><br/>
<br/><center><?php if(isset($_GET['id_dispositif_statistique']))$dispositif->selectionner_objectif_dispositif($_GET['id_dispositif_statistique']) ?></center><br/><center><?php if(isset($_GET['id_dispositif_statistique']))$dispositif->stats_objectif_dispositif($_GET['id_dispositif_statistique']) ?></center>
<br/><br/><center></center><br/><br/><center><input onClick="document.getElementById('statistique_dispositif').style.display='none'" type="button" value="Fermer" /></center></div>
<?php
if(isset($_GET['id_dispositif']))
{
echo"<script>document.getElementById('objectif').style.display='block'</script>";
}
if(isset($_GET['enregistrer_dispositif']))
{
	
$dispositif->inserer_dispositif($_GET['nom_dispositif'],$_GET['numero_marche'],$_GET['objet'],$_GET['date_debut'],$_GET['date_fin']);
echo'<script>window.location.href="index.php?domain=default";</script>';

}
if(isset($_GET['enregistrer_dispositif_modifier']))
{
	
$dispositif->update_dispositif($_GET['id_dispositif_edit'],$_GET['nom_dispositif'],$_GET['numero_marche'],$_GET['objet'],$_GET['date_debut_m'],$_GET['date_fin_m']);
echo'<script>window.location.href="index.php?domain=default";</script>';

}
if(isset($_GET['enregistrer_objectif']))
{
	
$dispositif->inserer_objectif($_GET['id_dispo'],$_GET['id_critere'],$_GET['objectif_critere'],$_GET['valeur_critere'],$_GET['degre_critere']);
echo'<script>window.location.href="index.php?domain=default";</script>';

}
if(isset($_GET['id_dispositif_delete']))
{
	
$dispositif->delete_dispositif($_GET['id_dispositif_delete']);
echo'<script>window.location.href="index.php?domain=default";</script>';

}
if(isset($_GET['id_dispositif_statistique']))
{
	

echo"<script>document.getElementById('statistique_dispositif').style.display='block'</script>";

}
if(isset($_GET['id_dispositif_edit']))
{
	
//$dispositif->modifier_dispositif($_GET['id_dispositif_edit']);
echo"<script>document.getElementById('modifier_dispositif').style.display='block'</script>";

}

echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>