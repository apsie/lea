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

class admin_so extends so_sql{
		
	var $config;
	
	function admin_so(){
	/**
	 * Constructor
	 *
	 */
		
		// /* Récupération les infos de configurations */
		$config = CreateObject('phpgwapi.config');
		$this->config = $config->read('spidating');

		$this->spid_config = $config->read('spid');
	}

}
?>