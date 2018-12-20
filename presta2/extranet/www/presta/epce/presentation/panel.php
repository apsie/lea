<?php
session_start();

if(isset($_GET['type_presta']))
{
$_SESSION['type_presta']=$_GET['type_presta'];
}

if(isset($_SESSION['id']))
{}

else
{
 // header('Location: ../erreur.php');
}
include('../inc/class.epce.inc.php');
include('../inc/class.epce_evaluation.inc.php');
include('../inc/class.epce_impression.inc.php');
include('../../inc/class.rapport_activite.inc.php');

$rapport = new Rapport_activite($_SESSION['id']);

if($_GET['retour_eval']==1)
	{
		$impression = new epce_impression($_GET['choix'],$_SESSION['id']);
		$impression->email_siege='drenault@apsie.org';
$impression->imprimer_totalite_plan($_GET['choix'],$_SESSION['id']);
$impression->imprimer_totalite_evenement($_GET['choix'],$_SESSION['id']);
	}
	
	if(isset($_GET['display_eval']))
	{
	
	$display_eval = $_GET['display_eval'];
	$display_presentation = 'none';
	}
	else
	{
	$display_eval = 'none';
	$display_presentation = 'block';
	}
	
	if(isset($_GET['lc']))
				   {
					  $_SESSION['lc']=$_GET['lc'];
					 }
					
				
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<title>APSIE : PANEL </title>


