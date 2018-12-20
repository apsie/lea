<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => False,
			'currentapp'              => 'Statistique1_1',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.statistique.inc.php");

$statistique = new statistique();
// Statistique des prestations : Initialisation des variables.
$statistique->date_debut_stats = mktime(0,0,0,4,1,2010) ;
$statistique->date_fin_stats = mktime(0,0,0,date('m'),date('d'),date('Y'));

//Statistique des taux d'occupations : Initialisation des variables.
$statistique->date_debut_occupation = mktime(23,0,0,12,31,(date('Y')-1)) ;
$statistique->date_fin_occupation = mktime(0,0,0,11,30,date('Y'));

?><html><body><div style="border:1px solid  #999 ; background: #E9E9E9" align="center">
  <input onClick="document.getElementById('presta').style.display='block';document.getElementById('occupation').style.display='none';document.getElementById('occupation_annee').style.display='none';"  type="button" value="Voir Stats - Presta" /> <input  onClick="document.getElementById('occupation').style.display='block';document.getElementById('presta').style.display='none';document.getElementById('occupation_annee').style.display='none';" type="button" value="Voir Taux d'occupation" /> 
<!--  <input  onClick="document.getElementById('presta').style.display='none';document.getElementById('occupation').style.display='none';document.getElementById('occupation_annee').style.display='block'" type="button" value="Voir Taux d'occupation annee" />-->
</div><br/>
<div style="display:none" id="presta"><center><strong>APSIE_Annexe_II</strong></center><br/>

<?php
$statistique->afficher_historique_stats_presta_APSIE_Annexe_II();

?><br/><center><strong>APSIE_Annexe_IV</strong></center><br/>
<?php
$statistique->afficher_historique_stats_presta_APSIE_Annexe_IV();


?>

<br/><center><form action="../Statistique1_1/xls.php" method="get"><input type="hidden" name="domain" value="default" /><input type="submit" name="xls" value="Générer un fichier .xls"></form></center></div>
<div style="display:block; " id="occupation"><form method="get"><input type="hidden" value="default" name="domain" />Stats de : <?php $statistique->selectionner_conseiller( $statistique->get_conseiller($_GET['conseiller_id']),$_GET['conseiller_id']); ?></form>
  <p>
    <?php
if(!isset($_GET['conseiller_id']))
{
$_GET['conseiller_id']=$GLOBALS['egw_info']['user']['account_id'];
}
if(isset($_GET['conseiller_id']))
{?>
  </p>
  <p align="center">    Taux d'occupation de <strong><?php echo $statistique->get_conseiller($_GET['conseiller_id']); ?></strong></p>
  <table align="center" style="border:1px solid #CCC"><tr style=" color:#FFF;  background-color:#999"><td width="166">&nbsp;</td>
  <td  width="135">Semaine pr&eacute;cedente</td>
  <td  width="135">Semaine courante</td>
  <td  width="135">Semaine suivante</td></tr><tr bgcolor="#FFFFFF"><td>Potentiel</td>
    <td ><?php echo $statistique->potentiel_by_week ; ?> h</td>
    <td ><?php echo $statistique->potentiel_by_week; ?> h</td>
  <td ><?php echo $statistique->potentiel_by_week; ?> h</td></tr><tr  bgcolor="#ECF3F4"><td>RDV Posé</td>
    <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'',-604800); ?> h</td>
    <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id']); ?> h</td>
  <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'',604800); ?> h</td></tr><tr  bgcolor="#FFFFFF"><td>Taux d'occupation</td>
    <td style="color:#0C0"><?php echo round($statistique->taux_occupation($statistique->voir_rdv_semaine($_GET['conseiller_id'],'',-604800)),2); ?> %</td>
    <td style="color:#0C0"><?php echo round($statistique->taux_occupation($statistique->voir_rdv_semaine($_GET['conseiller_id'])),2); ?> %</td>
    <td style="color:#0C0"><?php echo round($statistique->taux_occupation($statistique->voir_rdv_semaine($_GET['conseiller_id'],'',604800)),2); ?> %</td></tr><tr bgcolor="#ECF3F4"><td>RDV A</td>
      <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'A',-604800); ?> h</td>
      <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'A'); ?> h</td>
    <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'A',604800); ?> h</td></tr><tr  bgcolor="#FFFFFF"><td>RDV R</td>
      <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'R',-604800); ?> h</td>
      <td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'R'); ?> h</td>
<td><?php echo $statistique->voir_rdv_semaine($_GET['conseiller_id'],'R'); ?> h</td></tr></table></div>
<?php
}
echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>