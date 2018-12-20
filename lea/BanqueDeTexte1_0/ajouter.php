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
<head>
<script>
function ajouter_cat()
{
   document.getElementById('cat_input').style.display ='block';
   document.getElementById('select_cat').style.display='none';
   document.getElementById('image').style.display='none';
}



</script>


</head>
<html><body>
<center><h2>Ajouter une banque de texte</h2></center><br>

<form method="get" name="ajouter">


<center><table style="border:1px solid #CCC" >	
<tr bgcolor="#FFF">
  <td width="100">Catégorie</td>
  <td width="250" ><select id="select_cat" name="categorie"><option value=""></option><?php echo $banque->lister_categorie(); ?></select> <a href="javascript::void();" id="image" onClick= "ajouter_cat();"><img title='Ajouter une catégorie' src="images/add.png" border="0" /></a><input name="ajout_categorie" type="text" size="45" style="display:none" id="cat_input" /></td>
</tr>
<tr bgcolor="#ECF3F4" height="20px"><td></td><td></td></tr>
<tr bgcolor="#FFF">
<td>Valeur</td><td ><input name="valeur" type="text" size="45"</td>
</tr>
</table><br/><input name="enregistrer" type="submit" value="Enregistrer"></center></form>
<?php
if (isset($_GET['enregistrer']))
{
	if ($_GET['categorie']!=NULL)
	{
$banque->insert_banque_texte($_GET['categorie'], $_GET['valeur']);
	}
	elseif($_GET['ajout_categorie']!=NULL)
	{
	$banque->insert_banque_texte($_GET['ajout_categorie'], $_GET['valeur']);	
	}
	else
	{		
	echo '<script language="JavaScript" type="text/javascript">alert("Veuillez séléctionner une catégorie.")</script>
		' ;	
	}

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