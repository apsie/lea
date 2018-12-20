<?php  

if(isset($retour[32]) and $retour[32]!=NULL)
{
$age_=explode("/",$retour[32]);
$a1=$age_[0];
$a2=$age_[1];
$a3=$age_[2];
}
else
{
$a1=NULL;
$a2=NULL;
$a3=NULL;
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

?><div  style="background: #DFDFDF  ; color: #306; border:1px solid #000; padding:15px;"><form  action="" method="post" ><input type="hidden"  name="cat_id" value="Usager_10"/>
<h3>Prestation EPCE</h3><hr style="border:1px dashed" /><table width="883"><tr>
  <td width="118">Lettre de commande</td>
  <td width="150"><input type="text" name="n_lettre" value="<?php echo $presta_epce[0];?>" /></td><td width="126">Date de debut</td><td width="164"><input id="date_inscription" name="date_debut_epce" type="text" value="<?php  if($presta_epce[1]!=0)echo  date('d/m/Y',$presta_epce[1]); ?>" /> <script type="text/javascript">

	document.writeln('<img id="date_inscription-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_inscription",
		button      : "date_inscription-trigger"
	}
	);
</script></td><td width="126">Date de fin</td><td width="171"><input  type="text" name="date_fin_epce" id="date_inscription2" value="<?php if($presta_epce[2]!=0)echo date('d/m/Y',$presta_epce[2]); ?>" /> <script type="text/javascript">

	document.writeln('<img id="date_inscription-trigger2" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "date_inscription2",
		button      : "date_inscription-trigger2"
	}
	);
</script></td>
</tr></table>
<a href="javascript:voirdiv('etat')"><h3>Etat Civil</h3></a><div id="etat"><hr style="border:1px dashed" />
<table><tr><td width="200">Civilite</td><td width="200"><select style="width:120px" name="n_prefix">
  <option value="<?php echo $retour[0]; ?>"><?php echo $retour[0]; ?></option>
  <option value="Monsieur">Monsieur</option>
  <option value="Madame">Madame</option>
  <option value="Mademoiselle">Mademoiselle</option>
</select></td>
<td>Tel bureau</td>
<td width="200"><input  name="tel_work" type="text" value="<?php echo $retour[7]; ?>" /></td><td width="200">Date de naissance</td>
<td width="226"><?php  echo'<select style="width:50px" name="a1"><option value="'.$a1.'">'.$a1.'</option>';for($i=1;$i<32;$i++){echo" <option value='$i'>$i</option>'";} echo'</select>/<select style="width:50px" name="a2"><option value="'.$a2.'">'.$a2.'</option>';for($i=1;$i<13;$i++){echo" <option value='$i'>$i</option>'";}echo'</select>/<select style="width:50px" name="a3"><option value="'.$a3.'">'.$a3.'</option>';for($i=2000;$i>1900;$i--){echo" <option value='$i'>$i</option>'";} echo'</select>'; ?></select></td></tr><tr><td>Nom</td><td><input style="border:1px solid #F00" type="text" value="<?php echo $retour[3]; ?>" name="n_family" /></td>
  <td width="200">Tel prive</td><td width="188"><input type="text" value="<?php echo $retour[8]; ?>" name="tel_home" /></td>
