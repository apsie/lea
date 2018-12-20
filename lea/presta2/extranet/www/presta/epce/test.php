<?php 
// SPIREA
$_SESSION['id'] = $_REQUEST['conseiller_id'];


// session_start();

ini_set('display_errors', 1);

require("inc/class.epce.inc.php");

$an = date('y');
//r�cup�ration des variables
$epce = new epce("$an");
//$epce->cat_id_owner=13;
$date_debut=explode("/",$_POST['date_debut']);
$dat_debu=mktime($_POST['heure'],$_POST['min'],'0',$date_debut[1],$date_debut[0],$date_debut[2]);



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
$fn= $n_prefix.' '.$n_family.' '.$n_given.' '.$n_suffix;


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







$id_verif=$epce->verif_ben($n_family,$n_given);

if($id_verif!=NULL)
{
	$eligible_dispo=$epce->verif_dispositif($_POST['prestation'],$dat_debu);

if($eligible_dispo[0]!=NULL)
{

	$id_projet=$epce->selectionner_projet_ben($id_verif,$_SESSION['id'],$_SESSION['id'],$_POST['prestation'],$dat_debu,$n_family.' '.$n_given,'En cours',$_POST['description_projet']);
	
if(isset($_POST['nom_p']) and $_POST['nom_p']!=NULL and $_POST['code_safir']!=NULL)
{
$id_contact_prescripteur=$epce->return_contact_prescripteur($_SESSION['id'],$_POST['code_safir'],$_POST['nom_p'],$_POST['prenom_p'],$_POST['civilite_p'],$_POST['tel_bureau_p'],$_POST['tel_portable_p'],$_POST['email_bureau_p'],$_POST['email_domicile_p'],$_POST['fonction']);
}

$id_presta=$epce->inserer_presta($id_verif,$id_projet,$id_contact_prescripteur,$eligible_dispo[0],$_POST['conseiller_id'],$epce->texte_id($_POST['prestataire']),$n_family,$n_given,$_POST['n_lettre'],$_POST['prestation'],'Nouvelle',$dat_debu);
//$epce->inserer_beneficiaire_situation($_SESSION['id'],$id_verif,$_POST['statut'],'',$_POST['id_pole'],'');

if(isset($_POST['opt']) and $_POST['opt']==NULL)
{


$date_end = $dat_debu+ 3600;
$titre=$date_debut[2].$date_debut[1].'_'.$_POST['prestation'].'_'.$n_family.'_'.$n_given;

$_POST['opt']=$epce->inserer_cal($titre,$_POST['lieu'],'',$_POST['conseiller_id'],"",$dat_debu,$date_end);
//$epce->inserer_cal_dates($_POST['opt'],$dat_debu,$date_end);
$epce->inserer_cal_user($_POST['opt'],$_POST['conseiller_id']);

}

if(isset($_POST['opt']) and $_POST['opt']!=NULL)
{
$epce->link_beneficiaire_calendar($id_verif,$_POST['opt'],$nb,$n_given,$n_family,$tel_work,$tel_cell,$_POST['n_lettre'],$_POST['id_pole'],$_POST['nom_p'],$_POST['prenom_p'],$tel_home,$_POST['code_safir'],$_POST['tel_bureau_p'],$_POST['tel_portable_p'],$_POST['debut_date'],$id_presta,$_POST['prestation']);

}

}


	
	
		header("Location: presentation/panel.php?choix=".$id_verif."&alert=existe&lc=".$_POST['n_lettre']."");
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?choix='.$id_verif.'&alert=existe&lc='.$_POST['n_lettre'].'"
</SCRIPT>';


}

else
{

$eligible_dispo=$epce->verif_dispositif($_POST['prestation'],$dat_debu);

if($eligible_dispo[0]!=NULL)
{

$id_recup=$epce->inserer_beneficiaire($_SESSION['id'],$fn,$n_family,$n_given,$n_prefix,$n_middle,$n_suffix,$tel_home,$tel_cell,$email,$email_home);

$epce->inserer_beneficiaire_etat_civil($_SESSION['id'],$id_recup);
$id_projet=$epce->inserer_beneficiaire_projet($_SESSION['id'],$id_recup,$dat_debu,$_POST['prestation'],$n_family.' '.$n_given,$_POST['account_id'],'En cours','En attente de résultat',$_POST['description_projet']);

if(isset($_POST['code_safir']) and $_POST['code_safir']!=NULL)
{
$epce->inserer_beneficiaire_situation($_SESSION['id'],$id_recup,$_POST['statut'],'',$_POST['id_pole'],'',$epce->get_pole($_POST['code_safir'],$id_recup));
$id_contact_prescripteur=$epce->return_contact_prescripteur($_SESSION['id'],$_POST['code_safir'],$_POST['nom_p'],$_POST['prenom_p'],$_POST['civilite_p'],$_POST['tel_bureau_p'],$_POST['tel_portable_p'],$_POST['email_bureau_p'],$_POST['email_domicile_p'],$_POST['fonction']);
}
$epce->inserer_resacc($id_recup,$_SESSION['id'],$_SESSION['id'],$id_projet,'...','','','','','','','','','','','','','','','','','','','','En cours');
$id_presta=$epce->inserer_presta($id_recup,$id_projet,$id_contact_prescripteur,$eligible_dispo[0],$_POST['conseiller_id'],$epce->texte_id($_POST['prestataire']),$n_family,$n_given,$_POST['n_lettre'],$_POST['prestation'],'Nouvelle',$dat_debu);

if(isset($_POST['opt']) and $_POST['opt']==NULL)
{


$date_end = $dat_debu+ 3600;
$titre=$date_debut[2].$date_debut[1].'_'.$_POST['prestation'].'_'.$n_family.'_'.$n_given;
$_POST['opt']=$epce->inserer_cal($titre,$_POST['lieu'],'',$_POST['conseiller_id'],"",$dat_debu,$date_end);
//$epce->update_cal_dates($_POST['opt'],$dat_debu,$date_end);
$epce->inserer_cal_user($_POST['opt'],$_POST['conseiller_id']);

}

if(isset($_POST['opt']) and $_POST['opt']!=NULL)
{
$epce->link_beneficiaire_calendar($id_recup,$_POST['opt'],$nb,$n_given,$n_family,$tel_work,$tel_cell,$_POST['n_lettre'],$_POST['id_pole'],$_POST['nom_p'],$_POST['prenom_p'],$tel_home,$_POST['code_safir'],$_POST['tel_bureau_p'],$_POST['tel_portable_p'],$_POST['debut_date'],$id_presta,$_POST['prestation']);

}
}




header('Location: presentation/panel.php?categorie='.$epce->cat_id_beneficiaire.'&choix='.$id_recup.'');
echo'<SCRIPT LANGUAGE="JavaScript">
     document.location.href="presentation/panel.php?categorie='.$epce->cat_id_beneficiaire.'&choix='.$id_recup.'"
</SCRIPT>';

}


?>
