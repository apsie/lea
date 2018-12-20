<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009
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

require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.prix_bo.inc.php');	

class prix_ui extends prix_bo
{
	var $public_functions = array(
		'index_price' 		=> true,
		'index_contract'	=> true,
		'edit' 				=> true,
		'view' 				=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*/
	
	/// Récupération du niveau de droit (50 : gestionnaire / 99 : admin)
		$spid_ui = new spid_ui();
		if(!isset($GLOBALS['egw_info']['user']['SpidLevel'])){
			$GLOBALS['egw_info']['user']['SpidLevel'] = $spid_ui->isTechnicianOrManagerOrCustomer();
		}

		if ($GLOBALS['egw_info']['user']['SpidLevel'] < 50 ){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  __construct - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
			return;
		}
		parent::__construct();

		$this->prefs = $GLOBALS['egw_info']['user']['preferences']['spid'];
		$this->obj_js = CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
	}
	
	function prix_ui(){
	/**
	*Constructeur
	*/
		if ($GLOBALS['egw_info']['user']['SpidLevel'] < 50 ){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."  - Réf. : prix_ui</h1>\n",null,true);
			return;
		}
		self::__construct();
	}
	
	function write_js(){
	/**
	* NOTE : Fonction... inutile
	*/
		return "";
	}
	
	function index_price($content=null){	
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de location à supprimer à $content['nm']['rows']['delete']
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			if($this->delete($id)){
				$msg='Price deleted';
			}
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.prix_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'start'          	=>	0,			// IO position in list
				'order'          	=>	'client_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'filter_label'   	=>	lang('Client'),	// I  label for filter    (optional)
				'filter2_label'  	=>	lang('State'),			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $default_cols,
				'no_csv_export'		=> true,
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}

		$content['msg']=$msg;
		
		$sel_options = array(
			'filter'	=> array(
				0	=> 'All',
			)+$this->get_client(),
			'filter2' 	=> array(
				0	=> 'All',
			)+$this->get_etat(),
			'state_id'	=>$this->get_etat(),
		);
		
		$content['nm']['template']='spid.prix.index.rows';
		$content['nm']['header_right'] = 'spid.prix.index.right';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Prices Management');	
		$tpl = new etemplate('spid.prix.index');
		$tpl->exec('spid.prix_ui.index_price', $content,$sel_options,$no_button, $content);
	}

	function index_contract($content=null){	
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de location à supprimer à $content['nm']['rows']['delete']
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			if($this->delete($id)){
				$msg='Price deleted';
			}
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=> 'spid.prix_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'start'          	=> 0,			// IO position in list
				'order'          	=> 'client_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=> 'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'filter_label'   	=> lang('Contract'),	// I  label for filter    (optional)
				'filter2_label'  	=> lang('State'),			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $default_cols,
				'no_csv_export'		=> true,

				'contract' => true,
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}

		$content['msg']=$msg;
		
		$sel_options = array(
			'filter'	=> array(
				0	=> 'All',
			)+$this->get_contract(),

			'filter2' 	=> array(
				0	=> 'All',
			)+$this->get_etat(),
			'state_id'	=>$this->get_etat(),
		);
		
		$content['nm']['template']='spid.prix.index.rows_contract';
		$content['nm']['header_right'] = 'spid.prix.index.right_contract';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Prices Management');	
		$tpl = new etemplate('spid.prix.index');
		$tpl->exec('spid.prix_ui.index_contract', $content,$sel_options,$no_button, $content);
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les prix
	 *
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		if ((int)$query['filter2'] && (int)$query['filter2']!=0){
			$query['col_filter']['state_id'] = (string) (int) $query['filter2'];
		}else{
			unset($query['col_filter']['state_id']);
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
		
		if($query['contract']){
			// Filtre sur les prix contrats
			$join = 'WHERE contract_id <> 0';

			if ((int)$query['filter'] && (int)$query['filter']!=0){
				$query['col_filter']['contract_id'] = (string) (int) $query['filter'];
			}else{
				unset($query['col_filter']['contract_id']);
			}
		}else{
			if ((int)$query['filter'] && (int)$query['filter']!=0){
				$query['col_filter']['client_id'] = (string) (int) $query['filter'];
			}else{
				unset($query['col_filter']['client_id']);
			}

			// Filtre sur les prix client
			$join = 'WHERE client_id <> 0';
			
			// On affiche uniquement les prix pour les clients facturables (si aucun filtre n'est présent)
			if(empty($query['col_filter']['client_id']) ||!isset($query['col_filter']['client_id'])){
				$clients = $this->get_client();
				$query['col_filter']['client_id'] = array();
				foreach($clients as $id_client => $data){
					$query['col_filter']['client_id'][] = $id_client;
				}
			}
		}

		$rows = parent::search($search,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		
		if(!$rows){
			$rows = array();
		}
		$readonlys = array();
		$key_etats=$this->so_etats->db_key_cols;
		foreach($rows as $id=>$value){
			$search_lib_etats=$this->so_etats->read(array($key_etats[key($key_etats)]=>$value['state_id']));
			$nom_groupe=$this->obj_accounts->read($value['account_id']);
			$client=$this->so_client->read(array('client_id'=>$value['client_id']));
			$rows[$id]['state_name']=$search_lib_etats['state_name'];
			$rows[$id]['client_id']=$client['client_company'].' ('.lang('Group').' '.$nom_groupe['account_lid'].')';


			// Contrat
			$contrat = $this->so_contrat->read($value['contract_id']);
			$rows[$id]['contract_id']=$contrat['contract_title'];
		}
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Prices Management');
		// if($query['search']){
		// 	$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		// }
		// if($query['filter']){
		// 	$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search client '%1'",$query['filter']);
		// }
		// if($query['filter2']){
		// 	$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search State '%1'",$this->idetat2name($query['filter2']));
		// }
		return $this->total;	
    }
	
	function edit($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 idex : 'button' et, au choix save,apply,cancel
	*
	* Le contenu à visualiser peut se faire via $_GET['id']
	*
	*
	* @param array $content=NULL
	*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_price($content);
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
			$id = $this->data['price_id'];
			
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
				'msg'         => $msg,
				'spid'        => $spid, 
			);
			if(empty($id)){
				$content['hideupdate']=true;
				$content['hideclient'] = $_GET['contract_id'];

				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add Prices');	
			}else{
				$content+=$this->get_info($id);

				$content['hideclient'] = empty($content['client_id']);

				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit Prices');	
			}			
		}

		
		
		$sel_options = array(
			'client_id'		=> $this->get_client(),
			'contract_id'	=> $this->get_contract(),
			'state_id' 		=> $this->get_etat()
		);
			
		$tpl = new etemplate('spid.prix.edit');
		$tpl->exec('spid.prix_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function view(){
	/**
	* Affiche un prix (en lecture seule) 
	*
	* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
	*/
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$content=$this->get_info($id);
			$sel_options = array(
				'client_id'	=> $this->get_client(),
				'state_id' 	=> $this->get_etat()
			);
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spid.prix_ui.index');
		}
		$sel_options = array(
			'client_id'	=> $this->get_client(),
			'state_id' 	=> $this->get_etat()
		);
		$content['hidebuttons']=true;
		$readonlys=array();
		foreach($content as $id=>$value)
		{
			$readonlys[$id]=true;
		}
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View Prices');		
		$tpl = new etemplate('spid.prix.edit');
		$tpl->exec('spid.prix_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
}

?>
