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
else
{

}
if(isset($_GET['id_presta']) and $_GET['id_presta']!=NULL)
{
$_SESSION['id_presta']=$_GET['id_presta'];
}
else
{

}
if(isset($_GET['lc']) and $_GET['lc']!=NULL)
{
$_SESSION['lc']=$_GET['lc'];
}
else
{

}
//echo 't'.$_SESSION['id_ben'];







?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../css/presta.css" title="blue">
<title>SUITE DE LA PRESTA</title>
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
                  
<form action="presentation/imprimer_bilan.php" method="get"><input type="hidden" name="id" value="<?php echo $_GET['id'];?>" /><input type="hidden" name="id_ben" value="<?php echo $_GET['id_ben'];?>" /><input type="hidden" name="lc" value="<?php echo $_GET['lc'];?>" /><input type="hidden" name="intitule" value="<?php echo $_GET['intitule'];?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta'];?>" /><input type="hidden" name="presta" value="<?php echo $_GET['presta'];?>" /><table style="font-size:18px"><tr>
  <td width="434" height="56" align="center"><blink><strong>Que voulez-vous faire ?</strong></blink></td></tr><tr><td align="center" height="68"><table width="374"><tr><td width="366"><input type="radio" name="selection" value="continuer" /> 
              <span class="vert">Continuer la prestation</span></td></tr><tr><td width="366"> <input type="radio" name="selection" value="abandon" /> 
              <span class="rouge">Abandonner la prestation</span></td></tr><tr><td width="366"><input type="radio" name="selection" value="apres" /> 
Me rappeler plus tard! </td> </tr></table></td>
</tr><tr><td align="center" height="67"><input type="submit" value="Valider"  /></td></tr></table></form>
<?php }?>
</body>
</html>
