<?php
/**	spiclient : SpireaClient
*	SPIREA - 09/06/2011->juillet 2012
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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.role_bo.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	

class role_ui extends role_bo
{
	var $public_functions = array(
		'index' 		=> true,
		'edit' 		=> true,
		'view' 		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*
	* Spirea - Fichier CSS et JS nécessaire au fonctionnement de spiclient
	*/
		// il faut être gestionnaire pour avoir accès au menu configuration
		$acl = new acl_spiclient();
		if (!$acl->admin){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		parent::__construct();
		$this->prefs = $GLOBALS['egw_info']['user']['preferences']['spiclient'];

		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS1.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS2.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS3.'" />'."\n";

		$GLOBALS['egw_info']['flags']['java_script'].=$javascript."\n";
	}
	
	function role_ui(){
	/**
	 * Constructeur
	 */
		// il faut être gestionnaire pour avoir accès au menu configuration
		if (!$acl->admin){
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
				$msg='role deleted';
			}
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols = 'role_id, role_label, creation_date, creator_id';
			//,client_operation_code,client_payment_model,creator_id';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spiclient.role_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
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
				'order'          	=>	'role_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     => true,
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
		
		// $sel_options = array(
			// 'filter'				=> $this->company_billable(),
		// );
		$content['nm']['template']='spiclient.role.index.rows';
		$content['nm']['header_right'] = 'spiclient.role.index.right';
				
		$GLOBALS['egw_info']['flags']['app_header'] = lang('role Management');		
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.role.index');
		$tpl->exec('spiclient.role_ui.index', $content,$sel_options,$no_button, $content);
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
			$query['col_filter']['role_id'] = (string) (int) $query['filter'];
		}else{
			unset($query['col_filter']['role_id']);
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
		
		// _debug_array($rows);
		
		if(!$rows){
			$rows = array();
		}
		$order = $query['order'];
		$GLOBALS['egw_info']['flags']['app_header'] = lang('role Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		if($query['filter']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search role '%1'",$this->id2name($query['filter']));
		}
		// foreach((array)$rows as $id=>$value){
			// if(!$this->obj_accounts->read($value['account_id'])){
				// $rows[$id]['error']='<img title="'.lang('error on this customer').'" width="16" height="16" src="/phpgwapi/templates/default/images/dialog_error.png">';
			// }else{
				// $rows[$id]['error']='';
			// }
			
			// if($this->getNbrClients($value['client_id'])>0)
			// {
				// echo $value['client_company'].'<br>';
				// $readonlys['delete['.$value['client_id'].']']=true;
			// }

			// if($value['client_sleep']==1)
			// {
				// $rows[$id]['client_class']='sommeil';
			// }
			// if(is_array($GLOBALS['egw_info']['user']['ClientError'])){
				// if(in_array($value['client_id'],$GLOBALS['egw_info']['user']['ClientError']))
				// {
					// $rows[$id]['client_class']='probleme';
				// }
			// }
		// }
		
		return $this->total;	
    }
	
	function edit($content=null){
		/**
		* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
		*
		* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['role_id'] (dans le second cas, des vérifications seront faites)
		*
		* @param array $content=NULL
		*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_role($content);
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
			$id=$content['role_id'];
			
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
			$content=array(
				'msg'         		=> $msg,
				'spiclient'        		=> $spiclient,
				$this->tabs         => $content[$this->tabs], 
			);
			$readonlys=array(
				//'client_tva'	=> true,
			);
			if(empty($id)){
				$content['hideupdate']=true;
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add role');
				$readonlys[$this->tabs]['conditions']= true;
				$readonlys[$this->tabs]['details']= true;
			}else{
				$content+=$this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit role');
				$nom=$this->obj_accounts->read($content['account_id']);
				$sel_options['account_id']=array($content['account_id']=>$nom['account_lid']);
				$readonlys['account_id']=true;
			}
		}
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.role.edit');
		$tpl->exec('spiclient.role_ui.edit', $content,$sel_options,$readonlys,$content,2);
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
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spiclient.role_ui.index');
		}
		$content['hidebuttons']=true;
		$readonlys=array();
		foreach((array)$content as $id=>$value)
		{
			$readonlys[$id]=true;
		}
		
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View role');		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.role.edit');
		$tpl->exec('spiclient.role_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
	
}

?>
