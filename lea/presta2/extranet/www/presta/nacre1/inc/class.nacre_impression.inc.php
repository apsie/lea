<?php

//require "mime_mail.class.php";
class nacre_impression
{
	public $db;	
	public $cat_id_prescripteur ;
	

/*public $db_user ="lea";
	public $db_pass ="123456";
	public $db_host ="localhost";
	public $db_name ="lea";
*/	


public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	public $adresse_bene;
	public $cp_bene;
	public $ville_bene;
	public $mel_bene;
			
	public $identifiant_pole;
	public $lalettre;
	public $nom_global;
	public $prenom_global;
	public $tel_bene;
	public $tel_prescripteur;
	public $titre;
	public $nom_referent;
	public $prenom_referent;
	public $date_deb;
	public $date_fin;
	public $proj;
	public $ale;
	public $tel_pole;
	public $mel_pole;
	public $date_debut_epce;
	public $date_fin_epce;
	public $p_org_name="APSIE";
	public $p_adr_one_street;
	public $p_adr_one_locality;
	public $p_adr_one_region;
	public $p_adr_one_postalcode;	
	public $p_tel_work;	
	public $p_email="presta@apsie.org";
	public $avis1;
	public $nbreLignes;
	public $date_premier;
	public $heure_premier;
	
	public $nom_p;
	public $civilite_p;
	public $prenom_p;
	public $email_bureau_p;
	public $tel_bureau_p;
	
	public $cal_1;
	public $cal_R1;
	public $cal_2;
	public $cal_3;
	public $cal_4;
		public $ab;
	
	public $code_rome;
	public $code_safir;
	public $email_siege;
	public $tmp_fin;
	public $imprimer;
				public $siret_form="44082666700014";
				public $code_postal_ben;
	
	public $id_presta;
	public $id_beneficiaire;
	function __construct($id_beneficiaire,$id_referent,$id_presta)
	{
		
		
// on se connecte à MySQL
$this->db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$this->db); 

// id_presta
$this->id_presta=$id_presta;
$this->id_beneficiaire=$id_beneficiaire;

//REFERENT

$requete='SELECT id_ref FROM  egw_prestation  where id_presta='.$id_presta.' order by id_presta desc';
$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$id_referent=$row['id_ref'];
			
		}
		
//RDV
/*$requete5='select * from egw_nacre_plan_eval where id_beneficiaire = '.$id_beneficiaire.'';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			
			$this->date_premier=$row['pt_date1'];
			$this->heure_premier=$row['pt_date2'];
		}*/


//RDV

		$requete='SELECT * from egw_cal where id_presta='.$id_presta.' order by cal_id asc ';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
		
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req_cal=$req_cal.' or cal_id='.$cal_id[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req_cal.' ) and cal_status!="R"';
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id2[]=$row['cal_id'];
		
		}

		for ($i=0;$i<count($cal_id2);$i++)
		{
		$req_cal2=$req_cal2.' or cal_id='.$cal_id2[$i];
		}
		$requete2='SELECT * FROM  egw_cal_dates  where cal_id=0 '.$req_cal2.' order by cal_start asc';
		
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat2))
		{
			
			$cal_end_ben[]=$row['cal_end'];
			$cal_start_ben[]=$row['cal_start'];
		
			
		}
		
		$this->cal_1 = $cal_start_ben[0];
		$this->cal_2 = $cal_start_ben[1];
		$this->cal_3 = $cal_start_ben[2];
		$this->cal_4 = $cal_start_ben[3];
	
	$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req_cal.' ) and cal_status="R"';
		
		$resultat = mysql_query($requete) or die(mysql_error());
	
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
		}

		for ($i=0;$i<count($cal_id);$i++)
		{
		$req_cal2=$req_cal2.' or cal_id='.$cal_id[$i];
		}
		$requete2='SELECT * FROM  egw_cal_dates  where cal_id=0 '.$req_cal2.' order by cal_start asc';
		
	
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat2))
		{
			
			$cal_end_ben[]=$row['cal_end'];
			$cal_start_ben[]=$row['cal_start'];
		
			
		}
		
		$this->cal_R1 = $cal_start_ben[0];	
		///

/*$requete='SELECT * FROM  egw_links  where link_app1="calendar" and link_app2="addressbook" and link_id2='.$id_beneficiaire.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$link_id1[]=$row['link_id1'];
		
		
		}
		
		
		if(isset($link_id1) and $link_id1!=NULL)
		{
		$req_a=NULL;
		
		for($i=0;$i<count($link_id1);$i++)
		{
			$req_a=$req_a.' or cal_id='.$link_id1[$i];
		}
		
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req_a.')  and (cal_status="A")';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		//$this->nbreLignes=mysql_num_rows($resultat);
		}*/
		
		
		
		
		//NBRE MODULE
			
		$requete='SELECT * FROM  egw_nacre_validation where id_beneficiaire='.id_beneficiaire.'';

		$resultat = mysql_query($requete) or die(mysql_error());
			while($row = mysql_fetch_array($resultat))
		{
			$plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
		
		$this->nbreLignes= $plan + $coherence + $commerciaux + $financier +$juridique+$bilan;
		}
		
		if($epce==0 and ($coherence==0 or $coherence==NULL))
		{
		$this->ab="coherence";
		}
		elseif($epce==0 and ($commerciaux==0 or $commerciaux==NULL))
		{
		$this->ab="commerciaux";
		}
		
		elseif($epce==0 and ($financier==0 or $financier==NULL))
		{
		$this->ab="financier";
		}
			elseif($epce==0 and ($juridique==0 or $juridique==NULL))
		{
		$this->ab="juridique";
		}
		
		
		

///

//RECUPERATION BILAN
$requete='SELECT code_rome,avis1 FROM  egw_nacre_bilan_avis  where id_beneficiaire='.$id_beneficiaire.'';

		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
		$this->code_rome=$row['code_rome'];
		$this->avis1=$row['avis1'];
		}
		//RECUPERATION LETTRE / DATE
$requete='SELECT lettre_de_commande,date_debut,date_fin  FROM  egw_prestation  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
		$this->lalettre=$row['lettre_de_commande'];
		$this->date_debut_epce=date('d/m/Y',$row['date_debut']);
		$this->date_fin_epce=date('d/m/Y',$row['date_fin']);
		$this->tmp_fin=$row['date_fin'];
		}
//RECUPERATION DES DONNEES BENEFICIARES

$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$this->nom_global=$row['nom'];
			$this->prenom_global=$row['prenom'];
			$this->adresse_bene=$row['adresse_ligne_1'];
			$this->cp_bene=$row['cp'];
			$this->ville_bene=$row['ville'];
			
			if($row['portable_perso']!=NULL)
			{
			$this->tel_bene=$row['portable_perso'];
			}
			elseif($row['tel_domicile_1']!=NULL)
			{
				$this->tel_bene=$row['tel_domicile_1'];
			}
			elseif($row['tel_pro_1']!=NULL)
			{
				$this->tel_bene=$row['tel_pro_1'];
			}
			
			
		
			$this->titre=$row['civilite'];
			$this->mel_bene=$row['email_perso'];
			$this->code_postal_ben=$cp_bene;
			/*$debut_epce=$row['debut_epce'];
			$fin_epce=$row['fin_epce'];
			$debut_epce=explode("/",$debut_epce);
			$fin_epce=explode("/",$fin_epce);
			
		$this->date_debut_epce=$debut_epce[2].'/'.$debut_epce[1].'/'.$debut_epce[0];
		$this->date_fin_epce=$fin_epce[2].'/'.$fin_epce[1].'/'.$fin_epce[0];
		*/
			
		}
	//RECUPERATION ID_POLE	
		$requete='SELECT * FROM  egw_contact_parcours_pro  where (id_ben='.$id_beneficiaire.') and (statut="DE" or statut="Beneficiaire du RSA" or statut="Retraite" or statut="CRP" or statut="Travailleur non salarie") order by id_parcours desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$this->identifiant_pole=$row['identifiant'];
		
		}
//RECUPERATION PRESTATAIRE

