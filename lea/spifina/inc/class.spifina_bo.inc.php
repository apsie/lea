<?php
/**	spifina : SpireaDemandes
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
	
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.spifina_so.inc.php');	
	
class spifina_bo extends spifina_so 
{
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
		/* Récupération des droits d'accès ACL */
		// $acl =& CreateObject('spifina.acl_spifina');
		// $this->grants=$acl->getACL();
		// $this->grants['admin']=$this->is_admin($GLOBALS['egw_info']['user']['account_id']);
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$GLOBALS['egw_info']['user']['account_id'],'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config = $config->read('spifina');
		
		$this->actions = array(
			'zip' => lang('Zip selected invoices'),
			'pdf' => lang('Print selected invoices')
		);
		if($this->is_admin()){
			$this->actions['send'] = lang('Mark invoices as mailed');
		}

		if($GLOBALS['egw_info']['user']['apps']['admin']){
			$this->actions['unvalidate'] = lang('Unvalidate selected invoices');
		}
		
		parent::__construct();
	}
		
	function spifina_bo(){
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
	
	function migre_spiclient_get_delai_paiement($id=''){
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
		$accounts=$this->obj_accounts->memberships($GLOBALS['egw_info']['user']['account_id'],true);
		
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
	
	
	
	function get_last_invoice($provider_id=false){
	/**
	 * Permet de récupérer le nom de la dernière facture par prestataire pour l'afficher sur l'écran de création
	 *
	 * Retourne un lien sur le numéro de dernière facture pour incrémenter de 1 et sélectionner le prestataire
	 *
	 * @return array
	 */
		$last_invoice = array();
		
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		$client_bo = CreateObject("spiclient.client_bo");

		$providers = $client_bo->get_all_clients($spiclient_config['ProviderType']);
	
		//$fournisseurs = $this->get_providers();
		foreach($providers as $id => $value){
			if(($id == $provider_id && $provider_id) || !$provider_id){
				$factures = $this->so_factures->search(array('societe_id'=>$id),'facture_number','facture_number DESC');
				$last_invoice[]['facture_number'] = $factures[0]['facture_number'];
				// $temp_next_invoice = preg_replace('/[^0-9]/Uis','', $factures[0]['facture_number'])+1;
				// problème lorsque la facture contient des _ (à éviter) 
				// _debug_array($factures);
				/* mise en commentaire : le 03/04/2014 par tch
			
				$last_digit = (int)strrpos($factures[0]['facture_number'],'_') +1 ;
				$temp_next_invoice = preg_replace('/[^0-9]/Uis','', substr($factures[0]['facture_number'],$last_digit))+1;
				$temp_last_invoice = preg_replace('/[^0-9]/Uis','', substr($factures[0]['facture_number'],$last_digit))+1-1;
				$temp_next_invoice =  str_replace($temp_last_invoice,$temp_next_invoice,$factures[0]['facture_number']);
				
				_debug_array($temp_last_invoice);
				_debug_array($temp_next_invoice);
				*/
				
				// finds the position of the first occurrence 
				// of a non-numeric character in a string.
	 			
	 			preg_match("/.*\D/is", $factures[0]['facture_number'], $match_list, PREG_OFFSET_CAPTURE);
				
				$dernier_increment = substr($factures[0]['facture_number'],strlen($match_list[0][0]));
				// echo $dernier_increment;
				
				$dernier_increment = sprintf("%02s", $dernier_increment+1);
				
				$temp_next_invoice = $match_list[0][0] . $dernier_increment;
				
				$last_invoice[sizeof($last_invoice)-1]['next_invoice'] = $temp_next_invoice;
				$last_invoice[sizeof($last_invoice)-1]['jsnext_invoice'] = 
					'<span onclick="set_invoice(\''.$temp_next_invoice.'\',\''.$id.'\');">'.$factures[0]['facture_number'].'</span>';
				$last_invoice[sizeof($last_invoice)-1]['provider'] = $value;
			}
		}
		
		unset($i);
		unset($temp_next_invoice);
		unset($temp_last_invoice);
		unset($providers);
		
		if($provider_id){
			return $last_invoice[0]['next_invoice'];
		}else{
			return $last_invoice;
		}
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
		if($GLOBALS['egw_info']['apps']['spid']){
			$ticket_assigned_to_invoice=$this->so_ticket->search(array('facture_id'=>$id),false);
		}

		$client=$this->so_client->search(array('client_id'=>$info[0]['client_id']),'client_company,client_payment_model');
		$fournisseur=$this->so_client->search(array('client_id'=>$info[0]['societe_id']),false);
		$info[0]['ticket_id_assigned']=array();
		$total_time=0;
		
		$tab_ticket=array();
		if($GLOBALS['egw_info']['user']['apps']['spid']){
		// if($GLOBALS['egw_info']['apps']['spid']){
			$obj_ticket = CreateObject('spid.spid_ui');
		}
		
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
		$info[0]['client_payment_model'] = $this->obj_config['default_delay'];

		// _debug_array($info);exit;
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
		
				$ticket[0] = $info[0]['ticket'][$id];
				$ticket_spend_time = $ticket[0]['ticket_spend_time'];
				
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$info[0]['client_id'],'state_id'=>$ticket[0]['state_id']),false);
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>empty($info[0]['contract_id']) ? -1 : $info[0]['contract_id'],'state_id'=>$ticket[0]['state_id']),false);
			
				// _debug_array($param_etat_contrat);
				$ticket_unit = $value['ticket_unit_time'];
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
						
					}else{
						
						// $ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat_contrat[0]['ticket_spend_time']);
						$ticket[0]['ticket_spend_time'] = $temps_passe = $this->convertir_temps( $ticket_spend_time,$ticket_unit,'0');
						$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket[0]['ticket_spend_time'],'0');
						// echo $ticket_spend_time.'<br>';
						// echo $ticket[0]['ticket_spend_time'].'<br>';
					}
				// Verif prix client
				}elseif($param_etat[0]['ticket_spend_time'] == 0){
					// Si le param etat est vide on passe ici aussi
					$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit);
				}else{
					
					$ticket[0]['ticket_spend_time'] = $obj_ticket->calcul_temps($ticket_spend_time,$ticket_unit,$param_etat[0]['ticket_spend_time']);
				}
				
				
				$info[0]['ticket'][$id]['total_ht'] = $this->calcul_total_ht($info[0]['client_id'],$ticket);
				
				// if($id==1){
				// _debug_array($ticket[0]['ticket_spend_time']);
				// _debug_array($ticket);
				// }
				
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
				
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>empty($info[0]['contract_id']) ? -1 : $info[0]['contract_id'],'state_id'=>$value_ticket['state_id']),false);
	
				$temps_ticket = $info[0]['ticket'][$key]['ticket_time_int'];
				// $unit_time = $info[0]['ticket'][$key]['ticket_unit_time'];
				$unit_time = $value_ticket['ticket_unit_time'];
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						//$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
						$temps_passe = "Forfait";
					}else{
						//convertir_temps($temps,$unit_source,$unit_dest){
						$temps_passe = $this->convertir_temps( $temps_ticket,$unit_time,'0');
						$temps_passe = $obj_ticket->calcul_temps($temps_passe,'0');
				
					}
				}
				
				if(empty($param_etat_contrat)){
					
					if($param_etat[0]['ticket_spend_time'] == 0){

						$temps_passe = "Forfait";
					}else{
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
					}
					if(empty($param_etat)){
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
					}
				}
				$info[0]['ticket'][$key]['ticket_time_bracket']=$temps_passe;
				// fin TCH Calcul tranche
			
		}
	
	
		$info[0]['total_ticket_ht'] = $this->calcul_total_ht($info[0]['client_id'],$info[0]['ticket']);
		$info[0]['total_custom_ht'] = $this->sum_line($info[0]['facture_id']);
		$total_ht = $info[0]['total_ticket_ht'] + $info[0]['total_custom_ht'];
		
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

	function get_quote($q_id){
	/**
	 * Pré-remplit les informations de la facture avec les informations d'un devis pour le transformer en facture
	 *
	 * @return array
	 */ 
		$spiquote_ui = CreateObject('spiquote.spiquote_ui');
		$q_data = $spiquote_ui->get_info($q_id);
		
		//_debug_array($q_data);
		// Obligatoire pour afficher toutes les informations
		$q_data['facture_id'] = -1;
		$q_data['facture_number'] = $this->get_last_invoice($q_data['provider_id']);

		$q2i = array(
			'q_category' => 'invoice_cat',
			'q_message' => 'invoice_message',
			'provider_id' => 'societe_id',
			'q_payment_model' => 'payment_delay',
			'q_vat' => 'facture_tva',
			'q_vat_id' => 'facture_tva_id',
			'invoice_bank_account' => 'invoice_bank_account',
			'lines' => 'custom_line',
		);

		$qd2id = array(
			'line_id' => 'extra_id',
			'q_id' => 'facture_id',
			'line_rank' => 'extra_rank',
			'line_cat' => 'extra_cat_id',
			'line_ref' => 'extra_ref',
			'line_label' => 'extra_label',
			'line_quantity' => 'quantity',
			// 'line_unit_price' => '',
			'line_total_ht' => 'extra_ht',
		);

		foreach($q2i as $q_label => $i_label){
			$q_data[$i_label] = $q_data[$q_label];
			unset($q_data[$q_label]);
		}
	
		foreach($q_data['custom_line'] as $q_line_id => $q_line){
			if(is_numeric($q_line_id)){
				foreach($qd2id as $qd_label => $id_label){
					$q_data['custom_line'][$q_line_id][$id_label] = $q_data['custom_line'][$q_line_id][$qd_label];
					unset($q_data['custom_line'][$q_line_id][$qd_label]);
				}
				$q_data['custom_line'][$q_line_id]['vat_id'] = $q_data['facture_tva_id'];
				$q_data['custom_line'][$q_line_id]['facture_id'] = '';
				$q_data['custom_line'][$q_line_id]['extra_id'] = '';
			}else{
				unset($q_data['custom_line'][$q_line_id]);
			}
		}
		$q_data['custom_line'] = array_combine(range(1, count($q_data['custom_line'])), array_values($q_data['custom_line']));

		//_debug_array($q_data);

		return $q_data;
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
	// _debug_array($content);exit;
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spifina']);
			unset($content['msg']);	

			if($content['facture_id'] == -1) unset($content['facture_id']);

			$this->data = $content;
			if(isset($this->data['facture_id'])){
				if($this->data['total_ht']>=0){

				}
				$this->data['change_date'] = time();
				$this->data['modifier_id'] = $GLOBALS['egw_info']['user']['account_id'];
				if((isset($content['validation_date']) && ($content['validation_date'] > 1000 ))){
					$add_facture_details=$this->add_facture_details($this->data);

					if($GLOBALS['egw_info']['apps']['spid']){
						$this->data['nb_open_start'] = $this->nb_open_start($content['client_id'],$content['start_period_date']);
						$this->data['nb_open_during'] = $this->nb_open_during($content['client_id'],$content['start_period_date'],$content['end_period_date']);
						$this->data['nb_close_during'] = $this->nb_close_during($content['client_id'],$content['start_period_date'],$content['end_period_date']);
						$this->data['nb_open_end'] = $this->nb_open_end($content['client_id'],$content['start_period_date'],$content['end_period_date']);
						$maj_ticket_invoice = $this->maj_ticket_invoice($this->data['facture_id']);
					}
				}

				if(!empty($this->data['send_date']) && empty($this->data['invoice_due_date'])){
					$delai = $this->so_delai_paiement->read($this->data['payment_delay']);

					$this->data['invoice_due_date'] = $this->data['send_date'] + $delai['delai_days'] * 86400;
				}
				
				$this->update($this->data,true);
				
				$msg=lang('Invoice updated');
			}else{
				if($this->obj_config['contract_creation']){
					if(empty($content['client_id']) && empty($content['societe_id'])){
						$contract = $this->so_contrat->read($content['contract_id']);
						$this->data['client_id'] = $contract['contract_client'];
						$this->data['societe_id'] = $contract['contract_supplier'];
					}
				}
				
				// $client=$this->so_client->search(array('account_id'=>$this->data['account_id']),true);
				// $this->data['client_id']=$client[0]['client_id'];
				// acocunt_id n'est plus enregistré ? à contrôler...
				$client=$this->so_client->search(array('client_id'=>$this->data['client_id']),true);
				$this->data['account_id']=$client[0]['account_id'];

				$this->data['creation_date']=time();
				$this->data['creator_id']=$GLOBALS['egw_info']['user']['account_id'];
				$this->save();
				$msg='Invoice created';
			}

			foreach($content['custom_line'] as $key => $detail_value){
				if(is_numeric($key)){
					// Récupération du taux de tva
					// $tva_bo = new vat_bo();
					// $tva = $tva_bo->get_info($content['custom_line'][$key]['vat_id']);

					$tva = $this->so_vat->read($content['custom_line'][$key]['vat_id']);
					$content['custom_line'][$key]['vat_rate'] = $tva['vat_rate'];

					$this->so_factures_details->data = $content['custom_line'][$key];
					if(empty($this->so_factures_details->data['facture_id'])) $this->so_factures_details->data['facture_id'] = $this->data['facture_id'];
					
					$this->so_factures_details->save();
					// $this->so_factures_details->update($data,true);
				}
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
		if(!empty($data['ticket']) AND $GLOBALS['egw_info']['apps']['spid']){		
			$obj_ticket=& CreateObject('spid.spid_ui');
			foreach($data['ticket'] as $id=>$value){
				$param_etat = $this->so_prix_parametres->search(array('client_id'=>$value['client_id'],'state_id'=>$value['state_id']),false);

				$join = 'WHERE client_id = ""';
				$param_etat_contrat = $this->so_prix_parametres->search(array('contract_id'=>$value['contract_id'],'state_id'=>$value['state_id']),false,'','',$wildcard,false,'AND',false,$col_filter,$join);

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
	
	function facture_client_groups($year=null, $first=true){
	/**
	* Récupère l'identifiant des clients (index du résultat), et y fait correspondre l'identifiant de l'entreprise dont il fait partie (valeur du résultat)
	*
	* @return array
	*/
		$clients = array();

		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		
		
		$clientType = explode(',',$spiclient_config['ClientType']);
		$ProspectType = explode(',',$spiclient_config['ProspectType']);
		$types_filtres= array_merge($clientType,$ProspectType);
		
		
		$recherche = array('client_sleep' => $active_only ? '0' : '', 'client_type' => $types_filtres);
		$order = 'GROUP BY client_company ORDER BY client_company ASC';

		if($year){
			$start_date = mktime(0,0,0,1,1,$year-1);
			$end_date = mktime(0,0,0,1,1,$year);
			$join = 'WHERE client_id IN (SELECT client_id FROM spifina_factures WHERE ((spifina_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spifina_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.')))';
		}

		if(!$this->is_admin()){
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
			
		}
		
		// $this->so_client->debug = 5;
		
		$temp_clients = $this->so_client->search($recherche,'','client_company ASC','',$wildcard,false,'AND',false,$query['col_filter'],$join);
		
		foreach($temp_clients as $temp_client){
				$clients[$temp_client['client_id']]=$temp_client['client_company'];
		}
		natcasesort($clients);
		
		if($first){
			$client_groups = array( '' => lang('All') ) + $clients;
			}else{
			$client_groups = $clients;
		}

		return $client_groups;
	}
	
	function verification_facture($facture_id){
	/**
	* Vérifie l'existence d'une facture, indépendemment des ACL
	*
	* @param int $facture_id indentifiant de la facture à examiner
	* @return bool
	*/
		$groupesUser=$this->obj_accounts->memberships($GLOBALS['egw_info']['user']['account_id']);
		$facture=$this->read($facture_id);
	
		$clientsUser = $this->facture_client_groups();
		if(array_key_exists($facture['client_id'],$clientsUser) || $this->is_admin()){
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
	
	function zzz_migre_spireapi_get_cat_facture(){
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

		if(!empty($retour)){
			if($this->obj_config['hide_ns'])
				$retour['hide_ns'] = $this->obj_config['hide_ns'];
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
				$this->so_factures_details->update($line_to_move[0],true);
				$this->so_factures_details->update($actual_line[0],true);
			}
		}else{
			// $line_to_move = $this->so_factures_details->search(array('facture_id'=>$facture_id,'extra_rank'=>$index+1),false);
			$line_to_move[0] = $actual_lines[$index+1];
				
			if(is_array($line_to_move)){
				$line_to_move[0]['extra_rank'] = $line_to_move[0]['extra_rank'] -1;
				$actual_line[0]['extra_rank'] = $actual_line[0]['extra_rank'] +1;
				// _debug_array($line_to_move[0]);
				$this->so_factures_details->update($line_to_move[0],true);
				$this->so_factures_details->update($actual_line[0],true);
			}
		}
	}
	
	function sum_line($facture_id){
	/**
	 * Calcul la somme total des lignes ajoutés
	 * @return decimal
	 */
		$retour = 0;
		$lines = $this->get_line($facture_id);

		foreach($lines as $id => $data){
			if(is_numeric($id))
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
			'invoice_cat' => lang('Category'),
			'contract_id' => lang('Contract'),
			
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
			$ligneFacture = $this->so_factures_details->search(array('ticket_id' => $ticket['ticket_id']), false);

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
		$join = 'INNER JOIN spifina_factures ON spifina_factures.facture_id = spifina_factures_details.facture_id WHERE spifina_factures.send_date BETWEEN '.$start.' AND '.$end.' AND ticket_id '.$operator.' 0 AND client_id = '.$client['client_id'].' AND societe_id = '.$provider['client_id'];
		$factureDetails = $this->so_factures_details->search('','spifina_factures_details.*','','',$wildcard,false,$op,false,$col_filter,$join);

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

    function get_contract($client_id='', $provider_id=''){
    /**
     * Liste les contracts entre le client et le fournisseur
     *
     * @param $client_id : identifiant du client
     * @param $provider_id : identifiant du fournisseur
     *
     * @return array
     */
    	$return = array();
    	
		if(!$this->is_admin()){
			$clients =$this->facture_client_groups(null, false);
			$q['col_filter']['contract_client'] = array_keys($clients);
		}
		
    	// Contrats sur lesquels le fournisseur est prestataire direct
		//$this->so_contrat->debug = 5;
		
    	$contracts = $this->so_contrat->search(array('contract_supplier' => $provider_id, 'contract_client' => $client_id),false,$order,'',$wildcard,false,'AND',false,$q['col_filter'],$join);
    	foreach ($contracts as $contract) {
    		$return[$contract['contract_id']] = $contract['contract_title'];
    	}
    	// Contrats sur lesquels le fournisseur est co-prestataire
    	$contracts = $this->so_contrat->search(array('contract_cosupplier' => $provider_id, 'contract_client' => $client_id),false,$order,'',$wildcard,false,'AND',false,$q['col_filter'],$join);
    	foreach ($contracts as $contract) {
    		$return[$contract['contract_id']] = $contract['contract_title'];
    	}
    	asort($return);
    	return $return;
    }

    function get_contract_used($client_id){
    /**
     * Liste les contracts entre le client et le fournisseur
     *
     * @param $client_id : identifiant du client
     *
     * @return array
     */
    	$return = array();
    	
    	$join = 'INNER JOIN spifina_factures ON spifina_factures.contract_id = spiclient_contrats.contract_id';
    	$contracts = $this->so_contrat->search(array('contract_client' => $client_id),false,'','','%',false,'OR',false,'',$join);
    	foreach ($contracts as $contract) {
    		$return[$contract['contract_id']] = $contract['contract_title'];
    	}

    	asort($return);
    	return $return;
    }

    function migre_spiclient_get_bank_account($provider_id){
    /**
     * Retourne les comptes en banque disponible pour la société
     *
     * @param $provider_id : identifiant du provider de la facture
     * @return array
     */
    	$return = array();
    	$client = $this->so_client->read($provider_id);
    	// Compte numero 1
    	if(!empty($client['client_iban'])){
    		$return[''] = $client['client_iban'].' '.$client['client_bank'];
    	}
    	// Compte numero 2
    	if(!empty($client['client_iban_two'])){
    		$return['_two'] = $client['client_iban_two'].' '.$client['client_bank_two'];
    	}

    	// Si aucun compte n'existe pour le provider
    	if(empty($return)){
    		$return[] = lang('No bank account for current provider');
    	}
    	return $return;
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
		return '#-'.$entry['facture_id'].': '.$entry['facture_title'];
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
		if (($tickets = parent::search(array('facture_id' => $ids),'facture_id,facture_title')))
		{
			foreach($tickets as $ticket)
			{
				$titles[$ticket['facture_id']] = $this->link_title($ticket);
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
		
		foreach((array) parent::search($criteria,false,'facture_id ASC','','%',false,'OR',false,'',$join) as $item )
		{
			if ($item) $result[$item['facture_id']] = $this->link_title($item);
		}
		return $result;
	}
	
	
	function export_collect(){
	/**
	 * Champs de l'export csv
	 */
		$retour = array(
			'facture_number' => lang('Invoice number'),
			'contract_id' => lang('Contract'),
			'client_id' => lang('Client'),
			'send_date' => lang('Invoice date'),
			'payment_date' => lang('Payment date'),
			'total_ht' => lang('Total HT'),
			'total_tva' => lang('Total TVA'),
			'total_ttc' => lang('Total TTC'),
			'payment_amount' => lang('Payment amount'),
			'payment_bank' => lang('Bank'),
			'payment_mode' => lang('Payment method'),
		);
		return $retour;
	}
	
	function get_rows_collect($query,&$rows,&$readonlys){
	/**
	 * Informations pour la vue TVA/Encaissement
	 */
		// Facture payées durant la période choisie
		$start_period = mktime(0,0,0,$query['month'],1,$query['year']-1);
		$end_period = mktime(0,0,0,$query['month']+1,1,$query['year']-1);
		$join = 'WHERE payment_date BETWEEN '.$start_period.' AND '.$end_period;

		$query['col_filter']['societe_id'] = $query['provider'];

		$rows = $this->search($recherche,$id_only,$order,'',$wildcard,false,'OR',$start,$query['col_filter'],$join);
		if(!$rows){
			$rows = array();
		}

		$total['facture_id'] = $total['facture_number'] = '';
		$total['class_total'] = 'total';
		foreach($rows as $id => $row){
			// Bank
			$config = CreateObject('phpgwapi.config');
			$spiclient_config = $config->read('spiclient');
			$client_bo = CreateObject("spiclient.client_bo");
			$banks = $client_bo->get_bank_account($row['societe_id'],$bank_only=true);
			$rows[$id]['payment_bank'] = $banks[$row['payment_bank']];

			// Totaux HT / TVA / TTC
			$montant_tva = 0;
			$tab_tva = array();
			$ligne_facture = $this->so_factures_details->search(array('facture_id'=>$row['facture_id']),false);
			$tab_tva = array();
			foreach($ligne_facture as $ligne){
				if($ligne['total_ht'] != 0){
					$tab_tva[$ligne['vat_rate']] += $ligne['total_ht'];
				}elseif($ligne['extra_ht'] != 0){
					$tab_tva[$ligne['vat_rate']] += $ligne['extra_ht'];
				}
			}
			
			foreach($tab_tva as $taux => $montant_ht){
				$montant_tva += $taux==0 ? 0 : $montant_ht * $taux / 100;
			}

			$rows[$id]['total_ttc'] = number_format($row['total_ht'] + $montant_tva,2,'.','');
			$rows[$id]['total_tva'] = number_format($montant_tva,2,'.','');

			// TOTAUX
			$total['total_ht'] = number_format($total['total_ht'] + $rows[$id]['total_ht'],2,'.','');
			$total['total_ttc'] = number_format($total['total_ttc'] + $rows[$id]['total_ttc'],2,'.','');
			$total['total_tva'] = number_format($total['total_tva'] + $rows[$id]['total_tva'],2,'.','');
			$total['payment_amount'] = number_format($total['payment_amount'] + $rows[$id]['payment_amount'],2,'.','');

			if($query['csv_export']){
				

				$client_bo = CreateObject("spiclient.client_bo");
				$delai_paiement=$client_bo->get_delai_paiement();
				$modes=$client_bo->get_mode_reglement();
				
				$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
				$fact_cat=$fact_cat_bo->get_cat_facture();
				$contracts = $this->get_contract();
				$clients = $this->get_customer_billable();

				$rows[$id]['facture_id'] = $row['facture_number'];
				$rows[$id]['contract_id'] = $contracts[$row['contract_id']];
				$rows[$id]['client_id'] = $clients[$row['client_id']];
				$rows[$id]['invoice_cat'] = $fact_cat[$row['invoice_cat']];

				$rows[$id]['send_date'] = empty($rows[$id]['send_date']) ? '' : date('d/m/Y', $rows[$id]['send_date']);
				$rows[$id]['payment_date'] = empty($rows[$id]['payment_date']) ? '' : date('d/m/Y', $rows[$id]['payment_date']);

				$rows[$id]['payment_mode'] = $modes[$row['payment_mode']];
			}
		}

		// Ligne de total
		$rows[] = $total;

		return $this->total+1;
	}
	
	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les factures. Retourne le nombre de factures
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		$GLOBALS['egw']->session->appsession('facture_index','spifina',$query);

		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		$recherche=array();
		
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		
		
		if ((int)$query['filter'] && (int)$query['filter']!=0){
			$query['col_filter']['societe_id'] = (string) (int) $query['filter'];
		}else{
			$clients = $this->facture_client_groups($query['year'], false);
			
			if(empty($clients) && !$this->is_admin()){
				$my_orgs = $this->facture_client_groups($content['nm']['year']);

				if(!empty(array_keys($my_orgs)))
					$recherche[] = 'spifina_factures.client_id IN ('.implode(',',array_keys($my_orgs)).')';
			}
			 
			if(!empty($clients)){
				$recherche[] = 'spifina_factures.client_id IN ('.implode(',',array_keys($clients)).')';
			}
		}
		
		// Recherche sur une lettre
		$join = '';
		if(isset($query['searchletter'])){
			$join = ' INNER JOIN (select spiclient.client_id as cli_id,spiclient.client_company from spiclient) SC ON SC.cli_id = spifina_factures.client_id AND SC.client_company LIKE \''.$query['searchletter'].'%\' ';
		}
		
		 // _debug_array($query['filter2']);

		if ((int)$query['filter2'] && !empty($query['filter2']) && (int)$query['filter2']>0){
			switch($query['filter2']){
				case 1:
					$query['col_filter']['invoice_validate'] = 0;
					break;
				case 2:
					$query['col_filter']['invoice_validate'] = 1;
					break;
				case 3:
					$query['col_filter']['invoice_validate'] = 1;
					$query['col_filter']['invoice_payed'] = 1;
					break;
				case 4:
					$query['col_filter']['invoice_validate'] = 1;
					$query['col_filter']['invoice_payed'] = 0;
					break;
				case 5:
					$query['col_filter']['invoice_validate'] = 1;
					$query['col_filter']['invoice_send'] = 0;
					break;
				case 6:
					unset($query['col_filter']['invoice_validate']);
					unset($query['col_filter']['invoice_send']);
					break;
				case 7:
					$query['col_filter']['invoice_validate'] = 1;
					$query['col_filter']['invoice_payed'] = 0;
					if(strpos($join, "WHERE") === false){
						$join .= 'WHERE (spifina_factures.invoice_due_date < '.mktime(0,0,0).')';
					}else{
						$join .= 'AND (spifina_factures.invoice_due_date < '.mktime(0,0,0).')';
					}
					break;
			}
		}else{
			$query['col_filter']['invoice_validate'] = 1;
		}

		
		if(!$this->is_admin()){
			$query['col_filter']['generated_pdf'] = 1;
		}
		
		
		if(!empty($query['search'])){
			$join = 'LEFT JOIN spiclient ON spiclient.client_id = spifina_factures.client_id LEFT JOIN spiclient_contrats ON spiclient_contrats.contract_id = spifina_factures.contract_id WHERE (contract_title LIKE "%'.$query['search'].'%" OR facture_number LIKE "%'.$query['search'].'%" OR client_company LIKE "%'.$query['search'].'%")';
			$op = 'OR';
		}
		
		// Filtre fournisseur
		if(!empty($query['client'])){
			$query['col_filter']['client_id'] = $query['client'];
		}

		// Filtre contrat
		if(!empty($query['contract'])){
			$query['col_filter']['contract_id'] = $query['contract'];
		}
		
		// YLF - Ajout d'un filtre sur l'année
		if(!empty($query['year'])){
			$start_date = mktime(0,0,0,1,1,$query['year']-1);
			$end_date = mktime(0,0,0,1,1,$query['year']);
			
			// $join .= 'WHERE spifina_factures.creation_date BETWEEN '.$start_date.' AND '.$end_date;  
			if(strpos($join, "WHERE") === false){
				$join .= 'WHERE ((spifina_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spifina_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.'))';
			}else{
				$join .= ' AND ((spifina_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spifina_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.'))';
			}
		}
		
		// recupère les factures		
		// _debug_array($query['col_filter']);
		// _debug_array($recherche);
		// _debug_array($join);
// $this->debug = 5;
		$rows = $this->search($recherche,$id_only,$order,'',$wildcard,false,'OR',$start,$query['col_filter'],$join);
// exit;
		if(!$rows){
			$rows = array();
		}

		if($query['csv_export']){
				
				$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
				$fact_cat=$fact_cat_bo->get_cat_facture();
				$contracts = $this->get_contract();
		}	
				
		
		foreach($rows as $id=>$value){
			//Peut-on générer la facture
			$readonlys['pdf['.$value['facture_id'].']']= $this->is_admin() ? false : true;
			$readonlys['pdfsimul['.$value['facture_id'].']']= $this->is_admin() ? false : true;
			$readonlys['pdfproforma['.$value['facture_id'].']']= $this->is_admin() ? false : true;
			//Tant que la facture n'est pas générée, impossible de l'ouvrir et de l'imprimer
			$readonlys['checked['.$value['facture_id'].']']=true;
			$readonlys['tprint['.$value['facture_id'].']']=true;
			$readonlys['mail['.$value['facture_id'].']']=true;
			$readonlys['pay['.$value['facture_id'].']']=true;
			$readonlys['paid['.$value['facture_id'].']']=true;
			$readonlys['remind['.$value['facture_id'].']']=true;
			//Si la facture est générée alors on peut la visualiser
			if($value['validation_date']!=0 && $this->is_admin()){
				$readonlys['view['.$value['facture_id'].']']=false;
			}else{
				$readonlys['view['.$value['facture_id'].']']=true;
			}
			//Si la facture est générée on ne peut plus ni la supprimer ni l'éditer ni la générer de nouveau par contre on peut l'ouvrir et l'imprimer
			if($value['generated_pdf']!=0){
				$readonlys['edit['.$value['facture_id'].']']=true;
				$readonlys['delete['.$value['facture_id'].']']=true;
				$readonlys['pdf['.$value['facture_id'].']']=true;
				$readonlys['pdfsimul['.$value['facture_id'].']']=true;
				$readonlys['pdfproforma['.$value['facture_id'].']']=true;
				$readonlys['view['.$value['facture_id'].']']=false;
				$readonlys['tprint['.$value['facture_id'].']']=false;
				$readonlys['checked['.$value['facture_id'].']']=false;
				// mail et pay uniquement pour les admin
				$readonlys['mail['.$value['facture_id'].']']= !$this->is_admin();
				$readonlys['pay['.$value['facture_id'].']'] = !$this->is_admin();

				$readonlys['remind['.$value['facture_id'].']']=false;
			}
			//Si la facture est validée, on ne peut plus la supprimer ni l'éditer
			if($value['validation_date']!=0){
				$readonlys['edit['.$value['facture_id'].']']=true;
				$readonlys['delete['.$value['facture_id'].']']=true;
			}
			//Tant que la facture n'est pas validée, on ne peut pas la générer au format PDF
			if(empty($value['validation_date']) || $value['validation_date']==0){
				$readonlys['pdf['.$value['facture_id'].']']=true;
			}
			
			//Si la facture est payée, on affiche le logo payé (vert)...
			if($value['payment_date']!=0){			
				$readonlys['pay['.$value['facture_id'].']'] = true;
				$readonlys['paid['.$value['facture_id'].']'] = !$this->is_admin();
			}

			if($value['generated_pdf']!=0 && empty($value['payment_date']) && $value['invoice_due_date'] < time()){
				$readonlys['remind['.$value['facture_id'].']']=false;
			}else{
				$readonlys['remind['.$value['facture_id'].']']=true;
			}

			$client=$this->so_client->search(array('client_id'=>$value['client_id']),'client_company,client_payment_model,client_code_tiers');
			
			if($GLOBALS['egw_info']['apps']['spid']){
				$ticket_assigned_to_invoice=$this->so_ticket->search(array('facture_id'=>$value['facture_id']),false);
				if(!empty($ticket_assigned_to_invoice)){
					$rows[$id]['ticket_number']=count($ticket_assigned_to_invoice);
				}else{
					$rows[$id]['ticket_number']= '-';
				}
			}
			$rows[$id]['invoice_cat'] = $rows[$id]['invoice_cat']==0 ? '' : $rows[$id]['invoice_cat'];
			$rows[$id]['contract_id'] = $rows[$id]['contract_id']==0 ? '' : $rows[$id]['contract_id'];
			
			// _debug_array($rows);
			
			if(!empty($client)){
				$rows[$id] += $client[0];
			}

			//Spirea YLF - 30/03/2011 - On récupère le code opération depuis la table client_relation
			$clientRelation = $this->so_clients_relations->search(array('societe_id'=>$value['societe_id'],'client_id'=>$value['client_id']),false);
			if(!empty($clientRelation)){
				$rows[$id]['client_operation_code'] = $clientRelation[0]['operation_code'];
			}
			//on récupère le fournisseur
			$fournisseur=$this->so_client->search(array('client_id'=>$value['societe_id']),false);
			if(!empty($fournisseur)){
				$rows[$id]['provider'] = $fournisseur[0]['client_company'];
			}

			// Champs  pour les exports
			// $rows[$id]['invoice_send'] = ($rows[$id]['invoice_send'] != 0 ? 1 : "");
			$rows[$id]['creation_date_export'] = date('d/m/Y',$rows[$id]['creation_date']);
			$rows[$id]['payment_date_export'] = ($rows[$id]['payment_date'] > 0 ? date('d/m/Y',$rows[$id]['payment_date']) : "");
			$rows[$id]['send_date_export'] = ($rows[$id]['send_date'] > 0 ? date('d/m/Y',$rows[$id]['send_date']) : "");
						
			// _debug_array($rows);
			
			if($rows[$id]['invoice_send'] == 0) { 
					unset($rows[$id]['invoice_send']);
					};
			if($rows[$id]['contract_id]'] == 0) { 
					unset($rows[$id]['contract_id]']);
					};
			if($query['csv_export']){
				$rows[$id]['contract_id'] = $contracts[$rows[$id]['contract_id']];
				$rows[$id]['invoice_cat'] = $fact_cat[$rows[$id]['invoice_cat']];
			}
			
		}
		$order = $query['order'];
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Invoice Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}


		$rows['hide_spid'] = !array_key_exists('spid', $GLOBALS['egw_info']['apps']);
		// _debug_array($rows);
		return $this->total;	
    }
	
}	
?>
