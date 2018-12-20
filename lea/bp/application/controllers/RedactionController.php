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
class RedactionController extends Zend_Controller_Action
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
		//$this->view->setEncoding("UTF-8");
		
	$bp = unserialize($_SESSION['session']->bp);
        $projet = unserialize($_SESSION['session']->projet);
        $account = unserialize($_SESSION['session']->account);
		//TITRE
	$titrePresentation = new TitrePresentationTb();
	$valeurTitrePresentation=$titrePresentation->get_value($bp->id_bp);
	$titreProjet = new TitreProjetTb();
	$valeurTitreProjet=$titreProjet->get_value($bp->id_bp);
	Zend_Registry::set('titrePresentation', $valeurTitrePresentation);
	Zend_Registry::set('titreProjet', $valeurTitreProjet);
	$this->view->titrePresentation=$valeurTitrePresentation;
	$this->view->titreProjet=$valeurTitreProjet;
	//print_r($valeurTitrePresentation);die();
	
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
	$valeur_validation = $titreValidation->get_value($_SESSION['session']->bp->id_bp);
	Zend_Registry::set('validation',$valeur_validation);*/
	
	$this->view->nom_complet = $projet->nom_complet;
		$this->view->desc_projet = $projet->description_projet;
		$this->view->employe = $account->account_lid;
	
	/*$secteur= new BanquetexteTb();
	$la_liste=$secteur->getBanqueList();
	Zend_Registry::set('secteur', $la_liste);*/
	/* $validation = new TitreValidationRedactionForm();
	 $this->view->formValidation = $validation;*/
		
	 //	$this->view->listProduit = GestionProduitsTb::getList('iso',$_SESSION['session']->bp->id_bp);
	 	
	
	}
	
 function indexAction()
    {
		
		$this->view->title = 'APSIE Business plan : Rédaction';
		
		
    }
	
	 function sommairepresentationAction()
    {  	
		
		
		
		$this->view->title = 'APSIE Business plan : Présentation du porteur de projet';
		$this->view->title_2 ='<div class="titre_court">SOMMAIRE</div>';
		/*$bp_texte= new TexteTb();
	    $row=$bp_texte->get_value();
		Zend_Registry::set('texte_titre_sommaire', $row->texte_titre_sommaire);
		
		$form = new SommaireForm();
		
        $form->submit->setLabel('Enregistrer');
        $this->view->form = $form;
		   
		   if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
             
				if(!$row)
				{//Insertion d'une nouvelle ligne
					$row = $compte->createRow();
				}
				 $row->date_creation = time();
				 $row->id_owner = $sess->id_employe;
				 $row->texte_titre_sommaire = $form->getValue('sommaire');
				 $row->save();
				}
				else
				{
				$form->populate($formData);
				}
				 
		   }*/
		
		
    }
    
	 function sommaireprojetAction()
    {  	
		
		
		
		$this->view->title = 'APSIE Business plan : Le projet';
		$this->view->title_2 ='<div class="titre_court">SOMMAIRE</div>';
	
		
		
    }
 function sommaireaspectAction()
    {  	
		
		
		
		$this->view->title = 'APSIE Business plan : Aspects juridiques, fiscaux, sociaux';
		$this->view->title_2 ='<div class="titre_court">SOMMAIRE</div>';
	
		
		
    }
 function sommairefinancierAction()
    {  	
		
		
		
		$this->view->title = 'APSIE Business plan : Dossier financier';
		$this->view->title_2 ='<div class="titre_court">SOMMAIRE</div>';
	
		
		
    }
	
	function introductionAction()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_intro;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_intro;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">'.Zend_Registry::get('titre')->titre_intro.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">'.Zend_Registry::get('titre')->titre_intro.'</div>';
	}
	
	
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_intro'=>$form->getValue('intro'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/introduction');
				}
		   }
		   
	}
	
function titrefinancier11Action()
	{
		
	$this->view->title = 'APSIE Business plan : Dossier financier';
	$this->view->title_2 ='Les demandes de financement';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.1 Besoin de financement global</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.1 Besoin de financement global</div>';
	}

	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteFinancier = new TexteFinancierTb();
			  $data = array('texte_titre_1_1'=>$form->getValue('texte_titre_financier_1_1'));
			   $texteFinancier->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrefinancier11/?div=div_1');
				}
		   }
	}
	
