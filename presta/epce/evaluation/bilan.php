<?php
session_start();

include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_evaluation_zend.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../inc/class.rapport_activite.inc.php');
include('../../nacre1/inc/class.nacre_evaluation.inc.php');
$epce = new epce(date('y'));
$eval_zend = new evaluation_zend();
	if($_SESSION['type_presta']=="NACRE1")
{

	$epce->table_validation = "egw_nacre_validation";
	
	$eval_zend->table_validation = "egw_nacre_validation";
}
if($_GET['ab']==1)
$_SESSION['abandon']=1;

//include('/data/html/presta/nacre1/inc/class.nacre_evaluation.inc.php');


$nacre_eval = new nacre_evaluation();
if($_SESSION['type_presta']=='NACRE1' and $_GET['choix']!=NULL)
	{

$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
$validation=$eval_zend->verification_validation($_GET['id_presta']);
$retour=$epce->variable_beneficiaire($_GET['choix']);

	$v_bilan_avis=$nacre_eval->bilan_avis($_GET['id_presta'],$_GET['choix']);
	$nbrvalidation=(4 - ( $validation[1] + $validation[2] + $validation[3] + $validation[4]));
	}
	elseif($_GET['choix']!=NULL)
	{
	$validation=$eval_zend->verification_validation($_GET['id_presta']);
	$retour=$epce->variable_beneficiaire($_GET['choix']);
	$presta_epce=$epce->variable_presta_epce($_GET['choix']);
	$epce_eval = new epce_evaluation();
/*	$v_hp=$epce_eval->variable_coherence($choix);
	$v_co=$epce_eval->variable_aspect_commercial($choix);
	$v_fi=$epce_eval->aspect_financier($choix);
	$v_ju=$epce_eval->forme_juridique($choix);
	$v_re=$epce_eval->aspect_reglementaire($choix);*/
	//$v_plan=$epce_eval->plan_eval($_GET['choix']);
	//$v_rdv_plan=$epce_eval->select_rdv_plan($_GET['choix']);
	$v_bilan_avis=$epce_eval->bilan_avis($_GET['id_presta'],$_GET['choix']);
	$color=$epce->voir_validation($_GET['id_presta'],$_GET['choix']);
	$nbrvalidation=(5 - ($validation[0] + $validation[1] + $validation[2] + $validation[3] + $validation[4]));
	
	}
	
	
	
	
if($_SESSION['abandon']!=NULL)
{
$phrase = (5-$nbrvalidation).' étape(s) sur 5 sont validé(s) .<br/>  <font size="0" color=black>- '.$nbrvalidation.' etape(s) abandonnée(s)</font>';



}
else
{
$phrase = "<blink>il vous reste $nbrvalidation étapes à valider.</blink>";
}


if($nbrvalidation!=0)
{
//$etat_save='disabled="disabled"';
$display_validation="block";
}
else
{$display_validation="none";
//$etat_save=NULL;
}
if($_SESSION['abandon']!=NULL)
{$etat_save=NULL;}



