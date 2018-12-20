<?php

namespace Lea\PrestaBundle\Controller;


use Lea\PrestaBundle\Entity\EgwTexte;

use Lea\PrestaBundle\Form\Type\EgwTexteKeyType;

use Lea\PrestaBundle\Form\Type\EgwTexteType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class TexteController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function createAction()
	{
		$form = $this->createForm(new EgwTexteType());
		
		$request = $this->getRequest();
		$EgwTexte = $request->request->get('EgwTexte');
		if ($EgwTexte['texte']!=null) 
		{
			$t = new EgwTexte();
			$t->setTexte($EgwTexte['texte']);
			$t->setTexteKey($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexteKey')->find($EgwTexte['texteKey']));	
			$em = $this->getDoctrine()->getManager();
			$em->persist($t);
	  		$em->flush();
			
	  		echo json_encode("Le texte ".$EgwTexte['texte']." est crée");
	  		die();
		}
		else
		return array('form'=>$form->createView());
	}
/**
	 *
	 * @Template()
	 */
	public function showAction()
	{
		$textes = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->findAll();
		//\Doctrine\Common\Util\Debug::dump($textes,2);die();
		return array("textes"=>$textes);
	}
	
/**
	 *
	 * @Template()
	 */
	public function editAction($id)
	{
		$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->find($id);
		$request = $this->getRequest();
		$EgwTexte = $request->request->get('EgwTexte');
		if ($request->getMethod() == 'POST') 
		{
		$texte->setTexteKey($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexteKey')->find($EgwTexte['texteKey']));	
		$texte->setTexte($EgwTexte['texte']);	
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($texte);
	    $em->flush();
	    echo json_encode("Le texte a été modifiée");
		die();
		}
		else {
		//\Doctrine\Common\Util\Debug::dump($texte,2);die();
		$form= $this->createForm(new EgwTexteType(),$texte);
		//$form2= $this->createForm(new EgwTexteKeyType(),$texte->getTexteKey());
		
		return array("texte"=>$texte,'form'=>$form->createView());
		}
	}
	 
}
