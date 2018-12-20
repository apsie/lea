<?php

class organisation
{
	
	 public $table_dispositif = "egw_dispositif";
	 public $table_critere = "egw_critere";
	 public $table_objectif = "egw_objectif";
	 public $table_prestation = "egw_prestation";
	 public $table_organisation = "egw_organisation";
	 public $table_accounts= "egw_accounts";
	 public $table_contact= "egw_contact";
	 // Spirea : note  attention valeur en dur
	 public $cat_employeurs= 246;
	 public $cat_formations= 254;
	 public $cat_financements= 240;
	 public $cat_conseils_generaux= 263;
	 public $cat_conseils_regionaux= 264;
	 public $cat_certifications= 255;
	 public $cat_prescripteurs= 235;
	 public $cat_accompagnements = 241; 
	 public $cat_institutionnelles = 262;
	 public $cat_beneficiaire = 244;
	 public $cat_employeur = 257;
	 public $cat_staff_apsie = 77;
	 public $cat_usager_06 = 165;
	 public $cat_usager_07 = 84;	
	 public $cat_usager_08 = 156;
	 public $cat_usager_09 = 219;
	 public $cat_accompagnement = 260;
	 public $cat_financement = 261;
	 public $cat_institutionnel = 269;
	 public $cat_fournisseur= 271;
	 public $cat_apsie= 285;
	 public $cat_stragefi= 286;
	
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
	
	function get_organisation($id_organisation)
	{
	
		$requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation ='.$id_organisation.'';
	    $result=$this->db->fetchRow($requete);
		return $result['nom_organisme'];
	}
	
	function get_categorie($cat_id)
	{
				
				if($cat_id!=NULL)
				{
				$requete='SELECT * FROM  egw_categories where cat_id='.$cat_id.'';
				$result=$this->db->fetchRow($requete);
				echo'<option value='.$result['cat_id'].'>'.$result['cat_name'].'</option>';
				}
				else
				{
				echo'<option ></option>';
				}
	}
	
	function nbr_organisation($categorie, $mot='') {
		if(strlen($mot)>=2)
		{ 
			if($categorie==NULL)
			{
			$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme 
		like "%'.$mot.'%" or cp like"%'.$mot.'%" or ville like "%'.$mot.'%" or tel like "%'.$mot.'%" or fax like "%'.$mot.'%" or email like "%'.$mot.'%"';
			}
			else
			{
			$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%" and (nom_organisme like "%'.$mot.'%" or cp like"%'.$mot.'%" or ville like "%'.$mot.'%" or tel like "%'.$mot.'%" or fax like "%'.$mot.'%" or email like "%'.$mot.'%" )';
				
			}
		}
		elseif(strlen($mot)==1)
		{ 
			if($categorie=='')
			{
			$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme like "'.$mot.'%"';
			}
			else
			{
				
				
			$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%" AND nom_organisme like "'.$mot.'%"';

				
			}
		}
		else
		{
			if($categorie=='')
			{
			$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme like "%'.$mot.'%"';
			}
			else
			{
				
				
			$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%"  and nom_organisme like "%'.$mot.'%"';
			}
		}
			$result=$this->db->fetchAll($requete);
			return count($result);
	}
	
