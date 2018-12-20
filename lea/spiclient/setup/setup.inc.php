<?php
/* SpiClient : SpireaClient
SPIREA - 23/12/2009
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaClients - Ce module est un programme informatique servant à la gestion des clients dans un environnement egroupware.

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
$setup_info['spiclient']['name']='spiclient';
$setup_info['spiclient']['title']='Gestion des clients';
$setup_info['spiclient']['version']='1.033';
$setup_info['spiclient']['app_order']=10;
$setup_info['spiclient']['enable']=1;

$setup_info['spiclient']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['spiclient']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);
$setup_info['spiclient']['license']='Copyright 2009-2014 - Spirea';
$setup_info['spiclient']['description']='Application de gestion de client depuis Egroupware. Cette application permet de gérer des spiclient';
$setup_info['spiclient']['depends'][]=array(
	'appname' => 'phpgwapi',
	'versions' => Array('1.8','14.1')
	);
	$setup_info['spiclient']['depends'][]=array(
	'appname' => 'etemplate',
	'versions' => Array('1.8','14.1')
	);
	$setup_info['spiclient']['depends'][]=array(
	'appname' => 'notifications',
	'versions' => Array('1.8','14.1')
	);

/* The hooks this app includes, needed for hooks registration */
$hook_location = 'spiclient_hooks::';
if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
	$hook_location = 'spiclient.spiclient_hooks.';
}
$setup_info['spiclient']['hooks']['preferences'] = $hook_location.'all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['spiclient']['hooks']['settings'] = $hook_location.'settings';  // défini le contenu des préferences
$setup_info['spiclient']['hooks']['admin'] = $hook_location.'all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['spiclient']['hooks']['spiclient menu'] = $hook_location.'all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['spiclient']['hooks']['sidebox_menu'] = $hook_location.'all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['spiclient']['hooks']['search_link'] = $hook_location.'search_link';
$setup_info['spiclient']['hooks']['home'] = $hook_location.'home'; //Permet d'afficher un hook sur la page d'accueil


$setup_info['spiclient']['tables'] = array('spiclient','spiclient_relations','spiclient_contrats','spiclient_contrats_type','spiclient_sectors','spiclient_locations','spiclient_contrats_status','spiclient_mode_reglement','spiclient_delai_paiement','spiclient_zones','spiclient_roles','spiclient_client_nature','spiclient_nature_technique','spiclient_type_client','spiclient_checklist','spiclient_contrats_member','spiclient_contrats_budget','spiclient_address_type','spiclient_address');



