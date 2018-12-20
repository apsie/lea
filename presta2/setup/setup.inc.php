<?php
/* 

réalisations, etc.

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/

$setup_info['presta2']['name'] = 'presta2';
$setup_info['presta2']['title'] = 'presta2';
$setup_info['presta2']['version'] = '2.000';
$setup_info['presta2']['app_order'] = 0;
$setup_info['presta2']['tables'] = array();
$setup_info['presta2']['enable'] = 1;

$setup_info['presta2']['author'][] = array(
	'name'  => 'Apsie',
	'email' => 'contact@apsie.org',
	'url'	=> 'http://www.apsie.org',
);

$setup_info['presta2']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);
$setup_info['presta2']['license']='Apsie';
$setup_info['presta2']['description']='Ce module permet la gestion des prestations Apsie';


$setup_info['presta2']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8','1.8.002')
);
$setup_info['presta2']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8')
);

/* The hooks this app includes, needed for hooks registration */
/* note spirea : doit être nickel : pas de ligne vide, vérifier les applications et chemins */
$setup_info['presta2']['hooks']['preferences'] = 'presta2_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['presta2']['hooks']['settings'] = 'presta2_hooks::settings';  // affiche les liens dans le menu des préférences
$setup_info['presta2']['hooks']['admin'] = 'presta2_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['presta2']['hooks']['presta2 menu'] = 'presta2_hooks::all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['presta2']['hooks']['sidebox_menu'] = 'presta2_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['presta2']['hooks']['search_link'] = 'presta2_hooks::search_link'; // note : il y avait une faute de frappe !
$setup_info['presta2']['hooks']['home'] = 'presta2_hooks::home'; //Permet d'afficher un hook sur la page d'accueil












