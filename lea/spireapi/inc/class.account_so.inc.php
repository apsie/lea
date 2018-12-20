<?php
/**
 * eGroupware - Spireapi - 
 * SpireAPI : Module and functions set to manage referentials in eGroupware 
 *
 * @link http://www.spirea.fr
 * @package spireapi
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-10 by Spirea
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
  */
class account_so extends so_sql{
	
	var $spireapi_account = 'spireapi_acc_accounts';
	
	var $so_account;
	
	/**
	 * Constructeur
	 *
	 */
	function account_so(){
		$this->so_account = new so_sql('spireapi',$this->spireapi_account);
	}
	
	function construct_search($search){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		foreach((array)$this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}


	function add_update_account($info){
	/**
	 * Crée ou met à jour une zone
	 *
	 * @param $info : information concernant la zone
	 */
		$msg='';
		if(is_array($info)){
			$this->so_account->data = $info;

			if(isset($this->so_account->data['account_id'])){
				// Existant
				$this->so_account->data['date_modified']=time();
				$this->so_account->data['modifier']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_account->update($this->so_account->data,true);
				
				$msg .= ' '.lang('account updated');
			}else{
				// Nouveau
				$this->so_account->data['account_id'] = '';
				$this->so_account->data['creation_date']=time();
				$this->so_account->data['creator']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_account->save();
				
				$msg .= ' '.lang('account created');
			}
		}
		return $msg;
	}
}
?>