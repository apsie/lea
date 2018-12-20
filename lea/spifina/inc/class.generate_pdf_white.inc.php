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
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.chiffreEnLettre.inc.php');


class generate_pdf_white extends fpdf{

	var $colonnes;
	var $format;
	var $societeEmetteur=array();
	var $societeClient=array();
	var $facture = array();
	var $facture_ui;
	var $lastPage;
	
	
	function generate_pdf_white(){
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

		$this->contract = $this->facture_ui->so_contrat->read($this->facture[0]['contract_id']);
		// $this->contract = $this->facture_ui->so_contrat->read(1);
		$this->payeur = $this->facture_ui->so_client->read($this->contract['contract_payer']);
		$this->mandataire = $this->facture_ui->so_client->read($this->contract['contract_attorney']);
	}

	function Decoupe($texte, $longueur){
	/**
	 * Découpe le texte $texte dans un tableau ou la premiere longueur sera $longueur
	 */
		$cw = $this->CurrentFont['cw'];
		$texte = str_replace("\r",'',$texte);
		$nb = strlen($texte);
		$wmax = ($longueur-2*$this->cMargin)*1000/$this->FontSize;

		$start = 0;
		$espace = -1;
		for($i = 0; $i < $nb; $i++){
			$l += $cw[$texte[$i]];
			if($texte[$i] == ' '){
				$espace = $i;
			}
			if($l > $wmax){
				if($espace == -1){
					$retour[] = substr($texte,$start,$i);
					$start = $i+1;
					++$i;
					$wmax = (95-2*$this->cMargin)*1000/$this->FontSize;
					$l = 0;
				}else{
					$retour[] = trim(substr($texte,$start,$espace-$start));
					$start = $espace;
					$i = $espace+1;
					$espace = -1;
					$wmax = (95-2*$this->cMargin)*1000/$this->FontSize;
					$l = 0;
				}
			}
		}
		
		$retour[] = trim(substr($texte,$start,$i));
		return $retour;
	}

