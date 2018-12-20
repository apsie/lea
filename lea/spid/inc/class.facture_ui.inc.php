<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009 -> 07/2012
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.facture_bo.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.vat_bo.inc.php');


class facture_ui extends facture_bo
{
	var $public_functions = array(
		'index' 	=> true,
		'edit' 		=> true,
		'view' 		=> true,
		'pdf'		=> true,
		'pdfsimul'	=> true,
		'tprint'	=> true,
		'mail'		=> true,
		'editline' 	=> true,
		'pay'		=> true,
		
		
		'zip'		=> true,
		'pdf_liste'	=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*
	* \version BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spid
	*
	* \version BBO - 02/08/2010 - Variable pour connaitre le niveau de l'utilisateur connecté dans l'application SPID
	*/
		parent::__construct();
		if (!$this->grants[EGW_ACL_CUSTOM_2] && !$this->grants[EGW_ACL_CUSTOM_3]){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  __construct - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
			return;
		}
		$this->prefs =& $GLOBALS['egw_info']['user']['preferences']['spid'];
		$this->obj_js =& CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
		
		$FileNameAJAX=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/ajax_request.js';
		$FileNameCSS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/alert.css';
		$FileNameCSS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/default.css';
		$FileNameCSS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/css/alphacube.css';
		$FileNameJS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/prototype.js';
		$FileNameJS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/effects.js';
		$FileNameJS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/window.js';
		$FileNameJS4=$GLOBALS['egw_info']['server']['webserver_url'].'/spid/js/functions.js';
		$javascript="";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS1.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS2.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS3.'" />'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameAJAX.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS1.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS2.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS3.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS4.'"></script>'."\n";
		$javascript.='<script type="text/javascript">var ajax_request = new ajax_request("'.$GLOBALS['egw_info']['server']['webserver_url'].'/spid");</script>'."\n";
		
		//Spirea YLF - 28/02/2011 - Modification pour n'avoir le javascript qu'une seule fois
		if(strpos($GLOBALS['egw_info']['flags']['java_script'],$FileNameAJAX) === false){
			$GLOBALS['egw_info']['flags']['java_script'].=$javascript."\n";
		}
		
		if(!isset($GLOBALS['egw_info']['user']['SpidLevel']))
		{
			$spid =& CreateObject('spid.spid_ui');
			$GLOBALS['egw_info']['user']['SpidLevel']=$spid->isTechnicianOrManagerOrCustomer();
		}
	}
	
