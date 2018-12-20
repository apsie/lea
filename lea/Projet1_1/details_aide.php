<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => 'Projet1_1',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.projet.inc.php");
	
	
$projet = new projet();
$valeur=$projet->return_financement($_GET['id_resacc_fi']);




?>
<html><head><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script> <style type="text/css">
<!--
a:hover span
{
  display: block;
}
a span{
	display: none;
  position: absolute;
  left: 120ex;
  top:130px;
  
  background-color: #ffd;
  font-size: 11px;
  text-decoration: none;
  width: 300px;
  padding: 3px;
  border: 1px outset gray;
  z-index: 5;
  -moz-border-radius: 5px;
  border-radius: 5px;
  }

	.suggestionsBox {
		position:absolute;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: #E0DB0C;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
		font-size:9px;
		
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
		background-color: #E0DB0C;
	}

-->
</style><script type="text/javascript" src="jquery-1.2.1.pack.js"></script>

<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("liste_aide_org.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#organisation').val(thisValue);
		
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	function lookup_contact_nom(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions_contact_nom').hide();
		} else {
			$.post("liste_aide_contact.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_contact_nom').show();
					$('#autoSuggestionsList_contact_nom').html(data);
				}
			});
		}
	} // lookup
	
	function fill_contact_nom(thisValue,thisValue2) {
		$('#contact_nom').val(thisValue);
		$('#contact_prenom').val(thisValue2);
		
		setTimeout("$('#suggestions_contact_nom').hide();", 200);
	}
    
    </script>
    
        </head><body><?php if(isset($_GET['id_resacc_aide_crea_delete']))
{
	$projet->delete_aide_crea($_GET['id_resacc_aide_crea_delete']);
	
	echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
	echo'<script>window.close();</script>';
} ?>
<center>
  <h2>Liste des aides financieres</h2></center><center><table style=" border:1px solid #CCC"><tr style="font-weight:bold;  background-color: #999; color:#FFF" ><td >Nom de l'aide</td><td>Nature</td><td>Type</td><td>Montant demande</td><td>Date de la demande</td><td>Date de la reponse</td><td>Reponse</td><td>Montant obtenu</td>
  <td>Decision du beneficiaire</td>
  <td>Organisme financier</td><td>Contact</td><td></td></tr><?php echo $projet->voir_aide_financiere($_GET['id_resacc_fi']); ?></table><br/><input onClick="window.parent.opener.location.href='details.php?domain=default&id_projet=<?php echo $_GET['id_projet'];?>&onglet=financement';window.close();" type="button" value="Fermer et actualiser" /></center>
  
        </body></html>