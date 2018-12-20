<?php

/**
 * Index controller
 *
 * Default controller for this application.
 * 
 * @uses       Zend_Controller_Action
 * @package    QuickStart
 * @subpackage Controller
 */
class FinancierController extends Zend_Controller_Action
{
    /**
     * The "index" action is the default action for all controllers -- the 
     * landing page of the site.
     *
     * Assuming the default route and default router, this action is dispatched 
     * via the following urls:
     * - /
     * - /index/
     * - /index/index
     *
     * @return void
     */
	
	function init()
	{
		$projet = unserialize($_SESSION['session']->projet);
		$this->view->nom_complet = $projet->nom_complet;
		$this->view->desc_projet = $projet->description_projet;
		$this->view->employe = unserialize($_SESSION['session']->account)->account_lid;
	}
	
 function indexAction()
    {
		
		$this->view->title = 'APSIE Business plan : Dossier Financier';
		
		
    }
	
	 function ventesAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function achatsAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function fraisgenerauxAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function investissementsAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function amortissementsAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function empruntsAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function personnelAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function besoinfondsAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function compteresultatAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function planfinancementAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function tvaAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
	function tresorerieAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }
function tableaubordAction()
    {  	
		$this->view->title = 'APSIE Business plan : Dossier Financier > Ventes ';
		
		
		
		
    }	
		   
		
	}