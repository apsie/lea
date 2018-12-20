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


require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.spidating_bo.inc.php');	

class spidating_ui extends spidating_bo{
	/**
	 * Methods callable via menuaction
	 *
	 * @var array
	 */
	var $public_functions = array(
		'index' 	=> true,
		'add' 		=> true,
		'about' 	=> true,
		'add_result' => true,
	);

	/**
	 * Constructor
	 *
	 */
	function spidating_ui()
	{
		// Récupération des groupes de l'utilisateur
		$groupeUser = array_keys($GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
		
		// Récupération des managers de chaque groupe de l'utilisateur
		// $account_bo = CreateObject('admin.boaccounts');
		$managers = array();
		// foreach($groupeUser as $group_id){
		// 	$managers += $account_bo->load_group_managers($group_id);
		// }
		// $managers = array_keys($managers);
		
		if($GLOBALS['egw_info']['user']['apps']['admin']){
			// Admin
			$GLOBALS['egw_info']['user']['spidatingLevel'] = 1000;
		}elseif(in_array($this->obj_config['AccountingGroup'],$groupeUser)){
			// Comptable
			$GLOBALS['egw_info']['user']['spidatingLevel'] = 100;
		}elseif(in_array($GLOBALS['egw_info']['user']['account_id'],$managers)){
			// Manager
			$GLOBALS['egw_info']['user']['spidatingLevel'] = 10;
		}else{
			// Utilisateur
			$GLOBALS['egw_info']['user']['spidatingLevel'] = 1;
		}
		
		parent::spidating_bo();
		

		if($this->obj_config['couple_spid'] && array_key_exists('spid', $GLOBALS['egw_info']['user']['apps']) ){
			$FileNameAJAX=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/ajax_request.js';
			$FileNameCSS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/alert.css';
			$FileNameCSS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/default.css';
			$FileNameCSS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/alphacube.css';
			$FileNameJS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/prototype.js';
			$FileNameJS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/effects.js';
			$FileNameJS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/window.js';
			$FileNameJS4=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/functions.js';
			$javascript="";
			$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS1.'" />'."\n";
			$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS2.'" />'."\n";
			$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS3.'" />'."\n";
			$javascript.='<script type="text/javascript" src="'.$FileNameAJAX.'"></script>'."\n";
			$javascript.='<script type="text/javascript" src="'.$FileNameJS1.'"></script>'."\n";
			$javascript.='<script type="text/javascript" src="'.$FileNameJS2.'"></script>'."\n";
			$javascript.='<script type="text/javascript" src="'.$FileNameJS3.'"></script>'."\n";
			$javascript.='<script type="text/javascript" src="'.$FileNameJS4.'"></script>'."\n";
			$javascript.='<script type="text/javascript">var ajax_request = new ajax_request("'.$GLOBALS['egw_info']['server']['webserver_url'].'/spid");</script>'."\n";
			
			$javascript.='<script type="text/javascript">
				function addTitle(check){
					var title = document.getElementById("exec[ticket_title]");
					var res = document.getElementById("exec[spid][id]");

					if(check.checked){
						title.value = res.options[res.selectedIndex].text;
					}else{
						title.value = "";
					}
				}
				</script>';

			//Spirea YLF - 28/02/2011 - Modification pour n'avoir le javascript qu'une seule fois
			if(strpos($GLOBALS['egw_info']['flags']['java_script'],$FileNameAJAX) === false){
				$GLOBALS['egw_info']['flags']['java_script'].=$javascript."\n";
			}
		}
	}

	function index($content=null){
	/**
	 * Charge le template index
	 */
		// Changement de categorie
		if(isset($content['new_category'])){
			foreach($content['nm']['rows']['checked'] as $key => $cal_id){
				// Recupération des infos de l'event 
				$event = $this->so_calendar->read($cal_id);
				$event[$cal_id]['category'] = $content['new_category'];
				
				// Mise en base
				$cal_id = $this->so_calendar->save($event[$cal_id],$recurrence);
			}

			unset($content['new_category']);
			unset($content['nm']['rows']['checked']);
		}

		if(!empty($content['nm']['rows']['link_ticket'])){
			foreach($content['nm']['rows']['link_ticket'] as $event_id => $data){
				$temp = explode('.',$_REQUEST['exec']['ticket_selection_'.$event_id]);
				$ticket_client_order_id = $temp[0];
				$ticket_id = $temp[1];

				// Update du ticket (ajout du client_order)
				$info_ticket = array('ticket_id' => $ticket_id, 'ticket_client_order_id' => $ticket_client_order_id);
				$this->so_ticket->update($info_ticket,false);

				// Lien
				egw_link::link('spid',$ticket_id,'calendar',$event_id);

				// Ajout table rendez-vous
				$rendez_vous = array(
					'ticket_id' => $ticket_id,
					'account_id' => $GLOBALS['egw_info']['user']['account_id'],
					'cal_id' => $event_id,
					'creation_date' => $_SERVER['REQUEST_TIME'],
					'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
					
				);
				$this->so_rendez_vous->save($rendez_vous);
			}

			unset($content['nm']['rows']['link_ticket']);
		}

		if(empty($content['nm']))
			$content['nm'] = $GLOBALS['egw']->session->appsession('index','spidating');		

		if (!is_array($content['nm'])) 
		{
			
			// $default_cols='dossier_id,dossier_ref,dossier_responsible,dossier_jurisdiction,dossier_status';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       =>	'spidating.spidating_ui.get_rows',
	 			'filter_no_lang' => True,	// I  set no_lang for filter (=dont translate the options)
				'no_filter2'     => false,	// I  disable the 2. filter (params are the same as for filter)
				'no_cat'         => True,	// I  disable the cat-selectbox
//				'bottom_too'     => True,// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'filter'         => 'after',
				'order'          =>	'cal_start',// IO name of the column to sort after (optional for the sortheaders)
				'sort'           =>	'ASC',// IO direction of the sort: 'ASC' or 'DESC'
				'default_cols'   => '!week,weekday,cal_title,cal_description,recure,cal_location,cal_owner,cat_id,pm_id',
				'selectcols'   => '!week,weekday,cal_title,cal_description,recure,cal_location,cal_owner,cat_id,pm_id,cfs',
				'filter_onchange' => "set_style_by_class('table','custom_hide','visibility',this.value == 'custom' ? 'visible' : 'hidden'); if (this.value != 'custom') this.form.submit();",
				'header_left'    => 'calendar.list.dates',

				'users' => $GLOBALS['egw_info']['user']['account_id'],
			);
		}

		// Bascule du filtre de vue dans la liste filter2
		if(isset($_GET['view'])){
			$content['nm']['view'] = $_GET['view'];
			unset($content['nm']['col_filter']);
		}


		$sel_options = array(
			'filter' => array(
				'after'  => 'After current date',
				'before' => 'Before current date',
				'intervention' => 'All interventions',
				'all'    => 'All events',
				'custom' => 'Selected range',
			),
			'filter2'=> $this->get_cal_cat(true),
			'new_category'=> $this->get_cal_cat(true),
		);

		switch ($content['nm']['view']) {
			case 'place_coll': 
				$content['help'] = $this->obj_config['help_collective'];
				break;
			case 'place_ind':
				$content['help'] = $this->obj_config['help_individual'];
				break;
			case 'orphans':
				$content['help'] = $this->obj_config['help_orphan'];
				break;
			case 'ticket':
				$content['help'] = $this->obj_config['help_ticket'];
				break;
			
			// case 'cancel':
			// 	$content['help'] = $this->obj_config['help_cancel'];
			// 	break;
			// case 'confirm':
			// 	$content['help'] = $this->obj_config['help_confirm'];
			// 	break;
		}

		$content['nm']['header_right'] = 'spidating.index.right';
		$content['nm']['header_left'] = 'spidating.index.left';
	
		$tpl = new etemplate('spidating.index');
		$tpl->read('spidating.index');
		$tpl->exec('spidating.spidating_ui.index', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
	}
	 
	function add($content=null){
	/**
	 * Fonction de création/modification d'une note de frais
	 *
	 * @param $content
	 */
		if(isset($content['button']) && !empty($content['button'])){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$data = $content;
					$data['option'] = $_REQUEST['option'];

					// $msg = $this->addEvents($data);
					$add_values = $this->addEvents($data);

					if($button=='save'){
						$GLOBALS['egw_info']['flags']['java_script'] .= "<script type=\"text/javascript\">
							var referer = opener.location;
							opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';window.close()</script>";
					}
					$this->add_result($add_values);
					$GLOBALS['egw']->common->egw_exit();

					break;
			}

			$temp_hide_ticket = $content['hide_ticket'];
			unset($content);
			
			$content['msg'] = $msg;
			$content['hide_ticket'] = $temp_hide_ticket;
		}

		// Si couplage spid 
		// _debug_array($GLOBALS['egw_info']['user']['apps']);
		if($this->obj_config['couple_spid'] && array_key_exists('spid', $GLOBALS['egw_info']['user']['apps']) ){
			require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.spid_ui.inc.php');	
			$spid_ui = new spid_ui();

			$fileNameJS=$GLOBALS['egw_info']['server']['webserver_url']."/spid/temp/scripts_".$GLOBALS['egw_info']['user']['account_id'].md5($GLOBALS['egw_info']['user']['account_lid']).".js";	
			if($_SESSION['egw_session']['spid_js'] != '1'){
				
				$groupeClients = $spid_ui->phparray_jsarray('groupeClients',$spid_ui->groupeClients(),true);
				$membrerGroupesDuUser = $spid_ui->phparray_jsarray('membrerGroupesDuUser',$spid_ui->membrerGroupesDuUser(),true);
				$tabDefault = $spid_ui->phparray_jsarray('tabDefault',$spid_ui->tabDefault(),true);
				$groupesDuUser = $spid_ui->phparray_jsarray('groupesDuUser',$spid_ui->groupesDuUser(),true);
				$javascript = '
					//Tableau des groupeClients
					'.$groupeClients.'
					//Tableau des membrerGroupesDuUser
					'.$membrerGroupesDuUser.'
					//Tableau des tabDefault
					'.$tabDefault.'
					//Tableau des groupesDuUser
					'.$groupesDuUser.'
					//Valeur par défaut;
					
					function ajouterAssigneA(forms,assigne){
						// mise à jour du champs assigne_a
						if(document.getElementById("exec[cat_id]") != null){
							var cat_info=catInfo(document.getElementById("exec[cat_id]").value);
							var cat_managementgroup=cat_info[0]; // ok
							//var cat_assignedto=cat_info[1]; // ok
							var cat_assignedto=assigne; // ok
							var cat_groupUser=cat_info[2];	// ok
							var groupManagement=false;
							for(var g in tabDefault["group_management_value_users"]){
								if(g=='.$GLOBALS['egw_info']['user']['account_id'].'){
									groupManagement=true;
								}
							}
							var myselect=document.getElementById("exec[ticket_assigned_to]");
							// alert("valeur asisgned_to");
							// alert(myselect);
							// myselect=19;
							myselect.options.length=1;
							if(cat_managementgroup==""){
								cat_managementgroup=tabDefault["group_management_id"];
							}
							for(var i in groupeClients[cat_managementgroup]){
								element=groupeClients[cat_managementgroup][i];
								if(i==cat_assignedto){
									nouvel_element = new Option(element,i,false,true);
								}else{
									nouvel_element = new Option(element,i,false,false);
								}
								try{
									myselect.add(nouvel_element,null);
								}catch(e){
									myselect.add(nouvel_element);
								}
							}
							
							if(groupManagement==false){
								if(cat_groupUser==false){
									document.getElementById("exec[ticket_assigned_to]").setAttribute("disabled", "disabled");
								}
							}
							visibleChamp(cat_managementgroup);
						}
					}
					
					function visibleChamp(visibleTemps){
						document.getElementById("exec[ticket_spend_time]").setAttribute("disabled", "disabled");
						if(visibleTemps!=""){
							for(var i in groupesDuUser){
								if(i==visibleTemps){
									document.getElementById("exec[ticket_spend_time]").removeAttribute("disabled");
								}
							}
						}
					}
					
					function ajouterDemandeur(forms) {
						var idGroupe=document.getElementById("exec[account_id]").value;
						var myselect=document.getElementById("exec[ticket_assigned_by]");
						myselect.options.length=1;
						for(var i in groupeClients[idGroupe]){
							element=groupeClients[idGroupe][i];
							if(UnDemandeur(i)==true){
								nouvel_element = new Option(element,i,false,true);
							}else{
								nouvel_element = new Option(element,i,false,false);
							}
							try{
								myselect.add(nouvel_element,null);
							}catch(e){
								myselect.add(nouvel_element);
							}
						}	
					}
					
					function UnDemandeur(i){
						if(tabDefault["demandeur"][i]){
							return true;
						}else{
							return false;
						}
					}
					
					function catInfo(id){
						var info=new Array();
						for(var i in tab_cat){
							if(tab_cat[i]["cat_id"]==id){
								info[0]=tab_cat[i]["cat_managementgroup"];
								info[1]=tab_cat[i]["cat_assignedto"];
								info[2]=false;
								var tab_group_user=tab_cat[i]["group_user"].split(",");
								for(var j=0;j<tab_group_user.length;j++){
									if(tab_group_user[j]==info[0]){
										info[2]=true;
										break;
									}
								}
							}
						}
						// alert(info);
						return info;
					}';
				$fileName = EGW_SERVER_ROOT."/spid/temp/scripts_".$GLOBALS['egw_info']['user']['account_id'].md5($GLOBALS['egw_info']['user']['account_lid']).".js";
				$fp = fopen($fileName,"w");
				fputs($fp,$spid_ui->write_js());
				fputs($fp,$javascript);
				fclose($fp);
				
				$_SESSION['egw_session']['spid_js'] = '1';
			}
			//$fileNameJS=$GLOBALS['egw_info']['server']['webserver_url']."/spid/inc/js/scripts_".$GLOBALS['egw_info']['user']['account_id'].".js";
			//$GLOBALS['egw_info']['flags']['java_script'].=$javascript;
			if(strpos($GLOBALS['egw_info']['flags']['java_script'],$fileNameJS) === false){
				$GLOBALS['egw_info']['flags']['java_script'].='<script type="text/javascript" src="'.$fileNameJS.'"></script>';
			}
		}

		if(isset($content['filter']['button']['calendar'])){
			$msg = array();
			// Durée
			if(empty($content['duration']))
				$msg[] = lang('Duration must not be empty');

			// Jour de la semaine
			if(empty($content['filter']['weekdays']))
				$msg[] = lang('Weekdays must not be empty');

			// Plage trop petite
			if($content['duration'] * 60 > $content['filter']['end'] - $content['filter']['start'])
				$msg[] = lang('Not enough time in the timeframe to add event of the chosen duration');

			// Plage incohérente
			if($content['filter']['start'] > $content['filter']['end'])
				$msg[] = lang('Start time must be inferior to end time');

			if($content['filter']['pause_start'] > $content['filter']['pause_end'])
				$msg[] = lang('Pause start time must be inferior to pause end time');

			if(empty($msg)){
				$content = array_merge($content, $this->getCalendar($content));
			}else{
				$content['msg'] = lang('Error').' : '.implode("\n", $msg);
			}

			for($i = 0;$i < 6;$i++){
				if($i+1 > $content['filter']['nb_month']){
					$content['hide'.$i] = true;
				}else{
					$content['hide'.$i] = false;
				}
			}
		}else{
			for($i = 0;$i < 6;$i++){
				$content['hide'.$i] = true;
			}

			// Heures de début et de fin de journée par défaut (depuis le calendrier)
			$cal_pref = $GLOBALS['egw_info']['user']['preferences']['calendar'];
			$content['filter']['start'] = 3600 * $cal_pref['workdaystarts'];
			$content['filter']['end'] = 3600 * $cal_pref['workdayends'];

			// Valeurs par défaut
			$content['duration'] = $this->obj_config['default_duration'];
			$content['cat_meeting'] = $this->spid_config['default_cat'];
			$content['filter']['weekdays'] = $this->obj_config['default_weekdays'];
			$content['filter']['pause_start'] = $this->obj_config['default_pause_start'];
			$content['filter']['pause_end'] = $this->obj_config['default_pause_end'];

			$content['filter']['users'] = $GLOBALS['egw_info']['user']['account_id'];
		}

		$content['frame_top'] = '<table class="border_cal">';
		$content['frame_bottom'] = '</table>';

		$content['filter']['help_selection'] = $this->obj_config['help_selection'];

		// Masque / Affiche la zone d'info des tickets
		$content['hide_ticket'] = $_GET['ticket'] || $content['hide_ticket'] === false ? false : true;
		$content['help'] = $_GET['ticket'] || $content['hide_ticket'] === false ? $this->obj_config['help_ticket'] : $this->obj_config['help_add'];

		// Affiche/Masque le champs beneficiaire
		$content['hide_ben'] = $GLOBALS['egw_info']['user']['apps']['apsieben'] ? false : true;

		// Listes
		if($this->obj_config['couple_spid']){
			$sel_options = array(
				'ticket_priority' 		=> $spid_ui->sel_priority,
				'state_id'				=> $spid_ui->get_initial_state(),
				'client_id'				=> $spid_ui->client_groups('','',true),
				'location_id'			=> $spid_ui->get_location(),
				'ticket_unit_time'		=> $spid_ui->get_unit_time(),
				'month'					=> $this->get_month(),
				'cat_meeting'			=> $this->get_cal_cat(),
			);

			$sel_options['contract_id'] = $spid_ui->get_contrats($content['client_id']);
			$sel_options['ticket_site'] = $spid_ui->get_site();

			$cats = $spid_ui->get_categorie();
			$sel_options['ticket_assigned_to']=array();
			foreach($cats as $cat){
				if(isset($cat['cat_managementgroup']) && !empty($cat['cat_managementgroup'])){
					$cat_managementgroup=$spid_ui->obj_accounts->members($cat['cat_managementgroup'],true);
					foreach($cat_managementgroup as $cle=>$account_id){
						$user = $spid_ui->obj_accounts->read($account_id);
						if(!empty($user['account_status']) && !$spid_ui->obj_accounts->is_expired($user)){
							$sel_options['ticket_assigned_to'][$account_id]=$spid_ui->obj_accounts->id2name($account_id);
						}
					}
				}
				
				$user = $spid_ui->obj_accounts->read($cat['cat_assignedto']);
				if(!empty($user['account_status']) && !$spid_ui->obj_accounts->is_expired($user)){
					$sel_options['ticket_assigned_to'][$cat['cat_assignedto']]=$spid_ui->obj_accounts->id2name($cat['cat_assignedto']);
				}
			}
			natcasesort($sel_options['ticket_assigned_to']);

			// Permet de remplir la list des catégories de ticket
			$GLOBALS['egw']->categories = CreateObject('phpgwapi.categories',$GLOBALS['egw_info']['user']['account_id'],'spid');
			
			if(count($sel_options['client_id'])<=1){
				$content['client_id']=key($sel_options['client_id']);
				// Spirea-YLF - Modif client/demandeur
				$sel_options['ticket_assigned_by_contact'] = $spid_ui->get_demandeur($content['client_id']);
				$content['ticket_assigned_by_contact'] = $spid_ui->user2addressbook_id($spid_ui->account_id);
				
			}else{
				// Spirea-YLF - Modif client/demandeur
				$sel_options['ticket_assigned_by_contact'] = $spid_ui->get_all_demandeur();
				
				$sel_options['ticket_assigned_by'] = $spid_ui->open_by($sel_options['account_id']);
			}	
		}else{
			$sel_options = array(
				'month'					=> $this->get_month(),
				'cat_meeting'			=> $this->get_cal_cat(),
			);
		}

		$site_bo = CreateObject('spireapi.site_bo');
		$sel_options['cal_site'] = $site_bo->get_all_sites(true);
		
		$content['menu'] = $_GET['menu'] || $content['menu'] ? true : false;

		$content['hide_spid'] = $content['hide_ticket'] ? array_key_exists('spid', $GLOBALS['egw_info']['user']['apps']) : false;
		$content['hide_site'] = $this->obj_config['use_cal_site'] ? false : true;

		$tpl = new etemplate('spidating.add');
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Add events');
		$tpl->read('spidating.add');
		$tpl->exec('spidating.spidating_ui.add', $content, $sel_options, $readonlys, $content,$content['menu'] ? 2 : 0);
	}

