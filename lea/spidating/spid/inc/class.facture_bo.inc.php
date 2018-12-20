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
	
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.facture_so.inc.php');	
	
class facture_bo extends facture_so 
{
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
	
	var $account_id;
	var $app_title;
	
	var $type_ticket;
	
	var $actions;
	

	function __construct() {
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		/* Récupération des droits d'accès ACL */
		$acl =& CreateObject('spid.acl_spid');
		$this->grants=$acl->getACL();
		$this->grants['admin']=$this->is_admin($this->account_id);
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		$this->actions = array(
			'zip' => lang('Zip selected invoices'),
			'pdf' => lang('Print selected invoices'),
		);
		
		parent::__construct();
	}
		
	function facture_bo(){
		/**
		*Constructeur
		*/
		self::__construct();
	}

	function get_mode_reglement($id=''){
	/**
	 * Retourne la liste des mode de reglement
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_mode_reglement->search(array('mode_reglement_id'=>$id),false,'mode_reglement_label');
		foreach($info as $key => $data){
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
		foreach($info as $key => $data){
			$retour[$data['delai_id']] = $data['delai_label'];
		}
		return $retour;
	}
	
	function get_type_ticket(){
		/**
		* Constructeur retournant les indentifiants des types de tickets possibles en index et leur libellé en valeur
		*
		* @return array
		*/

		$type=$this->so_etats->search('',false);
		$types=array();
		if(!is_array($type)){
			$type=array();
		}
		foreach($type as $id=>$value){
			$types[$value['state_id']]=$value['label_traduction'];
		}
		return $types;
	}
	
	function get_payment_model(){
		/**
		* Méthode retournant le modèle des modes de paiement (sur 30,60,... jours)
		*
		* @return array
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

	function get_customer_billable(){
	/**
	* Obtention de la liste des clients à facturer (ou facturables) de l'utilisateur courant et la facture courante. Le tableau de retour contient en index
	*
	* \version BBO - 02/08/2010 - MAJ pour n'afficher que les clients du prestataires qui créer la nouvelle facture
	* \version TCH - 27/07/2012 - MAJ le passage à client_id
	* @return array
	*/

		$clientsAFacturer=array(); 
		$accounts=$this->obj_accounts->memberships($this->account_id,true);
		
		//tch - on passe par la fonction facture_client_groups
		// $ClientsDuUser=$this->so_client->search(array('account_id'=>$accounts),true,'client_company ASC');
		// $ClientsDuUser=$this->facture_client_groups();
		$clientsAFacturer=$this->facture_client_groups();
		
		// foreach($ClientsDuUser as $id=>$value)
		// {
		// 	$ClientsRelations=$this->so_clients_relations->search(array('societe_id'=>$id),false);
		// 	 // _debug_array($ClientsRelations);
		// 	if(is_array($ClientsRelations))
		// 	{
		// 		foreach($ClientsRelations as $cle=>$valeur)
		// 		{
		// 			$clients=$this->so_client->read(array('client_id'=>$valeur['client_id']),false);
		// 			if(!$clients['client_sleep']) $clientsAFacturer[$clients['client_id']]=$clients['client_company'];
		// 		}
		// 	}
		// }
		natcasesort($clientsAFacturer);
		// _debug_array($clientsAFacturer);
		return $clientsAFacturer;
	}
	
	
	
