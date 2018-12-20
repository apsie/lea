<?php

namespace Lea\PrestaBundle\Controller;

use Lea\PrestaBundle\Form\Type\EgwPrestaType;
use Lea\PrestaBundle\Form\Type\EgwDispositifType;
use Lea\PrestaBundle\Form\Type\EgwTypePrestationType;
use Lea\PrestaBundle\Form\Type\EgwCalUserType;
use Lea\PrestaBundle\Form\Type\EgwCategoriesType;
use Lea\PrestaBundle\Form\Type\DisponibiliteType;
use Lea\PrestaBundle\Form\Type\EgwAccountsType;

use Lea\PrestaBundle\Models\Disponibilite;
use Lea\PrestaBundle\Models\Outils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

use Doctrine\Common\Collections\ArrayCollection;

class RdvController extends Controller {

    /**
     *
     * @Template()
     */
    public function poseoptionAction() {
        $request = $this->getRequest();

        $account = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts();
        $formDispo = $this->createForm(new DisponibiliteType());


        $session = $this->container->get('session');
        $u = $session->get('user');
        $formAcc = $this->createForm(new EgwAccountsType(), array('accounts' => $account, 'session_user' => $u));

        $formCat = $this->createForm(new EgwCategoriesType());

        $formPresta = $this->createForm(new EgwPrestaType());
        return array('formAcc' => $formAcc->createView(),
            'formDispo' => $formDispo->createView(),
            'formCat' => $formCat->createView(),
            'formPresta' => $formPresta->createView(),
        );
    }

    /**
     *
     * @Template()
     */
    public function listposeoptionAction() {
        $request = $this->getRequest();
        $params = $request->request->get('disponibilite');
        $EgwCategories = $request->request->get('EgwCategories');
        $EgwPresta = $request->request->get('EgwPresta');
        $EgwAccounts = $request->request->get('EgwAccounts');

        //  print_r($params); die();
        if (!isset($EgwAccounts['account_id'])) {
            $session = $this->container->get('session');
            $u = $session->get('user');
            $EgwAccounts['account_id'] = $u->getAccountId()->getAccountId();
        }
        $params['account_id'] = $EgwAccounts['account_id'];
        $params['idDispositif'] = $EgwPresta['dispositif'];
        $params['catId'] = $EgwCategories['categories'];
        $params['isOption'] = true;
        $params['typeRecherche'] = 1;
        $params['em'] = $this->getDoctrine();

        $dispo = new Disponibilite($params);
        $rdvs = $dispo->get();

        // print_r($rdvs); die();
        $formCat = $this->createForm(new EgwCategoriesType());
        return array('params' => $params,
            'rdvs' => $rdvs,
            'formCat' => $formCat->createView());
    }

