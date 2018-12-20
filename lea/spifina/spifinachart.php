<?php
/* spifina : spifina
SPIREA - Janvier 2013
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaQual - 

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/

$GLOBALS['egw_info'] = array(
	'flags' => array(
		'currentapp'	=> 'spifina',
		'noheader'		=> True,
		'nonavbar'		=> True
));
include('../header.inc.php');

$tmp = $GLOBALS['egw_info']['server']['temp_dir'];
if (!$tmp || !is_dir($tmp) || !is_writable($tmp))
{
	@unlink($tmp = tempnam('','test'));	// get the systems temp-dir
	$tmp = dirname($tmp);
}

if (isset($_GET['img']) && is_readable($spifinachart = $tmp.'/'.basename($_GET['img'])))
{
	header('Content-type: image/png');
	readfile($spifinachart);
	@unlink($spifinachart);
}
else
{
	ExecMethod('spifina.stats_charts_ui.create');
}
common::egw_exit();