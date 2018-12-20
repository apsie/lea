<?php

class epce
{
	public $cat_id_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_contact_prescripteur ;
	public $cat_id_formation ;
	public $cat_id_certification ;
	public $cat_id_employeur;
	public $cat_id_org_resacc;
	public $usager_annee;
	public $compteur_date = 0;
	public $cal_id_rejete=109;
	public $db;
	public $table_contact = 'egw_contact';
	public $table_parcours_pro = 'egw_contact_parcours_pro';
	public $table_etat_civil = 'egw_contact_etat_civil';
	public $table_projet = 'egw_projet';
	public $table_dispositif = 'egw_dispositif';
	public $table_cal_dates = 'apsie_jqcalendar';
	public $table_cal_user= 'egw_cal_user';
	public $table_cal= 'apsie_jqcalendar';
	public $table_prestation = 'egw_prestation';
	public $table_formation = 'egw_contact_formation';
	public $table_organisation = 'egw_organisation';
	public $table_projet_organisation ='egw_organisation';
	public $table_validation ='egw_epce_validation';
	public $id_group_apsie = '-3007';
	public $id_group_stragefi = '-3008';
	public $id_group_agroform = '-3009';	
	
	
	// constructeur 
	function __construct($annee='')
	{
	
	include('config/config.php');
     $this->db=$db;

	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Usager_'.$annee.'"';
    $result=$db->fetchRow($requete);
	$this->cat_id_beneficiaire=$result['cat_id'];


    $requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="PRESCRIPTEURS"';
    $result=$db->fetchRow($requete);
	$this->cat_id_prescripteur=$result['cat_id'];
	
	
    $requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Contact_prescripteur"';
    $result=$db->fetchRow($requete);
	$this->cat_id_contact_prescripteur=$result['cat_id'];

	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Org_resacc"';
    $result=$db->fetchRow($requete);
	$this->cat_id_org_resacc=$result['cat_id'];
	
		
	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="EMPLOYEURS"';
	$result=$db->fetchRow($requete);
	$this->cat_id_employeur=$result['cat_id'];
	
	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Org_formation"';
	$result=$db->fetchRow($requete);
	$this->cat_id_formation=$result['cat_id'];

	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Org_certification"';
	$result=$db->fetchRow($requete);
	$this->cat_id_certification=$result['cat_id'];
	
	
	if($this->cat_id_owner==NULL)
	{
	$this->cat_id_owner=13;
	}

	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	
	function selectionner_conseiller3($conseiller_id='')
	{
		
		if($conseiller_id!=NULL)
		{
		echo'<select style="width:150px" name="conseiller_id">';
						
	$requete='SELECT * FROM  apsie_comptes  where account_id='.$conseiller_id.'';
		$row = $this->db->fetchAll($requete);
		
		for($i=0;$i<count($row);$i++)
		{
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
		
	
		echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
		
		}
		}
		else
		{
		echo'<select style="width:150px" name="conseiller_id"><option value=""></option>';
		}
		
		echo'<option  style="background-color: #75B4D2; color:#FFF" value="">APSIE</option>';
	$requete='SELECT * FROM apsie_comptes  where account_id>5 and account_status="A" and account_type="u" and account_id_prestataire=1    order by account_firstname asc';
		$row = $this->db->fetchAll($requete);
		
		for($i=0;$i<count($row);$i++)
		{
			
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
				echo'<option style="background-color: #75B4D2; color:#FFF" value="">STRAGEFI</option>';
	$requete='SELECT * FROM apsie_comptes  where account_id>5 and account_status="A" and account_type="u" and account_id_prestataire=2   order by account_firstname asc';
	$row = $this->db->fetchAll($requete);
		
		for($i=0;$i<count($row);$i++)
		{
			
			$account_firstname=$row[$i]['account_firstname'];
			$account_lastname=$row[$i]['account_lastname'];
		    $account_id=$row[$i]['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		
		echo'</select>';
	}
	
		
	function selectionner_conseiller4($conseiller_id='')
	{
		
		if($conseiller_id!=NULL)
		{
		echo'<select name="conseiller_id">';
						
	$requete='SELECT * FROM  apsie_comptes  where account_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
		}
	
		echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
		
		}
		else
		{
		echo'<select name="conseiller_id"><option value="">Tous les conseillers</option>';
		}
		
		echo'<option  style="background-color: #75B4D2; color:#FFF" value="">APSIE</option>';
	$requete='SELECT * FROM apsie_comptes where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
				echo'<option style="background-color: #75B4D2; color:#FFF" value="">STRAGEFI</option>';
	$requete='SELECT * FROM  apsie_comptes  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_stragefi.'   order by account_firstname asc';
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
	
	
	function verif_ben($nom,$prenom)
	{
	
	$requete='SELECT id_ben FROM  egw_contact where nom="'.$nom.'" and prenom="'.$prenom.'"';
    $result=$this->db->fetchRow($requete);
	return $result['id_ben'];
	
	
	}
	
	function verif_dispositif($presta,$date_debut)
	{
	if($date_debut!=NULL)
	{
	$requete='SELECT id_dispositif,objet FROM  '.$this->table_dispositif.' where nom_dispositif="'.$presta.'" and date_debut<'.$date_debut.' and date_fin>'.$date_debut.' order by id_dispositif desc';
    $result=$this->db->fetchRow($requete);
	return array($result['id_dispositif'],$result['objet']);
	}
	
	}
		function verif_organisme($nom_organisme)
	{
		
$requete='SELECT id_organisation,nom_organisme FROM  '.$this->table_organisation.' where nom_organisme="'.$nom_organisme.'"';

   $result=$this->db->fetchRow($requete);

	return $result['id_organisation'];
	}
	function inserer_beneficiaire($id_owner,$fn,$n_family,$n_given,$n_prefix,$n_middle,$n_suffix,$tel_home,$tel_cell,$email,$email_home)
	{
	
	

    $data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'cat_id' => $this->cat_id_beneficiaire, 'nom_complet'=> ''.$fn.'' , 'nom'=> ''.$n_family.'' ,'prenom'=> ''.$n_given.'', 'deuxieme_prenom'=> ''.$n_middle.'' ,'nom_jeune_fille'=> ''.$n_suffix.'' , 'civilite'=> ''.$n_prefix.'' ,'tel_domicile_1'=> ''.$tel_home.'' , 'portable_perso'=> ''.$tel_cell.'' , 'email_perso'=> ''.$email_home.'' , 'email_pro'=> ''.$email.'') ;
		
	$this->db->insert($this->table_contact,$data);

    $requete="SELECT id_ben from egw_contact order by id_ben desc limit 1";
    $result=$this->db->fetchRow($requete);
	return $result['id_ben'];
	
	
	}
	
	
	function inserer_beneficiaire_etat_civil($id_owner,$id_ben)
	{
	
	

    $data = array('id_owner' => $id_owner ,'id_ben' => $id_ben, 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ) ;
			
		
	$this->db->insert($this->table_etat_civil,$data);
	
	
	}
	function get_pole($code_safir,$id_recup)
	{
				
	$requete='SELECT id_organisation,nom_organisme FROM  '.$this->table_organisation.' where code_org="'.$code_safir.'"';

   	$result=$this->db->fetchRow($requete);


  $data = array('id_organisation' => $result['id_organisation']);
				
	$this->db->update($this->table_contact,$data,'id_ben='.$id_recup.'');
	
	return $result['nom_organisme'];
	}
	
	function inserer_beneficiaire_situation($id_owner,$id_ben,$statut,$indemnite,$identifiant,$date_inscription,$organisme)
	{
		$dat=explode("/",$date_inscription);
		if($statut!=NULL and is_numeric($statut))
		$statut=$this->texte_id($statut);
		if($indemnite!=NULL and is_numeric($indemnite))
		$indemnite=$this->texte_id($indemnite);
		


	
    $data = array('id_owner' => $id_owner ,'id_ben' => $id_ben , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'statut' => $statut, 'identifiant'=> $identifiant , 'organisme'=> $organisme ) ;
			
		
	$this->db->insert($this->table_parcours_pro,$data);

	
	}
		function update_org_ben($id_organisation_ben,$id_owner,$nom_commercial,$raison_sociale,$activite_principale,$type_adresse,$adresse_ligne_1,$adresse_ligne_2,$adresse_ligne_3,$cp,$ville,$region,$pays,$date_immat,$date_debut_activite,$forme_juridique,$siret,$secteur_activite,$dirigeant,$implantation,$regime_imposition,$regime_tva,$regime_fiscal,$regime_social_dirigeant,$statut)
	{
		
			$dat_immat=explode("/",$date_immat);
			$dat_debut_activite=explode("/",$date_debut_activite);
	if($type_adresse!=NULL and is_numeric($type_adresse))
	{
		$type_adresse=$this->texte_id($type_adresse);
	}
		else
		{$type_adresse=utf8_decode($type_adresse);}
	
			if($forme_juridique!=NULL and is_numeric($forme_juridique))
		$forme_juridique=$this->texte_id($forme_juridique);
	

	 	if($secteur_activite!=NULL and is_numeric($secteur_activite))
		{
		$secteur_activite=$this->texte_id($secteur_activite);
		}
	else
		{$secteur_activite=utf8_decode($secteur_activite);}
		
	if($regime_fiscal!=NULL and is_numeric($regime_fiscal))
	{
		$regime_fiscal=$this->texte_id($regime_fiscal);
	}
		else
		{$regime_fiscal=utf8_decode($regime_fiscal);}
	
	
  $data = array('id_modifier' => $id_owner , 'date_last_modified'=> time() ,'nom_commercial' => utf8_decode($nom_commercial), 'raison_sociale'=> utf8_decode($raison_sociale), 'activite_principale'=>utf8_decode($activite_principale), 'type_adresse'=> $type_adresse,'adresse_ligne_1'=> utf8_decode($adresse_ligne_1), 'adresse_ligne_2'=> utf8_decode($adresse_ligne_2) ,'adresse_ligne_3'=> utf8_decode($adresse_ligne_3),'cp'=> $cp,'ville'=> $ville,'region'=> $region,'pays'=> $pays,'date_immat'=> mktime(0,0,0,$dat_immat[1],$dat_immat[0],$dat_immat[2]),'date_debut_activite'=>  mktime(0,0,0,$dat_debut_activite[1],$dat_debut_activite[0],$dat_debut_activite[2]),'forme_juridique'=> $forme_juridique,'siret'=> $siret,'secteur_activite'=> $secteur_activite,'dirigeant'=> $dirigeant,'implantation'=> $implantation,'regime_imposition'=> $regime_imposition,'regime_tva'=> $regime_tva,'regime_fiscal'=> $regime_fiscal,'regime_social_dirigeant'=> $regime_social_dirigeant,'statut'=>$statut);
				
	$this->db->update($this->table_projet_organisation,$data,'id_resacc='.$id_organisation_ben.'');
	
	
	}
	
	function inserer_beneficiaire_projet($id_owner,$id_ben,$deb,$prestation,$beneficiaire,$id_coordinateur,$statut,$resultat,$description_projet)
	{
		if($prestation=="EPCE" or $prestation=="NACRE1" or $prestation=="NACRE3")
		{
		$intitule_projet = date('Y').date('m').'_CREA_'.$beneficiaire;
		$categorie = "CREA";
		}
		else
		{
		$intitule_projet = date('Y').date('m').'_DEV_'.$beneficiaire;
		$categorie = "DEV";
		}
		/*$deb=explode("/",$debut);
		 $deb=mktime(0,0,0,$deb[1],$deb[0],$deb[2]);*/
	
    $data = array('id_owner' => $id_owner ,'id_ben' => $id_ben , 'date_fin_previsionnelle'=> (time()+18144000),  'date_debut'=> time() , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'statut' => $statut, 'id_coordinateur'=> $id_coordinateur,'description_projet'=> utf8_decode($description_projet),'intitule_projet'=> $intitule_projet,'categorie'=> $categorie,'date_debut'=> $deb,'resultat'=>$resultat) ;
			
		
	$this->db->insert($this->table_projet,$data);

	$requete = 'select id_projet from '.$this->table_projet.' order by id_projet desc';
	$result = $this->db->fetchRow($requete);
	return $result['id_projet'];
	}
	
	function selectionner_projet_ben($id_ben,$id_owner,$id_coordinateur,$prestation,$deb,$beneficiaire,$statut,$description_projet)
	{
	$requete = 'select id_projet from '.$this->table_projet.' where id_ben = '.$id_ben.' order by id_projet desc';
	$result = $this->db->fetchRow($requete);
	$id_projet_return = $result['id_projet'];
	if($result['id_projet']==NULL)
	{
		 $id_projet_return=$this->inserer_beneficiaire_projet($id_owner,$id_ben,$deb,$prestation,$beneficiaire,$id_coordinateur,$statut,'En attente de resultat',$description_projet);
		$this->inserer_resacc($id_ben,$id_owner,$id_owner,$id_projet_return,'...','','','','','','','','','','','','','','','','','','','','En cours');
	
	}
	elseif($result['id_projet']!=NULL and $description_projet!=NULL)
	{
		$data = array('description_projet'=>utf8_decode($description_projet));
		$GLOBALS['db']->update('egw_projet',$data,'id_projet='.$result['id_projet']);
	}
	return $id_projet_return ;
	}
	
	function selectionner_dispositif()
	{
		
	    $requete='SELECT * FROM  '.$this->table_dispositif.'  where etat=0 order by id_dispositif desc';
		$result=$this->db->fetchAll($requete);
echo'<select style="width:250px" name="dispositif">';
	for($i=0;$i<count($result);$i++)
	{
			
			echo'<option value='.$result[$i]['id_dispositif'].'>'.$result[$i]['nom_dispositif'].' - du '.date("d/m/Y",$result[$i]['date_debut']).' au '.date("d/m/Y",$result[$i]['date_fin']).'</option>';
			
			
			
		}
	echo'</select>';
	
	}
	function return_nom_dispositif($id_dispositif)
	{
		
	    $requete='SELECT * FROM  '.$this->table_dispositif.'  where id_dispositif='.$id_dispositif.'';
		$result=$this->db->fetchRow($requete);
        return $result['nom_dispositif'];
	
	}
	function return_org_ben($id_ben,$id_projet)
	{
		
	    $requete='SELECT * FROM  '.$this->table_projet_organisation.'  where id_ben='.$id_ben.' and id_projet='.$id_projet.' ';
		$result=$this->db->fetchRow($requete);
        return array($result['nom_commercial'],$result['raison_sociale'],$result['activite_principale'],$result['type_adresse'],$result['adresse_ligne_1'],$result['adresse_ligne_2'],$result['adresse_ligne_3'],$result['cp'],$result['ville'],$result['region'],$result['pays'],$result['date_immat'],$result['date_debut_activite'],$result['forme_juridique'],$result['siret'],$result['secteur_activite'],$result['dirigeant'],$result['implantation'],$result['regime_imposition'],$result['regime_tva'],$result['regime_fiscal'],$result['regime_social_dirigeant'],$result['statut']);
	
	}
	
	
	function return_nom_projet($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_projet.'  where id_ben='.$id_ben.' ';
		
		$result=$this->db->fetchAll($requete);
       for($i=0;$i<count($result);$i++)
	   {
		   
		   echo'<h2><img src="../images/32x32/category.png" /> <a>PROJET</a> : <a href="javascript:voirdiv(\'div_projet\')">'.$result[$i]['intitule_projet'].'  ( '.$result[$i]['statut'].' - '.$this->nbr_presta_by_projet($result[$i]['id_projet']).' prestations )</a> <input  onclick="window.open(\'../../../extranet/www/index.php?page=Projet&id_projet='.$result[$i]['id_projet'].'\',\'Projet\',\'left=0,top=0,width=1300,height=800,scrollbars=1\');" style="cursor:pointer" type="button" value="Modifier"/></h2>';
	  	echo'<div style="display:none" id="div_projet">';
		$this->selectionner_organisation_ben($id_ben,$result[$i]['id_projet']);
		
	    $this->selectionner_prestation($id_ben,$result[$i]['id_projet']);
	//	$this->selectionner_relance($id_ben);
	echo'</div>';
	
	$id_projet=$result[$i]['id_projet'];
	   }
	   return $id_projet;
	  
	}
	function nbr_presta_by_projet($id_projet)
	{
		
	    $requete='SELECT * FROM  '.$this->table_prestation.'  where id_projet='.$id_projet.' ';
		
		$result=$this->db->fetchAll($requete);
    return count($result);
	}
	function return_nb_formation($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_formation.'  where id_ben='.$id_ben.'';
		$result=$this->db->fetchAll($requete);
        return count($result);
	
	}
	function return_nb_parcours_pro($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_parcours_pro.'  where id_ben='.$id_ben.'';
		$result=$this->db->fetchAll($requete);
        return count($result);
	
	}
	 function return_ids_organisme($id_ben)
	{
		
	   $requete='SELECT id_organisation FROM  '.$this->table_contact.'  where id_ben='.$id_ben.'';
	
		$result=$this->db->fetchRow($requete);
        return $result['id_organisation'];
	
	}
	 function return_val_organisme($nom_organisme)
	{
		
	   $requete='SELECT * FROM  '.$this->table_organisation.'  where nom_organisme="'.$nom_organisme.'"';
	
		$result=$this->db->fetchRow($requete);
        return array($result['adresse_ligne_1'],$result['adresse_ligne_2'],$result['adresse_ligne_3'],$result['cp'],$result['ville'],$result['region'],$result['pays'],$result['tel'],$result['fax'],$result['email'],$result['site_web'],$result['id_organisation']);
	
	}
	 function return_nbr_by_organisme($nom_organisme)
	{
		
	   $requete='SELECT * FROM  '.$this->table_organisation.'  where nom_organisme ="'.$nom_organisme.'"';
	  
	
		$result=$this->db->fetchRow($requete);
       $requete2='SELECT * FROM  '.$this->table_contact.'  where id_organisation like "%'.$result['id_organisation'].'%"' ;
	$result2=$this->db->fetchAll($requete2);
	if($result['id_organisation']!=NULL and $result['id_organisation']!=0)
	{
	return count($result2);
	}
	
	}
	function return_etat_civil($choix)
	{
		
	
		$requete='SELECT * FROM  '.$this->table_etat_civil.'  where id_ben='.$choix.' order by id_etat_civil desc';
		$result=$this->db->fetchRow($requete);		
		return array($result['date_naissance'],$result['lieu_naissance'],$result['nationalite'],$result['situation_maritale'],$result['enfants_a_charge']);
	}
	
	function return_intitule_ben_org($id_ben,$nom_organisme,$cat_org="")
	{
		
		if($cat_org=="employeur")
		{
			$requete='SELECT intitule_poste FROM  '.$this->table_parcours_pro.'  where id_ben='.$id_ben.' and organisme="'.$nom_organisme.'" order by id_parcours desc';
			
			$result=$this->db->fetchRow($requete);		
		return $result['intitule_poste'];
			
			}
		else
		{
	
		$requete='SELECT intitule_formation FROM  '.$this->table_formation.'  where (id_ben='.$id_ben.') and (organisme_formation="'.$nom_organisme.'" or organisme_certification="'.$nom_organisme.'") order by id_formation desc';
		$result=$this->db->fetchRow($requete);		
		return $result['intitule_formation'];
		}
		
	}
	 function afficher_membre_organisme($id_organisme,$nom_organisme,$cat_org="")
	{
	
       $requete2='SELECT * FROM  '.$this->table_contact.'  where id_organisation like "%'.$id_organisme.'%"' ;
	$result2=$this->db->fetchAll($requete2);
	echo '<table>';
	for($i=0;$i<count($result2);$i++)
	{
	
	echo'<tr><td><img src="../images/icons/user.png" /></td><td><a target="_blank" href="panel.php?choix='.$result2[$i]['id_ben'].'" >'.$result2[$i]['nom_complet'].'</a></td><td><strong>'.utf8_encode($this->return_intitule_ben_org($result2[$i]['id_ben'],$nom_organisme,$cat_org)).'</strong></td><td>'.$result2[$i]['portable_perso'].'</td><td>'.$result2[$i]['tel_domicile_1'].'</td><td>'.$result2[$i]['adresse_ligne_1'].'</td><td>'.$result2[$i]['adresse_ligne_2'].'</td><td>'.$result2[$i]['adresse_ligne_3'].'</td><td>'.$result2[$i]['cp'].'</td><td>'.$result2[$i]['ville'].'</td></tr>';
	}
	echo'</table>';
	}
	function update_etat_civil($id_ben,$id_owner,$date_naissance,$lieu_naissance,$nationalite,$situation_maritale,$enfants_a_charge)
	{
				if(is_numeric($situation_maritale))
	$situation_maritale=$this->texte_id($situation_maritale);	
		if(is_numeric($nationalite))
	$nationalite=$this->texte_id($nationalite);	
	
			$dat_naissance=explode("/",$date_naissance);

	
		
  $data = array('id_modifier' => $id_owner ,'id_ben' => $id_ben , 'date_last_modified'=> time() ,'date_naissance' => mktime(0,0,0,$dat_naissance[1],$dat_naissance[0],$dat_naissance[2]), 'lieu_naissance'=> $lieu_naissance, 'nationalite'=>$nationalite, 'situation_maritale'=> $situation_maritale,'enfants_a_charge'=> $enfants_a_charge );
				
	$updated=$this->db->update($this->table_etat_civil,$data,'id_ben='.$id_ben.'');
	
	if($updated==0)
	{ 
	$data = array('id_owner' => $id_owner,'id_modifier' => $id_owner ,'id_ben' => $id_ben ,'date_creation'=> time(), 'date_last_modified'=> time() ,'date_naissance' => mktime(0,0,0,$dat_naissance[1],$dat_naissance[0],$dat_naissance[2]), 'lieu_naissance'=> $lieu_naissance, 'nationalite'=> $nationalite, 'situation_maritale'=> $situation_maritale,'enfants_a_charge'=> $enfants_a_charge );
				
	$this->db->insert($this->table_etat_civil,$data);
	
	}

	}
	function update_organisation($id_owner,$id_organisation,$adresse_ligne_1,$adresse_ligne_2,$adresse_ligne_3,$cp,$ville,$region,$pays,$tel,$fax,$site_web)
	{
		
  $data = array('id_modifier' => $id_owner , 'date_last_modified'=> time() ,'adresse_ligne_1' => $adresse_ligne_1,'adresse_ligne_2' => $adresse_ligne_2,'adresse_ligne_3' => $adresse_ligne_3, 'cp'=> $cp, 'ville'=>$ville,'region'=>$region,'pays'=>$pays, 'tel'=> $tel,'fax'=> $fax,'site_web'=> $site_web );
				
	$this->db->update($this->table_organisation,$data,'id_organisation='.$id_organisation);
	
	
	}
	
	
	function update_ben($id_ben,$id_owner,$civilite,$nom,$prenom,$deuxieme_prenom,$nom_jeune_fille,$adresse_ligne_1,$adresse_ligne_2,$adresse_ligne_3,$cp,$ville,$region,$pays,$tel_pro,$tel_pro_2,$tel_domicile,$tel_domicile_2,$portable_perso,$portable_pro,$email_domicile,$email_pro,$fax_domicile,$fax_pro,$site_perso)
	{
	
	
	
				if(is_numeric($civilite))
	$civilite=$this->texte_id($civilite);	
	
$data = array('date_last_modified' => time() ,'id_modifier' => $id_owner ,'nom_complet' => $civilite.' '.stripslashes(utf8_decode($nom)).' '.stripslashes(utf8_decode($prenom)),'civilite' => $civilite , 'nom'=> stripslashes(utf8_decode($nom)) , 'prenom'=> stripslashes(utf8_decode($prenom)) , 'deuxieme_prenom'=> utf8_decode($deuxieme_prenom) ,'nom_jeune_fille'=> utf8_decode($nom_jeune_fille) ,'adresse_ligne_1'=> stripslashes(utf8_decode($adresse_ligne_1)) ,'adresse_ligne_2'=> stripslashes(utf8_decode($adresse_ligne_2)), 'adresse_ligne_3'=> stripslashes(utf8_decode($adresse_ligne_3)) , 'cp'=> $cp , 'ville'=> $ville, 'region'=> $region , 'pays'=> $pays ,'tel_pro_1'=> $tel_pro,'tel_pro_2'=> $tel_pro_2,'tel_domicile_1'=> $tel_domicile,'tel_domicile_2'=> $tel_domicile_2,'portable_perso'=> $portable_perso, 'portable_pro'=> $portable_pro,'email_perso'=> $email_domicile,'email_pro'=> $email_pro,'fax_perso'=> $fax_domicile,'fax_pro'=> $fax_pro,'site_perso'=> $site_perso);
		
		
				
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben.'');


	}
	
	
	function liste_categorie()
	{
	
	

	$requete="SELECT * FROM  egw_categories  WHERE cat_id >5";
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	echo '<input type="radio" name="cat" value="'.$row['cat_name'].'" /> '.$row['cat_name'];
	echo "<br />";
	}


	}
	
	/*function link_new_prescripteur($id_ben,$code_safir,$nom,$prenom,$civilite,$tel_b,$tel_p,$email_b,$email_d,$fonction)
{


	$requete2="SELECT id FROM  egw_addressbook  WHERE code_safir=$code_safir limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_prescripteur=$row['id'];
	
	}



	//requ�te d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id_ben.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	$requete3 = 'insert into egw_contact_prescripteur value ("","'.$id_ben.'","'.$id_prescripteur.'","","","'.$civilite.'","'.$nom.'","'.$prenom.'","'.$tel_b.'","'.$tel_p.'","'.$email_b.'","'.$email_d.'","'.$fonction.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
}*/
/*	function link_beneficiaire_prescripteur($id,$beneficiaire,$prescripteur)
	{
	
	
	
 	
	
	


	$requete2="SELECT * FROM  egw_addressbook  WHERE cat_id=$prescripteur order by id desc limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_prescripteur=$row['id'];
	
	}



	//requ�te d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}
	*/
	function pole_emploi($code_safir)
	{
	
	if(isset($code_safir))
	{
	
	$requete='SELECT * FROM  '.$this->table_organisation.'  WHERE code_org="'.$code_safir.'"';
	$result=$this->db->fetchRow($requete);
	
	return array($result['nom_organisme'],$result['tel'],$result['fax'],$result['email'],$result['rue'],$result['ville'],$result['cp']);
	}
	else
	{
		return "";
	
	}
	

	}
	
	function return_contact_prescripteur($id_owner,$code_safir,$nom,$prenom,$civilite,$tel_bureau,$fax_pro,$email_pro,$email_perso,$

)
	{
	
	
	// return id_org
	$requete='SELECT id_organisation FROM '.$this->table_organisation.'  WHERE code_org="'.$code_safir.'"';
	$result=$this->db->fetchRow($requete);
	
	
	//
	$requete2='SELECT id_ben FROM '.$this->table_contact.' WHERE nom="'.$nom.'" and prenom="'.$prenom.'" and cat_id like "%'.$this->cat_id_contact_prescripteur.'%" ';
	$result2=$this->db->fetchRow($requete2);
	$result2['id_ben'];
	
	if($result2['id_ben']==NULL)
	{
	//creer
	
    $data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'cat_id' => $this->cat_id_contact_prescripteur,'id_organisation' =>$result['id_organisation'], 'nom_complet'=> $civilite.' '.$nom.' '.$prenom , 'nom'=> $nom ,'prenom'=> $prenom, 'civilite'=> $civilite ,'email_perso'=> $email_perso, 'email_pro'=> $email_pro,'fax_pro'=> $fax_pro,'tel_pro_1'=> $tel_bureau,'fonction'=> utf8_decode($fonction)) ;
	$this->db->insert($this->table_contact,$data);
	
	$requete2='SELECT id_ben FROM '.$this->table_contact.' order by id_ben desc';
	$result2=$this->db->fetchRow($requete2);
	$result2['id_ben'];
	
	
	}
	
	return $result2['id_ben'];
	
	}
	
