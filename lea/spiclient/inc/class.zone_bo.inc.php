<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009
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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.zone_so.inc.php');	
	
class zone_bo extends zone_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	
	
	function __construct() {
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spiclient'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
   			$config = CreateObject('phpgwapi.config','spiclient');
   			$this->obj_config = $config->read_repository('spiclient');
   		}else{
			$config = CreateObject('phpgwapi.config');
			$this->obj_config = $config->read('spiclient');
		}
		
		parent::__construct();
	}
		
	function zone_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	
	function get_info($id){
		/**
		* Retourne les informations au sujet de la zone $id
		*
		* @param int $id
		* @return string
		*/
		$info=$this->search(array('zone_id'=>$id),false);
		return $info[0];
	}
	
	function add_update_zone($content=null){
		/**
		* Routine permettant de créer/modifier (si le client existe déjà) la zone actuelle, à partir des arguments passés dans $content. $content doit contenir un champ zone_id pour mettre la zone (elle sera crée sinon)
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=null
		* @return string
		*/

		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spiclient']);
			unset($content['msg']);	
			$content['zone_parent']= empty($content['zone_parent']) ? 0 : $content['zone_parent'];
			$this->data = $content;
			if(isset($this->data['zone_id'])){
				$this->data['change_date']=time();
				$this->update($this->data,true);
				$msg='Geographic area updated';
			}else{
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Geographic area created';
			}
		}
		return $msg;
	}
	
	
}	
?>
