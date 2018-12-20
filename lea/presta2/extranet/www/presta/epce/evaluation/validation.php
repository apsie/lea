<?php
include("../inc/class.epce.inc.php");

$epce = new epce(date('y'));

$epce->valider($_GET['choix'],$_GET['valider']);

header("Location: ../presentation/panel.php?choix=".$_GET['choix']."&display_eval=block");

?>