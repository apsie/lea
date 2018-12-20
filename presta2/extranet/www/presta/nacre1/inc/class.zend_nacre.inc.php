<?php


class zend_nacre
{
	
	public $cat_id_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_contact_prescripteur ;
	public $cat_id_formation ;
	public $cat_id_certification ;
	public $cat_id_employeur;
	public $usager_annee;
	public $compteur_date = 0;
	public $cal_id_rejete=109;
	public $db;
	public $table_contact = 'egw_contact';
	public $table_parcours_pro = 'egw_contact_parcours_pro';
	public $table_etat_civil = 'egw_contact_etat_civil';
	public $table_projet = 'egw_projet';
	public $table_dispositif = 'egw_dispositif';
	public $table_cal_dates = 'apsie_cal_dates';
	public $table_cal_user= 'egw_cal_user';
	public $table_cal= 'apsie_cal';
	public $table_prestation = 'egw_prestation';
	public $table_formation = 'egw_contact_formation';
	public $table_organisation = 'egw_organisation';
	public $table_projet_organisation ='apsie_resacc';
	public $table_validation ='egw_epce_validation';
	public $table_nacre_preliminaire ='egw_nacre_preliminaire';
	// constructeur 
	function __construct()
	{

	
		
	include('config/config.php');
    $this->db = $db;
				



	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	 function return_nbr_by_organisme($nom_organisme)
	{
		
	   $requete='SELECT * FROM  '.$this->table_organisation.'  where nom_organisme ="'.$nom_organisme.'"';
	  
	
		$result=$this->db->fetchRow($requete);
       $requete2='SELECT * FROM  '.$this->table_contact.'  where id_organisation like "%'.$result['id_organisation'].'%"' ;
	$result2=$this->db->fetchAll($requete2);
	if($result['id_organisation']!=NULL and $result['id_organisation']!=0)
	{
	return count($result2);
	}
	
	}
	function afficher_employeurs($choix)
	{
		

	echo' 
<table  width="100%">
  <tr style="background-color:#1c1c1c; height:25px; " ><td width="8%">Date</td><td width="20%" height="21" class="titre2">Intitule du poste</td><td width="9%" >Service</td><td width="4%" >Statut</td><td width="4%" >Identifiant</td><td width="5%" >Contrat</td><td width="7%" >Contrat aide</td><td width="4%">Type.R</td><td width=8%">Remuneration</td><td width="8%">Qualifiquation</td><td width="3%">T.</td><td width="7%">Deplacement</td><td width="15%">Organisme</td></tr>';

		$requete='SELECT * FROM  '.$this->table_parcours_pro.'  WHERE id_ben='.$choix.'';
		$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
		
		
		
			if($result[$i]['organisme']!=NULL)
			{
			$nbr='('.$this->return_nbr_by_organisme($result[$i]['organisme']).')';
			}
			else
			{
			$nbr=NULL;
			}
			
			if($result[$i]['date_debut']!=0)
			{$dat1=date('d/m/y',$result[$i]['date_debut']);}
			else
			{$dat1=NULL;}
			
				if($result[$i]['date_fin']!=0)
			{$dat2='-'.date('d/m/y',$result[$i]['date_fin']);}
			else
			{$dat2=NULL;}
			
			
			if($result[$i]['temps_travail']!=NULL)
			{$heure_t=$result[$i]['temps_travail'].' H';}
			else
			{$heure_t=NULL;}
			
			if($result[$i]['montant_remuneration']!=NULL)
			{
			$montant_num=$result[$i]['montant_remuneration'].' euros';
			}
			else
			{
				$montant_num=NULL;
			}
			echo' <tr ><td >'.$dat1.$dat2.'</td><td   class="titre2"><strong>'.utf8_encode($result[$i]['poste']).'</strong></td><td >'.$result[$i]['service'].'</td><td  >'.$result[$i]['statut'].'</td><td  >'.$result[$i]['identifiant'].'</td><td  >'.$result[$i]['type_contrat'].'</td><td  >'.$result[$i]['type_contrat_aide'].'</td><td >'.$result[$i]['type_remuneration'].'</td><td >'.$montant_num.'</td><td >'.$result[$i]['qualification'].'</td><td >'.$heure_t.'</td><td >'.utf8_encode($result[$i]['mobilite']).'</td><td ><a href="javascript::void();" onclick="window.open(\'fiche_organisme.php?cat_organisme=employeur&nom_organisme='.addslashes(utf8_encode($result[$i]['organisme'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=200px, width=800, height=800\');">'.utf8_encode($result[$i]['organisme']).'</a> '.$nbr.'</a></td></tr>';
		
		}
		echo'</table><br/><br/><br/>';
		
		

	}
function afficher_formation($id_ben)
	{
		
	


			echo'
<table  width="100%">
  <tr style="background-color:#1c1c1c; height:25px; " ><td width="10%">Statut</td><td width="10%">Type de la formation</td><td width="14%">Niveau</td><td >Intitule du diplome</td><td width="6%" >Resultat</td><td width="10%">Date debut</td><td width="10%">Date fin</td><td width="12%">Organisme formation</td><td width="12%">Organisme certification</td></tr>';
  
		$requete="SELECT * FROM  ".$this->table_formation."  WHERE id_ben=$id_ben order by id_formation desc";
		$result=$this->db->fetchAll($requete);
	
		for($i=0;$i<count($result);$i++)
		{
			
			if($result[$i]['organisme_certification']!='')
			{
			$nbr_cert='('.$this->return_nbr_by_organisme($result[$i]['organisme_certification']).')';
			}
			else
			{
			$nbr_cert=NULL;
			}
			if($result[$i]['organisme_formation']!=NULL)
			{
			$nbr_form='('.$this->return_nbr_by_organisme($result[$i]['organisme_formation']).')';
			}
			else
			{
			$nbr_form=NULL;
			}
			echo'<tr><td>'.utf8_encode($result[$i]['statut_formation']).'</td><td width="10%">'.$result[$i]['type_formation'].'</td><td width="14%">'.$result[$i]['niveau_formation'].'</td><td width="18%" height="21" class="titre2">'.utf8_encode($result[$i]['intitule_formation']).'</td><td width="6%" >'.$result[$i]['resultat_formation'].'</td><td width="10%">'.$result[$i]['date_debut'].'</td><td width="10%">'.$result[$i]['date_fin'].'</td><td ><a href="javascript::void();" onclick="window.open(\'fiche_organisme.php?nom_organisme='.addslashes(utf8_encode($result[$i]['organisme_formation'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=200px, width=800, height=800\');">'.utf8_encode($result[$i]['organisme_formation']).'</a> '.$nbr_form.'</td><td ><a href="javascript::void();" onclick="window.open(\'fiche_organisme.php?nom_organisme='.addslashes(utf8_encode($result[$i]['organisme_certification'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=200px, width=800, height=800\');">'.utf8_encode($result[$i]['organisme_certification']).'</a> '.$nbr_cert.'</td></tr>';
		}
	echo'</table>';
	}
	
	function return_variable($id_presta)
	{
	
	
		$requete="SELECT * FROM  ".$this->table_nacre_preliminaire."  WHERE id_presta=$id_presta";
		$result=$this->db->fetchRow($requete);
		return array($result['personnalite_createur'],$result['caracteri_pt_fort1'],$result['caracteri_pt_fort2'],$result['caracteri_pt_fort3'],$result['caracteri_pt_fort4'],$result['caracteri_pt_fort5'],$result['caracteri_pt_faible1'],$result['caracteri_pt_faible2'],$result['caracteri_pt_faible3'],$result['caracteri_pt_faible4'],$result['caracteri_pt_faible5'] , $result['ameliorer_pt1'],$result['ameliorer_pt2'],$result['ameliorer_pt3'],$result['ameliorer_pt4'],$result['ameliorer_pt5'],$result['motivation_createur'] ,$result['exp_pro_secteur'],$result['formation'],$result['acquis_extraprof'],$result['contraintes_perso'],$result['contraintes_projet'],$result['projet_defini_com'],$result['produit_defini_com'],$result['produit_listes_com'],$result['marche_determine_com'],$result['clientele_ciblee_com'],$result['fournisseurs_identifies_com'],$result['concurrence_identifiee_com'],$result['strategie_commerciale_com'],$result['stock_initial_com'],$result['prix_revient_com'],$result['px_vente_fix_com'],$result['quantites_vendues_com'],$result['ca_calcule_com'],$result['charges_activite_com'],$result['cpte_exploitation_com'],$result['plan_tresorerie_com'],$result['point_mort_calcule_com'],$result['seuil_rentabilite_com'],$result['investissement_defini_com'],$result['cout_chiffrecom'],$result['montant_apport_com'],$result['projet_financements_com'],$result['montant_besoin_com'],$result['lieu_implantation_com'],$result['local_necessaire_com'],$result['local_trouve_com'],$result['nb_emplois_crees_com'],$result['nb_emplois_salaries_com'],$result['statut_createur_com'],$result['statut_juridique_com'],$result['demarches_entamees_com'],$result['regime_fiscal_com'],$result['projet_redige_com'],$result['projet_defini'],$result['produit_defini'],$result['produit_listes'],$result['marche_determine'],$result['clientele_ciblee'],$result['fournisseurs_identifies'],$result['concurrence_identifiee'],$result['strategie_commerciale'],$result['stock_initial'],$result['prix_revient'],$result['px_vente_fix'],$result['quantites_vendues'],$result['ca_calcule'],$result['charges_activite'],$result['cpte_exploitation'],$result['plan_tresorerie'],$result['point_mort_calcule'],$result['seuil_rentabilite'],$result['investissement_defini'],$result['cout_chiffre'],$result['montant_apport'],$result['projet_financements'],$result['montant_besoin'],$result['lieu_implantation'],$result['local_necessaire'],$result['local_trouve'],$result['nb_emplois_crees'],$result['nb_emplois_salaries'],$result['statut_createur'],$result['statut_juridique'],$result['demarches_entamees'],$result['regime_fiscal'],$result['projet_redige'],$result['etapes_adequation'],$result['etapes_etude_eco'],$result['etapes_etude_financ'],$result['etapes_etude_jurid'],$result['etapes_montage'],$result['etapes_creation'],$result['commentaires'],$result['adequation_validation'],$result['etude_economique'],$result['etude_financiere'],$result['ej_montage_creation']);
	}
	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>