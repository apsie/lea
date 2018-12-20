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


class spid_so extends so_sql{

	var $spid_client='spiclient';
	var $spid_etats='spid_etats';
	var $spid_factures='spid_factures';
	var $spid_factures_details='spid_factures_details';
	var $spid_prix_parametres='spid_prix_parametres';
	var $spid_reponses='spid_reponses';
	var $spid_reponses_standard='spid_reponses_standard';
	var $spid_tickets='spid_tickets';
	var $spid_transitions='spid_transitions';
	var $spid_locations='spiclient_locations';
	var $spid_url='spid_url';
	var $spid_clients_relations='spiclient_relations';
	var $spid_tickets_view='spid_tickets_view';
	var $spid_rendez_vous='spid_rendez_vous';
	var $spiclient_contrat = 'spiclient_contrats';
	var $spitel_appel = 'spitel_appel';
	var $spiclient_checklist = 'spiclient_checklist';
	var $spid_checklist = 'spid_checklist';
	
	var $so_client;
	var $so_etats;
	var $so_factures;
	var $so_factures_details;
	var $so_prix_parametres;
	var $so_reponses;
	var $so_reponses_standard;
	var $so_transitions;
	var $so_locations;
	var $so_url;
	var $so_clients_relations;
	var $so_tickets_view;
	var $so_rendez_vous;
	var $so_calendar;
	var $so_ticket;
	var $so_contrat;
	var $so_appel;
	var $so_checklist;
	var $so_spid_checklist;
	
	var $message_historique;
	
