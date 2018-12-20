<?php			
session_start();		
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors',0);
date_default_timezone_set('Europe/Paris');
setlocale(LC_CTYPE,'fr_FR.ISO-8859-1');
iconv_set_encoding('internal_encoding', 'UTF-8');
iconv_set_encoding('output_encoding', 'UTF-8');
iconv_set_encoding('input_encoding', 'UTF-8');
header('Content-Type: text/html; charset=UTF-8');

// mise en place des r�pertoires et chargement des classes
set_include_path('.'
    . PATH_SEPARATOR . '../library'
    . PATH_SEPARATOR . '../application/models/'
    . PATH_SEPARATOR . get_include_path());
//include "Zend/Loader.php";
//Zend_Loader::registerAutoload();
require_once "Zend/Loader/Autoloader.php";
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

// Chargement de la configuration
$config = new Zend_Config_Ini('../application/configs/config.ini', 'prod');
$registry = Zend_Registry::getInstance();
$registry->set('config', $config);

// Mise en place de la BDD
$db = Zend_Db::factory($config->db);
Zend_Db_Table::setDefaultAdapter($db);
Zend_Registry::set('dbAdapter', $db);
$GLOBALS['db'] = Zend_Registry::get('dbAdapter');

  

	if(isset($_GET['id_projet']))
	{
			$projet = new ProjetTb();//var_dump($projet->get_value($_GET['id_projet'],'')); die();
	$_SESSION['session']->projet = serialize($projet->get_value($_GET['id_projet'],''));
		 
	}


// setup controller
$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);
$frontController->setBaseUrl('/bp/public');
$frontController->setControllerDirectory('../application/controllers');
if(!isset($_GET['noTemplate']))
{
Zend_Layout::startMvc(array('layoutPath'=>'../application/layouts/scripts'));
}

 
 


// run!
$frontController->dispatch();
