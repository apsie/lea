<?php class TableauSwotTb 
{
   // protected $_name = 'egw_bp_tableau_swot';
	
	
	function ajouterText($id_bp,$id_owner,$text_forces,$text_faiblesses,$text_opportunites,$text_menaces)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_bp'=>$id_bp, 
					  'id_owner'=>$id_owner,
					  'date_creation'=>time(),
					  'date_last_modified'=>time(),
					  'id_modifier'=>$id_owner,
					  'text_forces'=>utf8_decode($text_forces), 
					  'text_faiblesses'=>utf8_decode($text_faiblesses),
					  'text_opportunites'=>utf8_decode($text_opportunites),
					  'text_menaces'=>utf8_decode($text_menaces));
		$db->insert('egw_bp_tableau_swot',$data);
		
		
	}
	function getText($id_bp,$encodage='utf8')
	{
		$db = Zend_Registry::get('dbAdapter');
		//Passer les variables de la base en UTF8 pour cette requete , par soucis de compatiblité (json_encode)
		if($encodage=='utf8')
		{
		$db->query('SET NAMES UTF8');
		}
		else
		{}
		$sql = "SELECT * FROM egw_bp_tableau_swot where id_bp=".$id_bp;
		//echo $sql;
		return $db->fetchRow($sql);
		
								 			
								 			
	}
	function modifierText($id_tableau_swot,$id_owner,$text_forces,$text_faiblesses,$text_opportunites,$text_menaces)
	{
		$db = Zend_Registry::get('dbAdapter');
		$data = array('id_owner'=>$id_owner,
					  'date_creation'=>time(),
					  'date_last_modified'=>time(),
					  'id_modifier'=>$id_owner,
					  'text_forces'=>utf8_decode($text_forces), 
					  'text_faiblesses'=>utf8_decode($text_faiblesses),
					  'text_opportunites'=>utf8_decode($text_opportunites),
					  'text_menaces'=>utf8_decode($text_menaces),
		);
		$db->update('egw_bp_tableau_swot',$data,'id_tableau_swot='.$id_tableau_swot);
		
	}
	
	}

?>