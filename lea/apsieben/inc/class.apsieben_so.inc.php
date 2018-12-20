<?php
/* 
 * apsieben 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel Apsieben - Module permettant la liaison de beneficaire en tant que participant à des événements de calendrier ou en lien avec toute autre application
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */
 
require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	

class apsieben_so extends so_sql {

	function apsieben_so(){
		// Création du so_sql sur la table
		parent::__construct('apsieben','egw_contact');
	}

}
?>