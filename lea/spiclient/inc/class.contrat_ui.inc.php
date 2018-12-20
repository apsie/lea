<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009
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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.contrat_bo.inc.php');	

class contrat_ui extends contrat_bo
{
	var $public_functions = array(
		'index' 		=> true,
		'edit' 		=> true,
		'view' 		=> true,
		'budget'	=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*
	* Spirea - Fichier CSS et JS nécessaire au fonctionnement de spiclient
	*/
		parent::__construct();
		$this->prefs = $GLOBALS['egw_info']['user']['preferences']['spiclient'];
		// $this->obj_js = CreateObject('phpgwapi.javascript');
	}
	
	function contrat_ui(){
	/**
	 * Constructeur
	 */
		self::__construct();
	}
	
	function index($content=null){
		/**
		* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
		*
		* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
		*/
		// Si le user n'a pas le droit d'acceder aux contrats on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);
			
			if($this->delete($id)){
				$msg='Contracts deleted';
			}

			$this->so_member->delete(array('contract_id' => $id));
			$this->so_budget->delete(array('contract_id' => $id));
			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols = 'contract_id,contract_supplier,contract_client,type_id,contract_title';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=> 'spiclient.contrat_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> true,
				'options-cat_id' 	=> false,
				'start'          	=> 0,			// IO position in list
				'cat_id'         	=> '',			// IO category, if not 'no_cat' => True
				'search'         	=> '',// IO search pattern
				'order'          	=> 'contract_title',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=> 'DESC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=> array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     	=> false,
				'no_filter2'     	=> true,
				'filter_label'   	=> lang('Status'),	// I  label for filter    (optional)
				'filter'         	=> '',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export(),
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}
		if(isset($_GET['filter'])){
			$filter=$_GET['filter'];
			$content['nm']['filter2'] = $filter;
		}
		
		/* Si le user a seulement accès à ses propres contrats on mets le filtre2 en place */
		if($this->obj_acl->ownAccessContrat){
			$content['nm']['filter2'] = 'myccontracts';
		}
		
		$content['msg']=$msg;
		
		$sel_options = array(
			'contract_supplier'	=> $this->get_suppliers(),
			'contract_client'	=> $this->get_suppliers(),
			'status_id' => $this->get_status(),
			'type_id' => $this->get_type_contrat(),
			'filter' => array('' => 'All') + $this->get_status(),
		);
		$content['nm']['template']='spiclient.contrat.index.rows';
		
