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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.mode_reglement_so.inc.php');	
	
class mode_reglement_bo extends mode_reglement_so{
	
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
		
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
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
		
	function mode_reglement_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	
	function get_info($id){
		/**
		* Retourne les informations au sujet du type de contrat $id
		*
		* @param int $id
		* @return string
		*/
		$info = $this->search(array('mode_reglement_id'=>$id),false);
		return $info[0];
	}
	
	function add_updatee_mode_reglement($content=null){
		/**
		* Routine permettant de créer/modifier (si le client existe déjà) le type de contrat actuel, à partir des arguments passés dans $content. $content doit contenir un champ type_id pour modifier le type de contrat (il sera crée sinon)
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
			$this->data = $content;
			if(isset($this->data['mode_reglement_id'])){
				$this->data['change_date']=time();
				$this->data['maj_id']=$this->account_id;
				$this->update($this->data,true);
				$msg='Payment method updated';
			}else{
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Payment method created';
			}
		}
		return $msg;
	}
	
	
}	
?>
