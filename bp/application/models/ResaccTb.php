<?php class ResaccTb extends Zend_Db_Table
{
    protected $_name = 'egw_resacc';
	
	
	function  get_value($id_projet)
	{
		
		
			return $this->fetchRow(
						   $this->select()
						          ->where('id_projet = ?',$id_projet)
							
								 			);
	}
		
	
	
	
	
}
?>