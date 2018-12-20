<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant création en masse d'évènement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

class spidating_so extends so_sql{
	
	var $spidating_dossier = 'spidating_dossier';
	var $spid_rendez_vous='spid_rendez_vous';

	var $so_statut_dossier;
	var $so_rendez_vous;
	var $so_ticket;
	
	var $account_id;
	var $obj_accounts;
	 
	/**
	 * Constructor
	 *
	 */
	function spidating_so(){
		$GLOBALS['egw_info']['user']['account_id']=$GLOBALS['egw_info']['user']['account_id'];
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$GLOBALS['egw_info']['user']['account_id'],'u');

		if($GLOBALS['egw_info']['apps']['spid']){
			$this->so_rendez_vous = new so_sql('spid',$this->spid_rendez_vous);
			$this->so_ticket = new so_sql('spid','spid_tickets');
		}

		$this->bo_calendar = new calendar_bo();
		$this->so_calendar = new calendar_so();

		$this->so_cal = new so_sql('calendar','egw_cal');
		$this->calendar_uilist = new calendar_uilist();

		$this->cat_filter[] = $this->spid_config['confirmed_intervention'];
		$this->cat_filter[] = $this->spid_config['realised_intervention'];
		$this->cat_filter[] = $this->spid_config['option_intervention'];
		$this->cat_filter[] = $this->spid_config['canceled_intervention'];
		// parent::so_sql('spidating',$this->spidating_dossier);
	}
	
	function is_manager(){
	/**
	 * Vérifie si l'utilisateur est manager ou non
	 *
	 * @return boolean
	 */
		$groupeUser = array_keys($GLOBALS['egw']->accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
		
		$config = CreateObject('phpgwapi.config');
		$obj_config = $config->read('spidating');
		
		if($GLOBALS['egw_info']['user']['apps']['admin'] || in_array($obj_config['ManagementGroup'],$groupeUser)){
			return true;
		}else{
			return false;
		}
	}
	
	function construct_search($search){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prète à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		 foreach($this->so_domaine->db_data_cols as $id=>$value){
			 $tab_search[$id]=$search;
		 }

		return $tab_search;
	}
	
	function set_readonlys(){
	/**
	 * Genere la liste des informations a mettre en readonly
	 */
		foreach($this->db_data_cols as $key => $value){
			$retour[$key] = true;
		}
		return $retour;
	}

	function phparray_jsarray($name, $array, $new=true){
	/**
	* Renvoie un code javascript créant, pour chaque objet contenu dans $array un tableau à 2 dimensiosn d'indice $name,$array[index]. Routine récursive par essence (peut donc créer des tableaux de tableaux de ... en javascript)
	*
	* @param int $name
	* @param int $array
	* @param int $new=true crée l'objet $name
	* @return string
	*/
		if(!is_array($array)){
			return '';
		}
		if($new){
			$jsCode = "$name = new Object();\n";
		}else{
			$jsCode = '';
		}
		foreach ($array as $index => $value){
			if (is_array($value)){
				$jsCode .= $name."['".$index."'] = new Object();\n";
				$jsCode .= $this->phparray_jsarray($name."['".$index."']", $value,false);
				continue;
			}

			switch(gettype($value)){
				case 'string':
					$value = '"'.str_replace(Chr(13).Chr(10),'',$value).'"';
					$value = str_replace(Chr(10),'',$value);
					//$value = "'".addcslashes($value,'</>')."'";
					break;
				case 'boolean':
					if ($value){
						$value = 'true';
					}else{
						$value = 'false';
					}
					break;
				default:
					$value = 'null';
			}
			$jsCode .= $name."['".$index."'] = ".$value.";\n";
		}
		return $jsCode;
	}

	function get_month(){
	/**
	 * Retourne la liste des mois sur un an  (permet de changer les mois disponibles)
	 *
	 * @return array
	 */
		$premierMois = date('m');
		$moisEnCours = 0;
		$annee = date('Y');

		// On parcours les 12 mois a venir (mois en cours + 5 mois)
		for($m = 0; $m < 12; ++$m){
			// Calcul du mois en cours
			if($moisEnCours == 0){
				$moisEnCours = $premierMois + $m;
			}else{
				++$moisEnCours;
			}
			// Fin de l'année on passe à l'année suivante et on ramène le mois à 1
			if($moisEnCours > 12){
				$moisEnCours -= 12;
				++$annee;
			}

			$premierDuMois = mktime(0 , 0, 0, $moisEnCours, 1, $annee);
			$retour[$premierDuMois] = lang(date('F', mktime(0 , 0, 0, $moisEnCours, 1, $annee))).' '.$annee;
		}

		return $retour;
	}

	function get_cal_cat($spid_config=false){
	/**
	 * Retourne la liste des catégories du calendrier
	 * 
	 * @return array
	 */
		$filter = $cal_cat = array();
		$cat_calendar = CreateObject('phpgwapi.categories',$GLOBALS['egw_info']['user']['account_id'],'calendar');
		$cats = $cat_calendar->return_sorted_array();

		if($spid_config){
			$filter = $this->cat_filter;

			$cal_cat[] = lang('Select a category');
		}

		foreach($cats as $cat){
			if(in_array($cat['id'],$filter) || empty($filter)){
				if($cat['parent'] != 0){
					$cal_cat[$cat['id']] = '&nbsp;&nbsp;'.$cat['name'];
				}else{
					$cal_cat[$cat['id']] = $cat['name'];
				}
			}
		}

		return $cal_cat;
	}

	function truncate($string, $limit=40, $break="-", $pad="...") { 
		// return with no change if string is shorter than $limit 
		if(strlen($string) <= $limit) return $string; 
		
		
		$string = substr($string, 0, $limit) . $pad; 

		return $string; 
	}
}
?>