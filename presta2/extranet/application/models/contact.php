<?php

class contact extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_contact';
	public $id_organisation="";
	public $id_contact;
	public $cat_id;
	public $civilite;
	public $nom;
	public $prenom;
	public $deuxieme_prenom;
	public $nom_jeune_fille;
	public $fonction;
	public $adresse_ligne_1;
	public $adresse_ligne_2;
	public $ville;
	public $region;
	public $cp;
	public $pays;
	public $tel_pro_1;
	public $tel_pro_2;
	public $tel_domicile_1;
	public $tel_domicile_2;
	public $fax_pro;
	public $fax_perso;
	public $portable_pro;
	public $portable_perso;
	public $email_pro;
	public $email_perso;
	public $site_perso;
	
	
	function getTotalContact($qtype=null,$query=null)
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
		if(is_numeric($mot))
		$sql="SELECT * FROM egw_contact where id_ben = ".$mot."";
		else 
		$sql="SELECT * FROM egw_contact where nom like '%".$mot."%' or prenom like '%".$mot."%' order by prenom";
		
		return $conn->fetchAll($sql);
	}

	function getContacts($qtype='',$query='',$cat_id='',$id='')
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
			$sqlPlus .="  C.ville like '%".$query[$i]."%' OR C.nom_complet like '%".$query[$i]."%' OR C.cp like '%".$query[$i]."%' OR C.fonction like '%".$query[$i]."%'
			OR C.nom like '%".$query[$i]."%' OR C.prenom like '%".$query[$i]."%' OR C.nom_jeune_fille like '%".$query[$i]."%' OR C.civilite like '%".$query[$i]."%' 
			OR C.adresse_ligne_1 like '%".$query[$i]."%' OR C.adresse_ligne_2 like '%".$query[$i]."%' OR C.region like '%".$query[$i]."%' OR C.pays like '%".$query[$i]."%'
			OR C.tel_pro_1 like '%".$query[$i]."%' OR C.tel_pro_2 like '%".$query[$i]."%' OR C.tel_domicile_1 like '%".$query[$i]."%' OR C.tel_domicile_2 like '%".$query[$i]."%'
			OR C.fax_pro like '%".$query[$i]."%' OR C.fax_perso like '%".$query[$i]."%' OR C.portable_pro like '%".$query[$i]."%' OR C.portable_perso like '%".$query[$i]."%'
			OR C.email_pro like '%".$query[$i]."%' OR C.email_perso like '%".$query[$i]."%' OR C.site_perso like '%".$query[$i]."%' ";
		}
		
		if(!isset($query[$i+1])) {
			$sqlPlus .=" ) ";
		}
		}
		}

	$sqlcat="";
	if($cat_id[0]!="")
		{
			$sqlcat=" AND ";
		
		for($i=0;$i<count($cat_id);$i++)
		{
		if($i==0)
		{
			$sqlcat .=" (";
		}
		if($i>0) {
			$sqlcat .=" OR ";
		}
		$sqlcat .=" C.cat_id=".$cat_id[$i]."";
	
		if(!isset($cat_id[$i+1])) {
			$sqlcat .=" ) ";
		}
		}
		
		}
		if($id!='') {
			$sqlId =" AND C.id_ben=".$id." ";
		}
	$sql="SELECT  cec.date_naissance,cec.lieu_naissance,cec.nationalite,cec.situation_maritale,cec.enfants_a_charge,R.activite_principale,R.raison_sociale,R.type_adresse,R.adresse_ligne_1,
	R.adresse_ligne_2,R.cp,R.ville,R.region,R.pays,R.date_immat,R.date_debut_activite,
	R.forme_juridique,R.siret,R.code_naf,R.secteur_activite,R.dirigeant,R.implantation,R.regime_imposition,
	R.regime_tva,R.regime_fiscal,R.regime_social_dirigeant,R.statut_org,R.nom_organisme,P.description_projet,cat.cat_name AS categorie,C.nom_complet,C.ville,C.cp,C.fonction
	,C.nom,C.prenom,C.deuxieme_prenom,C.nom_jeune_fille,C.civilite,C.adresse_ligne_1,C.adresse_ligne_2,C.region,C.pays,C.tel_pro_1,C.tel_pro_2,C.tel_domicile_1,C.tel_domicile_2,
	C.fax_pro,C.fax_perso,C.portable_pro,C.portable_perso,C.email_pro,C.email_perso,C.site_perso,C.id_ben,C.cat_id FROM  egw_contact C 
	LEFT JOIN egw_categories cat ON C.cat_id=cat.cat_id
	LEFT JOIN egw_contact_etat_civil cec ON cec.id_ben = C.id_ben
	LEFT JOIN egw_projet P ON P.id_ben=C.id_ben 
	LEFT JOIN egw_organisation R ON R.id_ben=C.id_ben WHERE 1 ".$sqlcat." ".$sqlPlus." ".$sqlId." ";
	
	
		// echo $sql;
		return $conn->fetchAll($sql);
		
	}

	function insertContact()
	{
		global $conn;
		
		$data['id_owner'] = $_SESSION['UTILISATEUR']['account_id'];
		$data['date_creation'] = time();
		$data['id_organisation'] = $this->id_organisation;
		$data['cat_id'] = $this->cat_id;
		$data['nom_complet'] = utf8_decode($this->civilite.' '.$this->nom.' '.$this->prenom);
		$data['nom'] = utf8_decode($this->nom);
		$data['prenom'] =utf8_decode($this->prenom);
		$data['deuxieme_prenom'] = utf8_decode($this->deuxieme_prenom);
		$data['nom_jeune_fille'] = utf8_decode($this->nom_jeune_fille);
		$data['civilite'] = utf8_decode($this->civilite);
		$data['fonction'] = utf8_decode($this->fonction);
		$data['adresse_ligne_1'] = utf8_decode($this->adresse_ligne_1);
		$data['adresse_ligne_2'] = utf8_decode($this->adresse_ligne_2);
		$data['ville'] = utf8_decode($this->ville);
		$data['region'] = utf8_decode($this->region);
		$data['cp'] = $this->cp;
		$data['pays'] = utf8_decode($this->pays);
		$data['tel_pro_1'] = $this->tel_pro_1;
		$data['tel_pro_2'] = $this->tel_pro_2;
		$data['tel_domicile_1'] = $this->tel_domicile_1;
		$data['tel_domicile_2'] = $this->tel_domicile_2;
		$data['fax_pro'] = $this->fax_pro;
		$data['fax_perso'] = $this->fax_perso;
		$data['portable_pro'] = $this->portable_pro;
		$data['portable_perso'] = $this->portable_perso;
		$data['email_pro'] = utf8_decode($this->email_pro);
		$data['email_perso'] = utf8_decode($this->email_perso);
		$data['site_perso'] = utf8_decode($this->site_perso);
	//print_r($data);
		$conn->insert($this->_name,$data);
	}
