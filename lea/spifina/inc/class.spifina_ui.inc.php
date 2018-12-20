<?php
/**	spifina : SpireaFinances
*	SPIREA - 23/12/2009 -> 07/2012
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaFinances - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.spifina_bo.inc.php');
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.vat_bo.inc.php');


class spifina_ui extends spifina_bo
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
		'budget'	=> true,
		'zip'		=> true,
		'pdf_liste'	=> true,
		'collect'	=> true,
		'get_client_provider_contract' => true,
		'about'		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*
	* \version BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spifina
	*
	* \version BBO - 02/08/2010 - Variable pour connaitre le niveau de l'utilisateur connecté dans l'application spifina
	*/
		parent::__construct();
		$GLOBALS['egw_info']['flags']['java_script_thirst'] = $this->write_js();
	}
	
	function spifina_ui(){
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
							echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spifina.spifina_ui.pdf_liste&id='.utf8_decode($factures))."','_blank','dependent=yes,width=750,height=600,scrollbars=yes,status=yes');</script></body></html>\n";
						}
						break;
					case 'zip':
						if(is_array($content['nm']['rows']['checked'])){
							$factures = implode(',',$content['nm']['rows']['checked']);
							echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spifina.spifina_ui.zip&id='.utf8_decode($factures))."','_blank','dependent=yes,width=10,height=10,scrollbars=yes,status=yes');</script></body></html>\n";
						}
						break;
					case 'send':
						if(is_array($content['nm']['rows']['checked'])){
							foreach($content['nm']['rows']['checked'] as $data => $facture_id){
								$facture = $this->read($facture_id);
								$facture['invoice_send'] = 2;
								$this->data = $facture;
								$this->save();
							}
						}
						break;
					case 'unvalidate':
						if(is_array($content['nm']['rows']['checked'])){
							foreach($content['nm']['rows']['checked'] as $data => $facture_id){
								$facture = $this->read($facture_id);
								$facture['generated_pdf'] = 0;
								$facture['invoice_validate'] = 0;
								$facture['validation_date'] = NULL;
								$this->data = $facture;
								$this->save();
							}
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
			$content['nm'] = $GLOBALS['egw']->session->appsession('facture_index','spifina');

		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols='facture_id,facture_number,operation_code,creation_date,client_id,tickets_number';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spifina.spifina_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
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
				'filter_label'   	=> '',	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'filter2_label'  	=>	'',			// IO filter2, if not 'no_filter2' => True
				'filter2'       	=>	'',			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export(),
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=$_GET['msg'];
		}
		if(isset($_GET['filter'])){
			$filter = $_GET['filter'];
		}
		
		if($filter=='viewall' || empty($filter)){
			$content['nm']['filter2']= '6';
		}
		if($filter=='viewnonvalidated'){
			$content['nm']['filter2']= '1';
		}
		if($filter=='unpayed'){
			$content['nm']['filter2']= '4';
		}
		if($filter=='remind'){
			$content['nm']['filter2']= '7';
		}
		
		$content['msg']=$msg;
		
		
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		$client_bo = CreateObject("spiclient.client_bo");
		$providers = $client_bo->get_all_clients($spiclient_config['ProviderType']);
		
		$client_bo = CreateObject("spiclient.client_bo");
		$clientsprospects = $client_bo->get_all_except_suppliers($nocrop=false);
		
		$my_orgs = $this->facture_client_groups($content['nm']['year']);
		$contrats = array('0'=>'') + $this->get_contract();
		
		// _debug_array($my_orgs);
		
		$sel_options = array(
			'filter'	=> array('' => lang('Providers')) + $providers,
			'filter2' 	=> array(
				//'0'	=>	'All invoices',
				'1'	=>	'Unvalidated invoices',
				'2'	=>	'Validated invoices',
				'3'	=>	'Payed & validated invoices',
				'4'	=>	'Not payed validated invoices',
				'5'	=>	'Not sent invoices',
				'6'	=>	'All invoices',
				'7' =>  'Invoices to remind',
			),
			'payment_delay'	=>	$client_bo->get_delai_paiement(),
			'action' => $this->actions,
			
			// 'provider' => $providers,
			'client'	=> $this->is_admin() ? $clientsprospects : $my_orgs,
			'contract_id' =>  $contrats,
			'invoice_send' => array('' => '', '2' => lang('L'),'1' => lang('@')),
		);
		
		if(!$this->is_admin()){
			$sel_options['filter2']= array(
				'2'	=>	'Validated invoices'
			);

			// $client_id = $this->facture_client_groups('', false);
			foreach($my_orgs as $id => $value){
				if(!empty($id)){
					$content['nm']['col_filter'] = array('client_id'=> $id);
				}
			}
		}

		if($content['nm']['client']>0){
			$sel_options['contract'] = array('0'=>'') + $this->get_contract_used($content['nm']['client']);
			}else{
				$sel_options['contract'] = $contrats;
			}
			
		
		$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
		$sel_options['invoice_cat'] = array('0'=>'') + $fact_cat_bo->get_cat_facture();
		
		
		$content['nm']['template']='spifina.facture.index.rows';

		if($this->is_admin()){
			$content['nm']['header_right'] = 'spifina.facture.index.right';
			// $content['nm']['header_left'] = 'spifina.facture.index.year';
			// $content['nm']['header_left'] = 'spifina.facture.index.left';
			$content['nm']['year'] = isset($content['nm']['year']) ? $content['nm']['year'] : date("Y")+1;
		}
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Invoice Management');	
		
		$tpl = new etemplate('spifina.facture.index');
		$tpl->exec('spifina.spifina_ui.index', $content,$sel_options,$no_button, $content);
	}

	
	
	function edit($content=null){
	/**
	* Charge l'etemplate d'édition d'une facture, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['facture_id']
	*
	* @param array $content=NULL
	*/
		if(!$this->is_admin()){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.edit</h1>\n",null,true);
			return;
		}
		
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
				$msg=lang('Ticket deleted from invoice');
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
			list($idl) = @each($content['custom_line']['delete']);
			
			$this->delete_line($idl);
			unset($content['custom_line']['delete']);
			foreach($content['custom_line'] as $row=>$detail){
				if($content['custom_line'][$row]['detail_id'] == $idl){
					unset($content['custom_line'][$row]);
				}
			}
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
						$msg=lang('Invoice deleted');
					}else{
						$msg=lang('Error while deleting invoice');
					}
					echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
					break;
				case 'pdf':
					$this->pdf($content['facture_id']);
					break;
				case 'validate':
					// Récupération du taux de tva
					// $tva_bo = new vat_bo();
					// $tva = $tva_bo->get_info($content['facture_taux_id']);

					$tva = $this->so_vat->read($content['facture_taux_id']);
					$content['facture_taux_tva'] = $tva['vat_rate'];
					if($content['contract_id']>0){
						$contrat = $this->so_contrat->read($content['contract_id']);
						$contrat['date_last_invoice'] = $content['send_date'];
						$this->so_contrat->data = $contrat;
						$this->so_contrat->save();
					}
					// On fait un premier enregistrement pour repasser par les fonctions de get..
					$this->add_update_facture($content);
					// garder le $content à gauche pour que les prix calculés soit pris en comtpe
					$content=$this->get_info($content['facture_id']) + $content;
					
					$content['validation_date']=time();
					$content['invoice_validate']=1;
				case 'save':
				case 'apply':
					$check_invoice = array();
					if(empty($content['facture_id'])){
						$check_invoice = $this->so_factures->search(array('facture_number' => $content['facture_number']),false);
					}

					if(!empty($check_invoice)){
						$msg = lang('Error').': '.lang('Invoice number already exists in the database');
					}else{
						$msg=$this->add_update_facture($content);
						if($button=='save' || $button=='validate'){
							echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
								addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
							$GLOBALS['egw']->common->egw_exit();
						}
						$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script language=\"JavaScript\">
							var referer = opener.location;
							opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';
							</script>";
					}
					break;
				case 'refresh':
					break;
				case 'new_line':
					$msg = $this->add_update_facture($content);
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
			$content['spifina']=$spifina;
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
				'spifina'	=> $spifina,
			);
			$readonlys=array();
			if(empty($id)){
				$content['hideupdate']=true;
				// fonction get_last_invoice : récupère un tableau avec le dernier numéro de facture
				// la valeur affiche contient un appel sur la fonction javascript set_invoice pour remplir les champs automatiquement
				$content['last_invoice'] = $this->get_last_invoice();
				//_debug_array($content);
				
				$GLOBALS['egw_info']['flags']['app_header'] = lang('New Invoice');
				$readonlys['button[delete]']=true;

				// Défaut - Taux TVA
				$content['facture_tva_id'] = $this->obj_config['default_vat'];

				// Défaut - Facture isolée 
				$content['alone_invoice'] = $this->obj_config['default_alone_invoice'] ? true : false;

				// Défaut - Date période
				if(date('j') <= 10){
					$content['start_period_date'] = mktime(0,0,0,date('m')-1,1);
					$content['end_period_date'] = mktime(0,0,0,date('m'),1) - 86400;
				}else{
					$content['start_period_date'] = mktime(0,0,0,date('m'),1);
					$content['end_period_date'] = mktime(0,0,0,date('m'),date('j'));
				}

				// Traitement création externe
				if($_GET['link_app'] && $_GET['link_id']){
					switch($_GET['link_app']){
						case 'spiclient':
							$content['client_id'] = $_GET['link_id'];
							break;
					}
				}
			}else{
				// get_info : remplissage du tableau avec les infos de la facture (entêtes et lignes)
				// $id = numéro de la facture
				$content+=$this->get_info($id);				

				$client_bo = CreateObject("spiclient.client_bo");
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit Invoice').' '.$content['facture_number'];
								
				$readonlys['facture_number']=true;
				$readonlys['societe_id']=true;
				$readonlys['client_id']=true;
				// $readonlys['start_period_date']=true;
				// $readonlys['end_period_date']=true;
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
					$readonlys['invoice_cat'] = false;
					
					$readonlys['facture_tva_id'] = true;
					
					
					unset($readonlys['payment_date']);
				}else{
					unset($content['invoice_validate']);
				}

				if(!$this->is_admin()){
					// _debug_array('ici');
					$readonlys['button[delete]'] = true;
				}
			}

			if((count($content['ticket'])<=0 && count($content['custom_line'])<=0)||($content['send_date']==0)){
				$readonlys['button[validate]']=true;	
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
		}

		// Spiquote / Transformation en facture
		if($_GET['q_id']){
			$content += $this->get_quote($_GET['q_id']);
		}

		// Masque les lignes persos s'il y en a pas
		if(count($content['custom_line']) <= 0){
			$content['custom_line']['hidecustom'] = true;
		}
		
		
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		$client_bo = CreateObject("spiclient.client_bo");
		$providers = $client_bo->get_all_clients($spiclient_config['ProviderType']);
		
		$sel_options['payment_delay']=$client_bo->get_delai_paiement();
		
		$sel_options['client_id']=$this->get_customer_billable();
		$sel_options['societe_id']=$providers;

		$sel_options['alone_invoice']=array(
			'0'	=> 'No',
			'1'	=> 'Yes',
		);
		
		$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
		$sel_options['extra_cat_id'] = $content['invoice_validate'] ? array() : array('0'=>'Select one') + $fact_cat_bo->get_cat_facture();
		$sel_options['invoice_cat'] = array('0'=>'Select one') + $fact_cat_bo->get_cat_facture();

		// Taux de TVA
		$sel_options['facture_tva_id'] = vat_bo::get_vat();
		$sel_options['vat_id'] = vat_bo::get_vat();

		// Contrat
		$sel_options['contract_id'] = $this->get_contract($content['client_id'],$content['societe_id']);
		
		// Contrat par défaut si un seul contrat + pas encore de ligne
		if(count($sel_options['contract_id']) == 1 && count($content['custom_line']) == 0){
			list($contract) = @each($sel_options['contract_id']);
			$content['contract_id'] = $contract;
		}

		// Selection du compte bancaire
		// _debug_array( $client_bo->get_bank_account($content['societe_id'],$bank_only=true));
		
		// $config = CreateObject('phpgwapi.config');
		// $spiclient_config = $config->read('spiclient');
		// $client_bo = CreateObject("spiclient.client_bo");
		
		$sel_options['invoice_bank_account'] = $client_bo->get_bank_account($content['societe_id'],$bank_only=true);

		//Vérification que le ticket en cours d'ouverture et appartient bien au groupe du user connecté 
		//quand ce dernier ne fait partie que d'un groupe
		if(!empty($content['facture_id'])){
			if(!$this->verification_facture($content['facture_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.edit - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
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
			// $content['facture_taux_tva'] = 19.6;
			$tva_bo = new vat_bo();
			$tva = $tva_bo->get_info($this->obj_config['default_vat']);
			$content['facture_taux_tva'] = $tva['vat_rate'];

			$content['hide_spid'] = true;
			$content['hide_spid2'] = true;
		}else{
			if(array_key_exists('spid', $GLOBALS['egw_info']['apps'])){
				$content['hide_spid'] = false;
				$content['hide_spid2'] = true;
			}else{
				$content['hide_spid'] = true;
				$content['hide_spid2'] = false;
			}
		}

		// Masquer si pos spid et pas en base
		$content['hide_spid_val'] = empty($content['validation_date']) || array_key_exists('spid', $GLOBALS['egw_info']['apps']);

		// Date en readonly pour les non-admins
		$readonlys['payment_date'] = !$this->is_admin();
		$readonlys['send_date'] = !$this->is_admin();

		// Masque la colonne user des lignes si non utilisés
		if(!$this->obj_config['use_intervenant']){
			$content['custom_line']['hide_user'] = true;
		}else{
			$content['custom_line']['hide_user'] = false;
		}

		// Creation a partir d'un contrat
		if(!$content['facture_id']){
			$content['contract_creation'] = $this->obj_config['contract_creation'] ? true : false;
		}else{
			$content['contract_creation'] = false;
		}

		// Alimentation du modèle de paiement à partir de la configuration du client..
		if(!empty($content['client_id']) && ($content['payment_delay']==0 OR empty($content['payment_delay']))){
			$client_info = $client_bo->get_info($content['client_id']);
			$content['payment_delay'] = $client_info['client_delai_paiement'];
		}
		// _debug_array($client_info);
		
		
		$readonlys['button[delete]'] = $content['generated_pdf'];


		$content['hidepdf'] = !$content['generated_pdf'];

		$tpl = new etemplate('spifina.facture.edit');
		$tpl->exec('spifina.spifina_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}


	function get_client_provider_contract(){
	/**
	 * Retourne JSON pour le JS lors de la création d'une facture
	 *
	 * @return string
	 */
		$retour = array(); 
		$contract = $this->so_contrat->read($_GET['contract']);
		error_log($_GET['contract']);
		$contract_id = mb_convert_encoding($contract['contract_id'],'UTF-8','UTF-8');

		$client = mb_convert_encoding($contract['contract_client'],'UTF-8','UTF-8');
		$retour['client'] = $client;

		$supplier = mb_convert_encoding($contract['contract_supplier'],'UTF-8','UTF-8');
		$retour['provider'] = $supplier;

		$retour = json_encode($retour, JSON_FORCE_OBJECT|JSON_HEX_QUOT);
		error_log($retour);
		echo $retour;
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
			
			//Si la facture n'existe pas encore
			if(!isset($content['facture_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.view - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
				return;
			}
			$GLOBALS['egw_info']['flags']['app_header'] = lang('View Invoice');
			
			
			$config = CreateObject('phpgwapi.config');
			$spiclient_config = $config->read('spiclient');
			$client_bo = CreateObject("spiclient.client_bo");
			$sel_options['payment_delay'] = $client_bo->get_delai_paiement();
			$sel_options['societe_id'] = $client_bo->get_all_clients($spiclient_config['ProviderType']);
			
			$sel_options['client_id'] = $this->get_customer_billable();
			
			$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
			$sel_options['extra_cat_id']=$fact_cat_bo->get_cat_facture();
			
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spifina.spifina_ui.index');
		}
		$readonlys=$content;
		$readonlys['add_ticket']=true;
		$readonlys['ticket_forfait']=true;
		$content['ticket']['validate_invoice']=true;
		$readonlys['invoice_message']=true;
		$readonlys['alone_invoice']=true;
		$readonlys['button[validate]'] = true;
		$readonlys['facture_tva_id'] = true;
		$readonlys['custom_line']['user_id'] = true;
		$readonlys['custom_line']['custom_line']['user_id'] = true;
		
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
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.view // verification - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
				return;
			}
		}

		unset($content['hidebuttons']);

		if(!$this->is_admin()){
			$readonlys['button[delete]'] = true;
			$content['hidebuttons'] = true;
			$readonlys['__ALL__'] = true;
		}

		$content['custom_line']['hideaction'] = true;
		$readonlys['custom_line'][1] = true;
		$readonlys['custom_line']['up'] = true;
		$readonlys['custom_line']['down'] = true;
		$content['hideaction'] = true;

		// Taux de TVA
		$sel_options['facture_tva_id'] = array(''=>'') + vat_bo::get_vat();
		$sel_options['vat_id'] = array(''=>'') + vat_bo::get_vat();
		$sel_options['invoice_cat']= array('0'=>'Select one') + $fact_cat_bo->get_cat_facture();
		
		// Date en readonly pour les non-admins
		// $readonlys['payment_date'] = !$this->is_admin();
		// $readonlys['send_date'] = !$this->is_admin();
		
		$readonlys['invoice_cat'] = false;

		$content['hide_spid_val'] = /*empty($content['validation_date']) ||*/ !array_key_exists('spid', $GLOBALS['egw_info']['apps']);
		$readonlys['button[delete]'] = true;
		// _debug_array($content);
		// $readonlys['__ALL__'] = true;
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View Invoice').' '.$content['facture_number'].' '.$content['client_company'];		
		$tpl = new etemplate('spifina.facture.edit');
		$tpl->exec('spifina.spifina_ui.edit', $content,$sel_options,$readonlys,$content,2);
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
		if(!$this->is_admin()){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.pdf - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
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
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spifina';
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
			$msg=lang('The bill been successfully generated');
		}else{
			$msg=lang('A problem happens during the generation of the bill in PDF format');
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
		if(!$this->is_admin()){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.pdfsimul - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
			return;
		}

		$id = empty($id) ? $_GET['id'] : $id;
		$simul = empty($_GET['proforma']) ? 1 : 2;
		if (empty($id)){ return false; }
		
		$facture=$this->search(array('facture_id'=>$id),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
		$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$pdf = CreateObject($this->obj_config['invoice_model'],$facture_emeteur[0],$facture_client[0],$id);
		// _debug_array($simul);
		$pdf->generate($id,$this,$simul);

		//Test du répertoire Racine des factures
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spifina';
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
			$msg=lang('The invoice has been successfully generated');
		}else{
			$msg=lang('A problem happens during the generation of the bill in PDF format');
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
		
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spifina/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
					
		if(!file_exists($repertoire)){
			return false;
		}
		
		$nomFichierPDF=$repertoire.'/'.$facture_number.".pdf";
		if(file_exists($nomFichierPDF)){
			$repertoireOuvertureFichier=$GLOBALS['egw_info']['server']['files_dir'].'/spifina/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'].'/'.$facture_number.'.pdf';
		}else{
			return false;
		}

		//YLF
		$repertoireOuvertureFichier="/index.php?menuaction=spifina.spifina_ui.tprint&id=".$client_id."&facture=".$facture_number."&download=1";
		
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
		$client_id=$this->facture_client_groups(null,false);
		$client=$this->so_client->search(array('client_id'=>$id),false);
		
		
		if(!$this->is_admin() || count($client_id)==1 ){
			echo count($client_id);
			if(key($client_id)!=$client[0]['client_id']){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.tprint - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
				return;
			}
		}
		
		
		$numFacture=$_GET['facture'];
		
		$facture=$this->search(array('facture_number'=>$numFacture),false);
		$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$id),false);
		
		$repertoire=$GLOBALS['egw_info']['server']['files_dir']."/spifina/presta_".$societe[0]['client_company']."/".$relationClientSociete[0]['operation_code'];
		if(!file_exists($repertoire)){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('An error has occured').' !<br />'.lang('Please contact support').'</h1><br />',null,true);
			return false;
		}
		
		$nomFichierPDF=$repertoire.'/'.$numFacture.".pdf";
		if(file_exists($nomFichierPDF)){
			$repertoireOuvertureFichier=$GLOBALS['egw_info']['server']['files_dir'].'/spifina/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'].'/'.$numFacture.'.pdf';
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

					if(mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers, '-f '.$content['sendby'])){
						$facture=$this->search(array('facture_number'=>$content['facture_id']),false);
						if($content['remind']){
							$facture[0]['invoice_remind_date'] = time();
							$facture[0]['invoice_remind_user'] = $GLOBALS['egw_info']['user']['account_id'];
						}else{
							$facture[0]['invoice_send'] = 1;
						}
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
			$content['sendby'] = $GLOBALS['egw_info']['user']['account_email'];
			
			$facture_client=$this->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
			$content['sendto'] = $facture_client[0]['client_email'];

			$content['sendcc'] = $facture_client[0]['client_email_cc'];
			
			//sujet du mail
			$facture_emetteur=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$content['subject']= $facture_emetteur[0]['client_company'].' - '.$facture_client[0]['client_company'].': Facture n°'.$facture[0]['facture_number'].' du '.date('j-m-Y',$facture[0]['start_period_date']).' au '.date('j-m-Y',$facture[0]['end_period_date']);
						
			// infos concernant le fichier a mettre en pièce jointe
			$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
			
			// $repertoire='spifina/FACTURES/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
			$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spifina/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
			
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
			if($_GET['remind']){
				$content['remind'] = true;
				$content['message'] = $general['remind_mail'];
			}else{
				$content['message'] = $general['mail_content'];
			}
		}
		$content['msg'] = $msg;
		$tpl = new etemplate('spifina.facture.mail');
		$tpl->exec('spifina.spifina_ui.mail', $content,$sel_options,$readonlys,$content,2);
	}
	
	function pay($content=null){
		
		if(!$this->is_admin()){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.pay - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
			return;
		}
		
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
					$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script language=\"JavaScript\">
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
				$content['payment_amount'] = utf8_encode(number_format($content['total_ht'] + $montant_tva,2,',',' '));
				$content['payment_date'] = time();
			}
		}
		
		//on récupère le fournisseur
			$fournisseur=$this->so_client->search(array('client_id'=>$content['provider']),false);
			if(!empty($fournisseur)){
				$content['provider_name'] = $fournisseur[0]['client_company'];
			}
		// _debug_array($content);
		
		$tpl = new etemplate('spifina.facture.pay');
		$tpl->exec('spifina.spifina_ui.pay', $content,$sel_options,$readonlys,$content,2);
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
		$name = tempnam($GLOBALS['egw_info']['server']['temp_dir'],"spifina_factures.zip");
		exec('rm -f "'.$name.'"');
		exec('mkdir "'.$name.'"');

		// Parcours des factures sélectionnés
		foreach($factures as $facture_id){
			// Informations sur la facture
			$facture = $this->search(array('facture_id' => $facture_id),false);
			
			$societe=$this->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
			$relationClientSociete=$this->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
			
			// Récupération du dossier dans lequel se trouve la facture
			$repertoire = $GLOBALS['egw_info']['server']['files_dir'].'/spifina/presta_'.$societe[0]['client_company'].'/'.$relationClientSociete[0]['operation_code'];
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

	
	function collect($content=null){	
	/**
	* 
	*/
	
		if(!$this->is_admin()){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  spifina_ui.collect - votre niveau : ".$GLOBALS['egw_info']['user']['spifinaLevel']."</h1>\n",null,true);
			return;
		}
		
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols='facture_id,contract_id,client_id,send_date,payment_date,total_ht,total_tva,total_ttc,payment_amount,payment_bank';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=> 'spifina.spifina_bo.get_rows_collect',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> true,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'options-cat_id' 	=> false,
				'start'          	=> 0,			// IO position in list
				'cat_id'         	=> '',			// IO category, if not 'no_cat' => True
				'search'         	=> '',// IO search pattern
				'order'          	=> 'facture_number',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=> 'DESC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=> array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     	=> true,
				'no_filter2'     	=> true,
				'filter_label'   	=> '',	// I  label for filter    (optional)
				'filter'         	=> '',	// =All	// IO filter, if not 'no_filter' => True
				'filter2_label'  	=> '',			// IO filter2, if not 'no_filter2' => True
				'filter2'       	=> '',			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export_collect(),
			);
		}		
		
		$clients = $this->facture_client_groups($content['nm']['year']);
		$client_bo = CreateObject("spiclient.client_bo");
		$delai_paiement=$client_bo->get_delai_paiement();
		$modele_paiement=$client_bo->get_mode_reglement();
		
		$sel_options = array(
			'payment_mode'	=>	$modele_paiement,
			'contract_id' => $this->get_contract(),
			'client_id' => $this->get_customer_billable(true),

			'provider' => $this->get_providers(),
		);

		$content['nm']['provider'] = isset($content['nm']['provider']) ? $content['nm']['provider'] : current(array_keys($this->get_providers()));
			
		$content['nm']['header_left'] = 'spifina.collect.index.left';
		$content['nm']['year'] = isset($content['nm']['year']) ? $content['nm']['year'] : date("Y")+1;
		$content['nm']['month'] = isset($content['nm']['month']) ? $content['nm']['month'] : date("m");
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('VAT / Collect');	

		$tpl = new etemplate('spifina.collect.index');
		$tpl->exec('spifina.spifina_ui.collect', $content,$sel_options,$no_button, $content);
	}


	function about(){
	/**
	* Affiche le boite de dialogue 'A propos ...'
	*/
		$content=$sel_options=$readonlys=array();
		$lines=file(EGW_INCLUDE_ROOT.'/spifina/about/about_fr.txt');
		$content['about']="";
		foreach ($lines as $line_num => $line) {
			$content['about'] .= htmlspecialchars($line) . "<br />\n";
		}

		$content['about'] .= "<hr /><br/>";

		// Info de l'appli (Table / Version)
		$app = $GLOBALS['egw_info']['flags']['currentapp'];
		$infoApp = $GLOBALS['egw_info']['apps'][$app];

		$file = EGW_SERVER_ROOT."/$app/setup/tables_current.inc.php";
		$phpgw_baseline = array();
		if ($app != '' && file_exists($file)){
			include($file);
		}
		
		$content['about'] .= lang('Version').' : '.$infoApp['version']."<br/>";
		$content['about'] .= lang('Tables').' :<br/>'.implode("\t<br/>",array_keys($phpgw_baseline))."<br/>";
		
		$tpl = new etemplate('spifina.about');
		$tpl->exec('spifina.spifina_ui.about', $content,$sel_options,$readonlys,$content,0);
	}
}

?>
