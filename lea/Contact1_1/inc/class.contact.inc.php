<?php

class contact
{
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_contact = "egw_contact";
	 public $table_projet = "egw_projet";
	 public $table_accounts = "egw_accounts";
	 public $table_presta = "egw_prestation";
	 public $table_formation = "egw_contact_formation";
	 public $table_parcours = "egw_contact_parcours_pro";
	 public $table_etat_civil = "egw_contact_etat_civil";
	 public $cat_beneficiaire = 244;
	 public $cat_partenaire = 233;
	 public $cat_prescripteur = 256;
	 public $cat_fournisseur = 271;
	 public $cat_employeur = 257;
	 public $cat_staff_apsie = 77;
	 public $cat_usager = 287;
	 public $cat_usager_06 = 165;
	 public $cat_usager_07 = 84;	
	 public $cat_usager_08 = 156;
	 public $cat_usager_09 = 219;
	 public $cat_accompagnement = 260;
	 public $cat_financement = 261;
	 public $cat_institutionnel = 269;
	 public $cat_particulier = 218;
	
	 public $db;
 
	function __construct()
	{
	
	include('/var/www/clients/client1/web4/web/egw_apsie_143/Classes/config/config.php');
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
	
	
		function get_categorie($cat_id)
		{
				if($cat_id!=0)
				{
				
				$requete='SELECT * FROM  egw_categories where cat_id='.$cat_id.'';
	$result=$this->db->fetchRow($requete);
	
	    echo'<option value='.$result['cat_id'].'>'.$result['cat_name'].'</option>';
	}
	else
	{
		echo'<option></option>';
	}
		}
		
		
	function nbr_contact($mot='',$categorie='',$editeur='')
	{
		if($editeur=='')
		{
	if($categorie=="apsie")
		{
			$categorie = $this->cat_staff_apsie;
		}
		
	if(strlen($mot)>=2)
	{ 
	if($categorie==NULL and $_GET['champ']!='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where '.$_GET['champ'].' like "%'.$mot.'%"';
	}
	elseif($categorie==NULL )
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%"  ';
	}
	elseif($_GET['champ']!='')
	{
	
			$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%" and ('.$_GET['champ'].' like "%'.$mot.'%") ';
		
	}
	else
	{
	
			$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%" and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%") ';
		
	}
	}
	elseif(strlen($mot)==1)
	{ 
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "'.$mot.'%"';
	}
	else
	{
		
		
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and nom like "'.$mot.'%" ';

		
	}
	}
	else
	{
		if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.'';
	}
	else
	{
		
		
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%" ';

		
	}
	}
		}
		elseif($editeur!='')
	{
		$date_deb=explode('/',$editeur[3]);
		$date_fin=explode('/',$editeur[4]);
		if(is_numeric($editeur[5]))
		{
			$avis1 ='and avis1='.$editeur[5];
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		elseif($editeur[5]!=3 and $editeur[5]!=NULL)
		{
			$avis1 ='and avis1!=3';
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		if($editeur[6]!=NULL)
		{
			$avis2 ='and avis2='.$editeur[6];
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		
		if($editeur['1']!=NULL)
		{
			$statut='and statut="'.$editeur['1'].'"';
		}
			if($editeur['2']!=NULL)
		{
			$id_ref='and id_ref='.$editeur['2'];
		}
			if($editeur['0']!=NULL)
		{
			$presta='and presta="'.$editeur['0'].'"';
		}
		
				if(strlen($mot)>=2 and $categorie!=NULL and $_GET['champ']!='')
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p '.$table_bilan.' where cat_id like "%'.$categorie.'%" and  c.id_ben=p.id_ben  '.$join_id_presta.' and ('.$_GET['champ'].' like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
		
	
		}
			elseif(strlen($mot)>=2 and $categorie!=NULL)
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where cat_id like "%'.$categorie.'%" and  c.id_ben=p.id_ben  '.$join_id_presta.' and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
		
	
		}
		
		elseif(strlen($mot)>=2 and $_GET['champ']!='')
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where  c.id_ben=p.id_ben '.$join_id_presta.' and ('.$_GET['champ'].' like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
		
	
		}
		
		elseif(strlen($mot)>=2 )
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where  c.id_ben=p.id_ben '.$join_id_presta.'  and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
		
	
		}
		elseif($categorie!=NULL)
		{
			$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where cat_id like "%'.$categorie.'%"  and  c.id_ben=p.id_ben  '.$join_id_presta.' '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
	
		}
		else
		{
			$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where c.id_ben=p.id_ben '.$join_id_presta.' '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.'';
		
		}
		
		
	}
	   //echo $requete;
		
		$result=$this->db->fetchAll($requete);
		return count($result);

	}
	function get_identite($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_contact.' where id_ben='.$id_ben.'';
	 $result=$this->db->fetchRow($requete);
	 return array($result['nom'],$result['prenom'],$result['civilite'],$result['deuxieme_prenom'],$result['nom_jeune_fille']);
	
	}
	function get_account($account_id)
	{
	if($account_id!=0)
	{
	 $requete='SELECT * FROM  '.$this->table_accounts.' where account_id='.$account_id.'';
	 $result=$this->db->fetchRow($requete);
	 return $result['account_firstname'].' '.$result['account_lastname'];
	}
	}
	function get_etat_civil($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_etat_civil.' where id_ben='.$id_ben.' order by id_etat_civil desc limit 1';
	 $result=$this->db->fetchRow($requete);
	 return array($result['date_naissance'],$result['lieu_naissance'],$result['nationalite'],$result['situation_maritale'],$result['enfants_a_charge']);
	
	}
	function get_presta($id_ben,$id)
	{
	
	 $requete='SELECT * FROM  '.$this->table_presta.' where id_ben='.$id_ben.' order by date_debut desc';
	 $result=$this->db->fetchAll($requete);
	 
	 for($i=0;$i<count($result);$i++)
	 {
		if($result[$i]['date_debut']!=0  )
{
	$result[$i]['date_debut'] = date("d/m/Y",$result[$i]['date_debut']);
}
else
{
	$result[$i]['date_debut'] = NULL;
}


		if($result[$i]['date_fin']!=0  )
{
	$result[$i]['date_fin'] = date("d/m/Y",$result[$i]['date_fin']);
}
else
{
	$result[$i]['date_fin'] = NULL;
}

		if($result[$i]['date_fin_reelle']!=0  )
{
	$result[$i]['date_fin_reelle'] = date("d/m/Y",$result[$i]['date_fin_reelle']);
}
else
{
	$result[$i]['date_fin_reelle'] = NULL;
}
		
		echo'
 
  <tr>
  <td width="136">Prestataire</td><td width="3">:<td width="0"></td><td width="222">'.$result[$i]['prestataire'].'</td></tr> <tr>
  <td width="136">Type de Prestation</td><td>:<td></td><td width="222">'.$result[$i]['presta'].'</td></tr><tr>
  <td width="136">Id prestation</td><td>:<td ></td>
<td width="222"><a onclick="window.open(\'../../presta/epce/control.php?lc='.$result[$i]['lettre_de_commande'].'&presta='.$result[$i]['presta'].'&id_presta='.$result[$i]['id_presta'].'&id='.$id.'&id_ben='.$id_ben.'&continuer=1\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\');"  href="">'.$result[$i]['lettre_de_commande'].'</a></td></tr><tr>
  <td width="136">Date de d&eacute;but</td><td>:<td></td>
<td width="222">'.$result[$i]['date_debut'].'</td></tr><tr>
  <td width="136">Date de fin</td><td>:<td></td>
<td width="222">'.$result[$i]['date_fin'].'</td></tr><tr>
  <td width="136">Date de fin r&eacute;elle</td><td>:<td></td>
<td width="222">'.$result[$i]['date_fin_reelle'].'</td></tr><tr>
  <td width="136">Statut</td><td>:<td></td>
<td width="222">'.$result[$i]['statut'].'</td></tr><tr><td height="30px"></td></tr>';
	 }
	
	}
	function get_formation($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_formation.' where id_ben='.$id_ben.' order by id_formation desc';
	 $result=$this->db->fetchAll($requete);
	 
	 
	 for($i=0;$i<count($result);$i++)
	 {
		 
		
		echo'
 
  <tr>
  <td width="136">Type de formation</td><td width="3">:<td width="0"></td><td width="222">'.$result[$i]['type_formation'].'</td></tr> <tr>
  <td width="136">Niveau de formation</td><td>:<td></td><td width="222">'.$result[$i]['niveau_formation'].'</td></tr><tr>
  <td width="136">Intitulé de formation</td><td>:<td ></td>
<td width="222">'.$result[$i]['intitule_formation'].'</td></tr><tr>
  <td width="136">Date de début</td><td>:<td></td>
<td width="222">'.$result[$i]['date_debut'].'</td></tr><tr>
  <td width="136">Date de fin</td><td>:<td></td>
<td width="222">'.$result[$i]['date_fin'].'</td></tr><tr>
  <td width="136">Résultat formation</td><td>:<td></td>
<td width="222">'.$result[$i]['resultat_formation'].'</td></tr><tr>
  <td width="136">Org.Formation</td><td>:<td></td>
<td width="222"><a href="">'.$result[$i]['organisme_formation'].'</a></td></tr><tr>
  <td width="136">Org.Certification</td><td>:<td></td>
<td width="222"><a href="">'.$result[$i]['organisme_certification'].'</a></td></tr><tr><td height="30px"></td></tr>';
	 }
	
	}
	
	function get_parcours_pro($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_parcours.' where id_ben='.$id_ben.' order by id_parcours desc';
	 $result=$this->db->fetchAll($requete);
	 
	 
	 for($i=0;$i<count($result);$i++)
	 {
		
		if($result[$i]['date_debut']!=0  )
{
	$result[$i]['date_debut'] = date("d/m/Y",$result[$i]['date_debut']);
}
else
{
	$result[$i]['date_debut'] = NULL;
}
		if($result[$i]['date_fin']!=0  )
{
	$result[$i]['date_fin'] = date("d/m/Y",$result[$i]['date_fin']);
}
else
{
	$result[$i]['date_fin'] = NULL;
}


		echo'
 
  <tr>
  <td width="136">Statut</td><td width="3">:<td width="0"></td><td width="222">'.$result[$i]['statut'].'</td></tr> <tr>
  <td width="136">Identifiant</td><td width="3">:<td width="0"></td><td width="222">'.$result[$i]['identifiant'].'</td></tr> <tr>
  <td width="136">Poste</td><td>:<td></td><td width="222">'.$result[$i]['poste'].'</td></tr><tr>
  <td width="136">Service</td><td>:<td ></td>
<td width="222">'.$result[$i]['service'].'</td></tr><tr>
  <td width="136">Montant rémunération</td><td>:<td ></td>
<td width="222">'.$result[$i]['montant_remuneration'].' €</td></tr><tr>
  <td width="136">Date de début</td><td>:<td></td>
<td width="222">'.$result[$i]['date_debut'].'</td></tr><tr>
  <td width="136">Date de fin</td><td>:<td></td>
<td width="222">'.$result[$i]['date_fin'].'</td></tr><tr>
  <td width="136">Type contrat</td><td>:<td></td>
<td width="222">'.$result[$i]['type_contrat'].'</td></tr><tr>
  <td width="136">Type contrat aidé</td><td>:<td></td>
<td width="222">'.$result[$i]['type_contrat_aide'].'</td></tr><tr>
  <td width="136">Qualification</td><td>:<td></td>
<td width="222">'.$result[$i]['qualification'].'</td></tr><tr>
  <td width="136">Temps de travail</td><td>:<td></td>
<td width="222">'.$result[$i]['temps_travail'].' h</td></tr><tr>
  <td width="136">Mobilité</td><td>:<td></td>
<td width="222">'.$result[$i]['mobilite'].'</td></tr><tr>
  <td width="136">Organisme</td><td>:<td></td>
<td width="222"><a href="">'.$result[$i]['organisme'].'</a></td></tr><tr><td height="30px"></td></tr>';
	 }
	
	}
	
	function nbr_presta($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_presta.'  where id_ben='.$id_ben.' ';
		
		$result=$this->db->fetchAll($requete);
    return count($result);
	}
	function nbr_formations($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_formation.'  where id_ben='.$id_ben.' ';
		
		$result=$this->db->fetchAll($requete);
    return count($result);
	}
	function nbr_parcours_pro($id_ben)
	{
		
	    $requete='SELECT * FROM  '.$this->table_parcours.'  where id_ben='.$id_ben.' ';
		
		$result=$this->db->fetchAll($requete);
    return count($result);
	}
	function get_projet($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_projet.' where id_ben='.$id_ben.' order by id_projet desc limit 1';
	 $result=$this->db->fetchRow($requete);
	 return array($result['intitule_projet'],$result['description_projet'],$result['date_debut'],$result['date_fin_previsionnelle'],$result['date_fin_reelle'],$result['id_coordinateur'],$result['statut'],$result['resultat'],$result['id_projet']);
	
	}
	function get_coordonnee($id_ben)
	{
	
	 $requete='SELECT * FROM  '.$this->table_contact.' where id_ben='.$id_ben.'';
	 $result=$this->db->fetchRow($requete);
	 return array($result['adresse_ligne_1'],$result['adresse_ligne_2'],$result['adresse_ligne_3'],$result['cp'],$result['ville'],$result['region'],$result['pays'],$result['tel_pro_1'],$result['tel_pro_2'],$result['tel_domicile_1'],$result['tel_domicile_2'],$result['portable_pro'],$result['portable_perso'],$result['email_perso'],$result['email_pro'],$result['fax_perso'],$result['fax_pro'],$result['site_perso'],$result['civilite'],$result['nom'],$result['prenom'],$result['deuxieme_prenom'],$result['nom_jeune_fille'],$result['fonction'],$result['cat_id']);
	
	}
	function voir_contact($categorie='',$mot='a',$ligne=0,$limit=50,$id_compte,$is_admin,$tri='nom',$cla='asc',$editeur='')
	{
		if($tri=='')
		$tri='nom';
		if($cla=='')
		$cla='asc';
		
	
	if($editeur=='')
	{
	if($categorie=="apsie")
		{
			$categorie = $this->cat_staff_apsie;			
		}			
		
	if(strlen($mot)>=2)
	{  
	if($categorie=='')
	{
		if($_GET['champ']=='')
		{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';	
		}
		elseif($_GET['champ']!='')
		{
		$requete='SELECT * FROM  '.$this->table_contact.' where '.$_GET['champ'].' like "%'.$mot.'%"  order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';	
		}
	}
	else
	{
		
		if($_GET['champ']=='')
		{
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%")   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
		elseif($_GET['champ']!='')
		{
		$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and ('.$_GET['champ'].' like "%'.$mot.'%")   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}

		
	}
	}
	elseif(strlen($mot)==1)
	{
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
	}
	else
	{
		
		
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and nom like "'.$mot.'%"   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';

		
	}
	}
	else
	{
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
	}
	else
	{
		
		
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and nom like "%'.$mot.'%"   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';

		
	}
	}
	
	}
		elseif($editeur!='')
	{
		$date_deb=explode('/',$editeur[3]);
		$date_fin=explode('/',$editeur[4]);
		if(is_numeric($editeur[5]))
		{
			$avis1 ='and avis1='.$editeur[5];
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		
		elseif($editeur[5]!=3 and $editeur[5]!=NULL)
		{
			$avis1 ='and avis1!=3';
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		if($editeur[6]!=NULL)
		{
			$avis2 ='and avis2='.$editeur[6];
			$join_id_presta='and  p.id_presta=a.id_presta';
			$table_bilan=', egw_epce_bilan_avis a';
		}
		
		if($editeur['1']!=NULL)
		{
			$statut='and statut="'.$editeur['1'].'"';
		}
			if($editeur['2']!=NULL)
		{
			$id_ref='and id_ref='.$editeur['2'];
		}
			if($editeur['0']!=NULL)
		{
			$presta='and presta="'.$editeur['0'].'"';
		}
		
				if(strlen($mot)>=2 and $categorie!=NULL and $_GET['champ']!='')
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p '.$table_bilan.' where cat_id like "%'.$categorie.'%" and  c.id_ben=p.id_ben  '.$join_id_presta.' and ('.$_GET['champ'].' like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
	
		}
			elseif(strlen($mot)>=2 and $categorie!=NULL)
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where cat_id like "%'.$categorie.'%" and  c.id_ben=p.id_ben  '.$join_id_presta.' and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
	
		}
		
		elseif(strlen($mot)>=2 and $_GET['champ']!='')
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where  c.id_ben=p.id_ben '.$join_id_presta.' and ('.$_GET['champ'].' like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
	
		}
		
		elseif(strlen($mot)>=2 )
		{
		$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where  c.id_ben=p.id_ben '.$join_id_presta.'  and (nom like "%'.$mot.'%" or prenom like "%'.$mot.'%" or ville like "%'.$mot.'%" or pays like "%'.$mot.'%"  or cp like "%'.$mot.'%"  or fonction like "%'.$mot.'%" or portable_perso like "%'.$mot.'%" or email_pro like "%'.$mot.'%"  or email_perso like "%'.$mot.'%" or site_perso like "%'.$mot.'%" or adresse_ligne_1 like "%'.$mot.'%" or tel_pro_1 like "%'.$mot.'%"  or tel_pro_2 like "%'.$mot.'%" or civilite like "%'.$mot.'%") '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
	
		}
		elseif($categorie!=NULL)
		{
			$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where cat_id like "%'.$categorie.'%"  and  c.id_ben=p.id_ben  '.$join_id_presta.' '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
	
		}
		else
		{
			$requete='SELECT * FROM  egw_contact c, egw_prestation p'.$table_bilan.' where c.id_ben=p.id_ben '.$join_id_presta.' '.$presta.' '.$statut.' '.$id_ref.' and date_debut>'.mktime(0,0,0,$date_deb[1],$date_deb[0],$date_deb[2]).'  and date_debut<'.mktime(23,59,59,$date_fin[1],$date_fin[0],$date_fin[2]).' '.$avis1.' '.$avis2.' order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		
		}
		
		
	}
	
	
		$result=$this->db->fetchAll($requete);
		
	
	
	for($i=0;$i<count($result);$i++)
	{
		$cat_id=$result[$i]['cat_id'];
		if($i%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		if(ereg($this->cat_staff_apsie,$result[$i]['cat_id']))		
		{
			$result[$i]['cat_id']=str_replace($this->cat_staff_apsie,"<img title='Staff Apsie' src='images/user_business.png' />",$result[$i]['cat_id']);	
		}
		if(ereg($this->cat_usager,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace(','.$this->cat_usager,"",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_beneficiaire,$result[$i]['cat_id']))
		{
		$result[$i]['cat_id']=str_replace($this->cat_beneficiaire,"<img title='Usager_10' src='images/user.png' />",$result[$i]['cat_id']);		
		}
		if(ereg($this->cat_prescripteur,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_prescripteur,"<img title='Prescripteur' src='images/user_thief_baldie.png' />",$result[$i]['cat_id']);			
		}
		if(ereg($this->cat_employeur,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_employeur,"<img title='Employeur' src='images/hire-me.png' />",$result[$i]['cat_id']);				
		}		
		if(ereg($this->cat_usager_06,$result[$i]['cat_id']))	
		{			
			$result[$i]['cat_id']=str_replace($this->cat_usager_06,"<img title='Usager_06' src='images/user_usager_06.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_usager_07,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_usager_07,"<img title='Usager_07' src='images/user_usager_07.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_usager_08,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_usager_08,"<img title='Usager_08' src='images/user_usager_08.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_usager_09,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_usager_09,"<img title='Usager_09' src='images/user_usager_09.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_accompagnement,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_accompagnement,"<img title='Contact organisme accompagnement' src='images/organisme_accompagnement.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_financement,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_financement,"<img title='Contact organisme financement' src='images/organisme_financement.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_institutionnel,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_institutionnel,"<img title='Contact institutionnel' src='images/institutionnel.png' />",$result[$i]['cat_id']);
		}
		if(ereg($this->cat_partenaire,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_partenaire,"<img title='Contact partenaire' src='images/partenaire.png' />",$result[$i]['cat_id']);
		}
			if(ereg($this->cat_fournisseur,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_fournisseur,"<img title='Contact fournisseur' src='images/fournisseur.png' />",$result[$i]['cat_id']);
		}
		
				if(ereg($this->cat_particulier,$result[$i]['cat_id']))
		{
			$result[$i]['cat_id']=str_replace($this->cat_particulier,"<img title='Contact particulier' src='images/particulier.png' />",$result[$i]['cat_id']);
		}
		/*else
		{
			$result[$i]['cat_id']='<img  title="Autre" src="images/user_silhouette.png" />';
		}*/
		
		if($result[$i]['portable_perso']!=NULL)
		{
		$tel[$i]=$result[$i]['portable_perso'];
		}
		elseif($result[$i]['tel_pro_1']!=NULL)
		{
	$tel[$i]=$result[$i]['tel_pro_1'];
		}
		elseif($result[$i]['tel_domicile_1']!=NULL)
		{
		$tel[$i]=$result[$i]['tel_domicile_1'];
		}
		
		if($result[$i]['email_perso']!=NULL)
		{
		$email[$i]=$result[$i]['email_perso'];
		}
		elseif($result[$i]['email_pro']!=NULL)
		{
		$email[$i]=$result[$i]['email_pro'];
		}
		
		
		
		echo'<form method="get"><tr bgcolor='.$color.'> <td>'.($i+1).'</td><td>'.$result[$i]['cat_id'].'</td> <td  height="21">
   '.$result[$i]['civilite'].'
  </td>
  <td  height="21">
    '.$result[$i]['nom'].'
  </td>
  <td height="21">
  '.$result[$i]['prenom'].'
  </td>
   <td  height="21">
     '.$result[$i]['fonction'].'</font>
  </td>
  <td  height="21">
    '.$tel[$i].'</font>
  </td>
   <td height="21">
     <a onclick="window.open(\'emailing.php?domain=default&valeur_contact='.$email[$i].'\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=800, height=800\');"  href="">'.$email[$i].'</a></font>
  </td>
  <td  height="21">
    '.$result[$i]['cp'].'</font>
  </td>
   <td  height="21">
    '.$result[$i]['ville'].'</font>
  </td>

  <td class="body"><a href="info.php?categorie='.$cat_id.'&id='.$id_compte.'&id_ben='.$result[$i]['id_ben'].'&domain=default"><img src="images/dossier.png" title="Dossier du contact" border="0"></a> <a  onclick="window.open(\'../'.$GLOBALS['version_contact'].'/voir.php?domain=default&id_ben='.$result[$i]['id_ben'].'\',\'Voir un contact\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=800, height=400\');"  href="javascript::void()"><img src="index.php_fichiers/view.png" title="Voir fiche contact" border="0"></a>
  
  <a onclick="window.open(\'modifier.php?categorie='.$cat_id.'&id='.$id_compte.'&id_ben='.$result[$i]['id_ben'].'&domain=default\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=800, height=500\');"  href="" ><img src="index.php_fichiers/edit.png" title="Modifier le contact" border="0"></a>';

  if($is_admin==1)
  {
  echo'<a href="javascript:if(confirm(\'Etes vous sur de vouloir supprimer ce contact ?\')) document.location.href=\'index.php?id_ben_delete='.$result[$i]['id_ben'].'&domain=default\'" ><img src="index.php_fichiers/delete.png" title="Supprimer le contact" border="0"></a>';
  }
  echo'
<input type="checkbox" name="valeur_contact[]" value="'.$email[$i].'!'.$result[$i]['id_ben'].'" /></td></tr>';
			
			
			
		}
		echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right"><input type="hidden" value="default" name="domain" /><input type="hidden" value="'.$_GET['intitule_editeur'].'" name="intitule_editeur" />';
		if($is_admin==1)
  {
	  echo'<input type="submit" value="Liste excel" name="excel" />';
  }
  echo'<input type="submit" value="Emailing" name="emailing" /></td></tr></form></table></center>';
	}
function ajouter_contact($id_owner, $cat_id, $nom, $prenom, $deuxieme_prenom, $nom_jeune_fille, $civilite, $adresse_ligne_1, $fonction, $adresse_ligne_2, $adresse_ligne_3, $ville, $region, $cp, $pays, $tel_pro_1, $tel_pro_2, $tel_domicile_1, $tel_domicile_2, $fax_pro, $fax_perso, $portable_pro, $portable_perso, $email_pro, $email_perso, $site_perso)
	{
	/*	
			if($cat_id=="apsie")
		{
			$cat_id = $this->cat_staff_apsie;
		}
		elseif($cat_id=="Contact_prescripteurs")
		{
			$cat_id = $this->cat_prescripteur;
		}
		elseif($cat_id=="Contact_employeurs")
		{
			$cat_id = $this->cat_employeur;
		}
		elseif($cat_id=="Beneficiaire")
		{
			$cat_id = $this->cat_beneficiaire;
		}*/
		
	$data = array('id_owner' => $id_owner, 'date_creation' => time(), 'id_modifier' => $id_owner, 'date_last_modified' => time(),'cat_id' => $cat_id, 'nom_complet' => $civilite.' '.$nom.' '.$prenom, 'nom' => $nom, 'prenom' => $prenom, 'deuxieme_prenom' => $deuxieme_prenom, 'nom_jeune_fille' => $nom_jeune_fille, 'civilite' => $civilite,  'adresse_ligne_1' => $adresse_ligne_1, 'fonction' => $fonction, 'adresse_ligne_2'=> $adresse_ligne_2, 'adresse_ligne_3'=> $adresse_ligne_3, 'ville'=> $ville, 'region'=> $region, 'cp'=> $cp, 'pays'=> $pays, 'tel_pro_1'=> $tel_pro_1, 'tel_pro_2'=> $tel_pro_2, 'tel_domicile_1'=> $tel_domicile_1, 'tel_domicile_2'=> $tel_domicile_2, 'fax_pro'=> $fax_pro, 'fax_perso'=> $fax_perso, 'portable_pro'=> $portable_pro, 'portable_perso'=> $portable_perso, 'email_pro'=> $email_pro, 'email_perso'=> $email_perso, 'site_perso'=> $site_perso);
				
	$this->db->insert($this->table_contact,$data);
	}
	
	function delete_contact($id_ben)
	{
		

	$data = array('id_ben='.$id_ben);
	$this->db->delete($this->table_contact,$data);

	
	}
	
	function lister_categorie()
	{
	
			$requete='SELECT cat_name, cat_id from egw_categories where cat_appname like "addressbook" and cat_parent like "%259%"';
			$result=$this->db->fetchAll($requete);

		for($i=0;$i<count($result);$i++)
		{
			$nom_categorie=$result[$i]['cat_name'];	
			$id_categorie=$result[$i]['cat_id'];
			
				echo '<option value="'.$id_categorie.'">'.$nom_categorie.'</option>';
		}		
		
	}
	
	function update_contact($id_ben, $id_owner, $cat_id, $nom, $prenom, $deuxieme_prenom, $nom_jeune_fille, $civilite, $adresse_ligne_1, $fonction, $adresse_ligne_2, $adresse_ligne_3, $ville, $region, $cp, $pays, $tel_pro_1, $tel_pro_2, $tel_domicile_1, $tel_domicile_2, $fax_pro, $fax_perso, $portable_pro, $portable_perso, $email_pro, $email_perso, $site_perso)
	{
		
  $data = array('id_owner' => $id_owner, 'id_modifier' => $id_owner, 'date_last_modified' => time(),'cat_id' => $cat_id, 'nom_complet' => $civilite.' '.$nom.' '.$prenom, 'nom' => $nom, 'prenom' => $prenom, 'deuxieme_prenom' => $deuxieme_prenom, 'nom_jeune_fille' => $nom_jeune_fille, 'civilite' => $civilite,  'adresse_ligne_1' => $adresse_ligne_1, 'fonction' => $fonction, 'adresse_ligne_2'=> $adresse_ligne_2, 'adresse_ligne_3'=> $adresse_ligne_3, 'ville'=> $ville, 'region'=> $region, 'cp'=> $cp, 'pays'=> $pays, 'tel_pro_1'=> $tel_pro_1, 'tel_pro_2'=> $tel_pro_2, 'tel_domicile_1'=> $tel_domicile_1, 'tel_domicile_2'=> $tel_domicile_2, 'fax_pro'=> $fax_pro, 'fax_perso'=> $fax_perso, 'portable_pro'=> $portable_pro, 'portable_perso'=> $portable_perso, 'email_pro'=> $email_pro, 'email_perso'=> $email_perso, 'site_perso'=> $site_perso);
				
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben.'');
	}
	
	function _destruct()
	{
	mysql_close($this->db);
	
	
	
	}
	
}
?>
