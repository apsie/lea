<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009-> avril 2016
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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.client_bo.inc.php');	

class client_ui extends client_bo
{
	var $public_functions = array(
		'index' 		=> true,
		'edit' 			=> true,
		'edit_nature'	=> true,
		'edit_relation'	=> true,
		'edit_checklist'=> true,
		'view' 			=> true,
		'about' 		=> true,
		'pdf' 			=> true,
		'photo'			=> true,
		'quick_add'		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*
	* \version BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spiclient
	*/
		
		parent::__construct();		
		$this->prefs = $GLOBALS['egw_info']['user']['preferences']['spiclient'];
		// $this->obj_js = CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
		$FileNameAJAX=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/js/ajax_request.js';
		$FileNameCSS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/css/alert.css';
		$FileNameCSS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/css/default.css';
		$FileNameCSS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/css/alphacube.css';
		$FileNameJS1=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/js/prototype.js';
		$FileNameJS2=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/js/effects.js';
		$FileNameJS3=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/js/window.js';
		$FileNameJS4=$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient/js/functions.js';
		$javascript="";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS1.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS2.'" />'."\n";
		$javascript.='<link rel="stylesheet" type="text/css" media="all" href="'.$FileNameCSS3.'" />'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameAJAX.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS1.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS2.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS3.'"></script>'."\n";
		$javascript.='<script type="text/javascript" src="'.$FileNameJS4.'"></script>'."\n";
		$javascript.='<script type="text/javascript">var ajax_request = new ajax_request("'.$GLOBALS['egw_info']['server']['webserver_url'].'/spiclient");</script>'."\n";
		// $GLOBALS['egw_info']['flags']['java_script'].=$javascript."\n";
	}
	
