<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009-> avril 2016
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.spid_bo.inc.php');	
require_once(EGW_INCLUDE_ROOT.'/calendar/inc/class.calendar_bo.inc.php');
//require_once(EGW_INCLUDE_ROOT. '/phpgwapi/inc/xajaxResponse.inc.php');

class spid_ui extends spid_bo 
{
	
	
	var $public_functions = array(
		'index' 		=> True,
		'edit' 			=> True,
		'add' 			=> True,
		'add_invoice'	=> True,
		't_print'		=> True,
		'about'			=> True,
		'add_forfait'	=> True,
		'search'		=> True,
		'home'			=> True,
		//YLF
		'assistant'		=> True,
	);
		
	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*
	* \version BBO - 30/07/2010 - Fichier CSS et JS nécessaire au fonctionnement de spid
	*
	* \version BBO - 02/08/2010 - Variable pour connaitre le niveau de l'utilisateur connecté dans l'application SPID
	*
	* \version BBO - 03/08/2010 - Vérifie si l'utilisateur connecté correspond à un client qui est déclarré en sommeil, si oui on lui bloque l'accès...
	*/
		parent::__construct();
		// spirea - tch - passage à 14.1   ---> voir phpgwapi/inc/class.egw_framework.inc.php
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
		// //Spirea YLF - 28/02/2011 - Modification pour n'avoir le javascript qu'une seule fois
				$javascript .= $this->write_javascript();
		if(strpos($GLOBALS['egw_info']['flags']['java_script_thirst'],$FileNameAJAX) === false){
			$GLOBALS['egw_info']['flags']['java_script_thirst'].=$javascript."\n";
		}
		// $this->obj_js = CreateObject('phpgwapi.javascript');
		
		$acl=false;
		// _debug_array($this->grants);
		foreach($this->grants as $row){
			if(!empty($row)){
				$acl=true;
			}
		}
		if (!$acl){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied, please contact your administrator!!!')." (Spid_ui / ACL)</h1>\n",null,true);
			exit;
		}
			
