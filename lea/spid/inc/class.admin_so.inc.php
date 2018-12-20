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
// require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.spid_bo.inc.php');	


// class admin_so extends so_sql{
class admin_so extends spid_bo{

	var $spid_client='spiclient';
	var $spid_etats='spid_etats';
	var $spifina_factures='spifina_factures';
	var $spifina_factures_details='spifina_factures_details';
	var $spid_prix_parametres='spid_prix_parametres';
	var $spid_reponses='spid_reponses';
	var $spid_reponses_standard='spid_reponses_standard';
	var $spid_tickets='spid_tickets';
	var $spid_transitions='spid_transitions';
	var $spid_intervenants='spid_intervenants';
	var $spid_clients_relations='spiclient_relations';
	var $spireapi_account = 'spireapi_acc_accounts';
	var $spireapi_book = 'spireapi_acc_book';
	
	var $so_client;
	var $so_etats;
	var $so_factures;
	var $so_factures_details;
	var $so_prix_parametres;
	var $so_reponses;
	var $so_reponses_standard;
	var $so_transitions;
	var $so_intervenants;
	var $so_clients_relations;
	var $so_account;
	var $so_book;
	

	var $account_id;
	var $app_title;
	
	
	function admin_so(){
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
		
		parent::__construct('spid',$this->spid_tickets,null,'',true);
		
		//Instance sur la table reponse
		$this->so_reponses = new so_sql('spid',$this->spid_reponses);
		
		//Instance sur la table client
		$this->so_reponses_standard = new so_sql('spid',$this->spid_reponses_standard);
		
		//Instance sur la table etat
		$this->so_etats = new so_sql('spid',$this->spid_etats);
		
		//Instance sur la table client
		$this->so_client = new so_sql('spiclient',$this->spid_client);
		
		//Instance sur la table facture
		$this->so_factures = new so_sql('spifina',$this->spifina_factures);
		
		//Instance sur la table facture_details
		$this->so_factures_details = new so_sql('spifina',$this->spifina_factures_details);
		
		//Instance sur la table prix_parametres
		$this->so_prix_parametres = new so_sql('spid',$this->spid_prix_parametres);
		
		//Instance sur la table transitions
		$this->so_transitions = new so_sql('spid',$this->spid_transitions);
		
		//Instance sur la table intervenants
		$this->so_intervenants = new so_sql('spid',$this->spid_intervenants);
		
		$this->so_clients_relations = new so_sql('spiclient',$this->spid_clients_relations);

		$this->so_account = new so_sql('spireapi',$this->spireapi_account);
		$this->so_book = new so_sql('spireapi',$this->spireapi_book);
		
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
	
	function construct_search($search, $so_=null){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		if($so_ == null) $so_ = $this;
		$tab_search=array();
		foreach($so_->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}


	function get_etat($transition=false){
	/**
	 * Retourne les états dans un tableau à 2 dimensions contenant en premier index l'identifiant de l'état, et en second index une de ces valeurs (et contenant les valeurs correspondantes our chaque état):
	 *
	 * \li state_id -> l'identifiant de l'état
	 *
	 * \li state_name -> le libellé de l'état
	 *
	 * \li state_description -> la description de l'état
	 *
	 * \li state_initial -> l'état initial
	 *
	 * \li state_close -> indice permettant de savoir si l'état est fermé
	 *
	 * \li state_billable -> indice permettant de savoir si l'état est facturable
	 *
	 * \li facturation_label -> libellé de la facture
	 *
	 * @param bool $transition=false indique si on doit prendre en compte qu'un fois chaque état (les états de transition ne seront pas pris en compte)
	 * @return array
	 */
		if($transition){
			$etat=$this->so_etats->search(array('state_id'=>$id),false,'state_name ASC');
			$etats=array();
			foreach($etat as $id=>$value){
				$etats[$value['state_id']]=$value['state_name'];
			}
		}else{
			$etats=$this->so_etats->search('',false,'state_name ASC');
		}
		if(is_array($etats)){
			array_unshift($etats,false); 
			unset($etats[0]);
		}else{
			$etats=array();
		}
		
		// Affichage des transitions
		foreach($etats as $id => $data){
			$transitions = $this->so_transitions->search(array('source_id' => $data['state_id']),false);
			if(is_array($transitions)){
				foreach($transitions as $transition){
					$etats[$id]['etat_enfant'][] = $transition['target_id'];
				}
				if(is_array($etats[$id]['etat_enfant'])){
					$etats[$id]['etat_enfant'] = implode(',',$etats[$id]['etat_enfant']);
				}
			}
		}
		
		// Création d'une ligne vide pour nouvel ajout
		$etats[] = array(
			// 'state_id' => $etats[count($etats)]['state_id']+1,
			'state_id' => '',
			'state_name' => "",
			'state_description' => "",
			'state_initial' => -1,
			'state_close' => -1,
			'state_billable' => -1,
			'facturation_label' => "",
		);
		return $etats;
	}
	
	function get_default_etat(){
	/**
	 * Retourne la liste des états initiaux (tableau ayant comme index l'identifiant de l'état et comme valeur le libellé)
	 *
	 * @return array
	 */
		$default_etat=$this->so_etats->search(array('state_initial'=>1),false,'state_name');
		if (!is_array($default_etat)){
			$default_etat = array();
		}
		$default_etats=array();
		foreach($default_etat as $id=>$value){
			$default_etats[$value['state_id']]=$value['state_name'];
		}
		return $default_etats;
	}
	
	function get_transition_etat(){
	/**
	 * Retourne la liste des états (tableau ayant comme index l'identifiant de l'état et comme valeur le libellé). Les états en cours de transition sont pris en compte
	 *
	 * @return array
	 */
		$default_etat=$this->so_etats->search('',false);
		if (!is_array($default_etat)){
			$default_etat = array();
		}
		$default_etats=array();
		foreach($default_etat as $id=>$value){
			$default_etats[$value['state_id']]=$value['state_name'];
		}
		return $default_etats;
	}
		
	function get_reponse_standard(){
	/**
	 * Retourne un tableau à 2 dimensions listant les réponses. Celui-ci contient en premier index l'identifiant de la réponse, et en second index une valeur de cette liste :
	 *
	 * \li standard_reply_id -> l'identifiant de la réponse
	 *
	 * \li canned_name -> le libellé de la réponse
	 *
	 * \li canned_content -> contenu de la réponse
	 *
	 * \li creation_date -> date d'envoi de la réponse
	 *
	 * NOTE : canned_content initialisé 2 fois ...
	 *
	 * @return array
	 */
		$reponse=$this->so_reponses_standard->search('',false);
		if(is_array($reponse)){
			array_unshift($reponse,false); 
			unset($reponse[0]);
		}else{
			$reponse=array();
		}
		$reponse[(count($reponse))+1] = array(
			'standard_reply_id' => $reponse[count($reponse)]['standard_reply_id']+1,
			'canned_name' => "",
			'canned_content' => "",
			'creation_date' => NULL,
			'canned_content' => NULL,
		);
		return $reponse;
	}
	
	function get_transition(){
	/**
	 * Retourne un tableau à 2 dimensions listant les transitions. Celui-ci contient en premier index l'identifiant de la transition, et en second index une valeur de cette liste :
	 *
	 * \li transition_id -> l'identifiant de la transition
	 *
	 * \li name -> le libellé de la transition
	 *
	 * \li description -> description de la transition
	 *
	 * \li source_id -> identifiant de l'état source
	 *
	 * \li target_id -> identifiant de l'état final
	 *
	 * @return array
	 */
		$transition=$this->so_transitions->search('',false);
		if(is_array($transition)){
			array_unshift($transition,false); 
			unset($transition[0]);
		}else{
			$transition=array();
		}
		$transition[(count($transition))+1] = array(
			'transition_id' => $transition[count($transition)]['transition_id']+1,
			'name' => "",
			'description' => "",
			'source_id' => "",
			'target_id' => "",
		);
		return $transition;
	}
	
	function get_cat(){
	/**
	 * Récupère des informations sur la table egw_categories (les catégories de l'utilisateur courant) et initialise les champs qui ne l'ont pas été.
	 *
	 * Retourne un tableau à 2 dimensions listant les catégories. Celui-ci contient en premier index l'identifiant de la catégorie, et en second index une valeur de cette liste :
	 *
	 * \li id -> l'identifiant de la categorie
	 *
	 * \li main -> catégorie principale
	 *
	 * \li parent -> catégorie parente
	 *
	 * \li level -> niveau de la catégorie (0,1,2)
	 *
	 * \li owner -> responsable de la catégorie
	 *
	 * \li access -> type d'accès à la catégorie (public,...)
	 *
	 * \li name -> nom de la catégorie
	 *
	 * \li description -> description de la catégorie
	 *
	 * \li data -> données (tableau)
	 *
	 * \li last_mod -> date de drenière modification
	 *
	 * \li app_name -> nom du module
	 *
	 * NOTE : app_name initialisé 2 fois
	 *
	 * @return array
	 */

		if (!is_object($GLOBALS['egw']->categories)){
			$GLOBALS['egw']->categories =& CreateObject('phpgwapi.categories',$this->account_id,'spid');
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
		$max_id=($this->db->select('egw_categories','MAX(cat_id)',array(),__LINE__,__FILE__)->fetchSingle()+1);	
		foreach($categorie as $id=>$value){
			// SPIREA-YLF - INUTILE v.14.1
			// $categorie[$id]['data']=unserialize($categorie[$id]['data']);
			if(!isset($categorie[$id]['data']['cat_assigned_to'])){
				$categorie[$id]['data']['cat_assigned_to']='';
			}
			if(!isset($categorie[$id]['data']['cat_managementgroup'])){
				$categorie[$id]['data']['cat_managementgroup']='';
			}
		}
		// _debug_array($categorie);
		if(!empty($categorie)){
			//Va permettre de rajouter une nouvelle entrée pour les catégories
			$categorie[] = array(
				'id' => $max_id,
				'main' => 0,
				'parent' => 0,
				'level'=> 0,
				'owner' => -1,
				'access' => 'public',
				'appname' => 'spid',
				'name' => '',
				'description' => '',
				'data' => array(
					'color'				=>	'',
					'assigned_to'		=>	'',
					'possible_select'	=> '',
				),
				'last_mod' => 0,
				'app_name' => 'spid',
			);
		}
		//_debug_array($categorie);
		
		return $categorie;
	}
	
	function get_account_actif(){
	/**
	 * Retourne la liste des comptes actifs, tableau ayant en index l'identifiant du compte, et en données le nom et le prénom (collés)
	 * @return array
	 */
		$recherche=array(
			'type'       => 'accounts',
		);
		
		$liste_compte=$this->obj_accounts->search($recherche);
		ksort($liste_compte);
		$account=array();
		foreach($liste_compte as $id=>$value){
			if($value['account_status']!='A'){
				unset($liste_compte[$id]);
			}else{
				$account[$id]='['.$value['account_lid'].'] '.$value['account_firstname'].' '.$value['account_lastname'];
			}
		}
		asort($account);
		return $account;
	}
	
	/**
	 * Retourne la liste des catégories du calendrier
	 * @return array
	 */
	function get_cal_cat(){
		$cats = array();
		$obj_cats = CreateObject('phpgwapi.categories',$owner_id,'calendar');
		foreach($obj_cats->return_array('all',0,false,'','','',true) as $id_cat => $value_cat){
			if($value_cat['app_name'] == 'calendar'){
				$cats[$value_cat['id']] = $value_cat['name'];
			}
		}
		asort($cats);
		return $cats;
	}
	
	/**
	 * Retourne la liste des unités de temps utilisable sur les tickets
	 * @return array
	 */
	function get_unit_time(){
		$unit = array(
			'0' => 'Minutes',
			'1' => 'Heures',
			'2' => 'Jours',
		);
		return $unit;
	}
	
	function get_mail(){
	/**
	 * Retourne la valeur du mail par défaut
	 * @return string
	 */
		$general=$this->obj_config;
		return $general['mail_content'];
	}
	
	function get_user_group($id){
	/**
	 * Retourne les utilisateurs du groupe $id
	 * @return array
	 */
		if(!empty($id)){
			$accounts = $this->obj_accounts->members($id);
		}
		return $accounts;
	}
	
	/**
	 * Retourne la liste des intervenants.
	 * @return array
	 */
	function get_intervenant(){
		$this->ajout_intervenant();
		$intervenants = $this->so_intervenants->search('',false);
		if(is_array($intervenants)){
			array_unshift($intervenants,false); 
			unset($intervenants[0]);
		}else{
			$intervenants=array();
		}
		natcasesort($intervenants);
		return $intervenants;
	}
	
	/**
	 * Ajoute les intervenants qui ne sont pas encore dans la base de données.
	 */
	function ajout_intervenant(){
		$liste_intervenants = $intervenants = array();
		$group_management_value=$this->obj_accounts->read($this->obj_config['ticket_management_group']);
		
		
		$cats=$this->get_categorie();
		foreach($cats as $cat){
			if(isset($cat['cat_managementgroup']) && !empty($cat['cat_managementgroup'])){
				$cat_managementgroup=$this->obj_accounts->members($cat['cat_managementgroup'],true);
				foreach($cat_managementgroup as $cle=>$account_id){
					$user = $this->obj_accounts->read($account_id);
					if(!empty($user['account_status']) && !$this->obj_accounts->is_expired($user)){
						$sel_options['ticket_assigned_to'][$account_id]=$this->obj_accounts->id2name($account_id);
					}
				}
			}
			
			$user = $this->obj_accounts->read($cat['cat_assignedto']);
			if(!empty($user['account_status']) && !$this->obj_accounts->is_expired($user)){
				$sel_options['ticket_assigned_to'][$cat['cat_assignedto']]=$this->obj_accounts->id2name($cat['cat_assignedto']);
			}
		}
		
		// $accounts = $this->obj_accounts->members($group_management_value['account_lid']);
		
		$accounts = $sel_options['ticket_assigned_to'];
		unset($sel_options['ticket_assigned_to']);
		
		$liste_intervenants = $this->so_intervenants->search(array(),true);
		
		if(!empty($liste_intervenants)){
			foreach($liste_intervenants as $key => $value){
				$nom = $this->obj_accounts->read($liste_intervenants[$key]['intervenant_id']);
				$intervenants[$liste_intervenants[$key]['intervenant_id']] = $nom['account_lid'];
			}
			$difference=array_diff_assoc($accounts,$intervenants);
		}
		
		if(is_array($difference)){
			foreach($difference as $id => $value){
				$sauv['intervenant_id']=$id;
				$this->so_intervenants->data=$sauv;
				$this->so_intervenants->data['creator_id']=$this->account_id;
				$this->so_intervenants->data['creation_date']=time();
				$this->so_intervenants->save();
			}
		}
	}
	
	/**
	 * Retourne la liste des modeles d'impression de facture
	 *
	 */
	function get_models(){
		$retour = array(
			'spid.generate_pdf' => lang('Normal'),
			'spid.generate_pdf_logo' => lang('Blue'),
			'spid.generate_pdf_grey' => lang('Grey'),
		);
		asort($retour);
		return $retour;
	}
	
	function get_providers(){
	/**
	 * Retourne la liste des groupes correspondant aux prestataires
	 *
	 */
		// $search_param = array(
		// 	'type' => 'groups',
		// 	'start' => 0,
		// 	'sort' => '',
		// 	'order' => '',
		// 	'query' => '',
		// );
		// $groups = $GLOBALS['egw']->accounts->search($search_param);
		$query = array(
			'type' => 'groups',
			'order' => 'account_lid',
			'sort' => 'ASC',
		);
		$groups = $GLOBALS['egw']->accounts->search($query);
		
		$ClientsRelations=$this->so_clients_relations->search('','societe_id');
		$fournisseurs = array();
		if(is_array($ClientsRelations))
		{
			foreach($ClientsRelations as $cle=>$valeur)
			{
				$clients=$this->so_client->read(array('client_id'=>$valeur['societe_id']),false);
				if(!in_array($clients['client_company'],$fournisseurs)){
					$fournisseurs[$clients['account_id']] = $groups[$clients['account_id']]['account_lid'];
				}
			}
		}
		
		return $fournisseurs;
	}
}


?>