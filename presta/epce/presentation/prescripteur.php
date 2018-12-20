<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<title>Bénéficiaire</title>

</head>

<body><form action="../test.php" method="post" ><input type="hidden"  name="cat_id" value="EMPLOYEURS"/><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<center>
  <h2>PRESCRIPTEUR</h2></center><h2>Carte d'identité</h2><hr />
<table><tr><td width="116">Civilité</td><td width="144"><select name="n_prefix_"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select></td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr><tr><td>Nom</td><td><input  type="text"  name="n_family_" /></td><td width="101">Prénom</td><td width="144"><input  type="text" name="n_given_" /></td></tr><tr>
<td>Deuxième prénom</td>
<td><input type="text" name="n_middle_" /></td>
<td>Nom de jeune fille</td><td><input name="n_suffix_" type="text" /></td></tr><tr>
 <td>Tél bureau</td><td><input  name="tel_work_" type="text" /></td><td>Tél portable</td><td><input name="tel_cell" type="text" /></td></tr><tr>
  <td>Tél privé</td>
 <td><input type="text"  name="tel_home_" /></td>
 <td>Site web</td>
 <td><input name="url_" type="text" /></td></tr><tr>
  <td>Email bureau</td>
 <td><input name="email_" type="text" /></td>
 <td>Email domicile</td>
 <td><input name="email_home_" type="text" /></td></tr></table>

<h2>Société</h2>
<hr /><table><tr>
   <td width="117">Agence</td>
   <td width="144"><input style="border:1px solid #F00"  name="org_name_" type="text" /></td>
   <td width="101">Code prescripteur</td>
   <td width="144"><input style="border:1px solid #F00" type="text" name="tel_isdn_" /></td></tr><tr>
<td>Service</td>
<td><input name="title" type="text" /></td>
<td width="98">Fonction</td>
<td width="144"><input name="org_unit_" type="text" /></td></tr><tr>
 <td>Rue</td>
 <td><input name="adr_one_street_" type="text" /></td></tr><tr>
  <td>Code postal</td>
 <td><input name="adr_one_postalcode_" type="text" /></td>
 <td>Ville</td>
 <td><input name="adr_one_locality_" type="text" /></td></tr><tr>
  <td>Région</td>
 <td><input name="adr_one_region_" type="text" /></td>
 <td>Pays</td>
 <td><input name="adr_one_countryname_" type="text" /></td></tr></table>
<h2>&nbsp;</h2>
<p><input type="submit" value="Enregistrer" /> <input type="button" value="Retour" OnClick="window.location='panel.php?<?php echo 'choix='.$_GET['id'];?>'"></p></form>
</body>
</html>