<?php
/* 
 * spid2 
 * SPIREA - Février 2012
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpireaRéf - Ce module est un programme informatique servant à la gestion des notes de frais
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.spiclient_bo.inc.php');

class ajax_spiclient extends spiclient_bo{

	/**
	 * Methods callable via menuaction
	 *
	 * @var array
	 */
	var $public_functions = array(
		'session' => true,
		'roles' => true,
		'status' => true,
		'account' => true,
		'op_types' => true,
		'inter_types' => true,
		'inters' => true,
		'ops' => true,
		'tasks' => true,
		'task' => true,
		'contacts' => true,
		'calendar' => true,
	);

	function ajax_spiclient()	{
		parent::spiclient_bo();
	}
	
	
	public static function session(){
	/**
	 * Liste des marques au format JSON (pour Android)
	 *
	 * @return string
	 */
	
		//_debug_array($GLOBALS['egw_info']['user'];
		$session['account_firstname'] = $GLOBALS['egw_info']['user']['account_firstname'];
		$session['account_lastname'] = $GLOBALS['egw_info']['user']['account_lastname'];
		$session['account_lastname'] = $GLOBALS['egw_info']['user']['account_email'];
		$session['account_id'] = $GLOBALS['egw_info']['user']['account_id'];
		$session['account_lid'] = $GLOBALS['egw_info']['user']['account_lid'];
		$session['person_id'] = $GLOBALS['egw_info']['user']['person_id'];
	
		$return=array();
		$return['session']=$session;
		unset($session);
	
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function roles(){
	/**
	 * Liste des marques au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['role_id'])){
			$roles = $bo_->so_role->read($_GET['role_id']);
		}else{
			$roles = $bo_->so_role->search('', 'role_id,role_label');
			// $roles = $bo_->so_role->search('', '');
		}

		$return=array();
		$return['roles']=$roles;
		unset($roles);
	
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}

	public static function status(){
	/**
	 * Liste des marques au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		if(isset($_GET['status_id'])){
			$status = $bo_->so_status->read($_GET['status_id']);
		}else{
			$status = $bo_->so_status->search('', 'status_id,status_label');
		}

		$return=array();
		$return['status']=$status;
		unset($status);
	
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function account(){
	/**
	 * Liste des marques au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		if(isset($_GET['account_id'])){
			$account = $GLOBALS['egw']->accounts->id2name($_GET['account_id'],'account_lid');
			// et pour avoir le nom...
			//$account = $GLOBALS['egw']->accounts->id2name($_GET['account_id'],'account_lastname');
		}else{
			$account = array('Access denied without id');
		}

		$return=array();
		$return['account']=$account;
		unset($account);
	
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function op_types(){
	/**
	 * Liste des types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['type_id'])){
			$op_types = $bo_->so_op_type->read($_GET['type_id']);
		}else{
			$op_types = $bo_->so_op_type->search('', false);
		}
		
		$return=array();
		$return['op_types']=$op_types;
		unset($op_types);
	
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function inter_types(){
	/**
	 * Liste des types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['type_id'])){
			$inter_types = $bo_->so_type->read($_GET['type_id']);
		}else{
			$inter_types = $bo_->so_type->search('', false);
		}

		$return=array();
		$return['inter_types']=$inter_types;
		unset($inter_types);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function inters(){
	/**
	 * Liste des sous-types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['inter_id'])){
			$query['col_filter']['inter_id'] = $_GET['inter_id'];
		}
		
		$query['col_filter']['status_id'] = explode(',',$bo_->obj_config['pending_status']);
				
		$extra_cols = array('status_label','consignment_label','planning_label','site_label', 'pm_title', 'pm_number');
		$join = " LEFT JOIN spid2_inter_contact ON spid2_inter.inter_id = spid2_inter_contact.inter_id 
				LEFT JOIN spid2_ref_status ON spid2_inter.status_id = spid2_ref_status.status_id
				LEFT JOIN egw_pm_projects ON egw_pm_projects.pm_id = spid2_inter.project_id 
				LEFT JOIN spid2_ref_consignment ON spid2_inter.consignment_id = spid2_ref_consignment.consignment_id
				LEFT JOIN spid2_ref_planning ON spid2_inter.planning_id = spid2_ref_planning.planning_id
				LEFT JOIN spireapi_site ON spid2_inter.site_id = spireapi_site.site_id
				WHERE spid2_ref_status.status_locked4egw = 1 AND
				spid2_inter_contact.account_id = ".$GLOBALS['egw_info']['user']['account_id'];
		$inters = $bo_->so_inter->search('',false,$order,$extra_cols,$wildcard,false,$op,$start,$query['col_filter'],$join);
		
		// Double controle, normalement inutile...
		if(isset($_GET['inter_id'])){
			foreach((array)$inters as $id=>$value){
				if($_GET['inter_id'] == $value['inter_id']){
					$extra_cols = array('status_label','consignment_label','planning_label','site_label', 'pm_title', 'pm_number');
					$join = '
					LEFT JOIN spid2_ref_status ON spid2_inter.status_id = spid2_ref_status.status_id
					LEFT JOIN spid2_ref_consignment ON spid2_inter.consignment_id = spid2_ref_consignment.consignment_id
					LEFT JOIN spid2_ref_planning ON spid2_inter.planning_id = spid2_ref_planning.planning_id
					LEFT JOIN spireapi_site ON spid2_inter.site_id = spireapi_site.site_id
					LEFT JOIN egw_pm_projects ON egw_pm_projects.pm_id = spid2_inter.project_id
					';
					$inters[0] = $bo_->so_inter->read($_GET['inter_id'],$extra_cols,$join);
				}
				else{
					$inters = array('Access denied');
				}
			}
		}
		
		$events = array();
		foreach((array)$inters as $id=>$value){
			$aj_ = new ajax_spid2();
			$events[$value['inter_id']] = $aj_->calendar($value['inter_id'],true);
		}
						
		$return=array();
		$return['inters']=$inters;
		$return['calendar']=$events;
		unset($inters);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function ops(){
	/**
	 * Liste des sous-types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['inter_id'])){
				$join = "
				LEFT JOIN spid2_inter ON spid2_op.inter_id = spid2_inter.inter_id 
				LEFT JOIN spid2_inter_contact ON spid2_inter.inter_id = spid2_inter_contact.inter_id 
				LEFT JOIN spid2_ref_status ON spid2_inter.status_id = spid2_ref_status.status_id 
				WHERE spid2_ref_status.status_locked4egw = 1 AND
				spid2_inter_contact.account_id = ".$GLOBALS['egw_info']['user']['account_id'];
		
			$ops = $bo_->so_op->search(array('spid2_op.inter_id' => $_GET['inter_id']),'spid2_op.*,inter_label',$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
			if(empty($ops)){$ops=array(''=>'Null or no access to this inter_id');}
		}else{
			$ops = array('Access denied without id');
		}
		
		// $bo_spinventory = new spinventory_bo();
		foreach((array)$ops as $op){
			$extra_cols = array('brand_label','type_label','subtype_label');
			$join = '
			LEFT JOIN spinventory_ref_brand ON spinventory_ref_brand.brand_id = spinventory_device.brand_id
			LEFT JOIN spinventory_ref_type ON spinventory_ref_type.type_id = spinventory_device.type_id
			LEFT JOIN spinventory_ref_subtype ON spinventory_ref_subtype.subtype_id = spinventory_device.subtype_id
			';
			$devices[] = $bo_->so_device->read($op['device_id'],$extra_cols,$join);
		}

		$return=array();
		$return['ops']=$ops;
		$return['devices']=$devices;

		unset($ops);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}

	public static function tasks(){
	/**
	 * Liste des sous-types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['op_id'])){
				$join = "
				LEFT JOIN spid2_op ON spid2_task.op_id = spid2_op.op_id 
				LEFT JOIN spid2_inter ON spid2_op.inter_id = spid2_inter.inter_id 
				LEFT JOIN spid2_inter_contact ON spid2_inter.inter_id = spid2_inter_contact.inter_id 
				LEFT JOIN spid2_ref_status ON spid2_inter.status_id = spid2_ref_status.status_id 
				WHERE spid2_ref_status.status_locked4egw = 1 AND
				spid2_inter_contact.account_id = ".$GLOBALS['egw_info']['user']['account_id'];
		
			$tasks = $bo_->so_task->search(array('spid2_task.op_id' => $_GET['op_id']), false, 'task_order ASC','',$wildcard,false,$op,$start,$query['col_filter'],$join);
			
			// $tasks = $bo_->so_op->search(array('spid2_op.inter_id' => $_GET['inter_id']),false,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
			if(empty($tasks)){$tasks=array(''=>'Null or no access to this op_id');}
		}else{
			$tasks = array('Access denied without id');
		}
		$return=array();
		$return['tasks']=$tasks;
		unset($tasks);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	public static function task(){
	/**
	 * Liste des sous-types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['task_id'])){
			$extra_cols = array('inter_id','op_label'/*,'type_result_options'*/);
			$join = " LEFT JOIN spid2_op ON spid2_task.op_id = spid2_op.op_id";
			// $join .= " LEFT JOIN spinventory_ref_task_result ON spid2_task.type_result_id = spinventory_ref_task_result.type_result_id";
			$task = $bo_->so_task->read($_GET['task_id'],$extra_cols,$join);

			if($task['type_result_id']){
				$type_result = $bo_->so_task_result->read($task['type_result_id']);
				$task['type_result_options'] = $type_result['type_result_options'];
			}else{
				$task['type_result_options'] = null;
			}
			
			if(empty($task)){$task=array(''=>'Null or no access to this op_id');}
		}else{
			$task = array('Access denied without id');
		}
		
		$return = array();
		$return['task'][] = $task;
		unset($task);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	
	public static function contacts(){
	/**
	 * Liste des sous-types au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();

		if(isset($_GET['inter_id'])){
			$extra_cols = 'n_family,n_given,role_label';
			$join = " LEFT JOIN egw_addressbook ON spid2_inter_contact.account_id = egw_addressbook.account_id";
			$join .= " LEFT JOIN spid2_ref_role ON spid2_inter_contact.role_id = spid2_ref_role.role_id";
		
			$join .= " LEFT JOIN spid2_inter ON spid2_inter_contact.inter_id = spid2_inter.inter_id 
				LEFT JOIN spid2_ref_status ON spid2_inter.status_id = spid2_ref_status.status_id 
				WHERE spid2_ref_status.status_locked4egw = 1 ";
//				AND
//				spid2_inter_contact.account_id = ".$GLOBALS['egw_info']['user']['account_id'];
		
		
			$contacts = $bo_->so_inter_contact->search(array('spid2_inter_contact.inter_id' => $_GET['inter_id']), false,$order,$extra_cols,$wildcard,false,$op,$start,'',$join,1);
			
			if(empty($contacts)){$contacts=array(''=>'Null or no access to this inter_id');}
		}else{
			$contacts = array('Access denied without id');
		}
		
		$return=array();
		$return['contacts']=$contacts;
		unset($contacts);
		
		header("Content-type: application/json; charset=utf-8");
		echo json_encode($return);
		exit;
	}
	
	
	public static function calendar($inter_id='',$app=false){
	/**
	 * Liste des calendriers associées aux interventions au format JSON (pour Android)
	 *
	 * @return string
	 */
		$bo_ = new spid2_bo();
		
		if(isset($_GET['inter_id'])){
			$inter_id = $_GET['inter_id'];
			}
		
		
		
		if($inter_id>0){
				
				$events = array();
				$i=0;
				$links = egw_link::get_links('spid2',$inter_id,'calendar');
	
				foreach((array)$links as $link=>$cal_id){
					$events = $bo_->so_calendar->read($cal_id);
					foreach((array)$events[$cal_id]['participants'] as $key => $part){					
						$events[$cal_id]['intervenants'] .= $GLOBALS['egw']->accounts->id2name($key) .' ('.$part.')<br>' ;
					}
				}
			
			if(empty($events)){$events=array(''=>'Null or no access to this inter_id');}
		}else{
			$events = array('Access denied without id');
		}
		
		$return=array();
		$return['calendar']=$events;
		unset($events);
		
		if($app == true){
				return $return;
		}
		else{		
			header("Content-type: application/json; charset=utf-8");
			echo json_encode($return);
			exit;
		}
		
	}
	
	
	
}
?>