<?php
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/contact.js'); 
$view->headScript()->appendFile('./js/class/organisation.js'); 
$categorie = new categorie();
$view->listCategorie = $categorie->getCategories('contact');

$user = new _user($conn);
$param = $user->getParametre($_SESSION['UTILISATEUR']['account_id']);
$view->param= $param;

if(isset($_SESSION['TEMPS']['IDPARAMETRE']) and $_SESSION['TEMPS']['IDPARAMETRE']!="")
{
$idParam = $_SESSION['TEMPS']['IDPARAMETRE'] ;

}else {$idParam=$param[0]['id_parametre'];}
$data = $user->getPreference($_SESSION['UTILISATEUR']['account_id'], 3,$idParam);
$view->paramInfo = $user->getParametreById($idParam);

//print_r($data);
for($i=0;$i<count($data);$i++)
{
	if($data[$i]['valeur']==1)
	{
		$pref[$data[$i]['cle']] = "checked='checked'";
	}
}
 $pref['id_categorie'] = $data[0]['valeur'];
$view->pref = $pref;
//print_r($pref);



?>