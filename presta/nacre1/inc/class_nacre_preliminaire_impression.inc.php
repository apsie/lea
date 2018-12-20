<?php
ini_set ("error_reporting", "E_ALL & ~E_NOTICE");
class nacre_preliminaire_impression
{
	
	/*public $db_user ="root";
	public $db_host ="localhost";
	public $db_name ="lea";
	public $db_pass ="";*/
	
	public $db_user ="root";
	public $db_host ="localhost";
	public $db_name ="egw_apsie143";
	public $db_pass ="Spirea237Apsie";
	
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
	
	
function imprimer($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee, $diplome_obtenu,  $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee, $poste_occupe, $entreprise, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_parcours, $validation_parcours, $etude_economique, $validation_viabilite, $etude_financiere, $validation_faisabilite, $ej_montage_creation, $ej_montage_creation2, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date,$avan_projet,$desc_proj)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =ENTRETIEN_PRELIMINAIRE_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');

//Ouvre le fichier modèle
$filename='./doc/entretien_preliminaire.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//condition
/*if($v==1)
{
	$ind="X";
	$c="";
}
elseif($v==2)
{}
*/
//condition champs $personnalite_createur

$ex_pers=explode(",", $personnalite_createur);
for ($i=0; $i<count($ex_pers); $i++)
{
	if($ex_pers[$i]=="dynamique")
	{
		$dynamique="X";
		
		}
		if($ex_pers[$i]=="autoritaire")
	{
		$autoritaire="X";
		
		}		
		if($ex_pers[$i]=="tetu")
	{
		$tetu="X";
		
		}
		if($ex_pers[$i]=="enthousiaste")
	{
		$enthousiaste="X";
		
		}
		if($ex_pers[$i]=="entreprenant")
	{
		$entreprenant="X";
		
		}
		if($ex_pers[$i]=="sens de linitiative")
	{
		$sensinitiative="X";
		
		}
		if($ex_pers[$i]=="conformiste")
	{
		$conformiste="X";
		
		}
		if($ex_pers[$i]=="d humeur changeante")
	{
		$humeurchangeante="X";
		
		}
		if($ex_pers[$i]=="emotif sensible")
	{
		$emotifsensible="X";
		
		}
		if($ex_pers[$i]=="volontaire")
	{
		$volontaire="X";
		
		}
		if($ex_pers[$i]=="desordonne")
	{
		$desordonne="X";
		
		}
		if($ex_pers[$i]=="realiste")
	{
		$realiste="X";
		
		}
		if($ex_pers[$i]=="logique")
	{
		$logique="X";
		
		}
		if($ex_pers[$i]=="intuitif")
	{
		$intuitif="X";
		
		}
		if($ex_pers[$i]=="adaptable")
	{
		$adaptable="X";
		
		}
		if($ex_pers[$i]=="rigoureux")
	{
		$rigoureux="X";
		
		}
		if($ex_pers[$i]=="autonome")
	{
		$autonome="X";
		
		}
		if($ex_pers[$i]=="intransigeant")
	{
		$intransigeant="X";
		
		}if($ex_pers[$i]=="esprit d equipe")
	{
		$espritdequipe="X";
		
		}if($ex_pers[$i]=="disperse")
	{
		$disperse="X";
		
		}if($ex_pers[$i]=="ne sait pas ecouter")
	{
		$nesaitpasecouter="X";
		
		}		
		if($ex_pers[$i]=="constructif")
	{
		$constructif="X";
		
		}
		if($ex_pers[$i]=="pointilleux")
	{
		$pointilleux="X";
		
		}
		if($ex_pers[$i]=="inattentif")
	{
		$inattentif="X";
		
		}
		if($ex_pers[$i]=="large d esprit")
	{
		$largedesprit="X";
		
		}
		if($ex_pers[$i]=="susceptible")
	{
		$susceptible="X";
		
		}
		if($ex_pers[$i]=="negociateur")
	{
		$negociateur="X";
		
		}
		if($ex_pers[$i]=="manuel")
	{
		$manuel="X";
		
		}
		if($ex_pers[$i]=="creatif")
	{
		$creatif="X";
		
		}
		if($ex_pers[$i]=="empathique")
	{
		$empathique="X";
		
		}
		if($ex_pers[$i]=="capable de travailler sous pression")
	{
		$souspression="X";
		
		}		
		if($ex_pers[$i]=="etourdi")
	{
		$etourdi="X";
		
		}
		if($ex_pers[$i]=="optimiste")
	{
		$optimiste="X";
		
		}
		if($ex_pers[$i]=="pessimiste")
	{
		$pessimiste="X";
		
		}
		if($ex_pers[$i]=="maniaque")
	{
		$maniaque="X";
		
		}
		if($ex_pers[$i]=="souple ouvert")
	{
		$soupleouvert="X";
		
		}
		if($ex_pers[$i]=="organise")
	{
		$organise="X";
		
		}
		if($ex_pers[$i]=="raleur")
	{
		$raleur="X";
		
		}
		if($ex_pers[$i]=="sociable")
	{
		$sociable="X";
		
		}if($ex_pers[$i]=="timide")
	{
		$timide="X";
		
		}
		if($ex_pers[$i]=="ferme")
	{
		$ferme="X";
		
		}
		if($ex_pers[$i]=="dilettante")
	{
		$dilettante="X";
		
		}
		if($ex_pers[$i]=="tenace")
	{
		$tenace="X";
		
		}
		if($ex_pers[$i]=="curieux")
	{
		$curieux="X";
		
		}
		if($ex_pers[$i]=="anxieux")
	{
		$anxieux="X";
		
		}		
		if($ex_pers[$i]=="innovateur")
	{
		$innovateur="X";
		
		}
		if($ex_pers[$i]=="consciencieux")
	{
		$consciencieux="X";
		
		}
		if($ex_pers[$i]=="impatient")
	{
		$impatient="X";
		
		}
		if($ex_pers[$i]=="perseverant")
	{
		$perseverant="X";
		
		}
		if($ex_pers[$i]=="imprevoyant")
	{
		$imprevoyant="X";
		
		}
		if($ex_pers[$i]=="individualiste")
	{
		$individualiste="X";
		
		}
		if($ex_pers[$i]=="apprend rapidement")
	{
		$apprendrapidement="X";
		
		}
		if($ex_pers[$i]=="reflechi")
	{
		$reflechi="X";
		
		}
		if($ex_pers[$i]=="rigide")
	{
		$rigide="X";
		
		}
		if($ex_pers[$i]=="diplomate")
	{
		$diplomate="X";
		
		}
		if($ex_pers[$i]=="pedagogue")
	{
		$pedagogue="X";
		
		}
		if($ex_pers[$i]=="pragmatique")
	{
		$pragmatique="X";
		
		}if($ex_pers[$i]=="gout du risque")
	{
		$goutrisque="X";
		
		}
		if($ex_pers[$i]=="sens de l ecoute")
	{
		$sensecoute="X";
		
		}
		if($ex_pers[$i]=="sens de l humour")
	{
		$senshumour="X";
		
		}
		
	}

//condition champs $motivation_createur
$motiv=explode(",", $motivation_createur);
for ($i=0; $i<count($motiv); $i++)
{
	if($motiv[$i]=="1")
	{
		$desir_ind="X";
		
		}
		if($motiv[$i]=="2")
	{
		$gout_resp="X";
		
		}		
		if($motiv[$i]=="3")
	{
		$conc_reve="X";
		
		}
		if($motiv[$i]=="4")
	{
		$chang_vie="X";
		
		}
		if($motiv[$i]=="5")
	{
		$expl_opport="X";
		
		}
		if($motiv[$i]=="6")
	{
		$acc_statu="X";
		
		}
		if($motiv[$i]=="7")
	{
		$disp_revenu="X";
		
		}
		if($motiv[$i]=="8")
	{
		$augm_rev="X";
		
		}
		if($motiv[$i]=="9")
	{
		$trav_conj="X";
		
		}
		if($motiv[$i]=="10")
	{
		$partenaria="X";
		
		}
}



//condition champs $exp_pro_secteur
if($exp_pro_secteur=="1")
{
	$exp_tfaib="X";
	$exp_faib="";
	$exp_fort="";
	$exp_tfor="";
	
}
elseif($exp_pro_secteur=="2")
{
	$exp_tfaib="";
	$exp_faib="X";
	$exp_fort="";
	$exp_tfor="";
}
elseif($exp_pro_secteur=="3")
{
	$exp_tfaib="";
	$exp_faib="";
	$exp_fort="X";
	$exp_tfor="";
}
elseif($exp_pro_secteur=="4")
{
	$exp_tfaib="";
	$exp_faib="";
	$exp_fort="";
	$exp_tfor="X";
}

//condition champs $formation
if($formation=="1")
{
	$form_tfaib="X";
	$form_faib="";
	$form_fort="";
	$form_tfor="";
	
}
elseif($formation=="2")
{
	$form_tfaib="";
	$form_faib="X";
	$form_fort="";
	$form_tfor="";
}
elseif($formation=="3")
{
	$form_tfaib="";
	$form_faib="";
	$form_fort="X";
	$form_tfor="";
}
elseif($formation=="4")
{
	$form_tfaib="";
	$form_faib="";
	$form_fort="";
	$form_tfor="X";
}

//condition champs $acquis_extraprof
if($acquis_extraprof=="1")
{
	$acquis_tfai="X";
	$acquis_fai="";
	$acquis_for="";
	$acquis_tfor="";
	
}
elseif($acquis_extraprof=="2")
{
	$acquis_tfai="";
	$acquis_fai="X";
	$acquis_for="";
	$acquis_tfor="";
}
elseif($acquis_extraprof=="3")
{
	$acquis_tfai="";
	$acquis_fai="";
	$acquis_for="X";
	$acquis_tfor="";
}
elseif($acquis_extraprof=="4")
{
	$acquis_tfai="";
	$acquis_fai="";
	$acquis_for="";
	$acquis_tfor="X";
}

//condition champs $contraintes_perso
$perso=explode(",", $contraintes_perso);
for ($i=0; $i<count($perso); $i++)
{
	if($perso[$i]=="1")
	{
		$cont_fam="X";
		
		}
		if($perso[$i]=="2")
	{
		$cont_sant="X";
		
		}		
		if($perso[$i]=="3")
	{
		$cont_tps="X";
		
		}
		if($perso[$i]=="4")
	{
		$cont_fin="X";
		
		}
}

//------------------------------------------------------------------------------
//condition champs $contraintes_projet
$projet=explode(",", $contraintes_projet);
for ($i=0; $i<count($projet); $i++)
{
	if($projet[$i]=="1")
	{
		$cont_prod="X";
		
		}
		if($projet[$i]=="2")
	{
		$cont_march="X";
		
		}		
		if($projet[$i]=="3")
	{
		$cont_moy="X";
		
		}
		if($projet[$i]=="4")
	{
		$cont_leg="X";
		
		}
}

//condition champs $projet_defini
if($projet_defini=="1")
{
	$proj_clair1="X";
	$proj_clair2="";
	$proj_clair3="";	
}
elseif($projet_defini=="2")
{
	$proj_clair1="";
	$proj_clair2="X";
	$proj_clair3="";
}
elseif($projet_defini=="3")
{
	$proj_clair1="";
	$proj_clair2="";
	$proj_clair3="X";
}

//condition champs $produit_defini
if($produit_defini=="1")
{
	$prod_def1="X";
	$prod_def2="";
	$prod_def3="";
		
}
elseif($produit_defini=="2")
{
	$prod_def1="";
	$prod_def2="X";
	$prod_def3="";
}
elseif($produit_defini=="3")
{
	$prod_def1="";
	$prod_def2="";
	$prod_def3="X";
}


//condition champs $produit_listes
if($produit_listes=="1")
{
	$prod_list1="X";
	$prod_list2="";
	$prod_list3="";
	
}
elseif($produit_listes=="2")
{
	$prod_list1="";
	$prod_list2="X";
	$prod_list3="";
}
elseif($produit_listes=="3")
{
	$prod_list1="";
	$prod_list2="";
	$prod_list3="X";
}

//condition champs $marche_determine
if($marche_determine=="1")
{
	$march_det1="X";
	$march_det2="";
	$march_det3="";
	
}
elseif($marche_determine=="2")
{
	$march_det1="";
	$march_det2="X";
	$march_det3="";
}
elseif($marche_determine=="3")
{
	$march_det1="";
	$march_det2="";
	$march_det3="X";
}

//condition champs $clientele_ciblee
if($clientele_ciblee=="1")
{
	$clien_cib1="X";
	$clien_cib2="";
	$clien_cib3="";
	
}
elseif($clientele_ciblee=="2")
{
	$clien_cib1="";
	$clien_cib2="X";
	$clien_cib3="";
}
elseif($clientele_ciblee=="3")
{
	$clien_cib1="";
	$clien_cib2="";
	$clien_cib3="X";
}

//condition champs $fournisseurs_identifies
if($fournisseurs_identifies=="1")
{
	$frs_id1="X";
	$frs_id2="";
	$frs_id3="";
}
elseif($fournisseurs_identifies=="2")
{
	$frs_id1="";
	$frs_id2="X";
	$frs_id3="";
}
elseif($fournisseurs_identifies=="3")
{
	$frs_id1="";
	$frs_id2="";
	$frs_id3="X";
}

//condition champs $concurrence_identifiee
if($concurrence_identifiee=="1")
{
	$conc_id1="X";
	$conc_id2="";
	$conc_id3="";
	
}
elseif($concurrence_identifiee=="2")
{
	$conc_id1="";
	$conc_id2="X";
	$conc_id3="";
}
elseif($concurrence_identifiee=="3")
{
	$conc_id1="";
	$conc_id2="";
	$conc_id3="X";
}
//condition champs $strategie_commerciale
if($strategie_commerciale=="1")
{
	$strat_def1="X";
	$strat_def2="";
	$strat_def3="";
}
elseif($strategie_commerciale=="2")
{
	$strat_def1="";
	$strat_def2="X";
	$strat_def3="";
}
elseif($strategie_commerciale=="3")
{
	$strat_def1="";
	$strat_def2="";
	$strat_def3="X";
}
//condition champs $stock_initial
if($stock_initial=="1")
{
	$stoc_def1="X";
	$stoc_def2="";
	$stoc_def3="";
	}
elseif($stock_initial=="2")
{
	$stoc_def1="";
	$stoc_def2="X";
	$stoc_def3="";
}
elseif($stock_initial=="3")
{
	$stoc_def1="";
	$stoc_def2="";
	$stoc_def3="X";
}

//condition champs $prix_revient
if($prix_revient=="1")
{
	$px_rev1="X";
	$px_rev2="";
	$px_rev3="";
}
elseif($prix_revient=="2")
{
	$px_rev1="";
	$px_rev2="X";
	$px_rev3="";
}
elseif($prix_revient=="3")
{
	$px_rev1="";
	$px_rev2="";
	$px_rev3="X";
}
//condition champs $px_vente_fix
if($px_vente_fix=="1")
{
	$px_fix1="X";
	$px_fix2="";
	$px_fix3="";
	
}
elseif($px_vente_fix=="2")
{
	$px_fix1="";
	$px_fix2="X";
	$px_fix3="";
}
elseif($px_vente_fix=="3")
{
	$px_fix1="";
	$px_fix2="";
	$px_fix3="X";
}

//condition champs $quantites_vendues
if($quantites_vendues=="1")
{
	$quan_est1="X";
	$quan_est2="";
	$quan_est3="";
	
}
elseif($quantites_vendues=="2")
{
	$quan_est1="";
	$quan_est2="X";
	$quan_est3="";
}
elseif($quantites_vendues=="3")
{
	$quan_est1="";
	$quan_est2="";
	$quan_est3="X";
}
//condition champs $ca_calcule
if($ca_calcule=="1")
{
	$ca_calc1="X";
	$ca_calc2="";
	$ca_calc3="";
	}
elseif($ca_calcule=="2")
{
	$ca_calc1="";
	$ca_calc2="X";
	$ca_calc3="";
}
elseif($ca_calcule=="3")
{
	$ca_calc1="";
	$ca_calc2="";
	$ca_calc3="X";
}

//condition champs $charges_activite
if($charges_activite=="1")
{
	$char_chif1="X";
	$char_chif2="";
	$char_chif3="";
}
elseif($charges_activite=="2")
{
	$char_chif1="";
	$char_chif2="X";
	$char_chif3="";
}
elseif($charges_activite=="3")
{
	$char_chif1="";
	$char_chif2="";
	$char_chif3="X";
}
//condition champs $cpte_exploitation
if($cpte_exploitation=="1")
{
	$cpt_fin1="X";
	$cpt_fin2="";
	$cpt_fin3="";
	
}
elseif($cpte_exploitation=="2")
{
	$cpt_fin1="";
	$cpt_fin2="X";
	$cpt_fin3="";
}
elseif($cpte_exploitation=="3")
{
	$cpt_fin1="";
	$cpt_fin2="";
	$cpt_fin3="X";
}

//condition champs $plan_tresorerie
if($plan_tresorerie=="1")
{
	$pl_fin1="X";
	$pl_fin2="";
	$pl_fin3="";
}
elseif($plan_tresorerie=="2")
{
	$pl_fin1="";
	$pl_fin2="X";
	$pl_fin3="";
}
elseif($plan_tresorerie=="3")
{
	$pl_fin1="";
	$pl_fin2="";
	$pl_fin3="X";
}
//condition champs $point_mort_calcule
if($point_mort_calcule=="1")
{
	$pt_mcal1="X";
	$pt_mcal2="";
	$pt_mcal3="";
	}
elseif($point_mort_calcule=="2")
{
	$pt_mcal1="";
	$pt_mcal2="X";
	$pt_mcal3="";
}
elseif($point_mort_calcule=="3")
{
	$pt_mcal1="";
	$pt_mcal2="";
	$pt_mcal3="X";
}
//condition champs $seuil_rentabilite
if($seuil_rentabilite=="1")
{
	$seuil_con1="X";
	$seuil_con2="";
	$seuil_con3="";
	}
elseif($seuil_rentabilite=="2")
{
	$seuil_con1="";
	$seuil_con2="X";
	$seuil_con3="";
}
elseif($seuil_rentabilite=="3")
{
	$seuil_con1="";
	$seuil_con2="";
	$seuil_con3="X";
}
//condition champs $investissement_defini
if($investissement_defini=="1")
{
	$inv_def1="X";
	$inv_def2="";
	$inv_def3="";
	}
elseif($investissement_defini=="2")
{
	$inv_def1="";
	$inv_def2="X";
	$inv_def3="";
}
elseif($investissement_defini=="3")
{
	$inv_def1="";
	$inv_def2="";
	$inv_def3="X";
}

//condition champs $cout_chiffre
if($cout_chiffre=="1")
{
	$cout_chi1="X";
	$cout_chi2="";
	$cout_chi3="";
}
elseif($cout_chiffre=="2")
{
	$cout_chi1="";
	$cout_chi2="X";
	$cout_chi3="";
}
elseif($cout_chiffre=="3")
{
	$cout_chi1="";
	$cout_chi2="";
	$cout_chi3="X";
}
//condition champs $montant_apport
if($montant_apport=="1")
{
	$mtt_app1="X";
	$mtt_app2="";
	$mtt_app3="";
	}
elseif($montant_apport=="2")
{
	$mtt_app1="";
	$mtt_app2="X";
	$mtt_app3="";
}
elseif($montant_apport=="3")
{
	$mtt_app1="";
	$mtt_app2="";
	$mtt_app3="X";
}
//condition champs $projet_financements
if($projet_financements=="1")
{
	$proj_fin1="X";
	$proj_fin2="";
	$proj_fin3="";
}
elseif($projet_financements=="2")
{
	$proj_fin1="";
	$proj_fin2="X";
	$proj_fin3="";
}
elseif($projet_financements=="3")
{
	$proj_fin1="";
	$proj_fin2="";
	$proj_fin3="X";
}
//condition champs $montant_besoin
if($montant_besoin=="1")
{
	$mtt_fin1="X";
	$mtt_fin2="";
	$mtt_fin3="";
}
elseif($montant_besoin=="2")
{
	$mtt_fin1="";
	$mtt_fin2="X";
	$mtt_fin3="";
}
elseif($montant_besoin=="3")
{
	$mtt_fin1="";
	$mtt_fin2="";
	$mtt_fin3="X";
}
//condition champs $lieu_implantation
if($lieu_implantation=="1")
{
	$lieu_choi1="X";
	$lieu_choi2="";
	$lieu_choi3="";
	}
elseif($lieu_implantation=="2")
{
	$lieu_choi1="";
	$lieu_choi2="X";
	$lieu_choi3="";
}
elseif($lieu_implantation=="3")
{
	$lieu_choi1="";
	$lieu_choi2="";
	$lieu_choi3="X";
}
//condition champs $local_necessaire
if($local_necessaire=="1")
{
	$loc_nec1="X";
	$loc_nec2="";
	$loc_nec3="";
}
elseif($local_necessaire=="2")
{
	$loc_nec1="";
	$loc_nec2="X";
	$loc_nec3="";
}
elseif($local_necessaire=="3")
{
	$loc_nec1="";
	$loc_nec2="";
	$loc_nec3="X";
}

//condition champs $local_trouve
if($local_trouve=="1")
{
	$loc_trou1="X";
	$loc_trou2="";
	$loc_trou3="";
	}
elseif($local_trouve=="2")
{
	$loc_trou1="";
	$loc_trou2="X";
	$loc_trou3="";
}
elseif($local_trouve=="3")
{
	$loc_trou1="";
	$loc_trou2="";
	$loc_trou3="X";
}

//condition champs $nb_emplois_crees
if($nb_emplois_crees=="1")
{
	$nb_cree1="X";
	$nb_cree2="";
	$nb_cree3="";
}
elseif($nb_emplois_crees=="2")
{
	$nb_cree1="";
	$nb_cree2="X";
	$nb_cree3="";
}
elseif($nb_emplois_crees=="3")
{
	$nb_cree1="";
	$nb_cree2="";
	$nb_cree3="X";
}

//condition champs $nb_emplois_salaries
if($nb_emplois_salaries=="1")
{
	$nb_sal1="X";
	$nb_sal2="";
	$nb_sal3="";
}
elseif($nb_emplois_salaries=="2")
{
	$nb_sal1="";
	$nb_sal2="X";
	$nb_sal3="";
}
elseif($nb_emplois_salaries=="3")
{
	$nb_sal1="";
	$nb_sal2="";
	$nb_sal3="X";
}

//condition champs $statut_createur
if($statut_createur=="1")
{
	$stat_cdef1="X";
	$stat_cdef2="";
	$stat_cdef3="";
}
elseif($statut_createur=="2")
{
	$stat_cdef1="";
	$stat_cdef2="X";
	$stat_cdef3="";
}
elseif($statut_createur=="3")
{
	$stat_cdef1="";
	$stat_cdef2="";
	$stat_cdef3="X";
}

//condition champs $statut_juridique
if($statut_juridique=="1")
{
	$stat_jdef1="X";
	$stat_jdef2="";
	$stat_jdef3="";
}
elseif($statut_juridique=="2")
{
	$stat_jdef1="";
	$stat_jdef2="X";
	$stat_jdef3="";
}
elseif($statut_juridique=="3")
{
	$stat_jdef1="";
	$stat_jdef2="";
	$stat_jdef3="X";
}

//condition champs $demarches_entamees
if($demarches_entamees=="1")
{
	$dem_ent1="X";
	$dem_ent2="";
	$dem_ent3="";
	
}
elseif($demarches_entamees=="2")
{
	$dem_ent1="";
	$dem_ent2="X";
	$dem_ent3="";
}
elseif($demarches_entamees=="3")
{
	$dem_ent1="";
	$dem_ent2="";
	$dem_ent3="X";
}

//condition champs $regime_fiscal
if($regime_fiscal=="1")
{
	$regi_choi1="X";
	$regi_choi2="";
	$regi_choi3="";
	
}
elseif($regime_fiscal=="2")
{
	$regi_choi1="";
	$regi_choi2="X";
	$regi_choi3="";
}
elseif($regime_fiscal=="3")
{
	$regi_choi1="";
	$regi_choi2="";
	$regi_choi3="X";
}

//condition champs $projet_redige
if($projet_redige=="1")
{
	$proj_red1="X";
	$proj_red2="";
	$proj_red3="";
	
}
elseif($projet_redige=="2")
{
	$proj_red1="";
	$proj_red2="X";
	$proj_red3="";
}
elseif($projet_redige=="3")
{
	$proj_red1="";
	$proj_red2="";
	$proj_red3="X";
}

//*******************Condition Plan d'accompagnement**************************************

//Condition champs $adequation_validation
$ad_va=explode(",", $adequation_validation);
for ($i=0; $i<count($ad_va); $i++)
{
	
		if($ad_va[$i]=="adequation")
	{
		$adeq_proj="X";
		
		}
		if($ad_va[$i]=="analyse")
	{
		$analyse_ant="X";
		
		}
		if($ad_va[$i]=="indentification1")
	{
		$ident_com="X";
		
		}
		if($ad_va[$i]=="identification2")
	{
		$ident_tech="X";
		
		}
		if($ad_va[$i]=="identification3")
	{
		$ident_gest="X";
		
		}
		if($ad_va[$i]=="validation")
	{
		$vali_proj="X";
		
		}
}

//Condition champs $etude_economique
$e_economique=explode(",", $etude_economique);
for ($i=0; $i<count($e_economique); $i++)
{	
	if($e_economique[$i]=="etude1")
	{
		$etud_eco="X";
		
		}
		if($e_economique[$i]=="definition1")
	{
		$def_sces="X";
		
		}
		if($e_economique[$i]=="etude2")
	{
		$etud_mar="X";
		
		}
		if($e_economique[$i]=="definition2")
	{
		$def_cli="X";
		
		}
		if($e_economique[$i]=="etude3")
	{
		$etud_conc="X";
		
		}
		if($e_economique[$i]=="etude4")
	{
		$etud_frs="X";
		
		}
		if($e_economique[$i]=="elaboration")
	{
		$elab_mix="X";
		
		}
		if($e_economique[$i]=="moyen")
	{
		$moy_mhfin="X";
		
		}
		if($e_economique[$i]=="validation")
	{
		$vali_viab="X";
		
		}
}

//Condition champs $etude_financiere
$e_fin=explode(",", $etude_financiere);
for ($i=0; $i<count($e_fin); $i++)
{
		if($e_fin[$i]=="etude")
	{
		$etud_fin="X";
		
		}
		if($e_fin[$i]=="calcul1")
	{
		$cal_pxvente="X";
		
		}		
		if($e_fin[$i]=="calcul2")
	{
		$cal_ca="X";
		
		}
		if($e_fin[$i]=="definition")
	{
		$def_charg="X";
		
		}
		if($e_fin[$i]=="calcul3")
	{
		$cal_rent="X";
		
		}
		if($e_fin[$i]=="calcul4")
	{
		$cal_roul="X";
		
		}
		if($e_fin[$i]=="plan1")
	{
		$plan_mens="X";
		
		}
		if($e_fin[$i]=="liste")
	{
		$li_nece="X";
		
		}
		if($e_fin[$i]=="elaboration")
	{
		$elab_immo="X";
		
		}if($e_fin[$i]=="plan2")
	{
		$plan_fin="X";
		
		}if($e_fin[$i]=="simulation")
	{
		$simu_empr="X";
		
		}
		if($e_fin[$i]=="validation")
	{
		$vali_faisab="X";
		
		}
}
		
//Condition champs $ej_montage_creation
$ej_montage=explode(",", $ej_montage_creation);
for ($i=0; $i<count($ej_montage); $i++)
{
		if($ej_montage[$i]=="etude")
	{
		$etu_juri="X";
		
		}
		if($ej_montage[$i]=="montage")
	{
		$monta="X";
		
		}
		if($ej_montage[$i]=="creation")
	{
		$crea="X";
		
		}
		if($ej_montage[$i]=="presentation1")
	{
		$form_jur_exis="X";
		
		}
		if($ej_montage[$i]=="aide")
	{
		$choi_jur_ad="X";
		
		}
		if($ej_montage[$i]=="verification")
	{
		$veri_contra="X";
		
		}
		if($ej_montage[$i]=="information")
	{
		$inpi="X";
		
		}
		if($ej_montage[$i]=="orientation")
	{
		$orient_crea="X";
		
		}
		if($ej_montage[$i]=="demande1")
	{
		$dde_exo="X";
		
		}
		if($ej_montage[$i]=="demande2")
	{
		$dde_loc="X";
		
		}
		if($ej_montage[$i]=="presentation2")
	{
		$demarch_ie="X";
		
		}
		if($ej_montage[$i]=="chronologie")
	{
		$chrono_dema="X";
			
		}
}

//*******************Conditions Planning prévisionnel****************************
//Condition champs $etapes_adequation
$etap_ad=explode(",", $etapes_adequation);
for ($i=0; $i<count($etap_ad); $i++)
{
	if($etap_ad[$i]=="adequation")
	{
		$adeq_proj2="X";
		
		}
		if($etap_ad[$i]=="rdv2")
	{
		$ad_rdv2="X";
		
		}
		if($etap_ad[$i]=="rdv3")
	{
		$ad_rdv3="X";
		
		}
		if($etap_ad[$i]=="rdv4")
	{
		$ad_rdv4="X";
		
		}
		if($etap_ad[$i]=="rdv5")
	{
		$ad_rdv5="X";
		
		}if($etap_ad[$i]=="rdv6")
	{
		$ad_rdv6="X";
		
		}if($etap_ad[$i]=="rdv7")
	{
		$ad_rdv7="X";
		
		}
		if($etap_ad[$i]=="rdv8")
	{
		$ad_rdv8="X";
		
		}
		if($etap_ad[$i]=="rdv9")
	{
		$ad_rdv9="X";
		
		}
		if($etap_ad[$i]=="rdv10")
	{
		$ad_rdv10="X";
		
		}
}

//Condition champs $etapes_etude_eco
$etap_ee=explode(",", $etapes_etude_eco);
for ($i=0; $i<count($etap_ee); $i++)
{
		if($etap_ee[$i]=="etude")
	{
		$etud_eco2="X";
		
		}
		if($etap_ee[$i]=="rdv2")
	{
		$eco_rdv2="X";
		
		}
		if($etap_ee[$i]=="rdv3")
	{
		$eco_rdv3="X";
		
		}
		if($etap_ee[$i]=="rdv4")
	{
		$eco_rdv4="X";
		
		}
		if($etap_ee[$i]=="rdv5")
	{
		$eco_rdv5="X";
		
		}
		if($etap_ee[$i]=="rdv6")
	{
		$eco_rdv6="X";
		
		}
		if($etap_ee[$i]=="rdv7")
	{
		$eco_rdv7="X";
		
		}
		if($etap_ee[$i]=="rdv8")
	{
		$eco_rdv8="X";
		
		}if($etap_ee[$i]=="rdv9")
	{
		$eco_rdv9="X";
		
		}
		if($etap_ee[$i]=="rdv10")
	{
		$eco_rdv10="X";
		
		}
}




//Condition champs $etapes_etude_financ
$etap_ef=explode(",", $etapes_etude_financ);
for ($i=0; $i<count($etap_ef); $i++)
{	
		if($etap_ef[$i]=="etude")
	{
		$etud_fin2="X";
		
		}
		if($etap_ef[$i]=="rdv2")
	{
		$fin_rdv2="X";
		
		}
		if($etap_ef[$i]=="rdv3")
	{
		$fin_rdv3="X";
		
		}
		if($etap_ef[$i]=="rdv4")
	{
		$fin_rdv4="X";
		
		}
		if($etap_ef[$i]=="rdv5")
	{
		$fin_rdv5="X";
		
		}
		if($etap_ef[$i]=="rdv6")
	{
		$fin_rdv6="X";
		
		}
		if($etap_ef[$i]=="rdv7")
	{
		$fin_rdv7="X";
		
		}
		if($etap_ef[$i]=="rdv8")
	{
		$fin_rdv8="X";
		
		}
		if($etap_ef[$i]=="rdv9")
	{
		$fin_rdv9="X";
		
		}
		if($etap_ef[$i]=="rdv10")
	{
		$fin_rdv10="X";
		
		}
}

//Condition champs $etapes_etude_jurid
$etap_ej=explode(",", $etapes_etude_jurid);
for ($i=0; $i<count($etap_ej); $i++)
{	
		if($etap_ej[$i]=="etude")
	{
		$etu_juri2="X";
		
		}
		if($etap_ej[$i]=="rdv2")
	{
		$jur_rdv2="X";
		
		}
		if($etap_ej[$i]=="rdv3")
	{
		$jur_rdv3="X";
		
		}
		if($etap_ej[$i]=="rdv4")
	{
		$jur_rdv4="X";
		
		}
		if($etap_ej[$i]=="rdv5")
	{
		$jur_rdv5="X";
		
		}
		if($etap_ej[$i]=="rdv6")
	{
		$jur_rdv6="X";
		
		}
		if($etap_ej[$i]=="rdv7")
	{
		$jur_rdv7="X";
		
		}
		if($etap_ej[$i]=="rdv8")
	{
		$jur_rdv8="X";
		
		}
		if($etap_ej[$i]=="rdv9")
	{
		$jur_rdv9="X";
		
		}
		if($etap_ej[$i]=="rdv10")
	{
		$jur_rdv10="X";
		
		}
}
//Condition champs $etapes_montage
$etap_m=explode(",", $etapes_montage);
for ($i=0; $i<count($etap_m); $i++)
{
		if($etap_m[$i]=="montage")
	{
		$montage="X";
		
		}
		if($etap_m[$i]=="rdv2")
	{
		$mont_rdv2="X";
		
		}
		if($etap_m[$i]=="rdv3")
	{
		$mont_rdv3="X";
		
		}
		if($etap_m[$i]=="rdv4")
	{
		$mont_rdv4="X";
		
		}
		if($etap_m[$i]=="rdv5")
	{
		$mont_rdv5="X";
		
		}
		if($etap_m[$i]=="rdv6")
	{
		$mont_rdv6="X";
		
		}
		if($etap_m[$i]=="rdv7")
	{
		$mont_rdv7="X";
		
		}
		if($etap_m[$i]=="rdv8")
	{
		$mont_rdv8="X";
		
		}
		if($etap_m[$i]=="rdv9")
	{
		$mont_rdv9="X";
		
		}
		if($etap_m[$i]=="rdv10")
	{
		$mont_rdv10="X";
		
		}
}
//Condition champs $etapes_creation
$etap_c=explode(",", $etapes_creation);
for ($i=0; $i<count($etap_c); $i++)
{
		if($etap_c[$i]=="creation")
	{
		$creation="X";
		
		}
		if($etap_c[$i]=="rdv2")
	{
		$crea_rdv2="X";
		
		}
		if($etap_c[$i]=="rdv3")
	{
		$crea_rdv3="X";
		
		}
		if($etap_c[$i]=="rdv4")
	{
		$crea_rdv4="X";
		
		}
		if($etap_c[$i]=="rdv5")
	{
		$crea_rdv5="X";
		
		}
		if($etap_c[$i]=="rdv6")
	{
		$crea_rdv6="X";
		
		}if($etap_c[$i]=="rdv7")
	{
		$crea_rdv7="X";
		
		}
		if($etap_c[$i]=="rdv8")
	{
		$crea_rdv8="X";
		
		}
		if($etap_c[$i]=="rdv9")
	{
		$crea_rdv9="X";
		
		}
		if($etap_c[$i]=="rdv10")
	{
		$crea_rdv10="X";
		
		}
}

//Remplace les marqueurs du modèle par nos données

//*****egw_contact*****
$output = str_replace('<<NOM_BEN>>',$nom_beneficiaire, $output);
$output = str_replace('<<PRENOM_BEN>>',$prenom_beneficiaire, $output);
$output = str_replace('<<ADR_BEN>>',$adresse_bene, $output);
$output = str_replace('<<CP_BEN>>',$cp_bene, $output);
$output = str_replace('<<VILLE_BEN>>',$ville_bene, $output);
$output = str_replace('<<TEL_BEN>>',$tel_bene, $output);
$output = str_replace('<<MAIL_BEN>>',$mel_bene, $output);

//*****organisme*****
$output = str_replace('<<NOM_ORGA>>','APSIE', $output);
$output = str_replace('<<PRENOM_ORGA>>',$nom_orga, $output);
$output = str_replace('<<AD_ORGA>>',$adr_orga, $output);
$output = str_replace('<<CP_ORGA>>',$cp_orga, $output);
$output = str_replace('<<VILLE_ORGA>>',$ville_orga, $output);
$output = str_replace('<<TEL_ORGA>>',$tel_orga, $output);
$output = str_replace('<<MAIL_ORGA>>',$mail_orga, $output);


//******************************nacre_preliminaire********************************************


$output = str_replace('<<DESC_PROJ>>',$desc_proj, $output);
$output = str_replace('<<AVAN_PROJ>>',$avan_projet, $output);
$output = str_replace('<<DEM_BEN>>',$demande_beneficiaire, $output);

//*****personnalité créateur*****
$output = str_replace('<<a>>',$dynamique, $output);
$output = str_replace('<<b>>',$autoritaire, $output);
$output = str_replace('<<c>>',$tetu, $output);
$output = str_replace('<<d>>',$enthousiaste, $output);
$output = str_replace('<<e>>',$entreprenant, $output);
$output = str_replace('<<f>>',$sensinitiative, $output);
$output = str_replace('<<g>>',$conformiste, $output);
$output = str_replace('<<h>>',$humeurchangeante, $output);
$output = str_replace('<<i>>',$emotifsensible, $output);
$output = str_replace('<<j>>',$volontaire, $output);
$output = str_replace('<<k>>',$desordonne, $output);
$output = str_replace('<<l>>',$realiste, $output);
$output = str_replace('<<m>>',$logique, $output);
$output = str_replace('<<n>>',$intuitif, $output);
$output = str_replace('<<o>>',$adaptable, $output);
$output = str_replace('<<p>>',$rigoureux, $output);
$output = str_replace('<<q>>',$autonome, $output);
$output = str_replace('<<r>>',$intransigeant, $output);
$output = str_replace('<<s>>',$espritdequipe, $output);
$output = str_replace('<<t>>',$disperse, $output);
$output = str_replace('<<u>>',$nesaitpasecouter, $output);
$output = str_replace('<<v>>',$constructif, $output);
$output = str_replace('<<w>>',$pointilleux, $output);
$output = str_replace('<<x>>',$inattentif, $output);
$output = str_replace('<<y>>',$largedesprit, $output);
$output = str_replace('<<z>>',$susceptible, $output);
$output = str_replace('<<aa>>',$negociateur, $output);
$output = str_replace('<<ab>>',$manuel, $output);
$output = str_replace('<<ac>>',$creatif, $output);
$output = str_replace('<<ad>>',$empathique, $output);
$output = str_replace('<<ae>>',$souspression, $output);
$output = str_replace('<<af>>',$etourdi, $output);
$output = str_replace('<<ag>>',$optimiste, $output);
$output = str_replace('<<ah>>',$pessimiste, $output);
$output = str_replace('<<ai>>',$maniaque, $output);
$output = str_replace('<<aj>>',$soupleouvert, $output);
$output = str_replace('<<ak>>',$organise, $output);
$output = str_replace('<<al>>',$raleur, $output);
$output = str_replace('<<am>>',$sociable, $output);
$output = str_replace('<<an>>',$timide, $output);
$output = str_replace('<<ao>>',$ferme, $output);
$output = str_replace('<<ap>>',$dilettante, $output);
$output = str_replace('<<aq>>',$tenace, $output);
$output = str_replace('<<ar>>',$curieux, $output);
$output = str_replace('<<as>>',$anxieux, $output);
$output = str_replace('<<at>>',$innovateur, $output);
$output = str_replace('<<AU>>',$consciencieux, $output);
$output = str_replace('<<av>>',$impatient, $output);
$output = str_replace('<<aw>>',$perseverant, $output);
$output = str_replace('<<ax>>',$imprevoyant, $output);
$output = str_replace('<<ay>>',$individualiste, $output);
$output = str_replace('<<az>>',$apprendrapidement, $output);
$output = str_replace('<<ba>>',$reflechi, $output);
$output = str_replace('<<BB>>',$rigide, $output);
$output = str_replace('<<BC>>',$diplomate, $output);
$output = str_replace('<<BD>>',$pedagogue, $output);
$output = str_replace('<<BE>>',$pragmatique, $output);
$output = str_replace('<<BF>>',$goutrisque, $output);
$output = str_replace('<<BG>>',$sensecoute, $output);
$output = str_replace('<<BH>>',$senshumour, $output);

//*****points forts / points faibles*****
$output = str_replace('<<PT_FORT1>>',$caracteri_pt_fort1, $output);
$output = str_replace('<<PT_FORT2>>',$caracteri_pt_fort2, $output);
$output = str_replace('<<PT_FORT3>>',$caracteri_pt_fort3, $output);
$output = str_replace('<<PT_FORT4>>',$caracteri_pt_fort4, $output);
$output = str_replace('<<PT_FORT5>>',$caracteri_pt_fort5, $output);
$output = str_replace('<<PT_FAIBLE1>>',$caracteri_pt_faible1, $output);
$output = str_replace('<<PT_FAIBLE2>>',$caracteri_pt_faible2, $output);
$output = str_replace('<<PT_FAIBLE3>>',$caracteri_pt_faible3, $output);
$output = str_replace('<<PT_FAIBLE4>>',$caracteri_pt_faible4, $output);
$output = str_replace('<<PT_FAIBLE5>>',$caracteri_pt_faible5, $output);

//*****points à améliorer*****
$output = str_replace('<<PT_AMEL1>>',$ameliorer_pt1, $output);
$output = str_replace('<<PT_AMEL2>>',$ameliorer_pt2, $output);
$output = str_replace('<<PT_AMEL3>>',$ameliorer_pt3, $output);
$output = str_replace('<<PT_AMEL4>>',$ameliorer_pt4, $output);
$output = str_replace('<<PT_AMEL5>>',$ameliorer_pt5, $output);

//*****motivation du créateur*****
$output = str_replace('<<DESIR_IND>>',$desir_ind, $output);
$output = str_replace('<<GOUT_RESP>>',$gout_resp, $output);
$output = str_replace('<<CONC_REVE>>',$conc_reve, $output);
$output = str_replace('<<CHANG_VIE>>',$chang_vie, $output);
$output = str_replace('<<EXPL_OPPORT>>',$expl_opport, $output);
$output = str_replace('<<ACC_STATU>>',$acc_statu, $output);
$output = str_replace('<<DISP_REVENU>>',$disp_revenu, $output);
$output = str_replace('<<AUGM_REV>>',$augm_rev, $output);
$output = str_replace('<<TRAV_CONJ>>',$trav_conj, $output);
$output = str_replace('<<PARTENARIA>>',$partenaria, $output);


//*****parcours de formation*****
for($i=0;$i<6;$i++)
{
	$output = str_replace('<<DIPL_ANNEE'.($i+1).'>>',$diplome_annee[$i], $output);
	$output = str_replace('<<DIPL_OBTEN'.($i+1).'>>',$diplome_obtenu[$i], $output);
}

/*$output = str_replace('<<FORM_ANNEE1>>',$formation_annee1, $output);
$output = str_replace('<<FORM_ANNEE2>>',$formation_annee2, $output);
$output = str_replace('<<FORM_ANNEE3>>',$formation_annee3, $output);
$output = str_replace('<<FORM_ANNEE4>>',$formation_annee4, $output);
$output = str_replace('<<FORM_ANNEE5>>',$formation_annee5, $output);
$output = str_replace('<<FORM_SUIVI1>>',$formation_suivie1, $output);
$output = str_replace('<<FORM_SUIVI2>>',$formation_suivie2, $output);
$output = str_replace('<<FORM_SUIVI3>>',$formation_suivie3, $output);
$output = str_replace('<<FORM_SUIVI4>>',$formation_suivie4, $output);
$output = str_replace('<<FORM_SUIVI5>>',$formation_suivie5, $output);*/


//*****expérience professionnelle*****

for($i=0;$i<6;$i++)
{
	$output = str_replace('<<FORM_ANNEE'.($i+1).'>>',$experience_annee[$i], $output);
	$output = str_replace('<<EXP_POSTE'.($i+1).'>>',$poste_occupe[$i], $output);
	$output = str_replace('<<WXZ'.($i+1).'>>',$entreprise[$i], $output);
}


//*****validation de l'adéquation*****
//4.3	Validation de l’adéquation

$output = str_replace('<<EXP_TFAIB>>',$exp_tfaib, $output);
$output = str_replace('<<EXP_FAIB>>',$exp_faib, $output);
$output = str_replace('<<EXP_FORT>>',$exp_fort, $output);
$output = str_replace('<<EXP_TFOR>>',$exp_tfor, $output);


$output = str_replace('<<FORM_TFAIB>>',$form_tfaib, $output);
$output = str_replace('<<FORM_FAIB>>',$form_faib, $output);
$output = str_replace('<<FORM_FORT>>',$form_fort, $output);
$output = str_replace('<<FORM_TFOR>>',$form_tfor, $output);
$output = str_replace('<<ACQUIS_TFAI>>',$acquis_tfai, $output);
$output = str_replace('<<ACQUIS_FAI>>',$acquis_fai, $output);
$output = str_replace('<<ACQUIS_FOR>>',$acquis_for, $output);
$output = str_replace('<<ACQUIS_TFOR>>',$acquis_tfor, $output);


//*****Compréhension des contraintes du statut de créateur****
$output = str_replace('<<CT_FAM>>',$cont_fam, $output);
$output = str_replace('<<CT_SANT>>',$cont_sant, $output);
$output = str_replace('<<CONT_TPS>>',$cont_tps, $output);
$output = str_replace('<<CONT_FIN>>',$cont_fin, $output);
$output = str_replace('<<CONT_PROD>>',$cont_prod, $output);
$output = str_replace('<<CONT_MARCH>>',$cont_march, $output);
$output = str_replace('<<CONT_MOY>>',$cont_moy, $output);
$output = str_replace('<<CONT_LEG>>',$cont_leg, $output);

//*****1ère evaluation du projet****
//champs $projet_defini
$output = str_replace('<<PROJ_CLAIR1>>',$proj_clair1, $output);
$output = str_replace('<<PROJ_CLAIR2>>',$proj_clair2, $output);
$output = str_replace('<<PROJ_CLAIR3>>',$proj_clair3, $output);
$output = str_replace('<<PROJ_CLAIRCOM>>',$projet_defini_com, $output);
//champs $produit_defini
$output = str_replace('<<PROD_DEF1>>',$prod_def1, $output);
$output = str_replace('<<PROD_DEF2>>',$prod_def2, $output);
$output = str_replace('<<PROD_DEF3>>',$prod_def3, $output);
$output = str_replace('<<PROD_DEFCOM>>',$produit_defini_com, $output);
//champs $produit_listes
$output = str_replace('<<PROD_LIST1>>',$prod_list1, $output);
$output = str_replace('<<PROD_LIST2>>',$prod_list2, $output);
$output = str_replace('<<PROD_LIST3>>',$prod_list3, $output);
$output = str_replace('<<PROD_LISTCOM>>',$produit_listes_com, $output);
//champs $marche_determine
$output = str_replace('<<MARCH_DET1>>',$march_det1, $output);
$output = str_replace('<<MARCH_DET2>>',$march_det2, $output);
$output = str_replace('<<MARCH_DET3>>',$march_det3, $output);
$output = str_replace('<<MARCH_DETCOM>>',$marche_determine_com, $output);
//champs $clientele_ciblee
$output = str_replace('<<CLIEN_CIB1>>',$clien_cib1, $output);
$output = str_replace('<<CLIEN_CIB2>>',$clien_cib2, $output);
$output = str_replace('<<CLIEN_CIB3>>',$clien_cib3, $output);
$output = str_replace('<<CLIEN_CIBCOM>>',$clientele_ciblee_com, $output);
//champs $fournisseurs_identifies
$output = str_replace('<<FRS_ID1>>',$frs_id1, $output);
$output = str_replace('<<FRS_ID2>>',$frs_id2, $output);
$output = str_replace('<<FRS_ID3>>',$frs_id3, $output);
$output = str_replace('<<FRS_IDCOM>>',$fournisseurs_identifies_com, $output);
//champs $concurrence_identifiee
$output = str_replace('<<CONC_ID1>>',$conc_id1, $output);
$output = str_replace('<<CONC_ID2>>',$conc_id2, $output);
$output = str_replace('<<CONC_ID3>>',$conc_id3, $output);
$output = str_replace('<<CONC_IDCOM>>',$concurrence_identifiee_com, $output);
//champs $strategie_commerciale
$output = str_replace('<<STRAT_DEF1>>',$strat_def1, $output);
$output = str_replace('<<STRAT_DEF2>>',$strat_def2, $output);
$output = str_replace('<<STRAT_DEF3>>',$strat_def3, $output);
$output = str_replace('<<STRAT_DEFCOM>>',$strategie_commerciale_com, $output);
//champs $stock_initial
$output = str_replace('<<STOC_DEF1>>',$stoc_def1, $output);
$output = str_replace('<<STOC_DEF2>>',$stoc_def2, $output);
$output = str_replace('<<STOC_DEF3>>',$stoc_def3, $output);
$output = str_replace('<<STOC_DEFCOM>>',$stock_initial_com, $output);
//champs $prix_revient
$output = str_replace('<<PX_REV1>>',$px_rev1, $output);
$output = str_replace('<<PX_REV2>>',$px_rev2, $output);
$output = str_replace('<<PX_REV3>>',$px_rev3, $output);
$output = str_replace('<<PX_REVCOM>>',$prix_revient_com, $output);
//champs $px_vente_fix
$output = str_replace('<<PX_FIX1>>',$px_fix1, $output);
$output = str_replace('<<PX_FIX2>>',$px_fix2, $output);
$output = str_replace('<<PX_FIX3>>',$px_fix3, $output);
$output = str_replace('<<PX_FIXCOM>>',$px_vente_fix_com, $output);
//champs $quantites_vendues
$output = str_replace('<<QUAN_EST1>>',$quan_est1, $output);
$output = str_replace('<<QUAN_EST2>>',$quan_est2, $output);
$output = str_replace('<<QUAN_EST3>>',$quan_est3, $output);
$output = str_replace('<<QUAN_ESTCOM>>',$quantites_vendues_com, $output);
//champs $ca_calcule
$output = str_replace('<<CA_CALC1>>',$ca_calc1, $output);
$output = str_replace('<<CA_CALC2>>',$ca_calc2, $output);
$output = str_replace('<<CA_CALC3>>',$ca_calc3, $output);
$output = str_replace('<<CA_CALCCOM>>',$ca_calcule_com, $output);
//champs $charges_activite
$output = str_replace('<<CHAR_CHIF1>>',$char_chif1, $output);
$output = str_replace('<<CHAR_CHIF2>>',$char_chif2, $output);
$output = str_replace('<<CHAR_CHIF3>>',$char_chif3, $output);
$output = str_replace('<<CHAR_CHIFCOM>>',$charges_activite_com, $output);
//champs $cpte_exploitation
$output = str_replace('<<CPT_FIN1>>',$cpt_fin1, $output);
$output = str_replace('<<CPT_FIN2>>',$cpt_fin2, $output);
$output = str_replace('<<CPT_FIN3>>',$cpt_fin3, $output);
$output = str_replace('<<CPT_FINCOM>>',$cpte_exploitation_com, $output);
//champs $plan_tresorerie
$output = str_replace('<<PL_FIN1>>',$pl_fin1, $output);
$output = str_replace('<<PL_FIN2>>',$pl_fin2, $output);
$output = str_replace('<<PL_FIN3>>',$pl_fin3, $output);
$output = str_replace('<<PL_FINCOM>>',$plan_tresorerie_com, $output);
//champs $point_mort_calcule
$output = str_replace('<<PT_MCAL1>>',$pt_mcal1, $output);
$output = str_replace('<<PT_MCAL2>>',$pt_mcal2, $output);
$output = str_replace('<<PT_MCAL3>>',$pt_mcal3, $output);
$output = str_replace('<<PT_MCALCOM>>',$point_mort_calcule_com, $output);
//champs $seuil_rentabilite
$output = str_replace('<<SEUIL_CON1>>',$seuil_con1, $output);
$output = str_replace('<<SEUIL_CON2>>',$seuil_con2, $output);
$output = str_replace('<<SEUIL_CON3>>',$seuil_con3, $output);
$output = str_replace('<<SEUIL_CONCOM>>',$seuil_rentabilite_com, $output);
//champs $investissement_defini
$output = str_replace('<<INV_DEF1>>',$inv_def1, $output);
$output = str_replace('<<INV_DEF2>>',$inv_def2, $output);
$output = str_replace('<<INV_DEF3>>',$inv_def3, $output);
$output = str_replace('<<INV_DEFCOM>>',$investissement_defini_com, $output);
//champs $cout_chiffre
$output = str_replace('<<COUT_CHI1>>', $cout_chi1, $output);
$output = str_replace('<<COUT_CHI2>>', $cout_chi2, $output);
$output = str_replace('<<COUT_CHI3>>', $cout_chi3, $output);
$output = str_replace('<<COUT_CHICOM>>', $cout_chiffrecom, $output);
//champs $montant_apport
$output = str_replace('<<MTT_APP1>>', $mtt_app1, $output);
$output = str_replace('<<MTT_APP2>>', $mtt_app2, $output);
$output = str_replace('<<MTT_APP3>>', $mtt_app3, $output);
$output = str_replace('<<MTT_APPCOM>>',$montant_apport_com, $output);
//champs $projet_financements
$output = str_replace('<<PROJ_FIN1>>',$proj_fin1, $output);
$output = str_replace('<<PROJ_FIN2>>',$proj_fin2, $output);
$output = str_replace('<<PROJ_FIN3>>',$proj_fin3, $output);
$output = str_replace('<<PROJ_FINCOM>>',$projet_financements_com, $output);
//champs $montant_besoin
$output = str_replace('<<MTT_FIN1>>',$mtt_fin1, $output);
$output = str_replace('<<MTT_FIN2>>',$mtt_fin2, $output);
$output = str_replace('<<MTT_FIN3>>',$mtt_fin3, $output);
$output = str_replace('<<MTT_FINCOM>>',$montant_besoin_com, $output);
//champs $lieu_implantation
$output = str_replace('<<LIEU_CHOI1>>',$lieu_choi1, $output);
$output = str_replace('<<LIEU_CHOI2>>',$lieu_choi2, $output);
$output = str_replace('<<LIEU_CHOI3>>',$lieu_choi3, $output);
$output = str_replace('<<LIEU_CHOICOM>>',$lieu_implantation_com, $output);
//champs $local_necessaire
$output = str_replace('<<LOC_NEC1>>',$loc_nec1, $output);
$output = str_replace('<<LOC_NEC2>>',$loc_nec2, $output);
$output = str_replace('<<LOC_NEC3>>',$loc_nec3, $output);
$output = str_replace('<<LOC_NECCOM>>',$local_necessaire_com, $output);
//champs $local_trouve
$output = str_replace('<<LOC_TROU1>>',$loc_trou1, $output);
$output = str_replace('<<LOC_TROU2>>',$loc_trou2, $output);
$output = str_replace('<<LOC_TROU3>>',$loc_trou3, $output);
$output = str_replace('<<LOC_TROUCOM>>',$local_trouve_com, $output);
//champs $nb_emplois_crees
$output = str_replace('<<NB_CREE1>>',$nb_cree1, $output);
$output = str_replace('<<NB_CREE2>>',$nb_cree2, $output);
$output = str_replace('<<NB_CREE3>>',$nb_cree3, $output);
$output = str_replace('<<NB_CREECOM>>',$nb_emplois_crees_com, $output);
//champs $nb_emplois_salaries
$output = str_replace('<<NB_SAL1>>',$nb_sal1, $output);
$output = str_replace('<<NB_SAL2>>',$nb_sal2, $output);
$output = str_replace('<<NB_SAL3>>',$nb_sal3, $output);
$output = str_replace('<<NB_SALCOM>>',$nb_emplois_salaries_com, $output);
//champs $statut_createur
$output = str_replace('<<STAT_CDEF1>>',$stat_cdef1, $output);
$output = str_replace('<<STAT_CDEF2>>',$stat_cdef2, $output);
$output = str_replace('<<STAT_CDEF3>>',$stat_cdef3, $output);
$output = str_replace('<<STAT_CDEFCOM>>',$statut_createur_com, $output);
//champs $statut_juridique
$output = str_replace('<<STAT_JDEF1>>',$stat_jdef1, $output);
$output = str_replace('<<STAT_JDEF2>>',$stat_jdef2, $output);
$output = str_replace('<<STAT_JDEF3>>',$stat_jdef3, $output);
$output = str_replace('<<STAT_JDEFCOM>>',$statut_juridique_com, $output);
//champs $demarches_entamees
$output = str_replace('<<DEM_ENT1>>',$dem_ent1, $output);
$output = str_replace('<<DEM_ENT2>>',$dem_ent2, $output);
$output = str_replace('<<DEM_ENT3>>',$dem_ent3, $output);
$output = str_replace('<<DEM_ENTCOM>>',$demarches_entamees_com, $output);
//champs $regime_fiscal
$output = str_replace('<<REGI_CHOI1>>',$regi_choi1, $output);
$output = str_replace('<<REGI_CHOI2>>',$regi_choi2, $output);
$output = str_replace('<<REGI_CHOI3>>',$regi_choi3, $output);
$output = str_replace('<<REGI_CHOICOM>>',$regime_fiscal_com, $output);
//champs $projet_redige
$output = str_replace('<<PROJ_RED1>>',$proj_red1, $output);
$output = str_replace('<<PROJ_RED2>>',$proj_red2, $output);
$output = str_replace('<<PROJ_RED3>>',$proj_red3, $output);
$output = str_replace('<<PROJ_REDCOM>>',$projet_redige_com, $output);

//****Plan d'accompagnement*****

//Adéquation parcours projet
//champs $adequation_validation
$output = str_replace('<<ADEQ_PROJ>>',$adeq_proj, $output);
$output = str_replace('<<ANALYSE_ANT>>',$analyse_ant, $output);
$output = str_replace('<<IDENT_COM>>',$ident_com, $output);
$output = str_replace('<<IDENT_TECH>>',$ident_tech, $output);
$output = str_replace('<<IDENT_GEST>>',$ident_gest, $output);
$output = str_replace('<<VALI_PROJ>>',$vali_proj, $output);

//Etude économique
//champs $etude_economique
$output = str_replace('<<ETUD_ECO>>',$etud_eco, $output);
$output = str_replace('<<DEF_SCES>>',$def_sces, $output);
$output = str_replace('<<ETUD_MAR>>',$etud_mar, $output);
$output = str_replace('<<DEF_CLI>>',$def_cli, $output);
$output = str_replace('<<ETUD_CONC>>',$etud_conc, $output);
$output = str_replace('<<ETUD_FRS>>',$etud_frs, $output);
$output = str_replace('<<ELAB_MIX>>',$elab_mix, $output);
$output = str_replace('<<MOY_MHFIN>>',$moy_mhfin, $output);
$output = str_replace('<<VALI_VIAB>>',$vali_viab, $output);

//Etude financière
//champs $etude_financiere
$output = str_replace('<<ETUD_FIN>>',$etud_fin, $output);
$output = str_replace('<<CAL_PXVENTE>>',$cal_pxvente, $output);
$output = str_replace('<<CAL_CA>>',$cal_ca, $output);
$output = str_replace('<<DEF_CHARG>>',$def_charg, $output);
$output = str_replace('<<CAL_RENT>>',$cal_rent, $output);
$output = str_replace('<<CAL_ROUL>>',$cal_roul, $output);
$output = str_replace('<<PLAN_MENS>>',$plan_mens, $output);
$output = str_replace('<<LI_NECE>>',$li_nece, $output);
$output = str_replace('<<ELAB_IMMO>>',$elab_immo, $output);
$output = str_replace('<<PLAN_FIN>>',$plan_fin, $output);
$output = str_replace('<<SIMU_EMPR>>',$simu_empr, $output);
$output = str_replace('<<VALI_FAISAB>>',$vali_faisab, $output);

//Etude juridique
//champs $ej_montage_creation
$output = str_replace('<<ETU_JURI>>',$etu_juri, $output);
$output = str_replace('<<MONTA>>',$monta, $output);
$output = str_replace('<<CREA>>',$crea, $output);
$output = str_replace('<<FORM_JUR_EXIS>>',$form_jur_exis, $output);
$output = str_replace('<<CHOI_JUR_AD>>',$choi_jur_ad, $output);
$output = str_replace('<<VERI_CONTRA>>',$veri_contra, $output);
$output = str_replace('<<INPI>>',$inpi, $output);
$output = str_replace('<<ORIENT_CREA>>',$orient_crea, $output);
$output = str_replace('<<DDE_EXO>>',$dde_exo, $output);
$output = str_replace('<<DDE_LOC>>',$dde_loc, $output);
$output = str_replace('<<DEMARCH_IE>>',$demarch_ie, $output);
$output = str_replace('<<CHRONO_DEMA>>',$chrono_dema, $output);


//*****Planning prévisionnel******
//Adéquation parcours projet
//champs $etapes_adequation
$output = str_replace('<<ADEQ_PROJ2>>',$adeq_proj2, $output);
$output = str_replace('<<AD_RDV2>>',$ad_rdv2, $output);
$output = str_replace('<<AD_RDV3>>',$ad_rdv3, $output);
$output = str_replace('<<AD_RDV4>>',$ad_rdv4, $output);
$output = str_replace('<<AD_RDV5>>',$ad_rdv5, $output);
$output = str_replace('<<AD_RDV6>>',$ad_rdv6, $output);
$output = str_replace('<<AD_RDV7>>',$ad_rdv7, $output);
$output = str_replace('<<AD_RDV8>>',$ad_rdv8, $output);
$output = str_replace('<<AD_RDV9>>',$ad_rdv9, $output);
$output = str_replace('<<AD_RDV10>>',$ad_rdv10, $output);

//Etude économique
//champs $etapes_etude_eco
$output = str_replace('<<ETUD_ECO2>>',$etud_eco2, $output);
$output = str_replace('<<ECO_RDV2>>',$eco_rdv2, $output);
$output = str_replace('<<ECO_RDV3>>',$eco_rdv3, $output);
$output = str_replace('<<ECO_RDV4>>',$eco_rdv4, $output);
$output = str_replace('<<ECO_RDV5>>',$eco_rdv5, $output);
$output = str_replace('<<ECO_RDV6>>',$eco_rdv6, $output);
$output = str_replace('<<ECO_RDV7>>',$eco_rdv7, $output);
$output = str_replace('<<ECO_RDV8>>',$eco_rdv8, $output);
$output = str_replace('<<ECO_RDV9>>',$eco_rdv9, $output);
$output = str_replace('<<ECO_RDV10>>',$eco_rdv10, $output);

//Etude financière
//champs $etapes_etude_financ
$output = str_replace('<<ETUD_FIN2>>',$etud_fin2, $output);
$output = str_replace('<<FIN_RDV2>>',$fin_rdv2, $output);
$output = str_replace('<<FIN_RDV3>>',$fin_rdv3, $output);
$output = str_replace('<<FIN_RDV4>>',$fin_rdv4, $output);
$output = str_replace('<<FIN_RDV5>>',$fin_rdv5, $output);
$output = str_replace('<<FIN_RDV6>>',$fin_rdv6, $output);
$output = str_replace('<<FIN_RDV7>>',$fin_rdv7, $output);
$output = str_replace('<<FIN_RDV8>>',$fin_rdv8, $output);
$output = str_replace('<<FIN_RDV9>>',$fin_rdv9, $output);
$output = str_replace('<<FIN_RDV10>>',$fin_rdv10, $output);

//Etude juridique
//champs $etapes_etude_jurid
$output = str_replace('<<ETU_JURI2>>',$etu_juri2, $output);
$output = str_replace('<<JUR_RDV2>>',$jur_rdv2, $output);
$output = str_replace('<<JUR_RDV3>>',$jur_rdv3, $output);
$output = str_replace('<<JUR_RDV4>>',$jur_rdv4, $output);
$output = str_replace('<<JUR_RDV5>>',$jur_rdv5, $output);
$output = str_replace('<<JUR_RDV6>>',$jur_rdv6, $output);
$output = str_replace('<<JUR_RDV7>>',$jur_rdv7, $output);
$output = str_replace('<<JUR_RDV8>>',$jur_rdv8, $output);
$output = str_replace('<<JUR_RDV9>>',$jur_rdv9, $output);
$output = str_replace('<<JUR_RDV10>>',$jur_rdv10, $output);

//Montage
//champs $etapes_montage
$output = str_replace('<<MONTAGE>>',$montage, $output);
$output = str_replace('<<MONT_RDV2>>',$mont_rdv2, $output);
$output = str_replace('<<MONT_RDV3>>',$mont_rdv3, $output);
$output = str_replace('<<MONT_RDV4>>',$mont_rdv4, $output);
$output = str_replace('<<MONT_RDV5>>',$mont_rdv5, $output);
$output = str_replace('<<MONT_RDV6>>',$mont_rdv6, $output);
$output = str_replace('<<MONT_RDV7>>',$mont_rdv7, $output);
$output = str_replace('<<MONT_RDV8>>',$mont_rdv8, $output);
$output = str_replace('<<MONT_RDV9>>',$mont_rdv9, $output);
$output = str_replace('<<MONT_RDV10>>',$mont_rdv10, $output);

//Création
//champs $etapes_creation
$output = str_replace('<<CREATION>>',$creation, $output);
$output = str_replace('<<CREA_RDV2>>',$crea_rdv2, $output);
$output = str_replace('<<CREA_RDV3>>',$crea_rdv3, $output);
$output = str_replace('<<CREA_RDV4>>',$crea_rdv4, $output);
$output = str_replace('<<CREA_RDV5>>',$crea_rdv5, $output);
$output = str_replace('<<CREA_RDV6>>',$crea_rdv6, $output);
$output = str_replace('<<CREA_RDV7>>',$crea_rdv7, $output);
$output = str_replace('<<CREA_RDV8>>',$crea_rdv8, $output);
$output = str_replace('<<CREA_RDV9>>',$crea_rdv9, $output);
$output = str_replace('<<CREA_RDV10>>',$crea_rdv10, $output);

$output = str_replace('<<COMMENT_PLAN>>',$commentaires, $output);
$output = str_replace('<<DATE>>',$date, $output);


//Envoie le document produit au navigateur
echo $output;
}