function titrefinancier12Action()
	{
		
	$this->view->title = 'APSIE Business plan : Dossier financier';
	$this->view->title_2 ='Les demandes de financement';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.2 Les demandes de financement</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.2 Les demandes de financement</div>';
	}

	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteFinancier = new TexteFinancierTb();
			  $data = array('texte_titre_1_2'=>$form->getValue('texte_titre_financier_1_2'));
			   $texteFinancier->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrefinancier12/?div=div_1');
				}
		   }
	}
	
	function titrefinancier2Action()
	{
		
	$this->view->title = 'APSIE Business plan : Dossier financier';
	$this->view->title_2 ='Composition du dossier financier';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2. Composition du dossier financier</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2. Composition du dossier financier</div>';
	}

	
	}
	
	
function titreaspect1Action()
	{
		
	$this->view->title = 'APSIE Business plan : Aspects juridiques, fiscaux, sociaux > Aspects juridiques';
	$this->view->title_2 ='Aspects juridiques';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1. Les Aspects juridiques</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1. Les Aspects juridiques</div>';
	}

	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteAspect = new TexteAspectTb();
			  $data = array('texte_titre_1'=>$form->getValue('texte_titre_aspect_1'));
			   $texteAspect->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreaspect1');
				}
		   }
	}
function titreaspect2Action()
	{
		
	$this->view->title = 'APSIE Business plan : Aspects juridiques, fiscaux, sociaux  > Aspects juridiques';
	$this->view->title_2 ='Aspects fiscaux';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2. Aspects fiscaux</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2. Aspects fiscaux</div>';
	}


	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteAspect = new TexteAspectTb();
			  $data = array('texte_titre_2'=>$form->getValue('texte_titre_aspect_2'));
			   $texteAspect->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreaspect2');
				}
		   }
	}
	
function titreaspect3Action()
	{
		
	$this->view->title = 'APSIE Business plan : Aspects juridiques, sociaux, fiscaux > Aspects juridiques';
	$this->view->title_2 ='Aspects Fiscaux';
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3. Aspects sociaux</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3. Aspects sociaux</div>';
	}


	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteAspect = new TexteAspectTb();
			  $data = array('texte_titre_3'=>$form->getValue('texte_titre_aspect_3'));
			   $texteAspect->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreaspect3');
				}
		   }
	}
	
	function titrepresentation11Action()
	{
		
	$this->view->age_contact=Age::get_age($_SESSION['session']->projet->date_naissance);
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_1.' > '.$this->view->titrePresentation->titre_1_1;
	$this->view->title_2 =$this->view->titrePresentation->titre_1_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.1. '.$this->view->titrePresentation->titre_1_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.1. '.$this->view->titrePresentation->titre_1_1.'</div>';
	}
	/*$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_1_1'=>$form->getValue('texte_titre_1_1'));
			  $texte->update($data,'id_bp='.$_SESSION['session']->bp->id_bp);
			  $this->_redirect('/redaction/titre11');
				}
		   }
		  */ 
	}
	function titrepresentation12Action()
	{
		
	$this->view->title = 'APSIE Business plan : Pr�sentation du porteur de projet > '.$this->view->titrePresentation->titre_1.' > '.$this->view->titrePresentation->titre_1_2;
	$this->view->title_2 =$this->view->titrePresentation->titre_1_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.2. '.$this->view->titrePresentation->titre_1_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.2. '.$this->view->titrePresentation->titre_1_2.'</div>';
	}
		   
	}
function titrepresentation13Action()
	{
	$bp = unserialize($_SESSION['session']->bp);
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_1.' > '.$this->view->titrePresentation->titre_1_2;
	$this->view->title_2 =$this->view->titrePresentation->titre_1_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.2. '.$this->view->titrePresentation->titre_1_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.2. '.$this->view->titrePresentation->titre_1_2.'</div>';
	}
	
	$ressource = new RessourceTb();
	$this->view->ressourceCreateur = $ressource->getList($bp->id_bp,'createur','iso');
	$this->view->ressourceConjoint = $ressource->getList($bp->id_bp,'conjoint','iso');
	
	$charge = new ChargeTb();
	$this->view->chargeMontant = $charge->getList($bp->id_bp,'montant','iso');
	$this->view->chargeDuree = $charge->getList($bp->id_bp,'duree','iso');

