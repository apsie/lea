<?php class ProduitsConcurrentsDetailsTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterProduitsDetails($id_produits_concurrents,$libelle_details,$valeur)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_produits_concurrents'=>$id_produits_concurrents,"libelle_details"=>utf8_decode($libelle_details),"valeur"=>utf8_decode($valeur));
		$db->insert('egw_bp_produits_concurrents_details',$data);
		
		
	}
	function getList($id_produits_concurrents)
	{
		$db = Zend_Registry::get('dbAdapter');
		$db->query('SET NAMES UTF8');
		$sql = "SELECT * FROM egw_bp_produits_concurrents_details where id_produits_concurrents=".$id_produits_concurrents." order by libelle_details asc";
		
		return $db->fetchAll($sql);
								 			
								 			
	}
	
	function delete($id_produit_concurrents_details)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_produits_concurrents_details='.$id_produit_concurrents_details);
		$db->delete('egw_bp_produits_concurrents_details',$data);
	}
	
	}

?>