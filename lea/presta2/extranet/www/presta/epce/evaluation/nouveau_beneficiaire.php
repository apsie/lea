<?php
session_start();
require('../inc/class.epce.inc.php');
$epce=new epce(date('Y'));

if($_GET['option_ben']!='nouveau')
{

	
$nb=count($_GET['option']);

	for ($i=0;$i<count($_GET['option']);$i++)

{

$loption[$i] = $_GET['option'][$i];
$opt=$loption[$i].'-';
$epce->link_beneficiaire_option($_GET['option_ben'],$nb,$opt);


} 

	
	
	
	header('Location: ../presentation/panel.php?choix='.$_GET['option_ben'].'');
}




if(isset($_GET['option']) and $_GET['option']!=NULL)
{

$table=	explode("-",$_GET['option'][0]	);


if($table[4]=="EPC93")
{
$table[4] = "EPCE";
}


$phrase=" pour cette prestation ";


}
if(isset($_GET['categorie']))
$categorie = $_GET['categorie'];
if(isset($_GET['mot']))
	$mot = $_GET['mot'];
	if(isset($_GET['valid']))
	$valid = $_GET['valid'];
	if(isset($_GET['id_ben']))
	{
	$id_ben = $_GET['id_ben'];
	}
	else
	{
		$id_ben=NULL;
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<title>Bénéficiaire</title>
<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
<style type="text/css">
<!--


	.suggestionsBox {
		position:relative;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 300px;
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
		background-color: #0C0;
	}
.suggestionsBox1 {		position:relative;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 150px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
}
-->
</style><script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	
	function lookup2(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("rpc_.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data);
				}
			});
		}
	} // lookup
	
	function lookup_safir(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_safir').hide();
		} else {
			$.post("rpc_safir.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_safir').show();
					$('#autoSuggestionsList_safir').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,thisValue2,thisValue3,thisValue4) {
		$('#inputString').val(thisValue);
		$('#adr_two_locality').val(thisValue2);
		$('#adr_two_region').val(thisValue3);
		$('#adr_two_countryname').val(thisValue4);
		
		setTimeout("$('#suggestions').hide();", 200);
	}
	function fill2(thisValue,thisValue2,thisValue3,thisValue4) {
		$('#adr_one_postalcode').val(thisValue);
		$('#adr_one_locality').val(thisValue2);
		$('#adr_one_region').val(thisValue3);
		$('#adr_one_countryname').val(thisValue4);
		
		setTimeout("$('#suggestions2').hide();", 200);
	}
	function fill_safir(thisValue) {
		$('#code_safir').val(thisValue);
	
		
		setTimeout("$('#suggestions_safir').hide();", 200);
	}
	
		
	function lookup_contact_prescripteur(inputString,cod_org) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_contact_prescripteur').hide();
		} else {
			$.post("ajax_contact_prescripteur.php", {queryString: ""+inputString+"",categorie_org: ""+cod_org+""}, function(data){
				if(data.length >0) {
					$('#suggestions_contact_prescripteur').show();
					$('#autoSuggestionsList_contact_prescripteur').html(data);
				}
			});
		}
	} // lookup
	
			function fill_contact_prescripteur(thisValue,thisValue2,thisValue3,thisValue4,thisValue5,thisValue6,thisValue7) {
		
		$('#nom_p').val(thisValue);
		$('#prenom_p').val(thisValue2);
		$('#tel_bureau_p').val(thisValue3);
		$('#tel_portable_p').val(thisValue4);
		$('#email_bureau_p').val(thisValue5);
		$('#email_perso_p').val(thisValue6);
		$('#civilite_p').val(thisValue7);
		
		
	
		
		setTimeout("$('#suggestions_contact_prescripteur').hide();", 200);
	}
	
	
	function chercher(inputString)
	{
	$.post("rpc2.php", {queryString: ""+inputString+""});

	}
	
	function voir_contact()
	{
		if(document.getElementById('contact_p').style.display=="none")
		{
		document.getElementById('contact_p').style.display = 'block';
		}
		else
		{
		document.getElementById('contact_p').style.display = 'none';
		}
		
	}
	function mail()
	{
		window.document.forms["form"].email_bureau_p.value=window.document.forms["form"].prenom_p.value.toLowerCase()+'.'+window.document.forms["form"].nom_p.value.toLowerCase()+'@pole-emploi.fr';
	
	}
</script>


<script language="javascript">
function voirdiv(nomdiv)
		{
			
			if(document.getElementById(nomdiv).style.display=='none')
			{
			document.getElementById(nomdiv).style.display='block';
			}
			else 
			{
				document.getElementById(nomdiv).style.display='none';
			}
		
		}
        </script>
</head>

<body><form style=" padding-left:15px; background-color:#E8E8E8; border:1px solid #000" id="form" action="../test.php" method="post" >
  <p>
    <input type="hidden"  name="cat_id" value="Usager_10"/>
    <input name="opt" type="hidden" value="<?php 
	
echo $table[0];


