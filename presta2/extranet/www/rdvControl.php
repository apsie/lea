<?php 
$_GET['header'] = 0 ;
$contact = new contact();

$data = $contact->getContacts('','','',$_GET['id_contact']);
$view->nom_complet = utf8_encode($data[0]['nom_complet']);
$view->id_presta = $_GET['id_presta'];
$view->presta = $_GET['presta'];
$view->url_presta = strtolower($_GET['presta']);
$view->tel = $contact->getTel($data[0]);

prestation::setSession(array('IDPRESTA'	=> $_GET['id_presta']));
global $conn;
$presta = new prestation($conn);
$data = $presta->get_prestation($_GET['id_presta']);
$view->statut_presta = $data['statut'];
?>