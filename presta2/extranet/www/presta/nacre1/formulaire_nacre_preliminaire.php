<?php include("inc/class.zend_nacre.inc.php");
$nacre1= new zend_nacre();

$variable=$nacre1->return_variable($_GET['id_presta']);
$ex_pers=explode(',',$variable[0]);
$motiv=explode(',',$variable[16]);
$etap_ad=explode(',',$variable[88]);
$etap_ee=explode(',',$variable[89]);
$etap_ef=explode(',',$variable[90]);
$etap_ej=explode(',',$variable[91]);
$etap_m=explode(',',$variable[92]);
$etap_c=explode(',',$variable[93]);
$ad_va=explode(',',$variable[95]);
$e_economique=explode(',',$variable[96]);
$e_fin=explode(',',$variable[97]);
$ej_montage=explode(',',$variable[98]);

	
	if($ad_va[0]=="adequation")
	{
		$adeq_proj="checked='checked'";
		
		}
		if($ad_va[1]=="analyse")
	{
		$analyse_ant="checked='checked'";
		
		}
		if($ad_va[2]=="indentification1")
	{
		$ident_com="checked='checked'";
		
		}
		if($ad_va[3]=="identification2")
	{
		$ident_tech="checked='checked'";
		
		}
		if($ad_va[4]=="identification3")
	{
		$ident_gest="checked='checked'";
		
		}
		if($ad_va[5]=="validation")
	{
		$vali_proj="checked='checked'";
		
		}


	if($e_economique[0]=="etude1")
	{
		$etud_eco="checked='checked'";
		
		}
		if($e_economique[1]=="definition1")
	{
		$def_sces="checked='checked'";
		
		}
		if($e_economique[2]=="etude2")
	{
		$etud_mar="checked='checked'";
		
		}
		if($e_economique[3]=="definition2")
	{
		$def_cli="checked='checked'";
		
		}
		if($e_economique[4]=="etude3")
	{
		$etud_conc="checked='checked'";
		
		}
		if($e_economique[5]=="etude4")
	{
		$etud_frs="checked='checked'";
		
		}
		if($e_economique[6]=="elaboration")
	{
		$elab_mix="checked='checked'";
		
		}
		if($e_economique[7]=="moyen")
	{
		$moy_mhfin="checked='checked'";
		
		}
		if($e_economique[8]=="validation")
	{
		$vali_viab="checked='checked'";
		
		}



		if($e_fin[0]=="etude")
	{
		$etud_fin="checked='checked'";
		
		}
		if($e_fin[1]=="calcul1")
	{
		$cal_pxvente="checked='checked'";
		
		}		
		if($e_fin[2]=="calcul2")
	{
		$cal_ca="checked='checked'";
		
		}
		if($e_fin[3]=="definition")
	{
		$def_charg="checked='checked'";
		
		}
		if($e_fin[4]=="calcul3")
	{
		$cal_rent="checked='checked'";
		
		}
		if($e_fin[5]=="calcul4")
	{
		$cal_roul="checked='checked'";
		
		}
		if($e_fin[6]=="plan1")
	{
		$plan_mens="checked='checked'";
		
		}
		if($e_fin[7]=="liste")
	{
		$li_nece="checked='checked'";
		
		}
		if($e_fin[8]=="elaboration")
	{
		$elab_immo="checked='checked'";
		
		}if($e_fin[9]=="plan2")
	{
		$plan_fin="checked='checked'";
		
		}if($e_fin[10]=="simulation")
	{
		$simu_empr="checked='checked'";
		
		}
		if($e_fin[11]=="validation")
	{
		$vali_faisab="checked='checked'";
		
		}
		

		if($ej_montage[0]=="etude")
	{
		$etu_juri="checked='checked'";
		
		}
		if($ej_montage[1]=="montage")
	{
		$monta="checked='checked'";
		
		}
		if($ej_montage[2]=="creation")
	{
		$crea="checked='checked'";
		
		}
		if($ej_montage[3]=="presentation1")
	{
		$form_jur_exis="checked='checked'";
		
		}
		if($ej_montage[4]=="aide")
	{
		$choi_jur_ad="checked='checked'";
		
		}
		if($ej_montage[5]=="verification")
	{
		$veri_contra="checked='checked'";
		
		}
		if($ej_montage[6]=="information")
	{
		$inpi="checked='checked'";
		
		}
		if($ej_montage[7]=="orientation")
	{
		$orient_crea="checked='checked'";
		
		}
		if($ej_montage[8]=="demande1")
	{
		$dde_exo="checked='checked'";
		
		}
		if($ej_montage[9]=="demande2")
	{
		$dde_loc="checked='checked'";
		
		}
		if($ej_montage[10]=="presentation2")
	{
		$demarch_ie="checked='checked'";
		
		}
		if($ej_montage[11]=="chronologie")
	{
		$chrono_dema="checked='checked'";
			
		}

	
	if($etap_ad[0]=="adequation")
	{
		$adeq_proj2="checked='checked'";
		
		}
		if($etap_ad[1]=="rdv2")
	{
		$ad_rdv2="checked='checked'";
		
		}
		if($etap_ad[2]=="rdv3")
	{
		$ad_rdv3="checked='checked'";
		
		}
		if($etap_ad[3]=="rdv4")
	{
		$ad_rdv4="checked='checked'";
		
		}
		if($etap_ad[4]=="rdv5")
	{
		$ad_rdv5="checked='checked'";
		
		}if($etap_ad[5]=="rdv6")
	{
		$ad_rdv6="checked='checked'";
		
		}if($etap_ad[6]=="rdv7")
	{
		$ad_rdv7="checked='checked'";
		
		}
		if($etap_ad[7]=="rdv8")
	{
		$ad_rdv8="checked='checked'";
		
		}
		if($etap_ad[8]=="rdv9")
	{
		$ad_rdv9="checked='checked'";
		
		}
		if($etap_ad[9]=="rdv10")
	{
		$ad_rdv10="checked='checked'";
		
		}





		if($etap_ee[0]=="etude")
	{
		$etud_eco2="checked='checked'";
		
		}
		if($etap_ee[1]=="rdv2")
	{
		$eco_rdv2="checked='checked'";
		
		}
		if($etap_ee[2]=="rdv3")
	{
		$eco_rdv3="checked='checked'";
		
		}
		if($etap_ee[3]=="rdv4")
	{
		$eco_rdv4="checked='checked'";
		
		}
		if($etap_ee[4]=="rdv5")
	{
		$eco_rdv5="checked='checked'";
		
		}
		if($etap_ee[5]=="rdv6")
	{
		$eco_rdv6="checked='checked'";
		
		}
		if($etap_ee[6]=="rdv7")
	{
		$eco_rdv7="checked='checked'";
		
		}
		if($etap_ee[7]=="rdv8")
	{
		$eco_rdv8="checked='checked'";
		
		}if($etap_ee[8]=="rdv9")
	{
		$eco_rdv9="checked='checked'";
		
		}
		if($etap_ee[9]=="rdv10")
	{
		$eco_rdv10="checked='checked'";
		
		}




		if($etap_ef[0]=="etude")
	{
		$etud_fin2="checked='checked'";
		
		}
		if($etap_ef[1]=="rdv2")
	{
		$fin_rdv2="checked='checked'";
		
		}
		if($etap_ef[2]=="rdv3")
	{
		$fin_rdv3="checked='checked'";
		
		}
		if($etap_ef[3]=="rdv4")
	{
		$fin_rdv4="checked='checked'";
		
		}
		if($etap_ef[4]=="rdv5")
	{
		$fin_rdv5="checked='checked'";
		
		}
		if($etap_ef[5]=="rdv6")
	{
		$fin_rdv6="checked='checked'";
		
		}
		if($etap_ef[6]=="rdv7")
	{
		$fin_rdv7="checked='checked'";
		
		}
		if($etap_ef[7]=="rdv8")
	{
		$fin_rdv8="checked='checked'";
		
		}
		if($etap_ef[8]=="rdv9")
	{
		$fin_rdv9="checked='checked'";
		
		}
		if($etap_ef[9]=="rdv10")
	{
		$fin_rdv10="checked='checked'";
		
		}

		if($etap_ej[0]=="etude")
	{
		$etu_juri2="checked='checked'";
		
		}
		if($etap_ej[1]=="rdv2")
	{
		$jur_rdv2="checked='checked'";
		
		}
		if($etap_ej[2]=="rdv3")
	{
		$jur_rdv3="checked='checked'";
		
		}
		if($etap_ej[3]=="rdv4")
	{
		$jur_rdv4="checked='checked'";
		
		}
		if($etap_ej[4]=="rdv5")
	{
		$jur_rdv5="checked='checked'";
		
		}
		if($etap_ej[5]=="rdv6")
	{
		$jur_rdv6="checked='checked'";
		
		}
		if($etap_ej[6]=="rdv7")
	{
		$jur_rdv7="checked='checked'";
		
		}
		if($etap_ej[7]=="rdv8")
	{
		$jur_rdv8="checked='checked'";
		
		}
		if($etap_ej[8]=="rdv9")
	{
		$jur_rdv9="checked='checked'";
		
		}
		if($etap_ej[9]=="rdv10")
	{
		$jur_rdv10="checked='checked'";
		
		}


		if($etap_m[0]=="montage")
	{
		$montage="checked='checked'";
		
		}
		if($etap_m[1]=="rdv2")
	{
		$mont_rdv2="checked='checked'";
		
		}
		if($etap_m[2]=="rdv3")
	{
		$mont_rdv3="checked='checked'";
		
		}
		if($etap_m[3]=="rdv4")
	{
		$mont_rdv4="checked='checked'";
		
		}
		if($etap_m[4]=="rdv5")
	{
		$mont_rdv5="checked='checked'";
		
		}
		if($etap_m[5]=="rdv6")
	{
		$mont_rdv6="checked='checked'";
		
		}
		if($etap_m[6]=="rdv7")
	{
		$mont_rdv7="checked='checked'";
		
		}
		if($etap_m[7]=="rdv8")
	{
		$mont_rdv8="checked='checked'";
		
		}
		if($etap_m[8]=="rdv9")
	{
		$mont_rdv9="checked='checked'";
		
		}
		if($etap_m[9]=="rdv10")
	{
		$mont_rdv10="checked='checked'";
		
		}


		if($etap_c[0]=="creation")
	{
		$creation="checked='checked'";
		
		}
		if($etap_c[1]=="rdv2")
	{
		$crea_rdv2="checked='checked'";
		
		}
		if($etap_c[2]=="rdv3")
	{
		$crea_rdv3="checked='checked'";
		
		}
		if($etap_c[3]=="rdv4")
	{
		$crea_rdv4="checked='checked'";
		
		}
		if($etap_c[4]=="rdv5")
	{
		$crea_rdv5="checked='checked'";
		
		}
		if($etap_c[5]=="rdv6")
	{
		$crea_rdv6="checked='checked'";
		
		}if($etap_c[6]=="rdv7")
	{
		$crea_rdv7="checked='checked'";
		
		}
		if($etap_c[7]=="rdv8")
	{
		$crea_rdv8="checked='checked'";
		
		}
		if($etap_c[8]=="rdv9")
	{
		$crea_rdv9="checked='checked'";
		
		}
		if($etap_c[9]=="rdv10")
	{
		$crea_rdv10="checked='checked'";
		
		}





