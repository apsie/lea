<?php

include('../inc/class.epce.inc.php');
$epce = new epce(date('y'));
$epce->return_contact_prescripteur($_POST['id_ben'],$_POST['code_safir'],$_POST['nom_p'],$_POST['prenom_p'],$_POST['civilite_p'],$_POST['tel_bureau_p'],$_POST['tel_portable_p'],$_POST['email_bureau_p'],$_POST['email_domicile_p']);


header("Location: ./panel.php?choix=".$_POST['id_ben'].""); 

	

?>