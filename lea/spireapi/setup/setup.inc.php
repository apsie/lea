<?php
/**
 * eGroupware - Spireapi - 
 * SpireAPI : Module and functions set to manage referentials in eGroupware 
 *
 * @link http://www.spirea.fr
 * @package spireapi
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-10 by Spirea
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
  */

$setup_info['spireapi']['name'] = 'spireapi';
$setup_info['spireapi']['title'] = 'Module API de spirea';
$setup_info['spireapi']['version'] = '0.020';
$setup_info['spireapi']['app_order'] = 90;
$setup_info['spireapi']['tables'] = array('spireapi_employee','spireapi_site','spireapi_area','spireapi_vat','spireapi_function','spireapi_team','spireapi_employee_data','spireapi_translation','spireapi_acc_accounts','spireapi_acc_book','spireapi_facture_categories','spireapi_country');
$setup_info['spireapi']['enable'] = 1;

$setup_info['spireapi']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['spireapi']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);

$setup_info['spireapi']['license'] = 'Copyright 2012 - Spirea';
$setup_info['spireapi']['description'] = 'Module API de spirea';

$setup_info['spireapi']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8','1.9','14.1')
);
$setup_info['spireapi']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8','14.1')
);

/* The hooks this app includes, needed for hooks registration */
/* note spirea : doit être nickel : pas de ligne vide, vérifier les applications et chemins */
$setup_info['spireapi']['hooks']['preferences'] = 'spireapi_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['spireapi']['hooks']['settings'] = 'spireapi_hooks::settings';  // affiche les liens dans le menu des préférences
$setup_info['spireapi']['hooks']['admin'] = 'spireapi_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['spireapi']['hooks']['spireapi menu'] = 'spireapi_hooks::all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['spireapi']['hooks']['sidebox_menu'] = 'spireapi_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['spireapi']['hooks']['search_link'] = 'spireapi_hooks::search_link'; // note : il y avait une faute de frappe !
$setup_info['spireapi']['hooks']['home'] = 'spireapi_hooks::home'; //Permet d'afficher un hook sur la page d'accueil









































