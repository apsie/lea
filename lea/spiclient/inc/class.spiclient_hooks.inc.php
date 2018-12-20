<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009 / 19/10/2011
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaClient - Ce logiciel est un programme informatique servant à la gestion de clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	

class spiclient_hooks
{

	static function search_link($location)
	{
	/**
	* Méthode initialisant les variables globales des clients, et les paramètres d'affichage de l'utilisateur
	*
	* NOTE : $location ne sert à rien
	* 
	* @param int $location paramètres locaux à charger
	* @return array
	*/
		$appname = 'spiclient';
		/* Récupération des droits d'accès ACL */
		$acl = CreateObject($appname.'.acl_'.$appname);
		
		// if($acl->allowClient){
			return array(
				'query' => 'spiclient.client_bo.link_query',
				'title' => 'spiclient.client_bo.link_title',
				'titles' => 'spiclient.client_bo.link_titles',
				'view'  => array(
					'menuaction' => 'spiclient.client_ui.edit',
				),
				'view_id' => 'id',
				'view_popup'  => '950x600',
				'add' => array(
					'menuaction' => 'spiclient.client_ui.edit',
				),
				'add_app'    => 'link_app',
				'add_id'     => 'link_id',
				'add_popup'  => '950x600',
			);
		// }else{
			// return null;
		// }
	}

