<?php

//$page=$_GET['page'];

	$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'Presta1_2',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.presta.inc.php");
	include("inc/class.presta_zend.inc.php");
	$presta = new presta();
	$presta_zend = new presta_zend();
	
	if(!isset($_GET['nbr_resultat']))
	{
		$_GET['nbr_resultat']=10;	
	}

	if(isset($_GET['id_presta_mod']))
	{
		
		$presta_zend->update_presta($_GET['id_presta_mod'],$_GET['lc'],$_GET['conseiller_id_ref'],$_GET['date_debut'],$_GET['date_fin_p'],$_GET['date_envoi'],$_GET['statut_mod']);
	}
	if(isset($_GET['id_presta']))
	{
		$variable_presta=$presta_zend->return_variable_presta($_GET['id_presta']);
		if($variable_presta[6]!=0)
		{
			$date_debut = date("d/m/Y",$variable_presta[6]);
		}
		else
		{
			$date_debut = NULL; 
		}
		if($variable_presta[7]!=0)
		{
			$date_fin = date("d/m/Y",$variable_presta[7]);
		}
		else
		{
			$date_fin = NULL;
		}
		if($variable_presta[8]!=0)
		{
			$date_fin_reelle = date("d/m/Y",$variable_presta[8]);
		}
		else
		{
			$date_fin_reelle = NULL;
		}
		if($variable_presta[9]!=0)
		{
			$date_envoi_bilan = date("d/m/Y",$variable_presta[9]);
		}
		else
		{
			$date_envoi_bilan = NULL;
		}
	}
	if(isset($_POST['statut']))
	{//echo $_POST['statut'];echo $_POST['id_ben'] ;
	$presta->maj_statut($_POST['id_ben'],$_POST['statut']);
	}
	if(isset($_GET['conseiller_id']))
	{
		$conseiller_id=$_GET['conseiller_id'];

	}
	else
	{
		$conseiller_id=$GLOBALS['egw_info']['user']['account_id'];
	}


if($_GET['statut_epce']=='Nouvelle')
{
$titre='<h3><img src="images/suivi_icons/application_get.png"> Nouvelles prestations</h3>';
}
elseif($_GET['statut_epce']=='En cours')
{
$titre='<h3><img src="images/suivi_icons/application_edit.png"> Prestations en cours</h3>';
}
elseif($_GET['statut_epce']=='A cloturer')
{
$titre='<h3><img src="images/suivi_icons/application_error.png"> Prestations à clôturer</h3>';
}
elseif($_GET['statut_epce']=='Complete')
{
$titre='<h3><img src="images/suivi_icons/application_link.png"> Prestations Complètes</h3>';
}
elseif($_GET['statut_epce']=='Annulee')
{
$titre='<h3><img src="images/suivi_icons/application_link.png"> Prestations Annulées</h3>';
}
elseif($_GET['statut_epce']=='Abandon')
{
$titre='<h3><img src="images/suivi_icons/application_link.png"> Prestations Abandonnées</h3>';
}
else
{
$titre='<h3><img src="images/suivi_icons/magnifier.png"> Recherche sur "<font color="red">'.$_GET['mot'].'</font>"</h3>';
}




	?>
    	<html><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>    </head>	<body>
<?php
	 if(isset($_GET['statut_epce']))
{
	$lim=explode(",",$_GET['voir']);
	 $nombre=$presta->nb_presta_epce($GLOBALS['egw_info']['user']['account_id'],$_GET['statut_epce'],$conseiller_id,$_GET['mot'],$_GET['presta'],$_GET['date_deb'],$_GET['date_fin']);
	
$val=' <a href="suivi.php?date_deb='.$_GET['date_deb'].'&date_fin='.$_GET['date_fin'].'&mot='.$_GET['mot'].'&nb='.$nombre.'&presta='.$_GET['presta'].'&domain=default&conseiller_id='.$conseiller_id.'&voir='.($lim[0]+$_GET['nbr_resultat']).','.$_GET['nbr_resultat'].'&statut_epce='.$_GET['statut_epce'].'&tri='.$_GET['tri'].'&cla='.$_GET['cla'].'"><img src="images/right_16.png" /></a>';
$val2=' <a href="suivi.php?date_deb='.$_GET['date_deb'].'&date_fin='.$_GET['date_fin'].'&mot='.$_GET['mot'].'&nb='.$nombre.'&presta='.$_GET['presta'].'&domain=default&conseiller_id='.$conseiller_id.'&voir='.($lim[0]-$_GET['nbr_resultat']).','.$_GET['nbr_resultat'].'&statut_epce='.$_GET['statut_epce'].'&tri='.$_GET['tri'].'&cla='.$_GET['cla'].'"><img src="images/left_16.png" /></a>';
	 }
 
 if($_GET['cla']=='desc'  )
{
	$_GET['cla']='asc';

}
elseif($_GET['cla']=='asc' or  $_GET['cla']==NULL)
{
	$_GET['cla']='desc';

}
if($_GET['tri']==NULL)
{
	$_GET['tri']='date_debut';

}
if(isset($_GET['ligne']))
{}
else
{
$_GET['ligne']=0;
}


