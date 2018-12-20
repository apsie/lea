<?php

namespace Lea\PrestaBundle\Controller;

use Lea\PrestaBundle\Form\Type\ImportBenType;
use Lea\PrestaBundle\Form\Type\EgwOrganisationType;
use Lea\PrestaBundle\Form\Type\EgwPrestataireType;
use Lea\PrestaBundle\Form\Type\EgwTypePrestationType;
use Lea\PrestaBundle\Form\Type\EgwContactType;
use Lea\PrestaBundle\Form\Type\EgwContactEtatCivilType;
use Lea\PrestaBundle\Form\Type\EgwContactPrType;
use Lea\PrestaBundle\Form\Type\EgwProjetType;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;
use Lea\PrestaBundle\Form\Type\EgwPrestaType;
use Lea\PrestaBundle\Form\Type\EgwCategoriesType;

use Lea\PrestaBundle\Entity\EgwCategories;
use Lea\PrestaBundle\Entity\EgwContactParcoursPro;
use Lea\PrestaBundle\Entity\EgwProjet;
use Lea\PrestaBundle\Entity\EgwContact;
use Lea\PrestaBundle\Entity\EgwPrestation;
use Lea\PrestaBundle\Entity\EgwCalDates;
use Lea\PrestaBundle\Entity\EgwCalUser;
use Lea\PrestaBundle\Entity\EgwCal;
use Lea\PrestaBundle\Entity\EgwAccounts;
use Lea\PrestaBundle\Entity\EgwAddressbook;
use Lea\PrestaBundle\Entity\EgwLink;
use Lea\PrestaBundle\Entity\SpidTickets;
use Lea\PrestaBundle\Entity\SpidRDV;

