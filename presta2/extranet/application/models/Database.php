<?php
	
	class _database
	{
		private $conn;
		
		function __construct($conn)
		{
			$this->conn = $conn;	
		}

	
	function getLastData($table,$id)
	{
		
		$sql="SELECT ".$id." FROM ".$table." ORDER BY ".$id." DESC LIMIT 1";
		//echo $sql;
		return $this->conn->fetchRow($sql);
	}
		function getListApplication($enabled=1)
		{
			$sql ="SELECT * FROM apsie_applications where app_enabled=".$enabled." order by app_order asc";
			//echo $sql;
			return $this->conn->fetchAll($sql);
		}
		
	function getBilan($id_ben,$champ,$mot)
	{
		
		
		
		if($mot!=NULL)
		{$sqlPlus=" AND ".$champ." like '%".$mot."%'";}
		
		$sql="SELECT * FROM egw_bilan_avis where id_beneficiaire=".$id_ben."";
		//echo $sql;
		return $this->conn->fetchAll($sql);
		
		
	}
		function  ajaxSelectionnerData($query)
	{
		
		//$db = Zend_Registry::get('dbAdapter');
		$data=$this->conn->fetchAll('select * from egw_code_postaux where cp like "'.$query.'%" or ville1 like "'.$query.'%" limit 10');
	  	return $data;
	/*for($i=0;$i<count($data);$i++)
	{
		echo '<li onClick="fill(\''.utf8_encode($data[$i]['cp']).'\',\''.utf8_encode($data[$i]['ville1']).'\',\''.utf8_encode($data[$i]['region']).'\',\''.utf8_encode($data[$i]['pays']).'\');">'.utf8_encode($data[$i]['cp']).' '.utf8_encode($data[$i]['ville1']).'</li>';
	}
	*/
	
	
	}
			function  ajaxSelectionnerDataBen($query)
	{
		
		$sql='select * from egw_contact c where nom like "'.$query.'%" or prenom like "'.$query.'%" 
		limit 10';
		$data=$this->conn->fetchAll($sql);
	  
	for($i=0;$i<count($data);$i++)
	{
		echo '<li onClick="fill_ben(\''.utf8_encode($data[$i]['id_ben']).'\',\''.utf8_encode($data[$i]['cat_id']).'\',\''.utf8_encode($data[$i]['civilite']).'\',\''.utf8_encode($data[$i]['nom']).'\',\''.utf8_encode($data[$i]['prenom']).'\',\''.utf8_encode($data[$i]['tel_domicile_1']).'\',\''.utf8_encode($data[$i]['tel_pro_1']).'\',\''.utf8_encode($data[$i]['email_pro']).'\',\''.utf8_encode($data[$i]['portable_perso']).'\',\''.utf8_encode($data[$i]['fax_pro']).'\',\''.utf8_encode($data[$i]['email_perso']).'\',\''.utf8_encode($data[$i]['fonction']).'\');">'.utf8_encode($data[$i]['nom']).' '.utf8_encode($data[$i]['prenom']).'</li>';
	}
	
	
	
	}
		function  getCodeNaf($query)
	{
		
		//$db = Zend_Registry::get('dbAdapter');
		//die("SELECT * FROM egw_code_naf WHERE code_naf LIKE '$query%' or intitule_long LIKE '$query%'  LIMIT 50");
		$result=$this->conn->fetchAll("SELECT * FROM egw_code_naf WHERE code_naf LIKE '".$query."%' or intitule_long LIKE '".$query."%'  LIMIT 50");
		//print_r($result);die();
	  return $result;
	/*for($i=0;$i<count($result);$i++)
	{
		echo '<li onClick="fill_naf(\''.$result[$i]['code_naf'].'\');">'.utf8_encode($result[$i]['intitule_long']).' ('.$result[$i]['code_naf'].')</li>';	}
	
	
	
	}*/
	}
	
	function updateParametre($id,$libelle)
	{
			$where = "id_parametre = ".$id."";
			
			$this->conn->update('apsie_parametre',array('libelle_parametre'=>utf8_decode($libelle)),$where);
	}
		function createParametre($libelle,$idUser,$id_application)
	{
			
			
			$this->conn->insert('apsie_parametre',array('id_application'=>$id_application,'id_compte'=>$idUser,'libelle_parametre'=>utf8_decode($libelle)),$where);
			$sql='SELECT * FROM apsie_parametre WHERE id_compte='.$idUser.' and id_application='.$id_application.' order by id_parametre desc';
		return $this->conn->fetchRow($sql);
			
	}
	function getLieu()
	{
	$sql="SELECT * FROM apsie_lieu order by nom_lieu asc";
	return $this->conn->fetchAll($sql);
	}
	function getTypeEvenement()
	{
	$sql="SELECT * FROM apsie_type_evenement order by nom_court asc";
	return $this->conn->fetchAll($sql);
	}
	function getPrestataire()
	{
		
	$sql="SELECT * FROM egw_prestataire order by id_prestataire asc";
	return $this->conn->fetchAll($sql);
	}
	function getCalCat()
	{
	$sql="SELECT id_dispositif as id_cal_cat, nom_dispositif as cal_cat_name,objet as objet_dispositif FROM egw_dispositif where is_active=1";
	return $this->conn->fetchAll($sql);
	}
	
	function  getParticipantsContact($idCal)
	{
	$sql="SELECT DISTINCT c.id_ben,c.nom,c.prenom,acc.cal_status,acc.motif_absence FROM apsie_jqcalendar jq
LEFT JOIN apsie_cal_contact acc ON acc.cal_id = jq.Id
LEFT JOIN egw_contact c ON c.id_ben = acc.id_contact
WHERE jq.Id =".$idCal."";

	$data = $this->conn->fetchAll($sql);
	if($data[0]['id_ben']!="")
	return $data;
	}
	function  getParticipantsComptes($idCal)
	{
	$sql="SELECT DISTINCT cpt.account_id,cpt.account_firstname,cpt.account_lastname FROM apsie_jqcalendar jq
LEFT JOIN egw_cal_user acu ON acu.cal_id = jq.Id
LEFT JOIN apsie_comptes cpt ON cpt.account_id = acu.cal_user_id
WHERE jq.Id  =".$idCal."";
	return $this->conn->fetchAll($sql);
	}
	function getDispositif($is_active=1)
	{
		$sql="SELECT * FROM egw_dispositif WHERE is_active=".$is_active." order by date_debut desc";
		return $this->conn->fetchAll($sql);
	}
	 function get_projet($id_ben)
	{
		$requete = 'select * from egw_projet where id_ben='.$id_ben.' order by id_projet desc  limit 1';
		return $this->conn->fetchRow($requete);
	}
	
	function MAJDATE()
	{
		$sql="SELECT cd.cal_id as Id,cd.cal_start as StartTime,cd.cal_end as EndTime from egw_cal_dates cd ORDER BY Id desc";
		$data = $this->conn->fetchAll($sql);
		
		$c =0;
		for($i=0;$i<count($data);$i++)
		{
			$this->conn->update("apsie_jqcalendar",$data[$i],"Id=".$data[$i]['Id']);
			$c++;
		}
		return $c .'mise à jours';
		//print_r($data);
	}
	function MAJDATEIDPRESTATAIRE()
	{
		echo'test';
			$this->conn->update("apsie_jqcalendar",array('id_prestataire'=>1));
		
	}
	function MAJCALSTATUS()
	{
		$sql="SELECT cal_id as Id,cal_status from egw_cal_user";
		$data = $this->conn->fetchAll($sql);
		
		for($i=0;$i<count($data);$i++)
		{
			$this->conn->update("apsie_jqcalendar",$data[$i],"Id=".$data[$i]['Id']);
		}
		//print_r($data);
	}
		function logAction($idTypeLog,$data = NULL)
		{
			/*if( ! is_array($data)) { $data =  array("IDDATA" => $data) ; }
			
			$idUtilisateur = $_SESSION['IDUSER'];
			$idLog = $this->nextVal("AW3_LOG_SEQ");
			
			$this->conn->beginTransaction();
			
			try {
			
				//C'est pas très <<esthetique>> la répétition mais faut pas faire de truc trop lent ici
				if( isset($data["IDDATA"]) )
				{
					$sql = "INSERT INTO AW3_LOG ( IDLOG, IDTYPELOG, IDUTILISATEUR, DATELOG, IDDATA )
								VALUES ( :idLog, :idTypeLog, :idUtilisateur,to_date(:dateLog ,'DD/MM/YYYY HH24:MI:SS'), :idData) ";
				
					$bind = array(
						"idLog" => $idLog,
						"idTypeLog" => $idTypeLog,
						"idUtilisateur" => $idUtilisateur,
						"dateLog" => gmdate('d/m/Y H:i:s'),
						"idData" => $data["IDDATA"]
					);					
				}else
				{
					$sql = "INSERT INTO AW3_LOG ( IDLOG, IDTYPELOG, IDUTILISATEUR, DATELOG )
								VALUES ( :idLog, :idTypeLog, :idUtilisateur,to_date(:dateLog ,'DD/MM/YYYY HH24:MI:SS')) ";
				
					$bind = array(
						"idLog" => $idLog,
						"idTypeLog" => $idTypeLog,
						"idUtilisateur" => $idUtilisateur,
						"dateLog" => gmdate('d/m/Y H:i:s')
					);
				}

				
				$this->conn->query($sql,$bind);
				
				switch($idTypeLog)
				{
					case LOG_TYPEACTION_SEARCHPIE:
						
						$sql = "INSERT INTO AW3_LOGSEARCHPIE ( IDLOG, WHERESTR, DATEDEBUT, DATEFIN , IDTRANCHELINE)
									VALUES ( :idLog, :whereStr, to_date(:dateDebut,'DD/MM/YYYY HH24:MI:SS'), to_date(:dateFin ,'DD/MM/YYYY HH24:MI:SS'), :idTrancheLine) ";
						
						$bind = array(
							"idLog" => $idLog,
							"whereStr" => $data["WHERESTR"],
							"dateDebut" => $data["DATEDEBUT"],
							"dateFin" => $data["DATEFIN"],
							"idTrancheLine" => $data["IDTRANCHELINE"] 
						);

						$this->conn->query($sql,$bind);
						
						break;
					case LOG_TYPEACTION_SEARCHGRID:

						$sql = "INSERT INTO AW3_LOGSEARCHGRID ( IDLOG, WHERESTR, GROUPBYFIELD_X, GROUPBYFIELD_Y, DATEDEBUT, DATEFIN
																		, PAGE_START, PAGE_LIMIT, SIDX, SORD, SIDX_PART, TABFIELD, IDTRANCHELINE , DATEDEBUTN1, DATEFINN1)
										VALUES ( :idLog, :whereStr, :groupByField_x , :groupByField_y , to_date(:dateDebut,'DD/MM/YYYY HH24:MI:SS'), to_date(:dateFin ,'DD/MM/YYYY HH24:MI:SS')
																		, :page_start , :page_limit, :sidx, :sord , :sidx_part, :tabField, :idTrancheLine 
																		, to_date(:dateDebutN1,'DD/MM/YYYY HH24:MI:SS'), to_date(:dateFinN1 ,'DD/MM/YYYY HH24:MI:SS') ) ";
						

						
						$bind = array(
							"idLog" => $idLog,
							"whereStr" => isset($data["WHERESTR"]) ?$data["WHERESTR"]  :NULL  ,
							"groupByField_x" => isset($data["GROUPBYFIELD_X"]) ? $data["GROUPBYFIELD_X"] :NULL ,						
							"groupByField_y" => isset($data["GROUPBYFIELD_Y"]) ? $data["GROUPBYFIELD_Y"] :NULL ,
							"dateDebut" =>$data["DATEDEBUT"],
							"dateFin" => $data["DATEFIN"],
							"page_start" => isset($data["START"]) ? $data["START"] :NULL ,
							"page_limit" => isset($data["LIMIT"]) ? $data["LIMIT"] :NULL ,
							"sidx" => isset($data["SIDX"]) ? $data["SIDX"]  :NULL ,
							"sord" => isset($data["SORD"]) ? $data["SORD"] :NULL ,
							"sidx_part" => isset($data["SIDX_PART"]) ? $data["SIDX_PART"] :NULL ,
							"tabField" => isset($data["TABIFELD"]) ? $data["TABIFELD"] :NULL ,
							"idTrancheLine" => $data["IDTRANCHELINE"] ,
							"dateDebutN1" => isset($data["DATEDEBUTN1"]) ? $data["DATEDEBUTN1"] :NULL ,
							"dateFinN1" => isset($data["DATEFINN1"]) ? $data["DATEFINN1"] :NULL 
						);

						$this->conn->query($sql,$bind);

						break;															
				}
				
			    			
				$this->conn->commit();
    		}catch (Exception $e) {
		        $this->conn->rollBack();
		        throw $e;
		    }			
		   
		    return $idLog; */
			
			return -1;
		}
		function getCodeRome($string)
		{
			$sql="SELECT intitule,code_rome,appellation FROM apsie_code_rome WHERE appellation LIKE '$string%' LIMIT 50";
		//echo $sql;
		return $this->conn->fetchAll($sql);
		}
		
		function getEntreprise($string)
		{
			$sql="	SELECT * FROM egw_organisation org
					where nom_organisme like '$string%'
					and categorie_org=246
					or categorie_org=292
					and nom_organisme !=null
					order by nom_organisme asc
					LIMIT 50";
		//echo $sql;
		return $this->conn->fetchAll($sql);
		}
	
	}
	
?>