<?php include('../inc/class.impression_emargement_nacre1.php');
include('../inc/class.impression_couv_nacre1.php');



if(isset($_GET['imp_emargement']))
{
$emar = new  nacre1_emargement_impression();
$emar-> imprimer_emargement_totalite($_GET['id_beneficiaire'],$_GET['id_presta']);
}
if(isset($_GET['imp_couverture']))
{
$couv = new  nacre1_couv_impression();
$couv-> imprimer_couv_totalite($_GET['id_beneficiaire'],$_GET['id_presta']);
}

?>