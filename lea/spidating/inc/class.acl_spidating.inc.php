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
class acl_spidating {

	function __construct(){
	/**
	 * Méthode appelée directement par le constructeur. Charge les ACL de l'application
	 */		
		$obj = CreateObject('phpgwapi.config');
		$config = $obj->read('spidating');
		
		// $groupUser : array => liste des groupes du user en cours
		$accounts = CreateObject('phpgwapi.accounts');
		$groupeUser = $accounts->memberships($GLOBALS['egw_info']['user']['account_id'],true);
				
		$this->admin = $GLOBALS['egw_info']['user']['apps']['admin'] || in_array($config['ManagementGroup'],$groupeUser);
	}
	
	function acl_spidating(){
	/**
	 * Constructeur
	 */
		self::__construct();
	}
}

?>