if($this->view->ressourceCreateur['id_owner']=='')
{
	
		$this->view->ressourceCreateur['revenu_pro_net'] = 0;
		$this->view->ressourceCreateur['retraite'] = 0;
		$this->view->ressourceCreateur['pole_emploi'] = 0;
		$this->view->ressourceCreateur['pensions'] = 0;
		$this->view->ressourceCreateur['rsa'] = 0;
		$this->view->ressourceCreateur['prestations_familiales'] = 0;
		$this->view->ressourceCreateur['aide_logement'] = 0;
		$this->view->ressourceCreateur['allocations_diverses'] = 0;
		$this->view->ressourceCreateur['autres'] = 0;
	
}
	if($this->view->ressourceConjoint['id_owner']=='')
{
	
		$this->view->ressourceConjoint['revenu_pro_net'] = 0;
		$this->view->ressourceConjoint['retraite'] = 0;
		$this->view->ressourceConjoint['pole_emploi'] = 0;
		$this->view->ressourceConjoint['pensions'] = 0;
		$this->view->ressourceConjoint['rsa'] = 0;
		$this->view->ressourceConjoint['prestations_familiales'] = 0;
		$this->view->ressourceConjoint['aide_logement'] = 0;
		$this->view->ressourceConjoint['allocations_diverses'] = 0;
		$this->view->ressourceConjoint['autres'] = 0;
	
}

	if($this->view->chargeMontant['id_owner']=='')
{
	
		$this->view->chargeMontant['loyer'] = 0;
		$this->view->chargeMontant['credit_conso'] = 0;
		$this->view->chargeMontant['credit_auto'] = 0;
		$this->view->chargeMontant['credit_immo'] = 0;
		$this->view->chargeMontant['pension_alimentaire'] = 0;
		$this->view->chargeMontant['credit_revolving'] = 0;
		$this->view->chargeMontant['autre'] = 0;
	
	
}
		if($this->view->chargeDuree['id_owner']=='')
{
	
		$this->view->chargeDuree['loyer'] = 0;
		$this->view->chargeDuree['credit_conso'] = 0;
		$this->view->chargeDuree['credit_auto'] = 0;
		$this->view->chargeDuree['credit_immo'] = 0;
		$this->view->chargeDuree['pension_alimentaire'] = 0;
		$this->view->chargeDuree['credit_revolving'] = 0;
		$this->view->chargeDuree['autre'] = 0;
	
	
}
	
		 
	}
	
	function titrepresentation21Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_1;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.1. '.$this->view->titrePresentation->titre_2_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.1. '.$this->view->titrePresentation->titre_2_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_1'=>$form->getValue('texte_titre_presentation_2_1'));
			   $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation21/?div=div_2');
				}
		   }
		   
	}
	
function titrepresentation22Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_2;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.2. '.$this->view->titrePresentation->titre_2_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.2. '.$this->view->titrePresentation->titre_2_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_2'=>$form->getValue('texte_titre_presentation_2_2'));
			  $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation22/?div=div_2');
				}
		   }
		   
	}
	
function titrepresentation23Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_3;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.3. '.$this->view->titrePresentation->titre_2_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.3. '.$this->view->titrePresentation->titre_2_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
               $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_3'=>$form->getValue('texte_titre_presentation_2_3'));
			  $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation23/?div=div_2');
				}
		   }
		   
	}
function titrepresentation24Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_4;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_4;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.4. '.$this->view->titrePresentation->titre_2_4.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.4. '.$this->view->titrePresentation->titre_2_4.'</div>';
	}
	
	}
function titrepresentation241Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_4_1;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_4_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.4.1 '.$this->view->titrePresentation->titre_2_4_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.4.1 '.$this->view->titrePresentation->titre_2_4_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_4_1'=>$form->getValue('texte_titre_presentation_2_4_1'));
			  $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation241/?div=div_2');
				}
		   }
		   
	}
function titrepresentation242Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_4_2;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_4_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.4.2 '.$this->view->titrePresentation->titre_2_4_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.4.2 '.$this->view->titrePresentation->titre_2_4_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_4_2'=>$form->getValue('texte_titre_presentation_2_4_2'));
			  $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation242/?div=div_2');
				}
		   }
		   
	}
