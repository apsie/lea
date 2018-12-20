<?php
require_once '../Zend/Db/Adapter/Pdo/Mysql.php';


//Zend_Loader::registerAutoload();

$GLOBALS['version_contact']="Contact1_1";


$db = new Zend_Db_Adapter_Pdo_Mysql(array (
	'host'     => 'localhost',
	'username' => 'egw_apsie',
	'password' => 'APS12/APS12',
	'dbname'   => 'egw_apsie143'
 ));

 $GLOBALS['db'] = $db;
/*$db = new Zend_Db_Adapter_Pdo_Mysql(array (
				 'host'     => 'localhost',
                 'username' => 'leauser',
                 'password' => 'Tim.01Egwv1',
                 'dbname'   => 'extranet'
				 ));*/
?>
