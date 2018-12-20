<?php
session_start();
ini_set('display_errors', 0);
require("inc/class.epce.inc.php");


$an = date('y');
//récupération des variables
$epce = new epce("$an");
$epce->cat_id_owner=$_SESSION['id'];
/* echo $_POST['n_prefix'] .'<br/>' . $_POST['n_given'] .'<br/>'. $_POST['n_middle'] .'<br/>'. $_POST['n_family'] .'<br/>'. $_POST['n_suffix'] .'<br/>'. $_POST['cat_id'] .'<br/>'. $_POST['private'] .'<br/>'. $_POST['tel_work'] .'<br/>'. $_POST['tel_home'] .'<br/>'. $_POST['tel_cell'] .'<br/>'. $_POST['url'] .'<br/>'. $_POST['email'] .'<br/>'. $_POST['email_home'] .'<br/>'. $_POST['org_name'] .'<br/>'. $_POST['org_unit'] .'<br/>'. $_POST['title'] .'<br/>'. $_POST['adr_one_street'] .'<br/>'. $_POST['adr_one_locality'] .'<br/>'. $_POST['adr_one_region'] .'<br/>'. $_POST['adr_one_postalcode'] .'<br/>'. $_POST['adr_one_countryname'] .'<br/>'. $_POST['adr_one_type'] .'<br/>'. $_POST['adr_two_street'] .'<br/>'. $_POST['adr_two_locality'] .'<br/>'. $_POST['adr_two_region'] .'<br/>'. $_POST['adr_two_postalcode'] .'<br/>'. $_POST['adr_two_countryname'] .'<br/>'. $_POST['adr_two_type'] .'<br/>';
*/

//beneficiaire
//$opt=$_POST['opt'];
$nb=$_POST['nb'];

$n_prefix=$_POST['n_prefix'];
$n_given=$_POST['n_given'];
$n_middle=$_POST['n_middle'];
$n_family=$_POST['n_family'];
$n_suffix=$_POST['n_suffix'];
$cat_id=$_POST['cat_id'];
$private=$_POST['private'];
$tel_work=$_POST['tel_work'];
$tel_home=$_POST['tel_home'];
$tel_cell=$_POST['tel_cell'];
$url= $_POST['url'];
$email=$_POST['email'];
$email_home=$_POST['email_home'];
$org_name=$_POST['org_name'];
$org_unit=$_POST['org_unit'];
$title=$_POST['title'];
$adr_one_street=$_POST['adr_one_street'];
$adr_one_locality=$_POST['adr_one_locality'];
$adr_one_region=$_POST['adr_one_region'];
$adr_one_postalcode=$_POST['adr_one_postalcode'];
$adr_one_countryname=$_POST['adr_one_countryname'];
$adr_one_type=$_POST['adr_one_type'];
$adr_two_street=$_POST['adr_two_street'];
$adr_two_locality=$_POST['adr_two_locality'];
$adr_two_region=$_POST['adr_two_region'];
$adr_two_postalcode=$_POST['adr_two_postalcode'] ;
$adr_two_countryname=$_POST['adr_two_countryname'];
$adr_two_type=$_POST['adr_two_type'];


$n_prefix=utf8_decode($n_prefix);
$n_given=utf8_decode($n_given);
$n_middle=utf8_decode($n_middle);
$n_family=utf8_decode($n_family);
$n_suffix=utf8_decode($n_suffix);
$cat_id=utf8_decode($cat_id);
$private=utf8_decode($private);
$tel_work=utf8_decode($tel_work);
$tel_home=utf8_decode($tel_home);
$tel_cell=utf8_decode($tel_cell);
$url=utf8_decode($url);
$email=utf8_decode($email);
$email_home=utf8_decode($email_home);
$org_name=utf8_decode($org_name);
$org_unit=utf8_decode($org_unit);
$title=utf8_decode($title);
$adr_one_street=utf8_decode($adr_one_street);
$adr_one_locality=utf8_decode($adr_one_locality);
$adr_one_region=utf8_decode($adr_one_region);
$adr_one_postalcode=utf8_decode($adr_one_postalcode);
$adr_one_countryname=utf8_decode($adr_one_countryname);
$adr_one_type=utf8_decode($adr_one_type);
$adr_two_street=utf8_decode($adr_two_street);
$adr_two_locality=utf8_decode($adr_two_locality);
$adr_two_region=utf8_decode($adr_two_region);
$adr_two_postalcode=utf8_decode($adr_two_postalcode) ;
$adr_two_countryname=utf8_decode($adr_two_countryname);
$adr_two_type=utf8_decode($adr_two_type);
$fn= $n_prefix.' '.$n_given.' '.$n_family.' '.$n_suffix;


