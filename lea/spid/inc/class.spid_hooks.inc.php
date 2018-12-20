<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009->Juillet 2012
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
class spid_hooks
{

	static function search_link($location)
	{
	/**
	* Méthode initialisant les variables globales des tickets, et les paramètres d'affichage de l'utilisateur
	*
	* NOTE : $location ne sert à rien
	* 
	* @param int $location paramètres locaux à charger
	* @return array
	*/
		$appname = 'spid';
		/* Récupération des droits d'accès ACL */
		$create_ticket=EGW_ACL_ADD;
		$update_ticket=EGW_ACL_EDIT;
		$close_ticket=EGW_ACL_CUSTOM_1;
		$create_invoce=EGW_ACL_CUSTOM_2;
		$read_invoce=EGW_ACL_CUSTOM_3;
		$acl =& CreateObject($appname.'.acl_'.$appname);
		$tab_acl=$acl->getACL();
		
		if($tab_acl[EGW_ACL_ADD]){
			return array(
				'query' => 'spid.spid_bo.link_query',
				'title' => 'spid.spid_bo.link_title',
				'titles' => 'spid.spid_bo.link_titles',
				'view'  => array(
					'menuaction' => 'spid.spid_ui.edit',
				),
				'view_id' => 'id',
				'view_popup'  => '930x700',
				'add' => array(
					'menuaction' => 'spid.spid_ui.edit',
				),
				'add_app'    => 'link_app',
				'add_id'     => 'link_id',
				'add_popup'  => '930x700',

				'file_access' => 'spid.spid_bo.file_access',
			);
		}else{
			return null;
		}
	}

