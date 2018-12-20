<?php 
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/option.js');
/*$view->headScript()->appendFile('./js/class/contact.js');
$view->headScript()->appendFile('./js/class/organisation.js');*/
$_GET['header'] =0 ;
#exemple
//if(!isset($_POST['id_presta']))
//$_POST['id_presta'] = 6072;
#Init
$presta_data = new presta_data();



#Récupération de la data du projet
$data = projet::getProjetByPresta($_POST['id_presta']);
$view->projet = $data;

#Récupération de la data du contact
$view->contact = contact::get_contactv2(NULL,$_POST['id_presta']);

//print_r($view->contact);die();
#Récupération de la data en fonction de la presta
$dataPresta = $presta_data->get($_POST['id_presta']);
$view->presta = outils::convertDataPresta($dataPresta);

#prestation
$view->prestation = prestation::getPrestationByIdPresta($_POST['id_presta']);


$view->id_presta = $_POST['id_presta']; 

$dataTexte = texte::getTexte($params);
$view->texteArray =  texte::getOptionByIdTexte($dataTexte);
//print_r($view->texteArray );die();

// Rdv Contact
global $conn;
$cal = new calendrier($conn);
$view->rdv = $cal->getRdvContactByPresta($_POST['id_presta']);
//print_r($rdv);die();



// Pas de rechargement de la page contact
$view->noReload = 1;

?>