<?php class CodePostalTb 
{
    
	function  ajaxSelectionnerData($cp)
	{
		
		$db = Zend_Registry::get('dbAdapter');
		$data=$db->fetchAll('select * from egw_code_postaux where cp like "'.$cp.'%" or ville1 like "'.$cp.'%" limit 10');
	  
	for($i=0;$i<count($data);$i++)
	{
		echo '<li onClick="fill_codepostal(\''.utf8_encode($data[$i]['cp']).'\',\''.utf8_encode($data[$i]['ville1']).'\',\''.utf8_encode($data[$i]['region']).'\',\''.utf8_encode($data[$i]['pays']).'\');">'.utf8_encode($data[$i]['cp']).' '.utf8_encode($data[$i]['ville1']).'</li>';
	}
	
	
	
	}
	
	
	
}

?>