<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009->juillet 2012
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaClient - Ce logiciel est un programme informatique servant à la gestion de clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.zone_bo.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	

class zone_ui extends zone_bo
{
	var $public_functions = array(
		'index' 	=> true,
		'edit' 		=> true,
		'view' 		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		// il faut être gestionnaire pour avoir accès au menu configuration
		$acl = new acl_spiclient();
		if (!$acl->admin){
			if(!isset($_GET['view'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
				return;
			}
		}
		parent::__construct();

		$this->prefs =& $GLOBALS['egw_info']['user']['preferences']['spiclient'];
		// $this->obj_js =& CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
	}
	
	function zone_ui(){
	/**
	*Constructeur
	*/
		// il faut être gestionnaire pour avoir accès au menu configuration
		if (!$acl->admin){
			if(!isset($_GET['view'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
				return;
			}
		}
		self::__construct();
	}
	
	function write_js(){
	/**
	* NOTE : Fonction... inutile
	*/
		return "";
	}
	
	function index($content=null){
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter'), la vue du tableau de bord via $_GET['view']
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de zone à supprimer à $content['nm']['rows']['delete']
	*
	* @param array $content=null correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			if($this->delete($id)){
				$msg= lang('Geographic area deleted');
			}
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols='zone_id,zone_parent,zone_pays,zone_label,creator_id';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spiclient.zone_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
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
				'order'          	=>	'zone_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=>	lang('Geographic area'),	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> true,
				'csv_fields'		=>false,
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}
		if(isset($_GET['filter'])){
			$filter=$_GET['filter'];
		}
		
		if(isset($_GET['view'])){
			$content['nm']['view']=$_GET['view'];
		}
		
		if(empty($content['nm']['filter']) || $content['nm']['filter']==0){
			
		}else{
			unset($content['nm']['col_filter']);
		}
		$content['msg']=$msg;
		
		$sel_options = array(
			'filter'	=> array(
				''	=> 'All',
			)+$this->get_zone_parent(),
			'zone_parent' => array('0' => '-') + $this->get_zone(),
		);
		
		$content['nm']['template']='spiclient.zone.index.rows';
		if(!isset($_GET['view'])){
			$content['nm']['header_right'] = 'spiclient.zone.index.right';
		}
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Geographic area management');
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.zone.index');
		$tpl->exec('spiclient.zone_ui.index', $content,$sel_options,$no_button, $content);
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les zones
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		if ((int)$query['filter'] && (int)$query['filter']!=0){
			$query['col_filter']['zone_parent'] = (string) (int) $query['filter'];
		}else{
			unset($query['col_filter']['zone_parent']);
		}
		
		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		if(!is_array($query['search'])){
			$search=$this->construct_search($query['search']);
		}else{
			$search=$query['search'];
		}
		$rows =parent::search($search,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter']);
		if(!$rows){
			$rows = array();
		}
		foreach((array)$rows as $id=>$value){
			if(isset($query['view'])){
				$readonlys['edit['.$value['zone_id'].']']=true;
				$readonlys['delete['.$value['zone_id'].']']=true;
				$readonlys['add['.$value['zone_id'].']']=true;
			}
			$rows[$id]['zone_parent_name']=$this->id2name($value['zone_parent']);
		}

		$order = $query['order'];
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Geographic area management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		if($query['filter']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search area '%1'",$this->id2name($query['filter']));
		}
		return $this->total;	
    }
	
	function edit($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 idex : 'button' et, au choix save,apply,cancel
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ($_GET['zone_parent'] permets d'appliquer un filtre)
	*
	* NOTE : curieux, le case après le default ...
	*
	* @param array $content=null
	*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					//_debug_array($content);
					$msg=$this->add_update_zone($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id=$this->data['zone_id'];
			
			$content['msg']=$msg;
			$content['spiclient']=$spiclient;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}
		if(isset($id)){
			if(isset($_GET['zone_parent'])){
				$zone_parent=$_GET['zone_parent'];
			}else{
				$zone_parent="";
			}
			$content=array(
				'msg'         => $msg,
				'spiclient'        => $spiclient,
			);
			if(empty($id)){
				$content['hideupdate']=true;
				$content['zone_parent']=$zone_parent;
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add Geographic area');	
			}else{
				$content+=$this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit Geographic area');	
			}
			$sel_options = array(
				'zone_parent'	=> $this->get_zone_parent(),
			);
		}
			$content['hidebuttons']=false;
			$content['hideline']=true;
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.zone.edit');
		$tpl->exec('spiclient.zone_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function view(){
	/**
	* Affiche une zone (en lecture seule)
	*
	* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
	*/
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$content=$this->get_info($id);
			$sel_options = array(
				'zone_parent'	=> $this->get_zone_parent(),
			);
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spiclient.zone_ui.index');
		}
		$content['hidebuttons']=true;
		$readonlys=$content;
		$readonlys['zone_parent']=true;
		$content['hideline']=true;
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View Geographic area');		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.zone.edit');
		$tpl->exec('spiclient.zone_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
}

?>
