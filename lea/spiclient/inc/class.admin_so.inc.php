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


class admin_so extends so_sql{
	
	var $account_id;
	var $app_title;
	
	var $spiclient_type_client = 'spiclient_type_client';
	var $spiclient_relations ='spiclient_relations';
	var $spiclient = 'spiclient';

	var $so_clients_relations;
	var $so_type_client;
	var $so_client;
	var $so_role;
	
	
	function admin_so(){
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
		
		$this->so_type_client = new so_sql('spiclient', $this->spiclient_type_client);
		$this->so_clients_relations = new so_sql('spiclient',$this->spiclient_relations);
		$this->so_client = new so_sql('spiclient',$this->spiclient);
		$this->so_address = new so_sql('spiclient','spiclient_address');
		$this->so_role = new so_sql('spiclient', 'spiclient_roles');
		$this->so_statut_contrat = new so_sql('spiclient','spiclient_contrats_status');

		$this->so_contact = new so_sql('phpgwapi', 'egw_addressbook');
		
		parent::__construct();		
	}
	
	function construct_search($search){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		foreach((array)$this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}
}


?>