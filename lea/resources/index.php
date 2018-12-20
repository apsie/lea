<?php
/**
 * eGroupWare - resources
 * http://www.egroupware.org
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package resources
 * @author Cornelius Weiss <egw@von-und-zu-weiss.de>
 * @author Lukas Weiss <wnz_gh05t@users.sourceforge.net>
 * @version $Id: index.php 34350 2011-03-23 15:25:59Z nathangray $
 */

header('Location: ../index.php?menuaction=resources.resources_ui.index'.
	(isset($_GET['sessionid']) ? '&sessionid='.$_GET['sessionid'].'&kp3='.$_GET['kp3'] : ''));
