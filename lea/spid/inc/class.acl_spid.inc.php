<?php
/**	SpiD : SpireaDemandes
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
class acl_spid {

	var $grant;
	var $obj_config;
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		$this->grant=array();
		// les ACL Spid ne fonctionnent plus en version 14.x, on attribue les droits ajout/edition par defaut
		$this->grant[EGW_ACL_ADD]=true; 
		$this->grant[EGW_ACL_EDIT]=true;
		$this->grant[EGW_ACL_CUSTOM_1]=false;
		$this->grant[EGW_ACL_CUSTOM_2]=false;
		$this->grant[EGW_ACL_CUSTOM_3]=false;
		
		
		$config = CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
	}
	
	function acl_spid(){
		/**
		*Constructeur
		*/
		self::__construct();
	}

	
	function getACL(){
	/**
	 * Retourne les droits pour l'utilisateur courant. Le tableau de retour contient en index l'identificateur du droit et en valeur si celui-ci lui est accordé (true ou false)
	 *
	 * @return array
	 */
		$compte =& CreateObject('phpgwapi.accounts');
		$tab_group=$compte->memberships($GLOBALS['egw_info']['user']['account_id']);

		foreach($this->grant as $id_grant=>$value_grant){
			$this->grant[$id_grant]=$GLOBALS['egw']->acl->get_ids_for_location($GLOBALS['egw_info']['user']['account_id'],$id_grant,'spid');
			if(!$this->grant[$id_grant]){
				foreach($tab_group as $id_group=>$value_group){
					$this->grant[$id_grant]=$GLOBALS['egw']->acl->get_ids_for_location($id_group,$id_grant,'spid');
					
					if($id_group == $this->obj_config['ticket_management_group']){
						$this->grant[$id_grant] = true;
					}
					
					if($this->grant[$id_grant]){
						$this->grant[$id_grant]=true;
						break;
					}
				}
			}
		}
		
		$this->grant[EGW_ACL_ADD]=true; 
		$this->grant[EGW_ACL_EDIT]=true;

		return $this->grant;
	}
	
		
}

?>