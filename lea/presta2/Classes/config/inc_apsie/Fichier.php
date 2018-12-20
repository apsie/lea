<?php
//require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
//require_once(realpath(dirname(__FILE__)) . '/Organisation.php');
//require_once(realpath(dirname(__FILE__)) . '/Contact.php');


/**
 * @access public
 */
	 include('config/config.php');
 
	  require_once 'Zend/Loader.php';
	Zend_Loader::registerAutoload();
	
	
	
class Fichier {
	
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	
	
	 public function verification_fichier($file)
	 {
		/* $file = strtr($file,
     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); */
//On remplace les lettres accentutées par les non accentuées dans $fichier.
//Et on récupère le résultat dans fichier

//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
//dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
//$file= preg_replace('/([^a-z0-9]+)/i', '-', $file);

//$taille_maxi = 5000000;
$taille_maxi = 5000000;
	
//Taille du fichier
$taille = filesize($file['tmp_name']);
if($taille>$taille_maxi)
{
  $erreur = 'Le fichier est trop gros...';
}

$extensions = array('.png', '.gif', '.jpg', '.jpeg','.rtf', '.pdf','.doc'  ,'.docx', '.zip' ,'.rar' ,'.xls','.xlsx');	
// récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
$extension = strrchr($file['name'], '.');
//Ensuite on teste
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
      $erreur ='Vous devez uploader un fichier de type png, gif, jpg, jpeg , zip , rar , doc , xls, pdf';
	
	
}
return array($file,$erreur);
	 }
	
	 function mime($name)
 {

 // type de contenu non defini
 if(empty($ctype)){
 // on essaie de reconnaitre l'extension
 switch(strrchr(basename($name), ".")){
 case ".gz": $ctype = "application/x-gzip"; break;
 case ".tgz": $ctype = "application/x-gzip"; break;
 case ".zip": $ctype = "application/zip"; break;
 case ".pdf": $ctype = "application/pdf"; break;
 case ".png": $ctype = "image/png"; break;
 case ".gif": $ctype = "image/gif"; break;
 case ".jpg": $ctype = "image/jpeg"; break;
 case ".txt": $ctype = "text/plain"; break;
 case ".htm": $ctype = "text/html"; break;
 case ".html": $ctype = "text/html"; break;
 case ".xls": $ctype = "application/vnd.ms-excel"; break;
  case ".xlsx": $ctype = "application/excel"; break;
 case ".doc": $ctype = "application/msword"; break;
  case ".rtf": $ctype = "application/msword"; break;
 default: $ctype = "application/octet-stream"; break;
 }
 }

return  $ctype;



 // fin de fonction
 }
 
 public function chemin_fichier($file)
 {
	 $extension = strrchr($file, '.');
		
		if ($extension=='.png' || $extension=='.jpg' || $extension=='.jpeg' || $extension=='.gif')
		{		
		return 'fichiers/images';
		}
		elseif($extension=='.doc' || $extension=='.rtf')
		{		
		return 'fichiers/word';
		}	
		elseif($extension=='.pdf')
		{		
		return 'fichiers/pdf';
		}	
		elseif($extension=='.zip' || $extension=='.rar')
		{		
		return 'fichiers/archives';
		}	
		elseif($extension=='.xls' || $extension=='.xlsx')
		{		
		return 'fichiers/excel';
		}	
	 
	}
 
 
 public function upload_fichier($file)
	 {
		//$contact=Contact::get_contact($_GET['id_contact']);


 $retour_file=$this->verification_fichier($file);
 
 if($retour_file[0]!=NULL and $retour_file[1]==NULL )
		{
			/*echo 'ca passe!';*/
		$adapter = new Zend_File_Transfer_Adapter_Http();
	
		$adapter->setDestination($this->chemin_fichier($file['name']));
		
               /* $adapter->addFilter('Rename', array(
                        $file['tmp_name'], 
                       $this->chemin_fichier($file['name']).'/'.$contact[0].'_'.$contact[1].'_'.$file['tmp_name'], 
                        true
                ));     */
	
		
		if (!$adapter->receive()) 
			{
   				 $messages = $adapter->getMessages();
   				 echo implode("\n", $messages);
				 
				
			}
			
		}  
  elseif($retour_file[0]!=NULL and $retour_file[1]!=NULL)
		{
	echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="alert(\' Le fichier n a pas été chargé car il est invalide.Message d erreur : '.$retour_file[1].' \')";
   setTimeout($obj2,1000);
   		</script>';
		$retour ="erreur";
		}	
		return $retour;
 
	 }
	 //Fin fonction upload_fichier
	 
	public function inserer_fichier($id_contact, $id_owner, $nom_file, $taille, $is_private)
	
	{
		if($is_private=='')
		$is_private=0;
		//$contact=Contact::get_contact($id_contact);
		$target= $this->chemin_fichier($nom_file);
		$extension = strrchr($nom_file, '.');
		
		
		$data = array('id_contact'=> $id_contact, 'date_upload'=> time(), 'id_owner'=> $id_owner, 'type_de_fichier'=> $extension, 'nom_fichier'=> $target.'/'.$nom_file, 'taille_fichier'=> $taille, 'is_private'=> $is_private );
		
		$GLOBALS['db']->insert('egw_contact_fichier',$data);		
	}
	 //Fin fonction insertion_fichier
	 
 public function modifier_fichier($id_contact, $id_owner, $nom_file='', $taille='', $is_private)
	
	{
		if($is_private=='')
		$is_private=0;
		//$contact=Contact::get_contact($id_contact);
		$target= $this->chemin_fichier($nom_file);
		$extension = strrchr($nom_file, '.');
		
		if($nom_file=='')
		{
			$data = array('id_contact'=> $id_contact, 'date_upload'=> time(), 'id_owner'=> $id_owner, 'is_private'=> $is_private );
		}
		else
		{
		$data = array('id_contact'=> $id_contact, 'date_upload'=> time(), 'id_owner'=> $id_owner, 'type_de_fichier'=> $extension, 'nom_fichier'=> $target.'/'.$nom_file, 'taille_fichier'=> $taille, 'is_private'=> $is_private );
		}
		
		$GLOBALS['db']->update('egw_contact_fichier',$data,'id_fichier='.$_POST['id_fichier_delete']);		
	}
 
 public function lister_fichier($id_contact)
 {
	 echo'<table>';
	 $requete='SELECT * FROM  egw_contact_fichier where id_contact = "'.$id_contact.'"';
	
	 $result=$GLOBALS['db']->fetchAll($requete);
		
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
		
		if($result[$i]['type_de_fichier']=='.jpg' or $result[$i]['type_de_fichier']=='.jpeg' or $result[$i]['type_de_fichier']=='.png' or $result[$i]['type_de_fichier']=='.gif')		
		{
		$result[$i]['type_de_fichier']="<img title='Fichier image' src='../Fichier1.0/images/jpg_jpg.PNG' />";
		}
		elseif($result[$i]['type_de_fichier']=='.doc' or $result[$i]['type_de_fichier']=='.rtf' or $result[$i]['type_de_fichier']=='.docx')		
		{
		$result[$i]['type_de_fichier']="<img title='Fichier word' src='../Fichier1.0/images/icone_word.gif' />";
		}
		elseif($result[$i]['type_de_fichier']=='.xls' or $result[$i]['type_de_fichier']=='.xlsx')		
		{
		$result[$i]['type_de_fichier']="<img title='Fichier excel' src='../Fichier1.0/images/xls.png' />";
		}
		elseif($result[$i]['type_de_fichier']=='.pdf' )		
		{
		$result[$i]['type_de_fichier']="<img title='Fichier pdf' src='../Fichier1.0/images/pdf.png' />";
		}
		elseif($result[$i]['type_de_fichier']=='.zip' or $result[$i]['type_de_fichier']=='.rar')		
		{
		$result[$i]['type_de_fichier']="<img title='Fichier archive' src='../Fichier1.0/images/icone-zip.gif' />";
		}
		
		
		$nom_fichier=explode('/',$result[$i]['nom_fichier']);
		if($result[$i]['is_private']==1)		
		{
		$result[$i]['is_private']="<img title='Fichier privé' src='../Fichier1.0/images/cle.png' />";
		if($result[$i]['id_owner']==$GLOBALS['egw_info']['user']['account_id'])
		{
			$fichier='<a href="../Fichier1.0/'.$result[$i]['nom_fichier'].'" target="_blank">'.substr($nom_fichier[2],0,20).'..</a>';
		}
		else
		{
			$fichier=substr($nom_fichier[2],0,20).'..';
		}
		}
		else
		{
		$result[$i]['is_private']=NULL;
		$fichier='<a href="../Fichier1.0/'.$result[$i]['nom_fichier'].'" target="_blank">'.substr($nom_fichier[2],0,20).'..</a>';
		
		}
		if($result[$i]['id_owner']==$GLOBALS['egw_info']['user']['account_id'])
		{
		$modif_delete='<img title="Modifier" src="./images/edit.png" /><img title="Supprimer" src="./images/delete.png" />';
		}
		echo '<tr > 
		<td>'.$result[$i]['is_private'].'</td><td> '.$result[$i]['type_de_fichier'].' '.$fichier.'</td><td><a onclick="window.open(\'../Fichier1.0/maj_fichier.php?id_contact='.$result[$i]['id_contact'].'&domain=default&id_fichier_delete='.$result[$i]['id_fichier'].'\',\'control\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=600, height=300\');"  href="" ><img title="Modifier" src="./images/edit.png" /></a><a href="javascript:if(confirm(\'Etes vous sur de vouloir supprimer un fichier existant ?\')) document.location.href=\'info.php?categorie='.$_GET['categorie'].'&id='.$_GET['id'].'&id_ben='.$id_contact.'&domain=default&id_fichier_delete='.$result[$i]['id_fichier'].'\'" ><img title="Supprimer" src="./images/delete.png" /></a></td></tr>'; 
 
	}	
	echo'</table>';
}
 //Fin fonction lister_fichier
	public function nbr_fichier($id_contact)
	{
		$requete='SELECT * FROM  egw_contact_fichier where id_contact = "'.$id_contact.'"';
		
		$result=$GLOBALS['db']->fetchAll($requete);
		return count($result);
	} 
	
	
	public function verif_nom_fichier($nom_fichier)
	{
		$requete='SELECT * FROM  egw_contact_fichier where nom_fichier = "'.$this->chemin_fichier($nom_fichier).'/'.$nom_fichier.'"';
		
		$result=$GLOBALS['db']->fetchAll($requete);
		
		if (count($result)!=0)
		{
			$erreur = 'Ce nom de fichier existe déja. Veuillez renommer votre fichier';
			
		}
		
		return $erreur;
	} 
	 //Fin fonction verif_nom_fichier
	 
	 function trouve_nom_fichier($id_fichier)
	{
	$requete='SELECT * FROM  egw_contact_fichier where id_fichier = "'.$id_fichier.'"';
	return $GLOBALS['db']->fetchRow($requete);	
	
	}
	//Fin fonction trouve_nom_fichier
		
	 
	function delete_fichier($id_fichier)
	{
	
	/*$requete='SELECT nom_fichier FROM  egw_contact_fichier where id_fichier = "'.$id_fichier.'"';
	$result=$GLOBALS['db']->fetchRow($requete);	
	$nom_fichier=$result['nom_fichier'];*/
	
	$fichier=$this->trouve_nom_fichier($id_fichier);	
	$data = array('id_fichier='.$id_fichier);
	$GLOBALS['db']->delete('egw_contact_fichier',$data);	
	unlink('../Fichier1.0/'.$fichier['nom_fichier']);
	
	}
	//Fin fonction delete_fichier
	
	/*function maj_fichier($id_fichier, $new_nom_fichier)
	{			
	$data = array('nom_fichier'=> $new_nom_fichier);
	$GLOBALS['db']->update('egw_contact_fichier',$data,'id_fichier='.$id_fichier.'' );	
	
	}*/
	
 
}
?>