<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../js/eval.js"></script>
	<script language="javascript">
	
	function lookup_emploi(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_emploi').hide();
		} else {
			$.post("ajax_emploi.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_emploi').show();
					$('#autoSuggestionsList_emploi').html(data);
				}
			});
		}
	} // lookup
	
			function fill_emploi(thisValue,thisValue2,thisValue3) {
		
		$('#poste').val(thisValue);
		$('#code_rome').val(thisValue2);
		$('#categorie').val(thisValue3);
	
		
		setTimeout("$('#suggestions_emploi').hide();", 200);
	}
	
			function lookup_org(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_organisation').hide();
		} else {
			$.post("ajax_organisation.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_organisation').show();
					$('#autoSuggestionsList_organisation').html(data);
				}
			});
		}
	} // lookup
	
			function fill_org(thisValue,thisValue2) {
		
		$('#organisation').val(thisValue);
		$('#id_organisation').val(thisValue2);
	
		
		setTimeout("$('#suggestions_organisation').hide();", 200);
	}
	

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
	
			function fill_safir(thisValue) {
		$('#code_safir').val(thisValue);
	
		
		setTimeout("$('#suggestions_safir').hide();", 200);
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
	
	function lookup2(adr_one_postalcode) {
		if(adr_one_postalcode.length == 0) {
			// Hide the suggestion box.
			$('#suggestions2').hide();
		} else {
			$.post("rpc_.php", {queryString: ""+adr_one_postalcode+""}, function(data){
				if(data.length >0) {
					$('#suggestions2').show();
					$('#autoSuggestionsList2').html(data);
				}
			});
		}
	} // lookup
	
	
	function lookup3(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions3').hide();
		} else {
			$.post("ajax_ville.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions3').show();
					$('#autoSuggestionsList3').html(data);
				}
			});
		}
	} // lookup
	function fill(thisValue,thisValue2,thisValue3,thisValue4) {
		$('#inputString').val(thisValue);
		$('#ville').val(thisValue2);
		$('#region').val(thisValue3);
		$('#pays').val(thisValue4);
		
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	function fill2(thisValue,thisValue2,thisValue3,thisValue4) {
		$('#adr_one_postalcode').val(thisValue);
		$('#adr_one_locality').val(thisValue2);
		$('#adr_one_region').val(thisValue3);
		$('#adr_one_countryname').val(thisValue4);
		
		setTimeout("$('#suggestions2').hide();", 200);
	}
	
	function fill3(thisValue) {
		$('#lieu_naissance').val(thisValue);
		
		
		setTimeout("$('#suggestions3').hide();", 200);
	}
	function fill_rome(thisValue,thisValue2) {
		$('#rome').val(thisValue);
		$('#r_emploi').val(thisValue2);
		<!--$('#r_emploi').val(thisValue2);-->
		
		setTimeout("$('#suggestions_rome').hide();", 200);
	}
	
	
		function lookup_organisme_employeur(inputString,cod_org,champ) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_organisme_employeur').hide();
		} else {
			$.post("ajax_organisme_forma.php", {queryString: ""+inputString+"",categorie_org: ""+cod_org+"",champ: ""+champ+""}, function(data){
				if(data.length >0) {
					$('#suggestions_organisme_employeur').show();
					$('#autoSuggestionsList_organisme_employeur').html(data);
				}
			});
		}
	} // lookup
	
			function fill_organisme_employeur(thisValue) {
		
		$('#org_employeur').val(thisValue);
		
	
		
		setTimeout("$('#suggestions_organisme_employeur').hide();", 200);
	}
	
		function lookup_organisme_forma(inputString,cod_org,champ) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_organisme_forma').hide();
		} else {
			$.post("ajax_organisme_forma.php", {queryString: ""+inputString+"",categorie_org: ""+cod_org+"",champ: ""+champ+""}, function(data){
				if(data.length >0) {
					$('#suggestions_organisme_forma').show();
					$('#autoSuggestionsList_organisme_forma').html(data);
				}
			});
		}
	} // lookup
	
			function fill_organisme_forma(thisValue) {
		
		$('#org_form').val(thisValue);
		
	
		
		setTimeout("$('#suggestions_organisme_forma').hide();", 200);
	}
	
	
	function lookup_organisme_forma_cert(inputString,cod_org,champ) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_organisme_forma_cert').hide();
		} else {
			$.post("ajax_organisme_forma.php", {queryString: ""+inputString+"",categorie_org: ""+cod_org+"",champ: ""+champ+""}, function(data){
				if(data.length >0) {
					$('#suggestions_organisme_forma_cert').show();
					$('#autoSuggestionsList_organisme_forma_cert').html(data);
				}
			});
		}
	} // lookup
	
			function fill_organisme_forma_cert(thisValue) {
		
		$('#org_cert').val(thisValue);
		
	
		
		setTimeout("$('#suggestions_organisme_forma_cert').hide();", 200);
	}
	
		
	function lookup_cp_formation(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_cp_formation').hide();
		} else {
			$.post("ajax_cp_formation.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_cp_formation').show();
					$('#autoSuggestionsList_cp_formation').html(data);
				}
			});
		}
	} // lookup
	
			function fill_cp_formation(thisValue,thisValue2,thisValue3,thisValue4) {
		
		$('#cp_formation').val(thisValue);
		$('#ville_formation').val(thisValue2);
		$('#region_formation').val(thisValue3);
		$('#pays_formation').val(thisValue4);
		
	
		
		setTimeout("$('#suggestions_cp_formation').hide();", 200);
	}
	
		function lookup_cp_org_ben(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_cp_formation').hide();
		} else {
			$.post("ajax_cp_org_ben.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_cp_org_ben').show();
					$('#autoSuggestionsList_cp_org_ben').html(data);
				}
			});
		}
	} // lookup
	
			function fill_cp_org_ben(thisValue,thisValue2,thisValue3,thisValue4) {
		
		$('#cp_org_ben').val(thisValue);
		$('#ville_org_ben').val(thisValue2);
		$('#region_org_ben').val(thisValue3);
		$('#pays_org_ben').val(thisValue4);
		
	
		
		setTimeout("$('#suggestions_cp_org_ben').hide();", 200);
	}
	
	
		function voirdiv2(nomdiv)
		{
			
		
				document.getElementById(nomdiv).style.display='none';
			
		
		}
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
		
			function voirdivbilan()
		{
			
			if(document.getElementById('bilan').style.display=='none')
			{
				
			document.getElementById('bilan').style.display='block';
			document.getElementById('evaluation').style.display='none';
			document.getElementById('presentation').style.display='none';
			document.getElementById('impression').style.display='none';
			}
			else
			{
			document.getElementById('bilan').style.display='none';
			}
		}
		
			function voirdivevaluation()
		{
			
			if(document.getElementById('evaluation').style.display=='none')
			{
			document.getElementById('evaluation').style.display='block';
			document.getElementById('presentation').style.display='none';
			document.getElementById('bilan').style.display='none';
			document.getElementById('impression').style.display='none';
			}
			else
			{
			document.getElementById('evaluation').style.display='none';
			}
		}
			function voirdivimp()
		{
			
			if(document.getElementById('impression').style.display=='none')
			{
			document.getElementById('impression').style.display='block';
			document.getElementById('presentation').style.display='none';
			document.getElementById('evaluation').style.display='none';
			document.getElementById('bilan').style.display='none';
			}
			else
			{
			document.getElementById('impressionn').style.display='none';
			}
		}
		
			function voirdivpresentation()
		{
			
			if(document.getElementById('presentation').style.display=='none')
			{
			document.getElementById('presentation').style.display='block';
			document.getElementById('evaluation').style.display='none';
			document.getElementById('bilan').style.display='none';
			document.getElementById('impression').style.display='none';
			}
			else
			{
			document.getElementById('presentation').style.display='none';
			}
		}
		function voirplan_eval()
		{
			
			if(document.getElementById('plan').style.display=='none')
			{
			document.getElementById('plan').style.display='block';
			document.getElementById('financier').style.display='none';
			document.getElementById('coherence_hp').style.display='none';
			document.getElementById('commerciaux').style.display='none';
			document.getElementById('juridique').style.display='none';
			document.getElementById('reglementaire').style.display='none';
			}
			else 
			{
				document.getElementById('plan').style.display='none';
			}
			
		}
		function voircoherence_hp()
		{
			
			if(document.getElementById('coherence_hp').style.display=='none')
			{
			document.getElementById('coherence_hp').style.display='block';
			document.getElementById('commerciaux').style.display='none';
			document.getElementById('financier').style.display='none';
			document.getElementById('juridique').style.display='none';
			document.getElementById('plan').style.display='none';
			document.getElementById('reglementaire').style.display='none';
			}
			else 
			{
				document.getElementById('coherence_hp').style.display='none';
			}
		
		}
		function voirfinancier()
		{
			
			if(document.getElementById('financier').style.display=='none')
			{
			document.getElementById('financier').style.display='block';
			document.getElementById('coherence_hp').style.display='none';
			document.getElementById('commerciaux').style.display='none';
			document.getElementById('juridique').style.display='none';
			document.getElementById('reglementaire').style.display='none';
			document.getElementById('plan').style.display='none';
			}
			else 
			{
				document.getElementById('financier').style.display='none';
			}
		
		}
		function voircommerciaux()
		{
			
			if(document.getElementById('commerciaux').style.display=='none')
			{
			document.getElementById('commerciaux').style.display='block';
			document.getElementById('coherence_hp').style.display='none';
			document.getElementById('financier').style.display='none';
			document.getElementById('juridique').style.display='none';
			document.getElementById('plan').style.display='none';
			document.getElementById('reglementaire').style.display='none';
			}
			else 
			{
				document.getElementById('commerciaux').style.display='none';
			}
		
		}
		
		function voirjuridique()
		{
			
			if(document.getElementById('juridique').style.display=='none')
			{
			document.getElementById('juridique').style.display='block';
			document.getElementById('coherence_hp').style.display='none';
			document.getElementById('financier').style.display='none';
			document.getElementById('commerciaux').style.display='none';
			document.getElementById('reglementaire').style.display='none';
			document.getElementById('plan').style.display='none';
			}
			else 
			{
				document.getElementById('juridique').style.display='none';
			}
		
		}
		
		function voirreglementaire()
		{
			
			if(document.getElementById('reglementaire').style.display=='none')
			{
			document.getElementById('reglementaire').style.display='block';
			document.getElementById('coherence_hp').style.display='none';
			document.getElementById('financier').style.display='none';
			document.getElementById('commerciaux').style.display='none';
			document.getElementById('juridique').style.display='none';
			document.getElementById('plan').style.display='none';
			}
			else 
			{
				document.getElementById('reglementaire').style.display='none';
			}
		
		}
        
        function showphones(form) 
		{
			set_style_by_class("table","editphones","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		function showphones2(form) 
		{
			set_style_by_class("table","editphones2","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		function showphones3(form) 
		{
			set_style_by_class("table","editphones3","display","inline");
			if (form) {
				copyvalues(form,"tel_home","tel_home2");
				copyvalues(form,"tel_work","tel_work2");
				copyvalues(form,"tel_cell","tel_cell2");
			}
		}
		
		function hidephones(form) 
		{
			set_style_by_class("table","editphones","display","none");
			if (form) {
				copyvalues(form,"tel_home2","tel_home");
				copyvalues(form,"tel_work2","tel_work");
				copyvalues(form,"tel_cell2","tel_cell");
			}
		}
		
		function copyvalues(form,src,dst){
			var srcelement = getElement(form,src);  //ById("exec["+src+"]");
			var dstelement = getElement(form,dst);  //ById("exec["+dst+"]");
			if (srcelement && dstelement) {
				dstelement.value = srcelement.value;
			}
		}
		
		function getElement(form,pattern){
			for (i = 0; i < form.length; i++){
				if(form.elements[i].name){
					var found = form.elements[i].name.search(pattern);
					if (found != -1){
						return form.elements[i];
					}
				}
			}
		}
		
		function voir_defaut(this_value)
		{
			if(document.getElementById(this_value).value!=null)
			{
		 document.getElementById(this_value).style.display='block';
			}
		}
		
		function voir_select(this_value)
		{
		 document.getElementById(this_value).style.display='block';
		}
		function mail()
	{
		window.document.forms["form"].email_bureau_p.value=window.document.forms["form"].prenom_p.value.toLowerCase()+'.'+window.document.forms["form"].nom_p.value.toLowerCase()+'@pole-emploi.fr';
	
	}
	
 function afficherAutre(c1,c2)
 {

if(document.getElementById(c1).value=='Autre')
{

document.getElementById(c2).style.display='block';
document.getElementById(c1).style.display='none';
document.getElementById(c2).name=c1;
document.getElementById(c1).name=c2;
}

}

function verif_champ(c)
{
if(document.getElementById(c).value!=null)
{
document.getElementById(c).style.display='block';
}
}


function verifFormemploi()
{ 
	 if (document.getElementById('poste_ben').value == "" )
  {
    	alert('Champ "Poste du bénéficiaire" non rempli !');
		return false;	
  }
	 if (document.getElementById('poste').value == "" )
  {
    	alert('Champ "Intitulé du poste" non rempli !');
		return false;	
  }
	
  
   if (document.getElementById('code_rome').value == "" )
  {
    	alert('Champ "Code rome" non rempli !');
		return false;	
  }
	
  
   if (document.getElementById('categorie').value == "" )
  {
    	alert('Champ "Catégorie" non rempli !');
		return false;	
  }
   if (document.getElementById('remuneration').value == "" )
  {
    	alert('Champ "Rémunération" non rempli !');
		return false;	
  }
	  if (document.getElementById('service').value == "" )
  {
    	alert('Champ "Service" non rempli !');
		return false;	
  }
    if (document.getElementById('emploi_debut').value == "" )
  {
    	alert('Champ "Date de début" non rempli !');
		return false;	
  }
  
    if (document.getElementById('contrat').value == "" )
  {
    	alert('Champ "Contrat" non rempli !');
		return false;	
  }
    if (document.getElementById('contrat_aide').value == "" )
  {
    	alert('Champ "Contrat aidé" non rempli !');
		return false;	
  }
    if (document.getElementById('qualification').value == "" )
  {
    	alert('Champ "Qualification" non rempli !');
		return false;	
  }
    if (document.getElementById('temps_travail').value == "" )
  {
    	alert('Champ "Temps de travail" non rempli !');
		return false;	
  }
    if (document.getElementById('deplacement').value == "" )
  {
    	alert('Champ "Déplacement" non rempli !');
		return false;	
  }
    if (document.getElementById('organisation').value == "" )
  {
    	alert('Champ "Organisation" non rempli !');
		return false;	
  }
  else {return true;}
} 

function verifstatut()
 {

if(document.getElementById('statut_parcours').value==391 ||  document.getElementById('statut_parcours').value=="Stagiaire en entreprise" ||  document.getElementById('statut_parcours').value=="Salarie" || document.getElementById('statut_parcours').value==518)
{

document.getElementById('div_poste').style.display='block';
document.getElementById('poste_ben').style.display='block';
document.getElementById('div_intitule_rome').style.display='block';
document.getElementById('poste').style.display='block';
document.getElementById('div_remuneration').style.display='block';
document.getElementById('div_organisation').innerHTML='Organisation';

document.getElementById('div_remuneration2').style.display='block';
document.getElementById('div_identifiant').style.display='none';
document.getElementById('identifiant').style.display='none';
document.getElementById('div_service').style.display='block';
document.getElementById('service').style.display='block';
document.getElementById('div_contrat').style.display='block';
document.getElementById('contrat').style.display='block';
document.getElementById('div_contrat_aide').style.display='block';
document.getElementById('contrat_aide').style.display='block';
document.getElementById('div_service').style.display='block';
document.getElementById('service').style.display='block';
document.getElementById('div_qualification').style.display='block';
document.getElementById('qualification').style.display='block';
document.getElementById('div_deplacement').style.display='block';
document.getElementById('deplacement').style.display='block';
document.getElementById('div_temps_travail').style.display='block';
document.getElementById('temps_travail').style.display='block';
document.getElementById('div_organisation').style.display='block';
document.getElementById('org_employeur').style.display='block';

}
else
{
document.getElementById('div_identifiant').style.display='block';
document.getElementById('identifiant').style.display='block';
document.getElementById('div_remuneration').style.display='block';
document.getElementById('div_remuneration2').style.display='block';
document.getElementById('div_poste').style.display='block';
document.getElementById('div_organisation').style.display='block';
document.getElementById('poste_ben').style.display='block';
document.getElementById('org_employeur').style.display='block';
document.getElementById('div_intitule_rome').style.display='block';
document.getElementById('poste').style.display='block';


document.getElementById('div_service').style.display='none';
document.getElementById('service').style.display='none';
document.getElementById('div_contrat').style.display='none';
document.getElementById('contrat').style.display='none';
document.getElementById('div_contrat_aide').style.display='none';
document.getElementById('contrat_aide').style.display='none';
document.getElementById('div_service').style.display='none';
document.getElementById('service').style.display='none';
document.getElementById('div_qualification').style.display='none';
document.getElementById('qualification').style.display='none';
document.getElementById('div_deplacement').style.display='none';
document.getElementById('deplacement').style.display='none';
document.getElementById('div_temps_travail').style.display='none';
document.getElementById('temps_travail').style.display='none';
document.getElementById('div_organisation').innerHTML='Agence Pole emploi';
document.getElementById('div_poste').innerHTML='Poste recherché';

}

}


        </script>
       <style> 
       .rouge {
	color: #F00;
}
.vert {
	color: #0C0;
}	
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
		background-color: #06C;
	}
.pourcent {
	font-size: 16px;
	color: #F00;
}
-->
       </style>
</head>

     <body onload="verifstatut();">
<?php 
if(isset($_GET['erreur']) and $_GET['erreur']=="beneficiaire")
{
echo"<script>alert('Veuillez renseigner le nom et le prénom du bénéficiaire');</script>";

}


if(isset($_GET['mot']))
{
	$mot = $_GET['mot'];
	}
	else
	{
	$mot = NULL;
	}
	if(isset($_GET['valid']))
	{
	$valid = $_GET['valid'];
	}
	else
	{
	$valid=NULL;
	}
	if(isset($_GET['choix']))
	{
	$choix = $_GET['choix'];
	}
	else
	{
	$choix=NULL;
	}
	
	if(isset($_GET['domain']))
	{
	$domain = $_GET['domain'];
	}
	if(isset($_GET['id_p']))
	{
	$id_p = $_GET['id_p'];
	}
	else
	{
	$id_p =NULL;
	}

if(isset($_GET['annee']))
	{
		$annee=$_GET['annee'];
	$epce = new epce($_GET['annee']);

	}
	else
	{
		$annee=date('y');
	$epce = new epce(date('y'));
	}

	if($choix!=NULL)
	{

	$retour=$epce->variable_beneficiaire($choix);
	$etat_civil=$epce->return_etat_civil($choix);

	$rapport->action('consulte le dossier EPCE de '.$retour[0].'');
	}

 if($id_p!=NULL and $choix!=NULL)
	{
	$epce->ajout_prescripteur($choix,$id_p);
	
	}
	
	if($valid==1)
	{
		$value='Afficher les donnees';	
	}
	else
	{
		$value='Rechercher' ;
	}
	if(isset($_GET['id_rdv']))
	{
	
	$epce->rdv_change_statut($_GET['id_rdv'],$_GET['cal_status'],$_GET['id_presta']);
	
	
	}
		if(isset($_GET['lier']))
				   {
					 $epce->rdv_lier_presta($_GET['id_presta'],$_GET['id_rdv'],$_GET['cal_status']);
				
					 }
					 
		if(isset($_GET['id_rdv_unlink']))
				   {
					 $epce->rdv_unlink($_GET['id_rdv_unlink']);
				
					 }
					 
					 if(isset($_GET['MAJ_ID_BEN']))
	{
	
	$epce->maj_id_ben_parcours_pro();
	
	
	}
if($_SESSION['type_presta']=="NACRE1")
{

$epce->table_validation = "egw_nacre_validation";
}

?>	
<form   name="form_b" id="form_b" action="panel.php" method="get"><table style="border:1px solid  #999" bgcolor="#F0F0F0" width="100%">
  <tr>
		<td width="832" height="38" align="center">
		<input type="hidden"  name="domain" value="default"/><input type="hidden"  name="valid" value="1"/><input type="hidden"  name="page" value="presentation"/><input type="hidden"  name="annee" value="<?php echo $annee; ?>"/>
		Selectionner un  bénéficiaire
		
		<?php  
	if($valid==1)
	{
		$epce->chercher_beneficiaire($mot);
		
		
	}
	else
	{
	echo'<input name="mot" type="text" />';
	 
	
	}
	
	
	?>		<input  type="submit" value="<?php echo $value;?>"/><?php 
	if($valid==1)
	{
	echo' | <img border="0" src="../images/search_16.png" /> <a href="panel.php">Nouvelle recherche</a>';
	}?>  | <img border="0" src="../images/plus_16.png" /> <?php echo'<a href="nouveau_beneficiaire.php?annee='.$annee.'&option_ben=nouveau">Ajouter une prestation</a>';?></td>
	
	</tr></table>
	
</form>
<p><br/>
  <br/><br/><?php 
	if($choix!=NULL)
	{
		if($retour[22]!=NULL)
		{
			$tel=' - '.$retour[22];
		}
		elseif($retour[16]!=NULL)
		{
		$tel=' - '.$retour[16];
		}
		if($retour[24]!=NULL)
		{
			$mail=' - '.$retour[24];
		}
		?> <a name="eval" id="eval"></a><img src="../images/user_32.png" /> <a style="color:#8A0000; font-weight:bolder ; font-size:24px" href="javascript:voirdivpresentation()"><?php echo $retour[0].' '.$tel.$mail;?></a> <br/><br/>
 <?php
		
		echo'<div style="display:'.$display_presentation.'" id="presentation">';
	



	include_once("mod_beneficiaire.php");
	
	echo'<hr style="border:3px solid #CCC"	 />';
		
		$id_projet_return=$epce->return_nom_projet($choix);
		
		
		echo'<a name="ancre_org_ben"/></a><br/>';
		
		
		echo'</div>';
		
		
		?>
<br/> 
 
<?php
 if(isset($_GET['id_presta']))
			   {

			 
  $color=$epce->voir_validation($_GET['id_presta'],$choix);
    }
 if($color[0]==1)
 {
	$couleur='#CCC';
	echo"<script>document.getElementById(\'valider_plan\').style.visibility='hidden';</script>";
	
 }

   else if(isset($color[0]) and $color[0]==NULL)
 {
	$couleur='#000';
 }
 else
 {
	 $couleur='#FC6';
 }
 
  if($color[1]==1)
 {
	$couleur2='#CCC';

	
 }
   else if(isset($color[1]) and $color[1]==NULL)
 {
	$couleur2='#000';
 }
 else if($color[1]==0)
 {
	$couleur2='#6C3';
 }

 
  if($color[2]==1)
 {
	$couleur3='#CCC';

	
 }
  else if(isset($color[2]) and $color[2]==NULL)
 {
	$couleur3='#000';
 }
 else if($color[2]==0)
 {
	$couleur3='#59B1F9';
 }
   if($color[3]==1)
 {
	$couleur4='#CCC';

	
 }
 else if(isset($color[3]) and $color[3]==NULL)
 {
	$couleur4='#000';
 }
 
 else if($color[3]==0)
 {
	$couleur4='#FC0';
 }
   if($color[4]==1)
 {
	$couleur5='#CCC';

	
 }
  else if(isset($color[4]) and $color[4]==NULL)
 {
	$couleur5='#000';
 }
 else if($color[4]==0)
 {
	$couleur5='#F00';
 }
   if($color[5]==1)
 {
	$couleur6='#CCC';

	
 }
 else if(isset($color[5]) and $color[5]==NULL)
 {
	$couleur6='#000';
 }
 else if($color[5]==0)
 {
	$couleur6='#F60';
 }
 
 
		echo'<div style="display:'.$display_eval.'" id="evaluation"> <img src="../images/search_32.png" /> <strong><font size="+2">'.$_SESSION['type_presta'].' : '.$_SESSION['lc'].'</font></strong> <br/><br/>';
		//include_once("../evaluation/ajout_eval.php");
		if($_GET['id_presta']!=NULL)
		{
		$epce->afficher_prescripteurs($choix,$_GET['id_presta']);
		$epce->selectionner_rdv($_GET['id_presta'],$choix,$_SESSION['id']);
		$epce->selectionner_rdv_grise($_GET['id_presta'],$choix);
		}
		?>
       
       <?php if($_SESSION['type_presta']=="NACRE1")
	   {
		  

		   include('../../nacre1/nacre1.php');
		  }
		  elseif($_SESSION['type_presta']=="NACRE3")
	   {
		  
		  include('../../nacre3/nacre3.php');
		  }
		  elseif($_SESSION['type_presta']=="EPCE")
		  {
			 
	  ?>
	 <center><table><tr class="pourcent">
	      <td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr><tr align="center"><td><input type="button" id="leplan" name="leplan" onmouseover="survoler('leplan');" onclick="window.location.href='../evaluation/plan.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" style="width:120px; height:80px; background-color:<?php echo $couleur;  ?> ; font-size:12px; color:#FFF" value="Plan d'évaluation" /></td><td><input onclick="window.location.href='../evaluation/coherence.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color:<?php echo $couleur2;  ?>; font-size:12px; color:#FFF" value="Cohérence H/P" /></td><td> <input onclick="window.location.href='../evaluation/commerciaux.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color:<?php echo $couleur3;  ?> ; font-size:12px; color:#FFF" value="Aspect commerciaux" /></td><td> <input onclick="window.location.href='../evaluation/financier.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'"  type="button" style="width:120px; height:80px; background-color:<?php echo $couleur4;  ?> ; font-size:12px; color:#FFF" value="Aspect financier" /> </td><td><input onclick="window.location.href='../evaluation/juridique.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'"  type="button" style="width:120px; height:80px; background-color:<?php echo $couleur5;  ?> ; font-size:12px; color:#FFF" value="Aspect juridique" /> </td><td><input onclick="window.location.href='../evaluation/bilan.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color: <?php echo $couleur6;  ?>; font-size:12px; color:#FFF" value="Bilan" /></td></tr><tr><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr></table> </center><br/><hr style="border:1px dashed #CCC" />
		<?php echo'<center>';include_once("../impression/impression.php");echo'</center>';
		  echo'</div>';
		  }
		?>

   
  <?php
	
		//include_once("../evaluation/bilan.php");
		
		
	
		
		?>
        
  <?php
	
		
		
	
	}
	if(isset($_GET['alert']) and $_GET['alert']=="existe")
	{
		echo"<script>alert('Le beneficiaire existe déja.La prestation LC : ".$_GET['lc']." est créée');</script>";
	}
	
	if(isset($_GET['mail_plan']))
	{
	
	echo'<script>alert("Votre plan d\'évaluation a été envoyé à '.$_GET['mail_plan'].'");</script>';
	}
	if(isset($_GET['mail_evenement']))
	{
	
	echo'<script>alert("Votre fiche d\'évènement a été envoyé à '.$_GET['mail_evenement'].'");</script>';
	}
	if(isset($_GET['mail_bilan']))
	{
	
	echo'<script>alert("Votre bilan a été envoyé à '.$_GET['mail_bilan'].'");</script>';
	}
	?> 
</p> 
<p align="center"><input style="color:#000; border:1px solid #333; font-size:24px" type="button"  onclick="window.close();" value="FERMER LE DOSSIER" /></p>

<?php if(isset($_GET['id_relance']))
{
	$display_relance="block";
	$relance_det=$epce->relance_details($_GET['id_relance']);
}
else
{
	$display_relance="none";
	
	}

?>
<div id="relance_details" style="position:absolute; display:<?php echo $display_relance?>; border:1px solid #000; background-color:#EEE; left: 148px; top: 616px; width: 389px; height: 245px;"><table width="385" height="164"><tr>
<td width="113"><strong>ID_relance</strong></td>
<td style="color:#F00" width="260"><?php echo $relance_det[0]; ?></td></tr><tr>
<td width="113"><strong>Type</strong></td>
<td width="260"><?php echo $relance_det[4]; ?></td></tr><tr>
<td width="113"><strong>Date de la relance</strong></td>
<td width="260"><?php echo date("d/m/Y | H:i",$relance_det[3]); ?></td></tr><tr>
  <td><strong>Motif</strong></td><td><?php echo $relance_det[5]; ?></td></tr><tr>
  <td><strong>Résultat</strong></td>
  <td><?php echo $relance_det[6]; ?></td></tr><tr><td width="113"><strong>Commentaire 1</strong></td>
<td width="260"><?php echo $relance_det[1]; ?></td></tr><tr><td width="113"><strong>Prochain contact</strong></td>
<td width="260"><?php echo $relance_det[8]; ?></td></tr><tr><td width="113"><strong>Le</strong></td>
<td width="260"><?php echo date("dmy",$relance_det[7]); ?></td></tr><tr><td><strong>Commentaire 2</strong></td><td><?php echo $relance_det[2]; ?></td></tr><tr>
  <td width="113" height="26">&nbsp;</td>
<td width="260"><input type="button" onclick="document.getElementById('relance_details').style.display='none';" value="Fermer"  /></td></tr></table></div>


<div style="border-top:1px solid #CCC; font-weight:bolder ; padding-top:15px;" align="center">© APSIE 2010</div>
</body></html>
<?php
if(isset($_GET['presta']))
{
echo"<script>document.getElementById('presta_form').style.display='block';</script>";
}
if(isset($_POST['lc']) and isset($_POST['id_presta']))
{
$epce->update_presta($_POST['id_presta'],$_POST['lc'],$_POST['conseiller_id'],$_POST['date_debut'],$_POST['date_fin']);
echo'<script>window.location.href="panel.php?choix='.$_POST['id_ben'].'#presta";</script>';

}


?>