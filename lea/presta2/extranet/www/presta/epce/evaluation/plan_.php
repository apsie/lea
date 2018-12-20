<?php 
session_start();

include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../inc/class.rapport_activite.inc.php');
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
	$v_plan=$epce_eval->plan_eval($_GET['id_presta'],$_GET['choix']);
	//$v_rdv_plan=$epce_eval->select_rdv_plan($_GET['choix']);
	//$v_bilan_avis=$epce_eval->bilan_avis($choix);
	 $color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	}
	


if($_POST['oui_hp']==1 and $_POST['oui_validator']==1 and  $_POST['oui_imp']==1)
{ 
    $epce->valider($_POST['id_beneficiaire'],"plan",$_POST['id_presta']);
	header('Location: coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=true&imprimer=true');
}
elseif($_POST['oui_hp']==1  and  $_POST['oui_imp']==1)
{ 
   
	header('Location: coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&telechargement=plan_fiche');
}
elseif( $_POST['oui_validator']==1 and  $_POST['oui_imp']==1)
{ 
    $epce->valider($_POST['id_beneficiaire'],"plan",$_POST['id_presta']);
	header('Location: plan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=true&telechargement=plan_fiche');
}
elseif($_POST['oui_hp']==1 and $_POST['oui_validator']==1 )
{ 
    $epce->valider($_POST['id_beneficiaire'],"plan",$_POST['id_presta']);
	header('Location: coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=true');
}
elseif($_POST['oui_hp']==1)
{
	header('Location: coherence.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'');
}
elseif($_POST['oui_validator']==1)
{       
    $epce->valider($_POST['id_beneficiaire'],"plan",$_POST['id_presta']);
		header('Location: plan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=true');
}
	
	elseif($_POST['oui_imp']==1)
{       
      
		header('Location: plan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&telechargement=plan_fiche');
}
	
	
if(isset($_POST['ok_abandon']))
{
	$epce->valider($_POST['id_beneficiaire'],"tout_plan",$_POST['id_presta']);

	$epce->update_presta_epce($_POST['id_beneficiaire'],'Abandon');
	/*echo'<script>window.location.href="plan.php?choix='.$_POST['id_beneficiaire'].'&ab1=1";</script>';*/
	if($_POST['ab1']==1)
	{
	header('Location: plan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&ab1=1');
	}
	else
	{
	header('Location: plan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'');
	}
	 

}


	
	



if($_GET['ab1']==1)
	{
		echo'<SCRIPT LANGUAGE="JavaScript">
  var obj ="window.open(\'telechargement.php?comment='.$_GET['comment'].'&id_presta='.$_GET['id_presta'].'&statut=adhere_pas&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj2 ="window.open(\'telechargement.php?statut=plan_eval&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
     var obj4 ="window.open(\'telechargement.php?statut=emargement&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	     var obj5 ="window.open(\'telechargement.php?statut=couverture&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
 
 setTimeout(obj2,1000);
 setTimeout(obj3,5000);
 setTimeout(obj,10000);
  setTimeout(obj4,15000);
   setTimeout(obj5,20000);
  
   
  </script>';
	

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

<body> <center>
  <input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>PLAN D'EVALUATION : <img src="../images/icons/user.png" /> <?php echo   $retour[0];?></strong> 
    </center>
<?php if(isset($color[0]) and ($color[0]==1 or $color[0]==NULL ))
 {
	?>
 
<div style="display:block; border:2px solid #000; background-color:#FEFBC5" id="plan">
  <h3><img src="../images/32x32/lightbulb.png"/> Le projet du beneficiaire</h3>
<br/><center><table width="834"><tr><td width="343">Description succincte du
projet par le referent</td><td width="479"><font color="#FF0000" style="font-weight:bolder"> <?php echo utf8_encode($v_plan[0]); ?></font> </td></tr><tr><td>Etat d'avancement du
projet</td><td><?php echo utf8_encode($v_plan[1]);?></td></tr><tr><td>Points a evaluer
priorite</td><td><?php echo utf8_encode($v_plan[2]);?></td></tr><tr><td>
</td><td><?php echo utf8_encode($v_plan[14]);?></td></tr><tr><td>
</td><td><?php echo utf8_encode($v_plan[15]);?></td></tr></table></center>
<br/>
<h3><img src="../images/32x32/attibutes.png" /> Les attentes du beneficiaire</h3>
<br/><center><table width="833"><tr><td width="342">Attentes du beneficiaire</td><td width="479"><?php echo utf8_encode($v_plan[3]);?></td></tr><tr><td width="342"></td><td width="479"><?php echo utf8_encode($v_plan[16]);?></td></tr><tr><td width="342"></td><td width="479"><?php echo utf8_encode($v_plan[17]);?></td></tr><tr><td>Commentaires du
referent</td><td><?php echo utf8_encode($v_plan[4]);?></td></tr><tr></table></center><br/>
<h3><img src="../images/32x32/calendar.png"/> Plan d'evaluation personnalise</h3>

<center><table><tr>
<td style=" font-weight:bolder">Bénéficiaire présent ?</td> 
<td><?php if($v_plan[13]==1){echo '<img src="../images/tick_32.png"></img>';} if($v_plan[13]==2){echo '<img src="../images/delete_32.png"></img>';} ?> </td></tr></table>
<br/><?php $epce->selectionner_rdv_plan($_GET['id_presta'],$_GET['choix']); ?><br/><br/></center>
</div>
    
    <?php 
 }
     
   elseif($color[0]!=1)
     {
		 ?>
       <form name="form1" action="" method="post"><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="rdv" value="<?php echo $epce->nbre_rdv_plan($_GET['id_presta'],$_GET['choix']); ?>" /> 
<div style="display:block; border:2px solid #000; background-color:#FEFBC5" id="plan">
  <h3><img src="../images/32x32/lightbulb.png"/> Le projet du beneficiaire</h3>
<br/><center><table width="834"><tr><td width="343">Description succincte du
projet par le referent</td><td width="479"><input style="color:#F00; font-weight:bolder"  type="text"  name="descrip_proj" value="<?php echo utf8_encode($v_plan[0]); ?>" /></td></tr><tr><td>Etat d'avancement du
projet</td><td><select onchange="afficherAutre(this.name,etat_proja.name);" id="etat_proj"  name="etat_proj"><option value="<?php echo utf8_encode($v_plan[1]);?>"><?php echo utf8_encode($v_plan[1]);?></option><?php $epce->texte('stade_projet');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option> </select><input type="text" size="55" style="display:none"  name="etat_proja"  id="etat_proja"/></td></tr><tr><td>Points a evaluer
priorite</td><td><select onchange="afficherAutre(this.name,pt_a_evaluera.name);" id="pt_a_evaluer" name="pt_a_evaluer"><option value="<?php echo utf8_encode($v_plan[2]);?>"><?php echo utf8_encode($v_plan[2]);?></option><?php $epce->texte('pt');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option> </select><input type="text" size="55" style="display:none"  name="pt_a_evaluera"  id="pt_a_evaluera"/></td></tr><tr><td>
</td><td><select onchange="afficherAutre(this.name,pt_a_evaluer2a.name);" id="pt_a_evaluer2" name="pt_a_evaluer2"><option value="<?php echo utf8_encode($v_plan[14]);?>"><?php echo utf8_encode($v_plan[14]);?></option><?php $epce->texte('pt');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"  name="pt_a_evaluer2a"  id="pt_a_evaluer2a"/></td></tr><tr><td>
</td><td><select onchange="afficherAutre(this.name,pt_a_evaluer3a.name);" id="pt_a_evaluer3" name="pt_a_evaluer3"><option value="<?php echo utf8_encode($v_plan[15]);?>"><?php echo utf8_encode($v_plan[15]);?></option><?php $epce->texte('pt');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"   name="pt_a_evaluer3a"  id="pt_a_evaluer3a"/></td></tr></table></center>
<br/>
<h3><img src="../images/32x32/attibutes.png" /> Les attentes du beneficiaire</h3>
<br/><center><table width="833"><tr><td width="342">Attentes du beneficiaire</td><td width="479"><select onchange="afficherAutre(this.name,attente_benefa.name);" id="attente_benef" name="attente_benef"><option value="<?php echo utf8_encode($v_plan[3]);?>"><?php echo utf8_encode($v_plan[3]);?></option><?php $epce->texte('Attentes du beneficiaire');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"   name="attente_benefa"  id="attente_benefa"/></td></tr><tr><td width="342"></td><td width="479"><select onchange="afficherAutre(this.name,attente_benef2a.name);" id="attente_benef2" name="attente_benef2"><option value="<?php echo utf8_encode($v_plan[16]);?>"><?php echo utf8_encode($v_plan[16]);?></option><?php $epce->texte('Attentes du beneficiaire');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"   name="attente_benef2a"  id="attente_benef2a"/></td></tr><tr><td width="342"></td><td width="479"><select onchange="afficherAutre(this.name,attente_benef3a.name);" id="attente_benef3" name="attente_benef3"><option value="<?php echo utf8_encode($v_plan[17]);?>"><?php echo utf8_encode($v_plan[17]);?></option><?php $epce->texte('Attentes du beneficiaire');?><option style="color:#F00; font-weight:bolder" value="Autre">Autre</option></select> <input type="text" size="55" style="display:none"   name="attente_benef3a"  id="attente_benef3a"/></td></tr><tr><td>Commentaires du
referent</td><td><textarea  name="comment_ref" cols="50" rows="3" ><?php echo utf8_encode($v_plan[4]);?></textarea></td></tr><tr></table></center><br/>
<h3><img src="../images/32x32/calendar.png"/> Plan d'evaluation personnalise</h3>
<br/>
<center><table width="433" style="border:1px solid #CCC; background-color:#FFF"><tr>
<td width="268"><strong>Le bénéficiaire  adhère t'il à la prestation?</strong></td> 
<td width="129"><input type="radio"  style="width:20px; height:20px" name="sign" value="1" <?php if($v_plan[13]==1){echo 'checked="checked"';} ?> /> 
Oui 
   <input style="width:20px;height:20px" <?php if(isset($v_plan[13]) and $v_plan[13]==2){echo 'checked="checked"';} ?> type="radio" name="sign" value="2" /> Non     </td></tr></table>
<br/><?php $epce->selectionner_rdv_plan($_GET['id_presta'],$_GET['choix']); ?><br/><br/></center>
<center><input style="font-size:20px; background-color: #900    ; color:#FFF; width:200px; height:35px"  type="submit" name="sauvegarder" value="Sauvegarder" /></center><br/></div></form>
         
         <?php
	 }?>
<form action="plan.php" method="post">
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="abandon">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Mettre fin à la prestation</blink></p>
  <table align="left" style="font-size:16px"><tr><td width="26" style="text-align: left"><input type="hidden" name="comment" value="<?php echo $_GET['comment']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input style="width:20px;height:20px" checked="checked" type="checkbox" name="ab1" value="1" /> </td>
  <td width="400" style="text-align: left">
  Imprimer / Envoyer </td></tr>
<tr><td style="text-align: left"><input style="width:20px;height:20px"  disabled="disabled" checked="checked" type="checkbox"  /> </td>
<td style="text-align: left">
  Abandonner la prestation</td></tr><tr><td style="text-align: left"><input  disabled="disabled" checked="checked" style="width:20px;height:20px" type="checkbox"  /> </td>
<td style="text-align: left">
  Valider la prestation</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('abandon').style.display='none'" type="submit" name="ok_abandon" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('abandon').style.display='none'" type="button" value="Annuler" /></td></tr></table>
</div></form>
<form action="plan.php" method="post">
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="oui">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px"><tr><td width="26" style="text-align: left"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><input style="width:20px;height:20px" type="checkbox" checked="checked" name="oui_imp" value="1" /> </td>
  <td width="400" style="text-align: left">
  Editer</td></tr>
<tr><td style="text-align: left"><input style="width:20px;height:20px" checked="checked"  name="oui_hp" value="1" type="checkbox"  /> </td>
<td style="text-align: left">Enregistrer et passer à l'étape suivante</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"  name="oui_validator" type="checkbox" checked="checked"  value="1"  /> </td>
<td style="text-align: left">
  Valider et envoyer</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('oui').style.display='none'" type="submit" name="ok_oui" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('oui').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form>
<div style=" display:none; padding:10px ; border:3px solid #F00; width:500px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="null">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Précisez si le bénéficiaire adhère à la prestation</blink></p>
  <table align="left" style="font-size:16px"><tr><td width="26" height="46" style="text-align: left"></td><td width="304" style="text-align: left"><input style="width:50px;height:20px" type="submit" value="Fermer" /></td></tr></table>
</div>

<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="rdv">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Poser vos rendez-vous !</blink></p>
  <p style="font-size:14px;  text-align: left;">Attention , vous avez posé <strong><?php echo $_GET['alert']; ?> rendez-vous</strong>.<br/>
  <a href="../pose_rdv.php?id_presta=<?php echo $_GET['id_presta']; ?>&choix=<?php echo $_GET['choix']; ?>&alert=plan_eval">Cliquer ici</a> pour poser les suivants.</p>
</div>
</body>
</html>
<?php


if(isset($_POST['sauvegarder']))
{
	$rapport = new Rapport_activite($_SESSION['id']);
	$rapport->action('sauvegarde le plan d\'évaluation de '.$retour[6].'  '. $retour[0].' '.$retour[1].' '.$retour[2].' '.$retour[3].' '.$retour[4].'');
	if(isset($_POST['sign']) and $_POST['sign']==1 and $_POST['rdv']>=4)
{
$sign=$_POST['sign'];
$alert="oui";




}
else if(isset($_POST['sign']) and $_POST['sign']==2)
{
$sign=2;
$alert="abandon";
$_SESSION['comment']=$_POST['comment_ref'];
}
else if($_POST['rdv']<4)
{
$sign=$_POST['sign'];
$alert=$_POST['rdv'];

}

$epce_eval->verif_beneficiaire_plan_eval($_POST['id_beneficiaire'], utf8_decode($_POST['descrip_proj']), utf8_decode($_POST['etat_proj']), utf8_decode($_POST['pt_a_evaluer']), utf8_decode($_POST['pt_a_evaluer2']),utf8_decode($_POST['pt_a_evaluer3']),utf8_decode($_POST['attente_benef']),utf8_decode($_POST['attente_benef2']),utf8_decode($_POST['attente_benef3']),utf8_decode($_POST['comment_ref']), $_POST['pt_date1'], $_POST['pt_date2'] ,  $_POST['diagnostic1_date1'],  $_POST['diagnostic1_date2'],  $_POST['diagnostic2_date1'],  $_POST['diagnostic2_date2'],  $_POST['pt_plan_date1'],  $_POST['pt_plan_date2'], $sign,$_POST['id_presta']);

echo'<script>window.location.href="plan.php?&id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert='.$alert.'"</script>';
}
if($_GET['alert']=="abandon")
{
echo"<script>document.getElementById('abandon').style.display='block';</script>";

}
if($_GET['alert']=="null")
{
echo"<script>document.getElementById('null').style.display='block';</script>";

}
if($_GET['alert']=="oui")
{
echo"<script>document.getElementById('oui').style.display='block';</script>";

}
if(is_numeric($_GET['alert']))
{
echo"<script>document.getElementById('rdv').style.display='block';</script>";

}

if($_GET['telechargement']=="plan_fiche" and $_GET['envoi']==true)
	{
		echo'<SCRIPT LANGUAGE="JavaScript">
  var obj ="window.open(\'telechargement.php?statut=adhere&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  var obj2 ="window.open(\'telechargement.php?statut=plan_eval&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
    var obj3 ="window.open(\'telechargement.php?statut=emargement&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	     var obj4 ="window.open(\'telechargement.php?statut=couverture&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
 var obj5= alert("Le plan d\'évaluation a été validé et envoyé sur presta@apsie.org");
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
	
	elseif($_GET['telechargement']=="plan_fiche")
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
?>