function updateContact()
	{
		global $conn;
		
		$data['id_modifier'] = $_SESSION['UTILISATEUR']['account_id'];
		$data['date_last_modified'] = time();
		$data['cat_id'] = $this->cat_id;
		$data['nom_complet'] = utf8_decode($this->civilite.' '.$this->nom.' '.$this->prenom);
		$data['nom'] = utf8_decode($this->nom);
		$data['prenom'] =utf8_decode($this->prenom);
		$data['deuxieme_prenom'] = utf8_decode($this->deuxieme_prenom);
		$data['nom_jeune_fille'] = utf8_decode($this->nom_jeune_fille);
		$data['civilite'] = utf8_decode($this->civilite);
		$data['fonction'] = utf8_decode($this->fonction);
		$data['adresse_ligne_1'] = utf8_decode($this->adresse_ligne_1);
		$data['adresse_ligne_2'] = utf8_decode($this->adresse_ligne_2);
		$data['ville'] = utf8_decode($this->ville);
		$data['region'] = utf8_decode($this->region);
		$data['cp'] = $this->cp;
		$data['pays'] = utf8_decode($this->pays);
		$data['tel_pro_1'] = $this->tel_pro_1;
		$data['tel_pro_2'] = $this->tel_pro_2;
		$data['tel_domicile_1'] = $this->tel_domicile_1;
		$data['tel_domicile_2'] = $this->tel_domicile_2;
		$data['fax_pro'] = $this->fax_pro;
		$data['fax_perso'] = $this->fax_perso;
		$data['portable_pro'] = $this->portable_pro;
		$data['portable_perso'] = $this->portable_perso;
		$data['email_pro'] = utf8_decode($this->email_pro);
		$data['email_perso'] = utf8_decode($this->email_perso);
		$data['site_perso'] = utf8_decode($this->site_perso);
	//print_r($data);
		$conn->update($this->_name,$data,"id_ben=".$this->id_contact);
	}
