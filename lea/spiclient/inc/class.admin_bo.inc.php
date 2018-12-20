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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.admin_so.inc.php');	
	
class admin_bo extends admin_so{
	
	var $preferences;
	var $obj_accounts;
	var $obj_notifications;
	var $obj_config;
	
	
	
	function __construct() {
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		/* Récupération des préférences paramétrées */
		$this->preferences = $GLOBALS['egw']->preferences->data['spiclient'];
		
		$this->obj_accounts = CreateObject('phpgwapi.accounts',$this->account_id,'u');
		
		/* Récupération les infos de configurations */
		// $config = CreateObject('phpgwapi.config');
		// $this->obj_config = $config->read('spiclient');

		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
   			$config = CreateObject('phpgwapi.config','spiclient');
   			$this->obj_config = $config->read_repository('spiclient');
   		}else{
			$config = CreateObject('phpgwapi.config');
			$this->obj_config = $config->read('spiclient');
		}
		
		parent::__construct();
	}
		
	function admin_bo(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function add_update_config($content=null){
		/**
		* Routine permettant de créer/modifierla config
		*
		* @param array $content=null
		* @return string
		*/
		unset($content['button']);
		
		$obj = CreateObject('phpgwapi.config');
		foreach((array)$content as $id => $value){
			$obj->save_value($id,$value,'spiclient');
		}
		$this->obj_config=$obj->read('spiclient');
		return lang('Configuration updated');
	}
	
	function get_type_client(){
	/**
	 * Retourne les types de client
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_type_client->search('',false,'type_client_label');
		foreach((array)$info as $id => $value){
			$retour[$value['type_client_id']] = $value['type_client_label'];
		}
		return $retour;
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
			foreach((array)$ClientsRelations as $cle=>$valeur)
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

	function get_role(){
	/**
	 * Recuperation des roles
	 *
	 * @return array
	 */
		$retour = array();
		$info = $this->so_role->search(array('role_active' => '1'),false,'role_label');
		foreach((array)$info as $id => $value){
			$retour[$value['role_id']] = $value['role_label'];
		}
		return $retour;
	}

	function import_client_data($file_path){
	/**
	 *
	 */
		set_time_limit(0);

		error_log('['.date("d-m-Y H:i:s").'] Debut traitement client -- '.$file_path."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');

		// Si $file est vide, alors on rentre dans le cadre du script d'import...
		if (empty($file_path)) {
			$file_path = "/tmp/spiclient_client.csv";
			$exec = "wget --user=".$this->obj_config['ftp_user']." --password='".$this->obj_config['ftp_pass']."' ".$this->obj_config['ftp_address_client']."  --output-document ".$file_path;
			exec($exec);
		}

		// $mapping_db = array('Marque', 'Maint Next Date', 'Fin Garantie Date', 'Maint Last Date', 'Type', 'Num serie', 'Arret Date',	'Date Livraison');
		$row = 1;

		if (($handle = fopen($file_path, "r")) !== FALSE) {
			// Boucle de lecture des lignes du fichier csv
			while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
				if($row == 1){
					$mapping_csv = array_flip($data);
				}else{
					// Code client
					$client_code = $data[$mapping_csv['CardCode']];
					$client = $this->so_client->read(array('client_code_tiers' => $client_code));

					// Identifiant externe
					$external_id = $data[$mapping_csv['DocEntry']];
					if(!$client){
						$client = $this->so_client->read(array('client_external_id' => $external_id));
					}

					// Information relative au fichier
					switch($data[$mapping_csv['CardType']]){
						case 'C':
							$client_type = $this->obj_config['ClientType'];
							break;
						case 'L':
							$client_type = $this->obj_config['ProspectType'];
							break;
					}

					// Informations du client
					$tmp_client = array(
						'client_external_id' => $external_id,
						'client_code_tiers' => $client_code,
						'client_company' => utf8_encode($data[$mapping_csv['CardName']]),
						'client_tva_number' => utf8_encode($data[$mapping_csv['N° TVA Intra']]),
						'client_sleep' => utf8_encode($data[$mapping_csv['FrozenFor']])=='N' ? false : true,
						'client_type' => $client_type,
						'client_tel' => utf8_encode($data[$mapping_csv['Phone1']]),
						'client_fax' => utf8_encode($data[$mapping_csv['Fax']]),
						'client_adr_one_street' => utf8_encode($data[$mapping_csv['U_RUE']]),
						'client_adr_two_street' => utf8_encode($data[$mapping_csv['Batiment']]),
						'client_postalcode' => utf8_encode($data[$mapping_csv['U_CP']]),
						'client_locality' => utf8_encode($data[$mapping_csv['U_VILLE']]),
						'client_lastname' => utf8_encode($data[$mapping_csv['CntctPrsn']]),
						'client_comment' => utf8_encode($data[$mapping_csv['Commentaires fiche client']]),

						'creation_date' => time(),
						'creator_id' => $GLOBALS['egw_info']['user']['account_id'],
					);

					$this->so_client->data = $tmp_client;
					if($client){
						$this->so_client->data['client_id'] = $client['client_id'];
					}
					$this->so_client->save();
					$client = $this->so_client->data;

					// ADRESSE (Onglet référentiel adresse)
					$address = $this->so_address->search(array('address_street_one' => utf8_encode($data[$mapping_csv['Batiment']]), 'client_id' => $client['client_id']), true);

					$tmp_address = array(
						'client_id' => $client['client_id'],
						'address_street_one' => utf8_encode($data[$mapping_csv['U_RUE']]),
						'address_street_two' => utf8_encode($data[$mapping_csv['Batiment']]),
						'address_postalcode' => utf8_encode($data[$mapping_csv['U_CP']]),
						'address_city' => utf8_encode($data[$mapping_csv['U_VILLE']]),
						// 'address_country' => 
						'address_last_name' => utf8_encode($data[$mapping_csv['CntctPrsn']]),
						// 'address_first_name' => 
						// 'address_mail' => 
						'address_tel' => utf8_encode($data[$mapping_csv['Phone1']]),
						'address_fax' => utf8_encode($data[$mapping_csv['Fax']]),
						'address_type_id' => 2,
						'address_label' => $this->obj_config['adr_default'],

						'creation_date' => time(),
						'creator' => $GLOBALS['egw_info']['user']['account_id'],
					);

					$this->so_address->data = $tmp_address;
					if($address){
						$this->so_address->data['address_id'] = $address[0]['address_id'];
					}
					$this->so_address->save();
					$address = $this->so_address->data;
				}

				++$row;
			}
		}
		
		error_log('['.date("d-m-Y H:i:s").'] Fin traitement client -- '.$file_path."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');
	}

	function import_contact_data($file_path){
	/**
	 *
	 */
		set_time_limit(0);

		error_log('['.date("d-m-Y H:i:s").'] Debut traitement contact -- '.$file_path."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');

		// Si $file est vide, alors on rentre dans le cadre du script d'import...
		if (empty($file_path)) {
			$file_path = "/tmp/spiclient_contact.csv";
			$exec = "wget --user=".$this->obj_config['ftp_user']." --password='".$this->obj_config['ftp_pass']."' ".$this->obj_config['ftp_address_contact']."  --output-document ".$file_path;
			exec($exec);
		}

		// $mapping_db = array('Marque', 'Maint Next Date', 'Fin Garantie Date', 'Maint Last Date', 'Type', 'Num serie', 'Arret Date',	'Date Livraison');
		$row = 1;

		if (($handle = fopen($file_path, "r")) !== FALSE) {
			// Boucle de lecture des lignes du fichier csv
			while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
				if($row == 1){
					$mapping_csv = array_flip($data);
				}else{
					// Code tiers
					$client_code = $data[$mapping_csv['CardCode']];
					$client = $this->so_client->read(array('client_code_tiers' => $client_code));

					// CONTACT
					$contact_code = $data[$mapping_csv['ID contact client']];
					$contact = $this->so_contact->read(array('contact_room' => $contact_code));

					// Information relative au contact
					$name = utf8_encode($data[$mapping_csv['LastName']]).' '.utf8_encode($data[$mapping_csv['FirstName']]);
					$tmp_contact = array(
						'contact_tid' => 'n',
						'contact_room' => $contact_code,
						'n_family' => utf8_encode($data[$mapping_csv['LastName']]),
						'n_given' => utf8_encode($data[$mapping_csv['FirstName']]),
						'n_fn' => utf8_encode($data[$mapping_csv['Name']]),
						'tel_work' =>utf8_encode($data[$mapping_csv['Tel1']]),
						'tel_cell' => utf8_encode($data[$mapping_csv['Cellolar']]),
						'contact_email' => utf8_encode($data[$mapping_csv['E_MailL']]),
						'tel_fax' => utf8_encode($data[$mapping_csv['Fax contact']]),
						// 'n_prefix' => utf8_encode($data[$mapping_csv['Name']]),

						'contact_owner' => $this->obj_config['import_group'],
					);

					$this->so_contact->data = $tmp_contact;
					if($contact){
						$this->so_contact->data['contact_id'] = $contact['contact_id'];
					}
					$this->so_contact->save();
					$contact = $this->so_contact->data;

					$role = $this->so_role->read($this->obj_config['default_role_contact']);
					egw_link::link('spiclient',$client['client_id'],'addressbook',$contact['contact_id'],$role['role_label']);
				}

				++$row;
			}
		}

		error_log('['.date("d-m-Y H:i:s").'] Fin traitement contact -- '.$file_path."\n",3,$GLOBALS['egw_info']['server']['files_dir'].'/client_import_'.date('Ym').'.log');
	}

	function get_async_services(){
	/**
	 * Retourne la liste des services asynchrones avec leurs valeurs
	 *
	 * @return array
	 */
		$i = 1;
		foreach((array)$this->async_services as $service => $function){
			$async = $GLOBALS['egw']->asyncservice->read($service);
			if(empty($async)){
				$return[$i]['id'] = $service;
				$return[$i]['info'] = lang('This asynchronous service is currently disabled');
			}else{
				$return[$i] = $async[$service]['times'];
				$return[$i]['id'] = $async[$service]['id'];
				$return[$i]['info'] = lang('This asynchronous service is currently enabled and will run next on %1',date('d/m/Y H:i',$async[$service]['next']));
			}
			++$i;
		}
		return $return;
	}

	function get_contract_status(){
	/**
	 * Retourne la liste de tout les statuts de contrat
	 *
	 * @return array
	 */
		$info = $this->so_statut_contrat->search('',false);
		$status = array();
		foreach((array)$info as $id => $value){
			if($current_id != $value['status_id']){
				$status[$value['status_id']] = $value['status_label'];
			}
		}
		return $status;
	}
}	
?>