	function spid_so(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		parent::__construct('spid',$this->spid_tickets,null,'',true);
		
		//Instance sur la table reponse
		$this->so_reponses = CreateObject('etemplate.so_sql');
		$this->so_reponses->so_sql('spid',$this->spid_reponses);
		
		//Instance sur la table client
		$this->so_reponses_standard = CreateObject('etemplate.so_sql');
		$this->so_reponses_standard->so_sql('spid',$this->spid_reponses_standard);
		
		//Instance sur la table etat
		$this->so_etats = CreateObject('etemplate.so_sql');
		$this->so_etats->so_sql('spid',$this->spid_etats);
		
		//Instance sur la table client
		$this->so_client = CreateObject('etemplate.so_sql');
		$this->so_client->so_sql('spiclient',$this->spid_client);
		
		//Instance sur la table factures
		$this->so_factures = CreateObject('etemplate.so_sql');
		$this->so_factures->so_sql('spid',$this->spid_factures);
		
		//Instance sur la table facture details
		$this->so_factures_details = CreateObject('etemplate.so_sql');
		$this->so_factures_details->so_sql('spid',$this->spid_factures_details);
				
		//Instance sur la table prix
		$this->so_prix_parametres = CreateObject('etemplate.so_sql');
		$this->so_prix_parametres->so_sql('spid',$this->spid_prix_parametres);
		
		//Instance sur la table transition (etat)
		$this->so_transitions = CreateObject('etemplate.so_sql');
		$this->so_transitions->so_sql('spid',$this->spid_transitions);
		
		//Instance sur la table lieu
		$this->so_locations = CreateObject('etemplate.so_sql');
		$this->so_locations->so_sql('spiclient',$this->spid_locations);
		
		//Instance sur la table url
		$this->so_url = CreateObject('etemplate.so_sql');
		$this->so_url->so_sql('spid',$this->spid_url);
		
		//Instance sur la table relation client
		$this->so_clients_relations = CreateObject('etemplate.so_sql');
		$this->so_clients_relations->so_sql('spiclient',$this->spid_clients_relations);
		
		//Instance sur la table ticket view
		$this->so_tickets_view = CreateObject('etemplate.so_sql');
		$this->so_tickets_view->so_sql('spid',$this->spid_tickets_view);
		
		//Instance sur la table tickets
		$this->so_tickets = CreateObject('etemplate.so_sql');
		$this->so_tickets->so_sql('spid',$this->spid_tickets);
		
		//Instance sur la table rendez vous
		$this->so_rendez_vous = CreateObject('etemplate.so_sql');
		$this->so_rendez_vous->so_sql('spid',$this->spid_rendez_vous);
		
		//Instance sur la table contrat
		$this->so_contrat = CreateObject('etemplate.so_sql');
		$this->so_contrat->so_sql('spiclient',$this->spiclient_contrat);
		
		$this->so_checklist = new so_sql('spiclient', $this->spiclient_checklist);
		$this->so_spid_checklist = new so_sql('spid', $this->spid_checklist);
		
		//Instance sur la table calendar
		$this->so_calendar = new calendar_so();
		$this->bo_calendar = new calendar_bo();
		
		// Instance sur la table spitel_appel (si l'utilisateur en cours a les droits sur l'appli)
		$obj_acl = CreateObject('phpgwapi.acl');
		$allowedApps = array_keys($obj_acl->get_user_applications());
		if(in_array('spitel',$allowedApps)){
			$this->so_appel = new so_sql('spitel',$this->spitel_appel);
		}
		
		$this->message_historique=array(
			'cat_id'				=> "Changement catégorie",
			'state_id'				=> "Changement état",
			'ticket_title'			=> "Changement titre",
			'ticket_priority'		=> "Changement priorité",
			'ticket_assigned_to'	=> "Changement destinataire du ticket",
			'ticket_assigned_by'	=> "Changement demandeur du ticket",
			'ticket_spend_time'		=> "Modification temps",
			'change_date'			=> "MAJ ticket",
			'closed_date'			=> "Fermeture ticket",
			'due_date'				=> "Changement de la date d'échéance",
			'creation_date'			=> "Création du ticket",
			'location_id'			=> "Changement Site",
		);
		
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
	
	function getEtat_Label($id){
	/**
	 * Récupère le libellé de l'état son l'identifiant (de l'état) $id
	 *
	 * @param int $id identifiant de l'utilisateur
	 * @return string
	 */
		$etat=$this->so_etats->search(array('state_id'=>$id),'state_name');
		return $etat[0]['state_name'];
	}
	
	function getUser_Label($id){
	/**
	 * Récupère le libellé de l'utilisateur à partir de son identifiant $id
	 *
	 * @param int $id identifiant de l'utilisateur
	 * @return string
	 */
		$account=CreateObject('phpgwapi.accounts');
		return $account->id2name($id);
	}

	function is_admin($account_id=null){
	/**
	 * Vérifie si l'utilisateur est un administrateur (s'il peut modifier les comptes)
	 *
	 * @param array $account_id=NULL pour un usage prochain, quand les administrateurs ne seront plus administrateurs sur tous les comptes
	 * @return boolean
	 */
		return isset($GLOBALS['egw_info']['user']['apps']['admin']);
	}
	
	function get_users_groups(){
	/**
	 * Retoune tous les groupes de tous les utilisateurs.
	 * 
	 * Le tableau de retour (en 2 dimensions) contient en index l'identifiant du groupe/l'identifiant de l'utilisateur, il contient pour chacun de ces couples de valeur le nom du groupe
	 *
	 * @return array
	 */
		$tab_groupe=array();
		$table_account=$this->obj_accounts->search(array());
		foreach($table_account as $id=>$value){
			if($value['account_type']=='g'){
				$tab_groupe[$value['account_id']]=array();
				$user_groupes=$this->obj_accounts->member($value['account_id']);
				foreach($user_groupes as $cle=>$valeur){
					$tab_groupe[$value['account_id']][$valeur['account_id']]=$valeur['account_name'];
				}
			}
		}
		return $tab_groupe;
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
	
	function GetTable(){
	/**
	* Retourne la table maître de l'objet
	*
	* @return so_sql
	*/
		return $this->so_dossier;
	}
	
	

	function get_etat($id=''){
	/**
	 * Retourne l'état correspondant à l'identifiant passé en argument (retourne tous les états par défaut)
	 *
	 * Le tableau résultat fait correspondre l'identifiant des états demandés et leur libellé
	 *
	 * NOTE: Facilement optimisable
	 *
	 * @param array $id=''
	 * @return array
	 */
		if(!empty($id)){
			$etat=$this->so_etats->search(array('state_id'=>$id),'state_id,state_name,state_description','state_name');
			if (!is_array($etat)){
				$etat = array();
			}
			$etats=array();
			foreach($etat as $id=>$value){
				$etats[$value['state_id']]=$value['state_name'];
			}
		}else{
			$etat=$this->so_etats->search('','state_id,state_name','state_name');
			if (!is_array($etat)){
				$etat = array();
			}
			$etats=array();
			foreach($etat as $id=>$value){
				$etats[$value['state_id']]=$value['state_name'];
			}
		}
		return $etats;
	}
	
	function get_reponse_standard(){
	/**
	 * Retourne toutes les réponses standard
	 *
	 * Le tableau résultat fait correspondre les identifiants des réponses et leur libellé
	 *
	 * @return array
	 */
		$reponse=$this->so_reponses_standard->search('','standard_reply_id,canned_name,close_ticket,state_id');
		$reponses=array();
		if (!is_array($reponse)){
			$reponse = array();
		}
		foreach($reponse as $id=>$value){
			$reponses[$value['standard_reply_id']]=$value['canned_name'];
		}
		return $reponses;
	}
	
	function get_transition($id){
	/**
	 * Retourne toutes les transitions correspondantes à l'identifiant passé en argument
	 *
	 * Le tableau résultat fait correspondre les identifiants des réponses et leur libellé, et y ajoute l'état courant
	 *
	 * @param array $id tableau des critères de recherche
	 * @return array
	 */	
		$transition=$this->so_transitions->search(array('source_id'=>$id),'target_id');
		$transitions=array();
		$temp=array();
		if(is_array($transition)){
			foreach($transition as $cle=>$value){
				$temp=$this->get_etat($value['target_id']);
				$cle=key($temp);
				$transitions[$cle]=$temp[$cle];
			}
		}
		
		//Ajout de l'état courant...
		$etat=$this->so_etats->read($id);
		$transitions[$id]=$etat['state_name'];
		natcasesort($transitions);
		return $transitions;
	}
	
	function get_initial_state(){
	/**
	 * Retourne les états initiaux
	 *
	 * Le tableau résultat fait correspondre les identifiants des réponses et leur libellé
	 *
	 * @return array
	 */	
		$etat=$this->so_etats->search(array('state_initial'=>1),'state_id,state_name','state_name');
		$etats=array();
		if (!is_array($etat)){
			$etat = array();
		}
		foreach($etat as $id=>$value){
			$etats[$value['state_id']]=$value['state_name'];
		}
		return $etats;
	}
	
	function get_reponses_standard_message(){
	/**
	 * Messages des réponses standard. Le tableau résultat fait correspondre les champs standard_reply_id (identifiant de la réponse) et canned_content (libellé de la réponse)
	 *
	 * NOTE : contient du code inutile ...
	 *
	 * @return array
	 */	
		$reponses=$this->so_reponses_standard->search('','standard_reply_id,canned_content');
		if(is_array($reponses) && !empty($reponses)){
			foreach($reponses as $id=>$value){
				//$reponses[$id]['canned_content']=htmlspecialchars_decode($value['canned_content']);
			}
		}else{
			$reponses=array();
		}
		return $reponses;
	}
	
	function get_etat_fermable(){
	/**
	 * Retourne la liste des états . Le tableau résultat fera correspondre l'identifiant de l'état (state_id) et l'état de fermeture (state_close)
	 *
	 * @return array
	 */	
		$etats=$this->so_etats->search(array('state_close'=>1),'state_id,state_close');
		if(is_array($etats) && !empty($etats)){
			foreach($etats as $id=>$value){
				
			}
		}else{
			$etats=array();
		}
		
		return $etats;
	}
	
	function get_categorie(){
	/**
	 * Retourne la liste des catégories pour l'utilisateur courant. Le résultat est un tableau à 2 dimensions, contenant l'identifiant de la catégorie/propriété et faisant correspondre la valeur de cette même propriété.
	 *
	 * propriété contient une des valeurs de cette liste :
	 *\li cat_id -> Identifiant de la catégorie
	 *
	 *\li cat_managementgroup -> Groupe de gestion de cette catégorie
	 *
	 *\li cat_assignedto -> Personne à qui est déléguée la catégorie
	 *
	 *\li parent -> Catégorie parente
	 *
	 *\li possible_select -> Détemine si la catégorie est sélectionnable
	 *
	 *\li group_user -> Groupe de l'utilisateur pour cette catégorie
	 *
	 * @return array
	 */	
		if (!is_object($GLOBALS['egw']->categories)){
			$GLOBALS['egw']->categories = CreateObject('phpgwapi.categories',$this->account_id,'spid');
		}
		if (isset($GLOBALS['egw']->categories) && $GLOBALS['egw']->categories->app_name == 'spid'){
			$cats = $GLOBALS['egw']->categories;
		}else{
			$cats = new categories($this->account_id,'spid');
		}
		$categorie = $cats->return_array('all',0,false,'','','cat_id');
		if (!is_array($categorie)){
			$categorie = array();
		}
		$categories=array();
		$membership=$this->obj_accounts->memberships($this->account_id);
		$memberships="";
		foreach($membership as $id=>$value){
			$memberships.= empty($memberships) ? $id : ','.$id;
		
		}
		foreach($categorie as $id=>$value){
			$categories[$id]['name']=$value['name'];
			$data=unserialize($value['data']);
			$categories[$id]['cat_id']=$value['id'];
			$categories[$id]['cat_managementgroup']=$data['cat_managementgroup'];
			$categories[$id]['cat_assignedto']=$data['cat_assignedto'];
			$categories[$id]['parent']=$value['parent'];
			$categories[$id]['possible_select']=$data['possible_select'];
			$categories[$id]['group_user']=$memberships;
		}
		return $categories;
	}
	
	function get_etat_facturable(){
	/**
	 * Retourne la liste des états avec lesquelles on peut facturer
	 *
	 * @return array
	 */	
		$etat=$this->so_etats->search(array('state_billable'=>1),true);
		$etats=array();
		foreach($etat as $id=>$value){
			$etats[]=$value['state_id'];
		}
		return $etats;
	}
	
	function get_management_categorie($id){
	/**
	 * Précise si la catégorie $id fait partie d'un groupe auquel adhère l'utilisateur courant
	 *
	 * @param int $id catégorie
	 * @return bool
	 */	
		$gestionnaire=false;
		if (!is_object($GLOBALS['egw']->categories)){
			$GLOBALS['egw']->categories = CreateObject('phpgwapi.categories',$this->account_id,'spid');
		}
		if (isset($GLOBALS['egw']->categories) && $GLOBALS['egw']->categories->app_name == 'spid'){
			$cats = $GLOBALS['egw']->categories;
		}else{
			$cats = new categories($this->account_id,'spid');
		}
		$categorie = $cats->return_single($id);
		$data=unserialize($categorie[0]['data']);
		$cat_management_group = $data['cat_managementgroup'];
		$groupes=$this->obj_accounts->memberships($this->account_id);
		foreach($groupes as $id=>$value){
			if($id==$cat_management_group){
				$gestionnaire=true;
			}
		}
		return $gestionnaire;
	
	}
	
	function categorieGroupeDeGestion($cat_id){
	/**
	 * Vérifie que la groupe de gestion pour une catégorie existe
	 *
	 * NOTE : le type de retour n'est pas correctement défini
	 *
	 * @param int $cat_id
	 * @return bool
	 */	
		if (!is_object($GLOBALS['egw']->categories)){
			$GLOBALS['egw']->categories = CreateObject('phpgwapi.categories',$this->account_id,'spid');
		}
		if (isset($GLOBALS['egw']->categories) && $GLOBALS['egw']->categories->app_name == 'spid'){
			$cats = $GLOBALS['egw']->categories;
		}else{
			$cats = new categories($this->account_id,'spid');
		}
		$categorie = $cats->return_array('all',0,false,'','','cat_id');
		if (!is_array($categorie)){
			$categorie = array();
		}	
		array_unshift($categorie,false); 
		unset($categorie[0]);
		$id_groupe=false;
		foreach($categorie as $id=>$value){
			if($value['id']==$cat_id){
				$categorie[$id]['data']=unserialize($categorie[$id]['data']);
				if(isset($categorie[$id]['data']['cat_managementgroup']) && !empty($categorie[$id]['data']['cat_managementgroup'])){
					$id_groupe=$categorie[$id]['data']['cat_managementgroup'];
				}
			}
		}
		return $id_groupe;
	}
	
	function userDuGroupeDeGestion($cat_id){
	/**
	 * Détermine si l'utilisateur courant fait partie du groupe de gestion de la catégorie passée en argument
	 *
	 * @param int $cat_id
	 * @return bool
	 */	
		$account_id=$this->account_id;
		$categorieGroupeDeGestion=$this->categorieGroupeDeGestion($cat_id);
		if($categorieGroupeDeGestion){
			$userDuGroupe=$this->obj_accounts->member($categorieGroupeDeGestion);
			$userDuGroupeDeGestion=false;
			foreach($userDuGroupe as $id=>$value){
				if($value['account_id']==$account_id){
					$userDuGroupeDeGestion=true;
					break;
				}
			}
		}
		return $userDuGroupeDeGestion;
	}
	
	function userCompteDefaut($cat_id){
	/**
	 * Détermine si l'utilisateur courant est l'utilisateur par défaut de la catégorie $cat_id
	 *
	 * @param int $cat_id
	 * @return bool
	 */	
		if (!is_object($GLOBALS['egw']->categories)){
			$GLOBALS['egw']->categories = CreateObject('phpgwapi.categories',$this->account_id,'spid');
		}
		if (isset($GLOBALS['egw']->categories) && $GLOBALS['egw']->categories->app_name == 'spid'){
			$cats = $GLOBALS['egw']->categories;
		}else{
			$cats = new categories($this->account_id,'spid');
		}
		$categorie = $cats->return_array('all',0,false,'','','cat_id');
		if (!is_array($categorie)){
			$categorie = array();
		}	
		array_unshift($categorie,false); 
		unset($categorie[0]);
		$id_groupe=false;
		foreach($categorie as $id=>$value){
			if($value['id']==$cat_id){
				$categorie[$id]['data']=unserialize($categorie[$id]['data']);
				if(isset($categorie[$id]['data']['cat_assignedto']) && !empty($categorie[$id]['data']['cat_assignedto'])){
					$id_groupe=$categorie[$id]['data']['cat_assignedto'];
				}
			}
		}
		return $id_groupe;
	}	

	
	function get_location(){
	/**
	 * Retourne le tableau des locations (faisant correspondre Identifiant_location et NvNmLocation), où NvNmLocation est::
	 *
	 * \li --Nm -> Location de libellé Nm précédé de -- définit une location de niveau 2
	 *
	 * \li -Nm -> Location de libellé Nm précédé de - définit une location de niveau 1
	 *
	 * \li Nm -> Location de libellé Nm précédé de rien définit une location de niveau 0
	 *
	 * @return array
	 */	
		$location=$this->return_location_array();
	
		$locations=array();
		foreach($location as $id=>$value){
			switch($value['location_level']){
				case '2';
					$niveau="-- ";
					break;
				case '1';
					$niveau="- ";
					break;
				default:
				case '0';
					$niveau="";
					break;
			
			}
			$locations[$value['location_id']]=$niveau.$value['location_name'];
		}
		return $locations;
	}
	
	function return_location_array(){
	/**
	 * Retourne le tableau des identifiants des locations, aussi bien parentes, filles ou orphelines
	 *
	 * NOTE : Il y a surement quelques bugs ici ...
	 *
	 * @return array
	 */	
		if (!$sort){
			$sort = 'ASC';
		}
		if (!empty($order) && preg_match('/^[a-zA-Z_, ]+$/',$order) && (empty($sort) || preg_match('/^(ASC|DESC|asc|desc)$/',$sort))){
			$ordermethod = 'ORDER BY '.$order.' '.$sort;
		}else{
			$ordermethod = ' ORDER BY location_name ASC';
		}
		$where = 'location_parent=' . (int)$parent_id;
		$parents = $locations = array();
		// $this->db->select('spid_locations','*',$where,__LINE__,__FILE__,false,$ordermethod);
		$this->db->select('spiclient_locations','*',$where,__LINE__,__FILE__,false,$ordermethod);
		while (($location = $this->db->row(true))){
			$locations[] = $location;
			$parents[] = $location['location_id'];
		}
		while (count($parents)){
			$where = 'location_parent IN (' . implode(',',$parents) . ')';
			$parents = $children = array();
			// $this->db->select('spid_locations','*',$where,__LINE__,__FILE__,false, $ordermethod);
			$this->db->select('spiclient_locations','*',$where,__LINE__,__FILE__,false, $ordermethod);
			while (($location = $this->db->row(true))){
				$parents[] = $location['location_id'];
				$children[$location['location_parent']][] = $location;
			}
			if (count($children)){
				$locations2 = $locations;
				$locations = array();
				foreach($locations2 as $location){
					$locations[] = $location;
					if (isset($children[$location['location_id']])){
						foreach($children[$location['location_id']] as $child){
							$locations[] = $child;
						}
					}
				}
			}
		}
		return $locations;
	}
	
	function get_all_location(){
	/**
	 * Retourne le tableau des identifiants des locations, en y faisant correspondre leur nom
	 *
	 * @return array
	 */	
		$parent=$this->so_locations->search('','location_id,location_name','location_name');
		$parents=array();
		$parents['']='All';
		if(!empty($parent)){
			foreach($parent as $id=>$value){
				$parents[$value['location_id']]=$value['location_name'];
			}
		}
		return $parents;
	}
	
	function id2name($location_id){
	/**
	 * Retourne le nom d'une location à partir de son identifiant
	 *
	 * @param int $location_id
	 * @return string
	 */	
		$name=$this->so_locations->read(array('location_id'=>$location_id),'location_name');
		return $name['location_name'];
	}
	
	
	
	function get_societe(){
	/**
	 * Retourne tous les identifiants des entreprises clientes
	 *
	 * @return array
	 */	
		$info=$this->search('','client_id,client_company');
		if(!is_array($info)){
			$info=array();
		}
		$societe=array();
		foreach($info as $id=>$value){
			$societe[$value['client_id']]=$value['client_company'];
		}
		return $societe;
	}

	function membrerGroupesDuUser(){
	/**
	 * Retourne les identifiants des membres du groupe de l'utilisateur actuel (triés)
	 *
	 * @return array
	 */	
		$groupesDuUser=$this->obj_accounts->memberships($this->account_id);
		$membrerGroupesDuUser=array();
		foreach($groupesDuUser as $id=>$value){
			$membrerGroupesDuUser[$id]=$this->obj_accounts->members($id);
			
			// Retrait des utilisateurs supprimés ou inactifs
			foreach($membrerGroupesDuUser[$id] as $user_id => $user_name){
				$user = $this->obj_accounts->read($user_id);
				if(empty($user['account_status']) || $this->obj_accounts->is_expired($user)){
					unset($membrerGroupesDuUser[$id][$user_id]);
				}
			}
			
			asort($membrerGroupesDuUser[$id]);
		}
		ksort($membrerGroupesDuUser);
		return $membrerGroupesDuUser;
	}
	
	function tabDefault(){
	/**
	 * Retourne le tableau des valeurs définies par défaut, avec les clef suivantes :
	 *
	 *\li assigned_to_id : identifiant de la personne à qui est assignée un nouveau ticket
	 *
	 *\li valeur de assigned_to_id : compte à qui est assignée un nouveau ticket
	 *
	 *\li group_management_id : identifiant du groupe de gestion à qui est assignée un nouveau ticket
	 *
	 *\li group_management_value : valeur de l'identifiant du groupe de gestion à qui est assignée un nouveau ticket
	 *
	 *\li group_management_value_users : tableau des adhérents du groupe de gestion à qui est assignée un nouveau ticket
	 *
	 *\li demandeur : libellé du demandeur par défaut du ticket (utilisateur courant)
	 *
	 * @return array
	 */	
		$default['assigned_to_id']=$this->obj_config['ticket_assigned_to'];
		$assigned_to_value=$this->obj_accounts->read($this->obj_config['ticket_assigned_to']);
		$default[$default['assigned_to_id']]=$assigned_to_value['account_lid'];
		$default['group_management_id']=$this->obj_config['ticket_management_group'];
		$group_management_value=$this->obj_accounts->read($this->obj_config['ticket_management_group']);
		$default['group_management_value']=$group_management_value['account_lid'];
		$default['group_management_value_users']=$this->obj_accounts->members($default['group_management_value']);
		

		// Retrait des utilisateurs supprimés ou inactifs
		foreach($default['group_management_value_users'] as $user_id => $user_name){
			$user = $this->obj_accounts->read($user_id);
			if(empty($user['account_status']) || $this->obj_accounts->is_expired($user)){
				unset($default['group_management_value_users'][$user_id]);
			}
		}

		$default['demandeur']=array($this->account_id=>$this->obj_accounts->id2name($this->account_id));
		return $default;
	}
	
	function groupesDuUser(){
	/**
	 * Retourne le tableau des groupes de l'utilisateur courant
	 *
	 * @return array
	 */	
		$groupesDuUser = $this->obj_accounts->memberships($this->account_id);
		return $groupesDuUser;
	}
	
	function isTechnicianOrManagerOrCustomer(){
	/**
	 * Fonction permettant de savoir si l'utilisateur connecté est un technicien de catégorie ou un gestionnaire général ou un client
	 *
	 * Le résultat de la fonction sera enregistré en global pour une réutilisation ultérieur.... Celui-ci peut être :
	 *
	 * \li 0 : Client
	 * \li 1 : Technicien avec droit sur ses tickets uniquements
	 * \li 10 : Technicien avec droit sur tous les tickets de sa catégorie
	 * \li 50 : Gestionnaire général
	 * \li 99 : Administrateur
	 *
	 * \version TCH / ajout code 99 /
	 *
	 * @return int
	 */	
		
		$SpidLevel=0;
		$categories=$this->ResurciveCategories();
		$GroupsMember=$this->obj_accounts->memberships($GLOBALS['egw_info']['user']['account_id'],true);
	
		if($GLOBALS['egw_info']['user']['apps']['admin'])
			{	
				$SpidLevel=99;	
				return $SpidLevel;
		}
		
		if(in_array($this->obj_config['ticket_management_group'],$GroupsMember))
		{

			$SpidLevel=50;
			return $SpidLevel;
		}

		foreach($categories as $id=>$value)
		{
				if(in_array($value['cat_data']['cat_managementgroup'],$GroupsMember))
				{

					if($this->obj_config['restricted_access_technicians'])
						{ 	$SpidLevel=1; 	}
					else
						{ 	$SpidLevel=10; 	}
						
				}
				break;
		}	
		return $SpidLevel;
	}
	
	
	function ResurciveCategories($cat_parent=0){
	/**
	 * Retourne le tableau des membres du groupes del'utilisateur courant. Ce tableau en 2 dimensions fait correspondre :
	 *
	 * \li l'identifiant de la catégorie et son père
	 *
	 * \li l'identifiant de la catégorie/cat_data, et les données en valeur (il s'agit de la valeur 'cat_data')
	 *
	 * @param int $cat_parent=0 identifiant de la catégorie parente à partir de laquelle on prends en compte ses filles
	 * @return array
	 */	
		static $categories = array();
		$table='egw_categories';
		$cat_appname='spid';
		$cols=array('cat_id','cat_name','cat_parent','cat_level','cat_data');
		$where=array
		(
			'cat_appname'	=> $cat_appname,
			'cat_access'	=> 'public',
			'cat_parent'	=> $cat_parent,
		);
		$append='order by cat_name ASC';
		${'rows'.$cat_parent}=$GLOBALS['egw']->db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
		foreach(${'rows'.$cat_parent} as $row)
		{
			$cat_data=unserialize($row['cat_data']);
			$categories[$row['cat_id']]=$row;
			$categories[$row['cat_id']]['cat_data']=$cat_data;
			$this->ResurciveCategories($row['cat_id']);
		}
		return $categories;
	}
	
	// Fonction qui va renvoyer true ou false en fonction si l'utilisateur connecté fait parti d'un groupe lié à un client en Sommeil
	function enSommeil(){
	/**
	 * Précise si le compte du client actuel est actif. Retourne un message d'erreur si nécessaire.
	 *
	 * @return array
	 */	
		$messageRetour="";
		$accounts=$this->obj_accounts->memberships($this->account_id,true);
		$ClientsDuUser=$this->so_client->search(array('account_id'=>$accounts),false);
		if(!empty($ClientsDuUser)){
		
			foreach($ClientsDuUser as $id=>$value)
			{
				if($value['client_sleep']==1)
				{
					$messageRetour=array();
					$messageRetour[0]='<b>'.$value['client_company'].'</b> à été déclarré inactif';
					$messageRetour[1]='Veuillez-nous contacter pour réactiver votre compte';
					break;
				}
			}
		}
		return $messageRetour;
	}
	
	function get_cal_cat(){
	/**
	 * Retourne la liste des catégories du calendrier
	 * @return array
	 */
		$cats = array();
		$obj_cats = CreateObject('phpgwapi.categories',$owner_id,'calendar');
		foreach($obj_cats->return_array('all',0,false,'','','',true) as $id_cat => $value_cat){
			if($value_cat['app_name'] == 'calendar'){
				$cats[$value_cat['id']] = $value_cat['name'];
			}
		}
		return $cats;
	}
	
	function get_unit_time(){
	/**
	 * Retourne la liste des unités de temps utilisable sur les tickets
	 * @return array
	 */
		$unit = array(
			'0' => 'Minutes',
			'1' => 'Heures',
			'2' => 'Jours',
		);
		return $unit;
	}

	function get_month(){
	/**
	 * Retourne la liste des mois sur un an  (permet de changer les mois disponibles)
	 *
	 * @return array
	 */
		$premierMois = date('m');
		$moisEnCours = 0;
		$annee = date('Y');

		// On parcours les 12 mois a venir (mois en cours + 5 mois)
		for($m = 0; $m < 12; ++$m){
			// Calcul du mois en cours
			if($moisEnCours == 0){
				$moisEnCours = $premierMois + $m;
			}else{
				++$moisEnCours;
			}
			// Fin de l'année on passe à l'année suivante et on ramène le mois à 1
			if($moisEnCours > 12){
				$moisEnCours -= 12;
				++$annee;
			}

			$premierDuMois = mktime(0 , 0, 0, $moisEnCours, 1, $annee);
			$retour[$premierDuMois] = lang(date('F', mktime(0 , 0, 0, $moisEnCours, 1, $annee))).' '.$annee;
		}

		return $retour;
	}
}


?>