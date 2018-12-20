<?php
/**
 * eGroupware - Spireapi - 
 * SpireAPI : Module and functions set to manage referentials in eGroupware 
 *
 * @link http://www.spirea.fr
 * @package spireapi
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-10 by Spirea
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
  */
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.book_bo.inc.php');

class book_ui extends book_bo{
	
	var $public_functions = array(
		'index'	=> true,
		'edit' 	=> true,
	);
	
	/**
	 * Constructeur
	 *
	 */
	function book_ui(){
		parent::book_bo();
		
		/* Spirea YLF - Gestion des droits */
		$config = CreateObject('phpgwapi.config');
		$obj_config = $config->read('spireapi');
	}
	
	function index($content = null){
	/**
	 * Charge le template index
	 *
	 */
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
		}
		
		// Suppression
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			
			if($this->so_book->delete($id)){
				$msg = lang('book deleted');
			}
			unset($content['nm']['rows']['delete']);
		}
		
		if (!is_array($content['nm']))
		{
			$default_cols='book_id,book_code,book_label,book_active,creation_date';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spireapi.book_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'no_filter2'		=> true,
				'no_filter'			=> true,
				'options-cat_id' 	=> false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'book_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=>	lang('book'),	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=> false,
			);
		}
	
		$tpl = new etemplate('spireapi.book.index');
		$content['nm']['header_right'] = 'spireapi.book.index.right';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('books management');
		$content['msg'] = $msg;
		
		$tpl->read('spireapi.book.index');
		$tpl->exec('spireapi.book_ui.index', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
	}
	
	function edit($content = null){
	/**
	 * Charge le template edit
	 */
		$msg='';
		// Appuie sur un bouton (apply/save/cancel)
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg = $this->add_update_book($content);
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
			$id = $this->so_book->data['book_id'];
			
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
				// Nouveau
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add book');
				$content['book_active'] = true;

			}else{
				// Existant
				$content += $this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit book');
			}
		}

		$sel_options = array(
			'book_default_account' => $this->get_account(),
		);

		$tpl = new etemplate('spireapi.book.edit');
		// $tpl->read('spireapi.book.edit');
		$tpl->exec('spireapi.book_ui.edit', $content, $sel_options, $readonlys, $content,2);
	}
}
?>