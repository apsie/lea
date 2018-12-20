<?php

//$page=$_GET['page'];

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'Presta1_2',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.presta.inc.php");
	include("inc/class.presta_zend.inc.php");
	include("../../presta/inc/class.rapport_activite.inc.php");
	
	$presta = new presta();
	$presta_zend = new presta_zend();
	
	$rapport = new Rapport_activite($GLOBALS['egw_info']['user']['account_id']);
	

	if(isset($_GET['conseiller_id']))
	{
$conseiller_id=$_GET['conseiller_id'];
$GLOBALS['egw_info']['user']['account_id']=$conseiller_id;
/*if($_GET['conseiller_id']!=10)
{
	$GLOBALS['egw_info']['user']['account_lid']=NULL;
}*/
/*elseif($_GET['conseiller_id']!=10 or $_GET['conseiller_id']!=1033)
{
	$GLOBALS['egw_info']['user']['account_primary_group']=NULL;
}*/


	}
	else
	{
		$conseiller_id=$GLOBALS['egw_info']['user']['account_id'];
	}
	
	
	$rapport->action('consulte le tableau de bord des prestations');
	if(!isset($_GET['exercice']))
	{
	$_GET['exercice']=date('Y');
	}
	
	if($_GET['exercice']==2009)
	{
	$etat_2009="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2010)
	{
	$etat_2010="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2011)
	{
	$etat_2011="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2012)
	{
	$etat_2012="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2013)
	{
	$etat_2013="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2014)
	{
	$etat_2014="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']==2015)
	{
	$etat_2015="selected='selected'";
	
	$presta->exercice=$_GET['exercice'];
	}
	if($_GET['exercice']=="all")
	{
		$presta->exercice=$_GET['exercice'];
	$etat_all="selected='selected'";
	}
	
/*	
if($GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-3)
{
$nouvelle_id="";	
$nouvelle_oem94=$presta->epce_stats('Nouvelle',0,'OEM94');
$nouvelle_oem77=$presta->epce_stats('Nouvelle',0,'OEM77');
$nouvelle_tve77=$presta->epce_stats('Nouvelle',0,'TVE77');
$nouvelle_cap77=$presta->epce_stats('Nouvelle',0,'CAP77');
$nouvelle_bc=$presta->epce_stats('Nouvelle',0,'BC');
$nouvelle_vae=$presta->epce_stats('Nouvelle',0,'VAE');
$nouvelle_epi_bp=$presta->epce_stats('Nouvelle',0,'EPI_BP');
$nouvelle_opcre77=$presta->epce_stats('Nouvelle',0,'OPCRE77');
$nouvelle_nacre1=$presta->epce_stats('Nouvelle',0,'NACRE1');
$nouvelle_nacre3=$presta->epce_stats('Nouvelle',0,'NACRE3');
$nouvelle_pdi92=$presta->epce_stats('Nouvelle',0,'PDI92');
$nouvelle=$presta->epce_stats('Nouvelle',0,'EPCE');
$nouvelle_mca=$presta->epce_stats('Nouvelle',0,'MCA');

$cours_id="";	
$cours_oem94=$presta->epce_stats(‘En cours',0,'OEM94');
$cours_oem77=$presta->epce_stats(‘En cours',0,'OEM77');
$cours_tve77=$presta->epce_stats(‘En cours',0,'TVE77');
$cours_cap77=$presta->epce_stats(‘En cours',0,'CAP77');
$cours_bc=$presta->epce_stats(‘En cours',0,'BC');
$cours_vae=$presta->epce_stats(‘En cours',0,'VAE');
$cours_epi_bp=$presta->epce_stats(‘En cours',0,'EPI_BP');
$cours_opcre77=$presta->epce_stats(‘En cours',0,'OPCRE77');
$cours_nacre1=$presta->epce_stats(‘En cours',0,'NACRE1');
$cours_nacre3=$presta->epce_stats(‘En cours',0,'NACRE3');
$cours_pdi92=$presta->epce_stats(‘En cours',0,'PDI92');
$cours=$presta->epce_stats(‘En cours',0,'EPCE');
$cours_mca=$presta->epce_stats(‘En cours',0,'MCA');
	
$cloturer_id="";	
$cloturer_oem94=$presta->epce_stats(‘A cloturer',0,'OEM94');
$cloturer_oem77=$presta->epce_stats(‘A cloturer',0,'OEM77');
$cloturer_tve77=$presta->epce_stats(‘A cloturer',0,'TVE77');
$cloturer_cap77=$presta->epce_stats(‘A cloturer',0,'CAP77');
$cloturer_bc=$presta->epce_stats(‘A cloturer',0,'BC');
$cloturer_vae=$presta->epce_stats(‘A cloturer',0,'VAE');
$cloturer_epi_bp=$presta->epce_stats(‘A cloturer',0,'EPI_BP');
$cloturer_opcre77=$presta->epce_stats(‘A cloturer',0,'OPCRE77');
$cloturer_nacre1=$presta->epce_stats(‘A cloturer',0,'NACRE1');
$cloturer_nacre3=$presta->epce_stats(‘A cloturer',0,'NACRE3');
$cloturer_pdi92=$presta->epce_stats(‘A cloturer',0,'PDI92');
$cloturer=$presta->epce_stats(‘A cloturer',0,'EPCE');
$cloturer_mca=$presta->epce_stats(‘A cloturer',0,'MCA');
	
$cloture_id="";	
$cloture_oem94=$presta->epce_stats(‘Complete',0,'OEM94');
$cloture_oem77=$presta->epce_stats(‘Complete',0,'OEM77');
$cloture_tve77=$presta->epce_stats(‘Complete',0,'TVE77');
$cloture_cap77=$presta->epce_stats(‘Complete',0,'CAP77');
$cloture_bc=$presta->epce_stats(‘Complete',0,'BC');
$cloture_vae=$presta->epce_stats(‘Complete',0,'VAE');
$cloture_epi_bp=$presta->epce_stats(‘Complete',0,'EPI_BP');
$cloture_opcre77=$presta->epce_stats(‘Complete',0,'OPCRE77');
$cloture_nacre1=$presta->epce_stats(‘Complete',0,'NACRE1');
$cloture_nacre3=$presta->epce_stats(‘Complete',0,'NACRE3');
$cloture_pdi92=$presta->epce_stats(‘Complete',0,'PDI92');
$cloture=$presta->epce_stats(‘Complete',0,'EPCE');
$cloture_mca=$presta->epce_stats(‘Complete',0,'MCA');

$abandon_id="";	
$abandon_oem94=$presta->epce_stats(‘Abandon',0,'OEM94');
$abandon_oem77=$presta->epce_stats(‘Abandon',0,'OEM77');
$abandon_tve77=$presta->epce_stats(‘Abandon',0,'TVE77');
$abandon_cap77=$presta->epce_stats(‘Abandon',0,'CAP77');
$abandon_bc=$presta->epce_stats(‘Abandon',0,'BC');
$abandon_vae=$presta->epce_stats(‘Abandon',0,'VAE');
$abandon_epi_bp=$presta->epce_stats(‘Abandon',0,'EPI_BP');
$abandon_opcre77=$presta->epce_stats(‘Abandon',0,'OPCRE77');
$abandon_nacre1=$presta->epce_stats(‘Abandon',0,'NACRE1');
$abandon_nacre3=$presta->epce_stats(‘Abandon',0,'NACRE3');
$abandon_pdi92=$presta->epce_stats(‘Abandon',0,'PDI92');
$abandon=$presta->epce_stats(‘Abandon',0,'EPCE');
$abandon_mca=$presta->epce_stats(‘Abandon',0,'MCA');

$annulee_id="";	
$annulee_oem94=$presta->epce_stats(‘Annulee',0,'OEM94');
$annulee_oem77=$presta->epce_stats(‘Annulee',0,'OEM77');
$annulee_tve77=$presta->epce_stats(‘Annulee',0,'TVE77');
$annulee_cap77=$presta->epce_stats(‘Annulee',0,'CAP77');
$annulee_bc=$presta->epce_stats(‘Annulee',0,'BC');
$annulee_vae=$presta->epce_stats(‘Annulee',0,'VAE');
$annulee_epi_bp=$presta->epce_stats(‘Annulee',0,'EPI_BP');
$annulee_opcre77=$presta->epce_stats(‘Annulee',0,'OPCRE77');
$annulee_nacre1=$presta->epce_stats(‘Annulee',0,'NACRE1');
$annulee_nacre3=$presta->epce_stats(‘Annulee',0,'NACRE3');
$annulee_pdi92=$presta->epce_stats(‘Annulee',0,'PDI92');
$annulee=$presta->epce_stats(‘Annulee',0,'EPCE');
$annulee_mca=$presta->epce_stats(‘Annulee',0,'MCA');


$relance=$presta->epce_relance(0);
$relance_id="";

$total_oem94=$presta->epce_stats_total(0,'OEM94');
$total_oem77=$presta->epce_stats_total(0,'OEM77');
$total_tve77=$presta->epce_stats_total(0,'TVE77');
$total_cap77=$presta->epce_stats_total(0,'CAP77');
$total_bcf=$presta->epce_stats_total(0,'BCF');
$total_vae=$presta->epce_stats_total(0,'VAE');
$total_epi_bp=$presta->epce_stats_total(0,'EPI_BP');
$total_opcre77=$presta->epce_stats_total(0,'OPCRE77');
$total_nacre1=$presta->epce_stats_total(0,'NACRE1');
$total_nacre3=$presta->epce_stats_total(0,'NACRE3');
$total_pdi92=$presta->epce_stats_total(0,'PDI92');
$total_epce=$presta->epce_stats_total(0,'EPCE');
$total_mca=$presta->epce_stats_total(0,'MCA');
$total=$presta->epce_stats_total(0);
}*/

$cloturer_id=$GLOBALS['egw_info']['user']['account_id'];
$cloture_id=$GLOBALS['egw_info']['user']['account_id'];
$cloturer= $presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$cloturer_nacre1= $presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$cloturer_nacre3= $presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');

$cours_id=$GLOBALS['egw_info']['user']['account_id'];
$cours=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$cours_nacre1=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$cours_nacre3=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');

$nouvelle_id=$GLOBALS['egw_info']['user']['account_id'];
$nouvelle=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$nouvelle_nacre1=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$nouvelle_nacre3=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');
$relance=$presta->epce_relance($GLOBALS['egw_info']['user']['account_id']);
$relance_id=$GLOBALS['egw_info']['user']['account_id'];

$nouvelle_pdi92=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$nouvelle_mca=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$nouvelle_epi_bp=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$nouvelle_bcf=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$nouvelle_vae=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'VAE');	

$cours_pdi92=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$cours_mca=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$cours_bcf=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$cours_epi_bp=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$cours_vae=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'VAE');

$cloturer_pdi92=$presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$cloturer_mca=$presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$cloturer_epi_bp=$presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$cloturer_bcf=$presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$cloturer_vae=$presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'VAE');

$cloture=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$cloture_nacre1=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$cloture_nacre3=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');
$cloture_pdi92=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$cloture_mca=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$cloture_epi_bp=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$cloture_bcf=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$cloture_vae=$presta->epce_stats('Complete',$GLOBALS['egw_info']['user']['account_id'],'VAE');

$abandon=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$abandon_nacre1=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$abandon_nacre3=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');
$abandon_pdi92=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$abandon_mca=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$abandon_epi_bp=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$abandon_bcf=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$abandon_vae=$presta->epce_stats('Abandon',$GLOBALS['egw_info']['user']['account_id'],'VAE');

$annulee=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$annulee_nacre1=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$annulee_nacre3=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'NACRE3');
$annulee_pdi92=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'PDI92');
$annulee_mca=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'MCA');
$annulee_epi_bp=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$annulee_bcf=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'BCF');
$annulee_vae=$presta->epce_stats('Annulee',$GLOBALS['egw_info']['user']['account_id'],'VAE');

