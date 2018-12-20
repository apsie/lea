<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
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



<html><body><table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
     
      
      <tbody><tr>
    
   <td width="1313"><center>
     <input type="button" value="Créer un contact à lier" onClick="window.open('ajouter_contact.php?domain=default&id_organisation=<?php echo $_GET['id_organisation'];?>','control','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=650, height=520')" >
      <input value="Retour" onClick="history.back()"  type="button" ></center></td>
      		
      </tr>
     
   </tbody></table><br/>
 <center><h2><?php echo $organisation->get_organisation($_GET['id_organisation']); ?> (<?php echo $organisation->nbr_salaries($_GET['id_organisation']); ?> membre(s) ) </h2></center><br/><?php    
$organisation->voir_detail_orga_lier($_GET['id_organisation']);
?> <br/><table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"><td width="20" height="21"></td><td width="200" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=nom_complet&cla=<?php echo $_GET['cla']; ?>">Nom</a></font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=cp&cla=<?php echo $_GET['cla']; ?>">Fonction</a></font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=cp&cla=<?php echo $_GET['cla']; ?>">Cp</a></font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=ville&cla=<?php echo $_GET['cla']; ?>">Ville</a></font>
  </td>
  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=tel_pro_1&cla=<?php echo $_GET['cla']; ?>">Tél</a></font>
  </td>  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&tri=portable_perso&cla=<?php echo $_GET['cla']; ?>">Portable</a></font>
  </td>
  
  <td width="71" class="body">Actions
  <img src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21" border="0" height="16"></td>
</tr>


<?php  
$organisation->voir_membres($_GET['id_organisation']);
?></table>
    

<br/><br/>
<table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
<td width="1313"><center><form action="lier.php" method="get"><input name="domain" value="default" type="hidden">
<input name="mot" type="text"><input name="id_organisation" type="hidden" value="<?php echo $_GET['id_organisation'];?>"><input name="nom_organisme" type="hidden" value="<?php echo $_GET['nom_organisme'];?>">  <input name="rechercher" type="submit" value="Rerchercher un contact à lier">
</form></center></td>
</table><br/>


<table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"><td width="20" height="21"></td><td width="200" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Nom</font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Cp</font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Ville</font>
  </td>
  <td width="100" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Pays</font>
  </td>
  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Tél</font>
  </td>  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Portable</font>
  </td>
  
  <td width="71" class="body">Actions
  <img src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21" border="0" height="16"></td>
</tr>

<?php   if(isset($_GET['rechercher'])) 
{
$organisation->trouve_contact($_GET['mot'], $_GET['id_organisation']);
}?>
</table><br/>

<?php
if (isset($_GET['id_ben_a_lier']))
{
	
	
	$retour=$organisation->inserer_id_organisation($_GET['id_ben_a_lier'], $_GET['id_organisation'], $GLOBALS['egw_info']['user']['account_id'] );
	if($retour==1)
	{
		echo"<script>alert('Ce contact est deja lie a cette organisation.')</script>";
	}	
	else
	{
		echo"<script>alert('Le contact a été correctement lié')</script>";
	}
	
	}
		   
echo $GLOBALS['egw']->common->egw_footer();
?>

</body></html>