<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => 'Organisation1_0',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.organisation.inc.php");
	
$organisation = new organisation();
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

<center><h2>Ajout d'un organisme</h2></center>

<form method="get" name="ajouter"><center><table style="border:1px solid #CCC" >
		
<tr bgcolor="#ECF3F4" >
<td width="200">Nom de l organisme</td><td ><input name="nom_organisme" type="text"></td>
</tr>
<tr bgcolor="#FFF">
<td>Catégorie de l organisme</td><td ><select name="categorie_org"><?php echo $organisation->lister_categorie(); ?></select></select></td>
</tr>

<tr bgcolor="#ECF3F4">
<td>Code organisme</td><td><input name="code_org" type="text"/></td>
</tr>
<tr bgcolor="#FFF">
<td>Rue</td><td><input size="43" name="adresse_ligne_1" type="text"/></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><input size="43" name="adresse_ligne_2" type="text" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><input size="43" name="adresse_ligne_3" type="text"/></td>
</tr>
<tr bgcolor="#ECF3F4">
<td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
      </div>Code postal</td><td><input id="cp" name="cp" type="text" autocomplete="off" onBlur="fill();" onKeyUp="lookup(this.value,'cp');" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Ville</td><td><input id="ville" name="ville" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Région</td><td><input id="region" name="region" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Pays</td><td><input id="pays" name="pays" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tél</td><td><input name="tel" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Fax</td><td><input name="fax" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Email</td><td><input name="email" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Site Web</td><td><input name="site_web" type="text"  /></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	$organisation->ajouter_organisation($GLOBALS['egw_info']['user']['account_id'], $date_creation, $GLOBALS['egw_info']['user']['account_id'], $date_last_modified, $_GET['categorie_org'], $_GET['code_org'], $_GET['nom_organisme'], $_GET['adresse_ligne_1'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'],  $_GET['cp'], $_GET['ville'], $_GET['region'], $_GET['pays'], $_GET['tel'], $_GET['fax'], $_GET['email'], $_GET['site_web']);

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