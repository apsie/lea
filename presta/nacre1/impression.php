<?php
include('inc/class_nacre_preliminaire_impression.inc.php');

if($_GET['imprimer']=="preliminaire")
{
$imp = new nacre_preliminaire_impression();
$imp->imprimer_totalite($_GET['id_ben'],$_GET['id_presta']);
}
?>