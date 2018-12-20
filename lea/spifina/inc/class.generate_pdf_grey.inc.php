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


class generate_pdf_grey extends fpdf{

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
		$ville=explode(' ',$facture_emeteur[0]['client_locality']);
		
		$this->AddTop();
				
		// $this->AddNumeroFacture($this->facture[0]['facture_number']);

		if(!$this->lastPage && $this->PageNo() != 1){
			// $this->addInfo($this->facture[0]['invoice_message']);
			$this->addEnteteTableau($this->facture[0]['facture_tva']);
		}
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
		$this->SetFont('Arial','B', 10);
		$this->Cell(104.3,7,utf8_encode($this->societeEmetteur['client_structure'].' '.$this->societeEmetteur['client_company']),0,2,'L',0);

		$this->SetFont('Arial','', 9);
		$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_adr_one_street']),0,1,'L',0);
		if(!empty($this->societeEmetteur['client_adr_two_street']))
			$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_adr_two_street']),0,1,'L',0);
		$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_postalcode']." ".$this->societeEmetteur['client_locality']),0,1,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('Tel').' : '.$this->societeEmetteur['client_tel']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('Fax').' : '.$this->societeEmetteur['client_fax']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('Mail').' : '.$this->societeEmetteur['client_manager_email']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('Website').' : '.$this->societeEmetteur['client_website']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode($this->societeEmetteur['client_footer_one']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('SIRET').' : '.$this->societeEmetteur['client_siret']),0,2,'L',0);
		$this->Cell(104.3,4,utf8_decode(lang('N° Formation').' : '.$this->societeEmetteur['client_training']),0,1,'L',0);
		
		// Info facture (ID + Date)
		$this->Ln();
		if(!empty($this->facture[0]['send_date'])){
			$this->Cell(70,4,utf8_decode(lang('Invoice num.').' '.$this->facture[0]['facture_number'].' '.lang('of the').' '.date('d/m/Y',$this->facture[0]['send_date'])),0,2,'L',0);
		}else{
			$this->Cell(70,4,utf8_decode(lang('Invoice num.').' '.$this->facture[0]['facture_number']),0,2,'L',0);
		}