function titrepresentation243Action()
	{
	$this->view->title = 'APSIE Business plan : Présentation du porteur de projet > '.$this->view->titrePresentation->titre_2.' > '.$this->view->titrePresentation->titre_2_4_3;
	$this->view->title_2 = $this->view->titrePresentation->titre_2_4_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.4.3 '.$this->view->titrePresentation->titre_2_4_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.4.3 '.$this->view->titrePresentation->titre_2_4_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $textePresentation = new TextePresentationTb();
			  $data = array('texte_titre_2_4_3'=>$form->getValue('texte_titre_presentation_2_4_3'));
			  $textePresentation->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titrepresentation243/?div=div_2');
				}
		   }
		   
	}
	
	
	
function titreprojet11Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_1;
	$this->view->title_2 = $this->view->titreProjet->titre_1_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.1. '.$this->view->titreProjet->titre_1_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.1. '.$this->view->titreProjet->titre_1_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_1'=>$form->getValue('texte_titre_projet_1_1'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet11/?div=div_1');
				}
		   }
		   
	}
	
function titreprojet12Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_2;
	$this->view->title_2 = $this->view->titreProjet->titre_1_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.2. '.$this->view->titreProjet->titre_1_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.2. '.$this->view->titreProjet->titre_1_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_2'=>$form->getValue('texte_titre_projet_1_2'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet12/?div=div_1');
				}
		   }
		   
	}
	
function titreprojet13Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_3;
	$this->view->title_2 = $this->view->titreProjet->titre_1_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.3. '.$this->view->titreProjet->titre_1_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.3. '.$this->view->titreProjet->titre_1_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_3'=>$form->getValue('texte_titre_projet_1_3'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet13/?div=div_1');
				}
		   }
		   
	}
	
function titreprojet14Action()
	{
		
		$this->view->listProduit = GestionProduitsTb::getList('iso',unserialize($_SESSION['session']->bp)->id_bp);
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_4;
	$this->view->title_2 = $this->view->titreProjet->titre_1_4;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.4. '.$this->view->titreProjet->titre_1_4.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.4. '.$this->view->titreProjet->titre_1_4.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_4'=>$form->getValue('texte_titre_projet_1_4'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet14/?div=div_1');
				}
		   }
		   
	}
	
function titreprojet15Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_5;
	$this->view->title_2 = $this->view->titreProjet->titre_1_5;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.5. '.$this->view->titreProjet->titre_1_5.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.5. '.$this->view->titreProjet->titre_1_5.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_5'=>$form->getValue('texte_titre_projet_1_5'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet15/?div=div_1');
				}
		   }
		   
	}
	
	
function titreprojet16Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_1.' > '.$this->view->titreProjet->titre_1_6;
	$this->view->title_2 = $this->view->titreProjet->titre_1_6;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">1.6. '.$this->view->titreProjet->titre_1_6.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">1.6. '.$this->view->titreProjet->titre_1_6.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_1_6'=>$form->getValue('texte_titre_projet_1_6'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet16/?div=div_1');
				}
		   }
		   
	}
	
	
	
function titreprojet21Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_2.' > '.$this->view->titreProjet->titre_2_1;
	$this->view->title_2 = $this->view->titreProjet->titre_2_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.1. '.$this->view->titreProjet->titre_2_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.1. '.$this->view->titreProjet->titre_2_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_2_1'=>$form->getValue('texte_titre_projet_2_1'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet21/?div=div_2');
				}
		   }
		   
	}
	
function titreprojet22Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_2.' > '.$this->view->titreProjet->titre_2_2;
	$this->view->title_2 = $this->view->titreProjet->titre_2_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.2. '.$this->view->titreProjet->titre_2_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.2. '.$this->view->titreProjet->titre_2_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_2_2'=>$form->getValue('texte_titre_projet_2_2'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet22/?div=div_2');
				}
		   }
		   
	}
	
function titreprojet23Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_2.' > '.$this->view->titreProjet->titre_2_3;
	$this->view->title_2 = $this->view->titreProjet->titre_2_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.3. '.$this->view->titreProjet->titre_2_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.3. '.$this->view->titreProjet->titre_2_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_2_3'=>$form->getValue('texte_titre_projet_2_3'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet23/?div=div_2');
				}
		   }
		   
	}
	
function titreprojet24Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_2.' > '.$this->view->titreProjet->titre_2_4;
	$this->view->title_2 = $this->view->titreProjet->titre_2_4;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">2.4. '.$this->view->titreProjet->titre_2_4.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">2.4. '.$this->view->titreProjet->titre_2_4.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_2_4'=>$form->getValue('texte_titre_projet_2_4'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet24/?div=div_2');
				}
		   }
		   
	}
