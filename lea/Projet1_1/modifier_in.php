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
$valeur=$projet->return_investissement($_GET['id_resacc_in_edit']);




?>
<html><head>
<script>
	function return_immo(selectId)
		{
			
		
	/**On récupère l'élement html <select>*/
	var selectElmt = document.getElementById(selectId);
	
	/**
	selectElmt.options correspond au tableau des balises <option> du select
	selectElmt.selectedIndex correspond à l'index du tableau options qui est actuellement sélectionné
	*/
	//document.getElementById('pau_ht').value=selectElmt.options[selectElmt.selectedIndex].value;
	if(selectElmt.options[selectElmt.selectedIndex].value==110)
	{
	document.getElementById('intitule_compte').options[0].text="Stock de depart";
	document.getElementById('intitule_compte').options[1].text="Besoin en fonds de roulement (dont tréso au démarr.)";
	document.getElementById('intitule_compte').options[2].text=null;
    document.getElementById('intitule_compte').options[3].text=null;
	document.getElementById('intitule_compte').options[4].text=null;
	document.getElementById('intitule_compte').options[5].text=null;
	document.getElementById('intitule_compte').options[6].text=null;
	document.getElementById('intitule_compte').options[7].text=null;
	document.getElementById('intitule_compte').options[8].text=null;
	document.getElementById('intitule_compte').options[9].text=null;
	document.getElementById('intitule_compte').options[10].text=null;
		document.getElementById('intitule_compte').options[11].text=null;
			document.getElementById('intitule_compte').options[12].text=null;
	}
	else if(selectElmt.options[selectElmt.selectedIndex].value==108)
	{
	document.getElementById('intitule_compte').options[0].text="Fonds commerce (corporel)";
	document.getElementById('intitule_compte').options[1].text="Terrain";
	document.getElementById('intitule_compte').options[2].text="Matériel et outillage";
	document.getElementById('intitule_compte').options[3].text="Installation technique, aménagement";
	document.getElementById('intitule_compte').options[4].text="Matériel de transport";
	document.getElementById('intitule_compte').options[5].text="Matériel bureautique, informatique";
	document.getElementById('intitule_compte').options[6].text="Mobilier";
	document.getElementById('intitule_compte').options[7].text="Autre (préciser)";
	document.getElementById('intitule_compte').options[8].text=null;
	document.getElementById('intitule_compte').options[9].text=null;
	document.getElementById('intitule_compte').options[10].text=null;
		document.getElementById('intitule_compte').options[11].text=null;
			document.getElementById('intitule_compte').options[12].text=null;
	}
	else if(selectElmt.options[selectElmt.selectedIndex].value==107)
	{
	document.getElementById('intitule_compte').options[0].text="Frais d'établissement";
	document.getElementById('intitule_compte').options[1].text="Concession, brevet, marque, licences, logiciels";
	document.getElementById('intitule_compte').options[2].text="Droit de mutation";
	document.getElementById('intitule_compte').options[3].text="Honoraires";
	document.getElementById('intitule_compte').options[4].text="Frais dossier banque+ frais garantie FAG ou FGIF";
	document.getElementById('intitule_compte').options[5].text="Droits au bail - Pas de porte";
	document.getElementById('intitule_compte').options[6].text="Fonds commerce (incorporel)";
	document.getElementById('intitule_compte').options[7].text="Licence IV";
	document.getElementById('intitule_compte').options[8].text="Frais d'agence immobilière";
	document.getElementById('intitule_compte').options[9].text="Publicité de Démarrage";
	document.getElementById('intitule_compte').options[10].text="1er loyer crédit bail 1 HT";
	document.getElementById('intitule_compte').options[11].text="1er loyer crédit bail 2 HT";
	document.getElementById('intitule_compte').options[12].text="Frais soutien commercial";
	
	}
	else if(selectElmt.options[selectElmt.selectedIndex].value==109)
	{
	document.getElementById('intitule_compte').options[0].text="Participations";
	document.getElementById('intitule_compte').options[1].text="Dépôt de garantie, Caution";
	document.getElementById('intitule_compte').options[2].text="Caution bancaire (fonds bloqué)";
	document.getElementById('intitule_compte').options[3].text="Autres titres immobilisés";
		document.getElementById('intitule_compte').options[4].text=null;
	document.getElementById('intitule_compte').options[5].text=null;
	document.getElementById('intitule_compte').options[6].text=null;
		document.getElementById('intitule_compte').options[7].text=null;
		document.getElementById('intitule_compte').options[8].text=null;
	document.getElementById('intitule_compte').options[9].text=null;
	document.getElementById('intitule_compte').options[10].text=null;
		document.getElementById('intitule_compte').options[11].text=null;
			document.getElementById('intitule_compte').options[12].text=null;

	}
	
	else if(selectElmt.options[selectElmt.selectedIndex].value==189)
	{
	document.getElementById('intitule_compte').options[0].text="Compte courant Créateur";
	document.getElementById('intitule_compte').options[1].text="Compte courant Associés";
	document.getElementById('intitule_compte').options[2].text="Prêt d'honneur - PFIL";
	document.getElementById('intitule_compte').options[3].text="Prêt NACRE";
		document.getElementById('intitule_compte').options[4].text="Emprunt bancaire";
	document.getElementById('intitule_compte').options[5].text="Emprunt PCE - OSEO";
	document.getElementById('intitule_compte').options[6].text="Crédit-vendeur";
		document.getElementById('intitule_compte').options[7].text="Emprunt solidaire - ADIE";
		document.getElementById('intitule_compte').options[8].text="Prêt d'honneur - ADIE";
	document.getElementById('intitule_compte').options[9].text="Autres emprunts";
	document.getElementById('intitule_compte').options[10].text=null;
		document.getElementById('intitule_compte').options[11].text=null;
			document.getElementById('intitule_compte').options[12].text=null;

	}
		}

	function calcul_montant_ht(quantite,pau_ht)
		{
			var montant_ht;
			montant_ht=quantite*pau_ht;
			
			
			
		 document.getElementById('montant_ht').value=montant_ht;
		
		
		}

	
	function calcultva(montant,tva)
		{
			var montant_tva;
			var montant_ttc;
			montant_tva=montant*tva/100;
			montant_ttc=Number(montant)+Number(montant_tva);
			
			
		 document.getElementById("div_montant_tva").innerHTML=montant_tva+' €';
		 document.getElementById("div_montant_ttc").innerHTML=montant_ttc+' €';
		
		}
		</script>
        </head><body>
