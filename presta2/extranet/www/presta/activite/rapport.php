<?php


include("../epce/inc/class.epce.inc.php");
include("../inc/class.rapport_activite.inc.php");

$epce= new epce(date('y'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rapport d'activité</title>

<link rel="stylesheet" type="text/css" media="all" href="../index.php_fichiers/calendar-blue.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="../css/presta.css" title="blue">
<script type="text/javascript" src="../index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="../index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="../index.php_fichiers/etemplate.js"></script>




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
<form action="" method="post" ><table style="border:1px solid  #999" bgcolor="#F0F0F0" width="100%">
  <tr>
		<td width="832" height="38" align="center"><input type="hidden"  name="domain" value="default"/><input type="hidden" name="page" value="confirmation_option"  /><?php $epce->selectionner_conseiller2(); ?> à partir du 
		  <input id="date_inscription" name="date_inscription" size="10" onfocus="self.status='*'; return true;" onblur="self.status=''; return true;" type="text" value="<?php echo date('d/m/Y'); ?>">
<script type="text/javascript">

	document.writeln('<img id="date_inscription-trigger" src="../index.php_fichiers/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_inscription",
		button      : "date_inscription-trigger"
	}
	);
</script>
	  <input type="submit"  value="Voir" name="Voir" /></td>
	
	</tr></table></form>
	

<p>&nbsp;</p>
<div style="padding-left:15px">


<?php
if(isset($_POST['Voir']))
{

	$rapport = new Rapport_activite();
	$valeur=$rapport->voir($_POST['conseiller_id'],$_POST['date_inscription']);
	
	

}







?>
</div>
</body>
</html>