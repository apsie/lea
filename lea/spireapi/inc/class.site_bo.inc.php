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
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.site_so.inc.php');	

class site_bo extends site_so{
	
	/**
	 * Constructeur
	 *
	 */
	function site_bo(){
		parent::site_so();
	}
	
	function id2description($site_id, $html=false){
	/**
	 * Retourne les informations du site sous forme de texte
	 *
	 * @param $site_id : identifiant de site
	 * @return array
	 */
		$ln = $html ? "<br />" : "\n";
		$site = $this->so_site->read($site_id);
		$parent = $this->so_site->read($site['site_parent']);

		$return[] = $site['site_label'];
		$return[] = empty($site['site_street']) ? $parent['site_street'].$ln.$parent['site_street2'] : $site['site_street'].$ln.$site['site_street2'];
		$return[] = empty($site['site_city']) ? $parent['site_postalcode'].' '.$parent['site_city'] : $site['site_postalcode'].' '.$site['site_city'];
		$return[] = empty($site['site_tel']) ? lang('Tel').' : '.$parent['site_tel'] : lang('Tel').' : '.$site['site_tel'];
		$return[] = empty($site['site_fax']) ? lang('Fax').' : '.$parent['site_fax'] : lang('Fax').' : '.$site['site_fax'];
		$return[] = empty($site['site_mail']) ? lang('Mail').' : '.$parent['site_mail'] : lang('Mail').' : '.$site['site_mail'];

		return implode($ln,$return);
	}

	function site2string($site, $field){
	/**
	 * Retourne la valeur du champ $field pour le site $site
	 *
	 * @return 
	 */
		$site = $this->so_site->read($site);
		$parent = $this->so_site->read($site['site_parent']);

		return empty($site[$field]) ? (string)$parent[$field] : (string)$site[$field];
	}

	function id2raw($site_id){
	/**
	 * Retourne les informations du site sous forme de texte court en une seule ligne (SPISMS)
	 *
	 * @param $site_id : identifiant de site
	 * @return array
	 */
		$ln = ", ";
		$site = $this->so_site->read($site_id);
		$parent = $this->so_site->read($site['site_parent']);

		$return[] = $site['site_label'];
		$return[] = empty($site['site_street']) ? $parent['site_street'].$ln.$parent['site_street2'] : $site['site_street'].$ln.$site['site_street2'];
		$return[] = empty($site['site_city']) ? /*$parent['site_postalcode'].' '.*/$parent['site_city'] : /*$site['site_postalcode'].' '.*/$site['site_city'];
		$return[] = empty($site['site_tel']) ? lang('Tel').' : '.$parent['site_tel'] : lang('Tel').' : '.$site['site_tel'];
		// $return[] = empty($site['site_fax']) ? lang('Fax').' : '.$parent['site_fax'] : lang('Fax').' : '.$site['site_fax'];
		// $return[] = empty($site['site_mail']) ? lang('Mail').' : '.$parent['site_mail'] : lang('Mail').' : '.$site['site_mail'];

		return implode($ln,$return);
	}