function imprimer_totalite($id_beneficiaire, $id_presta)

	{	
		$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['nom'];
			$prenom_beneficiaire=$row['prenom'];
			$adresse_bene=$row['adresse_ligne_1'];
			$cp_bene=$row['cp'];
			$ville_bene=$row['ville'];
			$tel_bene=$row['portable_perso'];
			$mel_bene=$row['email_pro'];
			
			
			
		}
		
		$requete='SELECT * FROM  egw_projet  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$description=$row['description_projet'];
			$statut=$row['statut'];
			
			
			
		}
		
		
		
	$requete2='SELECT * FROM  egw_nacre_preliminaire where id_presta='.$id_presta.'';
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		while($row = mysql_fetch_array($resultat2))
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
			$concurrence_identifiee=$row['concurrence_identifiee']; 
			$concurrence_identifiee_com=$row['concurrence_identifiee_com'];
			$strategie_commerciale=$row['strategie_commerciale'];
			$strategie_commerciale_com=$row['strategie_commerciale_com'];
			$stock_initial=$row['stock_initial'];
			$stock_initial_com=$row['stock_initial_com'];
			$prix_revient=$row['prix_revient'];
			$prix_revient_com=$row['prix_revient_com'];
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
			$adequation_parcours=$row['adequation_parcours'];
			$validation_parcours=$row['validation_parcours'];
			$etude_economique=$row['etude_economique'];
			$validation_viabilite=$row['validation_viabilite'];
			$etude_financiere=$row['etude_financiere'];
			$validation_faisabilite=$row['validation_faisabilite'];
			$ej_montage_creation=$row['ej_montage_creation'];
			$ej_montage_creation2=$row['ej_montage_creation2'];
			$etapes_adequation=$row['etapes_adequation'];
			$etapes_etude_eco=$row['etapes_etude_eco'];
			$etapes_etude_financ=$row['etapes_etude_financ'];
			$etapes_etude_jurid=$row['etapes_etude_jurid'];
			$etapes_montage=$row['etapes_montage'];
			$etapes_creation=$row['etapes_creation'];
			$commentaires=$row['commentaires'];
			$date=$row['date'];
			
		}
		
		$requete3='SELECT * FROM  egw_contact_formation where id_ben='.$id_beneficiaire.' order by id_formation asc';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$diplome_annee[]=$row['date_debut'].' - '.$row['date_fin'];
			
			$diplome_obtenu[]=$row['intitule_formation'];
			
			
		}
		
		$requete4='SELECT * FROM  egw_contact_parcours_pro where id_ben='.$id_beneficiaire.' and statut="Salarie" order by id_parcours asc';
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			
			/*$formation_annee1=$row['formation_annee1'];
			$formation_annee2=$row['formation_annee2'];
			$formation_annee3=$row['formation_annee3'];
			$formation_annee4=$row['formation_annee4'];
			$formation_annee5=$row['formation_annee5'];
			$formation_suivie1=$row['formation_suivie1'];
			$formation_suivie2=$row['formation_suivie2'];
			$formation_suivie3=$row['formation_suivie3'];
			$formation_suivie4=$row['formation_suivie4'];
			$formation_suivie5=$row['formation_suivie5'];*/
			
			if($row['date_debut']==0 and $row['date_fin']==0)
			{
				$experience_annee[]=NULL;
			}
				elseif($row['date_debut']==0 and $row['date_fin']!=0)
			{
				$experience_annee[]=date('d/m/Y',$row['date_fin']);
			}
				elseif($row['date_debut']!=0 and $row['date_fin']==0)
			{
				$experience_annee[]=date('d/m/Y',$row['date_debut']);
			}
			
				elseif($row['date_debut']!=0 and $row['date_fin']!=0)
			{
				$experience_annee[]=date('d/m/Y',$row['date_debut']).' - '.date('d/m/Y',$row['date_fin']);
			}
			$poste_occupe[]=$row['poste'];
			$entreprise[]=$row['organisme'];
		
		
		}
			
		
		$this->imprimer($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene, $demande_beneficiaire, $personnalite_createur, $caracteri_pt_fort1, $caracteri_pt_fort2, $caracteri_pt_fort3, $caracteri_pt_fort4, $caracteri_pt_fort5, $caracteri_pt_faible1, $caracteri_pt_faible2, $caracteri_pt_faible3, $caracteri_pt_faible4, $caracteri_pt_faible5, $ameliorer_pt1, $ameliorer_pt2, $ameliorer_pt3, $ameliorer_pt4, $ameliorer_pt5, $motivation_createur, $diplome_annee, $diplome_obtenu, $formation_annee1, $formation_annee2, $formation_annee3, $formation_annee4, $formation_annee5, $formation_suivie1, $formation_suivie2, $formation_suivie3, $formation_suivie4, $formation_suivie5, $experience_annee, $poste_occupe, $entreprise, $exp_pro_secteur, $formation, $acquis_extraprof, $contraintes_perso, $contraintes_projet, $projet_defini, $projet_defini_com, $produit_defini, $produit_defini_com, $produit_listes, $produit_listes_com, $marche_determine, $marche_determine_com, $clientele_ciblee, $clientele_ciblee_com, $fournisseurs_identifies, $fournisseurs_identifies_com, $concurrence_identifiee, $concurrence_identifiee_com, $strategie_commerciale, $strategie_commerciale_com, $stock_initial, $stock_initial_com, $prix_revient, $prix_revient_com, $quantites_vendues, $quantites_vendues_com, $ca_calcule, $ca_calcule_com, $charges_activite, $charges_activite_com, $cpte_exploitation, $cpte_exploitation_com, $plan_tresorerie, $plan_tresorerie_com, $point_mort_calcule, $point_mort_calcule_com, $seuil_rentabilite, $seuil_rentabilite_com, $investissement_defini, $investissement_defini_com, $montant_apport, $montant_apport_com, $projet_financements, $projet_financements_com, $montant_besoin, $montant_besoin_com, $lieu_implantation, $lieu_implantation_com, $local_necessaire, $local_necessaire_com, $local_trouve, $local_trouve_com, $nb_emplois_crees, $nb_emplois_crees_com, $nb_emplois_salaries, $nb_emplois_salaries_com, $statut_createur, $statut_createur_com, $statut_juridique, $statut_juridique_com, $demarches_entamees, $demarches_entamees_com, $regime_fiscal, $regime_fiscal_com, $projet_redige, $projet_redige_com, $adequation_parcours, $validation_parcours, $etude_economique, $validation_viabilite, $etude_financiere, $validation_faisabilite, $ej_montage_creation, $ej_montage_creation2, $etapes_adequation, $etapes_etude_eco, $etapes_etude_financ, $etapes_etude_jurid, $etapes_montage, $etapes_creation, $commentaires, $date , $statut , $description );	
	}
//select sur la table where id_beneficiare=$idbeneficiaire
//recupere les variables 
//recupere le nom du beneficiare dans la table egw_addressbook $nom_beneficiaire=rows['nom_beneficiaire'];
//appel de la fonction imprimer
//$this->imprimer('$nom_benefiaire'..'..'$delai');

	
function _destruct()
	{
	mysql_close();
	}


}
?>