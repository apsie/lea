<?php 
session_start();
include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../inc/class.rapport_activite.inc.php');
$epce = new epce(date('y'));

	
	if($_SESSION['type_presta']=="NACRE1")
{

	$epce->table_validation = "egw_nacre_validation";
}
include('../../nacre1/inc/class.nacre_evaluation.inc.php');
$nacre_eval = new nacre_evaluation();

if($_SESSION['type_presta']=="NACRE1" and $_GET['choix']!=NULL)
{



	$v_co=$nacre_eval->variable_aspect_commercial($_GET['id_presta'],$_GET['choix']);
	$retour=$epce->variable_beneficiaire($_GET['choix']);
$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	
	// $color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);

}

elseif($_GET['choix']!=NULL)
{
$retour=$epce->variable_beneficiaire($_GET['choix']);


	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
	//$v_hp=$epce_eval->variable_coherence($_GET['choix']);
	$v_co=$epce_eval->variable_aspect_commercial($_GET['id_presta'],$_GET['choix']);
	//$v_fi=$epce_eval->aspect_financier($_GET['choix']);
	//$v_ju=$epce_eval->forme_juridique($_GET['choix']);
	//$v_re=$epce_eval->aspect_reglementaire($_GET['choix']);
	//$v_plan=$epce_eval->plan_eval($_GET['choix']);
	//$v_rdv_plan=$epce_eval->select_rdv_plan($_GET['choix']);
	//$v_bilan_avis=$epce_eval->bilan_avis($_GET['choix']);
	 $color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta_coherence.css" title="blue">
<title>Aspect commerciaux</title>
<script type="text/javascript" src="../js/eval.js"></script>
</head>

<body onload="verif_champ('an_be_cl_pt_fort2');verif_champ('an_be_cl_pt_fort3');verif_champ('an_be_cl_pt_fort4');verif_champ('an_be_cl_pt_faible2');verif_champ('an_be_cl_pt_faible3');verif_champ('an_be_cl_pt_faible4');verif_champ('an_con_pt_fort2');verif_champ('an_con_pt_fort3');verif_champ('an_con_pt_fort4');verif_champ('an_con_pt_faible2');verif_champ('an_con_pt_faible3');verif_champ('an_con_pt_faible4');verif_champ('stra_pt_fort2');verif_champ('stra_pt_fort3');verif_champ('stra_pt_fort4');verif_champ('stra_pt_faible2');verif_champ('stra_pt_faible3');verif_champ('stra_pt_faible4');verif_champ('autre_pt_fort2');verif_champ('autre_pt_fort3');verif_champ('autre_pt_fort4');verif_champ('autre_pt_faible2');verif_champ('autre_pt_faible3');verif_champ('autre_pt_faible4');verif_champ('action_commercial2');verif_champ('action_commercial3');verif_champ('action_commercial4');verif_champ('delai_commercial2');verif_champ('delai_commercial3');verif_champ('delai_commercial4');verif_champ('result_commercial2');verif_champ('result_commercial3');verif_champ('result_commercial4');">
<center><input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>ASPECT COMMERCIAUX : <img src="../images/icons/user.png" /> <?php echo $retour[0];?></strong> 
    </center>




<?php if(isset($color[2]) and ($color[2]==1 or $color[2]==NULL ))
 {
	?>


<div style="display:block; background-color:#DFE6FF;border:2px solid ; padding:15px;" id="commerciaux">


        <h3><img src="../images/32x32/brainstorming.png" /> Points forts et points faibles de l’etude de marche</h3><br>
   
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
         
      <center>
        <table  style="border:1px dotted #666; color: #000;"  cellpadding="0" cellspacing="0" class="tableGen">
          <tbody>
            <tr  style="color: #FFF;">
              <td  style="padding-left:10px;" width="230" height="30" align="center" bgcolor="#FF9900" class="td1"></td>
              <td style="padding-left:10px; text-align:center" width="400" bgcolor="#FF9900" class="td1">Points forts</td>
              <td style="padding-left:10px;text-align:center" width="400" bgcolor="#FF9900"  class="tdFin">Points faibles</td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;padding-top:10px;" class="td1 table1Col2"><?php echo utf8_encode($v_co[0]);?></td>
              <td style="padding-left:10px;padding-top:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[1]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" style="padding-left:10px; color:#FFF" class="td1 table1Col1">Analyse des besoins des clients</td>
              <td style="padding-left:10px;" class="td1 table1Col2"><?php echo utf8_encode($v_co[21]);?></td>
              <td style="padding-left:10px;"  class="tdFin table1Col3"><?php  echo utf8_encode($v_co[24]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;" class="td1 table1Col2"><?php echo utf8_encode($v_co[22]);?></td>
              <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[25]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_co[23]);?></td>
              <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[26]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="32" bgcolor="#FF9900">&nbsp;</td>
              <td></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_co[2]);?></td>
              <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[3]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" style="padding-left:10px; color:#FFF" bgcolor="#FF9900">Analyse de la concurrence</td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[27]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[30]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"></td>
              <td style="padding-left:10px;"  ><?php echo utf8_encode($v_co[28]);?></td>
              <td style="padding-left:10px;"  ><?php echo utf8_encode($v_co[31]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[29]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[32]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"><br/>
                <br/></td>
              <td></td>
              <td></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_co[4]);?></td>
              <td style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[5]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" style="padding-left:10px; color:#FFF" bgcolor="#FF9900">Strategie commerciale envisagee</td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[33]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[36]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900">&nbsp;</td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[34]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[37]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[35]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[38]);?></td>
              <td width="2"></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"></td>
              <td><br/>
                <br/></td>
              <td></td>
            </tr>
            <tr></tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900" class="td1 table1Col1">&nbsp;</td>
              <td style="padding-left:10px;"  class="td1 table1Col2"><?php echo utf8_encode($v_co[6]);?></td>
              <td  style="padding-left:10px;"  class="tdFin table1Col3"><?php echo utf8_encode($v_co[7]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" style="padding-left:10px; color:#FFF" bgcolor="#FF9900"><span class="td1 table1Col1">Autres points</span></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[39]);?></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[42]);?></td>
            </tr>
            <tr height="30" style="padding-left:10px">
              <td bgcolor="#FF9900"></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[40]);?></td><td style="padding-left:10px;" ><?php echo utf8_encode($v_co[43]);?></td>
            </tr>
            <tr style="padding-left:10px">
              <td height="30" bgcolor="#FF9900"></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[41]);?><br/><br/></td>
              <td style="padding-left:10px;" ><?php echo utf8_encode($v_co[44]);?><br/><br/></td><td></td>
            </tr>
          </tbody>
        </table>
  </center>
        <br>

 
 <h3><img src="../images/32x32/settings.png" /> Plan d'actions</h3><br>