$total_epce=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'EPCE');
$total_nacre1=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$total_nacre3=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'NACRE3');
$total_pdi92=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'PDI92');
$total_mca=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'MCA');
$total_epi_bp=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'EPI_BP');
$total_bcf=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'BCF');
$total_vae=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id'],'VAE');



$total=$presta->epce_stats_total($GLOBALS['egw_info']['user']['account_id']);

$nb_total_epce=$cloture+$nouvelle+$cours+$cloturer+$annulee+$abandon;
$nb_total_nacre1=$cloture_nacre1+$nouvelle_nacre1+$cours_nacre1+$cloturer_nacre1+$annulee_nacre1+$abandon_nacre1;
$nb_total_nacre3=$cloture_nacre3+$nouvelle_nacre3+$cours_nacre3+$cloturer_nacre3+$annulee_nacre3+$abandon_nacre3;
$nb_total_mca=$cloture_mca+$nouvelle_mca+$cours_mca+$cloturer_mca+$annulee_mca+$abandon_mca;
$nb_total_epi_bp=$cloture_epi_bp+$nouvelle_epi_bp+$cours_epi_bp+$cloturer_epi_bp+$annulee_epi_bp+$abandon_epi_bp;
$nb_total_vae=$cloture_vae+$nouvelle_vae+$cours_vae+$cloturer_vae+$annulee_vae+$abandon_vae;
$nb_total_pdi92=$cloture_pdi92+$nouvelle_pdi92+$cours_pdi92+$cloturer_pdi92+$annulee_pdi92+$abandon_pdi92;
$nb_total_bcf=$cloture_bcf+$nouvelle_bcf+$cours_bcf+$cloturer_bcf+$annulee_bcf+$abandon_bcf;
	

