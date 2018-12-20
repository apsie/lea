<?php class ProjetTb extends Zend_Db_Table
{
    protected $_name = 'egw_projet';
	
	
	function  get_value($id_projet , $id_contact)
	{
		if($id_projet!='')
		{
			$select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
                       
			$data = $this->fetchRow(
						    $select->setIntegrityCheck(false)
                                
      		  					   ->joinLeft('egw_contact', 'egw_contact.id_ben= egw_projet.id_ben')
      		  					  // ->joinLeft('egw_contact_etat_civil', 'egw_contact_etat_civil.id_ben= egw_projet.id_ben')
						           ->where('id_projet = ?',$id_projet)
							
								 			);
                     //   print_r($data);die();
                        return $data;
		}
	
		elseif ($id_contact!='')
		{
		
			return $this->fetchRow(
						   $this->select()
						          ->where('id_ben = ?',$id_contact)
							
								 			);
		}
		
		
	
	}
}

?>