<center>
  <h2>Modification de l'investissement</h2></center> <center> <br/><br/><form method="get"><input type="hidden" name="domain" value="default" />
      <table style="border:1px solid #CCC"  >
        <tr style="font-weight:bold; background-color: #999; color:#FFF" >
          <td>Exercice</td>
          <input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet'] ;?>" />
          <td >Type immo</td>
          <td  >Intitul&eacute; du compte</td>
          <td>Quantit&eacute;</td>
          <td >PAU HT</td>
          <td >Montant HT</td>
          <td >TVA</td>
          <td >Montant TVA</td>
          <td >Montant TTC</td>
          <td></td>
        </tr>
      
        <tr style="text-align:right;border:1px solid #CCC" bgcolor='#ECF3F4'>
          <td><select name="exercice">
            <option value="<?php echo $valeur[1]; ?>"><?php echo $valeur[1]; ?></option> <option>Depart</option>
            <option>Annee 1</option>
            <option>Annee 2</option>
            <option>Annee 3</option>
          </select></td>
          <td><select onChange="return_immo('immo');" id="immo" name="immo">
            <option><?php echo $valeur[0]; ?></option>
            <?php $projet->texte('Rubrique_planfi','','egw_texte_financement');?>
          </select></td>
          <td ><select id="intitule_compte" name="intitule_compte">
            <option><?php echo $valeur[2]; ?></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
          </select></td>
          <td><input name="quantite"  value="<?php echo $valeur[3]; ?>" id="quantite"  onChange="calcul_montant_ht(this.value,document.getElementById('pau_ht').value);" size="1" type="text" /></td>
          <td><input size="4" value="<?php echo $valeur[4]; ?>" name="pau_ht" id="pau_ht"  onFocus="calcul_montant_ht(document.getElementById('quantite').value,this.value);" type="text" /></td>
          <td><input size="4" value="<?php echo $valeur[5]; ?>" name="montant_ht" onFocus="calcul_montant_ht(document.getElementById('quantite').value,document.getElementById('pau_ht').value);" type="text" id="montant_ht"   /></td>
          <td><select name="tva" onChange="calcultva(document.getElementById('montant_ht').value,this.value);">
            <option value="<?php echo $valeur[6]; ?>"><?php echo $valeur[6]; ?> %</option>
            <option value="0">0%</option>
            <option value="5.5">5,5%</option>
            <option value="20.0">20.0%</option>
          </select></td>
          <td><div style="color: #F00"  id="div_montant_tva"> <?php echo $valeur[7]; ?></div></td>
          <td><div style="color:#090" id="div_montant_ttc"> <?php echo $valeur[8]; ?></div></td>
          <td><input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet']; ?>" /><input name="id_resacc_in_edit" type="hidden" value="<?php echo $_GET['id_resacc_in_edit']; ?>" /><input name="modifier_in" type="submit" value="Modifier" /></td>
        </tr>
      </table>
<br/></form></center>
   <?php
if(isset($_GET['modifier_in']))
{
	
	$projet->modifier_in($GLOBALS['egw_info']['user']['account_id'],$_GET['id_resacc_in_edit'],$_GET['exercice'],$_GET['immo'],$_GET['intitule_compte'],$_GET['quantite'],$_GET['pau_ht'],$_GET['montant_ht'],$_GET['tva']);
	
	echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=investissement";</script>';
	echo'<script>window.close();</script>';

}


echo $GLOBALS['egw']->common->egw_footer();
?>
        </body></html>