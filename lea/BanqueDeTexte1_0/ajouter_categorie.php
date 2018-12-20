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
<center><h2>Ajouter une catégorie à la banque de texte</h2></center><br>

<form method="get" name="ajouter">


<center><table style="border:1px solid #CCC" >	
<tr bgcolor="#FFF">
  <td width="180">Catégorie</td>
  <td ><input name="categorie" type="text" size="45"></td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	
$banque->insert_categorie($_GET['categorie']);


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