	function client_ui(){
	/**
	*Constructeur
	*/
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
		* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
		*
		* Sélectionne par défaut les entreprises facturables
		*
		* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
		*/
		$time_start = microtime(true);

		// Si le user n'a pas le droit d'accéder au clients on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$msg='';
		if(isset($content['nm']['rows']['delete'])){
			list($id) = @each($content['nm']['rows']['delete']);

			$prestataires = $this->get_prestataires($id);
			$contact = $this->get_contact($id);
			$contrat = $this->get_contrat($id);

			if(count($prestataires) == 0 && count($contact) == 0 && count($contrat) == 1){
				if($this->delete($id)){
					$msg = lang('Client deleted');
				}
			}else{
				$msg =  lang('Impossible to delete this client !').' '.lang('Delete relations first, (contacts, contracts, etc)');
			}

			unset($content['nm']['rows']['delete']);
		}
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$default_cols='client_id,account_id,client_first_name,client_last_name,client_company,client_adr_one_street,client_adr_two_street,client_locality,client_postalcode,client_email,client_tel,client_chalandise,client_operation_code,client_payment_model,creator_id';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spiclient.client_bo.get_rows',	// 
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> true,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> true,
				'options-cat_id' 	=> false,
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'no_filter'     	=> false,
				'no_filter2'     	=> false,
				'filter_label'   	=>	'Provider',	// I  label for filter    (optional)
				'filter2_label'   	=>	'Client type',	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'default_cols'   	=> $default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export(),
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}		
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}
		if(isset($_GET['filter'])){
			$filter=$_GET['filter'];
			$content['nm']['filter_client'] = $filter;
		}
		
		/* Si le user a seulement accès à ses propres clients on mets le filtre2 en place */
		if($this->obj_acl->ownAccessClient){
			$content['nm']['filter_client'] = 'myclients';
		}
		
		// $time_end = microtime(true);
  //   	$time = $time_end - $time_start;
  //   	echo "Process Time: {$time}";

		$content['msg']=$msg;
		$sel_options = array(
			'filter' => array('' => 'All') + $this->get_all_clients($this->obj_config['ProviderType']),
			'filter2' => array('' => lang('All')) + $this->get_type_client(),
			'client_parent'	=> $this->get_parent_client(),
			'client_sector' => $this->get_sectors(),
			'client_chalandise' => $this->get_chalandise(),
			'client_seller_id' => $this->get_sellers(),
			'client_region' => $this->get_zone(),
			'client_mode_reglement'	=> $this->get_mode_reglement(),
			'client_type' => $this->get_type_client(),
		);
		$content['nm']['template']='spiclient.client.index.rows';

		// $time_end = microtime(true);
  //   	$time = $time_end - $time_start;
  //   	echo "Process Time: {$time}";
		
		/* Bouton ajouter uniquement si le user a le droit d'ajouter des clients */
		if($this->obj_acl->allowAddClient){
			$content['nm']['header_right'] = 'spiclient.client.index.right';
		}
		
		$content['nm']['header_left'] = 'spiclient.client.index.left';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Client Management');	

		$client_error=$this->control_group();
		$GLOBALS['egw_info']['user']['ClientError']=array();
		if(!empty($client_error)){
			foreach((array)$client_error as $id=>$error){
				$msg.= "- ".$error['client_company']."<br/>";
				$GLOBALS['egw_info']['user']['ClientError'][]=$error['client_id'];
			}
			$verbe="est";
			$more="";
			if(count($client_error)>1)
			{
				$verbe="sont";
				$more="s";
			}		
			$onload="Dialog.alert('<b>Le".$more." client".$more." ci-dessous ".$verbe." en erreur :</b><br/>".$msg."', {
					windowParameters: {	className: 'alphacube' },
					okLabel : 'OK',
					}
				);";
			$GLOBALS['egw']->js->set_onload($onload);
		}
		$css='<STYLE type="text/css">
			<!--
				.probleme { background-color: '.$this->obj_preferences['client_probleme'].'; }
				.sommeil { 	background-color: '.$this->obj_preferences['client_sommeil'].'; }
			-->
		</STYLE>';
		$GLOBALS['egw_info']['flags']['java_script'].=$css."\n";
		
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.client.index');
		$tpl->exec('spiclient.client_ui.index', $content,$sel_options,$no_button, $content);
	}

	
	
	function edit($content=null){
		/**
		* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
		*
		* Le contenu à visualiser peut se faire via $_GET['id'] ou via $content['client_id'] (dans le second cas, des vérifications seront faites)
		*
		* @param array $content=NULL
		*/
		$time_start = microtime(true);

		// Si le user n'a pas le droit d'acceder au client on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$current_tab = $content[$this->tabs];
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			if(!empty($button)){
				switch($button){
					case 'save':
					case 'apply':
						if(strlen($content['client_bic']) == 0 || strlen($content['client_bic']) == 8 || strlen($content['client_bic']) == 11){
							$msg = $this->add_update_client($content);
							if($button=='save'){
								echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
									addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
								$GLOBALS['egw']->common->egw_exit();
							}
							$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
								var referer = opener.location;
								opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
						}else{
						// Le BIC n'est pas vide et ne fait pas 8 ou 11 caractères
							$msg = lang('Client BIC must be 8 or 11 caracters');
							$current_tab = 'spiclient.client.edit.accounting';
						}
						break;
					// default:
					case 'cancel':
						echo "<html><body><script>window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
						break;
				}
			}
			$id=$content['client_id'];
			
			$content['msg']=$msg;
			$content['spiclient']=$spiclient;
			// _debug_array($content);
			// Ajout d'un client
			if(isset($content['clients']['button']['add_client'])){
				$client_relation = array(
					'client_id' => $content['clients']['client'],
					'societe_id' => $content['client_id'],
					'payment_model' => $content['clients']['payment_model'],
					'operation_code' => $content['clients']['operation_code'],
				);
				$this->so_clients_relations->data = $client_relation;
				$this->so_clients_relations->save();
				$current_tab = 'spiclient.client.edit.clients';
			}
			
			// Suppression d'un client
			if(isset($content['clients']['delete'])){
				foreach((array)$content['clients']['delete'] as $id_delete => $data){
					$this->so_clients_relations->delete($id_delete);
				}
			}
			unset($content['clients']['delete']);
			unset($content['clients']['button']);
			
			// Ajout d'un prestataire
			if(isset($content['prestataires']['button']['add_client'])){
				$client_relation = array(
					'client_id' => $content['client_id'],
					'societe_id' => $content['prestataires']['fournisseur'],
					'payment_model' => $content['prestataires']['payment_model'],
					'operation_code' => $content['prestataires']['operation_code'],
				);
				$this->so_clients_relations->data = $client_relation;
				$this->so_clients_relations->save();
			}
			
			// Suppression d'un prestataire
			if(isset($content['prestataires']['delete'])){
				foreach((array)$content['prestataires']['delete'] as $id_delete => $data){
					$this->so_clients_relations->delete($id_delete);
				}
			}
			unset($content['clients']['delete']);
			unset($content['clients']['button']);
			
			// Ajout d'un objet dans checklist
			if(isset($content['checklist']['button']['add_chk'])){
				$check = array(
					'cat_id' => $content['checklist']['cat_id'],
					'client_id' => $content['client_id'],
					'chk_title' => $content['checklist']['chk_title'],
					'chk_comment' => $content['checklist']['chk_comment'],
					'chk_active' => $content['checklist']['chk_active'],
					'chk_order' => $content['checklist']['chk_order'],
					'creation_date' => time(),
					'creator_id' => $GLOBALS['egw_info']['user']['account_id'],
				);
				$this->so_checklist->data = $check;
				$this->so_checklist->save();
				
				$historylog = CreateObject('phpgwapi.historylog','spiclient');
				$historylog->add(lang('Add checklist'),$id,$check['chk_title'],'-');
			}
			// Suppression d'un prestataire
			if(isset($content['checklist']['delete'])){
				foreach((array)$content['checklist']['delete'] as $id_delete => $data){
					$check = $this->so_checklist->read($id_delete);
					$this->so_checklist->delete($id_delete);
					
					$historylog = CreateObject('phpgwapi.historylog','spiclient');
					$historylog->add(lang('Remove checklist'),$id,'-',$check['chk_title']);
				}
			}
			unset($content['checklist']['delete']);
			unset($content['checklist']['button']);
			
			// Up d'une nature technique
			if(isset($content['technique']['up'])){
				foreach((array)$content['technique']['up'] as $client_nature_id => $data){
					$client_nature = $this->so_client_nature->read($client_nature_id);
					$client_nature['client_nature_ordre'] = $client_nature['client_nature_ordre'] > 0 ? $client_nature['client_nature_ordre']-1 : $client_nature['client_nature_ordre'];
					$this->so_client_nature->data = $client_nature;
					$this->so_client_nature->update($client_nature,true);
				}
			}
			// Down d'une nature technique
			if(isset($content['technique']['down'])){
				foreach((array)$content['technique']['down'] as $client_nature_id => $data){
					$client_nature = $this->so_client_nature->read($client_nature_id);
					$client_nature['client_nature_ordre'] = $client_nature['client_nature_ordre'] + 1;
					$this->so_client_nature->data = $client_nature;
					$this->so_client_nature->update($client_nature,true);
				}
			}
			
			// Suppression d'une nature technique
			if(isset($content['technique']['delete'])){
				foreach((array)$content['technique']['delete'] as $client_nature_id => $data){
					$this->so_client_nature->delete($client_nature_id);
				}
				$current_tab = 'technique';
			}

						
			// if(isset($content['technique']['button']['add_nature'])){
			// 	echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spiclient.client_ui.edit_nature&client_id='.utf8_decode($content['client_id']))."','_blank','dependent=yes,width=550,height=350,scrollbars=yes,status=yes');</script></body></html>\n";
			// }

			// Suppression d'une nature technique
			if(isset($content['address']['delete'])){
				foreach((array)$content['address']['delete'] as $address_id => $data){
					$this->so_address->delete($address_id);
				}
				$current_tab = 'address';
			}

			// if(isset($content['address']['button']['add_address'])){
			// 	echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spiclient.address_ui.edit&client_id='.utf8_decode($content['client_id']))."','_blank','dependent=yes,width=850,height=300,scrollbars=yes,status=yes');</script></body></html>\n";
			// }
			
			if(isset($content['contact']['button']['add_contact'])){
				// cas du clic sur le bouton ajouter dans l'onglet contact
				if(empty($content['contact']['compte']) && !empty($content['contact']['n_given']) && !empty($content['contact']['n_family'])){
					$contact = array(
						'adr_one_countryname' => 'FRANCE',
						'contact_owner' => $GLOBALS['egw_info']['user']['preferences']['addressbook']['add_default'] ? (int)$GLOBALS['egw_info']['user']['preferences']['addressbook']['add_default'] : $GLOBALS['egw_info']['user']['account_id'],
						'contact_private' => 0,
						'contact_tid' => 'n',
						'creator' => $GLOBALS['egw_info']['user']['account_id'],
						'created' => time(),
						'addr_format' => 'postcode_city',
						'addr_format2' => 'postcode_city',
						'fileas_type' => $GLOBALS['egw_info']['user']['preferences']['addressbook']['link_title'],
						'n_family' => $content['contact']['n_family'],
						'n_given' => $content['contact']['n_given'],
						'contact_email' => $content['contact']['contact_email'],
						'tel_work' => $content['contact']['tel_work'],
						'tel_cell' => $content['contact']['tel_cell'],
						'n_fn' => $content['contact']['n_given'].' '.$content['contact']['n_family'],
					);
					
					$so_addressbook = new so_sql('phpgwapi', 'egw_addressbook');
					$so_addressbook->data = $contact;
					$verif = $so_addressbook->save();
					$content['contact']['compte'] = $so_addressbook->data['contact_id'];
				}

				$link_app = $content['contact']['app'];
				$link_id = $content['contact']['compte'];
				if (preg_match('/^[a-z_0-9-]+:[:a-z_0-9-]+$/i',$link_app.':'.$link_id)){
					if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
						$so_link = CreateObject('phpgwapi.solink');
						$so_link->link('spiclient',$content['client_id'],$link_app,$link_id,$content['contact']['role']);
					}else{
						egw_link::link('spiclient',$content['client_id'],$link_app,$link_id,$content['contact']['role']);
					}

				}
			}
			if(isset($content['contact']['delete'])){
				foreach((array)$content['contact']['delete'] as $link_id => $value){
					if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
						$so_link = CreateObject('phpgwapi.solink');
						$so_link->unlink($link_id);
					}else{
						egw_link::unlink($link_id);
					}

				}
			}

			$id = $content['client_id'] ? $content['client_id'] : $this->data['client_id'];
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
			}
		}
		if(isset($_REQUEST['exec']['link_to']['app']) && isset($content['link_to']['to_id']) && isset($content['client_id'])){
		
			$link_ids = is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']);
			
			foreach(is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']) as $n => $link_app){
				$link_id = $link_ids[$n]['id'];
				$link_app = $link_ids[$n]['app'];
				if (preg_match('/^[a-z_0-9-]+:[:a-z_0-9-]+$/i',$link_app.':'.$link_id)){
					if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
						$so_link = CreateObject('phpgwapi.solink');
						$so_link->link('spiclient',$content['client_id'],$link_app,$link_id);
					}else{
						egw_link::link('spiclient',$content['client_id'],$link_app,$link_id);
					}
					
				}
			}
		}

		if(isset($id)){
			$content=array(
				'msg'         		=> $msg,
				'spiclient'        	=> $spiclient,
				// $this->tabs         => $content[$this->tabs],
				'link_to' => array(
					'to_id' => $id,
					'to_app' => 'spiclient',
				),
			);
			$readonlys=array(
				//'client_tva'	=> true,
			);
			if(empty($id)){
				// Si le user n'a pas le droit d'ajouter des clients on le bloque
				if (!$this->obj_acl->allowAddClient){
					$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
					return;
				}
				
				$content['hideupdate']=true;
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add client');
				$readonlys[$this->tabs]['clients']= true;
				$readonlys[$this->tabs]['prestataires']= true;
				$readonlys[$this->tabs]['link']= true;
				$readonlys[$this->tabs]['history']= true;
				$readonlys[$this->tabs]['contact']= true;
				$readonlys[$this->tabs]['contract']= true;
				$readonlys[$this->tabs]['technique']= true;
				$readonlys[$this->tabs]['address']= true;
				$readonlys[$this->tabs]['checklist']= true;
				// $readonlys['button[apply]'] = true;
				$content['client_tva']=true;
			}else{
				$content+=$this->get_info($id);

				$content['photo'] = $this->photo_src($content['client_id'],$content['client_logo'],'photo');
				
				// Accès uniquement aux clients ou on est vendeur
				if($this->obj_acl->ownAccessClient && $content['client_seller_id'] != $GLOBALS['egw_info']['user']['account_id']){
					$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
					return;
				}
				
				
				$nom = $this->obj_accounts->read($content['account_id']);
				// $readonlys['account_id'] = true;
				
				// On remplit l'onglet client si le client est prestataires (on ne l'affiche pas sinon)
				if($content['client_type'] == $this->obj_config['ProviderType'] || $content['client_type'] == $this->obj_config['SellerType']){
					$content['clients']=$this->get_clients($id);
				}else{
					$readonlys[$this->tabs]['clients'] = true;
				}
				// $content['prestataires'] = $this->get_providers();
				$content['prestataires'] = $this->get_prestataires($id);
				$content['contact'] = $this->get_contact($id);
				$content['contrat'] = $this->get_contrat($id);
				$content['address'] = $this->get_address($id);
				$content['technique'] = $this->get_technique($id);
				$content['checklist'] = $this->get_checklist($id);

				// Lignes vides = On masque
				$content['address']['hideaddress'] = empty($content['address']);
				$content['prestataires']['hideprestataires'] = empty($content['prestataires']);
				$content['contrat']['hidecontract'] = empty($content['contrat']);
				$content['checklist']['hidechecklist'] = empty($content['checklist']);
				$content['clients']['hideclient'] = empty($content['clients']);
				$content['contact']['hidecontact'] = empty($content['contact']);
				$content['technique']['hidetechnique'] = empty($content['technique']);


				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit client').' - '.$content['client_company'];
				$content['technique']['client_id'] = $id;
				$content['address']['client_id'] = $id;
				$content['history'] = array(
					'id'  => $id,
					'app' => 'spiclient',
				);
				// _debug_array($content);
			}
			if(!empty($content['clients'])){
				$modifiable_enSommeil=true;
				foreach((array)$content['clients'] as $id=>$value)
				{
					if($value['selected']==true)
					{
						$modifiable_enSommeil=false;
						break;
					}
				}
				// $content['client_sleep']=0;
				$readonlys['client_sleep']=!$modifiable_enSommeil;
			}
		}

		// $time_end = microtime(true);
  //   	$time = $time_end - $time_start;
  //   	echo "Process Time: {$time}";

		$sel_options = array(
			'payment_model'	=> $this->get_delai_paiement(),
			'account_id'	=> $this->get_add_customer(),
			'client_sector' => $this->get_sectors(),
			'client_parent' => $this->get_possible_parents($id),
			'client_delai_paiement' => $this->get_delai_paiement(),
			'client_mode_reglement' => $this->get_mode_reglement(),
			'client_chalandise' => $this->get_client_chalandise($id),
			'client_region' => $this->get_zone(),

			'contract_supplier'	=> $this->get_contract('contract_supplier'),
			'contract_client'	=> $this->get_contract('contract_client'),
			
			'status_id' => $this->get_status(),
			'type_id' => $this->get_type_contrat(),
			'role' => $this->get_role_active(),
			'nature_id' => $this->get_nature(),
			'client_type' => array('' => lang('Select One')) + $this->get_type_client(),
			'address_type_id' => $this->get_address_type(),
			
			
			//'client' => $this->get_possible_clients($id),
			'fournisseur' => $this->get_possible_prestataires($id),
			//'client_row' => $this->get_possible_clients($id),
			'fournisseur_row' => $this->get_possible_prestataires($id),
			
			'cat_id' => $this->get_spid_cat(),

			'client_country' => array('' => lang('Select One')),
			'client_country_facturation' => array('' => lang('Select One')),
			'add_list' => $this->get_apps($content),
		);

		// $time_end = microtime(true);
  //   	$time = $time_end - $time_start;
  //   	echo "Process Time: {$time}";

		// Cas ou le groupe n'est pas renseigné (si on ne test pas on recuperer le premier compte trouver)
		if($content['account_id'] != 0){
			$sel_options['account_id'] += array($content['account_id'] => $nom['account_lid']);
		}
		
		if(!$GLOBALS['egw_info']['apps']['spid']){
			$readonlys[$this->tabs]['checklist']= true;
		}
		
		$content['contact']['app'] = 'addressbook';
		$content[$this->tabs] = $current_tab;

		// Masque l'ajout de ticket si client en sommeil ou pas d'acces spid pour l'utilisateur courant
		$user_apps = array_keys($GLOBALS['egw_info']['user']['apps']);
		if($content['client_sleep'] || !in_array('spid',$user_apps)){
			$readonlys['button[ticket]'] = true;
		}
		// _debug_array($GLOBALS['egw_info']);
		
		if(!$GLOBALS['egw_info']['user']['apps']['addressbook']){
					$content['msg'] .= lang("Access to adressbook denied, the contacts tab will be empty, please contact your administrator");
		}

		// _debug_array($content);
		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.client.edit');
		$tpl->exec('spiclient.client_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}

	function quick_add($content=null){
	/** 
	 * Fonction d'ajout rapide
	 */
		if($content['button']['cancel']){
			echo "<html><body><script>window.close();</script></body></html>\n";
			$GLOBALS['egw']->common->egw_exit();
			break;
		}

		if($content['button']['save']){
			$text2array = explode("\n", $content['text']);

			$key2field = array(
				'Organisation' 			=> 'client_company',
				'Nom'					=> 'client_last_name',
				'Prénom'				=> 'client_first_name',
				'Téléphone'				=> 'client_tel',
				'Email'					=> 'client_manager_email',
				'Adresse'				=> 'client_adr_one_street',
				'Code Postal'			=> 'client_postalcode',
				'Ville'					=> 'client_locality',
				// 'Segment'				=> '',
				// 'Email du gestionnaire' => 'client_manager_email',
			);

			foreach($text2array as $line){
				foreach($key2field as $key => $field){
					if(strpos($line, $key) === 0 && !$used[$key]){
						$tmp_line = trim(str_replace($key, '', $line));

						$content[$field] = $tmp_line;
						$used[$key] = $line;
					}
				}
			}
			
			$text = $content['text'];
			foreach($used as $used_line){
				$text = str_replace($used_line, '', $text);
			}

			$content['client_comment'] = trim($text);
			$content['client_type'] = $this->obj_config['ProspectType'];
			// $content['msg'] = lang('The client is not yet created, please use Apply or Save to do so.');

			unset($content['text']);
			unset($content['button']);

			$this->edit($content);exit;
		}

		$tpl = CreateObject('etemplate.etemplate', 'spiclient.quick_add');
		$tpl->exec('spiclient.client_ui.quick_add', $content,$sel_options,$readonlys,$content,2);
	}


	function photo(){
	/**
	 * download photo of the given ($_GET['contact_id'] or $_GET['account_id']) contact
	 */
		ob_start();
		$client_id = $_GET['client_id'];

		if (!($client = $this->read($client_id)) || !$client['client_logo'])
		{
			egw::redirect(common::image('spiclient','photo'));
		}
		if (!ob_get_contents())
		{
			header('Content-type: image/jpeg');
			header('Content-length: '.(extension_loaded(mbstring) ? mb_strlen($client['client_logo'],'ascii') : strlen($client['client_logo'])));
			echo $client['client_logo'];
			exit;
		}
	}
	
	function view(){
		/**
		* Affiche un client (en lecture seule)
		*
		* Le contenu à visualiser se fait via $_GET['id'] (une redirection vers l'index se fait si cette variable n'est pas renseignée)
		*/
		// Si le user n'a pas le droit d'acceder au client on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$sel_options = array(
				//'filter'	=> $this->company_billable(),
				'payment_model'	=> $this->get_payment_model(),
				//'client_billable_id'	=> $this->company_billable('Société de facturation'),
				'account_id'	=> $this->get_add_customer(),
				'client_sector' => $this->get_sectors(),
				'client_parent' => $this->get_possible_parents($id),
				'client_delai_paiement' => $this->get_delai_paiement(),
				'client_mode_reglement' => $this->get_mode_reglement(),
				'client_chalandise' => $this->get_all_clients(),
				'client_region' => $this->get_zone(),
				'contract_supplier'	=> $this->get_all_clients(),
				'contract_client'	=> $this->get_all_clients(),
				'status_id' => $this->get_status(),
				'type_id' => $this->get_type_contrat(),
				'role' => $this->get_role(),
				'nature_id' => $this->get_nature(),
				'client_type' => $this->get_type_client(),
			);
			
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			
			$content = $this->get_info($id);
			
			$content['link_to'] = array(
				'to_id' => $id,
				'to_app' => 'spiclient',
			);
			
			// Accès uniquement aux clients ou on est vendeur
			if($this->obj_acl->ownAccessClient && $content['client_seller_id'] != $GLOBALS['egw_info']['user']['account_id']){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
				return;
			}
			
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit client');
			$nom = $this->obj_accounts->read($content['account_id']);
			// Cas ou le groupe n'est pas renseigné (si on ne test pas on recuperer le premier compte trouver)
			if($content['account_id'] != 0){
				$sel_options['account_id'] += array($content['account_id'] => $nom['account_lid']);
			}
			// $readonlys['account_id'] = true;
			
			// On remplit l'onglet client si le client est prestataires (on ne l'affiche pas sinon)
			if($content['client_type'] == $this->obj_config['ProviderType']){
				$content['clients']=$this->get_clients($id);
			}else{
				$readonlys[$this->tabs]['clients'] = true;
			}
			// $content['prestataires'] = $this->get_providers();
			$content['prestataires'] = $this->get_prestataires($id);
			$content['contact'] = $this->get_contact($id);
			$content['contrat'] = $this->get_contrat($id);
			$content['technique'] = $this->get_technique($id);
			$content['checklist'] = $this->get_checklist($id);
			if(empty($content['technique'])){
				$content['technique']['hidetechnique'] = true;
			}
			$content['technique']['client_id'] = $id;
			$content['history'] = array(
				'id'  => $id,
				'app' => 'spiclient',
			);
			
			
			$sel_options += array(
				'filter'	=> $this->company_billable(),
				'client_payment_model'	=> $this->get_payment_model(),
				'client_billable_id'	=> $this->company_billable('Société de facturation'),
				'client_sector' => $this->get_sectors(),
				'client_region' => $this->get_zone(),
			);
		}else{
			$GLOBALS['egw']->redirect_link('/index.php','menuaction=spiclient.client_ui.index');
		}
		$sel_options += array(
			//'filter'	=> $this->company_billable(),
			'payment_model'	=> $this->get_payment_model(),
			//'client_billable_id'	=> $this->company_billable('Société de facturation'),
			'account_id'	=> $this->get_add_customer(),
			'client_sector' => $this->get_sectors(),
			'client_parent' => $this->get_possible_parents($id),
			'client_delai_paiement' => $this->get_delai_paiement(),
			'client_mode_reglement' => $this->get_mode_reglement(),
			'client_chalandise' => $this->get_all_clients(),
			'client_region' => $this->get_zone(),
			
			'contract_supplier'	=> $this->get_all_clients(),
			'contract_client'	=> $this->get_all_clients(),
			'status_id' => $this->get_status(),
			'type_id' => $this->get_type_contrat(),
			'role' => $this->get_role(),
			
			'client_type' => $this->get_type_client(),
			
			'cat_id' => $this->get_spid_cat(),
		);

		$content['hidebuttons']=true;
		
		$content['contact']['no_add']=true;
		$content['checklist']['no_add']=true;
		$content['clients']['no_add']=true;
		$content['prestataires']['no_add']=true;

		$readonlys=array();
		// foreach((array)$content as $id=>$value)
		// {
			// $readonlys[$id]=true;
		// }
		$readonlys['__ALL__'] = true;
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('View client');		
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.client.edit');
		$tpl->exec('spiclient.client_ui.view', $content,$sel_options,$readonlys,$content,2);
	}
	
	function edit_nature($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 idex : 'button' et, au choix save,apply,cancel
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ($_GET['location_parent'] permets d'appliquer un filtre)
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
					$msg = $this->add_update_nature($content);
					echo "<html><body><script>var referer = opener.location;
					opener.location.href = '/index.php?menuaction=spiclient.client_ui.edit&id=".$content['client_id']."';window.close();</script>";
					$GLOBALS['egw']->common->egw_exit();
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id = $this->so_client_nature->data['client_nature_id'];
			
			$content['msg']=$msg;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}

		if(isset($id)){
			$content=array(
				'msg'	=> $msg,
			);
			if(empty($id)){
				$content['client_id'] = $_GET['client_id'];
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add technical nature');	
			}else{
				$content += $this->so_client_nature->read($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit technical nature');	
			}
		}
		
		$sel_options = array(
			'nature_id' => $this->get_nature(),
			'client_id' => $this->get_all_clients(),
		);

		$tpl = CreateObject('etemplate.etemplate', 'spiclient.technique.edit');
		$tpl->exec('spiclient.client_ui.edit_nature', $content,$sel_options,$readonlys,$content,2);
	}
	
	function about(){
	/**
	* Affiche le boite de dialogue 'A propos ...'
	*/
		$content=$sel_options=$readonlys=array();
		$lines=file(EGW_INCLUDE_ROOT.'/spiclient/about/about_fr.txt');
		$content['about']="";
		foreach ($lines as $line_num => $line) {
			$content['about'].=htmlspecialchars($line) . "<br />\n";
		}

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

		$tpl = CreateObject('etemplate.etemplate', 'spiclient.about');
		$tpl->exec('spiclient.client_ui.about', $content,$sel_options,$readonlys,$content,0);
	}
	
	function pdf($references = null,$path = ''){
	/**
	 * Génère le fichier pdf correspondant à l'affaire
	 */
		// ob_start permet de faire une temporisation de sortie (permet d'éviter l'erreur (FPDF error: Some data has already been output, can't send PDF file)
		ob_start();
		if(isset($_GET['id'])){
			$pdf = CreateObject('spiclient.generate_pdf',$_GET['id']);
			$pdf->generate($path,$_GET['header']);
		}	
	}
	
	function edit_relation($content = null){
	/**
	 * Vu d'edition d'un client de l'organisation (onglet client)
	 */
		// Si le user n'a pas le droit d'acceder au client on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
					$msg = $this->add_update_relation($content);
					// _debug_array($content['client_id']);exit;
					echo "<html><body><script>var referer = opener.location;
					opener.location.href = \"/index.php?menuaction=spiclient.client_ui.edit&id=".$content['client_id']."\"; window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id = $this->so_clients_relations->data['client_nature_id'];
			
			$content['msg']=$msg;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}

		if(isset($id)){
			$content=array(
				'msg'	=> $msg,
			);

			$content += $this->so_clients_relations->read($id);
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit client relation');	
			
			// Accès uniquement aux clients ou on est vendeur
			if($this->obj_acl->ownAccessClient && !$this->is_vendor($content['societe_id']) && !$this->is_vendor($content['client_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
				return;
			}
		}
		
		$sel_options = array(
			// 'nature_id' => $this->get_nature(),
			'client_id' => $this->get_all_clients(),
			'societe_id' => $this->get_all_clients(),
			'payment_model'	=> $this->get_delai_paiement(),
		);

		$tpl = CreateObject('etemplate.etemplate', 'spiclient.relation.edit');
		$tpl->exec('spiclient.client_ui.edit_relation', $content,$sel_options,$readonlys,$content,2);
	}
	
	function edit_checklist($content = null){
	/**
	 * Vu d'edition d'un client de l'organisation (onglet client)
	 */
		// Si le user n'a pas le droit d'acceder au client on le bloque
		if (!$this->obj_acl->allowClient){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
			return;
		}
		
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
					$msg = $this->add_update_checklist($content);
					echo "<html><body><script>opener.location.href = '/index.php?menuaction=spiclient.client_ui.edit&id=".$content['client_id']."&msg=".addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
			$id = $this->so_checklist->data['chk_id'];
			
			$content['msg']=$msg;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}

		if(isset($id)){
			$content=array(
				'msg'	=> $msg,
			);

			$content += $this->so_checklist->read($id);
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit client checklist');	
			
			// Accès uniquement aux clients ou on est vendeur
			if($this->obj_acl->ownAccessClient && !$this->is_vendor($content['client_id'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')."</h1>\n",null,true);
				return;
			}
		}
		
		$sel_options = array(
			'client_id' => $this->get_all_clients(),
			'cat_id' => $this->get_spid_cat(),
		);

		$tpl = CreateObject('etemplate.etemplate', 'spiclient.checklist.edit');
		$tpl->exec('spiclient.client_ui.edit_checklist', $content,$sel_options,$readonlys,$content,2);
	}
}

?>
