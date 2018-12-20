<?php class GestionFamillesProduitsTb 
{
  
	
	
	function ajouterFamille($id_bp,$libelle)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp,"libelle_famille"=>utf8_decode($libelle),"date_creation"=>time(),
		"id_owner"=>  unserialize($_SESSION['session']->account)->account_id);
		$db->insert('egw_bp_famille_produits',$data);
		
		
	}
function modifierFamille($idFamille,$libelle)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array("libelle_famille"=>utf8_decode($libelle),"id_modifier"=>unserialize($_SESSION['session']->account)->account_id,"date_last_modified"=>time());
		$db->update('egw_bp_famille_produits',$data,'id_famille_produit='.$idFamille);
		
		
	}
	public static function getList($encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_famille_produits order by libelle_famille asc";
		
		return $db->fetchAll($sql);
								 			
								 			
	}
	function delete($id_famille_produits)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_famille_produit='.$id_famille_produits);
		$db->delete('egw_bp_famille_produits',$data);
	}
	
	}

?>