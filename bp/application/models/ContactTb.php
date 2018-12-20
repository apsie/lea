<?php class ContactTb extends Zend_Db_Table
{
    protected $_name = 'egw_contact';
	
	
	function  get_value($id_contact)
	{
		
		
			return $this->fetchRow(
						   $this->select()
						          ->where('id_ben = ?',$id_contact)
							
								 			);
		}
		
	
	}

?>