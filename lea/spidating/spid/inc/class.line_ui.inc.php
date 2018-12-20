<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009->Juillet 2012
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.line_bo.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.vat_bo.inc.php');

class line_ui extends line_bo{
	
	var $public_functions = array(
		'index'	=> true,
	);
	
	/**
	 * Constructor
	 *
	 */
	function line_ui(){
		parent::line_bo();
	}
	
	function index($content = null){
	/**
	 * Charge le template index
	 */
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
		}

		if (!is_array($content['nm']))
		{
			$default_cols='detail_id,facture_id,extra_cat_id,extra_label,extra_ht,extra_rank,extra_ref,extra_ns,extra_ht_unit,vat_id,vat_rate,quantity';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.line_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'options-cat_id' 	=> false,
				'start'          	=> 0,			// IO position in list
				'cat_id'         	=> '',			// IO category, if not 'no_cat' => True
				'search'         	=> '',// IO search pattern
				'order'          	=> 'detail_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=> 'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=> array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=> lang('Category'),	// I  label for filter    (optional)
				'filter2_label'		=> lang('Client'),
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=> false,
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}
		
		$content['msg'] = $msg;

		$client_id=$this->facture_client_groups();
		$sel_options = array(
			'extra_cat_id' => $this->get_cat_facture(),
			'vat_id' => array(''=>'') + vat_bo::get_vat(),

			'filter' => array('' => lang('All')) + $this->get_cat_facture(),
			'filter2' => $client_id,
			'client' => $client_id,

			'invoice_status' => array('all' => 'All invoices','validated' => lang('Validated invoices'), 'non_validated' => 'Non validated invoices'),
			'provider' => $this->get_providers(),
			'year' => $this->get_year(),
		);

		$content['nm']['header_left'] = 'spid.line.index.left';
		
		$tpl = new etemplate('spid.line.index');
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Custom lines view');
		$tpl->read('spid.line.index');
		$tpl->exec('spid.line_ui.index', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
	}
}
?>