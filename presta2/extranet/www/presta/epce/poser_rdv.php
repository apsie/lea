<?php
include("inc/class.epce.inc.php");


$epce = new epce(date('Y'));

/*if($_GET['prestation']=="EPCE" and ($_GET['lieu']=="Creteil" or $_GET['lieu']=="Champigny" or $_GET['lieu']=="Saint-Maur"))
{
$presta="EPC94";
}
else if($_GET['prestation']=="EPCE")
{
$presta="EPC93";
}
else
{*/
$presta = explode(";",$_GET['prestation']);
//}
for ($i=0;$i<count($_GET['pose']);$i++)
{
	
$date_choisi=explode('/',$_GET['date_choisi'][$i]);
$titre=$date_choisi[2].$date_choisi[1].'_'.$presta[0].'_'.$_GET['name'];
$dates=explode('-',$_GET['pose'][$i]);
$id=$epce->inserer_cal($titre,$_GET['lieu'],$_SESSION['id'],$_GET['conseiller_id'],$presta[1],$dates[0],$dates[1],$_GET['id_presta']);
//$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);
//$epce->link_rdv($_GET['choix'],$id);

}


	
/*if(isset($_GET['pose0']))
			   {
$date_choisi=explode('/',$_GET['date_choisi0']);
$titre=$date_choisi[2].$date_choisi[1].'_'.$_GET['prestation'].'_'.$_GET['name'];
$dates=explode('-',$_GET['pose0']);
$id=$epce->inserer_cal($titre,$_GET['lieu'],$_SESSION['id'],$_GET['conseiller_id']);
$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);
$epce->link_rdv($_GET['choix'],$id);
			   }
			   if(isset($_GET['pose1']))
			   {
				   $date_choisi=explode('/',$_GET['date_choisi1']);
$titre=$date_choisi[2].$date_choisi[1].'_'.$_GET['prestation'].'_'.$_GET['name'];
$dates=explode('-',$_GET['pose1']);
$id=$epce->inserer_cal($titre,$_GET['lieu'],$_SESSION['id'],$_GET['conseiller_id']);
$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);
$epce->link_rdv($_GET['choix'],$id);
			   }
			   if(isset($_GET['pose2']))
			   {
			
				   $date_choisi=explode('/',$_GET['date_choisi2']);
$titre=$date_choisi[2].$date_choisi[1].'_'.$_GET['prestation'].'_'.$_GET['name'];
$dates=explode('-',$_GET['pose2']);
$id=$epce->inserer_cal($titre,$_GET['lieu'],$_SESSION['id'],$_GET['conseiller_id']);
$epce->inserer_cal_dates($id,$dates[0],$dates[1]);
$epce->inserer_cal_user($id,$_GET['conseiller_id']);
$epce->link_rdv($_GET['choix'],$id);
			   }*/








echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'&display_eval=block"</SCRIPT>';


?>