<?php 
$view->headScript()->appendFile('./js/prototype.js'); 
$view->headScript()->appendFile('./js/class/option.js');
$_GET['header'] =0 ;
#exemple
//if(!isset($_POST['id_presta']))
//$_POST['id_presta'] = 6071;
#Init
$presta_data = new presta_data();



#Récupération de la data du projet
$data = projet::getProjetByPresta($_POST['id_presta']);
$view->projet = $data;

#Récupération de la data du contact
$view->contact = contact::get_contactv2(NULL,$_POST['id_presta']);

#Récupération de la data en fonction de la presta
$dataPresta = $presta_data->get($_POST['id_presta']);
$view->presta = outils::convertDataPresta($dataPresta);

#prestation
$view->prestation = prestation::getPrestationByIdPresta($_POST['id_presta']);



$text["Stade_projet"] = texte::get("Stade_projet");
$text["pt"] = texte::get("pt");
$text["Attentes du beneficiaire"] = texte::get("Attentes du beneficiaire");
$text["Capacites liees aux emplois exerces"] = texte::get("Capacites liees aux emplois exerces");
$text["Competences professionnelles"] = texte::get("Competences professionnelles");
$text["Formation et savoirs theoriques"] = texte::get("Formation et savoirs theoriques");
$text["Elements porteurs"] = texte::get("Elements porteurs");
$text["Points de vigilance"] = texte::get("Points de vigilance");
$text["Competence"] = texte::get("Competence");
$text["Delais / Priorite"] = texte::get("Delais / Priorite");
$text["Type de formation courte recommandee"] = texte::get("Type de formation courte recommandee");
$text["Points forts clients"] = texte::get("Points forts clients");
$text["Points faibles clients"] = texte::get("Points faibles clients");
$text["Points forts concurrence"] = texte::get("Points forts concurrence");
$text["Points faibles concurrence"] = texte::get("Points faibles concurrence");
$text["Points forts strategie"] = texte::get("Points forts strategie");
$text["Points faibles strategie"] = texte::get("Points faibles strategie");
$text["Actions"] = texte::get("Actions");
$text["Action"] = texte::get("Action");
$text["Resultats attendus 1"] = texte::get("Resultats attendus 1");
$text["Resultat attendu 2"] = texte::get("Resultat attendu 2");
$text["Points faibles financements"] = texte::get("Points faibles financements");
$text["Points forts financements"] = texte::get("Points forts financements");
$text["Points forts financements"] = texte::get("Points forts financements");
$text["Points forts point mort"] = texte::get("Points forts point mort");
$text["Points faibles point mort"] = texte::get("Points faibles point mort");
$text["Points forts pfi"] = texte::get("Points forts pfi");
$text["Points faibles pfi"] = texte::get("Points faibles pfi");
$text["Points faibles pf3"] = texte::get("Points faibles pf3");
$text["Points forts pf3"] = texte::get("Points forts pf3");
$text["Points forts statut juridique"] = texte::get("Points forts statut juridique");
$text["Points faibles statut juridique"] = texte::get("Points faibles statut juridique");
$text["Action_ju"] = texte::get("Action_ju");
$text["Resultat attendu 3"] = texte::get("Resultat attendu 3");

$view->texte = $text; 
$view->id_presta = $_POST['id_presta']; 




?>