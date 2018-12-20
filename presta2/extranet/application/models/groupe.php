<?php

class groupe extends Zend_Db_Table_Abstract
{		
	protected $_name = 'apsie_comptes';
	public $idGroup;
	public $identifiant;
	public $nom;	
	public $account_status;
	public $account_expires;
	public $account_type;
	public $account_primary_group;
	public $idDroitGroup = array();
	
	function getGroupe()
	{
		
		return $this->fetchAll( $this->select()
						          ->where('account_type = ?','g')
						          ->order('account_lid asc')
		);
	}
	
	
function getUtilisateurByIdGroup($idGroup)
	{
		global $conn;
		
		
	$sql="SELECT * FROM apsie_comptes where account_primary_group =".$idGroup." order by account_firstname asc";
	
	
		return $conn->fetchAll($sql);
		
	}

function getListGroup($idGroup)
		{global $conn;
		if($idGroup!=0)
		{
			$sql ="SELECT * FROM apsie_acl A LEFT JOIN apsie_applications B ON A.id_application = B.app_id  where A.id_group=".$idGroup." order by B.app_order asc";
			return $conn->fetchAll($sql);
		}
		}
		
function updateGroup()
	{
		global $conn;
		
		if($this->idGroup!=NULL)
		{
		$data['account_lid'] = $this->identifiant;
	
		$data['account_firstname'] = $this->nom;
		$data['account_lastname'] = 'Group';
		
		
		$conn->update($this->_name,$data,'account_id='.$this->idGroup.'');
		}
		
	
	
	}
function addGroup()
	{
		global $conn;

		$data['account_lid'] = $this->identifiant;
		$data['account_firstname'] = $this->nom;
		$data['account_lastname'] = 'Group';
		$data['account_status'] = $this->account_status;
		$data['account_expires'] = $this->account_expires;
		$data['account_type'] = $this->account_type;
		$data['account_primary_group'] = $this->account_primary_group;
		$conn->insert($this->_name,$data);

	}

	function updateGroupOfUser($idUser)
	{
		global $conn;
		
		if($idUser!=NULL)
		{
		$data['account_primary_group'] = $this->idGroup;
			
		
		$conn->update($this->_name,$data,'account_id='.$idUser);
		}
		
	
	
	}
	
	
function deleteDroitGroup()
{
	global $conn;
	$conn->delete('apsie_acl','id_group = '.$this->idGroup);	
}
	
function setDroitGroup()
	{
		global $conn;
		//print_r($this->idDroitUtilisateur);
		if(count($this->idDroitGroup)>0)
		{
		
		$conn->insert('apsie_acl',$this->idDroitGroup);
		}
	}

}


?>