if($variable[55]=="1")
{
	$proj_clair1="checked='checked'";
		
}

//condition champs $projet_defini
if($variable[55]=="1")
{
	$proj_clair1="checked='checked'";
		
}
elseif($variable[55]=="2")
{
	
	$proj_clair2="checked='checked'";
	
}
elseif($variable[55]=="3")
{
	
	$proj_clair3="checked='checked'";
}

//condition champs $produit_defini
if($variable[56]=="1")
{
	$prod_def1="checked='checked'";

		
}
elseif($variable[56]=="2")
{
	
	$prod_def2="checked='checked'";
	
}
elseif($variable[56]=="3")
{
	
	$prod_def3="checked='checked'";
}


//condition champs $produit_listes
if($variable[57]=="1")
{
	$prod_list1="checked='checked'";
	
	
}
elseif($variable[57]=="2")
{
	
	$prod_list2="checked='checked'";
	
}
elseif($variable[57]=="3")
{
	
	$prod_list3="checked='checked'";
}

//condition champs $marche_determine
if($variable[58]=="1")
{
	$march_det1="checked='checked'";
	
	
}
elseif($variable[58]=="2")
{
	
	$march_det2="checked='checked'";
	
}
elseif($variable[58]=="3")
{
	
	$march_det3="checked='checked'";
}

//condition champs $clientele_ciblee
if($variable[59]=="1")
{
	$clien_cib1="checked='checked'";

	
}
elseif($variable[59]=="2")
{
	
	$clien_cib2="checked='checked'";
	
}
elseif($variable[59]=="3")
{
	
	$clien_cib3="checked='checked'";
}

//condition champs $fournisseurs_identifies
if($variable[60]=="1")
{
	$frs_id1="checked='checked'";
	
}
elseif($variable[60]=="2")
{

	$frs_id2="checked='checked'";
	
}
elseif($variable[60]=="3")
{
	
	$frs_id3="checked='checked'";
}

//condition champs $concurrence_identifiee
if($variable[61]=="1")
{
	$conc_id1="checked='checked'";
	
}
elseif($variable[61]=="2")
{
	
	$conc_id2="checked='checked'";
	
}
elseif($variable[61]=="3")
{

	$conc_id3="checked='checked'";
}
//condition champs $strategie_commerciale
if($variable[62]=="1")
{
	$strat_def1="checked='checked'";
	
}
elseif($variable[62]=="2")
{
	
	$strat_def2="checked='checked'";
	
}
elseif($variable[62]=="3")
{
	
	$strat_def3="checked='checked'";
}
//condition champs $stock_initial
if($variable[63]=="1")
{
	$stoc_def1="checked='checked'";
	
	}
elseif($variable[63]=="2")
{
	
	$stoc_def2="checked='checked'";
	
}
elseif($variable[63]=="3")
{
	
	$stoc_def3="checked='checked'";
}

//condition champs $prix_revient
if($variable[64]=="1")
{
	$px_rev1="checked='checked'";

}
elseif($variable[64]=="2")
{
	
	$px_rev2="checked='checked'";
	
}
elseif($variable[64]=="3")
{
	
	$px_rev3="checked='checked'";
}
//condition champs $px_vente_fix
if($variable[65]=="1")
{
	$px_fix1="checked='checked'";
	
	
}
elseif($variable[65]=="2")
{
	
	$px_fix2="checked='checked'";
	
}
elseif($variable[65]=="3")
{
	
	$px_fix3="checked='checked'";
}

//condition champs $quantites_vendues
if($variable[66]=="1")
{
	$quan_est1="checked='checked'";
	
	
}
elseif($variable[66]=="2")
{
	
	$quan_est2="checked='checked'";
	
}
elseif($variable[66]=="3")
{
	
	$quan_est3="checked='checked'";
}
//condition champs $ca_calcule
if($variable[67]=="1")
{
	$ca_calc1="checked='checked'";
	
	}
elseif($variable[67]=="2")
{

	$ca_calc2="checked='checked'";
	
}
elseif($variable[67]=="3")
{
	
	$ca_calc3="checked='checked'";
}

//condition champs $charges_activite
if($variable[68]=="1")
{
	$char_chif1="checked='checked'";
	
}
elseif($variable[68]=="2")
{
	
	$char_chif2="checked='checked'";
	
}
elseif($variable[68]=="3")
{

	$char_chif3="checked='checked'";
}
//condition champs $cpte_exploitation
if($variable[69]=="1")
{
	$cpt_fin1="checked='checked'";
	
	
}
elseif($variable[69]=="2")
{
	
	$cpt_fin2="checked='checked'";

}
elseif($variable[69]=="3")
{

	$cpt_fin3="checked='checked'";
}

//condition champs $plan_tresorerie
if($variable[70]=="1")
{
	$pl_fin1="checked='checked'";
	
}
elseif($variable[70]=="2")
{
	
	$pl_fin2="checked='checked'";
	
}
elseif($variable[70]=="3")
{
	
	$pl_fin3="checked='checked'";
}
//condition champs $point_mort_calcule
if($variable[71]=="1")
{
	$pt_mcal1="checked='checked'";
	
	}
elseif($variable[71]=="2")
{
	
	$pt_mcal2="checked='checked'";

}
elseif($variable[71]=="3")
{
	
	$pt_mcal3="checked='checked'";
}
//condition champs $seuil_rentabilite
if($variable[72]=="1")
{
	$seuil_con1="checked='checked'";
	
	}
elseif($variable[72]=="2")
{
	
	$seuil_con2="checked='checked'";
	
}
elseif($variable[72]=="3")
{
	
	$seuil_con3="checked='checked'";
}
//condition champs $investissement_defini
if($variable[73]=="1")
{
	$inv_def1="checked='checked'";
	
	}
elseif($variable[73]=="2")
{
	
	$inv_def2="checked='checked'";
	
}
elseif($variable[73]=="3")
{
	
	$inv_def3="checked='checked'";
}

//condition champs $cout_chiffre
if($variable[74]=="1")
{
	$cout_chi1="checked='checked'";
	
}
elseif($variable[74]=="2")
{
	
	$cout_chi2="checked='checked'";
	
}
elseif($variable[74]=="3")
{
	
	$cout_chi3="checked='checked'";
}
//condition champs $montant_apport
if($variable[75]=="1")
{
	$mtt_app1="checked='checked'";

	}
elseif($variable[75]=="2")
{
	
	$mtt_app2="checked='checked'";
	
}
elseif($variable[75]=="3")
{
	
	$mtt_app3="checked='checked'";
}
//condition champs $projet_financements
if($variable[76]=="1")
{
	$proj_fin1="checked='checked'";
	
}
elseif($variable[76]=="2")
{
	
	$proj_fin2="checked='checked'";
	
}
elseif($variable[76]=="3")
{

	$proj_fin3="checked='checked'";
}
//condition champs $montant_besoin
if($variable[77]=="1")
{
	$mtt_fin1="checked='checked'";
	
}
elseif($variable[77]=="2")
{
	
	$mtt_fin2="checked='checked'";
	
}
elseif($variable[77]=="3")
{
	
	$mtt_fin3="checked='checked'";
}
//condition champs $lieu_implantation
if($variable[78]=="1")
{
	$lieu_choi1="checked='checked'";

	}
elseif($variable[78]=="2")
{
	
	$lieu_choi2="checked='checked'";
	
}
elseif($variable[78]=="3")
{
	
	$lieu_choi3="checked='checked'";
}
//condition champs $local_necessaire
if($variable[79]=="1")
{
	$loc_nec1="checked='checked'";
	
}
elseif($variable[79]=="2")
{
	
	$loc_nec2="checked='checked'";
	
}
elseif($variable[79]=="3")
{
	
	$loc_nec3="checked='checked'";
}

//condition champs $local_trouve
if($variable[80]=="1")
{
	$loc_trou1="checked='checked'";
	
	}
elseif($variable[80]=="2")
{
	
	$loc_trou2="checked='checked'";
	
}
elseif($variable[80]=="3")
{

	$loc_trou3="checked='checked'";
}

//condition champs $nb_emplois_crees
if($variable[81]=="1")
{
	$nb_cree1="checked='checked'";
	
}
elseif($variable[81]=="2")
{
	
	$nb_cree2="checked='checked'";
	
}
elseif($variable[81]=="3")
{
	
	$nb_cree3="checked='checked'";
	
}

//condition champs $nb_emplois_salaries
if($variable[82]=="1")
{
	$nb_sal1="checked='checked'";
	
}
elseif($variable[82]=="2")
{
	
	$nb_sal2="checked='checked'";
	
}
elseif($variable[82]=="3")
{

	$nb_sal3="checked='checked'";
}

