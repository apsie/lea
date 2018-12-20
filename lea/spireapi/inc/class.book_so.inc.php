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
class book_so extends so_sql{
	
	var $spireapi_book = 'spireapi_acc_book';
	var $spireapi_account = 'spireapi_acc_accounts';
	
	var $so_book;
	var $so_account;
	
	/**
	 * Constructeur
	 *
	 */
	function book_so(){
		$this->so_book = new so_sql('spireapi',$this->spireapi_book);
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


	function add_update_book($info){
	/**
	 * Crée ou met à jour une zone
	 *
	 * @param $info : information concernant la zone
	 */
		$msg='';
		if(is_array($info)){
			$this->so_book->data = $info;

			if(isset($this->so_book->data['book_id'])){
				// Existant
				$this->so_book->data['date_modified']=time();
				$this->so_book->data['modifier']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_book->update($this->so_book->data,true);
				
				$msg .= ' '.lang('book updated');
			}else{
				// Nouveau
				$this->so_book->data['book_id'] = '';
				$this->so_book->data['creation_date']=time();
				$this->so_book->data['creator']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_book->save();
				
				$msg .= ' '.lang('book created');
			}
		}
		return $msg;
	}
}
?>