<center><table style="border:1px dotted #666; " class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr style="color: #FFF;">
                <td width="350" height="31" align="center" bgcolor="#FF9900" class="td1">Actions a mener</td>
                <td width="300" align="center" bgcolor="#FF9900" class="td1">Delais de realisation</td>
                <td width="350" align="center" bgcolor="#FF9900" class="tdFin">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_co[8]);?></td>
                <td style="padding-left:10px;"height="25" class="td1 table3Col2"><?php echo utf8_encode($v_co[12]);?></td>
                <td style="padding-left:10px;"height="25" class="tdFin table3Col3"><?php echo utf8_encode($v_co[12]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;"height="25" class="td1 table3Col1"><?php echo utf8_encode($v_co[9]);?></td>
                <td style="padding-left:10px;"height="25" class="td1 table3Col2"><?php echo utf8_encode($v_co[13]);?></td>
                <td style="padding-left:10px;"height="25" class="tdFin table3Col3"><?php echo utf8_encode($v_co[17]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;" height="25" class="td1 table3Col1"><?php echo utf8_encode($v_co[10]);?></td>
                <td style="padding-left:10px;" height="25" class="td1 table3Col2"><?php echo utf8_encode($v_co[14]);?></td>
                <td style="padding-left:10px;" height="25" class="tdFin table3Col3"><?php echo utf8_encode($v_co[18]);?></td>
              </tr>
               <tr>
                <td style="padding-left:10px;"height="25" class="td1 table3Col1"><?php echo utf8_encode($v_co[11]);?></td>
                <td style="padding-left:10px;"height="25" class="td1 table3Col2"><?php echo utf8_encode($v_co[15]);?></td>
                <td style="padding-left:10px;"height="25" class="tdFin table3Col3"><?php echo utf8_encode($v_co[19]);?></td>
              </tr>
  </tbody></table></center><br>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3><br>
 <center><?php echo utf8_encode($v_co[20]);?></center>
      
        

<br/><br/></div>



       <?php 
 }
     
   elseif($color[2]!=1)
     {
		 ?>








<div style="display:block; background-color:#DFE6FF;border:2px solid ; padding:15px;" id="commerciaux">
<form name="form1" action="" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />

        <h3><img src="../images/32x32/brainstorming.png" /> Points forts et points faibles de l’etude de marche</h3><br>
   
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
         
      <center>
        <table width="981" cellpadding="0" cellspacing="0" class="tableGen">
          <tbody>
            <tr>
              <td width="273" align="center" class="td1"></td>
              <td width="353" class="td1">Points forts</td>
              <td width="353"  class="tdFin">Points faibles</td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Analyse des besoins des clients</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_pt_fort2');afficherAutre(this.name,an_be_cl_pt_forta.name);" id="an_be_cl_pt_fort" name="an_be_cl_pt_fort">
                <option value="<?php echo utf8_encode($v_co[0]);?>"> <?php echo utf8_encode($v_co[0]);?></option>
                <?php $epce->texte('Points forts clients'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_forta"  id="an_be_cl_pt_forta"/></td>
              <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_pt_faible2');afficherAutre(this.name,an_be_cl_pt_faiblea.name);" id="an_be_cl_pt_faible" name="an_be_cl_pt_faible">
                <option value="<?php echo utf8_encode($v_co[1]);?>"> <?php echo utf8_encode($v_co[1]);?></option>
                <?php $epce->texte('Points faibles clients'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_faiblea"  id="an_be_cl_pt_faiblea"/></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_pt_fort3');afficherAutre(this.name,an_be_cl_pt_fort2a.name);"  id="an_be_cl_pt_fort2" style="display:none" name="an_be_cl_pt_fort2">
                <option value="<?php echo utf8_encode($v_co[21]);?>"> <?php echo utf8_encode($v_co[21]);?></option>
                <?php $epce->texte('Points forts clients'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_fort2a"  id="an_be_cl_pt_fort2a"/></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('an_be_cl_pt_faible3');afficherAutre(this.name,an_be_cl_pt_faible2a.name);"  id="an_be_cl_pt_faible2" style="display:none" name="an_be_cl_pt_faible2">
                <option value="<?php  echo utf8_encode($v_co[24]);?>"> <?php echo utf8_encode($v_co[24]);?></option>
                <?php $epce->texte('Points faibles clients'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_faible2a"  id="an_be_cl_pt_faible2a"/></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><select style="display:none" id="an_be_cl_pt_fort3" onchange="voir_select('an_be_cl_pt_fort4');afficherAutre(this.name,an_be_cl_pt_fort3a.name);" name="an_be_cl_pt_fort3">
                <option value="<?php echo utf8_encode($v_co[22]);?>"> <?php echo utf8_encode($v_co[22]);?></option>
                <?php $epce->texte('Points forts clients'); ?>
            <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_fort3a"  id="an_be_cl_pt_fort3a"/></td>
              <td class="tdFin table1Col3"><select style="display:none" id="an_be_cl_pt_faible3" onchange="voir_select('an_be_cl_pt_faible4');afficherAutre(this.name,an_be_cl_pt_faible3a.name);"  name="an_be_cl_pt_faible3">
                <option value="<?php echo utf8_encode($v_co[25]);?>"> <?php echo utf8_encode($v_co[25]);?></option>
                <?php $epce->texte('Points faibles clients'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_be_cl_pt_faible3a"  id="an_be_cl_pt_faible3a"/></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><input style="display:none" size="55" id="an_be_cl_pt_fort4"  name="an_be_cl_pt_fort4" value="<?php echo utf8_encode($v_co[23]);?>" /></td>
              <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_be_cl_pt_faible4" name="an_be_cl_pt_faible4"  value="<?php echo utf8_encode($v_co[26]);?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Analyse de la concurrence</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_con_pt_fort2');afficherAutre(this.name,an_con_pt_forta.name);"  id="an_con_pt_fort" name="an_con_pt_fort">
                <option value="<?php echo utf8_encode($v_co[2]);?>"> <?php echo  utf8_encode($v_co[2]);?></option>
                <?php $epce->texte('Points forts concurrence'); ?>
            <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_forta"  id="an_con_pt_forta"/></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('an_con_pt_faible2');afficherAutre(this.name,an_con_pt_faiblea.name);" id="an_con_pt_faible" name="an_con_pt_faible">
                <option value="<?php echo utf8_encode($v_co[3]);?>"> <?php echo  utf8_encode($v_co[3]);?></option>
                <?php $epce->texte('Points faibles concurrence'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_faiblea"  id="an_con_pt_faiblea"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><select onchange="voir_select('an_con_pt_fort3');afficherAutre(this.name,an_con_pt_fort2a.name);"  style="display:none"  id="an_con_pt_fort2" name="an_con_pt_fort2">
                <option value="<?php echo utf8_encode($v_co[27]);?>"> <?php echo utf8_encode($v_co[27]);?></option>
                <?php $epce->texte('Points forts concurrence'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_fort2a"  id="an_con_pt_fort2a"/></td>
              <td><select  onchange="voir_select('an_con_pt_faible3');afficherAutre(this.name,an_con_pt_faible2a.name);" style="display:none"  id="an_con_pt_faible2" name="an_con_pt_faible2">
                <option value="<?php echo utf8_encode($v_co[30]);?>"><?php echo utf8_encode($v_co[30]);?> </option>
                <?php $epce->texte('Points faibles concurrence'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_faible2a"  id="an_con_pt_faible2a"/></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('an_con_pt_fort4');afficherAutre(this.name,an_con_pt_fort3a.name);"  style="display:none"  id="an_con_pt_fort3" name="an_con_pt_fort3">
                <option value="<?php echo utf8_encode($v_co[28]);?>"><?php echo utf8_encode($v_co[28]);?> </option>
                <?php $epce->texte('Points forts concurrence'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_fort3a"  id="an_con_pt_fort3a"/></td>
              <td><select  onchange="voir_select('an_con_pt_faible4');afficherAutre(this.name,an_con_pt_faible3a.name);" style="display:none"  id="an_con_pt_faible3" name="an_con_pt_faible3">
                <option value="<?php echo utf8_encode($v_co[31]);?>"><?php echo utf8_encode($v_co[31]);?> </option>
                <?php $epce->texte('Points faibles concurrence'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="an_con_pt_faible3a"  id="an_con_pt_faible3a"/></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="an_con_pt_fort4"  name="an_con_pt_fort4" value="<?php echo utf8_encode($v_co[29]);?>" /></td>
              <td><input style="display:none" size="55" id="an_con_pt_faible4"  name="an_con_pt_faible4" value="<?php echo utf8_encode($v_co[32]);?>" /></td>
            </tr>
            <tr>
              <td><br/>
                <br/></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Strategie commerciale envisagee</td>
              <td class="td1 table1Col2"><select onchange="voir_select('stra_pt_fort2');afficherAutre(this.name,stra_pt_forta.name);" id="stra_pt_fort" name="stra_pt_fort">
                <option value="<?php echo utf8_encode($v_co[4]);?>">
                  <?php  echo utf8_encode($v_co[4]);?>
                </option>
                <?php $epce->texte('Points forts strategie'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_forta"  id="stra_pt_forta"/></td>
              <td class="tdFin table1Col3"><select  onchange="voir_select('stra_pt_faible2');afficherAutre(this.name,stra_pt_faiblea.name)" id="stra_pt_faible" name="stra_pt_faible">
                <option value="<?php echo utf8_encode($v_co[5]);?>"> <?php echo utf8_encode($v_co[5]);?></option>
                <?php $epce->texte('Points faibles strategie'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_faiblea"  id="stra_pt_faiblea"/></td>
            </tr>
            <tr>
              <td></td>
              <td><select style="display:none" onchange="voir_select('stra_pt_fort3');afficherAutre(this.name,stra_pt_fort2a.name);" id="stra_pt_fort2" name="stra_pt_fort2">
                <option value="<?php echo utf8_encode($v_co[33]);?>"><?php echo utf8_encode($v_co[33]);?> </option>
                <?php $epce->texte('Points forts strategie'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_fort2a"  id="stra_pt_fort2a"/></td>
              <td><select style="display:none" onchange="voir_select('stra_pt_faible3');afficherAutre(this.name,stra_pt_faible2a.name)" id="stra_pt_faible2" name="stra_pt_faible2">
                <option value="<?php echo utf8_encode($v_co[36]);?>"><?php echo utf8_encode($v_co[36]);?> </option>
                <?php $epce->texte('Points faibles strategie'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_faible2a"  id="stra_pt_faible2a"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><select style="display:none" onchange="voir_select('stra_pt_fort4');afficherAutre(this.name,stra_pt_fort3a.name);" id="stra_pt_fort3"  name="stra_pt_fort3">
                <option value="<?php echo utf8_encode($v_co[34]);?>"><?php echo utf8_encode($v_co[34]);?> </option>
                <?php $epce->texte('Points forts strategie'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_fort3a"  id="stra_pt_fort3a"/></td>
              <td><select  style="display:none" onchange="voir_select('stra_pt_faible4');afficherAutre(this.name,stra_pt_faible3a.name);" id="stra_pt_faible3" name="stra_pt_faible3">
                <option value="<?php echo utf8_encode($v_co[37]);?>"><?php echo utf8_encode($v_co[37]);?></option>
                <?php $epce->texte('Points faibles strategie'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="stra_pt_faible3a"  id="stra_pt_faible3a"/></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="stra_pt_fort4"  name="stra_pt_fort4" value="<?php echo utf8_encode($v_co[35]);?>" /></td>
              <td><input style="display:none" size="55" id="stra_pt_faible4"  name="stra_pt_faible4" value="<?php echo utf8_encode($v_co[38]);?>" /></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td><br/>
                <br/></td>
              <td></td>
            </tr>
            <tr></tr>
            <tr>
              <td class="td1 table1Col1">Autres points</td>
              <td class="td1 table1Col2"><select onchange="voir_select('autre_pt_fort2');afficherAutre(this.name,autre_pt_forta.name);" id="autre_pt_fort"  name="autre_pt_fort">
                <option value="<?php echo utf8_encode($v_co[6]);?>"> <?php echo utf8_encode($v_co[6]);?></option>
                <?php $epce->texte('Pfo_autres_co'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_forta"  id="autre_pt_forta"/></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('autre_pt_faible2');afficherAutre(this.name,autre_pt_faiblea.name);" id="autre_pt_faible" name="autre_pt_faible">
                <option value=" <?php echo utf8_encode($v_co[7]);?>"> <?php echo utf8_encode($v_co[7]);?></option>
                <?php $epce->texte('Pfa_autres_co'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_faiblea"  id="autre_pt_faiblea"/></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('autre_pt_fort3');afficherAutre(this.name,autre_pt_fort2a.name);" style="display:none"  id="autre_pt_fort2" name="autre_pt_fort2">
                <option value="<?php echo utf8_encode($v_co[39]);?>"><?php echo utf8_encode($v_co[39]);?> </option>
                <?php $epce->texte('Pfo_autres_co'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_fort2a"  id="autre_pt_fort2a"/></td>
              <td><select  onchange="voir_select('autre_pt_faible3');afficherAutre(this.name,autre_pt_faible2a.name);" id="autre_pt_faible2" style="display:none"  name="autre_pt_faible2">
                <option value="<?php echo utf8_encode($v_co[42]);?>"> <?php echo utf8_encode($v_co[42]);?></option>
                <?php $epce->texte('Pfa_autres_co'); ?>
             <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_faible2a"  id="autre_pt_faible2a"/></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('autre_pt_fort4');afficherAutre(this.name,autre_pt_fort3a.name);" style="display:none"  id="autre_pt_fort3"  name="autre_pt_fort3">
                <option value="<?php echo utf8_encode($v_co[40]);?>"><?php echo utf8_encode($v_co[40]);?> </option>
                <?php $epce->texte('Pfo_autres_co'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_fort3a"  id="autre_pt_fort3a"/></td><td><select onchange="voir_select('autre_pt_faible4');afficherAutre(this.name,autre_pt_faible3a.name);" style="display:none" id="autre_pt_faible3"  name="autre_pt_faible3">
                <option value="<?php echo utf8_encode($v_co[43]);?>"><?php echo utf8_encode($v_co[43]);?> </option>
                <?php $epce->texte('Pfa_autres_co'); ?>
              <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="autre_pt_faible3a"  id="autre_pt_faible3a"/></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="autre_pt_fort4"  name="autre_pt_fort4" value="<?php echo utf8_encode($v_co[41]);?>" /></td><td><input style="display:none" size="55" id="autre_pt_faible4"  name="autre_pt_faible4" value="<?php echo utf8_encode($v_co[44]);?>" /></td><td></td>
            </tr>
          </tbody>
        </table>
  </center>
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
                <td class="td1 table3Col1"><select  onchange="voir_select('action_commercial2');afficherAutre(this.name,action_commercial1a.name);" id="action_commercial1" name="action_commercial1"><option value="<?php echo utf8_encode($v_co[8]);?>"> <?php echo utf8_encode($v_co[8]);?></option><?php $epce->texte('Action'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action_commercial1a"  id="action_commercial1a"/></td>
                <td class="td1 table3Col2"><select onchange="voir_select('delai_commercial2');afficherAutre(this.name,delai_commercial1a.name);"  id="delai_commercial1" name="delai_commercial1"><option value="<?php echo utf8_encode($v_co[12]);?>"> <?php echo utf8_encode($v_co[12]);?></option><?php $epce->texte('Delais / Priorite'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai_commercial1a"  id="delai_commercial1a"/></td>
                <td class="tdFin table3Col3"><select onchange="voir_select('result_commercial2');afficherAutre(this.name,result_commercial1a.name);" id="result_commercial1"  name="result_commercial1"><option value="<?php echo utf8_encode($v_co[16]);?>"> <?php echo utf8_encode($v_co[16]);?></option><?php $epce->texte('Resultats attendus 1'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result_commercial1a"  id="result_commercial1a"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none" onchange="voir_select('action_commercial3');afficherAutre(this.name,action_commercial2a.name);"  id="action_commercial2" name="action_commercial2"><option value="<?php echo utf8_encode($v_co[9]);?>"> <?php echo utf8_encode($v_co[9]);?></option><?php $epce->texte('Action'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action_commercial2a"  id="action_commercial2a"/></td>
                <td class="td1 table3Col2"><select style="display:none" onchange="voir_select('delai_commercial3');afficherAutre(this.name,delai_commercial2a.name);" id="delai_commercial2" name="delai_commercial2"><option value="<?php echo utf8_encode($v_co[13]);?>"> <?php echo utf8_encode($v_co[13]);?></option><?php $epce->texte('Delais / Priorite'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai_commercial2a"  id="delai_commercial2a"/></td>
                <td class="tdFin table3Col3"><select style="display:none"  onchange="voir_select('result_commercial3');afficherAutre(this.name,result_commercial2a.name);" id="result_commercial2" name="result_commercial2"><option value="<?php echo utf8_encode($v_co[17]);?>"> <?php echo utf8_encode($v_co[17]);?></option><?php $epce->texte('Resultats attendus 1'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result_commercial2a"  id="result_commercial2a"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none" onchange="voir_select('action_commercial4');afficherAutre(this.name,action_commercial3a.name);"  id="action_commercial3" name="action_commercial3"><option value="<?php echo utf8_encode($v_co[10]);?>"> <?php echo utf8_encode($v_co[10]);?></option><?php $epce->texte('Action'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action_commercial3a"  id="action_commercial3a"/></td>
                <td class="td1 table3Col2"><select style="display:none" onchange="voir_select('delai_commercial4');afficherAutre(this.name,delai_commercial3a.name);" id="delai_commercial3" name="delai_commercial3"><option value="<?php echo utf8_encode($v_co[14]);?>"> <?php echo utf8_encode($v_co[14]);?></option><?php $epce->texte('Delais / Priorite'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai_commercial3a"  id="delai_commercial3a"/></td>
                <td class="tdFin table3Col3"><select  style="display:none" onchange="voir_select('result_commercial4');afficherAutre(this.name,result_commercial3a.name);" id="result_commercial3" name="result_commercial3"><option value="<?php echo utf8_encode($v_co[18]);?>"> <?php echo utf8_encode($v_co[18]);?></option><?php $epce->texte('Resultats attendus 1'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result_commercial3a"  id="result_commercial3a"/></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select style="display:none" onchange="afficherAutre(this.name,action_commercial4a.name);" id="action_commercial4"  name="action_commercial4"><option value="<?php echo utf8_encode($v_co[11]);?>"> <?php echo utf8_encode($v_co[11]);?></option><?php $epce->texte('Action'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="action_commercial4a"  id="action_commercial4a"/></td>
                <td class="td1 table3Col2"><select style="display:none" onchange="afficherAutre(this.name,delai_commercial4a.name);"  id="delai_commercial4" name="delai_commercial4"><option value="<?php echo utf8_encode($v_co[15]);?>"> <?php echo utf8_encode($v_co[15]);?></option><?php $epce->texte('Delais / Priorite'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="delai_commercial4a"  id="delai_commercial4a"/></td>
                <td class="tdFin table3Col3"><select style="display:none" onchange="afficherAutre(this.name,result_commercial4a.name);" id="result_commercial4" name="result_commercial4"><option value="<?php echo utf8_encode($v_co[19]);?>"> <?php echo utf8_encode($v_co[19]);?></option><?php $epce->texte('Resultats attendus 1'); ?> <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="result_commercial4a"  id="result_commercial4a"/></td>
              </tr>
            </tbody></table></center><br>
 <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3><br>
 <center>
   <textarea name="diag_commercial" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo utf8_encode($v_co[20]);?></textarea>
 </center>
      
        

<br/><center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px"  type="submit" name="sauvegarder" value="Sauvegarder" /> </center><br/></form></div>
<form action="commerciaux.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="suite">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" value="0" type="radio"  /> </td>
<td style="text-align: left">Enregistrer et quitter</td></tr><tr><td width="26" style="text-align: left"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input style="width:20px;height:20px" checked="checked"   type="radio" name="radio_co" value="1" /> </td>
  <td width="400" style="text-align: left">
  Enregistrer et passer à l'étape suivante</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" type="radio" value="2"  /> </td>
<td style="text-align: left">
  Mettre fin à la prestation</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="submit" name="alert2" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><form action="commerciaux.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="radio_co" value="<?php echo $_GET['radio_co']; ?>" />
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
	$rapport->action('sauvegarde les aspects commerciaux de '.$retour[0].'');
	
	if($_SESSION['type_presta']=="EPCE")
	{
		$nacre_eval->verif_beneficiaire_aspect_commercial($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_pt_fort']),utf8_decode($_POST['an_be_cl_pt_fort2']),utf8_decode($_POST['an_be_cl_pt_fort3']),utf8_decode($_POST['an_be_cl_pt_fort4']), utf8_decode($_POST['an_be_cl_pt_faible']),utf8_decode($_POST['an_be_cl_pt_faible2']),utf8_decode($_POST['an_be_cl_pt_faible3']),utf8_decode($_POST['an_be_cl_pt_faible4']), utf8_decode($_POST['an_con_pt_fort']),utf8_decode($_POST['an_con_pt_fort2']),utf8_decode($_POST['an_con_pt_fort3']),utf8_decode($_POST['an_con_pt_fort4']), utf8_decode($_POST['an_con_pt_faible']),utf8_decode($_POST['an_con_pt_faible2']),utf8_decode($_POST['an_con_pt_faible3']),utf8_decode($_POST['an_con_pt_faible4']),  utf8_decode($_POST['stra_pt_fort']),utf8_decode($_POST['stra_pt_fort2']),utf8_decode($_POST['stra_pt_fort3']),utf8_decode($_POST['stra_pt_fort4']),  utf8_decode($_POST['stra_pt_faible']),utf8_decode($_POST['stra_pt_faible2']),utf8_decode($_POST['stra_pt_faible3']),utf8_decode($_POST['stra_pt_faible4']), utf8_decode($_POST['autre_pt_fort']),utf8_decode($_POST['autre_pt_fort2']),utf8_decode($_POST['autre_pt_fort3']),utf8_decode($_POST['autre_pt_fort4']),  utf8_decode($_POST['autre_pt_faible']), utf8_decode($_POST['autre_pt_faible2']),utf8_decode($_POST['autre_pt_faible3']),utf8_decode($_POST['autre_pt_faible4']), utf8_decode($_POST['action_commercial1']), utf8_decode($_POST['action_commercial2']), utf8_decode($_POST['action_commercial3']), utf8_decode($_POST['action_commercial4']), utf8_decode($_POST['delai_commercial1']), utf8_decode($_POST['delai_commercial2']), utf8_decode($_POST['delai_commercial3']), utf8_decode($_POST['delai_commercial4']), utf8_decode($_POST['result_commercial1']), utf8_decode($_POST['result_commercial2']), utf8_decode($_POST['result_commercial3']),  utf8_decode($_POST['result_commercial4']), utf8_decode($_POST['diag_commercial']),'');
	}
	if($_SESSION['type_presta']=="NACRE1")
	{
		$nacre_eval->verif_beneficiaire_aspect_commercial($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_pt_fort']),utf8_decode($_POST['an_be_cl_pt_fort2']),utf8_decode($_POST['an_be_cl_pt_fort3']),utf8_decode($_POST['an_be_cl_pt_fort4']), utf8_decode($_POST['an_be_cl_pt_faible']),utf8_decode($_POST['an_be_cl_pt_faible2']),utf8_decode($_POST['an_be_cl_pt_faible3']),utf8_decode($_POST['an_be_cl_pt_faible4']), utf8_decode($_POST['an_con_pt_fort']),utf8_decode($_POST['an_con_pt_fort2']),utf8_decode($_POST['an_con_pt_fort3']),utf8_decode($_POST['an_con_pt_fort4']), utf8_decode($_POST['an_con_pt_faible']),utf8_decode($_POST['an_con_pt_faible2']),utf8_decode($_POST['an_con_pt_faible3']),utf8_decode($_POST['an_con_pt_faible4']),  utf8_decode($_POST['stra_pt_fort']),utf8_decode($_POST['stra_pt_fort2']),utf8_decode($_POST['stra_pt_fort3']),utf8_decode($_POST['stra_pt_fort4']),  utf8_decode($_POST['stra_pt_faible']),utf8_decode($_POST['stra_pt_faible2']),utf8_decode($_POST['stra_pt_faible3']),utf8_decode($_POST['stra_pt_faible4']), utf8_decode($_POST['autre_pt_fort']),utf8_decode($_POST['autre_pt_fort2']),utf8_decode($_POST['autre_pt_fort3']),utf8_decode($_POST['autre_pt_fort4']),  utf8_decode($_POST['autre_pt_faible']), utf8_decode($_POST['autre_pt_faible2']),utf8_decode($_POST['autre_pt_faible3']),utf8_decode($_POST['autre_pt_faible4']), utf8_decode($_POST['action_commercial1']), utf8_decode($_POST['action_commercial2']), utf8_decode($_POST['action_commercial3']), utf8_decode($_POST['action_commercial4']), utf8_decode($_POST['delai_commercial1']), utf8_decode($_POST['delai_commercial2']), utf8_decode($_POST['delai_commercial3']), utf8_decode($_POST['delai_commercial4']), utf8_decode($_POST['result_commercial1']), utf8_decode($_POST['result_commercial2']), utf8_decode($_POST['result_commercial3']),  utf8_decode($_POST['result_commercial4']), utf8_decode($_POST['diag_commercial']),$_POST['id_presta']);
	}
	if($_SESSION['type_presta']!="NACRE1")
	{
$epce_eval->verif_beneficiaire_aspect_commercial($_POST['id_beneficiaire'],utf8_decode($_POST['an_be_cl_pt_fort']),utf8_decode($_POST['an_be_cl_pt_fort2']),utf8_decode($_POST['an_be_cl_pt_fort3']),utf8_decode($_POST['an_be_cl_pt_fort4']), utf8_decode($_POST['an_be_cl_pt_faible']),utf8_decode($_POST['an_be_cl_pt_faible2']),utf8_decode($_POST['an_be_cl_pt_faible3']),utf8_decode($_POST['an_be_cl_pt_faible4']), utf8_decode($_POST['an_con_pt_fort']),utf8_decode($_POST['an_con_pt_fort2']),utf8_decode($_POST['an_con_pt_fort3']),utf8_decode($_POST['an_con_pt_fort4']), utf8_decode($_POST['an_con_pt_faible']),utf8_decode($_POST['an_con_pt_faible2']),utf8_decode($_POST['an_con_pt_faible3']),utf8_decode($_POST['an_con_pt_faible4']),  utf8_decode($_POST['stra_pt_fort']),utf8_decode($_POST['stra_pt_fort2']),utf8_decode($_POST['stra_pt_fort3']),utf8_decode($_POST['stra_pt_fort4']),  utf8_decode($_POST['stra_pt_faible']),utf8_decode($_POST['stra_pt_faible2']),utf8_decode($_POST['stra_pt_faible3']),utf8_decode($_POST['stra_pt_faible4']), utf8_decode($_POST['autre_pt_fort']),utf8_decode($_POST['autre_pt_fort2']),utf8_decode($_POST['autre_pt_fort3']),utf8_decode($_POST['autre_pt_fort4']),  utf8_decode($_POST['autre_pt_faible']), utf8_decode($_POST['autre_pt_faible2']),utf8_decode($_POST['autre_pt_faible3']),utf8_decode($_POST['autre_pt_faible4']), utf8_decode($_POST['action_commercial1']), utf8_decode($_POST['action_commercial2']), utf8_decode($_POST['action_commercial3']), utf8_decode($_POST['action_commercial4']), utf8_decode($_POST['delai_commercial1']), utf8_decode($_POST['delai_commercial2']), utf8_decode($_POST['delai_commercial3']), utf8_decode($_POST['delai_commercial4']), utf8_decode($_POST['result_commercial1']), utf8_decode($_POST['result_commercial2']), utf8_decode($_POST['result_commercial3']),  utf8_decode($_POST['result_commercial4']), utf8_decode($_POST['diag_commercial']),$_POST['id_presta']);
	}
echo'<script>window.location.href="commerciaux.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert=suite";</script>';
}
if($_GET['alert']=="suite")
{
echo"<script>document.getElementById('suite').style.display='block';</script>";

}
if(isset($_POST['alert2']))
{

	echo'<script>window.location.href="commerciaux.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert3=1&radio_co='.$_POST['radio_co'].'"</script>';
}

if($_POST['validator_co']==1)
{
	$epce->valider($_POST['id_beneficiaire'],"commerciaux",$_POST['id_presta']);
	
}
if(isset($_POST['validator']) and $_POST['radio_co']==0)
{

	echo'<script>window.location.href="../presentation/panel.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&display_eval=block";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==1)
{

	echo'<script>window.location.href="financier.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==2)
{
 $_SESSION['abandon'] = "ab_commerciaux";
	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}


		if($_GET['alert3']==1)
{ 
  	echo"<script>document.getElementById('validator').style.display='block';</script>";
	
}

?>