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
		$x1 = 20;
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
		$x1 = 20;
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
		$x1 = 20;
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
		$x1 = 20;
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
		$x1 = 20;
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
		$this->Ln(20);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les tickets "résolu par suivi" sont résolus dans le cadre du forfait de maintenance';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les tickets "résolu par assistance à distance" font l\'objet d\' une facturation dans la rubrique "assitance à distance".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
		$this->SetX($x1);
		$txt='Les tickets "résolu par intervention urgente" font l\'objet d\' une facturation dans la rubrique "interventions non planifiées".';
		$txt=utf8_decode($txt);
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth($txt);
		$this->Cell($length,2,$txt);
		$this->Ln(5);
		$x1 = 20;
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
		$x1 = 20;
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
		$x1 = 20;
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
		$x1 = 20;
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
		$ligne_facture = $facture_ui->so_factures_details->search(array('facture_id'=>$facture[0]['facture_id']),false,'GROUP BY ticket_id');
		$FacturationTableau=array();

		$tab_tva = array();
	
	
		foreach($ligne_facture as $cle=>$value){
				
			// _debug_array($value);
			if($value['total_ht'] != 0){
				$tab_tva[$value['vat_rate']] += $value['total_ht'];
			}

			if(empty($value['extra_rank'])){
				$label=$facture_ui->so_etats->search(array('state_id'=>$value['state_id']),'facturation_label');
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
			}
		}

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
		
		if(!empty($FacturationTableau)){
			//$this->AddRappelTarif($label_RappelTarif);

			$this->AddParagraphe(lang('invoice tickets'));
			$this->Ln(2);
			$y   = $y + 10;
			$cols=array(
				"LABEL"			=> 90,
				"QUANTITE"		=> 8,
				"X"				=> 8,
				"TEMPS"			=> 25,
				"MONTANT_HT"	=> 27,
				"LABEL_HT"		=> 27,
			);
			$this->addCols($cols);
			$cols=array(
				"LABEL"			=> "L",
				"QUANTITE"		=> "J",
				"X"				=> "J",
				"TEMPS"			=> "R",
				"MONTANT_HT"	=> "R",
				"LABEL_HT"		=> "L",
			);
			$this->addLineFormat($cols);
			// $this->Ln(5);
			// $y = $this->getY();
			$totalParagraph=0;
		
			$factureTableau=array();
			$increment=0;
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
					
					
					if(isset($ticket[0]['ticket_nb_student']) && $ticket[0]['ticket_price_student'] > 0){
						// Prix par étudiant
						$label=$_valeur['label'].' ('.$temps_reel_ticket.')';
						$quantite = 1;
						foreach($factureTableau as $id_ligne => $value_ligne){
							if($value_ligne['LABEL'] == $label){
								$quantite = $factureTableau[$id_ligne]['QUANTITE'] + 1;
								unset($factureTableau[$id_ligne]);
							}
						}
						$factureTableau[$increment]['QUANTITE']=$quantite;
						$factureTableau[$increment]['LABEL']=$label;
						$factureTableau[$increment]['MONTANT_UHT']=$ticket[0]['ticket_nb_student'] * $ticket[0]['ticket_price_student'];
						$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
					}else{
						// SPIREA YLF - 09/07/2013 - Prix du contrat 
						$prix_contrat = $facture_ui->so_prix_parametres->search(array('contract_id'=>$ticket[0]['contract_id'],'state_id'=>$_cle),false);
						if(is_array($prix_contrat) && !empty($prix_contrat)){
							$label=$_valeur['label'].' ('.$temps_reel_ticket.')';
							$quantite = 1;
							foreach($factureTableau as $id_ligne => $value_ligne){
								if($value_ligne['LABEL'] == $label){
									$quantite = $factureTableau[$id_ligne]['QUANTITE'] + 1;
									unset($factureTableau[$id_ligne]);
								}
							}
							$factureTableau[$increment]['QUANTITE']=$quantite;
							$factureTableau[$increment]['LABEL']=$label;
							if($prix_contrat[0]['ticket_spend_time'] != 0){
								$factureTableau[$increment]['MONTANT_UHT']=$tps_ticket*$prix_contrat[0]['price_ht']/$prix_contrat[0]['ticket_spend_time'];
							}else{
								$factureTableau[$increment]['MONTANT_UHT']=$prix_contrat[0]['price_ht'];
							}
							$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
							$increment++;
						}else{
							//Spirea YLF - 05/05/2011 - Prise en compte du prix dans l'état
							$prix_etats = $facture_ui->so_etats->search(array('state_id'=>$_cle),false);
							if($prix_etats[0]['state_price'] != 0){
								$label=$_valeur['label'].' ('.$temps_reel_ticket.')';
								$quantite = 1;
								foreach($factureTableau as $id_ligne => $value_ligne){
									if($value_ligne['LABEL'] == $label){
										$quantite = $factureTableau[$id_ligne]['QUANTITE'] + 1;
										unset($factureTableau[$id_ligne]);
									}
								}
								$factureTableau[$increment]['QUANTITE']=$quantite;
								$factureTableau[$increment]['LABEL']=$label;
								$factureTableau[$increment]['MONTANT_UHT']=$prix_etats[0]['state_price'];
								$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
							}else{
								$prix_param_etat=$facture_ui->so_prix_parametres->search(array('client_id'=>$facture[0]['client_id'],'state_id'=>$_cle),false);
								if(is_array($prix_param_etat) && !empty($prix_param_etat)){
									$label=$_valeur['label'].' ('.$temps_reel_ticket.')';
									$quantite = 1;
									foreach($factureTableau as $id_ligne => $value_ligne){
										if($value_ligne['LABEL'] == $label){
											$quantite = $factureTableau[$id_ligne]['QUANTITE'] + 1;
											unset($factureTableau[$id_ligne]);
										}
									}
									$factureTableau[$increment]['QUANTITE']=$quantite;
									$factureTableau[$increment]['LABEL']=$label;
									if($prix_param_etat[0]['ticket_spend_time'] != 0){
										$factureTableau[$increment]['MONTANT_UHT']=$tps_ticket*$prix_param_etat[0]['price_ht']/$prix_param_etat[0]['ticket_spend_time'];
									}else{
										$factureTableau[$increment]['MONTANT_UHT']=$prix_param_etat[0]['price_ht'];
									}
									$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
									$increment++;
								}else{
									$etats=$facture_ui->so_etats->read(array('state_id'=>$_cle),'state_billable');
									if(count($_valeur['tickets'])>=1){
										// $tab_tps_ticket=array();
										// foreach($_valeur['tickets'] as $_num_ticket=>$_tps_ticket){
											// $tab_tps_ticket[$_tps_ticket]++;
										// }
										// ksort($tab_tps_ticket);
										// foreach($tab_tps_ticket as $tempsDesTickets=>$nbTotalTicket){
											// $label=$_valeur['label'].' ('.$temps_reel_ticket.' mn)';
											$label=$_valeur['label'].' ('.$temps_reel_ticket.')';
											$quantite = 1;
											foreach($factureTableau as $id_ligne => $value_ligne){
												if($value_ligne['LABEL'] == $label){
													$quantite = $factureTableau[$id_ligne]['QUANTITE'] + 1;
													unset($factureTableau[$id_ligne]);
												}
											}
											$factureTableau[$increment]['LABEL']=$label;
											// foreach($_valeur['tickets'] as $_num_ticket=>$_tps_ticket){
												// $temp_ticket = $facture_ui->so_ticket->search(array('ticket_id'=>$_num_ticket),false);
												// $tab_tps_ticket[$_tps_ticket.$temp_ticket[0]['ticket_unit_time']]++;
											// }
											$factureTableau[$increment]['QUANTITE']=$quantite;
											if($etats['state_billable']==1){
												switch($ticket[0]['ticket_unit_time']){
													case 0:
														$factureTableau[$increment]['MONTANT_UHT']=($tps_ticket*$facture_ui->obj_config['initial_price_minute'])/$facture_ui->obj_config['initial_time_minute'];
														break;
													case 1:
														$factureTableau[$increment]['MONTANT_UHT']=($tps_ticket*$facture_ui->obj_config['initial_price_hour']);
														break;
													case 2:
														$factureTableau[$increment]['MONTANT_UHT']=($tps_ticket*$facture_ui->obj_config['initial_price_day']);
														break;
												}
											}else{
												$factureTableau[$increment]['MONTANT_UHT']=0;
											}
											$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
											$increment++;
									}else{
										if($etats['state_billable']==1){
											switch($ticket[0]['ticket_unit_time']){
												case 0:
													$factureTableau[$increment]['MONTANT_UHT']=$facture_ui->obj_config['initial_price_minute'];
													break;
												case 1:
													$factureTableau[$increment]['MONTANT_UHT']=$facture_ui->obj_config['initial_price_hour'];
													break;
												case 2:
													$factureTableau[$increment]['MONTANT_UHT']=$facture_ui->obj_config['initial_price_day'];
													break;
											}
											
										}else{
											$factureTableau[$increment]['MONTANT_UHT']=0;
										}
										$factureTableau[$increment]['MONTANT_HT']=$factureTableau[$increment]['MONTANT_UHT']*$factureTableau[$increment]['QUANTITE'];
									}
								}
							}
						}
					}
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
			foreach($factureTableau as $cle=>$value){
				$line = array(
					"LABEL"			=> utf8_decode('- '.$value['LABEL']),
					"QUANTITE"		=> $value['QUANTITE'],
					"X"				=> utf8_decode(" x "),
					"TEMPS"			=> (number_format($value['MONTANT_UHT'], 2, ',', ' ')),
					//.utf8_decode(' EUR HT')
					"MONTANT_HT"	=> number_format($value['MONTANT_HT'], 2, ',', ' '),
					"LABEL_HT"		=> utf8_decode('EUR HT'),
				);
				$size = $this->addLine(20,$y,$line);
				$y   += $size + 2;
				$totalTicket+=$value['MONTANT_HT'];
			}
			$totalLabel=lang('Sub Total Tickets');
			$this->AddTotalParagraphe($totalLabel,number_format($totalTicket, 2, ',', ' '),utf8_decode("EUR HT"));
			$this->Ln(3);
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
			// $this->Ln(2);
			$this->AddParagraphe(implode(', ',$label_paragraphe),'B');
			$this->Ln(2);
			// espace juste après la rubrique de titre du paragraphe
			$y = $y + 8;
			
			$cols=array(
				"LABEL"			=> 106,
				"QUANTITE"		=> 25,
				"MONTANT_HT"	=> 27,
				"LABEL_HT"		=> 27,
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

				$size = $this->addLine(20,$y,$line);
				
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

				$this->Ln($hauteur - 3);
				// }
				$this->AddTotalParagraphe($totalLabel,number_format($totalPerso, 2, ',', ' '),utf8_decode("EUR HT"));
				$this->Ln(3);
				$y = $y+10;
			}
		}

		$totalParagraphe = $totalTicket + $totalPerso;
		$facture[0]['invoice_message']=nl2br($facture[0]['invoice_message']);
		if(!empty($facture[0]['invoice_message'])){
			$lignes = $this->AddMessage(utf8_decode($facture[0]['invoice_message']));
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
		}
		
				
			//TCH - Debug SIMULATION
		if ($simul) 
			{
			$this->Output();
			}
	}
}

?>