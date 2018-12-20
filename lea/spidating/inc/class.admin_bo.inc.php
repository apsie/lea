<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant création en masse d'évènement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.admin_so.inc.php');	

class admin_bo extends admin_so{
	
		
	function admin_bo(){
	/**
	 * Constructor
	 *
	 */
		parent::admin_so();
	}
	
	function add_update_config($info){
	/**
	 * Routine permettant de créer/modifier la config
	 *
	 * @param array $content=null
	 * @return string
	 */
		$this->add_update_spid_config($info['spid']);
		unset($info['spid']);

		$obj = CreateObject('phpgwapi.config');
		foreach($info as $id => $value){
			$obj->save_value($id,$value,'spidating');
		}
		$this->config=$obj->read('spidating');
		return lang('Configuration updated');
	}

	function add_update_spid_config($info){
	/**
	 * Routine permettant de créer/modifier la config
	 *
	 * @param array $content=null
	 * @return string
	 */
		$obj = CreateObject('phpgwapi.config');
		foreach($info as $id => $value){
			$obj->save_value($id,$value,'spid');
		}
		$this->spid_config = $obj->read('spid');
		return lang('Configuration updated');
	}
	
	function get_cal_fields(){
	/**
	 * Retourne la liste des champs "extra" du calendrier
	 *
	 * @return array
	 */
		if($GLOBALS['egw_info']['server']['versions']['phpgwapi'] == '14.1'){
			$customfields = config::get_customfields('calendar');
		}else{
			$config = CreateObject('phpgwapi.config');
			$cal_config = $config->read('calendar');
			$customfields = $cal_config['customfields'];
		}

		foreach($customfields as $field => $values){
			$return[$field] = $values['label'];
		}
			return $return;
	}

}
?>