<?php
include('../../Classes/config/config_egw_version.php');
$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => 'BanqueDeTexte1_0',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include('../../Classes/config/inc_apsie/Banque_Texte.php');

$banque = new Banque_Texte();

?>
<html><body>
<center><h2>Modification d'une banque de texte</h2></center><br>

<form method="get" name="modifier">
<input name="id" type="hidden" value="<?php echo $_GET['id'] ?>">
<input name="categorie" type="hidden" value="<?php echo $banque->get_nom_categorie($_GET['id']); ?>">

<center><table style="border:1px solid #CCC" >	
<tr bgcolor="#FFF">
  <td width="180">Categorie</td>
  <td ><strong><?php echo $banque->get_nom_categorie($_GET['id']); ?></strong></td>
</tr>
<tr bgcolor="#ECF3F4" height="20px"><td></td><td></td></tr>
<tr bgcolor="#FFF">
<td>Valeur</td><td ><input name="valeur" type="text" size="45" value="<?php echo $banque->get_nom_valeur($_GET['id']); ?>"></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	
$banque->update_banque_texte($_GET['id'], $_GET['categorie'], $_GET['valeur']);


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