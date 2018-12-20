<?php


/**
 * @access public
 */
class Prestation {

public $id_liste_prestation;

	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function inserer_prestation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function modifier_prestation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function supprimer_prestation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function lister_prestation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function selectionner_liste_prestation() {
		// Not yet implemented
	
		//	$requete='select * from egw_liste_prestation order by intitule_prestation asc';
	 $requete='select * from egw_dispositif where is_active=1 order by nom_dispositif asc';
		return  $GLOBALS['db']->fetchAll($requete);
	
		
	}
	public function get_liste_prestation($id_liste_prestation) {
		// Not yet implemented
		
if($id_liste_prestation!=0)
		{
			$requete = 'Select *  from egw_liste_prestation where id_liste_prestation= '.$id_liste_prestation.'';
			
			}
			elseif($this->id_liste_prestation!=0)
			{
		$requete='select * from egw_liste_prestation where id_liste_prestation='.$this->id_liste_prestation.'';
		}
		else
		{return NULL;}
		$result=$GLOBALS['db']->fetchRow($requete);
	
		return $result['intitule_prestation'];
	}
	function get_prestation($id_presta)
	{
	$requete='select * from egw_prestation where id_presta='.$id_presta.'';
	return $GLOBALS['db']->fetchRow($requete);
	}
	
}
?>