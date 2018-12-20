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
	
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.spid_so.inc.php');	
	
class spid_bo extends spid_so 
{
	var $tabs = 'messages|details|update|meeting|accounting|checklist|links|url|history';
	
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
	
	var $account_id;
	var $app_title;
	
	var $var_technicienCategorie;
	var $tab_technicienCategorie=array();

	var $state_close;
	var $state_name;
	var $sel_reponsestandard;
	var $state_initial;
	var $state_billable;
	var $sel_priority;
	var $sel_client;

	
	var $verification;
	var $total;
	var $checkgroups;
	var $new_group;
	var $assignedby;
	var $assignedto;
	
	var $clients;
	var $obj_cats;

	function __construct() {
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		/* Récupération des droits d'accès ACL */
		$acl = CreateObject('spid.acl_spid');
		$this->grants=$acl->getACL();
		$this->grants['admin']=$this->is_admin($this->account_id);
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		$groupeDuCompte=$this->obj_accounts->membership($this->account_id);
		
		// spirea - tch - à nettoyer...
		foreach($groupeDuCompte as $id=>$value){
			if($value['account_id']==-2){
				$this->grants['admin']=1;
				break;
			}
		}
		
		if($groupeDuCompte[0]['account_id']==-206){
			$this->grants['paie']=1;
		}
		/* Récupération les infos de configurations */
		$config = CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		$this->obj_preferences = $GLOBALS['egw_info']['user']['preferences']['spid'];
		
		$this->autoassign = array(); 
		$this->state_name = array();
		$this->sel_reponsestandard = array();
		$this->sel_client = array();
		$this->checkgroups = array();
		$this->new_group = array();
		$this->assignedby = array();
		$this->assignedto = array();
		

		$this->sel_priority=array(
			'1'	=> lang('Day'),
			'5'	=> lang('Week'),
			'10'=> lang('More'),
		);

		$this->verification=true;
		$this->total=0;
		
		$this->obj_cats = CreateObject('phpgwapi.categories',$owner_id,'calendar');
		
		$this->var_technicienCategorie=$this->technicienCategorie();
		
		parent::__construct();
	}
		
	function bo_spid(){
	/**
	* Constructeur
	*/
		self::__construct();
	}
	
	function phparray_jsarray($name, $array, $new=true){
	/**
	* Renvoie un code javascript créant, pour chaque objet contenu dans $array un tableau à 2 dimensiosn d'indice $name,$array[index]. Routine récursive par essence (peut donc créer des tableaux de tableaux de ... en javascript)
	*
	* @param int $name
	* @param int $array
	* @param int $new=true crée l'objet $name
	* @return string
	*/
		if(!is_array($array)){
			return '';
		}
		if($new){
			$jsCode = "$name = new Object();\n";
		}else{
			$jsCode = '';
		}
		foreach ($array as $index => $value){
			if (is_array($value)){
				$jsCode .= $name."['".$index."'] = new Object();\n";
				$jsCode .= $this->phparray_jsarray($name."['".$index."']", $value,false);
				continue;
			}

			switch(gettype($value)){
				case 'string':
					$value = '"'.str_replace(Chr(13).Chr(10),'',$value).'"';
					$value = str_replace(Chr(10),'',$value);
					//$value = "'".addcslashes($value,'</>')."'";
					break;
				case 'boolean':
					if ($value){
						$value = 'true';
					}else{
						$value = 'false';
					}
					break;
				default:
					$value = 'null';
			}
			$jsCode .= $name."['".$index."'] = ".$value.";\n";
		}
		return $jsCode;
	}
	
	function groupeGestionnaire(){
	/**
	* détermine si l'utilisateur fait partie d'un groupe de gestionnaires
	*
	* @return bool
	*/
		$groupeUser=$this->obj_accounts->members($this->obj_config['ticket_management_group']);
		if(array_key_exists($this->account_id,$groupeUser)){
			return true;
		}else{
			return false;
		}
	}
	
	
	function technicienCategorie(){
	/**
	* détermine si l'utilisateur est un technicien
	*
	* NOTE : Ne doit probablement pas marcher
	*
	* @return bool
	*/
		$technicienCategorie=false;
		if(!$this->grants['admin']){
			$this->tab_technicienCategorie=$this->GestionnaireCategorie();
			if(!empty($this->tab_technicienCategorie)){
				$technicienCategorie=true;
				$this->grants['technicienCategorie']=true;
			}
		}
		return $technicienCategorie;
	}
	
	function GestionnaireCategorie(){
	/**
	* Retourne la liste des catégories auxquelles appartient l'utilisateur courant
	*
	* @return array
	*/
		$GestionnaireCategorie=array();
		$groupeUser=$this->obj_accounts->memberships($this->account_id,true);
		$GestionnaireCategorie=$this->groupeGestionCategorie($groupeUser);
		return $GestionnaireCategorie;
	}

	function client_groups($join='',$type=null,$active_only=true,$first='All',$technicien=false){
	/**
	* Retourne la liste des clients (clients et entreprises clientes) de l'utilisateur courant en fonction de son niveau (0,1,2)
	*
	* Le tableau résultat contient en index l'identifiant du client et en valeurs son nom
	*
	* \version BBO - 06/08/2010 - V2 de la fonction
	*
	* NOTE : $technicien et $first ne servent à rien
	*
	* @param string $first='All'
	* @param bool $technicien=false
	* @return array
	*/
		if(empty($GLOBALS['egw_info']['user']['SpidLevel'])){
			$GLOBALS['egw_info']['user']['SpidLevel'] = $this->isTechnicianOrManagerOrCustomer();
		}


		$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];

		// YLF - Filtre par défaut 
		$op = 'AND';
		$recherche = array('client_sleep' => $active_only ? '0' : '', 'client_type' => $type);

		$clients=array();
	
