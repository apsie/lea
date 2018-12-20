<?php
session_start();
ini_set('display_errors', 0);
if(isset($_SESSION['id']))
{}
else
{ header('Location: ../erreur.php');
}
include('../inc/class.epce.inc.php');
include('../../inc/class.rapport_activite.inc.php');

$rapport = new Rapport_activite($_SESSION['id']);
$rapport->action('confirme des options');
$epce = new epce(date('y'));
$date_2=time() + 2*(24 * 60 * 60);
	if(isset($_GET['conseiller_id']))
					{
					$id_con=$_GET['conseiller_id'];
					}
					else
					{
					$id_con=NULL;
					}
					
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmation des options</title>

<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>
<script> 


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
 <style>
   select
{
	width:auto;
	background-color: #FFF;
	color: #000;
	
	border:1px solid #DBDBDB;
}</style>
</head>


<body>
<form   name="form_b" id="form_b" action="confirmer.php" method="get"><table style="border:1px solid  #999" bgcolor="#F0F0F0" width="100%">
  <tr>
		<td width="832" height="38" align="center"><input type="hidden"  name="domain" value="default"/><input type="hidden" name="page" value="confirmation_option"  /><?php $epce->selectionner_conseiller4($id_con); ?> <select name="lieu"><option value="1">Choisir un lieu</option><option value="Antony">Antony</option><option value="Issy">Issy</option><option value="Vitry">Vitry</option><option value="Coulommiers">Coulommiers</option><option value="Meaux">Meaux</option><option value="Provins">Provins</option><option value="Montereau">Montereau</option><option value="Melun">Melun</option><option value="Courbevoie">Courbevoie</option><option value="Epinay">Epinay</option><option value="Gennevilliers">Gennevilliers</option><option value="Saint-Denis">Saint-Denis</option><option value="Saint-Maur">Saint-Maur</option></select>
		<input id="date_inscription" name="date_inscription" size="10" onfocus="self.status='*'; return true;" onblur="self.status=''; return true;" type="text" value="<?php echo date('d/m/Y', $date_2); ?>">
<script type="text/javascript">

	document.writeln('<img id="date_inscription-trigger" src="index.php_fichiers/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_inscription",
		button      : "date_inscription-trigger"
	}
	);
</script>
	  <input type="submit" value="Chercher" /></td>
	
	</tr></table>
	
</form>
<p>&nbsp;</p>
<p>


<?php



$option[]=null;





if(isset($_GET['lieu']) and $_GET['lieu']!=NULL)
{

$epce->liste_confirmation_option($_GET['lieu'],$_GET['date_inscription'],$_GET['conseiller_id']);
}

?>
</p>
</body>
</html>