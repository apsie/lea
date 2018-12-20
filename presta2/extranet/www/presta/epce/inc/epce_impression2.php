<?php

class epce_impression2
{
	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	
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

function imprimer ($nom_beneficiaire,$prenom_beneficiaire, $adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene, $date_du_jour,$besoin_fort,$besoin_faible,$concurrence_fort,$concurrence_faible,$strategie_fort,$strategie_faible,$autre_fort,$autre_faible,$action1,$action2,$action3,$action4,$delai1,$delai2,$delai3,$delai4,$resultats1,$resultats2,$resultats3,$resultats4,$diagnostic1,$pt_fort, $pt_faible,$action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2,$exp_pro,$comp_pro,$form_savoir,$compet_acq,$compet_acq2,$compet_acq3,$compet_acq4,$delai_prior,$delai_prior2,$delai_prior3,$delai_prior4,$type_form,$type_form2,$type_form3,$type_form4,$elem_port,$pt_vigilance,$apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $nom_prescripteur, $prenom_prescripteur, $nompole,$tel_prescripteur, $mail_prescripteur)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =BILAN_EPCE_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.rtf');

//Ouvre le fichier modèle
$filename='../doc/epce-bilan.rtf';
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//*****adressbook*****
$output = str_replace('<<NAME>>',$nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>',$prenom_beneficiaire, $output);
$output = str_replace('<<ADRESSE>>',$adresse_bene, $output);
$output = str_replace('<<CP>>',$cp_bene, $output);
$output = str_replace('<<VILLE>>',$ville_bene, $output);
$output = str_replace('<<TEL>>',$tel_bene, $output);
$output = str_replace('<<MEL>>',$mel_bene, $output);

$output = str_replace('<<DATEJOUR>>',$date_du_jour, $output);

//*****strategie_commerciale*****
$output = str_replace('<<BESOINFORT>>',$besoin_fort, $output);
$output = str_replace('<<BESOINFAIBLE>>',$besoin_faible, $output);
$output = str_replace('<<CONCURRENCEFORT>>',$concurrence_fort, $output);
$output = str_replace('<<CONCURRENCEFAIBLE>>',$concurrence_faible, $output);
$output = str_replace('<<STRATEGIEFORT>>',$strategie_fort, $output);
$output = str_replace('<<STRATEGIEFAIBLE>>',$strategie_faible, $output);
$output = str_replace('<<AUTREFORT>>',$autre_fort, $output);
$output = str_replace('<<AUTREFAIBLE>>',$autre_faible, $output);
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
$output = str_replace('<<PTFAIBLE>>',$pt_faible, $output);
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
$output = str_replace('<<COMP_PRO>>',$comp_pro, $output);
$output = str_replace('<<FORM_SAVOIR>>',$form_savoir, $output);
$output = str_replace('<<COMPET_ACQ>>',$compet_acq, $output);
$output = str_replace('<<COMPET_ACQ2>>',$compet_acq2, $output);
$output = str_replace('<<COMPET_ACQ3>>',$compet_acq3, $output);
$output = str_replace('<<COMPET_ACQ4>>',$compet_acq4, $output);
$output = str_replace('<<DELAI>>',$delai_prior, $output);
$output = str_replace('<<DELAI_PRIOR2>>',$delai_prior2, $output);
$output = str_replace('<<DELAI_PRIOR3>>',$delai_prior3, $output);
$output = str_replace('<<DELAI_PRIOR4>>',$delai_prior4, $output);
$output = str_replace('<<TYPE_FORM>>',$type_form, $output);
$output = str_replace('<<TYPE_FORM2>>',$type_form2, $output);
$output = str_replace('<<TYPE_FORM3>>',$type_form3, $output);
$output = str_replace('<<TYPE_FORM4>>',$type_form4, $output);
$output = str_replace('<<ELEM_PORT>>',$elem_port, $output);
$output = str_replace('<<PT_VIGILANCE>>',$pt_vigilance, $output);

//Aspect financier----------
$output = str_replace('<<APPORT_PT_FORTS>>',$apport_pt_forts, $output);
$output = str_replace('<<APPORTT_PT_FAIBLE>>',$apportt_pt_faible, $output);
$output = str_replace('<<CALCUL_PT_FORT>>',$calcul_pt_fort, $output);
$output = str_replace('<<CALCUL_PT_FAIBLE>>',$calcul_pt_faible, $output);
$output = str_replace('<<PLAN_INITIAL_PT_FORT>>',$plan_initial_pt_fort, $output);
$output = str_replace('<<PLAN_INITIAL_PT_FAIBLE>>',$plan_initial_pt_faible, $output);
$output = str_replace('<<PLAN_TROIS_ANS_PT_FORT>>',$plan_trois_ans_pt_fort, $output);
$output = str_replace('<<PLAN_TROIS_ANS_PT_FAIBLE>>',$plan_trois_ans_pt_faible, $output);
$output = str_replace('<<AUTRE_PT_FORT>>',$autre_pt_fort, $output);
$output = str_replace('<<AUTRE_PT_FAIBLE>>',$autre_pt_faible, $output);
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

//Coordonnées prescripteur (adressbook)--------------------------------
$output = str_replace('<<NOMCOR>>',$nom_prescripteur, $output);
$output = str_replace('<<PRECOR>>',$prenom_prescripteur, $output);
$output = str_replace('<<NOMPOLE>>',$nompole, $output);
$output = str_replace('<<TELCOR>>',$tel_prescripteur, $output);
$output = str_replace('<<MELCOR>>',$mail_prescripteur, $output);


//Envoie le document produit au navigateur
echo $output;
}
function imprimer_totalite($id_beneficiaire)

