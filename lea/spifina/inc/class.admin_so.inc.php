<?php
/**	spifina : SpireaDemandes
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
// require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.spifina_bo.inc.php');	


// class admin_so extends so_sql{
class admin_so extends spifina_bo{

	var $spifina_client='spiclient';
	var $spifina_factures='spifina_factures';
	var $spifina_factures_details='spifina_factures_details';
	var $spifina_clients_relations='spiclient_relations';
	var $spiclient_delai_paiement = 'spiclient_delai_paiement';

	var $spireapi_account = 'spireapi_acc_accounts';
	var $spireapi_book = 'spireapi_acc_book';

	
	var $so_client;
	var $so_factures;
	var $so_factures_details;
	var $so_clients_relations;
	var $so_account;
	var $so_book;

	var $account_id;
	var $app_title;
	
	
	function admin_so(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les variables globales
		*/
		
		parent::__construct('spifina',$this->spifina_tickets,null,'',true);
		
		//Instance sur la table client
		$this->so_client = new so_sql('spiclient',$this->spifina_client);
		$this->so_clients_relations = new so_sql('spiclient',$this->spifina_clients_relations);
		$this->so_delai_paiement = new so_sql('spiclient',$this->spiclient_delai_paiement);

		$this->so_factures = new so_sql('spifina',$this->spifina_factures);
		$this->so_factures_details = new so_sql('spifina',$this->spifina_factures_details);

		$this->so_account = new so_sql('spireapi',$this->spireapi_account);
		$this->so_book = new so_sql('spireapi',$this->spireapi_book);
	}

	function is_admin($account_id=null){
	/**
	 * Vérifie si l'utilisateur est un administrateur (si il peut modifier les comptes)
	 *
	 * Nous véfions si les ACL pour les utilisateurs ayant les doits de modification, de la même manière que les administrateurs font pour gérer les comptes
	 *
	 * @param array $account_id=null pour un usage prochain, quand les administrateurs ne seront plus administrateurs sur tous les comptes
	 * @return boolean
	 */
		return isset($GLOBALS['egw_info']['user']['apps']['admin']);
	}
	
	function construct_search($search, $so_=null){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		if($so_ == null) $so_ = $this;
		$tab_search=array();
		foreach($so_->db_data_cols as $id=>$value){
			$tab_search[$id]=$search;
		}
		return $tab_search;
	}

	function get_models(){
		$retour = array(
			'spifina.generate_pdf' => lang('Normal'),
			'spifina.generate_pdf_logo' => lang('Blue'),
			'spifina.generate_pdf_grey' => lang('Grey'),
			'spifina.generate_pdf_green' => lang('Green'),
			'spifina.generate_pdf_white' => lang('White'),
		);
		asort($retour);
		return $retour;
	}

	function get_account(){
    /**
     * Retourne la liste des comptes
     *
     * @return array
     */
    	$accounts = $this->so_account->search(array('account_active' => true),false);
    	foreach($accounts as $account){
    		$return[$account['account_id']] = $account['account_code'].' - '.$account['account_label'];
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
    		$return[$book['book_id']] = $book['book_code'].' - '.$book['book_label'];
    	}

    	return $return;
    }

    function get_accounting_export(){
    /**
     * Retourne la liste des formats d'export vers la compta
     *
     * @return array
     */
    	return array(
    		'pnm' => lang('Sage PNM File'),
    		'ebp' => lang('EBP (accounts & scripture)')
    	);
    }

    function get_payment_delay($id=''){
	/**
	 * Retourne la liste des delais de paiement
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_delai_paiement->search(array('delai_id'=>$id),false,'delai_label');
		foreach((array)$info as $key => $data){
			$retour[$data['delai_id']] = $data['delai_label'];
		}
		return $retour;
	}
}


?>