<?php
require_once(realpath(dirname(__FILE__)) . '/Prestataire.php');
require_once(realpath(dirname(__FILE__)) . '/Tache.php');
include('/data/html/egw_apsie_143/Classes/config/config.php');
//include('config/config.php');

/**
 * @access public
 */
class Employee {
	/**
	 * @AssociationType Prestataire
	 */
	public $a_Prestataire;
	/**
	 * @AssociationType Tache
	 */
	public $a_Tache;
	/**
	 * @AssociationType Prestation
	 * @AssociationMultiplicity 1
	 */
	public $a_Prestation;
	/**
	 * @AssociationType 
	 */

	public $id_employee;
	
	public $a_Projet = array();

	/**
	 * @access public
	 */
	
	public function __construct() {
		// Not yet implemented
			

	}

	/**
	 * @access public
	 * @param prestataire
	 * @ParamType prestataire 
	 */
	public function selectionner_employee() {
		
		$requete = 'Select egw_accounts.account_id,egw_accounts.account_firstname,egw_accounts.account_lastname,egw_prestataire.nom  from egw_accounts,egw_prestataire where egw_accounts.account_id_prestataire = egw_prestataire.id_prestataire order by egw_prestataire.nom asc , account_firstname asc';
		return $GLOBALS['db']->fetchAll($requete);
		
		
	}
	
	function get_employee($id_employee=NULL)
	{
		if($id_employee!=NULL or $id_employee!=0)
		{
			$requete = 'Select *  from egw_addressbook where account_id= '.$id_employee.'';
			
			}
		elseif($this->id_employee!=NULL or $this->id_employee!=0)
		{
		$requete = 'Select *  from egw_addressbook where account_id= '.$this->id_employee.'';
		}
		else
		{return NULL;}
		
		$result=$GLOBALS['db']->fetchRow($requete);
		return array($result['n_given'],$result['n_family']);
	}
}
?>
