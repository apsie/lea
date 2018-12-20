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
class IndexController extends Zend_Controller_Action
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
        $this->view->listFamille = GestionFamillesProduitsTb::getList('iso');
    }

    function indexAction()
    {




        if (isset($_GET['id_projet']) and $_GET['id_projet'] != null) {

            //V�rification de l'existance du dossier
            $bp = new BpTb();
            $_SESSION['session']->bp = serialize($bp->getValue($_GET['id_projet']));
        } else {
            
        }

        $bp = isset($_SESSION['session']->bp) ? unserialize($_SESSION['session']->bp) : null;

        if ($bp->date_creation != 0) {
            $this->view->date_creation = date('d/m/Y', $bp->date_creation);
        } else {
            $this->view->date_creation = null;
        }
        //print_r($_SESSION['session']); die("dsf");
        if ($bp->date_last_consultant != 0) {
            $this->view->date_last_consultant = date('d/m/Y', $bp->date_last_consultant);
        } else {
            $this->view->date_last_consultant = null;
        }

        $account = new AccountsTb();


        $this->view->listeReferent = $account->getList();


        $account = new AccountsTb();
        $acc = $account->get_value($_GET['id_employe']);
        $this->view->employe = $acc->account_lid;
        $_SESSION['session']->account = serialize($acc);
        if ($bp->id_bp != null) {
            $this->view->title = 'APSIE Business plan : Ouvrir le dossier';
        } else {

            $this->view->title = 'APSIE Business plan : Créer un dossier';
        }





        if ($this->_request->isPost()) {
            $bpTb = new BpTb();
            if ($bp->id_bp == null) {


                $data = array('id_referent' => $_POST['id_referent'],
                    'id_projet' => $_GET['id_projet'],
                    'id_contact' => unserialize($_SESSION['session']->projet)->id_ben,
                    'date_creation' => time(),
                    'statut_dossier' => 'En cours',
                    'id_owner' => $_GET['id_employe']
                );
                //print_r($_SESSION['session']->projet); die();	
                $bpTb->addBp($data);

                $lastData = $bpTb->getLastData();
                $_SESSION['session']->bp = serialize($lastData);
            } else {
                $data = array('id_last_consultant' => unserialize($_SESSION['session']->account)->account_id,
                    'date_last_consultant' => time()
                );
                $bpTb->updateBp($data);
                $lastData = unserialize($_SESSION['session']->bp);
            }




            //Initialisation des titres

            $titrePresentation = new TitrePresentationTb();
            $valeurTitrePresentation = $titrePresentation->get_value($lastData->id_bp);

            $titreProjet = new TitreProjetTb();
            $valeurTitreProjet = $titreProjet->get_value($lastData->id_bp);

            $titreFinancier = new TitreDossierFinancierTb();
            $valeurTitreFinancier = $titreFinancier->get_value($lastData->id_bp);

            //$titreValidation = new TitreValidationTb();
            //$valeur_titre_validation=$titreValidation->get_value($lastData->id_bp);
            $textePresentation = new TextePresentationTb();
            $valeurTextePresentation = $textePresentation->get_value($lastData->id_bp);
            $texteProjet = new TexteProjetTb();
            $valeurTexteProjet = $texteProjet->get_value($lastData->id_bp);
            $texteAspect = new TexteAspectTb();
            $valeurTexteAspect = $texteAspect->get_value($lastData->id_bp);
            $texteFinancier = new TexteFinancierTb();
            $valeurTexteFinancier = $texteFinancier->get_value($lastData->id_bp);


            if ($valeurTitrePresentation == NULL) {
                $titrePresentation->initialiser_titre($lastData->id_bp);
            }


            if ($valeurProjet == NULL) {
                $titreProjet->initialiser_titre($lastData->id_bp);
            }

            if ($valeurFinancier == NULL) {
                $titreFinancier->initialiser_titre($lastData->id_bp);
            }
            /* 	if($valeur_titre_validation==NULL)
              {
              $titreValidation->initialiserTitreValidation($lastData->id_bp);

              } */
            if ($valeurTextePresentation == NULL) {

                $textePresentation->initialiser_texte($lastData->id_bp);
            }

            if ($valeurTexteProjet == NULL) {
                $texteProjet->initialiser_texte($lastData->id_bp);
            }

            if ($valeurTexteAspect == NULL) {
                $texteAspect->initialiser_texte($lastData->id_bp);
            }
            if ($valeurTexteFinancier == NULL) {
                $texteFinancier->initialiser_texte($lastData->id_bp);
            }


            $resacc = new ResaccTb();
            $_SESSION['session']->resacc = serialize($resacc->get_value(unserialize($_SESSION['session']->projet)->id_projet));


            $this->_redirect('/index/home/');
        }
    }

    function homeAction()
    {

        //print_r($_SESSION['session']->projet); die();
        $projet = unserialize($_SESSION['session']->projet);
        $this->view->title = 'APSIE Business plan';
        $this->view->nom_complet = $projet->nom_complet;
        $this->view->desc_projet = $projet->description_projet;
        $this->view->employe = unserialize($_SESSION['session']->account)->account_lid;
    }

    function gestionfamillesproduitsAction()
    {
        $this->view->title = 'APSIE Business plan : Gestion des familles de produits';
    }

    function gestiongammesproduitsAction()
    {
        $this->view->title = 'APSIE Business plan : Gestion des gammes de produits';
    }

    function gestionproduitsAction()
    {
        $this->view->title = 'APSIE Business plan : Gestion des produits';
    }

}
