<?php 

switch ($_REQUEST['action']) {
	case 'maj_texte':
		
		$data = array(	'id_texte'	=>	$_REQUEST['id_texte'],
						'id_texte_key'	=>	$_REQUEST['id_texte_key'],
						'texte'			=>	utf8_decode($_REQUEST['texte']));
		$retour = texte::addTexte($data);
		
		echo json_encode($retour);
	
	break;
	
	default:
		;
	break;
}?>