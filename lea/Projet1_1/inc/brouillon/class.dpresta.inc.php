<?php

class presta
{
	public $cat_id_owner ;
	//public $lid_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_employeur;
	

/*public $db_user ="egroupware";
	public $db_pass ="123456";
	public $db_host ="localhost";
	public $db_name ="lea";*/

	
	public $db;
public $db_host ="localhost";
	public $db_name ="lea";
	public $db_user ="root";
	public $db_pass ="Tim.01Mysqlv1";

	
	
	
	
	
	// constructeur 
	function __construct()
	{
		
	
		
			
	/*	 	
$db_host = $egw_info["server"]["db_host"] ; 
$db_name = $egw_info["server"]["db_name"] ;
$db_user = $egw_info["server"]["db_user"] ; 
$db_pass = $egw_info["server"]["db_pass"] ; */

// on se connecte à MySQL
$this->db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$this->db); 
  
  
  
  

	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	
		
	function presta_epce($id,$statut=NULL,$id_ref,$mot=NULL,$limit=10)
	{
		$temps_mois=time()+ 2678400;
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		if($statut=="Nouvelle")
		{
			$stat=1;
		}
		if($statut=="En cours")
		{
			
			$stat=2;
		}
		if($statut=="A cloturer")
		{
			
			$stat=3;
		}
		if($statut=="relance")
		{
			
			$stat=4;
		}
		
		
		if(isset($statut) and $statut!=NULL )
		{
			if($id_ref!=0)
			{
				$requete2='SELECT statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="EPCE" and statut like "%'.$statut.'%" and id_ref='.$id_ref.'  order by date_debut desc limit '.$limit.'';
			}
			else
			{
			$requete2='SELECT statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where presta="EPCE" and statut like "%'.$statut.'%"  order by date_debut desc limit '.$limit.'';
			
			}
			
			
		}
		
		elseif(isset($mot) and $mot!=NULL )
		{
		$requete2='SELECT  statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation  where intitule like "%'.$mot.'%" and presta="EPCE"  order by date_debut desc limit '.$limit.'';
		
		}
		else
		{
			$requete2='SELECT  statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut FROM  egw_prestation limit '.$limit.'';
			
		}
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat2))
		{
		
	$intitule[]=$row['intitule'];
	$statut[]=$row['statut'];
	$date_debut[]=$row['date_debut'];
	$date_fin[]=$row['date_fin'];
	$id_ben[]=$row['id_ben'];
	$lettre_de_commande[]=$row['lettre_de_commande'];
		}
		
		for($i=0;$i<count($id_ben);$i++)
		{
			
	if($date_debut[$i]==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut[$i]);
		
	}
	
	if($date_fin[$i]==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin[$i]);
		
	}
	
	if($this->rdv_der($intitule[$i])>=$date_fin[$i])
	{
		if(date('d',$this->rdv_der($intitule[$i]))==date('d',$date_fin[$i]))
		{$color='style="color: #0C0"';}
		else
		{
		$color='style="color:#F00"';
		}
	}
	else
	{
	$color='style="color: #0C0"';
	}
	
	if($id_ben!=0)
	{
	$domicile_ben=$this->domicile_ben($id_ben[$i]);
	$faisabilite_ben=$this->faisabilite($id_ben[$i]);
	//$faisabilite_ben[1]=$this->estimation($id_ben);
	$alternative_ben=$this->alternative($id_ben[$i]);
	}
	$lieu=explode("_",$this->rdv_lieu($intitule[$i]));
	
	if($this->rdv_der($intitule[$i])==0)
	{
	$date_reelle=NULL;
	}
	elseif($date_fin[$i]<=time())
	{
		$date_reelle=date('d/m/Y',$this->rdv_der($intitule[$i]));
	}
	else
	{
		$date_reelle=NULL;
	}
	//date('d/m/Y',$cal_start);
	
	/*if($statut=="En cours")
	{
	$statut='<img src="images/suivi_icons/magnifier.png" />';
	}
	elseif($statut=="Annulee")
	{
	$statut='<img src="images/suivi_icons/cancel.png" />';
	}
	elseif($statut=="Complete")
	{
	$statut='<img src="images/suivi_icons/accept.png" />';
	}*/
	
	//STATUT AUTOMATIQUE
	//$this->statut_auto($intitule,$id_ben);
	
	/*if($statut=="Nouvelle")
	{
		$alert="&alert=Nouvelle";
	}
	else
	{
		$alert=NULL;
	}*/
	
	if($faisabilite_ben[0]==3)
	{
	$faisabilite_ben[0]='<img src="images/suivi_icons/accept.png"/>';
	}
	elseif($faisabilite_ben[0]==2)
	{
	$faisabilite_ben[0]='<img src="images/suivi_icons/arrow_redo.png"/>';
	}
	elseif($faisabilite_ben[0]==1)
	{
	$faisabilite_ben[0]='<img src="images/suivi_icons/cross.png"/>';
	}
	if($faisabilite_ben[1]==3)
	{
	$faisabilite_ben[1]='<img src="images/time_win/clock_green.ico"/>';
	}
	elseif($faisabilite_ben[1]==2)
	{
	$faisabilite_ben[1]='<img src="images/time_win/clock_orange.ico"/>';
	}
	elseif($faisabilite_ben[1]==1)
	{
	$faisabilite_ben[1]='<img src="images/time_win/clock.ico"/>';
	}
	
	if(!isset($mot))
	{
	if($stat==1)
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Vérification du premier rendez-vous" onclick="window.open(\'../../presta/epce/premier_rdv.php?intitule='.$intitule[$i].'&id='.$id.'&id_ben='.$id_ben[$i].'\',\'PREMIER RENDEZ VOUS EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
	else if($stat==2)
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/suite_rdv.php?intitule='.$intitule[$i].'&id='.$id.'&id_ben='.$id_ben[$i].'\',\'SUITE DE LA PRESTA EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
		else
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?id='.$id.'&id_ben='.$id_ben[$i].'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
		
	
	}
	else if(isset($mot))
	{
			if($stat==1)
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Vérification du premier rendez-vous" onclick="window.open(\'../../presta/epce/premier_rdv.php?intitule='.$intitule[$i].'&id='.$id.'&id_ben='.$id_ben[$i].'\',\'PREMIER RENDEZ VOUS EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).'%</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
	else if($stat==2)
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/suite_rdv.php?intitule='.$intitule[$i].'&id='.$id.'&id_ben='.$id_ben[$i].'\',\'SUITE DE LA PRESTA EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
	else
	{
		 $compteur++;
	echo'<tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?id='.$id.'&id_ben='.$id_ben[$i].'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td '.$color.' >'.$date_reelle.'</td><td>'.$this->rdv_pose($intitule[$i]).'</td><td style="color:#093" >'.$this->rdv_acc($intitule[$i]).'</td><td>'.$this->rdv_rej($intitule[$i]).'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td  align="left">'.$domicile_ben.'</td><td >'.$faisabilite_ben[0].'</td><td>'.$faisabilite_ben[1].'</td><td>'.$alternative_ben.'</td><td style="color:#093" align="right">'.$this->pourcentage_epce($id_ben[$i]).' %</td><td><input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/>'.$statut[$i].'</td></tr>';
	}
	}
		
		
		
		}
	
	}
	
	function presta_epce_relance($id,$presta,$id_ref,$limit)
	{
		
		$lim=explode(",",$limit);
		$compteur=$lim[0];
		
		
	if($id_ref=="")
	{
	
		$requete2='SELECT statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" and date_fin<'.(time()-7776000).' and relance=0 order by date_debut desc limit '.$limit.'';	
		
	}
	else
	{
		
			$requete2='SELECT id_epce,statut,intitule,id_ben,lettre_de_commande,date_fin,date_debut,relance FROM  egw_prestation  where presta="'.$presta.'" and statut like "Complete%" and id_ref='.$id_ref.'  and date_fin<'.(time()-7776000).' and relance=0  order by date_debut desc limit '.$limit.'';
	}

	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat2))
		{
		$id_epce[]=$row['id_epce'];
	$intitule[]=$row['intitule'];
	$statut[]=$row['statut'];
	$date_debut[]=$row['date_debut'];
	$date_fin[]=$row['date_fin'];
	$id_ben[]=$row['id_ben'];
	$relance[]=$row['relance'];
	$lettre_de_commande[]=$row['lettre_de_commande'];
	
		}
		for ($i=0;$i<count($id_epce);$i++)
		{
		
		if($date_debut[$i]==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut[$i]);
		
	}
	
	if($date_fin[$i]==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin[$i]);
		
	}
	
	$lieu=explode("_",$this->rdv_lieu($intitule[$i]));
	
	
	$contact=$this->contact($id_ben[$i]);
	
	
		 $compteur++;
	echo'<form onsubmit="confirm()" method="get" action="suivi_relance.php" /><input type="hidden" value="'.$limit.'" name="voir" /><input type="hidden" value="'.$id_ref.'" name="conseiller_id" /><input type="hidden" value="'.$presta.'" name="presta" /><input type="hidden" value="default" name="domain" /><tr  align="center" class="rows"><td>'.$compteur.'</td><td align="left"><a title="Voir la prestation de ce bénéficiaire" target="_blank" >'.$intitule[$i].'</a></td><td >'.$lettre_de_commande[$i].'</td><td >'.$dat_1.'</td><td>'.$dat_2.'</td><td align="left">'.$this->rdv_referent($intitule[$i]).'</td><td  align="left"  >'.$lieu[2].'</td><td><font color="#FF0000">'.$contact[0].'</font></td><td><font color="#FC5454">'.$contact[1].'</font></td><td><font color="#FFA297">'.$contact[2].'</td><td align="left">'.$contact[3].'<input type="hidden" name="id_ben" value="'.$id_ben[$i].'"/></td><td><img title="Modifier le dossier du bénéficiaire" src="images/modif.png"/><img onclick="window.open(\'../../presta/epce/relance/suivi.php?intitule='.$intitule[$i].'&id='.$id.'&id_ben='.$id_ben[$i].'\',\'SUIVI DES RELANCES\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=300\');"  title="Suivi des relances" src="images/suivi_icons/mobile_phone.png"/><input type="image" title="Clôturer la relance" src="images/tick_16.png" /></td></tr></form>';
	
		
		
		}
	
	
	}
	
	
	function rdv_realise()
	{
	
	}
	function rdv_pose($intitule)
	{
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'"  order by cal_id desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		
		return mysql_num_rows($resultat);
		
	}
	function rdv_referent($intitule)
	{
		$requete='SELECT id_ref FROM  egw_prestation  where intitule="'.$intitule.'"';
	
		$resultat = mysql_query($requete) or die(mysql_error());
			while($row = mysql_fetch_array($resultat))
		{
			$id_ref=$row['id_ref'];
			
			
		}

		
		$requete='SELECT account_firstname,account_lastname FROM  egw_accounts  where account_id='.$id_ref.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
			while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
		}
		
		return $account_firstname.' '.$account_lastname;
		
	}
	
		function rdv_referent_id($intitule)
	{
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		if($cal_id!=NULL)
		{
		$requete='SELECT cal_user_id FROM  egw_cal_user  where cal_id='.$cal_id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_user_id=$row['cal_user_id'];
			
		}
		
		
		
		return $cal_user_id;
		}
		else
		{}
	}
	
	function rdv_lieu($intitule)
	{
		$requete='SELECT cal_category FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_category=$row['cal_category'];
			
		}
		if($cal_category!=NULL)
		{
		$requete='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category.'%" order by cat_id asc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cat_name=$row['cat_name'];
			
		}
		
	
		return $cat_name;
		}
		else
		{}
	}
	function rdv_der($intitule)
	{
		
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';

		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		
		$requete='SELECT cal_start FROM  egw_cal_dates where cal_id='.$cal_id.' order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_start=$row['cal_start'];
			
		}
		
		if($n>=4)
		{
		return $cal_start;
		
		}
		
		}
		else
		{
		//return 'aucune date';
		}
	}
	function rdv_acc($intitule)
	{
		
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';

		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			
		}
		
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		$req=NULL;
		
		for($i=0;$i<count($cal_id);$i++)
		{
			$req=$req.' or cal_id='.$cal_id[$i];
		}
		
		
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.')  and (cal_status="A")';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);
	
		
		
		return $n;
		
		}
		
	}
	function rdv_rej($intitule)
	{
		
		$requete='SELECT cal_id FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';

		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			
		}
		
		
		if(isset($cal_id) and $cal_id!=NULL)
		{
		$req=NULL;
		
		for($i=0;$i<count($cal_id);$i++)
		{
			$req=$req.' or cal_id='.$cal_id[$i];
		}
		
		
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.')  and (cal_status="R")';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		$n=mysql_num_rows($resultat);
	
		
		
		return $n;
		
		}
		
	}
	
	function domicile_ben($id)
	{
		$requete='SELECT adr_two_locality FROM  egw_addressbook  where id='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$adr_two_locality=$row['adr_two_locality'];
			
		}
		return $adr_two_locality;
	}
	
	function contact($id)
	{
		$requete='SELECT tel_work,tel_home,tel_cell,email,email_home FROM  egw_addressbook  where id='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$tel_work=$row['tel_work'];
			$tel_home=$row['tel_home'];
			$tel_cell=$row['tel_cell'];
			$email=$row['email'];
			$email_home=$row['email_home'];
			
		}
		return array($tel_work,$tel_home,$tel_cell,$email,$email_home);
	}
	function montant_previsionnel($nbre_rdv)
	{
		if($nbre_rdv==4)
		$nbre_rdv=6;
		if($nbre_rdv==3)
		$nbre_rdv=4;
		if($nbre_rdv==2)
		$nbre_rdv=3;
		if($nbre_rdv==1)
		$nbre_rdv=2;
		return (290/6) * $nbre_rdv;
	
	}
	function faisabilite($id)
	{
		
		
		
		$requete='SELECT avis1,avis2 FROM  egw_epce_bilan_avis  where id_beneficiaire='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$avis1=$row['avis1'];
			$avis2=$row['avis2'];
		}
		
		