	function formatted_list($selected){
	/**
	 * retourne une liste formatter html
	 *
	 * @return String
	 */
		$return .= '<option value=>'.lang('All sites').'</option>';

		// $sites = $this->so_site->search('',false);
		$sites = array_keys($this->get_root_sites());

		foreach((array)$sites as $site_id){
			$site_data = $this->so_site->read($site_id);
			$label_selected = $selected == $site_id ? 'selected=selected' : '';
			if(empty($site_data['site_group']) || array_key_exists($site_data['site_group'], $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']))){
				$return .= '<option value='.$site_data['site_id'].' '.$label_selected.' >'.$site_data['site_label'].'</option>';
			}
			$return .= $this->get_childs($site_id, $selected);
		}

		return $return;
	}

	function get_childs($site_id, $selected){
	/**
	 * Retourne le niveau d'un site
	 *
	 * @return string
	 */
		$childs = $this->so_site->search(array('site_parent' => $site_id),false);

		foreach((array)$childs as $child){
			if(empty($child['site_group']) || array_key_exists($child['site_group'], $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']))){
				$label_selected = $selected == $child['site_id'] ? 'selected=selected' : '';
				$label = '';
				$level = $this->get_level($child['site_id']);
				for($i=0;$i < $level;$i++){
					$label .= '&nbsp;';
				}
				
				$return .= '<option value='.$child['site_id'].' '.$label_selected.' >'.$label.'&nbsp;'.$child['site_label'].'</option>';
			}

			$return .= $this->get_childs($child['site_id'], $selected);
		}

		return $return;
	}

	function get_level($site_id){
	/**
	 * Retourne le niveau d'un site
	 *
	 * @return int
	 */
		$site = $this->so_site->read($site_id);
		$parent = $site['site_parent'];

		$level = 0;
		while ($parent) {
			$level++;
			$site_parent = $this->so_site->read($parent);
			$parent = $site_parent['site_parent'];
		}

		return $level;
	}

	function get_info($id){
	/**
	 * returnne les infos d'un site
	 *
	 * @return array
	 */
		$info = $this->so_site->read($id);
		
		return $info;
	}

	function get_root_sites($appname=''){
	/**
	 * retourne la liste des sites qui n'ont pas de parent 
	 *
	 * @return array
	 */
		if(empty($appname)){
			$appname = $GLOBALS['app'];
		}
		
		$return = array();
		$sites = $this->so_site->search(array('site_appname' => array('global',$appname)),false,'','',$wildcard,false,'AND',false);

		foreach((array)$sites as $site){
			if(empty($site['site_parent']) || $site['site_parent'] < 1){
				$return[$site['site_id']] = $site['site_id'];
			}
		}

		return $return;
	}

	function get_possible_parents($level,$appname=''){
	/**
	 * Liste des parents possible pour un site
	 *
	 * @return array
	 */
		$return = array();

		if(!empty($appname)){
			$col_filter = array('site_appname' => array('global',$appname));
		}

		$root_sites = $this->get_root_sites();
		$sites = $this->so_site->search('',false,'site_label','',$wildcard,false,$op,false,$col_filter);

		foreach((array)$sites as $site){
			if(in_array($site['site_id'],$root_sites)){
				$temp[$site['site_id']][$site['site_id']] = $site['site_label'];
			}elseif(in_array($site['site_parent'],$root_sites)){
				if($level){
					$temp[$site['site_parent']][$site['site_id']] = '-- '.$site['site_label'];
				}elseif(empty($appname)){
					$temp[$site['site_parent']][$site['site_id']] = $site['site_label'];
				}
			}
		}

		foreach((array)$temp as $key => $data){
			ksort($data);
			foreach((array)$data as $id => $value){
				$return[$id] = $value;
			}
		}
		return $return;
	}

	function get_all_sites($level,$appname=''){
	/**
	 * Liste des parents possible pour un site
	 *
	 * @return array
	 */
		$return = array();
		if(empty($appname)){
			$appname = $GLOBALS['app'];
		}

		// $root_sites = $this->get_root_sites();
		// $sites = $this->so_site->search('',false,'site_label','',$wildcard,false,$op,$start,$col_filter);

		// foreach((array)$sites as $site){
		// 	if(in_array($site['site_id'],$root_sites)){
		// 		$temp[$site['site_id']][$site['site_id']] = $site['site_label'];
		// 	}elseif(in_array($site['site_parent'],$root_sites)){
		// 		if($level){
		// 		if($level){
		// 			$temp[$site['site_parent']][$site['site_id']] = '-- '.$site['site_label'];
		// 		}else{
		// 			$temp[$site['site_parent']][$site['site_id']] = $site['site_label'];
		// 		}
		// 	}
		// }

		// foreach((array)$temp as $key => $data){
		// 	ksort($data);
		// 	foreach((array)$data as $id => $value){
		// 		$return[$id] = $value;
		// 	}
		// }
		$sites = array_keys($this->get_root_sites($appname));
		foreach((array)$sites as $site_id){
			$site_data = $this->so_site->read($site_id);
			if(empty($site_data['site_group']) || array_key_exists($site_data['site_group'], $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']))){
				// $return .= '<option value='.$site_data['site_id'].' '.$label_selected.' >'.$site_data['site_label'].'</option>';
				$return[$site_data['site_id']] = $site_data['site_label'];
			}
			$this->get_childs_list($site_id, $appname, $return);
		}
		return $return;
	}

	function get_childs_list($site_id, $appname, &$return){
	/**
	 * Recupere recursivement les enfants de chaque site
	 *
	 * @return array
	 */
		// if(!empty($appname)){
		// 	$filter_app = array('site_appname' => array('global',$appname));
		// }

		$childs = $this->so_site->search(array('site_parent' => $site_id,'site_appname' => array('global',$appname)),false,'','',$wildcard,false,'AND',false);

		foreach((array)$childs as $child){
			if(empty($child['site_group']) || array_key_exists($child['site_group'], $GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']))){
				$label = '';
				$level = $this->get_level($child['site_id']);
				for($i=0;$i < $level;$i++){
					$label .= '&nbsp;';
				}
				
				$return[$child['site_id']] = $label.'&nbsp;'.$child['site_label'];
			}

			$this->get_childs_list($child['site_id'], $appname, $return);
		}

		return $return;
	}

	function get_available_site($appname=''){
    /**
     * Retourne la liste des sites disponible pour l'utilisateur
     *
     *
     * @return array
     */
    	$retour = array();
    	if(!empty($appname)){
			$col_filter = array('site_appname' => array('global',$appname));
		}

    	$sites = $this->so_site->search(array('site_responsible' => $GLOBALS['egw_info']['user']['account_id']),false,'site_label','',$wildcard,false,$op,false,$col_filter);
    	foreach((array)$sites as $site){
    		$retour[$site['site_id']] = $site['site_label'];
    	}

    	$salarie = $this->so_employee->read($GLOBALS['egw_info']['user']['account_id']);
    	$retour[$salarie['employee_site']] = '';
    	
    	return $retour;
    }

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les sites
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
		
		// Recherche champ texte
		if(!is_array($query['search'])){
			$search = $this->construct_search($query['search']);
		}else{
			$search=$query['search'];
		}

		// Filtre application
		if(!empty($GLOBALS['egw_info']['flags']['currentapp'])){
			$query['col_filter']['site_appname'][] = $GLOBALS['egw_info']['flags']['currentapp'];

			if(!in_array('global',$query['col_filter']['site_appname'])){
				$query['col_filter']['site_appname'][] = 'global';
			}
		}

		$rows = $this->so_site->search($search,'',$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);

		if(!$rows){
			$rows = array();
		}

		$order = $query['order'];
		return $this->so_site->total;	
    }
}
?>