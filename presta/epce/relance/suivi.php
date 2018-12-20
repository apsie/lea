<?php
session_start();

include("../inc/class.epce.inc.php");
include("../../inc/class.info_log.inc.php");

$info = new info_log();

if(isset($_GET['id']) and $_GET['id']!=NULL)
{
$_SESSION['id']=$_GET['id'];
}
if(isset($_GET['id_ben']) and $_GET['id_ben']!=NULL)
{
$_SESSION['id_ben']=$_GET['id_ben'];
}
if(isset($_GET['id_presta']) and $_GET['id_presta']!=NULL)
{
$_SESSION['id_presta']=$_GET['id_presta'];
}


if(isset($_GET['info_id'])) 
{

	/*echo'<script>voirdetail();</script>';*/

$_SESSION['variable']=$info->recup_info_log($_GET['info_id']);


	}



$epce= new epce();

$retour=$epce->variable_beneficiaire($_SESSION['id_ben']);

if($retour[21]!=NULL)
{$tel=$retour[21];}
elseif($retour[22]!=NULL)
{$tel=$retour[22];}


if($_POST['type']!=NULL) 
{
	//echo '<img src="../images/icons/accept.png" /> <font color=green>Relance sauvegardée</font>';
	
	$info->new_info_log($_POST['type'],''.$retour[0].'',''.$tel.' / '.$retour[23].'',$epce->texte_id($_POST['motif']),$epce->texte_id($_POST['mode']),$_POST['commentaire_1'],$_POST['commentaire_2'],$epce->texte_id($_POST['prochain_contact']),$_POST['date'],$epce->texte_id($_POST['resultat']),$_SESSION['id'],''.$retour[1].' '.$retour[2].' '.$retour[3].' '.$retour[4].'',$_POST['id_ben'],$_SESSION['id_presta']);
/*
echo"<script>window.location.href='suivi.php'</script>";*/
}
if(isset($_POST['cloturer'])) 
{

	$info->cloturer_relance($_SESSION['id_presta']);
	echo '<script>window.parent.opener.location.reload()</script>';
	echo'<script>window.close();</script>';
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="../../index.php_fichiers/calendar-blue.css" title="blue">
<script>
function verifForm()
{ 
	 if (document.getElementById('mode').value == "" )
  {
    	alert('Champ "Mode" non rempli !');
		return false;	
  }
	 
	 if (document.getElementById('motif').value == "" )
  {
    	alert('Champ "Motif" non rempli !');
		return false;
  }
 
  if (document.getElementById('resultat').value == "" )
  {
    	alert('Champ "Résultat" non rempli !');
		return false;
  }
     if (document.getElementById('prochain_contact').value == "" )
  {
    	alert('Champ "Prochain contact" non rempli !');
		return false;
  }
      if (document.getElementById('commentaire_1').value == "" )
  {
    	alert('Champ "Commentaire1" non rempli !');
		return false;
  }
       if (document.getElementById('commentaire_2').value == "" )
  {
    	alert('Champ "Commentaire2" non rempli !');
		return false;
  }
  else {return true;}
} 
function Confirmcloture() {
       if (confirm("Voulez-vous vraiment archiver ce suivi?")) { // Clic sur OK
          return true ;
       }
	   else {return false;}
   }
   function voirdetail() {
       document.getElementById('relance_lecture').style.display='block';
   }
</script> 

<title>SUIVI DES RELANCES</title>

<script type="text/javascript" src="../../index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="../../index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="../../index.php_fichiers/etemplate.js"></script>


<style type="text/css">
<!--
.vert {
	color: #093;
}
-->
</style>
</head>

<body style="padding:15px;">

<p style="font-size:18px"><strong>SUIVI DES RELANCES de <?php echo $retour[0].' | <font color=red>'.$tel.' / '.$retour[23].'</font>';?></strong></p>
 <div style="text-align: left">
  <?php $info->select_info_log($_SESSION['id_presta']); ?><br/><br /><form action="suivi.php" method="post"><input type="button" onclick="document.getElementById('relance').style.display='block';document.getElementById('relance_lecture').style.display='none';" value="Nouvelle relance" /> <input type="button" onclick="window.parent.opener.location.reload();window.close();"  value="Fermer" />
<input type="hidden" name="id_ben" value="<?php echo $_SESSION['id_presta']; ?>"/>
  <input style="background-color:#F00; color:#FFF; font-weight:bolder" name="cloturer" type="Submit" value="Archiver" onclick="return Confirmcloture();"/>
  </form>
</div>
<hr />
<p><div style="display:none" id="relance"><form onsubmit="return verifForm();" action="suivi.php"  method="post"><table width="802" height="160" align="center"  style="border:1px solid #999;"><tr bgcolor="#C4DFFD">
  <td width="283" style="text-align: right"><strong>Type</strong></td>
  <td  style="text-align: left" width="507">
    <select style="text-align: left" name="type" >
  <?php  $epce->texte('Type_relance'); ?>
    </select>
  </td>
</tr><tr bgcolor="#FFFFFF">
  <td width="283" style="text-align: right"><strong>Mode</strong></td>
  <td  style="text-align: left" width="507">
    <select id="mode" style="text-align: left" name="mode"  >
      <option></option>
  <?php  $epce->texte('Mode'); ?>
    </select>
  </td>
</tr><tr bgcolor="#C4DFFD">
  <td width="283" style="text-align: right"><strong>Motif</strong></td>
  <td  style="text-align: left" width="507">
    <select id="motif" style="text-align: left;color:#006" name="motif"  >
      <option></option>
  <?php  $epce->texte('Motif'); ?>
    </select>
  </td>
</tr><tr bgcolor="#FFFFFF">
  <td width="283" style="text-align: right"><strong>Résultat</strong></td>
  <td  style="text-align: left" width="507">
    <select id="resultat" style="text-align: left;color:#2B6A00" name="resultat"  >
      <option></option>
  <?php  $epce->texte('Resultat'); ?>
    </select>
  </td>
</tr><tr bgcolor="#C4DFFD">
  <td width="283" style="text-align: right"><strong>Commentaire 1</strong></td>
  <td  style="text-align: left" width="507">
    <textarea id="commentaire_1" style="text-align: left" name="commentaire_1" cols="60" rows="7"></textarea>
  </td>
</tr><tr bgcolor="#FFFFFF">
  <td width="283" style="text-align: right"><strong>Prochain contact</strong></td>
  <td style="text-align: left"  width="507">
    <select id="prochain_contact" style="text-align: left" name="prochain_contact" >
      <option></option>
  <?php  $epce->texte('Prochain_contact'); ?>
    </select> 
    Le <input style="text-align: left" id="date" name="date" type="text" /> 
    <script type="text/javascript">

	document.writeln('<img id="date-trigger" src="../../index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date",
		button      : "date-trigger"
	}
	);
    </script>
  </td>
