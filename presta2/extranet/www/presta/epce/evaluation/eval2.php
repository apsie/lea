<?php
include('../inc/class.epce_evaluation.inc.php');

//Instaciation de la class "epce_evaluation();
$evaluation=new epce_evaluation();

/*

//Instanciation de la class "epce_evaluation();
$evaluation=new epce_evaluation();

// Coherence-----------------------------------------------------------------

//Vérification de la fonction d'insertion sur la table coherence

$evaluation->inserer_coherence_hp("", 5012, 'gdfgdfgdf', 'gvgdfgdf', $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $pt_vigilance);


//Vérification de la fonction update_coherence sur la table coherence

$evaluation->update_coherence_hp(5000, 'h', 'gfdgdfg dfgdfgdf', $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $pt_vigilance);


// vérification de la fonction de selection variable_coherence 

$retour=$evaluation->variable_coherence(5000);
echo $retour[0];


//Vérification de la méthode verif_beneficiaire_coherence_hp

$evaluation->verif_beneficiaire_coherence_hp(5072, 'gggg', 'r', 'v', $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $pt_vigilance);


//Aspect_commercial-----------------------------------------------------------------------------

// Vérification de la fonction inserer_aspect_commercial

$evaluation->inserer_aspect_commercial("",3050,'gdfgdfgdfg', 'ggdfgdfgdf', $analyse_concurrence_pt_fort, $analyse_concurrence_pt_faible, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic);


// verification de la fonction de mise a jour sur la table aspect_commercial

$evaluation->update_aspect_commercial(3000, 'hh', 'gsdfgfd gdfgdf', $analyse_concurrence_pt_fort, $analyse_concurrence_pt_faible, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);


// vérification de la fonction de sélection variable_aspect_commercial 

$retour=$evaluation->variable_aspect_commercial(3000);
echo $retour[0];


//Vérification de la méthode verif_beneficiaire_aspect_commercial

$evaluation->verif_beneficiaire_aspect_commercial(3000,'ggggggggggggg', $analyse_besoin_client_pt_faible, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_faible, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic);

----------------------------------------------------------------------------------------

//Vérification de la fonction validation
$evaluation->validation_epce("", 5000, '1');
----------------------------------------------------------------------------------------
// Béatrice

//_forme_juridique-----------------------------------------

// Vérification de la fonction inserer_forme_juridique

$evaluation->inserer_forme_juridique("",7000, 'fdsfgsdfsd', $pt_faible, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);

// vérification de la fonction update_forme_juridique

$evaluation->update_forme_juridique(7000, 'hhhhh', $pt_fort, $pt_faible, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);

// Vérification forme_juridique (select)

$retour=$evaluation->forme_juridique(7000);
echo $retour[0];


//Vérification de la fonction verif_beneficiaire_forme_juridique

$evaluation->verif_beneficiaire_forme_juridique(7000, 'nnnnnn', 'bbbb', $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);

//aspect_financier--------------------------------------

//Vérification de la fonction inserer_aspect_financier

$evaluation->inserer_aspect_financier("",8000, 'ggfdgdfgdf', $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);

//Vérification de la fonction update_aspect_financier

$evaluation->update_aspect_financier(8000, 'hhhhh', $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);

//Verification de la fonction aspect_financier (select)

$retour=$evaluation->aspect_financier(8000);
echo $retour[0];


//Vérification de la fonction verif_beneficiaire_aspect_financier

$evaluation->verif_beneficiaire_aspect_financier(8000,'ggggggggg', 'wwwwwwwww', $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);


//Fonctions liées à la table aspect_reglementaire-------------------

//Fonction d'insertion (aspect_reglementaire)
$evaluation->inserer_aspect_reglementaire("", 2420, 'dgdgfgfd', $pt_faibles, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendu1, $resultat_attendu2, $resultat_attendu3, $resultat_attendu4, $diagnostic);


//Fonction de mise à jour (aspect_reglementaire)

$evaluation->update_aspect_reglementaire(2410, 'bonjour', $pt_faibles, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendu1, $resultat_attendu2, $resultat_attendu3, $resultat_attendu4, $diagnostic);


//Fonction de sélection (aspect_reglementaire)

$retour=$evaluation->aspect_reglementaire(2410);
echo $retour[0];


//Vérification de la fonction verif_beneficiaire_aspect_reglementaire

$evaluation->verif_beneficiaire_aspect_reglementaire(2410, 'bonjour', $pt_faibles, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendu1, $resultat_attendu2, $resultat_attendu3, $resultat_attendu4, $diagnostic);





//--------------------------

//IMPRESSION.....

//Instaciation de la class "epce_impression();
$impression=new epce_impression();

//Vérification de la fonction remplissage
$impression->remplissage(0);
echo '<<NAME>>';

*/

?>