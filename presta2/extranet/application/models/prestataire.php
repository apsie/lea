<?php

class prestataire extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_prestataire';
	
	
	
	function getPrestataire()
	{
		
		return $this->fetchAll( $this->select()
						          ->order('nom asc')
		);
	}
	

}


?>