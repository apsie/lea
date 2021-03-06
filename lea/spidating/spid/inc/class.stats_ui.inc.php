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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.stats_bo.inc.php');	
// require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.admin_bo.inc.php');	


class stats_ui extends stats_bo
{
	var $public_functions = array(
		'index' 	=> true,
		'edit' 		=> true,
		'view' 		=> true,
		
		//Spirea YLF - Fonctions de stats
		'stats_intervenant' => true,
		'stats_caclient' => true,
		'stats_caintervenant' => true,
		'stats_ticket_intervenant' => true,
		'stats_group' => true,
		'stats_contrat' => true,
		'suivi_activite' => true,

		'accounting_export' => true,
		'create_accounting_export' => true,
		'show_accounting_export' => true,
	);
	
	var $sel_societe=array();

	function __construct(){
	/**
	*Méthode appelée directement par le constructeur. Charge les variables globales
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

		$this->prefs =& $GLOBALS['egw_info']['user']['preferences']['spid'];
		$this->obj_js = CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
		$this->sel_societe=$this->get_societe();
	}
	
	function stats_ui(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function write_js(){
	/**
	*NOTE : Une super fonction qui sert ... à rien
	*/
		return "";
	}
	
	function index($content=null){
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates.
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de location à supprimer à $content['nm']['rows']['delete']
	*
	* NOTE : contrairement aux autres index() des autres classes, celle-ci n'exécute rien ... étrange
	*
	* @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		// if empty, or not an  array, then you have to do the initializing on your own.
		if (!is_array($content['nm']))
		{
			$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
				'get_rows'       	=>	'spid.stats_ui.get_rows',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
				'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
				'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
				'no_cat'         	=> false,
				'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
				'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
				'lettersearch'   	=> false,
				'no_filter'			=> false,
				'filter_label'		=> lang('Providers'),
				'no_filter2'		=> true,
				'options-cat_id'	=> array(lang('none')),
				'start'          	=>	0,			// IO position in list
				'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
				'search'         	=>	'',// IO search pattern
				'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
				'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
				'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
				'default_cols'   	=> false,
				'no_csv_export'		=> false,
				'csv_fields'		=> $this->export(),
				'no_columnselection'=> true,
				'cat_app'		=> 'spid',
				//Permet d'effectuer un filtre sur l'application en cours
				'app'		=> 'spid',
				//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
			);
		}		
		
		$sel_options = array(
			// 'client_id'	=>	$this->client_groups,
			'client_id'	=>	$this->get_societe(),
			'filter' => array('' => lang('All')) + $this->get_providers(),
		);

		$content['nm']['template']='spid.stats.index.rows';
		$content['nm']['header_left'] = 'spid.stats.index.left';
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
		$content['nm']['start_date']=mktime(0,0,0,1,1,date("Y"));
		$content['nm']['end_date']=mktime(23,59,59,date("m"),date("d")+1,date("Y"));
		$content['nm']['cat_app']='spid';
		
		$content['help'] = $this->obj_config['stat_help'];
		
		$tpl = new etemplate('spid.stats.index');
		