	static function all_hooks($args){
	/**
	* Méthode initialisant les variables globales des tickets et chargeant les préférences paramétrées.
	* Permet aussi d'afficher le menu et de créer des liens dirigés vers son contenu
	*
	* \version BBO - 07/09/2010 - Les menu de configuration ont été séparés pour accélérer l'affichage du panneau de configuration
	*
	* @param array $args tableau contenant l'index location définissant l'endroit où l'utilisateur se trouve : spid menu,spid,admin,... (on en déduit ainsi les paramètres à afficher)
	*/
		$appname = 'spid';
		$location = is_array($args) ? $args['location'] : $args;
		
		/* Récupération des droits d'accès ACL */
		$create_ticket=EGW_ACL_ADD;
		$update_ticket=EGW_ACL_EDIT;
		$close_ticket=EGW_ACL_CUSTOM_1;
		$create_invoce=EGW_ACL_CUSTOM_2;
		$read_invoce=EGW_ACL_CUSTOM_3;
		$acl =& CreateObject($appname.'.acl_'.$appname);
		$tab_acl=$acl->getACL();
		
		$spid_ui = new spid_ui();
		if(!isset($GLOBALS['egw_info']['user']['SpidLevel'])){
			$GLOBALS['egw_info']['user']['SpidLevel'] = $spid_ui->isTechnicianOrManagerOrCustomer();
		}
		//_debug_array($GLOBALS['egw_info']['user']['SpidLevel']);
		
		/* Récupération des préférences paramétrées */
		
		if ($location == 'sidebox_menu'){
			$file = array();
			display_sidebox($appname,$GLOBALS['egw_info']['apps'][$appname]['title'].' '.lang('Menu'),$file);
		}
		if ($GLOBALS['egw_info']['user']['apps']['spid'] && $location != 'admin' && $location != 'preferences'){
			$file = array();
			
			if($tab_acl[EGW_ACL_ADD]){
				$file['New ticket'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spid.spid_ui.edit'),false)."','_blank',930,700,'yes')";
			}

			$file['All tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewall');
			$file['All open tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewopen');
			$file['Closed tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewclosed');
			//Spirea-BBO - 17/06/2010 - Ajout d'un lien pour voir les tickets fermés non facturés
			if($tab_acl[EGW_ACL_CUSTOM_3]){
				$file['Closed tickets not invoiced']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewnotinvoicing');
			}
			$file['My open tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewmyopen');
			$file['My assigned tickets']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=viewmyassigned');
			// $file['Locations']=$GLOBALS['egw']->link('/index.php','menuaction=spid.location_ui.index&view=1');
			$file['Advanced search'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spid.spid_ui.search'),false)."','_blank',500,300,'yes')";
			$file['Reset all criterias']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.index&filter=reset');
			
			// Assistant uniquement pour technicien et gestionnaire
			if($GLOBALS['egw_info']['user']['SpidLevel'] >= 1){
				$file['Creation ticket assistant'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spid.spid_ui.assistant'),false)."','_blank',930,500,'yes')";
			}
			//}
			if ($location == 'spid menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Spid Menu'),$file);
			}
		}
		
		if (($GLOBALS['egw_info']['user']['apps']['admin'] ||  $GLOBALS['egw_info']['user']['SpidLevel'] == 2)&& $location != 'preferences' && $location != 'spid'){
			$file = array();

			if($GLOBALS['egw_info']['user']['apps']['admin']){
				$file['General']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.general');
				$file['Categories']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.categories');
				$file['States']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.states');
				$file['Responses']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.responses');
				$file['Mail']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.mail');
				// $file['Invoice Categories'] = $GLOBALS['egw']->link('/index.php','menuaction=spid.facture_categories_ui.index');
				// $file['Manage ACL']=$GLOBALS['egw']->link('/index.php','menuaction=preferences.uiaclprefs.index&acl_app=spid');
			}

			$file['Client prices']=$GLOBALS['egw']->link('/index.php','menuaction=spid.prix_ui.index_price');
			$file['Contract prices']=$GLOBALS['egw']->link('/index.php','menuaction=spid.prix_ui.index_contract');

			// $file['Intervenants']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.intervenants');

			$file['Link meetings']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_admin.rdv_lien');
			
			if ($location == 'admin'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Admin'),$file);
			}
		}
		if ($location != 'admin' && $location != 'preferences' && $location != 'spid'){
			$file = array();
			$file[lang('About').' spid']=$GLOBALS['egw']->link('/index.php','menuaction=spid.spid_ui.about');
			$file[lang('License').' spid']=$GLOBALS['egw']->link('/spid/about/Licence_spid_fr.pdf');
			display_sidebox($appname,lang('About').' Spid',$file);
		}
		
	}
	
	static function settings(){
	 /**
	 * charge les préférences dans $GLOBALS['settings']
	 *
	 * \version BBO - 03/08/2010 - Couleur d'un ticket non lu
	 *
	 * \version BBO - 03/08/2010 - Couleur d'un ticket important (niveau 10)
	 *
	 * \version BBO - 03/08/2010 - Couleur d'un problème sur le client
	 * 
	 * \version BBO - 03/08/2010 - Couleur d'un client en sommeil
	 *
	 * \version BBO - 03/08/2010 - Ajout d'une préférence pour paramètrer le message qui sera envoyé avec la facture
	 *
	 * NOTE : la fonction retourne toujours true
	 *
	 * @return boolean
	 */
		$messageParDefaut='Bonjour,

Veuillez trouver ci-joint les factures de fin de mois :
	- la maintenance et les tickets de demande
			
Les différentes factures et les tickets sont consultables sur notre site intranet - intra.spirea.fr.
		
N\'hésitez pas à nous contacter pour toute question.
		
Cordialement,';
		
		$GLOBALS['settings'] = array(
			'notify_creator' => array(
				'type'   => 'check',
				'label'  => 'Receive notifications about created tickets',
				'name'   => 'notify_creator',
				'help'   => 'Would you receive notification mails, if tickets you created get updated?',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'notify_assigned' => array(
				'type'   => 'check',
				'label'  => 'Receive notifications about assigned tickets',
				'name'   => 'notify_assigned',
				'help'   => 'Would you receive you notification mails, if tickets assigned to you get updated?',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'ticket_not_view' => array(
				'type'   => 'input',
				'label'  => 'Couleur de surbrillance pour les tickets non vu',
				'name'   => 'ticket_not_view',
				'help'   => 'De quels couleur souhaitez-vous voir les tickets non vu?',
				'default' => '#dababa',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'ticket_important' => array(
				'type'   => 'input',
				'label'  => 'Couleur de surbrillance pour les tickets urgent',
				'name'   => 'ticket_important',
				'help'   => 'De quels couleur souhaitez-vous voir les tickets urgent?',
				'default' => '#da7a7a',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'client_sommeil' => array(
				'type'   => 'input',
				'label'  => 'Couleur de surbrillance pour les clients en sommeil',
				'name'   => 'client_sommeil',
				'help'   => 'De quels couleur souhaitez-vous voir les clients en sommeil?',
				'default' => '#da7a7a',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'client_probleme' => array(
				'type'   => 'input',
				'label'  => 'Couleur de surbrillance pour les clients ayant un problème de configuration',
				'name'   => 'client_probleme',
				'help'   => 'De quels couleur souhaitez-vous voir les clients ayant un problème de configuration?',
				'default' => '#da7a7a',
				'xmlrpc' => True,
				'admin'  => False,
			),
			'invoice_email' => array(
				'type'   => 'text',
				'label'  => 'Message with invoice when you send them by email',
				'name'   => 'invoice_email',
				'rows'   => 10,
				'cols'   => 50,
				'help'   => 'This message is join by mail when you send your bills by email.',
				'default' => $messageParDefaut,
				'xmlrpc' => True,
				'admin'  => False
			),
			'mainscreen_show_spid' => array(
				'type'   => 'select',
				'label'  => 'show default view on main screen',
				'name'   => 'mainscreen_show_spid',
				'values' => array(
								'1' => lang('Yes'),
								'0' => lang('No'),
							),
				'help'   => 'Displays your default calendar view on the startpage (page you get when you enter eGroupWare or click on the homepage icon)?',
				'xmlrpc' => True,
				'admin'  => False
			),
		);
		return true;	// otherwise prefs say it cant find the file ;-)
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
		if ($GLOBALS['egw']->session->appsession('default_prefs_set','spid'))
		{
			return;
		}
		$GLOBALS['egw']->session->appsession('default_prefs_set','spid','set');

		$default_prefs =& $GLOBALS['egw']->preferences->default['spid'];

		$defaults = array(
			'notify_creator'  => 1,
			'notify_assigned' => 1,
			'ticket_not_view'  => 1,
			'ticket_important' => 1,
			'client_probleme' => 1,
			'client_sommeil' => 1,
			/*'show_actions' => 1,
			'notify_own_modification' => 0,*/
		);
		foreach($defaults as $var => $default)
		{
			if (!isset($default_prefs[$var]) || $default_prefs[$var] === '')
			{
				$GLOBALS['egw']->preferences->add('spid',$var,$default,'default');
				$need_save = True;
			}
		}
		if ($need_save)
		{
			$GLOBALS['egw']->preferences->save_repository(False,'default');
		}
	}
	
	static function home()
	{
	/**
	 * Crée l'écran d'acceuil avec les paramètres par défaut
	 */
		if($GLOBALS['egw_info']['user']['preferences']['spid']['mainscreen_show_spid'])
		{
			$content =& ExecMethod('spid.spid_ui.home');
			$title="Tickets SPID";
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

			$GLOBALS['portal_order'][] = $app_id = $GLOBALS['egw']->applications->name2id('spid');
			foreach(array('up','down','close','question','edit') as $key)
			{
				$portalbox->set_controls($key,Array('url' => '/set_box.php', 'app' => $app_id));
			}
			$portalbox->data = Array();
			echo '<!-- BEGIN SPID info -->'."\n".$portalbox->draw($content)."\n".'<!-- END SPID info -->'."\n";
		}
		else
		{
			echo '<!-- BEGIN SPID info -->'."\nTU AS CHOISI DE NE RIEN AFFICHER\n".'<!-- END SPID info -->'."\n";
		}
	}

}
?>
