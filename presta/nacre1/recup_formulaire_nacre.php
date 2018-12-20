<?php
include('./inc/class_nacre_preliminaire_impression.inc.php');
include('./inc/class_nacre.php');


$personnalite_createur=$_POST["dynamique"]. ',' .$_POST["autoritaire"]. ',' .$_POST["tetu"].',' .$_POST["enthousiaste"]. ',' .$_POST["entreprenant"]. ',' .$_POST["sens_initiative"]. ',' .$_POST["conformiste"]. ',' .$_POST["humeur_changeante"]. ',' .$_POST["emotif_sensible"]. ',' .$_POST["volontaire"]. ',' .$_POST["desordonne"]. ',' .$_POST["realiste"]. ',' .$_POST["logique"]. ',' .$_POST["intuitif"]. ',' .$_POST["adaptable"]. ',' .$_POST["rigoureux"]. ',' .$_POST["autonome"]. ',' .$_POST["intransigeant"]. ',' .$_POST["esprit_equipe"]. ',' .$_POST["disperse"]. ',' .$_POST["sait_pas_ecouter"]. ',' .$_POST["constructif"]. ',' .$_POST["pointilleux"]. ',' .$_POST["inattentif"]. ',' .$_POST["large_esprit"]. ',' .$_POST["susceptible"].',' .$_POST["negociateur"]. ',' .$_POST["manuel"]. ',' .$_POST["creatif"]. ',' .$_POST["empathique"]. ',' .$_POST["capable_travailler_pression"]. ',' .$_POST["etourdi"]. ',' .$_POST["optimiste"]. ',' .$_POST["pessimiste"]. ',' .$_POST["maniaque"]. ',' .$_POST["souple_ouvert"]. ',' .$_POST["organise"]. ',' .$_POST["raleur"]. ',' .$_POST["sociable"]. ',' .$_POST["timide"]. ',' .$_POST["ferme"]. ',' .$_POST["dilettante"]. ',' .$_POST["tenace"]. ',' .$_POST["curieux"]. ',' .$_POST["anxieux"]. ',' .$_POST["innovateur"]. ',' .$_POST["consciencieux"]. ',' .$_POST["impatient"]. ',' .$_POST["perseverant"]. ',' .$_POST["imprevoyant"]. ',' .$_POST["individualiste"]. ',' .$_POST["apprend_rapidement"]. ',' .$_POST["reflechi"]. ',' .$_POST["rigide"].',' .$_POST["diplomate"]. ',' .$_POST["pedagogue"]. ',' .$_POST["pragmatique"]. ',' .$_POST["gout_risque"]. ',' .$_POST["sens_ecoute"]. ',' .$_POST["sens_humour"]. ',' .$_POST["pragmatique"];


$caracteri_pt_fort1=$_POST["pt_fort1"];
$caracteri_pt_fort2=$_POST["pt_fort2"];
$caracteri_pt_fort3=$_POST["pt_fort3"];
$caracteri_pt_fort4=$_POST["pt_fort4"];
$caracteri_pt_fort5=$_POST["pt_fort5"];

$caracteri_pt_faible1=$_POST["pt_faible1"];
$caracteri_pt_faible2=$_POST["pt_faible2"];
$caracteri_pt_faible3=$_POST["pt_faible3"];
$caracteri_pt_faible4=$_POST["pt_faible4"];
$caracteri_pt_faible5=$_POST["pt_faible5"];

$ameliorer_pt1=$_POST["pt_amel1"];
$ameliorer_pt2=$_POST["pt_amel2"];
$ameliorer_pt3=$_POST["pt_amel3"];
$ameliorer_pt4=$_POST["pt_amel4"];
$ameliorer_pt5=$_POST["pt_amel5"];

$motivation_createur=$_POST["independance"]. ',' .$_POST["responsabilites"]. ',' .$_POST["reve_passion"].',' .$_POST["changer_vie"]. ',' .$_POST["opportunite"]. ',' .$_POST["statut_sociel"]. ',' .$_POST["revenu_immediat"]. ',' .$_POST["patrimoine"]. ',' .$_POST["conjoint"]. ',' .$_POST["partenariat"];


//echo $motivation_createur;

$diplome_annee1=$_POST["dipl_annee1"];
$diplome_annee2=$_POST["dipl_annee2"];
$diplome_annee3=$_POST["dipl_annee3"];
$diplome_annee4=$_POST["dipl_annee4"];
$diplome_annee5=$_POST["dipl_annee5"];

