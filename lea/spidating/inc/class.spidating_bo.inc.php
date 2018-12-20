<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant création en masse d'évènement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.spidating_so.inc.php');	

class spidating_bo extends spidating_so{
	
	var $obj_config;

	function spidating_bo()
	{
		$config = CreateObject('phpgwapi.config');
		$this->obj_config = $config->read('spidating');

		$this->spid_config = $config->read('spid');
		parent::spidating_so();
	}
	
	function get_info($id){
	/**
	 * Retourne les informations pour la note de frais ayant l'identifiant $id
	 *
	 * @param int $id : identifiant de la note de frais
	 * @return array
	 */
		$info = $this->read($id);
		
		return $info;
	}

	function add_update_dossier($info){
	/**
	 * Fonction permettant la mise à jour ou la creation d'une reference
	 *
	 * @param $info tableau contenant les valeurs
	 * @return string
	 */
		$msg='';
		if(is_array($info)){
			unset($info['files|general|comment|mission|contact|download|history']);
			
			$this->data = $info;
			if(isset($this->data['dossier_id'])){
				$this->historique($this->data);
				$this->data['change_date'] = time();
				$this->data['modifier_id'] = $GLOBALS['egw_info']['user']['account_id'];
				$this->update($this->data,true);
				
				$msg .= ' '.lang('Folder updated');
			}else{
				$this->data['dossier_id'] = '';
				$this->data['creation_date'] = time();
				$this->data['creator'] = $GLOBALS['egw_info']['user']['account_id'];
				$this->save();
				
				$msg .= ' '.lang('Folder created');
			}
		}
		return $msg;
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupére et filtre les références
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétes
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		$GLOBALS['egw']->session->appsession('index','spidating',$query);

		$cats = $query['filter2'] == 0 ? '' : array($query['filter2']);

		$num_rows = $query['num_rows'];
		$start = $query['start'];
		
		$query['num_rows'] = 999999;
		$query['start'] = 0;

		// $this->calendar_uilist->owner = $query['owner'];

		// Filtre des vues
		switch($query['view']){
			case 'planned':
				$cats = $this->spid_config['confirmed_intervention'];
				unset($query['view']);
				break;
			case 'realised':
				$cats = $this->spid_config['realised_intervention'];
				unset($query['view']);
				break;
			case 'option':
				$cats = $this->spid_config['option_intervention'];
				unset($query['view']);
				break;
			case 'canceled':
				$cats = $this->spid_config['canceled_intervention'];
				unset($query['view']);
				break;
			case 'intervention':
				$cats = $this->cat_filter;
				unset($query['view']);
				break;
		}

		// $accounts = array();
		if($query['users'] < 0){
			$query['users'] = $GLOBALS['egw']->accounts->members($query['users']);
		}else{
			$query['users'] = array($query['users']=>'');
		}

		$admin_bo = CreateObject('spidating.admin_bo');
		$cal_fields = array_keys($admin_bo->get_cal_fields());

		$start_event = $query['start_date'];
		$end_event = $query['end_date'];

		switch($query['filter']){
			case 'after':
				$start_event = mktime(0,0,0,date("n"),date("j"));
				$end_event = 0;
				break;
			case 'before':
				$start_event = 0;
				$end_event = mktime(0,0,0,date("n"),date("j")+1);
				break;
			case 'custom':
				$GLOBALS['egw']->js->set_onload("set_style_by_class('table','custom_hide','visibility','visible');");
				break;
		}

		$rows = $this->so_calendar->search($start_event, $end_event, array_keys($query['users']), $cats, $query['filter'],false,false, array('cfs' => $cal_fields, 'order' => 'cal_start'));
		// $total = $this->calendar_uilist->get_rows($query,$rows,$readonlys);

		$temp_rows = array();
		foreach($rows as $id => $row){
			// if(in_array($row['category'], $cats)){			
				$nb_ben = 0;
				switch ($query['view']) {
					case 'place_coll': 
					// Event collectif avec des places libres (moins de beneficiaire inscrit que de place)
						if((int)$row['#'.$this->obj_config['field_participant']] <= 1){
							unset($rows[$id]);
						}else{
							foreach($row['participants'] as $participant => $value){
								if(substr($participant, 0,1) == 'b'){
									$nb_ben++;
								}
							}

							if($nb_ben >= (int)$row['#'.$this->obj_config['field_participant']]){
								unset($rows[$id]);
							}
						}
						break;
					case 'place_ind':
					// Event individuel sans benificiaire
						if((int)$row['#'.$this->obj_config['field_participant']] == 1){
							foreach($row['participants'] as $participant => $value){
								if(substr($participant, 0,1) == 'b'){
									$nb_ben++;
								}
							}

							if($nb_ben >= 1){
								unset($rows[$id]);
							}
						}else{
							unset($rows[$id]);
						}
						break;
					case 'orphans':
					// Event sans beneficiaire
						foreach($row['participants'] as $participant => $value){
							if(substr($participant, 0,1) == 'b' || substr($participant, 0,1) == 'c'){
								$nb_ben++;
							}
						}

						if($nb_ben >= 1){
							unset($rows[$id]);
						}
						break;
					case 'ticket':
					// Event avec beneficiaire sans ticket associé
						$i = 0;
						foreach($row['participants'] as $participant => $value){
							if($this->obj_config['couple_spid'] && $this->obj_config['spid']['synchro_presta']){
								if(substr($participant, 0,1) == 'b'){
									// Récupération du ticket et des infos 
									$id_ben = substr($participant,1);

									$join = 'JOIN spid_rendez_vous ON spid_rendez_vous.ticket_id = spid_tickets.ticket_id JOIN egw_prestation P ON P.lettre_de_commande = spid_tickets.ticket_client_order_id JOIN egw_contact C ON C.id_ben = P.id_ben WHERE C.id_ben = '.$id_ben.' AND spid_rendez_vous.cal_id = '.$row['id'];
									$ticket = $this->so_ticket->search('',false,'spid_tickets.ticket_id','',$wildcard,false,$op,false,array(),$join);

									if(empty($ticket)){
										$parts = explode(',',$row['parts']);
										$row['parts'] = trim($parts[$i]);
										$row['id_ben'] = $id_ben;
										$temp_rows[] = $row;
									}
								}
							}
							++$i;
						}
						break;
				}
			// }else{
			// 	unset($rows[$id]);
			// }
		}

		// Reprise des infos temporaire
		if(!empty($temp_rows)){
			$rows = $temp_rows;
		}
		sort($rows);

		// Filtre des pages (on retire les lignes en trop)
		$total = count($rows);
		foreach($rows as $id => $row){
			if($id < $start || $id > $start+$num_rows-1){
				unset($rows[$id]);
			}else{
				if($query['view'] == 'ticket'){
					$rows[$id]['ticket_selection'] = $this->get_available_ticket($row['id_ben'], $row['id']);
				}

				$rows[$id]['parts'] = implode(",\n",$this->bo_calendar->participants($row,true));
			}
		}
		sort($rows);

		// _debug_array($rows);

		$rows['hide_ticket'] = $query['view'] == 'ticket' ? false : true;
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Calendar list');

		return $total;
		// return $total;
    }

