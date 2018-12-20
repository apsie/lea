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
class country_so extends so_sql{
	
	var $spireapi_country = 'spireapi_country';
	
	var $so_country;
	
	/**
	 * Constructeur
	 *
	 */
	function country_so(){
		$this->so_country = new so_sql('spireapi',$this->spireapi_country);
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


	function add_update_country($info){
	/**
	 * Crée ou met à jour un taux
	 *
	 * @param $info : information concernant le taux
	 */
		$msg='';
		if(is_array($info)){
			$this->so_country->data = $info;

			if(isset($this->so_country->data['country_id'])){
				// Existant
				$this->so_country->data['date_modified']=time();
				$this->so_country->data['modifier']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_country->update($this->so_country->data,true);
				
				$msg .= ' '.lang('Country updated');
			}else{
				// Nouveau
				$this->so_country->data['country_id'] = '';
				$this->so_country->data['creation_date']=time();
				$this->so_country->data['creator']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_country->save();
				
				$msg .= ' '.lang('Country created');
			}
		}
		return $msg;
	}
}
?>