<td width="166">Age</td>
<td width="226"><?php if ($a3==NULL){echo '?';}else{echo  $epce->age("$a3","$a2","$a1");} ?> ans </td></tr><tr>
<td>Prenom</td>
<td><input style="border:1px solid #F00" type="text" value="<?php echo $retour[1];?>" name="n_given" /></td>
<td>Tel portable</td><td><input name="tel_cell" type="text"  value="<?php echo $retour[9]; ?>"/></td><td width="166">Lieu de naissance</td><td width="226"><input type="text" name="lieu_naissance" id="lieu_naissance"  onblur="fill3();"  onkeyup="lookup3(this.value);" value="<?php echo $retour[31]; ?>" /><div class="suggestionsBox" id="suggestions3" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList3">
					&nbsp;
				
			</div></div></td></tr><tr>
 <td>Deuxieme prenom</td><td><input type="text" value="<?php echo $retour[2]; ?>" name="n_middle" /></td><td>Email bureau</td><td><input name="email" value="<?php echo $retour[11]; ?>" type="text" /></td><td width="166">Situtation maritale</td>
 <td width="226"><select style="width:120px" name="situation" ><option value="<?php echo $retour[29];?>"><?php echo $retour[29];?></option><?php $epce->texte('Situation maritale');?></select></td></tr><tr>
  <td>Nom de jeune fille</td>
 <td><input name="n_suffix"  value="<?php echo $retour[4]; ?>"type="text" /></td>
 <td>Email domicile</td>
 <td><input name="email_home" value="<?php echo $retour[12]; ?>" type="text" /></td>
 <td width="166">Enfants a charge</td>
 <td width="226"><select style="width:120px" name="enfant"><option value="<?php echo $retour[28];?>"><?php echo $retour[28];?></option><?php for($i=0;$i<11;$i++){echo" <option value='$i'>$i</option>'";} ?></select></td></tr><tr>
  <td>Id Pole emploi</td>
 <td><input  type="text" name="id_pole" value="<?php echo $retour[26];?>" /></td>
 <td>Site web</td>
 <td><input name="url" value="<?php echo $retour[10]; ?>" type="text" /></td> <td width="101">Nationalite</td>
 <td width="225"><select style="width:120px" name="nationalite"><option value="<?php echo $retour[30];?>"><?php echo $retour[30];?></option><?php $epce->texte('Nationalite');?></select></td></tr></table></div>
<a href="javascript:voirdiv('prive')">
<h3>Adresse personnelle</h3></a>
<div id="prive" style="display:none">
<hr style="border:1px dashed" />
<table>
 
  <tr>
    <td width="200">Rue</td>
    <td width="200"><input size="33" value="<?php echo $retour[13]; ?>" name="adr_two_street" type="text" /></td>
  </tr>
  <tr>
    <td>Code postal</td>
    <td><input name="adr_two_postalcode"  onblur="fill();" id="inputString" onkeyup="lookup(this.value);"  value="<?php echo $retour[16]; ?>" type="text" /></td>
    <td width="200">Ville</td>
    <td width="200"><input name="adr_two_locality" id="adr_two_locality" value="<?php echo $retour[14]; ?>" type="text" /></td>
  </tr>
  <tr>
    <td>Region</td>
    <td><input name="adr_two_region" id="adr_two_region" value="<?php echo $retour[15]; ?>" type="text" /></td>
    <td>Pays</td>
    <td><input name="adr_two_countryname" id="adr_two_countryname" value="<?php echo $retour[17]; ?>" type="text" /></td>
  </tr>
</table><div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</div>
			</div></div>

<a href="javascript:voirdiv('societe')">
<h3>Adresse professionnelle</h3></a>
<div id="societe" style="display:none">
<hr style="border:1px dashed"/><table><tr>
  <td width="200">Societe</td>
  <td width="200"><input name="org_name" value="<?php echo $retour[6]; ?>" type="text" /></td>
  <td>Forme juridique</td>
  <td><select style="width:120px" name="form_juri"><option value="<?php echo $retour[46];?>"><?php echo $retour[46];?></option><?php $epce->texte('forme_juridique');?></select></td>
