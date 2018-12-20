<?php  
$statut_default = "Salarie";
if(isset($etat_civil[0]) and $etat_civil[0]!=0)
{
$dat_naissance=date("d/m/Y",$etat_civil[0]);
}
else
{
$dat_naissance=NULL;
}

if(isset($retour[47]) and $retour[47]=="Obtenu")
{
$statut_f1='checked="checked"';
$statut_f2=NULL;
}
elseif(isset($retour[47]) and $retour[47]=="Niveau")
{
$statut_f2='checked="checked"';
$statut_f1=NULL;
}
if(isset($retour[48]) and $retour[48]=="Obtenu")
{
$statut2_f1='checked="checked"';
$statut2_f2=NULL;
}
elseif(isset($retour[48]) and $retour[48]=="Niveau")
{
$statut2_f2='checked="checked"';
$statut2_f1=NULL;
}

if(isset($retour[49]) and $retour[49]!=0)
{
$dat_f=date("d/m/Y",$retour[49]);

}
else
{
$dat_f=NULL;
}
if(isset($retour[50]) and $retour[50]!=0)
{
$dat_f2=date("d/m/Y",$retour[50]);
}
else
{
	$dat_f2=NULL;
}

if(isset($retour[51]) and $retour[51]!=0)
{
$co=$retour[51];
}
if(isset($retour[52]) and $retour[52]!=0)
{
$co2=$retour[52];
}


if(isset($_GET['id_organisation_ben']))
{


	$retour_org_ben=$epce->return_org_ben($choix,$_GET['id_projet']);
$display_org_ben="block";
				
}
else
{
$display_org_ben="none";

}

if(isset($_GET['ajouter_situation']))
{
$epce->inserer_situation($choix,$_GET['statut'],$_GET['indemnite'],$_GET['identifiant'],$_GET['date_inscription']);
$display_situation="block";
}
else
{
$display_situation="none";
}
if(isset($_GET['id_formation_delete']))
{
$epce->delete_formation($_GET['id_formation_delete']);
$display_formation="block";
}
else
{
$display_formation="none";
}
if(isset($_GET['id_situation']))
{
$epce->delete_situation($_GET['id_situation']);
$display_situation="block";
}


if(isset($_GET['valider_emploi']) and is_numeric($_GET['id_parcours_edit_valider']))
{
	$epce->update_emploi($_GET['id_parcours_edit_valider'],$_SESSION['id'],$_GET['statut_parcours'],$_GET['identifiant'],$_GET['poste_ben'],$_GET['poste'],$_GET['code_rome'],$_GET['categorie'],$_GET['service'],$_GET['type_remuneration'],$_GET['remuneration'],$_GET['emploi_debut'],$_GET['emploi_fin'],$_GET['contrat'],$_GET['contrat_aide'],$_GET['qualification'],$_GET['temps_travail'],$_GET['deplacement'],$_GET['organisation'],$_GET['personne_concernee']);

echo'<script>window.location.href="panel.php?choix='.$choix.'";</script>';
	
}
elseif(isset($_GET['valider_emploi']))
{
	
	
	$retour_forma=$epce->inserer_emploi($choix,$_SESSION['id'],$_SESSION['id'],$_GET['statut_parcours'],$_GET['identifiant'],$_GET['poste_ben'],$_GET['poste'],$_GET['code_rome'],$_GET['categorie'],$_GET['service'],$_GET['type_remuneration'],$_GET['remuneration'],$_GET['emploi_debut'],$_GET['emploi_fin'],$_GET['contrat'],$_GET['contrat_aide'],$_GET['qualification'],$_GET['temps_travail'],$_GET['deplacement'],$_GET['organisation'],$_GET['personne_concernee']);
if($retour_forma[0]!=NULL)
				 {
$display_org_formation="block";
				 }
				 else
				 {
					 $display_org_formation="none";
					}

}



if(isset($_GET['valider_formation']) and is_numeric($_GET['id_formation_edit_valider']))
{
	$epce->update_formation($_GET['id_formation_edit_valider'],$_SESSION['id'],$choix,$_GET['statut_formation'],$_GET['type_formation'],$_GET['niveau_formation'],$_GET['intitule_formation'],$_GET['resultat_formation'],$_GET['mois_debut'].' '.$_GET['annee_debut'],$_GET['mois_fin'].' '.$_GET['annee_fin'],$_GET['org_form'],$_GET['org_cert']);

echo'<script>window.location.href="panel.php?choix='.$choix.'";</script>';
	
}
elseif(isset($_GET['valider_formation']))
{
$retour_forma = $epce->inserer_formation($_SESSION['id'],$choix,$_GET['statut_formation'],$_GET['type_formation'],$_GET['niveau_formation'],$_GET['intitule_formation'],$_GET['resultat_formation'],$_GET['mois_debut'].' '.$_GET['annee_debut'],$_GET['mois_fin'].' '.$_GET['annee_fin'],$_GET['org_form'],$_GET['org_cert']);
$display_formation="block";

if($retour_forma[0]!=NULL)
				 {
$display_org_formation="block";
				 }
				 else
				 {
					 $display_org_formation="none";
					}

}
else
{
	$display_org_formation="none";
$display_formation="none";
}

