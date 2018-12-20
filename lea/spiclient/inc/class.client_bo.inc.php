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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.client_so.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	
	
class client_bo extends client_so 
{
	var $tabs = 'general|contact|address|contract|accounting|technique|checklist|comment|clients|prestataires|link|history';
	
	var $create_ticket=EGW_ACL_ADD;
	var $update_ticket=EGW_ACL_EDIT;
	var $close_ticket=EGW_ACL_CUSTOM_1;
	var $create_invoce=EGW_ACL_CUSTOM_2;
	var $read_invoce=EGW_ACL_CUSTOM_3;
	
	var $grants;
	var $preferences; 
	var $obj_js;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	var $obj_preferences;
	var $obj_acl;
	
	var $account_id;
	var $app_title;
	
	
	var $payment_model;
	

	var $state_close;
	var $state_name;
	var $sel_reponsestandard;
	var $state_initial;
	var $state_billable;
	var $sel_priority;
	var $sel_client;

	//var $previous_value;
	var $tableau_errors;
	
	var $verification;
	var $total;
	var $checkgroups;
	var $new_group;
	var $assignedby;
	var $assignedto;

	function __construct() {
		/**
		*Méthode appelée directement par le constructeur. Charge les varibles globales
		*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spiclient']['title'];
		/* Récupération des droits d'accès ACL */
		// $acl = CreateObject('spiclient.acl_spiclient');
		// $this->grants=$acl->getACL();
		$this->grants['admin']=$this->is_admin($this->account_id);
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spiclient'];
		
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		$this->obj_preferences = $GLOBALS['egw_info']['user']['preferences']['spiclient'];
		/* Récupération les infos de configurations */
		
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
			$config = CreateObject('phpgwapi.config','spiclient');
			$this->obj_config = $config->read_repository('spiclient');
		}else{
			$config = CreateObject('phpgwapi.config');
			$this->obj_config = $config->read('spiclient');
		}
		
		/* recuperation des acl */
		$this->obj_acl = new acl_spiclient();
		                        		
