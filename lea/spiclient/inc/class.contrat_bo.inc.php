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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.contrat_so.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	

class contrat_bo extends contrat_so 
{
	var $tabs = 'general|contact|budget|conditions|comment|reference|link|history';
	
	var $period = array(
		'Mensuel' => 'Mensuel',
		'Trimestriel' => 'Trimestriel',
		'Semestriel' => 'Semestriel',
		'Annuel' => 'Annuel',
	);
	
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
		
	function contrat_bo(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function get_info($id){
		/**
		* Routine permettant d'obtenir les informations sur le contrat passé en argument
		*
		* @param int $id indentifiant du contrat dont on veut les informations
		* @return string
		*/
		$info=$this->search(array('contract_id'=>$id),false);
		return $info[0];
	}

	function get_contact($id){
	/**
	 * Retourne la liste des contacts
	 *
	 * @param $id : identifiant du contrat
	 * @return array
	 */
		$retour = array();
		$i = 4;
		
		$contacts = $this->so_member->search(array('contract_id' => $id),false);
		foreach((array)$contacts as $contact){
			$account = $GLOBALS['egw']->accounts->read($contact['account_id']);
			$contact_data = $GLOBALS['egw']->contacts->read($account['person_id']);

			$retour[$i] = array(
				'appli' => '<img src="http://ylf.test.spirea.fr/addressbook/templates/default/images/navbar.png" id="2[appli]" border="0" width="16px">',
				'title' => $contact_data['contact_id'],
				'account_id' => $contact['account_id'],
				'email' => $contact_data['contact_email'],
				'tel_fixe' => $contact_data['tel_work'],
				'tel_port' => $contact_data['tel_cell'],
				'role'	=> $contact['role_id'],
				'name' => $contact_data['n_fn'],
				'link' => '<a href=\'\' onclick="window.open(\''.$GLOBALS['egw_info']['server']['webserver_url'].'/index.php?menuaction=addressbook.addressbook_ui.edit&contact_id='.$contact_data['contact_id'].'\',\'\',\'width=600,height=600,scrollbars=1\')">'.$contact_data['n_fn'].'</a>',
			);

			++$i;
		}

		// usort($retour,array($this,'contact_cmp'));
		// $i = 2;
		// foreach((array)$retour as $value){
		// 	$temp[$i] = $value;
		// 	++$i;
		// }
		return $retour;
	}
	
	function add_update_contrat($content=null){
		/**
		* Routine permettant de créer/modifier (si le contrat existe déjà) le contrat actuel, à partir des arguments passés dans $content. $content doit contenir un champ contract_id pour définir le contrat à créer/mettre à jour
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=NULL
		* @return string
		*/
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spiclient']);
			unset($content['msg']);
			// if(empty($content['contract_amount'])) $content['contract_amount'] = 0;
			if(isset($content['contract_id'])){
				$this->historique($content);

				$this->data = $content;
				$this->data['change_date']=time();
				$this->data['change_id']=$this->account_id;
				$this->update($this->data,true);
				$msg='Contract updated';
			}else{
				$this->data = $content;
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Contract created';
			}
		}
		return $msg;
	}
	