{

}

if(isset($_GET['modifier_org_formation']))
{
	$epce->update_organisation($_SESSION['id'],$_GET['id_organisation'],$_GET['rue'],$_GET['adresse_ligne_2'],$_GET['adresse_ligne_3'],$_GET['cp'],$_GET['ville'],$_GET['region'],$_GET['pays'],$_GET['tel'],$_GET['fax'],$_GET['site_web']);
	
	if(isset($_GET['id_organisation_cert']) and $_GET['id_organisation_cert']!=NULL)
	{
	$display_org_formation="block";
	$retour_forma[0]=$_GET['id_organisation_cert'];
	$retour_forma[1]=$_GET['nom_organisation_cert'];
	$retour_forma[3]=NULL;
	$retour_forma[2]=NULL;
	}
	else
	{
	$display_org_formation="none";
	}
}

if(isset($_GET['id_formation_edit']))
{
	$display_formation_form="block";
	//$display_formation_details="block";
	$formation=$epce->return_formation($_GET['id_formation_edit']);
	$formation['date_debut']=explode(' ',$formation['date_debut']);
	$formation['date_fin']=explode(' ',$formation['date_fin']);
	/*echo"<script>document.getElementById('formation_form').style.display='block';</script>";*/
	
	
}
else
{
	$display_formation_form="none";

}


if(isset($_GET['id_parcours_edit']))
{
	$display_parcours_form="block";
	$display_parcours_details="block";
	$parcours=$epce->return_parcours_pro($_GET['id_parcours_edit']);
	
	if($parcours[1]!=NULL)
	{
	$statut_default = $parcours[1] ;
	}
	if($parcours[8]!=0)
	{
	$date_debut_parcours = date("d/m/Y",$parcours[8]);
	}
	if($parcours[9]!=0)
	{
	$date_fin_parcours = date("d/m/Y",$parcours[9]);
	}
	
}
else
{
	$display_parcours_form="none";
	$display_parcours_details="none";
}

if(isset($_GET['id_parcours_delete']))
{
	
	$epce->delete_parcours_pro($_GET['id_parcours_delete']);
	
	
	
}



if(isset($_GET['modifier_org_ben']))
{
$epce->update_org_ben($_GET['id_resacc'],$_SESSION['id'],$_GET['nom_commercial'],$_GET['raison_sociale'],$_GET['activite_principale'],$_GET['type_adresse'],$_GET['adresse_ligne_1'],$_GET['adresse_ligne_2'],$_GET['adresse_ligne_3'],$_GET['cp'],$_GET['ville'],$_GET['region'],$_GET['pays'],$_GET['date_immat'],$_GET['date_debut_activite'],$_GET['forme_juridique'],$_GET['siret'],$_GET['secteur_activite'],$_GET['dirigeant'],$_GET['implantation'],$_GET['regime_imposition'],$_GET['regime_tva'],$_GET['regime_fiscal'],$_GET['regime_social_dirigeant'],$_GET['statut']);
 
 }
?><div  style="background: #DFDFDF  ; color: #306; border:1px solid #000; padding:15px;"><form  action="" method="post" ><input type="hidden"  name="cat_id" value="Usager_10"/>
    <h3><a href="javascript:voirdiv('etat')">Etat Civil</a> | <a href="javascript:voirdiv('prive')">
Coordonnees perso</a></h3><div style="display:none" id="etat"><strong>Etat Civil</strong><hr style="border:1px dashed" />
<table><tr><td width="200"><img src="../images/icons/vcard.png" /> Civilite</td><td width="197"><select style="width:120px" name="civilite">
  <option value="<?php echo $retour[5]; ?>"><?php echo $retour[5]; ?></option>
  <option value="Monsieur">Monsieur</option>
  <option value="Madame">Madame</option>
  <option value="Mademoiselle">Mademoiselle</option>
</select></td>
<td width="147"><img src="../images/icons/cake.png" /> Date de naissance</td>
<td width="202"><input type="text" name="date_naissance" id="date_naissance"  value="<?php echo $dat_naissance; ?>" /> <script type="text/javascript">

	document.writeln('<img id="date_naissance-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_naissance",
		button      : "date_naissance-trigger"
	}
	);
</script></td>
<td width="130"><img src="../images/icons/flag_blue.png" /> Nationalite</td>
 <td width="147"><select style="width:120px" name="nationalite"><option value="<?php echo $etat_civil[2];?>"><?php echo $etat_civil[2];?></option><?php $epce->texte('Nationalite');?></select></td></tr><tr><td>Nom</td><td><input style="font-weight:bolder" type="text" value="<?php echo $retour[1]; ?>" name="nom" /></td>
 
<td width="147">Age</td>
<td width="202"><strong><?php if ($dat_naissance==NULL){echo '?';}else{echo  $epce->age($etat_civil[0]);} ?> ans </strong></td>
<td width="130"><img src="../images/icons/heart_half.png" /> Situtation maritale</td>
 <td width="147"><select style="width:120px" name="situation" ><option value="<?php echo $etat_civil[3];?>"><?php echo $etat_civil[3];?></option><?php $epce->texte('Situation maritale');?></select></td></tr><tr>
 <td>Nom de jeune fille</td>
 <td><input name="nom_jeune_fille"  value="<?php echo $retour[4]; ?>"type="text" /></td>
