<?php

class organisation extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_organisation';
	public $categorie;
	public $nom_organisme;
	public $activite_principale;
	public $code_naf;
	public $raison_sociale;
	public $type_adresse;
	public $rue;
	public $adresse_ligne_2;
	public $adresse_ligne_3;
	public $cp;
	public $ville;
	public $region;
	public $pays;
	public $tel;
	public $fax;
	public $email;
	public $site_web;
	public $date_immat;
	public $date_debut_activite;
	public $forme_juridique;
	public $siret;
	public $secteur_activite;
	public $dirigeant;
	public $implantation;
	public $regime_imposition;
	public $regime_tva;
	public $regime_fiscal;
	public $regime_social_dirigeant;
	public $regime_statut;
	public $code_organisme;
	public $id_projet;
	/*function getTotalContact($qtype=null,$query=null)
	{
		
		global $conn;
	if($query!=NULL)
		{$sqlPlus=" where ".$qtype." like '%".$query."%'";}
		else
		{$sqlPlus="";}
	$sql="SELECT count(*) AS TOTAL FROM egw_contact C 
	LEFT JOIN egw_categories cat ON c.cat_id=cat.cat_id 
	LEFT JOIN egw_projet P ON P.id_ben=C.id_ben
	LEFT JOIN apsie_resacc R ON R.id_ben=C.id_ben
	 ".$sqlPlus." ";
	
		return $conn->fetchRow($sql);
		
		
	}
	function rechercherContact($mot)
	{
		global $conn;
		$sql="SELECT * FROM egw_contact where nom like '%".$mot."%' or prenom like '%".$mot."%' order by prenom";
		
		return $conn->fetchAll($sql);
	}*/

	function get($id)
	{
		global $conn;
		$sql="select * from egw_organisation where id_organisation=".$id;
		return $conn->fetchRow($sql);
	}
	function getOrganisation($qtype,$query,$cat_id)
	{
		global $conn;
		$sqlPlus="";
		$query = utf8_decode($query);
		$query = explode(';',$query);
		
		if($query[0]!="")
		{
			$sqlPlus .=" AND ";
		for($i=0;$i<count($query);$i++)
		{
		if($i==0)
		{
			$sqlPlus .=" (";
		}
		if($i>0) {
			$sqlPlus .=" OR ";
		}
		if($query[$i]!='' AND $qtype!='' )
		{$sqlPlus .="  ".$qtype." like '%".$query[$i]."%'";}
	  
		elseif($query[$i]!='' AND $qtype=='') {
			$sqlPlus .="  R.nom_organisme like '%".$query[$i]."%' OR R.activite_principale like '%".$query[$i]."%'  OR R.raison_sociale like '%".$query[$i]."%' OR R.type_adresse like '%".$query[$i]."%' OR R.adresse_ligne_1 like '%".$query[$i]."%' OR R.adresse_ligne_2 like '%".$query[$i]."%' OR R.cp like '%".$query[$i]."%' OR R.ville like '%".$query[$i]."%' OR R.region like '%".$query[$i]."%' OR R.pays like '%".$query[$i]."%' OR R.forme_juridique like '%".$query[$i]."%' OR R.siret like '%".$query[$i]."%' OR R.code_naf like '%".$query[$i]."%' OR R.secteur_activite like '%".$query[$i]."%' OR R.dirigeant like '%".$query[$i]."%' OR R.implantation like '%".$query[$i]."%' OR R.regime_imposition like '%".$query[$i]."%' OR R.regime_tva like '%".$query[$i]."%' OR R.regime_fiscal like '%".$query[$i]."%' OR R.regime_social_dirigeant like '%".$query[$i]."%' OR R.statut_org like '%".$query[$i]."%'";
		}
		
		if(!isset($query[$i+1])) {
			$sqlPlus .=" ) ";
		}
		}
		}
		//echo $cat_id;
		if($cat_id!='null')
		{
	if($cat_id[0]!="" )
		{
			$sqlcat=" AND ";
		}
		for($i=0;$i<count($cat_id);$i++)
		{
		if($i==0 && $cat_id[$i]!="")
		{
			$sqlcat .=" (";
		}
		if($i>0) {
			$sqlcat .=" OR ";
		}
		if($cat_id[$i]!="")
		{
		$sqlcat .=" R.categorie_org=".$cat_id[$i]."";
		}
	
		if(!isset($cat_id[$i+1]) && $cat_id[$i]!="") {
			$sqlcat .=" ) ";
		}
		}
		}
		

	
	$sql="SELECT R.code_org,R.categorie_org AS cat_id, cat.cat_name AS categorie_org,R.id_organisation,R.tel,R.fax,R.email,R.site_web,R.activite_principale,R.raison_sociale,R.type_adresse,R.adresse_ligne_1,
	R.adresse_ligne_2,R.adresse_ligne_3,R.cp,R.ville,R.region,R.pays,R.date_immat,R.date_debut_activite,

	R.forme_juridique,R.siret,R.code_naf,R.secteur_activite,R.dirigeant,R.implantation,R.regime_imposition,
	R.regime_tva,R.regime_fiscal,R.regime_social_dirigeant,R.statut_org,R.nom_organisme  FROM  egw_organisation R
LEFT JOIN egw_categories cat on cat.cat_id=R.categorie_org
WHERE 1  ".$sqlcat." ".$sqlPlus." 
ORDER BY R.nom_organisme ASC ";
	//echo $sql;
		
		return $conn->fetchAll($sql);
		
	}

	function insertOrganisation()
	{
		global $conn;
		
		$data['id_owner'] = $_SESSION['UTILISATEUR']['account_id'];
		$data['date_creation'] = time();
		$data['categorie_org'] = $this->categorie;
		$data['nom_organisme'] =utf8_decode($this->nom_organisme);
		$data['adresse_ligne_1'] = $this->rue;
		$data['adresse_ligne_2'] =$this->adresse_ligne_2;
		$data['adresse_ligne_3'] = $this->adresse_ligne_3;
		$data['ville'] = $this->ville;
		$data['region'] = $this->region;
		$data['cp'] = $this->cp;
		$data['pays'] = $this->pays;
		$data['tel'] = $this->tel;
		$data['fax'] = $this->fax;
		$data['email'] = $this->email;
		$data['site_web'] = $this->site_web;
		$data['secteur_activite'] =utf8_decode($this->secteur_activite);
		$data['activite_principale'] =utf8_decode($this->activite_principale);
		$data['raison_sociale'] =utf8_decode($this->raison_sociale);
		$data['type_adresse'] =utf8_decode($this->type_adresse);
		$data['date_immat'] = $this->date_immat;
		$data['date_debut_activite'] =$this->date_debut_activite;
		$data['forme_juridique'] = utf8_decode($this->forme_juridique);
		$data['siret'] = $this->siret;
		$data['code_naf'] =$this->code_naf;
		$data['dirigeant'] = utf8_decode($this->dirigeant);
		$data['implantation'] = utf8_decode($this->implantation);
		$data['regime_imposition'] =utf8_decode($this->regime_imposition);
		$data['regime_tva'] = utf8_decode($this->regime_tva);
		$data['regime_fiscal'] = utf8_decode($this->regime_fiscal);
		$data['regime_social_dirigeant'] = utf8_decode($this->regime_social_dirigeant);
		$data['statut_org'] = $this->statut;
		$data['code_org'] = $this->code_organisme;
		if($this->id_projet!=null)
		{
		$data['id_projet'] = $this->id_projet;
		}
		//print_r($data);

		$conn->insert($this->_name,$data);
	}
