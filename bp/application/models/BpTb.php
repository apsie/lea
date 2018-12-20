<?php class BpTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp';
   
	
   
	function getValue($id_projet)
	{
			$select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
			return $this->fetchRow(
						    $select->setIntegrityCheck(false)
      		  					   ->join('egw_accounts', 'egw_accounts.account_id= egw_bp.id_referent')
								   ->where('id_projet = ?',$id_projet));
	}
	
	function addBp($data)
	{
		$this->insert($data);
	}
	function updateBp($data)
	{
		$this->update($data);
	}
	
	
	function getLastData()
	{
		$select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
			return $this->fetchRow(
						    $select->setIntegrityCheck(false)
      		  					   ->join('egw_accounts', 'egw_accounts.account_id= egw_bp.id_referent')
								 ->order('id_bp desc'));
	}
}

?>