//condition champs $statut_createur
if($variable[83]=="1")
{
	$stat_cdef1="checked='checked'";
	
}
elseif($variable[83]=="2")
{
	
	$stat_cdef2="checked='checked'";
	
}
elseif($variable[83]=="3")
{
	
	$stat_cdef3="checked='checked'";
}

//condition champs $statut_juridique
if($variable[84]=="1")
{
	$stat_jdef1="checked='checked'";
	
}
elseif($variable[84]=="2")
{
	
	$stat_jdef2="checked='checked'";
	
}
elseif($variable[84]=="3")
{

	$stat_jdef3="checked='checked'";
}

//condition champs $demarches_entamees
if($variable[85]=="1")
{
	$dem_ent1="checked='checked'";
	
	
}
elseif($variable[85]=="2")
{
	
	$dem_ent2="checked='checked'";
	
}
elseif($variable[85]=="3")
{
	
	$dem_ent3="checked='checked'";
}

//condition champs $regime_fiscal
if($variable[86]=="1")
{
	$regi_choi1="checked='checked'";
	
	
}
elseif($variable[86]=="2")
{
	
	$regi_choi2="checked='checked'";
	
}
elseif($variable[86]=="3")
{
	
	$regi_choi3="checked='checked'";
}

//condition champs $projet_redige
if($variable[87]=="1")
{
	$proj_red1="checked='checked'";
	
	
}
elseif($variable[87]=="2")
{
	
	$proj_red2="checked='checked'";
	
}
elseif($variable[87]=="3")
{

	$proj_red3="checked='checked'";
}


$perso=explode(",", $variable[20]);
for ($i=0; $i<count($perso); $i++)
{
	if($perso[$i]=="1")
	{
		$cont_fam="checked='checked'";
		
		}
		if($perso[$i]=="2")
	{
		$cont_sant="checked='checked'";
		
		}		
		if($perso[$i]=="3")
	{
		$cont_tps="checked='checked'";
		
		}
		if($perso[$i]=="4")
	{
		$cont_fin="checked='checked'";
		
		}
}

//------------------------------------------------------------------------------
//condition champs $contraintes_projet
$projet=explode(",",$variable[21]);
for ($i=0; $i<count($projet); $i++)
{
	if($projet[$i]=="1")
	{
		$cont_prod="checked='checked'";
		
		}
		if($projet[$i]=="2")
	{
		$cont_march="checked='checked'";
		
		}		
		if($projet[$i]=="3")
	{
		$cont_moy="checked='checked'";
		
		}
		if($projet[$i]=="4")
	{
		$cont_leg="checked='checked'";
		
		}
}


//condition champs $exp_pro_secteur
if($variable[17]=="1")
{
	$exp_tfaib="checked='checked'";
	
	
}
elseif($variable[17]=="2")
{
	
	$exp_faib="checked='checked'";
	
}
elseif($variable[17]=="3")
{
	$exp_for="checked='checked'";
	
}
elseif($variable[17]=="4")
{
	$exp_tfor="checked='checked'";
}

//condition champs $formation
if($variable[18]=="1")
{
	$form_tfaib="checked='checked'";
	
}
elseif($variable[18]=="2")
{
	
	$form_faib="checked='checked'";
	
}
elseif($variable[18]=="3")
{
	
	$form_for="checked='checked'";
	
}
elseif($variable[18]=="4")
{
	
	$form_tfor="checked='checked'";
}

//condition champs $acquis_extraprof
if($variable[19]=="1")
{
	$acquis_tfaib="checked='checked'";
	
}
elseif($variable[19]=="2")
{
	
	$acquis_faib="checked='checked'";
	
}
elseif($variable[19]=="3")
{
	$acquis_for="checked='checked'";
	
}
elseif($variable[19]=="4")
{
	$acquis_tfor="checked='checked'";
}

if($motiv[0]=="1")
	{
		$desir_ind="checked='checked'";
		
		}
		if($motiv[1]=="2")
	{
		$gout_resp="checked='checked'";
		
		}		
		if($motiv[2]=="3")
	{
		$conc_reve="checked='checked'";
		
		}
		if($motiv[3]=="4")
	{
		$chang_vie="checked='checked'";
		
		}
		if($motiv[4]=="5")
	{
		$expl_opport="checked='checked'";
		
		}
		if($motiv[5]=="6")
	{
		$acc_statu="checked='checked'";
		
		}
		if($motiv[6]=="7")
	{
		$disp_revenu="checked='checked'";
		
		}
		if($motiv[7]=="8")
	{
		$augm_rev="checked='checked'";
		
		}
		if($motiv[8]=="9")
	{
		$trav_conj="checked='checked'";
		
		}
		if($motiv[9]=="10")
	{
		$partenaria="checked='checked'";
		
		}
		
if($ex_pers[0]=="dynamique")
	{
		$dynamique="checked='checked'";
		
		}
		if($ex_pers[1]=="autoritaire")
	{
		$autoritaire="checked='checked'";
		
		}		
		if($ex_pers[2]=="tetu")
	{
		$tetu="checked='checked'";
		
		}
		if($ex_pers[3]=="enthousiaste")
	{
		$enthousiaste="checked='checked'";
		
		}
		if($ex_pers[4]=="entreprenant")
	{
		$entreprenant="checked='checked'";
		
		}
		if($ex_pers[5]=="sens de linitiative")
	{
		$sensinitiative="checked='checked'";
		
		}
		if($ex_pers[6]=="conformiste")
	{
		$conformiste="checked='checked'";
		
		}
		if($ex_pers[7]=="d humeur changeante")
	{
		$humeurchangeante="checked='checked'";
		
		}
		if($ex_pers[8]=="emotif sensible")
	{
		$emotifsensible="checked='checked'";
		
		}
		if($ex_pers[9]=="volontaire")
	{
		$volontaire="checked='checked'";
		
		}
		if($ex_pers[10]=="desordonne")
	{
		$desordonne="checked='checked'";
		
		}
		if($ex_pers[11]=="realiste")
	{
		$realiste="checked='checked'";
		
		}
		if($ex_pers[12]=="logique")
	{
		$logique="checked='checked'";
		
		}
		if($ex_pers[13]=="intuitif")
	{
		$intuitif="checked='checked'";
		
		}
		if($ex_pers[14]=="adaptable")
	{
		$adaptable="checked='checked'";
		
		}
		if($ex_pers[15]=="rigoureux")
	{
		$rigoureux="checked='checked'";
		
		}
		if($ex_pers[16]=="autonome")
	{
		$autonome="checked='checked'";
		
		}
		if($ex_pers[17]=="intransigeant")
	{
		$intransigeant="checked='checked'";
		
		}if($ex_pers[18]=="esprit d equipe")
	{
		$espritdequipe="checked='checked'";
		
		}if($ex_pers[19]=="disperse")
	{
		$disperse="checked='checked'";
		
		}if($ex_pers[20]=="ne sait pas ecouter")
	{
		$nesaitpasecouter="checked='checked'";
		
		}		
		if($ex_pers[21]=="constructif")
	{
		$constructif="checked='checked'";
		
		}
		if($ex_pers[22]=="pointilleux")
	{
		$pointilleux="checked='checked'";
		
		}
		if($ex_pers[23]=="inattentif")
	{
		$inattentif="checked='checked'";
		
		}
		if($ex_pers[24]=="large d esprit")
	{
		$largedesprit="checked='checked'";
		
		}
		if($ex_pers[25]=="susceptible")
	{
		$susceptible="checked='checked'";
		
		}
		if($ex_pers[26]=="negociateur")
	{
		$negociateur="checked='checked'";
		
		}
		if($ex_pers[27]=="manuel")
	{
		$manuel="checked='checked'";
		
		}
		if($ex_pers[28]=="creatif")
	{
		$creatif="checked='checked'";
		
		}
		if($ex_pers[29]=="empathique")
	{
		$empathique="checked='checked'";
		
		}
		if($ex_pers[30]=="capable de travailler sous pression")
	{
		$souspression="checked='checked'";
		
		}		
		if($ex_pers[31]=="etourdi")
	{
		$etourdi="checked='checked'";
		
		}
		if($ex_pers[32]=="optimiste")
	{
		$optimiste="checked='checked'";
		
		}
		if($ex_pers[33]=="pessimiste")
	{
		$pessimiste="checked='checked'";
		
		}
		if($ex_pers[34]=="maniaque")
	{
		$maniaque="checked='checked'";
		
		}
		if($ex_pers[35]=="souple ouvert")
	{
		$soupleouvert="checked='checked'";
		
		}
		if($ex_pers[36]=="organise")
	{
		$organise="checked='checked'";
		
		}
		if($ex_pers[37]=="raleur")
	{
		$raleur="checked='checked'";
		
		}
		if($ex_pers[38]=="sociable")
	{
		$sociable="checked='checked'";
		
		}if($ex_pers[39]=="timide")
	{
		$timide="checked='checked'";
		
		}
		if($ex_pers[40]=="ferme")
	{
		$ferme="checked='checked'";
		
		}
		if($ex_pers[41]=="dilettante")
	{
		$dilettante="checked='checked'";
		
		}
		if($ex_pers[42]=="tenace")
	{
		$tenace="checked='checked'";
		
		}
		if($ex_pers[43]=="curieux")
	{
		$curieux="checked='checked'";
		
		}
		if($ex_pers[44]=="anxieux")
	{
		$anxieux="checked='checked'";
		
		}		
		if($ex_pers[45]=="innovateur")
	{
		$innovateur="checked='checked'";
		
		}
		if($ex_pers[46]=="consciencieux")
	{
		$consciencieux="checked='checked'";
		
		}
		if($ex_pers[47]=="impatient")
	{
		$impatient="checked='checked'";
		
		}
		if($ex_pers[48]=="perseverant")
	{
		$perseverant="checked='checked'";
		
		}
		if($ex_pers[49]=="imprevoyant")
	{
		$imprevoyant="checked='checked'";
		
		}
		if($ex_pers[50]=="individualiste")
	{
		$individualiste="checked='checked'";
		
		}
		if($ex_pers[51]=="apprend_rapidement")
	{
		$apprendrapidement="checked='checked'";
		
		}
		if($ex_pers[52]=="reflechi")
	{
		$reflechi="checked='checked'";
		
		}
		if($ex_pers[53]=="rigide")
	{
		$rigide="checked='checked'";
		
		}
		if($ex_pers[54]=="diplomate")
	{
		$diplomate="checked='checked'";
		
		}
		if($ex_pers[55]=="pedagogue")
	{
		$pedagogue="checked='checked'";
		
		}
		if($ex_pers[56]=="pragmatique")
	{
		$pragmatique="checked='checked'";
		
		}if($ex_pers[57]=="gout du risque")
	{
		$goutrisque="checked='checked'";
		
		}
		if($ex_pers[58]=="sens de l ecoute")
	{
		$sensecoute="checked='checked'";
		
		}
		if($ex_pers[59]=="sens de l humour")
	{
		$senshumour="checked='checked'";
		
		}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" href="readme_files/screensmall.css" type="text/css" media="screen">
