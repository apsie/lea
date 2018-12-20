<?php
/**
 * eGroupware - Spireapi - 
 * SpireAPI : Module and functions set to manage referentials in eGroupware 
 *
 * @link http://www.spirea.fr
 * @package spireapi
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2014-03 by Spirea
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
  */
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.facture_categories_so.inc.php');	
	
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
		$this->preferences = $GLOBALS['egw']->preferences->data['spireapi'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$GLOBALS['egw_info']['user']['account_id'],'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spireapi');
		
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
			unset($content['spireapi']);
			unset($content['msg']);	
			$this->data = $content;
			if(isset($this->data['cat_id'])){
				$this->data['change_date']=time();
				$this->data['modifier_id']=$GLOBALS['egw_info']['user']['account_id'];
				$this->update($this->data,true);
				$msg='Category updated';
			}else{
				$this->data['creation_date']=time();
				$this->data['creator_id']=$GLOBALS['egw_info']['user']['account_id'];
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
	
	function get_cat_facture(){
	/**
	 * retourne la liste des catégories de facture
	 * @return array
	 */
		$retour = array();
		$info = $this->search('',false,'cat_name ASC');
		if(is_array($info)){
			foreach($info as $id => $value){
				$retour[$value['cat_id']] = $value['cat_name'];
			}
		}
		return $retour;
	}
	
}	
?>