<td width="147">Lieu de naissance</td><td width="202"><input type="text" name="lieu_naissance" id="lieu_naissance"  onblur="fill3();"  onkeyup="lookup3(this.value);" value="<?php echo $etat_civil[1]; ?>" /></td><td width="130"><img src="../images/icons/group.png" /> Enfants a charge</td>
 <td width="147"><select style="width:120px" name="enfant"><option value="<?php echo $etat_civil[4];?>"><?php echo $etat_civil[4];?></option><?php for($i=0;$i<11;$i++){echo" <option value='$i'>$i</option>'";} ?></select></td></tr><tr>
  <td>Prenom</td>
<td><input style="font-weight:bolder" type="text" value="<?php echo $retour[2];?>" name="prenom" /></td></tr><tr>
 

<td>Deuxieme prenom</td><td><input type="text" value="<?php echo $retour[3]; ?>" name="deuxieme_prenom" /></td> </tr><tr>
  
</tr></table><table width="1247"><tr><td width="607">&nbsp;</td><td width="628"><div class="suggestionsBox" id="suggestions3" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList3">
					&nbsp;
				
			</div></div></td></tr></table></div>

<div id="prive" style="display:block"><strong>Coordonnees perso</strong>
<hr style="border:1px dashed" />
<table>
 
  <tr>
    <td width="200"><img src="../images/home_16.png" /> Rue</td>
    <td width="200"><input size="33" value="<?php echo $retour[8]; ?>" tabindex='1' name="adresse_ligne_1" type="text" /></td>
  </tr>  <tr>
    <td width="200"> Adresse ligne 2</td>
    <td width="200"><input size="33" value="<?php echo $retour[9]; ?>" tabindex='2' name="adresse_ligne_2" type="text" /></td>
  </tr>  <tr>
    <td width="200">Adresse ligne 3</td>
    <td width="200"><input size="33" tabindex='3' value="<?php echo $retour[10]; ?>" name="adresse_ligne_3" type="text" /></td>
  </tr>
  <tr>
    <td>Code postal (recherche par ville..)</td>
    <td><input name="cp"  onblur="fill();" tabindex='4' id="inputString" onkeyup="lookup(this.value);"  value="<?php echo $retour[13]; ?>" type="text" /></td>
    <td width="200">Ville</td>
    <td width="200"><input name="ville" id="ville" tabindex='5' value="<?php echo $retour[11]; ?>" type="text" /></td>
  </tr>
  <tr>
    <td >Region</td>
    <td><input name="region" id="region" tabindex='6' value="<?php echo $retour[12]; ?>" type="text" /></td>
    <td>Pays</td>
    <td><input name="pays" id="pays" value="<?php echo $retour[14]; ?>" tabindex='7' type="text" /></td>
  </tr><tr><td></td><td><div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</div>
			</div></td></tr>
 <tr>
   <td><img src="../images/icons/mobile_phone.png" alt="" /> Portable perso</td>
<td width="200"><input name="portable_perso" type="text"  tabindex='8' value="<?php echo $retour[22]; ?>"/></td>
    <td><img src="../images/icons/mobile_phone.png" alt="" /> Portable pro</td>
<td width="200"><input name="portable_pro" type="text" tabindex='14'  value="<?php echo $retour[21]; ?>"/></td></tr> <tr>
     <td width="200"><img src="../images/icons/telephone.png" /> Tel domicile</td><td width="188"><input type="text" tabindex='9' value="<?php echo $retour[17]; ?>" name="tel_domicile" /></td>
  <td><img src="../images/icons/telephone.png" alt="" /> Tel pro</td><td><input tabindex='15' name="tel_pro" type="text" value="<?php echo $retour[15]; ?>" /></td>
  </tr>  <tr>
     <td width="200"><img src="../images/icons/telephone.png" alt="" /> Tel domicile 2</td>
     <td width="188"><input type="text" value="<?php echo $retour[18]; ?>" tabindex='10' name="tel_domicile_2" /></td> <td width="200"><img src="../images/icons/telephone.png" alt="" /> Tel pro 2</td>
     <td width="188"><input  name="tel_pro_2" tabindex='16' type="text" value="<?php echo $retour[16]; ?>" /></td>
 
  </tr><tr> <td><img src="../images/icons/printer.png" alt="" /> Fax domicile</td><td><input tabindex='11' name="fax_domicile" type="text"  value="<?php echo $retour[20]; ?>"/></td>
  <td><img src="../images/icons/printer.png" alt="" /> Fax pro</td>
  <td><input name="fax_pro" type="text"  tabindex='17' value="<?php echo $retour[19]; ?>"/></td>