		/* Bouton ajouter uniquement si le user a le droit d'ajouter des clients */
		if($this->obj_acl->allowAddContrat){
			$content['nm']['header_right'] = 'spiclient.contrat.index.right';
		}
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Contract Management');		
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.client.index');
		$tpl->exec('spiclient.contrat_ui.index', $content,$sel_options,$no_button, $content);
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les contrats. Retourne le nombre de lignes
	 * 
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		// YLF - traitement pour les pages Contrats actifs, Contrats à renouveler, contrats terminés
		$join = '';
		if(!empty($query['filter2'])){
			switch($query['filter2']){
				case 'mycontracts':
					$query['col_filter']['contract_seller_id'] = $GLOBALS['egw_info']['user']['account_id'];
					$join = 'WHERE (date_end >= '.time().' OR date_end = 0)';
					break;
				case 'active':
					$join = 'WHERE date_end >= '.time().' OR date_end = 0 OR date_end = \'\'';
					break;
				case 'renew':
					$join = 'WHERE date_renewal > '.time();
					break;
				case 'end':
					$join = 'WHERE date_end < '.time().' AND date_end != 0';
					break;
			}
		}
		
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		if ((int)$query['filter'] && (int)$query['filter']!=0){
			$query['col_filter']['status_id'] = (string) (int) $query['filter'];
		}else{
			unset($query['col_filter']['contract_id']);
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
		
		$rows = parent::search($search,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		if(!$rows){
			$rows = array();
		}
		$order = $query['order'];
		// $GLOBALS['egw_info']['flags']['app_header'] = lang('Contract Management');
		// if($query['search']){
		// 	$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		// }
		// if($query['filter']){
		// 	$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search contract");
		// }
		// _debug_array($rows);exit;
		foreach((array)$rows as $id=>$value){	
			$rows[$id]['contract_supplier_export'] = $this->get_company_name($rows[$id]['contract_supplier']);
			$rows[$id]['contract_client_export'] = $this->get_company_name($rows[$id]['contract_client']);
			$rows[$id]['type_id_export'] = empty($rows[$id]['type_id']) ? '' : $this->get_type_contrat($rows[$id]['type_id']);
			$rows[$id]['status_id_export'] = empty($rows[$id]['status_id']) ? '' : $this->get_statut_contrat($rows[$id]['status_id']);
			$rows[$id]['date_signature_export'] = empty($rows[$id]['date_signature']) ? '' : date('d/m/Y',$rows[$id]['date_signature']);
			$rows[$id]['date_renewal_export'] = empty($rows[$id]['date_renewal']) ? '' : date('d/m/Y',$rows[$id]['date_renewal']);
			$rows[$id]['date_end_export'] = empty($rows[$id]['date_end']) ? '' : date('d/m/Y',$rows[$id]['date_end']);
			$rows[$id]['date_last_invoice_export'] = empty($rows[$id]['date_last_invoice']) ? '' : date('d/m/Y',$rows[$id]['date_last_invoice']);
			$rows[$id]['contract_seller_id_export'] = $this->get_seller_name($rows[$id]['contract_seller_id']);
			// _debug_array($rows[$id]);

			if($this->obj_acl->lecteurContrat){
				$readonlys['edit['.$value['contract_id'].']'] = true;
			}
		}
		
		/* On désactive la suppression si elle n'est pas autorisé dans la config */
		if(!$this->obj_acl->contratRemoval){
			foreach((array)$rows as $id=>$value){
				$readonlys['delete['.$value['contract_id'].']'] = true;
			}
		}
		
		return $this->total;	
    }
	
	function edit($content=null){
		/**
		* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
		*
		* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['contract_id'] (dans le second cas, des vérifications seront faites)
		*
		* @param array $content=NULL
		*/
		$current_tab = $_GET['tab'] ? $_GET['tab'] : $content[$this->tabs];

		// Si le user n'a pas le droit d'acceder aux contrats on le bloque
		if (!$this->obj_acl->allowContrat){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);

			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_contrat($content);
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
			$id=$content['contract_id'];

			// Ajout de contact
			if(isset($content['contact']['button']['add_contact'])){
				if(!empty($content['contact']['account']) && !empty($content['contact']['role'])){
					$member = array(
						'contract_id' => $content['contract_id'],
						'account_id' => $content['contact']['account'],
						'role_id' => $content['contact']['role'],
						'creator' => $GLOBALS['egw_info']['user']['account_id'],
						'creation_date' => time(),
					);
					$this->so_member->data = $member;
					$this->so_member->save();

					$msg_contact = lang('Contact added successfully');
				}else{
					$msg_contact = lang('Please select a user and a role !');
				}
			}

			// Suppression contact
			if(isset($content['contact']['delete'])){
				foreach((array)$content['contact']['delete'] as $account_id => $value){
					$member = array(
						'contract_id' => $content['contract_id'],
						'account_id' => $account_id,
					);
					$this->so_member->delete($member);
				}
				$msg_contact = lang('Contact removed');
				unset($content['contact']['delete']);
			}

			// Ajout budget
			if(isset($content['budget']['button']['add_budget'])){
				if(!empty($content['budget']['budget_phase']) && !empty($content['budget']['cat_id']) && !empty($content['budget']['budget_unit']) /*&& !empty($content['budget']['budget_quantity'])*/ && !empty($content['budget']['budget_date'])){
					$budget = array(
						'contract_id' => $content['contract_id'],
						'budget_phase' => $content['budget']['budget_phase'],
						'cat_id' => $content['budget']['cat_id'],
						'budget_unit' => $content['budget']['budget_unit'],
						'budget_quantity' => $content['budget']['budget_quantity'],
						'budget_cost' => $content['budget']['budget_cost'],
						'budget_sell' => $content['budget']['budget_sell'],
						'budget_date' => $content['budget']['budget_date'],
						'creator' => $GLOBALS['egw_info']['user']['account_id'],
						'creation_date' => time(),
					);

					$this->so_budget->data = $budget;
					// _debug_array($this->so_budget->data);exit;
					$this->so_budget->save();

					$msg_budget = lang('Budget added successfully');
				}else{
					$msg_budget = lang('Please entre a phase, category, unit, quantity and date to add budget !');
				}
			}

			// Suppression budget
			if(isset($content['budget']['delete'])){
				foreach((array)$content['budget']['delete'] as $budget_id => $value){
					$budget = array(
						'budget_id' => $budget_id,
					);
					$this->so_budget->delete($budget);
				}
				$msg_budget = lang('Budget removed');
				unset($content['budget']['delete']);
			}

			$content['msg']=$msg;
			$content['contact']['msg'] = $msg_contact;
			$content['spiclient']=$spiclient;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}
		
		if(isset($_REQUEST['exec']['link_to']['app']) && isset($content['link_to']['to_id']) && isset($content['contract_id'])){
		
			$link_ids = is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']);
			
			foreach(is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']) as $n => $link_app){
				$link_id = $link_ids[$n]['id'];
				$link_app = $link_ids[$n]['app'];
				if (preg_match('/^[a-z_0-9-]+:[:a-z_0-9-]+$/i',$link_app.':'.$link_id)){
					if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
						$so_link = CreateObject('phpgwapi.solink');
						$so_link->link('spicontrat',$content['contract_id'],$link_app,$link_id);
					}else{
						egw_link::link('spicontrat',$content['contract_id'],$link_app,$link_id);
					}
				}
			}
		}
		
