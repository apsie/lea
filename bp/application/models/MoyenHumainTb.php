<?php class MoyenHumainTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterMoyenHumain($id_bp_moyen_humain,$id_bp,$type_moyen,$salaire,$nombre_debut,$nombre_a1,$nombre_a2,$nombre_a3)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp,"type_moyen"=>$type_moyen,"salaire_brut_mensuel"=>$salaire,"nombre_debut_activite"=>$nombre_debut,
		"nombre_annee1"=>$nombre_a1,"nombre_annee2"=>$nombre_a2,"nombre_annee3"=>$nombre_a3);

		
		if($id_bp_moyen_humain=='')
		{
		$db->insert('egw_bp_moyen_humain',$data);
		}
		else
		{
			
		$db->update('egw_bp_moyen_humain',$data,'id_bp_moyen_humain='.$id_bp_moyen_humain);
		}
		
		
	}
	function getList($id_bp,$type_moyen,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_moyen_humain where type_moyen='".$type_moyen."' and id_bp =".$id_bp;
		
		return $db->fetchRow($sql);
								 			
								 			
	}
	
	
	}

?>