$diplome_obtenu1=$_POST["dipl_obtenu1"];
$diplome_obtenu2=$_POST["dipl_obtenu2"];
$diplome_obtenu3=$_POST["dipl_obtenu3"];
$diplome_obtenu4=$_POST["dipl_obtenu4"];
$diplome_obtenu5=$_POST["dipl_obtenu5"];

$formation_annee1=$_POST["form_annee1"];
$formation_annee2=$_POST["form_annee2"];
$formation_annee3=$_POST["form_annee3"];
$formation_annee4=$_POST["form_annee4"];
$formation_annee5=$_POST["form_annee5"];

$formation_suivie1=$_POST["form_suivi1"];
$formation_suivie2=$_POST["form_suivi2"];
$formation_suivie3=$_POST["form_suivi3"];
$formation_suivie4=$_POST["form_suivi4"];
$formation_suivie5=$_POST["form_suivi5"];

$experience_annee1=$_POST["exp_annee1"];
$experience_annee2=$_POST["exp_annee2"];
$experience_annee3=$_POST["exp_annee3"];
$experience_annee4=$_POST["exp_annee4"];
$experience_annee5=$_POST["exp_annee5"];
$experience_annee6=$_POST["exp_annee6"];

$poste_occupe1=$_POST["exp_poste1"];
$poste_occupe2=$_POST["exp_poste2"];
$poste_occupe3=$_POST["exp_poste3"];
$poste_occupe4=$_POST["exp_poste4"];
$poste_occupe5=$_POST["exp_poste5"];
$poste_occupe6=$_POST["exp_poste6"];

$entreprise_1=$_POST["exp_entrep1"];
$entreprise_2=$_POST["exp_entrep2"];
$entreprise_3=$_POST["exp_entrep3"];
$entreprise_4=$_POST["exp_entrep4"];
$entreprise_5=$_POST["exp_entrep5"];
$entreprise_6=$_POST["exp_entrep6"];

//*************Validation de l’adéquation*****************

$exp_pro_secteur=$_POST["exp_pro"];

$formation=$_POST["formation1"];

$acquis_extraprof=$_POST["acquis"];

//Compréhension des contraintes du statut de créateur


$contraintes_perso=$_POST["cont_familiale"]. ',' .$_POST["cont_sante"]. ',' .$_POST["cont_temps"].',' .$_POST["cont_financiere"];

//$contraintes_projet

$contraintes_projet=$_POST["cont_produit"]. ',' .$_POST["cont_marche"]. ',' .$_POST["cont_moyens"].',' .$_POST["cont_legales"];


//$projet_defini

$projet_defini=$_POST["projet_clair"];
$projet_defini_com=$_POST["commentaires1"];

//$produit_defini

$produit_defini=$_POST["produit_defini"];
$produit_defini_com=$_POST["commentaires2"];

//$produit_listes

$produit_listes=$_POST["produit_listes"];
$produit_listes_com=$_POST["commentaires3"];

//$marche_determine

$marche_determine=$_POST["marche_determine1"];
$marche_determine_com=$_POST["commentaires4"];

//$clientele_ciblee

$clientele_ciblee=$_POST["clientele_ciblee1"];
$clientele_ciblee_com=$_POST["commentaires5"];

//$fournisseurs_identifies

$fournisseurs_identifies=$_POST["fournisseurs_identifies1"];
$fournisseurs_identifies_com=$_POST["commentaires6"];

//$concurrence_identifiee

$concurrence_identifiee=$_POST["concurrence_ident1"];
$concurrence_identifiee_com=$_POST["commentaires7"];

//$strategie_commerciale

$strategie_commerciale=$_POST["strategie_definie1"];
$strategie_commerciale_com=$_POST["commentaires8"];

//$stock_initial

$stock_initial=$_POST["stock_defini1"];
$stock_initial_com=$_POST["commentaires9"];

//$prix_revient

$prix_revient=$_POST["prix_revient1"];
$prix_revient_com=$_POST["commentaires10"];

//$px_vente_fix

$px_vente_fix=$_POST["prix_fixes1"];
$px_vente_fix_com=$_POST["commentaires11"];

//$quantites_vendues

$quantites_vendues=$_POST["quantites_estimees1"];
$quantites_vendues_com=$_POST["commentaires12"];

//$ca_calcule

$ca_calcule=$_POST["ca_calcule1"];
$ca_calcule_com=$_POST["commentaires13"];

