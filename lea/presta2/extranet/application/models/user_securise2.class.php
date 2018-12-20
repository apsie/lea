<?php
	class _user 
	{	

	
		private $conn;
		private $connect;
		private $nom;
		private $prenom;
		private $iduser;
		private $idgroupe;
		private $idDroitTab;

		/**
		 * 
		 */
		public function __construct($conn)
		{
			$this->conn = $conn;
			
			$this->connect=true;
			$_SESSION['UTILISATEUR'] = $GLOBALS['egw_info']['user'];
			$_SESSION['id'] = $GLOBALS['egw_info']['user']['account_id'];
			$this->initialiserPreference($_SESSION['UTILISATEUR']['account_id']);
		}
		
	
		
	
		public function connect($login,$password)
		{
			
			$sql='SELECT C.* ,  C2.account_lid AS account_group FROM egw_accounts C LEFT JOIN egw_accounts C2 ON C.account_primary_group = C2.account_id WHERE C.account_status="A" AND C.account_lid="'.$login.'" and C.account_pwd="'.md5($password).'"';
			$data = $this->conn->fetchRow($sql);
		if($data['account_id']!="")
		{
			$this->connect=true;
			$_SESSION['UTILISATEUR'] = $data;
			$_SESSION['id'] = $data['account_id'];
			$this->initialiserPreference($_SESSION['UTILISATEUR']['account_id']);
		}
		else
		{$this->connect=false;}
			
		}
		
		function initialiserParametre($idUser)
	{
		$arrayParametre = array("id_compte"=>$idUser,"libelle_parametre"=>utf8_decode("Paramètre par défault (2011)"),"id_application"=>3);
		$this->conn->insert("apsie_parametre",$arrayParametre);
	}
	
	function getParametre($idUser)
	{
		$sql='SELECT * FROM apsie_parametre WHERE id_compte='.$idUser.' order by id_parametre desc';
		return $this->conn->fetchAll($sql);
	}
	function getParametrebyId($idParametre)
	{
		$sql='SELECT * FROM apsie_parametre WHERE id_parametre='.$idParametre.'';
		return $this->conn->fetchRow($sql);
	}
	function savePreference($data,$idUser,$id_application,$id_parametre)
		{
			
			$wher = "id_compte = ".$idUser."";
			$wher = "id_application = ".$id_application."";
			$wher = "id_parametre = ".$id_parametre."";
			$this->conn->update('apsie_preference',array('valeur'=>""),$wher);
			//print_r($data);
			for($i=0;$i<count($data);$i++)
			{
			$where='';
			$where[] = "id_compte = ".$idUser."";
			$where[] = "id_application = ".$id_application."";
			$where[] = "id_parametre = ".$id_parametre."";
			$where[] = "cle='".$data[$i]['cle']."'";
			
			$this->conn->update('apsie_preference',array('valeur'=>$data[$i]['valeur']),$where);
			
			}	
		$this->getPreference($idUser,$id_application,$id_parametre);
		}
		
	function initialiserPreference($idUser,$new=false,$param="")
	{
		if($this->checkPreference($idUser)==false or $new==true)
		{
			if($new!=true)
			{
	    $this->initialiserParametre($idUser);
			}
			if($param=="")
			{
	   	$param = $this->checkLastParametre($idUser);
			}
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"id_categorie","valeur"=>"281","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"categorie","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"nom_complet","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"nom","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"prenom","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"civilite","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"deuxieme_prenom","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"nom_jeune_fille","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"ville","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"cp","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"pays","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"tel_pro_1","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"tel_pro_2","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"tel_domicile_1","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"tel_domicile_2","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"fax_pro","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"fax_perso","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"portable_pro","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"portable_perso","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"email_pro","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"email_perso","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"fonction","valeur"=>1,"id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"site_web","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"desc_projet","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"presta","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"statut","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"date_debut","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"nom_organisme","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"activite_principale","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"raison_sociale","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"type_adresse","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"adresse_ligne_1","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"adresse_ligne_2","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"cp","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"ville","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"region","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"pays","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"date_immat","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"date_debut_activite","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"forme_juridique","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"siret","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"code_naf","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"secteur_activite","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"dirigeant","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"implantation","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"regime_imposition","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"regime_tva","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"regime_fiscal","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"regime_social_dirigeant","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"statut_org","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"date_naissance","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"lieu_naissance","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"nationalite","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"situation_maritale","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"enfants_a_charge","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"avis1","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"avis2","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"commentaire1","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"commentaire2","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"code_rome","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"com_ref","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		$arrayPreference[] = array("id_compte"=>$idUser,"cle"=>"com_ben","valeur"=>"","id_application"=>3,'id_parametre'=>$param['id_parametre']);
		
		for($i=0;$i<count($arrayPreference);$i++)
		{
		$this->conn->insert("apsie_preference",$arrayPreference[$i]);
		}
		}
	}
	function checkPreference($idUser)
	{
		$sql ="SELECT * FROM apsie_preference where id_compte=".$idUser."";
		$data = $this->conn->fetchAll($sql);
		if($data!=null)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function checkLastParametre($idUser)
	{
		$sql ="SELECT * FROM apsie_parametre where id_compte=".$idUser." order by id_parametre desc limit 1";
		$data = $this->conn->fetchRow($sql);
		return $data;
	}
		function getPreference($idUser,$idApplication,$id_parametre)
	{
		$sql ="SELECT * FROM apsie_preference where id_compte=".$idUser." AND id_application=".$idApplication." AND id_parametre=".$id_parametre."";
		   $data = $this->conn->fetchAll($sql);
		 return $data;
		
	}
		public function isConnect()
		{
			if(isset($_SESSION['UTILISATEUR']))
			{
				return true;
			}
			else 
			{
				return false;
			}
			//return $this->connect;
		}
		
		public function logout()
		{
			unset($_SESSION['UTILISATEUR']);
			$this->connect=false;
			
			
		}
		
		public function isAuthorizedApplication($idDroit)
		{
			return in_array($idDroit,$this->idDroitTab);
		}
		
		public function getIdUser()
		{
			return $this->iduser ;
		}
		
		public function getGroupeId()
		{
			return $this->idgroupe ;
		}
		

	}
?>