<title>Entretien préliminaire</title>
</head>

<body bgcolor="#FFFF99">
<div id="content"><div class='section demo'>
<center><input name="enregistrer" onclick="window.location.href='../epce/presentation/panel.php?display_eval=block&id_presta=<?php echo $_GET['id_presta']; ?>&type_presta=<?php echo $_GET['type_presta']; ?>&lc=<?php echo $_GET['lc']; ?>&choix=<?php echo $_GET['choix']; ?>#preliminaire'" type="button" value="Retour" /></center><form action="recup_formulaire_nacre.php"  method="post" name="nacre_entretient"><input type="hidden" name="id_ben" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />
<h3>La personnalité du créateur</h3> 
<div>

<div class='div1'><label>Dynamique <input name="dynamique" type="checkbox" <?php echo $dynamique; ?> value="dynamique" /></label></div>
<div class='div2'><label>Rigoureux <input name="rigoureux" type="checkbox" <?php echo $rigoureux; ?>  value="rigoureux" /></label></div>
<div class='div3'><label><font size="-2">Capable de travailler sous pression</font> <input <?php echo $souspression; ?>  name="capable_travailler_pression" type="checkbox" value="capable de travailler sous pression" /></label></div>

<div class='div4'><label>Innovateur <input name="innovateur" type="checkbox" <?php echo $innovateur; ?> value="innovateur" /></label></div>


<div class='div1'><label>Autoritaire <input name="autoritaire" <?php echo $autoritaire; ?> type="checkbox" value="autoritaire" /></label></div>
<div class='div2'><label>Autonome <input name="autonome" type="checkbox" <?php echo $autonome; ?> value="autonome" /></label></div>
<div class='div3'><label>Etourdi <input name="etourdi" type="checkbox" <?php echo $etourdi; ?> value="etourdi" /></label></div>
<div class='div4'><label>Consciencieux <input name="consciencieux" <?php echo $consciencieux; ?> type="checkbox" value="consciencieux" /></label></div>




<div class='div1'><label>Têtu <input name="tetu" type="checkbox" <?php echo $tetu; ?> value="tetu" /></label></div>
<div class='div2'><label>Intransigeant <input name="intransigeant" type="checkbox" <?php echo $intransigeant; ?> value="intransigeant" /></label></div>
<div class='div3'><label>Optimiste <input name="optimiste" type="checkbox" <?php echo $optimiste; ?> value="optimiste" /></label></div>
<div class='div4'><label>Impatient <input name="impatient" type="checkbox" <?php echo $impatient; ?> value="impatient" /></label></div>


<div class='div1'><label>Enthousiaste <input  name="enthousiaste" type="checkbox" <?php echo $enthousiaste; ?> value="enthousiaste" /></label></div>
<div class='div2'><label>Esprit d'équipe<input name="esprit_equipe" type="checkbox" <?php echo $espritdequipe; ?>value="esprit d equipe" /></label></div>
<div class='div3'><label>Pessimiste <input name="pessimiste" type="checkbox" value="pessimiste" <?php echo $pessimiste; ?>  /></label></div>
<div class='div4'><label>Persévérant <input name="perseverant" type="checkbox" value="perseverant" <?php echo $perseverant; ?>/></label></div>


<div class='div1'><label>Entreprenant <input name="entreprenant" type="checkbox" value="entreprenant" <?php echo $entreprenant; ?> /></label></div>
<div class='div2'><label>Dispersé<input name="disperse" type="checkbox" value="disperse" <?php echo $disperse; ?>/></label></div>
<div class='div3'><label>Maniaque <input name="maniaque" type="checkbox" value="maniaque" <?php echo $maniaque; ?>/></label></div>
<div class='div4'><label>Imprévoyant <input name="imprevoyant" type="checkbox" value="imprevoyant" <?php echo $imprevoyant; ?> /></label></div>

<div class='div1'><label>Sens de l'initiative <input name="sens_initiative" type="checkbox" value="sens de linitiative" <?php echo $sensinitiative; ?> /></label></div>
<div class='div2'><label>Ne sait pas écouter <input name="sait_pas_ecouter" type="checkbox" value="ne sait pas ecouter"  <?php echo $nesaitpasecouter; ?>/></label></div>
<div class='div3'><label>Souple, ouvert <input name="souple_ouvert" type="checkbox" value="souple ouvert" <?php echo $soupleouvert; ?>/></label></div>
<div class='div4'><label>Individualiste <input name="individualiste" type="checkbox" value="individualiste" /<?php echo $individualiste; ?> ></label></div>

<div class='div1'><label>Conformiste <input name="conformiste" type="checkbox" value="conformiste" <?php echo $conformiste; ?>/></label></div>
<div class='div2'><label>Constructif <input name="constructif" type="checkbox" value="constructif" <?php echo $constructif; ?> /></label></div>
<div class='div3'><label>Organisé <input name="organise" type="checkbox" value="organise" <?php echo $organise; ?> /></label></div>
<div class='div4'><label>Apprend rapidement <input name="apprend_rapidement" type="checkbox" value="apprend_rapidement" <?php echo $apprendrapidement; ?>/></label></div>


<div class='div1'><label>D'humeur changeante <input name="humeur_changeante" type="checkbox" value="d humeur changeante" <?php echo $humeurchangeante; ?>/></label></div>
<div class='div2'><label>Pointilleux <input name="pointilleux" type="checkbox" value="pointilleux" <?php echo $pointilleux; ?> /></label></div>
<div class='div3'><label>Râleur <input name="raleur" type="checkbox" value="raleur" <?php echo $raleur; ?> /></label></div>
<div class='div4'><label>Réfléchi <input name="reflechi" type="checkbox" value="reflechi" <?php echo $reflechi; ?> /></label></div>


<div class='div1'><label>Emotif / Sensible <input name="emotif_sensible" type="checkbox" value="emotif sensible"  <?php echo $emotifsensible; ?>/></label></div>
<div class='div2'><label>Inattentif <input name="inattentif" type="checkbox" value="inattentif" <?php echo $inattentif; ?> /></label></div>
<div class='div3'><label>Sociable <input name="sociable" type="checkbox" value="sociable" <?php echo $sociable; ?> /></label></div>
<div class='div4'><label>Rigide <input name="rigide" type="checkbox" value="rigide" <?php echo $rigide; ?> /></label></div>


<div class='div1'><label>Volontaire <input name="volontaire" type="checkbox" value="volontaire" <?php echo $volontaire; ?> /></label></div>
<div class='div2'><label>Large d'esprit <input name="large_esprit" type="checkbox" value="large d esprit" <?php echo $largedesprit; ?> /></label></div>
<div class='div3'><label>Timide <input name="timide" type="checkbox" value="timide" <?php echo $timide; ?> /></label></div>
<div class='div4'><label>Diplomate <input name="diplomate" type="checkbox" value="diplomate" <?php echo $diplomate; ?> /></label></div>


<div class='div1'><label>Désordonné <input name="desordonne" type="checkbox" value="desordonne" <?php echo $desordonne; ?> /></label></div>
<div class='div2'><label>Susceptible <input name="susceptible" type="checkbox" value="susceptible"  <?php echo $susceptible; ?> /></label></div>
<div class='div3'><label>Ferme <input name="ferme" type="checkbox" value="ferme" <?php echo $ferme; ?> /></label></div>
<div class='div4'><label>Pédagogue <input name="pedagogue" type="checkbox" value="pedagogue"  <?php echo $pedagogue; ?> /></label></div>

<div class='div1'><label>Réaliste <input name="realiste" type="checkbox" value="realiste" <?php echo $realiste; ?> /></label></div>
<div class='div2'><label>Négociateur <input name="negociateur" type="checkbox" value="negociateur" <?php echo $negociateur; ?> /></label></div>
<div class='div3'><label>Dilettante <input name="dilettante" type="checkbox" value="dilettante" <?php echo $dilettante; ?> /></label></div>
<div class='div4'><label>Pragmatique <input name="pragmatique" type="checkbox" value="pragmatique" <?php echo $pragmatique; ?> /></label></div>


<div class='div1'><label>Logique <input name="logique" type="checkbox" value="logique" <?php echo $logique; ?> /></label></div>
<div class='div2'><label>Manuel <input name="manuel" type="checkbox" value="manuel" <?php echo $manuel; ?> /></label></div>
<div class='div3'><label>Tenace <input name="tenace" type="checkbox" value="tenace" <?php echo $tenace; ?> /></label></div>
<div class='div4'><label>Goût du risque <input name="gout_risque" type="checkbox" <?php echo $goutrisque; ?> value="gout du risque" /></label></div>


<div class='div1'><label>Intuitif <input name="intuitif" type="checkbox" value="intuitif" <?php echo $intuitif; ?> /></label></div>
<div class='div2'><label>Créatif <input name="creatif" type="checkbox" value="creatif" <?php echo $creatif; ?> /></label></div>
<div class='div3'><label>Curieux <input name="curieux" type="checkbox" value="curieux" <?php echo $curieux; ?> /></label></div>
<div class='div4'><label>Sens de l'écoute <input name="sens_ecoute" type="checkbox" <?php echo $sensecoute; ?> value="sens de l ecoute" /></label></div>