//$charges_activite

$charges_activite=$_POST["charges_chiffrees1"];
$charges_activite_com=$_POST["commentaires14"];

//$cpte_exploitation

$cpte_exploitation=$_POST["compte_finalise1"];
$cpte_exploitation_com=$_POST["commentaires15"];

//$plan_tresorerie

$plan_tresorerie=$_POST["plan_finalise1"];
$plan_tresorerie_com=$_POST["commentaires16"];

//$point_mort_calcule

$point_mort_calcule=$_POST["pt_mortcalcule1"];
$point_mort_calcule_com=$_POST["commentaires17"];

//$seuil_rentabilite

$seuil_rentabilite=$_POST["seuil_connu1"];
$seuil_rentabilite_com=$_POST["commentaires18"];

//$investissement_defini

$investissement_defini=$_POST["investissement_def1"];
$investissement_defini_com=$_POST["commentaires19"];

//$cout_chiffre

$cout_chiffre=$_POST["investissement_chiffre1"];
$cout_chiffrecom=$_POST["commentaires20"];

//$montant_apport

$montant_apport=$_POST["montant_apports1"];
$montant_apport_com=$_POST["commentaires21"];

//$projet_financements

$projet_financements=$_POST["proj_financements1"];
$projet_financements_com=$_POST["commentaires22"];

//$montant_besoin

$montant_besoin=$_POST["montant_financements1"];
$montant_besoin_com=$_POST["commentaires23"];

//$lieu_implantation

$lieu_implantation=$_POST["lieu_choisi1"];
$lieu_implantation_com=$_POST["commentaires24"];

//$local_necessaire

$local_necessaire=$_POST["local_necessaire1"];
$local_necessaire_com=$_POST["commentaires25"];

//$local_trouve

$local_trouve=$_POST["local_trouve1"];
$local_trouve_com=$_POST["commentaires26"];

//$nb_emplois_crees
$nb_emplois_crees=$_POST["nb_emplois1"];
$nb_emplois_crees_com=$_POST["commentaires27"];

//$nb_emplois_salaries

$nb_emplois_salaries=$_POST["emplois_salaries1"];
$nb_emplois_salaries_com=$_POST["commentaires28"];

//$statut_createur
$statut_createur=$_POST["statut_def"];
$statut_createur_com=$_POST["commentaires29"];


//$statut_juridique

$statut_juridique=$_POST["statut_juridique1"];
$statut_juridique_com=$_POST["commentaires30"];

//$demarches_entamees

$demarches_entamees=$_POST["demarches_entamees1"];
$demarches_entamees_com=$_POST["commentaires31"];

//$regime_fiscal

$regime_fiscal=$_POST["regime_choisi1"];
$regime_fiscal_com=$_POST["commentaires32"];

//$projet_redige

$projet_redige=$_POST["projet_redige1"];
$projet_redige_com=$_POST["commentaires33"];

//**************************Plan d'accompagnement*****
//$adequation_validation

$adequation_validation=$_POST["adeq_projet"]. ',' .$_POST["analyse_ant"]. ',' .$_POST["ident_cial"].',' .$_POST["ident_techn"]. ',' .$_POST["ident_gestion"]. ',' .$_POST["valid_projet"];

//champs $etude_economique

$etude_economique=$_POST["etude_eco"]. ',' .$_POST["definition_services"]. ',' .$_POST["etude_marche"].',' .$_POST["def_clientele"]. ',' .$_POST["etude_concurr"]. ',' .$_POST["etude_fournisseurs"]. ',' .$_POST["elaboration"]. ',' .$_POST["moyens_materiels"]. ',' .$_POST["valid_viabilite"];

//champs $etude_financiere

$etude_financiere=$_POST["etude_financi"]. ',' .$_POST["cal_prix"]. ',' .$_POST["calcul_ca"].',' .$_POST["def_charges"]. ',' .$_POST["cal_rentabilite"]. ',' .$_POST["cal_besoin"]. ',' .$_POST["plan_mensuel"]. ',' .$_POST["liste_invetiss"]. ',' .$_POST["tab_amortissement"]. ',' .$_POST["plan_financ"]. ',' .$_POST["simul_emprunts"]. ',' .$_POST["valid_faisabilite"];

//champs $ej_montage_creation

