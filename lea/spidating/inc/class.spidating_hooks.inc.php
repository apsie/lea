<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * T�l : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propri�t� de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant cr�ation en masse d'�v�nement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.acl_spidating.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.spidating_so.inc.php');	

class spidating_hooks
{

	static function search_link($location)
	{
	/**
	* M�thode initialisant les variables globales des tickets, et les param�tres d'affichage de l'utilisateur
	*
	* NOTE : $location ne sert � rien
	* 
	* @param int $location param�tres locaux � charger
	* @return array
	*
	*/
		$appname = 'spidating';
		/* R�cup�ration des droits d'acc�s ACL */
		$acl = CreateObject($appname.'.acl_'.$appname);
		
		return array(
			'query' => 'spidating.spidating_bo.link_query',
			'title' => 'spidating.spidating_bo.link_title',
			'titles' => 'spidating.spidating_bo.link_titles',
			'view'  => array(
				'menuaction' => 'spidating.spidating_ui.add',
			),
			'view_id' => 'id',
			'view_popup'  => '930x700',
			'add' => array(
				'menuaction' => 'spidating.spidating_ui.add',
				'menu' => 1,
			),
			'add_app'    => 'link_app',
			'add_id'     => 'link_id',
			'add_popup'  => '930x700',
		);
	}