?><html><head>
<script>
function voir_presta(presta)
{


	if(presta=='')
	{
			document.getElementById('div_PDI92_nouvelle').style.visibility='visible';
	document.getElementById('div_PDI92_en_cours').style.visibility='visible';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='visible';
	document.getElementById('div_PDI92_cloturer').style.visibility='visible';
	document.getElementById('div_PDI92_a_relancer').style.visibility='visible';
	document.getElementById('div_PDI92_abandon').style.visibility='visible';
	document.getElementById('div_PDI92_annulee').style.visibility='visible';
	document.getElementById('div_PDI92_total').style.visibility='visible';
	
			document.getElementById('div_BCF_nouvelle').style.visibility='visible';
	document.getElementById('div_BCF_en_cours').style.visibility='visible';
	document.getElementById('div_BCF_a_cloturer').style.visibility='visible';
	document.getElementById('div_BCF_cloturer').style.visibility='visible';
	document.getElementById('div_BCF_a_relancer').style.visibility='visible';
	document.getElementById('div_BCF_abandon').style.visibility='visible';
	document.getElementById('div_BCF_annulee').style.visibility='visible';
	document.getElementById('div_BCF_total').style.visibility='visible';
		
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='visible';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='visible';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='visible';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='visible';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='visible';
	document.getElementById('div_EPI_BP_abandon').style.visibility='visible';
	document.getElementById('div_EPI_BP_annulee').style.visibility='visible';
	document.getElementById('div_EPI_BP_total').style.visibility='visible';
	
	document.getElementById('div_VAE_nouvelle').style.visibility='visible';
	document.getElementById('div_VAE_en_cours').style.visibility='visible';
	document.getElementById('div_VAE_a_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_a_relancer').style.visibility='visible';
	document.getElementById('div_VAE_abandon').style.visibility='visible';
	document.getElementById('div_VAE_annulee').style.visibility='visible';
	document.getElementById('div_VAE_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='visible';
	document.getElementById('div_EPCE_en_cours').style.visibility='visible';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='visible';
	document.getElementById('div_EPCE_cloturer').style.visibility='visible';
	document.getElementById('div_EPCE_a_relancer').style.visibility='visible';
	document.getElementById('div_EPCE_abandon').style.visibility='visible';
	document.getElementById('div_EPCE_annulee').style.visibility='visible';
	document.getElementById('div_EPCE_total').style.visibility='visible';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='visible';
	document.getElementById('div_NACRE1_en_cours').style.visibility='visible';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE1_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='visible';
	document.getElementById('div_NACRE1_abandon').style.visibility='visible';
	document.getElementById('div_NACRE1_annulee').style.visibility='visible';
	document.getElementById('div_NACRE1_total').style.visibility='visible';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='visible';
	document.getElementById('div_NACRE3_en_cours').style.visibility='visible';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE3_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='visible';
	document.getElementById('div_NACRE3_abandon').style.visibility='visible';
	document.getElementById('div_NACRE3_annulee').style.visibility='visible';
	document.getElementById('div_NACRE3_total').style.visibility='visible';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='visible';
	document.getElementById('div_MCA_en_cours').style.visibility='visible';
	document.getElementById('div_MCA_a_cloturer').style.visibility='visible';
	document.getElementById('div_MCA_cloturer').style.visibility='visible';
	document.getElementById('div_MCA_a_relancer').style.visibility='visible';
	document.getElementById('div_MCA_abandon').style.visibility='visible';
	document.getElementById('div_MCA_annulee').style.visibility='visible';
	document.getElementById('div_MCA_total').style.visibility='visible';
	
	

	

	
	
	}
	
	else if(presta=='VAE')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='visible';
	document.getElementById('div_VAE_en_cours').style.visibility='visible';
	document.getElementById('div_VAE_a_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_a_relancer').style.visibility='visible';
	document.getElementById('div_VAE_abandon').style.visibility='visible';
	document.getElementById('div_VAE_annulee').style.visibility='visible';
	document.getElementById('div_VAE_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	else if(presta=='EPCE')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='visible';
	document.getElementById('div_EPCE_en_cours').style.visibility='visible';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='visible';
	document.getElementById('div_EPCE_cloturer').style.visibility='visible';
	document.getElementById('div_EPCE_a_relancer').style.visibility='visible';
	document.getElementById('div_EPCE_abandon').style.visibility='visible';
	document.getElementById('div_EPCE_annulee').style.visibility='visible';
	document.getElementById('div_EPCE_total').style.visibility='visible';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	
		else if(presta=='VAE')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='visible';
	document.getElementById('div_VAE_en_cours').style.visibility='visible';
	document.getElementById('div_VAE_a_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_cloturer').style.visibility='visible';
	document.getElementById('div_VAE_a_relancer').style.visibility='visible';
	document.getElementById('div_VAE_abandon').style.visibility='visible';
	document.getElementById('div_VAE_annulee').style.visibility='visible';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	else if(presta=='MCA')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='visible';
	document.getElementById('div_MCA_en_cours').style.visibility='visible';
	document.getElementById('div_MCA_a_cloturer').style.visibility='visible';
	document.getElementById('div_MCA_cloturer').style.visibility='visible';
	document.getElementById('div_MCA_a_relancer').style.visibility='visible';
	document.getElementById('div_MCA_abandon').style.visibility='visible';
	document.getElementById('div_MCA_annulee').style.visibility='visible';
	document.getElementById('div_MCA_total').style.visibility='visible';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	
	
	else if(presta=='NACRE1')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='visible';
	document.getElementById('div_NACRE1_en_cours').style.visibility='visible';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE1_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='visible';
	document.getElementById('div_NACRE1_abandon').style.visibility='visible';
	document.getElementById('div_NACRE1_annulee').style.visibility='visible';
	document.getElementById('div_NACRE1_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}

else if(presta=='NACRE3')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='visible';
	document.getElementById('div_NACRE3_en_cours').style.visibility='visible';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE3_cloturer').style.visibility='visible';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='visible';
	document.getElementById('div_NACRE3_abandon').style.visibility='visible';
	document.getElementById('div_NACRE3_annulee').style.visibility='visible';
	document.getElementById('div_NACRE3_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	
	else if(presta=='BCF')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_BCF_nouvelle').style.visibility='visible';
	document.getElementById('div_BCF_en_cours').style.visibility='visible';
	document.getElementById('div_BCF_a_cloturer').style.visibility='visible';
	document.getElementById('div_BCF_cloturer').style.visibility='visible';
	document.getElementById('div_BCF_a_relancer').style.visibility='visible';
	document.getElementById('div_BCF_abandon').style.visibility='visible';
	document.getElementById('div_BCF_annulee').style.visibility='visible';
	document.getElementById('div_BCF_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
else if(presta=='PDI92')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='visible';
	document.getElementById('div_PDI92_en_cours').style.visibility='visible';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='visible';
	document.getElementById('div_PDI92_cloturer').style.visibility='visible';
	document.getElementById('div_PDI92_a_relancer').style.visibility='visible';
	document.getElementById('div_PDI92_abandon').style.visibility='visible';
	document.getElementById('div_PDI92_annulee').style.visibility='visible';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPI_BP_abandon').style.visibility='hidden';
	document.getElementById('div_EPI_BP_annulee').style.visibility='hidden';
	document.getElementById('div_EPI_BP_total').style.visibility='hidden';
	
	}
	
	else if(presta=='EPI_BP')
	{
	document.getElementById('div_VAE_nouvelle').style.visibility='hidden';
	document.getElementById('div_VAE_en_cours').style.visibility='hidden';
	document.getElementById('div_VAE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_cloturer').style.visibility='hidden';
	document.getElementById('div_VAE_a_relancer').style.visibility='hidden';
	document.getElementById('div_VAE_abandon').style.visibility='hidden';
	document.getElementById('div_VAE_annulee').style.visibility='hidden';
	document.getElementById('div_VAE_total').style.visibility='hidden';
	
	document.getElementById('div_EPI_BP_nouvelle').style.visibility='visible';
	document.getElementById('div_EPI_BP_en_cours').style.visibility='visible';
	document.getElementById('div_EPI_BP_a_cloturer').style.visibility='visible';
	document.getElementById('div_EPI_BP_cloturer').style.visibility='visible';
	document.getElementById('div_EPI_BP_a_relancer').style.visibility='visible';
	document.getElementById('div_EPI_BP_abandon').style.visibility='visible';
	document.getElementById('div_EPI_BP_annulee').style.visibility='visible';
	document.getElementById('div_EPI_BP_total').style.visibility='visible';
	
	document.getElementById('div_EPCE_nouvelle').style.visibility='hidden';
	document.getElementById('div_EPCE_en_cours').style.visibility='hidden';
	document.getElementById('div_EPCE_a_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_cloturer').style.visibility='hidden';
	document.getElementById('div_EPCE_a_relancer').style.visibility='hidden';
	document.getElementById('div_EPCE_abandon').style.visibility='hidden';
	document.getElementById('div_EPCE_annulee').style.visibility='hidden';
	document.getElementById('div_EPCE_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE1_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE1_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE1_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE1_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE1_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE1_total').style.visibility='hidden';
	
	document.getElementById('div_MCA_nouvelle').style.visibility='hidden';
	document.getElementById('div_MCA_en_cours').style.visibility='hidden';
	document.getElementById('div_MCA_a_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_cloturer').style.visibility='hidden';
	document.getElementById('div_MCA_a_relancer').style.visibility='hidden';
	document.getElementById('div_MCA_abandon').style.visibility='hidden';
	document.getElementById('div_MCA_annulee').style.visibility='hidden';
	document.getElementById('div_MCA_total').style.visibility='hidden';
	
	
	document.getElementById('div_BCF_nouvelle').style.visibility='hidden';
	document.getElementById('div_BCF_en_cours').style.visibility='hidden';
	document.getElementById('div_BCF_a_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_cloturer').style.visibility='hidden';
	document.getElementById('div_BCF_a_relancer').style.visibility='hidden';
	document.getElementById('div_BCF_abandon').style.visibility='hidden';
	document.getElementById('div_BCF_annulee').style.visibility='hidden';
	document.getElementById('div_BCF_total').style.visibility='hidden';
	
	document.getElementById('div_NACRE3_nouvelle').style.visibility='hidden';
	document.getElementById('div_NACRE3_en_cours').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_cloturer').style.visibility='hidden';
	document.getElementById('div_NACRE3_a_relancer').style.visibility='hidden';
	document.getElementById('div_NACRE3_abandon').style.visibility='hidden';
	document.getElementById('div_NACRE3_annulee').style.visibility='hidden';
	document.getElementById('div_NACRE3_total').style.visibility='hidden';
	
	document.getElementById('div_PDI92_nouvelle').style.visibility='hidden';
	document.getElementById('div_PDI92_en_cours').style.visibility='hidden';
	document.getElementById('div_PDI92_a_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_cloturer').style.visibility='hidden';
	document.getElementById('div_PDI92_a_relancer').style.visibility='hidden';
	document.getElementById('div_PDI92_abandon').style.visibility='hidden';
	document.getElementById('div_PDI92_annulee').style.visibility='hidden';
	document.getElementById('div_PDI92_total').style.visibility='hidden';
	
	}



}


</script>


</head><body onLoad="voir_presta('');"><div> <form action="" method="get" ><img src="images/calendar_16.png" /> <a onClick="window.open('../../presta/epce/control.php?option=1&id=<?php echo $GLOBALS['egw_info']['user']['account_id']; ?>','Poser des options','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=500, height=300');" target="_blank" >Poser des options</a> | <img src="images/clock_16.png" /> <a target="_blank" onClick="window.open('../../presta/epce/control.php?confirmer=1&id=<?php echo $GLOBALS['egw_info']['user']['account_id']; ?>','Poser des options','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" >Confirmer des options</a>| <img src="images/suivi_icons/telephone.png" /> <a target="_blank"  onclick="window.open('../../presta/activite/relance.php','Rapport activité','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');">Suivi des relances</a> | <img src="images/dossier.png" /> <a onClick="window.open('../../../presta/epce/control.php?nouveau_epce=1&prenom_conseiller=<?php echo $GLOBALS['egw_info']['user']['firstname'];?>&nom_conseiller=<?php echo $GLOBALS['egw_info']['user']['lastname'];?>&id=<?php echo $GLOBALS['egw_info']['user']['account_id'];?>','Nouvelle prestation','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" target="_blank" >Nouvelle prestation</a>
    <?php if($GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{?>| <img src="../../presta/epce/images/icons/clipboard_text.png"  /> <a onClick="window.open('../../presta/activite/rapport.php','Rapport activité','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" target="_blank" >Rapport d'activit&eacute;</a> <?php } ?>
    <input type="hidden" value="default" name="domain" /></form></div><div style="border:1px solid  #999 ; background: #E9E9E9" align="center"> <form  style="background-color: #CACACA; padding:3px;">
      
  

<select name="exercice"><option ><?php echo $_GET['exercice']; ?></option><option <?php echo $etat_all; ?> value="all">Tous les exercices</option>'<?php 

for($i=date('Y');$i>=2009;$i--)
{
echo'<option >'.$i.'</option>';
}

?></select>
<?php $presta->selectionner_conseiller3($conseiller_id,$GLOBALS['egw_info']['user']['account_primary_group']); ?>
<input type="hidden" value="default" name="domain" />
   <input type="submit" value="Filtrer" /></form><form style="padding:3px;" action="suivi.php" method="get"><input type="hidden" name="voir" value="0,10" /><input type="hidden" name="statut_epce" value="" /><input type="hidden" name="domain" value="default" />
      <input type="hidden" name="conseiller_id" value="" />
      <input type="text" name='mot'/> <select  onchange="voir_presta(this.value);" name="presta"><option value="">Toutes les prestations</option><option value="EPCE">EPCE</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_BP">EPI_BP</option><option value="BCF">BCF</option><option value="VAE">VAE</option></select> <input type="submit" value="Rechercher" /></form></div><br/>
<br/>
<div align="center">
  
  <table >
    <tr><td width="75" valign="bottom"><strong>Presta</strong><br/><br/><table    style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
    <tr      bgcolor="#ECF3F4">
      <td width="48" height="20">EPCE</td>
    </tr>
    <tr   bgcolor="#FFF">
      <td width="48" height="20" >NACRE1</td>
    </tr>
    <tr   bgcolor="#ECF3F4">
      <td width="48" height="20">NACRE3</td>
    </tr>
    <tr   bgcolor="#FFF">
      <td width="48" height="20">PDI92</td>
    </tr>
    <tr  bgcolor="#ECF3F4">
      <td width="48" height="20">MCA</td>
    </tr>
    <tr    bgcolor="#FFF">
      <td width="48" height="20">BCF</td>
    </tr>
    <tr  bgcolor="#ECF3F4">
      <td width="48" height="20">EPI_BP</td>
    </tr>
    <tr      bgcolor="#FFF">
      <td width="48" height="21">VAE</td>
    </tr> </table><br/><table> <tr  bgcolor="#ECF3F4">
      <td width="48" height="20"><strong>TOTAL</strong></td>
    </tr>
  </table></td>
      <td width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_get.png" /> <strong>A venir</strong><br/><br/>
        <table    style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;"><tr style="visibility:hidden"   id="div_EPCE_nouvelle"  bgcolor="#ECF3F4">
<td  width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle; ?></a> </td><td>|</td><td width="39"> <?php echo round((($nouvelle/$total_epce)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE1_nouvelle" bgcolor="#FFF">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_nacre1; ?></a> </td><td>|</td><td> <?php echo round((($nouvelle_nacre1/$total_nacre1)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE3_nouvelle" bgcolor="#ECF3F4">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_nacre3; ?></a> </td><td>|</td><td> <?php echo round((($nouvelle_nacre3/$total_nacre3)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_PDI92_nouvelle" bgcolor="#FFF">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_pdi92; ?></a></td><td> |</td><td> <?php echo round((($nouvelle_pdi92/$total_pdi92)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_MCA_nouvelle" bgcolor="#ECF3F4">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_mca; ?></a> </td><td>| </td><td><?php echo round((($nouvelle_mca/$total_mca)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_BCF_nouvelle"  bgcolor="#FFF">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_bcf; ?></a> </td><td>|</td><td> <?php echo round((($nouvelle_bcf/$total_bcf)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_EPI_BP_nouvelle"  bgcolor="#ECF3F4">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_epi_bp; ?></a> </td><td>|</td><td> <?php echo round((($nouvelle_epi_bp/$total_epi_bp)*100),1); ?>%</td></tr><tr style="visibility:hidden"   id="div_VAE_nouvelle"  bgcolor="#FFF">
<td width="39" height="20" align="center"><a href="suivi.php?nb=<?php echo $nouvelle_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_vae; ?></a> </td><td>| </td><td><?php echo round((($nouvelle_vae/$total_vae)*100),1); ?>%</td></tr></table><br/><table><tr   bgcolor="#ECF3F4">
<td width="39" height="20" align="center"><strong><?php echo $nouvelle+$nouvelle_epi_bp+$nouvelle_bcf+$nouvelle_mca+$nouvelle_pdi92+$nouvelle_nacre3+$nouvelle_nacre1+$nouvelle_vae; ?></strong> </td><td>| </td><td><?php echo round(((($nouvelle+$nouvelle_epi_bp+$nouvelle_bcf+$nouvelle_mca+$nouvelle_pdi92+$nouvelle_nacre3+$nouvelle_nacre1+$nouvelle_vae)/$total)*100),1); ?>%</td></tr></table></td>
    <td width="120" height="267" align="center" valign="bottom"><img src="images/suivi_icons/application_edit.png" /> <strong>En cours</strong><br/><br/>
      <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
        <tr style="visibility:hidden"   id="div_EPCE_en_cours" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $cours_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours; ?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($cours/$total_epce)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE1_en_cours" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_nacre1; ?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($cours_nacre1/$total_nacre1)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE3_en_cours" bgcolor="#ECF3F4" >
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_nacre3; ?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($cours_nacre3/$total_nacre3)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_PDI92_en_cours" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_pdi92; ?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($cours_pdi92/$total_pdi92)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_MCA_en_cours" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_mca; ?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($cours_mca/$total_mca)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_BCF_en_cours" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_bcf; ?></a></td><td>|</td><td width="37"> <?php echo round((($cours_bcf/$total_bcf)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_EPI_BP_en_cours" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_epi_bp; ?></a></td><td>|</td><td width="37"> <?php echo round((($cours_epi_bp/$total_epi_bp)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden"   id="div_VAE_en_cours"  bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cours_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_vae; ?></a></td><td>|</td><td width="37"> <?php echo round((($cours_vae/$total_vae)*100),1); ?>%</td>
        </tr> 
      </table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><?php echo $cours_pdi92+$cours_mca+$cours+$cours_nacre3+$cours_nacre1+$cours_vae+$cours_epi_bp; ?></strong></td><td>|</td><td width="37"> <?php echo round(((($cours_pdi92+$cours_mca+$cours+$cours_nacre3+$cours_nacre1+$cours_vae+$cours_epi_bp)/$total)*100),1); ?>%</td>
        </tr></table></td>
    <td width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_error.png" /> <strong>A cl&ocirc;turer</strong><br/><br/>     
  <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
  <tr style="visibility:hidden"   id="div_EPCE_a_cloturer" bgcolor="#ECF3F4">
<td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $cloturer_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer;?></a> </td><td>|</td><td width="37"> <?php echo round((($cloturer/$total_epce)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE1_a_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_nacre1; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_nacre1/$total_nacre1)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE3_a_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_nacre3; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_nacre3/$total_nacre3)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_PDI92_a_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_pdi92; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_pdi92/$total_pdi92)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_MCA_a_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_mca; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_mca/$total_mca)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_BCF_a_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_bcf; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_bcf/$total_bcf)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_EPI_BP_a_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_epi_bp; ?></a></td><td>|</td><td width="37"> <?php echo round((($cloturer_epi_bp/$total_epi_bp)*100),1); ?>%</td></tr><tr style="visibility:hidden"   id="div_VAE_a_cloturer"  bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloturer_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer_vae; ?></a><td>|</td><td width="37"> <?php echo round((($cloturer_vae/$total_vae)*100),1); ?>%</td></tr></table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><?php echo $cloturer_pdi92+$cloturer_mca+$cloturer+$cloturer_nacre3+$cloturer_nacre1+$cloturer_vae+$cloturer_epi_bp; ?></strong></td><td>|</td><td width="37"> <?php echo round(((($cloturer_pdi92+$cloturer_mca+$cloturer+$cloturer_nacre3+$cloturer_nacre1+$cloturer_vae+$cloturer_epi_bp)/$total)*100),1); ?>%</td>
      </tr></table></td>
      <td width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_link.png" /><strong> Annul&eacute;e</strong><br/>
      <br/>
      <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
        <tr  style="visibility:hidden"   id="div_EPCE_annulee" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee;?></a></td>
          <td >|</td>
          <td width="37"><?php echo round((($annulee/$total_epce)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE1_annulee" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_nacre1;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($annulee_nacre1/$total_nacre1)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE3_annulee" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_nacre3;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($annulee_nacre3/$total_nacre3)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_PDI92_annulee" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_pdi92;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($annulee_pdi92/$total_pdi92)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_MCA_annulee" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_mca;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($annulee_mca/$total_mca)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_BCF_annulee" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_bcf;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($annulee_bcf/$total_bcf)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_EPI_BP_annulee" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_epi_bp;?></a></td><td>|</td><td width="37"> <?php echo round((($annulee_epi_bp/$total_epi_bp)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden"   id="div_VAE_annulee"  bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $annulee_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $annulee_id; ?>&voir=0,10&statut_epce=Annulee"><?php echo $annulee_vae;?></a></td><td>|</td><td width="37"> <?php echo round((($annulee_vae/$total_vae)*100),1); ?>%</td>
        </tr>
      </table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><?php echo $annulee_pdi92+$annulee_mca+$annulee+$annulee_nacre3+$annulee_nacre1+$annulee_vae+$annulee_epi_bp; ?></strong></td><td>|</td><td width="37"> <?php echo round(((($annulee_pdi92+$annulee_mca+$annulee+$annulee_nacre3+$annulee_nacre1+$annulee_vae+$annulee_epi_bp)/$total)*100),1); ?>%</td>
      </tr></table></td><td width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_link.png" /><strong> Abandon</strong><br/>
      <br/>
      <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
        <tr  style="visibility:hidden"   id="div_EPCE_abandon" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon;?></a></td>
          <td>|</td>
          <td width="37"><?php echo round((($abandon/$total_epce)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE1_abandon" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_nacre1;?></a><td>|</td><td width="37"> <?php echo round((($abandon_nacre1/$total_nacre1)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_NACRE3_abandon" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_nacre3;?></a><td>|</td><td width="37"> <?php echo round((($abandon_nacre3/$total_nacre3)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_PDI92_abandon" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_pdi92;?></a><td>|</td><td width="37"> <?php echo round((($abandon_pdi92/$total_pdi92)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_MCA_abandon" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_mca;?></a><td>|</td><td width="37"> <?php echo round((($abandon_mca/$total_mca)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_BCF_abandon" bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_bcf;?></a><td>|</td><td width="37"> <?php echo round((($abandon_bcf/$total_bcf)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden" id="div_EPI_BP_abandon" bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_epi_bp;?></a><td>|</td><td width="37"> <?php echo round((($abandon_epi_bp/$total_epi_bp)*100),1); ?>%</td>
        </tr>
        <tr style="visibility:hidden"   id="div_VAE_abandon"  bgcolor="#FFF">
          <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $abandon_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $abandon_id; ?>&voir=0,10&statut_epce=Abandon"><?php echo $abandon_vae;?></a><td>|</td><td width="37"> <?php echo round((($abandon_vae/$total_vae)*100),1); ?>%</td>
        </tr>
      </table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><?php echo $abandon_bcf+$abandon_pdi92+$abandon_mca+$abandon+$abandon_nacre3+$abandon_nacre1+$abandon_vae+$abandon_epi_bp; ?></strong></td><td>|</td><td width="37"> <?php echo round(((($abandon_bcf+$abandon_pdi92+$abandon_mca+$abandon+$abandon_nacre3+$abandon_nacre1+$abandon_vae+$abandon_epi_bp)/$total)*100),1); ?>%</td>
      </tr></table></td>
<td width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_link.png" /><strong> Compl&egrave;te</strong><br/>
      <br/>     
  <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
  <tr  style="visibility:hidden"   id="div_EPCE_cloturer" bgcolor="#ECF3F4">
<td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture;?></a> </td><td>| </td><td width="37"><?php echo round((($cloture/$total_epce)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE1_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_nacre1;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_nacre1/$total_nacre1)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_NACRE3_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_nacre3; ?>&presta=NACRE3&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_nacre3;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_nacre3/$total_nacre3)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_PDI92_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_pdi92; ?>&presta=PDI92&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_pdi92;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_pdi92/$total_pdi92)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_MCA_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_mca; ?>&presta=MCA&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_mca;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_mca/$total_mca)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_BCF_cloturer" bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_bcf; ?>&presta=BCF&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_bcf;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_bcf/$total_bcf)*100),1); ?>%</td></tr><tr style="visibility:hidden" id="div_EPI_BP_cloturer" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_epi_bp; ?>&presta=EPI_BP&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_epi_bp;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_epi_bp/$total_epi_bp)*100),1); ?>%</td></tr><tr style="visibility:hidden"   id="div_VAE_cloturer"  bgcolor="#FFF">
  <td width="37" height="20" align="center"><a href="suivi.php?nb=<?php echo $cloture_vae; ?>&presta=VAE&domain=default&conseiller_id=<?php echo $cloture_id; ?>&voir=0,10&statut_epce=Complete"><?php echo $cloture_vae;?></a></td><td>| </td><td width="37"><?php echo round((($cloture_vae/$total_vae)*100),1); ?>%</td></tr></table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><?php echo $cloture_bcf+$cloture_pdi92+$cloture_mca+$cloture+$cloture_nacre3+$cloture_nacre1+$cloture_vae+$cloture_epi_bp; ?></strong></td><td>|</td><td width="37"> <?php echo round(((($cloture_pdi92+$cloture_mca+$cloture+$cloture_nacre3+$cloture_nacre1+$cloture_vae+$cloture_epi_bp+$cloture_bcf)/$total)*100),1); ?>%</td>
      </tr></table></td>
<td width="120" bgcolor="#E0FFD9" align="center" valign="bottom"><img src="images/suivi_icons/application_link.png" /><strong> TOTAL</strong><br/>
      <br/>     
  <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
  <tr  style="visibility:hidden"   id="div_EPCE_total" bgcolor="#ECF3F4">
<td width="37" height="20" align="center"><strong><?php echo $nb_total_epce;?></strong> </td><td>| </td>
<td width="37">100%</td></tr><tr style="visibility:hidden" id="div_NACRE1_total" bgcolor="#FFF">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_nacre1;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden" id="div_NACRE3_total" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_nacre3;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden" id="div_PDI92_total" bgcolor="#FFF">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_pdi92;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden" id="div_MCA_total" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_mca;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden" id="div_BCF_total" bgcolor="#FFF">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_bcf;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden" id="div_EPI_BP_total" bgcolor="#ECF3F4">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_epi_bp;?></strong></td><td>| </td><td width="37">100%</td></tr><tr style="visibility:hidden"   id="div_VAE_total"  bgcolor="#FFF">
  <td width="37" height="20" align="center"><strong><?php echo $nb_total_vae;?></strong></td><td>| </td><td width="37">100%</td></tr></table><br/><table><tr   bgcolor="#ECF3F4">
          <td width="37" height="20" align="center"><strong><font color="#00CC00"><?php echo $nb_total_bcf+$nb_total_pdi92+$nb_total_mca+$nb_total_epce+$nb_total_nacre3+$nb_total_nacre1+$nb_total_vae+$nb_total_epi_bp; ?></font></strong></td><td>|</td><td width="37">100%</td>
      </tr></table></td>
    <td bgcolor="#EBEBEB" width="120" align="center" valign="bottom"><img src="images/suivi_icons/application_lightning.png" /> <strong>A relancer</strong><br/><br/>
      <table style=" font-size:13px;border:1px solid #CCC;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;"><tr style="visibility:hidden"   id="div_EPCE_a_relancer" bgcolor="#ECF3F4">
  <td width="82" height="20" align="center"><a href="suivi_relance.php?cla=desc&tri=date_debut&statut_epce=relance&presta=EPCE&domain=default&voir=0,20&conseiller_id=<?php echo $relance_id; ?>"><?php echo $relance; ?></a> | <?php echo round((($relance/$total_epce)*100),1); ?>% </td></tr><tr style="visibility:hidden" id="div_NACRE1_a_relancer" bgcolor="#FFF">
  <td width="82" height="20" align="center">-</td></tr><tr style="visibility:hidden" id="div_NACRE3_a_relancer" bgcolor="#ECF3F4">
  <td width="82" height="20" align="center">-</td></tr><tr style="visibility:hidden" id="div_PDI92_a_relancer" bgcolor="#FFF">
  <td width="82" height="20" align="center">-</td></tr><tr style="visibility:hidden" id="div_MCA_a_relancer" bgcolor="#ECF3F4">
  <td width="82" height="20" align="center">-</td></tr><tr style="visibility:hidden" id="div_BCF_a_relancer" bgcolor="#FFF">
  <td width="82" height="20" align="center">-</td></tr><tr style="visibility:hidden" id="div_EPI_BP_a_relancer" bgcolor="#ECF3F4">
  <td width="82" height="20" align="center">-</td></tr><tr  style="visibility:hidden"   id="div_VAE_a_relancer"  bgcolor="#FFF">
  <td width="82" height="17" align="center">-</td></tr></table><br/><table><tr style="visibility:hidden" height="20"><td>.</td></tr></table></td></tr></table><br/>
</div>

<?php if(isset($_GET['maj']))
					 {
						$presta_zend->update_fonction();
					}
					
                   /* <a href="suivi.php?nb=<?php echo $relance; ?>&presta=EPCE&relance=1&domain=default&voir=0,10&conseiller_id=<?php echo $relance_id; ?>"><?php echo $relance; ?></a>*/?><?php

echo $GLOBALS['egw']->common->egw_footer();
?></body></html>