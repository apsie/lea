<?php

class statistique
{
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_bilan = "egw_epce_bilan_avis";
	 public $db;
	 public $date_debut_stats;
	 public $date_fin_stats;
	 public $ligne = array('July',25);
	 public $potentiel_by_week = 27;
	 	public $id_group_apsie = '-3007';
	public $id_group_stragefi = '-3008';
 
	function __construct()
	{
	require('../../Classes/config/config.php');
     $this->db=$db;

	
	}
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}


function return_mois($mois)
{

if($mois=="January")
{
	$timestamps = 2678400;

}
elseif($mois=="February")
{
	$timestamps = 2419200;
}
elseif($mois=="March")
{
	$timestamps = 2678400;
		
}
elseif($mois=="April")
{
	$timestamps = 2592000;
}
elseif($mois=="May")
{
	$timestamps = 2678400;
}
elseif($mois=="June")
{
	$timestamps = 2592000;
}
elseif($mois=="July")
{
	$timestamps = 2678400;
}
elseif($mois=="August")
{
	$timestamps =  2678400;
}
elseif($mois=="September")
{
	$timestamps = 2592000;
}
elseif($mois=="October")
{
	$timestamps = 2678400;
}
elseif($mois=="November")
{
	$timestamps = 2592000;
}
elseif($mois=="December")
{
	$timestamps = 2678400;
}
return $timestamps;
}

