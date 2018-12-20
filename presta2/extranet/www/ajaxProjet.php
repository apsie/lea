<?php
global $conn;

$database= new _database($conn);
$projet = new projet();

/*
 if(isset($_GET['action']) and $_GET['action']=="updateOrganisation")
 {
 $org->id_organisation = $_GET['id_organisation'];
 $org->categorie = $_GET['categorie'];
 $org->nom_organisme = $_GET['nom_organisme'];
 $org->activite_principale = $_GET['activite_principale'];
 $org->code_naf = $_GET['code_naf'];
 $org->raison_sociale = $_GET['raison_sociale'];
 $org->type_adresse = $_GET['type_adresse'];
 $org->rue = $_GET['rue'];
 $org->adresse_ligne_2 = $_GET['adresse_ligne_2'];
 $org->adresse_ligne_3 = $_GET['adresse_ligne_3'];
 $org->cp = $_GET['cp'];
 $org->ville = $_GET['ville'];
 $org->region = $_GET['region'];
 $org->pays = $_GET['pays'];
 $org->tel = $_GET['tel'];
 $org->fax = $_GET['fax'];
 $org->email = $_GET['email'];
 $org->site_web = $_GET['site_web'];
 $org->date_immat = $_GET['date_immat'];
 $org->date_debut_activite = $_GET['date_debut_activite'];
 $org->forme_juridique = $_GET['forme_juridique'];
 $org->siret = $_GET['siret'];
 $org->secteur_activite = $_GET['secteur_activite'];
 $org->dirigeant = $_GET['dirigeant'];
 $org->implantation = $_GET['implantation'];
 $org->regime_imposition = $_GET['regime_imposition'];
 $org->regime_tva = $_GET['regime_tva'];
 $org->regime_fiscal =$_GET['regime_fiscal'];
 $org->regime_social_dirigeant = $_GET['regime_social_dirigeant'];
 $org->statut =$_GET['statut'];
 $org->code_organisme = $_GET['code_organisme'];
 $org->updateOrganisation();
 }

 }*/
