<?php
//require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
//require_once(realpath(dirname(__FILE__)) . '/Organisation.php');

/**
 * @access public
 */
	  
	  require_once 'Zend/Loader.php';
	Zend_Loader::registerAutoload();
	
	
	
class Email {
	
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function form_mail($nom,$mail,$valeur_contact)
	 {
		echo' <html><head></head><body>
<div style=" width:650px; background-color:#FFF; padding:10px; border:2px solid #666"><center>
  <h2>Emailing</h2></center>
<br/>
<form method="post" enctype="multipart/form-data" ><table  bgcolor="#FFF">		
<tr >
  <td width="46"><strong>DE</strong></td>
  <td width="614">'.$nom.' - "'.$mail.'"</td>
  </tr><tr bgcolor="#FFF">
  <td width="46"><strong>A</strong></td><td width="614"><input name="des" size="100" type="text" value="'.str_replace('/,','',$valeur_contact).'" /></td>
  </tr><tr bgcolor="#FFF">
  <td width="46"><strong>Sujet</strong></td>
  <td width="614"><input name="objet" style="font-weight:bold" size="83" type="text" /></td>
  </tr><tr bgcolor="#FFF">
  <td width="46"></td>
  <td width="614"><textarea name="message" style="font-size:12px; color: #2C8598 ; border:1px solid #CCC" rows="20" cols="73">Bonjour,


Cordialement,
-----------------------------------------------------------------------
'.$nom.'
</textarea></td>
  </tr><tr bgcolor="#FFF">
  <td width="46"><strong>Fichier</strong></td>
  <td width="614">

<input style="font-size:11px; border:1px solid #CCC" size="85" name="fichier" type="file" /></tr><tr><td></td><td>Extensions autorisées : <strong>.png , .gif , .jpg , .jpeg , .doc , .docx , .zip , .rar , .xls , .xlsx , .pdf </strong><br/>Taille max : <strong>5 Mo</strong></td>
  </tr><tr bgcolor="#FFF">
  <td width="46">&nbsp;</td>
  <td width="614"><input  name="retour" type="checkbox" value="1" /> Recevoir une copie</td>
  </tr><tr bgcolor="#FFF">
  <td width="46" height="54">&nbsp;</td>
  <td width="614"><input  type="submit" name="envoyer" value="Envoyer" /></td>
  </tr>

</table><br/></form></div></body></html>';
	 }
	
	 public function verification_fichier($file)
	 {
if($file['name']=='')
{ return NULL;}
else
{
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
	 }
	 
	public function envoyer_email($exp,$nom_exp,$des,$objet,$message,$retour,$file) {
		
		if(isset($_POST['envoyer']))
			   {
				$retour_file=$this->verification_fichier($file); 
			
	
	



	$mail = new Zend_Mail();
		$mail->setFrom($exp,$nom_exp);
		$mail->setSubject($objet);
		$mail->setBodyText($message);
		$des=explode(',',$des);
		$nb_mail=count($des);
		for($i=0;$i<count($des);$i++)
		{
		$mail->addTo($des[$i]);
		
	//	echo $des[$i].'<br/>';
		}
		if($retour==1)
		{
		$mail->addTo($exp);
		}
	
		if($retour_file[0]!=NULL and $retour_file[1]==NULL )
		{
		
		$filename=$retour_file[0]['tmp_name'];
		$fp=fopen($filename, 'r+');
		$output=fread($fp, filesize($filename));
		fclose($fp);


		$at = $mail->createAttachment($output);
		$at->type        = $this->mime($retour_file[0]['name']);
		$at->disposition = Zend_Mime::DISPOSITION_INLINE;
		$at->encoding    = Zend_Mime::ENCODING_BASE64;
		$at->filename    = $retour_file[0]['name'];
		
		$mail->send();
			echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="alert(\' '.$nb_mail.' email(s) envoyé(s) \')";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);
  setTimeout($obj3,8000);

  </script>';	
		}
		elseif($retour_file[0]!=NULL and $retour_file[1]!=NULL)
		{
				echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="alert(\' '.$nb_mail.' email(s) n  ont pas été envoyé(s) car la pièce jointe est invalide.Message d erreur : '.$retour_file[1].' \')";
   
    setTimeout($obj2,1000);
  

  </script>';	
		}
		else
		{
			$mail->send();
				echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="alert(\' '.$nb_mail.' email(s) envoyé(s) \')";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);
  setTimeout($obj3,8000);

  </script>';	
		}
		
		
	   
		
		
		
		
		
				 
				 
				 }
		
		
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
}
?>