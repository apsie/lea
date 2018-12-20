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
$coordonnee=$contact->get_coordonnee($_GET['id_ben']);

	
	
$categorie = new categorie();
$liste_orga=$categorie->selectionner_categorie('contact');
$cat=explode(',',$_GET['categorie']);
$get_orga=$categorie->get_categorie($cat[0]);


if (isset($_GET['categorie']))
{
if 	($_GET['categorie']=='165')
	{
	$nom_categorie='Usager_06';	
	}
if 	($_GET['categorie']=='84')
	{
	$nom_categorie='Usager_07';	
	}
if 	($_GET['categorie']=='156')
	{
	$nom_categorie='Usager_08';	
	}
if 	($_GET['categorie']=='219')
	{
	$nom_categorie='Usager_09';	
	}
if 	($_GET['categorie']=='244')
	{
	$nom_categorie='Usager_10';	
	}	
if 	($_GET['categorie']=='apsie')
	{
	$nom_categorie='Staff ( Apsie )';	
	}
if 	($_GET['categorie']=='256')
	{
	$nom_categorie='Contact_prescripteurs';	
	}	
if 	($_GET['categorie']=='257')
	{
	$nom_categorie='Contact_employeurs';	
	}	
if 	($_GET['categorie']=='260')
	{
	$nom_categorie='Contact org_accompagnement';	
	}		
if 	($_GET['categorie']=='261')
	{
	$nom_categorie='Contact org_financement';	
	}			
if 	($_GET['categorie']=='269')
	{
	$nom_categorie='Contact_intitutionnel';	
	}		
	}
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
<center><h2>Modification d'un contact</h2></center><br>

<form method="get" name="modifier"><center><table style="border:1px solid #CCC" >	
<input name="id_ben" value="<?php echo $_GET['id_ben']; ?>" type="hidden">	
<tr bgcolor="#FFF">
  <td width="180">Categorie du contact</td>
  <td ><select name="cat_id"><?php echo'<option value="'.$get_orga['cat_id'].'">'.$get_orga['cat_name'].'</option>'; ?>
      <?php
	  for($i=0;$i<count($liste_orga);$i++)
	  {
		 echo'<option value='.$liste_orga[$i]['cat_id'].'>'.$liste_orga[$i]['cat_name'].'</option>';
	  }
      
	  ?></select></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Civilite</td><td ><select name="civilite"><option value="<?php echo $coordonnee[18]; ?>"><?php echo $coordonnee[18]; ?></option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option><option value="Monsieur">Monsieur</option></select></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Nom</td><td ><input name="nom" type="text" value="<?php echo $coordonnee[19]; ?>"/></td>
<td>Deuxieme Prenom</td><td><input name="deuxieme_prenom" type="text" value="<?php echo $coordonnee[21]; ?>"/></td>
</tr>
</tr>
<tr bgcolor="#ECF3F4">
<td>Prenom</td><td><input name="prenom" type="text" value="<?php echo $coordonnee[20]; ?>"/></td><td>Nom de jeune fille</td><td><input name="nom_jeune_fille" type="text" value="<?php echo $coordonnee[22]; ?>"/></td>
</tr>
<tr bgcolor="#FFF">
  <td>Rue</td><td><input size="30" name="adresse_ligne_1" type="text" value="<?php echo $coordonnee[0]; ?>"/></td><td >Fonction</td><td ><input name="fonction" type="text" value="<?php echo $coordonnee[23]; ?>"/></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><input size="30" name="adresse_ligne_2" type="text" value="<?php echo $coordonnee[1]; ?>" /></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><input size="30" name="adresse_ligne_3" type="text" value="<?php echo $coordonnee[2]; ?>"/></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
      </div>Code postal</td><td><input id="cp"  name="cp" type="text" autocomplete="off" onBlur="fill();" onKeyUp="lookup(this.value,'cp');"  value="<?php echo $coordonnee[3]; ?>" /></td><td>Ville</td><td><input id="ville"  name="ville" type="text" value="<?php echo $coordonnee[4]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Region</td><td><input id="region" name="region" type="text" value="<?php echo $coordonnee[5]; ?>" /></td><td>Pays</td><td><input id="pays"  name="pays" type="text" value="<?php echo $coordonnee[6]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tel pro</td><td><input name="tel_pro_1" type="text" value="<?php echo $coordonnee[7]; ?>" /></td>
<td>Tel pro 2</td><td><input name="tel_pro_2" type="text" value="<?php echo $coordonnee[8]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Tel domicile</td><td><input name="tel_domicile_1" type="text" value="<?php echo $coordonnee[9]; ?>" /></td>
<td>Tel domicile 2</td><td><input name="tel_domicile_2" type="text" value="<?php echo $coordonnee[10]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Portable perso</td><td><input name="portable_perso" type="text" value="<?php echo $coordonnee[12]; ?>" /></td><td>Portable pro</td><td><input name="portable_pro" type="text" value="<?php echo $coordonnee[11]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Email domicile</td><td><input name="email_perso" type="text" value="<?php echo $coordonnee[13]; ?>" /></td><td>Email pro</td><td><input name="email_pro" type="text" value="<?php echo $coordonnee[14]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Fax domicile</td><td><input name="fax_perso" type="text" value="<?php echo $coordonnee[15]; ?>" /></td><td>Fax pro</td><td><input name="fax_pro" type="text" value="<?php echo $coordonnee[16]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Site web perso</td><td><input name="site_perso" type="text" value="<?php echo $coordonnee[17]; ?>" /></td><td></td><td></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	
$contact->update_contact($_GET['id_ben'],$GLOBALS['egw_info']['user']['account_id'], $_GET['cat_id'], $_GET['nom'], $_GET['prenom'], $_GET['deuxieme_prenom'], $_GET['nom_jeune_fille'], $_GET['civilite'], $_GET['adresse_ligne_1'], $_GET['fonction'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'], $_GET['ville'], $_GET['region'], $_GET['cp'],  $_GET['pays'], $_GET['tel_pro_1'], $_GET['tel_pro_2'], $_GET['tel_domicile_1'], $_GET['tel_domicile_2'], $_GET['fax_pro'], $_GET['fax_perso'], $_GET['portable_pro'], $_GET['portable_perso'], $_GET['email_pro'], $_GET['email_perso'], $_GET['site_perso']);


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