function updateOrganisation()
	{
		global $conn;
		
		$data['id_modifier'] = $_SESSION['UTILISATEUR']['account_id'];
		$data['date_last_modified'] = time();
	    $data['categorie_org'] = $this->categorie;
		$data['nom_organisme'] =utf8_decode($this->nom_organisme);
		$data['adresse_ligne_1'] = $this->rue;
		$data['adresse_ligne_2'] =$this->adresse_ligne_2;
		$data['adresse_ligne_3'] = $this->adresse_ligne_3;
		$data['ville'] = $this->ville;
		$data['region'] = $this->region;
		$data['cp'] = $this->cp;
		$data['pays'] = $this->pays;
		$data['tel'] = $this->tel;
		$data['fax'] = $this->fax;
		$data['email'] = $this->email;
		$data['site_web'] = $this->site_web;
		$data['secteur_activite'] =utf8_decode($this->secteur_activite);
		$data['activite_principale'] =utf8_decode($this->activite_principale);
		$data['raison_sociale'] =utf8_decode($this->raison_sociale);
		$data['type_adresse'] =utf8_decode($this->type_adresse);
		$data['date_immat'] = $this->date_immat;
		$data['date_debut_activite'] =$this->date_debut_activite;
		$data['forme_juridique'] = utf8_decode($this->forme_juridique);
		$data['siret'] = $this->siret;
		$data['code_naf'] =$this->code_naf;
		$data['dirigeant'] = utf8_decode($this->dirigeant);
		$data['implantation'] = utf8_decode($this->implantation);
		$data['regime_imposition'] =utf8_decode($this->regime_imposition);
		$data['regime_tva'] = utf8_decode($this->regime_tva);
		$data['regime_fiscal'] = utf8_decode($this->regime_fiscal);
		$data['regime_social_dirigeant'] = utf8_decode($this->regime_social_dirigeant);
		$data['statut_org'] = $this->statut;
		$data['code_org'] = $this->code_organisme;
	
     $sql="SELECT * FROM ".$this->_name." where id_organisation=".$this->id_organisation."";
    $data_ = $conn->fetchRow($sql);
    if(count($data_)>0)
    {
    	//print_r();
    	$conn->update($this->_name,$data,"id_organisation=".$this->id_organisation);
    }
    else {
    	$this->insertOrganisation();
    }
		
	}
	
	function getNbContactByOrganisation($id_organisation)
	{
		global $conn;
	$sql="SELECT count(*) AS NBCONTACT from egw_contact where id_organisation like '%".$id_organisation."%'";
	//echo $sql;
	return $conn->fetchRow($sql);

	}
