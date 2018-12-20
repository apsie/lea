<?php
/* 
 * apsieben 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel Apsieben - Module permettant la liaison de beneficaire en tant que participant à des événements de calendrier ou en lien avec toute autre application
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */

require_once(EGW_INCLUDE_ROOT. '/apsieben/inc/class.apsieben_so.inc.php');	
	
class apsieben_bo extends apsieben_so {

	function apsieben_bo(){
	/**
	* Constructeur
	*/
		parent::__construct();
	}
	
	function link_title($entry){
	/**
	 * Retourne le titre de l'entrée avec l'identifiant $entry
	 *
	 * @param $entry int Identifiant du bénéficiaire
	 * @return string
	 */
		if (!is_array($entry)){
			$entry = $this->read($entry);
		}

		if(!empty($entry['tel_domicile_1'])){
			$tel[] = $entry['tel_domicile_1'];
		}
		if(!empty($entry['portable_perso'])){
			$tel[] = $entry['portable_perso'];
		}
		$tel_text = !empty($tel) ? ' ('.implode(' - ',$tel).')' : '';

		return $entry['nom_complet'].$tel_text;
	}

	
	function link_titles($ids){
	/**
	 * Retourne les titres de plusieurs entrées
	 *
	 * @param array $ids Tableau avec les ids à traiter
	 * @return array 
	 */
		$titles = array();
		
		$wildcard = '%';
		$op = 'OR';
		
		// Récupération et parcours des contacts
		if (($contacts = $this->search(array('id_ben' => $ids),'id_ben,nom_complet','id_ben DESC','',$wildcard,false,$op,$start,'',$join))){
			foreach((array)$contacts as $contact){
				// Récupération du titre
				$titles[$contact['id_ben']] = $this->link_title($contact);
			}
		}
		
		// On retire les entrées qui n'ont pas été trouvé
		foreach((array)$ids as $id){
			if (!isset($titles[$id])) $titles[$id] = false;
		}

		return $titles;
	}

	
	function link_query($pattern){
	/**
	 * Recherche les entrées contenant la chaine $pattern
	 *
	 * @param string $pattern Chaine a trouver
	 * @return array 
	 */
		$result = array();
		$wildcard = '%';
		$op = 'OR';
		$join = '';
		
		$result = array();
		
		// Récupération et parcours des entrées correspondantes
		foreach((array) $this->search(array('nom_complet' => $pattern,'nom' => $pattern,'prenom' => $pattern),'id_ben,nom_complet','id_ben DESC','',$wildcard,false,$op,$start,'',$join) as $item ){
			// Pour chaque entrée on récupère le nom pour l'affichage
			if ($item) $result[$item['id_ben']] = $this->link_title($item);
		}
		
		return $result;
	}

	function get_calendar_info($id_ben){
	/**
	 * Récupère les informations d'un bénéficiaire (pour le calendrier)
	 * 
	 * @param int $id_ben identifiant du bénéficiaire
	 * @return array
	 */
		// Valeur erroné / incohérente
		if(!is_array($id_ben) && $id_ben < 1) return;

		// Récupération du bénéficiaire
		$data = $this->search(array('id_ben' => $id_ben),false);
		

		// Valeur vide (aucun bénéficiaire correspondant à l'id)
		if (!is_array($data)){
			return array();
		}

		// Parcours des bénéficiaires et mise en cache
		foreach($data as $num => &$resource){
			egw_link::set_cache('apsieben',$resource['id_ben'],$t=$this->link_title($resource));
		}

		return $data;
	}

	function get_calendar_new_status($id_ben){
	/**
	 * Statut par défaut après ajout au calendrier
	 *
	 * @param int $id_ben identifiant du bénéficiaire (Inutile) 
	 * @return string
	 */
		return U;
	}
	

	
}
?>