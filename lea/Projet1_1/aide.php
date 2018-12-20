<?php

$GLOBALS['egw_info'] = array(
        'flags' => array(
            'noheader'                => false,
            'nonavbar'                => true,
            'currentapp'              => 'Projet1_1',
            'enable_network_class'    => false,
            'enable_contacts_class'   => false,
            'enable_nextmatchs_class' => false
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
.suggestionsBox11 {		position:absolute;
        
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
            $('#suggestions').show();
                    $('#autoSuggestionsList').html(data);
        } else {
            $.post("liste_aide_org.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >=0) {
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
  <h2>Ajouter une aide financiere</h2></center><center><br/><form method="get"><input type="hidden" name="domain" value="default" /><br/><table style="border:1px solid #999"><tr bgcolor="#ECF3F4">
    <td width="267">Nom de l'aide</td>
    <td width="180"><input name="nom_aide" type="text" value="<?php echo $valeur[0];?>" /></td>
    <td width="242">Type Amt</td>
    <td width="87"><select name="type_amt"><option ><?php echo $valeur[5];?></option><option>Lineaire</option><option>Degressif</option></select></td></tr><tr bgcolor="#FFFFFF">
    <td>Nature d'aide</td>
    <td><select name="nature"><?php $projet->texte('nature_aide', '', 'egw_texte_financement');?></select></td>  <td width="242">Duree Amt</td>
    <td width="87"><input type="text" size="2" value="<?php echo $valeur[6];?>" name="duree_amt" />       mois</td></tr><tr bgcolor="#ECF3F4">
    <td>Type d'aide</td>
    <td><select name="type"><?php $projet->texte('type_aide', '', 'egw_texte_financement');?></select></td>  <td width="242">Taux Amt</td>
    <td width="87"><input size="2" type="text" value="<?php echo $valeur[7];?>" name="tx_amt" />       %</td></tr><tr bgcolor="#FFFFFF">
    <td>Montant demande</td>
    <td><input  name="montant_demande" size="6" type="text"  value="<?php echo $valeur[4];?>"/> euros</td><td></td><td></td></tr><tr bgcolor="#ECF3F4">
    <td>Date de la demande</td>
    <td>
  <input id="date_deb" name="date_deb" size="10" type="text" /> <script type="text/javascript">

    document.writeln('<img id="date_deb_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
    Calendar.setup(
    {
        inputField  : "date_deb",
        button      : "date_deb_trigger"
    }
    );
</script></td><td></td><td></td></tr><tr bgcolor="#FFFFFF">
    <td>Initiative de la demande</td>
    <td><select name="initiative"><option></option><option>Le conseiller</option><option>Le beneficiaire</option></select></td><td></td><td></td></tr><tr bgcolor="#ECF3F4">
    <td>Mode de transmission</td>
    <td><select name="mode"><option></option><option>Courrier</option><option>Mail</option><option >Remise en main propre</option><option>Site internet</option></select></td><td></td><td></td></tr><tr bgcolor="#FFFFFF">
    <td>Date de la reponse</td>
    <td><input name="date_fin" id="date_fin" size="10" type="text" /> <script type="text/javascript">

    document.writeln('<img id="date_fin_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
    Calendar.setup(
    {
        inputField  : "date_fin",
        button      : "date_fin_trigger"
    }
    );
    //mail , courrier ,depot ,remise en main propre, site internet
</script></td><td></td><td></td></tr><tr bgcolor="#ECF3F4">
    <td>Etat de la demande</td>
    <td><select name="reponse"><option>Demande non effectuee</option><option>Demande non effectuee</option><option >Accord</option><option>Ajournement</option><option>Ineligible</option><option>Refus</option><option>Instruction en cours</option></select></td><td></td><td></td></tr><tr bgcolor="#FFFFFF"><td>Motif si refus ou ajournement</td><th align="left" colspan="3"><textarea cols="50" name="motif_banque" style="border:1px solid #CCC; font-size:11px; color: #69C"></textarea></th></tr><tr bgcolor="#ECF3F4">
    <td>Decision du beneficiaire</td>
    <td><select name="decision_ben"><option>En attente</option><option>Accepte</option><option >Decline</option></select></td><td></td><td></td></tr><tr bgcolor="#FFFFFF"><td>Motif du beneficiaire si decline</td><th align="left" colspan="3"><textarea cols="50" name="motif_ben" style="border:1px solid #CCC; font-size:11px; color:#69C"></textarea></td></tr><tr bgcolor="#ECF3F4"><td>Montant obtenu</td>
    <td><input name="montant_obtenu" size="6" type="text"  value="" /> euros</td><td></td><td></td></tr><tr bgcolor="#FFFFFF"><td><img src="images/money_euro.png"> Organisme financier</td><td><input size="30" onChange="javascript:this.value=this.value.toUpperCase();choix_contact(this.value);" name="organisation" id="organisation"  onblur="fill();" onKeyUp="lookup(this.value);" type="text" /><input type="hidden" id="id_organisation" name="id_organisation" /><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
		<div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div></div> </td>
	<td>
		<!-- SPIREA -->
		<a onclick="window.open('/index.php?menuaction=spiclient.client_ui.edit','Ajouter un nouveau client','menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=950, height=600');" href="javascript::void();">
		<img src="../spiclient/templates/default/images/navbar.png" title="Ajouter un nouveau client" />
		</a>
	</td>
	<td></td></tr><tr bgcolor="#ECF3F4"><td><img src="images/organisme_financement.png"> Contact financier</td><td>Nom <input  style=" visibility:hidden"  onBlur="fill_contact_nom();" onKeyUp="lookup_contact_nom(this.value,document.getElementById('id_organisation').value);" id="contact_nom" name="contact_nom" size="12" type="text" /></td><td>Pr&eacute;nom
            <div class="suggestionsBox11" id="suggestions_contact_nom" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
              <div class="suggestionList" id="autoSuggestionsList_contact_nom"> &nbsp; </div>
            </div>          <input   id="contact_prenom" style=" visibility:hidden" name="contact_prenom" size="12" type="text" /></td><td></td></tr><tr bgcolor="#FFFFFF">
          <td>Frais de d&eacute;caissement</td>
    <td><input name="frais" size="6"  type="text" /> 
    &euro;</td><td></td><td></td></tr><tr bgcolor="#ECF3F4">
    <td>Date de d&eacute;caissement</td>
    <td>
  <input id="date_frais" name="date_frais" size="10" type="text" /> <script type="text/javascript">

    document.writeln('<img id="date_frais_trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
    Calendar.setup(
    {
        inputField  : "date_frais",
        button      : "date_frais_trigger"
    }
    );
</script></td><td></td><td></td></tr><tr bgcolor="#FFFFFF">
          <td></td><td>
      </div><input type="hidden" value="<?php  echo $_GET['id_resacc_fi'];?>" name="id_resacc_fi" /><input type="hidden" value="<?php  echo $_GET['id_projet'];?>" name="id_projet" /><input type="submit" value="Enregistrer" name="enregistrer" /></td><td></td><td></td></tr></table></form></center>
    <?php
    if (isset($_GET['enregistrer'])) {
        $val=$projet->inserer_aide($GLOBALS['egw_info']['user']['account_id'], $_GET['id_projet'], $_GET['id_resacc_fi'], $_GET['nom_aide'], $_GET['nature'], $_GET['type'], $_GET['montant_demande'], $_GET['date_deb'], $_GET['date_fin'], $_GET['reponse'], $_GET['montant_obtenu'], $_GET['organisation'], $_GET['contact_nom'], $_GET['contact_prenom'], $_GET['motif_banque'], $_GET['decision_ben'], $_GET['motif_ben'], $_GET['initiative'], $_GET['mode'], $_GET['frais'], $_GET['date_frais'], $_GET['type_amt'], $_GET['duree_amt'], $_GET['tx_amt']);
    
        if ($val[1]!=0 or $val[0]!=0) {
            echo'<script>window.parent.opener.location.href="details.php?domain=default&id_contact='.$val[3].'&id_organisme='.$val[2].'&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
        } else {
            echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
        }
        echo'<script>window.close();</script>';
    }


    echo $GLOBALS['egw']->common->egw_footer();
?>
        </body></html>