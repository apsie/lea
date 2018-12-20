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
	$presta = new presta();
	
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
	?>
	<body><html><head><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>    </head>	
<?php


   
	 if(isset($_GET['statut_epce']) or isset($_GET['presta']))
{
	$lim=explode(",",$_GET['voir']);
	
	
$val=' <a href="suivi_relance_suite.php?nb='.$_GET['nb'].'&presta=EPCE&domain=default&conseiller_id='.$conseiller_id.'&voir='.($lim[0]+10).',10&statut_epce='.$_GET['statut_epce'].'&date_deb='.$_GET['date_debut'].'&date_fin='.$_GET['date_fin'].'"><img src="images/right_16.png" /></a>';
$val2=' <a href="suivi_relance_suite.php?nb='.$_GET['nb'].'&presta=EPCE&domain=default&conseiller_id='.$conseiller_id.'&voir='.($lim[0]-10).',10&statut_epce='.$_GET['statut_epce'].'&date_deb='.$_GET['date_debut'].'&date_fin='.$_GET['date_fin'].'"><img src="images/left_16.png" /></a>';
	 }
 
 if($GLOBALS['egw_info']['user']['account_primary_group']==-36 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{
	$nbr=$presta->nbre_recontact();
}
 
 else
 {
$nbr=$presta->nbre_recontact($GLOBALS['egw_info']['user']['account_id']);
}
$nb=$presta->nbr_presta_epce_relance($conseiller_id,$_GET['presta'],$conseiller_id,"",$_GET['beneficiaire'],$_GET['date_deb'],$_GET['date_fin']);

?><br/>
<div align="center"><a href="index.php?domain=default">RETOUR SUR LE TABLEAU DE BORD</a><br /><br /><?php /*echo '<blink> <img src="images/suivi_icons/bell.png" /> <a target="_blank" onclick="window.open(\'../../presta/epce/control.php?relance_conseiller=1&id='.$GLOBALS['egw_info']['user']['account_id'].'\',\'Relance Conseiller\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\');"><font size="4" color=red>'.$nbr.'</font> relance(s) en attente </a></blink>';*/?><br/><br/><?php if($lim[0]!=0) echo $val2; ?> Montre <?php echo $lim[0].' à ';

if( $lim[1]+$lim[0] >$nb)
{
echo $nb;
$val=NULL;
}
else
{
	echo ($lim[1]+$lim[0]);
	
}

?> sur <?php echo '<strong>-</strong>'; echo $val; ?><br/></div>
<?php /*?><form action="suivi.php" method="get"><div   style=" background: #E9E8FF" align="left"><?php  $presta->selectionner_conseiller($conseiller_id); ?>
<input type="hidden" name="domain" value="default" /><select name="statut_epce"><option value="<?php if(isset($_GET['statut_epce']))echo $_GET['statut_epce']; ?>"><?php if(isset($_GET['statut_epce']))echo $_GET['statut_epce']; ?><option value="">Toutes</option><option value="En cours">En cours</option><option value="Abandon">Abandon</option><option value="A cloturer">A cloturer</option><option value="Complete">Complete</option> <option value="annulee">Annulee</option></select><input type="submit" value="Filtrer" /><?php </div></form>*/?>
<br/> <img src="images/suivi_icons/telephone.png" /> <a target="_blank"  onclick="window.open('../../presta/activite/relance.php?id=<?php echo $GLOBALS['egw_info']['user']['account_id'];?>','Rapport activité','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');">Suivi des relances</a><div style="border:1px solid  #999 ; background: #E9E9E9" align="center"><form action="suivi_relance.php" method="get"><input type="hidden"  name="domain" value="default" /><input type="hidden" name="voir" value="0,10" />
Bénéficiaire : <input value="" type="text" name='beneficiaire' />
 du 

<input type="text" name="date_deb" id="date_deb" value="01/01/2009" />  <script type="text/javascript"> document.writeln('<img id="date_deb-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_deb",
		button      : "date_deb-trigger"
	}
	);</script> 
    au
  <input name="date_fin" id="date_fin" type="text" value="<?php echo date('d/m/Y', strtotime("-12 week"));?>" /> <script type="text/javascript"> document.writeln('<img id="date_fin-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_fin",
		button      : "date_fin-trigger"
	}
	);</script>
<select name="presta"><option value="">Tous les types de prestation</option><option value="EPCE">EPCE</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_SE">EPI_SE</option><option value="EPI_BP">EPI_BP</option></select> <?php $presta->selectionner_conseiller2();?><input type="submit" value="Rechercher" /></form></div><br/><?php
 	if($nb==0)
	{
		echo 'Aucune relance...';
	}
	else
	{
		echo'<table ><tr height="25px" style=" font-weight:bolder" align="center" class="th"><td></td><td>Prestation</td><td>Bénéficiaire</td><td >ID.Prestation</td><td>Debut </td><td>Fin</td><td >Conseiller</td><td>Lieu</td><td>Tel Bureau</td><td>Tel Domicile</td><td>Tel Portable</td><td>Email</td><td>Nbr.</td><td></td></tr>';
	}
 if(isset($_GET['presta']) and $_GET['relance']==1)
 {
	
	 $presta->presta_epce_relance_recontact($GLOBALS['egw_info']['user']['account_id'],$_GET['presta'],$conseiller_id,$_GET['voir']);
	
 }
 
 elseif(isset($_GET['presta']))
 {
	

	
	 $presta->presta_epce_relance($GLOBALS['egw_info']['user']['account_id'],$_GET['presta'],$conseiller_id,$_GET['voir'],$_GET['beneficiaire'],$_GET['date_deb'],$_GET['date_fin'],1);
	
 }
 echo'</table>';

 ?>
 </html></body>
 <?php  
	$GLOBALS['egw']->common->egw_footer();
?>
