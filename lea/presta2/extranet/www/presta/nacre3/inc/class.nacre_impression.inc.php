<?php
class nacre_impression
{
	public $db;	
	public $cat_id_prescripteur ;
	

public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	


/*public $db_host ="localhost";
	public $db_name ="lea";
	public $db_user ="root";
	public $db_pass ="Tim.01Mysqlv1";*/

	
	function __construct()
	{
		
		
// on se connecte à MySQL
$this->db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$this->db); 
	}
	
	
		public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}

function imprimer ($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$besoin_fort,$besoin_fort2,$besoin_fort3,$besoin_fort4,$besoin_faible,$besoin_faible2,$besoin_faible3,$besoin_faible4,$concurrence_fort,$concurrence_faible,$strategie_fort,$strategie_faible,$autre_fort,$autre_faible,$action1,$action2,$action3,$action4,$delai1,$delai2,$delai3,$delai4,$resultats1,$resultats2,$resultats3,$resultats4,$diagnostic1,$pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3,$comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5,$form_savoir6, $compet_acq,$compet_acq2,$compet_acq3,$compet_acq4,$delai_prior,$delai_prior2,$delai_prior3,$delai_prior4,$type_form,$type_form2,$type_form3,$type_form4,$elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$contact_value,$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$num_com,$date_debut,$date_fin,$avis1,$avis2,$commentaire1,$commentaire2,$r_emploi,$com_ref,$com_ben,$concurrence_fort2,$concurrence_fort3,$concurrence_fort4,$concurrence_faible2,$concurrence_faible3,$concurrence_faible4,$strategie_fort2,$strategie_fort3,$strategie_fort4,$strategie_faible2,$strategie_faible3,$strategie_faible4,$autre_fort2,$autre_fort3,$autre_fort4,$autre_faible2,$autre_faible3,$autre_faible4,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4)
{


   //Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =BILAN_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');



//Ouvre le fichier modèle
$filename='./doc/nacre-bilan.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//*****egw_contact*****
$output = str_replace('<<NAME>>',$nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>',$prenom_beneficiaire, $output);
$output = str_replace('<<ADRESSE>>',$adresse_bene, $output);
$output = str_replace('<<CP>>',$cp_bene, $output);
$output = str_replace('<<VILLE>>',$ville_bene, $output);
$output = str_replace('<<TEL>>',$tel_bene, $output);
$output = str_replace('<<MEL>>',$mel_bene, $output);
$output = str_replace('<<NUMIDENT>>',$this->identifiant_pole, $output);

//*****strategie_commerciale*****
$output = str_replace('<<BESOINFORT>>',$besoin_fort, $output);
$output = str_replace('<<BEA>>',$besoin_fort2, $output);
$output = str_replace('<<BEB>>',$besoin_fort3, $output);
$output = str_replace('<<BEC>>',$besoin_fort4, $output);
$output = str_replace('<<BESOINFAIBLE>>',$besoin_faible, $output);
$output = str_replace('<<BESA>>',$besoin_faible2, $output);
$output = str_replace('<<BESB>>',$besoin_faible3, $output);
$output = str_replace('<<BESC>>',$besoin_faible4, $output);
$output = str_replace('<<CONCURRENCEFORT>>',$concurrence_fort, $output);
$output = str_replace('<<CONCURRENCEFAIBLE>>',$concurrence_faible, $output);
$output = str_replace('<<STRATEGIEFORT>>',$strategie_fort, $output);
$output = str_replace('<<STRATEGIEFAIBLE>>',$strategie_faible, $output);
$output = str_replace('<<AUTREFORT>>',$autre_fort, $output);
$output = str_replace('<<AUTREFAIBLE>>',$autre_faible, $output);

$output = str_replace('<<BESD>>',$concurrence_fort2, $output);
$output = str_replace('<<BESE>>',$concurrence_faible2, $output);
$output = str_replace('<<BESF>>',$strategie_fort2, $output);
$output = str_replace('<<BESG>>',$strategie_faible2, $output);
$output = str_replace('<<BESH>>',$autre_fort2, $output);
$output = str_replace('<<BESI>>',$autre_faible2, $output);

$output = str_replace('<<BESJ>>',$concurrence_fort3, $output);
$output = str_replace('<<BESK>>',$concurrence_faible3, $output);
$output = str_replace('<<BESL>>',$strategie_fort3, $output);
$output = str_replace('<<BESM>>',$strategie_faible3, $output);
$output = str_replace('<<BESN>>',$autre_fort3, $output);
$output = str_replace('<<BESO>>',$autre_faible3, $output);

$output = str_replace('<<BESP>>',$concurrence_fort4, $output);
$output = str_replace('<<BESQ>>',$concurrence_faible4, $output);
$output = str_replace('<<BESR>>',$strategie_fort4, $output);
$output = str_replace('<<BESS>>',$strategie_faible4, $output);
$output = str_replace('<<BEST>>',$autre_fort4, $output);
$output = str_replace('<<BESU>>',$autre_faible4, $output);

$output = str_replace('<<ACTION1>>',$action1, $output);
$output = str_replace('<<ACTION2>>',$action2, $output);
$output = str_replace('<<ACTION3>>',$action3, $output);
$output = str_replace('<<ACTION4>>',$action4, $output);
$output = str_replace('<<DELAI1>>',$delai1, $output);
$output = str_replace('<<DELAI2>>',$delai2, $output);
$output = str_replace('<<DELAI3>>',$delai3, $output);
$output = str_replace('<<DELAI4>>',$delai4, $output);
$output = str_replace('<<RESULTAT1>>',$resultats1, $output);
$output = str_replace('<<RESULTAT2>>',$resultats2, $output);
$output = str_replace('<<RESULTAT3>>',$resultats3, $output);
$output = str_replace('<<RESULTAT4>>',$resultats4, $output);
$output = str_replace('<<DIAGNOSTIC1>>',$diagnostic1, $output);

//*****forme_juridique*****
$output = str_replace('<<PTFORT>>',$pt_fort, $output);
$output = str_replace('<<PTFAIBLE41>>',$pt_fort2, $output);
$output = str_replace('<<PTFAIBLE42>>',$pt_fort3, $output);
$output = str_replace('<<PTFAIBLE43>>',$pt_fort4, $output);
$output = str_replace('<<PTFAIBLE>>',$pt_faible, $output);
$output = str_replace('<<PTFAIBLE44>>',$pt_faible2, $output);
$output = str_replace('<<PTFAIBLE45>>',$pt_faible3, $output);
$output = str_replace('<<PTFAIBLE4>>',$pt_faible4, $output);
$output = str_replace('<<ACTIONMEN1>>',$action_men1, $output);
$output = str_replace('<<ACTIONMEN2>>',$action_men2, $output);
$output = str_replace('<<ACTIONMEN3>>',$action_men3, $output);
$output = str_replace('<<ACTIONMEN4>>',$action_men4, $output);
$output = str_replace('<<DELAIREAL1>>',$delai_real1, $output);
$output = str_replace('<<DELAIREAL2>>',$delai_real2, $output);
$output = str_replace('<<DELAIREAL3>>',$delai_real3, $output);
$output = str_replace('<<DELAIREAL4>>',$delai_real4, $output);
$output = str_replace('<<RESULTATATT1>>',$resultat_att1, $output);
$output = str_replace('<<RESULTATATT2>>',$resultat_att2, $output);
$output = str_replace('<<RESULTATATT3>>',$resultat_att3, $output);
$output = str_replace('<<RESULTATATT4>>',$resultat_att4, $output);
$output = str_replace('<<DIAGNOSTIC2>>',$diagnostic2, $output);

//Coherence_hp


$output = str_replace('<<EXP_PRO>>',$exp_pro, $output);
$output = str_replace('<<PDSDS>>',$exp_pro2, $output);
$output = str_replace('<<PDSDS1>>',$exp_pro3, $output);
$output = str_replace('<<PDSDS4>>',$exp_pro4, $output);
$output = str_replace('<<PDSDS5>>',$exp_pro5, $output);
$output = str_replace('<<PDSDS6>>',$exp_pro6, $output);
$output = str_replace('<<COMP_PRO>>',$comp_pro, $output);
$output = str_replace('<<GJGKDJG>>',$comp_pro2, $output);
$output = str_replace('<<GJGKDJG3>>',$comp_pro3, $output);
$output = str_replace('<<GJGKDJG4>>',$comp_pro4, $output);
$output = str_replace('<<GJGKDJG5>>',$comp_pro5, $output);
$output = str_replace('<<GJGKDJG6>>',$comp_pro6, $output);
$output = str_replace('<<FORM_SAVOIR>>',$form_savoir, $output);
$output = str_replace('<<CXVXC>>',$form_savoir2, $output);
$output = str_replace('<<CXVXC3>>',$form_savoir3, $output);
$output = str_replace('<<CXVXC4>>',$form_savoir4, $output);
$output = str_replace('<<CXVXC5>>',$form_savoir5, $output);
$output = str_replace('<<CXVXC6>>',$form_savoir6, $output);
$output = str_replace('<<COMPET_ACQ>>',$compet_acq, $output);
$output = str_replace('<<COMPET_ACQ2>>',$compet_acq2, $output);
$output = str_replace('<<COMPET_ACQ3>>',$compet_acq3, $output);
$output = str_replace('<<COMPET_ACQ4>>',$compet_acq4, $output);
$output = str_replace('<<DELAIPRIOR1>>',$delai_prior, $output);
$output = str_replace('<<DELAI_PRIOR2>>',$delai_prior2, $output);
$output = str_replace('<<DELAI_PRIOR3>>',$delai_prior3, $output);
$output = str_replace('<<DELAI_PRIOR4>>',$delai_prior4, $output);
$output = str_replace('<<TYPE_FORM>>',$type_form, $output);
$output = str_replace('<<TYPE_FORM2>>',$type_form2, $output);
$output = str_replace('<<TYPE_FORM3>>',$type_form3, $output);
$output = str_replace('<<TYPE_FORM4>>',$type_form4, $output);
$output = str_replace('<<ELEM_PORT>>',$elem_port, $output);
$output = str_replace('<<TUTRR>>',$elem_port2, $output);
$output = str_replace('<<TUTRR3>>',$elem_port3, $output);
$output = str_replace('<<TUTRR4>>',$elem_port4, $output);
$output = str_replace('<<PT_VIGILANCE>>',$pt_vigilance, $output);
$output = str_replace('<<WSERE>>',$pt_vigilance2, $output);
$output = str_replace('<<WSERE3>>',$pt_vigilance3, $output);
$output = str_replace('<<WSERE4>>',$pt_vigilance4, $output);


//Aspect financier----------
$output = str_replace('<<APPORT_PT_FORTS>>',$apport_pt_forts, $output);
$output = str_replace('<<BBA>>',$apport_pt_forts2, $output);
$output = str_replace('<<BBB>>',$apport_pt_forts3, $output);
$output = str_replace('<<BBC>>',$apport_pt_forts4, $output);

$output = str_replace('<<APPORTT_PT_FAIBLE>>',$apportt_pt_faible, $output);
$output = str_replace('<<BBD>>',$apportt_pt_faible2, $output);
$output = str_replace('<<BBE>>',$apportt_pt_faible3, $output);
$output = str_replace('<<BBF>>',$apportt_pt_faible4, $output);

$output = str_replace('<<CALCUL_PT_FORT>>',$calcul_pt_fort, $output);
$output = str_replace('<<BBG>>',$calcul_pt_fort2, $output);
$output = str_replace('<<BBH>>',$calcul_pt_fort3, $output);
$output = str_replace('<<BBI>>',$calcul_pt_fort4, $output);

$output = str_replace('<<CALCUL_PT_FAIBLE>>',$calcul_pt_faible, $output);
$output = str_replace('<<BBJ>>',$calcul_pt_faible2, $output);
$output = str_replace('<<BBK>>',$calcul_pt_faible3, $output);
$output = str_replace('<<BBL>>',$calcul_pt_faible4, $output);

$output = str_replace('<<PLAN_INITIAL_PT_FORT>>',$plan_initial_pt_fort, $output);
$output = str_replace('<<BBM>>',$plan_initial_pt_fort2, $output);
$output = str_replace('<<BBN>>',$plan_initial_pt_fort3, $output);
$output = str_replace('<<BBO>>',$plan_initial_pt_fort4, $output);

$output = str_replace('<<PLAN_INITIAL_PT_FAIBLE>>',$plan_initial_pt_faible, $output);
$output = str_replace('<<BBP>>',$plan_initial_pt_faible2, $output);
$output = str_replace('<<BBQ>>',$plan_initial_pt_faible3, $output);
$output = str_replace('<<BBR>>',$plan_initial_pt_faible4, $output);

$output = str_replace('<<PLAN_TROIS_ANS_PT_FORT>>',$plan_trois_ans_pt_fort, $output);
$output = str_replace('<<BBS>>',$plan_trois_ans_pt_fort2, $output);
$output = str_replace('<<BBT>>',$plan_trois_ans_pt_fort3, $output);
$output = str_replace('<<BBU>>',$plan_trois_ans_pt_fort4, $output);

$output = str_replace('<<PLAN_TROIS_ANS_PT_FAIBLE>>',$plan_trois_ans_pt_faible, $output);
$output = str_replace('<<BBV>>',$plan_trois_ans_pt_faible2, $output);
$output = str_replace('<<BBW>>',$plan_trois_ans_pt_faible3, $output);
$output = str_replace('<<BBX>>',$plan_trois_ans_pt_faible4, $output);

$output = str_replace('<<AUTRE_PT_FORT>>',$autre_pt_fort, $output);
$output = str_replace('<<BBY>>',$autre_pt_fort2, $output);
$output = str_replace('<<BBZ>>',$autre_pt_fort3, $output);
$output = str_replace('<<BCA>>',$autre_pt_fort4, $output);

$output = str_replace('<<AUTRE_PT_FAIBLE>>',$autre_pt_faible, $output);
$output = str_replace('<<BCB>>',$autre_pt_faible2, $output);
$output = str_replace('<<BCC>>',$autre_pt_faible3, $output);
$output = str_replace('<<BCD>>',$autre_pt_faible4, $output);

$output = str_replace('<<ACTION_A_MENER1>>',$action_a_mener1, $output);
$output = str_replace('<<ACTION_A_MENER2>>',$action_a_mener2, $output);
$output = str_replace('<<ACTION_A_MENER3>>',$action_a_mener3, $output);
$output = str_replace('<<ACTION_A_MENER4>>',$action_a_mener4, $output);
$output = str_replace('<<DELAI_DE_REALISATION1>>',$delai_de_realisation1, $output);
$output = str_replace('<<DELAI_DE_REALISATION2>>',$delai_de_realisation2, $output);
$output = str_replace('<<DELAI_DE_REALISATION3>>',$delai_de_realisation3, $output);
$output = str_replace('<<DELAI_DE_REALISATION4>>',$delai_de_realisation4, $output);
$output = str_replace('<<RESULTAT_ATTENDUS1>>',$resultat_attendus1, $output);
$output = str_replace('<<RESULTAT_ATTENDUS2>>',$resultat_attendus2, $output);
$output = str_replace('<<RESULTAT_ATTENDUS3>>',$resultat_attendus3, $output);
$output = str_replace('<<RESULTAT_ATTENDUS4>>',$resultat_attendus4, $output);
$output = str_replace('<<DIAGNOSTIC>>',$diagnostic, $output);

//SYNTHESE
$output = str_replace('$pfort',$elem_port, $output);
$output = str_replace('<<<Compe>>>',$elem_port2, $output);
$output = str_replace('<<<Compefort>>>',$elem_port3, $output);
$output = str_replace('<<<Recompe>>>',$elem_port4, $output);
$output = str_replace('$pfaib',$pt_vigilance, $output);
$output = str_replace('<<<Compefaible>>>',$pt_vigilance2, $output);
$output = str_replace('<<<Competrois>>>',$pt_vigilance3, $output);
$output = str_replace('<<<Recompefaible>>>',$pt_vigilance4, $output);
$output = str_replace('$pfort_e',$besoin_fort, $output);
$output = str_replace('$pfort_ea',$concurrence_fort, $output);
$output = str_replace('$pfort_eb',$strategie_fort, $output);
$output = str_replace('$pfort_ec',$autre_fort, $output);
$output = str_replace('$pfaib_e',$besoin_faible, $output);
$output = str_replace('$pfaib_ea',$concurrence_faible, $output);
$output = str_replace('$pfaib_eb',$strategie_faible, $output);
$output = str_replace('$pfaib_ec',$autre_faible, $output);

//
$output = str_replace('<<<Autrepoints>>>','', $output);
$output = str_replace('<<<Autrepointsfaible>>>','', $output);

//





$output = str_replace('<<CO>>',$commentaire1, $output);
$output = str_replace('<<COE>>',$commentaire2, $output);




$output = str_replace('<<SOLUTION>>',$r_emploi, $output);
$output = str_replace('<<OBS>>',$com_ref, $output);
$output = str_replace('<<BENEFIC>>',$com_ben, $output);

//Envoie le document produit au navigateur
echo $output;


}




///emargement
function imprimer_emargement ($nom_beneficiaire, $prenom_beneficiaire, $nom_presta, $mar_n, $cde_n, $presta, $name_1, $name2, $id_anpe, $date_deb, $date_fin, $eval_eco, $eval_fin)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=EPCE_EMARGEMENT_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');

//Ouvre le fichier modèle
$filename='../doc/emargement.rtf';
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//****EMARGEMENT******
$nom_presta='APSIE';
$mar_n='N0002';
$presta='EPC93';
$output = str_replace('<<NOM_PRESTA>>', $nom_presta, $output);
$output = str_replace('<<MAR_N>>', $mar_n, $output);
$output = str_replace('<<CDE_N>>', $this->lalettre, $output);
$output = str_replace('<<PRESTA>>', $presta, $output);
$output = str_replace('<<NAME1>>', $nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>', $prenom_beneficiaire, $output);
$output = str_replace('<<ID_ANPE>>', $this->identifiant_pole, $output);
$output = str_replace('<<DATE_DEB>>', $this->date_debut_epce, $output);
$output = str_replace('<<DATE_FIN>>', $this->date_fin_epce, $output);
$output = str_replace('<<PLAN_EVAL>>', $date_deb, $output);
$output = str_replace('<<ADE_PERS_PROJ>>', $date_deb, $output);
$output = str_replace('<<EVAL_ECO>>', $eval_eco, $output);
$output = str_replace('<<EVAL_FIN>>', $eval_fin, $output);
$output = str_replace('<<EVAL_JUR>>', $date_fin, $output);
$output = str_replace('<<BIL_EVAL>>',$date_fin, $output);

//Envoie le document produit au navigateur
echo $output;
}

function imprimer_totalite($id_beneficiaire,$id_presta)

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
			$tel_bene=$row['tel_domicile_1'];
			$tel_perso_bene=$row['tel_perso'];
			$mel_bene=$row['email_perso'];
			
		}
	$requete2='SELECT * FROM  egw_nacre_aspect_commercial where id_presta='.$id_presta.'';
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		while($row = mysql_fetch_array($resultat2))
		{
			$besoin_fort=$row['analyse_besoin_client_pt_forts'];
			$besoin_fort2=$row['analyse_besoin_client_pt_forts2'];
			$besoin_fort3=$row['analyse_besoin_client_pt_forts3'];
			$besoin_fort4=$row['analyse_besoin_client_pt_forts4'];
			$besoin_faible=$row['analyse_besoin_client_pt_faible'];
			$besoin_faible2=$row['analyse_besoin_client_pt_faible2'];
			$besoin_faible3=$row['analyse_besoin_client_pt_faible3'];
			$besoin_faible4=$row['analyse_besoin_client_pt_faible4'];
			$concurrence_fort=$row['analyse_concurrence_pt_fort'];
			$concurrence_fort2=$row['analyse_concurrence_pt_fort2'];
			$concurrence_fort3=$row['analyse_concurrence_pt_fort3'];
			$concurrence_fort4=$row['analyse_concurrence_pt_fort4'];
			
			$concurrence_faible=$row['analyse_concurrence_pt_faible'];
			$concurrence_faible2=$row['analyse_concurrence_pt_faible2'];
			$concurrence_faible3=$row['analyse_concurrence_pt_faible3'];
			$concurrence_faible4=$row['analyse_concurrence_pt_faible4'];
			
			$strategie_fort=$row['strategie_commerciale_envisagee_pt_fort'];
			$strategie_fort2=$row['strategie_commerciale_envisagee_pt_fort2'];
			$strategie_fort3=$row['strategie_commerciale_envisagee_pt_fort3'];
			$strategie_fort4=$row['strategie_commerciale_envisagee_pt_fort4'];
			
			$strategie_faible=$row['strategie_commerciale_envisagee_pt_faible'];
			$strategie_faible2=$row['strategie_commerciale_envisagee_pt_faible2'];
			$strategie_faible3=$row['strategie_commerciale_envisagee_pt_faible3'];
			$strategie_faible4=$row['strategie_commerciale_envisagee_pt_faible4'];
			
			$autre_fort=$row['autre_pt_fort'];
			$autre_fort2=$row['autre_pt_fort2'];
			$autre_fort3=$row['autre_pt_fort3'];
			$autre_fort4=$row['autre_pt_fort4'];
			
			$autre_faible=$row['autre_pt_faible'];
			$autre_faible2=$row['autre_pt_faible2'];
			$autre_faible3=$row['autre_pt_faible3'];
			$autre_faible4=$row['autre_pt_faible4'];
			
			$action1=$row['action_a_mener1'];
			$action2=$row['action_a_mener2'];
			$action3=$row['action_a_mener3'];
			$action4=$row['action_a_mener4'];
			$delai1=$row['delai_de_realisation1'];
			$delai2=$row['delai_de_realisation2'];
			$delai3=$row['delai_de_realisation3'];
			$delai4=$row['delai_de_realisation4'];
			$resultats1=$row['resultat_attendus1'];
			$resultats2=$row['resultat_attendus2'];
			$resultats3=$row['resultat_attendus3'];
			$resultats4=$row['resultat_attendus4'];
			$diagnostic1=$row['diagnostic'];
		}
	$requete3='SELECT * FROM  egw_nacre_forme_juridique where id_presta='.$id_presta.'';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$pt_fort=$row['pt_fort'];
			$pt_fort2=$row['pt_fort2'];
			$pt_fort3=$row['pt_fort3'];
			$pt_fort4=$row['pt_fort4'];
			$pt_faible=$row['pt_faible'];
			$pt_faible2=$row['pt_faible2'];
			$pt_faible3=$row['pt_faible3'];
			$pt_faible4=$row['pt_faible4'];
			$action_men1=$row['action_mener1'];
			$action_men2=$row['action_mener2'];
			$action_men3=$row['action_mener3'];
			$action_men4=$row['action_mener4'];
			$delai_real1=$row['delai_realisation1'];
			$delai_real2=$row['delai_realisation2'];
			$delai_real3=$row['delai_realisation3'];
			$delai_real4=$row['delai_realisation4'];
			$resultat_att1=$row['resultat_attendus1'];
			$resultat_att2=$row['resultat_attendus2'];
			$resultat_att3=$row['resultat_attendus3'];
			$resultat_att4=$row['resultat_attendus4'];
			$diagnostic2=$row['diagnostic'];						
		}
		
	$requete4='select * from egw_nacre_coherence_hp where id_presta='.$id_presta.'';
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$exp_pro=$row['exp_pro'];
			$exp_pro2=$row['exp_pro2'];
			$exp_pro3=$row['exp_pro3'];
			$exp_pro4=$row['exp_pro4'];
			$exp_pro5=$row['exp_pro5'];
			$exp_pro6=$row['exp_pro6'];			
			$comp_pro=$row['comp_pro'];
			$comp_pro2=$row['comp_pro2'];
			$comp_pro3=$row['comp_pro3'];
			$comp_pro4=$row['comp_pro4'];
			$comp_pro5=$row['comp_pro5'];
			$comp_pro6=$row['comp_pro6'];
			$form_savoir=$row['form_savoir'];
			$form_savoir2=$row['form_savoir2'];
			$form_savoir3=$row['form_savoir3'];
			$form_savoir4=$row['form_savoir4'];
			$form_savoir5=$row['form_savoir5'];
			$form_savoir6=$row['form_savoir6'];
			$compet_acq=$row['compet_acq'];
			$compet_acq2=$row['compet_acq2'];
			$compet_acq3=$row['compet_acq3'];
			$compet_acq4=$row['compet_acq4'];
			$delai_prior = $row['delai_prior'];
			$delai_prior2 = $row['delai_prior2'];
			$delai_prior3 = $row['delai_prior3'];
			$delai_prior4 = $row['delai_prior4'];
			$type_form=$row['type_form'];
			$type_form2=$row['type_form2'];
			$type_form3=$row['type_form3'];
			$type_form4=$row['type_form4'];
			$elem_port=$row['elem_port'];
			$elem_port2=$row['elem_port2'];
			$elem_port3=$row['elem_port3'];
			$elem_port4=$row['elem_port4'];			
			$pt_vigilance=$row['pt_vigilance'];	
			$pt_vigilance2=$row['pt_vigilance2'];
			$pt_vigilance3=$row['pt_vigilance3'];
			$pt_vigilance4=$row['pt_vigilance4'];
			
		}
		
		//-------------
		$requete5='select * from egw_nacre_aspect_financier where id_presta='.id_presta.'';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
		$apport_pt_forts=$row['apport_pt_forts'];
			$apport_pt_forts2=$row['apport_pt_forts2'];
			$apport_pt_forts3=$row['apport_pt_forts3'];
			$apport_pt_forts4=$row['apport_pt_forts4'];
			
			$apportt_pt_faible=$row['apportt_pt_faible'];
			$apportt_pt_faible2=$row['apportt_pt_faible2'];
			$apportt_pt_faible3=$row['apportt_pt_faible3'];
			$apportt_pt_faible4=$row['apportt_pt_faible4'];
			
			$calcul_pt_fort=$row['calcul_pt_fort'];
			$calcul_pt_fort2=$row['calcul_pt_fort2'];
			$calcul_pt_fort3=$row['calcul_pt_fort3'];
			$calcul_pt_fort4=$row['calcul_pt_fort4'];
			
			$calcul_pt_faible=$row['calcul_pt_faible'];
			$calcul_pt_faible2=$row['calcul_pt_faible2'];
			$calcul_pt_faible3=$row['calcul_pt_faible3'];
			$calcul_pt_faible4=$row['calcul_pt_faible4'];
			
			$plan_initial_pt_fort=$row['plan_initial_pt_fort'];
			$plan_initial_pt_fort2=$row['plan_initial_pt_fort2'];
			$plan_initial_pt_fort3=$row['plan_initial_pt_fort3'];
			$plan_initial_pt_fort4=$row['plan_initial_pt_fort4'];
			
			$plan_initial_pt_faible=$row['plan_initial_pt_faible'];
			$plan_initial_pt_faible2=$row['plan_initial_pt_faible2'];
			$plan_initial_pt_faible3=$row['plan_initial_pt_faible3'];
			$plan_initial_pt_faible4=$row['plan_initial_pt_faible4'];
			
			$plan_trois_ans_pt_fort=$row['plan_trois_ans_pt_fort'];
			$plan_trois_ans_pt_fort2=$row['plan_trois_ans_pt_fort2'];
			$plan_trois_ans_pt_fort3=$row['plan_trois_ans_pt_fort3'];
			$plan_trois_ans_pt_fort4=$row['plan_trois_ans_pt_fort4'];
			
			$plan_trois_ans_pt_faible=$row['plan_trois_ans_pt_faible'];
			$plan_trois_ans_pt_faible2=$row['plan_trois_ans_pt_faible2'];
			$plan_trois_ans_pt_faible3=$row['plan_trois_ans_pt_faible3'];
			$plan_trois_ans_pt_faible4=$row['plan_trois_ans_pt_faible4'];
			
			$autre_pt_fort=$row['autre_pt_fort'];
			$autre_pt_fort2=$row['autre_pt_fort2'];
			$autre_pt_fort3=$row['autre_pt_fort3'];
			$autre_pt_fort4=$row['autre_pt_fort4'];
			
			$autre_pt_faible=$row['autre_pt_faible'];
			$autre_pt_faible2=$row['autre_pt_faible2'];
			$autre_pt_faible3=$row['autre_pt_faible3'];
			$autre_pt_faible4=$row['autre_pt_faible4'];
			$action_a_mener1= $row['action_a_mener1'];
			$action_a_mener2 = $row['action_a_mener2'];
			$action_a_mener3=$row['action_a_mener3'];
			$action_a_mener4=$row['action_a_mener4'];
			$delai_de_realisation1=$row['delai_de_realisation1'];
			$delai_de_realisation2 = $row['delai_de_realisation2'];
			$delai_de_realisation3 = $row['delai_de_realisation3'];
			$delai_de_realisation4=$row['delai_de_realisation4'];
			$resultat_attendus1=$row['resultat_attendus1'];
			$resultat_attendus2=$row['resultat_attendus2'];			
			$resultat_attendus3=$row['resultat_attendus3'];
			$resultat_attendus4=$row['resultat_attendus4'];
			$diagnostic=$row['diagnostic'];			
		}
		
		if($tel_bene==NULL)
				{$tel_bene=$tel_bene_perso;}
		$date_du_jour= date('d/m/Y');
		$this->imprimer(utf8_decode($nom_beneficiaire),utf8_decode($prenom_beneficiaire),utf8_decode($adresse_bene), $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$besoin_fort,$besoin_fort2,$besoin_fort3,$besoin_fort4,$besoin_faible,$besoin_faible2,$besoin_faible3,$besoin_faible4,$concurrence_fort,$concurrence_faible,$strategie_fort,$strategie_faible,$autre_fort,$autre_faible,$action1,$action2,$action3,$action4,$delai1,$delai2,$delai3,$delai4,$resultats1,$resultats2,$resultats3,$resultats4,$diagnostic1,$pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3,$comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5,$form_savoir6, $compet_acq,$compet_acq2,$compet_acq3,$compet_acq4,$delai_prior,$delai_prior2,$delai_prior3,$delai_prior4,$type_form,$type_form2,$type_form3,$type_form4,$elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$contact_value[2],$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$value_lettre,$pt_date1,$pt_plan_date1,$avis1,$avis2,$commentaire1,$commentaire2,$r_emploi,$com_ref,$com_ben,$concurrence_fort2,$concurrence_fort3,$concurrence_fort4,$concurrence_faible2,$concurrence_faible3,$concurrence_faible4,$strategie_fort2,$strategie_fort3,$strategie_fort4,$strategie_faible2,$strategie_faible3,$strategie_faible4,$autre_fort2,$autre_fort3,$autre_fort4,$autre_faible2,$autre_faible3,$autre_faible4,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,	$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4);	
	}
	
	//Emargement
	
	function imprimer_totalite_emargement($id_beneficiaire,$id_referent)

	{	
	
	//-------------
		
	
	$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['nom'];
			$prenom_beneficiaire=$row['prenom'];
			
			
			
			
		}
	
		
		$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_email=$row['account_email'];
			
		}
		
		
		$requete='SELECT * FROM  egw_addressbook  where n_family="'.$account_lastname.'" and n_given="'.$account_firstname.'"';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$org_name=$row['org_name'];
				$adr_one_street=$row['adr_one_street'];
				$adr_one_locality=$row['adr_one_locality'];
				$adr_one_region=$row['adr_one_region'];
				$adr_one_postalcode=$row['adr_one_postalcode'];	
				$tel_work=$row['tel_work'];	
				$email=$row['email'];
				
		}
		
				
		$requete='SELECT * FROM  egw_addressbook_extra  where contact_name="Id Pole Emploi" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$pole_value=$row['contact_value'];
		}
		$requete='SELECT * FROM  egw_addressbook_extra  where contact_name="Numero lettre de commande" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$lettre_value=$row['contact_value'];
		}
			
		$requete5='select * from egw_links where link_id1 = '.$id_beneficiaire.' order by link_id desc';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$link_id2[]=$row['link_id2'];
			
		}
		
		for($i=0;$i<count($link_id2);$i++)
		{
			
		$req= $req.' or id='.$link_id2[$i];
		}
		
		$requete='SELECT * FROM  egw_addressbook  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
		//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_pole=$row['n_family'];
			$prenom_pole=$row['n_given'];
			//$adresse_bene=$row['adr_one_street'];
			//$cp_bene=$row['adr_one_postalcode'];
			//$ville_bene=$row['adr_one_locality'];
			$tel_pole=$row['tel'];
			$mel_pole=$row['email'];
			$org_pole=$row['org_name'];
			
			
		}
		
		$corres_anpe=$nom_pole.' '.$prenom_pole;
		
		
		$date_du_jour= date('d/m/Y');
		
		$requete5='select * from egw_epce_plan_eval where id_beneficiaire = '.$id_beneficiaire.'';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			
			$pt_date1=$row['pt_date1'];
			$pt_date2=$row['pt_date2'];
			$diagnostic1_date1 = $row['diagnostic1_date1'];
			$diagnostic1_date2 = $row['diagnostic1_date2'];
			$diagnostic2_date1 = $row['diagnostic2_date1'];
			$diagnostic2_date2= $row['diagnostic2_date2'];
			$pt_plan_date1 = $row['pt_plan_date1'];
			$pt_plan_date2=$row['pt_plan_date2'];
			$sign=$row['sign'];
				
		}
		
		
		$this->imprimer_emargement(utf8_decode($nom_beneficiaire), utf8_decode($prenom_beneficiaire), $nom_presta, $mar_n, $lettre_value, $presta, $name_1, $name2, $pole_value, $pt_date1, $pt_plan_date1, $diagnostic1_date1, $diagnostic2_date1);
	}
	
	

function _destruct()
	{
	mysql_close($this->db);
	}

}
?>