		if(isset($id)){
			$content=array(
				'msg'         		=> $msg,
				'spiclient'        	=> $spiclient,
				$this->tabs         => $content[$this->tabs],
				'link_to' => array(
					'to_id' => $id,
					'to_app' => 'spicontrat',
				),
				'contact' => array('msg' => $msg_contact),
				'budget' => array('msg' => $msg_budget),
			);
			$sel_options = array(
				'relation_id' => $this->get_all_relations(),
				'type_id' => $this->get_type_contrat(),
				'status_id' => $this->get_statut_contrat(),
				'contract_period' => $this->get_period(),
				'contract_supplier' => $this->get_suppliers(),
				'contract_client' => $this->get_suppliers(),

				'contract_payer' => $this->get_suppliers(),
				'contract_attorney' => $this->get_suppliers(),

				'role' => $this->get_role_active(),
				'cat_id' => $this->get_facture_cat(),
				'budget_unit' => $this->get_units(),
			);
			$readonlys=array(
				//'client_tva'	=> true,
			);
			if(empty($id)){
				// Si le user n'a pas le droit d'ajouter des contrats on le bloque
				if (!$this->obj_acl->allowAddContrat){
					$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
					return;
				}
				
				$content['hideupdate']=true;
				$content['hidecreate']=true;
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add contract');
				$readonlys[$this->tabs]['link']= true;
				$readonlys[$this->tabs]['history']= true;
				$readonlys[$this->tabs]['reference']= true;
				$readonlys['button[apply]'] = true;
				$readonlys['button[client]'] = true;
				
			}else{
				$content+=$this->get_info($id);
				$content['contact'] = $this->get_contact($id);
				$content['budget'] = $this->get_budget($id);

				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit contract');
				$nom=$this->obj_accounts->read($content['account_id']);
				$sel_options['account_id']=array($content['account_id']=>$nom['account_lid']);
				$readonlys['account_id']=true;
				$content['hideupdate'] = empty($content['change_date']) ? true : false;
				$content['hidecreate'] = empty($content['creation_date']) ? true : false;
				$content['history'] = array(
					'id'  => $id,
					'app' => 'spicontrat',
				);

				// Onglet reférence seulement si spiref est installé
				if($GLOBALS['egw_info']['user']['apps']['spiref']){
					$content['reference'] = $this->get_reference($id);
				}else{
					$readonlys[$this->tabs]['reference'] = true;
				}

				// Onglet facture seulement si spifina est installé
				if($GLOBALS['egw_info']['user']['apps']['spifina']){
					$content['invoice'] = $this->get_invoice($id);
				}else{
					$readonlys[$this->tabs]['invoice'] = true;
				}


				$content['contact']['role'] = $this->obj_config['default_role_contract'];
				$content['contact']['msg'] = $msg_contact;
				$content['budget']['msg'] = $msg_budget;
			}
		}

