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
if(isset($_GET['limit']))
{}
else
{
$_GET['limit']=50;
}
if(isset($_GET['cla']) and $_GET['cla']=="asc")
{$_GET['cla']="desc";}
else
{
$_GET['cla'] = "asc";
}

if(isset($_GET['ligne']))
{}
else
{
$_GET['ligne']=0;
}

?>



<html><body><table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
     
      
      <tbody><tr>
      		
       
   <td width="1313"><center><input value="Retour" onClick="history.back()"  type="button"></center></td>
      		
      </tr>
     
    </tbody></table>
    <center>Montre <?php echo $_GET['ligne']; ?> à <?php if($organisation->nbr_salaries($_GET['id_organisation'])< $_GET['ligne']+50){echo $organisation->nbr_salaries($_GET['id_organisation']);}else{echo $_GET['ligne']+50; }?> sur <strong><?php echo $organisation->nbr_salaries($_GET['id_organisation']);?></strong></center><br/>
    
    
    <center><h2><?php echo $_GET['nom_organisme']; ?> (<?php echo $organisation->nbr_salaries($_GET['id_organisation']); ?> membre(s) )</h2></center><br/>
    

<?php    
$organisation->voir_detail_orga($_GET['id_organisation']);
?>
<table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"><td width="20" height="21"></td><td width="200" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Nom</font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Fonction</font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Cp</font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Ville</font>
  </td>
  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Tél</font>
  </td>  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Portable</font>
  </td>
  
  <td width="71" class="body">Actions
  <img src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21" border="0" height="16"></td>
</tr>


<?php  
$organisation->voir_membres($_GET['id_organisation']);
?></table>

<?php

echo $GLOBALS['egw']->common->egw_footer();
?>

</body></html>