    public function optionCheckAction() {
        $request = $this->getRequest();
        $params['accountId'] = $request->request->get('EgwAccounts');
        $params['catId'] = $request->request->get('EgwCategories');

        $params['rdv'] = $request->request->get('rdv');
        $params['disponiblite'] = $request->request->get('disponibilite');
        $EgwPresta = $request->request->get('EgwPresta');



        $em = $this->getDoctrine()->getManager();
        $dispositif = $em->getRepository('LeaPrestaBundle:EgwDispositif')->find($EgwPresta['dispositif']);
        $cat = $em->getRepository('LeaPrestaBundle:EgwCategories')->find($params['catId']['categories']);

        #Pose des rdvs
        foreach ($params['rdv'] as $rdv) {

            $c = explode('_', $cat->getCatName());
            $calTitle = date('Ym', $rdv) . '_' . $dispositif->getNomDispositif() . '_option_' . $c[2];
            // $calTitle =  date('Ym',$rdv-$params['disponiblite']['duree']).'_'.$prestation[0]->getTypeprestation()->getLibelle().$prestation[0]->getTypeprestation()->getZoneGeographique().'_'.$prestation[0]->getIntitule();
            $cal = new EgwCal();
            $cal->setCalCategory($params['catId']['categories']);
            $cal->setCalOwner($params['accountId']['account_id']);
            $cal->setCalModifier($params['accountId']['account_id']);
            $cal->setCalCreator($params['accountId']['account_id']);

            $cal->setCalRecurrence(0);
            $cal->setCalPriority(2);
            $cal->setCalPublic(1);
            $cal->setCalTitle($calTitle);
            $cal->setCalCreated(time());
            $cal->setCalModified(time());
            $cal->setCalUid('calendar');
            $cal->setCalReference(0);

            $cal->setIdPresta('');

            $cal->setRangeStart($rdv);
            $cal->setRangeEnd(($rdv + $params['disponiblite']['duree']));


            $em->persist($cal);
            $em->flush();


            $calId = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->lastId();

            //\Doctrine\Common\Util\Debug::dump($calId->getCalId());die();

            $EgwCalDates = new EgwCalDates();
            $EgwCalDates->setCalId($calId->getCalId());
            $EgwCalDates->setEgwCalId($calId);
            $EgwCalDates->setCalStart($rdv);
            $EgwCalDates->setCalEnd(($rdv + $params['disponiblite']['duree']));
            $em->persist($EgwCalDates);
            $em->flush();

            $egwCalIdUser = new EgwCalUser();
            $egwCalIdUser->setCalId($calId->getCalId());
            $egwCalIdUser->setEgwCalId($calId);
            $egwCalIdUser->setCalRecurDate(0);
            $egwCalIdUser->setCalUserType('u');
            $egwCalIdUser->setCalUserId($params['accountId']['account_id']);
            $egwCalIdUser->setCalStatus('U');
            $egwCalIdUser->setCalQuantity(1);
            $egwCalIdUser->setCalRole('CHAIR');
            $egwCalIdUser->setCalUserModified(new \Datetime());
            $egwCalIdUser->setIdPrestation();

            $em->persist($egwCalIdUser);
            $em->flush();




            unset($cal);
            unset($egwCalIdUser);
            unset($EgwCalDates);
        }


        echo json_encode('Les options ont été posées');
        die();
    }

    /**
     *
     * @Template()
     */
    public function disponibiliteAction() {
        $request = $this->getRequest();
        $idPrestation = $request->request->get('idPrestation');
        $account = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts();
        $formDispo = $this->createForm(new DisponibiliteType());


        $session = $this->container->get('session');
        $u = $session->get('user');
        $formAcc = $this->createForm(new EgwAccountsType(), array('accounts' => $account, 'session_user' => $u));

        return array('formAcc' => $formAcc->createView(),
            'formDispo' => $formDispo->createView(),
            'idPrestation' => $idPrestation);
    }

    /**
     *
     * @Template()
     */
    public function listrdvAction() {
        $request = $this->getRequest();
        $params = $request->request->get('disponibilite');
        $EgwAccounts = $request->request->get('EgwAccounts');
    
        if (!isset($EgwAccounts['account_id'])) {
            $session = $this->container->get('session');
            $u = $session->get('user');
            $EgwAccounts['account_id'] = $u->getAccountId()->getAccountId();
        }
        $params['account_id'] = $EgwAccounts['account_id'];
        $params['em'] = $this->getDoctrine();

        $dispo = new Disponibilite($params);
        $rdvs = $dispo->get();

        $formCat = $this->createForm(new EgwCategoriesType());
        return array('params' => $params,
            'rdvs' => $rdvs,
            'idPrestation' => $params['idPrestation'],
            'formCat' => $formCat->createView());
    }

