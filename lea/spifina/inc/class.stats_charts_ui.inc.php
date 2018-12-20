<?php
/* spifina : spifina
SPIREA - Janvier/Mai 2013
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaQual - 

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/

require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.spifina_bo.inc.php');	

// JPGraph does not work, if that got somehow set, so unset it
if (isset($GLOBALS['php_errormsg'])) unset ($GLOBALS['php_errormsg']);

// check if EGW_JPGRAPH_PATH is already set, eg. in header.inc.php
if (defined('EGW_JPGRAPH_PATH'))
{
	if (!file_exists(EGW_JPGRAPH_PATH . '/jpgraph.php'))
	{
		die('EGW_JPGRAPH_PATH="'.EGW_JPGRAPH_PATH.'" defined but not valid!');
	}
}
elseif(file_exists(EGW_SERVER_ROOT . '/../jpgraph/src/jpgraph.php'))
{
	define('EGW_JPGRAPH_PATH',realpath(EGW_SERVER_ROOT . '/../jpgraph/src'));
}
elseif (file_exists(EGW_SERVER_ROOT . '/../jpgraph/jpgraph.php'))
{
	define('EGW_JPGRAPH_PATH',realpath(EGW_SERVER_ROOT . '/../jpgraph'));
}
// check if the admin installed a recent JPGraph parallel to eGroupWare
if (defined('EGW_JPGRAPH_PATH'))
{
	$GLOBALS['egw_info']['apps']['spifina']['config'] = config::read('spifina');

	foreach(array(
		'TTF_DIR'          => '',
		'LANGUAGE_CHARSET' => 'iso-8859-1',
		'GANTT_FONT'       => 15, //FF_ARIAL
		'GANTT_FONT_FILE'  => 'arial.ttf',
		'GANTT_STYLE'      => 9002, //FS_BOLD,
		'GANTT_CHAR_ENCODE'=> false,
	) as $name => $default)
	{
		if (isset($GLOBALS['egw_info']['apps']['spifina']['config'][$name]))
		{
			define($name,$GLOBALS['egw_info']['apps']['spifina']['config'][$name]);
		}
		elseif($name == 'TTF_DIR')
		{
			if (!($font_file = $GLOBALS['egw_info']['apps']['spifina']['config']['GANTT_FONT_FILE'])) $font_file = 'arial.ttf';
			// using the OS font dir if we can find it, otherwise fall back to our bundled Vera font
			foreach(array(
				'/usr/X11R6/lib/X11/fonts/truetype/',	// linux / *nix default
				'/usr/share/fonts/ja/TrueType/',		// japanese fonts
				'/usr/share/fonts/msttcorefonts/', 		// to install this fonts see http://www.aditus.nu/jpgraph/jpdownload.php
				'C:/windows/fonts/',					// windows default
				// add your location here or to egw_config.config_value for config_app='spifina' AND config_name='TTF_DIR'
				EGW_SERVER_ROOT.'/spifina/inc/ttf-bitstream-vera-1.10/',	// our bundled Vera font
			) as $dir)
			{
				if (@is_dir($dir) && (is_readable($dir.$font_file) || is_readable($dir.'Vera.ttf')))
				{
					define('TTF_DIR',$GLOBALS['egw_info']['apps']['spifina']['config'][$name]=$dir);
					if (!is_readable($dir.$font_file))	// fallback to our bundled Vera font
					{
						$GLOBALS['egw_info']['apps']['spifina']['config']['GANTT_FONT'] = 18;	// FF_VERA
						$GLOBALS['egw_info']['apps']['spifina']['config']['GANTT_FONT_FILE'] = 'Vera.ttf';
					}
					break;
				}
			}
		}
		elseif($default)
		{
			define($name,$GLOBALS['egw_info']['apps']['spifina']['config'][$name]=$default);
		}
	}
	//_debug_array($GLOBALS['egw_info']['apps']['spifina']['config']);
	if (!defined('MBTTF_DIR')) define('MBTTF_DIR',TTF_DIR);

	include(EGW_JPGRAPH_PATH . '/jpgraph.php');
	include(EGW_JPGRAPH_PATH . '/jpgraph_gantt.php');
	include(EGW_JPGRAPH_PATH . '/jpgraph_bar.php');
	include(EGW_JPGRAPH_PATH . '/jpgraph_pie.php');
	include(EGW_JPGRAPH_PATH . '/jpgraph_pie3d.php');

	include(EGW_JPGRAPH_PATH . '/jpgraph_line.php');
	include(EGW_JPGRAPH_PATH . '/jpgraph_scatter.php');
}

/**
 * spifina
 */
