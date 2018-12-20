<?php

class presta
{
	public $cat_id_owner ;
	//public $lid_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_employeur;
	public $exercice = 2010;
	
	
	public $db;
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $id_group_apsie = '-3007';
	public $id_group_stragefi = '-3008';
	public $id_group_agroform = '-3009';

	
	
	
	
	
	// constructeur 
	function __construct()
	{
		
	
		
			
	/*	 	
$db_host = $egw_info["server"]["db_host"] ; 
$db_name = $egw_info["server"]["db_name"] ;
$db_user = $egw_info["server"]["db_user"] ; 
$db_pass = $egw_info["server"]["db_pass"] ; */

// on se connecte à MySQL
$this->db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$this->db); 
  
  
  
  

	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	function nb_presta_epce($id,$statut=NULL,$id_ref,$mot=NULL,$presta='',$date_deb,$date_fin)
	{
		
		$tab_date_deb=explode("/",$date_deb);
		$tab_date_fin=explode("/",$date_fin);
		
		$temps_mois=time()+ 2678400;
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		if($statut=="Nouvelle")
		{
			$stat=1;
		}
		if($statut=="En cours")
		{
			
			$stat=2;
		}
		if($statut=="A cloturer")
		{
			
			$stat=3;
		}
		if($statut=="relance")
		{
			
			$stat=4;
		}
		if($statut=="Cloture")
		{
			
			$stat=5;
		}
		
		/*if(isset($statut) and $statut!=NULL and $stat!=5 )
		{
		
			if($id_ref!=0)
			{
				$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and id_ref='.$id_ref.'';
			}
			else
			{
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%"';
			
			}
			
			
		}*/
		if(isset($statut) and $statut!=NULL and $stat==5 )
		{
			
			if($date_deb!=NULL and $date_fin!=NULL and $id_ref!=NULL and !is_numeric($id_ref))
			{
			
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%") and prestataire like "%'.$id_ref.'%" and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
			
			// echo $requete2;
			}
			
			elseif($date_deb!=NULL and $date_fin!=NULL and $id_ref!=0)
			{
			
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%") and id_ref='.$id_ref.' and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
				// echo $requete2;
			}
			elseif($date_deb!=NULL and $date_fin!=NULL )
			{
			
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%")  and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
			
			}
			
			elseif($id_ref!=NULL and !is_numeric($id_ref))
			{
				$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%") and prestatire like "%'.$id_ref.'%" ';
			}
			
			elseif($id_ref!=0)
			{
				$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%") and id_ref='.$id_ref.' ';
			}
			else
			{
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%")';
			
			}
		}
		elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and prestataire like "%'.$id_ref.'%" and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
		
		
		}
		
		
	elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  and $id_ref!=0)
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and id_ref='.$id_ref.' and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
		
		
		}
			
			elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  )
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).'';
		
		
		}
		
			
		elseif($statut!=NULL and $presta!='' and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'" and prestataire like "%'.$id_ref.'%" ';
		
		
		}
			
			
		elseif($statut!=NULL and $presta!='' and $id_ref!=0)
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'" and id_ref='.$id_ref.' ';
		
		
		}
		elseif($statut!=NULL and $presta!='')
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"';
		
		
		}
		
		elseif($presta!=''  and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'" and prestataire like "%'.$id_ref.'%" ';
		
		
		}
		
		
		elseif($presta!=''  and $id_ref!=0)
		{
		$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'" and id_ref='.$id_ref.' ';
		
		
		}
		
			elseif($presta=='' and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"   and prestataire like "%'.$id_ref.'%"';
		
		
		}
		
		elseif($presta=='' and $id_ref!=0)
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"   and id_ref='.$id_ref.'';
		
		
		}
		
		elseif($presta!='')
		{
		$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'" ';
		
		
		}
		
		
		elseif($presta=='' )
		{
		$requete2='SELECT  prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" ';
		
		
		}
		
	$resultat2 = mysql_query($requete2) or die(mysql_error());
	return mysql_num_rows($resultat2);
	
	}
		
	function presta_epce($id,$statut=NULL,$id_ref,$mot=NULL,$ligne,$limit,$nb='',$presta='',$date_deb,$date_fin,$tri="date_debut",$cla="desc")
	{
		
		
		$tab_date_deb=explode("/",$date_deb);
		$tab_date_fin=explode("/",$date_fin);
		
		$temps_mois=time()+ 2678400;
		//$lim=explode(",",$limit);
		$compteur=$lim[0];
		if($statut=="Nouvelle")
		{
			$stat=1;
			echo'<table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestataire</td><td>Prestation</td><td >Beneficiaire</td><td >ID.Prestation</td><td>Debut </td><td>Fin</td><td>Fin reelle</td><td>Envoi du bilan</td><td  >RDV P</td><td  >RDV A</td><td >RDV R</td><td >Conseiller</td><td>Lieu</td><td>%</td><td>Statut</td><td></td></tr>';
		}
		elseif($statut=="En cours")
		{
			echo'<table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestataire</td><td>Prestation</td><td >Beneficiaire</td><td >ID.Prestation</td><td>Debut </td><td>Fin</td><td>Fin reelle</td><td>Envoi du bilan</td><td  >RDV P</td><td  >RDV A</td><td >RDV R</td><td >Conseiller</td><td>Lieu</td><td>%</td><td>Statut</td><td></td></tr>';
			$stat=2;
		}
		elseif($statut=="A cloturer")
		{echo'<table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestataire</td><td>Prestation</td><td >Beneficiaire</td><td >ID.Prestation</td><td>Debut </td><td>Fin</td><td>Fin reelle</td><td>Envoi du bilan</td><td  >RDV P</td><td  >RDV A</td><td >RDV R</td><td >Conseiller</td><td>Lieu</td><td>%</td><td>Statut</td><td></td></tr>';
			
			$stat=3;
		}
		
		elseif($statut=="Cloture")
		{
			
			$stat=5;
		}
		elseif($statut=="Complete" and $presta=="EPCE")
		{
			
			$stat=6;
			echo'<table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestataire</td><td>Prestation</td><td ><a href="suivi.php?domain=default&statut_epce='.$statut.'&mot='.$mot.'&conseiller_id='.$id_ref.'&presta='.$presta.'&date_deb='.$date_deb.'&date_fin='.$date_fin.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&tri=intitule&cla='.$cla.'">Beneficiaire</a></td><td ><a href="suivi.php?domain=default&statut_epce='.$statut.'&mot='.$mot.'&conseiller_id='.$id_ref.'&presta='.$presta.'&date_deb='.$date_deb.'&date_fin='.$date_fin.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&tri=lettre_de_commande&cla='.$cla.'">ID.Prestation</a></td><td><a href="suivi.php?domain=default&statut_epce='.$statut.'&mot='.$mot.'&conseiller_id='.$id_ref.'&presta='.$presta.'&date_deb='.$date_deb.'&date_fin='.$date_fin.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&tri=date_debut&cla='.$cla.'">Debut</a> </td><td><a href="suivi.php?domain=default&statut_epce='.$statut.'&mot='.$mot.'&conseiller_id='.$id_ref.'&presta='.$presta.'&date_deb='.$date_deb.'&date_fin='.$date_fin.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&tri=date_fin&cla='.$cla.'">Fin reelle</a></td><td  >RDV P</td><td  >RDV A</td><td >RDV R</td><td >Conseiller</td><td>Lieu</td><td>Avis</td><td>Estimation</td><td>Sol.Alt</td><td><a href="suivi.php?domain=default&statut_epce='.$statut.'&mot='.$mot.'&conseiller_id='.$id_ref.'&presta='.$presta.'&date_deb='.$date_deb.'&date_fin='.$date_fin.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&tri=relance&cla='.$cla.'">Archivé</a></td><td></td><td></td></tr>';
		}
		
		
		else
		{
		echo'<table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestataire</td><td>Prestation</td><td >Beneficiaire</td><td >ID.Prestation</td><td>Debut </td><td>Fin</td><td>Fin reelle</td><td>Envoi du bilan</td><td  >RDV P</td><td  >RDV A</td><td >RDV R</td><td >Conseiller</td><td>Lieu</td><td>%</td><td>Statut</td><td></td></tr>';
		}
		if($statut=="relance")
		{
			
			$stat=4;
		}
		/*if(isset($statut) and $statut!=NULL and $stat!=5 )
		{
			if($id_ref!=0)
			{
				$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and id_ref='.$id_ref.'  order by date_debut desc limit '.$limit.'';
			}
			else
			{
			$requete2='SELECT prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%"  order by date_debut desc limit '.$limit.'';
			
			}
			
			
		}*/
		if(isset($statut) and $statut!=NULL and $stat==5 )
		{
			
			if($date_deb!=NULL and $date_fin!=NULL and !is_numeric($id_ref) and $id_ref!=NULL)
			{
			
			$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%") and prestataire like "%'.$id_ref.'%" and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.'  limit  '.$ligne.','.$limit.'';
			
			}
			
			elseif($date_deb!=NULL and $date_fin!=NULL and $id_ref!=0)
			{
			
			$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%") and id_ref='.$id_ref.' and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.'  limit  '.$ligne.','.$limit.'';
			
			}
			elseif($date_deb!=NULL and $date_fin!=NULL )
			{
			
			$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and  intitule like "%'.$mot.'%" and (statut like "%Complete%" or statut like "%Abandon%")  and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
			
			}
			
			elseif($id_ref!=NULL and !is_numeric($id_ref))
			{
				$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%") and prestatire like "%'.$id_ref.'%"  order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
			}
			
			elseif($id_ref!=0)
			{
				$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%") and id_ref='.$id_ref.'  order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
			}
			else
			{
			$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="'.$presta.'" and (statut like "%Complete%" or statut like "%Abandon%") order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
			
			}
			
			
		}	
		
			
		elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and prestatire like "%'.$id_ref.'%" and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.'';
		
		
		}
		
		elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  and $id_ref!=0)
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and id_ref='.$id_ref.' and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.'';
		
		
		}
			
			elseif($statut!=NULL and $presta!='' and $date_deb!=NULL and  $date_fin!=NULL  )
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'"  and date_debut>='.mktime(0,0,0,$tab_date_deb[1],$tab_date_deb[0],$tab_date_deb[2]).' and date_debut<='.mktime(0,0,0,$tab_date_fin[1],$tab_date_fin[0],$tab_date_fin[2]).' order by '.$tri.' '.$cla.'';
		
		
		}
		
			
			
		elseif($statut!=NULL and $presta!='' and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'" and prestataire like "%'.$id_ref.'%" order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
			
		elseif($statut!=NULL and $presta!='' and $id_ref!=0)
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'" and id_ref='.$id_ref.' order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		elseif($statut!=NULL and $presta!='')
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"  and statut like "'.$statut.'%" and presta="'.$presta.'" order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		elseif($presta!=''  and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'" and prestataire like "%'.$id_ref.'%"  order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		
		elseif($presta!=''  and $id_ref!=0)
		{
		$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'" and id_ref='.$id_ref.'  order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		elseif($presta=='' and $id_ref!=NULL and !is_numeric($id_ref))
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"   and prestataire like "%'.$id_ref.'%" order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		
		elseif($presta=='' and $id_ref!=0)
		{
		$requete2='SELECT   relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"   and id_ref='.$id_ref.' order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		
		elseif($presta!='')
		{
		$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="'.$presta.'"  order by '.$tri.' '.$cla.' limit  '.$ligne.','.$limit.'';
		
		
		}
		
		
		elseif($presta=='' )
		{
		$requete2='SELECT  relance,prestataire,presta,date_envoi_bilan,date_fin_reelle,id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%"   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
		
		}
	

	$resultat2 = mysql_query($requete2) or die(mysql_error());


	
	while($row = mysql_fetch_array($resultat2))
		{
		
		$id_presta=$row['id_presta'];
	$intitule=$row['intitule'];
	$presta=$row['presta'];
	$relance=$row['relance'];
	$prestataire=$row['prestataire'];
	$statut=$row['statut'];
	$date_debut=$row['date_debut'];
	$date_envoi_bilan=$row['date_envoi_bilan'];
	$date_fin=$row['date_fin'];
	$date_fin_reelle=$row['date_fin_reelle'];
	$id_ben=$row['id_ben'];
	$lettre_de_commande=$row['lettre_de_commande'];
	
	if($date_debut==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut);
		
	}
	
	if($date_fin==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin);
		
	}	
	if($date_fin_reelle==0)
	{
		$dat_3=NULL;
	}
	else
	{
		$dat_3=date('d/m/Y',$date_fin_reelle);
		
	}
	if($date_envoi_bilan==0)
	{
		$dat_4=NULL;
	}
	else
	{
		$dat_4=date('d/m/Y',$date_envoi_bilan);
		
	}
	
	
	if($this->rdv_der($intitule)>=$date_fin)
	{
		if(date('d',$this->rdv_der($intitule))==date('d',$date_fin))
		{$color='style="color: #0C0"';}
		else
		{
		$color='style="color:#F00"';
		}
	}
	else
	{
	$color='style="color: #0C0"';
	}
	
	if($id_ben!=0)
	{
	
	$faisabilite_ben=$this->faisabilite($id_presta);
	//$faisabilite_ben[1]=$this->estimation($id_ben);
	$alternative_ben=$this->alternative($id_presta);
	}
	$lieu=explode("_",$this->rdv_lieu($intitule));
	
	
	//date('d/m/Y',$cal_start);
	
	/*if($statut=="En cours")
	{
	$statut='<img src="images/suivi_icons/magnifier.png" />';
	}
	elseif($statut=="Annulee")
	{
	$statut='<img src="images/suivi_icons/cancel.png" />';
	}
	elseif($statut=="Complete")
	{
	$statut='<img src="images/suivi_icons/accept.png" />';
	}*/
	
	//STATUT AUTOMATIQUE
	$this->statut_auto($id_presta,$date_fin);
	
	/*if($statut=="Nouvelle")
	{
		$alert="&alert=Nouvelle";
	}
	else
	{
		$alert=NULL;
	}*/
	
	if($faisabilite_ben[0]==3)
	{
	$faisabilite_ben[0]='<img title="Avis positif" src="images/balle_verte.png"/>';
	}
	elseif($faisabilite_ben[0]==2)
	{
	$faisabilite_ben[0]='<img title="Avis positif sous réserve" src="images/balle_jaune.png"/>';
	}
	elseif($faisabilite_ben[0]==1)
	{
	$faisabilite_ben[0]='<img title="Avis négatif" src="images/balle_rouge.png"/>';
	}
	if($faisabilite_ben[1]==3)
	{
	$faisabilite_ben[1]='<3m';
	}
	elseif($faisabilite_ben[1]==2)
	{
	$faisabilite_ben[1]='3 à 6m';
	}
	elseif($faisabilite_ben[1]==1)
	{
	$faisabilite_ben[1]='>6m';
	}
		
		if($relance==1)
	{
	$relance='<img title="Prestation relancé" src="images/tick_16.png"/>';
	}
	else
	{
	$relance='';
	}
			if($compteur%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		 
		 if($prestataire=="APSIE")
		 {
			$prestataire = '<img height="20" width="50" src="./images/logo_apsie.jpg" />';
		 }
		 if($prestataire=="STRAGEFI")
		 {
			$prestataire = '<img height="20" width="50" src="./images/logo_stragefi.jpg" />';
		 }
		 if($prestataire=="AGROFORM")
		 {
			$prestataire = '<img height="20" width="50" src="./images/logo_stragefi.jpg" />';
		 }
		
	if(!isset($mot))
	{
	if($stat==1)
	{
		 $compteur++;
		
		
	echo'<tr  bgcolor="'.$color.'" align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a title="Vérification du premier rendez-vous" onclick="window.open(\'../../presta/epce/premier_rdv.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&intitule='.$intitule.'&id='.$id.'&id_ben='.$id_ben.'\',\'PREMIER RENDEZ VOUS EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=330\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta='.$presta.'&statut_epce='.$statut.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&nb='.$nb.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	else if($stat==2)
	{
		 $compteur++;
	echo'<tr   bgcolor="'.$color.'"  align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/suite_rdv.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&intitule='.$intitule.'&id='.$id.'&id_ben='.$id_ben.'\',\'SUITE DE LA PRESTA EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta='.$presta.'&statut_epce='.$statut.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&nb='.$nb.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	elseif($stat==6)
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a  title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&id='.$id.'&id_ben='.$id_ben.'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td >'.$dat_3.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td>'.$faisabilite_ben[0].'</td><td align="right"><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td>'.$relance.'</td><td><input onclick="window.open(\'../../presta/epce/control.php?&id='.$id.'&id_ben='.$id_ben.'\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');"  type="button" value="Relancer" /></td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta=&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&mot='.$mot.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
		else
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&id='.$id.'&id_ben='.$id_ben.'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta='.$presta.'&statut_epce='.$statut.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&nb='.$nb.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
		
	
	}
	elseif(isset($mot))
	{
			if($stat==1)
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a title="Vérification du premier rendez-vous" onclick="window.open(\'../../presta/epce/premier_rdv.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&intitule='.$intitule.'&id='.$id.'&id_ben='.$id_ben.'\',\'PREMIER RENDEZ VOUS EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta='.$presta.'&statut_epce='.$statut.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&nb='.$nb.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	else if($stat==2)
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/suite_rdv.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&intitule='.$intitule.'&id='.$id.'&id_ben='.$id_ben.'\',\'SUITE DE LA PRESTA EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta='.$presta.'&statut_epce='.$statut.'&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&nb='.$nb.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	elseif($stat==6)
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a  title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&id='.$id.'&id_ben='.$id_ben.'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td >'.$dat_3.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td>'.$faisabilite_ben[0].'</td><td align="right"><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td>'.$relance.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta=&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&mot='.$mot.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	else
	{
		 $compteur++;
	echo'<tr  bgcolor="'.$color.'"   align="center" class="rows"><td>'.$compteur.'</td><td>'.$prestataire.'</td><td>'.$presta.'</td><td align="left"><a  title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?lc='.$lettre_de_commande.'&presta='.$presta.'&id_presta='.$id_presta.'&id='.$id.'&id_ben='.$id_ben.'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" ><font  onmouseover="this.style.color=\'#000\'" onmouseout="this.style.color=\'#4B91C9\'"   color="#4B91C9">'.$intitule.'</font></a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td >'.$dat_3.'</td><td>'.$dat_4.'</td><td>'.$this->rdv_pose($id_presta).'</td><td style="color:#093" >'.$this->rdv_acc($id_presta).'</td><td>'.$this->rdv_rej($id_presta).'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_presta).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben.'"/>'.$statut.'</td><td><a href="suivi.php?id_presta='.$id_presta.'&domain=default&presta=&ligne='.$ligne.'&nbr_resultat='.$limit.'&conseiller_id='.$id_ref.'&mot='.$mot.'&modifier=1"><img  border="0"  src="./images/edit.png" /></a></td></tr>';
	}
	}
		
		
		}
	
	
	}
		function nbr_presta_epce_relance($id,$presta,$id_ref,$limit,$ben,$date_deb="01/01/2009",$date_fin ,$signe)
	{
		if($date_fin==NULL)
		$date_fin=date('d/m/Y', strtotime("-12 week"));
		
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		
		$date_deb=explode("/",$date_deb);
		$date_fin=explode("/",$date_fin);
		
		if($id_ref==NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%"  '.$signe.' and intitule like "%'.$ben.'%" and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'" and relance=0 ';	
		
	}
	
			else if($id_ref!=NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and id_ref='.$id_ref.' '.$signe.' and statut like "Complete%"  and intitule like "%'.$ben.'%" and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 ';	
		
	}
	
			else if($id_ref!=NULL and $presta==NULL and $ben!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  id_ref='.$id_ref.' and statut like "Complete%"  '.$signe.' and intitule like "%'.$ben.'%" and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 ';	
		
	}
	
			else if($id_ref==NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'"  and  statut like "Complete%"  '.$signe.' and intitule like "%'.$ben.'%"  date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"   and relance=0 ';	
		
	}
			else if($id_ref==NULL and $presta==NULL and $ben!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  statut like "Complete%"  and intitule like "%'.$ben.'%" '.$signe.' and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0';	
		
	}
	
	else if($id_ref==NULL and $presta!=NULL)
	{
	
		$requete2='SELECT id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" '.$signe.' and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 ';	
		
	}
	else if($presta!=NULL and $id_ref!=NULL)
	{
		
			$requete2='SELECT id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" '.$signe.' and id_ref='.$id_ref.'  and  date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0  ';
	}
	else if($presta==NULL and $id_ref!=NULL)
	{
		
			$requete2='SELECT id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where statut like "Complete%" and id_ref='.$id_ref.'  '.$signe.' and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"   and relance=0  ';
	}

	else
	{
		
			$requete2='SELECT id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  statut like "Complete%" and date_fin>="'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" '.$signe.' and date_fin<="'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 ';
	}
//echo $requete2;
	$resultat2 = mysql_query($requete2) or die(mysql_error());
	return mysql_num_rows($resultat2);
	}

	function presta_epce_relance($id,$presta,$id_ref,$limit,$ben,$date_deb="01/01/2009",$date_fin,$signe,$tri="date_debut",$cla="asc")
	{
		
		if($date_fin==NULL)
		$date_fin=date('d/m/Y', strtotime("-12 week"));
		
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		
		$date_deb=explode("/",$date_deb);
		$date_fin=explode("/",$date_fin);
		
	
	
	if($id_ref==NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%"  '.$signe.'  and intitule like "%'.$ben.'%" and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'" and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
	
			else if($id_ref!=NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and id_ref='.$id_ref.' and statut like "Complete%"  '.$signe.' and intitule like "%'.$ben.'%" and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
	
			else if($id_ref!=NULL and $presta==NULL and $ben!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  id_ref='.$id_ref.' and statut like "Complete%"  and intitule like "%'.$ben.'%" '.$signe.'  and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
	
			else if($id_ref==NULL and $presta!=NULL and $ben!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'"  and  statut like "Complete%"  and intitule like "%'.$ben.'%"  '.$signe.' and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"   and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
			else if($id_ref==NULL and $presta==NULL and $ben!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  statut like "Complete%"  and intitule like "%'.$ben.'%" '.$signe.' and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
	
	else if($id_ref==NULL and $presta!=NULL)
	{
	
		$requete2='SELECT nb_relance,id_presta,statut,presta,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" '.$signe.'  and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0 order by '.$tri.' '.$cla.' limit '.$limit.'';	
		
	}
	else if($presta!=NULL and $id_ref!=NULL)
	{
		
			$requete2='SELECT nb_relance,id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" '.$signe.'  and  id_ref='.$id_ref.'  and  date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0  order by '.$tri.' '.$cla.' limit '.$limit.'';
	}
	else if($presta==NULL and $id_ref!=NULL)
	{
		
			$requete2='SELECT nb_relance,id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where statut like "Complete%" and id_ref='.$id_ref.' '.$signe.'  and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"   and relance=0  order by '.$tri.' '.$cla.' limit '.$limit.'';
	}

	else
	{
		
			$requete2='SELECT nb_relance,id_presta,presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where  statut like "Complete%" '.$signe.'  and date_fin>"'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'" and date_fin<"'.mktime(0,0,0,$date_fin[1],$date_fin[0],$date_fin[2]).'"  and relance=0  order by '.$tri.' '.$cla.' limit '.$limit.'';
	}



//echo $requete2;



	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat2))
		{
		
		$id_presta=$row['id_presta'];
		$id_ben = $row['id_ben'];
	$intitule=$row['intitule'];
	$statut=$row['statut'];
	$presta=$row['presta'];
	$date_debut=$row['date_debut'];
	$date_fin=$row['date_fin'];
	$id_ben=$row['id_ben'];
	$relance=$row['relance'];
	$nb_relance=$row['nb_relance'];
	$lettre_de_commande=$row['lettre_de_commande'];
	
	
	
		if($date_debut==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut);
		
	}
	
	if($date_fin==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin);
		
	}
	
	$lieu=explode("_",$this->rdv_lieu($intitule));
	
	
	$contact=$this->contact($id_ben);
	
	
		
		 
			if($compteur%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		
	
		
	
	 $compteur++;
	echo'<form onsubmit="confirm()" method="get" action="suivi_relance.php" /><input type="hidden" value="'.$limit.'" name="voir" /><input type="hidden" value="'.$id_ref.'" name="conseiller_id" /><input type="hidden" value="'.$id_presta.'" name="presta" /><input type="hidden" value="default" name="domain" /><tr  bgcolor="'.$color.'"  align="center" class="rows"><td>'.$compteur.'</td><td>'.$presta.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire"  onclick="window.open(\'../../presta/epce/control.php?id='.$id.'&lc='.$lettre_de_commande.'&id_presta='.$id_presta.'&id_ben='.$id_ben.'&continuer=0\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');"  target="_blank" >'.$intitule.'</a></td><td >'.$lettre_de_commande.'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td align="left">'.$this->rdv_referent($id_presta).'</td><td  align="left"  >'.$lieu[2].'</td><td>'.$contact[0].'</td><td>'.$contact[1].'</td><td>'.$contact[2].'</td><td align="left">'.$contact[3].'<input type="hidden" name="id_ben" value="'.$id_ben.'"/></td><td><font color=red>'.$nb_relance.'</font></td><td><input type="button" value="Voir" onclick="window.open(\'../../presta/epce/relance/suivi.php?id='.$id.'&id_presta='.$id_presta.'&id_ben='.$id_ben.'\',\'SUIVI DES RELANCES\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0,  width=1280, height=728\');" /></td></tr></form>';
	

		
		}
	
	
	}
	
		function presta_epce_relance_recontact($id,$presta,$id_ref,$limit)
	{
		
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		
		

	if($id_ref=="")
	{
	
			$requete='SELECT le,id_presta FROM egw_infolog where le<'.time().' and le!=0 and info_owner='.$id.'';
	}
	else
	{
		
			$requete='SELECT le,id_presta FROM egw_infolog where le<'.time().' and le!=0 ';
	}


$resultat = mysql_query($requete) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat))
		{
		
	$id_presta[]=$row['id_presta'];

	
		}
		
		for($i=0;$i<count($id_presta);$i++)
		{
		$req=$req.' or id_presta='.$id_presta[$i].'';
		}
		
		
			$requete='SELECT id_presta,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where (id_presta=0 '.$req.') and (statut like "Complete%" and relance=0)  ';
		//echo $requete;
	$resultat = mysql_query($requete) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat))
		{
		$id_presta[]=$row['id_presta'];
	$intitule[]=$row['intitule'];
	$statut[]=$row['statut'];
	$date_debut[]=$row['date_debut'];
	$date_fin[]=$row['date_fin'];
	$id_ben[]=$row['id_ben'];
	$relance[]=$row['relance'];
	$lettre_de_commande[]=$row['lettre_de_commande'];
		}
		
		for ($i=0;$i<count($intitule);$i++)
		{
		if($date_debut[$i]==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut[$i]);
		
	}
	
	if($date_fin[$i]==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin[$i]);
		
	}
	
	$lieu=explode("_",$this->rdv_lieu($intitule[$i]));
	
	
	$contact=$this->contact($id_ben[$i]);
	
	
		 $compteur++;
	echo'<form onsubmit="confirm()" method="get" action="suivi_relance.php" /><input type="hidden" value="'.$limit.'" name="voir" /><input type="hidden" value="'.$id_ref.'" name="conseiller_id" /><input type="hidden" value="'.$presta.'" name="presta" /><input type="hidden" value="default" name="domain" /><tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire"  onclick="window.open(\'../../presta/epce/control.php?id='.$id.'&lc='.$lettre_de_commande[$i].'&id_presta='.$id_presta[$i].'&id_ben='.$id_ben[$i].'&continuer=0\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');"  target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td>'.$contact[0].'</td><td>'.$contact[1].'</td><td>'.$contact[2].'</td><td align="left">'.$contact[3].'<input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/></td><td><font color=red>'.$this->nbre_relance($id_ben[$i]).'</font></td><td><input type="button" value="Voir" onclick="window.open(\'../../presta/epce/control.php?id='.$id.'&lc='.$lettre_de_commande[$i].'&id_presta='.$id_presta[$i].'&id_ben='.$id_ben[$i].'&continuer=0\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" /> </td></tr></form>';
	
		
		
		}
	
	
	}

	function rdv_pose($id_presta)
	{
		$requete='SELECT cal_id FROM  egw_cal  where id_presta='.$id_presta.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		if(mysql_num_rows($resultat)!=0)
		{
		return mysql_num_rows($resultat);
		}
		
	}
	function rdv_referent($id_presta)
	{
		$requete='SELECT id_ref FROM  egw_prestation  where id_presta="'.$id_presta.'" order by id_presta desc limit 1';
	
		$resultat = mysql_query($requete) or die(mysql_error());
			while($row = mysql_fetch_array($resultat))
		{
			$id_ref=$row['id_ref'];
			
			
		}

		// spirea - changement parce account_firstname n'existe plus...
		// $requete='SELECT account_firstname,account_lastname FROM  egw_accounts  where account_id='.$id_ref.'';
		$requete='SELECT account_lid FROM  egw_accounts  where account_id='.$id_ref.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_lid=$row['account_lid'];
			
		}
		
		// return $account_firstname.' '.$account_lastname;
		return $account_lid;
		
	}
	
		function rdv_referent_id($intitule)
	{
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		if($cal_id!=NULL)
		{
		$requete='SELECT cal_user_id FROM  egw_cal_user  where cal_id='.$cal_id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_user_id=$row['cal_user_id'];
			
		}
		
		
		
		return $cal_user_id;
		}
		else
		{}
	}
	
	function rdv_lieu($intitule)
	{
		$requete='SELECT cal_category FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_category=$row['cal_category'];
			
		}
		if($cal_category!=NULL)
		{
		$requete='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category.'%" order by cat_id asc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cat_name=$row['cat_name'];
			
		}
		
	
		return $cat_name;
		}
		else
		{}
	}
	function rdv_der($intitule)
	{
		
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';

		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		
		$requete='SELECT cal_start FROM  egw_cal_dates where cal_id='.$cal_id.' order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_start=$row['cal_start'];
			
		}
		
		if($n>=4)
		{
		return $cal_start;
		
		}
		
		}
		else
		{
		//return 'aucune date';
		}
	}
	function rdv_acc($id_presta)
	{
		
		$requete='SELECT cal_id FROM  egw_cal  where id_presta='.$id_presta.'';

		$resultat = mysql_query($requete) or die(mysql_error());
			$x=mysql_num_rows($resultat);
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			
		}
		
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		$req=NULL;
		
		for($i=0;$i<count($cal_id);$i++)
		{
			$req=$req.' or cal_id='.$cal_id[$i];
		}
		
		
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.')  and (cal_status="A")';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);

		
		
		return $n;
		
		}
		
	}
	function rdv_rej($id_presta)
	{
		$requete='SELECT cal_id FROM  egw_cal  where id_presta='.$id_presta.'';

		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			
		}
		
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		$req=NULL;
		
		for($i=0;$i<count($cal_id);$i++)
		{
			$req=$req.' or cal_id='.$cal_id[$i];
		}
		
		
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.')  and (cal_status="R")';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);

	
		
		
		return $n;
		
		}
		
	}
	

	function contact($id)
	{
		$requete='SELECT * FROM  egw_contact  where id_ben='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$tel_work=$row['tel_pro_1'];
			$tel_home=$row['tel_domicile_1'];
			$tel_cell=$row['portable_perso'];
			$email=$row['email_pro'];
			$email_home=$row['email_perso'];
			
		}
		return array($tel_work,$tel_home,$tel_cell,$email_home,$email);
	}
	function montant_previsionnel($nbre_rdv)
	{
		if($nbre_rdv==4)
		$nbre_rdv=6;
		if($nbre_rdv==3)
		$nbre_rdv=4;
		if($nbre_rdv==2)
		$nbre_rdv=3;
		if($nbre_rdv==1)
		$nbre_rdv=2;
		return (290/6) * $nbre_rdv;
	
	}
	function faisabilite($id_presta)
	{
		
		
		
		$requete='SELECT avis1,avis2 FROM  egw_epce_bilan_avis  where id_presta='.$id_presta.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$avis1=$row['avis1'];
			$avis2=$row['avis2'];
		}
		
		
