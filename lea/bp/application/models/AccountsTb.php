<?php class AccountsTb extends Zend_Db_Table
{
    public $_name = 'egw_accounts';
	
	
	function  get_value($id_employe)
	{
		
		
			return $this->fetchRow(
						   $this->select()
						          ->where('account_id = ?',$id_employe)
							
								 			);
								 			
		}
		
	function getList($account_id_prestataire=1)
	{
            
		
			return $this->fetchAll(
						   $this->select()
						          ->where('account_id_prestataire = ?',$account_id_prestataire)
								  ->order('account_lid asc')
								 			);
	}
	}

?>