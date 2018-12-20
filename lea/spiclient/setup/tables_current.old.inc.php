<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package tickets
 * @subpackage setup
 * @version $Id$
 */

$phpgw_baseline = array(
	'spiclient' => array(
		'fd' => array(
			'client_id' => array('type' => 'auto','nullable' => False),
			'account_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'client_first_name' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'client_last_name' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'client_company' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'client_adr_one_street' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'client_adr_two_street' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'client_locality' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'client_postalcode' => array('type' => 'varchar','precision' => '10','default' => 'NULL'),
			'client_email' => array('type' => 'varchar','precision' => '150','default' => 'NULL'),
			'client_tel' => array('type' => 'varchar','precision' => '40','default' => 'NULL'),
			'client_operation_code' => array('type' => 'varchar','precision' => '15','default' => 'NULL'),
			'client_tva' => array('type' => 'int','precision' => '1','nullable' => False,'default' => '1'),
			'client_billable_id' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '1'),
			'client_payment_model' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'client_fn' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'client_footer_one' => array('type' => 'text','default' => 'NULL'),
			'client_footer_two' => array('type' => 'text','default' => 'NULL'),
			'client_manager_email' => array('type' => 'varchar','precision' => '150','default' => 'NULL'),
			'client_sleep' => array('type' => 'int','precision' => '1','nullable' => False,'default' => '0'),
			'client_sector' => array('type' => 'int','precision' => '4','default' => 'NULL'),
			'client_code_tiers' => array('type' => 'varchar','precision' => '255'),
			'client_country' => array('type' => 'varchar','precision' => '255'),
			'client_seller_id' => array('type' => 'int','precision' => '4'),
			'client_parent' => array('type' => 'int','precision' => '4'),
			'client_region' => array('type' => 'int','precision' => '4'),
			'client_mode_reglement' => array('type' => 'int','precision' => '4'),
			'client_delai_paiement' => array('type' => 'int','precision' => '4'),
			'client_chalandise' => array('type' => 'int','precision' => '4'),
			'client_comment' => array('type' => 'text'),
			'client_adr_one_street_facturation' => array('type' => 'varchar','precision' => '100'),
			'client_adr_two_street_facturation' => array('type' => 'varchar','precision' => '100'),
			'client_locality_facturation' => array('type' => 'varchar','precision' => '50'),
			'client_postalcode_facturation' => array('type' => 'varchar','precision' => '10'),
			'client_country_facturation' => array('type' => 'varchar','precision' => '100'),
			'client_tva_number' => array('type' => 'varchar','precision' => '36'),
			'client_type' => array('type' => 'int','precision' => '4'),
			'client_sda' => array('type' => 'varchar','precision' => '250'),
			'creator_id' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'maj_id' => array('type' => 'int','precision' => '4','default' => '0'),
			'client_siret' => array('type' => 'varchar','precision' => '100'),
			'client_manager_id' => array('type' => 'int','precision' => '4'),
			'client_fax' => array('type' => 'varchar','precision' => '40'),
			'client_time_limit' => array('type' => 'int','precision' => '4'),
			'client_logo' => array('type' => 'blob'),
			'client_code_agency' => array('type' => 'varchar','precision' => '255'),
			'client_adr_three_street_facturation' => array('type' => 'varchar','precision' => '100'),
			'client_comm_register' => array('type' => 'varchar','precision' => '100'),
			'client_bic' => array('type' => 'varchar','precision' => '11'),
			'client_iban' => array('type' => 'varchar','precision' => '34'),
			'client_bank' => array('type' => 'varchar','precision' => '35'),
			'client_agency' => array('type' => 'varchar','precision' => '35'),
			'client_website' => array('type' => 'varchar','precision' => '255'),
			'client_training' => array('type' => 'varchar','precision' => '255'),
			'client_structure' => array('type' => 'varchar','precision' => '255'),
			'client_email_cc' => array('type' => 'text'),
			'client_is_chalandise' => array('type' => 'bool'),
			'client_is_parent' => array('type' => 'bool'),
			'client_bic_two' => array('type' => 'varchar','precision' => '11'),
			'client_iban_two' => array('type' => 'varchar','precision' => '34'),
			'client_bank_two' => array('type' => 'varchar','precision' => '35'),
			'client_agency_two' => array('type' => 'varchar','precision' => '35')
		),
		'pk' => array('client_id'),
		'fk' => array('client_seller_id' => 'egw_accounts','client_parent' => 'spiclient','client_mode_reglement' => 'spiclient_mode_reglement','client_delai_paiement' => 'spiclient_delai_paiement','client_chalandise' => 'spiclient','client_type' => 'spiclient_type_client','client_manager_id' => 'egw_accounts'),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_relations' => array(
		'fd' => array(
			'relation_id' => array('type' => 'auto','nullable' => False),
			'societe_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'payment_model' => array('type' => 'int','precision' => '4','nullable' => False),
			'operation_code' => array('type' => 'varchar','precision' => '30','nullable' => False)
		),
		'pk' => array('relation_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_contrats' => array(
		'fd' => array(
			'contract_id' => array('type' => 'auto','nullable' => False),
			'relation_id' => array('type' => 'int','precision' => '4'),
			'type_id' => array('type' => 'int','precision' => '4'),
			'date_signature' => array('type' => 'int','precision' => '20'),
			'date_renewal' => array('type' => 'int','precision' => '20'),
			'date_end' => array('type' => 'int','precision' => '20'),
			'date_last_invoice' => array('type' => 'int','precision' => '20'),
			'contract_period' => array('type' => 'varchar','precision' => '30'),
			'contract_path' => array('type' => 'varchar','precision' => '200'),
			'contract_amount' => array('type' => 'int','precision' => '20'),
			'contract_actions' => array('type' => 'longtext'),
			'contract_conditions' => array('type' => 'longtext'),
			'contract_conditions_hardware' => array('type' => 'longtext'),
			'comment' => array('type' => 'longtext'),
			'contract_title' => array('type' => 'varchar','precision' => '50'),
			'contract_client_ref' => array('type' => 'varchar','precision' => '50'),
			'contract_supplier' => array('type' => 'int','precision' => '4'),
			'contract_client' => array('type' => 'int','precision' => '4'),
			'contract_seller_id' => array('type' => 'int','precision' => '4'),
			'contract_n_budget_amount' => array('type' => 'int','precision' => '4'),
			'contract_n_budget_days' => array('type' => 'decimal','precision' => '4'),
			'contract_n_real_amount' => array('type' => 'int','precision' => '4'),
			'contract_n_real_days' => array('type' => 'decimal','precision' => '4'),
			'contract_libre1' => array('type' => 'varchar','precision' => '50'),
			'contract_libre2' => array('type' => 'varchar','precision' => '50'),
			'contract_libre3' => array('type' => 'varchar','precision' => '50'),
			'contract_libre4' => array('type' => 'varchar','precision' => '50'),
			'contract_libre5' => array('type' => 'varchar','precision' => '50'),
			'status_id' => array('type' => 'int','precision' => '4'),
			'date_start' => array('type' => 'int','precision' => '20'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_id' => array('type' => 'int','precision' => '4'),
			'contract_manager_id' => array('type' => 'int','precision' => '4'),
			'contract_payer' => array('type' => 'int','precision' => '4'),
			'contract_attorney' => array('type' => 'int','precision' => '4'),
			'contract_default_price' => array('type' => 'decimal','precision' => '10','scale' => '2'),
			'contract_cosupplier' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('contract_id'),
		'fk' => array('relation_id' => 'spiclient_relations','type_id' => 'spiclient_contrats_type','contract_supplier' => 'spiclient','contract_client' => 'spiclient','contract_seller_id' => 'egw_accounts','contract_manager_id' => 'egw_accounts','contract_cosupplier' => 'spiclient'),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_contrats_type' => array(
		'fd' => array(
			'type_id' => array('type' => 'auto','precision' => '4','nullable' => False),
			'type_label' => array('type' => 'varchar','precision' => '255'),
			'type_description' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('type_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_sectors' => array(
		'fd' => array(
			'sector_id' => array('type' => 'auto','nullable' => False),
			'sector_name' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'creator_id' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'change_id' => array('type' => 'int','precision' => '4','default' => '0')
		),
		'pk' => array('sector_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_locations' => array(
		'fd' => array(
			'location_id' => array('type' => 'auto','nullable' => False),
			'location_parent' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'location_name' => array('type' => 'varchar','precision' => '150','default' => 'NULL'),
			'location_description' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'location_data' => array('type' => 'text','default' => 'NULL'),
			'location_level' => array('type' => 'int','precision' => '4','default' => '0'),
			'creator_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0')
		),
		'pk' => array('location_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_contrats_status' => array(
		'fd' => array(
			'status_id' => array('type' => 'auto','precision' => '4','nullable' => False),
			'status_label' => array('type' => 'varchar','precision' => '255'),
			'status_description' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('status_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_mode_reglement' => array(
		'fd' => array(
			'mode_reglement_id' => array('type' => 'auto','nullable' => False),
			'mode_reglement_label' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'mode_reglement_defaut' => array('type' => 'bool','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('mode_reglement_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_delai_paiement' => array(
		'fd' => array(
			'delai_id' => array('type' => 'auto','nullable' => False),
			'delai_label' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'delai_defaut' => array('type' => 'bool','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4'),
			'delai_days' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('delai_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_zones' => array(
		'fd' => array(
			'zone_id' => array('type' => 'auto','nullable' => False),
			'zone_label' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'zone_parent' => array('type' => 'int','precision' => '4'),
			'zone_pays' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('zone_id'),
		'fk' => array('zone_parent' => 'spiclient_zone'),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_roles' => array(
		'fd' => array(
			'role_id' => array('type' => 'auto','nullable' => False),
			'role_label' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4'),
			'role_active' => array('type' => 'bool'),
			'role_contact_active' => array('type' => 'bool')
		),
		'pk' => array('role_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_client_nature' => array(
		'fd' => array(
			'client_nature_id' => array('type' => 'auto','nullable' => False),
			'nature_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'client_nature_titre' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'client_nature_description' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'client_nature_commentaire' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'client_nature_panne' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'client_nature_ordre' => array('type' => 'int','precision' => '4'),
			'client_nature_actif' => array('type' => 'bool','default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'maj_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('client_nature_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_nature_technique' => array(
		'fd' => array(
			'nature_id' => array('type' => 'auto','nullable' => False),
			'nature_label' => array('type' => 'varchar','precision' => '250','nullable' => False),
			'nature_active' => array('type' => 'bool','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('nature_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_type_client' => array(
		'fd' => array(
			'type_client_id' => array('type' => 'auto','nullable' => False),
			'type_client_label' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'type_client_couleur' => array('type' => 'varchar','precision' => '50'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'change_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('type_client_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_checklist' => array(
		'fd' => array(
			'chk_id' => array('type' => 'auto','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'cat_id' => array('type' => 'int','precision' => '4'),
			'chk_title' => array('type' => 'varchar','precision' => '255'),
			'chk_comment' => array('type' => 'varchar','precision' => '255'),
			'chk_active' => array('type' => 'bool'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'maj_id' => array('type' => 'int','precision' => '4'),
			'chk_order' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('chk_id'),
		'fk' => array('client_id' => 'spiclient'),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_contrats_member' => array(
		'fd' => array(
			'contract_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'account_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'role_id' => array('type' => 'int','precision' => '4'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'creator' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('contract_id','account_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_contrats_budget' => array(
		'fd' => array(
			'budget_id' => array('type' => 'auto','nullable' => False),
			'contract_id' => array('type' => 'int','precision' => '4'),
			'budget_phase' => array('type' => 'varchar','precision' => '255'),
			'cat_id' => array('type' => 'int','precision' => '4'),
			'budget_unit' => array('type' => 'varchar','precision' => '1'),
			'budget_quantity' => array('type' => 'decimal','precision' => '10','scale' => '2'),
			'budget_cost' => array('type' => 'decimal','precision' => '10','scale' => '2'),
			'budget_sell' => array('type' => 'decimal','precision' => '10','scale' => '2'),
			'budget_date' => array('type' => 'int','precision' => '20'),
			'creator' => array('type' => 'int','precision' => '4'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'modifier' => array('type' => 'int','precision' => '4'),
			'date_modified' => array('type' => 'int','precision' => '20')
		),
		'pk' => array('budget_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_address_type' => array(
		'fd' => array(
			'address_type_id' => array('type' => 'auto','nullable' => False),
			'address_type_label' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'creator' => array('type' => 'int','precision' => '4'),
			'modify_date' => array('type' => 'int','precision' => '20'),
			'modifier' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('address_type_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spiclient_address' => array(
		'fd' => array(
			'address_id' => array('type' => 'auto','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '4'),
			'address_street_one' => array('type' => 'varchar','precision' => '255'),
			'address_street_two' => array('type' => 'varchar','precision' => '255'),
			'address_postalcode' => array('type' => 'varchar','precision' => '10'),
			'address_city' => array('type' => 'varchar','precision' => '255'),
			'address_country' => array('type' => 'varchar','precision' => '255'),
			'address_last_name' => array('type' => 'varchar','precision' => '255'),
			'address_first_name' => array('type' => 'varchar','precision' => '255'),
			'address_mail' => array('type' => 'varchar','precision' => '255'),
			'address_tel' => array('type' => 'varchar','precision' => '20'),
			'address_fax' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'creator' => array('type' => 'int','precision' => '4'),
			'modify_date' => array('type' => 'int','precision' => '20'),
			'modifier' => array('type' => 'int','precision' => '4'),
			'address_type_id' => array('type' => 'int','precision' => '4'),
			'address_label' => array('type' => 'varchar','precision' => '255')
		),
		'pk' => array('address_id'),
		'fk' => array('client_id' => 'spiclient'),
		'ix' => array(),
		'uc' => array()
	)
);
