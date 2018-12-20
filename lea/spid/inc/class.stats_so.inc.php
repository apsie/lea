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


class stats_so extends so_sql{

	var $spid_client='spiclient';
	var $spid_etats='spid_etats';
	var $spifina_factures='spifina_factures';
	var $spifina_factures_details='spifina_factures_details';
	var $spid_prix_parametres='spid_prix_parametres';
	var $spid_reponses='spid_reponses';
	var $spid_reponses_standard='spid_reponses_standard';
	var $spid_tickets='spid_tickets';
	var $spid_transitions='spid_transitions';
	var $spid_locations='spid_locations';
	var $spid_intervenants = 'spid_intervenants';
	var $spiclient_contrat = 'spiclient_contrats';
	var $spid_rendez_vous = 'spid_rendez_vous';
	var $spiclient_relations = 'spiclient_relations';
	var $spid_sectors = 'spiclient_sectors';
	var $spid_facture_categories='spid_facture_categories';	

	var $spireapi_account = 'spireapi_acc_accounts';
	var $spireapi_book = 'spireapi_acc_book';
	var $spireapi_vat = 'spireapi_vat';
	
	var $so_client;
	var $so_etats;
	var $so_factures;
	var $so_factures_details;
	var $so_prix_parametres;
	var $so_reponses;
	var $so_reponses_standard;
	var $so_transitions;
	var $so_ticket;
	var $so_intervenant;
	var $so_contrat;
	var $so_rendez_vous;
	var $so_calendar;
	var $so_clients_relations;
	var $so_sectors;
	var $so_cat_invoice;

	var $so_account;
	var $so_book;
	var $so_vat;

	var $account_id;
	var $app_title;
	
	
	var $client_groups;
	var $obj_spid;
	var $compteClient;
	function stats_so(){
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
		
		parent::__construct('spiclient',$this->spid_client,null,'',true);
		
		//Instance sur la table reponse
		$this->so_reponses =& CreateObject('etemplate.so_sql');
		$this->so_reponses->so_sql('spid',$this->spid_reponses);
		
		//Instance sur la table reponses standard
		$this->so_reponses_standard =& CreateObject('etemplate.so_sql');
		$this->so_reponses_standard->so_sql('spid',$this->spid_reponses_standard);
		
		//Instance sur la table etat
		$this->so_etats =& CreateObject('etemplate.so_sql');
		$this->so_etats->so_sql('spid',$this->spid_etats);
		
		//Instance sur la table client
		$this->so_client =& CreateObject('etemplate.so_sql');
		$this->so_client->so_sql('spiclient',$this->spid_client);
		
		//Instance sur la table facture
		$this->so_factures =& CreateObject('etemplate.so_sql');
		$this->so_factures->so_sql('spifina',$this->spifina_factures);
		
		//Instance sur la table facture details
		$this->so_factures_details =& CreateObject('etemplate.so_sql');
		$this->so_factures_details->so_sql('spifina',$this->spifina_factures_details);
		
		//Instance sur la table ticket
		$this->so_ticket =& CreateObject('etemplate.so_sql');
		$this->so_ticket->so_sql('spid',$this->spid_tickets);
		
		//Instance sur la table transition etat
		$this->so_transitions =& CreateObject('etemplate.so_sql');
		$this->so_transitions->so_sql('spid',$this->spid_transitions);
		
		//Instance sur la table intervenants
		$this->so_intervenant =& CreateObject('etemplate.so_sql');
		$this->so_intervenant->so_sql('spid',$this->spid_intervenants);
		
		$this->so_contrat = new so_sql('spiclient', $this->spiclient_contrat);
		$this->so_rendez_vous = new so_sql('spid', $this->spid_rendez_vous);
		$this->so_clients_relations = new so_sql('spiclient', $this->spiclient_relations);
		$this->so_calendar = new calendar_so();
		$this->so_sectors = new so_sql('spiclient',$this->spid_sectors);
		
		$this->obj_spid =& CreateObject('spid.spid_ui');
		// $this->client_groups=$this->obj_spid->client_groups(null,$this->obj_spid->var_technicienCategorie);
		$client_groups=$this->so_client->search('','account_id,client_company','client_company ASC');
		foreach($client_groups as $id => $value){
			$this->client_groups[$client_groups[$id]['account_id']] = $client_groups[$id]['client_company'];
		}

		$this->so_cat_invoice = new so_sql('spid',$this->spid_facture_categories);
		$this->so_account = new so_sql('spireapi',$this->spireapi_account);
		$this->so_book = new so_sql('spireapi',$this->spireapi_book);
		$this->so_vat = new so_sql('spireapi',$this->spireapi_vat);
		
		$compte = $this->obj_accounts->memberships($this->account_id,true);
		$this->compteClient=$this->so_client->read(array('account_id'=>$compte[0]));
		if(!$this->compteClient){
			$this->compteClient=array();
		}
		
	}

