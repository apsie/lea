<?php
include('../../Classes/config/config_egw_version.php');
$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => $contact_v,
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.contact.inc.php");
include("../../Classes/config/inc_apsie/Categorie.php");	
$contact = new contact();
$categorie = new categorie();
$liste_orga=$categorie->selectionner_categorie('contact');
?>
<html><head><script type="text/javascript" src="js/jquery-1.2.1.pack.js"></script>

<script type="text/javascript" src="js/liste_aide.js"></script>


<style type="text/css">
<!--


	.suggestionsBox {
		position:absolute;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
		font-size:10px;
		
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
		background-color:#024A86;
	}

-->
</style></head><body>
<center><h2>Ajout d'un nouveau bénéficiaire</h2></center><br>


<form method="get" name="ajouter"><center><table style="border:1px solid #CCC" >		
<tr bgcolor="#FFF">
  <td width="180">Catégorie du contact</td>
  <td ><select name="cat_id"><option></option>
      <?php
	  for($i=0;$i<count($liste_orga);$i++)
	  {
		 echo'<option value='.$liste_orga[$i]['cat_id'].'>'.$liste_orga[$i]['cat_name'].'</option>';
	  }
      
	  ?></select></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Civilité</td><td ><select name="civilite"><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option><option value="Monsieur">Monsieur</option></select></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Nom</td><td ><input name="nom" type="text"/></td><td>Deuxième Prénom</td><td><input name="deuxieme_prenom" type="text"/></td>
</tr>
</tr>
<tr bgcolor="#ECF3F4">
<td>Prénom</td><td><input name="prenom" type="text"/></td><td>Nom de jeune fille</td><td><input name="nom_jeune_fille" type="text"/></td>
</tr>
<tr bgcolor="#FFF">
  <td>Rue</td><td><input size="30" name="adresse_ligne_1" type="text"/></td><td >Fonction</td><td ><input name="fonction" type="text"/></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><input size="30" name="adresse_ligne_2" type="text" /></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><input size="30" name="adresse_ligne_3" type="text"/></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
      </div>Code postal</td><td><input name="cp" id="cp" autocomplete="off" onblur="fill();" onkeyup="lookup(this.value,'cp');" type="text" /></td><td>Ville</td><td><input name="ville" type="text"  id="ville" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Région</td><td><input id="region" name="region" type="text"  /></td><td>Pays</td><td><input id="pays" name="pays" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tél pro</td><td><input name="tel_pro_1" type="text"  /></td><td>Tél pro 2</td><td><input name="tel_pro_2" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Tél domicile</td><td><input name="tel_domicile_1" type="text"  /></td><td>Tél domicile 2</td><td><input name="tel_domicile_2" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Portable perso</td><td><input name="portable_perso" type="text"  /></td><td>Portable pro</td><td><input name="portable_pro" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Email domicile</td><td><input name="email_perso" type="text"  /></td><td>Email pro</td><td><input name="email_pro" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Fax domicile</td><td><input name="fax_perso" type="text"  /></td><td>Fax pro</td><td><input name="fax_pro" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Site web perso</td><td><input name="site_perso" type="text"  /></td><td></td><td></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	$contact->ajouter_contact( $GLOBALS['egw_info']['user']['account_id'], $_GET['cat_id'], $_GET['nom'], $_GET['prenom'], $_GET['deuxieme_prenom'], $_GET['nom_jeune_fille'], $_GET['civilite'], $_GET['adresse_ligne_1'], $_GET['fonction'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'], $_GET['ville'], $_GET['region'], $_GET['cp'],  $_GET['pays'], $_GET['tel_pro_1'], $_GET['tel_pro_2'], $_GET['tel_domicile_1'], $_GET['tel_domicile_2'], $_GET['fax_pro'], $_GET['fax_perso'], $_GET['portable_pro'], $_GET['portable_perso'], $_GET['email_pro'], $_GET['email_perso'], $_GET['site_perso']);

echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="window.parent.opener.location.reload()";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);
  setTimeout($obj3,2000);

  </script>';	
	
	}

echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>