$requete='SELECT * FROM  egw_cal  where cal_title like "%'.$this->nom_global.' '.$this->prenom_global.'" order by cal_id desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_category=$row['cal_category'];
		
		
	
		
		}
			$cal_cat=explode(",",$cal_category);
		
		$requete='SELECT * FROM egw_organisation  where categorie_org like "%'.$cal_cat[0].'%" and nom_organisme like "APSIE%"';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$this->p_org_name=$row['nom_organisme'];
				$this->p_adr_one_street=$row['adresse_ligne_1'];
				$this->p_adr_one_locality=$row['ville'];
				$this->p_adr_one_region=$row['region'];
				
				$this->p_adr_one_postalcode=$row['cp'];	
				$this->p_tel_work=$row['tel'];	
				$this->p_email=$row['email'];
		}
		


		
//RECUPERATION DES DONNEES REFERENT
$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$this->prenom_referent=$row['account_firstname'];
			$this->nom_referent=$row['account_lastname'];
			$this->email_referent=$row['account_email'];
			
			
			
			
		}
		
	
$requete='SELECT * FROM  egw_categories  WHERE cat_name="PRESCRIPTEURS"';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_prescripteur=$row['cat_id'];	
	}
	
	
	
	
	
	// PRESCRIPTEUR
	
	
	
	$requete5='select id_contact_prescripteur from egw_prestation where id_presta = '.$id_presta.'';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$id_contact_prescripteur=$row['id_contact_prescripteur'];
			
		}
		
		
		if($id_contact_prescripteur!=0)
		{
			
		$requete='SELECT * FROM  egw_contact  where id_ben='.$id_contact_prescripteur.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$this->tel_pole=$row['tel_pro_1'];
			
			$this->nom_p=$row['nom'];
			$this->civilite_p=$row['civilite'];
			$this->prenom_p=$row['prenom'];
			$id_organisation=$row['id_organisation'];
			$this->email_bureau_p=$row['email_pro'];
			$this->tel_bureau_p=$row['tel_pro_1'];
		
			
			$id=$row['id_ben'];
		}
			
			$requete='SELECT * FROM  egw_organisation  WHERE id_organisation='.$id_organisation.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			
			$this->ale=$row['nom_organisme'];
			$this->code_safir=$row['code_org'];
			$this->mel_pole=$row['email'];
			$this->tel_prescripteur=$row['tel'];
			
		
		}
		}
		else
		{
	///////////////////////////////////////
	
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
			/*$nom_pole=$row['n_family'];
			$prenom_pole=$row['n_given'];*/
			//$adresse_bene=$row['adr_one_street'];
			//$cp_bene=$row['adr_one_postalcode'];
			//$ville_bene=$row['adr_one_locality'];
			$this->tel_pole=$row['tel_work'];
			$this->mel_pole=$row['email'];
			$this->ale=$row['org_name'];
			$this->code_safir=$row['code_safir'];
			
			$id=$row['id'];
			
			
			$requete='SELECT * FROM  egw_contact_prescripteur  WHERE id_prescripteur='.$id.' and id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$this->nom_p=$row['nom'];
			$this->civilite_p=$row['civilite'];
			$this->prenom_p=$row['prenom'];
			$this->email_bureau_p=$row['email_bureau'];
			$email_domicile=$row['email_domicile'];
			$this->tel_bureau_p=$row['tel_bureau'];
			$tel_portable=$row['tel_portable'];
			$fonction=$row['fonction'];
	
	}
		}
		
		}
	}
		public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}

function imprimer ($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$besoin_fort,$besoin_fort2,$besoin_fort3,$besoin_fort4,$besoin_faible,$besoin_faible2,$besoin_faible3,$besoin_faible4,$concurrence_fort,$concurrence_faible,$strategie_fort,$strategie_faible,$autre_fort,$autre_faible,$action1,$action2,$action3,$action4,$delai1,$delai2,$delai3,$delai4,$resultats1,$resultats2,$resultats3,$resultats4,$diagnostic1,$pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3,$comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5,$form_savoir6, $compet_acq,$compet_acq2,$compet_acq3,$compet_acq4,$delai_prior,$delai_prior2,$delai_prior3,$delai_prior4,$type_form,$type_form2,$type_form3,$type_form4,$elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$contact_value,$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$num_com,$date_debut,$date_fin,$avis1,$avis2,$commentaire1,$commentaire2,$r_emploi,$com_ref,$com_ben,$concurrence_fort2,$concurrence_fort3,$concurrence_fort4,$concurrence_faible2,$concurrence_faible3,$concurrence_faible4,$strategie_fort2,$strategie_fort3,$strategie_fort4,$strategie_faible2,$strategie_faible3,$strategie_faible4,$autre_fort2,$autre_fort3,$autre_fort4,$autre_faible2,$autre_faible3,$autre_faible4,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4,$nom_commercial,$activite_principale,$desc_projet)
{

if($this->imprimer!="none")
{
   //Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =BILAN_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.'.doc');
}


//Ouvre le fichier modèle

/*
if($this->ab=="juridique")
{ $filename='../doc/epce-bilan_ab_juridique.rtf';
}
else if($this->ab=="financier")
{
	$filename='../doc/epce-bilan_ab_financier.rtf';
}
else if($this->ab=="commerciaux")
{
	$filename='../doc/epce-bilan_ab_commerciaux.rtf';
}
else if($this->ab=="coherence")
{
	$filename='../doc/epce-bilan_ab_hp.rtf';
}
else
{
if($avis1=='1' and $avis2=='1')
{
	$filename='../doc/epce-bilan_negatif_1an.rtf';
}
elseif($avis1=='1' and $avis2=='2')
{
	$filename='../doc/epce-bilan_negatif_6mois.rtf';
}
elseif($avis1=='1' and $avis2=='3')
{
	$filename='../doc/epce-bilan_negatif_3mois.rtf';
}

elseif($avis1=='3' and $avis2=='3')
{
	$filename='../doc/epce-bilan_positif_3mois.rtf';
}

elseif($avis1=='3' and $avis2=='2')
{
	$filename='../doc/epce-bilan_positif_6mois.rtf';
}

elseif($avis1=='3' and $avis2=='1')
{
	$filename='../doc/epce-bilan_positif_1ans.rtf';
}
elseif($avis1=='2' and $avis2=='3')
{
	$filename='../doc/epce-bilan_positif_s_3mois.rtf';
}
elseif($avis1=='2' and $avis2=='2')
{
	$filename='../doc/epce-bilan_positif_s_6mois.rtf';
}
elseif($avis1=='2' and $avis2=='1')
{
	$filename='../doc/epce-bilan_positif_s_1an.rtf';
}
elseif($avis1=='1')
{
	$filename='../doc/epce-bilan_negatif.rtf';
}

else
{
	$filename='../doc/epce-bilan.rtf';
}

}*/
$filename='../doc/nacre-bilan.rtf';
$fp=fopen($filename, 'r+');

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
$output = str_replace('<<NUMIDENT>>',$this->identifiant_pole, $output);

//ORGANISME
$output = str_replace('<<NOMORGEVAL>>',$this->p_org_name, $output);
$output = str_replace('<<ADRESSEORGEVAL>>',$this->p_adr_one_street, $output);
$output = str_replace('<<CPORGEVAL>>',$this->p_adr_one_postalcode, $output);
$output = str_replace('<<VILLEORGEVAL>>',$this->p_adr_one_locality, $output);
$output = str_replace('<<TELORGEVAL>>',$this->p_tel_work, $output);
$output = str_replace('<<SIRET>>','440 826 667 00014', $output);
$output = str_replace('<<MELORGEVAL>>',$this->p_email, $output);

if($this->tel_bureau_p==NULL)
{
	$t=$this->tel_prescripteur;
}
else
{
$t=$this->tel_bureau_p;
}

if($this->email_bureau_p==NULL)
{
	$e=$this->mel_pole;
}
else
{
$e=$this->email_bureau_p;
}
//CORRESPONDANT POLE EMPLOI
$output = str_replace('<<NOMCOR>>',$this->nom_p, $output);
$output = str_replace('<<PRECOR>>',$this->prenom_p, $output);
$output = str_replace('<<NOMPOLE>>',$this->ale, $output);
$output = str_replace('<<TELCOR>>','3949', $output);
$output = str_replace('<<MELCOR>>',$e, $output);



//REFERENT
$output = str_replace('<<NOMREF>>',$this->nom_referent, $output);
$output = str_replace('<<PREREF>>',$this->prenom_referent, $output);
$output = str_replace('<<MELREF>>',$this->email_referent, $output);
$output = str_replace('<<TELREF>>',$this->p_tel_work, $output);


if($this->date_fin_epce=="01/01/1970")
{
	$fin_epce=NULL;
	}
else
{
$fin_epce=$this->date_fin_epce;
}
if(time()>$this->tmp_fin)
{
$signature=$this->date_fin_epce;


}
else if(time()<$this->tmp_fin)
{
$signature=date("d/m/Y",time());
}
$output = str_replace('<<projet>>',$desc_projet , $output);
//
$output = str_replace('<<NUMCOM>>',$this->lalettre, $output);
$output = str_replace('<<DATEDEB>>',$this->date_debut_epce, $output);
$output = str_replace('<<DATEFIN>>',$fin_epce, $output);

//
$output = str_replace('<<E4_DATE>>',$signature, $output);

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



if($this->imprimer!="none")
{
//Envoie le document produit au navigateur
echo $output;
}

$sujet='BILAN_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.'.doc';
$sujet2='BILAN_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole;
if($this->email_siege!=NULL)
{
	
$this->mail2($account_email,"presta@apsie.org",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);
$this->mail2($account_email,"drenault@apsie.org",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);

//$this->mail2($account_email,"atimsit@apsie.org",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);
//$this->mail2("presta@apsie.org","bilans-prestation.061@poleemploi.extelia.fr",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);
//$this->mail2($account_email,$account_email,$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);

}

}