//prescripteur
$id=$_POST['id'];
$n_prefix_=$_POST['n_prefix_'];
$n_given_=$_POST['n_given_'];
$n_middle_=$_POST['n_middle_'];
$n_family_=$_POST['n_family_'];
$n_suffix_=$_POST['n_suffix_'];
$cat_id_=$_POST['cat_id_'];
$private_=$_POST['private_'];
$tel_work_=$_POST['tel_work_'];
$tel_home_=$_POST['tel_home_'];
$tel_cell_=$_POST['tel_cell_'];
$tel_isdn_=$_POST['tel_isdn_'];
$url_= $_POST['url_'];
$email_=$_POST['email_'];
$email_home_=$_POST['email_home_'];
$org_name_=$_POST['org_name_'];
$org_unit_=$_POST['org_unit_'];
$title_=$_POST['title_'];
$adr_one_street_=$_POST['adr_one_street_'];
$adr_one_locality_=$_POST['adr_one_locality_'];
$adr_one_region_=$_POST['adr_one_region_'];
$adr_one_postalcode_=$_POST['adr_one_postalcode_'];
$adr_one_countryname_=$_POST['adr_one_countryname_'];
$adr_one_type_=$_POST['adr_one_type_'];
$adr_two_street_=$_POST['adr_two_street_'];
$adr_two_locality_=$_POST['adr_two_locality_'];
$adr_two_region_=$_POST['adr_two_region_'];
$adr_two_postalcode_=$_POST['adr_two_postalcode_'] ;
$adr_two_countryname_=$_POST['adr_two_countryname_'];
$adr_two_type_=$_POST['adr_two_type_'];

$n_family_ =utf8_decode($n_family_);
$n_prefix_=utf8_decode($n_prefix_);
$n_given_=utf8_decode($n_given_);
$n_middle_=utf8_decode($n_middle_);
$n_family_=utf8_decode($n_family_);
$n_suffix_=utf8_decode($n_suffix_);
$cat_id_=utf8_decode($cat_id_);
$private_=utf8_decode($private_);
$tel_work_=utf8_decode($tel_work_);
$tel_home_=utf8_decode($tel_home_);
$tel_isdn_=utf8_decode($tel_isdn_);
$tel_cell_=utf8_decode($tel_cell_);
$url_=utf8_decode($url_);
$email_=utf8_decode($email_);
$email_home_=utf8_decode($email_home_);
$org_name_=utf8_decode($org_name_);
$org_unit_=utf8_decode($org_unit_);
$title_=utf8_decode($title_);
$adr_one_street_=utf8_decode($adr_one_street_);
$adr_one_locality_=utf8_decode($adr_one_locality_);
$adr_one_region_=utf8_decode($adr_one_region_);
$adr_one_postalcode_=utf8_decode($adr_one_postalcode_);
$adr_one_countryname_=utf8_decode($adr_one_countryname_);
$adr_one_type_=utf8_decode($adr_one_type_);
$adr_two_street_=utf8_decode($adr_two_street_);
$adr_two_locality_=utf8_decode($adr_two_locality_);
$adr_two_region_=utf8_decode($adr_two_region_);
$adr_two_postalcode_=utf8_decode($adr_two_postalcode_) ;
$adr_two_countryname_=utf8_decode($adr_two_countryname_);
$adr_two_type_=utf8_decode($adr_two_type_);
$fn_= $n_prefix_.' '.$n_given_.' '.$n_family_.' '.$n_suffix_;

