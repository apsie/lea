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
$valeur=$projet->return_aide_crea($_GET['id_resacc_aide_creation']);


if($valeur[19]==0)
{
$valeur[19]=NULL;
}
else
{
$valeur[19]=date('d/m/Y',$valeur[19]);
}

if($valeur[4]==0)
{
$valeur[4]=NULL;
}
else
{
$valeur[4]=date('d/m/Y',$valeur[4]);
}
if($valeur[5]==0)
{
$valeur[5]=NULL;
}
else
{
$valeur[5]=date('d/m/Y',$valeur[5]);
}

?>
<html><head><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script> <style type="text/css">
<!--


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
.suggestionsBox1 {
		position:absolute;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 300px;
		background-color: #E0DB0C;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
		font-size:9px;
		
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
	
	function fill(thisValue,thisValue2) {
		$('#organisation').val(thisValue);
		$('#id_organisation').val(thisValue2);
		
		setTimeout("$('#suggestions').hide();", 200);
	}
	
	function lookup_contact_nom(inputString,id_organisation) {
		if(inputString.length == 0 || id_organisation==0 ) {
		$('#suggestions_contact_nom').show();
					$('#autoSuggestionsList_contact_nom').html(data);
		} else {
			$.post("liste_aide_contact.php", {queryString: ""+inputString+"",id_organisation: ""+id_organisation+""}, function(data){
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
	
	function choix_contact(organisation)
	{
		if(organisation!=null)
		{
			document.getElementById('contact_nom').style.visibility='visible';
			document.getElementById('contact_prenom').style.visibility='visible';
		}
	}
    
    </script>
    
        </head><body>
<center>
  <h2>Modifier une aide financi&egrave;re</h2></center><center><br/><form method="get"><input type="hidden" name="domain" value="default" /><br/><table style="border:1px solid #999"><tr bgcolor="#ECF3F4">
    <td width="215">Nom de l'aide</td>
    <td width="201"><input name="nom_aide" type="text" value="<?php echo $valeur[0];?>" /></td>
    <td width="169" >Type Amt</td>
    <td width="105" ><input type="hidden" value="<?php echo $valeur[5];?>" name="type_amt" />
      <?php echo $valeur[22];?></td>
    </tr><tr  bgcolor="#FFFFFF">
    <td>Nature d'aide</td>
    <td><select name="nature"><option value="<?php echo $valeur[1];?>"><?php echo $valeur[1];?></option><?php $projet->texte('nature_aide','','egw_texte_financement');?></select></td>
    <td width="169">Dur&eacute;e Amt</td>
    <td width="105" ><input type="hidden" value="<?php echo $valeur[6];?>" name="duree_amt" />
      <?php echo $valeur[23];?> mois</td>
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Type d'aide</td>
    <td><select name="type"><option value="<?php echo $valeur[2];?>"><?php echo $valeur[2];?></option><?php $projet->texte('type_aide','','egw_texte_financement');?></select></td>
    <td width="169" >Taux Amt</td>
    <td width="105"><input type="hidden" value="<?php echo $valeur[7];?>" name="tx_amt" />
      <?php echo $valeur[24];?> %</td>
    </tr>
    <tr  bgcolor="#FFFFFF">
    <td>Montant demande</td>
    <td><?php echo $valeur[3];?>
  <input  name="montant_demande" size="6" type="hidden"  value="<?php echo $valeur[3];?>"/> €</td>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Date de la demande</td>
    <td>
  <input id="date_deb" name="date_deb" size="10"  value="<?php echo $valeur[4];?>" type="text" /> <script type="text/javascript">

	document.writeln('<img id="date_deb_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_deb",
		button      : "date_deb_trigger"
	}
	);
</script></td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF">
    <td>Initiative de la demande</td>
    <td><select name="initiative"><option value="<?php echo $valeur[16];?>"><?php echo $valeur[16];?></option><option>Le conseiller</option><option>Le bénéficiaire</option></select></td>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Mode de transmission</td>
    <td><select name="mode"><option value="<?php echo $valeur[17];?>"><?php echo $valeur[17];?></option><option>Courrier</option><option>Mail</option><option >Remise en main propre</option><option>Site internet</option></select></td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF">
    <td>Date de la reponse</td>
    <td><input name="date_fin" id="date_fin" value="<?php echo $valeur[5];?>" size="10" type="text" /> <script type="text/javascript">

	document.writeln('<img id="date_fin_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin",
		button      : "date_fin_trigger"
	}
	);
</script></td>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Decision de la banque</td>
    <td><select name="reponse"><option value="<?php echo $valeur[6];?>"><?php echo $valeur[6];?></option><option>Demande non effectuée</option><option >Accord</option><option>Ajournement</option><option>Inéligible</option><option>Refus</option><option>Instruction en cours</option></select></td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF"><td>Motif si refus ou ajournement</td><th align="left" colspan="3"><textarea cols="50" name="motif_banque" style="border:1px solid #CCC; font-size:11px; color: #69C"><?php echo $valeur[8]; ?></textarea></th>
    
   
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Decision du beneficiaire</td>
    <td><select name="decision_ben"><option value="<?php echo $valeur[9];?>"><?php echo $valeur[9];?></option><option>En attente</option><option>Accepté</option><option >Décliné</option></select></td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF"><td>Motif du b&eacute;n&eacute;ficiaire si d&eacute;clin&eacute;</td><th align="left" colspan="3"><textarea cols="50" name="motif_ben" style="border:1px solid #CCC; font-size:11px; color:#69C"><?php echo $valeur[10];?></textarea></th>
      
    </tr>
    <tr bgcolor="#ECF3F4"><td>Montant obtenu</td>
    <td><input name="montant_obtenu" size="6" type="text"  value="<?php echo $valeur[11];?>" /> EUR</td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF"><td><img src="images/money_euro.png"> Organisme financier</td><td><input value="<?php echo $valeur[12];?>" size="30" onChange="javascript:this.value=this.value.toUpperCase();choix_contact(this.value);" name="organisation" id="organisation"  onblur="fill();" onKeyUp="lookup(this.value);" type="text" /><input type="hidden"  id="id_organisation" name="id_organisation"  value="<?php echo $valeur[13];?>"/><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div></div> </td>
      <td bgcolor="#FFFFFF"></td>
      <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr bgcolor="#ECF3F4">
      <td><img src="images/organisme_financement.png"> Contact financier</td><td>Nom <input   onBlur="fill_contact_nom();" value="<?php echo $valeur[14];?>" onKeyUp="lookup_contact_nom(this.value,document.getElementById('id_organisation').value);" id="contact_nom" name="contact_nom" size="12" type="text" /></td><td>Pr&eacute;nom
            <div class="suggestionsBox1" id="suggestions_contact_nom" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
              <div class="suggestionList" id="autoSuggestionsList_contact_nom"> &nbsp; </div>
            </div>          <input   id="contact_prenom"  value="<?php echo $valeur[15];?>" name="contact_prenom" size="12" type="text" /></td>
   
      <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF">
        <td>Frais de d&eacute;caissement</td>
    <td><input name="frais"  value="<?php echo $valeur[18];?>" size="6"  type="text" /> EUR</td>
    <td bgcolor="#FFFFFF"></td>
    <td bgcolor="#FFFFFF"></td>
    </tr>
    <tr bgcolor="#ECF3F4">
    <td>Date de d&eacute;caissement</td>
    <td>
  <input id="date_frais" name="date_frais" size="10" value="<?php echo $valeur[19];?>" type="text" /> <script type="text/javascript">

	document.writeln('<img id="date_frais_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_frais",
		button      : "date_frais_trigger"
	}
	);
</script></td>
    <td bgcolor="#ECF3F4"></td>
    <td bgcolor="#ECF3F4"></td>
    </tr>
    <tr  bgcolor="#FFFFFF">
          <td></td><td>
      </div><input type="hidden" value="<?php  echo $valeur[21];?>" name="id_resacc_fi" /><input type="hidden" value="<?php  echo $_GET['id_resacc_aide_creation'];?>" name="id_resacc_aide_creation" /><input type="hidden" value="<?php  echo $valeur[20];?>" name="id_projet" /><input type="submit" value="Modifier" name="modifier" /></td>
          <td bgcolor="#FFFFFF"></td>
          <td bgcolor="#FFFFFF"></td>
    </tr>
  </table></form></center>
   <?php
if(isset($_GET['modifier']))
{
	$val=$projet->modifier_aide($GLOBALS['egw_info']['user']['account_id'],$_GET['id_projet'],$_GET['id_resacc_fi'],$_GET['nom_aide'],$_GET['nature'],$_GET['type'],$_GET['montant_demande'],$_GET['date_deb'],$_GET['date_fin'],$_GET['reponse'],$_GET['montant_obtenu'],$_GET['organisation'],$_GET['contact_nom'],$_GET['contact_prenom'],$_GET['motif_banque'],$_GET['decision_ben'],$_GET['motif_ben'],$_GET['initiative'],$_GET['mode'],$_GET['frais'],$_GET['date_frais'],$_GET['id_resacc_aide_creation']);
	
	echo'<script>window.parent.opener.location.href="details_aide.php?domain=default&id_projet='.$_GET['id_projet'].'&id_resacc_fi='.$_GET['id_resacc_fi'].'"</script>';
	echo'<script>window.close();</script>';

}


echo $GLOBALS['egw']->common->egw_footer();
?>
        </body></html>