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
	'spifina_factures' => array(
		'fd' => array(
			'facture_id' => array('type' => 'auto','nullable' => False),
			'client_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'facture_number' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'total_ht' => array('type' => 'decimal','precision' => '9','scale' => '2','default' => '0.00'),
			'nb_open_start' => array('type' => 'int','precision' => '11','default' => '0'),
			'nb_open_during' => array('type' => 'int','precision' => '11','default' => '0'),
			'nb_close_during' => array('type' => 'int','precision' => '11','default' => '0'),
			'nb_open_end' => array('type' => 'int','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False),
			'change_date' => array('type' => 'int','precision' => '20','default' => 'NULL'),
			'send_date' => array('type' => 'int','precision' => '20','default' => 'NULL'),
			'validation_date' => array('type' => 'int','precision' => '20','default' => 'NULL'),
			'start_period_date' => array('type' => 'int','precision' => '20','default' => 'NULL'),
			'end_period_date' => array('type' => 'int','precision' => '20','default' => 'NULL'),
			'account_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'generated_pdf' => array('type' => 'int','precision' => '2','default' => '0'),
			'invoice_validate' => array('type' => 'int','precision' => '2','default' => '0'),
			'invoice_message' => array('type' => 'text','default' => 'NULL'),
			'alone_invoice' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'societe_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'invoice_send' => array('type' => 'int','precision' => '2','default' => '0'),
			'modifier_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'facture_tva' => array('type' => 'bool'),
			'facture_taux_tva' => array('type' => 'decimal','precision' => '9','scale' => '2'),
			'payment_date' => array('type' => 'int','precision' => '20'),
			'payment_bank' => array('type' => 'varchar','precision' => '50'),
			'payment_amount' => array('type' => 'decimal','precision' => '9','scale' => '2'),
			'invoice_payed' => array('type' => 'bool','default' => '0'),
			'facture_tva_id' => array('type' => 'int','precision' => '4'),
			'payment_mode' => array('type' => 'int','precision' => '4'),
			'invoice_export' => array('type' => 'bool'),
			'invoice_export_date' => array('type' => 'int','precision' => '20'),
			'invoice_export_user' => array('type' => 'int','precision' => '4'),
			'contract_id' => array('type' => 'int','precision' => '4'),
			'invoice_bank_account' => array('type' => 'varchar','precision' => '255'),
			'invoice_cat' => array('type' => 'int','precision' => '4'),
			'payment_delay' => array('type' => 'int','precision' => '4'),
			'invoice_due_date' => array('type' => 'int','precision' => '20'),
			'invoice_remind_date' => array('type' => 'int','precision' => '20'),
			'invoice_remind_user' => array('type' => 'int','precision' => '4'),
			'q_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('facture_id'),
		'fk' => array('facture_tva_id' => 'spireapi_vat'),
		'ix' => array(),
		'uc' => array('facture_number')
	),
	'spifina_factures_details' => array(
		'fd' => array(
			'detail_id' => array('type' => 'auto','nullable' => False),
			'facture_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'quantity' => array('type' => 'int','precision' => '11','default' => 'NULL'),
			'spend_time' => array('type' => 'decimal','precision' => '10','scale' => '2','default' => 'NULL'),
			'total_ht' => array('type' => 'decimal','precision' => '9','scale' => '2','default' => '0.00'),
			'state_id' => array('type' => 'int','precision' => '11','default' => 'NULL'),
			'ticket_id' => array('type' => 'int','precision' => '11','default' => 'NULL'),
			'extra_cat_id' => array('type' => 'int','precision' => '11'),
			'extra_label' => array('type' => 'varchar','precision' => '255'),
			'extra_ht' => array('type' => 'decimal','precision' => '9','scale' => '2'),
			'extra_rank' => array('type' => 'int','precision' => '11'),
			'extra_ref' => array('type' => 'varchar','precision' => '255'),
			'extra_ns' => array('type' => 'varchar','precision' => '255'),
			'extra_ht_unit' => array('type' => 'decimal','precision' => '9','scale' => '2'),
			'vat_id' => array('type' => 'int','precision' => '4'),
			'vat_rate' => array('type' => 'decimal','precision' => '10','scale' => '2'),
			'user_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('detail_id'),
		'fk' => array('vat_id' => 'spireapi_vat'),
		'ix' => array(),
		'uc' => array()
	)
);
