<?php class ActionCommercialeTb 
{
   
	
	
	function ajouterActionCommerciale($id_bp,$action,$budget,$dateDebut,$dateFin,$ca_escompte)
	{
		if($periode!=NULL)
		{
			$tab = explode("/",$periode);
			$periode = mktime(0,0,0,$tab[1],$tab[0],$tab[2]);
		}
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp,"action"=>utf8_decode($action),
		"budget"=>$budget,
		"date_debut"=>$dateDebut,
		"date_fin"=>$dateFin,
		"ca_escompte"=>$ca_escompte
		);
		$db->insert('egw_bp_action_commerciale',$data);
		
		
	}
function modifierActionCommerciale($id_action_commerciale,$action,$budget,$periode,$ca_escompte)
	{
		if($periode!=NULL)
		{
			$tab = explode("/",$periode);
			$periode = mktime(0,0,0,$tab[1],$tab[0],$tab[2]);
		}
		$db = Zend_Registry::get('dbAdapter');
		$data = array("action"=>utf8_decode($action),
		"budget"=>$budget,
		"periode"=>$periode,
		"ca_escompte"=>$ca_escompte
		);
		$db->update('egw_bp_action_commerciale',$data,'id_action_commerciale='.$id_action_commerciale);
		
		
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
		$sql = "SELECT * FROM egw_bp_action_commerciale where id_bp=".$id_bp." order by date_debut asc";
		
		return $db->fetchAll($sql);
								 			
								 			
	}
	function delete($id_action_commerciale)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_action_commerciale='.$id_action_commerciale);
		$db->delete('egw_bp_action_commerciale',$data);
	}
	
	}

?>