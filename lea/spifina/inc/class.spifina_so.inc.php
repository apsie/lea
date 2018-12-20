<?php
/**	spifina : SpireaDemandes
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


class spifina_so extends so_sql{

	var $spifina_factures='spifina_factures';
	var $spifina_factures_details='spifina_factures_details';
	

	var $spiclient = 'spiclient';
	var $spiclient_relations='spiclient_relations';
	var $spiclient_mode_reglement = 'spiclient_mode_reglement';
	var $spiclient_delai_paiement = 'spiclient_delai_paiement';
	var $spiclient_contrats='spiclient_contrats';
	
	var $spid_tickets = 'spid_tickets';
	var $spid_etats='spid_etats';
	var $spid_prix_parametres='spid_prix_parametres';

	var $spireapi_facture_categories = 'spireapi_facture_categories';
	var $spireapi_vat = 'spireapi_vat';
	
	var $so_factures;
	var $so_factures_details;
	var $so_facture_categories;
	var $so_clients_relations;
	var $so_client;
	var $so_mode_reglement;
	var $so_delai_paiement;
	var $so_ticket;
	var $so_etats;
	var $so_prix_parametres;
	var $so_contrat;
	var $so_vat;

	var $account_id;
	var $app_title;
	
	
	function client_so(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		parent::__construct('spifina',$this->spifina_factures,null,'',true);
		
		$this->so_factures_details = new so_sql('spifina',$this->spifina_factures_details);
		$this->so_factures = new so_sql('spifina',$this->spifina_factures);

		$this->so_facture_categories = new so_sql('spireapi',$this->spireapi_facture_categories);
		$this->so_vat = new so_sql('spireapi',$this->spireapi_vat);

		$this->so_client = new so_sql('spiclient',$this->spiclient);
		$this->so_clients_relations = new so_sql('spiclient',$this->spiclient_relations);
		$this->so_mode_reglement = new so_sql('spiclient',$this->spiclient_mode_reglement);
		$this->so_delai_paiement = new so_sql('spiclient',$this->spiclient_delai_paiement);
		$this->so_contrat = new so_sql('spiclient',$this->spiclient_contrats);


		if(array_key_exists('spid', $GLOBALS['egw_info']['apps'])){
			$this->so_ticket = new so_sql('spid', $this->spid_tickets);
			$this->so_etats = new so_sql('spid', $this->spid_etats);
			$this->so_prix_parametres = new so_sql('spid',$this->spid_prix_parametres);
		}
		
	}
	
	function getCat_Label($id){
	/**
	 * Récupère le libellé de la catégorie à partir de l'identifiant (de catégorie) $id
	 *
	 * @param int $id identifiant de l'utilisateur
	 * @return string
	 */
		$cats = CreateObject('phpgwapi.categories');
		return $cats->id2name($id);
	}
	
	function is_admin($account_id=null){
	/**
	 * Vérifie si l'utilisateur est un administrateur (si il peut modifier les comptes)
	 *
	 * Nous véfions si les ACL pour les utilisateurs ayant les doits de modification, de la même manière que les administrateurs font pour gérer les comptes
	 *
	 * @param array $account_id=null pour un usage prochain, quand les administrateurs ne seront plus administrateurs sur tous les comptes
	 * @return boolean
	 */
		$userGroups = $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']);
		return isset($GLOBALS['egw_info']['user']['apps']['admin']) || array_key_exists($this->obj_config['management_group'], $userGroups);
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
	
	function nb_open_start($client_id=null,$start_period_date=0){
	/**
	 * Récupère le nombre de tickets en cours le $start_period_date pour le compte $client_id
	 *
	 * @param int $client_id=NULL compte. Tous les comptes par défaut
	 * @param date $start_period_date=0 période à partir de laquelle on prends en compte le nombre de tickets
	 * @return int
	 */
		$date = 'WHERE creation_date < '.$start_period_date.' and (closed_date > '.$start_period_date.' OR closed_date =0)';
		if($client_id!=null){
			// $ticket=$this->so_ticket->search($date.' and client_id='.$client_id,false);
			$ticket=$this->so_ticket->search(array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			$ticket=$this->so_ticket->search('',false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}
		return  count($ticket);
	}
	
	function nb_open_during($client_id=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets crées entre $start_period_date et $end_period_date pour le compte $client_id
	 *
	 * La valeur de retour ne prends pas en compte la date de fermeture du ticket.
	 *
	 * @param int $client_id=NULL compte. Tous les comptes par défaut
	 * @param date $start_period_date=0 date à partir de laquelle on prends en compte le nombre de tickets crées
	 * @param date $end_period_date=0 date à laquelle on arrête de prendre en compte les tickets crées
	 * @return int
	 */
	 
		
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE creation_date BETWEEN '.$start_period_date.' AND '.$r_end_period_date;
		if($client_id!=null){
			$ticket=$this->so_ticket->search(array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			$ticket=$this->so_ticket->search('',false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}
				
		return  count($ticket);
	}
	
	function nb_close_during($client_id=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets fermés entre $start_period_date et $end_period_date pour le compte $client_id
	 *
	 * La valeur de retour ne prends pas en compte la date de création du ticket.
	 *
	 * @param int $client_id=NULL compte. Tous les comptes par défaut
	 * @param date $start_period_date=0 date à partir de laquelle on prends en compte le nombre de tickets supprimés
	 * @param date $end_period_date=0 date à laquelle on arrête de prendre en compte les tickets supprimés
	 * @return int
	 */
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE closed_date BETWEEN '.$start_period_date.' AND '.$r_end_period_date;
		if($client_id!=null){
			$ticket=$this->so_ticket->search(array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			$ticket=$this->so_ticket->search('',false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}
		return  count($ticket);
	}
	
	function nb_open_end($client_id=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets crées et résolus (pour un même ticket) entre $start_period_date et $end_period_date pour le compte $client_id
	 *
	 * La valeur de retour prends en compte les tickets ouverts avant le $end_period_date et fermés après le $start_period_date
	 *
	 * @param int $client_id=NULL compte. Tous les comptes par défaut
	 * @param date $start_period_date=0 date à partir de laquelle on prends en compte le nombre de tickets fermés
	 * @param date $end_period_date=0 date à laquelle on arrête de prendre en compte les tickets fermés
	 * @return int
	 */
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE (closed_date IS NULL or closed_date > '.$r_end_period_date.' or closed_date=0) and creation_date < '.$r_end_period_date;
		if($client_id!=null){
			$ticket=$this->so_ticket->search(array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			$ticket=$this->so_ticket->search('',false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}
		return  count($ticket);
	}

	function get_nombre_ticket_par_etat($id,$client_id,$start_period_date,$end_period_date){
	/**
	 * Récupère le nombre de tickets aujourd'hui fermés, fermés entre $start_period_date et $end_period_date, à l'état $id pour le compte $client_id
	 *
	 * @param int $id Etat (à voir dans la table phpgw_tts_states)
	 * @param int $client_id compte. Tous les comptes par défaut
	 * @param date $start_period_date
	 * @param date $end_period_date
	 * @return int
	 */
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE closed_date BETWEEN '.$start_period_date.' AND '.$r_end_period_date.' AND state_id = '.$id;

		$etat=$this->so_ticket->search(array('client_id'=>$client_id,'ticket_closed'=>1),false,'','','',False,'AND',false,null,$date);
		
		if(!is_array($etat)){
			$etat=array();
		}
		return count($etat);
	}
}


?>