	/*function inserer_prescripteur_contact($id_ben,$id_p,$civilite,$nom,$prenom,$tel_bureau,$tel_portable,$email_bureau,$email_domicile,$fonction)
	{
	
	
	$requete='SELECT * FROM  egw_contact_prescripteur  WHERE nom="'.$nom.'" and  id_ben='.$id_ben.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
	$id_contact=$row['id_contact'];
	
	}
	if(isset($id_contact) and $id_contact!=NULL)
	{
	}
	else
	{
	
	$requete = 'insert into egw_contact_prescripteur value ("","'.$id_ben.'","'.$id_p.'","","","'.$civilite.'","'.$nom.'","'.$prenom.'","'.$tel_bureau.'","'.$tel_portable.'","'.$email_bureau.'","'.$email_domicile.'","'.$fonction.'")';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	}*/
	
	/*function ajout_prescripteur($id_beneficiaire,$id_prescripteur)
	{
	
	
	



	//requ�te d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id_beneficiaire.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}
	*/
	/*function link_beneficiaire_employeur($id,$beneficiaire,$employeur)
	{
	
	


 	
	

	$requete2="SELECT * FROM  egw_addressbook  WHERE cat_id=$employeur order by id desc limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_employeur=$row['id'];
	
	}



	//requ�te d'insertion
	$requete3 = "insert into egw_links value ('','addressbook','$id','addressbook','$id_employeur','','','8')";
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}*/
	
	
	function chercher_beneficiaire($mot)
	{
	
	


 	
	
	
		$requete="SELECT nom,prenom,id_ben FROM  ".$this->table_contact." WHERE (nom like '%".$mot."%' or prenom like '%".$mot."%') order by nom asc";
		

	
	$result=$this->db->fetchAll($requete);
	echo'<select style="width:150px;" name="choix">';
	
	for($i=0;$i<count($result);$i++)
	{
	

	

	
	echo ' <option value='.$result[$i]['id_ben'].'>'.utf8_encode($result[$i]['nom']).' '.utf8_encode($result[$i]['prenom']).'</option>';
	
	}
	echo'</select>';
	}
	
