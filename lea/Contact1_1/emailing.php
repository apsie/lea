<?php
include('../../Classes/config/config_egw_version.php');
$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => $contact_v,
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("../../Classes/config/inc_apsie/Email.php");
	
$mail = new Email();
$mail->form_mail( $GLOBALS['egw_info']['user']['firstname'].' '.$GLOBALS['egw_info']['user']['lastname'],$GLOBALS['egw_info']['user']['email'],$_GET['valeur_contact']);
$mail->envoyer_email($GLOBALS['egw_info']['user']['email'],$GLOBALS['egw_info']['user']['firstname'].' '.$GLOBALS['egw_info']['user']['lastname'],$_POST['des'],$_POST['objet'],$_POST['message'],$_POST['retour'],$_FILES['fichier']);

?>