?>"  /><input name="nb" type="hidden" value="<?php echo $nb; ?>"  /><input name="account_id" type="hidden" value="<?php echo $table[1]; ?>"  />
  </p>
  <center>
  <h2>NOUVEAU BENEFICIAIRE <?php echo $phrase;?></h2></center> 
  
 <br/> <table><tr><td width="171"><font color="#FF0000">Prestation </font> </td><td width="762"><select name="prestation" style="width:120px">
 
 <?php if(isset($_GET['option'])){echo'<option>'.$table[4].'</option>';} else{echo'<option>EPCE</option><option>NACRE1</option><option>NACRE3</option><option>MCA</option><option>PDI92</option><option>BCF</option><option>VAE</option><option>CREACLD</option>';}?>
 
 </select></td></tr><tr><td><font color="#FF0000">Référent </font> </td><td>
           <?php if(isset($_GET['option'])){
			   echo'	
		<select style="width:120px"  name="conseiller_id">
		<option value='.$table[1].'>'.$table[3].'</option></select>';} else {echo $epce->selectionner_conseiller($table[3],$table[1]); }?></td></tr></table><hr />
  <table width="1084">
    <tr>
      <td width="171">Date de début</td>
      <td width="195"><input size="8" type="text" name="date_debut" value="<?php if($table[2]!=NULL){echo date("dmy",$table[2]);}else{echo date("dmy",time());}?>" id="date_debut" />  <script type="text/javascript">

	document.writeln('<img id="date_debut-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_debut",
		button      : "date_debut-trigger"
	}
	);
</script> <select  style="width:40px"><option><?php if($table[2]!=NULL){echo date("H",$table[2]);}else{echo 9;}?></option></select> H <select  style="width:40px"><option><?php if($table[2]!=NULL){echo date("i",$table[2]);}else{echo 00;}?></option></select></td> <td width="123">Lettre de commande</td>
      <td width="173"><input type="text" name="n_lettre" /></td>
   
      <td width="76">Code safir</td>
      <td width="318"><input onblur="fill_safir();" onkeyup="lookup_safir(this.value);"  id="code_safir"  name="code_safir" type="text" />        
      <img title="Ajouter / selectionner le contact du prescripteur" onclick="javascript:voir_contact();" src="../images/user_16.png" /> *</td>
    </tr>
    <tr>
      <td width="171"></td>
      <td width="195"></td>
      <td width="123"></td>
     
      <td width="173"></td>
      <td width="76"></td>
      <td width="318"></td>
    </tr><tr><td></td><td></td><td></td><td></td><td></td><td height="16"><div class="suggestionsBox" id="suggestions_safir" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList_safir"> &nbsp; </div>
      </div></td></tr>
  </table>
  <h2>Carte d'identité</h2><hr />
  <table>
    <tr>
      <td width="170">Civilité</td>
      <td width="198"><select style="width:120px"  name="n_prefix">
        <option value="Monsieur">Monsieur</option>
        <option value="Madame">Madame</option>
        <option value="Mademoiselle">Mademoiselle</option>
      </select> 
        *</td>
      <td>Tél domicile</td>
      <td><input  name="tel_home" type="text" /></td>
    </tr>
    <tr>
      <td>Nom</td>
      <td><input style="border:1px solid #F00" type="text"  name="n_family" /> 
      *</td>
      <td width="124">Portable perso</td>
      <td width="192"><input name="tel_cell" type="text" /></td>
    </tr>
    <tr>
      <td>Prénom</td>
      <td><input style="border:1px solid #F00" type="text" name="n_given" /> 
        *</td>
      <td>Email bureau</td>
      <td><input name="email" type="text" /></td>
    </tr>
    <tr>
      <td>Deuxième prénom</td>
      <td><input type="text" name="n_middle" /></td>
      <td>Email perso</td>
      <td><input name="email_home" type="text" /></td>
    </tr>
    <tr>
      <td>Nom de jeune fille</td>
      <td><input name="n_suffix" type="text" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   
  </table><br/>  <h2>Situation professionnelle</h2><hr /><table>
    <tr>
      <td width="171">Statut </td>
      <td width="198"><select name="statut" style="width:130px"><option value="Demandeur d'emploi">Demandeur d'emploi</option><?php  $epce->texte('Statut 1'); ?></select></td>
      <td width="127">Identifiant</td>
      <td width="189"><input  type="text" name='id_pole' /> 
        *</td>
    </tr>
   
  </table> 


<div style="position:absolute; border:1px solid #666; background:#EEE; display:none; left: 581px; top: 78px; left: 553px; height: 237px; width: 212px;" id="contact_p"><center><strong>Contact du prescripteur</strong></center><br/><table><tr><td width="80">Civilité</td><td width="123"><select style="width:120px"  id="civilite_p" name="civilite_p"><option value=""></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select></td></tr><tr><td>Nom</td><td><input onblur="fill_contact_prescripteur();" onkeyup="lookup_contact_prescripteur(this.value,256);"  style="border:1px solid #0C0" type="text" id="nom_p" onchange="this.value=this.value.toUpperCase();"  name="nom_p" /><div class="suggestionsBox1" id="suggestions_contact_prescripteur" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList_contact_prescripteur"> &nbsp; </div>
      </div></td></tr><tr><td>Prénom</td><td><input style="border:1px solid #0C0" type="text"  id="prenom_p" onchange="mail();" name="prenom_p" /></td></tr><tr><td>Tel bureau</td><td><input type="text"  id="tel_bureau_p"  name="tel_bureau_p" /></td></tr><tr><td>Fax</td><td><input type="text"  id="tel_portable_p"  name="tel_portable_p" /></td></tr><tr><td>Email bureau</td><td><input type="text" id="email_bureau_p" name="email_bureau_p" /></td><tr><td>Email domicile</td><td><input type="text"   id="email_domicile_p" name="email_domicile_p" /></td></tr><tr><td></td><td><input type="button" onclick="document.getElementById('contact_p').style.display='none'" value="Fermer"  /></td></tr></table></div>


<p><input type="submit" value="Enregistrer" /> <input type="button" value="Retour" onclick="window.location='panel.php?<?php echo 'choix='.$id_ben.'';?>'" /></p></form>
</body>
</html>