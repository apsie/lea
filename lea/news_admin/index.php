<?php
/**
 * news_admin - Index
 *
 * @link http://www.egroupware.org
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @package news_admin
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: index.php 49659 2014-12-01 21:19:36Z nathangray $
 */

header('Location: ../index.php?menuaction=news_admin.news_ui.index&ajax=true'.
	(isset($_GET['sessionid']) ? '&sessionid='.$_GET['sessionid'].'&kp3='.$_GET['kp3'] : ''));
