<?php
class nacre_evaluation
{
	/*public $db_user ="root";
	public $db_pass ="";
	public $db_host ="localhost";
	public $db_name ="lea";*/
public $db_host ="localhost";
	public $db_name ="egw_apsie143";
	public $db_user ="egw_apsie";
	//public $db_pass ="Spirea237Apsie";
        public $db_pass ="APS12/APS12";
	public $db;
	function __construct()
	{
		
// on se connecte � MySQL
//$db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on s�lectionne la base
//mysql_select_db(''.$this->db_name.'',$db); 	

	//unset($db);
	//include('config/config.php');
        
         include('/data/html/egw_apsie_143/Classes/config/config.php');
     $this->db=$db;
	}
	
		public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	// Fonctions li�es � la table coherence--------------------------------------------
	//Fonction d'insertion (coherence)	
	
	function inserer_coherence_hp($id, $id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4,$diagnostic, $id_presta)
	{		
	
/*$requete3 = "insert into egw_nacre_coherence_hp value ('', '$id_beneficiaire','$exp_pro', '$exp_pro2', '$exp_pro3','$exp_pro4', '$exp_pro5', '$exp_pro6', '$comp_pro', '$comp_pro2', '$comp_pro3', '$comp_pro4', '$comp_pro5', '$comp_pro6', '$form_savoir', '$form_savoir2', '$form_savoir3', '$form_savoir4', '$form_savoir5','$form_savoir6', '$compet_acq', '$compet_acq2','$compet_acq3','$compet_acq4', '$delai_prior', '$delai_prior2', '$delai_prior3', '$delai_prior4','$type_form', '$type_form2', '$type_form3', '$type_form4', '$elem_port', '$elem_port2', '$elem_port3', '$elem_port4', '$pt_vigilance', '$pt_vigilance2', '$pt_vigilance3','$pt_vigilance4','$diagnostic', '$id_presta')";


	$resultat3 = mysql_query($requete3) or die(mysql_error());*/
		$data['exp_pro'] = $exp_pro;
$data['exp_pro2'] = $exp_pro2;
$data['exp_pro3'] = $exp_pro3;
$data['exp_pro4'] = $exp_pro4;
$data['exp_pro5'] = $exp_pro5;
$data['exp_pro6'] = $exp_pro6;
$data['comp_pro'] = $comp_pro;
$data['comp_pro2'] = $comp_pro2;
$data['comp_pro3'] = $comp_pro3;
$data['comp_pro4'] = $comp_pro4;
$data['comp_pro5'] = $comp_pro5;
$data['comp_pro6'] = $comp_pro6;
$data['form_savoir'] = $form_savoir;
$data['form_savoir2'] = $form_savoir2;
$data['form_savoir3'] = $form_savoir3;
$data['form_savoir4'] = $form_savoir4;
$data['form_savoir5'] = $form_savoir5;
$data['form_savoir6'] = $form_savoir6;
$data['compet_acq'] = $compet_acq;
$data['compet_acq2'] = $compet_acq2;
$data['compet_acq3'] = $compet_acq3;
$data['compet_acq4'] = $compet_acq4;
$data['delai_prior'] = $delai_prior;
$data['delai_prior2'] = $delai_prior2;
$data['delai_prior3'] = $delai_prior3;
$data['delai_prior4'] = $delai_prior4;
$data['type_form'] = $type_form;
$data['type_form2'] = $type_form2;
$data['type_form3'] = $type_form3;
$data['type_form4'] = $type_form4;
$data['elem_port'] = $elem_port;
$data['elem_port2'] = $elem_port2;
$data['elem_port3'] = $elem_port3;
$data['elem_port4'] = $elem_port4;
$data['pt_vigilance'] = $pt_vigilance;
$data['pt_vigilance2'] = $pt_vigilance2;
$data['pt_vigilance3'] = $pt_vigilance3;
$data['pt_vigilance4'] = $pt_vigilance4;
$data['diagnostic'] = $diagnostic;
$data['id_presta'] = $id_presta;
$data['id_beneficiaire'] = $id_beneficiaire;
//$requete = "insert into egw_epce_coherence_hp value ('', '$id_beneficiaire','$exp_pro', '$exp_pro2', '$exp_pro3','$exp_pro4', '$exp_pro5', '$exp_pro6', '$comp_pro', '$comp_pro2', '$comp_pro3', '$comp_pro4', '$comp_pro5', '$comp_pro6', '$form_savoir', '$form_savoir2', '$form_savoir3', '$form_savoir4', '$form_savoir5','$form_savoir6', '$compet_acq', '$compet_acq2','$compet_acq3','$compet_acq4', '$delai_prior', '$delai_prior2', '$delai_prior3', '$delai_prior4','$type_form', '$type_form2', '$type_form3', '$type_form4', '$elem_port', '$elem_port2', '$elem_port3', '$elem_port4', '$pt_vigilance', '$pt_vigilance2', '$pt_vigilance3','$pt_vigilance4','$diagnostic','$id_presta')";
$this->db->insert('egw_nacre_coherence_hp',$data);
	}
	
	//Fonction de mise � jour (coherence)

	function update_coherence_hp($id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4,$diagnostic, $id_presta)
	{
	/*$requete = "Update egw_nacre_coherence_hp set exp_pro='$exp_pro', exp_pro2='$exp_pro2', exp_pro3='$exp_pro3', exp_pro4='$exp_pro4', exp_pro5='$exp_pro5', exp_pro6='$exp_pro6', comp_pro='$comp_pro', comp_pro2='$comp_pro2', comp_pro3='$comp_pro3', comp_pro4='$comp_pro4', comp_pro5='$comp_pro5', comp_pro6='$comp_pro6', form_savoir='$form_savoir', form_savoir2='$form_savoir2', form_savoir3='$form_savoir3', form_savoir4='$form_savoir4', form_savoir5='$form_savoir5', form_savoir6='$form_savoir6', compet_acq='$compet_acq', compet_acq2='$compet_acq2', compet_acq3='$compet_acq3', compet_acq4='$compet_acq4', delai_prior='$delai_prior', delai_prior2='$delai_prior2', delai_prior3='$delai_prior3', delai_prior4='$delai_prior4', type_form='$type_form', type_form2='$type_form2', type_form3='$type_form3', type_form4='$type_form4', elem_port='$elem_port', elem_port2='$elem_port2', elem_port3='$elem_port3', elem_port4='$elem_port4', pt_vigilance='$pt_vigilance', pt_vigilance2='$pt_vigilance2', pt_vigilance3='$pt_vigilance3', pt_vigilance4='$pt_vigilance4',diagnostic='$diagnostic' , id_presta='$id_presta' where id_beneficiaire = $id_beneficiaire";
	
	$resultat = mysql_query($requete) or die(mysql_error());*/
		$data['exp_pro'] = $exp_pro;
$data['exp_pro2'] = $exp_pro2;
$data['exp_pro3'] = $exp_pro3;
$data['exp_pro4'] = $exp_pro4;
$data['exp_pro5'] = $exp_pro5;
$data['exp_pro6'] = $exp_pro6;
$data['comp_pro'] = $comp_pro;
$data['comp_pro2'] = $comp_pro2;
$data['comp_pro3'] = $comp_pro3;
$data['comp_pro4'] = $comp_pro4;
$data['comp_pro5'] = $comp_pro5;
$data['comp_pro6'] = $comp_pro6;
$data['form_savoir'] = $form_savoir;
$data['form_savoir2'] = $form_savoir2;
$data['form_savoir3'] = $form_savoir3;
$data['form_savoir4'] = $form_savoir4;
$data['form_savoir5'] = $form_savoir5;
$data['form_savoir6'] = $form_savoir6;
$data['compet_acq'] = $compet_acq;
$data['compet_acq2'] = $compet_acq2;
$data['compet_acq3'] = $compet_acq3;
$data['compet_acq4'] = $compet_acq4;
$data['delai_prior'] = $delai_prior;
$data['delai_prior2'] = $delai_prior2;
$data['delai_prior3'] = $delai_prior3;
$data['delai_prior4'] = $delai_prior4;
$data['type_form'] = $type_form;
$data['type_form2'] = $type_form2;
$data['type_form3'] = $type_form3;
$data['type_form4'] = $type_form4;
$data['elem_port'] = $elem_port;
$data['elem_port2'] = $elem_port2;
$data['elem_port3'] = $elem_port3;
$data['elem_port4'] = $elem_port4;
$data['pt_vigilance'] = $pt_vigilance;
$data['pt_vigilance2'] = $pt_vigilance2;
$data['pt_vigilance3'] = $pt_vigilance3;
$data['pt_vigilance4'] = $pt_vigilance4;
$data['diagnostic'] = $diagnostic;
$data['id_presta'] = $id_presta;
//$requete = "insert into egw_epce_coherence_hp value ('', '$id_beneficiaire','$exp_pro', '$exp_pro2', '$exp_pro3','$exp_pro4', '$exp_pro5', '$exp_pro6', '$comp_pro', '$comp_pro2', '$comp_pro3', '$comp_pro4', '$comp_pro5', '$comp_pro6', '$form_savoir', '$form_savoir2', '$form_savoir3', '$form_savoir4', '$form_savoir5','$form_savoir6', '$compet_acq', '$compet_acq2','$compet_acq3','$compet_acq4', '$delai_prior', '$delai_prior2', '$delai_prior3', '$delai_prior4','$type_form', '$type_form2', '$type_form3', '$type_form4', '$elem_port', '$elem_port2', '$elem_port3', '$elem_port4', '$pt_vigilance', '$pt_vigilance2', '$pt_vigilance3','$pt_vigilance4','$diagnostic','$id_presta')";
$this->db->update('egw_nacre_coherence_hp',$data,'id_beneficiaire='.$id_beneficiaire);
	}
	
	//Fonction de selection	(coherence)
	
	function variable_coherence($id_presta,$id_ben)
	{	
	
	 $requete='SELECT * FROM  egw_nacre_coherence_hp  where id_beneficiaire='.$id_ben.' order by id desc limit 1';
	$resultat = mysql_query($requete) or die(mysql_error());
		
		if(mysql_num_rows($resultat)<=1)
		{
				$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_beneficiaire='.$id_ben.' order by id desc limit 1';
		
		}
		else
		{
			$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_presta='.$id_presta.' order by id desc limit 1';
	
		}
		
	
   
	

	
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
			$diagnostic=$row['diagnostic'];
			$id_presta=$row['id_presta'];
		}
		