function imprimer_plan($nom_beneficiaire,$prenom_beneficiaire,$adresse_bene, $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$id_pole,$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$descrip_proj,$etat_proj,$pt_a_evaluer,$pt_a_evaluer2,$pt_a_evaluer3,$attente_benef,$attente_benef2,$attente_benef3,$comment_ref,$pt_date1,$pt_date2,$diagnostic1_date1,$diagnostic1_date2,$diagnostic2_date1,$diagnostic2_date2,$pt_plan_date1,$pt_plan_date2,$sign,$org_name,$tel_work,$ad,$cp,$vil,$mail,$value_lettre)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
if($this->imprimer!="none")
{
header('Content-type: application/msword');
header('Content-disposition: inline, filename =plan_eval_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.'.doc');
}

//Ouvre le fichier modèle
$filename='../doc/epce-plan_evaluation.rtf';
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//*****adressbook*****
$output = str_replace('<<NAME>>',utf8_decode($this->nom_global), $output);
$output = str_replace('<<NAME2>>',utf8_decode($this->prenom_global), $output);
$output = str_replace('<<ADRESSE>>',$this->adresse_bene, $output);
$output = str_replace('<<CP>>',$this->cp_bene, $output);
$output = str_replace('<<VILLE>>',$this->ville_bene, $output);
$output = str_replace('<<TEL>>',$this->tel_bene, $output);
$output = str_replace('<<MEL>>',$this->mel_bene, $output);
$output = str_replace('<<NUMIDENT>>',$this->identifiant_pole, $output);

//LETTRE DE COMMANDE
if($this->date_fin_epce=="01/01/1970")
{$fin_epce=NULL;}
else
{
$fin_epce=	$this->date_fin_epce;
}
$output = str_replace('<<NUMCOM>>',$this->lalettre, $output);
$output = str_replace('<<DATEDEB>>',$this->date_debut_epce, $output);
$output = str_replace('<<DATEFIN>>',$fin_epce, $output);

//ORGANISME
/*if($org_name==NULL)
{
$org_name='APSIE';
}
if($org_name==NULL)
{
$ad='27 rue de Rouen';
}
if($org_name==NULL)
{
$cp='92400';
}
if($org_name==NULL)
{
$vil='Courbevoie';
}
if($tel_work==NULL)
{
$tel_work='01 49 71 58 50 ';
}
if($mail==NULL)
{
$mail='atimsit@apsie.org';
}*/

$output = str_replace('<<NOMORGEVAL>>',utf8_decode($this->p_org_name), $output);
$output = str_replace('<<ADRESSEORGEVAL>>',$this->p_adr_one_street, $output);
$output = str_replace('<<CPORGEVAL>>',$this->p_adr_one_postalcode, $output);
$output = str_replace('<<VILLEORGEVAL>>',utf8_decode($this->p_adr_one_locality), $output);

$output = str_replace('<<TELORGEVAL>>',$this->p_tel_work, $output);
$output = str_replace('<<SIRET>>','440 826 667 00014', $output);
$output = str_replace('<<MELORGEVAL>>',$this->p_email, $output);


		

//CORRESPONDANT POLE EMPLOI

if($this->tel_bureau_p==NULL)
{
	$t=$this->tel_prescripteur;
}
else
{
$t=$this->tel_bureau_p;
}

if($this->email_bureau_p==NULL)
{
	$e=$this->mel_pole;
}
else
{
$e=$this->email_bureau_p;
}

if($this->cal_1==0)
{$d_1=NULL;
$e1=NULL;}
else
{$d_1=date('H:i',$this->cal_1);
$e1=$this->date_fr_j($this->cal_1);
$e1=date('w/d/n/Y',$this->cal_1);
$e1=$this->date_fr_j($e1);}
if($this->cal_2==0)
{$d_2=NULL;$e2=NULL;}
else
{$d_2=date('H:i',$this->cal_2);
$e2=$this->date_fr_j($this->cal_2);
$e2=date('w/d/n/Y',$this->cal_2);
$e2=$this->date_fr_j($e2);
}
if($this->cal_3==0)
{$d_3=NULL;$e3=NULL;}
else
{$d_3=date('H:i',$this->cal_3);
$e3=date('w/d/n/Y',$this->cal_3);
$e3=$this->date_fr_j($e3);}
if($this->cal_4==0)
{$d_4=NULL;$e4=NULL;}
else
{$d_4=date('H:i',$this->cal_4);
$e4=date('w/d/n/Y',$this->cal_4);
$e4=$this->date_fr_j($e4);}

$output = str_replace('<<NOMCOR>>',utf8_decode($this->nom_p), $output);
$output = str_replace('<<PRECOR>>',utf8_decode($this->prenom_p), $output);
$output = str_replace('<<NOMPOLE>>',utf8_decode($this->ale), $output);
$output = str_replace('<<TELCOR>>','3949', $output);
$output = str_replace('<<MELCOR>>',utf8_decode($e), $output);

//REFERENT
$output = str_replace('<<NOMREF>>',$this->nom_referent, $output);
$output = str_replace('<<PREREF>>',$this->prenom_referent, $output);
$output = str_replace('<<MELREF>>',$this->email_referent, $output);
$output = str_replace('<<TELREF>>',$this->p_tel_work, $output);

//
$output = str_replace('<<DATE>>',date('d/m/Y'), $output);
$output = str_replace('<<DATE_BILAN>>',date('d/m/Y',$this->cal_4), $output);

//PROJET
$output = str_replace('<<DESCRIP_PROJET>>',$descrip_proj, $output);
$output = str_replace('<<ETAT_AVANCEMENT>>',$etat_proj, $output);
$output = str_replace('<<POINT_EVALUER>>',$pt_a_evaluer, $output);
$output = str_replace('<<POINT_EVALUERB>>',$pt_a_evaluer2, $output);
$output = str_replace('<<POINT_EVALUERC>>',$pt_a_evaluer3, $output);

//LES ATTENTES
$output = str_replace('<<ATTENTE_BENEF>>',$attente_benef, $output);
$output = str_replace('<<ATTT>>',$attente_benef2, $output);
$output = str_replace('<<ATTTB>>',$attente_benef3, $output);
$output = str_replace('<<COMMENT_REF>>',$comment_ref, $output);
//$test='Diagnostic et plan d actions commercial et financier';

/*//OBJECTIF
$output = str_replace('<<O1>>','Entrée , Coherence Homme projet', $output);
$output = str_replace('<<O2>>','Diagnostic et plan d actions commercial et financier', $output);
$output = str_replace('<<O3>>','Diagnostic et plan d actions juridique et réglementaire', $output);
$output = str_replace('<<O4>>','Point sur les plans d actions', $output);*/

//DUREE
$d1='2h';
$d2='1h';
$d3='1h';
$d4='2h';



$output = str_replace('<<HH>>',$d_1, $output);
$output = str_replace('<<PP>>',$d_2, $output);
$output = str_replace('<<ZZ>>',$d_3, $output);
$output = str_replace('<<VV>>',$d_4, $output);

//PROGRAMME D'EVALUATION
$output = str_replace('<<E1_DATE>>',$e1, $output);
//$output = str_replace('<<COMMENT_REF>>',utf8_decode($pt_date2), $output);
$output = str_replace('<<E2_DATE>>',$e2, $output);
//$output = str_replace('<<COMMENT_REF>>',utf8_decode($diagnostic1_date2), $output);
$output = str_replace('<<E3_DATE>>',$e3, $output);
//$output = str_replace('<<COMMENT_REF>>',utf8_decode($diagnostic2_date2), $output);
$output = str_replace('<<E4_DATE>>',$e4, $output);
//$output = str_replace('<<COMMENT_REF>>',utf8_decode($pt_plan_date2), $output);



/*//RESUTAT ATTENDU
$output = str_replace('<<R1>>','dfdf', $output);
$output = str_replace('<<R2>>','', $output);
$output = str_replace('<<R3>>','', $output);
$output = str_replace('<<R4>>','', $output);*/

if($this->imprimer!="none")
{
//Envoie le document produit au navigateur
echo $output;


}

$sujet='plan_eval_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole;
if($this->email_siege!=NULL)
{
/*$this->mail_fichier($output,$sujet,$this->email_siege,$account_firstname.' '.$account_lastname,$account_email);
$this->mail_fichier($output,$sujet,"drenault@apsie.org","qualite@apsie.org","qualite@apsie.org");*/
//$this->mail2($account_email,$this->email_siege,$sujet,$sujet.'.doc',$output,"","",$account_email);

//$this->mail2($account_email,"atimsit@apsie.org",$sujet,$sujet.'.doc',$output,"","",$account_email);
//$this->mail2($account_email,$account_email,$sujet,$sujet.'.doc',$output,"","",$account_email);

$this->mail2($account_email,"drenault@apsie.org",$sujet,$sujet.'.doc',$output,"","",$account_email);
$this->mail2($account_email,"presta@apsie.org",$sujet,$sujet.'.doc',$output,"","",$account_email);

}


}

