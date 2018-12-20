<?php

	include("../../Classes/config/inc_apsie/Xls.php");
	
$xls = new Xls();	
$xls->liste_contact_cochee($_GET['id_contact'],$_GET['id_employee'],$_GET['intitule_requete']);

echo $_GET['intitule_requete'];
?>