?>
<div align="center"> <?php echo $titre ; ?>


<center>Montre <?php echo $_GET['ligne']; ?> à <?php if($presta->nb_presta_epce($GLOBALS['egw_info']['user']['account_id'],$_GET['statut_epce'],$conseiller_id,$_GET['mot'],$_GET['presta'],$_GET['date_deb'],$_GET['date_fin']) < $_GET['ligne']+$_GET['nbr_resultat']){echo $presta->nb_presta_epce($GLOBALS['egw_info']['user']['account_id'],$_GET['statut_epce'],$conseiller_id,$_GET['mot'],$_GET['presta'],$_GET['date_deb'],$_GET['date_fin']);}else{echo $_GET['ligne']+$_GET['nbr_resultat']; }?> sur <strong><?php echo $presta->nb_presta_epce($GLOBALS['egw_info']['user']['account_id'],$_GET['statut_epce'],$conseiller_id,$_GET['mot'],$_GET['presta'],$_GET['date_deb'],$_GET['date_fin']);?></strong></center><br/>
</div>
<?php /*?><form action="suivi.php" method="get"><div   style=" background: #E9E8FF" align="left"><?php  $presta->selectionner_conseiller($conseiller_id); ?>
<input type="hidden" name="domain" value="default" /><select name="statut_epce"><option value="<?php if(isset($_GET['statut_epce']))echo $_GET['statut_epce']; ?>"><?php if(isset($_GET['statut_epce']))echo $_GET['statut_epce']; ?><option value="">Toutes</option><option value="En cours">En cours</option><option value="Abandon">Abandon</option><option value="A cloturer">A cloturer</option><option value="Complete">Complete</option> <option value="annulee">Annulee</option></select><input type="submit" value="Filtrer" /><?php </div></form>*/?>

<div style=" background: #E9E9E9" align="center"><table><tr><td width="40"><form method="GET" action="suivi.php" >
<input name="ligne" value="<?php echo $_GET['ligne']-$_GET['nbr_resultat']; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="statut_epce" value="<?php echo $_GET['statut_epce']; ?>" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>"><input name="conseiller_id" value="<?php echo $conseiller_id; ?>" type="hidden"><input name="presta" value="<?php echo $_GET['presta']; ?>" type="hidden"><input name="date_deb" value="<?php echo $_GET['date_deb']; ?>" type="hidden"><input name="date_fin" value="<?php echo $_GET['date_fin']; ?>" type="hidden">
	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	  <tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/left.png" title="Page précédente" name="start" value="<?php echo $_GET['nbr_resultat']; ?>" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form><td align="center" width="1214"><form action="suivi.php" method="get"><input type="hidden"  name="domain" value="default" /><input type="hidden" name="presta" value="<?php echo $_GET['presta'];?>" /><input type="hidden" name="nb" value="<?php echo  $nombre;?>" /><input type="hidden" name="statut_epce" value="<?php echo $_GET['statut_epce'];?>" />
Nbre de résultat 
      		  <select name="nbr_resultat"><option><?php echo $_GET['nbr_resultat']; ?></option><option>10</option><option>25</option><option >50</option></select> Bénéficiaire : <input value="<?php echo $_GET['mot']; ?>" type="text" name='mot' />
 du 

<input type="text" size="8" name="date_deb" id="date_deb" value="<?php echo $_GET['date_deb'] ;?>" />  <script type="text/javascript"> document.writeln('<img id="date_deb-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_deb",
		button      : "date_deb-trigger"
	}
	);</script> 
    au
  <input size="8" name="date_fin" id="date_fin" type="text" value="<?php echo $_GET['date_fin'] ;?>" /> <script type="text/javascript"> document.writeln('<img id="date_fin-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin",
		button      : "date_fin-trigger"
	}
	);</script><?php $presta->selectionner_conseiller3($_GET['conseiller_id']);?> <input type="submit" value="Rechercher" /> <input onClick="document.location.href='index.php?domain=default'" type="button" value="Retour au tableau de bord" />
</form></td><td width="40"><form method="GET" action="suivi.php" >
	<input name="ligne" value="<?php echo $_GET['ligne']+$_GET['nbr_resultat']; ?>" type="hidden"><input name="domain" value="default" type="hidden"><input name="statut_epce" value="<?php echo $_GET['statut_epce']; ?>" type="hidden"><input name="mot" value="<?php echo $_GET['mot']; ?>" type="hidden"><input name="nbr_resultat" type="hidden" value="<?php echo $_GET['nbr_resultat']; ?>"><input name="conseiller_id" value="<?php echo $conseiller_id; ?>" type="hidden"><input name="presta" value="<?php echo $_GET['presta']; ?>" type="hidden"><input name="date_deb" value="<?php echo $_GET['date_deb']; ?>" type="hidden"><input name="date_fin" value="<?php echo $_GET['date_fin']; ?>" type="hidden">

	<table bgcolor="" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="right">
			<input src="index.php_fichiers/right.png" title="Page suivante" name="start" value="<?php echo $_GET['nbr_resultat']; ?>" type="image" border="0">
		</td>
	</tr>
	</tbody></table>
