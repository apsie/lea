<?php
/* apsieben : Spirea Readonly
SPIREA - Janvier 2012
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel apsieben

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/

$setup_info['apsieben']['name'] = 'apsieben';
$setup_info['apsieben']['title'] = 'apsieben';
$setup_info['apsieben']['version'] = '1.000';
$setup_info['apsieben']['app_order'] = 999;
$setup_info['apsieben']['tables'] = '';
$setup_info['apsieben']['enable'] = 1;

$setup_info['apsieben']['author'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'	=> 'http://www.spirea.fr',
);

$setup_info['apsieben']['maintainer'][] = array(
	'name'  => 'Spirea',
	'email' => 'contact@spirea.fr',
	'url'   => 'http://www.spirea.fr'
);
$setup_info['apsieben']['license'] = 'Copyright 2013 - Spirea';
$setup_info['apsieben']['description'] = 'Module ...';

$setup_info['apsieben']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => array('1.8')
);
$setup_info['apsieben']['depends'][] = array(
	'appname' => 'etemplate',
	'versions' => array('1.8')
);

$setup_info['apsieben']['hooks']['search_link'] = 'apsieben_hooks::search_link';
$setup_info['apsieben']['hooks']['calendar_resources']	= 'apsieben_hooks::calendar_resources';

$setup_info['apsieben']['tables'] = array('egw_contact');