	function voir_organisation($categorie, $mot='a',$ligne=0,$limit=50,$id_compte,$tri='nom_organisme',$cla='asc') {
	/*
	* Spirea - fonction de requete et listage des organisations
	*/
	
	if(strlen($mot)>=2)
	{  
		if($categorie=='')
		{
		$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme 
	like "%'.$mot.'%" or cp like"%'.$mot.'%" or ville like "%'.$mot.'%" or tel like "%'.$mot.'%" or fax like "%'.$mot.'%" or email like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
		else
		{		
		$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%" and (nom_organisme like "%'.$mot.'%" or cp like"%'.$mot.'%" or ville like "%'.$mot.'%" or tel like "%'.$mot.'%" or fax like "%'.$mot.'%" or email like "%'.$mot.'%") order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';	
		}
	}
	elseif(strlen($mot)==1)
	{
		if($categorie=='')
		{
		$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme like "'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
		else
		{				
		$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%" AND (nom_organisme like "'.$mot.'%") order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
	}
	else
	{
		if($categorie=='')
		{
		$requete='SELECT * FROM  '.$this->table_organisation.' where nom_organisme like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
		else
		{
		$requete='SELECT * FROM  '.$this->table_organisation.' where categorie_org like "%'.$categorie.'%"  and nom_organisme like "%'.$mot.'%" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
		}
	}
	
	$result=$this->db->fetchAll($requete);
	// fin requête - mise en forme du tableau
	//_debug_array($result);
	
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
		$cat=$result[$i]['categorie_org'];
		if(ereg($this->cat_formations,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_formations,"<img title='Organisme de formation' src='images/home_16.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_certifications,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_certifications,"<img title='Organisme de certification' src='images/house.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_employeurs,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_employeurs,"<img width='20' height='20' title='Employeur' src='images/listes-employeurs.jpg'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_prescripteurs,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_prescripteurs,"<img width='20' height='20' title='Prescripteur' src='images/prescripteur.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_financements,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_financements,"<img width='20' height='20' title='Organisme financement' src='images/money_euro.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_accompagnements,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_accompagnements,"<img width='20' height='20' title='Organisme accompagnement' src='images/hand.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_institutionnelles,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_institutionnelles,"<img width='20' height='20' title='Institutionnelles' src='images/institutionnelles.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_conseils_generaux,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_conseils_generaux,"<img  title='Conseils généraux' src='images/conseils_generaux.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_conseils_regionaux,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_conseils_regionaux,"<img width='20' height='20' title='Conseils régionaux' src='images/conseils_regionaux.png'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_apsie,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_apsie,"<img width='40' height='20' title='Agence apsie' src='images/logo_apsie.jpg'>",$result[$i]['categorie_org']);
		
		}
		elseif(ereg($this->cat_stragefi,$result[$i]['categorie_org']))
		{
			$result[$i]['categorie_org']=str_replace($this->cat_stragefi,"<img width='20' height='20' title='Agence stragefi' src='images/logo_stragefi.jpg'>",$result[$i]['categorie_org']);
		
		}
		else
		{
			$result[$i]['categorie_org']= "<img title='Autre' src='images/autre.png'>";
		}
		
		
	/*	if(ereg("APSIE",$result[$i]['nom_organisme']))
		{
			$result[$i]['categorie_org']="<img width='20' height='20' title='Employeur' src='images/listes-employeurs.jpg'>";
		
		}*/
		
		echo'<tr bgcolor='.$color.'><td>'.$result[$i]['categorie_org'].'</td><td  height="21">
   <a href="details.php?id_organisation='.$result[$i]['id_organisation'].'&domain=default&nom_organisme='.$result[$i]['nom_organisme'].'">'.$result[$i]['nom_organisme'].'</a>
  </td>
  <td  height="21">
  '.$result[$i]['cp'].'   
 </td>
  <td height="21">
  '.$result[$i]['ville'].'
 </td>
  <td  height="21">
  '.$result[$i]['tel'].'</font>
  </td>
  <td  height="21">
     '.$result[$i]['fax'].'</font>
  </td>  <td height="21">
     '.$result[$i]['email'].'</font>
  </td>
  
<td class="body"><a href="details.php?id_organisation='.$result[$i]['id_organisation'].'&domain=default&nom_organisme='.$result[$i]['nom_organisme'].'"><img src="index.php_fichiers/view.png" title="Voir" border="0"></a> <a onclick="window.open(\'modifier.php?categorie='.$cat.'&id_organisation='.$result[$i]['id_organisation'].'&domain=default&nom_organisme='.$result[$i]['nom_organisme'].'\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=600, height=470\');"  href="" ><img src="index.php_fichiers/edit.png" title="Modifier" border="0"></a> <a href="lier.php?id_organisation='.$result[$i]['id_organisation'].'&domain=default&nom_organisme='.$result[$i]['nom_organisme'].'"><img src="images/group.png" title="ajouter un membre" border="0"></a></td>
</tr>


';	
		}
		echo'</table></center>';
	}
	
	function nbr_salaries($id_organisation)
	{
		
		$requete='SELECT * FROM  '.$this->table_contact.' where id_organisation like "%'.$id_organisation.'%"';
		    
		$result=$this->db->fetchAll($requete);
		return count($result);
		

	}
	
	function voir_detail_orga($id_organisation)
	{
	$requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation='.$id_organisation.' order by id_organisation desc limit 1';
				
		$result=$this->db->fetchRow($requete);

	
		echo '<center><div style="float:none; width:33%"><table><tr><td width="342"><center>
         <strong>DETAILS ORGANISME</strong>
</center></td></tr></table><table style=" background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
 
  
  <td width="136">Rue </td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_1'].'</td></tr><tr>
  <td width="136">Adresse ligne 2</td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_2'].'</td></tr><tr>
  <td width="136">Adresse ligne 3</td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_3'].' </td></tr><tr>
  <td width="136">Code postal</td><td>:<td></td>
<td width="192">'.$result['cp'].'</td></tr><tr>
  <td width="136">Ville</td><td>:<td></td>
<td width="192">'.$result['ville'].'</td></tr><tr>
  <td width="136">R&eacute;gion</td><td>:<td></td>
<td width="192">'.$result['region'].'</td></tr><tr>
  <td width="136">Pays</td>
  <td>:<td></td>
<td width="192">'.$result['pays'].'</td></tr><tr>
  <td width="136">Tél</td>
  <td>:<td></td>
<td width="192">'.$result['tel'].'</td></tr><tr>
  <td width="136">Fax</td>
  <td>:<td></td>
<td width="192">'.$result['fax'].'</td></tr><tr>
  <td width="136">Email</td>
  <td>:<td></td>
<td width="192">'.$result['email'].'</td></tr>
<tr>
  <td width="136">Site Web</td>
  <td>:<td></td>
<td width="192">'.$result['site_web'].'</td></tr>
</table></div></center>  <br/>  ';
		
	}
	
	function voir_membres($id_organisation)
	{
		
			$requete='SELECT * FROM  '.$this->table_contact.' where id_organisation like "%'.$id_organisation.'%" order by nom_complet asc';
				
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
		elseif(ereg($this->cat_employeur,$result[$i]['cat_id']))
		{
			$icons='<img title="Contact employeur" src="images/hire-me.png" />';
		}
		elseif(ereg($this->cat_staff_apsie,$result[$i]['cat_id']))
		
		{
			$icons='<img title="Staff Apsie" src="images/user_business.png" />';
		}
		elseif(ereg($this->cat_usager_06,$result[$i]['cat_id']))	
		{			
			$icons='<img title="Usager_06" src="images/user_usager_06.png" />';
		}
		elseif(ereg($this->cat_usager_07,$result[$i]['cat_id']))
		{
			$icons='<img title="Usager_07" src="images/user_usager_07.png" />';
		}
		elseif(ereg($this->cat_usager_08,$result[$i]['cat_id']))
		{
			$icons="<img title='Usager_08' src='images/user_usager_08.png' />";
		}
		elseif(ereg($this->cat_usager_09,$result[$i]['cat_id']))
		{
			$icons="<img title='Usager_09' src='images/user_usager_09.png' />";
		}
		elseif(ereg($this->cat_accompagnement,$result[$i]['cat_id']))
		{
			$icons="<img title='Contact organisme accompagnement' src='images/organisme_accompagnement.png' />";
		}
		elseif(ereg($this->cat_financement,$result[$i]['cat_id']))
		{
			$icons="<img title='Contact organisme financement' src='images/organisme_financement.png' />";
		}
		elseif(ereg($this->cat_institutionnel,$result[$i]['cat_id']))
		{
			$icons="<img title='Contact institutionnel' src='images/institutionnel.png' />";
		}
			else
		{
			$icons='<img  title="Autre" src="images/user_silhouette.png" />';
		}
		
		echo'<tr bgcolor='.$color.'><td>'.$icons.'</td><td  height="21">
   '.$result[$i]['nom_complet'].'
  </td> <td  height="21">
  '.$result[$i]['fonction'].'   
 </td>
  <td  height="21">
  '.$result[$i]['cp'].'   
 </td>
  <td height="21">
  '.$result[$i]['ville'].'
 </td>
 
  <td  height="21">
     '.$result[$i]['tel_pro_1'].'</font>
  </td>  <td height="21">
     '.$result[$i]['portable_perso'].'</font>
  </td>
  
<td class="body"><a onclick="window.open(\'../'.$GLOBALS['version_contact'].'/voir.php?domain=default&id_ben='.$result[$i]['id_ben'].'\',\'Voir un contact\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=800, height=400\');"  href="javascript::void()"><img src="index.php_fichiers/view.png" title="Voir" border="0"></a></td>
</tr>


';	
		}
		echo'</table></center>';
	}
	
	
	
	function get_orga($id_organisation) {
	/*
	* Spirea : recherche individuelle d'une organisation par son id
	* Appel depuis page inde
	*/
		
		$requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation like "%'.$id_organisation.'%"';
		$result=$this->db->fetchRow($requete);
		
		return array($result['categorie_org'],$result['code_org'],$result['adresse_ligne_1'],$result['adresse_ligne_2'],$result['adresse_ligne_3'],$result['cp'],$result['ville'],$result['region'],$result['pays'],$result['tel'],$result['fax'],$result['email'],$result['site_web'],$result['nom_organisme']);
	
	}
		
	function update_organisation($id_organisation, $id_owner, $date_last_modified, $categorie, $code_org, $adresse_ligne_1, $adresse_ligne_2, $adresse_ligne_3, $cp, $ville, $region, $pays, $tel, $fax, $email, $site_web)
	{
		
  $data = array('id_modifier' => $id_owner, 'date_last_modified' => time(),'categorie_org' => $categorie , 'code_org'=> $_GET['code_org'] ,'adresse_ligne_1' => $_GET['adresse_ligne_1'], 'adresse_ligne_2'=> $_GET['adresse_ligne_2'], 'adresse_ligne_3'=> $_GET['adresse_ligne_3'], 'cp'=> $_GET['cp'], 'ville'=> $_GET['ville'], 'region'=> $_GET['region'], 'pays'=> $_GET['pays'], 'tel'=> $_GET['tel'], 'fax'=> $_GET['fax'], 'email'=> $_GET['email'], 'site_web'=> $_GET['site_web']);
				
	$this->db->update($this->table_organisation,$data,'id_organisation='.$id_organisation.'');
	}
	
	
	function ajouter_organisation($id_owner, $date_creation, $id_owner, $date_last_modified, $categorie_org, $code_org, $nom_organisme, $adresse_ligne_1, $adresse_ligne_2, $adresse_ligne_3, $cp, $ville, $region, $pays, $tel, $fax, $email, $site_web)
	{
	$data = array('id_owner' => $id_owner, 'date_creation' => time(), 'id_modifier' => $id_owner, 'date_last_modified' => time(),'categorie_org' => $_GET['categorie_org'] , 'code_org'=> $_GET['code_org'], 'nom_organisme' => $_GET['nom_organisme'], 'adresse_ligne_1' => $_GET['adresse_ligne_1'], 'adresse_ligne_2'=> $_GET['adresse_ligne_2'], 'adresse_ligne_3'=> $_GET['adresse_ligne_3'], 'cp'=> $_GET['cp'], 'ville'=> $_GET['ville'], 'region'=> $_GET['region'], 'pays'=> $_GET['pays'], 'tel'=> $_GET['tel'], 'fax'=> $_GET['fax'], 'email'=> $_GET['email'], 'site_web'=> $_GET['site_web']);
				
	$this->db->insert($this->table_organisation,$data);
	}

function trouve_contact($mot,$id_organisation,$limit="50")
	{
	$requete='SELECT * FROM  '.$this->table_contact.' where nom like "%'.$mot.'%" order by nom asc limit '.$limit.'';
	
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
		elseif(ereg($this->cat_employeur,$result[$i]['cat_id']))
		{
			$icons='<img title="Contact employeur" src="images/hire-me.png" />';
		}
		elseif(ereg($this->cat_staff_apsie,$result[$i]['cat_id']))
		
		{
			$icons='<img title="Staff Apsie" src="images/user_business.png" />';
		}
			else
		{
			$icons='<img  title="Autre" src="images/user_silhouette.png" />';
		}
		echo'<tr bgcolor='.$color.'> <td>'.$icons.'</td> </td>
  <td  height="21">
    '.$result[$i]['nom_complet'].'
  </td>
  <td  height="21">
    '.$result[$i]['cp'].'</font>
  </td>
  <td  height="21">
     '.$result[$i]['ville'].'</font>
  </td>  <td height="21">
     '.$result[$i]['pays'].'</font>
  </td>
  <td  height="21">
    '.$result[$i]['tel_pro_1'].'</font>
  </td>
   <td  height="21">
    '.$result[$i]['portable_perso'].'</font>
  </td>

  <td class="body"><input type="button" value="lier" onClick="window.location.href=\'lier.php?domain=default&id_ben_a_lier='.$result[$i]['id_ben'].'&id_organisation='.$id_organisation.'\'" /></td>
</tr>';
			
		}
		echo'</table></center>';
		
	}
	function voir_detail_orga_lier($id_organisation)
	{
	$requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation='.$id_organisation.' order by id_organisation desc limit 1';
				
		$result=$this->db->fetchRow($requete);

	
		echo '<center><div style="float:none; width:33%"><table><tr><td width="342"><center>
         
</center></td></tr></table><table style=" background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
 
  <tr>
  <td width="136">Rue </td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_1'].'</td></tr><tr>
  <td width="136">Adresse ligne 2</td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_2'].'</td></tr><tr>
  <td width="136">Adresse ligne 3</td><td>:<td></td>
<td width="192">'.$result['adresse_ligne_3'].' </td></tr><tr>
  <td width="136">Code postal</td><td>:<td></td>
<td width="192">'.$result['cp'].'</td></tr><tr>
  <td width="136">Ville</td><td>:<td></td>
<td width="192">'.$result['ville'].'</td></tr><tr>
  <td width="136">R&eacute;gion</td><td>:<td></td>
<td width="192">'.$result['region'].'</td></tr><tr>
  <td width="136">Pays</td>
  <td>:<td></td>
<td width="192">'.$result['pays'].'</td></tr><tr>
  <td width="136">Tél</td>
  <td>:<td></td>
<td width="192">'.$result['tel'].'</td></tr><tr>
  <td width="136">Fax</td>
  <td>:<td></td>
<td width="192">'.$result['fax'].'</td></tr><tr>
  <td width="136">Email</td>
  <td>:<td></td>
<td width="192">'.$result['email'].'</td></tr>
<tr>
  <td width="136">Site Web</td>
  <td>:<td></td>
<td width="192">'.$result['site_web'].'</td></tr>
</table></div></center>  <br/>  ';
		
	}
	
	 function return_ids_organisme($id_ben)
	{
		
	   $requete='SELECT id_organisation FROM  '.$this->table_contact.'  where id_ben='.$id_ben.'';
	
		$result=$this->db->fetchRow($requete);
        return $result['id_organisation'];	
	}
	
	
	
	function inserer_id_organisation($id_ben, $id_organisation, $id_owner)
	{
		
		if ($this->return_ids_organisme($id_ben)!=0 and ereg($this->return_ids_organisme($id_ben),$id_organisation)){
	return 1;	
		
		
}


if($this->return_ids_organisme($id_ben)!=0 and substr_count($this->return_ids_organisme($id_ben),$id_organisation)==0)
	{
		$new_id_organisation=$this->return_ids_organisme($id_ben).','. $id_organisation;
		
	}
	elseif(substr_count($this->return_ids_organisme($id_ben),$id_organisation)==0)
	{
		
	$new_id_organisation= $id_organisation;
	
	}
	
	$data = array('id_organisation' => $new_id_organisation  , 'id_modifier'=> $id_owner , 'date_last_modified'=> time());
	$this->db->update($this->table_contact,$data,'id_ben='.$id_ben);
	/*else
	{
	$new_id_organisation=$this->return_ids_organisme($id_ben);
	}	*/																					 
	
	}
	function ajouter_contact_a_lier($id_organisation, $id_owner, $cat_id, $nom, $prenom, $deuxieme_prenom, $nom_jeune_fille, $civilite, $adresse_ligne_1, $adresse_ligne_2, $adresse_ligne_3, $ville, $region, $cp, $pays, $tel_pro_1, $tel_pro_2, $tel_domicile_1, $tel_domicile_2, $fax_pro, $fax_perso, $portable_pro, $portable_perso, $email_pro, $email_perso, $site_perso)
		{
		
			if($cat_id=="apsie")
		{
			$cat_id = $this->cat_staff_apsie;
		}
		elseif($cat_id=="Contact_prescripteur")
		{
			$cat_id = $this->cat_prescripteur;
		}
		elseif($cat_id=="Contact_employeur")
		{
			$cat_id = $this->cat_employeur;
		}
		elseif($cat_id=="Usager_06")
		{
			$cat_id = $this->cat_usager_06;
		}
		elseif($cat_id=="Usager_07")
		{
			$cat_id = $this->cat_usager_07;
		}
		elseif($cat_id=="Usager_08")
		{
			$cat_id = $this->cat_usager_08;
		}
		elseif($cat_id=="Usager_09")
		{
			$cat_id = $this->cat_usager_09;
		}		
		elseif($cat_id=="Usager_10")
		{
			$cat_id = $this->cat_beneficiaire;
		}
		elseif($cat_id=="Contact org_accompagnement")
		{
			$cat_id = $this->cat_accompagnement;
		}
		elseif($cat_id=="Contact org_financement")
		{
			$cat_id = $this->cat_financement;
		}
		elseif($cat_id=="Contact_fournisseur")
		{
			$cat_id = $this->cat_fournisseur;
		}
		elseif($cat_id=="Contact institutionnel")
		{
			$cat_id = $this->cat_institutionnel;
		}
		
		
	$data = array('id_organisation' => $id_organisation, 'id_owner' => $id_owner, 'date_creation' => time(), 'id_modifier' => $id_owner, 'date_last_modified' => time(),'cat_id' => $cat_id, 'nom_complet' => $civilite.' '.$nom.' '.$prenom, 'nom' => $nom, 'prenom' => $prenom, 'deuxieme_prenom' => $deuxieme_prenom, 'nom_jeune_fille' => $nom_jeune_fille, 'civilite' => $civilite,  'adresse_ligne_1' => $adresse_ligne_1, 'adresse_ligne_2'=> $adresse_ligne_2, 'adresse_ligne_3'=> $adresse_ligne_3, 'ville'=> $ville, 'region'=> $region, 'cp'=> $cp, 'pays'=> $pays, 'tel_pro_1'=> $tel_pro_1, 'tel_pro_2'=> $tel_pro_2, 'tel_domicile_1'=> $tel_domicile_1, 'tel_domicile_2'=> $tel_domicile_2, 'fax_pro'=> $fax_pro, 'fax_perso'=> $fax_perso, 'portable_pro'=> $portable_pro, 'portable_perso'=> $portable_perso, 'email_pro'=> $email_pro, 'email_perso'=> $email_perso, 'site_perso'=> $site_perso);
				
	$this->db->insert($this->table_contact,$data);
		}
	function lister_categorie()
	{
	
			$requete='SELECT cat_name, cat_id from egw_categories where cat_appname like "addressbook" and cat_parent like "%272%"';
			$result=$this->db->fetchAll($requete);

		for($i=0;$i<count($result);$i++)
		{
			$nom_categorie=$result[$i]['cat_name'];	
			$id_categorie=$result[$i]['cat_id'];
			
				
				echo '<option value='.$id_categorie.'>'.$nom_categorie.'</option>';
		}		
		
	}
	function lister_categorie_contact()
	{
		$requete='SELECT cat_name, cat_id from egw_categories where cat_appname like "addressbook" and cat_parent like "259"';
			$result=$this->db->fetchAll($requete);

		for($i=0;$i<count($result);$i++)
		{
			$nom_categorie=$result[$i]['cat_name'];	
			$id_categorie=$result[$i]['cat_id'];
			
				echo '<option value="'.$id_categorie.'">'.$nom_categorie.'</option>';
		}		
	}

/*function recup_organisation($id_organisation, $nom_organisme)
	{
		
	$requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation like "%'.$id_organisation.'%"';
		
		
		
		$result=$this->db->fetchAll($requete);
		
		
	for($i=0;$i<count($result);$i++)
	{		
		
		if (ereg(254,$result[$i]['categorie_org']))
		{
		$nom_categorie='Organisme de formation';	
		}
		elseif(ereg(255,$result[$i]['categorie_org']))
		{
		$nom_categorie='Organisme de certification';
		}
		elseif(ereg(246,$result[$i]['categorie_org']))
		{
		$nom_categorie='Employeur';
		}
		elseif(ereg(235,$result[$i]['categorie_org']))
		{
		$nom_categorie='Prescripteur';
		}
		echo'<form method="get" name="modifier"><center><table style="border:1px solid #CCC" >
		<input name="id_organisation" value="'.$id_organisation.'" type="hidden">
		<input name="nom_organisme" value="'.$nom_organisme.'" type="hidden">
		<input name="categorie" value="'.$result[$i]['categorie_org'].'" type="hidden">
<tr bgcolor="#ECF3F4" >
<td width="200">Nom de l organisme</td><td >'.$nom_organisme.'</td>
</tr>
<tr bgcolor="#FFF">
<td>Catégorie de l organisme</td>'.$this->lister_categorie_modif().'</td>
</tr>
</tr>
<tr bgcolor="#ECF3F4">
<td>Code organisme</td><td><input name="code_org" type="text" value="'.$result[$i]['code_org'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Rue</td><td><input size="43" name="adresse_ligne_1" type="text" value="'.$result[$i]['adresse_ligne_1'].'" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><input size="43" name="adresse_ligne_2" type="text" value="'.$result[$i]['adresse_ligne_2'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><input size="43" name="adresse_ligne_3" type="text" value="'.$result[$i]['adresse_ligne_3'].'" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Code postal</td><td><input name="cp" type="text" value="'.$result[$i]['cp'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Ville</td><td><input name="ville" type="text" value="'.$result[$i]['ville'].'" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Région</td><td><input name="region" type="text" value="'.$result[$i]['region'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Pays</td><td><input name="pays" type="text" value="'.$result[$i]['pays'].'" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tél</td><td><input name="tel" type="text" value="'.$result[$i]['tel'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Fax</td><td><input name="fax" type="text" value="'.$result[$i]['fax'].'" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Email</td><td><input name="email" type="text" value="'.$result[$i]['email'].'" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Site Web</td><td><input name="site_web" type="text" value="'.$result[$i]['site_web'].'" /></td>
</tr>
</table><br/><input name="enregistrer_modif" type="submit" value="Enregistrer"></center></form>';
	}	
	
	}*/
	
	
	function _destruct()
	{
	mysql_close($this->db);
	
	}
	
}
?>
