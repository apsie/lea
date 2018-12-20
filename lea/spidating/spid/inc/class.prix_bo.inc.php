<?php
/**	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009
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
require_once(EGW_INCLUDE_ROOT. '/spid/inc/class.prix_so.inc.php');	
	
class prix_bo extends prix_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	
	
	function __construct() {
	/** 
	* Méthode appelée directement par le constructeur. Charge les variables globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spid'];
		
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		$config = CreateObject('phpgwapi.config');
		$this->obj_config=$config->read('spid');
		
		parent::__construct();
	}
		
	function prix_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function client_groups($first='All'){
	/**
	* Retourne tous les groupes de clients
	*
	* NOTE : $first ne sert à rien ...
	*
	* @param string $first='All'
	* @return array
	*/		
		$client_groups = array();
		$info = $this->so_client->search('',false,'client_company');
		foreach($info as $id => $value){
			$client_groups[$value['client_id']] = $value['client_company'];
		}
		return $client_groups;
	}
	
	function get_info($id){
	/**
	* Retourne les informations au sujet du prix $id
	*
	* @param int $id
	* @return string
	*/
		$info=$this->search(array('price_id'=>$id),false);
		return $info[0];
	}

	function get_contract(){
	/**
	 * Retourne la liste des contrats
	 *
	 * @return array
	 */
		$retour = array();

    	$info = $this->so_contrat->search('',false,'contract_title');
    	foreach($info as $data){
			$retour[$data['contract_id']] = $data['contract_title'];
		} 

		return $retour;
	}
	
	function add_update_price($content=null){
	/**
	* Routine permettant de créer/modifier (si le client existe déjà) le prix actuel, à partir des arguments passés dans $content. $content doit contenir un champ price_id mettre le prix mis à jour (il sera crée sinon)
	*
	* Retourne un message de confirmation ou d'erreur
	*
	* @param array $content=NULL
	* @return string
	*/
		$msg='';
		if(is_array($content)){
			unset($content['button']);
			unset($content['spid']);
			unset($content['msg']);
			$this->data = $content;
			
			$prix = $this->search(array('client_id' => $content['client_id'],'state_id' => $content['state_id']),false);
			if(isset($this->data['price_id'])){
				if($prix[0]['price_id'] == $this->data['price_id'] && $prix[0]['client_id'] == $this->data['client_id'] && $prix[0]['state_id'] == $this->data['state_id']){
					$this->data['change_date']=time();
					$this->update($this->data,true);
					$msg='Price updated';
				}else{
					$msg = 'This client / price association already exists';
				}
			}else{
				if(!is_array($prix)){
					$this->data['creation_date']=time();
					$this->data['creator_id']=$this->account_id;
					$this->data['account_id']=$this->get_account_client($this->data['client_id']);
					$this->save();
					$msg='Price created';
				}else{
					$msg = 'This client / price association already exists';
				}
			}
		}
		return $msg;
	}
	
	
}	
?>
