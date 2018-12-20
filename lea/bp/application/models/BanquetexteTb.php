<?php class BanquetexteTb extends Zend_Db_Table
{
    protected $_name = 'egw_epce_texte';
	
		
	function  get_value($cle)
	{
		
		return $this->fetchAll(
						   $this->select()
						          ->where('intitule = ?',$cle)
								  ->order('valeur asc')		
								 			);
		
		
	
	}
	
	/*function getBanqueList()
	{
	$select = $this->select()
    ->from($this->_name,
	array('key' => 'id','value' => 'valeur'));
	$result = $this->getAdapter()->fetchAll($select);
	return $result;
	}
	*/
	
}

?>