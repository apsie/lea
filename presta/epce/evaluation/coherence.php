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

$nacre_eval = new nacre_evaluation();
if($_SESSION['type_presta']=="NACRE1" and $_GET['choix']!=NULL)
{


$retour=$epce->variable_beneficiaire($_GET['choix']);
$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
//	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	
	$v_hp=$nacre_eval->variable_coherence($_GET['id_presta'],$_GET['choix']);
	
	// $color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);

}

elseif($_GET['choix']!=NULL)
{

$retour=$epce->variable_beneficiaire($_GET['choix']);
	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
	$v_hp=$epce_eval->variable_coherence($_GET['id_presta'],$_GET['choix']);
	
	 $color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
}



	
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta_coherence.css" title="blue">

<title>Cohérence homme / projet</title>

<script  src="../js/eval.js"></script>
</head>

<body onload="verif_champ('comp_pro');verif_champ('comp_pro2');verif_champ('comp_pro3');verif_champ('comp_pro4');verif_champ('comp_pro5');verif_champ('comp_pro6');verif_champ('form_savoir');verif_champ('form_savoir2');verif_champ('form_savoir3');verif_champ('form_savoir4');verif_champ('form_savoir5');verif_champ('form_savoir6');verif_champ('exp_pro2');verif_champ('exp_pro3');verif_champ('exp_pro4');verif_champ('exp_pro5');verif_champ('exp_pro6');verif_champ('element_porteur');verif_champ('element_porteur2');verif_champ('element_porteur3');verif_champ('element_porteur4');verif_champ('points_vigilance');verif_champ('points_vigilance2');verif_champ('points_vigilance3');verif_champ('points_vigilance4');verif_champ('delai1');verif_champ('delai2');verif_champ('delai3');verif_champ('delai4');verif_champ('compt1');verif_champ('compt2');verif_champ('compt3');verif_champ('compt4');verif_champ('type1');verif_champ('type2');verif_champ('type3');verif_champ('type4');"> <center><input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>COHERENCE HOMME / PROJET : <img src="../images/icons/user.png" /> <?php echo $retour[0];?></strong> 
    </center>

