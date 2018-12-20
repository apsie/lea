<?php

class categorie extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_categories';
	
	
	function getCategories($type)
	{
		
    global $conn;
  //  echo $sql;
		if($type=='contact')
		{
	$sql = 'Select *  from egw_categories where cat_parent=259 order by cat_name asc ';
		}
		elseif($type=='organisation')
		{
		$sql = 'Select *  from egw_categories where cat_parent=272 order by cat_name asc ';
		}
   return $conn->fetchAll($sql);
	}
	function getCategoriesById($id)
	{
		
    global $conn;
  //  echo $sql;
		
	$sql = 'Select *  from egw_categories where cat_id='.$id.' ';
		
	
   return $conn->fetchRow($sql);
	}
	function majCategorie($id,$cat_name,$id_parent)
	{
		    global $conn;
		 $data['cat_name'] = utf8_decode($cat_name);
		if($id!="")
		{
			return $conn->update('egw_categories',$data,'cat_id='.$id);
		}
		else
		{
			 $data['cat_access'] = "public";
			 $data['cat_main'] = $id_parent;
			 $data['cat_owner'] = "-1";
			 $data['cat_parent'] = $id_parent;
			 $data['cat_level'] = 1;
			 $data['cat_appname'] = "addressbook";
			return $conn->insert('egw_categories',$data);
		}
	}
/*public function selectionner_categorie($type)
	{
		if($type=='contact')
		{
	$requete = 'Select *  from egw_categories where cat_parent=259 order by cat_name asc ';
		}
		elseif($type=='organisation')
		{
		$requete = 'Select *  from egw_categories where cat_parent=272 order by cat_name asc ';
		}
	
	return $GLOBALS['db']->fetchAll($requete);
	}
*/	
	
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
	
public function get_cat_by_cal_id($cal_id) {
	global $conn;
		// Not yet implemented
		$requete = 'Select cat.nom_dispositif as cat_name  from apsie_jqcalendar cal,egw_dispositif cat where cal.id_cal_cat = cat.id_dispositif and cal.Id='.$cal_id.'';
		return $conn->fetchRow($requete);
		
	}

}


?>