//employeur
$choix = $_POST['choix'];
$update_employeur=$_POST['update_employeur'];
$n_prefix_e=$_POST['n_prefix_e'];
$n_given_e=$_POST['n_given_e'];
$n_middle_e=$_POST['n_middle_e'];
$n_family_e=$_POST['n_family_e'];
$n_suffix_e=$_POST['n_suffix_e'];
$cat_id_e=$_POST['cat_id_e'];
$private_e=$_POST['private_e'];
$tel_work_e=$_POST['tel_work_e'];
$tel_home_e=$_POST['tel_home_e'];
$tel_cell_e=$_POST['tel_cell_e'];
$url_e= $_POST['url_e'];
$email_e=$_POST['email_e'];
$email_home_e=$_POST['email_home_e'];
$org_name_e=$_POST['org_name_e'];
$org_unit_e=$_POST['org_unit_e'];
$title_e=$_POST['title_e'];
$adr_one_street_e=$_POST['adr_one_street_e'];
$adr_one_locality_e=$_POST['adr_one_locality_e'];
$adr_one_region_e=$_POST['adr_one_region_e'];
$adr_one_postalcode_e=$_POST['adr_one_postalcode_e'];
$adr_one_countryname_e=$_POST['adr_one_countryname_e'];
$adr_one_type_e=$_POST['adr_one_type_e'];
/*$adr_two_street_=$_POST['adr_two_street_'];
$adr_two_locality_=$_POST['adr_two_locality_'];
$adr_two_region_=$_POST['adr_two_region_'];
$adr_two_postalcode_=$_POST['adr_two_postalcode_'] ;
$adr_two_countryname_=$_POST['adr_two_countryname_'];
$adr_two_type_=$_POST['adr_two_type_'];*/

$n_family_e =utf8_decode($n_family_e);
$n_prefix_e=utf8_decode($n_prefix_e);
$n_given_e=utf8_decode($n_given_e);
$n_middle_e=utf8_decode($n_middle_e);
$n_family_e=utf8_decode($n_family_e);
$n_suffix_e=utf8_decode($n_suffix_e);
$cat_id_e=utf8_decode($cat_id_e);
$private_e=utf8_decode($private_e);
$tel_work_e=utf8_decode($tel_work_e);
$tel_home_e=utf8_decode($tel_home_e);
$tel_cell_e=utf8_decode($tel_cell_e);
$url_e=utf8_decode($url_e);
$email_e=utf8_decode($email_e);
$email_home_e=utf8_decode($email_home_e);
$org_name_e=utf8_decode($org_name_e);
$org_unit_e=utf8_decode($org_unit_e);
$title_e=utf8_decode($title_e);
$adr_one_street_e=utf8_decode($adr_one_street_e);
$adr_one_locality_e=utf8_decode($adr_one_locality_e);
$adr_one_region_e=utf8_decode($adr_one_region_e);
$adr_one_postalcode_e=utf8_decode($adr_one_postalcode_e);
$adr_one_countryname_e=utf8_decode($adr_one_countryname_e);
$adr_one_type_e=utf8_decode($adr_one_type_e);
/*$adr_two_street_=utf8_decode($adr_two_street_);
$adr_two_locality_=utf8_decode($adr_two_locality_);
$adr_two_region_=utf8_decode($adr_two_region_);
$adr_two_postalcode_=utf8_decode($adr_two_postalcode_) ;
$adr_two_countryname_=utf8_decode($adr_two_countryname_);
$adr_two_type_=utf8_decode($adr_two_type_);*/
$fn_e= $n_prefix_e.' '.$n_given_e.' '.$n_family_e.' '.$n_suffix_e;

if($private==0)
{
	$private="public";
}
else
{
	$private="private";
}
if($private_==0)
{
	$private_="public";
}
else
{
	$private_="private";
}
if($private_e==0)
{
	$private_e="public";
}
else
{
	$private_e="private";
}


if($update_employeur==1 and $id!=NULL and $choix!=NULL)
{
	
	$epce->update_employeur($id,NULL,'n',''.$epce->cat_id_owner.'',$private_e,''.$epce->cat_id_beneficiaire.'',$fn_e,$n_family_e,$n_given_e,$n_middle_e,$n_prefix_e,$n_suffix_e,NULL,$bday_e,NULL,'0',NULL,$url_e,NULL,$org_name_e,$org_unit_e,$title_e,$adr_one_street_e,$adr_one_locality_e,$adr_one_region_e,$adr_one_postalcode_e,$adr_one_countryname_e,NULL,NULL,$adr_two_street_e,$adr_two_locality_e,$adr_two_region_e,$adr_two_postalcode_e,$adr_two_countryname_e,$adr_two_type_e,$tel_work_e,$tel_home_e,$tel_voice_e,$tel_fax_e,$tel_msg_e,$tel_cell_e,$tel_pager_e,$tel_bbs_e,$tel_modem_e,$tel_car_e,$tel_isdn_e,$tel_video_e,NULL,$email_e,'INTERNET',$email_home_e,'INTERNET',$last_mod_e);
header("Location: index.php?page=presentation&domain=default&categorie=".$epce->cat_id_beneficiaire."&choix=".$choix."");
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="index.php?page=presentation&domain=default&categorie='.$epce->cat_id_beneficiaire.'&choix='.$choix.'"
</SCRIPT>';
}

