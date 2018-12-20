<?php class GestionProduitsTb 
{
  
	
	
	function ajouterProduit($id_bp,$idFamille,$idGamme,$libelle,$prixAchat,$prixVente,$stock)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('stock_initial'=>$stock,'id_gamme_produit'=>$idGamme,'id_famille_produit'=>$idFamille,'id_bp'=>$id_bp,"libelle_produit"=>utf8_decode($libelle),"date_creation"=>time(),
		"id_owner"=>  unserialize($_SESSION['session']->account)->account_id,'prix_achat'=>$prixAchat,'prix_vente'=>$prixVente);
		$db->insert('egw_bp_produits',$data);
		
		
	}
function modifierProduit($idFamille,$idGamme,$idProduit,$libelle,$prixAchat,$prixVente,$stock)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('stock_initial'=>$stock,"prix_vente"=>$prixVente,"prix_achat"=>$prixAchat,"id_famille_produit"=>$idFamille,"id_gamme_produit"=>$idGamme,"libelle_produit"=>utf8_decode($libelle),"id_modifier"=>$_SESSION['session']->account->account_id,"date_last_modified"=>time());
		$db->update('egw_bp_produits',$data,'id_produit='.$idProduit);
		
		
	}
	function getList($encodage='utf8',$id_bp,$idProduit='')
	{
		if($idProduit!='')
		{
			$filtre=" AND id_produit=".$idProduit;
		}
		else {$filtre="";}
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_produits P 
LEFT JOIN egw_bp_famille_produits F ON F.id_famille_produit=P.id_famille_produit 
LEFT JOIN egw_bp_gamme_produits G ON G.id_gamme_produit=P.id_gamme_produit  WHERE P.id_bp=".$id_bp." ".$filtre."
order by libelle_produit asc";
		return $db->fetchAll($sql);
								 			
								 			
	}
	function delete($idProduit)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_produit='.$idProduit);
		$db->delete('egw_bp_produits',$data);
	}
	
	}

?>