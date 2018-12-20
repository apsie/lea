<?php

	require('../../Classes/config/config_egw_version.php');
	$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => $contact_v,
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	
	//Spirea - appel de la classe contact
	// A debugger
	
	include("inc/class.contact.inc.php");
	include("../../Classes/config/inc_apsie/Categorie.php");
	include("../../Classes/config/inc_apsie/Employee.php");
	
	
	
$categorie = new categorie();
$liste_orga=$categorie->selectionner_categorie('contact');
$get_orga=$categorie->get_categorie($_GET['categorie']);

$contact = new contact();


if(!isset($_GET['nbr_resultat']))
{
$_GET['nbr_resultat']=50;	
}


if(!isset($_GET['champ']))
{
$_GET['champ']='Champ de recherche...';	
$champ_v=NULL;
}
else
{
$champ_v=$_GET['champ'];
}

// controle des variables pour le trie et l'affichage . ligne 22 à 134
if($_GET['editeur']!='')
{  $editeur=$_GET['editeur'];
	$_GET['editeur']=explode(',',$_GET['editeur']);

if($_GET['editeur']['2']!=NULL)
$employee=Employee::get_employee($_GET['editeur']['2']);

if($_GET['editeur']['5']==1)
{
$avis = "Négatif";
}
elseif($_GET['editeur']['5']==2)
{
$avis = "Positif sous réserve";
}
elseif($_GET['editeur']['5']==3)
{
$avis = "Positif";
}

else
{
	$avis =$_GET['editeur']['5'];}

if($_GET['editeur']['6']==3)
{
$delai = "Moins de 3 mois";
}
elseif($_GET['editeur']['6']==2)
{
$delai = "Entre 3 à 6 mois";
}
elseif($_GET['editeur']['6']==1)
{
$delai = "Entre 6 mois à 1 an";
}
 $aff_editeur='<strong>Editeur de requ&ecirc;te</strong> : Type de presta : <font color="#FF0000">'.$_GET['editeur']['0'].' </font>, Statut :  <font color="#FF0000">'.$_GET['editeur']['1'].'</font> , Conseiller :  <font color="#FF0000">'.$employee[0].' '.$employee[1].'</font> , Du <font color="#FF0000">'.$_GET['editeur']['3'].'</font> au <font color="#FF0000">'.$_GET['editeur']['4'].'</font> , Avis : <font color="#FF0000">'.$avis.' </font> , Délai : <font color="#FF0000">'.$delai.' </font><br/>';
 
 $_GET['intitule_editeur']='Type de presta : '.$_GET['editeur']['0'].', Statut : '.$_GET['editeur']['1'].', Conseiller : '.$employee[0].' '.$employee[1].', Du '.$_GET['editeur']['3'].' au '.$_GET['editeur']['4'].', Avis : '.$avis.', Délai : '.$delai.'';
}




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
	
	
	
if 	($_GET['categorie']=='')
	{
	$nom_categorie='Tous';	
	}	
	}
