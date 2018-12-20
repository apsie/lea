<?php
/* spidating : SpireaTime
SPIREA - Février 2012
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaTime - Gestion avancée des temps dans eGroupware : saisie / contrôle de cohérence / validation / rappels / exports

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.type_bo.inc.php');

class type_ui extends type_bo{
	
	var $public_functions = array(
		'index'	=> true,
		'edit' 	=> true,
	);
	
	/**
	 * Constructor
	 *
	 */
	function type_ui(){
		parent::type_bo();
	}
	
	function index($content = null){
	/**
	 * Charge le template index
	 */
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
		}

		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);

			if($this->so_type->delete($id)){
				$msg = lang('Status deleted');
			}
			unset($content['nm']['rows']['delete']);
		}
		
		if (!is_array($content['nm']))
		{
			$default_cols='type_id,type_label,type_description,type_actif,type_ordre';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spidating.type_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'no_filter2'		=> true,
				'options-cat_id' => false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'type_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=>	lang('Status'),	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=>false,
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}
		
		$content['msg'] = $msg;
		
		$tpl = new etemplate('spidating.type.index');
		$content['nm']['header_right'] = 'spidating.type.index.right';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Status management');
		$tpl->read('spidating.type.index');
		$tpl->exec('spidating.type_ui.index', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
	}
	
	function edit($content = null){
	/**
	 * Charge le template edit
	 */
		$msg='';
	
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg = $this->add_update_type($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
			}
			$id = $this->so_type->data['type_id'];
			
			$content['msg']=$msg;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id='';
				
			}
		}
		if(isset($id)){
			$content = array(
				'msg'         => $msg,
			);
			if(empty($id)){
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add file type');
				$content['statut_actif'] = true;
			}else{
				$content += $this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit file type');	
			}
		}

		$tpl = new etemplate('spidating.type.edit');
		$tpl->read('spidating.type.edit');
		$tpl->exec('spidating.type_ui.edit', $content, $sel_options, $readonlys, $content,2);
	}
}
?>