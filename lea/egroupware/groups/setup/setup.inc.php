<?php
/**
 * Stylite: Group administration
 *
 * @link www.stylite.de
 * @author Ralf Becker <rb(at)stylite.de>
 * @copyright (c) 2014 by Ralf Becker <rb(at)stylite.de>
 * @package stylite
 * @subpackage setup
 * @version $Id: setup.inc.php 3116 2014-06-24 09:42:09Z ralfbecker $
 */

$setup_info['groups']['name']        = 'groups';
$setup_info['groups']['version']     = '14.1';
$setup_info['groups']['app_order']   = 1;
$setup_info['groups']['tables']      = array();
$setup_info['groups']['enable']      = 2;		// no navbar
$setup_info['groups']['autoinstall'] = true;	// install automatically on update

$setup_info['groups']['author'] = array(
	'name'  => 'Ralf Becker',
	'email' => 'rb@stylite.de',
);
$setup_info['groups']['maintainer'] = array(
	'name'  => 'Stylite AG',
	'url'   => 'http://www.stylite.de',
);
$setup_info['groups']['license']  = array(
	'name' => 'Stylite EPL license',
	'url'  => 'http://www.stylite.de/EPL',
);
$setup_info['groups']['description'] = 'Part of EPL EGroupware packages from Stylite AG';
$setup_info['groups']['note'] = 'For more information please visit: <a href="http://www.stylite.de/EPL" target="_blank">www.stylite.de/EPL</a>';

/* The hooks this app includes, needed for hooks registration */
$setup_info['groups']['hooks']['edit_group'] = 'groups_admin::actions';

/* Dependencies for this app to work */
$setup_info['groups']['depends'][] = array(
	'appname' => 'phpgwapi',
	'versions' => Array('14.1')
);
