<?php
/* spiclient : SpireaRéférences
SPIREA - Janvier 2012
Spirea - 16/20 avenue de l'agent Sarre
Tél : 0141192772
Email : contact@spirea.fr
www : www.spirea.fr

Propriété de Spirea

Logiciel SpireaRéf - Ce module est un programme informatique servant à la gestion et l'édition de références d'affaires, exemples de réalisations, etc.

Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/

require_once(EGW_INCLUDE_ROOT. '/spiclient/fpdf/fpdf.php');


class generate_pdf extends fpdf{

	var $colonnes;
	var $format;
	var $type;
	
	var $config;
	
	function generate_pdf($client_id){
	/**
	*Constructeur
	*/
		self::__construct($client_id);
	}
	
	function __construct($client_id){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales. $emetteur est un tableau décrivant la socité émettrice
	* $client esu une tableau décrivant la société cliente
	*
	* @param array $emetteur=array()
	* @param array $client=array()
	*/
		// Initialisation la config
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
   			$config = CreateObject('phpgwapi.config','spiclient');
   			$this->config = $config->read_repository('spiclient');
   		}else{
			$config = CreateObject('phpgwapi.config');
			$this->config = $config->read('spiclient');
		}
		
		$so_client = new so_sql('spiclient','spiclient');
		$this->client = $so_client->read($client_id);

		$this->so_role = new so_sql('spiclient', 'spiclient_roles');
		
		define('FPDF_FONTPATH',EGW_INCLUDE_ROOT.'/spiclient/fpdf/font/');
		parent::FPDF('P', 'mm', 'A4');
	}
	
	function sizeOfText($texte,$largeur){
	/**
	* Retourne le nombre de lignes de $texte divisé par la largeur $largeur (en comptant les retours à la ligne)
	*
	* NOTE : avec un explode et  quelques lignes, on peut faire facilement mieux
	*
	* @param string $texte texte dont on doit compte le nombre de lignes
	* @param int $largeur 
	* @return int 
	*/
		$index = 0;
		$nb_lines = 0;
		$loop = TRUE;
		while($loop){
			$pos = strpos($texte, "\n");
			if(!$pos){
				$loop  = FALSE;
				$ligne = $texte;
			}else{
				$ligne = substr( $texte, $index, $pos);
				$texte = substr( $texte, $pos+1 );
			}
			$length = floor($this->GetStringWidth($ligne));
			$res = 1 + floor($length / $largeur);
			$nb_lines += $res;
		}
		return $nb_lines;
	}
	
	function Header(){
	/**
	* Construit le bas de la page PDF
	*/
		$this->SetFont('Arial','B',12);
		$this->SetY(3);

		$this->FitString($this->config['PDFTitle'],70);
		$this->Cell(0,6,utf8_decode($this->config['PDFTitle']),0,2,'C',0);
		$this->SetFont('Arial','B',12);

		$this->FitString($this->client['client_company'],70);
		$this->Cell(0,6,utf8_decode($this->client['client_company']),0,2,'C',0);

		$this->SetY(3);
		$this->SetFont('Arial','BI',10);
		
		$so_client = new so_sql('spiclient','spiclient');
		$this->provider = $so_client->read($this->config['DefaultProvider']);
		if(!empty($this->provider)){
			// $info = $this->provider['client_company']."\n".$this->provider['client_manager_email']."\n".$this->provider['client_tel'];
			// $this->MultiCell(55,5,utf8_decode($info),0,'L');
			$this->Cell(55,4,utf8_decode($this->provider['client_company']),0,1,'L',0);

			$this->FitString($this->provider['client_manager_email'],55);
			$this->Cell(55,4,utf8_decode($this->provider['client_manager_email']),0,1,'L',0);
			$this->SetFont('Arial','BI',10);

			$this->Cell(55,4,utf8_decode($this->provider['client_tel']),0,2,'L',0);
		}else{
			$this->MultiCell(60,5,utf8_decode("\n\n"),0,'L');
		}
		unset($so_client);
		
		$this->SetXY(140,3);
		$this->SetFont('Arial','BI',10);
		$adresse = $this->client['client_adr_one_street'];
		$adresse .= empty($this->client['client_adr_two_street']) ? '' : "\n".$this->client['client_adr_two_street'];
		$adresse .= "\n".$this->client['client_postalcode'].' '.$this->client['client_locality'];
		$adresse .= "\n".$this->client['client_tel'];
		$this->MultiCell(60,4,utf8_decode($adresse),0,'R');
	}

	function FitString($string, $length){
	/**
	 * Réduit la police pour qu'un texte $string rentre dans une cellule de taille $length
	 *
	 * @param $string : texte
	 * @param $length : longueur a respecter
	 */
		$font_size = $this->FontSizePt;
		$decrement = 0.1;
		// $this->SetFont('Arial','',$font_size);

		while($this->GetStringWidth($string) > $length) {
			$this->SetFontSize($font_size -= $decrement);
		}
	}

	function Truncate($string, $limit=28, $break="-", $pad="...") { 
		// return with no change if string is shorter than $limit 
		if(strlen($string) <= $limit) return $string; 
		
		
		$string = substr($string, 0, $limit) . $pad; 

		return $string; 
	}

	function contact_cmp(array $a, array $b){
	/**
	 * Tri des contacts
	 */
		if(strcasecmp($a['role'], $b['role']) == 0){
			return strcasecmp($a['name'], $b['name']);
		}else{
			return strcasecmp($a['role'], $b['role']);
		}
	}

	function AddContenu(){
	/**
	 * Construit le contenu de la page
	 */
		// Police + Positionnement
		$this->Ln();
		$this->SetLineWidth(.3);
		$this->SetX(10);
		
		// Contacts client
		$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
		$this->SetFont('Arial','B',10);
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
			$so_link = CreateObject('phpgwapi.solink');
			$so_link->get_links('spiclient',$this->client['client_id'],'addressbook');
		}else{
			$links = egw_link::get_links('spiclient',$this->client['client_id'],'addressbook');
		}
		if(!empty($links)){
			$this->Cell(0,8,utf8_decode('Contacts '.$this->client['client_company'].' :'),0,2,'L');
			foreach((array)$links as $link_id => $addressbook_id){
				if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
					$so_link = CreateObject('phpgwapi.solink');
					$so_link->get_link($link_id);
				}else{
					$link = egw_link::get_link($link_id);
				}
				$contact = $so_addressbook->read($addressbook_id);
				
				// On ne prends pas les contacts inactifs (définit dans le role)
				$role = $this->so_role->search(array('role_label' => $link['link_remark']), false);
				if(!empty($role) && $role[0]['role_contact_active']){
					$contact_info['n_fn'] = $contact['n_fn'];
					$contact_info['tel_work'] = $contact['tel_work'];
					$contact_info['tel_cell'] = $contact['tel_cell'];
					$contact_info['contact_email'] = $this->Truncate($contact['contact_email']);
					$contact_info['role'] = $link['link_remark'];
					$contacts[] = $contact_info;
				}
			}
		}
		// Tri des contacts pour avoir le meme ordre que sur la vue edit
		usort($contacts,array($this,'contact_cmp'));
		
		// Affichage des contacts
		foreach($contacts as $contact){
			$this->SetFont('Arial','',9);
			$this->Cell(40,5,utf8_decode($contact['n_fn']),0,0,'L');
			$this->Cell(50,5,utf8_decode($contact['role']),0,0,'L');
			$this->Cell(30,5,utf8_decode($contact['tel_work']),0,0,'L');
			$this->Cell(30,5,utf8_decode($contact['tel_cell']),0,0,'L');
			$this->Cell(0,5,utf8_decode($contact['contact_email']),0,1,'L');
		}
			
		// Contrats
		$so_contrat = new so_sql('spiclient','spiclient_contrats');
		$so_type = new so_sql('spiclient','spiclient_contrats_type');
		$so_statut = new so_sql('spiclient','spiclient_contrats_status');
		$this->SetFont('Arial','B',10);
		$contrats = $so_contrat->search(array('contract_client' => $this->client['client_id']),false,'date_end');
		if(!empty($contrats)){
			$this->Cell(0,8,utf8_decode('Contrats :'),0,2,'L');
			foreach((array)$contrats as $contrat){
				$this->SetFont('Arial','B',10);
				$this->Cell($this->GetStringWidth($contrat['contract_title']),5,utf8_decode($contrat['contract_title']),0,0,'L');
				$statut = $so_statut->read($contrat['status_id']);
				$this->Cell(0,5,utf8_decode(' - '.$statut['status_label']),0,1,'L');
				
				$this->SetFont('Arial','',10);
				$type = $so_type->read($contrat['type_id']);
				$this->Cell(0,5,utf8_decode($contrat['contract_period'].' - '.$type['type_label']),0,2,'L');
				$date = 'Date de début : '.date('d/m/Y',$contrat['date_start']);
				$date .= empty($contrat['date_end']) ? '' : ' - Date de fin : '.date('d/m/Y',$contrat['date_end']);
				$date .= empty($contrat['date_renewal']) ? '' : ' - Date de renouvellement : '.date('d/m/Y',$contrat['date_renewal']);
				$this->Cell(0,5,utf8_decode($date),0,2,'L');
				
				$this->Ln(2);
			}
		}

		// Nature techniques
		$this->SetFillColor(230,230,230);
		$so_client_nature = new so_sql('spiclient', 'spiclient_client_nature');
		$so_nature = new so_sql('spiclient', 'spiclient_nature_technique');
		$client_natures = $so_client_nature->search(array('client_id' => $this->client['client_id']),false,'client_nature_ordre');
		foreach((array)$client_natures as $client_nature){
			$nb_ligne = $this->sizeOfText($client_nature['client_nature_description'],95) + $this->sizeOfText($client_nature['client_nature_panne'],95) + $this->sizeOfText($client_nature['client_nature_commentaire'],190);
			$hauteur = ($nb_ligne - 3) * 6 + 24;
			// Si la hauteur restante n'est pas suffisante on change de page
			if($hauteur + $this->GetY() > 277){
				$this->AddPage();
			}
			
			// Entête de la nature technique
			$nature = $so_nature->read($client_nature['nature_id']);
			$this->SetFont('Arial','BU',11);
			$this->Cell(0,6,utf8_decode($nature['nature_label'].' - '.$client_nature['client_nature_titre']),1,1,'C');
			
			// entête description/en cas de panne
			$this->SetFont('Arial','B',10);
			$this->Cell(95,6,utf8_decode("Description"),1,0,'C',1);
			$this->Cell(95,6,utf8_decode("En cas de panne"),1,1,'C',1);
			
			// Contenu description/en cas de panne
			$this->SetFont('Arial','',10);
			$Y = $this->GetY();
			$this->MultiCell(95,5,utf8_decode($client_nature['client_nature_description']),0,'J');
			$finY = $this->GetY();
			$this->SetXY(105,$Y);
			$this->MultiCell(95,5,utf8_decode($client_nature['client_nature_panne']),0,'J');
			$finY = $this->GetY() > $finY ? $this->GetY() : $finY;
			
			// cadre autour du contenu description/en cas de panne (fait apres car necessite de connaitre la hauteur)
			$this->SetY($Y);
			$this->Cell(95,$finY - $Y,'',1,0);
			$this->Cell(95,$finY - $Y,'',1,1);
			
			// entête commentaire
			$this->SetFont('Arial','B',10);
			$this->Cell(0,6,utf8_decode("Commentaire"),1,1,'C',1);
			
			// Contenu commentaire
			$this->SetFont('Arial','',10);
			$this->MultiCell(0,5,utf8_decode($client_nature['client_nature_commentaire']),1,'J');
			
			// Saut de ligne pour passage à la nature technique suivante
			$this->Ln(5);
		}
	}

	function Footer(){
	/**
	 * Construit le bas de la page PDF
	 */
		$this->SetFont('Arial','',8);
		$this->SetY(285);

		if(!empty($this->provider)){
			$this->Cell(0,10,utf8_decode($this->provider['client_company']." - ".lang(date('F')).' '.date('Y')),0,2,'C',0);
		}else{
			$this->Cell(0,10,utf8_decode(lang(date('F')).' '.date('Y')),0,2,'C',0);
		}
		$this->SetXY(195,285);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		$this->SetXY(10,285);
		$this->Cell(10,10,utf8_decode('Imprimé depuis Spiclient'),0,0,'L');
	}
	
	function generate($path = ''){
	/**
	 * Fonction de génération du pdf
	 */
		$this->AliasNbPages();
	
		$this->AddPage();
		$this->AddContenu();

		if($path != ''){	
			$this->Output($path,'F');
		}else{
			$this->Output($this->client['client_company'].'.pdf','I');
		}
	}
}

?>