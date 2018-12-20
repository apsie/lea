<?php


//le temps du cache n'est pas défini - voir http://framework.zend.com/manual/fr/zend.cache.frontends.html pour les différente options du frontEnd
$frontendOptions = array('automatic_serialization' => true ,'lifetime' => NULL);
$backendOptions  = array('cache_dir' => '../cacheDir' );
$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);



//Initilisation de Zend_db
//require_once 'Zend/Db.php';
	require_once 'Zend/Db/Table/Abstract.php';
//require_once '../application/models/Zend_Db_Adapter_Oracle_DbLink.php';


// pour permettre la mise en cache des structures des tables
Zend_Db_Table_Abstract::setDefaultMetadataCache($cache); 

switch(DEPLOY){
	
	case "dev" :
	
		define("DATABASE_TYPE",'PDO_MYSQL');
	

		$params = array(
			'username' => 'root',
			'password' => '',
			'dbname' => 'extranet',
			'charset' => 'utf8'
			 
			//'profiler' => true  // active le profileur ; mettre ï¿½ false pour dï¿½sactiver (valeur par dï¿½faut)
		);

	
		break;
		case "preprod" :
	
		define("DATABASE_TYPE",'PDO_MYSQL');
	

		$params = array(
			'username' => 'egw_apsie',
			'password' => 'APS12/APS12',
			'dbname' => 'egw_apsie18',
			'charset' => 'utf8'
			 
			//'profiler' => true  // active le profileur ; mettre ï¿½ false pour dï¿½sactiver (valeur par dï¿½faut)
		);
		case "prod" :
	
		define("DATABASE_TYPE",'PDO_MYSQL');
	

		$params = array(
			'username' => 'egw_apsie',
			'password' => 'APS12/APS12',
			'dbname' => 'egw_apsie18',
			'charset' => 'utf8'
			 
			//'profiler' => true  // active le profileur ; mettre ï¿½ false pour dï¿½sactiver (valeur par dï¿½faut)
		);

	
		break;
}
try {
	
	$conn = Zend_Db::factory(DATABASE_TYPE, $params);
	//$conn =new Zend_Db_Adapter_Oracle_DbLink($params);
	
    Zend_Db_Table_Abstract::setDefaultAdapter($conn);
    
} catch (Zend_Db_Adapter_Exception $e) {
	echo "error connect DB";
	echo $e->getMessage();
    // perhaps a failed login credential, or perhaps the RDBMS is not running
} catch (Zend_Exception $e) {
	echo "Error Zend Adapter";
	echo $e->getMessage();
    // perhaps factory() failed to load the specified Adapter class
}



// active le profileur ( identique a profiler => true  ):
$conn->getProfiler()->setEnabled(true);

$conn->setFetchMode(Zend_Db::FETCH_ASSOC);
$conn->query("SET NAMES 'latin1'");
if(DEBUG_REQUEST == true)
{
	$profileur = $conn->getProfiler(); 
	$profileur->setEnabled(true);
}



?>