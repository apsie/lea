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


class zone_so extends so_sql{

	var $spiclient_client = 'spiclient';
	var $spiclient_zone = 'spiclient_zones';
	
	var $so_client;

	var $account_id;
	var $app_title;
	
	
	function zone_so(){
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
		
		parent::__construct('spiclient',$this->spiclient_zone,null,'',true);
		
		//Instance sur la table client
		$this->so_client =& CreateObject('etemplate.so_sql');
		$this->so_client->so_sql('spiclient',$this->spiclient_client);
		
	}

	function is_admin($account_id=null)
	{
	/**
	 * Vérifie si l'utilisateur est un administrateur (si il peut modifier les comptes)
	 *
	 * Nous véfions si les ACL pour les utilisateurs ayant les doits de modification, de la même manière que les administrateurs font pour gérer les comptes
	 *
	 * @param array $account_id=null pour un usage prochain, quand les administrateurs ne seront plus administrateurs sur tous les comptes
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
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		foreach((array)$this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}
	
	function get_zone(){
	/**
	 * Retourne le tableau des zones
	 * 
	 * Le tableau ainsi crée fait correspondre l'identifiant des zones et leur nom
	 *
	 * @return array
	 */
		$parent=$this->search('','zone_id,zone_label','zone_label');
		$parents=array();
		if(!empty($parent)){
			foreach((array)$parent as $id=>$value){
				$parents[$value['zone_id']]=$value['zone_label'];
			}
		}
		return $parents;
	}
	
	function get_zone_parent(){
	/**
	 * Retourne le tableau des zones pères de la zone en cours
	 * 
	 * Le tableau ainsi crée fait correspondre l'identifiant des zones et leur nom
	 *
	 * @return array
	 */
		$parent=$this->search(array('zone_parent'=>'0'),'zone_id,zone_label','zone_label');
		$parents=array();
		if(!empty($parent)){
			foreach((array)$parent as $id=>$value){
				$parents[$value['zone_id']]=$value['zone_label'];
			}
		}
		return $parents;
	}
	
	function get_zone_level($zone_id){
	/**
	 * Retourne le niveau de la zone passée en argument
	 *
	 * @param int $zone_id identifiant de la zone à examiner
	 * @return int
	 */
		$parent=$this->read(array('zone_id'=>$zone_id),'zone_level');
		return $parent['zone_level'];
	}
	
	function id2name($zone_id){
	/**
	 * Retourne le nom de la zone passée en argument
	 *
	 * @param int $zone_id identifiant de la zone à examiner
	 * @return string
	 */
		$name=$this->read(array('zone_id'=>$zone_id),'zone_label');
		return $name['zone_label'];
	}
	
	function get_all_zone(){
	/**
	 * Retourne toutes les zone
	 *
	 * Le tableau ainsi crée fait correspondre l'identifiant des zones et leur nom
	 *
	 * @return array
	 */
		$parent=$this->search('','zone_id,zone_label');
		$parents=array();
		$parents['']='All';
		if(!empty($parent)){
			foreach((array)$parent as $id=>$value){
				$parents[$value['zone_id']]=$value['zone_label'];
			}
		}
		return $parents;
	}
}


?>