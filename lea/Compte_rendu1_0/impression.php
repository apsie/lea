<?php


ini_set('display_errors','FATAL');
include('../../Classes/config/inc_apsie/Compte_rendu.php');
//include('config/inc_apsie/Calendrier.php');
	
	
$cpte_rendu = new compte_rendu();

/*echo $cpte_rendu->get_nb_compte_rendu(2085, 2200);
*/

// echo '..'.$cpte_rendu->get_nb_compte_rendu_by_id_compte_rendu($_GET['id_projet'], $_GET['id_presta'],$_GET['id_compte_rendu']);
// echo  '..'.$_GET['id_compte_rendu'];
// echo  '..'.$cpte_rendu->get_nb_compte_rendu($_GET['id_projet'], $_GET['id_presta']);
// exit;

//s'il s'agit du premier entretien :
if(isset($_GET['id_compte_rendu']) and $cpte_rendu->get_nb_compte_rendu_by_id_compte_rendu($_GET['id_projet'], $_GET['id_presta'],$_GET['id_compte_rendu'])==true)
{
	$cpte_rendu->imprimer_totalite_premier($_GET['id_employee'],$_GET['id_ben'], $_GET['id_projet'],$_GET['id_presta'],$_GET['id_compte_rendu']);	

}
elseif(isset($_GET['id_compte_rendu']) and $cpte_rendu->get_nb_compte_rendu_by_id_compte_rendu($_GET['id_projet'], $_GET['id_presta'],$_GET['id_compte_rendu'])==false)
{
	$test2=$cpte_rendu->get_id_compte_rendu_prec_by_id_compte_rendu($_GET['id_projet'],$_GET['id_presta'],$_GET['id_compte_rendu']);

	$cpte_rendu->imprimer_totalite_milieu($_GET['id_employee'],$_GET['id_ben'], $_GET['id_projet'], $_GET['id_presta'],$_GET['id_compte_rendu'],$test2);	
}
elseif ($cpte_rendu->get_nb_compte_rendu($_GET['id_projet'], $_GET['id_presta'])==1)
{
	$cpte_rendu->imprimer_totalite_premier($_GET['id_employee'],$_GET['id_ben'], $_GET['id_projet'],$_GET['id_presta'],$_GET['id_compte_rendu']);	
	/*echo 'aucune reponse';*/
}
//s'il s'agit d'un entretien en milieu de presta :
elseif ($cpte_rendu->get_nb_compte_rendu($_GET['id_projet'],$_GET['id_presta'])>1)
{
	/*echo 'ok' ;*/
	$test2=$cpte_rendu->get_id_compte_rendu_prec($_GET['id_projet'],$_GET['id_presta']);

	$cpte_rendu->imprimer_totalite_milieu($_GET['id_employee'],$_GET['id_ben'], $_GET['id_projet'], $_GET['id_presta'],$_GET['id_compte_rendu'],$test2);	
}

//s'il s'agit du dernier entretien :

/*elseif ()
{
	$cpte_rendu->imprimer_totalite_der(12500, 2085, 2200,$_GET['id_compte_rendu'],$test2);		
}*/


//echo 'test';
?>
  


