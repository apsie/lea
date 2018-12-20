<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 09/06/2011
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.sector_bo.inc.php');	

class sector_ui extends sector_bo
{
	var $public_functions = array(
		'index' 		=> true,
		'edit' 		=> true,
		'view' 		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*
	* Spirea - Fichier CSS et JS nécessaire au fonctionnement de spid
	*/
		if (!$GLOBALS['egw_info']['user']['apps']['admin']){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		parent::__construct();
		$this->prefs =& $GLOBALS['egw_info']['user']['preferences']['spid'];
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS1.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS2.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS3.'" />'."\n";
		$GLOBALS['egw_info']['flags']['java_script_thirst'].=$javascript."\n";
	}
	
	function sector_ui(){
	/**
	 * Constructeur
	 */
		if (!$GLOBALS['egw_info']['user']['apps']['admin']){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		self::__construct();
	}
	
	function index($content=null){
		/**
		* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
		*
		* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
		*/
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			
			if($this->delete($id)){
				$msg='Sector deleted';
			}
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols = 'sector_id, sector_name, creation_date, creator_id';
			//,client_operation_code,client_payment_model,creator_id';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.sector_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'options-cat_id' => false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'sector_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     => false,
				'no_filter2'     => true,
				'filter_label'   	=>	'',	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'filter2_label'  	=>	'',			// IO filter2, if not 'no_filter2' => True
				'filter2'       	=>	'',			// IO filter2, if not 'no_filter2' => True
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
		
		$content['msg']=$msg;
		
		$content['nm']['template']='spid.sector.index.rows';
		$content['nm']['header_right'] = 'spid.sector.index.right';
				
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Sector Management');		
		
		$tpl =& new etemplate('spid.sector.index');
		$tpl->exec('spid.sector_ui.index', $content,$sel_options,$no_button, $content);
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les secteurs. Retourne le nombre de lignes
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
			$query['col_filter']['sector_id'] = (string) (int) $query['filter'];
		}else{
			unset($query['col_filter']['sector_id']);
		}
		
		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int)$query['num_rows']
		);
		if ($query['searchletter']){
			$query['col_filter'][] = $query['order'].' '.$GLOBALS['egw']->db->capabilities['case_insensitive_like'].' '.$GLOBALS['egw']->db->quote($query['searchletter'].'%');
		}
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
		$order = $query['order'];
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Sector Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		if($query['filter']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search sector '%1'",$this->id2name($query['filter']));
		}
			
		return $this->total;	
    }
	
	function edit($content=null){
		/**
		* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
		*
		* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['sector_id'] (dans le second cas, des vérifications seront faites)
		*
		* @param array $content=NULL
		*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_sector($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id=$content['sector_id'];
			
			$content['msg']=$msg;
			$content['spid']=$spid;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}
		if(isset($id)){
			$content=array(
				'msg'         		=> $msg,
				'spid'        		=> $spid,
				$this->tabs         => $content[$this->tabs], 
			);
			$readonlys=array();
			if(empty($id)){
				$content['hideupdate']=true;
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add sector');
				$readonlys[$this->tabs]['conditions']= true;
				$readonlys[$this->tabs]['details']= true;
			}else{
				$content+=$this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit sector');
				$nom=$this->obj_accounts->read($content['account_id']);
				$sel_options['account_id']=array($content['account_id']=>$nom['account_lid']);
				$readonlys['account_id']=true;
			}
		}
		
		$tpl =& new etemplate('spid.sector.edit');
		$tpl->exec('spid.sector_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function view(){
		/**
		* Affiche un secteur (en lecture seule)
		*
		* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
		*/
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$content=$this->get_info($id);
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spid.sector_ui.index');
		}
		$content['hidebuttons']=true;
		$readonlys=array();
		foreach((array)$content as $id=>$value)
		{
			$readonlys[$id]=true;
		}
		
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View sector');		
		$tpl =& new etemplate('spid.sector.edit');
		$tpl->exec('spid.sector_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
	
}

?>
