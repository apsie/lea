<?php 
$presta_data = new presta_data();


switch ($_REQUEST['action'])
{
	case "set":
		$presta_data->id_presta = $_REQUEST['id_presta'];
		
		
		$compteur = $presta_data->set($_REQUEST['data'],$_REQUEST['id_presta']);
		
		if(isset($_REQUEST['id_projet']))
		{
		$projet = new projet();
		$projet->id_projet = $_REQUEST['id_projet'];
		$projet->description = $_REQUEST['projet']['description_projet'];
		$projet->insertProjet();
		}
		echo json_encode($compteur);
	break;
}

	
?>