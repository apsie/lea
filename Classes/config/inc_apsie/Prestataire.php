<?php

require_once(realpath(dirname(__FILE__)) . '/Employee.php');

/**
 * @access public
 */
class Prestataire {
	/**
	 * @AttributeType string
	 */
	private $nom_prestataire;
	/**
	 * @AttributeType string
	 */
	private $siret_prestataire;
	/**
	 * @AssociationType Prestation
	 * @AssociationMultiplicity 1
	 */

	public $a_Employee;

	/**
	 * @access public
	 */
	public function ajouter_prestataire() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function modifier_prestataire() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function supprimer_prestataire() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function lier_employee() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function delier_employee() {
		// Not yet implemented
	}
}
?>