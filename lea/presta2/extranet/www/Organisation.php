<?php
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/contact.js'); 
$view->headScript()->appendFile('./js/class/organisation.js'); 
$view->headScript()->appendFile('./js/class/calendrier.js');
$categorie = new categorie();
$view->listCategorie_org = $categorie->getCategories('organisation');
$view->listCategorie = $categorie->getCategories('contact');
$texte = new texte();

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
/* $pref['id_categorie'] = $data[0]['valeur'];
$view->pref = $pref;*/
//print_r($pref);
/*
$view->option_regime_fiscal = $texte->selectioinner_texte('regime_fiscal');
$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
$view->option_regime_social_dirigeant = $texte->selectioinner_texte('regime_social_dirigeant');
$view->option_regime_tva = $texte->selectioinner_texte('regime_tva');
$view->option_regime_imposition = $texte->selectioinner_texte('regime_imposition');
$view->option_secteur_activite = $texte->selectioinner_texte('secteur_activite');
$view->option_implantation = $texte->selectioinner_texte('implantation');
$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
$view->option_dirigeant = $texte->selectioinner_texte('dirigeant');
$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');
$view->option_forme_juridique = $texte->selectioinner_texte('forme_juridique');
//$view->option_activite_principale = $texte->selectioinner_texte('activite_principale');
$view->option_type_adresse = $texte->selectioinner_texte('type_adresse');*/
?>