/*if($v_bilan_avis[0]=="Negatif")
{
$a="checked='checked'";
}
if($v_bilan_avis[0]=="Positif sous reserve de mise en œuvre du plan d\'actions")
{
$b="checked='checked'";
}
if($v_bilan_avis[0]=="Positif")
{
$c="checked='checked'";
}
if($v_bilan_avis[0]=="Solution alternative proposer")
{
$d="checked='checked'";
}


if($v_bilan_avis[2]=="Entre 6 mois et 1 an , identifier une solution alternative de retour a  l\'emploi a  court terme")
{
$e="checked='checked'";
}
if($v_bilan_avis[2]=="Entre 3 et 6 mois")
{
$f="checked='checked'";
}
if($v_bilan_avis[2]=="Inferieur a 3 mois")
{
$g="checked='checked'";
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta_coherence.css" title="blue">
<title>Bilan</title>
<script type="text/javascript" src="../js/eval.js"></script>
<script type="text/javascript" src="../presentation/jquery-1.2.1.pack.js"></script>
<script>function fill_rome(thisValue,thisValue2) {
		$('#rome').val(thisValue);
		$('#r_emploi').val(thisValue2);
		<!--$('#r_emploi').val(thisValue2);-->
		
		setTimeout("$('#suggestions_rome').hide();", 200);
	}
	function lookup_rome(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc_rome.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_rome').show();
					$('#autoSuggestionsList_rome').html(data);
				}
			});
		}
	} // lookup
	
	
	function verifForm()
{ 

	
	

if(document.getElementById('commentaire_bilan1').value=="")
  {
    	alert('Veuillez saisir un commentaire sur la faisabilité du projet');
		return false;	
  }
  
  
  
 else if(document.getElementById('commentaire_bilan2').value=="")
  {
    	alert('Veuillez saisir un commentaire sur l\'estimation du délai de concrétisation du projet');
		return false;	
  }
	 else if (document.getElementById('com_ben').value=="")
  {
    	alert('Veuillez saisir le commentaire du bénéficiaire');
		return false;	
  }
  else if(document.getElementById('com_ref').value=="")
  {
    	alert('Veuillez saisir votre commentaire sur ce bénéficiaire');
		return false;	
  }
   else if(document.form.avis[0].checked && document.getElementById('r_emploi').value=="")
  {
    
  
    	alert('Veuillez saisir la solution alternative de retour a l\'emploi a court terme');
		return false;	
  

  }

	 else if(document.form.avis[1].checked &&  document.getElementById('r_emploi').value=="")
  {
    
  
    	alert('Veuillez saisir la solution alternative de retour a l\'emploi a court terme');
		return false;	
  

  }

 

  else {return true;}
 
  
} 

function verifierRadio(f)
{

var coche=false;
for(var i=0;i<f.avis.length;i++)
{
	if(f.avis[i].checked)
	{
		coche=true;
	}
}
if (coche) 
{
	return true;

}
else
{
	alert("Veuillez préciser la faisabilité du projet");
		  f.avis[0].focus;
		  return false;
}


}

	</script>
 <style>   
    .suggestionsBox {
		position:relative;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 500px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
		
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #C60  ;
	}</style>
</head>

<body>
<center><input type="button" onclick="window.location.href='../presentation/panel.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>&display_eval=block'" style="width:100px; height:50px; background-color: #CCC; font-size:18px; color:#FFF" value="Retour" /></center><center>
    <strong>BILAN : <img src="../images/icons/user.png" /> <?php echo $retour[0];?></strong> 
    </center>
<?php if(isset($color[5]) and ($color[5]==1 or $color[5]==NULL ))
 {
	 
	 
if($v_bilan_avis[0]==1)
{
$a='<img src="../images/tick_32.png"></img>';
}
else
{
	$a='<img src="../images/delete_32.png"></img>';
}
if($v_bilan_avis[0]==2)
{
$b='<img src="../images/tick_32.png"></img>';
}
else
{
	$b='<img src="../images/delete_32.png"></img>';
}
if($v_bilan_avis[0]==3)
{
$c='<img src="../images/tick_32.png"></img>';
}
else
{
$c='<img src="../images/delete_32.png"></img>';
}

if($v_bilan_avis[0]==4)
{
$d='<img src="../images/tick_32.png"></img>';
}
else
{
$d='<img src="../images/delete_32.png"></img>';
}

if($v_bilan_avis[2]==1)
{
$e='<img src="../images/tick_32.png"></img>';
}
else
{
$e='<img src="../images/delete_32.png"></img>';
}
if($v_bilan_avis[2]==2)
{
$f='<img src="../images/tick_32.png"></img>';
}
else
{
$f='<img src="../images/delete_32.png"></img>';
}
if($v_bilan_avis[2]==3)
{
$g='<img src="../images/tick_32.png"></img>';
}
else
{
$g='<img src="../images/delete_32.png"></img>';
}
	?>
    
     

<div style="border:2px solid #000; background-color:#FC8A3F; padding-left:100px;">
  <h3><img src="../images/32x32/zoom.png" /> Faisabilite du projet </h3>
<br/>
	<?php echo $a; ?> Negatif<br/>
	<?php echo $b; ?> Positif sous reserve de mise en œuvre du plan d'actions<br/>
	<?php echo $c; ?>  Positif<br/>
  <br/>
    
    <br/><br/>
  <h3> <img src="../images/user_32.png"></img>  Faisabilité : Commentaires de l'evaluateur</h3>
   <?php echo  utf8_encode($v_bilan_avis[1]); ?>
    <br/>
    <br/><br/>
    <h3><img src="../images/32x32/full-time.png" /> Estimation du delai de concretisation</h3><br/>

<?php echo $e; ?> Entre 6 mois et 1 an (identifier une solution alternative de retour a  l'emploi a  court terme)<br/>
	<?php echo $f; ?>  Entre 3 et 6 mois<br/>
	<?php echo $g; ?> Inferieur a 3 mois<br/>
    
    <br/><br/>
    <h3> <img src="../images/user_32.png"></img> Estimation : Commentaires de l'evaluateur</h3>
    <p><br/>
    <?php echo  utf8_encode($v_bilan_avis[3]); ?>
    </p>
  <p>&nbsp;</p>
    <h3><img src="../images/32x32/business-contact.png" /> Solution alternative de retour a l'emploi a court terme</h3>  <?php echo $v_bilan_avis[5]; ?>
			
    <p><?php echo  utf8_encode($v_bilan_avis[4]); ?>
  </p>
  <h3><img src="../images/user_32.png"></img>  Commentaire du référent</h3>
  <p><?php echo  utf8_encode($v_bilan_avis[6]); ?>
  </p><br/><br/>
    <h3><img src="../images/user_32.png"></img>  Commentaire du bénéficiaire</h3>
    <p><?php echo utf8_encode($v_bilan_avis[7]); ?>
  </p>
    <p><br/>
     <br/>
    </p>
</div><br/><center></center>
 
 
    <?php 
 }
     
   elseif($color[5]!=1)
     {
		 
if($v_bilan_avis[0]==1)
{
$a="checked='checked'";
}
else
{
	$a=NULL;
}
if($v_bilan_avis[0]==2)
{
$b="checked='checked'";
}
else
{
	$b=NULL;
}
if($v_bilan_avis[0]==3)
{
$c="checked='checked'";
}
else
{
$c=NULL;
}

if($v_bilan_avis[0]==4)
{
$d="checked='checked'";
}
else
{
$d=NULL;
}

if($v_bilan_avis[2]==1)
{
$e="checked='checked'";
}
else
{
$e=NULL;
}
if($v_bilan_avis[2]==2)
{
$f="checked='checked'";
}
else
{
$f=NULL;
}
if($v_bilan_avis[2]==3)
{
$g="checked='checked'";
}
else
{
$g=NULL;
}
		 ?>
   

<form  id="form" name="form" onsubmit="verifierRadio(form);return verifForm();" action="eval_bilan.php" method="post"> <input type="hidden" name="id_beneficiaire" value="<?php echo  $_GET['choix']; ?>"  /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" /><div style="border:2px solid #000; background-color:#FC8A3F; padding-left:100px;"><div id="faisabilite_projet"><h3><img src="../images/32x32/zoom.png" /> Faisabilite du projet (cocher la case correspondant à  l'avis de l'evaluateur)</h3>
<br/>
	<input onclick="document.getElementById('estimation').style.display='none'" type="radio"  id="avis" name="avis" <?php echo $a; ?> value="1" /> Negatif<br/>
	<input onclick="document.getElementById('estimation').style.display='block'" type="radio" id="avis" name="avis"   <?php echo $b; ?>value="2" /> Positif sous reserve de mise en œuvre du plan d'actions<br/>
	<input onclick="document.getElementById('estimation').style.display='block'" type="radio"  id="avis" name="avis"  <?php echo $c; ?> value="3" /> Positif<br/>
  <br/></div>
    
    <br/><br/>
  <h3><img src="../images/user_32.png"></img>  Faisabilité : Commentaires de l'evaluateur</h3>
    <textarea id="commentaire_bilan1"  name="commentaire_bilan1" rows="5" cols="100"><?php echo utf8_encode($v_bilan_avis[1]); ?></textarea>
    <br/>
    <br/><br/>
   <div style="display:none" id="estimation"> <h3><img src="../images/32x32/full-time.png" /> Estimation du delai de concretisation </h3>

	<input type="radio" name="avis_"  <?php echo $e; ?> value="1" /> Entre 6 mois et 1 an (identifier une solution alternative de retour a  l'emploi a  court terme)<br/>
	<input type="radio" name="avis_"  <?php echo $f; ?> value="2" /> Entre 3 et 6 mois<br/>
	<input type="radio" name="avis_"   <?php echo $g; ?>value="3" /> Inferieur a 3 mois<br/>
    
    <br/></div><br/>
    <h3><img src="../images/user_32.png"></img>  Estimation : Commentaires de l'evaluateur</h3>
    <p><br/>
      <textarea id="commentaire_bilan2" name="commentaire_bilan2" rows="5" cols="100"><?php echo utf8_encode($v_bilan_avis[3]); ?></textarea>
    </p>
  <p>&nbsp;</p>
    <h3><img src="../images/32x32/business-contact.png" /> Solution alternative de retour a l'emploi a court terme</h3>  <input onblur="fill_rome();" id="rome" onkeyup="lookup_rome(this.value);" value="<?php echo $v_bilan_avis[5]; ?>" type="text" name="rome"  /> 
    ( Recherche par Métier ; ex : Caissier ) 
    <div class="suggestionsBox" id="suggestions_rome" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_rome">
					&nbsp;
				
			</div></div> 
    <p><textarea id="r_emploi" name="r_emploi" rows="5" cols="100"><?php echo utf8_encode($v_bilan_avis[4]); ?></textarea>
  </p>
  <h3><img src="../images/user_32.png"></img>  Commentaire du référent</h3>
  <p><textarea id="com_ref" name="com_ref" rows="5" cols="100"><?php echo utf8_encode($v_bilan_avis[6]); ?></textarea>
  </p>
    <h3><img src="../images/user_32.png"></img>  Commentaire du bénéficiaire</h3>
    <p><textarea id="com_ben" name="com_ben" rows="5" cols="100"><?php echo utf8_encode($v_bilan_avis[7]); ?></textarea>
  </p>
    <p><br/>
     <br/>
    </p>
 </div><br/><div  id="alert_bilan" style="position:absolute; -moz-border-radius-topright: 20px; -moz-border-radius-bottomright: 20px; -moz-border-radius-bottomleft: 20px; -moz-border-radius-topleft: 20px; display:<?php echo $display_validation; ?> ;background-color: #FFD5E0; border: 2px solid #000; top: 68px; height: 228px; width: 583px; left: 269px;"><table width="586" ><tr style="color:#F00; font-size:30px; text-align:center"><td height="119" ><img src="../images/32x32/busy.png" /> <?php echo $phrase; ?></td></tr>
 <tr> <td height="63" style="padding-left:70px"> <div style="display:none" id="mo_ab"><strong>Motif de l'abandon : </strong></div>
<div style="display:none" id="mo_ab2"> <input name="motif_abandon" type="text"/> </div></td></tr><tr><td style=" text-align:center" ><input type="button" onclick="document.getElementById('alert_bilan').style.display='none'"  style="font-size:15px; background-color: #900     ; color:#FFF; width:100px; height:25px"  value="Continuer"/></td></tr></table></div><center><input   style="font-size:20px; background-color: #900     ; color:#FFF; width:200px; height:35px"  type="submit"   name="Sauvegarder" value="Sauvegarder" /></center></form><form action="bilan.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />
<div style=" display:none; padding:10px ; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 1;" id="suite">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Que voulez vous faire ?</blink></p>
  <table align="left" style="font-size:16px"><tr><td width="26" style="text-align: left"><input style="width:20px;height:20px"  checked="checked"  type="checkbox" name="radio_co" value="1" /> </td>
  <td width="400" style="text-align: left">
  Editer</td></tr><tr><td style="text-align: left"><input style="width:20px;height:20px"    name="radio_co2" type="checkbox" value="1"  /> </td>
<td style="text-align: left"><?php if($_SESSION['id']==1001 or $_SESSION['id']==1002)
{echo 'Clôturer la prestation'; }else{echo'  Clôturer la prestation et envoyer';}?>
</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="submit" name="alert2" value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('suite').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><form action="bilan.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $_GET['choix']; ?>" /><input type="hidden" name="id_presta" value="<?php echo $_GET['id_presta']; ?>" />
<div style="display:none; padding:10px; border:3px solid #F00; width:550px; text-align: center; position:absolute; left: 25%; top: 25%; background-color:#FFF; z-index: 2;" id="validator">
  <p  style="font-size:20px; color:#F00; font-weight:bolder; text-align: left;"><img src="../images/warning_32.png" /> <blink>Etes vous sur de vouloir clôturer cette prestation ?</blink></p>
  <table align="left" style="font-size:16px">
<tr><td style="text-align: left"><input checked="checked" style="width:20px;height:20px"  name="validator_co" value="1" type="radio"  /> </td>
<td style="text-align: left">Oui</td></tr><tr><td width="26" style="text-align: left"><input style="width:20px;height:20px"    type="radio" name="validator_co" value="0" /> </td>
  <td width="400" style="text-align: left">
  Pas maintenant</td></tr><tr>
    <td style="text-align: left">&nbsp;</td>
<td style="text-align: left; font-size:10px;">
  Attention : vous ne pourrez plus effectuer de modifications.</td></tr><tr><td height="46" style="text-align: left"></td><td style="text-align: left"><input style="width:50px;height:20px" onclick="document.getElementById('validator').style.display='none'" type="submit" name="validator"  value="OK" /> <input style="width:50px;height:20px" onclick="document.getElementById('validator').style.display='none'" type="button"  value="Annuler" /></td></tr></table>
</div></form><br /><?php }?>
</body></html>

<?php

if($_GET['alert']=="suite")
{
	
echo"<script>document.getElementById('suite').style.display='block';</script>";
echo"<script>document.getElementById('alert_bilan').style.display='none';</script>";
}
/*if(isset($_POST['alert2']))
{

	echo'<script>window.location.href="bilan.php?choix='.$_POST['id_beneficiaire'].'&alert3=1&radio_co='.$_POST['radio_co'].'"</script>';
}*/



