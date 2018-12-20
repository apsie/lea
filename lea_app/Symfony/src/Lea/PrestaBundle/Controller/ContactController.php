<?php
namespace Lea\PrestaBundle\Controller;


use Lea\PrestaBundle\Form\Type\EgwEpceTexteType;

use Lea\PrestaBundle\Form\Type\EgwContactParcoursProType;

use Lea\PrestaBundle\Form\Type\EgwContactFormationType;

use Lea\PrestaBundle\Form\Type\EgwContactEtatCivilType;

use Lea\PrestaBundle\Form\Type\EgwContactType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ContactController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function createAction($idContact)
	{ //die('test'.$idContact);
		$contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->find($idContact);
		
		
		$formContact = $this->createForm(new EgwContactType(),$contact);
		
		return array(	'formContact'=> $formContact->createView(),
						'idContact' => $idContact,
						'DIR_PRESTA' => DIR_PRESTA,);
	}

//	/**
//	 *
//	 * @Template()
//	 */
//	public function showAction()
//	{
//		$request = $this->getRequest();
//		$EgwContact = $request->request->get('EgwContact');
//		$EgwAccounts = $request->request->get('EgwAccounts');
//		
//		
//		$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->get($EgwContact['idBen'],$EgwContact['nom'],$EgwContact['prenom'],$EgwContact['adresseLigne1'],$EgwContact['cp'],$EgwContact['ville'],$EgwContact['portablePerso'],$EgwContact['emailPerso']);
//		
//		return array('listContact'	=>	$c,  'nbContact' => count($c));
//	}



	/**
	 *
	 * @Template()
	 */
	public function complementAction($idContact)
	{ //die('test'.$idContact);
		$contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->find($idContact);
		
		
		$formContact = $this->createForm(new EgwContactType(),$contact);
		
		return array(	'formContact'=> $formContact->createView(),
						'idContact' => $idContact,
						'DIR_PRESTA' => DIR_PRESTA,);
	}





	/**
	 *
	 * @Template()
	 */
	public function etatcivilAction($idContact = null)
	{ 
		$contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->find($idContact);
		
		
		$formContact = $this->createForm(new EgwContactType(),$contact);

		
		return array(	'formContactEtatCivil' 	=> $formContact->createView()
						);
	}




	/**
	 *
	 * @Template()
	 */
	public function parcoursproAction($idContact = null)
	{ 
		$contact = array();
		
		if($idContact!=null)
		$contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContactParcoursPro')->findBy(array('idBen'=>$idContact));
	
		if(count($contact)>0)
		$c = $contact[0];
		else 
		$c = null;
		
		$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwEpceTexte')->get('Statut 1');
		

		$formContactParcoursPro = $this->createForm(new EgwContactParcoursProType(),array($texte,$c));
		
		return array(	'formContactParcoursPro'	=> $formContactParcoursPro->createView()
						);
	}

	/**
	 *
	 * @Template()
	 */
	public function formationAction($idContact = null)
	{ 
		$contact = array();
		
		if($idContact!=null)
		$contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContactFormation')->findBy(array('idBen'=>$idContact));
	
		if(count($contact)>0)
		$c = $contact[0];
		else 
		$c = null;
		
		$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwEpceTexte')->get('Niveau de formation');
		

		$formFormation = $this->createForm(new EgwContactFormationType(),array($texte,$c));
		
		return array(	'formFormation'	=> $formFormation->createView()
						);
	}
	 
}
