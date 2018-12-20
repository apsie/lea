<?php


$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'spiclient',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);
	
include('../header.inc.php');

// check if we have an advanced search and reset it in case
$old_state = $GLOBALS['egw']->session->appsession('index','spiclient');

if ($old_state['advanced_search'])
{
	unset($old_state['advanced_search']);
	$GLOBALS['egw']->session->appsession('index','spiclient',$old_state);
}

	
$GLOBALS['egw']->redirect_link('/index.php','menuaction=spiclient.client_ui.index');

?>
