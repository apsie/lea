<?php
/*require_once(realpath(dirname(__FILE__)) . '/Projet.php');*/
require_once(realpath(dirname(__FILE__)) . '/Employee.php');
include('config/config.php');

/**
 * @access public
 */
class Tache {
	/**
	 * @AttributeType int
	 */
	public $cout_horaire;
	/**
	 * @AttributeType int
	 */
	private $date_debut;
	/**
	 * @AttributeType int
	 */
	public $date_fin;
	/**
	 * @AttributeType int
	 */
	public $duree_trajet;
	/**
	 * @AttributeType int
	 */
	public $distance_trajet;
	/**
	 * @AttributeType string
	 */
	public $categorie_tache;
	/**
	 * @AttributeType string
	 */
	public $type_tache;
	/**
	 * @AttributeType string
	 */
	public $description_tache;
	/**
	 * @AttributeType string
	 */
	public $observations;
	/**
	 * @AttributeType boolean
	 */
	public $facturable;
	/**
	 * @AssociationType Projet
	 */
	public $a_Projet;
	/**
	 * @AssociationType Employee
	 */
	public $a_Employee;
	
	

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
		
		
		
    	 
	}
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	/**
	 * @access public
	 */
	 
	public function voir_form_tache()
	{
	$valeur=Employee::get_employee();
	//$valeur_contact=Contact::get_contact();
	echo '<form><table><tr><td height="53">Dans le cadre du projet</td><th colspan="4" align="left"><input size="70" type="text"/></th></tr><tr><td>Date de début</td><td><input type="text" value="'.date('dmy',time()).'" size="7" /> <select><option>9</option></select> h</td><td>Date de fin</td><td><input size="7" value="'.date('dmy',time()).'" type="text" /> <select><option>10</option></select> h</td></tr><tr><td>Durée trajet</td>
 
  <td><input size="7" type="text" /> min</td><td>Distance trajet</td>
 
  <td><input size="7" type="text" /> km</td></tr><tr><td>Employée</td>
 
  <td><strong>'.$valeur[0].' '.$valeur[1].'</strong></td><td>Bénéficiaire</td>
 
  <td><strong></strong></td></tr><tr><td>Catégorie</td>
 
  <td><select><option>Face à face</option><option>Hors face à face</option></select></td><td>Type</td>
 
  <td><select><option>Entretien</option></select></td></tr><tr><tr><td>Description</td><th colspan="4" align="left"><textarea style="border:1px solid #CCC;font-size:11px;" cols="60"></textarea></th></tr><tr><td>Observation</td><th colspan="4" align="left"><textarea style="border:1px solid #CCC; font-size:11px;" cols="60"></textarea></th></tr><tr>
  <td height="24">Facturable</td>
 
  <td><select><option>Oui</option><option>Non</option></select></td><td>&nbsp;</td>
 
  <td>&nbsp;</td></tr><tr><td height="57"></td><td><input type="submit" value="Enregistrer la tâche" /></td><td></td><td></td></tr></table></form>';
	}
	public function inserer_tache() {
		
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $tache
	 * @ParamType $tache int
	 */
	public function modifier_tache($tache) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $tache
	 * @ParamType $tache int
	 */
	public function supprimer_tache($tache) {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function lister_tache() {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $projet
	 * @return int
	 * @ParamType $projet int
	 * @ReturnType int
	 */
	public function calcul_heure_projet($projet) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $employee
	 * @param int $dat_deb
	 * @param int $dat_fin
	 * @return int
	 * @ParamType $employee int
	 * @ParamType $dat_deb int
	 * @ParamType $dat_fin int
	 * @ReturnType int
	 */
	public function calcul_heure_employee($employee, $dat_deb, $dat_fin) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $projet
	 * @return int
	 * @ParamType $projet int
	 * @ReturnType int
	 */
	public function calcul_cout_projet($projet) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param int $employee
	 * @param int $dat_deb
	 * @param int $dat_fin
	 * @return int
	 * @ParamType $employee int
	 * @ParamType $dat_deb int
	 * @ParamType $dat_fin int
	 * @ReturnType int
	 */
	public function calcul_cout_employe($employee, $dat_deb, $dat_fin) {
		// Not yet implemented
	}
}
?>