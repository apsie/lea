<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009->2012
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.admin_bo.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.vat_bo.inc.php');

class spid_admin extends admin_bo
{
	var $public_functions = array(
		'index' 		=> true,
		'general' 		=> true,
		'categories' 	=> true,
		'states' 		=> true,
		'edit_states' 	=> true,
		'transitions' 	=> true,
		'responses' 	=> true,
		'mail'			=> true,
		'intervenants'	=> true,
		'rdv_lien'	=> true,
	);

	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales. Vérifie si l'utilisateur a les droits d'administration
		*
		* \version 	BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spid
		*/
		
		/// Récupération du niveau de droit (2 : gestionnaire / 99 : admin)
		$spid_ui = new spid_ui();
		if(!isset($GLOBALS['egw_info']['user']['SpidLevel'])){
			$GLOBALS['egw_info']['user']['SpidLevel'] = $spid_ui->isTechnicianOrManagerOrCustomer();
		}
		
		if ($GLOBALS['egw_info']['user']['SpidLevel'] < 50 ){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  __construct - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
			return;
		}
		parent::__construct();

		$this->prefs =& $GLOBALS['egw_info']['user']['preferences']['spid'];
		// $this->obj_js =& CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script_thirst'].=$this->write_js();
		
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
		$GLOBALS['egw_info']['flags']['java_script_thirst'].=$javascript."\n";
		
	}
	
	function spid_admin(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function write_js(){
		/**
		* NOTE : Fonction... inutile
		*/
		return "";
	}
	
	function index($content=null,$msg=''){	
		/**
		* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates
		*
		* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
		* @param string $msg='' message de chaque contenu. Résultat des mises à jour ou suppression, valeur par défaut passée en argument
		*/
		
		$tabs = 'general|cats|states|transitions|cannedResponse|mail';
		$spid = (int) $spid['spid']; 
		$msg='';
		$last_array=array();
		$maj = array();
		$tab_cle = array('state_name','name');
		if(is_array($content)){
			list($button) = @each($content['button']);
			foreach($content as $tab => $nom){
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
						break;
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
			}
		}
		$content = $this->get_content();
		
		$sel_options = $this->get_selection();
		
		$readonlys = array(
			'button[delete]' => !$spid,
			'delete[0]' => true,
		);
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		// retrait du & pour éviter erreur php
		//$tpl=& new etemplate('spid.admin.index');
		$tpl= new etemplate('spid.admin.index');
		$tpl->exec('spid.spid_admin.index',$content,$sel_options,$readonlys,$content);
		echo '<script type="text/javascript">ajax_request.LoadingInProgress();</script>';
	}
	
	function get_selection(){
		$sel_options = array(
			'data' 					=> $this->autoassign,
			'state_close' 			=> $this->state_close,
			'state_initial' 		=> $this->state_initial,
			'state_billable' 		=> $this->state_billable,
			'source_id' 			=> $this->get_transition_etat(),
			'target_id' 			=> $this->get_transition_etat(),
			'default_state_id' 		=> $this->get_default_etat(),
			'ticket_assigned_to'	=> $general['ticket_assigned_to'],
			'cat_assignedto'		=> $this->get_account_actif(),
			'ticket_assigned_to'	=> $this->get_account_actif(),
			'close_ticket'			=> $this->state_close,
			'state_id'				=> $this->get_transition_etat(),
			'default_cat'			=> $this->get_cal_cat(),
			'possible_select'		=> array(
										''	=> 'Select one',
										'1'	=> 'Yes',
										'0'	=> 'No',
									),
			'unit_time'				=> $this->get_unit_time(),
			'stat_unit_time'		=> $this->get_unit_time(),
			'confirmed_intervention'=> $this->get_cal_cat(),
			'realised_intervention'	=> $this->get_cal_cat(),
			'option_intervention'	=> $this->get_cal_cat(),
			'ticket_management_user'=> $this->get_user_group($this->obj_config['ticket_management_group']),
			'invoice_model'			=> $this->get_models(),
			'cat_managementgroup' 	=> $this->get_providers(),
			'etat_enfant'			=> $this->get_enfant_possible(),
			'state_auto_id'			=> $this->get_enfant_possible(),

			'sale_account'			=> $this->get_account(),
			'sales_book'			=> $this->get_book(),
			'sales_account'			=> $this->get_account(),
			'sales_collective_account'=> $this->get_account(),
			'account_export_model'	=> $this->get_accounting_export(),
			
			'assistant_frequency' 	=> array('' => lang('Month'), 'W' => lang('Week')),

			'default_vat'			=> vat_bo::get_vat(),
		);
		return $sel_options;
	}
	function get_content(){
		$general=$this->obj_config;
		
		$content = array(
			'msg'         => $msg,
			'spid'        => $spid,
			$tabs         => $content[$tabs],
			'cats'		  => $this->get_cat(),
			'responses'	  => $this->get_reponse_standard(),
			'states'      => $this->get_etat(),
			'transitions' => $this->get_transition(),
			'general' 	  => $general,
			'mail' => array( 
				'mail_content' => $this->get_mail(),
			),
			'intervenants' => $this->get_intervenant(),
		);
		$content['label_time']='('.$general['initial_time_minute'].'mn)';
		$content['default_state_id']=$general['default_state_id'];
		return $content;
	}
	
	function general($content=null)
	{
		/**
		* Charge l'e-template général, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript
		*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			foreach($content as $tab => $nom){
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
						break;
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
			}
		}
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		$tpl= new etemplate('spid.admin.index.general');
		$tpl->exec('spid.spid_admin.general',$content,$sel_options,$readonlys,$content);
	}
	
	function categories($content=null)
	{
		/**
		* Charge l'e-template des catégories, l'exécute avec les paramètres données, charge les requêtes ajax et le javascript
		*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			$nom = $content['cats'];
			$tab = 'cats';
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
		}
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		//$tpl=& new etemplate('spid.admin.index.cats');
		$tpl= new etemplate('spid.admin.index.cats');
		$tpl->exec('spid.spid_admin.categories',$content,$sel_options,$readonlys,$content);
	}
	
	function edit_states($content = null){
	/**
	 * Charge le template de la page edit
	 *
	 *
	 */
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
					$msg = $this->add_update_state($content);
					echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					break;
			}
		}else{
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			}else{
				$id='';
				
			}
		}
		if(isset($id)){
			$content = array(
				'msg'         => $msg,
			);
			if(empty($id)){
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add nomenclature');
				$content['nomenclature_actif'] = true;
			}else{
				$content += $this->get_state($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit nomenclature');	
			}
		}

		$sel_options = $this->get_selection();
		
		$tpl = new etemplate('spid.admin.index.states.edit');
		$tpl->exec('spid.spid_admin.edit_states', $content, $sel_options, $readonlys, $content,2);
	}
	
	function states($content=null){
	/**
	 * Charge l'e-template des états, l'exécute avec les parmètres donnés, charge les requêtes ajax et le javascript
	 */
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
		}
		
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			
			$this->so_transitions->delete(array('source_id' => $id));
			if($this->so_etats->delete($id)){
				$msg = lang('State deleted');
			}
			unset($content['nm']['rows']['delete']);
		}
		
		if (!is_array($content['nm']))
		{
			$default_cols='state_name, state_description, state_close, state_initial, state_billable, facturation_label, ';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.admin_bo.get_states',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'no_filter'			=> true,
				'no_filter2'		=> true,
				'options-cat_id' 	=> false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'state_name',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=>	lang(''),	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=> false,
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}
		
		$sel_options = $this->get_selection();

		$tpl = new etemplate('spid.admin.index.states');
		$content['nm']['header_right'] = 'spid.admin.index.states.right';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		
		$content['msg'] = $msg;
		
		$tpl->read('spid.admin.index.states');
		$tpl->exec('spid.spid_admin.states', $content, $sel_options, $readonlys, array('nm' => $content['nm']));		
	}
	
	function transitions($content=null)
	{
		/**
		* Charge l'e-template des transitions, l'exécute avec les parmètres donnés, charge les requêtes ajax et le javascript. Application de filtres avant exécution
		*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			foreach($content as $tab => $nom){
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
						break;
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
			}
		}		$content = $this->get_content();
		$sel_options = $this->get_selection();
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		// tch - retrait du & pour éviter erreur php
		// $tpl=& new etemplate('spid.admin.index.transitions');
		$tpl= new etemplate('spid.admin.index.transitions');
		$tpl->exec('spid.spid_admin.transitions',$content,$sel_options,$readonlys,$content);
	}
	
	function responses($content=null)
	{
		/**
		* Charge l'e-template des réponses, l'exécute avec les parmètres donnés, charge les requêtes ajax et le javascript
		*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			foreach($content as $tab => $nom){
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
						break;
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
			}
		}
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		//$tpl=& new etemplate('spid.admin.index.cannedResponse');
		$tpl= new etemplate('spid.admin.index.cannedResponse');
		$tpl->exec('spid.spid_admin.responses',$content,$sel_options,$readonlys,$content);
	}	
	
	function mail($content=null){
		/**
		 * Charge l'e-template des mails, l'éxécute avec les parmètres donnés, charge les requêtes ajax et le javascript
		 */
		if(is_array($content)){
			list($button) = @each($content['button']);
			foreach($content as $tab => $nom){
				if($this->verification==true){
					if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
						$id_del=array_keys($nom['delete']);
						$msg=$this->delete_config($id_del[0],$tab);
						break;
					}
					switch($button){
						case 'save':
							$content[$tabs]='';
						case 'apply':
							$msg=$this->add_update_config($tab,$nom);
							break;
						default:
						case 'cancel':
							$content=array();
							break;
					}
				}else{
					break;
				}
			}
		}
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		// tch - retrait du & pour éviter erreur php
		// $tpl=& new etemplate('spid.admin.index.mail');
		$tpl= new etemplate('spid.admin.index.mail');
		$tpl->exec('spid.spid_admin.mail',$content,$sel_options,$readonlys,$content);
		echo '<script type="text/javascript">ajax_request.LoadingInProgress();</script>';
	}
	
	function intervenants($content=null){
	/**
	 * Charge l'e-template intervenant, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript
	 */
		if(is_array($content)){
			list($button) = @each($content['button']);
			$nom = $content['intervenants'];
			$tab = 'intervenants';
			if($this->verification==true){
				if(isset($nom['delete']) && !empty($nom['delete']) && is_array($nom['delete'])){
					$id_del=array_keys($nom['delete']);
					$msg=$this->delete_config($id_del[0],$tab);
				}
				switch($button){
					case 'save':
						$content[$tabs]='';
					case 'apply':
						$msg=$this->add_update_config($tab,$nom);
						break;
					default:
					case 'cancel':
						$content=array();
						break;
				}
			}else{
				break;
			}
		}
		$onload.="Dialog.okCallback()";
		$GLOBALS['egw']->js->set_onload($onload);
		$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		// tch - retrait du & pour éviter erreur php
		//$tpl=& new etemplate('spid.admin.index.intervenant');
		$tpl= new etemplate('spid.admin.index.intervenant');
		$tpl->exec('spid.spid_admin.intervenants',$content,$sel_options,$readonlys,$content);
	}
	
	function rdv_lien(){
	/**
	 * Charge l'e-template rdv_lien pour appel de la fonction recup_rdv_lien dans la classe admin_bo
	 */
		$content['msg'] = $this->recup_rdv_lien();

		$tpl= new etemplate('spid.admin.rdv_lien');
		$tpl->exec('spid.spid_admin.rdv_lien',$content,$sel_options,$readonlys,$content);
	}
}

?>