if($_POST['validator_co']==1)
{
	

	
	if($_SESSION['abandon'] !=NULL)
	{
		$epce->valider($_POST['id_beneficiaire'],$_SESSION['abandon'],$_POST['id_presta']);
		$epce->update_presta_epce($_POST['id_beneficiaire'],'Abandon',$_POST['id_presta']);
		$epce->return_cal_id_U($_POST['id_presta']);
		$eval_zend->update_date_fin_reelle($_POST['id_presta']);
		
		}
	else
	{
	  $epce->valider($_POST['id_beneficiaire'],'tout',$_POST['id_presta']);
	  $epce->update_presta_epce($_POST['id_beneficiaire'],'Complete',$_POST['id_presta']);
	  	$eval_zend->update_date_fin_reelle($_POST['id_presta']);
	}
	if($_SESSION['cloture']==1)
	{
		if($_SESSION['id']==1001 or $_SESSION['id']==1002)
		{
			echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert_dossier=ok"</script>';
		}
		else
		{
		echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=ok"</script>';
		}
		}
	elseif($_SESSION['editer_cloture']==1)
	{
		
		if($_SESSION['id']==1001 or $_SESSION['id']==1002)
		{
		echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&alert_dossier=ok"</script>';
		}
		else
		{ echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&editer_cloture=ok"</script>';
		
		}
	}
}
else if(isset($_POST['validator_co']) and $_POST['validator_co']==0)
{ 

echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&envoi=none"</script>';


}
if($_POST['radio_co']==1 and $_POST['radio_co2']==1)
{ unset($_SESSION['cloture']);
	$_SESSION['editer_cloture']=1;

	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&editer_cloturer=1"</script>';
	
}
else if($_POST['radio_co']==1)
{

	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&telechargement=bilan_final"</script>';
	
}
else if($_POST['radio_co2']==1)
{unset($_SESSION['editer_cloture']);
	$_SESSION['cloture']=1;

		echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'&cloture=1"</script>';
	
}
else if(isset($_POST['alert2']) and $_POST['radio_co']==NULL and $_POST['radio_co2']==NULL)
{

	echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'"</script>';
	
}
elseif(isset($_POST['alert2']))
{
echo'<script>window.location.href="bilan.php?id_presta='.$_POST['id_presta'].'&choix='.$_POST['id_beneficiaire'].'"</script>';
}
if($_GET['cloture']==1 or $_GET['editer_cloturer']==1)
{

echo"<script>document.getElementById('validator').style.display='block';</script>";
	
}
if($_GET['telechargement']=="bilan_final")
	{
	
		
			echo'<SCRIPT LANGUAGE="JavaScript">
 
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&email_siege=none&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";

     var obj4 ="window.open(\'telechargement.php?statut=abandon&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	 
	 

 
  
      setTimeout(obj5,1000);
	 
	 
	
	    </script>';}



if($_GET['envoi']=="ok" and $_SESSION['motif_abandon']!=NULL)
	{

			echo'<SCRIPT LANGUAGE="JavaScript">
 
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   	   
   var obj4 ="window.open(\'telechargement.php?id_presta='.$_GET['id_presta'].'&statut=abandon&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   
	   
 var obj6 ="alert(\'Le bilan a été clôturé.Merci d envoyer le bilan et le form_bilanprest.xls à bilans-prestation.061@poleemploi.extelia.fr depuis la boite mail de Qualite.\')";


 
   setTimeout(obj3,1000);
      setTimeout(obj5,5000);
	  setTimeout(obj4,10000);
	   setTimeout(obj6,15000);
	    </script>';
	} 
elseif($_GET['envoi']=="ok")
	{

			echo'<SCRIPT LANGUAGE="JavaScript">
 
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	
	   
	   
 var obj6 ="alert(\'Le bilan a été clôturé.Merci d envoyer le bilan et le form_bilanprest.xls à bilans-prestation.061@poleemploi.extelia.fr depuis la boite mail de Qualite.\')";


 
   setTimeout(obj3,1000);
      setTimeout(obj5,5000);
	   setTimeout(obj6,10000);
	    </script>';
	} 
	elseif(isset($_GET['envoi']) and $_GET['envoi']=="none")
	{
	
	echo'<script>alert("Opération annulée...")</script>';
	} 
	
	elseif(isset($_GET['alert_dossier']) and $_GET['alert_dossier']=="ok")
	{
	
	echo'<script>alert("Prestation clôturer , merci d\'avoir complété le dossier...")</script>';
	} 
	
	
	if($_GET['editer_cloture']=="ok" and $_SESSION['motif_abandon']!=NULL)
	{
	


			echo'<SCRIPT LANGUAGE="JavaScript">
 
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   
	
		
	    var obj4 ="window.open(\'telechargement.php?id_presta='.$_GET['id_presta'].'&statut=abandon&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   
 var obj6 ="alert(\'Le bilan a été clôturé.Merci d envoyer le bilan et le form_bilanprest.xls à bilans-prestation.061@poleemploi.extelia.fr depuis la boite mail de Qualite.\')";


 
   setTimeout(obj3,1000);
  
      setTimeout(obj5,5000);
	  
	   setTimeout(obj4,10000);
	   setTimeout(obj6,15000);
	    </script>';
		
	} 
	elseif($_GET['editer_cloture']=="ok")
	{
	


			echo'<SCRIPT LANGUAGE="JavaScript">
 
   var obj3 ="window.open(\'telechargement.php?statut=annexe1&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
  
	   var obj5 ="window.open(\'telechargement.php?statut=bilan&id_presta='.$_GET['id_presta'].'&choix='.$_GET['choix'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=0, height=0\')";
	   
	  
	   
 var obj6 ="alert(\'Le bilan a été clôturé.Merci d envoyer le bilan et le form_bilanprest.xls à bilans-prestation.061@poleemploi.extelia.fr depuis la boite mail de Qualite.\')";

 </script>';
 
 if($_SESSION['type_presta']=='EPCE')
 {
	echo'<script> setTimeout(obj3,1000);</script>';
 }
   echo'<script> setTimeout(obj5,5000);</script>';
	   
		
	} 
	
if($_SESSION['abandon']!=NULL)
{

echo"<script>document.getElementById('faisabilite_projet').style.display='none';</script>";
echo"<script>document.getElementById('mo_ab').style.display='block';</script>";
echo"<script>document.getElementById('mo_ab2').style.display='block';</script>";
}

?>