</tr><tr> <td><img src="../images/icons/email.png" alt="" /> Email domicile</td><td><input tabindex='12' name="email_domicile" type="text"  value="<?php echo $retour[24]; ?>"/></td>
  <td><img src="../images/icons/email.png" alt="" /> Email pro</td>
  <td><input name="email_pro" type="text" tabindex='18'  value="<?php echo $retour[23]; ?>"/></td>
</tr><tr> <td><img src="../images/icons/mouse.png" alt="" /> Site perso</td>
  <td><input name="site_perso" type="text"  tabindex='13' value="<?php echo $retour[25]; ?>"/></td>
 
</tr>
</table><br/></div>


<p align="center"><input style="font-size:20px; background-color: #039; color:#FFF"  type="submit" value="Sauvegarder" name="sauvegarder" /></p></form></div>
<br/><div id="add_suite" style="padding:15px; border:1px dashed #000; background:#EEE"><!--<h3><a href="javascript:voirdiv('demandeur_emploi')">Situation professionnelle</a><a name="situation" /></h3>
<div id="demandeur_emploi">
	
	

<form action="panel.php#ancre_situation" method="get"><tr ><td width="14%"><input type="hidden" name="choix" value="" />
  <select style="width:180px" name="statut">
    <option></option>
   
  </select></td><td width="18%" height="21" class="titre2"><select style="width:120px" name="indemnite">
      <option></option>
      
    </select></td><td width="10%" ><input type="text" name="identifiant" /></td><td width="14%"><input type="text" id="immat3" name="date_inscription" /> <script type="text/javascript"> document.writeln('<img id="immat-trigger3" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "immat3",
		button      : "immat-trigger3"
	}
	);</script></td><td width="14%"></td><td width="5%"><input  type="submit" value="Ajouter" name="ajouter_situation"  /></td></tr></form></table>
</div>-->
<h3><a  href="javascript:voirdiv('formation');">Formation</a> (<?php echo $epce->return_nb_formation($choix); ?>) | <a href="javascript:voirdiv('parcours_details')">Parcours professionnel</a> (<?php echo $epce->return_nb_parcours_pro($choix); ?>)</h3>
<div style="display:<?php echo $display_formation; ?>" id="formation"><a name="ancre_formation"/><img border="0" src="./images/plus_16.png" /> <a href="javascript:void();" onclick="document.getElementById('formation_form').style.display='block';" title="Ajouter une formation"> Ajouter une formation</a>
<?php $epce->afficher_formation($choix); ?>
	</table><br/>
<table>
 
 
  