	function get_last_invoice(){
	/**
	 * Permet de récupérer le nom de la dernière facture par prestataire pour l'afficher sur l'écran de création
	 *
	 * Retourne un lien sur le numéro de dernière facture pour incrémenter de 1 et sélectionner le prestataire
	 *
	 * @return array
	 */
		$last_invoice = array();
	
		$fournisseurs = $this->get_providers();
		foreach($fournisseurs as $id => $value){
			$factures = $this->so_factures->search(array('societe_id'=>$id),'facture_number','facture_number DESC');
			$last_invoice[]['facture_number'] = $factures[0]['facture_number'];
			// $temp_next_invoice = preg_replace('/[^0-9]/Uis','', $factures[0]['facture_number'])+1;
			// problème lorsque la facture contient des _ (à éviter) 
			$last_digit = (int)strrpos($factures[0]['facture_number'],'_') +1 ;

			$temp_next_invoice = preg_replace('/[^0-9]/Uis','', substr($factures[0]['facture_number'],$last_digit))+1;
			$temp_last_invoice = preg_replace('/[^0-9]/Uis','', substr($factures[0]['facture_number'],$last_digit))+1-1;
			$temp_next_invoice =  str_replace($temp_last_invoice,$temp_next_invoice,$factures[0]['facture_number']);
			
			$last_invoice[sizeof($last_invoice)-1]['next_invoice'] = $temp_next_invoice;
			$last_invoice[sizeof($last_invoice)-1]['jsnext_invoice'] = 
				'<span onclick="set_invoice(\''.$temp_next_invoice.'\',\''.$id.'\');">'.$factures[0]['facture_number'].'</span>';
			$last_invoice[sizeof($last_invoice)-1]['provider'] = $value;
		
		}
		
		
		unset($i);
		unset($temp_next_invoice);
		unset($temp_last_invoice);
		unset($fournisseurs);
		
		return $last_invoice;
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
	
	function calcul_total_ht($client_id,$tab_ticket){
	/**
	* Calcule le total ht des tickets $tab_ticket facturables pour l'utilisateur (le compte) $client_id. Le total est calculé en fonction du prix initial du ticket, du temps passé, et du prix HT de l'heure
	*
	* @param int $client_id
	* @param array $tab_ticket en index l'identifiant du ticket
	* @return float
	*/
		$total=0;
		if(!is_array($tab_ticket)){
			$tab_ticket=array();
		}		
		if(!empty($tab_ticket)){
			foreach($tab_ticket as $id=>$value){
				$time = empty($value['ticket_time_bracket']) ? $value['ticket_spend_time'] : $value['ticket_time_bracket'];
				if(isset($value['ticket_nb_student']) && $value['ticket_price_student'] > 0){
					$total += $value['ticket_nb_student'] * $value['ticket_price_student'];
				}else{
					$etat_facturable=$this->so_etats->read($value['state_id']);
					if($etat_facturable['state_billable']==1){
						//Spirea YLF - 13/06/13 - Prix lié au contrat
						$prix_contrat = $this->so_prix_parametres->search(array('contract_id'=>empty($value['contract_id']) ? -1 : $value['contract_id'],'state_id'=>$value['state_id']),false);

						if(!empty($prix_contrat)){
							if($prix_contrat[0]['ticket_spend_time']==0){
								$total = $total+(float)$prix_contrat[0]['price_ht'];
							}else{
								$total = $total+(((int)$time*(float)$prix_contrat[0]['price_ht'])/((int)$prix_contrat[0]['ticket_spend_time']));
							}
						}else{
							//Spirea YLF - 05/05/2011 - Prise en compte du prix dans l'état
							$prix_etats = $this->so_etats->search(array('state_id'=>$value['state_id']),false);
							if($prix_etats[0]['state_price'] != 0){
								$total += $prix_etats[0]['state_price'];
							}else{
								$prix_parametre=$this->so_prix_parametres->search(array('client_id'=>$client_id,'state_id'=>$value['state_id']),false);
								if(!empty($prix_parametre)){
									if($prix_parametre[0]['ticket_spend_time']==0){
										$total=$total+(float)$prix_parametre[0]['price_ht'];
									}else{
										$total=$total+(((int)$time*(float)$prix_parametre[0]['price_ht'])/((int)$prix_parametre[0]['ticket_spend_time']));
									}
								}else{
									switch($value['ticket_unit_time']){
										case 0:
											$total=$total+(((int)$time*(float)$this->obj_config['initial_price_minute'])/((int)$this->obj_config['initial_time_minute']));
											break;
										case 1:
											$total=$total+(((int)$time*(float)$this->obj_config['initial_price_hour']));
											break;
										case 2:
											$total=$total+(($time*(float)$this->obj_config['initial_price_day']));
											break;
									}
								}
							}
						}
					}else{
						$total+=0;
					}
				}
			}
		}
		return (float)$total;
	}
	
	
	function get_info($id){
	/**
	* Retourne les informations au sujet de facture dont l'identifiant est passé en argument ($id) ; y compris sur les tickets et l'évaluation des lignes de facturation.
	*
	* Le tableau de retour contient comme index :
	*
	* \li ticket -> Nombre de tickets correspondant à la facture $id (array contenant les informations de la table des tickets)
	*
	* \li ticket_number -> Nombre de tickets correspondant à la facture $id (array contenant les informations de la table des tickets)
	*
	* \li total_time -> Temps passé sur les tickets
	*
	* \li total_ht -> Montant des tickets
	*
	* \li Autres champs de la table des clients
	*
	* NOTE : il doit y avoir un bug sur le champ ticket_id_assigned
	*
	* @param int $id
	* @return array
	*/
		$info = $this->search(array('facture_id'=>$id),false);
		$ticket_assigned_to_invoice=array();
		$ticket_assigned_to_invoice=$this->so_ticket->search(array('facture_id'=>$id),false);
		$client=$this->so_client->search(array('client_id'=>$info[0]['client_id']),'client_company,client_payment_model');
		$fournisseur=$this->so_client->search(array('client_id'=>$info[0]['societe_id']),false);
		$info[0]['ticket_id_assigned']=array();
		$total_time=0;
		$tab_ticket=array();
		$obj_ticket=& CreateObject('spid.spid_ui');
		if(!empty($ticket_assigned_to_invoice)){
			foreach($ticket_assigned_to_invoice as $cle=>$value){
				$etat=$this->so_etats->read($value['state_id']);
				$ticket_unit = $value['ticket_unit_time'];
				$ticket_spend_time = $value['ticket_spend_time'];
				// switch($this->obj_config['unit_time']){
				// 	case 0: // minutes
				// 		$ticket_spend_time = $value['ticket_spend_time'];
				// 		break;
				// 	case 1: // heures
				// 		$ticket_spend_time = $value['ticket_spend_time'];
				// 		break;
				// 	case 2: // jours
				// 		$ticket_spend_time = $value['ticket_spend_time'];
				// 		break;
				// }
				$info[0]['ticket_id_assigned'][]=$value['ticket_id'];
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$info[0]['client_id'],'state_id'=>$ticket_assigned_to_invoice[$cle]['state_id']),false);
				if($etat['state_billable']==1){
					if($param_etat[0]['ticket_spend_time'] == 0){
						$temps_ticket = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
						$temps = $this->convertir_temps($temps_ticket,$ticket_unit,$this->obj_config['unit_time']);
						$total_time=$total_time+$temps;
					}else{
						$temps_ticket = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat[0]['ticket_spend_time']);
						$temps = $this->convertir_temps($temps_ticket,$ticket_unit,$this->obj_config['unit_time']);
						$total_time=$total_time+$temps;
					}
				}
				$tab_ticket[$cle]=array();
				if($param_etat[0]['ticket_spend_time'] == 0){
					$tab_ticket[$cle] = $value;
					$tab_ticket[$cle]['ticket_spend_time']=$obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
				}else{
					$tab_ticket[$cle] = $value;
					$tab_ticket[$cle]['ticket_spend_time']=$obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat[0]['ticket_spend_time']);
				}
				
