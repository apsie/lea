<?php
	//$baseUrl = "http://lea.app/app_dev.php";
	//modif pour test / spirea - tch $baseUrl = "https://lea.apsie.org/app/app_dev.php";
	//$baseUrl = "https://lea.apsie.org/app/app_dev.php";

	$baseUrl = "http://lea143.apsie.org/app/app_dev.php"; 
	$key = '463acff2fbc81768ced97932140a0712';
	 
  /**************************************************************************\
  * eGroupWare                                                               *
  * http://www.egroupware.org                                                *
  * The file written by Joseph Engo <jengo@phpgroupware.org>                 *
  * This file modified by Greg Haygood <shrykedude@bellsouth.net>            *
  * This file modified by Edo van Bruggend <edovanbruggen@raketnet.nl>       *
  * --------------------------------------------                             *
  *  This program is free software; you can redistribute it and/or modify it *
  *  under the terms of the GNU General Public License as published by the   *
  *  Free Software Foundation; either version 2 of the License, or (at your  *
  *  option) any later version.                                              *
  \**************************************************************************/

  /* $Id: index.php 38791 2012-04-04 16:21:18Z ralfbecker $ */

	/*
	** Initializing the home application
	*/
	$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => true,
			'nonavbar'                => false,
			'currentapp'              => 'Presta_3',
		)
	);

	include('../header.inc.php');

	echo'<iframe id="frame" src="'.$baseUrl.'/presta/'.$GLOBALS['egw_info']['user']['account_id'].'-'.$key.'" width="100%" height="800px" frameborder="NO" scrolling="auto" noresize="noresize" marginwidth="0" marginheight="0"></iframe>';
	
	$GLOBALS['egw']->framework->render(ob_get_clean());
