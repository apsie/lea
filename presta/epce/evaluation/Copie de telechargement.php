<?php
session_start();
include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');

if($_GET['statut']=="adhere_pas")
{
$impression_pas= new epce_impression($_GET['choix'],$_SESSION['id']);	
$impression_pas->email_siege='drenault@apsie.org';
$impression_pas->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut'],$_GET['comment']);
}
if($_GET['statut']=="adhere")
{
$impression_pas= new epce_impression($_GET['choix'],$_SESSION['id']);	
$impression_pas->email_siege='drenault@apsie.org';
$impression_pas->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut']);
}

if($_GET['statut']=="plan_eval")
{
$impression = new epce_impression($_GET['choix'],$_SESSION['id']);

$impression->email_siege='drenault@apsie.org';
	
$impression->imprimer_totalite_plan($_GET['choix'],$_SESSION['id']);

}



?>