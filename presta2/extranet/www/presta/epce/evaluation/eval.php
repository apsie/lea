<?php
session_start();

include("../inc/class.epce_evaluation.inc.php");
include("../inc/class.epce_impression.inc.php");
include("../inc/class.epce.inc.php");

$evaluation=new epce_evaluation();
$epce=new epce(date('y'));


if($_POST['exp_pro']!=NULL)
{
$evaluation->verif_beneficiaire_coherence_hp($_POST['id_beneficiaire'], str_replace('é','e',($_POST['exp_pro'])), str_replace('é','e',($_POST['exp_pro2'])), str_replace('é','e',($_POST['exp_pro3'])),str_replace('é','e',($_POST['exp_pro4'])), str_replace('é','e',($_POST['exp_pro5'])), str_replace('é','e',($_POST['exp_pro6'])), str_replace('é','e',($_POST['comp_pro'])), str_replace('é','e',($_POST['comp_pro2'])), str_replace('é','e',($_POST['comp_pro3'])), str_replace('é','e',($_POST['comp_pro4'])), str_replace('é','e',($_POST['comp_pro5'])), str_replace('é','e',($_POST['comp_pro6'])),str_replace('é','e',($_POST['form_savoir'])), str_replace('é','e',($_POST['form_savoir2'])), str_replace('é','e',($_POST['form_savoir3'])), str_replace('é','e',($_POST['form_savoir4'])),str_replace('é','e',($_POST['form_savoir5'])),str_replace('é','e',($_POST['form_savoir6'])), str_replace('é','e',($_POST['compt1'])), str_replace('é','e',($_POST['compt2'])), str_replace('é','e',($_POST['compt3'])), str_replace('é','e',($_POST['compt4'])), str_replace('é','e',($_POST['delai1'])), str_replace('é','e',($_POST['delai2'])), str_replace('é','e',($_POST['delai3'])), str_replace('é','e',($_POST['delai4'])), str_replace('é','e',($_POST['type1'])), str_replace('é','e',($_POST['type2'])), str_replace('é','e',($_POST['type3'])), str_replace('é','e',($_POST['type4'])), str_replace('é','e',($_POST['element_porteur'])),str_replace('é','e',($_POST['element_porteur2'])), str_replace('é','e',($_POST['element_porteur3'])), str_replace('é','e',($_POST['element_porteur4'])), str_replace('é','e',($_POST['points_vigilance'])), str_replace('é','e',($_POST['points_vigilance2'])),str_replace('é','e',($_POST['points_vigilance3'])), str_replace('é','e',($_POST['points_vigilance4'])));
}
if($_POST['an_be_cl_pt_fort']!=NULL)
{
$evaluation->verif_beneficiaire_aspect_commercial($_POST['id_beneficiaire'],str_replace('é','e',($_POST['an_be_cl_pt_fort'])),str_replace('é','e',($_POST['an_be_cl_pt_fort2'])),str_replace('é','e',($_POST['an_be_cl_pt_fort3'])),str_replace('é','e',($_POST['an_be_cl_pt_fort4'])), str_replace('é','e',($_POST['an_be_cl_pt_faible'])),str_replace('é','e',($_POST['an_be_cl_pt_faible2'])),str_replace('é','e',($_POST['an_be_cl_pt_faible3'])),str_replace('é','e',($_POST['an_be_cl_pt_faible4'])), str_replace('é','e',($_POST['an_con_pt_fort'])),str_replace('é','e',($_POST['an_con_pt_fort2'])),str_replace('é','e',($_POST['an_con_pt_fort3'])),str_replace('é','e',($_POST['an_con_pt_fort4'])), str_replace('é','e',($_POST['an_con_pt_faible'])),str_replace('é','e',($_POST['an_con_pt_faible2'])),str_replace('é','e',($_POST['an_con_pt_faible3'])),str_replace('é','e',($_POST['an_con_pt_faible4'])),  str_replace('é','e',($_POST['stra_pt_fort'])),str_replace('é','e',($_POST['stra_pt_fort2'])),str_replace('é','e',($_POST['stra_pt_fort3'])),str_replace('é','e',($_POST['stra_pt_fort4'])),  str_replace('é','e',($_POST['stra_pt_faible'])),str_replace('é','e',($_POST['stra_pt_faible2'])),str_replace('é','e',($_POST['stra_pt_faible3'])),str_replace('é','e',($_POST['stra_pt_faible4'])), str_replace('é','e',($_POST['autre_pt_fort'])),str_replace('é','e',($_POST['autre_pt_fort2'])),str_replace('é','e',($_POST['autre_pt_fort3'])),str_replace('é','e',($_POST['autre_pt_fort4'])),  str_replace('é','e',($_POST['autre_pt_faible'])), str_replace('é','e',($_POST['autre_pt_faible2'])),str_replace('é','e',($_POST['autre_pt_faible3'])),str_replace('é','e',($_POST['autre_pt_faible4'])), str_replace('é','e',($_POST['action_commercial1'])), str_replace('é','e',($_POST['action_commercial2'])), str_replace('é','e',($_POST['action_commercial3'])), str_replace('é','e',($_POST['action_commercial4'])), str_replace('é','e',($_POST['delai_commercial1'])), str_replace('é','e',($_POST['delai_commercial2'])), str_replace('é','e',($_POST['delai_commercial3'])), str_replace('é','e',($_POST['delai_commercial4'])), str_replace('é','e',($_POST['result_commercial1'])), str_replace('é','e',($_POST['result_commercial2'])), str_replace('é','e',($_POST['result_commercial3'])),  str_replace('é','e',($_POST['result_commercial4'])), str_replace('é','e',($_POST['diag_commercial'])));
}
if($_POST['an_be_cl_fi_pt_fort']!=NULL)
{
$evaluation->verif_beneficiaire_aspect_financier($_POST['id_beneficiaire'],str_replace('é','e',($_POST['an_be_cl_fi_pt_fort'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_fort2'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_fort3'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_fort4'])), str_replace('é','e',($_POST['an_be_cl_fi_pt_faible'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_faible2'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_faible3'])),str_replace('é','e',($_POST['an_be_cl_fi_pt_faible4'])), str_replace('é','e',($_POST['an_con_fi_pt_fort'])),str_replace('é','e',($_POST['an_con_fi_pt_fort2'])),str_replace('é','e',($_POST['an_con_fi_pt_fort3'])),str_replace('é','e',($_POST['an_con_fi_pt_fort4'])), str_replace('é','e',($_POST['an_con_fi_pt_faible'])),str_replace('é','e',($_POST['an_con_fi_pt_faible2'])),str_replace('é','e',($_POST['an_con_fi_pt_faible3'])),str_replace('é','e',($_POST['an_con_fi_pt_faible4'])), str_replace('é','e',($_POST['stra_fi_pt_fort'])),str_replace('é','e',($_POST['stra_fi_pt_fort2'])),str_replace('é','e',($_POST['stra_fi_pt_fort3'])),str_replace('é','e',($_POST['stra_fi_pt_fort4'])), str_replace('é','e',($_POST['stra_fi_pt_faible'])),str_replace('é','e',($_POST['stra_fi_pt_faible2'])),str_replace('é','e',($_POST['stra_fi_pt_faible3'])),str_replace('é','e',($_POST['stra_fi_pt_faible4'])), str_replace('é','e',($_POST['plan_fi_pt_fort'])),  str_replace('é','e',($_POST['plan_fi_pt_fort2'])), str_replace('é','e',($_POST['plan_fi_pt_fort3'])), str_replace('é','e',($_POST['plan_fi_pt_fort4'])),str_replace('é','e',($_POST['plan_fi_pt_faible'])),str_replace('é','e',($_POST['plan_fi_pt_faible2'])),str_replace('é','e',($_POST['plan_fi_pt_faible3'])),str_replace('é','e',($_POST['plan_fi_pt_faible4'])), str_replace('é','e',($_POST['autre_fi_pt_fort'])),str_replace('é','e',($_POST['autre_fi_pt_fort2'])),str_replace('é','e',($_POST['autre_fi_pt_fort3'])),str_replace('é','e',($_POST['autre_fi_pt_fort4'])), str_replace('é','e',($_POST['autre_fi_pt_faible'])),str_replace('é','e',($_POST['autre_fi_pt_faible2'])),str_replace('é','e',($_POST['autre_fi_pt_faible3'])),str_replace('é','e',($_POST['autre_fi_pt_faible4'])), str_replace('é','e',($_POST['action1_fi'])), str_replace('é','e',($_POST['action2_fi'])), str_replace('é','e',($_POST['action3_fi'])), str_replace('é','e',($_POST['action4_fi'])), str_replace('é','e',($_POST['delai1_fi'])), str_replace('é','e',($_POST['delai2_fi'])), str_replace('é','e',($_POST['delai3_fi'])), str_replace('é','e',($_POST['delai4_fi'])), str_replace('é','e',($_POST['result1_fi'])), str_replace('é','e',($_POST['result2_fi'])), str_replace('é','e',($_POST['result3_fi'])), str_replace('é','e',($_POST['result4_fi'])),  str_replace('é','e',($_POST['diag_fi'])));
}

if($_POST['pt_fort']!=NULL)
{
$evaluation->verif_beneficiaire_forme_juridique($_POST['id_beneficiaire'], str_replace('é','e',($_POST['pt_fort'])), str_replace('é','e',($_POST['pt_fort2'])), str_replace('é','e',($_POST['pt_fort3'])), str_replace('é','e',($_POST['pt_fort4'])), str_replace('é','e',($_POST['pt_faible'])), str_replace('é','e',($_POST['pt_faible2'])), str_replace('é','e',($_POST['pt_faible3'])),str_replace('é','e',($_POST['pt_faible4'])),str_replace('é','e',($_POST['ac1'])),str_replace('é','e',($_POST['ac2'])),str_replace('é','e',($_POST['ac3'])),str_replace('é','e',($_POST['ac4'])),str_replace('é','e',($_POST['delai1_ju'])),str_replace('é','e',($_POST['delai2_ju'])),str_replace('é','e',($_POST['delai3_ju'])),str_replace('é','e',($_POST['delai4_ju'])),str_replace('é','e',($_POST['result1_ju'])),str_replace('é','e',($_POST['result2_ju'])),str_replace('é','e',($_POST['result3_ju'])),str_replace('é','e',($_POST['result4_ju'])),str_replace('é','e',($_POST['diag_ju'])));
}
if(isset($_POST['sign']) and $_POST['sign']!=NULL)
{
$sign=$_POST['sign'];



}
else
{
$sign=NULL;
}

if($_POST['descrip_proj']!=NULL)
{
$retour = $evaluation->verif_beneficiaire_plan_eval($_POST['id_beneficiaire'], str_replace('é','e',($_POST['descrip_proj'])), str_replace('é','e',($_POST['etat_proj'])), str_replace('é','e',($_POST['pt_a_evaluer'])), str_replace('é','e',($_POST['pt_a_evaluer2'])),str_replace('é','e',($_POST['pt_a_evaluer3'])),str_replace('é','e',($_POST['attente_benef'])),str_replace('é','e',($_POST['attente_benef2'])),str_replace('é','e',($_POST['comment_ref'])), str_replace('é','e',($_POST['pt_date1'])), str_replace('é','e',($_POST['pt_date2'])) ,  str_replace('é','e',($_POST['diagnostic1_date1'])),  str_replace('é','e',($_POST['diagnostic1_date2'])),  str_replace('é','e',($_POST['diagnostic2_date1'])),  str_replace('é','e',($_POST['diagnostic2_date2'])),  str_replace('é','e',($_POST['pt_plan_date1'])),  str_replace('é','e',($_POST['pt_plan_date2'])), $sign,$_POST['id_presta']);
}

header('Location: ../presentation/panel.php?valid=1&annee=10&category='.$epce->cat_id_beneficiaire.'&choix='.$_POST['id_beneficiaire'].'&retour_eval='.$retour.'&display_eval=block#eval');




?>