</table></div><div id="parcours_details" style="display:<?php echo $display_parcours_details; ?>">
<?php $epce->afficher_employeurs($choix);?></div>
<div  style="position:absolute; padding:15px; display:<?php echo $display_formation_form; ?>; background-color: #E8E8E8; border:1px solid #000; left: 20%; top: 90%; width: 577px;" id="formation_form"><form action="panel.php#ancre_formation" method="get"><tr><td width="14%"><input type="hidden" name="id_formation_edit_valider" value="<?php echo $_GET['id_formation_edit']; ?>" /><input type="hidden" name="choix" value="<?php echo $choix; ?>" /><table><tr><td>Statut</td><td><select name="statut_formation" style="width:160px"><option><?php echo utf8_encode($formation['statut_formation']); ?></option> <?php $epce->texte('statut_formation','desc');?></select></td></tr><tr>
      <td>Type de formation</td><td> <select style="width:160px" name="type_formation">
	  <option><?php echo $formation['type_formation']; ?></option>
	    <?php $epce->texte('type_formation');?>
	    </select></td></tr><tr>
      <td>Niveau de formation</td><td> <select style="width:160px" name="niveau_formation">
	   <option><?php echo $formation['niveau_formation']; ?></option>
	    <?php $epce->texte('niveau de formation');?>
	    </select></td></tr><tr><td>Intitule de formation</td><td><input style="font-weight:bolder" name="intitule_formation" size="50" type="text" value="<?php echo utf8_encode($formation['intitule_formation']); ?>" /></td></tr><tr><td>Resultat </td><td><select name="resultat_formation" style="width:120px"><option><?php echo $formation['resultat_formation']; ?></option><option>Obtenu</option><option>Niveau</option></select></td></tr><tr><td>Date de debut </td><td><select style="width:120px" name="mois_debut"><option><?php echo $formation['date_debut'][0]; ?> </option><option>Janvier</option><option>Fevrier</option><option>Mars</option><option>Avril</option><option>Mai</option><option>Juin</option><option>Juillet</option><option>Aout</option><option >Septembre</option><option>Octobre</option><option>Novembre</option><option>Decembre</option></select>  <select style="width:120px" name="annee_debut"><option><?php echo $formation['date_debut'][1]; ?> </option><?php for($i=(date("Y"));$i>=1950;$i--){echo"<option>$i</option>";} ?></select></td></tr><tr><td>Date de fin </td><td><select style="width:120px" name="mois_fin"><option><?php echo $formation['date_fin'][0]; ?> </option><option>Janvier</option><option>Fevrier</option><option>Mars</option><option>Avril</option><option>Mai</option><option>Juin</option><option >Juillet</option><option>Aout</option><option >Septembre</option><option>Octobre</option><option>Novembre</option><option>Decembre</option></select> <select style="width:120px" name="annee_fin"><option><?php echo $formation['date_fin'][1]; ?> </option><?php for($i=date("Y");$i>=1950;$i--){echo"<option>$i</option>";} ?></select></td></tr><tr><td>Organisme formation</td><td><input value="<?php echo $formation['organisme_formation']; ?>" size="50" onchange="this.value=this.value.toUpperCase();" type="text" name="org_form" onblur="fill_organisme_forma();"  onkeyup="lookup_organisme_forma(this.value,254,'formation');"  id="org_form"/><div class="suggestionsBox" id="suggestions_organisme_forma" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_organisme_forma">
					&nbsp;
				</div>
			</div> </td></tr><tr><td>Organisme certification</td><td><input value="<?php echo $formation['organisme_certification']; ?>" size="50" onchange="this.value=this.value.toUpperCase();"  onblur="fill_organisme_forma_cert();"  onkeyup="lookup_organisme_forma_cert(this.value,255,'certification');" type="text" name="org_cert"  id="org_cert" /><div class="suggestionsBox" id="suggestions_organisme_forma_cert" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_organisme_forma_cert">
					&nbsp;
				</div>
			</div></td></tr><tr><td align="right"><input onclick="document.getElementById('formation_form').style.display='none';" type="button" value="Fermer" /></td><td><input type="submit" name="valider_formation" value="Enregistrer" /></td></tr></table></form></div>
            
          <div  style="position:absolute; padding:15px;display:<?php echo $display_org_formation ?>; background-color: #E8E8E8; border:1px solid #000; left: 5%; top: 90%; width: 530px;" id="add_org_formation"><img src="../images/icons/error.png" /><strong> Completer les informations lies a l'organisme</strong><br/><br/>
              <form action="panel.php#ancre_formation" method="get"><tr><td width="14%"><input type="hidden" name="choix" value="<?php echo $choix; ?>" /><input type="hidden" name="id_organisation" value="<?php echo $retour_forma[0]; ?>" /><input type="hidden" name="id_organisation_cert" value="<?php echo $retour_forma[2]; ?>" /><input type="hidden" name="nom_organisation_cert" value="<?php echo $retour_forma[3]; ?>" /><table><tr>
      <td width="178">Nom de l'organisme</td>
      <td width="300" style="font-weight:bolder"><?php echo $retour_forma[1]; ?></td></tr><tr>
      <td>Rue </td><td> <input size="50" name="rue" type="text" /></td></tr><tr>
	      <td>Adresse ligne 2</td><td><input name="adresse_ligne_2" size="50" type="text" /></td></tr><tr>
	        <td>Adressse ligne 3</td><td><input name="adresse_ligne_3" size="50" type="text" /></td></tr><tr>
	        <td>Code postal</td><td><input onblur="fill_cp_formation();" id="cp_formation" onkeyup="lookup_cp_formation(this.value);"  name="cp" type="text" /><div class="suggestionsBox" id="suggestions_cp_formation" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_cp_formation">
					&nbsp;
				
			</div></div></td></tr><tr>
	          <td>Ville</td>
	            <td><input type="text" id="ville_formation" name="ville" /></td></tr><tr>
                 <td>Region</td><td><input name="region" id="region_formation"  type="text" /></td></tr>
	        <td>Pays</td><td><input name="pays" id="pays_formation" type="text" /></td></tr><tr>
	        <td>Tel</td><td><input name="tel"  type="text" /></td></tr><tr>
	        <td>Fax</td><td><input  name="fax" type="text" /></td></tr><tr>
	        <td>Email</td><td><input  name="email" type="text" /></td></tr><tr>
	        <td>Site web</td><td><input  name="site_web" type="text" /></td></tr><tr><td height="45" align="right"><input onclick="document.getElementById('add_org_formation').style.display='none';" type="button" value="Fermer" /></td><td><input type="submit" name="modifier_org_formation" value="Enregistrer" /></td></tr></table></form></div>
            
<div  style="display:<?php echo $display_parcours_form; ?>" id="parcours_form"><div style="position:absolute; display:block; background-color: #E8E8E8; border:1px solid #000; left: 30%; top: 526px; width: 577px;"; id="parcours_details"><center>
</center><br/><a name="parcours_ancre"></a><form  action="panel.php" method="get"><input type="hidden" name="id_parcours_edit_valider"  value="<?php echo $parcours[16]; ?>" size="50"  /><input type="hidden" name="choix" id="choix" value="<?php echo $choix; ?>" size="50"  /><table width="568"><tr>
  <td>Personne concernee</td><td><input type="radio" checked="checked" name="personne_concernee" value="vous" /> Vous <input name="personne_concernee" type="radio" value="conjoint"  /> Votre conjoint</td></tr><tr>
  <td>Statut</td>
  <td><select style="width:150px"   onchange="verifstatut();" id="statut_parcours" name="statut_parcours">
  <option value="<?php echo $statut_default; ?>"><?php echo $statut_default; ?></option>
  <?php $epce->texte('statut 1');?>
