CREATE TABLE IF NOT EXISTS `egw_bp` (
  `id_bp` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_owner` bigint(20) NOT NULL,
  `date_creation` bigint(20) NOT NULL,
  `id_projet` bigint(20) NOT NULL,
  `id_contact` bigint(20) NOT NULL,
  `id_referent` bigint(20) NOT NULL,
  `date_last_consultant` bigint(20) NOT NULL,
  `id_last_consultant` bigint(20) NOT NULL,
  `statut_dossier` varchar(64) NOT NULL,
  PRIMARY KEY (`id_bp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_action_commerciale` (
  `id_action_commerciale` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `action` varchar(128) NOT NULL,
  `budget` float NOT NULL,
  `date_debut` bigint(128) NOT NULL,
  `date_fin` bigint(128) NOT NULL,
  `ca_escompte` float NOT NULL,
  PRIMARY KEY (`id_action_commerciale`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_charge` (
  `id_bp_charge` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `date_creation` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `nature` varchar(64) NOT NULL,
  `loyer` decimal(10,0) NOT NULL,
  `credit_conso` decimal(10,0) NOT NULL,
  `credit_auto` decimal(10,0) NOT NULL,
  `credit_immo` decimal(10,0) NOT NULL,
  `pension_alimentaire` decimal(10,0) NOT NULL,
  `credit_revolving` decimal(10,0) NOT NULL,
  `autre` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_bp_charge`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_famille_produits` (
  `id_famille_produit` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `id_bp` bigint(20) NOT NULL,
  `libelle_famille` varchar(128) NOT NULL,
  PRIMARY KEY (`id_famille_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_gamme_produits` (
  `id_gamme_produit` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `id_bp` bigint(20) NOT NULL,
  `id_famille_produit` bigint(11) NOT NULL,
  `libelle_gamme` varchar(128) NOT NULL,
  PRIMARY KEY (`id_gamme_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_moyen_humain` (
  `id_bp_moyen_humain` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `type_moyen` varchar(128) NOT NULL,
  `salaire_brut_mensuel` int(11) DEFAULT NULL,
  `nombre_debut_activite` int(11) DEFAULT NULL,
  `nombre_annee1` int(11) DEFAULT NULL,
  `nombre_annee2` int(11) DEFAULT NULL,
  `nombre_annee3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bp_moyen_humain`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_moyen_immeuble_terrain` (
  `id_bp_moyen_immeuble_terrain` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `type` varchar(128) NOT NULL,
  `demarrage` int(11) DEFAULT NULL,
  `annee1` int(11) DEFAULT NULL,
  `annee2` int(11) DEFAULT NULL,
  `annee3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bp_moyen_immeuble_terrain`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_produits` (
  `id_produit` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_creation` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `id_bp` bigint(20) NOT NULL,
  `id_famille_produit` bigint(20) DEFAULT NULL,
  `id_gamme_produit` bigint(20) DEFAULT NULL,
  `libelle_produit` varchar(128) NOT NULL,
  `prix_achat` decimal(10,2) DEFAULT NULL,
  `prix_vente` decimal(10,2) DEFAULT NULL,
  `stock_initial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_produits_concurrents` (
  `id_produits_concurrents` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `id_produit` bigint(20) NOT NULL,
  PRIMARY KEY (`id_produits_concurrents`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_produits_concurrents_details` (
  `id_produits_concurrents_details` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_produits_concurrents` bigint(20) NOT NULL,
  `libelle_details` varchar(128) NOT NULL,
  `valeur` varchar(128) NOT NULL,
  PRIMARY KEY (`id_produits_concurrents_details`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_ressource` (
  `id_bp_ressource` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `date_creation` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `personne` varchar(64) NOT NULL,
  `revenu_pro_net` decimal(10,0) NOT NULL,
  `retraite` decimal(10,0) NOT NULL,
  `pole_emploi` decimal(10,0) NOT NULL,
  `pensions` decimal(10,0) NOT NULL,
  `rsa` decimal(10,0) NOT NULL,
  `prestations_familiales` decimal(10,0) NOT NULL,
  `aide_logement` decimal(10,0) NOT NULL,
  `allocations_diverses` decimal(10,0) NOT NULL,
  `autres` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_bp_ressource`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `egw_bp_tableau_swot` (
  `id_tableau_swot` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `id_owner` bigint(20) NOT NULL,
  `date_creation` bigint(20) NOT NULL,
  `date_last_modified` bigint(20) NOT NULL,
  `id_modifier` bigint(20) NOT NULL,
  `text_forces` varchar(128) NOT NULL,
  `text_faiblesses` varchar(128) NOT NULL,
  `text_opportunites` varchar(128) NOT NULL,
  `text_menaces` varchar(128) NOT NULL,
  PRIMARY KEY (`id_tableau_swot`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_texte` (
  `id_bp_texte` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `texte_titre_intro` longtext,
  `texte_titre_1_1` longtext,
  `texte_titre_1_2` longtext,
  `texte_titre_2_1` longtext,
  `texte_titre_2_2` longtext,
  `texte_titre_2_3` longtext,
  `texte_titre_3_0` longtext,
  `texte_titre_3_1_1` longtext,
  `texte_titre_3_1_2` longtext,
  `texte_titre_3_2_1` longtext,
  `texte_titre_3_2_2` longtext,
  `texte_titre_3_2_3` longtext,
  `texte_titre_3_3_1` longtext,
  `texte_titre_3_3_2` longtext,
  `texte_titre_3_3_3` longtext,
  `texte_titre_3_4` longtext,
  `texte_titre_4_1` longtext,
  `texte_titre_4_2_1` longtext,
  `texte_titre_4_2_2` longtext,
  `texte_titre_4_2_3` longtext,
  `texte_titre_4_2_4` longtext,
  `texte_titre_4_3_1` longtext,
  `texte_titre_4_3_2` longtext,
  `texte_titre_4_3_3` longtext,
  `texte_titre_4_4_1` longtext,
  `texte_titre_4_4_2` longtext,
  `texte_titre_4_4_3` longtext,
  `texte_titre_5` longtext,
  `texte_titre_6_1` longtext,
  `texte_titre_6_2` longtext,
  `texte_titre_6_3` longtext,
  `texte_titre_7` longtext,
  `texte_titre_8` longtext,
  `texte_titre_9` longtext,
  PRIMARY KEY (`id_bp_texte`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `egw_bp_texte_aspect` (
  `id_bp_texte_aspect` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `texte_titre_1` longtext NOT NULL,
  `texte_titre_2` longtext NOT NULL,
  `texte_titre_3` longtext NOT NULL,
  PRIMARY KEY (`id_bp_texte_aspect`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_texte_financier` (
  `id_bp_texte_financier` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `texte_titre_1_1` longtext NOT NULL,
  `texte_titre_1_2` longtext NOT NULL,
  PRIMARY KEY (`id_bp_texte_financier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_texte_presentation` (
  `id_bp_texte_presentation` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `texte_titre_2_1` longtext NOT NULL,
  `texte_titre_2_2` longtext NOT NULL,
  `texte_titre_2_3` longtext NOT NULL,
  `texte_titre_2_4_1` longtext NOT NULL,
  `texte_titre_2_4_2` longtext NOT NULL,
  `texte_titre_2_4_3` longtext NOT NULL,
  PRIMARY KEY (`id_bp_texte_presentation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_texte_projet` (
  `id_bp_texte_projet` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `texte_titre_1_1` longtext NOT NULL,
  `texte_titre_1_2` longtext NOT NULL,
  `texte_titre_1_3` longtext NOT NULL,
  `texte_titre_1_4` longtext NOT NULL,
  `texte_titre_1_5` longtext NOT NULL,
  `texte_titre_1_6` longtext NOT NULL,
  `texte_titre_2_1` longtext NOT NULL,
  `texte_titre_2_2` longtext NOT NULL,
  `texte_titre_2_3` longtext NOT NULL,
  `texte_titre_2_4` longtext NOT NULL,
  `texte_titre_3_3` longtext NOT NULL,
  `texte_titre_3_4` longtext NOT NULL,
  `texte_titre_3_5` longtext NOT NULL,
  PRIMARY KEY (`id_bp_texte_projet`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `egw_bp_titre` (
  `id_bp_titre` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) DEFAULT NULL,
  `titre_sommaire` varchar(128) DEFAULT NULL,
  `titre_intro` varchar(128) DEFAULT NULL,
  `titre_1` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `titre_1_1` varchar(128) DEFAULT NULL,
  `titre_1_2` varchar(128) DEFAULT NULL,
  `titre_2` varchar(128) DEFAULT NULL,
  `titre_2_1` varchar(128) DEFAULT NULL,
  `titre_2_2` varchar(128) DEFAULT NULL,
  `titre_2_3` varchar(128) DEFAULT NULL,
  `titre_3` varchar(128) DEFAULT NULL,
  `titre_3_0` varchar(128) DEFAULT NULL,
  `titre_3_1` varchar(128) DEFAULT NULL,
  `titre_3_1_1` varchar(128) DEFAULT NULL,
  `titre_3_1_2` varchar(128) DEFAULT NULL,
  `titre_3_2` varchar(128) DEFAULT NULL,
  `titre_3_2_1` varchar(128) DEFAULT NULL,
  `titre_3_2_2` varchar(128) DEFAULT NULL,
  `titre_3_2_3` varchar(128) DEFAULT NULL,
  `titre_3_3` varchar(128) DEFAULT NULL,
  `titre_3_3_1` varchar(128) DEFAULT NULL,
  `titre_3_3_2` varchar(128) DEFAULT NULL,
  `titre_3_3_3` varchar(128) DEFAULT NULL,
  `titre_3_4` varchar(128) DEFAULT NULL,
  `titre_4` varchar(128) DEFAULT NULL,
  `titre_4_1` varchar(128) DEFAULT NULL,
  `titre_4_2` varchar(128) DEFAULT NULL,
  `titre_4_2_1` varchar(128) DEFAULT NULL,
  `titre_4_2_2` varchar(128) DEFAULT NULL,
  `titre_4_2_3` varchar(128) DEFAULT NULL,
  `titre_4_2_4` varchar(128) DEFAULT NULL,
  `titre_4_3` varchar(128) DEFAULT NULL,
  `titre_4_3_1` varchar(128) DEFAULT NULL,
  `titre_4_3_2` varchar(128) DEFAULT NULL,
  `titre_4_3_3` varchar(128) DEFAULT NULL,
  `titre_4_4` varchar(128) DEFAULT NULL,
  `titre_4_4_1` varchar(128) DEFAULT NULL,
  `titre_4_4_2` varchar(128) DEFAULT NULL,
  `titre_4_4_3` varchar(128) DEFAULT NULL,
  `titre_5` varchar(128) DEFAULT NULL,
  `titre_6` varchar(128) DEFAULT NULL,
  `titre_6_1` varchar(128) DEFAULT NULL,
  `titre_6_2` varchar(128) DEFAULT NULL,
  `titre_6_3` varchar(128) DEFAULT NULL,
  `titre_7` varchar(128) DEFAULT NULL,
  `titre_8` varchar(128) DEFAULT NULL,
  `titre_9` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_bp_titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_titre_dossier_financier` (
  `id_bp_titre_dossier_financier` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` int(11) NOT NULL,
  `titre_1` varchar(128) NOT NULL,
  `titre_1_1` varchar(128) NOT NULL,
  `titre_1_2` varchar(128) NOT NULL,
  `titre_1_3` varchar(128) NOT NULL,
  `titre_2` varchar(128) NOT NULL,
  `titre_2_1` varchar(128) NOT NULL,
  `titre_2_2` varchar(128) NOT NULL,
  `titre_2_3` varchar(128) NOT NULL,
  `titre_2_4` varchar(128) NOT NULL,
  `titre_2_5` varchar(128) NOT NULL,
  `titre_2_6` varchar(128) NOT NULL,
  PRIMARY KEY (`id_bp_titre_dossier_financier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



CREATE TABLE IF NOT EXISTS `egw_bp_titre_presentation` (
  `id_bp_titre_presentation` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) NOT NULL,
  `titre_1` varchar(128) NOT NULL,
  `titre_1_1` varchar(128) NOT NULL,
  `titre_1_2` varchar(128) NOT NULL,
  `titre_1_3` varchar(128) NOT NULL,
  `titre_2` varchar(128) NOT NULL,
  `titre_2_1` varchar(128) NOT NULL,
  `titre_2_2` varchar(128) NOT NULL,
  `titre_2_3` varchar(128) NOT NULL,
  `titre_2_4` varchar(128) NOT NULL,
  `titre_2_4_1` varchar(128) NOT NULL,
  `titre_2_4_2` varchar(128) NOT NULL,
  `titre_2_4_3` varchar(128) NOT NULL,
  PRIMARY KEY (`id_bp_titre_presentation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `egw_bp_titre_projet` (
  `id_bp_titre_projet` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` int(11) NOT NULL,
  `titre_1` varchar(128) NOT NULL,
  `titre_1_1` varchar(128) NOT NULL,
  `titre_1_2` varchar(128) NOT NULL,
  `titre_1_3` varchar(128) NOT NULL,
  `titre_1_4` varchar(128) NOT NULL,
  `titre_1_5` varchar(128) NOT NULL,
  `titre_1_6` varchar(128) NOT NULL,
  `titre_2` varchar(128) NOT NULL,
  `titre_2_1` varchar(128) NOT NULL,
  `titre_2_2` varchar(128) NOT NULL,
  `titre_2_3` varchar(128) NOT NULL,
  `titre_2_4` varchar(128) NOT NULL,
  `titre_3` varchar(128) NOT NULL,
  `titre_3_1` varchar(128) NOT NULL,
  `titre_3_2` varchar(128) NOT NULL,
  `titre_3_3` varchar(128) NOT NULL,
  `titre_3_4` varchar(128) NOT NULL,
  `titre_3_5` varchar(128) NOT NULL,
  `titre_4` varchar(128) NOT NULL,
  `titre_4_1` varchar(128) NOT NULL,
  `titre_4_1_1` varchar(128) NOT NULL,
  `titre_4_1_2` varchar(128) NOT NULL,
  `titre_4_1_3` varchar(128) NOT NULL,
  `titre_4_1_4` varchar(128) NOT NULL,
  `titre_4_1_5` varchar(128) NOT NULL,
  `titre_4_2` varchar(128) NOT NULL,
  `titre_4_2_1` varchar(128) NOT NULL,
  `titre_4_2_2` varchar(128) NOT NULL,
  `titre_4_2_3` varchar(128) NOT NULL,
  `titre_4_3` varchar(128) NOT NULL,
  `titre_4_3_1` varchar(128) NOT NULL,
  `titre_4_3_2` varchar(128) NOT NULL,
  `titre_4_3_3` varchar(128) NOT NULL,
  `titre_4_3_4` varchar(128) NOT NULL,
  PRIMARY KEY (`id_bp_titre_projet`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `egw_bp_titre_validation` (
  `id_bp_titre_validation` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bp` bigint(20) DEFAULT NULL,
  `bool_titre_sommaire` tinyint(1) DEFAULT '1',
  `bool_titre_intro` tinyint(1) DEFAULT '1',
  `bool_titre_1` tinyint(1) DEFAULT '1',
  `bool_titre_1_1` tinyint(1) DEFAULT '1',
  `bool_titre_1_2` tinyint(1) DEFAULT '1',
  `bool_titre_2` tinyint(1) DEFAULT '1',
  `bool_titre_2_1` tinyint(1) DEFAULT '1',
  `bool_titre_2_2` tinyint(1) DEFAULT '1',
  `bool_titre_2_3` tinyint(1) DEFAULT '1',
  `bool_titre_3` tinyint(1) DEFAULT '1',
  `bool_titre_3_0` tinyint(1) DEFAULT '1',
  `bool_titre_3_1` tinyint(1) DEFAULT '1',
  `bool_titre_3_1_1` tinyint(1) DEFAULT '1',
  `bool_titre_3_1_2` tinyint(1) DEFAULT '1',
  `bool_titre_3_2` tinyint(1) DEFAULT '1',
  `bool_titre_3_2_1` tinyint(1) DEFAULT '1',
  `bool_titre_3_2_2` tinyint(1) DEFAULT '1',
  `bool_titre_3_2_3` tinyint(1) DEFAULT '1',
  `bool_titre_3_3` tinyint(1) DEFAULT '1',
  `bool_titre_3_3_1` tinyint(1) DEFAULT '1',
  `bool_titre_3_3_2` tinyint(1) DEFAULT '1',
  `bool_titre_3_3_3` tinyint(1) DEFAULT '1',
  `bool_titre_3_4` tinyint(1) DEFAULT '1',
  `bool_titre_4` tinyint(1) DEFAULT '1',
  `bool_titre_4_1` tinyint(1) DEFAULT '1',
  `bool_titre_4_2` tinyint(1) DEFAULT '1',
  `bool_titre_4_2_1` tinyint(1) DEFAULT '1',
  `bool_titre_4_2_2` tinyint(1) DEFAULT '1',
  `bool_titre_4_2_3` tinyint(1) DEFAULT '1',
  `bool_titre_4_2_4` tinyint(1) DEFAULT '1',
  `bool_titre_4_3` tinyint(1) DEFAULT '1',
  `bool_titre_4_3_1` tinyint(1) DEFAULT '1',
  `bool_titre_4_3_2` tinyint(1) DEFAULT '1',
  `bool_titre_4_3_3` tinyint(1) DEFAULT '1',
  `bool_titre_4_4` tinyint(1) DEFAULT '1',
  `bool_titre_4_4_1` tinyint(1) DEFAULT '1',
  `bool_titre_4_4_2` tinyint(1) DEFAULT '1',
  `bool_titre_4_4_3` tinyint(1) DEFAULT '1',
  `bool_titre_5` tinyint(1) DEFAULT '1',
  `bool_titre_6` tinyint(1) DEFAULT '1',
  `bool_titre_6_1` tinyint(1) DEFAULT '1',
  `bool_titre_6_2` tinyint(1) DEFAULT '1',
  `bool_titre_6_3` tinyint(1) DEFAULT '1',
  `bool_titre_7` tinyint(1) DEFAULT '1',
  `bool_titre_8` tinyint(1) DEFAULT '1',
  `bool_titre_9` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_bp_titre_validation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