	function historique($content){
	/**
	 * Fonction permettant l'historisation des valeurs (lors d'une mise a jour d'un contrat)
	 *
	 * @param $content : info concernant le contrat (contient les infos avec les nouvelles valeurs)
	 * @return void
	 */
		// Valeur actuel du contrat
		$id = $content['contract_id'];
		$old = $this->read($id);

		// Nouvelles valeurs
		$history = array_diff_assoc($content,$old);
		// $infoHistory = $history['history'];

		$FieldIgnore = array('config','link_to','general|conditions|details','general|conditions|comment|link|history','hideupdate','hidecreate','history','contact', 'budget','general|contact|budget|conditions|comment|link|history','general|contact|budget|conditions|comment|reference|link|history','help_budget','reference','invoice');
		$FieldDate = array('date_signature','date_renewal','date_end','date_last_invoice','date_start','change_date');
		$FieldExternal = array(
			'status_id' => array('table' => $this->so_statut_contrat,'field' => 'status_label'),
			'type_id' => array('table' => $this->so_type_contrat,'field' => 'type_label'),
			'contract_supplier' => array('table' => $this->so_client,'field' => 'client_company'),
			'contract_client' => array('table' => $this->so_client,'field' => 'client_company'),
			'contract_payer' => array('table' => $this->so_client,'field' => 'client_company'),
			'contract_client' => array('table' => $this->so_client,'field' => 'client_company'),

			// 'contract_period' => array('table' => $this->so_,'field' => 'area_label'),
			'client_chalandise' => array('table' => $this,'field' => 'client_company'),
			'client_mode_reglement' => array('table' => $this->so_mode_reglement,'field' => 'mode_reglement_label'),
			'client_delai_paiement' => array('table' => $this->so_delai_paiement,'field' => 'delai_label'),
		);
		$FieldUser = array('contract_manager_id', 'contract_seller_id');
		$FieldText = array('contract_conditions', 'comment');
		
		$historylog = CreateObject('phpgwapi.historylog','spicontrat');

		// Historisation des field
		foreach($history as $field => $value){
			if(!in_array($field,$FieldIgnore)){
				// test afin de savoir si on est sur une valeur qui etait null (mais qui apparait avec la valeur 0) cas des listes
				if(!($value == null && $old[$field] == '0')){
					if(in_array($field, $FieldDate)){
						$historylog->add(lang($field),$id,empty($value) ? '' : date('d/m/Y H:i',$value),empty($old[$field]) ? '' : date('d/m/Y H:i',$old[$field]));
					}else{
						if(array_key_exists($field,$FieldExternal)){
							$new_value = $FieldExternal[$field]['table']->read($value);
							$old_value = $FieldExternal[$field]['table']->read($old[$field]);

							$historylog->add(lang($field),$id,$new_value[$FieldExternal[$field]['field']],$old_value[$FieldExternal[$field]['field']]);
						}else{
							if(in_array($field,$FieldUser)){
								$new_contact = $GLOBALS['egw']->accounts->read($value);
								$old_contact = $GLOBALS['egw']->accounts->read($old[$field]);
								
								$new_name = $new_contact['account_firstname'].' '.$new_contact['account_lastname'];
								$old_name = $old_contact['account_firstname'].' '.$old_contact['account_lastname'];
								$historylog->add(lang($field),$id,$new_name,$old_name);
							}else{
								if(in_array($field,$FieldText)){
									$value = $this->truncate($value);
									$old[$field] = $this->truncate($old[$field]);
								}
								$historylog->add(lang($field),$id,$value,$old[$field]);
							}
						}
					}
				}
			}
		}
	}
	
	function get_type_contrat($id=''){
	/**
	 * Retourne la liste des types de contrats dans un tableau à 2 dimensions. 
	 *
	 * @return array
	 */
		$retour = array();
		$type_contrat=$this->so_type_contrat->search(array('type_id'=>$id),'type_id,type_label','type_label');
		if(is_array($type_contrat)){
			foreach((array)$type_contrat as $id => $value){
				$retour[$type_contrat[$id]['type_id']] = $type_contrat[$id]['type_label'];
			}
		}
		return $retour;
	}
	
	function get_statut_contrat($id=''){
		/**
		* Retourne la liste des statuts de contrats dans un tableau à 2 dimensions. 
		*
		* @return array
		*/
		$retour = array();
		$statut_contrat=$this->so_statut_contrat->search(array('status_id'=>$id),'status_id,status_label','status_label');
		if(is_array($statut_contrat)){
			foreach((array)$statut_contrat as $id => $value){
				$retour[$statut_contrat[$id]['status_id']] = $statut_contrat[$id]['status_label'];
			}
		}
		return $retour;
	}
	
