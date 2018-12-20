<?php
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/navigation.js');
$view->headScript()->appendFile('./js/class/projet.js'); 
$view->headScript()->appendFile('./js/class/calendrier.js'); 


$texte = new texte();

$user = new _user($conn);

$view->id_projet = $_GET['id_projet'];

/*
$view->option_regime_fiscal = $texte->selectioinner_texte('regime_fiscal');
$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
$view->option_regime_tva = $texte->selectioinner_texte('regime_tva');
$view->option_regime_imposition = $texte->selectioinner_texte('regime_imposition');
$view->option_secteur_activite = $texte->selectioinner_texte('secteur_activite');
$view->option_implantation = $texte->selectioinner_texte('implantation');
$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
$view->option_dirigeant = $texte->selectioinner_texte('dirigeant');
$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');
$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
//$view->option_activite_principale = $texte->selectioinner_texte('activite_principale');
$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');*/
?>