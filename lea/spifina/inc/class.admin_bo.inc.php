<?php
/**	spifina : SpireaDemandes
*	SPIREA - 23/12/2009
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
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.admin_so.inc.php');	
	
class admin_bo extends admin_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	var $autoassign;
	var $state_source;
	var $state_cible;
	var $state_close;
	var $state_initial;
	var $state_billable;
	var $state_name;
	
	var $verification;
	
	var $nom_des_tables;
	var $id_tables;
	
	
	function __construct() {
	/**
	*Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spifina'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$GLOBALS['egw_info']['user']['account_id'],'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spifina');
		
		parent::__construct();
	}
		
	function admin_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function add_update_config($info){
	/**
	 * Gère l'ajout/édition de réponses standards. Retourne un message informant de l'état des mises à jour (réussies, échouées, ...)
	 * 
	 * @return string
	 */
		$obj = CreateObject('phpgwapi.config');
		foreach((array)$info['general'] as $id => $value){
			$obj->save_value($id,$value,'spifina');
		}
		$this->obj_config = $obj->read('spifina');
		return lang('Configuration updated');
	}

	/**
	 * Retourne la liste des unités de temps utilisable sur les tickets
	 * @return array
	 */
	function get_unit_time(){
		$unit = array(
			'0' => 'Minutes',
			'1' => 'Heures',
			'2' => 'Jours',
		);
		return $unit;
	}
	
}	
?>
