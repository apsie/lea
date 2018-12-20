<?php class CodeNafTb 
{
    
	function  ajaxSelectionnerData($code_naf)
	{
		
		$db = Zend_Registry::get('dbAdapter');
		$data=$db->fetchAll('SELECT * FROM egw_code_naf WHERE code_naf LIKE "'.$code_naf.'%" or intitule_long LIKE "'.$code_naf.'%"  LIMIT 50');
	  
	for($i=0;$i<count($data);$i++)
	{
		echo '<li onClick="fill_codenaf(\''.$data[$i]['code_naf'].'\')">'.$data[$i]['intitule_long'].' ('.$data[$i]['code_naf'].')</li>';
		
	}
	
	
	
	}
	
	
	
}

?>