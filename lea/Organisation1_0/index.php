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
	include("../../Classes/config/inc_apsie/Categorie.php");
	
	
$organisation = new organisation();
$categorie = new categorie();
$liste_orga=$categorie->selectionner_categorie('organisation'); // spirea : listage des catégories
$get_orga=$categorie->get_categorie($_GET['categorie']);
if(!isset($_GET['nbr_resultat']))
{
$_GET['nbr_resultat']=50;	
}

	
/*if (isset($_GET['categorie']))
{
if 	($_GET['categorie']=='235')
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
	
	*/
	
if(isset($_GET['limit']))
{}
else
{
$_GET['limit']=$_GET['nbr_resultat'];
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
<html><body>
<center>Montre <?php echo $_GET['ligne']; ?> à <?php if($organisation->nbr_organisation($_GET['categorie'], $_GET['mot'])< $_GET['ligne']+$_GET['nbr_resultat']){echo $organisation->nbr_organisation($_GET['categorie'],$_GET['mot']);}else{echo $_GET['ligne']+$_GET['nbr_resultat']; }?> sur <strong><?php echo $organisation->nbr_organisation($_GET['categorie'], $_GET['mot']);?></strong></center><br/>

<table width="100%" bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0" cols="5">
  <tbody><tr>   

<td valign="top" width="2%" align="left">
	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td><form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']-$_GET['nbr_resultat']; ?>" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="categorie" value="<?php echo $_GET['categorie']; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>">
	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	  <tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/left.png" title="Page précédente" name="start" value="<?php echo $_GET['nbr_resultat']; ?>" type="image" border="0">
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
      		
       
      		<td width="181">Nbre de résultat 
      		  <select name="nbr_resultat"><option><?php echo $_GET['nbr_resultat']; ?></option><option>25</option><option >50</option><option>100</option><option>500</option></select></td><td>
      Catégorie : <select name="categorie"><?php echo'<option value="'.$get_orga['cat_id'].'">'.$get_orga['cat_name'].'</option>'; ?>
      <?php
	  for($i=0;$i<count($liste_orga);$i++)
	  {
		 echo'<option value='.$liste_orga[$i]['cat_id'].'>'.$liste_orga[$i]['cat_name'].'</option>';
	  }
      
	  ?></select> <input name="mot" type="text" value="<?php if (isset($_GET['mot'])){echo $_GET['mot'];}?>">&nbsp;<input name="Search" value="Chercher" type="submit"></td>
      		
      </tr>
     
    </tbody></form></table></td>
<td valign="top" width="2%" align="right">
<form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']+$_GET['nbr_resultat']; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="categorie" value="<?php echo $_GET['categorie']; ?>" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>">

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/right.png" title="Page suivante" name="start" value="<?php echo $_GET['nbr_resultat']; ?>" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form>
</td>
  </tr>
 
  
 </tbody></table>
 
 
 <br/>
 <table class="calDayViewSideBoxes" width="100%">
<tbody><tr><td></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=a"><font color="{charcolor}">A</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=b">B</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=c">C</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=d">D</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=e">E</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=f">F</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=g">G</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=h">H</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=i">I</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=j">J</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=k">K</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=l">L</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=m">M</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=n">N</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=o">O</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=p">P</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=q">Q</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=r">R</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=s">S</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=t">T</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=u">U</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=v">V</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=w">W</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=x">X</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=y">Y</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=z">Z</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=">Tous</font></a><font color="{charcolor}"></font></td>
</tr>
</tbody></table >
 
 <br/>
 
 <table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"><td width="20" height="21"></td><td width="200" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=nom_organisme&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Nom organisme</a></font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=cp&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">CP</a></font>
  </td>
  <td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=ville&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Ville</a></font>
  </td>
  <td width="100" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=tel&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Tél</a></font>
  </td>
  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=fax&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Fax</a></font>
  </td>  <td width="160" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=email&cla=<?php echo $_GET['cla']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Email</a></font>
  </td>
  <td width="71" class="body">Actions
  <img src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21" border="0" height="16"></td>
</tr>
<?php  if(isset($_GET['tri']) and isset($_GET['cla']))
{
$organisation->voir_organisation($_GET['categorie'], $_GET['mot'],$_GET['ligne'],$_GET['limit'],$GLOBALS['egw_info']['user']['account_id'],$_GET['tri'],$_GET['cla']);
}
else
{
$organisation->voir_organisation($_GET['categorie'],$_GET['mot'],$_GET['ligne'],$_GET['limit'],$GLOBALS['egw_info']['user']['account_id']);
}?></table><br/><center><form><input type="button" onClick="window.open('ajouter.php?domain=default','control','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=600, height=470')" value="Ajouter un organisme"></form></center>
<?php

echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>