    function get_available_ticket($id_ben, $event_id){
    /**
     * Retourne les tickets disponible pour un beneficiaire
	 *
	 * @param $id_ben int : identifiant du beneficiaire
	 * @return string
	 */
    	// Info de la prestation
    	if($this->obj_config['couple_spid'] && $this->obj_config['spid']['synchro_presta']){
    		$join = 'RIGHT JOIN egw_prestation P ON P.lettre_de_commande = spid_tickets.ticket_client_order_id WHERE P.id_ben = '.$id_ben;
	    	$client_order = $this->so_ticket->search('','lettre_de_commande',$order,'','%',false,'AND',false,'',$join);
    		$client_order = $client_order[0]['lettre_de_commande'];
    	}

    	
    	$value = '<select name="exec[ticket_selection_'.$event_id.']" id="exec[ticket_selection]">';
	    $value .= '<option value = "">'.lang('Select a ticket').'</option>';
    	if(!empty($client_order)){
	    	// Tickets
	    	// $join = 'WHERE (spid_tickets.ticket_id NOT IN (SELECT spid_rendez_vous.ticket_id FROM spid_rendez_vous)) AND (spid_tickets.ticket_client_order_id = "'.$client_order[0]['lettre_de_commande'].'" OR spid_tickets.ticket_client_order_id="")';
	    	$join = 'WHERE (spid_tickets.ticket_client_order_id = "'.$client_order.'" OR spid_tickets.ticket_client_order_id IS NULL)';

			$order = 'GROUP BY spid_tickets.ticket_id ORDER BY spid_tickets.ticket_id';
	    	
	    	// $this->so_ticket->debug = 5;
	    	$tickets = $this->so_ticket->search('',false,$order,'','%',false,'AND',false,array('ticket_closed' => 0, ),$join);
	    
	    	foreach($tickets as $ticket){
	    		// _debug_array($ticket['ticket_id']);
	    		$value .= '<option value = "'.$client_order.'.'.$ticket['ticket_id'].'">'.$this->truncate($ticket['ticket_title']).'</option>';
	    	}
	    }
    	$value .= '</select>';

    	return $value;
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
		return '#'.$entry['dossier_id'].': '.$entry['dossier_titre'];
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
		if (($references = $this->search(array('dossier_id' => $ids),'dossier_id,dossier_titre')))
		{
			foreach($references as $reference)
			{
				$titles[$reference['dossier_id']] = $this->link_title($reference);
			}
		}
		// we assume all not returned tickets are not readable by the user, as we notify egw_link about each deleted ticket
		foreach($ids as $id)
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
		foreach((array) $this->search(array('dossier_titre' => $pattern),false,'dossier_id ASC','','%',false,'OR',false,'') as $item )
		{
			if ($item) $result[$item['dossier_id']] = $this->link_title($item);
		}
		return $result;
	}

