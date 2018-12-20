<?php

/* spirea - includes egroupware
*/



$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'presta2',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);
	
	
// spirea - tch - ylf
// $GLOBALS['egw_info'] = array(
	// 'flags' => array(
		// 'disable_Template_class' => True,		
		// 'noheader'   => False,
		// 'currentapp' => 'presta2',
// ));


include('../header.inc.php');
echo "1";

// $siteinfo = $sites_bo->get_currentsiteinfo();
// if (!$location) $location = $siteinfo['site_url'];
if (!$location)
{
	$location = 'extranet/www/index.php?page=Presta';
	echo "ici";
	//error_log("_GET[location]=$_GET[location], siteinfo[site_url]=$siteinfo[site_url] --> $location");
	$GLOBALS['egw']->redirect($location);
	exit;
}

	

// Include('extranet/www/index.php');


?>