class stats_charts_ui extends spifina_bo
{
	/**
	 * @var array $public_functions Functions to call via menuaction
	 */
	var $public_functions = array(
		'create' => true,
		'show'   => true,
	);
	/**
	 * true if JPGraph version > 1.13
	 *
	 * @var boolean
	 */
	var $modernJPGraph;
	/**
	 * Charset used internaly by eGW, translation::charset()
	 *
	 * @var string
	 */
	var $charset;
	/**
	 * Font used for the Gantt Chart, in the form used by JPGraphs SetFont method
	 *
	 * @var string
	 */
	var $gantt_font = GANTT_FONT;
	/**
	 * Charset used by the above font
	 *
	 * @var string
	 */
	var $gantt_charset = LANGUAGE_CHARSET;
	/**
	 * Should non-ascii chars be encoded
	 *
	 * @var boolean
	 */
	var $gantt_char_encode = GANTT_CHAR_ENCODE;

	var $debug;
	var $scale_start,$scale_end;
	var $tmpl;
	var $prefs;

	/**
	 * Constructor, calls the constructor of the extended class
	 */
	function __construct(){
		$this->tmpl = new etemplate();

		
		if (!check_load_extension($php_extension='gd') || !function_exists('imagecopyresampled'))
		{
			$this->tmpl->Location(array(
				'menuaction' => 'spifina.spifina_ui.index',
				'msg'        => lang("Necessary PHP extentions %1 not loaded and can't be loaded !!!",$php_extension),
			));
		}
		$this->modernJPGraph = version_compare('1.13',JPG_VERSION) < 0;
		//echo "version=".JPG_VERSION.", modernJPGraph=".(int)$this->modernJPGraph; exit;
		if ($debug) error_log("JPG_VERSION=".JPG_VERSION.", modernJPGraph=".(int)$this->modernJPGraph);

		$this->charset = translation::charset();
		$this->prefs =& $GLOBALS['egw_info']['user']['preferences'];

		// check if a arial font is availible and set FF_VERA (or bundled font) if not
		if (!is_readable((FF_MINCHO <= GANTT_FONT && GANTT_FONT <= FF_PGOTHI ? MBTTF_DIR : TTF_DIR).GANTT_FONT_FILE))
		{
			$this->gantt_font = FF_VERA;
		}
		
		parent::__construct();
	}

	function get_monthly_data($year, $cat='', $sum=false,$societe_id='',$d_cat=''){
	/**
	 * Retour le total pour chaque mois de l'année en cours
	 *
	 * @param $year : année à traiter
	 * @return array
	 */
		for($i = 0; $i < 12; ++$i){
			$start_month = mktime(0,0,0,$i+1,1,$year-1);
			$end_month = mktime(0,0,0,$i+2,1,$year-1);
			
			$sid='';
			if(!empty($societe_id) && filter_var($societe_id, FILTER_VALIDATE_INT)){
				$sid = ' societe_id = '.$societe_id.' AND';
			}
			
			$join = ' A INNER JOIN (SELECT facture_id,validation_date,send_date,societe_id FROM spifina_factures) B ON B.facture_id = A.facture_id WHERE 
					'.$sid.' 
					validation_date IS NOT NULL AND
					send_date BETWEEN '.$start_month.' AND '.$end_month;
			
			if(filter_var($cat, FILTER_VALIDATE_INT)){
				$join .= ' AND (extra_cat_id = '.$cat;
				if((int)$cat==(int)$d_cat){	$join .= ' OR extra_cat_id is NULL OR extra_cat_id = 0'; }
				$join .= ') ';
			}
			
			// $this->so_factures_details->debug=5;
			$total_month = $this->so_factures_details->search(array(),'(SUM(extra_ht) + SUM(total_ht)) as extra_ht','','',$wildcard,false,'AND',false,$col_filter,$join);
			
			if($sum){
				$current_month = $total_month[0]['extra_ht'] ? $total_month[0]['extra_ht'] : 0;
				$return[$i] = $return[$i - 1] + $current_month;
			}else{
				$return[$i] = $total_month[0]['extra_ht'] ? $total_month[0]['extra_ht'] : 0;
			}
		}

		return $return;
	}
	
	
	function get_yearly_data($year, $cat='', $sum=false,$societe_id='',$d_cat=''){
	/**
	 * Retour le total pour chaque mois de l'année en cours
	 *
	 * @param $year : année à traiter
	 * @return array
	 */
		// for($i = 0; $i < 12; ++$i){
			$start_month = mktime(0,0,0,$i+1,1,$year-1);
			$end_month = mktime(0,0,0,13,1,$year-1);
			
			$sid='';
			if(!empty($societe_id) && filter_var($societe_id, FILTER_VALIDATE_INT)){
				$sid = ' societe_id = '.$societe_id.' AND';
			}
			
			$join = ' A INNER JOIN (SELECT facture_id,validation_date,send_date,societe_id FROM spifina_factures) B ON B.facture_id = A.facture_id WHERE 
					'.$sid.' 
					validation_date IS NOT NULL AND
					send_date BETWEEN '.$start_month.' AND '.$end_month;
			
			if(filter_var($cat, FILTER_VALIDATE_INT)){
				$join .= ' AND (extra_cat_id = '.$cat;
				if((int)$cat==(int)$d_cat){	$join .= ' OR extra_cat_id is NULL OR extra_cat_id = 0'; }
				$join .= ') ';
			}
			
			// $this->so_factures_details->debug=5;
			$total_year = $this->so_factures_details->search(array(),'(SUM(extra_ht) + SUM(total_ht)) as extra_ht','','',$wildcard,false,'AND',false,$col_filter,$join);
			
			
		// }

		return $total_year[0]['extra_ht'];
	}
	
	
	
