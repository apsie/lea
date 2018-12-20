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

	//$presta_epce=$epce->variable_presta_epce($_GET['choix']);
$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
$retour=$epce->variable_beneficiaire($_GET['choix']);
	$v_fi=$nacre_eval->aspect_financier($_GET['id_presta'],$_GET['choix']);
	
	//$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	}

elseif($_GET['choix']!=NULL)
	{

	$retour=$epce->variable_beneficiaire($_GET['choix']);
	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
	//$v_hp=$epce_eval->variable_coherence($choix);
	//$v_co=$epce_eval->variable_aspect_commercial($choix);
	$v_fi=$epce_eval->aspect_financier($_GET['id_presta'],$_GET['choix']);
	/*$v_ju=$epce_eval->forme_juridique($choix);
	$v_re=$epce_eval->aspect_reglementaire($choix);*/
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
<title>Aspect financier</title>
<script type="text/javascript" src="../js/eval.js"></script>
</head>

<body onload="verif_champ('an_be_cl_fi_pt_fort2');verif_champ('an_be_cl_fi_pt_fort3');verif_champ('an_be_cl_fi_pt_fort4');verif_champ('an_be_cl_fi_pt_faible2');verif_champ('an_be_cl_fi_pt_faible3');verif_champ('an_be_cl_fi_pt_faible4');verif_champ('an_con_fi_pt_fort2');verif_champ('an_con_fi_pt_fort3');verif_champ('an_con_fi_pt_fort4');verif_champ('an_con_fi_pt_faible2');verif_champ('an_con_fi_pt_faible3');verif_champ('an_con_fi_pt_faible4');verif_champ('stra_fi_pt_fort2');verif_champ('stra_fi_pt_fort3');verif_champ('stra_fi_pt_fort4');verif_champ('stra_fi_pt_faible2');verif_champ('stra_fi_pt_faible3');verif_champ('stra_fi_pt_faible4');verif_champ('plan_fi_pt_fort2');verif_champ('plan_fi_pt_fort3');verif_champ('plan_fi_pt_fort4');verif_champ('plan_fi_pt_faible2');verif_champ('plan_fi_pt_faible3');verif_champ('plan_fi_pt_faible4');verif_champ('autre_fi_pt_fort2');verif_champ('autre_fi_pt_fort3');verif_champ('autre_fi_pt_fort4');verif_champ('autre_fi_pt_faible2');verif_champ('autre_fi_pt_faible3');verif_champ('autre_fi_pt_faible4');verif_champ('action2_fi');verif_champ('action3_fi');verif_champ('action4_fi');verif_champ('delai2_fi');verif_champ('delai3_fi');verif_champ('delai4_fi');verif_champ('result1_fi');verif_champ('result2_fi');verif_champ('result3_fi');verif_champ('result4_fi');">

<center><input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>ASPECT FINANCIER : <img src="../images/icons/user.png" /> <?php echo $retour[0];?></strong> 
    </center>


<?php if(isset($color[3]) and ($color[3]==1 or $color[3]==NULL ))
 {
	?>


 <div style="border:2px solid #000; background-color:#F9EF75; display:block"  id="financier">
        <h3><img src="../images/32x32/billing.png" /> Points forts et points faibles du plan de financement</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
          
       <center><table style="border:1px dotted #666 " class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="230" height="31" align="center" bgcolor="#FF9900" class="td1"></td>
                <td style="padding-left:10px; color:#FFF"  width="400" align="center" bgcolor="#FF9900" class="td1">Points forts</td>
                <td style="padding-left:10px; color:#FFF"  width="400" align="center" bgcolor="#FF9900" class="tdFin">Points faibles</td>
              </tr>
              <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[0]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[1]);?></td>
              </tr>
               <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">Apport et/ou recherche de financement</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[23]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[26]);?></td>
              </tr>
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[24]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[27]);?></td>
              </tr>
               <tr>
                <td height="30"bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[25]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[28]); ?></td>
              </tr><tr bgcolor="#FF9900"><td><br/></td></tr>
                 <tr>
                <td  height="30"style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[2]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[3]);?></td>
              </tr>  <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">Calcul du point mort</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[29]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[32]); ?></td>
              </tr>  <tr>
                <td  height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[30]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[33]); ?></td>
              </tr>    <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[31]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[34]); ?></td>
              </tr><tr><tr bgcolor="#FF9900"><td><br/></td></tr>
                 <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[4]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[5]);?></td>
              </tr>
               <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">Plan de financement initial</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[35]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[38]); ?></td>
              </tr>
               <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[36]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[39]); ?></td>
              </tr>
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[37]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[40]); ?></td>
              </tr><tr bgcolor="#FF9900"><td><br/></td></tr>
              
                 <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[6]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[7]);?></td>
              </tr>  <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">Plan de financement a trois ans</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[41]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[44]); ?></td>
              </tr> 
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[42]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[45]); ?></td>
              </tr> 
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[43]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[46]); ?></td>
              </tr> <tr bgcolor="#FF9900"><td><br/></td></tr>
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[8]);?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[9]);?></td>
              </tr> <tr>
                <td height="30" style="padding-left:10px; color:#FFF"  bgcolor="#FF9900" class="td1 table1Col1">Autre points</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[47]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[50]); ?></td>
              </tr>
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[48]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[51]); ?></td>
              </tr>
               <tr>
                <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
                <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_fi[49]); ?></td>
                <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_fi[52]); ?></td>
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
                <td  style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_fi[10]);?></td>
                <td style="padding-left:10px;" class="td1 table3Col2"><?php echo utf8_encode($v_fi[14]);?></td>
                <td style="padding-left:10px;" class="tdFin table3Col3"><?php echo utf8_encode($v_fi[18]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_fi[11]);?></td>
                <td style="padding-left:10px;" class="td1 table3Col2"><?php echo utf8_encode($v_fi[15]);?></td>
                <td style="padding-left:10px;" class="tdFin table3Col3"><?php echo utf8_encode($v_fi[19]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_fi[12]);?></td>
                <td style="padding-left:10px;" class="td1 table3Col2"><?php echo utf8_encode($v_fi[16]);?></td>
                <td style="padding-left:10px;" class="tdFin table3Col3"><?php echo utf8_encode($v_fi[20]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_fi[13]);?></td>
                <td style="padding-left:10px;" class="td1 table3Col2"><?php echo utf8_encode($v_fi[17]);?></td>
                <td style="padding-left:10px;" class="tdFin table3Col3"><?php echo utf8_encode($v_fi[21]);?></td>
              </tr>
            </tbody></table></center><br>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3><br>
 <center><?php echo utf8_encode($v_fi[22]); ?>