    /**
     *
     * @Template()
     */
    public function listRdvPrestaAction() {
        $request = $this->getRequest();
        $idPrestation = $request->request->get('idPrestation');
        $idBen = $request->request->get('idBen');

        if ($idPrestation == null && $idBen == null) {
            $nbRdv = $request->request->get('nbRdv');
            $em = $this->getDoctrine()->getManager();
            for ($i = 0; $i < $nbRdv; $i++) {
                $EgwCalUser = $request->request->get('EgwCalUser' . $i);
                $cal = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCalUser')->findBy(array('calUserId' => $EgwCalUser['calUserId'], 'calId' => $EgwCalUser['calId']));
                $cal[0]->setMotifAbsence($EgwCalUser['motifAbsence']);
                $cal[0]->setCalStatus($EgwCalUser['calStatus']);
                $cal[0]->setCalUserModified(new \Datetime());
                $em->persist($cal[0]);
                $em->flush();
            }

            echo json_encode('Les informations sur les rendez-vous ont été modifiées');
            die();
        } else {
            // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
            if($idPrestation){
                $rdvs = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null, null, $idPrestation, 'b');
                $formCalUser = array();

                foreach ($rdvs as $key => $value) {
                    foreach ($value->getEgwCalIdUser() as $key2 => $value2) {
                        // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
                        if ($value2->getCalUserType() == 'b'){
                            $formCalUser[] = $this->createForm(new EgwCalUserType($key), $value2)->createView();
                            $calUserId = $value2->getCalUserId();
                        }
                    }
                }
            }

            // SPIREA-YLF - 07/2018 - Prise en compte des rendez-vous sans prestation
            if($idBen){
                $rdvs = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv($idBen, null, null, 'b', null, true);
                foreach ($rdvs as $key => $value) {
                    foreach ($value->getEgwCalIdUser() as $key2 => $value2) {
                        // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
                        if ($value2->getCalUserType() == 'b'){
                            $formCalUser[] = $this->createForm(new EgwCalUserType($key), $value2)->createView();
                            $calUserId = $value2->getCalUserId();
                        }
                    }
                }
            }

            return array(
                'nbRdv' => count($rdvs),
                'rdvs' => $rdvs,
                'formCalUser' => $formCalUser,
                'idPrestation' => $idPrestation,
                'calUserId' => $calUserId,
                'DIR_PRESTA' => DIR_PRESTA,
            );
        }
    }

    public function rdvCheckAction() {
        $request = $this->getRequest();
        $params['accountId'] = $request->request->get('EgwAccounts');
        $params['catId'] = $request->request->get('EgwCategories');
        $params['rdv'] = $request->request->get('rdv');
        $params['disponiblite'] = $request->request->get('disponibilite');
        $idPrestation = $request->request->get('idPrestation');


        $prestation = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->get(null, null, null, null, $idPrestation);

        $em = $this->getDoctrine()->getManager();
        #Pose des rdvs
        foreach ($params['rdv'] as $rdv) {

            #SI option 2 on ajoute un participants à cal user
            if ($params['disponiblite']['typeRecherche'] == 2) {
                // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
                $calExist = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCalUser')->findBy(array('calId' => $rdv, 'calUserId' => $prestation[0]->getIdBen(), 'calUserType' => 'b'));

                if (count($calExist) == 0) {
                    $egwCalIdUser = new EgwCalUser();
                    $egwCalIdUser->setCalId($rdv);
                    $egwCalIdUser->setEgwCalId($this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->find($rdv));
                    $egwCalIdUser->setCalRecurDate(0);
                    // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
                    $egwCalIdUser->setCalUserType('b');
                    $egwCalIdUser->setCalUserId($prestation[0]->getIdBen());
                    $egwCalIdUser->setCalStatus('U');
                    $egwCalIdUser->setCalQuantity(1);
                    $egwCalIdUser->setCalRole('REQ-PARTICIPANT');
                    $egwCalIdUser->setCalUserModified(new \Datetime());
                    $egwCalIdUser->setIdPrestation($prestation[0]);
                    $em->persist($egwCalIdUser);
                    $em->flush();
                }
            } else {
                $calTitle = date('Ym', $rdv - $params['disponiblite']['duree']) . '_' . $prestation[0]->getDispositif()->getNomDispositif() . '_' . $prestation[0]->getIntitule();
                $cal = new EgwCal();
                $cal->setCalCategory($params['catId']['categories']);
                $cal->setCalOwner($params['accountId']['account_id']);
                $cal->setCalModifier($params['accountId']['account_id']);
                $cal->setCalCreator($params['accountId']['account_id']);

                $cal->setCalRecurrence(0);
                $cal->setCalPriority(2);
                $cal->setCalPublic(1);
                $cal->setCalTitle($calTitle);
                $cal->setCalCreated(time());
                $cal->setCalModified(time());
                $cal->setCalUid('calendar');
                $cal->setCalReference(0);
                $cal->setIdPresta($idPrestation);

                $cal->setRangeStart($rdv);
                $cal->setRangeEnd(($rdv + $params['disponiblite']['duree']));
                
                $em->persist($cal);
                $em->flush();

                $calId = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->lastId();

                $EgwCalDates = new EgwCalDates();
                $EgwCalDates->setCalId($calId->getCalId());
                $EgwCalDates->setEgwCalId($calId);
                $EgwCalDates->setCalStart($rdv);
                $EgwCalDates->setCalEnd(($rdv + $params['disponiblite']['duree']));
                $em->persist($EgwCalDates);
                $em->flush();

                $egwCalIdUser = new EgwCalUser();
                $egwCalIdUser->setCalId($calId->getCalId());
                $egwCalIdUser->setEgwCalId($calId);
                $egwCalIdUser->setCalRecurDate(0);
                $egwCalIdUser->setCalUserType('u');
                $egwCalIdUser->setCalUserId($params['accountId']['account_id']);
                $egwCalIdUser->setCalStatus('U');
                $egwCalIdUser->setCalQuantity(1);
                $egwCalIdUser->setCalRole('CHAIR');
                $egwCalIdUser->setCalUserModified(new \Datetime());
                $egwCalIdUser->setIdPrestation();

                $em->persist($egwCalIdUser);
                $em->flush();

                $egwCalIdUser = new EgwCalUser();
                $egwCalIdUser->setCalId($calId->getCalId());
                $egwCalIdUser->setEgwCalId($calId);
                $egwCalIdUser->setCalRecurDate(0);
                // SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
                $egwCalIdUser->setCalUserType('b');
                $egwCalIdUser->setCalUserId($prestation[0]->getIdBen());
                $egwCalIdUser->setCalStatus('U');
                $egwCalIdUser->setCalQuantity(1);
                $egwCalIdUser->setCalRole('REQ-PARTICIPANT');
                $egwCalIdUser->setCalUserModified(new \Datetime());
                $egwCalIdUser->setIdPrestation($prestation[0]);
                $em->persist($egwCalIdUser);
                $em->flush();


                unset($cal);
                unset($egwCalIdUser);
                unset($EgwCalDates);
            }
        }
        echo json_encode('Les rendez-vous ont été posées');
        die();
    }

    /**
     *
     * @Template()
     */
    public function confirmationAction() {
        $session = $this->container->get('session');
        $user = $session->get('user');

        $params['em'] = $this->getDoctrine();


        $request = $this->getRequest();

        #Option sélectionnée : Confirmation ou sans confirmlation
        $choix =  $request->request->get('choix');
       

        $accountId = $request->request->get('EgwAccounts');
        $params['account_id'] = $accountId['account_id'];
        $dispositif = $request->request->get('EgwPresta');
        $params['idDispositif'] = $dispositif['dispositif'];
        $libelle = null;
        
        if ($params['idDispositif'] != null) {
            $dis = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->find($params['idDispositif']);
            $params['dispositif'] = $dis;
            //\Doctrine\Common\Util\Debug::dump($typePresta);die();
            $libelle = $dis->getNomDispositif();
        }
        if ($params['account_id'] != null) {
            $params['account'] = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwAccounts')->find($params['account_id']);
            
          //\Doctrine\Common\Util\Debug::dump( $params['account']->getAccountId()->getNGiven());die();
        }



        $options = new Disponibilite($params);
        $listOpt = $options->getOptions($libelle);


        $formCat = $this->createForm(new EgwCategoriesType());
        $formDispo = $this->createForm(new DisponibiliteType());
        
        
       
        
        return array('listOpt' => $listOpt,
            'choix' => $choix,
            'params'=> $params,
            'formCat' => $formCat->createView(),
            'formDispo' => $formDispo->createView());
    }

    public function confirmationCheckAction() {
        try {
            $request = $this->getRequest();
            $params['options'] = $request->request->get('options');
            $params['EgwContact'] = $request->request->get('EgwContact');
            $params['EgwAddressbook'] = $request->request->get('EgwAddressbook');
            $params['EgwProjet'] = $request->request->get('EgwProjet');
            $params['EgwPresta'] = $request->request->get('EgwPresta');
            $params['EgwAccounts'] = $request->request->get('EgwAccounts');
            $params['EgwTypePrestation'] = $request->request->get('EgwTypePrestation');
            $params['Spiclient'] = $request->request->get('Spiclient');
            
            $choix = $request->request->get('choix');
            $params['EgwContactParcoursPro'] = $request->request->get('EgwContactParcoursPro');
            $params['EgwCategories'] = $request->request->get('EgwCategories');
            $params['disponibilite'] = $request->request->get('disponibilite');
            

            if(count($params['options']) == 0 && $choix == 1)
            {
               echo json_encode('Aucune option sélectionnée, la prestation n\'a pas été crée!');
               die();
            
            }
                
            $session = $this->container->get('session');
            $user = $session->get('user');
            $em = $this->getDoctrine()->getManager();
            
            # On vérifie que le prescripteur existe
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
            $ticket->setTicketClientOrderId($params['EgwPresta']['lettreDeCommande']);

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

            if($choix == 1)
            {
                $cal = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->find($params['options'][0]);
                $dates = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCalDates')->findBy(array('calId'=>$params['options'][0]));
                $d = $dates[0];
                $message = 'La prestation a été crée et l\'option confirmée';
               // \Doctrine\Common\Util\Debug::dump($d,2);die();
            }
            elseif($choix == 0)
            {
                $tpsStart = Outils::getTmps($params['disponibilite']['dateDebut'].' '.$params['disponibilite']['plageDebut'].':'.$params['disponibilite']['minDebut']); 
                
                $cal =  new EgwCal();
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
                $cal->setCalCategory($params['EgwCategories']['categories']);

                $cal->setRangeStart($tpsStart);
                $cal->setRangeEnd(($tpsStart + $params['disponibilite']['duree']));

                $em->persist($cal);
                $em->flush();
               
                $d = new EgwCalDates();
                $d->setCalId($cal->getCalId());
                $d->setEgwCalId($cal);
              // print_r($params); die();
                $d->setCalStart($tpsStart);
                $d->setCalEnd(($tpsStart + $params['disponibilite']['duree']));
                $em->persist($d);
                $em->flush();
            
                $calU = new EgwCalUser();
                $calU->setCalId($cal->getCalId());
                $calU->setEgwCalId($cal);
                $calU->setCalQuantity(1);
                $calU->setCalRecurDate(0);
                $calU->setCalRole('CHAIR');
                $calU->setCalStatus('U');
                $calU->setCalUserModified(new \Datetime());
                $calU->setCalUserId($params['EgwAccounts']['account_id']);
                $calU->setCalUserType('u');
                $em->persist($calU);
                $em->flush();
               
                $message = 'La prestation a été crée et le premier rendez-vous posé.';
            }
            
            $cal->setCalModifier($user->getAccountId()->getAccountId());
            $cal->setCalModified(time());
           
            // SPIREA
            $date = $d->getCalStart();
            $ticket->setTicketTitle(date('Ym',$date).'_'.$dispositif->getNomDispositif().'_'.$params['EgwContact']['nom'].'_'.$params['EgwContact']['prenom'].'_'.$params['EgwPresta']['lettreDeCommande']);

            $em->persist($ticket);
            $em->flush();
            // FIN SPIREA

            # Vérification si le contact existe déja
            if ($params['EgwContact']['idBen'] != null)
                $c = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->find($params['EgwContact']['idBen']);
            else
                $c = null;

            if ($c == true && $c != null) {
                //$c = $c[0];
                $c->setIdModifier($user->getAccountId()->getAccountId());
                $c->setDateLastModified(time());
                $c->setNom($params['EgwContact']['nom']);
                $c->setPreNom($params['EgwContact']['prenom']);
                $c->setNomJeuneFille($params['EgwContact']['nomJeuneFille']);
                $c->setDeuxiemePrenom($params['EgwContact']['deuxiemePrenom']);
                $c->setCivilite($params['EgwContact']['civilite']);
                $c->setNomComplet($params['EgwContact']['civilite'] . ' ' . $params['EgwContact']['prenom'] . ' ' . $params['EgwContact']['nom']);
                $c->setPortablePerso($params['EgwContact']['portablePerso']);
                $c->setTelDomicile1($params['EgwContact']['telDomicile1']);
                // $c->setTelDomicile2($params['EgwContact']['telDomicile2']);
                $c->setEmailPerso($params['EgwContact']['emailPerso']);
                $c->setEmailPro($params['EgwContact']['emailPro']);
            } else {
                $c = new EgwContact();
                #to-do
                $cat = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCategories')->findBy(array('catName' => 'Usager_' . date('y')));

                if ($cat)
                    $catId = $cat[0]->getCatId();
                else {
                    $ca = new EgwCategories();
                    $ca->setCatMain(259);
                    $ca->setCatParent(259);
                    $ca->setCatLevel(1);
                    $ca->setCatOwner(5);
                    $ca->setCatAccess('public');
                    $ca->setCatAppname('addressbook');
                    $ca->setCatDescription('Catégorie crée automatiquement par prestav3');
                    $ca->setCatName('Usager_' . date('y'));
                    $ca->setLastMod(time());
                    $em->persist($ca);
                    $em->flush();

                    $cat = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCategories')->findBy(array('catName' => 'Usager_' . date('y')));
                    $catId = $cat[0]->getCatId();
                }

                $c->setCatId($catId);
                $c->setIdOwner($user->getAccountId()->getAccountId());
                $c->setDateCreation(time());
                $c->setIdModifier($user->getAccountId()->getAccountId());
                $c->setDateLastModified(time());
                $c->setNom($params['EgwContact']['nom']);
                $c->setPreNom($params['EgwContact']['prenom']);
                $c->setNomJeuneFille('');
                $c->setDeuxiemePrenom('');
                $c->setCivilite($params['EgwContact']['civilite']);
                $c->setNomComplet($params['EgwContact']['civilite'] . ' ' . $params['EgwContact']['prenom'] . ' ' . $params['EgwContact']['nom']);
                $c->setPortablePerso('');
                $c->setTelDomicile1('');
                $c->setTelDomicile2('');
                $c->setEmailPerso('');
                $c->setEmailPro('');
                $c->setIdOrganisation('');
                $c->setOrganisation('');
                $c->setService('');
                $c->setFonction('');
                $c->setAdresseLigne1('');
                $c->setAdresseLigne2('');
                $c->setAdresseLigne3('');
                $c->setVille('');
                $c->setRegion('');
                $c->setCp('');
                $c->setPays('');
                $c->setTelPro1('');
                $c->setTelPro2('');
                $c->setFaxPro('');
                $c->setFaxPerso('');
                $c->setPortablePro('');
                $c->setSitePerso('');
            }

            $em->persist($c);
            $em->flush();

            if (!is_numeric($c->getIdBen()))
                $c = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContact')->lastId();

            # Parcours Pro
            $contactParcoursPro = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwContactParcoursPro')->findBy(array('idBen' => $c->getIdBen(), 'statut' => $params['EgwContactParcoursPro']['statut']));

            if ($contactParcoursPro) {

                $contactParcoursPro = $contactParcoursPro[0];
            }
            else
                $contactParcoursPro = new EgwContactParcoursPro();

            $contactParcoursPro->setStatut($params['EgwContactParcoursPro']['statut']);
            $contactParcoursPro->setIdentifiant($params['EgwContactParcoursPro']['identifiant']);

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
            $pr->setIntituleProjet(date('Ym', $d->getCalStart()) . '_CREA_' . $params['EgwContact']['nom'] . ' ' . $params['EgwContact']['prenom']);
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
            $p->setIntitule($params['EgwContact']['nom'] . ' ' . $params['EgwContact']['prenom']);
            
			//sadel 07/07/2016 //creation date fin à la nouvelle prestation
	        $p->setDateFin(Outils::getTmps($params['EgwPresta']['dateFin'] . ' 00:00'));
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
            $p->setLettreDeCommande($params['EgwPresta']['lettreDeCommande']);
            //$p->setDateDebut()
            $p->setStatut('Nouvelle');
            $em->persist($p);
            $em->flush();


            $newP = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->lastId();
            $disp = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwDispositif')->find($params['EgwPresta']['dispositif']);
            $libellePresta = $disp->getNomDispositif();
            unset($disp);
            $cal->setIdPresta($newP->getIdPresta());
            $cal->setCalTitle(date('Ym', $d->getCalStart()) . '_' . $libellePresta . '_' . $params['EgwContact']['nom'] . ' ' . $params['EgwContact']['prenom'].'_'.$params['EgwPresta']['lettreDeCommande']);
            $cal->setCalSite('0');
            
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

            unset($cal);
            unset($calUser);
            unset($c);
            unset($newP);
            echo json_encode($message);
            die();
        }catch (Exception $e) {
            throw $e;
        }
    }

}
