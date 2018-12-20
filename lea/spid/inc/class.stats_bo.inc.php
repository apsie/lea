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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.stats_so.inc.php');	
	
class stats_bo extends stats_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	var $export_fields=array();
	
	
	
	function __construct() {
	/**
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts =& CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		$config =& CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		$this->export_fields=$this->export();
		
		
		parent::__construct();
	}
		
	function stats_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function get_societe(){
	/**
	* Retourne la liste des entreprises ; un tableau avec l'identifiant du client en index et le nom de l'entreprise en valeur
	*
	* @return array
	*/
		$info=$this->search('','client_id,client_company');
		if(!is_array($info)){
			$info=array();
		}
		$societe=array();
		foreach($info as $id=>$value){
			$societe[$value['client_id']]=$value['client_company'];
		}
		return $societe;
	}
	
	function get_status($id){
	/**
	 * retourne le libelle de la categorie ayant l'identifiant $id
	 *
	 * @param $id int : identifiant de categorie
	 * @return string
	 */
		$so_categories = new so_sql('phpgwapi','egw_categories');
		$category = $so_categories->search(array('cat_id'=>$id),false);
		return $category[0]['cat_name'];
	}
	
	function verif_ligne($row,$column=array()){
	/**
	 * Vérifie que la ligne $row contient des informations
	 *
	 * @param $row : ligne a vérifier
	 * @param $empty : valeur pour les données vides
	 * @param $column : colonne a ignorer
	 *
	 * @return boolean : true si la ligne contient des données
	 */
		$empty = array('-',0,number_format(0,2));
		$flag = false;
		foreach($row as $name => $value){
			
			if(!in_array($name,$column)){
				if(!in_array($value,$empty)){
					$flag = true;
				}
			}
		}
		return $flag;
	}

	function get_account(){
    /**
     * Retourne la liste des comptes
     *
     * @return array
     */
    	$accounts = $this->so_account->search(array('account_active' => true),false);
    	foreach($accounts as $account){
    		$return[$account['account_id']] = $account['account_code'];
    	}

    	return $return;
    }
	
	function get_book(){
    /**
     * Retourne la liste des journaux de compte
     *
     * @return array
     */
    	$books = $this->so_book->search(array('book_active' => true),false);
    	foreach($books as $book){
    		$return[$book['book_id']] = $book['book_code'];
    	}

    	return $return;
    }
	
	function export($fonction='index'){
	/**
	* Calucule les statistiques suivantes dans un tableau :
	*
	* \li client_company -> entreprise cliente
	*
	* \li nb_open -> nombre de tickets ouverts
	*
	* \li nb_closed -> nombre de tickets fermés
	*
	* \li nb_period -> nombre de tickets à la période de fin
	*
	* \li time_open -> temps passé sur chaque ticket
	*
	* \li percent_open -> pourcentage de tickets ouverts
	*
	* \li time_closed -> temps passé sur des tickets fermés
	*
	* \li percent_closed -> pourcentage de tickets fermés
	*
	* NOTE: je suis pas sur que ca marche ...
	*
	* @param $fonction : la fonction depuis laquel on appel afin de fixé les champs a utilisé
	* @return array
	*/
		$month = array(
			'january'		=> lang('january'),
			'february'		=> lang('february'),
			'march'			=> lang('march'),
			'april'			=> lang('april'),
			'may'			=> lang('may'),
			'june'			=> lang('june'),
			'july'			=> lang('july'),
			'august'		=> lang('august'),
			'september'		=> lang('september'),
			'october'		=> lang('october'),
			'november'		=> lang('november'),
			'december'		=> lang('december'),
			'total'			=> lang('Total'),
			'percent'		=> lang('Percent'),
		);
		
		switch($fonction){ 
			case 'index':
				$export=array(
					'client_company'	=> lang('Company'),
					'nb_before'			=> lang('Opened tickets in start period'),
					'nb_open'			=> lang('Opened tickets'),
					'nb_closed'			=> lang('Closed ticket'),
					'nb_period'			=> lang('Opened tickets at end period'),
					'time_open'			=> lang('Pass time on the opened tickets'),
					// 'percent_open'	=> lang('Percent on the opened tickets'),
					'time_closed'		=> lang('Pass time on the closed tickets'),
					// 'percent_closed'	=> lang('Percent on the closed tickets'),
					'time_not_factured'	=> lang('Pass time on not factured closed tickets'),
					'total_time'		=> lang('Total spend time'),
					'percent_total_time'=> lang('% spend time'),
					'total'				=> lang('Factured turnover'),
					'percent_turnover'	=> lang('% turnover'),
					'average_turnover'	=> lang('Average hourly turnover'),
					'outstanding'		=> lang('estimated outstanding'),
				);
				break;
			case 'intervenant':
				$export=array(
					'intervenant'		=> lang('Intervenant'),
					'nb_open'			=> lang('Opened tickets'),
					'nb_closed'			=> lang('Closed ticket'),
					'time_open'			=> lang('Pass time on the opened tickets'),
					'time_closed'		=> lang('Pass time on the closed tickets'),
					'time_total'		=> lang('Total'),
					'facturation'		=> lang('Factured turnover'),
					'ratio'				=> lang('Ratio'),
					'target'			=> lang('Target'),
				);
				break;
			case 'ca_intervenant':
				$export=array(
					'intervenant'	=> lang('Intervenant'),
				);
				$export=array_merge($export,$month);
				break;
			case 'ca_client':
				$export=array(
					'client_company'=> lang('Company'),
				);
				$export=array_merge($export,$month);
				break;
			case 'suivi':
				$export = array(
					'ticket' => lang('Ticket'),
					// 'ticket_id' => lang('Ticket ID'),
					'intervenant_name' => lang('Intervenant'),
					'client_name' => lang('Client'),
					'client_group_name' => lang('Client group'),
					'contract_name' => lang('Contract name'),
					'year' => lang('Year'),
					'n_days' => lang('n_days'),
					'week' => lang('Week'),
					'quarter' => lang('Quarter'),
					'month' => lang('Month'),
					'realised' => lang('Realised'),
					'cost' => lang('Cost'),
					'pnb' => lang('PNB'),
					'status_name' => lang('Status'),
					'invoice' => lang('Invoice'),
					'payment_date_export' => lang('Payment date'),
					'state' => lang('State'),				
				);
				break;
			case 'contrat':
				$export = array(
					'contract_id' => lang('Contract ID'),
					'contract_client' => lang('Contract Client'),
					'client' => lang('Client'),
					'time_closed' => lang('Time invoiced'),
					'time_not_factured' => lang('Billable time'),
					'total_time' => lang('Total spend time'),
					'turnover' => lang('Factured turnover'),
					'opened_outstanding' => lang('Opened ticket outstanding'),
					'outstanding_to_bill' => lang('oustanding to bill'),
					'total_outstanding' => lang('Total time oustanding'),
					'outstanding_amount' => lang('oustanding amount'),
					'budget_amount'	=> lang('Budget amount'),
					'budget_time' => lang('Budget time'),
					'difference_amount' => lang('Difference amount'),
					'difference_time' => lang('Difference time'),
				);
				break;
		}
		return $export;
	}
		
}	
?>
