<?php 
global $conn;
$id_application=3;
 $database= new _database($conn);
 $org = new organisation();


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
	$org->date_immat = outils::getTps($_GET['date_immat']);
	$org->date_debut_activite = outils::getTps($_GET['date_debut_activite']);
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
if(isset($_GET['action']) and $_GET['action']=="saveOrganisation")
{
	
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
	$org->date_immat = outils::getTps($_GET['date_immat']);
	$org->date_debut_activite = outils::getTps($_GET['date_debut_activite']);
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
	$org->id_projet = $_GET['id_projet'];
	
			
	$org->insertOrganisation();
}
if(isset($_GET['action']) and $_GET['action']=="getOrganisation")
{
//$prestation = new prestation();
$database = new _database($conn);	
if($_GET['qtype']=="categorie" AND $_GET['query']!="")
		{
		$_GET['qtype']="cat.cat_name";
		$_GET['sortname']="cat.cat_name";
		}
		
	//Config
	$parametre['contact']['id'] = array('categorie_org','nom_organisme','activite_principale','raison_sociale','type_adresse','adresse_ligne_1','adresse_ligne_2','cp','ville','region','pays','tel','fax','email','site_web',
	'date_immat','date_debut_activite','forme_juridique','siret','code_naf','secteur_activite','dirigeant','implantation','regime_imposition','regime_tva','regime_fiscal','regime_social_dirigeant','statut_org');
	
	$_GET['descriptif_id'][] = "adresse_ligne_3";
	$_GET['descriptif_id'][] = "date_debut_activite";
	$_GET['descriptif_id'][] = "date_immat";
	$_GET['descriptif_id'][] = "regime_social_dirigeant";
	
	$descriptif_id = $_GET['descriptif_id'];
	$descriptif_libelle = $_GET['descriptif_libelle'];
	$organisation = new organisation();
	//$pageStart = ($_POST['page']-1)*$_POST['rp'];
	$data = $organisation-> getOrganisation($_GET['champ'],$_GET['mot'],$_GET['cat_id']);


$total =0;
	for($i=0;$i<count($data);$i++)
	{
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
				
			}
			
		}
	
	}	
	
	$data[$i]['regime_social_dirigeant'] =$data[$i]['regime_social_dirigeant'];
    $data[$i]['type_adresse'] = utf8_encode($data[$i]['type_adresse']);
     $data[$i]['forme_juridique'] = utf8_encode($data[$i]['forme_juridique']);
      $data[$i]['implantation'] = utf8_encode($data[$i]['implantation']);
       $data[$i]['regime_imposition'] = utf8_encode($data[$i]['regime_imposition']);
        $data[$i]['regime_tva'] = utf8_encode($data[$i]['regime_tva']);
         $data[$i]['regime_fiscal'] = utf8_encode($data[$i]['regime_fiscal']);
        // $data[$i]['regime_social_dirigeant'] = utf8_encode($data[$i]['regime_social_dirigeant']);
         
	if($data[$i]['date_immat']==0)
					{
					$data[$i]['date_immat']='';
					}
	if($data[$i]['date_debut_activite']==0)
					{
					$data[$i]['date_debut_activite']='';
					}
					
					//$data[$i]['NBCONTACT'] = $organisation->getNbContactByOrganisation($data[$i]['id_organisation']);
					$data[$i]['NBCONTACT'] = "X";
	}

//print_r($data);
	unset($_SESSION['TEMPS']['DATAORGANISATION']);
	unset($_SESSION['TEMPS']['TOTALORGANISATION']);
	unset($_SESSION['TEMPS']['CHAMPSORGANISATION']);
	unset($_SESSION['TEMPS']['LIBELLEORGANISATION']);
	$_SESSION['TEMPS']['DATAORGANISATION'] = $data;
	$_SESSION['TEMPS']['TOTALORGANISATION'] = $total;
	$_SESSION['TEMPS']['CHAMPSORGANISATION'] = $descriptif_id;
	$_SESSION['TEMPS']['LIBELLEORGANISATION'] = $descriptif_libelle;
	//print_r($data);
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
	echo json_encode($data);
}
if(isset($_GET['action']) and $_GET['action']=="getCodeNaf")
{
	
	$data = $database->getCodeNaf($_REQUEST['queryString']);
	//print_r($data);die();
	foreach ($data as $row):
		$newData[] = array('intitule_long'	=> utf8_encode($row['intitule_long']),
							'code_naf'		=> $row['code_naf']	);
		
	endforeach;
	//print_r($newData);die();
	echo json_encode($newData);
	
}
if(isset($_GET['action']) and $_GET['action']=="getContactByOrganisation")
{
	$data = $org->getContactByOrganisation($_GET['id_organisation']);
 echo json_encode($data);
}
if(isset($_GET['action']) and $_GET['action']=="getForm")
{
	$categorie = new categorie();
	$view->listCategorie_org = $categorie->getCategories('organisation');
	echo $view->render('/modules/organisationForm.phtml');
 
}

	
?>