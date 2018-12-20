<?php


/* spirea - includes egroupware */
	$GLOBALS['egw_info']['flags'] = array(
			'currentapp' 	=> 'presta2',
			'noheader'   => True,
			'nonavbar'   => True,
			'include_xajax'	=> true,
	);
	if( ! isset($_GET['noTemplate']) || $_GET['noTemplate'] != "1" )
	{
		// spirea - tch - ylf
		$GLOBALS['egw_info'] = array(
			'flags' => array(
				'disable_Template_class' => True,		
				'noheader'   => False,
				'currentapp' => 'presta2',
				//'autocreate_session_callback' => 'sitemgr_get_site',
		));
	}	

	if($_GET['noHeader'] == "1"){
		$GLOBALS['egw_info']['flags']['noheader'] = True;
	}
	
	include_once('/data/html/egw_apsie_1.8/lea/header.inc.php');

// error_log($_GET['page']);
// fin spirea



ini_set('memory_limit','-1');
ini_alter('memory_limit','-1');
ini_set('max_execution_time','-1');
ini_alter('max_execution_time','-1');
set_time_limit(-1);
error_reporting  (E_ALL);
//ini_set('mbstring.internal_encoding', 'ISO-8859-1');
ini_set('display_errors',"off");
ini_set("magic_quotes_gpc", 0) ;



// header('Content-type: text/html; charset=UTF-8');
// echo "ici";
session_start();

//print_r($_SESSION['UTILISATEUR']);
$page_defaut = "Accueil";
include("../config/config.inc.php");
// ini_set('mbstring.func_overload',0); 


	
if(! $p_user->isConnect() )
{
	
	// Si on n'est pas deja identifiÃ©, on affiche le formulaire de login
	// initialisation du template global
	$view->page = "index_login";

}else{
	//Liste des applications
	//CALENDRIER
	$view->lieu = $p_database->getLieu();

	$view->utilisateurs =utilisateur::getUtilisateurs("A");
	$view->calCat = $p_database->getCalCat();
	$view->typeEvent = $p_database->getTypeEvenement();
	$view->prestataire = $p_database->getPrestataire();
	/*
	$categorie = new categorie();
	$view->listCategorie_org = $categorie->getCategories('organisation');*/
	$texte = new texte();
	$view->option_regime_fiscal = $texte->selectioinner_texte('regime_fiscal');
	$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
	$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
	$view->option_regime_tva = $texte->selectioinner_texte('regime_tva');
	$view->option_regime_imposition = $texte->selectioinner_texte('regime_imposition');
	$view->option_secteur_activite = $texte->selectioinner_texte('secteur_activite');
	$view->option_implantation = $texte->selectioinner_texte('implantation');
	$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
	$view->option_dirigeant = $texte->selectioinner_texte('dirigeant');
	$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');
	$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
	//$view->option_activite_principale = $texte->selectioinner_texte('activite_principale');
	$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');

	$_SESSION['APPLICATION']=$p_database->getListApplication(1);
	$utilisateur = new utilisateur();
	$group = new groupe();
	$arraydroit= $utilisateur->getListDroit($_SESSION['UTILISATEUR']['account_id']);
	$arraydroitGroup= $group->getListGroup($_SESSION['UTILISATEUR']['account_primary_group']);
	
	 if(count($arraydroitGroup)>count($arraydroit) )
	 {
	 	$max = count($arraydroitGroup);
	 }
	 else
	 {
		 $max = count($arraydroit);
	 }
	 $newArray = array();
	 for($i=0;$i<$max;$i++)
	 {
	 	
	 	if(isset($arraydroitGroup[$i]))
	 	{
	 	$newArray[] = $arraydroitGroup[$i];
	 	}
	 	if(isset($arraydroit[$i]) )
	 	{
	 	$newArray[] = $arraydroit[$i];
	 	}
	 }
	//$newArray = array_unique($newArray);
	//print_r($newArray);exit();
	 $_SESSION['DROIT'] = $newArray;
	// print_r($_SESSION['UTILISATEUR']);
	

	// SPIREA
	// $_SESSION['APPAFF'] = outils::getApplicationAafficher($_SESSION['APPLICATION'],$_SESSION['DROIT']);
	$_SESSION['APPAFF'] = $_SESSION['APPLICATION'];

	//session_destroy();


	
	for($i=0;$i<count($_SESSION['APPAFF']);$i++)
	{
		$tab_pages[$_SESSION['APPAFF'][$i]['app_name']] = $_SESSION['APPAFF'][$i]['app_name'];
	}
	
	//On rÃ©cupÃ¨re le tab_pages des $page auquel l'utilisateur a le droit
	//$view->tab_pages_user = $p_user->getUserTabPages($tab_pages);
	//dans revue de presse, tlm a le droit Ã  toutes les pages
	$view->tab_pages_user = $tab_pages;
	
	//On rÃ©cupÃ¨re la page demandÃ©
	
	if(isset($_GET['page2']))
	{
		$view->page = $_GET['page2'];
	}elseif(isset($_GET['page']))
	{
		$view->page = $_GET['page'] ;
	}else
	{
		
		$view->page = $page_defaut;
	}
	
	
	//On contrÃ´le si l'utilisateur a bien le droit Ã  la page qu'il demande
	// if($view->page != "erreur_login" && ! isset($view->tab_pages_user[$view->page])) 
	// { 
	// 	echo"<script>window.location.href='index.php?page=deco'</script>";
	// }
	
	//Si le erreur_login est demandÃ© et que l'utilisateur n'a le droit qu'a une seul page, on le redirige directement
	if($view->page == "erreur_login" && sizeof($view->tab_pages_user) == 1)
	{
		$tab = array_keys($view->tab_pages_user);
		$view->page=$tab[0];		
	}
}