	function facture_ui(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function write_js(){
	/**
	* NOTE : Fonction js pour la page edit de facture en mode création
	* Aide à la saisie
	*/

		$lastmonth_start = date('d-m-Y',mktime(1,1,1,$m,0,date('Y')));
		$last_month_start = date("1-m-Y", strtotime("last month"));
		$last_month_end = date("t-m-Y", strtotime("last month"));	
	
			return '
			<script type="text/javascript">
				function set_invoice(facture_number,societe_id) {
					document.getElementById("exec[facture_number]").value=facture_number;
					document.getElementById("exec[societe_id]").value=societe_id;
					document.getElementById("exec[start_period_date][str]").value="'.$last_month_start.'";
					document.getElementById("exec[end_period_date][str]").value="'.$last_month_end.'";
					
				}
			</script>
		';
	}
	
	function index($content=null){	
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		$msg='';
		if(isset($content['action'])){
			if (!count($content['nm']['rows']['checked']) && !$content['use_all']){
				$msg = lang('You need to select some invoices first');
			}else{
				// Si 'requête entière' est sélectionner on récupère la liste des timelog concerné
				if($content['use_all']){
					// $query = egw_session::appsession($session_name,'spitime');
					$query = $content['nm'];
					@set_time_limit(0);
					$query['num_rows'] = -1;
					$this->get_rows($query,$temp,$readonlys);
					foreach($temp as $line){
						$content['nm']['rows']['checked'][] = $line['facture_id'];
					}
				}
				
				// Appel de fonction suivant l'action sélectionnée
				switch($content['action']){
					case 'pdf':
						if(is_array($content['nm']['rows']['checked'])){
							$factures = implode(',',$content['nm']['rows']['checked']);
							echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spid.facture_ui.pdf_liste&id='.utf8_decode($factures))."','_blank','dependent=yes,width=750,height=600,scrollbars=yes,status=yes');</script></body></html>\n";
						}
						break;
					case 'zip':
						if(is_array($content['nm']['rows']['checked'])){
							$factures = implode(',',$content['nm']['rows']['checked']);
							echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spid.facture_ui.zip&id='.utf8_decode($factures))."','_blank','dependent=yes,width=10,height=10,scrollbars=yes,status=yes');</script></body></html>\n";
						}
						break;
				}
			}
			
			unset($content['action']);
		}
			
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);

			if(count($content['ticket'])>0 && !empty($content['ticket'])){
				foreach($content['ticket'] as $cle=>$value){
					if($value['facture_id']==$id){
						$ticket_to_maj=$content['ticket'][$cle];
						$ticket_to_maj['facture_id']=0;
						$ticket_to_maj['ticket_invoice']=0;
						$this->so_ticket->update($ticket_to_maj,true);
					}
				}
			}
			if($this->delete($id)){
				$msg=lang('Invoice deleted');
			}
			unset($content['nm']['rows']['delete']);
		}

		if(empty($content['nm']))
			$content['nm'] = $GLOBALS['egw']->session->appsession('facture_index','spid');

		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols='facture_id,facture_number,operation_code,creation_date,client_id,tickets_number';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.facture_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> true,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> true,
				'options-cat_id' 	=> false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'facture_number',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'DESC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     	=> false,
				'no_filter2'     	=> false,
				'filter_label'   	=>	'Client',	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'filter2_label'  	=>	'Select',			// IO filter2, if not 'no_filter2' => True
				'filter2'       	=>	'',			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export(),
			);
		}		
		//Spirea YLF - 14/01/2011 - Si l'utilisateur est un client alors on met un filter pour qu'il n'accède qu'à ces propres factures
		if($GLOBALS['egw_info']['user']['SpidLevel'] == 0){
			$client_id=$this->facture_client_groups();
			foreach($client_id as $id => $value){
				$content['nm']['col_filter'] = array('client_id'=> $id);
			}
 		}
		if(isset($_GET['msg'])){
			$msg=$_GET['msg'];
		}
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
		}
		
		// _debug_array($filter);
		
		if($filter=='viewall'){
			$content['nm']['filter2']= '6';
		}
		if($filter=='viewnonvalidated'){
			$content['nm']['filter2']= '1';
		}
	
		
		$content['msg']=$msg;
		
		$client_id=$this->facture_client_groups($content['nm']['year']);
		//$client_id=$this->get_customer_billable();
			
		$sel_options = array(
			'filter'	=> $client_id,
			'filter2' 	=> array(
				//'0'	=>	'All invoices',
				'1'	=>	'Unvalidated invoices',
				'2'	=>	'Validated invoices',
				'3'	=>	'Payed & validated invoices',
				'4'	=>	'Not payed validated invoices',
				'5'	=>	'Not sent invoices',
				'6'	=>	'All invoices',
			),
			'payment_model'	=>	$this->get_delai_paiement(),
			'action' => $this->actions,
			
			'provider' => $this->get_providers(),
		);
		

		if($this->grants[EGW_ACL_CUSTOM_2]==0){
			$sel_options['filter2']= array(
				'2'	=>	'Validated invoices'
			);
		}
	
		$content['nm']['template']='spid.facture.index.rows';

		if($this->grants[EGW_ACL_CUSTOM_2]){
			$content['nm']['header_right'] = 'spid.facture.index.right';
			// $content['nm']['header_left'] = 'spid.facture.index.year';
			$content['nm']['header_left'] = 'spid.facture.index.left';
			$content['nm']['year'] = isset($content['nm']['year']) ? $content['nm']['year'] : date("Y")+1;
		}
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Invoice Management');	
		// tch -30/07 - retrait du & pour éviter les erreurs php
		//$tpl =& new etemplate('spid.facture.index');
		$tpl = new etemplate('spid.facture.index');
		$tpl->exec('spid.facture_ui.index', $content,$sel_options,$no_button, $content);
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les tickets. Retourne le nombre de lignes
	 *
	 * \version BBO - 06/08/2010 - Uniquement si l'utilisateur est un simple client
	 * 
	 * \version BBO - 03/08/2010 - Permet de récupérer les clients qui sont déclaré comme prestataire par rapport aux groupes de l'utilisateur connecté, et uniquement dans le cas ou le niveau de l'utilsateur connecté à Spid est à 1, c'est à dire qu'il est prestataire au minimum
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		$GLOBALS['egw']->session->appsession('facture_index','spid',$query);

		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		$recherche=array();
		
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		if ((int)$query['filter'] && (int)$query['filter']!=0){
			$query['col_filter']['client_id'] = (string) (int) $query['filter'];
		}else{
			// $client_id=$this->client_id();
			$client_id=$this->facture_client_groups($query['year']);
			
			$clients=$this->so_client->search(array());
			unset($client_id[key($client_id)]);
			if(count($client_id)==1){
				$recherche['client_id']=key($client_id);
			}elseif(count($clients)==count($client_id)){
				
			}elseif(count($client_id)==0){
				
			}else{
				$recherche[]='spid_factures.client_id IN ('.implode(',',array_keys($client_id)).')';
			}
		}
		
		// Recherche sur une lettre
		$join = '';
		if(isset($query['searchletter'])){
			$join = ' INNER JOIN (select spiclient.client_id as cli_id,spiclient.client_company from spiclient) SC ON SC.cli_id = spid_factures.client_id AND SC.client_company LIKE \''.$query['searchletter'].'%\' ';
		}
		
		 // _debug_array($query['filter2']);

		if ((int)$query['filter2'] && !empty($query['filter2']) && (int)$query['filter2']>0){
			if((int)$query['filter2']==1){
				$query['col_filter']['invoice_validate'] = 0;
			}
			if((int)$query['filter2']==2){
				$query['col_filter']['invoice_validate'] = 1;
			}
			if((int)$query['filter2']==3){
				$query['col_filter']['invoice_validate'] = 1;
				$query['col_filter']['invoice_payed'] = 1;
			}
			if((int)$query['filter2']==4){
				$query['col_filter']['invoice_validate'] = 1;
				$query['col_filter']['invoice_payed'] = 0;
			}
			if((int)$query['filter2']==5){
				$query['col_filter']['invoice_validate'] = 1;
				$query['col_filter']['invoice_send'] = 0;
			}
			if((int)$query['filter2']==6){
				unset($query['col_filter']['invoice_validate']);
				unset($query['col_filter']['invoice_send']);
			}
		}else{
			$query['col_filter']['invoice_validate'] = 1;
		}

		
		if($GLOBALS['egw_info']['user']['SpidLevel']==0){
			$query['col_filter']['generated_pdf'] = 1;
		}
		
		
		if(!empty($query['search'])){
			$recherche['facture_number']=$query['search'];
		}
		
		// Filtre fournisseur
		if(!empty($query['provider'])){
			$query['col_filter']['societe_id'] = $query['provider'];
		}
		
		// YLF - Ajout d'un filtre sur l'année
		if(!empty($query['year'])){
			$start_date = mktime(0,0,0,1,1,$query['year']-1);
			$end_date = mktime(0,0,0,1,1,$query['year']);
			
			// $join .= 'WHERE spid_factures.creation_date BETWEEN '.$start_date.' AND '.$end_date;  
			$join .= 'WHERE ((spid_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spid_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.'))';
		}
		
		if($GLOBALS['egw_info']['user']['SpidLevel']==1)
		{
			$SocieteDuUserConnecte=array();
			$accounts=$this->obj_accounts->memberships($this->account_id,true);
			$ClientsDuUser=$this->so_client->search(array('account_id'=>$accounts),true);
			foreach($ClientsDuUser as $id=>$value)
			{
				$ClientsRelations=$this->so_clients_relations->search(array('societe_id'=>$value['client_id']),false);
				if(is_array($ClientsRelations))
				{
					$SocieteDuUserConnecte[]=$value['client_id'];
				}
			}
			if(!empty($SocieteDuUserConnecte))
			{
				$recherche[]='societe_id IN ('.implode(',',$SocieteDuUserConnecte).')';
			}
		}

		// recupère les factures		
		// _debug_array($query['col_filter']);
		// _debug_array($recherche);
		// _debug_array($join);

		$rows = parent::search($recherche,$id_only,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);

		if(!$rows){
			$rows = array();
		}

		foreach($rows as $id=>$value){
			//Peut-on générer la facture
			$readonlys['pdf['.$value['facture_id'].']']= $this->grants[EGW_ACL_CUSTOM_2] ? false : true;
			$readonlys['pdfsimul['.$value['facture_id'].']']= $this->grants[EGW_ACL_CUSTOM_2] ? false : true;
			//Tant que la facture n'est pas générée, impossible de l'ouvrir et de l'imprimer
			$readonlys['checked['.$value['facture_id'].']']=true;
			$readonlys['tprint['.$value['facture_id'].']']=true;
			$readonlys['mail['.$value['facture_id'].']']=true;
			$readonlys['pay['.$value['facture_id'].']']=true;
			$readonlys['paid['.$value['facture_id'].']']=true;
			//Si la facture est générée alors on peut la visualiser
			if($value['validation_date']!=0 && $this->grants[EGW_ACL_CUSTOM_3]){
				$readonlys['view['.$value['facture_id'].']']=false;
			}else{
				$readonlys['view['.$value['facture_id'].']']=true;
			}
			//Si la facture est générée on ne peut plus ni la supprimer ni l'éditer ni la générer de nouveau par contre on peut l'ouvrir et l'imprimer
			if($value['generated_pdf']!=0){
				$readonlys['edit['.$value['facture_id'].']']=true;
				$readonlys['delete['.$value['facture_id'].']']=true;
				$readonlys['pdf['.$value['facture_id'].']']=true;
				$readonlys['pdfsimul['.$value['facture_id'].']']=true;
				$readonlys['view['.$value['facture_id'].']']=false;
				$readonlys['tprint['.$value['facture_id'].']']=false;
				$readonlys['checked['.$value['facture_id'].']']=false;
				// mail et pay uniquement pour les admin
				$readonlys['mail['.$value['facture_id'].']']= !$this->grants['admin'];
				$readonlys['pay['.$value['facture_id'].']'] = !$this->grants['admin'];
			}
			//Si la facture est validée, on ne peut plus la supprimer ni l'éditer
			if($value['validation_date']!=0){
				$readonlys['edit['.$value['facture_id'].']']=true;
				$readonlys['delete['.$value['facture_id'].']']=true;
			}
			//Tant que la facture n'est pas validée, on ne peut pas la générer au format PDF
			if(empty($value['validation_date']) || $value['validation_date']==0){
				$readonlys['pdf['.$value['facture_id'].']']=true;
			}
			
			//Si la facture est payée, on affiche le logo payé (vert)...
			if($value['payment_date']!=0){			
				$readonlys['pay['.$value['facture_id'].']'] = true;
				$readonlys['paid['.$value['facture_id'].']'] = !$this->grants['admin'];
			}

			
			$client=$this->so_client->search(array('client_id'=>$value['client_id']),'client_company,client_payment_model,client_code_tiers');
			$ticket_assigned_to_invoice=$this->so_ticket->search(array('facture_id'=>$value['facture_id']),false);
			if(!empty($ticket_assigned_to_invoice)){
				$rows[$id]['ticket_number']=count($ticket_assigned_to_invoice);
			}else{
				$rows[$id]['ticket_number']= '-';
			}
			if(!empty($client)){
				$rows[$id] += $client[0];
			}

			//Spirea YLF - 30/03/2011 - On récupère le code opération depuis la table client_relation
			$clientRelation = $this->so_clients_relations->search(array('societe_id'=>$value['societe_id'],'client_id'=>$value['client_id']),false);
			if(!empty($clientRelation)){
				$rows[$id]['client_operation_code'] = $clientRelation[0]['operation_code'];
			}
			//on récupère le fournisseur
			$fournisseur=$this->so_client->search(array('client_id'=>$value['societe_id']),false);
			if(!empty($fournisseur)){
				$rows[$id]['provider'] = $fournisseur[0]['client_company'];
			}

			// Champs  pour les exports

			$rows[$id]['invoice_send'] = ($rows[$id]['invoice_send'] == 1 ? 1 : "");
			$rows[$id]['creation_date_export'] = date('d/m/Y',$rows[$id]['creation_date']);
			$rows[$id]['payment_date_export'] = ($rows[$id]['payment_date'] > 0 ? date('d/m/Y',$rows[$id]['payment_date']) : "");
			$rows[$id]['send_date_export'] = ($rows[$id]['send_date'] > 0 ? date('d/m/Y',$rows[$id]['send_date']) : "");
			
		}
		$order = $query['order'];
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Invoice Management');
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}
		// _debug_array($rows);
		return $this->total;	
    }
	
	function edit($content=null){
	/**
	* Charge l'etemplate d'édition d'une facture, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['facture_id']
	*
	* @param array $content=NULL
	*/
		$msg='';
		if(isset($content['ticket']['delete'])){
			list($id) = @each($content['ticket']['delete']);
			foreach($content['ticket'] as $cle=>$value){
				if($value['ticket_id']==$id){
					$ticket_to_del=$content['ticket'][$cle];
					$ticket_num=$cle;
					break;
				}
			}
			$ticket_to_del['facture_id']=0;
			$ticket_to_del['ticket_invoice']=0;
			if($this->so_ticket->update($ticket_to_del,true)){
				$msg='Ticket deleted from invoice';
			}
			unset($content['ticket']['delete']);
			unset($content['ticket'][$ticket_num]);
			$content['button']['apply']=lang('Apply');
		}

		// update line
		if(isset($content['custom_line']['update'])){
			unset($content['custom_line']['update']);
			$content['button']['apply'] = lang('Apply');
		}
		// delete line
		if(isset($content['custom_line']['delete'])){
			list($id) = @each($content['custom_line']['delete']);
			$this->delete_line($id);
			unset($content['custom_line']['delete']);
			$content['button']['apply']=lang('Apply');
		}
		//move up/down
		if(isset($content['custom_line']['up'])){
			list($index) = @each($content['custom_line']['up']);
			$this->move_line($index,$content['facture_id'],'up');
			$content['button']['refresh']=lang('Apply');
		}
		if(isset($content['custom_line']['down'])){
			list($index) = @each($content['custom_line']['down']);
			$this->move_line($index,$content['facture_id'],'down');
			$content['button']['refresh']=lang('Apply');
		}
		// update line - ligne vide - on la suppime
		unset($content['custom_line']['up']);
		unset($content['custom_line']['down']);
		
		// _debug_array($content);
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'delete':
					$facture_to_maj=$content['facture_id'];
					if($this->so_factures->delete($facture_to_maj)){
						$msg='Invoice deleted';
					}else{
						$msg='Error while deleting invoice';
					}
					echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
					break;
				case 'pdf':
					$this->pdf($content['facture_id']);
					break;
				case 'validate':
					// Récupération du taux de tva
					$tva_bo = new vat_bo();
					$tva = $tva_bo->get_info($content['facture_taux_id']);
					$content['facture_taux_tva'] = $tva['vat_rate'];

					$content['validation_date']=time();
					$content['invoice_validate']=1;
				case 'save':
				case 'apply':
					$msg=$this->add_update_facture($content);
					if($button=='save' || $button=='validate'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';
						</script>";
					break;
				case 'refresh':

					break;
				case 'new_line':
					$msg = $this->add_line($content);
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id=$this->data['facture_id'];
			if(empty($id)){
				$id=$content['facture_id'];
				}
			
			unset($content['button']);
			$content['msg']=$msg;
			$content['spid']=$spid;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}
		$sel_options=array();
		$readonlys=array();

		if(isset($id)){
			$content=array(
				'msg'	=> $_GET['msg'] ? $_GET['msg'] : $msg,
				'spid'	=> $spid,
			);
			$readonlys=array();
			if(empty($id)){
				$content['hideupdate']=true;
				// fonction get_last_invoice : récupère un tableau avec le dernier numéro de facture
				// la valeur affiche contient un appel sur la fonction javascript set_invoice pour remplir les champs automatiquement
				$content['last_invoice'] = $this->get_last_invoice();
				
				$GLOBALS['egw_info']['flags']['app_header'] = lang('New Invoice');
				$readonlys['button[delete]']=true;

				// Défaut - Taux TVA
				$content['facture_tva_id'] = $this->obj_config['default_vat'];

				// Défaut - Facture isolée 
				$content['alone_invoice'] = $this->obj_config['default_alone_invoice'] ? true : false;
			}else{
				// get_info : remplissage du tableau avec les infos de la facture (entêtes et lignes)
				// $id = numéro de la facture
				$content+=$this->get_info($id);
				
				
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit Invoice');
				$sel_options['payment_model']=$this->get_delai_paiement();
				$readonlys['facture_number']=true;
				$readonlys['societe_id']=true;
				$readonlys['client_id']=true;
				$readonlys['start_period_date']=true;
				$readonlys['end_period_date']=true;
				if($content['invoice_validate']){
					$readonlys=$content;
					$readonlys['add_ticket']=true;
					$readonlys['ticket_forfait']=true;
					$content['ticket']['validate_invoice']=true;
					$readonlys['invoice_message']=true;
					$readonlys['alone_invoice']=true;
					$content['custom_line']['hideaction'] = true;
					$readonlys['custom_line'][1] = true;
					$readonlys['custom_line']['up'] = true;
					$readonlys['custom_line']['down'] = true;
					$content['hideaction'] = true;
					$readonlys['facture_tva'] = true;
					$readonlys['button[validate]'] = true;

					$readonlys['facture_tva_id'] = true;
		
					unset($readonlys['payment_date']);
				}else{
					unset($content['invoice_validate']);
				}

				if(!$this->grants[EGW_ACL_CUSTOM_2]){
					// _debug_array('ici');
					$readonlys['button[delete]'] = true;
				}
			}

			if((count($content['ticket'])<=0 && count($content['custom_line'])<=0)||($content['send_date']==0)){
				$readonlys['button[validate]']=true;	
			}
			
			// Masque les lignes persos s'il y en a pas
			if(count($content['custom_line']) <= 0){
				$content['custom_line']['hidecustom'] = true;
			}
			
			if(count($content['ticket'])==0){
				$readonlys['button[delete]']= $readonlys['button[delete]'] ? true : false;
			}else{
				$readonlys['button[delete]']=true;
			}
			if($content['validation_date']!=0){
				$readonlys['send_date']=true;
				$readonlys['total_ht']=true;
				$readonlys['add_ticket']=true;
				$readonlys['button[validate]']=true;
				$content['ticket']['validate_invoice']=true;
				$readonlys['invoice_message']=true; 
				$readonlys['alone_invoice']=true;
			}
			$tab_checked=array();
			if($_GET['checked']){
				$checked=$_GET['checked'];
				$tab_checked=explode(',',$checked);
				$ticket_number=count($tab_checked);
			}
			$sel_options['client_id']=$this->get_customer_billable();
			$sel_options['societe_id']=$this->get_providers();
		}
		$sel_options['alone_invoice']=array(
			'0'	=> 'No',
			'1'	=> 'Yes',
		);
		$sel_options['extra_cat_id']= $content['invoice_validate'] ? array() : array('0'=>'Select one') + $this->get_cat_facture();

		// Taux de TVA
		$sel_options['facture_tva_id'] = vat_bo::get_vat();
		$sel_options['vat_id'] = vat_bo::get_vat();


		//Vérification que le ticket en cours d'ouverture et appartient bien au groupe du user connecté 
		//quand ce dernier ne fait partie que d'un groupe
		if(!empty($content['facture_id'])){
			if(!$this->verification_facture($content['facture_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.edit - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
				return;
			}
		}
		$content['hide_info'] = true;
		
		if($content['change_date']){
			$content['hidechange']=true;
		}else{
			unset($content['hidechange']);
		}

		if(empty($content['facture_id'])){
			$content['hideaction'] = true;
			$content['facture_tva'] = true;
			$content['facture_taux_tva'] = 19.6;
		}
		// Date en readonly pour les non-admins
		$readonlys['payment_date'] = !$this->grants['admin'];
		$readonlys['send_date'] = !$this->grants['admin'];

		$tpl = new etemplate('spid.facture.edit');
		$tpl->exec('spid.facture_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function view(){
	/**
	* Affiche une facture (en lecture seule)
	*
	* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
	*/
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$content=$this->get_info($id);
			
			// _debug_array($content);
			
			//Si la facture n'existe pas encore
			if(!isset($content['facture_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.view - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
				return;
			}
			$GLOBALS['egw_info']['flags']['app_header'] = lang('View Invoice');
			$sel_options['payment_model']=$this->get_delai_paiement();
			$sel_options['client_id']=$this->get_customer_billable();
			$sel_options['societe_id']=$this->get_providers();
			$sel_options['extra_cat_id']=$this->get_cat_facture();
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spid.facture_ui.index');
		}
		$readonlys=$content;
		$readonlys['add_ticket']=true;
		$readonlys['ticket_forfait']=true;
		$content['ticket']['validate_invoice']=true;
		$readonlys['invoice_message']=true;
		$readonlys['alone_invoice']=true;
		$readonlys['button[validate]'] = true;
		$readonlys['facture_tva_id'] = true;
		
		unset($readonlys['payment_date']);
		
		if($content['generated_pdf']==1){
			$client_id="";
			$client_id=empty($client_id) ? $_GET['client'] : $client_id;
			$facture_number=$content['facture_number'];
			$content['lien_pdf']=$this->lien_pdf($client_id,$facture_number);
		}
		$sel_options['alone_invoice']=array(
			'0'	=> 'No',
			'1'	=> 'Yes',
		);
		//Vérification que le ticket en cours d'ouverture et appartient bien au groupe du user connecté 
		//quand ce dernier ne fait partie que d'un groupe
		if(!empty($content['facture_id'])){
			if(!$this->verification_facture($content['facture_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.view - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
				return;
			}
		}

		unset($content['hidebuttons']);

		if(!$this->grants[EGW_ACL_CUSTOM_2]){
			$readonlys['button[delete]'] = true;
			$content['hidebuttons'] = true;
		}

		$content['custom_line']['hideaction'] = true;
		$readonlys['custom_line'][1] = true;
		$readonlys['custom_line']['up'] = true;
		$readonlys['custom_line']['down'] = true;
		$content['hideaction'] = true;

		// Taux de TVA
		$sel_options['facture_tva_id'] = array(''=>'') + vat_bo::get_vat();
		$sel_options['vat_id'] = array(''=>'') + vat_bo::get_vat();

		
		// Date en readonly pour les non-admins
		$readonlys['payment_date'] = !$this->grants['admin'];
		$readonlys['send_date'] = !$this->grants['admin'];
		
		// _debug_array($content);
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View Invoice');		
		$tpl = new etemplate('spid.facture.edit');
		$tpl->exec('spid.facture_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
	
	function pdf($id=null){
	/**
	* Crée le fichier PDF de la facture $id. Si cette valeur n'est pas renseignée, on prendra $_GET['id']. Si $_GET['id'] est aussi nulle, la méthode échouera.
	*
	* NOTE: la méthode peut ne rien retourner ...
	*
	* \version BBO - 03/08/2010 - MAJ pour sauvegarder la facture généré dans le bon répertoire
	*
	* @param int id=null
	* @return boolean
	*/
		if(!$this->grants[EGW_ACL_CUSTOM_2]){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.pdf - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
			return;
		}

		$id = empty($id) ? $_GET['id'] : $id;
		if (empty($id)){ return false; }
		
		$facture=$this->search(array('facture_id'=>$id),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
		$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$pdf = CreateObject($this->obj_config['invoice_model'],$facture_emeteur[0],$facture_client[0],$id);
		$pdf->generate($id,$this);

		//Test du répertoire Racine des factures
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid';
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}

		//Test du répertoire des factures du prestataire qui édite la facture
		$repertoire=$repertoire.'/presta_'.$societe[0]['client_company'];
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}
		
		//Test du répertoire des factures du clients en fonction du prestataire
		$repertoire=$repertoire.'/'.$relationClientSociete[0]['operation_code'];
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}

		$nomFichierPDF=$repertoire.'/'.$facture[0]['facture_number'].".pdf";
		$pdf->Output($nomFichierPDF,'F');
		// Debug - Permet d'afficher la facture sans la générer physiquement
		// $pdf->Output();

		if(file_exists($nomFichierPDF)){
			$msg='The bill been successfully generated';
		}else{
			$msg='A problem happens during the generation of the bill in PDF format';
		}
		
		// $facture=$this->search(array('facture_id'=>$id),false);
		$maj_facture[0]['facture_id'] = $id;
		$maj_facture[0]['generated_pdf'] = 1;
		// spirea - tch - _debug
		// $maj_facture[0]['generated_pdf'] = 0;
		
		$this->update($maj_facture[0],true);
		echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
				addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
	}
	
	
	function pdfsimul($id=null){
	/**
	* Crée un fichier de simulation en PDF de la facture $id. Si cette valeur n'est pas renseignée, on prendra $_GET['id']. Si $_GET['id'] est aussi nulle, la méthode échouera.
	*
	* \version BBO - 03/08/2010 - MAJ pour sauvegarder la facture généré dans le bon répertoire
	*
	* @param int id=null
	* @return boolean
	*/
		if(!$this->grants[EGW_ACL_CUSTOM_2]){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.pdf - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
			return;
		}

		$id = empty($id) ? $_GET['id'] : $id;
		if (empty($id)){ return false; }
		
		$facture=$this->search(array('facture_id'=>$id),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
		$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$pdf = CreateObject($this->obj_config['invoice_model'],$facture_emeteur[0],$facture_client[0],$id);
		$pdf->generate($id,$this,true);

		//Test du répertoire Racine des factures
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid';
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}

		//Test du répertoire des factures du prestataire qui édite la facture
		$repertoire=$repertoire.'/presta_'.$societe[0]['client_company'];
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}
		
		//Test du répertoire des factures du clients en fonction du prestataire
		$repertoire=$repertoire.'/'.$relationClientSociete[0]['operation_code'];
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}

		$nomFichierPDF=$repertoire.'/'.$facture[0]['facture_number'].".pdf";
		$pdf->Output($nomFichierPDF,'F');
		// Debug - Permet d'afficher la facture sans la générer physiquement
		// $pdf->Output();

		if(file_exists($nomFichierPDF)){
			$msg='The bill been successfully generated';
		}else{
			$msg='A problem happens during the generation of the bill in PDF format';
		}
		
	
		// $this->update($maj_facture[0],true);
		echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
				addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
	}
	
	function lien_pdf($client_id=null,$facture_number=null){
	/**
	* Retourne le chemin du fichier PDF de la facture $facture_number pour le client $client_id passés en argument
	*
	* NOTE : Pourquoi initilaliser les arguments à NULL ? La valeur de retour rest elle bool ou string ?
	*
	* \version BBO - 03/08/2010 - MAJ pour indiquer le nouveau répertoire
	*
	* @param int $client_id=NULL
	* @param int $facture_number=NULL
	* @return bool
	*/

		if (empty($client_id)){
			return false;
		}
		if (empty($facture_number)){
			return false;
		}
		
		$client=$this->so_client->search(array('client_id'=>$client_id),false);
		$facture=$this->search(array('facture_number'=>$facture_number),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$client_id),false);
		
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
					
		if(!file_exists($repertoire)){
			return false;
		}
		
		$nomFichierPDF=$repertoire.'/'.$facture_number.".pdf";
		if(file_exists($nomFichierPDF)){
			$repertoireOuvertureFichier=$GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'].'/'.$facture_number.'.pdf';
		}else{
			return false;
		}

		//YLF
		$repertoireOuvertureFichier="/index.php?menuaction=spid.facture_ui.tprint&id=".$client_id."&facture=".$facture_number."&download=1";
		
		return $repertoireOuvertureFichier;
	}
	
	function tprint($id=null){
	/**
	* Imprime la facture $id ($_GET['id'] si $id non défini) pour le client courant
	*
	* NOTE : Pourquoi initilaliser les arguments à NULL ? Ne retourne pas toujours une valeur ...
	*
	* \version BBO - 03/08/2010 - MAJ pour imprimer la facture depuis le bon répertoire
	*
	* @param int $id=NULL
	* @return bool
	*/
		$download = isset($_GET['download']) ? true : false;
		
	
		$id=empty($id) ? $_GET['id'] : $id;
		if (empty($id)){
			return false;
		}
		
		// $client_id=$this->client_id();
		$client_id=$this->facture_client_groups();
		$client=$this->so_client->search(array('client_id'=>$id),false);
		
		if ($GLOBALS['egw_info']['user']['SpidLevel'] < 50 ){
		if(!$this->grants[EGW_ACL_CUSTOM_2] || count($client_id)==1 ){
			if(key($client_id)!=$client[0]['client_id']){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  facture_ui.tprint - votre niveau : ".$GLOBALS['egw_info']['user']['SpidLevel']."</h1>\n",null,true);
				return;
			}
		}
		}
		
		$numFacture=$_GET['facture'];
		
		$facture=$this->search(array('facture_number'=>$numFacture),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$id),false);
		
		$repertoire=$GLOBALS['egw_info']['server']['files_dir']."/spid/presta_".$societe[0]['client_company']."/".$relationClientSociete[0]['operation_code'];
		if(!file_exists($repertoire)){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('An error has occured').' !<br />'.lang('Please contact support').'</h1><br />',null,true);
			return false;
		}
		
		$nomFichierPDF=$repertoire.'/'.$numFacture.".pdf";
		if(file_exists($nomFichierPDF)){
			$repertoireOuvertureFichier=$GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'].'/'.$numFacture.'.pdf';
			if($download){
				$taille=filesize("$repertoireOuvertureFichier"); 
				header("Content-Type: application/force-download; name=\"$numFacture.pdf\"");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: $taille");
				header("Content-Disposition: attachment; filename=\"$numFacture.pdf\"");
				header("Expires: 0");
				header("Cache-Control: no-cache, must-revalidate");
				header("Pragma: no-cache"); 
				readfile($repertoireOuvertureFichier);
			}else{
				header("Content-type: application/pdf;\n"); //or yours?
				readfile($repertoireOuvertureFichier);
			}
			$GLOBALS['egw']->common->egw_exit();
		}else{
			return false;
		}
		
	}
	
	function mail($content=null){
	/**
	* Charge l'e-template de mail, l'exécute avec les paramètres donnés.
	*
	* \version YLF - 03/02/2011 - envoi le mail avec en pièce jointe la facture du client
	*
	* @param array $content = NULL
	*/
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch ($button){
				case 'cancel' :
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
				case 'send' :
					$content['attachment'] = str_replace(' ','\ ',$content['attachment']);
					exec('cp '.$content['attachment'].' '.$GLOBALS['egw_info']['server']['temp_dir']);
					$content['message'] = htmlentities($content['message'], ENT_NOQUOTES, "UTF-8");
					$content['message'] = htmlspecialchars_decode($content['message']);

					$to = $content['sendto'];
					$subject = 	$content['subject'];
 
					$bound_text = 	"spirea";
					 
					$bound = 	"--".$bound_text."\n";
					 
					$bound_last = 	"--".$bound_text."--\n";
					 
					$headers = 	"From: ".$content['sendby']."\n";
					$headers .= "Cc: ".$content['sendby'].",".$content['sendcc']."\n";
					$headers .= "MIME-Version: 1.0\n"
						."Content-Type: multipart/mixed; boundary=\"$bound_text\"\n";
					 
					$message .= 	"If you can see this MIME than your client doesn't accept MIME types!\n"
						.$bound;
					 
					$message .= 	"Content-Type: text/html; charset=\"ISO-8859-1\"\n"
						."Content-Transfer-Encoding: 8bit\n\n"
						.$content['message']."\n"
						.$value
						.$bound;
					
					$fileName = substr($content['attachment'],1+strrpos($content['attachment'],"/"));
					$fileLocation = $GLOBALS['egw_info']['server']['temp_dir'].'/'.$fileName;
					$file = 	file_get_contents($fileLocation);
					$message .= 	"Content-Type: application/pdf; name=\"$fileName\"\n"
						."Content-Transfer-Encoding: base64\n"
						."Content-disposition: attachment; file=\"$fileName\"\n"
						."\n"
						.chunk_split(base64_encode($file))
						.$bound_last;

					if(mail($to, $subject, $message, $headers))
					{
						$facture=$this->search(array('facture_number'=>$content['facture_id']),false);
						$facture[0]['invoice_send'] = 1;
						$msg = $this->add_update_facture($facture[0]);
						$msg .= ' '.lang('MAIL SENT SUCCESSFULLY');
					} else {
						 $msg = lang('MAIL SENDING FAILED');
					}
					unset($content['button']);
					exec('cd '.$GLOBALS['egw_info']['server']['temp_dir']);
					exec('rm -fR '.$fileName);
					break;
				default :
			}
		}
		if(($_GET['id'])){
			//recupération des infos concernant la facture
			$facture=$this->search(array('facture_id'=>$_GET['id']),false);
			$content['facture_id'] = $facture[0]['facture_number'];
			
			//sujet du mail
			$content['subject']= 'Facture du '.date('j-m-Y',$facture[0]['start_period_date']).' au '.date('j-m-Y',$facture[0]['end_period_date']);
			
			//infos concernant le client et l'émetteur de la facture
			$content['sendby'] = $GLOBALS['egw_info']['user']['email'];
			
			$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
			$content['sendto'] = $facture_client[0]['client_manager_email'];
			
			//sujet du mail
			$facture_emetteur=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$content['subject']= $facture_emetteur[0]['client_company'].' - '.$facture_client[0]['client_company'].': Facture n°'.$facture[0]['facture_number'].' du '.date('j-m-Y',$facture[0]['start_period_date']).' au '.date('j-m-Y',$facture[0]['end_period_date']);
						
			// infos concernant le fichier a mettre en pièce jointe
			$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
			
			// $repertoire='spid/FACTURES/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
			$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
			
			if(!file_exists($repertoire)){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('An error has occured').' !<br />'.lang('Please contact support').'</h1><br />',null,true);
			}
			$nomFichierPDF=$repertoire.'/'.$facture[0]['facture_number'].".pdf";
			if(file_exists($nomFichierPDF)){
				$content['attachment'] = $nomFichierPDF;
			}else{
				$msg = lang('Error : file not found !');
			}
			// Contenu du message à envoyé
			$general=$this->obj_config;
			$content['message'] = $general['mail_content'];
		}
		$content['msg'] = $msg;
		$tpl = new etemplate('spid.facture.mail');
		$tpl->exec('spid.facture_ui.mail', $content,$sel_options,$readonlys,$content,2);
	}
	
	function pay($content=null){
		
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch ($button){
				case 'save':
				case 'apply':
					$content['invoice_payed'] = true;
					$msg=$this->add_update_facture($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';
						</script>";
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
		}
		
		if(isset($_GET['id'])){
			$content = $this->get_info($_GET['id']);

			$ligne_facture = $this->so_factures_details->search(array('facture_id'=>$content['facture_id']),false);
			$tab_tva = array();
			foreach($ligne_facture as $ligne){
				if($ligne['total_ht'] != 0){
					$tab_tva[$ligne['vat_rate']] += $ligne['total_ht'];
				}elseif($ligne['extra_ht'] != 0){
					$tab_tva[$ligne['vat_rate']] += $ligne['extra_ht'];
				}
			}
			
			foreach($tab_tva as $taux => $montant_ht){
				$montant_tva += $taux==0 ? 0 : $montant_ht * $taux / 100;
			}

			if(!isset($content['payment_amount'])){
				$content['payment_amount'] = number_format($content['total_ht'] + $montant_tva,2,',',' ');
				$content['payment_date'] = time();
			}
		}
		
		//on récupère le fournisseur
			$fournisseur=$this->so_client->search(array('client_id'=>$content['provider']),false);
			if(!empty($fournisseur)){
				$content['provider_name'] = $fournisseur[0]['client_company'];
			}
		// _debug_array($content);
		
		$tpl = new etemplate('spid.facture.pay');
		$tpl->exec('spid.facture_ui.pay', $content,$sel_options,$readonlys,$content,2);
	}
	
	function pdf_liste(){
	/**
	 * Fonction de génération de plusieurs facture
	 */
		$factures = explode(',',$_GET['id']);
		$pdf = CreateObject($this->obj_config['invoice_model']);
		foreach($factures as $facture_id){
			// facture
			$facture = $this->search(array('facture_id' => $facture_id),false);
			
			// Informations concernant la facture
			$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
			$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
			$facture_emeteur = $this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			
			// Mise de certaines valeurs dans l'objet PDF
			$pdf->societeEmetteur = $facture_emeteur[0];
			$pdf->societeClient = $facture_client[0];
			
			// Génération du PDF de la facture
			$pdf->generate($facture[0]['facture_id'], $this);
		}
		// Affichage du PDF
		$pdf->Output(lang('Invoices').'.pdf','D');
	}
	
	function zip(){
	/**
	 * Fonction de zip d'une ou plusieurs factures
	 */
		$factures = explode(',',$_GET['id']);

		// Dossier temporaire dans lequel on va copier les fichiers
		$name = tempnam($GLOBALS['egw_info']['server']['temp_dir'],"Spid_factures.zip");
		exec('rm -f "'.$name.'"');
		exec('mkdir "'.$name.'"');

		// Parcours des factures sélectionnés
		foreach($factures as $facture_id){
			// Informations sur la facture
			$facture = $this->search(array('facture_id' => $facture_id),false);
			
			$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
			
			// Récupération du dossier dans lequel se trouve la facture
			$repertoire = $GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
			$nomFichierPDF = $repertoire.'/'.$facture[0]['facture_number'].".pdf";
			
			// Copie de la facture dans le dossier temporaire (à zipper)
			exec('cp '.$nomFichierPDF.' '.$name);
		}
		
		// Zippage du dossier
		$exec = 'cd "'.$name.'";zip -r "'.lang('Invoices').'.zip" .';
		exec($exec);
		
		// header permettant de lancer le téléchargement
		header('Content-disposition: attachment; filename="'.lang('Invoices').'.zip"');
		header("Content-type: application/zip");
		readfile ($name.'/'.lang('Invoices').'.zip');
	}
}

?>
