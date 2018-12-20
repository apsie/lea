<?php
/**	spifina : SpireaDemandes
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
class line_so extends so_sql{
	
	var $spifina_line = 'spifina_factures_details';
	var $spifina_factures='spifina_factures';

	var $spireapi_facture_categories = 'spireapi_facture_categories';

	var $spifina_clients_relations='spiclient_relations';
	var $spifina_client='spiclient';
	
	var $so_line;
	var $so_factures;
	var $so_facture_categories;

	var $so_client;
	var $so_clients_relations;
	
	/**
	 * Constructor
	 *
	 */
	function line_so(){
		$this->so_line = new so_sql('spifina',$this->spifina_line);
		$this->so_factures = new so_sql('spifina',$this->spifina_factures);
		
		$this->so_facture_categories = new so_sql('spireapi',$this->spireapi_facture_categories);

		$this->so_client = new so_sql('spiclient',$this->spifina_client);
		$this->so_clients_relations = new so_sql('spiclient',$this->spifina_clients_relations);
	}
	
	function construct_search($search){
	/**
	 * Crée une recherche. Le tableau de retour contiendra toutes les colonnes de la table en cours, en leur faisant correspondre la valeur $search 
	 *
	 * La requête ainsi crée est prête à être utilisée comme filtre
	 *
	 * @param int $search tableau des critères de recherche
	 * @return array
	 */
		$tab_search=array();
		foreach($this->so_line->db_data_cols as $id=>$value){
			$tab_search[$this->so_line->table_name.'.'.$id]=$search;
		}
		return $tab_search;
	}
}
?>