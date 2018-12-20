<?php

class evenement
{		
	public $conn;
	
	public function __construct($conn)
		{
			$this->conn = $conn;
			

		}
		function getListEvenement($id_referent,$statut,$id_evenement,$is_read)
		{
			
			if($id_referent==0  || $id_referent=="")
			{$sqlPlus ="";}
			else {$sqlPlus =" AND id_referent=".$id_referent."";}
			if($id_evenement==0  || $id_evenement=="")
			{$sqlPlus .="";}
		else {$sqlPlus .=" AND id_evenement=".$id_evenement."";}
		if($statut=='null'  || $statut=="")
			{$sqlPlus.="";}
			else {$sqlPlus.=' AND statut="'.utf8_decode($statut).'"';}
		if($is_read=='null'  || $is_read=="")
			{$sqlPlus.="";}
			else {$sqlPlus.=' AND is_read='.$is_read.'';}
			$sql="SELECT c2.account_firstname as account_firstname_ow,c2.account_lastname as account_lastname_ow,co.email_pro,co.email_perso,co.tel_pro_1,co.tel_domicile_1,co.portable_perso,ev.type_evenement,ev.is_read,ev.statut,ev.degre,ev.observations,
			ev.objet,ev.date_last_modified,ev.date_creation,ev.id_evenement,
			c.account_firstname,c.account_lastname,co.fonction,
			co.nom,co.prenom FROM egw_evenement ev
			LEFT JOIN apsie_comptes c ON ev.id_referent = c.account_id
			LEFT JOIN apsie_comptes c2 ON ev.id_owner = c2.account_id
			LEFT JOIN egw_contact co ON co.id_ben = ev.id_contact
			WHERE 1 ".$sqlPlus."
			ORDER BY ev.date_creation desc";
			//echo $sql;
			
			return $this->conn->fetchAll($sql);
		}
		function getNbNewEvent($id_referent)
		{
			$sql="SELECT count(*) AS NB from egw_evenement where id_referent=".$id_referent." and is_read=0";
			
		    $data = $this->conn->fetchRow($sql);
			return $data['NB'];
		}
		function getHistoriqueEvenement($id_evenement)
		{
			$sql="SELECT aed.*,c.account_firstname,c.account_lastname FROM egw_evenement_details aed
			LEFT JOIN apsie_comptes c ON aed.id_conseiller = c.account_id
			WHERE id_evenement=".$id_evenement."";
			return $this->conn->fetchAll($sql);
		}
		function addMessage($id_referent,$id_evenement,$message)
		{
			$data['id_conseiller'] = $id_referent;
			$data['id_evenement'] = $id_evenement;
			$data['message'] = utf8_decode($message);
			$data['date'] = time();
			$this->conn->insert('egw_evenement_details',$data);
		}
		function updateEvenement($id_evenement,$data)
		{
			$this->conn->update('egw_evenement',$data,'id_evenement='.$id_evenement);
		}
		function addEvenement($data)
		{
			$this->conn->insert('egw_evenement',$data);
		}
function getListNewEvent($id_referent)
		{
			$sql="SELECT e.*,c.nom_complet from egw_evenement e 
			LEFT JOIN egw_contact c ON c.id_ben = e.id_contact
			where id_referent=".$id_referent." and is_read=0";
			
			
		   return $this->conn->fetchAll($sql);
			
		}
}


?>