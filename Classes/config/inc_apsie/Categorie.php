<?php
/**
 * @access public
 */

chdir('/data/html/egw_apsie_143/Classes/');
 include('config/config.php');
class Categorie {

public $id_categorie;
	/**
	 * @access public
	 */
	public function lister_categorie() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function get_categorie($id_categorie) {
		// Not yet implemented
		
if($id_categorie!=0)
		{
			$requete = 'Select *  from egw_categories where cat_id ='.$id_categorie.'';
			
			}
			elseif($this->id_categorie!=0)
			{
		$requete='select * from egw_categories where cat_id ='.$this->id_categorie.'';
		}
		else
		{
			return NULL;}
			
		return $GLOBALS['db']->fetchRow($requete);
	
		
	}
	
	public function selectionner_categorie($type)
	{
		if($type=='contact')
		{
	$requete = 'Select *  from egw_categories where cat_parent=259 order by cat_name asc ';
		}
		elseif($type=='organisation')
		{
		$requete = 'Select *  from egw_categories where cat_parent=272 order by cat_name asc ';
		}
	
	return $GLOBALS['db']->fetchAll($requete);
	}
	
	public function get_cat_by_cal_id($cal_id) {
		// Not yet implemented
		$requete = 'Select cat.cat_name  from egw_cal cal,egw_categories cat where cal.cal_category = cat.cat_id and cal.cal_id='.$cal_id.'';
		return $GLOBALS['db']->fetchRow($requete);
		
	}
	
}
?>