<div class='div1'><label>Adaptable <input name="adaptable" type="checkbox" value="adaptable" <?php echo $adaptable; ?> /></label></div>

<div class='div2'><label>Empathique <input name="empathique" type="checkbox" value="empathique" <?php echo $empathique; ?> /></label></div>
<div class='div3'><label>Anxieux <input name="anxieux" type="checkbox" value="anxieux" <?php echo $anxieux; ?>/></label></div>
<div class='div4'><label>Sens de l'humour <input name="sens_humour" type="checkbox" value="sens de l humour" <?php echo $senshumour; ?> /></label></div>

</div>
<br/><br/><br/><br/>
<h3>Reprenez les 5 points forts et les 5 points faibles qui vous caractérisent le plus</h3>

<table>
<tr>
<td colspan="2" align="center">5 points forts</td><td colspan="2" align="center">5 points faibles</td>
</tr>

<tr>
<td>1-</td><td><input style="border:1px  solid #0C0" name="pt_fort1" value="<?php echo $variable[1]; ?>"  size="50"type="text" /></td><td>1-</td><td><input style="border:1px  solid  #F00" size="50" name="pt_faible1" type="text" value="<?php echo $variable[6]; ?>" /></td>
</tr>

<tr>
<td>2-</td><td><input style="border:1px  solid #0C0" name="pt_fort2"  value="<?php echo $variable[2]; ?>" size="50" type="text" /></td><td>2-</td><td><input style="border:1px  solid  #F00" size="50" name="pt_faible2" type="text" value="<?php echo $variable[7]; ?>" /></td>
</tr>

<tr>
<td>3-</td><td><input style="border:1px  solid #0C0" name="pt_fort3" value="<?php echo $variable[3]; ?>" size="50" type="text" /></td><td>3-</td><td><input value="<?php echo $variable[8]; ?>" size="50" style="border:1px  solid  #F00"  name="pt_faible3" type="text" /></td>
</tr>

<tr>
<td>4-</td><td><input style="border:1px  solid #0C0" name="pt_fort4" value="<?php echo $variable[4]; ?>" size="50" type="text" /></td><td>4-</td><td><input style="border:1px  solid  #F00" size="50" name="pt_faible4" type="text" value="<?php echo $variable[9]; ?>" /></td>
</tr>

<tr>
<td>5-</td><td><input value="<?php echo $variable[5]; ?>" style="border:1px solid #0C0" name="pt_fort5" size="50" type="text" /></td><td>5-</td><td><input  style="border:1px  solid  #F00" size="50" name="pt_faible5" type="text" value="<?php echo $variable[10]; ?>" /></td>
</tr>
</table>
<br/>
2.2	Points à améliorer<br/><br/>
<table>
<tr>
<td>1-</td><td><input size="50" name="pt_amel1" type="text" value="<?php echo $variable[11]; ?>" /></td>
</tr>

<tr>
<td>2-</td><td><input size="50" name="pt_amel2" type="text" value="<?php echo $variable[12]; ?>"/></td>
</tr>

<tr>
<td>3-</td><td><input size="50" name="pt_amel3" type="text" value="<?php echo $variable[13]; ?>" /></td>
</tr>

<tr>
<td>4-</td><td><input size="50" name="pt_amel4" type="text" value="<?php echo $variable[14]; ?>"/></td>
</tr>

<tr>
<td>5-</td><td><input size="50" name="pt_amel5" type="text" value="<?php echo $variable[15]; ?>" /></td>
</tr>
</table>
<br /><br />
<h3>3.	Les motivations du créateur</h3>

Vous souhaitez créer : 
<br /><br />

<label>Par désir d’indépendance ? <input name="independance" <?php echo $desir_ind; ?> type="checkbox" value="1" /></label>
<label>Par goût des responsabilités ? <input  <?php echo $gout_resp; ?> name="responsabilites" type="checkbox" value="2" /></label>
<label>Pour concrétiser un rêve, une passion ? <input <?php echo $conc_reve; ?> name="reve_passion" type="checkbox" value="3" /></label>
<label>Pour vous réaliser, changer de vie ? <input <?php echo $chang_vie; ?> name="changer_vie" type="checkbox" value="4" /></label>
<label>Pour exploiter une opportunité ? <input <?php echo $expl_opport; ?> name="opportunite" type="checkbox" value="5" /></label>
<label>Pour accéder à un meilleur statut social ? <input <?php echo $acc_statu; ?> name="statut_sociel" type="checkbox" value="6" /></label>
<label>Pour disposer d’un revenu immédiat ? <input <?php echo $disp_revenu; ?> name="revenu_immediat" type="checkbox" value="7" /></label>
<label>Pour augmenter ses revenus et son patrimoine ? <input <?php echo $augm_rev; ?> name="patrimoine" type="checkbox" value="8" /></label>
<label>Pour travailler avec votre conjoint ? <input <?php echo $trav_conj; ?> name="conjoint" type="checkbox" value="9" /></label>
<label>Pour vivre un partenariat ? <input <?php echo $partenaria; ?> name="partenariat" type="checkbox" value="10" /></label>



<br /><br />
<h3>4.	L’adéquation personne/projet</h3>
4.1	Parcours de Formation
<br /><div style="font-size:10px"><?php $nacre1->afficher_formation($_GET['choix']);?></div>
<br />

4.2	Expériences professionnelles
<br /><div style="font-size:10px">
<?php $nacre1->afficher_employeurs($_GET['choix']);?></div>
<br />
<br /><br />
4.3	Validation de l’adéquation
<br /><br />
<table>
<tr style="background-color:#1c1c1c; height:25px;">
<td width="258">Intitulé</td><td width="192">Très faible</td><td width="174">Faible</td><td width="179">Forte</td><td width="163">Très forte</td>
</tr>
<tr>
<td>Expérience Pro dans le secteur</td><td><label><input name="exp_pro" <?php echo $exp_tfaib; ?> type="radio" value="1" />
  <br />
</label></td><td><label><input name="exp_pro" type="radio" <?php echo $exp_faib; ?> value="2" />
    <br />
</label></td><td><label><input name="exp_pro"  type="radio" <?php echo $exp_for; ?>value="3" />
    <br />
</label></td><td><label><input name="exp_pro" type="radio" <?php echo $exp_tfor; ?>value="4" />
    <br />
</label></td>
</tr>
<tr>
<td>Formation</td><td><label><input name="formation1" <?php echo $form_tfaib; ?> type="radio" value="1" />
  <br />
</label></td><td><label><input name="formation1" <?php echo $form_faib; ?> type="radio" value="2" />
    <br />
</label></td><td><label><input name="formation1" <?php echo $form_for; ?> type="radio" value="3" />
    <br />
</label></td><td><label><input name="formation1" <?php echo $form_tfor; ?> type="radio" value="4" />
    <br />
</label></td>
</tr>
<tr>
<td>Acquis extraprofessionnels</td><td><label><input <?php echo $acquis_tfaib; ?> name="acquis" type="radio" value="1" />
  <br />
</label></td><td><label><input name="acquis" <?php echo $acquis_faib; ?> type="radio" value="2" />
    <br />
</label></td><td><label><input name="acquis" <?php echo $acquis_for; ?> type="radio" value="3" />
    <br />
</label></td><td><label><input name="acquis" <?php echo $acquis_tfor; ?> type="radio" value="4" />
    <br />
</label></td>
</tr>
</table>
<br /><br />
<h3>5.	Compréhension des contraintes du statut de créateur</h3>

5.1	Avez-vous envisagé vos contraintes personnelles ?
<br /><br />
<label>Les contraintes familiales <input <?php echo $cont_fam; ?> name="cont_familiale" type="checkbox" value="1" /></label>
Votre famille adhère t-elle à cette création ? Avez-vous pensé aux conséquences de votre création sur votre vie familiale ? Avez-vous mesuré les enjeux ?<br/><br/>


<label>Les contraintes de santé <input <?php echo $cont_sant; ?> name="cont_sante" type="checkbox" value="2" /></label>
Votre santé est-elle en adéquation avec les sollicitations prévisibles de votre entreprise ?<br /><br/>


<label>Les contraintes de temps <input <?php echo $cont_tps; ?> name="cont_temps" type="checkbox" value="3" /></label>
Aurez-vous la disponibilité et le temps nécessaires pour préparer correctement votre projet, et vous consacrer à votre entreprise ?<br/><br/>


<label>Les contraintes financières <input <?php echo $cont_fin; ?> name="cont_financiere" type="checkbox" value="4" /></label>
Quelles sont vos charges financières actuelles ? Avez-vous par ailleurs des revenus réguliers vous permettant de vivre avant l’encaissement des premières ventes ? Si ce n’est pas le cas, votre projet permet-il des rentrées de fonds rapides ou avez-vous pris la précaution de vous constituer une épargne ?<br/><br/>


<br /><br />
5.2	Avez-vous envisagé les contraintes du projet ?
<br /><br />
<label>Les contraintes propres au produit ou à la prestation <input <?php echo $cont_prod; ?> name="cont_produit" type="checkbox" value="1" /></label>Si j’envisage de vendre un produit issu d’un effet de mode je ne dois pas oublier de tenir compte de la courte durée d’exploitation de ce produit.<br/><br/>

<label>Les contraintes de marché <input <?php echo $cont_march; ?> name="cont_marche" type="checkbox" value="2" /></label>Un marché peut être nouveau, en décollage, en pleine maturité, en déclin, saturé, fermé….
Si mon marché est à créer je ne dois pas oublier de prévoir des frais de communication, de prospection importants.<br/><br/> 


<label>Les contraintes de moyens <input <?php echo $cont_moy; ?> name="cont_moyens" type="checkbox" value="3" /></label> Mon activité nécessite t’elle de lourds investissements alors que ma capacité financière est faible ? <br/><br/>


