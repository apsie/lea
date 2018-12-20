<?php
ini_set ("error_reporting", "E_ALL & ~E_NOTICE");
class nacre_preliminaire
{
	
	/*public $db_user ="root";
	public $db_pass ="";
	public $db_host ="localhost";
	public $db_name ="lea";
*/
	
	public $db_host ="localhost";
	public $db_name ="egw_apsie143";
	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	
	
		
	function __construct()
	{		
// on se connecte à MySQL
$db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$db); 	
	}
	
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	// Fonctions liées à la table egw_nacre_preliminaire-------------------------------------
	//Fonction d'insertion (nacre_preliminaire)	
	
	function inserer_nacre_preliminaire($id, $id_beneficiaire, $id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date)
	{		
	
$requete = "insert into egw_nacre_preliminaire value ('', '$id_beneficiaire', '$id_presta', '$demande_beneficiaire', '$personnalite_createur', '$caracteri_pt_fort1', '$caracteri_pt_fort2', '$caracteri_pt_fort3', '$caracteri_pt_fort4', '$caracteri_pt_fort5', '$caracteri_pt_faible1', '$caracteri_pt_faible2', '$caracteri_pt_faible3', '$caracteri_pt_faible4', '$caracteri_pt_faible5', '$ameliorer_pt1', '$ameliorer_pt2', '$ameliorer_pt3', '$ameliorer_pt4', '$ameliorer_pt5', '$motivation_createur', '$diplome_annee1', '$diplome_annee2', '$diplome_annee3', '$diplome_annee4', '$diplome_annee5', '$diplome_obtenu1', '$diplome_obtenu2', '$diplome_obtenu3', '$diplome_obtenu4', '$diplome_obtenu5', '$formation_annee1', '$formation_annee2', '$formation_annee3', '$formation_annee4', '$formation_annee5', '$formation_suivie1', '$formation_suivie2', '$formation_suivie3', '$formation_suivie4', '$formation_suivie5', '$experience_annee1', '$experience_annee2', '$experience_annee3', '$experience_annee4', '$experience_annee5', '$experience_annee6', '$poste_occupe1', '$poste_occupe2', '$poste_occupe3', '$poste_occupe4', '$poste_occupe5', '$poste_occupe6', '$entreprise_1', '$entreprise_2', '$entreprise_3', '$entreprise_4', '$entreprise_5', '$entreprise_6', '$exp_pro_secteur', '$formation', '$acquis_extraprof', '$contraintes_perso', '$contraintes_projet', '$projet_defini', '$projet_defini_com', '$produit_defini', '$produit_defini_com', '$produit_listes', '$produit_listes_com', '$marche_determine', '$marche_determine_com', '$clientele_ciblee', '$clientele_ciblee_com', '$fournisseurs_identifies', '$fournisseurs_identifies_com', '$concurrence_identifiee', '$concurrence_identifiee_com', '$strategie_commerciale', '$strategie_commerciale_com', '$stock_initial', '$stock_initial_com', '$prix_revient', '$prix_revient_com', '$px_vente_fix', '$px_vente_fix_com', '$quantites_vendues', '$quantites_vendues_com', '$ca_calcule', '$ca_calcule_com', '$charges_activite', '$charges_activite_com', '$cpte_exploitation', '$cpte_exploitation_com', '$plan_tresorerie', '$plan_tresorerie_com', '$point_mort_calcule', '$point_mort_calcule_com', '$seuil_rentabilite', '$seuil_rentabilite_com', '$investissement_defini', '$investissement_defini_com', '$montant_apport', '$montant_apport_com', '$projet_financements', '$projet_financements_com', '$cout_chiffre', '$cout_chiffrecom','$montant_besoin', '$montant_besoin_com', '$lieu_implantation', '$lieu_implantation_com', '$local_necessaire', '$local_necessaire_com', '$local_trouve', '$local_trouve_com', '$nb_emplois_crees', '$nb_emplois_crees_com', '$nb_emplois_salaries', '$nb_emplois_salaries_com', '$statut_createur', '$statut_createur_com', '$statut_juridique', '$statut_juridique_com', '$demarches_entamees', '$demarches_entamees_com', '$regime_fiscal', '$regime_fiscal_com', '$projet_redige', '$projet_redige_com', '$adequation_validation', '$etude_economique', '$etude_financiere', '$ej_montage_creation', '$etapes_adequation', '$etapes_etude_eco', '$etapes_etude_financ', '$etapes_etude_jurid', '$etapes_montage', '$etapes_creation', '$commentaires', '$date')";


	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	//Fonction de mise à jour (nacre_preliminaire)

	function update_nacre_preliminaire($id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date)
	{
	$requete = "Update egw_nacre_preliminaire set 
	demande_beneficiaire='$demande_beneficiaire', personnalite_createur='$personnalite_createur', caracteri_pt_fort1='$caracteri_pt_fort1', caracteri_pt_fort2='$caracteri_pt_fort2', caracteri_pt_fort3='$caracteri_pt_fort3', caracteri_pt_fort4='$caracteri_pt_fort4', caracteri_pt_fort5='$caracteri_pt_fort5', caracteri_pt_faible1='$caracteri_pt_faible1', caracteri_pt_faible2='$caracteri_pt_faible2', caracteri_pt_faible3='$caracteri_pt_faible3', caracteri_pt_faible4='$caracteri_pt_faible4', caracteri_pt_faible5='$caracteri_pt_faible5', ameliorer_pt1='$ameliorer_pt1', ameliorer_pt2='$ameliorer_pt2', ameliorer_pt3='$ameliorer_pt3', ameliorer_pt4='$ameliorer_pt4', ameliorer_pt5='$ameliorer_pt5', motivation_createur='$motivation_createur', diplome_annee1='$diplome_annee1', diplome_annee2='$diplome_annee2', diplome_annee3='$diplome_annee3', diplome_annee4='$diplome_annee4', diplome_annee5='$diplome_annee5', diplome_obtenu1='$diplome_obtenu1', diplome_obtenu2='$diplome_obtenu2', diplome_obtenu3='$diplome_obtenu3', diplome_obtenu4='$diplome_obtenu4', diplome_obtenu5='$diplome_obtenu5', formation_annee1='$formation_annee1', formation_annee2='$formation_annee2', formation_annee3='$formation_annee3', formation_annee4='$formation_annee4', formation_annee5='$formation_annee5', formation_suivie1='$formation_suivie1', formation_suivie2='$formation_suivie2', formation_suivie3='$formation_suivie3', formation_suivie4='$formation_suivie4', formation_suivie5='$formation_suivie5', experience_annee1='$experience_annee1', experience_annee2='$experience_annee2', experience_annee3='$experience_annee3', experience_annee4='$experience_annee4', experience_annee5='$experience_annee5', experience_annee6='$experience_annee6', poste_occupe1='$poste_occupe1', poste_occupe2='$poste_occupe2', poste_occupe3='$poste_occupe3', poste_occupe4='$poste_occupe4', poste_occupe5='$poste_occupe5', poste_occupe6='$poste_occupe6', entreprise_1='$entreprise_1', entreprise_2='$entreprise_2', entreprise_3='$entreprise_3', entreprise_4='$entreprise_4', entreprise_5='$entreprise_5', entreprise_6='$entreprise_6', exp_pro_secteur='$exp_pro_secteur', formation='$formation', acquis_extraprof='$acquis_extraprof', contraintes_perso='$contraintes_perso', contraintes_projet='$contraintes_projet', projet_defini='$projet_defini', projet_defini_com='$projet_defini_com', produit_defini='$produit_defini', produit_defini_com='$produit_defini_com', produit_listes='$produit_listes', produit_listes_com='$produit_listes_com', marche_determine='$marche_determine', marche_determine_com='$marche_determine_com', clientele_ciblee='$clientele_ciblee', clientele_ciblee_com='$clientele_ciblee_com', fournisseurs_identifies='$fournisseurs_identifies', fournisseurs_identifies_com='$fournisseurs_identifies_com', concurrence_identifiee='$concurrence_identifiee', concurrence_identifiee_com='$concurrence_identifiee_com', strategie_commerciale='$strategie_commerciale', strategie_commerciale_com='$strategie_commerciale_com', stock_initial='$stock_initial', stock_initial_com='$stock_initial_com', prix_revient='$prix_revient', prix_revient_com='$prix_revient_com', px_vente_fix='$px_vente_fix', px_vente_fix_com='$px_vente_fix_com', quantites_vendues='$quantites_vendues', quantites_vendues_com='$quantites_vendues_com', ca_calcule='$ca_calcule', ca_calcule_com='$ca_calcule_com', charges_activite='$charges_activite', charges_activite_com='$charges_activite_com', cpte_exploitation='$cpte_exploitation', cpte_exploitation_com='$cpte_exploitation_com', plan_tresorerie='$plan_tresorerie', plan_tresorerie_com='$plan_tresorerie_com', point_mort_calcule='$point_mort_calcule', point_mort_calcule_com='$point_mort_calcule_com', seuil_rentabilite='$seuil_rentabilite', seuil_rentabilite_com='$seuil_rentabilite_com', investissement_defini='$investissement_defini', investissement_defini_com='$investissement_defini_com', cout_chiffre='$cout_chiffre', cout_chiffrecom='$cout_chiffrecom', montant_apport='$montant_apport', montant_apport_com='$montant_apport_com', projet_financements='$projet_financements', projet_financements_com='$projet_financements_com', montant_besoin='$montant_besoin', montant_besoin_com='$montant_besoin_com', lieu_implantation='$lieu_implantation', lieu_implantation_com='$lieu_implantation_com', local_necessaire='$local_necessaire', local_necessaire_com='$local_necessaire_com', local_trouve='$local_trouve', local_trouve_com='$local_trouve_com', nb_emplois_crees='$nb_emplois_crees', nb_emplois_crees_com='$nb_emplois_crees_com', nb_emplois_salaries='$nb_emplois_salaries', nb_emplois_salaries_com='$nb_emplois_salaries_com', statut_createur='$statut_createur', statut_createur_com='$statut_createur_com', statut_juridique='$statut_juridique', statut_juridique_com='$statut_juridique_com', demarches_entamees='$demarches_entamees', demarches_entamees_com='$demarches_entamees_com', regime_fiscal='$regime_fiscal', regime_fiscal_com='$regime_fiscal_com', projet_redige='$projet_redige', projet_redige_com='$projet_redige_com', adequation_validation='$adequation_validation', etude_economique='$etude_economique', etude_financiere='$etude_financiere', ej_montage_creation='$ej_montage_creation', etapes_adequation='$etapes_adequation', etapes_etude_eco='$etapes_etude_eco', etapes_etude_financ='$etapes_etude_financ', etapes_etude_jurid='$etapes_etude_jurid', etapes_montage='$etapes_montage', etapes_creation='$etapes_creation', commentaires='$commentaires', date='$date' where id_presta = $id_presta";
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	//Fonction de selection	(nacre_preliminaire)
	
	function variable_nacre_preliminaire($id_presta)
	{	
		$requete='SELECT * FROM  egw_nacre_preliminaire  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$demande_beneficiaire=$row['demande_beneficiaire'];
			$personnalite_createur=$row['personnalite_createur'];
			$caracteri_pt_fort1=$row['caracteri_pt_fort1'];
			$caracteri_pt_fort2=$row['caracteri_pt_fort2'];
			$caracteri_pt_fort3=$row['caracteri_pt_fort3'];
			$caracteri_pt_fort4=$row['caracteri_pt_fort4'];
			$caracteri_pt_fort5=$row['caracteri_pt_fort5'];
			$caracteri_pt_faible1=$row['caracteri_pt_faible1'];
			$caracteri_pt_faible2=$row['caracteri_pt_faible2'];
			$caracteri_pt_faible3=$row['caracteri_pt_faible3'];
			$caracteri_pt_faible4=$row['caracteri_pt_faible4'];
			$caracteri_pt_faible5=$row['caracteri_pt_faible5'];
			$ameliorer_pt1=$row['ameliorer_pt1'];
			$ameliorer_pt2=$row['ameliorer_pt2'];
			$ameliorer_pt3=$row['ameliorer_pt3'];
			$ameliorer_pt4=$row['ameliorer_pt4'];
			$ameliorer_pt5=$row['ameliorer_pt5'];
			$motivation_createur=$row['motivation_createur'];
			$diplome_annee1=$row['diplome_annee1'];
			$diplome_annee2=$row['diplome_annee2'];
			$diplome_annee3=$row['diplome_annee3'];
			$diplome_annee4=$row['diplome_annee4'];
			$diplome_annee5=$row['diplome_annee5'];
			$diplome_obtenu1=$row['diplome_obtenu1'];
			$diplome_obtenu2=$row['diplome_obtenu2'];
			$diplome_obtenu3=$row['diplome_obtenu3'];
			$diplome_obtenu4=$row['diplome_obtenu4'];
			$diplome_obtenu5=$row['diplome_obtenu5'];
			$formation_annee1=$row['formation_annee1'];
			$formation_annee2=$row['formation_annee2'];
			$formation_annee3=$row['formation_annee3'];
			$formation_annee4=$row['formation_annee4'];
			$formation_annee5=$row['formation_annee5'];
			$formation_suivie1=$row['formation_suivie1'];
			$formation_suivie2=$row['formation_suivie2'];
			$formation_suivie3=$row['formation_suivie3'];
			$formation_suivie4=$row['formation_suivie4'];
			$formation_suivie5=$row['formation_suivie5'];
			$experience_annee1=$row['experience_annee1'];
			$experience_annee2=$row['experience_annee2'];
			$experience_annee3=$row['experience_annee3'];
			$experience_annee4=$row['experience_annee4'];
			$experience_annee5=$row['experience_annee5'];
			$experience_annee6=$row['experience_annee6'];
			$poste_occupe1=$row['poste_occupe1'];
			$poste_occupe2=$row['poste_occupe2'];
			$poste_occupe3=$row['poste_occupe3'];
			$poste_occupe4=$row['poste_occupe4'];
			$poste_occupe5=$row['poste_occupe5'];
			$poste_occupe6=$row['poste_occupe6'];
			$entreprise_1=$row['entreprise_1'];
			$entreprise_2=$row['entreprise_2'];
			$entreprise_3=$row['entreprise_3'];
			$entreprise_4=$row['entreprise_4'];
			$entreprise_5=$row['entreprise_5'];
			$entreprise_6=$row['entreprise_6'];
			$exp_pro_secteur=$row['exp_pro_secteur'];
			$formation=$row['formation'];
			$acquis_extraprof=$row['acquis_extraprof'];
			$contraintes_perso=$row['contraintes_perso'];
			$contraintes_projet=$row['contraintes_projet'];
			$projet_defini=$row['projet_defini'];
			$projet_defini_com=$row['projet_defini_com'];
			$produit_defini=$row['produit_defini'];
			$produit_defini_com=$row['produit_defini_com'];
			$produit_listes=$row['produit_listes'];
			$produit_listes_com=$row['produit_listes_com'];
			$marche_determine=$row['marche_determine'];
			$marche_determine_com=$row['marche_determine_com'];
			$clientele_ciblee=$row['clientele_ciblee'];
			$clientele_ciblee_com=$row['clientele_ciblee_com'];
			$fournisseurs_identifies=$row['fournisseurs_identifies'];
			$fournisseurs_identifies_com=$row['fournisseurs_identifies_com'];
			$concurrence_identifiee=$row['concurrence_identifiee']; 
			$concurrence_identifiee_com=$row['concurrence_identifiee_com'];
			$strategie_commerciale=$row['strategie_commerciale'];
			$strategie_commerciale_com=$row['strategie_commerciale_com'];
			$stock_initial=$row['stock_initial'];
			$stock_initial_com=$row['stock_initial_com'];
			$prix_revient=$row['prix_revient'];
			$prix_revient_com=$row['prix_revient_com'];
			$px_vente_fix=$row['px_vente_fix'];
			$px_vente_fix_com=$row['px_vente_fix_com'];
			$quantites_vendues=$row['quantites_vendues'];
			$quantites_vendues_com=$row['quantites_vendues_com'];
			$ca_calcule=$row['ca_calcule'];
			$ca_calcule_com=$row['ca_calcule_com'];
			$charges_activite=$row['charges_activite'];
			$charges_activite_com=$row['charges_activite_com'];
			$cpte_exploitation=$row['cpte_exploitation'];
			$cpte_exploitation_com=$row['cpte_exploitation_com'];
			$plan_tresorerie=$row['plan_tresorerie'];
			$plan_tresorerie_com=$row['plan_tresorerie_com'];
			$point_mort_calcule=$row['point_mort_calcule'];
			$point_mort_calcule_com=$row['point_mort_calcule_com'];
			$seuil_rentabilite=$row['seuil_rentabilite'];
			$seuil_rentabilite_com=$row['seuil_rentabilite_com'];
			$investissement_defini=$row['investissement_defini'];
			$investissement_defini_com=$row['investissement_defini_com'];
			$cout_chiffre=$row['cout_chiffre'];
			$cout_chiffrecom=$row['cout_chiffrecom'];			
			$montant_apport=$row['montant_apport'];
			$montant_apport_com=$row['montant_apport_com'];
			$projet_financements=$row['projet_financements'];
			$projet_financements_com=$row['projet_financements_com'];
			$montant_besoin=$row['montant_besoin'];
			$montant_besoin_com=$row['montant_besoin_com'];
			$lieu_implantation=$row['lieu_implantation'];
			$lieu_implantation_com=$row['lieu_implantation_com'];
			$local_necessaire=$row['local_necessaire'];
			$local_necessaire_com=$row['local_necessaire_com'];
			$local_trouve=$row['local_trouve'];
			$local_trouve_com=$row['local_trouve_com'];
			$nb_emplois_crees=$row['nb_emplois_crees'];
			$nb_emplois_crees_com=$row['nb_emplois_crees_com'];
			$nb_emplois_salaries=$row['nb_emplois_salaries'];
			$nb_emplois_salaries_com=$row['nb_emplois_salaries_com'];
			$statut_createur=$row['statut_createur'];
			$statut_createur_com=$row['statut_createur_com'];
			$statut_juridique=$row['statut_juridique'];
			$statut_juridique_com=$row['statut_juridique_com'];
			$demarches_entamees=$row['demarches_entamees'];
			$demarches_entamees_com=$row['demarches_entamees_com'];
			$regime_fiscal=$row['regime_fiscal'];
			$regime_fiscal_com=$row['regime_fiscal_com'];
			$projet_redige=$row['projet_redige'];
			$projet_redige_com=$row['projet_redige_com'];
			$adequation_validation=$row['adequation_validation'];
			$etude_economique=$row['etude_economique'];
			$etude_financiere=$row['etude_financiere'];
			$ej_montage_creation=$row['ej_montage_creation'];
			$etapes_adequation=$row['etapes_adequation'];
			$etapes_etude_eco=$row['etapes_etude_eco'];
			$etapes_etude_financ=$row['etapes_etude_financ'];
			$etapes_etude_jurid=$row['etapes_etude_jurid'];
			$etapes_montage=$row['etapes_montage'];
			$etapes_creation=$row['etapes_creation'];
			$commentaires=$row['commentaires'];
			$id_presta=$row['id_presta'];
			$date=$row['date'];
						
		}
		
		return array($demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $id_presta, $date);
			
	}
	
	//Fonction de vérification 'id_presta (nacre_preliminaire)
	
	//Vérification de l'id_presta dans la table egw_nacre_preliminaire
	//Si il existe faire une mise à jour , sinon le créer
	
	
	function verif_presta_nacre_preliminaire($id_beneficiaire, $id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com,$px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date)
	
		{
		//1.select sur table egw_nacre_preliminaire where id_presta=id_presta
		//variable_nacre_preliminaire($id_presta);
		
		$requete='SELECT * FROM  egw_nacre_preliminaire  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
		 $this->inserer_nacre_preliminaire($id, $id_beneficiaire, $id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com,$px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date);
	
	}
	else
		{
		$this->update_nacre_preliminaire($id_presta, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee1, $diplome_annee2, $diplome_annee3, $diplome_annee4, $diplome_annee5, $diplome_obtenu1, $diplome_obtenu2, $diplome_obtenu3, $diplome_obtenu4, $diplome_obtenu5, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee1, $experience_annee2, $experience_annee3, $experience_annee4, $experience_annee5, $experience_annee6, $poste_occupe1, $poste_occupe2, $poste_occupe3, $poste_occupe4, $poste_occupe5, $poste_occupe6, $entreprise_1, $entreprise_2, $entreprise_3, $entreprise_4, $entreprise_5, $entreprise_6, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $px_vente_fix, $px_vente_fix_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $cout_chiffre, $cout_chiffrecom, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_validation, $etude_economique, $etude_financiere, $ej_montage_creation, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date);	
		}	
	
		}
		
	
	
	
	
	//Fonction de validation
	
	/*function validation($id, $id_beneficiaire, $validation)
	{
		$requete = "insert into egw_epce_validation value ('','$id_beneficiaire','$validation')";
		$resultat = mysql_query($requete) or die(mysql_error());		
		
		}*/
	
	//----------------------------------------------------
	
	//Fermeture de la connexion à la base de données
	

	function _destruct()
	{
	
	mysql_close();
	}

		
}

?>