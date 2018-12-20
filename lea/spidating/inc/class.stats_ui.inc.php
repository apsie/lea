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

class stats_ui extends spidating_bo{
	/**
	 * Methods callable via menuaction
	 *
	 * @var array
	 */
	var $public_functions = array(
		'stats' => true,
	);

	/**
	 * Constructor
	 *
	 */
	function stats_ui(){
		parent::spidating_bo();
	}

	function stats($content=null){
	/**
	 *
	 */
		if(isset($content['export'])){
		}
		

		if(empty($content))
			$GLOBALS['egw']->session->appsession('stats','spidating');
		
		if (!is_array($content['nm'])) 
		{
			
			// $default_cols='dossier_id,dossier_ref,dossier_responsible,dossier_jurisdiction,dossier_status';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       =>	'spidating.stats_ui.get_rows_stats',
	 			'filter_no_lang' => True,	// I  set no_lang for filter (=dont translate the options)
				'no_filter'      => true,	// I  disable the 2. filter (params are the same as for filter)
				'no_filter2'     => true,	// I  disable the 2. filter (params are the same as for filter)
				'no_cat'         => True,	// I  disable the cat-selectbox
				'filter'         => 'after',
				'order'          =>	'cal_start',// IO name of the column to sort after (optional for the sortheaders)
				'sort'           =>	'ASC',// IO direction of the sort: 'ASC' or 'DESC'
				'default_cols'   => '!week,weekday,cal_title,cal_description,recure,cal_location,cal_owner,cat_id,pm_id',
				'selectcols'   => '!week,weekday,cal_title,cal_description,recure,cal_location,cal_owner,cat_id,pm_id,cfs',
				'filter_onchange' => "set_style_by_class('table','custom_hide','visibility',this.value == 'custom' ? 'visible' : 'hidden'); if (this.value != 'custom') this.form.submit();",
			);

			// Valeur par défaut
			$content['nm']['start_date'] = mktime(0,0,0,1,1,date("Y"));
			$content['nm']['end_date'] = mktime(0,0,0,1,1,date("Y")+1);
		}

		// Mise des valeurs en session
		$GLOBALS['egw']->session->appsession('stats','spidating',$content);

		// Listes
		$sel_options = array(
			'participant' => array('addressbook','account','resources'),
			'axis' => $this->get_axis(),
			'category' => $this->get_cal_cat(),
			// 'typologie_id' => array('' => lang('Total cost')) + $this->get_typologie(),
		);

		$tpl = new etemplate('spidating.stats');
		$tpl->read('spidating.stats');
		$tpl->exec('spidating.stats_ui.stats', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
	}

	function get_rows_stats($query,&$rows,&$readonlys){
	/**
	 * Récupére et filtre les références
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétes
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		$memberships = $GLOBALS['egw']->accounts->membership($GLOBALS['egw_info']['user']['account_id']);
		foreach($memberships as $group_info){
			$members = $GLOBALS['egw']->accounts->member($group_info['account_id']);
			foreach((array)$members as $member){
				$users[] = $member['account_id'];
			}
		}

		$search_params = array(
			'cat_id' 	=> empty($query['category']) ? array_keys($this->get_cal_cat()) : $query['category'],
			'query' 	=> $query['search'],
			'offset' 	=> false,
			'num_rows' 	=> false,
			'order' 	=> $query['order'] ? $query['order'].' '.$query['sort'] : 'cal_start',
			'start'		=> $query['start_date'],
			'end' 		=> $query['end_date'],
			'users'		=> $users,
			'ignore_acl'=> false,
		);

		$join = "(egw_cal.cal_id IN (SELECT egw_links.link_id1 FROM egw_links WHERE egw_links.link_app1 = 'calendar' AND egw_links.link_app2 = '".$query['axis']."') OR egw_cal.cal_id IN (SELECT egw_links.link_id2 FROM egw_links WHERE egw_links.link_app2 = 'calendar' AND egw_links.link_app1 = '".$query['axis']."'))";

		if(!empty($query['axis'])){
			// Infos pour récupérer le titre
			$hooks = CreateObject($query['axis'].'.'.$query['axis'].'_hooks');
			$info_hooks = $hooks->search_link();

			// Taille popup
			$size = explode('x',$info_hooks['add_popup']);
			
			// Label titre 
			$link_title = explode('.', $info_hooks['title']);
			$object = CreateObject($link_title[0].'.'.$link_title[1]);
			$function = $link_title[2];
		}
		
		$events = $this->bo_calendar->search($search_params, $join);
		foreach((array)$events as $event){
			$links = egw_link::get_links('calendar',$event['id']);
			foreach($links as $link_id => $link_data){

				if($link_data['app'] == $query['axis']){
					$temp[$link_data['id']]['nb_meeting'] += 1;
					$temp[$link_data['id']]['time'] += ($event['end'] - $event['start']) / 60;

					foreach($event['participants'] as $id => $data){
						switch (substr($id, 0, 1)) {
							// Contact addressbook
							case 'c':
								$field = 'addressbook';
								break;
							// Contact addressbook
							case 'r':
								$field = 'resource';
								break;
							// Compte
							default:
								$field = 'account';
								break;
						}
						$temp[$link_data['id']]['sum_'.$field] += ($event['end'] - $event['start']) / 60;
					}
				}
			}
		}
		
		$i = 0;
		foreach($temp as $id => $data){
			$rows[$i] = $data;

			// Lien popup de l'objet
			$title = '<a href="'.$GLOBALS['egw']->link('/index.php','menuaction='.$info_hooks['add']['menuaction'].'&'.$info_hooks['view_id'].'='.$id).'" onclick="window.open(this.href,\'_blank\',\'dependent=yes,width='.$size[0].',height='.$size[0].',scrollbars=yes,status=yes\');
				return false;">'.$object->$function($id).'</a>';
			// $content[$app][$i]['title'] = $title;
			$rows[$i]['title'] = $title;
			++$i;
		}

		return count($rows);
	}

	function get_axis(){
	/**
	 * Retourne la liste des axes
	 *
	 * @return array
	 */
		$apps = array(
			'spid'			=> lang('spid'),
			'projectmanager'=> lang('projectmanager'),
			'spiclient'		=> lang('spiclient'),
			'infolog'		=> lang('infolog'),
			'tracker'		=> lang('tracker'),
		);

		foreach($apps as $app => $name){
			if(!array_key_exists($app, $GLOBALS['egw_info']['user']['apps'])){
				unset($apps[$app]);
			}
		}

		return $apps;
	}
}
?>