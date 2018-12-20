<?php
class Rapport_activite
{
//paramètres de connexion

	public $db_user ="egw_apsie";
	public $db_pass ="APS12/APS12";
	public $db_host ="localhost";
	public $db_name ="egw_apsie18";
	/*public $db_user ="karude43";
	public $db_pass ="y7ENw3rHn";
	public $db_host ="localhost";
	public $db_name ="karude43_extranet";*/
/*	public $db_host ="localhost";
	public $db_name ="lea";
	public $db_user ="root";
	public $db_pass ="Tim.01Mysqlv1";*/
	/*$db_host = ; 
	$db_name = ;
	$db_user = ; 
	$db_pass = ;*/
	
//variable global : id_conseiller

	public $id_conseiller ;

function __construct($id_conseiller="")
{
	
	//id_conseiller placer en variable global.
	$this->id_conseiller=$id_conseiller;
	//connexion
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

//-------------------------------------
//  FONCTION D'INSERTION COMMENTAIRE  |
//------------------------------------- 
function action($commentaire)
{
// inserer date , id_conseiller et commentaire dans la table egw_rapport_activite.
$requete = 'insert into egw_rapport_activite value ("","'.$this->id_conseiller.'","'.time().'","'.addslashes($commentaire).'")';
	$resultat= mysql_query($requete) or die(mysql_error());

}


function voir($id_con,$date)
{
	
	$dat=explode("/",$date);
$temp=mktime('0','0','0',$dat[1],$dat[0],$dat[2]);
	
// format date : 10/12/2009 vers timestamp.
// select sur egw_account pour récuperer le nom et le prenom
//return date , nom et prénom du conseiller , commentaire en fonction de l'id_conseiller et de la date.
echo'<table>';
if($id_con!=NULL)
{

$requete='SELECT  egw_rapport_activite.date, egw_rapport_activite.commentaire,apsie_comptes.account_lastname,apsie_comptes.account_firstname FROM egw_rapport_activite,apsie_comptes where id_conseiller ='.$id_con.' and account_id ='.$id_con.' and egw_rapport_activite.date>'.$temp.' order by id desc';


		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{			
			$nom=$row['account_lastname'];
			$prenom=$row['account_firstname'];
			$date=$row['date'];
			$commentaire=$row['commentaire'];
			echo '<tr><td>'.date('d/m/Y | H:i:s',$date).'</td><td> , <img src="../epce/images/icons/user_business.png" /></td><td> '.$nom.' '.$prenom.' </td><td> : '.$commentaire.'</td></tr>';
		}	
		
}
else
{
	
	
$requete='SELECT  id,id_conseiller,date,commentaire FROM egw_rapport_activite where date>'.$temp.' order by id desc';


		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{	
		$id=$row['id'];
			$id_conseiller=$row['id_conseiller'];
			$date=$row['date'];
			$commentaire=$row['commentaire'];
			
		
		$retour=$this->identite($id_conseiller);
	
				echo '<tr><td><strong>'.date('d/m/Y | H:i:s',$date).'</strong></td><td> , <img src="../epce/images/icons/user_business.png" /></td><td> '.$retour[0].' '.$retour[1].' </td><td> : '.$commentaire.'</td></tr>';
		}
		
}
echo'</table>';
}
function identite($id)
{
	
				
			$requete='SELECT  account_lastname,account_firstname FROM apsie_accounts where account_id='.$id.' ';


		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$nom=$row['account_lastname'];
			$prenom=$row['account_firstname'];
		}
		return array($nom,$prenom);

}
						



function _destruct()
{
	mysql_close();
}

}

?>