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


class client_so extends so_sql{

	var $spiclient_client='spiclient';
	var $spiclient_relations='spiclient_relations';
	var $spiclient_contrat = 'spiclient_contrats';	
	var $spiclient_sectors = 'spiclient_sectors';
	var $spiclient_mode_reglement = 'spiclient_mode_reglement';
	var $spiclient_delai_paiement = 'spiclient_delai_paiement';
	var $spiclient_zone = 'spireapi_area';
	var $spiclient_statut_contrat='spiclient_contrats_status';
	var $spiclient_type_contrat='spiclient_contrats_type';
	var $spiclient_role = 'spiclient_roles';
	var $spiclient_type_client = 'spiclient_type_client';
	var $spiclient_nature = 'spiclient_nature_technique';
	var $spiclient_client_nature = 'spiclient_client_nature';
	var $spiclient_checklist = 'spiclient_checklist';

	var $spiclient_address = 'spiclient_address';
	var $spiclient_address_type = 'spiclient_address_type';
	
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
	var $so_sectors;
	var $so_mode_reglement;
	var $so_delai_paiement;
	var $so_zone;
	var $so_statut_contrat;
	var $so_type_contrat;
	var $so_role;
	var $so_type_client;
	var $so_nature;
	var $so_client_nature;
	var $so_checklist;

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
	*Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spiclient']['title'];
		
		parent::__construct('spiclient',$this->spiclient_client,null,'',true);
		
		$this->so_contrat = CreateObject('etemplate.so_sql');
		$this->so_contrat = new so_sql('spiclient',$this->spiclient_contrat);
		$this->so_reponses = new so_sql('spiclient',$this->spiclient_reponses);
		$this->so_reponses_standard = new so_sql('spiclient',$this->spiclient_reponses_standard);
		$this->so_etats = new so_sql('spiclient',$this->spiclient_etats);
		$this->so_prix_parametres = new so_sql('spiclient',$this->spiclient_prix_parametres);
		$this->so_factures = new so_sql('spiclient',$this->spiclient_factures);
		$this->so_factures_details = new so_sql('spiclient',$this->spiclient_factures_details);
		$this->so_ticket = new so_sql('spiclient',$this->spiclient_tickets);
		$this->so_transitions = new so_sql('spiclient',$this->spiclient_transitions);
		$this->so_clients_relations = new so_sql('spiclient',$this->spiclient_relations);
		$this->so_sectors = new so_sql('spiclient',$this->spiclient_sectors);
		$this->so_mode_reglement = new so_sql('spiclient',$this->spiclient_mode_reglement);
		$this->so_delai_paiement = new so_sql('spiclient',$this->spiclient_delai_paiement);
		$this->so_zone = new so_sql('spireapi',$this->spiclient_zone);
		$this->so_statut_contrat = new so_sql('spiclient','spiclient_contrats_status');
		$this->so_type_contrat = new so_sql('spiclient', $this->spiclient_type_contrat);
		$this->so_role = new so_sql('spiclient', $this->spiclient_role);
		$this->so_type_client = new so_sql('spiclient', $this->spiclient_type_client);
		$this->so_nature = new so_sql('spiclient', $this->spiclient_nature);
		$this->so_client_nature = new so_sql('spiclient', $this->spiclient_client_nature);
		$this->so_checklist = new so_sql('spiclient', $this->spiclient_checklist);

		$this->so_address = new so_sql('spiclient', $this->spiclient_address);
		$this->so_address_type = new so_sql('spiclient', $this->spiclient_address_type);
		
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
	
