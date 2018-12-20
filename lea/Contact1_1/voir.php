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
	
	
$contact = new contact();
$coordonnee=$contact->get_coordonnee($_GET['id_ben']);



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
<html><body>
<center>
  <h2>Fiche du contact</h2></center><br>

<center><table style="border:1px solid #CCC" >	
<tr bgcolor="#FFF">
  <td width="180">Categorie du contact</td>
  <td ><strong><?php echo $contact->get_categorie($coordonnee[24]); ?></strong></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Civilite</td><td ><strong><?php echo $coordonnee[18]; ?></strong></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Nom</td><td ><strong><?php echo $coordonnee[19]; ?></strong></td>
<td>Deuxieme Prenom</td><td><strong><?php echo $coordonnee[21]; ?></strong></td>
</tr>
</tr>
<tr bgcolor="#ECF3F4">
<td>Prenom</td><td><strong><?php echo $coordonnee[20]; ?></strong></td><td>Nom de jeune fille</td><td><strong><?php echo $coordonnee[22]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
  <td>Rue</td><td><strong><?php echo $coordonnee[0]; ?></strong></td><td >Fonction</td><td ><strong><?php echo $coordonnee[23]; ?></strong></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Adresse ligne 2</td><td><strong><?php echo $coordonnee[1]; ?></strong></td><td ></td><td ></td>
</tr>
<tr bgcolor="#FFF">
<td>Adresse ligne 3</td><td><strong><?php echo $coordonnee[2]; ?></strong></td><td ></td><td ></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Code postal</td><td><strong><?php echo $coordonnee[3]; ?></strong></td><td>Ville</td><td><strong><?php echo $coordonnee[4]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
<td>Region</td><td><strong><?php echo $coordonnee[5]; ?></strong></td><td>Pays</td><td><strong><?php echo $coordonnee[6]; ?></strong></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Tel pro</td><td><strong><?php echo $coordonnee[7]; ?></strong></td>
<td>Tel pro 2</td><td><strong><?php echo $coordonnee[8]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
<td>Tel domicile</td><td><strong><?php echo $coordonnee[9]; ?></strong></td>
<td>Tel domicile 2</td><td><strong><?php echo $coordonnee[10]; ?></strong></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Portable perso</td><td><strong><?php echo $coordonnee[12]; ?></strong></td><td>Portable pro</td><td><strong><?php echo $coordonnee[11]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
<td>Email domicile</td><td><strong><?php echo $coordonnee[13]; ?></strong></td><td>Email pro</td><td><strong><?php echo $coordonnee[14]; ?></strong></td>
</tr>
<tr bgcolor="#ECF3F4">
<td>Fax domicile</td><td><strong><?php echo $coordonnee[15]; ?></strong></td><td>Fax pro</td><td><strong><?php echo $coordonnee[16]; ?></strong></td>
</tr>
<tr bgcolor="#FFF">
<td>Site web perso</td><td><strong><?php echo $coordonnee[17]; ?></strong></td><td></td><td></td>
</tr>
</table><br/></center>
<?php


echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>