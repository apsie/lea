<?php
/* SpiD : SpireaDemandes
SPIREA - 23/12/2009
Spirea - 16/20 avenue de l'agent Sarre
T�l : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propri�t� de Spirea

Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant � la gestion de tickets de demande dans un environnement egroupware.

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
	$sql_etat="INSERT INTO `spid_etats` (`state_id`, `state_name`, `state_description`, `state_initial`, `state_close`, `state_billable`, `facturation_label`) VALUES
	(1, 'UNDEFINED', 'The ticket was existent before the Petri Net infrastructure was defined and should be assigned a state.', 0, 0, 0, NULL),
	(2, 'NOUVEAU', 'Un nouveau ticket a été créé.', 1, 0, 0, NULL),
	(3, 'ACCEPTÉ', 'Le ticket est accepté pour être traité.', 0, 0, 0, NULL),
	(4, 'REOPENED', 'The ticket has been reopened for further work.', 0, 0, 0, NULL),
	(5, 'RÉSOLU', 'Le ticket a été résolu avec succès.', 1, 0, 0, NULL),
	(6, 'VÉRIFIÉ', 'Le ticket a été vérifié et a encore besoin d''être validé.', 0, 0, 0, NULL),
	(7, 'FERMÉ', 'Le ticket a été fermé sans être résolu.', 0, 0, 0, NULL),
	(8, 'TOVALIDATE', 'The ticket has been worked on and the work requires validation.', 0, 0, 0, NULL),
	(9, 'ENCORE BESOIN DE TRAVAILLER DESSUS', 'Le ticket a été partiellement traité.', 0, 0, 0, NULL),
	(10, 'INVALIDE', 'Cette demande n''entre pas dans notre champ\r\nd''intervention.', 0, 0, 0, NULL),
	(11, 'DUPLIQUÉ', 'Ce ticket existe déj�  sous un autre numéro, nous fermons donc\r\ncelui-ci.', 0, 0, 0, NULL),
	(12, 'PROPOSITION', 'Le ticket a été traité par la préparation d''une proposition\r\ncommerciale.', 0, 0, 0, NULL),
	(13, 'INTERVENTION DE SUIVI EN COURS', 'Le ticket va étre traité au cours d''une intervention de suivi.', 1, 0, 0, NULL),
	(19, 'CLIENT', 'Ce ticket est en attente de validation/retour/précisions par le \r\nCLIENT.', 0, 0, 0, NULL),
	(14, 'RESOLU PAR SUIVI', 'Le ticket a été résolu au cours d''une visite régulière de suivi\r\net d''entretien du parc.', 0, 0, 0, NULL),
	(15, 'RESOLU PAR INTERVENTION URGENTE', 'Le ticket a été résolu suite �   une intervention dédiée en urgence.', 0, 0, 0, NULL),
	(16, 'INTERVENTION URGENTE EN COURS', 'Le ticket nécessite une intervention urgente, un intervenant de\r\nSpirea est actuellement sur site (ou en déplacement vers le site).', 0, 0, 0, NULL),
	(17, 'ANNULÉ', 'Le ticket est annulé après sa création ou l''erreur ne se reproduit pas.', 0, 0, 0, NULL),
	(18, 'RESOLU PAR INTERVENTION PLANIFIEE', 'RESOLU PAR INTERVENTION PLANIFIEE, résolution sur site, hors suivi et hors intervention urgente.', 0, 0, 0, NULL);
	";
	$sql_transition="INSERT INTO `spid_transitions` (`transition_id`, `name`, `description`, `source_id`, `target_id`) VALUES
	(1, 'TONEW', 'Put the preexistent ticket into the state %1.', 1, 2),
	(2, 'VERS ACCEPTER', 'Mettre les tickets précédents en l''état 3.', 1, 3),
	(3, 'TOREOPENED', 'Put the preexistent ticket into the state %1.', 1, 4),
	(4, 'TORESOLVED', 'Put the preexistent ticket into the state %1.', 1, 5),
	(5, 'TOVERIFIED', 'Put the preexistent ticket into the state %1.', 1, 6),
	(6, 'TOCLOSED', 'Put the preexistent ticket into the state %1.', 1, 7),
	(7, 'TOTOVALIDATE', 'Put the preexistent ticket into the state %1.', 1, 8),
	(8, 'TONEEDSWORK', 'Put the preexistent ticket into the state %1.', 1, 9),
	(9, 'TOINVALID', 'Put the preexistent ticket into the state %1.', 1, 10),
	(10, 'TODUPLICATE', 'Put the preexistent ticket into the state %1.', 1, 11),
	(11, 'ACCEPT', 'Accept the ticket into verification process.', 2, 3),
	(12, 'VERIFY', 'Verify the ticket to work on it.', 3, 6),
	(13, 'INVALIDATE', 'The ticket is invalid and cannot be worked on.', 3, 10),
	(14, 'DUPLICATE', 'The ticket is a duplicate of another ticket and should be closed.', 3, 11),
	(15, 'CLOSE', 'Close the invalid ticket.', 10, 7),
	(16, 'MOREWORK', 'I worked on the ticket, but did not finish.', 6, 9),
	(17, 'COMPLETED', 'I worked on the ticket and the work requires validation.', 6, 8),
	(18, 'COMPLETED', 'I worked on the ticket and the work requires validation.', 9, 8),
	(19, 'NOT COMPLETED', 'The validation of the ticket was unsuccessfull. The ticket requires more work.', 8, 9),
	(20, 'RESOLVE', 'The ticket resolution was successfully validated. Close the ticket.', 8, 5),
	(21, 'REOPEN', 'The closed ticket requires more work. Reopen it.', 7, 4),
	(22, 'REOPEN', 'The closed ticket requires more work. Reopen it.', 5, 4),
	(23, 'NO DUPLICATE', 'The ticket is essentially not a duplicate of another ticket. Reopen it.', 11, 4),
	(24, 'ACCEPT', 'Accept the ticket into verification process.', 4, 3),
	(25, 'NOUVEAU => RESOLU', 'Le problème est immédiatement [RESOLU]', 2, 5),
	(26, 'ACCEPTE => PROPOSITION', 'Le ticket donne lieu �   une PROPOSITION établie en dehors du\r\nsystème de tickets d''incidents.', 3, 12),
	(27, 'SUIVI EN COURS => RESOLU', 'Le ticket est RESOLU (hors suivi).', 13, 5),
	(28, 'ACCEPTE => INTERVENTION', 'Le ticket nécessite une INTERVENTION DE SUIVI (généralement mardi ou jeudi)', 3, 13),
	(29, 'SUIVI', 'Le ticket a été résolu au cours d''une récente INTERVENTION DE SUIVI', 13, 14),
	(30, 'ACCEPTE => URGENCE', 'Le ticket est en cours de traitement urgent.', 3, 16),
	(31, 'RESOLUTION EN URGENCE', 'Le ticket a été résolu par une INTERVENTION URGENTE avec un\r\ndéplacement dédié sur site', 16, 15),
	(32, 'NOUVEAU=>SUIVI', 'Ce ticket nécessite une INTERVENTION DE SUIVI, généralement le\r\nmardi ou jeudi après-midi', 2, 13),
	(33, 'ACCEPTE => RESOLU', 'Le ticket est immédiatement RESOLU', 3, 5),
	(34, 'NOUVEAU => URGENCE', 'Le ticket nécessite une INTERVENTION URGENTE', 2, 16),
	(35, 'NOUVEAU => DOUBLON', 'le même problème est annoncé deux fois, il est DUPLIQUE', 2, 11),
	(36, 'NOUVEAU => ANNULE', 'Le problème est résolu directement par l''utilsateur ou il\r\ns''agissait d''une fausse alerte, il est immédiatement ANNULE', 2, 17),
	(37, 'NOUVAU => PROPOSITION', '', 2, 12),
	(38, 'REOUVERT => RESOLU', 'Le ticket est RESOLU', 4, 5),
	(39, 'VERIFIE => RESOLU', 'Le ticket est maintenant RESOLU', 6, 5),
	(40, 'TRAVAIL => RESOLU', 'Le ticket est RESOLU', 9, 5),
	(41, 'RESOLU => PROPOSITION', 'Le ticket est en fait résolu par une PROPOSITION', 5, 12),
	(42, 'RESOLU => RESOLU PAR SUIVI', 'Le ticket a été RESOLU PAR SUIVI', 5, 14),
	(43, 'Correction RESOLU', 'Requalification de la résolution du problème en RESOLU', 15, 5),
	(44, 'PROPOSITION => INVALIDE', 'Le ticket est finalement INVALIDE avant la réalisation de la\r\nproposition', 12, 10),
	(45, 'SUIVI=>PROPOSITION', 'Le ticket est en fait résolu par une PROPOSITION', 13, 12),
	(46, 'REOUVERT => ANNULE', 'Le ticket correspond �   une fausse alerte, il est annulé', 5, 17),
	(47, 'ACCEPTE => ANNULE', 'Le problème est ANNULE, résolu directement par l''utilisateur ou\r\ncorresondant �   un faux problème', 3, 17),
	(48, 'SUIVI => ANNULE', 'Le ticket est finalement ANNULE', 13, 17),
	(49, 'RESOLU PAR SUIVI => SUIVI EN COURS', 'L''INTERVENTION DE SUIVI n''est pas tout �  fait terminée', 14, 13),
	(50, 'EN COURS => PROPOSITION', 'Le problème est traité hors suivi, dans une PROPOSITION', 9, 12),
	(51, 'SUIVI => DUPLIQUE', 'Le ticket est finalement DUPLIQUE', 13, 11),
	(52, 'Passage en résolu', 'Passage en résolu', 16, 5),
	(53, 'ANNULE => REOUVERT', 'Le ticket est REOUVERT après avoir été annulé', 17, 4),
	(54, 'VERIFIE => ANNULE', 'Le ticket est ANNULE', 6, 17),
	(55, 'VERIFIE => RESOLU PAR SUIVI', 'Le ticket est RESOLU EN INTERVENTION DE SUIVI', 6, 14),
	(56, 'Accepté => Résolu en intervention de Suivi', 'Le ticket a été résolu pendant une intervention de suivi.', 3, 14),
	(57, 'passage en intervention planifiée', 'Le ticket est en fait résolu sur site, par une INTERVENTION \r\nPLANIFIEE ou intervention assimilée', 5, 18),
	(58, 'REOUVERT->ANNULE', 'Le ticket est annulé après avoir été réouvert.', 4, 17),
	(59, 'NOUEVAU -> RESOLU PAR SUIVI', 'Le ticket a été RESOLU PAR SUIVI.', 2, 14),
	(60, 'ACCEPTE => CLIENT', 'Ce ticket est en attente de validation/retour/précisions par le\r\nCLIENT.', 3, 19),
	(61, 'CLIENT => ACCEPTE', 'Le ticket en attente est �  nouveau �  traiter par nos équipes...', 19, 3),
	(62, 'NOUVEAU => CLIENT', 'Ce ticket est en attente de validation/retour/précisions par le\r\nCLIENT.', 2, 19),
	(63, 'RESOLUSUIVI->RESOLU', 'Le ticket a un statut RESOLU.', 14, 5);";
	$sql_messages_standard="INSERT INTO `spid_reponses_standard` (`standard_reply_id`, `creator_id`, `canned_name`, `canned_content`, `creation_date`, `change_date`) VALUES
	(1, 0, 'Fermeture ticket', 'Bonjour,\r\n\r\nNous fermons ici ce ticket.\r\n\r\n\r\nCordialement,\r\n--\r\nSupport technique\r\nSpirea', 0, 0),
	(2, 0, 'Passage en production', 'Bonjour,\r\n\r\nNous avons effectués la mise �  jour sur le serveur de production.\r\n\r\n\r\nCordialement,\r\n--\r\nSupport technique\r\nSpirea', 0, 0),
	(3, 0, 'Réception email', 'Bonjour,\r\n\r\nSuite �  votre email, nous notons ici votre demande.\r\n\r\n\r\nCordialement,\r\n--\r\nSupport technique\r\nSpirea', 0, 0);
	";
	$oProc->query ($sql_etat);
	$oProc->query ($sql_transition);
	$oProc->query ($sql_messages_standard);
	$oProc->query ("DELETE FROM {$GLOBALS['egw_setup']->config_table} WHERE config_app='spid'");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spid','initial_price','30')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spid','initial_time','30')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spid','ticket_assigned_to','')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spid','ticket_management_group','')");
	$oProc->query ("INSERT INTO {$GLOBALS['egw_setup']->config_table} (config_app, config_name, config_value) VALUES ('spid','default_state_id','2')");
	
	
	$admingroup = $GLOBALS['egw_setup']->add_account('Admins','Admin','Group',False,False);
	$GLOBALS['egw_setup']->add_acl('spid','run',$admingroup);

?>
