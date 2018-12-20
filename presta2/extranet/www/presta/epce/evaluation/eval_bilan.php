<?php
session_start();
include("../inc/class.epce_evaluation.inc.php");
include("../inc/class.epce.inc.php");
include('../../nacre1/inc/class.nacre_evaluation.inc.php');
if($_POST['motif_abandon']!=NULL)
{
$_SESSION['motif_abandon'] = $_POST['motif_abandon'];
}


$epce=new epce(date('y'));

/*if($_POST['avis']==1)
{
$_POST['avis']='Negatif';
}
elseif($_POST['avis']==2)
{
$_POST['avis']='Positif sous reserve de mise en œuvre du plan d\'actions';
}
elseif($_POST['avis']==3)
{
$_POST['avis']='Positif';
}

elseif($_POST['avis']==4)
{
$_POST['avis']='Solution alternative proposer';
}

if($_POST['avis_']==1)
{
$_POST['avis_']='Entre 6 mois et 1 an (identifier une solution alternative de retour a  l\'emploi a  court terme)';
}
elseif($_POST['avis_']==2)
{
$_POST['avis_']='Entre 3 et 6 mois';
}
elseif($_POST['avis_']==3)
{
$_POST['avis_']='Inferieur a 3 mois';
}

*/
if($_SESSION['type_presta']=="EPCE")
{
	$evaluation_nacre1=new nacre_evaluation();
$retour = $evaluation_nacre1->verif_bilan_avis($_POST['id_beneficiaire'], $_POST['avis'], utf8_decode($_POST['commentaire_bilan1']), $_POST['avis_'], utf8_decode($_POST['commentaire_bilan2']),utf8_decode($_POST['r_emploi']),$_POST['rome'],utf8_decode($_POST['com_ref']),utf8_decode($_POST['com_ben']),'');
}
	if($_SESSION['type_presta']=="NACRE1")
{
	$evaluation_nacre1=new nacre_evaluation();
$retour = $evaluation_nacre1->verif_bilan_avis($_POST['id_beneficiaire'], $_POST['avis'], utf8_decode($_POST['commentaire_bilan1']), $_POST['avis_'], utf8_decode($_POST['commentaire_bilan2']),utf8_decode($_POST['r_emploi']),$_POST['rome'],utf8_decode($_POST['com_ref']),utf8_decode($_POST['com_ben']),$_POST['id_presta']);
}
if($_SESSION['type_presta']!="NACRE1")
{
$evaluation_epce=new epce_evaluation();
$retour = $evaluation_epce->verif_bilan_avis($_POST['id_beneficiaire'], $_POST['avis'], utf8_decode($_POST['commentaire_bilan1']), $_POST['avis_'], utf8_decode($_POST['commentaire_bilan2']),utf8_decode($_POST['r_emploi']),$_POST['rome'],utf8_decode($_POST['com_ref']),utf8_decode($_POST['com_ben']),$_POST['id_presta']);
}






echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert=suite";</script>';



?>