if(isset($_GET['action']) and $_GET['action']=="addProjet")
{

	$projet->id_projet = $_GET['id_projet'];
	$projet->categorie = $_GET['categorie'];
	$projet->resultat = utf8_decode($_GET['resultat']);
	$projet->description = utf8_decode($_GET['description']);
	$projet->statut = $_GET['statut'];
	
	$projet->date_debut = outils::getTps($_GET['date_debut']);
	$projet->date_fin = outils::getTps($_GET['date_fin']);
	$projet->date_fin_previsionnelle = outils::getTps($_GET['date_fin_previsionnelle']);
	
	
	$projet->referent = $_GET['id_referent'];
	if($_GET['contact_a_rechercher']!=null)
	{
	$contact = explode(';',$_GET['contact_a_rechercher']);
	$projet->id_contact = $contact[0];
	$projet->nom_contact = $contact[2].' '.$contact[1];
	}
	
	$projet->insertProjet();
	return json_encode(true);
}
if(isset($_GET['action']) and $_GET['action']=="getProjetEntreprise")
{
	$data = $projet->getProjetEntreprise($_GET['id_projet']);
	if($data!=null)
	{
	if(is_numeric($data['date_debut']) && $data['date_debut']!=0)
		{$data['date_debut']=date('d/m/Y',$data['date_debut']);}
		else
		{
			$data['date_debut']='';
		}
		if(is_numeric($data['date_fin_previsionnelle']) && $data['date_fin_previsionnelle']!=0)
		{$data['date_fin_previsionnelle']=date('d/m/Y',$data['date_fin_previsionnelle']);}
		else
		{
			$data['date_fin_previsionnelle']='';
		}
		if(is_numeric($data['date_fin_reelle']) && $data['date_fin_reelle']!=0)
		{$data['date_fin_reelle']=date('d/m/Y',$data['date_fin_reelle']);}
		else
		{
			$data['date_fin_reelle']='';
		}
	if(is_numeric($data['date_immat']) && $data['date_immat']!=0)
		{$data['date_immat']=date('d/m/Y',$data['date_immat']);}
		else
		{
			$data['date_immat']='';
		}
	if(is_numeric($data['date_debut_activite']) && $data['date_debut_activite']!=0)
		{$data['date_debut_activite']=date('d/m/Y',$data['date_debut_activite']);}
		else
		{
			$data['date_debut_activite']='';
		}
	}
	$data["secteur_activite"] = utf8_encode($data['secteur_activite']);
	$data["activite_principale"] = utf8_encode($data['activite_principale']);
	$data["raison_sociale"] = utf8_encode($data['raison_sociale']);
	$data["type_adresse"] = utf8_encode($data['type_adresse']);
	$data["implantation"] = utf8_encode($data['implantation']);
	$data["regime_imposition"] = utf8_encode($data['regime_imposition']);
	$data["regime_tva"] = utf8_encode($data['regime_tva']);
	$data['regime_fiscal'] = utf8_encode($data['regime_fiscal']);
	$data['regime_social_dirigeant'] = utf8_encode($data['regime_social_dirigeant']);
	$data['statut_org'] = str_replace('\r',"",$data['statut_org']);
	echo json_encode($data);
}
if(isset($_GET['action']) and $_GET['action']=="getProjet")
{




	$data = $projet-> getProjet($_GET['mot'],$_GET['id_projet']);

	$total =0;
	
if(!isset($_GET['id_projet']) || $_GET['id_projet']!="" )
{
for($i=0;$i<count($data);$i++)
	{
		$total++;

		$data[$i]['intitule_projet'] = utf8_encode($data[$i]['intitule_projet']);
		$data[$i]['description_projet'] = utf8_encode($data[$i]['description_projet']);
		$data[$i]['account_firstname'] = utf8_encode($data[$i]['account_firstname']);
		$data[$i]['account_lastname'] = utf8_encode($data[$i]['account_lastname']);
		$data[$i]['resultat'] = utf8_encode(stripslashes($data[$i]['resultat']));

		if(is_numeric($data[$i]['date_debut']) && $data[$i]['date_debut']!=0)
		{$data[$i]['date_debut']=date('d/m/Y',$data[$i]['date_debut']);}
		else
		{
			$data[$i]['date_debut']='';
		}
		if(is_numeric($data[$i]['date_fin_previsionnelle']) && $data[$i]['date_fin_previsionnelle']!=0)
		{$data[$i]['date_fin_previsionnelle']=date('d/m/Y',$data[$i]['date_fin_previsionnelle']);}
		else
		{
			$data[$i]['date_fin_previsionnelle']='';
		}
		if(is_numeric($data[$i]['date_fin_reelle']) && $data[$i]['date_fin_reelle']!=0)
		{$data[$i]['date_fin_reelle']=date('d/m/Y',$data[$i]['date_fin_reelle']);}
		else
		{
			$data[$i]['date_fin_reelle']='';
		}
	} 
	
	unset($_SESSION['TEMPS']['DATAPROJET']);
	unset($_SESSION['TEMPS']['TOTALPROJET']);

	$_SESSION['TEMPS']['DATAPROJET'] = $data;
	$_SESSION['TEMPS']['TOTALPROJET'] = $total;
	
	
}
else
{
	

		$data['intitule_projet'] = utf8_encode($data['intitule_projet']);
		$data['description_projet'] = utf8_encode($data['description_projet']);
		$data['account_firstname'] = utf8_encode($data['account_firstname']);
		$data['account_lastname'] = utf8_encode($data['account_lastname']);
		$data['resultat'] = utf8_encode(stripslashes($data['resultat']));

		if(is_numeric($data['date_debut']) && $data['date_debut']!=0)
		{$data['date_debut']=date('d/m/Y',$data['date_debut']);}
		else
		{
			$data['date_debut']='';
		}
		if(is_numeric($data['date_fin_previsionnelle']) && $data['date_fin_previsionnelle']!=0)
		{$data['date_fin_previsionnelle']=date('d/m/Y',$data['date_fin_previsionnelle']);}
		else
		{
			$data['date_fin_previsionnelle']='';
		}
		if(is_numeric($data['date_fin_reelle']) && $data['date_fin_reelle']!=0)
		{$data['date_fin_reelle']=date('d/m/Y',$data['date_fin_reelle']);}
		else
		{
			$data['date_fin_reelle']='';
		}
			
	}
	
echo json_encode(array("DATA"=>$data,"TOTAL"=>$total));
}

	


/*
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
 echo json_encode($data);
 }
 if(isset($_GET['action']) and $_GET['action']=="getCodeNaf")
 {

 $data = $database->getCodeNaf($_GET['queryString']);
 echo json_encode($data);
 }
 if(isset($_GET['action']) and $_GET['action']=="getContactByOrganisation")
 {
 $data = $org->getContactByOrganisation($_GET['id_organisation']);
 echo json_encode($data);
 }*/

?>