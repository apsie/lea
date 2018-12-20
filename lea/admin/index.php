<?php
/**
 * EGgroupware administration
 *
 * @link http://www.egroupware.org
 * @package admin
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: index.php 47559 2014-07-08 13:52:48Z ralfbecker $
 */

// redirect to admin with a meta-refresh, so admin/js/app.js can intercept, if loaded
echo '<html><head>
	<meta http-equiv="refresh" content="1;URL=../index.php?menuaction=admin.admin_ui.index&ajax=true"/>
</head>
<body></body>
</html>';
