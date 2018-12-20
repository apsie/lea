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
class type_so extends so_sql{
	
	var $spidating_type = 'spidating_ref_type';
	
	var $so_type;
	
	/**
	 * Constructor
	 *
	 */
	function type_so(){
		// $this->so_type = new so_sql('spidating',$this->spidating_type);
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
		foreach($this->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}

	function add_update_type($info){
	/**
	 * Crée ou met à jour un statut
	 *
	 * @param $info : information concernant le statut
	 */
		$msg='';
		if(is_array($info)){
			unset($info['button']);
			unset($info['nm']);
			unset($info['msg']);
			$this->so_type->data = $info;
			if(isset($this->so_type->data['type_id'])){
				$this->so_type->data['date_modified']=time();
				$this->so_type->data['modifier']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_type->update($this->so_type->data,true);
				
				$msg .= ' '.'file type updated';
			}else{
				$this->so_type->data['type_id'] = '';
				$this->so_type->data['creation_date']=time();
				$this->so_type->data['creator']=$GLOBALS['egw_info']['user']['account_id'];
				$this->so_type->save();
				
				$msg .= ' '.'file type created';
			}
		}
		return $msg;
	}
}
?>