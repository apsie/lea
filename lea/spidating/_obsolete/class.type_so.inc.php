<?php
/* spidating : SpireaTime
SPIREA - F�vrier 2012
Spirea - 16/20 avenue de l'agent Sarre
T�l : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propri�t� de Spirea

Logiciel SpireaTime - Gestion avanc�e des temps dans eGroupware : saisie / contr�le de coh�rence / validation / rappels / exports

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
	 * Cr�e une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requ�te ainsi cr�e est pr�te � �tre utilis�e comme filtre
	 *
	 * @param int $search tableau des crit�res de recherche
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
	 * Cr�e ou met � jour un statut
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