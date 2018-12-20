<?php
include('../../Classes/config/config_egw_version.php');
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
	include("inc/class.contact.inc.php");
	include('../../Classes/config/inc_apsie/Fichier.php');

	
$contact = new contact();
$fichier = new Fichier();

$identite=$contact->get_identite($_GET['id_ben']);
$etat_civil=$contact->get_etat_civil($_GET['id_ben']);
$coordonnee=$contact->get_coordonnee($_GET['id_ben']);
$projet=$contact->get_projet($_GET['id_ben']);

if($etat_civil[0]!=0  )
{
	$etat_civil[0] = date("d/m/Y",$etat_civil[0]);
}
else
{
	$etat_civil[0] = NULL;
}
if($projet[2]!=0 )
{
	$projet[2] = date("d/m/Y",$projet[2]);
}
else
{
	$projet[2] = NULL;
}
if($projet[3]!=0 )
{
	$projet[3] = date("d/m/Y",$projet[3]);
}
else
{
	$projet[3] = NULL;
}

if($projet[4]!=0)
{
	$projet[4] = date("d/m/Y",$projet[4]);
}
else
{
	$projet[4] = NULL;
}

if(isset($_GET['id_fichier_delete']))
{
$fichier->delete_fichier($_GET['id_fichier_delete']);
}
?><html><body>

<table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
     
      
      <tbody><tr>
      		
   <td width="1313px"><center><input value="Modifier"  onclick="window.open('modifier.php?categorie=<?php echo $_GET['categorie'];?>&id_ben=<?php echo $_GET['id_ben'];?>&id=<?php echo $GLOBALS['egw_info']['user']['account_id']; ?>','PANEL','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=750, height=470');"  type="button"> <input value="Retour" onClick="window.location.href='index.php?domain=default'" type="button"></center></td>
      		
      </tr>
    </tbody></table>

<!--div ligne 1-->
<div id="ligne1"  >

<!--div_coordonnées perso-->
<div style="float:left; width:24%;" ><table><tr><td width="342"><a href="#" onClick="if(document.getElementById('coordonnee').style.display == 'block') {document.getElementById('coordonnee').style.display ='none';document.getElementById('ligne1').style.height=0+'px';} else {document.getElementById('coordonnee').style.display ='block'; document.getElementById('ligne1').style.height=450+'px';} ">
    <img src="images/address.png"> <strong>COORDONNEES PERSO</strong>
</a></td></tr></table><table   id="coordonnee" onMouseOver="document.getElementById('coordonnee').style.backgroundColor='#BCF0F3'" onMouseOut="document.getElementById('coordonnee').style.backgroundColor='#FFF'" style=" display:none;background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
 
  <tr>
  <td width="136">Rue <a href="">( Google Map )</a></td><td>:<td></td><td width="192"><?php  echo $coordonnee[0]; ?></td></tr> <tr>
  <td width="136">Adresse ligne 2 </td><td>:<td></td><td width="192"><?php  echo $coordonnee[1]; ?></td></tr><tr>
  <td width="136">Adresse ligne 3  </td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[2]; ?></td></tr><tr>
  <td width="136">Code postal </td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[3]; ?></td></tr><tr>
  <td width="136">Ville</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[4]; ?></td></tr><tr>
  <td width="136">R&eacute;gion</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[5]; ?></td></tr><tr>
  <td width="136">Pays</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[6]; ?></td></tr><tr>
  <td width="136">Tel pro</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[7]; ?></td></tr><tr>
  <td width="136">Tel pro 2</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[8]; ?></td></tr><tr>
  <td width="136">Tel domicile</td><td>:<td></td>
<td width="192"><?php  echo $coordonnee[9];?></td></tr><tr>
  <td width="136">Tel domicile 2</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[10]; ?></td></tr><tr>
  <td width="136">Portable pro</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[11];?></td></tr><tr>
  <td width="136">Portable perso</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[12]; ?></td></tr><tr>
  <td width="136">Email domicile</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[13]; ?></td></tr><tr>
  <td width="136">Email pro</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[14]; ?></td></tr><tr>
  <td width="136">Fax domicile</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[15]; ?></td></tr><tr>
  <td width="136">Fax pro</td>
  <td>:<td></td>
