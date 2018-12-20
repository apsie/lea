<?php class GestionGammesProduitsTb 
{
  
	
	
	function ajouterGamme($id_bp,$idFamille,$libelle)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_famille_produit'=>$idFamille,'id_bp'=>$id_bp,"libelle_gamme"=>utf8_decode($libelle),"date_creation"=>time(),
		"id_owner"=>  unserialize($_SESSION['session']->account)->account_id);
		$db->insert('egw_bp_gamme_produits',$data);
		
		
	}
function modifierGamme($idGamme,$libelle)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array("libelle_gamme"=>utf8_decode($libelle),"id_modifier"=>unserialize($_SESSION['session']->account)->account_id,"date_last_modified"=>time());
		$db->update('egw_bp_gamme_produits',$data,'id_gamme_produit='.$idGamme);
		
		
	}
	function getList($encodage='utf8',$idFamille='')
	{
		if($idFamille!='')
		{$filtre=" WHERE F.id_famille_produit=".$idFamille;}
		else
		{$filtre="";}
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_gamme_produits G INNER JOIN egw_bp_famille_produits F ON F.id_famille_produit=G.id_famille_produit ".$filtre." order by libelle_gamme asc";
		
		return $db->fetchAll($sql);
								 			
								 			
	}
	function delete($idGammeProduits)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_gamme_produit='.$idGammeProduits);
		$db->delete('egw_bp_gamme_produits',$data);
	}
	
	}

?>