<?php
/**
 * EGroupware - Notifications
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package notifications
 * @link http://www.egroupware.org
 * @author Cornelius Weiss <nelius@cwtech.de>
 * @version $Id: setup.inc.php 53149 2015-07-19 10:24:53Z ralfbecker $
 */

if (!defined('NOTIFICATION_APP'))
{
	define('NOTIFICATION_APP','notifications');
}

$setup_info[NOTIFICATION_APP]['name']      = NOTIFICATION_APP;
$setup_info[NOTIFICATION_APP]['version']   = '14.3';
$setup_info[NOTIFICATION_APP]['app_order'] = 1;
$setup_info[NOTIFICATION_APP]['tables']    = array('egw_notificationpopup');
$setup_info[NOTIFICATION_APP]['enable']    = 2;

$setup_info[NOTIFICATION_APP]['author'] = 'Cornelius Weiss';
$setup_info[NOTIFICATION_APP]['maintainer'] = array(
	'name'  => 'eGroupware coreteam',
	'email' => 'egroupware-developers@lists.sf.net'
);
$setup_info[NOTIFICATION_APP]['license']  = 'GPL';
$setup_info[NOTIFICATION_APP]['description'] =
'Instant notification of users via various channels.';

/* The hooks this app includes, needed for hooks registration */
$setup_info[NOTIFICATION_APP]['hooks'][] = 'after_navbar';
$setup_info[NOTIFICATION_APP]['hooks'][] = 'settings';
$setup_info[NOTIFICATION_APP]['hooks'][] = 'admin';
$setup_info[NOTIFICATION_APP]['hooks']['deleteaccount'] = 'notifications.notifications.deleteaccount';

/* Dependencies for this app to work */
$setup_info[NOTIFICATION_APP]['depends'][] = array(
	 'appname' => 'phpgwapi',
	 'versions' => Array('14.1')
);
$setup_info[NOTIFICATION_APP]['depends'][] = array(
	 'appname' => 'etemplate',
	 'versions' => Array('14.1')
);

