<?php 
session_start();
include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../inc/class.rapport_activite.inc.php');
include('../../nacre1/inc/class.nacre_evaluation.inc.php');
$epce = new epce(date('y'));

	if($_SESSION['type_presta']=="NACRE1")
{

	$epce->table_validation = "egw_nacre_validation";
}

//include('/data/html/presta/nacre1/inc/class.nacre_evaluation.inc.php');

$nacre_eval = new nacre_evaluation();

if($_SESSION['type_presta']=='NACRE1' and $_GET['choix']!=NULL)
	{

	$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);

$retour=$epce->variable_beneficiaire($_GET['choix']);

	$v_ju=$nacre_eval->forme_juridique($_GET['id_presta'],$_GET['choix']);
	
	//$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	}

elseif($_GET['choix']!=NULL)	{

$retour=$epce->variable_beneficiaire($_GET['choix']);
	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
/*	$v_hp=$epce_eval->variable_coherence($choix);
	$v_co=$epce_eval->variable_aspect_commercial($choix);
	$v_fi=$epce_eval->aspect_financier($choix);*/
	$v_ju=$epce_eval->forme_juridique($_GET['id_presta'],$_GET['choix']);
	//$v_re=$epce_eval->aspect_reglementaire($choix);
	//$v_plan=$epce_eval->plan_eval($_GET['choix']);
	//$v_rdv_plan=$epce_eval->select_rdv_plan($_GET['choix']);
	//$v_bilan_avis=$epce_eval->bilan_avis($choix);
		$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta_coherence.css" title="blue">
<title>Satut juridique</title>
<script type="text/javascript" src="../js/eval.js"></script>
</head>

<body onload="verif_champ('pt_fort2');verif_champ('pt_fort3');verif_champ('pt_fort4');verif_champ('pt_faible2');verif_champ('pt_faible3');verif_champ('pt_faible4');verif_champ('delai2_ju');verif_champ('delai3_ju');verif_champ('delai4_ju');verif_champ('ac2');verif_champ('ac3');verif_champ('ac4');verif_champ('result2_ju');verif_champ('result3_ju');verif_champ('result4_ju');" ><center><input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>ASPECT JURIDIQUE : <img src="../images/icons/user.png" /> <?php echo $retour[0];?></strong> 
    </center>


<?php if(isset($color[4]) and ($color[4]==1 or $color[4]==NULL ))
 {
	?>
   <form name="form1" action="../evaluation/eval.php" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" />

<div style="border:2px solid #000; background-color:#F999A3 ;display:block" id="juridique">
        <h3><img src="../images/32x32/old-versions.png"/> Points forts et points faibles du statut juridique choisi</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
<center> <table  style="border:1px dotted #666 " class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
              
                <td  width="500" height="31" align="center" class="td1" style="padding-left:10px; color:#FFF; background-color: #FF9900">Points forts</td>
                <td  width="500"  style="padding-left:10px; color:#FFF;background-color: #FF9900"   align="center" class="tdFin">Points faibles</td>
              </tr>
              <tr>
               
                <td  style="padding-left:10px" valign="top" class="td1 table1Col1"><br/><?php echo utf8_encode($v_ju[0]);?><br/><br/><?php echo utf8_encode($v_ju[1]);?><br/><br/><?php echo utf8_encode($v_ju[2]);?><br/><br/><?php echo utf8_encode($v_ju[3]);?><br/><br/> </td>
                <td  style="padding-left:10px"valign="top"class="tdFin table1Col2"><br/><?php echo utf8_encode($v_ju[4]);?><br/><br/><?php echo utf8_encode($v_ju[5]);?><br/><br/><?php echo utf8_encode($v_ju[6]);?><br/><br/><?php echo utf8_encode($v_ju[7]);?><br/><br/></td>
              </tr>
            </tbody></table></center>
        <br>

 
 <h3><img src="../images/32x32/settings.png" /> Plan d'actions</h3><br>
 <center><table style="border:1px dotted #999" class="tableGen" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                <td style=" background-color: #FF9900; color:#FFF; font-weight:bolder" width="350" height="31" align="center" class="td1">Actions a mener</td>
                <td style=" background-color: #FF9900; color:#FFF; font-weight:bolder" width="300" align="center" class="td1">Delais de realisation</td>
                <td style=" background-color: #FF9900; color:#FFF; font-weight:bolder" width="350" align="center" class="tdFin">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td  style="padding-left:10px;" valign="top" class="td1 table3Col1"><br/><?php echo utf8_encode($v_ju[8]);?><br/><br/><?php echo utf8_encode($v_ju[9]);?><br/><br/><?php echo utf8_encode($v_ju[10]);?><br/><br/><?php echo utf8_encode($v_ju[11]);?><br/><br/></td>
                <td  style="padding-left:10px;" valign="top" class="td1 table3Col2"><br/><?php echo utf8_encode($v_ju[12]);?><br/><br/><?php echo utf8_encode($v_ju[13]);?><br/><br/><?php echo utf8_encode($v_ju[14]);?><br/><br/><?php echo utf8_encode($v_ju[15]);?><br/><br/></td>
                <td  style="padding-left:10px;" valign="top" class="tdFin table3Col3"><br/><?php echo utf8_encode($v_ju[16]);?><br/><br/><?php echo utf8_encode($v_ju[17]);?><br/><br/><?php echo utf8_encode($v_ju[18]);?><br/><br/><?php echo utf8_encode($v_ju[19]);?><br/><br/></td>
              </tr>
            </tbody></table></center>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3>
 <center><?php echo utf8_encode($v_ju[20]); ?>
   </center>   <br/>            
   
        


<br/></div>

    <?php 
 }
     
   elseif($color[4]!=1)
     {
		 ?>
   
    <form name="form1" action="" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />

<div style="border:2px solid #000; background-color:#F999A3 ;display:block" id="juridique">
        <h3><img src="../images/32x32/old-versions.png"/> Points forts et points faibles du statut juridique choisi</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
<center> <table  width="500"class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
              
                <td width="350" align="center" class="td1">Points forts</td>
                <td width="343" align="center" class="tdFin">Points faibles</td>
              </tr>
              <tr>
               
                <td  valign="top" class="td1 table1Col1"><select  onchange="voir_select('pt_fort2');afficherAutre(this.name,pt_forta.name);" id="pt_fort" name="pt_fort"><option value="<?php echo utf8_encode($v_ju[0]);?>"> <?php echo utf8_encode($v_ju[0]);?></option><?php $epce->texte('Points forts statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_forta"  id="pt_forta"/> <select style="display:none"  onchange="voir_select('pt_fort3');afficherAutre(this.name,pt_fort2a.name);" id="pt_fort2" name="pt_fort2"><option value="<?php echo utf8_encode($v_ju[1]);?>"> <?php echo utf8_encode($v_ju[1]);?></option><?php $epce->texte('Points forts statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_fort2a"  id="pt_fort2a"/><select   style="display:none" onchange="voir_select('pt_fort4');afficherAutre(this.name,pt_fort3a.name);" id="pt_fort3" name="pt_fort3"><option value="<?php echo utf8_encode($v_ju[2]);?>"> <?php echo utf8_encode($v_ju[2]);?></option><?php $epce->texte('Points forts statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_fort3a"  id="pt_fort3a"/><select  style="display:none" onchange="afficherAutre(this.name,pt_fort4a.name);" id="pt_fort4" name="pt_fort4"><option value="<?php echo utf8_encode($v_ju[3]);?>"> <?php echo utf8_encode($v_ju[3]);?></option><?php $epce->texte('Points forts statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_fort4a"  id="pt_fort4a"/> </td>
                <td  valign="top"class="tdFin table1Col2"><select id="pt_faible" onchange="voir_select('pt_faible2');afficherAutre(this.name,pt_faiblea.name);" name="pt_faible"><option value="<?php echo utf8_encode($v_ju[4]);?>"> <?php echo utf8_encode($v_ju[4]);?></option><?php $epce->texte('Points faibles statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_faiblea"  id="pt_faiblea"/><select  style="display:none" onchange="voir_select('pt_faible3');afficherAutre(this.name,pt_faible2a.name);" id="pt_faible2"  name="pt_faible2"><option value="<?php echo utf8_encode($v_ju[5]);?>"> <?php echo utf8_encode($v_ju[5]);?></option><?php $epce->texte('Points faibles statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_faible2a"  id="pt_faible2a"/><select  style="display:none" onchange="voir_select('pt_faible4');afficherAutre(this.name,pt_faible3a.name);" id="pt_faible3" name="pt_faible3"><option value="<?php echo utf8_encode($v_ju[6]);?>"> <?php echo utf8_encode($v_ju[6]);?></option><?php $epce->texte('Points faibles statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_faible3a"  id="pt_faible3a"/><select   style="display:none" onchange="afficherAutre(this.name,pt_faible4a.name);" id="pt_faible4" name="pt_faible4"><option value="<?php echo utf8_encode($v_ju[7]);?>"> <?php echo utf8_encode($v_ju[7]);?></option><?php $epce->texte('Points faibles statut juridique'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="pt_faible4a"  id="pt_faible4a"/></td>
              </tr>
            </tbody></table></center>
        <br>

 
 <h3><img src="../images/32x32/settings.png" /> Plan d'actions</h3><br>
 <center><table width="700px" class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="300" align="center" class="td1">Actions a mener</td>
                <td width="300" align="center" class="td1">Delais de realisation</td>
                <td width="381" align="center" class="tdFin">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td valign="top" class="td1 table3Col1"><select onchange="voir_select('ac2');afficherAutre(this.name,ac1a.name);" id="ac1" name="ac1"><option value="<?php echo utf8_encode($v_ju[8]);?>"><?php echo utf8_encode($v_ju[8]);?></option><?php $epce->texte('Action_ju'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="ac1a"  id="ac1a"/> <select   style="display:none" onchange="voir_select('ac3');afficherAutre(this.name,ac2a.name);"  id="ac2" name="ac2"><option value="<?php echo utf8_encode($v_ju[9]);?>"> <?php echo utf8_encode($v_ju[9]);?></option><?php $epce->texte('Action_ju'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="ac2a"  id="ac2a"/><select  style="display:none"  onchange="voir_select('ac4');afficherAutre(this.name,ac3a.name);" id="ac3" name="ac3"><option value="<?php echo utf8_encode($v_ju[10]);?>"> <?php echo utf8_encode($v_ju[10]);?></option><?php $epce->texte('Action_ju'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="ac3a"  id="ac3a"/><select  style="display:none" onchange="afficherAutre(this.name,ac4a.name);" id="ac4" name="ac4"><option value="<?php echo utf8_encode($v_ju[11]);?>"> <?php echo utf8_encode($v_ju[11]);?></option><?php $epce->texte('Action_ju'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="ac4a"  id="ac4a"/></td>
                <td valign="top" class="td1 table3Col2"><select  onchange="voir_select('delai2_ju');afficherAutre(this.name,delai1_jua.name);"  id="delai1_ju" name="delai1_ju"><option value="<?php echo utf8_encode($v_ju[12]);?>"><?php echo utf8_encode($v_ju[12]);?></option><?php $epce->texte('Delais / Priorite'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai1_jua"  id="delai1_jua"/> <select  style="display:none" onchange="voir_select('delai3_ju');afficherAutre(this.name,delai2_jua.name);" id="delai2_ju" name="delai2_ju"><option value="<?php echo utf8_encode($v_ju[13]);?>"><?php echo utf8_encode($v_ju[13]);?></option><?php $epce->texte('Delais / Priorite'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai2_jua"  id="delai2_jua"/><select  style="display:none"  onchange="voir_select('delai4_ju');afficherAutre(this.name,delai3_jua.name);" id="delai3_ju" name="delai3_ju"><option value="<?php echo utf8_encode($v_ju[14]);?>"><?php echo utf8_encode($v_ju[14]);?></option><?php $epce->texte('Delais / Priorite'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai3_jua"  id="delai3_jua"/><select style="display:none"  onchange="afficherAutre(this.name,delai4_jua.name);" id="delai4_ju" name="delai4_ju"><option value="<?php echo utf8_encode($v_ju[15]);?>"><?php echo utf8_encode($v_ju[15]);?></option><?php $epce->texte('Delais / Priorite'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai4_jua"  id="delai4_jua"/></td>
                <td valign="top" class="tdFin table3Col3"><select onchange="voir_select('result2_ju');afficherAutre(this.name,result1_jua.name);" id="result1_ju" name="result1_ju"><option value="<?php echo utf8_encode($v_ju[16]);?>"><?php echo utf8_encode($v_ju[16]);?></option><?php $epce->texte('Resultat attendu 3'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result1_jua"  id="result1_jua"/> <select  style="display:none" onchange="voir_select('result3_ju');afficherAutre(this.name,result2_jua.name);" id="result2_ju" name="result2_ju"><option value="<?php echo utf8_encode($v_ju[17]);?>"><?php echo utf8_encode($v_ju[17]);?></option><?php $epce->texte('Resultat attendu 3'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result2_jua"  id="result2_jua"/><select  style="display:none" onchange="voir_select('result4_ju');afficherAutre(this.name,result3_jua.name);" id="result3_ju"  name="result3_ju"><option value="<?php echo utf8_encode($v_ju[18]);?>"><?php echo utf8_encode($v_ju[18]);?></option><?php $epce->texte('Resultat attendu 3'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result3_jua"  id="result3_jua"/><select  style="display:none" onchange="afficherAutre(this.name,result4_jua.name);" id="result4_ju" name="result4_ju"><option value="<?php echo utf8_encode($v_ju[19]);?>"><?php echo utf8_encode($v_ju[19]);?></option><?php $epce->texte('Resultat attendu 3'); ?>  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result4_jua"  id="result4_jua"/></td><td width="2"></td>
              </tr>
            </tbody></table></center>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3>
 <center><textarea name="diag_ju" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaJuriDiagComm" class="commentaire"><?php echo utf8_encode($v_ju[20]); ?></textarea>
   </center>   <br/>            
   
        
<br/>

<center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px"  type="submit" name="sauvegarder" value="Sauvegarder" /></center><br/></div></form><form action="juridique.php" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" />
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="suite">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" value="0" type="radio"  /> </td>
<td style="text-align: left">Enregistrer et quitter</td></tr><tr><td width="26" style="text-align: left"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input style="width:20px;height:20px" checked="checked"   type="radio" name="radio_co" value="1" /> </td>
  <td width="400" style="text-align: left">
  Enregistrer et passer à l'étape suivante</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" type="radio" value="2"  /> </td>
<td style="text-align: left">
  Mettre fin à la prestation</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="submit" name="alert2" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><form action="juridique.php" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="radio_co" value="<?php echo $_GET['radio_co']; ?>" />
<div style="display:none; padding:10px; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 2;" id="validator">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Souhaitez vous valider cette étape ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="validator_co" value="1" type="radio"  /> </td>
<td style="text-align: left">Oui</td><td width="330" style="text-align: left; font-size:10px;">
  Attention : vous ne pourrez plus effectuer de modifications.</td></tr><tr><td width="26" style="text-align: left"><input style="width:20px;height:20px" checked="checked"   type="radio" name="validator_co" value="0" /> </td>
  <td width="178" style="text-align: left">
  Pas maintenant</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById(validator').style.display='none'" type="submit" name="validator"  value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('validator').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><?php }?>


</body>
</html>
<?php

if(isset($_POST['sauvegarder']))
{
	$rapport = new Rapport_activite($_SESSION['id']);
	$rapport->action('sauvegarde les aspects juridiques de '.$retour[0].'');
	
	
	if($_SESSION['type_presta']=="EPCE")
	{
		$nacre_eval->verif_beneficiaire_forme_juridique($_POST['id_beneficiaire'], utf8_decode($_POST['pt_fort']), utf8_decode($_POST['pt_fort2']), utf8_decode($_POST['pt_fort3']), utf8_decode($_POST['pt_fort4']), utf8_decode($_POST['pt_faible']), utf8_decode($_POST['pt_faible2']), utf8_decode($_POST['pt_faible3']),utf8_decode($_POST['pt_faible4']),utf8_decode($_POST['ac1']),utf8_decode($_POST['ac2']),utf8_decode($_POST['ac3']),utf8_decode($_POST['ac4']),utf8_decode($_POST['delai1_ju']),utf8_decode($_POST['delai2_ju']),utf8_decode($_POST['delai3_ju']),utf8_decode($_POST['delai4_ju']),utf8_decode($_POST['result1_ju']),utf8_decode($_POST['result2_ju']),utf8_decode($_POST['result3_ju']),utf8_decode($_POST['result4_ju']),utf8_decode($_POST['diag_ju']),'');

	}
	
	if($_SESSION['type_presta']=="NACRE1")
	{
		$nacre_eval->verif_beneficiaire_forme_juridique($_POST['id_beneficiaire'], utf8_decode($_POST['pt_fort']), utf8_decode($_POST['pt_fort2']), utf8_decode($_POST['pt_fort3']), utf8_decode($_POST['pt_fort4']), utf8_decode($_POST['pt_faible']), utf8_decode($_POST['pt_faible2']), utf8_decode($_POST['pt_faible3']),utf8_decode($_POST['pt_faible4']),utf8_decode($_POST['ac1']),utf8_decode($_POST['ac2']),utf8_decode($_POST['ac3']),utf8_decode($_POST['ac4']),utf8_decode($_POST['delai1_ju']),utf8_decode($_POST['delai2_ju']),utf8_decode($_POST['delai3_ju']),utf8_decode($_POST['delai4_ju']),utf8_decode($_POST['result1_ju']),utf8_decode($_POST['result2_ju']),utf8_decode($_POST['result3_ju']),utf8_decode($_POST['result4_ju']),utf8_decode($_POST['diag_ju']),$_POST['id_presta']);

	}
		
	if($_SESSION['type_presta']!="NACRE1")
	{
$epce_eval->verif_beneficiaire_forme_juridique($_POST['id_beneficiaire'], utf8_decode($_POST['pt_fort']), utf8_decode($_POST['pt_fort2']), utf8_decode($_POST['pt_fort3']), utf8_decode($_POST['pt_fort4']), utf8_decode($_POST['pt_faible']), utf8_decode($_POST['pt_faible2']), utf8_decode($_POST['pt_faible3']),utf8_decode($_POST['pt_faible4']),utf8_decode($_POST['ac1']),utf8_decode($_POST['ac2']),utf8_decode($_POST['ac3']),utf8_decode($_POST['ac4']),utf8_decode($_POST['delai1_ju']),utf8_decode($_POST['delai2_ju']),utf8_decode($_POST['delai3_ju']),utf8_decode($_POST['delai4_ju']),utf8_decode($_POST['result1_ju']),utf8_decode($_POST['result2_ju']),utf8_decode($_POST['result3_ju']),utf8_decode($_POST['result4_ju']),utf8_decode($_POST['diag_ju']),$_POST['id_presta']);

}
echo'<script>window.location.href="juridique.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert=suite";</script>';
}
if($_GET['alert']=="suite")
{
echo"<script>document.getElementById('suite').style.display='block';</script>";

}
if(isset($_POST['alert2']))
{

	echo'<script>window.location.href="juridique.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert3=1&radio_co='.$_POST['radio_co'].'"</script>';
}

if($_POST['validator_co']==1)
{
	$epce->valider($_POST['id_beneficiaire'],"juridique",$_POST['id_presta']);
	
}
if(isset($_POST['validator']) and $_POST['radio_co']==0)
{

	echo'<script>window.location.href="../presentation/panel.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&display_eval=block";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==1)
{

	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==2)
{
 $_SESSION['abandon'] = "ab_juridique";
	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}


		if($_GET['alert3']==1)
{ 
  	echo"<script>document.getElementById('validator').style.display='block';</script>";
	
}

?>
