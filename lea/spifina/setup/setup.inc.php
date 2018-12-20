<?php
/* spifina : Spirea Maquette
 * SPIREA - Juin 2012
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel spifina
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

$setup_info['spifina']['name'] = 'spifina';
$setup_info['spifina']['title'] = 'Module de finance';
$setup_info['spifina']['version'] = '0.007';
$setup_info['spifina']['app_order'] = 0;
$setup_info['spifina']['tables'] = array('spifina_factures','spifina_factures_details');
$setup_info['spifina']['enable'] = 1;

$setup_info['spifina']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['spifina']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);

$setup_info['spifina']['license'] = 'Copyright 2012-2014 - Spirea';
$setup_info['spifina']['description'] = '';

$setup_info['spifina']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8','14.1')
);
$setup_info['spifina']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8','14.1')
);

$setup_info['spifina']['depends'][] = array(
	'appname' => 'spiclient',
	'versions' => array('1.024','1.025')
);

$setup_info['spifina']['depends'][] = array(
	'appname' => 'spireapi',
	'versions' => array('0.017', '0.019','0.020')
);

/* The hooks this app includes, needed for hooks registration */
/* note spirea : doit être nickel : pas de ligne vide, vérifier les applications et chemins */
$setup_info['spifina']['hooks']['preferences'] = 'spifina_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['spifina']['hooks']['settings'] = 'spifina_hooks::settings';  // affiche les liens dans le menu des préférences
$setup_info['spifina']['hooks']['admin'] = 'spifina_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['spifina']['hooks']['spifina menu'] = 'spifina_hooks::all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['spifina']['hooks']['sidebox_menu'] = 'spifina_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['spifina']['hooks']['search_link'] = 'spifina_hooks::search_link'; // note : il y avait une faute de frappe !
$setup_info['spifina']['hooks']['home'] = 'spifina_hooks::home'; //Permet d'afficher un hook sur la page d'accueil




































