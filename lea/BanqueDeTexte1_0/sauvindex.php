<?php
include('../../Classes/config/config_egw_version.php');
$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'BanqueDeTexte1_0',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include('../../Classes/config/inc_apsie/Banque_Texte.php');

$banque = new Banque_Texte();

if(isset($_GET['limit']))
{}
else
{
$_GET['limit']=50;
}
if(isset($_GET['cla']) and $_GET['cla']=="asc" )
{
	if(isset($_GET['fleche']))
	{
	$_GET['cla']="asc";
	}
	else
	{
	$_GET['cla']="desc";
	}
	}
else
{
	if(isset($_GET['fleche']))
	{
	$_GET['cla'] = "desc";
	}
	else
	{
	$_GET['cla'] = "asc";
	}

}

if(isset($_GET['ligne']))
{}
else
{
$_GET['ligne']=0;
}

?>
<html>
<head><!-- <link rel="stylesheet" href="css/compte_rendu.css" type="text/css" media="screen" />--> 

</head>
<body>
<center><br/>
Montre <?php echo $_GET['ligne']; ?> à <?php if($banque->nbr_ligne_texte('')< $_GET['ligne']+50){echo $banque->nbr_ligne_texte('');}else{echo $_GET['ligne']+50; }?> sur <strong><?php echo $banque->nbr_ligne_texte('');?></strong></center><br/>

 <table width="100%" bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0" cols="5">
  <tbody><tr>   

<td valign="top" width="2%" align="left">
	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td><form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']-50; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="tri" type="hidden" value="<?php echo $_GET['tri']; ?>"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>"><input name="fleche" type="hidden" value="precedent">

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="images/left.png" title="Page suivante" name="start" value="50" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form></td>
	</tr>
	</tbody></table>
</td>
   <td valign="top" width="92%" align="center" bgcolor="#ebe8e4">
    <table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
     <form method="GET" action="index.php" name="filter"><input name="domain" value="default" type="hidden">
      
      <tbody><tr>
      		
       
     <td width="513" align="center">
     <input name="Search" value="Ajouter une banque de texte" type="submit"></td>
      		
      </tr>
     
    </tbody></form></table></td>
<td valign="top" width="2%" align="right">
<form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']+50; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="categorie" type="hidden" value="<?php echo $_GET['categorie']; ?>"><input name="tri" type="hidden" value="<?php echo $_GET['tri']; ?>"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>"><input name="fleche" type="hidden" value="suivant"></form>

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="images/right.png" title="Page suivante" name="start" value="50" type="image" border="0">

	</tr>
	</tbody></table>
</form>
</td>

  </tr>
 </tbody></table>
<br><br/>
<table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4" align="center">  <td width="3%" height="21">id</td><td width="45%" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Catégorie</font>
  </td>
  <td width="45%" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1">Valeur</font>
  </td><td width="7%" class="body">Actions
 <a onClick="javascript:Check_all(true);"> <img border="0" src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21"  height="16" /></a></td></tr>
<br/>
<?php
$banque->voir_texte('',$_GET['ligne'],$_GET['limit'],'',''); ?></table>
<?php
echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>