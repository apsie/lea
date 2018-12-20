<?php
global $conn;
$calendar = new calendar();
$p_database = new _database($conn);

header('Content-type:text/javascript;charset=UTF-8');
$method = $_REQUEST["method"];
$view->method = $method;
switch ($method) {
    case "add":
        $ret = $calendar->addCalendar($_GET["CalendarStartTime"], $_GET["CalendarEndTime"], $_GET["CalendarTitle"], $_GET["IsAllDayEvent"],$_GET["Description"],
        $_GET["id_lieu"],$_GET["id_referent"],$_GET["id_cal_cat"],$_GET["statut_cal"],$_GET["id_type_evenement"],$_GET["id_prestataire"],1,$_SESSION['TEMPS_ID_PRESTA']);
       // unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
        echo json_encode($ret); 
        break;
    case "del":
        $calendar->del($_GET["idCal"]);
        break;
    case "list":
        $ret = $calendar->listCalendar($_POST["showdate"], $_POST["viewtype"],$_POST["accountId"]);
        unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
        echo json_encode($ret); 
        break;
    case "update":
        $ret = $calendar->updateCalendar($_GET["CalendarStartTime"], $_GET["CalendarEndTime"], $_GET["CalendarTitle"], $_GET["IsAllDayEvent"],$_GET["Description"],
        $_GET["id_lieu"],$_GET["id_referent"],$_GET["id_cal_cat"],$_GET["statut_cal"],$_GET["idCal"],$_GET["id_type_evenement"],$_GET["id_prestataire"]);
        unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
        echo json_encode($ret); 
        break; 
    case "remove":
        $ret = $calendar->removeCalendar( $_POST["calendarId"]);
        unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
        echo json_encode($ret); 
        break;
    case "adddetails":
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"])){
            $ret = $calendar->updateDetailedCalendar($_GET["id"], $st, $et, 
                $_POST["Subject"], isset($_POST["IsAllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }
        echo json_encode($ret); 
        break;
    case "recherche":
    	$ret = $calendar->getResultatRecherche($_GET['mot']);   
    	
    	for($i=0;$i<count($ret);$i++)
    	{
    		$ret[$i]['Subject'] = utf8_encode($ret[$i]['Subject']);
    		$ret[$i]['Description'] = utf8_encode($ret[$i]['Description']);
    	} 
    	echo json_encode($ret); 
        break; 
    case "dispo":

		$ret = $calendar->chercher_options($_GET['date_start'],$_GET['selection'],$_GET['plage1'],$_GET['plage2'],$_GET['duree'],$_GET['conseiller_id'],$_GET['lieu'],$_GET['nom_lieu'],$_GET['nombre'],$_GET['jours']);
echo json_encode($ret); 
break;
   case "confirm":

		$ret = $calendar->liste_confirmation_option($_GET['nom_lieu'], $_GET['date_start'], $_GET['conseiller_id']);
echo json_encode($ret); 
break;
case "lierCalContact":
	//$_SESSION['TEMPS']['LINK']['PARTICIPANT'][] = array('ID'=>$_GET['id_contact'],'PRENOM'=>$_GET['prenom_contact'],'NOM'=>$_GET['nom_contact'],'TYPE'=>"contact");

	//$ret = $_SESSION['TEMPS']['LINK']['PARTICIPANT'];
	$bind = array('cal_id'=>$_REQUEST['cal_id'],'id_contact'=>$_REQUEST['id_contact'],'cal_status'=>'P');
	
	if($_SESSION['TEMPS_ID_PRESTA']!='' && isset($_SESSION['TEMPS_ID_PRESTA']))
	$bind['id_presta'] = $_SESSION['TEMPS_ID_PRESTA'];
	
	$calendar->lier($bind, 'apsie_cal_contact');
//echo json_encode($ret); 
break;
case "quickLinkContact":
	
	$bind = array('cal_id'=>$_REQUEST['cal_id'],'id_contact'=>$_SESSION['TEMPS_ID_CONTACT'],'cal_status'=>'P','id_presta'=>$_SESSION['TEMPS_ID_PRESTA']);
	$calendar->lier($bind, 'apsie_cal_contact');
//echo json_encode($ret); 
break;
case "lierCalReferent":
	
	/*if($_GET['prenom_referent']=="" || $_GET['nom_referent']=="")
	{
		$user = new utilisateur();
		$data = $user->getUtilisateurById($_GET['id_referent']);
		$_GET['prenom_referent'] =$data['account_firstname'];
		$_GET['nom_referent'] =$data['account_lastname'];
	}
	$_SESSION['TEMPS']['LINK']['PARTICIPANT'][] = array('ID'=>$_GET['id_referent'],'PRENOM'=>$_GET['prenom_referent'],'NOM'=>$_GET['nom_referent'],'TYPE'=>"compte");

	$ret = $_SESSION['TEMPS']['LINK']['PARTICIPANT'];*/
	
	
	$bind['cal_id']=$_REQUEST['cal_id'];
  	$bind['cal_user_id']=$_REQUEST['id_referent'];
  	$bind['cal_user_type']='u';
  	$bind['cal_status']="P";
  	$bind['cal_quantity']=1;
  	$bind['cal_recur_date']=0;
	$calendar->lier($bind, 'egw_cal_user'); 
break;

case "deleteParticipant":
	
	$calendar->deleteParticipant($_GET['id_participant'],$_GET['type']);
	for($i=0;$i<count($_SESSION['TEMPS']['LINK']['PARTICIPANT']);$i++)
	{
	if($_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['ID']== $_GET['id_participant'])
	{
		unset($_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]);
	}
	}
	$ret = $_SESSION['TEMPS']['LINK']['PARTICIPANT'];
echo json_encode($ret); 
break;
case "getParticipants":
	
	unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
	$retContact = $p_database->getParticipantsContact($_GET['idCal']);
	$retComptes = $p_database->getParticipantsComptes($_GET['idCal']);
	
	for($i=0;$i<count($retContact);$i++)
	{
		$_SESSION['TEMPS']['LINK']['PARTICIPANT'][] = array('ID'=>$retContact[$i]['id_ben'],'PRENOM'=>$retContact[$i]['prenom'],'NOM'=>$retContact[$i]['nom'],'TYPE'=>"contact");
	}
for($i=0;$i<count($retComptes);$i++)
	{
		$_SESSION['TEMPS']['LINK']['PARTICIPANT'][] = array('ID'=>$retComptes[$i]['account_id'],'PRENOM'=>$retComptes[$i]['account_firstname'],'NOM'=>$retComptes[$i]['account_lastname'],'TYPE'=>"compte");
	}

	$data = (array('DATA_COMPTES'=>$retComptes,'DATA_CONTACT'=>$retContact)); 
	$view->data = $data;
	$view->cal_id = $_GET['idCal'];
	
	echo $view->render('ajaxCalendrier.phtml');
	
break;
case "SESSION_DELETE_PARTICIPANT":
	unset($_SESSION['TEMPS']['LINK']['PARTICIPANT']);


echo json_encode(); 
break;
    case "option":


$date_choisi=explode('/',$_GET['date_choisi']);
$presta=explode('-',$_GET['prestation']);
$titre=$date_choisi[2].$date_choisi[1].'_'.$presta[1].'_Option_'.$_GET['nom_lieu'];

	for ($i=0;$i<count($_GET['pose']);$i++)

{

$lapose[$i] = $_GET['pose'][$i];
$dates=explode('-',$lapose[$i]);


$calendar->addCalendar($dates[0], $dates[1], $titre, 0,"",$_GET['lieu'],$_GET['conseiller_id'],$presta[0],"P",1,1,0);

}


        
header('Location: index.php?page=Calendrier');
  break;
    case "deleteSessionIdPresta":
    unset($_SESSION['TEMPS_ID_PRESTA']);
    echo json_encode(true);
    break;
    
    case "setStatusContact":
    
    	if($_REQUEST['cal_status']!=null)
    	$bind = array('cal_status' 	=>	$_REQUEST['cal_status']);
    	
    	if($_REQUEST['motif_absence']!=null)
    	$bind = array('motif_absence' => 	$_REQUEST['motif_absence']);
    	
    	
  		$calendar->updateCalContact($_REQUEST['cal_id'],$_REQUEST['id_contact'],$bind);
    break;
	
}




?>