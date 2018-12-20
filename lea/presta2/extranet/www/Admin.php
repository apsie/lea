<?php 

$prestataire = new prestataire();
$view->prestataire = $prestataire->getPrestataire();
$group = new groupe();
$view->group = $group->getGroupe();
$view->app = $p_database->getListApplication(1);
?>