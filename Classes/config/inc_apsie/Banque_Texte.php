<?php
include('config/config.php');

/**
 * @access public
 */
class Banque_Texte {

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
		
	}
	
		public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	public function selectionner_texte($champ,$table='egw_epce_texte') {
		// Not yet implemented
		   $requete='SELECT * FROM  '.$table.'   where intitule="'.$champ.'" order by  valeur asc';
		return $GLOBALS['db']->fetchAll($requete);
		
	}
	public function texte_id($id,$table='egw_epce_texte')
	{
		
	
	
	    $requete='SELECT valeur FROM  '.$table.'   where id="'.$id.'" order by  valeur asc';
		$result=$GLOBALS['db']->fetchRow($requete);
		return $result['valeur'];
	
	}	
	
	public function voir_texte($intitule, $mot, $ligne=0,$limit=50)
	{
		if(strlen($mot)>=2)
	{ 
	if($intitule=='')
	{
	$requete='SELECT * FROM  egw_epce_texte where intitule like "%'.$mot.'%" or valeur like"%'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';
	}
	else
	{
	$requete='SELECT * FROM  egw_epce_texte where intitule = "'.$intitule.'" and (valeur like "%'.$mot.'%") order by intitule asc limit '.$ligne.','.$limit.'';
	}
	}
	elseif(strlen($mot)==1)
	{ 
	if($intitule=='')
	{
	$requete='SELECT * FROM  egw_epce_texte where valeur like "'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';
	}
	else
	{				
	$requete='SELECT * FROM egw_epce_texte where intitule = "'.$intitule.'" AND valeur like "'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';
	}
	}
	else
	{
		
		/*$requete='SELECT * FROM  egw_epce_texte where valeur like "%'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';*/
		if($intitule=='')
	{
		
	$requete='SELECT * FROM  egw_epce_texte where valeur like "%'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';
	}
	else
	{		
	$requete='SELECT * FROM  egw_epce_texte where intitule = "'.$intitule.'"  and valeur like "%'.$mot.'%" order by intitule asc limit '.$ligne.','.$limit.'';
	}
	}
		
		/*$requete='SELECT * FROM  egw_epce_texte order by intitule asc limit '.$ligne.','.$limit.'';*/
		$result=$GLOBALS['db']->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
	{
		
		  $valeur=$result[$i]['valeur'];

		if($i%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		echo '<tr bgcolor='.$color.'> 
		<td>'.$result[$i]['id'].'</td>
		<td>'.$result[$i]['intitule'].'</td>
		<td>'.$result[$i]['valeur'].'</td>
		<td class="body" align="center">

<a onclick="window.open(\'modifier.php?id='.$result[$i]['id'].'\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=600, height=470\');"  href="" ><img src="index.php_fichiers/edit.png" title="Modifier" border="0"></a>';
   
  echo'<a href="javascript:if(confirm(\'Etes vous sur de vouloir supprimer cette banque de texte ?\')) document.location.href=\'index.php?id_texte_delete='.$result[$i]['id'].'&domain=default\'" ><img src="index.php_fichiers/delete.png" title="Supprimer cette banque de texte" border="0"></a>';
 
	}
		
	}
		
	public function nbr_ligne_texte($intitule, $mot)
	{
		/*$requete='SELECT * FROM egw_epce_texte ';
		
		$result=$GLOBALS['db']->fetchAll($requete);
		return count($result);		*/
		
	if(strlen($mot)>=2)
	{ 
	if($intitule=='')
	{
	$requete='SELECT * FROM  egw_epce_texte where intitule like "%'.$mot.'%" or valeur like"%'.$mot.'%"';
	}
	else
	{
	$requete='SELECT * FROM  egw_epce_texte where intitule = "'.$intitule.'" and (valeur like "%'.$mot.'%")';
	}
	}
	elseif(strlen($mot)==1)
	{ 
	if($intitule=='')
	{
	$requete='SELECT * FROM  egw_epce_texte where valeur like "'.$mot.'%"';
	}
	else
	{				
	$requete='SELECT * FROM egw_epce_texte where intitule = "'.$intitule.'" AND valeur like "'.$mot.'%"';
	}
	}
	else
	{
		/*$requete='SELECT * FROM  egw_epce_texte where valeur like "%'.$mot.'%"';*/
		
		
		if($intitule=='')
	{
	$requete='SELECT * FROM  egw_epce_texte where valeur like "%'.$mot.'%"';
	}
	else
	{		
	$requete='SELECT * FROM  egw_epce_texte where intitule = "'.$intitule.'" and valeur like "%'.$mot.'%"';
	}
	}
		$result=$result=$GLOBALS['db']->fetchAll($requete);
		return count($result);
			
		}
	
	function lister_categorie()
	{
	
			$requete='SELECT distinct intitule from egw_epce_texte order by intitule asc';
			$result=$GLOBALS['db']->fetchAll($requete);

		for($i=0;$i<count($result);$i++)
		{
			$nom_categorie=$result[$i]['intitule'];	
					
				echo '<option value="'.$nom_categorie.'">'.$nom_categorie.'</option>';
		}		
		
	}
	
	//Récuperer le nom de catégorie par l'id
	function get_nom_categorie($id)
	{
	
			$requete='SELECT intitule from egw_epce_texte where id='.$id.'';
			$result=$GLOBALS['db']->fetchRow($requete);
			return $result['intitule'] ;
			
	}
	
	//Récuperer le nom de valeur par l'id
	function get_nom_valeur($id)
	{
	
			$requete='SELECT valeur from egw_epce_texte where id='.$id.'';
			$result=$GLOBALS['db']->fetchRow($requete);
			return $result['valeur'] ;
			
	}
	
	//Modifier une banque de texte
	
	function update_banque_texte($id, $intitule, $valeur)
	{
		$data = array('intitule'=> $intitule, 'valeur'=> $valeur);
		
		$GLOBALS['db']->update('egw_epce_texte',$data,'id='.$id.'');
		
	}
	
	
	//Ajouter une banque de texte
	
	function insert_banque_texte($intitule, $valeur)
	{
		$data = array('intitule'=> $intitule, 'valeur'=> $valeur);
		
		$GLOBALS['db']->insert('egw_epce_texte',$data);
		
	}
	
	function delete_banque_texte($id)
	{
	$data = array('id='.$id);
	$GLOBALS['db']->delete('egw_epce_texte',$data);
		
	}
	
	
	
	/**
	 * @access public
	 */
	public function __destruct() {
		// Not yet implemented
	}
	
}
?>