function imprimer_evenement ($nom_beneficiaire, $prenom_beneficiaire, $bca,$cible,$op,$eccp,$mob,$str,$epce,$prec,$cde,$presta,$lieu_presta,$agence_inscr,$name1,$name2,$id,$date1,$heur,$demar,$pas_adh,$pas_pres,$report,$date_nouv,$h_rdv,$aband, $oui,$non,$statut,$comment,$account_email)
{

if($this->imprimer!="none")
{
//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=fiche_evenement_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.'.doc');
}
//Ouvre le fichier modèle
if($statut=="NSPP")
{
	$filename='../doc/eve_prestation_nspp.rtf';
	$fact="Non";
	$h=date('H\h i\m\i\n',$this->cal_R1);
	$d=date('d/m/Y',$this->cal_R1);
}
elseif($statut=="adhere_pas")
{
	$filename='../doc/eve_prestation_napa.rtf';
	$fact="Non";
	$h=date('H\h i\m\i\n',$this->cal_R1);
	$d=date('d/m/Y',$this->cal_R1);
}
elseif($statut=="abandon")
{
	$filename='../doc/eve_prestation_abandon.rtf';
	//$fact="Non";
	
	$h=date('H\h i\m\i\n',$this->cal_R1);
	$d=date('d/m/Y',$this->cal_R1);
}
elseif($statut=="adhere")
{
	$d=date('d/m/Y',$this->cal_1);
	$h=date('H\h i\m\i\n',$this->cal_1);
$filename='../doc/eve_prestation_demarre.rtf';
$fact="Oui";
}
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//**********
/*$epce='X ';

$bca='- ';
$cible='- ';
$op='- ';
$eccp='- ';
$mob='- ';
$str='- ';*/
$type="EPCE";


/*$output = str_replace('<<BCA>>', $bca, $output);
$output = str_replace('<<CIBLE>>', $cible, $output);
$output = str_replace('<<OP>>', $op, $output);
$output = str_replace('<<ECCP>>', $eccp, $output);
$output = str_replace('<<MOB>>', $mob, $output);
$output = str_replace('<<STR>>', $str, $output);
$output = str_replace('<<EPCE>>', $epce, $output);
$output = str_replace('<<PR>>', $prec, $output);*/
$output = str_replace('<<TYPE>>', $type, $output);
$output = str_replace('<<CDE>>', $this->lalettre, $output);
$output = str_replace('<<PRESTA>>', $this->p_org_name, $output);
$output = str_replace('<<LIEUPRESTA>>', $this->p_adr_one_street.' '.$this->p_adr_one_postalcode.' '.$this->p_adr_one_locality, $output);
$output = str_replace('<<AGENCE_INSCR>>', $this->ale, $output);
$output = str_replace('<<NAME1>>', $nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>', $prenom_beneficiaire, $output);
$output = str_replace('<<ID>>', $this->identifiant_pole, $output);
$output = str_replace('<<DATE1>>', $d, $output);
$output = str_replace('<<HEUR>>', $h, $output);
$output = str_replace('<<STATUT>>', 'A DEMARRER LA PRESTATION', $output);
$output = str_replace('<<P_ADH>>', $pas_adh, $output);
$output = str_replace('<<PAS_PRES>>', $pas_pres, $output);
$output = str_replace('<<REPO>>', $report, $output);
$output = str_replace('<<DATE_NOU>>', $date_nouv, $output);
$output = str_replace('<<H_RDV>>', $h_rdv, $output);
$output = str_replace('<<ABANDON>>', $aband, $output);
$output = str_replace('<<time>>',date('d/m/Y',time()), $output);
$output = str_replace('<<FACTURATION>>', $fact, $output);
$output = str_replace('<<aban>>', $comment, $output);
$output = str_replace('<<commentaire>>', utf8_decode($comment), $output);

if($this->imprimer!="none")
{
//Envoie le document produit au navigateur
echo $output;
}
if($statut=="abandon" or $statut=="adhere_pas")
{
$sujet='fiche_evenement_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.' ( abandon ).doc';
}
else
{
$sujet='fiche_evenement_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'_'.$this->identifiant_pole.'.doc';
}
if($this->email_siege!=NULL)
{
	
//$this->mail_fichier($output,$sujet,$this->email_siege,$this->prenom_referent.' '.$this->nom_referent,$this->email_referent);
//$this->mail2($account_email,$account_email,$sujet,$sujet,$output,"","",$account_email);

$this->mail2($account_email,"drenault@apsie.org",$sujet,$sujet,$output,"","",$account_email);
$this->mail2($account_email,"presta@apsie.org",$sujet,$sujet,$output,"","",$account_email);


//$this->mail2($account_email,"atimsit@apsie.org",$sujet,$sujet,$output,"","",$account_email);
/*if($statut=="adhere")
{
$this->mail_fichier($output,$sujet,"drenault@apsie.org","qualite@apsie.org","qualite@apsie.org");
}*/
}

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
//////////////////////////////////Imprimer annexe 1 ////////////////////////////

function imprimer_annexe1($nom_beneficiaire,$prenom_beneficiaire,$prix_total,$nb_ent,$titulaire,$siret_titu,$n_march,$presta,$siret_prest,$n_lot,$cde_num,$corres_anpe,$name1,$name2,$ident,$date_debut,$date_fin,$proj_rea,$proj_non_rea,$sol_alt,$nom_prest,$prenom_prest,$presta2,$ident)
	{
//Imprimer annexe 1 

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=Epce_Annexe1_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');

//Ouvre le fichier modèle
if($this->code_rome==NULL and $this->avis1!=1)
{
$filename='../doc/annexe1_realisable.rtf';
}
elseif($this->code_rome!=NULL and $this->avis1!=1)
{
$filename='../doc/annexe1_realisable_solution.rtf';
}
else
{
$filename='../doc/annexe1_nonrealisable_solution.rtf';
}

$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

/*//variable
if($nb_ent==4)
{
$nb_ent=6;
}
elseif($nb_ent==3)
{
$nb_ent=4;
}
elseif($nb_ent==2)
{
$nb_ent=3;
}
elseif($nb_ent==1)
{
$nb_ent=2;
}*/
//$prix_total_epce=290;
$prix_total_epce=292.15;
$mont_fact = ($prix_total_epce/6)*$nb_ent;


//Remplace les marqueurs du modèle par nos données
$n_march='N0002';
$presta='APSIE';
$siret_prest='440 826 667 00014';
$siret_titu='440 826 667 00014';
$n_lot='2';
$titulaire='APSIE';
if($this->date_fin_epce=="01/01/1970")
{$fin_epce=NULL;}
else
{
$fin_epce=	$this->date_fin_epce;
}
$output = str_replace('<<TITULAIRE>>',$titulaire, $output);
$output = str_replace('<<SIRET_TITU>>',$siret_titu, $output);
$output = str_replace('<<N_MARCH>>',$n_march, $output);
$output = str_replace('<<PRESTA>>',$presta, $output);
$output = str_replace('<<SIRET_PREST>>',$siret_prest, $output);
$output = str_replace('<<N_LOT>>',$n_lot, $output);
$output = str_replace('<<CDE_NUM>>',$this->lalettre, $output);
$output = str_replace('<<CORRES_ANPE>>',$this->nom_p.' '.$this->prenom_p, $output);
$output = str_replace('<<NAME1>>',$nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>',$prenom_beneficiaire, $output);
$output = str_replace('<<IDENT>>',$this->identifiant_pole, $output);
$output = str_replace('<<DATE_DEBUT>>',$this->date_debut_epce, $output);
$output = str_replace('<<DATE_FIN>>',$fin_epce, $output);
$output = str_replace('<<NB_ENT>>',$nb_ent, $output);


$output = str_replace('<<MONT_FACT>>',round($mont_fact,2), $output);
$output = str_replace('<<NOM_PREST>>',$this->nom_referent, $output);
$output = str_replace('<<PRENOM_PREST>>',$this->prenom_referent, $output);
$output = str_replace('<<DATEDUJOUR>>',date('d/m/Y'), $output);
/*$output = str_replace('<<PRESTA_2>>',$presta2, $output);*/


//Envoie le document produit au navigateur
echo $output;

}

////////////////////////////////// FIN Imprimer annexe 1 ////////////////////////////





// IMPRIMER COUVERTURE PRESTA

function imprimer_couverture1()
	{
//Imprimer annexe 1 

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=couverture_presta_'.$this->nom_global.'_'.$this->prenom_global.'.doc');

//Ouvre le fichier modèle
$filename='../doc/couverture_presta.rtf';
$fp=fopen($filename,'r');

//Stocke le modèle dans une variable
$voir=fread($fp, filesize($filename));

fclose($fp);

if($this->date_fin_epce=="01/01/1970")
{
$fin_epce=NULL;
}
else
{
$fin_epce=$this->date_fin_epce;
}
$voir = str_replace('<<NOM0>>',$this->titre, $voir);

$voir = str_replace('<<NOM>>',$this->nom_global, $voir);
$voir = str_replace('<<NOM1>>',$this->prenom_global, $voir);
$voir = str_replace('<<TELEPHONE1>>',$this->tel_bene, $voir);
$voir = str_replace('<<ACTION>>','Création d\'entreprise', $voir);
$voir = str_replace('<<PROJET>>',$this->proj, $voir);
$voir = str_replace('<<ALE>>',$this->ale,$voir);
$voir = str_replace('<<DATE1>>',$this->date_debut_epce, $voir);
$voir = str_replace('<<DATE2>>',$fin_epce, $voir);
$voir = str_replace('<<REFERENT>>',$this->nom_referent.' '.$this->prenom_referent, $voir);
									   



//Envoie le document produit au navigateur
echo $voir;
}


function imprimer_couverture2()
	{
//Imprimer annexe 1 

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=couverture_dossier_admin_'.$this->nom_global.'_'.$this->prenom_global.'.doc');

//Ouvre le fichier modèle
$filename='../doc/couverture_admin.rtf';
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$admin=fread($fp, filesize($filename));

fclose($fp);


$admin= str_replace('<<FN>>',$this->titre.' '.$this->nom_global.' '.$this->prenom_global, $admin);
$admin= str_replace('<<PROJ>>',$this->proj, $admin);


//Envoie le document produit au navigateur 
echo $admin;


}

// IMPRIMER COUVERTURE PROJET

function imprimer_couverture3()
	{
//Imprimer annexe 1 

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-Disposition: inline, filename=couverture_projet_'.$this->nom_global.'_'.$this->prenom_global.'.doc');

//Ouvre le fichier modèle
$filename='../doc/couverture_projet.rtf';
$fp=fopen($filename, 'r');

//Stocke le modèle dans une variable
$pro=fread($fp, filesize($filename));

fclose($fp);

$pro= str_replace('<<FN>>',$this->titre.' '.$this->nom_global.' '.$this->prenom_global, $pro);
$pro= str_replace('<<PROJ>>',$this->proj, $pro);



//Envoie le document produit au navigateur
echo $pro;
}

function imprimer_couvertures()
	{
		

header('Content-type: application/msword');
header('Content-Disposition: inline, filename=couvertures_'.$this->nom_global.'_'.$this->prenom_global.'.doc');

//Ouvre le fichier modèle
$filename='../doc/couvertures.rtf';
$fp=fopen($filename,'r');

//Stocke le modèle dans une variable
$voir=fread($fp, filesize($filename));

fclose($fp);

if($this->date_fin_epce=="01/01/1970")
{
$fin_epce=NULL;
}
else
{
$fin_epce=$this->date_fin_epce;
}
$voir = str_replace('<<NOM0>>',$this->titre, $voir);

$voir = str_replace('<<NOM>>',$this->nom_global, $voir);
$voir = str_replace('<<NOM1>>',$this->prenom_global, $voir);
$voir = str_replace('<<TELEPHONE1>>',$this->tel_bene, $voir);
$voir = str_replace('<<ACTION>>','Création d\'entreprise', $voir);
$voir = str_replace('<<PROJET>>',$this->proj, $voir);
$voir = str_replace('<<ALE>>',$this->ale,$voir);
$voir = str_replace('<<DATE1>>',$this->date_debut_epce, $voir);
$voir = str_replace('<<DATE2>>',$fin_epce, $voir);
$voir = str_replace('<<REFERENT>>',$this->nom_referent.' '.$this->prenom_referent, $voir);
$voir= str_replace('<<FN>>',$this->titre.' '.$this->nom_global.' '.$this->prenom_global, $voir);
$voir= str_replace('<<PROJ>>',$this->proj, $voir);
								   



//Envoie le document produit au navigateur
echo $voir;
}

//

//

//
function imprimer_totalite($id_beneficiaire,$id_referent)

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
			$mel_bene=$row['email_perso'];
			
		}
		$requete='SELECT * FROM  egw_resacc  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_commercial=$row['nom_commercial'];
			$activite_principale=$row['activite_principale'];
			
			
		}
		$requete='SELECT * FROM  egw_projet  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$desc_projet=$row['description_projet'];
		
			
		}
		
	$requete2='SELECT * FROM  egw_nacre_aspect_commercial where id_beneficiaire='.$this->id_beneficiaire.'';
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
	$requete3='SELECT * FROM  egw_nacre_forme_juridique where  id_beneficiaire='.$this->id_beneficiaire.'';
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
		
	$requete4='select * from egw_nacre_coherence_hp where  id_beneficiaire='.$this->id_beneficiaire.'';
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
		$requete5='select * from egw_nacre_aspect_financier where  id_beneficiaire='.$this->id_beneficiaire.'';
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
		
		$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_email=$row['account_email'];
			
			
		}
		
		/*
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
		
		$requete='SELECT * FROM  egw_contact  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
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
		
		
		$requete5='select * from egw_contact_extra where contact_id = '.$id_beneficiaire.' order by contact_id desc';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$contact_name=$row['contact_name'];
			$contact_value[]=$row['contact_value'];
		}
		*/
	/*$requete='SELECT * FROM  egw_contact_extra  where contact_name="Numero lettre de commande" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$value_lettre=$row['contact_value'];
		}*/
	
		$requete='SELECT * FROM  egw_nacre_bilan_avis  where  id_beneficiaire='.$this->id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$commentaire1=$row['commentaire1'];
			$commentaire2=$row['commentaire2'];
			$avis1=$row['avis1'];
			$avis2=$row['avis2'];
			$r_emploi=$row['r_emploi'];
			$com_ref=$row['com_ref'];
			$com_ben=$row['com_ben'];
			
			
			
		}
		$date_du_jour= date('d/m/Y');
		$this->imprimer(utf8_decode($nom_beneficiaire),utf8_decode($prenom_beneficiaire),utf8_decode($adresse_bene), $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$besoin_fort,$besoin_fort2,$besoin_fort3,$besoin_fort4,$besoin_faible,$besoin_faible2,$besoin_faible3,$besoin_faible4,$concurrence_fort,$concurrence_faible,$strategie_fort,$strategie_faible,$autre_fort,$autre_faible,$action1,$action2,$action3,$action4,$delai1,$delai2,$delai3,$delai4,$resultats1,$resultats2,$resultats3,$resultats4,$diagnostic1,$pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_men1, $action_men2, $action_men3, $action_men4, $delai_real1, $delai_real2, $delai_real3, $delai_real4, $resultat_att1, $resultat_att2, $resultat_att3, $resultat_att4, $diagnostic2,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3,$comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5,$form_savoir6, $compet_acq,$compet_acq2,$compet_acq3,$compet_acq4,$delai_prior,$delai_prior2,$delai_prior3,$delai_prior4,$type_form,$type_form2,$type_form3,$type_form4,$elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$contact_value[2],$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$value_lettre,$pt_date1,$pt_plan_date1,$avis1,$avis2,$commentaire1,$commentaire2,$r_emploi,$com_ref,$com_ben,$concurrence_fort2,$concurrence_fort3,$concurrence_fort4,$concurrence_faible2,$concurrence_faible3,$concurrence_faible4,$strategie_fort2,$strategie_fort3,$strategie_fort4,$strategie_faible2,$strategie_faible3,$strategie_faible4,$autre_fort2,$autre_fort3,$autre_fort4,$autre_faible2,$autre_faible3,$autre_faible4,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,	$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4,$nom_commercial,$activite_principale,$desc_projet);	
	}
	
			
	
	function imprimer_totalite_plan($id_beneficiaire,$id_referent)

	{	
	
	//-------------
	
	
	
	
	$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['nom'];
			$prenom_beneficiaire=$row['prenom'];
			$adresse_bene=$row['adresse_ligne_1'];
			$cp_bene=$row['cp'];
			$ville_bene=$row['ville'];
			$tel_bene=$row['tel_perso'];
			$mel_bene=$row['email_perso'];
			
		}
	
		
		$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_email=$row['account_email'];
			
			
			
		}
		
		
	
		
		$requete='SELECT cal_category FROM  egw_cal  where id_presta='.$this->id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_category=$row['cal_category'];
			
		}
		
	/*	$requete='SELECT * FROM egw_contact  where cat_id="'.$cal_category.'" and org_name like "APSIE%"';
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
		$ad=$adr_one_street;
		$cp=$adr_one_postalcode;
		$vil=$adr_one_locality;*/
		
	/*
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
		
		$requete='SELECT * FROM  egw_contact  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
		//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_pole=$row['n_family'];
			$prenom_pole=$row['n_given'];
			//$adresse_bene=$row['adr_one_street'];
			//$cp_bene=$row['adr_one_postalcode'];
			//$ville_bene=$row['adr_one_locality'];
			$tel_pole=$row['tel_work'];
			$mel_pole=$row['email'];
			$org_pole=$row['org_name'];
			
		}
		
		
		$requete5='select * from egw_contact_extra where contact_id = '.$id_beneficiaire.' order by contact_id desc';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$contact_name=$row['contact_name'];
			$contact_value[]=$row['contact_value'];
		}
		$date_du_jour= date('d/m/Y');
		
		$requete='SELECT * FROM  egw_contact_extra  where contact_name="Numero lettre de commande" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$value_lettre=$row['contact_value'];
		}*/

	$this->imprimer_plan(utf8_decode($nom_beneficiaire),utf8_decode($prenom_beneficiaire),utf8_decode($adresse_bene), $cp_bene, $ville_bene, $tel_bene, $mel_bene,$date_du_jour,$contact_value[2],$org_pole,$nom_pole,$prenom_pole,$mel_pole,$tel_pole,$account_firstname,$account_lastname,$account_email,$descrip_proj,$etat_proj,$pt_a_evaluer,$pt_a_evaluer2,$pt_a_evaluer3,$attente_benef,$attente_benef2,$attente_benef3,$comment_ref,$pt_date1,$pt_date2,$diagnostic1_date1,$diagnostic1_date2,$diagnostic2_date1,$diagnostic2_date2,$pt_plan_date1,$pt_plan_date2,$sign,$org_name,$tel_work,$ad,$cp,$vil,$email,$value_lettre);	
	}
	
	//annexe 1
	
	function imprimer_totalite_annexe1($id_beneficiaire,$id_referent)

	{	
	
	//-------------
		
	
	
	
	
	$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['nom'];
			$prenom_beneficiaire=$row['prenom'];
			$adresse_bene=$row['adresse_ligne_1'];
			$cp_bene=$row['cp'];
			$ville_bene=$row['ville'];
			$tel_bene=$row['tel_perso'];
			$mel_bene=$row['email_perso'];
			
			
		}
	
		
		$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			$account_email=$row['account_email'];
			
			
			
		}
		
		
		/*$requete='SELECT * FROM  egw_contact  where n_family="'.$account_lastname.'" and n_given="'.$account_firstname.'"';
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
				
		}*/
		
				
		/*$requete='SELECT * FROM  egw_contact_extra  where contact_name="Id Pole Emploi" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$contact_value=$row['contact_value'];
		}
			$requete='SELECT * FROM  egw_contact_extra  where contact_name="Numero lettre de commande" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$value_lettre=$row['contact_value'];
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
		
		$requete='SELECT * FROM  egw_contact  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
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
		
		$corres_anpe=$nom_pole.' '.$prenom_pole;*/
		
		
		/*$date_du_jour= date('d/m/Y');
		
		$requete5='select * from egw_nacre_plan_eval where id_beneficiaire = '.$id_beneficiaire.'';
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
		*/
		
		$this->imprimer_annexe1(utf8_decode($nom_beneficiaire),utf8_decode($prenom_beneficiaire),$prix_total,$this->nbreLignes,$org_name,$siret_titu,$n_march,$presta,$siret_prest,$n_lot,$value_lettre,$corres_anpe,$name1,$name2,$ident,$pt_date1,$pt_plan_date1,$proj_rea,$proj_non_rea,$sol_alt,$account_lastname,$account_firstname,$org_name,$contact_value);
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
	/*	
		
		$requete='SELECT * FROM  egw_contact  where n_family="'.$account_lastname.'" and n_given="'.$account_firstname.'"';
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
		
				
		$requete='SELECT * FROM  egw_contact_extra  where contact_name="Id Pole Emploi" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$pole_value=$row['contact_value'];
		}
		$requete='SELECT * FROM  egw_contact_extra  where contact_name="Numero lettre de commande" and contact_id='.$id_beneficiaire.'';
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
		
		$requete='SELECT * FROM  egw_contact  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
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
		
		$requete5='select * from egw_nacre_plan_eval where id_beneficiaire = '.$id_beneficiaire.'';
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
				
		}*/
		
		
		$this->imprimer_emargement(utf8_decode($nom_beneficiaire), utf8_decode($prenom_beneficiaire), $nom_presta, $mar_n, $lettre_value, $presta, $name_1, $name2, $pole_value, $pt_date1, $pt_plan_date1, $diagnostic1_date1, $diagnostic2_date1);
	}
	
	function imprimer_totalite_evenement($id_beneficiaire,$id_referent,$statut=NULL,$comment=NULL)
	{
			
	$requete='SELECT * FROM  egw_contact  where id_ben='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$nom_beneficiaire=$row['nom'];
			$prenom_beneficiaire=$row['prenom'];
			
			
			
		}
	/*
	$requete5='select * from egw_nacre_plan_eval where id_presta = '.$this->id_presta.'';
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
			$requete='SELECT * FROM  egw_contact_extra  where contact_name="Id Pole Emploi" and contact_id='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
				$id=$row['contact_value'];
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
		
		$requete='SELECT * FROM  egw_contact  where cat_id='.$this->cat_id_prescripteur.' and (id=0 '.$req.') order by id desc';
		//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$org_pole=$row['org_name'];
			
			
		}*/
		
		$requete='SELECT * FROM  egw_accounts  where account_id='.$id_referent.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_email=$row['account_email'];
			
			
			
		}
	$this->imprimer_evenement ($nom_beneficiaire, $prenom_beneficiaire, $bca,$cible,$op,$eccp,$mob,$str,$epce,$prec,$cde,$presta,$lieu_presta,$org_pole,$name1,$name2,$id,$pt_date1,$pt_date2,$demar,$pas_adh,$pas_pres,$report,$date_nouv,$h_rdv,$aband, $oui,$non,$statut,$comment,$account_email);

	
	}
	
	function mail2($ad_exp,$ad_des,$titre,$name_file,$file,$name_file2,$file2,$account_email)
	{
	
	 // declaration de la classe
 
 

 
  // instanciation de la classe
  $mail = new mime_mail();
  // parametres
  $mail->to = $ad_des; // Adresse email de reception
 
 
  
  $mail->subject = $titre; // Sujet
  $mail->body = "Mail Automatique."; // Corps du message
  $mail->from = $ad_exp; // Adresse email de l'expediteur (optionnel)
 
  $mail->attach($file, $name_file); // fichier attache (optionnel)
  
  if($name_file2!=NULL)
  {
	 $mail->attach($file2, $name_file2); // fichier attache (optionnel
  }
  // envoi du message
  $mail->send();

}
	function mail_fichier($fichier,$nom,$destination,$referent,$expediteur,$type="")
	
	{	

     //Auteur : ptit_mousse

    // Destinataire du mail
//$destination = "drenault@apsie.org";
// sujet du mail
//$sujet = "test";
// Les headers pour un mail multiparts
$headers= "MIME-Version: 1.0\n";
$headers.= "From: \"$referent\" <$expediteur>\n";
$headers .= 'To: Developpeur web <drenault@apsie.org>' . "\r\n";
$headers.= "Content-type: multipart/mixed;\n";
// Chaine permettant de différencier les différentes parties du mail
$limite = '_parties_'.md5(uniqid (rand()));
$headers.= " boundary=\"----=$limite\"\n\n";

// Première partie, corps du mail en HTML
$texte = "------=$limite\n";
$texte.= "Content-type: text/html; charset=\"iso-8859-1\"\n\n";
/*$texte.="<HTML><HEAD></HEAD><BODY>Oh un mail !</BODY></HTML>";*/

// Traitement pour attacher une PJ
// D'abord on lit le fichier
/*$fichier = '../doc/epce-bilan_negatif_1an.rtf';
$contenu = file_get_contents($fichier);*/
$attachement = "\n------=$limite\n";
// Dans mon exemple, il s'agit d'un fichier html, il faut mettre le bon mime type
if($type="excel")
{
$attachement .= "Content-Type: application/vnd.ms-excel; name=\"$nom\"\n";

}
else
{
$attachement .= "Content-Type: application/msword; name=\"$nom\"\n";
}
$attachement .= "Content-Transfer-Encoding: base64\n";
$attachement .= "Content-Disposition: attachment; filename=\"$nom\"\n\n";

// Ca y est on joint le fichier en l'encodant en base 64
$attachement .= chunk_split(base64_encode($fichier));

$attachement = "\n------=$limite\n";
// Dans mon exemple, il s'agit d'un fichier html, il faut mettre le bon mime type
if($type="excel")
{
$attachement.= "Content-Type: application/vnd.ms-excel; name=\"$nom\"\n";

}
else
{
$attachement .= "Content-Type: application/msword; name=\"$nom\"\n";
}
$attachement .= "Content-Transfer-Encoding: base64\n";
$attachement .= "Content-Disposition: attachment; filename=\"$nom\"\n\n";

// Ca y est on joint le fichier en l'encodant en base 64
$attachement .= chunk_split(base64_encode($fichier));

// enfin on envoi le mail
mail($destination, $nom, $texte, $headers.$attachement);

     }
		function form()
	{

ini_set('display_errors', 1);
include("../../../Classes/PHPExcel/IOFactory.php");




if (!file_exists("../doc/form.xls")) {
	
	
	exit();
}

	

$objPHPExcel = PHPExcel_IOFactory::load("../doc/form.xls");
//$sheetupa=$objPHPExcel->getActiveSheet()->SetTitle('Feuil11');
$sheetupa=$objPHPExcel->getActiveSheet();
$sheetupa->setCellValue('C8',$this->siret_form);
$sheetupa->setCellValue('C9',"presta@apsie.org");
$sheetupa->setCellValue('C10',"N0002");
$sheetupa->setCellValue('C11',substr($this->identifiant_pole, 0, -1));
$sheetupa->setCellValue('C12',substr($this->code_postal_ben, 0, -3));
$sheetupa->setCellValue('C13','35284977100039');
$sheetupa->setCellValue('C14',$this->lalettre);
$sheetupa->setCellValue('C15',$this->date_debut_epce);
$sheetupa->setCellValue('C16',$this->code_safir);
$sheetupa->setCellValue('C17',"EPCE");


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="form_bilanprest.xls"');
header('Cache-Control: max-age=0');






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');



exit;
	}

