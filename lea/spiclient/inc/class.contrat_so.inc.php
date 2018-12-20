<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaClient - Ce logiciel est un programme informatique servant à la gestion de clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	


class contrat_so extends so_sql{

	var $spiclient_client='spiclient';
	var $spiclient_relations='spiclient_relations';
	var $spiclient_type_contrat='spiclient_contrats_type';
	var $spiclient_statut_contrat='spiclient_contrats_status';
	var $spiclient_contrat='spiclient_contrats';
	var $spiclient_role = 'spiclient_roles';
	var $spiclient_contrats_member = 'spiclient_contrats_member';
	var $spiclient_contrats_budget = 'spiclient_contrats_budget';

	var $spireapi_facture_categories = 'spireapi_facture_categories';
	
	var $so_client;
	var $so_clients_relations;
	var $so_contrat;
	var $so_type_contrat;
	var $so_statut_contrat;
	var $so_member;
	var $so_budget;
	var $so_facture_categories;

	var $account_id;
	var $app_title;
	
	
	function contrat_so(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function __construct(){
	/**
	*Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spiclient']['title'];
		
		parent::__construct('spiclient',$this->spiclient_contrat,null,'',true);
		
		$this->so_client = new so_sql('spiclient',$this->spiclient_client);
		$this->so_type_contrat = new so_sql('spiclient',$this->spiclient_type_contrat);
		$this->so_clients_relations = new so_sql('spiclient',$this->spiclient_relations);
		$this->so_statut_contrat = new so_sql('spiclient',$this->spiclient_statut_contrat);
		$this->so_role = new so_sql('spiclient', $this->spiclient_role);
		$this->so_member = new so_sql('spiclient', $this->spiclient_contrats_member);
		$this->so_budget = new so_sql('spiclient', $this->spiclient_contrats_budget);
		$this->so_facture_categories = new so_sql('spireapi', $this->spireapi_facture_categories);
	}

	function is_admin($account_id=null)
	{
	/**
	 * Vérifie si l'utilisateur est un administrateur (si il peut modifier les comptes)
	 *
	 * Nous véfions si les ACL pour les utilisateurs ayant les doits de modification, de la même manière que les administrateurs font pour gérer les comptes
	 *
	 * @param array $account_id=NULL pour un usage prochain, quand les administrateurs ne seront plus administrateurs sur tous les comptes
	 * @return boolean
	 */
		return isset($GLOBALS['egw_info']['user']['apps']['admin']);
	}
	
	function construct_search($search){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search critère à rechercher
	 * @return array
	 */
		$tab_search=array();
		foreach((array)$this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}
	
	function truncate($string, $limit=90, $break="-", $pad="...") { 
		// return with no change if string is shorter than $limit 
		if(strlen($string) <= $limit) return $string; 
		
		
		$string = substr($string, 0, $limit) . $pad; 

		return $string; 
	}
}


?>