		parent::__construct();
	}
		
	function client_bo(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function get_payment_model(){
		/**
		* Méthode retournant le modèle des modes de paiement (sur 30,60,... jours)
		*
		*@return array
		*/
		$payment_model=array(
			0	=>	'No chosen payment',
			1	=>	'Payment with reception',
			2	=>	'Payment in 30 days',
			3	=>	'Payment in 60 days',
			4	=>	'Payment in 90 days',
		);
	
		return $payment_model;
	}
	
	function get_add_customer(){
		/**
		* Routine permettant d'obtenir la liste des clients en attente de création (clients qui n'ont pas de compte). L'index du tableau obtenu est l'identifiant du client, la valeur correspondant au lid
		*
		* @return array
		*/
		$clients=array();
		$join = 'WHERE account_id IS NOT NULL AND account_id <> 0';
		$client=$this->search('','client_id,account_id',$order,'',$wildcard,false,$op,$start,$col_filter,$join);
		foreach((array)$client as $cle=>$valeur){
			$used_group[$valeur['account_id']] = $valeur['account_id'];
		}
		$used_group['-1'] = '-1';
		$used_group['-3'] = '-3';
		
		$recherche=array(
			'type'       => 'groups',
		);
		$groups = $GLOBALS['egw']->accounts->search($recherche);
		foreach((array)$groups as $id=>$value){
			if(!in_array($value['account_id'], $used_group)){
				$clients[$value['account_id']]=$value['account_lid'];	
			}
		}
		//_debug_array($clients);
		return $clients;
	}
	
	
	function get_info($id){
		/**
		* Routine permettant d'obtenir les informations sur le client passé en argument
		*
		* NOTE : je doute que cette routine marche ...
		*
		* @param int $id indentifiant du client dont on veut les informations
		* @return string
		*/
		
		$info = $this->search(array('client_id'=>$id),false);
		return $info[0];
	}

	function get_name($id){
		/**
		* Routine permettant d'obtenir les informations sur le client passé en argument
		*
		* NOTE : je doute que cette routine marche ...
		*
		* @param int $id indentifiant du client dont on veut les informations
		* @return string
		*/
		$info = $this->read($id);
		return $info['client_code_tiers'].': '.$info['client_company'];
	}
	
	
	
	function get_clients($id){
	/**
	 * Retourne la liste des relations clients pour le client en cours
	 *
	 * @param $id int : identifiant du client à traiter
	 * @return array
	 */
		// $this->so_clients_relations->debug = 4;
		$clients = array();
		$client_relations = $this->so_clients_relations->search(array('societe_id'=>$id),false);
		foreach((array)$client_relations as $client_relation){
			// $contrat = $this->so_contrat->search(array('relation_id' => $client_relation['relation_id']),false);
			$contrat = $this->so_contrat->search(array('contract_supplier' => $client_relation['societe_id'], 'contract_client' => $client_relation['client_id']),false);
			
			$clients[$i]['relation_id'] = $client_relation['relation_id'];
			$clients[$i]['client_row'] = $client_relation['client_id'];
			$clients[$i]['client_company'] = $this->get_company_name($client_relation['client_id']);
			$clients[$i]['contrat'] = is_array($contrat[0]);
			$clients[$i]['payment_model'] = $client_relation['payment_model'];
			$clients[$i]['operation_code'] = $client_relation['operation_code'];	
			
			++$i;
		}
		
		$clients = $this->sortByOneKey($clients, 'client_company');
		
		return $clients;
	}
	
	
	
	function get_clients_and_prospects(){
	/**
	 * Retourne la liste des relations clients pour le client en cours
	 *
	 * 
	 * @return array
	 */
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		
		$return['Clients'] = $this->get_all_clients($spiclient_config['ClientType'],true,true);
		$return['Propects']  = $this->get_all_clients($spiclient_config['ProspectType'],true,true);
		
		return $return;
	}	
	
	function get_all_except_suppliers($nocrop=true){
	/**
	 * Retourne la liste des relations clients pour le client en cours
	 *
	 * 
	 * @return array
	 */
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		
		$types = $this->get_type_client();
		unset($types[$spiclient_config['SupplierType']]);
		// _debug_array($types);
		
		foreach($types as $id=>$type)
		{
			$return[$type] = $this->get_all_clients($id,true,$nocrop);
		}
		
		
		return array_filter($return);
	}	
	
	
	
	
	function sortByOneKey(array $array, $key, $asc = true) {
	/**
	 * Fonction de tri d'un tableau en fonction de la valeur d'une clé 
	 *
	 * @param $array array : tableau a trier
	 * @param $key string : clé de tri
	 * @param $asc boolean : true = asc // false = desc
	 * @return array : tableau trier et reindexé
	 */
		$result = array();
		   
		$values = array();
		foreach ($array as $id => $value) {
			$values[$id] = isset($value[$key]) ? $value[$key] : '';
		}
		
		if ($asc) {
			asort($values);
		}
		else {
			arsort($values);
		}

		$i = 1;
		foreach ($values as $key => $value) {
			$result[$i] = $array[$key];
			++$i;
		}
		return $result;
	}
	
	function get_possible_clients($id){
	/**
	 * Retourne la liste des clients possible pour le client ayant l'identifiant $id
	 *
	 * @param $id int : identifiant du client a traiter
	 * @return array
	 */
		$clients = $this->get_all_clients($this->obj_config['ClientType']);
		$client_relations = $this->so_clients_relations->search(array('societe_id'=>$id),false);
		foreach((array)$client_relations as $client_relation){
			unset($clients[$client_relation['client_id']]);
		}
		
		unset($clients[$id]);
		
		return $clients;
	}
	
	function get_possible_prestataires($id){
	/**
	 * Retourne la liste des fournisseurs possible pour le client ayant l'identifiant $id
	 *
	 * @param $id int : identifiant du client a traiter
	 * @return array
	 */
		$clients = $this->get_all_clients($this->obj_config['ProviderType']);
		$client_relations = $this->so_clients_relations->search(array('client_id'=>$id),false);
		foreach((array)$client_relations as $client_relation){
			unset($clients[$client_relation['societe_id']]);
		}
		
		unset($clients[$id]);
		
		return $clients;
	}
	
	function get_prestataires($id){
	/**
	 * Retourne la liste des relations clients pour le client en cours
	 *
	 * @param $id int : identifiant du client à traiter
	 * @return array
	 */
		// $this->so_clients_relations->debug = 4;
		$clients = array();
		$client_relations = $this->so_clients_relations->search(array('client_id'=>$id),false);
		foreach((array)$client_relations as $client_relation){
			// $contrat = $this->so_contrat->search(array('relation_id' => $client_relation['relation_id']),false);
			$contrat = $this->so_contrat->search(array('contract_supplier' => $client_relation['societe_id'], 'contract_client' => $client_relation['client_id']),false);
			
			$clients[$i]['relation_id'] = $client_relation['relation_id'];
			$clients[$i]['fournisseur_row'] = $client_relation['societe_id'];
			$clients[$i]['fournisseur_company'] = $this->get_company_name($client_relation['societe_id']);
			$clients[$i]['contrat'] = is_array($contrat[0]);
			$clients[$i]['payment_model'] = $client_relation['payment_model'];
			$clients[$i]['operation_code'] = $client_relation['operation_code'];	
			
			++$i;
		}
		
		$clients = $this->sortByOneKey($clients, 'fournisseur_company');
		
		return $clients;
	}
	
	
	
	function get_sectors($id=''){
		/**
		 * Retourne la liste des secteurs.
		 *
		 * @return array
		 */
		$sectors = array();
		$tempSectors = $this->so_sectors->search(array('sector_id'=>$id),false,'sector_name');
		foreach((array)$tempSectors as $id => $value){
			$sectors[$value['sector_id']] = $value['sector_name'];
		}
		return $sectors;
	}
	
	function get_mode_reglement($id=''){
	/**
	 * Retourne la liste des mode de reglement
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_mode_reglement->search(array('mode_reglement_id'=>$id),false,'mode_reglement_label');
		foreach((array)$info as $key => $data){
			$retour[$data['mode_reglement_id']] = $data['mode_reglement_label'];
		}
		return $retour;
	}
	
	function get_delai_paiement($id=''){
	/**
	 * Retourne la liste des delais de paiement
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_delai_paiement->search(array('delai_id'=>$id),false,'delai_label');
		foreach((array)$info as $key => $data){
			$retour[$data['delai_id']] = $data['delai_label'];
		}
		return $retour;
	}

	function get_bank_account($provider_id,$bank_only=false){
    /**
     * Retourne les comptes en banque disponible pour la société
     *
     * @param $provider_id : identifiant du provider de la facture
     * @return array
     */
    	$return = array();
    	$client = $this->read($provider_id);
		if($bank_only==true){
			unset($client['client_iban']);
			unset($client['client_iban_two']);
		}
		
		
    	// Compte numero 1
    	if(!empty($client['client_bank'])){
    		$return[''] = $client['client_bank'].' '.$client['client_iban'];
    	}
    	// Compte numero 2
    	if(!empty($client['client_bank_two'])){
    		$return['_two'] = $client['client_bank_two'].' '.$client['client_iban_two'];
    	}

    	// Si aucun compte n'existe pour le provider
    	if(empty($return)){
    		$return[] = lang('No bank account for current provider');
    	}
    	return $return;
    }
	
	function get_all_clients($type='', $no_sleep=true){
	/**
	 * Retourne la liste des clients
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->search(array('client_type'=>$type, 'client_sleep' => $no_sleep ? '0' : ''),false,'client_company');
		foreach((array)$info as $key => $data){
			$retour[$data['client_id']] = $this->truncate($data['client_company']);
		}
		return $retour;
	}
	
	function get_zone($id=''){
	/**
	 * Retourne la liste des zones
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_zone->search('',false,'area_label');
		foreach((array)$info as $key => $data){
			$retour[$data['area_id']] = $data['area_label'];
		}
		return $retour;
	}
	
	/**
	 * get title for an tracker item identified by $entry
	 *
	 * Is called as hook to participate in the linking
	 *
	 * @param int/array $entry int ts_id or array with tracker item
	 * @return string/boolean string with title, null if tracker item not found, false if no perms to view it
	 */
	function link_title($entry)
	{
		if (!is_array($entry))
		{
			$entry = $this->read($entry);
		}
		if (!$entry)
		{
			return $entry;
		}
		return '#'.$entry['client_id'].': '.$entry['client_company'];
	}

	/**
	 * get titles for multiple tracker items
	 *
	 * Is called as hook to participate in the linking
	 *
	 * @param array $ids array with tracker id's
	 * @return array with titles, see link_title
	 */
	function link_titles($ids)
	{
		$titles = array();
		if (($tickets = $this->search(array('client_id' => $ids),'client_id,client_company')))
		{
			foreach((array)$tickets as $ticket)
			{
				$titles[$ticket['client_id']] = $this->link_title($ticket);
			}
		}
		// we assume all not returned tickets are not readable by the user, as we notify egw_link about each deleted ticket
		foreach((array)$ids as $id)
		{
			if (!isset($titles[$id])) $titles[$id] = false;
		}
		return $titles;
	}

	/**
	 * query clients for entries matching $pattern
	 *
	 * Is called as hook to participate in the linking
	 *
	 * @param string $pattern pattern to search
	 * @return array with client_id - client_company pairs of the matching entries
	 */
	function link_query($pattern)
	{
		$result = array();
		foreach((array) $this->search(array('client_company' => $pattern),false,'client_id ASC','','%',false,'OR',false,'') as $item )
		{
			if ($item) $result[$item['client_id']] = $this->link_title($item);
		}
		return $result;
	}
	
	function get_contact($id){
	/**
	 * Retourne la liste des contacts du clients en cours
	 *
	 * @param $id : Id du client
	 * @return array
	 */
		$retour = array();
		$i = 2;
		
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
			$so_link = CreateObject('phpgwapi.solink');
			$links = $so_link->get_links('spiclient',$id,'addressbook');
		}else{
			$links = egw_link::get_links('spiclient',$id,'addressbook');
		}
		foreach((array)$links as $link_id => $addressbook_id){
			if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
				$so_link = CreateObject('phpgwapi.solink');
				$links = $so_link->get_link($link_id);
			}else{
				$link = egw_link::get_link($link_id);
			}
			$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
			$contact = $so_addressbook->read($addressbook_id);
			client_bo::get_contact_fn($addressbook_id);
			$retour[$i] = array(
				'appli' => '<img src="addressbook/templates/default/images/navbar.png" id="2[appli]" border="0" width="16px">',
				'title' => $link['link_app1'] == 'addressbook' ? $link['link_id1'] : $link['link_id2'],
				'email' => $contact['contact_email'],
				'tel_fixe' => $contact['tel_work'],
				'tel_port' => $contact['tel_cell'],
				'role'	=> $link['link_remark'],
				'link_id' => $link_id,
				'addressbook_id' => $addressbook_id,
				'name' => client_bo::get_contact_fn($addressbook_id),
				// 'link' => '<a href=\'\' onclick="window.open(\''.$GLOBALS['egw_info']['server']['webserver_url'].'/index.php?menuaction=addressbook.addressbook_ui.edit&contact_id='.$addressbook_id.'\',\'\',\'width=900,height=800,scrollbars=1\')">'.client_bo::get_contact_fn($addressbook_id).'</a>',
				'link' => '<a href=\'\' onclick="window.open(\'index.php?menuaction=addressbook.addressbook_ui.edit&contact_id='.$addressbook_id.'\',\'\',\'width=900,height=800,scrollbars=1\')">'.client_bo::get_contact_fn($addressbook_id).'</a>',
			);
			++$i;
		}

		usort($retour,array($this,'contact_cmp'));
		$i = 2;
		foreach((array)$retour as $value){
			$temp[$i] = $value;
			++$i;
		}
		return $temp;
	}

	function contact_cmp(array $a, array $b){
	/**
	 * Tri des contacts
	 */
		if(strcasecmp($a['role'], $b['role']) == 0){
			return strcasecmp($a['name'], $b['name']);
		}else{
			return strcasecmp($a['role'], $b['role']);
		}
	}
	
	function get_contact_fn($id){
	/**
	 * Retourne le fullname (n_fn) du contact ayant l'id $id
	 *
	 * @param $id : identifiant du contact
	 * @return string : n_fn du contact
	 */
		$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
		$contact = $so_addressbook->read($id);
		return $contact['n_fn'];
	}
	
	function get_contrat($id){
	/**
	 * Retourne les contrats du clients $id
	 *
	 * @param $id : Id du client
	 * @return array 
	 */
		$contrat_supplier = $this->so_contrat->search(array('contract_supplier'=>$id),false);
		$contrat_client = $this->so_contrat->search(array('contract_client'=>$id),false);
		
		return array_merge(array('0'=>'0'),(array)$contrat_supplier,(array)$contrat_client);
	}
	
	function get_type_contrat(){
	/**
	* Retourne la liste des types de contrats dans un tableau à 2 dimensions. 
	*
	* @return array
	*/
		$retour = array();
		$type_contrat=$this->so_type_contrat->search('','type_id,type_label','type_label');
		if(is_array($type_contrat)){
			foreach((array)$type_contrat as $id => $value){
				$retour[$type_contrat[$id]['type_id']] = $type_contrat[$id]['type_label'];
			}
		}
		return $retour;
	}
	
	function get_status(){
	/**
	 * Retourne la liste de tout les statuts de contrat
	 *
	 * @return array
	 */
		$info = $this->so_statut_contrat->search('',false);
		$status = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['status_id']){
				$status[$value['status_id']] = $value['status_label'];
			}
		}
		return $status;
	}
	
	function get_sellers(){
	/**
	 * Retourne la liste des vendeurs
	 *
	 * @return array
	 */
		$retour = array();
		$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
		$so_accounts = new so_sql('phpgwapi','egw_accounts');
		
		$info = $this->search(array('client_seller_id'=>$id),'client_seller_id');
		foreach((array)$info as $key => $data){
			if($data['client_seller_id'] != 0){
				$seller = $so_accounts->read($data['client_seller_id']);
				$contact = $so_addressbook->search(array('account_id' => $data['client_seller_id']),'n_fn');
				$retour[$seller['account_id']] = $contact[0]['n_fn'];
			}
		}
		// asort($retour);
		return $retour;
	}
	
	function get_seller_name($id){
	/**
	 * retourne le full name du contact avec l'id de compte passer en paramètre
	 *
	 * @param $id : Identifiant du contact dont on veut le nom
	 * @return String
	 */
		$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
		$seller = $so_addressbook->search(array('account_id' => $id),'n_fn');

		if(!empty($seller[0]['n_fn'])){
			return $seller[0]['n_fn'];
		}else{
			$so_accounts = new so_sql('phpgwapi','egw_accounts');
			$seller = $so_accounts->read($id);
			return $seller['account_lid'];
		}		
	}
	
	function get_chalandise(){
	/**
	 *	Retourne les sociétés qui sont zone de chalandise
	 *
	 * @return array
	 */
		$retour = array();
		// $join = 'WHERE client_id IN (SELECT DISTINCT(client_chalandise) FROM spiclient WHERE client_chalandise IS NOT NULL AND client_chalandise <> 0)';
		$join = 'INNER JOIN spiclient SP ON spiclient.client_chalandise=SP.client_id';
		$chalandise = $this->search('',false,'spiclient.client_company','',$wildcard,false,$op,$start,$col_filter,$join);
		
		foreach((array)$chalandise as $key => $data){
			// $info = $this->read($data['client_chalandise']);
			$retour[$data['client_id']] = $this->truncate($data['client_company']);
		}
		asort($retour);
		return $retour;
	}
	
	function get_company_name($id){
	/**
	 * retourne le nom du client avec l'id passer en paramètre
	 *
	 * @param $id : Identifiant du client dont on veut le nom
	 * @return String
	 */
		if(empty($id)) return '';
		$info = $this->read($id);
		return $info['client_company'];
	}
	
	function get_role(){
	/**
	 * Retourne les roles
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_role->search('',false,'role_label');
		foreach((array)$info as $id => $value){
			$retour[$value['role_label']] = $value['role_label'];
		}
		return $retour;
	}
	
	function get_role_active(){
	/**
	 * Retourne les roles
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_role->search(array('role_active' => '1'),false,'role_label');
		foreach((array)$info as $id => $value){
			$retour[$value['role_label']] = $value['role_label'];
		}
		return $retour;
	}
	
	function get_group($id){
	/**
	 * Retourne le nom du groupe ayant l'id $id
	 *
	 * @param $id: identifiant du groupe
	 * @return String
	 */
		$group = $this->obj_accounts->search(array('type'=>'groups'));
		return $group[$id]['account_lid'];
	}
	
	function get_type_client(){
	/**
	 * Retourne les types de client
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_type_client->search('',false,'type_client_label');
		foreach((array)$info as $id => $value){
			$retour[$value['type_client_id']] = $value['type_client_label'];
		}
		return $retour;
	}
	
	function get_technique($id){
	/**
	 * Retourne la liste des natures technique avec leur valeurs pour le client $id
	 *
	 * @param $id : identifiant du client
	 * @return array
	 */
		$retour = array();
		$info = $this->so_client_nature->search(array('client_id' => $id),false,'client_nature_ordre');
		$i = 2;
		foreach((array)$info as $id => $value){
			$retour[$i] = $value;
			$retour[$i]['infos'] = 
			"<table>
				<tr><td valign=top><b>".lang('Description')." : </b></td><td>".str_replace("\n","<br />",$value['client_nature_description'])."</td></tr>
				<tr><td valign=top><b>".lang('In case of failure')." : </b></td><td>".str_replace("\n","<br />",$value['client_nature_panne'])."</td></tr>
				<tr><td valign=top><b>".lang('Comment')." : </b></td><td>".str_replace("\n","<br />",$value['client_nature_commentaire'])."</td></tr>
			</table>";
			++$i;
		}
		
		return $retour;
	}

	function get_address($id){
	/**
	 * Retourne la liste des natures technique avec leur valeurs pour le client $id
	 *
	 * @param $id : identifiant du client
	 * @return array
	 */
		$retour = array();
		$info = $this->so_address->search(array('client_id' => $id),false);
		$i = 2;
		foreach((array)$info as $id => $value){
			$retour[$i] = $value;
			
			$retour[$i]['address'] = implode("\n",array(
				$value['address_street_one'],
				$value['address_street_two'],
				$value['address_postalcode'].' '.$value['address_city'],
				$value['address_country'],
			));

			$retour[$i]['contact'] = implode("\n",array(
				$value['address_last_name'].' '.$value['address_first_name'],
				$value['address_mail'],
				lang('Tel').': '.$value['address_tel'],
				lang('Fax').': '.$value['address_fax'],
			));

			++$i;
		}
		return $retour;
	}

	function get_address_type(){
	/**
	 * Liste des types d'adresse
	 *
	 * @return array
	 */
		$return = array();

		$types = $this->so_address_type->search('', false);
		foreach($types as $type){
			$return[$type['address_type_id']] = $type['address_type_label'];
		}

		return $return;
	}
	
	function get_nature(){
	/**
	 * Retourne les natures technique
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_nature->search('',false,'nature_label');
		foreach((array)$info as $id => $value){
			$retour[$value['nature_id']] = $value['nature_label'];
		}
		return $retour;
	}
	
	function export(){
	/**
	 * Retourne la liste des champs a exportés
	 *
	 * @return array
	 */
		$retour = array(
			'client_id' => lang('ID'),
			'account_id_export' => lang('User group'),
			'client_company' => lang('company'),
			'client_seller_export' => lang('Seller'),
			'client_parent_export' => lang('Parent company'),
			'client_chalandise_export' => lang('Catchment'),
			// 'client_operation_code' => lang('Parc'),
			'client_sector_export' => lang('Secteur'),
			'client_region_export' => lang('Region'),
			'client_last_name' => lang('last name'),
			'client_first_name' => lang('first name'),
			'client_adr_one_street' => lang('Address'),
			'client_adr_two_street' => lang('Address'),
			'client_locality' => lang('Locality'),
			'client_postalcode' => lang('Postal code'),
			'client_email' => lang('email'),
			'client_manager_email' => lang('Manager Email'),
			'client_tel' => lang('tel'),
			'client_code_tiers' => lang('Tiers code'),
			'client_tva_number' => lang('TVA number'),
			'client_mode_reglement_export' => lang('Payment method'),
			'client_delai_paiement_export' => lang('Payment delay'),
			'client_adr_one_street_facturation' => lang('Bill address'),
			'client_adr_two_street_facturation' => lang('Bill address'),
			'client_locality_facturation' => lang('Locality'),
			'client_postalcode_facturation' => lang('Postal code'),
			'client_country_facturation' => lang('Country'),
			'client_sleep' => lang('Sleep'),
			'client_tva' => lang('TVA'),
			// 'client_billable_id' => lang('Billable by'),
			// 'client_payment_model' => lang('payment model'),
			'creator_id_export' => lang('Created by'),
			'creation_date_export' => lang('Creation date'),
			'maj_id_export' => lang('Modifier'),
			'change_date_export' => lang('Change date'),
		);
		return $retour;
	}
	
	function is_vendor($client_id){
	/**
	 * Vérifie si l'utilisateur courant est vendeur pour le client ayant l'identifiant $client_id
	 *
	 * @param $client_id int : identifiant du client
	 * @return boolean
	 */
		$client = $this->read($client_id);
		return $client['client_seller_id'] == $GLOBALS['egw_info']['user']['account_id'];
	}
	
	function get_spid_cat(){
	/**
	 * Retourne la liste des catégories dans spid
	 */
		$retour = array();
		
		// $cats = new categories($this->account_id,'spid');
		$cats = CreateObject('phpgwapi.categories',$this->account_id,'spid');


		$categories = $cats->return_array('all',0,false,'','','cat_id');
		
		foreach((array)$categories as $category){
			$retour[$category['id']] = $category['name'];
		}
		natcasesort($retour);
		return $retour;
	}
	
	function get_checklist($client_id){
	/**
	 * Retourne la checklist du client ayant l'identifiant $client_id
	 *
	 * @param $client_id int : identifiant du client
	 * @return array
	 */
		$retour = array();
		$checklists = $this->so_checklist->search(array('client_id' => $client_id),false,'cat_id ASC, chk_order ASC');
		$i = 1;
		foreach((array)$checklists as $checklist){
			$retour[$i] = $checklist;
			++$i;
		}
		return $retour;
	}


	public static function resize_photo($photo,$dst_w=120){
	/**
	 * Resizes photo to 60*80 pixel and returns it
	 *
	 * @param string|FILE $photo string with image or open filedescribtor
	 * @param int $dst_w=60 max width to resize to
	 * @return string with resized jpeg photo, null on error
	 */
		if (is_resource($photo))
		{
			$photo = stream_get_contents($photo);
		}
		if (empty($photo) || !($image = imagecreatefromstring($photo)))
		{
			error_log(__METHOD__."() invalid image!");
			return null;
		}
		$src_w = imagesx($image);
		$src_h = imagesy($image);
		//error_log(__METHOD__."() got image $src_w * $src_h, is_jpeg=".array2string(substr($photo,0,2) === "\377\330"));

		// if $photo is to width or not a jpeg image --> resize it
		if ($src_w > $src_w || substr($photo,0,2) !== "\377\330")
		{
			// scale the image to a width of 60 and a height according to the proportion of the source image
			$resized = imagecreatetruecolor($src_w,$src_h);
			imagecopyresized($resized,$image,0,0,0,0,$src_w,$src_h,$src_w,$src_h);

			ob_start();
			imagejpeg($resized,'',90);
			$photo = ob_get_contents();
			ob_end_clean();

			imagedestroy($resized);
			//error_log(__METHOD__."() resized image $src_w*$src_h to $dst_w*$dst_h");
		}
		imagedestroy($image);

		return $photo;
	}

	function photo_src($id,$jpeg,$default=''){
	/**
	 * src for photo: returns array with linkparams if jpeg exists or the $default image-name if not
	 * @param int $id contact_id
	 * @param boolean $jpeg=false jpeg exists or not
	 * @param string $default='' image-name to use if !$jpeg, eg. 'template'
	 * @return string/array
	 */
		return $jpeg ? array(
			'menuaction' => 'spiclient.client_ui.photo',
			'client_id' => $id,
		) : $default;
	}
	
	function info_addressbook($contact_id){
	/**
	* Renvoie un tableau contenant les informations au sujet du contact passé en argument ($contact_id).
	*
	* @param int $contact_id
	* @return array
	*/
		if (!is_object($GLOBALS['egw']->contacts)){
			$GLOBALS['egw']->contacts = CreateObject('phpgwapi.contacts',$this->account_id,'spid');
		}
		if (isset($GLOBALS['egw']->contacts)){
			$contacts = $GLOBALS['egw']->contacts;
		}else{
			$contacts = new contacts($this->account_id,'spid');
		}
		$addressbook = $contacts->read($contact_id);
		return $addressbook;
	}
	
	function user2addressbook_id($user_id){
	/**
	 * Retourne l'identifiant de l'addressbook de l'utilisateur ayant l'identifiant $user_id
	 *
	 * @param $user_id int : identifiant de l'utilisateur (table accounts)
	 * @return int : identifiant dans l'addressbook
	 */
		$user = $this->obj_accounts->read($this->account_id);
		$contact = $this->info_addressbook($user['person_id']);
		return $contact['id'];
	}
	
	function get_my_orgs(){
	/**
	 * Liste les organisations de l'utilisateur en cours
	 * 
	 */
		$my_contact_id = $this->user2addressbook_id($GLOBALS['egw_info']['user']['account_id']);
	 	$join = '
			LEFT JOIN (SELECT * FROM egw_links as A 
			WHERE A.link_id2 ='.$my_contact_id.' AND A.link_app1 = "spiclient" AND A.link_app2 = "addressbook" 
			)
			AS LA ON spiclient.client_id = LA.link_id1
			LEFT JOIN (SELECT * FROM egw_links as B 
			WHERE B.link_id1 ='.$my_contact_id.' AND B.link_app1 = "addressbook" AND B.link_app2 = "spiclient")
			AS LB ON spiclient.client_id = LB.link_id2
			WHERE (LA.link_id is not NULL OR LB.link_id is not NULL)
			';
		//A améliorer pour ne récupérer que l'id et le nom...
		$rows = $this->search($search,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		// _debug_array($rows);
		foreach((array)$rows as $key => $data){
			$retour[$data['client_id']] = $this->truncate($data['client_company']);
		}
		
		return $retour;
	}
	
	
	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les clients. Retourne le nombre de lignes
	 * 
	 * \version BBO - 02/08/2010 - Si le client est un prestataire et qu'il à des clients, alors impossible de le supprimer
	 * \version BBO - 03/08/2010 - Définition de la classe de la ligne pour les clients en sommeil ou ayant des problème de configuration
	 * \version BBO - septembre 2011 - Refonte pour intégration dans spiclients
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if (!empty($query['filter2'])){
			$query['col_filter']['client_type'] = $query['filter2'];
		}else{
			unset($query['col_filter']['client_type']);
		}
		
		// YLF - traitement pour la page "Mes Clients", "Mes prospect", "Mes organisations.."
		if(!empty($query['filter_client'])){
			$query['col_filter']['client_seller_id'] = $GLOBALS['egw_info']['user']['account_id'];
			switch($query['filter_client']){
				case 'myleads':
					$query['col_filter']['client_type'] = $this->obj_config['ProspectType'];
					break;
				case 'myclients':
					$query['col_filter']['client_type'] = $this->obj_config['ClientType'];
					break;
				case 'myorgs':
					$my_contact_id = $this->user2addressbook_id($GLOBALS['egw_info']['user']['account_id']);
					$join = '
					LEFT JOIN (SELECT * FROM egw_links as A 
					WHERE A.link_id2 ='.$my_contact_id.' AND A.link_app1 = "spiclient" AND A.link_app2 = "addressbook" 
					)
					AS LA ON spiclient.client_id = LA.link_id1
					LEFT JOIN (SELECT * FROM egw_links as B 
					WHERE B.link_id1 ='.$my_contact_id.' AND B.link_app1 = "addressbook" AND B.link_app2 = "spiclient")
					AS LB ON spiclient.client_id = LB.link_id2
					WHERE (LA.link_id is not NULL OR LB.link_id is not NULL)
					';
					unset($query['col_filter']['client_seller_id']);
					unset($query['col_filter']['client_type']);
					break;
			}
			
		}

		// Filtre client en sommeil
		$query['col_filter']['client_sleep'] = false;
		if($query['client_sleep'] || $GLOBALS['egw_info']['flags']['currentapp'] != 'spiclient'){
			$query['col_filter']['client_sleep'] = array(true,false);
		}

		if($query['client_mod']){
			if(empty($join)){
				$join = 'WHERE (';
			}else{
				$join .= ' AND (';
			}

			$join .= 'change_date BETWEEN '.strtotime('-7 days').' AND '.time().' OR creation_date BETWEEN '.strtotime('-7 days').' AND '.time();
		}
	 
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		if ((int)$query['filter'] && (int)$query['filter']!=0){
			// $query['col_filter']['client_id'] = (string) (int) $query['filter'];
			$join = 'INNER JOIN spiclient_relations ON spiclient.client_id = spiclient_relations.client_id WHERE societe_id ='.$query['filter'];
		}else{
			unset($query['col_filter']['client_id']);
		}

		$order = 'client_company';
		if(!empty($query['order'])){
			$order='spiclient.'.$query['order'].' '.$query['sort'];	
		}
		
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		if ($query['searchletter']){
			$query['col_filter'][] = 'client_company '.$GLOBALS['egw']->db->capabilities['case_insensitive_like'].' '.$GLOBALS['egw']->db->quote($query['searchletter'].'%');
		}
			$wildcard = '%';
		$op = 'OR';
		if(!is_array($query['search'])){
			$search=$this->construct_search($query['search']);
		}else{
			$search = $query['search'];
		}
		
		// Cas de la recherche ajax, séparateur ": "
		if(strpos($query['search'], ': ') == true) {
			unset($search);
			$recherche = explode(': ',$query['search'],2);
			$search['client_code_tiers']=$recherche[0];
			$search = array_filter($search);
			$need_count = true;
			$id_only = true;
		}
		// $this->debug = 5;

		$rows = parent::search($search,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);

		if ($need_count) { return count($rows); }
		
		if(!$rows){
			$rows = array();
		}
		// $order = $query['order'];
		$readonlys = $readonlys;
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Client Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		if($query['filter']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search company '%1'",$this->idcompany2name($query['filter']));
		}
		
		foreach((array)$rows as $id=>$value){	
			if($query['csv_export']){
				$rows[$id]['account_id_export'] = $this->get_group($rows[$id]['account_id']);
				$rows[$id]['client_seller_export'] = $this->get_seller_name($rows[$id]['client_seller_id']);
				$rows[$id]['client_parent_export'] = $this->get_company_name($rows[$id]['client_parent']);
				$rows[$id]['client_chalandise_export'] = $this->get_company_name($rows[$id]['client_chalandise']);
				$rows[$id]['client_sector_export'] = empty($rows[$id]['client_sector']) ? '' : $this->get_sectors($rows[$id]['client_sector']);
				$rows[$id]['client_region_export'] = empty($rows[$id]['client_region']) ? '' : $this->get_zone($rows[$id]['client_region']);
				$rows[$id]['creator_id_export'] = $this->get_seller_name($rows[$id]['creator_id']);
				$mode = $this->get_mode_reglement($rows[$id]['client_mode_reglement']);
				$rows[$id]['client_mode_reglement_export'] = $mode[$rows[$id]['client_mode_reglement']];
				$delai = $this->get_delai_paiement($rows[$id]['client_delai_paiement']);
				$rows[$id]['client_delai_paiement_export'] = $delai[$rows[$id]['client_delai_paiement']];
				$rows[$id]['creation_date_export'] = date('d/m/Y',$rows[$id]['creation_date']);
				$rows[$id]['change_date_export'] = date('d/m/Y',$rows[$id]['change_date']);
				$rows[$id]['maj_id_export'] = $this->get_seller_name($rows[$id]['maj_id']);
			}
			
			$rows[$id]['adresse'] =
				$value['client_adr_one_street']."<br />".
				$value['client_adr_two_street']."<br />".
				$value['client_postalcode']." ".$value['client_locality']."<br />";

			// Donne une classe pour les lignes des clients en sommeil (permet d'avoir un CSS spécifique)
			$rows[$id]['client_class'] = $value['client_sleep'] ? 'sleep' : '';
			
			$GLOBALS['egw']->country = empty($GLOBALS['egw']->country) ? CreateObject('phpgwapi.country') : $GLOBALS['egw']->country;
			if($GLOBALS['egw']->country->get_full_name($GLOBALS['egw_info']['user']['preferences']['common']['country']) != $value['client_country']){
				$rows[$id]['adresse'] .= $value['client_country'];
			}


			// Masque l'ajout de ticket si client en sommeil ou pas de spid pour l'utilisateur courant
			$user_apps = array_keys($GLOBALS['egw_info']['user']['apps']);
			if($value['client_sleep'] || !in_array('spid',$user_apps)){
				$readonlys['spid['.$value['client_id'].']'] = true;
			}

			if($value['client_sleep'] || !in_array('infolog', $user_apps)){
				$readonlys['task['.$value['client_id'].']'] = true;
				$readonlys['note['.$value['client_id'].']'] = true;
				$readonlys['phone['.$value['client_id'].']'] = true;
			}
		}
		
		/* On désactive la suppression si elle n'est pas autorisée dans la config */
		if(!$this->obj_acl->clientRemoval){
			foreach((array)$rows as $id=>$value){
				$readonlys['delete['.$value['client_id'].']'] = true;
			}
		}
		
		return $this->total;	
    }
	
	
    function get_apps($content){
	/**
	 * Retourne les applications à lié dans spiclient
	 *
	 * @return array
	 */
		// Module liés
		$apps = array('spid', 'spifina', 'spiquote', 'infolog');
		foreach($apps as $app){
			// Ajout d'un lien uniquement pour les applications accessible par l'utilisateur
			if($GLOBALS['egw_info']['user']['apps'][$app]){
				// Récupération des hooks
				$hooks = $GLOBALS['egw']->hooks->single('search_link', $app);
				
				// Paramètre de création
				$params[$hooks['add_app']] = 'spiclient';
				$params[$hooks['add_id']] = $content['client_id'];

				// URL pour le module
				$link = egw::link('/index.php', array_merge($hooks['add'], $params),false);

				// Ajout dans le tableau
				$return[$link] = $app;
			}
		}

		return $return;
	}	
}	
?>
