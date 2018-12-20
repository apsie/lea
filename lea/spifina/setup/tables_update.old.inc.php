<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package spifina
 * @subpackage setup
 * @version $Id$
 */

function spifina_upgrade0_001()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','contract_id',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spifina']['currentver'] = '0.002';
}


function spifina_upgrade0_002()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures_details','user_id',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spifina']['currentver'] = '0.003';
}


function spifina_upgrade0_003()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','invoice_bank_account',array(
		'type' => 'varchar',
		'precision' => '255'
	));

	return $GLOBALS['setup_info']['spifina']['currentver'] = '0.004';
}


function spifina_upgrade0_004()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','invoice_cat',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spifina']['currentver'] = '0.005';
}


function spifina_upgrade0_005()
{
	$GLOBALS['egw_setup']->oProc->RenameColumn('spifina_factures','payment_model','payment_mode');
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','payment_delay',array(
		'type' => 'int',
		'precision' => '4'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','invoice_due_date',array(
		'type' => 'int',
		'precision' => '20'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','invoice_remind_date',array(
		'type' => 'int',
		'precision' => '20'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('spifina_factures','invoice_remind_user',array(
		'type' => 'int',
		'precision' => '4'
	));

	return $GLOBALS['setup_info']['spifina']['currentver'] = '0.006';
}

