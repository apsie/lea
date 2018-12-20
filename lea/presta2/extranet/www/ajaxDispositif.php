<?php
global $conn;

$database= new _database($conn);
$dispositif = new dispositif();

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
if(isset($_GET['action']) and $_GET['action']=="addDispositif")
{

	$dispositif->id_dispositif = $_GET['id_dispositif'];
	$dispositif->nom_dispositif = $_GET['nom_dispositif'];
	$dispositif->numero_marche = $_GET['numero_marche'];
	$dispositif->objet = $_GET['objet'];
	$dispositif->date_debut = outils::getTps($_GET['date_debut']);
	$dispositif->date_fin = outils::getTps($_GET['date_fin']);
	$dispositif->is_active = $_GET['is_active'];
	
	
	
	
	$dispositif->insertDispositif();
	return json_encode(true);
}

if(isset($_GET['action']) and $_GET['action']=="getDispositif")
{

	$data = $dispositif->getDispositif($_GET['is_active'],$_GET['id_dispositif']);

	$total =0;
	
	if(!isset($_GET['id_dispositif']) || $_GET['id_dispositif']!="" )
{
for($i=0;$i<count($data);$i++)
	{
		$total++;
		$data[$i]['objet'] = utf8_encode($data[$i]['objet']);
		if(is_numeric($data[$i]['date_debut']) && $data[$i]['date_debut']!=0)
		{$data[$i]['date_debut']=date('d/m/Y',$data[$i]['date_debut']);}
		else
		{
			$data[$i]['date_debut']='';
		}
	
		if(is_numeric($data[$i]['date_fin']) && $data[$i]['date_fin']!=0)
		{$data[$i]['date_fin']=date('d/m/Y',$data[$i]['date_fin']);}
		else
		{
			$data[$i]['date_fin']='';
		}
	} 
	
	unset($_SESSION['TEMPS']['DATADISPOSITIF']);
	unset($_SESSION['TEMPS']['TOTALDISPOSITIF']);

	$_SESSION['TEMPS']['DATADISPOSITIF'] = $data;
	$_SESSION['TEMPS']['TOTALDISPOSITIF'] = $total;
}
else
{
	

     $data['objet'] = utf8_encode($data['objet']);
		if(is_numeric($data['date_debut']) && $data['date_debut']!=0)
		{$data['date_debut']=date('d/m/Y',$data['date_debut']);}
		else
		{
			$data['date_debut']='';
		}
	
		if(is_numeric($data['date_fin']) && $data['date_fin']!=0)
		{$data['date_fin']=date('d/m/Y',$data['date_fin']);}
		else
		{
			$data['date_fin']='';
		}
			
	}
	
	
echo json_encode(array("DATA"=>$data,"TOTAL"=>$total));
}

	


?>