function afficher_historique_stats_presta_APSIE_Annexe_IV()
	{
		
		
	echo'<center><table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td>Mois</td><td >Nb entretiens</td><td >Nb entretiens hors délais</td><td>T. entretiens réalisés hors délais</td><td>Livrables hors délais </td><td>Taux de livrables hors délais</td><td>facturation hors délais</td><td>T. facturation hors délais</td></tr>';
	
	$z=$this->date_debut_stats;
	$plus_mois=$this->return_mois(date("F",$this->date_debut_stats));
	for($i=$this->date_debut_stats;$i<$this->date_fin_stats;$i=$i+$plus_mois )
	{
		$z = $z + $plus_mois;
		$plus_mois=$this->return_mois(date("F",$z));
		 $compteur++;
	
			if($compteur%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		

		//'.$this->nbr_ben($z,$timestamps).'
		 	if($this->taux_validation($this->nbr_ben($z) , $this->nbr_ben_bilan_valide($z))<50)
			{$color_stats="#F00";}
			else
			{
			$color_stats="#090";
			}
	/*	
	echo'<tr  bgcolor="'.$color.'" ><td>'.date('Y : F',($z)).'</td><td align="center"  >'.$this->nbr_ben($z).'</td><td align="center"  >'.$this->nbr_ben_bilan_valide($z).'</td><td style="color:'.$color_stats.'" align="center">'.$this->taux_validation($this->nbr_ben($z) , $this->nbr_ben_bilan_valide($z)).' %</td></tr>';*/
	
	echo'<tr  bgcolor="'.$color.'" ><td>'.date('Y : F',($z)).'</td><td align="center"  >'.$this->nbr_ben($z).'</td><td align="center">'.$this->nbr_ben_hors_delai($z).'</td><td  align="center">'.$this->taux_entretien_hors_delais($this->nbr_ben_hors_delai($z) , $this->nbr_ben($z)).' %</td><td align="center" >'.$this->nbr_livrables_hors_delai($z).'</td><td align="center">'.$this->taux_livrables_hors_delais($this->nbr_ben($z) , $this->nbr_livrables_hors_delai($z)).' %</td><td align="center">'.$this->nbr_facture_hors_delai($z).'</td><td align="center">'.$this->taux_facturation_hors_delais($this->nbr_ben($z),$this->nbr_facture_hors_delai($z)).'%</td></tr>';
	}
	echo'</table>';
	}
	function afficher_historique_stats_presta_APSIE_Annexe_II()
	{
		
		
	echo'<center><table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td>Mois</td><td >Nbre de bénéficiaires</td><td >Nbre de bénéficiaires dont le projet a été validé</td><td>Taux de validation</td></tr>';
	
	$z=$this->date_debut_stats;
	$plus_mois=$this->return_mois(date("F",$this->date_debut_stats));
	for($i=$this->date_debut_stats;$i<$this->date_fin_stats;$i=$i+$plus_mois )
	{
		$z = $z + $plus_mois;
		$plus_mois=$this->return_mois(date("F",$z));
		 $compteur++;
	
			if($compteur%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		

		//'.$this->nbr_ben($z,$timestamps).'
		 	if($this->taux_validation($this->nbr_ben($z) , $this->nbr_ben_bilan_valide($z))<50)
			{$color_stats="#F00";}
			else
			{
			$color_stats="#090";
			}
		
	echo'<tr  bgcolor="'.$color.'" ><td>'.date('Y : F',($z)).'</td><td align="center"  >'.$this->nbr_ben($z).'</td><td align="center"  >'.$this->nbr_ben_bilan_valide($z).'</td><td style="color:'.$color_stats.'" align="center">'.$this->taux_validation($this->nbr_ben($z) , $this->nbr_ben_bilan_valide($z)).' %</td></tr>';
	}
	echo'</table></center>';
	}
	function nbr_ben($timemois)
	{
	$requete = 'Select * from '.$this->table_prestation.' where presta="EPCE" and  (statut ="Complete" or statut ="Abandon") and (date_debut>='.$timemois.' and  date_debut<='.($timemois+2592000).')';

	$result=$this->db->fetchAll($requete);
	return count($result);
	}
	function nbr_ben_hors_delai($timemois)
	{
		$compteur=0;
	$requete = 'Select * from '.$this->table_prestation.' where presta="EPCE" and (statut ="Complete" or statut ="Abandon") and (date_debut>='.$timemois.' and  date_debut<='.($timemois+2592000).')';

	$result=$this->db->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
	if($result[$i]['date_fin_reelle']-$result[$i]['date_debut']>2592000)
	{
		$compteur++;
	}
	}
	return $compteur++;
	}
	
	function nbr_livrables_hors_delai($timemois)
	{
		$compteur=0;
	$requete = 'Select * from '.$this->table_prestation.' where presta="EPCE" and (statut ="Complete" or statut ="Abandon") and (date_debut>='.$timemois.' and  date_debut<='.($timemois+2592000).')';

	$result=$this->db->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
	if($result[$i]['date_fin_reelle']!=0 and $result[$i]['date_envoi_bilan']-$result[$i]['date_fin_reelle']>604800)
	{
		$compteur++;
	}
	}
	return $compteur++;
	}
	
	function nbr_facture_hors_delai($timemois)
	{
		$compteur=0;
	$requete = 'Select * from '.$this->table_prestation.' where presta="EPCE" and (statut ="Complete" or statut ="Abandon") and (date_debut>='.$timemois.' and  date_debut<='.($timemois+2592000).')';

	$result=$this->db->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
	if($result[$i]['date_fin_reelle']!=0 and $result[$i]['date_facturation']-$result[$i]['date_fin_reelle']>2592000)
	{
		$compteur++;
	}
	}
	return $compteur++;
	}
	
	function nbr_ben_bilan_valide($timemois)
	{
		$compteur=0;
	$requete = 'Select * from '.$this->table_prestation.' where presta="EPCE" and  (statut ="Complete" or statut ="Abandon") and (date_debut>='.$timemois.' and  date_debut<='.($timemois+2592000).')';


	$result=$this->db->fetchAll($requete);
	if(count($result)==0)
	{
		return $compteur;
	}
	
	else
	{
		
	for($i=0;$i<count($result);$i++)
	{
		
	$requete2 = 'Select * from '.$this->table_bilan.' where (id_presta ='.$result[$i]['id_presta'].') and (avis1=2 or avis1=3 )';
	$result2=$this->db->fetchRow($requete2);
	
	if($result2['id']!=NULL)
	{
	$compteur++;
	}
	
	
	}
	
	
	}
	return $compteur;
	
	}
	
	function taux_validation($nbre_ben , $nbre_ben_valide)
	{
		$nombre=($nbre_ben_valide/$nbre_ben)*100;
	 return round($nombre, 2); 
	}
	
	function taux_livrables_hors_delais($nbre_ent , $nbre_livrable_hors)
	{
		$nombre=($nbre_livrable_hors/$nbre_ent)*100;
	 return round($nombre, 2); 
	}
	function taux_facturation_hors_delais($nbre_ent , $nbre_facturation_hors)
	{
		$nombre=($nbre_facturation_hors/$nbre_ent)*100;
	 return round($nombre, 2); 
	}
	
	function taux_entretien_hors_delais($nbre_hors , $nbre_ent)
	{
		$nombre=($nbre_hors/$nbre_ent)*100;
	 return round($nombre, 2); 
	}
	
	function maj_id_presta_bilan()
	{
	$requete = 'Select id_ben , id_presta from egw_prestation2';
	
	$result=$this->db->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
	
	$data = array('id_presta'=>$result[$i]['id_presta']);
	$this->db->update('egw_epce_bilan_avis2' , $data , 'id_beneficiaire='.$result[$i]['id_ben'].''); 
	
	}
	
	
	}
		
	function stats_xls()
	{
include("PHPExcel/IOFactory.php");

if (!file_exists("../lea/Statistique1_1/doc/stats.xls")) {
	
	
	exit();
}

$objPHPExcel = PHPExcel_IOFactory::load("../lea/Statistique1_1/doc/stats.xls");
//$sheetupa=$objPHPExcel->getActiveSheet()->SetTitle('Feuil11');
$sheetupa=$objPHPExcel->getActiveSheet();
/*$sheetupa->setCellValue('B28',$nbre);
$sheetupa->setCellValue('C28',$nbre2);*/
	
	$c=0;
	$z=$this->date_debut_stats;
	$plus_mois=$this->return_mois(date("F",$this->date_debut_stats));
	for($i=$this->date_debut_stats;$i<$this->date_fin_stats;$i=$i+$plus_mois )
	{
		
		$c++;
		$z = $z + $plus_mois;
		$plus_mois=$this->return_mois(date("F",$z));
		$nbre=$this->nbr_ben($z);
		$nbre2=$this->nbr_ben_bilan_valide($z);
		$nbre3=$this->nbr_ben_hors_delai($z);
		$nbre4=$this->nbr_livrables_hors_delai($z);
		$nbre5=$this->nbr_facture_hors_delai($z);
		$sheetupa->setCellValue('B'.($this->ligne[1]+$c).'',$nbre);
		$sheetupa->setCellValue('C'.($this->ligne[1]+$c).'',$nbre2);
		$sheetupa->setCellValue('E'.($this->ligne[1]+$c).'',$nbre3);
		$sheetupa->setCellValue('F'.($this->ligne[1]+$c).'',$nbre4);
		$sheetupa->setCellValue('G'.($this->ligne[1]+$c).'',$nbre5);

	}



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Annexe_II_IV_EPCE_EST.xls"');
header('Cache-Control: max-age=0');






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');


$objWriter->save('php://output');



exit;
	}
	
		function get_conseiller($id)
		{
			
			if($id==NULL)
			{
				return NULL;}
			else
			{
		$requete = 'Select * from egw_accounts where account_id='.$id.'';
	
	    $result=$this->db->fetchRow($requete);
		
		// spirea
		// return $result['account_firstname'].' '.$result['account_lastname'];}
		return $result['account_lid'];}
		
		}
	function selectionner_conseiller($conseiller,$id='')
	{
		
		echo'<select onchange="submit()" style="width:120px"  name="conseiller_id">';
		if($conseiller!=NULL)
		{
		
		echo'<option value='.$id.'>'.$conseiller.'</option>';
		}
		else
		{	echo'<option value=""></option>';}
		
	
			
		// spirea - changement parce account_firstname n'existe plus...
		// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and (account_primary_group='.$this->id_group_apsie.' or account_primary_group='.$this->id_group_stragefi.')   order by account_firstname asc';
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and (account_primary_group='.$this->id_group_apsie.' or account_primary_group='.$this->id_group_stragefi.')   order by account_lid asc';
		$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
			
		
			// spirea - changement parce account_firstname n'existe plus...
			// echo'<option value='.$result[$i]['account_id'].'>'.$result[$i]['account_firstname'].' '.$result[$i]['account_lastname'].'</option>';
			echo'<option value='.$result[$i]['account_id'].'>'.$result[$i]['account_lid'].'</option>';
			
		}
		
		echo'</select>';
	}
	