</tr>
  <tr>
    <td>Service</td>
    <td><input name="title" value="<?php echo $retour[23]; ?>" type="text" /></td>
    <td width="200">Fonction</td>
    <td width="200"><input name="org_unit" value="<?php echo $retour[24]; ?>" type="text" /></td>
  </tr>
  <tr>
      <td>N de siret</td>
  <td><input type="text" name="siret"  value="<?php echo $retour[43];?>" /></td><td>Date d'immatriculation</td>
    <td><input type="text" id="immat" name="immat" value="<?php if($retour[44]!=0)echo date('d/m/Y',$retour[44]);?>" /> 	<script type="text/javascript"> document.writeln('<img id="immat-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "immat",
		button      : "immat-trigger"
	}
	);</script></td>
  </tr>
  <tr><td>Capital</td><td><input style="text-align:right" size="7"  name="capital" type="text" value="<?php echo $retour[45];?>"  /> <img width="11" height="11" src="../images/money_euro.png" /></td></tr>
    <td>Rue</td>
    <td><input name="adr_one_street"  size="33" value="<?php echo $retour[18]; ?>" type="text" /></td>
  </tr>
  <tr>
    <td>Code postal</td>
    <td><input onblur="fill2();" id="adr_one_postalcode" onkeyup="lookup2(this.value);" name="adr_one_postalcode" value="<?php echo $retour[21]; ?>" type="text" /></td>
    <td>Ville</td>
    <td><input name="adr_one_locality" id="adr_one_locality" type="text" value="<?php echo $retour[19]; ?>" /></td>
  </tr>
  <tr>
    <td>Region</td>
    <td><input name="adr_one_region" id="adr_one_region" value="<?php echo $retour[20]; ?>" type="text" /></td>
    <td>Pays</td>
    <td><input name="adr_one_countryname" id="adr_one_countryname" value="<?php echo $retour[22]; ?>" type="text" /></td>
  </tr>
</table>
<div class="suggestionsBox" id="suggestions2" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
		  <div class="suggestionList" id="autoSuggestionsList2">
					&nbsp;
				
			</div></div></div>
<a href="javascript:voirdiv('demandeur_emploi')"><h3>Si demandeur d'emploi</h3></a>
<div id="demandeur_emploi" style="display:none"><hr />
<table>
 
  <tr>
    <td width="200">Situation pro.</td>
    <td width="200"><select style="width:120px" name="situation_pro"><option value="<?php if($retour[33]==NULL){echo 'Sans activite';}else{echo $retour[33];}?>"><?php  if($retour[33]==NULL){echo 'Sans activite';}else{echo $retour[33];}?></option><?php $epce->texte('Situation professionnelle');?></select></td>
    <td width="200">Num CAF</td>
    <td width="200"><input name="caf" type="text" value="<?php echo $retour[34];?>"/></td>
  </tr>
  <tr>
    <td>Statut 1</td>
    <td><select style="width:120px" name="statut_1"><option value="<?php echo $retour[35];?>"><?php echo $retour[35];?></option><?php $epce->texte('Statut 1');?></select></td>
    <td width="100">Indemnite 1</td>
    <td width="144"><select style="width:120px" name="indemnite_1">
      <option value="<?php echo $retour[37];?>"><?php echo $retour[37];?></option>
      <?php $epce->texte('Indemnite_1');?>
    </select></td>
  </tr>
  <tr>
    <td>Statut 2</td>
    <td><select style="width:120px" name="statut_2">
      <option value="<?php echo $retour[36];?>"><?php echo $retour[36];?></option>
        <?php $epce->texte('Statut 1');?>
      </select></td>
    <td>Indemnite 2</td>
    <td><select style="width:120px" name="indemnite_2"><option value="<?php echo $retour[38];?>"><?php echo $retour[38];?></option><?php $epce->texte('Indemnite_1');?></select></td>
  </tr>
</table>
</div>
<a href="javascript:voirdiv('formation')"><h3>Formation</h3></a>
<div style="display:none" id="formation">
<hr />
<table>
 
  <tr>
    <td width="199">Niveau de formation</td>
    <td width="201"><select style="width:120px" name="niveau_formation"><option value="<?php echo $retour[39];?>"><?php echo $retour[39];?></option><?php $epce->texte('Niveau de formation');?></select></td>
    <td>Intitule du diplome</td>
    <td width="146"><input  name="intitule_formation" value="<?php echo $retour[40];?>" type="text" /></td><td width="159"><input <?php echo $statut_f1; ?> type="radio" name="statut_diplome1" value="Obtenu" />  
    Obtenu 
      <input <?php echo $statut_f2; ?> type="radio" name="statut_diplome1" value="Niveau" />  
    Niveau </td><td width="148">le <input name="dd1" id="dd1" size="15" type="text" value="<?php echo $dat_f; ?>" /><script type="text/javascript">

	document.writeln('<img id="dd1-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "dd1",
		button      : "dd1-trigger"
	}
	);
