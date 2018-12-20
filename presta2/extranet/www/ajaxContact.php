<?php 
global $conn;
$id_application=3;
 $database= new _database($conn);
 $contact = new contact();
if(isset($_REQUEST['action']) and $_REQUEST['action']=="getVille")
{
	
	$data = $database->ajaxSelectionnerData($_REQUEST['queryString']);
	echo json_encode($data);
}
if(isset($_GET['action']) and $_GET['action']=="getBen")
{
	
	$data = $database->ajaxSelectionnerDataBen($_GET['queryString']);
	echo json_encode($data);
}
if(isset($_GET['action']) and $_GET['action']=="getPreference")
{
	$_SESSION['TEMPS']['IDPARAMETRE'] = $_GET['idParam'];
	
}
if(isset($_GET['action']) and $_GET['action']=="updateParametre")
{
	 $database->updateParametre($_GET['idParam'],$_GET['libelleParam']);
	 echo true;
}
if(isset($_GET['action']) and $_GET['action']=="updateContact")
{
	$contact = new contact();
	$contact->id_contact = $_GET['id_contact'];
	$contact->cat_id = $_GET['cat_id'];
	$contact->nom = $_GET['nom'];
	$contact->prenom = $_GET['prenom'];
	$contact->deuxieme_prenom = $_GET['deuxieme_prenom'];
	$contact->nom_jeune_fille = $_GET['nom_jeune_fille'];
	$contact->civilite = $_GET['civilite'];
	$contact->fonction = $_GET['fonction'];
	$contact->adresse_ligne_1 = $_GET['adresse_ligne_1'];
	$contact->adresse_ligne_2 = $_GET['adresse_ligne_2'];
	$contact->cp = $_GET['cp'];
	$contact->ville = $_GET['ville'];
	$contact->region = $_GET['region'];
	$contact->pays = $_GET['pays'];
	$contact->tel_pro_1 = $_GET['tel_pro_1'];
	$contact->tel_pro_2 = $_GET['tel_pro_2'];
	$contact->tel_domicile_1 = $_GET['tel_domicile_1'];
	$contact->tel_domicile_2 = $_GET['tel_domicile_2'];
	$contact->fax_pro = $_GET['fax_pro'];
	$contact->fax_perso = $_GET['fax_perso'];
	$contact->portable_pro = $_GET['portable_pro'];
	$contact->portable_perso = $_GET['portable_perso'];
	$contact->email_pro = $_GET['email_pro'];
	$contact->email_perso = $_GET['email_perso'];
	$contact->site_perso = $_GET['site_perso'];
	$contact->updateContact();
}
if(isset($_GET['action']) and $_GET['action']=="saveContact")
{
	$contact = new contact();
	$contact->cat_id = $_GET['cat_id'];
	if($_GET['id_organisation']!="")
	{$contact->id_organisation = $_GET['id_organisation'];}
	
	$contact->nom = $_GET['nom'];
	$contact->prenom = $_GET['prenom'];
	$contact->deuxieme_prenom = $_GET['deuxieme_prenom'];
	$contact->nom_jeune_fille = $_GET['nom_jeune_fille'];
	$contact->civilite = $_GET['civilite'];
	$contact->fonction = $_GET['fonction'];
	$contact->adresse_ligne_1 = $_GET['adresse_ligne_1'];
	$contact->adresse_ligne_2 = $_GET['adresse_ligne_2'];
	$contact->cp = $_GET['cp'];
	$contact->ville = $_GET['ville'];
	$contact->region = $_GET['region'];
	$contact->pays = $_GET['pays'];
	$contact->tel_pro_1 = $_GET['tel_pro_1'];
	$contact->tel_pro_2 = $_GET['tel_pro_2'];
	$contact->tel_domicile_1 = $_GET['tel_domicile_1'];
	$contact->tel_domicile_2 = $_GET['tel_domicile_2'];
	$contact->fax_pro = $_GET['fax_pro'];
	$contact->fax_perso = $_GET['fax_perso'];
	$contact->portable_pro = $_GET['portable_pro'];
	$contact->portable_perso = $_GET['portable_perso'];
	$contact->email_pro = $_GET['email_pro'];
	$contact->email_perso = $_GET['email_perso'];
	$contact->site_perso = $_GET['site_perso'];
	$contact->insertContact();
}
if(isset($_GET['action']) and $_GET['action']=="getContact")
{
$prestation = new prestation();
$database = new _database($conn);	
if($_GET['qtype']=="categorie" AND $_GET['query']!="")
		{
		$_GET['qtype']="cat.cat_name";
		$_GET['sortname']="cat.cat_name";
		}
		
	//Config
	$parametre['contact']['id'] = array('categorie','civilite','nom_complet','nom','prenom','deuxieme_prenom','nom_jeune_fille','ville','region','cp','pays','tel_pro_1','tel_pro_2','tel_dom_1','tel_dom_2','fax_pro','fax_perso','portable_pro','portable_perso','email_pro','email_perso','fonction','site_perso',
	'date_naissance','lieu_naissance','nationalite','situation_maritale','enfants_a_charge','description_projet','nom_organisme','activite_principale','raison_sociale','type_adresse','adresse_ligne_1','adresse_ligne_2','cp','ville','region','pays',
	'date_immat','date_debut_activite','forme_juridique','siret','code_naf','secteur_activite','dirigeant','implantation','regime_imposition','regime_tva','regime_fiscal','regime_social_dirigeant','statut_org','presta','statut','date_debut',
	'avis1','commentaire1','avis2','commentaire2','r_emploi','code_rome','com_ref','com_ben');

	$_GET['descriptif_id'][] = 'nom';
	$_GET['descriptif_id'][] = 'prenom';
	$_GET['descriptif_id'][] = 'deuxieme_prenom';
	$_GET['descriptif_id'][] = 'nom_jeune_fille';
	/*$_GET['descriptif_id'][] = 'adresse_ligne_1';
	$_GET['descriptif_id'][] = 'adresse_ligne_2';*/
	$descriptif_id = $_GET['descriptif_id'];
	$descriptif_libelle = $_GET['descriptif_libelle'];
	$contact = new contact();
	//$pageStart = ($_POST['page']-1)*$_POST['rp'];
	$data = $contact-> getContacts($_GET['champ'],$_GET['mot'],$_GET['cat_id'],$_GET['id']);


$total =0;
	for($i=0;$i<count($data);$i++)
	{
		$data[$i]['adresse_ligne_1']=utf8_encode($data[$i]['adresse_ligne_1']);
		$data[$i]['adresse_ligne_2']=utf8_encode($data[$i]['adresse_ligne_2']);
		$total++;	
			for($z=0;$z<count($descriptif_id);$z++)
	{
		if(in_array($descriptif_id[$z], $parametre['contact']['id']))
		{
		
		 if($descriptif_id[$z]=="presta" or $descriptif_id[$z]=="statut" or $descriptif_id[$z]=="date_debut" )
			{
				
				$str="";
				$dataP = $prestation->getPrestation($data[$i]['id_ben'],$_GET['champ'],$_GET['mot']);
				
				for($x=0;$x<count($dataP);$x++)
				{
					if(is_numeric($dataP[$x][$descriptif_id[$z]]))
					{$str .= date('d/m/Y',$dataP[$x][$descriptif_id[$z]]).'<br/>';}
					else
					{
					$str .= utf8_encode($dataP[$x][$descriptif_id[$z]]).'<br/>';
					}
				}
				$data[$i][$descriptif_id[$z]]=$str;
			
			
			} elseif($descriptif_id[$z]=="avis1" or $descriptif_id[$z]=="commentaire1" or $descriptif_id[$z]=="avis2" or $descriptif_id[$z]=="commentaire2" or $descriptif_id[$z]=="r_emploi" or $descriptif_id[$z]=="code_rome" or $descriptif_id[$z]=="com_ref" or $descriptif_id[$z]=="com_ben")
			{
				
				$str="";
				$dataB = $database->getBilan($data[$i]['id_ben'],$_GET['champ'],$_GET['mot']);
				
				for($x=0;$x<count($dataB);$x++)
				{
					
					$str .= utf8_encode($dataB[$x][$descriptif_id[$z]]).'<br/>';
					
				}
				
				
				$data[$i][$descriptif_id[$z]]=$str;
			
			
			}
		else if($descriptif_id[$z]=="date_debut_activite" or $descriptif_id[$z]=="date_immat" or $descriptif_id[$z]=="date_naissance")
			{
			
				
				
				
					if(is_numeric($data[$i][$descriptif_id[$z]]) && $data[$i][$descriptif_id[$z]]!=0)
					{$data[$i][$descriptif_id[$z]]=date('d/m/Y',$data[$i][$descriptif_id[$z]]);}
					else
					{
					$data[$i][$descriptif_id[$z]]='';
					}
				}
				
			
			
			
		
			
			else {
				
					$data[$i][$descriptif_id[$z]]=utf8_encode($data[$i][$descriptif_id[$z]]);
					
					//$data[$i]['nom']=utf8_decode($data[$i]['nom']);
				
			}
			
		}
	
	}	
	}


	unset($_SESSION['TEMPS']['DATACONTACT']);
	unset($_SESSION['TEMPS']['TOTALCONTACT']);
	unset($_SESSION['TEMPS']['CHAMPSCONTACT']);
	unset($_SESSION['TEMPS']['LIBELLECONTACT']);
	$_SESSION['TEMPS']['DATACONTACT'] = $data;
	$_SESSION['TEMPS']['TOTALCONTACT'] = $total;
	$_SESSION['TEMPS']['CHAMPSCONTACT'] = $descriptif_id;
	$_SESSION['TEMPS']['LIBELLECONTACT'] = $descriptif_libelle;
	echo json_encode(array("DATA"=>$data,"TOTAL"=>$total,"champs"=>$descriptif_id,"libelle"=>$descriptif_libelle));

}
if(isset($_GET['action']) and $_GET['action']=="saveParametre")
{

		$param[0]['cle'] =	'id_categorie';
	for($i=0;$i<count($_GET['cat_id']);$i++)
	{
		$cat .= $_GET['cat_id'][$i].',';
	}
		$param[0]['valeur'] = $cat;
	for($i=0;$i<count($_GET['descriptif_id']);$i++)
	{
		$param[$i+1]['cle'] =	$_GET['descriptif_id'][$i];
		$param[$i+1]['valeur'] =	1;
	}
		//print_r($param);exit();
		$p_user->savePreference($param,$_SESSION['UTILISATEUR']['account_id'],$id_application,$_GET['idParam']);
		echo json_encode('<img src="./images/ico/ok.png" /> Les paramètres sont sauvegardés');
}
		if(isset($_GET['action']) and $_GET['action']=="createParametre")
{
	$param[0]['cle'] =	'id_categorie';
		$param[0]['valeur'] =	$_GET['cat_id'];
	for($i=0;$i<count($_GET['descriptif_id']);$i++)
	{
		$param[$i+1]['cle'] =	$_GET['descriptif_id'][$i];
		$param[$i+1]['valeur'] =	1;
	}
   $data = $database->createParametre($_GET['libelleParametre'],$_SESSION['UTILISATEUR']['account_id'],$id_application);
    $p_user->initialiserPreference($_SESSION['UTILISATEUR']['account_id'],true,$data);
		$p_user->savePreference($param,$_SESSION['UTILISATEUR']['account_id'],$id_application,$data['id_parametre']);
		echo json_encode('<img src="./images/ico/ok.png" /> Les paramètres sont sauvegardés');
}	
		if(isset($_GET['action']) and $_GET['action']=="rechercherContact")
{
	$contact = new contact();
	$data = $contact->rechercherContact($_GET['mot']);
	
	$data[0]['nom'] = utf8_encode($data[0]['nom']);
	$data[0]['prenom'] = utf8_encode($data[0]['prenom']);
	$data[0]['nom_complet'] = utf8_encode($data[0]['nom_complet']);
	
	echo json_encode($data);
}
		if(isset($_GET['action']) and $_GET['action']=="inserer_id_organisation")
{	
$data = $contact->inserer_id_organisation($_GET['id_contact'], $_GET['id_organisation'],$_SESSION['UTILISATEUR']['account_id']);
echo json_encode($data);
}
		if(isset($_GET['action']) and $_GET['action']=="delete_id_organisation")
{	
$data = $contact->deleteIdOrganisation($_GET['id_contact'], $_GET['id_organisation'],$_SESSION['UTILISATEUR']['account_id']);
echo json_encode($data);
}

if(isset($_GET['action']) and $_GET['action']=="editForm")
{
	$categorie = new categorie();
	$view->listCategorie = $categorie->getCategories('contact');
	$view->contact = contact::get_contactv2($_REQUEST['id_contact']);
	$view->noReload = 1;
	echo $view->render('/modules/contactForm.phtml');
}
?>