	function WriteHTML($html){
	/**
	 * Parseur HTML
	 */
		// Compteur de ligne (permet de savoir combien de ligne ont été écrite
		$this->nb_ligne = 0;
		$html = str_replace("\n"," ",$html);
		// Découpage du texte en fonction des balises
		$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		if($a[count($a)-1] == ''){
			unset($a[count($a)-1]);
		}
		foreach($a as $i=>$e){
			if($i%2==0){
				// Texte
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else{
					if(!empty($e)){
						if($this->li_en_cours){
							if($this->GetX() > 8) $this->Ln();
							// Output bullet
							$this->SetX(3);
							$this->Cell($this->GetStringWidth(chr(149)) + 2,5,chr(149),0);
						}

						// Si on est sur une ligne et que le texte est trop long pour la longueur restante
						if($this->GetStringWidth($e) > (180 - $this->GetX())){
							// On découpe la ligne en tableau (la premiere cellule représentera la fin de la ligne, les autres représente chacune une ligne)
							$e = $this->Decoupe($e,180 - $this->GetX());
							foreach($e as $key => $texte){
								if($key == 0){
									// première cellule, on remplit jusqu'à la fin de la ligne
									$this->Cell(180 - $this->GetX(),5,$texte,0,1);
								}else{
									// autre cellule, on commence une nouvelle ligne
									$this->nb_ligne++;
									$this->SetX(35);
									$this->Cell($this->GetStringWidth($texte),5,$texte,0,0);
								}
							}
						}else{
							// Le texte rentre dans la partie non utilisé de la ligne en cours
							$this->Cell($this->GetStringWidth($e),5,$e,0,0);
						}
					}
				}
			}else{
				// Balise
				if($e[0]=='/'){
					$this->CloseTag(strtoupper(substr($e,1)));
				}elseif($e == 'br /'){
					// Si on a un br on passe à la ligne suivante (a moins que l'on y soit déjà)
					if($this->GetX() > 35){
						$this->nb_ligne++;
						$this->Write(5,"\n");
					}
				}else{
					// Extraction des attributs
					$a2 = explode(' ',$e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach($a2 as $v){
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}

	function OpenTag($tag, $attr){
		// Balise ouvrante
		if($tag=='STRONG')
			$this->SetStyle('B',true);
		if($tag=='EM')
			$this->SetStyle('I',true);
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF = $attr['HREF'];
		if($tag=='BR')
			$this->Ln(5);
		if($tag=='LI')
			$this->li_en_cours = true;
	}

	function CloseTag($tag){
		// Balise fermante
		if($tag=='EM')
			$this->SetStyle('I',true);
		if($tag=='STRONG')
			$this->SetStyle('B',false);
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF = '';
		if($tag=='LI')
			$this->li_en_cours = false;
	}

	function SetStyle($tag, $enable){
		// Modifie le style et sélectionne la police correspondante
		$this->$tag += ($enable ? 1 : -1);
		$style = '';
		foreach(array('B', 'I', 'U') as $s){
			if($this->$s>0)
				$style .= $s;
		}
		$this->SetFont('',$style);
	}

	function PutLink($URL, $txt){
		// Place un hyperlien
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}

	function Header(){
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$this->facture[0]['societe_id']),false);
		$ville = explode(' ',$facture_emeteur[0]['client_locality']);
		
		$this->AddTop();
	}
	
	function Footer(){
	/**
	* Construit le bas de la page PDF
	*/
		$this->SetXY(40,283);
		$this->SetFont('','',7);

		// Adresse
		if(!empty($this->societeEmetteur['client_adr_two_street'])){
			$address = $this->societeEmetteur['client_adr_one_street'].' '.$this->societeEmetteur['client_adr_two_street'].' - '.$this->societeEmetteur['client_postalcode'].' '.$this->societeEmetteur['client_locality'];
		}else{
			$address = $this->societeEmetteur['client_adr_one_street'].' - '.$this->societeEmetteur['client_postalcode'].' '.$this->societeEmetteur['client_locality'];
		}

		// Contacts (tel / fax / site)
		if(!empty($this->societeEmetteur['client_tel'])){
			$data_contact[] = lang('Tel').' : '.$this->societeEmetteur['client_tel'];
		}
		if(!empty($this->societeEmetteur['client_fax'])){
			$data_contact[] = lang('Fax').' : '.$this->societeEmetteur['client_fax'];	
		}
		if(!empty($this->societeEmetteur['client_website'])){
			$data_contact[] = lang('Website').' : '.$this->societeEmetteur['client_website'];
		}
		$contact = implode(' - ', $data_contact);

		$this->MultiCell(130,3,utf8_decode($address.' - '.$contact),0,'C');

		// Footer
		$this->SetX(40);
		$footer_one = str_replace("€", "EUR", $this->societeEmetteur['client_footer_one']);
		$this->Cell(130,3,str_replace("EUR", chr(128), utf8_decode($footer_one)),0,2,'C');
		$this->Cell(130,3,utf8_decode($this->societeEmetteur['client_footer_two']),0,0,'C');
	}   
   
	function addTop(){
	/**
	* Construit les champs concernant les entreprises du PDF
	*/
		$this->SetXY(10,8);

		if(!empty($this->societeEmetteur['client_logo'])){
			$file = fopen($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'],'w+');
			fwrite($file, $this->societeEmetteur['client_logo']);

			$this->Image($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'],10,3,0,15,'JPG');

			// fclose($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id']);
			fclose($file);
			exec('rm -f "'.$GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$this->societeEmetteur['client_id'].'"');
		}
		$this->Ln(25);
		$this->SetTextColor(0,0,0);
		
		$this->SetFont('Arial','', 9);
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

		// Info mandataire
		$this->SetFont('Arial','B', 10);
		$this->SetXY(105,50);

		if(!empty($this->mandataire)){
			$this->MultiCell(100,4,utf8_decode($this->mandataire['client_company']),0,'L',0);

			$this->SetX(100);
			if(!empty($this->mandataire['client_adr_one_street_facturation'])){
				$this->Cell(100,4,utf8_decode($this->mandataire['client_adr_one_street_facturation']),0,2,'L',0);
				
				if(!empty($this->mandataire['client_adr_two_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->mandataire['client_adr_two_street_facturation']),0,2,'L',0);
				
				if(!empty($this->mandataire['client_adr_three_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->mandataire['client_adr_three_street_facturation']),0,2,'L',0);

				$this->Cell(100,4,utf8_decode($this->mandataire['client_postalcode_facturation']." ".$this->mandataire['client_locality_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->mandataire['client_country_facturation']),0,1,'L',0);
			}else{
				$this->Cell(100,4,utf8_decode($this->mandataire['client_adr_one_street']),0,2,'L',0);
				if(!empty($this->mandataire['client_adr_two_street']))
					$this->Cell(100,4,utf8_decode($this->mandataire['client_adr_two_street']),0,2,'L',0);
				// $this->Cell(100,4,utf8_decode($societeClient['client_adr_three_street_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->mandataire['client_postalcode']." ".$this->mandataire['client_locality']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->mandataire['client_country']),0,1,'L',0);
			}
			$this->Ln(4);
		}
		
		$this->SetX(100);
		// $this->payeur = $this->facture_ui->so_client->read($this->societeClient['client_payer']);
		if(!empty($this->payeur)){
			// $this->Cell(100,4,utf8_decode($this->societeClient['client_company']),0,2,'L',0);
			$this->MultiCell(100,4,utf8_decode($this->societeClient['client_company']),0,'L',0);

			$this->SetX(100);
			if(!empty($this->payeur['client_adr_one_street_facturation'])){
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
			// $this->Cell(100,4,utf8_decode($this->societeClient['client_company']),0,2,'L',0);
			$this->MultiCell(100,4,utf8_decode($this->societeClient['client_company']),0,'L',0);
			$this->SetX(100);
			if(!empty($this->societeClient['client_adr_one_street_facturation'])){
				$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_one_street_facturation']),0,2,'L',0);

				if(!empty($this->societeClient['client_adr_two_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_two_street_facturation']),0,2,'L',0);

				if(!empty($this->societeClient['client_adr_three_street_facturation']))
					$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_three_street_facturation']),0,2,'L',0);

				$this->Cell(100,4,utf8_decode($this->societeClient['client_postalcode_facturation']." ".$this->societeClient['client_locality_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->societeClient['client_country_facturation']),0,1,'L',0);
			}else{
				$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_one_street']),0,2,'L',0);
				
				if(!empty($this->societeClient['client_adr_two_street']))
					$this->Cell(100,4,utf8_decode($this->societeClient['client_adr_two_street']),0,2,'L',0);

				// $this->Cell(100,4,utf8_decode($societeClient['client_adr_three_street_facturation']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->societeClient['client_postalcode']." ".$this->societeClient['client_locality']),0,2,'L',0);
				$this->Cell(100,4,utf8_decode($this->societeClient['client_country']),0,1,'L',0);
			}
		}


		// $this->SetXY(100,50);
		$this->Ln();
		
		$this->SetX(100);
		$this->SetFont('','');
		$this->Cell(0,4,utf8_decode($this->societeEmetteur['client_locality'].', '.lang('on').' '.date('d', $this->facture[0]['send_date']).' '.lang(date('F', $this->facture[0]['send_date'])).' '.date('Y', $this->facture[0]['send_date'])),0,1,'L',0);

		$this->Ln();
		$this->Cell(100,5,utf8_decode(lang('Invoice number').' : '.$this->facture[0]['facture_number']),0,1,'L',0);
		$this->Cell(100,5,utf8_decode(lang('Reference').' : '.$this->facture[0]['invoice_message']),0,1,'L',0);

		$this->Ln(5);
		$this->SetFont('','B');
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
// _debug_array($FacturationTableau);
// _debug_array($LignePerso);
		$this->facture = $facture;

		$this->contract = $this->facture_ui->so_contrat->read($this->facture[0]['contract_id']);
		$this->payeur = $this->facture_ui->so_client->read($this->contract['contract_payer']);
		$this->mandataire = $this->facture_ui->so_client->read($this->contract['contract_attorney']);
		
		//Spirea YLF - 28/04/2011 - Modification pour utiliser la valeur societe_id qui est remplit à la création de la facture
		// cette variable contient l'id de l'entreprise que l'on aura choisit comme etant émettrice de la facture
		$facture_client=$this->facture_ui->so_client->search(array('client_id'=>$facture[0]['client_id']),false);
		$facture_emeteur = $this->facture_ui->so_client->search(array('client_id'=>$facture[0]['societe_id']),false);
		
		$prix_parametre='';
		$client_bo = CreateObject("spiclient.client_bo");
		$delai_paiement=$client_bo->get_delai_paiement();
		$modele_paiement=$client_bo->get_mode_reglement();
		

		if(!empty($facture_client[0]['client_mode_reglement']))
			$temp_modePaiementClient[] = lang('by').' '.$modele_paiement[$facture_client[0]['client_mode_reglement']];
		if(!empty($facture[0]['payment_delay']))
			$temp_modePaiementClient[] = $delai_paiement[$facture[0]['payment_delay']];

		$modePaiementClient= implode(', ',$temp_modePaiementClient);
		
		$this->AddPage();
		
		// Si simulation, ajout fond simulation
		if($simul == 1){
			$this->Image('spifina/templates/default/images/simulation.jpg',0,$this->getY(),200);
		}elseif($simul == 2){
			$this->Image('spifina/templates/default/images/proforma.jpg',0,$this->getY(),200);
		}

		$vat['ht'] = 0;

		// Entete
		$this->Cell(150,5,utf8_decode(lang('Label')),1,0,'C',0);
		// $this->Cell(10,5,utf8_decode(lang('Qty')),1,0,'C',0);
		$this->Cell(40,5,utf8_decode(lang('Total')),1,1,'C',0);

		$this->SetFont('','','9');
		// TICKETS
		foreach($FacturationTableau as $data){
			$ticket = $this->facture_ui->so_ticket->read($data['ticket_id']);
			$this->Cell(150,5,utf8_decode(lang('Intervention').' : '.$ticket['ticket_title']),'L',0,'C',0);
			// $this->Cell(10,5,utf8_decode($data['quantity']),0,0,'C',0);
			$this->Cell(40,5,utf8_decode($data['total_ht']).chr(128),'R',1,'R',0);
			$this->Ln(1);

			if(!empty($data['vat_rate'])){
				$vat[$data['vat_rate']] += $data['total_ht'];
			}else{
				$temp_vat = $this->facture_ui->so_vat->read($data['vat_id']);
				$vat[$temp_vat['vat_rate']] += $data['total_ht'];
			}
			$vat['ht'] += $data['total_ht'];
		}

		// LIGNE PERSO
		unset($LignePerso['hide_ns']);
		unset($LignePerso['hide_user']);
		foreach($LignePerso as $data){
			$startY = $this->getY();
			$this->Cell(150,5,utf8_decode($data['extra_ref']),'LR',1,'L',0);
			$this->Cell(150,5,utf8_decode($data['extra_label']),'LR',1,'L',0);

			// $this->setXY(160, $startY);
			// $this->Cell(10,10,utf8_decode($data['quantity']),'LR',0,'C',0);

			// Montant
			$this->setXY(160, $startY);
			$this->Cell(40,10,utf8_decode($data['extra_ht'].' ').chr(128),'R',1,'R',0);

			$this->Cell(150,3,'','LR',0,'C',0);
			$this->Cell(40,3,'','LR',1,'C',0);

			if(!empty($data['vat_rate'])){
				$vat[$data['vat_rate']] += $data['extra_ht'];
			}else{
				$temp_vat = $this->facture_ui->so_vat->read($data['vat_id']);
				$vat[$temp_vat['vat_rate']] += $data['extra_ht'];
			}
			$vat['ht'] += $data['extra_ht'];
		}
		$this->Cell(0,0,'','T',1,'C',0);

		// Totaux
		$this->SetFont('','',9);
		// $this->Ln(1);
		foreach($vat as $vat_rate => $vat_amount){
			if($vat_rate != 0 || $vat_rate == 'ht'){
				if($vat_rate == 'ht'){
					$amount_text = lang('AMOUNT HT');
				}else{
					$amount_text = lang('VAT').' '.$vat_rate.'%';
				}

				$this->SetX(120);
				$this->Cell(40,5,utf8_decode($amount_text),'LR',0,'L',0);

				$this->SetX(160);
				if($vat_rate == 'ht'){
					$amount = $vat_amount;
				}else{
					$amount = $vat_amount * $vat_rate / 100;
				}
				$this->Cell(40,5,utf8_decode(number_format($amount,2,',',' ').' ').chr(128),'LR',1,'R',0);

				$facture_total += $amount;
			}
		}

		$this->SetX(120);
		$this->Cell(0,1,'',1,1,'R',0);

		// Total TTC
		$this->SetFont('','B',9);
		$this->SetX(120);
		$amount_text = lang('AMOUNT TTC');
		$this->Cell(40,5,utf8_decode($amount_text),'LRB',0,'L',0);

		$this->SetX(160);
		$this->Cell(40,5,utf8_decode(number_format($facture_total,2,',',' ').' ').chr(128),'LRB',1,'R',0);

		// Délai réglement
		// $this->SetFont('','',9);
		// $this->Cell(0,5,utf8_decode($modePaiementClient),0,1,'L',0);

		// Information banque
		$this->Ln();
		$bank_suffix = $facture[0]['invoice_bank_account'];

		if(!empty($this->societeEmetteur['client_bic'.$bank_suffix])){
			$this->Cell(20,5,utf8_decode('BIC'),1,0,'L',0);
			$this->Cell(70,5,utf8_decode($this->societeEmetteur['client_bic'.$bank_suffix]),1,1,'C',0);
		}
		if(!empty($this->societeEmetteur['client_iban'.$bank_suffix])){
			$this->Cell(20,5,utf8_decode('IBAN'),1,0,'L',0);
			$this->Cell(70,5,utf8_decode($this->societeEmetteur['client_iban'.$bank_suffix]),1,1,'C',0);
		}

		//TCH - Debug SIMULATION
		if ($simul) 
		{
			$this->Output();
		}
	}
}

?>