				$tab_ticket[$cle]['state_id']=$value['state_id'];
				$ticket_assigned_to_invoice[$cle]['state_name']=$etat['state_name'];
			}
			array_unshift($ticket_assigned_to_invoice,false);
			unset($ticket_assigned_to_invoice[0]);
		}else{
			$ticket_assigned_to_invoice=array();
		}

		$info[0] += $client[0];
		$info[0]['provider'] = $fournisseur[0]['client_id'];
		//Spirea YLF - 30/03/2011 - On récupère le code opération depuis la table client_relation
		$clientRelation = $this->so_clients_relations->search(array('societe_id'=>$info[0]['societe_id'],'client_id'=>$info[0]['client_id']),false);
		if(!empty($clientRelation)){
			$info[0]['client_operation_code'] = $clientRelation[0]['operation_code'];
			$info[0]['payment_model'] = empty($info[0]['payment_model']) ? $clientRelation[0]['payment_model'] : $info[0]['payment_model'];
		}
		
		$info[0]['ticket']=$ticket_assigned_to_invoice;
		
		//Spirea YLF - 06/05/2011 - rajout du prix du ticket
		foreach($ticket_assigned_to_invoice as $id => $value){

			$ticket_view = $this->so_factures_details->search(array('ticket_id'=>$ticket_assigned_to_invoice[$id]['ticket_id']),false);
			if(is_array($ticket_view)){
				$info[0]['ticket'][$id]['total_ht'] = $ticket_view[0]['total_ht'];
			}else{
				// $ticket[0] = $info[0]['ticket'][$id];
				// $ticket_spend_time = $ticket[0]['ticket_spend_time'];

				// $param_etat = $this->so_prix_parametres->search(array('client_id'=>$info[0]['client_id'],'state_id'=>$ticket[0]['state_id']),false);
				// $param_etat_contrat = $this->so_prix_parametres->search(array('client_id'=>empty($info[0]['contract_id']) ? -1 : $info[0]['contract_id'],'state_id'=>$ticket[0]['state_id']),false);
				// $ticket_unit = $value['ticket_unit_time'];

				// if($param_etat[0]['ticket_spend_time'] == 0 || $param_etat_contrat[0]['ticket_spend_time'] == 0){
				// 	$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
				// }else{
				// 	$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat[0]['ticket_spend_time']);
				// }

				// $info[0]['ticket'][$id]['total_ht'] = $this->calcul_total_ht($info[0]['client_id'],$ticket);


				// $info[0]['ticket'][$id]['contract_id'] = $info[0]['contract_id'];
				$ticket[0] = $info[0]['ticket'][$id];
				$ticket_spend_time = $ticket[0]['ticket_spend_time'];
				
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$info[0]['client_id'],'state_id'=>$ticket[0]['state_id']),false);
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>empty($info[0]['contract_id']) ? -1 : $info[0]['contract_id'],'state_id'=>$ticket[0]['state_id']),false);

				$ticket_unit = $value['ticket_unit_time'];
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
					}else{
						$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat_contrat[0]['ticket_spend_time']);
					}
				// Verif prix client
				}elseif($param_etat[0]['ticket_spend_time'] == 0){
					// Si le param etat est vide on passe ici aussi
					$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
				}else{
					$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat[0]['ticket_spend_time']);
				}
				
				$info[0]['ticket'][$id]['total_ht'] = $this->calcul_total_ht($info[0]['client_id'],$ticket);
				// $info[0]['ticket'][$id]['vat_id'] = $this->calcul_total_ht($info[0]['client_id'],$ticket);

				// _debug_array($info);
				
				$info[0]['ticket'][$id]['contract_id'] = $info[0]['contract_id'];
			}
		}
		$info[0]['ticket_number']=count($ticket_assigned_to_invoice);

		$info[0]['total_time']=$total_time;
		switch($this->obj_config['unit_time']){
			case 0:
				$info[0]['label_time']=' ('.lang('mn').')';
				break;
			case 1:
				$info[0]['label_time']=' ('.lang('h').')';
				break;
			case 2:
				$info[0]['label_time']=' ('.lang('d').')';
				break;
		}

		$info[0]['total_ticket_ht'] = $this->calcul_total_ht($info[0]['client_id'],$tab_ticket);
		$info[0]['total_custom_ht'] = $this->sum_line($info[0]['facture_id']);
		$total_ht = $info[0]['total_ticket_ht'] + $info[0]['total_custom_ht'];
		
		foreach($info[0]['ticket'] as $key => $value_ticket){
			$info[0]['ticket'][$key]['ticket_time_int'] = $info[0]['ticket'][$key]['ticket_spend_time'];
			switch($value_ticket['ticket_unit_time']){
				case 0:
					$info[0]['ticket'][$key]['ticket_spend_time'] .= ' '.lang('mn').'';
					break;
				case 1:
					$info[0]['ticket'][$key]['ticket_spend_time'] .= ' '.lang('h').'';
					break;
				case 2:
					$info[0]['ticket'][$key]['ticket_spend_time'] .= ' '.lang('d').'';
					break;
			}
			
				// TCH / calcul de la tranche / ticket_time_bracket pour affichage sur facture...
				
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$info[0]['client_id'],'state_id'=>$info[0]['ticket'][$key]['state_id']),false);
				// _debug_array($param_etat);
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>empty($info[0]['contract_id']) ? -1 : $info[0]['contract_id'],'state_id'=>$ticket[0]['state_id']),false);
				
				$temps_ticket = $info[0]['ticket'][$key]['ticket_time_int'];
				$unit_time = $info[0]['ticket'][$key]['ticket_unit_time'];
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						//$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
						$temps_passe = "forfait";
					}else{
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat_contrat[0]['ticket_spend_time']);
					}
				// Verif prix client
				}
				elseif($param_etat[0]['ticket_spend_time'] == 0){
					// Si le param etat est vide on passe ici aussi
					// $temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
					$temps_passe = "Forfait";
				}else{
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
				}
				if(empty($param_etat)){
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
				}
				
				$info[0]['ticket'][$key]['ticket_time_bracket']=$temps_passe;
				
				// fin TCH Calcul tranche
			
		}

		if($info[0]['total_ht']!=$total_ht){
			$info[0]['total_ht']=round($total_ht,2);
		}
		
		$info[0]['custom_line'] = $this->get_line($info[0]['facture_id']);
		array_unshift($info[0]['custom_line'],false);
		unset($info[0]['custom_line'][0]);
		
		// permet de ne pas afficher certaines informations si la facture n'est pas validée
		if($info[0]['validation_date'] == 0){
			unset($info[0]['validation_date']);
		}
		
		$info[0]['hide_validation'] = !empty($info[0]['send_date']);
		
		unset($obj_ticket);
		return $info[0];
	}
	
	function add_update_facture($content=null){
	/**
	* Routine permettant de créer/modifier (si le client existe déjà) la facture actuelle, à partir des arguments passés dans $content. $content doit contenir un champ account_id pour définir l'utilisateur à créer/mettre à jour (ajouter un champ validation_date pour le second cas)
	*
	* Retourne un message de confirmation ou d'erreur
	*
	* \version BBO - 03/08/2010 - MAJ de la fonction pour enregistrer l'id du prestataires du créé la nouvelle facture
	*
	* @param array $content=NULL
	* @return string
	*/
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spid']);
			unset($content['msg']);	
			$this->data = $content;
			if(isset($this->data['facture_id'])){
				if($this->data['total_ht']>=0){

				}
				$this->data['change_date'] = time();
				$this->data['modifier_id'] = $this->account_id;
				if((isset($content['validation_date']) && ($content['validation_date'] > 1000 ))){
					$add_facture_details=$this->add_facture_details($this->data);
					$this->data['nb_open_start'] = $this->nb_open_start($content['client_id'],$content['start_period_date']);
					$this->data['nb_open_during'] = $this->nb_open_during($content['client_id'],$content['start_period_date'],$content['end_period_date']);
					$this->data['nb_close_during'] = $this->nb_close_during($content['client_id'],$content['start_period_date'],$content['end_period_date']);
					$this->data['nb_open_end'] = $this->nb_open_end($content['client_id'],$content['start_period_date'],$content['end_period_date']);
					$maj_ticket_invoice = $this->maj_ticket_invoice($this->data['facture_id']);
				}
				
				
				
				$this->update($this->data,true);
				
				foreach($content['custom_line'] as $key => $detail_value){
					// Récupération du taux de tva
					$tva_bo = new vat_bo();
					$tva = $tva_bo->get_info($content['custom_line'][$key]['vat_id']);
					$content['custom_line'][$key]['vat_rate'] = $tva['vat_rate'];

					$data = $content['custom_line'][$key];

					$this->so_factures_details->update($data,true);
				}
				
				$msg=lang('Invoice updated');
			}else{
				// $client=$this->so_client->search(array('account_id'=>$this->data['account_id']),true);
				// $this->data['client_id']=$client[0]['client_id'];
				// acocunt_id n'est plus enregistré ? à contrôler...
				$client=$this->so_client->search(array('client_id'=>$this->data['client_id']),true);
				$this->data['account_id']=$client[0]['account_id'];

				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Invoice created';
			}
		}
		return $msg;
	}
	
	
	function add_facture_details($data){
	/**
	* Mets à jour la liste de ticket passé en argument ($data['ticket'])
	*
	* Les nouvelles valeurs doivent aussi être contenues dans le tableau $data (indexs : state_id,ticket_spend_time,ticket_id)
	*
	* Retourne true ou false selon que la facture a été modifiée avec succès ou non
	*
	* @param array $data
	* @return bool
	*/
		// _debug_array($data['ticket']);exit;
		if(!empty($data['ticket'])){
			$obj_ticket=& CreateObject('spid.spid_ui');
			foreach($data['ticket'] as $id=>$value){
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$data['client_id'],'state_id'=>$data['ticket'][$id]['state_id']),false);

				$join = 'WHERE client_id = ""';
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>$data['contract_id'],'state_id'=>$data['ticket'][$id]['state_id']),false,'','',$wildcard,false,$op,false,$col_filter,$join);

				$detail=array();
				$detail[0]['state_id']=$value['state_id'];
				$unit_time = $value['ticket_unit_time'];
				switch($this->obj_config['unit_time']){
					case 0: // minutes
						$temps_ticket = $value['ticket_time_int'];
						break;
					case 1: // heures
						$temps_ticket = $value['ticket_time_int'];
						break;
					case 2: // jours
						$temps_ticket = $value['ticket_time_int'];
						break;
				}

				// if($param_etat_contrat[0]['ticket_spend_time'] != 0){
				// 	$detail[0]= $value;
				// 	$detail[0]['ticket_spend_time']=$obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat_contrat[0]['ticket_spend_time']);
				// 	$temps_passe=$obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat_contrat[0]['ticket_spend_time']);
				// }else{
				// 	if($param_etat[0]['ticket_spend_time'] == 0){
				// 		$detail[0]= $value;
				// 		$detail[0]['ticket_spend_time']=$obj_ticket->calcul_temps($temps_ticket,$unit_time);
				// 		$temps_passe=$obj_ticket->calcul_temps($temps_ticket,$unit_time);
				// 	}else{
				// 		$detail[0]= $value;
				// 		$detail[0]['ticket_spend_time']=$obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
				// 		$temps_passe=$obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
				// 	}
				// }

				$detail[0]= $value;
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
					}else{
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat_contrat[0]['ticket_spend_time']);
					}
				// Verif prix client
				}elseif($param_etat[0]['ticket_spend_time'] == 0){
					// Si le param etat est vide on passe ici aussi
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
				}else{
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
				}

				$montant = $this->calcul_total_ht($data['client_id'],$detail);

				// Récupération du taux de tva
				$facture = $this->so_factures->read($this->data['facture_id']);
				$tva_bo = new vat_bo();
				$tva = $tva_bo->get_info($facture['facture_tva_id']);