<td width="192"><?php  echo $coordonnee[16]; ?></td></tr><tr>
  <td width="136">Site perso</td>
  <td>:<td></td>
<td width="192"><a  target="_blank" href="http://<?php  echo $coordonnee[17]; ?>"><?php  echo $coordonnee[17]; ?></a></td></tr></table></div>

<!--div etat_civil-->
<div   style="float:left; width:24%" >

<table><tr><td width="342"><a href="#" onClick="if(document.getElementById('etat_civil').style.display == 'block') {document.getElementById('etat_civil').style.display ='none';document.getElementById('ligne1').style.height=0+'px';} else {document.getElementById('etat_civil').style.display ='block';document.getElementById('ligne1').style.height=450+'px';} "><img src="images/etat_civil.png"> <strong>ETAT CIVIL</strong></a></td></tr></table><table  id="etat_civil" onMouseOver="document.getElementById('etat_civil').style.backgroundColor='#FFFF99'" onMouseOut="document.getElementById('etat_civil').style.backgroundColor='#FFF'" style="display:none; background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
 
  <tr>
  <td width="136">Civilité </td><td>:<td></td><td width="192"><?php  echo $identite[2]; ?></td></tr> <tr>
  <td width="136">Nom </td><td>:<td></td><td width="192"><?php  echo $identite[0]; ?></td></tr><tr>
  <td width="136">Nom de jeune fille  </td><td>:<td></td>
<td width="192"><?php  echo $identite[4]; ?></td></tr><tr>
  <td width="136">Pr&eacute;nom  </td><td>:<td></td>
<td width="192"><?php  echo $identite[1]; ?></td></tr><tr>
  <td width="136">Deuxi&egrave;me pr&eacute;nom  </td><td>:<td></td>
<td width="192"><?php  echo $identite[3]; ?></td></tr><tr>
  <td width="136">Date de naissance  </td><td>:<td></td>
<td width="192"><?php  echo $etat_civil[0]; ?></td></tr><tr>
  <td width="136">Lieu de naissance  </td><td>:<td></td>
<td width="192"><?php  echo $etat_civil[1]; ?></td></tr><tr>
  <td width="136">Nationalité </td><td>:<td></td>
<td width="192"><?php  echo $etat_civil[2]; ?></td></tr><tr>
  <td width="136">Situation maritale </td><td>:<td></td>
<td width="192"><?php  echo $etat_civil[3]; ?></td></tr><tr>
  <td width="136">Enfants à charge  </td><td>:<td></td>
<td width="192"><?php  echo $etat_civil[4]; ?></td></tr></table></div>



<!--div projet-->
<div  style="float:left; width:24%" >
<table><tr><td width="371"><a href="#" onClick="if(document.getElementById('projet').style.display == 'block') {document.getElementById('projet').style.display ='none';document.getElementById('ligne1').style.height=0+'px';} else {document.getElementById('projet').style.display ='block';document.getElementById('ligne1').style.height=250+'px';}  ">
        <img src="images/projet.png"> <strong>PROJET</strong>
</a></td></tr></table><table  id="projet"  onMouseOver="document.getElementById('projet').style.backgroundColor='#CFFAB4'" onMouseOut="document.getElementById('projet').style.backgroundColor='#FFF'" style="display:none; background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
  <tr>
  <td width="136">Intitul&eacute; du projet</td><td width="3">:<td width="0"></td><td width="222"><a href="../Projet1_1/details.php?id_projet=<?php  echo $projet[8]; ?>&domain=default"><?php  echo $projet[0]; ?></a></td></tr> <tr>
  <td width="136">Description du projet</td><td>:<td></td><td width="222"><?php  echo $projet[1]; ?></td></tr><tr>
  <td width="136">Date de d&eacute;but</td><td>:<td></td>
<td width="222"><?php  echo $projet[2]; ?></td></tr><tr>
  <td width="136">Date de fin</td><td>:<td></td>
<td width="222"><?php  echo $projet[3]; ?></td></tr><tr>
  <td width="136">Date de fin r&eacute;elle</td><td>:<td></td>
<td width="222"><?php  echo $projet[4]; ?></td></tr><tr>
  <td width="136">Coordinateur</td><td>:<td></td>
