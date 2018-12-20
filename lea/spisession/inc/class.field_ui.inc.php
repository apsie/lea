<?php
/**
 * spisession - Integrated Sessions Management Modules for eGroupware (trainings, meetings, etc.)
 * See About folder and www.spirea.fr for further information
 *
 * @link http://www.spirea.fr
 * @package spisession
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-december by Spirea +33141192772
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 */
require_once(EGW_INCLUDE_ROOT. '/spisession/inc/class.field_bo.inc.php');

class field_ui extends field_bo{
	
	var $public_functions = array(
		'index'	=> true,
		'edit' 	=> true,
	);
	
	/**
	 * Constructeur 
	 *
	 */
	function field_ui(){
		parent::field_bo();
		
				
		// Construction des droits - une seule fonction - dans class.acl_so.inc.php 
		$GLOBALS['egw_info']['user']['SpiSessionLevel'] = acl_so::get_spisession_level();
		// Gestion ACL - Simple utilisateur = Pas d'acc�s
		if ($GLOBALS['egw_info']['user']['SpiSessionLevel'] <= 10){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied, please contact your administrator!!!')."</h1>\n",null,true);
			exit;
		}
		// Fin blocage au niveau du Constructeur 
		
	}
	
	function index($content = null){
	/**
	 * Charge le template index
	 */
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
		}

		// Suppression
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);

			if($this->so_field->delete($id)){
				$msg = lang('field deleted');
			}
			unset($content['nm']['rows']['delete']);
		}
		
		if (!is_array($content['nm']))
		{
			$default_cols='field_id,field_label,field_desc,field_active,field_ordre';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spisession.field_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'no_filter'			=> false,
				'no_filter2'		=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'options-cat_id' 	=> false,
				'start'          	=> 0,			// IO position in list
				'cat_id'         	=> '',			// IO category, if not 'no_cat' => True
				'search'         	=> '',// IO search pattern
				'order'          	=> 'field_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=> 'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=> array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=> '',	// I  label for filter    (optional)
				'filter2_label'   	=> lang('field'),	// I  label for filter    (optional)
				'filter'         	=> '',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=> true,
				'no_columnselection'=> true,
			);
		}
		
		$content['msg'] = $msg;
		
		// Listes
		$sel_options = array(
			'filter' => array(''=>lang('All status'),'1'=>lang('Active'),'0'=>lang('Inactive')),
		);
		
		$tpl = new etemplate('spisession.field.index');
		$content['nm']['header_right'] = 'spisession.field.index.right';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Subjects');
		$tpl->read('spisession.field.index');
		$tpl->exec('spisession.field_ui.index', $content, $sel_options, $readonlys, array('nm' => $content['nm']));
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
					$msg = $this->add_update_field($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id = $this->so_field->data['field_id'];
			
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
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add a subject');
				$content['statut_actif'] = true;
			}else{
				// Existant
				$content += $this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit subject');	
			}
		}
		$tpl = new etemplate('spisession.field.edit');
		$tpl->read('spisession.field.edit');
		$tpl->exec('spisession.field_ui.edit', $content, $sel_options, $readonlys, $content,2);
	}
}
?>