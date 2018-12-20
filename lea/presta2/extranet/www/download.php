<?php 
$_GET['header'] = 0 ;
global $conn;
$download = new download();


#Récupération du contact
$contact = contact::get_contactv2(null,$_GET['id_presta']);
#Récupération de la data du projet
$projet = projet::getProjetByPresta($_GET['id_presta']);

#Récupération de la data en fonction de la presta
$presta_data = new presta_data();
$dataPresta = $presta_data->get($_GET['id_presta']);
$presta = outils::convertDataPresta($dataPresta);

$prestation = prestation::getPrestationByIdPresta($_GET['id_presta']);
//print_r($prestation);die();
#data de remplacement
$params["Nom"] = utf8_encode($contact['nom']);
$params["prenom"] = utf8_encode($contact['prenom']);
$params["ID"] = $contact['identifiant'];
$params["adresse"] = utf8_encode($contact['adresse_ligne_1']);
$params[""] = $contact['cp'];
$params["Ville"] = $contact['ville'];
$params["tel_ben"]  = contact::getTelV2($contact);
$params["email_ben"]  = contact::getEmail($contact);

#prestataire
$params["nom_org"]  = $prestation['nom_organisme'];
$params["adresse_org"]  = $prestation['adresse_organisme'];
$params["siret"]  = SIRET_APSIE;
$params["tel_org"]  = $prestation['tel_organisme'];
$params["email_org"]  = $prestation['email_organisme'];
$params["code_org"]  = $prestation['cp_organisme'];
$params["ville_org"]  = $prestation['ville_organisme'];

#organisme
$params['nom_organisme'] = $prestation['nom_lieu'];
$params['adresse_organisme'] = $prestation['adresse_lieu'];
$params['tel_organisme'] = $prestation['tel_lieu'];
$params['email_organisme'] = $prestation['email_lieu'];
$params['siret'] = SIRET_APSIE;
$params["code_organisme"]  = $prestation['cp_lieu'];
$params["ville_organisme"]  = $prestation['ville_lieu'];

#referent
$params["Nom_ref"]  = $prestation['account_lastname'];
$params["prenom_ref"]  = $prestation['account_firstname'];
$params["email_ref"]  = $prestation['account_email'];
$params["tel_ref"]  = $prestation['account_tel_pro'];

$params["L"]  = $prestation['lettre_de_commande'];
$params["db"]  = outils::convertDate($prestation['date_debut']);
$params["fi"]  = outils::convertDate($prestation['date_fin']);
$params["N"]  = $prestation['numero_marche'];
$params["lot"]  = $prestation['numero_lot'];

#organisme prescripteur
$params["N_p"]  = $prestation['nom_p'];
$params["p_p"]  = $prestation['prenom_p'];
$params["pole_emploi"]  = $prestation['nom_organisme'];
$params["tel_pole"]  = $prestation['tel_p'];
$params["email_pole"]  = $prestation['email_p'];

#date
$params['da'] = date('d/m/Y'); 

#Abandon
$params['Motif']= $presta['motif_abandon'];
$params['ab']= outils::convertDate($presta['date_abandon']);