		if(!isset($GLOBALS['egw_info']['user']['EnSommeil']) || empty($GLOBALS['egw_info']['user']['EnSommeil']))
		{
			$GLOBALS['egw_info']['user']['EnSommeil']=$this->enSommeil();
			if(is_array($GLOBALS['egw_info']['user']['EnSommeil']))
			{
				$onload="Dialog.alert('".$GLOBALS['egw_info']['user']['EnSommeil'][1]."', {
						windowParameters: {	className: 'alphacube' 	},
						okLabel : 'OK', height  : 100, width   : 250,
						title : '".$GLOBALS['egw_info']['user']['EnSommeil'][0]."',
						}
					);";
				$GLOBALS['egw']->js->set_onload($onload);
				$css='<STYLE type="text/css"><!-- #tdSidebox {  display: none;} -->	</STYLE>';
				$GLOBALS['egw_info']['flags']['java_script_thirst'].=$css."\n";
			}
		}
		
		if(!isset($GLOBALS['egw_info']['user']['SpidLevel']))
		{
			$GLOBALS['egw_info']['user']['SpidLevel']=$this->isTechnicianOrManagerOrCustomer();
			// echo $GLOBALS['egw_info']['user']['SpidLevel'];
		}

		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		$this->ClientType = $spiclient_config['ClientType'];
	}
	
	function about(){
	/**
	* Affiche le boite de dialogue 'A propos ...'
	*/
		$content=$sel_options=$readonlys=array();
		$lines=file(EGW_INCLUDE_ROOT.'/spid/about/about_fr.txt');
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
		
		$tpl = new etemplate('spid.about');
		$tpl->exec('spid.spid_ui.about', $content,$sel_options,$readonlys,$content,0);
	}
	
	function write_javascript(){
	/**
	* Initialise le code javascript (tableaux)
	*
	* @return string
	*/
		return '
			<script type="text/javascript">
				function form_reset(form) {
					document.getElementById("exec[nm][cat_id]").value="";
					document.getElementById("exec[nm][filter]").value="";
					document.getElementById("exec[nm][filter2]").value="0";
					document.getElementById("exec[nm][search]").value="";
					document.getElementById("exec[nm][rows][client_id]").value="";
					document.getElementById("exec[nm][rows][ticket_assigned_by]").value="";
					//return false;
				}
			</script>
		';
	}
	
	
	function write_js(){
	/**
	* Retourne le code javascript de méthodes de réponses standard
	*
	* \li message(id) -> messages
	*
	* \li etats(id) -> états
	*
	* \li categories(id) -> catégories
	*
	* \li is_object(obj) -> définit si ce qui est passé en argument est un objet
	*
	* @return string
	*/
		$tab_reponse_js=$this->phparray_jsarray('tab_reponse',$this->get_reponses_standard_message(),true);
		$tab_etat_js=$this->phparray_jsarray('tab_etat',$this->get_etat_fermable(),true);
		$tab_cat_js=$this->phparray_jsarray('tab_cat',$this->get_categorie(),true);
		return '
			//Tableau des messages standard
			'.$tab_reponse_js.'
			//Tableau des etats fermables
			'.$tab_etat_js.'
			//Tableau des categories
			'.$tab_cat_js.'
			
		//Fonction pour les réponses standard
		function message(id){
				var tab_id=id.split("-");
				var  oEditor = FCKeditorAPI.GetInstance("exec[reply_content]");
				
				if(tab_id[0]==0){
					//document.getElementById(\'exec[reply_content]\').innerHTML=\'\';	
					oEditor.SetHTML("");
				}else{
					//document.getElementById(\'exec[reply_content]\').innerHTML=tab_reponse[(tab_id[0]-1)][\'canned_content\'];
					oEditor.SetHTML(tab_reponse[(tab_id[0]-1)][\'canned_content\']);
				}
				if(document.getElementById(\'exec[ticket_closed]\') != null){
					document.getElementById(\'exec[ticket_closed]\').value=tab_id[1];
				}
					document.getElementById(\'exec[transition]\').value=tab_id[2];
				if((tab_id[1]==1)&&(document.getElementById(\'exec[ticket_closed]\') != null)){
					document.getElementById(\'exec[ticket_closed]\').removeAttribute("disabled");
				}
			}
			
		function etats(id){
				alert("ici");
				if(document.getElementById("exec[ticket_closed]") != null){
					var select_OpenClose = document.getElementById("exec[ticket_closed]");
					for(var i in tab_etat){
						if(tab_etat[i][\'state_id\']==id){
							
							select_OpenClose.removeAttribute("disabled");
							break;
						}else{
							select_OpenClose.value=0;
							select_OpenClose.setAttribute("disabled", "disabled");
						}
					
					}
				}
			}
			
		function categories(id){
				var possible=false;
				var valeur_default=0;
				for(var i in tab_cat){
					if(tab_cat[i][\'parent\']>999){
						if(tab_cat[i][\'cat_id\']==id){
							if(tab_cat[i][\'possible_select\']==1){
								possible=true;
							}else{
								var tab_user=tab_cat[i][\'group_user\'].split(",");
								for(j=0;j<tab_user.value;j++){
									if(tab_user[j]==tab_cat[i][\'cat_managementgroup\']){
										possible=true;
									}
								}
							}
							if(possible==false){
								valeur_default=tab_cat[i][\'parent\'];
							}
						}
					}
					if(tab_cat[i][\'parent\']==0){
						if(tab_cat[i][\'cat_id\']==id){
							if(tab_cat[i][\'possible_select\']==1){
								possible=true;
							}else{
								var tab_user=tab_cat[i][\'group_user\'].split(",");
								for(j=0;j<tab_user.value;j++){
									if(tab_user[j]==tab_cat[i][\'cat_managementgroup\']){
										possible=true;
									}
								}
							}
							if(possible==false){
								valeur_default=tab_cat[i][\'parent\'];
							}
						}
					}
				}
				if(possible==false){
					document.getElementById(\'exec[cat_id]\').value=valeur_default;
				}else{
					document.getElementById(\'exec[cat_id]\').value=id;
				}
			}
			
			//Fonction permettant de savoir si la variable passée en paramètre est un objet
			function is_object(obj){
				 return (typeof(obj)!="object")?false:true;
			}
			';
	}
	

	function add_invoice($content=null){
	/**
	* Si $content existe, crée les factures envoyées en argument $content,sinon, mets à jour les factures sélectionnées
	*
	* @param array $content=NULL factures à examiner (envoyées à index())
	*/
		if(!is_array($content)){
			$this->index($content,'facture');
		}else{
			if(is_array($content['nm']['rows']['checked']) && !empty($content['nm']['rows']['checked'])){
				$checked=implode(",",$content['nm']['rows']['checked']);
				$msg=lang('Ticket imported');
				$facture_id=$content['nm']['facture_id'];
				foreach($content['nm']['rows']['checked'] as $id=>$value){
					$ticket['ticket_id']=$value;
					$ticket['facture_id']=$facture_id;
					$this->data = $ticket;
					$this->update($this->data,true);
				}
			}else{
				$checked="";
				$msg=lang('Nobody ticket imported');
			}
			echo "<html><body><script>var referer = opener.location;opener.location.href = referer+'&msg=".
					addslashes(urlencode($msg))."&checked=".addslashes(urlencode($checked))."&id=".$content['nm']['facture_id']."'; window.close();</script></body></html>\n";
			$GLOBALS['egw']->common->egw_exit();
		}
	}
		
	function index($content=null,$save_session='index'){
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter')
	* Un filtre peut aussi être crée avec $_GET['id'],$_GET['client'],$_GET['start'] et $_GET['end']
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de location à supprimer à $content['nm']['rows']['delete']
	*
	* \version BBO - 17/06/2010 - Ajout d'un lien pour voir les tickets fermés non facturés
	*
	* \version BBO - 02/08/2010 - Passage dans le code source, de la déclaration des classes CSS nécessaire au fait qu'elle apparaissent dans différentes couleurs...
	*
	* \version BBO - 03/08/2010 - Si la variable est un tableau alors l'utilisateur connecté est associé à un client inactif....
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	* @param string $save_session='index' identifiant de la session à sauver
	*/
		$msg='';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$facture_id=$_GET['id'];
		}
		if(isset($_GET['client']) && !empty($_GET['client'])){
			$client_id=$_GET['client'];
		}
		if(isset($_GET['start']) && !empty($_GET['start'])){
			$start=$_GET['start'];
		}
		if(isset($_GET['end']) && !empty($_GET['end'])){
			$end=$_GET['end'];
		}
		if(isset($_GET['presta']) && !empty($_GET['presta'])){
			$presta=$_GET['presta'];
		}
		
		// Si c'est vide on recupere le cache (permet de garder les filtres apres validation)
		if(empty($content['nm'])){
			$content['nm'] = $GLOBALS['egw']->session->appsession('index','spid');
		}

		if (!is_array($content['nm']))
		{			
			$default_cols='ticket_num_group,client_id,cat_id,ticket_title,creation_date,due_date,ticket_spend_time,ticket_priority,state_id,ticket_assigned_by,ticket_assigned_to,closed_date,location_id';
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.spid_bo.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> false,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> false,
				'filter_no_lang' 	=> true,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'options-cat_id' 	=> array(lang('none')),
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'ticket_id',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'DESC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'filter_label'   	=>	lang('State'),	// I  label for filter    (optional)
				'filter'         	=>	'',	// =All	// IO filter, if not 'no_filter' => True
				'filter2_label'  	=>	'Select',			// IO filter2, if not 'no_filter2' => True
				'filter2'       	=>	'',			// IO filter2, if not 'no_filter2' => True
				'default_cols'   	=> $this->grants['admin']?'ticket_id,'.$default_cols:$default_cols,
				'columnselection-pref'	=> $this->grants['admin']?'ticket_id,'.$default_cols:$default_cols,
				'filter_onchange' 	=> "this.form.submit();",
				'filter2_onchange' 	=> "this.form.submit();",
				'manual'         => false,	// space for the manual icon
				'no_csv_export'		=> true,
				'csv_fields'		=> false,
				'admin'				=> $this->is_admin(),
				'cat_app'		=> 'spid',
				//Permet d'effectuer un filtre sur l'application en cours
				'app'		=> 'spid',
			);
		} 	
		$readonlys=array();
		
		if(isset($_GET['msg'])){
			$msg=lang($_GET['msg']);
		}
		if(isset($_GET['filter'])){
			$filter=$_GET['filter'];
			unset($content['nm']['col_filter']);
		}
		switch($filter){
			
			case 'reset' :
				$content['nm']['filter2']= '0';
				unset($content['nm']['advanced_search']);
				break;	
				
			case 'viewmyassigned' :
				$content['nm']['filter2']= '4';
				break;
			case 'viewmyopen' :
				$content['nm']['filter2']= '3';
				break;			
			case 'viewall' :
				$content['nm']['filter2']= '0';
				break;				
			case 'viewclosed' :
				$content['nm']['filter2']= '2';	
				break;
			case 'viewnotinvoicing' :
				$content['nm']['filter2']= '5';	
				break;
			case 'viewopen' :
			default :
				$content['nm']['filter2']= '1';	
				break;		
		}
		
		if(!empty($content['view_group'])){
			$content['nm']['col_filter']['account_id']=$content['view_group'];
		}
		if(!empty($content['view_cat'])){
			$content['nm']['col_filter']['cat_id']=$content['view_cat'];
		}

		$content['msg']=$msg;
				
		if (strlen($this->obj_config['TxtIndexParDefaut'])>2 and (strlen($content['msg']) < 2))  {
			$content['msg'] = $this->obj_config['TxtIndexParDefaut'];
		 }
		
		$client_groups = $this->client_groups('WHERE client_id IN (SELECT client_id FROM spid_tickets)','',false);

		// _debug_array($client_groups);
		
		$sel_options = array(
			'filter'=> array(''=>lang('All'))+$this->get_etat(),
			'filter2' => array(
				'0'	=>	'View all tickets',
				'1'	=>	'View open tickets',
				'2'	=>	'View closed tickets',
				'3'	=>	'View my open tickets',
				'4'	=>	'View my assigned tickets',
				'6'	=>	'View open tickets with calendar events',

				'7'	=>	'View open tickets without calendar events',
			),

			'client_id' => $client_groups,
			'ticket_assigned_by_contact' => $this->get_all_demandeur(),			
			'ticket_assigned_to'=> $this->get_intervenant(),
			'location_id'		=> $this->get_all_location(),
		);
		if($this->grants[EGW_ACL_CUSTOM_3]){
			$sel_options['filter2']['5']='View closed tickets not invoicing';
		}
		
		$content['nm']['hideadd']=$this->grants[EGW_ACL_ADD];
		$content['nm']['template']='spid.index.rows';
		$content['nm']['header_right'] = 'spid.index.right';
		$content['nm']['header_left'] = 'spid.index.left';
		
		
		$GLOBALS['egw_info']['flags']['app_header'] = 'SPID Tickets';	

		if(count($client_groups)==1 && !$add_invoice){
			unset($content['nm']['header_left']);
			$content['nm']['col_filter']['client_id']=key($client_groups);
		}
		
		if(count($client_groups)==1){
			$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
		}
		// if(empty($content['nm']['col_filter']['account_id']) && $GLOBALS['egw_info']['user']['account_primary_group']==-206){
			// $content['nm']['col_filter']['account_id']=key($client_groups);
		// }
		
		if(isset($facture_id) && isset($start) && isset($end) && isset($client_id)){
			$add_invoice=true;
			$content['nm']['add_invoice']=true;
			$content['nm']['facture_id']=$facture_id;
			$content['nm']['invoice']['start']=$start;
			$content['nm']['invoice']['end']=$end;
			$content['nm']['invoice']['facture']=$facture_id;
			$content['nm']['invoice']['client_id']=$client_id;
			$content['nm']['view_button'] = true;
			$content['nm']['view_select'] = false;
			$content['nm']['col_filter']['client_id']=$client_id;
			$content['nm']['filter2']=5;
			$content['nm']['col_filter']['ticket_invoice']=false;
			$content['nm']['col_filter']['facture_id']=0;
			$content['nm']['col_filter']['ticket_closed']=true;
			$readonlys['nm']['client_id']=true;
			
			$client = $this->so_client->read($presta);
			$categories = $this->groupeGestionCategorie(array($client['account_id']=>''));
			$content['nm']['col_filter']['cat_id'] = $categories;
			
			unset($content['nm']['header_right']);
			$content['nm']['header_left'] = 'spid.index.left';
		}else{
			$add_invoice=false;
			$content['nm']['add_invoice']=false;
			$content['nm']['view_button'] = false;
			$content['nm']['view_select'] = true;
			unset($content['nm']['invoice']);
			unset($content['nm']['facture_id']);
		}
		
		$content['nm']['nom_session']=$save_session;
		
		$GLOBALS['egw']->session->appsession($save_session,'spid',$content['nm']);
		$tpl = new etemplate('spid.index');
		
		$css='<STYLE type="text/css">
			<!--
				.unseen { background-color: '.$this->obj_preferences['ticket_not_view'].'; }
				.important { background-color: '.$this->obj_preferences['ticket_important'].';}
			-->
		</STYLE>';
		$GLOBALS['egw_info']['flags']['java_script_thirst'].=$css."\n";
		if(is_array($GLOBALS['egw_info']['user']['EnSommeil']))
		{
			unset($content['nm']['header_right']);
		}

		$tpl->exec($add_invoice ? 'spid.spid_ui.add_invoice' : 'spid.spid_ui.index', $content,$sel_options,$readonlys,$content,$add_invoice ? 2 : 0);
	}
	
	
	
	function edit($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 index : 'delete'/identifiant des urls a supprimer
	*
	*							 'button'/'save' ou 'apply' ou 'attach' ou 'cancel' décrivant les opération à faire sur les URLs
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ou $content['ticket_id']
	*
	*
	* \version BBO - 18/06/2010 - MAJ Message d'erreur uniquement dans le cas où l'état est facturable
	* \version BBO - 27/07/2010 - TEST AJAX
	* \version BBO - 29/07/2010 - MAJ 1.091 - Permet d'enregistrer en base que le ticket a été visualisé
	* \version TCH - 31/12/2010 - MAJ 1.092 - Debugs...
	* @param array $content=NULL
	*/
	

	$fileNameJS=$GLOBALS['egw_info']['server']['webserver_url']."/spid/temp/scripts_".$GLOBALS['egw_info']['user']['account_id'].md5($GLOBALS['egw_info']['user']['account_lid']).".js";
			
	if($_SESSION['egw_session']['spid_js'] != '1'){
			$groupeClients=$this->phparray_jsarray('groupeClients',$this->groupeClients(),true);
			$membrerGroupesDuUser=$this->phparray_jsarray('membrerGroupesDuUser',$this->membrerGroupesDuUser(),true);
			$tabDefault=$this->phparray_jsarray('tabDefault',$this->tabDefault(),true);
			$groupesDuUser=$this->phparray_jsarray('groupesDuUser',$this->groupesDuUser(),true);
			$javascript='
				//Tableau des groupeClients
				'.$groupeClients.'
				//Tableau des membrerGroupesDuUser
				'.$membrerGroupesDuUser.'
				//Tableau des tabDefault
				'.$tabDefault.'
				//Tableau des groupesDuUser
				'.$groupesDuUser.'
				//Valeur par défaut;
				
				function ajouterAssigneA(forms,assigne){
					// mise à jour du champs assigne_a
					if(document.getElementById("exec[cat_id]") != null){
						var cat_info=catInfo(document.getElementById("exec[cat_id]").value);
						var cat_managementgroup=cat_info[0]; // ok
						//var cat_assignedto=cat_info[1]; // ok
						var cat_assignedto=assigne; // ok
						var cat_groupUser=cat_info[2];	// ok
						var groupManagement=false;
						for(var g in tabDefault["group_management_value_users"]){
							if(g=='.$this->account_id.'){
								groupManagement=true;
							}
						}
						var myselect=document.getElementById("exec[ticket_assigned_to]");
						// alert("valeur asisgned_to");
						// alert(myselect);
						// myselect=19;
						myselect.options.length=1;
						if(cat_managementgroup==""){
							cat_managementgroup=tabDefault["group_management_id"];
						}
						for(var i in groupeClients[cat_managementgroup]){
							element=groupeClients[cat_managementgroup][i];
							if(i==cat_assignedto){
								nouvel_element = new Option(element,i,false,true);
							}else{
								nouvel_element = new Option(element,i,false,false);
							}
							try{
								myselect.add(nouvel_element,null);
							}catch(e){
								myselect.add(nouvel_element);
							}
						}
						
						if(groupManagement==false){
							if(cat_groupUser==false){
								document.getElementById("exec[ticket_assigned_to]").setAttribute("disabled", "disabled");
							}
						}
						visibleChamp(cat_managementgroup);
					}
				}
				
				function visibleChamp(visibleTemps){
					document.getElementById("exec[ticket_spend_time]").setAttribute("disabled", "disabled");
					if(visibleTemps!=""){
						for(var i in groupesDuUser){
							if(i==visibleTemps){
								document.getElementById("exec[ticket_spend_time]").removeAttribute("disabled");
							}
						}
					}
				}
				
				function ajouterDemandeur(forms) {
					var idGroupe=document.getElementById("exec[account_id]").value;
					var myselect=document.getElementById("exec[ticket_assigned_by]");
					myselect.options.length=1;
					for(var i in groupeClients[idGroupe]){
						element=groupeClients[idGroupe][i];
						if(UnDemandeur(i)==true){
							nouvel_element = new Option(element,i,false,true);
						}else{
							nouvel_element = new Option(element,i,false,false);
						}
						try{
							myselect.add(nouvel_element,null);
						}catch(e){
							myselect.add(nouvel_element);
						}
					}	
				}
				
				function UnDemandeur(i){
					if(tabDefault["demandeur"][i]){
						return true;
					}else{
						return false;
					}
				}
				
				function catInfo(id){
					var info=new Array();
					for(var i in tab_cat){
						if(tab_cat[i]["cat_id"]==id){
							info[0]=tab_cat[i]["cat_managementgroup"];
							info[1]=tab_cat[i]["cat_assignedto"];
							info[2]=false;
							var tab_group_user=tab_cat[i]["group_user"].split(",");
							for(var j=0;j<tab_group_user.length;j++){
								if(tab_group_user[j]==info[0]){
									info[2]=true;
									break;
								}
							}
						}
					}
					// alert(info);
					return info;
				}';
			$fileName = EGW_SERVER_ROOT."/spid/temp/scripts_".$GLOBALS['egw_info']['user']['account_id'].md5($GLOBALS['egw_info']['user']['account_lid']).".js";
			$fp = fopen($fileName,"w");
			fputs($fp,$this->write_js());
			fputs($fp,$javascript);
			fclose($fp);
			
			$_SESSION['egw_session']['spid_js'] = '1';
			
			
		}
	
		//$fileNameJS=$GLOBALS['egw_info']['server']['webserver_url']."/spid/inc/js/scripts_".$GLOBALS['egw_info']['user']['account_id'].".js";
		//$GLOBALS['egw_info']['flags']['java_script_thirst'].=$javascript;
		if(strpos($GLOBALS['egw_info']['flags']['java_script_thirst'],$fileNameJS) === false){
			$GLOBALS['egw_info']['flags']['java_script_thirst'].='<script type="text/javascript" src="'.$fileNameJS.'"></script>';
		}


		
		
		//Spirea YLF - Creation d'un rendez-vous a la volée + ajout dans les liens
		if(isset($content['button']['applycontact']) && !empty($content['button']['applycontact'])){
			if(empty($content['rdvstart'])){
				$msg = lang('Error').' : '.lang('Start date must not be empty');
			}elseif($content['rdvduration'] <= 0){
				$msg = lang('Error').' : '.lang('Start date must be prior to end date');
			}else{
				$finRDV = $this->calculFinRDV($content['rdvduration'],$content['rdvstart']);
				$event = array(
					'participants'=> array(
						$content['rdvInterviewer'] => 'A',
					),
					'participant_types'=>array(
						'u' => array(
							$content['rdvInterviewer'] => 'A',
						)
					),
					'owner' => $GLOBALS['egw_info']['user']['account_id'],
					'start' => $content['rdvstart'],
					'end' => $finRDV,
					'link_to' => array(
						'to_id' => '',
						'to_app' => 'calendar',
						'title' => '',
						'anz_links' => 0,
						'app' => 'spid',
						'query' => '',
						'file' => array(),
						'comment' => 0,
						'id' => '',
						'remark' => '',
						'button' => '',
					),
					'title' => $content['rdvtitle'],
					'location' => $content['rdvlocation'],
					'duration' => $content['rdvduration']*60,
					'description' => $content['rdvdescription'],
					'category' => $content['rdvcategory'],
					'account_id' => $GLOBALS['egw_info']['user']['account_id'],
					'modified' => $_SERVER['REQUEST_TIME'],
					'modifier' => $GLOBALS['egw_info']['user']['account_id'],
				);
				$cal_id = $this->so_calendar->save($event,$recurrence);
				if($cal_id){
					$this->so_calendar->move($cal_id,$event['start'],$event['end']);
					egw_link::link('spid',$content['ticket_id'],'calendar',$cal_id);
					
					$rendez_vous = array(
						'ticket_id' => $content['ticket_id'],
						'account_id' => $content['rdvInterviewer'],
						'cal_id' => $cal_id,
						'creation_date' => $_SERVER['REQUEST_TIME'],
						'createur_id' => $GLOBALS['egw_info']['user']['account_id'],
						
					);
					$this->so_rendez_vous->save($rendez_vous);
				}	
			}
			$id = $content['ticket_id'];
			unset($content['button']['applycontact']);
			$_GET['id'] = $id;
		}
		//Fin YLF
		
		if(isset($content['delete']['url'])){
			list($id) = @each($content['delete']['url']);
			if($this->so_url->delete($content['url'][$id]['url_id'])){
				$msg='Url deleted';
			}
			unset($content['delete']);
		}
		
		// Unlink d'un event => Supprime le lien entre le ticket et l'event mais laisse l'event en base
		if(isset($content['unlink'])){
			foreach($content['unlink'] as $key => $data){
				$link = egw_link::get_link('spid',$content['ticket_id'],'calendar',$content['rdv'][$key]['cal_id']);
				egw_link::unlink($link['link_id']);
				
				$this->so_rendez_vous->delete($content['rdv'][$key]);
			}
		}
		
		// Suppression d'un event, ainsi que du rendez-vous lié et du lien entre l'event et le ticket
		if(isset($content['delete'])){
			foreach($content['delete'] as $key => $data){
				$link = egw_link::get_link('spid',$content['ticket_id'],'calendar',$content['rdv'][$key]['cal_id']);
				egw_link::unlink($link['link_id']);
				
				$this->so_calendar->delete($content['rdv'][$key]['cal_id']); 
				$this->so_rendez_vous->delete($content['rdv'][$key]);
			}
		}

		
		
		
		if(is_array($content)){
			// _debug_array($content);
			// Contrôles avant mise à jour...
			if(empty($content['ticket_title']) or strlen($content['ticket_title'])<=5) {
				$msg=lang('Your title must be at least 6 characters long.');
				unset($content['button']);
			}
			if(empty($content['ticket_assigned_by_contact']) or $content['ticket_assigned_by_contact']==0) {
				$msg=lang('Who is the contact ?');
				unset($content['button']);
			}
			if(!empty($content['client_id'])){
				$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
				if(!in_array($content['ticket_assigned_by_contact'],array_keys($sel_options['ticket_assigned_by_contact']))) {
					$msg=lang('Your contact is not linked to this client...');
					unset($content['button']);
				}
			}
						
			if(empty($content['client_id']) or $content['client_id']==0) {
				$msg=lang('Who is the client ?');
				unset($content['button']);
			}
			if(empty($content['ticket_assigned_to']) or $content['ticket_assigned_to']==0) {
				$msg=lang('You must assign this ticket...');
				unset($content['button']);
			}
			
			if(empty($content['cat_id'])) {
				$msg=lang('You must enter a category...');
				unset($content['button']);
			}

			// Verification du contrat
			$allowedContracts = $this->get_contrats($content['client_id']);
			if(!empty($content['contract_id']) && !in_array($content['contract_id'],array_keys($allowedContracts))){
				$msg = lang('The selected contract is not allowed for this client');
				unset($content['button']);
			}

			// si le case n'est pas breaké, on peut mettre à jour le ticket...
			
			if(isset($content['button']) && !empty($content['button'])){
				list($button) = @each($content['button']);
				switch($button){
					case 'save':
					case 'apply':
						$info_etat=$this->so_etats->read($content['state_id']);
						if(($content['ticket_closed']==1 && (empty($content['ticket_spend_time']) || $content['ticket_spend_time']==0))
						&& $info_etat['state_billable']==1){
							echo '<script type="text/javascript">alert("/!\\\ ATTENTION /!\\\ \n '.lang("You must enter a time to close ticket").'");</script>';
							break;
						}

						$msg=$this->add_update_ticket($content);
						if($button=='save'){
							$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script type=\"text/javascript\">
								var referer = opener.location;
								opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';window.close()</script>";
						}
						if($button=='apply'){
							$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script type=\"text/javascript\">
								var referer = opener.location;
								opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
						}
						$this->envoi_mail($this->data);
						break;
					case 'attach':
						$msg=$this->add_url($content['ticket_id'],$content['url_links'],$content['url_commentaires']);
						$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script type=\"text/javascript\">
								var referer = opener.location;
								opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
						break;
					default:
					case 'cancel':
						echo "<html><body><script type=\"text/javascript\">window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
						break;
				}
				$id=isset($content['ticket_id']) ? $content['ticket_id'] : $this->data['ticket_id'];
			}else{
			// On est pas dans le cas de la mise à jour (affichage des données en modif...)
				$id = isset($content['ticket_id']) ? $content['ticket_id'] : $this->data['ticket_id'];
				if(!isset($content['ticket_id'])){
					$readonlys[$this->tabs]['details']= true;
					$readonlys[$this->tabs]['update']= true;
					$readonlys[$this->tabs]['history']= true;
					$readonlys[$this->tabs]['url']= true;
					$readonlys[$this->tabs]['meeting']= true;
					$readonlys[$this->tabs]['accounting']= true;
					$content['ticket_priority']=5;
					$content['state_id']=$this->obj_config['default_state_id'];
					$content['due_date']=time()+86400*$this->obj_config['deadline_rule'];
					$content['ticket_assigned_by'] = $this->account_id;
					$content['ticket_assigned_to']=$this->userCompteDefaut($content['cat_id']);
				}
				
				// $client_groups=$this->client_groups(null,$this->ClientType);
				
				$sel_options = array(
					'ticket_priority' => $this->sel_priority,
					'state_id'			=> $this->get_initial_state(),
					'client_id'		=> $this->client_groups('',$this->ClientType),
					'ticket_closed' => array( 
						'0' => lang('Open'),
						'1' => lang('Close'),
					),
					'reponse_standard' 	=> $this->get_reponse_standard(), 
					'transition' 		=> $this->get_transition($content['state_id']),
					'location_id'		=> $this->get_location(),
					'unit_time'			=> $this->get_unit_time(),
					'ticket_unit_time'		=> $this->get_unit_time(),
				);
				$content['hideline']=!$this->get_management_categorie($content['cat_id']);
				
				$cats=$this->get_categorie();
				$sel_options['ticket_assigned_to']=array();
				foreach($cats as $cat){
					$sel_options['ticket_assigned_to'][$cat['cat_assignedto']]=$this->obj_accounts->id2name($cat['cat_assignedto']);
				}
				
				if(count($sel_options['account_id'])<=1){
					$content['account_id'] = key($sel_options['account_id']);
					$sel_options['ticket_assigned_by']=$this->obj_accounts->members($content['account_id']);
					$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
					$content['ticket_assigned_by_contact'] = $this->user2addressbook_id($this->account_id);
					
					$content['ticket_assigned_by']=$this->account_id;
				}else{
					$sel_options['ticket_assigned_by']=$this->open_by($sel_options['account_id']);
					$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
				}
			}
			$content['msg']=$msg;
			$content['spid']=$spid;
			$content[$this->tabs]=$content[$this->tabs];
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
			}
		}
		

		if(isset($_REQUEST['exec']['link_to']['app']) && isset($content['link_to']['to_id']) && isset($this->data['ticket_id'])){
			$link_ids = is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']);
			foreach(is_array($content['link_to']['to_id']) ? $content['link_to']['to_id'] : array($content['link_to']['to_id']) as $n => $link_app){
				$link_id = $link_ids[$n]['id'];
				$link_app = $link_ids[$n]['app'];
				if (preg_match('/^[a-z_0-9-]+:[:a-z_0-9-]+$/i',$link_app.':'.$link_id)){
					egw_link::link('spid',$this->data['ticket_id'],$link_app,$link_id);
				}
			}
		}
		// code d'origine - à garder...
		if(isset($_REQUEST['link_app']) && isset($_REQUEST['link_id']) && !is_array($content['link_to']['to_id'])){
			$link_ids = is_array($_REQUEST['link_id']) ? $_REQUEST['link_id'] : array($_REQUEST['link_id']);
			foreach(is_array($_REQUEST['link_app']) ? $_REQUEST['link_app'] : array($_REQUEST['link_app']) as $n => $link_app){
				$link_id = $link_ids[$n];
				if (preg_match('/^[a-z_0-9-]+:[:a-z_0-9-]+$/i',$link_app.':'.$link_id)){
					egw_link::link('spid',$content['link_to']['to_id'],$link_app,$link_id);
				}
			}
		}
		
		if(isset($id)){
			$content=array(
				'msg'         => $msg,
				'spid'        => $spid,
				$this->tabs         => $content[$this->tabs], 
				'link_to' => array(
					'to_id' => $id,
					'to_app' => 'spid',
				),
				'transition'	=>	$content['ticket']['state_id'],
				'hidenotes'		=>	false,
			);
			
			$readonlys=array();
			$sel_options=array();
			$onload="";
			if(empty($id)){
				// Nouveau ticket - on désactive des onglets...
				$GLOBALS['egw_info']['flags']['app_header'] = lang('New ticket');
				$readonlys[$this->tabs]['details']= true;
				$readonlys[$this->tabs]['update']= true;
				$readonlys[$this->tabs]['history']= true;
				$readonlys[$this->tabs]['url']= true;
				$readonlys[$this->tabs]['meeting']= true;
				$readonlys[$this->tabs]['checklist']= true;
				// $readonlys[$this->tabs]['accounting']= true;
				
				// $content['hidecontrat'] = true;

				$content['ticket_priority']=5;
				$content['state_id']=$this->obj_config['default_state_id'];
				$content['due_date']=time()+86400*$this->obj_config['deadline_rule'];
				$content['ticket_assigned_by'] = $this->account_id;
				
				// Spirea-YLF - Modif client/demandeur
				$content['ticket_assigned_by_contact'] = $this->user2addressbook_id($this->account_id);

				$content['ticket_assigned_to']=$this->obj_config['ticket_assigned_to'];
				
				// Masque les lignes utilisé pour l'affichage des tickets existants
				$content['hidebudget'] = true;
				$content['hidephone'] = true;
				$content['hidesite'] = true;
				$content['hideprecision'] = true;
				$content['hidesiteprecision'] = true;
				$content['hidecontrat'] = true;
				$content['hideprivate'] = true;

				$client_groups = $this->client_groups('',$this->ClientType);
				
				if(count($client_groups)<=1){
					$onload.="ajouterDemandeur(document.getElementById('exec[account_id]'));";
					$onload.="document.getElementById('exec[account_id]').setAttribute('disabled', 'disabled');";
					$onload.="document.getElementById('exec[ticket_assigned_to]').setAttribute('disabled', 'disabled');";
				}

				$onload="ajax_request.initialize();";
				//Spirea YLF - 06/05/2011
				switch($this->obj_config['unit_time']){
					case 0: // minutes
						$content['time_spend_label'] = ' ('.lang('min').')';
						break;
					case 1: // heures
						$content['time_spend_label'] = ' ('.lang('h').')';
						break;
					case 2: // jours
						$content['time_spend_label'] = ' ('.lang('d').')';
						break;
				}

				// Spirea-YLF - 23/05/2013 - Création depuis l'extérieur (spiclient) avec l'identifiant du client dans $_GET['client']
				if(!empty($_GET['client'])){
					$content['client_id'] = $_GET['client'];
					$onload .= "var element = document.getElementById('exec[client_id]');
					element.value = ".$_GET['client'].";
					if ('fireEvent' in element)
					    element.fireEvent('onchange');
					else {
					    var evt = document.createEvent('HTMLEvents');
					    evt.initEvent('change', false, true);
					    element.dispatchEvent(evt);
					}";
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
				$content+=$this->get_info($id);

				// $GLOBALS['egw_info']['flags']['java_script_thirst'].='<script type="text/javascript">ajax_request.appelMultiple("client_id","contract_id","ticket_assigned_by_contact","personne","contrat",'.$content['client_id'].');</script>';

				//Spirea YLF - 06/05/2011
				switch($content['ticket_unit_time']){
					case 0: // minutes
						$content['time_spend_label'] = ' ('.lang('min').')';
						break;
					case 1: // heures
						$content['time_spend_label'] = ' ('.lang('h').')';
						break;
					case 2: // jours
						$content['time_spend_label'] = ' ('.lang('d').')';
						break;
				}
				if($content['ticket_closed']==0 && $this->grants['admin'] and $this->grants[EGW_ACL_EDIT]){
					$onload.=" if(document.getElementById('exec[ticket_closed]') != null){document.getElementById('exec[ticket_closed]').setAttribute('disabled', 'disabled');}";
					if(isset($content['state_id']) && $content['state_id']<>''){
						$onload.=" etats(".$content['state_id'].");";
					}
					else
					{
						$onload.=" etats(".$this->obj_config['default_state_id'].");";
					}
					$onload.=" ajouterAssigneA(this,".$content['ticket_assigned_to'].");";
				}
				if($content['ticket_closed']==0 && $this->grants['admin']){
					// $onload=" document.getElementById('exec[ticket_closed]').setAttribute('disabled', 'disabled');";
				}

				$readonlys[$this->tabs]['messages']= true;
				if(!$this->grants[EGW_ACL_EDIT] || $this->grants['admin']) { 
					$readonlys[$this->tabs]['update']= true;
				}
				// note tch - à revoir
				$readonlys[$this->tabs]['update']= false;
				$readonlys[$this->tabs]['messages']= true;
				// note tch - à revoir
				
				if($content['ticket_private']==1){
					$lbl=lang('Yes').' ('.lang('this one can see only by creator, applicant and administrator').')';
				}else{
					$lbl=lang('No').' ('.lang('this one can see by all groups and administrator').')';
				}
				$content['ticket_private_lbl'] = $lbl;

				$content['transition']=$content['state_id'];
				$content['hidenotes']=count($content['reponse'])>=2 ? false : true;
				$content['hidestudent'] = $this->is_formation($content['cat_id']) ? false : true;
				
				// Masquage du budget si vide ou non utilisé
				$content['hidebudget'] = $this->obj_config['budget'] ? empty($content['ticket_budget']) ? true : false : true;
				// Masquage du temps téléphone si vide ou non utilisé
				$content['hidephone'] = true;
				$obj_acl = CreateObject('phpgwapi.acl');
				$allowedApps = array_keys($obj_acl->get_user_applications());
				if(in_array('spitel',$allowedApps)){
					$appels = $this->so_appel->search(array('ticket_id'=>$content['ticket_id']),false);
					if(is_array($appels)){
						$content['hidephone'] = false;
					}
				}
				// Masquage du site et de la précision si les deux sont vides
				$content['hidesite'] = empty($content['location_id']) ? true : false;
				$content['hideprecision'] = empty($content['location_precision']) ? true : false;
				$content['hidesiteprecision'] = $content['hidesite'] && $content['hideprecision'] ? true : false;
				// Masque contrat si vide
				// $content['hidecontrat'] = empty($content['contract_id']) ? true : false;
				// Masque privé si vide
				$content['hideprivate'] = empty($content['ticket_private']) ? true : false;
				
				if($content['facture_id']>0){
					$facture = $this->so_factures->read($content['facture_id']);
					$content['facture_str'] = $facture['facture_number'];
				}else{
					$content['facture_str'] = 'Non facturé';
				}

				$client = $this->so_client->read($content['client_id']);
				$content['client'] = $client['client_id'];

				// $GLOBALS['egw_info']['flags']['app_header'] = lang('Edit ticket');
				$GLOBALS['egw_info']['flags']['app_header'] = lang('SPID').' - '.$client['client_company'].' - '.$content['ticket_title'];

				$client_groups = $this->client_groups('','',false);

				$readonlys[$this->tabs]['accounting'] = !$this->obj_config['accounting_tab'];
			}
			$onload.="Dialog.okCallback()";
			$GLOBALS['egw']->js->set_onload($onload);		

			// Spirea-YLF - Affiche 'Select one' ou '-' si le ticket est fermé
			$select = array('' => '-');
			if(!$content['ticket_closed']){
				$select = array('' => lang('Select One'));
			}
			
			$sel_options = array(
				'ticket_priority' 		=> $this->sel_priority,
				'state_id'				=> $this->get_initial_state(),
				'account_id'			=> $client_groups,
				'client_id'			=> $client_groups,
				'prestataire'		=> $this->client_groups('','',false),
				'ticket_closed' 		=> array( 
					'0' => lang('Open'),
					'1' => lang('Closed'),
				),
				'reponse_standard' 		=> $select + $this->get_reponse_standard(), 
				'transition' 			=> $this->get_transition($content['state_id']),
				'location_id'			=> $this->get_location(),
				'ticket_unit_time'		=> $this->get_unit_time(),
				'checklist' 			=> $this->get_checklist($content['client_id'],$content['cat_id']),
			);
			
			// Masque l'onglet checklist lorsqu'il n'y a pas de valeur possible
			if(empty($sel_options['checklist'])){
				$readonlys[$this->tabs]['checklist']= true;
			}
			
			$sel_options['rdvcategory'] = $this->get_cal_cat();
			
			$content['hideline']=!$this->get_management_categorie($content['cat_id']);
			// $readonlys[$this->tabs]['meeting'] = $content['hideline'];
			if($content['ticket_closed']){
				$readonlys[$this->tabs]['update']= !$this->is_admin();
				$readonlys['cat_id'] = true;
				$readonlys['ticket_assigned_to'] = true;
				$readonlys['ticket_priority'] = true;
				$readonlys['ticket_spend_time'] = true;
				$readonlys['due_date'] = true;
				$readonlys['ticket_closed'] = true;
				$readonlys['reponse_standard'] = true;
				
				$readonlys['location_id'] = true;
				$readonlys['location_precision'] = true;
				$readonlys['ticket_budget'] = true;
				
				$readonlys['contract_id'] = true;
				$readonlys['ticket_unit_time'] = true;
				
				//tch $readonlys[$this->tabs]['links']=	$content['ticket_closed'];
				//tch $readonlys[$this->tabs]['url']=	$content['ticket_closed'];
				$content['hidebuttons'] = !$this->is_admin();
				$content['dateclosed']=true;
			}
		}		
		

		
		if(!empty($content['ticket_id'])){
			// Spirea-YLF - 26/07/2012 - Ajout de && ... (test sur l'appartenance de l'utilisateur au client
			// if(!$this->verification_ticket($content['ticket_id']) && !in_array($GLOBALS['egw_info']['user']['person_id'],array_keys($this->get_demandeur($content['client_id'])))){
			// if(!$this->verification_ticket($content['ticket_id'])){
			// TCH / modifs du 14/05 !!
			// Vérifications à faire :
			// Si l'utilisateur courant n'est pas gestionnaire de la catégorie
			// S'il n'est pas membre du client, alors on le sort...
			
			$GestionnaireCategorie =  $this->GestionnaireCategorie();
				// if(in_array($content['cat_id'],$GestionnaireCategorie)){
				// return true;
			// }
			
			// verification_categorieGestionnaire($cat_id,$client_groups)
			
			// if(!$this->verification_ticket_cat_groupe($content['ticket_id'],$content['client_id'],$content['cat_id'])){
			if(!in_array($content['cat_id'],$GestionnaireCategorie) && !in_array($GLOBALS['egw_info']['user']['person_id'],array_keys($this->get_demandeur($content['client_id']))) && !$GLOBALS['egw_info']['user']['SpidLevel'] == 1000) {
					$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied!!!')."</h1>\n",null,true);
					return;
			}
		}

		// Vérification que le ticket concerne l'intervenant si l'option de restriction est cochée dans l'admin (ie. si SpidLevel = 1)
		// dans ce cas, si le ticket n'est pas créé, assigné à ou par ou s'il n'y a pas de rv sur l'intervenant, alors l'accès est rejeté
		if($GLOBALS['egw_info']['user']['SpidLevel'] == 1) {

		$verif['ticket_assigned_to']=$content['ticket_assigned_to'];
		$verif['ticket_assigned_by']=$content['ticket_assigned_by'];
		$verif['creator_id']=$content['creator_id'];
		$verif['rv']=$content['rdv'][1]['account_id'];
		foreach ($content['rdv'] as $rv) {
			$j++;
			$verif['rv'.$j]=$rv['account_id'];
			}

			if(!in_array($this->account_id,$verif)){
					$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied!!!')." - ".lang('This ticket is not your business')."</h1>\n",null,true);
					return;
				}
		}

		// SPIREA-YLF -- Signature par défaut
		$content['reply_content'] = $this->signatureDefault();
		
		
		//YLF
		if(!isset($content['ticket_id']) && $this->obj_config['budget']){
			$content['budget_add'] = $this->obj_config['budget'];
		}
		if($this->obj_config['budget']){
			$content['budget_mod'] = 1;
		}
		
		if($this->obj_config['contracts'] && !isset($content['ticket_id'])){
			$content['contract_add'] = 1;
			}
		if($this->obj_config['contracts'] && isset($content['ticket_id'])){
			unset($content['contract_add']);
			$content['contract_mod'] = 1;
		}	
		
		// Client : on desactive les budget, contrats etc...
		if($content['hideline']){
			unset($content['budget_mod']);
			unset($content['contract_mod']);
			$content['hidestudent'] = true;
			// Masque l'ajout de lien pour un client
			$content['hidelink'] = true;
			$readonlys[$this->tabs]['meeting']= true;
		}

		$cats=$this->get_categorie();
		$sel_options['ticket_assigned_to']=array();
		foreach($cats as $cat){
			if(isset($cat['cat_managementgroup']) && !empty($cat['cat_managementgroup'])){
				$cat_managementgroup=$this->obj_accounts->members($cat['cat_managementgroup'],true);
				foreach($cat_managementgroup as $cle=>$account_id){
					$user = $this->obj_accounts->read($account_id);
					if(!empty($user['account_status']) && !$this->obj_accounts->is_expired($user)){
						$sel_options['ticket_assigned_to'][$account_id]=$this->obj_accounts->id2name($account_id);
					}
				}
			}
			
			$user = $this->obj_accounts->read($cat['cat_assignedto']);
			if(!empty($user['account_status']) && !$this->obj_accounts->is_expired($user)){
				$sel_options['ticket_assigned_to'][$cat['cat_assignedto']]=$this->obj_accounts->id2name($cat['cat_assignedto']);
			}
		}
		
		natcasesort($sel_options['ticket_assigned_to']);
		
		
		if(count($sel_options['client_id'])<=1){
			$content['client_id']=key($sel_options['client_id']);
			// Spirea-YLF - Modif client/demandeur
			// $sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
			$content['ticket_assigned_by_contact'] = $this->user2addressbook_id($this->account_id);
			
		}else{
			// Spirea-YLF - Modif client/demandeur
			$sel_options['ticket_assigned_by_contact'] = $this->get_all_demandeur();
			
			$sel_options['ticket_assigned_by'] = $this->open_by($sel_options['account_id']);
		}

		// Spirea-YLF / 2014 / Contact du client seulement
		if(!empty($content['client_id']))
			$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);

		$select = array('' => '-');
		if(!$content['ticket_closed']){
			$select = array('' => lang('Select One'));
		}
		$sel_options['contract_id'] = $select + $this->get_contrats($content['client_id']);
		$sel_options['ticket_site'] = $select + $this->get_site();
		// $sel_options['contract_id'] = $this->get_contrats('');

		// Masque contrat si la liste de choix est vide
		if(empty($sel_options['contract_id'])) {
				unset($content['contract_mod']);
		}
		
		$content['ticket_unit_time'] = empty($content['ticket_unit_time']) ? $this->obj_config['unit_time'] : $content['ticket_unit_time'];
		
		$ticket_view=$this->so_tickets_view->search(array('ticket_id'=>$content['ticket_id'],'account_id'=>$this->account_id));
		if(!is_array($ticket_view))
		{
			$data_ticket_view=array
			(
				'ticket_id'		=> $content['ticket_id'],
				'account_id'	=> $this->account_id,
				'time'			=> time(),
			);
			$this->so_tickets_view->data=$data_ticket_view;
			$this->so_tickets_view->save();
		}
		
		// Spirea-YLF - Masque le bouton imprimer si le ticket est en cours de creation
		$readonlys['button[print]'] = !$content['ticket_id'];
		$content['hide_private'] = $content['ticket_id'] || $this->obj_config['private'] == true ? true : false;
		
		//Spirea YLF - 04/03/2011 - Désactivation de la liste state_id si l'user n'est pas admin
		if(!$this->grants['admin']){
			$readonlys['state_id'] =true;
		}

		// Spirea-YLF - 20/09/2013
		$content['hide_presta'] = $this->obj_config['synchro_presta'] ? false : true;
		
		//$content['hideline']=0;
		//_debug_array($content);
   
		
		$tpl = new etemplate('spid.edit');
		$tpl->exec('spid.spid_ui.edit', $content,$sel_options,$readonlys,$content,2);
		// echo '<script type="text/javascript">ajax_request.LoadingInProgress();</script>';
	}
	
	function t_print($content=null){
	/**
	* Affiche les informations d'un ticket en lecture seule dans un popup et permet l'impression. L'identifiant du ticket nous interessant peut être passé par $_GET['id']
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		if(isset($_GET['id'])){
			$id=$_GET['id'];
		}else{
			$id="";
		}
		if(isset($id)){
			$content=array(
				'hidenotes'		=>	false,
			);

		$readonlys=array();
		$sel_options=array();
		$content+=$this->get_info($id);
		$content['hidenotes']=count($content['reponse'])>=2 ? false : true;
		$client_groups = $this->client_groups('WHERE client_id IN (SELECT client_id FROM spid_tickets)','',false);

		$sel_options = array(
			'ticket_priority' => $this->sel_priority,
			'ticket_closed' => array( 
				'0' => lang('Open'),
				'1' => lang('Closed'),
			),
			'client_id' => $client_groups,
			'location_id'		=> $this->get_all_location(),
			'checklist' 		=> $this->get_checklist($content['client_id'],$content['cat_id']),
		);
		
		$checklists = $this->so_spid_checklist->search(array('ticket_id' => $content['ticket_id']),false);
		foreach($checklists as $checklist){
			$liste[$checklist['chk_id']] = $checklist['chk_id'];
		}
		$content['checklist'] = implode(',',$liste);
		
		if($content['ticket_private']==1){
			$lbl=lang('Yes').' ('.lang('this one can see only by creator, applicant and administrator').')';
		}else{
			$lbl=lang('No').' ('.lang('this one can see by all groups and administrator').')';
		}
		$content['ticket_private_lbl'] = $lbl;
		//_debug_array($content);
		
		$tpl = new etemplate('spid.print');
		$tpl->exec('spid.spid_ui.t_print', $content,$sel_options,$readonlys,$content,2);
		}
	}
	
	function add_forfait(){
	/**
	*  Crée un ticket pour le client $_GET['client'] datant de $_GET['date']. Les autres valeurs pour ce ticket sont les valeurs par défaut (mais initialisées dans cette routine)
	*
	* NOTE : return $msg; ne sert  à rien cat on passe dans un exit() avant dans tous les cas ...
	*
	* \version BBO - 17/03/2010 - Va permettre de créer un ticket au forfait
	*
	* @return string
	*/
		if(isset($_GET['client'])){
			$client=$_GET['client'];
		}else{
			return false;
		}
		if(isset($_GET['date'])){
			$date=$_GET['date'];
		}else{
			return false;
		}
		$cats = CreateObject('phpgwapi.categories',$this->account_id,'spid');
		//$userduGroupes=$this->obj_accounts->members($client);
		$assigned_by_contact=$this->get_demandeur($client);
		// _debug_array($assigned_by_contact);
		
		$ticketForfait['cat_id']=$cats->name2id('Réseau');
		$ticketForfait['client_id']=$client;
		$ticketForfait['state_id']=22;
		$ticketForfait['creator_id']=$this->obj_config['ticket_assigned_to'];
		$ticketForfait['ticket_title']='Forfait '.lang(date('F',$date)).' '.date('Y',$date);
		$ticketForfait['ticket_priority']='5';
		$ticketForfait['ticket_assigned_to']=$this->obj_config['ticket_assigned_to'];
		$ticketForfait['ticket_assigned_by']=key($userduGroupes);
		$ticketForfait['ticket_assigned_by_contact']=key($assigned_by_contact);
		$ticketForfait['ticket_spend_time']=1;
		$ticketForfait['creation_date']=($date-86400);
		$ticketForfait['change_date']=($date-86400);
		$ticketForfait['closed_date']=($date-86400);
		$ticketForfait['due_date']=($date-86400);
		$ticketForfait['ticket_closed']=1;
		$ticketForfait['ticket_private']=0;
		
		$msg=$this->add_update_ticket($ticketForfait);
		$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script type=\"text/javascript\">
			var referer = this.location;
			this.location.href = '".$GLOBALS['egw_info']['server']['webserver_url']."/index.php?menuaction=spid.spid_ui.edit&id=".$this->data['ticket_id']."';</script>";
		echo $GLOBALS['egw_info']['flags']['java_script_thirst'];
		//exit;
		return $msg;
	}
	
	function search($_content=array()){
	/**
	* Recherche $_content si défini et affiche le résultat ($_content est recherché en comparaison avec lec colonnes actuellement affichées. La recherche est 'intelligente')
	* Sinon, affiche tous les tickets concernant l'utilisateur courant
	*
	* @param array $_content=array()
	* @return bool
	*/
	
		$GLOBALS['egw_info']['flags']['java_script_thirst'].=$this->search_write_js();
		if(!empty($_content)) {
			$_content['sel_words']='exact';
			$response = new xajaxResponse();

			$query = $GLOBALS['egw']->session->appsession('index','spid');

			$query['advanced_search'] = array_intersect_key($_content,array_flip(array_merge($this->db_data_cols,array('ticket_id','operator','meth_select','sel_words','words','sel_date','startdate','enddate','state_id','client_id'))));
			foreach ($query['advanced_search'] as $key => $value)
			{
				if(!$value) unset($query['advanced_search'][$key]);
			}
			$query['start'] = 0;
			$query['search'] = '';
			// store the index state in the session
			$GLOBALS['egw']->session->appsession('index','spid',$query);

			// store the advanced search in the session to call it again
			$GLOBALS['egw']->session->appsession('advanced_search','spid',$query['advanced_search']);
			
			$response->addScript("
				var link = opener.location.href;
				link = link.replace(/#/,'');
				opener.location.href=link.replace(/\#/,'');
				xajax_eT_wrapper();
			");
			 return $response->getXML();
				exit;
		}
		else {
			
		}
		
		$GLOBALS['egw_info']['flags']['include_xajax'] = true;
		$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script>window.focus()</script>";
		$GLOBALS['egw_info']['etemplate']['advanced_search'] = true;
		
			
		// initialize etemplate arrays
		$sel_options = $readonlys = $preserv = array();
		$content = $GLOBALS['egw']->session->appsession('advanced_search','spid');

		$sel_options['operator'] =  array(
			'OR' => 'OR',
			'AND' => 'AND',
		);
		$sel_options['meth_select'] = array(
			'%'		=> lang('contains'),
			false	=> lang('exact'),
		);
		$client_groups=$this->client_groups('WHERE client_id IN (SELECT client_id FROM spid_tickets)','',false);
		$sel_options['state_id'] = $this->get_etat();
		$sel_options['client_id'] = $client_groups;
		$sel_options['location_id'] = $this->get_location();
		$sel_options['sel_date'] = array(
			'creation_date'		=> lang('Creation Date'),
			'change_date'		=> lang('Last update'),
			'closed_date'		=> lang('Close date'),
			'due_date'			=> lang('Due date'),
		);
		$sel_options['sel_words'] = array(
			//'all'		=> lang('All of the words'),
			//'one'		=> lang('At least one of the words'),
			'exact'		=> lang('The exact phrase'),
			//'none'		=> lang('None of the words'),
		);
		$content['hideline']= !$this->grants['admin'];
		
		$tpl = new etemplate('spid.search');
		return $tpl->exec('spid.spid_ui.search', $content,$sel_options,$readonlys,$preserv,2);
	}
	
	function search_write_js(){
	/**
	* Génère le code javascript pour faire une recherche
	*
	* @return string
	*/
		$javascript='
		<script type="text/javascript">
		function reset_form(form){
			document.getElementById("exec[ticket_id]").value="";
			document.getElementById("exec[ticket_num_group]").value="";
			document.getElementById("exec[cat_id]").value="";
			document.getElementById("exec[account_id]").value="";
			document.getElementById("exec[location_id]").value="";
			document.getElementById("exec[sel_date]").value="";
			document.getElementById("exec[startdate][str]").value="";
			document.getElementById("exec[enddate][str]").value="";
			document.getElementById("exec[ticket_title]").value="";
			document.getElementById("exec[words]").value="";
			document.getElementById("exec[operator]").value="";
			document.getElementById("exec[meth_select]").value="";
			document.getElementById("exec[state_id]").value="";
			//On réinitialise pour les tickets ouverts
			opener.document.getElementById("exec[nm][search]").value="";
			opener.document.getElementById("exec[nm][filter2]").value=0;
		}
		</script>
		';
		return $javascript;
	}
	
	/*
	* Spirea-BBO - 07/09/2010 - Va permettre d'afficher les 10 derniers tickets sur la page d'accueil
	* 
	*/
	function home(){
	/**
	* Génère le code HTML de la page des tickets concernant l'utilisateur courant
	*
	* @return string
	*/
		$html="";
		$limiteDesTicketsARecuperer=10;
		$clients=$this->client_groups();
		$recherche=array(
			'account_id'	=> array_keys($clients),
			0	=> 'ticket_closed=0',
		);
		$recherche[]='(ticket_private=0 OR (ticket_private=1 and ('.$this->spid_tickets.'.creator_id='.$this->account_id.' or ticket_assigned_to='.$this->account_id.' or ticket_assigned_by='.$this->account_id.')))';
		$id_only='ticket_id,ticket_num_group,account_id,ticket_assigned_by,creation_date,ticket_title,ticket_priority';
		$order='ticket_id DESC';
		$wildcard='';
		$op='AND';
		$start=array(0,$limiteDesTicketsARecuperer);

		$rows = parent::search($recherche,$id_only,$order,'',$wildcard,false,$op,$start,null,'');

		if(!$rows){
			$rows = array();
		}
		
		echo "\n".'<STYLE type="text/css">
			<!--
				.unseen {
					background-color: '.$this->obj_preferences['ticket_not_view'].';
				}
				
				.important {
					background-color: '.$this->obj_preferences['ticket_important'].';
				}
			-->
		</STYLE>'."\n";
		
		$html='<table width="100%" border="0" cellpadding="1" cellspacing="1">'."\n";
		$html.='<tr>'."\n";
		if($GLOBALS['egw_info']['user']['SpidLevel']>0)
		{
			$html.='<th>ID Général</th>'."\n";
		}
		$html.='<th>Ticket #</th>'."\n";
		$html.='<th>Ouvert par</th>'."\n";
		$html.='<th>Assigné par</th>'."\n";
		$html.='<th>Date d\'ouverture</th>'."\n";
		$html.='<th>Objet</th>'."\n";
		$html.='</tr>'."\n";
		foreach($rows as $id=>$value)
		{
			$class='';
			if($value['ticket_priority']==10)
			{
				$class='important';
			}
			else
			{
				$ticket_view=$this->so_tickets_view->search(array('ticket_id'=>$value['ticket_id'],'account_id'=>$this->account_id));
				if(!is_array($ticket_view))
				{
					$class='unseen';
				}
			}
			$html.='<tr class="'.$class.'">'."\n";
			if($GLOBALS['egw_info']['user']['SpidLevel']>0)
			{
				$html.='<td align="center">'.$value['ticket_id'].'</td>'."\n";
			}
			$html.='<td align="center">'.$value['ticket_num_group'].'</td>'."\n";
			$html.='<td align="center">'.$clients[$value['account_id']].'</td>'."\n";
			$html.='<td align="center">'.$GLOBALS['egw']->accounts->id2name($value['ticket_assigned_by']).'</td>'."\n";
			$html.='<td align="center">'.date('d/m/Y',$value['creation_date']).'</td>'."\n";
			$html.='<td align="center">'.$value['ticket_title'].'</td>'."\n";
			$html.='</tr>'."\n";
		}
		$html.='</table>'."\n";
		return $html;
	}

	function assistant($content=null){
	/**
	* Vue assistant de création de ticket
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
	
		if(is_array($content)){
			// TCH - ce sont les mêmes contrôles que pour la fonction edit... cela vaudrait peut être la peine de faire une fonction unique...
			// Contrôles avant mise à jour...
			if(empty($content['ticket_title']) or strlen($content['ticket_title'])<=5) {
				$msg = "Your title must be at least 6 character's long.";
				// unset($content['button']);
			}
			if(empty($content['ticket_assigned_by_contact']) or $content['ticket_assigned_by_contact']==0) {
				$msg = "Who is the contact ?";
				// unset($content['button']);
			}
			if(!empty($content['client_id'])){
				$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
				// _debug_array($sel_options['ticket_assigned_by_contact']);
				if(!in_array($content['ticket_assigned_by_contact'],array_keys($sel_options['ticket_assigned_by_contact']))) {
					$msg="Your contact is not linked to this client...";
					// unset($content['button']);
				}
			}			
			if(empty($content['client_id']) or $content['client_id']==0) {
				$msg = "Who is the client ?";
				// unset($content['button']);
			}
			if(empty($content['ticket_assigned_to']) or $content['ticket_assigned_to']==0) {
				$msg = "You must assign this ticket...";
				// unset($content['button']);
			}
			
			if(empty($content['cat_id'])) {
				$msg = "You must enter a category...";
				// unset($content['button']);
			}
			// si le case n'est pas breaké, on peut mettre à jour le ticket...
			
			
		
			if(isset($content['button']) && !empty($content['button'])){
				list($button) = @each($content['button']);
				switch($button){
					case 'save':
					case 'apply':
						$data = $content;
						$data['option'] = $_REQUEST['option'];

						$msg=$this->traitementAssistant($data);
						if($button=='save'){
							$GLOBALS['egw_info']['flags']['java_script_thirst'] .= "<script type=\"text/javascript\">
								var referer = opener.location;
								opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';window.close()</script>";
						}
						break;
				}
			}

		}else{
			// $content = $this->getCalendar($content['month']);
			
			$content['due_date']=time()+86400;
			$content['cat_meeting'] = $this->obj_config['default_cat'];
			$content['ticket_unit_time'] = empty($content['ticket_unit_time']) ? $this->obj_config['unit_time'] : $content['ticket_unit_time'];
			if($this->obj_config['budget']){
				$content['budget_add'] = $this->obj_config['budget'];
			}
		}

		if(isset($content['button']['calendar'])){
			if(empty($content['users'])){
				$users = $this->get_users();
			}else{
				$users =  array($content['users'] => '');
			}
			
			$content = array_merge($content,$this->getCalendar($content['month'],$content['nb_month'],$users));

			for($i = 0;$i < 6;$i++){
				if($i+1 > $content['nb_month']){
					$content['hide'.$i] = true;
				}else{
					$content['hide'.$i] = false;
				}
			}
		}else{
			for($i = 0;$i < 6;$i++){
				$content['hide'.$i] = true;
			}
		}
		unset($content['button']);

		$content['msg']=$msg;

		$content['frame_top'] = '<table class="border_cal">';
		$content['frame_bottom'] = '</table>';

		$content['users'] = empty($content['users']) ? $GLOBALS['egw_info']['user']['account_id'] : $content['users'];

		$client_groups = $this->client_groups(null,$this->var_technicienCategorie);
		$sel_options = array( 
			'ticket_priority' => $this->sel_priority,
			'state_id'			=> $this->get_initial_state(),
			// Spirea-YLF - Modif client/demandeur
			'client_id'		=> $client_groups,
			'account_id'		=> $client_groups,
			'ticket_closed' => array( 
				'0' => lang('Open'),
				'1' => lang('Close'),
			),
			'reponse_standard' 	=> $this->get_reponse_standard(), 
			'transition' 		=> $this->get_transition($content['state_id']),
			'location_id'		=> $this->get_location(),
			'ticket_unit_time'	=> $this->get_unit_time(),
			'cat_meeting'		=> $this->get_cal_cat(),

			'month'				=> $this->get_month(),

			'users'				=> array('' => lang('All')) + $this->get_users(),
		);
		$sel_options['ticket_assigned_to']= $this->get_assigned_to();
		
		if(count($sel_options['client_id'])<=1){
			$content['account_id'] = key($sel_options['account_id']);
			$sel_options['ticket_assigned_by']=$this->obj_accounts->members($content['account_id']);
			
			// Spirea-YLF - Modif client/demandeur
			$sel_options['ticket_assigned_by_contact'] = $this->get_demandeur($content['client_id']);
			$content['ticket_assigned_by_contact'] = $this->user2addressbook_id($this->account_id);
			
			$content['ticket_assigned_by']=$this->account_id;
		}else{
			// Spirea-YLF - Modif client/demandeur
			$sel_options['ticket_assigned_by_contact'] = $this->get_all_demandeur();
			
			$sel_options['ticket_assigned_by']=$this->open_by($sel_options['account_id']);
		}

		$readonlys = array();
		$readonlys['button[apply]'] = true;
		
		$tpl = new etemplate('spid.assistant');
		$tpl->exec('spid.spid_ui.assistant', $content,$sel_options,$readonlys,$content,2);
	}
}
?>
