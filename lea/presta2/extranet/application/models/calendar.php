<?php

class calendar extends Zend_Db_Table_Abstract
{		
	protected $_name = 'apsie_jqcalendar';
	
	
function js2PhpTime($jsdate){

  if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
  	//echo outils::supLeft($matches[4]);
    $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
    $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }
  return $ret;
}

function php2JsTime($phpDate){
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    return date("m/d/Y H:i", $phpDate);
}

function php2MySqlTime($phpDate){
    return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
    $arr = date_parse($sqlDate);
    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);

}
	
function listCalendar($day, $type,$cal_user_id){
	//echo $day;exit();
  $phpTime = $this->js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
 
  return $this->listCalendarByRange($st, $et,$cal_user_id);
}
function listCalendarByRange($sd, $ed,$cal_user_id){
  
	global $conn;
	
	$ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = $sd;
  $ret["end"] =$ed;
  $ret['error'] = null;
  try{
    
    $sql = "SELECT p.nom,ate.nom_long,acu.cal_user_id,ajq.cal_status,ac2.account_lastname as nom_referent, ac2.account_firstname as prenom_referent,acc.objet as objet_dispositif,acc.nom_dispositif as cal_cat_name,al.Color,
    al.nom_lieu, al.tel_lieu, al.adresse_lieu, al.cp_lieu, al.ville_lieu,ac.account_lastname as nom_proprietaire, ac.account_firstname as prenom_proprietaire, ajq.* FROM `apsie_jqcalendar` ajq
LEFT JOIN egw_accounts ac ON ac.account_id = ajq.id_owner
LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu
LEFT JOIN egw_dispositif acc on acc.id_dispositif = ajq.id_cal_cat
LEFT JOIN egw_cal_user acu on acu.cal_id = ajq.Id
LEFT JOIN egw_accounts ac2 ON acu.cal_user_id = ac2.account_id
LEFT JOIN apsie_type_evenement ate ON ate.id_type_evenement = ajq.id_type_evenement
LEFT JOIN egw_prestataire p ON p.id_prestataire = ajq.id_prestataire
    where acu.cal_user_id=".$cal_user_id." AND `StartTime` between '"
      .$sd."' and '". $ed."'";
    $handle = $conn->fetchAll($sql);
   // print_r($handle);
    //echo $sql;
   for($i=0;$i<count($handle);$i++) {
      //$ret['events'][] = $row;
      //$attends = $row->AttendeeNames;
      //if($row->OtherAttendee){
      //  $attends .= $row->OtherAttendee;
      //}
      //echo $row->StartTime;
      $ret['events'][] = array(
        $handle[$i]['Id'],
        utf8_encode($handle[$i]['Subject']),
       $this->php2JsTime(( $handle[$i]['StartTime'])),
        $this->php2JsTime(( $handle[$i]['EndTime'])),
         $handle[$i]['IsAllDayEvent'],
        0, //more than one day event
        //$row->InstanceType,
        0,//Recurring event,
       $handle[$i]['Color'],
        1,//editable
        $handle[$i]['nom_lieu'],
        utf8_encode($handle[$i]['prenom_referent']).' '.utf8_encode($handle[$i]['nom_referent']),
          utf8_encode($handle[$i]['Description']),
           utf8_encode($handle[$i]['cal_cat_name']),
            utf8_encode($handle[$i]['cal_status']),
             utf8_encode($handle[$i]['prenom_proprietaire']).' '.utf8_encode($handle[$i]['nom_proprietaire']),
             $handle[$i]['id_cal_cat'],
              $handle[$i]['id_lieu'],
               $handle[$i]['cal_user_id'],
               date('d/m/Y H:i',$handle[$i]['StartTime']),
               date('H:i',$handle[$i]['EndTime']-$handle[$i]['StartTime']),
               $handle[$i]['cal_status'],
                $handle[$i]['nom_long'],
              date('H:i',$handle[$i]['EndTime'] - $handle[$i]['StartTime']),
              $handle[$i]['adresse_lieu'].' '.$handle[$i]['cp_lieu'].' '.$handle[$i]['ville_lieu'].' ('.$handle[$i]['tel_lieu'].')',
               $handle[$i]['nom'],
               $handle[$i]['id_type_evenement']
      );
    }
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
 // print_r($ret);
 for($i=0;$i<count($ret['events']);$i++)
 {
 	if($ret['events'][$i][13]=="R")
 	{
 		$ret['events'][$i][7]=0;
 	}
 }
  return $ret;
}

function addCalendar($st, $et, $sub, $ade,$des,$id_lieu,$id_referent,$id_cal_cat,$statut_cal,$id_type_evenement,$id_prestataire,$version=1,$id_presta){
	
	
	global $conn;
  $ret = array();
 
   if($version==1)
   {	$data['Starttime']=$this->js2PhpTime($st);
  	$data['Endtime']=$this->js2PhpTime($et);}
   else {	$data['Starttime']=$st;
  	$data['Endtime']=$et;}
  	$data['subject']=utf8_decode($sub);
  
  	$data['isalldayevent']=$ade;
  	$data['Description']=utf8_decode($des);
  	$data['id_lieu']=$id_lieu;
  	$data['id_owner']=$_SESSION['UTILISATEUR']['account_id'];
  	$data['id_modifier']="";
  	$data['id_cal_cat']=$id_cal_cat;
  	$data['id_type_evenement']=$id_type_evenement;
  	$data['id_prestataire']=$id_prestataire;
  	$data['cal_status']=$statut_cal;
  	if($id_presta!='')
  	{
  	$data['id_presta']=$id_presta;
  	}
  
  	$conn->insert('apsie_jqcalendar',$data);
  	$sql ="SELECT * FROM apsie_jqcalendar order by Id desc limit 1";
  	$retour = $conn->fetchRow($sql);
  	
  
  	$data_user['cal_id']=$retour['Id'];
  	$data_user['cal_user_id']=$id_referent;
  	$data_user['cal_user_type']='u';
  	//$data_user['cal_status']="P";
  	$data_user['cal_quantity']=1;
  	$data_user['cal_recur_date']=0;
  //	print_r($data_user);
 	$conn->insert('egw_cal_user',$data_user);
  	
  	
  
 	 $row = $conn->fetchRow("SELECT Id from apsie_jqcalendar order by Id DESC limit 1");
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = 1;
      $ret['cal_id'] = $row['Id'];
   
  return $ret;
}
function updateCalendar($st, $et, $sub, $ade,$des,$id_lieu,$id_referent,$id_cal_cat,$statut_cal,$idCal,$id_type_evenement,$id_prestataire){
  $ret = array();
  try{
  	global $conn;
  	
  	$data['subject']=utf8_decode($sub);
  	$data['starttime']=$this->js2PhpTime($st);
  	$data['endtime']=$this->js2PhpTime($et);
  	// die('test'. $data['endtime'] );
  	$data['isalldayevent']=$ade;
  	$data['Description']=utf8_decode($des);
  	$data['id_lieu']=$id_lieu;
  	$data['id_modifier']=$_SESSION['UTILISATEUR']['account_id'];
  	$data['id_cal_cat']=$id_cal_cat;
  	$data['id_type_evenement']=$id_type_evenement;
  	$data['id_prestataire']=$id_prestataire;
 	$data['cal_status']=$statut_cal;

  	$conn->update('apsie_jqcalendar',$data,'id='.$idCal);
  	
  	//$conn->delete('egw_cal_user','cal_id='.$idCal.'');
  	//$conn->delete('apsie_cal_contact','cal_id='.$idCal.'');
  //	print_r($_SESSION['TEMPS']['LINK']['PARTICIPANT']);
 /* for($i=0;$i<count($_SESSION['TEMPS']['LINK']['PARTICIPANT']);$i++)
  	{
  	if($_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['TYPE']=='compte' && $_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['ID']!=null)
  	{
  	$data_user['cal_id']=$idCal;
  	$data_user['cal_user_id']=$_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['ID'];
  	$data_user['cal_user_type']='u';
  //	$data_user['cal_status']="P";
  	$data_user['cal_quantity']=1;
  	$data_user['cal_recur_date']=0;
  	//print_r($data_user);
 	$conn->insert('egw_cal_user',$data_user);
  	}
  	elseif ($_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['TYPE']=='contact'  && $_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['ID']!=null)
  	{
  	$data_contact['cal_id']=$idCal;
  	$data_contact['id_contact']=$_SESSION['TEMPS']['LINK']['PARTICIPANT'][$i]['ID'];
  //	print_r($data_contact);
 	$conn->insert('apsie_cal_contact',$data_contact);
  	}
  	}*/
  	

  
	
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeCalendar($id){
	global $conn;
  $ret = array();
  try{
    $conn->delete('apsie_jqcalendar','id='.$id);
    $conn->delete('egw_cal_user','cal_id='.$id);
		
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function getResultatRecherche($mot)
{
	global $conn;
	$sql="SELECT acu.cal_user_id,ajq.cal_status,ac2.account_lastname as nom_referent, ac2.account_firstname as prenom_referent,acc.nom_dispositif as cal_cat_name,al.nom_lieu,ac.account_lastname as nom_proprietaire, ac.account_firstname as prenom_proprietaire, ajq.* FROM `apsie_jqcalendar` ajq
LEFT JOIN apsie_comptes ac ON ac.account_id = ajq.id_owner
LEFT JOIN apsie_lieu al on al.id_lieu = ajq.id_lieu
LEFT JOIN egw_dispositif acc on acc.id_dispositif = ajq.id_cal_cat
LEFT JOIN egw_cal_user acu on acu.cal_id = ajq.Id
LEFT JOIN apsie_comptes ac2 ON acu.cal_user_id = ac2.account_id
    where ajq.Subject like '%".$mot."%'";

	$ret = $conn->fetchAll($sql);
	
	for($i=0;$i<count($ret);$i++)
	{
	$ret[$i]['DATEDEB'] =   date('d/m/Y H:i',$ret[$i]['StartTime']);
	$ret[$i]['DATEFIN'] =   date('d/m/Y H:i',$ret[$i]['EndTime']);
	}
	//print_r($ret);
	return $ret;
	
    
}


function chercher_options($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nom_lieu,$nombre,$jour)
	{
		global $conn;
		
	$sql='SELECT account_firstname,account_lastname FROM apsie_comptes where account_id='.$conseiller_id.'';
	//echo $sql;
    $result=$conn->fetchRow($sql);

		
		
		$z=1;
		/*$conseiller_id=9;
		$plage1=8;
		$plage2=17;
		$selection=1;
		$date_choisi = "2010/03/3";*/
		$chosi=explode('/',$date_choisi);
		
		$base= mktime(0,0,0,$chosi[1],$chosi[0],$chosi[2]);
		
		$str = '<form name="test" action="index.php" method="get"><table><tr><td><font color=red>'.$result['account_firstname'].' '.$result['account_lastname'].' </font>pour prestations</td><td><select name="prestation">';
		
		$p_database = new _database($conn);
		$calCat = $p_database->getCalCat();
		
		for($i=0;$i<count($calCat);$i++)
		{
			$str .='<option value="'.$calCat[$i]['id_cal_cat'].'-'.$calCat[$i]['cal_cat_name'].'">'.$calCat[$i]['cal_cat_name'].' ( '.$calCat[$i]['objet_dispositif'].' )</option>';
		}
		$str .='</select> a partir du '.$date_choisi.'</td><td><input  name="noTemplate" type="hidden" value="1" /><input  name="page" type="hidden" value="ajaxCalendrier" /><input  name="method" type="hidden" value="option" /><input  name="nom_lieu" type="hidden" value="'.$nom_lieu.'" /><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$result['account_firstname'].' '.$result['account_lastname'].'" /></td></tr></table>';
		
		
		$requete2='SELECT cal_id FROM  egw_cal_user where cal_user_id='.$conseiller_id.'';
	    $result2=$conn->fetchAll($requete2);
		
		
		$req="";
		if(isset($result2[0]['cal_id']) and $result2[0]['cal_id']!=NULL)
		{
			
				
				for ($i=0;$i<count($result2);$i++)

		{

		$req=$req.' or Id='.$result2[$i]['cal_id'];

		}
		
		}
		
		
		
		$requete3='SELECT  EndTime as cal_end, StartTime as cal_start FROM  apsie_jqcalendar  where (StartTime>'.$base.') and (Id=0 '.$req.')   order by StartTime desc';
		
		//echo $requete3;
   $result3=$conn->fetchAll($requete3);
   
		$cal_start[]="";
		$cal_end[]="";
		for($z=0;$z<count($result3);$z++)
		{
		$cal_start[]=$result3[$z]['cal_start'];
		$cal_end[]=$result3[$z]['cal_end'];
		
		}
		//print_r($cal_start);
		//print_r($cal_end);
		for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			
			$heure=date('H',($base + $dat1));
			$jours=date('l',($base + $dat1));
			
			
		
			
		
			if($jour==6)
			{
				if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
					
			 $_j6[]=date('l',$base + $dat1);
		
			
			$time16[]=$base + $dat1;
			$time26[]=$base + $dat1+($duree);
				}

				}
			else
			{
				
				if($heure>($plage1-1) and $heure<$plage2  and $jours==$jour)
				{
					
		  $_j[]=date('l',$base + $dat1);
		
			
			$time1[]=$base + $dat1;
			$time2[]=$base + $dat1+($duree);
			
		
		
				}
		
		
	
				
			}
	
		//	if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
			
		
		}
		
		
		
		
		if(isset($time1))
		{
			if(count($cal_start)<=0)
			{
	/*	$cal_start[] =1121545580;
		$cal_end[]=1121549180;*/
			}
		$d1=array_diff($time1,$cal_start);
		$d2=array_diff($time2,$cal_end);
		}
		if(isset($time16))
		{
			if(count($cal_start)<=0)
			{
	/*	$cal_start[] =1121545580;
		$cal_end[]=1121549180;*/
			}
		$d16=array_diff($time16,$cal_start);
		$d26=array_diff($time26,$cal_end);
		}
	//print_r($d1);
	//print_r($d16);
	//echo $selection;
	//exit();
	if($jour!=6)
	{
		  $str.='<table >';
foreach($d1 as $maCle=>$maValeur)
{
	
	if(date('H',$time1[$maCle])!=13)
	{
	
	
   $str.='<tr><td width="100">'.$_j[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time1[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time2[$maCle]).'</td><td ><input name="pose[]" value="'.$time1[$maCle].'-'.$time2[$maCle].'" type="checkbox" /></td></tr>';
	}
	if($z==$nombre-1)
	{
		break;
	}
	$z++;
	
}

  $str.='</table >';
	}
				
			
else
{
	  $str.='<table >';
	foreach($d16 as $maCle=>$maValeur)
{
	if(date('H',$time16[$maCle])!=13)
	{
	
    $str.='<tr><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr>';
	}
	if($z==$nombre-1)
	{
		break;
	}
	$z++;
}
  $str.='</table >';

}	
		
			
				
		/*	}
			
			//SI PAS DE CONTRAINTE
			else
			{	
			
			for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
				
		  $_j=date('l',$base + $dat1);
			$_dat=date(' d/m/Y | H:00',$base + $dat1);
			$__dat=date(' d/m/Y | H:00',$base + $dat1+($duree));
			
			$time1=$base + $dat1;
			$time2=$base + $dat1+($duree);
			
			if(date('H',$time1)!=13)
			{
					echo '<table ><tr><td width="100">'.$_j.'</td><td> '.$_dat.'</td><td >'.$__dat.'</td><td ><input name="pose[]" value="'.$time1.'-'.$time2.'" type="checkbox" /></td></tr></table>';
			}
			
				}
			}
			}*/
	 $str.='<a  onclick="javascript:Check_all(true);">Tout cocher</a> | <a onclick="javascript:Check_all(false);">Tout decocher</a> <input type="submit" value="Poser" /></form>';
	
	return $str;
	}
	
	function liste_confirmation_option($lieu,$date_inscription,$conseiller_id)
	{
		global $conn;
	$date_string = explode('/', $date_inscription);
	$timestamp = mktime(0, 0, 0, $date_string[1], $date_string[0], $date_string[2]);	
	
		
	if($conseiller_id!=NULL)
	{
		$requete='SELECT * FROM  apsie_comptes  WHERE account_id='.$conseiller_id.'';
 	$result=$conn->fetchRow($requete);
	
 	$conseiller_id=$result['account_id'];
   $account_firstname=$result['account_firstname'];
   $account_lastname=$result['account_lastname'];
	
	}
	else
	{
	$account_firstname='Tous';
	$account_lastname=' les conseillers';
	}
		
		
	$str='<div align="center"><form name="form1" id="form1" target="_blank" action="'.URL_PRESTA.'/presentation/nouveau_beneficiaire.php" method="get"><table><tr><td><input type="hidden" name="conseiller_id" value="'.$conseiller_id.'"/><input type="hidden" name="option_ben" value="nouveau"/><strong>Confirmer les options de <font color=red>'.$account_firstname.' '.$account_lastname.'</font> a partir du '.$date_inscription.' </strong> </td></tr></table><br/>
		<table style="border:1px solid #999"><tr style="color:#FFF" bgcolor="#CCC"><td>Intitule </td><td >Conseiller</td><td>Date de debut</td><td>Date de fin</td><td ></td></tr>';
		
		
	
		$l = explode("Apsie ",$lieu);
		
		if($lieu=="")
		{
			 if($conseiller_id!=NULL)
 				{
	
				$requete4='SELECT egw_cal_user.cal_id,apsie_jqcalendar.Id,apsie_jqcalendar.Subject,egw_cal_user.cal_user_id FROM  apsie_jqcalendar,egw_cal_user where egw_cal_user.cal_id=apsie_jqcalendar.Id and Subject like "%Option%"  and cal_user_id='.$conseiller_id.' order by apsie_jqcalendar.Id desc';
				
				}
				else
				{
				$requete4='SELECT egw_cal_user.cal_id,apsie_jqcalendar.Id,apsie_jqcalendar.Subject,egw_cal_user.cal_user_id FROM  apsie_jqcalendar,egw_cal_user  where Subject like "%Option%" and egw_cal_user.cal_id=apsie_jqcalendar.Id order by apsie_jqcalendar.Id desc ';
				}
		
		}
		else
		{
			
			 if($conseiller_id!=NULL)
 				{
					$requete4='SELECT egw_cal_user.cal_id,apsie_jqcalendar.Id,apsie_jqcalendar.Subject,egw_cal_user.cal_user_id FROM  apsie_jqcalendar,egw_cal_user where egw_cal_user.cal_id=apsie_jqcalendar.Id and (Subject like "%Option_'.$lieu.'" or Subject like  "%Option_'.$l[1].'"  )  and cal_user_id='.$conseiller_id.' order by apsie_jqcalendar.Id desc';
		
				}
				else
				{
				$requete4='SELECT egw_cal_user.cal_id,apsie_jqcalendar.Id,apsie_jqcalendar.Subject,egw_cal_user.cal_user_id FROM  apsie_jqcalendar,egw_cal_user  where (Subject like "%Option_'.$lieu.'" or Subject like  "%Option_'.$l[1].'"  )  and egw_cal_user.cal_id=apsie_jqcalendar.Id order by apsie_jqcalendar.Id desc';
				}
		}
	
		//echo $requete4;
	$result4=$conn->fetchAll($requete4);
	//echo count($result4);
		for($i=0;$i<count($result4);$i++)
		{
			$cal_id[]=$result4[$i]['cal_id'];
			$cal_title[]=$result4[$i]['Subject'];
			//$cal_owner[]=$row['cal_owner'];
			$cal_user_id[]=$result4[$i]['cal_user_id'];
			
		}
		
		
	

	
	for($i=0;$i<count($cal_id);$i++)
		{
			$req = $req.' or Id='.$cal_id[$i];
		}
			$requete6='SELECT * FROM  apsie_jqcalendar  where (Id=0 '.$req.' ) and StartTime >'.$timestamp.' order by StartTime desc';
			

	//echo $requete6;
			$result6=$conn->fetchAll($requete6);
		
				for($i=0;$i<count($result6);$i++)
		{
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $result6[$i]['EndTime']);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $result6[$i]['StartTime']);
			
			
			
			$requete7='SELECT * FROM apsie_jqcalendar  WHERE Id='. $result6[$i]['Id'].' limit 1';
			$result7=$conn->fetchRow($requete7);
			
			$requete8='SELECT * FROM egw_cal_user  WHERE cal_id='. $result6[$i]['Id'].' limit 1';
			$result8=$conn->fetchRow($requete8);
			
			$requete5='SELECT * FROM  apsie_comptes  WHERE account_id='.$result8['cal_user_id'].' limit 1';
			$result5=$conn->fetchRow($requete5);
			$prestation = explode("_",$result7['Subject']);
			
			$str .= '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$result7['Subject'].'</font> </td><td style="border-right:1px solid #CCC">'.$result5['account_firstname'].' '.$result5['account_lastname'].'</td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input name="option[]" type="radio" value="'.$result6[$i]['Id'].'-'.$result5['account_id'].'-'.$result6[$i]['StartTime'].'-'.$result5['account_firstname'].' '.$result5['account_lastname'].'-'.$prestation[1].'" /></td></tr>';
		
		
	
		}
			
		
			
	
		
		$str .='</table><br/><input onclick="form1.submit(); $j(\'#resultat_confirm\').html(\'<br/><center>Après confirmation, actualiser le calendrier...</center>\');" type="button" value="Confirmer l\'option"></form></div>';
		return $str;
	
	}
	function deleteParticipant($id,$type)
	{
		global $conn;
		if($type=="compte")
		{
			$conn->delete('egw_cal_user','cal_user_id='.$id);
		}
		elseif($type=="contact")
		{
			$conn->delete('apsie_cal_contact','id_contact='.$id);
		}
	}
	
function selectionner_rdv($id_presta,$statut=NULL) {
	global $conn;
		// Not yet implemented
		if($statut==NULL)
		{
		$requete = 'Select *  from apsie_jqcalendar c  where c.id_presta='.$id_presta.'  order by StartTime asc';
		}
		else
		{
		$requete = 'Select *  from apsie_jqcalendar u,egw_cal c where c.cal_id = u.cal_id   and c.id_presta='.$id_presta.' and u.cal_status="'.$statut.'" order by StartTime asc';
		}
		
		return $conn->fetchAll($requete);
		
	}
	function del($idCal)
	{
		global $conn;
		
		$conn->delete('apsie_jqcalendar','Id='.$idCal);
		$conn->delete('egw_cal_user','cal_id='.$idCal);
		$conn->delete('apsie_cal_contact','cal_id='.$idCal);
		
	}
	function updateCalContact($cal_id,$id_contact,$bind = array())
	{
		
		global $conn;
		$where[] = 'cal_id='.$cal_id;
		$where[] = 'id_contact='.$id_contact;
		
		$conn->update('apsie_cal_contact', $bind,$where);
	}
	function lier($bind,$table)
	{
		//print_r($bind);
		
		global $conn;
		$conn->insert($table, $bind);
		
	}
	
}

?>