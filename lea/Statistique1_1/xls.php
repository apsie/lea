<?php 
include("inc/class.statistique.inc.php");

if(isset($_GET['xls']))
{
	
	$statistique = new statistique();
	$statistique->date_debut_stats = mktime(0,0,0,4,1,2010) ;
$statistique->date_fin_stats = mktime(0,0,0,date('m'),date('d'),date('Y'));
 
	$statistique->stats_xls();

}

?>