if($_GET['presta'] == 'oe' )
{
		
	if($_GET['annexe']==1)
	{	
	$download->setTitle($_GET['presta']."_annexe_1_".$contact['nom'].'_'.$contact['prenom']);
	$download->get("./doc/".$_GET['presta']."/annexe_1.rtf",$params);
	}
	elseif($_GET['annexe']==2)
	{

	
	if($presta['suivi']==1)
	$params['1'] = "X";
	else 
	$params['1'] = " ";
	
	if($presta['suivi']==2)
	$params['2'] = "X";
	else
	$params['2'] = " ";
	
	if($presta['suivi']==3)
	$params['3'] = "X";
	else
	$params['3'] = " ";
	
	if($presta['suivi']==4)
	$params['4'] = "X";
	else
	$params['4'] = " ";
	
	//Rdv
	//die('test');
	$cal = new calendrier($conn);
	$dataRdv = $cal->getRdvContactByPresta($_GET['id_presta']);
	
	for($i=0;$i<=11;$i++):
	$params['date_rdv_'.$i] = "";
	$params['rdv_ab_'.$i] = "";
	$params['nature_'.$i] = "";
	endfor;
	
	foreach ($dataRdv as $key => $row):
	$params['date_rdv_'.$key] = date('d/m/Y H:i',$row['StartTime']);
	$params['rdv_ab_'.$key] = $row['motif_absence'];
	if($row['is_ind']==1)
	$params['nature_'.$key] = 'Individuelle';
	else 
	$params['nature_'.$key] = 'Regroupement';
	
	endforeach;
	// Periodes travaillées
	for($i=0;$i<=4;$i++):
	$params['date_deb_'.$i.'_p'] = $presta['date_deb_'.$i.'_periode_t'];
	$params['date_fin_'.$i.'_p'] = $presta['date_fin_'.$i.'_periode_t'];
	
	if(isset($presta['periode_t_id_organisation_'.$i]) and is_numeric($presta['periode_t_id_organisation_'.$i]))
	{
	$org = organisation::get($presta['periode_t_id_organisation_'.$i]);
	$params['entreprise_'.$i.'_p'] = $org["nom_organisme"];
	$params['tel_'.$i.'_p'] = $org["tel"];
	}
	else 
	{
	$params['entreprise_'.$i.'_p'] = $presta['periode_t_entreprise_'.$i];
	$params['tel_'.$i.'_p'] ='';
	}
	

	
	$params['poste_'.$i] = $presta['periode_t_code_rome_'.$i];
	$params['contrat_'.$i] = $presta['type_contrat_'.$i];
	endfor;
	#Plan d'action
	$params['emploi_1'] = $presta['code_rome_1'];
	$params['emploi_2'] = $presta['code_rome_2'];
	
	$params['date_deb_1'] = $presta['date_deb_1'];
	$params['date_deb_2'] = $presta['date_deb_2'];
	$params['date_deb_3'] = $presta['date_deb_3'];
	$params['date_deb_4'] = $presta['date_deb_4'];
	$params['date_deb_5'] = $presta['date_deb_5'];
	$params['date_deb_6'] = $presta['date_deb_6'];
	$params['date_fin_1'] = $presta['date_fin_1'];
	$params['date_fin_2'] = $presta['date_fin_2'];
	$params['date_fin_3'] = $presta['date_fin_3'];
	$params['date_fin_4'] = $presta['date_fin_4'];
	$params['date_fin_5'] = $presta['date_fin_5'];
	$params['date_fin_6'] = $presta['date_fin_6'];
	
	$params['action_1'] = $presta['action_1'];
	$params['action_2'] = $presta['action_2'];
	$params['action_3'] = $presta['action_3'];
	$params['action_4'] = $presta['action_4'];
	$params['action_5'] = $presta['action_5'];
	$params['action_6'] = $presta['action_6'];
	
	$params['obj_1'] = $presta['objectif_1'];
	$params['obj_2'] = $presta['objectif_2'];
	$params['obj_3'] = $presta['objectif_3'];
	$params['obj_4'] = $presta['objectif_4'];
	$params['obj_5'] = $presta['objectif_5'];
	$params['obj_6'] = $presta['objectif_6'];
	
	$params['res_1'] = $presta['resultat_1'];
	$params['res_2'] = $presta['resultat_2'];
	$params['res_3'] = $presta['resultat_3'];
	$params['res_4'] = $presta['resultat_4'];
	$params['res_5'] = $presta['resultat_5'];
	$params['res_6'] = $presta['resultat_6'];
	
	for($i=0;$i<=7;$i++):
	$params['date_suivi_'.$i] = $presta['date_suivi_'.$i];
	$params['objectif_contrat_'.$i] = $presta['objectif_contact_'.$i];
	$params['aspects_maitrises_'.$i] = $presta['aspects_maitrises_'.$i];
	$params['aspects_retravailler_'.$i] = $presta['aspects_a_retravailler_'.$i];
	
	if(isset($presta['item_id_organisation_'.$i]) and is_numeric($presta['item_id_organisation_'.$i]))
	{
	$org = organisation::get($presta['item_id_organisation_'.$i]);
	$params['entreprise_'.$i] = $org["nom_organisme"];
	$params['tel_'.$i] = $org["tel"];
	}
	else 
	{
	$params['entreprise_'.$i] = $presta['entreprise_'.$i];
	$params['tel_'.$i] ='';
	}
	endfor;
	
	
	#beneficiaire
	$params['sit_ben_intitule_code_rome'] = $presta['sit_ben_code_rome'];
	
	if(isset($presta['entreprise2_id']) and is_numeric($presta['entreprise2_id']))
	{
	$org = organisation::get($presta['entreprise2_id']);
	$params['entreprise2'] = $org["nom_organisme"];
	$params['adresse2'] = utf8_encode($org["adresse_ligne_1"]).' '.utf8_encode($org["adresse_ligne_2"]).', '.$org["cp_org"].' '.$org["ville_org"];
	$params['tel2'] = $org["tel"];
	}
	else 
	{
	$params['entreprise2'] = $presta['entreprise2'];
	$params['adresse2'] ='';
	$params['tel2'] = '';
	}
	
	if($presta['nb_heure_tp_partiel']!=null)
	$params['nb_h'] = $presta['nb_heure_tp_partiel'].'H';
	else 
	$params['nb_h'] ='';
	
	$params['intitule_formation'] = $presta['sit_intitule_formation'];
	$params['date_reprise_emploi'] = $presta['date_reprise_emploi'];
	$params['pts_forts_axes'] = $presta['pts_forts_axes'];
	
	if($presta['duree_cdd']!=null)
	$params['time'] = $presta['duree_cdd'].' mois';
	else
	$params['time'] = '';
	
	if($presta['type_contrat']==1)
	{
	$params['cdi'] = 'X';
	$params['cdd'] = '';
	}
	elseif($presta['type_contrat']==2) {
	$params['cdi'] = ' ';
	$params['cdd'] = 'X';
	}
	
	if($presta['temps_contrat']==1)
	{
	$params['temp1'] = 'X';
	$params['temp2'] = ' ';
	}
	elseif($presta['temps_contrat']==2) {
	$params['temp1'] = ' ';
	$params['temp2'] = 'X';
	}
	
	if($presta['via_formation']==1)
	$params['form'] = 'X';
	else
	$params['form'] = ' ';
	
	$params['nb_pe'] = $presta['nb_offre_pe'];
	$params['nb_au'] = $presta['nb_offre_au'];
	$params['nb_sp'] = $presta['nb_offre_sp'];
	$params['ent_pe'] = $presta['nb_ent_pe'];
	$params['ent_sp'] = $presta['nb_ent_sp'];
	$params['ent_au'] = $presta['nb_ent_au'];
	
	
	$params['sit_code_rome'] = $presta['sit_ben_code_rome2'];
	$params['mar'] = $presta['marche_travail'];
	$params['pts_forts_axes2'] = $presta['pts_forts_axes2'];
	
	$params['nb_pe2'] = $presta['nb_offre_pe2'];
	$params['nb_au2'] = $presta['nb_offre_au2'];
	$params['nb_sp2'] = $presta['nb_offre_sp2'];
	$params['ent_pe2'] = $presta['nb_ent_pe2'];
	$params['ent_sp2'] = $presta['nb_ent_sp2'];
	$params['ent_au2'] = $presta['nb_ent_au2'];
	
	
	$params['echeance_1'] = $presta['date_action_1'];
	$params['echeance_2'] = $presta['date_action_2'];
	$params['echeance_3'] = $presta['date_action_3'];
	$params['echeance_4'] = $presta['date_action_4'];
	$params['echeance_5'] = $presta['date_action_5'];
	$params['echeance_6'] = $presta['date_action_6'];
	
	$params['action_1'] = $presta['action_a_m1'];
	$params['action_2'] = $presta['action_a_m2'];
	$params['action_3'] = $presta['action_a_m3'];
	$params['action_4'] = $presta['action_a_m4'];
	$params['action_5'] = $presta['action_a_m5'];
	$params['action_6'] = $presta['action_a_m6'];
	
	$params['ob1'] = $presta['objectif_a_m1'];
	$params['ob2'] = $presta['objectif_a_m2'];
	$params['ob3'] = $presta['objectif_a_m3'];
	$params['ob4'] = $presta['objectif_a_m4'];
	$params['ob5'] = $presta['objectif_a_m5'];
	$params['ob6'] = $presta['objectif_a_m6'];

	
	$download->setTitle($_GET['presta']."_annexe_2_".$contact['nom'].'_'.$contact['prenom']);
	$download->get("./doc/".$_GET['presta']."/annexe_2.rtf",$params);
		
	}

}

