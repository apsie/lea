<?php
require_once(realpath(dirname(__FILE__)) . '/Employee.php');
require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
require_once(realpath(dirname(__FILE__)) . '/Tache.php');

/**
 * @access public
 */
class Projet {
	/**
	 * @AssociationType Employee
	 * @AssociationMultiplicity 0..*
	 */
	public $a_Employee = array();
	/**
	 * @AssociationType Prestation
	 * @AssociationMultiplicity 1..*
	 */
	public $a_Prestation = array();
	/**
	 * @AssociationType Tache
	 */
	public $a_Tache;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function ajouter_projet() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function modifier_projet() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function supprimer_projet() {
		// Not yet implemented
	}
	public function get_projet($id_ben)
	{
		$requete = 'select * from egw_projet where id_ben='.$id_ben.' order by id_projet desc  limit 1';
		return $GLOBALS['db']->fetchRow($requete);
	}
}
?>