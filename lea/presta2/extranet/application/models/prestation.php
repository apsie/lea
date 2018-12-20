<?php

class prestation extends Zend_Db_Table_Abstract
{		
	protected $_name = 'egw_prestation';
	
	
     public $conn;
	
	public function __construct($conn)
		{
			$this->conn = $conn;
			

		}
	function getPrestation($id_ben,$champ,$mot)
	{
		
		global $conn;
		
		if($mot!=NULL and $champ!='')
		{$sqlPlus=" AND ".$champ." like '%".$mot."%'";}
		
	$sql="SELECT * FROM egw_prestation where id_ben=".$id_ben." ".$sqlPlus."";
	//echo $sql;
		return $conn->fetchAll($sql);
		
		
	}
function getPrestationByRef($id_ref,$id_dispositif,$statut,$mot)
	{
		
		global $conn;
		
	if($mot!="")
		{
		$sqlPlus=" AND intitule like '%".$mot."%' ";
		}
		if($statut!="" )
		{$sqlPlus .=" AND statut ='".$statut."'";}
	
	if($id_ref!="" )
		{$sqlPlus .=" AND id_ref=".$id_ref." ";}
		
		
		
	//$sql="SELECT * FROM egw_prestation where id_dispositif=".$id_dispositif."  ".$sqlPlus." order by date_debut desc";
	$sql='SELECT nom_lieu,NB_P,NB_A,NB_R,ac.account_firstname,ac.account_lastname, famille_presta,p.* FROM egw_prestation p
		LEFT JOIN egw_dispositif ad ON ad.id_dispositif = p.id_dispositif
		LEFT JOIN apsie_comptes ac ON ac.account_id = p.id_ref
		LEFT JOIN 
		(
		SELECT count(Id) as NB_P,id_presta FROM apsie_jqcalendar  GROUP BY id_presta
		)SEL ON SEL.id_presta = p.id_presta
		LEFT JOIN 
		(
		SELECT count(Id) as NB_A,id_presta FROM apsie_jqcalendar where cal_status="A" GROUP BY id_presta
		)SEL2 ON SEL2.id_presta = p.id_presta
		LEFT JOIN 
		(
		SELECT count(Id) as NB_R,id_presta FROM apsie_jqcalendar where cal_status="R" GROUP BY id_presta
		)SEL3 ON SEL3.id_presta = p.id_presta
		LEFT JOIN 
		(
		SELECT nom_lieu,id_presta FROM apsie_jqcalendar ajq 
		LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu 
		order by Id desc limit 1
		)SEL4 ON SEL4.id_presta = p.id_presta
		where p.id_dispositif='.$id_dispositif.'  '.$sqlPlus.'   order by date_debut desc';
	// error_log($sql);
		$data = $conn->fetchAll($sql);
		//	print_r($data);
		for($i=0;$i<count($data);$i++)
		{
		
		$data[$i]['pourcent_epce'] = $this->pourcentage_epce($data[$i]['id_presta']);
		}
		return $data;
	
		
	}
	
function getPrestationByIdPresta($id_presta)
	{
		
		global $conn;
		
		
		
		
	//$sql="SELECT * FROM egw_prestation where id_dispositif=".$id_dispositif."  ".$sqlPlus." order by date_debut desc";
	$sql='SELECT o.nom_organisme,o.tel as tel_p,o.email as email_p, c.nom as nom_p, c.prenom as prenom_p ,d.numero_marche,
	cp_lieu,ville_lieu,adresse_lieu,tel_lieu,email_lieu,nom_lieu,ac.*,p.* FROM egw_prestation p
LEFT JOIN apsie_comptes ac ON ac.account_id = p.id_ref
LEFT JOIN egw_contact c ON c.id_ben = p.id_contact_prescripteur
LEFT JOIN egw_organisation o ON o.id_organisation = c.id_organisation
LEFT JOIN egw_dispositif d on d.id_dispositif = p.id_dispositif
LEFT JOIN 
(
SELECT cp_lieu,ville_lieu,adresse_lieu,tel_lieu,email_lieu,nom_lieu,id_presta FROM apsie_jqcalendar ajq 
LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu 
order by Id desc limit 1
)SEL4 ON SEL4.id_presta = p.id_presta
where p.id_presta='.$id_presta.'  order by date_debut desc';
	
	/*echo $sql;
	exit;*/
		$data = $conn->fetchRow($sql);
		//print_r($data);exit();
		return $data;
	
		
	}
	
		function pourcentage_epce($id_presta)
	{
		global $conn;
		$sql='SELECT * FROM  egw_epce_validation  where id_presta='.$id_presta.'';
	//	echo $sql;
		$data = $conn->fetchRow($sql);
		
		return	round((($data['plan'] + $data['coherence'] + $data['commerciaux'] + $data['financier'] +$data['juridique']+$data['bilan'])/6)*100,1);
	}
	function getRepartition($id_dispositif,$id_ref,$mot)
	{
		if($mot!="")
		{
		$sqlPlus=" AND intitule like '%".$mot."%' ";
		}
		if($id_ref!="")
		{
		$sqlPlus.=" AND id_ref=".$id_ref." ";
		}
		global $conn;
		$sql="SELECT TOTAL,count( * ) AS NB, STATUT
FROM egw_prestation p
INNER JOIN (
SELECT count( * ) AS TOTAL,p2.id_dispositif
FROM egw_prestation p2
WHERE p2.id_dispositif =".$id_dispositif." AND prestataire='APSIE' ".$sqlPlus."
GROUP BY id_dispositif
)SEL ON SEL.id_dispositif = p.id_dispositif
WHERE p.id_dispositif =".$id_dispositif." AND prestataire='APSIE' ".$sqlPlus."
GROUP BY STATUT
ORDER BY NB DESC";
		//echo $sql;
		return $conn->fetchAll($sql);
	}
	function updatePresta($idPresta,$data)
	{
		global $conn;
		$conn->update('egw_prestation',$data,'id_presta='.$idPresta);
	}
function getNbPrestation($id_ref,$statut)
	{
		
		
	
		
	$sql="SELECT count(*) AS NB FROM egw_prestation where id_ref=".$id_ref." AND statut='".$statut."'";
	 $data = $this->conn->fetchRow($sql);
			return $data['NB'];
		
	}
function getListPrestation($id_ref,$statut)
	{
		
		
	
		
	$sql="SELECT * FROM egw_prestation where id_ref=".$id_ref." AND statut='".$statut."' order by date_debut asc";
	return $this->conn->fetchAll($sql);
		
		
	}
	
function get_prestation($id_presta)
	{
	$requete='select * from egw_prestation where id_presta='.$id_presta.'';
	
	return $this->conn->fetchRow($requete);
	}
	
function setSession($data = array())
	{	
		unset($_SESSION['PRESTA']);
		$_SESSION['PRESTA']  = $data;
	}
function getSession()
	{	
		return $_SESSION['PRESTA'];
	}


}

?>