		$tpl->exec('spid.stats_ui.index', $content,$sel_options,$no_button, $content);
	}

	function get_rows(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats. Retourne le nombre de colonnes, et mets à jour toutes les stats
	 * 
	 * @param array &$query tableau contant les clefs 'start', 'search', 'order', 'sort', 'col_filter'. 
	 * Pour utiliser d'autres clefs comme 'filter', 'cat_id' vous devez définir une classe fille
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 * @return int
	 */	
		$temp_query = $query;
		
		$criteria=array();
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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

		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id=$query['cat_id'];
			$criteria['cat_id']=$query['cat_id'];
		}
		
		$creation_before='creation_date < '.$query['start_date'] ;
		$creation_date='creation_date BETWEEN '.$query['start_date'].' AND '.$query['end_date'] ;
		$closed_date='closed_date BETWEEN '.$query['start_date'].' AND '.$query['end_date'] ;
		$open_end_date='(closed_date IS NULL or closed_date > '.$query['end_date'].' or closed_date=0) and creation_date < '.$query['end_date'];
		
		if(isset($query['col_filter']['client_id']) && !empty($query['col_filter']['client_id']))
		{
			// $search['account_id']=$query['col_filter']['client_id'];
			$search['client_id']=(int)$query['col_filter']['client_id'];
			unset($query['col_filter']['client_id']);
		}

		$clients = $this->search($search,$id_only,$order,'','',false,$op,array(0,999999),$query['col_filter']);
		
		if(!$clients){
			$clients = array();
		}
		// YLF - Définition du caractère de remplissage pour les données vides ('-' en vue normal et '0' pour un export csv)
		$empty = '-';
		if(isset($query['csv_export']) && $query['csv_export']){
			$empty = 0;
		}
		
		if(!empty($clients)){
			$nb_before_total=0;
			$nb_open_total=0;
			$nb_closed_total=0;
			$nb_period_total=0;
			$time_open_total=0;
			$time_close_total=0;
			$montant_total = 0;
			$total_outstanding = 0;
			$i = 0;
			
			foreach($clients as $id=>$value){
				$montant = 0;
				
				// Filtre sur le prestataire
				if(!empty($query['filter'])){
					$categories = spid_bo::groupeGestionCategorie(array($query['filter']=>''));
					if(!empty($categories)){
						$col_filter['cat_id'] = $categories;
						$criteria['cat_id'] = $categories;
					}else{
						$col_filter['cat_id'] = 0;
						$criteria['cat_id'] = 0;
					}
				}
				
				$r_end = $query['end_date']+86599;
				$join = 'WHERE (closed_date >= '.$query['start_date'].' AND closed_date <= '.$r_end.')';
				
				$tickets_closed = $this->so_ticket->search(array('cat_id'=>$criteria['cat_id'],'client_id'=>$value['client_id']),false,'','','',False,'AND',false,$col_filter,$join);
				
				
				if (is_array($tickets_closed)) {
					foreach($tickets_closed as $key => $data){
						$tickets_details = $this->so_factures_details->search(array('ticket_id'=>$data['ticket_id']),false);
						$montant += $tickets_details[0]['total_ht'];
						$montant_total += $tickets_details[0]['total_ht'];
					}
				}
				$criteria['client_id']=$value['client_id'];

				$nb_before = $this->nb_open_start($criteria,$query['start_date']);
				$nb_open = $this->nb_open_during($criteria,$query['start_date'],$query['end_date']);
				$nb_closed = $this->nb_close_during($criteria,$query['start_date'],$query['end_date']);
				$nb_period = $this->nb_open_end($criteria,$query['start_date'],$query['end_date']);
				
				$time_open = $this->time_open($criteria,$query['start_date'],$query['end_date']);
				$time_close = $this->time_close($criteria,$query['start_date'],$query['end_date']);
				$time_not_factured = $this->time_not_factured($criteria,$query['start_date'],$query['end_date']);

				$time_close_hour = $this->convertir_temps($time_close,$this->obj_config['stat_unit_time'],1);
				$time_not_factured_hour = $this->convertir_temps($time_not_factured,$this->obj_config['stat_unit_time'],1);
				
				$before=$open=$closed=$period=array();
				$before[0]['nb_before']=!empty($nb_before) ? $nb_before : $empty;
				$open[0]['time_open']=!empty($time_open) ? $time_open : $empty;
				$open[0]['nb_open']=!empty($nb_open) ? $nb_open : $empty;
				$closed[0]['time_closed']=!empty($time_close) ? $time_close : $empty;
				$closed[0]['nb_closed']=!empty($nb_closed) ? $nb_closed : $empty;
				$period[0]['nb_period']=!empty($nb_period) ? $nb_period : $empty;
				
				
				$nb_before_total +=(int)$before[0]['nb_before'];
				$nb_open_total +=(int)$open[0]['nb_open'];
				$nb_closed_total +=(int)$closed[0]['nb_closed'];
				$nb_period_total +=(int)$period[0]['nb_period'];
				$time_open_total += $open[0]['time_open'];
				$time_close_total += $closed[0]['time_closed'];
				
				$time_not_factured_total += $time_not_factured;
			
				$temp_rows[$i]['client_company'] = $value['client_company'];
				$temp_rows[$i]+=$before[0];
				$temp_rows[$i]+=$open[0];
				$temp_rows[$i]+=$closed[0];
				$temp_rows[$i]+=$period[0];
				$temp_rows[$i]['total'] += $montant;
				$temp_rows[$i]['time_open']=$temp_rows[$id]['time_open'];//." h";
				$temp_rows[$i]['time_closed']=$temp_rows[$id]['time_closed'];//." h";
				
				$temp_rows[$i]['time_not_factured']= $time_not_factured == 0 ? $empty : $time_not_factured;//." h";
				$temp_rows[$i]['average_turnover'] = $time_close_hour!=0 ? round($temp_rows[$id]['total'] / $time_close_hour,2) : $empty;
				$temp_rows[$i]['outstanding'] = number_format($temp_rows[$id]['average_turnover'] * $time_not_factured_hour,2);
				$total_outstanding += $temp_rows[$i]['outstanding'];
				
				$temp_rows[$i]['total_time'] = $time_open+$time_close+$time_not_factured == 0 ? $empty : $time_open+$time_close+$time_not_factured;
				
				$nb_total=$time_open+$time_close;
				if($nb_total>0){
					$percent_open=($time_open/$nb_total)*100;
					$percent_closed=($time_close/$nb_total)*100;
				}else{
					$percent_open = '-';
					$percent_closed = '-';
				}

				++$i;
			}
			$criteria=null;
			if(count($this->client_groups)==1){
				$criteria=key($this->client_groups);
			}else{
				if(isset($query['col_filter']['client_id']) && !empty($query['col_filter']['client_id'])){
					$criteria = $this->id2account($query['col_filter']['client_id']);
				}else{
					$criteria=array();
					foreach($this->client_groups as $cle=>$valeur){
						if(!empty($cle)){
							$criteria[]=$cle;
						}
					}
				}
			}

			$nb_before=$nb_before_total;
			$nb_open=$nb_open_total;
			$nb_closed=$nb_closed_total;
			$nb_period=$nb_period_total;
			$time_open=$time_open_total;
			$time_close=$time_close_total;

			$before=$open=$closed=$period=array();
			$before[0]['nb_before']=!empty($nb_before) ? $nb_before : $empty;
			$open[0]['time_open']=!empty($time_open) ? $time_open : $empty;
			$open[0]['nb_open']=!empty($nb_open) ? $nb_open : $empty;
			$closed[0]['time_closed']=!empty($time_close) ? $time_close : $empty;
			$closed[0]['nb_closed']=!empty($nb_closed) ? $nb_closed : $empty;
			$period[0]['nb_period']=!empty($nb_period) ? $nb_period : $empty;
			$nb_total=$time_open+$time_close;
			if($nb_total>0){
				$percent_open=($time_open/$nb_total)*100;
				$percent_closed=($time_close/$nb_total)*100;
			}else{
				$percent_open=0;
				$percent_closed=0;
			}

			
			
			$miseEnForme=array();
			$miseEnForme['client_company']='Total';
			$miseEnForme['nb_before']=$before[0]['nb_before'];
			$miseEnForme['nb_open']= $open[0]['nb_open'];
			$miseEnForme['nb_closed']= $closed[0]['nb_closed'];
			$miseEnForme['nb_period']= $period[0]['nb_period'];
			$miseEnForme['time_open']= $open[0]['time_open'];
			$miseEnForme['time_closed']= $closed[0]['time_closed'];
			$miseEnForme['time_not_factured']= $time_not_factured_total;
			$miseEnForme['total_time'] = $miseEnForme['time_open']+$miseEnForme['time_closed']+$miseEnForme['time_not_factured'];//." h";
			$miseEnForme['total'] = $montant_total == 0 ? $empty : $montant_total;
			$miseEnForme['outstanding'] = $total_outstanding;
			$miseEnForme['average_turnover'] = round($miseEnForme['total'] / $this->convertir_temps($miseEnForme['time_closed'],$this->obj_config['stat_unit_time'],1),1); // moyenne : total CA / total temps fermé ramené à l'heure
			$miseEnForme['percent_total_time'] = $empty;
			$miseEnForme['percent_turnover'] = $empty;
					
			
			$rows = array();
			foreach($temp_rows as $id => $value){
				$temp_rows[$id]['percent_total_time'] = round(($temp_rows[$id]['total_time']/$miseEnForme['total_time']) * 100,2) == 0 ? $empty : round(($temp_rows[$id]['total_time']/$miseEnForme['total_time']) * 100,2)." %";
				$temp_rows[$id]['percent_turnover'] = round(($temp_rows[$id]['total']/$miseEnForme['total']) * 100,2) == 0 ? $empty : round(($temp_rows[$id]['total']/$miseEnForme['total']) * 100,2)." %";
				$temp_rows[$id]['total'] = $temp_rows[$id]['total']==0 ? $empty : $temp_rows[$id]['total'];
				$temp_rows[$id]['outstanding'] = $temp_rows[$id]['outstanding']==0 ? $empty : $temp_rows[$id]['outstanding'];
				
				// Formatage des données pour les rendre plus lisible
				$temp_rows[$id]['time_open'] = $temp_rows[$id]['time_open'] == $empty ? $empty : number_format($temp_rows[$id]['time_open'],2);
				$temp_rows[$id]['time_closed'] = $temp_rows[$id]['time_closed'] == $empty ? $empty : number_format($temp_rows[$id]['time_closed'],2);
				$temp_rows[$id]['time_not_factured'] = $temp_rows[$id]['time_not_factured'] == $empty ? $empty : number_format($temp_rows[$id]['time_not_factured'],2);
				$temp_rows[$id]['total_time'] = $temp_rows[$id]['total_time'] == $empty ? $empty : number_format($temp_rows[$id]['total_time'],2);
				$temp_rows[$id]['total'] = $temp_rows[$id]['total'] == $empty ? $empty : number_format($temp_rows[$id]['total'],2);
				
				// Ajout des lignes avec des données uniquement
				if($this->verif_ligne($temp_rows[$id],array('client_company'))){
					$rows[] = $temp_rows[$id];
				}
			}
			
			$miseEnForme['time_open'] = number_format($miseEnForme['time_open'],2);
			$miseEnForme['time_closed'] = number_format($miseEnForme['time_closed'],2);
			$miseEnForme['time_not_factured'] = number_format($miseEnForme['time_not_factured'],2);
			$miseEnForme['total_time'] = number_format($miseEnForme['total_time'],2);
			$miseEnForme['total'] = number_format($miseEnForme['total'],2);
			$miseEnForme['outstanding'] = number_format($miseEnForme['outstanding'],2);
			$miseEnForme['class'] = 'total';
			
			$this->ajouter_ligne($rows);
			$rows[]=$miseEnForme;			
		}
		$order = $query['order'];
		
		switch($this->obj_config['stat_unit_time']){
			case 0: // minutes
				$rows['time'] = '('.lang('min').')';
				break;
			case 1: // heures
				$rows['time'] = '('.lang('h').')';
				break;
			case 2: // jours
				$rows['time'] = '('.lang('d').')';
				break;
		}
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistics')." ".lang('between')." ".date("d/m/Y",$query['start_date'])." ".lang('and')." ".date("d/m/Y",$query['end_date']);
		if($query['search']){
			$GLOBALS['egw_info']['flags']['app_header'] .= ' - '.lang("Search for '%1'",$query['search']);
		}

		$query = $temp_query;
		
		
		
		return $this->total;	
    }
	
	
	function stats_intervenant($content=null){
	/**
	 * Fonction permettant l'affichage des stats par intervenant
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			if(isset($content['nm']['rows']['delete'])){
				list($id) = @each($content['nm']['rows']['delete']);
				if($this->delete($id)){
					$msg='Location deleted';
				}
				unset($content['nm']['rows']['delete']);
			}
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=> 'spid.stats_ui.get_rows_intervenant',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> true,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> false,
					'filter_label'		=> lang('Providers'),
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_id',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('intervenant'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
				);
			}		
			if(empty($content['nm']['filter']) || $content['nm']['filter']==0){
				
			}else{
				unset($content['nm']['col_filter']);
			}
			$content['msg']=$msg;
			
			
			$sel_options = array(
				'client_id'	=>	$this->client_groups,
				'filter' => array('' => lang('All')) + $this->get_providers(),
			);
			$content['nm']['template']='spid.stats.spi_intervenant.rows';
			$content['nm']['header_left'] = 'spid.stats.index.left';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic intervenant');	
			$content['nm']['start_date']=mktime(0,0,0,1,1,date("Y"));
			$content['nm']['end_date']=mktime(23,59,59,date("m"),date("d")+1,date("Y"));
			$tpl = new etemplate('spid.stats.spi_intervenant');

			$tpl->exec('spid.stats_ui.spi_intervenant',$content,$sel_options,$no_button,$content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.stats_intervenant</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_intervenant(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats par intervenant. Retourne le nombre de colonnes, et mets à jour toutes les stats
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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

		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		
		/*** Récupération des intervenants ***/
		$closed_date='closed_date BETWEEN '.$query['start_date'].' AND '.$query['end_date'] ;
		$intervenant = $this->get_intervenant($query['start_date'],$query['end_date']);
		$rows_intervenant = array();
		foreach($intervenant as $key => $id_intervenant){
			if($id_intervenant != 0){
				// Filtre sur le prestataire
				if(!empty($query['filter'])){
					$categories = spid_bo::groupeGestionCategorie(array($query['filter']=>''));
					if(!empty($categories)){
						$col_filter['cat_id'] = $categories;
					}else{
						$col_filter['cat_id'] = 0;
					}
				}
				
				$rows_intervenant[$id_intervenant] = $this->so_ticket->search(array('ticket_assigned_to'=>$id_intervenant),$id_only,'','','',False,'AND',false,$col_filter,'');
			}
		}
		
		// YLF - Définition du caractère de remplissage pour les données vides ('-' en vue normal et '0' pour un export csv)
		$empty = '-';
		if(isset($query['csv_export']) && $query['csv_export']){
			$empty = 0;
		}

		// Construction des stats / Parcours des intervenants
		$rows = array();
		if(!empty($rows_intervenant)){
			foreach($rows_intervenant as $id_intervenant => $data){
				$ligne['nb_open'] = 0;
				$ligne['nb_closed'] = 0;
				$ligne['time_open'] = 0;
				$ligne['time_closed'] = 0;
				$ligne['time_total'] = 0;
				$ligne['facturation'] = 0;
				$ligne['ratio'] = 0;
				foreach($data as $key => $value){
					
					 // _debug_array($key['ticket_spend_time']);
					// echo $key['ticket_unit_time'];
					
					$data[$key]['ticket_spend_time'] = $this->convertir_temps($value['ticket_spend_time'],$value['ticket_unit_time'],$this->obj_config['stat_unit_time']);
					if($value['ticket_closed'] == 0){ 
						$ligne['nb_open']++;
						$ligne['time_open'] += $data[$key]['ticket_spend_time'];
						$details = $this->so_factures_details->search(array('ticket_id'=>$value['ticket_id']),$id_only);
						$ligne['facturation'] += $details[0]['total_ht'];
						$ligne['time_total'] += $data[$key]['ticket_spend_time'];
					}
					if($value['closed_date'] >= $query['start_date'] && $value['closed_date'] <= $query['end_date']){
						$ligne['nb_closed']++;
						$ligne['time_closed'] += $data[$key]['ticket_spend_time'];
						$details = $this->so_factures_details->search(array('ticket_id'=>$value['ticket_id']),$id_only);
						$ligne['facturation'] += $details[0]['total_ht'];
						$ligne['time_total'] += $data[$key]['ticket_spend_time'];
					}
				}
				$ligne['intervenant'] = $GLOBALS['egw']->accounts->id2name($id_intervenant,'account_fullname');
				$ligne['time_open'] = round($ligne['time_open']);
				$ligne['time_closed'] = round($ligne['time_closed']);
				$ligne['time_total'] = round($ligne['time_total']);
				$ligne['ratio'] = $this->get_ratio($ligne['time_total'],$query['start_date'],$query['end_date']);
				$intervenant = $this->so_intervenant->search(array('intervenant_id'=>$id_intervenant),false);
				$ligne['obj_ratio'] = $intervenant[0]['intervenant_obj_ratio'] != null ? $intervenant[0]['intervenant_obj_ratio']." %" : '-';
				$ligne['obj_turnover'] = $intervenant[0]['intervenant_obj_ca'] != null ? $intervenant[0]['intervenant_obj_ca'] : '-';

				if($this->verif_ligne($ligne,array('intervenant'))){
					$rows[] = $ligne;
				}
			}
		}
		
		/*** Calcul des totaux ***/
		$nb_intervenant = 0;
		foreach($rows as $id => $value){
			$nb_open_total += $rows[$id]['nb_open'];
			$nb_closed_total += $rows[$id]['nb_closed'];
			$total_time_open += $rows[$id]['time_open'];
			$total_time_closed += $rows[$id]['time_closed'];
			$total_time += $rows[$id]['time_total'];
			$facturation += $rows[$id]['facturation'];
			$nb_intervenant = $rows[$id]['time_total'] > 0 ? $nb_intervenant+1 : $nb_intervenant;
		}
		$ligne = array(
			'nb_open' => $nb_open_total,
			'nb_closed' => $nb_closed_total,
			'time_open' => $total_time_open,
			'time_closed' => $total_time_closed,
			'time_total' => $total_time,
			'facturation' => $facturation,
			'obj_turnover' => '-',
			'ratio' => $this->get_ratio($total_time,$query['start_date'],$query['end_date'],$nb_intervenant),
			'obj_ratio' => '-',
			'intervenant' => 'Total',
		);
		uasort($rows, array('stats_ui','cmp'));
		$this->ajouter_ligne($rows);
		$rows[] = $ligne;
		if(!$rows){
			$rows = array();
		}
		
		switch($this->obj_config['stat_unit_time']){
			case 0: // minutes
				$rows['time'] = '('.lang('min').')';
				break;
			case 1: // heures
				$rows['time'] = '('.lang('h').')';
				break;
			case 2: // jours
				$rows['time'] = '('.lang('d').')';
				break;
		}
		
		return sizeof($rows);
	}
	
	
	function cmp($a, $b){
	/**
	 * Fonction appelé par uasort() pour faire le tri alphabétique du tableau
	 *
	 * @param $a, $b deux élément d'un tableau
	 */
		return strcmp(strtolower($a['intervenant']), strtolower($b['intervenant']));
	}
	
	
	function get_ratio($time, $start, $end, $nb_intervenant=1){
	/**
	 * Fonction de calcul du ratio
	 *
	 * @param $time => le temps travailler
	 * @param $start => date de début pour calculer le temps max
	 * @param $end => date de fin pour calculer le temps max
	 *
	 * @return String 
	 */
		$total_travaillable = 8*$this->nbDiffJour($start, $end);
		$temps_travaille = $this->convertir_temps($time,$this->obj_config['stat_unit_time'],1);
		$ratio = 100 * $temps_travaille/$total_travaillable;
		return round($ratio / $nb_intervenant,2).' %';
	}
	
	function nbDiffJour($start, $end){
	/**
	 * Calcul le nombre de jour décart entre deux timestamp
	 *
	 * @param $start date de début
	 * @param $end date de fin
	 *
	 * @return int
	 */
		//Définition des date au format jour-mois-année
		$date1 = date("d-m-Y",$start);
		$date2 = date("d-m-Y",$end);
		//Extraction des données
		list($jour1, $mois1, $annee1) = explode('-', $date1); 
		list($jour2, $mois2, $annee2) = explode('-', $date2);
		//Calcul des timestamp
		$timestamp1 = mktime(0,0,0,$mois1,$jour1,$annee1); 
		$timestamp2 = mktime(0,0,0,$mois2,$jour2,$annee2); 
		$nbDiffJour=abs($timestamp2 - $timestamp1)/86400;
		return round($nbDiffJour);
	}
	
	function stats_caclient($content=null){
	/**
	 * Fonction permettant l'affichage des stats de ca par client
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			if(isset($content['nm']['rows']['delete'])){
				list($id) = @each($content['nm']['rows']['delete']);
				if($this->delete($id)){
					$msg='Location deleted';
				}
				unset($content['nm']['rows']['delete']);
			}
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_caclient',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> true,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> false,
					'filter_label'		=> lang('Providers'),
					'no_filter2'		=> false,
					'filter2_label'		=> lang('Tickets only'),
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('ca_client'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
				);
			}		
			if(empty($content['nm']['filter']) || $content['nm']['filter']==0){
				
			}else{
				unset($content['nm']['col_filter']);
			}
			$content['msg']=$msg;
			
			
			$sel_options = array(
				'client_id'	=>	$this->client_groups,
				'filter' => array('' => lang('All')) + $this->get_providers('client_id'),
				'filter2' => array('0' => lang('All'),'1' => lang('Tickets only'), '2' => lang('Custom lines only')), 
			);
			if(count($this->client_groups)==1){
				$content['nm']['col_filter']['account_id']=key($this->client_groups);				
				$no_button['client_id']=true;
				$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
			}else{
				foreach($this->client_groups as $id=>$value){
					if(!empty($id)){
						$content['nm']['col_filter']['account_id'][]=$id;
					}
				}
			}
			$content['nm']['template']='spid.stats.spi_caclient.rows';
			$content['nm']['header_left'] = 'spid.stats.index.year';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			$content['nm']['year']=date("Y")+1;
			$tpl = new etemplate('spid.stats.spi_caclient');
			
			$tpl->exec('spid.stats_ui.stats_caclient', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.stats_caclient</h1>\n",null,true);
			return;
		}
	}
	
	
	function get_rows_caclient(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats de ca par client. Retourne le nombre de lignes
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
		
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';

		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		
		$first_of_month = $this->get_month_date($query['year']-1);
		
		if(isset($query['col_filter']['client_id']) && !empty($query['col_filter']['client_id']))
		{
			$query['col_filter']['client_id']=$query['col_filter']['client_id'];
			unset($query['col_filter']['client_id']);
		}
		
		// Récupération et parcours des clients 
		$company = $this->so_client->search('',$id_only,$order);
		if(!empty($company)){
			$total = array();
			$total['january']=$total['february']=$total['march']=$total['april']=$total['may']=$total['june']=$total['july']=$total['august']=$total['september']=$total['october']=$total['november']=$total['december']=0;
			$total['total'] = 0;
			$total['client_company'] = 'Total';
			foreach($company as $id_company => $value_company){
				$ligne = array();
				$ligne['january']=$ligne['february']=$ligne['march']=$ligne['april']=$ligne['may']=$ligne['june']=$ligne['july']=$ligne['august']=$ligne['september']=$ligne['october']=$ligne['november']=$ligne['december']=0;
				$ligne['total'] = 0;
				$ligne['client_company'] = $value_company['client_company'];
				// Récupération et traitements des factures pour le client en cours
				for($i=0;$i < sizeof($first_of_month)-1;++$i){
					$closed_date='WHERE send_date BETWEEN '.$first_of_month[$i].' AND '.$first_of_month[$i+1];
					$factures = $this->so_factures->search(array('societe_id' => $query['filter'],'client_id' => $value_company['client_id']),false,'','','',false,'AND',false,null,$closed_date);

					$month['start'] = $first_of_month[$i];
					$month['end'] = $first_of_month[$i+1];
					$month['number'] = $i;
					// traitement facture si des fatures existent pour le client et la période...
					if(!empty($factures)){
						$this->traitement_factures($query['filter2'],$month,$factures,$ligne,$total);
					}
				}
				if($ligne['total'] > 0){
					$rows[] = $ligne;
				}
			}
			$this->ajouter_ligne($rows);
			foreach($total as $key => $data){
				if($data == '0')
					$total[$key] = '-';
			}
			$rows[] = $total;
		}
		
		// Calcul des totaux et pourcentage
		foreach($rows as $id => $value){
			if($value['total'] != ''){
				$rows[$id]['percent'] = round(100 * $value['total'] / $total['total']).' %';
			}
			if($id == sizeof($rows)-1){
				$rows[$id]['percent'] = '';
				foreach($value as $month => $value_month){
					if(($month != 'total')&&($month != 'client_company')){
						$rows[$id+1][$month] = round(100 * $value_month / $total['total']).' %';
					}else{
						$rows[$id+1][$month] = '';
					}
				}
			}
		}
		if($total['total'] == 0){
			unset($rows);
		}
		return sizeof($rows);
	}
	
	function get_month_date($year){
	/**
	 * Fonction permettant d'avoir les timestamps des 1er de chaque mois de l'année passé en paramètre
	 *
	 * @param $year année à traiter
	 *
	 * @return array
	 */
		$dates = array();
		for($i=1;$i<=12;$i++){
			$dates[] = mktime(0,0,0,$i,1,$year);
		}
		$dates[] = mktime(0,0,0,1,1,$year+1);
		return $dates;
	}
	
	function ajouter_ligne(&$rows){
	/**
	 * Fonction permettant d'ajouter une ligne vide dans $rows (utilisé dans les fonctions get_rows afin de faire la mise en page)
	 */
		foreach($rows[0] as $id => $value){
			$empty_row[$id] = '';
		}
		$rows[] = $empty_row;
	}

	
	function stats_caintervenant($content=null){
	/**
	 * Fonction permettant l'affichage des stats de ca par intervenant
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			if(isset($content['nm']['rows']['delete'])){
				list($id) = @each($content['nm']['rows']['delete']);
				if($this->delete($id)){
					$msg='Location deleted';
				}
				unset($content['nm']['rows']['delete']);
			}
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_caintervenant',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> true,
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('ca_intervenant'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
				);
			}		
			
			$content['msg']=$msg;
			
			
			$sel_options = array(
				'client_id'	=>	$this->client_groups,
			);
			if(count($this->client_groups)==1){
				$content['nm']['col_filter']['account_id']=key($this->client_groups);				
				$no_button['client_id']=true;
				$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
			}else{
				foreach($this->client_groups as $id=>$value){
					if(!empty($id)){
						$content['nm']['col_filter']['account_id'][]=$id;
					}
				}
			}
			$content['nm']['template']='spid.stats.spi_caintervenant.rows';
			$content['nm']['header_left'] = 'spid.stats.index.year';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			$content['nm']['year']=date("Y")+1;
			$tpl = new etemplate('spid.stats.spi_caintervenant');
			
			$tpl->exec('spid.stats_ui.stats_caintervenant', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.stats_caintervenant</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_caintervenant(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats de ca par intervenant. Retourne le nombre de lignes
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';
		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		
		$first_of_month = $this->get_month_date($query['year']-1);
		
		if(isset($query['col_filter']['client_id']) && !empty($query['col_filter']['client_id']))
		{
			$search['account_id']=$query['col_filter']['client_id'];
			unset($query['col_filter']['client_id']);
		}
		
		// Récupération et parcours des intervenants
		$intervenant = $this->get_intervenant($first_of_month[0],$first_of_month[sizeof($first_of_month)-1]);
		if(!empty($intervenant)){
			$total = array();
			$total['january']=$total['february']=$total['march']=$total['april']=$total['may']=$total['june']=$total['july']=$total['august']=$total['september']=$total['october']=$total['november']=$total['december']=0;
			$total['total'] = 0;
			$total['intervenant'] = 'Total';
			foreach($intervenant as $key => $id_intervenant){
				$ligne = array();
				$ligne['january']=$ligne['february']=$ligne['march']=$ligne['april']=$ligne['may']=$ligne['june']=$ligne['july']=$ligne['august']=$ligne['september']=$ligne['october']=$ligne['november']=$ligne['december']=0;
				$ligne['total'] = 0;
				$ligne['intervenant'] = $GLOBALS['egw']->accounts->id2name($id_intervenant,'account_fullname');
				// Récupération et traitement des tickets pour l'intervenant en cours 
				for($i=0;$i < sizeof($first_of_month)-1;++$i){
					$closed_date='closed_date BETWEEN '.$first_of_month[$i].' AND '.$first_of_month[$i+1];
					$tickets = $this->so_ticket->search(array('ticket_assigned_to'=>$id_intervenant,'ticket_closed'=>1),false,'','','',false,'AND',false,$closed_date);
					$month['start'] = $first_of_month[$i];
					$month['end'] = $first_of_month[$i+1];
					$month['number'] = $i;
					// appel de traitement_tickets s'il y a des tickets pour l'intervenants sur la période
					if(!empty($tickets)){
						$this->traitement_tickets($month,$tickets,$ligne,$total);
						}
				}
				if($ligne['total'] > 0){
					$rows[] = $ligne;
				}
			}
			uasort($rows, array('stats_ui','cmp'));
			$this->ajouter_ligne($rows);
			foreach($total as $key => $data){
			if($data == '0')
				$total[$key] = '-';
			}	
			$rows[] = $total;
		}
		
		// Calcul des totaux et pourcentages
		foreach($rows as $id => $value){
			if($value['total'] != ''){
				$rows[$id]['percent'] = round(100 * $value['total'] / $total['total']).' %';
			}
			if($id == sizeof($rows)-1){
				$rows[$id]['percent'] = '';
				foreach($value as $month => $value_month){
					if(($month != 'total')&&($month != 'intervenant')){
						$rows[$id+1][$month] = round(100 * $value_month / $total['total']).' %';
					}else{
						$rows[$id+1][$month] = '';
					}
				}
			}
		}
		if($total['total'] == 0){
			unset($rows);
		}
		return sizeof($rows);
	}
	
	function get_intervenant($start, $end){
	/**
	 * Fonction permettant de récuperer les intervenants qui ont effectué au moins un ticket durant la période choisie
	 *
	 * @param $start date de début de la période à traiter
	 * @param $end date de fin de la période à traiter
	 *
	 * @return array
	 */
		$intervenant = array();
		$join='WHERE closed_date BETWEEN '.$start.' AND '.$end.' OR ticket_closed = 0';
		$rows_intervenant = $this->so_ticket->search('',false,'','','',False,'AND',false,null,$join);
		foreach($rows_intervenant as $key => $data){
			foreach($rows_intervenant[$key] as $id => $value){
				if($id == 'ticket_assigned_to'){
					if(!in_array($value,$intervenant)) $intervenant[] = $value;
				}
			}
		}
		return $intervenant;
	}
	
	
	/**** DEPRECIE ****/
	function traitement_tickets($month,$tickets, &$ligne, &$total){
	/**
	 * Fonction permettant le traitement des tickets (calcul des CA mensuel et totaux)
	 *
	 * @param $month le mois en cours de traitement
	 * @param $tickets array contenant tout les tickets
	 * @param &$ligne la ligne en a renvoyé (par adresse)
	 * @param &$total le total pour chaque mois et chaque ligne
	 *
	 * @return modifie les variables $ligne et $total
	 */
		foreach($tickets as $id_tickets => $value_tickets){
			if(($tickets[$id_tickets]['closed_date'] >= $month['start'])&&($tickets[$id_tickets]['closed_date'] <= $month['end'])){
				$details = $this->so_factures_details->search(array('ticket_id'=>$value_tickets['ticket_id']),$id_only);
				if(is_array($details)){
					foreach($details as $id_details => $value_details){
						$ligne['total'] += $value_details['total_ht'];
						$total['total'] += $value_details['total_ht'];
						switch ($month['number']){
							case 0:
								$ligne['january'] += $value_details['total_ht'];
								$total['january'] += $value_details['total_ht'];
								break;
							case 1:
								$ligne['february'] += $value_details['total_ht'];
								$total['february'] += $value_details['total_ht'];
								break;
							case 2:
								$ligne['march'] += $value_details['total_ht'];
								$total['march'] += $value_details['total_ht'];
								break;
							case 3:
								$ligne['april'] += $value_details['total_ht'];
								$total['april'] += $value_details['total_ht'];
								break;
							case 4:
								$ligne['may'] += $value_details['total_ht'];
								$total['may'] += $value_details['total_ht'];
								break;
							case 5:
								$ligne['june'] += $value_details['total_ht'];
								$total['june'] += $value_details['total_ht'];
								break;
							case 6:
								$ligne['july'] += $value_details['total_ht'];
								$total['july'] += $value_details['total_ht'];
								break;
							case 7:
								$ligne['august'] += $value_details['total_ht'];
								$total['august'] += $value_details['total_ht'];
								break;
							case 8:
								$ligne['september'] += $value_details['total_ht'];
								$total['september'] += $value_details['total_ht'];
								break;
							case 9:
								$ligne['october'] += $value_details['total_ht'];
								$total['october'] += $value_details['total_ht'];
								break;
							case 10:
								$ligne['november'] += $value_details['total_ht'];
								$total['november'] += $value_details['total_ht'];
								break;
							case 11:
								$ligne['december'] += $value_details['total_ht'];
								$total['december'] += $value_details['total_ht'];
								break;
						}
					}
				}
			}
		}

		foreach($ligne as $key => $data){
			if($data == '0')
				$ligne[$key] = '-';
		}	
	}
	
	function traitement_factures($filter, $month ,$factures, &$ligne, &$total){
	/**
	 * Fonction permettant le traitement des factures (calcul des CA mensuel et totaux)
	 *
	 * @param $filter int : 0 = tout // 1 = tickets seulement // 2 = Ligne perso seulement
	 * @param $month array : le mois en cours de traitement
	 * @param $factures array : contenant toutes les factures
	 * @param &$ligne la ligne a renvoyé (par adresse)
	 * @param &$total le total pour chaque mois et chaque ligne (par adresse)
	 *
	 * @return modifie les variables $ligne et $total
	 */
	 
		foreach($factures as $id_facture => $value_facture){
			$details = $this->so_factures_details->search(array('facture_id'=>$value_facture['facture_id']),false);
			foreach($details as $id_details => $value_details){
				switch($filter){
					case 0:
						$total_ht = empty($value_details['total_ht']) || $value_details['total_ht'] == 0 ? $value_details['extra_ht'] : $value_details['total_ht'];
						break;
					case 1:
						$total_ht = $value_details['total_ht'];
						break;
					case 2:
						$total_ht = $value_details['extra_ht'];
						break;
				}
				
				$ligne['total'] += $total_ht;
				$total['total'] += $total_ht;
				switch ($month['number']){
					case 0:
						$ligne['january'] += $total_ht;
						$total['january'] += $total_ht;
						break;
					case 1:
						$ligne['february'] += $total_ht;
						$total['february'] += $total_ht;
						break;
					case 2:
						$ligne['march'] += $total_ht;
						$total['march'] += $total_ht;
						break;
					case 3:
						$ligne['april'] += $total_ht;
						$total['april'] += $total_ht;
						break;
					case 4:
						$ligne['may'] += $total_ht;
						$total['may'] += $total_ht;
						break;
					case 5:
						$ligne['june'] += $total_ht;
						$total['june'] += $total_ht;
						break;
					case 6:
						$ligne['july'] += $total_ht;
						$total['july'] += $total_ht;
						break;
					case 7:
						$ligne['august'] += $total_ht;
						$total['august'] += $total_ht;
						break;
					case 8:
						$ligne['september'] += $total_ht;
						$total['september'] += $total_ht;
						break;
					case 9:
						$ligne['october'] += $total_ht;
						$total['october'] += $total_ht;
						break;
					case 10:
						$ligne['november'] += $total_ht;
						$total['november'] += $total_ht;
						break;
					case 11:
						$ligne['december'] += $total_ht;
						$total['december'] += $total_ht;
						break;
				}
			}
		}

		foreach($ligne as $key => $data){
			if($data == '0')
				$ligne[$key] = '-';
		}
	}
	
	function stats_ticket_intervenant($content=null){
	/**
	 * Fonction permettant l'affichage des stats de tickets par intervenant
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			if(isset($content['nm']['rows']['delete'])){
				list($id) = @each($content['nm']['rows']['delete']);
				if($this->delete($id)){
					$msg='Location deleted';
				}
				unset($content['nm']['rows']['delete']);
			}
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_ticket_intervenant',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> false,
					'filter_label'		=> lang('Providers'),
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('ca_intervenant'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
					//'manual'         => $do_email ? ' ' : false,	// space for the manual icon
				);
			}		

			$content['msg']=$msg;
			
			
			$sel_options = array(
				'client_id'	=>	$this->client_groups,
				'filter' => array('' => lang('All')) + $this->get_providers(), 
			);
			if(count($this->client_groups)==1){
				$content['nm']['col_filter']['account_id']=key($this->client_groups);				
				$no_button['client_id']=true;
				$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
			}else{
				foreach($this->client_groups as $id=>$value){
					if(!empty($id)){
						$content['nm']['col_filter']['account_id'][]=$id;
					}
				}
			}
			$content['nm']['template']='spid.stats.spi_ticket_intervenant.rows';
			$content['nm']['header_left'] = 'spid.stats.index.year';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			$content['nm']['year']=date("Y")+1;
			$tpl = new etemplate('spid.stats.spi_ticket_intervenant');
			
			$tpl->exec('spid.stats_ui.stats_ticket_intervenant', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.stats_ticket_intervenant</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_ticket_intervenant(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats de ca par intervenant. Retourne le nombre de lignes
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';
		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		
		$first_of_month = $this->get_month_date($query['year']-1);
		
		if(isset($query['col_filter']['client_id']) && !empty($query['col_filter']['client_id']))
		{
			$search['account_id']=$query['col_filter']['client_id'];
			unset($query['col_filter']['client_id']);
		}
		
		// Récupération et parcours des intervenants
		$intervenant = $this->get_intervenant($first_of_month[0],$first_of_month[sizeof($first_of_month)-1]);
		if(!empty($intervenant)){
			$total = array();
			$total['january']=$total['february']=$total['march']=$total['april']=$total['may']=$total['june']=$total['july']=$total['august']=$total['september']=$total['october']=$total['november']=$total['december']=0;
			$total['total'] = 0;
			$total['intervenant'] = 'Total';
			foreach($intervenant as $key => $id_intervenant){
				$ligne = array();
				$ligne['january']=$ligne['february']=$ligne['march']=$ligne['april']=$ligne['may']=$ligne['june']=$ligne['july']=$ligne['august']=$ligne['september']=$ligne['october']=$ligne['november']=$ligne['december']=0;
				$ligne['total'] = 0;
				$ligne['intervenant'] = $GLOBALS['egw']->accounts->id2name($id_intervenant,'account_fullname');
				// Récupération et traitement des tickets
				for($i=0;$i < sizeof($first_of_month)-1;++$i){
					$closed_date='closed_date BETWEEN '.$first_of_month[$i].' AND '.$first_of_month[$i+1];
					// Filtre sur le prestataire
					$criteria = array();
					if(!empty($query['filter'])){
						$categories = spid_bo::groupeGestionCategorie(array($query['filter']=>''));
						if(!empty($categories)){
							$col_filter['cat_id'] = $categories;
						}else{
							$col_filter['cat_id'] = 0;
						}
					}
					
					$tickets = $this->so_ticket->search($criteria + array('ticket_assigned_to'=>$id_intervenant,'ticket_closed'=>1),false,'','','',false,'AND',false,$closed_date);
					$month['start'] = $first_of_month[$i];
					$month['end'] = $first_of_month[$i+1];
					$month['number'] = $i;
					$this->comptage_tickets($month,$tickets,$ligne,$total);
				}
				if($ligne['total'] > 0){
					$rows[] = $ligne;
				}
			}
			uasort($rows, array('stats_ui','cmp'));
			$this->ajouter_ligne($rows);
			$rows[] = $total;
		}
		
		// Calcul des totaux et pourcentages
		foreach($rows as $id => $value){
			if($value['total'] != ''){
				$rows[$id]['percent'] = round(100 * $value['total'] / $total['total']).' %';
			}
			if($id == sizeof($rows)-1){
				$rows[$id]['percent'] = '';
				foreach($value as $month => $value_month){
					if(($month != 'total')&&($month != 'intervenant')){
						$rows[$id+1][$month] = round(100 * $value_month / $total['total']).' %';
					}else{
						$rows[$id+1][$month] = '';
					}
				}
			}
		}
		if($total['total'] == 0){
			unset($rows);
		}
		return sizeof($rows);
	}
	
	function comptage_tickets($month,$tickets, &$ligne, &$total){
	/**
	 * Fonction permettant de compter les tickets
	 *
	 * @param $month le mois en cours de traitement
	 * @param $tickets array contenant tout les tickets
	 * @param &$ligne la ligne en a renvoyé (par adresse)
	 * @param &$total le total pour chaque mois et chaque ligne
	 *
	 * @return modifie les variables $ligne et $total
	 */
		if(!empty($tickets)){
			foreach($tickets as $id => $value){
				if(($tickets[$id]['closed_date'] < $month['start'])||($tickets[$id]['closed_date'] > $month['end'])){
					unset($tickets[$id]);
				}
			}
			$ligne['total'] += sizeof($tickets);
			$total['total'] += sizeof($tickets);
			switch ($month['number']){
				case 0:
					$ligne['january'] += sizeof($tickets);
					$total['january'] += sizeof($tickets);
					break;
				case 1:
					$ligne['february'] += sizeof($tickets);
					$total['february'] += sizeof($tickets);
					break;
				case 2:
					$ligne['march'] += sizeof($tickets);
					$total['march'] += sizeof($tickets);
					break;
				case 3:
					$ligne['april'] += sizeof($tickets);
					$total['april'] += sizeof($tickets);
					break;
				case 4:
					$ligne['may'] += sizeof($tickets);
					$total['may'] += sizeof($tickets);
					break;
				case 5:
					$ligne['june'] += sizeof($tickets);
					$total['june'] += sizeof($tickets);
					break;
				case 6:
					$ligne['july'] += sizeof($tickets);
					$total['july'] += sizeof($tickets);
					break;
				case 7:
					$ligne['august'] += sizeof($tickets);
					$total['august'] += sizeof($tickets);
					break;
				case 8:
					$ligne['september'] += sizeof($tickets);
					$total['september'] += sizeof($tickets);
					break;
				case 9:
					$ligne['october'] += sizeof($tickets);
					$total['october'] += sizeof($tickets);
					break;
				case 10:
					$ligne['november'] += sizeof($tickets);
					$total['november'] += sizeof($tickets);
					break;
				case 11:
					$ligne['december'] += sizeof($tickets);
					$total['december'] += sizeof($tickets);
					break;
			}
		}
	}

	function stats_group($content=null){
	/**
	 * Fonction permettant l'affichage des stats par groupe
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_group',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> true,
					'filter_label'		=> lang('Providers'),
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('groups'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
				);
			}		
			if(empty($content['nm']['filter']) || $content['nm']['filter']==0){
				
			}else{
				unset($content['nm']['col_filter']);
			}
			$content['msg']=$msg;
			
			
			$sel_options = array(
				'contract_id'	=> array('0'=> '-') + $this->get_contrat(),
				'client_id' 	=> $this->get_societe(),
				'client_group'	=> $this->get_societe(),
			);

			if(count($this->client_groups)==1){
				$content['nm']['col_filter']['client_id']=key($this->client_groups);				
				$no_button['client_id']=true;
				$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
			}else{
				foreach($this->client_groups as $id=>$value){
					if(!empty($id)){
						$content['nm']['col_filter']['client_id'][]=$id;
					}
				}
			}
			
			$content['nm']['template']='spid.stats.group.rows';
			$content['nm']['header_left'] = 'spid.stats.index.left';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			$content['nm']['start_date']=mktime(0,0,0,1,1,date("Y"));
			$content['nm']['end_date']=mktime(23,59,59,date("m"),date("d")+1,date("Y"));
			
			$tpl = new etemplate('spid.stats.group');
			
			$tpl->exec('spid.stats_ui.stats_group', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.stats_group</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_group(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats des groupes. Retourne le nombre de lignes
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
	 
	 
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';
		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		if(isset($query['col_filter']['contract_id'])){
			$contract_id = $query['col_filter']['contract_id'];
			unset($query['col_filter']['contract_id']);
		}

		// YLF - Définition du caractère de remplissage pour les données vides ('-' en vue normal et '0' pour un export csv)
		$empty = '-';
		if(isset($query['csv_export']) && $query['csv_export']){
			$empty = 0;
		}
		
		// Récupération et traitement des clients
		$client_user = $this->get_clients();
		$q_fields='client_id,client_company,client_parent';
		// attention : piege si client_parent est null
		$client_group = $this->search(array('client_parent'=>'0'),$q_fields,'','','',false,'AND');
		 // _debug_array($client_group);
		
		if(!is_array($client_group)) $client_group = array();
		$i = 0;
		if(!empty($client_group)){
			foreach($client_group as $key => $data_client_group){
				// Parcours des maison mères
				
				$q_fields='client_id,client_company,client_parent';
				// recherche tous les clients..
				$client = $this->search('',$q_fields);

				// pour chaque client
				foreach($client as $key_client => $data_client){
				// _debug_array($data_client_group['client_id']);
				 // _debug_array($data_client);
				

				
				// on recherche la maison mère
					if(($data_client['client_id'] == $data_client_group['client_id']) or ($data_client['client_parent'] == $data_client_group['client_id'])){
						
						// Récupération et traitement des contrats
						// echo "<br>groupe :" .$data_client_group['client_id'].' '. $data_client_group['client_company'];
						// $data_client['client_id'];

						// $criteria['client_id'] = $data_client['client_id'];
						// echo "critère client : ".$criteria['client_id'];
						
						// $contrats = $this->so_contrat->search(array('contract_client'=>$data_client['client_id']),false,'','','',false,'OR');
					$q_fields='contract_id,contract_client';
					$contrats = $this->so_contrat->search(array('contract_client'=>$data_client['client_id']),$q_fields,'','','',false,'OR');
						// echo "contrat";
						// _debug_array($contrats);
					
						
						if(!empty($contrats)){
							foreach($contrats as $key_contrat => $data_contrat){
								// echo $criteria['contract_id'];
							// echo $criteria['contract_id'];
								$criteria['contract_id']=$data_contrat['contract_id'];
								$criteria['client_id'] = array($data_client['client_id']);
								// $criteria['client_id'] = array($data_contrat['contract_client'],$this->id2account(
								// $data_contrat['contract_supplier']));
								
								$time_open = $this->time_open($criteria,$query['start_date'],$query['end_date']);
								$time_close = $this->time_close($criteria,$query['start_date'],$query['end_date']);
								$time_not_factured = $this->time_not_factured($criteria,$query['start_date'],$query['end_date']);
								
								$rows[$i]['contract_id'] = $data_contrat['contract_id'];
								
								$rows[$i]['client_id'] = $data_contrat['contract_client'];
								
								$rows[$i]['client_group'] = $this->get_group($data_contrat['contract_client']);
								$rows[$i]['time_closed'] = $time_close;
								$rows[$i]['time_not_factured'] = $time_not_factured;
								$rows[$i]['total_time'] = $time_open + $time_close + $time_not_factured;
								
								$rows[$i]['turnover'] = $this->total_factured($data_contrat['contract_id'],$data_contrat['contract_client'],$query['start_date'],$query['end_date']) == 0 ? $empty : $this->total_factured($data_contrat['contract_id'],$data_contrat['contract_client'],$query['start_date'],$query['end_date']);
								
								if ($rows[$i]['time_closed'] > 0) {								
									$rows[$i]['outstanding'] = ($rows[$i]['total_time'] - $rows[$i]['time_closed']) * $rows[$i]['turnover'] / $rows[$i]['time_closed'] == 0 ? $empty : number_format(($rows[$i]['total_time'] - $rows[$i]['time_closed']) * $rows[$i]['turnover'] / $rows[$i]['time_closed'],2);
								}
								
								$rows[$i]['budget_amount'] = empty($data_contrat['contract_n_budget_amount']) ? $empty : $data_contrat['contract_n_budget_amount'];
								$rows[$i]['budget_time'] = empty($data_contrat['contract_n_budget_days']) ? $empty : $data_contrat['contract_n_budget_days'];
								
								$rows[$i]['difference_amount'] = $rows[$i]['turnover'] - $rows[$i]['budget_amount'];
								$rows[$i]['difference_time'] = $rows[$i]['total_time'] - $rows[$i]['budget_time'];

								if($this->verif_ligne($rows[$i],array('contract_id','client_id','client_group'))){
									++$i;
								}else{
									unset($rows[$i]);
								}
							}
						}
					}
				}	
			}
		}

		switch($this->obj_config['stat_unit_time']){
			case 0:
				$rows['time'] = ' '.lang('(mn)').'';
				break;
			case 1:
				$rows['time'] = ' '.lang('(h)').'';
				break;
			case 2:
				$rows['time'] = ' '.lang('(d)').'';
				break;
		}
		
		return sizeof($rows);
	}
	
	function suivi_activite($content=null){
	/**
	 * Fonction permettant l'affichage du suivi d'activité
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_suivi',	// I  method/callback to request the data for the rows
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> false,
					'filter_label'		=> lang('Providers'),
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('suivi'),
					'no_columnselection'=> true,
					'cat_app'		=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'		=> 'spid',
				);
			}		

			$content['msg']=$msg;
			
			
			$sel_options = array(
				'contract_id' =>	$this->get_contrat(),
				'client' =>	$this->get_societe(),
				'client_group' => $this->get_societe(),
				'supplier' => $this->get_societe(),
				'sector' => $this->get_sectors(),
				'filter' => array('' => lang('All')) + $this->get_providers(), 
			);
			if(count($this->client_groups)==1){
				$content['nm']['col_filter']['account_id']=key($this->client_groups);				
				$no_button['client_id']=true;
				$GLOBALS['egw']->js->set_onload("document.getElementById('exec[nm][rows][client_id]').setAttribute('disabled', 'disabled');");
			}else{
				foreach($this->client_groups as $id=>$value){
					if(!empty($id)){
						$content['nm']['col_filter']['account_id'][]=$id;
					}
				}
			}
			
			$content['nm']['header_left'] = 'spid.stats.index.left';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Activity monitoring');
			$content['nm']['start_date']=mktime(0,0,0,1,1,date("Y"));
			$content['nm']['end_date']=mktime(23,59,59,date("m"),date("d")+1,date("Y"));
			
			
			$tpl = new etemplate('spid.stats.suivi_activite');
			
			$tpl->exec('spid.stats_ui.suivi_activite', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Réf : stats_ui.suivi_activite</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_suivi(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre le suivi d'activité
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';
		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		
		// YLF - Définition du caractère de remplissage pour les données vides ('-' en vue normal et '0' pour un export csv)
		$empty = '-';
		if(isset($query['csv_export']) && $query['csv_export']){
			$empty = '';
		}
		
		$rows = array();
		$i = 0;
		
		// Récupération et parcours des rendez vous
		$rendez_vous = $this->so_rendez_vous->search('',false);
		foreach($rendez_vous as $id => $data){
			// Filtre sur le prestataire
			$criteria = array();
			if(!empty($query['filter'])){
				$categories = spid_bo::groupeGestionCategorie(array($query['filter']=>''));
				if(!empty($categories)){
					$col_filter['cat_id'] = $categories;
					$criteria['cat_id'] = $categories;
				}else{
					$col_filter['cat_id'] = 0;
					$criteria['cat_id'] = 0;
				}
			}
			
			$ticket = $this->so_ticket->search($criteria + array('ticket_id'=>$data['ticket_id']),false);
			if(is_array($ticket)){
				$client = $this->so_client->search(array('account_id'=>$ticket[0]['account_id']),false);
				$intervenant = $this->so_intervenant->search(array('intervenant_id'=>$data['account_id']),false);
				$cal_event = $this->so_calendar->read($data['cal_id']);
				$facture = $this->so_factures->search(array('facture_id'=>$ticket[0]['ticket_invoice']),false);

				// Traitement du rendez vous
				if($cal_event[$data['cal_id']]['end'] > $query['start_date'] && $cal_event[$data['cal_id']]['end'] < $query['end_date']){
					$rows[$i]['ticket'] = $ticket[0]['ticket_title'];
					$rows[$i]['ticket_id'] = $ticket[0]['ticket_id'];
					$rows[$i]['intervenant'] = $data['account_id'];	
					$rows[$i]['contract_id'] = $ticket[0]['contract_id'];
					$rows[$i]['category'] = $ticket[0]['cat_id'];
					$rows[$i]['client'] = $client[0]['client_id'];
					$rows[$i]['client_group'] = $this->get_group($client[0]['client_id']);
					$rows[$i]['year'] = date('Y',$cal_event[$data['cal_id']]['start']);
					$rows[$i]['n_days'] = number_format(($cal_event[$data['cal_id']]['end'] - $cal_event[$data['cal_id']]['start'])/25200,2);
					$rows[$i]['week'] = date('W',$cal_event[$data['cal_id']]['start']);
					$rows[$i]['quarter'] = 'T'.(floor(date('W',$cal_event[$data['cal_id']]['start'])/52*4)+1);
					$rows[$i]['month'] = date('m',$cal_event[$data['cal_id']]['start']);
					$rows[$i]['realised'] = $cal_event[$data['cal_id']]['category'] == $this->obj_config['realised_intervention'] ? 1 : 0;
					$rows[$i]['cost'] = $intervenant[0]['intervenant_PJM'] * $rows[$i]['n_days'];
									
					$total_temps = 0;
					$rdv_du_ticket = $this->so_rendez_vous->search(array('ticket_id'=>$data['ticket_id']),false);
					if(is_array($rdv_du_ticket)){
						foreach($rdv_du_ticket as $id_rdv => $info_rdv){
							$cal = $this->so_calendar->read($info_rdv['cal_id']);
							if(is_array($cal)){
								if(($cal[$info_rdv['cal_id']]['category'] == $this->obj_config['realised_intervention']) || ($cal[$info_rdv['cal_id']]['category'] == $this->obj_config['confirmed_intervention']) || ($cal[$info_rdv['cal_id']]['category'] == $this->obj_config['option_intervention'])){
									$total_temps += number_format(($cal[$info_rdv['cal_id']]['end'] - $cal[$info_rdv['cal_id']]['start'])/25200,2);
								}
							}
						}
					}
					if(($cal_event[$data['cal_id']]['category'] == $this->obj_config['realised_intervention']) || ($cal_event[$data['cal_id']]['category'] == $this->obj_config['confirmed_intervention']) || ($cal_event[$data['cal_id']]['category'] == $this->obj_config['option_intervention'])){
						if(is_array($facture) && $total_temps > 0){
							$rows[$i]['pnb'] =  number_format($rows[$i]['n_days']/$total_temps * $facture[0]['total_ht'],2,',','');
						}else{
							$rows[$i]['pnb'] =  $empty;
						}
					}else{
						$rows[$i]['pnb'] = $empty;
					}
					
					$rows[$i]['status'] = $cal_event[$data['cal_id']]['category'];
					$rows[$i]['sector'] = $client[0]['client_sector'];
					$rows[$i]['invoice'] = $facture[0]['facture_number'];
					$rows[$i]['invoice_id'] = $ticket[0]['ticket_invoice'];
					$rows[$i]['payment_date'] = $facture[0]['payment_date'] == null ? $empty : $facture[0]['payment_date'];
					if($ticket[0]['ticket_invoice'] == 0){
						$rows[$i]['state'] = $empty;
					}elseif($facture[0]['payment_date'] != null){
						$rows[$i]['state'] = 'P';
					}else{
						$rows[$i]['state'] = 'F';
					}
					
					// Champs requis pour l'export
					$intervenant = $this->obj_accounts->read($data['account_id']);
					$rows[$i]['intervenant_name'] = $intervenant['account_lid'];
					$rows[$i]['client_name'] = $this->clientid2name($rows[$i]['client']);
					$rows[$i]['client_group_name'] = $this->clientid2name($rows[$i]['client_group']);
					$rows[$i]['contract_name'] = $this->contractid2name($rows[$i]['contract_id']);
					if(is_int($rows[$i]['payment_date'])) {
							$rows[$i]['payment_date_export'] = date('d/m/Y',$rows[$i]['payment_date']);
						}
					
						
					$rows[$i]['status_name'] = empty($rows[$i]['status']) ? '' : $this->get_status($rows[$i]['status']);
					
					++$i;
				}
			}
		}
		return sizeof($rows);
	}
	
	function stats_contrat($content=null){
	/**
	 * Fonction permettant l'affichage des stats par contrat
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_contrat',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> true,
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=>	0,			// IO position in list
					'cat_id'         	=>	'',			// IO category, if not 'no_cat' => True
					'search'         	=>	'',// IO search pattern
					'order'          	=>	'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=>	'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=>	array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> false,
					'csv_fields'		=> $this->export('contrat'),
					'no_columnselection'=> true,
					'cat_app'			=> 'spid',
					//Permet d'effectuer un filtre sur l'application en cours
					'app'				=> 'spid',
				);
			}		
			if(empty($content['nm']['filter']) || $content['nm']['filter']==0){
				
			}else{
				unset($content['nm']['col_filter']);
			}
			$content['msg']=$msg;
			
			
			$sel_options = array(
				'contract_id'		=> array('-1'=>'TOTAL','0'=> '') + $this->get_contrat(),
				'contract_client' 	=> array('0'=> '') + $this->get_societe(),
				'client'			=> $this->get_societe(),
			);

			$content['nm']['template']='spid.stats.contrat.rows';
			$content['nm']['header_left'] = 'spid.stats.index.left';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			$content['nm']['start_date']=mktime(0,0,0,1,1,date("Y"));
			$content['nm']['end_date']=mktime(23,59,59,date("m"),date("d")+1,date("Y"));
			
			$tpl = new etemplate('spid.stats.contrat');
			
			$tpl->exec('spid.stats_ui.stats_contrat', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Ref: stats_ui.stats_contrat</h1>\n",null,true);
			return;
		}
	}
	
	function get_rows_contrat(&$query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les stats des contrats. Retourne le nombre de lignes
	 * 
	 * @param array &$query tableau contant les clefs 'start_date', 'end_date'
	 * @param array &$rows Valeur de retour contenant les lignes
	 * @param array &$readonlys pour enlever les boutons d'édition basés sur les ACL. Non utilisé ici, mais peut l'être dans une classe fille.
	 *
	 * @return int
	 */	
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
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
		$search['client_sleep'] = '0';
		if(isset($query['cat_id']) && !empty($query['cat_id'])){
			$cat_id="cat_id=".$query['cat_id']." and ";
			$criteria['cat_id']=$query['cat_id'];
		}
		if(isset($query['col_filter']['contract_id'])){
			$contract_id = $query['col_filter']['contract_id'];
			unset($query['col_filter']['contract_id']);
		}
		
		// YLF - Définition du caractère de remplissage pour les données vides ('-' en vue normal et '0' pour un export csv)
		$empty = '-';
		if(isset($query['csv_export']) && $query['csv_export']){
			$empty = 0;
		}
		
		$i = 0;
		// Récupération et parcours des contrats
		$contrats = $this->so_contrat->search('',false,'','','',false,'OR');
		
		// _debug_array($contrats);
		
		if(!empty($contrats)){
			
			// _debug_array($contrats);
		
			foreach($contrats as $key_contrat => $data_contrat){
				$clients = $this->so_client->search('',false);
				
				$total = array();
				
				$total_class = $total_class == 'off' ? 'on' : 'off';
				unset($old);
				// Récupération et traitement des clients
				foreach($clients as $key_client => $data_client){
					// On parcours tous les clients, avec les maisons mère, pous chaque clé..
					if(($data_client['client_parent'] == $data_contrat['contract_client'])||($data_client['client_id'] == $data_contrat['contract_client'])){
						
						if($old['contract_id'] == $data_contrat['contract_id']){
							$rows[$i]['contract_id'] = $query['csv_export'] ? '' : '0';
							
						}else{
							$rows[$i]['contract_id'] =  $query['csv_export'] ? $this->contractid2name($data_contrat['contract_id']) : $data_contrat['contract_id'];
							
						}
						if($old['contract_client'] == $data_contrat['contract_client']){
							$rows[$i]['contract_client'] = $query['csv_export'] ? '' : '0';
						}else{
							$rows[$i]['contract_client'] = $query['csv_export'] ? $this->clientid2name($data_contrat['contract_client']) : $data_contrat['contract_client'];
						}
						$old['contract_id'] = $data_contrat['contract_id'];
						$old['contract_client'] = $data_contrat['contract_client'];

						$rows[$i]['client'] = $query['csv_export'] ? $this->clientid2name($data_client['client_id']) : $data_client['client_id'];
						
						$criteria['contract_id']=$data_contrat['contract_id'];
						// $criteria['account_id'] = array($this->id2account($data_client['client_id']));
						$criteria['client_id'] = $data_client['client_id'];

						$time_open = $this->time_open($criteria);
						$time_close = $this->time_close($criteria,$query['start_date'],$query['end_date']);
						$time_not_factured = $this->time_not_factured($criteria,$query['start_date'],$query['end_date']);
						$rows[$i]['time_closed'] = $time_close == 0 ? $empty : $time_close;
						$rows[$i]['time_not_factured'] = $time_not_factured == 0 ? $empty : $time_not_factured;
						$rows[$i]['total_time'] = $time_open + $time_close + $time_not_factured == 0 ? $empty : $time_open + $time_close + $time_not_factured;

						if($this->total_factured($data_contrat['contract_id'],$data_client['client_id'],$query['start_date'],$query['end_date']) == 0){
							$rows[$i]['turnover'] = $empty;
						}else{
							$rows[$i]['turnover'] = $this->total_factured($data_contrat['contract_id'],$data_contrat['contract_client'],$query['start_date'],$query['end_date']);
						}
						
						$rows[$i]['opened_outstanding'] = $time_open == 0 ? $empty : $time_open;
						$rows[$i]['outstanding_to_bill'] = $time_not_factured == 0 ? $empty : $time_not_factured;
						$rows[$i]['total_outstanding'] = ($time_not_factured + $time_open) == 0 ? $empty : $time_not_factured + $time_open;
						if ($rows[$i]['time_closed'] > 0) {
							$rows[$i]['outstanding_amount'] = ($time_not_factured + $time_open) * $rows[$i]['turnover'] / $rows[$i]['time_closed'] == 0 ? $empty : ($rows[$i]['total_time'] - $rows[$i]['time_closed']) * $rows[$i]['turnover'] / $rows[$i]['time_closed'];
						}
						
						$rows[$i]['total_class'] = $total_class;
						
						if($this->check_row($rows[$i])){
							$total['opened_outstanding'] += $rows[$i]['opened_outstanding'];
							$total['outstanding_to_bill'] += $rows[$i]['outstanding_to_bill'];
							$total['total_outstanding'] += $rows[$i]['total_outstanding'];
							$total['outstanding_amount'] += $rows[$i]['outstanding_amount'];
							$total['time_closed'] += $time_close;
							$total['time_not_factured'] += $time_not_factured;
							$total['total_time'] += $rows[$i]['total_time'];
							$total['turnover'] += $rows[$i]['turnover'];
							$total['outstanding'] += $rows[$i]['outstanding'];
							
							$rows[$i]['opened_outstanding'] = number_format($rows[$i]['opened_outstanding'],2);
							$rows[$i]['outstanding_to_bill'] = number_format($rows[$i]['outstanding_to_bill'],2);
							$rows[$i]['total_outstanding'] = number_format($rows[$i]['total_outstanding'],2);
							$rows[$i]['outstanding_amount'] = number_format($rows[$i]['outstanding_amount'],2);
							$rows[$i]['time_closed'] = number_format($rows[$i]['time_closed'],2);
							$rows[$i]['time_not_factured'] = number_format($rows[$i]['time_not_factured'],2);
							$rows[$i]['total_time'] = number_format($rows[$i]['total_time'],2);
							$rows[$i]['turnover'] = number_format($rows[$i]['turnover'],2);
							$rows[$i]['outstanding'] = number_format($rows[$i]['outstanding'],2);

							++$i;
						}else{
							unset($rows[$i]);
						}
					}
				}

				// Formatage des données + Données calculées
				if(!empty($total)){
					foreach($total as $id => $info){
						$rows[$i][$id] = $info == 0 ? $empty : $info;
					}
					$rows[$i]['contract_id'] = $query['csv_export'] ? lang('TOTAL') : '-1';
					$rows[$i]['contract_client'] = $query['csv_export'] ? '' : '0';
					$rows[$i]['client'] = $query['csv_export'] ? '' : '0';
					$rows[$i]['budget_amount'] = empty($data_contrat['contract_n_budget_amount']) ? $empty : $data_contrat['contract_n_budget_amount'];
					$rows[$i]['budget_time'] = empty($data_contrat['contract_n_budget_days']) ? $empty : $data_contrat['contract_n_budget_days'];
					
					$rows[$i]['difference_amount'] = $rows[$i]['turnover'] - $rows[$i]['budget_amount'] == 0 ? $empty : $rows[$i]['turnover'] - $rows[$i]['budget_amount'];
					$rows[$i]['difference_time'] = $rows[$i]['total_time'] - $rows[$i]['budget_time'] == 0 ? $empty : $rows[$i]['total_time'] - $rows[$i]['budget_time'];
					$rows[$i]['total_class'] = 'total';
					
					
					$rows[$i]['opened_outstanding'] = number_format($rows[$i]['opened_outstanding'],2);
					$rows[$i]['outstanding_to_bill'] = number_format($rows[$i]['outstanding_to_bill'],2);
					$rows[$i]['total_outstanding'] = number_format($rows[$i]['total_outstanding'],2);
					$rows[$i]['outstanding_amount'] = number_format($rows[$i]['outstanding_amount'],2);
					$rows[$i]['time_closed'] = number_format($rows[$i]['time_closed'],2);
					$rows[$i]['time_not_factured'] = number_format($rows[$i]['time_not_factured'],2);
					$rows[$i]['total_time'] = number_format($rows[$i]['total_time'],2);
					$rows[$i]['turnover'] = number_format($rows[$i]['turnover'],2);
					$rows[$i]['outstanding'] = number_format($rows[$i]['outstanding'],2);
					$rows[$i]['difference_time'] = number_format($rows[$i]['difference_time'],2);
					
					++$i;
				
					$this->ajouter_ligne($rows);
					$rows[$i]['total_class'] = 'on';
					++$i;
				}
			}
		}

		switch($this->obj_config['stat_unit_time']){
			case 0:
				$rows['time'] = ' ('.lang('mn').')';
				break;
			case 1:
				$rows['time'] = ' ('.lang('h').')';
				break;
			case 2:
				$rows['time'] = ' ('.lang('d').')';
				break;
		}
		
		// _debug_array($rows);
		return sizeof($rows);
	}
	
	function check_row($row){
	/**
	 * Vérifie qu'il y a des données dans le tableau $row
	 *
	 * @param $row array : ligne a traité
	 * @return boolean : true s'il y a des données / false sinon
	 */
		unset($row['contract_id']);
		unset($row['contract_client']);
		unset($row['client']);
		unset($row['total_class']);

		foreach($row as $key => $data){
			if($data != '-' && !empty($data)){
				return true;
			}
		}
		return false;
	}
	
	function accounting_export($content=null){
	/**
	 * Fonction permettant l'affichage des stats par contrat
	 * 
	 * @param array $content=NULL correspond aux éléments à examiner (mettre à jour ou supprimer).
	 */
	 	// Clic sur "Export"
		if(isset($content['nm']['generate'])){
			// Récupération des données
			$rows = array();
			$content['nm']['export'] = true;
			$this->get_rows_export($content['nm'],$rows,$readonlys);
			unset($content['nm']['export']);
			
			// Génération du fichier selon le modèle sélectionné dans les options générales
			$this->create_accounting_export($rows,$this->obj_config['account_export_model']);

			unset($content['nm']['generate']);
		}

		if($GLOBALS['egw_info']['user']['SpidLevel'] >= 50){
			$msg='';
			// if empty, or not an  array, then you have to do the initializing on your own.
			if (!is_array($content['nm']))
			{
				$content['nm'] = array(                           // I = value set by the app, 0 = value on return / output
					'get_rows'       	=>	'spid.stats_ui.get_rows_export',	// I  method/callback to request the data for the rows eg. 'notes.bo.get_rows'
					'bottom_too'     	=> true,		// I  show the nextmatch-line (arrows, filters, search, ...) again after the rows
					'never_hide'     	=> true,		// I  never hide the nextmatch-line if less then maxmatch entrie
					'no_cat'         	=> false,
					'filter_no_lang' 	=> false,		// I  set no_lang for filter (=dont translate the options)
					'filter2_no_lang'	=> false,		// I  set no_lang for filter2 (=dont translate the options)
					'lettersearch'   	=> false,
					'no_filter'			=> true,
					'no_filter2'		=> true,
					'options-cat_id'	=> array(lang('none')),
					'start'          	=> 0,			// IO position in list
					'cat_id'         	=> '',			// IO category, if not 'no_cat' => True
					'search'         	=> '',// IO search pattern
					'order'          	=> 'client_company',	// IO name of the column to sort after (optional for the sortheaders)
					'sort'           	=> 'ASC',		// IO direction of the sort: 'ASC' or 'DESC'
					'col_filter'     	=> array(),	// IO array of column-name value pairs (optional for the filterheaders)
					'default_cols'   	=> false,
					'no_csv_export'		=> true,
					// 'csv_fields'		=> $this->export('contrat'),
					'no_columnselection'=> true,
				);
			}		
			
			$content['msg']=$msg;
						
			$sel_options = array(
				'book' => $this->get_book(),
				'account' => $this->get_account(),
				'external_account' => $this->get_account(),

				'provider' => $this->get_providers(),
				// 'format' => admin_bo::get_accounting_export(),
			);

			$content['nm']['template'] = 'spid.stats.accounting_export.rows';
			$content['nm']['header_left'] = 'spid.stats.accounting_export.left';
			$content['nm']['header_right'] = 'spid.stats.accounting_export.right';
			$GLOBALS['egw_info']['flags']['app_header'] = lang('Statistic');	
			
			$tpl = new etemplate('spid.stats.accounting_export');
			
			$tpl->exec('spid.stats_ui.accounting_export', $content,$sel_options,$no_button, $content);
		}else{
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." Ref: stats_ui.accounting_export</h1>\n",null,true);
			return;
		}
	}

	function get_rows_export(&$query,&$rows,&$readonlys){
	/** 
	 * Stats pour export compta
	 */
		 // _debug_array($query);exit;
		// $this->so_factures->debug = 5;

		$join = 'WHERE (invoice_export IS NULL OR invoice_export = 0)';
		$invoices = $this->so_factures->search(array('societe_id' => $query['provider'],'generated_pdf'=>'1'),false,'','','',False,'AND',false,null,$join);
		$default_account = $this->so_account->read($this->obj_config['sales_account']);
		
		$i = 0;
		foreach ($invoices as $invoice) {
			// Flag des factures si l'option a été cochée
			if($query['flag_invoice'] && isset($query['generate'])){
				$temp_invoice = array(
					'facture_id' => $invoice['facture_id'], 
					'invoice_export' => true,
					'invoice_export_date' => time(),
					'invoice_export_user' => $GLOBALS['egw_info']['user']['account_id'],
				);
				$this->so_factures->update($temp_invoice,true);
			}

			$temp = array();

			// Parcours des détails de la facture
			$invoice_details = $this->so_factures_details->search(array('facture_id' => $invoice['facture_id']),false);
			foreach($invoice_details as $detail){
				// Recupération du compte de TVA
				$vat = $this->so_vat->read($detail['vat_id']);
				$vat_account = empty($vat['vat_account_id']) ? $default_account : $this->so_account->read($vat['vat_account_id']);

				// Si ligne extra
				if(!empty($detail['extra_cat_id'])){
					// Récupération du compte de la catégorie de la ligne
					$category = $this->so_cat_invoice->read($detail['extra_cat_id']);
					$account = empty($category['cat_account']) ? $default_account : $this->so_account->read($category['cat_account']);

					// Récupération du montant pour le compte (et pour les tva)
					$temp[$account['account_id']] += $detail['extra_ht'];
					$temp[$vat_account['account_id']] += $detail['extra_ht'] * $detail['vat_rate'] / 100;
				}else{
				// Si ticket
					// Récupération du compte de la catégorie du ticket
					$ticket = $this->so_ticket->read($detail['ticket_id']);
					$category = $GLOBALS['egw']->categories->read($ticket['cat_id']);
					$account = empty($category['data']['sale_account']) ? $default_account : $this->so_account->read($category['data']['sale_account']);

					// Récupération du montant pour le compte (et pour les tva)
					$temp[$account['account_id']] += $detail['total_ht'];
					$temp[$vat_account['account_id']] += $detail['total_ht'] * $detail['vat_rate'] / 100;
				}
			}

			// Reformatage des données temporaires
			$total = 0;
			$client = $this->so_client->read($invoice['client_id']);
			foreach($temp as $account_id => $amount){
				// Lignes avec des montants nuls > pas d'export comptable...
				if ($amount <> 0) {
					$rows[$i] = array(
						'book' => $this->obj_config['sales_book'],
						'account' => $account_id,
						'invoice_date' => date('dmy',$invoice['send_date']),
						'invoice' => $invoice['facture_number'].'  '.substr($client['client_company'], 0, 25-strlen($invoice['facture_number'].' - ')),
						'facture_number' => substr($invoice['facture_number'],0,13),//utilisé pour marquer le n° de pièce
						'credit_debit' => 'C',
						'amount' => number_format($amount, 2, '.', ''),
					);
					$total += $amount;

					++$i;
					}
			}

			// Ligne de total
			if($total <> 0){
				$rows[$i] = array(
					'book' => $this->obj_config['sales_book'],
					'account' => $this->obj_config['sales_collective_account'],
					'invoice_date' => date('dmy',$invoice['send_date']),
					'invoice' => $invoice['facture_number'].'  '.substr($client['client_company'], 0, 25-strlen($invoice['facture_number'].' - ')),
					'facture_number' => substr($invoice['facture_number'],0,13),//utilisé pour marquer le n° de pièce
					'external_account' => empty($client['client_code_tiers']) ? $this->obj_config['default_external_account'] : $client['client_code_tiers'],
					'due_date' => date('dmy',$invoice['send_date']),
					'credit_debit' => 'D',
					'amount' => number_format($total, 2, '.', ''),
				);
				++$i;
			}
		}

		$provider = $this->so_client->read($query['provider']);
		$rows['provider'] = $provider['client_company'];

		// _debug_array($rows);
		return count($rows)-1;
	}

	function pnm($content=array()){
	/**
	 * Export format PNM
	 */
		$filename = uniqid('spid_export_');
		
		//Test du répertoire Racine des factures
		$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid';
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}

		//Test du répertoire des exports
		$repertoire=$repertoire.'/exports';
		if(!file_exists($repertoire)){
			mkdir($repertoire,0755);
		}
		
		$filename_fullpath=$repertoire.'/'.$filename;
		
		$file = fopen($filename_fullpath.'.pnm',"w+");
		// $file = fopen($GLOBALS['egw_info']['server']['temp_dir'].'/'.$filename.'.pnm',"w+");
		
		fputs($file, utf8_encode(str_pad($content['provider'],30)));
		unset($content['provider']);

		foreach($content as $row){
			$book = $this->so_book->read($row['book']);
			$account = $this->so_account->read($row['account']);

			$external_account = empty($row['external_account']) ? ' ' : 'X'.$row['external_account'];
			$line = str_pad($book['book_code'],3).str_pad($row['invoice_date'],6).'FC'.str_pad(substr($account['account_code'],0,13),13).str_pad($external_account,14).str_pad($row['facture_number'],13).str_pad($row['invoice'],25).' '.str_pad($row['due_date'],6).str_pad($row['credit_debit'],1).str_pad(number_format($row['amount'], 2, '.', ''),20,' ',STR_PAD_LEFT).'N'.str_pad('',7).str_pad('',26).str_pad('EUR',3).str_pad('',20+3+10+25);
			fputs($file, utf8_encode("\r\n".$line)); // on va a la ligne
		}

		// return $GLOBALS['egw_info']['server']['temp_dir'].'/'.$filename.'.pnm';
		return $filename_fullpath.'.pnm';
	}

	function create_accounting_export($content=array(),$format){
	/**
	 * Genération du document
	 *
	 * @param $content array : tableau des données
	 */
		// On génère le fichier pnm
		$filename = $this->$format($content);

		echo "<html><body><script>window.open('".egw::link('/index.php','menuaction=spid.stats_ui.show_accounting_export&format='.$format.'&file='.$filename)."','_blank','dependent=yes,width=750,height=600,scrollbars=yes,status=yes');</script></body></html>\n";
	}
	
	function show_accounting_export(){
	/** 
	 * Lance le téléchargement de fichier créé par create_accounting_export
	 *
	 */
	 	$datefichier = date("Y-m-d-H-i"); 

	 	header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public", false);
		header("Content-Description: File Transfer");
		header("Content-Type: application/force-download");
		header("Accept-Ranges: bytes");
		header('Content-Disposition:inline;filename="accounting_export_'.$datefichier.'.'.$_GET['format'].'"');
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($_GET['file']));

		// header("Content-Type: application/force-download");
		// header("Content-Type: application/octet-stream");
		// header("Content-Type: application/download");
		// 

		ob_clean();
		flush();
		if (readfile($_GET['file'])){
			// Activer la ligne avec unlink pour supprimer le fichier... On souhaite cependant garder 
			// les export pour traçabilité...
			//unlink($_GET['file']);
		}
	}
}
?>
