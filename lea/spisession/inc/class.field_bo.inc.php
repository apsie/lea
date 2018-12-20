<?php
/**
 * spisession - Integrated Sessions Management Modules for eGroupware (trainings, meetings, etc.)
 * See About folder and www.spirea.fr for further information
 *
 * @link http://www.spirea.fr
 * @package spisession
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-december by Spirea +33141192772
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 */
require_once(EGW_INCLUDE_ROOT. '/spisession/inc/class.field_so.inc.php');	

class field_bo extends field_so{
	
	/**
	 * Constructeur 
	 *
	 */
	function field_bo(){
		parent::field_so();
	}
	
	function get_info($id){
	/**
	 * Retourne les informations d'un theme
	 *
	 * @param $id : identifiant du theme
	 * @return array
	 */
		return $this->so_field->read($id);
	}
	
	function get_rows($query,&$rows,&$readonlys){
	/**
	 * R�cup�re et filtre les themes
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour d�finir d'autres clefs comme 'filter', 'cat_id', vous devez cr�er une classe fille
	 * @param array &$rows lignes compl�t�s
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilis� ici (� utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		
		// Filtre sur les actifs/inactifs
		if(!empty($query['filter']) or ($query['filter']==0)){
			$query['col_filter']['field_active'] = $query['filter'];
		}
		
		// recherche champ texte
		if(!is_array($query['search'])){
			$search = $this->construct_search($query['search']);
		}else{
			$search=$query['search'];
		}

		$rows = $this->so_field->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter']);
		if(!$rows){
			$rows = array();
		}

		$order = $query['order'];
		
		return $this->so_field->total;	
    }
}
?>