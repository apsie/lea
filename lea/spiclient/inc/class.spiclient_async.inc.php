<?php
/* 
 * spistoric 
 * SPIREA - Février 2012
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpireaRéf - Ce module est un programme informatique servant à la gestion des notes de frais
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */


require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.client_ui.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.spiclient_admin.inc.php');

class spiclient_async extends so_sql2{
	/**
	 * Private spiclient_bo instance to run the escalations
	 *
	 * @var spiclient_bo
	 */
	private static $spiclient;
	private static $spiclient_admin;

	/**
	 * Constructor
	 *
	 */
	function __construct(){
		self::$spiclient_admin = new spiclient_admin();
	}

	function import_client(){
		error_log('['.date("d-m-Y H:i:s").'] IMPORT CLIENT'."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');
		self::$spiclient_admin->import_client_data();
		self::$spiclient_admin->import_contact_data();

		error_log('['.date("d-m-Y H:i:s").'] IMPORT PROSPECT'."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');
		self::$spiclient_admin->import_client_data('/tmp/spiclient_ftp_prospects.csv');
		self::$spiclient_admin->import_contact_data('/tmp/spiclient_ftp_contacts_prospects.csv');
	}
}
?>