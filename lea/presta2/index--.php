<?php


$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'presta2',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);
	
include('../header.inc.php');

// check if we have an advanced search and reset it in case
$old_state = $GLOBALS['egw']->session->appsession('index','presta2');

// _debug_array($GLOBALS['egw']);exit;
if ($old_state['advanced_search'])
{
	unset($old_state['advanced_search']);
	$GLOBALS['egw']->session->appsession('index','presta2',$old_state);
}
	
$GLOBALS['egw']->redirect_link('/index.php','menuaction=presta2.presta2_ui.index');

?>
