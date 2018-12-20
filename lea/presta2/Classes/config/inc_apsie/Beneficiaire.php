<?php
require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
require_once(realpath(dirname(__FILE__)) . '/Contact.php');

/**
 * @access public
 */
class Beneficiaire extends Contact {
	/**
	 * @AttributeType string
	 */
	private $statut_pro;
	/**
	 * @AttributeType string
	 */
	private $identifiant;
	/**
	 * @AssociationType Prestation
	 * @AssociationMultiplicity 1
	 */
	public $a_Prestation;
}
?>