</select></td></tr><tr>
        <td><div id="div_identifiant" style="display:none" >Identifiant</div></td>
        <td><input type="text" style="display:none" id="identifiant" name="identifiant"  value="<?php echo $parcours[2]; ?>"  /></td></tr><tr>
        <td><div id="div_poste" style="display:none" >Poste</div></td>
        <td><input type="text"  value="<?php echo utf8_encode($parcours[3]); ?>"  style="display:none" id="poste_ben" name="poste_ben" size="50"  /></td></tr><tr>
      <td width="147"><div id="div_intitule_rome" style="display:none" >Intitul&eacute; rome</div></td><td width="409"><input  value="<?php echo utf8_encode($parcours[4]); ?>" style="font-weight:bolder;display:none ;color:#F00" type="text" name="poste" size="50"  onblur="fill_emploi();"  onkeyup="lookup_emploi(this.value);" id="poste" /><div class="suggestionsBox" id="suggestions_emploi" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_emploi">
					&nbsp;
				</div>
			</div></td></tr><tr>
  <td><div id="intitule_rome" style="display:none" >Code rome</div></td>
  <td><input style="display:none" id="code_rome" name="code_rome" type="text" /></td></tr><tr>
  <td><div id="categorie_rome" style="display:none" >Cat&eacute;gorie</div></td>
  <td><input id="categorie" style="display:none" name="categorie" size="50" type="text" /></td></tr><tr>
    <td>Type de r&eacute;mun&eacute;ration</td><td><select style="width:150px;"  id="type_remuneration" name="type_remuneration">
  <option value="<?php echo $parcours[5]; ?>"><?php echo $parcours[5]; ?></option>
  <?php $epce->texte('indemnite_1');?>
</select></td></tr> <tr>
    <td><div id="div_remuneration" style="display:none" >R&eacute;mun&eacute;ration</div></td><td><div id="div_remuneration2" style="display:none" ><select style="width:150px" id="remuneration"   name="remuneration"> <option value="<?php echo $parcours[6]; ?>"><?php echo $parcours[6]; ?></option>
          <?php for($i=0;$i<=10000;$i=$i+50)
		  {
			echo'<option value='.$i.'>'.$i.'</option>';
			}?>
         
        </select> <img src="../images/money_euro.png" /> / Mois brut</div></td></tr><tr><td><div id="div_service" style="display:none" >Service</div></td><td><select style="width:150px; display:none"  id="service" name="service">
  <option value="<?php echo $parcours[7]; ?>"><?php echo $parcours[7]; ?></option>
  <?php $epce->texte('emploi_service');?>
</select></td></tr><tr>
  <td>Date de debut</td>
  <td><input id="emploi_debut" name="emploi_debut" type="text" value="<?php echo $date_debut_parcours ?>" /> <script type="text/javascript">

	document.writeln('<img id="emploi_debut-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "emploi_debut",
		button      : "emploi_debut-trigger"
	}
	);
</script></td></tr><tr>
    <td>Date de fin</td><td><input id="emploi_fin" name="emploi_fin" type="text" value="<?php echo $date_fin_parcours ?>" /> <script type="text/javascript">

	document.writeln('<img id="emploi_fin-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "emploi_fin",
		button      : "emploi_fin-trigger"
	}
	);
</script></td></tr><tr>
      <td><div id="div_contrat" style="display:none" >Contrat</div></td><td><select style="width:150px; display:none"  id="contrat" name="contrat"><option value="<?php echo $parcours[10];?>"><?php echo $parcours[10]; ?></option><?php $epce->texte('Type de contrat');?></select></td></tr><tr>
        <td><div id="div_contrat_aide" style="display:none" >Contrat aid&eacute;</div></td>
        <td><select style="width:150px;display:none"  id="contrat_aide" name="contrat_aide">
          <option value="<?php echo $parcours[11];?>"><?php echo $parcours[11]; ?></option>
          <?php $epce->texte('Contrat aide');?>
        </select></td></tr><tr>
        <td><div id="div_qualification" style="display:none" >Qualification</div></td><td><select style="width:150px;display:none"  id="qualification" name="qualification">
          <option value="<?php echo $parcours[12]; ?>"><?php echo $parcours[12]; ?></option>
          <?php $epce->texte('Qualification');?>
        </select></td></tr><tr>
        <td><div id="div_temps_travail" style="display:none" >Temps de travail</div></td><td><select style="width:150px; display:none"  id="temps_travail" name="temps_travail">  <option value="<?php echo $parcours[13]; ?>"><?php echo $parcours[13]; ?></option>
          <?php for($i=35;$i>0;$i--)
		  {
			echo'<option value='.$i.'>'.$i.' h</option>';
			}?>
         
        </select></td></tr><tr>
        <td><div id="div_deplacement" style="display:none" >D&eacute;placement</div></td>
        <td><select style="width:150px; display:none"  id="deplacement" name="deplacement">
           <option value="<?php echo $parcours[14]; ?>"><?php echo $parcours[14]; ?></option>
          <?php $epce->texte('emploi_deplacement');?>
        </select></td></tr><tr>
        <td><div id="div_organisation" style="display:none" >Organisation</div></td>
        <td><input value="<?php echo $parcours[15]; ?>" style="font-weight:bolder;text-transform:uppercase; display:none; color: #006" type="text" name="organisation" id="org_employeur" size="50" onblur="fill_organisme_employeur();"  onkeyup="lookup_organisme_employeur(this.value,246,'employeur');"  /> <div class="suggestionsBox" id="suggestions_organisme_employeur" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_organisme_employeur">
					&nbsp;
				</div>
			</div></td></tr></table><br/><center><input onclick="document.getElementById('parcours_form').style.display='none';" type="button" value="Fermer" /> 
          <input type="submit" value="Valider" name="valider_emploi" /></center></form><br/><br/></div>

