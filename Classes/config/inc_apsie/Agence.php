<?php
//require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
require_once(realpath(dirname(__FILE__)) . '/Organisation.php');

/**
 * @access public
 */
class Agence extends Organisation {
	/**
	 * @AttributeType int
	 */
	private $nb_bureau;
	/**
	 * @AttributeType int
	 */
	private $id_prestataire;
	/**
	 * @AssociationType Prestation
	 */
	public $a_Prestation;
	/**
	 * @AssociationType Prestation
	 * @AssociationMultiplicity 1
	 */
	public $a_Prestation2;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function selectionner_agence() {
		// Not yet implemented
	$sql="SELECT * FROM egw_agences";
		return $GLOBALS['db']->fetchAll($sql);
		
	}
	
}
?>