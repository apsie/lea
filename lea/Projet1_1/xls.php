<?php 
include("inc/class.projet.inc.php");

if(isset($_GET['id_projet']) and isset($_GET['plan_3ans']))
{
	$projet = new projet();
	$projet->xls_plan_fi_3ans($_GET['id_projet']);
}

elseif(isset($_GET['id_projet']) and isset($_GET['cr_3ans']))
{
	
	$projet = new projet();
	
	$projet->xls_cr_3ans($_GET['id_projet']);

}

?>
