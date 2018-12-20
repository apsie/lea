<?php
/* SpiD : SpireaDemandes
SPIREA - 23/12/2009
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
$setup_info['spid']['name']='spid';
$setup_info['spid']['title']='Gestion de ticket et génération de factures';
$setup_info['spid']['version']='1.1.064';
$setup_info['spid']['app_order']=1;
$setup_info['spid']['enable']=1;

$setup_info['spid']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['spid']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);
$setup_info['spid']['license']='Copyright 2009-2014 - Spirea';
$setup_info['spid']['description']='Application de gestion de ticket depuis Egroupware. Cette application permet de gérer des spid et de générer les factures des spids correspondant';
$setup_info['spid']['depends'][]=array(
	'appname' => 'phpgwapi',
	'versions' => Array('1.4','1.5','1.6','1.7','1.8','14.1')
	);
	$setup_info['spid']['depends'][]=array(
	'appname' => 'etemplate',
	'versions' => Array('1.4','1.5','1.6','1.7','1.8','14.1')
	);
	$setup_info['spid']['depends'][]=array(
	'appname' => 'notifications',
	'versions' => Array('1.4','1.5','1.6','1.7','1.8','14.1')
	);

/* The hooks this app includes, needed for hooks registration */
$setup_info['spid']['hooks']['preferences'] = 'spid_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['spid']['hooks']['settings'] = 'spid_hooks::settings';  // défini le contenu des préferences
$setup_info['spid']['hooks']['admin'] = 'spid_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['spid']['hooks']['spid menu'] = 'spid_hooks::all_hooks'; // affiche les liens dans le menu spid menu
$setup_info['spid']['hooks']['sidebox_menu'] = 'spid_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['spid']['hooks']['search_link'] = 'spid_hooks::search_link';
$setup_info['spid']['hooks']['home'] = 'spid_hooks::home'; //Permet d'afficher un hook sur la page d'accueil


$setup_info['spid']['tables'] = array('spid_clients','spid_etats','spid_factures','spid_factures_details','spid_prix_parametres','spid_reponses','spid_reponses_standard','spid_tickets','spid_transitions','spid_locations','spid_url','spid_clients_relations','spid_tickets_view','spid_rendez_vous','spid_contrats','spid_contrats_type','spid_intervenants','spid_sectors','spid_facture_categories','spid_checklist');


























































