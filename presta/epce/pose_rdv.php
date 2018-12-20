<?php
session_start();

//include("config/config.php");
//include("config/inc_apsie/Prestation.php");
include("/data/html/egw_apsie_143/Classes/config/config.php");
include("/data/html/egw_apsie_143/Classes/config/inc_apsie/Prestation.php");
include("inc/class.epce.inc.php");


$prestation = new Prestation();
$liste_presta=$prestation->selectionner_liste_prestation();



$epce= new epce(date('Y'));
$retour=$epce->variable_beneficiaire($_GET['choix']);
$var_con=$epce->get_conseiller_presta($_GET['id_presta']);

if(isset($_GET['lieu']))
{
$valeur_lieu = $_GET['lieu'];
}
if(isset($_GET['date_start']))
{
$valeur_date = $_GET['date_start'];
}
else
{
$valeur_date = date('d/m/Y');
}

if(isset($_GET['plage1']))
{
$valeur_plage1 = $_GET['plage1'];
}
else
{
$valeur_plage1 ="09";
}
if(isset($_GET['plage2']))
{
$valeur_plage2 = $_GET['plage2'];
}
else
{
$valeur_plage2 ="17";
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nouvau rendez-vous</title>
<style type="text/css">
<!--
body,select,input {
	font-size:11px;
	font-family:Arial;
	border:1px solid #CCC;
}
-->
</style><script>
function Check_all(state)
{
  
  var i;
  var tabInput=document.getElementsByTagName("input");
  var n=tabInput.length;
  
  for(i=0;i<n;i++)
  {
  	if(tabInput[i].type=='checkbox')
  	{
  		tabInput[i].checked=state;
  	}
  		
  }
 }
 </script>
<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>

</head>

<body><form style="padding-left:50px;" action="pose_rdv.php" method="get" >
  <center><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>"/>
  <h2>NOUVEAU RENDEZ-VOUS POUR <?php  echo $retour[3].' '.$retour[1];  ?></h2></center><center>
    <p><font color=red><img src="images/icons/eye.png"  /> <a  href="#" onclick="window.open('../../calendar/index.php','CALENDRIER','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=800, height=600');"  > Consulter votre calendrier en page annexe</a></font></p>
    <br/>
  </center><table bgcolor="#F2F2F2" style="border:1px solid #000"><tr><td width="114">Lieu</td><td width="247"  align="left" ><select  name="lieu"><option 
  ><?php echo  $_SESSION['cat_name']; ?></option><option value="Melun">Melun</option><option value="Vitry">Vitry</option><option value="Montereau">Montereau</option><option value="Coulommiers">Coulommiers</option><option value="Provins">Provins</option><option value="Torcy">Torcy</option><option value="Meaux">Meaux</option><option value="Courbevoie">Courbevoie</option><option value="Epinay">Epinay</option><option value="Gennevilliers">Gennevilliers</option><option value="Saint-Denis">Saint-Denis</option><option value="Saint-Maur">Saint-Maur</option></select></td></tr><tr>
    <td width="114">Conseiller</td>
    <td width="247"  align="left" ><?php $epce->selectionner_conseiller($var_con[2].' '.$var_con[1],$var_con[0]); ?></td></tr><tr>
        <td>A partir du </td><td><input id="date_start" name="date_start" value="<?php echo $valeur_date; ?>" type="text" /> <script type="text/javascript">

	document.writeln('<img id="date_start-trigger" src="index.php_fichiers/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_start",
		button      : "date_start-trigger"
	}
	);
</script> 
      
</td></tr><tr>
  <td>Durée</td><td><select name="duree" >


<option value="3600" selected="selected">1:00</option>

</select></td></tr><tr><td>Plage</td><td><select name="plage1">


<option value="<?php echo $valeur_plage1; ?>" selected="selected" ><?php echo $valeur_plage1; ?></option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>


</select>

	




		jusqu'a 
		







		<select name="plage2"  >


<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="<?php echo $valeur_plage2; ?>" selected="selected"><?php echo $valeur_plage2; ?></option>


</select></td></tr><!--<tr>
		  <td>Sur</td>
		  <td><select name="selection"><option selected="selected"  value="28">Quatre semaines</option></select></td></tr>--><tr>
		    <td>Tous les</td>
		    <td><select name="jours"><option value="Monday">Lundi</option><option value="Tuesday">Mardi</option><option value="Wednesday">Mercredi</option><option value="Thursday">Jeudi</option><option value="Friday">Vendredi</option></select></td></tr><!--<tr>
		    <td>Intervalle</td>
		    <td><select name="intervalle"><option  selected="selected" value="604800">Une semaine</option></select></td></tr>--></table>
  <p>
    <input type="hidden" name="choix" value="<?php echo $_GET['choix']; ?>"/><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>"/><input type="submit" onclick="document.getElementById('recherche').style.display='block';document.getElementById('chercher').style.display='none';" id="chercher" name="chercher" value="Chercher" /> 
    <input type="button" value="Retour" OnClick="window.location='presentation/panel.php?<?php echo '&choix='.$_GET['choix'];?>'">
  <div style="width:200px; display:none" id="recherche"><marquee><font color="#009933"><img src="images/load.gif" /> Recherche en cours... , patientez svp.</font></marquee></div>
    
  </p>
  <p>&nbsp;</p>
</form>
<?php


if(isset($_GET['chercher']))
{
if($_GET['nombre']==0)
{
$_GET['nombre']=50;
}
if($_GET['lieu']=="")
{
echo"<br/> <font color=red>Veuillez préciser le lieu de la prestation...</font>";
}
else
{
echo'<hr /><form style="padding-left:50px;" name="test" action="poser_rdv.php" method="get"><input type="hidden" name="choix" value="'.$_GET['choix'].'"><table><tr><td><input type="hidden" name="name" value="'.$retour[1].' '.$retour[2].'"/><strong>CONSEILLER</strong> : <font color=red>'.$epce->get_conseiller($_GET['conseiller_id']).' </font> ; <strong>LIEU</strong> : '.$_GET['lieu'].' ; <strong>BENEFICIAIRE</strong> : '.$retour[3].' '.$retour[1].' ; <strong>PRESTATION</strong> : <select name="prestation">';
for($i=0;$i<count($liste_presta);$i++)
{
echo'<option >'.$liste_presta[$i]['nom_dispositif'].'</option>';

}
echo'</select> ; <strong>A PARTIR DU </strong> : '.$_GET['date_start'].'</td><td><input  name="lieu" type="hidden" value="'.$_GET['lieu'].'" /><input  name="id_presta" type="hidden" value="'.$_GET['id_presta'].'" /><input type="hidden" name="conseiller_id" value='.$_GET['conseiller_id'].' /></td></tr></table>';

$epce->chercher_rdv($_GET['date_start'],$_GET['selection'],$_GET['plage1'],$_GET['plage2'],$_GET['duree'],$_GET['conseiller_id'],$_GET['lieu'],$_GET['nombre'],$_GET['jours'],$_GET['choix'],$_GET['intervalle']);
	echo '<center><input style="font-size:18px" type="submit" value="Poser" /></center><br/></form>';
}
}
?>
</body>
</html>
