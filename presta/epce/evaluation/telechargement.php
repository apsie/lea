<?php
session_start();
//include('../inc/class.epce.inc.php');
//include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../nacre1/inc/class.nacre_impression.inc.php');



if($_GET['statut']=="adhere_pas")
{
$impression_adp= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
$impression_adp->email_siege='presta@apsie.org';
$impression_adp->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut'],$_SESSION['comment']);
//$impression_adp->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut']);
}
if($_GET['statut']=="abandon")
{
$impression_adp= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
$impression_adp->email_siege='presta@apsie.org';


$impression_adp->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut'],$_SESSION['motif_abandon']);
}
if($_GET['statut']=="adhere")
{
$impression_ad= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
if($_GET['email_siege']!="none")
{
	$impression_ad->email_siege='presta@apsie.org';
}
else
{
$impression_ad->email_siege=NULL;
}
$impression_ad->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],$_GET['statut']);
}

if($_GET['statut']=="plan_eval")
{

$impression= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
if($_GET['email_siege']!="none")
{
	$impression->email_siege='presta@apsie.org';
}
else
{
$impression->email_siege=NULL;
}
	
$impression->imprimer_totalite_plan($_GET['choix'],$_SESSION['id']);

}

if($_GET['statut']=="annexe1")
{


$impression_an= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);		
$impression_an->imprimer_totalite_annexe1($_GET['choix'],$_SESSION['id']);

}
if($_GET['statut']=="emargement")
{
$impression_emargement= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);		
$impression_emargement->imprimer_totalite_emargement($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);
}
if($_GET['statut']=="bilan")
{
	if($_SESSION['type_presta']=="NACRE1")
	{
	$impression_bilan= new nacre_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
/*if($_GET['email_siege']!="none")
{
$impression_bilan->email_siege='presta@apsie.org';
}
else
{
$impression_bilan->email_siege=NULL;
}*/
$impression_bilan->imprimer_totalite($_GET['choix'],$_SESSION['id']);

	}
	else
	{
$impression_bilan= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
if($_GET['email_siege']!="none")
{
$impression_bilan->email_siege='presta@apsie.org';
}
else
{
$impression_bilan->email_siege=NULL;
}
$impression_bilan->imprimer_totalite($_GET['choix'],$_SESSION['id']);
	}
}
if($_GET['statut']=="couverture")
{

$impression_couverture= new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);	
$impression_couverture->imprimer_couvertures();
}
?>