	function create($params=null,$filename='',$imagemap='chart'){
	/**
	 * Création d'un graphe
	 *
	 * @param array $params=null params, if (default) null, use them from the URL
	 * @param string $filename='' filename to store the chart or (default) empty to send it direct to the browser
	 */
		if (!$params) $params = $this->url2params($params);

		// Mois
		for($i = 1; $i <= 12; ++$i){
			$dateObj   = DateTime::createFromFormat('!m', $i);
			$month[] = utf8_decode(lang($dateObj->format('F')));
		}

		// Create the graph. These two calls are always required
		$graph = new Graph(1200,500,'auto');
		$graph->SetScale("textlin");
		$graph->ygrid->SetFill(false);
		$graph->xaxis->SetTickLabels($month);
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		$y1 = $params['year']-1;
		$y2 = $params['year']-2;
		
		// _debug_array($params);
		// Récupération des données
		switch($params['stat']){
			case 'month_cat':
				// Données
				
				$dataplot = $this->get_monthly_data($params['year'], $params['cat'],false,$params['societe_id'],$params['d_cat_id']);
				$dataline = $this->get_monthly_data($params['year']-1, $params['cat'],false,$params['societe_id'],$params['d_cat_id']);
				
				// Create the bar plots
				$b1plot = new BarPlot($dataplot);
				$graph->Add($b1plot);
				$b1plot->value->Show();
				$b1plot->SetColor("white");
				$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
				$b1plot->SetWidth(45);

				// Create the plot
				$p1 = new LinePlot($dataline);
				$graph->Add($p1);
				$p1->SetColor('black');
				$p1->mark->SetType(MARK_X,'',1.0);
				$p1->mark->SetWidth(4);
				$p1->value->SetFormat('%d');
				$p1->value->Show();
				$p1->value->SetColor('black');

				$b1plot->SetLegend($y1);
				$p1->SetLegend($y2);

				$title = utf8_decode(lang("Month category stat for %1",$params['year']-1));
				$format = '%.2f';
				break;
			case 'month_sum':
				// Données
				// echo $params['cat'];
				$dataline1 = $this->get_monthly_data($params['year'], $params['cat'], true,$params['societe_id'],$params['d_cat_id']);
				$dataline2 = $this->get_monthly_data($params['year']-1, $params['cat'], true,$params['societe_id'],$params['d_cat_id']);
				
				// Create the plot
				$p1 = new LinePlot($dataline1);
				$graph->Add($p1);
				$p1->SetColor('black');
				$p1->value->SetFormat('%d');
				$p1->value->Show();
				$p1->value->SetColor('black');

				// Create the plot
				$p2 = new LinePlot($dataline2);
				$graph->Add($p2);
				$p2->SetColor('blue');
				$p2->value->SetFormat('%d');
				$p2->value->Show();
				$p2->value->SetColor('blue');

				$p1->SetLegend($y1);
				$p2->SetLegend($y2);
				
				if(empty($params['cat']) OR $params['cat'] ==$params['d_cat_id']){
					// $params['default_cat_id']=13;
					// $params['default_cat_label']="Interventions";
					$dataline3 = $this->get_monthly_data($params['year'], $params['d_cat_id'], true,$params['societe_id'],$params['d_cat_id']);
					$dataline4 = $this->get_monthly_data($params['year']-1, $params['d_cat_id'], true,$params['societe_id'],$params['d_cat_id']);
					// Create the plot
					$p3 = new LinePlot($dataline3);
					$graph->Add($p3);
					$p3->SetColor('red');
					$p3->value->SetFormat('%d');
					$p3->value->Show();
					$p3->value->SetColor('red');
					
					// Create the plot
					$p4 = new LinePlot($dataline4);
					$graph->Add($p4);
					$p4->SetColor('gold');
					$p4->value->SetFormat('%d');
					$p4->value->Show();
					$p4->value->SetColor('gold');
					
					$p3->SetLegend($params['default_cat_label'].' '.$y1);
					$p4->SetLegend($params['default_cat_label'].' '.$y2);
				}
				// _debug_array($params);
				// _debug_array($dataline4);
				// _debug_array($dataline2);
				// foreach($dataline2 as $k => $value){
						// echo $value.'<br>';
						// echo (int)$params['objective'];
					
					
				
				// _debug_array($dataline5);
				
				if($params['objective']>0 AND empty($params['cat']) OR $params['cat']==$params['d_cat_id']){
					foreach($dataline2 as $k => $value){
						$dataline5[]= round($value * (1+(int)$params['objective'] / 100));
					}
					
					$p5 = new LinePlot($dataline5);
					$graph->Add($p5);
					$p5->SetColor('gray');
					$p5->value->SetFormat('%d');
					$p5->value->Show();
					$p5->value->SetColor('gray');
					$p5->SetLegend('Objective'.' '.$y1);	
				}	
				
				$title = utf8_decode(lang("Month category stat for %1",$params['year']-1));
				$format = '%.2f';
				break;
				
			case 'pie':
				// Données
				// echo $params['cat'];
				$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
				$cats= $fact_cat_bo->get_cat_facture();
				
				$total_ht = $this->get_yearly_data($params['year'], '', true,$params['societe_id'],$params['d_cat_id']);
				foreach($cats as $cat_id=>$cat){
					$total_cat = $this->get_yearly_data($params['year'], $cat_id, true,$params['societe_id'],$params['d_cat_id']);
					$datay1[] = $total_cat;
					$percent = round(($total_cat / $total_ht) * 100);
					$titles[] = utf8_decode($cat)." (".$percent.utf8_decode(')');
					// $datay2[] = $this->get_yearly_data($params['year']-1, $cat_id, true,$params['societe_id'],$params['d_cat_id']);
					}
				
				// Create the Pie Graph. 
				$graph = new PieGraph(900,800);
				$title = "Répartition CA";
				// $p1->SetLegends($titles);
				$theme_class="DefaultTheme";
				// $graph->SetTheme(new $theme_class());
				// Set A title for the plot
				$graph->SetBox(true);
				// Create
				$p1 = new PiePlot($datay1);
				$p1->SetLabels($titles);
				// $p1->ShowBorder();
				// $p1->SetColor('black');
				$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
				$graph->Add($p1);
				// $graph->SetLegends($titles);

		}

		// Finally send the graph to the browser
		$graph->title->Set($title);
		
		$graph->Stroke($filename);

		if ($filename && $imagemap) 
			return $graph->GetHTMLImageMap($imagemap);
	}