	function is_admin($account_id=null){
	/**
	 * Vérifie si l'utilisateur est un administrateur (si il peut modifier les comptes)
	 *
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
	
	function id2name($location_id){
	/**
	 * Récupère le nom d'une location à partir de son Id
	 *
	 * @param int $location_id Identifiant de la location
	 * @return string
	 */
		$name=$this->read(array('location_id'=>$location_id),'location_name');
		return $name['location_name'];
	}
	
	function time_open($criteria=array(),$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le temps passé sur les tickets crées entre $start_period_date et $end_period_date, toujours en cours
	 *
	 * $criteria est un tableau contenant  account_id (identifiant d'un compte, peut être un tableau). Si account_id est invalide (ou nul), le compte considéré sera tous les comptes / le tableau peut aussi contenir d'autre critere de recherche
	 *
	 * @param array $criteria = array() 
	 * @param date $start_period_date = 0
	 * @param date $end_period_date = 0
	 * @return time
	 */
	 // echo "debug time open";
	 // _debug_array($criteria);
	 
		$date = '';
		if($start_period_date != 0 && $end_period_date != 0){
			// Critere de date
			$date = 'WHERE creation_date < '.$start_period_date.' and (closed_date > '.$start_period_date.' or closed_date =0)';
		}	
		
		if(is_array($criteria['client_id']) && count($criteria['client_id']) == 1){
			// Filtre compte client
			$criteria['client_id'] = $criteria['client_id'][0];
		}
		$client_id = (int)$criteria['client_id'];
		unset($criteria['client_id']);
		if($client_id != null){
			// requete avec filtre client
			$ticket = $this->so_ticket->search($criteria+array('client_id'=>$client_id,'ticket_closed'=>'0'),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket = $this->so_ticket->search($criteria+array('ticket_closed'=>'0'),false,'','','',False,'AND',false,null,$date);
		}

		if(!is_array($ticket)){
			$ticket=array();
		}
		
		// _debug_array($ticket);
		
		$time = 0;
		foreach($ticket as $id=>$value){
			
			// Parcours des tickets pour calculer le temps passé // Conversion du temps dans l'unité définie en config
			// si ticket_unit_time est null alors on mets 0 (ie. minutes pour rétro compatibilité)
			$ticket_unit = $value['ticket_unit_time'] == null ? 0 : $value['ticket_unit_time'];
			$temps_ticket = $this->convertir_temps($value['ticket_spend_time'],$ticket_unit,$this->obj_config['stat_unit_time']);
			$time += $temps_ticket;
		}
		return  $time;
	}
	
	function time_close($criteria=array(),$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le temps passé sur les tickets fermés entre $start_period_date et $end_period_date
	 *
	 * $criteria est un tableau contenant account_id (identifiant d'un compte, peut être un tableau). Si account_id est invalide (ou nul), le compte considéré sera tous les comptes / le tableau peut aussi contenir d'autre critere de recherche
	 *
	 * @param array $criteria=array() Identifiant de la location
	 * @param date $start_period_date=0
	 * @param date $end_period_date=0
	 * @return time
	 */
		// Critere de date
		$date='WHERE closed_date BETWEEN '.$start_period_date.' AND '.$end_period_date;
		
		if(is_array($criteria['client_id']) && count($criteria['client_id']) == 1){
			// Filtre compte client
			$criteria['client_id'] = $criteria['client_id'][0];
		}
		
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		if($client_id!=null){
			// requete avec filtre client
			$ticket = $this->so_ticket->search($criteria+array('ticket_invoice'=>'1','ticket_closed'=>'1','client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket = $this->so_ticket->search($criteria+array('ticket_invoice'=>'1','ticket_closed'=>'1'),false,'','','',False,'AND',false,null,$date);
		}

		if(!is_array($ticket)){
			$ticket=array();
		}
		$time=0;
		foreach($ticket as $id=>$value){
			// Parcours des tickets pour calculer le temps passer // Conversion du temps dans l'unité défini en config
			$temps_ticket = $this->convertir_temps($value['ticket_spend_time'],$value['ticket_unit_time'],$this->obj_config['stat_unit_time']);
			$time += $temps_ticket;
		}
		return  $time;
	}
	
	function time_not_factured($criteria=array(),$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le temps passé sur les tickets fermés non facturé entre $start_period_date et $end_period_date
	 *
	 * $criteria est un tableau contenant account_id (identifiant d'un compte, peut être un tableau). Si account_id est invalide (ou nul), le compte considéré sera tous les comptes / le tableau peut aussi contenir d'autre critere de recherche
	 *
	 * @param array $criteria=array() Identifiant de la location
	 * @param date $start_period_date=0
	 * @param date $end_period_date=0
	 * @return time
	 */
		// Critere de date
		$date = 'WHERE (closed_date >= '.$start_period_date.' AND closed_date <='.$end_period_date.')';
		
		if(is_array($criteria['client_id']) && count($criteria['client_id']) == 1){
			// Filtre compte client
			$criteria['client_id'] = $criteria['client_id'][0];
		}
		
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		if($client_id!=null){
			// requete avec filtre client
			$ticket = $this->so_ticket->search($criteria+array('ticket_invoice'=>'0','ticket_closed'=>'1','client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket = $this->so_ticket->search($criteria+array('ticket_invoice'=>'0','ticket_closed'=>'1'),false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}

		$time=0;
		foreach($ticket as $id=>$value){
			// Parcours des tickets pour calculer le temps passer // Conversion du temps dans l'unité défini en config
			$temps_ticket = $this->convertir_temps($value['ticket_spend_time'],$value['ticket_unit_time'],$this->obj_config['stat_unit_time']);
			$time += $temps_ticket;
		}
		return $time;
	}
	
	function nb_open_start($criteria=null,$start_period_date=0){
	/**
	 * Récupère le nombre de tickets ouverts non fermés le $start_period_date
	 *
	 * $criteria est un tableau contenant l'identifiant d'un client et eventuellement d'autres criteres
	 *
	 * @param int $criteria=NULL Identifiant de la location
	 * @param date $start_period_date=0
	 * @return int
	 */
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		
		// Critere de date
		$date='WHERE creation_date < '.$start_period_date.' and (closed_date > '.$start_period_date.' or closed_date =0)';

		if($client_id!=null){
			// requete avec filtre client
			$ticket=$this->so_ticket->search($criteria + array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket=$this->so_ticket->search($criteria,false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}

		return  count($ticket);
	}
	
	function nb_open_during($criteria=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets ouverts (fermés ou pas) entre le $start_period_date et le $end_period_date
	 *
	 * $criteria est un tableau contenant l'identifiant d'un client et eventuellement d'autres criteres
	 *
	 * @param int $criteria=NULL
	 * @param date $start_period_date=0
	 * @param date $end_period_date=0
	 * @return int
	 */
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		
		// Critere de date
		$r_end_period_date = $end_period_date + 86399;
		$date = 'WHERE creation_date BETWEEN '.$start_period_date.' AND '.$r_end_period_date;
		
		if($client_id!=null){	
			// requete avec filtre client
			$ticket=$this->so_ticket->search($criteria+array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket=$this->so_ticket->search($criteria,false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}

		return  count($ticket);
	}
	
	function nb_close_during($criteria=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets fermés entre le $start_period_date et le $end_period_date
	 *
	 * $criteria est un tableau contenant l'identifiant d'un client et eventuellement d'autres criteres
	 *
	 * @param int $criteria=NULL
	 * @param date $start_period_date=0
	 * @param date $end_period_date=0
	 * @return int
	 */
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		
		// Critere de date
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE closed_date BETWEEN '.$start_period_date.' AND '.$r_end_period_date;
		
		if($client_id!=null){
			// requete avec filtre client
			$ticket=$this->so_ticket->search($criteria+array('client_id'=>$client_id,'ticket_closed'=>1),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket=$this->so_ticket->search($criteria+array('ticket_closed'=>1),false,'','','',False,'AND',false,null,$date);
		}
		if(!is_array($ticket)){
			$ticket=array();
		}

		return  count($ticket);
	}
	
	function nb_open_end($criteria=null,$start_period_date=0,$end_period_date=0){
	/**
	 * Récupère le nombre de tickets en attente (crées et non fermés) entre $start_period_date et $end_period_date
	 *
	 * $criteria est un identifiant de compte
	 *
	 * @param int $criteria=NULL
	 * @param date $start_period_date=0
	 * @param date $end_period_date=0
	 * @return int
	 */
		$client_id=(int)$criteria['client_id'];
		unset($criteria['client_id']);
		
		// Critere de date
		$r_end_period_date = $end_period_date + 86399;
		$date='WHERE (closed_date IS NULL or closed_date > '.$r_end_period_date.' or closed_date=0) and creation_date < '.$r_end_period_date;
		
		if($client_id!=null){
			// requete avec filtre client
			$ticket=$this->so_ticket->search($criteria+array('client_id'=>$client_id),false,'','','',False,'AND',false,null,$date);
		}else{
			// requete sans filtre client
			$ticket=$this->so_ticket->search($criteria,false,'','','',False,'AND',false,null,$date);
		}

		if(!is_array($ticket)){
			$ticket=array();
		}

		return  count($ticket);
	}
	
	function get_group($client_id){
	/**
	 * Retourne la maison mere du client ayant l'identifiant $client_id
	 *
	 * @return int
	 */
	
	 $q_fields='client_id,client_parent';
	 
		$client = $this->so_client->search(array('client_id'=>$client_id),$q_fields);
		if($client[0]['client_parent'] == 0){
			return $client[0]['client_id'];
		}else{
			return $this->get_group($client[0]['client_parent']);
		}
	}
	
	function get_contrat(){
	/**
	 * Retourne la liste des contrats
	 *
	 * @return array()
	 */
	 
		$retour = array();

		$contrat = $this->so_contrat->search('',false);
		if(is_array($contrat)){
			foreach($contrat as $id => $value){
				$retour[$contrat[$id]['contract_id']] = $contrat[$id]['contract_title'];
			}
		}
		 // _debug_array($retour);
		return $retour;
	}
	
	function get_clients(){
	/**
	 * Retourne la liste des clients de l'utilisateur
	 *
	 * @return array()
	 */
		$retour = array();
		$accounts = $this->obj_accounts->memberships($this->account_id,true);
		$ClientsDuUser = $this->so_client->search(array('account_id'=>$accounts),false,'client_company ASC');
		foreach($ClientsDuUser as $id=>$value)
		{
			$retour[$value['client_id']] = $value['client_id'];
		}
		return $retour;
	}
	
	function get_sectors(){
	/**
	 * Retourne la liste des secteurs.
	 *
	 * @return array
	 */
		$sectors = array();
		$tempSectors = $this->so_sectors->search('',false);
		foreach($tempSectors as $id => $value){
			$sectors[$value['sector_id']] = $value['sector_name'];
		}
		return $sectors;
	}
	
	function convertir_temps($temps,$unit_source,$unit_dest){
	/**
	 * Converti le temps $temps de l'unite $unit_source vers l'unite $unit_dest
	 * @return int
	 */
		switch($unit_source){
			case 0:
				// Minute
				if($unit_dest == 1){
					return $temps / 60;
				}elseif($unit_dest == 2){
					return $temps / 60 / 8;
				}else{
					return $temps;
				}
				break;
			case 1:
				// Heure
				if($unit_dest == 0){
					return $temps * 60;
				}elseif($unit_dest == 2){
					return $temps / 8;
				}else{
					return $temps;
				}
				break;
			case 2:
				// Jour
				if($unit_dest == 0){
					return $temps * 60 * 8;
				}elseif($unit_dest == 1){
					return $temps * 8;
				}else{
					return $temps;
				}
				break;
		}
	}
	
	function id2account($client_id){
	/**
	 * Donne l'account_id d'un client en fonction de son client_id
	 *
	 * @param $client_id int : identifiant client (spiclient)
	 */
		$client = $this->so_client->search(array('client_id'=>$client_id),'account_id');
		return $client[0]['account_id'];
	}
	
	function total_factured($contract_id,$client_id,$start,$end){
	/**
	 * Calcul le total facturé pour le contrat et le client choisi
	 *
	 * @param $contract_id int : identifiant contrat (spiclient)
	 * @param $client_id int : identifiant client (spiclient)
	 * @param $start int : date debut
	 * @param $end int : date fin
	 * @return int
	 */
		$total = 0;
		$real_end = $end + 86399;
		$criteria = array(
			'contract_id' 	=> $contract_id,
			// 'account_id' 	=> $this->id2account($client_id),
			'client_id' 	=> $client_id,
		);
		// _debug_array($criteria);
		
		$q_fields = 'ticket_id';
		$tickets = $this->so_ticket->search($criteria,$q_fields);
		// _debug_array($tickets);
		if(is_array($tickets)){
			foreach($tickets as $key => $data){
				
				$details = $this->so_factures_details->search(array('ticket_id'=>$data['ticket_id']),false);
				// _debug_array($details);
				
				if(is_array($details)){
					foreach($details as $detail){
						$total += $detail['total_ht'];
					}
				}
			}
		}
		
		return $total;
	}
	
	function clientid2name($id){
	/**
	 * Retourne le nom (client_company) du client avec l'id $id
	 *
	 * @param $id int : identifiant client (spiclient)
	 * @return string
	 */
		$client = $this->so_client->search(array('client_id'=>$id),'client_company');
		return $client[0]['client_company'];
	}
	
	function contractid2name($id){
	/**
	 * Retourne le nom (contract_title) du contrat avec l'id $id
	 *
	 * @param $id int : identifiant contrat (spiclient)
	 * @return string
	 */
	 

		$contrat = $this->so_contrat->search(array('contract_id'=>$id),'contract_title');
		return $contrat[0]['contract_title'];
	}
	
	function get_providers($index = 'account_id'){
	/**
	 * Retourne la liste des groupes correspondant aux prestataires
	 *
	 * @param $index string : champs d'index du tableau
	 * @return array
	 */
		$ClientsRelations=$this->so_clients_relations->search('','societe_id');
		$fournisseurs = array();
		if(is_array($ClientsRelations))
		{
			foreach($ClientsRelations as $cle=>$valeur)
			{
				$clients=$this->so_client->read(array('client_id'=>$valeur['societe_id']),false);
				if(!in_array($clients['client_company'],$fournisseurs)){
					$fournisseurs[$clients['client_id']] = $clients['client_company'];
				}
			}
		}
		natcasesort($fournisseurs);
		return $fournisseurs;
	}
}


?>