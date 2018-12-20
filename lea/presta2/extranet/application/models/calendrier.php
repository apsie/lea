<?php

class calendrier
{	

     public $conn;
	
	public function __construct($conn)
		{
			$this->conn = $conn;
			

		}
	
	function getSemaine($date)
	{
		//01/09/2011
		$ladate = explode("", $date);
		$ts = mktime(0,0,0,$ladate[1],$ladate[0],$ladate[2]);
		$n = date("W",$ts);
		$year = $ladate[2];
		 $n--;

 

    $timespDeb=(strtotime("first Thursday january $year +$n weeks -3 days" ));
    $timespFin=(strtotime("first Thursday january $year +$n weeks +2 days" ));

   

    setlocale(LC_TIME, "fr");

    // On ne rÃ©utilise pas $year car la semaine 1 peut commencer l'annÃ©e prÃ©cÃ©dente... voir l'exemple en 2008

    $datedeb = strftime("%d/%m/%y",$timespDeb);
    $datefin= strftime("%d/%m/%y",$timespFin);
    $datedeb_ = strftime("%A %d %B",$timespDeb);
    $datefin_= strftime("%A %d %B",$timespFin);
   
$semaine[0] = strftime("%d/%m",$timespDeb);
$semaine[1] = strftime("%d/%m",$timespDeb+86400);
$semaine[2] = strftime("%d/%m",$timespDeb+86400*2);
$semaine[3] = strftime("%d/%m",$timespDeb+86400*3);
$semaine[4] = strftime("%d/%m",$timespDeb+86400*4);

    return array("SEMAINE"=>$semaine,"LETTRE"=>array($datedeb_,$datefin_),"CHIFFRE"=>array($datedeb,$datefin),"TPS"=>array($timespDeb,$timespFin),"DATETITRE"=>date('Ym',$timespDeb));
	}
	
	function listCalendarByRange($tps_deb, $tps_end,$cal_user_id){
  
	global $conn;
	
if($cal_user_id!="")
{
	$sqlPlus =' AND acu.cal_user_id='.$cal_user_id.'';
}
    
    $sql = "SELECT ajq.Id,p.nom,ate.nom_long,acu.cal_user_id,ajq.cal_status,ac2.account_lastname as nom_referent, ac2.account_firstname as prenom_referent,acc.objet as objet_dispositif,acc.nom_dispositif as cal_cat_name,al.Color,
    al.nom_lieu, al.tel_lieu, al.adresse_lieu, al.cp_lieu, al.ville_lieu,ac.account_lastname as nom_proprietaire, ac.account_firstname as prenom_proprietaire, ajq.* FROM `apsie_jqcalendar` ajq
LEFT JOIN apsie_comptes ac ON ac.account_id = ajq.id_owner
LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu
LEFT JOIN egw_dispositif acc on acc.id_dispositif = ajq.id_cal_cat
LEFT JOIN egw_cal_user acu on acu.cal_id = ajq.Id
LEFT JOIN apsie_comptes ac2 ON acu.cal_user_id = ac2.account_id
LEFT JOIN apsie_type_evenement ate ON ate.id_type_evenement = ajq.id_type_evenement
LEFT JOIN egw_prestataire p ON p.id_prestataire = ajq.id_prestataire
    where  `StartTime` between '"
      .$tps_deb."' and '". $tps_end."' ".$sqlPlus."";
      
   
    $data = $conn->fetchAll($sql);
  // print_r($data);die();
   
   foreach ($data as $key => $row):
    $count1 = $conn->fetchRow("SELECT count(*) NBCONTACT FROM apsie_cal_contact WHERE cal_id=".$row['Id']);
    $count2 = $conn->fetchRow("SELECT count(*) NBCOMPTE FROM egw_cal_user WHERE cal_id=".$row['Id']);
   $nb =  $count1['NBCONTACT']+$count2['NBCOMPTE'];
   //echo $nb .' ';
    $newData[$key] = array_merge($row,array('NB'=>$nb));
   endforeach;
    //print_r($newData);
   return $newData;
    
}
	function getDetailsCal($Id){
  
	global $conn;
	
 
    $sql = "SELECT p.nom,ate.nom_long,acu.cal_user_id,ajq.cal_status,ac2.account_lastname as nom_referent, ac2.account_firstname as prenom_referent,acc.objet as objet_dispositif,acc.nom_dispositif as cal_cat_name,al.Color,
    al.nom_lieu, al.tel_lieu, al.adresse_lieu, al.cp_lieu, al.ville_lieu,ac.account_lastname as nom_proprietaire, ac.account_firstname as prenom_proprietaire, ajq.* FROM `apsie_jqcalendar` ajq
LEFT JOIN apsie_comptes ac ON ac.account_id = ajq.id_owner
LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu
LEFT JOIN egw_dispositif acc on acc.id_dispositif = ajq.id_cal_cat
LEFT JOIN egw_cal_user acu on acu.cal_id = ajq.Id
LEFT JOIN apsie_comptes ac2 ON acu.cal_user_id = ac2.account_id
LEFT JOIN apsie_type_evenement ate ON ate.id_type_evenement = ajq.id_type_evenement
LEFT JOIN egw_prestataire p ON p.id_prestataire = ajq.id_prestataire
    where  Id=".$Id."";
      
    // echo $sql;
    return $conn->fetchRow($sql);
}
function getNbRdv($id_ref,$statut)
{
	$sql="SELECT count(*) AS NB from apsie_jqcalendar j 
INNER JOIN egw_cal_user acu ON acu.cal_id = j.Id AND cal_user_id=".$id_ref."
where j.cal_status='".$statut."' AND StartTime >=".time()."";
	//echo $sql;
	$data = $this->conn->fetchRow($sql);
	return $data['NB'];
	
}
function getListRdv($id_ref,$statut)
{
	$sql="SELECT * from apsie_jqcalendar j 
INNER JOIN egw_cal_user acu ON acu.cal_id = j.Id AND cal_user_id=".$id_ref."
where j.cal_status='".$statut."' AND StartTime >=".time()." order by StartTime asc";

	return $this->conn->fetchAll($sql);
	
	
	
}

function getRdv($id_presta,$status='A')
{
	$sql="	SELECT * FROM apsie_jqcalendar WHERE id_presta = ".$id_presta."
			and cal_status='".$status."'
			order by StartTime asc";

	$data = $this->conn->fetchAll($sql);	
	
	return $data;
	

}
function get_date_by_id($id)
	{
	$requete = 'Select *  from  apsie_jqcalendar  where Id = '.$id.'';
	return $this->conn->fetchRow($requete);
	}
	
	public function getRdvContactByPresta($id_presta)
	{
		$sql="	SELECT 
				jqc.StartTime,
				jqc.EndTime,
				jqc.Subject,
				te.id_type_evenement,
				te.nom_long,
				te.is_ind,
				cc.cal_status,
				cc.motif_absence,
				l.nom_lieu
				FROM apsie_cal_contact cc
				LEFT JOIN apsie_jqcalendar jqc ON jqc.Id = cc.cal_id
				LEFT join apsie_lieu l on l.id_lieu = jqc.id_lieu
				left join apsie_type_evenement te on te.id_type_evenement = jqc.id_type_evenement
				WHERE cc.id_presta  = ".$id_presta;
		//die($sql);
		return $this->conn->fetchAll($sql);		
	} 
}

?>