	function afficher_prescripteurs($choix,$id_presta)
	{
		
		echo'<hr style="border:1px dashed #CCC" />
<table width="100%">
  <tr  style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; "  ><td width="19%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="14%">Telephone bureau</td><td width="14%">Fax</td><td width="16%">Email</td><td width="7%"></td></tr>';
  
  $requete='select * from '.$this->table_prestation.' where id_presta='.$id_presta.'';
  $result = $this->db->fetchRow($requete);
  
  if($result['id_contact_prescripteur']!=0)
  {
	 
	  $requete2='select * from '.$this->table_contact.' where id_ben='.$result['id_contact_prescripteur'].'';
	  $result2 = $this->db->fetchRow($requete2);
	  
	  	    $nom=$result2['nom'];
			$civilite=$result2['civilite'];
			$prenom=$result2['prenom'];
			$email_bureau=$result2['email_pro'];
			$email_domicile=$result2['email_perso'];
			$tel_bureau=$result2['tel_pro_1'];
			$tel_portable=$result2['fax_pro'];
			$fonction=$result2['fonction'];
		
		  if($result2['id_organisation']!=0)
		  {
	  $requete3='select * from '.$this->table_organisation.' where id_organisation='.$result2['id_organisation'].'';
	  $result3 = $this->db->fetchRow($requete3);
	  
	 	if($tel_bureau==NULL)
		$tel_bureau=$result3['tel'];
		if($tel_portable==NULL)
		$tel_portable=$result3['fax'];
		if($email_bureau==NULL)
		$email_bureau=$result3['email'];
		
		echo'<tr ><td width="19%" height="21"><strong>'.$result3['nom_organisme'].'</strong></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_bureau.'</td><td width="14%">'.$tel_portable.'</td><td width="16%">'.$email_bureau.'</td><td></td></tr>';
		  }
		
	
		
  }
  
  
  else
  {
  

/*		
		$requete="SELECT * FROM  egw_links  WHERE link_id1=$choix";
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
	{
	$link_id2[]=$row['link_id2'];
	}
	

	if(isset($link_id2) and $link_id2!=NULL)
	{
		$r_tableau=NULL;
	for($i=0 ; $i<count($link_id2) ; $i++)
	{
	
		$r_tableau=$r_tableau.' or id='.$link_id2[$i];
	}
	}
	

  
  if(isset($link_id2[0]) and $link_id2[0]!=NULL)
	{
		$requete='SELECT * FROM  egw_addressbook  WHERE (id=0 '.$r_tableau.') and cat_id='.$this->cat_id_prescripteur.' order by org_name desc';
		//echo $requete;
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			$id_pr=$row['id'];
			$fn=$row['fn'];
			$id=$row['id'];
			$tel_cell=$row['tel_cell'];
			$tel_work=$row['tel_work'];
			$tel_fax=$row['tel_fax'];
			$url=$row['url'];
			$email=$row['email'];
		}
			if(isset($id_pr) and $id_pr!=NULL)
			{
			$requete='SELECT * FROM  egw_contact_prescripteur  WHERE id_prescripteur='.$id_pr.' and id_ben='.$choix.'';
			
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$nom=$row['nom'];
			$civilite=$row['civilite'];
			$prenom=$row['prenom'];
			$email_bureau=$row['email_bureau'];
			$email_domicile=$row['email_domicile'];
			$tel_bureau=$row['tel_bureau'];
			$tel_portable=$row['tel_portable'];
			$fonction=$row['fonction'];
		
		}
		if($tel_bureau==NULL)
		$tel_bureau=$tel_work;
		if($tel_portable==NULL)
		$tel_portable=$tel_fax;
		if($email_bureau==NULL)
		$email_bureau=$email;
		echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_bureau.'</td><td width="14%">'.$tel_portable.'</td><td width="16%">'.$email_bureau.'</td><td width="12%">'.$fonction.'</td><td width="7%"> <a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
			else
			{
			echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_work.'</td><td width="14%">'.$tel_cell.'</td><td width="16%">'.$email.'</td><td width="12%">'.$fonction.'</td><td><a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
		
	}
		
	*/	
  }
		echo'</table><br/>';

	}
	function afficher_employeurs($choix)
	{
		

	echo' <img border="0" src="./images/plus_16.png" /> <a href="javascript:void();" onclick="document.getElementById(\'parcours_form\').style.display=\'block\';" >Ajouter un parcours</a><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="8%">Date</td><td width="20%" height="21" class="titre2">Intitule du poste</td><td width="9%" >Service</td><td width="4%" >Statut</td><td width="4%" >Identifiant</td><td width="5%" >Contrat</td><td width="7%" >Contrat aide</td><td width="4%">Type.R</td><td width=8%">Remuneration</td><td width="8%">Qualifiquation</td><td width="3%">T.</td><td width="7%">Deplacement</td><td width="15%">Organisme</td><td ></td><td></td></tr>';

		$requete='SELECT * FROM  '.$this->table_parcours_pro.'  WHERE id_ben='.$choix.'';
		$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
		
		
		
			if($result[$i]['organisme']!=NULL)
			{
			$nbr='('.$this->return_nbr_by_organisme($result[$i]['organisme']).')';
			}
			else
			{
			$nbr=NULL;
			}
			
			if($result[$i]['date_debut']!=0)
			{$dat1=date('d/m/Y',$result[$i]['date_debut']);}
			else
			{$dat1=NULL;}
			
				if($result[$i]['date_fin']!=0)
			{$dat2='-'.date('d/m/Y',$result[$i]['date_fin']);}
			else
			{$dat2=NULL;}
			
			
			if($result[$i]['temps_travail']!=NULL)
			{$heure_t=$result[$i]['temps_travail'].' H';}
			else
			{$heure_t=NULL;}
			
			if($result[$i]['montant_remuneration']!=NULL)
			{
			$montant_num=$result[$i]['montant_remuneration'].' euros';
			}
			else
			{
				$montant_num=NULL;
			}
			$requete='SELECT * FROM  '.$this->table_organisation.'  WHERE nom_organisme = "'.$result[$i]['organisme'].'" limit 1';
			$result2=$this->db->fetchRow($requete);
		
			echo' <tr ><td >'.$dat1.$dat2.'</td><td   class="titre2"><strong>'.utf8_encode($result[$i]['poste']).'</strong></td><td >'.$result[$i]['service'].'</td><td  >'.$result[$i]['statut'].'</td><td  >'.$result[$i]['identifiant'].'</td><td  >'.$result[$i]['type_contrat'].'</td><td  >'.$result[$i]['type_contrat_aide'].'</td><td >'.$result[$i]['type_remuneration'].'</td><td >'.$montant_num.'</td><td >'.$result[$i]['qualification'].'</td><td >'.$heure_t.'</td><td >'.utf8_encode($result[$i]['mobilite']).'</td><td ><a href="javascript::void();" onclick="window.open(\'../../../Organisation1.0/details.php?domain=default&id_organisation='.$result2['id_organisation'].'&nom_organisme='.addslashes(utf8_encode($result[$i]['organisme'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=1024, height=800\');">'.utf8_encode($result[$i]['organisme']).'</a> '.$nbr.'</a></td><td><a href="panel.php?choix='.$choix.'&id_parcours_edit='.$result[$i]['id_parcours'].'#parcours_ancre"><img  title="Modifier" border="0"  src="../images/edit.png" /></a> </td><td><a href="panel.php?choix='.$choix.'&id_parcours_delete='.$result[$i]['id_parcours'].'#parcours_ancre"><img title="Supprimer"  border="0"  src="../images/delete.png" /></a>  </td></tr>';
		
		}
		echo'</table><br/><br/><br/>';
		
		

	}
	
	function liste_prescripteur()
	{
		
		
		
		$requete='SELECT * FROM  egw_addressbook  where cat_id like "%'.$this->cat_id_prescripteur.'%" order by org_name asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			
			echo'<option value='.$org_name.'>'.$org_name.'</option>';
		}
		
		
		
	}
	
	function variable_presta_epce($choix)
	{
		
	
		$requete='SELECT id_presta,intitule,lettre_de_commande,date_debut,date_fin FROM  egw_prestation  where id_ben='.$choix.'';
		//$requete='SELECT * FROM  egw_addressbook  where id=1033';
		$result=$this->db->fetchRow($requete);
	
			$id_epce=$result['id_presta'];
			$lettre_de_commande=$result['lettre_de_commande'];
			$date_debut=$result['date_debut'];
			$date_fin=$result['date_fin'];
			
		
		
		if(isset($id_epce) and $id_epce!=NULL)
		{
		return array($lettre_de_commande,$date_debut,$date_fin);
		}
	}
	function variable_beneficiaire($choix)
	{
		
	
		$requete='SELECT * FROM  '.$this->table_contact.'  where id_ben='.$choix.'';
		$result=$this->db->fetchRow($requete);
		
		
		return array(utf8_encode($result['nom_complet']),utf8_encode($result['nom']),utf8_encode($result['prenom']),utf8_encode($result['deuxieme_prenom']),utf8_encode($result['nom_jeune_fille']),$result['civilite'],$result['organisation'],$result['fonction'],utf8_encode($result['adresse_ligne_1']),utf8_encode($result['adresse_ligne_2']),utf8_encode($result['adresse_ligne_3']),$result['ville'],$result['region'],$result['cp'],$result['pays'],$result['tel_pro_1'],$result['tel_pro_2'],$result['tel_domicile_1'],$result['tel_domicile_2'],$result['fax_pro'],$result['fax_perso'],$result['portable_pro'],$result['portable_perso'],$result['email_pro'],$result['email_perso'],$result['site_perso']);
		
		
		
	}
	
	function selectionner_rdv_plan($id_presta,$choix)
	{
	
	
	  echo'
<table style="border:1px dotted #CCC">
  <tr  style="font-weight:bolder" ><td width="300px"  class="titre2">Entretient / objectif</td><td >Date de prevu</td><td >heure</td></tr>';
		$requete='SELECT * FROM  apsie_jqcalendar  where id_presta='.$id_presta.' and cal_status!="R"';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['Id'];
		
		
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req=$req.' or cal_id='.$cal_id[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' )  order by cal_id desc';
	//echo $requete;
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id2[]=$row['cal_id'];
		
		}
		for ($i=0;$i<count($cal_id2);$i++)
		{
		$req2=$req2.' or Id='.$cal_id2[$i];
		}
		$requete2='SELECT * FROM  apsie_jqcalendar where Id=0 '.$req2.' order by StartTime asc limit 4';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		$tour=mysql_num_rows($resultat2);
		$c=1;
		$n=1;
		while($row = mysql_fetch_array($resultat2))
		{
		
			$cal_end=$row['EndTime'];
			$cal_start=$row['StartTime'];
			$cal_end_=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			//$cal_start_=date('d/m/Y | H\h i\m\i\n ', $cal_start);
			$cal_start_=date('d/m/Y', $cal_start);
			$heure_start_=date('H', $cal_start);
	
		
		if($tour==1)
		{
			if($c==1)
		$inti='Adequation personne / projet';
		}
		
		elseif($tour==2)
		{
				if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		}
		elseif($tour==3)
		{
				if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		if($c==3)
		$inti='Evaluation financiere du projet';
		}
		
		elseif($tour==4)
		{
		if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		if($c==3)
		$inti='Evaluation financiere du projet';
		if($c==4)
		$inti='Evaluation juridique';
		}
		
		
	
		echo'<tr><td width="200px" style="color:#059610">'.$inti.'</td><td>'.$cal_start_.'</td><td>'.$heure_start_.'h</td></tr>';
		
		
			$n++;	
		$c++;	
	
		}
		
		echo'</table>';
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
	}
	function nbre_rdv_plan($id_presta,$choix)
	{
	
	
	
		$requete='SELECT * FROM  apsie_jqcalendar where id_presta='.$id_presta.' and cal_status!="R"';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['Id'];
		
		
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req=$req.' or cal_id='.$cal_id[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' )  order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
		
		return mysql_num_rows($resultat);
		
	}
	
	
	function selectionner_prestation($choix,$id_projet)
	{
	
	
	  echo'<a name="presta" id="presta"></a><strong>Ses prestations</strong>  <hr style="border:1px dashed #CCC" />
<table width=100%>
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="200px" height="21" class="titre2">Prestation</td><td width="200px" >ID_Prestation</td><td width="200px">Conseiller</td><td width="200px">Date de debut</td><td width="200px">Date de fin</td><td width="200px">Lieu</td><td width="100px">Statut</td><td width="20px" ></td><td width="100px" ></td></tr>';
		
		$requete='SELECT * FROM  egw_prestation  where id_ben="'.$choix.'" and id_projet="'.$id_projet.'" order by date_debut desc';
	$result=$this->db->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
			
			
			
		
		
		
	
	
		if($result[$i]['date_debut']==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$result[$i]['date_debut']);
		
	}
	
	if($result[$i]['date_fin']==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$result[$i]['date_fin']);
		
	}
	

	
	if($result[$i]['presta']=="EPCE")
	{
	$type="LC_";
	}
		
		echo'<tr ><td  height="21">'.$result[$i]['presta'].'</td><td ><a href="panel.php?domain=default&choix='.$choix.'&id_presta='.$result[$i]['id_presta'].'&lc='.$result[$i]['lettre_de_commande'].'&display_eval=block&type_presta='.$result[$i]['presta'].'">'.$type.$result[$i]['lettre_de_commande'].'</a></td><td >'.$this->get_conseiller($result[$i]['id_ref']).'</td><td >'.$dat_1.'</td><td >'.$dat_2.'</td><td >'.$this->rdv_lieu($result[$i]['id_presta']).'</td><td>'.$result[$i]['statut'].'</td><td></td><td><input type="button" value="Relancer" onclick="window.open(\'../../epce/relance/suivi.php?id_presta='.$result[$i]['id_presta'].'&id_ben='.$choix.'\',\'SUIVI DES RELANCES\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0,  width=1280, height=728\');" /></td></tr>';
		
		//
		
		}
		echo'</table><br/><br/>';
		
	}
		function selectionner_rdv_grise($id_presta,$choix)
	{
	



	  echo'<center><font size=+1>RDV non lie(s) a cette prestation</font></center><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="19%" height="21" class="titre2">Intitule du rendez-vous</td><td width="18%" >Date de debut</td><td width="17%">Date de fin</td><td width="17%">Lieu</td><td width="12%">Participants</td><td width="5%">Statut</td><td  width="10%">
  </td></tr>';
		$retour=$this->variable_beneficiaire($choix);
		$requete='SELECT * from apsie_jqcalendar where Subject like "%'.$retour[1].' '.$retour[2].'%" and  id_presta!='.$id_presta.' and id_presta=0 order by Id asc ';
		//echo $requete;
			$resultat=$this->db->fetchAll($requete);
			$nbreLignes = count($resultat);
		
		for($i=0;$i<count($resultat);$i++)
		{
			$cal_id[]=$resultat[$i]['Id'];
		
	 		$cal_status=$resultat[$i]['cal_status'];
			$cal_title[]=$resultat[$i]['Subject'];
			$cal_category[]=$resultat[$i]['id_lieu'];
			$cal_end=$resultat[$i]['EndTime'];
			$cal_start=$resultat[$i]['StartTime'];
			$cal_end_=date('w/d/n/Y', $cal_end);
			$cal_start_=date('w/d/n/Y', $cal_start);
         
			$cal_end_=$this->date_fr($cal_end_);
			$cal_start_=$this->date_fr($cal_start_);
		   $cal_end_m=date('- H\h i\m\i\n', $cal_end);
			$cal_start_m=date('- H\h i\m\i\n', $cal_start);
			
			
		}
		
		for($z=0;$z<count($cal_id);$z++)
		{
			if($cal_category[$z]!=NULL)
			{
				$requete4='SELECT nom_lieu FROM  apsie_lieu  where id_lieu = '.$cal_category[$z].' ';
				//echo $requete4;
		$resultat=$this->db->fetchAll($requete4);
		for($i=0;$i<count($resultat);$i++)
		{
			$cat_name=$resultat[$i]['nom_lieu'];
			
		
			
		}
			}
				$requete4='SELECT cal_user_id  FROM  egw_cal_user  where cal_id = '.$cal_id[$z].' ';
				
		$resultat=$this->db->fetchAll($requete4);
		for($i=0;$i<count($resultat);$i++)
		{
			$cal_user_id=$resultat[$i]['cal_user_id'];
		   
				$requete6='SELECT * FROM  apsie_comptes  where account_id='.$cal_user_id.' ';
		$resultat=$this->db->fetchAll($requete6);
		for($i=0;$i<count($resultat);$i++)
		{
			$account_firstname=$resultat[$i]['account_firstname'];
			$account_lastname=$resultat[$i]['account_lastname'];
			
		}
			
		}
		
			
		echo'<form action="panel.php" method="get"><tr><td>'.$cal_title[$z].'</td><td width="18%" >'.utf8_encode($cal_start_).' '.utf8_encode($cal_start_m).' </td><td width="17%">'.utf8_encode($cal_end_).' '.utf8_encode($cal_end_m).'</td><td width="17%"><font color="#FF3300">';
		
		 $val=explode("_",$cat_name);
		 if($cal_category[$z]!=NULL)
		 echo $val[2];
		
		
		
		
		
		echo'</font></td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td>'.$cal_status.'</td><td><input type="hidden" name="id_rdv" value="'.$cal_id[$z].'" /><input type="hidden" name="choix" value="'.$choix.'" /><input type="hidden" name="id_presta" value="'.$id_presta.'" /><input type="hidden" name="cal_status" value="'.$cal_status.'" /><input type="hidden" name="display_eval" value="block" /><input type="submit" value="Lier a cette prestation" name="lier" /></td></tr></form>';
			
		}
		
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
		
		
		
		
		
		
		////
			
		/*for($i=0;$i<$boucle;$i++)
		{
			$cal_start=$cal_start+604800;
			$cal_end=$cal_end+604800;
			
			
			$cal_dernier=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			$cal_premier=date('d/m/Y | H\h i\m\i\n ', $cal_start);
	echo'<tr style="color: #999"><td>'.$cal_title.'</td><td width="18%" >'.$cal_premier.'</td><td width="17%">'.$cal_dernier.'</td><td width="17%">'.$cat_name.'</td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="checkbox" /></td></tr>';
	
		}*/
		
		
		echo'</table><br/><br/><br/>';
		}
	function selectionner_rdv($id_presta,$choix,$id_employee='')
	{
	//<a  href="../pose_rdv.php?id_presta='.$id_presta.'&choix='.$choix.'">Nouveau rendez-vous</a>
	
	  echo'<a name="rdv" id="rdv"></a><center><font size=+1>RDV de la prestation</font><br/> </center><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="19%" height="21" class="titre2">Intitule du rendez-vous</td><td width="18%" >Date de debut</td><td width="17%">Date de fin</td><td width="8%">Lieu</td><td width="12%">Participants</td><td width="5%">Statut</td><td width="8%">Compte rendu</td><td  width="10%"></td></tr>';
		
		$requete='SELECT * from apsie_jqcalendar where id_presta='.$id_presta.' order by Id asc ';
		//echo $requete;
		$resultat=$this->db->fetchAll($requete);
		
		
		$nbreLignes = count($resultat);
		for($i=0;$i<count($resultat);$i++)
		{
			$cal_id[]=$resultat[$i]['Id'];
		
		$cal_status[]=$resultat[$i]['cal_status'];
			$cal_title[]=$resultat[$i]['Subject'];
			$cal_category[]=$resultat[$i]['id_lieu'];
			
			
		}
		
		for($z=0;$z<count($cal_id);$z++)
		{
			if($cal_category[$z]!=NULL)
			{
				$requete4='SELECT nom_lieu FROM  apsie_lieu  where id_lieu ="'.$cal_category[$z].'" ';
				
		$resultat=$this->db->fetchAll($requete4);
			for($i=0;$i<count($resultat);$i++)
		{
			$cat_name=$resultat[$i]['nom_lieu'];
		
			
		}
		
			}
				$requete4='SELECT cal_user_id FROM  egw_cal_user  where cal_id ='.$cal_id[$z].'';
			
			$resultat=$this->db->fetchAll($requete4);
		
		for($i=0;$i<count($resultat);$i++)
		{
			$cal_user_id=$resultat[$i]['cal_user_id'];
		    
				$requete6='SELECT * FROM  apsie_comptes  where account_id='.$cal_user_id.' ';
		$resultat=$this->db->fetchAll($requete6);
		for($i=0;$i<count($resultat);$i++)
		{
			$account_firstname=$resultat[$i]['account_firstname'];
			$account_lastname=$resultat[$i]['account_lastname'];
			
		}
			
		}
		
				$requete4='SELECT  * FROM  apsie_jqcalendar  where Id = '.$cal_id[$z].' order by StartTime asc ';
				
		$resultat=$this->db->fetchAll($requete4);
		for($i=0;$i<count($resultat);$i++)
		{
			$cal_end=$resultat[$i]['EndTime'];
			$cal_start=$resultat[$i]['StartTime'];
			$cal_end_=date('w/d/n/Y', $cal_end);
			$cal_start_=date('w/d/n/Y', $cal_start);
         
			$cal_end_=$this->date_fr($cal_end_);
			$cal_start_=$this->date_fr($cal_start_);
		   $cal_end_m=date('- H:i', $cal_end);
			$cal_start_m=date('- H:i', $cal_start);
	
			
		}
		
			$requete5='SELECT id_compte_rendu FROM  egw_compte_rendu  where cal_id ='.$cal_id[$z].' limit 1';
			//echo $requete5;
			$resultat5=$this->db->fetchRow($requete5);
	
		echo'<form action="panel.php" method="get"><tr><td>'.$cal_title[$z].'</td><td width="18%" >'.utf8_encode($cal_start_).' '.utf8_encode($cal_start_m).'</td><td width="17%">'.utf8_encode($cal_end_).' '.utf8_encode($cal_end_m).'</td><td width="17%"><font color="#FF3300">';
		
		
		 echo $cat_name;
		
		if($resultat5['id_compte_rendu']!=NULL)
		{

			$compte_rendu='<a href="../../../index.php?page=impression_compte_rendu&noHeader=1&noTemplate=1&cal_id='.$cal_id[$z].'&id_employee='.$id_employee.'&id_projet='.$this->get_id_projet($id_presta).'&id_presta='.$id_presta.'&id_ben='.$choix.'&id_compte_rendu='.$resultat5['id_compte_rendu'].'"><img title="Edition du compte rendu" border="0" src="../images/icons/page_white_word.png" /></a>';
		}
			
			elseif($resultat5['id_compte_rendu']==NULL and $cal_status!='R')
			{$compte_rendu='<a onclick="window.open(\'../../../index.php?page=Compte_Rendu&header=0&noHeader=1&noTempate=1&cal_id='.$cal_id[$z].'&id_employee='.$id_employee.'&id_projet='.$this->get_id_projet($id_presta).'&id_presta='.$id_presta.'&id_ben='.$choix.'\', \'Compte rendu\', \'left=0,top=0,width=1200,height=600,scrollbars=1\')" href="javascript::void()" ><img title="Redaction du compte rendu" border="0" src="../images/icons/page_white_paintbrush.png" /></a>';}
		
		else
		{
			$compte_rendu=NULL;
		}
		
		echo'</font></td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="hidden" name="id_presta" value="'.$id_presta.'" /><input type="hidden" name="display_eval" value="block" /><input type="hidden" name="id_rdv" value="'.$cal_id[$z].'" /><input type="hidden" name="choix" value="'.$choix.'" /><select onchange="submit()" name="cal_status" style="width:40px;"><option>'.$cal_status[$z].'</option><option value="A">A</option><option value="R">R</option><option value="P">P</option></select></td><td align="center">'.$compte_rendu.'</td><td><a href="panel.php?choix='.$choix.'&id_presta='.$id_presta.'&display_eval=block&id_rdv_unlink='.$cal_id[$z].'" ><img border="0" title="Ne pas lier ce rdv a cette prestation" src="../images/icons/disconnect.png"  /></a></td></tr></form>';
			
	
		}
		
		
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
		
		
		
		
		
		
		////
			
		/*for($i=0;$i<$boucle;$i++)
		{
			$cal_start=$cal_start+604800;
			$cal_end=$cal_end+604800;
			
			
			$cal_dernier=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			$cal_premier=date('d/m/Y | H\h i\m\i\n ', $cal_start);
	echo'<tr style="color: #999"><td>'.$cal_title.'</td><td width="18%" >'.$cal_premier.'</td><td width="17%">'.$cal_dernier.'</td><td width="17%">'.$cat_name.'</td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="checkbox" /></td></tr>';
	
		}*/
		
		
		echo'</table><br/>';
	}
	
	function get_id_projet($id_presta)
	{
		$requete='SELECT id_projet FROM egw_prestation where id_presta ='.$id_presta.' limit 1 ';
		
		$result=$GLOBALS['db']->fetchRow($requete);
		return $result['id_projet'];
	}
	
	function delete($id_p,$id_ben)
	{
		
	
	
 	
	

	$requete2="Delete FROM  egw_links  WHERE link_id2=$id_p and link_id1=$id_ben and link_app1='addressbook' and link_app2='addressbook' ";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	
	}
	function liste_option($choix)
	{
		echo '<div align="center"><form><table style="border:1px solid #999"><tr bgcolor="#E6E6E6"><td style="border-right:1px solid #CCC">Intitule </td><td style="border-right:1px solid #CCC">Date de debut</td><td style="border-right:1px solid #CCC">Date de fin</td><td ></td></tr>';
		$requete='SELECT * FROM  apsie_jqcalendar  where cal_title like "%Option%"';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			$cal_title[]=$row['cal_title'];
		}
		
		
	
	
	$taille = count($cal_id);
	
	for($i=0 ; $i<$taille ; $i++)
	{
	
			
			$requete='SELECT * FROM  apsie_jqcalendar_dates  where cal_id='.$cal_id[$i].' order by cal_id desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
			
			echo '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$cal_title[$i].'</font> </td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input type="checkbox" /></td></tr>';
			
	}
	 
			
		
			
		}
		
		echo'</table><br/><input type="submit" value="Valider"> <a href="../index.php?page=presentation&domain=default&choix='.$choix.'">Retour</a></form></div>';
	}
	
	
	function liste_confirmation_option($lieu,$date_inscription,$conseiller_id)
	{
		
		
		
	 $date_string = explode('/', $date_inscription);
	

	$timestamp = mktime(0, 0, 0, $date_string[1], $date_string[2], $date_string[0]);

	
	if($conseiller_id!=NULL)
	{
		$requete='SELECT * FROM  apsie_comptes  WHERE account_id='.$conseiller_id.'';
 	$result=$this->db->fetchRow($requete);
	
 	$conseiller_id=$result['account_id'];
   $account_firstname=$result['account_firstname'];
   $account_lastname=$result['account_lastname'];
	
	}
	else
	{
	$account_firstname='Tous';
	$account_lastname=' les conseillers';
	}
		
		
	echo '<div align="center"><form action="../presentation/nouveau_beneficiaire.php" method="get"><table><tr><td><input type="hidden" name="conseiller_id" value="'.$conseiller_id.'"/><input type="hidden" name="option_ben" value="nouveau"/><strong>Confirmer les options de <font color=red>'.$account_firstname.' '.$account_lastname.'</font> a partir du '.$date_inscription.' </strong> </td></tr></table><br/>
		<table style="border:1px solid #999"><tr bgcolor="#E6E6E6"><td style="border-right:1px solid #CCC">Intitule </td><td style="border-right:1px solid #CCC">Conseiller</td><td style="border-right:1px solid #CCC">Date de debut</td><td style="border-right:1px solid #CCC">Date de fin</td><td ></td></tr>';
		
		
	
		
		
		if($lieu==1)
		{
			 if($conseiller_id!=NULL)
 				{
	
				$requete4='SELECT apsie_jqcalendar_user.cal_id,apsie_jqcalendar.cal_id,apsie_jqcalendar.cal_title,apsie_jqcalendar_user.cal_user_id FROM  apsie_jqcalendar,apsie_jqcalendar_user where apsie_jqcalendar_user.cal_id=apsie_jqcalendar.cal_id and cal_title like "%Option%"  and cal_user_id='.$conseiller_id.' order by apsie_jqcalendar.cal_id desc';
				
				}
				else
				{
				$requete4='SELECT apsie_jqcalendar_user.cal_id,apsie_jqcalendar.cal_id,apsie_jqcalendar.cal_title,apsie_jqcalendar_user.cal_user_id FROM  apsie_jqcalendar,apsie_jqcalendar_user  where cal_title like "%Option%" and apsie_jqcalendar_user.cal_id=apsie_jqcalendar.cal_id order by apsie_jqcalendar.cal_id desc ';
				}
		
		}
		else
		{
			
			 if($conseiller_id!=NULL)
 				{
					$requete4='SELECT apsie_jqcalendar_user.cal_id,apsie_jqcalendar.cal_id,apsie_jqcalendar.cal_title,apsie_jqcalendar_user.cal_user_id FROM  apsie_jqcalendar,apsie_jqcalendar_user where apsie_jqcalendar_user.cal_id=apsie_jqcalendar.cal_id and cal_title like "%Option_'.$lieu.'"  and cal_user_id='.$conseiller_id.' order by apsie_jqcalendar.cal_id desc';
		
				}
				else
				{
				$requete4='SELECT apsie_jqcalendar_user.cal_id,apsie_jqcalendar.cal_id,apsie_jqcalendar.cal_title,apsie_jqcalendar_user.cal_user_id FROM  apsie_jqcalendar,apsie_jqcalendar_user  where cal_title like "%Option_'.$lieu.'" and apsie_jqcalendar_user.cal_id=apsie_jqcalendar.cal_id order by apsie_jqcalendar.cal_id desc';
				}
		}
	
	$result4=$this->db->fetchAll($requete4);
	//echo count($result4);
		for($i=0;$i<count($result4);$i++)
		{
			$cal_id[]=$result4[$i]['cal_id'];
			$cal_title[]=$result4[$i]['cal_title'];
			//$cal_owner[]=$row['cal_owner'];
			$cal_user_id[]=$result4[$i]['cal_user_id'];
			
		}
		
		
	
	
	
	/*$nb=0;
	for($i=0 ; $i<count($cal_id) ; $i++)
	{
	$nb++;
			
			
 
  

	
	$account_firstname=$result5['account_firstname'];	
	   $account_lastname=$result5['account_lastname'];	
		
		$v[]=$result5['account_id'];
	

	
	}*/
	
	for($i=0;$i<count($cal_id);$i++)
		{
			$req = $req.' or cal_id='.$cal_id[$i];
		}
			$requete6='SELECT * FROM  '.$this->table_cal_dates.'  where (cal_id=0 '.$req.' ) and cal_start >'.$timestamp.' order by cal_start desc';
			

	
			$result6=$this->db->fetchAll($requete6);
			
				for($i=0;$i<count($result6);$i++)
		{
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $result6[$i]['cal_end']);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $result6[$i]['cal_start']);
			
			
			
			$requete7='SELECT * FROM '.$this->table_cal.'  WHERE cal_id='. $result6[$i]['cal_id'].' limit 1';
			$result7=$this->db->fetchRow($requete7);
			
			$requete8='SELECT * FROM '.$this->table_cal_user.'  WHERE cal_id='. $result6[$i]['cal_id'].' limit 1';
			$result8=$this->db->fetchRow($requete8);
			
			$requete5='SELECT * FROM  apsie_comptes  WHERE account_id='.$result8['cal_user_id'].' limit 1';
			$result5=$this->db->fetchRow($requete5);
			$prestation = explode("_",$result7['cal_title']);
			
			echo '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$result7['cal_title'].'</font> </td><td style="border-right:1px solid #CCC">'.$result5['account_firstname'].' '.$result5['account_lastname'].'</td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input name="option[]" type="radio" value="'.$result6[$i]['cal_id'].'-'.$result5['account_id'].'-'.$result6[$i]['cal_start'].'-'.$result5['account_firstname'].' '.$result5['account_lastname'].'-'.$prestation[1].'" /></td></tr>';
		
		
	
		}
			
		
			
	
		
		echo'</table><br/><input type="submit" value="Confirmer l\'option"></form></div>';
	}
	

	function link_beneficiaire_calendar($id_recup,$opt,$nb,$n_given,$n_family,$tel_work,$tel_cell,$lc,$pole_id,$nom_p,$prenom_p,$tel_home,$code_safir,$tel_contact,$tel_contact2,$date_deb,$id_presta,$presta_name)
	{
		

		
		$requete='SELECT * FROM '.$this->table_cal.'  where Id='.$opt.'';
		
		$result=$this->db->fetchRow($requete);
		
			$id_lieu=$result['id_lieu'];
			$id_cal_cat=$result['id_cal_cat'];
			$ti[0]=date('Y',$result['StartTime']).date('m',$result['StartTime']);
			
		
			
		
			$requete2='SELECT * FROM apsie_lieu WHERE id_lieu='.$id_lieu;
	
		$result2=$this->db->fetchRow($requete2);	
			
		$requete4='SELECT nom_dispositif as cal_cat_name FROM egw_dispositif WHERE id_dispositif='.$id_cal_cat;
	
		$result4=$this->db->fetchRow($requete4);
		
		
		
		$requete3='SELECT * FROM  apsie_jqcalendar  where Id='.$opt.'';
		$result3=$this->db->fetchRow($requete3);
		
		
		
		if($code_safir!=NULL)
		{$pol=$this->pole_emploi($code_safir);}
		else
		{$pol="?";}
		
		if($tel_contact==NULL)
		$tel_contact=$pol[1];
		
		if($tel_contact2==NULL)
		$tel_contact2=$pol[2];
		
		if($lc==NULL)
		$lc="?";
		
		if($result4['cal_cat_name']==NULL)
		{
			$result4['cal_cat_name'] = $presta_name;
		}
		$data = array ('id_presta'=>$id_presta , 'Description'=>' 
Tel Bureau : '.$tel_work.'
Tel portable : '.$tel_cell.' 
Tel Prive : '.$tel_home.'
					   
'.$code_safir.'_'.$pol[0].'
LC N  '.$lc.' 
ID. '.$pole_id.'
Prescripteur : '.$nom_p.' '.$prenom_p.'
T.'.$tel_contact.'
F.'.$tel_contact2.' 
					   
Lieu : '.$result2['adresse_lieu'].' '.$result2['cp_lieu'].' '.$result2['ville_lieu'].'
Prestation debut : '.date('d/m/Y H:i',$result3['StartTime']).'' ,'Subject'=>$ti[0].'_'.$result4['cal_cat_name'].'_'.$n_family.' '.$n_given);

$this->db->update($this->table_cal,$data,'Id='.$opt.'');
$dataC = array('id_contact'=>$id_recup,"cal_id"=>$opt,'id_presta'=>$id_presta);
$this->db->insert("apsie_cal_contact",$dataC);

/*
		$requete2='Update apsie_jqcalendar set id_presta='.$id_presta.',cal_description=" Tel Bureau : '.$tel_work.'\n Tel portable : '.$tel_cell.' \n Tel Priv� : '.$tel_home.'\n \n P�le emploi '.$code_safir.'_'.$pol[0].'\n LC N� '.$lc.' \n ID. '.$pole_id.'
\r Prescripteur : '.$nom_p.' '.$prenom_p.'\n T.'.$tel_contact.' \n F.'.$tel_contact2.' \n\n Lieu : '.$result2['adresse_ligne_1'].' '.$result2['cp'].' '.$result2['ville'].'\n Prestation debut : '.date('d/m/Y � H:i',$result3['cal_start']).'",cal_title="'.$ti[0].'_'.$ti[1].'_'.$n_family.' '.$n_given.'" where cal_id='.$opt.'';
		$resultat2= mysql_query($requete2) or die(mysql_error());*/
		
		
	}
		
			function link_beneficiaire_option($id_beneficiaire,$nb,$opt)
	{
		

		
		if($opt==NULL)
		{}
		else
		{
		
		$requete3='SELECT * FROM  apsie_jqcalendar  where cal_id='.$opt.'';
		  $result3=$this->db->fetchRow($requete3);
		
			$cal_title=$result3['cal_title'];
			$ti = explode("_", $cal_title);
			$ti[0];
			$ti[1];
		
		}
		
	
		$requete4='SELECT * FROM  '.$this->table_contact.'  where id_ben='.$id_beneficiaire.'';
	  $result4=$this->db->fetchRow($requete4);
		
			$n_family=$result4['n_family'];
			$n_given=$result4['n_given'];
			
			
		
		
		if($opt[$i]==NULL)
		{}
		else
		{
		
		
		$data = array("cal_title"=>$ti[0].'_'.$ti[1].'_'.$n_family.' '.$n_given);
		$this->update($this->table_cal,$data,'cal_id='.$opt.'');
		
		}
		
		
	
		
	}
	
	function selectionner_lieu()
	{
		echo'<select name="lieu"><option value="">Choisir un lieu</option>';
		$requete3='SELECT * FROM  apsie_jqcalendar  order by cal_location asc';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$cal_location=$row['cal_location'];
			echo'<option value='.$cal_location.'>'.$cal_location.'</option>';
			
		}
	echo'</select>';
	
	}
	
	function selectionner_conseiller($conseiller,$id='')
	{
		
		echo'<select style="width:120px"  name="conseiller_id">';
		if($conseiller!=NULL)
		{
		
		echo'<option value='.$id.'>'.$conseiller.'</option>';
		}
		else
		{	echo'<option value=""></option>';}
		
	
			
		
	$actif = "AND account_status='A'";
	
	$requete="SELECT *  FROM apsie_comptes C 
	where  C.account_type = 'u' ".$actif." ORDER BY account_firstname asc";		
	$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
			
		
			
			echo'<option value='.$result[$i]['account_id'].'>'.$result[$i]['account_firstname'].' '.$result[$i]['account_lastname'].'</option>';
			
		}
		
		echo'</select>';
	}
	
	function selectionner_conseiller2()
	{
		
		echo'<select name="conseiller_id"><option value="">Tous les conseillers</option>';
		
		
		
		$requete='SELECT * FROM  apsie_comptes  where account_id>5 and account_status="A" and account_type="u" and (account_primary_group='.$this->id_group_apsie.' or account_primary_group='.$this->id_group_stragefi.')   order by account_firstname asc';
		$resultat=$this->db->fetchAll($requete);
		
		
		for($i=0;$i<count($resultat);$i++)
		{
			
			$account_firstname=$resultat[$i]['account_firstname'];
			$account_lastname=$resultat[$i]['account_lastname'];
		    $account_id=$resultat[$i]['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		echo'</select>';
	}
	

	function selectionner_option($date_debut,$duree,$planification)
	{
		
		$requete='SELECT * FROM  apsie_jqcalendar_dates  where cal_id='.$cal_id[$i].' order by cal_start desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
		}
		
	}
	
function chercher_options($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nombre,$jour)
	{
		
		
	$requete='SELECT account_firstname,account_lastname FROM  apsie_comptes where account_id='.$conseiller_id.'';
    $result=$this->db->fetchRow($requete);

		
		
		$z=1;
		/*$conseiller_id=9;
		$plage1=8;
		$plage2=17;
		$selection=1;
		$date_choisi = "2010/03/3";*/
		$chosi=explode('/',$date_choisi);
		
		$base= mktime(0,0,0,$chosi[1],$chosi[2],$chosi[0]);
		
		
		echo'<hr /><form name="test" action="poser.php" method="get"><table><tr><td><font color=red>'.$result['account_firstname'].' '.$result['account_lastname'].' </font>pour prestations</td><td><select name="prestation"> <option value="EPC93">EPC93</option><option value="EPC94">EPC94</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="BCF">BCF</option><option value="EPI_BP">EPI_BP</option><option value="VAE">VAE</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$result['account_firstname'].' '.$result['account_lastname'].'" /></td></tr></table>';
		
		
		$requete2='SELECT cal_id FROM  apsie_jqcalendar_user where cal_user_id='.$conseiller_id.'';
	    $result2=$this->db->fetchAll($requete2);
		
		
		
		if(isset($result2[0]['cal_id']) and $result2[0]['cal_id']!=NULL)
		{
			$req=NULL;
				
				for ($i=0;$i<count($result2);$i++)

		{

		$req=$req.' or cal_id='.$result2[$i]['cal_id'];

		}
		
		}
		
		
		
		$requete3='SELECT cal_end,cal_start FROM  apsie_jqcalendar_dates  where (cal_start>'.$base.') and (cal_id=0 '.$req.')   order by cal_start desc';
		
		
   $result3=$this->db->fetchAll($requete3);
		
		for($z=0;$z<count($result3);$z++)
		{
		$cal_start[]=$result3[$z]['cal_start'];
		$cal_end[]=$result3[$z]['cal_end'];
		
		}
		
		for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			
		
			
		
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
		$d1=array_diff($time1,$cal_start);
		$d2=array_diff($time2,$cal_end);
		}
		if(isset($time16))
		{
		$d16=array_diff($time16,$cal_start);
		$d26=array_diff($time26,$cal_end);
		}
	
	if($jour!=6)
	{
foreach($d1 as $maCle=>$maValeur)
{
	if(date('H',$time1[$maCle])!=13)
	{
	
	
   echo '<table ><tr><td width="100">'.$_j[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time1[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time2[$maCle]).'</td><td ><input name="pose[]" value="'.$time1[$maCle].'-'.$time2[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z==$nombre)
	{
		break;
	}
	$z++;
}


	}
				
			
else
{
	
	foreach($d16 as $maCle=>$maValeur)
{
	if(date('H',$time16[$maCle])!=13)
	{
	
   echo '<table ><tr><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z==$nombre)
	{
		break;
	}
	$z++;
}


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
	echo '<a  onclick="javascript:Check_all(true);">Tout cocher</a> | <a onclick="javascript:Check_all(false);">Tout decocher</a> <input type="submit" value="Poser" /></form>';
	
	
	}
	
	// chercher rdv conseiller
	
	function chercher_rdv($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nombre,$jour,$choix,$intervalle)
	{
		
	if($selection==NULL)
		$selection=28;
		//$retour=$this->variable_beneficiaire($choix);
		/*
				$requete='SELECT account_firstname,account_lastname FROM  apsie_comptes where account_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
			
			
		}
		*/
		
		$z=1;
		/*$conseiller_id=9;
		$plage1=8;
		$plage2=17;
		$selection=1;
		$date_choisi = "2010/03/3";*/
		$chosi=explode('/',$date_choisi);
		
		$base= mktime(0,0,0,$chosi[1],$chosi[0],$chosi[2]) + $intervalle;
		
		
		
	/*	echo'<hr /><form name="test" action="poser_rdv.php" method="get"><table><tr><td><font color=red>'.$account_firstname.' '. $account_lastname.' </font>pour prestations</td><td><select name="prestation"><option value="OPCRE77">OPCRE77</option><option value="EPCE77">EPCE77</option><option value="OEM77">OEM77</option><option value="OEM94">OEM94</option><option value="TVE77">TVE77</option><option value="CAP77">CAP77</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="BC">BC</option><option value="VAE">VAE</option><option value="EPI_BP">EPI_BP</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$account_firstname.' '.$account_lastname.'" /></td></tr></table>';*/
		
				$requete='SELECT cal_id FROM  egw_cal_user where cal_user_id='.$conseiller_id.'';
		$result = $this->db->fetchAll($requete);
		
		
			for($i=0;$i<count($result);$i++)
			{
			$cal_id[]=$result[$i]['cal_id'];
			}
			
			
			
		
		
		if(isset($cal_id[0]) and $cal_id[0]!=NULL)
		{
			$req=NULL;
				
				for ($i=0;$i<count($cal_id);$i++)

		{

		$req=$req.' or Id='.$cal_id[$i];

		}
		
		
		$requete='SELECT EndTime,StartTime FROM  apsie_jqcalendar  where (StartTime>'.$base.') and (Id=0 '.$req.')   order by Id desc';
		
		
	
		
	$resultat = $this->db->fetchAll($requete);
	
		$j=count($resultat);
	
		for($i=0;$i<count($resultat);$i++)
		{
			
			$cal_end[]=$resultat[$i]['EndTime'];
			$cal_start[]=$resultat[$i]['StartTime'];
			/*$cal_e[]=date(' d/m/Y | H:00', $cal_end);
			$cal_s[]=date(' d/m/Y | H:00', $cal_start);*/
			
			
		}
		
		
		for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			
	
			
		
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
		$d1=array_diff($time1,$cal_start);
		$d2=array_diff($time2,$cal_end);
		}
		if(isset($time16))
		{
		$d16=array_diff($time16,$cal_start);
		$d26=array_diff($time26,$cal_end);
		}
		if($jour!=6)
	{
		echo'<br/><strong><font color="#FF0000">SEMAINE 1</font></strong>';
		$semaine=2;
foreach($d1 as $maCle=>$maValeur)
{
	if(date('H',$time1[$maCle])!=13)
	{
	$x++;
	if(date('d',$time1[$maCle])==($day+7) or date('m',$time1[$maCle])==($month+1) )
	{
	echo'<br/><strong><font color="#FF0000">SEMAINE '.$semaine.'</font></strong>';
	$semaine++;
	}
	
   echo '<table bgcolor="#F2F2F2"  ><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.$_j[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time1[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time2[$maCle]).'</td><td ><input name="pose[]" value="'.$time1[$maCle].'-'.$time2[$maCle].'" type="checkbox" /><input type="hidden" name="date_choisi[]" value="'.date('d/m/Y',$time1[$maCle]).'" </td></tr></table>';
  $day =date('d',$time1[$maCle]);
   $month =date('m',$time1[$maCle]);
	}
	if($z>$nombre)
	{
		break;
	}
	$z++;
}


	}
				
			
else
{
	
	foreach($d16 as $maCle=>$maValeur)
{
	if(date('H',$time16[$maCle])!=13)
	{
	$x++;
	
   echo '<table ><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr></table>';
 
	
	}
	 

/*	if($z>$nombre)
	{
		break;
	}
	$z++;*/
}
	

}	
		
			
				
			}
			
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
			}
	//echo '<a  onclick="javascript:Check_all(true);">Tout cocher</a> | <a onclick="javascript:Check_all(false);">Tout decocher</a> <input type="submit" value="Poser" /></form>';
	
	}
	
	function inserer_cal_dates($id,$cal_start, $cal_end)
	{
		
    $data = array('Id' => $id , 'StartTime'=> $cal_start , 'EndTime'=> $cal_end) ;
				
	$this->db->insert($this->table_cal_dates,$data);

	
	
	}	
	function update_cal_dates($id,$cal_start, $cal_end)
	{
		
    $data = array('StartTime'=> $cal_start , 'EndTime'=> $cal_end) ;
				
	$this->db->update($this->table_cal_dates,$data,'Id='.$id);

	
	
	}	
	function selectionner_cal_dates($opt)
	{
		
	
	if($opt!=NULL)
	{
		 $requete='SELECT * FROM  '.$this->table_cal_dates.' where cal_id='.$opt.' order by cal_id asc limit 1';
		$result=$this->db->fetchRow($requete);
		return  array($result['cal_start'],$result['cal_end']);
	
	}
		
	  
	
	}	
	function inserer_cal_user($id,$conseiller_id)
	{
		
	   $data = array('cal_id' => $id , 'cal_recur_date'=> 0 , 'cal_user_type'=>'u' , 'cal_user_id'=>$conseiller_id,'cal_quantity'=>'1') ;
	try {
		$this->db->insert($this->table_cal_user,$data);
	} catch (Exception $e) {
		die($e->getMessage());
	}			
	



	}	
	
	function inserer_cal($titre,$lieu,$createur='',$conseiller_id,$id_type_presta,$cal_start,$cal_end,$id_presta=0)
	{
		
		
		
		/*$requete='SELECT * FROM  apsie_comptes where account_lid="'.$createur.'" limit 1';
		$result=$this->db->fetchRow($requete);*/
		
			
	/*	
		if($lieu=='Gennevillers' or $lieu=='Courbevoie')
		{*/
	//	$requete2='SELECT * FROM  egw_categories where cat_appname="phpgw" and cat_name like "%'.$lieu.'" limit 1';
	/*	}
		elseif($lieu=='Saint-Maur' or $lieu=='Creteil' or $lieu=='Champigny')
		{
		$requete2='SELECT * FROM  egw_categories where cat_name="Crea_94_'.$lieu.'" limit 1';
		}
		else
		{
		$requete2='SELECT * FROM  egw_categories where cat_name="Crea_93_'.$lieu.'" limit 1';
		}*/
		
	//	$result2=$this->db->fetchRow($requete2);
		
	
	
	$data = array('id_owner' => $conseiller_id,'StartTime'=> $cal_start , 'EndTime'=> $cal_end, 'id_lieu'=> $lieu ,'id_type_evenement'=>1,'cal_status'=>'P', 'Subject'=>$titre,'id_presta'=>$id_presta,'id_cal_cat'=>$id_type_presta,'id_prestataire'=>1) ;			
	$this->db->insert($this->table_cal,$data);
	
	//print_r($data) ; exit();	
	
	
	$requete3='SELECT * FROM  apsie_jqcalendar order by Id desc limit 1';
	$result3=$this->db->fetchRow($requete3);
	return $result3['Id'];
		
}


//fonction projets-----------------------------------


	function inserer_phpgw_p_hours($id, $employee, $project_id, $activity_id, $entry_date, $start_date, $end_date, $remark, $minutes, $status, $hours_descr, $dstatus, $pro_parent, $pro_main, $billable, $km_distance, $t_journey, $cost_id)
	{		

$requete = "insert into phpgw_p_hours value ('', '$employee', '$project_id', '$activity_id', '$entry_date', '$start_date', '$end_date', '$remark', '$minutes', '$status', '$hours_descr', '$dstatus', '$pro_parent', '$pro_main', '$billable', '$km_distance', '$t_journey', '$cost_id')";
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	

	function inserer_phpgw_p_projects($project_id,$p_number,$owner,$access,$entry_date,$start_date,$end_date,$coordinator,$customer,$status,$descr,$title,$budget,$category,$parent,$time_planned,$date_created,$processor,$investment_nr,$main,$level,$previous,$customer_nr,$reference,$url,$result,$test,$quality,$accounting,$acc_factor,$billable,$psdate,$pedate,$priority,$discount,$e_budget,$inv_method,$acc_factor_d,$discount_type)
	{
		
	$requete = "insert into phpgw_p_projects value ('', '$p_number','$owner','$access','$entry_date','$start_date','$end_date','$coordinator','$customer','$status','$descr','$title','$budget','$category','$parent','$time_planned','$date_created','$processor','$investment_nr','$main','$level','$previous','$customer_nr','$reference','$url','$result','$test','$quality','$accounting','$acc_factor','$billable','$psdate','$pedate','$priority','$discount','$e_budget','$inv_method','$acc_factor_d','$discount_type')";
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	$requete='SELECT * FROM  phpgw_p_projects order by project_id desc limit 1';
	$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$project_id=$row['project_id'];
			
		}
		return $project_id;
	
	
	}	
	
	function selectionner_activite_id($titre)
	{
		
	
	
		
	    $requete='SELECT * FROM  phpgw_p_activities  where a_number="'.$titre.'" limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
			
		}
		
		return  $id;
	
	
	}	
	
	function selectionner_calendar_conseiller_id($opt)
	{
	
	
	
	
	
		
	    $requete='SELECT * FROM  apsie_jqcalendar  where cal_id='.$opt.' limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_owner=$row['cal_owner'];
		}
		
		return  $cal_owner;
	
	}
	
	
	function texte($champ,$select="asc")
	{
		
	    $requete='SELECT * FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur '.$select.'';
		$result=$this->db->fetchAll($requete);

	for($i=0;$i<count($result);$i++)
	{
			
			echo'<option value='.$result[$i]['id'].'>'.utf8_encode($result[$i]['valeur']).'</option>';
			
			
			
		}
	
	
	}
	function texte2($champ)
	{
		
	
	
	    $requete='SELECT valeur FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$valeur=$row['valeur'];
			
			
			echo'<option value='.$valeur.'>'.$valeur.'</option>';
			
			
			
		}
	}
	function texte_id($id)
	{
		
	
	
	    $requete='SELECT valeur FROM  egw_epce_texte   where id="'.$id.'" order by  valeur asc';
		$result=$this->db->fetchRow($requete);
		return $result['valeur'];
	
	}	
	

	function liste_dynamique_cp($valeur)
	{
		
	
	
	
	
	if(!$this->db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($valeur)) {
			$queryString = $db->real_escape_string($valeur);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT cp,ville1,departement FROM egw_code_postaux WHERE cp LIKE '$queryString%' LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			echo '<li onClick="fill(\''.$result->cp.'\');">'.$result->cp.' '.$result->ville1.'('.$result->departement.')</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
		
	}
	
		function age($dat_naissance) 
		{
     $dat= explode("/",date("d/m/Y", $dat_naissance));
	//Si on veut verifier � la date actuelle ( par d�faut )
	if(empty($timestamp))
		$timestamp = time();
 
	//On evalue l'age, � un an par exces
	$age = date('Y',$timestamp) - $dat[2];
 
	//On retire un an si l'anniversaire n'est pas encore pass�
	if($dat[1] > date('n', $timestamp) || ( $dat[1]== date('n', $timestamp) && $dat[0] > date('j', $timestamp)))
		$age--;
 
	return $age;
}

	
	function inserer_presta($id_ben,$id_projet,$id_contact_prescripteur,$id_dispositif,$id_ref,$prestataire,$nom,$prenom,$lettre_commande,$presta,$statut,$deb)
	{
		
		if($id_contact_prescripteur==NULL)
		$id_contact_prescripteur = 0;
		
    $data = array('id_ben' => $id_ben, 'id_projet'=> $id_projet , 'id_ref'=> $id_ref ,'id_contact_prescripteur'=> $id_contact_prescripteur, 'prestataire'=> $prestataire,'lettre_de_commande'=> $lettre_commande,'presta'=> $presta,'statut'=> $statut,'date_debut'=> $deb,'intitule'=> $nom.' '.$prenom,'id_dispositif'=> $id_dispositif) ;
			
		
	$this->db->insert($this->table_prestation,$data);
	
	$requete = ' select * from '.$this->table_prestation.' order by id_presta desc limit 1';
	$result=$this->db->fetchRow($requete);
	
	return $result['id_presta']; 

		
	}	
	function update_presta_epce($id_ben,$statut,$id_presta)
	{
	
	
	$data = array ('statut'=>$statut );
	$this->db->update($this->table_prestation,$data,'id_presta='.$id_presta);
	
	}
	function rdv_statut($beneficiaire,$statut,$id_presta="")
	{
		/*if($id_presta=="")
		{
		 $requete='SELECT Id FROM  apsie_jqcalendar   where cal_title like "%EPC93_'.$beneficiaire.'%" order by Id desc limit 1';
		}
		else
		{
		$requete='SELECT Id FROM  apsie_jqcalendar   where id_presta='.$id_presta.' order by Id desc limit 1';
		}
		$result = $this->db->fetchRow($requete);
		
		
			$cal_id=$result['Id'];
			//$cal_category=$result['cal_category'];
			
		
		*/
	$data = array ('cal_status'=>$statut );
	$this->db->update("apsie_jqcalendar",$data,'id_presta='.$id_presta);

/*if($statut=="R")
{
 
	
	$data = array ('cal_category'=>$cal_category.','.$this->cal_id_rejete);
	$this->db->update($this->table_cal,$data,'cal_id='.$cal_id);
}
	*/
		
	}
	

	
	function rdv_change_statut($id_rdv,$statut,$id_presta)
	{
		

	
		

		 $requete = 'Update apsie_jqcalendar set  cal_status="'.$statut.'",id_presta='.$id_presta.' where  Id='.$id_rdv.'';
		 //	echo $requete;
		 	$resultat = mysql_query($requete) or die(mysql_error());
			
		
			
				


	}
	
	function valider($id,$module,$id_presta)
	{	
	
		$requete='SELECT * FROM '.$this->table_validation.'  where id_presta='.$id_presta.'';
		
		$resultat=$this->db->fetchRow($requete);
				
		
		
		if ($resultat['id_presta']==NULL)
		{	
			
			$this->inserer_valider($id,$module,$id_presta);
		}
		else
		{
		
		 $this->update_valider($id,$module,$id_presta);
		}
				
	}
	function inserer_valider($id,$module,$id_presta)
	{	
	
	if($module=="plan")
	{
	$a = 1;
	$b = "?";
	$c = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	
	}
	if($module=="coherence")
	{
	$a = "?";
	$b = 1;
	$c = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_coherence")
	{
		$a = 1;
		$b = 1;
		$c = "";
		$d = "";
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="commerciaux")
	{
	$a = "?";
	$C = 1;
	$b = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_commerciaux")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = "";
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="financier")
	{
	$a = "?";
	$d = 1;
	$c = "?";
	$b = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_financier")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = 1;
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="juridique")
	{
	$a = "?";
	$e = 1;
	$c = "?";
	$d = "?";
	$b = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_juridique")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = 1;
		$e = 1;
		$f = "";
	    $g = 0;
	
	}
	if($module=="bilan")
	{
	$a = "?";
	$e = "?";
	$c = "?";
	$d = "?";
	$b = "?";
	$f = 1;
    $g = 0;
	}
	if($module=="tout_plan")
	{
	$f = "";
	$e = "";
	$d = "";
	$c = "";
	$b = "";
	$a = 1;
	$g = 0;
	
	}
	if($module=="tout")
	{
	$f = 1;
	$e = 1;
	$d = 1;
	$c = 1;
	$b = 1;
	$a = 1;
	$g = 1;
	
	}
	if($module=="NSPP")
	{
	$f = "";
	$e = "";
	$d = "";
	$c = "";
	$b = "";
	$a = "";
	$g = "";
	
	}
	if($module==1)
	{
		
		$requete = 'Select * from '.$this->table_validation.' where id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		if($result['plan']=="?")
		{
			$a = "";
		}
		elseif($result['plan']==1)
		{
			$a = 1;
		}
		else
		{
			$a = "?";
		}
		if($result['coherence']=="?")
		{
			$b = "";
		}
		elseif($result['coherence']==1)
		{
			$b = 1;
		}
		else
		{
			$b = "?";
		}
		if($result['commerciaux']=="?")
		{
			$c = "";
		}
			elseif($result['commerciaux']==1)
		{
			$c = 1;
		}
		else
		{
			$c = "?";
		}
		if($result['financier']=="?")
		{
			$d = "";
		}
			elseif($result['financier']==1)
		{
			$d = 1;
		}
		else
		{
			$d = "?";
		}
		if($result['juridique']=="?")
		{
			$e = "";
		}
			elseif($result['juridique']==1)
		{
			$e = 1;
		}
		else
		{
			$e = "?";
		}
		
	$f = "";
	
	$g = "0";
	
	}
	
		
		$data = array('id_beneficiaire'=>$id , 'plan'=>$a , 'coherence'=>$b ,'commerciaux'=>$c , 'financier'=>$d , 'juridique'=>$e , 'bilan'=>$f , 'epce'=>$g , 'id_presta'=>$id_presta ) ;

		$this->db->insert($this->table_validation,$data);
	}
		
		function update_valider($id,$module,$id_presta)
	{	
	
	if($module=="plan")
	{
	//$requete='update  egw_epce_validation set plan=1 where id_beneficiaire='.$id.' ';
	
		$data = array('plan'=>1) ;
		$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="coherence")
	{
	//$requete='update  egw_epce_validation set coherence=1 where id_beneficiaire='.$id.'';
	$data = array('coherence'=>1);
	$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="ab_coherence")
	{
	//$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>0 , 'bilan'=>'','coherence'=>1,'commerciaux'=>'','financier'=>'','juridique'=>'');
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	
	if($module=="commerciaux")
	{
		
	//$requete='update  egw_epce_validation set commerciaux=1 where id_beneficiaire='.$id.' ';
	$data = array('commerciaux'=>1);
	$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="ab_commerciaux")
	{
	//$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier="",juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>0 , 'bilan'=>'','coherence'=>1,'commerciaux'=>1,'financier'=>'','juridique'=>'');
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	if($module=="financier")
	{
	//$requete='update  egw_epce_validation set financier=1 where id_beneficiaire='.$id.' ';
	$data = array('financier'=>1);
	$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="ab_financier")
	{
	//$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>0 , 'bilan'=>'','coherence'=>1,'commerciaux'=>1,'financier'=>1,'juridique'=>'');
		$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	if($module=="juridique")
	{
	//$requete='update  egw_epce_validation set juridique=1 where id_beneficiaire='.$id.' ';
	$data = array('juridique'=>1);
		$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="ab_juridique")
	{
	//$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique=1 where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>0 , 'bilan'=>'','coherence'=>1,'commerciaux'=>1,'financier'=>1,'juridique'=>1);
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	if($module=="bilan")
	{
	//$requete='update  egw_epce_validation set bilan=1 where id_beneficiaire='.$id.' ';
	$data = array('bilan'=>1);
		$this->db->update($this->table_validation,$data,'id_beneficiaire ='.$id);
	}
	if($module=="tout_plan")
	{
	//$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence="",commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>0 , 'bilan'=>'','coherence'=>'','commerciaux'=>'','financier'=>'','juridique'=>'');
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	if($module=="tout")
	{
	//$requete='update  egw_epce_validation set epce=1,plan=1,bilan=1,coherence=1,commerciaux=1,financier=1,juridique=1 where id_presta='.$id_presta.' ';
	$data = array('plan'=>1,'epce'=>1 , 'bilan'=>1,'coherence'=>1,'commerciaux'=>1,'financier'=>1,'juridique'=>1);
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	if($module=="NSPP")
	{
	//$requete='update egw_epce_validation set epce="",plan="",bilan="",coherence="",commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>'','epce'=>'' , 'bilan'=>'','coherence'=>'','commerciaux'=>'','financier'=>'','juridique'=>'');
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	
		if($module==1)
	{
			$requete = 'Select * from '.$this->table_validation.' where id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		
		if($result['plan']=="?")
		{
			$a = "";
		}
		elseif($result['plan']==1)
		{
			$a = 1;
		}
		else
		{
			$a = "?";
		}
		if($result['coherence']=="?")
		{
			$b = "";
		}
		elseif($result['coherence']==1)
		{
			$b = 1;
		}
		else
		{
			$b = "?";
		}
		if($result['commerciaux']=="?")
		{
			$c = "";
		}
			elseif($result['commerciaux']==1)
		{
			$c = 1;
		}
		else
		{
			$c = "?";
		}
		if($result['financier']=="?")
		{
			$d = "";
		}
			elseif($result['financier']==1)
		{
			$d = 1;
		}
		else
		{
			$d = "?";
		}
		if($result['juridique']=="?")
		{
			$e = "";
		}
			elseif($result['juridique']==1)
		{
			$e = 1;
		}
		else
		{
			$e = "?";
		}
		
	$f = "";
	
	$g = "0";
	
	//$requete='update egw_epce_validation set epce="",plan="",bilan="",coherence="",commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	$data = array('plan'=>$a,'epce'=>$g , 'bilan'=>$f,'coherence'=>$b,'commerciaux'=>$c,'financier'=>$d,'juridique'=>$e);
	$this->db->update($this->table_validation,$data,'id_presta ='.$id_presta);
	}
	
	
		//$resultat = mysql_query($requete) or die(mysql_error());
	}
	
	function voir_validation($id_presta,$id_ben)
	{
		$requete='SELECT * FROM  '.$this->table_validation.'  where id_presta='.$id_presta.'';
		//echo $requete;
		$resultat = $this->db->fetchAll($requete);
	
		
		for($i=0;$i<count($resultat);$i++)
		{
			$plan=$resultat[$i]['plan'];
			$coherence=$resultat[$i]['coherence'];
			$commerciaux=$resultat[$i]['commerciaux'];
			$financier=$resultat[$i]['financier'];
			$juridique=$resultat[$i]['juridique'];
			$bilan=$resultat[$i]['bilan'];
			
		}	
		return array($plan,$coherence,$commerciaux,$financier,$juridique,$bilan);
				
	
	}
		function get_conseiller($account_id)
	{
		
	
		
		
			
	$requete='SELECT * FROM  apsie_comptes  where  account_id='.$account_id.'';
		$result=$this->db->fetchRow($requete);
		
		
			
			$account_firstname=$result['account_firstname'];
			$account_lastname=$result['account_lastname'];
		    $account_id=$result['account_id'];
			
		return $account_firstname.' '.$account_lastname;
		
		
		
	}
	
	function rdv_lieu($id_presta)
	{
		$requete='SELECT * FROM  apsie_jqcalendar  where id_presta='.$id_presta.' order by Id asc';
		
	
	 $resultat=$this->db->fetchAll($requete);
	 
	for($i=0;$i<count($resultat);$i++)
	{
			$cal_category=$resultat[$i]['id_cal_cat'];
			
	}
		
		if($cal_category!=NULL)
		{
		$requete='SELECT nom_dispositif as cal_cat_name FROM  egw_dispositif  where id_dispositif like "%'.$cal_category.'%" order by id_dispositif asc';
		
		 $resultat=$this->db->fetchAll($requete);
		for($z=0;$z<count($resultat);$z++)
		{
			$cat_name=$resultat[$z]['cal_cat_name'];
			
		}
		
	$cat=explode("_",$cat_name);
		return $cat[2];
		}
		else
		{}
	}
	
	function update_presta($id_presta,$lc,$conseiller_id,$date_debut,$date_fin)
	{
		$deb1=explode("/",$date_debut);
		 $deb1=mktime(0,0,0,$deb1[1],$deb1[0],$deb1[2]);
		 
		 
		 $deb2=explode("/",$date_fin);
		 $deb2=mktime(23,59,0,$deb2[1],$deb2[0],$deb2[2]);
		 if($deb2=="")
		 {
			$deb2=0;
			}

	
	$data = array( 'lettre_de_commande'=>$lc , 'id_ref'=>$conseiller_id , 'date_debut'=>$deb1 , 'date_fin'=>$deb2 ) ;
	$this->db->update($this->table_prestation,$data,'id_presta='.$id_presta);
	

	$requete2='SELECT * FROM  apsie_jqcalendar  where id_presta='.$id_presta.'';
	$result=$this->db->fetchRow($requete2);
	
		
			$cal_description=$result['cal_description'];
			$cal_description_r=str_replace('?',''.$lc.'',$cal_description);
		
		
		
		if(count($result)!=0)
		
		 {
	$data = array( 'cal_description'=>$cal_description_r  ) ;
		$this->db->update($this->table_cal,$data,'id_presta='.$id_presta);
		 }
	}
	function rdv_lier_presta($id_presta,$id_rdv,$cal_status)
	{
	
	 $requete = 'Update apsie_jqcalendar set id_presta='.$id_presta.',cal_status="'.$cal_status.'"   where  Id='.$id_rdv.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	
	
	}
	function rdv_unlink($id_rdv)
	{
	
	 $requete = 'Update apsie_jqcalendar set id_presta=0  where  Id='.$id_rdv.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	
	}
	
	function date_fr($date_an)
	{
	
	//Voici les deux tableaux des jours et des mois traduits en fran�ais
$nom_jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
$mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
        "septembre", "octobre", "novembre", "décembre");
// on extrait la date du jour
list($nom_jour, $jour, $mois, $annee) = explode('/', $date_an);

 
//Affichera par exemple : "date du jour en fran�ais : samedi 24 juin 2006."
return  $nom_jour_fr[$nom_jour].' '.$jour.' '.$mois_fr[$mois].' '.$annee;
}

	function get_conseiller_presta($id_presta)
	{
						
	$requete='SELECT id_ref FROM  egw_prestation  where  id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		
		
			
			$id_ref=$result['id_ref'];
	
	$requete='SELECT * FROM  apsie_comptes  where  account_id='.$id_ref.'';
	$result=$this->db->fetchRow($requete);
		
			$account_firstname=$result['account_firstname'];
			$account_lastname=$result['account_lastname'];
		    $account_id=$result['account_id'];
			
	
		return array($account_id,$account_lastname,$account_firstname);
	}
	
	
	function afficher_formation($id_ben)
	{
		
	


			echo'<hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="10%">Statut</td><td width="10%">Type de la formation</td><td width="14%">Niveau</td><td  width="12%" height="21" class="titre2">Intitule du diplome</td><td width="6%" >Resultat</td><td width="10%">Date debut</td><td width="10%">Date fin</td><td width="12%">Organisme formation</td><td width="12%">Organisme certification</td><td width="16%"></td></tr>';
  
		$requete="SELECT * FROM  ".$this->table_formation."  WHERE id_ben=$id_ben order by id_formation desc";
		$result=$this->db->fetchAll($requete);
	
		for($i=0;$i<count($result);$i++)
		{
			
			if($result[$i]['organisme_certification']!='')
			{
			$nbr_cert='('.$this->return_nbr_by_organisme($result[$i]['organisme_certification']).')';
			}
			else
			{
			$nbr_cert=NULL;
			}
			if($result[$i]['organisme_formation']!=NULL)
			{
			$nbr_form='('.$this->return_nbr_by_organisme($result[$i]['organisme_formation']).')';
			}
			else
			{
			$nbr_form=NULL;
			}
			$requete='SELECT * FROM  '.$this->table_organisation.'  WHERE nom_organisme = "'.$result[$i]['organisme_formation'].'" limit 1';
			$result2=$this->db->fetchRow($requete);
			$requete='SELECT * FROM  '.$this->table_organisation.'  WHERE nom_organisme = "'.$result[$i]['organisme_certification'].'" limit 1';
			$result3=$this->db->fetchRow($requete);
		
		
			echo'<tr><td>'.utf8_encode($result[$i]['statut_formation']).'</td><td >'.$result[$i]['type_formation'].'</td><td >'.$result[$i]['niveau_formation'].'</td><td >'.utf8_encode($result[$i]['intitule_formation']).'</td><td  >'.$result[$i]['resultat_formation'].'</td><td >'.$result[$i]['date_debut'].'</td><td>'.$result[$i]['date_fin'].'</td><td ><a href="javascript::void();" onclick="window.open(\'../../../Organisation1.0/details.php?domain=default&id_organisation='.$result2['id_organisation'].'&nom_organisme='.addslashes(utf8_encode($result[$i]['organisme_formation'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=1024, height=800\');">'.utf8_encode($result[$i]['organisme_formation']).'</a> '.$nbr_form.'</td><td ><a href="javascript::void();" onclick="window.open(\'../../../Organisation1.0/details.php?domain=default&id_organisation='.$result3['id_organisation'].'&nom_organisme='.addslashes(utf8_encode($result[$i]['organisme_certification'])).'\',\'Fiche organisme\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=1024, height=800\');">'.utf8_encode($result[$i]['organisme_certification']).'</a> '.$nbr_cert.'</td></td><td><a href="panel.php?choix='.$id_ben.'&id_formation_edit='.$result[$i]['id_formation'].'#parcours_ancre"><img title="Modifier"  border="0"  src="../images/edit.png" /></a> <a href="panel.php?choix='.$id_ben.'&id_formation_delete='.$result[$i]['id_formation'].'#parcours_ancre"><img title="Supprimer"  border="0"  src="../images/delete.png" /></a></td></tr>';
		}
	
	
		
		

	}
	function selectionner_organisation_ben($id_ben,$id_projet)
	{
		
	
echo'<strong>Entreprise du beneficiaire</strong><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="15%">Nom commercial</td><td width="21%">Activite principale</td><td width="14%">Forme juridique</td><td  width="18%">Secteur d\'activite</td><td width="6%" >Code postal</td><td width="10%">Ville</td><td width="7%">Statut</td></tr>';
  

		$requete ="SELECT * FROM  ".$this->table_projet_organisation."  WHERE id_ben=$id_ben and id_projet=$id_projet order by id_organisation desc";
	
		$result=$this->db->fetchAll($requete);
	
		for($i=0;$i<count($result);$i++)
		{
			
			
			echo'<tr><td>'.addslashes($result[$i]['nom_organisme']).'</td><td width="10%">'. utf8_encode($result[$i]['activite_principale']).'</td><td width="14%">'.$result[$i]['forme_juridique'].'</td><td width="18%" height="21" class="titre2">'.utf8_encode($result[$i]['secteur_activite']).'</td><td >'.$result[$i]['cp_oeg'].'</td><td >'.$result[$i]['ville'].'</td><td >'.$result[$i]['statut_org'].'</td></tr>';
		}
	
	
		echo'</table><br/><br/>';
		

	}
	
	function update_formation($id_formation,$id_owner,$id_ben,$statut_formation,$type_formation,$niveau_formation,$intitule_formation,$resultat_formation,$date_debut,$date_fin,$org_formation,$org_certification)
	{
		$org_certification=str_replace("�",'e',$org_certification);
		$org_certification=str_replace("�",'e',$org_certification);
		$org_formation=str_replace("�",'e',$org_formation);
		$org_formation=str_replace("�",'e',$org_formation);
		
		if(is_numeric($niveau_formation))
	$niveau_formation=$this->texte_id($niveau_formation);
	
	if(is_numeric($type_formation))
	$type_formation=$this->texte_id($type_formation);
		if(is_numeric($statut_formation))
		{
	$statut_formation=$this->texte_id($statut_formation);
		}
		else
		{
			$statut_formation=utf8_decode($statut_formation);
		}
		
		$data = array( 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'id_ben' => $id_ben,'statut_formation' => $statut_formation,'niveau_formation' => $niveau_formation,'intitule_formation' => utf8_decode($intitule_formation),'type_formation' => $type_formation,'resultat_formation' => $resultat_formation,'date_debut' => $date_debut,'date_fin' => $date_fin ,'organisme_formation' =>  utf8_decode($org_formation),'organisme_certification' => utf8_decode($org_certification));
	
	$this->db->update($this->table_formation,$data,'id_formation='.$id_formation);
	}
	function inserer_formation($id_owner,$id_ben,$statut_formation,$type_formation,$niveau_formation,$intitule_formation,$resultat_formation,$date_debut,$date_fin,$org_formation,$org_certification)
	{
		$org_certification=str_replace("�",'e',$org_certification);
		$org_certification=str_replace("�",'e',$org_certification);
		$org_formation=str_replace("�",'e',$org_formation);
		$org_formation=str_replace("�",'e',$org_formation);
		
		if(is_numeric($niveau_formation))
	$niveau_formation=$this->texte_id($niveau_formation);
	
	if(is_numeric($type_formation))
	$type_formation=$this->texte_id($type_formation);
		if(is_numeric($statut_formation))
	$statut_formation=$this->texte_id($statut_formation);
		
		$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'id_ben' => $id_ben,'statut_formation' => $statut_formation,'niveau_formation' => $niveau_formation,'intitule_formation' => utf8_decode($intitule_formation),'type_formation' => $type_formation,'resultat_formation' => $resultat_formation,'date_debut' => $date_debut,'date_fin' => $date_fin ,'organisme_formation' =>  utf8_decode($org_formation),'organisme_certification' => utf8_decode($org_certification));
	
	$this->db->insert($this->table_formation,$data);

 $retour = array();
 //FORMATION
 
	if($this->verif_organisme($org_formation)!=0 or $this->verif_organisme($org_formation)!=NULL )
	{
	//attacher
	if($this->return_ids_organisme($id_ben)!=0 and substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_formation))==0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$this->verif_organisme($org_formation);
		
	}
	elseif(substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_formation))==0)
	{
	$new_id_organisation=$this->verif_organisme($org_formation);
	}
	
	
	else
	{
	$new_id_organisation=$this->return_ids_organisme($id_ben);
	}
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	

	}
	else
	{
		if($org_certification==$org_formation)
		{
		$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'categorie_org' => $this->cat_id_formation.','.$this->cat_id_certification,'nom_organisme' => utf8_decode($org_formation));
		}
		else
		{
		$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'categorie_org' => $this->cat_id_formation,'nom_organisme' => utf8_decode($org_formation));
		}
	
	$this->db->insert($this->table_organisation,$data);
	
	
    $requete='SELECT id_organisation from '.$this->table_organisation.' order by id_organisation desc limit 1';
    $result=$this->db->fetchRow($requete);
	
	
	if($this->return_ids_organisme($id_ben)!=0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$result['id_organisation'];
		
	}
	elseif($this->return_ids_organisme($id_ben)!= $result['id_organisation'])
	{
	$new_id_organisation=$result['id_organisation'];
	}
	
	
	$data = array('id_organisation' =>''.$new_id_organisation.''  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	
	$retour[0]=$result['id_organisation'];
	$retour[1]=$org_formation;
   // array($result['id_organisation'],$org_formation);
	
	if($org_certification==NULL or $org_certification==$org_formation )
	{
	return $retour;
	}
	
	}
	
	
	//CERTIFICATION
	
		if($this->verif_organisme($org_certification)!=0 or $this->verif_organisme($org_certification)!=NULL )
	{
	//attacher
	if($this->return_ids_organisme($id_ben)!=0 and substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_certification))==0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$this->verif_organisme($org_certification);
		
	}
	elseif(substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_certification))==0)
	{
	$new_id_organisation=$this->verif_organisme($org_certification);
	}
	else
	{
	$new_id_organisation=$this->return_ids_organisme($id_ben);
	}
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	

	}
	else
	{
		$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'categorie_org' => $this->cat_id_certification,'nom_organisme' => utf8_decode($org_certification));
	
	$this->db->insert($this->table_organisation,$data);
	
	
    $requete='SELECT id_organisation from '.$this->table_organisation.' order by id_organisation desc limit 1';
    $result2=$this->db->fetchRow($requete);
	
	
	if($this->return_ids_organisme($id_ben)!=0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$result['id_organisation'];
		
	}
	elseif($this->return_ids_organisme($id_ben)!= $result['id_organisation'])
	{
	$new_id_organisation=$result['id_organisation'];
	}
	
	
	$data = array('id_organisation' =>''.$new_id_organisation.''  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	
	$retour[2]=$result2['id_organisation'];
	$retour[3]=$org_certification;
	
	return $retour;
	
	}
	}
	function delete_formation($id_formation)
	{
		

	$data = array('id_formation='.$id_formation);
	$this->db->delete($this->table_formation,$data);

	
	}
	function delete_parcours_pro($id_parcours)
	{
		

	$data = array('id_parcours='.$id_parcours);
	$this->db->delete($this->table_parcours_pro,$data);

	
	}
	
function inserer_resacc($id_ben,$id_owner,$id_modifier,$id_projet,$nom_commercial,$activite_principale,$raison_sociale,$type_adresse,$adresse_ligne_1,$adresse_ligne_2,$adresse_ligne_3,$cp,$ville,$date_immat,$date_debut_activite,$forme_juridique,$siret,$secteur_activite,$dirigeant,$implantation,$regime_imposition,$regime_tva,$regime_fiscal,$regime_social_dirigeant,$statut)
	{
		
		$dat_deb=explode("/",$date_debut);
		$dat_fin=explode("/",$date_fin);
		
		if($statut!=NULL and is_numeric($statut))
		$statut=$this->texte_id($statut);
		
		$data = array('categorie_org'=>$this->cat_id_org_resacc,'id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() , 'id_ben'=> $id_ben ,'id_projet'=> $id_projet,'nom_organisme'=> $nom_commercial,'activite_principale'=> $activite_principale,'raison_sociale'=> $raison_sociale,'type_adresse'=> $type_adresse,'adresse_ligne_1'=> $adresse_ligne_1,'adresse_ligne_2'=> $adresse_ligne_2,'adresse_ligne_3'=> $adresse_ligne_3 ,'cp'=> $cp ,'ville'=> $ville ,'date_immat'=> $date_immat ,'date_debut_activite'=> $date_debut_activite,'forme_juridique'=>$forme_juridique,'siret'=> $siret ,'secteur_activite'=> $secteur_activite,'dirigeant'=> $dirigeant,'implantation'=> $implantation , 'regime_imposition'=> $regime_imposition ,'regime_tva'=> $regime_tva , 'regime_fiscal'=> $regime_fiscal , 'regime_social_dirigeant'=> $regime_social_dirigeant,'statut_org'=> $statut);   
		
		$this->db->insert($this->table_organisation,$data);
	}
	

	
	function inserer_emploi($id_ben,$id_owner,$id_modifier,$statut,$identifiant,$poste,$intitule_poste,$code_rome,$categorie,$service,$indemnite_1,$remuneration,$date_debut,$date_fin,$contrat,$contrat_aide,$qualification,$temps_travail,$deplacement,$org_employeur,$personne_concernee)
	{
		$org_employeur=str_replace("�",'e',$org_employeur);
		$org_employeur=str_replace("�",'e',$org_employeur);
			
		$dat_deb=explode("/",$date_debut);
		$dat_fin=explode("/",$date_fin);
		
		if($statut!=NULL and is_numeric($statut))
		$statut=$this->texte_id($statut);
			if($service!=NULL and is_numeric($service))
		$service=$this->texte_id($service);
		if($indemnite_1!=NULL and is_numeric($indemnite_1))
		$indemnite_1=$this->texte_id($indemnite_1);
		if($contrat!=NULL and is_numeric($contrat))
		$contrat=$this->texte_id($contrat);
		if($contrat_aide!=NULL and is_numeric($contrat_aide))
		$contrat_aide=$this->texte_id($contrat_aide);
		if($qualification!=NULL and is_numeric($qualification))
		$qualification=$this->texte_id($qualification);
		if($deplacement!=NULL and is_numeric($deplacement))
		$deplacement=$this->texte_id($deplacement);
		
		
		if($date_debut!=NULL)
		{
		$date_debut = mktime('0','0','0',''.$dat_deb[1].'',''.$dat_deb[0].'',''.$dat_deb[2].'');
		}
		else
		{
			$date_debut=0;
		}
		
		if($date_fin!=NULL)
		{
		$date_fin = mktime('0','0','0',''.$dat_fin[1].'',''.$dat_fin[0].'',''.$dat_fin[2].'');
		}
		else
		{
			$date_fin=0;
		}
		
		if($poste!=NULL)
		{
		$data1 = array ("fonction"=>utf8_decode($poste));
		$this->db->update($this->table_contact,$data1,'id_ben='.$id_ben);
		}
		
		$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() , 'id_ben'=> $id_ben ,'statut'=> $statut,'personne_concernee'=> $personne_concernee,'identifiant'=> $identifiant,'poste'=> utf8_decode($poste),'intitule_poste'=> utf8_decode($intitule_poste) ,'code_rome'=> $code_rome ,'categorie_rome'=> utf8_decode($categorie) ,'service'=> $service ,'type_remuneration'=> $indemnite_1,'montant_remuneration'=> $remuneration,'date_debut'=> $date_debut,'date_fin'=> $date_fin ,'type_contrat'=> $contrat ,'type_contrat_aide'=> $contrat_aide,'qualification'=> $qualification,'temps_travail'=> $temps_travail , 'mobilite'=>$deplacement ,'organisme'=> strtoupper(utf8_decode($org_employeur)) );   
		
		$this->db->insert($this->table_parcours_pro,$data);
		
		if($org_employeur!=NULL)
		{
			
		if($this->verif_organisme($org_employeur)!=0 or $this->verif_organisme($org_employeur)!=NULL )
	{
	//attacher----------------------------------------------------------
	
	if($this->return_ids_organisme($id_ben)!=0 and substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_employeur))==0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$this->verif_organisme($org_employeur);
		
	}
	elseif(substr_count($this->return_ids_organisme($id_ben), $this->verif_organisme($org_employeur))==0)
	{
	$new_id_organisation=$this->verif_organisme($org_employeur);
	}
	//attacher----------------------------------------------------------
	
	else
	{
	$new_id_organisation=$this->return_ids_organisme($id_ben);
	}
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	

	}
	else
	{
		
			$data = array('id_owner' => $id_owner , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'categorie_org' => $this->cat_id_employeur,'nom_organisme' => utf8_decode(strtoupper($org_employeur)));
	$this->db->insert($this->table_organisation,$data);
	
	$requete='select * from '.$this->table_organisation.' order by id_organisation desc';
	$result2=$this->db->fetchRow($requete);
	
	
	
	if($this->return_ids_organisme($id_ben)!=0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','.$result2['id_organisation'];
		
	}
	elseif($this->return_ids_organisme($id_ben)!= $result2['id_organisation'])
	{
	$new_id_organisation=$result2['id_organisation'];
	}
	
	
	$data = array('id_organisation' =>''.$new_id_organisation.''  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	
	
	
	
	return array($result2['id_organisation'],$result2['nom_organisme']);
	
	
		
	}}
	
/*		$requete = 'insert into egw_addressbook_parcours_pro values("","'.$id_ben.'","'.$id_owner.'","'.time().'","'.$id_modifier.'","'.time().'","'.utf8_decode($poste).'","'.utf8_decode($intitule_poste).'","'.$code_rome.'","'.utf8_decode($categorie).'","'.$this->texte_id($service).'","'.$remuneration.'","'.mktime('0','0','0',''.$dat_deb[0].'',''.$dat_deb[1].'',''.$dat_deb[2].'').'","'.mktime('0','0','0',''.$dat_fin[0].'',''.$dat_fin[1].'',''.$dat_fin[2].'').'","'.$this->texte_id($contrat).'","'.$this->texte_id($contrat_aide).'","'.$this->texte_id($qualification).'","'.$temps_travail.'","'.$this->texte_id($deplacement).'","'.strtoupper($organisation).'","'.$id_org.'")';*/
	

	
	

	}
