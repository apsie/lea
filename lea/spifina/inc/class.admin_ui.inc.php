<?php
/**	spifina : SpireaDemandes
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
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.admin_bo.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.vat_bo.inc.php');

class admin_ui extends admin_bo
{
	var $public_functions = array(
		'general' 		=> true,
	);

	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales. Vérifie si l'utilisateur a les droits d'administration
		*
		* \version 	BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spifina
		*/
		parent::__construct();
	}
	
	function admin_ui(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function get_selection(){
		$sel_options = array(
			// 'data' 					=> $this->autoassign,
			// 'state_close' 			=> $this->state_close,
			// 'state_initial' 		=> $this->state_initial,
			// 'state_billable' 		=> $this->state_billable,
			// 'source_id' 			=> $this->get_transition_etat(),
			// 'target_id' 			=> $this->get_transition_etat(),
			// 'default_state_id' 		=> $this->get_default_etat(),
			// 'ticket_assigned_to'	=> $general['ticket_assigned_to'],
			// 'cat_assignedto'		=> $this->get_account_actif(),
			// 'ticket_assigned_to'	=> $this->get_account_actif(),
			// 'close_ticket'			=> $this->state_close,
			// 'state_id'				=> $this->get_transition_etat(),
			// 'default_cat'			=> $this->get_cal_cat(),
			// 'possible_select'		=> array(
			// 							''	=> 'Select one',
			// 							'1'	=> 'Yes',
			// 							'0'	=> 'No',
			// 						),
			'unit_time'				=> $this->get_unit_time(),
			'stat_unit_time'		=> $this->get_unit_time(),
			// 'confirmed_intervention'=> $this->get_cal_cat(),
			// 'realised_intervention'	=> $this->get_cal_cat(),
			// 'option_intervention'	=> $this->get_cal_cat(),
			// 'ticket_management_user'=> $this->get_user_group($this->obj_config['ticket_management_group']),
			'invoice_model'			=> $this->get_models(),
			// 'cat_managementgroup' 	=> $this->get_providers(),
			// 'etat_enfant'			=> $this->get_enfant_possible(),
			// 'state_auto_id'			=> $this->get_enfant_possible(),

			'sale_account'			=> $this->get_account(),
			'sales_book'			=> $this->get_book(),
			'sales_account'			=> $this->get_account(),
			'sales_collective_account'=> $this->get_account(),
			'account_export_model'	=> $this->get_accounting_export(),
			
			// 'assistant_frequency' 	=> array('' => lang('Month'), 'W' => lang('Week')),

			'default_vat'			=> vat_bo::get_vat(),
			'default_delay'			=> $this->get_payment_delay(),
		);
		return $sel_options;
	}
	function get_content(){
		$general=$this->obj_config;
		
		$content = array(
			'general' 	  => $general,
		);

		return $content;
	}
	
	function general($content=null)
	{
		/**
		* Charge l'e-template général, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript
		*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_config($content);
					break;
				default:
				case 'cancel':
					$content=array();
					break;
			}
		}

		$GLOBALS['egw_info']['flags']['app_header'] = lang('spifina configuration');
		$content = $this->get_content();
		$sel_options = $this->get_selection();
		$tpl= new etemplate('spifina.admin.general');
		$tpl->exec('spifina.admin_ui.general',$content,$sel_options,$readonlys,$content);
	}
}

?>