	/**
	 * read the chart params from the URL
	 *
	 * @param array $params already set parameters, default empty array
	 * @return array with params
	 */
	function url2params($params = array()){
		if ((int) $this->debug >= 1) 
			echo "<p>chart::url2params(".print_r($params,true).")</p>\n";

		if (!count($params))
		{
			if (!($params = $GLOBALS['egw']->session->appsession('chart','spifina')))
			{
				$params = array(				// some defaults, if called the first time
					'stat' => 'month_sum',
				);
			}
		}

		foreach(array('year') as $var)
		{
			// set start- and end-times of the chart
			if (isset($_GET[$var]))
			{
				$params[$var] = $_GET[$var];
			}
			elseif (isset($params[$var]) && $params[$var])
			{
				// already set
			}
			else
			{
				$params[$var] = $var == 'year' ? date('Y') + 1 : '';
			}
			$params[$var] = is_numeric($params[$var]) ? (int) $params[$var] : strtotime($params[$var]);

			if ((int) $this->debug >= 1) echo "<p>$var=".$params[$var].'='.date('Y-m-d',$params[$var])."</p>\n";
		}
		if ((int) $_GET['width'])
		{
			$params['width'] = (int) $_GET['width'];
		}
		else
		{
			$params['width'] = $this->tmpl->innerWidth -
				($this->prefs['common']['auto_hide_sidebox'] ? 60 : 245);
		}

		$GLOBALS['egw']->session->appsession('chart','spifina',$params);
		if ((int) $this->debug >= 1) _debug_array($params);

		return $params;
	}