<label>Les contraintes légales <input <?php echo $cont_leg; ?> name="cont_legales" type="checkbox" value="4" /></label>Mon activité est-elle réglementée ? (Expérience professionnelle, diplôme,…) <br/><br/>
<br /><br />
<h3>6.	1ère Evaluation du projet</h3>
<table>
<tr style="background-color:#1c1c1c; height:25px; text-align:center"><td width="235" rowspan="2"></td>
<td colspan="2">OUI</td>
<td width="210" rowspan="2">NON</td><td width="314" rowspan="2">Commentaires</td></tr>
<tr style="background-color: #292929 ; height:25px;text-align:center"><td width="197">A l'oral</td><td width="218">A l'écrit</td></tr>
<tr><td colspan="5" style="color: #0F0">PROJET</td></tr>

<tr><td>Le projet est clairement défini</td><td><label><input <?php echo $proj_clair1; ?> name="projet_clair" type="radio" value="1" />
  <br />
</label></td><td><label><input name="projet_clair" <?php echo $proj_clair2; ?> type="radio" value="2" />
    <br />
</label></td><td><label><input name="projet_clair" <?php echo $proj_clair3; ?> type="radio" value="3" />
    <br />
</label></td><td><input size="50" name="commentaires1" value="<?php echo $variable[22]; ?>" type="text" /></td></tr>

<tr><td colspan="5">PRODUIT</td></tr>

<tr><td>Les produits sont définis</td><td><label><input <?php echo $prod_def1; ?> name="produit_defini" type="radio" value="1" />
  <br />
</label></td><td><label><input name="produit_defini" <?php echo $prod_def2; ?> type="radio" value="2" />
    <br />
</label></td><td><label><input name="produit_defini" <?php echo $prod_def3; ?> type="radio" value="3" />
    <br />
</label></td><td><input size="50" name="commentaires2"  value="<?php echo $variable[23]; ?>"type="text" /></td></tr>

<tr><td>Les produits sont listés</td><td><label><input <?php echo $prod_list1; ?> name="produit_listes" type="radio" value="1" /><br/></label></td><td><label><input name="produit_listes" <?php echo $prod_list2; ?> type="radio" value="2" /><br/></label></td><td><label><input <?php echo $prod_list3; ?> name="produit_listes" type="radio" value="3" /><br/></label></td><td><input name="commentaires3" value="<?php echo $variable[24]; ?>" size="50"  type="text" /></td></tr>

<tr><td colspan="5">MARCHE</td></tr>

<tr><td>Le marché est déterminé</td><td><label><input <?php echo $march_det1; ?> name="marche_determine1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $march_det2; ?> name="marche_determine1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $march_det3; ?> name="marche_determine1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[25]; ?>" name="commentaires4" type="text" size="50"  /></td></tr>

<tr><td>La clientèle est ciblée</td><td><label><input name="clientele_ciblee1" <?php echo $clien_cib1; ?> type="radio" value="1" /><br/></label></td><td><label><input  <?php echo $clien_cib2; ?> name="clientele_ciblee1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $clien_cib3; ?> name="clientele_ciblee1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[26]; ?>" name="commentaires5" type="text"  size="50"  /></td></tr>

<tr><td>Les fournisseurs sont identifiés</td><td><label><input <?php echo $frs_id1; ?> name="fournisseurs_identifies1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $frs_id2; ?> name="fournisseurs_identifies1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $frs_id3; ?> name="fournisseurs_identifies1" type="radio" value="3" /><br/></label></td><td><input name="commentaires6" value="<?php echo $variable[27]; ?>" size="50"  type="text" /></td></tr>

<tr><td>La concurrence est identifiée</td><td><label><input <?php echo $conc_id1; ?> name="concurrence_ident1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $conc_id2; ?> name="concurrence_ident1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $conc_id3; ?> name="concurrence_ident1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[28]; ?>" name="commentaires7" type="text" size="50"  /></td></tr>

<tr><td>La stratégie commerciale est définie</td><td><label><input <?php echo $strat_def1; ?> name="strategie_definie1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $strat_def2; ?> name="strategie_definie1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $strat_def3; ?> name="strategie_definie1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[29]; ?>"  name="commentaires8" type="text" size="50"  /></td></tr>

<tr><td colspan="5">CHIFFRAGE</td></tr>

<tr><td>Le stock initial est défini</td><td><label><input <?php echo $stoc_def1; ?> name="stock_defini1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $stoc_def2; ?> name="stock_defini1" type="radio" value="2" /><br/></label></td><td><label><input  <?php echo $stoc_def3; ?> name="stock_defini1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[30]; ?>" name="commentaires9" type="text" size="50"  /></td></tr>
<tr><td>Le prix de revient est connu</td><td><label><input <?php echo $px_rev1; ?> name="prix_revient1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $px_rev2; ?> name="prix_revient1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $px_rev3; ?> name="prix_revient1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[31]; ?>" name="commentaires10" type="text" size="50"  /></td></tr>
<tr><td>Les prix de vente sont fixés</td><td><label><input <?php echo $px_fix1; ?> name="prix_fixes1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $px_fix2; ?> name="prix_fixes1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $px_fix3; ?> name="prix_fixes1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[32]; ?>" name="commentaires11" type="text" size="50"  /></td></tr>
<tr><td>Les quantités vendues sont estimées</td><td><label><input <?php echo $quan_est1; ?> name="quantites_estimees1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $quan_est2; ?> name="quantites_estimees1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $quan_est3; ?> name="quantites_estimees1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[33]; ?>" name="commentaires12" type="text" size="50"  /></td></tr>
<tr><td>Le chiffre d'affaires est calculé</td><td><label><input <?php echo $ca_calc1; ?> name="ca_calcule1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $ca_calc2; ?> name="ca_calcule1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $ca_calc3; ?> name="ca_calcule1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[34]; ?>" name="commentaires13" type="text" size="50"  /></td></tr>
<tr><td>Les charges de l'activité sont chiffrées</td><td><label><input <?php echo $char_chif1; ?> name="charges_chiffrees1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $char_chif2; ?> name="charges_chiffrees1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $char_chif3; ?> name="charges_chiffrees1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[35]; ?>" name="commentaires14" type="text" size="50"  /></td></tr>
<tr><td>Le compte d'exploitation est finalisé</td><td><label><input <?php echo $cpt_fin1; ?> name="compte_finalise1" type="radio" value="1" /><br/></label></td><td><label><input name="compte_finalise1" <?php echo $cpt_fin2; ?> type="radio" value="2" /><br/></label></td><td><label><input <?php echo $cpt_fin3; ?> name="compte_finalise1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[36]; ?>" name="commentaires15" type="text" size="50"   /></td></tr>
<tr><td>Le plan de trésorerie est finalisé</td><td><label><input <?php echo $pl_fin1; ?> name="plan_finalise1" type="radio" value="1" /><br/></label></td><td><label><input name="plan_finalise1"  <?php echo $pl_fin2; ?> type="radio" value="2" /><br/></label></td><td><label><input <?php echo $pl_fin3; ?> name="plan_finalise1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[37]; ?>" name="commentaires16" type="text" size="50"  /></td></tr>
<tr><td>Le point mort est calculé</td><td><label><input <?php echo $pt_mcal1; ?> name="pt_mortcalcule1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $pt_mcal2; ?> name="pt_mortcalcule1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $pt_mcal3; ?> name="pt_mortcalcule1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[38]; ?>" name="commentaires17" type="text" size="50"  /></td></tr>
<tr><td>Le seuil de rentabilité est connu</td><td><label><input <?php echo $seuil_con1; ?> name="seuil_connu1" type="radio" value="1" /><br/></label></td><td><label><input name="seuil_connu1" <?php echo $seuil_con2; ?> type="radio" value="2" /><br/></label></td><td><label><input <?php echo $seuil_con3; ?> name="seuil_connu1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[39]; ?>" name="commentaires18" type="text" size="50"  /></td></tr>
<tr><td>Les investissements sont définis</td><td><label><input <?php echo $inv_def1; ?> name="investissement_def1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $inv_def2; ?> name="investissement_def1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $inv_def3; ?> name="investissement_def1" type="radio" value="3" /><br/></label></td><td><input  value="<?php echo $variable[40]; ?>" name="commentaires19" type="text" size="50"  /></td></tr>
<tr><td>Le coût de l'investissement est chiffré</td><td><label><input <?php echo $cout_chi1; ?> name="investissement_chiffre1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $cout_chi2; ?> name="investissement_chiffre1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $cout_chi3; ?> name="investissement_chiffre1" type="radio" value="3" /><br/></label></td><td><input name="commentaires20" value="<?php echo $variable[41]; ?>" type="text" size="50"  /></td></tr>
<tr><td>Montant estimé des apports</td><td><label><input <?php echo $mtt_app1; ?> name="montant_apports1" type="radio" value="1" /><br/></label></td><td><label><input name="montant_apports1" <?php echo $mtt_app2; ?> type="radio" value="2" /><br/></label></td><td><label><input  <?php echo $mtt_app3; ?> name="montant_apports1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[42]; ?>" name="commentaires21" type="text" size="50"  /></td></tr>
<tr><td>Le projet nécessite des financements</td><td><label><input <?php echo $proj_fin1; ?> name="proj_financements1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $proj_fin2; ?> name="proj_financements1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $proj_fin3; ?> name="proj_financements1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[43]; ?>" name="commentaires22"  type="text" size="50"  /></td></tr>
<tr><td>Montant estimé du besoin de financement</td><td><label><input  <?php echo $mtt_fin1; ?> name="montant_financements1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $mtt_fin2; ?> name="montant_financements1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $mtt_fin3; ?> name="montant_financements1" type="radio" value="3" /><br/></label></td><td><input name="commentaires23" value="<?php echo $variable[44]; ?>" type="text" size="50"  /></td></tr>

<tr><td colspan="5">IMPLANTATION</td></tr>

