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

require_once(EGW_INCLUDE_ROOT. '/spifina/fpdf/fpdf.php');


class generate_pdf extends fpdf{

	var $colonnes;
	var $format;
	var $societeEmetteur=array();
	var $societeClient=array();
	var $facture = array();
	var $facture_ui;
	var $lastPage;
	
	
	function generate_pdf_grey(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function __construct($emetteur=array(),$client=array(),$facture_id=array()){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales. $emetteur est un tableau décrivant la socité émettrice
	* $client esu une tableau décrivant la société cliente
	*
	* @param array $emetteur=array()
	* @param array $client=array()
	*/
		define('FPDF_FONTPATH',EGW_INCLUDE_ROOT.'/spifina/fpdf/font/');
		parent::FPDF('P', 'mm', 'A4');
		$this->societeEmetteur=$emetteur;
		$this->societeClient = $client;
		$this->facture_ui = new spifina_ui();
		$this->facture = $this->facture_ui->search(array('facture_id'=>$facture_id),false);
		$this->SetAutoPageBreak(true,40);
		$this->lastPage = false;
		$this->AliasNbPages();

		$ligne_facture = $this->facture_ui->so_factures_details->search(array('facture_id'=>$this->facture[0]['facture_id']),false,'GROUP BY ticket_id');
		foreach($ligne_facture as $ligne){
			if(!empty($ligne['ticket_id'])){
				$ticket = $this->facture_ui->so_ticket->read($ligne['ticket_id']);
				if(!empty($ticket['contract_id'])){
					$contract = $this->facture_ui->so_contrat->read($ticket['contract_id']);

					$this->payeur = $this->facture_ui->so_client->read($contract['contract_payer']);
					$this->mandataire = $this->facture_ui->so_client->read($contract['contract_attorney']);
					break;
				}
			}
		}
	}

	function Header(){
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$this->facture[0]['societe_id']),false);
		// $ville=explode(' ',$facture_emeteur[0]['client_locality']);
		
		$this->AddTop();
		$this->addLeft($this->facture[0]);

