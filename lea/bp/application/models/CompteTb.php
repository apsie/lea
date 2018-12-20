<?php class CompteTb extends Zend_Db_Table
{
    protected $_name = 'karudev_comptes';
	
	
	function  selectionner($mot,$tri='date_creation',$ordre='DESC')
	{
		
		if(isset($mot) and $mot!=NULL)
		{
			return $this->fetchAll(
						   $this->select()
						          ->where('nom like ?','%'.$mot.'%')
								  ->orwhere('prenom like ?','%'.$mot.'%')
								  ->orwhere('societe like ?','%'.$mot.'%')
								  ->orwhere('fonction like ?','%'.$mot.'%')
								  ->orwhere('tel_domicile like ?','%'.$mot.'%')
								  ->orwhere('tel_portable like ?','%'.$mot.'%')
								  ->orwhere('email_perso like ?','%'.$mot.'%')
								  ->orwhere('email_pro like ?','%'.$mot.'%')
								  ->orwhere('adresse like ?','%'.$mot.'%')
								  ->orwhere('cp like ?','%'.$mot.'%')
								  ->orwhere('ville like ?','%'.$mot.'%')
								  ->orwhere('pays like ?','%'.$mot.'%')
	 							  ->order(''.$tri.' '.$ordre.'')
								 			);
		}
		else
		{
	return $this->fetchAll(
						   $this->select()
	 							  ->order(''.$tri.' '.$ordre.'')
								 			);
		}
	
	}
}
?>