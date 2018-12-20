<?php

class utilisateur extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_accounts';
	public $idUtilisateur;
	public $identifiant;
	public $nom;
	public $prenom;
	public $mdp;
	public $email;
	public $tel_pro;
	public $tel_perso;
	public $status;
	public $idGroupInitial;
	public $idPrestataire;
	public $account_expire='-1';
	public $idDroitUtilisateur = array();
	
	
	function getTotalUtilisateur($qtype=null,$query=null)
	{
		
		global $conn;
	if($query!=NULL)
		{$sqlPlus=$qtype." like '%".$query."%' AND ";}
		else
		{$sqlPlus="";}
	$sql="SELECT count(*) AS TOTAL FROM egw_accounts C 
	LEFT JOIN egw_accounts C2 ON C.account_primary_group = C2.account_id
	where ".$sqlPlus." C.account_type = 'u' ";
	//echo $sql;
		return $conn->fetchRow($sql);
		
		
	}
function getUtilisateurs($actif,$account_id_prestataire="1")
	{
		
		global $conn;
	if($actif!=NULL)
	{$actif = " AND account_status='".$actif."'";}
	else {$actif="";}
	if($actif!=NULL)
	{$sqlPlus = " AND account_id_prestataire=".$account_id_prestataire."";}
	else {$actif="";}
	$sql="SELECT *  FROM egw_accounts C 
	where  C.account_type = 'u' ".$actif." ".$sqlPlus." ORDER BY account_lid asc";
	//echo $sql;
		return $conn->fetchAll($sql);
		
		
	}
	function getUtilisateur($qtype,$query)
	{
		global $conn;
		
		if($query!=NULL)
		{$sqlPlus=$qtype." like '%".$query."%' AND ";}
		else
		{$sqlPlus="";}
	$sql="SELECT C. * , C2.account_lid AS account_group
FROM  egw_accounts C
LEFT JOIN egw_accounts C2 ON C.account_primary_group = C2.account_id
WHERE ".$sqlPlus." C.account_type = 'u' order by account_id desc";
	//echo $sql;
		return $conn->fetchAll($sql);
		
	}
function getUtilisateurById($idUtilisateur)
	{
		global $conn;
		
		
	$sql="SELECT C. * , C2.account_lid AS account_group
FROM  egw_accounts C
LEFT JOIN egw_accounts C2 ON C.account_primary_group = C2.account_id
WHERE C.account_id=".$idUtilisateur." ";
	
	
		return $conn->fetchRow($sql);
		
	}
	function insertUtilisateur()
	{
		global $conn;
		$data['account_lid'] = $this->identifiant;
		$data['account_firstname'] = $this->prenom;
		$data['account_lastname'] = $this->nom;
		$data['account_email'] = $this->email;
		$data['account_tel_pro'] = $this->tel_pro;
		$data['account_tel_perso'] = $this->tel_perso;
		$data['account_pwd'] = md5($this->mdp);
		$data['account_status'] = $this->status;
		$data['account_type'] = 'u';
		$data['account_primary_group'] = $this->idGroupInitial;
		$data['account_id_prestataire'] = $this->idPrestataire;
		$data['account_expires'] = $this->account_expire;
	//print_r($data);

  
	try {
		
		$conn->insert($this->_name,$data);
    
}
catch (Exception $e)
{
   return true;
}
	
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

	function get_employee($id_employee=NULL)
	{
		if($id_employee!=NULL or $id_employee!=0)
		{
			$requete = 'Select *  from egw_accounts where account_id= '.$id_employee.'';
			
			}
		/*elseif($this->id_employee!=NULL or $this->id_employee!=0)
		{
		$requete = 'Select *  from egw_accounts where account_id= '.$this->id_employee.'';
		}*/
		else
		{return NULL;}
		
		$result=$this->conn->fetchRow($requete);
		return array($result['account_firstname'],$result['account_lastname']);
	}
	
}

?>