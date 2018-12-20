<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package spindf
 * @subpackage setup
 * @version $Id$
 */

$phpgw_baseline = array(
	'egw_contact' => array(
		'fd' => array(
			'id_ben' => array('type' => 'auto','nullable' => False),
			'id_organisation' => array('type' => 'int','precision' => '4','nullable' => False),
			'id_owner' => array('type' => 'int','precision' => '4','nullable' => False),
			'date_creation' => array('type' => 'int','precision' => '4','nullable' => False),
			'id_modifier' => array('type' => 'int','precision' => '4','nullable' => False),
			'date_last_modified' => array('type' => 'int','precision' => '4','nullable' => False),
			'cat_id' => array('type' => 'varchar','precision' => '32','default' => 'NULL'),
			'nom_complet' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'nom' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'prenom' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'deuxieme_prenom' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'nom_jeune_fille' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'civilite' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'organisation' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'fonction' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'Service' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'adresse_ligne_1' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'adresse_ligne_2' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'adresse_ligne_3' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'ville' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'region' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'cp' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'pays' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'tel_pro_1' => array('type' => 'varchar','precision' => '40','default' => 'NULL'),
			'tel_pro_2' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'tel_domicile_1' => array('type' => 'varchar','precision' => '14','default' => 'NULL'),
			'tel_domicile_2' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'fax_pro' => array('type' => 'varchar','precision' => '40','default' => 'NULL'),
			'fax_perso' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'portable_pro' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'portable_perso' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'email_pro' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'email_perso' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),
			'site_perso' => array('type' => 'varchar','precision' => '64','default' => 'NULL'),

		),
		'pk' => array('id_ben'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	)
);