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
class ImpressionController extends Zend_Controller_Action
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
			//$this->view->setEncoding("ISO-8859-1");
		
		
	$bp = unserialize($_SESSION['session']->bp);
        $projet = unserialize($_SESSION['session']->projet);
		//TITRE
	$titrePresentation = new TitrePresentationTb();
	$valeurTitrePresentation=$titrePresentation->get_value($bp->id_bp);
	$titreProjet = new TitreProjetTb();
	$valeurTitreProjet=$titreProjet->get_value($bp->id_bp);
	Zend_Registry::set('titrePresentation', $valeurTitrePresentation);
	Zend_Registry::set('titreProjet', $valeurTitreProjet);
	$this->view->titrePresentation=$valeurTitrePresentation;
	$this->view->titreProjet=$valeurTitreProjet;
	
	
	
	$textePresentation = new TextePresentationTb();
	$texteProjet = new TexteProjetTb();
	$texteAspect = new TexteAspectTb();
	$texteFinancier = new TexteFinancierTb();
	$valeurTextePresentation=$textePresentation->get_value($bp->id_bp);
	Zend_Registry::set('textePresentation', $valeurTextePresentation);
	$valeurTexteProjet=$texteProjet->get_value($bp->id_bp);
	Zend_Registry::set('texteProjet', $valeurTexteProjet);
	$valeurTexteAspect=$texteAspect->get_value($bp->id_bp);
	Zend_Registry::set('texteAspect', $valeurTexteAspect);
	$valeurTexteFinancier=$texteFinancier->get_value($bp->id_bp);
	Zend_Registry::set('texteFinancier', $valeurTexteFinancier);
	
	
	$resacc = new ResaccTb();
	$valeur_resacc=$resacc->get_value($projet->id_projet);
	Zend_Registry::set('resacc',$valeur_resacc);
	
/*	$titreValidation = new TitreValidationTb();
	$valeur_validation = $titreValidation->get_value($GLOBALS['session']->bp->id_bp);
	Zend_Registry::set('validation',$valeur_validation);*/
	
	$this->view->nom_complet = $projet->nom_complet;
		$this->view->desc_projet = $projet->description_projet;
		$this->view->employe = unserialize($_SESSION['session']->account)->account_lid;
	
	/*$secteur= new BanquetexteTb();
	$la_liste=$secteur->getBanqueList();
	Zend_Registry::set('secteur', $la_liste);*/
	/* $validation = new TitreValidationRedactionForm();
	 $this->view->formValidation = $validation;*/
		
	// 	$this->view->listProduit = GestionProduitsTb::getList('iso',$GLOBALS['session']->bp->id_bp);
	 	
	
	
	}
function editionAction()
	{
	
	
		$this->view->title = 'APSIE Business plan > Edition des données';
	/*	$this->view->titre = Zend_Registry::get('titre');
		$this->view->texte = Zend_Registry::get('texte');
		$this->view->resacc = Zend_Registry::get('resacc');*/
	
	if(isset($_GET['editer']))
	{
		$filePath= './dompdf/www/test/';
		$nameFile=  unserialize($_SESSION['session']->bp)->id_bp.'.html';
		$file = fopen($filePath.$nameFile, 'w');
		$texte = new TexteTb();
		fwrite($file, utf8_decode($texte->get_html( unserialize($_SESSION['session']->bp)->id_bp)));
		fclose($file);


		
	echo'<script>window.location.href="../../dompdf/dompdf.php?base_path=www/test/&input_file='.$nameFile.'&nom_pdf=BP_'. unserialize($_SESSION['session']->projet)->nom.'";</script>';
	}
	
	}
	


	
}