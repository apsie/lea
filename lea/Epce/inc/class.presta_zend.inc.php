<?php

class presta_zend
{

public $table_contact = 'egw_contact';
	public $table_parcours_pro = 'egw_contact_parcours_pro';
	public $table_etat_civil = 'egw_contact_etat_civil';
	public $table_projet = 'egw_projet';
	public $table_dispositif = 'egw_dispositif';
	public $table_cal_dates = 'egw_cal_dates';
	public $table_cal_user= 'egw_cal_user';
	public $table_cal= 'egw_cal';
	public $table_prestation = 'egw_prestation';
	public $table_formation = 'egw_contact_formation';
	public $table_organisation = 'egw_organisation';
	public $table_projet_organisation ='egw_resacc';
	public $table_validation ='egw_epce_validation';
	public $table_accounts ='egw_accounts';
	public $id_group_apsie = '-3007';
	public $id_group_stragefi = '-3008';
	public $id_group_agroform = '-3009';

	
	// constructeur 
	function __construct()
	{
		
	
	include('../../Classes/config/config.php');
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
	
	function return_variable_presta($id_presta)
	{
		$requete = 'Select * from  '.$this->table_prestation.' where id_presta = '.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		return array($result['id_presta'],$result['prestataire'],$result['presta'],$result['intitule'],$result['id_ref'],$result['lettre_de_commande'],$result['date_debut'],$result['date_fin'],$result['date_fin_reelle'],$result['date_envoi_bilan'],$result['statut']);
		
	}
	
	function selectionner_conseiller3($conseiller_id='')
	{
		
		if($conseiller_id!=NULL)
		{
			echo'<select style="width:120px" name="conseiller_id_ref">';
						
			$requete='SELECT * FROM  egw_accounts  where account_id='.$conseiller_id.'';
			$row = $this->db->fetchAll($requete);
			echo $requete;
			for($i=0;$i<count($row);$i++)
			{
				$account_firstname=$row[$i]['account_firstname'];
				$account_lastname=$row[$i]['account_lastname'];
			    $account_id=$row[$i]['account_id'];
			
				// SPIREA - modification
				$account_lid = $rows[$i]['account_lid'];

			 	echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
			}
		}
		else
		{
			echo'<select style="width:120px" name="conseiller_id_ref"><option value=""></option>';
		}
		
		echo'<option  style="background-color: #75B4D2; color:#FFF" value="">APSIE</option>';
		// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_firstname asc';
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_lid asc';
		$row = $this->db->fetchAll($requete);
		
		for($i=0;$i<count($row);$i++)
		{
			
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
		    
		    // SPIREA - modification
			$account_lid = $row[$i]['account_lid'];
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
		}
		
		echo'<option style="background-color: #75B4D2; color:#FFF" value="">STRAGEFI</option>';
		// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_stragefi.'   order by account_firstname asc';
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_stragefi.'   order by account_lid asc';
		$row = $this->db->fetchAll($requete);
			
		for($i=0;$i<count($row);$i++)
		{
			
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
			
			 // SPIREA - modification
			$account_lid = $rows[$i]['account_lid'];
			
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			// echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		echo'<option style="background-color: #75B4D2; color:#FFF" value="">AGROFORM</option>';
		// $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_agroform.'   order by account_firstname asc';
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_agroform.'   order by account_lid asc';
		$row = $this->db->fetchAll($requete);
		
		for($i=0;$i<count($row);$i++)
		{
			
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
	     	// SPIREA - modification
			$account_lid = $rows[$i]['account_lid'];
			
			echo'<option value='.$account_id.'>'.$account_lid.'</option>';
			
			// echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		
		echo'</select>';
	}
	
	function selectionner_conseiller($id='')
	{
		if($id!=NULL)
		{
		$requete ='Select * from '.$this->table_accounts.' where account_id='.$id.'';
		$result=$this->db->fetchRow($requete);
		}
		
		echo'<select style="width:150px"  name="conseiller_id_ref">';
		if($id!=NULL)
		{
		echo'<option value='.$id.'>'.$result['account_firstname'].' '.$result['account_lastname'].'</option>';
		}
		else
		{	echo'<option value=""></option>';}
		
	
			
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group=-9 order by account_firstname asc';
		$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
			
			echo'<option value='.$result[$i]['account_id'].'>'.$result[$i]['account_firstname'].' '.$result[$i]['account_lastname'].'</option>';
			
		}
		
		echo'</select>';
	}
	
	
	function update_presta($id_presta,$lc,$conseiller_id,$date_debut,$date_fin,$date_envoi,$statut)
	{
		$deb1=explode("/",$date_debut);
		 $deb1=mktime(0,0,0,$deb1[1],$deb1[0],$deb1[2]);
		 
		 
		 $deb2=explode("/",$date_fin);
		 $deb2=mktime(23,59,0,$deb2[1],$deb2[0],$deb2[2]);
		  
		  $deb3=explode("/",$date_envoi);
		 $deb3=mktime(0,0,0,$deb3[1],$deb3[0],$deb3[2]);
		 if($deb2=="")
		 {
			$deb2=0;
			}

 if($deb3=="")
		 {
			$deb3=0;
			}

	
	$data = array( 'statut'=>$statut ,'date_envoi_bilan'=>$deb3 ,'lettre_de_commande'=>$lc , 'id_ref'=>$conseiller_id , 'date_debut'=>$deb1 , 'date_fin'=>$deb2 ) ;
	$this->db->update($this->table_prestation,$data,'id_presta='.$id_presta.'');
	

	$requete2='SELECT * FROM  egw_cal  where id_presta='.$id_presta.'';
	$result=$this->db->fetchRow($requete2);
	if($result['cal_description']!=NULL)
	{
	
		
			$cal_description=$result['cal_description'];
			$cal_description_r=str_replace('?',''.$lc.'',$cal_description);
		
		
		
		if(count($result)!=0)
		
		 {
	$data = array( 'cal_description'=>$cal_description_r  ) ;
		$this->db->update($this->table_cal,$data,'id_presta='.$id_presta);
		 }
	}
	}
	
	
	function update_nb_relance()
	{
	
	for ($i=1 ; $i<2643 ; $i++)
	{
	$requete2='SELECT * FROM  egw_infolog  where id_presta='.$i.'';
	$result=$this->db->fetchAll($requete2);
	
	echo count($result).' ';
	if(count($result)!=0)
	{
		$data = array( 'nb_relance'=>count($result) ) ;
		$this->db->update('egw_prestation',$data,'id_presta='.$i);
	}
	
	}
	}
	function update_fonction()
	{
	
	
	$requete2='SELECT * FROM  egw_contact_parcours_pro where personne_concernee="vous" ';
	$result=$this->db->fetchAll($requete2);
	
for ($i=0 ; $i<count($result) ; $i++)
	{
		
	
		$data = array('fonction'=>$result[$i]['poste']) ;
		$this->db->update('egw_contact',$data,'id_ben='.$result[$i]['id_ben']);
	}
	
	
	}
	function _destruct()
	{
	mysql_close($this->db);
	
	
	
	}
	
}
?>
