<?php class ProduitsConcurrentsTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterProduits($id_bp,$idProduit)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp,"id_produit"=>$idProduit);
		$db->insert('egw_bp_produits_concurrents',$data);
		
		
	}
	function getList($id_bp,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_produits_concurrents PC 
		INNER JOIN egw_bp_produits P ON P.id_produit = PC.id_produit 
		where PC.id_bp=".$id_bp."  
		order by P.libelle_produit asc";
		
		return $db->fetchAll($sql);
								 			
								 			
	}
	function delete($id_produit_concurrents)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_produits_concurrents='.$id_produit_concurrents);
		$db->delete('egw_bp_produits_concurrents',$data);
	}
	
	}

?>