function form_bilan()
{
/*	header("Content-type: application/vnd.ms-excel");

header("Content-disposition: attachment; filename=form_bilanprest.xls");*/
/*header('Content-type: application/vnd.ms-excel');
header('Content-disposition: inline, filename =form_bilanprest.xls');*/

	$html_xls='
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 11">
<link rel=File-List href="form_html_fichiers/filelist.xml">
<style id="form_30483_Styles">
<!--table
	{mso-displayed-decimal-separator:"\,";
	mso-displayed-thousand-separator:" ";}
.xl1530483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2330483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2430483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2530483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:blue;
	font-size:12.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2630483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2730483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl2830483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Helvetica;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	background:#CCCCFF;
	mso-pattern:auto none;
	white-space:nowrap;}
.xl2930483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:middle;
	background:#CCCCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3030483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Helvetica;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	background:#99CCFF;
	mso-pattern:auto none;
	white-space:nowrap;}
.xl3130483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Helvetica;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:middle;
	background:#CCCCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3230483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:middle;
	background:#99CCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3330483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Helvetica;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	background:#CCCCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3430483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"dd\/mm\/yy\;\@";
	text-align:left;
	vertical-align:middle;
	background:#99CCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3530483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Helvetica;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:"Short Date";
	text-align:left;
	vertical-align:middle;
	background:#CCCCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl3630483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:white;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	background:white;
	mso-pattern:auto none;
	white-space:nowrap;}