	static function all_hooks($args){
	/**
	* Méthode initialisant les variables globales des tickets et chargeant les préférences paramétrées.
	* Permet aussi d'afficher le menu et de créer des liens dirigés vers son contenu
	*
	* \version BBO - 07/09/2010 - Les menu de configuration ont été séparés pour accélérer l'affichage du panneau de configuration
	*
	* @param array $args tableau contenant l'index location définissant l'endroit où l'utilisateur se trouve : spiclient menu,spiclient,admin,... (on en déduit ainsi les paramètres à afficher)
	*/
		$appname = 'spiclient';
		$location = is_array($args) ? $args['location'] : $args;

		$config = CreateObject('phpgwapi.config','spiclient');
		$obj_config = $config->read_repository('spiclient');
		
		/* Récupération des droits d'accès ACL */
		// $create_ticket = EGW_ACL_ADD;
		// $update_ticket = EGW_ACL_EDIT;
		// $close_ticket = EGW_ACL_CUSTOM_1;
		// $create_invoce = EGW_ACL_CUSTOM_2;
		// $read_invoce = EGW_ACL_CUSTOM_3;
		/* Récupération des préférences paramétrées */
		
		/* Spirea YLF - Gestion des droits */
		$acl = new acl_spiclient();
		
		if ($location == 'sidebox_menu'){
			$file = array();
			display_sidebox($appname,$GLOBALS['egw_info']['apps'][$appname]['title'].' '.lang('Menu'),$file);
		}
		if ($acl->allowClient && $location != 'admin' && $location != 'spiclient'  && $location != 'preferences'){
			$file = array();
			if($acl->allowAddClient){
				$file['New organization'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spiclient.client_ui.edit'),false)."','_blank',950,600,'yes')";

				if($obj_config['show_quickadd']){
					$file['Quick add'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spiclient.client_ui.quick_add'),false)."','_blank',950,600,'yes')";	
				}			
			}
			if($acl->allAccessClient){
				$file['My clients']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myclients'); // clients
				$file['My leads']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myleads'); // prospects
				$file['My organizations']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myorgs'); // mes org
				$file['All organizations']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index'); // tous...
			}elseif($acl->ownAccessClient){
				$file['My clients']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myclients');
				$file['My leads']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myleads'); // prospects
				$file['My organizations']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.index&filter=myorgs'); // prospects
			}

			if ($location == 'Clients menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Clients menu'),$file);
			}
		}
		
		if ($acl->allowContrat && $location != 'admin' && $location != 'spiclient'  && $location != 'preferences'){
			$file = array();
			if($acl->allowAddContrat){
				$file['New contract'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spiclient.contrat_ui.edit'),false)."','_blank',930,600,'yes')";
			}
			
			if($acl->allAccessContrat){
				$file['My active contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index&filter=mycontracts');
				$file['Active contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index&filter=active');
				$file['Renewed contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index&filter=renew');
				$file['Ended contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index&filter=end');
				$file['All contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index');
			}elseif($acl->ownAccessContrat){
				$file['My active contracts']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.contrat_ui.index&filter=myccontracts');
			}
			
			
			if ($location == 'Contracts menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Contracts menu'),$file);
			}
		}	
	
		// il faut être gestionnaire pour avoir accès au menu configuration
		
		if ($acl->admin && $location != 'preferences' && $location != 'spiclient'){
			$file = array();
			
			$file['Contract Type Configuration']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.typecontrat_ui.index');
			$file['Contract Status Configuration']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.statutcontrat_ui.index');
			$file['Locations']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.location_ui.index');
			$file['Sectors']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.sector_ui.index');
			$file['Payment method']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.mode_reglement_ui.index');
			$file['Delay payment']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.delai_paiement_ui.index');
			
			$file['Areas']=$GLOBALS['egw']->link('/index.php','menuaction=spireapi.area_ui.index&appname='.$appname);

			$file['Role']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.role_ui.index');
			$file['Client type']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.typeclient_ui.index');
			$file['Technical nature']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.nature_ui.index');

			if ($location == 'Configuration'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Configuration'),$file);
			}
		}

		if ($acl->admin && $location != 'preferences' && $location != 'spiclient'){
			$file = array();
			
			$file['Import client'] = $GLOBALS['egw']->link('/index.php','menuaction=spiclient.spiclient_admin.import_client');

			$file['Import contact'] = $GLOBALS['egw']->link('/index.php','menuaction=spiclient.spiclient_admin.import_contact');
			
			if ($location == 'Import'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Import'),$file);
			}
		}
		
		// il faut être admin pour avoir accès au menu admin
		if ($GLOBALS['egw_info']['user']['apps']['admin'] && $location != 'preferences' && $location != 'spiclient'){
		//if ($acl->admin && $location != 'preferences' && $location != 'spiclient'){
			$file = array();
			$file['General']=$GLOBALS['egw']->link('/index.php',array('menuaction' => 'spiclient.spiclient_admin.general'));
			$file['Help'] = $GLOBALS['egw']->link('/index.php','menuaction=spiclient.spiclient_admin.help');

			$file['Asynchronous services']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.spiclient_admin.async');

			// On se trouve dans l'admin on affiche seulement le lien vers la configuration general
			if($location != 'admin'){
				$file['New group']=array(
						'text' => '<a class="textSidebox" href="'.$GLOBALS['egw']->link('/index.php',array('menuaction' => 'admin.uiaccounts.add_group')).
						'" onclick="window.open(this.href,\'_blank\',\'dependent=yes,width=930,height=700,scrollbars=yes,status=yes\');
						return false;">'.lang('New group').'</a>',
						'no_lang' => true,
						'link' => false,
					);
				$file['New user']=array(
						'text' => '<a class="textSidebox" href="'.$GLOBALS['egw']->link('/index.php',array('menuaction' => 'admin.uiaccounts.add_user')).
						'" onclick="window.open(this.href,\'_blank\',\'dependent=yes,width=930,height=700,scrollbars=yes,status=yes\');
						return false;">'.lang('New user').'</a>',
						'no_lang' => true,
						'link' => false,
					);
			}
			if ($location == 'admin'){
				display_section($appname,$file);
			}else{
				// display_sidebox($appname,lang('Admin'),$file);
				display_sidebox($appname,lang('Admin'),$file,'admin');
			}
		}
		if ($location != 'admin' && $location != 'preferences' && $location != 'spiclient'){
			$file = array();
			$file[lang('About').' Spiclient']=$GLOBALS['egw']->link('/index.php','menuaction=spiclient.client_ui.about');
			// $file[lang('User Manual')]='<a href =http://www.spirea.fr/fileadmin/Documentations/spiclient/SPI_EGW_USER_APP_SPICLIENT_DOC_FR.pdf>doc</a>';
			
		
			$file[lang('User Manual')] = array(
						'text' => '<a class="textSidebox" href="http://www.spirea.fr/fileadmin/Documentations/spiclient/SPI_EGW_USER_APP_SPICLIENT_DOC_FR.pdf">'.lang('User Manual').'</a>',
						'no_lang' => false,
						'link' => false,
					);
			
			$file[lang('License').' Spiclient']=$GLOBALS['egw']->link('/spiclient/about/Licence_spiclient_fr.pdf');
			display_sidebox($appname,lang('About').' Spiclient',$file);
			
		}
		
	}
	
	static function settings(){
	 /**
	 * NOTE : Fonction obligatoire pour la version EGW 1.9 
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

	/**
	 * Check if reasonable default preferences are set and set them if not
	 *
	 * It sets a flag in the app-session-data to be called only once per session
	 */
	static function check_set_default_prefs(){
	/**
	 * Vérifie et applique les paramètres de session comme paramètres par défaut.
	 *
	 * NOTE : La fonction ne retourne pas toujours une valeur ...
	 * 
	 * @return boolean
	 */
	}
	
	static function home()
	{
	/**
	 * Crée l'écran d'acceuil avec les paramètres par défaut
	 */
		if($GLOBALS['egw_info']['user']['preferences']['spiclient']['mainscreen_show_spiclient'])
		{
			$content =& ExecMethod('spiclient.client_ui.home');
			$title="Tickets spiclient";
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

			$GLOBALS['portal_order'][] = $app_id = $GLOBALS['egw']->applications->name2id('spiclient');
			foreach(array('up','down','close','question','edit') as $key)
			{
				$portalbox->set_controls($key,Array('url' => '/set_box.php', 'app' => $app_id));
			}
			$portalbox->data = Array();
			echo '<!-- BEGIN spiclient info -->'."\n".$portalbox->draw($content)."\n".'<!-- END spiclient info -->'."\n";
		}
		else
		{
			echo '<!-- BEGIN spiclient info -->'."\nLE CHOIX EST FAIT DE NE RIEN AFFICHER\n".'<!-- END spiclient info -->'."\n";
		}
	}

}
?>