<tr><td>Le lieu d'implantation est choisi</td><td><label><input <?php echo $lieu_choi1; ?> name="lieu_choisi1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $lieu_choi2; ?> name="lieu_choisi1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $lieu_choi3; ?> name="lieu_choisi1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[45]; ?>" name="commentaires24" type="text" size="50"  /></td></tr>
<tr><td>Un local est nécessaire</td><td><label><input <?php echo $loc_nec1; ?> name="local_necessaire1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $loc_nec2; ?> name="local_necessaire1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $loc_nec3; ?> name="local_necessaire1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[46]; ?>" name="commentaires25" type="text" size="50"  /></td></tr>
<tr><td>Le local est trouvé</td><td><label><input <?php echo $loc_trou1; ?> name="local_trouve1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $loc_trou2; ?> name="local_trouve1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $loc_trou3; ?> name="local_trouve1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[47]; ?>" name="commentaires26" type="text" size="50"  /></td></tr>

<tr><td colspan="5">EQUIPE</td></tr>

<tr><td>Nombre total  d'emplois créés</td><td><label><input name="nb_emplois1" <?php echo $nb_cree1; ?> type="radio" value="1" /><br/></label></td><td><label><input <?php echo $nb_cree2; ?>  name="nb_emplois1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $nb_cree3; ?>  name="nb_emplois1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[48]; ?>" name="commentaires27" type="text" size="50"  /></td></tr>
<tr><td>dont nombre d'emplois salariés</td><td><label><input <?php echo $nb_sal1; ?> name="emplois_salaries1" type="radio" value="1" /><br/></label></td><td><label><input  <?php echo $nb_sal2; ?>name="emplois_salaries1" type="radio" value="2" /><br/></label></td><td><label><input  <?php echo $nb_sal3; ?> name="emplois_salaries1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[49]; ?>" size="50"  name="commentaires28" type="text" /></td></tr>

<tr><td colspan="5">JURIDIQUE ET SOCIAL</td></tr>

<tr><td>Le statut du créateur est défini</td><td><label><input name="statut_def" <?php echo $stat_cdef1; ?> type="radio" value="1" /><br/></label></td><td><label><input <?php echo $stat_cdef2; ?> name="statut_def" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $stat_cdef3; ?> name="statut_def" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[50]; ?>" name="commentaires29" type="text" size="50" /></td></tr>
<tr><td>Le statut juridique de l'entreprise est défini</td><td><label><input <?php echo $stat_jdef1; ?> name="statut_juridique1" type="radio" value="1" /><br/></label></td><td><label><input name="statut_juridique1" <?php echo $stat_jdef2; ?> type="radio" value="2" /><br/></label></td><td><label><input <?php echo $stat_jdef3; ?> name="statut_juridique1" type="radio" value="3" /><br/></label></td><td><input  size="50"  name="commentaires30" value="<?php echo $variable[51]; ?>" type="text" /></td></tr>
<tr><td>Les démarches de montage sont entamées</td><td><label><input <?php echo $dem_ent1; ?> name="demarches_entamees1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $dem_ent2; ?> name="demarches_entamees1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $dem_ent3; ?> name="demarches_entamees1" type="radio" value="3" /><br/></label></td><td><input size="50"  name="commentaires31" value="<?php echo $variable[52]; ?>" type="text" /></td></tr>

<tr><td colspan="5">FISCAL</td></tr>

<tr><td>Le régime fiscal est choisi</td><td><label><input <?php echo $regi_choi1; ?> name="regime_choisi1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $regi_choi2; ?> name="regime_choisi1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $regi_choi3; ?> name="regime_choisi1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[53]; ?>" name="commentaires32" type="text" size="50"  /></td></tr>

<tr><td colspan="5">BUSINESS PLAN</td></tr>

<tr><td>Le projet est rédigé</td><td><label><input <?php echo $proj_red1; ?> name="projet_redige1" type="radio" value="1" /><br/></label></td><td><label><input <?php echo $proj_red2; ?> name="projet_redige1" type="radio" value="2" /><br/></label></td><td><label><input <?php echo $proj_red3; ?> name="projet_redige1" type="radio" value="3" /><br/></label></td><td><input value="<?php echo $variable[54]; ?>" name="commentaires33" type="text"  size="50"  /></td></tr>
</table>
<br /><br />
<h3>7.	Plan d’accompagnement</h3>

<table>
<tr><td>Besoin - Prescription</td><td colspan="2">Prescription détaillée</td></tr>
<tr><td colspan="3">
<label><input name="adeq_projet" type="checkbox" <?php echo $adeq_proj; ?> value="adequation" />Adéquation parcours projet</label>
</td></tr>
<tr><td colspan="3">
<label><input name="analyse_ant" <?php echo $analyse_ant; ?> type="checkbox" value="analyse" />Analyse du parcours antérieur</label>
</td></tr>
<tr><td colspan="3">
<label><input name="ident_cial" <?php echo $ident_com; ?> type="checkbox" value="indentification1" />Identification des compétences commerciales</label>
</td></tr>
<tr><td colspan="3">
<label><input name="ident_techn" <?php echo $ident_tech; ?> type="checkbox" value="identification2" />Identification des compétences techniques</label>
</td></tr>
<tr><td colspan="3">
<label><input name="ident_gestion" <?php echo $ident_gest; ?> type="checkbox" value="identification3" />Identification des compétences en gestion</label>
</td></tr>
<tr><td colspan="3">
<label><input name="valid_projet" <?php echo $vali_proj; ?> type="checkbox" value="validation" />Validation parcours projet</label>
</td></tr>
<tr><td colspan="3">
<label><input name="etude_eco" <?php echo $etud_eco; ?> type="checkbox" value="etude1" />Etude économique</label>
</td></tr>
<tr><td colspan="3">
<label><input name="definition_services" <?php echo $def_sces; ?> type="checkbox" value="definition1" />Définition des produits et services</label>
</td></tr>
<tr><td colspan="3">
<label><input name="etude_marche" <?php echo $etud_mar; ?> type="checkbox" value="etude2" />Etude du marché</label>
</td></tr>
<tr><td colspan="3">
<label><input name="def_clientele" <?php echo $def_cli; ?> type="checkbox" value="definition2" />Définition qualitative et quantitative de la clientèle</label>
</td></tr>
<tr><td colspan="3">
<label><input name="etude_concurr" <?php echo $etud_conc; ?> type="checkbox" value="etude3" />Etude de la concurrence</label>
</td></tr>
<tr><td colspan="3">
<label><input name="etude_fournisseurs" <?php echo $etud_frs; ?> type="checkbox" value="etude4" />Etude des fournisseurs</label>
</td></tr>
<tr><td colspan="3">
<label><input name="elaboration" <?php echo $elab_mix; ?> type="checkbox" value="elaboration" />Elaboration du Marketing-Mix</label>
</td></tr>
<tr><td colspan="3">
<label><input name="moyens_materiels" <?php echo $moy_mhfin; ?> type="checkbox" value="moyen" />Moyens matériels, humains et financiers</label>
</td></tr>
<tr><td colspan="3">
<label><input name="valid_viabilite" <?php echo $vali_viab; ?> type="checkbox" value="validation" />Validation de la viabilité du projet</label>
</td></tr>
<tr><td colspan="3">
<label><input name="etude_financi" <?php echo $etud_fin; ?> type="checkbox" value="etude" />Etude financière</label>
</td></tr>
<tr><td colspan="3">
<label><input name="cal_prix" <?php echo $cal_pxvente; ?> type="checkbox" value="calcul1" />Calcul du prix de revient et fixation d’un prix de vente</label>
</td></tr>
<tr><td colspan="3">
<label><input name="calcul_ca" <?php echo $cal_ca; ?> type="checkbox" value="calcul2" />Calcul du chiffre d’affaire prévisionnel sur 3 ans</label> 
</td></tr>
<tr><td colspan="3">
<label><input name="def_charges" <?php echo $def_charg; ?> type="checkbox" value="definition" />Définition des charges variables et charges fixes</label>
</td></tr>
<tr><td colspan="3">
<label><input name="cal_rentabilite" <?php echo $cal_roul; ?> type="checkbox" value="calcul3" />Calcul du seuil de rentabilité sur 3 ans</label>
</td></tr>
<tr><td colspan="3">
<label><input name="cal_besoin" <?php echo $plan_mens; ?> type="checkbox" value="calcul4" />Calcul du besoin en fonds de roulement sur 3 ans</label>
</td></tr>
<tr><td colspan="3">
<label><input name="plan_mensuel" <?php echo $li_nece; ?> type="checkbox" value="plan1" />Plan de trésorerie mensuel sur 3 ans</label>
</td></tr>
<tr><td colspan="3">
<label><input name="liste_invetiss" <?php echo $elab_immo; ?> type="checkbox" value="liste" />Liste des investissements nécessaires</label>
</td></tr>
<tr><td colspan="3">
<label><input name="tab_amortissement" <?php echo $plan_fin; ?> type="checkbox" value="elaboration" />Elaboration d’un tableau d’amortissement des immobilisations</label>
</td></tr>
<tr><td colspan="3">
<label><input name="plan_financ" <?php echo $simu_empr; ?> type="checkbox" value="plan2" />Plan de financement sur 3 ans</label>
</td></tr>
<tr><td colspan="3">
<label><input name="simul_emprunts" <?php echo $simu_empr; ?> type="checkbox" value="simulation" />Simulation des éventuels emprunts</label>
</td></tr>
<tr><td colspan="3">
<label><input name="valid_faisabilite" <?php echo $vali_faisab; ?> type="checkbox" value="validation" />Validation de la faisabilité du projet</label>
</td></tr>
<tr><td><label><input name="etude_jurid" <?php echo $etu_juri; ?> type="checkbox" value="etude" />Etude juridique</label></td><td><label><input <?php echo $monta; ?> name="montage" type="checkbox" value="montage" />Montage</label></td><td><label><input <?php echo $crea; ?> name="creation" type="checkbox" value="creation" />Création</label></td></tr>
<tr><td colspan="3">
<label><input name="formes_juridiques" <?php echo $form_jur_exis; ?> type="checkbox" value="presentation1" />Présentation des principales formes juridiques existantes</label>
</td></tr>
<tr><td colspan="3">
<label><input name="choix_juridiques" <?php echo $choi_jur_ad; ?> type="checkbox" value="aide" />Aide au choix de la forme juridique la plus adaptée</label>
</td></tr>
<tr><td colspan="3">
<label><input name="verif_contrat" <?php echo $veri_contra; ?> type="checkbox" value="verification" />Vérification des différents contrats engageant le créateur</label>
</td></tr>
<tr><td colspan="3">
<label><input name="inpi" <?php echo $inpi; ?>  type="checkbox" value="information" />Information sur les démarches de protection de propriété intellectuelle (INPI …)</label>
</td></tr>
<tr><td colspan="3">
<label><input name="orient_createur" <?php echo $orient_crea; ?> type="checkbox" value="orientation" />Orientation du créateur vers les partenaires financiers</label>
</td></tr>
<tr><td colspan="3">
<label><input name="demandes_exo" <?php echo $dde_exo; ?> type="checkbox" value="demande1" />Demandes d’exonération</label>
</td></tr>
<tr><td colspan="3">
<label><input name="demandes_locaux" <?php echo $dde_loc; ?> type="checkbox" value="demande2" />Demandes de locaux d’activité</label>
</td></tr>
<tr><td colspan="3">
<label><input name="demarches" <?php echo $demarch_ie; ?> type="checkbox" value="presentation2" />Présentation des démarches d’immatriculation de l’entreprise</label>
</td></tr>
<tr><td colspan="3">
<label><input name="chronologies" <?php echo $chrono_dema; ?> type="checkbox" value="chronologie" />Chronologies des démarches</label>
</td></tr>
</table>
<br /><br />
<h3>8.	Planning prévisionnel</h3>
<br /><br />
<table>
<!--Titre tableau-->
<tr>
<td rowspan="2">ETAPES CLES</td><td colspan="9">RENDEZ-VOUS</td>
</tr>

