<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package spiclient
 * @subpackage setup
 * @version $Id$
 */

function spiclient_upgrade1_000()
{
	$GLOBALS['egw_setup']->oProc->AlterColumn('spiclient_client_nature','nature_id',array(
		'type' => 'int',
		'precision' => '4',
		'nullable' => False
	));
	$GLOBALS['egw_setup']->oProc->AlterColumn('spiclient_client_nature','client_id',array(
		'type' => 'int',
		'precision' => '4',
		'nullable' => False
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.001';
}


function spiclient_upgrade1_001()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_siret',array(
		'type' => 'varchar',
		'precision' => '100'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.002';
}


function spiclient_upgrade1_002()
{
	/* done by RefreshTable() anyway
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_manager_id',array(
		'type' => 'int',
		'precision' => '4'
	));*/
	$GLOBALS['egw_setup']->oProc->RefreshTable('spiclient',array(
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
			'client_region' => array('type' => 'varchar','precision' => '255'),
			'client_mode_reglement' => array('type' => 'int','precision' => '4'),
			'client_delai_paiement' => array('type' => 'int','precision' => '4'),
			'client_chalandise' => array('type' => 'int','precision' => '4'),
			'client_comment' => array('type' => 'varchar','precision' => '255'),
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
			'client_manager_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('client_id'),
		'fk' => array('client_seller_id' => 'egw_accounts','client_parent' => 'spiclient','client_mode_reglement' => 'spiclient_mode_reglement','client_delai_paiement' => 'spiclient_delai_paiement','client_chalandise' => 'spiclient','client_type' => 'spiclient_type_client','client_manager_id' => 'egw_accounts'),
		'ix' => array(),
		'uc' => array()
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.003';
}


function spiclient_upgrade1_003()
{
	/* done by RefreshTable() anyway
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_contrats','contract_manager_id',array(
		'type' => 'int',
		'precision' => '4'
	));*/
	$GLOBALS['egw_setup']->oProc->RefreshTable('spiclient_contrats',array(
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
			'contract_manager_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('contract_id'),
		'fk' => array('relation_id' => 'spiclient_relations','type_id' => 'spiclient_contrats_type','contract_supplier' => 'spiclient','contract_client' => 'spiclient','contract_seller_id' => 'egw_accounts','contract_manager_id' => 'egw_accounts'),
		'ix' => array(),
		'uc' => array()
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.004';
}


function spiclient_upgrade1_004()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('spiclient_checklist',array(
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
			'maj_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('chk_id'),
		'fk' => array('client_id' => 'spiclient'),
		'ix' => array(),
		'uc' => array()
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.005';
}


function spiclient_upgrade1_005()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_checklist','chk_order',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.006';
}


function spiclient_upgrade1_006()
{
	$GLOBALS['egw_setup']->oProc->AlterColumn('spiclient','client_comment',array(
		'type' => 'text'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.007';
}


function spiclient_upgrade1_007()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_fax',array(
		'type' => 'varchar',
		'precision' => '40'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.008';
}


function spiclient_upgrade1_008()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_time_limit',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.009';
}


function spiclient_upgrade1_009()
{
	$GLOBALS['egw_setup']->oProc->AlterColumn('spiclient','client_region',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.010';
}


function spiclient_upgrade1_010()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_logo',array(
		'type' => 'blob'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.011';
}


function spiclient_upgrade1_011()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_code_agency',array(
		'type' => 'varchar',
		'precision' => '255'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.012';
}


function spiclient_upgrade1_012()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_contrats','contract_payer',array(
		'type' => 'int',
		'precision' => '4'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_contrats','contract_attorney',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.013';
}


function spiclient_upgrade1_013()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_adr_three_street_facturation',array(
		'type' => 'varchar',
		'precision' => '100'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.014';
}


function spiclient_upgrade1_014()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_comm_register',array(
		'type' => 'varchar',
		'precision' => '100'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.015';
}


function spiclient_upgrade1_015()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_contrats','contract_default_price',array(
		'type' => 'decimal',
		'precision' => '10',
		'scale' => '2'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.016';
}


function spiclient_upgrade1_016()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_bic',array(
		'type' => 'varchar',
		'precision' => '11'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_iban',array(
		'type' => 'varchar',
		'precision' => '34'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_bank',array(
		'type' => 'varchar',
		'precision' => '35'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_agency',array(
		'type' => 'varchar',
		'precision' => '35'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.017';
}


function spiclient_upgrade1_017()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_roles','role_active',array(
		'type' => 'bool'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_roles','role_contact_active',array(
		'type' => 'bool'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.018';
}


function spiclient_upgrade1_018()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_website',array(
		'type' => 'varchar',
		'precision' => '255'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_training',array(
		'type' => 'varchar',
		'precision' => '255'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_structure',array(
		'type' => 'varchar',
		'precision' => '255'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.019';
}


function spiclient_upgrade1_019()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_email_cc',array(
		'type' => 'text'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.020';
}


function spiclient_upgrade1_020()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_is_chalandise',array(
		'type' => 'bool'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_is_parent',array(
		'type' => 'bool'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.021';
}


function spiclient_upgrade1_021()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('spiclient_contrats_member',array(
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
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.022';
}


function spiclient_upgrade1_022()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('spiclient_contrats_budget',array(
		'fd' => array(
			'budget_id' => array('type' => 'int','precision' => '4','nullable' => False),
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
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.023';
}


function spiclient_upgrade1_023()
{
	$GLOBALS['egw_setup']->oProc->AlterColumn('spiclient_contrats_budget','budget_id',array(
		'type' => 'auto',
		'nullable' => False
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.024';
}


function spiclient_upgrade1_024()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_bic_two',array(
		'type' => 'varchar',
		'precision' => '11'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_iban_two',array(
		'type' => 'varchar',
		'precision' => '34'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_bank_two',array(
		'type' => 'varchar',
		'precision' => '35'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient','client_agency_two',array(
		'type' => 'varchar',
		'precision' => '35'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.025';
}


function spiclient_upgrade1_025()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_delai_paiement','delai_days',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.026';
}


function spiclient_upgrade1_026()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('spiclient_address_type',array(
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
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.027';
}


function spiclient_upgrade1_027()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('spiclient_address',array(
		'fd' => array(
			'address_id' => array('type' => 'auto','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '4'),
			'address_street_one' => array('type' => 'varchar','precision' => '255'),
			'address_stree_two' => array('type' => 'varchar','precision' => '255'),
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
			'modifier' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('address_id'),
		'fk' => array('client_id' => 'spiclient'),
		'ix' => array(),
		'uc' => array()
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.028';
}


function spiclient_upgrade1_028()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_address','address_type_id',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.029';
}


function spiclient_upgrade1_029()
{
	$GLOBALS['egw_setup']->oProc->RenameColumn('spiclient_address','address_stree_two','address_street_two');

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.030';
}


function spiclient_upgrade1_030()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_address','address_label',array(
		'type' => 'varchar',
		'precision' => '255'
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.031';
}


function spiclient_upgrade1_031()
{
	/* done by RefreshTable() anyway
	$GLOBALS['egw_setup']->oProc->AddColumn('spiclient_contrats','contract_cosupplier',array(
		'type' => 'int',
		'precision' => '4'
	));*/
	$GLOBALS['egw_setup']->oProc->RefreshTable('spiclient_contrats',array(
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
	));

	return $GLOBALS['setup_info']['spiclient']['currentver'] = '1.032';
}

