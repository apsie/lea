<?php

class contact
{
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_contact = "egw_contact";
	 public $table_organisation= "egw_organisation";
	 public $table_projet = "egw_projet";
	 public $table_accounts = "egw_accounts";
	 public $table_presta = "egw_prestation";
	 public $table_formation = "egw_contact_formation";
	 public $table_parcours = "egw_contact_parcours_pro";
	 public $table_etat_civil = "egw_contact_etat_civil";
	 public $db;
 
	function __construct()
	{
		
	include('../Classes/config/config.php');
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
	
	function nbr_contact($mot='',$categorie='')
	{
	
	if(strlen($mot)==1)
	{ 
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme like "'.$mot.'%"';
	}
	else
	{			
	$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%"  and nom_organisme like "%'.$mot.'%" ';
	}
	}
	else
	{
		if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_organisation.'';
	}
	else
	{
	$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%" ';

	}
	}	    
		$result=$this->db->fetchAll($requete);
		return count($result);

	}
	
	
	function voir_contact($categorie='',$mot='a',$ligne=0,$limit=50,$id_compte,$tri='nom',$cla='asc')
	{
	if(strlen($mot)==1)
	{  
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_organisation.' where nom like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
	}
	else
	{
		
	$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%"  and nom like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';

		
	}
	}
	else
	{
	if($categorie=='')
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
	}
	else
	{
		
		
	$requete='SELECT * FROM  '.$this->table_contact.' where cat_id like "%'.$categorie.'%"  and nom like "%'.$mot.'%"   order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';

		
	}
	}
	
	
	 	
		$result=$this->db->fetchAll($requete);

	for($i=0;$i<count($result);$i++)
	{
		if($i%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		if(ereg($this->cat_beneficiaire,$result[$i]['cat_id']))
		{
		$icons='<img title="Beneficiaire" src="images/user.png" />';
		}
		elseif(ereg($this->cat_prescripteur,$result[$i]['cat_id']))
		{
			$icons='<img title="Contact prescripteur" src="images/user_thief_baldie.png" />';
		}
		elseif(ereg($this->cat_staff_apsie,$result[$i]['cat_id']))
		
		{
			$icons='<img title="Staff Apsie" src="images/user_business.png" />';
		}
			else
		{
			$icons='<img  title="Autre" src="images/user_silhouette.png" />';
		}
		echo'<tr bgcolor='.$color.'> <td>'.$icons.'</td> <td  height="21">
   '.$result[$i]['civilite'].'
  </td>
  <td  height="21">
    '.$result[$i]['nom'].'
  </td>
  <td height="21">
  '.$result[$i]['prenom'].'
  </td>
  <td  height="21">
    '.$result[$i]['tel_pro_1'].'</font>
  </td>
  <td  height="21">
     '.$result[$i]['tel_domicile_1'].'</font>
  </td>  <td height="21">
     '.$result[$i]['portable_perso'].'</font>
  </td>
  <td  height="21">
    '.$result[$i]['email_pro'].'</font>
  </td>
   <td  height="21">
    '.$result[$i]['email_perso'].'</font>
  </td>

  <td class="body"><a href="info.php?id_ben='.$result[$i]['id_ben'].'&domain=default"><img src="index.php_fichiers/view.png" title="Voir" border="0"></a> <a title="Dossier du bénéficiaire" onclick="window.open(\'../../presta/epce/control.php?id='.$id_compte.'&id_ben='.$result[$i]['id_ben'].'\',\'PANEL\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\');" target="_blank" ><img src="index.php_fichiers/edit.png" title="Modifier" border="0"></a></td>
</tr>';
			
			
			
		}
		echo'</table></center>';
	}

	
	function _destruct()
	{
	mysql_close($this->db);
	
	
	
	}
	
}
?>