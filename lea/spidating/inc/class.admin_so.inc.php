<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * T�l : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propri�t� de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant cr�ation en masse d'�v�nement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

class admin_so extends so_sql{
		
	var $config;
	
	function admin_so(){
	/**
	 * Constructor
	 *
	 */
		
		// /* R�cup�ration les infos de configurations */
		$config = CreateObject('phpgwapi.config');
		$this->config = $config->read('spidating');

		$this->spid_config = $config->read('spid');
	}

}
?>