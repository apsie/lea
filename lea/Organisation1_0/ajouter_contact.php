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
	include("inc/class.contact.inc.php");
	
$organisation = new organisation();

?>
<html><body>
<center><h2>Ajout d'un contact à lier</h2></center><br>


<form method="get" name="ajouter"><input type="hidden" name="id_organisation" value="<?php echo $_GET['id_organisation'];?>"/><center><table style="border:1px solid #CCC" >		
<tr bgcolor="#FFF">
  <td width="180">Catégorie du contact</td>
  <td ><select name="cat_id"><option value=""></option><?php $organisation->lister_categorie_contact(); ?><option value="apsie">Staff ( Apsie )</option></select></td><td ></td><td ></td>
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
<tr bgcolor="#ECF3F4">
  <td>Rue</td><td><input size="30" name="adresse_ligne_1" type="text"/></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 2</td><td><input size="30" name="adresse_ligne_2" type="text" /></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 3</td><td><input size="30" name="adresse_ligne_3" type="text"/></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Code postal</td><td><input name="cp" type="text" /></td><td>Ville</td><td><input name="ville" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Région</td><td><input name="region" type="text"  /></td><td>Pays</td><td><input name="pays" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Tél pro</td><td><input name="tel_pro_1" type="text"  /></td><td>Tél pro 2</td><td><input name="tel_pro_2" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tél domicile</td><td><input name="tel_domicile_1" type="text"  /></td><td>Tél domicile 2</td><td><input name="tel_domicile_2" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Portable perso</td><td><input name="portable_perso" type="text"  /></td><td>Portable pro</td><td><input name="portable_pro" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Email domicile</td><td><input name="email_perso" type="text"  /></td><td>Email pro</td><td><input name="email_pro" type="text"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Fax domicile</td><td><input name="fax_perso" type="text"  /></td><td>Fax pro</td><td><input name="fax_pro" type="text"  /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Site web perso</td><td><input name="site_perso" type="text"  /></td><td></td><td></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
$organisation->ajouter_contact_a_lier($_GET['id_organisation'], $GLOBALS['egw_info']['user']['account_id'], $_GET['cat_id'], $_GET['nom'], $_GET['prenom'], $_GET['deuxieme_prenom'], $_GET['nom_jeune_fille'], $_GET['civilite'], $_GET['adresse_ligne_1'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'], $_GET['ville'], $_GET['region'], $_GET['cp'],  $_GET['pays'], $_GET['tel_pro_1'], $_GET['tel_pro_2'], $_GET['tel_domicile_1'], $_GET['tel_domicile_2'], $_GET['fax_pro'], $_GET['fax_perso'], $_GET['portable_pro'], $_GET['portable_perso'], $_GET['email_pro'], $_GET['email_perso'], $_GET['site_perso']);

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