<?php

namespace Lea\PrestaBundle\Controller;

use Lea\PrestaBundle\Entity\EgwDispositif;

use Lea\PrestaBundle\Models\Outils;

use Lea\PrestaBundle\Form\Type\EgwDispositifType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class DispositifController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function createAction()
	{
		$form = $this->createForm(new EgwDispositifType());
		
		$request = $this->getRequest();
		$EgwDispositif = $request->request->get('EgwDispositif');
		if ($EgwDispositif['idTypePrestation']!=null) 
		{
			$dispositif = new EgwDispositif();
			$typePresta = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTypePrestation')->find($EgwDispositif['idTypePrestation']);
			$nom = $typePresta->getLibelle().$EgwDispositif['zoneGeographique'].'_'.date('y',Outils::getTmps($EgwDispositif['dateDebut']. ' 00:00'));
			$dispositif->setNomDispositif($nom);	
			$dispositif->setZoneGeographique($EgwDispositif['zoneGeographique']);
			$dispositif->setObjet($EgwDispositif['objet']);
			$dispositif->setIsActive($EgwDispositif['isActive']);
			$dispositif->setNumeroMarche($EgwDispositif['numeroMarche']);
			$dispositif->setNumeroLot($EgwDispositif['numeroLot']);
			$dispositif->setIdTypePrestation($typePresta);
			$dispositif->setActivite($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwActivite')->find($EgwDispositif['activite']));
			
			if($EgwDispositif['dateDebut']!=null)
			$dispositif->setDateDebut(Outils::getTmps($EgwDispositif['dateDebut']. ' 00:00'));
			
			if($EgwDispositif['dateFin']!=null)
			$dispositif->setdateFin(Outils::getTmps($EgwDispositif['dateFin']. ' 00:00'));
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($dispositif);
		    $em->flush();
			
	  		echo json_encode("Le dispositif ".$nom." est crée");
	  		die();
		}
		else
		return array('form'=>$form->createView());
	}
	/**
	 *
	 * @Template()
	 */
	public function showAction($id = null)
	{
		$request = $this->getRequest();
		$EgwDispositif = $request->request->get('EgwDispositif');
		$d = new EgwDispositif();
		
		if(!isset($EgwDispositif['isActive']))
		$EgwDispositif['isActive'] = 1;
		
		$dispositifs = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->findBy(array('isActive'=>$EgwDispositif['isActive']));
		$d->setIsActive($EgwDispositif['isActive']);
		
		
		
		$form = $this->createForm(new EgwDispositifType(),$d);
		//	 \Doctrine\Common\Util\Debug::dump($dispositifs,2);die();
		return array("dispositifs"=>$dispositifs,'form'=>$form->createView());
	}
	/**
	 *
	 * @Template()
	 */
	public function editAction($id)
	{
		$dispositif = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->find($id);
		$request = $this->getRequest();
		$EgwDispositif = $request->request->get('EgwDispositif');
		if ($request->getMethod() == 'POST') 
		{
		$typePresta = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTypePrestation')->find($EgwDispositif['idTypePrestation']);
		$nom = $typePresta->getLibelle().$EgwDispositif['zoneGeographique'];
		$dispositif->setNomDispositif($nom);	
		$dispositif->setZoneGeographique($EgwDispositif['zoneGeographique']);
		$dispositif->setObjet($EgwDispositif['objet']);
		$dispositif->setIsActive($EgwDispositif['isActive']);
		$dispositif->setNumeroMarche($EgwDispositif['numeroMarche']);
		$dispositif->setNumeroLot($EgwDispositif['numeroLot']);
		$dispositif->setIdTypePrestation($typePresta);
		$dispositif->setActivite($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwActivite')->find($EgwDispositif['activite']));

		// SPIREA
		$contrat = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContract')->find($EgwDispositif['idContract']);
		$dispositif->setIdContract($contrat);
		// Fin - SPIREA
		
		if($EgwDispositif['dateDebut']!=null)
		$dispositif->setDateDebut(Outils::getTmps($EgwDispositif['dateDebut']. ' 00:00'));
		
		if($EgwDispositif['dateFin']!=null)
		$dispositif->setdateFin(Outils::getTmps($EgwDispositif['dateFin']. ' 00:00'));
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($dispositif);
	    $em->flush();
	    echo json_encode('Le dispositif a été modifiée');
		die();
		}
		else {
		
		$formDispositif = $this->createForm(new EgwDispositifType(),$dispositif);
		
		return array("dispositif"=>$dispositif,'formDispositif'=>$formDispositif->createView());
		}
	}
}