		switch($SpidLevel)
		{
			case 0:
				$groupeUtilisateur=$this->obj_accounts->memberships($this->account_id);
				$recherche=array_merge($recherche, array('account_id'=>array_keys($groupeUtilisateur)));
				$SpidClients=$this->so_client->search($recherche,'client_id,account_id,client_company','client_company ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
				break;
			case 1:
			case 10:
				$groupeUtilisateur=$this->obj_accounts->memberships($this->account_id);
				$recherche=array_merge($recherche, array('account_id'=>array_keys($groupeUtilisateur)));

				unset($recherche['client_type']);
				$SpidClients=$this->so_client->search($recherche,'client_id,account_id,client_company','client_company ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
				$RelationClients=array();
				$i=0;
				foreach($SpidClients as $rows)
				{
					$RelationClients[$i]=$this->so_clients_relations->search(array('societe_id'=>$rows['client_id']),'client_id');
					$i=$i+1;
				}
				if(is_array($RelationClients) && !empty($RelationClients))
				{
					foreach($RelationClients as $rows)
					{
						if(is_array($rows) && !empty($rows))
						{
							foreach($rows as $id2Client)
							{
								$ClientsDeLaSociete=$this->so_client->search(array('client_id'=>$id2Client['client_id']),'client_id,account_id,client_company','client_company ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
								$SpidClients[]=$ClientsDeLaSociete[0];
							}							
						}
					}
				}
				break;
			case 50:
				$SpidClients = $this->so_client->search($recherche,'client_id,account_id,client_company','client_company ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
				break;
			case 99:
				$SpidClients = $this->so_client->search($recherche,'client_id,account_id,client_company','client_company ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
				break;
		}
		foreach($SpidClients as $rows)
		{
			// Spirea-YLF - Modif client/demandeur 
			if($rows != null){$clients[$rows['client_id']]=$rows['client_company']; }
		}
		natcasesort($clients);
		return $clients;
	}
	

	function assigned_to($cat_id=null){
	/**
	* Retourne la liste des gens à qui est assignée la catégorie et son groupe de gestion
	*
	* Le tableau résultat contient en index l'identifiant des personnes du groupe de gestion ou assignées, et en valeurs leur nom.
	*
	* NOTE : Peut ne rien retourner. Merci de revoir la première ligne
	*
	* @param int $cat_id=null catégorie à inspecter
	* @return array
	*/
		if(is_null($cat_id)){
			return null;
		}else{
			
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
			foreach($categorie as $id=>$value){
				if($value['id']==$cat_id){
					$categorie[$id]['data']=unserialize($categorie[$id]['data']);
					if(isset($categorie[$id]['data']['cat_assignedto']) && !empty($categorie[$id]['data']['cat_assignedto'])){
						$account=$categorie[$id]['data']['cat_assignedto'];
						$nom=$this->obj_accounts->read($account);
						$ticket_assigned_to[$account]=$nom['account_lid'];
					}
					if(isset($categorie[$id]['data']['cat_managementgroup']) && !empty($categorie[$id]['data']['cat_managementgroup'])){
						$id_groupe=$categorie[$id]['data']['cat_managementgroup'];
						$tab_id_user=$this->obj_accounts->member($id_groupe);
						foreach($tab_id_user as $cle=>$valeur){
							$account=$valeur['account_id'];
							$nom=$this->obj_accounts->read($account);
							$ticket_assigned_to[$account]=$nom['account_lid'];
							
						}
						
					}
				}
			}
			if(empty($ticket_assigned_to)){
				$assigned=$this->obj_config['ticket_assigned_to'];
				$nom=$this->obj_accounts->read($assigned);
				$ticket_assigned_to[$assigned]=$nom['account_lid'];
			}
		}
		if(is_array($ticket_assigned_to)){
			natcasesort($ticket_assigned_to);
		}
		
		
		return $ticket_assigned_to;
	}
	
	function open_by($group_id=null){
	/**
	* Retourne la liste des gens ayant ouverte le ticket faisant partie du groupe dont l'identifiant est $group_id
	*
	* L'index du tableau est l'identifiant du compte ayant ouvert le ticket, la valeur correspondante est son nom
	*
	* NOTE : Ne peux et ne doit pas marcher, aucun test sur le $group_id, rien ne permets d'affirmer que la liste retournée est bien celle demandée
	*
	* @param int $group_id=NULL
	* @return array
	*/
		$ticket_open_by=array();
		foreach($group_id as $id=>$value){
			$demandeur = $this->obj_accounts->members($id,true);
			foreach($demandeur as $cle => $account_id){
				$ticket_open_by[$account_id] = $this->obj_accounts->id2name($account_id);
			}
		}
		return $ticket_open_by;
	}
	
	function get_info($id){
	/**
	* Retourne les informations au sujet du ticket dont l'identifiant passé en argument ($id).
	*
	* Le tableau de retour contient comme index :
	*
	* \li Les index des tickets
	*
	* \li reponse -> Tableau d'index l'identifiant du ticket contenant en valeur le contenu des diverses réponses au sujet du ticket
	*
	* \li historique -> Tableau d'index l'identifiant du ticket et contenant en valeur les divers états du ticket correspondant
	*
	* \li url -> Lien vers le ticket. Tableau dans le cas de plusieurs liens (5 max), avec 2 index : un nombre de 5 à 10 en premier index et 'num' end second index. La valeur du tableu est le lien.
	*
	* \li n_family -> famille de la personne ayant assigné le ticket
	*
	* \li n_given -> Personne ayant posté le ticket
	*
	* \li tel_work -> Téléphone de la personne ayant assigné le ticket
	*
	* \li email -> Email de la personne ayant assigné le ticket
	*
	* NOTE : il doit y avoir un bug sur le champ ticket_id_assigned
	*
	* @param int $id
	* @return array
	*/
		$fields = '*';
		if($this->obj_config['synchro_presta']){
			$join = 'LEFT JOIN egw_prestation P ON P.lettre_de_commande = spid_tickets.ticket_client_order_id LEFT JOIN egw_contact C ON C.id_ben = P.id_ben';
			$fields = 'spid_tickets.*,nom_complet,id_presta,date_debut,date_fin,date_fin_reelle,statut';
		}

		// $this->debug = 5;
		$ticket = parent::search(array('ticket_id' => $id),$fields,'ticket_id ASC','','',false,'OR',false,'',$join);

		$ticket[0]['ticket_lid']='#'.$ticket[0]['ticket_num_group'];
		$info_etat=$this->so_etats->read($ticket[0]['state_id']);
		$ticket[0]['state_name']=$info_etat['state_name'];
		$ticket[0]['state_description']=$info_etat['state_description'];
		$reponse=$this->so_reponses->search(array('ticket_id' => $id, 'actions'	=> 'reponses'),false,'reply_id');
		$url_link=$this->so_url->search(array('ticket_id' => $id),false,'url_id');
		$rendez_vous=$this->so_rendez_vous->search(array('ticket_id' => $id),false,'cal_id');
		$historique=$this->so_reponses->search(array('ticket_id' => $id, 'actions'	=> '!reponses'),false,'creation_date DESC');
		//Traitement pour effectuer les retours chariots \n
		if(is_array($reponse)){
			foreach($reponse as $id=>$value){
				if (preg_match("/<br/i", $value['reply_content'])) {
					$reponse[$id]['reply_content']=$value['reply_content'];
				}else{
					$reponse[$id]['reply_content']=nl2br($value['reply_content']);
				}
			}
		}
		if(is_array($ticket)){
			array_unshift($ticket, false);
			unset($ticket[0]);
		}
		if(is_array($reponse)){
			array_unshift($reponse, false);
			unset($reponse[0]);
		}
		if(is_array($url_link)){
			$temp_url=array();
			foreach($url_link as $cle=>$valeur){
				$temp_url[$cle+5]=$valeur;
				$temp_url[$cle+5]['num']=$cle+1;
			}
			$url_link=array();
			$url_link=$temp_url;
		}

		//YLF
		if(is_array($rendez_vous)){
			$temp_rdv=array();
			foreach($rendez_vous as $cle=>$valeur){
				$cal_event = $this->so_calendar->read($rendez_vous[$cle]['cal_id']);
				if(is_array($cal_event)){
					$temp_rdv[$cle+1]=$valeur;
					$temp_rdv[$cle+1]['num']=$cle+1;
					$temp_rdv[$cle+1]['id'] = $rendez_vous[$cle]['cal_id'];
					$temp_rdv[$cle+1]['lien']='<img src="/spid/templates/default/images/calendar.png" onclick="location.href=\'http://'.$GLOBALS['egw_info']['server']['hostname'].'/index.php?menuaction=calendar.calendar_uiforms.edit&amp;cal_id='.$rendez_vous[$cle]['cal_id'].'\'">';
					$temp_rdv[$cle+1] = array_merge($temp_rdv[$cle+1],$cal_event[$rendez_vous[$cle]['cal_id']]);
				}else{
					// l'event n'existe plus on le supprime de la table rendez-vous
					$this->so_rendez_vous->delete($valeur);
				}
			}
			$rendez_vous=$temp_rdv;
			$total['heures'] = 0;
			$total['jours'] = 0;
			$total['confirmed'] = $total['realised'] = $total['option'] = $total['intervention'] = 0;
			foreach($rendez_vous as $id => $value){
				$categories = $this->get_catname(explode(',',$value['category']));
				$rendez_vous[$id]['category'] = implode(', ',$categories);
				foreach($rendez_vous[$id]['participants'] as $id_participant => $value_participant){
					$rendez_vous[$id]['participants'][] = $this->obj_accounts->id2name($id_participant,'account_fullname');
					unset($rendez_vous[$id]['participants'][$id_participant]);
				}
				$rendez_vous[$id]['participants'] = implode(', ',$rendez_vous[$id]['participants']);
				
				$temp = array(
					'date_depart'=>$rendez_vous[$id]['start'],
					'date_reelle_retour'=>$rendez_vous[$id]['end']
				);
				
				
				$rendez_vous[$id]['heures'] = round($this->calculHeure($temp,$this->nbDiffJour($temp)),2);
				
				$rendez_vous[$id]['jours'] = round($this->calculTranche($temp,$this->nbDiffJour($temp)),2);
				$total['heures'] += $this->calculHeure($temp,$this->nbDiffJour($temp));
				$total['jours'] += $this->calculTranche($temp,$this->nbDiffJour($temp));
				
				if($value['category'] == $this->obj_config['confirmed_intervention']){
					$total['confirmed'] += $this->calculTranche($temp,$this->nbDiffJour($temp));
				}elseif($value['category'] == $this->obj_config['realised_intervention']){
					$total['realised'] += $this->calculTranche($temp,$this->nbDiffJour($temp));
				}elseif($value['category'] == $this->obj_config['option_intervention']){
					$total['option'] += $this->calculTranche($temp,$this->nbDiffJour($temp));
				}
				$total['intervention'] += $this->calculTranche($temp,$this->nbDiffJour($temp));
			}			
		}
		//fin
		
		// Calcul du temps des appels (si spitel est autorisé)
		$obj_acl = CreateObject('phpgwapi.acl');
		$allowedApps = array_keys($obj_acl->get_user_applications());
		$duree = 0;
		if(in_array('spitel',$allowedApps)){
			// Récupération des appels du ticket en cours
			$appels = $this->so_appel->search(array('ticket_id'=>$content['ticket_id']),false);
			if(is_array($appels)){
				// Boucle sur les appels
				foreach($appels as $appel){
					$duree += $appel['duree'];
				}
			}
		}
		// Conversion de la durée sous la forme (00H00min00s)
		if($duree != 0){
			$temps=($duree%60)."s";
			if(($duree/60)>=1){
				$temps=(($duree/60)%60)."min".$temps;
				if(($duree/3600)>=1){
					$temps=(($duree/3600)%24)."H".$temps;
				}
			}
		}else{
			$temps = 0;
		}
		// Fin
		
		if(!empty($historique)){
			array_unshift($historique, false);
			unset($historique[0]);
			foreach($historique as $id=>$value){
				if(is_numeric($value['old_value']) && !empty($value['old_value']) && strlen($value['old_value'])==10){
					$historique[$id]['old_value']=date('d/m/Y',$value['old_value']);
				}
				if(is_numeric($value['new_value']) && !empty($value['new_value']) && strlen($value['new_value'])==10){
					$historique[$id]['new_value']=date('d/m/Y',$value['new_value']);
				}
			}
		}
		
		$reponses=array();
		// Parcours du tableau réponse afin de décaler les élements du tableau quand l'id vaut 2, sinon le message n'est affiché du au label "Notes additionnelles"
		if(count($reponse)>=2){
			foreach($reponse as $id=>$value){
				if($id>=2){
					$reponses[$id+1]=$reponse[$id];
				}else{
					$reponses[$id]=$reponse[$id];
				}
			}
		}else{
			$reponses=$reponse;
		}
		
		$details=$ticket[1];
		switch($this->obj_config['unit_time']){
			case 0: // minutes
				$details['time_meeting'] = $total['heures'] * 60;
				$details['time_spend_label'] = lang(' (min)');
				break;
			case 1: // heures
				$details['time_meeting'] = $total['heures'];
				$details['time_spend_label'] = lang(' (h)');
				break;
			case 2: // jours
				$details['time_meeting'] = $total['jours'];
				$details['time_spend_label'] = lang(' (d)');
				break;
		}
		
		$details['reponse']=$reponses;
		$details['historique']=$historique;
		$details['rdv']=$rendez_vous;
		$details['url']=$url_link;

		$details['total'] = $this->format_int($total);
		$details['difference'] = number_format($details['ticket_budget'] - $total['intervention'], 2, '.', ' ');
		$details['total']['rendez_vous'] = empty($rendez_vous) ? '' : sizeof($rendez_vous);
		$details['total_spend_time'] = $total['heures'] + $details['ticket_spend_time'];
		
		$contacts = new so_sql('phpgwapi', 'egw_addressbook');
		$addressbook = $contacts->read($details['ticket_assigned_by_contact']);
		$details['tel_work'] = $addressbook['tel_work'];
		$details['email'] = $addressbook['contact_email'];
		$details['phone_time'] = $temps;
		
		$details['prestataire'] = $this->get_prestataire($details['cat_id']);
		
		$details['rdvInterviewer'] = $GLOBALS['egw_info']['user']['account_id'];
		$details['rdvcategory'] = $this->obj_config['default_cat'];
		$details['rdvtitle'] = $details['ticket_title'];
		
		if($GLOBALS['egw_info']['user']['apps']['spiclient']){
			$details['contract_link'] = '<a href=\'\' onclick="window.open(\'/index.php?menuaction=spiclient.contrat_ui.edit&id='.$details['contract_id'].'\',\'\',\'width=930,height=600,scrollbars=1\')">'.$this->contract2name($details['contract_id']).'</a>';
		}else{
			$details['contract_link'] = $this->contract2name($details['contract_id']);
		}
		
		$checklists = $this->so_spid_checklist->search(array('ticket_id' => $details['ticket_id']),false);
		$liste = array();
		foreach((array)$checklists as $checklist){
			$liste[$checklist['chk_id']] = $checklist['chk_id'];
		}
		$details['checklist'] = implode(',',$liste);
		
		// Libellé facture
		if(!empty($details['facture_id'])){
			$facture = $this->so_factures->read($details['facture_id']);
			$details['facture_number'] = $facture['facture_number'];
		}

		// Payeur / Mandataire
		if(!empty($details['contract_id'])){
			$contrat = $this->so_contrat->read($details['contract_id']);
			$payer = $attorney = array();
			if(!empty($contrat['contract_payer']))
				$payer = $this->so_client->read($contrat['contract_payer']);

			if(!empty($contrat['contract_attorney']))
				$attorney = $this->so_client->read($contrat['contract_attorney']);

			$details['payer_id'] = $payer['client_id'];
			$details['payer_company'] = $payer['client_company'];
			$details['attorney_id'] = $attorney['client_id'];
			$details['attorney_company'] = $attorney['client_company'];
		}


		return $details;
	}
	
	function get_checklist($client_id, $cat_id){
	/**
	 * Récupère les infos de la checklist pour le client $client_id et la catégorie $cat_id
	 */
		$retour = array();
		$checklists = $this->so_checklist->search(array('client_id' => $client_id,'cat_id' => $cat_id),false,'chk_order ASC');
		foreach((array)$checklists as $checklist){
			$retour[$checklist['chk_id']] = $checklist['chk_title'].' - '.$checklist['chk_comment'];
		}
		
		return $retour;
	}
	
	function contract2name($contract_id){
	/**
	 * Renvoie le nom du contrat ayant l'identifiant $contract_id
	 *
	 * @param $contract_id int : identifiant du contrat
	 * @return string
	 */
		$contrat = $this->so_contrat->read($contract_id);
		return $contrat['contract_title'];
	}
	
	function get_catname($catlist = ''){
	/**
	* Renvoie les noms des categories dont les numeros sont passé en paramètre
	*
	* @param $catlist int/array
	* @return array
	*/
		if($catlist == '') return array();
		if(is_array($catlist)){
			foreach($this->obj_cats->return_array('all',0,false,'','','',true) as $id_cat => $value_cat){
				$catname[$value_cat['id']] = $value_cat['name'];
			}
			foreach($catlist as $id => $value){
				foreach($catname as $idname => $valuename){
					if($value == $idname){
						$return[] = $valuename;
					}
				}
			}
		}
		return $return;
	}
	
	function get_prestataire($cat_id){
	/**
	 * Retourne l'id client du prestataire de la catégorie ayant l'identifiant $cat_id
	 *
	 * @param $cat_id int : identifiant de la catégorie
	 * @return int : identifiant du client
	 */
		$cats = new categories($this->account_id,'spid');
		$categorie = $cats->return_single($cat_id);
		$data = unserialize($categorie[0]['data']);
		
		$client = $this->so_client->search(array('account_id' => $data['cat_managementgroup']));
		return $client[0]['client_id'];
	}
	
	function historique($content){
	/**
	* Insère une ligne dans la table d'historique en fonction de l'ajout/mise à jour. $content doit contenir l'index ticket_id
	*
	* NOTE : qu'est ce qui garantie que $content['ticket_id'] existe ?
	*
	* \version BBO - 07/07/2010 - MAJ - Suppression de l'historisation du texte label permettant de savoir si le ticket est privé ou non...
	*
	* @param array $content
	* @return bool
	*/
	
	/*
	 $ticket_id représente l'id du ticket (int)
	 $action représente le champ concerné par l'ajout/mise à jour (string)
	 $old_value représente l'ancienne valeur
	 $new_value représente la nouvelle valeur
	*/
		$avant=$this->get_info($content['ticket_id']);
		unset($avant['state']);
		$historique=array_diff_assoc($content,$avant);

		//Spirea YLF - 11/04/2011 - Les valeurs des rendez-vous n'ont pas à être prise en compte
		if(isset($historique['rdvstart'])){
			unset($historique['rdvstart']);
		}
		if(isset($historique['rdvduration'])){
			unset($historique['rdvduration']);
		}
		if(isset($historique['rdvlocation'])){
			unset($historique['rdvlocation']);
		}
		if(isset($historique['rdvtitle'])){
			unset($historique['rdvtitle']);
		}
		if(isset($historique['rdvdescription'])){
			unset($historique['rdvdescription']);
		}
		if(isset($historique['rdvcategory'])){
			unset($historique['rdvcategory']);
		}
		if(isset($historique['time_spend_label'])){
			unset($historique['time_spend_label']);
		}
		if(isset($historique['budget'])){
			unset($historique['budget']);
		}
		if(isset($historique['location_id'])&&empty($historique['location_id'])){
			unset($historique['location_id']);
		}
		
		unset($historique['hidestudent']);
		unset($historique['hidebudget']);
		unset($historique['hidephone']);
		unset($historique['hidesite']);
		unset($historique['hideprecision']);
		unset($historique['hidesiteprecision']);
		unset($historique['hidecontrat']);
		unset($historique['hideprivate']);
		unset($historique['client']);
		unset($historique['budget_mod']);
		unset($historique['contract_mod']);
		unset($historique['hide_private']);
		//Fin

		if(isset($historique['reponse_standard'])){
			unset($historique['reponse_standard']);
		}
		if(isset($historique['reply_content'])){
			unset($historique['reply_content']);
		}
		if(isset($historique['ticket_closed'])){
			unset($historique['ticket_closed']);
		}
		if(isset($historique['hidebuttons'])){
			unset($historique['hidebuttons']);
		}
		if(isset($historique['dateclosed'])){
			unset($historique['dateclosed']);
		}
		if(isset($historique['url_links'])){
			unset($historique['url_links']);
		}
		if(isset($historique['url_commentaires'])){
			unset($historique['url_commentaires']);
		}
		if(isset($historique[$this->tabs])){
			unset($historique[$this->tabs]);
		}
		if(isset($historique['ticket_private_lbl'])){
			unset($historique['ticket_private_lbl']);
		}
		
		if(is_array($historique)){
			foreach($historique as $id=>$value){
				$action=$this->message_historique[$id];
				if($id=='cat_id'){
					$value=$this->getCat_Label($value);
					$avant[$id]=$this->getCat_Label($avant[$id]);
				}
				if($id=='state_id'){
					$value=$this->getEtat_Label($value);
					$avant[$id]=$this->getEtat_Label($avant[$id]);
				}
				if($id=='ticket_assigned_to'){
					$value=$this->getUser_Label($value);
					$avant[$id]=$this->getUser_Label($avant[$id]);
				}
				if($id=='ticket_assigned_by'){
					$value=$this->getUser_Label($value);
					$avant[$id]=$this->getUser_Label($avant[$id]);
				}
				
				$add_historique=array(
					'ticket_id' 	=> $avant['ticket_id'],
					'creator_id'	=> $this->account_id,
					'reply_content' => NULL,
					'actions' 		=> $action,
					'old_value'		=> $avant[$id],
					'new_value' 	=> $value,
					'creation_date' => time(),
				);
				$this->so_reponses->data=$add_historique;
				$this->so_reponses->save();
			}
		}
		return true;
	}
	
	function calcul_temps($temps,$unit,$base=null){
	/**
	* Arrondit le temps passé en argument (au nombre supérieur)
	*
	* @param time $temps
	* @param int $base
	* @return time
	*/
		if($base == null){
			switch($unit){
				case 0:
					return (ceil($temps/$this->obj_config['initial_time_minute']))*$this->obj_config['initial_time_minute'];
				case 1:
					return (ceil($temps/1))*1;
				case 2:
					// return (ceil($temps/1))*1;
					return $temps;
			}
			
		}else{
			return (ceil($temps/$base))*$base;
		}
	}
	
	function add_update_checklist($content){
	/**
	 * Met a jour la base avec les valeurs de checklist coché par l'utilisateur
	 */
		if(!empty($content['checklist']) && !empty($content['ticket_id'])){
			$checklists = $this->get_checklist($content['client_id'],$content['cat_id']);
			
			// Parcours de la checklist pour retrouver les éléments décocher
			foreach(array_keys($checklists) as $checklist){
				// Si non coché
				if(!in_array($checklist,explode(',',$content['checklist']))){
					$existe = $this->so_spid_checklist->search(array('ticket_id' => $content['ticket_id'], 'chk_id' => $checklist));
					if(is_array($existe)){
						// Association ticket/check existante => Suppression + historisation
						$this->so_spid_checklist->delete(array('ticket_id' => $content['ticket_id'], 'chk_id' => $checklist));
						
						$add_historique=array(
							'ticket_id' 	=> $content['ticket_id'],
							'creator_id'	=> $this->account_id,
							'reply_content' => NULL,
							'actions' 		=> lang('Checklist').' : '.$checklists[$checklist],
							'old_value'		=> lang('Checked'),
							'new_value' 	=> lang('Unchecked'),
							'creation_date' => time(),
						);
						$this->so_reponses->data=$add_historique;
						$this->so_reponses->save();
					}
				}
			}
			
			// Parcours et ajout des éléments checkés
			foreach(explode(',',$content['checklist']) as $chk_id){
				$check = array(
					'ticket_id' => $content['ticket_id'],
					'chk_id' => $chk_id,
				);
				$existe = $this->so_spid_checklist->search($check);
				if(!is_array($existe)){
					// Association ticket/check inexistante => Création + historisation
					$this->so_spid_checklist->save($check);
					
					$add_historique=array(
						'ticket_id' 	=> $content['ticket_id'],
						'creator_id'	=> $this->account_id,
						'reply_content' => NULL,
						'actions' 		=> lang('Checklist').' : '.$checklists[$chk_id],
						'old_value'		=> lang('Unchecked'),
						'new_value' 	=> lang('Checked'),
						'creation_date' => time(),
					);
					$this->so_reponses->data=$add_historique;
					$this->so_reponses->save();
				}
			}
		}
	}
	
	function add_update_ticket($content=null,&$ticket_id=null){
	/**
	* Routine permettant de créer/modifier (si le client existe déjà) le ticket $content['ticket_id'] (il sera crée sinon)
	*
	* Retourne un message de confirmation ou d'erreur
	*
	* @param array $content=NULL
	* @return string
	*/
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spid']);
			unset($content['msg']);
			unset($content['messages|details|update|meeting|checklist|links|url|history']);
			unset($content['link_to']);
			unset($content['hidenotes']);
			unset($content['hideline']);
			unset($content['facture_str']);
			
			$this->add_update_checklist($content);
			unset($content['checklist']);
			
			if(isset($content['ticket_id'])){
				unset($content['ticket_lid']);
				unset($content['state']);
				if(!empty($content['transition']) && $content['transition'] != $content['state_id']){
					$content['state_id'] = $content['transition'];
					
					// Spirea-YLF - 17/07/2012 - Rouverture du ticket (si changement d'etat et passage dans un etat non fermable)
					// Ne fait rien si deja ouvert ou passage dans un autre etat fermable
					$etat = $this->so_etats->read($content['state_id']);
					$content['ticket_closed'] = $content['ticket_closed']==1 ? $etat['state_close'] : $content['ticket_closed'];
				}
				unset($content['transition']);
			}
			if(!isset($content['closed_date']) || $content['closed_date']==0){
				$content['closed_date']=$content['ticket_closed']==1 ? time() : 0;
			}
			$this->data = $content;
			if(isset($this->data['ticket_id'])){
				$this->data['change_date']=time();
				
				$client = $this->so_client->search(array('client_id'=>$this->data['client_id']),false);
				// Spirea-YLF - Modif client/demandeur
				$this->data['ticket_assigned_by'] = $this->addressbook2user_id($content['ticket_assigned_by_contact']);
				$this->data['account_id'] = $client[0]['account_id'];
				$this->data['client_id'] = $client[0]['client_id'];

				// YLF - Booléen pour creation auto
				$old = $this->get_info($content['ticket_id']);
				$closing = false;
				if(!$old['ticket_closed'] && $content['ticket_closed']){
					$closing = true;
				}
				
				$retour_historique=$this->historique($content);
				$this->update($this->data,true);

				// YLF - Création automatique d'un nouveau ticket si fermeture et state_auto_id existant
				$state = $this->so_etats->read($content['state_id']);
				if(!empty($state['state_auto_id']) && $closing){
					$new_ticket = $content;
					$new_ticket['ticket_id'] = '';
					$new_ticket['state_id'] = $state['state_auto_id'];
					$new_ticket['ticket_spend_time'] = 0;
					$new_ticket['due_date'] = time()+86400*$this->obj_config['deadline_rule'];
					$new_ticket['ticket_closed'] = 0;
					$new_ticket['closed_date'] = '';
					$new_ticket['creation_date'] = time();
					$new_ticket['creator_id'] = $this->account_id;

					$this->data = $new_ticket;
					$this->save();

					$this->data = $content;
				}

				$msg='Ticket updated';
			}else{
				$client = $this->so_client->search(array('client_id'=>$this->data['client_id']),false);
				
				// Spirea-YLF - Modif client/demandeur
				$this->data['ticket_assigned_by'] = $this->addressbook2user_id($content['ticket_assigned_by_contact']);
				$this->data['client_id'] = $client[0]['client_id'];
				
				$this->data['ticket_num_group']=$this->get_ticket_num_group($content['client_id']);
				if(!isset($content['creation_date'])){
						$this->data['creation_date']=time();
				}
				$this->data['creator_id']=$this->account_id;
				$this->data['ticket_priority']=empty($this->data['ticket_priority']) ? $this->obj_config['default_state_id'] : $this->data['ticket_priority'];
				$this->data['state_id']=empty($this->data['state_id']) ? 5 : $this->data['state_id'];
				$this->data['due_date']=empty($this->data['due_date']) ? time()+86400 : $this->data['due_date'];
				$this->data['ticket_spend_time']=empty($this->data['ticket_spend_time']) ? 0 : $this->data['ticket_spend_time'];
				$this->data['ticket_unit_time'] = empty($this->data['ticket_unit_time']) ? 0 : $this->data['ticket_unit_time'];
				$this->save();

				$ticket_id = $this->data['ticket_id'];
				
				$add_historique=array(
					'ticket_id' 	=> $this->data['ticket_id'],
					'creator_id'	=> $this->account_id,
					'reply_content' => NULL,
					'actions' 		=> $this->message_historique['creation_date'],
					'old_value'		=> '',
					'new_value' 	=> date('d/m/Y H:i',time()),
					'creation_date' => time(),
				);
				$this->so_reponses->data=$add_historique;
				$this->so_reponses->save();
				$msg='Ticket created';
			}
			if(!empty($this->data['reply_content'])){
				$add_reply_table=array(
					'ticket_id' 	=> $this->data['ticket_id'],
					'creator_id'	=> $this->account_id,
					'reply_content' => $this->data['reply_content'],
					'actions' 		=> 'reponses',
					'old_value'		=> NULL,
					'new_value' 	=> NULL,
					'creation_date' => time(),
				);
				$this->so_reponses->data=$add_reply_table;
				$this->so_reponses->save();
			}
			
		}
		return $msg;
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
	
	function addressbook2user_id($addressbook_id){
	/**
	 * Retourne l'identifiant de l'addressbook de l'utilisateur ayant l'identifiant $user_id
	 *
	 * @param $user_id int : identifiant de l'utilisateur (table accounts)
	 * @return int : identifiant dans l'addressbook
	 */
		$contacts = new so_sql('phpgwapi', 'egw_addressbook');
		$contact = $contacts->read($addressbook_id);
		return $contact['account_id'];
	}
	
	function envoi_mail($envoi_mail){
	/**
	* Envoie un mail dont les paramètres ont passés dans le tableau en argument. Le mail est envoyé par l'utilisateur courant
	* aux personnes ayant créé le ticket et à la personne à qui est déléguée le ticket. Les champs du mail sont remplies avec des valeurs par défaut.
	*
	* $envoi_mail doit contenir :
	*
	* \li state_id -> Identifiant de l'état du ticket
	*
	* \li account_id -> Identifiant de la personne à qui est le ticket
	*
	* \li ticket_id -> Identifiant du ticket
	*
	* \li ticket_assigned_by -> Identifiant de la personne ayant délégué le ticket
	*
	* \li ticket_assigned_to -> Identifiant de la personne à qui on a délégué le ticket
	*
	* \li ticket_num_group -> Identifiant du groupe possédant le ticket
	*
	* \li ticket_title -> Titre du ticket
	*
	* \li ticket_priority -> Priorité du ticket
	*
	* \li client_company -> Entreprise ayant crée le ticket
	*
	* \li account_lid -> Identifiant de la personne à qui est le ticket
	*
	* \li due_date -> Date de fermeture du ticket
	*
	* \li ticket_spend_time -> Temps passé sur le ticket
	*
	* NOTE : retourne toujours true ...
	*
	* \version BBO - 29/06/2010 - On relance les fonction d'envoi de mail, pour envoyer séparément un mail au manager s'il l'adresse est renseignée
	*
	* @param array $envoi_mail
	* @return bool
	*/
		if(!is_object($this->obj_notifications)){ 	$this->obj_notifications = CreateObject('notifications.notifications'); }
		$etat = $this->so_etats->read($envoi_mail['state_id']);
		$messages = $this->so_reponses->search(array('ticket_id'=>$envoi_mail['ticket_id'],'actions'=>'reponses'),false,'creation_date');
		$first_message = count($messages)==1 ? true : false;
		$account=  $this->obj_accounts->read($envoi_mail['ticket_assigned_by']);
		// $sender=$this->obj_config;		
		// $receivers=array($envoi_mail['ticket_assigned_to'],$envoi_mail['ticket_assigned_by']);
		
		// Envoi du mail à l'intervenant et/ou au client final en fonction de la config
		// $contacts = new so_sql('phpgwapi', 'egw_addressbook');

		// Utilisateur courant en copie
		$receivers_copy[$GLOBALS['egw_info']['user']['account_email']] = $GLOBALS['egw_info']['user']['account_email'];

		// Client final
		$contact =  $GLOBALS['egw']->contacts->read($envoi_mail['ticket_assigned_by_contact']);
		if(!$this->obj_config['final_mail']){	
			$receivers[$contact['email']] = $contact['email'];
		}
		
		// Intervenant 
		$intervenant = $GLOBALS['egw']->accounts->read($envoi_mail['ticket_assigned_to']);
		if(!$this->obj_config['intervenant_mail']){
			$receivers[$intervenant['account_email']] = $intervenant['account_email'];
		}
		// Fin destinataires
		
		// Récupération des infos du client...
		$info_client = $this->so_client->read(array('client_id'=>$envoi_mail['client_id']));


		if(!$this->obj_config['client_manager_mail']){
			// Email au manager interne du client 
			$account = $GLOBALS['egw']->accounts->read($info_client['client_manager_id']);
			$receivers_copy[$account['account_email']] = $account['account_email'];
		}

		// Manager de l'application SPID (en copie caché)
		if(!empty($this->obj_config['ticket_management_user'])){
			$manager = $GLOBALS['egw']->accounts->read($this->obj_config['ticket_management_user']);
			if(!in_array($manager['account_email'], $receivers) && !in_array($manager['account_email'], $receivers_copy)){
				$receivers_hidden[$manager['account_email']] = $manager['account_email'];
			}
		}


		// On retire des destinataires les personnes en copie
		$receivers = array_diff($receivers, $receivers_copy);
		/*- **************************** -*/
		
		$contexte="";
		if(empty($envoi_mail['change_date']) && empty($envoi_mail['closed_date'])){
			$contexte="CREATE";
		}
		if(!empty($envoi_mail['change_date']) && empty($envoi_mail['closed_date'])){
			$contexte="MAJ";
		}
		if(!empty($envoi_mail['change_date']) && !empty($envoi_mail['closed_date'])){
			$contexte="CLOSE";
		}
		$subject="[".lang('Ticket')." ".$info_client['client_company']." #".$envoi_mail['ticket_num_group']."]".lang($contexte).": ".$envoi_mail['ticket_title'];
		$message =lang('Ticket')." #".$envoi_mail['ticket_num_group']."<br />";
		// $message.=lang('Object').": ".$envoi_mail['ticket_title']."<br />";
		$message.=lang('Priority').": ".$this->sel_priority[$envoi_mail['ticket_priority']]."<br />";
		$message.=lang('Open by').": ".$contact['n_given'].' '.$contact['n_family']."<br />";
		$message.=lang('Client').": ".$info_client['client_company']."<br />";
		$message.=lang('Due date').": ".date('d/m/Y',$envoi_mail['due_date'])."<br />";
		
		// Unité de temps du ticket
		switch($envoi_mail['ticket_unit_time']){
			case 0: // minutes
				$unit = lang('min');
				break;
			case 1: // heures
				$unit = lang('h');
				break;
			case 2: // jours
				$unit = lang('d');
				break;
		}
		
		$message.=lang('Spend time').": ".$envoi_mail['ticket_spend_time']." ".$unit."<br />";
		$message.="<br />";
		$message.=lang('State').": ".$etat['state_name']." - <i>".$etat['state_description']."</i><br />";
		$message.="<br />";
		
		// Checklist
		$checklist = $this->get_checklist($envoi_mail['client_id'],$envoi_mail['cat_id']);
		if(is_array($checklist) and !empty($checklist)){
			$message .= lang('Checklist').": "."<br />";
			foreach($checklist as $check_id => $check){
				$checked = $this->so_spid_checklist->search(array('ticket_id' => $envoi_mail['ticket_id'], 'chk_id' => $check_id),false);
				$valid = is_array($checked) ? lang('OK') : lang('NOK');
				$message .= $valid."   ".$check."<br />";
			}
		}
	
		$message.="<br />";
		if(!$first_message){
			$addressbook = new so_sql('phpgwapi','egw_addressbook');
			$contact = $addressbook->search(array('account_id' => $messages[(count($messages)-1)]['creator_id']),false);
			unset($addressbook);
			
			$message.="<br />";
			$contact_name = !empty($contact[0]['n_fn']) ? $contact[0]['n_fn'] : $GLOBALS['egw']->accounts->id2name($messages[(count($messages)-1)]['creator_id']);
			$message.=lang('Last note added on').' '.date('d/m/Y',$messages[(count($messages)-1)]['creation_date']).' '.lang('at').' '.date('H:i',$messages[(count($messages)-1)]['creation_date']).' '.lang('By').' '.$contact_name." :<br />".$messages[(count($messages)-1)]['reply_content']."<br />";
			$message.="<br />";
		}
		$message.="<hr>".lang('Original details').":<br />";
		$message.=$messages[0]['reply_content']."<br />";
		
		// Boucle sur les appels (si l'utilisateur a les droits dans l'appli spitel)
		$obj_acl = CreateObject('phpgwapi.acl');
		$allowedApps = array_keys($obj_acl->get_user_applications());
		if(in_array('spitel',$allowedApps)){
			// récupération des appels du ticket en cours
			$appels = $this->so_appel->search(array('ticket_id'=>$envoi_mail['ticket_id']),false);
			if(is_array($appels)){
				$message.="<hr>".lang('Calls').":<br />";
				// Boucle sur les appels
				foreach($appels as $appel){
					$addressbook_bo = new addressbook_bo();
					$message .= $appel['appel_id'];
					// Nom et tel de l'utilisateur interne
					$message .= empty($appel['account_id_interne']) ? $appel['tel_interne'] : " - ".$GLOBALS['egw']->accounts->id2name($appel['account_id_interne']).' ('.$appel['tel_interne'].')';
					$message .= $appel['sens'] ? ' -> ' : ' <- ';
					// Nom et tel de l'utilisateur externe
					$message .= empty($appel['contact_id_externe']) ? $appel['tel_externe'] : $addressbook_bo->fullname($addressbook_bo->read($appel['contact_id_externe'])).' ('.$appel['tel_externe'].')';
					$message .= empty($appel['date']) ? '' : " - ".date('d/m/Y h:i',$appel['date']);
					// Conversion de la duree sous une forme 00H00min00s (les unites inutilisé ne sont pas affiché)
					if($appel['duree']!=0){
						$temps=($appel['duree']%60)."s";
						
						if(($appel['duree']/60)>=1){
							$temps=(($appel['duree']/60)%60)."min".$temps;
							if(($appel['duree']/3600)>=1){
								$temps=(($appel['duree']/3600)%24)."H".$temps;
							}
						}
					}else{
						$temps = 0;
					}
					$message .= " - ".$temps;
					// $message .= empty($appel['description']) ? '' : " - ".$appel['description'];
					$message .= "<br />";
				}
			}
		}
		
		// Boucle sur les rendez-vous
		if(is_array($envoi_mail['rdv'])){
			$message.="<hr>".lang('Meetings').":<br />";
			foreach($envoi_mail['rdv'] as $rdv){
				$message .= $rdv['cal_id'];
				$message .= empty($rdv['participants']) ? '' : " - ".$rdv['participants'];
				$message .= empty($rdv['start']) ? '' : " - ".date('d/m/Y h:i',$rdv['start']);
				$message .= empty($rdv['end']) ? '' : " - ".date('d/m/Y h:i',$rdv['end']);
				$message .= empty($rdv['title']) ? '' : " - ".$rdv['title'];
				$message .= empty($rdv['description']) ? '' : " - ".$rdv['description'];
				$message .= "<br />";
			}
		}

		// Lien vers le ticket
		$protocole = 'https';
		if(empty($_SERVER['HTTPS']))
			$protocole = 'http';
		$url = $protocole.'://'.$GLOBALS['egw_info']['server']['hostname'].'/index.php?menuaction=spid.spid_ui.edit&id='.$envoi_mail['ticket_id'];
		$message .= '<hr>'.lang('Link to the ticket').' : <a href="'.$url.'">'.lang('Access to ticket').'</a>';

		// Formattage du message
		$bound_text = 'spirea';
		$bound = 	"--".$bound_text."\n";
		$contenu_message .= 	"If you can see this MIME than your client doesn't accept MIME types!\n"
			.$bound;
		 
		$contenu_message .= 	"Content-Type: text/html; charset=\"ISO-8859-1\"\n"
			."Content-Transfer-Encoding: 8bit\n\n"
			.utf8_decode($message)."\n"
			.$bound;

		// Entete mail
		$headers = 	"From: ".$GLOBALS['egw_info']['user']['account_email']."\n";
		if(!empty($receivers_copy))
			$headers .= "Cc: ".implode(',',$receivers_copy)."\n";

		if(!empty($receivers_hidden))
			$headers .= "Bcc: ".implode(',',$receivers_hidden)."\n";
		
		$headers .= "MIME-Version: 1.0\n"
			."Content-Type: multipart/mixed; boundary=\"$bound_text\"\n";
		
		// _debug_array($headers);
		// _debug_array($contenu_message);
		if(mail(implode(',',$receivers), '=?utf-8?B?'.base64_encode($subject).'?=', $contenu_message, $headers)){
			$msg = lang('Notification sent successfully');
		}else{
			$msg = lang('Notification failed');
		}

		/******************************* DEPRECIE -- 20/06/13 ********************************/
		/** Modification pour faire un envoie de mail plutot que de passer par notification **/
		
		// // Spirea YLF - 27/12/11 - Si receivers n'est pas vide alors on effectue la notification
		// if(!empty($receivers)){
		// 	$this->obj_notifications->set_sender($this->account_id);
		// 	$this->obj_notifications->set_receivers($receivers);
		// 	$this->obj_notifications->set_subject($subject);
		// 	$this->obj_notifications->set_message($message);
		// 	$this->obj_notifications->add_link(lang('Access to ticket'),array('menuaction'=>'spid.spid_ui.edit','id'=>$envoi_mail['ticket_id']),false);
		// 	$this->obj_notifications->send();
		// }
		
		// // Si l'option de désactivation n'est pas activée, et si le mail du manager est renseignée..
		// if(!$this->obj_config['client_manager_mail'] and !empty($info_client['client_manager_email'])){
		// 		// _debug_array($info_client['client_manager_email']);
		// 		// exit;
		// 	$receivers=array($info_client['client_manager_email']);
		// 	$this->obj_notifications->set_sender($this->account_id);
		// 	$this->obj_notifications->set_receivers($receivers);
		// 	$this->obj_notifications->set_subject($subject);
		// 	$this->obj_notifications->set_message($message);
		// 	$this->obj_notifications->send();
		// }
		
		return true;
	}
	
	function get_ticket_num_group($group=''){
	/**
	* Compte le nombre de tickets existants pour le groupe désigné
	*
	* @param int $group=''
	* @return int
	*/
		$search=parent::search(array('client_id' => $group),false);
		return empty($search) ? 1 : (int)count($search)+1;
	}
	
	function verification_ticket($ticket_id){
	/**
	* Vérifie que le client actuel fait partie du groupe de gestion de la catégorie du ticket $id
	*
	* @param int $ ticket_id
	* @return bool
	*/
		$client_groups=$this->client_groups();
		$ticket=$this->read($ticket_id);
		$cle_groupe=key($client_groups);
			
		if(count($client_groups)==1 && $cle_groupe!=$ticket['account_id']){
			if($this->verification_categorieGestionnaire($ticket['cat_id'],$client_groups)){
				return true;
			}
			return false;
		}else{
			return true;
		}
	}
	
	function verification_ticket_cat_groupe($ticket_id,$ticket_client_id,$ticket_cat_id){
	/**
	* Vérifie que le client actuel fait partie du groupe de gestion de la catégorie du ticket $id
	*
	* @param int $ ticket_id
	* @return bool
	*/
	echo "ticket : ".  $ticket_id;
	echo "client : ". $ticket_client_id;
	echo "cat : ". $ticket_cat_id;
	
	
		$client_groups=$this->client_groups();
		// $ticket=$this->read($ticket_id);
		$cle_groupe=key($client_groups);
			
			_debug_array($client_groups);
			_debug_array($cle_groupe);
			
		if(count($client_groups)==1 && $cle_groupe!=$ticket_client_id){
			if($this->verification_categorieGestionnaire($ticket_cat_id,$client_groups)){
				return true;
			}
			return false;
		}
		
		
	}
	
	
	function verification_categorieGestionnaire($cat_id,$client_groups){
	/**
	* Vérifie que le groupe de client $client_groups est gestionnaire de la catégorie $cat_id
	*
	* @param int $cat_id
	* @param int $client_groups
	* @return bool
	*/
		$groupeGestionCategorie=$this->groupeGestionCategorie($client_groups);
		if(in_array($cat_id,$groupeGestionCategorie)){
			return true;
		}
		return false;
	}
	
	function groupeClients(){
	/**
	* Retourne le groupe de clients de l'utilisateur actuel (tableau à 2 dimensions avec en index l'identifiant du groupe/le compte du client et en valeur leur nom)
	*
	* @return array
	*/
		$client_groups=$this->client_groups();
		$nb_client_groups=count($client_groups);
		$Client=$this->so_client->search('','account_id');
		$groupeClients=array();
		
		if($nb_client_groups==1){
			//Il faut aussi ajouter les users du groupe gestionnaire....
			$client_groups[$this->obj_config['ticket_management_group']]='';
			foreach($client_groups as $id=>$value){
				$account=$this->obj_accounts->members($id);
				natcasesort($account);
				$id_account=array_keys($account);
				foreach($id_account as $_value){
					$read_account=$this->obj_accounts->read($_value);
					if(($read_account['account_expires']==-1 && $read_account['account_status']=='A')|| ($read_account['account_expires']>time())){
					
						$groupeClients[$value['account_id']][$read_account['account_id']]=$read_account['account_fullname'];
					}
				}
			}	
		}else{
			foreach($Client as $id=>$value){
				$account=$this->obj_accounts->members($value['account_id']);
				natcasesort($account);
				$id_account=array_keys($account);
				foreach($id_account as $_value){
					$read_account=$this->obj_accounts->read($_value);
					// if($read_account['account_expires']==-1 && $read_account['account_expires']<time() && $read_account['account_status']=='A'){
					if(($read_account['account_expires']==-1 && $read_account['account_status']=='A')|| ($read_account['account_expires']>time())){
						// $groupeClients[$value['account_id']][$read_account['account_id']]=$read_account['account_lid'];
						$groupeClients[$value['account_id']][$read_account['account_id']]=$read_account['account_firstname'].' '.$read_account['account_lastname'];
					}
				}
			}
		}
		ksort($groupeClients);
		// _debug_array($groupeClients);
		return $groupeClients;
	}

	function link_title($entry){
	/**
	* Retourne le titre d'un traqueur d'identifiant $entry
	*
	* Appelé comme hook pour contribuer au lien
	*
	 * @param array $entry contenant ticket_id et ticket_title
	 * @return string
	*/
		if (!is_array($entry))
		{
			$entry = $this->read($entry);
		}
		if (!$entry)
		{
			return $entry;
		}
		return '#-'.$entry['ticket_id'].': '.$entry['ticket_title'];
	}

	function link_titles($ids){
	/**
	* Retourne les titres d'un traqueur d'identifiant $ids (tableau de tickets ayant en index ticket_id, et le champ ticket_title)
	*
	* Le tableau de retour contient en index l'identifiant du ticket et en valeur le titre
	*
	* Appelé comme hook pour contribuer au lien
	*
	* @param array $ids
	* @return array
	*/
		$titles = array();
		if (($tickets = parent::search(array('ticket_id' => $ids),'ticket_id,ticket_title')))
		{
			foreach($tickets as $ticket)
			{
				$titles[$ticket['ticket_id']] = $this->link_title($ticket);
			}
		}
		// we assume all not returned tickets are not readable by the user, as we notify egw_link about each deleted ticket
		foreach($ids as $id)
		{
			if (!isset($titles[$id])) $titles[$id] = false;
		}
		return $titles;
	}

	function link_query( $pattern ){
	/**
	* Demande au traqueur les tickets correspondant au filtre $pattern (on recherche uniquement les tickets ouverts).
	* $_GET['id'] peur être renseigné pour filtrer les résultats sur l'identifiant du ticket
	* Retourne un tableau avec en index l'identifiant et en valeur le titre du ticket
	*
	* Appelé comme hook pour contribuer au lien
	*
	* \version BBO - 17/06/2010 - MAJ de la fonction pour la recherche de ticket + ajout du filtre qui renvoi uniquement les tickets du clients !!
	*
	* @param array $pattern
	* @return array
	*/
		$result = array();
		$criteria=$this->construct_search($pattern);
		// $ticket_id=$_GET['id'];
		// $info_ticket=$this->read($ticket_id);
		
		// Spirea-YLF - Filtrage des tickets (uniquement les ouverts et seulement ceux des groupes de l'utilisateur si non managers) 
		$GLOBALS['egw_info']['user']['SpidLevel'] = $this->isTechnicianOrManagerOrCustomer();
		$client_groups = $this->client_groups();
		$flag_account = true;
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50 && in_array(-$this->obj_config['ticket_management_group'],array_keys($client_groups))){
			$flag_account = false;
		}
		$join = 'WHERE ticket_closed = 0';
		if($flag_account){
			$join .= ' AND account_id IN ('.implode(',',array_keys($client_groups)).')';
		}
		
		foreach((array) parent::search($criteria,false,'ticket_id ASC','','%',false,'OR',false,'',$join) as $item )
		{
			if ($item) $result[$item['ticket_id']] = $this->link_title($item);
		}
		return $result;
	}
	
	function run_update(){
	/**
	* Enregistrement des hooks
	*/
		// register all hooks
		ExecMethod('phpgwapi.hooks.register_hooks','tracker');

		if ($this->pending_close_days > 0)
		{
			self::set_async_job(false);	// switching it off, to remove the old botracker method
			self::set_async_job(true);
		}
	}

	function search_link($location){
	/**
	* Recherche un lien entre les hooks
	*
	* @param array $location
	* @return array
	*/
		$this->run_update();

		return spid_hooks::search_link($location);
	}
	
	function get_all_demandeur(){
	/**
	 * Retourne la liste de tout les demandeurs
	 *
	 */
		$client_groups = $this->client_groups(null,$this->var_technicienCategorie);
		$retour = array();
		foreach($client_groups as $client_id => $client_name){
			$retour += $this->get_demandeur($client_id);
		}
		
		asort($retour);
		return $retour;
	}
	
	function get_demandeur($client_id){
	/**
	 * Retourne la liste des demandeurs pour le client ayant l'identifiant $client_id
	 *
	 * @param $client_id int : identifiant du client a traiter
	 * @return array
	 */
		$retour = array();
		$liens = new so_sql('phpgwapi', 'egw_links');
		$links1 = $liens->search(array('link_app1' => 'spiclient','link_id1' => $client_id, 'link_app2' => 'addressbook'),false);
		$links2 = $liens->search(array('link_app2' => 'spiclient','link_id2' => $client_id, 'link_app1' => 'addressbook'),false);
		$links = array_merge((array)$links1, (array)$links2);

		// Récupération des roles pour les personnes parties
		$so_role = new so_sql('spiclient','spiclient_roles');
		$roles = $so_role->search(array('role_contact_active' => '0'),false);
		foreach($roles as $role){
			$inactive_role[] = $role['role_label'];
		}

		// Deprecie (ne fonctionne pas si l'utilisateur n'a pas acces a l'addressbook)
		// $links = egw_link::get_links('spiclient',$client_id,'addressbook');
		foreach($links as $link_id => $link_info){
			$contacts = new so_sql('phpgwapi', 'egw_addressbook');
			
			if($link_info['link_app1'] == 'spiclient'){
				// Si le contact est actif pour ce client
				if(!in_array($link_info['link_remark'], $inactive_role)){
					$contact = $contacts->read($link_info['link_id2']);
					$retour[$link_info['link_id2']] = ucfirst(strtolower($contact['n_given'])).' '.strtoupper($contact['n_family']);
				}
			}else{
				// Si le contact est actif pour ce client
				if(!in_array($link_info['link_remark'], $inactive_role)){
					$contact = $contacts->read($link_info['link_id1']);
					$retour[$link_info['link_id1']] = ucfirst(strtolower($contact['n_given'])).' '.strtoupper($contact['n_family']);
				}
			}
		}
	
		asort($retour);
		return $retour;
	}
	
		
	function get_intervenant($start=null, $end=null){
	/**
	 * Renvoie la liste des intervenants (personnes ayant déjà eu au moins un ticket assigné)
	 *
	 * @return array
	 */
		$intervenant = array();
		$rows_intervenant = $this->so_tickets->search('','ticket_assigned_to');
		if(!empty($rows_intervenant)){
			foreach($rows_intervenant as $key => $data){
				$user = $this->obj_accounts->read($rows_intervenant[$key]['ticket_assigned_to']);
				if(!empty($user['account_status']) && !$this->obj_accounts->is_expired($user)){
					$nom_intervenant = $GLOBALS['egw']->accounts->id2name($rows_intervenant[$key]['ticket_assigned_to'],'account_fullname');
					if(!in_array($nom_intervenant,$intervenant)) $intervenant[$rows_intervenant[$key]['ticket_assigned_to']] = $nom_intervenant;
				}
			}
		asort($intervenant);
		}
		return $intervenant;
	}
	
	function groupeGestionCategorie($groupeUser){
	/**
	* Renvoie les catégories du groupe de gestion $groupeUser (contenant les groupes d'utilisateurs à examiner)
	*
	* NOTE : la condition de gauche est inutile ->(array_key_exists($data['cat_managementgroup'],$groupeUser) || in_array($data['cat_managementgroup'],$groupeUser))
	*
	* @param array $groupeUser
	* @return array
	*/
		$groupeGestionCategorie=array();
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
		
		foreach($categorie as $id=>$value){
			$data=unserialize($value['data']);

			if(array_key_exists($data['cat_managementgroup'],$groupeUser) || in_array($data['cat_managementgroup'],$groupeUser)){
				$groupeGestionCategorie[]=$value['id'];
			}
		}
		return $groupeGestionCategorie;
	}
	
	function add_url($ticket_id,$url_links,$url_commentaires){
	/**
	* Ajoute des URLs $url_links sur un ticket $ticket_id avec le commentaire $url_commentaires. Un vérification de l'existence préalable de l'URL pour ce ticket est faite
	*
	* NOTE : retour non homogene (string ou bool ?)
	*
	* @param array $ticket_id
	* @param array $url_links
	* @param array $url_commentaires
	* @return string
	*/
		if(!empty($url_links)){
			$rechercheSiExistant=$this->so_url->search(array('ticket_id'=>$ticket_id, 'url_links'=>$url_links));
			if(!is_array($rechercheSiExistant) || empty($rechercheSiExistant)){
				$this->so_url->data['ticket_id']=$ticket_id;
				$this->so_url->data['url_links']=$url_links;
				$this->so_url->data['url_commentaires']=$url_commentaires;
				$this->so_url->save();
				return 'Url created';
			}else{
				return 'Error : Url is already created for this one';
			}
		}
		return false;
	}
	
	
	function calculHeure($array,$nbDiffJour){
	/**
	 * Calcul le nombre d'heure travaillable entre 2 jours
	 *
	 * @param $array array : date_depart et date_reelle_retour
	 * @param $nbDiffJour int : nb jour entre les deux dates
	 * @return int
	 */
	 
	 // _debug_array($array);
		$nbHeures = 0;
		$debutJournee=28800; // 9h
		$finJournee=64800; // 19h
		$debutDemiJournee=46800; //15h
				
		$dateHeureDepart=date("H",$array['date_depart']);
		$dateMinuteDepart=date("i",$array['date_depart']);
		$timeDepart=($dateMinuteDepart*60)+($dateHeureDepart*3600);
		
		$dateHeureRetour=date("H",$array['date_reelle_retour']);
		$dateMinuteRetour=date("i",$array['date_reelle_retour']);
		$timeRetour=($dateMinuteRetour*60)+($dateHeureRetour*3600);
		if($nbDiffJour >= 1){
			$timeEndFirstDay = $array['date_depart'] + 64800 - $timeDepart;
			$timeFirstDay = ($this->calculHeure(array('date_depart'=>$array['date_depart'],'date_reelle_retour'=>$timeEndFirstDay),0) > 8) ? 8 : $this->calculHeure(array('date_depart'=>$array['date_depart'],'date_reelle_retour'=>$timeEndFirstDay),0);
			
			$timeStartLastDay = $array['date_reelle_retour'] + 28800 - $timeRetour;
			$timeLastDay = ($this->calculHeure(array('date_depart'=>$timeStartLastDay,'date_reelle_retour'=>$array['date_reelle_retour']),0) > 8) ? 8 : $this->calculHeure(array('date_depart'=>$timeStartLastDay,'date_reelle_retour'=>$array['date_reelle_retour']),0);
			
			$timeBetween = ($nbDiffJour >= 2) ? ($nbDiffJour - 1)*8 : 0;
			$nbHeures += $timeFirstDay + $timeBetween + $timeLastDay;
		}else{
			$nbHeures=(($array['date_reelle_retour']-$array['date_depart'])/3600);
			if(($timeDepart>=$debutJournee)&&($timeDepart<=$debutDemiJournee)&&($timeRetour>$debutDemiJournee)&&($timeRetour<$finJournee)){
				$nbHeures--;
			}
		}
		
		 // _debug_array($nbHeures);
		return $nbHeures;
	}
	
	function calculTranche($array,$nbDiffJour){
	/**
	 * Calcul le nombre de jour travaillé entre 2 date
	 *
	 * @param $array array : date_depart et date_reelle_retour
	 * @param $nbDiffJour int : nb jour entre les deux dates
	 * @return int
	 */
		$nbJours = 0;
		$dateHeureDepart=date("H",$array['date_depart']);
		$dateMinuteDepart=date("i",$array['date_depart']);
		$timeDepart=($dateMinuteDepart*60)+($dateHeureDepart*3600);
		
		$dateHeureRetour=date("H",$array['date_reelle_retour']);
		$dateMinuteRetour=date("i",$array['date_reelle_retour']);
		$timeRetour=($dateMinuteRetour*60)+($dateHeureRetour*3600);
		
		if($nbDiffJour == 0){
			$nbHeures = $this->calculHeure($array,$nbDiffJour);
			$nbJours = ($nbHeures >= 8) ? 1 : $nbHeures / 8;
		}else{
			$timeEndFirstDay = $array['date_depart'] + 64800 - $timeDepart;
			$timeFirstDay = ($this->calculHeure(array('date_depart'=>$array['date_depart'],'date_reelle_retour'=>$timeEndFirstDay),0) > 8) ? 1 : $this->calculTranche(array('date_depart'=>$array['date_depart'],'date_reelle_retour'=>$timeEndFirstDay),0);
			
			$timeStartLastDay = $array['date_reelle_retour'] + 28800 - $timeRetour;
			$timeLastDay = ($this->calculHeure(array('date_depart'=>$timeStartLastDay,'date_reelle_retour'=>$array['date_reelle_retour']),0) > 8) ? 1 : $this->calculTranche(array('date_depart'=>$timeStartLastDay,'date_reelle_retour'=>$array['date_reelle_retour']),0);
			
			$timeBetween = ($nbDiffJour >= 2) ? $nbDiffJour - 1 : 0;
			$nbJours += $timeFirstDay + $timeBetween + $timeLastDay;
		}
		return $nbJours;
	}
	
	function nbDiffJour($array){
	/**
	 *  Calcul le nombre de jour d'ecart entre 2 dates
	 */
		//Définition des date au format jour-mois-année
		$date1 = date("d-m-Y",$array['date_depart']);
		$date2 = date("d-m-Y",$array['date_reelle_retour']);
		//Extraction des données
		list($jour1, $mois1, $annee1) = explode('-', $date1); 
		list($jour2, $mois2, $annee2) = explode('-', $date2);
		//Calcul des timestamp
		$timestamp1 = mktime(0,0,0,$mois1,$jour1,$annee1); 
		$timestamp2 = mktime(0,0,0,$mois2,$jour2,$annee2); 
		$nbDiffJour=abs($timestamp2 - $timestamp1)/86400;
		
		return $nbDiffJour;
	}
	
	function format_int($array){
	/**
	 * Formate toutes les valeurs d'un tableau
	 */
		if(is_array($array)){
			foreach($array as $id => $value){
				$array[$id] = number_format($value, 2, '.', ' ');
			}
		}
		return $array;
	}
	
	function get_contrats($client_id=''){
	/**
	* Retourne la liste des contracts selon l'argument client éventuel
	*
	* Le tableau résultat contient en index l'identifiant des contrats du groupe de gestion ou assignées, et en valeurs leur nom.
	*
	* @param int $client_id = '' numéro de groupe du client
	* @return array
	*/
		$retour = array();
	
		$q_fields='client_id,client_parent';
		$client = $this->so_client->search(array('client_id'=>$client_id),$q_fields);
		
		foreach($client as $cli){
			$search = array($cli['client_id'],$cli['client_parent']);
			
			$contrat = $this->so_contrat->search(array('contract_client'=>$search),false,'contract_title');

			if(is_array($contrat)){
				foreach($contrat as $id => $value){
					$retour[$contrat[$id]['contract_id']] = $contrat[$id]['contract_title'];
				}
			}
		}

		return $retour;
	}
	
	function get_contrats_depreciee($account_id=''){
	/**
	* Retourne la liste des contracts selon l'argument client éventuel
	*
	* Le tableau résultat contient en index l'identifiant des contrats du groupe de gestion ou assignées, et en valeurs leur nom.
	*
	* @param int $account_id = '' numéro de groupe du client
	* @return array
	*/
		$retour = array();
		$client = $this->so_client->search(array('account_id'=>$account_id),false);
		$search = array($client[0]['client_id'],$client[0]['client_parent']);
		// $contrat = $this->so_contrat->search(array('contract_client'=>$client[0]['client_id']),false);
		$contrat = $this->so_contrat->search(array('contract_client'=>$search),false,'contract_title');
		
		if(is_array($contrat)){
			foreach($contrat as $id => $value){
				$retour[$contrat[$id]['contract_id']] = $contrat[$id]['contract_title'];
			}
		}
		return $retour;
	}
	
	
	function is_formation($cat_id){
	/**
	 * Retourne vrai si la categorie avec l'id $cat_id est une formation, faux sinon
	 * @return boolean
	 */
		$cats = new categories($this->account_id,'spid');
		$categorie = $cats->return_single($cat_id);
		$data=unserialize($categorie[0]['data']);
		return $data['cat_formation'];
	}

	function calculFinRDV($duration, $start){
	/**
	 * Retourne la date de fin d'un événement en fonction du la date de début et de la durée souhaité
	 * @return int
	 */
		$nbHeure = $duration / 60;
		$nbJour = $nbHeure / 8;
		if($nbJour <= 1){
			$retour = $start + $nbHeure * 3600;
		}else{
			$retour = $start + $nbJour * 24 * 3600;
			$heure = date('g',$retour);
			if(($heure <= 12)&&($heure >= 8)){
				$retour = $retour - 3600 * (6 + $heure);
			}
		}
		return $retour;
	}
	
	function getCalendar($month, $nb_month, $accounts){
	/**
	 * Retourne les informations concernant l'assistant de création de ticket (principalement utilisé pour le calendrier)
	 *
	 * @param $month timestamp du premier jour du mois par lequel on souhaite commencer
	 * @param $nb_month : nombre de mois  a traiter
	 * @return array
	 */

		// Initialisations
		if(!empty($month)){
			$premierMois = date('m',$month);
			$moisEnCours = 0;
			$annee = date('Y',$month);
		}else{
			$premierMois = date('m');
			$moisEnCours = 0;
			$annee = date('Y');
		}

		// On parcours les 6 mois a venir (mois en cours + 5 mois)
		for($m = 0; $m < $nb_month; ++$m){
			// Calcul du mois en cours
			if($moisEnCours == 0){
				$moisEnCours = $premierMois + $m;
			}else{
				++$moisEnCours;
			}
			// Fin de l'année on passe à l'année suivante et on ramène le mois à 1
			if(($moisEnCours) > 12){
				$moisEnCours -= 12;
				++$annee;
			}
			
			// Récupération de la liste des jours fériés de l'année en cours
			$bo_holiday = CreateObject('calendar.boholiday');
			$holiday = $bo_holiday->prepare_read_holidays($annee);
			$holidays = $bo_holiday->read_holiday();

			// Nombre de jour dans le mois en cours
			$nbJour = cal_days_in_month(CAL_GREGORIAN, $moisEnCours, $annee);
			// Nom du mois
			$info['cal'.$m][0]['month'] = lang(date('F', mktime(0 , 0, 0, $moisEnCours, 1, $annee))).' '.$annee;
			
			// Parcours des comptes utilisateurs
			$index = 2;
			foreach($accounts as $id => $data){
				$user = $this->obj_accounts->read($id);
				$info['cal'.$m][$index]['user'] = $user['account_fullname'];
				
				// Parcours des jours du mois en cours
				for($i = 1; $i <= $nbJour; $i++){
					// Calcul du timestamp du jour en cours
					$day = mktime(0 , 0, 0, $moisEnCours, $i, $annee);
					// Affiche le jour sous la forme (Mon 01)
					$info['cal'.$m][1][$i] = lang(date('D',$day)).' '.date('d',$day);
					$mois = strlen($moisEnCours) == 1 ? ' 0'.$moisEnCours : $moisEnCours;
					
					// Si le jour n'est pas férié
					if(!is_array($holidays[$annee.$mois.date('d',$day)])){
						// Si c'est ni un samedi ni un dimanche
						if(date('D',$day) != 'Sun' && date('D',$day) != 'Sat'){
							$value_matin =$day.'.1';
							$value_aprem = $day.'.2';
							// Verification qu'il n'y a pas de rendez-vous le matin
							// Création de la checkbox (disabled en cas de rendez-vous)
							// $cal = $this->so_calendar->search($day,$day+3600*12,$id);

							$overlapping_events =& $this->bo_calendar->search(array(
								'start' => $day,
								'end'   => $day+3600*12,
								'users' => array($id=>$id),
								'ignore_acl' => true,	// otherwise we get only events readable by the user
								'enum_groups' => true,	// otherwise group-events would not block time
							));

							if(empty($overlapping_events)){
								$info['cal'.$m][$index][$i] = '<input type="checkbox" name="option['.$id.'][]" value="'.$value_matin.'"><br />';
							}else{
								$info['cal'.$m][$index][$i] = '<input type="checkbox" name="option['.$id.'][]" value="'.$value_matin.'" disabled="disabled" ><br />';
							}
							// Verification qu'il n'y a pas de rendez-vous l'apres-midi
							// Création de la checkbox (disabled en cas de rendez-vous)
							// $cal = $this->so_calendar->search(1+$day+3600*12,$day+3600*18,$id);

							$overlapping_events =& $this->bo_calendar->search(array(
								'start' => 1+$day+3600*13,
								'end'   => $day+3600*18,
								'users' => array($id=>$id),
								'ignore_acl' => true,	// otherwise we get only events readable by the user
								'enum_groups' => true,	// otherwise group-events would not block time
							));

							if(empty($overlapping_events)){
								$info['cal'.$m][$index][$i] .= '<input type="checkbox" name="option['.$id.'][]" value="'.$value_aprem.'">';
							}else{
								$info['cal'.$m][$index][$i] .= '<input type="checkbox" name="option['.$id.'][]" value="'.$value_aprem.'" disabled="disabled">';
							}
						}
						
						// Si le jour est dans le passé (jour précédent du mois en cours) on supprime ces jours et on mets uniquement le libellé du jour (permet de garder une mise en page correct)
						if($moisEnCours == date('m')){
							if($i < date('d')){
								unset($info['cal'.$m][$index][$i]);
								$info['cal'.$m][1][$i] = lang(date('D',$day)).' '.date('d',$day);
							}
						}
					}
				}
				// On masque les jours entre la fin réel du mois et le 31 (cas des mois a 30 jours ou moins)
				if($nbJour < 31){
					for($k = $nbJour+1; $k <= 31; ++$k){
						$info['cal'.$m]['hide'.$k] = true;
					}
				}
				++$index;	
			}
		}
		
		return $info;
	}
	
	function traitementAssistant($content=null){
	/**
	 * Traite les données provenant de l'assistant afin de créer les différent tickets et rendez-vous
	 *
	 * $content array : informations concernant le ticket
	 * @return strings
	 */
		// Frequence de création des tickets (défaut ou vide = mois)
		$assistant_frequency = empty($this->obj_config['assistant_frequency']) ? 'm' : $this->obj_config['assistant_frequency'];
		
		$infoTicket = $content;
		unset($infoTicket['calendar']);
		unset($infoTicket['month']);
		unset($infoTicket['option']);
		unset($infoTicket['button']);
		for($i = 0; $i <= 31; ++$i){
			unset($infoTicket[$i]);
		}
		// $ticket_id = 0;
		// $msg = $this->add_update_ticket($infoTicket,$ticket_id);
		
		// Parcours des cases coché
		foreach($content['option'] as $idIntervenant => $values){
			$jourEntier = false;
			foreach($values as $key => $date){
				$date = explode('.',$date);
				if($date[1] == 1){
					if($values[$key+1] == $date[0].'.2'){
						// Jour entier (la valeur suivante represente l'apres midi)
						$event[date($assistant_frequency,$date[0])][] = array(
							'participant' => $idIntervenant,
							'start' => $date[0] + 9 * 3600,
							'end'	=> $date[0] + 18 * 3600,
							'title' => $this->account2name($content['account_id']).' - '.$content['ticket_title'],
							'category' => $content['cat_meeting'],
						);
						$event[date($assistant_frequency,$date[0])]['budget'] += 1;
						$jourEntier = true;
					}else{
						// Matin seulement
						$event[date($assistant_frequency,$date[0])][] = array(
							'participant' => $idIntervenant,
							'start' => $date[0] + 9 * 3600,
							'end'	=> $date[0] + 13 * 3600,
							'title' => $this->account2name($content['account_id']).' - '.$content['ticket_title'],
							'category' => $content['cat_meeting'],
						);
						$event[date($assistant_frequency,$date[0])]['budget'] += 0.5;
					}
				}else{
					if(!$jourEntier){
						// Apres midi seulement
						$event[date($assistant_frequency,$date[0])][] = array(
							'participant' => $idIntervenant,
							'start' => $date[0] + 14 * 3600,
							'end'	=> $date[0] + 18 * 3600,
							'title' => $this->account2name($content['account_id']).' - '.$content['ticket_title'],
							'category' => $content['cat_meeting'],
						);
						$event[date($assistant_frequency,$date[0])]['budget'] += 0.5;
					}
					$jourEntier = false;
				}
			}
		}

		// Pour chaque event on crée un ticket qui lui sera lié
		foreach($event as $key => $rdv){
			$ticket_id = 0;
			
			if($this->obj_config['budget'])	$infoTicket['ticket_budget'] = $rdv['budget'];
			unset($rdv['budget']);
			
			$msg = $this->add_update_ticket($infoTicket,$ticket_id);
			foreach($rdv as $keyRDV => $infoRDV){
				$infoEvent = $infoRDV;
				$infoEvent['title'] = '#'.$ticket_id.' - '.$infoRDV['title'];
				$infoEvent['ticket_id'] = $ticket_id;
				$this->save_event($infoEvent);
			}
		}
	}
	
	function save_event($info){
	/**
	 * Enregistre l'event avec les info disponible dans $info
	 */
		$event = array(
			'participants'=> array(
				$info['participant'] => 'A',
			),
			'participant_types'=>array(
				'u' => array(
					$info['participant'] => 'A',
				)
			),
			'owner' => $GLOBALS['egw_info']['user']['account_id'],
			'start' => $info['start'],
			'end' => $info['end'],
			'link_to' => array(
				'to_id' => '',
				'to_app' => 'calendar',
				'title' => '',
				'anz_links' => 0,
				'app' => 'spid',
				'query' => '',
				'file' => array(),
				'comment' => 0,
				'id' => '',
				'remark' => '',
				'button' => '',
			),
			'title' => $info['title'],
			'category' => $info['category'],
			'account_id' => $GLOBALS['egw_info']['user']['account_id'],
			'modified' => $_SERVER['REQUEST_TIME'],
			'modifier' => $GLOBALS['egw_info']['user']['account_id'],
		);
		$cal_id = $this->so_calendar->save($event,$recurrence);
		if($cal_id){
			$this->so_calendar->move($cal_id,$event['start'],$event['end']);
			egw_link::link('spid',$info['ticket_id'],'calendar',$cal_id);
			
			$rendez_vous = array(
				'ticket_id' => $info['ticket_id'],
				'account_id' => $info['participant'],
				'cal_id' => $cal_id,
				'creation_date' => $_SERVER['REQUEST_TIME'],
				'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
				
			);
			$this->so_rendez_vous->save($rendez_vous);
		}
	}
	
	function account2name($account_id){
	/**
	 * Retourne le nom du client ayant l'id $account_id
	 * @return string
	 */
		$client = $this->so_client->search(array('account_id'=>$account_id),false);
		return $client[0]['client_company'];
	} 

	function get_assigned_to(){
	/** 
	 * Liste des personnes assignables pour les tickets
	 *
	 * @return array
	 */
		$cats = $this->get_categorie();
		foreach($cats as $cat){
			if(isset($cat['cat_managementgroup']) && !empty($cat['cat_managementgroup'])){
				$cat_managementgroup=$this->obj_accounts->members($cat['cat_managementgroup'],true);
				foreach($cat_managementgroup as $cle=>$account_id){
					$retour[$account_id]=$this->obj_accounts->id2name($account_id,'account_fullname');
				}
			}
			$retour[$cat['cat_assignedto']]=$this->obj_accounts->id2name($cat['cat_assignedto'],'account_fullname');
		}

		return $retour;
	}

	function get_users(){
	/**
	 * Liste des utilisateurs sélectionnable pour le calendrier
	 *
	 * @return array
	 */
		// Recupération des utilisateurs du groupe manager
		// $group_management_value=$this->obj_accounts->read($this->obj_config['ticket_management_group']);
		// $group_management_value=$this->obj_accounts->read($GLOBALS['egw_info']['user']['account_primary_group']);
		// $accounts = $this->obj_accounts->members($group_management_value['account_lid']);
		$accounts = array();
		$groupeUser = array_keys($GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
		foreach($groupeUser as $group_id){
			$accounts += $this->obj_accounts->members($group_id);
		}
		
		// Tri les utilisateurs par ordre alphabétique
		natcasesort($accounts);
		return $accounts;
	}

	function get_site($level=true){
    /**
     * Retourne la liste des sites disponible pour l'utilisateur
     *
     *
     * @return array
     */
    	$site_ui = CreateObject('spireapi.site_ui');
    	$retour = $site_ui->get_all_sites($level,'spid');
    	
    	return $retour;
    }
}
?>