		// if(!$this->lastPage && $this->PageNo() != 1){
		// 	// $this->addInfo($this->facture[0]['invoice_message']);
		// 	$this->addEnteteTableau($this->facture[0]['facture_tva']);
		// }
	}
	
	function Footer(){
	/**
	* Construit le bas de la page PDF
	*/
		$pos = 35;
		if(empty($this->facture_ui->obj_config['invoice_payment']) || $this->facture_ui->obj_config['invoice_payment'] == '<br />'){
			$pos -= 10;
		}
		if(empty($this->facture_ui->obj_config['invoice_property']) || $this->facture_ui->obj_config['invoice_property'] == '<br />'){
			$pos -= 10;
		}

		$this->SetY(-1*$pos);
		$this->SetFont('Arial','',8); 
		$this->Cell(0,4,'Page '.$this->PageNo().'/{nb}',0,0,'C'); 
		$this->Ln(4);
		$this->SetFont('Arial','',8);
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_footer_one']),0,0,'C');
		$this->Ln(4);
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_footer_two']),0,2,'C');

		$startY = $this->getY();
		$startX = $this->getX();

		if(!empty($this->facture_ui->obj_config['invoice_payment']) && $this->facture_ui->obj_config['invoice_payment'] != '<br />'){
			$this->MultiCell(0,4,utf8_decode(lang('PAYMENT').' : '.str_replace('<br />', "\n", $this->facture_ui->obj_config['invoice_payment'])),0,$formText);

			$newY = $this->getY();
			$this->setXY($this->getX(),$newY);
		}

		if(!empty($this->facture_ui->obj_config['invoice_property']) && $this->facture_ui->obj_config['invoice_property'] != '<br />'){
			$this->MultiCell(0,4,utf8_decode(lang('PROPERTY').' : '.str_replace('<br />', "\n", $this->facture_ui->obj_config['invoice_property'])),0,$formText);
		}
	}   
   
	function addTop(){
	/**
	* Construit les champs concernant les entreprises du PDF
	*/
		$this->SetXY(10,8);
		

		// Info Emetteur facture
		$this->SetFont('Arial','B', 16);
		$this->Cell(104.3,7,utf8_encode($this->societeEmetteur['client_structure'].' '.$this->societeEmetteur['client_company']),0,2,'L',0);

		$this->SetFont('Arial','I',12);
		$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_adr_one_street']),0,1,'L',0);
		if(!empty($this->societeEmetteur['client_adr_two_street']))
			$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_adr_two_street']),0,1,'L',0);
		$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_postalcode']." ".$this->societeEmetteur['client_locality']),0,1,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('Tel').' : '.$this->societeEmetteur['client_tel']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('Fax').' : '.$this->societeEmetteur['client_fax']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('Mail').' : '.$this->societeEmetteur['client_manager_email']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('Website').' : '.$this->societeEmetteur['client_website']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_footer_one']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('SIRET').' : '.$this->societeEmetteur['client_siret']),0,2,'L',0);
		// $this->Cell(104.3,4,utf8_decode(lang('N° Formation').' : '.$this->societeEmetteur['client_training']),0,1,'L',0);
		
		// Info facture (ID + Date)
		// $this->Ln();
		// if(!empty($this->facture[0]['send_date'])){
		// 	$this->Cell(70,4,utf8_decode(lang('Invoice num.').' '.$this->facture[0]['facture_number'].' '.lang('of the').' '.date('d/m/Y',$this->facture[0]['send_date'])),0,2,'L',0);
		// }else{
		// 	$this->Cell(70,4,utf8_decode(lang('Invoice num.').' '.$this->facture[0]['facture_number']),0,2,'L',0);
		// }
		$this->SetFont('Arial','',10);
		$this->Cell(70,4,utf8_decode(lang("Tel").": ".$this->societeEmetteur['client_tel']),0,2,'L',0);

		$this->SetFont('Arial','',10);

		$this->SetXY(130,10);

		$this->Cell(20,5,utf8_decode(lang('Invoice number').' :'),0,2,'R');
		$this->Cell(20,5,utf8_decode(lang('Date').' :'),0,2,'R');
		$this->Cell(20,5,utf8_decode(lang('Deadline').' :'),0,2,'R');
		$this->Cell(20,5,utf8_decode(lang('Account').' :'),0,2,'R');

		$this->SetXY(150,10);
		$this->Cell(40,5,utf8_decode($this->facture[0]['facture_number']),0,2);
		if ($this->facture[0]['send_date']>0){
			$this->Cell(40,5,utf8_decode(date('d/m/Y',$this->facture[0]['send_date'])),0,2);
		}
		else {
			$this->Cell(40,5,"",0,2);
		}
		
		$client_bo = CreateObject("spiclient.client_bo");
		$delai_paiement=$client_bo->get_delai_paiement();
		
		$societe = $this->facture_ui->so_client->search(array('client_id'=>$this->facture[0]['societe_id']),false);
		$relationClientSociete = $this->facture_ui->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$this->facture[0]['client_id']),false);
		$delai = $delai_paiement[$relationClientSociete[0]['payment_model']];
		$this->Cell(40,5,utf8_decode($delai),0,2);
		if (!empty($this->societeClient['client_code_tiers'])){
			$this->Cell(40,5,utf8_decode($this->societeClient['client_code_tiers']),0,2);
		}

		// Info payeur
		$this->SetXY(105,50);
		// $this->payeur = $this->facture_ui->so_client->read($this->societeClient['client_payer']);
		
		if(!empty($this->societeClient['client_adr_one_street_facturation'])){
			$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_one_street_facturation']),0,2,'L',0);

			if(!empty($this->societeClient['client_adr_two_street_facturation']))
				$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_two_street_facturation']),0,2,'L',0);

			if(!empty($this->societeClient['client_adr_three_street_facturation']))
				$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_three_street_facturation']),0,2,'L',0);

			$this->Cell(100,4,utf8_decode($this->societeClient['client_postalcode_facturation']." ".$this->societeClient['client_locality_facturation']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($this->societeClient['client_country_facturation']),0,1,'L',0);
		}else{
			$this->Cell(100,4,utf8_decode($this->societeClient['client_company']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_one_street']),0,2,'L',0);
			
			if(!empty($this->societeClient['client_adr_two_street']))
				$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_two_street']),0,2,'L',0);

			// $this->Cell(100,4,utf8_decode($societeClient['client_adr_three_street_facturation']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($this->societeClient['client_postalcode']." ".$this->societeClient['client_locality']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($this->societeClient['client_country']),0,2,'L',0);
		}

		$receiver = "";
		if(!empty($this->societeClient['client_last_name']) || !empty($this->societeClient['client_first_name'])){
			$receiver = lang("For the attention of")." ".$this->societeClient['client_first_name']." ".$this->societeClient['client_last_name'];
		}
		$receiver = utf8_decode($receiver);

		$length = $this->GetStringWidth($receiver);
		$this->Cell($length,4,$receiver);

	}

	function addLeft($facture){
		// $this->SetXY(105,60);
		$this->Ln(8);
		// Spirea YLF - 28/04/2011 - On récupère le code opération depuis la table client_relation
		$so_clients_relations =& CreateObject('etemplate.so_sql');
		$so_clients_relations->so_sql('spiclient','spiclient_relations');
		$clientRelation = $so_clients_relations->search(array('societe_id'=>$this->societeEmetteur['client_id'],'client_id'=>$this->societeClient['client_id']),false);
		if(!empty($clientRelation)){
			$operation_code = $clientRelation[0]['operation_code'];
		}
		// $parc=utf8_decode("N/réf : ".$this->societeClient['client_operation_code']." - ".$numeroFacture);
		// $parc=utf8_decode("N/réf : ".$operation_code." - ".$numeroFacture);
		if (!empty($operation_code)){
			$parc = "N/réf : ".$operation_code;
		}

		$this->Cell(0,4,utf8_decode($parc),0,0,'L',0);
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_locality'].", ".lang('on'))." ".strftime('%d %B %Y',$facture['send_date']),0,1,'R',0);
		$this->Ln();

		
		$this->SetFont('','BU');
		if($facture['total_ht'] > 0){
			$this->Cell($this->GetStringWidth(utf8_decode(lang('Facture n° :'))),4,utf8_decode(lang('Facture n° :')),0,0,'L',0);
		}else{
			$this->Cell($this->GetStringWidth(utf8_decode(lang('Avoir n° :'))),4,utf8_decode(lang('Avoir n° :')),0,0,'L',0);
		}

		$this->SetFont('','B');
		$this->Cell(0,4,utf8_decode(' '.$facture['facture_number']),0,1,'L',0);
		
		$this->SetFont('','');
	} 
	
	function addInfo($message){
	/** 
	 * Ajoute le message de la facture dans le PDF
	 *
	 * @param String
	 */
		$this->SetXY(10, $this->GetY() - 28);
		// $this->Ln(2);
		$message = utf8_decode($message);
		$this->MultiCell(90,4,$message,'','L',0);
	}
	
	function AddModeReglement($reglement){
	/**
	* Ajoute un mode de règlement dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $reglement
	*/
		// $this->SetXY(10, $this->GetY() - 18);
		$this->Ln();
		// $x1 = 20;
		// $this->SetX($x1);
		$reglement=utf8_decode($reglement);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($reglement);
		$this->Cell($length,2,$reglement);
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
			$length = floor( $this->GetStringWidth($ligne));
			$res = 1 + floor($length / $largeur);
			$nb_lines += $res;
		}
		return $nb_lines;
	}

	function addCols($tab){
	/**
	* Ajoute les colonnes $tab dans le PDF
	*
	* @param array $tab
	*/
		global $colonnes;
		$r1 = 5;
		$r2 = $this->w - ($r1 * 2) ;
		$y1 = 50;
		$y2 = $this->h - 50 - $y1;
		$this->SetXY( $r1, $y1 );
		$colX = $r1;
		$colonnes = $tab;
		while(list($lib,$pos) = each($tab)){
			$this->SetXY( $colX, $y1+2 );
			$colX += $pos;
		}
	}

	function addLineFormat($tab){
	/**
	* Modifie le format des lignes par le format $tab
	*
	* @param array $tab
	*/
		global $format, $colonnes; 
		while(list($lib,$pos) = each ($colonnes)){
			if(isset($tab["$lib"])){
				$format[ $lib ] = $tab["$lib"];
			}
		}
	}

	function addEnteteTableau($ticket=true){
		if($ticket){
			$header= array(lang('N°'),lang('Closed on'),lang('Category'),lang('Status'),lang('Amount'));
			$w = array(15,30,45,70,30);
		}else{
			$header= array(lang('Label'),lang('Quantity'),lang('Amount'));
			$w = array(130,30,30);
		}
		
		// $this->Ln(5);
		$this->SetFillColor(216,228,232);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		for($i=0;$i<count($header);$i++){
			$align = 'L';
			if($i == count($header)-1){
				$align = 'R';
			}
			if($header[$i] == lang('Quantity')){
				$align = 'C';
			}
			$this->Cell($w[$i],7,utf8_decode($header[$i]),0,0,$align,0);
		}
		
		$this->yHeader = $this->GetY();
		
		$this->Ln();
	}
	
	function addLine($colone,$ligne,$tab,$trace_ligne=0){
	/**
	* Ajoute une ligne de texte dans les colonnes $colone, ligne $ligne, et précise si on doit ajouter un séparateur de ligne
	*
	* @param array $colone
	* @param int $ligne
	* @param array $tab
	* @param bool $trace_ligne=0 tracer les séparateurs
	*/
		global $colonnes, $format;
		$ordonnee = $colone;
		$maxSize = $ligne;
		reset($colonnes);
		$longTotal=0;
		while(list($lib,$pos) = each($colonnes)){
			$longCell = $pos -2;
			$texte = $tab[ $lib ];
			$length = $this->GetStringWidth($texte);
			$tailleTexte = $this->sizeOfText($texte,$length);
			$formText  = $format[$lib];
			$this->SetXY($ordonnee, $ligne-1);
			$this->MultiCell($longCell,4,$texte,0,$formText);
			$longTotal+=$longCell;
			if($maxSize < ($this->GetY())){
				$maxSize = $this->GetY() ;
			}
			$ordonnee += $pos;
		}
		if($trace_ligne==1){
			$this->Ln(0);
			$this->Line(108,$this->GetY(),113+$longTotal,$this->GetY());
		}
		if($trace_ligne==2){
			$this->Ln(1);
			$this->Line(108,$this->GetY(),113+$longTotal,$this->GetY());
			$this->Ln(1);
			$this->Line(108,$this->GetY(),113+$longTotal,$this->GetY());
		}
		return ($maxSize - $ligne);
	}

	function IncludeJS($script) {
	/**
	* Ajoute le javascript à l'objet courant
	*
	* @param string $script
	*/
        $this->javascript=$script;
    }

    function _putjavascript() {
	/**
	* Ajoute le javascript dans le PDF
	*/
		$this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
	/**
	* Ajoute les ressources (javascript et ressources PDF) dans le PDF courant
	*/
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
	/**
	* Ajoute le catalogues des objets utilisés (PDF et javascript) dans le PDF courant
	*/
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
	
	function AutoPrint($dialog=false){
	/**
	* Lance la boîte d'impression ou imprime immediatement sur l'imprimante par défaut
	*
	* @param bool $dialog=false true pour imprimer sans boite de dialogue
	*/
		$param=($dialog ? 'true' : 'false');
		$script="print($param);";
		$this->IncludeJS($script);
	}

	function AutoPrintToPrinter($server, $printer, $dialog=false){
	/**
	* Imprime sur une imprimante partagée (requiert Acrobat 6 ou supérieur)
	*
	* @param bool $server serveur où se trouve l'imprimante
	* @param string $printer imprimante sur laquelle on souhaite imprimer
	* @param bool $dialog=false true pour imprimer sans boite de dialogue
	*/
		$script = "var pp = getPrintParams();";
		if($dialog)
			$script .= "pp.interactive = pp.constants.interactionLevel.full;";
		else
			$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
		$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
		$script .= "print(pp);";
		$this->IncludeJS($script);
	}

	function AddResolutionTicket($date){
	/**
	* Ajoute un ticker résolu dans le PDF
	*
	* @param date $date
	*/
		$x1 = 10;
		$y1 = 100;
		// $txt=utf8_decode(strtoupper("Résolutions des tickets de demande")." - ").strtoupper($date);
		$txt=utf8_decode("Résolutions des tickets - ").ucfirst($date);
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','BU',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
	}
	
	function AddInformation($infos){
	/**
	* Ajoute une information dans le PDF
	*
	* @param string $infos
	*/
		$x1 = 10;
		$y1 = 110;
		$txt=utf8_decode("Tickets de demande renseignés dans spifina* (intra.spirea.fr)");
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetFont('Arial','',10);
		foreach($infos as $id=>$value){
			$y1=$y1+4;
			$this->SetXY($x1,$y1);
			$length = $this->GetStringWidth($id);
			$this->Cell($length,2,utf8_decode("-  ".$id),0,0);
			$length = $this->GetStringWidth($value);
			$this->SetX($x1+150);
			$this->Cell($length,2,utf8_decode($value),0,0,'R');
		}
	}
	
	function AddInformationTicketFermes($TicketsFermeDansLaPeriodeDansFacture){
	/**
	* Ajoute les tickets fermés dans le PDF
	*
	* @param date $TicketsFermeDansLaPeriodeDansFacture définit la date à laquelle on ajoute les tickets fermés
	*/
		$x1 = 10;
		$y1 = 138;
		$txt=utf8_decode(lang("Closed tickets during period"));
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetFont('Arial','',10);
		foreach($TicketsFermeDansLaPeriodeDansFacture as $id=>$value){
			// if(!empty($id)){
				$y1=$y1+4;
				$this->SetXY($x1,$y1);
				$length = $this->GetStringWidth($id);
				$this->Cell($length,2,utf8_decode("-  ".$id),0,0);
				$length = $this->GetStringWidth($value);
				$this->SetX($x1+150);
				$this->Cell($length,2,utf8_decode($value),0,0,'R');
			// }
		}
	}
	
	function AddInformationTicketFermesHorsFacture($TicketsFermeDansLaPeriodeHorsFacture){
	/**
	* Ajoute les tickets fermés dans le PDF
	*
	* @param date $TicketsFermeDansLaPeriodeHorsFacture définit la date à laquelle on ajoute les tickets fermés en dehors de la période passé en argument (donc non encore comptés dans la facture)
	*/
		$x1 = 10;
		$y1 = $this->GetY()+12;
		$txt=utf8_decode(lang("Closed tickets during the period but not counted with this invoice"));
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetFont('Arial','',10);
		foreach($TicketsFermeDansLaPeriodeHorsFacture as $id=>$value){
			if(!empty($id)){
				$y1=$y1+4;
				$this->SetXY($x1,$y1);
				$length = $this->GetStringWidth($id);
				$this->Cell($length,2,utf8_decode("-  ".$id),0,0);
				$length = $this->GetStringWidth($value);
				$this->SetX($x1+150);
				$this->Cell($length,2,utf8_decode($value),0,0,'R');
			}
		}
	}

	function AddLegende(){
	/**
	* Ajoute une légende dans le PDF
	*/
		$this->Ln(10);
		$x1 = 10;
		$this->SetX($x1);
		$txt='Les tickets "résolu par suivi" sont résolus dans le cadre du forfait de maintenance';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 10;
		$this->SetX($x1);
		$txt='Les tickets "résolu par assistance à distance" font l\'objet d\' une facturation dans la rubrique "assitance à distance".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 10;
		$this->SetX($x1);
		$txt='Les tickets "résolu par intervention urgente" font l\'objet d\' une facturation dans la rubrique "interventions non planifiées".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 10;
		$this->SetX($x1);
		$txt='* SPID : Spirea-Demandes - logiciel de gestion de tickets de demande';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
	}
	
	function AddRappelTarif($txt){
	/**
	* Ajoute un rappel de tarif dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $txt
	*/
		$this->Ln(10);
		$x1 = 10;
		$this->SetX($x1);
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
	}

	// function AcceptPageBreak(){
	// 	$this->newPage = true;
	// }

	function generate($id,$facture_ui,$simul=false){
	/**
	* Imprime sur une imprimante partagée (requiert Acrobat 6 ou supérieur)
	*
	* @param $id
	* @param $facture_ui
	* @param $simul : par défaut false, mais si vrai, alors on sauvegarde pas la facture et on met "SIMULATION" en filigrame
	*/		
		$facture=$this->facture_ui->search(array('facture_id'=>$id),false);
		$societe=$this->facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete=$this->facture_ui->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
		
		if($simul){
			$content = $facture_ui->get_info($id);
			$ligne_facture = $content['ticket'];
		}else{
			$join = 'WHERE ticket_id <> 0';
			$ligne_facture = $facture_ui->so_factures_details->search(array('facture_id'=>$facture[0]['facture_id']),false,'GROUP BY ticket_id','',$wildcard,false,$op,$start,$query['col_filter'],$join);	
		}

		$LignePerso = array();
		$LignePerso = $this->facture_ui->get_line($facture[0]['facture_id']);

		foreach($ligne_facture as $cle=>$value){
			if($value['total_ht'] != 0){
				// Gestion TVA - PDF Simuler (pas encore en base donc on reprend l'info de la facture - uniquement pour les tickets)
				if($simul){
					$so_vat = new so_sql('spireapi','spireapi_vat');
					$tva = $so_vat->read($content['facture_tva_id']);
					
					$value['vat_rate'] = $tva['vat_rate'];
				}
				$tab_tva[$value['vat_rate']] += $value['total_ht'];
			}
			
			if(empty($value['extra_rank'])){
				$label=$facture_ui->so_etats->search(array('state_id'=>$value['state_id']),'facturation_label');
				
				// code tch
				if(isset($label[0]['facturation_label']) && !empty($label[0]['facturation_label'])){
					$ligne_facture[$cle]['label']=$label[0]['facturation_label'];
				}else{
					$ligne_facture[$cle]['label'] = "Pas de libellé";
				}
				$ligne_facture[$cle]['label']=$label[0]['facturation_label'];
				$ticket = $facture_ui->so_ticket->search(array('ticket_id'=>$value['ticket_id']),false);
				
				$ligne_facture[$cle]['ticket_cat']= $facture_ui->getCat_Label($ticket[0]['cat_id']);
				
					// _debug_array($cat_ticket);exit;
					switch($ticket[0]['ticket_unit_time']){
						case 0:
							$ligne_facture[$cle]['unit'] = 'mn';
							break;
						case 1:
							$ligne_facture[$cle]['unit'] = 'h';
							break;
						case 2:
							$ligne_facture[$cle]['unit'] = 'd';
							break;
					}
					$ligne_facture[$cle]['ticket_title']=$ticket[0]['ticket_title'];
			}
		}

		$FacturationTableau=array();
		foreach($ligne_facture as $cle=>$value){
			if($value['ticket_id']>0){
				$FacturationTableau[] = $value;
			}
		}

		$this->facture = $facture;
		
		//Spirea YLF - 28/04/2011 - Modification pour utiliser la valeur societe_id qui est remplit à la création de la facture
		// cette variable contient l'id de l'entreprise que l'on aura choisit comme etant émettrice de la facture
		$facture_client=$this->facture_ui->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$prix_parametre='';
		
		$client_bo = CreateObject("spiclient.client_bo");
		$delai_paiement=$client_bo->get_delai_paiement();
		$modele_paiement=$client_bo->get_mode_reglement();

		$modePaiementClient= lang('Payment by').' '.$modele_paiement[$facture_client[0]['client_mode_reglement']].', '.$delai_paiement[$relationClientSociete[0]['payment_model']];

		setlocale(LC_ALL, 'fr_FR');
		$ville=explode(' ',$facture_emeteur[0]['client_locality']);
		
				
		$label_RappelTarif=sprintf(lang("Rate: %s EUR / answered call, the edge of half an hour"),$this->facture_ui->obj_config['initial_price']);
		// _debug_array($facture);
		$montantHT=lang('Montant H.T.')." ";
		// $montantTVA=lang('T.V.A.')." 19,6% ";
		$montantTVA=lang('T.V.A.').' '.$facture[0]['facture_taux_tva'].'% ';
		$montantTTC=lang('Montant T.T.C.')." ";
		
		$this->AddPage();

		if(!$this->lastPage){
			$this->Ln(5);
		}
		
		// Si simulation, ajout fond simulation
		if($simul == 1){
			$this->Image('spifina/templates/default/images/simulation.jpg',0,$this->getY(),200);
		}elseif($simul == 2){
			$this->Image('spifina/templates/default/images/proforma.jpg',0,$this->getY(),200);
		}
		
		$w = array(15,30,45,70,30);
		$this->SetLineWidth(.3);
		
		$this->SetFillColor(224,235,255);
		$this->SetFont('');

		$tab_tva = array();		

		if(!empty($FacturationTableau)){
			$this->SetFont('','BU');
			$this->Cell(0,4,utf8_decode(lang('invoice tickets')),0,2,'L');

			$this->addEnteteTableau(true);

			$this->checkTicket = true;
			$total_ticket = 0;
			foreach($FacturationTableau as $id => $data){
				$vat_rate = $data['vat_rate'];
				if($simul){
					$so_vat = new so_sql('spireapi','spireapi_vat');
					$tva = $so_vat->read($content['facture_tva_id']);
					
					$vat_rate = $tva['vat_rate'];
				}

				$tab_tva[$vat_rate] += $data['total_ht'];

				$fields = '*';
				if($this->facture_ui->obj_config['synchro_presta']){
					$join = 'LEFT JOIN egw_prestation P ON P.lettre_de_commande = spid_tickets.ticket_client_order_id LEFT JOIN egw_contact C ON C.id_ben = P.id_ben LEFT JOIN egw_contact_parcours_pro PP ON C.id_ben = PP.id_ben';
					$fields = 'spid_tickets.*,nom_complet,id_presta,P.date_debut,P.date_fin,identifiant,date_fin_reelle';
				}
				$ticket = $this->facture_ui->so_ticket->search(array('ticket_id'=>$data['ticket_id']),$fields,'ticket_id ASC','','',false,'OR',false,'',$join);

				$this->SetFont('','');

				// Libellé
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[0],7,utf8_decode($ticket[0]['ticket_num_group']),'','L',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				// Date de fermeture
				$startY = $this->getY();
				if(!empty($ticket[0]['closed_date'])){
					$this->MultiCell($w[1],$newY-$startY,utf8_decode(date('d/m/Y',$ticket[0]['closed_date'])),'','L',0);
				}else{
					$this->MultiCell($w[1],$newY-$startY,'-','','L',0);
				}
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				// Catégorie
				$startY = $this->getY();
				$this->MultiCell($w[2],$newY-$startY,utf8_decode($data['ticket_cat']),'','L',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1]+$w[2],$startY <= 250 ? $startY : $newY-7);

				// Statut
				// SPIREA-YLF -- A remettre au propre (doublon de facture_bo.get_info)
				$obj_ticket = CreateObject('spid.spid_ui');
				$param_etat = $this->facture_ui->so_prix_parametres->search(array('client_id'=>$ticket[0]['client_id'],'state_id'=>$ticket[0]['state_id']),false);
				// _debug_array($param_etat);
				$param_etat_contrat = $this->facture_ui->so_prix_parametres->search(array('contract_id'=>empty($ticket[0]['contract_id']) ? -1 : $ticket[0]['contract_id'],'state_id'=>$ticket[0]['state_id']),false);
				
				$temps_ticket = $ticket[0]['ticket_spend_time'];
				$unit_time = $ticket[0]['ticket_unit_time'];
				if(!empty($param_etat_contrat)){
					// Verif prix contrat
					if($param_etat_contrat[0]['ticket_spend_time'] == 0){
						//$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
						$temps_passe = "forfait";
					}else{
						$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat_contrat[0]['ticket_spend_time']);
					}
				// Verif prix client
				}
				elseif($param_etat[0]['ticket_spend_time'] == 0){
					// Si le param etat est vide on passe ici aussi
					// $temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
					$temps_passe = "Forfait";
				}else{
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time,$param_etat[0]['ticket_spend_time']);
				}
				if(empty($param_etat)){
					$temps_passe = $obj_ticket->calcul_temps($temps_ticket,$unit_time);
				}

				switch($ticket[0]['ticket_unit_time']){
					case 0:
						$unit = lang('mn');
						break;
					case 1:
						$unit = lang('h');
						break;
					case 2:
						$unit = lang('d');
						break;
				}
				$data['ticket_time_bracket'] = $temps_passe;
				$data['unit'] = $unit;
				// FIN SPIREA-YLF
				
				if ($data['ticket_time_bracket'] > 0){
					$data['ticket_time_bracket'] = $data['ticket_time_bracket'].' '.$unit;
				}
				$data['ticket_cat'] = (strlen($data['ticket_cat']) > 25) ? substr($data['ticket_cat'],0,25).'...' : $data['ticket_cat'];
				
				$data['label'] = (strlen($data['label']) > 45) ? substr($data['label'],0,45).'...' : $data['label'];
				$data['label'] = $data['label'] . " (".$data['ticket_time_bracket'].')';

				$startY = $this->getY();
				// $this->MultiCell($w[3],$newY-$startY,utf8_decode($data['state_name'].' ('.$data['ticket_time_bracket'].' '.$data['unit'].')'),'','L',0);
				$this->MultiCell($w[3],$newY-$startY,utf8_decode($data['label']),'','L',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1]+$w[2]+$w[3],$startY <= 250 ? $startY : $newY-7);
				
				// Montant
				$startY = $this->getY();
				$this->MultiCell($w[4],$newY-$startY,utf8_decode(number_format($data['total_ht'],2,'.',' ').' EUR HT'),'','R',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				$this->setY($newY);

				$total_ticket += $data['total_ht'];
			}

			$this->SetFont('','B');
			$startY = $this->getY();
			$this->MultiCell($w[0]+$w[1]+$w[2]+$w[3],7,utf8_encode(lang('Sub-total tickets')),'','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1]+$w[2]+$w[3],$startY <= 250 ? $startY : $newY-7);
			$this->MultiCell($w[4],7,number_format($total_ticket,2,'.',' ').' EUR HT','','R',0);
		}
		$this->checkTicket = false;

		$this->Ln(4);

		//Spirea YLF - 09/08/2011 - traitement des lignes personnalisées
		$w = array(130,30,30);
		$total_lp = 0;
		if(!empty($LignePerso)){
			$this->checkPerso = true;
			$so_cat = new so_sql('spireapi','spireapi_facture_categories');
			foreach($LignePerso as $id => $data){
				if(!empty($data['extra_cat_id'])){
					$cat = $so_cat->read($data['extra_cat_id']);
					$label_paragraphe[$cat['cat_label']] = $cat['cat_label'];
				}
			}
			unset($so_cat);
			$label = implode(', ',$label_paragraphe);

			$this->SetFont('','BU');
			$this->Cell(0,4,utf8_decode($label),0,2,'L');

			$this->addEnteteTableau(false);
			foreach($LignePerso as $id => $data){
				$this->SetFont('','');

				if(!empty($data['extra_ref'])) $tab_label[] = $data['extra_ref'];
				if(!empty($data['extra_label'])) $tab_label[] = $data['extra_label'];
				if(!empty($data['extra_ns'])) $tab_label[] = lang('S/N').': '.$data['extra_ns'];
				$label = '';
				if(!empty($tab_label)){
					$label = '- '.implode("\n",$tab_label);
				}

				// Label
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[0],4,utf8_decode($label),'','L',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				// Quantite
				$startY = $this->getY();
				$this->MultiCell($w[1],$newY-$startY,utf8_decode($data['quantity']),'','C',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				// Montant
				$startY = $this->getY();
				$startX = $this->getX();
				if($data['extra_ht'] != 0){
					$this->MultiCell($w[1],$newY-$startY,utf8_decode(number_format($data['extra_ht'],2,'.',' ').' EUR HT'),'','R',0);
				}else{
					$this->MultiCell($w[1],$newY-$startY,utf8_decode('-'),'','R',0);
				}
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				$total_lp += $data['extra_ht'];
				$this->setY($newY);
				$this->SetFont('');

				$tab_tva[$data['vat_rate']] += $data['extra_ht'];
				$this->Ln(2);
				unset($tab_label);
				
						// Ajout d'une page si le bloc des totaux ne rentre pas
						if($this->GetY() > 257){
							$this->AddPage();
						}
				
			}

			$this->SetFont('','B');
			$startY = $this->getY();
			$this->MultiCell($w[0]+$w[1],7,utf8_decode(lang('Sub-total custom')),0,'R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
			$this->MultiCell($w[2],$newY-$startY,number_format($total_lp,2,'.',' ').' EUR HT','','R',0);
		}
		$this->checkPerso = false;

		$total_tva = $facture[0]['facture_tva'] ? ($total_ticket+$total_lp)*$facture[0]['facture_taux_tva']/100 : '';

		// Ajout d'une page si le bloc des totaux ne rentre pas
		if(7 * (count($tab_tva) + 4) + $this->GetY() > 257){
			$this->AddPage();
		}

		/*** Sous totaux TVA ****/
		$posY = $this->GetY();
		$this->Ln(2);
		if($facture[0]['facture_tva']){
			$w = array(130,30,30);
			$this->SetFont('','B',10);
			$this->SetFillColor(255,255,255);

			$startY = $this->getY();
			$this->MultiCell($w[0],7,'','','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);

			$startY = $this->getY();
			$this->MultiCell($w[1],7,lang('Base HT'),'','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

			$startY = $this->getY();
			$this->MultiCell($w[2],7,lang('VAT amount'),'','R',0);
			// $newY = $this->getY();
			// $this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY);

			$this->SetFont('');
			$total_tva = 0;
			foreach ($tab_tva as $taux => $montant_ht) {
				$montant_tva = $taux==0 ? 0 : $montant_ht * $taux / 100;
				
				$startY = $this->getY();
				
				$this->SetFont('','B');
				if(!empty($taux)){
					$this->MultiCell($w[0],7,utf8_decode(lang('VAT').' '.$taux.' %'),'','R',0);
				}else{
					$this->MultiCell($w[0],7,utf8_decode(lang('No VAT')),'','R',0);
				}
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				$this->SetFont('','');
				$startY = $this->getY();
				// if(!empty($montant_ht)){
					if(is_numeric($montant_ht)){
						$this->MultiCell($w[1],7,number_format($montant_ht,2,'.',' ').' EUR',0,'R',0);
					}else{
						$this->MultiCell($w[1],7,$montant_ht,0,'R',0);
					}
				// }else{
				// 	$this->MultiCell($w[1],7,'-',1,'R',$fill);
				// }
				
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
				if($montant_tva != 0){
					$this->MultiCell($w[2],7,number_format($montant_tva,2,'.',' ').' EUR',0,'R',0);
				}else{
					$this->MultiCell($w[2],7,'-',0,'R',0);
				}
				$fill = $fill ? false : true;

				$total_tva += $montant_tva;
			}
		}
		/**** FIN - Sous totaux TVA ****/

		$this->Line(115, $this->GetY(), 200, $this->GetY());
		
		if($facture[0]['facture_tva']){
			$total = array(
				lang('Total HT') => $total_ticket+$total_lp,
				lang('VAT Total') => $total_tva,
				lang('Total TTC')=> $total_ticket+$total_lp+$total_tva,
			);
		}else{
			$total = array(
				lang('Sub-Total HT') => $total_ticket+$total_lp,
				lang('Total TTC')=> $total_ticket+$total_lp+$total_tva,
			);
		}
		$fill = true;
		$this->SetFillColor(224,235,255);
		// $w = array(130,30,30);
		foreach($total as $label => $valeur){
			
			$startY = $this->getY();
			
			$this->SetFont('','B');

			$this->MultiCell($w[0],7,utf8_decode($label),'','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
					

			// if(!empty($valeur)){
				$this->MultiCell($w[1]+$w[2],7,number_format($valeur,2,'.',' ').' EUR',0,'R',0);
			// }else{
			// 	$this->MultiCell($w[1]+$w[2],7,'',1,'R',$fill);
			// }
			$this->SetFont('');
			$fill = $fill ? false : true;
		}

		// Info bancaire
		// $client_bank = empty($this->mandataire) ? $this->societeEmetteur : $this->mandataire;

		// $this->SetXY(10,$posY+5);
		// $this->SetFont('','B',9);
		// $this->SetFillColor(255,255,255);
		// $this->Cell(100,6,utf8_decode(lang('Bank informations').' - '.$client_bank['client_company']),'LTR',2,'L',1);

		// $this->SetFont('','',10);
		// $this->Cell(100,6,utf8_decode(lang('IBAN').' : '.$client_bank['client_iban']),'LR',2,'L',1);
		// $this->Cell(100,6,utf8_decode(lang('BIC').' : '.$client_bank['client_bic']),'LRB',0,'L',1);

		$this->addInfo($this->facture[0]['invoice_message']);
		$this->AddModeReglement($modePaiementClient);

		// génération de la page de statistiques (si alone invoice = 0)
		if($facture[0]['alone_invoice']==0){
			$infos=array(
				lang('Ticket number open at start period')	=> $facture[0]['nb_open_start'],
				lang('Ticket number open during period')	=> $facture[0]['nb_open_during'],
				lang('Ticket number closed during period')	=> $facture[0]['nb_close_during'],
				lang('Ticket number open at end period')	=> $facture[0]['nb_open_end'],
			);
			$ticket_ferme = $facture_ui->get_type_ticket();
			$infos_ticket_ferme = array();
			$account_id = $facture[0]['account_id'];
			$start_period_date = $facture[0]['start_period_date'];
			$end_period_date = $facture[0]['end_period_date'];
			foreach($ticket_ferme as $cle=>$value){
				$nb_ticket = $facture_ui->get_nombre_ticket_par_etat($cle,$account_id,$start_period_date,$end_period_date);
				if($nb_ticket>0){
					$infos_ticket_fermes[$value]=$nb_ticket;
					$TicketsFermeDansLaPeriode[$cle]=$nb_ticket;
				}
			}
		
			$TicketsFermeDansLaPeriodeHorsFacture = array_diff_key($TicketsFermeDansLaPeriode, $nbTicketsParEtatDansLaFacture);
			$TicketsFermeDansLaPeriodeDansFacture = $nbTicketsParEtatDansLaFacture;
			foreach($TicketsFermeDansLaPeriodeHorsFacture as $cle=>$value){
				$TicketsFermeDansLaPeriodeHorsFacture[$ticket_ferme[$cle]]=$value;
				unset($TicketsFermeDansLaPeriodeHorsFacture[$cle]);
			}
			foreach($TicketsFermeDansLaPeriodeDansFacture as $cle=>$value){
				$TicketsFermeDansLaPeriodeDansFacture[$ticket_ferme[$cle]]=$value;
				unset($TicketsFermeDansLaPeriodeDansFacture[$cle]);
			}
			natcasesort($TicketsFermeDansLaPeriodeHorsFacture);
			natcasesort($TicketsFermeDansLaPeriodeDansFacture);

				
			$this->AddPage();
			// $this->addSociete();
			// $this->addClient();
			// $this->addReference($facture[0]['facture_number']);
			// $this->addDate($ville[0],strftime('%d %B %Y',$facture[0]['send_date']));
			if(date('m',$facture[0]['start_period_date'])!=date('m',$facture[0]['end_period_date'])){
				$dateST=strftime('%B %Y',$facture[0]['start_period_date']).' - '.strftime('%B %Y',$facture[0]['end_period_date']);
			}else{
				$dateST=strftime('%B %Y',$facture[0]['end_period_date']);
			}
			$this->AddResolutionTicket($dateST);
			$this->AddInformation($infos);
			
			if(count($TicketsFermeDansLaPeriodeDansFacture)>=1){
				$this->AddInformationTicketFermes($TicketsFermeDansLaPeriodeDansFacture);
			}
			
			if(count($TicketsFermeDansLaPeriodeHorsFacture)>=1){
				$this->AddInformationTicketFermesHorsFacture($TicketsFermeDansLaPeriodeHorsFacture);
			}
			
			$this->AddLegende();

			// Stats tickets / Appels (m-1 / N / N-1)
			// Période à traiter - si la facture est faite après le 15, on  considère que c'est pour le mois en cours...
			$t=date('d-m-Y');
			$dayNum = strtolower(date("d",strtotime($t)));
			
			if ($dayNum < 10) {
				$month = array('start' => mktime(0,0,0,date('n')-1,1), 'end' => mktime(0,0,0,date('n'),1));
				}
				else {
				$month = array('start' => mktime(0,0,0,date('n'),1), 'end' => mktime(0,0,0,date('n')+1,1));
				}
				
			$year = array('start' => mktime(0,0,0,1,1), 'end' => mktime(0,0,0,1,1,date('Y')+1));
			$lastYear = array('start' => mktime(0,0,0,1,1,date('Y')-1), 'end' => mktime(0,0,0,1,1));

			$times = array(
				$month,
				$year,
				$lastYear,
			);
			
			$total = array();
			// Calcul des totaux
			$total[''] = array(
				lang(date('F',$month['start'])),
				lang(date('Y',$year['start'])),
				lang(date('Y',$lastYear['start'])),
			);
			
			for($i = 0; $i < count($times);$i++){
				$total[lang('Total time marked on closed tickets')][] = $this->facture_ui->getTotalTicket($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur);
				// Si spitel est présent sur la base
				if(array_key_exists('spitel', $GLOBALS['egw_info']['apps'])){
					// Entrant
					$total[lang('Number of calls to').' '.$this->societeEmetteur['client_company']][] = $this->facture_ui->getCallTime($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, true, true);
					$total[lang('Total time on calls to').' '.$this->societeEmetteur['client_company']][] = $this->facture_ui->getCallTime($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, true);

					// Sortant
					$total[lang('Number of calls from').' '.$this->societeEmetteur['client_company']][] = $this->facture_ui->getCallTime($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, false, true);
					$total[lang('Total time on calls from').' '.$this->societeEmetteur['client_company']][] = $this->facture_ui->getCallTime($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, false);
				}

				$total["\n"][] = '';
				$total[lang('Total amount invoiced for tickets')][] = $this->facture_ui->getTotalAmount($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, true);
				$total[lang('Total amount invoiced for purchases')][] = $this->facture_ui->getTotalAmount($times[$i]['start'], $times[$i]['end'], $this->societeClient, $this->societeEmetteur, false);
			}
			
			$this->Ln(10);
			$this->SetFont('Arial','BU',10);

			$this->Cell(70,4,utf8_decode(lang('Tickets and calls statistics')),0,2,'L');
			$this->Ln();

			$title = true;

			foreach($total as $label => $values){
				if($title){
					$this->SetFont('Arial','B','10');
					$title = false;
				}else{
					$this->SetFont('Arial','','10');
				}

				$this->Cell(100,4,utf8_decode($label),0,0,'L');
				foreach($values as $value){
					$this->Cell(30,4,utf8_decode($value),0,0,'C');
				}
				$this->Ln();
			}
		}
		
		//TCH - Debug SIMULATION
		if ($simul) 
		{
			$this->Output();
		}
	}

}

?>