if(isset($_GET['id_ben_delete']))
{
$contact->delete_contact($_GET['id_ben_delete']);
}
if(isset($_GET['limit']))
{}
else
{
$_GET['limit']=$_GET['nbr_resultat'];
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

	
if($GLOBALS['egw_info']['user']['account_primary_group']==-36 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{
	$is_admin=1;
	
}
else
{
	$is_admin=0;
}

?><html><head><script>

// function qui selectionne toutes les cases à cocher
function Check_all(state)
{
  
  var i;
  var tabInput=document.getElementsByTagName("input");
  var n=tabInput.length;
  
  for(i=0;i<n;i++)
  {
  	if(tabInput[i].type=='checkbox')
  	{
  		tabInput[i].checked=state;
  	}
  		
  }
 }</script></head><body>

<center>
<?php  echo $aff_editeur; ?>
<br/>Montre <?php echo $_GET['ligne']; ?> à <?php if($contact->nbr_contact($_GET['mot'],$_GET['categorie'],$_GET['editeur'])< $_GET['ligne']+$_GET['nbr_resultat']){echo $contact->nbr_contact($_GET['mot'],$_GET['categorie'],$_GET['editeur']);}else{echo $_GET['ligne']+$_GET['nbr_resultat']; }?> sur <strong><?php echo $contact->nbr_contact($_GET['mot'],$_GET['categorie'],$_GET['editeur']);?></strong></center><br/>
 <table width="100%" bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0" cols="5">
  <tbody><tr>   

<td valign="top" width="2%" align="left">
	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td><form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']-$_GET['nbr_resultat']; ?>" type="hidden"><input name="domain" value="default" type="hidden"> <input name="mot" type="hidden" value="<?php echo $_GET['mot']; ?>"><input name="categorie" type="hidden" value="<?php echo $_GET['categorie']; ?>"><input name="tri" type="hidden" value="<?php echo $_GET['tri']; ?>"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>"><input name="champ" type="hidden" value="<?php echo $_GET['champ']; ?>"><input name="fleche" type="hidden" value="precedent"><input name="editeur" type="hidden" value="<?php echo $editeur; ?>"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>">

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/left.png" title="Page suivante" name="start" value="<?php echo $_GET['nbr_resultat']; ?>" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form></td>
	</tr>
	</tbody></table>
</td>
   <td valign="top" width="92%" align="center" bgcolor="#ebe8e4">
    <table width="970" border="0" cellpadding="0" cellspacing="0" bgcolor="#ebe8e4">
     <form method="GET" action="index.php" name="filter"><input name="domain" value="default" type="hidden">
      
      <tbody><tr>
      		
       
      		<td width="137"><input type="button" onClick="window.open('editeur_requete.php?domain=default','Editeur','menubar=no, status=no, scrollbars=yes, menubar=no, left=150px, width=450, height=300');" value="Editeur de rêquete" /></td>
      		<td width="181">Nbre de résultat 
      		  <select name="nbr_resultat"><option><?php echo $_GET['nbr_resultat']; ?></option><option>25</option><option >50</option><option>100</option><option>150</option></select></td><td width="652">
      Catégorie : <select name="categorie"><?php echo'<option value="'.$get_orga['cat_id'].'">'.$get_orga['cat_name'].'</option>'; ?>
      <?php
	  for($i=0;$i<count($liste_orga);$i++)
	  {
		 echo'<option value='.$liste_orga[$i]['cat_id'].'>'.$liste_orga[$i]['cat_name'].'</option>';
	  }
      
	  ?></select> <select name="champ"><option value="<?php echo $champ_v; ?>"><?php echo $_GET['champ'] ?></option><option>civilite</option><option>cp</option><option>ville</option><option>fonction</option></select><input name="mot" value="<?php echo $_GET['mot']; ?>" type="text">&nbsp;<input name="editeur" value="<?php echo $editeur; ?>" type="hidden"><input name="Search" value="Chercher" type="submit"></td>
      		
      </tr>
     
    </tbody></form></table></td>
<td valign="top" width="2%" align="right">
<form method="GET" action="index.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']+$_GET['nbr_resultat']; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="categorie" type="hidden" value="<?php echo $_GET['categorie']; ?>"><input name="tri" type="hidden" value="<?php echo $_GET['tri']; ?>"><input name="cla" type="hidden" value="<?php echo $_GET['cla']; ?>"><input name="champ" type="hidden" value="<?php echo $_GET['champ']; ?>"><input name="fleche" type="hidden" value="suivant"><input name="editeur" type="hidden" value="<?php echo $editeur; ?>"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>">

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/right.png" title="Page suivante" name="start" value="<?php echo $_GET['nbr_resultat'];?>" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form>
</td>

  </tr>
 </tbody></table>
<br><table class="calDayViewSideBoxes" width="100%">
<tbody><tr><td></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=a"><font color="{charcolor}">A</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=b">B</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=c">C</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=d">D</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=e">E</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=f">F</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=g">G</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=h">H</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=i">I</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=j">J</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=k">K</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=l">L</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=m">M</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=n">N</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=o">O</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=p">P</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=q">Q</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=r">R</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=s">S</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=t">T</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=u">U</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=v">V</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=w">W</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=x">X</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=y">Y</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=z">Z</font></a><font color="{charcolor}"></font></td><td align="center" bgcolor="{charbgcolor}"><a href="index.php?domain=default&categorie=<?php echo $_GET['categorie']; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>&mot=">Tous</font></a><font color="{charcolor}"></font></td>
</tr>
</tbody></table ><br/>
<table style="border:1px solid #CCC" width="100%"><tr bgcolor="#ebe8e4"> <td></td><td width="38" height="21"></td><td width="90" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=civilite&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Civilité</a></font>
  </td>
  <td width="150" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=nom&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Nom</a></font>
  </td>
  <td width="152" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=prenom&champ=<?php echo $_GET['champ']; ?>&cla=<?php echo $_GET['cla']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Prénom</a></font>
  </td>
  <td width="152" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=fonction&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Fonction</a></font>
  </td>
  <td width="152" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=tel_pro_1&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Téléphone</a></font>
  </td>
    <td width="151" height="21"><font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=email_pro&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Email</a></font></td>
  <td width="66" height="21">
    <font face="Arial, Helvetica, sans-serif" size="-1"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=email_pro&cla=<?php echo $_GET['cla']; ?>"></a></font>
  <a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=cp&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Cp</a></td>
<td width="172" height="21"><a href="index.php?domain=default&mot=<?php echo $_GET['mot']; ?>&categorie=<?php echo $_GET['categorie']; ?>&tri=ville&cla=<?php echo $_GET['cla']; ?>&champ=<?php echo $_GET['champ']; ?>&editeur=<?php echo $editeur; ?>&nbr_resultat=<?php echo $_GET['nbr_resultat']; ?>">Ville</a></td>
  <td width="143" class="body">Actions
 <a onClick="javascript:Check_all(true);"> <img border="0" src="index.php_fichiers/check.png" alt="Sélectionner tout" width="21"  height="16" /></a></td>
</tr>
<?php  if(isset($_GET['tri']) and isset($_GET['cla']))
{
	
$contact->voir_contact($_GET['categorie'],$_GET['mot'],$_GET['ligne'],$_GET['limit'],$GLOBALS['egw_info']['user']['account_id'],$is_admin,$_GET['tri'],$_GET['cla'],$_GET['editeur']);
}
else
{
	
$contact->voir_contact($_GET['categorie'],$_GET['mot'],$_GET['ligne'],$_GET['limit'],$GLOBALS['egw_info']['user']['account_id'],$is_admin,'','',$_GET['editeur']);
}?></table><br/><center><form><input type="button" onClick="window.open('ajouter.php?domain=default','control','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=650, height=520')" value="Ajouter un contact"></form></center>
<?php

// si l'utilisateur clique sur le boutton emailing , la fenetre emailing est appelée avec les emails récupérés ( cases cochées )
if(isset($_GET['emailing']))
{
	
	
	for($i=0;$i<count($_GET['valeur_contact']);$i++)
	{
		$valeur=explode('!',$_GET['valeur_contact'][$i]);
		
		if($adresse==NULL)
		{
		$adresse =$valeur[0];
		}
		elseif($valeur[0]!=NULL)
		{
		$adresse = $adresse.','.$valeur[0];
		}
	}
echo'<script>window.open(\'emailing.php?domain=default&valeur_contact='.$adresse.'\',\'Emailing\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=710, height=700\');</script>';
echo'<script>history.back();</script>';
}
elseif(isset($_GET['excel']))
{
		for($i=0;$i<count($_GET['valeur_contact']);$i++)
	{
		$valeur=explode('!',$_GET['valeur_contact'][$i]);
		
		if($adresse==NULL)
		{
		$adresse =$valeur[1];
		}
		elseif($valeur[1]!=NULL)
		{
		$adresse = $adresse.','.$valeur[1];
		}
	}

	echo'<script>window.open(\'xls.php?domain=default&intitule_requete='.$_GET['intitule_editeur'].'&id_employee='.$GLOBALS['egw_info']['user']['account_id'].'&id_contact='.$adresse.'\',\'Liste excel\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0, width=0, height=0\');</script>';
	echo'<script>history.back();</script>';
}
echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>