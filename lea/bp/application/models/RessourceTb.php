<?php class RessourceTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterRessource($id_bp_ressource,$id_owner,$id_bp,$personne,$revenu_pro,$retraite,$pole_emploi,$pensions,$rsa,$prestations_familiales,$aides_logement,$allocation_diverses,$autres)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_owner'=>$id_owner,'date_creation'=>time(),'id_bp'=>$id_bp,"personne"=>$personne,"revenu_pro_net"=>$revenu_pro,"retraite"=>$retraite,"pole_emploi"=>$pole_emploi,"pensions"=>$pensions,"rsa"=>$rsa,"prestations_familiales"=>$prestations_familiales
		,'aide_logement'=>$aides_logement,'allocations_diverses'=>$allocation_diverses,'autres'=>$autres);
		
		if($id_bp_ressource=='')
		{
		$db->insert('egw_bp_ressource',$data);
		}
		else
		{
			$data['id_modifier']=$id_owner;
			$data['date_last_modified']=time();
		$db->update('egw_bp_ressource',$data,'id_bp_ressource='.$id_bp_ressource);
		}
		
		
	}
	function getList($id_bp,$personne,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_ressource where personne='".$personne."' and id_bp =".$id_bp;
		
             
return $db->fetchRow($sql);
							 			
								 			
	}
	
	
	}

?>