<?php if(isset($color[1]) and ($color[1]==1 or $color[1]==NULL ))
 {
	?>
    
    <div style="display:block; border:2px solid #000; background-color:#D3FEC5"  id="coherence_hp">
        
    <h3><img src="../images/32x32/cv.png" /> Formation, competences et capacites du porteur de projet</h3><br>

	 
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
  <center> <table style=" border:1px dotted #666; "  cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr style=" color:#FFF; background-color:#FF9900;padding:10px">
                <td width="300" height="31" align="center" class="td1">Capacités liées aux emplois exercés</td><td></td><td width="300" align="center">Competences professionnelles</td>
             
                <td width="300" align="center" class="tdFin">Formation et savoirs theorique </td>
              </tr>
              <tr >
                <td style="padding-left:10px" valign="top" class="td1 table1Col1"> <br/><?php echo utf8_encode($v_hp[0]);?>
                 <br/> <br/><?php echo utf8_encode($v_hp[1]);?><br/><br/><?php echo utf8_encode($v_hp[2]);?><br/><br/><?php echo utf8_encode($v_hp[3]);?><br/><br/><?php echo utf8_encode($v_hp[4]);?><br/><br/><?php echo utf8_encode($v_hp[5]);?><br/><br/>
              
                </td><td>
             <td style="padding-left:10px" valign="top"  class="td1 table1Col2">
            <br/> <?php echo utf8_encode($v_hp[6]);?><br/><br/><?php echo utf8_encode($v_hp[7]);?><br/><br/><?php echo utf8_encode($v_hp[8]);?><br/><br/><?php echo utf8_encode($v_hp[9]);?><br/><br/> <?php echo utf8_encode($v_hp[10]);?><br/><br/><?php echo utf8_encode($v_hp[11]);?></td><td  style="padding-left:10px" valign="top"><br/><?php echo utf8_encode($v_hp[12]);?><br/><br/><?php echo utf8_encode($v_hp[13]);?><br/><br/><?php echo utf8_encode($v_hp[14]);?><br/><br/>
            <?php echo utf8_encode($v_hp[15]);?><br/><br/><?php echo utf8_encode($v_hp[16]);?><br/><br/><?php echo utf8_encode($v_hp[17]);?>
              </td>
              </tr>
            </tbody></table></center><br>

 <h3><img src="../images/32x32/collaboration.png" /> Elements porteurs et points de vigilance par rapport au projet</h3><br>
    <center><table  style=" border:1px dotted #666; "class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr style=" color:#FFF; background-color:#FF9900;padding:10px">
                <td width="450" align="center"class="td1" style=" color:#FFF; background-color:#FF9900;padding:10px">Elements porteurs</td>
                <td width="450" align="center" class="tdFin">Points de vigilance</td>
             
              </tr>
              <tr>
                <td style="padding-left:10px" valign="top" class="td1 table2Col1"><br/><?php echo utf8_encode($v_hp[30]);?><br/><br/><?php echo utf8_encode($v_hp[31]);?><br/><br/><?php echo utf8_encode($v_hp[32]);?><br/><br/><?php echo utf8_encode($v_hp[33]);?></td><td style="padding-left:10px" valign="top"><br/><?php echo utf8_encode($v_hp[34]);?><br/><br/>
                  <?php echo utf8_encode($v_hp[35]);?><br/><br/><?php echo utf8_encode($v_hp[36]);?><br/><br/><?php echo utf8_encode($v_hp[37]);?>             
                </td>
            </tr>
            </tbody></table></td></center><br>
 <h3><img src="../images/32x32/future-projects.png" /> Besoins de formation courte identifiee</h3>
 <br>
 <center><table  style=" border:1px dotted #666;" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr style=" color:#FFF; background-color:#FF9900;padding:10px;">
                <td width="250" height="31" align="center" class="td1">Competences a acquerir ou renforcer</td>
                <td width="200" align="center" class="td1">Delais/priorite</td>
                <td width="250" align="center" class="tdFin">Type de formation courte recommandee</td>
              </tr>
              <tr>
                <td style="padding-left:10px" valign="top" class="td1 table3Col1"><br/><?php echo utf8_encode($v_hp[18]);?>
                 <br/><br/><?php echo utf8_encode($v_hp[19]);?>  <br/><br/><?php echo utf8_encode($v_hp[20]);?>  <br/><br/><?php echo utf8_encode($v_hp[21]);?></td><td style="padding-left:10px">  <br/><?php echo utf8_encode($v_hp[22]);?>  <br/><br/><?php echo utf8_encode($v_hp[23]);?>  <br/><br/><?php echo utf8_encode($v_hp[24]);?>  <br/><br/><?php echo utf8_encode($v_hp[25]);?></td>
                <td  style="padding-left:10px"valign="top"  class="tdFin table3Col3">  <br/><?php echo utf8_encode($v_hp[26]);?>  <br/><br/><?php echo utf8_encode($v_hp[27]);?>  <br/><br/><?php echo utf8_encode($v_hp[28]);?>  <br/><br/><?php echo utf8_encode($v_hp[29]);?></td>
              </tr>
            </tbody></table></center><br/>
<h3><img src="../images/32x32/hire-me.png" alt="" /> Diagnostic et commentaires du referent</h3><br/>
<p>&nbsp;</p>
<p><center><?php echo utf8_encode($v_hp[38]);?><br/><br/></center>
</p>
</div></center>
       <?php 
 }
     
   elseif($color[1]!=1)
     {
		 ?>
<form name="form1" action="" method="post"> <input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><div style="display:block; border:2px solid #000; background-color:#D3FEC5"  id="coherence_hp">
        
    <h3><img src="../images/32x32/cv.png" /> Formation, competences et capacites du porteur de projet</h3><br>

	 
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
       <center> <table width="537" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="137" align="center" class="td1">Capacités liées aux emplois exercés</td><td></td><td></td><td align="center">Competences professionnelles</td>
             
                <td width="261" align="center" class="tdFin">Formation et savoirs theorique </td>
              </tr>
              <tr>
                <td valign="top" class="td1 table1Col1"> <select onchange="voir_select('exp_pro2'); afficherAutre(this.name,exp_proa.name);" id="exp_pro"  name="exp_pro"><option value="<?php echo utf8_encode($v_hp[0]);?>"> <?php echo utf8_encode($v_hp[0]);?></option><?php $epce->texte('Capacite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>
                <input style="display:none"  type="text" name="exp_proa" id="exp_proa" onchange="voir_select('exp_pro2'); "  size="45" value="<?php echo utf8_encode($v_hp[0]);?>" />
                  <input style="display:none" size="45" onchange="voir_select('exp_pro3')" type="text" id="exp_pro2" name="exp_pro2" value="<?php echo utf8_encode($v_hp[1]);?>" /><input style="display:none" size="45" onchange="voir_select('exp_pro4')" type="text" id="exp_pro3" name="exp_pro3" value="<?php echo utf8_encode($v_hp[2]);?>"  /><input style="display:none" size="45" type="text" name="exp_pro4" id="exp_pro4" onchange="voir_select('exp_pro5')" value="<?php echo utf8_encode($v_hp[3]);?>" /><input style="display:none" size="45" type="text" name="exp_pro5" id="exp_pro5" onchange="voir_select('exp_pro6')" value="<?php echo utf8_encode($v_hp[4]);?>"  /><input style="display:none" size="45" type="text" name="exp_pro6" id="exp_pro6" value="<?php echo utf8_encode($v_hp[5]);?>"  /><br/>
              
                </td><td><td></a></td>
             <td valign="top"  class="td1 table1Col2">
             <select onchange="voir_select('comp_pro2'); afficherAutre(this.name,comp_proa.name);" id="comp_pro"  name="comp_pro"><option value="<?php echo utf8_encode($v_hp[6]);?>"> <?php echo utf8_encode($v_hp[6]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select>  <input type="text" size="55" style="display:none"  name="comp_proa"  id="comp_proa"/> <select onchange="voir_select('comp_pro3');afficherAutre(this.name,comp_pro2a.name)" style="display:none" id="comp_pro2" name="comp_pro2"><option value="<?php echo utf8_encode($v_hp[7]);?>"> <?php echo utf8_encode($v_hp[7]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="comp_pro2a"  id="comp_pro2a"/><select onchange="voir_select('comp_pro4');afficherAutre(this.name,comp_pro3a.name)" style="display:none"  id="comp_pro3" name="comp_pro3"><option value="<?php echo utf8_encode($v_hp[8]);?>"> <?php echo utf8_encode($v_hp[8]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="comp_pro3a"  id="comp_pro3a"/>
                  <select onchange="voir_select('comp_pro5');afficherAutre(this.name,comp_pro4a.name)" style="display:none" id="comp_pro4" name="comp_pro4"><option value="<?php echo utf8_encode($v_hp[9]);?>"> <?php echo utf8_encode($v_hp[9]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="comp_pro4a"  id="comp_pro4a"/><select onchange="voir_select('comp_pro6');afficherAutre(this.name,comp_pro5a.name);" style="display:none" id="comp_pro5" name="comp_pro5"><option value="<?php echo utf8_encode($v_hp[10]);?>"> <?php echo utf8_encode($v_hp[10]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="comp_pro5a"  id="comp_pro5a"/><select onchange="afficherAutre(this.name,comp_pro6a.name);" style="display:none" id="comp_pro6" name="comp_pro6"><option value="<?php echo utf8_encode($v_hp[11]);?>"> <?php echo utf8_encode($v_hp[11]);?></option><?php $epce->texte('Competences professionnelles'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="comp_pro6a"  id="comp_pro6a"/></td>
              <td valign="top"  class="tdFin table1Col3"><select  id="form_savoir" onchange="voir_select('form_savoir2');afficherAutre(this.name,form_savoira.name);" name="form_savoir"><option value="<?php echo utf8_encode($v_hp[12]);?>"> <?php echo utf8_encode($v_hp[12]);?></option><?php $epce->texte('Formation et savoirs theoriques'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="form_savoira"  id="form_savoira"/>  <select style="display:none" onchange="voir_select('form_savoir3');afficherAutre(this.name,form_savoir2a.name);" id="form_savoir2" name="form_savoir2"><option value="<?php echo utf8_encode($v_hp[13]);?>"> <?php echo utf8_encode($v_hp[13]);?></option><?php $epce->texte('Formation et savoirs theoriques'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="form_savoir2a"  id="form_savoir2a"/> 
                <select style="display:none" onchange="voir_select('form_savoir4');afficherAutre(this.name,form_savoir3a.name);" id="form_savoir3" name="form_savoir3">
                  <option value="<?php echo utf8_encode($v_hp[14]);?>"> <?php echo utf8_encode($v_hp[14]);?></option>
                  <?php $epce->texte('Formation et savoirs theoriques'); ?>
               <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option> </select><input type="text" size="55" style="display:none"  name="form_savoir3a"  id="form_savoir3a"/> 
                <select  style="display:none" onchange="voir_select('form_savoir5');afficherAutre(this.name,form_savoir4a.name);" id="form_savoir4" name="form_savoir4">
                  <option value="<?php echo utf8_encode($v_hp[15]);?>"> <?php echo utf8_encode($v_hp[15]);?></option>
                  <?php $epce->texte('Formation et savoirs theoriques'); ?>
                <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="form_savoir4a"  id="form_savoir4a"/> 
                <select style="display:none" onchange="voir_select('form_savoir6');afficherAutre(this.name,form_savoir5a.name);" id="form_savoir5" name="form_savoir5"><option value="<?php echo utf8_encode($v_hp[16]);?>"> <?php echo utf8_encode($v_hp[16]);?></option><?php $epce->texte('Formation et savoirs theoriques'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="form_savoir5a"  id="form_savoir5a"/> <select onchange="afficherAutre(this.name,form_savoir6a.name);" style="display:none" id="form_savoir6" name="form_savoir6"><option value="<?php echo utf8_encode($v_hp[17]);?>"> <?php echo utf8_encode($v_hp[17]);?></option><?php $epce->texte('Formation et savoirs theoriques'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="form_savoir6a"  id="form_savoir6a"/> 
              </td>
              </tr>
            </tbody></table></center><br>

 <h3><img src="../images/32x32/collaboration.png" /> Elements porteurs et points de vigilance par rapport au projet</h3><br>
    <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Elements porteurs</td>
                <td class="tdFin" align="center">Points de vigilance</td>
             
              </tr>
              <tr>
                <td valign="top" class="td1 table2Col1"><select onchange="voir_select('element_porteur2');afficherAutre(this.name,element_porteura.name);" id="element_porteur" name="element_porteur"><option value="<?php echo utf8_encode($v_hp[30]);?>"> <?php echo utf8_encode($v_hp[30]);?></option><?php $epce->texte('Elements porteurs'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="element_porteura"  id="element_porteura"/><select style="display:none"  onchange="voir_select('element_porteur3');afficherAutre(this.name,element_porteur2a.name);"  id="element_porteur2" name="element_porteur2"><option value="<?php echo utf8_encode($v_hp[31]);?>"> <?php echo utf8_encode($v_hp[31]);?></option><?php $epce->texte('Elements porteurs'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="element_porteur2a"  id="element_porteur2a"/><select style="display:none"   onchange="voir_select('element_porteur4');afficherAutre(this.name,element_porteur3a.name);" id="element_porteur3" name="element_porteur3"><option value="<?php echo utf8_encode($v_hp[32]);?>"> <?php echo utf8_encode($v_hp[32]);?></option><?php $epce->texte('Elements porteurs'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="element_porteur3a"  id="element_porteur3a"/><select style="display:none"  onchange="afficherAutre(this.name,element_porteur4a.name);" id="element_porteur4" name="element_porteur4"><option value="<?php echo utf8_encode($v_hp[33]);?>"> <?php echo utf8_encode($v_hp[33]);?></option><?php $epce->texte('Elements porteurs'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="element_porteur4a"  id="element_porteur4a"/></td>
                <td  valign="top" class="tdFin table2Col2"> <select onchange="voir_select('points_vigilance2');afficherAutre(this.name,points_vigilancea.name);" id="points_vigilance" name="points_vigilance"><option value="<?php echo utf8_encode($v_hp[34]);?>"> <?php echo utf8_encode($v_hp[34]);?></option><?php $epce->texte('Points de vigilance'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="points_vigilancea"  id="points_vigilancea"/> <select  style="display:none"  onchange="voir_select('points_vigilance3');afficherAutre(this.name,points_vigilance2a.name);" id="points_vigilance2" name="points_vigilance2"><option value="<?php echo utf8_encode($v_hp[35]);?>"> <?php echo utf8_encode($v_hp[35]);?></option><?php $epce->texte('Points de vigilance'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="points_vigilance2a"  id="points_vigilance2a"/><select style="display:none"  onchange="voir_select('points_vigilance4');afficherAutre(this.name,points_vigilance3a.name);"  id="points_vigilance3" name="points_vigilance3"><option value="<?php echo utf8_encode($v_hp[36]);?>"> <?php echo utf8_encode($v_hp[36]);?></option><?php $epce->texte('Points de vigilance'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="points_vigilance3a"  id="points_vigilance3a"/><select style="display:none"  onchange="afficherAutre(this.name,points_vigilance4a.name);"  id="points_vigilance4" name="points_vigilance4"><option value="<?php echo utf8_encode($v_hp[37]);?>"> <?php echo utf8_encode($v_hp[37]);?></option><?php $epce->texte('Points de vigilance'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option> </select> <input type="text" size="55" style="display:none"  name="points_vigilance4a"  id="points_vigilance4a"/>             
                </td>
            </tr>
            </tbody></table></td></center><br>
 <h3><img src="../images/32x32/future-projects.png" /> Besoins de formation courte identifiee</h3>
 <br>
 <center><table width="635" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="233" align="center" class="td1">Competences a acquerir ou renforcer</td>
                <td width="178" align="center" class="td1">Delais/priorite</td>
                <td width="222" align="center" class="tdFin">Type de formation courte recommandee</td>
              </tr>
              <tr>
                <td valign="top" class="td1 table3Col1"><select onchange="voir_select('compt2');afficherAutre(this.name,compt1a.name);" id="compt1" name="compt1">
                  <option value="<?php echo utf8_encode($v_hp[18]);?>"> <?php echo utf8_encode($v_hp[18]);?></option>
                  <?php $epce->texte('Competence'); ?>
                  <option style="color:#F00; font-weight:bolder" value="Autre">Autre</option>
                </select>
                <input type="text" size="55" style="display:none"  name="compt1a"  id="compt1a"/><select style="display:none" onchange="voir_select('compt3');afficherAutre(this.name,compt2a.name);" id="compt2" name="compt2"><option value="<?php echo utf8_encode($v_hp[19]);?>"> <?php echo utf8_encode($v_hp[19]);?></option><?php $epce->texte('Competence'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="compt2a"  id="compt2a"/><select style="display:none" onchange="voir_select('compt4');afficherAutre(this.name,compt3a.name);" id="compt3"  name="compt3"><option value="<?php echo utf8_encode($v_hp[20]);?>"> <?php echo utf8_encode($v_hp[20]);?></option><?php $epce->texte('Competence'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="compt3a"  id="compt3a"/><select style="display:none" onchange="afficherAutre(this.name,compt4a.name);" id="compt4" name="compt4"><option value="<?php echo utf8_encode($v_hp[21]);?>"> <?php echo utf8_encode($v_hp[21]);?></option><?php $epce->texte('Competence'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="compt4a"  id="compt4a"/> </td>
                <td valign="top"  class="td1 table3Col2"><select  onchange="voir_select('delai2');afficherAutre(this.name,delai1a.name);" id="delai1" name="delai1"><option value="<?php echo utf8_encode($v_hp[22]);?>"> <?php echo utf8_encode($v_hp[22]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="delai1a"  id="delai1a"/><select style="display:none" onchange="voir_select('delai3');afficherAutre(this.name,delai2a.name);" id="delai2" name="delai2"><option value="<?php echo utf8_encode($v_hp[23]);?>"> <?php echo utf8_encode($v_hp[23]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="delai2a"  id="delai2a"/><select style="display:none" onchange="voir_select('delai4');afficherAutre(this.name,delai3a.name);" id="delai3" name="delai3"><option value="<?php echo utf8_encode($v_hp[24]);?>"> <?php echo utf8_encode($v_hp[24]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="delai3a"  id="delai3a"/><select style="display:none" onchange="afficherAutre(this.name,delai4a.name);"  id="delai4" name="delai4"><option value="<?php echo utf8_encode($v_hp[25]);?>"> <?php echo utf8_encode($v_hp[25]);?></option><?php $epce->texte('Delais / Priorite'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="delai4a"  id="delai4a"/></td>
                <td valign="top"  class="tdFin table3Col3"><select onchange="voir_select('type2');afficherAutre(this.name,type1a.name);"  id="type1" name="type1"><option value="<?php echo utf8_encode($v_hp[26]);?>"> <?php echo utf8_encode($v_hp[26]);?></option><?php $epce->texte('Type de formation courte recommandee'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="type1a"  id="type1a"/> <select style="display:none"  onchange="voir_select('type3');afficherAutre(this.name,type2a.name);" id="type2" name="type2"><option value="<?php echo utf8_encode($v_hp[27]);?>"> <?php echo utf8_encode($v_hp[27]);?></option><?php $epce->texte('Type de formation courte recommandee'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="type2a"  id="type2a"/><select style="display:none" onchange="voir_select('type4');afficherAutre(this.name,type3a.name);" id="type3" name="type3"><option value="<?php echo utf8_encode($v_hp[28]);?>"> <?php echo utf8_encode($v_hp[28]);?></option><?php $epce->texte('Type de formation courte recommandee'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="type3a"  id="type3a"/><select style="display:none" onchange="afficherAutre(this.name,type4a.name);" id="type4" name="type4"><option value="<?php echo utf8_encode($v_hp[29]);?>"> <?php echo utf8_encode($v_hp[29]);?></option><?php $epce->texte('Type de formation courte recommandee'); ?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select><input type="text" size="55" style="display:none"  name="type4a"  id="type4a"/></td>
              </tr>
            </tbody></table></center><br/> <h3><img src="../images/32x32/hire-me.png" /> Diagnostic et commentaires du referent</h3><br>
 <center><textarea name="diag_coherence" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo utf8_encode($v_hp[38]);?></textarea></center>
      
        

<br/><br/><center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px" name="sauvegarder" type="submit" value="Sauvegarder" /></center><br/></div></form></center><form action="coherence.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="suite">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" value="0" type="radio"  /> </td>
<td style="text-align: left">Enregistrer et quitter</td></tr><tr><td width="26" style="text-align: left"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input style="width:20px;height:20px" checked="checked"   type="radio" name="radio_co" value="1" /> </td>
  <td width="400" style="text-align: left">
  Enregistrer et passer à l'étape suivante</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"  name="radio_co" type="radio" value="2"  /> </td>
<td style="text-align: left">
  Mettre fin à la prestation</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="submit" name="alert2" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><form action="coherence.php" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="radio_co" value="<?php echo $_GET['radio_co']; ?>" />
<div style="display:none; padding:10px; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 2;" id="validator">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Souhaitez vous valider cette étape ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input style="width:20px;height:20px"  name="validator_co" value="1" type="radio"  /> </td>
<td style="text-align: left">Oui</td><td width="330" style="text-align: left; font-size:10px;">
  Attention : vous ne pourrez plus effectuer de modifications.</td></tr><tr><td width="26" style="text-align: left"><input style="width:20px;height:20px" checked="checked"   type="radio" name="validator_co" value="0" /> </td>
  <td width="178" style="text-align: left">
  Pas maintenant</td></tr>
<tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById(validator').style.display='none'" type="submit" name="validator"  value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('validator').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form>

<?php } ?>
        



</body>
</html>
<?php

if(isset($_POST['sauvegarder']))
{
	$rapport = new Rapport_activite($_SESSION['id']);
	$rapport->action('sauvegarde la cohérence Homme / Projet de '.$retour[0].'');
	
	if($_SESSION['type_presta']=="EPCE")
	{
		$nacre_eval->verif_beneficiaire_coherence_hp($_POST['id_beneficiaire'], utf8_decode($_POST['exp_pro']), utf8_decode($_POST['exp_pro2']), utf8_decode($_POST['exp_pro3']),utf8_decode($_POST['exp_pro4']), utf8_decode($_POST['exp_pro5']), utf8_decode($_POST['exp_pro6']), utf8_decode($_POST['comp_pro']), utf8_decode($_POST['comp_pro2']), utf8_decode($_POST['comp_pro3']), utf8_decode($_POST['comp_pro4']), utf8_decode($_POST['comp_pro5']), utf8_decode($_POST['comp_pro6']),utf8_decode($_POST['form_savoir']), utf8_decode($_POST['form_savoir2']), utf8_decode($_POST['form_savoir3']), utf8_decode($_POST['form_savoir4']),utf8_decode($_POST['form_savoir5']),utf8_decode($_POST['form_savoir6']), utf8_decode($_POST['compt1']), utf8_decode($_POST['compt2']), utf8_decode($_POST['compt3']), utf8_decode($_POST['compt4']), utf8_decode($_POST['delai1']), utf8_decode($_POST['delai2']), utf8_decode($_POST['delai3']), utf8_decode($_POST['delai4']), utf8_decode($_POST['type1']), utf8_decode($_POST['type2']), utf8_decode($_POST['type3']), utf8_decode($_POST['type4']), utf8_decode($_POST['element_porteur']),utf8_decode($_POST['element_porteur2']), utf8_decode($_POST['element_porteur3']), utf8_decode($_POST['element_porteur4']), utf8_decode($_POST['points_vigilance']), utf8_decode($_POST['points_vigilance2']),utf8_decode($_POST['points_vigilance3']), utf8_decode($_POST['points_vigilance4']),utf8_decode($_POST['diag_coherence']),'');
		
	}
	if($_SESSION['type_presta']=="NACRE1")
	{
		$nacre_eval->verif_beneficiaire_coherence_hp($_POST['id_beneficiaire'], utf8_decode($_POST['exp_pro']), utf8_decode($_POST['exp_pro2']), utf8_decode($_POST['exp_pro3']),utf8_decode($_POST['exp_pro4']), utf8_decode($_POST['exp_pro5']), utf8_decode($_POST['exp_pro6']), utf8_decode($_POST['comp_pro']), utf8_decode($_POST['comp_pro2']), utf8_decode($_POST['comp_pro3']), utf8_decode($_POST['comp_pro4']), utf8_decode($_POST['comp_pro5']), utf8_decode($_POST['comp_pro6']),utf8_decode($_POST['form_savoir']), utf8_decode($_POST['form_savoir2']), utf8_decode($_POST['form_savoir3']), utf8_decode($_POST['form_savoir4']),utf8_decode($_POST['form_savoir5']),utf8_decode($_POST['form_savoir6']), utf8_decode($_POST['compt1']), utf8_decode($_POST['compt2']), utf8_decode($_POST['compt3']), utf8_decode($_POST['compt4']), utf8_decode($_POST['delai1']), utf8_decode($_POST['delai2']), utf8_decode($_POST['delai3']), utf8_decode($_POST['delai4']), utf8_decode($_POST['type1']), utf8_decode($_POST['type2']), utf8_decode($_POST['type3']), utf8_decode($_POST['type4']), utf8_decode($_POST['element_porteur']),utf8_decode($_POST['element_porteur2']), utf8_decode($_POST['element_porteur3']), utf8_decode($_POST['element_porteur4']), utf8_decode($_POST['points_vigilance']), utf8_decode($_POST['points_vigilance2']),utf8_decode($_POST['points_vigilance3']), utf8_decode($_POST['points_vigilance4']),utf8_decode($_POST['diag_coherence']),$_POST['id_presta']);
		
	}
	
	if($_SESSION['type_presta']!="NACRE1")
	{
$epce_eval->verif_beneficiaire_coherence_hp($_POST['id_beneficiaire'], utf8_decode($_POST['exp_pro']), utf8_decode($_POST['exp_pro2']), utf8_decode($_POST['exp_pro3']),utf8_decode($_POST['exp_pro4']), utf8_decode($_POST['exp_pro5']), utf8_decode($_POST['exp_pro6']), utf8_decode($_POST['comp_pro']), utf8_decode($_POST['comp_pro2']), utf8_decode($_POST['comp_pro3']), utf8_decode($_POST['comp_pro4']), utf8_decode($_POST['comp_pro5']), utf8_decode($_POST['comp_pro6']),utf8_decode($_POST['form_savoir']), utf8_decode($_POST['form_savoir2']), utf8_decode($_POST['form_savoir3']), utf8_decode($_POST['form_savoir4']),utf8_decode($_POST['form_savoir5']),utf8_decode($_POST['form_savoir6']), utf8_decode($_POST['compt1']), utf8_decode($_POST['compt2']), utf8_decode($_POST['compt3']), utf8_decode($_POST['compt4']), utf8_decode($_POST['delai1']), utf8_decode($_POST['delai2']), utf8_decode($_POST['delai3']), utf8_decode($_POST['delai4']), utf8_decode($_POST['type1']), utf8_decode($_POST['type2']), utf8_decode($_POST['type3']), utf8_decode($_POST['type4']), utf8_decode($_POST['element_porteur']),utf8_decode($_POST['element_porteur2']), utf8_decode($_POST['element_porteur3']), utf8_decode($_POST['element_porteur4']), utf8_decode($_POST['points_vigilance']), utf8_decode($_POST['points_vigilance2']),utf8_decode($_POST['points_vigilance3']), utf8_decode($_POST['points_vigilance4']), utf8_decode($_POST['diag_coherence']),$_POST['id_presta']);
	}
echo'<script>window.location.href="coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert=suite";</script>';
}
if($_GET['alert']=="suite")
{
echo"<script>document.getElementById('suite').style.display='block';</script>";

}
if(isset($_POST['alert2']))
{

	echo'<script>window.location.href="coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert3=1&radio_co='.$_POST['radio_co'].'"</script>';
	
}

if($_POST['validator_co']==1)
{
	
	
	$epce->valider($_POST['id_beneficiaire'],"coherence",$_POST['id_presta']);
	
	
}
if(isset($_POST['validator']) and $_POST['radio_co']==0)
{

	echo'<script>window.location.href="../presentation/panel.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&display_eval=block";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==1)
{

	echo'<script>window.location.href="commerciaux.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}
else if(isset($_POST['validator']) and $_POST['radio_co']==2)
{
 $_SESSION['abandon'] = "ab_coherence";
	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'";</script>';
}


		if($_GET['alert3']==1)
{ 
  	echo"<script>document.getElementById('validator').style.display='block';</script>";
	
}



if($_GET['telechargement']=="plan_fiche")
	{
		echo'<SCRIPT LANGUAGE="JavaScript">
  var obj ="window.open(\'telechargement.php?statut=adhere&email_siege=none&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj2 ="window.open(\'telechargement.php?statut=plan_eval&email_siege=none&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
    var obj3 ="window.open(\'telechargement.php?statut=emargement&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	     var obj4 ="window.open(\'telechargement.php?statut=couverture&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
  setTimeout(obj,1000);
  setTimeout(obj2,5000);
    setTimeout(obj3,10000);
	  setTimeout(obj4,15000);

  </script>';
	}
	/*if($_GET['telechargement']=="coherence_fin")
	{
		echo'<SCRIPT LANGUAGE="JavaScript">
  var obj ="window.open(\'telechargement.php?statut=adhere&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj2 ="window.open(\'telechargement.php?statut=plan_eval&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
      var obj4 ="window.open(\'telechargement.php?statut=emargement&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
 
 setTimeout(obj,1000);
  setTimeout(obj2,5000);
  setTimeout(obj3,10000);
   setTimeout(obj4,15000);
      setTimeout(obj5,20000);

  </script>';}*/
	if($_GET['envoi']==true and $_GET['imprimer']==true)
	{
	

	echo'<SCRIPT LANGUAGE="JavaScript">
  var obj ="window.open(\'telechargement.php?statut=adhere&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj2 ="window.open(\'telechargement.php?statut=plan_eval&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
    var obj3 ="window.open(\'telechargement.php?statut=emargement&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	     var obj4 ="window.open(\'telechargement.php?statut=couverture&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj5= alert("Le plan d\'évaluation a été validé et envoyé au prescripteur");
  setTimeout(obj,1000);
  setTimeout(obj2,5000);
  setTimeout(obj3,10000);
   setTimeout(obj4,15000); 
   setTimeout(obj5,20000);
  </script>';
  

	} 
	elseif($_GET['envoi']==true)
	{
	

$imp=new epce_impression($_GET['choix'],$_SESSION['id'],$_GET['id_presta']);
$imp->imprimer="none";
$imp->email_siege="presta@apsie.org";
$imp->imprimer_totalite_plan($_GET['choix'],$_SESSION['id']);
$imp->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id'],'adhere');

  
	echo'<script>alert("La fiche évènement et le plan d\'évaluation ont été validé et envoyé sur presta@apsie.org")</script>';
	} 
	
?>