</script></td><td width="40"><select name="cote_formation1" style="width:40px" ><option value="<?php echo $co; ?>"><?php echo $co; ?></option><option>1</option><option>2</option><option>3</option><option>4</option></select></td>
  </tr>
  <tr>
    <td>F.en rapport avec P.</td>
    <td><select style="width:120px" name="niveau_formation_projet"><option value="<?php echo $retour[41];?>"><?php echo $retour[41];?></option><?php $epce->texte('Niveau de formation');?></select></td>
    <td width="199">Intitule du diplome</td>
    <td width="146"><input  name="intitule_formation_projet" value="<?php echo $retour[42];?>" type="text"  /></td><td width="159"><input type="radio" name="statut_diplome2" <?php echo $statut2_f1; ?> value="Obtenu" />  
    Obtenu  
      <input type="radio"  <?php echo $statut2_f2; ?> name="statut_diplome2" value="Niveau" />  
    Niveau </td><td width="148">le 
      <input  size="15" id="dd2" name="dd2" type="text" value="<?php echo $dat_f2; ?>" /><script type="text/javascript">

	document.writeln('<img id="dd2-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "dd2",
		button      : "dd2-trigger"
	}
	);
</script></td><td width="40"><select name="cote_formation2" style="width:40px"><option value="<?php echo $co2; ?>"><?php echo $co2; ?></option><option>1</option><option>2</option><option>3</option><option>4</option></select></td>
  </tr>
  
</table></div>

<p align="center"><input style="font-size:20px; background-color: #039; color:#FFF"  type="submit" value="Sauvegarder" /></p></form></div><br/><br/>
<?php if(isset($_POST['n_family']))
{ 
$rapport = new Rapport_activite($_SESSION['id']);
$rapport->action('sauvegarde les informations personnelles de '.$retour[6].'  '. $retour[0].' '.$retour[1].' '.$retour[2].' '.$retour[3].' '.$retour[4].'');

$epce->update_ben($choix,NULL,'n',''.$epce->cat_id_owner.'',$private_e,''.$epce->cat_id_beneficiaire.'',$_POST['n_prefix'].' '.$_POST['n_given'].' '.$_POST['n_family'].' '.$_POST['n_suffix'],$_POST['n_family'],$_POST['n_given'],$_POST['n_middle'],$_POST['n_prefix'],$_POST['n_suffix'],NULL,$_POST['a1'].'/'.$_POST['a2'].'/'.$_POST['a3'],NULL,'0',$_POST['lieu_naissance'],$_POST['url'],$_POST['age'],$_POST['org_name'],$_POST['org_unit'],$_POST['title'],$_POST['adr_one_street'],$_POST['adr_one_locality'],$_POST['adr_one_region'],$_POST['adr_one_postalcode'],$_POST['adr_one_countryname'],NULL,$_POST['nationalite'],$_POST['adr_two_street'],$_POST['adr_two_locality'],$_POST['adr_two_region'],$_POST['adr_two_postalcode'],$_POST['adr_two_countryname'],$_POST['indemnite_2'],$_POST['tel_work'],$_POST['tel_home'],$_POST['n_lettre'],$_POST['id_pole'],$_POST['enfant'],$_POST['tel_cell'],$_POST['situation'],$_POST['situation_pro'],$_POST['caf'],$_POST['statut_1'],$tel_isdn_e,$_POST['statut_2'],$_POST['indemnite_1'],$_POST['email'],'INTERNET',$_POST['email_home'],'INTERNET',time(),$_POST['niveau_formation'],$_POST['intitule_formation'],$_POST['niveau_formation_projet'],$_POST['intitule_formation_projet'],$_POST['date_debut_epce'],$_POST['date_fin_epce'],$_POST['siret'],$_POST['immat'],$_POST['form_juri'],$_POST['capital'],$_POST['statut_diplome1'],$_POST['statut_diplome2'],$_POST['dd1'],$_POST['dd2'],$_POST['cote_formation1'],$_POST['cote_formation2']);



unset($_POST['n_family']);
echo'<script>window.location.replace("panel.php?valid=1&annee=10&choix='.$choix.'");</script>';
}
?>