	{	
	$requete='SELECT * FROM  egw_addressbook  where id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['n_family'];
			$prenom_beneficiaire=$row['n_given'];
			$adresse_bene=$row['adr_one_street'];
			$cp_bene=$row['adr_one_postalcode'];
			$ville_bene=$row['adr_one_locality'];
			$tel_bene=$row['tel_cell'];
			$mel_bene=$row['email_home'];
			
		}
	$requete2='SELECT * FROM  egw_epce_aspect_commercial where id_beneficiaire='.$id_beneficiaire.'';
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		while($row = mysql_fetch_array($resultat2))
		{
			$besoin_fort=$row['analyse_besoin_client_pt_forts'];
			$besoin_faible=$row['analyse_besoin_client_pt_faible'];
			$concurrence_fort=$row['analyse_concurrence_pt_fort'];
			$concurrence_faible=$row['analyse_concurrence_pt_faible'];
			$strategie_fort=$row['strategie_commerciale_envisagee_pt_fort'];
			$strategie_faible=$row['strategie_commerciale_envisagee_pt_faible'];
			$autre_fort=$row['autre_pt_fort'];
			$autre_faible=$row['autre_pt_faible'];
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
	$requete3='SELECT * FROM  egw_epce_forme_juridique where id_beneficiaire='.$id_beneficiaire.'';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$pt_fort=$row['pt_fort'];
			$pt_faible=$row['pt_faible'];
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
		
	$requete4='select * from egw_epce_coherence_hp where id_beneficiaire = '.$id_beneficiaire.'';
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$exp_pro=$row['exp_pro'];
			$comp_pro=$row['comp_pro'];
			$form_savoir=$row['form_savoir'];
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
			$pt_vigilance=$row['pt_vigilance'];			
		}
		
		//-------------
		$requete5='select * from egw_epce_aspect_financier where id_beneficiaire = '.$id_beneficiaire.'';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$apport_pt_forts=$row['apport_pt_forts'];
			$apportt_pt_faible=$row['apportt_pt_faible'];
			$calcul_pt_fort=$row['calcul_pt_fort'];
			$calcul_pt_faible=$row['calcul_pt_faible'];
			$plan_initial_pt_fort=$row['plan_initial_pt_fort'];
			$plan_initial_pt_faible=$row['plan_initial_pt_faible'];
			$plan_trois_ans_pt_fort=$row['plan_trois_ans_pt_fort'];
			$plan_trois_ans_pt_faible = $row['plan_trois_ans_pt_faible'];
			$autre_pt_fort = $row['autre_pt_fort'];
			$autre_pt_faible = $row['autre_pt_faible'];
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
		
		
		//recuperation données prescripteurs
		// Selection dans la table egw_link --------
		$requete6='select * from egw_links where link_id1 = '.$id_beneficiaire.' order by link_id desc limit 1';
		$resultat6 = mysql_query($requete6) or die(mysql_error());
		while($row = mysql_fetch_array($resultat6))
		{
			
			//recupere id du prescripteur -> link_id2;
			$id_prescripteur=$row['link_id2'];
						
		}
		//select dans la table addressbook where id= $id_prescripteur;
		$requete7='select * from egw_addressbook where id = '.$id_prescripteur.'';
		$resultat7 = mysql_query($requete7) or die(mysql_error());
		while($row = mysql_fetch_array($resultat7))
		{
			
			//recupere les données du prescripteur -> link_id2;
			$nom_prescripteur=$row['n_family'];
			$prenom_prescripteur=$row['n_given'];
			$nompole=$row['org_name'];
			$tel_prescripteur=$row['tel_work'];
			$mail_prescripteur=$row['email'];
						
		}
		
		
		$date_du_jour= date('d/m/Y');
		
		$this->imprimer($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene, $date_du_jour, $besoin_fort,$besoin_faible,$concurrence_fort,$concurrence_faible, $strategie_fort,$strategie_faible, $autre_fort,$autre_faible,$action1, $action2,$action3,$action4, $delai1,$delai2, $delai3, $delai4, $resultats1, $resultats2, $resultats3, $resultats4, $diagnostic1, $pt_fort, $pt_faible, $action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2, $exp_pro,$comp_pro, $form_savoir, $compet_acq, $compet_acq2,$compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2,$type_form3, $type_form4, $elem_port, $pt_vigilance, $apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $nom_prescripteur, $prenom_prescripteur, $nompole,$tel_prescripteur, $mail_prescripteur);	
	}
//select sur la table where id_beneficiare=$idbeneficiaire
//recupere les variable ex : $delai1=rows['delai1']; 
//recupere le nom du beneficiare dans la table egw_addressbook $nom_beneficiaire=rows['nom_beneficiaire'];
//appel de la fonction imprimer
//$this->imprimer('$nom_benefiaire'..'..'$delai');

	
function _destruct()
	{
	mysql_close();
	}

}
?>