	function get_all_relations(){
		/**
		* Retourne la liste des relations dans un tableau à 2 dimensions. 
		*
		* @return array
		*/
		$retour = array();
		$relation=$this->so_clients_relations->search('','relation_id,operation_code');
		if(is_array($relation)){
			foreach((array)$relation as $id => $value){
				if(strlen($relation[$id]['operation_code'])>0){
					$retour[$relation[$id]['relation_id']] = $relation[$id]['operation_code'];
				}
			}
		}
		return $retour;
	}

	function get_relation($id){
		/**
		 * Retourne le fournisseur et le client de la relation avec l'id $id
		 *
		 * @param $id id de la relation dont on cherche le fournisseur et le client
		 * @return array
		 */
		$relation = $this->so_clients_relations->search(array('relation_id'=>$id),false);
		$fournisseur = $this->so_client->search(array('client_id'=>$relation[0]['societe_id']),'client_company');
		$client = $this->so_client->search(array('client_id'=>$relation[0]['client_id']),'client_company');
		return array('relation_fournisseur'=>$fournisseur[0]['client_company'], 'relation_client'=>$client[0]['client_company']);
	}
	
	function type2name($id){
		/**
		 * Retourne le libellé du type possédant l'id $id
		 *
		 * @param $id id du type dont on cherche le libellé
		 * @return String
		 */
		$type = $this->so_type_contrat->search(array('type_id'=>$id),'type_label');
		return $type[0]['type_label'];
	}
	
	function get_period(){
		/**
		 * Retourne les listes des periodes utilisables lors de la creation d'un contrat (variable créer et initialisé dans ce fichier)
		 * Des périodes peuvent être ajouté/enlevé directement dans la déclaration de la variable
		 *
		 * @return array
		 */
		asort($this->period);
		return $this->period;
	}
	