	function company_billable($first='All'){
	/**
	 * Précise la liste des entreprises facturables à partir d'un identifiant de départ. 
	 *
	 * La valeur de retour est un tableau des entreprises facturables à partir de l'entreprise précisées en entrée (index: Id de l'entreprise, valeur: nom de l'entreprise)
	 *
	 * @param string $first='All' définit l'Identifiant de la première entreprise à être examinée dans la table
	 * @return array
	 */
		$company=$this->search('client_billable_id=0',false);
		$companies=array();
		$companies[0]=$first;
		if(!empty($company)){
			foreach((array)$company as $id=>$value){
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
	
	function control_group(){
	/**
	 * Cette fonction permet de vérifier si les groupes associés aux clients existent toujours en tant que groupes egroupware.
	 *
	 * Le tableau de retour précise les Identifiants des clients en erreur (qui n'existent plus en tant que groupes)
	 *
	 * \version BBO - 22/06/2010 : Création
	 *
	 * \version BBO - 03/08/2010 : MAJ du message d'erreur
	 * @return array
	 */
		$msg='';
		$client_error=array();
		$clients=$this->search(array(),'client_id,account_id,client_company');
		foreach((array)$clients as $id=>$client){
			$account=$this->obj_accounts->read($client['account_id']);
			if(!is_array($account)){
				$client_error[$id]=$client;
			}
			
		}
		return $client_error;
	}
	
	function getNbrClients($societe_id)
	{
	/**
	 * Cette fonction permet de répérer le nombre de clients pour un prestataire donné
	 *
	 * \version BBO - 02/08/2010 : Création
	 *
	 * @param int $societe_id prestataire
	 * @return int
	 */
		$clientsRelations=$this->so_clients_relations->search(array('societe_id'=>$societe_id),false);
		$count=0;
		if(is_array($clientsRelations))
		{
			$count=count($clientsRelations);
		}
		return $count;
	}
	
	function get_possible_parents($current_id=''){
	/**
	 * Retourne la liste complete des clients pouvant être parent du client ayant l'id $current_id
	 * (si on créer un nouveau client $current_id = "" donc la fonction marche aussi)
	 * @return array
	 */
		if($this->group_level($current_id) == 2){
			$possible_parents = array();
		}else{
			$possible_parents =  $this->get_subgroup_client($current_id) + $this->get_group_client($current_id);
		}
		asort($possible_parents);
		return $possible_parents;
	}

	function get_parent_client(){
	/**
	 * Retourne la liste des clients qui sont parent d'un ou plusieurs client
	 *
	 * @return array
	 */
		$return = array();
		$join = 'WHERE client_parent <> ""';
		$clients = $this->search('',false,$order,'','',false,'AND',false,array(),$join);
		foreach((array)$clients as $client){
			$parent = $this->read($client['client_parent']);
			$return[$parent['client_id']] = $parent['client_company'];
		}

		return $return;
	}
	
	function group_level($id){
	/**
	 * Retourne le niveau du client dans la hiérarchie (0 = aucun client en dessous ou au dessus, 1 = sous-groupe, 2 = groupe, 3 = filiale ou nouveau client)
	 * (si on créer un nouveau client $id = "" donc la fonction marche aussi)
	 * @return boolean
	 */
		$level = 0;
		$check = array(null,0,false,'');
		if(!in_array($id, $check)){
			$groups = $this->search(array('client_parent'=>$id),false);
			if(is_array($groups)){
				++$level;
				foreach((array)$groups as $key => $data){
					$subgroups = $this->search(array('client_parent'=>$data['client_id']),false);
					if(is_array($subgroups)){
						++$level;
					}
				}
			}
		}
		// Le client en cours n'est ni groupe ni sous-groupe (donc soit un client sans filiation soit une filiale)
		if($level == 0){
			$info = $this->search(array('client_id'=>$id),false);
			if(isset($info[0]['client_parent'])) $level = 3;
		}
		return $level;
	}
	
	function get_group_client($current_id){
	/**
	 * Retourne les clients qui sont des Groupes (ceux qui n'ont pas de parent)
	 * ($current_id permet d'exclure le client en cours d'édition s'il existe)
	 *
	 * @return array
	 */
		$info = $this->search(array('client_parent'=>array(null,0,false,''), 'client_is_parent' => true),false);
		$companies = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['client_id']){
				$companies[$value['client_id']] = $this->truncate($value['client_company']);
			}
		}
		return $companies;	
	}
	
	function get_subgroup_client($current_id){
	/**
	 * Retourne les clients qui sont des sous-groupes (ceux qui n'ont qu'un parent au dessus d'eux)
	 * Permet de limiter les clients a trois "étages" Groupe > sous-Groupe > Filiale
	 * ($current_id permet d'exclure le client en cours d'édition s'il existe)
	 * 
	 * @return array
	 */	
		$group = $this->get_group_client($current_id);
		$client_parent = array_keys($group);
		if(empty($group)){
			$client_parent = '';
		}
		$info = $this->search(array('client_parent'=>$client_parent, 'client_is_parent' => true),false);
		$companies = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['client_id']){
				$companies[$value['client_id']] = $this->truncate($value['client_company']);
			}
		}
		return $companies;
	}

	function get_client_chalandise($current_id){
	/**
	 * retourne la liste des zones de chalandises
	 *
	 * @return array
	 */
		$info = $this->search(array('client_is_chalandise' => true),false);
		$companies = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['client_id']){
				$companies[$value['client_id']] = $this->truncate($value['client_company']);
			}
		}
		return $companies;
	}

	function get_contract($field){
	/**
	 * Retourne la liste des clients/fournisseurs de contrat
	 *
	 * @return array
	 */
		$companies = array();
		$join = 'WHERE client_id IN (SELECT '.$field.' FROM spiclient_contrats)';
		$clients = $this->search('',false,$order,'','',false,'AND',false,array(),$join);
		foreach((array)$clients as $client){
			$companies[$client['client_id']] = $client['client_company'];
		}

		return $companies;
	}

	function zzz_truncate($string, $limit=40, $break="-", $pad="...") { 
		// return with no change if string is shorter than $limit 
		if(strlen($string) <= $limit) return $string; 
		
		
		$string = substr($string, 0, $limit) . $pad; 

		return $string; 
	}
	
		function truncate($string, $limit=100, $break="-", $pad="...") { 
	/**
	 * Fonction de cropage
	 *
	 * YLF - 19/02/2016 - Modif limit passage de 20 a 100
	 */
		if(mb_strlen($string) <= $limit) return $string; 
		
		$string = mb_substr($string, 0, $limit) . $pad; 

		return $string; 
	}
	
	
	function add_update_client($content=null){
		/**
		* Routine permettant de créer/modifier (si le client existe déjà) le client actuel, à partir des arguments passés dans $content. $content doit contenir un champ client_id pour définir l'utilisateur à créer/mettre à jour
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=NULL
		* @return string
		*/
		$msg='';
		if(is_array($content)){
			if($content['new_group'] == true){		
				$group_bo = CreateObject('admin.boaccounts');
				// _debug_array($this->obj_config);exit;
				$group_info = array(
					'account_id'	=> 0,
					'account_name'	=> $content['client_company'],
					'account_user'	=> array(
							'0' => $this->obj_config['DefaultUser'],
						),
					'account_apps'	=> array(
							'home' => 1,
							'notifications' => 1,
							'spid' => 1,
						),
					'account_email'	=> '',
				);
				$error = $group_bo->add_group($group_info);
				if(!is_array($error)){
					$so_accounts = new so_sql('phpgwapi','egw_accounts');
					$acc = $so_accounts->search(array('account_lid' => $content['client_company']),false);
					$content['account_id'] = -1 * $acc[0]['account_id'];
				}else{
					return $error[0];
				}
			}
			unset($content['button']);
			unset($content['spiclient']);
			unset($content['msg']);

			$clients = $this->search(array('client_company' => $content['client_company']),false);
			if(empty($content['client_id'])){
				if(!empty($clients)){
					return lang('Error while saving').' : '.lang('An organization with the name %1 already exists',$content['client_company']);
				}
			}else{
				if(count($clients) > 1){
					return lang('Error while saving').' : '.lang('An organization with the name %1 already exists',$content['client_company']);
				} 
			}
			

			if (is_array($content['logo']) && !empty($content['logo']['tmp_name']) && $content['logo']['tmp_name'] != 'none' && ($f = fopen($content['logo']['tmp_name'],'r'))){
				$content['client_logo'] = $this->resize_photo($f);
				fclose($f);
				unset($content['logo']);
			}

			// $this->data = $content;
			// _debug_array($this->data);
			if(isset($content['client_id'])){
				$this->historique($content);
				
				$this->data = $content;
				$this->data['change_date'] = time();
				$this->data['maj_id'] = $this->account_id;
				$this->update($this->data,true);
				$msg = lang('Client updated');
			}else{
				$this->data = $content;
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg = lang('Client created');
			}
			// Vérification et MAJ de l'onglet Clients
			// $this->add_update_onglet_clients($content['clients'],$content['client_id']);
		}
		return $msg;
	}
	
	function add_update_nature($content=null){
	/**
	 * Routine permettant de créer/modifier une nature technique
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
			$this->so_client_nature->data = $content;
			if(isset($this->so_client_nature->data['change_date'])){
				$this->so_client_nature->data['change_date']=time();
				$this->so_client_nature->data['maj_id']=$this->account_id;
				$this->so_client_nature->update($this->so_client_nature->data,true);
				$msg = 'Association Client-Technical nature updated';
			}else{
				if(!empty($this->so_client_nature->data['nature_id'])){
					$this->so_client_nature->data['change_date'] = time();
					$this->so_client_nature->data['maj_id'] = $this->account_id;
					$this->so_client_nature->save();
					$msg = 'Association Client-Technical nature created';
				}
			}
		}
		return $msg;
	}
	
	function add_update_relation($content=null){
	/**
	 * Routine permettant de créer/modifier une relation
	 *
	 * Retourne un message de confirmation ou d'erreur
	 *
	 * @param array $content=NULL
	 * @return string
	 */
		$msg='';
		unset($content['button']);
		unset($content['spiclient']);
		unset($content['msg']);
		unset($content['user_timezone_read']);
		if(is_array($content)){
			$this->so_clients_relations->data = $content;
			$this->so_clients_relations->update($this->so_clients_relations->data,true);
			$msg = 'Client relation updated';
		}
		return $msg;
	}
	
	function add_update_checklist($content=null){
	/**
	 * Routine permettant de créer/modifier une valeur de checklist
	 *
	 * Retourne un message de confirmation ou d'erreur
	 *
	 * @param array $content=NULL
	 * @return string
	 */
		$msg='';
		unset($content['button']);
		unset($content['spiclient']);
		unset($content['msg']);
		unset($content['user_timezone_read']);
		if(is_array($content)){
			$this->so_checklist->data = $content;
			$this->so_checklist->update($this->so_checklist->data,true);
			$msg = 'Checklist updated';
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
		$id = $content['client_id'];
		$old = $this->read($id);

		// Nouvelles valeurs
		$history = array_diff_assoc($content,$old);
		// $infoHistory = $history['history'];

		$FieldIgnore = array('general|clients|prestataires|details','link_to','clients','prestataires','contact','contrat','history','address','technique','checklist','photo','general|contact|address|contract|accounting|technique|checklist|comment|clients|prestataires|link|history','change_date','general|contact|address|contract|accounting|technique|checklist|comment|prestataires|link|history');
		$FieldDate = array('');
		$FieldExternal = array(
			'client_type' => array('table' => $this->so_type_client,'field' => 'type_client_label'),
			'client_sector' => array('table' => $this->so_sectors,'field' => 'sector_name'),
			'client_parent' => array('table' => $this,'field' => 'client_company'),
			'client_region' => array('table' => $this->so_zone,'field' => 'area_label'),
			'client_chalandise' => array('table' => $this,'field' => 'client_company'),
			'client_mode_reglement' => array('table' => $this->so_mode_reglement,'field' => 'mode_reglement_label'),
			'client_delai_paiement' => array('table' => $this->so_delai_paiement,'field' => 'delai_label'),
		);
		$FieldUser = array('client_manager_id', 'client_seller_id');
		$FieldText = array('client_sda', 'client_comment');
		
		$historylog = CreateObject('phpgwapi.historylog','spiclient');

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


	
	function add_update_onglet_clients($clients,$societe_id){
		/**
		* Mets à jour l'onglet client et le crée si nécessaire. Si le client n'existe plus, on le supprimera.
		*
		* \version BBO - 30/07/2010 - Permet de mettre à jour les informations contenu dans l'onglet CLIENTS
		*
		* NOTE : Curieux qu'on prenne en compte le $value['selected'] ...
		*
		* @param array $clients contient la liste des clients à mettre à jour
		*
		* @param int $societe_id contient l'identifiant de la société dont on veur mettre à jour l'onglet client
		*/
		$existePasDeja='N';
		foreach((array)$clients as $id=>$value)
		{
			$existeDeja=$this->so_clients_relations->search(array('societe_id'=>$societe_id,'client_id'=>$value['client_id']),false);
			
			//Nouveau client si le client_id n'existe pas....
			if(!is_array($existeDeja) && $value['selected']==1)
			{
				$client=$value;
				unset($client['selected']);
				unset($client['client_company']);
				$client['societe_id']=$societe_id;
				$this->so_clients_relations->data=$client;
				$save=$this->so_clients_relations->save();
			}
			//Déjà existant, donc MAJ
			else
			{
				
				//MAJ
				if(is_array($existeDeja[0]) && $value['selected']==1)
				{
					$client=$value;
					unset($client['selected']);
					unset($client['client_company']);
					$client['societe_id']=$societe_id;
					$client['relation_id']=$existeDeja[0]['relation_id'];
					$this->so_clients_relations->update($client,false);
				}
				//Suppression
				elseif(is_array($existeDeja[0]) && $value['selected']==0)
				{
					$client=$value;
					$client['client_id']=$value['client_id'];
					$client['societe_id']=$societe_id;
					$client['relation_id']=$existeDeja[0]['relation_id'];
					unset($client['selected']);
					unset($client['client_company']);
					unset($client['payment_model']);
					unset($client['operation_code']);
					$this->so_clients_relations->delete($client);
				}
				
			}
			
		}
	}
	
	
}


?>