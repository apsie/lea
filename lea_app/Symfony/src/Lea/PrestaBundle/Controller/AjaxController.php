<?php

namespace Lea\PrestaBundle\Controller;



use Lea\PrestaBundle\Form\Type\EgwTypePrestationType;

use Lea\PrestaBundle\Form\Type\EgwContactType;

use Lea\PrestaBundle\Form\Type\EgwProjetType;

use Lea\PrestaBundle\Form\Type\EgwPrestaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class AjaxController extends Controller
{
	/**
	 *
	 * 
	 */
	public function getContactAction()
	{
		
		
		$request = $this->getRequest();
		$string = $request->request->get('string');
		$catId = $request->request->get('catId');
		$nomOrganismePr = $request->request->get('nomOrganismePr');
		
		if($nomOrganismePr!=null && $catId==256)
		$catOrg = 235;
		
		
		if(isset($catOrg))
		{
		$idOrganisme = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->getOrganisation($catOrg,$nomOrganismePr,$string);
		$idOrg = $idOrganisme[0]->getIdOrganisation();
		}
		else
		$idOrg = null;
	
		$contacts = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->getContacts($catId,$idOrg,$string);
     	 $newContacts = array(); 
		foreach ($contacts as $key => $value) {
			//$value->getContactParcoursPro()
		 
		 
		 if(count($value->getContactParcoursPro())>0)
		 {
		 	$c = $value->getContactParcoursPro();
		 $identifiant = $c[0]->getIdentifiant();
		 $statut =$c[0]->getStatut();
		 }
		 else
		 {
		 	$identifiant = null;
		 	$statut = null;
		 }
		 $newContacts[] = array(		'idBen'		=>	$value->getIdBen(),
							'nom'		=>	$value->getNom(),
							'prenom'	=>	$value->getPrenom(),
							'civilite'	=>	$value->getCivilite(),
							'nomJeuneFille'	=>	$value->getNomJeuneFille(),
							'deuxiemePrenom'=>	$value->getDeuxiemePrenom(),
							'portablePro'	=>	$value->getPortablePro(),
							'portablePerso'	=>	$value->getPortablePerso(),
							'emailPro'	=>	$value->getEmailPro(),
							'emailPerso'	=>	$value->getEmailPerso(),
							'telDomicile1'	=>	$value->getTelDomicile1(),
		  					'fonction'	=>	$value->getFonction(),
		 					'identifiant'	=>	$identifiant,
		 					'statut'	=>	$statut	);
		 
		}
		
	
		echo json_encode($newContacts);
		die();
	}

	// SPIREA
	public function getAddressbookAction()
	{
		
		
		$request = $this->getRequest();
		
		$string = $request->request->get('string');
		$string = str_replace("'", "+", $string);

		$catId = $request->request->get('catId');
		$nomOrganismePr = $request->request->get('nomOrganismePr');
		
		if($nomOrganismePr!=null && $catId==256)
		$catOrg = 235;
		
		
		if(isset($catOrg))
		{
		$idOrganisme = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->getOrganisation($catOrg,$nomOrganismePr,$string);
		$idOrg = $idOrganisme[0]->getIdOrganisation();
		}
		else
		$idOrg = null;
	
		$contacts = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAddressbook')->getContacts($catId,$idOrg,$string);
     	 $newContacts = array(); 
		foreach ($contacts as $key => $value) {
			//$value->getContactParcoursPro()
		 
		 
		 // if(count($value->getContactParcoursPro())>0)
		 // {
		 // 	// $c = $value->getContactParcoursPro();
		 // $identifiant = $c[0]->getIdentifiant();
		 // $statut =$c[0]->getStatut();
		 // }
		 // else
		 // {
		 	$identifiant = null;
		 	$statut = null;
		 // }
		 $newContacts[] = array(	/*'idBen'		=>	$value->getIdBen(),*/
						'contactId'		=>  	$value->getContactId(),
						'nom'			=>	$value->getNFamily(),
						'prenom'		=>	$value->getNGiven(),
						'civilite'		=>	$value->getNPrefix(),
						// 'nomJeuneFille'	=>	$value->getNomJeuneFille(),
						'deuxiemePrenom'	=>	$value->getNMiddle(),
						'portablePro'		=>	$value->getTelCell(),
						'portablePerso'		=>	$value->getTelCellPrivate(),
						'emailPro'		=>	$value->getContactEmail(),
						'emailPerso'		=>	$value->getContactEmailHome(),
						'telDomicile1'		=>	$value->getTelHome(),
						'fonction'		=>	$value->getContactRole(),
						'identifiant'		=>	$identifiant,
						'statut'		=>	$statut	);
		}
		
	
		echo json_encode($newContacts);
		die();
	}

	public function getOrganisationAction()
	{
		$request = $this->getRequest();
		$string = $request->request->get('string');
		$catOrg = $request->request->get('catOrg');
		$org = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->getOrganisation($catOrg,$string);
     	// \Doctrine\Common\Util\Debug::dump($org,2);die();
     	 $newOrg = array();
     	 foreach ($org as $key => $value) {
     	 	$newOrg[] = array( 					'idOrganisation'	=>	$value->getIdOrganisation(),
     	 										'nomOrganisme'	  =>	$value->getNomOrganisme());
     	 }
		echo json_encode($newOrg);
		die();
	}
	public function getCodeRomeAction()
	{
		$request = $this->getRequest();
		$string = $request->request->get('string');
		
		$org = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCodeRome')->get($string);
     	// \Doctrine\Common\Util\Debug::dump($org,2);die();
     	 $newOrg = array();
     	 foreach ($org as $key => $value) {
     	 	$newOrg[] = array( 					'codeRome'	=>	$value->getCodeRome(),
     	 										'intitule'	  =>	$value->getIntitule(),
     	 										'appellation'	  =>	$value->getAppellation());
     	 }
		echo json_encode($newOrg);
		die();
	}
	
public function getCpAction()
	{
		$request = $this->getRequest();
	
		$string = $request->request->get('string');
		
		$sql='SELECT * FROM egw_code_postaux a where cp like "'.$string.'%" or ville1 like "'.$string.'%" order by ville1 asc limit 50';
		//die($sql);
		$stmt = $this->getDoctrine()->getEntityManager()
                   ->getConnection()
                   ->prepare($sql);
      
      	$stmt->execute();
     	$data = $stmt->fetchAll();
		
  		echo json_encode($data);
  		die();
	}
}
