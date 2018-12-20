<?php

namespace Lea\PrestaBundle\Controller;
use Lea\PrestaBundle\Models\Download;

use Lea\PrestaBundle\Models\Outils;

use Lea\PrestaBundle\Models\Arr;

use Lea\PrestaBundle\Models\Texte;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use lea_app\Symfony\vendor\doctrine\common\lib\Doctrine\Common\Util\Debug;
use Doctrine\Common\Util\Debug;
//use data/html/egw_apsie18/lea_app/Symfony/vendor/doctrine/common/lib/Doctrine/Common/Util/Debug


ini_set('error_reporting', E_ALL & ~E_NOTICE);
class DownloadController extends Controller 
{
 
	public $prestaData = array();
	public $prestaEntity; 
	public $id_presta;
	public $annexe;
	
	private function common()
	{
		#Récupération du contact
		$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
		//echo '<pre>'.print_r($p, true).'</pre>';exit;
		//Debug::dump($p);exit;
		//var_dump($p);
		$this->prestaEntity = $p;
		//$contact = contact::get_contactv2(null,$_GET['id_presta']);
		#Récupération de la data du projet
		//$projet = projet::getProjetByPresta($_GET['id_presta']);

		#Récupération de la data en fonction de la presta
		$prestaData = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestaData')->findBy(array('idPresta'=>$this->id_presta));
		$presta = Arr::convertDataPresta($prestaData);
		$this->prestaData = $presta;

		//$prestation = prestation::getPrestationByIdPresta($_GET['id_presta']);
		//print_r($prestation);die();
		#data de remplacement
		$params["Nom"] = $p->getContact()->getNom();
		$params["prenom"] = $p->getContact()->getPrenom();
		$parcours = $p->getContact()->getContactParcoursPro();
		
		
		//Debug::dump($parcours);exit;
		
		
		
		foreach ($parcours as $key => $value) {
			
			//if($value->getStatut() == "DE")
			$params["ID"] = $value->getIdentifiant();
		}
		
		
		$params["adresse"] = $p->getContact()->getAdresseLigne1();
		$params["cp"] = $p->getContact()->getCp();
		$params["Ville"] = $p->getContact()->getVille();
		$params["tel_ben"]  = Texte::getTelV2($p->getContact());
		$params["email_ben"]  = Texte::getEmail($p->getContact());

		#organisme
		// $params['nom_organisme'] = $p->getPrestataire()->getNom();
		// $params['adresse_organisme'] = $p->getPrestataire()->getAdresse();
		// $params['tel_organisme'] = $p->getPrestataire()->getTel();
		// $params['email_organisme'] = $p->getPrestataire()->getEmail();
		// $params['siret'] = $p->getPrestataire()->getSiret();
		// $params["code_organisme"]  = $p->getPrestataire()->getCp();
		// $params["country_organisme"]  = $p->getPrestataire()->getVille();
		// $params["ville_organisme"]  = $p->getPrestataire()->getVille();
		
		# Modification SPIREA-YLF / 29/10/13
		$params['nom_organisme'] = $p->getPrestataire()->getNomOrganisme();
		$params['adresse_organisme'] = $p->getPrestataire()->getAdresseLigne1();
		$params['tel_organisme'] = $p->getPrestataire()->getTel();
		$params['fax_organisme'] = $p->getPrestataire()->getFax();
		$params['email_organisme'] = $p->getPrestataire()->getEmail();
		$params['siret'] = $p->getPrestataire()->getSiret();
		$params["code_organisme"]  = $p->getPrestataire()->getCp();
		$params["country_organisme"]  = $p->getPrestataire()->getVille();
		$params["ville_organisme"]  = $p->getPrestataire()->getVille();
		
		#referent
		$params["civilite_ref"]  = $p->getAccount()->getAccountId()->getnPrefix();
		$params["Nom_ref"]  = $p->getAccount()->getAccountId()->getNfamily();
		//var_dump($p->getAccount()->getAccountId());  exit;     
		$params["prenom_ref"]  = $p->getAccount()->getAccountId()->getNGiven();
		$params["email_ref"]  = $p->getAccount()->getAccountId()->getContactEmail();
		$params["tel_ref"]  = $p->getPrestataire()->getTel();
		$params["site"]  = $p->getPrestataire()->getVille();
		//$params["tel_ref"]  = Texte::getTelV3($p->getAccount()->getAccountId());
		//$params["site"]  = $p->getAccount()->getAccountId()->getAdrOneStreet();
		
//print_r("--------------------------------".$p->getDateFin()."++++++++++++++++++++++++++++++");exit;
		$params["L"]  = $p->getLettreDeCommande();
		list($d,$m,$y) = explode('/',$p->getDateDebut());
		$params["db"]  = $d.$m.substr($y, 2,2);
		list($df,$mf,$yf) = explode('/',$p->getDateFin());
		$params["fi"]  = $df.$mf.substr($yf, 2,2);
		
		//list($d,$m,$y) = explode('/',$p->getdateLastModified());
		//$params["da"] = $d.$m.substr($y, 2,2);
		
		$params["N"]  = $p->getDispositif()->getNumeroMarche();
		$params["lot"]  = $p->getDispositif()->getNumeroLot();

		
		
		#organisme prescripteur
		# Modification SPIREA-YLF / 29/10/13
		// $params["N_p"]  = $p->getContactP()->getNom();
		// $params["p_p"]  = $p->getContactP()->getPreNom();
		$params["N_p"]  = $p->getContactP()->getNFamily();
		$params["p_p"]  = $p->getContactP()->getNGiven();
		
		# Modification Spirea-YLF
		// $ids = explode(',',$p->getContactP()->getIdOrganisation());
		// $org = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->find($ids[0]);
		// if($org)
		// 	$params["pole_emploi"]  = $org->getNomOrganisme();
		// else
		// 	$params["pole_emploi"] ="";
		
		// Connexion a la base
		$link_db = mysqli_connect('localhost', 'egw_apsie', 'APS12/APS12') or die("Impossible de se connecter au serveur \n");
		// $link_db = mysql_connect('localhost', 'root', 'spirea237Apsie') or die("Impossible de se connecter au serveur \n");

		mysqli_select_db($link_db,'egw_apsie143')or die("Impossible de se connecter à la base \t".mysql_error($link_db)."\n");

		$sql = "SELECT spiclient.* FROM spiclient INNER JOIN spid_tickets ON spid_tickets.client_id = spiclient.client_id INNER JOIN egw_prestation ON spid_tickets.ticket_client_order_id = egw_prestation.lettre_de_commande WHERE egw_prestation.id_presta=".$p->getIdPresta();
		$result = mysqli_query($link_db,$sql);
		 //var_dump($result); exit;
		 
		
		while (($row = mysqli_fetch_array($result, MYSQL_ASSOC))) {
			
			 if($params["pole_emploi"])
		  
		  $params["pole_emploi"]  = $row['client_code_agency'].' - '.$row['client_company'];
			
			else
			$params["pole_emploi"]  = $row['client_company'];
				
			//$params["pole_emploi"]  = $row['client_code_agency'].' - '.$row['client_company'];
			$params["pole_adresse"]  = $row['client_adr_one_street'];
			$params["pole_ville"]  = $row['client_locality'];
			$params["pole_cp"]  = $row['client_postalcode'];
			$telPole  = $row['client_tel'];
			$params["pole_email"]  = $row['client_email'];
		}
		
		
		
		# Modification SPIREA-YLF / 29/10/13
		// if($p->getContactP()->getTelWork()!= null)
		// $telPole =$p->getContactP()->getTelWork();
		// elseif($org)
		//$telPole = 3949;
        
		/*elseif($org)
		$telPole = $org->getTel();
		else
		$telPole ="";*/
		
		# Modification SPIREA-YLF / 29/10/13
		if($p->getContactP()->getContactEmail()!= null)
			$emailPole =$p->getContactP()->getContactEmail();
		elseif($org)
			$emailPole = $org->getEmail();
		else
			$emailPole ="";
		
		$params["tel_pole"]  = $telPole;
		$params["email_pole"]  = $emailPole;

		#date
		$params['da'] = date('d/m/y');
		
		$params['da1'] = date('d/m/y');

		
		#Abandon
		$params['Abandon']= $presta['abandon'];
		$params['Motif']= $presta['motif_abandon'];
		
		list($d_,$m_,$y_) = explode('/',$presta['date_abandon']);
		$params["ab"]  = $d_.$m_.substr($y_, 2,2);
		
		
		return $params;
	}

	public function opcreAction($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();
		//var_dump($params);exit;
		$download = new Download();
		if($annexe==1){
			$params["D_p"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["E_a_p"] = $this->prestaData['etat_avancement_projet'];
			$params['P_e_p_1'] = $this->prestaData['point_evaluer_priorite_1'];
			$params['p_e_p_2'] = $this->prestaData['point_evaluer_priorite_2'];
			$params['p_e_p_3'] = $this->prestaData['point_evaluer_priorite_3'];
			$params['A_b_1'] = $this->prestaData['attente_beneficiaire_1'];
			$params['a_b_2'] = $this->prestaData['attente_beneficiaire_2'];
			$params['a_b_3'] = $this->prestaData['attente_beneficiaire_3'];
			$params['Com'] = $this->prestaData['commentaire_1'];

			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/opcrea/annexe_1.rtf",$params);
		}elseif($annexe==2){
			#rdv
			$params['dx']="";
			for($i=1;$i<=10;$i++):
			$params['d'.$i]="";
			endfor;

			$rdv = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null,null,$id_presta);
			$params['RDV'] = count($rdv);
			$i = 1;
			foreach ($rdv as $key => $val):
			
			if($i==10)
			$params['dx']= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			else
			$params['d'.($i)]= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			
			$i++;
			endforeach;
			
			# Modification Apsie /sadel /2015
			$params['projet']= $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params['formation_1'] = $this->prestaData['formation_1'];
			$params['formation_2'] = $this->prestaData['formation_2'];
			$params['formation_3'] = $this->prestaData['formation_3'];
			$params['formation_4'] = $this->prestaData['formation_4'];
			$params['capacite_1'] = $this->prestaData['capacite_emploi_1'];
			$params['capacite_2'] = $this->prestaData['capacite_emploi_2'];
			$params['capacite_3'] = $this->prestaData['capacite_emploi_3'];
			$params['capacite_4'] = $this->prestaData['capacite_emploi_4'];
			$params['competence_pro_1'] = $this->prestaData['competence_pro_1'];
			$params['competence_pro_2'] = $this->prestaData['competence_pro_2'];
			$params['competence_pro_3'] = $this->prestaData['competence_pro_3'];
			$params['competence_pro_4'] = $this->prestaData['competence_pro_4'];
			$params['element_porteur_1'] = $this->prestaData['element_porteur_1'];
			$params['element_porteur_2'] = $this->prestaData['element_porteur_2'];
			$params['element_porteur_3'] = $this->prestaData['element_porteur_3'];
			$params['element_porteur_4'] = $this->prestaData['element_porteur_4'];
			$params['point_vigilance_1'] = $this->prestaData['point_vigilance_1'];
			$params['point_vigilance_2'] = $this->prestaData['point_vigilance_2'];
			$params['point_vigilance_3'] = $this->prestaData['point_vigilance_3'];
			$params['point_vigilance_4'] = $this->prestaData['point_vigilance_4'];
			$params['formation_courte_1'] = $this->prestaData['formation_courte_1'];
			$params['formation_courte_2'] = $this->prestaData['formation_courte_2'];
			$params['formation_courte_3'] = $this->prestaData['formation_courte_3'];
			$params['formation_courte_4'] = $this->prestaData['formation_courte_4'];
			$params['competence_1'] = $this->prestaData['competence_1'];
			$params['competence_2'] = $this->prestaData['competence_2'];
			$params['competence_3'] = $this->prestaData['competence_3'];
			$params['competence_4'] = $this->prestaData['competence_4'];
			$params['delai_priorite_1'] = $this->prestaData['delai_priorite_1'];
			$params['delai_priorite_2'] = $this->prestaData['delai_priorite_2'];
			$params['delai_priorite_3'] = $this->prestaData['delai_priorite_3'];
			$params['delai_priorite_4'] = $this->prestaData['delai_priorite_4'];

			$params['commentaire_adequation'] = $this->prestaData['commentaire_adequation'];
			$params['points_forts_clients_1'] = $this->prestaData['points_forts_clients_1'];
			$params['points_forts_clients_2'] = $this->prestaData['points_forts_clients_2'];
			$params['points_forts_clients_3'] = $this->prestaData['points_forts_clients_3'];
			$params['points_forts_clients_4'] = $this->prestaData['points_forts_clients_4'];
			$params['points_faibles_clients_1'] = $this->prestaData['points_faibles_clients_1'];
			$params['points_faibles_clients_2'] = $this->prestaData['points_faibles_clients_2'];
			$params['points_faibles_clients_3'] = $this->prestaData['points_faibles_clients_3'];
			$params['points_faibles_clients_4'] = $this->prestaData['points_faibles_clients_4'];
			$params['points_forts_concurrence_1'] = $this->prestaData['points_forts_concurrence_1'];
			$params['points_forts_concurrence_2'] = $this->prestaData['points_forts_concurrence_2'];
			$params['points_forts_concurrence_3'] = $this->prestaData['points_forts_concurrence_3'];
			$params['points_forts_concurrence_4'] = $this->prestaData['points_forts_concurrence_4'];
			$params['points_faibles_concurrence_1'] = $this->prestaData['points_faibles_concurrence_1'];
			$params['points_faibles_concurrence_2'] = $this->prestaData['points_faibles_concurrence_2'];
			$params['points_faibles_concurrence_3'] = $this->prestaData['points_faibles_concurrence_3'];
			$params['points_faibles_concurrence_4'] = $this->prestaData['points_faibles_concurrence_4'];
			$params['points_forts_strategie_1'] = $this->prestaData['points_forts_strategie_1'];
			$params['points_forts_strategie_2'] = $this->prestaData['points_forts_strategie_2'];
			$params['points_forts_strategie_3'] = $this->prestaData['points_forts_strategie_3'];
			$params['points_forts_strategie_4'] = $this->prestaData['points_forts_strategie_4'];
			$params['points_faibles_strategie_1'] = $this->prestaData['points_faibles_strategie_1'];
			$params['points_faibles_strategie_2'] = $this->prestaData['points_faibles_strategie_2'];
			$params['points_faibles_strategie_3'] = $this->prestaData['points_faibles_strategie_3'];
			$params['points_faibles_strategie_4'] = $this->prestaData['points_faibles_strategie_4'];
			
			
			$params['points_forts_concurrence_au_1'] = $this->prestaData['points_forts_concurrence_au_1'];
			$params['points_forts_concurrence_au_2'] = $this->prestaData['points_forts_concurrence_au_2'];
			$params['points_forts_concurrence_au_3'] = $this->prestaData['points_forts_concurrence_au_3'];
			$params['points_forts_concurrence_au_4'] = $this->prestaData['points_forts_concurrence_au_4'];
			$params['points_faibles_concurrence_au_1'] = $this->prestaData['points_faibles_concurrence_au_1'];
			$params['points_faibles_concurrence_au_2'] = $this->prestaData['points_faibles_concurrence_au_2'];
			$params['points_faibles_concurrence_au_3'] = $this->prestaData['points_faibles_concurrence_au_3'];
			$params['points_faibles_concurrence_au_4'] = $this->prestaData['points_faibles_concurrence_au_4'];
			
			
			
			
			
			$params['com_marche'] = $this->prestaData['commentaire_etude_marche'];
			$params['etude_marche_dp1'] = $this->prestaData['etude_marche_delais_priorite_1'];
			$params['etude_marche_dp2'] = $this->prestaData['etude_marche_delais_priorite_2'];
			$params['etude_marche_dp3'] = $this->prestaData['etude_marche_delais_priorite_3'];
			$params['etude_marche_dp4'] = $this->prestaData['etude_marche_delais_priorite_4'];
			$params['etude_marche_Action_1'] = $this->prestaData['etude_marche_Action_1'];
			$params['etude_marche_Action_2'] = $this->prestaData['etude_marche_Action_2'];
			$params['etude_marche_Action_3'] = $this->prestaData['etude_marche_Action_3'];
			$params['etude_marche_Action_4'] = $this->prestaData['etude_marche_Action_4'];
			$params['etude_marche_resultat_attendu_1'] = $this->prestaData['etude_marche_resultat_attendu_1'];
			$params['etude_marche_resultat_attendu_2'] = $this->prestaData['etude_marche_resultat_attendu_2'];
			$params['etude_marche_resultat_attendu_3'] = $this->prestaData['etude_marche_resultat_attendu_3'];
			$params['etude_marche_resultat_attendu_4'] = $this->prestaData['etude_marche_resultat_attendu_4'];
			$params['fi_pt_forts_1'] = $this->prestaData['fi_pt_forts_1'];
			$params['fi_pt_forts_2'] = $this->prestaData['fi_pt_forts_2'];
			$params['fi_pt_forts_3'] = $this->prestaData['fi_pt_forts_3'];
			$params['fi_pt_forts_4'] = $this->prestaData['fi_pt_forts_4'];
			$params['fi_pt_faibles_1'] = $this->prestaData['fi_pt_faibles_1'];
			$params['fi_pt_faibles_2'] = $this->prestaData['fi_pt_faibles_2'];
			$params['fi_pt_faibles_3'] = $this->prestaData['fi_pt_faibles_3'];
			$params['fi_pt_faibles_4'] = $this->prestaData['fi_pt_faibles_4'];
			$params['fi_pt_forts_mort_1'] = $this->prestaData['fi_pt_forts_mort_1'];
			$params['fi_pt_forts_mort_2'] = $this->prestaData['fi_pt_forts_mort_2'];
			$params['fi_pt_forts_mort_3'] = $this->prestaData['fi_pt_forts_mort_3'];
			$params['fi_pt_forts_mort_4'] = $this->prestaData['fi_pt_forts_mort_4'];
			$params['fai_mort_1'] = $this->prestaData['fi_pt_faibles_mort_1'];
			$params['fai_mort_2'] = $this->prestaData['fi_pt_faibles_mort_2'];
			$params['fai_mort_3'] = $this->prestaData['fi_pt_faibles_mort_3'];
			$params['fai_mort_4'] = $this->prestaData['fi_pt_faibles_mort_4'];
			$params['fi_pt_forts_pfi_1'] = $this->prestaData['fi_pt_forts_pfi_1'];
			$params['fi_pt_forts_pfi_2'] = $this->prestaData['fi_pt_forts_pfi_2'];
			$params['fi_pt_forts_pfi_3'] = $this->prestaData['fi_pt_forts_pfi_3'];
			$params['fi_pt_forts_pfi_4'] = $this->prestaData['fi_pt_forts_pfi_4'];
			$params['fi_pt_faibles_pfi_1'] = $this->prestaData['fi_pt_faibles_pfi_1'];
			$params['fi_pt_faibles_pfi_2'] = $this->prestaData['fi_pt_faibles_pfi_2'];
			$params['fi_pt_faibles_pfi_3'] = $this->prestaData['fi_pt_faibles_pfi_3'];
			$params['fi_pt_faibles_pfi_4'] = $this->prestaData['fi_pt_faibles_pfi_4'];
			$params['pf3_1'] = $this->prestaData['fi_pt_forts_pf3_1'];
			$params['pf3_2'] = $this->prestaData['fi_pt_forts_pf3_2'];
			$params['pf3_3'] = $this->prestaData['fi_pt_forts_pf3_3'];
			$params['pf3_4'] = $this->prestaData['fi_pt_forts_pf3_4'];
			$params['fi_pt_faibles_pf3_1'] = $this->prestaData['fi_pt_faibles_pf3_1'];
			$params['fi_pt_faibles_pf3_2'] = $this->prestaData['fi_pt_faibles_pf3_2'];
			$params['fi_pt_faibles_pf3_3'] = $this->prestaData['fi_pt_faibles_pf3_3'];
			$params['fi_pt_faibles_pf3_4'] = $this->prestaData['fi_pt_faibles_pf3_4'];
			$params['fi_delais_priorite_1'] = $this->prestaData['fi_delais_priorite_1'];
			$params['fi_delais_priorite_2'] = $this->prestaData['fi_delais_priorite_2'];
			$params['fi_delais_priorite_3'] = $this->prestaData['fi_delais_priorite_3'];
			$params['fi_delais_priorite_4'] = $this->prestaData['fi_delais_priorite_4'];
			$params['fi_Action_1'] = $this->prestaData['fi_Action_1'];
			$params['fi_Action_2'] = $this->prestaData['fi_Action_2'];
			$params['fi_Action_3'] = $this->prestaData['fi_Action_3'];
			$params['fi_Action_4'] = $this->prestaData['fi_Action_4'];
			$params['fi_resultat_attendu_1'] = $this->prestaData['fi_resultat_attendu_1'];
			$params['fi_resultat_attendu_2'] = $this->prestaData['fi_resultat_attendu_2'];
			$params['fi_resultat_attendu_3'] = $this->prestaData['fi_resultat_attendu_3'];
			$params['fi_resultat_attendu_4'] = $this->prestaData['fi_resultat_attendu_4'];
			$params['commentaire_fi'] = $this->prestaData['commentaire_pt_fi'];
			$params['sj_pt_forts_1'] = $this->prestaData['sj_pt_forts_juridique_1'];
			$params['sj_pt_forts_2'] = $this->prestaData['sj_pt_forts_juridique_2'];
			$params['sj_pt_forts_3'] = $this->prestaData['sj_pt_forts_juridique_3'];
			$params['sj_pt_forts_4'] = $this->prestaData['sj_pt_forts_juridique_4'];
			$params['sj_pt_faibles_1'] = $this->prestaData['sj_pt_faibles_juridique_1'];
			$params['sj_pt_faibles_2'] = $this->prestaData['sj_pt_faibles_juridique_2'];
			$params['sj_pt_faibles_3'] = $this->prestaData['sj_pt_faibles_juridique_3'];
			$params['sj_pt_faibles_4'] = $this->prestaData['sj_pt_faibles_juridique_4'];
			$params['sj_Action_1'] = $this->prestaData['sj_Action_1'];
			$params['sj_Action_2'] = $this->prestaData['sj_Action_2'];
			$params['sj_Action_3'] = $this->prestaData['sj_Action_3'];
			$params['sj_Action_4'] = $this->prestaData['sj_Action_4'];
			$params['sj_resultat_attendu_1'] = $this->prestaData['sj_resultat_attendu_1'];
			$params['sj_resultat_attendu_2'] = $this->prestaData['sj_resultat_attendu_2'];
			$params['sj_resultat_attendu_3'] = $this->prestaData['sj_resultat_attendu_3'];
			$params['sj_resultat_attendu_4'] = $this->prestaData['sj_resultat_attendu_4'];
			$params['sj_delais_priorite_1'] = $this->prestaData['sj_delais_priorite_1'];
			$params['sj_delais_priorite_2'] = $this->prestaData['sj_delais_priorite_2'];
			$params['sj_delais_priorite_3'] = $this->prestaData['sj_delais_priorite_3'];
			$params['sj_delais_priorite_4'] = $this->prestaData['sj_delais_priorite_4'];
			$params['commentaire_ju'] = $this->prestaData['commentaire_sj'];


				//$params['p_r'] = "Oui";



			/*	if($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==1 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 211;
				}
				elseif($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==1 && $this->prestaData['com_solution']==null)
				{
					$ex  = 210;
				}
				elseif($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==2 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 221;
				}
				elseif($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==2 && $this->prestaData['com_solution']!==null)
				{
					$ex  = 220;
				}

				elseif($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==3 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 231;
				}
				elseif($this->prestaData['faisabilite']==2 && $this->prestaData['estimation']==3 && $this->prestaData['com_solution']==null)
				{
					$ex  = 230;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==1 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 311;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==1 && $this->prestaData['com_solution']==null)
				{
					$ex  = 310;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==2 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 321;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==2 && $this->prestaData['com_solution']==null)
				{
					$ex  = 320;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==3 && $this->prestaData['com_solution']!=null)
				{
					$ex  = 331;
				}
				elseif($this->prestaData['faisabilite']==3 && $this->prestaData['estimation']==3 && $this->prestaData['com_solution']==null)
				{
					$ex  = 330;
				}
				else
				{
					$ex = 1;
				}*/
			# Modification Apsie /sadel /2015
			$params['com_estimation_cp'] = $this->prestaData['com_estimation_cp'];	
				
			$params['fi_pt_forts_pfi_au_1'] = $this->prestaData['fi_pt_forts_pfi_au_1'];
			$params['fi_pt_forts_pfi_au_2'] = $this->prestaData['fi_pt_forts_pfi_au_2'];
			$params['fi_pt_forts_pfi_au_3'] = $this->prestaData['fi_pt_forts_pfi_au_3'];
			$params['fi_pt_forts_pfi_au_4'] = $this->prestaData['fi_pt_forts_pfi_au_4'];
			$params['fi_pt_faibles_pfi_au_1'] = $this->prestaData['fi_pt_faibles_pfi_au_1'];
			$params['fi_pt_faibles_pfi_au_2'] = $this->prestaData['fi_pt_faibles_pfi_au_2'];
			$params['fi_pt_faibles_pfi_au_3'] = $this->prestaData['fi_pt_faibles_pfi_au_3'];
			$params['fi_pt_faibles_pfi_au_4'] = $this->prestaData['fi_pt_faibles_pfi_au_4'];
				
				
				
				
			$params['commentaire_faisabilite'] = $this->prestaData['com_faisabilite'];
			$params['commentaire_estimation'] = $this->prestaData['com_estimation'];
			$params['com_solution'] = $this->prestaData['com_solution'];
			$params['b_com_ref'] = $this->prestaData['bilan_com_referent'];
			$params['b_beneficiaire'] = $this->prestaData['bilan_com_beneficiaire'];

			$params['Solution_alt']="  ";
			$params['P_oui'] = '  ';
			$params['P_non'] = '  ';
			if($this->prestaData['com_solution']!=null)
			$params['Solution_alt'] = 'X';
			
			if($this->prestaData['faisabilite']==2 || $this->prestaData['faisabilite']==3)
			{
			$params['P_oui'] = 'X';
			$params['P_non'] = '  ';
			}
			elseif($this->prestaData['faisabilite']==1)
			{
			$params['P_oui'] = '  ';
			$params['P_non'] = 'X';
			}
			
			$params['fai_negatif'] = '  ';
			$params['fai_positif_reserve'] = '  ';
			$params['fai_positif'] = '  ';
			$params['estimation_un'] = '  ';
			$params['estimation_six'] = '  ';
			$params['estimation_trois'] = '  ';
			if($this->prestaData['faisabilite']==1)
			$params['fai_negatif'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['fai_positif_reserve'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['fai_positif'] = 'X';
			
			
			if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['estimation']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['estimation']==3)
			$params['estimation_trois'] = 'X';
			
			
			
			
			
			
			/*if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['estimation_trois'] = 'X';*/
				
				
			


			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPreNom());
			$download->get(getcwd()."/bundles/lea/doc/opcrea/annexe_2.rtf",$params);
			//$download->get("./doc/opcrea/annexe_2_.rtf",$params);
		}
		die();
		
	}

