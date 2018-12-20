<?php class TexteProjetTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp_texte_projet';
	
	
	function  get_value($id_bp)
	{
		
		return $this->fetchRow(
						   $this->select()
						          ->where('id_bp = ?',$id_bp)
							
								 			);
		
		
	
	}
	function initialiser_texte($id_bp)
	{			
				//$data = array('egw_bp_texte.id_projet',Zend_Registry::get('session')->projet->id_projet);
				$row = $this->createRow();
				$row->id_bp = $id_bp;
				$row->save();
	}
	
	
	}?>