function getContactByOrganisation($id_organisation)
	{
		global $conn;
	$sql="SELECT cat.cat_name,C.* from egw_contact C LEFT JOIN egw_categories cat on cat.cat_id=C.cat_id where C.id_organisation like '%".$id_organisation."%'";
	//echo $sql;
	return $conn->fetchAll($sql);

	}
/*function updateUtilisateur()
	{
		global $conn;
		
		if($this->idUtilisateur!=NULL)
		{
		$data['account_lid'] = $this->identifiant;
		$data['account_firstname'] = $this->prenom;
		$data['account_lastname'] = $this->nom;
		$data['account_email'] = $this->email;
		$data['account_tel_pro'] = $this->tel_pro;
		$data['account_tel_perso'] = $this->tel_perso;
		if($this->mdp!=NULL)
		{
		$data['account_pwd'] = md5($this->mdp);
		}
		$data['account_status'] = $this->status;
		$data['account_type'] = 'u';
		$data['account_primary_group'] = $this->idGroupInitial;
		$data['account_id_prestataire'] = $this->idPrestataire;
		$data['account_expires'] = $this->account_expire;
		
		$conn->update($this->_name,$data,'account_id='.$this->idUtilisateur.'');
		}
		
	
	
	}
	

	function setDroitUtilisateur()
	{
		global $conn;
		//print_r($this->idDroitUtilisateur);
		if(count($this->idDroitUtilisateur)>0)
		{
		
		$conn->insert('apsie_acl',$this->idDroitUtilisateur);
		}
	}
	function getListDroit($idUtilisateur)
		{global $conn;
		if($idUtilisateur!=0)
		{
			$sql ="SELECT * FROM apsie_acl A LEFT JOIN apsie_applications B ON A.id_application = B.app_id  where A.id_account=".$idUtilisateur." order by B.app_order asc";
			return $conn->fetchAll($sql);
		}
		}
		
function deleteUtilisateur()
{
	global $conn;
	$conn->delete($this->_name,'account_id = '.$this->idUtilisateur);
	$conn->delete('apsie_acl','id_account = '.$this->idUtilisateur);
}
function deleteDroitUtilisateur()
{
	global $conn;
	$conn->delete('apsie_acl','id_account = '.$this->idUtilisateur);	
}*/
}

?>