	public function oeAction($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();
		
		
		
		$download = new Download();

		
		

			$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
			if($annexe==1)
			{
				
				$download->setTitle($nomPresta."_annexe_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
				$download->get(getcwd()."/bundles/lea/doc/oe/annexe_1.rtf",$params);
			}
			elseif($annexe==2)
			{


				if($this->prestaData['suivi']==1)
				$params['1'] = "X";
				else
				$params['1'] = " ";

				if($this->prestaData['suivi']==2)
				$params['2'] = "X";
				else
				$params['2'] = " ";

				if($this->prestaData['suivi']==3)
				$params['3'] = "X";
				else
				$params['3'] = " ";

				if($this->prestaData['suivi']==4)
				$params['4'] = "X";
				else
				$params['4'] = " ";

				//Rdv
		
				$dataRdv = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null,null,$id_presta);

				for($i=0;$i<=11;$i++):
				$params['date_rdv_'.$i] = "";
				$params['rdv_ab_'.$i] = "";
				$params['R'.$i] = "  ";
				$params['I'.$i] = "  ";
				endfor;

				foreach ($dataRdv as $key => $row):
					$params['date_rdv_'.$key] = date('dmy',$row->getEgwCalIdDates()->getCalStart());
				
				foreach ($row->getEgwCalIdUser() as $key2 => $value2) {
		    		$params['rdv_ab_'.$key] = $value2->getMotifAbsence();
		    	}
				// SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
				$part = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getNbParticipants($row->getCalId(),'b');
				if($part['nb']>1)
				{
					$params['R'.$key] = 'X';
					$params['I'.$key] = '  ';
				}
				else
				{
					$params['R'.$key] = '  ';
					$params['I'.$key] = 'X';
				}
				
				
				endforeach;
				// Periodes travaillées
				for($i=0;$i<=4;$i++):
				$params['date_deb_'.$i.'_p'] = $this->prestaData['date_deb_'.$i.'_periode_t'];
				$params['date_fin_'.$i.'_p'] = $this->prestaData['date_fin_'.$i.'_periode_t'];
				
				

				
				#on cherche entreprise
				$org = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['periode_t_entreprise_'.$i]));
				
				if($org)
					$tel = $org[0]->getTel();
				else
					$tel = '';
					
				$params['entreprise_'.$i.'_p'] = $this->prestaData['periode_t_entreprise_'.$i];
				$params['tel_'.$i.'_p'] =$tel;


				$params['poste_'.$i] = $this->prestaData['periode_t_code_rome_'.$i];
				$params['contrat_'.$i] = $this->prestaData['type_contrat_'.$i];
				endfor;
				#Plan d'action
				$params['emploi_1'] = $this->prestaData['code_rome_1'];
				$params['emploi_2'] = $this->prestaData['code_rome_2'];

				$params['date_deb_1'] = $this->prestaData['date_deb_1'];
				$params['date_deb_2'] = $this->prestaData['date_deb_2'];
				$params['date_deb_3'] = $this->prestaData['date_deb_3'];
				$params['date_deb_4'] = $this->prestaData['date_deb_4'];
				$params['date_deb_5'] = $this->prestaData['date_deb_5'];
				$params['date_deb_6'] = $this->prestaData['date_deb_6'];
				$params['date_fin_1'] = $this->prestaData['date_fin_1'];
				$params['date_fin_2'] = $this->prestaData['date_fin_2'];
				$params['date_fin_3'] = $this->prestaData['date_fin_3'];
				$params['date_fin_4'] = $this->prestaData['date_fin_4'];
				$params['date_fin_5'] = $this->prestaData['date_fin_5'];
				$params['date_fin_6'] = $this->prestaData['date_fin_6'];

				$params['action_1'] = $this->prestaData['action_1'];
				$params['action_2'] = $this->prestaData['action_2'];
				$params['action_3'] = $this->prestaData['action_3'];
				$params['action_4'] = $this->prestaData['action_4'];
				$params['action_5'] = $this->prestaData['action_5'];
				$params['action_6'] = $this->prestaData['action_6'];

				$params['obj_1'] = $this->prestaData['objectif_1'];
				$params['obj_2'] = $this->prestaData['objectif_2'];
				$params['obj_3'] = $this->prestaData['objectif_3'];
				$params['obj_4'] = $this->prestaData['objectif_4'];
				$params['obj_5'] = $this->prestaData['objectif_5'];
				$params['obj_6'] = $this->prestaData['objectif_6'];

				$params['res_1'] = $this->prestaData['resultat_1'];
				$params['res_2'] = $this->prestaData['resultat_2'];
				$params['res_3'] = $this->prestaData['resultat_3'];
				$params['res_4'] = $this->prestaData['resultat_4'];
				$params['res_5'] = $this->prestaData['resultat_5'];
				$params['res_6'] = $this->prestaData['resultat_6'];

