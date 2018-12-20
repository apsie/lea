<?php


$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'spid',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);
	
include('../header.inc.php');

// check if we have an advanced search and reset it in case
$old_state = $GLOBALS['egw']->session->appsession('index','spid');

if ($old_state['advanced_search'])
{
	unset($old_state['advanced_search']);
	$GLOBALS['egw']->session->appsession('index','spid',$old_state);
}

	
$GLOBALS['egw']->redirect_link('/index.php','menuaction=spid.spid_ui.index');

?>