function titreprojet31Action()
	{
	
		$bp = unserialize($_SESSION['session']->bp);		
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_3.' > '.$this->view->titreProjet->titre_3_1;
	$this->view->title_3 = $this->view->titreProjet->titre_3_1;
	if (strlen($this->view->title_3)>12)
	{
	$this->view->title_3 = '<div class="titre_long">3.1. '.$this->view->titreProjet->titre_3_1.'</div>';
	}
	else 
	{
	$this->view->title_3 = '<div class="titre_court">3.1. '.$this->view->titreProjet->titre_3_1.'</div>';
	}
	
	$moyen = new MoyenHumainTb();
	$this->view->productif=$moyen->getList($bp->id_bp,'productif');
	$this->view->encadrement=$moyen->getList($bp->id_bp,'encadrement');
	$this->view->commercial=$moyen->getList($bp->id_bp,'commercial');
	$this->view->administration=$moyen->getList($bp->id_bp,'administration');
	
		   
	}
	
function titreprojet32Action()
	{

			
	$bp = unserialize($_SESSION['session']->bp);
				
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_3.' > '.$this->view->titreProjet->titre_3_2;
	$this->view->title_3 = $this->view->titreProjet->titre_3_2;
	if (strlen($this->view->title_3)>12)
	{
	$this->view->title_3 = '<div class="titre_long">3.2. '.$this->view->titreProjet->titre_3_2.'</div>';
	}
	else 
	{
	$this->view->title_3 = '<div class="titre_court">3.2. '.$this->view->titreProjet->titre_3_2.'</div>';
	}
	
	$moyen = new MoyenImmTerrainTb();
	$this->view->achat=$moyen->getList($bp->id_bp,'achat');
	$this->view->location=$moyen->getList($bp->id_bp,'location');
	$this->view->credit=$moyen->getList($bp->id_bp,'credit');

	
		   
	}
	
function titreprojet33Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_3.' > '.$this->view->titreProjet->titre_3_3;
	$this->view->title_3 = $this->view->titreProjet->titre_3_3;
	if (strlen($this->view->title_3)>12)
	{
	$this->view->title_3 = '<div class="titre_long">3.3. '.$this->view->titreProjet->titre_3_3.'</div>';
	}
	else 
	{
	$this->view->title_3 = '<div class="titre_court">3.3. '.$this->view->titreProjet->titre_3_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_3_3'=>$form->getValue('texte_titre_projet_3_3'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet33/?div=div_3');
				}
		   }
		   
	}
function titreprojet34Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_3.' > '.$this->view->titreProjet->titre_3_4;
	$this->view->title_3 = $this->view->titreProjet->titre_3_4;
	if (strlen($this->view->title_3)>12)
	{
	$this->view->title_3 = '<div class="titre_long">3.4. '.$this->view->titreProjet->titre_3_4.'</div>';
	}
	else 
	{
	$this->view->title_3 = '<div class="titre_court">3.4. '.$this->view->titreProjet->titre_3_4.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_3_4'=>$form->getValue('texte_titre_projet_3_4'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet34/?div=div_3');
				}
		   }
		   
	}
