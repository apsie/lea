<?php
/**	SpiClients : SpireaClients
*	SPIREA - 22/09/2011
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpiClients - Ce logiciel est un programme informatique servant à la gestion des clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
class acl_spiclient {

	// $admin : boolean => true = droit d'admin sur l'appli (tout est autoriser)
	var $admin;
	
	/*******  Clients  **********/
	// $vendeurClient : boolean => true = l'user est vendeur client
	var $vendeurClient;
	
	// $allowClient : boolean => true = autoriser a acceder aux clients
	var $allowClient;
	
	// $allAccessClient : boolean => true = acces a tout les clients
	// $ownAccessClient : boolean => true = acces uniquement a ses propres clients (utiliser seulement si $allAccessClient = false)
	var $allAccessClient;
	var $ownAccessClient;
	
	// $allowAddClient : boolean => true = droit d'ajouter des clients
	var $allowAddClient;
	
	// $clientRemoval : boolean => true = permettre la suppression des clients
	var $clientRemoval;
	
	/*******  Contrats  **********/
	// $vendeurContrat : boolean => true = l'user est vendeur contrat
	var $vendeurContrat;
	
	// $allowContrat : boolean => true = autoriser a acceder aux contrats)
	var $allowContrat;
	
	// $allAccessContrat : boolean => true = acces a tout les contrats
	// $ownAccessContrat : boolean => true = acces uniquement a ses propres contrats (utiliser seulement si $allAccessContrat = false)
	var $allAccessContrat;
	var $ownAccessContrat;
	
	// $allowAddContrat : boolean => true = droit d'ajouter des contrats
	var $allowAddContrat;
	
	// $contratRemoval : boolean => true = permettre la suppression des contrats
	var $contratRemoval;
	
	
	
	function __construct(){
	/**
	 *Méthode appelée directement par le constructeur. Charge les ACL de l'application
	 */		
		// $config : array => liste des variables configurer pour l'appli SpiClients
		if(strpos($GLOBALS['egw_info']['server']['versions']['phpgwapi'], '1.4') === 0){
			$config = CreateObject('phpgwapi.config','spiclient');
			$config = $config->read_repository('spiclient');
		}else{
			$config = CreateObject('phpgwapi.config');
			$config = $config->read('spiclient');
		}
		
		// $groupUser : array => liste des groupes du user en cours
		$accounts = CreateObject('phpgwapi.accounts');
		$groupeUser = $accounts->memberships($GLOBALS['egw_info']['user']['account_id'],true);
				
		$this->admin = $GLOBALS['egw_info']['user']['apps']['admin'] || in_array($config['ManagementGroup'],$groupeUser);
		$this->vendeurClient = in_array($config['ClientSeller'],$groupeUser);
		$this->vendeurContrat = in_array($config['ContractSeller'],$groupeUser);
		$this->lecteurContrat = in_array($config['ContractReader'],$groupeUser);

		

		/* Variable concernant les clients */
		$this->allowClient = $this->admin || ($this->vendeurClient && ($config['SellerOwnAccessClient'] || $config['SellerAccessClient'])) || in_array($config['ManageClient'],$groupeUser);
		$this->allAccessClient = ($this->vendeurClient && $config['SellerAccessClient']) || $this->admin || in_array($config['ManageClient'],$groupeUser);
		$this->ownAccessClient = !$this->allAccessClient && $this->vendeurClient && $config['SellerOwnAccessClient'];
		$this->allowAddClient = $this->admin || ($this->vendeurClient && $config['SellerAddClient']) || in_array($config['ManageClient'],$groupeUser);
		$this->clientRemoval = $config['ClientRemoval'];
		
		/* Variable concernant les contrats */
		$this->allowContrat = $this->admin || ($this->vendeurContrat && ($config['SellerOwnAccessContract'] || $config['SellerAccessContract'])) || in_array($config['ManageContract'],$groupeUser) || $this->lecteurContrat;
		$this->allowAddContrat = $this->admin || ($this->vendeurContrat && $config['SellerAddContract']) || in_array($config['ManageContract'],$groupeUser);
		$this->allAccessContrat = ($this->vendeurContrat && $config['SellerAccessContract']) || $this->admin || in_array($config['ManageContract'],$groupeUser) || $this->lecteurContrat;
		$this->ownAccessContrat = !$this->allAccessContrat && $this->vendeurContrat && $config['SellerOwnAccessContract'];
		$this->contratRemoval = $config['ContractRemoval'];
	}
	
	function acl_spiclient(){
		/**
		*Constructeur
		*/
		self::__construct();
	}
}

?>