.xl3730483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:gray;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	mso-generic-font-family:auto;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl3830483
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:blue;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\@";
	text-align:left;
	vertical-align:middle;
	background:#99CCFF;
	mso-pattern:auto none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
-->
</style>
</head>

<body>


<div id="form_30483" align=center x:publishsource="Excel">

<table x:str border=0 cellpadding=0 cellspacing=0 width=680 style="border-collapse:
 collapse;table-layout:fixed;width:510pt">
 <col width=180 style="mso-width-source:userset;mso-width-alt:6582;width:135pt">
 <col width=320 style="mso-width-source:userset;mso-width-alt:11702;width:240pt">
 <col width=180 style="mso-width-source:userset;mso-width-alt:6582;width:135pt">
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 width=180 style="height:12.75pt;width:135pt"></td>
  <td class=xl1530483 width=320 style="width:240pt"></td>
  <td class=xl2330483 width=180 style="width:135pt"></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"><img src="http://lea.apsie.org/presta/epce/images/pole.png" /></td>
  <td class=xl2430483 style="mso-ignore:style;color:green;font-weight:700">&nbsp;</td>
  <td class=xl2330483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl2430483></td>
  <td class=xl2330483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl1530483></td>
  <td class=xl2330483></td>
 </tr>
 <tr height=21 style="height:15.75pt">
  <td height=21 class=xl1530483 style="height:15.75pt"></td>
  <td class=xl2530483 colspan=2>Pôle emploi : Gestion des bilans de prestation</td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl1530483></td>
  <td class=xl2330483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl2630483></td>
  <td class=xl2730483></td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>Siret Mandataire</td>
  <td class=xl2930483>44082666700014</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl3030483>Adresse mail (pour la gestion des retours)</td>
  <td class=xl3830483>presta@apsie.org</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>N° Marché</td>
  <td class=xl2930483>N0002</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl3030483>N° DE</td>
  <td class=xl3830483>'.substr($this->identifiant_pole, 0, -1).'</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>N° de département de résidence du DE</td>
  <td class=xl3130483>'.substr($this->code_postal_ben, 0, -3).'</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl3030483>Siret prestataire</td>
  <td class=xl3230483>44082666700014</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>N° LC</td>
  <td class=xl3330483 x:num>'.$this->lalettre.'</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl3030483>Date de démarrage</td>
  <td class=xl3430483 x:num>'.$this->date_debut_epce.'</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>Code Agence</td>
  <td class=xl3330483 x:num>'.$this->code_safir.'</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl3030483>Type de prestation</td>
  <td class=xl3230483>EPCE</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2830483>Date éventuelle d"abandon</td>
  <td class=xl3530483>&nbsp;</td>
 </tr>
 <tr height=33 style="mso-height-source:userset;height:24.75pt">
  <td height=33 class=xl1530483 style="height:24.75pt"></td>
  <td class=xl2630483></td>
  <td class=xl3630483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl1530483></td>
  <td class=xl2330483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl3730483 style="height:12.75pt">Version 2.0</td>
  <td class=xl1530483></td>
  <td class=xl2330483></td>
 </tr>
 <tr height=17 style="height:12.75pt">
  <td height=17 class=xl1530483 style="height:12.75pt"></td>
  <td class=xl1530483></td>
  <td class=xl2330483></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style="display:none">
  <td width=180 style="width:135pt"></td>
  <td width=320 style="width:240pt"></td>
  <td width=180 style="width:135pt"></td>
 </tr>
 <![endif]>
