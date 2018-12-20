<?php 
class texte
{
	
	
	public static  function getKey()
	{
		global $conn;
		$sql="SELECT * FROM apsie_texte_key order by libelle asc";
		//die($sql);
		$data=$conn->fetchAll($sql);
		return $data;
		
	}
	public static  function addTexte($data)
	{
		global $conn;
		
		if($data['id_texte']!=null)
		{
		$id_texte = $data['id_texte'];
		unset($data['id_texte']);
		$conn->update('apsie_texte',$data,'id_texte='.$id_texte);
		return 'Le texte <strong>'.utf8_encode($data['texte']).'</strong> a été modifié';
		}
		else
		{
		$conn->insert('apsie_texte', $data);
		return 'Le texte <strong>'.utf8_encode($data['texte']).'</strong> a été ajouté';
		}
	}
	public static  function getTexte($params)
	{
		global $conn;
		
		if($params['texte']!=null && isset($params['texte']))
		$sqlPlus .=' AND texte="'.$params['texte'].'"';
		
		if($params['id_texte_key']!=null && isset($params['id_texte_key']))
		$sqlPlus .=' AND t.id_texte_key="'.$params['id_texte_key'].'"';
		
		if($params['id_texte']!=null && isset($params['id_texte']))
		$sqlPlus .=' AND t.id_texte="'.$params['id_texte'].'"';
		
		$sql="SELECT * FROM apsie_texte t
		LEFT JOIN apsie_texte_key k
		ON k.id_texte_key = t.id_texte_key WHERE 1 
		".$sqlPlus."
		 order by libelle,texte asc";
		//die($sql);
		$data=$conn->fetchAll($sql);
		return $data;
	}
	public static  function delTexte($id)
	{
		global $conn;
		$conn->delete('apsie_texte','id_texte='.$id);
		
	}
	public static function getOptionByIdTexte($data)
	{
		foreach ($data as $key => $row):
			$newData[$row['id_texte_key']] .= '<option class="text_option" value="'.utf8_encode($row['texte']).'">'.utf8_encode($row['texte']).'</option>';
		endforeach;
		return $newData;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function selectioinner_texte($champ,$select="asc",$sous_famille='',$option1="")
	{
		global $conn;
		
		if($sous_famille!=NULL and is_numeric($sous_famille))
		{
			$requete='SELECT * FROM egw_epce_texte   where id_sous_famille='.$sous_famille.' and  intitule="'.$champ.'" order by  valeur '.$select.'';
			}
		else
		{
	    $requete='SELECT * FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur '.$select.'';
		}
		
		
		$result=$conn->fetchAll($requete);

		$str="<option>".$option1."</option>";
	for($i=0;$i<count($result);$i++)
	{
			
			$str.='<option value="'.trim($result[$i]['valeur']).'">'.trim($result[$i]['valeur']).'</option>';
			
			
			
		}
		return utf8_encode($str);
	
	
	}
	
	#v2
	function get($champ,$select="asc",$sous_famille='')
	{
		global $conn;
		
		if($sous_famille!=NULL and is_numeric($sous_famille))
		{
			$requete='SELECT * FROM egw_epce_texte   where id_sous_famille='.$sous_famille.' and  intitule="'.$champ.'" order by  valeur '.$select.'';
			}
		else
		{
	    $requete='SELECT * FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur '.$select.'';
		}
		
		
		$result=$conn->fetchAll($requete);

		$str="<option class='text_option_blanc'></option>";
	for($i=0;$i<count($result);$i++)
	{
			
			$str.='<option class="text_option" value="'.trim($result[$i]['valeur']).'">'.trim($result[$i]['valeur']).'</option>';
			
			
			
		}
		return utf8_encode($str);
	
	
	}
	
	public function texte_id($id)
	{
		
	global $conn;
	
	    $requete='SELECT valeur FROM  egw_epce_texte  where id="'.$id.'" order by  valeur asc';
		$result=$conn->fetchRow($requete);
		return $result['valeur'];
	
	}	
}


?>