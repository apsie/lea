<?php

session_start();
unset($_SESSION['abandon']);
unset($_SESSION['motif_abandon']);
if(isset($_GET['nom_conseiller']) and isset($_GET['prenom_conseiller']))
{
$_SESSION['nom_conseiller']=$_GET['nom_conseiller'];
$_SESSION['prenom_conseiller']=$_GET['prenom_conseiller'];
}
if(isset($_GET['id']) and  isset($_GET['id_ben']))
{
$_SESSION['id']=$_GET['id'];
$_SESSION['lc']=$_GET['lc'];


if($_GET['continuer']==1)
{header('Location: presentation/panel.php?lc='.$_GET['lc'].'&type_presta='.$_GET['presta'].'&id_presta='.$_GET['id_presta'].'&choix='.$_GET['id_ben'].'&display_eval=block#eval');}
elseif($_GET['abandon']==1)
{
	
	header('Location: evaluation/bilan.php?ab=1&lc='.$_GET['lc'].'&type_presta='.$_GET['presta'].'&id_presta='.$_GET['id_presta'].'&choix='.$_GET['id_ben'].'');}

else
{header('Location: presentation/panel.php?lc='.$_GET['lc'].'&type_presta='.$_GET['presta'].'&id_presta='.$_GET['id_presta'].'&choix='.$_GET['id_ben'].'');}



} 
elseif(isset($_GET['id']) and  isset($_GET['option']))
{
$_SESSION['id']=$_GET['id'];
header('Location: options/pose_options.php');
}
elseif(isset($_GET['id']) and  isset($_GET['confirmer']))
{
$_SESSION['id']=$_GET['id'];
header('Location: options/confirmer.php');
}
elseif(isset($_GET['id']) and  isset($_GET['relance_conseiller']))
{
$_SESSION['id']=$_GET['id'];
header('Location: relance/suivi_relance_conseiller.php');
}
elseif(isset($_GET['id']) and  isset($_GET['nouveau_epce']))
{
$_SESSION['id']=$_GET['id'];
header('Location: presentation/nouveau_beneficiaire.php');
}

?>