		return array($exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4, $diagnostic,$id_presta);
			
	}
	
	//Fonction de v�rification 'id_beneficiaire (coherence)
	
	//V�rification de l'id_beneficiaire dans la table coh�rence_hp
	//Si il existe faire un mise � jours , sinon le cr�er
	
	
	function verif_beneficiaire_coherence_hp($id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5,$exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2,$form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4,$diagnostic, $id_presta)
	
		{
				
			//////////////////////////////////// RECHERCHE DANS LA BANQUE DE TEXTE ////////////////////////////////////////////
				
		if(is_numeric($comp_pro)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro=$row['valeur'];
			$comp_pro_=addslashes($comp_pro);
		}
		
		}
			else
		{$comp_pro_=$comp_pro;
		}
		
		if(is_numeric($exp_pro)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$exp_pro.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$exp_pro=$row['valeur'];
			$exp_pro_=addslashes($exp_pro);
		}
		
		}
			else
		{$exp_pro_=$exp_pro;
		}
		
		
		
		if(is_numeric($comp_pro2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro2=$row['valeur'];
			$comp_pro2_=addslashes($comp_pro2);
		}
		
			
		}
	 
	 	else
		{$comp_pro2_=$comp_pro2;
		}
		
		if(is_numeric($comp_pro3)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro3=$row['valeur'];
			$comp_pro3_=addslashes($comp_pro3);
		}
		}
			else
		{$comp_pro3_=$comp_pro3;
		}
		
		if(is_numeric($comp_pro4)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro4=$row['valeur'];
			$comp_pro4_=addslashes($comp_pro4);
		}
		}
		else
		{$comp_pro4_=$comp_pro4;
		}
		
		if(is_numeric($comp_pro5)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro5.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro5=$row['valeur'];
			$comp_pro5_=addslashes($comp_pro5);
		}
		}
		else
		{$comp_pro5_=$comp_pro5;
		}
		
		if(is_numeric($comp_pro6)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$comp_pro6.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$comp_pro6=$row['valeur'];
			$comp_pro6_=addslashes($comp_pro6);
			
		}
		}
		else
		{$comp_pro6_=$comp_pro6;
		}
		
			if(is_numeric($form_savoir)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir=$row['valeur'];
			$form_savoir_=addslashes($form_savoir);
		}
		
		}
		else
		{$form_savoir_=$form_savoir;
		}
		
		
		if(is_numeric($form_savoir2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir2=$row['valeur'];
			$form_savoir2_=addslashes($form_savoir2);
		}
		
			
		}
		else
		{$form_savoir2_=$form_savoir2;
		}
		
	 
	 
		if(is_numeric($form_savoir3)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir3=$row['valeur'];
			$form_savoir3_=addslashes($form_savoir3);
		}
		}
		else
		{$form_savoir3_=$form_savoir3;
		}
		
		if(is_numeric($form_savoir4)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir4=$row['valeur'];
			$form_savoir4_=addslashes($form_savoir4);
		}
		}
		else
		{$form_savoir4_=$form_savoir4;
		}
		
		if(is_numeric($form_savoir5)==true)
		
		{
		
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir5.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir5=$row['valeur'];
			$form_savoir5_=addslashes($form_savoir5);
		}
		}
		else
		{$form_savoir5_=$form_savoir5;
		}
		
		if(is_numeric($form_savoir6)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$form_savoir6.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$form_savoir6=$row['valeur'];
			$form_savoir6_=addslashes($form_savoir6);
		}
		}
		else
		{$form_savoir6_=$form_savoir6;
		}
		
			if(is_numeric($compet_acq)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$compet_acq.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$compet_acq=$row['valeur'];
			$compet_acq_=addslashes($compet_acq);
		}
		
		}
		else
		{$compet_acq_=$compet_acq;
		}
		
		if(is_numeric($compet_acq2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$compet_acq2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$compet_acq2=$row['valeur'];
			$compet_acq2_=addslashes($compet_acq2);
		}
		
			
		}
	 else
		{$compet_acq2_=$compet_acq2;
		}
	 
		if(is_numeric($compet_acq3)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$compet_acq3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$compet_acq3=$row['valeur'];
			$compet_acq3_=addslashes($compet_acq3);
		}
		}
		else
		{$compet_acq3_=$compet_acq3;
		}
		if(is_numeric($compet_acq4)==true)
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$compet_acq4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$compet_acq4=$row['valeur'];
			$compet_acq4_=addslashes($compet_acq4);
		}
		}
		else
		{$compet_acq4_=$compet_acq4;
		}
	
				
				if(is_numeric($delai_prior)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_prior.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_prior=$row['valeur'];
			$delai_prior_=addslashes($delai_prior);
		}
		
		}
		else
		{$delai_prior_=$delai_prior;
		}
	
		
		if(is_numeric($delai_prior2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_prior2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$delai_prior2=$row['valeur'];
			$delai_prior2_=addslashes($delai_prior2);
		}
		
			
		}
	 else
		{$delai_prior2_=$delai_prior2;
		}
	
	 
		if(is_numeric($delai_prior3)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_prior3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_prior3=$row['valeur'];
			$delai_prior3_=addslashes($delai_prior3);
		}
		}
		else
		{$delai_prior3_=$delai_prior3;
		}
	
		if(is_numeric($delai_prior4)==true)
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_prior4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_prior4=$row['valeur'];
			$delai_prior4_=addslashes($delai_prior4);
		}
		}
		
		else
		{$delai_prior4_=$delai_prior4;
		}
	
		
				if(is_numeric($elem_port)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$elem_port.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$elem_port=$row['valeur'];
			$elem_port_=addslashes($elem_port);
		}
		
		}
		else
		{$elem_port_=$elem_port;
		}
	
		
		if(is_numeric($elem_port2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$elem_port2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$elem_port2=$row['valeur'];
			$elem_port2_=addslashes($elem_port2);
		}
		
			
		}
	 else
		{$elem_port2_=$elem_port2;
		}
	
	 
		if(is_numeric($elem_port3)==true)
		
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$elem_port3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$elem_port3=$row['valeur'];
			$elem_port3_=addslashes($elem_port3);
		}
		}
		else
		{$elem_port3_=$elem_port3;
		}
	
		if(is_numeric($elem_port4)==true)
		{
	 
		$requete='SELECT * FROM  egw_epce_texte where id='.$elem_port4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$elem_port4=$row['valeur'];
			$elem_port4_=addslashes($elem_port4);
			
		}
		}
		else
		{$elem_port4_=$elem_port4;
		}
	
		
			if(is_numeric($type_form)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$type_form.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$type_form=$row['valeur'];
			$type_form_=addslashes($type_form);
			
		}
		}
		else
		{$type_form_=$type_form;
		}
	
		
			if(is_numeric($type_form2)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$type_form2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$type_form2=$row['valeur'];
			$type_form2_=addslashes($type_form2);
			
		}
		}
		else
		{$type_form2_=$type_form2;
		}
	
		
		if(is_numeric($type_form3)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$type_form3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$type_form3=$row['valeur'];
			$type_form3_=addslashes($type_form3);
			
		}
		}
		else
		{$type_form3_=$type_form3;
		}
	
		if(is_numeric($type_form4)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$type_form4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$type_form4=$row['valeur'];
			$type_form4_=addslashes($type_form4);
			
		}
		}
		else
		{$type_form4_=$type_form4;
		}
	
		
			if(is_numeric($pt_vigilance)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_vigilance.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_vigilance=$row['valeur'];
			$pt_vigilance_=addslashes($pt_vigilance);
		
		}
		}
		else
		{$pt_vigilance_=$pt_vigilance;
		}
	
		
			if(is_numeric($pt_vigilance2)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_vigilance2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_vigilance2=$row['valeur'];
			$pt_vigilance2_=addslashes($pt_vigilance2);
		
		}
		}
		else
		{$pt_vigilance2_=$pt_vigilance2;
		}
	
		if(is_numeric($pt_vigilance3)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_vigilance3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_vigilance3=$row['valeur'];
			$pt_vigilance3_=addslashes($pt_vigilance3);
			
		}
		}
		else
		{$pt_vigilance3_=$pt_vigilance3;
		}
	
		if(is_numeric($pt_vigilance4)==true)
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_vigilance4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_vigilance4=$row['valeur'];
			$pt_vigilance4_=addslashes($pt_vigilance4);
			
		}
		}
		else
		{$pt_vigilance4_=$pt_vigilance4;
		}
	
		
			//////////////////////////////////// RECHERCHE DANS LA BANQUE DE TEXTE ////////////////////////////////////////////
			
			
			
		//1.select sur table coh�rence_hp where id_beneficiare=id_beneficiaire
		//variable_coherence($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_beneficiaire='.$id_beneficiaire.'';
		//$requete='SELECT * FROM  egw_nacre_coherence_hp  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$nbr=mysql_num_rows($resultat);
		if ($nbr==0)
		{
			
		/*	$pt_vigilance2=addslashes($pt_vigilance2);
		$pt_vigilance3=addslashes($pt_vigilance3);
		$pt_vigilance4=addslashes($pt_vigilance4);
			$pt_vigilance=addslashes($pt_vigilance);
$type_form4=addslashes($type_form4);
$type_form3=addslashes($type_form3);
$type_form2=addslashes($type_form2);
$type_form=addslashes($type_form);
$elem_port4=addslashes($elem_port4);
$elem_port3=addslashes($elem_port3);
$elem_port2=addslashes($elem_port2);
$elem_port=addslashes($elem_port);
$delai_prior4=addslashes($delai_prior4);
$delai_prior3=addslashes($delai_prior3);
$delai_prior2=addslashes($delai_prior2);
$delai_prior=addslashes($delai_prior);
$compet_acq4=addslashes($compet_acq4);
$compet_acq3=addslashes($compet_acq3);
$compet_acq2=addslashes($compet_acq2);
$compet_acq=addslashes($compet_acq);
$form_savoir6=addslashes($form_savoir6);
	$form_savoir5=addslashes($form_savoir5);
$form_savoir4=addslashes($form_savoir4);
$form_savoir3=addslashes($form_savoir3);
$form_savoir2=addslashes($form_savoir2);
$form_savoir=addslashes($form_savoir);
$comp_pro6=addslashes($comp_pro6);
$comp_pro5=addslashes($comp_pro5);
$comp_pro4=addslashes($comp_pro4);
$comp_pro3=addslashes($comp_pro3);
$comp_pro2=addslashes($comp_pro2);
	$comp_pro=addslashes($comp_pro);
	$exp_pro=addslashes($exp_pro);
	
	$exp_pro2=$exp_pro2;
	$exp_pro3=$exp_pro3;
	$exp_pro4=$exp_pro4;
	$exp_pro5=$exp_pro5;
	$exp_pro6=$exp_pro6;*/
			
		 $this->inserer_coherence_hp($id, $id_beneficiaire, $exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4,  $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4,$diagnostic,$id_presta);
	
	}
	else
		{
		
			//$exp_pro_=$exp_pro;
			/*$exp_pro2_=$exp_pro2;
			$exp_pro3_=$exp_pro3;
			$exp_pro4_=$exp_pro4;
			$exp_pro5_=$exp_pro5;
			$exp_pro6_=$exp_pro6;*/
		
		
			$this->update_coherence_hp($id_beneficiaire,$exp_pro, $exp_pro2, $exp_pro3, $exp_pro4, $exp_pro5, $exp_pro6, $comp_pro, $comp_pro2, $comp_pro3, $comp_pro4, $comp_pro5, $comp_pro6, $form_savoir, $form_savoir2, $form_savoir3, $form_savoir4, $form_savoir5, $form_savoir6, $compet_acq, $compet_acq2, $compet_acq3, $compet_acq4, $delai_prior, $delai_prior2, $delai_prior3, $delai_prior4, $type_form, $type_form2, $type_form3, $type_form4, $elem_port, $elem_port2, $elem_port3, $elem_port4, $pt_vigilance, $pt_vigilance2, $pt_vigilance3, $pt_vigilance4,$diagnostic,$id_presta);	
		}	
	
		}
		
		//1.select sur table coh�rence_hp where id_beneficiare=id_beneficiaire
		//variable_coherence($id_beneficiaire);
		
		function inserer_aspect_commercial($id, $id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2,$analyse_besoin_client_pt_forts3,$analyse_besoin_client_pt_forts4,$analyse_besoin_client_pt_faible,$analyse_besoin_client_pt_faible2,$analyse_besoin_client_pt_faible3,$analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort,$analyse_concurrence_pt_fort2,$analyse_concurrence_pt_fort3,$analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2,$analyse_concurrence_pt_faible3,$analyse_concurrence_pt_faible4,$strategie_commerciale_envisagee_pt_fort,$strategie_commerciale_envisagee_pt_fort2,$strategie_commerciale_envisagee_pt_fort3,$strategie_commerciale_envisagee_pt_fort4, $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
		
		
		
		
			$requete='SELECT * FROM  egw_prestation where id_ben='.$id_beneficiaire.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			$requete2='SELECT * FROM  egw_nacre_aspect_commercial where id_beneficiaire='.$id_beneficiaire.'';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		if(mysql_num_rows($resultat)>=1 and mysql_num_rows($resultat2)>=1 )
		{
			
			
			/* $resultat_attendus2=stripslashes($resultat_attendus2);
$resultat_attendus1=stripslashes($resultat_attendus1);
$delai_de_realisation4=stripslashes($delai_de_realisation4);
$delai_de_realisation3=stripslashes($delai_de_realisation3);
 $delai_de_realisation2=stripslashes($delai_de_realisation2);
 $delai_de_realisation1=stripslashes($delai_de_realisation1);
$action_a_mener4=stripslashes($action_a_mener4);
$action_a_mener3=stripslashes($action_a_mener3);
$action_a_mener2=stripslashes($action_a_mener2);
$action_a_mener1=stripslashes($action_a_mener1);
$autre_pt_faible=stripslashes($autre_pt_faible);
$autre_pt_faible2=stripslashes($autre_pt_faible2);
$autre_pt_faible3=stripslashes($autre_pt_faible3);
$autre_pt_faible4=stripslashes($autre_pt_faible4);
$autre_pt_fort=stripslashes($autre_pt_fort);
$autre_pt_fort2=stripslashes($autre_pt_fort2);
$autre_pt_fort3=stripslashes($autre_pt_fort3);
$autre_pt_fort4=stripslashes($autre_pt_fort4);
$strategie_commerciale_envisagee_pt_faible=stripslashes($strategie_commerciale_envisagee_pt_faible);
$strategie_commerciale_envisagee_pt_faible2=stripslashes($strategie_commerciale_envisagee_pt_faible2);
$strategie_commerciale_envisagee_pt_faible3=stripslashes($strategie_commerciale_envisagee_pt_faible3);
$strategie_commerciale_envisagee_pt_faible4=stripslashes($strategie_commerciale_envisagee_pt_faible4);
$strategie_commerciale_envisagee_pt_fort=stripslashes($strategie_commerciale_envisagee_pt_fort);
$strategie_commerciale_envisagee_pt_fort2=stripslashes($strategie_commerciale_envisagee_pt_fort2);
$strategie_commerciale_envisagee_pt_fort3=stripslashes($strategie_commerciale_envisagee_pt_fort3);
$strategie_commerciale_envisagee_pt_fort4=stripslashes($strategie_commerciale_envisagee_pt_fort4);
$analyse_concurrence_pt_faible=stripslashes($analyse_concurrence_pt_faible);
$analyse_concurrence_pt_faible2=stripslashes($analyse_concurrence_pt_faible2);
$analyse_concurrence_pt_faible3=stripslashes($analyse_concurrence_pt_faible3);
$analyse_concurrence_pt_faible4=stripslashes($analyse_concurrence_pt_faible4);
$analyse_concurrence_pt_fort=stripslashes($analyse_concurrence_pt_fort);
$analyse_concurrence_pt_fort2=stripslashes($analyse_concurrence_pt_fort2);
$analyse_concurrence_pt_fort3=stripslashes($analyse_concurrence_pt_fort3);
$analyse_concurrence_pt_fort4=stripslashes($analyse_concurrence_pt_fort4);
$analyse_besoin_client_pt_faible=stripslashes($analyse_besoin_client_pt_faible);
$analyse_besoin_client_pt_faible2=stripslashes($analyse_besoin_client_pt_faible2);
$analyse_besoin_client_pt_faible3=stripslashes($analyse_besoin_client_pt_faible3);
$analyse_besoin_client_pt_faible4=stripslashes($analyse_besoin_client_pt_faible4);
$analyse_besoin_client_pt_forts=stripslashes($analyse_besoin_client_pt_forts);
$analyse_besoin_client_pt_forts2=stripslashes($analyse_besoin_client_pt_forts2);
$analyse_besoin_client_pt_forts3=stripslashes($analyse_besoin_client_pt_forts3);
$analyse_besoin_client_pt_forts4=stripslashes($analyse_besoin_client_pt_forts4);
		 $resultat_attendus3=stripslashes($resultat_attendus3);
		 $resultat_attendus4=stripslashes($resultat_attendus4);
		 $diagnostic=stripslashes($diagnostic);*/
		 
	//$requete = "Update egw_nacre_aspect_commercial set  analyse_besoin_client_pt_forts='$analyse_besoin_client_pt_forts',analyse_besoin_client_pt_forts2='$analyse_besoin_client_pt_forts2',analyse_besoin_client_pt_forts3='$analyse_besoin_client_pt_forts3',analyse_besoin_client_pt_forts4='$analyse_besoin_client_pt_forts4', analyse_besoin_client_pt_faible= '$analyse_besoin_client_pt_faible',analyse_besoin_client_pt_faible2= '$analyse_besoin_client_pt_faible2',analyse_besoin_client_pt_faible3= '$analyse_besoin_client_pt_faible3',analyse_besoin_client_pt_faible4= '$analyse_besoin_client_pt_faible4', analyse_concurrence_pt_fort='$analyse_concurrence_pt_fort',analyse_concurrence_pt_fort2='$analyse_concurrence_pt_fort2',analyse_concurrence_pt_fort3='$analyse_concurrence_pt_fort3',analyse_concurrence_pt_fort4='$analyse_concurrence_pt_fort4',  analyse_concurrence_pt_faible='$analyse_concurrence_pt_faible',analyse_concurrence_pt_faible2='$analyse_concurrence_pt_faible2',analyse_concurrence_pt_faible3='$analyse_concurrence_pt_faible3',analyse_concurrence_pt_faible4='$analyse_concurrence_pt_faible4', strategie_commerciale_envisagee_pt_fort='$strategie_commerciale_envisagee_pt_fort',strategie_commerciale_envisagee_pt_fort='$strategie_commerciale_envisagee_pt_fort',strategie_commerciale_envisagee_pt_fort2='$strategie_commerciale_envisagee_pt_fort2',strategie_commerciale_envisagee_pt_fort3='$strategie_commerciale_envisagee_pt_fort3',strategie_commerciale_envisagee_pt_fort4='$strategie_commerciale_envisagee_pt_fort4',  strategie_commerciale_envisagee_pt_faible='$strategie_commerciale_envisagee_pt_faible', strategie_commerciale_envisagee_pt_faible2='$strategie_commerciale_envisagee_pt_faible2', strategie_commerciale_envisagee_pt_faible3='$strategie_commerciale_envisagee_pt_faible3', strategie_commerciale_envisagee_pt_faible4='$strategie_commerciale_envisagee_pt_faible4', autre_pt_fort='$autre_pt_fort',autre_pt_fort2='$autre_pt_fort2',autre_pt_fort3='$autre_pt_fort3',autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2',autre_pt_faible3='$autre_pt_faible3',autre_pt_faible4='$autre_pt_faible4',action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2',  delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic',id_presta='$id_presta' where id_beneficiaire = $id_beneficiaire";
	
		}
		else
		{
		
//$requete = "insert into egw_nacre_aspect_commercial value ('', '$id_beneficiaire','$analyse_besoin_client_pt_forts','$analyse_besoin_client_pt_forts2','$analyse_besoin_client_pt_forts3','$analyse_besoin_client_pt_forts4', '$analyse_besoin_client_pt_faible','$analyse_besoin_client_pt_faible2','$analyse_besoin_client_pt_faible3','$analyse_besoin_client_pt_faible4','$analyse_concurrence_pt_fort','$analyse_concurrence_pt_fort2','$analyse_concurrence_pt_fort3','$analyse_concurrence_pt_fort4', '$analyse_concurrence_pt_faible','$analyse_concurrence_pt_faible2','$analyse_concurrence_pt_faible3','$analyse_concurrence_pt_faible4','$strategie_commerciale_envisagee_pt_fort','$strategie_commerciale_envisagee_pt_fort2','$strategie_commerciale_envisagee_pt_fort3','$strategie_commerciale_envisagee_pt_fort4','$strategie_commerciale_envisagee_pt_faible','$strategie_commerciale_envisagee_pt_faible2','$strategie_commerciale_envisagee_pt_faible3','$strategie_commerciale_envisagee_pt_faible4', '$autre_pt_fort','$autre_pt_fort2','$autre_pt_fort3','$autre_pt_fort4', '$autre_pt_faible','$autre_pt_faible2','$autre_pt_faible3','$autre_pt_faible4', '$action_a_mener1', '$action_a_mener2','$action_a_mener3', '$action_a_mener4', '$delai_de_realisation1', '$delai_de_realisation2', '$delai_de_realisation3','$delai_de_realisation4','$resultat_attendus1','$resultat_attendus2','$resultat_attendus3','$resultat_attendus4','$diagnostic','$id_presta')";

		$data['id_beneficiaire'] = $id_beneficiaire;
		$data['analyse_besoin_client_pt_forts'] = $analyse_besoin_client_pt_forts;
		$data['analyse_besoin_client_pt_forts2'] = $analyse_besoin_client_pt_forts2;
		$data['analyse_besoin_client_pt_forts3'] = $analyse_besoin_client_pt_forts3;
		$data['analyse_besoin_client_pt_forts4'] = $analyse_besoin_client_pt_forts4;
		$data['analyse_besoin_client_pt_faible'] = $analyse_besoin_client_pt_faible;
		$data['analyse_besoin_client_pt_faible2'] = $analyse_besoin_client_pt_faible2;
		$data['analyse_besoin_client_pt_faible3'] = $analyse_besoin_client_pt_faible3;
		$data['analyse_besoin_client_pt_faible4'] = $analyse_besoin_client_pt_faible4;
		$data['analyse_concurrence_pt_fort'] = $analyse_concurrence_pt_fort;
		$data['analyse_concurrence_pt_fort2'] = $analyse_concurrence_pt_fort2;
		$data['analyse_concurrence_pt_fort3'] = $analyse_concurrence_pt_fort3;
		$data['analyse_concurrence_pt_fort4'] = $analyse_concurrence_pt_fort4;
		$data['analyse_concurrence_pt_faible'] = $analyse_concurrence_pt_faible;
		$data['analyse_concurrence_pt_faible2'] = $analyse_concurrence_pt_faible2;
		$data['analyse_concurrence_pt_faible3'] = $analyse_concurrence_pt_faible3;
		$data['analyse_concurrence_pt_faible4'] = $analyse_concurrence_pt_faible4;
		$data['strategie_commerciale_envisagee_pt_fort'] = $strategie_commerciale_envisagee_pt_fort;
		$data['strategie_commerciale_envisagee_pt_fort2'] = $strategie_commerciale_envisagee_pt_fort2;
		$data['strategie_commerciale_envisagee_pt_fort3'] = $strategie_commerciale_envisagee_pt_fort3;
		$data['strategie_commerciale_envisagee_pt_fort4'] = $strategie_commerciale_envisagee_pt_fort4;
		$data['strategie_commerciale_envisagee_pt_faible'] = $strategie_commerciale_envisagee_pt_faible;
		$data['strategie_commerciale_envisagee_pt_faible2'] = $strategie_commerciale_envisagee_pt_faible2;
		$data['strategie_commerciale_envisagee_pt_faible3'] = $strategie_commerciale_envisagee_pt_faible3;
		$data['strategie_commerciale_envisagee_pt_faible4'] = $strategie_commerciale_envisagee_pt_faible4;
		$data['autre_pt_fort'] = $autre_pt_fort;
		$data['autre_pt_fort2'] = $autre_pt_fort2;
		$data['autre_pt_fort3'] = $autre_pt_fort3;
		$data['autre_pt_fort4'] = $autre_pt_fort4;
		$data['autre_pt_faible'] = $autre_pt_faible;
		$data['autre_pt_faible2'] = $autre_pt_faible2;
		$data['autre_pt_faible3'] = $autre_pt_faible3;
		$data['autre_pt_faible4'] = $autre_pt_faible4;
		$data['action_a_mener1'] = $action_a_mener1;
		$data['action_a_mener2'] = $action_a_mener2;
		$data['action_a_mener3'] = $action_a_mener3;
		$data['action_a_mener4'] = $action_a_mener4;
		$data['delai_de_realisation1'] = $delai_de_realisation1;
		$data['delai_de_realisation2'] = $delai_de_realisation2;
		$data['delai_de_realisation3'] = $delai_de_realisation3;
		$data['delai_de_realisation4'] = $delai_de_realisation4;
		$data['resultat_attendus1'] = $resultat_attendus1;
		$data['resultat_attendus2'] = $resultat_attendus2;
		$data['resultat_attendus3'] = $resultat_attendus3;
		$data['resultat_attendus4'] = $resultat_attendus4;
		$data['diagnostic'] = $diagnostic;
		$data['id_presta'] = $id_presta;
		
		
		$this->db->insert('egw_nacre_aspect_commercial',$data);
		}
		
	//$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	
	// Fonction de mise � jour (aspect commercial)
	
function update_aspect_commercial( $id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2,$analyse_besoin_client_pt_forts3,$analyse_besoin_client_pt_forts4,$analyse_besoin_client_pt_faible,$analyse_besoin_client_pt_faible2,$analyse_besoin_client_pt_faible3,$analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort,$analyse_concurrence_pt_fort2,$analyse_concurrence_pt_fort3,$analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2,$analyse_concurrence_pt_faible3,$analyse_concurrence_pt_faible4,$strategie_commerciale_envisagee_pt_fort,$strategie_commerciale_envisagee_pt_fort2,$strategie_commerciale_envisagee_pt_fort3,$strategie_commerciale_envisagee_pt_fort4, $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
	/*$requete = "Update egw_nacre_aspect_commercial set  analyse_besoin_client_pt_forts='$analyse_besoin_client_pt_forts',analyse_besoin_client_pt_forts2='$analyse_besoin_client_pt_forts2',analyse_besoin_client_pt_forts3='$analyse_besoin_client_pt_forts3',analyse_besoin_client_pt_forts4='$analyse_besoin_client_pt_forts4', analyse_besoin_client_pt_faible= '$analyse_besoin_client_pt_faible',analyse_besoin_client_pt_faible2= '$analyse_besoin_client_pt_faible2',analyse_besoin_client_pt_faible3= '$analyse_besoin_client_pt_faible3',analyse_besoin_client_pt_faible4= '$analyse_besoin_client_pt_faible4', analyse_concurrence_pt_fort='$analyse_concurrence_pt_fort',analyse_concurrence_pt_fort2='$analyse_concurrence_pt_fort2',analyse_concurrence_pt_fort3='$analyse_concurrence_pt_fort3',analyse_concurrence_pt_fort4='$analyse_concurrence_pt_fort4',  analyse_concurrence_pt_faible='$analyse_concurrence_pt_faible',analyse_concurrence_pt_faible2='$analyse_concurrence_pt_faible2',analyse_concurrence_pt_faible3='$analyse_concurrence_pt_faible3',analyse_concurrence_pt_faible4='$analyse_concurrence_pt_faible4', strategie_commerciale_envisagee_pt_fort='$strategie_commerciale_envisagee_pt_fort',strategie_commerciale_envisagee_pt_fort='$strategie_commerciale_envisagee_pt_fort',strategie_commerciale_envisagee_pt_fort2='$strategie_commerciale_envisagee_pt_fort2',strategie_commerciale_envisagee_pt_fort3='$strategie_commerciale_envisagee_pt_fort3',strategie_commerciale_envisagee_pt_fort4='$strategie_commerciale_envisagee_pt_fort4',  strategie_commerciale_envisagee_pt_faible='$strategie_commerciale_envisagee_pt_faible', strategie_commerciale_envisagee_pt_faible2='$strategie_commerciale_envisagee_pt_faible2', strategie_commerciale_envisagee_pt_faible3='$strategie_commerciale_envisagee_pt_faible3', strategie_commerciale_envisagee_pt_faible4='$strategie_commerciale_envisagee_pt_faible4', autre_pt_fort='$autre_pt_fort',autre_pt_fort2='$autre_pt_fort2',autre_pt_fort3='$autre_pt_fort3',autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2',autre_pt_faible3='$autre_pt_faible3',autre_pt_faible4='$autre_pt_faible4',action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2',  delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic' where id_beneficiaire = $id_beneficiaire";
	

	$resultat = mysql_query($requete) or die(mysql_error());*/
		
				//$data['id_beneficiaire'] = $id_beneficiaire;
		$data['analyse_besoin_client_pt_forts'] = $analyse_besoin_client_pt_forts;
		$data['analyse_besoin_client_pt_forts2'] = $analyse_besoin_client_pt_forts2;
		$data['analyse_besoin_client_pt_forts3'] = $analyse_besoin_client_pt_forts3;
		$data['analyse_besoin_client_pt_forts4'] = $analyse_besoin_client_pt_forts4;
		$data['analyse_besoin_client_pt_faible'] = $analyse_besoin_client_pt_faible;
		$data['analyse_besoin_client_pt_faible2'] = $analyse_besoin_client_pt_faible2;
		$data['analyse_besoin_client_pt_faible3'] = $analyse_besoin_client_pt_faible3;
		$data['analyse_besoin_client_pt_faible4'] = $analyse_besoin_client_pt_faible4;
		$data['analyse_concurrence_pt_fort'] = $analyse_concurrence_pt_fort;
		$data['analyse_concurrence_pt_fort2'] = $analyse_concurrence_pt_fort2;
		$data['analyse_concurrence_pt_fort3'] = $analyse_concurrence_pt_fort3;
		$data['analyse_concurrence_pt_fort4'] = $analyse_concurrence_pt_fort4;
		$data['analyse_concurrence_pt_faible'] = $analyse_concurrence_pt_faible;
		$data['analyse_concurrence_pt_faible2'] = $analyse_concurrence_pt_faible2;
		$data['analyse_concurrence_pt_faible3'] = $analyse_concurrence_pt_faible3;
		$data['analyse_concurrence_pt_faible4'] = $analyse_concurrence_pt_faible4;
		$data['strategie_commerciale_envisagee_pt_fort'] = $strategie_commerciale_envisagee_pt_fort;
		$data['strategie_commerciale_envisagee_pt_fort2'] = $strategie_commerciale_envisagee_pt_fort2;
		$data['strategie_commerciale_envisagee_pt_fort3'] = $strategie_commerciale_envisagee_pt_fort3;
		$data['strategie_commerciale_envisagee_pt_fort4'] = $strategie_commerciale_envisagee_pt_fort4;
		$data['strategie_commerciale_envisagee_pt_faible'] = $strategie_commerciale_envisagee_pt_faible;
		$data['strategie_commerciale_envisagee_pt_faible2'] = $strategie_commerciale_envisagee_pt_faible2;
		$data['strategie_commerciale_envisagee_pt_faible3'] = $strategie_commerciale_envisagee_pt_faible3;
		$data['strategie_commerciale_envisagee_pt_faible4'] = $strategie_commerciale_envisagee_pt_faible4;
		$data['autre_pt_fort'] = $autre_pt_fort;
		$data['autre_pt_fort2'] = $autre_pt_fort2;
		$data['autre_pt_fort3'] = $autre_pt_fort3;
		$data['autre_pt_fort4'] = $autre_pt_fort4;
		$data['autre_pt_faible'] = $autre_pt_faible;
		$data['autre_pt_faible2'] = $autre_pt_faible2;
		$data['autre_pt_faible3'] = $autre_pt_faible3;
		$data['autre_pt_faible4'] = $autre_pt_faible4;
		$data['action_a_mener1'] = $action_a_mener1;
		$data['action_a_mener2'] = $action_a_mener2;
		$data['action_a_mener3'] = $action_a_mener3;
		$data['action_a_mener4'] = $action_a_mener4;
		$data['delai_de_realisation1'] = $delai_de_realisation1;
		$data['delai_de_realisation2'] = $delai_de_realisation2;
		$data['delai_de_realisation3'] = $delai_de_realisation3;
		$data['delai_de_realisation4'] = $delai_de_realisation4;
		$data['resultat_attendus1'] = $resultat_attendus1;
		$data['resultat_attendus2'] = $resultat_attendus2;
		$data['resultat_attendus3'] = $resultat_attendus3;
		$data['resultat_attendus4'] = $resultat_attendus4;
		$data['diagnostic'] = $diagnostic;
		//$data['id_presta'] = $id_presta;
		
		
		$this->db->update('egw_nacre_aspect_commercial',$data,'id_beneficiaire='.$id_beneficiaire);
	}
	
	// Fonction de s�lection (aspect_commercial)
	
	function variable_aspect_commercial($id_presta,$id_beneficiaire)
	{	
	
	
	
			$requete='SELECT * FROM  egw_nacre_aspect_commercial where id_beneficiaire='.$id_beneficiaire.'';
		
	
		
	
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
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
		}
		if(isset($id) and $id!=NULL)
		{
		return array($analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_faible, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_faible, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$analyse_besoin_client_pt_forts2,$analyse_besoin_client_pt_forts3,$analyse_besoin_client_pt_forts4,$analyse_besoin_client_pt_faible2,$analyse_besoin_client_pt_faible3,$analyse_besoin_client_pt_faible4,$analyse_concurrence_pt_fort2,$analyse_concurrence_pt_fort3,$analyse_concurrence_pt_fort4,$analyse_concurrence_pt_faible2,$analyse_concurrence_pt_faible3,$analyse_concurrence_pt_faible4,$strategie_commerciale_envisagee_pt_fort2,$strategie_commerciale_envisagee_pt_fort3,$strategie_commerciale_envisagee_pt_fort4,$strategie_commerciale_envisagee_pt_faible2,$strategie_commerciale_envisagee_pt_faible3,$strategie_commerciale_envisagee_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4);
		}
			
	}
	
	//Fonction de v�rification 'id_beneficiaire (aspect_commercial)
	
	//V�rification de l'id_beneficiaire dans la table aspect_commercial
	//Si il existe faire une mise � jour , sinon le cr�er
	
	function verif_beneficiaire_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2, $analyse_besoin_client_pt_forts3,  $analyse_besoin_client_pt_forts4, $analyse_besoin_client_pt_faible, $analyse_besoin_client_pt_faible2, $analyse_besoin_client_pt_faible3, $analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort, $analyse_concurrence_pt_fort2, $analyse_concurrence_pt_fort3, $analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2, $analyse_concurrence_pt_faible3, $analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort, $strategie_commerciale_envisagee_pt_fort2, $strategie_commerciale_envisagee_pt_fort3, $strategie_commerciale_envisagee_pt_fort4,  $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort, $autre_pt_fort2, $autre_pt_fort3, $autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,  $resultat_attendus4, $diagnostic, $id_presta)
	
		{
		
			
				//BANQUE DE TEXTE///
			
			
			if(is_numeric($analyse_besoin_client_pt_forts)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_forts.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_forts=$row['valeur'];
			$analyse_besoin_client_pt_forts_=addslashes($analyse_besoin_client_pt_forts);
		}
		
		}
		else
		{
			$analyse_besoin_client_pt_forts_=$analyse_besoin_client_pt_forts;
		}
		
		if(is_numeric($analyse_besoin_client_pt_forts2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_forts2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_forts2=$row['valeur'];
			$analyse_besoin_client_pt_forts2_=addslashes($analyse_besoin_client_pt_forts2);
		}
		
		}
		else
		{
			$analyse_besoin_client_pt_forts2_=$analyse_besoin_client_pt_forts2;
		}
			if(is_numeric($analyse_besoin_client_pt_forts3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_forts3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_forts3=$row['valeur'];
			$analyse_besoin_client_pt_forts3_=addslashes($analyse_besoin_client_pt_forts3);
		}
		
		}
		else
		{
			$analyse_besoin_client_pt_forts3_=$analyse_besoin_client_pt_forts3;
		}
				if(is_numeric($analyse_besoin_client_pt_forts4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_forts4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_forts4=$row['valeur'];
			$analyse_besoin_client_pt_forts4_=addslashes($analyse_besoin_client_pt_forts4);
		}
		
		}
		else
		{
			$analyse_besoin_client_pt_forts4_=$analyse_besoin_client_pt_forts4;
		}
			if(is_numeric($analyse_besoin_client_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_faible=$row['valeur'];
			$analyse_besoin_client_pt_faible_=addslashes($analyse_besoin_client_pt_faible);
		}
		
		}
		else
		{
		$analyse_besoin_client_pt_faible_=$analyse_besoin_client_pt_faible;
		}
			if(is_numeric($analyse_besoin_client_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_faible2=$row['valeur'];
			$analyse_besoin_client_pt_faible2_=addslashes($analyse_besoin_client_pt_faible2);
		}
		
		}
		else
		{
		$analyse_besoin_client_pt_faible2_=$analyse_besoin_client_pt_faible2;
		}
		if(is_numeric($analyse_besoin_client_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_faible3=$row['valeur'];
			$analyse_besoin_client_pt_faible3_=addslashes($analyse_besoin_client_pt_faible3);
		}
		
		}
		else
		{
		$analyse_besoin_client_pt_faible3_=$analyse_besoin_client_pt_faible3;
		}
			if(is_numeric($analyse_besoin_client_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_besoin_client_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_besoin_client_pt_faible4=$row['valeur'];
			$analyse_besoin_client_pt_faible4_=addslashes($analyse_besoin_client_pt_faible4);
		}
		
		}
		else
		{
		$analyse_besoin_client_pt_faible4_=$analyse_besoin_client_pt_faible4;
		}
		
				if(is_numeric($analyse_concurrence_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort=$row['valeur'];
			$analyse_concurrence_pt_fort_=addslashes($analyse_concurrence_pt_fort);
		}
		
		}
		
			if(is_numeric($analyse_concurrence_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort=$row['valeur'];
			$analyse_concurrence_pt_fort_=addslashes($analyse_concurrence_pt_fort);
		}
		
		}
		
			if(is_numeric($analyse_concurrence_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort=$row['valeur'];
			$analyse_concurrence_pt_fort_=addslashes($analyse_concurrence_pt_fort);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_fort_=$analyse_concurrence_pt_fort;
		}
		
			if(is_numeric($analyse_concurrence_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort2=$row['valeur'];
			$analyse_concurrence_pt_fort2_=addslashes($analyse_concurrence_pt_fort2);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_fort2_=$analyse_concurrence_pt_fort2;
		}
		
		
			if(is_numeric($analyse_concurrence_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort3=$row['valeur'];
			$analyse_concurrence_pt_fort3_=addslashes($analyse_concurrence_pt_fort3);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_fort3_=$analyse_concurrence_pt_fort3;
		}
		
			if(is_numeric($analyse_concurrence_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_fort4=$row['valeur'];
			$analyse_concurrence_pt_fort4_=addslashes($analyse_concurrence_pt_fort4);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_fort4_=$analyse_concurrence_pt_fort4;
		}
		
		
		
				if(is_numeric($analyse_concurrence_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_faible=$row['valeur'];
			$analyse_concurrence_pt_faible_=addslashes($analyse_concurrence_pt_faible);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_faible_=$analyse_concurrence_pt_faible;
		}
		
		
				if(is_numeric($analyse_concurrence_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_faible2=$row['valeur'];
			$analyse_concurrence_pt_faible2_=addslashes($analyse_concurrence_pt_faible2);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_faible2_=$analyse_concurrence_pt_faible2;
		}
		
		
				if(is_numeric($analyse_concurrence_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_faible3=$row['valeur'];
			$analyse_concurrence_pt_faible3_=addslashes($analyse_concurrence_pt_faible3);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_faible3_=$analyse_concurrence_pt_faible3;
		}
		
		
				if(is_numeric($analyse_concurrence_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$analyse_concurrence_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$analyse_concurrence_pt_faible4=$row['valeur'];
			$analyse_concurrence_pt_faible4_=addslashes($analyse_concurrence_pt_faible4);
		}
		
		}
		else
		{
		$analyse_concurrence_pt_faible4_=$analyse_concurrence_pt_faible4;
		}
		
		
		
		
				if(is_numeric($strategie_commerciale_envisagee_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_fort=$row['valeur'];
			$strategie_commerciale_envisagee_pt_fort_=addslashes($strategie_commerciale_envisagee_pt_fort);
			
		}
		
		}
		else
		{$strategie_commerciale_envisagee_pt_fort_=$strategie_commerciale_envisagee_pt_fort;
		
		}
		
		
				if(is_numeric($strategie_commerciale_envisagee_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_fort2=$row['valeur'];
			$strategie_commerciale_envisagee_pt_fort2_=addslashes($strategie_commerciale_envisagee_pt_fort2);
			
		}
		
		}
		else
		{$strategie_commerciale_envisagee_pt_fort2_=$strategie_commerciale_envisagee_pt_fort2;
		
		}
		
		
				if(is_numeric($strategie_commerciale_envisagee_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_fort3=$row['valeur'];
			$strategie_commerciale_envisagee_pt_fort3_=addslashes($strategie_commerciale_envisagee_pt_fort3);
			
		}
		
		}
		else
		{$strategie_commerciale_envisagee_pt_fort3_=$strategie_commerciale_envisagee_pt_fort3;
		
		}
		
		
				if(is_numeric($strategie_commerciale_envisagee_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_fort4=$row['valeur'];
			$strategie_commerciale_envisagee_pt_fort4_=addslashes($strategie_commerciale_envisagee_pt_fort4);
			
		}
		
		}
		else
		{$strategie_commerciale_envisagee_pt_fort4_=$strategie_commerciale_envisagee_pt_fort4;
		
		}
		
		
		
				if(is_numeric($strategie_commerciale_envisagee_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_faible=$row['valeur'];
			$strategie_commerciale_envisagee_pt_faible_=addslashes($strategie_commerciale_envisagee_pt_faible);
		}
		
		}
		else
		{
		$strategie_commerciale_envisagee_pt_faible_=$strategie_commerciale_envisagee_pt_faible;
		}
		
			if(is_numeric($strategie_commerciale_envisagee_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_faible2=$row['valeur'];
			$strategie_commerciale_envisagee_pt_faible2_=addslashes($strategie_commerciale_envisagee_pt_faible2);
		}
		
		}
		else
		{
		$strategie_commerciale_envisagee_pt_faible2_=$strategie_commerciale_envisagee_pt_faible2;
		}
		
		
			if(is_numeric($strategie_commerciale_envisagee_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_faible3=$row['valeur'];
			$strategie_commerciale_envisagee_pt_faible3_=addslashes($strategie_commerciale_envisagee_pt_faible3);
		}
		
		}
		else
		{
		$strategie_commerciale_envisagee_pt_faible3_=$strategie_commerciale_envisagee_pt_faible3;
		}
		
			if(is_numeric($strategie_commerciale_envisagee_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$strategie_commerciale_envisagee_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$strategie_commerciale_envisagee_pt_faible4=$row['valeur'];
			$strategie_commerciale_envisagee_pt_faible4_=addslashes($strategie_commerciale_envisagee_pt_faible4);
		}
		
		}
		else
		{
		$strategie_commerciale_envisagee_pt_faible4_=$strategie_commerciale_envisagee_pt_faible4;
		}
		
				if(is_numeric($autre_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort=$row['valeur'];
			$autre_pt_fort_=addslashes($autre_pt_fort);
		}
		
		}
		else
		{
		$autre_pt_fort_=$autre_pt_fort;
		}
		
			if(is_numeric($autre_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort2=$row['valeur'];
			$autre_pt_fort2_=addslashes($autre_pt_fort2);
		}
		
		}
		else
		{
		$autre_pt_fort2_=$autre_pt_fort2;
		}
		
			if(is_numeric($autre_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort3=$row['valeur'];
			$autre_pt_fort3_=addslashes($autre_pt_fort3);
		}
		
		}
		else
		{
		$autre_pt_fort3_=$autre_pt_fort3;
		}
		
			if(is_numeric($autre_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort4=$row['valeur'];
			$autre_pt_fort4_=addslashes($autre_pt_fort4);
		}
		
		}
		else
		{
		$autre_pt_fort4_=$autre_pt_fort4;
		}
		
				if(is_numeric($autre_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible=$row['valeur'];
			$autre_pt_faible_=addslashes($autre_pt_faible);
		}
		
		}
		else
		{
			$autre_pt_faible_=$autre_pt_faible;
		}
			
			if(is_numeric($autre_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible2=$row['valeur'];
			$autre_pt_faible2_=addslashes($autre_pt_faible2);
		}
		
		}
		else
		{
			$autre_pt_faible2_=$autre_pt_faible2;
		}
		
		if(is_numeric($autre_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible3=$row['valeur'];
			$autre_pt_faible3_=addslashes($autre_pt_faible3);
		}
		
		}
		else
		{
			$autre_pt_faible3_=$autre_pt_faible3;
		}
		
		if(is_numeric($autre_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible4=$row['valeur'];
			$autre_pt_faible4_=addslashes($autre_pt_faible4);
		}
		
		}
		else
		{
			$autre_pt_faible4_=$autre_pt_faible4;
		}
		
		
		if(is_numeric($action_a_mener1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener1=$row['valeur'];
			$action_a_mener1_=addslashes($action_a_mener1);
		}
		
		}
		else
		{
			$action_a_mener1_=$action_a_mener1;
			
		}
		
		
					if(is_numeric($action_a_mener2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener2=$row['valeur'];
			$action_a_mener2_=addslashes($action_a_mener2);
		}
		
		}
		else
		{
			$action_a_mener2_=$action_a_mener2;
			
		}
		
					if(is_numeric($action_a_mener3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener3=$row['valeur'];
			$action_a_mener3_=addslashes($action_a_mener3);
		}
		
		}
		else
		{
			$action_a_mener3_=$action_a_mener3;
			
		}
		
				if(is_numeric($action_a_mener4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener4=$row['valeur'];
			$action_a_mener4_=addslashes($action_a_mener4);
		}
		
		}
		else
		{
			$action_a_mener4_=$action_a_mener4;
			
		}
		
				if(is_numeric($delai_de_realisation1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $delai_de_realisation1=$row['valeur'];
			$delai_de_realisation1_=addslashes($delai_de_realisation1);
		}
		
		}
		else
		{
			$delai_de_realisation1_=$delai_de_realisation1;
			}
				if(is_numeric($delai_de_realisation2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $delai_de_realisation2=$row['valeur'];
			$delai_de_realisation2_=addslashes($delai_de_realisation2);
		}
		
		}
		else
		{
		$delai_de_realisation2_=$delai_de_realisation2;
		}
				if(is_numeric($delai_de_realisation3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $delai_de_realisation3=$row['valeur'];
			 $delai_de_realisation3_=addslashes($delai_de_realisation3);
		}
		
		}
		else
		{
		$delai_de_realisation3_=$delai_de_realisation3;
		}
				if(is_numeric($delai_de_realisation4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $delai_de_realisation4=$row['valeur'];
			 $delai_de_realisation4_=addslashes($delai_de_realisation4);
		}
		
		}
		else
		{$delai_de_realisation4_=$delai_de_realisation4;
		}
				if(is_numeric($resultat_attendus1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $resultat_attendus1=$row['valeur'];
			  $resultat_attendus1_=addslashes($resultat_attendus1);
			 
		}
		
		}
		else
		{
		
		 $resultat_attendus1_=$resultat_attendus1;
		 }
		if(is_numeric($resultat_attendus2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $resultat_attendus2=$row['valeur'];
			 $resultat_attendus2_=addslashes($resultat_attendus2);
		}
		
		}
		else
		{
		
		 $resultat_attendus2_=$resultat_attendus2;
		 }
		if(is_numeric($resultat_attendus3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $resultat_attendus3=$row['valeur'];
			 $resultat_attendus3_=addslashes($resultat_attendus2);
		}
		
		}
		else
		{
		 $resultat_attendus3_=$resultat_attendus3;
		}
		if(is_numeric($resultat_attendus4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			 $resultat_attendus4=$row['valeur'];
			 $resultat_attendus4_=addslashes($resultat_attendus4);
			
		}
		
		}
		else
		{
			 $resultat_attendus4_=$resultat_attendus4;
		
		}
	
		 
		 
		//BANQUE DE TEXTE///
		
		//1.select sur table aspect_commercial where id_beneficiare=id_beneficiaire
		//variable_aspect_commercial($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_aspect_commercial where id_beneficiaire='.$id_beneficiaire.'';
		//$requete='SELECT * FROM  egw_nacre_aspect_commercial  where id_presta='.$id_presta.'';
	
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==0)
		{
			/*	 $resultat_attendus2=addslashes($resultat_attendus2);
$resultat_attendus1=addslashes($resultat_attendus1);
$delai_de_realisation4=addslashes($delai_de_realisation4);
$delai_de_realisation3=addslashes($delai_de_realisation3);
 $delai_de_realisation2=addslashes($delai_de_realisation2);
 $delai_de_realisation1=addslashes($delai_de_realisation1);
$action_a_mener4=addslashes($action_a_mener4);
$action_a_mener3=addslashes($action_a_mener3);
$action_a_mener2=addslashes($action_a_mener2);
$action_a_mener1=addslashes($action_a_mener1);
$autre_pt_faible=addslashes($autre_pt_faible);
$autre_pt_faible2=addslashes($autre_pt_faible2);
$autre_pt_faible3=addslashes($autre_pt_faible3);
$autre_pt_faible4=addslashes($autre_pt_faible4);
$autre_pt_fort=addslashes($autre_pt_fort);
$autre_pt_fort2=addslashes($autre_pt_fort2);
$autre_pt_fort3=addslashes($autre_pt_fort3);
$autre_pt_fort4=addslashes($autre_pt_fort4);
$strategie_commerciale_envisagee_pt_faible=addslashes($strategie_commerciale_envisagee_pt_faible);
$strategie_commerciale_envisagee_pt_faible2=addslashes($strategie_commerciale_envisagee_pt_faible2);
$strategie_commerciale_envisagee_pt_faible3=addslashes($strategie_commerciale_envisagee_pt_faible3);
$strategie_commerciale_envisagee_pt_faible4=addslashes($strategie_commerciale_envisagee_pt_faible4);
$strategie_commerciale_envisagee_pt_fort=addslashes($strategie_commerciale_envisagee_pt_fort);
$strategie_commerciale_envisagee_pt_fort2=addslashes($strategie_commerciale_envisagee_pt_fort2);
$strategie_commerciale_envisagee_pt_fort3=addslashes($strategie_commerciale_envisagee_pt_fort3);
$strategie_commerciale_envisagee_pt_fort4=addslashes($strategie_commerciale_envisagee_pt_fort4);
$analyse_concurrence_pt_faible=addslashes($analyse_concurrence_pt_faible);
$analyse_concurrence_pt_faible2=addslashes($analyse_concurrence_pt_faible2);
$analyse_concurrence_pt_faible3=addslashes($analyse_concurrence_pt_faible3);
$analyse_concurrence_pt_faible4=addslashes($analyse_concurrence_pt_faible4);
$analyse_concurrence_pt_fort=addslashes($analyse_concurrence_pt_fort);
$analyse_concurrence_pt_fort2=addslashes($analyse_concurrence_pt_fort2);
$analyse_concurrence_pt_fort3=addslashes($analyse_concurrence_pt_fort3);
$analyse_concurrence_pt_fort4=addslashes($analyse_concurrence_pt_fort4);
$analyse_besoin_client_pt_faible=addslashes($analyse_besoin_client_pt_faible);
$analyse_besoin_client_pt_faible2=addslashes($analyse_besoin_client_pt_faible2);
$analyse_besoin_client_pt_faible3=addslashes($analyse_besoin_client_pt_faible3);
$analyse_besoin_client_pt_faible4=addslashes($analyse_besoin_client_pt_faible4);
$analyse_besoin_client_pt_forts=addslashes($analyse_besoin_client_pt_forts);
$analyse_besoin_client_pt_forts2=addslashes($analyse_besoin_client_pt_forts2);
$analyse_besoin_client_pt_forts3=addslashes($analyse_besoin_client_pt_forts3);
$analyse_besoin_client_pt_forts4=addslashes($analyse_besoin_client_pt_forts4);
		 $resultat_attendus3=addslashes($resultat_attendus3);
		 $resultat_attendus4=addslashes($resultat_attendus4);*/
		// $diagnostic=addslashes($diagnostic);
		 
		 $this->inserer_aspect_commercial($id, $id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2,$analyse_besoin_client_pt_forts3,$analyse_besoin_client_pt_forts4,$analyse_besoin_client_pt_faible,$analyse_besoin_client_pt_faible2,$analyse_besoin_client_pt_faible3,$analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort,$analyse_concurrence_pt_fort2,$analyse_concurrence_pt_fort3,$analyse_concurrence_pt_fort4, $analyse_concurrence_pt_faible, $analyse_concurrence_pt_faible2,$analyse_concurrence_pt_faible3,$analyse_concurrence_pt_faible4,$strategie_commerciale_envisagee_pt_fort,$strategie_commerciale_envisagee_pt_fort2,$strategie_commerciale_envisagee_pt_fort3,$strategie_commerciale_envisagee_pt_fort4, $strategie_commerciale_envisagee_pt_faible, $strategie_commerciale_envisagee_pt_faible2, $strategie_commerciale_envisagee_pt_faible3, $strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta);
	
	}
	else
		{
				
				//$diagnostic_=$diagnostic;
				
		//$this->update_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts_, $analyse_besoin_client_pt_forts2_,$analyse_besoin_client_pt_forts3_,$analyse_besoin_client_pt_forts4_,$analyse_besoin_client_pt_faible_,$analyse_besoin_client_pt_faible2_,$analyse_besoin_client_pt_faible3_,$analyse_besoin_client_pt_faible4_, $analyse_concurrence_pt_fort_, $analyse_concurrence_pt_fort2_,$analyse_concurrence_pt_fort3_,$analyse_concurrence_pt_fort4_,$analyse_concurrence_pt_faible_,$analyse_concurrence_pt_faible2_,$analyse_concurrence_pt_faible3_,$analyse_concurrence_pt_faible4_, $strategie_commerciale_envisagee_pt_fort_,$strategie_commerciale_envisagee_pt_fort2_,$strategie_commerciale_envisagee_pt_fort3_,$strategie_commerciale_envisagee_pt_fort4_, $strategie_commerciale_envisagee_pt_faible_,$strategie_commerciale_envisagee_pt_faible2_,$strategie_commerciale_envisagee_pt_faible3_,$strategie_commerciale_envisagee_pt_faible4_, $autre_pt_fort_,$autre_pt_fort2_,$autre_pt_fort3_,$autre_pt_fort4_, $autre_pt_faible_, $autre_pt_faible2_, $autre_pt_faible3_, $autre_pt_faible4_, $action_a_mener1_, $action_a_mener2_, $action_a_mener3_, $action_a_mener4_, $delai_de_realisation1_, $delai_de_realisation2_, $delai_de_realisation3_, $delai_de_realisation4_, $resultat_attendus1_, $resultat_attendus2_, $resultat_attendus3_, $resultat_attendus4_, $diagnostic_,$id_presta);	
			$this->update_aspect_commercial($id_beneficiaire, $analyse_besoin_client_pt_forts, $analyse_besoin_client_pt_forts2,$analyse_besoin_client_pt_forts3,$analyse_besoin_client_pt_forts4,
		$analyse_besoin_client_pt_faible,$analyse_besoin_client_pt_faible2,$analyse_besoin_client_pt_faible3,$analyse_besoin_client_pt_faible4, $analyse_concurrence_pt_fort,
		 $analyse_concurrence_pt_fort2,$analyse_concurrence_pt_fort3,$analyse_concurrence_pt_fort4,$analyse_concurrence_pt_faible,$analyse_concurrence_pt_faible2,
		 $analyse_concurrence_pt_faible3,$analyse_concurrence_pt_faible4, $strategie_commerciale_envisagee_pt_fort,$strategie_commerciale_envisagee_pt_fort2,
		 $strategie_commerciale_envisagee_pt_fort3,$strategie_commerciale_envisagee_pt_fort4, $strategie_commerciale_envisagee_pt_faible,
		 $strategie_commerciale_envisagee_pt_faible2,$strategie_commerciale_envisagee_pt_faible3,$strategie_commerciale_envisagee_pt_faible4, $autre_pt_fort_,$autre_pt_fort2,
		 $autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2,
		  $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3,
		   $resultat_attendus4, $diagnostic,$id_presta);	
		}	
	
		}

	//Fonctions li�es � la table aspect_financier-------------------------------------------------
	//Fonction d'insertion (aspect_financier)
	
	function inserer_aspect_financier($id, $id_beneficiaire, $apport_pt_forts,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4, $apportt_pt_faible,$apportt_pt_faible,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4, $calcul_pt_fort,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4, $plan_initial_pt_fort,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4, $plan_trois_ans_pt_fort,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
		$requete='SELECT * FROM  egw_prestation where id_ben='.$id_beneficiaire.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			$requete2='SELECT * FROM  egw_nacre_aspect_financier where id_beneficiaire='.$id_beneficiaire.'';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		if(mysql_num_rows($resultat)>=1 and mysql_num_rows($resultat2)>=1 )
		{
					
			/*$action_a_mener3=stripslashes($action_a_mener3);
		$action_a_mener4=stripslashes($action_a_mener4);
		$action_a_mener2=stripslashes($action_a_mener2);
$action_a_mener1=stripslashes($action_a_mener1);

$autre_pt_faible=stripslashes($autre_pt_faible);
$autre_pt_fort=stripslashes($autre_pt_fort);
$autre_pt_faible2=stripslashes($autre_pt_faible2);
$autre_pt_fort2=stripslashes($autre_pt_fort2);
$autre_pt_faible3=stripslashes($autre_pt_faible3);
$autre_pt_fort3=stripslashes($autre_pt_fort3);
$autre_pt_faible4=stripslashes($autre_pt_faible4);
$autre_pt_fort4=stripslashes($autre_pt_fort4);

$plan_trois_ans_pt_faible=stripslashes($plan_trois_ans_pt_faible);
$plan_trois_ans_pt_fort=stripslashes($plan_trois_ans_pt_fort);
$plan_trois_ans_pt_faible2=stripslashes($plan_trois_ans_pt_faible2);
$plan_trois_ans_pt_fort2=stripslashes($plan_trois_ans_pt_fort2);
$plan_trois_ans_pt_faible3=stripslashes($plan_trois_ans_pt_faible3);
$plan_trois_ans_pt_fort3=stripslashes($plan_trois_ans_pt_fort3);
$plan_trois_ans_pt_faible4=stripslashes($plan_trois_ans_pt_faible4);
$plan_trois_ans_pt_fort4=stripslashes($plan_trois_ans_pt_fort4);

$plan_initial_pt_faible=stripslashes($plan_initial_pt_faible);
$plan_initial_pt_fort=stripslashes($plan_initial_pt_fort);
$plan_initial_pt_faible2=stripslashes($plan_initial_pt_faible2);
$plan_initial_pt_fort2=stripslashes($plan_initial_pt_fort2);
$plan_initial_pt_faible3=stripslashes($plan_initial_pt_faible3);
$plan_initial_pt_fort3=stripslashes($plan_initial_pt_fort3);
$plan_initial_pt_faible4=stripslashes($plan_initial_pt_faible4);
$plan_initial_pt_fort4=stripslashes($plan_initial_pt_fort4);

$calcul_pt_faible=stripslashes($calcul_pt_faible);
$calcul_pt_fort=stripslashes($calcul_pt_fort);
$calcul_pt_faible2=stripslashes($calcul_pt_faible2);
$calcul_pt_fort2=stripslashes($calcul_pt_fort2);
$calcul_pt_faible3=stripslashes($calcul_pt_faible3);
$calcul_pt_fort3=stripslashes($calcul_pt_fort3);
$calcul_pt_faible4=stripslashes($calcul_pt_faible4);
$calcul_pt_fort4=stripslashes($calcul_pt_fort4);

$apportt_pt_faible=stripslashes($apportt_pt_faible);
$apport_pt_forts=stripslashes($apport_pt_forts);
$apportt_pt_faible2=stripslashes($apportt_pt_faible2);
$apport_pt_forts2=stripslashes($apport_pt_forts2);
$apportt_pt_faible3=stripslashes($apportt_pt_faible3);
$apport_pt_forts3=stripslashes($apport_pt_forts3);
$apportt_pt_faible4=stripslashes($apportt_pt_faible4);
$apport_pt_forts4=stripslashes($apport_pt_forts4);

$resultat_attendus4=stripslashes($resultat_attendus4);
$resultat_attendus3=stripslashes($resultat_attendus3);
$resultat_attendus2=stripslashes($resultat_attendus2);
$resultat_attendus1=stripslashes($resultat_attendus1);
$delai_de_realisation4=stripslashes($delai_de_realisation4);
$delai_de_realisation3=stripslashes($delai_de_realisation3);
$delai_de_realisation2=stripslashes($delai_de_realisation2);
$delai_de_realisation1=stripslashes($delai_de_realisation1);
$diagnostic=stripslashes($diagnostic);
$diagnostic=stripslashes($diagnostic);*/
	//$requete = "Update egw_nacre_aspect_financier set apport_pt_forts='$apport_pt_forts',apport_pt_forts2='$apport_pt_forts2',apport_pt_forts3='$apport_pt_forts3',apport_pt_forts4='$apport_pt_forts4', apportt_pt_faible='$apportt_pt_faible',apportt_pt_faible2='$apportt_pt_faible2',apportt_pt_faible3='$apportt_pt_faible3',apportt_pt_faible4='$apportt_pt_faible4', calcul_pt_fort='$calcul_pt_fort',calcul_pt_fort2='$calcul_pt_fort2',calcul_pt_fort3='$calcul_pt_fort3',calcul_pt_fort4='$calcul_pt_fort4', calcul_pt_faible='$calcul_pt_faible',calcul_pt_faible2='$calcul_pt_faible2',calcul_pt_faible3='$calcul_pt_faible3',calcul_pt_faible4='$calcul_pt_faible4', plan_initial_pt_fort='$plan_initial_pt_fort',plan_initial_pt_fort2='$plan_initial_pt_fort2',plan_initial_pt_fort3='$plan_initial_pt_fort3',plan_initial_pt_fort4='$plan_initial_pt_fort4', plan_initial_pt_faible='$plan_initial_pt_faible',plan_initial_pt_faible2='$plan_initial_pt_faible2',plan_initial_pt_faible3='$plan_initial_pt_faible3',plan_initial_pt_faible4='$plan_initial_pt_faible4', plan_trois_ans_pt_fort='$plan_trois_ans_pt_fort',plan_trois_ans_pt_fort2='$plan_trois_ans_pt_fort2',plan_trois_ans_pt_fort3='$plan_trois_ans_pt_fort3',plan_trois_ans_pt_fort4='$plan_trois_ans_pt_fort4', plan_trois_ans_pt_faible='$plan_trois_ans_pt_faible',plan_trois_ans_pt_faible2='$plan_trois_ans_pt_faible2',plan_trois_ans_pt_faible3='$plan_trois_ans_pt_faible3',plan_trois_ans_pt_faible4='$plan_trois_ans_pt_faible4', autre_pt_fort='$autre_pt_fort',autre_pt_fort2='$autre_pt_fort2',autre_pt_fort3='$autre_pt_fort3',autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2',autre_pt_faible3='$autre_pt_faible3',autre_pt_faible4='$autre_pt_faible4',action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2', delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic',id_presta='$id_presta' where id_beneficiaire=$id_beneficiaire";
	
		}
		else
		{
			$data['id_beneficiaire'] = $id_beneficiaire;
			$data['apport_pt_forts'] = $apport_pt_forts;
			$data['apport_pt_forts2'] = $apport_pt_forts2;
			$data['apport_pt_forts3'] = $apport_pt_forts3;
			$data['apport_pt_forts4'] = $apport_pt_forts4;
			$data['apportt_pt_faible'] = $apportt_pt_faible;
			$data['apportt_pt_faible2'] = $apportt_pt_faible2;
			$data['apportt_pt_faible3'] = $apportt_pt_faible3;
			$data['apportt_pt_faible4'] = $apportt_pt_faible4;
			$data['calcul_pt_fort'] = $calcul_pt_fort;
			$data['calcul_pt_fort2'] = $calcul_pt_fort2;
			$data['calcul_pt_fort3'] = $calcul_pt_fort3;
			$data['calcul_pt_fort4'] = $calcul_pt_fort4;
			$data['calcul_pt_faible'] = $calcul_pt_faible;
			$data['calcul_pt_faible2'] = $calcul_pt_faible2;
			$data['calcul_pt_faible3'] = $calcul_pt_faible3;
			$data['calcul_pt_faible4'] = $calcul_pt_faible4;
			$data['plan_initial_pt_fort'] = $plan_initial_pt_fort;
			$data['plan_initial_pt_fort2'] = $plan_initial_pt_fort2;
			$data['plan_initial_pt_fort3'] = $plan_initial_pt_fort3;
			$data['plan_initial_pt_fort4'] = $plan_initial_pt_fort4;
			$data['plan_initial_pt_faible'] = $plan_initial_pt_faible;
			$data['plan_initial_pt_faible2'] = $plan_initial_pt_faible2;
			$data['plan_initial_pt_faible3'] = $plan_initial_pt_faible3;
			$data['plan_initial_pt_faible4'] = $plan_initial_pt_faible4;
			$data['plan_trois_ans_pt_fort'] = $plan_trois_ans_pt_fort;
			$data['plan_trois_ans_pt_fort2'] = $plan_trois_ans_pt_fort2;
			$data['plan_trois_ans_pt_fort3'] = $plan_trois_ans_pt_fort3;
			$data['plan_trois_ans_pt_fort4'] = $plan_trois_ans_pt_fort4;
			$data['plan_trois_ans_pt_faible'] = $plan_trois_ans_pt_faible;
			$data['plan_trois_ans_pt_faible2'] = $plan_trois_ans_pt_faible2;
			$data['plan_trois_ans_pt_faible3'] = $plan_trois_ans_pt_faible3;
			$data['plan_trois_ans_pt_faible4'] = $plan_trois_ans_pt_faible4;
			$data['autre_pt_fort'] = $autre_pt_fort;
			$data['autre_pt_fort2'] = $autre_pt_fort2;
			$data['autre_pt_fort3'] = $autre_pt_fort3;
			$data['autre_pt_fort4'] = $autre_pt_fort4;
			$data['autre_pt_faible'] = $autre_pt_faible;
			$data['autre_pt_faible2'] = $autre_pt_faible2;
			$data['autre_pt_faible3'] = $autre_pt_faible3;
			$data['autre_pt_faible4'] = $autre_pt_faible4;
			$data['action_a_mener1'] = $action_a_mener1;
			$data['action_a_mener2'] = $action_a_mener2;
			$data['action_a_mener3'] = $action_a_mener3;
			$data['action_a_mener4'] = $action_a_mener4;
			$data['delai_de_realisation1'] = $delai_de_realisation1;
			$data['delai_de_realisation2'] = $delai_de_realisation2;
			$data['delai_de_realisation3'] = $delai_de_realisation3;
			$data['delai_de_realisation4'] = $delai_de_realisation4;
			$data['resultat_attendus1'] = $resultat_attendus1;
			$data['resultat_attendus2'] = $resultat_attendus2;
			$data['resultat_attendus3'] = $resultat_attendus3;
			$data['resultat_attendus4'] = $resultat_attendus4;
			$data['diagnostic'] = $diagnostic;
			$data['id_presta'] = $id_presta;
			
			$this->db->insert('egw_nacre_aspect_financier',$data);
	//$requete = "insert into egw_nacre_aspect_financier value ('', '$id_beneficiaire', '$apport_pt_forts','$apport_pt_forts2','$apport_pt_forts3','$apport_pt_forts4', '$apportt_pt_faible','$apportt_pt_faible2','$apportt_pt_faible3','$apportt_pt_faible4', '$calcul_pt_fort','$calcul_pt_fort2','$calcul_pt_fort3','$calcul_pt_fort4', '$calcul_pt_faible','$calcul_pt_faible2','$calcul_pt_faible3','$calcul_pt_faible4', '$plan_initial_pt_fort','$plan_initial_pt_fort2','$plan_initial_pt_fort3','$plan_initial_pt_fort4', '$plan_initial_pt_faible', '$plan_initial_pt_faible2','$plan_initial_pt_faible3','$plan_initial_pt_faible4','$plan_trois_ans_pt_fort','$plan_trois_ans_pt_fort2','$plan_trois_ans_pt_fort3','$plan_trois_ans_pt_fort4', '$plan_trois_ans_pt_faible','$plan_trois_ans_pt_faible2','$plan_trois_ans_pt_faible3','$plan_trois_ans_pt_faible4', '$autre_pt_fort','$autre_pt_fort2','$autre_pt_fort3','$autre_pt_fort4', '$autre_pt_faible','$autre_pt_faible2','$autre_pt_faible3','$autre_pt_faible4','$action_a_mener1', '$action_a_mener2', '$action_a_mener3', '$action_a_mener4', '$delai_de_realisation1', '$delai_de_realisation2', '$delai_de_realisation3', '$delai_de_realisation4', '$resultat_attendus1', '$resultat_attendus2', '$resultat_attendus3', '$resultat_attendus4', '$diagnostic','$id_presta')";
		}
	//$resultat= mysql_query($requete) or die(mysql_error());
	
	}
	
	//Fonction de mise � jour (aspect_financier)
	
function update_aspect_financier($id_beneficiaire, $apport_pt_forts,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4, $apportt_pt_faible,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4, $calcul_pt_fort,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4, $plan_initial_pt_fort,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4, $plan_trois_ans_pt_fort,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
	/*$requete = "Update egw_nacre_aspect_financier set apport_pt_forts='$apport_pt_forts',apport_pt_forts2='$apport_pt_forts2',apport_pt_forts3='$apport_pt_forts3',apport_pt_forts4='$apport_pt_forts4', apportt_pt_faible='$apportt_pt_faible',apportt_pt_faible2='$apportt_pt_faible2',apportt_pt_faible3='$apportt_pt_faible3',apportt_pt_faible4='$apportt_pt_faible4', calcul_pt_fort='$calcul_pt_fort',calcul_pt_fort2='$calcul_pt_fort2',calcul_pt_fort3='$calcul_pt_fort3',calcul_pt_fort4='$calcul_pt_fort4', calcul_pt_faible='$calcul_pt_faible',calcul_pt_faible2='$calcul_pt_faible2',calcul_pt_faible3='$calcul_pt_faible3',calcul_pt_faible4='$calcul_pt_faible4', plan_initial_pt_fort='$plan_initial_pt_fort',plan_initial_pt_fort2='$plan_initial_pt_fort2',plan_initial_pt_fort3='$plan_initial_pt_fort3',plan_initial_pt_fort4='$plan_initial_pt_fort4', plan_initial_pt_faible='$plan_initial_pt_faible',plan_initial_pt_faible2='$plan_initial_pt_faible2',plan_initial_pt_faible3='$plan_initial_pt_faible3',plan_initial_pt_faible4='$plan_initial_pt_faible4', plan_trois_ans_pt_fort='$plan_trois_ans_pt_fort',plan_trois_ans_pt_fort2='$plan_trois_ans_pt_fort2',plan_trois_ans_pt_fort3='$plan_trois_ans_pt_fort3',plan_trois_ans_pt_fort4='$plan_trois_ans_pt_fort4', plan_trois_ans_pt_faible='$plan_trois_ans_pt_faible',plan_trois_ans_pt_faible2='$plan_trois_ans_pt_faible2',plan_trois_ans_pt_faible3='$plan_trois_ans_pt_faible3',plan_trois_ans_pt_faible4='$plan_trois_ans_pt_faible4', autre_pt_fort='$autre_pt_fort',autre_pt_fort2='$autre_pt_fort2',autre_pt_fort3='$autre_pt_fort3',autre_pt_fort4='$autre_pt_fort4', autre_pt_faible='$autre_pt_faible', autre_pt_faible2='$autre_pt_faible2',autre_pt_faible3='$autre_pt_faible3',autre_pt_faible4='$autre_pt_faible4',action_a_mener1='$action_a_mener1', action_a_mener2='$action_a_mener2', action_a_mener3='$action_a_mener3', action_a_mener4='$action_a_mener4', delai_de_realisation1='$delai_de_realisation1', delai_de_realisation2='$delai_de_realisation2', delai_de_realisation3='$delai_de_realisation3', delai_de_realisation4='$delai_de_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic' where id_beneficiaire=$id_beneficiaire";
	
	$resultat = mysql_query($requete) or die(mysql_error());*/
			//$data['id_beneficiaire'] = $id_beneficiaire;
			$data['apport_pt_forts'] = $apport_pt_forts;
			$data['apport_pt_forts2'] = $apport_pt_forts2;
			$data['apport_pt_forts3'] = $apport_pt_forts3;
			$data['apport_pt_forts4'] = $apport_pt_forts4;
			$data['apportt_pt_faible'] = $apportt_pt_faible;
			$data['apportt_pt_faible2'] = $apportt_pt_faible2;
			$data['apportt_pt_faible3'] = $apportt_pt_faible3;
			$data['apportt_pt_faible4'] = $apportt_pt_faible4;
			$data['calcul_pt_fort'] = $calcul_pt_fort;
			$data['calcul_pt_fort2'] = $calcul_pt_fort2;
			$data['calcul_pt_fort3'] = $calcul_pt_fort3;
			$data['calcul_pt_fort4'] = $calcul_pt_fort4;
			$data['calcul_pt_faible'] = $calcul_pt_faible;
			$data['calcul_pt_faible2'] = $calcul_pt_faible2;
			$data['calcul_pt_faible3'] = $calcul_pt_faible3;
			$data['calcul_pt_faible4'] = $calcul_pt_faible4;
			$data['plan_initial_pt_fort'] = $plan_initial_pt_fort;
			$data['plan_initial_pt_fort2'] = $plan_initial_pt_fort2;
			$data['plan_initial_pt_fort3'] = $plan_initial_pt_fort3;
			$data['plan_initial_pt_fort4'] = $plan_initial_pt_fort4;
			$data['plan_initial_pt_faible'] = $plan_initial_pt_faible;
			$data['plan_initial_pt_faible2'] = $plan_initial_pt_faible2;
			$data['plan_initial_pt_faible3'] = $plan_initial_pt_faible3;
			$data['plan_initial_pt_faible4'] = $plan_initial_pt_faible4;
			$data['plan_trois_ans_pt_fort'] = $plan_trois_ans_pt_fort;
			$data['plan_trois_ans_pt_fort2'] = $plan_trois_ans_pt_fort2;
			$data['plan_trois_ans_pt_fort3'] = $plan_trois_ans_pt_fort3;
			$data['plan_trois_ans_pt_fort4'] = $plan_trois_ans_pt_fort4;
			$data['plan_trois_ans_pt_faible'] = $plan_trois_ans_pt_faible;
			$data['plan_trois_ans_pt_faible2'] = $plan_trois_ans_pt_faible2;
			$data['plan_trois_ans_pt_faible3'] = $plan_trois_ans_pt_faible3;
			$data['plan_trois_ans_pt_faible4'] = $plan_trois_ans_pt_faible4;
			$data['autre_pt_fort'] = $autre_pt_fort;
			$data['autre_pt_fort2'] = $autre_pt_fort2;
			$data['autre_pt_fort3'] = $autre_pt_fort3;
			$data['autre_pt_fort4'] = $autre_pt_fort4;
			$data['autre_pt_faible'] = $autre_pt_faible;
			$data['autre_pt_faible2'] = $autre_pt_faible2;
			$data['autre_pt_faible3'] = $autre_pt_faible3;
			$data['autre_pt_faible4'] = $autre_pt_faible4;
			$data['action_a_mener1'] = $action_a_mener1;
			$data['action_a_mener2'] = $action_a_mener2;
			$data['action_a_mener3'] = $action_a_mener3;
			$data['action_a_mener4'] = $action_a_mener4;
			$data['delai_de_realisation1'] = $delai_de_realisation1;
			$data['delai_de_realisation2'] = $delai_de_realisation2;
			$data['delai_de_realisation3'] = $delai_de_realisation3;
			$data['delai_de_realisation4'] = $delai_de_realisation4;
			$data['resultat_attendus1'] = $resultat_attendus1;
			$data['resultat_attendus2'] = $resultat_attendus2;
			$data['resultat_attendus3'] = $resultat_attendus3;
			$data['resultat_attendus4'] = $resultat_attendus4;
			$data['diagnostic'] = $diagnostic;
			$data['id_presta'] = $id_presta;
			
			$this->db->update('egw_nacre_aspect_financier',$data,'id_beneficiaire='.$id_beneficiaire);
			
	}
	
	//Fonction de s�lection (aspect_financier)
	
	function aspect_financier($id_presta,$id_beneficiaire)
	{	
	
	
	 
			$requete='SELECT * FROM  egw_nacre_aspect_financier  where id_beneficiaire='.$id_beneficiaire.'';

		
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
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
		}
		
		if(isset($id) and $id!=NULL)
		{
		return array($apport_pt_forts, $apportt_pt_faible, $calcul_pt_fort, $calcul_pt_faible, $plan_initial_pt_fort, $plan_initial_pt_faible, $plan_trois_ans_pt_fort, $plan_trois_ans_pt_faible, $autre_pt_fort, $autre_pt_faible, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible2, $plan_initial_pt_faible3, $plan_initial_pt_faible4,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4);
		}
	}
	
	//Fonction de v�rification 'id_beneficiaire (aspect_financier)
	
	//V�rification de l'id_beneficiaire dans la table aspect_financier
	//Si il existe faire une mise � jour , sinon le cr�er
	
	function verif_beneficiaire_aspect_financier($id_beneficiaire, $apport_pt_forts,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4, $apportt_pt_faible,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4, $calcul_pt_fort,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible, $calcul_pt_faible2, $calcul_pt_faible3, $calcul_pt_faible4, $plan_initial_pt_fort,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4, $plan_trois_ans_pt_fort,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible, $autre_pt_faible2, $autre_pt_faible3, $autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	
		{
			
			///BANQUE DE TEXTE ////
			
			if(is_numeric($delai_de_realisation1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_de_realisation1=$row['valeur'];
			$delai_de_realisation1_=addslashes($delai_de_realisation1);
		}
		
		}
		
		else
		{
			 $delai_de_realisation1_=$delai_de_realisation1;
		
		}
	
				if(is_numeric($delai_de_realisation2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_de_realisation2=$row['valeur'];
			
			$delai_de_realisation2_=addslashes($delai_de_realisation2);
		}
		
		}
		
		else
		{
			 $delai_de_realisation2_=$delai_de_realisation2;
		
		}
				if(is_numeric($delai_de_realisation3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_de_realisation3=$row['valeur'];
			
			$delai_de_realisation3_=addslashes($delai_de_realisation3);
		}
		
		}
		
		else
		{
			 $delai_de_realisation3_=$delai_de_realisation3;
		
		}
				if(is_numeric($delai_de_realisation4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_de_realisation4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_de_realisation4=$row['valeur'];
			
			$delai_de_realisation4_=addslashes($delai_de_realisation4);
		}
		
		}
		
		else
		{
			 $delai_de_realisation4_=$delai_de_realisation4;
		
		}
		
					if(is_numeric($resultat_attendus1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus1=$row['valeur'];
			
			$resultat_attendus1_=addslashes($resultat_attendus1);
		}
		
		}
		
		else
		{
			 $resultat_attendus1_=$resultat_attendus1;
		
		}
				if(is_numeric($resultat_attendus2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus2=$row['valeur'];
			
			$resultat_attendus2_=addslashes($resultat_attendus2);
		}
		
		}
		
		else
		{
			 $resultat_attendus2_=$resultat_attendus2;
		
		}
				if(is_numeric($resultat_attendus3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus3=$row['valeur'];
			$resultat_attendus3_=addslashes($resultat_attendus3);
		}
		
		}
		
		else
		{
			 $resultat_attendus3_=$resultat_attendus3;
		
		}		if(is_numeric($resultat_attendus4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus4=$row['valeur'];
			$resultat_attendus4_=addslashes($resultat_attendus4);
		}
		
		}
		
		else
		{
			 $resultat_attendus4_=$resultat_attendus4;
		
		}
			
			
			
				if(is_numeric($apport_pt_forts)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apport_pt_forts.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apport_pt_forts=$row['valeur'];
		$apport_pt_forts_=addslashes($apport_pt_forts);
		}
		
		}
		
		else
		{
			 $apport_pt_forts_=$apport_pt_forts;
		
		}
			
				if(is_numeric($apport_pt_forts2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apport_pt_forts2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apport_pt_forts2=$row['valeur'];
		$apport_pt_forts2_=addslashes($apport_pt_forts2);
		}
		
		}
		
		else
		{
			 $apport_pt_forts2_=$apport_pt_forts2;
		
		}
		
			
				if(is_numeric($apport_pt_forts3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apport_pt_forts3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apport_pt_forts3=$row['valeur'];
		$apport_pt_forts3_=addslashes($apport_pt_forts3);
		}
		
		}
		
		else
		{
			 $apport_pt_forts3_=$apport_pt_forts3;
		
		}
		
			
				if(is_numeric($apport_pt_forts4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apport_pt_forts4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apport_pt_forts4=$row['valeur'];
		$apport_pt_forts4_=addslashes($apport_pt_forts4);
		}
		
		}
		
		else
		{
			 $apport_pt_forts4_=$apport_pt_forts4;
		
		}
		
		
		
				if(is_numeric($apportt_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apportt_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apportt_pt_faible=$row['valeur'];
		$apportt_pt_faible_=addslashes($apportt_pt_faible);
		}
		
		}
		
		else
		{
			 $apportt_pt_faible_=$apportt_pt_faible;
		
		}
			if(is_numeric($apportt_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apportt_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apportt_pt_faible2=$row['valeur'];
		$apportt_pt_faible2_=addslashes($apportt_pt_faible2);
		}
		
		}
		
		else
		{
			 $apportt_pt_faible2_=$apportt_pt_faible2;
		
		}
			if(is_numeric($apportt_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apportt_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apportt_pt_faible3=$row['valeur'];
		$apportt_pt_faible3_=addslashes($apportt_pt_faible3);
		}
		
		}
		
		else
		{
			 $apportt_pt_faible3_=$apportt_pt_faible3;
		
		}
			if(is_numeric($apportt_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$apportt_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$apportt_pt_faible4=$row['valeur'];
		$apportt_pt_faible4_=addslashes($apportt_pt_faible4);
		}
		
		}
		
		else
		{
			 $apportt_pt_faible4_=$apportt_pt_faible4;
		
		}
		
		
				if(is_numeric($calcul_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_fort=$row['valeur'];
		$calcul_pt_fort_=addslashes($calcul_pt_fort);
		}
		
		}
		
		else
		{
			$calcul_pt_fort_=$calcul_pt_fort;
		
		}
			if(is_numeric($calcul_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_fort2=$row['valeur'];
		$calcul_pt_fort2_=addslashes($calcul_pt_fort2);
		}
		
		}
		
		else
		{
			$calcul_pt_fort2_=$calcul_pt_fort2;
		
		}
		
			if(is_numeric($calcul_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_fort3=$row['valeur'];
		$calcul_pt_fort3_=addslashes($calcul_pt_fort3);
		}
		
		}
		
		else
		{
			$calcul_pt_fort3_=$calcul_pt_fort3;
		
		}
		
			if(is_numeric($calcul_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_fort4=$row['valeur'];
		$calcul_pt_fort4_=addslashes($calcul_pt_fort4);
		}
		
		}
		
		else
		{
			$calcul_pt_fort4_=$calcul_pt_fort4;
		
		}
		
		
				if(is_numeric($calcul_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_faible=$row['valeur'];
			
		$calcul_pt_faible_=addslashes($calcul_pt_faible);
		}
		
		}
		
		else
		{
			$calcul_pt_faible_=$calcul_pt_faible;
		
		}
		
				if(is_numeric($calcul_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_faible2=$row['valeur'];
			
		$calcul_pt_faible2_=addslashes($calcul_pt_faible2);
		}
		
		}
		
		else
		{
			$calcul_pt_faible2_=$calcul_pt_faible2;
		
		}
		
				if(is_numeric($calcul_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_faible3=$row['valeur'];
			
		$calcul_pt_faible3_=addslashes($calcul_pt_faible3);
		}
		
		}
		
		else
		{
			$calcul_pt_faible3_=$calcul_pt_faible3;
		
		}
		
				if(is_numeric($calcul_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$calcul_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$calcul_pt_faible4=$row['valeur'];
			
		$calcul_pt_faible4_=addslashes($calcul_pt_faible4);
		}
		
		}
		
		else
		{
			$calcul_pt_faible4_=$calcul_pt_faible4;
		
		}
				if(is_numeric($plan_initial_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_fort=$row['valeur'];
			$plan_initial_pt_fort_=addslashes($plan_initial_pt_fort);
		}
		
		}
		
		else
		{
			$plan_initial_pt_fort_=$plan_initial_pt_fort;
		
		}
		if(is_numeric($plan_initial_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_fort2=$row['valeur'];
			$plan_initial_pt_fort2_=addslashes($plan_initial_pt_fort2);
		}
		
		}
		
		else
		{
			$plan_initial_pt_fort2_=$plan_initial_pt_fort2;
		
		}
		if(is_numeric($plan_initial_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_fort3=$row['valeur'];
			$plan_initial_pt_fort3_=addslashes($plan_initial_pt_fort3);
		}
		
		}
		
		else
		{
			$plan_initial_pt_fort3_=$plan_initial_pt_fort3;
		
		}
		if(is_numeric($plan_initial_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_fort4=$row['valeur'];
			$plan_initial_pt_fort4_=addslashes($plan_initial_pt_fort4);
		}
		
		}
		
		else
		{
			$plan_initial_pt_fort4_=$plan_initial_pt_fort4;
		
		}
				if(is_numeric($plan_initial_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_faible=$row['valeur'];
			$plan_initial_pt_faible_=addslashes($plan_initial_pt_faible);
		}
		
		}
		
		else
		{
			$plan_initial_pt_faible_=$plan_initial_pt_faible;
		
		}
		if(is_numeric($plan_initial_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_faible2=$row['valeur'];
			$plan_initial_pt_faible2_=addslashes($plan_initial_pt_faible2);
		}
		
		}
		
		else
		{
			$plan_initial_pt_faible2_=$plan_initial_pt_faible2;
		
		}
		if(is_numeric($plan_initial_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_faible3=$row['valeur'];
			$plan_initial_pt_faible3_=addslashes($plan_initial_pt_faible3);
		}
		
		}
		
		else
		{
			$plan_initial_pt_faible3_=$plan_initial_pt_faible3;
		
		}
		if(is_numeric($plan_initial_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_initial_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_initial_pt_faible4=$row['valeur'];
			$plan_initial_pt_faible4_=addslashes($plan_initial_pt_faible4);
		}
		
		}
		
		else
		{
			$plan_initial_pt_faible4_=$plan_initial_pt_faible4;
		
		}
				if(is_numeric($plan_trois_ans_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_fort=$row['valeur'];
			$plan_trois_ans_pt_fort_=addslashes($plan_trois_ans_pt_fort);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_fort_=$plan_trois_ans_pt_fort;
		
		}
		
		if(is_numeric($plan_trois_ans_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_fort2=$row['valeur'];
			$plan_trois_ans_pt_fort2_=addslashes($plan_trois_ans_pt_fort2);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_fort2_=$plan_trois_ans_pt_fort2;
		
		}
		if(is_numeric($plan_trois_ans_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_fort3=$row['valeur'];
			$plan_trois_ans_pt_fort3_=addslashes($plan_trois_ans_pt_fort3);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_fort3_=$plan_trois_ans_pt_fort3;
		
		}
		if(is_numeric($plan_trois_ans_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_fort4=$row['valeur'];
			$plan_trois_ans_pt_fort4_=addslashes($plan_trois_ans_pt_fort4);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_fort4_=$plan_trois_ans_pt_fort4;
		
		}
				if(is_numeric($plan_trois_ans_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_faible=$row['valeur'];
				$plan_trois_ans_pt_faible_=addslashes($plan_trois_ans_pt_faible);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_faible_=$plan_trois_ans_pt_faible;
		
		}
		if(is_numeric($plan_trois_ans_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_faible2=$row['valeur'];
				$plan_trois_ans_pt_faible2_=addslashes($plan_trois_ans_pt_faible2);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_faible2_=$plan_trois_ans_pt_faible2;
		
		}
		if(is_numeric($plan_trois_ans_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_faible3=$row['valeur'];
				$plan_trois_ans_pt_faible3_=addslashes($plan_trois_ans_pt_faible3);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_faible3_=$plan_trois_ans_pt_faible3;
		
		}
		if(is_numeric($plan_trois_ans_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$plan_trois_ans_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$plan_trois_ans_pt_faible4=$row['valeur'];
				$plan_trois_ans_pt_faible4_=addslashes($plan_trois_ans_pt_faible4);
		}
		
		}
		
		else
		{
			$plan_trois_ans_pt_faible4_=$plan_trois_ans_pt_faible4;
		
		}
				if(is_numeric($autre_pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort=$row['valeur'];
			$autre_pt_fort_=addslashes($autre_pt_fort);
		}
		
		}
		
		else
		{
			$autre_pt_fort_=$autre_pt_fort;
		
		}	
		if(is_numeric($autre_pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort2=$row['valeur'];
			$autre_pt_fort2_=addslashes($autre_pt_fort2);
		}
		
		}
		
		else
		{
			$autre_pt_fort2_=$autre_pt_fort2;
		
		}
		if(is_numeric($autre_pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort3=$row['valeur'];
			$autre_pt_fort3_=addslashes($autre_pt_fort3);
		}
		
		}
		
		else
		{
			$autre_pt_fort3_=$autre_pt_fort3;
		
		}
		if(is_numeric($autre_pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_fort4=$row['valeur'];
			$autre_pt_fort4_=addslashes($autre_pt_fort4);
		}
		
		}
		
		else
		{
			$autre_pt_fort4_=$autre_pt_fort4;
		
		}
		
		if(is_numeric($autre_pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible=$row['valeur'];
			
					$autre_pt_faible_=addslashes($autre_pt_faible);
		}
		
		}
		
		else
		{
				$autre_pt_faible_=$autre_pt_faible;
		
		}
		
		if(is_numeric($autre_pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible2=$row['valeur'];
			
					$autre_pt_faible2_=addslashes($autre_pt_faible2);
		}
		
		}
		
		else
		{
				$autre_pt_faible2_=$autre_pt_faible2;
		
		}
		
		if(is_numeric($autre_pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible3=$row['valeur'];
			
					$autre_pt_faible3_=addslashes($autre_pt_faible3);
		}
		
		}
		
		else
		{
				$autre_pt_faible3_=$autre_pt_faible3;
		
		}
		if(is_numeric($autre_pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$autre_pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$autre_pt_faible4=$row['valeur'];
			
					$autre_pt_faible4_=addslashes($autre_pt_faible4);
		}
		
		}
		
		else
		{
				$autre_pt_faible4_=$autre_pt_faible4;
		
		}
				if(is_numeric($action_a_mener1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener1=$row['valeur'];
				
					$action_a_mener1_=addslashes($action_a_mener1);
		}
		
		}
		
		else
		{
				$action_a_mener1_=$action_a_mener1;
		
		}
				if(is_numeric($action_a_mener2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener2=$row['valeur'];
			$action_a_mener2_=addslashes($action_a_mener2);
		}
		
		}
		
		else
		{
				$action_a_mener2_=$action_a_mener2;
		
		}
				if(is_numeric($action_a_mener3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener3=$row['valeur'];
		$action_a_mener3_=addslashes($action_a_mener3);
		}
		
		}
		
		else
		{
				$action_a_mener3_=$action_a_mener3;
		
		}
				if(is_numeric($action_a_mener4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_a_mener4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_a_mener4=$row['valeur'];
			$action_a_mener4_=addslashes($action_a_mener4);
		}
		
		}
		
		else
		{
				$action_a_mener4_=$action_a_mener4;
		
		}
	
		//BANQUE DE TEXTE///
		
		
		
		//1.select sur table aspect_financier where id_beneficiare=id_beneficiaire
		//aspect_financier($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_aspect_financier where id_beneficiaire='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==0)
		{
			
		/*	$action_a_mener3=addslashes($action_a_mener3);
		$action_a_mener4=addslashes($action_a_mener4);
		$action_a_mener2=addslashes($action_a_mener2);
$action_a_mener1=addslashes($action_a_mener1);

$autre_pt_faible=addslashes($autre_pt_faible);
$autre_pt_fort=addslashes($autre_pt_fort);
$autre_pt_faible2=addslashes($autre_pt_faible2);
$autre_pt_fort2=addslashes($autre_pt_fort2);
$autre_pt_faible3=addslashes($autre_pt_faible3);
$autre_pt_fort3=addslashes($autre_pt_fort3);
$autre_pt_faible4=addslashes($autre_pt_faible4);
$autre_pt_fort4=addslashes($autre_pt_fort4);

$plan_trois_ans_pt_faible=addslashes($plan_trois_ans_pt_faible);
$plan_trois_ans_pt_fort=addslashes($plan_trois_ans_pt_fort);
$plan_trois_ans_pt_faible2=addslashes($plan_trois_ans_pt_faible2);
$plan_trois_ans_pt_fort2=addslashes($plan_trois_ans_pt_fort2);
$plan_trois_ans_pt_faible3=addslashes($plan_trois_ans_pt_faible3);
$plan_trois_ans_pt_fort3=addslashes($plan_trois_ans_pt_fort3);
$plan_trois_ans_pt_faible4=addslashes($plan_trois_ans_pt_faible4);
$plan_trois_ans_pt_fort4=addslashes($plan_trois_ans_pt_fort4);

$plan_initial_pt_faible=addslashes($plan_initial_pt_faible);
$plan_initial_pt_fort=addslashes($plan_initial_pt_fort);
$plan_initial_pt_faible2=addslashes($plan_initial_pt_faible2);
$plan_initial_pt_fort2=addslashes($plan_initial_pt_fort2);
$plan_initial_pt_faible3=addslashes($plan_initial_pt_faible3);
$plan_initial_pt_fort3=addslashes($plan_initial_pt_fort3);
$plan_initial_pt_faible4=addslashes($plan_initial_pt_faible4);
$plan_initial_pt_fort4=addslashes($plan_initial_pt_fort4);

$calcul_pt_faible=addslashes($calcul_pt_faible);
$calcul_pt_fort=addslashes($calcul_pt_fort);
$calcul_pt_faible2=addslashes($calcul_pt_faible2);
$calcul_pt_fort2=addslashes($calcul_pt_fort2);
$calcul_pt_faible3=addslashes($calcul_pt_faible3);
$calcul_pt_fort3=addslashes($calcul_pt_fort3);
$calcul_pt_faible4=addslashes($calcul_pt_faible4);
$calcul_pt_fort4=addslashes($calcul_pt_fort4);

$apportt_pt_faible=addslashes($apportt_pt_faible);
$apport_pt_forts=addslashes($apport_pt_forts);
$apportt_pt_faible2=addslashes($apportt_pt_faible2);
$apport_pt_forts2=addslashes($apport_pt_forts2);
$apportt_pt_faible3=addslashes($apportt_pt_faible3);
$apport_pt_forts3=addslashes($apport_pt_forts3);
$apportt_pt_faible4=addslashes($apportt_pt_faible4);
$apport_pt_forts4=addslashes($apport_pt_forts4);

$resultat_attendus4=addslashes($resultat_attendus4);
$resultat_attendus3=addslashes($resultat_attendus3);
$resultat_attendus2=addslashes($resultat_attendus2);
$resultat_attendus1=addslashes($resultat_attendus1);
$delai_de_realisation4=addslashes($delai_de_realisation4);
$delai_de_realisation3=addslashes($delai_de_realisation3);
$delai_de_realisation2=addslashes($delai_de_realisation2);
$delai_de_realisation1=addslashes($delai_de_realisation1);
//$diagnostic=addslashes($diagnostic);*/

		 $this->inserer_aspect_financier($id, $id_beneficiaire, $apport_pt_forts,$apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4, $apportt_pt_faible,$apportt_pt_faible,$apportt_pt_faible2,$apportt_pt_faible3,$apportt_pt_faible4, $calcul_pt_fort,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4, $plan_initial_pt_fort,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4, $plan_trois_ans_pt_fort,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4, $plan_trois_ans_pt_faible,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1, $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta);
	
	}
	else
		{
			//$diagnostic_=$diagnostic;
		//$this->update_aspect_financier($id_beneficiaire, $apport_pt_forts_, $apport_pt_forts2_,$apport_pt_forts3_,$apport_pt_forts4_,$apportt_pt_faible_,$apportt_pt_faible2_,$apportt_pt_faible3_,$apportt_pt_faible4_, $calcul_pt_fort_,$calcul_pt_fort2_,$calcul_pt_fort3_,$calcul_pt_fort4_, $calcul_pt_faible_,$calcul_pt_faible2_,$calcul_pt_faible3_,$calcul_pt_faible4_, $plan_initial_pt_fort_,$plan_initial_pt_fort2_,$plan_initial_pt_fort3_,$plan_initial_pt_fort4_, $plan_initial_pt_faible_,$plan_initial_pt_faible2_,$plan_initial_pt_faible3_,$plan_initial_pt_faible4_, $plan_trois_ans_pt_fort_,$plan_trois_ans_pt_fort2_,$plan_trois_ans_pt_fort3_,$plan_trois_ans_pt_fort4_, $plan_trois_ans_pt_faible_,$plan_trois_ans_pt_faible2_,$plan_trois_ans_pt_faible3_,$plan_trois_ans_pt_faible4_, $autre_pt_fort_,$autre_pt_fort2_,$autre_pt_fort3_,$autre_pt_fort4_, $autre_pt_faible_,$autre_pt_faible2_,$autre_pt_faible3_,$autre_pt_faible4_, $action_a_mener1_, $action_a_mener2_, $action_a_mener3_, $action_a_mener4_, $delai_de_realisation1_, $delai_de_realisation2_, $delai_de_realisation3_, $delai_de_realisation4_, $resultat_attendus1_, $resultat_attendus2_, $resultat_attendus3_, $resultat_attendus4_, $diagnostic_,$id_presta);	
			$this->update_aspect_financier($id_beneficiaire, $apport_pt_forts, $apport_pt_forts2,$apport_pt_forts3,$apport_pt_forts4,$apportt_pt_faible,$apportt_pt_faible2,$apportt_pt_faible3
		,$apportt_pt_faible4, $calcul_pt_fort,$calcul_pt_fort2,$calcul_pt_fort3,$calcul_pt_fort4, $calcul_pt_faible,$calcul_pt_faible2,$calcul_pt_faible3,$calcul_pt_faible4, $plan_initial_pt_fort
		,$plan_initial_pt_fort2,$plan_initial_pt_fort3,$plan_initial_pt_fort4, $plan_initial_pt_faible,$plan_initial_pt_faible2,$plan_initial_pt_faible3,$plan_initial_pt_faible4,
		 $plan_trois_ans_pt_fort,$plan_trois_ans_pt_fort2,$plan_trois_ans_pt_fort3,$plan_trois_ans_pt_fort4,
		  $plan_trois_ans_pt_faible,$plan_trois_ans_pt_faible2,$plan_trois_ans_pt_faible3,$plan_trois_ans_pt_faible4, $autre_pt_fort,$autre_pt_fort2,$autre_pt_fort3,$autre_pt_fort4, 
		  $autre_pt_faible,$autre_pt_faible2,$autre_pt_faible3,$autre_pt_faible4, $action_a_mener1, $action_a_mener2, $action_a_mener3, $action_a_mener4, $delai_de_realisation1
		  , $delai_de_realisation2, $delai_de_realisation3, $delai_de_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta);	
		}	
	
		}
	
	
	function inserer_forme_juridique($id, $id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible,$pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
			
				if(is_numeric($pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort=$row['valeur'];
			
		}
		
		}
	
				if(is_numeric($pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort2=$row['valeur'];
			
		}
		
		}
	
				if(is_numeric($pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort3=$row['valeur'];
			
		}
		
		}
		
				if(is_numeric($pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort4=$row['valeur'];
			
		}
		}
		
		
			if(is_numeric($pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible=$row['valeur'];
			
		}
		
		}
				if(is_numeric($pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible2=$row['valeur'];
			
		}
		
		}
				if(is_numeric($pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible3=$row['valeur'];
		
		}
		
		}
				if(is_numeric($pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible4=$row['valeur'];
			
		}
		}
		
			if(is_numeric($action_mener1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener1=$row['valeur'];
			
		}
		
		}
				if(is_numeric($action_mener2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener2=$row['valeur'];
			
		}
		
		}
				if(is_numeric($action_mener3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener3=$row['valeur'];
			
		}
		
		}
				if(is_numeric($action_mener4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener4=$row['valeur'];
			
		}
		}
		
				if(is_numeric($delai_realisation1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation1=$row['valeur'];
			
		}
		
		}
				if(is_numeric($delai_realisation2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation2=$row['valeur'];
			
		}
		
		}
				if(is_numeric($delai_realisation3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation3=$row['valeur'];
			
		}
		
		}
				if(is_numeric($delai_realisation4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation4=$row['valeur'];
			
		}
		}
		
					if(is_numeric($resultat_attendus1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus1=$row['valeur'];
			
		}
		
		}
				if(is_numeric($resultat_attendus2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus2=$row['valeur'];
			
		}
		
		}
				if(is_numeric($resultat_attendus3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus3=$row['valeur'];
			
		}
		
		}
				if(is_numeric($resultat_attendus4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus4=$row['valeur'];
			
		}
		}
		
		
		
//exemple

$requete='SELECT * FROM  egw_prestation where id_ben='.$id_beneficiaire.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			$requete2='SELECT * FROM  egw_nacre_forme_juridique where id_beneficiaire='.$id_beneficiaire.'';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		if(mysql_num_rows($resultat)>=1 and mysql_num_rows($resultat2)>=1 )
		{
					
	//$requete = "Update egw_nacre_forme_juridique set pt_fort='$pt_fort', pt_fort2='$pt_fort2', pt_fort3='$pt_fort3', pt_fort4='$pt_fort4', pt_faible='$pt_faible', pt_faible2='$pt_faible2', pt_faible3='$pt_faible3', pt_faible4='$pt_faible4', action_mener1='$action_mener1', action_mener2='$action_mener2', action_mener3='$action_mener3', action_mener4='$action_mener4', delai_realisation1='$delai_realisation1', delai_realisation2='$delai_realisation2', delai_realisation3='$delai_realisation3', delai_realisation4='$delai_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic',id_presta='$id_presta' where id_beneficiaire=$id_beneficiaire";
		}
		else
		{/*
$delai_realisation2=addslashes($delai_realisation2);
$delai_realisation1=addslashes($delai_realisation1);
$action_mener4=addslashes($action_mener4);
$action_mener3=addslashes($action_mener3);
$action_mener2=addslashes($action_mener2);
$action_mener1=addslashes($action_mener1);
$pt_faible4=addslashes($pt_faible4);
$pt_faible3=addslashes($pt_faible3);
$pt_faible2=addslashes($pt_faible2);
$pt_faible=addslashes($pt_faible);
$pt_fort4=addslashes($pt_fort4);
$pt_fort3=addslashes($pt_fort3);
$pt_fort2=addslashes($pt_fort2);
$pt_fort=addslashes($pt_fort);
		$delai_realisation3=addslashes($delai_realisation3);
		$delai_realisation4=addslashes($delai_realisation4);
		$resultat_attendus1=addslashes($resultat_attendus1);
		$resultat_attendus2=addslashes($resultat_attendus2);
		$resultat_attendus3=addslashes($resultat_attendus3);
		$resultat_attendus4=addslashes($resultat_attendus4);*/
		//$diagnostic=addslashes($diagnostic);
	//$requete = "insert into egw_nacre_forme_juridique value ('', '$id_beneficiaire', '$pt_fort', '$pt_fort2', '$pt_fort3', '$pt_fort4', '$pt_faible', '$pt_faible2', '$pt_faible3', '$pt_faible4', '$action_mener1', '$action_mener2', '$action_mener3',	'$action_mener4', '$delai_realisation1', '$delai_realisation2', '$delai_realisation3', '$delai_realisation4', '$resultat_attendus1', '$resultat_attendus2', '$resultat_attendus3', '$resultat_attendus4', '$diagnostic','$id_presta')";
		$data['id_beneficiaire'] = $id_beneficiaire;
		$data['pt_fort'] = $pt_fort;
		$data['pt_fort2'] = $pt_fort2;
		$data['pt_fort3'] = $pt_fort3;
		$data['pt_fort4'] = $pt_fort4;
		$data['pt_faible'] = $pt_faible;
		$data['pt_faible2'] = $pt_faible2;
		$data['pt_faible3'] = $pt_faible3;
		$data['pt_faible4'] = $pt_faible4;
		$data['action_mener1'] = $action_mener1;
		$data['action_mener2'] = $action_mener2;
		$data['action_mener3'] = $action_mener3;
		$data['action_mener4'] = $action_mener4;
		$data['delai_realisation1'] = $delai_realisation1;
		$data['delai_realisation2'] = $delai_realisation2;
		$data['delai_realisation3'] = $delai_realisation3;
		$data['delai_realisation4'] = $delai_realisation4;
		$data['resultat_attendus1'] = $resultat_attendus1;
		$data['resultat_attendus2'] = $resultat_attendus2;
		$data['resultat_attendus3'] = $resultat_attendus3;
		$data['resultat_attendus4'] = $resultat_attendus4;
		$data['diagnostic'] = $diagnostic;
		$data['id_presta'] = $id_presta;
		
		$this->db->insert('egw_nacre_forme_juridique',$data);
		}
	//$resultat = mysql_query($requete) or die(mysql_error());
	
	}
	
	//Fonction de mise � jour (forme_juridique)
	
	function update_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible,$pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	{
			
				if(is_numeric($pt_fort)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort=$row['valeur'];
			//$pt_fort=addslashes($pt_fort);
		}
		
		}
		else
		{
			
		
		}
				if(is_numeric($pt_fort2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort2=$row['valeur'];
		//	$pt_fort2=addslashes($pt_fort2);
		}
		
		
		}
		else
		{
			
		
		}
				if(is_numeric($pt_fort3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort3=$row['valeur'];
			//$pt_fort3=addslashes($pt_fort3);
		}
		
		}
		else
		{
			
		
		}
				if(is_numeric($pt_fort4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_fort4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_fort4=$row['valeur'];
			//$pt_fort4=addslashes($pt_fort4);
		}
		}
		
		else
		{
			
		
		}
		
			if(is_numeric($pt_faible)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible=$row['valeur'];
			//$pt_faible=addslashes($pt_faible);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($pt_faible2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible2=$row['valeur'];
			//$pt_faible2=addslashes($pt_faible2);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($pt_faible3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible3=$row['valeur'];
		//$pt_faible3=addslashes($pt_faible3);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($pt_faible4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$pt_faible4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$pt_faible4=$row['valeur'];
			//$pt_faible4=addslashes($pt_faible4);
		}
		}
		else
		{
		
		}
		
			if(is_numeric($action_mener1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener1=$row['valeur'];
			//$action_mener1=addslashes($action_mener1);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($action_mener2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener2=$row['valeur'];
			//$action_mener2=addslashes($action_mener2);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($action_mener3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener3=$row['valeur'];
			//$action_mener3=addslashes($action_mener3);
		}
		
		}
		else
		{
		
		}
				if(is_numeric($action_mener4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$action_mener4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$action_mener4=$row['valeur'];
			//$action_mener4=addslashes($action_mener4);
		}
		}
		else
		{
		
		}
		
				if(is_numeric($delai_realisation1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation1=$row['valeur'];
			//$delai_realisation1=addslashes($delai_realisation1);
		}
		
		}
		else
		{
		
		
		}
		
				if(is_numeric($delai_realisation2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation2=$row['valeur'];
			//$delai_realisation2=addslashes($delai_realisation2);
		}
		
		}
		else
		{
		
		
		}
				if(is_numeric($delai_realisation3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation3=$row['valeur'];
			//$delai_realisation3=addslashes($delai_realisation3);
		}
		
		}
		else
		{
		
		
		}
				if(is_numeric($delai_realisation4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$delai_realisation4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$delai_realisation4=$row['valeur'];
			//$delai_realisation4=addslashes($delai_realisation4);
		}
		}
		else
		{
		
		
		}
					if(is_numeric($resultat_attendus1)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus1.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus1=$row['valeur'];
		//	$resultat_attendus1=addslashes($resultat_attendus1);
		}
		
		}
		else
		{
			
		}
		
				if(is_numeric($resultat_attendus2)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus2.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus2=$row['valeur'];
			//$resultat_attendus2=addslashes($resultat_attendus2);
		}
		
		}
		else
		{
			
		}
				if(is_numeric($resultat_attendus3)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus3.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus3=$row['valeur'];
			//$resultat_attendus3=addslashes($resultat_attendus3);
		}
		
		}
		else
		{
			
		}
				if(is_numeric($resultat_attendus4)==true)
		
		{
		$requete='SELECT * FROM  egw_epce_texte where id='.$resultat_attendus4.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$resultat_attendus4=$row['valeur'];
			//$resultat_attendus4=addslashes($resultat_attendus4);
		}
		}
		else
		{
			
		}
		
		
		
		
		
		
		
		
		
	
	
		
		//$diagnostic=addslashes($diagnostic);
		
		
		
	//$requete = "Update egw_nacre_forme_juridique set pt_fort='$pt_fort', pt_fort2='$pt_fort2', pt_fort3='$pt_fort3', pt_fort4='$pt_fort4', pt_faible='$pt_faible', pt_faible2='$pt_faible2', pt_faible3='$pt_faible3', pt_faible4='$pt_faible4', action_mener1='$action_mener1', action_mener2='$action_mener2', action_mener3='$action_mener3', action_mener4='$action_mener4', delai_realisation1='$delai_realisation1', delai_realisation2='$delai_realisation2', delai_realisation3='$delai_realisation3', delai_realisation4='$delai_realisation4', resultat_attendus1='$resultat_attendus1', resultat_attendus2='$resultat_attendus2', resultat_attendus3='$resultat_attendus3', resultat_attendus4='$resultat_attendus4', diagnostic='$diagnostic' where id_beneficiaire=$id_beneficiaire";
	
	
	//$resultat = mysql_query($requete) or die(mysql_error());
	
		//$data['id_beneficiaire'] = $id_beneficiaire;
		$data['pt_fort'] = $pt_fort;
		$data['pt_fort2'] = $pt_fort2;
		$data['pt_fort3'] = $pt_fort3;
		$data['pt_fort4'] = $pt_fort4;
		$data['pt_faible'] = $pt_faible;
		$data['pt_faible2'] = $pt_faible2;
		$data['pt_faible3'] = $pt_faible3;
		$data['pt_faible4'] = $pt_faible4;
		$data['action_mener1'] = $action_mener1;
		$data['action_mener2'] = $action_mener2;
		$data['action_mener3'] = $action_mener3;
		$data['action_mener4'] = $action_mener4;
		$data['delai_realisation1'] = $delai_realisation1;
		$data['delai_realisation2'] = $delai_realisation2;
		$data['delai_realisation3'] = $delai_realisation3;
		$data['delai_realisation4'] = $delai_realisation4;
		$data['resultat_attendus1'] = $resultat_attendus1;
		$data['resultat_attendus2'] = $resultat_attendus2;
		$data['resultat_attendus3'] = $resultat_attendus3;
		$data['resultat_attendus4'] = $resultat_attendus4;
		$data['diagnostic'] = $diagnostic;
		//$data['id_presta'] = $id_presta;
		
		$this->db->update('egw_nacre_forme_juridique',$data,'id_beneficiaire='.$id_beneficiaire);
	}
	
	//Fonction de s�lection (forme_juridique)
	
		function forme_juridique($id_presta,$id_beneficiaire)
	{	
	
		
		$requete='SELECT * FROM  egw_nacre_forme_juridique  where id_beneficiaire='.$id_beneficiaire.'';
	
	
		
	
	
	
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
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
		}
		if(isset($id) and $id!=NULL)
		{
		
		return array($pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener1, $action_mener2, $action_mener3, $action_mener4, $delai_realisation1, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus1, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic);
		}
			
	}
	
	// VERIFICATION JURIQUE
	
	function verif_beneficiaire_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener, $action_mener2, $action_mener3, $action_mener4, $delai_realisation, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta)
	
		{
			//////////BANQUE DE TEXTE ///////////////////

		
		
		
			//////////BANQUE DE TEXTE ///////////////////
			
			
		//1.select sur table forme_juridique where id_beneficiare=id_beneficiaire
		//forme_juridique($id_beneficiaire);
		
		$requete='SELECT * FROM  egw_nacre_forme_juridique where id_beneficiaire='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==0)
		{
		 $this->inserer_forme_juridique($id, $id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener, $action_mener2, $action_mener3, $action_mener4, $delai_realisation, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta);
	
	}
	else
		{
		$this->update_forme_juridique($id_beneficiaire, $pt_fort, $pt_fort2, $pt_fort3, $pt_fort4, $pt_faible, $pt_faible2, $pt_faible3, $pt_faible4, $action_mener, $action_mener2, $action_mener3, $action_mener4, $delai_realisation, $delai_realisation2, $delai_realisation3, $delai_realisation4, $resultat_attendus, $resultat_attendus2, $resultat_attendus3, $resultat_attendus4, $diagnostic,$id_presta);	
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
	
	//Fermeture de la connexion � la base de donn�es
	
	function verif_bilan_avis($id_beneficiaire, $avis1, $commentaire1, $avis2, $commentaire2,$r_emploi,$rome,$com_ref,$com_ben,$id_presta)
			{
		
		
		$requete='SELECT * FROM  egw_nacre_bilan_avis where id_beneficiaire='.$id_beneficiaire.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$resultat=mysql_num_rows($resultat);
		if ($resultat==NULL)
		{
	$this->inserer_bilan_avis($id_beneficiaire, $avis1, $commentaire1, $avis2, $commentaire2,$r_emploi,$rome,$com_ref,$com_ben,$id_presta);
	return 'block';
		}
	else
		{
			
	$this->update_bilan_avis($id_beneficiaire, $avis1, $commentaire1, $avis2, $commentaire2,$r_emploi,$rome,$com_ref,$com_ben,$id_presta);
	return 'none';
		}
		}
		
		
				
	function inserer_bilan_avis($id_beneficiaire, $avis1, $commentaire1, $avis2, $commentaire2,$r_emploi,$rome,$com_ref,$com_ben,$id_presta)
	{
		
		
		$requete='SELECT * FROM  egw_prestation where id_ben='.$id_beneficiaire.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			$requete2='SELECT * FROM  egw_nacre_bilan_avis where id_beneficiaire='.$id_beneficiaire.'';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		if(mysql_num_rows($resultat)>=1 and mysql_num_rows($resultat2)>=1 )
		{
			//$requete3 = "Update egw_nacre_bilan_avis set code_rome='$rome', avis1='$avis1', commentaire1='$commentaire1', avis2='$avis2', commentaire2='$commentaire2',com_ref='$com_ref',com_ben='$com_ben',  r_emploi='$r_emploi',id_presta=$id_presta where id_beneficiaire=$id_beneficiaire";
		}
		else
		{
			$data['id_beneficiaire'] = $id_beneficiaire;
	$data['avis1'] = $avis1;
	$data['commentaire1'] = $commentaire1;
	$data['avis2'] = $avis2;
	$data['commentaire2'] = $commentaire2;
	$data['r_emploi'] = $r_emploi;
	$data['code_rome'] = $rome;
	$data['com_ref'] = $com_ref;
	$data['com_ben'] = $com_ben;
	$data['id_presta'] = $id_presta;
	
	$this->db->insert('egw_nacre_bilan_avis',$data);
	//$requete3 = "insert into egw_nacre_bilan_avis value ('', '$id_beneficiaire', '$avis1', '$commentaire1', '$avis2', '$commentaire2','$r_emploi','$rome','$com_ref','$com_ben','$id_presta')";
	}
	
	//$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	}
	
	//Fonction de la mise � jour (aspect_reglementaire)
	
	function update_bilan_avis($id_beneficiaire, $avis1, $commentaire1, $avis2, $commentaire2,$r_emploi,$rome,$com_ref,$com_ben,$id_presta)
	{
	/*$requete = "Update egw_nacre_bilan_avis set code_rome='$rome', avis1='$avis1', commentaire1='$commentaire1', avis2='$avis2', commentaire2='$commentaire2',com_ref='$com_ref',com_ben='$com_ben',  r_emploi='$r_emploi' where id_beneficiaire=$id_beneficiaire";
	
	$resultat = mysql_query($requete) or die(mysql_error());*/
	$data['id_beneficiaire'] = $id_beneficiaire;
	$data['avis1'] = $avis1;
	$data['commentaire1'] = $commentaire1;
	$data['avis2'] = $avis2;
	$data['commentaire2'] = $commentaire2;
	$data['r_emploi'] = $r_emploi;
	$data['code_rome'] = $rome;
	$data['com_ref'] = $com_ref;
	$data['com_ben'] = $com_ben;
	//$data['id_presta'] = $id_presta;
	
	$this->db->update('egw_nacre_bilan_avis',$data,'id_beneficiaire='.$id_beneficiaire);
	}
	
	//Fonction de s�lection (aspect_reglementaire)
	
		function bilan_avis($id_presta,$id_beneficiaire)
	{	
	
		$requete='SELECT * FROM  egw_nacre_bilan_avis where id_beneficiaire='.$id_beneficiaire.'';
		
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
			$avis1=$row['avis1'];
			$commentaire1=$row['commentaire1'];
			$avis2=$row['avis2'];
			$commentaire2=$row['commentaire2'];
			$r_emploi=$row['r_emploi'];
			$code_rome=$row['code_rome'];
			$com_ref=$row['com_ref'];
			$com_ben=$row['com_ben'];
		}
		if(isset($id) and $id!=NULL)
		{
		return array($avis1, $commentaire1, $avis2, $commentaire2,$r_emploi ,$code_rome,$com_ref,$com_ben);
		}
			
	}	
	
	
	function _destruct()
	{
	
	mysql_close();
	}

		
}

?>