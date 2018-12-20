<?php

class nacre1_emargement_impression
{
/*	 public $db_user ="root";
	 public $db_pass ="";
	 public $db_host ="localhost";
	 public $db_name ="lea";*/

	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "apsie_critere";
	 public $table_objectif = "apsie_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_organisation = "egw_organisation";
	 public $table_accounts= "apsie_comptes";
	 public $table_contact= "egw_contact";
	 public $table_parcours= "egw_contact_parcours_pro";
	 public $table_projet= "egw_projet";
 
	 
	 public $db;
 
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
	
	function imprimer_emargement($nom_beneficiaire, $prenom_beneficiaire, $id_anpe, $date_debut, $date_fin, $lettre_de_commande, $presta)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =EMARGEMENT_NACRE1_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');

//Ouvre le fichier modèle
$filename='./../doc/COUVERTURE_NACRE1/emargement_nacre1.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//*****egw_contact*****
$output = str_replace('<<NAME1>>',$nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>',$prenom_beneficiaire, $output);
$output = str_replace('<<ID_ANPE>>',$id_anpe, $output);


//*****prestation*****
$output = str_replace('<<NOM_PRESTA>>','APSIE', $output);
$output = str_replace('<<MAR_N>>','N002', $output);
$output = str_replace('<<CDE_N>>',$lettre_de_commande, $output);
$output = str_replace('<<PRESTA>>',$presta, $output);
$output = str_replace('<<DATE_DEB>>',$date_debut, $output);
$output = str_replace('<<DATE_FIN>>',$date_fin, $output);

//Envoie le document produit au navigateur
echo $output;
}

function imprimer_emargement_totalite($id_beneficiaire, $id_presta)
{
		$requete='SELECT * FROM  '.$this->table_contact.' where id_ben='.$id_beneficiaire.'';
		
		$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		$nom_beneficiaire=$row['nom'];
		$prenom_beneficiaire=$row['prenom'];
		
	}
	
	$requete='SELECT * FROM  '.$this->table_parcours.' where id_ben='.$id_beneficiaire.'';
		
		$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		$id_anpe=$row['identifiant'];	
	}
		
$requete='SELECT * FROM  '.$this->table_prestation.' where id_presta ='.$id_presta.'';
		
	$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		if($row['date_debut']!=0)
		{
		$date_debut=date("d/m/Y",$row['date_debut']);
		}
		else
		{
		$date_debut=NULL;
		}
		if($row['date_fin']!=0)
		{
		$date_fin=date("d/m/Y",$row['date_fin']);
		}
		else
		{
		$date_fin=NULL;
		}
		if($row['date_fin_reelle']!=0)
		{
			$date_fin_reelle=date("d/m/Y",$row['date_fin_reelle']);
		
		}
		else
		{
		$date_fin_reelle=NULL;
		}
		
		$lettre_de_commande=$row['lettre_de_commande'];
		$presta=$row['presta'];
	}
	
	$this->imprimer_emargement($nom_beneficiaire, $prenom_beneficiaire, $id_anpe, $date_debut, $date_fin, $lettre_de_commande, $presta);
}

	function _destruct()
	{
	mysql_close($this->db);
	
	}
	
}
?>