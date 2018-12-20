<?php
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';


//Zend_Loader::registerAutoload();

$GLOBALS['version_contact']="Contact1.1";


/*$db = new Zend_Db_Adapter_Pdo_Mysql(array (
				 'host'     => 'localhost',
                 'username' => 'lea',
                 'password' => '123456',
                 'dbname'   => 'extranet'
				 ));
*/
$db = new Zend_Db_Adapter_Pdo_Mysql(array (
				 'host'     => 'localhost',
                        'username' => 'egw_apsie',
                        'password' => 'APS12/APS12',
                        'dbname' => 'egw_apsie143',
                        'charset' => 'utf8'
				 ));

 $GLOBALS['db'] = $db;

?>