function updateUtilisateur()
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
}

 function return_ids_organisme($id_ben)
	{
		global $conn;
	   $requete='SELECT id_organisation FROM  egw_contact  where id_ben='.$id_ben.'';
	
		$result=$conn->fetchRow($requete);
        return $result['id_organisation'];	
	}
	
	function inserer_id_organisation($id_ben, $id_organisation, $id_owner)
	{
		global $conn;
		if ($this->return_ids_organisme($id_ben)!=0 and ereg($this->return_ids_organisme($id_ben),$id_organisation)){
	return 1;	
		
		
}


if($this->return_ids_organisme($id_ben)!=0 and substr_count($this->return_ids_organisme($id_ben),$id_organisation)==0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','. $id_organisation;
		
	}
	elseif(substr_count($this->return_ids_organisme($id_ben),$id_organisation)==0)
	{
		
	$new_id_organisation= $id_organisation;
	
	}
	
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$conn->update('egw_contact',$data,'id_ben='.$id_ben);
	return 1;	
	/*else
	{
	$new_id_organisation=$this->return_ids_organisme($id_ben);
	}	*/																					 
	
	}
	function deleteIdOrganisation($id_ben, $id_organisation, $id_owner)
	{
	global $conn;
	
    $new_id_organisation =	str_replace(",".$id_organisation.",","",$this->return_ids_organisme($id_ben));
    $new_id_organisation =	str_replace(",".$id_organisation,"",$new_id_organisation);
    $new_id_organisation =	str_replace($id_organisation.",","",$new_id_organisation);
	$new_id_organisation =	str_replace($id_organisation,"",$new_id_organisation);
	
	
	
		//echo $new_id_organisation;
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$conn->update('egw_contact',$data,'id_ben='.$id_ben);
	return 1;
	}
	
function get_contactv2($id_contact=NULL,$id_presta=null)
	{
		//echo 'test';die();
		global $conn;
		if($id_contact!=NULL or $id_contact!=0)
		{
			$requete = 'Select *  from egw_contact where id_ben= '.$id_contact.'
			';
			
		}
		elseif($id_presta!=null)
		{
		$requete = 'Select c.id_ben as id, c.*,acpp.*  from egw_prestation pr
		LEFT JOIN egw_contact c ON c.id_ben = pr.id_ben
		LEFT JOIN egw_contact_parcours_pro acpp ON acpp.id_ben = c.id_ben AND acpp.statut="DE"
		where pr.id_presta= '.$id_presta.'';
		}
		else
		{return NULL;}
		
		//die($requete);
		return $conn->fetchRow($requete);
		
	}
	function getTel($data)
	{
		
			if($data['portable_perso']!="")
        	return "Portable Perso : <strong>" .$data['portable_perso'].'</strong>'; 
        	elseif($data['portable_pro']!="")
        	return "Portable Pro : <strong>" .$data['portable_pro'].'</strong>'; 
        	else if($data['tel_pro_1']!="")
        	return "Tel Pro 1 : <strong>" .$data['tel_pro_1'].'</strong>'; 
        	else if($data['tel_domicile_1']!="")
        	return "Tel Domicile 1 : <strong>" .$data['tel_domicile_1'].'</strong>';
        	
	}
function getTelV2($data)
	{
		
			if($data['portable_perso']!="")
        	return $data['portable_perso']; 
        	elseif($data['portable_pro']!="")
        	return $data['portable_pro']; 
        	else if($data['tel_pro_1']!="")
        	return $data['tel_pro_1']; 
        	else if($data['tel_domicile_1']!="")
        	return $data['tel_domicile_1'];
        	
	}
function getEmail($data)
	{
		
			if($data['email_perso']!="")
        	return $data['email_perso']; 
        	elseif($data['email_pro']!="")
        	return $data['email_pro']; 
        	
        	
	}
	
}

?>