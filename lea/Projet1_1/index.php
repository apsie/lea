<?php
    $GLOBALS['egw_info'] = array(
        'flags' => array(
            'noheader'                => false,
            'nonavbar'                => false,
            'currentapp'              => 'Projet1_1',
            'enable_network_class'    => false,
            'enable_contacts_class'   => false,
            'enable_nextmatchs_class' => false
        )
    );

    include('../header.inc.php');
    include("inc/class.projet.inc.php");
    
    $projet = new projet();
    if (!isset($_GET['tri'])) {
        $_GET['tri']="date_debut";
    }

    
    if (isset($_GET['limit'])) {
    } else {
        $_GET['limit']=50;
    }
    if (!isset($_GET['cla'])) {
        $_GET['cla']="asc";
    }


    if (isset($_GET['cla']) and $_GET['cla']=="asc") {
        if (isset($_GET['fleche'])) {
            $_GET['cla']="asc";
        } else {
            $_GET['cla']="desc";
        }
    } else {
        if (isset($_GET['fleche'])) {
            $_GET['cla'] = "desc";
        } else {
            $_GET['cla'] = "asc";
        }
    }


    if (isset($_GET['ligne'])) {
    } else {
        $_GET['ligne']=0;
    }

?>
<html><body>
<center>Montre <?php echo $_GET['ligne']; ?> à <?php if ($projet->nbr_projet($_GET['categorie'], $_GET['mot'])< $_GET['ligne']+50) {
    echo $projet->nbr_projet($_GET['categorie'], $_GET['mot']);
} else {
    echo $_GET['ligne']+50;
}?> sur <strong><?php echo $projet->nbr_projet($_GET['categorie'], $_GET['mot']);?></strong></center><br/>

<table width="100%" bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0" cols="5">
  <tbody><tr>   

<td valign="top" width="2%" align="left">
    <table bgcolor="" border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td><form method="GET" action="index.php" >
    <input name="ligne" value="<?php echo $_GET['ligne']-50; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="categorie" value="<?php echo $_GET['categorie']; ?>" type="hidden"><input name="tri" value="<?php echo $_GET['tri']; ?>" type="hidden"><input name="fleche" type="hidden" value="precedent"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>">
    <table bgcolor="" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td align="right">
            <input src="index.php_fichiers/left.png" title="Page suivante" name="start" value="50" type="image" border="0">
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
            
       
            <td>
      Catégorie : <select name="categorie"><option value="">Tous</option><option value="CREA">Creation</option><option value="DEV">Developpement</option></select> <input name="mot" type="text" value="<?php echo $_GET['mot']; ?>">&nbsp;<input name="Search" value="Chercher" type="submit"></td>
            
      </tr>
     
    </tbody></form></table></td>
<td valign="top" width="2%" align="right">
<form method="GET" action="index.php" >
    <input name="ligne" value="<?php echo $_GET['ligne']+50; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="categorie" value="<?php echo $_GET['categorie']; ?>" type="hidden"><input name="tri" value="<?php echo $_GET['tri']; ?>" type="hidden"><input name="fleche" type="hidden" value="suivant"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>">

    <table bgcolor="" border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td align="right">
            <input src="index.php_fichiers/right.png" title="Page suivante" name="start" value="50" type="image" border="0">
        </td>
    </tr>
    </tbody></table>
</form>
</td>
  </tr>
  
 </tbody></table>
<br/>
 
 <table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"><td height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&tri=intitule_projet&cla=<?php echo $_GET['cla']; ?>&ligne=<?php echo $_GET['ligne']; ?>">Intitulé du projet</a></font>
  </td>
  <td height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&ligne=<?php echo $_GET['ligne']; ?>&tri=date_debut&cla=<?php echo $_GET['cla']; ?>">Date de début</a></font>
  </td>
  <td height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&tri=date_fin_reelle&cla=<?php echo $_GET['cla']; ?>&ligne=<?php echo $_GET['ligne']; ?>">Date de fin r&eacute;elle</a></font>
  </td>
  <td height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&tri=id_coordinateur&cla=<?php echo $_GET['cla']; ?>&ligne=<?php echo $_GET['ligne']; ?>">conseiller apsie </a></font>
  </td>  <td height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&tri=statut&cla=<?php echo $_GET['cla']; ?>&ligne=<?php echo $_GET['ligne']; ?>">statut</a></font>
  </td>
  <td height="21">
   <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&mot=<?php echo $_GET['mot']; ?>&tri=description_projet&cla=<?php echo $_GET['cla']; ?>&ligne=<?php echo $_GET['ligne']; ?>">Description</a></font>
  </td>
<td width="71" class="body">Actions
  <img src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21" border="0" height="16"></td>
</tr>
<?php  if (isset($_GET['tri']) and isset($_GET['cla'])) {
    $projet->voir_projet($_GET['categorie'], $_GET['mot'], $_GET['ligne'], $_GET['limit'], $GLOBALS['egw_info']['user']['account_id'], $_GET['tri'], $_GET['cla']);
} else {
    $projet->voir_projet($_GET['categorie'], $_GET['mot'], $_GET['ligne'], $_GET['limit'], $GLOBALS['egw_info']['user']['account_id']);
}?></table><br/><center><input type="button" value="Ajouter un projet"></center>
<?php

echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>