function voir_rdv_semaine($id_conseiller,$rdv="",$semaine=0)
	{
		
		if(date('l')=="Monday")
		{
		$jours=86400;
		$jours_=5*86400;
		}
		if(date('l')=="Tuesday")
		{
		$jours=2*86400;
		$jours_=4*86400;
		}
		if(date('l')=="Wednesday")
		{
		$jours=3*86400;
		$jours_=3*86400;
		}
		
		if(date('l')=="Thursday")
		{
		$jours=4*86400;
		$jours_=2*86400;
		}
		if(date('l')=="Friday")
		{
		$jours=5*86400;
		$jours_=1*86400;
		}
		
		$requete = ' select * from egw_cal_dates where cal_start>'.(time()-$jours+$semaine).'  and  cal_start<'.(time()+$jours_+$semaine).'';
		$result=$this->db->fetchAll($requete);
		for($i=0;$i<count($result);$i++)
		{
			//echo '<br/>'.date("d/m/Y",$result[$i]['cal_start']);
			
			$req = $req.' or cal_id='.$result[$i]['cal_id'];
			
		
		}
		if($rdv=="")
		{
				$requete2 = 'select * from egw_cal_user where  (cal_id=0 '.$req.') and cal_user_id='.$id_conseiller.'';
				
		}
		else
		{
				$requete2 = 'select * from egw_cal_user where (cal_id=0 '.$req.') and cal_status="'.$rdv.'" and cal_user_id='.$id_conseiller.'';
		}
	
		$result2=$this->db->fetchAll($requete2);
			for($i=0;$i<count($result2);$i++)
		{ 
	    	$req2 = $req2.' or cal_id='.$result2[$i]['cal_id'];
			
		}
		
		$requete3 = 'select * from egw_cal where (cal_id=0 '.$req2.') and  cal_title like "'.date('Y').'%"';
		$result3=$this->db->fetchAll($requete3);
			
		return count($result3);
	
	}
	function taux_occupation($rdv_pose)
	{
		return ($rdv_pose/$this->potentiel_by_week)*100;
	}
	
	
	function afficher_occupation_annee($id_conseiller=1033)
	{
		
		
	echo'<center><table style="border:1px solid #DBDBDB" ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td>Mois</td><td align="right">Potenciel </td><td align="right">RDV Posé </td></tr>';
	
	$z=$this->date_debut_occupation;
	$plus_mois=$this->return_mois(date("F",$this->date_debut_occupation));
	for($i=$this->date_debut_occupation;$i<$this->date_fin_occupation;$i=$i+$plus_mois )
	{
		$z = $z + $plus_mois;
		$plus_mois=$this->return_mois(date("F",$z));
		 $compteur++;
	
			if($compteur%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		
		
	
		$requete = ' select * from egw_cal_dates where cal_start>'.($z-$plus_mois).'  and  cal_start<'.$z.'';
		
	echo $requete;
	/*
		$result=$this->db->fetchAll($requete);
		for($i=0;$i<count($result);$i++)
		{
			//echo '<br/>'.date("d/m/Y",$result[$i]['cal_start']);
			
			$req = $req.' or cal_id='.$result[$i]['cal_id'];
			
		
		}
		if($rdv=="")
		{
				$requete2 = 'select * from egw_cal_user where  (cal_id=0 '.$req.') and cal_user_id='.$id_conseiller.'';
				
		}
		else
		{
				$requete2 = 'select * from egw_cal_user where (cal_id=0 '.$req.') and cal_status="'.$rdv.'" and cal_user_id='.$id_conseiller.'';
		}
	
		$result2=$this->db->fetchAll($requete2);
		for($i=0;$i<count($result2);$i++)
		{ 
	    	$req2 = $req2.' or cal_id='.$result2[$i]['cal_id'];
			
		}
		
		$requete3 = 'select * from egw_cal where (cal_id=0 '.$req2.') and  cal_title like "'.date('Y').'%"';
		$result3=$this->db->fetchAll($requete3);*/
			
		
		
		
		

	echo'<tr  bgcolor="'.$color.'" ><td>'.date('Y : F',($z)).'</td><td >0 </td><td>'.count($result2).'</td></tr>';
	}
	echo'</table>';
	}
	
	
	function _destruct()
	{
	mysql_close($this->db);
	
	
	
	}
	
}
?>