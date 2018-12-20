<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 09/06/2011
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.sector_so.inc.php');	
	
class sector_bo extends sector_so 
{
	var $tabs = 'general|conditions|details';
	
	var $period = array(
		'Mensuel' => 'Mensuel',
		'Trimestriel' => 'Trimestriel',
		'Semestriel' => 'Semestriel',
		'Annuel' => 'Annuel',
	);
	
	var $create_ticket=EGW_ACL_ADD;
	var $update_ticket=EGW_ACL_EDIT;
	var $close_ticket=EGW_ACL_CUSTOM_1;
	var $create_invoce=EGW_ACL_CUSTOM_2;
	var $read_invoce=EGW_ACL_CUSTOM_3;
	
	var $grants;
	var $preferences;
	var $obj_js;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	var $obj_preferences;
	
	var $account_id;
	var $app_title;
	
	
	var $payment_model;
	

	var $state_close;
	var $state_name;
	var $sel_reponsestandard;
	var $state_initial;
	var $state_billable;
	var $sel_priority;
	var $sel_client;

	//var $previous_value;
	var $tableau_errors;
	
	var $verification;
	var $total;
	var $checkgroups;
	var $new_group;
	var $assignedby;
	var $assignedto;

	function __construct() {
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		$this->account_id=$GLOBALS['egw_info']['user']['account_id'];
		$this->app_title=$GLOBALS['egw_info']['apps']['spid']['title'];
		/* Récupération des droits d'accès ACL */
		$acl =& CreateObject('spid.acl_spid');
		$this->grants=$acl->getACL();
		$this->grants['admin']=$this->is_admin($this->account_id);
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		$this->obj_preferences =& $GLOBALS['egw_info']['user']['preferences']['spid'];
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		
		                        		
		parent::__construct();
	}
		
	function sector_bo(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function get_info($id){
		/**
		* Routine permettant d'obtenir les informations sur le secteur passé en argument
		*
		* @param int $id indentifiant du secteur dont on veut les informations
		* @return string
		*/
		$info=$this->search(array('sector_id'=>$id),false);
		return $info[0];
	}
	
	function add_update_sector($content=null){
		/**
		* Routine permettant de créer/modifier (si le secteur existe déjà) le secteur actuel, à partir des arguments passés dans $content. $content doit contenir un champ sector_id pour définir le secteur à créer/mettre à jour
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=NULL
		* @return string
		*/
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spid']);
			unset($content['msg']);
			$this->data = $content;
			if(isset($this->data['sector_id'])){
				$this->data['change_date']=time();
				$this->data['change_id']=$this->account_id;
				$this->update($this->data,true);
				$msg='Sector updated';
			}else{
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Sector created';
			}
		}
		return $msg;
	}
}	
?>