if($_GET['presta'] == 'opcrea')
{

	if($_GET['annexe']==1)
	{
	
	
	$params["D_p"] = utf8_encode($projet ['description_projet']);
	$params["E_a_p"] = $presta['etat_avancement_projet'];
	$params['P_e_p_1'] = $presta['point_evaluer_priorite_1'];
	$params['p_e_p_2'] = $presta['point_evaluer_priorite_2'];
	$params['p_e_p_3'] = $presta['point_evaluer_priorite_3'];
	$params['A_b_1'] = $presta['attente_beneficiaire_1'];
	$params['a_b_2'] = $presta['attente_beneficiaire_2'];
	$params['a_b_3'] = $presta['attente_beneficiaire_3'];
	$params['Com'] = $presta['commentaire_1'];
	
	$download->setTitle($_GET['presta']."_annexe_1_".$contact['nom'].'_'.$contact['prenom']);
	$download->get("./doc/".$_GET['presta']."/annexe_1.rtf",$params);
	}
	
	

elseif($_GET['annexe']==2)
{
	
global $conn;
$cal = new calendrier($conn);
#rdv

for($i=1;$i<=10;$i++):
$params['d'.$i]="";
endfor;

$rdv = $cal->getRdv($_GET['id_presta']);
$params['RDV'] = count($rdv);

foreach ($rdv as $i => $val):

if($i==10)
$params['dx']= outils::convertDate($val['StartTime']);
else
$params['d'.($i)]= outils::convertDate($val['StartTime']);

endforeach;



$params['projet']= utf8_encode($projet ['description_projet']);
$params['formation_1'] = $presta['formation_1'];
$params['formation_2'] = $presta['formation_2'];
$params['formation_3'] = $presta['formation_3'];
$params['formation_4'] = $presta['formation_4'];
$params['capacite_1'] = $presta['capacite_emploi_1'];
$params['capacite_2'] = $presta['capacite_emploi_2'];
$params['capacite_3'] = $presta['capacite_emploi_3'];
$params['capacite_4'] = $presta['capacite_emploi_4'];
$params['competence_pro_1'] = $presta['competence_pro_1'];
$params['competence_pro_2'] = $presta['competence_pro_2'];
$params['competence_pro_3'] = $presta['competence_pro_3'];
$params['competence_pro_4'] = $presta['competence_pro_4'];
$params['element_porteur_1'] = $presta['element_porteur_1'];
$params['element_porteur_2'] = $presta['element_porteur_2'];
$params['element_porteur_3'] = $presta['element_porteur_3'];
$params['element_porteur_4'] = $presta['element_porteur_4'];
$params['point_vigilance_1'] = $presta['point_vigilance_1'];
$params['point_vigilance_2'] = $presta['point_vigilance_2'];
$params['point_vigilance_3'] = $presta['point_vigilance_3'];
$params['point_vigilance_4'] = $presta['point_vigilance_4'];
$params['formation_courte_1'] = $presta['formation_courte_1'];
$params['formation_courte_2'] = $presta['formation_courte_2'];
$params['formation_courte_3'] = $presta['formation_courte_3'];
$params['formation_courte_4'] = $presta['formation_courte_4'];
$params['competence_1'] = $presta['competence_1'];
$params['competence_2'] = $presta['competence_2'];
$params['competence_3'] = $presta['competence_3'];
$params['competence_4'] = $presta['competence_4'];
$params['delai_priorite_1'] = $presta['delai_priorite_1'];
$params['delai_priorite_2'] = $presta['delai_priorite_2'];
$params['delai_priorite_3'] = $presta['delai_priorite_3'];
$params['delai_priorite_4'] = $presta['delai_priorite_4'];
$params['commentaire_adequation'] = $presta['commentaire_adequation'];
$params['points_forts_clients_1'] = $presta['points_forts_clients_1'];
$params['points_forts_clients_2'] = $presta['points_forts_clients_2'];
$params['points_forts_clients_3'] = $presta['points_forts_clients_3'];
$params['points_forts_clients_4'] = $presta['points_forts_clients_4'];
$params['points_faibles_clients_1'] = $presta['points_faibles_clients_1'];
$params['points_faibles_clients_2'] = $presta['points_faibles_clients_2'];
$params['points_faibles_clients_3'] = $presta['points_faibles_clients_3'];
$params['points_faibles_clients_4'] = $presta['points_faibles_clients_4'];
$params['points_forts_concurrence_1'] = $presta['points_forts_concurrence_1'];
$params['points_forts_concurrence_2'] = $presta['points_forts_concurrence_2'];
$params['points_forts_concurrence_3'] = $presta['points_forts_concurrence_3'];
$params['points_forts_concurrence_4'] = $presta['points_forts_concurrence_4'];
$params['points_faibles_concurrence_1'] = $presta['points_faibles_concurrence_1'];
$params['points_faibles_concurrence_2'] = $presta['points_faibles_concurrence_2'];
$params['points_faibles_concurrence_3'] = $presta['points_faibles_concurrence_3'];
$params['points_faibles_concurrence_4'] = $presta['points_faibles_concurrence_4'];
$params['points_forts_strategie_1'] = $presta['points_forts_strategie_1']; 
$params['points_forts_strategie_2'] = $presta['points_forts_strategie_2']; 
$params['points_forts_strategie_3'] = $presta['points_forts_strategie_3']; 
$params['points_forts_strategie_4'] = $presta['points_forts_strategie_4']; 
$params['points_faibles_strategie_1'] = $presta['points_faibles_strategie_1']; 
$params['points_faibles_strategie_2'] = $presta['points_faibles_strategie_2']; 
$params['points_faibles_strategie_3'] = $presta['points_faibles_strategie_3']; 
$params['points_faibles_strategie_4'] = $presta['points_faibles_strategie_4']; 
$params['com_marche'] = $presta['commentaire_etude_marche'];
$params['etude_marche_dp1'] = $presta['etude_marche_delais_priorite_1'];
$params['etude_marche_dp2'] = $presta['etude_marche_delais_priorite_2'];
$params['etude_marche_dp3'] = $presta['etude_marche_delais_priorite_3'];
$params['etude_marche_dp4'] = $presta['etude_marche_delais_priorite_4'];
$params['etude_marche_Action_1'] = $presta['etude_marche_Action_1'];
$params['etude_marche_Action_2'] = $presta['etude_marche_Action_2'];
$params['etude_marche_Action_3'] = $presta['etude_marche_Action_3'];
$params['etude_marche_Action_4'] = $presta['etude_marche_Action_4'];
$params['etude_marche_resultat_attendu_1'] = $presta['etude_marche_resultat_attendu_1'];
$params['etude_marche_resultat_attendu_2'] = $presta['etude_marche_resultat_attendu_2'];
$params['etude_marche_resultat_attendu_3'] = $presta['etude_marche_resultat_attendu_3'];
$params['etude_marche_resultat_attendu_4'] = $presta['etude_marche_resultat_attendu_4'];
$params['fi_pt_forts_1'] = $presta['fi_pt_forts_1'];
$params['fi_pt_forts_2'] = $presta['fi_pt_forts_2'];
$params['fi_pt_forts_3'] = $presta['fi_pt_forts_3'];
$params['fi_pt_forts_4'] = $presta['fi_pt_forts_4'];
$params['fi_pt_faibles_1'] = $presta['fi_pt_faibles_1'];
$params['fi_pt_faibles_2'] = $presta['fi_pt_faibles_2'];
$params['fi_pt_faibles_3'] = $presta['fi_pt_faibles_3'];
$params['fi_pt_faibles_4'] = $presta['fi_pt_faibles_4'];
$params['fi_pt_forts_mort_1'] = $presta['fi_pt_forts_mort_1'];
$params['fi_pt_forts_mort_2'] = $presta['fi_pt_forts_mort_2'];
$params['fi_pt_forts_mort_3'] = $presta['fi_pt_forts_mort_3'];
$params['fi_pt_forts_mort_4'] = $presta['fi_pt_forts_mort_4'];
$params['fai_mort_1'] = $presta['fi_pt_faibles_mort_1'];
$params['fai_mort_2'] = $presta['fi_pt_faibles_mort_2'];
$params['fai_mort_3'] = $presta['fi_pt_faibles_mort_3'];
$params['fai_mort_4'] = $presta['fi_pt_faibles_mort_4'];
$params['fi_pt_forts_pfi_1'] = $presta['fi_pt_forts_pfi_1'];
$params['fi_pt_forts_pfi_2'] = $presta['fi_pt_forts_pfi_2'];
$params['fi_pt_forts_pfi_3'] = $presta['fi_pt_forts_pfi_3'];
$params['fi_pt_forts_pfi_4'] = $presta['fi_pt_forts_pfi_4'];
$params['fi_pt_faibles_pfi_1'] = $presta['fi_pt_faibles_pfi_1'];
$params['fi_pt_faibles_pfi_2'] = $presta['fi_pt_faibles_pfi_2'];
$params['fi_pt_faibles_pfi_3'] = $presta['fi_pt_faibles_pfi_3'];
$params['fi_pt_faibles_pfi_4'] = $presta['fi_pt_faibles_pfi_4'];
$params['pf3_1'] = $presta['fi_pt_forts_pf3_1'];
$params['pf3_2'] = $presta['fi_pt_forts_pf3_2'];
$params['pf3_3'] = $presta['fi_pt_forts_pf3_3'];
$params['pf3_4'] = $presta['fi_pt_forts_pf3_4'];
$params['fi_pt_faibles_pf3_1'] = $presta['fi_pt_faibles_pf3_1'];
$params['fi_pt_faibles_pf3_2'] = $presta['fi_pt_faibles_pf3_2'];
$params['fi_pt_faibles_pf3_3'] = $presta['fi_pt_faibles_pf3_3'];
$params['fi_pt_faibles_pf3_4'] = $presta['fi_pt_faibles_pf3_4'];
$params['fi_delais_priorite_1'] = $presta['fi_delais_priorite_1'];
$params['fi_delais_priorite_2'] = $presta['fi_delais_priorite_2'];
$params['fi_delais_priorite_3'] = $presta['fi_delais_priorite_3'];
$params['fi_delais_priorite_4'] = $presta['fi_delais_priorite_4'];
$params['fi_Action_1'] = $presta['fi_Action_1'];
$params['fi_Action_2'] = $presta['fi_Action_2'];
$params['fi_Action_3'] = $presta['fi_Action_3'];
$params['fi_Action_4'] = $presta['fi_Action_4'];
$params['fi_resultat_attendu_1'] = $presta['fi_resultat_attendu_1'];	
$params['fi_resultat_attendu_2'] = $presta['fi_resultat_attendu_2'];
$params['fi_resultat_attendu_3'] = $presta['fi_resultat_attendu_3'];
$params['fi_resultat_attendu_4'] = $presta['fi_resultat_attendu_4'];
$params['commentaire_fi'] = $presta['commentaire_pt_fi'];
$params['sj_pt_forts_1'] = $presta['sj_pt_forts_juridique_1'];
$params['sj_pt_forts_2'] = $presta['sj_pt_forts_juridique_2'];
$params['sj_pt_forts_3'] = $presta['sj_pt_forts_juridique_3'];
$params['sj_pt_forts_4'] = $presta['sj_pt_forts_juridique_4'];
$params['sj_pt_faibles_1'] = $presta['sj_pt_faibles_juridique_1'];
$params['sj_pt_faibles_2'] = $presta['sj_pt_faibles_juridique_2'];
$params['sj_pt_faibles_3'] = $presta['sj_pt_faibles_juridique_3'];
$params['sj_pt_faibles_4'] = $presta['sj_pt_faibles_juridique_4'];
$params['sj_Action_1'] = $presta['sj_Action_1'];
$params['sj_Action_2'] = $presta['sj_Action_2'];
$params['sj_Action_3'] = $presta['sj_Action_3'];
$params['sj_Action_4'] = $presta['sj_Action_4'];
$params['sj_resultat_attendu_1'] = $presta['sj_resultat_attendu_1'];
$params['sj_resultat_attendu_2'] = $presta['sj_resultat_attendu_2'];
$params['sj_resultat_attendu_3'] = $presta['sj_resultat_attendu_3'];
$params['sj_resultat_attendu_4'] = $presta['sj_resultat_attendu_4'];
$params['sj_delais_priorite_1'] = $presta['sj_delais_priorite_1'];
$params['sj_delais_priorite_2'] = $presta['sj_delais_priorite_2'];
$params['sj_delais_priorite_3'] = $presta['sj_delais_priorite_3'];
$params['sj_delais_priorite_4'] = $presta['sj_delais_priorite_4'];
$params['commentaire_ju'] = $presta['commentaire_sj'];


//$params['p_r'] = "Oui";



if($presta['faisabilite']==2 && $presta['estimation']==1 && $presta['com_solution']!=null)
{
$ex  = 211;
}
elseif($presta['faisabilite']==2 && $presta['estimation']==1 && $presta['com_solution']==null)
{
$ex  = 210;
}
elseif($presta['faisabilite']==2 && $presta['estimation']==2 && $presta['com_solution']!=null)
{
$ex  = 221;
}
elseif($presta['faisabilite']==2 && $presta['estimation']==2 && $presta['com_solution']!==null)
{
$ex  = 220;
}

elseif($presta['faisabilite']==2 && $presta['estimation']==3 && $presta['com_solution']!=null)
{
$ex  = 231;
}
elseif($presta['faisabilite']==2 && $presta['estimation']==3 && $presta['com_solution']==null)
{
$ex  = 230;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==1 && $presta['com_solution']!=null)
{
$ex  = 311;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==1 && $presta['com_solution']==null)
{
$ex  = 310;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==2 && $presta['com_solution']!=null)
{
$ex  = 321;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==2 && $presta['com_solution']==null)
{
$ex  = 320;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==3 && $presta['com_solution']!=null)
{
$ex  = 331;
}
elseif($presta['faisabilite']==3 && $presta['estimation']==3 && $presta['com_solution']==null)
{
$ex  = 330;
}
else
{
$ex = 1;
}

$params['commentaire_faisabilite'] = $presta['com_faisabilite'];
$params['commentaire_estimation'] = $presta['com_estimation'];
$params['com_solution'] = $presta['com_solution'];
$params['b_com_ref'] = $presta['bilan_com_referent'];
$params['b_beneficiaire'] = $presta['bilan_com_beneficiaire'];

/*
if($presta['com_solution']!=null)
$params['sol'] = "X";
else
$params['sol'] = "";
*/


$download->setTitle("opcrea_annexe_2_".$contact['nom'].'_'.$contact['prenom']);
$download->get("./doc/opcrea/annexe_2/".$ex.".rtf",$params);
//$download->get("./doc/opcrea/annexe_2_.rtf",$params);
}
elseif($_GET['annexe']==3)
{
$params['titulaire'] = "APSIE";
$download->setTitle("opcrea_annexe_3_".$contact['nom'].'_'.$contact['prenom']);
$download->get("./doc/opcrea/annexe_3.rtf",$params);
}
}
?>