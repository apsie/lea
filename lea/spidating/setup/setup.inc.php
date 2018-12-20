<?php
/* spidating : Spirea Maquette
 * SPIREA - Juin 2012
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel spidating
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

$setup_info['spidating']['name'] = 'spidating';
$setup_info['spidating']['title'] = 'Module de ...';
$setup_info['spidating']['version'] = '0.001';
$setup_info['spidating']['app_order'] = 0;
$setup_info['spidating']['tables'] = array();
$setup_info['spidating']['enable'] = 1;

$setup_info['spidating']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['spidating']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);

$setup_info['spidating']['license'] = 'Copyright 2012 - Spirea';
$setup_info['spidating']['description'] = 'Module ...';

$setup_info['spidating']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8','14.1')
);
$setup_info['spidating']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8','14.1')
);

/* The hooks this app includes, needed for hooks registration */
/* note spirea : doit être nickel : pas de ligne vide, vérifier les applications et chemins */
$setup_info['spidating']['hooks']['preferences'] = 'spidating_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['spidating']['hooks']['settings'] = 'spidating_hooks::settings';  // affiche les liens dans le menu des préférences
$setup_info['spidating']['hooks']['admin'] = 'spidating_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['spidating']['hooks']['spidating menu'] = 'spidating_hooks::all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['spidating']['hooks']['sidebox_menu'] = 'spidating_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['spidating']['hooks']['search_link'] = 'spidating_hooks::search_link'; // note : il y avait une faute de frappe !
$setup_info['spidating']['hooks']['home'] = 'spidating_hooks::home'; //Permet d'afficher un hook sur la page d'accueil































