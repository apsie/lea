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


class facture_so extends so_sql{

	var $spid_client='spiclient';
	var $spid_etats='spid_etats';
	var $spid_factures='spid_factures';
	var $spid_factures_details='spid_factures_details';
	var $spid_prix_parametres='spid_prix_parametres';
	var $spid_reponses='spid_reponses';
	var $spid_reponses_standard='spid_reponses_standard';
	var $spid_tickets='spid_tickets';
	var $spid_transitions='spid_transitions';
	var $spid_clients_relations='spiclient_relations';
	var $spid_contrat = 'spid_contrats';
	var $spid_facture_categories = 'spid_facture_categories';

	var $spiclient_mode_reglement = 'spiclient_mode_reglement';
	var $spiclient_delai_paiement = 'spiclient_delai_paiement';
	
	var $so_client;
	var $so_etats;
	var $so_factures;
	var $so_factures_details;
	var $so_prix_parametres;
	var $so_reponses;
	var $so_reponses_standard;
	var $so_transitions;
	var $so_ticket;
	var $so_clients_relations;
	var $so_contrat;
	var $so_facture_categories;

	var $so_mode_reglement;
	var $so_delai_paiement;

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
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		
		parent::__construct('spid',$this->spid_factures,null,'',true);
		
		$this->so_contrat = CreateObject('etemplate.so_sql');
		$this->so_contrat->so_sql('spid',$this->spid_contrat);
		
		//Instance sur la table reponse
		$this->so_reponses =& CreateObject('etemplate.so_sql');
		$this->so_reponses->so_sql('spid',$this->spid_reponses);
		
		//Instance sur la table client
		$this->so_reponses_standard =& CreateObject('etemplate.so_sql');
		$this->so_reponses_standard->so_sql('spid',$this->spid_reponses_standard);
		
		//Instance sur la table etat
		$this->so_etats =& CreateObject('etemplate.so_sql');
		$this->so_etats->so_sql('spid',$this->spid_etats);
		
		//Instance sur la table prix
		$this->so_prix_parametres =& CreateObject('etemplate.so_sql');
		$this->so_prix_parametres->so_sql('spid',$this->spid_prix_parametres);
		
		//Instance sur la table client
		$this->so_client =& CreateObject('etemplate.so_sql');
		$this->so_client->so_sql('spiclient',$this->spid_client);
		
		//Instance sur la table facture details
		$this->so_factures_details =& CreateObject('etemplate.so_sql');
		$this->so_factures_details->so_sql('spid',$this->spid_factures_details);
		
		//Instance sur la table facture
		$this->so_factures =& CreateObject('etemplate.so_sql');
		$this->so_factures->so_sql('spid',$this->spid_factures);
				
		//Instance sur la table ticket
		$this->so_ticket =& CreateObject('etemplate.so_sql');
		$this->so_ticket->so_sql('spid',$this->spid_tickets);
		
		//Instance sur la table transitions
		$this->so_transitions =& CreateObject('etemplate.so_sql');
		$this->so_transitions->so_sql('spid',$this->spid_transitions);
		
		$this->so_clients_relations =& CreateObject('etemplate.so_sql');
		$this->so_clients_relations->so_sql('spiclient',$this->spid_clients_relations);
		
		$this->so_facture_categories = new so_sql('spid',$this->spid_facture_categories);

		$this->so_mode_reglement = new so_sql('spiclient',$this->spiclient_mode_reglement);
		$this->so_delai_paiement = new so_sql('spiclient',$this->spiclient_delai_paiement);
		
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
	
	function company_billable($first='All'){
	/**
	 * Précise la liste des entreprises facturables à partir d'un identifiant de départ. 
	 *
	 * La valeur de retour est un tableau des entreprises facturables à partir de l'entreprise précisées en entrée (index: Id de l'entreprise, valeur: nom de l'entreprise)
	 *
	 * @param string $first='All' définit l'Identifiant de la première entreprise à être examinée dans la table
	 * @return array
	 */
		$company=$this->search(array('client_billable_id'=>0),false);
		$companies=array();
		$companies[0]=$first;
		if(!empty($company)){
			foreach($company as $id=>$value){
				$companies[$value['client_id']]=$value['client_company'];
			}
		}
		return $companies;
	}
	
	function idcompany2name($id){
	/**
	 * Récupère le nom de l'entreprise (première correspondant à l'Identifiant dans la table) à partir de son Id
	 *
	 * @param int $id Identifiant de l'entreprise
	 * @return string
	 */
		$company=$this->search(array('client_id'=>$id),'client_company');
		return $company[0]['client_company'];
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