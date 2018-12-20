<?php
/* 
 * apsieben 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * T�l : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propri�t� de Spirea
 * 
 * Logiciel Apsieben - Module permettant la liaison de beneficaire en tant que participant � des �v�nements de calendrier ou en lien avec toute autre application
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'apsieben',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);
	
include('../header.inc.php');

// check if we have an advanced search and reset it in case
$old_state = $GLOBALS['egw']->session->appsession('index','apsieben');

if ($old_state['advanced_search'])
{
	unset($old_state['advanced_search']);
	$GLOBALS['egw']->session->appsession('index','apsieben',$old_state);
}

	
$GLOBALS['egw']->redirect_link('/index.php','menuaction=apsieben.apsieben_ui.index');

?>
