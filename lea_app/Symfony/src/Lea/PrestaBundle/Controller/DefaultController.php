<?php

namespace Lea\PrestaBundle\Controller;



use Lea\PrestaBundle\Form\Type\EgwDispositifType;


use Lea\PrestaBundle\Form\Type\EgwContactType;

use Lea\PrestaBundle\Form\Type\EgwProjetType;

use Lea\PrestaBundle\Form\Type\EgwPrestaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

class DefaultController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function indexAction($id)
	{
		list($id,$key) = explode('-',$id);
			
		if($key != "463acff2fbc81768ced97932140a0712")
			die("Key de l'application incorrecte");
		
		#Init session
		//$account_session = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts($id);
		$account_session[0] = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->find($id);
		
		$session = $this->container->get('session');
		$session->set('user', $account_session[0]);
		$formPresta = $this->createForm(new EgwPrestaType());
		$account = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts();
		
	
		$formAccount = $this->createForm(new EgwAccountsType(),array('accounts'=>$account,'session_user'=>$account_session[0]));
		
			// \Doctrine\Common\Util\Debug::dump($value->getEgwCalIdUser());die();
		return array(	'formPresta'=> $formPresta->createView(),
						'formAccount'=> $formAccount->createView(),
						'account'=>$account_session[0]);
	}
	 
}
