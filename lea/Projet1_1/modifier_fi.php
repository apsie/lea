<?php

$GLOBALS['egw_info'] = array(
		'flags' => array(
			'noheader'                => False,
			'nonavbar'                => True,
			'currentapp'              => 'Projet1_1',
			'enable_network_class'    => False,
			'enable_contacts_class'   => False,
			'enable_nextmatchs_class' => False
		)
	);

	include('../header.inc.php');
	include("inc/class.projet.inc.php");
	
	
$projet = new projet();
$valeur=$projet->return_financement($_GET['id_resacc_fi_edit']);




?>
<html><head>
        </head><body>
<center>
  <h2>Modification du financement</h2></center> <center> <br/><br/><form method="get"><input type="hidden" name="domain" value="default" />
      <table style="border:1px solid #CCC"  >
        <tr style="font-weight:bold; background-color: #999; color:#FFF" >
          <td width="84" >D&eacute;signation </td>
          <input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet'] ;?>" />
          <td width="84">Exercice</td>
          <td width="109"  >Type Ressource</td>
          <td width="120" >Intitul&eacute; du compte</td>
          <td width="86" >Montant</td>
          <td width="85" >Type Amt</td>
          <td width="71" >Dur&eacute;e</td>
          <td width="61" >Taux</td>
          <td width="79"></td>
        </tr>
      
        <tr style="text-align:right;border:1px solid #CCC" bgcolor='#ECF3F4'>
          <td><input size="8" type="text" name="designation" value="<?php echo $valeur[0]; ?>" /></td>
          <td><select name="exercice">
          <option value="<?php echo $valeur[1]; ?>"><?php echo $valeur[1]; ?></option>
            <option>Depart</option>
            <option>Annee 1</option>
            <option>Annee 2</option>
            <option>Annee 3</option>
          </select></td>
          <td><select name="ressource">
           <option value="<?php echo $valeur[2]; ?>"><?php echo $valeur[2]; ?></option>
            <?php $projet->texte('Type ressources','','egw_texte_financement');?>
          </select></td>
          <td ><select name="intitule_compte_ressource">
            <option value="<?php echo $valeur[3]; ?>"><?php echo $valeur[3]; ?></option>
            <?php $projet->texte('Entrees Bilan','','egw_texte_financement');?>
          </select></td>
          <td><input size="6" name="montant_ressource"  type="text"  value="<?php echo $valeur[4]; ?>"   /></td>
          <td><select name="type_amt" >
          <option value="<?php echo $valeur[5]; ?>"><?php echo $valeur[5]; ?></option>
            <option>Lin&eacute;aire</option>
            <option>D&eacute;gressif</option>
          </select></td>
          <td><input size="2"  value="<?php echo $valeur[6]; ?>" type="text" name="duree_amt" />
            mois</td>
          <td><input style="width:20px" type="text" value="<?php echo $valeur[7]; ?>" name="tx_amt" />
            %</td>
          <td><input type="hidden" value="<?php echo $_GET['id_resacc_fi_edit']; ?>" name="id_resacc_fi_edit" /><input type="hidden" value="<?php echo $_GET['id_projet']; ?>" name="id_projet" /><input name="modifier_financement" type="submit" value="Modifier" /></td>
        </tr>
      </table>
    <br/></form></center>
   <?php
if(isset($_GET['modifier_financement']))
{
	
	$projet->modifier_fi($GLOBALS['egw_info']['user']['account_id'],$_GET['id_resacc_fi_edit'],$_GET['designation'],$_GET['exercice'],$_GET['ressource'],$_GET['intitule_compte_ressource'],$_GET['montant_ressource'],$_GET['type_amt'],$_GET['duree_amt'],$_GET['tx_amt']);
	/*echo '<script>window.parent.opener.location.reload()</script>';*/
	echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
	echo'<script>window.close();</script>';

}


echo $GLOBALS['egw']->common->egw_footer();
?>
        </body></html>