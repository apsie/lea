<?php

class dispositif extends Zend_Db_Table_Abstract
{
	public $id_dispositif = null;
	public $nom_dispositif;
	public $numero_marche;
	public $objet;
	public $date_debut;
	public $date_fin;
	public $is_active;



	function getDispositif($is_active="",$id_dispositif="")
	{
		global $conn;
		$sqlPlus="";
		
		if($is_active!="")
		{
			$sqlPlus = " AND is_active=".$is_active." ";
		}
		if($id_dispositif!="") {
		$sqlPlus .=" AND id_dispositif=".$id_dispositif." ";
		}

		$sql="SELECT * FROM egw_dispositif where 1 ".$sqlPlus." order by date_debut desc";
	
		
		return $conn->fetchAll($sql);
		

	}
	
	function insertDispositif()
	{
		global $conn;

		
		
		$data['nom_dispositif'] = $this->nom_dispositif;
		$data['id_dispositif'] = $this->id_dispositif ;
		$data['numero_marche'] = $this->numero_marche ;
		$data['objet'] = $this->objet ;
		$data['date_debut'] = $this->date_debut ;
		$data['date_fin'] = $this->date_fin ;
		$data['is_active'] = $this->is_active ;
		
		
		
	
		//print_r($data);
		if($this->id_dispositif==null)
		{
			
		$conn->insert('egw_dispositif',$data);
		}
		else
		{
			
		$conn->update('egw_dispositif',$data,'id_dispositif='.$this->id_dispositif);
		}

	}
	
}

?>