</div>
<div style="background-color:#FFF; display:none; padding-left:10px; border:1px solid #CCC; position:absolute; width:267px; left:70%; top: 270px;" id="aide_formation">
  <p><center><strong><img src="../images/icons/help.png" /> Degres d'adequation lies au projet</strong></center></p>
  <p>1 : Aucun<br/>2 : Normal<br/>3 : Bon <br/> 
  4 : Tres bon<br/><br/>
    <center><input type="button" onclick="document.getElementById('aide_formation').style.display='none'"  value="Fermer" /><br/><br/><img src="../images/down_64.png" width="36" height="35" /></center>
 </p>

</center></div></div><br/>
<br/>

       <?php /*?><div  style="position:absolute; padding:15px; display:<?php echo $display_org_ben ?>; background-color: #E8E8E8; border:1px solid #000; left: 5%; top: 90%; width: 811px;" id="organisation_ben"><a name="ancre_organisation_ben"></a><img src="../images/icons/error.png" /><strong> Completer les informations lies a l'organisme</strong><br/><br/>
              <form action="panel.php#ancre_org_ben" method="get"><tr><td width="14%"><input type="hidden" name="choix" value="<?php echo $choix; ?>" /><input type="hidden" name="id_resacc" value="<?php echo $_GET['id_organisation_ben']; ?>" /><table width="808"><tr>
      <td width="165">Nom commercial</td>
      <td width="330" ><input type="text" name="nom_commercial" value="<?php echo $retour_org_ben[0]; ?>" /></td></tr><tr>
      <td>Raison social</td>
      <td width="330" ><input type="text" name="raison_sociale" value="<?php echo $retour_org_ben[1]; ?>" /> </td><td width="136">
        Siret</td><td> 
          <input type="text" value="<?php echo $retour_org_ben[14]; ?>" name="siret" /> </td></tr><tr>
      <td >Activit&eacute; principale</td>
      <td width="330" ><input size="50" type="text" name="activite_principale" value="<?php echo utf8_encode($retour_org_ben[2]); ?>" /></td></tr><tr>
      <td>Date immat</td>
      <td width="330" ><input name="date_immat"  type="text" value="<?php if($retour_org_ben[11]!=NULL) echo date("d/m/Y",$retour_org_ben[11]); ?>"  id="date_immat"/> <script type="text/javascript">

	document.writeln('<img id="date_immat-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_immat",
		button      : "date_immat-trigger"
	}
	);
</script></td>
      <td>Date d&eacute;but d'activit&eacute;</td>
      <td width="157" ><input name="date_debut_activite"  type="text" value="<?php if($retour_org_ben[12]!=NULL) echo date("d/m/Y",$retour_org_ben[12]); ?>" id="date_debut_activite" /> <script type="text/javascript">

	document.writeln('<img id="date_debut_activite-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_debut_activite",
		button      : "date_debut_activite-trigger"
	}
	);
</script></td></tr><tr>
      <td><hr /></td>
      <td width="330" ><hr /></td> <td ><hr /></td><td ><hr /></td></tr>
      <td>Type d'adresse</td>
      <td width="330"><select name="type_adresse" style="width:160px"><option value="<?php echo  utf8_encode($retour_org_ben[3]); ?>"><?php echo  utf8_encode($retour_org_ben[3]); ?></option><?php $epce->texte('type_adresse');?></select></td></tr><tr>
      <td>Rue </td><td> <input size="50" name="adresse_ligne_1" type="text" value="<?php echo  $retour_org_ben[4]; ?>" /></td></tr><tr>
	      <td>Adresse ligne 2</td><td><input name="adresse_ligne_2" size="50" type="text" value="<?php echo utf8_encode($retour_org_ben[5]); ?>" /></td></tr><tr>
	        <td>Adressse ligne 3</td><td><input name="adresse_ligne_3" size="50" type="text" value="<?php echo  utf8_encode($retour_org_ben[6]); ?>" /></td></tr><tr>
	        <td>Code postal</td><td><input onblur="fill_cp_org_ben();" id="cp_org_ben" onkeyup="lookup_cp_org_ben(this.value);"  name="cp" type="text" value="<?php echo $retour_org_ben[7]; ?>" /><div class="suggestionsBox" id="suggestions_cp_org_ben" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_cp_org_ben">
					&nbsp;
				
			</div></div></td></tr><tr>
	          <td>Ville</td>
	            <td><input type="text" id="ville_org_ben" name="ville"  value="<?php echo $retour_org_ben[8]; ?>" /></td></tr><tr>
                 <td>Region</td><td><input name="region" id="region_org_ben"  type="text" value="<?php echo $retour_org_ben[9]; ?>" /></td></tr>
	        <td>Pays</td><td><input name="pays" id="pays_org_ben" type="text" value="<?php echo $retour_org_ben[10]; ?>" /></td></tr><tr><td><hr /></td><td><hr /></td> <td  ><hr /></td><td ><hr /></td></tr><tr>
      <td>Dirigeant</td>
      <td width="330" style="font-weight:bolder"><select name="dirigeant" style="width:160px"><option value="<?php echo $retour_org_ben[16]; ?>" ><?php echo $retour_org_ben[16]; ?></option><option value="Le beneficiaire">Le beneficiaire</option> <option value="L'Associe">L'Associe</option></select></td></tr><tr>
      <td>Forme juridique</td>
      <td width="330" style="font-weight:bolder"><select name="forme_juridique" style="width:160px"><option value="<?php echo $retour_org_ben[13]; ?>" ><?php echo $retour_org_ben[13]; ?></option><?php $epce->texte('forme_juridique');?></select></td></tr><tr>
      <td>Implantation</td>
      <td width="330" style="font-weight:bolder"><select name="implantation" style="width:160px"><option value="<?php echo $retour_org_ben[17]; ?>"><?php echo $retour_org_ben[17]; ?></option></select></td></tr><tr>
      <td>Secteur d'activit&eacute;</td>
      <td width="330" style="font-weight:bolder"><select name="secteur_activite" ><option value="<?php echo utf8_encode($retour_org_ben[15]); ?>"><?php echo utf8_encode($retour_org_ben[15]); ?></option><?php $epce->texte('secteur_activite');?></select></td></tr><tr><td ><hr /></td><td><hr /></td><td><hr /></td> <td  ><hr /></td></tr><tr>
      <td>R&eacute;gime d'impostion</td>
      <td width="330" style="font-weight:bolder"><select name="regime_imposition" style="width:160px"><option value="<?php echo $retour_org_ben[18]; ?>"><?php echo $retour_org_ben[18]; ?></option></select></td></tr><tr>
      <td>R&eacute;gime de TVA</td>
      <td width="330" style="font-weight:bolder"><select name="regime_tva" style="width:160px"><option value="<?php echo $retour_org_ben[19]; ?>"><?php echo $retour_org_ben[19]; ?></option></select></td></tr><tr>
      <td>R&eacute;gime fiscal</td>
      <td width="330" style="font-weight:bolder"><select name="regime_fiscal" style="width:160px"> <option value="<?php echo utf8_encode($retour_org_ben[20]); ?>"><?php echo utf8_encode($retour_org_ben[20]); ?></option><?php $epce->texte('regime_fiscal');?></select></td></tr><tr><tr>
      <td>R&eacute;gime social du dirigeant</td>
      <td width="330" style="font-weight:bolder"><select name="regime_social_dirigeant" style="width:160px"><option value="<?php echo $retour_org_ben[21]; ?>"><?php echo $retour_org_ben[21]; ?></option></select></td></tr><td ><hr /></td><td><hr /></td><td><hr /></td> <td  ><hr /></td></tr><tr><tr>
      <td>Statut</td>
      <td width="330" style="font-weight:bolder"><select name="statut" style="width:160px"><option value="<?php echo $retour_org_ben[22]; ?>"><?php echo $retour_org_ben[22]; ?></option><option>En cours</option><option>Cree</option><option>Annulee</option></select></td></tr><td></td><td height="45" align="right"><input onclick="document.getElementById('organisation_ben').style.display='none';" type="button" value="Fermer" />        <input type="submit" name="modifier_org_ben" value="Enregistrer" /></td><td>&nbsp;</td></tr></table></form></div><?php */?>
            