// _debug_array($tva);
				$add_details = array(
					'facture_id'	=> $this->data['facture_id'],
					'quantity'		=> 1,
					'spend_time' 	=> $temps_passe,
					'total_ht'		=> $montant,
					'state_id'		=> $value['state_id'],
					'ticket_id'		=> $value['ticket_id'],
					// Ajout du taux et de l'id de TVA
					'vat_rate'		=> $tva['vat_rate'],
					'vat_id'		=> $tva['vat_id'],
				);
// _debug_array($add_details);
// exit;
				// Vérification de l'existence dans la table facture_details
				$check_facture_details = $this->so_factures_details->search(array('facture_id' => $this->data['facture_id'],'ticket_id'=> $value['ticket_id']),false);

				if(isset($check_facture_details[0]['detail_id'])){
					$add_details['detail_id'] = $check_facture_details[0]['detail_id'];
				}
				
				$this->so_factures_details->data=$add_details;
				$this->so_factures_details->save();
			}
			unset($obj_ticket);
		}

		return true;
	}
	
	function maj_ticket_invoice($id){
	/**
	* Mets à jour les tickets correspondant à la facture $id (et marque les tickets comme attribués à une facture)
	*
	* @param int $id
	*/
		$ticket=$this->so_ticket->search(array('facture_id'=>$id),'');
		if(!empty($ticket)){
			foreach($ticket as $id=>$value){
				$ticket[$id]['ticket_invoice']=1;
				$this->so_ticket->update($ticket[$id],true);
			}
		}
	}
	
	function facture_client_groups($year=null){
	/**
	* Récupère l'identifiant des clients (index du résultat), et y fait correspondre l'identifiant de l'entreprise dont il fait partie (valeur du résultat)
	*
	* @return array
	*/
	
		$spid_bo = CreateObject('spid.spid_bo');
		//$client_groups=$spid_bo->client_groups();

		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		$clientType = $spiclient_config['ClientType'];

		if(!$year){
			$client_groups=$spid_bo->client_groups('',$clientType);
		}else{
			$start_date = mktime(0,0,0,1,1,$year-1);
			$end_date = mktime(0,0,0,1,1,$year);
			
			// $join .= 'WHERE spid_factures.creation_date BETWEEN '.$start_date.' AND '.$end_date;  
			$join = 'WHERE client_id IN (SELECT client_id FROM spid_factures WHERE ((spid_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spid_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.')))';
			$client_groups = $spid_bo->client_groups($join,'',false);
		}

		 // if(count($client_groups)>1){
			 $client_groups = array( '' => lang('All') ) + $client_groups ;
		  // }
		  
		  
		// _debug_array($client_groups);
		return $client_groups;
	}
	
	function verification_facture($facture_id){
	/**
	* Vérifie l'existence d'une facture, indépendemment des ACL
	*
	* @param int $facture_id indentifiant de la facture à examiner
	* @return bool
	*/
		$groupesUser=$this->obj_accounts->memberships($this->account_id);
		$facture=$this->read($facture_id);
		$client=$this->so_client->read($facture['client_id']);
		if(array_key_exists($client['account_id'],$groupesUser)){
			return true;
		}elseif($this->grants['admin']){
			return true;
		}elseif($this->grants[EGW_ACL_CUSTOM_2]){
			return true;
		}else{
			return false;
		}
	}
	
	function convertir_temps($temps,$unit_source,$unit_dest){
	/**
	 * Convertit le temps $temps de l'unite $unit_source vers l'unite $unit_dest
	 * @return int
	 */
		switch($unit_source){
			case 0:
				
				if($unit_dest == 1){
					return $temps / 60;
				}elseif($unit_dest == 2){
					return $temps / 60 / 8;
				}else{
					return $temps;
				}
				break;
			case 1:
				if($unit_dest == 0){
					return $temps * 60;
				}elseif($unit_dest == 2){
					return $temps / 8;
				}else{
					return $temps;
				}
				break;
			case 2:
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
	
	function get_cat_facture(){
	/**
	 * retourne la liste des catégories de facture
	 * @return array
	 */
		$retour = array();
		$info = $this->so_facture_categories->search('',false,'cat_name ASC');
		if(is_array($info)){
			foreach($info as $id => $value){
				$retour[$value['cat_id']] = $value['cat_name'];
			}
		}
		return $retour;
	}
	
	function get_line($facture_id){
	/**
	 * Retourne les lignes personnalisés de la facture_id $facture_id
	 * @return array
	 */
		$retour = array();
		$info = array();
		$info = $this->so_factures_details->search(array('facture_id'=>$facture_id),false,'extra_rank ASC');
		foreach($info as $key => $data){
			if($data['extra_rank'] != null){
				$retour[] = $data;
			}
		}
		return $retour;
	}
	
	function add_line($content){
	/**
	 * Ajoute une ligne dans facture_details pour la facture en cours
	 *
	 * @return string
	 */
		$info = $this->so_factures_details->search(array('facture_id'=>$content['facture_id']),'extra_rank','extra_rank DESC');

		$tva_bo = new vat_bo();
		$tva = $tva_bo->get_info($this->obj_config['default_vat']);
		$taux = $tva['vat_rate'];


		if(empty($info)){
			$rank = 1;
		}else{
			$rank = $info[0]['extra_rank'] + 1;
		}
		$add_line = array(
			'facture_id'	=> $content['facture_id'],
			'quantity'		=> 1,
			'total_ht'		=> '0.00',
			'extra_ht'		=> '0.00',
			'extra_cat_id'  => 0,
			'extra_label'   => '',
			'extra_rank'	=> $rank,
			'vat_id'		=> $this->obj_config['default_vat'],
			'vat_rate'		=> $taux,
		);
		$this->so_factures_details->data = $add_line;
		$this->data['facture_id'] = $content['facture_id'];
		$this->so_factures_details->save();
	}
	
	function delete_line($id){
	/**
	 * Supprime la ligne ayant l'id $id dans la table facture_details
	 * Mets à jour les autre lignes (notamment le extra_rank)
	 */
		$line = $this->so_factures_details->search(array('detail_id'=>$id),false);
		$line_facture = $this->get_line($line[0]['facture_id']);
		foreach($line_facture as $key => $data){
			if($data['detail_id'] != $line[0]['detail_id']){
				if($data['extra_rank'] > $line[0]['extra_rank']){
					$line_facture[$key]['extra_rank'] -= 1;
					$this->so_factures_details->update($line_facture[$key],true);
				}
			}
		}
		$this->so_factures_details->delete($id);
	}
	
	function move_line($index,$facture_id,$sens){
	/**
	 * Fonction permettant de monter/descendre une ligne de facture dans la facture $facture_id
	 *
	 */
	 
	 // echo "index: ".$index;
	 // echo "sens: ".$sens;
	 
		// $actual_line =  $this->so_factures_details->search(array('facture_id'=>$facture_id,'extra_rank'=>$index),false);
		$actual_lines =  $this->so_factures_details->search(array('facture_id'=>$facture_id),false,'extra_rank');
		// _debug_array($actual_lines);
		$actual_line[0] = $actual_lines[$index-1];
		// echo"ligne";
		// _debug_array($actual_line);
		// echo"lignefin";
		
		if($sens == 'up'){
			if($index > 1){
				// $line_to_move = $this->so_factures_details->search(array('facture_id'=>$facture_id,'extra_rank'=>$index-1),false);
				$line_to_move[0] = $actual_lines[$index-2];
				$line_to_move[0]['extra_rank'] = $line_to_move[0]['extra_rank']+1;
				$actual_line[0]['extra_rank'] = $actual_line[0]['extra_rank'] - 1;
				// echo "indexup: ".$index;
				// echo "ligntomove";
				// _debug_array($line_to_move[0]);
				// echo "actualligne";
				// _debug_array($actual_line[0]);
				$this->so_factures_details->update($line_to_move[0],true);
				$this->so_factures_details->update($actual_line[0],true);
			}
		}else{
			// $line_to_move = $this->so_factures_details->search(array('facture_id'=>$facture_id,'extra_rank'=>$index+1),false);
			$line_to_move[0] = $actual_lines[$index+1];
				
			if(is_array($line_to_move)){
				$line_to_move[0]['extra_rank'] = $line_to_move[0]['extra_rank'] -1;
				$actual_line[0]['extra_rank'] = $actual_line[0]['extra_rank'] +1;
				
				// $line_to_move[0]['extra_rank'] = $index;
				// $actual_line[0]['extra_rank'] =  $actual_lines[$index+1];
				
				// _debug_array($line_to_move[0]);
				$this->so_factures_details->update($line_to_move[0],true);
				$this->so_factures_details->update($actual_line[0],true);
			}
		}
		// exit;
		
	}
	
	function sum_line($facture_id){
	/**
	 * Calcul la somme total des lignes ajoutés
	 * @return decimal
	 */
		$retour = 0;
		$lines = $this->get_line($facture_id);
		foreach($lines as $id => $data){
			$retour += $data['extra_ht'];
		}
		return $retour;
	}
	
	function export(){
	/**
	 * Champs de l'export csv
	 */
		$retour = array(
			'facture_id' => lang('ID'),
			'facture_number' => lang('Invoice number'),
			'provider' => lang('Provider'),
			'client_company' => lang('Client'),
			'client_code_tiers' => lang('Code tiers'),
			'client_operation_code' => lang('Operation code'),
			'creation_date_export' => lang('Creation date'),
			'send_date_export' => lang('Invoice date'),
			'total_ht' => lang('Total HT'),
			'ticket_number' => lang('Tickets number'),
			'invoice_send' => lang('Sent'),
			'payment_date_export' => lang('Payment date'),
			'payment_amount' => lang('Paid amount'),
			'payment_bank' => lang('Bank'),
			
		);
		return $retour;
	}

	function getTotalTicket($start, $end, $client, $provider){
	/**
	 * Retourne le temps passé sur les tickets fermées durant la période de $start a $end
	 *
	 * @param $start : date de debut
	 * @param $end : date de fin
	 * @param $client : identifiant du client
	 * @param $provider : identifiant du fournisseur
	 *
	 * @return string 
	 */
		$totalTime = 0;

		// Récupération des tickets fermés durant la période
		$join = 'WHERE client_id = '.$client['client_id'].' AND ticket_closed = 1 AND closed_date BETWEEN '.$start.' AND '.$end;
		$tickets = $this->so_ticket->search('',false,'','',$wildcard,false,$op,false,$col_filter,$join);

		// Calcul du temps (en min) passé sur les tickets
		foreach($tickets as $ticket){
			// Filtre uniquement sur le fournisseur (pas possible en SQL - champ multivalué)
			$cat = $GLOBALS['egw']->categories->read($ticket['cat_id']);
			$ticketProvider = $this->so_client->read(array('account_id' => $cat['data']['cat_managementgroup']));
			if(is_array($ticketProvider) && $ticketProvider['client_id'] == $provider['client_id']){
				// Conversion du temps en minute et ajout au total
				$time = $this->convertir_temps($ticket['ticket_spend_time'],$ticket['ticket_unit_time'],0);
				$totalTime += $time;
			}
		}

		$days 	 = (int)($totalTime/24/60);
		$hours 	 = (int)(($totalTime-($days*60*24))/60);
		$minutes = (int)($totalTime-($days*24*60)-($hours)*60);

		if($days > 0){
			$temp[] = $days.lang('d');
		}
		if($hours > 0){
			$temp[] = $hours.lang('h');
		}
		if($minutes > 0){
			$temp[] = $minutes.lang('m');
		}
 
		return empty($temp) ? '-' : implode('',$temp);
	}

	function getTotalAmount($start, $end, $client, $provider, $ticket){
	/**
	 * Retourne le montant des factures entre $start et $end pour le client $client
	 *
	 * @param $start : date de debut
	 * @param $end : date de fin
	 * @param $client : identifiant du client
	 * @param $provider : identifiant du fournisseur
	 * @param $ticket : true = uniquement les tickets // false = uniquement les ligne perso
	 * @return string 
	 */
		$totalAmount = 0;

		$operator = $ticket ? '<>' : '=';
		$label = $ticket ? 'total_ht' : 'extra_ht';

		// Récupération des tickets fermés durant la période
		$join = 'INNER JOIN spid_factures ON spid_factures.facture_id = spid_factures_details.facture_id WHERE spid_factures.send_date BETWEEN '.$start.' AND '.$end.' AND ticket_id '.$operator.' 0 AND client_id = '.$client['client_id'].' AND societe_id = '.$provider['client_id'];
		$factureDetails = $this->so_factures_details->search('','spid_factures_details.*','','',$wildcard,false,$op,false,$col_filter,$join);

		// Calcul du total
		foreach((array)$factureDetails as $factureDetail){
			$totalAmount += $factureDetail[$label];
		}

		return $totalAmount == 0 ? '-' : $totalAmount.' EUR HT';
	}

	function getCallTime($start, $end, $client, $provider, $in, $numberOnly=false){
	/**
	 * Retourne le temps passé sur les tickets fermées durant la période de $start a $end
	 *
	 * @param $start : date de debut
	 * @param $end : date de fin
	 * @param $client : identifiant du client
	 * @param $provider : identifiant du fournisseur
	 * @param $in : true = appels entrant(client -> fournisseur) // false = appels sortant (fournisseur -> client)
	 * @param $numberOnly : true = calcul du nombre d'appels // false = calcul du temps des appels
	 *
	 * @return string 
	 */
		$totalCall = 0;
		$so_call = new so_sql('spitel','spitel_appel');

		$join = 'WHERE date BETWEEN '.$start.' AND '.$end;
		$calls = $so_call->search(array('client_id' => $client['client_id']),false,'','',$wildcard,false,$op,false,array('sens' => $in ? '0' : '1'),$join);

		if(!$numberOnly){
			// Calcul du temps (en min) passé sur les appels
			foreach($calls as $call){			
				$totalCall += $call['duree'];
			}

			return $this->transforme($totalCall);
		}else{
			return count($calls) == 0 ? '-' : count($calls);
		}
	}

    function transforme($time){
	    if ($time>=86400){
		    /* 86400 = 3600*24 c'est à dire le nombre de secondes dans un seul jour ! donc là on vérifie si le nombre de secondes donné contient des jours ou pas */
		    // Si c'est le cas on commence nos calculs en incluant les jours

		    // on divise le nombre de seconde par 86400 (=3600*24)
		    // puis on utilise la fonction floor() pour arrondir au plus petit
		    $jour = floor($time/86400);
		    // On extrait le nombre de jours
		    $reste = $time%86400;

		    $heure = floor($reste/3600);
		    // puis le nombre d'heures
		    $reste = $reste%3600;

		    $minute = floor($reste/60);
		    // puis les minutes

		    $seconde = $reste%60;
		    // et le reste en secondes

		    // on rassemble les résultats en forme de date
		    $result = $jour.lang('d').$heure.lang('h').$minute.lang('m').$seconde.lang('s');
	    }elseif ($time < 86400 AND $time>=3600){
		    // si le nombre de secondes ne contient pas de jours mais contient des heures
		    // on refait la même opération sans calculer les jours
		    $heure = floor($time/3600);
		    $reste = $time%3600;

		    $minute = floor($reste/60);

		    $seconde = $reste%60;

		    $result = $heure.lang('h').$minute.lang('m').$seconde.lang('s');
	    }elseif ($time<3600 AND $time>=60){
		    // si le nombre de secondes ne contient pas d'heures mais contient des minutes
		    $minute = floor($time/60);
		    $seconde = $time%60;
		    $result = $minute.lang('m').$seconde.lang('s');
	    }elseif($time == 0){
	    	$result = '-';
	    }elseif ($time < 60){
		    // si le nombre de secondes ne contient aucune minutes
		    $result = $time.lang('s');
	    }
	    return $result;
    }
}	
?>
