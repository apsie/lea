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
	'spid_clients' => array(
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
			'creator_id' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'client_footer_one' => array('type' => 'text','default' => 'NULL'),
			'client_footer_two' => array('type' => 'text','default' => 'NULL'),
			'client_manager_email' => array('type' => 'varchar','precision' => '150','default' => 'NULL'),
			'maj_id' => array('type' => 'int','precision' => '4','default' => '0'),
			'client_sleep' => array('type' => 'int','precision' => '1','nullable' => False,'default' => '0'),
			'client_sector' => array('type' => 'int','precision' => '4','default' => 'NULL'),
			'client_code_tiers' => array('type' => 'varchar','precision' => '255')
		),
		'pk' => array('client_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_etats' => array(
		'fd' => array(
			'state_id' => array('type' => 'auto','nullable' => False),
			'state_name' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'state_description' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'state_initial' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'state_close' => array('type' => 'int','precision' => '4','default' => '0'),
			'state_billable' => array('type' => 'int','precision' => '4','default' => '0'),
			'facturation_label' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'creation_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'change_date' => array('type' => 'varchar','precision' => '20','default' => '0'),
			'label_traduction' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'state_price' => array('type' => 'decimal','precision' => '10','scale' => '2','default' => 'NULL'),
			'state_auto_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('state_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_factures' => array(
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
			'payment_model' => array('type' => 'int','precision' => '4'),
			'invoice_export' => array('type' => 'bool'),
			'invoice_export_date' => array('type' => 'int','precision' => '20'),
			'invoice_export_user' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('facture_id'),
		'fk' => array('facture_tva_id' => 'spireapi_vat'),
		'ix' => array(),
		'uc' => array('facture_number')
	),
	'spid_factures_details' => array(
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
			'vat_rate' => array('type' => 'decimal','precision' => '10','scale' => '2')
		),
		'pk' => array('detail_id'),
		'fk' => array('vat_id' => 'spireapi_vat'),
		'ix' => array(),
		'uc' => array()
	),
	'spid_prix_parametres' => array(
		'fd' => array(
			'client_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'state_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'price_ht' => array('type' => 'decimal','precision' => '8','scale' => '2','default' => '0.00'),
			'ticket_spend_time' => array('type' => 'int','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'account_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'price_id' => array('type' => 'auto','nullable' => False),
			'contract_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('price_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_reponses' => array(
		'fd' => array(
			'reply_id' => array('type' => 'auto','nullable' => False),
			'ticket_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'reply_content' => array('type' => 'text','default' => 'NULL'),
			'actions' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'old_value' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'new_value' => array('type' => 'varchar','precision' => '100','default' => 'NULL'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0')
		),
		'pk' => array('reply_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_reponses_standard' => array(
		'fd' => array(
			'standard_reply_id' => array('type' => 'auto','nullable' => False),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'canned_name' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'canned_content' => array('type' => 'text','precision' => '50','default' => 'NULL'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'close_ticket' => array('type' => 'int','precision' => '5','default' => '0'),
			'state_id' => array('type' => 'int','precision' => '11','default' => '0')
		),
		'pk' => array('standard_reply_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_tickets' => array(
		'fd' => array(
			'ticket_id' => array('type' => 'auto','nullable' => False),
			'ticket_num_group' => array('type' => 'int','precision' => '11','nullable' => False),
			'cat_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'account_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'state_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'facture_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'ticket_title' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'ticket_priority' => array('type' => 'int','precision' => '2','default' => '0'),
			'ticket_assigned_to' => array('type' => 'int','precision' => '11','nullable' => False),
			'ticket_assigned_by' => array('type' => 'int','precision' => '11','nullable' => False),
			'ticket_spend_time' => array('type' => 'float','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False,'default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'closed_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'due_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'ticket_closed' => array('type' => 'int','precision' => '2','default' => '0'),
			'ticket_invoice' => array('type' => 'int','precision' => '2','default' => '0'),
			'location_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'location_precision' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'ticket_private' => array('type' => 'int','precision' => '1','nullable' => False,'default' => '0'),
			'ticket_budget' => array('type' => 'float','precision' => '11','default' => '0'),
			'contract_id' => array('type' => 'int','precision' => '4'),
			'ticket_unit_time' => array('type' => 'int','precision' => '4'),
			'ticket_nb_student' => array('type' => 'int','precision' => '11','default' => 'NULL'),
			'ticket_price_student' => array('type' => 'float','precision' => '11','default' => 'NULL'),
			'client_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'ticket_assigned_by_contact' => array('type' => 'int','precision' => '4','nullable' => False),
			'ticket_client_order' => array('type' => 'varchar','precision' => '50'),
			'ticket_client_order_id' => array('type' => 'varchar','precision' => '50'),
			'ticket_prov_order_id' => array('type' => 'varchar','precision' => '50'),
			'ticket_prov_pro_id' => array('type' => 'varchar','precision' => '50')
		),
		'pk' => array('ticket_id'),
		'fk' => array('client_id' => 'spiclient','ticket_assigned_by_contact' => 'egw_addressbook'),
		'ix' => array(),
		'uc' => array()
	),
	'spid_transitions' => array(
		'fd' => array(
			'transition_id' => array('type' => 'auto','nullable' => False),
			'name' => array('type' => 'varchar','precision' => '50','default' => 'NULL'),
			'description' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'source_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'target_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0')
		),
		'pk' => array('transition_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_locations' => array(
		'fd' => array(
			'location_id' => array('type' => 'auto','nullable' => False),
			'location_parent' => array('type' => 'int','precision' => '4','nullable' => False,'default' => '0'),
			'location_name' => array('type' => 'varchar','precision' => '150','default' => 'NULL'),
			'location_description' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'location_data' => array('type' => 'text','default' => 'NULL'),
			'creator_id' => array('type' => 'int','precision' => '11','default' => '0'),
			'creation_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'change_date' => array('type' => 'int','precision' => '20','default' => '0'),
			'location_level' => array('type' => 'int','precision' => '4','default' => '0')
		),
		'pk' => array('location_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_url' => array(
		'fd' => array(
			'url_id' => array('type' => 'auto','nullable' => False),
			'ticket_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'url_links' => array('type' => 'varchar','precision' => '500','nullable' => False),
			'url_commentaires' => array('type' => 'varchar','precision' => '255','default' => 'NULL'),
			'creator_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'creation_date' => array('type' => 'int','precision' => '20','nullable' => False)
		),
		'pk' => array('url_id'),
		'fk' => array('ticket_id' => 'spid_tickets.ticket_id'),
		'ix' => array(),
		'uc' => array()
	),
	'spid_clients_relations' => array(
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
	'spid_tickets_view' => array(
		'fd' => array(
			'view_id' => array('type' => 'auto','nullable' => False),
			'ticket_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'account_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'time' => array('type' => 'int','precision' => '20','nullable' => False)
		),
		'pk' => array('view_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_rendez_vous' => array(
		'fd' => array(
			'ticket_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'cal_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'creation_date' => array('type' => 'int','precision' => '4'),
			'change_date' => array('type' => 'int','precision' => '4'),
			'createur_id' => array('type' => 'int','precision' => '4'),
			'maj_id' => array('type' => 'int','precision' => '4'),
			'account_id' => array('type' => 'varchar','precision' => '255')
		),
		'pk' => array('ticket_id','cal_id'),
		'fk' => array('ticket_id' => 'spid_tickets','cal_id' => 'egw_cal'),
		'ix' => array(),
		'uc' => array()
	),
	'spid_contrats' => array(
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
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('contract_id'),
		'fk' => array('relation_id' => 'spid_clients_relations','type_id' => 'spid_contrats_type'),
		'ix' => array(),
		'uc' => array()
	),
	'spid_contrats_type' => array(
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
	'spid_intervenants' => array(
		'fd' => array(
			'intervenant_id' => array('type' => 'int','precision' => '4'),
			'intervenant_coef' => array('type' => 'int','precision' => '4'),
			'intervenant_obj_ca' => array('type' => 'int','precision' => '4'),
			'intervenant_obj_ratio' => array('type' => 'int','precision' => '4'),
			'intervenant_TJM' => array('type' => 'int','precision' => '4'),
			'intervenant_PJM' => array('type' => 'int','precision' => '4'),
			'intervenant_note' => array('type' => 'varchar','precision' => '255'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'change_id' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('intervenant_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_sectors' => array(
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
	'spid_facture_categories' => array(
		'fd' => array(
			'cat_id' => array('type' => 'auto','nullable' => False),
			'cat_name' => array('type' => 'varchar','precision' => '255'),
			'cat_label' => array('type' => 'varchar','precision' => '255'),
			'cat_active' => array('type' => 'bool'),
			'cat_default_price' => array('type' => 'decimal','precision' => '9','scale' => '2'),
			'creator_id' => array('type' => 'int','precision' => '4'),
			'creation_date' => array('type' => 'int','precision' => '20'),
			'modifier_id' => array('type' => 'int','precision' => '4'),
			'change_date' => array('type' => 'int','precision' => '20'),
			'cat_account' => array('type' => 'int','precision' => '4')
		),
		'pk' => array('cat_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'spid_checklist' => array(
		'fd' => array(
			'ticket_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'chk_id' => array('type' => 'int','precision' => '4','nullable' => False)
		),
		'pk' => array('ticket_id','chk_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	)
);
