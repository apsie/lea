<?php include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
$epce = new epce(date('y'));


if($_GET['choix']!=NULL)
	{

	$retour=$epce->variable_beneficiaire($_GET['choix']);
	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
/*	$v_hp=$epce_eval->variable_coherence($choix);
	$v_co=$epce_eval->variable_aspect_commercial($choix);
	$v_fi=$epce_eval->aspect_financier($choix);
	$v_ju=$epce_eval->forme_juridique($choix);
	$v_re=$epce_eval->aspect_reglementaire($choix);*/
	$v_plan=$epce_eval->plan_eval($_GET['choix']);
	//$v_rdv_plan=$epce_eval->select_rdv_plan($_GET['choix']);
	//$v_bilan_avis=$epce_eval->bilan_avis($choix);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta2.css" title="blue">
<title>Plan d'évaluation</title>
<script type="text/javascript" src="../js/eval.js"></script>
</head>

<body><center><input type="button" onclick="window.location.href='../presentation/panel.php?choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><form name="form1" action="../evaluation/eval.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" />

<center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px"  type="submit" value="Sauvegarder" /></center><br/></form>


</body>
</html>