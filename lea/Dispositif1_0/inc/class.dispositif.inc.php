<?php

class dispositif
{
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	  public $table_prestation = "egw_prestation";
	  public $table_contact = "egw_contact";
	  public $table_contact_etat_civil = "egw_contact_etat_civil";
	  public $table_contact_parcours_pro = "egw_contact_parcours_pro";
	 
	 public $db;
 
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
	
	function voir_dispositif()
	{
	
	    $requete='SELECT * FROM  '.$this->table_dispositif.' order by id_dispositif desc';
		$result=$this->db->fetchAll($requete);

echo'<center><table ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td>ID_Dispositif</td><td>Nom du dispositif</td><td>Numéro de marché</td><td>Objet</td><td>Date de début</td><td>Date de fin</td><td>Nbr d\'objectifs</td><td></td></tr>';
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
		echo'<tr bgcolor="'.$color.'" align="center"><td>'.$result[$i]['id_dispositif'].'</td><td>'.$result[$i]['nom_dispositif'].'</td><td>'.$result[$i]['numero_marche'].'</td><td>'.$result[$i]['objet'].'</td><td>'.date("d/m/Y",$result[$i]['date_debut']).'</td><td>'.date("d/m/Y",$result[$i]['date_fin']).'</td><td>'.$this->selectionner_nbr_objectif($result[$i]['id_dispositif']).'</a></td><td><a href="?domain=default&id_dispositif='.$result[$i]['id_dispositif'].'" title="Ajouter un objectif à ce dispositif"><img src="images/add.png"/> </a> <a border=0 href="?domain=default&id_dispositif_statistique='.$result[$i]['id_dispositif'].'&objet_dispositif_statistique='.$result[$i]['objet'].'" title="Voir les statistiques"><img src="images/view.png"/></a> <a border=0 href="?domain=default&id_dispositif_edit='.$result[$i]['id_dispositif'].'&nom_dispositif='.$result[$i]['nom_dispositif'].'&objet='.$result[$i]['objet'].'&numero_marche='.$result[$i]['numero_marche'].'&date_debut='.$result[$i]['date_debut'].'&date_fin='.$result[$i]['date_fin'].'"  title="Modification du dispositif"><img src="images/edit.png"/></a> <a border=0 href="?domain=default&id_dispositif_delete='.$result[$i]['id_dispositif'].'" title="Suppression du dispositif"><img src="images/delete.png"/></a></td></tr>';
			
			
			
		}
		echo'</table></center>';
	}
	function selectionner_critere()
	{
	
	    $requete='SELECT * FROM  '.$this->table_critere.' order by famille_critere';
		$result=$this->db->fetchAll($requete);

echo'<select name="id_critere">';
	for($i=0;$i<count($result);$i++)
	{
			
		echo'<option value="'.$result[$i]['id_critere'].'">'.$result[$i]['famille_critere'].' : '.$result[$i]['nom_critere'].'</option>';
			
			
			
		}
	echo'</select>';	
	}
	function selectionner_beneficiaire_dispositif($id_dispositif)
	{
	
	    $requete='SELECT * FROM  '.$this->table_prestation.' where id_dispositif='.$id_dispositif.' order by date_debut desc';
		$result=$this->db->fetchAll($requete);

echo'<table bgcolor="#FFFFFF"; style="border:1px dashed #CCC"><tr style="color:#900" ><td>Type de prestation</td><td>ID_prestation</td><td width="150px">Bénéfiaire</td><td width="130px">Date de début</td><td width="130px">Date de fin</td><td>Statut</td></tr>';
	for($i=0;$i<count($result);$i++)
	{
		if($result[$i]['date_fin']==0)
		{
			$dat_fin="?";
		}
		else
		{
		$dat_fin=date("d/m/Y",$result[$i]['date_fin']);
		}
		echo'<tr><td>'.$result[$i]['presta'].'</td><td>'.$result[$i]['lettre_de_commande'].'</td><td>'.$result[$i]['intitule'].'</td><td>'.date("d/m/Y",$result[$i]['date_debut']).'</td><td>'.$dat_fin.'</td><td>'.$result[$i]['statut'].'</td><td></td></tr>';
			
	
			
			
			
		}
echo'</table>';
	}
	
	function selectionner_objectif_dispositif($id_dispositif)
	{
	
	    $requete='SELECT * FROM  '.$this->table_objectif.' where id_dispositif='.$id_dispositif.' order by id_objectif  desc';
		$result=$this->db->fetchAll($requete);

echo'<table style="border:1px dashed #CCC"><tr  bgcolor="#666666" ; style="color: #FFF"><td width="200px">Critère</td><td width="150px">Objectif du critère</td><td width="150px">Valeur</td><td width="130px">Degré</td><td></td></tr>';
	for($i=0;$i<count($result);$i++)
	{
		if($result[$i]['bool_critere_obligatoire']==1)
		{
		$degre="Obligatoire";
		}
		else
		{
		$degre="Facultatif";
		}
		  
		
		
		echo'<tr  style="background-color:#FFF"><td>'.$this->selectionner_critere_stats($result[$i]['id_critere']).'</td><td style="color:#0C0">'.$result[$i]['objectif_critere'].'</td><td width="150px">'.$result[$i]['valeur_critere'].'</td><td width="130px">'.$degre.'</td><td><a border=0 href="#"><img src="images/delete.png"/></a></td></tr>';
		
	
	
			
			
			
		}
echo'</table>';
	}
	
	function stats_objectif_dispositif($id_dispositif)
	{
	
	    $requete='SELECT * FROM  '.$this->table_objectif.' where id_dispositif='.$id_dispositif.' order by id_objectif  desc';
		$result=$this->db->fetchAll($requete);
		
	    $requete2='SELECT * FROM  '.$this->table_dispositif.' where id_dispositif='.$id_dispositif.' ';
		$result2=$this->db->fetchRow($requete2);

echo'<table  style="border:1px dashed #CCC"><tr bgcolor="#666666" ; style="color: #FFF" ><td width="200px">Critère</td><td width="150px">Objectif du critère</td><td width="150px">Objectif réalisé</td><td >Ecart</td><td>Taux de réalisation</td></tr>';
	for($i=0;$i<count($result);$i++)
	{
		if($result[$i]['bool_critere_obligatoire']==1)
		{
		$degre="Obligatoire";
		}
		else
		{
		$degre="Facultatif";
		}
		  
		
		
		echo'<tr style="background-color:#FFF" ><td>'.$this->selectionner_critere_stats($result[$i]['id_critere']).'</td><td >'.$result[$i]['objectif_critere'].'</td><td >'.$this->stats_by_critere($this->selectionner_critere_stats($result[$i]['id_critere']),$result2['id_dispositif']).'</td><td style="color: #F00" >'.$this->ecart($result[$i]['objectif_critere'],$this->stats_by_critere($this->selectionner_critere_stats($result[$i]['id_critere']),$result2['id_dispositif'])).'</td><td style="color:#0C0">'.$this->taux_realisation($result[$i]['objectif_critere'],$this->stats_by_critere($this->selectionner_critere_stats($result[$i]['id_critere']),$result2['id_dispositif'])).'%</td></tr>';
		
	
	
			
			
			
		}
echo'</table>';
	}
	
	function stats_by_critere($nom_critere,$id_dispositif)
	{
		
		$ob=explode(' : ',$nom_critere);
	 $requete='SELECT * FROM  '.$this->table_prestation.' where id_dispositif="'.$id_dispositif.'"';
	
	$result=$this->db->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
	
	 $req = $req. ' or id_ben='.$result[$i]['id_ben'];
	
	}
	
	if($ob[0]=="Sexe")
	{
		if($ob[1]=="Homme")
		{
			$requete2='SELECT * FROM  '.$this->table_contact.' where (id_ben=0 '.$req.') and civilite="Monsieur"';
		}
		elseif($ob[1]=="Femme")
		{
			$requete2='SELECT * FROM  '.$this->table_contact.' where (id_ben=0 '.$req.') and (civilite="Madame" or civilite="Mademoiselle")';
		}
	
	$result2=$this->db->fetchAll($requete2);
	}
	
	if($ob[0]=="Departement")
	{
	$requete2='SELECT * FROM  '.$this->table_contact.' where (id_ben=0 '.$req.') and cp like "'.$ob[1].'%"';
	//echo $requete2;
	$result2=$this->db->fetchAll($requete2);
	}
	
	if($ob[0]=="Statut")
	{
			$requete2='SELECT  distinct * FROM  '.$this->table_contact_parcours_pro.' where (id_ben=0 '.$req.') and statut="'.$ob[1].'"';
		
	
	$result2=$this->db->fetchAll($requete2);
	}
	
	
	
	//echo $requete2;
	return count($result2);
	}
	
	function ecart($nb_objectif,$nb_realise)
	{
	
	
	return $nb_realise-$nb_objectif;
	}
	function taux_realisation($nb_objectif,$nb_realise)
	{
	
	
	 $taux=($nb_realise/$nb_objectif)*100;
	 return round($taux,2);
	 
	}
	
		function selectionner_critere_stats($id_critere)
	{
	 $requete='SELECT * FROM  '.$this->table_critere.' where id_critere='.$id_critere.'';
	$result=$this->db->fetchRow($requete);
	return $result['famille_critere'].' : '.$result['nom_critere'];
	}
	
	function selectionner_nbr_objectif($id_dispositif)
	{
	
	    $requete='SELECT * FROM  '.$this->table_objectif.' where id_dispositif='.$id_dispositif.'';
		$result=$this->db->fetchAll($requete);
		return count($result);
	}
	function inserer_objectif($id_dispositif,$id_critere,$objectif_critere,$valeur_critere,$degre_critere)
	{
		
	$data = array('id_dispositif' => $id_dispositif , 'id_critere'=> $id_critere , 'objectif_critere'=> $objectif_critere , 'valeur_critere'=> $valeur_critere ,'bool_critere_obligatoire' => $degre_critere);
				
	$this->db->insert($this->table_objectif,$data);

	}
	function inserer_dispositif($nom_dispositif,$numero_marche,$objet,$date_debut,$date_fin)
	{
		
		$dat_deb=explode("/",$date_debut);
		$dat_fin=explode("/",$date_fin);
	$data = array('nom_dispositif' => $nom_dispositif , 'numero_marche'=> $numero_marche , 'objet'=> $objet , 'date_debut'=> mktime(0,0,0,$dat_deb[1],$dat_deb[0],$dat_deb[2]) ,'date_fin' => mktime(0,0,0,$dat_fin[1],$dat_fin[0],$dat_fin[2]));
				
	$this->db->insert($this->table_dispositif,$data);

	}
	
	function update_dispositif($id_dispositif,$nom_dispositif,$numero_marche,$objet,$date_debut,$date_fin)
	{
		
		$dat_deb=explode("/",$date_debut);
		$dat_fin=explode("/",$date_fin);
	$data = array('nom_dispositif' => $nom_dispositif , 'numero_marche'=> $numero_marche , 'objet'=> $objet , 'date_debut'=> mktime(0,0,0,$dat_deb[1],$dat_deb[0],$dat_deb[2]) ,'date_fin' => mktime(0,0,0,$dat_fin[1],$dat_fin[0],$dat_fin[2]));
				
	$this->db->update($this->table_dispositif,$data,'id_dispositif='.$id_dispositif.'');

	}
		
		function delete_dispositif($id_dispositif)
	{
	$conditions = array("id_dispositif=".$id_dispositif."");	
	$this->db->delete($this->table_dispositif,$conditions);

	}
	
	
	
	
	
	function _destruct()
	{
	mysql_close($this->db);
	
	
	
	}
	
}
?>