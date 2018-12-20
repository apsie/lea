<?php
require_once(realpath(dirname(__FILE__)) . '/Prestataire.php');

/**
 * @access public
 */
class Organisation {
	/**
	 * @AttributeType string
	 */
	private $code_postal;
	/**
	 * @AttributeType string
	 */
	private $ville;
	/**
	 * @AttributeType string
	 */
	private $adresse;
	/**
	 * @AttributeType string
	 */
	private $code_org;
	/**
	 * @AttributeType string
	 */
	private $tel;
	/**
	 * @AttributeType string
	 */
	private $email;
	private $site_web;
	/**
	 * @AttributeType int
	 */
	private $id_organisation;
	/**
	 * @AssociationType Prestataire
	 * @AssociationMultiplicity 1
	 */
	public $a_Prestataire;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public

		 */
	public function inserer_organisation($id_owner, $categorie_org, $code_org, $nom_organisme, $adresse_ligne_1, $adresse_ligne_2, $adresse_ligne_3, $cp, $ville, $region, $pays, $tel, $fax, $email, $site_web,	$secteur)
	{
		// Not yet implemented
		
		
		//vérification
			$requete='SELECT * from egw_organisation where code_org="'.$code_org.'" or nom_organisme="'.$nom_organisme.'" ';
			$result=$GLOBALS['db']->fetchRow($requete);
			
			if($result['id_organisation']==0 or $result['id_organisation']==NULL)
			{
				
	$data = array('id_owner' => $id_owner, 'date_creation' => time(), 'id_modifier' => $id_owner, 'date_last_modified' => time(),'categorie_org' => $categorie_org , 'code_org'=> $code_org, 'nom_organisme' => $nom_organisme, 'adresse_ligne_1' => $adresse_ligne_1, 'adresse_ligne_2'=> $adresse_ligne_2, 'adresse_ligne_3'=> $adresse_ligne_3, 'cp'=> $cp, 'ville'=> $ville, 'region'=> $region, 'pays'=> $pays, 'tel'=> $tel, 'fax'=> $fax, 'email'=> $email, 'site_web'=> $site_web,'secteur_activite'=> $secteur);
				
	$GLOBALS['db']->insert('egw_organisation',$data);
	
	$requete='SELECT id_organisation from egw_organisation  order by id_organisation desc limit 1';
		$result=$GLOBALS['db']->fetchRow($requete);
		return array(1,$result['id_organisation']);
			}
			else
			{
	//retour
			
			 
			 return array(0,$result['id_organisation']);
			}
	/**
	 * @access public
	 */}
	public function modifier_organisation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function supprimer_organisation() {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param $id_contact
	 * @ParamType $id_contact 
	 */
	public function lier($id_modifier,$id_contact,$id_organisation) {
		// Not yet implemented
		$data = array('date_last_modified' =>time(),'id_modifier'=>$id_modifier,'id_organisation'=>$id_organisation);
		$GLOBALS['db']->update('egw_contact',$data,'id_ben='.$id_contact);
	}

	/**
	 * @access public
	 * @param $id_contact
	 * @ParamType $id_contact 
	 */
	public function delier($id_contact) {
		// Not yet implemented
	}
}
?>