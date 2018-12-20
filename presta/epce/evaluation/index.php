<?php

//$page=$_GET['page'];

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'Presta1.2',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.presta.inc.php");
	include("../../presta/inc/class.rapport_activite.inc.php");
	
	
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
	

	$presta = new presta();
	$rapport = new Rapport_activite($conseiller_id);
	$rapport->action('consulte le tableau de bord des prestations');
	
if($GLOBALS['egw_info']['user']['account_primary_group']==-36 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{
$cloturer_id="";
$cloturer=$presta->epce_stats('A cloturer',0,'EPCE');
$cours_id="";
$cours=$presta->epce_stats('En cours',0);
$cours_nacre1=$presta->epce_stats('En cours',0,'NACRE1');
$nouvelle_id="";
$nouvelle=$presta->epce_stats('Nouvelle',0,'EPCE');
$nouvelle_nacre1=$presta->epce_stats('Nouvelle',0,'NACRE1');
$relance=$presta->epce_relance(0);
$relance_id="";
}
else
{
$cloturer_id=$GLOBALS['egw_info']['user']['account_id'];
$cloturer= $presta->epce_stats('A cloturer',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$cours_id=$GLOBALS['egw_info']['user']['account_id'];
$cours=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id']);
$cours_nacre1=$presta->epce_stats('En cours',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$nouvelle_id=$GLOBALS['egw_info']['user']['account_id'];
$nouvelle=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'EPCE');
$nouvelle_nacre1=$presta->epce_stats('Nouvelle',$GLOBALS['egw_info']['user']['account_id'],'NACRE1');
$relance=$presta->epce_relance($GLOBALS['egw_info']['user']['account_id']);
$relance_id=$GLOBALS['egw_info']['user']['account_id'];;
}
	 if($GLOBALS['egw_info']['user']['account_primary_group']==-36 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{
	$nbr=$presta->nbre_recontact();
}
 
 else
 {
$nbr=$presta->nbre_recontact($GLOBALS['egw_info']['user']['account_id']);
}

?><?php if($GLOBALS['egw_info']['user']['account_primary_group']==-2 or $GLOBALS['egw_info']['user']['account_primary_group']==-3 or $GLOBALS['egw_info']['user']['account_primary_group']==-1)
{?><div><form action="" method="get" >
    <img src="images/calendar_16.png" /> <a onclick="window.open('../../presta/epce/control.php?option=1&id=<?php echo $GLOBALS['egw_info']['user']['account_id']; ?>','Poser des options','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=500, height=300');" target="_blank" >Poser des options</a> | <img src="images/clock_16.png" /> <a target="_blank" onclick="window.open('../../presta/epce/control.php?confirmer=1&id=<?php echo $GLOBALS['egw_info']['user']['account_id']; ?>','Poser des options','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" >Confirmer des options</a> | <img src="../../presta/epce/images/icons/clipboard_text.png"  /> <a onclick="window.open('../../presta/activite/rapport.php','Rapport activité','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" target="_blank" >Rapport d'activit&eacute;</a> | <img src="images/suivi_icons/telephone.png" /> <a target="_blank"  onclick="window.open('../../presta/activite/relance.php','Rapport activité','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');">Suivi des relances</a> | <img src="images/suivi_icons/application_osx.png" /> <a onclick="window.open('../../../presta/epce/control.php?nouveau_epce=1&prenom_conseiller=<?php echo $GLOBALS['egw_info']['user']['firstname'];?>&nom_conseiller=<?php echo $GLOBALS['egw_info']['user']['lastname'];?>&id=<?php echo $GLOBALS['egw_info']['user']['account_id'];?>','Nouveau Benéficiaire','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768');" target="_blank" >PANEL EPCE</a>
    <input type="hidden" value="default" name="domain" /></form> <input type="hidden" name="domain" value="default" /></div><?php } ?><div style="border:1px solid  #999 ; background: #E9E9E9" align="center"><form action="suivi.php" method="get"><input type="hidden"  name="domain" value="default" /><input type="hidden" name="voir" value="0,10" />
<input type="text" name='mot'/> <select name="presta"><option value="0">Toutes les prestations</option><option value="EPCE">EPCE</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_SE">EPI_SE</option><option value="EPI_BP">EPI_BP</option></select> <input type="submit" value="Rechercher" /></form></div><br/>
<br/>
<div align="center">
  <table>
    <tr><td width="213"><table width="213"  style="background:url(images/custom/tableau_bord_venir.png) no-repeat; font-size:13px"><tr><td width="105" height="36">&nbsp;</td>
<td align="center" width="96">&nbsp;</td></tr><tr><td height="20">&nbsp;</td>
<td align="center"><a href="suivi.php?nb=<?php echo $nouvelle; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle; ?></a></td></tr><tr><td height="23" >&nbsp;</td>
<td align="center"><a href="suivi.php?nb=<?php echo $nouvelle_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=Nouvelle"><?php echo $nouvelle_nacre1; ?></a></td></tr><tr><td height="18">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="22">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="132">&nbsp;</td>
<td align="center">&nbsp;</td></tr></table></td><td width="216" height="338"><table width="213"  style="background:url(images/custom/tableau_bord.png) no-repeat; font-size:13px"><tr><td width="105" height="36">&nbsp;</td>
<td align="center" width="96">&nbsp;</td></tr><tr><td height="20">&nbsp;</td>
<td align="center"><a href="suivi.php?nb=<?php echo $cours; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $cours_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours; ?></a></td></tr><tr><td height="23" >&nbsp;</td>
<td align="center"><a href="suivi.php?nb=<?php echo $cours_nacre1; ?>&presta=NACRE1&domain=default&conseiller_id=<?php echo $nouvelle_id; ?>&voir=0,10&statut_epce=En cours"><?php echo $cours_nacre1; ?></a></td></tr><tr><td height="18">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="22">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr><td height="132">&nbsp;</td>
<td align="center">&nbsp;</td></tr></table></td><td width="211"><table width="215" height="336"  style="background:url(images/custom/tableau_bord_clo.png) no-repeat;"><tr><td width="80" height="39"></td><td width="123"></td></tr>
  <td height="21">&nbsp;</td>
<td align="center"><a href="suivi.php?nb=<?php echo $cloturer; ?>&presta=EPCE&domain=default&conseiller_id=<?php echo $cloturer_id; ?>&voir=0,10&statut_epce=A cloturer"><?php echo $cloturer;?></a></td></tr><tr>
  <td height="21" >&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="128">&nbsp;</td>
<td align="center">&nbsp;</td></tr></table></td><td><table width="215" height="334"  style="background:url(images/custom/tableau_relance.png) no-repeat;"><tr><td width="101" height="37">&nbsp;</td>
<td align="center" width="102"></td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center"><a href="suivi_relance.php?nb=<?php echo $relance; ?>&statut_epce=relance&presta=EPCE&domain=default&voir=0,10&conseiller_id=<?php echo $relance_id; ?>"></a><a href="suivi_relance.php?nb=<?php echo $relance; ?>&statut_epce=relance&presta=EPCE&domain=default&voir=0,10&conseiller_id=<?php echo $relance_id; ?>"><?php echo $relance; ?></a></td></tr><tr>
  <td height="21" >&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="21">&nbsp;</td>
<td align="center">-</td></tr><tr>
  <td height="128">&nbsp;</td>
<td align="center">&nbsp;</td></tr></table></td></tr></table>
 <table><tr><td width="20"><img src="images/suivi_icons/comment.png" /> </td>
  <td width="657">EPCE : Toutes les &eacute;tapes doivent &ecirc;tre <strong>valid&eacute;es</strong> , afin de sauvegarder le bilan<a target="_blank" href="https://spreadsheets.google.com/ccc?key=0Ag85m8cdftOMdG8wa3pyUnZ0VW94Y1NoR2JMR3VmWUE&hl=fr#gid=0">.</a></td></tr><tr><td><img src="images/suivi_icons/comment.png" /> </td>
  <td>EPCE - abandon : Lors d'un abandon , les &eacute;tapes &quot;non valid&eacute;es&quot; sont consid&eacute;r&eacute;es comme <strong>abandonn&eacute;es</strong></td></tr><tr><td width="20"><img src="images/suivi_icons/comment.png" /> </td>
  <td width="317">Reportez vos bugs sur le <a target="_blank" href="https://spreadsheets.google.com/ccc?key=0Ag85m8cdftOMdG8wa3pyUnZ0VW94Y1NoR2JMR3VmWUE&hl=fr#gid=0">Rapport de bug</a></td></tr></table>
</div>

<?php if(isset($_GET['maj']))
					 {
						$presta->maj_link_rdv();
					}
					
                   /* <a href="suivi.php?nb=<?php echo $relance; ?>&presta=EPCE&relance=1&domain=default&voir=0,10&conseiller_id=<?php echo $relance_id; ?>"><?php echo $relance; ?></a>*/?><?php

echo $GLOBALS['egw']->common->egw_footer();
?>