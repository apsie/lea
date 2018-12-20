<?php
//require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
//require_once(realpath(dirname(__FILE__)) . '/Organisation.php');

/**
 * @access public
 */
class Calendrier {

	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function selectionner_rdv($id_presta,$statut=NULL) {
		// Not yet implemented
		if($statut==NULL)
		{
		$requete = 'Select *  from egw_cal c,egw_cal_dates d where c.cal_id = d.cal_id  and c.id_presta='.$id_presta.'  order by d.cal_start asc';
		}
		else
		{
		$requete = 'Select *  from egw_cal_user u,egw_cal c,egw_cal_dates d where c.cal_id = u.cal_id and c.cal_id = d.cal_id  and c.id_presta='.$id_presta.' and u.cal_status="'.$statut.'" order by d.cal_start asc';
		}
		
		return $GLOBALS['db']->fetchAll($requete);
		
	}
	public function get_date_by_id($cal_id)
	{
	$requete = 'Select *  from  egw_cal_dates  where cal_id = '.$cal_id.'';
	return $GLOBALS['db']->fetchRow($requete);
	}
	
	public function get_date_by_tsp($tps)
	{
	
	return date('d/m/Y',$tps);
	}
}
?>