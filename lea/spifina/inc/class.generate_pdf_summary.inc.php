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


class generate_pdf_summary extends fpdf{

	var $colonnes;
	var $format;
	var $societeEmetteur=array();
	var $societeClient=array();
	var $facture = array();
	var $facture_ui;
	var $lastPage;
	
	
	function generate_pdf_summary(){
	/**
	 * Constructeur
	 */
		self::__construct();
	}
	
	function __construct($contract_id=array(), $stats_ui=array()){
	/**
	 * Méthode appelée directement par le constructeur. Charge les variables globales. $emetteur est un tableau décrivant la socité émettrice
	 * $client esu une tableau décrivant la société cliente
	 *
	 * @param array $emetteur=array()
	 * @param array $client=array()
	 */
		define('FPDF_FONTPATH',EGW_INCLUDE_ROOT.'/spifina/fpdf/font/');
		parent::FPDF('P', 'mm', 'A4');

		$this->contract_id = $contract_id;

		$this->stats_ui = new stats_ui();
		$this->contract = $this->stats_ui->so_contrat->read($contract_id);
	}

	function Header(){
	/**
	 * Entete de page
	 */
		$this->AddTop();
	}

	function addTop(){
	/**
	* Construit les champs concernant les entreprises du PDF
	*/
		$this->SetXY(10,8);
		
		$supplier = $this->stats_ui->so_client->read($this->contract['contract_supplier']);
		$client = $this->stats_ui->so_client->read($this->contract['contract_client']);

		if(!empty($supplier['client_logo'])){
			$file = fopen($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$supplier['client_id'],'w+');
			fwrite($file, $supplier['client_logo']);

			$this->Image($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$supplier['client_id'],10,8,0,25,'JPG');

			fclose($GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$supplier['client_id']);
			exec('rm -f "'.$GLOBALS['egw_info']['server']['temp_dir'].'/spifiling_logo_'.$supplier['client_id'].'"');
		}
		$this->Ln(25);
		$this->SetTextColor(0,0,0);
		

		// Info Emetteur facture
		$this->SetFont('Arial','B', 10);

		// Info payeur
		$this->SetXY(105,25);

		$this->Cell(100,4,utf8_decode($client['client_company']),0,2,'L',0);
		if(!empty($client['client_adr_one_street_facturation'])){
			$this->Cell(100,4,utf8_decode($client['client_adr_one_street_facturation']),0,2,'L',0);

			if(!empty($client['client_adr_two_street_facturation']))
				$this->Cell(100,4,utf8_decode($client['client_adr_two_street_facturation']),0,2,'L',0);

			if(!empty($client['client_adr_three_street_facturation']))
				$this->Cell(100,4,utf8_decode($client['client_adr_three_street_facturation']),0,2,'L',0);

			$this->Cell(100,4,utf8_decode($client['client_postalcode_facturation']." ".$client['client_locality_facturation']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($client['client_country_facturation']),0,1,'L',0);
		}else{
			$this->Cell(100,4,utf8_decode($client['client_adr_one_street']),0,2,'L',0);
			
			if(!empty($client['client_adr_two_street']))
				$this->Cell(100,4,utf8_decode($client['client_adr_two_street']),0,2,'L',0);

			// $this->Cell(100,4,utf8_decode($societeClient['client_adr_three_street_facturation']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($client['client_postalcode']." ".$client['client_locality']),0,2,'L',0);
			$this->Cell(100,4,utf8_decode($client['client_country']),0,1,'L',0);
		}


		$this->SetXY(105,50);
		$this->Ln();
		
		$this->Cell(100,4,utf8_decode(lang('V/Ref').' : '.$this->contract['contract_client_ref']),0,1,'L',0);
		$this->Cell(100,4,utf8_decode(lang('N/Ref').' : '.$this->contract['contract_title']),0,1,'L',0);

		$this->SetX(105);
		$this->SetFont('','');
		$this->Cell(0,4,utf8_decode($supplier['client_locality'].', '.lang('on').' '.date('d').' '.lang(date('F')).' '.date('Y')),0,1,'L',0);

		$this->Ln(5);
		$this->SetFont('','B');

		$this->SetX(55);
		$this->Cell(110,12,utf8_decode(lang('Contract :').' '.$this->contract['contract_title']),1,1,'C',0);
		$this->Ln(5);
	}

	function Footer(){
	/**
	 * Pied de page
	 */
		
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

	function generate($contract_id,$stats_ui,$simul=false){
	/**
	* Imprime sur une imprimante partagée (requiert Acrobat 6 ou supérieur)
	*
	* @param $contract_id
	* @param $stats_ui
	* @param $simul : par défaut false, mais si vrai, alors on sauvegarde pas la facture et on met "SIMULATION" en filigrame
	*/		
		$this->AddPage();

		$this->SetFont('Arial','B', 12);
		$this->Cell(0,8,utf8_decode('Tableau récapitulatif des facturations et paiements'),0,1,'C',0);
		
		
		// BUDGET
		$this->SetFont('Arial','B', 12);
		$this->Cell(150,8,utf8_decode(lang('BUDGET')),0,1,'L',0);

		$this->SetFont('Arial','', 10);
		$budgets = $this->stats_ui->so_contrat_budget->search(array('contract_id' => $contract_id), false);
		foreach($budgets as $budget){
			$this->Cell(60,6,utf8_decode($budget['budget_phase']),0,0,'L',0);
			$this->Cell(50,6,utf8_decode(number_format($budget['budget_sell'],2,'.',' ').' ').chr(128),0,1,'R',0);

			$total_vente += $budget['budget_sell'];
		}
		$this->SetFont('Arial','B', 10);
		$this->Cell(60,6,utf8_decode(lang('Total sell')),0,0,'L',0);
		$this->Cell(50,6,utf8_decode(number_format($total_vente,2,'.',' ').' ').chr(128),0,1,'R',0);

		$this->Ln(5);

		// FACTURATION
		$this->SetFont('Arial','B', 12);
		$this->Cell(140,6,utf8_decode(lang('Invoicing')),0,0,'L',0);
		$this->Cell(50,6,utf8_decode(lang('Payment')),'L',1,'L',0);
		
		$this->SetFont('Arial','', 10);
		$startY = $this->GetY();
		$startX = $this->GetX();
		$this->MultiCell(60,5,utf8_decode(lang('Invoice label')),0,'C');
		$maxY = $this->GetY() > $maxY ? $this->GetY() : $maxY;
		$this->setXY($startX+60, $startY);
		$this->MultiCell(20,5,utf8_decode(lang('Invoice date')),0,'C');
		$maxY = $this->GetY() > $maxY ? $this->GetY() : $maxY;
		$this->setXY($startX+60+20, $startY);
		$this->MultiCell(30,5,utf8_decode(lang('HT Amount')),0,'C');
		$maxY = $this->GetY() > $maxY ? $this->GetY() : $maxY;
		$this->setXY($startX+60+20+30, $startY);
		$this->MultiCell(30,5,utf8_decode(lang('TTC Amount')),0,'C');
		$maxY = $this->GetY() > $maxY ? $this->GetY() : $maxY;
		$this->setXY($startX+60+20+30+30, $startY);
		$this->MultiCell(20,5,utf8_decode(lang('Payment date')),0,'C');
		$maxY = $this->GetY() > $maxY ? $this->GetY() : $maxY;
		$this->setXY($startX+60+20+30+30+20, $startY);
		$this->MultiCell(30,5,utf8_decode(lang('Payment amount')),0,'C');
		$this->Line(10, $maxY, 200, $maxY);
		$this->Line(150, $startY, 150, $maxY);
		$this->SetXY(10, $maxY);

		$invoices = $this->stats_ui->so_factures->search(array('contract_id' => $contract_id, 'invoice_validate' => '1'), false, 'facture_number DESC');
		foreach($invoices as $invoice){
			$total = 0;
			$total_ttc = 0;
			$details = $this->stats_ui->so_factures_details->search(array('facture_id' => $invoice['facture_id']), false);
			foreach($details as $detail){
				$total = $total + $detail['extra_ht'] ? $detail['extra_ht'] : $detail['total_ht'];
				$total_ttc += $detail['extra_ht'] + $detail['extra_ht']*$detail['vat_rate']/100;
			}
				if($total<>0){
					$tvat = ($total_ttc / $total) ;
					}
					
			
			$this->Cell(60,6,utf8_decode($invoice['facture_number']),'B',0,'L',0);
			$this->Cell(20,6,utf8_decode(date('d/m/Y', $invoice['send_date'])),'B',0,'R',0);
			$this->Cell(30,6,utf8_decode(number_format($invoice['total_ht'],2,'.',' ')).chr(128),'B',0,'R',0);
			$this->Cell(30,6,utf8_decode(number_format($total_ttc,2,'.',' ')).chr(128),'B',0,'R',0);

			if($invoice['payment_date']){
				$this->Cell(20,6,utf8_decode(date('d/m/Y', $invoice['payment_date'])),'LB',0,'R',0);
				$this->Cell(30,6,utf8_decode(number_format($invoice['payment_amount'],2,'.',' ')).chr(128),'B',1,'R',0);
			}else{
				$this->Cell(20,6,'-','LB',0,'R',0);
				$this->Cell(30,6,'-','B',1,'R',0);
			}

			$total_fact['ht'] += $invoice['total_ht'];
			$total_fact['ttc'] += $total_ttc;
			$total_fact['payment'] += $invoice['payment_amount'];
			if($tvat<>0){
				$total_fact['payment_ht'] +=  $invoice['payment_amount'] / $tvat;
				}
		}
		
		$this->Ln(5);

		$this->SetFont('Arial','B', 10);
		$this->Cell(80,6,utf8_decode(lang('TOTAL')),'TB',0,'L',0);
		$this->Cell(30,6,utf8_decode(number_format($total_fact['ht'],2,'.',' ')).chr(128),'TB',0,'R',0);
		$this->Cell(30,6,utf8_decode(number_format($total_fact['ttc'],2,'.',' ')).chr(128),'TB',0,'R',0);
		$this->Cell(50,6,utf8_decode(number_format($total_fact['payment'],2,'.',' ')).chr(128),'LTB',1,'R',0);	

		$this->Ln(5);

		// BILAN
		$this->SetFont('Arial','B', 12);
		$this->Cell(150,8,utf8_decode(lang('Summary')),0,1,'L',0);

		$this->SetFont('Arial','', 10);
		$this->Cell(80,8,utf8_decode('Total '.lang('Sell').' '.'HT'),0,0,'R',0);
		$this->Cell(40,8,utf8_decode(number_format($total_vente,2,'.',' ')).chr(128),0,1,'R',0);
		$this->Cell(80,8,utf8_decode('Total '.lang('Payed').' '.'HT*'),0,0,'R',0);
		$this->Cell(40,8,utf8_decode(number_format($total_fact['payment_ht'],2,'.',' ')).chr(128),0,1,'R',0);
		$this->Cell(80,8,utf8_decode(lang('Remaining').' '.'HT'),0,0,'R',0);
		$this->Cell(40,8,utf8_decode(number_format($total_vente-$total_fact['payment_ht'],2,'.',' ')).chr(128),0,1,'R',0);
		
		$this->Cell(80,8,utf8_decode(''),0,1,'R',0);
		$this->Cell(80,8,utf8_decode('* calculé à partir du montant TTC'),0,0,'R',0);
		
		
	}

}

?>