$ej_montage_creation=$_POST["etude_jurid"]. ',' .$_POST["montage"]. ',' .$_POST["creation"].',' .$_POST["formes_juridiques"]. ',' .$_POST["choix_juridiques"]. ',' .$_POST["verif_contrat"]. ',' .$_POST["inpi"]. ',' .$_POST["orient_createur"]. ',' .$_POST["demandes_exo"]. ',' .$_POST["demandes_locaux"]. ',' .$_POST["demarches"]. ',' .$_POST["chronologies"];

//8.	Planning prévisionnel
//$etapes_adequation

$etapes_adequation=$_POST["adeq_projet2"]. ',' .$_POST["ad_rdv2"]. ',' .$_POST["ad_rdv3"].',' .$_POST["ad_rdv4"]. ',' .$_POST["ad_rdv5"]. ',' .$_POST["ad_rdv6"]. ',' .$_POST["ad_rdv7"]. ',' .$_POST["ad_rdv8"]. ',' .$_POST["ad_rdv9"]. ',' .$_POST["ad_rdv10"];


//$etapes_etude_eco
$etapes_etude_eco=$_POST["etude_economique2"]. ',' .$_POST["econom_rdv2"]. ',' .$_POST["econom_rdv3"].',' .$_POST["econom_rdv4"]. ',' .$_POST["econom_rdv5"]. ',' .$_POST["econom_rdv6"]. ',' .$_POST["econom_rdv7"]. ',' .$_POST["econom_rdv8"]. ',' .$_POST["econom_rdv9"]. ',' .$_POST["econom_rdv10"];


//$etapes_etude_financ
$etapes_etude_financ=$_POST["etude_financ2"]. ',' .$_POST["financ_rdv2"]. ',' .$_POST["financ_rdv3"].',' .$_POST["financ_rdv4"]. ',' .$_POST["financ_rdv5"]. ',' .$_POST["financ_rdv6"]. ',' .$_POST["financ_rdv7"]. ',' .$_POST["financ_rdv8"]. ',' .$_POST["financ_rdv9"]. ',' .$_POST["financ_rdv10"];

//$etapes_etude_jurid
$etapes_etude_jurid=$_POST["etude_jurid2"]. ',' .$_POST["juridique_rdv2"]. ',' .$_POST["juridique_rdv3"].',' .$_POST["juridique_rdv4"]. ',' .$_POST["juridique_rdv5"]. ',' .$_POST["juridique_rdv6"]. ',' .$_POST["juridique_rdv7"]. ',' .$_POST["juridique_rdv8"]. ',' .$_POST["juridique_rdv9"]. ',' .$_POST["juridique_rdv10"];


//$etapes_montage
$etapes_montage=$_POST["montage"]. ',' .$_POST["montage_rdv2"]. ',' .$_POST["montage_rdv3"].',' .$_POST["montage_rdv4"]. ',' .$_POST["montage_rdv5"]. ',' .$_POST["montage_rdv6"]. ',' .$_POST["montage_rdv7"]. ',' .$_POST["montage_rdv8"]. ',' .$_POST["montage_rdv9"]. ',' .$_POST["montage_rdv10"];


//$etapes_creation
$etapes_creation=$_POST["creation"]. ',' .$_POST["creation_rdv2"]. ',' .$_POST["creation_rdv3"].',' .$_POST["creation_rdv4"]. ',' .$_POST["creation_rdv5"]. ',' .$_POST["creation_rdv6"]. ',' .$_POST["creation_rdv7"]. ',' .$_POST["creation_rdv8"]. ',' .$_POST["creation_rdv9"]. ',' .$_POST["creation_rdv10"];

//commentaires
$commentaires=$_POST["commentaires_nacre"];

//$date

$date=date("d/m/Y");
/*

echo $personnalite_createur;
*/
$id_beneficiaire=$_POST['id_ben'];
$id_presta=$_POST['id_presta'];

if(isset($_POST['imprimer']))
{
	$nacre=new nacre_preliminaire_impression();	
/*	$nacre->imprimer_totalite($id_beneficiaire);*/
$nacre->imprimer($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_parcours, $validation_parcours, $etude_economique, $validation_viabilite, $etude_financiere, $validation_faisabilite, $ej_montage_creation, $ej_montage_creation2, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date);
	
/*echo $personnalite_createur;
*/	}
	

	
if (isset($_POST['enregistrer']))
{
$nacre2= new nacre_preliminaire();

$nacre2->verif_presta_nacre_preliminaire($id_beneficiaire, $id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com,$px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date);

echo'<script>window.history.back();</script>';
}



?>