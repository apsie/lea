<?php
global $conn;
$evenement = new evenement($conn);
if(isset($_REQUEST['action']) and $_REQUEST['action']=="getListEvenement")
{
	if($_GET['id_referent']=="null")
	{
		$_GET['id_referent']="";
	}
if($_GET['statut']=="null")
	{
		$_GET['statut']="";
	}
	if(!isset($_GET['id_referent']) || $_GET['id_referent']==null )
	{$_GET['id_referent']="";}
	//echo 't'.$_GET['id_referent'];
	$data = $evenement->getListEvenement($_GET['id_referent'],$_GET['statut'],$_GET['id_evenement'],$_GET['is_read']);
	 for($i=0;$i<count( $data);$i++)
   {
   	 $data[$i]['date_creation'] = date('Y/m/d H:i', $data[$i]['date_creation']);
   	 $data[$i]['objet'] = utf8_encode($data[$i]['objet']);
   	 $data[$i]['type_evenement'] = utf8_encode($data[$i]['type_evenement']);
   	 $data[$i]['statut'] = utf8_encode($data[$i]['statut']);
   	 $data[$i]['fonction'] = utf8_encode($data[$i]['fonction']);
   	 $data[$i]['nom'] = utf8_encode($data[$i]['nom']);
   	 $data[$i]['prenom'] = utf8_encode($data[$i]['prenom']);
   	 $data[$i]['observations'] = utf8_encode($data[$i]['observations']);
   	 
   	 if($data[$i]['tel_pro_1']!=null)
   	 {$data[$i]['tel'] = $data[$i]['tel_pro_1'];}
    elseif($data[$i]['tel_domicile_1']!=null)
   	 {$data[$i]['tel'] = $data[$i]['tel_domicile_1'];}
    elseif($data[$i]['portable_perso']!=null)
   	 {$data[$i]['tel'] = $data[$i]['portable_perso'];}
   	 else {
   	 	$data[$i]['tel'] ="";
   	 }
   	 
    	 
   	 if($data[$i]['email_pro']!=null)
   	 {$data[$i]['email'] = $data[$i]['email_pro'];}
    elseif($data[$i]['email_perso']!=null)
   	 {$data[$i]['email'] = $data[$i]['email_perso'];}
   
   	 else {
   	 	$data[$i]['email'] ="";
   	 }
   	  
   }
  $conseiller =utilisateur::getUtilisateurs("A");
  //print_r($conseiller);
  $option="<option value='0'>Tous les conseillers</option>"; 
  
  if($_GET['id_referent']=="")
  {
  	$_GET['id_referent'] = $_SESSION['id'];
  }
 if($_GET['id_referent']==0)
  {
  	$_GET['id_referent'] ="";
  }
  $id = $_SESSION['id'];
  for($i=0;$i<count($conseiller);$i++)
  {
  	if($_GET['id_referent']==$conseiller[$i]['account_id'])
  	{
  		$sel = "selected='selected'";
  	}
  	else
  	{$sel="";}
  	$option .='<option '.$sel.' value="'.$conseiller[$i]['account_id'].'">'.$conseiller[$i]['account_lid'].'</option>';
  }
 
  	if($_GET['statut']=="")
  	{
  		$tous = "selected='selected'";
  	}
if($_GET['statut']=="Nouveau")
  	{
  		$nouveau = "selected='selected'";
  	}
if($_GET['statut']=="En cours")
  	{
  		$encours = "selected='selected'";
  	}
if($_GET['statut']=="Terminé")
  	{
  		$termine = "selected='selected'";
  	}
  	
  	 $optionStatut ="<option ".$tous." value=''>Tous</option><option ".$nouveau.">Nouveau</option><option ".$encours.">En cours</option><option ".$termine.">Terminé</option>";  


if($_GET['is_read']==1)
  	{
  		$vu = "selected='selected'";
  	}
if($_GET['is_read']==0)
  	{
  		$non_vu = "selected='selected'";
  	}
if($_GET['is_read']=="" || $_GET['is_read']=="null")
  	{
  		$tous_vu = "selected='selected'";
  		$non_vu = "";
  		$vu = "";
  	}	
  	 $optionLu ="<option ".$tous_vu." value=''>Tous</option><option value='1' ".$vu.">Vu</option><option value='0' ".$non_vu.">Non Vu</option>";  
  
 
	echo json_encode(array('DATA'=>$data,'CONSEILLERS'=>$option,'STATUT'=>$optionStatut,'LU'=>$optionLu));
}
else if(isset($_REQUEST['action']) and $_REQUEST['action']=="getHistoriqueEvenement")
{
	$data = $evenement->getHistoriqueEvenement($_GET['id_evenement']);
	 for($i=0;$i<count( $data);$i++)
   {
   	 $data[$i]['date'] = date('d/m/Y H:i', $data[$i]['date']);
   	 $data[$i]['message'] = utf8_encode(stripslashes($data[$i]['message']));
   }
	echo json_encode($data);
}
else if(isset($_REQUEST['action']) and $_REQUEST['action']=="addMessage")
{
	
	$evenement->addMessage($_GET['id_referent'],$_GET['id_evenement'],$_GET['message']);
	
	echo json_encode(true);
}
else if(isset($_REQUEST['action']) and $_REQUEST['action']=="updateEvenement")
{
	$data['statut'] = utf8_decode($_GET['statut']);
	$data['id_modifier'] = $_GET['id_modifier'];
	$data['date_last_modified'] = time();
	$evenement->updateEvenement($_GET['id_evenement'],$data);
	
	echo json_encode(true);
}
else if(isset($_REQUEST['action']) and $_REQUEST['action']=="updateEvenementRead")
{
	$data['is_read'] = $_GET['is_read'];
	$data['id_modifier'] = $_SESSION['ID'];
	$data['date_last_modified'] = time();
	$evenement->updateEvenement($_GET['id_evenement'],$data);
	
	echo json_encode(true);
}
else if(isset($_REQUEST['action']) and $_REQUEST['action']=="addEvent")
{
	global $conn;
	if($_GET['id_contact']=="")
	{
	$contact = new contact();
	$contact->cat_id = $_GET['cat_id'];
	if($_GET['id_organisation']!="")
	{$contact->id_organisation = $_GET['id_organisation'];}
	
	$contact->nom = $_GET['nom'];
	$contact->prenom = $_GET['prenom'];
	$contact->civilite = $_GET['civilite'];
	$contact->fonction = $_GET['fonction'];
	$contact->tel_pro_1 = $_GET['tel_pro_1'];
	$contact->tel_domicile_1 = $_GET['tel_domicile_1'];
	$contact->fax_pro = $_GET['fax_pro'];
	$contact->portable_perso = $_GET['portable_perso'];
	$contact->email_pro = $_GET['email_pro'];
	$contact->email_perso = $_GET['email_perso'];
	$contact->adresse_ligne_1 = "";
	$contact->adresse_ligne_2 = "";
	$contact->cp = "";
	$contact->ville = "";
	$contact->region = "";
	$contact->pays ="";
	$contact->insertContact();
	$sql="SELECT id_ben from egw_contact order by id_ben DESC limit 1";
	$data_ = $conn->fetchRow($sql);
	
	$id_contact = $data_['id_ben'];
	
	}
	else
	{
	$id_contact = $_GET['id_contact'];
	}
	
	$data['id_owner'] = $_SESSION['id'];
	$data['date_creation'] = time();
	$data['id_referent'] = $_GET['id_referent'];
	$data['id_contact'] = $id_contact;
	$data['type_evenement'] = utf8_decode($_GET['type_evenement']);
	$data['objet'] = utf8_decode($_GET['objet']);
	$data['observations'] = utf8_decode($_GET['observations']);
	$data['statut'] = "Nouveau";
	$data['degre'] = $_GET['degre'];
	$data['is_read'] = 0;
	$data['id_liste_presta'] = 0;
	$data['id_agence'] = 0;
	
	//print_r($data);
	$evenement->addEvenement($data);
	
	echo json_encode(true);
}





?>