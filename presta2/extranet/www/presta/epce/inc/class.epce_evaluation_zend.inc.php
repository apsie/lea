<?php


class evaluation_zend
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
	public $table_cal_dates = 'egw_cal_dates';
	public $table_cal_user= 'egw_cal_user';
	public $table_cal= 'egw_cal';
	public $table_prestation = 'egw_prestation';
	public $table_formation = 'egw_contact_formation';
	public $table_organisation = 'egw_organisation';
	public $table_projet_organisation ='egw_resacc';
	
	public $table_validation ='egw_epce_validation';
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
	
	function verification_validation($id_presta)
	{
		$requete = ' Select * from '.$this->table_validation.' where id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		return array($result['plan'],$result['coherence'],$result['commerciaux'],$result['financier'],$result['juridique']);
		
	
	
	}
	
	function update_date_fin_reelle($id_presta)
	{
		$data = array("date_fin_reelle"=>time(),"date_envoi_bilan"=>time());
		$this->db->update($this->table_prestation,$data,'id_presta='.$id_presta);
	}
	
	function update_des_projet($id_ben,$des)
	{
		$data = array("description_projet"=>$des);
		$this->db->update($this->table_projet,$data,'id_ben='.$id_ben);
	}

	/*function tranfert_epce_nacre1($id_presta)
	{
	
	$requete = 'select * from egw_epce_coherence_hp where id_presta='.$id_presta.'';
	$result=$this->db->fetchRow($requete);
	
	$data (
	}*/
	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>