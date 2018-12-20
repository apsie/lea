<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaClient - Ce logiciel est un programme informatique servant à la gestion de clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT . '/etemplate/inc/class.so_sql.inc.php');	


class address_so extends so_sql{

	var $spiclient_address = 'spiclient_address';
	var $spiclient_address_type = 'spiclient_address_type';

	var $account_id;
	var $app_title;
	
	
	function address_so(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
	
	function __construct(){
		/**
		*Méthode appelée directement par le constructeur. Charge les varibles globales
		*/	
		parent::__construct('spiclient',$this->spiclient_address,null,'',true);
		$this->so_address_type = new so_sql('spiclient', $this->spiclient_address_type);

		$this->client_ui = CreateObject('spiclient.client_ui');
	}

	function add_update_address($content=null){
		/**
		* Routine permettant de créer/modifier la address technique, à partir des arguments passés dans $content.
		*
		* Retourne un message de confirmation ou d'erreur
		*
		* @param array $content=null
		* @return string
		*/
		$msg='';
		if(is_array($content)){
			$this->data = $content;
			if(isset($this->data['address_id'])){
				$this->data['modify_date'] = time();
				$this->data['modifier'] = $GLOBALS['egw_info']['user']['account_id'];
				$this->update($this->data,true);
				$msg = 'Address updated';
			}else{
				$this->data['creation_date'] = time();
				$this->data['creator'] = $GLOBALS['egw_info']['user']['account_id'];
				$this->save();
				$msg = 'Address created';
			}
		}
		return $msg;
	}
}


?>