	function getCalendar($content){
	/**
	 * Retourne les informations concernant l'assistant de création de ticket (principalement utilisé pour le calendrier)
	 *
	 * @param $month timestamp du premier jour du mois par lequel on souhaite commencer
	 * @param $nb_month : nombre de mois  a traiter
	 * @return array
	 */
		$month = $content['filter']['month'];
		$nb_month = $content['filter']['nb_month'];

		$start_h = $content['filter']['start'];
		$end_h = $content['filter']['end'] == 0 ? 24*3600 : $content['filter']['end'];

		$start_pause_h = $content['filter']['pause_start'];
		$end_pause_h = $content['filter']['pause_end'];

		$duration_s = $content['duration'] * 60;

		$weekdays = $content['filter']['weekdays'];

		$accounts = array();
		foreach ($content['filter']['users'] as $key => $id) {
			if($id < 0){
				$accounts += $GLOBALS['egw']->accounts->members($id);
			}else{
				$accounts += array($id=>'');
			}
		}

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
				$user = $GLOBALS['egw']->accounts->read($id);
				$info['cal'.$m][$index]['user'] = $user['account_fullname'];

				// SPIREA-YLF - Optimisations
				$first_day = mktime(0 , 0, 0, $moisEnCours, 1, $annee);
				$last_day = mktime(0 , 0, 0, $moisEnCours, $nbJour+1, $annee);
				$existing_events =& $this->bo_calendar->search(array(
					'start' => $first_day+$start_h,
					'end'   => $last_day+$end_h,
					'users' => array($id=>$id),
					'ignore_acl' => true,	// otherwise we get only events readable by the user
					'enum_groups' => true,	// otherwise group-events would not block time
				));

				$ft_start = $first_day + $start_h;
				foreach($existing_events as $existing_event){
					// Evenement se terminant avant la date => on passe
					if($existing_event['end'] < $ft_start){
						continue;
					}
					// Evenement commencant avant le debut de periode => on se decale apres
					if($existing_event['start'] < $ft_start){
						$ft_start = $existing_event['end'];
						continue;
					}

					// Fin de période = debut de l'événement
					$ft_end = $existing_event['start'];

					// Si la période est plus longue que la durée souhaitée
					if ($ft_end - $ft_start >= $duration_s){
						// Nouvelle période de temps libre
						$freetime[] = array(
							'start'	=> $ft_start,
							'end'	=> $ft_end,
						);
					}
					// On se place apres l'événement
					$ft_start = $existing_event['end'];
				}
				$freetime[] = array(
					'start'	=> $ft_start,
					'end'	=> $last_day,
				);
				// FIN SPIREA-YLF Optimisations
				
				// Parcours des jours du mois en cours
				for($i = 1; $i <= $nbJour; $i++){
					// Calcul du timestamp du jour en cours
					$day = mktime(0 , 0, 0, $moisEnCours, $i, $annee);
					
					// Affiche le jour sous la forme (Mon 01)
					$info['cal'.$m][1][$i] = lang(date('D',$day)).' '.date('d',$day);
					$mois = strlen($moisEnCours) == 1 ? ' 0'.$moisEnCours : $moisEnCours;

					// Si le jour n'est pas férié
					if(!is_array($holidays[$annee.$mois.date('d',$day)]) && $day > mktime()){
						// Permet de récupérer le "code" du jour pour savoir si on doit le traiter
						$dow = date('w', $day);	// 0=Sun, .., 6=Sat
						$mcal_dow = pow(2,$dow);

						if (!($weekdays & $mcal_dow)){
							// Jour a ne pas traiter (pas dans les jours sélectionné)
							continue;
						}else{
							// Parcours des heures
							$skip_until = 0;
							for($hour = $start_h; $hour+$duration_s <= $end_h; $hour += 3600){
								$value = $day.'.'.$hour;

								$disabled = false;
								$event_end_time = $hour + $duration_s;
								$h_texte = date('H\hi',$day+$hour).' - '.date('H\hi',$day+$event_end_time);

								$duration_before_pause = $start_pause_h - $start_h;
								$duration_after_pause = $end_h - $end_pause_h;

								// Pas d'overlap autorisé sur l'heure de pause sauf si durée > demi-journée (sinon impossible de placé de rendez-vous de 5h+)
								if(($event_end_time > $start_pause_h && $event_end_time <= $end_pause_h) || ($hour <= $start_pause_h && $event_end_time >= $end_pause_h) && ($duration_s < $duration_after_pause && $duration_s < $duration_before_pause)){
									// Conflit avec l'heure de pause
									$disabled = true;
								}else{
									if($hour < $skip_until){
										$disabled = true;
									}else{
										// Pas de conflit avec l'heure de pause
										// $overlapping_events =& $this->bo_calendar->search(array(
										// 	'start' => $day+$hour,
										// 	'end'   => $day+$hour+$duration_s,
										// 	'users' => array($id=>$id),
										// 	'ignore_acl' => true,	// otherwise we get only events readable by the user
										// 	'enum_groups' => true,	// otherwise group-events would not block time
										// ));
										
										// SPIREA-YLF - Optimisations
										$start = $day+$hour;
										$end = $day+$hour+$duration_s;
										$check_possible = false;
										foreach($freetime as $ft){
											if(($start >= $ft['start'] && $start <= $ft['end']) && ($end >= $ft['start'] && $end <= $ft['end'])){
												$check_possible = true;
												break;
											}
										}
										$disabled = !$check_possible;
										// FIN SPIREA-YLF - Optimisations
				
										// if(!empty($overlapping_events)){
										// 	foreach($overlapping_events as $id => $overlapping_event){
										// 		if(date('i', $overlapping_event['end']) == 0){
										// 			$skip_until = (date('H', $overlapping_event['end']) - 1) * 3600;
										// 		}else{
										// 			$skip_until = date('H', $overlapping_event['end']) * 3600;
										// 		}
										// 	}

										// 	// Conflit avec un ou plusieurs events
										// 	$disabled = true;
										// }
									}
								}
								
								// Génération de la checkbox								
								if($disabled){
									// Si un conflit a été détecté alors on disabled la checkbox
									$info['cal'.$m][$index][$i] .= '<input type="checkbox" disabled="disabled"';
								}else{
									$info['cal'.$m][$index][$i] .= '<input type="checkbox" title="'.$h_texte.'" name="option['.$id.'][]" value="'.$value.'" ';
								}
								$info['cal'.$m][$index][$i] .= ' ><br />';
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

	function addEvents($content=null){
	/**
	 * Traite les données provenant de l'assistant afin de créer les différent tickets et rendez-vous
	 *
	 * $content array : informations concernant le ticket
	 * @return strings
	 */
		// Frequence de création des tickets (défaut ou vide = mois)
		$assistant_frequency = empty($this->obj_config['assistant_frequency']) ? 's' : $this->obj_config['assistant_frequency'];
		
		$infoTicket = $content;
		unset($infoTicket['filter']);
		unset($infoTicket['option']);
		unset($infoTicket['button']);
		unset($infoTicket['frame_top']);
		unset($infoTicket['frame_bottom']);
		unset($infoTicket['duration']);
		unset($infoTicket['event_number']);
		unset($infoTicket['id_ben']);
		unset($infoTicket['resource']);
		unset($infoTicket['cat_meeting']);
		for($i = 0; $i <= 31; ++$i){
			unset($infoTicket[$i]);
			unset($infoTicket['hide'.$i]);
			unset($infoTicket['cal'.$i]);
		}

		if(!empty($content['addressbook'])){
			$contact = $GLOBALS['egw']->contacts->read($content['addressbook']);
			if(!empty($contact['account_id'])){
				$contact_type = 'u';
			}else{
				$contact_type = 'c';
			}
		}

		// Parcours des cases coché
		foreach($content['option'] as $idIntervenant => $values){
			foreach($values as $key => $date){
				$date = explode('.',$date);

				$start = $date[0] + $date[1];
				$end = $date[0] + $date[1] + ($content['duration'] * 60);
				
				if(is_array($event[date($assistant_frequency,$date[0])][$start.'.'.$end])){
					// Deja dans le tableau => on ajoute l'utilisateur comme participant
					$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant']['u'] = array_merge($event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant']['u'], array($idIntervenant));
				}else{
					// Tableau préparatif avant ajout
					$event[date($assistant_frequency,$date[0])][$start.'.'.$end] = array(
						'account_id' => $idIntervenant,
						'start' => $start,
						'end'	=> $end,
						'title' => $content['ticket_title'],
						'category' => $content['cat_meeting'],
						'cal_site' => $content['cal_site'],
					);

					$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant']['u'] = array($idIntervenant);

					if(!empty($content['id_ben']))
						$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant']['b'] = array($content['id_ben']);
					
					if(!empty($content['resource']))
						$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant']['r'] = array($content['resource']);
					
					if(!empty($content['addressbook']))
						$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['participant'][$contact_type][] = $content['addressbook'];

					// Champs personnalisés
					$customfields = config::get_customfields('calendar');
					foreach($customfields as $customfield => $data){
						$event[date($assistant_frequency,$date[0])][$start.'.'.$end]['#'.$customfield] = $content['#'.$customfield];
					}
				}
			}
		}
		// _debug_array($event);
		// exit;

		// Pour chaque event on crée un ticket qui lui sera lié
		foreach($event as $key => $cal){
			$ticket_id = 0;
			
			// if($this->obj_config['budget'])	$infoTicket['ticket_budget'] = $rdv['budget'];
			// unset($rdv['budget']);

			if($content['hide_ticket'] !== true){
				// Création du ticket
				$spid_ui = new spid_ui();
				$msg = $spid_ui->add_update_ticket($infoTicket,$ticket_id);
				$ticket_success++;
				$tickets[] = $ticket_id;
			}

			// Creation des events
			foreach($cal as $keycal => $infocal){
				$infoEvent = $infocal;
				$infoEvent['title'] = $content['ticket_title'];
				$infoEvent['ticket_id'] = $ticket_id;

				// 
				$hide_ticket = $content['hide_ticket'];
				if($content['spid']){
					$infoEvent['ticket_id'] = $content['spid'];
					$hide_ticket = false;
				}

				$cal_id = $this->save_event($infoEvent, $hide_ticket);

				if($cal_id){
					$cal_success++;
					$cals[] = $cal_id;
				}
			}
		}

		unset($spid_ui); 

		if($content['hide_ticket'] !== true){
			$msg = lang('%1 tickets and %2 events created successfully',$ticket_success, $cal_success);
		}else{
			$msg = lang('%1 events created successfully', $cal_success);
		}

		// return $msg;
		return array('spid' => $tickets, 'calendar' => $cals);
	}

	function save_event($info, $hide_ticket){
	/**
	 * Enregistre l'event avec les info disponible dans $info 
	 */
		foreach($info['participant'] as $type => $list){
			foreach($list as $key => $resource_id){
				$participants[$type.$resource_id] = 'A';
				$participants_types[$type][$resource_id] = 'A';
			}
		}
		// _debug_array($participants);
		// _debug_array($participants_types);exit;

		$event = array(
			'participants' => $participants,
			'participant_types' => $participants_types,
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
			'site' => $info['cal_site'],
		);

		// Champs personnalisés
		$customfields = config::get_customfields('calendar');
		foreach($customfields as $customfield => $data){
			$event['#'.$customfield] = $info['#'.$customfield];
		}

		$cal_id = $this->so_calendar->save($event,$recurrence);
		if($cal_id){
			$this->so_calendar->move($cal_id,$event['start'],$event['end']);
			egw_link::link('spid',$info['ticket_id'],'calendar',$cal_id);
			
			if(!$hide_ticket){
				$rendez_vous = array(
					'ticket_id' => $info['ticket_id'],
					'account_id' => $info['account_id'],
					'cal_id' => $cal_id,
					'creation_date' => $_SERVER['REQUEST_TIME'],
					'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
					
				);
				$this->so_rendez_vous->save($rendez_vous);
			}
		}

		return $cal_id;
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