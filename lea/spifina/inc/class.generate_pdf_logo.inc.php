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


class generate_pdf_logo extends fpdf{

	var $colonnes;
	var $format;
	var $societeEmetteur=array();
	var $societeClient=array();
	var $facture = array();
	var $facture_ui;
	var $lastPage;
	
	
	function generate_pdf_logo(){
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
		$this->societeClient=$client;
		$this->facture_ui = new spifina_ui();
		$this->facture = $this->facture_ui->search(array('facture_id'=>$facture_id),false);
		$this->SetAutoPageBreak(true,40);
		$this->lastPage = false;
		$this->AliasNbPages();
	}

	function Header(){
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$this->facture[0]['societe_id']),false);
		$ville=explode(' ',$facture_emeteur[0]['client_locality']);
		
		$this->addSociete();
		$this->addClient();
		$this->addReference($this->facture[0]['facture_number']);
		$this->addDate($ville[0],strftime('%d %B %Y',$this->facture[0]['send_date']));
		// $this->AddNumeroFacture($this->facture[0]['facture_number']);
		if(!$this->lastPage){
			$this->AddNumeroFacture($this->facture[0]['facture_number']);
			$this->addInfo($this->facture[0]['invoice_message']);
			$this->addEnteteTableau();
		}
	}
	
	function Footer(){
	/**
	* Construit le bas de la page PDF
	*/
		//Positionnement à 2cm du bas
		$this->SetY(-35);

		//font utilisé
		$this->SetFont('Arial','',8);
		$this->Cell(0,7,'Page '.$this->PageNo().'/{nb}',0,2,'R');
		
		//font utilisé
		// $this->SetFont('Arial','',6);
		//epaisseur ligne + couleur ligne et fond
		$this->SetFillColor(24,40,100);
		// couleur texte
		$this->SetTextColor(255,255,255);
		
		//placement des deux fonds
		$this->Cell(130,20,"",0,0,'L',1);
		$this->SetFillColor(70,87,159);
		$this->Cell(0,20,"",0,1,'L',1);
		
		
		$this->SetY(-23);
		$this->SetX(12);
		
		$this->SetFillColor(24,40,100);
		$text = $this->societeEmetteur['client_company'];
		$this->Cell(1,4,$text,0,0,'L',1);
		$this->Ln(3);
		$this->SetX(12);
		$text = $this->societeEmetteur['client_adr_one_street']." - ".$this->societeEmetteur['client_postalcode']." ".$this->societeEmetteur['client_locality'];
		$text = utf8_decode($text);
		$this->Cell(1,4,$text,0,0,'L',1);
		$this->Ln(3);
		$this->SetX(12);
		$text = "Tél.: ".$this->societeEmetteur['client_tel']."  Fax: ".$this->societeEmetteur['client_fax'];
		$text = utf8_decode($text);
		$this->Cell(1,4,$text,0,0,'L',1);
		$this->Ln(3);
		
		//ecriture du texte
		$this->SetY(-26);
		$this->SetX(142);
		$this->SetFillColor(70,87,159);

		$this->SetFont('Arial','',7);

		$text_footer = explode('\n',$this->societeEmetteur['client_footer_one']);
		$text_footer = array_merge($text_footer,explode('\n',$this->societeEmetteur['client_footer_two']));
		
		// $text = $this->societeEmetteur['client_footer_one']."\n";
		// $text .= $this->societeEmetteur['client_footer_two'];
		$text = implode("\n",$text_footer);
		$this->MultiCell(0,17/count($text_footer),utf8_decode($text),0,'L',true);
		
		//couleur text et epaisseur ligne remis au defaut
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth();
	}   
   
	function addSociete(){
	/**
	* Construit les champs concernant les entreprises du PDF
	*/
		$this->SetXY(147,10);
		$this->SetFont('Arial','B',25);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(200);
		$this->Cell(50,10,"FACTURE",0,0,'R',1);
		
		$this->SetXY(10,8);
		// _debug_array($GLOBALS['egw_info']['server']['files_dir']);
		// $this->Image(EGW_INCLUDE_ROOT.'/spifina/templates/default/images/altidem.jpg'/*,10,8,38,29*/);

		$file = fopen($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'],'w+');
		fwrite($file, $this->societeEmetteur['client_logo']);

		$this->Image($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'],10,8,0,25,'JPG');

		fclose($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id']);
		exec('rm -f "'.$GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'].'"');
		
		$this->Ln(25);
		$this->SetTextColor(0,0,0);
	}
	
	function addClient(){
	/**
	* Ajoute un client dans le PDF
	*/
		$x1 = 96;
		$y1 = 50;
		$this->SetX($x1);
		$nom=$this->societeClient['client_company'];
		$nom=utf8_decode($nom);
		$length = $this->GetStringWidth($nom);
		$this->SetFont('Arial','B',11);
		// $this->Cell($length,7,$nom,0,1,'',1);
		$this->MultiCell(110,7,$nom,0,L);

		if(!empty($this->societeClient['client_last_name']) || !empty($this->societeClient['client_first_name'])){
			$attention=lang("For the attention of")." ".$this->societeClient['client_last_name']." ".$this->societeClient['client_first_name'];
		}else{
			$attention="";
		}
		$attention=utf8_decode($attention);
		$length = $this->GetStringWidth($attention);
		$this->SetFont('Arial','U',10);
		$this->SetX($x1);
		$this->Cell($length,7,$attention,0,1,'',1);
		
		$adresse=$this->societeClient['client_adr_one_street']."\n";
		if(!empty($this->societeClient['client_adr_two_street'])){
			$adresse.=$this->societeClient['client_adr_two_street']."\n";
		}
		$adresse.=$this->societeClient['client_postalcode']." ".$this->societeClient['client_locality'];
		$adresse=utf8_decode($adresse);
		$length = $this->GetStringWidth($adresse);
		$this->SetFont('Arial','',10);
		$this->SetX($x1);
		$this->MultiCell($length,6,$adresse);
		// $this->SetXY($x1,$y1);
		
		
		// $this->SetXY($x1,$y1+4);

		// $this->SetXY($x1,$y1+20);
		
	}
	
	function addReference($numeroFacture){
	/**
	* Ajoute une référence dans le PDF
	*
	* @param string $numeroFacture
	*/
		$x1 = 20;
		$y1 = 80;
		// Spirea YLF - 28/04/2011 - On récupère le code opération depuis la table client_relation
		$so_clients_relations =& CreateObject('etemplate.so_sql');
		$so_clients_relations->so_sql('spiclient','spiclient_relations');
		$clientRelation = $so_clients_relations->search(array('societe_id'=>$this->societeEmetteur['client_id'],'client_id'=>$this->societeClient['client_id']),false);
		if(!empty($clientRelation)){
			$operation_code = $clientRelation[0]['operation_code'];
		}
		// $parc=utf8_decode("N/réf : ".$this->societeClient['client_operation_code']." - ".$numeroFacture);
		// $parc=utf8_decode("N/réf : ".$operation_code." - ".$numeroFacture);
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($parc);
		$this->Cell($length,2,$parc);
	}
	
	function addDate($ville,$date){
	/**
	* Ajoute une date $date de la ville $ville dans le PDF
	*
	* @param string $ville
	* @param date $date
	*/
		$x1 = 150;
		$y1 = 80;
		
		$texte=utf8_decode($ville.", le ").$date;
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','',10);

		$length = $this->GetStringWidth($attention);
		$this->Cell($length,1,$attention);

		$this->SetXY($x1,$y1+4);
		$length = $this->GetStringWidth($texte);
		$this->Cell($length,2,$texte);
	}
	
	function AddNumeroFacture($numero){
	/**
	* Ajoute un numéro de facture dans le PDF
	*
	* @param string $numero
	*/
		$x1 = 20;
		$y1 = 90;
		$numero=utf8_decode($numero);
		$txt=utf8_decode("N° FACTURE :");
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetXY($x1+$length+5,$y1);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($numero);
		$this->Cell($length,2,$numero);		
	}
	
	function addInfo($message){
	/** 
	 * Ajoute le message de la facture dans le PDF
	 *
	 * @param String
	 */
		$txt=utf8_decode("Références :");
		$length = $this->GetStringWidth($txt);
		$x1 = 20;
		$y1 = 95;
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,7,$txt);
		
		$message = utf8_decode($message);
		$this->SetXY($x1+$length+5,$y1);
		$this->MultiCell(150,7,$message,'','L',0);
	}
	
	function AddResolutionTicket($date){
	/**
	* Ajoute un ticker résolu dans le PDF
	*
	* @param date $date
	*/
		$x1 = 20;
		$y1 = 90;
		$txt=utf8_decode(strtoupper("RÉsolutions des tickets de demande")." - ").strtoupper($date);
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
		$x1 = 20;
		$y1 = 100;
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
		$x1 = 20;
		$y1 = 128;
		$txt=utf8_decode(lang("Closed tickets during period"));
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetFont('Arial','',10);
		foreach($TicketsFermeDansLaPeriodeDansFacture as $id=>$value){
			$y1=$y1+4;
			$this->SetXY($x1,$y1);
			$length = $this->GetStringWidth($id);
			$this->Cell($length,2,utf8_decode("-  ".$id),0,0);
			$length = $this->GetStringWidth($value);
			$this->SetX($x1+150);
			$this->Cell($length,2,utf8_decode($value),0,0,'R');
		}
	}
	
	function AddInformationTicketFermesHorsFacture($TicketsFermeDansLaPeriodeHorsFacture){
	/**
	* Ajoute les tickets fermés dans le PDF
	*
	* @param date $TicketsFermeDansLaPeriodeHorsFacture définit la date à laquelle on ajoute les tickets fermés en dehors de la période passé en argument (donc non encore comptés dans la facture)
	*/
		$x1 = 20;
		$y1 = $this->GetY()+12;
		$txt=utf8_decode(lang("Closed tickets during the period but not counted with this invoice"));
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetFont('Arial','',10);
		foreach($TicketsFermeDansLaPeriodeHorsFacture as $id=>$value){
			$y1=$y1+4;
			$this->SetXY($x1,$y1);
			$length = $this->GetStringWidth($id);
			$this->Cell($length,2,utf8_decode("-  ".$id),0,0);
			$length = $this->GetStringWidth($value);
			$this->SetX($x1+150);
			$this->Cell($length,2,utf8_decode($value),0,0,'R');
		}
	}
	
	function AddTicketResolu(){
	/**
	* NOTE : Ne sert à rien ...
	*/
		
	}
	
	function AddLegende(){
	/**
	* Ajoute une légende dans le PDF
	*/
		$this->Ln(30);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les "tickets résolu par suivi" sont résolus dans le cadre du forfait de suivi de parc.';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les "tickets résolus par assistance à distance" font l\'objet d\' une facturation dans la rubrique "assitance à distance".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les "tickets résolu par intervention urgente" font l\'objet d\' une facturation dans la rubrique "interventions non planifiées".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$txt='* spifina : Spirea-Demandes - logiciel de gestion de tickets de demande';
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
		$x1 = 20;
		$this->SetX($x1);
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
	}
	
	function AddParagraphe($txt){
	/**
	* Ajoute un paragraphe dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $txt
	*/
		$this->Ln(10);
		$x1 = 20;
		$this->SetX($x1);
		$txt=utf8_decode($txt." :");
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);	
	}
		
	function AddTotalParagraphe($totalLabel,$totalParagraphe,$devise){
	/**
	* Ajoute un paragraphe entier dans le PDF
	*
	* @param string $totalLabel titre du paragraphe
	* @param string $totalParagraphe corps de texte du paragraphe
	* @param string $devise devise du paragraphe
	*/
		$this->Ln(10);
		$x1 = 20;
		$this->SetX($x1);
		$totalLabel=utf8_decode($totalLabel);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($totalLabel);
		$this->Cell($length,2,$totalLabel);
		$x1 = 166;
		$this->SetX($x1);
		$totalParagraphe=utf8_decode($totalParagraphe);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($totalParagraphe);
		$this->Cell($length,2,$totalParagraphe,0,0,'R');
		$x1 = $x1+3+$length;
		$this->SetX($x1);
		$devise=utf8_decode($devise);
		$this->SetFont('Arial','B',10);
		$length = $this->GetStringWidth($devise);
		$this->Cell($length,2,$devise,0,0,'R');
	}
	
	function AddMessage($message){
	/**
	* Ajoute un message dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $message
	*/
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$this->SetFont('Arial','',10);
		$tab_message=explode('<br />',$message);
		foreach($tab_message as $msg){
			$trim_msg=trim($msg);
			$this->Ln(5);
			$this->SetX($x1);
			$length = $this->GetStringWidth($trim_msg);
			$this->Cell($length,2,$trim_msg);
		}
		$this->Ln(50);
	}
	
	function AddModeReglement($reglement){
	/**
	* Ajoute un mode de règlement dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $reglement
	*/
		$this->SetXY(10, $this->getY() - 18);
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

	function addEnteteTableau(){
		$w=array(130,20,40);
		$header= array(lang('DESCRIPTION'),lang('VAT'),lang('AMOUNT'));
		$this->Ln(5);
		$this->SetFillColor(216,228,232);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		for($i=0;$i<count($header);$i++){
			$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
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
		$ligne_facture=$this->facture_ui->so_factures_details->search(array('facture_id'=>$facture[0]['facture_id']),false,'GROUP BY ticket_id');
		$FacturationTableau=array();
		foreach($ligne_facture as $cle=>$value){
			if($value['ticket_id']>0){
				$FacturationTableau[] = $value;
			}
		}
		$LignePerso = array();
		$LignePerso = $this->facture_ui->get_line($facture[0]['facture_id']);

		$this->facture = $facture;
		
		//Spirea YLF - 28/04/2011 - Modification pour utiliser la valeur societe_id qui est remplit à la création de la facture
		// cette variable contient l'id de l'entreprise que l'on aura choisit comme etant émettrice de la facture
		$facture_client=$this->facture_ui->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$prix_parametre='';
		$modele_paiement=$this->facture_ui->get_mode_reglement();
		$delai_paiement=$this->facture_ui->get_delai_paiement();

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
		// $this->addSociete();
		// $this->addClient();
		// $this->addReference($facture[0]['facture_number']);
		// $this->addDate($ville[0],strftime('%d %B %Y',$facture[0]['send_date']));
		// $this->AddNumeroFacture($facture[0]['facture_number']);
		// $this->addInfo($facture[0]['invoice_message']);
		
		// Si simulation, ajout fond simulation
		if($simul == 1){
			$this->Image('spifina/templates/default/images/simulation.jpg',0,$this->getY(),200);
		}elseif($simul == 2){
			$this->Image('spifina/templates/default/images/proforma.jpg',0,$this->getY(),200);
		}
		
		$w=array(130,20,40);
		$this->SetLineWidth(.3);
		// $this->addEnteteTableau();
		
		$this->SetFillColor(224,235,255);
		$this->SetFont('');

		$tab_tva = array();		

		if(!empty($FacturationTableau)){
			$total_ticket = 0;
			foreach($FacturationTableau as $id => $data){
				$tab_tva[$data['vat_rate']] += $data['total_ht'];

				$ticket = $this->facture_ui->so_ticket->search(array('ticket_id'=>$data['ticket_id']),false);

				$this->SetFont('','B');
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[0],7,utf8_decode($ticket[0]['ticket_title']),'LTRB','C',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				// Taux TVA
				$startY = $this->getY();
				$this->MultiCell($w[1],$newY-$startY,utf8_decode(number_format($data['vat_rate'],2,'.',' ').' %'),'LTRB','R',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				$this->MultiCell($w[2],7,utf8_decode(number_format($data['total_ht'],2,'.',' ').' EUR'),'LTRB','R',0);
				$total_ticket += $data['total_ht'];
				$this->setY($newY);
				$this->SetFont('');
				
				$so_rendez_vous = new so_sql('spid','spid_rendez_vous');
				$so_calendar = new calendar_so();
				$addressbook = new so_sql('phpgwapi','egw_addressbook');
				$rdv = $so_rendez_vous->search(array('ticket_id' => $ticket[0]['ticket_id']),false,'cal_id');
				foreach($rdv as $cle=>$valeur){
					$this->SetDrawColor(255,255,255);
					$this->Line(10,$this->getY(),200,$this->getY());
					$this->SetDrawColor(0,0,0);
					$cal_event = $so_calendar->read($rdv[$cle]['cal_id']);
					$contact = $addressbook->search(array('egw_addressbook.account_id'=>$rdv[$cle]['account_id']),'n_fn');
					$intervention = '=> '.lang('Intervention by').' '.$contact[0]['n_fn'];
					if(date('d/m/Y',$cal_event[$rdv[$cle]['cal_id']]['start']) != date('d/m/Y',$cal_event[$rdv[$cle]['cal_id']]['end'])){
						$intervention .= ' '.lang('from').' '.date('d/m/Y',$cal_event[$rdv[$cle]['cal_id']]['start']).' '.lang('to').' '.date('d/m/Y',$cal_event[$rdv[$cle]['cal_id']]['end']);
					}else{
						$intervention .= ' '.lang('of').' '.date('d/m/Y',$cal_event[$rdv[$cle]['cal_id']]['start']);
					}
					$startY = $this->getY();
					$this->MultiCell($w[0],7,utf8_decode($intervention),'LR','C',0);
					$newY = $this->getY();
					$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
					$this->MultiCell($w[2],7,'','LR','C',0);
				}

				if(!empty($ticket[0]['ticket_nb_student'])&&!empty($ticket[0]['ticket_price_student'])){
					$student = "\n".utf8_encode(lang('Representing ').$ticket[0]['ticket_nb_student'].' '.lang('students').' x '.$ticket[0]['ticket_price_student'].' EUR');
					$this->SetFont('','B');
					$startY = $this->getY();
					$this->MultiCell($w[0],7,utf8_decode($student),'LRB','C',0);
					$newY = $this->getY();
					$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
					$this->MultiCell($w[2],$newY - $startY,'','LRB','R',0);
					$this->SetFont('');
					$this->setY($newY);
				}
			}

			$startY = $this->getY();
			$this->MultiCell($w[0]+$w[1],7,utf8_encode(lang('Sub-total tickets')),'LTRB','R',1);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
			$this->MultiCell($w[2],7,number_format($total_ticket,2,'.',' ').' EUR','LTRB','R',1);
		}
		$this->SetFillColor(0,0,0);
		$this->MultiCell($w[0]+$w[1]+$w[2],0.5,'','LTRB','C',1);
		$this->SetFillColor(224,235,255);
		//Spirea YLF - 09/08/2011 - traitement des lignes personnalisé


		$total_lp = 0;
		if(!empty($LignePerso)){
			foreach($LignePerso as $id => $data){
				$this->SetFont('','B');
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[0],7,utf8_decode($data['extra_label']),'LTRB','C',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[1],$newY-$startY,utf8_decode(number_format($data['vat_rate'],2,'.',' ').' %'),'LTRB','R',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				if($data['extra_ht'] == 0){
					$this->MultiCell($w[2],$newY-$startY,'-','LTRB','C',0);
				}else{
					if($newY-$startY > 0){
						$this->MultiCell($w[2],$newY-$startY,utf8_decode(number_format($data['extra_ht'],2,'.',' ').' EUR'),'LTRB','R',0);
					}else{
						$this->setXY($this->getX(), $this->yHeader);
						$this->MultiCell($w[2],$newY-$this->yHeader,utf8_decode(number_format($data['extra_ht'],2,'.',' ').' EUR'),'LTRB','R',0);
					}
				}
				$total_lp += $data['extra_ht'];
				$this->setY($newY);
				$this->SetFont('');

				$tab_tva[$data['vat_rate']] += $data['extra_ht'];
			}
			$startY = $this->getY();
			$this->MultiCell($w[0]+$w[1],7,utf8_decode(lang('Sub-total custom')),1,'R',1);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
			$this->MultiCell($w[2],$newY-$startY,number_format($total_lp,2,'.',' ').' EUR','LTRB','R',1);
		}

		// $total_tva = $facture[0]['facture_tva'] ? ($total_ticket+$total_lp)*$facture[0]['facture_taux_tva']/100 : '';

		/*** Sous totaux TVA ****/
		$this->Ln(2);
		$w = array(130,30,30);
		$this->SetFont('','B',10);
		$this->SetFillColor(255,255,255);

		$startY = $this->getY();
		$this->MultiCell($w[0],7,'','R','R',0);
		$newY = $this->getY();
		$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);

		$startY = $this->getY();
		$this->MultiCell($w[1],7,lang('Base HT'),'TR','R',0);
		$newY = $this->getY();
		$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

		$startY = $this->getY();
		$this->MultiCell($w[2],7,lang('VAT amount'),'TR','R',0);
		// $newY = $this->getY();
		// $this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY);
		
		$this->SetFont('');
		$total_tva = 0;
		foreach ($tab_tva as $taux => $montant_ht) {
			$montant_tva = $taux==0 ? 0 : $montant_ht * $taux / 100;
			
			$startY = $this->getY();
			
			if(!empty($taux)){
				$this->MultiCell($w[0],7,utf8_decode(lang('VAT').' '.$taux.' %'),'R','R',0);
			}else{
				$this->MultiCell($w[0],7,'','R','R',0);
			}
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
			
			$startY = $this->getY();
			if(!empty($montant_ht)){
				if(is_numeric($montant_ht)){
					$this->MultiCell($w[1],7,number_format($montant_ht,2,'.',' ').' EUR',1,'R',$fill);
				}else{
					$this->MultiCell($w[1],7,$montant_ht,1,'R',$fill);
				}
			}else{
				$this->MultiCell($w[1],7,'',1,'R',$fill);
			}
			
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
			if($montant_tva != 0){
				$this->MultiCell($w[2],7,number_format($montant_tva,2,'.',' ').' EUR',1,'R',$fill);
			}else{
				$this->MultiCell($w[2],7,'',1,'R',$fill);
			}
			$fill = $fill ? false : true;

			$total_tva += $montant_tva;
		}
		/**** FIN - Sous totaux TVA ****/
		
		$total = array(
			lang('Sub-Total HT') => $total_ticket+$total_lp,
			lang('VAT Total') => $total_tva,
			// lang('Sub-total TTC') => $total_ticket+$total_lp+$total_tva,
			// ''	=> '',
			lang('Total TTC')=> $total_ticket+$total_lp+$total_tva,
		);
		$fill = true;
		$this->SetFillColor(224,235,255);
		foreach($total as $label => $valeur){
			
			$startY = $this->getY();
			
			$this->MultiCell($w[0],7,utf8_decode($label),'R','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
			
			$this->SetFont('','B');

			if(!empty($valeur)){
				$this->MultiCell($w[1]+$w[2],7,number_format($valeur,2,'.',' ').' EUR',1,'R',$fill);
			}else{
				$this->MultiCell($w[1]+$w[2],7,'',1,'R',$fill);
			}
			$this->SetFont('');
			$fill = $fill ? false : true;
		}

		$this->AddModeReglement($modePaiementClient);
		
		
		if($facture[0]['alone_invoice']==0){
			$infos=array(
				lang('Ticket number open at start period')	=> $facture[0]['nb_open_start'],
				lang('Ticket number open during period')	=> $facture[0]['nb_open_during'],
				lang('Ticket number closed during period')	=> $facture[0]['nb_close_during'],
				lang('Ticket number open at end period')	=> $facture[0]['nb_open_end'],
			);
			$ticket_ferme=$this->facture_ui->get_type_ticket();
			$infos_ticket_fermes=array();
			$account_id=$facture[0]['account_id'];
			$start_period_date=$facture[0]['start_period_date'];
			$end_period_date=$facture[0]['end_period_date'];
			foreach($ticket_ferme as $cle=>$value){
				$nb_ticket=$this->facture_ui->get_nombre_ticket_par_etat($cle,$account_id,$start_period_date,$end_period_date);
				if($nb_ticket>0){
					$infos_ticket_fermes[$value]=$nb_ticket;
					$TicketsFermeDansLaPeriode[$cle]=$nb_ticket;;
				}
			}
		
			$TicketsFermeDansLaPeriodeHorsFacture=array_diff_key($TicketsFermeDansLaPeriode, $nbTicketsParEtatDansLaFacture);
			$TicketsFermeDansLaPeriodeDansFacture=$nbTicketsParEtatDansLaFacture;
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
		
			//YLF - Debug
			// $this->Output();
			
			$this->lastPage = true;
			$this->AddPage();
			$this->addSociete();
			$this->addClient();
			// $this->addReference();
			$this->addReference($facture[0]['facture_number']);
			$this->addDate($ville[0],strftime('%d %B %Y',$facture[0]['send_date']));
			if(date('m',$facture[0]['start_period_date'])!=date('m',$facture[0]['end_period_date'])){
				$dateST=strftime('%B %Y',$facture[0]['start_period_date']).' - '.strftime('%B %Y',$facture[0]['end_period_date']);
			}else{
				$dateST=strftime('%B %Y',$facture[0]['end_period_date']);
			}
			$this->AddResolutionTicket($dateST);
			$this->AddInformation($infos);
			$this->AddInformationTicketFermes($TicketsFermeDansLaPeriodeDansFacture);
			if(count($TicketsFermeDansLaPeriodeHorsFacture)>=1){
				$this->AddInformationTicketFermesHorsFacture($TicketsFermeDansLaPeriodeHorsFacture);
			}
			$this->AddLegende();
			
			//YLF - Debug
			// $this->Output();
		}
		
					//TCH - Debug SIMULATION
		if ($simul) 
		{
			$this->Output();
		}
	}

}

?>