else
{

if($n_given!=NULL and $n_family!=NULL)
{


$a=$_POST['a'];
$m=$_POST['m'];
$d=$_POST['j'];

if($a!=NULL)
{
$age=$epce->age("$a","$m","$d");
}



$id_verif=$epce->verif_ben($n_family,$n_given);
if($id_verif!=NULL)
{
	header("Location: presentation/panel.php?choix=".$id_verif."&alert=existe");
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?choix='.$id_verif.'&alert=existe"
</SCRIPT>';}
else
{


$id_recup=$epce->inserer_beneficiaire(NULL,NULL,'n','8',$private,''.$epce->cat_id_beneficiaire.'',$fn,$n_family,$n_given,$n_middle,$n_prefix,$n_suffix,NULL,$_POST['j'].'/'.$_POST['m'].'/'.$_POST['a'],NULL,'0',$_POST['lieu_naissance'],$url,$age,$org_name,$org_unit,$title,$adr_one_street,$adr_one_locality,$adr_one_region,$adr_one_postalcode,$adr_one_countryname,NULL,$epce->texte_id($_POST['nationalite']),$adr_two_street,$adr_two_locality,$adr_two_region,$adr_two_postalcode,$adr_two_countryname,$epce->texte_id($_POST['indemnite_2']),$tel_work,$tel_home,$_POST['n_lettre'],$_POST['id_pole'],$_POST['enfant'],$tel_cell,$epce->texte_id($_POST['situation']),$epce->texte_id($_POST['situation_pro']),$epce->texte_id($_POST['caf']),$epce->texte_id($_POST['statut_1']),$tel_isdn,$epce->texte_id($_POST['statut_2']),$epce->texte_id($_POST['indemnite_1']),$email,'INTERNET',$email_home,'INTERNET',time(),$epce->texte_id($_POST['niveau_formation']),$_POST['intitule_formation'],$epce->texte_id($_POST['niveau_formation_projet']),$_POST['intitule_formation_projet'],'','','','','','','','');

if(isset($_POST['n_lettre']) and $_POST['n_lettre']!=NULL)
{
$epce->inserer_presta($id_recup,$n_family,$n_given,$_POST['n_lettre']);
}
}


/*if($_POST['lieu_naissance']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Lieu de naissance',$_POST['lieu_naissance']);
}
if($_POST['situation_maritale']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Situation maritale',$_POST['situation_maritale']);
}
if($_POST['enfants_charges']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Enfants à charges',$_POST['enfants_charges']);
}
if($_POST['nationalite']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Nationalité',$_POST['nationalite']);
}
if($_POST['situation_profesionnelle']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Situation professionnelle',$_POST['situation_professionnelle']);
}
if($_POST['statut1']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Statut 1',$_POST['statut1']);
}
if($_POST['statut2']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Statut 2',$_POST['statut2']);
}*/
/*if($_POST['id_pole']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Id Pole Emploi',$_POST['id_pole']);
}*/
/*if($_POST['date_inscription']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Anniversaire',$_POST['date_inscription']);
}*/
/*if($_POST['n_lettre']!=NULL)
{
$epce->inserer_beneficiaire_extra($id_recup,$epce->cat_id_owner,'Numero lettre de commande',$_POST['n_lettre']);
}
*/
if($_POST['opt']!=NULL)
{


$epce->link_beneficiaire_calendar($id_recup,$_POST['opt'],$nb,$n_given,$n_family);
$employee=$epce->selectionner_calendar_conseiller_id($_POST['opt']);
$cal=$epce->selectionner_cal_dates($_POST['opt']);
$id_projets=$epce->inserer_phpgw_p_projects("",date('Y').date('m').'_EPC93_'.$n_family.' '.$n_given,$owner,'public',$cal[0],$cal[0],$cal[0]+2592000,$employee,$customer,'active',$descr,$n_family.' '.$n_given,$budget,$category,$parent,'360',$date_created,$processor,date('Y').date('m').'_EPC93',$main,$level,$previous,$customer_nr,$reference,$url,$result,$test,$quality,$accounting,$acc_factor,$billable,$psdate,$pedate,'1',$discount,$e_budget,$inv_method,$acc_factor_d,$discount_type);
$activity_id=$epce->selectionner_activite_id('EPCRE 2010');
$epce->inserer_phpgw_p_hours($id, $employee, $id_projets, $activity_id, $cal[0],  $cal[0],  $cal[1], 'EPCE 1er rendez-vous : Entrée + Evaluation 1',  (($cal[1]-$cal[0])/60)+30, 'open', $hours_descr, 'o', '0', $pro_main, '', $km_distance, $t_journey, $cost_id);

}

header("Location: presentation/panel.php".$epce->cat_id_beneficiaire."&choix=".$id_recup."");
/*echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="index.php?page=presentation&domain=default&categorie='.$epce->cat_id_beneficiaire.'&choix='.$id_recup.'"
</SCRIPT>';*/
}
elseif($n_given==NULL and $n_family==NULL)
{
	
header("Location: presentation/panel.php&erreur=beneficiaire");
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php&erreur=beneficiaire"
</SCRIPT>';	
}



if($org_name_!=NULL)
{


$epce->inserer_beneficiaire(NULL,NULL,'n',''.$epce->cat_id_owner.'',$private_,''.$epce->cat_id_prescripteur.'',$fn_,$n_family_,$n_given_,$n_middle_,$n_prefix_,$n_suffix_,NULL,$bday_,NULL,'0',NULL,$url_,NULL,$org_name_,$org_unit_,$title_,$adr_one_street_,$adr_one_locality_,$adr_one_region_,$adr_one_postalcode_,$adr_one_countryname_,NULL,NULL,$adr_two_street_,$adr_two_locality_,$adr_two_region_,$adr_two_postalcode_,$adr_two_countryname_,$adr_two_type_,$tel_work_,$tel_home_,$tel_voice_,$tel_fax_,$tel_msg_,$tel_cell_,$tel_pager_,$tel_bbs_,$tel_modem_,$tel_car_,$tel_isdn_,$tel_video_,NULL,$email_,'INTERNET',$email_home_,'INTERNET',$last_mod_,'','','','','','','','','','','','');

$epce->link_beneficiaire_prescripteur($id,$epce->cat_id_beneficiaire,$epce->cat_id_prescripteur);
header("Location:presentation/presentation/panel.php?categorie=".$epce->cat_id_beneficiaire."&choix=".$id.""); 
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?categorie='.$epce->cat_id_beneficiaire.'&choix='.$id.'"
</SCRIPT>';
}
if($org_name_e!=NULL)
{


	$epce->inserer_beneficiaire(NULL,NULL,'n',''.$epce->cat_id_owner.'',$private_e,''.$epce->cat_id_employeur.'',$fn_e,$n_family_e,$n_given_e,$n_middle_e,$n_prefix_e,$n_suffix_e,NULL,$bday_e,NULL,'0',NULL,$url_e,NULL,$org_name_e,$org_unit_e,$title_e,$adr_one_street_e,$adr_one_locality_e,$adr_one_region_e,$adr_one_postalcode_e,$adr_one_countryname_e,NULL,NULL,$adr_two_street_e,$adr_two_locality_e,$adr_two_region_e,$adr_two_postalcode_e,$adr_two_countryname_e,$adr_two_type_e,$tel_work_e,$tel_home_e,$tel_voice_e,$tel_fax_e,$tel_msg_e,$tel_cell_e,$tel_pager_e,$tel_bbs_e,$tel_modem_e,$tel_car_e,$tel_isdn_e,$tel_video_e,NULL,$email_e,'INTERNET',$email_home_e,'INTERNET',$last_mod_e,'','','','',$_POST['j_e'].'/'.$_POST['m_e'].'/'.$_POST['a_e'],$_POST['j_e_'].'/'.$_POST['m_e_'].'/'.$_POST['a_e_'],$_POST['poste'],$epce->texte_id($_POST['qualification']),$epce->texte_id($_POST['contrat']),$epce->texte_id($_POST['contrat_aide']),'','');
	$epce->link_beneficiaire_employeur($id,$epce->cat_id_beneficiaire,$epce->cat_id_employeur);
	header("Location: presentation/panel.php?categorie=".$epce->cat_id_beneficiaire."&choix=".$id."");
	echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?categorie='.$epce->cat_id_beneficiaire.'&choix='.$id.'"
</SCRIPT>';
}

}
?>
