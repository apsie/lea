<?php
/**	spifina : SpireaDemandes
*	SPIREA - 23/12/2009->Juillet 2012
*	Spirea - 16/20 avenue de l'agent Sarre
*	T�l : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propri�t� de Spirea
*
*	Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant � la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spifina/inc/class.line_so.inc.php');	

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
	 * R�cup�re et filtre les statuts
	 *
	 * @param array $query avec des clefs comme 'start', 'search', 'order', 'sort', 'col_filter'. Pour d�finir d'autres clefs comme 'filter', 'cat_id', vous devez cr�er une classe fille
	 * @param array &$rows lignes compl�t�s
	 * @param array &$readonlys pour mettre les lignes en read only en fonction des ACL, non utilis� ici (� utiliser dans une classe fille)
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
			$search = $query['search'];
		}

		// Filtre cat�gorie
		if(!empty($query['filter'])){
			$query['col_filter']['extra_cat_id'] = $query['filter'];
		}

		// Filtre Client
		if(!empty($query['filter2'])){
			$where[] = 'client_id = '.$query['filter2'];
		}

		// Filtre fournisseur
		if(!empty($query['provider'])){
			$where[] = 'societe_id = '.$query['provider'];
		}
 
		$inner[] = 'INNER JOIN spifina_factures ON spifina_factures.facture_id = spifina_factures_details.facture_id';
		// Filtre sur les ann�es 
		if(!empty($query['year'])){		
			foreach(explode(',',$query['year']) as $year){
				$start_date = mktime(0,0,0,1,1,$year);
				$end_date = mktime(0,0,0,1,1,$year+1);
				
				$temp_where[] = '((spifina_factures.send_date BETWEEN '.$start_date.' AND '.$end_date.') OR (spifina_factures.send_date = 0 AND end_period_date BETWEEN '.$start_date.' AND '.$end_date.'))';
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
		$where[] = 'extra_cat_id IS NOT NULL';

		// JOIN
		$join = implode(' ',$inner).' WHERE '.implode(' AND ', $where);

		// $this->so_line->debug = 5;
		$rows = $this->so_line->search($search,false,$order,'',$wildcard,false,$op,$start,$query['col_filter'],$join);
		// $this->so_line->debug = 0;

		if(!$rows){
			$rows = array();
		}

		foreach($rows as $id=>$value){
			if($value['facture_id']>0){
				$facture = $this->so_factures->read($value['facture_id']);
				$rows[$id]['facture_str'] = $facture['facture_number'];
				$rows[$id]['link_facture']=',spifina.spifina_ui.view&id='.$value['facture_id'].',,,,900x720,$row_cont[facture_str]';

				$rows[$id]['client'] = $facture['client_id'];
				$rows[$id]['send_date'] = $facture['send_date'];
			}
		}
		$order = $query['order'];

		return $this->so_line->total;	
    }

    function migre_spireapi_get_cat_facture(){
	/**
	 * retourne la liste des cat�gories de facture
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
	* R�cup�re l'identifiant des clients (index du r�sultat), et y fait correspondre l'identifiant de l'entreprise dont il fait partie (valeur du r�sultat)
	*
	* @return array
	*/	
		$clients = array();
		$spifina_bo = CreateObject('spifina.spifina_bo');

		// On prends uniquement les clients qui ont  des factures avec des lignes personnalis�es
		$join = 'INNER JOIN spifina_factures ON spifina_factures.client_id = spiclient.client_id ';
		$join .= 'INNER JOIN spifina_factures_details ON spifina_factures_details.facture_id = spifina_factures.facture_id ';
		$join .= 'WHERE extra_cat_id IS NOT NULL';

		// $join = 'WHERE client_id IN (SELECT client_id FROM spifina_factures WHERE facture_id IN (SELECT facture_id FROM spifina_factures_details WHERE extra_cat_id <> ""))';
		// $client_groups = $spifina_bo->client_groups($join,'',false);

		$temp_clients = $this->so_client->search($recherche,'',$order,'',$wildcard,false,'AND',false,$query['col_filter'],$join);

		foreach($temp_clients as $temp_client){
			$clients[$temp_client['client_id']]=$temp_client['client_company'];
		}
		natcasesort($clients);


		$clients = array('' => lang('All')) + $clients;
		
		// return $client_groups;
		return $clients;
	}

	function get_year(){
	/**
	 * Liste des ann�es
	 *
	 * @return array
	 */
		$join = 'WHERE facture_id IN (SELECT facture_id FROM spifina_factures_details WHERE extra_cat_id IS NOT NULL)';
		// $factures = $this->so_factures->search('',false,'send_date ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
		// $this->so_factures->debug = 5;
		$factures = $this->so_factures->search('','DISTINCT(DATE_FORMAT(FROM_UNIXTIME(send_date), "%Y")) as date','send_date ASC','',$wildcard,false,$op,false,$query['col_filter'],$join);
		// $this->so_factures->debug = 0;
		$return = array();
		foreach((array)$factures as $facture){
			// if(!empty($facture['send_date']) && !isset($return[date('Y',$facture['send_date'])])){
			// 	$return[date('Y',$facture['send_date'])] = date('Y',$facture['send_date']);
			// }
			if($facture['date'] != '1970'){
				$return[$facture['date']] = $facture['date'];
			}
		}

		arsort($return);
		return $return;
	}

	function get_providers(){
	/**
	 * Permet de r�cuperer la liste des fournisseurs
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