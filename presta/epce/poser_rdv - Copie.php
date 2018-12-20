<?php
include("inc/class.epce.inc.php");


$epce = new epce(date('Y'));




$date_choisi=explode('/',$_GET['date_choisi']);
$titre=$date_choisi[0].$date_choisi[1].'_'.$_GET['prestation'].'_'.$_GET['name'];

	for ($i=0;$i<count($_GET['pose']);$i++)

{

$lapose[$i] = $_GET['pose'][$i];
$dates=explode('-',$lapose[$i]);



$id=$epce->inserer_cal($titre,$_GET['lieu'],$_SESSION['id'],$_GET['conseiller_id']);
$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);

$epce->link_rdv($_GET['choix'],$id);


} 




header('Location: evaluation/plan.php?choix='.$_GET['choix']);
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="evaluation/plan.php?choix='.$_GET['choix'].'"</SCRIPT>';


?>