		// Info payeur
		$this->SetXY(105,50);
		// $this->payeur = $this->facture_ui->so_client->read($this->societeClient['client_payer']);
		if(!empty($this->payeur)){
			if(!empty($this->payeur['client_adr_one_street_facturation'])){
				$this->Cell(100,4,utf8_decode($this->payeur['client_company']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->payeur['client_adr_one_street_facturation']),0,2,'L',0);
				
				if(!empty($this->payeur['client_adr_two_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->payeur['client_adr_two_street_facturation']),0,2,'L',0);
				
				if(!empty($this->payeur['client_adr_three_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->payeur['client_adr_three_street_facturation']),0,2,'L',0);

				$this->Cell(100,4,utf8_decode($this->payeur['client_postalcode_facturation']." ".$this->payeur['client_locality_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->payeur['client_country_facturation']),0,1,'L',0);
			}else{
				$this->Cell(100,4,utf8_decode($this->payeur['client_adr_one_street']),0,2,'L',0);
				if(!empty($this->payeur['client_adr_two_street']))
					$this->Cell(100,4,utf8_decode($this->payeur['client_adr_two_street']),0,2,'L',0);
				// $this->Cell(100,4,utf8_decode($societeClient['client_adr_three_street_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->payeur['client_postalcode']." ".$this->payeur['client_locality']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->payeur['client_country']),0,1,'L',0);
			}
		}else{
			
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
				$this->Cell(100,4,utf8_decode($this->societeClient['client_country']),0,1,'L',0);
			}
		}

	}

	function addLeft($facture){
		$this->SetXY(105,55);

		// Info mandataire
		// $this->mandataire = $this->facture_ui->so_client->read($this->societeClient['client_attorney']);
		if(!empty($this->mandataire)){
			$this->Cell(80,8,'',0,1,'L',0);
			// $this->mandataire['client_company']
			$this->Cell(80,4,utf8_decode(lang('Attorney').' : '.$this->mandataire['client_structure'].' '.$this->mandataire['client_company']),0,1,'L',0);
			$this->Cell(80,4,utf8_decode($this->mandataire['client_postalcode']." ".$this->mandataire['client_locality']),0,1,'L',0);
			$this->Cell(80,4,utf8_decode(lang('SIRET').' : '.$this->mandataire['client_siret']),0,1,'L',0);
			$this->Cell(80,4,utf8_decode(lang('RCS').' : '.$this->mandataire['client_comm_register']),0,1,'L',0);
		}

		$this->Ln();
		// Prescripteur
		$this->Cell(100,4,utf8_decode(lang('Prescriber').' : '.$this->societeClient['client_company'].' - '.$this->societeClient['client_code_agency']),0,2,'L',0);

		// Message
		if(!empty($facture['invoice_message']))
			$this->Cell(100,4,utf8_decode(lang('Remark').' : '.$facture['invoice_message']),0,2,'L',0);		
	} 
	
	function addInfo($message){
	/** 
	 * Ajoute le message de la facture dans le PDF
	 *
	 * @param String
	 */
		$this->SetXY(10, $this->getY() - 30);
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

	function addEnteteTableau($tva){
		if($tva){
			$header= array(lang('Designation'),lang('Amount'),lang('VAT'));
			$w = array(130,40,20);
		}else{
			$header= array(lang('Designation'),lang('Amount'));
			$w = array(130,60);
		}
		
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
		$ligne_facture = $this->facture_ui->so_factures_details->search(array('facture_id'=>$facture[0]['facture_id']),false,'GROUP BY ticket_id');
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
		$this->addLeft($facture[0]);

		if(!$this->lastPage){
			$this->addEnteteTableau($facture[0]['facture_tva']);
		}
		
		// Si simulation, ajout fond simulation
		if($simul == 1){
			$this->Image('spifina/templates/default/images/simulation.jpg',0,$this->getY(),200);
		}elseif($simul == 2){
			$this->Image('spifina/templates/default/images/proforma.jpg',0,$this->getY(),200);
		}
		
		$w=array(130,40,20);
		$this->SetLineWidth(.3);
		
		$this->SetFillColor(224,235,255);
		$this->SetFont('');

		$tab_tva = array();		

		if(!empty($FacturationTableau)){
			$total_ticket = 0;
			foreach($FacturationTableau as $id => $data){
				$tab_tva[$data['vat_rate']] += $data['total_ht'];

				$fields = '*';
				if($this->facture_ui->obj_config['synchro_presta']){
					$join = 'LEFT JOIN egw_prestation P ON P.lettre_de_commande = spid_tickets.ticket_client_order_id LEFT JOIN egw_contact C ON C.id_ben = P.id_ben LEFT JOIN egw_contact_parcours_pro PP ON C.id_ben = PP.id_ben';
					$fields = 'spid_tickets.*,nom_complet,id_presta,P.date_debut,P.date_fin,identifiant,date_fin_reelle';
				}
				$ticket = $this->facture_ui->so_ticket->search(array('ticket_id'=>$data['ticket_id']),$fields,'ticket_id ASC','','',false,'OR',false,'',$join);
				// _debug_array($ticket);

				$this->SetFont('','B');
				$startY = $this->getY();
				$startX = $this->getX();
				$this->MultiCell($w[0],7,utf8_decode($ticket[0]['ticket_title']),'LRT','C',0);
				
				$this->SetFont('','');
				// Numéro de marché
				$contract = $this->facture_ui->so_contrat->read($ticket[0]['contract_id']);
				if(!empty($contract['contract_title'])){
					$this->Cell(60,4,utf8_decode(lang('Service').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($contract['contract_title']),'R',1,'L',0);
				}
				if(!empty($contract['contract_client_ref'])){
					$this->Cell(60,4,utf8_decode(lang('Market number').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($contract['contract_client_ref']),'R',1,'L',0);
				}

				// Numero de commande
				if(!empty($ticket[0]['ticket_client_order_id'])){
					$this->Cell(60,4,utf8_decode(lang('Client order').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['ticket_client_order_id']),'R',1,'L',0);
				}

				// Bénéficiaire (Presta)
				if(!empty($ticket[0]['nom_complet'])){
					$this->Cell(60,4,utf8_decode(lang('Beneficiary').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['nom_complet']),'R',1,'L',0);
				}

				// Identifiant
				if(!empty($ticket[0]['identifiant'])){
					$this->Cell(60,4,utf8_decode(lang('Identifier').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['identifiant']),'R',1,'L',0);
				}
				
				// Date de debut
				if(!empty($ticket[0]['P.date_debut'])){
					$this->Cell(60,4,utf8_decode(lang('Start date').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['P.date_debut']),'R',1,'L',0);
				}

				// Date de fin
				if(!empty($ticket[0]['P.date_fin'])){
					$this->Cell(60,4,utf8_decode(lang('End date').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['P.date_fin']),'R',1,'L',0);
				}

				// Date de fin reelle
				if(!empty($ticket[0]['date_fin_reelle'])){
					$this->Cell(60,4,utf8_decode(lang('Real end date').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($ticket[0]['date_fin_reelle']),'R',1,'L',0);
				}

				// Prix contrat
				if(!empty($contract['contract_default_price'])){
					$this->Cell(60,4,utf8_decode(lang('Contract price').' :'),'L',0,'L',0);
					$this->Cell(70,4,utf8_decode($contract['contract_default_price']),'R',1,'L',0);
				}

				$status = $this->facture_ui->so_etats->read($ticket[0]['state_id']);
				$this->Cell(60,4,utf8_decode(lang('Price for status').' '.$status['state_name'].':'),'L',0,'L',0);
				$this->Cell(70,4,utf8_decode($data['total_ht']),'R',1,'L',0);

				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
				
				
				$startY = $this->getY();
				$this->MultiCell($w[1],$newY-$startY,utf8_decode(number_format($data['total_ht'],2,'.',' ').' EUR'),'LTRB','R',0);
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);

				// Taux TVA
				$this->MultiCell($w[2],$newY-$startY,utf8_decode(number_format($data['vat_rate'],2,'.',' ').' %'),'LTRB','R',0);
				$total_ticket += $data['total_ht'];
				$this->setY($newY);
				$this->SetFont('');
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

		$total_tva = $facture[0]['facture_tva'] ? ($total_ticket+$total_lp)*$facture[0]['facture_taux_tva']/100 : '';

		/*** Sous totaux TVA ****/
		$posY = $this->GetY();
		$this->Ln(2);
		if($facture[0]['facture_tva']){
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
				// if(!empty($montant_ht)){
					if(is_numeric($montant_ht)){
						$this->MultiCell($w[1],7,number_format($montant_ht,2,'.',' ').' EUR',1,'R',$fill);
					}else{
						$this->MultiCell($w[1],7,$montant_ht,1,'R',$fill);
					}
				// }else{
				// 	$this->MultiCell($w[1],7,'-',1,'R',$fill);
				// }
				
				$newY = $this->getY();
				$this->setXY($this->getX()+$w[0]+$w[1],$startY <= 250 ? $startY : $newY-7);
				if($montant_tva != 0){
					$this->MultiCell($w[2],7,number_format($montant_tva,2,'.',' ').' EUR',1,'R',$fill);
				}else{
					$this->MultiCell($w[2],7,'-',1,'R',$fill);
				}
				$fill = $fill ? false : true;

				$total_tva += $montant_tva;
			}
		}
		/**** FIN - Sous totaux TVA ****/
		
		if($facture[0]['facture_tva']){
			$total = array(
				lang('Sub-Total HT') => $total_ticket+$total_lp,
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
		foreach($total as $label => $valeur){
			
			$startY = $this->getY();
			
			$this->MultiCell($w[0],7,utf8_decode($label),'R','R',0);
			$newY = $this->getY();
			$this->setXY($this->getX()+$w[0],$startY <= 250 ? $startY : $newY-7);
			
			$this->SetFont('','B');

			// if(!empty($valeur)){
				$this->MultiCell($w[1]+$w[2],7,number_format($valeur,2,'.',' ').' EUR',1,'R',$fill);
			// }else{
			// 	$this->MultiCell($w[1]+$w[2],7,'',1,'R',$fill);
			// }
			$this->SetFont('');
			$fill = $fill ? false : true;
		}

		// Info bancaire
		$client_bank = empty($this->mandataire) ? $this->societeEmetteur : $this->mandataire;

		$this->SetXY(10,$posY+5);
		$this->SetFont('','B',9);
		$this->SetFillColor(255,255,255);
		$this->Cell(100,6,utf8_decode(lang('Bank informations').' - '.$client_bank['client_company']),'LTR',2,'L',1);

		$this->SetFont('','',10);
		$this->Cell(100,6,utf8_decode(lang('IBAN').' : '.$client_bank['client_iban']),'LR',2,'L',1);
		$this->Cell(100,6,utf8_decode(lang('BIC').' : '.$client_bank['client_bic']),'LRB',0,'L',1);

		// $this->AddModeReglement($modePaiementClient);
		$this->addInfo($this->facture[0]['invoice_message']);
		
		//TCH - Debug SIMULATION
		if ($simul) 
		{
			$this->Output();
		}
	}

}

?>