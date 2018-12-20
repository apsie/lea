<?php
class info_log
{
//paramètres de connexion

public $db;	
public $cat_id_relance;



function __construct()
{
	//include('config/config.php');
	include('/data/html/egw_apsie_143/Classes/config/config.php');

	$this->db=$db;
	 
	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Relance"';
	$result=$db->fetchRow($requete);
	$this->cat_id_relance=$result['cat_id'];



}
public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}

function new_info_log($type,$contact,$tel_email_ben,$motif,$mode,$commentaire1,$commentaire2,$prochain_contact,$le,$resultat,$id_conseiller,$nom_prenom,$id_ben,$id_presta)
{
	if($type==483)
	{
	$type="phone";
	$info_type="phone";
	}
	if($type==486)
	{
	$type="courrier";
	$info_type="task";
	}
	if($type==484)
	{
	$type="email";
	$info_type="task";
	}
	if($type==487)
	{
	$type="fax";
	$info_type="task";
	}
	if($type==485)
	{
	$type="visite";
	$info_type="task";
	}
	
	$le_=explode("/",$le);
	
	if(addslashes($prochain_contact)=="Pas de prochain contact" or addslashes($prochain_contact)==NULL)
	{$temp="";}
	else
	{
	$temp=mktime('0','0','0',$le_[1],$le_[0],$le_[2]);
	}
	
	$data= array('info_subject'=>'Relance_'.$nom_prenom.' : '.$motif.'','id_presta'=>$id_presta,'id_ben'=>$id_ben,'commentaire2'=>nl2br(utf8_decode($commentaire2)),'commentaire1'=>nl2br(utf8_decode($commentaire1)),'le'=>$temp,'prochain_contact'=>$prochain_contact,'statut'=>$resultat,'motif'=>$motif,'mode'=>$mode,'type'=>$type,'info_modifier'=>$id_conseiller,'info_owner'=>$id_conseiller,'info_datemodified'=>time(),'info_startdate'=>time());
	
	$this->db->insert('egw_relance',$data);
	
	$nb=$this->return_nb_relance($id_presta)+1;
	
	$data_up = array('nb_relance'=>$nb);
	$this->db->update('egw_prestation',$data_up,'id_presta='.$id_presta);
	if($temp=!NULL)
	{
		
$data=array('cal_category'=>$this->cat_id_relance,'cal_modifier'=>$id_conseiller,'cal_modified'=>time(),'cal_owner'=>$id_conseiller,'cal_title'=>'Relance_'.$nom_prenom.'','cal_description'=>utf8_decode(stripslashes($commentaire1)).'
																																																			'.utf8_decode(stripslashes($commentaire2)).'');
			  
		$this->db->insert('egw_cal',$data);
		if($le!=NULL)
		{
		
		$requete = " select cal_id from egw_cal order by cal_id desc limit 1";
		$result=$this->db->fetchRow($requete);
		
		$data2=array('cal_id'=>$result['cal_id'],'cal_start'=>mktime('0','0','0',$le_[1],$le_[0],$le_[2]),'cal_end'=>mktime('1','0','0',$le_[1],$le_[0],$le_[2]));
		$this->db->insert('egw_cal_dates',$data2);
		
		$data3=array('cal_id'=>$result['cal_id'],'cal_recur_date'=>0,'cal_user_type'=>'u','cal_user_id'=>$id_conseiller,'cal_status'=>'U','cal_quantity'=>1);
		$this->db->insert('egw_cal_user',$data3);
		}
	
	}
	

}

function select_info_log($id_presta)
{
if($id_presta!=0)
{


$requete = 'select * from egw_relance where id_presta = "'.$id_presta.'" order by info_startdate desc';
}

echo'<table style="border:1px solid #CCC"><tr  bgcolor="#C4DFFD" style="font-weight:bolder; text-align:center"><td>TITRE</td><td width="30">TYPE</td><td width="100">DATE</td><td width="170">Mode</td><td width="280">Motif</td><td width="280">Résultat</td><td width="150">Prochain contact</td><td>Le</td></tr>';

 $result=$this->db->fetchAll($requete);

for($i=0;$i<count($result);$i++)
{
					
			$info_id[]=$result[$i]['info_id'];
			$type[]=$result[$i]['type'];
			$info_from[]=$result[$i]['info_from'];
			$info_addr[]=$result[$i]['info_addr'];
			$info_subject[]=$result[$i]['info_subject'];
			$info_des[]=$result[$i]['info_des'];	
			$info_owner[]=$result[$i]['info_owner'];
		//	$info_responsible[]=$result[$i]['info_responsible'];
			//$info_access=$result[$i]['info_access'];
			//$info_cat=$result[$i]['info_cat'];
			//$info_datemodified=$result[$i]['info_datemodified'];
			$info_startdate[]=$result[$i]['info_startdate'];	
			$info_enddate[]=$result[$i]['info_enddate'];
			//$info_id_parent=$result[$i]['info_id_parent'];
			//$info_planned_time=$result[$i]['info_planned_time'];
			//$info_used_time=$result[$i]['info_used_time'];
			//$info_status[]=$result[$i]['info_status'];
			//$info_confirm=$result[$i]['info_confirm'];	
			//$info_modifier=$result[$i]['info_modifier'];
			//$info_link_id=$result[$i]['info_link_id'];
			$info_priority[]=$result[$i]['info_priority'];
			$pl_id[]=$result[$i]['pl_id'];
			$info_price[]=$result[$i]['info_price'];
			$info_percent[]=$result[$i]['info_percent'];	
			$info_datecompleted[]=$result[$i]['info_datecompleted'];
			$info_location[]=$result[$i]['info_location'];
			$mode[]=$result[$i]['mode'];	
			$motif[]=$result[$i]['motif'];
			$statut[]=$result[$i]['statut'];
			$commentaire1[]=$result[$i]['commentaire1'];
			$prochain_contact[]=$result[$i]['prochain_contact'];
			$le[]=$result[$i]['le'];
			$commentaire2[]=$result[$i]['commentaire2'];
			
			//$id_ben[]=$result[$i]['id_ben'];	
			
		}
		
		for($i=0;$i<count($info_id);$i++)
		{
			if($type[$i]=="phone")
{
	$type[$i]='<img title="Appel téléphonique" src="../../images/phone.png" />';
}
		elseif($type[$i]=="courrier")
{
	$type[$i]='<img title="Courrier postal" src="../../images/envelope.png" />';
}

	elseif($type[$i]=="email")
{
	$type[$i]='<img title="Email" src="../../images/email.png" />';
}
	elseif($type[$i]=="fax")
{
	$type[$i]='<img title="Fax" src="../../images/printer.png" />';
}
elseif($type[$i]=="visite")
{
	$type[$i]='<img title="Visite" src="../../images/door_in.png" />';
}
$titre=explode(":",utf8_encode($info_subject[$i]));

if($le[$i]==0)
{
$le[$i]=NULL;
}
else

{
$le[$i]=date("d/m/Y",$le[$i]);
}
			echo'<tr  bgcolor="#FFFFFF"><td width="322"><a  href="?info_id='.$info_id[$i].'">'.$titre[1].'</a></td><td width="30">'.$type[$i].'</td><td width="129">'.date("d/m/Y | H:i",$info_startdate[$i]).'</td><td>'.utf8_encode($mode[$i]).'</td><td>'.utf8_encode($motif[$i]).'</td><td>'.utf8_encode($statut[$i]).'</td><td>'.utf8_encode($prochain_contact[$i]).'</td><td>'.$le[$i].'</td></tr>';
		
		}
			echo'</table>';
	}

	
function select_info_log_admin($id_conseiller="",$date,$recontact="",$id_session)
{
	$dat=explode("/",$date);

if($id_conseiller=="")
{
	if($recontact!=NULL)
	{
	$requete = 'select * from egw_relance where prochain_contact like"%'.$recontact.'%" and id_ben!=0  and info_startdate>'.mktime('0','0','0',$dat[1],$dat[0],$dat[2]).' order by info_startdate desc';
	}
	else
	{
	$requete = 'select * from egw_relance where id_ben!=0  and info_startdate>'.mktime('0','0','0',$dat[1],$dat[0],$dat[2]).' order by info_startdate desc';
	}
	
}
else
{
$requete = 'select * from egw_relance where info_owner = "'.$id_conseiller.'" and id_ben!=0  and info_startdate>'.mktime('0','0','0',$dat[1],$dat[0],$dat[2]).' order by info_startdate desc';
}



//echo $requete;
echo'<table style="border:1px solid #CCC"><tr  bgcolor="#C4DFFD" style="font-weight:bolder; text-align:center"><td>TITRE</td><td width="30">TYPE</td><td width="100">DATE</td><td width="150">Conseiller</td><td width="170">Mode</td><td width="280">Motif</td><td width="280">Résultat</td><td width="150">Prochain contact</td><td>Le</td></tr>';
$row=$this->db->fetchAll($requete);
		for($i=0;$i<count($row);$i++)
		{
					
			$info_id[]=$row[$i]['info_id'];
			$type[]=$row[$i]['type'];
			
			
			$info_subject[]=$row[$i]['info_subject'];
			
			$info_owner[]=$row[$i]['info_owner'];
		//	$info_responsible[]=$row['info_responsible'];
			//$info_access=$row['info_access'];
			//$info_cat=$row['info_cat'];
			//$info_datemodified=$row['info_datemodified'];
			$info_startdate[]=$row[$i]['info_startdate'];	
			
			//$info_id_parent=$row['info_id_parent'];
			//$info_planned_time=$row['info_planned_time'];
			//$info_used_time=$row['info_used_time'];
			//$info_status[]=$row['info_status'];
			//$info_confirm=$row['info_confirm'];	
			//$info_modifier=$row['info_modifier'];
			//$info_link_id=$row['info_link_id'];
			
			$mode[]=$row[$i]['mode'];	
			$motif[]=$row[$i]['motif'];
			$statut[]=$row[$i]['statut'];
			$commentaire1[]=$row[$i]['commentaire1'];
			$prochain_contact[]=$row[$i]['prochain_contact'];
			$le[]=$row[$i]['le'];
			$commentaire2[]=$row[$i]['commentaire2'];
			
			$id_ben[]=$row[$i]['id_ben'];	
			$id_presta[]=$row[$i]['id_presta'];
			
		}
		
		for($i=0;$i<count($info_id);$i++)
		{
			if($type[$i]=="phone")
{
	$type[$i]='<img title="Appel téléphonique" src="../images/phone.png" />';
}
		elseif($type[$i]=="courrier")
{
	$type[$i]='<img title="Courrier postal" src="../images/envelope.png" />';
}

	elseif($type[$i]=="email")
{
	$type[$i]='<img title="Email" src="../images/email.png" />';
}
	elseif($type[$i]=="fax")
{
	$type[$i]='<img title="Fax" src="../images/printer.png" />';
}
$titre=explode(":",utf8_encode($info_subject[$i]));

if($le[$i]==0)
{
$le[$i]=NULL;
}
else

{
$le[$i]=date("d/m/Y",$le[$i]);
}
$retour=$this->get_conseiller($info_owner[$i]);
			echo'<tr  bgcolor="#FFFFFF"><td width="322"><a style="color:#F00" onclick="window.open(\'../../presta/epce/control.php?&nouveau_epce=1&id_presta='.$id_presta[$i].'&id='.$id_session.'&id_ben='.$id_ben[$i].'\',\'\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\');" target="_blank"  title="'.utf8_encode($info_des[$i]).'" >'.$titre[0].'</a></td><td width="30">'.$type[$i].'</td><td width="129">'.date("d/m/Y | H:i",$info_startdate[$i]).'</td><td>'.$retour[0].' '.$retour[1].'</td><td>'.utf8_encode($mode[$i]).'</td><td>'.utf8_encode($motif[$i]).'</td><td>'.utf8_encode($statut[$i]).'</td><td>'.utf8_encode($prochain_contact[$i]).'</td><td>'.$le[$i].'</td></tr>';
		
		}
			echo'</table><br/> Cliquer sur le titre pour accéder au dossier';
	}

function get_conseiller($id)
{
	$requete = 'select account_firstname,account_lastname from egw_accounts where account_id="'.$id.'"';
  $row=$this->db->fetchRow($requete);
	
					
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		
		return array($account_firstname,$account_lastname);
}

function cloturer_relance($id_presta)
	{
		
	
	$data=array('relance'=>1);
	$this->db->update('egw_prestation',$data,'id_presta='.$id_presta);
	
	
	}
	function recup_info_log($info_id)
{
//retourner les variables en fonction de l'info_id
$requete = 'select info_id, type, mode, motif, statut, commentaire1, prochain_contact, le, commentaire2, id_ben from egw_relance where info_id = "'.$info_id.'"';


 $row=$this->db->fetchRow($requete);
		
					
			$info_id=$row['info_id'];
			$type=$row['type'];
			$mode=$row['mode'];	
			$motif=$row['motif'];
			$statut=$row['statut'];
			$commentaire1=$row['commentaire1'];
			$prochain_contact=$row['prochain_contact'];
			$le=$row['le'];
			$commentaire2=$row['commentaire2'];	
			$id_ben=$row['id_ben'];	
		
		
		return array($type,$mode,$motif,$statut,$commentaire1,$prochain_contact,$le,$commentaire2,$id_ben);
			
	}
	
	function return_nb_relance($id_presta)
	{
		$requete = 'select * from egw_prestation where id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		return $result['nb_relance'];
	
	}
function _destruct()
{
	mysql_close();
}

}

?>
