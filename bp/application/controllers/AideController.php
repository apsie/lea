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
class AideController extends Zend_Controller_Action
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
	
	
	$this->view->nom_complet =  unserialize($_SESSION['session']->projet)->nom_complet;
	$this->view->desc_projet = unserialize($_SESSION['session']->projet)->description_projet;
	$this->view->employe = unserialize($_SESSION['session']->account)->account_lid;
	
	}
	function indexAction()
	{
		
		$this->view->title = 'APSIE Business plan > Aide';
		
		}
	
}