/*	if($avis1=='1')
{
$po='Negatif';
}

elseif($avis1=='2')
{
$po='Positif sous reserve';
}
elseif($avis1=='3')
{
$po='Positif';
}
elseif($avis1=='4')
{
$po='Solution alternative';
}
else
{
$po='?';
}*/
return array($avis1,$avis2);
	}

/*	function estimation($id)
	{
		
		
		
		$requete='SELECT avis2 FROM  egw_epce_bilan_avis  where id_beneficiaire='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$avis2=$row['avis2'];
			
		}
		
		
if($avis2=='1')
{
$six='6 mois a 1 an';
}
elseif($avis2=='2')
{
$six='3 a 6 mois';
}
elseif($avis2=='3')
{
$six='Inferieur a 3 mois';
}
else
{
$six='?';
}
return $six;
	}
	*/
	
	function alternative($id_presta)
	{
		
		
		
		$requete='SELECT code_rome FROM  egw_epce_bilan_avis  where id_presta='.$id_presta.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$code_rome=$row['code_rome'];
			
		}
		
		if(strlen($code_rome)>=2)
		{
			return '<img title="Solution alternative proposée" src="images/tick_16.png"/>';
		}
		else
		{
			return '';
		}


	}
	function maj_statut($id,$statut)
	{
	
					  
	$requete = "Update egw_prestation set statut='$statut'  where id_ben=$id";
	
	$resultat = mysql_query($requete) or die(mysql_error());
		
	}
	function statut_auto($id_presta,$date_fin)
	{
	
		
	if($date_fin<time() and $date_fin!=0 )
	{	
		
		
			$requete='Update egw_prestation set statut="A cloturer" where id_presta='.$id_presta.'  and  statut="En cours" ';
			//echo $requete;
			$resultat = mysql_query($requete) or die(mysql_error());
			
		
		
	}

		
	}
		function selectionner_conseiller3($conseiller_id='',$group)
	{
		if($conseiller_id!=NULL and is_numeric($conseiller_id))
		{
		echo'<select name="conseiller_id">';
		
						
	$requete='SELECT * FROM  egw_accounts  where account_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
			$account_lid=$row['account_lid'];
		    $account_id=$row['account_id'];
		}
		
		// echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
		echo'<option value='.$account_id.'>'.$account_lid.'</option>';
		
		}
		elseif($conseiller_id!=NULL and !is_numeric($conseiller_id))
		{
		echo'<select   name="conseiller_id"><option selected="selected" value="'.$conseiller_id.'">'.$conseiller_id.'</option>';
		}
		else
		{
		echo'<select name="conseiller_id"><option value="0">Tous les conseillers</option>';
		}
		echo'<option  style="background-color: #F60; color:#FFF" value="Tous les prestataires">Tous les prestataires</option>';
		echo'<option  style="background-color: #75B4D2; color:#FFF" value="APSIE">APSIE</option>';
	// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_firstname asc';
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_lid asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_lid=$row['account_lid'];
		    $account_id=$row['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
		}
		echo'<option  style="background-color: #75B4D2; color:#FFF" value="AGROFORM">AGROFORM</option>';
	// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_agroform.'    order by account_firstname asc';
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_agroform.'    order by account_lid asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_lid=$row['account_lid'];
		    $account_id=$row['account_id'];
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			// echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
#				echo'<option style="background-color: #75B4D2; color:#FFF" value="STRAGEFI">STRAGEFI</option>';
#	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_stragefi.'   order by account_firstname asc';
#	$resultat = mysql_query($requete) or die(mysql_error());
#		
#		while($row = mysql_fetch_array($resultat))
#		{
#			
#			$account_firstname=$row['account_firstname'];
#			$account_lastname=$row['account_lastname'];
#		    $account_id=$row['account_id'];
#			
#			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
#			
#		}
		
		
		echo'</select>';
	}
	
		
		function selectionner_conseiller($conseiller_id)
	{
		
		if($conseiller_id!=NULL)
		{
		/*$requete='SELECT account_firstname,account_lastname,account_id FROM  egw_accounts  where  account_id='.$conseiller_id.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<select name="conseiller_id"><option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}*/
		echo'<select name="conseiller_id"><option value="0"></option>';
		}
		else
		{
		echo'<select name="conseiller_id"><option value="0">Tous les conseillers</option>';
		}
		
		
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and (account_primary_group='.$this->id_group_apsie.' or account_primary_group='.$this->id_group_stragefi.' or account_primary_group='.$this->id_group_agroform.')   order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			$account_lid = $row['account_lid'];			
	
			// echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
		}
		
		echo'</select>';
	}
	
	function epce_stats($statut,$id_ref,$presta='EPCE')
	{
		
			$date_deb=$this->exercice;
	 
	
	if($date_deb=='all')
	{
		
		if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires")
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" ';
		}
		elseif(!is_numeric($id_ref) and $id_ref!=NULL)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and prestataire like "%'.$id_ref.'%"';
		}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and id_ref='.$id_ref.'';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" ';
		}
	}
	else
	{
		
		if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires")
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).') ';
		}
		elseif(!is_numeric($id_ref) and $id_ref!=NULL)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and prestataire like "%'.$id_ref.'%" and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).') ';
		}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and id_ref='.$id_ref.' and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).') ';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" and statut like "%'.$statut.'%" and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).') ';
		}
		
		
	}
	

	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	

	
		
		return mysql_num_rows($resultat2);
		
	
		
		
	}
	function epce_stats_total($id_ref,$presta='')
	{
		$date_deb=$this->exercice;
	
	if($date_deb=='all')
	{
		
			if($presta==NULL)
	{
		
		if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires")
		{
		$requete2='SELECT intitule FROM  egw_prestation';
		}
		elseif(!is_numeric($id_ref) and $id_ref!=NULL)
		{
		$requete2='SELECT intitule FROM  egw_prestation where prestataire like "%'.$id_ref.'%"';
		}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation where id_ref='.$id_ref.'';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  ';
		}
		
		}
		else
		{
			
			if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires")
			{
				$requete2='SELECT intitule FROM  egw_prestation  where  presta="'.$presta.'" ';
			}
			elseif(!is_numeric($id_ref) and $id_ref!=NULL)
			{
				$requete2='SELECT intitule FROM  egw_prestation  where  presta="'.$presta.'" and  prestataire like "%'.$id_ref.'%" ';
			}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where  presta="'.$presta.'" and  id_ref='.$id_ref.' ';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'" ';
		}
		}
		
	}
	
	else
	{
	if($presta==NULL)
	{
		if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires")
		{
		$requete2='SELECT intitule FROM  egw_prestation where prestataire like "%'.$id_ref.'%" and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).')';
		}
		elseif(!is_numeric($id_ref) and $id_ref!=NULL)
		{
		$requete2='SELECT intitule FROM  egw_prestation where prestataire like "%'.$id_ref.'%" and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).')';
		}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation where id_ref='.$id_ref.'  and  date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).')';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation   where date_debut>='.mktime(0,0,0,1,1,$date_deb).' and (date_debut<'.mktime(0,0,0,1,1,($date_deb+1)).') ';
		}
		
		}
		else
		{
		
		if(!is_numeric($id_ref) and $id_ref!=NULL and $id_ref=="Tous les prestataires"  )
		{
			$requete2='SELECT intitule FROM  egw_prestation  where   prestataire like "%'.$id_ref.'%" and  presta="'.$presta.'" and  date_debut>="'.mktime(0,0,0,1,1,$date_deb).'" and date_debut<"'.mktime(0,0,0,1,1,($date_deb+1)).'"  ';
		}
		elseif(!is_numeric($id_ref) and $id_ref!=NULL)
		{
			$requete2='SELECT intitule FROM  egw_prestation  where   prestataire like "%'.$id_ref.'%" and  presta="'.$presta.'" and  date_debut>="'.mktime(0,0,0,1,1,$date_deb).'" and date_debut<"'.mktime(0,0,0,1,1,($date_deb+1)).'"  ';
		}
		elseif($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where  presta="'.$presta.'" and  id_ref='.$id_ref.' and  date_debut>="'.mktime(0,0,0,1,1,$date_deb).'" and date_debut<"'.mktime(0,0,0,1,1,($date_deb+1)).'"  ';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="'.$presta.'"  and  date_debut>="'.mktime(0,0,0,1,1,$date_deb).'" and date_debut<"'.mktime(0,0,0,1,1,($date_deb+1)).'" ';
		}
		}
		
	}
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	

	
		
		return mysql_num_rows($resultat2);
		
	
		
		
	}
	function epce_relance($id_ref)
	{
		
		if($id_ref!=0)
		{
	$requete='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "Complete%" and id_ref='.$id_ref.'  and date_fin<'.(time()-7776000).' and relance=0';
		}
		else
		{
			$requete='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "Complete%"  and date_fin<'.(time()-7776000).'  and relance=0';
		}
		
		
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
	

	
	return mysql_num_rows($resultat);
	}
		


			function pourcentage_epce($id_presta)
	{
		
		$requete='SELECT * FROM  egw_epce_validation  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
		
		    $plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
			
		
		
		}
		return	round((($plan + $coherence + $commerciaux + $financier +$juridique+$bilan)/6)*100,1);
	}
		
		
	function voir_validation($id)
	{
		
		$requete='SELECT * FROM  egw_epce_validation  where id_beneficiaire='.$id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
			
		
		while($row = mysql_fetch_array($resultat))
		{
			$plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
			$epce=$row['epce'];
			
		}	
		return $epce;
				
	
	}
	
	
	

	 function get_id_ben()
	{
		$requete='SELECT intitule FROM  egw_prestation order by id_ben desc';
		//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$intitule[]=$row['intitule'];
		}
		
		
		for($i=0;$i<count($intitule);$i++)
		{
			
		$civil=explode(" ",$intitule[$i]);
		$civil[0];
		$civil[1];
		$civil[2];
		
		if($civil[2]!=NULL)
		{
		$requete_='SELECT id_ben FROM  egw_contact  where nom="'.$civil[0].' '.$civil[1].'" and prenom="'.$civil[2].'" limit 1 ';
		}
		else if($civil[2]==NULL)
		{
		$requete_='SELECT id_ben FROM  egw_contact  where nom="'.$civil[0].'" and prenom="'.$civil[1].'" limit 1 ';
		}
		
		
		//echo $requete_;
		$resultat_ = mysql_query($requete_) or die(mysql_error());
		while($row = mysql_fetch_array($resultat_))
		{
			$id=$row['id'];
			
			if($id!=NULL)
		{
		
	$requete = 'Update egw_prestation set id_ben='.$id.' where intitule="'.$intitule[$i].'"';
	$resultat = mysql_query($requete) or die(mysql_error());
	//echo $requete;
	//return 'Nombre de modification :'.$compteur++;
		
		}
		
		
		
		}
		
		}
	
	
	}
	
	
	
	 function maj_link_rdv()
	{
		$requete='SELECT * FROM  egw_cal where cal_title like "%EPC93%" order by cal_id desc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_title[]=$row['cal_title'];
			$cal_id[]=$row['cal_id'];
			
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$title=explode("_",$cal_title[$i]);
		
		$civil=explode(" ",$title[2]);
		
		
		
		
		$requete_='SELECT id_ben FROM  egw_contact  where nom="'.$civil[0].'" and prenom="'.$civil[1].'" limit 1';
	//echo $requete_;
		$resultat_ = mysql_query($requete_) or die(mysql_error());
		while($row = mysql_fetch_array($resultat_))
		{
			$id=$row['id'];
			
		if($id!=NULL)
		{
		$requete ='DELETE FROM egw_links where link_app1="calendar" and link_app2="addressbook" and link_id2="'.$id.'" and link_id1="'.$cal_id[$i].'" ';
	$resultat = mysql_query($requete) or die(mysql_error());
	
	$requete = 'insert into egw_links value("","calendar","'.$cal_id[$i].'","addressbook","'.$id.'","","","13")';
	$resultat = mysql_query($requete) or die(mysql_error());
	//echo mysql_num_rows($resultat);
	//return 'Nombre de modification :'.$compteur++;
		}
		
		}
			
	
	}
	
	}
	function nbre_relance($id_ben)
	{
	
		$requete='SELECT id_ben FROM egw_infolog where id_ben='.$id_ben.'';
	
		$resultat= mysql_query($requete) or die(mysql_error());
		return mysql_num_rows($resultat);
		
			
	}
	function nbre_recontact($id="")
	{
	
	if($id!=NULL)
	{
		$requete='SELECT le FROM egw_infolog where le<'.time().' and le!=0 and info_owner='.$id.'';
	}
	else
	{
		$requete='SELECT le FROM egw_infolog where le<'.time().' and le!=0';
	}
	
	
		$resultat= mysql_query($requete) or die(mysql_error());
		return mysql_num_rows($resultat);
		
			
	}
function selectionner_conseiller2($id='')
	{
		echo'<select name="conseiller_id">';
		
		if($id!=NULL)
		{
					
	$requete='SELECT * FROM  egw_accounts  where account_id='.$id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			$account_lid = $row['account_lid'];
		}
		echo'<option value='.$account_id.'>'.$account_lid.'</option>';
		echo'<option value="">Tous les conseillers</option>';
		}
		
		else
		{
			echo'<option value="">Tous les conseillers</option>';
		
		}
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and (account_primary_group='.$this->id_group_apsie.' or account_primary_group='.$this->id_group_stragefi.' or account_primary_group='.$this->id_group_agroform.')   order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			$account_lid = $row['account_lid'];
				
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
		}
		
		echo'</select>';
	}
	
	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>