</center><br/><br/>
     
        
</div>

      <?php 
 }
     
   elseif($color[3]!=1)
     {
		 ?>
<form name="form1" action="" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" />
 <div style="border:2px solid #000; background-color:#F9EF75; display:block"  id="financier">
        <h3><img src="../images/32x32/billing.png" /> Points forts et points faibles du plan de financement</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
          
       <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="251" align="center" class="td1"></td>
                <td width="283" align="center" class="td1">Points forts</td>
                <td width="283" align="center" class="tdFin">Points faibles</td>
              </tr>
              <tr>
                <td class="td1 table1Col1">Apport et/ou recherche de financement</td>
                <td class="td1 table1Col2"><select  onchange="voir_select('an_be_cl_fi_pt_fort2');afficherAutre(this.name,an_be_cl_fi_pt_forta.name);" id="an_be_cl_fi_pt_fort" name="an_be_cl_fi_pt_fort">
                  <option value="<?php echo utf8_encode($v_fi[0]);?>"> <?php echo utf8_encode($v_fi[0]);?></option>
                  <?php $epce->texte('Points forts financements'); ?>
                  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option>
                </select>                  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_forta"  id="an_be_cl_fi_pt_forta"/></td>
                <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_fi_pt_faible2');afficherAutre(this.name,an_be_cl_fi_pt_faiblea.name);" id="an_be_cl_fi_pt_faible" name="an_be_cl_fi_pt_faible"><option value="<?php echo utf8_encode($v_fi[1]);?>"> <?php echo utf8_encode($v_fi[1]);?></option><?php $epce->texte('Points faibles financements'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_faiblea"  id="an_be_cl_fi_pt_faiblea"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_fi_pt_fort3');afficherAutre(this.name,an_be_cl_fi_pt_fort2a.name);" id="an_be_cl_fi_pt_fort2" name="an_be_cl_fi_pt_fort2" style="display:none" ><option value="<?php echo utf8_encode($v_fi[23]);?>"> <?php echo utf8_encode($v_fi[23]);?></option><?php $epce->texte('Points forts financements'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_fort2a"  id="an_be_cl_fi_pt_fort2a"/></td>
                <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_fi_pt_faible3');afficherAutre(this.name,an_be_cl_fi_pt_faible2a.name);" id="an_be_cl_fi_pt_faible2" style="display:none" name="an_be_cl_fi_pt_faible2"><option value="<?php echo utf8_encode($v_fi[26]);?>"> <?php echo utf8_encode($v_fi[26]);?></option><?php $epce->texte('Points faibles financements'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_faible2a"  id="an_be_cl_fi_pt_faible2a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select style="display:none" onchange="voir_select('an_be_cl_fi_pt_fort4');afficherAutre(this.name,an_be_cl_fi_pt_fort3a.name);" id="an_be_cl_fi_pt_fort3" name="an_be_cl_fi_pt_fort3">
                  <option value="<?php echo utf8_encode($v_fi[24]);?>"> <?php echo utf8_encode($v_fi[24]);?></option>
                  <?php $epce->texte('Points forts financements'); ?>
                <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_fort3a"  id="an_be_cl_fi_pt_fort3a"/></td>
                <td class="tdFin table1Col3"><select style="display:none" onchange="voir_select('an_be_cl_fi_pt_faible4');afficherAutre(this.name,an_be_cl_fi_pt_faible3a.name);"  id="an_be_cl_fi_pt_faible3" name="an_be_cl_fi_pt_faible3"><option value="<?php echo utf8_encode($v_fi[27]);?>"> <?php echo utf8_encode($v_fi[27]);?></option><?php $epce->texte('Points faibles financements'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_fi_pt_faible3a"  id="an_be_cl_fi_pt_faible3a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="an_be_cl_fi_pt_fort4"  name="an_be_cl_fi_pt_fort4"  value="<?php echo utf8_encode($v_fi[25]); ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_be_cl_fi_pt_faible4" name="an_be_cl_fi_pt_faible4"  value="<?php echo utf8_encode($v_fi[28]); ?>" /></td>
              </tr><tr><td><br/></td></tr>
                 <tr>
                <td class="td1 table1Col1">Calcul du point mort</td>
                <td class="td1 table1Col2"><select  onchange="voir_select('an_con_fi_pt_fort2');afficherAutre(this.name,an_con_fi_pt_forta.name);" id="an_con_fi_pt_fort" name="an_con_fi_pt_fort"><option value="<?php echo utf8_encode($v_fi[2]);?>"> <?php echo utf8_encode($v_fi[2]);?></option><?php $epce->texte('Points forts point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_forta"  id="an_con_fi_pt_forta"/></td>
                <td class="tdFin table1Col3"><select     onchange="voir_select('an_con_fi_pt_faible2');afficherAutre(this.name,an_con_fi_pt_faiblea.name);" id="an_con_fi_pt_faible" name="an_con_fi_pt_faible"><option value="<?php echo utf8_encode($v_fi[3]);?>"> <?php echo utf8_encode($v_fi[3]);?></option><?php $epce->texte('Points faibles point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_faiblea"  id="an_con_fi_pt_faiblea"/></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('an_con_fi_pt_fort3');afficherAutre(this.name,an_con_fi_pt_fort2a.name);" id="an_con_fi_pt_fort2" name="an_con_fi_pt_fort2"><option value="<?php echo utf8_encode($v_fi[29]); ?>"> <?php echo utf8_encode($v_fi[29]); ?></option><?php $epce->texte('Points forts point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_fort2a"  id="an_con_fi_pt_fort2a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('an_con_fi_pt_faible3');afficherAutre(this.name,an_con_fi_pt_faible2a.name);"  id="an_con_fi_pt_faible2" name="an_con_fi_pt_faible2"><option value="<?php echo utf8_encode($v_fi[32]); ?>"> <?php echo utf8_encode($v_fi[32]); ?></option><?php $epce->texte('Points faibles point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_faible2a"  id="an_con_fi_pt_faible2a"/></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select  style="display:none"  onchange="voir_select('an_con_fi_pt_fort4');afficherAutre(this.name,an_con_fi_pt_fort3a.name);" id="an_con_fi_pt_fort3" name="an_con_fi_pt_fort3"><option value="<?php echo utf8_encode($v_fi[30]); ?>"><?php echo utf8_encode($v_fi[30]); ?> </option><?php $epce->texte('Points forts point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_fort3a"  id="an_con_fi_pt_fort3a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('an_con_fi_pt_faible4');afficherAutre(this.name,an_con_fi_pt_faible3a.name);"  id="an_con_fi_pt_faible3" name="an_con_fi_pt_faible3"><option value="<?php echo utf8_encode($v_fi[33]); ?>"><?php echo utf8_encode($v_fi[33]); ?> </option><?php $epce->texte('Points faibles point mort'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_fi_pt_faible3a"  id="an_con_fi_pt_faible3a"/></td>
              </tr>    <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="an_con_fi_pt_fort4" name="an_con_fi_pt_fort4"  value="<?php echo utf8_encode($v_fi[31]); ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_con_fi_pt_faible4" name="an_con_fi_pt_faible4"  value="<?php echo utf8_encode($v_fi[34]); ?>" /></td>
              </tr><tr><tr><td><br/></td></tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement initial</td>
                <td class="td1 table1Col2"><select    onchange="voir_select('stra_fi_pt_fort2');afficherAutre(this.name,stra_fi_pt_forta.name);" id="stra_fi_pt_fort" name="stra_fi_pt_fort"><option value="<?php echo utf8_encode($v_fi[4]);?>"> <?php echo utf8_encode($v_fi[4]);?></option><?php $epce->texte('Points forts pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_forta"  id="stra_fi_pt_forta"/></td>
                <td class="tdFin table1Col3"><select    onchange="voir_select('stra_fi_pt_faible2');afficherAutre(this.name,stra_fi_pt_faiblea.name);" id="stra_fi_pt_faible" name="stra_fi_pt_faible"><option value="<?php echo utf8_encode($v_fi[5]);?>"> <?php echo utf8_encode($v_fi[5]);?></option><?php $epce->texte('Points faibles pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_faiblea"  id="stra_fi_pt_faiblea"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select  style="display:none" onchange="voir_select('stra_fi_pt_fort3');afficherAutre(this.name,stra_fi_pt_fort2a.name);" id="stra_fi_pt_fort2" name="stra_fi_pt_fort2"><option value="<?php echo utf8_encode($v_fi[35]); ?>"> <?php echo utf8_encode($v_fi[35]); ?></option><?php $epce->texte('Points forts pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_fort2a"  id="stra_fi_pt_fort2a"/></td>
                <td class="tdFin table1Col3"><select  style="display:none"  onchange="voir_select('stra_fi_pt_faible3');afficherAutre(this.name,stra_fi_pt_faible2a.name);" id="stra_fi_pt_faible2" name="stra_fi_pt_faible2"><option value="<?php echo utf8_encode($v_fi[38]); ?>"><?php echo utf8_encode($v_fi[38]); ?></option><?php $epce->texte('Points faibles pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_faible2a"  id="stra_fi_pt_faible2a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('stra_fi_pt_fort4');afficherAutre(this.name,stra_fi_pt_fort3a.name);" id="stra_fi_pt_fort3" name="stra_fi_pt_fort3"><option value="<?php echo utf8_encode($v_fi[36]); ?>"> <?php echo utf8_encode($v_fi[36]);?></option><?php $epce->texte('Points forts pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_fort3a"  id="stra_fi_pt_fort3a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('stra_fi_pt_faible4');afficherAutre(this.name,stra_fi_pt_faible3a.name);" id="stra_fi_pt_faible3" name="stra_fi_pt_faible3"><option value="<?php echo utf8_encode($v_fi[39]); ?>"><?php echo utf8_encode($v_fi[39]); ?> </option><?php $epce->texte('Points faibles pfi'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_fi_pt_faible3a"  id="stra_fi_pt_faible3a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="stra_fi_pt_fort4" name="stra_fi_pt_fort4"  value="<?php echo utf8_encode($v_fi[37]); ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="stra_fi_pt_faible4" name="stra_fi_pt_faible4"  value="<?php echo utf8_encode($v_fi[40]); ?>" /></td>
              </tr><tr><td><br/></td></tr>
              
                 <tr>
                <td class="td1 table1Col1">Plan de financement a trois ans</td>
                <td class="td1 table1Col2"><select    onchange="voir_select('plan_fi_pt_fort2');afficherAutre(this.name,plan_fi_pt_forta.name);" id="plan_fi_pt_fort" name="plan_fi_pt_fort"><option value="<?php echo utf8_encode($v_fi[6]);?>"> <?php echo utf8_encode($v_fi[6]);?></option><?php $epce->texte('Points forts pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_forta"  id="plan_fi_pt_forta"/></td>
                <td class="tdFin table1Col3"><select    onchange="voir_select('plan_fi_pt_faible2');afficherAutre(this.name,plan_fi_pt_faiblea.name);" id="plan_fi_pt_faible" name="plan_fi_pt_faible"><option value="<?php echo utf8_encode($v_fi[7]);?>"> <?php echo utf8_encode($v_fi[7]);?></option><?php $epce->texte('Points faibles pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_faiblea"  id="plan_fi_pt_faiblea"/></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('plan_fi_pt_fort3');afficherAutre(this.name,plan_fi_pt_fort2a.name);" id="plan_fi_pt_fort2" name="plan_fi_pt_fort2"><option value="<?php echo utf8_encode($v_fi[41]); ?>"><?php echo utf8_encode($v_fi[41]); ?></option><?php $epce->texte('Points forts pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_fort2a"  id="plan_fi_pt_fort2a"/></td>
                <td class="tdFin table1Col3"><select  style="display:none"  onchange="voir_select('plan_fi_pt_faible3');afficherAutre(this.name,plan_fi_pt_faible2a.name);" id="plan_fi_pt_faible2" name="plan_fi_pt_faible2"><option value="<?php echo utf8_encode($v_fi[44]); ?>"><?php echo utf8_encode($v_fi[44]); ?> </option><?php $epce->texte('Points faibles pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_faible2a"  id="plan_fi_pt_faible2a"/></td>
              </tr> 
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('plan_fi_pt_fort4');afficherAutre(this.name,plan_fi_pt_fort3a.name);" id="plan_fi_pt_fort3" name="plan_fi_pt_fort3"><option value="<?php echo utf8_encode($v_fi[42]); ?>"><?php echo utf8_encode($v_fi[42]); ?> </option><?php $epce->texte('Points forts pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_fort3a"  id="plan_fi_pt_fort3a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('plan_fi_pt_faible4');afficherAutre(this.name,plan_fi_pt_faible3a.name);" id="plan_fi_pt_faible3" name="plan_fi_pt_faible3"><option value="<?php echo utf8_encode($v_fi[45]); ?>"> <?php echo utf8_encode($v_fi[45]); ?></option><?php $epce->texte('Points faibles pf3'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="plan_fi_pt_faible3a"  id="plan_fi_pt_faible3a"/></td>
              </tr> 
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="plan_fi_pt_fort4" name="plan_fi_pt_fort4"  value="<?php echo utf8_encode($v_fi[43]); ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="plan_fi_pt_faible4" name="plan_fi_pt_faible4"  value="<?php echo utf8_encode($v_fi[46]); ?>" /></td>
              </tr> <tr><td><br/></td></tr>
               <tr>
                <td class="td1 table1Col1">Autre points</td>
                <td class="td1 table1Col2"><select   style="display:block" onchange="voir_select('autre_fi_pt_fort2');afficherAutre(this.name,autre_fi_pt_forta.name);" id="autre_fi_pt_fort" name="autre_fi_pt_fort"><option value="<?php echo utf8_encode($v_fi[8]);?>"> <?php echo utf8_encode($v_fi[8]);?></option><?php $epce->texte('Points forts'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_forta"  id="autre_fi_pt_forta"/></td>
                <td class="tdFin table1Col3"><select  style="display:block" onchange="voir_select('autre_fi_pt_faible2');afficherAutre(this.name,autre_fi_pt_faiblea.name);" id="autre_fi_pt_faible" name="autre_fi_pt_faible"><option value="<?php echo utf8_encode($v_fi[9]);?>"> <?php echo utf8_encode($v_fi[9]);?></option><?php $epce->texte('Points faibles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_faiblea"  id="autre_fi_pt_faiblea"/></td>
              </tr> <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('autre_fi_pt_fort3');afficherAutre(this.name,autre_fi_pt_fort2a.name);"  id="autre_fi_pt_fort2" name="autre_fi_pt_fort2"><option value="<?php echo utf8_encode($v_fi[47]); ?>"> <?php echo utf8_encode($v_fi[47]); ?></option><?php $epce->texte('Points forts'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_fort2a"  id="autre_fi_pt_fort2a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('autre_fi_pt_faible3');afficherAutre(this.name,autre_fi_pt_faible2a.name);" id="autre_fi_pt_faible2" name="autre_fi_pt_faible2"><option value="<?php echo utf8_encode($v_fi[50]); ?>"><?php echo utf8_encode($v_fi[50]); ?></option><?php $epce->texte('Points faibles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_faible2a"  id="autre_fi_pt_faible2a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('autre_fi_pt_fort4');afficherAutre(this.name,autre_fi_pt_fort3a.name);" id="autre_fi_pt_fort3" name="autre_fi_pt_fort3"><option value="<?php echo utf8_encode($v_fi[48]); ?>"> <?php echo utf8_encode($v_fi[48]); ?></option><?php $epce->texte('Points forts'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_fort3a"  id="autre_fi_pt_fort3a"/></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('autre_fi_pt_faible4');afficherAutre(this.name,autre_fi_pt_faible3a.name);" id="autre_fi_pt_faible3" name="autre_fi_pt_faible3"><option value="<?php echo utf8_encode($v_fi[51]); ?>"><?php echo utf8_encode($v_fi[51]); ?> </option><?php $epce->texte('Points faibles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_fi_pt_faible3a"  id="autre_fi_pt_faible3a"/></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="autre_fi_pt_fort4" name="autre_fi_pt_fort4"  value="<?php echo utf8_encode($v_fi[49]); ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="autre_fi_pt_faible4" name="autre_fi_pt_faible4"  value="<?php echo utf8_encode($v_fi[52]); ?>" /></td>
              </tr>
        </tbody></table></center>
        <br>

 
 <h3><img src="../images/32x32/settings.png" /> Plan d'actions</h3><br>
 <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td>
                <td class="td1" align="center">Delais de realisation</td>
                <td class="tdFin" align="center">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><select onchange="voir_select('action2_fi');afficherAutre(this.name,action1_fia.name);"  id="action1_fi" name="action1_fi"><option value="<?php echo utf8_encode($v_fi[10]);?>"> <?php echo utf8_encode($v_fi[10]);?></option><?php $epce->texte('Actions'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action1_fia"  id="action1_fia"/></td>
                <td class="td1 table3Col2"><select    onchange="voir_select('delai2_fi');afficherAutre(this.name,delai1_fia.name);" id="delai1_fi" name="delai1_fi"><option value="<?php echo utf8_encode($v_fi[14]);?>"> <?php echo utf8_encode($v_fi[14]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai1_fia"  id="delai1_fia"/></td>
                <td class="tdFin table3Col3"><select  onchange="voir_select('result2_fi');afficherAutre(this.name,result1_fia.name);"  id="result1_fi" name="result1_fi"><option value="<?php echo utf8_encode($v_fi[18]);?>"> <?php echo utf8_encode($v_fi[18]);?></option><?php $epce->texte('Resultat attendu 2'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result1_fia"  id="result1_fia"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none" onchange="voir_select('action3_fi');afficherAutre(this.name,action2_fia.name);" id="action2_fi" name="action2_fi"><option value="<?php echo utf8_encode($v_fi[11]);?>"> <?php echo utf8_encode($v_fi[11]);?></option><?php $epce->texte('Actions'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action2_fia"  id="action2_fia"/></td>
                <td class="td1 table3Col2"><select style="display:none"  onchange="voir_select('delai3_fi');afficherAutre(this.name,delai2_fia.name);" id="delai2_fi" name="delai2_fi"><option value="<?php echo utf8_encode($v_fi[15]);?>"> <?php echo utf8_encode($v_fi[15]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai2_fia"  id="delai2_fia"/></td>
                <td class="tdFin table3Col3"><select id="result2_fi"  style="display:none" onchange="voir_select('result3_fi');afficherAutre(this.name,result2_fia.name);" name="result2_fi"><option value="<?php echo utf8_encode($v_fi[19]);?>"> <?php echo utf8_encode($v_fi[19]);?></option><?php $epce->texte('Resultat attendu 2'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result2_fia"  id="result2_fia"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none"  onchange="voir_select('action4_fi');afficherAutre(this.name,action3_fia.name);" id="action3_fi"  name="action3_fi"><option value="<?php echo utf8_encode($v_fi[12]);?>"> <?php echo utf8_encode($v_fi[12]);?></option><?php $epce->texte('Actions'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action3_fia"  id="action3_fia"/></td>
                <td class="td1 table3Col2"><select style="display:none"  onchange="voir_select('delai4_fi');afficherAutre(this.name,delai3_fia.name);" id="delai3_fi" name="delai3_fi"><option value="<?php echo utf8_encode($v_fi[16]);?>"> <?php echo utf8_encode($v_fi[16]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai3_fia"  id="delai3_fia"/></td>
                <td class="tdFin table3Col3"><select id="result3_fi" style="display:none" onchange="voir_select('result4_fi');afficherAutre(this.name,result3_fia.name);" name="result3_fi"><option value="<?php echo utf8_encode($v_fi[20]);?>"> <?php echo utf8_encode($v_fi[20]);?></option><?php $epce->texte('Resultat attendu 2'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result3_fia"  id="result3_fia"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none"  onchange="afficherAutre(this.name,action4_fia.name);" id="action4_fi"  name="action4_fi"><option value="<?php echo utf8_encode($v_fi[13]);?>"> <?php echo utf8_encode($v_fi[13]);?></option><?php $epce->texte('Actions'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action4_fia"  id="action4_fia"/></td>
                <td class="td1 table3Col2"><select id="delai4_fi" style="display:none"  onchange="afficherAutre(this.name,delai4_fia.name);" name="delai4_fi"><option value="<?php echo utf8_encode($v_fi[17]);?>"> <?php echo utf8_encode($v_fi[17]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai4_fia"  id="delai4_fia"/></td>
                <td class="tdFin table3Col3"><select id="result4_fi" style="display:none" onchange="afficherAutre(this.name,result4_fia.name);" name="result4_fi"><option value="<?php echo utf8_encode($v_fi[21]);?>"> <?php echo utf8_encode($v_fi[21]);?></option><?php $epce->texte('Resultat attendu 2'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result4_fia"  id="result4_fia"/></td>
              </tr>
            </tbody></table></center><br>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3><br>
 <center><textarea name="diag_fi" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo utf8_encode($v_fi[22]); ?>
</textarea></center><br/><center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px"  type="submit" name="sauvegarder" value="Sauvegarder" /></center><br/>
     
        
</div></form><form action="financier.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" />
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="suite">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" value="0" type="radio"  /> </td>
<td style="text-align: left">Enregistrer et quitter</td></tr><tr><td width="26" style="text-align: left"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input style="width:20px;height:20px" checked="checked"   type="radio" name="radio_co" value="1" /> </td>
  <td width="400" style="text-align: left">
  Enregistrer et passer à l'étape suivante</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" type="radio" value="2"  /> </td>
<td style="text-align: left">
  Mettre fin à la prestation</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="submit" name="alert2" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><form action="financier.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="radio_co" value="<?php echo $_GET['radio_co']; ?>" />
<div style="display:none; padding:10px; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 2;" id="validator">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Souhaitez vous valider cette étape ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="validator_co" value="1" type="radio"  /> </td>
<td style="text-align: left">Oui</td><td width="330" style="text-align: left; font-size:10px;">
  Attention : vous ne pourrez plus effectuer de modifications.</td></tr><tr><td width="26" style="text-align: left"><input style="width:20px;height:20px" checked="checked"   type="radio" name="validator_co" value="0" /> </td>
  <td width="178" style="text-align: left">
  Pas maintenant</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById(validator').style.display='none'" type="submit" name="validator"  value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('validator').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form>


<?php }?>
</body>
</html>

<?php 

if(isset($_POST['sauvegarder']))
{
	$rapport = new Rapport_activite($_SESSION['id']);
	$rapport->action('sauvegarde les aspects financiers de '.$retour[0].'');
	
	if($_SESSION['type_presta']=="EPCE")
	{
		$nacre_eval->verif_beneficiaire_aspect_financier($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_fi_pt_fort']),utf8_decode($_POST['an_be_cl_fi_pt_fort2']),utf8_decode($_POST['an_be_cl_fi_pt_fort3']),utf8_decode($_POST['an_be_cl_fi_pt_fort4']), utf8_decode($_POST['an_be_cl_fi_pt_faible']),utf8_decode($_POST['an_be_cl_fi_pt_faible2']),utf8_decode($_POST['an_be_cl_fi_pt_faible3']),utf8_decode($_POST['an_be_cl_fi_pt_faible4']), utf8_decode($_POST['an_con_fi_pt_fort']),utf8_decode($_POST['an_con_fi_pt_fort2']),utf8_decode($_POST['an_con_fi_pt_fort3']),utf8_decode($_POST['an_con_fi_pt_fort4']), utf8_decode($_POST['an_con_fi_pt_faible']),utf8_decode($_POST['an_con_fi_pt_faible2']),utf8_decode($_POST['an_con_fi_pt_faible3']),utf8_decode($_POST['an_con_fi_pt_faible4']), utf8_decode($_POST['stra_fi_pt_fort']),utf8_decode($_POST['stra_fi_pt_fort2']),utf8_decode($_POST['stra_fi_pt_fort3']),utf8_decode($_POST['stra_fi_pt_fort4']), utf8_decode($_POST['stra_fi_pt_faible']),utf8_decode($_POST['stra_fi_pt_faible2']),utf8_decode($_POST['stra_fi_pt_faible3']),utf8_decode($_POST['stra_fi_pt_faible4']), utf8_decode($_POST['plan_fi_pt_fort']),  utf8_decode($_POST['plan_fi_pt_fort2']), utf8_decode($_POST['plan_fi_pt_fort3']), utf8_decode($_POST['plan_fi_pt_fort4']),utf8_decode($_POST['plan_fi_pt_faible']),utf8_decode($_POST['plan_fi_pt_faible2']),utf8_decode($_POST['plan_fi_pt_faible3']),utf8_decode($_POST['plan_fi_pt_faible4']), utf8_decode($_POST['autre_fi_pt_fort']),utf8_decode($_POST['autre_fi_pt_fort2']),utf8_decode($_POST['autre_fi_pt_fort3']),utf8_decode($_POST['autre_fi_pt_fort4']), utf8_decode($_POST['autre_fi_pt_faible']),utf8_decode($_POST['autre_fi_pt_faible2']),utf8_decode($_POST['autre_fi_pt_faible3']),utf8_decode($_POST['autre_fi_pt_faible4']), utf8_decode($_POST['action1_fi']), utf8_decode($_POST['action2_fi']), utf8_decode($_POST['action3_fi']), utf8_decode($_POST['action4_fi']), utf8_decode($_POST['delai1_fi']), utf8_decode($_POST['delai2_fi']), utf8_decode($_POST['delai3_fi']), utf8_decode($_POST['delai4_fi']), utf8_decode($_POST['result1_fi']), utf8_decode($_POST['result2_fi']), utf8_decode($_POST['result3_fi']), utf8_decode($_POST['result4_fi']),  utf8_decode($_POST['diag_fi']),'');
	}
	
	if($_SESSION['type_presta']=="NACRE1")
	{
		$nacre_eval->verif_beneficiaire_aspect_financier($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_fi_pt_fort']),utf8_decode($_POST['an_be_cl_fi_pt_fort2']),utf8_decode($_POST['an_be_cl_fi_pt_fort3']),utf8_decode($_POST['an_be_cl_fi_pt_fort4']), utf8_decode($_POST['an_be_cl_fi_pt_faible']),utf8_decode($_POST['an_be_cl_fi_pt_faible2']),utf8_decode($_POST['an_be_cl_fi_pt_faible3']),utf8_decode($_POST['an_be_cl_fi_pt_faible4']), utf8_decode($_POST['an_con_fi_pt_fort']),utf8_decode($_POST['an_con_fi_pt_fort2']),utf8_decode($_POST['an_con_fi_pt_fort3']),utf8_decode($_POST['an_con_fi_pt_fort4']), utf8_decode($_POST['an_con_fi_pt_faible']),utf8_decode($_POST['an_con_fi_pt_faible2']),utf8_decode($_POST['an_con_fi_pt_faible3']),utf8_decode($_POST['an_con_fi_pt_faible4']), utf8_decode($_POST['stra_fi_pt_fort']),utf8_decode($_POST['stra_fi_pt_fort2']),utf8_decode($_POST['stra_fi_pt_fort3']),utf8_decode($_POST['stra_fi_pt_fort4']), utf8_decode($_POST['stra_fi_pt_faible']),utf8_decode($_POST['stra_fi_pt_faible2']),utf8_decode($_POST['stra_fi_pt_faible3']),utf8_decode($_POST['stra_fi_pt_faible4']), utf8_decode($_POST['plan_fi_pt_fort']),  utf8_decode($_POST['plan_fi_pt_fort2']), utf8_decode($_POST['plan_fi_pt_fort3']), utf8_decode($_POST['plan_fi_pt_fort4']),utf8_decode($_POST['plan_fi_pt_faible']),utf8_decode($_POST['plan_fi_pt_faible2']),utf8_decode($_POST['plan_fi_pt_faible3']),utf8_decode($_POST['plan_fi_pt_faible4']), utf8_decode($_POST['autre_fi_pt_fort']),utf8_decode($_POST['autre_fi_pt_fort2']),utf8_decode($_POST['autre_fi_pt_fort3']),utf8_decode($_POST['autre_fi_pt_fort4']), utf8_decode($_POST['autre_fi_pt_faible']),utf8_decode($_POST['autre_fi_pt_faible2']),utf8_decode($_POST['autre_fi_pt_faible3']),utf8_decode($_POST['autre_fi_pt_faible4']), utf8_decode($_POST['action1_fi']), utf8_decode($_POST['action2_fi']), utf8_decode($_POST['action3_fi']), utf8_decode($_POST['action4_fi']), utf8_decode($_POST['delai1_fi']), utf8_decode($_POST['delai2_fi']), utf8_decode($_POST['delai3_fi']), utf8_decode($_POST['delai4_fi']), utf8_decode($_POST['result1_fi']), utf8_decode($_POST['result2_fi']), utf8_decode($_POST['result3_fi']), utf8_decode($_POST['result4_fi']),  utf8_decode($_POST['diag_fi']),$_POST['id_presta']);
	}
	if($_SESSION['type_presta']!="NACRE1")
	{
$epce_eval->verif_beneficiaire_aspect_financier($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_fi_pt_fort']),utf8_decode($_POST['an_be_cl_fi_pt_fort2']),utf8_decode($_POST['an_be_cl_fi_pt_fort3']),utf8_decode($_POST['an_be_cl_fi_pt_fort4']), utf8_decode($_POST['an_be_cl_fi_pt_faible']),utf8_decode($_POST['an_be_cl_fi_pt_faible2']),utf8_decode($_POST['an_be_cl_fi_pt_faible3']),utf8_decode($_POST['an_be_cl_fi_pt_faible4']), utf8_decode($_POST['an_con_fi_pt_fort']),utf8_decode($_POST['an_con_fi_pt_fort2']),utf8_decode($_POST['an_con_fi_pt_fort3']),utf8_decode($_POST['an_con_fi_pt_fort4']), utf8_decode($_POST['an_con_fi_pt_faible']),utf8_decode($_POST['an_con_fi_pt_faible2']),utf8_decode($_POST['an_con_fi_pt_faible3']),utf8_decode($_POST['an_con_fi_pt_faible4']), utf8_decode($_POST['stra_fi_pt_fort']),utf8_decode($_POST['stra_fi_pt_fort2']),utf8_decode($_POST['stra_fi_pt_fort3']),utf8_decode($_POST['stra_fi_pt_fort4']), utf8_decode($_POST['stra_fi_pt_faible']),utf8_decode($_POST['stra_fi_pt_faible2']),utf8_decode($_POST['stra_fi_pt_faible3']),utf8_decode($_POST['stra_fi_pt_faible4']), utf8_decode($_POST['plan_fi_pt_fort']),  utf8_decode($_POST['plan_fi_pt_fort2']), utf8_decode($_POST['plan_fi_pt_fort3']), utf8_decode($_POST['plan_fi_pt_fort4']),utf8_decode($_POST['plan_fi_pt_faible']),utf8_decode($_POST['plan_fi_pt_faible2']),utf8_decode($_POST['plan_fi_pt_faible3']),utf8_decode($_POST['plan_fi_pt_faible4']), utf8_decode($_POST['autre_fi_pt_fort']),utf8_decode($_POST['autre_fi_pt_fort2']),utf8_decode($_POST['autre_fi_pt_fort3']),utf8_decode($_POST['autre_fi_pt_fort4']), utf8_decode($_POST['autre_fi_pt_faible']),utf8_decode($_POST['autre_fi_pt_faible2']),utf8_decode($_POST['autre_fi_pt_faible3']),utf8_decode($_POST['autre_fi_pt_faible4']), utf8_decode($_POST['action1_fi']), utf8_decode($_POST['action2_fi']), utf8_decode($_POST['action3_fi']), utf8_decode($_POST['action4_fi']), utf8_decode($_POST['delai1_fi']), utf8_decode($_POST['delai2_fi']), utf8_decode($_POST['delai3_fi']), utf8_decode($_POST['delai4_fi']), utf8_decode($_POST['result1_fi']), utf8_decode($_POST['result2_fi']), utf8_decode($_POST['result3_fi']), utf8_decode($_POST['result4_fi']),  utf8_decode($_POST['diag_fi']),$_POST['id_presta']);

	}
echo'<script>window.location.href="financier.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert=suite";</script>';
}
if($_GET['alert']=="suite")
{
echo"<script>document.getElementById('suite').style.display='block';</script>";

}
if(isset($_POST['alert2']))
{

	echo'<script>window.location.href="financier.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert3=1&radio_co='.$_POST['radio_co'].'"</script>';
}

if($_POST['validator_co']==1)
{
	$epce->valider($_POST['id_beneficiaire'],"financier",$_POST['id_presta']);
	
}
if(isset($_POST['validator']) and $_POST['radio_co']==0)
{

	echo'<script>window.location.href="../presentation/panel.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&display_eval=block";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==1)
{

	echo'<script>window.location.href="juridique.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==2)
{
 $_SESSION['abandon'] = "ab_financier";
	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}


		if($_GET['alert3']==1)
{ 
  	echo"<script>document.getElementById('validator').style.display='block';</script>";
	
}


?>