		// Onglet reférence seulement si spiref est installé
		if($GLOBALS['egw_info']['user']['apps']['spiref']){
			$spiref_ui = CreateObject('spiref.spiref_ui');
			$sel_options['ref_statut'] = $spiref_ui->get_statut();
			$sel_options['ref_client'] = $spiref_ui->get_client($spiref_ui->obj_config['ClientType']);
			$sel_options['ref_fournisseur'] = $spiref_ui->get_client($spiref_ui->obj_config['ProviderType']);
			$sel_options['ref_responsable'] = $spiref_ui->get_users($spiref_ui->obj_config['Gestionnaire']);
			$sel_options['ref_annee'] = $spiref_ui->get_annee(true);
		}
		
		$content['contact']['help_member'] = $this->obj_config['help_member'];
		$content['help_budget'] = $this->obj_config['help_budget'];

		$content['config'] = $this->obj_config;

		// Copy vers reference si l'appli spiref est dispo et que l'option est coché
		$readonlys['button[reference]'] = $GLOBALS['egw_info']['user']['apps']['spiref'] ? !$this->obj_config['spiref_copy'] : true;
		
		// on cache la ligne permettant l'ajout de fichier
		$readonlys['link_to']['file'] = true;
		$readonlys['link_to']['file_path'] = true;
		$readonlys['link_to']['attach'] = true;
		$readonlys['link_to']['comment'] = true;

		$content[$this->tabs] = $current_tab;
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.contrat.edit');
		$tpl->exec('spiclient.contrat_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function view(){
		/**
		* Affiche un contrat (en lecture seule)
		*
		* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
		*/
		// Si le user n'a pas le droit d'acceder aux contrats on le bloque
		if (!$this->obj_acl->allowContrat){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$content=$this->get_info($id);
			$sel_options = array(
				'relation_id' => $this->get_all_relations(),
				'type_id' => $this->get_type_contrat(),
				'status_id' => $this->get_statut_contrat(),
			);
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spiclient.contrat_ui.index');
		}
		$sel_options = array(
			'relation_id' => $this->get_all_relations(),
			'type_id' => $this->get_type_contrat(),
			'status_id' => $this->get_statut_contrat(),
			'contract_period' => $this->get_period(),
			'contract_supplier' => $this->get_suppliers(),
			'contract_client' => $this->get_suppliers(),
		);
		$content['hidebuttons']=true;
		$content['contact']['no_add']=true;
		$content['budget']['no_add']=true;
		$readonlys=array();
		foreach((array)$content as $id=>$value)
		{
			$readonlys[$id]=true;
		}
		
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View contract');		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.contrat.edit');
		$tpl->exec('spiclient.contrat_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
	function budget($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 idex : 'button' et, au choix save,apply,cancel
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ($_GET['location_parent'] permets d'appliquer un filtre)
	*
	* @param array $content=null
	*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$budget = $content;
					$budget['date_modified'] = time();
					$budget['modifier'] = $GLOBALS['egw_info']['user']['account_id'];

					$this->so_budget->data = $budget;
					$this->so_budget->save();

					$msg = lang('Budget updated successfully');

					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'tab=budget'; window.close();</script></body></html>\n";
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
			$id = $this->data['budget_id'];
			
			$content['msg'] = $msg;
		}else{
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			}else{
				$id = "";
				
			}
		}
		if(isset($id)){
			$content=array(
				'msg'         => $msg,
			);

			$content += $this->so_budget->read($id);
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit invoice categorie');
		}

		$sel_options = array(
			'cat_id' => $this->get_facture_cat(),
			'budget_unit' => $this->get_units(),
		);
		
		$content['hidebuttons']=false;
		$content['hideline']=true;
		$tpl = new etemplate('spiclient.budget.edit');
		$tpl->exec('spiclient.contrat_ui.budget', $content,$sel_options,$readonlys,$content,2);
	}	
}

?>
