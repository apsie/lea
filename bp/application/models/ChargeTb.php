<?php class ChargeTb 
{
   // protected $_name = 'egw_bp_produits_concurrents';
	
	
	function ajouterCharge($id_bp_charge,$id_owner,$id_bp,$nature,$loyer,$credit_conso,$credit_auto,$credit_immo,$pension_alimentaire,$credit_revolving,$autre)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_owner'=>$id_owner,'date_creation'=>time(),'id_bp'=>$id_bp,"nature"=>$nature,"loyer"=>$loyer,"credit_conso"=>$credit_conso,"credit_auto"=>$credit_auto,"credit_immo"=>$credit_immo,"pension_alimentaire"=>$pension_alimentaire,
		"credit_revolving"=>$credit_revolving,'autre'=>$autre);

		
		if($id_bp_charge=='')
		{
		$db->insert('egw_bp_charge',$data);
		}
		else
		{
			$data['id_modifier']=$id_owner;
			$data['date_last_modified']=time();
		$db->update('egw_bp_charge',$data,'id_bp_charge='.$id_bp_charge);
		}
		
		
	}
	function getList($id_bp,$nature,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_charge where nature='".$nature."' and id_bp =".$id_bp;
		
		return $db->fetchRow($sql);
								 			
								 			
	}
	
	
	}

?>
