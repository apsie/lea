<?php
include('../inc/class.epce.inc.php');

$epce = new epce(date('y'));




$date_choisi=explode('/',$_GET['date_choisi']);
$titre=$date_choisi[0].$date_choisi[1].'_'.$_GET['prestation'].'_Option_'.$_GET['lieu'];

	for ($i=0;$i<count($_GET['pose']);$i++)

{

$lapose[$i] = $_GET['pose'][$i];
$dates=explode('-',$lapose[$i]);



$id=$epce->inserer_cal($titre,$_GET['lieu'],$GLOBALS['egw_info']['user']['userid'],$_GET['conseiller_id']);
$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);


} 
header('Location: pose_options.php?lieu='.$_GET['lieu'].'&date_choisi='.$_GET['date_choisi'].'&conseiller='.$_GET['conseiller'].'&conseiller_id='.$_GET['conseiller_id'].'');
/*echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="index.php?page=poser_option&domain=default&lieu='.$_GET['lieu'].'&date_choisi='.$_GET['date_choisi'].'&conseiller='.$_GET['conseiller'].'"</SCRIPT>';*/


?>