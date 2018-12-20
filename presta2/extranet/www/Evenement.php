<?php 

// Spirea
$view->headScript()->appendFile('./js/liste_aide.js');

$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/template.js');
$view->headScript()->appendFile('./js/class/evenement.js');
$categorie = new categorie();
$view->listCategorie = $categorie->getCategories('contact');
$view->listStatut= texte::selectioinner_texte("Statut 1");
$view->listActivite= texte::selectioinner_texte("secteur_activite");
$view->listCategorie_org = $categorie->getCategories('organisation');
$view->utilisateurs =utilisateur::getUtilisateurs("A");
//print_r($view->listStatut);

?>