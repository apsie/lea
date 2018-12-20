<?php
/**
 * eGroupware - Spireapi - 
 * SpireAPI : Module and functions set to manage referentials in eGroupware 
 *
 * @link http://www.spirea.fr
 * @package spireapi
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-10 by Spirea
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
  */
require_once(EGW_INCLUDE_ROOT. '/spireapi/inc/class.employee_so.inc.php');	

class employee_bo extends employee_so{
	
	/**
	 * Constructeur
	 *
	 */
	function employee_bo(){
		parent::employee_so();
	}
	
	function get_info($id){
	/**
	 * Retourne les information d'un employé
	 *
	 * @param $id : identifiant de l'employé
	 * @return array
	 */
		$info = $this->so_employee->search(array('account_id' => $id),false);

		$team = $this->so_team->read($info[0]['employee_team']);
		
		if(is_array($team)){
			$info[0] += $team;
		}
		
		return $info[0];
	}

	function get_info_data($id){
	/**
	 * Retourne données d'un employé
	 *
	 * @param $id : identifiant de la donnée
	 * @return array
	 */
		$info = $this->so_employee_data->search(array('employee_data_id' => $id),false);

		return $info[0];
	}

	function get_sites($level=true){
	/**
	 * Fonction de récupération des sites
	 */
		$site_ui = CreateObject('spireapi.site_ui');
		$retour = $site_ui->get_all_sites($level,'global');

		return $retour;
	}
	
	function get_areas(){
	/**
	 * Fonction de récupération des zones
	 */
		$retour = array();
		$info = $this->so_area->search(array('area_appname'=>'global'),false,'area_label');
		foreach((array)$info as $row){
			$retour[$row['area_id']] = $row['area_label'];
		}
		
		return $retour;
	}

	function get_functions($level=true){
	/**
	 * Fonction de récupération des fonctions
	 */
		$function_ui = CreateObject('spireapi.function_ui');
		$retour = $function_ui->get_functions($level);
		
		return $retour;	
	}

	function get_teams($level=true){
	/**
	 * Fonction de récupération des equipes
	 */
		$team_ui = CreateObject('spireapi.team_ui');
		$retour = $team_ui->get_teams($level);
		
		return $retour;	
	}

	function get_data($id='',$join=''){
	/**
	 * Retourne la liste des données pour l'employée $id
	 *
	 * @param $id = identifiant de l'employée
	 * @param $join = Ajout pour la requete
	 * @return array
	 */
		$return = array();
		$i = 1;

		$info = $this->so_employee_data->search(array('account_id'=>$id),false,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		foreach((array)$info as $row){
			$return[$i] = $row;
			++$i;
		}

		return $return;
	}

	function get_hourly_cost($id){
	/**
	 * Retourne le taux horaire en cours pour l'employé
	 * 
	 * @param $id = identifiant de l'employee
	 * @return 
	 */
		$join = 'WHERE employee_data_date_start <= '.time().' AND employee_data_date_end >= '.time();
		$data = $this->get_data($id,$join);
		
		return is_array($data) ? $data[1]['employee_data_hourly_cost'] : 0;
	}
	
	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les employés
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
			
		}
		
		if(!empty($query['filter']) or $query['filter']>=0 ){
				$query['col_filter']=array('employee_active'=>$query['filter']);
			}
			
		
		$order=$query['order'].' '.$query['sort'];
		$id_only=false;
		$start=array(
			(int)$query['start'],
			(int) $query['num_rows']
		);
		$wildcard = '%';
		$op = 'OR';
		if(!is_array($query['search'])){
			$search = $this->construct_search($query['search']);
		}else{
			$search=$query['search'];
		}
		
		$join= ",egw_addressbook WHERE ";
		// Recherche champ texte
		if (!empty($query['searchletter']) or !empty($query['search']) ){
			
			if (!empty($query['searchletter']) and empty($query['search']) ){
				$join.= "egw_addressbook.n_family LIKE '".$query['searchletter']."%'";
			}
			
			if (empty($query['searchletter']) and !empty($query['search']) ){
				$join.= "egw_addressbook.n_family LIKE '".$query['search']."%'"; 
			}
			
			if (!empty($query['searchletter']) and !empty($query['search']) ){
				$join.= "(egw_addressbook.n_family LIKE '".$query['search']."%' AND egw_addressbook.n_family LIKE '".$query['searchletter']."%')"; 
			}
			$join.= " AND ";
		}	
		$join .= " spireapi_employee.account_id = egw_addressbook.account_id";
		
		$rows = $this->so_employee->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		if(!$rows){
			$rows = array();
		}

		// Récupération du nom
		$so_addressbook = new so_sql('phpgwapi','egw_addressbook');
		foreach((array)$rows as $id=>$value){
			$contact = $so_addressbook->search(array('account_id' => $value['account_id']),false);
			$rows[$id]['n_family'] = $contact[0]['n_family'];
			$rows[$id]['n_given'] = $contact[0]['n_given'];

			$team = $this->so_team->read($value['employee_team']);
			$rows[$id]['team_cost_center'] = $team['team_cost_center'];

			if($query['csv_export']){
				$rows[$id]['employee_area'] = $this->id2field($this->so_area, $rows[$id]['employee_area'], 'area_label');
				$rows[$id]['employee_site'] = $this->id2field($this->so_site, $rows[$id]['employee_site'], 'site_label');
				$rows[$id]['employee_function'] = $this->id2field($this->so_function, $rows[$id]['employee_function'], 'function_title');
				$rows[$id]['employee_team'] = $this->id2field($this->so_team, $rows[$id]['employee_team'], 'team_title');


				$rows[$id]['employee_manager'] = $this->id2field($GLOBALS['egw']->accounts, $rows[$id]['employee_manager'], 'account_fullname');
				$rows[$id]['employee_car'] = $this->id2field($this->so_resource, $rows[$id]['employee_car'], 'area_label');
			}
		}
		unset($so_addressbook);

		$order = $query['order'];
		
		$GLOBALS['egw_info']['flags']['app_header'] = lang('Employee management');
		return $this->so_employee->total;	
    }
}
?>