<tr>
<td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
</tr>
<tr><td><label><input name="adeq_projet2" <?php echo $adeq_proj2; ?> type="checkbox" value="adequation" />Adéquation parcours projet</label></td><td><label><input <?php echo $ad_rdv2; ?> name="ad_rdv2" type="checkbox" value="rdv2" /><br/></label></td><td><label><input  <?php echo $ad_rdv3; ?> name="ad_rdv3" type="checkbox" value="rdv3" /><br/></label></td><td><label><input name="ad_rdv4"  <?php echo $ad_rdv4; ?> type="checkbox" value="rdv4" /><br/></label></td><td><label><input name="ad_rdv5"  <?php echo $ad_rdv5; ?> type="checkbox" value="rdv5" /><br/></label></td><td><label><input name="ad_rdv6"  <?php echo $ad_rdv6; ?> type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="ad_rdv7" type="checkbox" value="rdv7" <?php echo $ad_rdv7; ?> /><br/></label></td><td><label><input name="ad_rdv8"  <?php echo $ad_rdv8; ?> type="checkbox" value="rdv8" /><br/></label></td><td><label><input name="ad_rdv9"  <?php echo $ad_rdv9; ?> type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="ad_rdv10"  <?php echo $ad_rdv10; ?> type="checkbox" value="rdv10" /><br/></label></td></tr>

<tr><td><label><input  <?php echo $etud_eco2; ?>  name="etude_economique2" type="checkbox" value="etude" />Etude économique</label></td><td><label><input  <?php echo $eco_rdv2; ?> name="econom_rdv2" type="checkbox" value="rdv2" /><br/></label></td><td><label><input  <?php echo $eco_rdv3; ?> name="econom_rdv3" type="checkbox" value="rdv3" /><br/></label></td><td><label><input  <?php echo $eco_rdv4; ?> name="econom_rdv4" type="checkbox" value="rdv4" /><br/></label></td><td><label><input  <?php echo $eco_rdv5; ?> name="econom_rdv5" type="checkbox" value="rdv5" /><br/></label></td><td><label><input  <?php echo $eco_rdv6; ?> name="econom_rdv6" type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="econom_rdv7"  <?php echo $eco_rdv7; ?> type="checkbox" value="rdv7" /><br/></label></td><td><label><input name="econom_rdv8"  <?php echo $eco_rdv8; ?> type="checkbox" value="rdv8" /><br/></label></td><td><label><input name="econom_rdv9"  <?php echo $eco_rdv9; ?> type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="econom_rdv10" type="checkbox" value="rdv10"  <?php echo $eco_rdv10; ?> /><br/></label></td></tr>

<tr><td><label><input name="etude_financ2" type="checkbox" <?php echo $etud_fin2; ?>  value="etude" />Etude financière</label></td><td><label><input <?php echo $fin_rdv2; ?> name="financ_rdv2" type="checkbox" value="rdv2" /><br/></label></td><td><label><input name="financ_rdv3" <?php echo $fin_rdv3; ?> type="checkbox" value="rdv3" /><br/></label></td><td><label><input name="financ_rdv4" type="checkbox" value="rdv4" <?php echo $fin_rdv4; ?> /><br/></label></td><td><label><input name="financ_rdv5" <?php echo $fin_rdv5; ?> type="checkbox" value="rdv5" /><br/></label></td><td><label><input name="financ_rdv6" <?php echo $fin_rdv6; ?> type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="financ_rdv7" type="checkbox" value="rdv7" <?php echo $fin_rdv7; ?>  /><br/></label></td><td><label><input name="financ_rdv8" <?php echo $fin_rdv8; ?> type="checkbox" value="rdv8" /><br/></label></td><td><label><input name="financ_rdv9" <?php echo $fin_rdv9; ?> type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="financ_rdv10" type="checkbox" value="rdv10" <?php echo $fin_rdv10; ?> /><br/></label></td></tr>

<tr><td><label><input name="etude_jurid2" type="checkbox" value="etude" <?php echo $etu_juri2; ?>   />Etude juridique</label></td><td><label><input <?php echo $jur_rdv2; ?> name="juridique_rdv2" type="checkbox" value="rdv2" /><br/></label></td><td><label><input <?php echo $jur_rdv3; ?> name="juridique_rdv3" type="checkbox" value="rdv3" /><br/></label></td><td><label><input name="juridique_rdv4" <?php echo $jur_rdv4; ?> type="checkbox" value="rdv4" /><br/></label></td><td><label><input <?php echo $jur_rdv5; ?> name="juridique_rdv5" type="checkbox" value="rdv5" /><br/></label></td><td><label><input name="juridique_rdv6" <?php echo $jur_rdv6; ?> type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="juridique_rdv7" type="checkbox" value="rdv7" <?php echo $jur_rdv7; ?> /><br/></label></td><td><label><input <?php echo $jur_rdv8; ?>  name="juridique_rdv8" type="checkbox" value="rdv8" /><br/></label></td><td><label><input <?php echo $jur_rdv9; ?> name="juridique_rdv9" type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="juridique_rdv10" type="checkbox" value="rdv10" <?php echo $jur_rdv10; ?> /><br/></label></td></tr>

<tr><td><label><input name="montage" type="checkbox"  <?php echo $montage; ?> value="montage" />Montage</label></td><td><label><input <?php echo $mont_rdv2; ?> name="montage_rdv2" type="checkbox" value="rdv2" /><br/></label></td><td><label><input name="montage_rdv3" <?php echo $mont_rdv3; ?> type="checkbox" value="rdv3" /><br/></label></td><td><label><input name="montage_rdv4" type="checkbox" value="rdv4"  <?php echo $mont_rdv4; ?>/><br/></label></td><td><label><input <?php echo $mont_rdv5; ?> name="montage_rdv5" type="checkbox" value="rdv5" /><br/></label></td><td><label><input name="montage_rdv6" <?php echo $mont_rdv6; ?> type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="montage_rdv7" type="checkbox" value="rdv7" <?php echo $mont_rdv7; ?> /><br/></label></td><td><label><input name="montage_rdv8" <?php echo $mont_rdv8; ?> type="checkbox" value="rdv8" /><br/></label></td><td><label><input name="montage_rdv9" <?php echo $mont_rdv9; ?> type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="montage_rdv10" type="checkbox" value="rdv10" <?php echo $mont_rdv10; ?> /><br/></label></td></tr>

<tr><td><label><input <?php echo $creation; ?>  name="creation" type="checkbox" value="creation" />Création</label></td><td><label><input <?php echo $crea_rdv2; ?> name="creation_rdv2" type="checkbox"  value="rdv2" /><br/></label></td><td><label><input <?php echo $crea_rdv3; ?> name="creation_rdv3" type="checkbox" value="rdv3" /><br/></label></td><td><label><input name="creation_rdv4" <?php echo $crea_rdv4; ?> type="checkbox" value="rdv4" /><br/></label></td><td><label><input <?php echo $crea_rdv5; ?> name="creation_rdv5" type="checkbox" value="rdv5" /><br/></label></td><td><label><input name="creation_rdv6" <?php echo $crea_rdv6; ?> type="checkbox" value="rdv6" /><br/></label></td><td><label><input name="creation_rdv7" type="checkbox" value="rdv7" <?php echo $crea_rdv7; ?> /><br/></label></td><td><label><input <?php echo $crea_rdv8; ?> name="creation_rdv8" type="checkbox" value="rdv8" /><br/></label></td><td><label><input name="creation_rdv9" <?php echo $crea_rdv9; ?> type="checkbox" value="rdv9" /><br/></label></td><td><label><input name="creation_rdv10" type="checkbox" value="rdv10" <?php echo $crea_rdv10; ?> /><br/></label></td></tr>
</table>
<br /><br />
Commentaires :
<br /><br /><textarea style="border:1px solid #CCC; font-size:12px" cols="150" rows="5" name="commentaires_nacre"><?php echo $variable[94]; ?></textarea>

<br /><br />
<!--Date :
<input name="date" type="text" />
<br /><br />-->

 <center><input name="enregistrer" type="submit" value="Enregistrer" /> </center>

</form></div></div>
<script type="text/javascript" src="mootools.js"></script>
<script type="text/javascript" src="moocheck.js"></script>

</body>
</html>