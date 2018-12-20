<?php
/**	spifina : SpireaDemandes
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
class spifina_hooks
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
		$appname = 'spifina';

		return array(
			'query' => 'spifina.spifina_bo.link_query',
			'title' => 'spifina.spifina_bo.link_title',
			'titles' => 'spifina.spifina_bo.link_titles',
			'view'  => array(
				'menuaction' => 'spifina.spifina_ui.edit',
			),
			'view_id' => 'id',
			'view_popup'  => '1100x800',
			'add' => array(
				'menuaction' => 'spifina.spifina_ui.edit',
			),
			'add_app'    => 'link_app',
			'add_id'     => 'link_id',
			'add_popup'  => '1100x800',
			'file_access' => 'spifina.spifina_bo.file_access',
		);
	}

	static function all_hooks($args){
	/**
	* Méthode initialisant les variables globales des tickets et chargeant les préférences paramétrées.
	* Permet aussi d'afficher le menu et de créer des liens dirigés vers son contenu
	*
	* \version BBO - 07/09/2010 - Les menu de configuration ont été séparés pour accélérer l'affichage du panneau de configuration
	*
	* @param array $args tableau contenant l'index location définissant l'endroit où l'utilisateur se trouve : spifina menu,spifina,admin,... (on en déduit ainsi les paramètres à afficher)
	*/
		$appname = 'spifina';
		$location = is_array($args) ? $args['location'] : $args;
		
		$config = CreateObject('phpgwapi.config');
		$obj_config = $config->read('spifina');

		$userGroups = $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']);
		$is_admin = isset($GLOBALS['egw_info']['user']['apps']['admin']) || array_key_exists($obj_config['management_group'], $userGroups);
		
		if ($GLOBALS['egw_info']['user']['apps']['spifina'] && $location != 'admin' && $location != 'spifina'  && $location != 'preferences'){
			$file = array();
			if($is_admin){
				$file['New invoice'] = "javascript:egw_openWindowCentered2('".egw::link('/index.php',array('menuaction' => 'spifina.spifina_ui.edit'),false)."','_blank',1100,800,'yes')";
				$file['Non validated invoices']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.index&filter=viewnonvalidated');
			}

			$file['Validated invoices']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.index');
			$file['All invoices']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.index&filter=viewall');

			if($is_admin){
				$file['Accounting export']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.accounting_export');
				$file['Invoice customised lines']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.line_ui.index');
			}

			if ($location == 'Invoicing menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Invoicing menu'),$file);
			}
		}

		if($is_admin && $GLOBALS['egw_info']['user']['apps']['spifina'] && $location != 'admin' && $location != 'spifina'  && $location != 'preferences'){
			$file['VAT / Collect']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.collect');
			$file['Unpayed invoices']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.index&filter=unpayed');	
			$file['Reminders']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.index&filter=remind');

			if ($location == 'Collecting'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Invoicing menu'),$file);
			}
		}

		if ($is_admin && $GLOBALS['egw_info']['apps']['spid'] && $location != 'admin' && $location != 'spifina'  && $location != 'preferences'){
			$file = array();
			$file['Client statistics']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.index');
			$file['Intervenant statistics']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_intervenant');
			$file['Group statistics']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_group');
			$file['Contract statistics']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_contrat');
			$file['Activity monitoring']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.suivi_activite');
			$file['Tickets per intervenant']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_ticket_intervenant');

			if ($location == 'Statistic menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Spid statistics'),$file);
			}
		}

		if ($is_admin && $location != 'admin' && $location != 'spifina'  && $location != 'preferences'){
			$file = array();
			$file['Client CA']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_caclient');
			$file['Intervenant CA']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_caintervenant');
			$file['Contract CA']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.stats_cacontrat');
			$file['Contract detail']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.contract_detail');
			$file['Contract summary']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_ui.contract_summary');
			
			$file['Monthly category stat']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.stats_charts_ui.show');

			if ($location == 'Statistic turnover menu'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Statistic turnover menu'),$file);
			}
		}

		if ($is_admin && $location != 'preferences' && $location != 'spid'){
			$file = array();

			if($GLOBALS['egw_info']['user']['apps']['admin']){
				$file['General']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_admin.general');
			}

			if ($location == 'admin'){
				display_section($appname,$file);
			}else{
				display_sidebox($appname,lang('Admin'),$file);
			}
		}

		if ($location != 'admin' && $location != 'preferences' && $location != 'spifina'){
			$file = array();
			$file[lang('About').' spifina']=$GLOBALS['egw']->link('/index.php','menuaction=spifina.spifina_ui.about');
			$file[lang('License').' spifina']=$GLOBALS['egw']->link('/spifina/about/Licence_spifina_fr.pdf');
			display_sidebox($appname,lang('About').' spifina',$file);
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
			'mainscreen_show_spifina' => array(
				'type'   => 'select',
				'label'  => 'show default view on main screen',
				'name'   => 'mainscreen_show_spifina',
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
		if ($GLOBALS['egw']->session->appsession('default_prefs_set','spifina'))
		{
			return;
		}
		$GLOBALS['egw']->session->appsession('default_prefs_set','spifina','set');

		$default_prefs =& $GLOBALS['egw']->preferences->default['spifina'];

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
				$GLOBALS['egw']->preferences->add('spifina',$var,$default,'default');
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
		if($GLOBALS['egw_info']['user']['preferences']['spifina']['mainscreen_show_spifina'])
		{
			$content =& ExecMethod('spifina.spifina_ui.home');
			$title="Tickets spifina";
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

			$GLOBALS['portal_order'][] = $app_id = $GLOBALS['egw']->applications->name2id('spifina');
			foreach(array('up','down','close','question','edit') as $key)
			{
				$portalbox->set_controls($key,Array('url' => '/set_box.php', 'app' => $app_id));
			}
			$portalbox->data = Array();
			echo '<!-- BEGIN spifina info -->'."\n".$portalbox->draw($content)."\n".'<!-- END spifina info -->'."\n";
		}
		else
		{
			echo '<!-- BEGIN spifina info -->'."\nTU AS CHOISI DE NE RIEN AFFICHER\n".'<!-- END spifina info -->'."\n";
		}
	}

}
?>
