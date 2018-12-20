<?php

class nacre_evaluation
{
	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	/*public $db_user ="root";
	public $db_pass ="Tim.01Msqlv1";*/
	
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
	
	// Fonctions liées à la table coherence--------------------------------------------
	//Fonction d'insertion (coherence)	
	
	function inserer_coherence_hp($id, $id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta)
	{		
	
$requete3 = "insert into egw_nacre_coherence_hp value ('', '$id_beneficiaire','$exp_pro', '$exp_pro2', '$exp_pro3','$exp_pro4', '$exp_pro5', '$exp_pro6', '$comp_pro', '$comp_pro2', '$comp_pro3', '$comp_pro4', '$comp_pro5', '$comp_pro6', '$form_savoir', '$form_savoir2', '$form_savoir3', '$form_savoir4', '$form_savoir5','$form_savoir6', '$compet_acq', '$compet_acq2','$compet_acq3','$compet_acq4', '$delai_prior', '$delai_prior2', '$delai_prior3', '$delai_prior4','$type_form', '$type_form2', '$type_form3', '$type_form4', '$elem_port', '$elem_port2', '$elem_port3', '$elem_port4', '$pt_vigilance', '$pt_vigilance2', '$pt_vigilance3','$pt_vigilance4', '$id_presta')";


	$resultat3 = mysql_query($requete3) or die(mysql_error());
	}
	
	//Fonction de mise à jour (coherence)

	function update_coherence_hp($id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta)
	{
	$requete = "Update egw_nacre_coherence_hp set exp_pro='$exp_pro', exp_pro2='$exp_pro2', exp_pro3='$exp_pro3', exp_pro4='$exp_pro4', exp_pro5='$exp_pro5', exp_pro6='$exp_pro6', comp_pro='$comp_pro', comp_pro2='$comp_pro2', comp_pro3='$comp_pro3', comp_pro4='$comp_pro4', comp_pro5='$comp_pro5', comp_pro6='$comp_pro6', form_savoir='$form_savoir', form_savoir2='$form_savoir2', form_savoir3='$form_savoir3', form_savoir4='$form_savoir4', form_savoir5='$form_savoir5', form_savoir6='$form_savoir6', compet_acq='$compet_acq', compet_acq2='$compet_acq2', compet_acq3='$compet_acq3', compet_acq4='$compet_acq4', delai_prior='$delai_prior', delai_prior2='$delai_prior2', delai_prior3='$delai_prior3', delai_prior4='$delai_prior4', type_form='$type_form', type_form2='$type_form2', type_form3='$type_form3', type_form4='$type_form4', elem_port='$elem_port', elem_port2='$elem_port2', elem_port3='$elem_port3', elem_port4='$elem_port4', pt_vigilance='$pt_vigilance', pt_vigilance2='$pt_vigilance2', pt_vigilance3='$pt_vigilance3', pt_vigilance4='$pt_vigilance4', id_presta='$id_presta' where id_presta = $id_presta";
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	//Fonction de selection	(coherence)
	
	function variable_coherence($id_presta)
	{	
		$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
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
			$delai_prior=$row['delai_prior'];
			$delai_prior2=$row['delai_prior2'];
			$delai_prior3=$row['delai_prior3'];
			$delai_prior4=$row['delai_prior4'];
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
			$id_presta=$row['id_presta'];
		}
		
		return array($exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta);
			
	}
	
	//Fonction de vérification 'id_beneficiaire (coherence)
	
	//Vérification de l'id_beneficiaire dans la table cohérence_hp
	//Si il existe faire un mise à jours , sinon le créer
	
	
	function verif_beneficiaire_coherence_hp($id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5,$exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2,$form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta)
	
