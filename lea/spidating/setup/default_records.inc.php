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
	
	$oProc->query ("DELETE FROM {$GLOBALS['egw_setup']->config_table} WHERE config_app='spidating'");
	// $oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'couple_spid', '1')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'default_cat_meeting', '35')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'default_duration', '60')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'default_pause_end', '50400')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'default_pause_start', '46800')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'default_weekdays', '62')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_add', 'Trouver des disponibilités et ajouter des rendez-vous en masse')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_collective', 'Vous trouverez ici tous les rendez-vous collectifs sur lesquels il reste de la place.  Un rendez-vous collectif est un rendez-vous d\'une des catégories \"intervention..\" avec un nombre de participants supérieur à 1.')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_individual', 'Vous trouverez ici tous les rendez-vous individuels sur lesquels il reste de la place.  Un rendez-vous individuel est un rendez-vous d\'une des catégories \"intervention..\" avec un nombre de participant indéfini ou égal à 1. Pensez à confirmer en changeant votre rendez-vous de catégorie...')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_orphan', 'Orphan events help ')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_selection', 'Le temps d\'affichage du calendrier va dépendre de votre sélection : plus votre sélection est restrictive, plus rapide sera l\'affichage')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spidating', 'help_ticket', 'Trouver des disponibilités et ajouter des rendez-vous en masse et créer les tickets associés dans SpiD')");
	
	
	// $admingroup = $GLOBALS['egw_setup']->add_account('Admins','Admin','Group',False,False);
	// $GLOBALS['egw_setup']->add_acl('spid','run',$admingroup);

?>
