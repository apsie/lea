<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009->01/08/2013
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

require_once(EGW_INCLUDE_ROOT. '/spid/fpdf/fpdf.php');


class generate_pdf extends fpdf{

	var $colonnes;
	var $format;
	var $societeEmetteur=array();
	var $societeClient=array();
	
	
	function generate_pdf(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function __construct($emetteur=array(),$client=array()){
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales. $emetteur est un tableau décrivant la socité émettrice
	* $client esu une tableau décrivant la société cliente
	*
	* @param array $emetteur=array()
	* @param array $client=array()
	*/
		define('FPDF_FONTPATH',EGW_INCLUDE_ROOT.'/spid/fpdf/font/');
		parent::FPDF('P', 'mm', 'A4');
		$this->societeEmetteur=$emetteur;
		$this->societeClient=$client;
	}

	function number_format_clean($number,$precision=0,$dec_point='.',$thousands_sep=' ')
	/*
	http://php.net/manual/fr/function.number-format.php
		
	The above will trim all insignificant zeros from both ends of the string, though I'm not sure I've ever seen leading zeros returned.
	*/
    {
		RETURN trim(number_format($number,$precision,$dec_point,$thousands_sep),$dec_point.'0');
    }
	
	
	function Header(){
	/**
	 * Construit l'entete du document
	 */
		$facture_ui = $this->facture_ui;
		$facture = $this->facture;
		$facture_client=$facture_ui->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$prix_parametre='';
		$modele_paiement=$facture_ui->get_payment_model();
		$modePaiementClient=$modele_paiement[$relationClientSociete['payment_model']];
		setlocale(LC_ALL, 'fr_FR');
		$ville = explode(' ',$facture_emeteur[0]['client_locality']);
		
		$this->addSociete();
		$this->addInfo();

		$this->addClient();
		$this->addDate($ville[0],strftime('%d %B %Y',$facture[0]['send_date']));

		$this->addReference($facture[0]['facture_number']);
		
		
		$this->AddNumeroFacture($facture[0]['facture_number']);
		// $this->Cell(0,2,'');
		
		$this->Ln(5);
		
		$this->y = $this->GetY();
		
		unset($facture_ui);
		unset($facture);
	}
	
	function Footer(){
	/**
	* Construit le bas de la page PDF
	*/
		// $this->SetY(-20);
		$this->SetY(-40);
		$this->SetFont('Arial','',8); 
		$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C'); 
		$this->Ln(5);
		$this->SetFont('Arial','',8);
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_footer_one']),0,0,'C');
		$this->Ln(5);
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_footer_two']),0,2,'C');

		// _debug_array($this->sizeOfText(utf8_decode($this->societeEmetteur['client_footer_one'])));
		// _debug_array($this->sizeOfText(utf8_decode($this->societeEmetteur['client_footer_two'])));
		// _debug_array($this->sizeOfText(utf8_decode(lang('PAYMENT').' : '.$this->facture_ui->obj_config['invoice_payment'])),190);
		// _debug_array($this->sizeOfText(utf8_decode(lang('PAYMENT').' : '.$this->facture_ui->obj_config['invoice_property'])),190);

		$startY = $this->getY();
		$startX = $this->getX();

		if(!empty($this->facture_ui->obj_config['invoice_payment'])){
			$this->MultiCell(0,4,utf8_decode(lang('PAYMENT').' : '.str_replace('<br />', "\n", $this->facture_ui->obj_config['invoice_payment'])),0,$formText);

			$newY = $this->getY();
			$this->setXY($this->getX(),$newY);
		}

		if(!empty($this->facture_ui->obj_config['invoice_payment'])){
			$this->MultiCell(0,4,utf8_decode(lang('PROPERTY').' : '.str_replace('<br />', "\n", $this->facture_ui->obj_config['invoice_property'])),0,$formText);
		}
	}
   
   
	function CheckPageBreak($h) {
    //If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
	}

	function addInfo(){
	/**
	 * Bloc d'information sur la facture
	 */
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
		$delai_paiement = $this->facture_ui->get_delai_paiement();
		$societe = $this->facture_ui->so_client->search(array('client_id'=>$this->facture[0]['societe_id']),false);
		$relationClientSociete = $this->facture_ui->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$this->facture[0]['client_id']),false);
		$delai = $delai_paiement[$relationClientSociete[0]['payment_model']];
		$this->Cell(40,5,utf8_decode($delai),0,2);
		if (!empty($this->societeClient['client_code_tiers'])){
			$this->Cell(40,5,utf8_decode($this->societeClient['client_code_tiers']),0,2);
		}
	}
	
   
	function addSociete(){
	/**
	* Construit les champs concernant les entreprises du PDF
	*/
		$x1 = 10;
		$y1 = 8;
		$nom=strtoupper($this->societeEmetteur['client_company']);
		$nom=utf8_decode($nom);
		$groupe=$this->societeEmetteur['client_last_name'];
		$groupe=utf8_decode($groupe);
		$adresse=$this->societeEmetteur['client_adr_one_street']."\n".$this->societeEmetteur['client_adr_two_street']."\n".$this->societeEmetteur['client_postalcode']." ".$this->societeEmetteur['client_locality'];
		$adresse=utf8_decode($adresse);
		$telephone=lang("Tel").": ".$this->societeEmetteur['client_tel'];
		$telephone=utf8_decode($telephone);
		if(!empty($this->societeEmetteur['client_fax'])){
			$fax=lang("Fax").": ".$this->societeEmetteur['client_fax'];
		}else{
			$fax="";
		}
		$fax=utf8_decode($fax);
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','B',16);
		$length = $this->GetStringWidth($nom);
		$this->Cell($length,2,$nom);
		$this->SetXY($x1,$y1+6);
		$this->SetFont('Arial','',14);
		$length = $this->GetStringWidth($groupe);
		$this->Cell($length,2,$groupe);
		$this->SetXY($x1,$y1+10);
		$this->SetFont('Arial','I',12);
		$length = $this->GetStringWidth($adresse);
		$this->MultiCell($length,4,$adresse);
		$this->SetXY($x1,$y1+24);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($telephone);
		$this->Cell($length,2,$telephone);
		$this->SetXY($x1,$y1+28);
		$length = $this->GetStringWidth($fax);
		$this->Cell($length,2,$fax);
	}
	
	function addClient(){
	/**
	* Ajoute un client dans le PDF
	*/
		$x1 = 100;
		$y1 = 50;
		$nom=$this->societeClient['client_company'];
		$nom=utf8_decode($nom);
		// if(!empty($this->societeClient['client_last_name']) || !empty($this->societeClient['client_first_name'])){
		// 	$attention=lang("For the attention of")." ".$this->societeClient['client_last_name']." ".$this->societeClient['client_first_name'];
		// }else{
		// 	$attention="";
		// }
		// $attention=utf8_decode($attention);
		
		// Utilisation de l'adresse de facturation s'il y en a une / adresse normal sinon
		if(!empty($this->societeClient['client_adr_one_street_facturation']) && !empty($this->societeClient['client_locality_facturation']) && !empty($this->societeClient['client_postalcode_facturation'])){
			$adresse=$this->societeClient['client_adr_one_street_facturation']."\n";
			if(!empty($this->societeClient['client_adr_two_street_facturation'])){
				$adresse.=$this->societeClient['client_adr_two_street_facturation']."\n";
			}

			if(!empty($this->societeClient['client_adr_three_street_facturation'])){
				$adresse.= utf8_decode($this->societeClient['client_adr_three_street_facturation'])."\n";
			}
			$adresse.=$this->societeClient['client_postalcode_facturation']." ".$this->societeClient['client_locality_facturation'];
			// $adresse.=$this->societeClient['client_country_facturation'];
			$adresse=utf8_decode($adresse);
		}else{
			$adresse=$this->societeClient['client_adr_one_street']."\n";
			if(!empty($this->societeClient['client_adr_two_street'])){
				$adresse.=$this->societeClient['client_adr_two_street']."\n";
			}
			$adresse.=$this->societeClient['client_postalcode']." ".$this->societeClient['client_locality'];
			// $adresse.=$this->societeClient['client_country'];
			$adresse=utf8_decode($adresse);
		}

		
		
		$this->SetXY($x1,$y1);
		
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($nom);
		$this->Cell($length,2,$nom);

		$this->SetXY($x1,$y1+4);
		$length = $this->GetStringWidth($adresse);
		$this->MultiCell($length,4,$adresse);
		$this->SetXY($x1,$y1+20);
		// $length = $this->GetStringWidth($attention);
		// $this->Cell($length,2,$attention);
	}
	
	function addReference($numeroFacture){
	/**
	* Ajoute une référence dans le PDF
	*
	* @param string $numeroFacture
	*/
		$x1 = 10;
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
		if (!empty($operation_code)){
			$parc=utf8_decode("N/réf : ".$operation_code);
		}
		
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
		$x1 = 135;
		$y1 = 80;

		$nom=$this->societeClient['client_company'];
		$nom=utf8_decode($nom);
		if(!empty($this->societeClient['client_last_name']) || !empty($this->societeClient['client_first_name'])){
			$attention=lang("For the attention of")." ".$this->societeClient['client_first_name']." ".$this->societeClient['client_last_name'];
		}else{
			$attention="";
		}
		$attention=utf8_decode($attention);

		$texte=utf8_decode($ville.", le ").$date;
		// $this->SetXY($x1,$y1);
		$this->SetFont('Arial','',10);

		$length = $this->GetStringWidth($attention);
		$this->Cell($length,1,$attention);

		$this->SetXY($x1,$y1+4);
		$length = $this->GetStringWidth($texte);
		$this->Cell($length,2,$texte);
	}
	
	function AddNumeroFacture($numero, $montant=10){
	/**
	* Ajoute un numéro de facture dans le PDF
	*
	* @param string $numero
	*/
		//$x1 = 20;
		$x1 = 10;
		$y1 = 90;
		$numero=utf8_decode($numero);

// _debug_array($montant);
		if($montant > 0){
			$txt=utf8_decode(lang("Facture n° :"));
		}else{
			$txt=utf8_decode(lang("Facture d'avoir n° :"));
		}
		$this->SetXY($x1,$y1);
		$this->SetFont('Arial','U',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->SetXY($x1+$length+5,$y1);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($numero);
		$this->Cell($length,2,$numero);
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
		$txt=utf8_decode("Tickets de demande renseignés dans SPID* (intra.spirea.fr)");
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
	
	function AddTicketResolu(){
	/**
	* NOTE : Ne sert à rien ...
	*/
		
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
	
	function AddParagraphe($txt,$format=''){
	/**
	* Ajoute un paragraphe dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $txt
	*/
		
		// $this->Ln(10);
		$this->Ln(2);
		$x1 = 10;
		$this->SetX($x1);
		$txt=utf8_decode($txt." :");
		$this->SetFont('Arial',$format,10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);

		$this->SetFont('Arial','',10);
	}
		
	function AddTotalParagraphe($totalLabel,$totalParagraphe,$devise){
	/**
	* Ajoute un paragraphe entier dans le PDF
	*
	* @param string $totalLabel titre du paragraphe
	* @param string $totalParagraphe corps de texte du paragraphe
	* @param string $devise devise du paragraphe
	*/
		
		// $this->Ln(10);
		$this->Ln(2);
		$x1 = 10;
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
	// 
	* @param string $message
	*/
		// $count = 0;
		$this->Ln(3);
		
		// Note tch - ce bloc de code commenté est à supprimer..
		
		// $x1 = 20;
		// $this->SetX($x1);
		// $this->SetFont('Arial','',10);
		// $tab_message=explode('<br />',$message);
		// foreach($tab_message as $msg){
			// $trim_msg=trim($msg);
			// $this->Ln(5);
			// $this->SetX($x1);
			// $length = $this->GetStringWidth($trim_msg);
			// $this->Cell($length,2,$trim_msg);
			// $count++;
		// }
		// $this->Ln(50);
		// return $count;
		// 
		$message = strip_tags($message);
		$this->MultiCell(0,5,$message,0);
		$this->Ln(3);
		return $nl;
	}
	
	function AddModeReglement($reglement){
	/**
	* Ajoute un mode de règlement dans le PDF (ajoute le texte passé en argument)
	*
	* @param string $reglement
	*/
		$x1 = 10;
		$this->SetXY($x1,$this->GetY()-10);
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
	
	function AcceptPageBreak(){
		$this->new_page = true;
		return true;
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
	
		if($this->new_page){
			// $ligne = $this->y;
			// $ligne = $this->GetY()+30;
		}
		global $colonnes, $format;
		$ordonnee = $colone;
		$maxSize = $ligne;
		reset($colonnes);
		$longTotal=0;
		while(list($lib,$pos) = each($colonnes)){
			$longCell = $pos -2;
			$texte = $tab[ $lib ];
			// $length = $this->GetStringWidth($texte);
			// $tailleTexte = $this->sizeOfText($texte,$length);
			$formText  = $format[$lib];
			// $this->SetXY($ordonnee, $ligne - 1);
			$this->SetXY($ordonnee, $ligne);
			
			/// MultiCell -> on desactive autopagebreak
			$this->SetAutoPageBreak(false);
			// $h=5*$nb;
			//Issue a page break first if needed
			// $this->CheckPageBreak(10)
			
			$this->MultiCell($longCell,5,$texte,0,$formText);
			$this->SetAutoPageBreak(true,40);
			
			$longTotal+=$longCell;
			if($maxSize < ($this->GetY())){
				$maxSize = $this->GetY() ;
			}
			$ordonnee += $pos;
		}
		if($trace_ligne==1){
			$this->Ln(0);
			$this->Line(118,$this->GetY(),123+$longTotal,$this->GetY());
		}
		if($trace_ligne==2){
			$this->Ln(1);
			$this->Line(118,$this->GetY(),123+$longTotal,$this->GetY());
			$this->Ln(1);
			$this->Line(118,$this->GetY(),123+$longTotal,$this->GetY());
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

		
		$this->facture_ui = $facture_ui;
		$this->facture = $facture_ui->search(array('facture_id'=>$id),false);
		$facture = $facture_ui->search(array('facture_id'=>$id),false);
		$societe = $facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		$relationClientSociete = $facture_ui->so_clients_relations->search(array('societe_id'=>$societe[0]['client_id'],'client_id'=>$facture[0]['client_id']),false);
		
		$FacturationTableau=array();

		if($simul){
			$content = $facture_ui->get_info($id);
			$ligne_facture = $content['ticket'];
			// _debug_array($content);
		}else{
			$join = 'WHERE ticket_id <> 0';
			$ligne_facture = $facture_ui->so_factures_details->search(array('facture_id'=>$facture[0]['facture_id']),false,'GROUP BY ticket_id','',$wildcard,false,$op,$start,$query['col_filter'],$join);	
		}
		$tab_tva = array();
	
		  //_debug_array($ligne_facture);
	
		foreach($ligne_facture as $cle=>$value){
				
			// _debug_array($value);
			if($value['total_ht'] != 0){
				$tab_tva[$value['vat_rate']] += $value['total_ht'];
			}
				// _debug_array($tab_tva);
			
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
					
					
				//$ligne_facture[$cle]['unit']=$ticket[0]['ticket_unit_time'];
				// fin code tch 
				/* code inutile - tch 
				
				if(isset($label[0]['facturation_label']) && !empty($label[0]['facturation_label'])){
					$facturationLabel=$label[0]['facturation_label'];
				}else{
					$facturationLabel="Pas de libellé";
				}
				
				if(!isset($FacturationTableau[$value['state_id']])){
					$FacturationTableau[$value['state_id']]=array(
						'label'	=> $facturationLabel,
					);
				}
				if(!isset($FacturationTableau[$value['state_id']]['tickets'])){
					$FacturationTableau[$value['state_id']]['tickets']=array();
				}
				$FacturationTableau[$value['state_id']]['tickets'][$value['ticket_id']]=$value['spend_time'];
				*/
			}
		}
		// _debug_array($ligne_facture);
		
		// _debug_array($FacturationTableau);
		
		$LignePerso = array();
		$LignePerso = $facture_ui->get_line($facture[0]['facture_id']);
		
		// Spirea YLF - 28/04/2011 - Modification pour utiliser la valeur societe_id qui est remplit à la création de la facture
		// cette variable contient l'id de l'entreprise que l'on aura choisi comme etant émettrice de la facture
		// --------------------------------------------------------------------------------------------------------
		// ancienne valeur utilisé
		// $facture_client=$facture_ui->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		// // $facture_emeteur=$this->so_client->search(array('client_id'=>$facture_client[0]['client_billable_id']),false);
		// $facture_emeteur = $facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		// $prix_parametre='';
		// $modele_paiement=$facture_ui->get_payment_model();
		// $modePaiementClient=$modele_paiement[$relationClientSociete['payment_model']];
		// setlocale(LC_ALL, 'fr_FR');
		// $ville=explode(' ',$facture_emeteur[0]['client_locality']);
		
				
		$label_RappelTarif=sprintf(lang("Rate: %s EUR / answered call, the edge of half an hour"),$facture_ui->obj_config['initial_price']);
		
		// _debug_array($facture);
		$montantHT=lang('H.T. amount')." ";
		$montantTVA=lang('T.V.A.').' '.$facture[0]['facture_taux_tva'].'% ';
		$montantTTC=lang('T.T.C. amount')." ";

		// Création de la première page / va executer header();
		$this->AddPage();
		//AliasNbPages pour récupérer le nombre de pages
		$this->AliasNbPages(); 
		// 40 : hauteur par rapport au footer de page pour le autopagebreak
		$this->SetAutoPageBreak(true,40);
		
		$this->SetTopMargin(400);
		// $this->SetFooterMargin(100);
		
		$y = $this->getY();
		 // $y = 82;

		// Si simulation, ajout fond simulation
		if($simul){
			$this->Image('spid/templates/default/images/simulation.jpg',0,$this->getY(),200);
		}
		
		// _debug_array($ligne_facture);exit;
		if(!empty($ligne_facture)){
			//$this->AddRappelTarif($label_RappelTarif);

			$this->AddParagraphe(lang('invoice tickets'),'B');
			// $this->Ln(1);
			$y   = $y + 8;
			$cols=array(
				"ID"			=> 12,
				"DATEF"			=> 24,
				"CATEGORIE"		=> 42,
				"STATUT"		=> 70,
				// "TEMPS"			=> 30,
				// "TRANCHE"		=> 30,
				"MONTANT_HT"	=> 20,
				"LABEL_HT"		=> 25,
			);
			$this->addCols($cols);
			$cols=array(
				"ID"			=> "L",
				"DATEF"		=> "L",
				"CATEGORIE"		=> "L",
				"STATUT"		=> "L",
				// "TEMPS"			=> "R",
				// "TRANCHE"		=> "R",
				"MONTANT_HT"	=> "R",
				"LABEL_HT"		=> "L",
			);
			$this->addLineFormat($cols);
			// $this->Ln(5);
			// $y = $this->getY();
			$totalParagraph=0;
		
			$factureTableau=array();
			$increment=0;
			
			// _debug_array($FacturationTableau);
			
			foreach($FacturationTableau as $_cle=>$_valeur){
				// $label=$_valeur['label'];
				$tps_total=0;
				
				// _debug_array($_valeur);
				
				foreach($_valeur['tickets'] as $num_ticket=>$tps_ticket){
					$ticket = $facture_ui->so_ticket->search(array('ticket_id'=>$num_ticket),false);
					// _debug_array($ticket[0]['ticket_unit_time']);exit;
					switch($ticket[0]['ticket_unit_time']){
						case 0:
							$unit = 'mn';
							break;
						case 1:
							$unit = 'h';
							break;
						case 2:
							$unit = 'd';
							break;
					}
					$temps_reel_ticket = $tps_ticket.' '.$unit;
					if($facture_ui->obj_config['unit_time'] == $ticket[0]['ticket_unit_time']){
						
						$tps_total+=$tps_ticket;
					}else{
						$tps_total+=$facture_ui->convertir_temps($tps_ticket,$ticket[0]['ticket_unit_time'],$facture_ui->obj_config['unit_time']);
						$tps_total+= $tps_ticket/7;
					}
					
					// Codes à faire évoluer : cas possibles : 
					/* 
					- prix par étudiant
					- prix sur le contrat (car le ticket est rattaché à un contrat
					- prix sur le client (car le ticket est rattaché à un statut qui a un prix)
					- prix sur la base des prix par défaut avec éventuellement temps passé
					- prix forfaitaire
					- ticket gratuit
					*/					
					
					/* code mis de côte - tch
					Cf. ancien fichier... C'était pas maintenable...
					*/
				}
				
				
				if($tps_total>0){
					$label.=' ('.$tps_total.' mn)';
				}
				// $factureTableau[$increment]['LABEL']=$label;
				// $factureTableau[$increment]['QUANTITE']=count($_valeur['tickets']);
				$nbTicketsParEtatDansLaFacture[$_cle]=count($_valeur['tickets']);
				$increment++;
			}
			
			 // $y = 110;
			 // _debug_array($factureTableau);exit;
			 
			 
			$totalTicket = 0;
			
			
			 // _debug_array($ligne_facture);
			
			// Ligne Titre
			
			$line = array(
				"ID"			=> utf8_decode("n°"),
				"DATEF"			=> utf8_decode("Fermé le"),
				"CATEGORIE"		=> utf8_decode("Catégorie"),
				"STATUT"		=> utf8_decode("Statut"),
				// "TEMPS"		=>  utf8_decode("Temps"),
				// "TRANCHE"		=>  utf8_decode("Tranche"),
				"MONTANT_HT"	=> utf8_decode("Montant"),
				//"LABEL_HT"		=> utf8_decode('EUR HT'),
			);
			// _debug_array($line);
			$size = $this->addLine(10,$y,$line);
			$y   += $size + 2;
			
			
			foreach($ligne_facture as $cle=>$value){
				$currentTicket = $this->facture_ui->so_ticket->read($value['ticket_id']);

				// SPIREA-YLF -- A remettre au propre (doublon de facture_bo.get_info)
				$obj_ticket = CreateObject('spid.spid_ui');
				$param_etat = $this->facture_ui->so_prix_parametres->search(array('client_id'=>$currentTicket['client_id'],'state_id'=>$currentTicket['state_id']),false);
				// _debug_array($param_etat);
				$param_etat_contrat = $this->facture_ui->so_prix_parametres->search(array('contract_id'=>empty($currentTicket['contract_id']) ? -1 : $currentTicket['contract_id'],'state_id'=>$currentTicket['state_id']),false);
				
				$temps_ticket = $currentTicket['ticket_spend_time'];
				$unit_time = $currentTicket['ticket_unit_time'];
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

				switch($currentTicket['ticket_unit_time']){
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

				$value['ticket_time_bracket'] = $temps_passe;
				$value['unit'] = $unit;
				// FIN SPIREA-YLF
				
				if ($value['ticket_time_bracket'] > 0){
					$value['ticket_time_bracket'] = $value['ticket_time_bracket'].' '.$unit;
				}

				// $value['ticket_title'] = (strlen($value['ticket_title']) > 42) ? substr($value['ticket_title'],0,42).'...' : $value['ticket_title'];
				$value['ticket_cat'] = (strlen($value['ticket_cat']) > 25) ? substr($value['ticket_cat'],0,25).'...' : $value['ticket_cat'];
				
				$value['label'] = (strlen($value['label']) > 45) ? substr($value['label'],0,45).'...' : $value['label'];
				$value['label'] = $value['label'] . " (".$value['ticket_time_bracket'].')';
				
				if(!empty($value['ticket_id'])) {
					$line = array(
						"ID"			=> utf8_decode($value['ticket_id']),
						"DATEF"			=> date('d/m/Y',$currentTicket['closed_date']),
						"CATEGORIE"		=> utf8_decode($value['ticket_cat']),
						"STATUT"		=> utf8_decode($value['label']),
						// "TEMPS"		=>  utf8_decode(rtrim(rtrim($value['spend_time'], "0"),".").' '.$value['unit']),
						// "TEMPS"		=>  utf8_decode($value['ticket_spend_time']),
						// "TRANCHE"		=>  utf8_decode($value['ticket_time_bracket']),
						"MONTANT_HT"	=> number_format($value['total_ht'], 2, ',', ' '),
						"LABEL_HT"		=> utf8_decode('EUR HT'),
					);
					// _debug_array($line);
					$size = $this->addLine(10,$y,$line);
					$y   += $size + 2;
					$totalTicket+=$value['total_ht'];
				}
				
			}
			
			$totalLabel=lang('Sub Total Tickets');
			$this->AddTotalParagraphe($totalLabel,number_format($totalTicket, 2, ',', ' '),utf8_decode("EUR HT"));
			$this->Ln(2);
			$y = $y + 10;
			
		}
		
		//Spirea YLF - 09/08/2011 - traitement des lignes personnalisées
		// $y = 600;
		// $tab_tva = array();
		$totalPerso = 0;
		if(!empty($LignePerso)){
			$so_cat = new so_sql('spid','spid_facture_categories');
			foreach($LignePerso as $key => $data){

				if($data['extra_ht'] != 0){
					$tab_tva[$data['vat_rate']] += $data['extra_ht'];
				}

				if(!empty($data['extra_cat_id'])){
					$cat = $so_cat->read($data['extra_cat_id']);
					$label_paragraphe[$cat['cat_label']] = $cat['cat_label'];
				}
				
				if($data['extra_ht'] != 0){
					
					if(!empty($data['extra_ref'])) $tab_label[] = $data['extra_ref'];
					if(!empty($data['extra_label'])) $tab_label[] = $data['extra_label'];
					if(!empty($data['extra_ns'])) $tab_label[] = lang('S/N').': '.$data['extra_ns'];
					
					$label = '';
					if(!empty($tab_label)){
						$label = utf8_decode('- '.implode("\n",$tab_label));
					}
					
					$quantite = $data['quantity'] == 1 ? '' : lang('Quantity').' '.$data['quantity'];

					// Taux TVA différent de celui de la facture
					$label_tva = '';
					if($facture[0]['facture_tva_id'] != $data['vat_id']){
						$so_vat = new so_sql('spireapi','spireapi_vat');
						$tva = $so_vat->read($data['vat_id']);
						
						$label_tva = "\n".'( '.lang('VAT').' '.$tva['vat_rate'].'%)';
					}

					$lines[] = array(
						"LABEL"			=> $label,
						"QUANTITE"		=> utf8_decode($quantite),
						"MONTANT_HT"	=> number_format($data['extra_ht'], 2, ',', ' ').$label_tva,
						"LABEL_HT"		=> utf8_decode('EUR HT'),
					);
				
				}else{
					if(!empty($data['extra_ref'])) $tab_label[] = $data['extra_ref'];
					if(!empty($data['extra_label'])) $tab_label[] = $data['extra_label'];
					if(!empty($data['extra_ns'])) $tab_label[] = lang('S/N').': '.$data['extra_ns'];
					
					$label = '';
					if(!empty($tab_label)){
						$label = utf8_decode('- '.implode("\n",$tab_label));
					}
					
					$lines[] = array(
						"LABEL"			=> $label,
					);
				
				}
				unset($tab_label);
				$totalPerso += $data['extra_ht'];
			}
			// $y = $y + 15;
			// $y = $this->getY();
			// $y = $y + 15;
			
			$this->Ln(2);
			// $y = $y + 8;
			$this->AddParagraphe(implode(', ',$label_paragraphe),'B');
			// $this->Ln(2);
			// espace juste après la rubrique de titre du paragraphe
			$y = $y + 8;
			
			$cols=array(
				"LABEL"			=> 124,
				"QUANTITE"		=> 25,
				"MONTANT_HT"	=> 20,
				"LABEL_HT"		=> 25,
			);
			$this->addCols($cols);
			$cols=array(
				"LABEL"			=> "L",
				"QUANTITE"		=> "R",
				"X"				=> "J",
				"MONTANT_HT"	=> "R",
				"LABEL_HT"		=> "L",
			);
			$this->addLineFormat($cols);
			
			$origine = $fin = $nb_ligne = 0;
			foreach($lines as $line){
				// _debug_array($line);
				// addLine($colone,$ligne,$tab,$trace_ligne=0

				$this->SetFont('Arial','',9);
				$origine = $this->GetY();

				$size = $this->addLine(10,$y,$line);
				
				$fin = $this->GetY();
				$nb_ligne = explode("\n",$line['LABEL']);
				$hauteur = $fin - $origine;
				// _debug_array($hauteur);

				$y += $size + 4;
			}

			if($totalPerso > 0) {
				// $y = $this->getY() + 10;
				// $this->SetY($this->getY() + 10);
				$totalLabel = lang('Sub Total Custom Lines');
				// if($origine == $fin){
					// $this->Ln(2);
				// }else{
					// $this->Ln(count($nb_ligne)*4);

				// $this->Ln($hauteur - 3);
				// }
				$this->Ln(count($nb_ligne)*3);
				
				$this->AddTotalParagraphe($totalLabel,number_format($totalPerso, 2, ',', ' '),utf8_decode("EUR HT"));
				$this->Ln(3);
				$y = $y+10;
			}
		}

		$totalParagraphe = $totalTicket + $totalPerso;
		$facture[0]['invoice_message']=nl2br($facture[0]['invoice_message']);
		if(!empty($facture[0]['invoice_message'])){
			$lignes = $this->AddMessage(utf8_decode("NB: ".$facture[0]['invoice_message']));
			// $y += $lignes*2 + 5;
			$y = $this->GetY();
			
		}
		
		// $y = $this->getY();
		
		// $this->Ln(10);
		
		// bloc total 
		//Disable automatic page break
		// $this->SetAutoPageBreak(false);
		
		$this->Ln(10);
		$cols=array(
			"LABEL"		=> 35,
			"DEVISE"	=> 15,
			"MONTANT"	=> 22,
		);
		$this->addCols($cols);
		$cols=array(
			"LABEL"    	=> "L",
			"DEVISE"	=> "L",
			"MONTANT"   => "R",
		);
		
		
		$this->addLineFormat($cols);
		$this->Ln(2);

		$y = $y + 2;
		// test si on bascule sur une seconde page...
		if($y > 250) 
		{
			$y_pdf = $this->getY();
			$y = $y_pdf + 30;

			$this->addPage();

			$y = $this->GetY();
		}
		
		$line = array(
			"LABEL"		=> $montantHT,
            "DEVISE"	=> utf8_decode("EUR"),
            "MONTANT"	=> number_format($totalParagraphe, 2, ',', ' '),
		);
		$this->addLine(118,$y,$line);
		//$size = $this->addLine(118,$y,$line);
		// $y   += $size + 2;
		$y = $y+5;
		
		// Récupération du taux de TVA
		$so_vat = new so_sql('spireapi','spireapi_vat');
		$tva = $so_vat->read($facture[0]['facture_tva_id']);

		$total_tva = 0;
		foreach($tab_tva as $taux => $montant_ht){
			$montant_tva = $taux==0 ? 0 : $montant_ht * $taux / 100;
			
			/*echo $montant_ht;
			echo "   ";
			echo $taux;
			echo "   ";
			echo $montant_tva;*/
			
			$line = array(
				"LABEL"		=> lang('VAT').' '.$taux.'%',
				"DEVISE"	=> utf8_decode("EUR"),
				"MONTANT"	=> number_format($montant_tva, 2, ',', ' '),
			);
			$size = $this->addLine(118, $y, $line, 0);

			// $total_tva += $montant_tva * $taux / 100;
			$total_tva += $montant_tva;
			
			$y += $size;
		}

		$size = $this->addLine(118,$y-$size,'',1);

		// $total_tva = $facture[0]['facture_tva'] ? $totalParagraphe*$tva['vat_rate']/100 : '';
		// if($facture[0]['facture_tva']){
		// 	$line = array(
		// 		"LABEL"		=> $montantTVA,
		// 		"DEVISE"	=> utf8_decode("EUR"),
		// 		"MONTANT"	=> number_format($total_tva, 2, ',', ' '),
		// 	);
		// 	$size = $this->addLine(118,$y,$line,1);
		// 	$y += $size + 2;
		// }else{
		// 	$line = array(
		// 		"LABEL"		=> '',
		// 		"DEVISE"	=> '',
		// 		"MONTANT"	=> '',
		// 	);
		// 	$size = $this->addLine(118,$y,$line,1);
		// 	$y += $size + 2;
		// }
		
		$total_ttc = $totalParagraphe + $total_tva;
		$line = array(
			"LABEL"		=> $montantTTC,
            "DEVISE"	=> utf8_decode("EUR"),
            "MONTANT"	=> number_format($total_ttc, 2, ',', ' '),
		);
		$this->addLine(118,$y,$line,2);
		$this->addLine(118,$y,$line,2);

		// $this->AddNumeroFacture($facture[0]['facture_number'], $total_ttc);
		// if(!empty($modePaiementClient)) {
		// 	$this->AddModeReglement(lang($modePaiementClient));
		// }

		// $modele_paiement=$this->facture_ui->get_mode_reglement();
		// $delai_paiement=$this->facture_ui->get_delai_paiement();
		// $modePaiementClient= $delai_paiement[$relationClientSociete[0]['payment_model']];
		// $this->AddModeReglement($modePaiementClient);

		//on réautorise le pagebreak
		//$this->SetAutoPageBreak(true,40);
		
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
			// Période à traiter
			$month = array('start' => mktime(0,0,0,date('n')-1,1), 'end' => mktime(0,0,0,date('n'),1));
			$year = array('start' => mktime(0,0,0,1,1), 'end' => mktime(0,0,0,1,1,date('Y')+1));
			$lastYear = array('start' => mktime(0,0,0,1,1,date('Y')-1), 'end' => mktime(0,0,0,1,1));

			$times = array(
				$month,
				$year,
				$lastYear,
			);
			
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
		
				
		// TCH - Debug SIMULATION
		if ($simul){
			$this->Output();
		}
	}
}

?>