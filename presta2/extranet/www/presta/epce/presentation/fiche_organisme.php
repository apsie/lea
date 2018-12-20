<?php
session_start();
require('../inc/class.epce.inc.php');
$epce=new epce(date('Y'));

$val=$epce->return_val_organisme($_GET['nom_organisme']);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<title>Fiche organisme : <?php echo $_GET['nom_organisme']; ?></title>

</head>

<body bgcolor="#FEF9D8"><center><h2><img src="../images/32x32/customers.png" /> <?php echo $_GET['nom_organisme']; ?> - <?php echo $epce->return_nbr_by_organisme($_GET['nom_organisme']).' membre(s)'; ?> </h2>  
  <br/><br/><table style="background-color:#CCC; border:1px solid #000" height="217"><tr><td width="139">Rue</td><td style="font-weight:bolder" width="332"><?php echo $val[0]; ?></td></tr><tr><td>Adresse ligne 2</td><td style="font-weight:bolder"><?php echo $val[1]; ?></td></tr><tr><td>Adresse ligne 3</td><td style="font-weight:bolder"><?php echo $val[2]; ?></td></tr><tr><td>Code postal</td><td style="font-weight:bolder"><?php echo $val[3]; ?></td></tr><tr><td>Ville</td><td style="font-weight:bolder"><?php echo $val[4]; ?></td></tr><tr>
    <td>Région</td>
    <td style="font-weight:bolder"><?php echo $val[5]; ?></td></tr><tr>
    <td>Pays</td>
    <td style="font-weight:bolder"><?php echo $val[6]; ?></td></tr><tr><td>Tel</td><td style="font-weight:bolder"><?php echo $val[7]; ?></td></tr><tr><td height="22">Fax</td><td style="font-weight:bolder"><?php echo $val[8]; ?></td></tr><tr><td height="22">Email</td><td style="font-weight:bolder"><?php echo $val[9]; ?></td></tr><tr><td height="19">Site web</td><td style="font-weight:bolder"><a target="_blank" href="http://<?php echo $val[10]; ?>"><?php echo $val[10]; ?></a></td></tr></table>
  <hr /><?php $epce->afficher_membre_organisme($val[11],$_GET['nom_organisme'],$_GET['cat_organisme']); ?>
</center>
</body>
</html>