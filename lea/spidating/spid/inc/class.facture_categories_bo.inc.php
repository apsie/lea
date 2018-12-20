<?php
/**	spid : SpireaDemandes
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.facture_categories_so.inc.php');	
	
class facture_categories_bo extends facture_categories_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	
	
	function __construct() {
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		parent::__construct();
	}
		
	function facture_categories_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	
	function get_info($id){
		/**
		* Retourne les informations au sujet de la categorie $id
		*
		* @param int $id
		* @return string
		*/
		$info=$this->search(array('cat_id'=>$id),false);
		return $info[0];
	}
	
	function add_update_categorie($content=null){
		/**
		* Routine permettant de créer/modifier la categorie actuelle, à partir des arguments passés dans $content. $content doit contenir un champ cat_id pour mettre la categorie (elle sera crée sinon)
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=null
		* @return string
		*/

		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spid']);
			unset($content['msg']);	
			$this->data = $content;
			if(isset($this->data['cat_id'])){
				$this->data['change_date']=time();
				$this->data['modifier_id']=$this->account_id;
				$this->update($this->data,true);
				$msg='Category updated';
			}else{
				$this->data['creation_date']=time();
				$this->data['creator_id']=$this->account_id;
				$this->save();
				$msg='Category created';
			}
		}
		return $msg;
	}
	
	function get_account(){
    /**
     * Retourne la liste des comptes
     *
     * @return array
     */
    	$accounts = $this->so_account->search(array('account_active' => true),false);
    	foreach($accounts as $account){
    		$return[$account['account_id']] = $account['account_code'].' - '.$account['account_label'];
    	}

    	return $return;
    }
}	
?>
