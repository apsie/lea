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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.admin_so.inc.php');	
	
class admin_bo extends admin_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	var $autoassign;
	var $state_source;
	var $state_cible;
	var $state_close;
	var $state_initial;
	var $state_billable;
	var $state_name;
	
	var $verification;
	
	var $nom_des_tables;
	var $id_tables;
	
	
	function __construct() {
	/**
	*Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		
		$this->state_cible = array();
		$this->state_source = array();
		$this->state_name = array();
		
		$this->state_close = array (
			'1'  => 'Closable',
			'0'  => 'Not Closable',
		); 
		$this->state_initial = array (
			'1'  => 'Initial',
			'0'  => 'Not Initial',
		);
		$this->state_billable = array (
			'1' => 'Billable',
			'0' => 'Not Billable',
		);
		
		$this->verification=true;
		
		$this->nom_des_tables=array(
			'cats'			=> 'egw_categories',
			'states' 		=> 'spid_etats',
			'transitions' 	=> 'spid_transitions',
			'responses' 	=> 'spid_reponses_standard',
			//YLF
			'mail'			=> 'spid_mail',
		);
		$this->id_tables=array(
			'cats'			=> 'cat_id',
			'states' 		=> 'state_id',
			'transitions' 	=> 'transition_id',
			'responses' 	=> 'standard_reply_id',
			//YLF
			'mail'			=> 'mail_id',
		);
		
		parent::__construct();
	}
		
	function admin_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function delete_config($id=null,$table=null){
	/**
	 * Gère la suppression des élements dans l'écran de Configuration du site. Retourne un message informant de l'état des suppressions (réussies, échouées, ...)
	 * 
	 * @param int $id=NULL correspond à l'id de l'élement qui doit être enlevé
	 * @param string $table=NULL correspond à la table sur laquelle l'élement se trouve
	 * @return string
	 */
		$msg='';
		$verif=false;
		if(!empty($id) && !empty($table)){
			switch($table){
				case 'cats':
					$verif=$GLOBALS['egw']->categories->delete($id);
					break;
				case 'responses':
					$verif=$this->so_reponses_standard->delete($id);
					break;
				case 'states':
					$verif=$this->so_etats->delete($id);
					break;
				case 'transitions':
					$verif=$this->so_transitions->delete($id);
					break;
				case 'general':
				default:
					break;
			}
			if($verif){
				$msg='The item was successfully removed';
			}
		}
		return $msg;
	}
	
	function add_update_config($tab='',$reponse=array()){
	/**
	 * Gère l'ajout/édition de réponses standards. Retourne un message informant de l'état des mises à jour (réussies, échouées, ...)
	 * 
	 * @param string $tab="" correspond à la table sur laquelle l'élement se trouve
	 * @param array $reponse=array() est un tableau contenant les réponses standards qui doivent être éditées/ajoutées
	 * @return string
	 */
		$msg='';
		$obj='';
		if(!empty($reponse)){
			switch($tab){
				case 'cats':
					$obj=$GLOBALS['egw']->categories;
					$ancien=$this->get_cat();
					$id_reponse='id';
					break;
				case 'responses':
					$obj=$this->so_reponses_standard;
					$ancien=$this->get_reponse_standard();
					$id_reponse='standard_reply_id';
					$lab_nom='canned_name';
					break;
				case 'states':
					$obj=$this->so_etats;
					$ancien=$this->get_etat();
					$id_reponse='state_id';
					$lab_nom='state_name';
					break;
				case 'transitions':
					$obj=$this->so_transitions;
					$ancien=$this->get_transition();
					$id_reponse='transition_id';
					$lab_nom='name';
					break;
				case 'general':
					$obj = CreateObject('phpgwapi.config');
					foreach($reponse as $id=>$value){
						$obj->save_value($id,$value,'spid');
					}
					$id_reponse='';
					break;
				//Spirea YLF - 03/02/2011 - case mail pour gérer la maj du mail
				case 'mail':
					$obj =& CreateObject('phpgwapi.config');
					foreach($reponse as $id=>$value){
						$obj->save_value($id,$value,'spid');
					}

					$id_reponse='';
					break;
				//fin
				case 'intervenants':
					$obj=$this->so_intervenants;
					$ancien=$this->get_intervenant();
					$id_reponse = 'intervenant_id';
					$lab_nom = 'intervenant_id';
					break;
				default:
					break;
			}
			//Spirea YLF - 03/02/2011 - MaJ de obj_config pour voir les changements tout de suite
			$config = CreateObject('phpgwapi.config');
			$this->obj_config=$config->read('spid');
			//fin
			if($id_reponse!=""){
				foreach($reponse as $id => $value){
					if($id_reponse=="id"){
						if(!empty($value['name'])){
							$value['data']=serialize($value['data']);
							if($id!=count($reponse)){
								$obj->data['last_mod']=time();
								$obj->edit($value);
							}else{
								if(is_array($ancien[$id])){
									$difference=array_diff_assoc($reponse[$id],$ancien[$id]);
								}
								else{
									$difference=$reponse[$id];
								}
								if(!empty($difference)){
									$obj->data['last_mod']=time();
									$obj->account_id = categories::GLOBAL_ACCOUNT;
									$obj->add($value);
								}
							}
						}
					}else{
						if(!empty($value[$lab_nom])){
							if(is_array($ancien[$id])){
								$difference=array_diff_assoc($reponse[$id],$ancien[$id]);
							}
							else{
								$difference=$reponse[$id];
							}
							if(($id!=count($reponse)||$id_reponse=='intervenant_id')){
								if(!empty($difference)){
									$difference[$id_reponse]=$reponse[$id][$id_reponse];
									$obj->data=$difference;
									$obj->data['change_date']=time();
									$obj->update($obj->data,true);
								}
							}else{
								if(!empty($difference)){
									$difference[$id_reponse]=$reponse[$id][$id_reponse];
									$obj->data=$difference;
									$obj->data['creator_id']=$this->account_id;
									$obj->data['creation_date']=time();
									$obj->save();
								}
							}
							
							
							// Traitement des transitions dans la page etat
							if(!empty($difference['etat_enfant'])){
								if($id_reponse == 'state_id'){
									$infoTransition['state_id'] = $obj->data['state_id'];
									$infoTransition['etat_enfant'] = explode(',',$value['etat_enfant']);
									$msg = $this->add_update_transition($infoTransition);
								}
							}	
						}
					}
				}
			}
			$msg='Configuration updated';
			//FAIRE LE RETOUR POUR LE MESSAGE
		}
		return $msg;
	}
	
	function add_update_transition($info){
	/**
	 * Crée ou met à jour les transition d'un statut
	 *
	 * @param $info : information concernant la transition (statut_id, statut_enfants(array))
	 */
		$msg = '';
		if(is_array($info)){
			$this->so_transitions->delete(array('source_id' => $info['state_id']));
			foreach($info['etat_enfant'] as $key => $etatEnfant){
				if(!empty($etatEnfant)){
					unset($this->so_transitions->data['transition_id']);
					$this->so_transitions->data['source_id'] = $info['state_id'];
					$this->so_transitions->data['target_id'] = $etatEnfant;
					$this->so_transitions->save();
				}
			}
		}
	}
	
	function get_enfant_possible(){
	/**
	 * Retourne la liste des enfants possible pour un etat
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_etats->search(array(),false,'state_name ASC');
		$i = 0;
		foreach($info as $key => $data){
			$retour[$data['state_id']] = $data['state_name'];
		}
		return $retour;
	}
	
	function get_state($id){
	/**
	 * Retourne l'état ayant l'identifiant $id
	 *
	 * @return array
	 */
		$info = $this->so_etats->read($id);
		
		$transitions = $this->so_transitions->search(array('source_id' => $id),false);
		foreach($transitions as $transition){
			$info['etat_enfant'][] = $transition['target_id'];
		}
		
		$info['etat_enfant'] = implode(',', $info['etat_enfant']);
		
		return $info;
	}
	
	function get_states($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les statues
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		if(!is_array($query['search'])){
			$search = $this->construct_search($query['search'],$this->so_etats);
		}else{
			$search=$query['search'];
		}
		
		$rows = $this->so_etats->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter']);
		
		// Affichage des transitions
		if(is_array($rows)){
			foreach($rows as $id => $row){
				$transitions = $this->so_transitions->search(array('source_id' => $row['state_id']),false);
				if(is_array($transitions)){
					foreach($transitions as $transition){
						$rows[$id]['etat_enfant'][] = $transition['target_id'];
					}
					if(is_array($rows[$id]['etat_enfant'])){
						$rows[$id]['etat_enfant'] = implode(',', $rows[$id]['etat_enfant']);
					}
				}
			}
		}
		$GLOBALS['egw_info']['flags']['app_header'] = lang('States Management');
		return $this->so_etats->total;	
    }
	
	function add_update_state($info){
	/**
	 * Enregistre l'état avec les données $data 
	 */
		$msg='';
		if(is_array($info)){
			unset($info['button']);
			unset($info['nm']);
			unset($info['msg']);
			$this->so_etats->data = $info;
			if(isset($this->so_etats->data['state_id'])){
				$this->so_etats->data['change_date'] = time();
				$this->so_etats->update($this->so_etats->data,true);
				
				$msg .= ' '.lang('State updated');
			}else{
				$this->so_etats->data['state_id'] = '';
				$this->so_etats->data['creation_date'] = time();
				$this->so_etats->save();
				
				$msg .= ' '.lang('State created');
			}
			
			$infoTransition['state_id'] = $this->so_etats->data['state_id'];
			$infoTransition['etat_enfant'] = explode(',',$info['etat_enfant']);
			$msg .= $this->add_update_transition($infoTransition);
		}
		return $msg;
	}
	
	function recup_rdv_lien(){
	/**
	 * Scanne les liens tickets-calendrier et ajoute dans la table spid_rendez_vous les événements liés 
	 * à un ticket mais qui ne sont pas dans cette table
	 *
	 * @return String (resultat du nombre d'ajout / erreur etc... pour l'utilisateur
	 */
		$so_link = new so_sql('phpgwapi','egw_links');
		$so_calendar = new calendar_so();
		
		// Récupération des liens dans les deux sens // Sans prendre ceux qui sont deja dans la table spid_rendez_vous
		$join = 'WHERE link_id2 NOT IN (SELECT cal_id FROM spid_rendez_vous)';
		$link1 = $so_link->search(array('link_app1' => 'spid', 'link_app2' => 'calendar'),false,$order,'',$wildcard,false,'AND',array(0,9999999999),'',$join);
		
		$join = 'WHERE link_id1 NOT IN (SELECT cal_id FROM spid_rendez_vous)';
		$link2 = $so_link->search(array('link_app2' => 'spid', 'link_app1' => 'calendar'),false,$order,'',$wildcard,false,'AND',array(0,9999999999),'',$join);
		
		$links = array_merge((array)$link1, (array)$link2);

		// Parcours des liens récupérer
		foreach($links as $link){
			if($link['link_app1'] == 'spid'){
			// Lien sens spid -> cal
				
				// Récupération de l'event
				$cal = $so_calendar->read($link['link_id2']);

				// Parcours des participants et préparation pour l'ajout a spid_rendez_vous pour chacun d'eux
				foreach($cal[$link['link_id2']]['participant_types']['u'] as $user_id => $value){
					$rendez_vous[] = array(
						'ticket_id' => $link['link_id1'],
						'account_id' => $user_id,
						'cal_id' => $link['link_id2'],
						'creation_date' => $_SERVER['REQUEST_TIME'],
						'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
					);
				}
			}else{
			// Lien sens spid <- cal
			
				// Récupération de l'event
				$cal = $so_calendar->read($link['link_id1']);

				// Parcours des participants et préparation pour l'ajout a spid_rendez_vous pour chacun d'eux
				foreach($cal[$link['link_id1']]['participant_types']['u'] as $user_id => $value){
					$rendez_vous[] = array(
						'ticket_id' => $link['link_id2'],
						'account_id' => $user_id,
						'cal_id' => $link['link_id1'],
						'creation_date' => $_SERVER['REQUEST_TIME'],
						'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
					);
				}
			}
		}
		// _debug_array($rendez_vous);
		$count = 0;
		foreach($rendez_vous as $rdv){
			++$count;
			$this->so_rendez_vous->save($rdv);
		}
		
		return lang('%1 meetings merge with tickets', $count);
	}

	function get_account(){
    /**
     * Retourne la liste des comptes
     *
     * @return array
     */
    	$accounts = $this->so_account->search(array('account_active' => true),false);
    	foreach($accounts as $account){
    		$return[$account['account_id']] = $account['account_code'].' - '.$account['account_label'];
    	}

    	return $return;
    }
	
	function get_book(){
    /**
     * Retourne la liste des journaux de compte
     *
     * @return array
     */
    	$books = $this->so_book->search(array('book_active' => true),false);
    	foreach($books as $book){
    		$return[$book['book_id']] = $book['book_code'].' - '.$book['book_label'];
    	}

    	return $return;
    }

    function get_accounting_export(){
    /**
     * Retourne la liste des formats d'export vers la compta
     *
     * @return array
     */
    	return array(
    		'pnm' => lang('Sage PNM File'),
    	);
    }
}	
?>