//Initilisation HeadMeta ( voir http://framework.zend.com/manual/fr/zend.view.helpers.html ) chapitre 'L'aide de vue HeadLink' 
$view->headLink()->appendStylesheet('./style/general.css');
$view->headLink()->appendStylesheet('./style/style.css');
//$view->headLink()->appendStylesheet('./style/index_login.css');
$view->headLink()->appendStylesheet('./js/flexigrid/css/flexigrid/flexigrid.css');
$view->headLink()->appendStylesheet('./style/ui-lightness/jquery-ui-1.8.11.custom.css');
$view->headLink()->appendStylesheet('./style/calendar_css/dailog.css');
$view->headLink()->appendStylesheet('./style/calendar_css/calendar.css');
$view->headLink()->appendStylesheet('./style/calendar_css/dp.css');
$view->headLink()->appendStylesheet('./style/calendar_css/alert.css');
$view->headLink()->appendStylesheet('./style/calendar_css/main.css');
$view->headLink()->appendStylesheet('./style/jquery.gritter.css');		
		
					 
				 
//Initilisation HeadScript ( voir http://framework.zend.com/manual/fr/zend.view.helpers.html chapitre 'L'aide de vue HeadScript'

//$view->headScript()->appendFile('./js/prototype.js');

$view->headScript()->appendFile('./js/jquery.js');
$view->headScript()->appendFile('./js/drenault.js');
//$view->headScript()->appendFile('./js/function.js');
//$view->headScript()->appendFile('./js/jquery-ui-1.8.2.custom.min.js');
$view->headScript()->appendFile('./js/jquery-ui-1.8.13.custom.min.js');
$view->headScript()->appendFile('./js/datepicker_fr.js');
//$view->headScript()->appendFile('./js/common.js');
$view->headScript()->appendFile('./js/ajaxmanager.js');
$view->headScript()->appendFile('./js/jquery.form.js');
$view->headScript()->appendFile('./js/jquery.tablesorter.min.js');
$view->headScript()->appendFile('./js/jquery.metadata.js');
$view->headScript()->appendFile('./js/jquery.tablesorter.pager.js');
$view->headScript()->appendFile('./js/jquery.table.sorter.filter.js');
//$view->headScript()->appendFile('./js/liste_aide.js');
$view->headScript()->appendFile('./js/Plugins/Common.js');
$view->headScript()->appendFile('./js/Plugins/datepicker_lang_US.js');
//$view->headScript()->appendFile('./js/Plugins/jquery.datepicker.js');
$view->headScript()->appendFile('./js/Plugins/jquery.alert.js');
$view->headScript()->appendFile('./js/Plugins/jquery.ifrmdailog.js');
$view->headScript()->appendFile('./js/Plugins/wdCalendar_lang_US.js');
$view->headScript()->appendFile('./js/Plugins/jquery.calendar.js');
$view->headScript()->appendFile('./js/highcharts.js');
$view->headScript()->appendFile('./js/highcharts.src.js');
$view->headScript()->appendFile('./js/jquery.gritter.min.js');

$view->headScript()->appendFile('./js/flexigrid/flexigrid.js');
$view->headScript()->appendFile('./js/flexigrid/flexigrid.pack.js');
$view->headScript()->appendFile('./js/jquery.ezpz_tooltip.min.js');
			   
//Initilisation title ( en + de dans dbconnect.php )
/*if($view->page != "erreur_login")
{
	$view->headTitle($view->tab_pages_user[$view->page]['nom']);
}else
{
	$view->headTitle("erreur_login");
}*/
/* SÃ©pcifique */

// echo $view->page;
//On inclus la page PHP 

include($view->page.".php");


//La css de la page doit Ãªtre la plus prioritaire.
$view->headLink()->appendStylesheet('style/'.$view->page.'.css');
//$view->headScript()->appendFile('js/'.$view->page.'.js');

//On va afficher le template
//Si on est en ajax, on peut vouloir virer les header et footer

if( ! isset($_GET['noTemplate']) || $_GET['noTemplate'] != "1" )
{
	
	if(isset($_GET['header']) && $_GET['header'] == "0" )
	{
		echo $view->render($view->page .'.phtml');
	}else
	{
		//Global contient "$view->page .'.phtml'"
		echo $view->render('global.phtml');
	}
}
//Affiche toutes les requÃªte de l'application ' si profileur = true
/*if(DEBUG_REQUEST){
	$str = "";
	error_log("Debut=>".date("d/m/Y H:i:s"),3,"c:/aw3_log.txt");
	$size = $profileur ->getTotalNumQueries();
	for($i=0;$i<$size;$i++)
	{
		error_log("Y-m-d H:i:s=>".$profileur ->getQueryProfile($i)->getElapsedSecs() ." => ". 
						$profileur ->getQueryProfile($i)->getQuery()."\n\n",3,"c:/aw3_log.txt");
	
	}
	error_log("Fin=>".date("d/m/Y H:i:s")."\n",3,"c:/aw3_log.txt");
}
*/


//$calendrier = new calendrier();


//Fermeture connection
$conn->closeConnection();

//echo ecrire_temps($debut, "4")."sec.<br>"; 

?>