<?php if(isset($_POST['sauvegarder']))
{ 
$rapport = new Rapport_activite($_SESSION['id']);
$rapport->action('sauvegarde les informations personnelles de '.$retour[0]);

$epce->update_ben($choix,$_SESSION['id'],$_POST['civilite'],$_POST['nom'],$_POST['prenom'],$_POST['deuxieme_prenom'],$_POST['nom_jeune_fille'],$_POST['adresse_ligne_1'],$_POST['adresse_ligne_2'],$_POST['adresse_ligne_3'],$_POST['cp'],$_POST['ville'],$_POST['region'],$_POST['pays'],$_POST['tel_pro'],$_POST['tel_pro_2'],$_POST['tel_domicile'],$_POST['tel_domicile_2'],$_POST['portable_perso'],$_POST['portable_pro'],$_POST['email_domicile'],$_POST['email_pro'],$_POST['fax_domicile'],$_POST['fax_pro'],$_POST['site_perso']);

$epce->update_etat_civil($choix,$_SESSION['id'],$_POST['date_naissance'],$_POST['lieu_naissance'],$_POST['nationalite'],$_POST['situation'],$_POST['enfant']);



echo'<script>window.location.replace("panel.php?valid=1&annee=10&choix='.$choix.'");</script>';
}
?>