/*	if($avis1=='1')
{
$po='Negatif';
}

elseif($avis1=='2')
{
$po='Positif sous reserve';
}
elseif($avis1=='3')
{
$po='Positif';
}
elseif($avis1=='4')
{
$po='Solution alternative';
}
else
{
$po='?';
}*/
return array($avis1,$avis2);
	}

/*	function estimation($id)
	{
		
		
		
		$requete='SELECT avis2 FROM  egw_epce_bilan_avis  where id_beneficiaire='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$avis2=$row['avis2'];
			
		}
		
		
if($avis2=='1')
{
$six='6 mois a 1 an';
}
elseif($avis2=='2')
{
$six='3 a 6 mois';
}
elseif($avis2=='3')
{
$six='Inferieur a 3 mois';
}
else
{
$six='?';
}
return $six;
	}
	*/
	
	function alternative($id)
	{
		
		
		
		$requete='SELECT code_rome FROM  egw_epce_bilan_avis  where id_beneficiaire='.$id.'';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$code_rome=$row['code_rome'];
			
		}
		

return $code_rome;
	}
	function maj_statut($id,$statut)
	{
	
					  
	$requete = "Update egw_prestation set statut='$statut'  where id_ben=$id";
	
	$resultat = mysql_query($requete) or die(mysql_error());
		
	}
	function statut_auto($intitule,$id)
	{
		//echo $intitule.$id.'<br/>';
		
	/*	if($this->rdv_acc($intitule)>=4)
		{
		
			$requete='Update egw_prestation set statut="Complete" where id_ben='.$id.'  and  statut!="Complete" and  date_fin!=0  and date_fin<'.time().'  ';
			$resultat = mysql_query($requete) or die(mysql_error());
		if(mysql_num_rows($resultat)!=0)
			{
					echo'<script>window.location.reload();</script>';
			}
		}*/
		/*elseif($this->rdv_acc($intitule)>=1 and  $this->rdv_acc($intitule)<4  and $this->rdv_rej($intitule)>=1)
		{
			$requete='Update egw_prestation set statut="Proratisee" where id_ben='.$id.'  and  statut!="Proratisee" and date_fin!=0  and date_fin<'.time().' ';
			$resultat = mysql_query($requete) or die(mysql_error());
			if(mysql_num_rows($resultat)!=0)
			{
					echo'<script>window.location.reload();</script>';
			}
		}*/
	/*	elseif($this->rdv_acc($intitule)>=1)
		{
			
			$requete='Update egw_prestation set statut="En cours" where id_ben='.$id.'  and  statut="Nouvelle" and  date_fin!=0   ';
			
			
			$resultat = mysql_query($requete) or die(mysql_error());
			if(mysql_num_rows($resultat)!=0)
			{
					echo'<script>window.location.reload();</script>';
			}
		}*/
		if($this->voir_validation($id)==NULL)
		{
		
			$requete='Update egw_prestation set statut="A cloturer" where id_ben='.$id.'  and  statut="En cours" and  date_fin!=0  and date_fin<'.time().' ';
			$resultat = mysql_query($requete) or die(mysql_error());
			if(mysql_num_rows($resultat)!=0)
			{
					echo'<script>window.location.reload();</script>';
			}
		}
		
		
		
	/*	elseif($this->rdv_rej($intitule)>=1)
		{
			$requete='Update egw_prestation set statut="Annulee" where id_ben='.$id.'  and  statut!="Annulee" and date_fin!=0  and date_fin<'.time().' ';
			$resultat = mysql_query($requete) or die(mysql_error());
			if(mysql_num_rows($resultat)!=0)
			{
				echo'<script>window.location.reload();</script>';
			}
		}*/
		
	}
		
		function selectionner_conseiller($conseiller_id)
	{
		
		if($conseiller_id!=NULL)
		{
		/*$requete='SELECT account_firstname,account_lastname,account_id FROM  egw_accounts  where  account_id='.$conseiller_id.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<select name="conseiller_id"><option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}*/
		echo'<select name="conseiller_id"><option value="0"></option>';
		}
		else
		{
		echo'<select name="conseiller_id"><option value="0">Tous les conseillers</option>';
		}
		
		
			
	$requete='SELECT * FROM  egw_accounts  where  account_status="A" and account_type="u" and ( account_primary_group="-9" or  account_primary_group="-2")  order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		echo'</select>';
	}
	
	function epce_stats($statut,$id_ref)
	{
		
		
	
		if($id_ref!=0)
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "%'.$statut.'%" and id_ref='.$id_ref.' ';
		}
		else
		{
		$requete2='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "%'.$statut.'%" ';
		}
		
		
		
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	

	
		
		return mysql_num_rows($resultat2);
		
	
		
		
	}
	function epce_relance($id_ref)
	{
		
		if($id_ref!=0)
		{
	$requete='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "Complete%" and id_ref='.$id_ref.'  and date_fin<'.(time()-7776000).' and relance=0';
		}
		else
		{
			$requete='SELECT intitule FROM  egw_prestation  where presta="EPCE" and statut like "Complete%"  and date_fin<'.(time()-7776000).'  and relance=0';
		}
		
		
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
	

	
	return mysql_num_rows($resultat);
	}
		


			function pourcentage_epce($id_ben)
	{
		
		$requete='SELECT * FROM  egw_epce_validation  where id_beneficiaire='.$id_ben.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
		
		    $plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
			
		
		
		}
		return	round((($plan + $coherence + $commerciaux + $financier +$juridique+$bilan)/6)*100,1);
	}
		
		
	function voir_validation($id)
	{
		
		$requete='SELECT * FROM  egw_epce_validation  where id_beneficiaire='.$id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
			
		
		while($row = mysql_fetch_array($resultat))
		{
			$plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
			$epce=$row['epce'];
			
		}	
		return $epce;
				
	
	}
	
	
	

	 function get_id_ben()
	{
		$requete='SELECT intitule FROM  egw_prestation order by id_ben desc';
		//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$intitule[]=$row['intitule'];
		}
		
		
		for($i=0;$i<count($intitule);$i++)
		{
			
		$civil=explode(" ",$intitule[$i]);
		$civil[0];
		$civil[1];
		$civil[2];
		
		if($civil[2]!=NULL)
		{
		$requete_='SELECT id FROM  egw_addressbook  where n_family="'.$civil[0].' '.$civil[1].'" and n_given="'.$civil[2].'" limit 1 ';
		}
		else if($civil[2]==NULL)
		{
		$requete_='SELECT id FROM  egw_addressbook  where n_family="'.$civil[0].'" and n_given="'.$civil[1].'" limit 1 ';
		}
		
		
		//echo $requete_;
		$resultat_ = mysql_query($requete_) or die(mysql_error());
		while($row = mysql_fetch_array($resultat_))
		{
			$id=$row['id'];
			
			if($id!=NULL)
		{
		
	$requete = 'Update egw_prestation set id_ben='.$id.' where intitule="'.$intitule[$i].'"';
	$resultat = mysql_query($requete) or die(mysql_error());
	echo $requete;
	//return 'Nombre de modification :'.$compteur++;
		
		}
		
		
		
		}
		
		}
	
	
	}
	
	
	
	 function maj_link_rdv()
	{
		$requete='SELECT * FROM  egw_cal where cal_title like "%EPC93%" order by cal_id desc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_title[]=$row['cal_title'];
			$cal_id[]=$row['cal_id'];
			
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$title=explode("_",$cal_title[$i]);
		
		$civil=explode(" ",$title[2]);
		
		
		
		
		$requete_='SELECT id FROM  egw_addressbook  where n_family="'.$civil[0].'" and n_given="'.$civil[1].'" limit 1';
	//echo $requete_;
		$resultat_ = mysql_query($requete_) or die(mysql_error());
		while($row = mysql_fetch_array($resultat_))
		{
			$id=$row['id'];
			
		if($id!=NULL)
		{
		$requete ='DELETE FROM egw_links where link_app1="calendar" and link_app2="addressbook" and link_id2="'.$id.'" and link_id1="'.$cal_id[$i].'" ';
	$resultat = mysql_query($requete) or die(mysql_error());
	
	$requete = 'insert into egw_links value("","calendar","'.$cal_id[$i].'","addressbook","'.$id.'","","","13")';
	$resultat = mysql_query($requete) or die(mysql_error());
	//echo mysql_num_rows($resultat);
	//return 'Nombre de modification :'.$compteur++;
		}
		
		}
			
	
	}
	
	}

	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>