function titreprojet35Action()
	{
	$this->view->title = 'APSIE Business plan : Le projet > '.$this->view->titreProjet->titre_3.' > '.$this->view->titreProjet->titre_3_5;
	$this->view->title_3 = $this->view->titreProjet->titre_3_5;
	if (strlen($this->view->title_3)>12)
	{
	$this->view->title_3 = '<div class="titre_long">3.5. '.$this->view->titreProjet->titre_3_5.'</div>';
	}
	else 
	{
	$this->view->title_3 = '<div class="titre_court">3.5. '.$this->view->titreProjet->titre_3_5.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texteProjet = new TexteProjetTb();
			  $data = array('texte_titre_3_5'=>$form->getValue('texte_titre_projet_3_5'));
			   $texteProjet->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titreprojet35/?div=div_3');
				}
		   }
		   
	}
	
	//////////VERSION 1/////
	
	function titre30Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_0;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_0;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.0. '.Zend_Registry::get('titre')->titre_3_0.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.0. '.Zend_Registry::get('titre')->titre_3_0.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_0'=>$form->getValue('texte_titre_3_0'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre30');
				}
		   }
		   
	}
	function titre31Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.1. '.Zend_Registry::get('titre')->titre_3_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.1. '.Zend_Registry::get('titre')->titre_3_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_1'=>$form->getValue('texte_titre_3_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre31');
				}
		   }
		   
	}
	function titre311Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_1_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_1_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.1.1. '.Zend_Registry::get('titre')->titre_3_1_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.1.1. '.Zend_Registry::get('titre')->titre_3_1_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_1_1'=>$form->getValue('texte_titre_3_1_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre311');
				}
		   }
		   
	}
	function titre312Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_1_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_1_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.1.2. '.Zend_Registry::get('titre')->titre_3_1_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.1.2. '.Zend_Registry::get('titre')->titre_3_1_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_1_2'=>$form->getValue('texte_titre_3_1_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre312');
				}
		   }
		   
	}
	function titre321Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_2_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_2_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.2.1. '.Zend_Registry::get('titre')->titre_3_2_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.2.1. '.Zend_Registry::get('titre')->titre_3_2_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_2_1'=>$form->getValue('texte_titre_3_2_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre321');
				}
		   }
		   
	}
	function titre322Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_2_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_2_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.2.2. '.Zend_Registry::get('titre')->titre_3_2_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.2.2. '.Zend_Registry::get('titre')->titre_3_2_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_2_2'=>$form->getValue('texte_titre_3_2_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre322');
				}
		   }
		   
	}
	function titre323Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_2_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_2_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.2.3. '.Zend_Registry::get('titre')->titre_3_2_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.2.3. '.Zend_Registry::get('titre')->titre_3_2_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_2_3'=>$form->getValue('texte_titre_3_2_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre323');
				}
		   }
		   
	}
	function titre331Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_3_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_3_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.3.1. '.Zend_Registry::get('titre')->titre_3_3_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.3.1. '.Zend_Registry::get('titre')->titre_3_3_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_3_1'=>$form->getValue('texte_titre_3_3_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre331');
			  
			 
				
				}
		   }
		   
	}
	function titre332Action()
	{
	
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_3_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_3_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.3.2. '.Zend_Registry::get('titre')->titre_3_3_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.3.2. '.Zend_Registry::get('titre')->titre_3_3_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_3_2'=>$form->getValue('texte_titre_3_3_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre332');
				}
		   }
		   
	}
	function titre333Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_3_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_3_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.3.3. '.Zend_Registry::get('titre')->titre_3_3_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">3.3.3. '.Zend_Registry::get('titre')->titre_3_3_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_3_3'=>$form->getValue('texte_titre_3_3_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre333');
				}
		   }
		   
	}
	function titre34Action()
	{
	$this->view->title = 'APSIE Business plan : R�daction > '.Zend_Registry::get('titre')->titre_3.' > '.Zend_Registry::get('titre')->titre_3_4;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_3_4;
	
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">3.4. '.Zend_Registry::get('titre')->titre_3_4.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">'.Zend_Registry::get('titre')->titre_3_4.'</div>';
	}
	
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_3_4'=>$form->getValue('texte_titre_3_4'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre34');
				}
		   }
		   
	}
	function titre41Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.1. '.Zend_Registry::get('titre')->titre_4_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.1. '.Zend_Registry::get('titre')->titre_4_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_1'=>$form->getValue('texte_titre_4_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre41');
				}
		   }
		   
	}
	function titre421Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_2_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_2_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.2.1. '.Zend_Registry::get('titre')->titre_4_2_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.2.1. '.Zend_Registry::get('titre')->titre_4_2_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_2_1'=>$form->getValue('texte_titre_4_2_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre421');
				}
		   }
		   
	}
	function titre422Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_2_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_2_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.2.2. '.Zend_Registry::get('titre')->titre_4_2_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.2.2. '.Zend_Registry::get('titre')->titre_4_2_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_2_2'=>$form->getValue('texte_titre_4_2_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre422');
				}
		   }
		   
	}
	function titre423Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_2_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_2_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.2.3. '.Zend_Registry::get('titre')->titre_4_2_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.2.3. '.Zend_Registry::get('titre')->titre_4_2_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_2_3'=>$form->getValue('texte_titre_4_2_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre423');
				}
		   }
		   
	}
	function titre424Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_2_4;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_2_4;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.2.4. '.Zend_Registry::get('titre')->titre_4_2_4.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.2.4. '.Zend_Registry::get('titre')->titre_4_2_4.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_2_4'=>$form->getValue('texte_titre_4_2_4'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre424');
				}
		   }
		   
	}
	function titre431Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_3_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_3_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.3.1. '.Zend_Registry::get('titre')->titre_4_3_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.3.1. '.Zend_Registry::get('titre')->titre_4_3_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_3_1'=>$form->getValue('texte_titre_4_3_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre431');
				}
		   }
		   
	}
	function titre432Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_3_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_3_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.3.2. '.Zend_Registry::get('titre')->titre_4_3_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.3.2. '.Zend_Registry::get('titre')->titre_4_3_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_3_2'=>$form->getValue('texte_titre_4_3_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre432');
				}
		   }
		   
	}
	function titre433Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_3_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_3_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.3.3. '.Zend_Registry::get('titre')->titre_4_3_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.3.3. '.Zend_Registry::get('titre')->titre_4_3_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_3_3'=>$form->getValue('texte_titre_4_3_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre433');
				}
		   }
		   
	}
	function titre441Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_4_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_4_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.4.1. '.Zend_Registry::get('titre')->titre_4_4_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.4.1. '.Zend_Registry::get('titre')->titre_4_4_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_4_1'=>$form->getValue('texte_titre_4_4_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre441');
				}
		   }
		   
	}
	function titre442Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_4_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_4_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.4.2. '.Zend_Registry::get('titre')->titre_4_4_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.4.2. '.Zend_Registry::get('titre')->titre_4_4_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_4_2'=>$form->getValue('texte_titre_4_4_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre442');
				}
		   }
		   
	}
	function titre443Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_4.' > '.Zend_Registry::get('titre')->titre_4_4_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_4_4_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">4.4.3. '.Zend_Registry::get('titre')->titre_4_4_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">4.4.3. '.Zend_Registry::get('titre')->titre_4_4_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_4_4_3'=>$form->getValue('texte_titre_4_4_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre443');
				}
		   }
		   
	}
	function titre5Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_5.' > '.Zend_Registry::get('titre')->titre_5;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_5;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">5. '.Zend_Registry::get('titre')->titre_5.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">5. '.Zend_Registry::get('titre')->titre_5.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_5'=>$form->getValue('texte_titre_5'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre5');
				}
		   }
		   
	}
	function titre61Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_6.' > '.Zend_Registry::get('titre')->titre_6_1;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_6_1;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">6.1. '.Zend_Registry::get('titre')->titre_6_1.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">6.1. '.Zend_Registry::get('titre')->titre_6_1.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_6_1'=>$form->getValue('texte_titre_6_1'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre61');
				}
		   }
		   
	}
	function titre62Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_6.' > '.Zend_Registry::get('titre')->titre_6_2;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_6_2;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">6.2. '.Zend_Registry::get('titre')->titre_6_2.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">6.2. '.Zend_Registry::get('titre')->titre_6_2.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_6_2'=>$form->getValue('texte_titre_6_2'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre62');
				}
		   }
		   
	}
	function titre63Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_6.' > '.Zend_Registry::get('titre')->titre_6_3;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_6_3;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">6.3. '.Zend_Registry::get('titre')->titre_6_3.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">6.3. '.Zend_Registry::get('titre')->titre_6_3.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_6_3'=>$form->getValue('texte_titre_6_3'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre63');
				}
		   }
		   
	}
	function titre7Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_7.' > '.Zend_Registry::get('titre')->titre_7;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_7;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">7. '.Zend_Registry::get('titre')->titre_7.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">7. '.Zend_Registry::get('titre')->titre_7.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_7'=>$form->getValue('texte_titre_7'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre7');
				}
		   }
		   
	}
	function titre8Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_8.' > '.Zend_Registry::get('titre')->titre_8;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_8;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">8. '.Zend_Registry::get('titre')->titre_8.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">8. '.Zend_Registry::get('titre')->titre_8.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_8'=>$form->getValue('texte_titre_8'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre8');
				}
		   }
		   
	}
	function titre9Action()
	{
	$this->view->title = 'APSIE Business plan : Rédaction > '.Zend_Registry::get('titre')->titre_9.' > '.Zend_Registry::get('titre')->titre_9;
	$this->view->title_2 = Zend_Registry::get('titre')->titre_9;
	if (strlen($this->view->title_2)>12)
	{
	$this->view->title_2 = '<div class="titre_long">9. '.Zend_Registry::get('titre')->titre_9.'</div>';
	}
	else 
	{
	$this->view->title_2 = '<div class="titre_court">9. '.Zend_Registry::get('titre')->titre_9.'</div>';
	}
	$form = new RedactionForm();
	$this->view->form = $form;
	$form->submit->setLabel('Enregistrer');
	  if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $texte = new TexteTb();
			  $data = array('texte_titre_9'=>$form->getValue('texte_titre_9'));
			  $texte->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
			  $this->_redirect('/redaction/titre9');
				}
		   }
		   
	}
	function titreAction()
	{
			$this->view->title = 'APSIE Business plan : Rédaction > Modification des titres';
			$form = new TitreRedactionForm();
			
		
			$this->view->form = $form;
			$form->submit->setLabel('Enregistrer');
			
		
		   
		   if ($this->_request->isPost()) 
		   {
            $formData = $this->_request->getPost();
           		if ($form->isValid($formData)) 
				{
              $titre = new TitreTb();
				$data =array('titre_sommaire'=>$form->getValue('titre_sommaire'),
									  'titre_intro'=>$form->getValue('titre_intro'),
									  'titre_1'=>$form->getValue('titre_1'),
									  'titre_1_1'=>$form->getValue('titre_1_1'),
									  'titre_1_2'=>$form->getValue('titre_1_2'),
									  'titre_2'=>$form->getValue('titre_2'),
									  'titre_2_1'=>$form->getValue('titre_2_1'), 
									  'titre_2_2'=>$form->getValue('titre_2_2'),
									  'titre_2_3'=>$form->getValue('titre_2_3'),
									  'titre_3'=>$form->getValue('titre_3'),
									  'titre_3_0'=>$form->getValue('titre_3_0'),
									  'titre_3_1'=>$form->getValue('titre_3_1'),
									  'titre_3_1_1'=>$form->getValue('titre_3_1_1'),
									  'titre_3_1_2'=>$form->getValue('titre_3_1_2'),
									  'titre_3_2'=>$form->getValue('titre_3_2'),
									  'titre_3_2_1'=>$form->getValue('titre_3_2_1'),
									  'titre_3_2_2'=>$form->getValue('titre_3_2_2'),
									  'titre_3_2_3'=>$form->getValue('titre_3_2_3'),
									  'titre_3_3'=>$form->getValue('titre_3_3'),
									  'titre_3_3_1'=>$form->getValue('titre_3_3_1'),
									  'titre_3_3_2'=>$form->getValue('titre_3_3_2'),
									  'titre_3_3_3'=>$form->getValue('titre_3_3_3'),
									  'titre_3_4'=>$form->getValue('titre_3_4'),
									  'titre_4'=>$form->getValue('titre_4'),
									  'titre_4_1'=>$form->getValue('titre_4_1'),
									  'titre_4_2'=>$form->getValue('titre_4_2'),
									  'titre_4_2_1'=>$form->getValue('titre_4_2_1'), 	
									  'titre_4_2_2'=>$form->getValue('titre_4_2_2'),
									  'titre_4_2_3'=>$form->getValue('titre_4_2_3'),
									  'titre_4_2_4'=>$form->getValue('titre_4_2_4'),
									  'titre_4_3'=>$form->getValue('titre_4_3'),
									  'titre_4_3_1'=>$form->getValue('titre_4_3_1'),
									  'titre_4_3_2'=>$form->getValue('titre_4_3_2'),
									  'titre_4_3_3'=>$form->getValue('titre_4_3_3'),
									  'titre_4_4'=>$form->getValue('titre_4_4'),
									  'titre_4_4_1'=>$form->getValue('titre_4_4_1'),
									  'titre_4_4_2'=>$form->getValue('titre_4_4_2'),
									  'titre_4_4_3'=>$form->getValue('titre_4_4_3'),
									  'titre_5'=>$form->getValue('titre_5'),
									  'titre_6'=>$form->getValue('titre_6'),
									  'titre_6_1'=>$form->getValue('titre_6_1'),
									  'titre_6_2'=>$form->getValue('titre_6_2'),
									  'titre_6_3'=>$form->getValue('titre_6_3'),
									  'titre_7'=>$form->getValue('titre_7'),
									  'titre_8'=>$form->getValue('titre_8'),
									  'titre_9'=>$form->getValue('titre_9'),
									  );
				$titre->update($data,'id_bp='.unserialize($_SESSION['session']->bp)->id_bp);
				 $this->_redirect('/redaction/sommaire');
				
				}
				 
		   }
		
		
	}


	
}