<td width="222"><a href=""><?php  echo $contact->get_account($projet[5]); ?></a></td></tr><tr>
  <td width="136">Statut</td><td>:<td></td>
<td width="222"><?php  echo $projet[6]; ?></td></tr><tr>
  <td width="136">R&eacute;sultat</td><td>:<td></td>
<td width="222"><?php  echo $projet[7]; ?></td></tr></table></div></div><div style="float:left; width:24%;" ><table><tr><td width="342"><a href="#" onClick="if(document.getElementById('fichier').style.display == 'block') {document.getElementById('fichier').style.display ='none';document.getElementById('ligne1').style.height=0+'px';} else {document.getElementById('fichier').style.display ='block'; } ">
    <img src="images/doc.png"> <strong>FICHIERS PERSO</strong>(<?php echo $fichier->nbr_fichier($_GET['id_ben']); ?>)
</a></td></tr></table>
<table  width="100%" id="fichier" onMouseOver="document.getElementById('fichier').style.backgroundColor='#FAFDBD' " onMouseOut="document.getElementById('fichier').style.backgroundColor='#FFF'" style=" display:none;background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;">
 
  <tr><td>
  <img src="./images/charger.png" /><a onClick="window.open('../Fichier1_0/charger_fichier.php?id_contact=<?php echo $_GET['id_ben']; ?>','Charger un fichier','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=400, height=300');" href="">Charger un fichier</a>
  <?php
  
 
  
$fichier->lister_fichier($_GET['id_ben']); ?>

 </td></tr> </table></div>

<!--div ligne2-->
<div>

<!--div formation-->
<div  style="float:left; width:24%" >
<table><tr><td width="371">
         <a href="#" onClick="if(document.getElementById('formation').style.display == 'block') {document.getElementById('formation').style.display ='none';} else {document.getElementById('formation').style.display ='block';} "><img src="images/library.png"> <strong>FORMATIONS</strong> (<?php echo $contact->nbr_formations($_GET['id_ben']); ?>)</a>
<table  id="formation"    onMouseOver="document.getElementById('formation').style.backgroundColor='#DBC4B5'" onMouseOut="document.getElementById('formation').style.backgroundColor='#FFF'" style=" display:none;background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;"><?php $contact->get_formation($_GET['id_ben']); ?></table></td></tr></table></div>

<!--div parcours_pro-->
<div   style="float:left; width:24%">
<table><tr><td width="371"><a href="#" onClick="if(document.getElementById('pro').style.display == 'block') {document.getElementById('pro').style.display ='none';} else {document.getElementById('pro').style.display ='block';} ">

        <img src="images/emploi.png"> <strong>PARCOURS PRO</strong> (<?php echo $contact->nbr_parcours_pro($_GET['id_ben']); ?>)
</a><table  id="pro"  onMouseOver="document.getElementById('pro').style.backgroundColor='#FFC4C5'" onMouseOut="document.getElementById('pro').style.backgroundColor='#FFF'" style="display:none; background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;"><?php $contact->get_parcours_pro($_GET['id_ben']); ?></table></td></tr></table></div>

<!--div presta-->
<div  style="float:left; width:24%"  >
<table><tr><td width="371"><a href="#" onClick="if(document.getElementById('presta').style.display == 'block') {document.getElementById('presta').style.display ='none';} else {document.getElementById('presta').style.display ='block';} ">
        <img src="images/administrative-docs.png"> <strong>PRESTA</strong> (<?php echo $contact->nbr_presta($_GET['id_ben'],$GLOBALS['egw_info']['user']['account_id']); ?>)
</a><table  id="presta"    onMouseOver="document.getElementById('presta').style.backgroundColor='#E2E2E2'" onMouseOut="document.getElementById('presta').style.backgroundColor='#FFF'" style="display:none; background:#FC6;border:1px solid #CCC; background-color:#FFF; padding:10px;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;"><?php $contact->get_presta($_GET['id_ben'],$GLOBALS['egw_info']['user']['account_id']); ?></table></td></tr></table></div>
</div>




<!--div_fichier-->









  <?php

echo $GLOBALS['egw']->common->egw_footer();
?>

</body></html>