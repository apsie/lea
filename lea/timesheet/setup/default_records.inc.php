<?php
/**
 * TimeSheet - Default records
 *
 * @link http://www.egroupware.org
 * @author Nathan Gray
 * @package timesheet
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: default_records.inc.php 47494 2014-07-03 16:16:30Z ralfbecker $
 */

foreach(array(
	'history'     => 'history',
) as $name => $value)
{
	$GLOBALS['egw_setup']->db->insert(
		$GLOBALS['egw_setup']->config_table,
		array(
			'config_app' => 'timesheet',
			'config_name' => $name,
			'config_value' => $value,
		),array(
			'config_app' => 'timesheet',
			'config_name' => $name,
		),__LINE__,__FILE__
	);
}