				for($i=0;$i<=7;$i++):
				$params['date_suivi_'.$i] = $this->prestaData['date_suivi_'.$i];
				$params['objectif_contrat_'.$i] = $this->prestaData['objectif_contact_'.$i];
				$params['aspects_maitrises_'.$i] = $this->prestaData['aspects_maitrises_'.$i];
				$params['aspects_retravailler_'.$i] = $this->prestaData['aspects_a_retravailler_'.$i];

				
				#on cherche entreprise
				$org2 = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['entreprise_'.$i]));
				
				if($org2)
					$tel2 = $org2[0]->getTel();
				else
					$tel2 = '';
					
				$params['entreprise_'.$i] = $this->prestaData['entreprise_'.$i];
				$params['tel_'.$i] =$tel2;
				
				
				endfor;


				#beneficiaire
				
				$params['sit_be_cr'] = $this->prestaData['sit_ben_code_rome'];
				

				if(isset($this->prestaData['entreprise2_id']) and is_numeric($this->prestaData['entreprise2_id']))
				{
					/*$org = organisation::get($this->prestaData['entreprise2_id']);
					$params['entreprise2'] = $org["nom_organisme"];
					$params['adresse2'] = utf8_encode($org["adresse_ligne_1"]).' '.utf8_encode($org["adresse_ligne_2"]).', '.$org["cp_org"].' '.$org["ville_org"];
					$params['tel2'] = $org["tel"];*/
				}
				else
				{
					$params['entreprise2'] = $this->prestaData['entreprise2'];
					$params['adresse2'] ='';
					$params['tel2'] = '';
				}
				
				#on cherche entreprise
				$org3 = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['entreprise2']));
				
				if($org3)
				{
					$tel3 = $org3[0]->getTel();
					$adresse2 = $org3[0]->getAdresseLigne1();
				}
				else
				{
					$tel3 = '';
					$adresse2 = '';
				}
					
				$params['entreprise2'] = $this->prestaData['entreprise2'];
				$params['adresse2'] = $adresse2;
				$params['tel2'] = $tel3;
				

				if($this->prestaData['nb_heure_tp_partiel']!=null)
				$params['nb_h'] = $this->prestaData['nb_heure_tp_partiel'].'H';
				else
				$params['nb_h'] ='';

				$params['intitule_formation'] = $this->prestaData['sit_intitule_formation'];
				$params['date_reprise_emploi'] = $this->prestaData['date_reprise_emploi'];
				$params['pts_forts_axes'] = $this->prestaData['pts_forts_axes'];

				if($this->prestaData['duree_cdd']!=null)
				$params['time'] = $this->prestaData['duree_cdd'].' mois';
				else
				$params['time'] = '';

				if(isset($this->prestaData['type_contrat']))
				{
					if($this->prestaData['type_contrat']==1)
					{
						$params['cdi'] = 'X';
						$params['cdd'] = '';
					}
					elseif($this->prestaData['type_contrat']==2) {
						$params['cdi'] = ' ';
						$params['cdd'] = 'X';
					}
				}
				else 
				{
				$params['cdi'] = '...';
				$params['cdd'] = '...';
				}
					if(isset($this->prestaData['temps_contrat']))
				{
					if($this->prestaData['temps_contrat']==1)
					{
						$params['temp1'] = 'X';
						$params['temp2'] = ' ';
					}
					elseif($this->prestaData['temps_contrat']==2) {
						$params['temp1'] = ' ';
						$params['temp2'] = 'X';
					}
				}
				else
				{
					$params['temp1'] = '...';
					$params['temp2'] = '...';
				}
				

				if(isset($this->prestaData['via_formation']) && $this->prestaData['via_formation']==1)
				$params['form'] = 'X';
				else
				$params['form'] = ' ';

				$params['nb_pe'] = $this->prestaData['nb_offre_pe'];
				$params['nb_au'] = $this->prestaData['nb_offre_au'];
				$params['nb_sp'] = $this->prestaData['nb_offre_sp'];
				$params['ent_pe'] = $this->prestaData['nb_ent_pe'];
				$params['ent_sp'] = $this->prestaData['nb_ent_sp'];
				$params['ent_au'] = $this->prestaData['nb_ent_au'];


				$params['sit_code_rome'] = $this->prestaData['sit_ben_code_rome2'];
				$params['mar'] = $this->prestaData['marche_travail'];
				$params['pts_forts_axes2'] = $this->prestaData['pts_forts_axes2'];

				$params['nb_pe2'] = $this->prestaData['nb_offre_pe2'];
				$params['nb_au2'] = $this->prestaData['nb_offre_au2'];
				$params['nb_sp2'] = $this->prestaData['nb_offre_sp2'];
				$params['ent_pe2'] = $this->prestaData['nb_ent_pe2'];
				$params['ent_sp2'] = $this->prestaData['nb_ent_sp2'];
				$params['ent_au2'] = $this->prestaData['nb_ent_au2'];


				$params['echeance_1'] = $this->prestaData['date_action_1'];
				$params['echeance_2'] = $this->prestaData['date_action_2'];
				$params['echeance_3'] = $this->prestaData['date_action_3'];
				$params['echeance_4'] = $this->prestaData['date_action_4'];
				$params['echeance_5'] = $this->prestaData['date_action_5'];
				$params['echeance_6'] = $this->prestaData['date_action_6'];

				$params['action_1'] = $this->prestaData['action_a_m1'];
				$params['action_2'] = $this->prestaData['action_a_m2'];
				$params['action_3'] = $this->prestaData['action_a_m3'];
				$params['action_4'] = $this->prestaData['action_a_m4'];
				$params['action_5'] = $this->prestaData['action_a_m5'];
				$params['action_6'] = $this->prestaData['action_a_m6'];

				$params['ob1'] = $this->prestaData['objectif_a_m1'];
				$params['ob2'] = $this->prestaData['objectif_a_m2'];
				$params['ob3'] = $this->prestaData['objectif_a_m3'];
				$params['ob4'] = $this->prestaData['objectif_a_m4'];
				$params['ob5'] = $this->prestaData['objectif_a_m5'];
				$params['ob6'] = $this->prestaData['objectif_a_m6'];


				$download->setTitle($nomPresta."_annexe_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
				$download->get(getcwd()."/bundles/lea/doc/oe/annexe_2.rtf",$params);

			}

		

		die();
	}


	//Test asp1 APSIE-AT 20180602 //
	public function asp1Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		
				 		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
        
		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			$params = array_merge($params, $this->prestaData);
			
			
			
			 
			 
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
					 
			
			$params['sous-titre'] = $this->prestaData['commentaire_frein_choix_pro'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_prox_emploi'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_sante'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_adhesion'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_autonomie'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_disponibilite'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_budget'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_logement'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_formation'];
			$params['sous-titre'] = $this->prestaData['commentaire_frein_mobilite'];
			 
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Contrat_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/contrat_lot1.rtf",$params);


		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			
			$download->setTitle(
			
			
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/asp1/emargement_lot1.rtf",$params);


		}elseif($annexe==3){
           	$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			$params = array_merge($params, $this->prestaData);			 
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
			switch ($params["civilite"]) {
				case 'Monsieur':
					$params['sexe'] = 'Masculin';
					break;
				case ($params['civilite'] == 'Madame' || $params['civilite'] == 'Mademoiselle'):
					$params['sexe'] = 'Féminin';
					break;
				default:
					$params['sexe'] = '';
					break;
			}

		 	$params["date_naissance"] = $this->prestaEntity->getContact()->getDateNaissance();
			$params["lieu_naissance"] = $this->prestaEntity->getContact()->getLieuNaissance();
		 	$params["pays_naissance"] = $this->prestaEntity->getContact()->getPaysNaissance();
		 	$params["nationalite"] = $this->prestaEntity->getContact()->getNationalite();
		 	$params["situation_maritale"] = $this->prestaEntity->getContact()->getSituationMaritale();


			// Cases à cocher questionnaire EF Q36EtatLogement
			//$etat_logement = array_filter(array_keys($params), function ($k){ return strpos($k, "etat_logement") !== false && strpos($k, "etat_logement_obs") === false; });
			
			//foreach($etat_logement as $unused => $key_id){
				 
			//	for($i=1; $i<=4; ++$i){
			//		$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'X' : '';
			//	}
			//}



			// Cases à cocher questionnaire EF Q1ProjetPro
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q1_'.$i] = '   ';
				if($params['ef_q1'] == $i){
					$params['ef_q1_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q1.1SecteurActivité
			for ($i=0; $i <= 13; $i++) { 
				$params['ef_q1a_'.$i] = '   ';
				if($params['ef_q1a'] == $i){
					$params['ef_q1a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q2AtoutsProjetPro
			for ($i=1; $i <= 5; $i++) { 
				if($params['ef_q2_'.$i] == 1){
					$params['ef_q2_'.$i] = 'X';
				}else{
					$params['ef_q2_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q3BesoinsFormation
			for ($i=1; $i <= 4; $i++) { 
				if($params['ef_q3_'.$i] == 1){
					$params['ef_q3_'.$i] = 'X';
				}else{
					$params['ef_q3_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q4DuréeSansEmploi
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q4_'.$i] = '   ';
				if($params['ef_q4'] == $i){
					$params['ef_q4_'.$i] = 'X';
				}
			}


			// Cases à cocher choix multiple questionnaire EF Q5RaisonSansEmploi
			for ($i=1; $i <= 9; $i++) { 
				if($params['ef_q5_'.$i] == 1){
					$params['ef_q5_'.$i] = 'X';
				}else{
					$params['ef_q5_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q5.1MotifPasDeTravail
			for ($i=0; $i <= 6; $i++) { 
				$params['ef_q5a_'.$i] = '   ';
				if($params['ef_q5a'] == $i){
					$params['ef_q5a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q6InscriptionPoleEmploi
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q6_'.$i] = '   ';
				if($params['ef_q6'] == $i){
					$params['ef_q6_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q6.1InscriptionPoleEmploi
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q6a_'.$i] = '   ';
				if($params['ef_q6a'] == $i){
					$params['ef_q6a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q7ActiviteExtraPro
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q7_'.$i] = '   ';
				if($params['ef_q7'] == $i){
					$params['ef_q7_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q8CVAJour
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q8_'.$i] = '   ';
				if($params['ef_q8'] == $i){
					$params['ef_q8_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q8.1CVPasAJour
			for ($i=1; $i <= 5; $i++) { 
				if($params['ef_q8a_'.$i] == 1){
					$params['ef_q8a_'.$i] = 'X';
				}else{
					$params['ef_q8a_'.$i] = '   ';
				}
			}

			// Cases à cocher questionnaire EF Q9RéseauPerso
			for ($i=1; $i <= 6; $i++) { 
				if($params['ef_q9_'.$i] == 1){
					$params['ef_q9_'.$i] = 'X';
				}else{
					$params['ef_q9_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q10EtatSanté
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q10_'.$i] = '   ';
				if($params['ef_q10'] == $i){
					$params['ef_q10_'.$i] = 'X';
				}
			}
							 

			// Cases à cocher questionnaire EF Q11RQTH
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q11_'.$i] = '   ';
				if($params['ef_q11'] == $i){
					$params['ef_q11_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q12SuiviMédecin
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q12_'.$i] = '   ';
				if($params['ef_q12'] == $i){
					$params['ef_q12_'.$i] = 'X';
				}
			}

			// Précision à cocher questionnaire EF Q12CauseNonSuiviMédecin
			for ($i=1; $i <= 6; $i++) { 
				if($params['ef_q12a_'.$i] == 1){
					$params['ef_q12a_'.$i] = 'X';
				}else{
					$params['ef_q12a_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q13SantéEmpecheTravail
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q13_'.$i] = '   ';
				if($params['ef_q13'] == $i){
					$params['ef_q13_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q14
			for ($i=0; $i <= 6; $i++) { 
				$params['ef_q14_'.$i] = '   ';
				if($params['ef_q14'] == $i){
					$params['ef_q14_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q15
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q15_'.$i] = '   ';
				if($params['ef_q15'] == $i){
					$params['ef_q15_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q16
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q16_'.$i] = '   ';
				if($params['ef_q16'] == $i){
					$params['ef_q16_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q16.2
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q16a_'.$i] = '   ';
				if($params['ef_q16a'] == $i){
					$params['ef_q16a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q10EtatSanté
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q17_'.$i] = '   ';
				if($params['ef_q17'] == $i){
					$params['ef_q17_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q17.2
			for ($i=1; $i <= 5; $i++) { 
				if($params['ef_q17a_'.$i] == 1){
					$params['ef_q17a_'.$i] = 'X';
				}else{
					$params['ef_q17a_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q18
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q18_'.$i] = '   ';
				if($params['ef_q18'] == $i){
					$params['ef_q18_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q19AttentesPrestation
			for ($i=1; $i <= 4; $i++) { 
				if($params['ef_q19_'.$i] == 1){
					$params['ef_q19_'.$i] = 'X';
				}else{
					$params['ef_q19_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q20besoinAccompagnement
			for ($i=1; $i <= 6; $i++) { 
				if($params['ef_q20_'.$i] == 1){
					$params['ef_q20_'.$i] = 'X';
				}else{
					$params['ef_q20_'.$i] = '   ';
				}
			}

			// Cases à cocher questionnaire EF Q21aAutonomiePapiers
			define('KEY_EVAL_AUTONOMIE',81);
			$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->get();
			$listes = Texte::getListeByIdTexte($texte);
			foreach($listes[KEY_EVAL_AUTONOMIE] as $id_texte => $label_texte){
				for ($i=0; $i <= 5; $i++) { 
					$params['autonomie_'.$id_texte.'_'.$i] = '   ';
					if($params['autonomie_'.$id_texte] == $i){
						$params['autonomie_'.$id_texte.'_'.$i] = 'X';
					}
				}
			}


			// Cases à cocher questionnaire EF Q22EquipementNumérique
			for ($i=1; $i <= 4; $i++) { 
				if($params['ef_q22_'.$i] == 1){
					$params['ef_q22_'.$i] = 'X';
				}else{
					$params['ef_q22_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q23AccesInternet
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q23_'.$i] = '   ';
				if($params['ef_q23'] == $i){
					$params['ef_q23_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q24DemarcheEnLigne
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q24_'.$i] = '   ';
				if($params['ef_q24'] == $i){
					$params['ef_q24_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q24.1MotifPasDémarchesEnLigne
			for ($i=1; $i <= 5; $i++) { 
				if($params['ef_q24a_'.$i] == 1){
					$params['ef_q24a_'.$i] = 'X';
				}else{
					$params['ef_q24a_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q25DélaiRetourEmploi
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q25_'.$i] = '   ';
				if($params['ef_q25'] == $i){
					$params['ef_q25_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q25.1MotifNonDispoEmploi
			for ($i=1; $i <= 4; $i++) { 
				if($params['ef_q25a_'.$i] == 1){
					$params['ef_q25a_'.$i] = 'X';
				}else{
					$params['ef_q25a_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q26GardeEnfants
			for ($i=1; $i <= 3; $i++) { 
				if($params['ef_q26_'.$i] == 1){
					$params['ef_q26_'.$i] = 'X';
				}else{
					$params['ef_q26_'.$i] = '   ';
				}
			}

			// Cases à cocher questionnaire EF Q26.1TypeGardeEnfants
			for ($i=1; $i <= 8; $i++) { 
				if($params['ef_q26a_'.$i] == 1){
					$params['ef_q26a_'.$i] = 'X';
				}else{
					$params['ef_q26a_'.$i] = '   ';
				}
			}


			// Cases à cocher questionnaire EF Q26.2MotifNonGardeEnfants
			for ($i=1; $i <= 5; $i++) { 
				if($params['ef_q26b_'.$i] == 1){
					$params['ef_q26b_'.$i] = 'X';
				}else{
					$params['ef_q26b_'.$i] = '   ';
				}
			}

			// Cases à cocher questionnaire EF Q26.3aEnfantsACharge
			//for ($i=0; $i <= 6; $i++) { 
			//	$params['ef_q26c_'.$i] = '   ';
			//	if($params['ef_q26c'] == $i){
			//		$params['ef_q26c_'.$i] = 'X';
			//	}
			//}


			// Cases à cocher questionnaire EF Q27EquilibreBudget
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q27_'.$i] = '   ';
				if($params['ef_q27'] == $i){
					$params['ef_q27_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q28aDettesLoyer
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28a_'.$i] = '   ';
				if($params['ef_q28a'] == $i){
					$params['ef_q28a_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28bDettesEDF
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28b_'.$i] = '   ';
				if($params['ef_q28b'] == $i){
					$params['ef_q28b_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28cDettesTéléphone
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28c_'.$i] = '   ';
				if($params['ef_q28c'] == $i){
					$params['ef_q28c_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28dDettesAssurance
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28d_'.$i] = '   ';
				if($params['ef_q28d'] == $i){
					$params['ef_q28d_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28eDettesCreditConso
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28e_'.$i] = '   ';
				if($params['ef_q28e'] == $i){
					$params['ef_q28e_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28eDettesCreditImmo
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28f_'.$i] = '   ';
				if($params['ef_q28f'] == $i){
					$params['ef_q28f_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q28eDettesAutreCredit
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q28g_'.$i] = '   ';
				if($params['ef_q28g'] == $i){
					$params['ef_q28g_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q29aMobilisationAidesLogement
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q29a_'.$i] = '   ';
				if($params['ef_q29a'] == $i){
					$params['ef_q29a_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q29aMobilisationAutresAides
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q29b_'.$i] = '   ';
				if($params['ef_q29b'] == $i){
					$params['ef_q29b_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q30DecouvertBancaire
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q30_'.$i] = '   ';
				if($params['ef_q30'] == $i){
					$params['ef_q30_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q31Surendettement
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q31_'.$i] = '   ';
				if($params['ef_q31'] == $i){
					$params['ef_q31_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q31.1DossierSurendettement
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q31a_'.$i] = '   ';
				if($params['ef_q31a'] == $i){
					$params['ef_q31a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q32TypeLogementOccupé
			define('KEY_TYPE_LOGEMENT',83);
			$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->get();
			$listes = Texte::getListeByIdTexte($texte);
			foreach($listes[KEY_TYPE_LOGEMENT] as $id_texte => $label_texte){
				for ($i=0; $i <= 9; $i++) { 
					$params['type_logement_'.$id_texte.'_'.$i] = '   ';
					if($params['type_logement_'.$id_texte] == $i){
						$params['type_logement_'.$id_texte.'_'.$i] = 'X';
					}
				}
			}


			// Cases à cocher questionnaire EF Q32aLogementAutonome
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q32a_'.$i] = '   ';
				if($params['ef_q32a'] == $i){
					$params['ef_q32a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q33PropriétaireLogement
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q33_'.$i] = '   ';
				if($params['ef_q33'] == $i){
					$params['ef_q33_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q34AcèsCourrier
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q34_'.$i] = '   ';
				if($params['ef_q34'] == $i){
					$params['ef_q34_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q34.1FréquenceAcèsCourrier
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q34a_'.$i] = '   ';
				if($params['ef_q34a'] == $i){
					$params['ef_q34a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q35RisqueSortieLogement
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q35_'.$i] = '   ';
				if($params['ef_q35'] == $i){
					$params['ef_q35_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q36EtatLogement
			define('KEY_ETAT_LOGEMENT',84);
			$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->get();
			$listes = Texte::getListeByIdTexte($texte);
			foreach($listes[KEY_ETAT_LOGEMENT] as $id_texte => $label_texte){
				for ($i=0; $i <= 9; $i++) { 
					$params['etat_logement_'.$id_texte.'_'.$i] = '   ';
					if($params['etat_logement_'.$id_texte] == $i){
						$params['etat_logement_'.$id_texte.'_'.$i] = 'X';
					}
				}
			}


			// Précision questionnaire EF Q34.37aObsLogementSalubrité
			for ($i=0; $i <= 9; $i++) { 
				$params['etat_logement_obs_'.$i] = '   ';
				if($params['etat_logement_obs_'] == $i){
					$params['etat_logement_obs_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q35RisqueExpulsionLogement
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q37_'.$i] = '   ';
				if($params['ef_q37'] == $i){
					$params['ef_q37_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q37aLogementSalubrité
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q37a_'.$i] = '   ';
				if($params['ef_q37a'] == $i){
					$params['ef_q37a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q37bLogementSuperficie
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q37b_'.$i] = '   ';
				if($params['ef_q37b'] == $i){
					$params['ef_q37b_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q37cLogementCommodités
//			for ($i=0; $i <= 4; $i++) { 
//				$params['ef_q37c_'.$i] = '   ';
//				if($params['ef_q37c'] == $i){
//					$params['ef_q37c_'.$i] = 'X';
//				}
//			}



			// Cases à cocher questionnaire EF Q39NiveauQualification
			for ($i=0; $i <= 7; $i++) { 
				$params['ef_q39_'.$i] = '   ';
				if($params['ef_q39'] == $i){
					$params['ef_q39_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q21aAutonomiePapiers
			define('KEY_SAVOIR_BASE',85);
			$texte = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwTexte')->get();
			$listes = Texte::getListeByIdTexte($texte);
			foreach($listes[KEY_SAVOIR_BASE] as $id_texte => $label_texte){
				for ($i=0; $i <= 3; $i++) { 
					$params['savoir_'.$id_texte.'_'.$i] = '   ';
					if($params['savoir_'.$id_texte] == $i){
						$params['savoir_'.$id_texte.'_'.$i] = 'X';
					}
				}
			}

			// Précision questionnaire EF Q34.37aObsLogementSalubrité
			for ($i=0; $i <= 9; $i++) { 
				$params['savoir_obs_obs_'.$i] = '   ';
				if($params['savoir_obs_obs_'] == $i){
					$params['savoir_obs_obs_'.$i] = 'X';
				}
			}


/*			// Cases à cocher questionnaire EF Q40aSavoirBaseParler
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40a_'.$i] = '   ';
				if($params['ef_q40a'] == $i){
					$params['ef_q40a_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q40bSavoirBaseLire
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40b_'.$i] = '   ';
				if($params['ef_q40b'] == $i){
					$params['ef_q40b_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q40cSavoirBaseEcrire
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40c_'.$i] = '   ';
				if($params['ef_q40c'] == $i){
					$params['ef_q40c_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q40dSavoirBaseCalculer
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40d_'.$i] = '   ';
				if($params['ef_q40d'] == $i){
					$params['ef_q40d_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q40eSavoirBaseRepérageEspace
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40e_'.$i] = '   ';
				if($params['ef_q40e'] == $i){
					$params['ef_q40e_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q40fSavoirBaseRepérageTemps
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q40f_'.$i] = '   ';
				if($params['ef_q40f'] == $i){
					$params['ef_q40f_'.$i] = 'X';
				}
			}
*/

			// Cases à cocher questionnaire EF Q41PermisConduire
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q41_'.$i] = '   ';
				if($params['ef_q41'] == $i){
					$params['ef_q41_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire EF Q42MotifPermisNonPassé
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q42_'.$i] = '   ';
				if($params['ef_q42'] == $i){
					$params['ef_q42_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q42.1PermisEchecsMultiples
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q42a_'.$i] = '   ';
				if($params['ef_q42a'] == $i){
					$params['ef_q42a_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q43ModeDéplacement
			for ($i=0; $i <= 5; $i++) { 
				$params['ef_q43_'.$i] = '   ';
				if($params['ef_q43'] == $i){
					$params['ef_q43_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q44PropriétaireVéhicule
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q44_'.$i] = '   ';
				if($params['ef_q44'] == $i){
					$params['ef_q44_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q45MotifSansVéhicule
			for ($i=0; $i <= 3; $i++) { 
				$params['ef_q45_'.$i] = '   ';
				if($params['ef_q45'] == $i){
					$params['ef_q45_'.$i] = 'X';
				}
			}

			// Précision questionnaire EF Q46LigneBusCar
			    if($params['ef_q46_a']==1){
					$params['ef_q46_a'] = 'X';
				}

				else{
					$params['ef_q46_a'] = '';
				}

			// Précision questionnaire EF Q46LigneTrain
			    if($params['ef_q46_b']==1){
					$params['ef_q46_b'] = 'X';
				}

				else{
					$params['ef_q46_b'] = '';
				}

			// Précision questionnaire EF Q46LigneTramway
			    if($params['ef_q46_c']==1){
					$params['ef_q46_c'] = 'X';
				}

				else{
					$params['ef_q46_c'] = '';
				}

			// Précision questionnaire EF Q46LigneRER
			    if($params['ef_q46_d']==1){
					$params['ef_q46_d'] = 'X';
				}

				else{
					$params['ef_q46_d'] = '';
				}

			// Précision questionnaire EF Q46LigneMétro
			    if($params['ef_q46_e']==1){
					$params['ef_q46_e'] = 'X';
				}

				else{
					$params['ef_q46_e'] = '';
				}

			// Cases à cocher questionnaire EF Q47CarteSolidaritéTransport
			for ($i=0; $i <= 2; $i++) { 
				$params['ef_q47_'.$i] = '   ';
				if($params['ef_q47'] == $i){
					$params['ef_q47_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire EF Q47.1MotifNonCarteSolidaritéTransport
			for ($i=0; $i <= 4; $i++) { 
				$params['ef_q47a_'.$i] = '   ';
				if($params['ef_q47a'] == $i){
					$params['ef_q47a_'.$i] = 'X';
				}
			}

			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Questionnaire_Freins_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Questionnaire_Freins.rtf",$params);


		}elseif($annexe==4){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			 			
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
				
			 
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
		
			//echo '<pre>'.print_r($p, true).'</pre>';exit;
			//Debug::dump($synthese);exit;
			//var_dump($synthese);
			 
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
			
			
			// Diagnostic
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			 
			//Debug::dump($synthese);Debug::dump($diag);exit; 
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			$params['b_com_ref'] = $this->prestaData['bilan_com_referent'];
			$params['b_beneficiaire'] = $this->prestaData['bilan_com_beneficiaire'];


			// Cases à cocher Orientation
			for ($i=0; $i <= 4; $i++) { 
				$params['orientation_'.$i] = '   ';
				if($params['orientation'] == $i){
					$params['orientation_'.$i] = 'X';
				}
			}
			 
			// Cases à cocher abandon
			for ($i=0; $i <= 2; $i++) { 
				$params['abandon_'.$i] = '   ';
				if($params['abandon'] == $i){
					$params['abandon_'.$i] = 'X';
				}
			}

						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/asp1/Bilan d'évaluation_Plan d'action.rtf",$params);
				


		}elseif($annexe==5){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Contrat_Engagement_Professionnel_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Contrat d'engagement professionnel.pdf",$params);





		}elseif($annexe==6){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Avenant_CEP_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Annexe_CEP.pdf",$params);




		}elseif($annexe==7){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Avenant_CEP_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Avenant_CEP.pdf",$params);


		}elseif($annexe==8){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Evaluation_Freins_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Evaluation_ASP77.xls",$params);


		}elseif($annexe==9){
            $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
		    }
			 
			 
		 	$params = array_merge($params, $this->prestaData);
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
			switch ($params["civilite"]) {
				case 'Monsieur':
					$params['sexe'] = 'Masculin';
					break;
				case ($params['civilite'] == 'Madame' || $params['civilite'] == 'Mademoiselle'):
					$params['sexe'] = 'Féminin';
					break;
				default:
					$params['sexe'] = '';
					break;
			}

		 	$params["date_naissance"] = $this->prestaEntity->getContact()->getDateNaissance();
			$params["lieu_naissance"] = $this->prestaEntity->getContact()->getLieuNaissance();
		 	$params["pays_naissance"] = $this->prestaEntity->getContact()->getPaysNaissance();





			// Cases à cocher questionnaire FSE Q1
			for ($i=0; $i <= 5; $i++) { 
				$params['fse_q1_'.$i] = '  ';
				if($params['fse_q1'] == $i){
					$params['fse_q1_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1activite
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1activite'.$i] = '  ';
				if($params['fse_q1activite'] == $i){
					$params['fse_q1activite'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1mois
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1mois'.$i] = '  ';
				if($params['fse_q1mois'] == $i){
					$params['fse_q1mois'.$i] = 'X';
				}
			}



			// Cases à cocher questionnaire FSE Q1e
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1e_'.$i] = '  ';
				if($params['fse_q1e'] == $i){
					$params['fse_q1e_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire FSE Q1f
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1f_'.$i] = '  ';
				if($params['fse_q1f'] == $i){
					$params['fse_q1f_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1activite
			    if($this->prestaData['fse_q1activite']==1){
					$params['fse_q1activite'] = 'X';

				}

				else{
					$params['fse_q1activite'] = '';
				
				}


			// Cases à cocher questionnaire FSE Q1gmois
			    if($this->prestaData['fse_q1gmois']==1){
					$params['fse_q1gmois'] = 'X';

				}

				else{
					$params['fse_q1gmois'] = '';
				
				}




			// Cases à cocher questionnaire FSE Q2
			for ($i=0; $i <= 4; $i++) { 
				$params['fse_q2_'.$i] = '  ';
				if($params['fse_q2'] == $i){
					$params['fse_q2_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3a
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3a_'.$i] = '  ';
				if($params['fse_q3a'] == $i){
					$params['fse_q3a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3b
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3b_'.$i] = '  ';
				if($params['fse_q3b'] == $i){
					$params['fse_q3b_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3c
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3c_'.$i] = '  ';
				if($params['fse_q3c'] == $i){
					$params['fse_q3c_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q4
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q4_'.$i] = '  ';
				if($params['fse_q4'] == $i){
					$params['fse_q4_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q5
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q5_'.$i] = '  ';
				if($params['fse_q5'] == $i){
					$params['fse_q5_'.$i] = 'X';
				}
			}



			// Cases à cocher questionnaire FSE Q6
			for ($i=0; $i <= 3; $i++) { 
				$params['fse_q6_'.$i] = '  ';
				if($params['fse_q6'] == $i){
					$params['fse_q6_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q7
			for ($i=0; $i <= 3; $i++) { 
				$params['fse_q7_'.$i] = '  ';
				if($params['fse_q7'] == $i){
					$params['fse_q7_'.$i] = 'X';
				}
			}





			
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Quest_FSE_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
            $download->get(getcwd()."/bundles/lea/doc/asp1/Questionnaire_FSE_lot1.rtf",$params);





		}elseif($annexe==10){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Quest_Satisfaction_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/Questionnaire_satisfaction.rtf",$params);
			



		}elseif($annexe==11){
            $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			 
			// Cases à cocher Réorientation EP
			for ($i=0; $i <= 6; $i++) { 
				$params['reorientation_ept_'.$i] = '   ';
				if($params['reorientation_ept'] == $i){
					$params['reorientation_ept_'.$i] = 'X';
				}
			}
			 
			// Cases à cocher Suspension EP
			for ($i=0; $i <= 4; $i++) { 
				$params['motif_suspension_ept_'.$i] = '   ';
				if($params['motif_suspension_ept'] == $i){
					$params['motif_suspension_ept_'.$i] = 'X';
				}
			}

			// Cases à cocher Rétablissement EP
			    if($this->prestaData['retablissement_ept']==1){
					$params['retablissement_ept'] = 'X';
				}
				else{
					$params['retablissement_ept'] = '';
				}

			// Cases à cocher Rétablissement EP
			    if($this->prestaData['etude_situation_ept']==1){
					$params['etude_situation_ept'] = 'X';

				}

				else{
					$params['etude_situation_ept'] = '';
				
				}

		 	$params["date_naissance"] = $this->prestaEntity->getContact()->getDateNaissance();

			$params['sous-titre'] = $this->prestaData['commentaire_ept'];

			$params = array_merge($params, $this->prestaData);
			 
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Formulaire_EPT_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/asp1/Formulaire_EP.rtf",$params);


		}elseif($annexe==12){
            $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
			$params['da'] = date('d/m/y');
			$params["date_naissance"] = $this->prestaEntity->getContact()->getDateNaissance();

			$params['sous-titre'] = $this->prestaData['commentaire_ept'];

			$params = array_merge($params, $this->prestaData);
			 
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Formulaire_EPT_ABSENCE_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
		
            $download->get(getcwd()."/bundles/lea/doc/asp1/Formulaire_EP_ABSENCE.rtf",$params);




		}elseif($annexe==13){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
						
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_couvertures_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/asp1/couvertures.rtf",$params);
		}
		die();
	}






	//Test asp2 APSIE-AT 20180602 //
	public function asp2Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();
		
		
		
		$download = new Download();

		
		

			$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
			if($annexe==1)
			{
				
				$download->setTitle($nomPresta."_annexe_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
				$download->get(getcwd()."/bundles/lea/doc/asp2/annexe_1.rtf",$params);
			}
			elseif($annexe==2)
			{


				if($this->prestaData['suivi']==1)
				$params['1'] = "X";
				else
				$params['1'] = " ";

				if($this->prestaData['suivi']==2)
				$params['2'] = "X";
				else
				$params['2'] = " ";

				if($this->prestaData['suivi']==3)
				$params['3'] = "X";
				else
				$params['3'] = " ";

				if($this->prestaData['suivi']==4)
				$params['4'] = "X";
				else
				$params['4'] = " ";

				//Rdv
		
				$dataRdv = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null,null,$id_presta);

				for($i=0;$i<=11;$i++):
				$params['date_rdv_'.$i] = "";
				$params['rdv_ab_'.$i] = "";
				$params['R'.$i] = "  ";
				$params['I'.$i] = "  ";
				endfor;

				foreach ($dataRdv as $key => $row):
					$params['date_rdv_'.$key] = date('dmy',$row->getEgwCalIdDates()->getCalStart());
				
				foreach ($row->getEgwCalIdUser() as $key2 => $value2) {
		    		$params['rdv_ab_'.$key] = $value2->getMotifAbsence();
		    	}
				// SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
				$part = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getNbParticipants($row->getCalId(),'b');
				if($part['nb']>1)
				{
					$params['R'.$key] = 'X';
					$params['I'.$key] = '  ';
				}
				else
				{
					$params['R'.$key] = '  ';
					$params['I'.$key] = 'X';
				}
				
				
				endforeach;
				// Periodes travaillées
				for($i=0;$i<=4;$i++):
				$params['date_deb_'.$i.'_p'] = $this->prestaData['date_deb_'.$i.'_periode_t'];
				$params['date_fin_'.$i.'_p'] = $this->prestaData['date_fin_'.$i.'_periode_t'];
				
				

				
				#on cherche entreprise
				$org = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['periode_t_entreprise_'.$i]));
				
				if($org)
					$tel = $org[0]->getTel();
				else
					$tel = '';
					
				$params['entreprise_'.$i.'_p'] = $this->prestaData['periode_t_entreprise_'.$i];
				$params['tel_'.$i.'_p'] =$tel;


				$params['poste_'.$i] = $this->prestaData['periode_t_code_rome_'.$i];
				$params['contrat_'.$i] = $this->prestaData['type_contrat_'.$i];
				endfor;
				#Plan d'action
				$params['emploi_1'] = $this->prestaData['code_rome_1'];
				$params['emploi_2'] = $this->prestaData['code_rome_2'];

				$params['date_deb_1'] = $this->prestaData['date_deb_1'];
				$params['date_deb_2'] = $this->prestaData['date_deb_2'];
				$params['date_deb_3'] = $this->prestaData['date_deb_3'];
				$params['date_deb_4'] = $this->prestaData['date_deb_4'];
				$params['date_deb_5'] = $this->prestaData['date_deb_5'];
				$params['date_deb_6'] = $this->prestaData['date_deb_6'];
				$params['date_fin_1'] = $this->prestaData['date_fin_1'];
				$params['date_fin_2'] = $this->prestaData['date_fin_2'];
				$params['date_fin_3'] = $this->prestaData['date_fin_3'];
				$params['date_fin_4'] = $this->prestaData['date_fin_4'];
				$params['date_fin_5'] = $this->prestaData['date_fin_5'];
				$params['date_fin_6'] = $this->prestaData['date_fin_6'];

				$params['action_1'] = $this->prestaData['action_1'];
				$params['action_2'] = $this->prestaData['action_2'];
				$params['action_3'] = $this->prestaData['action_3'];
				$params['action_4'] = $this->prestaData['action_4'];
				$params['action_5'] = $this->prestaData['action_5'];
				$params['action_6'] = $this->prestaData['action_6'];

				$params['obj_1'] = $this->prestaData['objectif_1'];
				$params['obj_2'] = $this->prestaData['objectif_2'];
				$params['obj_3'] = $this->prestaData['objectif_3'];
				$params['obj_4'] = $this->prestaData['objectif_4'];
				$params['obj_5'] = $this->prestaData['objectif_5'];
				$params['obj_6'] = $this->prestaData['objectif_6'];

				$params['res_1'] = $this->prestaData['resultat_1'];
				$params['res_2'] = $this->prestaData['resultat_2'];
				$params['res_3'] = $this->prestaData['resultat_3'];
				$params['res_4'] = $this->prestaData['resultat_4'];
				$params['res_5'] = $this->prestaData['resultat_5'];
				$params['res_6'] = $this->prestaData['resultat_6'];

				for($i=0;$i<=7;$i++):
				$params['date_suivi_'.$i] = $this->prestaData['date_suivi_'.$i];
				$params['objectif_contrat_'.$i] = $this->prestaData['objectif_contact_'.$i];
				$params['aspects_maitrises_'.$i] = $this->prestaData['aspects_maitrises_'.$i];
				$params['aspects_retravailler_'.$i] = $this->prestaData['aspects_a_retravailler_'.$i];

				
				#on cherche entreprise
				$org2 = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['entreprise_'.$i]));
				
				if($org2)
					$tel2 = $org2[0]->getTel();
				else
					$tel2 = '';
					
				$params['entreprise_'.$i] = $this->prestaData['entreprise_'.$i];
				$params['tel_'.$i] =$tel2;
				
				
				endfor;


				#beneficiaire
				
				$params['sit_be_cr'] = $this->prestaData['sit_ben_code_rome'];
				

				if(isset($this->prestaData['entreprise2_id']) and is_numeric($this->prestaData['entreprise2_id']))
				{
					/*$org = organisation::get($this->prestaData['entreprise2_id']);
					$params['entreprise2'] = $org["nom_organisme"];
					$params['adresse2'] = utf8_encode($org["adresse_ligne_1"]).' '.utf8_encode($org["adresse_ligne_2"]).', '.$org["cp_org"].' '.$org["ville_org"];
					$params['tel2'] = $org["tel"];*/
				}
				else
				{
					$params['entreprise2'] = $this->prestaData['entreprise2'];
					$params['adresse2'] ='';
					$params['tel2'] = '';
				}
				
				#on cherche entreprise
				$org3 = $this->getDoctrine()->getRepository('LeaPrestaBundle:Spiclient')->findBy(array('nomOrganisme'=>$this->prestaData['entreprise2']));
				
				if($org3)
				{
					$tel3 = $org3[0]->getTel();
					$adresse2 = $org3[0]->getAdresseLigne1();
				}
				else
				{
					$tel3 = '';
					$adresse2 = '';
				}
					
				$params['entreprise2'] = $this->prestaData['entreprise2'];
				$params['adresse2'] = $adresse2;
				$params['tel2'] = $tel3;
				

				if($this->prestaData['nb_heure_tp_partiel']!=null)
				$params['nb_h'] = $this->prestaData['nb_heure_tp_partiel'].'H';
				else
				$params['nb_h'] ='';

				$params['intitule_formation'] = $this->prestaData['sit_intitule_formation'];
				$params['date_reprise_emploi'] = $this->prestaData['date_reprise_emploi'];
				$params['pts_forts_axes'] = $this->prestaData['pts_forts_axes'];

				if($this->prestaData['duree_cdd']!=null)
				$params['time'] = $this->prestaData['duree_cdd'].' mois';
				else
				$params['time'] = '';

				if(isset($this->prestaData['type_contrat']))
				{
					if($this->prestaData['type_contrat']==1)
					{
						$params['cdi'] = 'X';
						$params['cdd'] = '';
					}
					elseif($this->prestaData['type_contrat']==2) {
						$params['cdi'] = ' ';
						$params['cdd'] = 'X';
					}
				}
				else 
				{
				$params['cdi'] = '...';
				$params['cdd'] = '...';
				}
					if(isset($this->prestaData['temps_contrat']))
				{
					if($this->prestaData['temps_contrat']==1)
					{
						$params['temp1'] = 'X';
						$params['temp2'] = ' ';
					}
					elseif($this->prestaData['temps_contrat']==2) {
						$params['temp1'] = ' ';
						$params['temp2'] = 'X';
					}
				}
				else
				{
					$params['temp1'] = '...';
					$params['temp2'] = '...';
				}
				

				if(isset($this->prestaData['via_formation']) && $this->prestaData['via_formation']==1)
				$params['form'] = 'X';
				else
				$params['form'] = ' ';

				$params['nb_pe'] = $this->prestaData['nb_offre_pe'];
				$params['nb_au'] = $this->prestaData['nb_offre_au'];
				$params['nb_sp'] = $this->prestaData['nb_offre_sp'];
				$params['ent_pe'] = $this->prestaData['nb_ent_pe'];
				$params['ent_sp'] = $this->prestaData['nb_ent_sp'];
				$params['ent_au'] = $this->prestaData['nb_ent_au'];


				$params['sit_code_rome'] = $this->prestaData['sit_ben_code_rome2'];
				$params['mar'] = $this->prestaData['marche_travail'];
				$params['pts_forts_axes2'] = $this->prestaData['pts_forts_axes2'];

				$params['nb_pe2'] = $this->prestaData['nb_offre_pe2'];
				$params['nb_au2'] = $this->prestaData['nb_offre_au2'];
				$params['nb_sp2'] = $this->prestaData['nb_offre_sp2'];
				$params['ent_pe2'] = $this->prestaData['nb_ent_pe2'];
				$params['ent_sp2'] = $this->prestaData['nb_ent_sp2'];
				$params['ent_au2'] = $this->prestaData['nb_ent_au2'];


				$params['echeance_1'] = $this->prestaData['date_action_1'];
				$params['echeance_2'] = $this->prestaData['date_action_2'];
				$params['echeance_3'] = $this->prestaData['date_action_3'];
				$params['echeance_4'] = $this->prestaData['date_action_4'];
				$params['echeance_5'] = $this->prestaData['date_action_5'];
				$params['echeance_6'] = $this->prestaData['date_action_6'];

				$params['action_1'] = $this->prestaData['action_a_m1'];
				$params['action_2'] = $this->prestaData['action_a_m2'];
				$params['action_3'] = $this->prestaData['action_a_m3'];
				$params['action_4'] = $this->prestaData['action_a_m4'];
				$params['action_5'] = $this->prestaData['action_a_m5'];
				$params['action_6'] = $this->prestaData['action_a_m6'];

				$params['ob1'] = $this->prestaData['objectif_a_m1'];
				$params['ob2'] = $this->prestaData['objectif_a_m2'];
				$params['ob3'] = $this->prestaData['objectif_a_m3'];
				$params['ob4'] = $this->prestaData['objectif_a_m4'];
				$params['ob5'] = $this->prestaData['objectif_a_m5'];
				$params['ob6'] = $this->prestaData['objectif_a_m6'];


				$download->setTitle($nomPresta."_annexe_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
				$download->get(getcwd()."/bundles/lea/doc/asp2/annexe_2.rtf",$params);

			}

		

		die();
	}
	


	//Test rsa771 sadel 2016 //
	public function rsa1Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		
				 		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
        
		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			 
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/rsa771/emargement_lot1.rtf",$params);
		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
				
			 
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
		
			//echo '<pre>'.print_r($p, true).'</pre>';exit;
			//Debug::dump($synthese);exit;
			//var_dump($synthese);
			 
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
			
			
			// Diagnostique
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			 
			//Debug::dump($synthese);Debug::dump($diag);exit; 
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			    if($this->prestaData['estimation']==1){
					$params['estimation_un'] = 'X';
					$params['estimation_six'] = '';
				}
				elseif($this->prestaData['estimation']==2){
					$params['estimation_six'] = 'X';
					$params['estimation_un'] = '';
			
				}
				else{
					$params['estimation_un'] = '';
					$params['estimation_six'] = '';
				
				}
			 
			
						
						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/rsa771/Bilan_d'evaluation_lot1.rtf",$params);
		
		}elseif($annexe==3){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			
			
			
			 
			 
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
					 
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params['sous-titre'] = $this->prestaData['commentaire_pt_fi'];
			 
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa771/contrat_lot1.rtf",$params);
		
		}elseif($annexe==4){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa771/Questionnaire FSE_lot1.rtf",$params);
			
		}elseif($annexe==5){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa771/questionnaire satisfaction.rtf",$params);
			
		}elseif($annexe==6){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q6_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa771/couvertures.rtf",$params);
		}
		die();
	}
	
	//Test rsa772 sadel 2016 //
	public function rsa2Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		
				 		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
        
		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			
			
			 
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			$download->setTitle(
			
			
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/rsa772/emargement_lot2.rtf",$params);
		
		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
				
			 
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
		
			//echo '<pre>'.print_r($p, true).'</pre>';exit;
			//Debug::dump($synthese);exit;
			//var_dump($synthese);
			 
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
			
			
			// Diagnostique
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			 
			//Debug::dump($synthese);Debug::dump($diag);exit; 
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			    if($this->prestaData['estimation']==1){
					$params['estimation_un'] = 'X';
					$params['estimation_six'] = '';
				}
				elseif($this->prestaData['estimation']==2){
					$params['estimation_six'] = 'X';
					$params['estimation_un'] = '';
			
				}
				else{
					$params['estimation_un'] = '';
					$params['estimation_six'] = '';
				
				}
			 
			
						
						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/rsa772/Bilan_d'evaluation_lot2.rtf",$params);
		
		}elseif($annexe==3){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			
			
			
			 
			 
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
					 
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params['sous-titre'] = $this->prestaData['commentaire_pt_fi'];
			 
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Contrat_Lot_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa772/contrat_lot2.rtf",$params);
		
		}elseif($annexe==4){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa772/Questionnaire FSE_lot2.rtf",$params);
			
		}elseif($annexe==5){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa772/questionnaire satisfaction.rtf",$params);
			
		}elseif($annexe==6){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            $params['Comm'] = $this->prestaData['Ahumains']; 
			$params['Aeco'] = $this->prestaData['Aeconom']; 
			$params['Mmaterr'] = $this->prestaData['Mmater'];
			$params['Drenc'] = $this->prestaData['Drencon'];
			$params['Endett'] = $this->prestaData['Endet'];
			$params['effec'] = $this->prestaData['effect'];
			$params['Dma'] = $this->prestaData['Demar'];
			$params['Sit'] = $this->prestaData['Situation'];
			//$params['F'] = $this->prestaData['Fax'];
			//$params['T'] = $this->prestaData['Tell'];
			//$params['M'] = $this->prestaData['mail'];  
			
			
			
			$params['act'] = $this->prestaData['Activ']; 
			$params['actT'] = $this->prestaData['Tactiv']; 
			$params['ecar'] = $this->prestaData['ecart'];
			 
			$params['df'] = $this->prestaData['diff'];
			$params['formation_1'] = $this->prestaData['forma_1'];
			$params['formation_2'] = $this->prestaData['forma_2'];
			$params['formation_3'] = $this->prestaData['forma_3'];
			$params['formation_4'] = $this->prestaData['forma_4'];
			$params['formation_5'] = $this->prestaData['forma_5'];
			$params['formation_6'] = $this->prestaData['forma_6'];
			$params['date_reprise_emploi'] = $this->prestaData['date_reprise_emploi'];
			$params['date_cessation_emploi'] = $this->prestaData['date_cessation_emploi'];
			$params['date_suivi_emploi'] = $this->prestaData['date_suivi_emploi'];
			$params['date_entretien_emploi'] = $this->prestaData['date_entretien_emploi'];
			
			
			
			$params['format_1'] = $this->prestaData['form_1'];
			$params['format_2'] = $this->prestaData['form_2'];
			$params['format_3'] = $this->prestaData['form_3'];
			$params['format_4'] = $this->prestaData['form_4'];
			$params['format_5'] = $this->prestaData['form_5'];
			$params['format_6'] = $this->prestaData['form_6'];
			
			//Planification des actions 
			
			$params['atio_1'] = $this->prestaData['fortion_1'];
			$params['atio_2'] = $this->prestaData['fortion_2'];
			$params['atio_3'] = $this->prestaData['fortion_3'];
			$params['atio_4'] = $this->prestaData['fortion_4'];
			$params['atio_5'] = $this->prestaData['fortion_5'];
			$params['atio_6'] = $this->prestaData['fortion_6'];
			
			
			$params['Q_1'] = $this->prestaData['ation_1'];
			$params['Q_2'] = $this->prestaData['ation_2'];
			$params['Q_3'] = $this->prestaData['ation_3'];
			$params['Q_4'] = $this->prestaData['ation_4'];
			$params['Q_5'] = $this->prestaData['ation_5'];
			$params['Q_6'] = $this->prestaData['ation_6'];
			
			
			$params['Qu_1'] = $this->prestaData['Quand_1'];
			$params['Qu_2'] = $this->prestaData['Quand_2'];
			$params['Qu_3'] = $this->prestaData['Quand_3'];
			$params['Qu_4'] = $this->prestaData['Quand_4'];
			$params['Qu_5'] = $this->prestaData['Quand_5'];
			$params['Qu_6'] = $this->prestaData['Quand_6'];
			
			//Éléments-clés de l’entreprise
			
			$params['El_1'] = $this->prestaData['element_1'];
			$params['El_2'] = $this->prestaData['element_2'];
			$params['El_3'] = $this->prestaData['element_3'];
			$params['El_4'] = $this->prestaData['element_4'];
			$params['El_5'] = $this->prestaData['element_5'];
			$params['El_6'] = $this->prestaData['element_6'];
			$params['El_7'] = $this->prestaData['element_7'];
			$params['El_8'] = $this->prestaData['element_8'];
			$params['El_9'] = $this->prestaData['element_9'];
			$params['El_10'] = $this->prestaData['element_10'];
			$params['El_11'] = $this->prestaData['element_11'];
			
			
			$params['Els_1'] = $this->prestaData['elements_1'];
			$params['Els_2'] = $this->prestaData['elements_2'];
			$params['Els_3'] = $this->prestaData['elements_3'];
			$params['Els_4'] = $this->prestaData['elements_4'];
			$params['Els_5'] = $this->prestaData['elements_5'];
			$params['Els_6'] = $this->prestaData['elements_6'];
			$params['Els_7'] = $this->prestaData['elements_7'];
			$params['Els_8'] = $this->prestaData['elements_8'];
			$params['Els_9'] = $this->prestaData['elements_9'];
			$params['Els_10'] = $this->prestaData['elements_10'];
			$params['Els_11'] = $this->prestaData['elements_11'];
			
			
			//Suivi à 3 mois
			$params['obj_1'] = $this->prestaData['Objet_1'];
			$params['obj_2'] = $this->prestaData['Objet_2'];
			$params['obj_3'] = $this->prestaData['Objet_3'];
			$params['obj_4'] = $this->prestaData['Objet_4'];
			$params['obj_5'] = $this->prestaData['Objet_5'];
			$params['obj_6'] = $this->prestaData['Objet_6'];
			$params['obj_7'] = $this->prestaData['Objet_7'];
			$params['obj_8'] = $this->prestaData['Objet_8'];
			
			
			
			$params['prd_1'] = $this->prestaData['prdr_1'];
			$params['prd_2'] = $this->prestaData['prdr_2'];
			$params['prd_3'] = $this->prestaData['prdr_3'];
			$params['prd_4'] = $this->prestaData['prdr_4'];
			$params['prd_5'] = $this->prestaData['prdr_5'];
			$params['prd_6'] = $this->prestaData['prdr_6'];
			$params['prd_7'] = $this->prestaData['prdr_7'];
			$params['prd_8'] = $this->prestaData['prdr_8'];
			
			
			
			$params['ect_1'] = $this->prestaData['Ecart_1'];
			$params['ect_2'] = $this->prestaData['Ecart_2'];
			$params['ect_3'] = $this->prestaData['Ecart_3'];
			$params['ect_4'] = $this->prestaData['Ecart_4'];
			$params['ect_5'] = $this->prestaData['Ecart_5'];
			$params['ect_6'] = $this->prestaData['Ecart_6'];
			$params['ect_7'] = $this->prestaData['Ecart_7'];
			$params['ect_8'] = $this->prestaData['Ecart_8'];
			
			
			
			//Suivi à 6 mois
			$params['objs_1'] = $this->prestaData['bjet_1'];
			$params['objs_2'] = $this->prestaData['bjet_2'];
			$params['objs_3'] = $this->prestaData['bjet_3'];
			$params['objs_4'] = $this->prestaData['bjet_4'];
			$params['objs_5'] = $this->prestaData['bjet_5'];
			$params['objs_6'] = $this->prestaData['bjet_6'];
			$params['objs_7'] = $this->prestaData['bjet_7'];
			$params['objs_8'] = $this->prestaData['bjet_8'];
			
			
			
			$params['Prds_1'] = $this->prestaData['reel_1'];
			$params['Prds_2'] = $this->prestaData['reel_2'];
			$params['Prds_3'] = $this->prestaData['reel_3'];
			$params['Prds_4'] = $this->prestaData['reel_4'];
			$params['Prds_5'] = $this->prestaData['reel_5'];
			$params['Prds_6'] = $this->prestaData['reel_6'];
			$params['Prds_7'] = $this->prestaData['reel_7'];
			$params['Prds_8'] = $this->prestaData['reel_8'];
			
			
			
			$params['ects_1'] = $this->prestaData['Ecarts_1'];
			$params['ects_2'] = $this->prestaData['Ecarts_2'];
			$params['ects_3'] = $this->prestaData['Ecarts_3'];
			$params['ects_4'] = $this->prestaData['Ecarts_4'];
			$params['ects_5'] = $this->prestaData['Ecarts_5'];
			$params['ects_6'] = $this->prestaData['Ecarts_6'];
			$params['ects_7'] = $this->prestaData['Ecarts_7'];
			$params['ects_8'] = $this->prestaData['Ecarts_8'];
			
			
				
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			if($this->prestaData['mois']==0){
					$params['mois3'] = 'X';
					$params['mois6'] = '';
				}
				elseif($this->prestaData['mois']==1){
					$params['mois6'] = 'X';
					$params['mois3'] = '';
			
				}
				else{
					$params['mois3'] = '';
					$params['mois6'] = '';
				
				}
				
				if($this->prestaData['crea']==0){
					$params['crea1'] = 'X';
					$params['crea2'] = '';
				}
				elseif($this->prestaData['crea']==1){
					$params['crea2'] = 'X';
					$params['crea1'] = '';
			
				}
				else{
					$params['crea1'] = '';
					$params['crea2'] = '';
				
				}
				
				if($this->prestaData['cesse']==0){
					$params['cesse1'] = 'X';
					$params['cesse2'] = '';
				}
				elseif($this->prestaData['cesse']==1){
					$params['cesse2'] = 'X';
					$params['cesse1'] = '';
			
				}
				else{
					$params['cesse1'] = '';
					$params['cesse2'] = '';
				
				}
			
			
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q6_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa772/ANNEXE BILAN SUIVI.rtf",$params);
		
		}elseif($annexe==7){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            $params['Ens'] = $this->prestaData['NomEns']; 
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_SUIVI_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/rsa772/couvertures.rtf",$params);
		}
		die();
	}

	public function pdiAction($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		// echo '<pre>'.print_r($this->prestaData, true).'</pre>';
		// echo '<pre>'.print_r($params, true).'</pre>';exit;
		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();

		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			
			
			//if (preg_match( "^\d{1,2}/\d{1,2}/\d{4}$" , $p->getDateFin()))
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			//$params["df"] = $this->prestaEntity->getDateFin();
			
			
			
			$download->setTitle(
			//$nomPresta."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/pdi/emargement.rtf",$params);
		
		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			//$params["da"] = $p->getdateLastModified;
			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
			/*
			echo $p->getDateFin()." 1 <br>";
			//echo $this->prestaEntity->getDateFin()."<br>";
			echo $p->getDateFin()." 2 <br>";
			$dFtemp = $p->getDateDebut();
			echo $dFtemp." 3 <br>";
			if (preg_match("^\d{1,2}/\d{1,2}/\d{4}$",$dFtemp)){ 	
				$params["df"] = $this->prestaEntity->getDateFin();
				echo "<br><br>je suis dans le si <br><br>";
			}
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
				echo "<br><br>je suis dans le Sinon <br><br>";
			}
			
			echo $params["df"];
			exit;
			
			*/
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			
			//$params["df"] = $this->prestaEntity->getDateFin();
			
			
			
			
			
			
			//$params["da"] = $this->prestaEntity->getdateLastModified;
			//$params['db'] = $p->getDateDebut();
			//$params["fax_organisme"] = $this->prestaEntity->getContact()->getFaxOrganisme();
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
			//var_dump($synthese);exit;
			//Debug::dump($synthese);exit;
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
					//print_r($key_id.'_'.$i.' params '.$params[$key_id.'_'.$i].' i '.$i.' params key_id '.$params[$key_id]."\n <br>");
				}
			}
			# Modification Apsie /sadel /2015	
			$init='  ';
			$check='x';
			$params['Orientation_Prestation_M1']=$init;
			$params['Orientation_Prestation_M12']=$init;
			$params['module1_M1']=$init;
			$params['module2_M1']=$init;
			$params['module3_M1']=$init;
			$params['module4_M1']=$init;
			$params['Orientation_Referent_Unique_M1']=$init;
			
			if($params['preconisation']==400){
				$params['Orientation_Prestation_M1']=$check;}
				 elseif ($params['preconisation']==401){
					 $params['Orientation_Prestation_M12']=$check;
				if($params['module1']!='0') $params['module1_M1']=$check;
				if($params['module2']!='0') $params['module2_M1']=$check;
				if($params['module3']!='0') $params['module3_M1']=$check;
				if($params['module3']!='0') $params['module4_M1']=$check;				
			} elseif($params["preconisation"]==402){
				$params["Orientation_Referent_Unique_M1"]=$check;}
				
				
			//exit;
			//Debug::dump($p);exit;
		//var_dump($p);
			
			
			//print_r($params);
			// diagnostic
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			//var_dump($diag);exit;
			foreach($diag as $unused => $key_id){
				//print_r($key_id."          ---             ");
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			    //echo '<pre>'.print_r($params, true).'</pre>';exit;

				//($this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
						
						
						//var_dump($params);exit;
						//exit;
						
						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Module_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/pdi/module_1.rtf",$params);
		
		}elseif($annexe==3){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			//$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			//$params["civilite"]  = $p->getAccount()->getAccountId()->getNPrefix();
			 $params = array_merge($params, $this->prestaData);
			//var_dump($params);exit;
			//$params["civilite"] = $this->prestaEntity->getnPrefix();
			
			
			# Modification Apsie /sadel /2015
			$init='  ';
			$check='x';
			
			$params['Orientation_Prestation']=$init;
			$params['module_1']=$init;
			$params['module_2']=$init;
			$params['module_3']=$init;
			$params['module_4']=$init;
			$params['Orientation_Referent_Unique']=$init;
			
			if($params['preconisation_m2']==401){
				$params['Orientation_Prestation']=$check;
				if($params['module1_m2']!='0') $params['module_1']=$check;
				if($params['module2_m2']!='0') $params['module_2']=$check;
				if($params['module3_m2']!='0') $params['module_3']=$check;
				if($params['module4_m2']!='0') $params['module_4']=$check;				
			}elseif($params["preconisation_m2"]==402){
				$params["Orientation_Referent_Unique"]=$check;
			}
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
			
			
			//$params["df"] = $this->prestaEntity->getDateFin();
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params['sous-titre'] = $this->prestaData['commentaire_pt_fi'];
			//var_dump($this->prestaEntity);exit;
			//Debug::dump($this->prestaEntity);exit;
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			//var_dump($diag);exit;
			foreach($diag as $unused => $key_id){
				//print_r($key_id."          ---             ");
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Module_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/pdi/module_2.rtf",$params);
		}

		die();
	}

	public function aicAction($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();
		//var_dump($params);exit;
		$download = new Download();
		if($annexe==1){
			$params["D_p"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["E_a_p"] = $this->prestaData['etat_avancement_projet'];
			$params['P_e_p_1'] = $this->prestaData['point_evaluer_priorite_1'];
			$params['p_e_p_2'] = $this->prestaData['point_evaluer_priorite_2'];
			$params['p_e_p_3'] = $this->prestaData['point_evaluer_priorite_3'];
			$params['A_b_1'] = $this->prestaData['attente_beneficiaire_1'];
			$params['a_b_2'] = $this->prestaData['attente_beneficiaire_2'];
			$params['a_b_3'] = $this->prestaData['attente_beneficiaire_3'];
			$params['Com'] = $this->prestaData['commentaire_1'];

			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/aic/annexe_1.rtf",$params);
		}elseif($annexe==2){
			#rdv
			$params['dx']="";
			for($i=1;$i<=10;$i++):
			$params['d'.$i]="";
			endfor;

			$rdv = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null,null,$id_presta);
			$params['RDV'] = count($rdv);
			$i = 1;
			foreach ($rdv as $key => $val):
			
			if($i==10)
			$params['dx']= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			else
			$params['d'.($i)]= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			
			$i++;
			endforeach;
			
			# Modification Apsie /sadel /2015
			$params['projet']= $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params['formation_1'] = $this->prestaData['formation_1'];
			$params['formation_2'] = $this->prestaData['formation_2'];
			$params['formation_3'] = $this->prestaData['formation_3'];
			$params['formation_4'] = $this->prestaData['formation_4'];
			$params['capacite_1'] = $this->prestaData['capacite_emploi_1'];
			$params['capacite_2'] = $this->prestaData['capacite_emploi_2'];
			$params['capacite_3'] = $this->prestaData['capacite_emploi_3'];
			$params['capacite_4'] = $this->prestaData['capacite_emploi_4'];
			$params['competence_pro_1'] = $this->prestaData['competence_pro_1'];
			$params['competence_pro_2'] = $this->prestaData['competence_pro_2'];
			$params['competence_pro_3'] = $this->prestaData['competence_pro_3'];
			$params['competence_pro_4'] = $this->prestaData['competence_pro_4'];
			$params['element_porteur_1'] = $this->prestaData['element_porteur_1'];
			$params['element_porteur_2'] = $this->prestaData['element_porteur_2'];
			$params['element_porteur_3'] = $this->prestaData['element_porteur_3'];
			$params['element_porteur_4'] = $this->prestaData['element_porteur_4'];
			$params['point_vigilance_1'] = $this->prestaData['point_vigilance_1'];
			$params['point_vigilance_2'] = $this->prestaData['point_vigilance_2'];
			$params['point_vigilance_3'] = $this->prestaData['point_vigilance_3'];
			$params['point_vigilance_4'] = $this->prestaData['point_vigilance_4'];
			$params['formation_courte_1'] = $this->prestaData['formation_courte_1'];
			$params['formation_courte_2'] = $this->prestaData['formation_courte_2'];
			$params['formation_courte_3'] = $this->prestaData['formation_courte_3'];
			$params['formation_courte_4'] = $this->prestaData['formation_courte_4'];
			$params['competence_1'] = $this->prestaData['competence_1'];
			$params['competence_2'] = $this->prestaData['competence_2'];
			$params['competence_3'] = $this->prestaData['competence_3'];
			$params['competence_4'] = $this->prestaData['competence_4'];
			$params['delai_priorite_1'] = $this->prestaData['delai_priorite_1'];
			$params['delai_priorite_2'] = $this->prestaData['delai_priorite_2'];
			$params['delai_priorite_3'] = $this->prestaData['delai_priorite_3'];
			$params['delai_priorite_4'] = $this->prestaData['delai_priorite_4'];

			$params['commentaire_adequation'] = $this->prestaData['commentaire_adequation'];
			$params['points_forts_clients_1'] = $this->prestaData['points_forts_clients_1'];
			$params['points_forts_clients_2'] = $this->prestaData['points_forts_clients_2'];
			$params['points_forts_clients_3'] = $this->prestaData['points_forts_clients_3'];
			$params['points_forts_clients_4'] = $this->prestaData['points_forts_clients_4'];
			$params['points_faibles_clients_1'] = $this->prestaData['points_faibles_clients_1'];
			$params['points_faibles_clients_2'] = $this->prestaData['points_faibles_clients_2'];
			$params['points_faibles_clients_3'] = $this->prestaData['points_faibles_clients_3'];
			$params['points_faibles_clients_4'] = $this->prestaData['points_faibles_clients_4'];
			$params['points_forts_concurrence_1'] = $this->prestaData['points_forts_concurrence_1'];
			$params['points_forts_concurrence_2'] = $this->prestaData['points_forts_concurrence_2'];
			$params['points_forts_concurrence_3'] = $this->prestaData['points_forts_concurrence_3'];
			$params['points_forts_concurrence_4'] = $this->prestaData['points_forts_concurrence_4'];
			$params['points_faibles_concurrence_1'] = $this->prestaData['points_faibles_concurrence_1'];
			$params['points_faibles_concurrence_2'] = $this->prestaData['points_faibles_concurrence_2'];
			$params['points_faibles_concurrence_3'] = $this->prestaData['points_faibles_concurrence_3'];
			$params['points_faibles_concurrence_4'] = $this->prestaData['points_faibles_concurrence_4'];
			$params['points_forts_strategie_1'] = $this->prestaData['points_forts_strategie_1'];
			$params['points_forts_strategie_2'] = $this->prestaData['points_forts_strategie_2'];
			$params['points_forts_strategie_3'] = $this->prestaData['points_forts_strategie_3'];
			$params['points_forts_strategie_4'] = $this->prestaData['points_forts_strategie_4'];
			$params['points_faibles_strategie_1'] = $this->prestaData['points_faibles_strategie_1'];
			$params['points_faibles_strategie_2'] = $this->prestaData['points_faibles_strategie_2'];
			$params['points_faibles_strategie_3'] = $this->prestaData['points_faibles_strategie_3'];
			$params['points_faibles_strategie_4'] = $this->prestaData['points_faibles_strategie_4'];
			
			
			$params['points_forts_concurrence_au_1'] = $this->prestaData['points_forts_concurrence_au_1'];
			$params['points_forts_concurrence_au_2'] = $this->prestaData['points_forts_concurrence_au_2'];
			$params['points_forts_concurrence_au_3'] = $this->prestaData['points_forts_concurrence_au_3'];
			$params['points_forts_concurrence_au_4'] = $this->prestaData['points_forts_concurrence_au_4'];
			$params['points_faibles_concurrence_au_1'] = $this->prestaData['points_faibles_concurrence_au_1'];
			$params['points_faibles_concurrence_au_2'] = $this->prestaData['points_faibles_concurrence_au_2'];
			$params['points_faibles_concurrence_au_3'] = $this->prestaData['points_faibles_concurrence_au_3'];
			$params['points_faibles_concurrence_au_4'] = $this->prestaData['points_faibles_concurrence_au_4'];
			
			
			
			
			
			$params['com_marche'] = $this->prestaData['commentaire_etude_marche'];
			$params['etude_marche_dp1'] = $this->prestaData['etude_marche_delais_priorite_1'];
			$params['etude_marche_dp2'] = $this->prestaData['etude_marche_delais_priorite_2'];
			$params['etude_marche_dp3'] = $this->prestaData['etude_marche_delais_priorite_3'];
			$params['etude_marche_dp4'] = $this->prestaData['etude_marche_delais_priorite_4'];
			$params['etude_marche_Action_1'] = $this->prestaData['etude_marche_Action_1'];
			$params['etude_marche_Action_2'] = $this->prestaData['etude_marche_Action_2'];
			$params['etude_marche_Action_3'] = $this->prestaData['etude_marche_Action_3'];
			$params['etude_marche_Action_4'] = $this->prestaData['etude_marche_Action_4'];
			$params['etude_marche_resultat_attendu_1'] = $this->prestaData['etude_marche_resultat_attendu_1'];
			$params['etude_marche_resultat_attendu_2'] = $this->prestaData['etude_marche_resultat_attendu_2'];
			$params['etude_marche_resultat_attendu_3'] = $this->prestaData['etude_marche_resultat_attendu_3'];
			$params['etude_marche_resultat_attendu_4'] = $this->prestaData['etude_marche_resultat_attendu_4'];
			$params['fi_pt_forts_1'] = $this->prestaData['fi_pt_forts_1'];
			$params['fi_pt_forts_2'] = $this->prestaData['fi_pt_forts_2'];
			$params['fi_pt_forts_3'] = $this->prestaData['fi_pt_forts_3'];
			$params['fi_pt_forts_4'] = $this->prestaData['fi_pt_forts_4'];
			$params['fi_pt_faibles_1'] = $this->prestaData['fi_pt_faibles_1'];
			$params['fi_pt_faibles_2'] = $this->prestaData['fi_pt_faibles_2'];
			$params['fi_pt_faibles_3'] = $this->prestaData['fi_pt_faibles_3'];
			$params['fi_pt_faibles_4'] = $this->prestaData['fi_pt_faibles_4'];
			$params['fi_pt_forts_mort_1'] = $this->prestaData['fi_pt_forts_mort_1'];
			$params['fi_pt_forts_mort_2'] = $this->prestaData['fi_pt_forts_mort_2'];
			$params['fi_pt_forts_mort_3'] = $this->prestaData['fi_pt_forts_mort_3'];
			$params['fi_pt_forts_mort_4'] = $this->prestaData['fi_pt_forts_mort_4'];
			$params['fai_mort_1'] = $this->prestaData['fi_pt_faibles_mort_1'];
			$params['fai_mort_2'] = $this->prestaData['fi_pt_faibles_mort_2'];
			$params['fai_mort_3'] = $this->prestaData['fi_pt_faibles_mort_3'];
			$params['fai_mort_4'] = $this->prestaData['fi_pt_faibles_mort_4'];
			$params['fi_pt_forts_pfi_1'] = $this->prestaData['fi_pt_forts_pfi_1'];
			$params['fi_pt_forts_pfi_2'] = $this->prestaData['fi_pt_forts_pfi_2'];
			$params['fi_pt_forts_pfi_3'] = $this->prestaData['fi_pt_forts_pfi_3'];
			$params['fi_pt_forts_pfi_4'] = $this->prestaData['fi_pt_forts_pfi_4'];
			$params['fi_pt_faibles_pfi_1'] = $this->prestaData['fi_pt_faibles_pfi_1'];
			$params['fi_pt_faibles_pfi_2'] = $this->prestaData['fi_pt_faibles_pfi_2'];
			$params['fi_pt_faibles_pfi_3'] = $this->prestaData['fi_pt_faibles_pfi_3'];
			$params['fi_pt_faibles_pfi_4'] = $this->prestaData['fi_pt_faibles_pfi_4'];
			$params['pf3_1'] = $this->prestaData['fi_pt_forts_pf3_1'];
			$params['pf3_2'] = $this->prestaData['fi_pt_forts_pf3_2'];
			$params['pf3_3'] = $this->prestaData['fi_pt_forts_pf3_3'];
			$params['pf3_4'] = $this->prestaData['fi_pt_forts_pf3_4'];
			$params['fi_pt_faibles_pf3_1'] = $this->prestaData['fi_pt_faibles_pf3_1'];
			$params['fi_pt_faibles_pf3_2'] = $this->prestaData['fi_pt_faibles_pf3_2'];
			$params['fi_pt_faibles_pf3_3'] = $this->prestaData['fi_pt_faibles_pf3_3'];
			$params['fi_pt_faibles_pf3_4'] = $this->prestaData['fi_pt_faibles_pf3_4'];
			$params['fi_delais_priorite_1'] = $this->prestaData['fi_delais_priorite_1'];
			$params['fi_delais_priorite_2'] = $this->prestaData['fi_delais_priorite_2'];
			$params['fi_delais_priorite_3'] = $this->prestaData['fi_delais_priorite_3'];
			$params['fi_delais_priorite_4'] = $this->prestaData['fi_delais_priorite_4'];
			$params['fi_Action_1'] = $this->prestaData['fi_Action_1'];
			$params['fi_Action_2'] = $this->prestaData['fi_Action_2'];
			$params['fi_Action_3'] = $this->prestaData['fi_Action_3'];
			$params['fi_Action_4'] = $this->prestaData['fi_Action_4'];
			$params['fi_resultat_attendu_1'] = $this->prestaData['fi_resultat_attendu_1'];
			$params['fi_resultat_attendu_2'] = $this->prestaData['fi_resultat_attendu_2'];
			$params['fi_resultat_attendu_3'] = $this->prestaData['fi_resultat_attendu_3'];
			$params['fi_resultat_attendu_4'] = $this->prestaData['fi_resultat_attendu_4'];
			$params['commentaire_fi'] = $this->prestaData['commentaire_pt_fi'];
			$params['sj_pt_forts_1'] = $this->prestaData['sj_pt_forts_juridique_1'];
			$params['sj_pt_forts_2'] = $this->prestaData['sj_pt_forts_juridique_2'];
			$params['sj_pt_forts_3'] = $this->prestaData['sj_pt_forts_juridique_3'];
			$params['sj_pt_forts_4'] = $this->prestaData['sj_pt_forts_juridique_4'];
			$params['sj_pt_faibles_1'] = $this->prestaData['sj_pt_faibles_juridique_1'];
			$params['sj_pt_faibles_2'] = $this->prestaData['sj_pt_faibles_juridique_2'];
			$params['sj_pt_faibles_3'] = $this->prestaData['sj_pt_faibles_juridique_3'];
			$params['sj_pt_faibles_4'] = $this->prestaData['sj_pt_faibles_juridique_4'];
			$params['sj_Action_1'] = $this->prestaData['sj_Action_1'];
			$params['sj_Action_2'] = $this->prestaData['sj_Action_2'];
			$params['sj_Action_3'] = $this->prestaData['sj_Action_3'];
			$params['sj_Action_4'] = $this->prestaData['sj_Action_4'];
			$params['sj_resultat_attendu_1'] = $this->prestaData['sj_resultat_attendu_1'];
			$params['sj_resultat_attendu_2'] = $this->prestaData['sj_resultat_attendu_2'];
			$params['sj_resultat_attendu_3'] = $this->prestaData['sj_resultat_attendu_3'];
			$params['sj_resultat_attendu_4'] = $this->prestaData['sj_resultat_attendu_4'];
			$params['sj_delais_priorite_1'] = $this->prestaData['sj_delais_priorite_1'];
			$params['sj_delais_priorite_2'] = $this->prestaData['sj_delais_priorite_2'];
			$params['sj_delais_priorite_3'] = $this->prestaData['sj_delais_priorite_3'];
			$params['sj_delais_priorite_4'] = $this->prestaData['sj_delais_priorite_4'];
			$params['commentaire_ju'] = $this->prestaData['commentaire_sj'];

			# Modification Apsie /sadel /2015
			$params['com_estimation_cp'] = $this->prestaData['com_estimation_cp'];	
				
			$params['fi_pt_forts_pfi_au_1'] = $this->prestaData['fi_pt_forts_pfi_au_1'];
			$params['fi_pt_forts_pfi_au_2'] = $this->prestaData['fi_pt_forts_pfi_au_2'];
			$params['fi_pt_forts_pfi_au_3'] = $this->prestaData['fi_pt_forts_pfi_au_3'];
			$params['fi_pt_forts_pfi_au_4'] = $this->prestaData['fi_pt_forts_pfi_au_4'];
			$params['fi_pt_faibles_pfi_au_1'] = $this->prestaData['fi_pt_faibles_pfi_au_1'];
			$params['fi_pt_faibles_pfi_au_2'] = $this->prestaData['fi_pt_faibles_pfi_au_2'];
			$params['fi_pt_faibles_pfi_au_3'] = $this->prestaData['fi_pt_faibles_pfi_au_3'];
			$params['fi_pt_faibles_pfi_au_4'] = $this->prestaData['fi_pt_faibles_pfi_au_4'];
				
				
				
				
			$params['commentaire_faisabilite'] = $this->prestaData['com_faisabilite'];
			$params['commentaire_estimation'] = $this->prestaData['com_estimation'];
			$params['com_solution'] = $this->prestaData['com_solution'];
			$params['b_com_ref'] = $this->prestaData['bilan_com_referent'];
			$params['b_beneficiaire'] = $this->prestaData['bilan_com_beneficiaire'];

			$params['Solution_alt']="  ";
			$params['P_oui'] = '  ';
			$params['P_non'] = '  ';
			if($this->prestaData['com_solution']!=null)
			$params['Solution_alt'] = 'X';
			
			if($this->prestaData['faisabilite']==2 || $this->prestaData['faisabilite']==3)
			{
			$params['P_oui'] = 'X';
			$params['P_non'] = '  ';
			}
			elseif($this->prestaData['faisabilite']==1)
			{
			$params['P_oui'] = '  ';
			$params['P_non'] = 'X';
			}
			
			$params['fai_negatif'] = '  ';
			$params['fai_positif_reserve'] = '  ';
			$params['fai_positif'] = '  ';
			$params['estimation_un'] = '  ';
			$params['estimation_six'] = '  ';
			$params['estimation_trois'] = '  ';
			if($this->prestaData['faisabilite']==1)
			$params['fai_negatif'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['fai_positif_reserve'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['fai_positif'] = 'X';
			
			
			if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['estimation']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['estimation']==3)
			$params['estimation_trois'] = 'X';
			
			
			
			
			
			
			/*if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['estimation_trois'] = 'X';*/
				
				
			


			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPreNom());
			$download->get(getcwd()."/bundles/lea/doc/aic/annexe_2.rtf",$params);
			//$download->get("./doc/opcrea/annexe_2_.rtf",$params);
		}
		die();
		
	}

	public function epceAction($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();
		 //var_dump($params);exit;
		
		# Modification Apsie /sadel /2015
		$download = new Download();
		if($annexe==1)
		{
			$params["D_p"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["E_a_p"] = $this->prestaData['etat_avancement_projet'];
			$params['P_e_p_1'] = $this->prestaData['point_evaluer_priorite_1'];
			$params['p_e_p_2'] = $this->prestaData['point_evaluer_priorite_2'];
			$params['p_e_p_3'] = $this->prestaData['point_evaluer_priorite_3'];
			$params['A_b_1'] = $this->prestaData['attente_beneficiaire_1'];
			$params['a_b_2'] = $this->prestaData['attente_beneficiaire_2'];
			$params['a_b_3'] = $this->prestaData['attente_beneficiaire_3'];
			$params['Com'] = $this->prestaData['commentaire_1'];

			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/epce/annexe_1.rtf",$params);
		}
		elseif($annexe==2)
		{
			#rdv
			$params['dx']="";
			for($i=1;$i<=10;$i++):
			$params['d'.$i]="";
			endfor;

			$rdv = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwCal')->getRdv(null,null,$id_presta);
			$params['RDV'] = count($rdv);
			$i = 1;
			foreach ($rdv as $key => $val):
			
			if($i==10)
			$params['dx']= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			else
			$params['d'.($i)]= date('dmy',$val->getEgwCalIdDates()->getCalStart());
			
			$i++;
			endforeach;
			# Modification Apsie /sadel /2015
			$params["D_p"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["E_a_p"] = $this->prestaData['etat_avancement_projet'];
			$params['P_e_p_1'] = $this->prestaData['point_evaluer_priorite_1'];
			$params['p_e_p_2'] = $this->prestaData['point_evaluer_priorite_2'];
			$params['p_e_p_3'] = $this->prestaData['point_evaluer_priorite_3'];
			$params['A_b_1'] = $this->prestaData['attente_beneficiaire_1'];
			$params['a_b_2'] = $this->prestaData['attente_beneficiaire_2'];
			$params['a_b_3'] = $this->prestaData['attente_beneficiaire_3'];
			$params['Com'] = $this->prestaData['commentaire_1'];
			
			
						
			# Modification Apsie /sadel /2015
			
			//$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params['commentaire_adequation']= $this->prestaData['commentaire_adequation'];
			$params['formation_1'] = $this->prestaData['formation_1'];
			$params['formation_2'] = $this->prestaData['formation_2'];
			$params['formation_3'] = $this->prestaData['formation_3'];
			$params['formation_4'] = $this->prestaData['formation_4'];
			$params['capacite_1'] = $this->prestaData['capacite_emploi_1'];
			$params['capacite_2'] = $this->prestaData['capacite_emploi_2'];
			$params['capacite_3'] = $this->prestaData['capacite_emploi_3'];
			$params['capacite_4'] = $this->prestaData['capacite_emploi_4'];
			$params['competence_pro_1'] = $this->prestaData['competence_pro_1'];
			$params['competence_pro_2'] = $this->prestaData['competence_pro_2'];
			$params['competence_pro_3'] = $this->prestaData['competence_pro_3'];
			$params['competence_pro_4'] = $this->prestaData['competence_pro_4'];
			$params['element_porteur_1'] = $this->prestaData['element_porteur_1'];
			$params['element_porteur_2'] = $this->prestaData['element_porteur_2'];
			$params['element_porteur_3'] = $this->prestaData['element_porteur_3'];
			$params['element_porteur_4'] = $this->prestaData['element_porteur_4'];
			$params['point_vigilance_1'] = $this->prestaData['point_vigilance_1'];
			$params['point_vigilance_2'] = $this->prestaData['point_vigilance_2'];
			$params['point_vigilance_3'] = $this->prestaData['point_vigilance_3'];
			$params['point_vigilance_4'] = $this->prestaData['point_vigilance_4'];
			$params['formation_courte_1'] = $this->prestaData['formation_courte_1'];
			$params['formation_courte_2'] = $this->prestaData['formation_courte_2'];
			$params['formation_courte_3'] = $this->prestaData['formation_courte_3'];
			$params['formation_courte_4'] = $this->prestaData['formation_courte_4'];
			$params['competence_1'] = $this->prestaData['competence_1'];
			$params['competence_2'] = $this->prestaData['competence_2'];
			$params['competence_3'] = $this->prestaData['competence_3'];
			$params['competence_4'] = $this->prestaData['competence_4'];
			$params['delai_priorite_1'] = $this->prestaData['delai_priorite_1'];
			$params['delai_priorite_2'] = $this->prestaData['delai_priorite_2'];
			$params['delai_priorite_3'] = $this->prestaData['delai_priorite_3'];
			$params['delai_priorite_4'] = $this->prestaData['delai_priorite_4'];
			$params['commentaire_adequation'] = $this->prestaData['commentaire_adequation'];
			$params['points_forts_clients_1'] = $this->prestaData['points_forts_clients_1'];
			$params['points_forts_clients_2'] = $this->prestaData['points_forts_clients_2'];
			$params['points_forts_clients_3'] = $this->prestaData['points_forts_clients_3'];
			$params['points_forts_clients_4'] = $this->prestaData['points_forts_clients_4'];
			$params['points_faibles_clients_1'] = $this->prestaData['points_faibles_clients_1'];
			$params['points_faibles_clients_2'] = $this->prestaData['points_faibles_clients_2'];
			$params['points_faibles_clients_3'] = $this->prestaData['points_faibles_clients_3'];
			$params['points_faibles_clients_4'] = $this->prestaData['points_faibles_clients_4'];
			$params['points_forts_concurrence_1'] = $this->prestaData['points_forts_concurrence_1'];
			$params['points_forts_concurrence_2'] = $this->prestaData['points_forts_concurrence_2'];
			$params['points_forts_concurrence_3'] = $this->prestaData['points_forts_concurrence_3'];
			$params['points_forts_concurrence_4'] = $this->prestaData['points_forts_concurrence_4'];
			$params['points_faibles_concurrence_1'] = $this->prestaData['points_faibles_concurrence_1'];
			$params['points_faibles_concurrence_2'] = $this->prestaData['points_faibles_concurrence_2'];
			$params['points_faibles_concurrence_3'] = $this->prestaData['points_faibles_concurrence_3'];
			$params['points_faibles_concurrence_4'] = $this->prestaData['points_faibles_concurrence_4'];
			$params['points_forts_strategie_1'] = $this->prestaData['points_forts_strategie_1'];
			$params['points_forts_strategie_2'] = $this->prestaData['points_forts_strategie_2'];
			$params['points_forts_strategie_3'] = $this->prestaData['points_forts_strategie_3'];
			$params['points_forts_strategie_4'] = $this->prestaData['points_forts_strategie_4'];
			$params['points_faibles_strategie_1'] = $this->prestaData['points_faibles_strategie_1'];
			$params['points_faibles_strategie_2'] = $this->prestaData['points_faibles_strategie_2'];
			$params['points_faibles_strategie_3'] = $this->prestaData['points_faibles_strategie_3'];
			$params['points_faibles_strategie_4'] = $this->prestaData['points_faibles_strategie_4'];
			
			
			$params['points_forts_concurrence_au_1'] = $this->prestaData['points_forts_concurrence_au_1'];
			$params['points_forts_concurrence_au_2'] = $this->prestaData['points_forts_concurrence_au_2'];
			$params['points_forts_concurrence_au_3'] = $this->prestaData['points_forts_concurrence_au_3'];
			$params['points_forts_concurrence_au_4'] = $this->prestaData['points_forts_concurrence_au_4'];
			$params['points_faibles_concurrence_au_1'] = $this->prestaData['points_faibles_concurrence_au_1'];
			$params['points_faibles_concurrence_au_2'] = $this->prestaData['points_faibles_concurrence_au_2'];
			$params['points_faibles_concurrence_au_3'] = $this->prestaData['points_faibles_concurrence_au_3'];
			$params['points_faibles_concurrence_au_4'] = $this->prestaData['points_faibles_concurrence_au_4'];
			
			
		# Modification Apsie /sadel /2015	
			
			
			
			$params['com_marche'] = $this->prestaData['commentaire_etude_marche'];
			$params['etude_marche_dp1'] = $this->prestaData['etude_marche_delais_priorite_1'];
			$params['etude_marche_dp2'] = $this->prestaData['etude_marche_delais_priorite_2'];
			$params['etude_marche_dp3'] = $this->prestaData['etude_marche_delais_priorite_3'];
			$params['etude_marche_dp4'] = $this->prestaData['etude_marche_delais_priorite_4'];
			$params['etude_marche_Action_1'] = $this->prestaData['etude_marche_Action_1'];
			$params['etude_marche_Action_2'] = $this->prestaData['etude_marche_Action_2'];
			$params['etude_marche_Action_3'] = $this->prestaData['etude_marche_Action_3'];
			$params['etude_marche_Action_4'] = $this->prestaData['etude_marche_Action_4'];
			$params['etude_marche_resultat_attendu_1'] = $this->prestaData['etude_marche_resultat_attendu_1'];
			$params['etude_marche_resultat_attendu_2'] = $this->prestaData['etude_marche_resultat_attendu_2'];
			$params['etude_marche_resultat_attendu_3'] = $this->prestaData['etude_marche_resultat_attendu_3'];
			$params['etude_marche_resultat_attendu_4'] = $this->prestaData['etude_marche_resultat_attendu_4'];
			$params['fi_pt_forts_1'] = $this->prestaData['fi_pt_forts_1'];
			$params['fi_pt_forts_2'] = $this->prestaData['fi_pt_forts_2'];
			$params['fi_pt_forts_3'] = $this->prestaData['fi_pt_forts_3'];
			$params['fi_pt_forts_4'] = $this->prestaData['fi_pt_forts_4'];
			$params['fi_pt_faibles_1'] = $this->prestaData['fi_pt_faibles_1'];
			$params['fi_pt_faibles_2'] = $this->prestaData['fi_pt_faibles_2'];
			$params['fi_pt_faibles_3'] = $this->prestaData['fi_pt_faibles_3'];
			$params['fi_pt_faibles_4'] = $this->prestaData['fi_pt_faibles_4'];
			$params['fi_pt_forts_mort_1'] = $this->prestaData['fi_pt_forts_mort_1'];
			$params['fi_pt_forts_mort_2'] = $this->prestaData['fi_pt_forts_mort_2'];
			$params['fi_pt_forts_mort_3'] = $this->prestaData['fi_pt_forts_mort_3'];
			$params['fi_pt_forts_mort_4'] = $this->prestaData['fi_pt_forts_mort_4'];
			$params['fai_mort_1'] = $this->prestaData['fi_pt_faibles_mort_1'];
			$params['fai_mort_2'] = $this->prestaData['fi_pt_faibles_mort_2'];
			$params['fai_mort_3'] = $this->prestaData['fi_pt_faibles_mort_3'];
			$params['fai_mort_4'] = $this->prestaData['fi_pt_faibles_mort_4'];
			$params['fi_pt_forts_pfi_1'] = $this->prestaData['fi_pt_forts_pfi_1'];
			$params['fi_pt_forts_pfi_2'] = $this->prestaData['fi_pt_forts_pfi_2'];
			$params['fi_pt_forts_pfi_3'] = $this->prestaData['fi_pt_forts_pfi_3'];
			$params['fi_pt_forts_pfi_4'] = $this->prestaData['fi_pt_forts_pfi_4'];
			$params['fi_pt_faibles_pfi_1'] = $this->prestaData['fi_pt_faibles_pfi_1'];
			$params['fi_pt_faibles_pfi_2'] = $this->prestaData['fi_pt_faibles_pfi_2'];
			$params['fi_pt_faibles_pfi_3'] = $this->prestaData['fi_pt_faibles_pfi_3'];
			$params['fi_pt_faibles_pfi_4'] = $this->prestaData['fi_pt_faibles_pfi_4'];
			$params['pf3_1'] = $this->prestaData['fi_pt_forts_pf3_1'];
			$params['pf3_2'] = $this->prestaData['fi_pt_forts_pf3_2'];
			$params['pf3_3'] = $this->prestaData['fi_pt_forts_pf3_3'];
			$params['pf3_4'] = $this->prestaData['fi_pt_forts_pf3_4'];
			$params['fi_pt_faibles_pf3_1'] = $this->prestaData['fi_pt_faibles_pf3_1'];
			$params['fi_pt_faibles_pf3_2'] = $this->prestaData['fi_pt_faibles_pf3_2'];
			$params['fi_pt_faibles_pf3_3'] = $this->prestaData['fi_pt_faibles_pf3_3'];
			$params['fi_pt_faibles_pf3_4'] = $this->prestaData['fi_pt_faibles_pf3_4'];
			$params['fi_delais_priorite_1'] = $this->prestaData['fi_delais_priorite_1'];
			$params['fi_delais_priorite_2'] = $this->prestaData['fi_delais_priorite_2'];
			$params['fi_delais_priorite_3'] = $this->prestaData['fi_delais_priorite_3'];
			$params['fi_delais_priorite_4'] = $this->prestaData['fi_delais_priorite_4'];
			$params['fi_Action_1'] = $this->prestaData['fi_Action_1'];
			$params['fi_Action_2'] = $this->prestaData['fi_Action_2'];
			$params['fi_Action_3'] = $this->prestaData['fi_Action_3'];
			$params['fi_Action_4'] = $this->prestaData['fi_Action_4'];
			$params['fi_resultat_attendu_1'] = $this->prestaData['fi_resultat_attendu_1'];
			$params['fi_resultat_attendu_2'] = $this->prestaData['fi_resultat_attendu_2'];
			$params['fi_resultat_attendu_3'] = $this->prestaData['fi_resultat_attendu_3'];
			$params['fi_resultat_attendu_4'] = $this->prestaData['fi_resultat_attendu_4'];
			$params['commentaire_fi'] = $this->prestaData['commentaire_pt_fi'];
			$params['sj_pt_forts_1'] = $this->prestaData['sj_pt_forts_juridique_1'];
			$params['sj_pt_forts_2'] = $this->prestaData['sj_pt_forts_juridique_2'];
			$params['sj_pt_forts_3'] = $this->prestaData['sj_pt_forts_juridique_3'];
			$params['sj_pt_forts_4'] = $this->prestaData['sj_pt_forts_juridique_4'];
			$params['sj_pt_faibles_1'] = $this->prestaData['sj_pt_faibles_juridique_1'];
			$params['sj_pt_faibles_2'] = $this->prestaData['sj_pt_faibles_juridique_2'];
			$params['sj_pt_faibles_3'] = $this->prestaData['sj_pt_faibles_juridique_3'];
			$params['sj_pt_faibles_4'] = $this->prestaData['sj_pt_faibles_juridique_4'];
			$params['sj_Action_1'] = $this->prestaData['sj_Action_1'];
			$params['sj_Action_2'] = $this->prestaData['sj_Action_2'];
			$params['sj_Action_3'] = $this->prestaData['sj_Action_3'];
			$params['sj_Action_4'] = $this->prestaData['sj_Action_4'];
			$params['sj_resultat_attendu_1'] = $this->prestaData['sj_resultat_attendu_1'];
			$params['sj_resultat_attendu_2'] = $this->prestaData['sj_resultat_attendu_2'];
			$params['sj_resultat_attendu_3'] = $this->prestaData['sj_resultat_attendu_3'];
			$params['sj_resultat_attendu_4'] = $this->prestaData['sj_resultat_attendu_4'];
			$params['sj_delais_priorite_1'] = $this->prestaData['sj_delais_priorite_1'];
			$params['sj_delais_priorite_2'] = $this->prestaData['sj_delais_priorite_2'];
			$params['sj_delais_priorite_3'] = $this->prestaData['sj_delais_priorite_3'];
			$params['sj_delais_priorite_4'] = $this->prestaData['sj_delais_priorite_4'];
			$params['commentaire_ju'] = $this->prestaData['commentaire_sj'];

			# Modification Apsie /sadel /2015
			
			$params['delai_priorite_cp_1'] = $this->prestaData['delai_priorite_cp_1'];
			$params['delai_priorite_cp_2'] = $this->prestaData['delai_priorite_cp_2'];
			$params['delai_priorite_cp_3'] = $this->prestaData['delai_priorite_cp_3'];
			$params['delai_priorite_cp_4'] = $this->prestaData['delai_priorite_cp_4'];
			$params['delai_priorite_cp_5'] = $this->prestaData['delai_priorite_cp_5'];
			
			$params['sj_Action_cp_1'] = $this->prestaData['sj_Action_cp_1'];
			$params['sj_Action_cp_2'] = $this->prestaData['sj_Action_cp_2'];
			$params['sj_Action_cp_3'] = $this->prestaData['sj_Action_cp_3'];
			$params['sj_Action_cp_4'] = $this->prestaData['sj_Action_cp_4'];
			$params['sj_Action_cp_5'] = $this->prestaData['sj_Action_cp_5'];
			
			$params['sj_resultat_attendu_cp_1'] = $this->prestaData['sj_resultat_attendu_cp_1'];
			$params['sj_resultat_attendu_cp_2'] = $this->prestaData['sj_resultat_attendu_cp_2'];
			$params['sj_resultat_attendu_cp_3'] = $this->prestaData['sj_resultat_attendu_cp_3'];
			$params['sj_resultat_attendu_cp_4'] = $this->prestaData['sj_resultat_attendu_cp_4'];
			$params['sj_resultat_attendu_cp_5'] = $this->prestaData['sj_resultat_attendu_cp_5'];
			
			$params['com_estimation_cp'] = $this->prestaData['com_estimation_cp'];	

			
			$params['fi_pt_forts_pfi_au_1'] = $this->prestaData['fi_pt_forts_pfi_au_1'];
			$params['fi_pt_forts_pfi_au_2'] = $this->prestaData['fi_pt_forts_pfi_au_2'];
			$params['fi_pt_forts_pfi_au_3'] = $this->prestaData['fi_pt_forts_pfi_au_3'];
			$params['fi_pt_forts_pfi_au_4'] = $this->prestaData['fi_pt_forts_pfi_au_4'];
			$params['fi_pt_faibles_pfi_au_1'] = $this->prestaData['fi_pt_faibles_pfi_au_1'];
			$params['fi_pt_faibles_pfi_au_2'] = $this->prestaData['fi_pt_faibles_pfi_au_2'];
			$params['fi_pt_faibles_pfi_au_3'] = $this->prestaData['fi_pt_faibles_pfi_au_3'];
			$params['fi_pt_faibles_pfi_au_4'] = $this->prestaData['fi_pt_faibles_pfi_au_4'];
			
			 		
			# Modification Apsie /sadel /2015
			
			
			$params['commentaire_faisabilite'] = $this->prestaData['com_faisabilite'];
			$params['commentaire_estimation'] = $this->prestaData['com_estimation'];
			$params['com_solution'] = $this->prestaData['com_solution'];
			$params['b_com_ref'] = $this->prestaData['bilan_com_referent'];
			$params['b_beneficiaire'] = $this->prestaData['bilan_com_beneficiaire'];

			$params['Solution_alt']="  ";
			$params['P_oui'] = '  ';
			$params['P_non'] = '  ';
			if($this->prestaData['com_solution']!=null)
			$params['Solution_alt'] = 'X';
			
			if($this->prestaData['faisabilite']==2 || $this->prestaData['faisabilite']==3)
			{
			$params['P_oui'] = 'X';
			$params['P_non'] = '  ';
			}
			elseif($this->prestaData['faisabilite']==1)
			{
			$params['P_oui'] = '  ';
			$params['P_non'] = 'X';
			}
			
			$params['fai_negatif'] = '  ';
			$params['fai_positif_reserve'] = '  ';
			$params['fai_positif'] = '  ';
			$params['estimation_un'] = '  ';
			$params['estimation_six'] = '  ';
			$params['estimation_trois'] = '  ';
			if($this->prestaData['faisabilite']==1)
			$params['fai_negatif'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['fai_positif_reserve'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['fai_positif'] = 'X';
			
			# Modification Apsie /sadel /2015
			if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['estimation']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['estimation']==3)
			$params['estimation_trois'] = 'X';
			
			
			
			
			
			
			/*if($this->prestaData['estimation']==1)
			$params['estimation_un'] = 'X';
			elseif($this->prestaData['faisabilite']==2)
			$params['estimation_six'] = 'X';
			elseif($this->prestaData['faisabilite']==3)
			$params['estimation_trois'] = 'X';*/
				
				
			


			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_annexe_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPreNom());
			$download->get(getcwd()."/bundles/lea/doc/epce/annexe_2.rtf",$params);
			//$download->get("./doc/opcrea/annexe_2_.rtf",$params);
		}
		elseif($annexe==3)
		{
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			
			
			//if (preg_match( "^\d{1,2}/\d{1,2}/\d{4}$" , $p->getDateFin()))
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			//$params["df"] = $this->prestaEntity->getDateFin();
			
			
			
			$download->setTitle(
			//$nomPresta."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/epce/annexe_3.rtf",$params);
		}
		die();
		
	}

	//Test cd771 sadel 2016 // Modifications AT 2018
	public function cd1Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		
				 		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
        
		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			
			
			
			 
			 
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
					 
			
			$params['sous-titre'] = $this->prestaData['commentaire_pt_fi'];
			 
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Contrat_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/contrat_lot1.rtf",$params);


		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			
			$download->setTitle(
			
			
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/cd771/emargement_lot1.rtf",$params);

		}elseif($annexe==3){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			 			
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
				
			 
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
		
			//echo '<pre>'.print_r($p, true).'</pre>';exit;
			//Debug::dump($synthese);exit;
			//var_dump($synthese);
			 
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
			
			
			// Diagnostic
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			 
			//Debug::dump($synthese);Debug::dump($diag);exit; 
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			    if($this->prestaData['estimation']==1){
					$params['estimation_un'] = 'X';
					$params['estimation_six'] = '';
				}
				elseif($this->prestaData['estimation']==2){
					$params['estimation_six'] = 'X';
					$params['estimation_un'] = '';
			
				}
				else{
					$params['estimation_un'] = '';
					$params['estimation_six'] = '';
				
				}
			 
			
						
						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_1_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/cd771/Bilan_d'evaluation_lot1.rtf",$params);
				

		}elseif($annexe==4){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_commerciale_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_commerciale.rtf",$params);



		}elseif($annexe==5){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }

			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_financiere_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_financière.rtf",$params);


		}elseif($annexe==6){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_fiscale_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_fiscale.rtf",$params);



		}elseif($annexe==7){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_juridique_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_juridique.rtf",$params);


		}elseif($annexe==8){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_organisationnelle_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_organisationnelle.rtf",$params);


		}elseif($annexe==9){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Analyse_sociale_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Analyse_sociale.rtf",$params);


		}elseif($annexe==10){
            $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
		    }
			 
			 
		 	$params = array_merge($params, $this->prestaData);
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
			switch ($params["civilite"]) {
				case 'Monsieur':
					$params['sexe'] = 'Masculin';
					break;
				case ($params['civilite'] == 'Madame' || $params['civilite'] == 'Mademoiselle'):
					$params['sexe'] = 'Féminin';
					break;
				default:
					$params['sexe'] = '';
					break;
			}

//			try {
//				$etatCivil = $this->prestaEntity->getEtatCivil();
//
//				$params["lieu_naissance"] = $etatCivil->getLieuNaissance();
//			 	$params["date_naissance"] = Date("d/m/Y", $etatCivil->getDateNaissance());
//			}catch (\Doctrine\ORM\EntityNotFoundException $e) {
//			    $etatCivil = null;
//			    //$params['lieu_naissance'] = '';
//			    //$params['date_naissance'] = '';
//			}
//
//

			// Cases à cocher questionnaire FSE Q1
			for ($i=0; $i <= 5; $i++) { 
				$params['fse_q1_'.$i] = '  ';
				if($params['fse_q1'] == $i){
					$params['fse_q1_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1activite
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1activite'.$i] = '  ';
				if($params['fse_q1activite'] == $i){
					$params['fse_q1activite'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1mois
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1mois'.$i] = '  ';
				if($params['fse_q1mois'] == $i){
					$params['fse_q1mois'.$i] = 'X';
				}
			}



			// Cases à cocher questionnaire FSE Q1e
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1e_'.$i] = '  ';
				if($params['fse_q1e'] == $i){
					$params['fse_q1e_'.$i] = 'X';
				}
			}

			// Cases à cocher questionnaire FSE Q1f
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q1f_'.$i] = '  ';
				if($params['fse_q1f'] == $i){
					$params['fse_q1f_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q1activite
			    if($this->prestaData['fse_q1activite']==1){
					$params['fse_q1activite'] = 'X';

				}

				else{
					$params['fse_q1activite'] = '';
				
				}


			// Cases à cocher questionnaire FSE Q1gmois
			    if($this->prestaData['fse_q1gmois']==1){
					$params['fse_q1gmois'] = 'X';

				}

				else{
					$params['fse_q1gmois'] = '';
				
				}




			// Cases à cocher questionnaire FSE Q2
			for ($i=0; $i <= 4; $i++) { 
				$params['fse_q2_'.$i] = '  ';
				if($params['fse_q2'] == $i){
					$params['fse_q2_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3a
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3a_'.$i] = '  ';
				if($params['fse_q3a'] == $i){
					$params['fse_q3a_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3b
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3b_'.$i] = '  ';
				if($params['fse_q3b'] == $i){
					$params['fse_q3b_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q3c
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q3c_'.$i] = '  ';
				if($params['fse_q3c'] == $i){
					$params['fse_q3c_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q4
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q4_'.$i] = '  ';
				if($params['fse_q4'] == $i){
					$params['fse_q4_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q5
			for ($i=0; $i <= 2; $i++) { 
				$params['fse_q5_'.$i] = '  ';
				if($params['fse_q5'] == $i){
					$params['fse_q5_'.$i] = 'X';
				}
			}



			// Cases à cocher questionnaire FSE Q6
			for ($i=0; $i <= 3; $i++) { 
				$params['fse_q6_'.$i] = '  ';
				if($params['fse_q6'] == $i){
					$params['fse_q6_'.$i] = 'X';
				}
			}


			// Cases à cocher questionnaire FSE Q7
			for ($i=0; $i <= 3; $i++) { 
				$params['fse_q7_'.$i] = '  ';
				if($params['fse_q7'] == $i){
					$params['fse_q7_'.$i] = 'X';
				}
			}





/*
			// Cases à cocher
			for ($i=0; $i <= 5; $i++) { 
				$params['fse_q1_'.$i] = '  ';
				if($params['fse_q1'] == $i){
					$params['fse_q1_'.$i] = 'X';
				}
			}


*/



			
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Quest_FSE_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
            $download->get(getcwd()."/bundles/lea/doc/cd771/Questionnaire_FSE_lot1.rtf",$params);
		}elseif($annexe==11){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Quest_Satisfaction_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/Questionnaire_satisfaction.rtf",$params);
			
		}elseif($annexe==12){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);

			$params['db'] = $p->getDateDebut();

			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			    }
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
						
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_couvertures_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd771/couvertures.rtf",$params);
		}
		die();
	}
	
	//Test cd772 sadel 2016 //
	public function cd2Action($id_presta,$annexe)
	{
		$this->id_presta = $id_presta;
		$params = $this->common();

		
				 		
		$download = new Download();
		$nomPresta = $this->prestaEntity->getDispositif()->getNomDispositif();
        
		if($annexe==1){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			
			
			 
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			$download->setTitle(
			
			
			$this->prestaEntity->getDispositif()->getNomDispositif()."_Feuille_d'emargement_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			$download->get(getcwd()."/bundles/lea/doc/cd772/emargement_lot2.rtf",$params);
		
		}elseif($annexe==2){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
				
			 
			// Synthese
			$synthese = array_filter(array_keys($params), function ($k){ return strpos($k, "synthese") !== false && strpos($k, "synthese_obs") === false; });
		
			//echo '<pre>'.print_r($p, true).'</pre>';exit;
			//Debug::dump($synthese);exit;
			//var_dump($synthese);
			 
			foreach($synthese as $unused => $key_id){
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
			
			
			// diagnostic
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			 
			//Debug::dump($synthese);Debug::dump($diag);exit; 
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}

			    if($this->prestaData['estimation']==1){
					$params['estimation_un'] = 'X';
					$params['estimation_six'] = '';
				}
				elseif($this->prestaData['estimation']==2){
					$params['estimation_six'] = 'X';
					$params['estimation_un'] = '';
			
				}
				else{
					$params['estimation_un'] = '';
					$params['estimation_six'] = '';
				
				}
			 
			
						
						
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Bilan_Lot_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
            $download->get(getcwd()."/bundles/lea/doc/cd772/Bilan_d'evaluation_lot2.rtf",$params);
		
		}elseif($annexe==3){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			
			
			
			 
			 
			# Modification Apsie /sadel /2015
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
					 
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params['sous-titre'] = $this->prestaData['commentaire_pt_fi'];
			 
			$diag = array_filter(array_keys($params), function ($k){ return strpos($k, "diag") !== false && strpos($k, "diag_obs") === false; });
			
			foreach($diag as $unused => $key_id){
				 
				for($i=1; $i<=3; ++$i){
					$params[$key_id.'_'.$i] = $i == $params[$key_id] ? 'x' : '';
				}
			}
           		
			$download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Contrat_Lot_2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd772/contrat_lot2.rtf",$params);
		
		}elseif($annexe==4){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd772/Questionnaire FSE_lot2.rtf",$params);
			
		}elseif($annexe==5){
               $p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			 
			 
			 $params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q2_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd772/questionnaire satisfaction.rtf",$params);
			
		}elseif($annexe==6){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            $params['Comm'] = $this->prestaData['Ahumains']; 
			$params['Aeco'] = $this->prestaData['Aeconom']; 
			$params['Mmaterr'] = $this->prestaData['Mmater'];
			$params['Drenc'] = $this->prestaData['Drencon'];
			$params['Endett'] = $this->prestaData['Endet'];
			$params['effec'] = $this->prestaData['effect'];
			$params['Dma'] = $this->prestaData['Demar'];
			$params['Sit'] = $this->prestaData['Situation'];
			//$params['F'] = $this->prestaData['Fax'];
			//$params['T'] = $this->prestaData['Tell'];
			//$params['M'] = $this->prestaData['mail'];  
			
			
			
			$params['act'] = $this->prestaData['Activ']; 
			$params['actT'] = $this->prestaData['Tactiv']; 
			$params['ecar'] = $this->prestaData['ecart'];
			 
			$params['df'] = $this->prestaData['diff'];
			$params['formation_1'] = $this->prestaData['forma_1'];
			$params['formation_2'] = $this->prestaData['forma_2'];
			$params['formation_3'] = $this->prestaData['forma_3'];
			$params['formation_4'] = $this->prestaData['forma_4'];
			$params['formation_5'] = $this->prestaData['forma_5'];
			$params['formation_6'] = $this->prestaData['forma_6'];
			$params['date_reprise_emploi'] = $this->prestaData['date_reprise_emploi'];
			$params['date_cessation_emploi'] = $this->prestaData['date_cessation_emploi'];
			$params['date_suivi_emploi'] = $this->prestaData['date_suivi_emploi'];
			$params['date_entretien_emploi'] = $this->prestaData['date_entretien_emploi'];
			
			
			
			$params['format_1'] = $this->prestaData['form_1'];
			$params['format_2'] = $this->prestaData['form_2'];
			$params['format_3'] = $this->prestaData['form_3'];
			$params['format_4'] = $this->prestaData['form_4'];
			$params['format_5'] = $this->prestaData['form_5'];
			$params['format_6'] = $this->prestaData['form_6'];
			
			//Planification des actions 
			
			$params['atio_1'] = $this->prestaData['fortion_1'];
			$params['atio_2'] = $this->prestaData['fortion_2'];
			$params['atio_3'] = $this->prestaData['fortion_3'];
			$params['atio_4'] = $this->prestaData['fortion_4'];
			$params['atio_5'] = $this->prestaData['fortion_5'];
			$params['atio_6'] = $this->prestaData['fortion_6'];
			
			
			$params['Q_1'] = $this->prestaData['ation_1'];
			$params['Q_2'] = $this->prestaData['ation_2'];
			$params['Q_3'] = $this->prestaData['ation_3'];
			$params['Q_4'] = $this->prestaData['ation_4'];
			$params['Q_5'] = $this->prestaData['ation_5'];
			$params['Q_6'] = $this->prestaData['ation_6'];
			
			
			$params['Qu_1'] = $this->prestaData['Quand_1'];
			$params['Qu_2'] = $this->prestaData['Quand_2'];
			$params['Qu_3'] = $this->prestaData['Quand_3'];
			$params['Qu_4'] = $this->prestaData['Quand_4'];
			$params['Qu_5'] = $this->prestaData['Quand_5'];
			$params['Qu_6'] = $this->prestaData['Quand_6'];
			
			//Éléments-clés de l’entreprise
			
			$params['El_1'] = $this->prestaData['element_1'];
			$params['El_2'] = $this->prestaData['element_2'];
			$params['El_3'] = $this->prestaData['element_3'];
			$params['El_4'] = $this->prestaData['element_4'];
			$params['El_5'] = $this->prestaData['element_5'];
			$params['El_6'] = $this->prestaData['element_6'];
			$params['El_7'] = $this->prestaData['element_7'];
			$params['El_8'] = $this->prestaData['element_8'];
			$params['El_9'] = $this->prestaData['element_9'];
			$params['El_10'] = $this->prestaData['element_10'];
			$params['El_11'] = $this->prestaData['element_11'];
			
			
			$params['Els_1'] = $this->prestaData['elements_1'];
			$params['Els_2'] = $this->prestaData['elements_2'];
			$params['Els_3'] = $this->prestaData['elements_3'];
			$params['Els_4'] = $this->prestaData['elements_4'];
			$params['Els_5'] = $this->prestaData['elements_5'];
			$params['Els_6'] = $this->prestaData['elements_6'];
			$params['Els_7'] = $this->prestaData['elements_7'];
			$params['Els_8'] = $this->prestaData['elements_8'];
			$params['Els_9'] = $this->prestaData['elements_9'];
			$params['Els_10'] = $this->prestaData['elements_10'];
			$params['Els_11'] = $this->prestaData['elements_11'];
			
			
			//Suivi à 3 mois
			$params['obj_1'] = $this->prestaData['Objet_1'];
			$params['obj_2'] = $this->prestaData['Objet_2'];
			$params['obj_3'] = $this->prestaData['Objet_3'];
			$params['obj_4'] = $this->prestaData['Objet_4'];
			$params['obj_5'] = $this->prestaData['Objet_5'];
			$params['obj_6'] = $this->prestaData['Objet_6'];
			$params['obj_7'] = $this->prestaData['Objet_7'];
			$params['obj_8'] = $this->prestaData['Objet_8'];
			
			
			
			$params['prd_1'] = $this->prestaData['prdr_1'];
			$params['prd_2'] = $this->prestaData['prdr_2'];
			$params['prd_3'] = $this->prestaData['prdr_3'];
			$params['prd_4'] = $this->prestaData['prdr_4'];
			$params['prd_5'] = $this->prestaData['prdr_5'];
			$params['prd_6'] = $this->prestaData['prdr_6'];
			$params['prd_7'] = $this->prestaData['prdr_7'];
			$params['prd_8'] = $this->prestaData['prdr_8'];
			
			
			
			$params['ect_1'] = $this->prestaData['Ecart_1'];
			$params['ect_2'] = $this->prestaData['Ecart_2'];
			$params['ect_3'] = $this->prestaData['Ecart_3'];
			$params['ect_4'] = $this->prestaData['Ecart_4'];
			$params['ect_5'] = $this->prestaData['Ecart_5'];
			$params['ect_6'] = $this->prestaData['Ecart_6'];
			$params['ect_7'] = $this->prestaData['Ecart_7'];
			$params['ect_8'] = $this->prestaData['Ecart_8'];
			
			
			
			//Suivi à 6 mois
			$params['objs_1'] = $this->prestaData['bjet_1'];
			$params['objs_2'] = $this->prestaData['bjet_2'];
			$params['objs_3'] = $this->prestaData['bjet_3'];
			$params['objs_4'] = $this->prestaData['bjet_4'];
			$params['objs_5'] = $this->prestaData['bjet_5'];
			$params['objs_6'] = $this->prestaData['bjet_6'];
			$params['objs_7'] = $this->prestaData['bjet_7'];
			$params['objs_8'] = $this->prestaData['bjet_8'];
			
			
			
			$params['Prds_1'] = $this->prestaData['reel_1'];
			$params['Prds_2'] = $this->prestaData['reel_2'];
			$params['Prds_3'] = $this->prestaData['reel_3'];
			$params['Prds_4'] = $this->prestaData['reel_4'];
			$params['Prds_5'] = $this->prestaData['reel_5'];
			$params['Prds_6'] = $this->prestaData['reel_6'];
			$params['Prds_7'] = $this->prestaData['reel_7'];
			$params['Prds_8'] = $this->prestaData['reel_8'];
			
			
			
			$params['ects_1'] = $this->prestaData['Ecarts_1'];
			$params['ects_2'] = $this->prestaData['Ecarts_2'];
			$params['ects_3'] = $this->prestaData['Ecarts_3'];
			$params['ects_4'] = $this->prestaData['Ecarts_4'];
			$params['ects_5'] = $this->prestaData['Ecarts_5'];
			$params['ects_6'] = $this->prestaData['Ecarts_6'];
			$params['ects_7'] = $this->prestaData['Ecarts_7'];
			$params['ects_8'] = $this->prestaData['Ecarts_8'];
			
			
				
			
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			if($this->prestaData['mois']==0){
					$params['mois3'] = 'X';
					$params['mois6'] = '';
				}
				elseif($this->prestaData['mois']==1){
					$params['mois6'] = 'X';
					$params['mois3'] = '';
			
				}
				else{
					$params['mois3'] = '';
					$params['mois6'] = '';
				
				}
				
				if($this->prestaData['crea']==0){
					$params['crea1'] = 'X';
					$params['crea2'] = '';
				}
				elseif($this->prestaData['crea']==1){
					$params['crea2'] = 'X';
					$params['crea1'] = '';
			
				}
				else{
					$params['crea1'] = '';
					$params['crea2'] = '';
				
				}
				
				if($this->prestaData['cesse']==0){
					$params['cesse1'] = 'X';
					$params['cesse2'] = '';
				}
				elseif($this->prestaData['cesse']==1){
					$params['cesse2'] = 'X';
					$params['cesse1'] = '';
			
				}
				else{
					$params['cesse1'] = '';
					$params['cesse2'] = '';
				
				}
			
			
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_Q6_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd772/ANNEXE BILAN SUIVI.rtf",$params);
		
		}elseif($annexe==7){
			$p = $this->getDoctrine()->getRepository('LeaPrestaBundle:EgwPrestation')->find($this->id_presta);
			$params['db'] = $p->getDateDebut();
			 			
			$params = array_merge($params, $this->prestaData);
			$params["description_projet"] = $this->prestaEntity->getProjet()->getDescriptionProjet();
			$params["civilite"] = $this->prestaEntity->getContact()->getCivilite();
            $params['Ens'] = $this->prestaData['NomEns']; 
			
			if ($p->getDateFin() > 0)
				$params["df"] = $p->getDateFin();
			else{
				list($ddd,$mmm,$YYY)=explode('/',$p->getDateDebut());
				$params["df"] = Date("d/m/Y", mktime(0,0,0,$mmm,$ddd+90,$YYY)) ;
			}
			
			
			$params = array_merge($params, $this->prestaData);
			 
			 $download->setTitle($this->prestaEntity->getDispositif()->getNomDispositif()."_SUIVI_".$this->prestaEntity->getContact()->getNom().'_'.$this->prestaEntity->getContact()->getPrenom());
			
              $download->get(getcwd()."/bundles/lea/doc/cd772/couvertures.rtf",$params);
		}
		die();
	}

}
