<?php
ini_set ("error_reporting", "E_ALL & ~E_NOTICE");
class nacre1_couv_impression
{
	 /*public $db_user ="root";
	 public $db_pass ="";
	 public $db_host ="localhost";
	 public $db_name ="lea";*/
	public $db_host ="localhost";
	public $db_name ="egw_apsie143";
	public $db_user ="root";
	public $db_pass ="Spirea237Apsie";
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_organisation = "egw_organisation";
	 public $table_accounts= "egw_accounts";
	 public $table_contact= "egw_contact";
	 public $table_parcours= "egw_contact_parcours_pro";
	 public $table_projet= "egw_projet";
 
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
	
	function imprimer_couv($civilite, $nom_beneficiaire, $prenom_beneficiaire, $tel_beneficiaire, $email_beneficiaire, $projet, $date_debut, $date_fin, $date_fin_reelle, $financeur, $montant, $referent)
{

//Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =COUVERTURE_NACRE1_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');

//Ouvre le fichier modèle
$filename='./../doc/COUVERTURE_NACRE1/couverture_NACRE1.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//*****egw_contact*****
$output = str_replace('<<CIVILITE>>',$civilite, $output);
$output = str_replace('<<NOM>>',$nom_beneficiaire, $output);
$output = str_replace('<<PRENOM>>',$prenom_beneficiaire, $output);
$output = str_replace('<<TELEPHONE1>>',$tel_beneficiaire, $output);
$output = str_replace('<<EMAIL>>',$email_beneficiaire, $output);


//*****prestation*****
$output = str_replace('<<ACTION>>','Creation d\'entreprise', $output);
$output = str_replace('<<PROJET>>',$projet, $output);
$output = str_replace('<<DATE1>>',$date_debut, $output);
$output = str_replace('<<DATE2>>',$date_fin, $output);
$output = str_replace('<<DATE3>>',$date_fin_reelle, $output);
$output = str_replace('<<FINANCEUR>>',$financeur, $output);
$output = str_replace('<<MONTANT>>',$montant, $output);


$output = str_replace('<<REFERENT>>',$referent, $output);


//Envoie le document produit au navigateur
echo $output;
}

function imprimer_couv_totalite($id_beneficiaire, $id_presta)
{
		$requete='SELECT * FROM  '.$this->table_contact.' where id_ben='.$id_beneficiaire.'';
		
		$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		$civilite=$row['civilite'];
		$nom_beneficiaire=$row['nom'];
		$prenom_beneficiaire=$row['prenom'];
		$tel_beneficiaire=$row['tel_domicile_1'];
		$email_beneficiaire=$row['email_perso'];
		
	}
	
$requete='SELECT * FROM  '.$this->table_prestation.' where id_presta='.$id_presta.'';
		
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
		
		$id_referent=$row['id_ref'];
		$id_projet=$row['id_projet'];
	}
	$requete='SELECT * FROM  '.$this->table_projet.' where id_projet='.$id_projet.'';
		
		$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		$projet=$row['description_projet'];
	}
	$requete='SELECT * FROM  egw_accounts where account_id ='.$id_referent.'';
		
		$resultat=mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
		$referent=$row['account_firstname'].' '.$row['account_lastname'];
	}
	$this->imprimer_couv($civilite, $nom_beneficiaire, $prenom_beneficiaire, $tel_beneficiaire, $email_beneficiaire, $projet, $date_debut, $date_fin, $date_fin_reelle, $financeur, $montant, $referent);
}

/*function imprimer_emargegement()
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

//Remplace les marqueurs du modèle par nos données


Nom du prestataire :	<<NOM_PRESTA>>	Bénéficiaire :	<<NAME1>> <<NAME2>>
Marché n° :	<<MAR_N>>	Identifiant ANPE :	<<ID_ANPE>>


Lettre de commande n° :	<<CDE_N>>	Date de début :	<<DATE_DEB>>
Prestation :	<<PRESTA>>	Date de fin :	<<DATE_FIN>>



//*****egw_contact*****
$output = str_replace('<<NAME1>>',$nom_beneficiaire, $output);
$output = str_replace('<<NAME2>>',$prenom_beneficiaire, $output);
$output = str_replace('<<ID_ANPE>>',$tel_beneficiaire, $output);


//*****prestation*****
$output = str_replace('<<NOM_PRESTA>>','APSIE', $output);
$output = str_replace('<<MAR_N>>','N002', $output);
$output = str_replace('<<CDE_N>>',$date_debut, $output);
$output = str_replace('<<DATE_DEB>>',$date_fin, $output);
$output = str_replace('<<DATE_FIN>>',$date_reelle, $output);
$output = str_replace('<<PRESTA>>',$financeur, $output);

//Envoie le document produit au navigateur
echo $output;
}
*/	
	
	function _destruct()
	{
	mysql_close($this->db);
	
	}
	
}
?>