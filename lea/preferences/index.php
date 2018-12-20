<?php
/**
 * EGroupware Preferences
 *
 * @link http://www.egroupware.org
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @package calendar
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: index.php 44571 2013-11-18 08:22:19Z ralfbecker $
 */

header('Location: ../index.php?menuaction=preferences.preferences_settings.index'.
	(isset($_GET['sessionid']) ? '&sessionid='.$_GET['sessionid'].'&kp3='.$_GET['kp3'] : ''));