	function add_result($values){
	/**
	* Affiche le résultat de l'ajout
	*/
		// Parcours des valeurs (groupé par appli)
		foreach($values as $app => $app_values){
			// Récupération objet de l'appli ( [app]_bo & [app]_hooks )
			$bo_ = CreateObject($app.'.'.$app.'_bo');
			$hooks = CreateObject($app.'.'.$app.'_hooks');
			$info_hooks = $hooks->search_link();
			
			// Taille popup
			$size = explode('x',$info_hooks['add_popup']);

			// Label titre 
			$link_title = explode('.', $info_hooks['title']);
			$object = CreateObject($link_title[0].'.'.$link_title[1]);
			$function = $link_title[2];

			// Parcours des données de l'appli
			$i = 1;
			foreach($app_values as $key => $id){
				// Récupération de l'objet
				$item = $bo_->read($id);
				
				// Lien popup de l'objet
				$title = '<a href="'.$GLOBALS['egw']->link('/index.php','menuaction='.$info_hooks['add']['menuaction'].'&'.$info_hooks['view_id'].'='.$id).'" onclick="window.open(this.href,\'_blank\',\'dependent=yes,width='.$size[0].',height='.$size[0].',scrollbars=yes,status=yes\');
					return false;">'.$object->$function($id).'</a>';
				$content[$app][$i]['title'] = $title;

				// Pour le calendrier on récupère les participants et les dates de début/fin
				if($app == 'calendar'){
					$content[$app][$i]['parts'] = implode(",\n",$bo_->participants($item,true));
					$content[$app][$i]['start'] = $item['start'];
					$content[$app][$i]['end'] = $item['end'];
				}

				++$i;
			}
		}
		// _debug_array($content);
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Add results');
		$tpl = new etemplate('spidating.result');
		$tpl->exec('spidating.spidating_ui.add_result', $content,$sel_options,$readonlys,$content,0);
	}

	function about(){
	/**
	* Affiche le boite de dialogue 'A propos ...'
	*/
		$content = $sel_options = $readonlys=array();
		$lines = file(EGW_INCLUDE_ROOT.'/spidating/about/about_fr.txt');
		$content['about'] = "";
		foreach ($lines as $line_num => $line) {
			$content['about'] .= htmlspecialchars($line) . "<br />\n";
		}

		// Info de l'appli (Table / Version)
		$app = $GLOBALS['egw_info']['flags']['currentapp'];
		$infoApp = $GLOBALS['egw_info']['apps'][$app];

		$file = EGW_SERVER_ROOT."/$app/setup/tables_current.inc.php";
		$phpgw_baseline = array();
		if ($app != '' && file_exists($file)){
			include($file);
		}
		
		$content['about'] .= lang('Version').' : '.$infoApp['version']."<br/>";
		$content['about'] .= lang('Tables').' :<br/>'.implode("\t<br/>",array_keys($phpgw_baseline))."<br/>";
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('About').' '.lang('spidating');
		$tpl = new etemplate('spidating.about');
		$tpl->exec('spidating.spidating_ui.about', $content,$sel_options,$readonlys,$content,0);
	}
}
?>