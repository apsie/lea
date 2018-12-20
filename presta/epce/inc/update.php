<?php
include('class.epce.inc.php');

$id=$_GET['id'];
$id_ben=$_GET['id_ben'];
$annee=$_GET['annee'];
$categorie=$_GET['categorie'];
$epce=new epce();
$epce->delete($id,$id_ben);
header('Location: ../presentation/panel.php?valid=1&annee='.$annee.'&categorie='.$categorie.'&choix='.$id_ben.'');



?>