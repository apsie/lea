<?php
/* spidating : SpireaTime
SPIREA - Février 2012
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaTime - Gestion avancée des temps dans eGroupware : saisie / contrôle de cohérence / validation / rappels / exports

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.type_so.inc.php');	

class type_bo extends type_so{
	
	/**
	 * Constructor
	 *
	 */
	function type_bo(){
		parent::type_so();
	}
	
	function get_info($id){
	/**
	 * Retourne la liste des statuts avec les infos les concernant
	 *
	 * @return array
	 */
		return $this->so_type->read($id);
	}
	
	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les statuts
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
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
		if(!is_array($query['search'])){
			$search = $this->construct_search($query['search']);
		}else{
			$search=$query['search'];
		}

		// $rows = $this->so_type->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter']);
		if(!$rows){
			$rows = array();
		}
		foreach($rows as $id=>$value){
			if(isset($query['view'])){
				$readonlys['edit['.$value['type_id'].']']=true;
				$readonlys['delete['.$value['type_id'].']']=true;
				$readonlys['add['.$value['type_id'].']']=true;
			}
		}
		$order = $query['order'];
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('file type Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		if($query['filter']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search file type '%1'",$this->id2name($query['filter']));
		}
		return $this->so_type->total;	
    }
}
?>