
<!-- BEGIN grid  -->
<table width="100%" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="left">

<!-- BEGIN hbox -->




<!-- END hbox -->

</td>
	</tr>
	<tr class="row_off">
		<td class="tab_body" align="left"><input name="exec[personal_|organisation_|home_|details_|links_|evaluation_]" value="addressbook.edit.personal_" type="hidden">
<div style="display: inline;" id="addressbook.edit.personal_">


<!-- BEGIN eTemplate addressbook.edit.personal -->





<!-- BEGIN grid  -->
<div style="padding-left:10px;"> <strong ><br/>
   Formation, compétences et capacités du porteur de projet</strong></div><br/><table width="668" height="20"><tr>
  <td width="217" id="vert"><img src="./images/briefcase_16.png" /> Expériences professionnelles</td>
  <td id="vert" width="217"><img src="./images/gear_16.png" /> Compétences professionnelles</td>
  <td id="vert" width="218"><img src="./images/diagram_16.png"  /> Formation et savoirs théorique </td></tr><tr><td width="217"><textarea name='exp_pro' cols="35" style="font-size:11px"><?php echo $retour[0];?></textarea></td><td width="217"><textarea name='comp_pro' cols="35" style="font-size:11px"><?php echo $retour[1];?></textarea></td><td width="218"><textarea name='form_savoir' cols="35" style="font-size:11px"><?php echo $retour[2];?></textarea> </td></tr></table><br/><div style="padding-left:10px;"> <br/>
  <strong>
    Eléments porteurs et points de vigilance par rapport au projet</strong>
  </div>
  <br/><table width="668" height="20"><tr>
  <td width="217" id="vert">Eléments porteurs</td>
  <td id="rouge" width="439"><img src="./images/warning_16.png" /> Points de vigilance</td></tr><tr><td width="217"><textarea name='element_porteur' cols="35" style="font-size:11px"><?php echo $retour[15];?></textarea></td><td width="439"><textarea name='points_vigilance' cols="35" style="font-size:11px"><?php echo $retour[16];?></textarea></td></tr></table><br/><div style="padding:15px;"><strong>
    Besoins de formation courte identifiée</strong>
  </div><table width="668" height="20"><tr>
  <td width="217" id="vert">Compétences à acquérir ou à renforcer</td><td id="vert" width="217">Délais/priorité</td>
  <td id="vert" width="218">Type formation courte recommandée</td></tr><tr><td width="217"><textarea name="compt1" cols="35" style="font-size:11px"><?php echo $retour[3];?></textarea></td><td width="217"><textarea name="delai1" cols="35" style="font-size:11px"><?php echo $retour[7];?></textarea></td><td width="218"><textarea name="type1" cols="35" style="font-size:11px"><?php echo $retour[11];?></textarea> </td></tr><tr><td width="217"><textarea name="compt2" cols="35" style="font-size:11px"><?php echo $retour[4];?></textarea></td><td width="217"><textarea name="delai2" cols="35" style="font-size:11px"><?php echo $retour[8];?></textarea></td><td width="218"><textarea name="type2" cols="35" style="font-size:11px"><?php echo $retour[12];?></textarea> </td></tr><tr><td width="217"><textarea name="compt3" cols="35" style="font-size:11px"><?php echo $retour[5];?></textarea></td><td width="217"><textarea name="delai3" cols="35" style="font-size:11px"><?php echo $retour[9];?></textarea></td><td width="218"><textarea cols="35" name="type3" style="font-size:11px"><?php echo $retour[13];?></textarea> </td></tr><tr><td width="217"><textarea name="compt4" cols="35" style="font-size:11px"><?php echo $retour[6];?></textarea></td><td width="217"><textarea name="delai4" cols="35" style="font-size:11px"><?php echo $retour[10];?></textarea></td><td width="218"><textarea cols="35" name="type4" style="font-size:11px"><?php echo $retour[14];?></textarea> </td></tr></table><br/> <br/>
  <!-- END grid  -->

<!-- END eTemplate addressbook.edit.personal -->

</div></td></tr></tbody></table>
