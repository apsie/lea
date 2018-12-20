<?php
/* 

réalisations, Apsie 2016.

Reproduction, utilisation ou modification interdite sans autorisation de Apsie
*/

$setup_info['Presta_3']['name'] = 'Presta_3';
$setup_info['Presta_3']['title'] = 'Presta_3';
$setup_info['Presta_3']['version'] = '14.3';
$setup_info['Presta_3']['app_order'] = 1;
$setup_info['Presta_3']['tables'] = array();
$setup_info['Presta_3']['enable'] = 1;

$setup_info['Presta_3']['author'][] = array(
	'name'  => 'Apsie',
	'email' => 'contact@apsie.org',
	'url'	=> 'http://www.apsie.org',
);

$setup_info['Presta_3']['maintainer'][] = array(
	'name'  => 'Apsie',
	'email' => 'contact@apsie.org',
	'url'   => 'http://www.apsie.fr',
);
$setup_info['Presta_3']['license']='Apsie';
$setup_info['Presta_3']['description']='Ce module permet la gestion des prestations Apsie';


$setup_info['Presta_3']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8','1.8.002','14.3')
);
$setup_info['Presta_3']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8','1.8.002','14.3')
);

/* The hooks this app includes, needed for hooks registration */
/* vérifier les applications et chemins */
$setup_info['Presta_3']['hooks']['preferences'] = 'Presta_3_hooks::all_hooks';  // affiche les liens dans le menu des préférences
$setup_info['Presta_3']['hooks']['settings'] = 'Presta_3_hooks::settings';  // affiche les liens dans le menu des préférences
$setup_info['Presta_3']['hooks']['admin'] = 'Presta_3_hooks::all_hooks'; // affiche les liens dans le menu d'administration
$setup_info['Presta_3']['hooks']['Presta_3 menu'] = 'Presta_3_hooks::all_hooks'; // affiche les liens dans le menu spiclient menu
$setup_info['Presta_3']['hooks']['sidebox_menu'] = 'Presta_3_hooks::all_hooks'; // affiche le menu sur la gauche de l'appli
$setup_info['Presta_3']['hooks']['search_link'] = 'Presta_3_hooks::search_link'; // note : il y avait une faute de frappe !
$setup_info['Presta_3']['hooks']['home'] = 'Presta_3_hooks::home'; //Permet d'afficher un hook sur la page d'accueil