</tr><tr bgcolor="#C4DFFD">
  <td width="283" style="text-align: right"><strong>Commentaire 2</strong></td>
  <td width="507" style="text-align: left">
    <textarea id="commentaire_2" name="commentaire_2" cols="60" rows="7"></textarea>
  </td>
</tr><tr><td style="text-align: right">
      <input type="hidden" name="id_ben" value="<?php echo $_SESSION['id_ben']; ?>"  />    
      <input type="button" style="font-size:18px" value="Fermer" onclick="document.getElementById('relance').style.display='none'" />
</td>
  <td style="text-align: left">
      <input style="font-size:18px" name="Enregistrer la relance" type="submit" class="weekend" value="Enregistrer la relance" />
      </td>
</tr></table>

</form></div>

<div style="display:none" id="relance_lecture"><table width="450" height="160" align="center"  style="border:1px solid #999;"><tr bgcolor="#FFFFFF">
  <td width="122" style="text-align: right"><strong>ID</strong></td>
  <td  style="text-align: left" width="316"><font color="#FF0000"><?php echo $_GET['info_id']; ?></font></td>
</tr><tr bgcolor="#C4DFFD">
  <td width="122" style="text-align: right"><strong>Type</strong></td>
  <td  style="text-align: left" width="316"><?php echo $_SESSION['variable'][0]; ?></td>
</tr><tr bgcolor="#FFFFFF">
  <td width="122" style="text-align: right"><strong>Mode</strong></td>
  <td  style="text-align: left" width="316"><?php echo $_SESSION['variable'][1]; ?></td>
</tr><tr bgcolor="#C4DFFD">
  <td width="122" style="text-align: right"><strong>Motif</strong></td>
  <td  style="text-align: left" width="316"><?php echo utf8_encode($_SESSION['variable'][2]); ?></td>
</tr><tr bgcolor="#FFFFFF">
  <td width="122" style="text-align: right"><strong>Résultat</strong></td>
  <td  style="text-align: left" width="316"><?php echo utf8_encode($_SESSION['variable'][3]); ?></td>
</tr><tr bgcolor="#C4DFFD">
  <td width="122" style="text-align: right"><strong>Commentaire 1</strong></td>
  <td  style="text-align: left" width="316"><?php echo utf8_encode($_SESSION['variable'][4]); ?></td>
</tr><tr bgcolor="#FFFFFF">
  <td width="122" style="text-align: right"><strong>Prochain contact</strong></td>
  <td style="text-align: left"  width="316"><?php echo utf8_encode($_SESSION['variable'][5]).' '.date('d/m/Y',$_SESSION['variable'][6]);  ?>
     
    
     
  </td>
</tr><tr bgcolor="#C4DFFD">
  <td width="122" style="text-align: right"><strong>Commentaire 2</strong></td>
  <td width="316" style="text-align: left"><?php echo utf8_encode($_SESSION['variable'][7]); ?></td>
</tr></table>

</div>

</body>
</html>
<?php 
if(isset($_GET['info_id'])) 
{

	echo'<script>voirdetail();</script>';

//$_SESSION['variable']=$info->recup_info_log($_GET['info_id']);


	}
	
	?>