</table>

</div>
</body>

</html>';


//echo $html_xls;
return $html_xls;
//$this->mail_fichier($html_xls,'form_bilanprest','drenault@apsie.org','APSIE','presta@apsie.org',"excel");
//$this->mail2("APSIE","presta@apsie.org","drenault@apsie.org",$html_xls);


exit;

}
function form_base()
{


require_once "excel/class.writeexcel_workbook.inc.php";
require_once "excel/class.writeexcel_worksheet.inc.php";


$fname = tempnam("../doc/", "form_bilanprest.xls");
$workbook = &new writeexcel_workbook($fname);
$worksheet = &$workbook->addworksheet('Feuil1');



$worksheet->set_column('A:B', 25); // // le 30 représente la largeur de chaque colonne  
$worksheet->set_column('B:C', 45);
$worksheet->set_column('C:D', 25);
$worksheet->set_row('7:8', 25);
$worksheet->set_row('8:9', 25);
$worksheet->set_row('9:10', 25);
$worksheet->set_row('10:11', 25);
$worksheet->set_row('11:12', 25);
$worksheet->set_row('12:13', 25);
$worksheet->set_row('13:14', 25);
$worksheet->set_row('14:15', 25);
$worksheet->set_row('15:16', 25);
$worksheet->set_row('16:17', 25);
$worksheet->set_row('17:18', 25);
$worksheet->set_row('18:19', 25);

$heading_version  =& $workbook->addformat(array(  

'bold'    => 0,    // on met le texte en gras  

'color'   => 'grey', // de couleur noire  

'size'    => 10,    // de taille 12  

'merge'   => 0,    // avec une marge  


//'fg_color'    => 0x33 // coloration du fond des cellules  

));  

$heading_pole  =& $workbook->addformat(array(  

'bold'    => 1,    // on met le texte en gras  

'color'   => 'blue', // de couleur noire  

'size'    => 12,    // de taille 12  

'merge'   => 0,    // avec une marge  
'align'   => 'left',    // avec une marge 

//'fg_color'    => 0x33 // coloration du fond des cellules  

));
$heading_l1  =& $workbook->addformat(array(  

'fg_color'    => 47, // coloration du fond des cellules  
'align'   => 'left',
));
$heading_l2  =& $workbook->addformat(array(  

'fg_color'    => 15 ,// coloration du fond des cellules  
'align'   => 'left', 
));
$heading_l12  =& $workbook->addformat(array(  

'fg_color'    => 47, // coloration du fond des cellules  
'align'   => 'left',
));
$heading_l21  =& $workbook->addformat(array(  

'fg_color'    => 15, // coloration du fond des cellules  
'align'   => 'left',
));

$format_date1  =& $workbook->addformat(array(  

'fg_color'    => 47, // coloration du fond des cellules  
'align'   => 'left',
));
$format_date2   =& $workbook->addformat(array(  

'fg_color'    => 15, // coloration du fond des cellules  
'align'   => 'left',
));

$heading_l12->set_num_format('0000');
$heading_l21->set_num_format('0000');

/*$format_date1->set_num_format('dd/mm/yy');
$format_date2->set_num_format('dd/mm/yy');*/
$worksheet->write("B5",'Pôle emploi : Gestion des bilans de prestation',$heading_pole);
$worksheet->write("B8",'Siret Mandataire',$heading_l1);
$worksheet->write("C8","44082666700014",$heading_l12);
$worksheet->write("B9",'Adresse mail (pour la gestion des retours)',$heading_l2);
$worksheet->write("C9",'presta@apsie.org',$heading_l2);
$worksheet->write("B10",'N° Marché',$heading_l1);
$worksheet->write("C10",'N0002',$heading_l1);
$worksheet->write("B11",'N° DE',$heading_l2);
$worksheet->write("C11",''.substr($this->identifiant_pole, 0, -1).'',$heading_l2);
$worksheet->write("B12",'N° de département de résidence du DE',$heading_l1);
$worksheet->write("C12",''.substr($this->code_postal_ben, 0, -3).'',$heading_l1);
$worksheet->write("B13",'Siret prestataire',$heading_l2);
$worksheet->write("C13",'35284977100039',$heading_l21);
$worksheet->write("B14",'N° LC',$heading_l1);
$worksheet->write("C14",''.$this->lalettre.'',$heading_l1);
$worksheet->write("B15",'Date de démarrage',$heading_l2);
$worksheet->write("C15",''.$this->date_debut_epce.'',$heading_l2);
$worksheet->write("B16",'Code Agence',$heading_l1);
$worksheet->write("C16",''.$this->code_safir.'',$heading_l1);
$worksheet->write("B17",'Type de prestation',$heading_l2);
$worksheet->write("C17",'EPCE',$heading_l2);
$worksheet->write("B18",'Date éventuelle d\'abandon',$heading_l1);
$worksheet->write("C18",'',$heading_l1);
$worksheet->write("A21",'Version 2.1',$heading_version);
//


$workbook->close();



header("Content-Type: application/excel; name=\"form_bilanprest.xls\"");
header("Content-Disposition: inline; filename=\"form_bilanprest.xls\"");
$fh=fopen($fname, "r");
$output=fread($fh, filesize($fname));
echo $output;

//$this->mail2("presta@apsie.org","bilans-prestation.061@poleemploi.extelia.fr",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);

/*$this->mail2("guillaume.merlateau-ext@pole-emploi.fr","bilans-prestation.061@poleemploi.extelia.fr",$sujet2,$sujet,$output,"form_bilanprest.xls",$this->form_base(),$account_email);*/

//$this->mail2("presta@apsie.org","drenault@apsie.org","Test2 FORM GED ( Version : .xls )","form_bilanprest.xls",$output,"","",$account_email);
//$this->mail2("presta@apsie.org","jeremy.passeron3@extelia.fr","form_bilanprest.xls(application/octet-stream -> application/vnd.ms-excel)","form_bilanprest.xls",$output,"","",$account_email);
/*$this->mail2("presta@apsie.org","presta@apsie.org","Test2 FORM GED","form_bilanprest.xls",$output,"","",$account_email);*/
/*$this->mail2("presta@apsie.org","guillaume.merlateau-ext@pole-emploi.fr","Test2 FORM GED ( Version : .xls )","form_bilanprest.xls",$output,"","",$account_email);
$this->mail2("presta@apsie.org","geraldine.germain-ext@pole-emploi.fr","Test2 FORM GED ( Version : .xls )","form_bilanprest.xls",$output,"","",$account_email);*/
return $output;
fpassthru($fh);


unlink($fname);



}
function date_fr_j($date_an)
	{
	
	//Voici les deux tableaux des jours et des mois traduits en français
$nom_jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
$mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
        "septembre", "octobre", "novembre", "décembre");
// on extrait la date du jour
list($nom_jour, $jour, $mois, $annee) = explode('/', $date_an);

 
//Affichera par exemple : "date du jour en français : samedi 24 juin 2006."
return  $nom_jour_fr[$nom_jour].' '.$jour.' '.$mois_fr[$mois].' '.$annee;
}

function _destruct()
	{
	mysql_close($this->db);
	}

}
?>