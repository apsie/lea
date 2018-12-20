<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package phpfreechat
 * @subpackage setup
 * @version $Id: tables_update.inc.php 47348 2014-06-24 10:00:50Z ralfbecker $
 */

function phpfreechat_upgrade1_6_001()
{
	return $GLOBALS['setup_info']['phpfreechat']['currentver'] = '1.8';
}


function phpfreechat_upgrade1_8()
{
	return $GLOBALS['setup_info']['phpfreechat']['currentver'] = '14.1';
}
