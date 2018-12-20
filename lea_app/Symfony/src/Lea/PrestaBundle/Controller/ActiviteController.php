<?php

namespace Lea\PrestaBundle\Controller;




use Lea\PrestaBundle\Entity\EgwActivite;

use Lea\PrestaBundle\Form\Type\EgwActiviteType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class ActiviteController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function createAction()
	{
		$formActivite = $this->createForm(new EgwActiviteType());
		
		$request = $this->getRequest();
		$EgwActivite = $request->request->get('EgwActivite');
		if ($EgwActivite['libelle']!=null) 
		{
			$a = new EgwActivite();
			$a->setLibelle($EgwActivite['libelle']);
			$em = $this->getDoctrine()->getManager();
			$em->persist($a);
	  		$em->flush();
			
	  		echo json_encode("L'activité ".$EgwActivite['libelle']." est crée");
	  		die();
		}
		else
		return array('formActivite'=>$formActivite->createView());
	}
/**
	 *
	 * @Template()
	 */
	public function showAction()
	{
		$activites = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwActivite')->findAll();
		return array("activites"=>$activites);
	}
	
/**
	 *
	 * @Template()
	 */
	public function editAction($id)
	{
		$activite = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwActivite')->find($id);
		$request = $this->getRequest();
		$EgwActivite = $request->request->get('EgwActivite');
		if ($request->getMethod() == 'POST') 
		{
		
		$activite->setLibelle($EgwActivite['libelle']);	
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($activite);
	    $em->flush();
	    echo json_encode("L'activité a été modifiée");
		die();
		}
		else {
		
		$form= $this->createForm(new EgwActiviteType(),$activite);
		
		return array("activite"=>$activite,'form'=>$form->createView());
		}
	}
	 
}
