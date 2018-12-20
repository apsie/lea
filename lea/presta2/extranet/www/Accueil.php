<?php 
//global $conn;
//$p_database = new _database($conn);
//$p_database->MAJDATEIDPRESTATAIRE();
//$p_database->MAJDATE();exit();
//$p_database->MAJCALSTATUS();exit();
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/navigation.js'); 
$view->headScript()->appendFile('./js/class/template.js'); 
$view->headScript()->appendFile('./js/class/evenement.js'); 
$view->headScript()->appendFile('./js/class/calendrier.js'); 
$view->headScript()->appendFile('./js/class/presta.js');
$view->headScript()->appendFile('./js/class/graph.js');
$view->headScript()->appendFile('./js/class/option.js');
$view->headScript()->appendFile('./js/class/organisation.js');
$view->headScript()->appendFile('./js/class/color.js');
$view->headScript()->appendFile('./js/class/contact.js');

$ev = new evenement($conn);
$p = new prestation($conn);
$c = new calendrier($conn);
$view->nbNewEvent = $ev->getNbNewEvent($_SESSION['id']);
$view->nbPrestation = $p->getNbPrestation($_SESSION['id'],"Nouvelle");
$view->nbRdv = $c->getNbRdv($_SESSION['id'],"P");
$view->listRdv = $c->getListRdv($_SESSION['id'],"P");
$view->listPrestation = $p->getListPrestation($_SESSION['id'],"Nouvelle");
$view->listEv = $ev->getListNewEvent($_SESSION['id']);


?>