	static function all_hooks($args){
	/**
	* M�thode initialisant les variables globales des tickets et chargeant les pr�f�rences param�tr�es.
	* Permet aussi d'afficher le menu et de cr�er des liens dirig�s vers son contenu
	*
	* \version 
	*
	* @param array $args tableau contenant l'index location d�finissant l'endroit o� l'utilisateur se trouve : spidating menu,spidating,admin,... (on en d�duit ainsi les param�tres � afficher)
	*/
		$appname = 'spidating';
		$location = is_array($args) ? $args['location'] : $args;
		
		/* Spirea YLF - Gestion des droits */
		$config = CreateObject('phpgwapi.config');
		$obj_config = $config->read('spidating');
		
		// R�cup�ration des groupes de l'utilisateur
		$groupeUser = array_keys($GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
		

		/*********************/

		if ($location == 'sidebox_menu'){
			$file = array();
			display_sidebox($appname,lang('Menu'),$file);
		}
		if ($GLOBALS['egw_info']['user']['apps']['spidating'] && $location != 'admin' && $location != 'preferences'){
			$file = array();
			
			// if(spidating_so::is_manager()){
			// 	$file[]=array(
			// 'text' => '<a class="textSidebox" href="'.$GLOBALS['egw']->link('/index.php',array('menuaction' => 'spidating.spidating_ui.add')).
			// '" onclick="window.open(this.href,\'_blank\',\'dependent=yes,width=990,height=600,scrollbars=yes,status=yes\');
			// return false;">'.lang('Add events').'</a>',
			// 		'no_lang' => true,
			// 		'link' => false,
			// 	);
			// } 
			$file['Add events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.add');
		
			$file['Place a participant on collective meeting']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=place_coll');
			$file['Place a participant on individual meeting']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=place_ind');
			$file['Events without participants']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=orphans');
		
			$file['Planned events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=planned');
			$file['Realised events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=realised');
			$file['Option events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=option');
			$file['Canceled events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=canceled');
			
			$file['All interventions']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=intervention');
			$file['All events']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=all');

			if ($location == 'item'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Menu'),$file);
			}
		}

		if ($obj_config['couple_spid'] && $GLOBALS['egw_info']['user']['apps']['spid'] && $GLOBALS['egw_info']['user']['apps']['spidating'] && $location != 'admin' && $location != 'preferences'){
			$file = array();

			$file['Assistant with tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.add&ticket=1');
			$file['Events without tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.index&view=ticket');

			if ($location == 'item'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Spid events'),$file);
			}
		}
		
		if ($GLOBALS['egw_info']['user']['apps']['spidating'] && $location != 'admin' && $location != 'stats'){
			$file = array();
			$file['Time by linked elements']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.stats_ui.stats');
			
			if ($location == 'stats'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Statistics'),$file);
			}
		}

		// if (($GLOBALS['egw_info']['user']['apps']['spidating'] || $GLOBALS['egw_info']['user']['spidatingLevel'] >= 100) && $location != 'admin' && $location != 'referentiel'){
		// 	$file = array();
			
		// 	$file['Status']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.status_ui.index');
		// 	$file['Types']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.type_ui.index');
						
		// 	if ($location == 'repository'){
		// 		display_section($appname,$file);
		// 	}else{
		// 		display_sidebox($appname,lang('Repository'),$file);
		// 	}
		// }

		if ($GLOBALS['egw_info']['user']['apps']['admin'] && $location != 'preferences' && $location != 'spidating'){
			$file = array();
			$file['General']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_admin.index');
			$file['Help']=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_admin.help');

			if ($location == 'admin'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Admin'),$file);
			}
		}

		if ($location != 'admin' && $location != 'preferences' && $location != 'spidating'){
			$file = array();
			$file[lang('About').' '.lang('spidating')]=$GLOBALS['egw']->link('/index.php','menuaction=spidating.spidating_ui.about');
			$file[lang('User Manual')]=$GLOBALS['egw']->link('/spidating/about/Manuel_spidating_fr.pdf');
			$file[lang('License').' spidating']=$GLOBALS['egw']->link('/spidating/about/Licence_spidating_fr.pdf');
			display_sidebox($appname,lang('About').' '.lang('spidating'),$file);
		}
		
	}

	static function settings(){
	 /**
	 * charge les pr�f�rences dans $GLOBALS['settings']
	 * NOTE : la fonction retourne toujours true
	 *
	 * @return boolean
	 */
		
		$settings = array(
			'setting_code' => array(
				'type'   => 'select',
				'label'  => 'Information for this setting',
				'name'   => 'setting_code',
				'help'   => 'Additional information for the setting',
				'values' => $list,
				'xmlrpc' => True,
				'admin'  => False,
			)
		);
		return $settings;	// otherwise prefs say it cant find the file ;-)
	}
	
	static function home(){
	/**
	 * Cr�e l'�cran d'accueil avec les param�tres par d�faut
	 */
		if($GLOBALS['egw_info']['user']['preferences']['spidating']['mainscreen_show_spidating'])
		{
			$content =& ExecMethod('spidating.spidating_ui.home');
			$title="Tickets spidating";
			$portalbox =& CreateObject('phpgwapi.listbox',array(
				'title'	=> $title,
				'primary'	=> $GLOBALS['egw_info']['theme']['navbar_bg'],
				'secondary'	=> $GLOBALS['egw_info']['theme']['navbar_bg'],
				'tertiary'	=> $GLOBALS['egw_info']['theme']['navbar_bg'],
				'width'	=> '100%',
				'outerborderwidth'	=> '0',
				'header_background_image'	=> $GLOBALS['egw']->common->image('phpgwapi/templates/default','bg_filler')
			));
			$GLOBALS['egw_info']['flags']['app_header'] = $save_app_header;
			unset($save_app_header);

			$GLOBALS['portal_order'][] = $app_id = $GLOBALS['egw']->applications->name2id('spidating');
			foreach(array('up','down','close','question','edit') as $key)
			{
				$portalbox->set_controls($key,Array('url' => '/set_box.php', 'app' => $app_id));
			}
			$portalbox->data = Array();
			echo '<!-- BEGIN spidating info -->'."\n".$portalbox->draw($content)."\n".'<!-- END spidating info -->'."\n";
		}
		else
		{
			echo '<!-- BEGIN spidating info -->'."\nTU AS CHOISI DE NE RIEN AFFICHER\n".'<!-- END spidating info -->'."\n";
		}
	}

}
?>
