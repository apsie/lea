<?php 
session_start();
include('inc/class.epce.inc.php');
include('inc/class.epce_impression.inc.php');

if(isset($_GET['nom_conseiller']) and isset($_GET['prenom_conseiller']))
{
$_SESSION['nom_conseiller']=$_GET['nom_conseiller'];
$_SESSION['prenom_conseiller']=$_GET['prenom_conseiller'];
}

if(isset($_GET['id']) and $_GET['id']!=NULL)
{
$_SESSION['id']=$_GET['id'];
}
else
{

}
if(isset($_GET['id_ben']) and $_GET['id_ben']!=NULL)
{
$_SESSION['id_ben']=$_GET['id_ben'];
}
else
{

}
if(isset($_GET['intitule']) and $_GET['intitule']!=NULL)
{
$_SESSION['intitule']=$_GET['intitule'];
}

if(isset($_GET['id_presta']) and $_GET['id_presta']!=NULL)
{
$_SESSION['id_presta']=$_GET['id_presta'];
}
else
{

}
//echo 't'.$_SESSION['id_ben'];
$epce = new epce();
$retour=$epce->variable_beneficiaire($_GET['id_ben']);


if($retour[22]!=NULL)
{
	$tel=$retour[22];
	}
else
{ $tel=$retour[17];
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../css/presta.css" title="blue">
<title>PREMIER RENDEZ-VOUS</title>
<style type="text/css">
<!--
.rouge {
	color: #F00;
}
.vert {
	color: #0C0;
}
-->
</style>
</head>

<body>
<?php if(!isset($_GET['presence']))
					   {?>
                  
<form action="presentation/imprimer_bilan.php" method="get"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>" /><input type="hidden" name="id_ben" value="<?php echo $_GET['id_ben'];?>" /><input type="hidden" name="intitule" value="<?php echo $_GET['intitule'];?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta'];?>" /><table style="font-size:14px; background: #F7F7F7; border:1px solid #666"><tr><td width="434" height="56" align="center"><strong><?php echo $retour[1].' ( '.$tel.' ) '; ?> est il présent ?</strong></td></tr><tr><td align="center" height="68"><table width="374"><tr><td width="366"><img width="50" height="50" src="images/msn/PNG/Msn_Buddy.png" /> <input type="radio" name="selection" value="present" /> 
              <span class="vert">Oui </span></td></tr><tr><td width="366"> <!--<input type="radio" name="selection" value="adhere_pas" /> 
              <span class="rouge">Oui mais n'adhère pas</span></td></tr><tr><td width="366">--> <img width="50" height="50" src="images/msn/PNG/Msn_Buddy-Offline.png" /> <input type="radio" name="selection" value="NSPP" /> <span class="rouge">Non</span></td></tr><tr><td width="366"><img width="50" height="50" src="images/msn/PNG/Msn_Buddy-Away.png" /> <input type="radio" checked="checked" name="selection" value="apres" /> 
Me rappeler plus tard! </td> </tr></table></td>
</tr><tr><td align="center" height="67"><input style=" padding:10px; border:1px solid  #CCC;  background-color:#FFF" type="submit" value="Valider"  /></td></tr></table></form>
<?php }?>
</body>
</html>
