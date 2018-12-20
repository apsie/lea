<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009->Juillet 2012
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.line_so.inc.php');	

class line_bo extends line_so{
	
	/**
	 * Constructor
	 *
	 */
	function line_bo(){
		parent::line_so();
	}

	function get_rows($query,&$rows,&$readonlys){
	/**
	 * Récupère et filtre les statuts
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour définir d'autres clefs comme 'filter', 'cat_id', vous devez créer une classe fille
	 * @param array &$rows lignes complétés
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilisé ici (à utiliser dans une classe fille)
	 * @return int
	 */
		if(!is_array($query['col_filter']) && empty($query['col_filter'])){
			$query['col_filter']=array();
		}
		
		$inner = $where = array();
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

		// Filtre catégorie
		if(!empty($query['filter'])){
			$query['col_filter']['extra_cat_id'] = $query['filter'];
		}

		// Filtre Client
		if(!empty($query['filter2'])){
			$where[] = 'spid_factures_details.facture_id IN (SELECT facture_id FROM spid_factures WHERE client_id = '.$query['filter2'].')';
		}

		// Filtre fournisseur
		if(!empty($query['provider'])){
			$where[] = 'spid_factures_details.facture_id IN (SELECT facture_id FROM spid_factures WHERE societe_id = '.$query['provider'].')';
		}

		$inner[] = 'INNER JOIN spid_factures ON spid_factures.facture_id = spid_factures_details.facture_id';
		// Filtre sur les années
		if(!empty($query['year'])){		
			foreach(explode(',',$query['year']) as $year){
				$start_date = mktime(0,0,0,1,1,$year);
				$end_date = mktime(0,0,0,1,1,$year+1);
				
				$temp_where[] = '((spid_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spid_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.'))';
			}

			$where[] = '('.implode(' OR ', $temp_where).')';
		}

		// Filtre Statut facture
		switch ($query['invoice_status']) {
			case 'validated':
				$where[] = 'invoice_validate = "1"';
				break;
			case 'non_validated':
				$where[] = 'invoice_validate = "0"';
				break;
		}

		// Filtre sur les extra (ne pas prendre les tickets)
		$where[] = 'extra_cat_id <> ""';

		// JOIN
		$join = implode(' ',$inner).' WHERE '.implode(' AND ', $where);

		$rows = $this->so_line->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);

		if(!$rows){
			$rows = array();
		}

		foreach($rows as $id=>$value){
			if($value['facture_id']>0){
				$facture = $this->so_factures->read($value['facture_id']);
				$rows[$id]['facture_str'] = $facture['facture_number'];
				$rows[$id]['link_facture']=',spid.facture_ui.view&id='.$value['facture_id'].',,,,900x720,$row_cont[facture_str]';

				$rows[$id]['client'] = $facture['client_id'];
				$rows[$id]['send_date'] = $facture['send_date'];
			}
		}
		$order = $query['order'];

		return $this->so_line->total;	
    }

    function get_cat_facture(){
	/**
	 * retourne la liste des catégories de facture
	 * @return array
	 */
		$retour = array();
		$info = $this->so_facture_categories->search('',false,'cat_name ASC');
		if(is_array($info)){
			foreach($info as $id => $value){
				$retour[$value['cat_id']] = $value['cat_name'];
			}
		}
		return $retour;
	}

	function facture_client_groups(){
	/**
	* Récupère l'identifiant des clients (index du résultat), et y fait correspondre l'identifiant de l'entreprise dont il fait partie (valeur du résultat)
	*
	* @return array
	*/	
		$spid_bo = CreateObject('spid.spid_bo');

		// On prends uniquement les clients qui ont  des factures avec des lignes personnalisées
		$join = 'WHERE client_id IN (SELECT client_id FROM spid_factures WHERE facture_id IN (SELECT facture_id FROM spid_factures_details WHERE extra_cat_id <> ""))';
		$client_groups = $spid_bo->client_groups($join,'',false);

		$client_groups = array( '' => lang('All') ) + $client_groups ;
		
		return $client_groups;
	}

	function get_year(){
	/**
	 * Liste des années
	 *
	 * @return array
	 */
		$join = 'WHERE facture_id IN (SELECT facture_id FROM spid_factures_details WHERE extra_cat_id <> "")';
		$factures = $this->so_factures->search('',false,'send_date ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);

		$return = array();
		foreach((array)$factures as $facture){
			if(!empty($facture['send_date'])){
				$return[date('Y',$facture['send_date'])] = date('Y',$facture['send_date']);
			}
		}

		arsort($return);
		return $return;
	}

	function get_providers(){
	/**
	 * Permet de récuperer la liste des fournisseurs
	 *
	 * @return array
	 */
		$ClientsRelations=$this->so_clients_relations->search('','societe_id');
		$fournisseurs = array();
		if(is_array($ClientsRelations))
		{
			foreach($ClientsRelations as $cle=>$valeur)
			{
				$clients=$this->so_client->read(array('client_id'=>$valeur['societe_id']),false);
				if(!in_array($clients['client_company'],$fournisseurs)){
					$fournisseurs[$clients['client_id']] = $clients['client_company'];
				}
			}
		}
		natcasesort($fournisseurs);
		return $fournisseurs;
	}
}
?>