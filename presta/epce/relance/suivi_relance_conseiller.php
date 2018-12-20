<?php
session_start();

include("../inc/class.epce.inc.php");
include("../inc/class.info_log.inc.php");

$epce= new epce();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Suivi des relances</title>

<link rel="stylesheet" type="text/css" media="all" href="../index.php_fichiers/calendar-blue.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
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
		<td width="832" height="38" align="center"><strong>Relances en attente</strong> 
		  
         </td>
	
	</tr></table></form>
	

<p>&nbsp;</p>
<div style="padding-left:15px">


<?php
if(isset($_POST['Voir']))
{

	$rapport = new info_log();
	$rapport->select_info_log_admin($_POST['conseiller_id'],$_POST['date_inscription']);
	
	

}







?>
</div>
</body>
</html>