	function get_suppliers(){
		/**
		 * Retourne la liste de tout les clients
		 *
		 * @return array
		 */
		$info = $this->so_client->search('',false,'client_company ASC');
		$companies = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['client_id']){
				$companies[$value['client_id']] = $this->truncate($value['client_company']);
			}
		}
		return $companies;
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
	
	function get_type(){
		/**
		 * Retourne la liste de tout les types de contrat
		 *
		 * @return array
		 */
		$info = $this->so_type_contrat->search('',false);
		$status = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['type_id']){
				$status[$value['type_id']] = $value['type_label'];
			}
		}
		return $status;
	}
	
	function get_providers(){
	/**
	 * Permet de récuperer la liste des fournisseurs
	 *
	 * @return array
	 */
		$ClientsRelations=$this->so_clients_relations->search('','societe_id');
		$fournisseurs = array();
		if(is_array($ClientsRelations))
		{
			foreach((array)$ClientsRelations as $cle=>$valeur)
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

	function get_role_active(){
	/**
	 * Retourne les roles
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_role->search(array('role_active' => '1'),false,'role_label');
		foreach((array)$info as $id => $value){
			$retour[$value['role_id']] = $value['role_label'];
		}
		return $retour;
	}

	function get_facture_cat(){
	/**
	 * retourne la liste des categories de facture
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_facture_categories->search('',false,'cat_label');
		foreach((array)$info as $id => $value){
			$retour[$value['cat_id']] = $value['cat_label'];
		}
		return $retour;
	}

	function get_units(){
	/**
	 * retourne la liste des unités possible pour les budgets
	 *
	 * @return array
	 */
		return array(
			'e' => lang('€'),
			'd' => lang('d'),
		);
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
		return '#'.$entry['contract_id'].': '.$entry['contract_title'];
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
		if (($tickets = $this->search(array('contract_id' => $ids),'contract_id,contract_title')))
		{
			foreach((array)$tickets as $ticket)
			{
				$titles[$ticket['contract_id']] = $this->link_title($ticket);
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
	 * @return array with client_id - contract_title pairs of the matching entries
	 */
	function link_query($pattern)
	{
		$result = array();
		foreach((array) $this->search(array('contract_title' => $pattern),false,'contract_id ASC','','%',false,'OR',false,'') as $item )
		{
			if ($item) $result[$item['contract_id']] = $this->link_title($item);
		}
		return $result;
	}
	
	function get_company_name($id){
	/**
	 * retourne le nom du client avec l'id passer en paramètre
	 *
	 * @param $id : Identifiant du client dont on veut le nom
	 * @return String
	 */
		if(empty($id)) return '';
		$info = $this->so_client->search(array('client_id'=>$id),false,'client_company');
		return $info[0]['client_company'];
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
	
	function export(){
	/**
	 * Retourne la liste des champs a exportés
	 *
	 * @return array
	 */
		$retour = array(
			'contract_id' => lang('ID'),
			'contract_supplier_export' => lang('Supplier'),
			'contract_client_export' => lang('Client'),
			'type_id_export' => lang('Type'),
			'status_id_export' => lang('Status'),
			'contract_title' => lang('Title'),
			'date_signature_export' => lang('Signature Date'),
			'date_renewal_export' => lang('Renewal Date'),
			'date_end_export' => lang('End Date'),
			'date_last_invoice_export' => lang('Last Invoice'),
			'contract_amount' => lang('Amount'),
			'contract_period' => lang('Period'),
			'contract_client_ref' => lang('Client reference'),
			'contract_seller_id_export' => lang('Seller'),
			'contract_n_budget_days' => lang('n_budget_days'),
			'contract_n_budget_amount' => lang('n_budget_amount'),
			'contract_n_real_days' => lang('n_real_days'),
			'contract_n_real_amount' => lang('n_real_amount'),
			'contract_libre1' => lang('libre1'),
			'contract_libre2' => lang('libre2'),
			'contract_libre3' => lang('libre3'),
			'contract_libre4' => lang('libre4'),
			'contract_libre5' => lang('libre5'),
		);
		return $retour;
	}

	function get_budget($contract_id){
	/**
	 * Retourne les budget pour un contrat
	 *
	 * @param $contract_id : identifiant du contrat
	 * @return array
	 */
		$retour = array();
		$i = 4;
		
		$total = array('budget_phase' => lang('TOTAL'), 'class' => 'total', 'class_delete' => 'no_delete');
		$budgets = $this->so_budget->search(array('contract_id' => $contract_id), false, 'budget_date ASC');
		foreach((array)$budgets as $budget){
			$retour[$i] = $budget;

			$total['budget_cost'] += $budget['budget_cost'];
			$total['budget_sell'] += $budget['budget_sell'];
			++$i;
		}

		$total['budget_cost'] = number_format($total['budget_cost'],2,'.','');
		$total['budget_sell'] = number_format($total['budget_sell'],2,'.','');
		$retour[$i] = $total;
		return $retour;
	}

	function get_reference($contract_id){
	/**
	 * Liste les références lié au contrat $contract_id
	 *
	 * @param $contract_id : identifiant du contrat
	 * @return array
	 */
		$return = array();
		$i = 1;
		$so_ref = new so_sql('spiref', 'spiref_reference');

		$refs = $so_ref->search(array('ref_contrat' => $contract_id), false);
		foreach($refs as $ref){
			$return[$i] = $ref;
			++$i;
		}

		return $return;
	}

	function get_invoice($contract_id){
	/**
	 * Liste les factures lié au contrat $contract_id
	 *
	 * @param $contract_id : identifiant du contrat
	 * @return array
	 */
		$return = array();
		$i = 1;
		$so_invoice = new so_sql('spifina', 'spifina_factures');

		$invoices = $so_invoice->search(array('contract_id' => $contract_id), false);
		foreach($invoices as $invoice){
			$return[$i] = $invoice;
			++$i;
		}

		return $return;
	}
}	
?>