</form></td></tr></table></div>

<br/><center>
 <?php if(isset($_GET['presta']))
 {
	 if(isset($_GET['mot']) and $_GET['mot']!=NULL)
	 {
		 $mot=$_GET['mot'];
	 }
	 else
	 {
		 $mot=NULL;
	 }
	 if($_GET['relance']==1)
	 {
	 $presta->presta_epce($GLOBALS['egw_info']['user']['account_id'],"relance",$conseiller_id,$mot,$_GET['ligne'],$_GET['nbr_resultat'], $nombre,$_GET['date_deb'],$_GET['date_fin']);
	 }
	 else
	 {
 $presta->presta_epce($GLOBALS['egw_info']['user']['account_id'],$_GET['statut_epce'],$conseiller_id,$mot,$_GET['ligne'],$_GET['nbr_resultat'], $nombre,$_GET['presta'],$_GET['date_deb'],$_GET['date_fin'],$_GET['tri'],$_GET['cla']);
	 }
 }
 ?>
 </table></center>

<br/><div id='presta_form' name='presta_form' style="position:absolute; display:none; left: 448px; top: 30%; width: 389px; height: 226px;"><form action="suivi.php" method="get"><input type="hidden" name="id_presta_mod" value="<?php echo $variable_presta[0];?>" /><input type="hidden" name="nbr_resultat" value="<?php echo $_GET['nbr_resultat']; ?>" /><input type="hidden" name="ligne" value="<?php echo $_GET['ligne']; ?>" /><input type="hidden" name="statut_epce" value="<?php echo $_GET['statut_epce']; ?>" /><input type="hidden" name="conseiller_id" value="<?php echo $conseiller_id; ?>" /><input type="hidden" name="nb" value="<?php echo $_GET['nb']; ?>" /><input type="hidden" name="presta" value="<?php echo $_GET['presta']; ?>" /><input type="hidden" name="mot" value="<?php echo $_GET['mot']; ?>" /><input type="hidden" name="date_deb" value="<?php echo $_GET['date_deb']; ?>" /><input type="hidden" name="date_fin" value="<?php echo $_GET['date_fin']; ?>" /><input type="hidden" name="mot" value="<?php echo $_GET['mot']; ?>" /><input type="hidden" name="domain" value="default" /><table  width="379" height="246" style="-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;border: 1px dashed  #666;background-color: #F5F5F5;padding:15px;">
  <tr><td height="30">Prestataire</td><td><?php echo $variable_presta[1];?></td></tr><tr><td height="30">Prestation</td><td><?php echo $variable_presta[2];?></td></tr><tr ><td height="30">Bénéficiaire</td><td><?php echo $variable_presta[3];?></td></tr><tr ><td height="30">LC</td><td><input type="text" name="lc" value="<?php echo $variable_presta[5];?>" /> <font color="#FF0000">*</font></td></tr><tr ><td height="30">Conseiller</td><td><?php  echo $presta_zend->selectionner_conseiller3($variable_presta[4]); ?></td><tr ><td height="30">Date de début</td><td><input  type="text"  name="date_debut" id="date_debut"   value="<?php echo $date_debut;?>" /> <script type="text/javascript">

	document.writeln('<img id="date_debut-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_debut",
		button      : "date_debut-trigger"
	}
	);
</script></td></tr><tr ><td height="30">Date de fin prévisionnelle</td><td><input  type="text"  id="date_fin_p" name="date_fin_p"  value="<?php echo $date_fin;?>" /> <script type="text/javascript">

	document.writeln('<img id="date_fin_p-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin_p",
		button      : "date_fin_p-trigger"
	}
	);
</script></td></tr>
<tr><td height="30">Date de fin réelle</td><td><?php echo $date_fin_reelle;?></td></tr><tr><td height="30">Date d'envoi du bilan</td><td><input  type="text"  id="date_envoi" name="date_envoi"  value="<?php echo $date_envoi_bilan;?>"/> <script type="text/javascript">

	document.writeln('<img id="date_envoi-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_envoi",
		button      : "date_envoi-trigger"
	}
	);
</script></td></tr><tr><td height="30">Statut</td><td><select style="width:150px" name="statut_mod"><option value="<?php echo $variable_presta[10];?>"><?php echo $variable_presta[10];?></option><option value="En cours">En cours</option><option value="Complete">Complete</option><option value="Abandon">Abandon</option><option value="Annulee">Annulee</option></select></td></tr><tr><td align="right" ><input type="button" onClick="document.getElementById('presta_form').style.display='none';" value="Fermer"  /></td><td><input onClick="document.getElementById('presta_form').style.display='none';" type="submit" value="Enregistrer" /></td></tr></table></form></div>

<?php
if(isset($_GET['modifier']))
	{
	echo"<script>document.getElementById('presta_form').style.display='block';</script>";
	}
	?>
	</body></html><?php
echo $GLOBALS['egw']->common->egw_footer();
?>
