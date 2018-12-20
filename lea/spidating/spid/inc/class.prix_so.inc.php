<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	


class prix_so extends so_sql{

	var $spid_client='spiclient';
	var $spid_client_relations='spiclient_relations';
	var $spid_etats='spid_etats';
	var $spid_factures='spid_factures';
	var $spid_factures_details='spid_factures_details';
	var $spid_prix_parametres='spid_prix_parametres';
	var $spid_reponses='spid_reponses';
	var $spid_reponses_standard='spid_reponses_standard';
	var $spid_tickets='spid_tickets';
	var $spid_transitions='spid_transitions';
	var $spiclient_contrats='spiclient_contrats';
	
	var $so_client;
	var $so_client_relations;
	var $so_etats;
	var $so_factures;
	var $so_factures_details;
	var $so_prix_parametres;
	var $so_reponses;
	var $so_reponses_standard;
	var $so_transitions;
	var $so_ticket;
	var $so_contrat;

	var $account_id;
	var $app_title;
	
	
	function prix_so(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		
		parent::__construct('spid',$this->spid_prix_parametres,null,'',true);
		
		//Instance sur la table clients_relations
		$this->so_client_relations= new so_sql('spiclient',$this->spid_client_relations);
		
		//Instance sur la table reponse
		$this->so_reponses= new so_sql('spid',$this->spid_reponses);
		
		//Instance sur la table reponses standard
		$this->so_reponses_standard= new so_sql('spid',$this->spid_reponses_standard);
		
		//Instance sur la table etat
		$this->so_etats= new so_sql('spid',$this->spid_etats);
		
		//Instance sur la table client
		$this->so_client= new so_sql('spiclient',$this->spid_client);
		
		//Instance sur la table facture
		$this->so_factures= new so_sql('spid',$this->spid_factures);
		
		//Instance sur la table details facture
		$this->so_factures_details= new so_sql('spid',$this->spid_factures_details);
		
		//Instance sur la table ticket
		$this->so_ticket= new so_sql('spid',$this->spid_tickets);
		
		//Instance sur la table transition etat
		$this->so_transitions= new so_sql('spid',$this->spid_transitions);

		$this->so_contrat = new so_sql('spiclient',$this->spiclient_contrats);
		
	}

	function is_admin($account_id=null){
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
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		foreach($this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}
	
	function get_etat(){
	/**
	 * Retourne les états en cours (index du tableau résultat: identifiant de l'état, valeurs du tableau résultat: libellé de l'état)
	 *
	 * @return array
	 */
		$etat=$this->so_etats->search(array('state_billable'=>'1','state_price'=>array(null,'',false,'0')),false,'state_name ASC');
		$etats=array();
		if(!empty($etat)){
			foreach($etat as $id=>$value){
				$etats[$value['state_id']]=$value['state_name'];
			}
		}
		return $etats;
	}
	
	function get_client(){
	/**
	 * Retourne les clients facturables
	 *
	 * Le tableau résultat contient en index les identifiants des clients et le nom de leur entreprise en valeur
	 *
	 * @return array
	 */
		// on charge la config de SpiClient pour récupérer
		$configSpiClient = CreateObject('phpgwapi.config');
		$this->obj_config=$configSpiClient->read('spiclient');
		
		// Récupération de la liste des clients avec comme filtre : Client_Type et Client_sleep = 0
		$client=$this->so_client->search(array('client_type'=>$this->obj_config['ClientType'],'client_sleep'=>'0') ,false,'client_company ASC');
		$clients=array();
		if(!empty($client)){
			foreach($client as $id=>$value){
				$clients[$value['client_id']]=$value['client_company'];
			}
		}
		
		// _debug_array($clients);
		asort($clients);
		return $clients;
	}
	
	function get_account_client($id){
	/**
	 * Retourne l'identifiant de compte du client passé en argument
	 *
	 * @param int $id Identifiant du client
	 * @return int
	 */
		$client=$this->so_client->read(array('client_id'=>$id),false);
		return $client['account_id'];
	}
	
	function idetat2name($id){
	/**
	 * Retourne le libéllé l'état passé en argument
	 *
	 * @param int $id Identifiant de l'état
	 * @return string
	 */
		$etat=$this->so_etats->search(array('state_id'=>$id),'state_name');
		return $etat[0]['state_name'];
	}
}


?>