	function msg_install_new_jpgraph()
	{
	/**
	 * Return message to install a new jpgraph version
	 *
	 * @static
	 * @return string/boolean message or false if a new version is installed
	 */
		return version_compare($min_version='1.13',JPG_VERSION) < 0 ? false :
			lang('You dont have JPGraph version %1 or higher installed! It is needed from spifina for Ganttcharts.',$min_version)."<br />\n".
			lang('Please download a recent version from %1 and install it in %2.',
				'<a href="http://jpgraph.net/download/" target="_blank">jpgraph.net/download/</a>',
				dirname(EGW_SERVER_ROOT).SEP.'jpgraph');
	}

	function show($content=array(),$msg='')
	{
	/**
	 * Shows a chart
	 * L'image est générée comme fichier temporaire
	 */
	 

		
		// Message de retour
		if (!$msg) $msg = html::htmlspecialchars($_GET['msg']);

		if(!empty($_GET['stat']))
			$content['stat'] = $_GET['stat'];

		// if(!empty($_GET['cat']))
			// $content['cat'] = $_GET['cat'];
		
		// Titre de la page
		$GLOBALS['egw_info']['flags']['app_header'] = lang('spifina').' - '.lang('Statistics');

		// Jpgraph
		if (!$this->modernJPGraph)
		{
			$msg .= $this->msg_install_new_jpgraph();
			$GLOBALS['egw']->framework->render('<h3 class="redItalic">'.$msg.'</h3>',null,true);
			common::egw_exit();
		}
		unset($content['update']);

		// // Export excel
		// if($content['export']){
		// 	switch($content['stat']){
		// 		case 'avp':
		// 			$data = $this->stats_avp($content);			
		// 			break;
		// 		case 'action':
		// 			$data = $this->stats_action($content);
		// 			break;
		// 	}

		// 	$stats_excel_ui = new stats_excel_ui();
		// 	$stats_excel_ui->create_ratio($data);

		// 	unset($content['export']);
		// }
		
		// Récupération des paramètres (+ défaut)
		$content = $this->url2params($content);

		// Si on est sur les stats d'actions on masque les activités
		if($content['stat'] == 'action'){
			$readonlys['categorie_label'] = true;
			$readonlys['categorie'] = true;
		}

		// Nom temporaire de l'image
		$tmp = $GLOBALS['egw_info']['server']['temp_dir'];
		if (!is_dir($tmp) || !is_writable($tmp))
		{
			$tmp = '';
		}
		$img = tempnam($tmp,'spifinachart');
		$img_name = basename($img);
		
		// $content['stat'] = !array_key_exists($content['stat']) ? "month_cat" : $content['stat'];
		// Creation des données	
		
		
		// if(empty($content['cat'])){
			$content['d_cat_id']='13';
			$content['default_cat_label']="Interventions";
		// }
		// _debug_array($content);
		
		$map = $this->create($content,$img,'chart');
		// echo "fin";

		// replace the regular links with popups
		$map = preg_replace('/href="@(\d+)x(\d+)([^"]+)"/i','href="#" onclick="egw_openWindowCentered2(\'\\3\',\'_blank\',\'dependent=yes,width=\\1,height=\\2,scrollbars=yes,status=yes\'); return false;"'
		,$map);
		

		// Permet d'afficher l'image
		$content['spifinachart'] = $GLOBALS['egw']->link('/spifina/spifinachart.php',$content+array(
			'img'   => $img_name,
		));
		
		// Valeurs
		$content['map'] = $map;
		$content['msg'] = $msg;

		// $content['year'] = isset($content['year']) ? date('Y') + 1 : $content['year'];

				// Liste
		$fact_cat_bo = CreateObject("spireapi.facture_categories_bo");
		$client_bo = CreateObject("spiclient.client_bo");
		$config = CreateObject('phpgwapi.config');
		$spiclient_config = $config->read('spiclient');
		
		$sel_options = array(
			'stat'				=> $this->get_stats(),
			'cat'				=> $fact_cat_bo->get_cat_facture(),
			'societe_id'		=> $client_bo->get_all_clients($spiclient_config['ProviderType']),
		);
		// $sel_options['client_id']=$this->get_customer_billable();
		// $sel_options['societe_id']=$providers;
		

		$this->tmpl->read('spifina.chart');
		return $this->tmpl->exec('spifina.stats_charts_ui.show',$content,$sel_options,$readonlys,array());
	}
	
	function get_stats(){
	/**
	 * Retourne les types de stats sélectionnable
	 */
		return array(
			'month_cat'	=> lang('Monthly category stat'),
			'month_sum' => lang('Monthly sum stat'),
			'pie' => lang('Pie sum stat')
		);
	}
}