//1.1	
		function selectionner_relance($choix)
	{
	
	
	  echo'<a name="relance" id="relance"></a><strong>Historique des relances</strong>  <hr style="border:1px dashed #CCC" />
<table width=100%>
  <tr style="background:url(./images/ligne_relance.gif) repeat-x; background-position:bottom; height:25px; " ><td width="100px" >ID_relance</td><td width="100px" height="21" class="titre2">Prestation</td><td width="100px" >ID_Prestation</td><td width="150px">Relanceur</td><td width="200px">Date de la relance</td><td width="100px">Type</td><td width="300px">Motif</td><td width="300px">Resultat</td><td width="200px" >Prochain contact</td><td width="20px" >Le</td></tr>';
		
		
			
		$requete='SELECT * FROM  egw_relance  where id_ben='.$choix.' order by info_startdate desc';
		$row=$this->db->fetchAll($requete);
		for($z=0;$z<count($row);$z++)
		{
			$id_presta[]=$row[$z]['id_presta'];
			$info_id[]=$row[$z]['info_id'];
			$info_owner[]=$row[$z]['info_owner'];
			$info_startdate[]=$row[$z]['info_startdate'];
			$type[]=$row[$z]['type'];
			$motif[]=$row[$z]['motif'];
			$statut[]=$row[$z]['statut'];
				$le[]=$row[$z]['le'];
					$statut[]=$row[$z]['statut'];
					$prochain_contact[]=$row[$z]['prochain_contact'];
			
		}
		for($i=0;$i<count($id_presta);$i++)
		{
					
		$requete='SELECT presta,lettre_de_commande FROM  egw_prestation  where id_presta='.$id_presta[$i].' ';
	$row2=$this->db->fetchRow($requete);
		
			$presta=$row2['presta'];
			$lettre_de_commande=$row2['lettre_de_commande'];
			
		
		if($type[$i]=="phone")
{
	$type[$i]='<img title="Appel t�l�phonique" src="../../images/phone.png" />';
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

		echo'<tr ><td ><a  href="panel.php?choix='.$choix.'&id_relance='.$info_id[$i].'">'.$info_id[$i].'</a></td><td >'.$presta.'</td><td >'.$lettre_de_commande.'</td><td >'.$this->get_conseiller($info_owner[$i]).'</td><td >'.date("d/m/Y",$info_startdate[$i]).'</td><td >'.$type[$i].'</td><td >'.utf8_encode($motif[$i]).'</td><td>'.utf8_encode($statut[$i]).'</td><td>'.utf8_encode($prochain_contact[$i]).'</td><td>'; if($le[$i]!=0)echo date("d/m/Y",$le[$i]);echo'</td></tr>';
		
		
		}
		echo'</table>';
		
	}
	
//1.1	
		function relance_details($info_id)
	{
	
	

		
			
		$requete='SELECT * FROM  egw_relance  where info_id='.$info_id.'';
		$row=$this->db->fetchRow($requete);
		
	
			$info_id=$row['info_id'];
			$commentaire1=$row['commentaire1'];
			$commentaire2=$row['commentaire2'];
			$info_startdate=$row['info_startdate'];
			$type=$row['type'];
			$motif=$row['motif'];
			$statut=$row['statut'];
				$le=$row['le'];
					
					$prochain_contact=$row['prochain_contact'];
		
	return array($info_id,utf8_encode($commentaire1),utf8_encode($commentaire2),$info_startdate,utf8_encode($type),utf8_encode($motif),utf8_encode($statut),$le,$prochain_contact);
	}
	
	function maj_id_ben_parcours_pro()
	{
	$requete = 'Select id_organisation , nom_organisme from '.$this->table_organisation.' where categorie_org=246 order by id_organisation asc';
	$result=$this->db->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
	$requete2 = 'Select link_id1 from egw_links where link_app1="addressbook" and link_app2="addressbook" and link_id2='.$result[$i]['id_organisation'];
	$result2=$this->db->fetchRow($requete2);
	$data = array('id_ben'=>$result2['link_id1']);
	$this->db->update($this->table_parcours_pro , $data , 'organisme like "%'.$result[$i]['nom_organisme'].'%"'); 
	$data2 = array('id_organisation'=>$result[$i]['id_organisation']);
	$this->db->update($this->table_contact , $data2 , 'id_ben = "'.$result2['link_id1'].'"'); 
	}
	
	
	}
	
	function return_parcours_pro($id_parcours)
	{
	
	$requete = 'select * from '.$this->table_parcours_pro.' where id_parcours = '.$id_parcours.'';
	$result=$this->db->fetchRow($requete);
	
	return array($result['personne_concernee'],$result['statut'],$result['identifiant'],$result['poste'],$result['intitule_poste'],$result['type_remuneration'],$result['montant_remuneration'],$result['service'],$result['date_debut'],$result['date_fin'],$result['type_contrat'],$result['type_contrat_aide'],$result['qualification'],$result['temps_travail'],$result['mobilite'],$result['organisme'],$result['id_parcours']);
	
	}
	function return_formation($id_formation)
	{
	
	$requete = 'select * from '.$this->table_formation.' where id_formation = '.$id_formation.'';
	return $this->db->fetchRow($requete);

	
	}
	function update_emploi($id_parcours,$id_owner,$statut,$identifiant,$poste_ben,$poste,$code_rome,$categorie,$service,$indemnite_1,$remuneration,$date_debut,$date_fin,$contrat,$contrat_aide,$qualification,$temps_travail,$deplacement,$organisation,$personne_concernee)
	{
		$dat_deb=explode("/",$date_debut);
		$dat_fin=explode("/",$date_fin);
		
		if($service!=NULL and is_numeric($service))
		$service=$this->texte_id($service);
			
			if($indemnite_1!=NULL and is_numeric($indemnite_1))
		$indemnite_1=$this->texte_id($indemnite_1);
			if($contrat!=NULL and is_numeric($contrat))
		$contrat=$this->texte_id($contrat);
			if($contrat_aide!=NULL and is_numeric($contrat_aide))
		$contrat_aide=$this->texte_id($contrat_aide);
		
			if($qualification!=NULL and is_numeric($qualification))
		$qualification=$this->texte_id($qualification);
		
		if($deplacement!=NULL and is_numeric($deplacement))
		$deplacement=$this->texte_id($deplacement);
		
		if($statut!=NULL and is_numeric($statut))
		$statut=$this->texte_id($statut);
		
		$data = array( 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'statut'=> $statut,'personne_concernee'=> $personne_concernee,'identifiant'=> $identifiant,'poste'=> utf8_decode($poste_ben),'intitule_poste'=> utf8_decode($poste) ,'code_rome'=> $code_rome ,'categorie_rome'=> utf8_decode($categorie) ,'service'=> $service ,'type_remuneration'=> $indemnite_1,'montant_remuneration'=> $remuneration,'date_debut'=> mktime('0','0','0',''.$dat_deb[1].'',''.$dat_deb[0].'',''.$dat_deb[2].''),'date_fin'=> mktime('0','0','0',''.$dat_fin[1].'',''.$dat_fin[0].'',''.$dat_fin[2].'') ,'type_contrat'=> $contrat,'type_contrat_aide'=> $contrat_aide,'qualification'=> $qualification,'temps_travail'=> $temps_travail , 'mobilite'=>$deplacement ,'organisme'=> strtoupper(utf8_decode($organisation)) );  
		
		$this->db->update($this->table_parcours_pro,$data,'id_parcours = '.$id_parcours);
	}
	
	function return_cal_id_U($id_presta)
	{
	 	$requete = 'Select cal_id,cal_category from '.$this->table_cal.' where id_presta='.$id_presta.'';
		$result=$this->db->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
			
			
			$requete2 = 'Select cal_id from '.$this->table_cal_user.' where cal_id='.$result[$i]['cal_id'].' and cal_status="U"';
			$result2=$this->db->fetchRow($requete2);
			
			if($result2['cal_id']!=NULL)
			{
			$data = array ('cal_category'=>$result[$i]['cal_category'].','.$this->cal_id_rejete);
			$this->db->update($this->table_cal,$data,'cal_id='.$result2['cal_id']);
			}

			$data = array("cal_status" =>"R") ;
			$this->db->update($this->table_cal_user,$data,'cal_id='.$result[$i]['cal_id'].' and cal_status="U"');
		}
	}
function getLieu($id_lieu)
	{
		if($id_lieu=="")
		{
			$sql="SELECT * FROM apsie_lieu order by nom_lieu asc";
	return $this->db->fetchAll($sql);}
		else
		{
			
	$sql="SELECT * FROM apsie_lieu  where id_lieu=".$id_lieu." limit 1 ";
	return $this->db->fetchRow($sql);
		}
	}
function getCalCat()
	{
	$sql="SELECT * FROM egw_dispositif where is_active=1";
	return  $this->db->fetchAll($sql);
	}
	
	function _destruct()
	{
	mysql_close($this->db);
	
	// session_destroy();
	
	}
	
}
?>