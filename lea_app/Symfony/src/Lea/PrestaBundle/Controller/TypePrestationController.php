<?php

namespace Lea\PrestaBundle\Controller;



use Lea\PrestaBundle\Entity\EgwTypePrestation;

use Lea\PrestaBundle\Form\Type\EgwTypePrestationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class TypePrestationController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function createAction()
	{
		$formTypePrestation = $this->createForm(new EgwTypePrestationType());
		
		$request = $this->getRequest();
		$EgwTypePrestation = $request->request->get('EgwTypePrestation');
		if ($EgwTypePrestation['libelle']!=null) 
		{
			$t = new EgwTypePrestation();
			$t->setLibelle($EgwTypePrestation['libelle']);
			$em = $this->getDoctrine()->getManager();
			$em->persist($t);
	  		$em->flush();
			
	  		echo json_encode("Le type de prestation ".$EgwTypePrestation['libelle']." est crée");
	  		die();
		}
		else
		return array('formTypePrestation'=>$formTypePrestation->createView());
	}
/**
	 *
	 * @Template()
	 */
	public function showAction()
	{
		$typeprestations = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTypePrestation')->findAll();
		return array("typeprestations"=>$typeprestations);
	}
/**
	 *
	 * @Template()
	 */
	public function editAction($id)
	{
		$typePrestation = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTypePrestation')->find($id);
		$request = $this->getRequest();
		$EgwTypePrestation = $request->request->get('EgwTypePrestation');
		if ($request->getMethod() == 'POST') 
		{
		$typePrestation->setLibelle($EgwTypePrestation['libelle']);
		$em = $this->getDoctrine()->getManager();
		$em->persist($typePrestation);
	  	$em->flush();
	  	echo json_encode('La type de prestation a été modifiée');
		die();
		}
		else {
		
		$formTypePrestation = $this->createForm(new EgwTypePrestationType(),$typePrestation);
		
		return array("typePrestation"=>$typePrestation,'formTypePrestation'=>$formTypePrestation->createView());
		}
	}
	 
}
