<?php class MoyenImmTerrainTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterMoyenImmTerrain($id_bp_moyen_imm_terrain,$id_bp,$type,$demarrage,$a1,$a2,$a3)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp,"type"=>$type,"demarrage"=>$demarrage,
		"annee1"=>$a1,"annee2"=>$a2,"annee3"=>$a3);

		
		if($id_bp_moyen_imm_terrain=='')
		{
		$db->insert('egw_bp_moyen_immeuble_terrain',$data);
		}
		else
		{
			
		$db->update('egw_bp_moyen_immeuble_terrain',$data,'id_bp_moyen_immeuble_terrain='.$id_bp_moyen_imm_terrain);
		}
		
		
	}
	function getList($id_bp,$type,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_moyen_immeuble_terrain where type='".$type."' and id_bp =".$id_bp;
		
		return $db->fetchRow($sql);
								 			
								 			
	}
	
	
	}

?>
