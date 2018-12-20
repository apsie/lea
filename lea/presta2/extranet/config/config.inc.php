<?php



define ('DIR_ROOT' , dirname(dirname(__FILE__)));
ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.
						DIR_ROOT.'/library'.PATH_SEPARATOR.
//						DIR_ROOT.'../application/models'.PATH_SEPARATOR.
						DIR_ROOT);




define("DEPLOY" , "prod");
						

//Active l'affichage des requètes
define("DEBUG_REQUEST",false);


//Initilisation de Zend_cache
// require_once 'Zend/Cache.php';
require_once '/var/www/clients/client1/web4/web/Classes/Zend/Cache.php';
include "/var/www/clients/client1/web4/web/Classes/Zend/Loader.php";
//include "Zend/Loader.php";
Zend_Loader::registerAutoload();

// ini_set('mbstring.func_overload',0);
include ("PHPExcel/IOFactory.php");

include ("../modules/dbconnect.php");


$registry = Zend_Registry::getInstance();



//Déclaration des tables.
include ("../application/models/Database.php");
include ("../application/models/utilisateur.php");
include ("../application/models/groupe.php");
include ("../application/models/prestataire.php");
include ("../application/models/user_securise2.class.php");
include ("../application/models/outils.php");
include ("../application/models/categorie.php");
include ("../application/models/contact.php");
include ("../application/models/calendar.php");
include ("../application/models/prestation.php");
include ("../application/models/Xls.php");
include ("../application/models/calendrier.php");
include ("../application/models/organisation.php");
include ("../application/models/evenement.php");
include ("../application/models/dispositif.php");
include ("../application/models/projet.php");
include ("../application/models/texte.php");
include ("../application/models/compte_rendu.php");
include ("../application/models/presta_data.php");
include ("../application/models/download.php");
/*
define("CATID_CONTACT",259);
define("CATID_ORG",272);
*/
//Gestion de Zend_View
require_once ('Zend/View.php');
$view = new Zend_View();
//Initilisation répertoire des templates ( on peut en avoir plusieur via addScriptPath )
$view->setScriptPath('../application/views');
$view->addScriptPath('../application/views/modules');
$view->addScriptPath('../application/views/prestations');
//Initialisation des Meta
$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');


switch(DEPLOY)
{
	case "dev":
		define("URL_PRESTA","http://".$_SERVER['REMOTE_ADDR']."/presta/epce");
		break;
	case "preprod":
		define("URL_PRESTA","http://karudev.fr/presta/epce");
		break;
	case "prod":
		define("URL_PRESTA","https://lea.apsie.org/presta/epce");
		break;
		

}



$p_user = new _user($conn);
$p_database = new _database($conn);
//$p_application = new _application($backendOptions);



#Gestion du post pour ce délogger
if(isset($_REQUEST['action']) &&  $_REQUEST['action'] == "logout" )
{
	
	$p_database->logAction(LOG_TYPEACTION_LOGOUT);
	
	$p_user->logout();
	
	header("Location: index.php");
}


#Gestion du post pour ce logger
$view->msg_erreur = "";
if (isset($_POST['action']) &&  $_POST['action'] == "login" ) {

	if(isset($_POST["login"]) && isset($_POST["pass"]))
	{
		$p_user->connect($_POST["login"],$_POST["pass"]);
		if( ! $p_user->isConnect())
		{
			$view->msg_erreur .= "login ou/et mot de passe invalide.";
		}else
		{
			$p_database = new _database($conn);
		//	$p_database->logAction(LOG_TYPEACTION_LOGIN);
		}

	}
}


//declaration des menu
$tab_pages = array(


	"ajax"=>array("nom"=>"ajax" , "showInMenu"=> false ),
	"ajaxAdmin"=>array("nom"=>"ajaxAdmin" , "showInMenu"=> false ),
	"ajaxContact"=>array("nom"=>"ajaxContact" , "showInMenu"=> false ),
	"ajaxCalendrier"=>array("nom"=>"ajaxCalendar" , "showInMenu"=> false ),
    "ajaxCalendrierv2"=>array("nom"=>"ajaxCalendrier" , "showInMenu"=> false ),
	"ajaxPresta"=>array("nom"=>"ajaxPresta" , "showInMenu"=> false ),
    "ajaxOrganisation"=>array("nom"=>"ajaxOrganisation" , "showInMenu"=> false ),
	"ajaxEvenement"=>array("nom"=>"ajaxEvenement" , "showInMenu"=> false ),
	"ajaxProjet"=>array("nom"=>"ajaxProjet" , "showInMenu"=> false ),
    "ajaxDispositif"=>array("nom"=>"ajaxDispositif" , "showInMenu"=> false ),
	"ajaxPrestaData"=>array("nom"=>"ajaxPrestaData" , "showInMenu"=> false ),
    "impression_compte_rendu"=>array("nom"=>"Impression Compte Rendu" , "showInMenu"=> false ),
	"xls"=>array("nom"=>"xls" , "showInMenu"=> false ),
	"Option"=>array("nom"=>"Option" , "showInMenu"=> false ),
	"rdvControl"=>array("nom"=>"rdvControl" , "showInMenu"=> false ),
	"download"=>array("nom"=>"download" , "showInMenu"=> false ),
	"opcrea"=>array("nom"=>"opcrea" , "showInMenu"=> false ),
	"oe"=>array("nom"=>"oe" , "showInMenu"=> false ),
"ajaxTexte"=>array("nom"=>"ajaxTexte" , "showInMenu"=> false ),



	
);
	

//Log type action
define("LOG_TYPEACTION_LOGIN",1);
define("LOG_TYPEACTION_LOGOUT",2);

define("SIRET_APSIE","44082666700030");

//key texte
define('KEY_PLAN_ACTION_ACTION',1);
define('KEY_PLAN_ACTION_OBJECTIF',2);
define('KEY_PLAN_ACTION_RESULTAT',3);
define('KEY_PLAN_ACTION_OBJECTIF_CONTRAT',4);
define('KEY_PLAN_ACTION_ASPECTS_MAITRISES',5);
define('KEY_PLAN_ACTION_ASPECTS_A_RETRAVAILLER',6);
define('KEY_BILAN_ACTION',7);
define('KEY_BILAN_OBJECTIF',8);
define('KEY_PERIODES_TRAVAILLEES_TYPE_CONTRAT',9);

?>
