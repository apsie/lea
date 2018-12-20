<?php
global $conn;
switch ($_REQUEST['action'])
{
	case "code_rome":
	
	$database = new _database($conn);
	$data = $database->getCodeRome(Outils::supCaractere($_REQUEST['term']));
	
	//print_r($data);
	
	foreach ($data as $key => $row):
	$newData[] = array('id'=>$key , 'label'=>utf8_decode($row['appellation'].' ( '.$row['code_rome'].' ) ' ), 'value' =>utf8_decode($row['appellation'] .' ( '.$row['code_rome'].' ) '));
	endforeach;
	echo json_encode($newData);
	break;
	
	case "entreprise":
	
	$database = new _database($conn);
	$data = $database->getEntreprise(Outils::supCaractere($_REQUEST['term']));
	
	//print_r($data);
	
	foreach ($data as $key => $row):
	$newData[] = array('id'=>$row['id_organisation'] , 'label'=>$row['id_organisation'].' - '.utf8_decode($row['nom_organisme']), 'value' =>utf8_decode($row['nom_organisme']));
	endforeach;
	
	if(!isset($newData))
	$newData[0] = array('id'=>'' , 'label'=>'Pas de résultat', 'value' =>'');
	
	echo json_encode($newData);
	break;
	
	case "maj_texte":
	$key = texte::getKey();
	//print_r($key);die();
	if(isset($_REQUEST['id_texte']))
	$view->data = texte::getTexte(array('id_texte'=>$_REQUEST['id_texte']));
	
	$view->key = $key;
	echo  $view->render('modules/maj_texte.phtml');
	break;
	case "liste_texte":
	$data = texte::getTexte($_REQUEST);
	//print_r($key);die();
	$view->data = $data;
	echo  $view->render('modules/liste_texte.phtml');
	break;
	case "del_texte":
	$data = texte::delTexte($_REQUEST['id_texte']);
	break;
}