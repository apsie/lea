<?php
global $conn;
if(isset($_REQUEST['action']) and $_REQUEST['action']=="getApplication")
{
	$data = $p_database-> getListApplication($enabled=1);
	//print_r($data);
	for($i=0;$i<count($data);$i++)
	{
		if($data[$i]['app_enabled']==1)
		{
			$checked ='checked="checked"';
		}
		else {$checked='';}
	$rows[$i]['cell'][] = $data[$i]['app_name'];
	$rows[$i]['cell'][] = $data[$i]['app_description'];
	$rows[$i]['cell'][] = $data[$i]['app_version'];
	$rows[$i]['cell'][] = '<input '.$checked.'  type="checkbox" />';
	
	}
	$val['rows'] = $rows;
	echo json_encode($val);
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getUtilisateur")
{
	$user = new utilisateur();
	$data = $user-> getUtilisateur($_GET['qtype'],$_GET['query']);
	$dataTotal = $user->getTotalUtilisateur($_GET['qtype'],$_GET['query']);
	
	
	echo json_encode(array("DATA"=>$data,"TOTAL"=>$dataTotal));
}
// Ajax : Catégories //
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getCategorie")
{
	$categorie = new categorie();
	$data = $categorie->getCategories($_GET['cat_name']);
	for($i=0;$i<count($data);$i++)
	{
		$data[$i]['cat_name'] = utf8_encode($data[$i]['cat_name']);
	}
	
	echo json_encode($data);
	
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getCategorieById")
{
	$categorie = new categorie();
	$data = $categorie->getCategoriesById($_GET['id']);
$data['cat_name'] = utf8_encode($data['cat_name']);
		
	
	echo json_encode($data);
	
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="majCategorie")
{
	$categorie = new categorie();
	$data = $categorie->majCategorie($_GET['id'],$_GET['cat_name'],$_GET['id_parent']);

	
	echo json_encode($data);
	
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getUtilisateurById")
{
	$user = new utilisateur();
	$data = $user-> getUtilisateurById($_GET['idUtilisateur']);
	
	$data2 = $user-> getListDroit($_GET['idUtilisateur']);

	echo json_encode(array('data1'=>$data,'data2'=>$data2));
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getUtilisateurByIdGroup")
{
	$group = new groupe();
	
	
	$user = new utilisateur();
	$data2 = $user-> getUtilisateurs();
	if($_GET['idGroup']!='')
	{
		$data1 = $group-> getUtilisateurByIdGroup($_GET['idGroup']);
	$data3 = $group->getListGroup($_GET['idGroup']);
	}
	echo json_encode(array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="getGroupe")
{
	$groupe = new groupe();
	$data = $groupe-> getGroupe();
	//print_r($data);
	for($i=0;$i<count($data);$i++)
	{
		
	$rows[$i]['cell'][] = $data[$i]['account_lid'];

	
	$rows[$i]['cell'][] = '<a onclick="editGroup('.$data[$i]['account_id'].',\''.$data[$i]['account_lid'].'\')" href="javascript:void(0);" /><img src="./images/ico/edit.png" /></a>';
	
	
	
	
	}
	$val['rows'] = $rows;
	echo json_encode($val);
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="enregistrerUtilisateur")
{
	$database = new _database($conn);
	$utilisateur = new utilisateur();
	$utilisateur->identifiant= strtolower(substr($_GET['prenom'], 0,1).$_GET['nom']);
	$utilisateur->nom = $_GET['nom'];
	$utilisateur->prenom = $_GET['prenom'];
	$utilisateur->tel_pro = $_GET['tel_pro'];
	$utilisateur->tel_perso = $_GET['tel_perso'];
	$utilisateur->email = $_GET['email'];
	$utilisateur->mdp = $_GET['mdp'];
	$utilisateur->idGroupInitial = $_GET['idGroupInitial'];
	$utilisateur->idPrestataire = $_GET['idPrestataire'];
	$utilisateur->status = $_GET['status'];
	$error = $utilisateur->insertUtilisateur();
	$idUtilisateur = $database->getLastData('apsie_comptes','account_id');
	
	$droitArray = outils::getDroit($_GET['droit']);
	
	$utilisateur->idDroitUtilisateur['id_account'] = $idUtilisateur['account_id'] ;
	$utilisateur->idDroitUtilisateur['droit'] = 1;
	for($i=0;$i<count($droitArray);$i++)
	{
		if(is_numeric($droitArray[$i]))
		{
		$utilisateur->idDroitUtilisateur['id_application'] = $droitArray[$i];
		
		$utilisateur->setDroitUtilisateur();
		}
	}
	
	
	echo json_encode($error);
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="updateUtilisateur")
{
	
	$database = new _database($conn);
	
  $utilisateur = new utilisateur();
  $utilisateur->idUtilisateur = $_GET['idUtilisateur'];
	 $utilisateur->identifiant= strtolower(substr($_GET['prenom'], 0,1).$_GET['nom']);
	$utilisateur->nom = $_GET['nom'];
	$utilisateur->prenom = $_GET['prenom'];
	$utilisateur->tel_pro = $_GET['tel_pro'];
	$utilisateur->tel_perso = $_GET['tel_perso'];
	$utilisateur->email = $_GET['email'];
	$utilisateur->mdp = $_GET['mdp'];
	$utilisateur->idGroupInitial = $_GET['idGroupInitial'];
	$utilisateur->idPrestataire = $_GET['idPrestataire'];
	$utilisateur->status = $_GET['status'];
	
	
	$utilisateur->updateUtilisateur();
	
	
	$droitArray = outils::getDroit($_GET['droit']);
	
	$utilisateur->deleteDroitUtilisateur();
	$utilisateur->idDroitUtilisateur['id_account'] = $_GET['idUtilisateur'] ;
	$utilisateur->idDroitUtilisateur['droit'] = 1;
	for($i=0;$i<count($droitArray);$i++)
	{
		if(is_numeric($droitArray[$i]))
		{
		$utilisateur->idDroitUtilisateur['id_application'] = $droitArray[$i];
		
		$utilisateur->setDroitUtilisateur();
		}
	}
	
	
	echo json_encode(false);
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="addGroup")
{
	
	$database = new _database($conn);
	
 	$group = new groupe();
	$group->nom = $_GET['nomGroup'];
	$group->identifiant = $_GET['nomGroup'];
	$group->account_status = 'A';
	$group->account_expires = '-1';
	$group->account_type = 'g';
	$group->account_primary_group = 0;
	
	
	
	$group->addGroup();
	
	$data = $database->getLastData('apsie_comptes','account_id');
	$group->idGroup = $data['account_id'];
	
	
	for($i=0;$i<count($_GET['utilisateurOfGroup']);$i++)
	{
		$group->updateGroupOfUser($_GET['utilisateurOfGroup'][$i]);
	}
	
	$droitArray = outils::getDroit($_GET['droit']);
	
	$group->deleteDroitGroup();
	$group->idDroitGroup['id_group'] = $group->idGroup ;
	$group->idDroitGroup['droit'] = 1;
	for($i=0;$i<count($droitArray);$i++)
	{
		if(is_numeric($droitArray[$i]))
		{
		$group->idDroitGroup['id_application'] = $droitArray[$i];
		
		$group->setDroitGroup();
		}
	}
	
	$arrayDiff =  array_diff($_GET['check'],$_GET['utilisateurOfGroup']);
	
for($i=0;$i<count($arrayDiff);$i++)
	{	$group->idGroup = 0;
		$group->updateGroupOfUser($arrayDiff[$i]);
	}
	
	echo json_encode(true);
}

elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="updateGroup")
{
	
	$database = new _database($conn);
	
 	$group = new groupe();
  	$group->idGroup = $_GET['idGroup'];
	$group->nom = $_GET['nomGroup'];
	$group->identifiant = $_GET['identifiantGroup'];
	
	
	
	$group->updateGroup();
	
	//$idUser = explode(',', $_GET['utilisateurOfGroup']);
	
	
	
	for($i=0;$i<count($_GET['utilisateurOfGroup']);$i++)
	{
		$group->updateGroupOfUser($_GET['utilisateurOfGroup'][$i]);
	}
	
	$droitArray = outils::getDroit($_GET['droit']);
	
	$group->deleteDroitGroup();
	$group->idDroitGroup['id_group'] = $_GET['idGroup'] ;
	$group->idDroitGroup['droit'] = 1;
	for($i=0;$i<count($droitArray);$i++)
	{
		if(is_numeric($droitArray[$i]))
		{
		$group->idDroitGroup['id_application'] = $droitArray[$i];
		
		$group->setDroitGroup();
		}
	}
	
	$arrayDiff =  array_diff($_GET['check'],$_GET['utilisateurOfGroup']);
	
for($i=0;$i<count($arrayDiff);$i++)
	{	$group->idGroup = 0;
		$group->updateGroupOfUser($arrayDiff[$i]);
	}
	
	echo json_encode(true);
}


elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="deleteUtilisateur")
{
	$utilisateur = new utilisateur();
	$utilisateur->idUtilisateur= $_GET['idUtilisateur'];
	$utilisateur->deleteUtilisateur();
	
}


?>