use Lea\PrestaBundle\Models\Disponibilite;
use Lea\PrestaBundle\Models\Outils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ImportController extends Controller
{
	/**
	 *
	 * @Template()
	 */
	public function indexAction()
	{

        $account = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts();
		$formAccount = $this->createForm(new EgwAccountsType(),array('accounts'=>$account));
		$formPresta = $this->createForm(new EgwPrestaType());
		$formProjet = $this->createForm(new EgwProjetType());
    	$formContact = $this->createForm(new EgwContactType());
    	$formContactPr = $this->createForm(new EgwContactPrType());
    	$formPrestataire = $this->createForm(new EgwPrestataireType());
    	$formOrganisation = $this->createForm(new EgwOrganisationType());
    	
    	// SPIREA
        $formCategories = $this->createForm(new EgwCategoriesType());
        $formFile = $this->createForm(new ImportBenType());
    	
    	// $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->test();
		return array(  
			'formAccount' => $formAccount->createView(),
			'formPresta' => $formPresta->createView(),
			'formProjet' => $formProjet->createView(),
			'formContact' => $formContact->createView(),
			'formContactPr' => $formContactPr->createView(),
			'formPrestataire' => $formPrestataire->createView(),
			'formOrganisation' => $formOrganisation->createView(),

			// SPIREA
            'formCategories' => $formCategories->createView(),
            'formFile'=> $formFile->createView(),
	   	);
    }
    
    /**
     * 
     * @Template()
     */
    public function dataAction(Request $request){
        // Récupération du fichier mis en ligne par l'utilisateur
        $file = $this->getRequest()->files->get('ImportBen');
        $file = $file['importFile'];

        $referer = $this->getRequest()->headers->get('referer');

        $request = $this->getRequest();
        $params['ImportBen'] = $request->request->get('ImportBen');
        $params['EgwContact'] = $request->request->get('EgwContact');
        $params['EgwAddressbook'] = $request->request->get('EgwAddressbook');
        $params['EgwProjet'] = $request->request->get('EgwProjet');
        $params['EgwPresta'] = $request->request->get('EgwPresta');
        $params['EgwTypePrestation'] = $request->request->get('EgwTypePrestation');                    
        $params['EgwAccounts'] = $request->request->get('EgwAccounts');
        $params['Spiclient'] = $request->request->get('Spiclient');
        
        $choix = $request->request->get('choix');
        $params['EgwCategories'] = $request->request->get('EgwCategories');
        $params['disponibilite'] = $request->request->get('disponibilite');
                
        // DISPONIBILITE
        $params_dispo['account_id'] = $params['EgwAccounts']['account_id'];
        $params_dispo['idDispositif'] = $params['EgwPresta']['dispositif'];
        // $params['catId'] = $EgwCategories['categories'];
        // $params['isOption'] = true;
        $params_dispo['typeRecherche'] = 1;
        $params_dispo['dateDebut'] = $params['ImportBen']['dateDebut'];
        $params_dispo['plageDebut'] = $params['ImportBen']['startTime'];
        $params_dispo['plageFin'] = $params['ImportBen']['endTime'];
        $params_dispo['duree'] = $params['ImportBen']['duration'];
        $params_dispo['typeIntervalle'] = 86400;
        $params_dispo['nbIntervalle'] = 0;
        $params_dispo['nbJour'] = 120;
        
        if(is_array($params['ImportBen']['jours'])){
            $params['ImportBen']['jours'] = implode('', $params['ImportBen']['jours']);
        }
        $params_dispo['jours'] = $params['ImportBen']['jours'];
        $params_dispo['em'] = $this->getDoctrine();

        $dispo = new Disponibilite($params_dispo);
        $rdvs = $dispo->get();

        foreach($rdvs['rdv'] as $key => $value){
            if($value['CLASSE'] == 'rdv_pose') unset($rdvs['rdv'][$key]);
        }
        $rdvs['rdv'] = array_values($rdvs['rdv']);

        $result = array();
        $row = 1;
        $used = 1;
        if (($handle = fopen($file->getPathName(), "r")) !== FALSE) {
            // Parcours du fichier
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if($row > 1){
                    // Correspondance des champs
                    $lettreDeCommande = $data[0];
                    $statut           = $data[1];
                    $identifiant      = $data[2];
                    $civilite         = $data[3];
                    $nom              = $data[4];
                    $prenom           = $data[5];
                    $PortablePerso    = $data[6];
                    $adresse_1        = $data[7];
                    $adresse_2        = $data[8];
                    $cp               = $data[9];
                    $ville            = $data[10];
                    $site             = $data[11];

                    $dateRDV          = $data[12];
                    $heureRDV         = $data[13];

                    if($dateRDV and $heureRDV){
                        $m = explode('/', $dateRDV);
                        $t = explode('h', $heureRDV);
                        $start_time = mktime($t[0],$t[1],0,$m[1],$m[0],$m[2]);
                    }else{
                        $start_time = $rdvs['rdv'][$used-1]['VALUE'];
                        ++$used;
                    }

                    // 1. Ajout du bénéficiaire
                    $params['EgwParcoursPro'] = array(
                        'identifiant'   => $identifiant,
                        'statut'        => $statut,
                    );
                    
                    $em = $this->getDoctrine()->getManager();
                    $session = $this->container->get('session');
                    $user = $session->get('user');

                    // Vérification sur l'existence du bénéficiaire       
                    $parcours = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContactParcoursPro')->findBy(
                        ['identifiant' => $identifiant]
                    );
                    
                    $c = null;
                    $contactParcoursPro = null;
                    foreach($parcours as $p){
                        $contact = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->find($p->getIdBen());

                        if($contact->getNom() == $nom and $contact->getPrenom() == $prenom){
                            $c = $contact;
                            $contactParcoursPro = $p;
                            break;
                        }
                    }

                    // Ajout du bénéficiaire
                    if(!$c){
                        $c = new EgwContact();   
                        $c->setIdOwner($user->getAccountId()->getAccountId());
                        $c->setDateCreation(time());
                        $c->setCatId(327);
                    }

                    $c->setIdModifier($user->getAccountId()->getAccountId());
                    $c->setDateLastModified(time());
                    $c->setCivilite($civilite);
                    $c->setNom($nom);
                    $c->setPreNom($prenom);
                    $c->setNomComplet($civilite . ' ' . $prenom . ' ' . $nom);
                    $c->setAdresseLigne1($adresse_1);
                    $c->setAdresseLigne2($adresse_2);
                    $c->setCp($cp);
                    $c->setVille($ville);

                    $c->setOrganisation('');
                    $c->setService('');
                    $c->setFonction('');
                    $c->setAdresseLigne3('');
                    $c->setIdOrganisation('');
                    $c->setNomJeuneFille('');
                    $c->setDeuxiemePrenom('');
                    $c->setPortablePerso($PortablePerso);
                    $c->setPortablePro('');
                    $c->setTelDomicile1('');
                    $c->setTelPro1('');
                    $c->setRegion('');                    
                    $c->setPays('');
                    $c->setEmailPerso('');
                    $c->setIdSEcu('');
                    $c->setDateNaissance('');
                    $c->setLieuNaissance('');
                    $c->setPaysNaissance('');
                    $c->setNationalite('');
                    $c->setSituationMaritale('');
                    $c->setEnfantsACharge('');

                    $em->persist($c);
                    $em->flush();
                    
                    // Contact prescripteur
                    if($row == 2){
                        if ($params['EgwAddressbook']['contactId'] != null)
                            $contactPr = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAddressbook')->getContacts(256, null, null, $params['EgwAddressbook']['contactId']);
                        else
                            $contactPr = array();
            
                        if (count($contactPr) > 0) {
            
                            $contactPr = $contactPr[0];
                        } else {
                            $contactPr = new EgwAddressbook();
                            // $contactPr->setCatId(256);
                            $contactPr->setContactOwner($user->getAccountPrimaryGroup());
                            $contactPr->setContactCreated(time());
                            $contactPr->setContactCreator($user->getAccountId()->getAccountId());
                            $contactPr->setContactPrivate(0);
                        }

                        $contactPr->setContactModifier($user->getAccountId()->getAccountId());
                        $contactPr->setContactModified(time());

                        $contactPr->setNFn($params['EgwAddressbook']['civilite'] . ' ' . $params['EgwAddressbook']['prenom'] . ' ' . $params['EgwAddressbook']['nom']);
                        $contactPr->setNFamily($params['EgwAddressbook']['nom']);
                        $contactPr->setNGiven($params['EgwAddressbook']['prenom']);
                        $contactPr->setTelCell($params['EgwAddressbook']['portablePro']);
                        $contactPr->setContactEmail($params['EgwAddressbook']['emailPro']);
                        $contactPr->setContactRole($params['EgwAddressbook']['fonction']);
                        $contactPr->setNPrefix($params['EgwAddressbook']['civilite']);
                        $em->persist($contactPr);
                        $em->flush();

                        // SPIREA-YLF - Permet de créer le contact une seule fois
                        $params['EgwAddressbook']['contactId'] = $contactPr->getContactId();

                        // SPIREA - Lien
                        $repositoryLink = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwLink');
                        $link = $repositoryLink->findOneBy(array('app1' => 'spiclient', 'id1' => $params['Spiclient']['idOrganisation'],'app2' => 'addressbook', 'id2' => $contactPr->getContactId()));
                        if(empty($link)){
                            $link = new EgwLink();
                            $link->setApp1('spiclient');
                            $link->setId1($params['Spiclient']['idOrganisation']);
                            $link->setApp2('addressbook');
                            $link->setId2($contactPr->getContactId());
                            $link->setLastmod(time());
                            $link->setOwner($user->getAccountId()->getAccountId());
                            $em->persist($link);
                            $em->flush();
                        }
                    }
                    
                    // SPIREA - Ticket
                    $ticket = new SpidTickets();
                    
                    $repositoryClient = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient');
                    $client = $repositoryClient->findOneByIdOrganisation($params['Spiclient']['idOrganisation']);
                    $ticket->setClientId($params['Spiclient']['idOrganisation']);
                    $ticket->setAccountId($client->getAccountId());

                    $repositoryTicket = $this->getDoctrine()->getRepository('LeaPrestaBundle:SpidTickets');
                    $clientTickets = $repositoryTicket->findBy(array('clientId' => $params['Spiclient']['idOrganisation']));
                    $ticket->setTicketNumGroup(count($clientTickets)+1);
                    
                    $repositoryAddressbook = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAddressbook');
                    $ticket->setTicketAssignedBy(0);
                    
                    if(empty($params['EgwAddressbook']['contactId'])){
                        $ticket->setTicketAssignedByContact($contactPr->getContactId());
                    }else{
                        $contact = $repositoryAddressbook->findOneByContactId($params['EgwAddressbook']['contactId']);
                        $ticket->setTicketAssignedByContact($params['EgwAddressbook']['contactId']);
                    }

                    $ticket->setCreatorId($user->getAccountId()->getAccountId());
                    $ticket->setCreationDate(time());
                    $ticket->setTicketAssignedTo($params['EgwAccounts']['account_id']);
                    $ticket->setTicketPrivate(false);
                    $ticket->setCatId($params['EgwCategories']['spid_categories']);
                    $ticket->setTicketClientOrderId($lettreDeCommande);

                    $repositoryDispositif = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif');
                    $dispositif = $repositoryDispositif->findOneByIdDispositif($params['EgwPresta']['dispositif']);
                    $ticket->setContractId($dispositif->getIdContract()->getContractId());

                    // VALEURS PAR DEFAUT --- EN DUR 
                    $ticket->setStateId(2);
                    $ticket->setTicketPriority(5);
                    $ticket->setDueDate(strtotime("+1 month"));
                    $ticket->setTicketUnitTime(1);
                    $ticket->setFactureId(0);
                    $ticket->setTicketSpendTime(0);
                    $ticket->setTicketClosed(0);
                    $ticket->setTicketInvoice(0);
                    // Fin SPIREA

                    if (!is_numeric($contactPr->getIdBen()))
                        $contactPr = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAddressbook')->lastId();

                    // AJOUT CALENDRIER                       
                    $cal = new EgwCal();
                    $cal->setCalOwner($user->getAccountId()->getAccountId());
                    $cal->setCalTitle('');
                    $cal->setCalCreated(time());
                    $cal->setIdPresta(0);
                    $cal->setCalCreator($user->getAccountId()->getAccountId());
                    $cal->setCalRecurrence(0);
                    $cal->setCalPriority(2);
                    $cal->setCalPublic(1);
                    $cal->setCalUid('calendar');
                    $cal->setCalReference(0);
                    $cal->setCalCategory($params['ImportBen']['categories']);
                    $cal->setRangeStart($start_time);
                    $cal->setRangeEnd(($start_time + $params_dispo['duree']));
                    $cal->setCalSite($site);
                    $em->persist($cal);
                    $em->flush();
                
                    // Table cal_dates
                    $d = new EgwCalDates();
                    $d->setCalId($cal->getCalId());
                    $d->setEgwCalId($cal);
                    $d->setCalStart($start_time);
                    $d->setCalEnd(($start_time + $params_dispo['duree']));
                    $em->persist($d);
                    $em->flush();
                
                    // Table cal_user
                    $calU = new EgwCalUser();
                    $calU->setCalId($cal->getCalId());
                    $calU->setEgwCalId($cal);
                    $calU->setCalQuantity(1);
                    $calU->setCalRecurDate(0);
                    $calU->setCalRole('CHAIR');
                    $calU->setCalStatus('U');
                    $calU->setCalUserModified(new \Datetime());
                    $calU->setCalUserId($params_dispo['account_id']);
                    $calU->setCalUserType('u');
                    $em->persist($calU);
                    $em->flush();
                
                    $message = 'La prestation a été crée et le premier rendez-vous posé.';

                    $cal->setCalModifier($user->getAccountId()->getAccountId());
                    $cal->setCalModified(time());
                
                    // SPIREA
                    $date = $d->getCalStart();
                    $ticket->setTicketTitle(date('Ym',$date).'_'.$dispositif->getNomDispositif().'_'.$nom.'_'.$prenom.'_'.$lettreDeCommande);

                    $em->persist($ticket);
                    $em->flush();
                    // FIN SPIREA

                    # Vérification si le contact existe déja
                    // SPIREA-YLF ==> $c = beneficiaire
                    if (!is_numeric($c->getIdBen()))
                        $c = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->lastId();

                    # Parcours Pro
                    // $contactParcoursPro = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContactParcoursPro')->findBy(array('idBen' => $c->getIdBen(), 'statut' => ''));

                    if (!$contactParcoursPro)
                        $contactParcoursPro = new EgwContactParcoursPro();

                    $contactParcoursPro->setStatut($statut);
                    $contactParcoursPro->setIdentifiant($identifiant);

                    //\Doctrine\Common\Util\Debug::dump($c->getIdBen(),2);die();
                    $contactParcoursPro->setParcoursProContact($c);
                    $contactParcoursPro->setDateCreation(time());
                    $contactParcoursPro->setIdOwner($user->getAccountId()->getAccountId());
                    $contactParcoursPro->setIdModifier($user->getAccountId()->getAccountId());
                    $contactParcoursPro->setDateLastModified(time());
                    $contactParcoursPro->setPersonneConcernee('vous');
                    $contactParcoursPro->setPoste('');
                    $contactParcoursPro->setIntitulePoste('');
                    $contactParcoursPro->setCodeRome('');
                    $contactParcoursPro->setCategorieRome('');
                    $contactParcoursPro->setService('');
                    $contactParcoursPro->setTypeRemuneration('');
                    $contactParcoursPro->setMontantRemuneration('');
                    $contactParcoursPro->setDateDebut(0);
                    $contactParcoursPro->setDateFin(0);
                    $contactParcoursPro->setTypeContrat('');
                    $contactParcoursPro->setTypeContratAide('');
                    $contactParcoursPro->setQualification('');
                    $contactParcoursPro->setTempsTravail('');
                    $contactParcoursPro->setMobilite('');
                    $contactParcoursPro->setSecteurActivite('');
                    $contactParcoursPro->setOrganisme('');
                    $em->persist($contactParcoursPro);
                    $em->flush();

                    #On cherche s'il y a un projet
                    $pr = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwProjet')->findBy(array('idBen' => $c->getIdBen()));
                    if ($pr)
                        $pr = $pr[0];
                    else
                        $pr = new EgwProjet();

                    $pr->setDateFinPrevisionnelle(0);
                    $pr->setDateFinReelle(0);
                    $pr->setIdIntervenants($params['EgwAccounts']['account_id']);
                    $pr->setDateCreation(time());
                    $pr->setIntituleProjet(date('Ym', $d->getCalStart()) . '_CREA_' . $nom . ' ' . $prenom);
                    $pr->setDateDebut($d->getCalStart());
                    $pr->setDateDebutPrevisionnelle($d->getCalStart());
                    $pr->setIdOwner($user->getAccountId()->getAccountId());
                    $pr->setIdBen($c->getIdBen());
                    $pr->setIdModifier($user->getAccountId()->getAccountId());
                    $pr->setDateLastModified(time());
                    $pr->setIdCoordinateur($params['EgwAccounts']['account_id']);
                    $pr->setDescriptionProjet($params['EgwProjet']['description_projet']);
                    #to-do
                    // $pr->setCategorie('Dev');
                    $pr->setCategorie('CREA');
                    $pr->setResultat('En attente de réponse');
                    $pr->setStatut('En cours');

                    $em->persist($pr);
                    $em->flush();
                    unset($pr);

                    $newPr = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwProjet')->lastId();

                    $p = new EgwPrestation();
                    $p->setContactP($contactPr);
                    $p->setIntitule($nom . ' ' . $prenom);
                    
                    //sadel 07/07/2016 - creation date fin à la nouvelle prestation
                    $p->setDateFin($start_time + $params['ImportBen']['dureePresta'] * 86400);
                    $p->setDateEnvoiBilan(0);
                    $p->setDateFacturation(0);
                    $p->setDateFinReelle(0);
                    $p->setNumeroFacturation('');
                    $p->setDateDebut($d->getCalStart());
                    $p->setProjet($newPr);
                    $p->setContact($c);
                    $p->setPrestataire($this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->find($params['Spiclient']['id_prestataire']));
                    $p->setAccount($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->find($params['EgwAccounts']['account_id']));
                    $p->setDispositif($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->find($params['EgwPresta']['dispositif']));
                    $p->setLettreDeCommande($lettreDeCommande);
                    //$p->setDateDebut()
                    $p->setStatut('Nouvelle');
                    $em->persist($p);
                    $em->flush();

                    $newP = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->lastId();
                    $disp = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->find($params['EgwPresta']['dispositif']);
                    $libellePresta = $disp->getNomDispositif();
                    unset($disp);
                    $cal->setIdPresta($newP->getIdPresta());
                    $cal->setCalTitle(date('Ym', $d->getCalStart()) . '_' . $libellePresta . '_' . $nom . ' ' . $prenom.'_'.$lettreDeCommande);
                    
                    //\Doctrine\Common\Util\Debug::dump($cal->getCalId(),2);die();
                    #Joindre le contact et la presta au rdv
                    //  die('test'.$cal->getCalId());
                    $calUser = new EgwCalUser();
                    $calUser->setCalId($cal->getCalId());
                    $calUser->setEgwCalId($cal);
                    $calUser->setCalQuantity(1);
                    $calUser->setCalRecurDate(0);
                    $calUser->setCalRole('REQ-PARTICIPANT');
                    $calUser->setCalStatus('U');
                    $calUser->setCalUserModified(new \Datetime());
                    $calUser->setCalUserId($c->getIdBen());
                    
                    // SPIREA - Ancienne valeur 'c'
                    $calUser->setCalUserType('b');
                    $calUser->setIdPrestation($newP);
                    $em->persist($cal);
                    $em->flush();
                    $em->persist($calUser);
                    $em->flush();

                    // SPIREA - Relation cal/ticket
                    $spidRDV = new SpidRDV();
                    $spidRDV->setTicketId($ticket->getId());
                    $spidRDV->setCalId($cal->getCalId());
                    $spidRDV->setCreationDate(time());
                    $spidRDV->setCreateurId($user->getAccountId()->getAccountId());
                    $spidRDV->setAccountId($params['EgwAccounts']['account_id']);
                    $em->persist($spidRDV);
                    $em->flush();

                    // SPIREA - Lien ticket/cal
                    $link = new EgwLink();
                    $link->setApp1('spid');
                    $link->setId1($ticket->getId());
                    $link->setApp2('calendar');
                    $link->setId2($cal->getCalId());
                    $link->setLastmod(time());
                    $link->setOwner($user->getAccountId()->getAccountId());
                    $em->persist($link);
                    $em->flush();
                    // Fin SPIREA


                    // SPIREA-YLF - Creation d'un tableau pour un retour utilisateur apres l'insertion
                    $row_array = array(
                        $lettreDeCommande,
                        $identifiant,
                        $civilite,
                        $nom,
                        $prenom,
                        $adresse_1,
                        $adresse_2,
                        $cp,
                        $ville,
                        $site,
                        date('d/m/Y', $d->getCalStart()),
                        date('H:i', $d->getCalStart()),
                        date('d/m/Y', $d->getCalEnd()),
                        date('H:i', $d->getCalEnd()),
                        $params_dispo['account_id']
                    );
                    $result[] = $row_array;

                    unset($cal);
                    unset($calUser);
                    unset($c);
                    unset($newP);
                }
                ++$row;
            }
            fclose($handle);
        }

        return array(
            'result' => $result,
        );
    }
	
}