		{
		//1.select sur table cohérence_hp where id_beneficiare=id_beneficiaire
		//variable_coherence($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
		 $this->inserer_coherence_hp($id, $id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4,  $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta);
	
	}
	else
		{
		$this->update_coherence_hp($id_beneficiaire,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $id_presta);	
		}	
	
		}
		
	
	// Fonctions liées à la table aspect_commercial -------------------------------------------------
	// Fonction d'insertion (aspect_commercial)
		
		function inserer_aspect_commercial($id, $id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta)
	{
$requete = "insert into egw_nacre_aspect_commercial value ('', '$id_beneficiaire', '$analyse_besoin_client_pt_forts', '$analyse_besoin_client_pt_forts2', '$analyse_besoin_client_pt_forts3',  '$analyse_besoin_client_pt_forts4', '$analyse_besoin_client_pt_faible', '$analyse_besoin_client_pt_faible2', '$analyse_besoin_client_pt_faible3', '$analyse_besoin_client_pt_faible4', '$analyse_concurrence_pt_fort', '$analyse_concurrence_pt_fort2', '$analyse_concurrence_pt_fort3', '$analyse_concurrence_pt_fort4', '$analyse_concurrence_pt_faible', '$analyse_concurrence_pt_faible2', '$analyse_concurrence_pt_faible3', '$analyse_concurrence_pt_faible4', '$strategie_commerciale_envisagee_pt_fort', '$strategie_commerciale_envisagee_pt_fort2', '$strategie_commerciale_envisagee_pt_fort3', '$strategie_commerciale_envisagee_pt_fort4',  '$strategie_commerciale_envisagee_pt_faible', '$strategie_commerciale_envisagee_pt_faible2', '$strategie_commerciale_envisagee_pt_faible3', '$strategie_commerciale_envisagee_pt_faible4', '$autre_pt_fort', '$autre_pt_fort2', '$autre_pt_fort3', '$autre_pt_fort4', '$autre_pt_faible', '$autre_pt_faible2', '$autre_pt_faible3', '$autre_pt_faible4', '$action_a_mener1', '$action_a_mener2', '$action_a_mener3', '$action_a_mener4', '$delai_de_realisation1', '$delai_de_realisation2', '$delai_de_realisation3', '$delai_de_realisation4', '$resultat_attendus1', '$resultat_attendus2', '$resultat_attendus3',  '$resultat_attendus4', '$diagnostic', '$id_presta')";

	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	
	// Fonction de mise à jour (aspect commercial)
	
function update_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta)
	{
	$requete = "Update egw_nacre_aspect_commercial set  analyse_besoin_client_pt_forts='$analyse_besoin_client_pt_forts',  analyse_besoin_client_pt_forts2='$analyse_besoin_client_pt_forts2', analyse_besoin_client_pt_forts3='$analyse_besoin_client_pt_forts3', analyse_besoin_client_pt_forts4='$analyse_besoin_client_pt_forts4', analyse_besoin_client_pt_faible= '$analyse_besoin_client_pt_faible', analyse_besoin_client_pt_faible2= '$analyse_besoin_client_pt_faible2',  analyse_besoin_client_pt_faible3= '$analyse_besoin_client_pt_faible3', analyse_besoin_client_pt_faible4= '$analyse_besoin_client_pt_faible4', analyse_concurrence_pt_fort='$analyse_concurrence_pt_fort',   analyse_concurrence_pt_fort2='$analyse_concurrence_pt_fort2', analyse_concurrence_pt_fort3='$analyse_concurrence_pt_fort3', analyse_concurrence_pt_fort4='$analyse_concurrence_pt_fort4', analyse_concurrence_pt_faible='$analyse_concurrence_pt_faible',  analyse_concurrence_pt_faible2='$analyse_concurrence_pt_faible2', analyse_concurrence_pt_faible3='$analyse_concurrence_pt_faible3', analyse_concurrence_pt_faible4='$analyse_concurrence_pt_faible4', strategie_commerciale_envisagee_pt_fort='$strategie_commerciale_envisagee_pt_fort',  strategie_commerciale_envisagee_pt_fort2='$strategie_commerciale_envisagee_pt_fort2', strategie_commerciale_envisagee_pt_fort3='$strategie_commerciale_envisagee_pt_fort3', strategie_commerciale_envisagee_pt_fort4='$strategie_commerciale_envisagee_pt_fort4', strategie_commerciale_envisagee_pt_faible='$strategie_commerciale_envisagee_pt_faible', strategie_commerciale_envisagee_pt_faible2='$strategie_commerciale_envisagee_pt_faible2', strategie_commerciale_envisagee_pt_faible3='$strategie_commerciale_envisagee_pt_faible3', strategie_commerciale_envisagee_pt_faible4='$strategie_commerciale_envisagee_pt_faible4', autre_pt_fort='$autre_pt_fort', autre_pt_fort2='$autre_pt_fort2', autre_pt_fort3='$autre_pt_fort3', autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2', autre_pt_faible3='$autre_pt_faible3', autre_pt_faible4='$autre_pt_faible4', action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2',  delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic', id_presta='$id_presta' where id_presta = $id_presta";
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	// Fonction de sélection (aspect_commercial)
	
	function variable_aspect_commercial($id_presta)
	{	
		$requete='SELECT * FROM  egw_nacre_aspect_commercial where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_forts=$row['analyse_besoin_client_pt_forts'];
			$analyse_besoin_client_pt_forts2=$row['analyse_besoin_client_pt_forts2'];
			$analyse_besoin_client_pt_forts3=$row['analyse_besoin_client_pt_forts3'];
			$analyse_besoin_client_pt_forts4=$row['analyse_besoin_client_pt_forts4'];
			$analyse_besoin_client_pt_faible=$row['analyse_besoin_client_pt_faible'];
			$analyse_besoin_client_pt_faible2=$row['analyse_besoin_client_pt_faible2'];
			$analyse_besoin_client_pt_faible3=$row['analyse_besoin_client_pt_faible3'];
			$analyse_besoin_client_pt_faible4=$row['analyse_besoin_client_pt_faible4'];			
			$analyse_concurrence_pt_fort=$row['analyse_concurrence_pt_fort'];
			$analyse_concurrence_pt_fort2=$row['analyse_concurrence_pt_fort2'];
			$analyse_concurrence_pt_fort3=$row['analyse_concurrence_pt_fort3'];
			$analyse_concurrence_pt_fort4=$row['analyse_concurrence_pt_fort4'];
			$analyse_concurrence_pt_faible=$row['analyse_concurrence_pt_faible'];
			$analyse_concurrence_pt_faible2=$row['analyse_concurrence_pt_faible2'];
			$analyse_concurrence_pt_faible3=$row['analyse_concurrence_pt_faible3'];
			$analyse_concurrence_pt_faible4=$row['analyse_concurrence_pt_faible4'];			
			$strategie_commerciale_envisagee_pt_fort=$row['strategie_commerciale_envisagee_pt_fort'];
			$strategie_commerciale_envisagee_pt_fort2=$row['strategie_commerciale_envisagee_pt_fort2'];
			$strategie_commerciale_envisagee_pt_fort3=$row['strategie_commerciale_envisagee_pt_fort3'];
			$strategie_commerciale_envisagee_pt_fort4=$row['strategie_commerciale_envisagee_pt_fort4'];			
			$strategie_commerciale_envisagee_pt_faible=$row['strategie_commerciale_envisagee_pt_faible'];
			$strategie_commerciale_envisagee_pt_faible2=$row['strategie_commerciale_envisagee_pt_faible2'];
			$strategie_commerciale_envisagee_pt_faible3=$row['strategie_commerciale_envisagee_pt_faible3'];
			$strategie_commerciale_envisagee_pt_faible4=$row['strategie_commerciale_envisagee_pt_faible4'];
			$autre_pt_fort=$row['autre_pt_fort'];
			$autre_pt_fort2=$row['autre_pt_fort2'];
			$autre_pt_fort3=$row['autre_pt_fort3'];
			$autre_pt_fort4=$row['autre_pt_fort4'];
			$autre_pt_faible=$row['autre_pt_faible'];
			$autre_pt_faible2=$row['autre_pt_faible2'];
			$autre_pt_faible3=$row['autre_pt_faible3'];
			$autre_pt_faible4=$row['autre_pt_faible4'];
			$action_a_mener1=$row['action_a_mener1'];
			$action_a_mener2=$row['action_a_mener2'];
			$action_a_mener3=$row['action_a_mener3'];
			$action_a_mener4=$row['action_a_mener4'];
			$delai_de_realisation1=$row['delai_de_realisation1'];
			$delai_de_realisation2=$row['delai_de_realisation2'];
			$delai_de_realisation3=$row['delai_de_realisation3'];
			$delai_de_realisation4=$row['delai_de_realisation4'];
			$resultat_attendus1=$row['resultat_attendus1'];
			$resultat_attendus2=$row['resultat_attendus2'];
			$resultat_attendus3=$row['resultat_attendus3'];
			$resultat_attendus4=$row['resultat_attendus4'];
			$diagnostic=$row['diagnostic'];
			$id_presta=$row['id_presta'];
		}
		
		return array($analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta);
			
	}
	
	
	//Fonction de vérification 'id_beneficiaire (aspect_commercial)
	
	//Vérification de l'id_beneficiaire dans la table aspect_commercial
	//Si il existe faire une mise à jour , sinon le créer
	
	function verif_beneficiaire_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta)
	
		{
		//1.select sur table aspect_commercial where id_beneficiare=id_beneficiaire
		//variable_aspect_commercial($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_aspect_commercial where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
		 $this->inserer_aspect_commercial($id, $id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta);
	
	}
	else
		{
		$this->update_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta);	
		}	
	
		}
	
	
	//Fonctions liées à la table aspect_financier-------------------------------------------------
	//Fonction d'insertion (aspect_financier)
	
	function inserer_aspect_financier($id, $id_beneficiaire, $apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	{
			
	$requete3 = "insert into egw_nacre_aspect_financier value ('', '$id_beneficiaire', '$apport_pt_forts', '$apport_pt_forts2', '$apport_pt_forts3', '$apport_pt_forts4', '$apportt_pt_faible', '$apportt_pt_faible2', '$apportt_pt_faible3', '$apportt_pt_faible4', '$calcul_pt_fort', '$calcul_pt_fort2', '$calcul_pt_fort3', '$calcul_pt_fort4', '$calcul_pt_faible', '$calcul_pt_faible2', '$calcul_pt_faible3', '$calcul_pt_faible4', '$plan_initial_pt_fort', '$plan_initial_pt_fort2', '$plan_initial_pt_fort3', '$plan_initial_pt_fort4', '$plan_initial_pt_faible', '$plan_initial_pt_faible2', '$plan_initial_pt_faible3', '$plan_initial_pt_faible4', '$plan_trois_ans_pt_fort', '$plan_trois_ans_pt_fort2', '$plan_trois_ans_pt_fort3', '$plan_trois_ans_pt_fort4', '$plan_trois_ans_pt_faible', '$plan_trois_ans_pt_faible2', '$plan_trois_ans_pt_faible3', '$plan_trois_ans_pt_faible4', '$autre_pt_fort', '$autre_pt_fort2', '$autre_pt_fort3', '$autre_pt_fort4', '$autre_pt_faible',  '$autre_pt_faible2', '$autre_pt_faible3', '$autre_pt_faible4', '$action_a_mener1', '$action_a_mener2', '$action_a_mener3', '$action_a_mener4', '$delai_de_realisation1', '$delai_de_realisation2', '$delai_de_realisation3', '$delai_de_realisation4', '$resultat_attendus1', '$resultat_attendus2', '$resultat_attendus3', '$resultat_attendus4', '$diagnostic', '$id_presta')";
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	}
	
	//Fonction de mise à jour (aspect_financier)
	
function update_aspect_financier($id_beneficiaire, $apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	{
	$requete = "Update egw_nacre_aspect_financier set apport_pt_forts='$apport_pt_forts', apport_pt_forts2='$apport_pt_forts2', apport_pt_forts3='$apport_pt_forts3', apport_pt_forts4='$apport_pt_forts4', apportt_pt_faible='$apportt_pt_faible', apportt_pt_faible2='$apportt_pt_faible2', apportt_pt_faible3='$apportt_pt_faible3', apportt_pt_faible4='$apportt_pt_faible4', calcul_pt_fort='$calcul_pt_fort', calcul_pt_fort2='$calcul_pt_fort2', calcul_pt_fort3='$calcul_pt_fort3', calcul_pt_fort4='$calcul_pt_fort4', calcul_pt_faible='$calcul_pt_faible', calcul_pt_faible2='$calcul_pt_faible2', calcul_pt_faible3='$calcul_pt_faible3', calcul_pt_faible4='$calcul_pt_faible4', plan_initial_pt_fort='$plan_initial_pt_fort', plan_initial_pt_fort2='$plan_initial_pt_fort2',  plan_initial_pt_fort3='$plan_initial_pt_fort3', plan_initial_pt_fort4='$plan_initial_pt_fort4', plan_initial_pt_faible='$plan_initial_pt_faible', plan_initial_pt_faible2='$plan_initial_pt_faible2', plan_initial_pt_faible3='$plan_initial_pt_faible3', plan_initial_pt_faible4='$plan_initial_pt_faible4', plan_trois_ans_pt_fort='$plan_trois_ans_pt_fort', plan_trois_ans_pt_fort2='$plan_trois_ans_pt_fort2', plan_trois_ans_pt_fort3='$plan_trois_ans_pt_fort3', plan_trois_ans_pt_fort4='$plan_trois_ans_pt_fort4', plan_trois_ans_pt_faible='$plan_trois_ans_pt_faible', plan_trois_ans_pt_faible2='$plan_trois_ans_pt_faible2', plan_trois_ans_pt_faible3='$plan_trois_ans_pt_faible3', plan_trois_ans_pt_faible4='$plan_trois_ans_pt_faible4', autre_pt_fort='$autre_pt_fort', autre_pt_fort2='$autre_pt_fort2', autre_pt_fort3='$autre_pt_fort3',  autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2', autre_pt_faible3='$autre_pt_faible3', autre_pt_faible4='$autre_pt_faible4', action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2', delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic', id_presta='$id_presta' where id_presta=$id_presta";
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	//Fonction de sélection (aspect_financier)
	
	function variable_aspect_financier($id_presta)
	{	
		$requete='SELECT * FROM  egw_nacre_aspect_financier  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
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
			$action_a_mener1=$row['action_a_mener1'];
			$action_a_mener2=$row['action_a_mener2'];
			$action_a_mener3=$row['action_a_mener3'];
			$action_a_mener4=$row['action_a_mener4'];
			$delai_de_realisation1=$row['delai_de_realisation1'];
			$delai_de_realisation2=$row['delai_de_realisation2'];
			$delai_de_realisation3=$row['delai_de_realisation3'];
			$delai_de_realisation4=$row['delai_de_realisation4'];
			$resultat_attendus1=$row['resultat_attendus1'];
			$resultat_attendus2=$row['resultat_attendus2'];
			$resultat_attendus3=$row['resultat_attendus3'];
			$resultat_attendus4=$row['resultat_attendus4'];
			$diagnostic=$row['diagnostic'];
			$id_presta=$row['id_presta'];
		}
		
		return array($apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);
			
	}
	
	//Fonction de vérification 'id_beneficiaire (aspect_financier)
	
	//Vérification de l'id_beneficiaire dans la table aspect_financier
	//Si il existe faire une mise à jour , sinon le créer
	
	function verif_beneficiaire_aspect_financier($id_beneficiaire, $apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	
		{
		//1.select sur table aspect_financier where id_beneficiare=id_beneficiaire
		//aspect_financier($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_aspect_financier where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
		 $this->inserer_aspect_financier($id, $id_beneficiaire, $apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);
	
	}
	else
		{
		$this->update_aspect_financier($id_beneficiaire, $apport_pt_forts, $apport_pt_forts2, $apport_pt_forts3, $apport_pt_forts4, $apportt_pt_faible, $apportt_pt_faible2, $apportt_pt_faible3, $apportt_pt_faible4, $calcul_pt_fort, $calcul_pt_fort2, $calcul_pt_fort3, $calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort, $plan_initial_pt_fort2, $plan_initial_pt_fort3, $plan_initial_pt_fort4, $plan_initial_pt_faible, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_fort2, $plan_trois_ans_pt_fort3, $plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible, $plan_trois_ans_pt_faible2, $plan_trois_ans_pt_faible3, $plan_trois_ans_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible,  $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);	
		}	
	
		}
	
	//Fonctions liées à la table forme_juridique----------------------------------------------------
	//Fonction d'insertion (forme_juridique)
	
	
	function inserer_forme_juridique($id, $id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible,$pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	{
		
//exemple	

	$requete3 = "insert into egw_nacre_forme_juridique value ('', '$id_beneficiaire', '$pt_fort', '$pt_fort2', '$pt_fort3', '$pt_fort4', '$pt_faible', '$pt_faible2', '$pt_faible3', '$pt_faible4', '$action_mener1', '$action_mener2', '$action_mener3',	'$action_mener4', '$delai_realisation1', '$delai_realisation2', '$delai_realisation3', '$delai_realisation4', '$resultat_attendus1', '$resultat_attendus2', '$resultat_attendus3', '$resultat_attendus4', '$diagnostic', '$id_presta')";
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	}
	
	//Fonction de mise à jour (forme_juridique)
	
	function update_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible,$pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	{
	$requete = "Update egw_nacre_forme_juridique set pt_fort='$pt_fort', pt_fort2='$pt_fort2', pt_fort3='$pt_fort3', pt_fort4='$pt_fort4', pt_faible='$pt_faible', pt_faible2='$pt_faible2', pt_faible3='$pt_faible3', pt_faible4='$pt_faible4', action_mener1='$action_mener1', action_mener2='$action_mener2', action_mener3='$action_mener3', action_mener4='$action_mener4', delai_realisation1='$delai_realisation1', delai_realisation2='$delai_realisation2', delai_realisation3='$delai_realisation3', delai_realisation4='$delai_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic', id_presta='$id_presta' where id_presta=$id_presta";
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	//Fonction de sélection (forme_juridique)
	
		function variable_forme_juridique($id_presta)
	{	
		$requete='SELECT * FROM  egw_nacre_forme_juridique where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort=$row['pt_fort'];
			$pt_fort2=$row['pt_fort2'];
			$pt_fort3=$row['pt_fort3'];
			$pt_fort4=$row['pt_fort4'];
			$pt_faible=$row['pt_faible'];
			$pt_faible2=$row['pt_faible2'];
			$pt_faible3=$row['pt_faible3'];
			$pt_faible4=$row['pt_faible4'];			
			$action_mener1=$row['action_mener1'];			
			$action_mener2=$row['action_mener2'];
			$action_mener3=$row['action_mener3'];
			$action_mener4=$row['action_mener4'];
			$delai_realisation1=$row['delai_realisation1'];
			$delai_realisation2=$row['delai_realisation2'];
			$delai_realisation3=$row['delai_realisation3'];
			$delai_realisation4=$row['delai_realisation4'];
			$resultat_attendus1=$row['resultat_attendus1'];
			$resultat_attendus2=$row['resultat_attendus2'];
			$resultat_attendus3=$row['resultat_attendus3'];
			$resultat_attendus4=$row['resultat_attendus4'];
			$diagnostic=$row['diagnostic'];
			$id_presta=$row['id_presta'];
		}
		
		return array($pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);
			
	}
	
	//Fonction de vérification 'id_beneficiaire (forme_juridique)
	
	//Vérification de l'id_beneficiaire dans la table forme_juridique
	//Si il existe faire une mise à jour , sinon le créer
	
	function verif_beneficiaire_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta)
	
		{
		//1.select sur table forme_juridique where id_presta=id_presta
		//forme_juridique($id_presta);
		
		$requete='SELECT * FROM  egw_nacre_forme_juridique where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
		 $this->inserer_forme_juridique($id, $id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);
	
	}
	else
		{
		$this->update_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic, $id_presta);	
		}	
	
		}
		
		
	
	//--------------------------------------------------------------
	
	/*//Fonction de validation
	
	function validation_epce($id, $id_beneficiaire, $validation)
	{
		$requete = "insert into egw_nacre_validation value ('','$id_beneficiaire','$validation')";
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