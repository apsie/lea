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
	require("../../Classes/config/inc_apsie/Categorie.php");
$organisation = new organisation();
$categorie = new Categorie();
$retour=$organisation->get_orga($_GET['id_organisation']);
$cat=explode(',',$_GET['categorie']);
if($cat[1]==NULL)
{$cat=$cat[0];}
else
{$cat=$cat[1];}
$get_orga=$categorie->get_categorie($cat);

if (isset($_GET['categorie']))
{
if 	($_GET['categorie']=='212')
	{
	$nom_categorie='PRESCRIPTEURS';	
	}
if 	($_GET['categorie']=='240')
	{
	$nom_categorie='ORG_FINANCEMENT';	
	}
if 	($_GET['categorie']=='241')
	{
	$nom_categorie='ORG_ACCOMPAGNEMENT';	
	}
if 	($_GET['categorie']=='246')
	{
	$nom_categorie='EMPLOYEURS';	
	}
if 	($_GET['categorie']=='254')
	{
	$nom_categorie='Org_formation';	
	}	
if 	($_GET['categorie']=='255')
	{
	$nom_categorie='Org_certification';	
	}
if 	($_GET['categorie']=='262')
	{
	$nom_categorie='INSTITUTIONNELLES';	
	}	
if 	($_GET['categorie']=='263')
	{
	$nom_categorie='CONSEILS GENERAUX';	
	}	
if 	($_GET['categorie']=='264')
	{
	$nom_categorie='CONSEILS REGIONAUX';	
	}		
if 	($_GET['categorie']=='')
	{
	$nom_categorie='Tous';	
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

<center>
  <h2>Mise &agrave; jour de l'organisme </h2></center><br>


<!--$organisation->recup_organisation($_GET['id_organisation'],$_GET['nom_organisme']);-->


<form method="get" name="modifier"><center><table style="border:1px solid #CCC" >
		<input name="id_organisation" value="<?php echo $_GET['id_organisation']; ?>" type="hidden">
		<input name="nom_organisme" value="<?php echo $_GET['nom_organisme']; ?>" type="hidden">
		<input name="categorie" value="<?php echo $_GET['categorie']; ?>" type="hidden">
<tr bgcolor="#ECF3F4" >
<td width="200">Nom de l organisme</td><td ><strong> <?php echo $retour[13]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
<td>Catégorie de l organisme</td><td ><select name="cat_id"><?php echo'<option value="'.$get_orga['cat_id'].'">'.$get_orga['cat_name'].'</option>'; ?>
      <?php
	  for($i=0;$i<count($liste_orga);$i++)
	  {
		 echo'<option value='.$liste_orga[$i]['cat_id'].'>'.$liste_orga[$i]['cat_name'].'</option>';
	  }
      
	  ?></select></td></td>
</tr>

<tr bgcolor="#ECF3F4">
<td>Code organisme</td><td><input size="43" name="code_org" type="text" value="<?php echo $retour[1]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Rue</td><td><input size="43" name="adresse_ligne_1" type="text" value="<?php echo $retour[2]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><input size="43" name="adresse_ligne_2" type="text" value="<?php echo $retour[3]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><input size="43" name="adresse_ligne_3" type="text" value="<?php echo $retour[4]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
      </div>Code postal</td><td><input id="cp" name="cp" type="text" value="<?php echo $retour[5]; ?>" autocomplete="off" onBlur="fill();" onKeyUp="lookup(this.value,'cp');"  /></td>
</tr>
<tr bgcolor="#FFF">
<td>Ville</td><td><input id="ville" name="ville" type="text" value="<?php echo $retour[6]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Région</td><td><input id="region" name="region" type="text" value="<?php echo $retour[7]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Pays</td><td><input id="pays" name="pays" type="text" value="<?php echo $retour[8]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tél</td><td><input name="tel" type="text" value="<?php echo $retour[9]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Fax</td><td><input name="fax" type="text" value="<?php echo $retour[10]; ?>" /></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Email</td><td><input name="email" type="text" value="<?php echo $retour[11]; ?>" /></td>
</tr>
<tr bgcolor="#FFF">
<td>Site Web</td><td><input name="site_web" type="text" value="<?php echo $retour[12]; ?>" /></td>
</tr>
</table><br/><input name="enregistrer_modif" type="submit" value="Enregistrer"></center></form>

<?php
if (isset($_GET['enregistrer_modif']))
{
$organisation->update_organisation($_GET['id_organisation'], $GLOBALS['egw_info']['user']['account_id'],$date_last_modified, $_GET['categorie'], $_GET['code_org'], $_GET['adresse_ligne_1'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'],  $_GET['cp'], $_GET['ville'], $_GET['region'], $_GET['pays'], $_GET['tel'], $_GET['fax'], $_GET['email'], $_GET['site_web']);

echo '<SCRIPT LANGUAGE="JavaScript"> 



   ';
	
	if(isset($_GET['financement']) and $_GET['financement']==1)
	{
  
		
	}
	else
	{
	echo' $obj2 ="window.parent.opener.location.reload()";setTimeout($obj2,1000);';
	}
    
 echo' $obj3 ="window.close()"; setTimeout($obj3,2000);

  </script>';
	
	}

echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>