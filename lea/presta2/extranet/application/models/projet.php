<?php

class projet extends Zend_Db_Table_Abstract
{
	public $id_projet = null;
	public $categorie = null;
	public $resultat;
	public $description;
	public $statut;
	public $referent;
	public $date_debut;
	public $date_fin;
	public $date_fin_previsionnelle;
	public $id_contact = null;
	public $nom_contact = null;


	function getProjet($mot="",$idProjet="")
	{
		global $conn;
		$sqlPlus="";

		
		if($mot!="") {
			$mot = str_replace("é", "e", $mot);
		$mot = str_replace("è", "e", $mot);
			$sqlPlus .=" AND p.intitule_projet like '%".$mot."%' OR p.description_projet like '%".$mot."%'  OR p.statut like '%".$mot."%'  OR p.resultat like '%".$mot."%'  OR c.account_firstname like '%".$mot."%'  OR c.account_lastname like '%".$mot."%' ";
		}
		if($idProjet!="") {
		$sqlPlus .=" AND p.id_projet=".$idProjet." ";
		}






		$sql="SELECT * FROM egw_projet p
		LEFT JOIN apsie_comptes c ON p.id_coordinateur=c.account_id
		 where 1 ".$sqlPlus." order by intitule_projet desc";
	
		
		return $conn->fetchAll($sql);
		

	}
	function getProjetEntreprise($idProjet)
	{
		global $conn;
		$sql="SELECT * FROM egw_organisation 
		 where id_projet =".$idProjet." AND categorie_org=292";
		//echo $sql;

		return $conn->fetchRow($sql);
	}

	function insertProjet()
	{
		global $conn;

		$data['id_owner'] = $_SESSION['UTILISATEUR']['account_id'];
		
		$data['resultat'] = $this->resultat;
		$data['statut'] = $this->statut;
		

		$data['date_debut'] = $this->date_debut;
		
		$data['date_fin_previsionnelle'] = $this->date_fin_previsionnelle;
		
		$data['description_projet'] = $this->description;

		$data['id_coordinateur'] = $this->referent;
		
		
	
		//print_r($data);
		if($this->id_projet==null)
		{
			$data['date_creation'] = time();
			$data['intitule_projet'] = date("Ym",$this->date_debut).'_'.$this->categorie.'_'.$this->nom_contact;
		$conn->insert('egw_projet',$data);
		}
		else
		{
			$data['date_last_modified'] = time();
			$data['date_fin_reelle'] = $this->date_fin;
		$conn->update('egw_projet',$data,'id_projet='.$this->id_projet);
		}

	}
	public function getProjetByPresta($id_presta)
	{
		global $conn;
	$sql="SELECT * FROM egw_prestation pt
		LEFT JOIN egw_projet pj ON pt.id_projet = pj.id_projet
		where pt.id_presta=".$id_presta."";
		return $conn->fetchRow($sql);
		
	}
}

?>