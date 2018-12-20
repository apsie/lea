<?php 
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/template.js');
$view->headScript()->appendFile('./js/class/calendrier.js');
$view->headScript()->appendFile('./js/class/option.js');

// Récupération des informations d'une prestation
if(isset($_REQUEST['id_presta']))
{
$_SESSION['TEMPS_ID_PRESTA'] = $_REQUEST['id_presta'];
$_SESSION['TEMPS_ID_CONTACT'] = $_REQUEST['id_contact'];

if($_REQUEST['retour']==1)
$retour = "window.history.back()";
else
$retour = "window.location.href='./presta/epce/evaluation/plan.php?&id_presta=".$_REQUEST['id_presta']."&choix=".$_REQUEST['id_contact']."'";

$view->retour ='<div> <button onclick="'.$retour.'" >Retour à la page précédente</button></div>';
$view->temp_id_presta=' <div id="temp_id_presta" >
 Pose de rendez vous lier à l\'ID_PRESTA : <span style="color:red" >'.$_REQUEST['id_presta'].'</span> <img onclick="Calendrier.deleteSessionIdPresta()"  style="cursor:pointer"  src="./images/ico/croix.png" /> </div>';
$view->presta = prestation::getPrestationByIdPresta($_REQUEST['id_presta']);
}
else
{
unset($_SESSION['TEMPS_ID_PRESTA']);
unset($_SESSION['TEMPS_ID_CONTACT']);
$view->temp_id_presta='';
$view->retour="";
}

if(isset($_REQUEST['id_contact']))
$view->contact = contact::get_contactv2($_REQUEST['id_contact']);




?>