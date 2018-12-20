

<a href="javascript:voirplan_eval()">Plan d'evaluation</a> | <a href="javascript:voircoherence_hp()">Coherence Homme/projet</a> | <a href="javascript:voircommerciaux()">Aspects commerciaux</a> | <a href="javascript:voirfinancier()">Aspects financiers</a> | <a href="javascript:voirjuridique()">Forme juridique</a> <!--| <a href="javascript:voirreglementaire()">Aspect reglementaire</a>-->

<form name="form1" action="../evaluation/eval.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $choix; ?>" />
<div style="display:block; border:2px solid #000; background-color:#FEFBC5" id="plan"><h3>1. Le projet du beneficiaire</h3>
<br/><center><table width="834"><tr><td width="343">Description succincte du
projet par le referent</td><td width="479"><input style="color:#F00; font-weight:bolder"  type="text" size="53" name="descrip_proj" value="<?php echo $v_plan[0]; ?>" /></td></tr><tr><td>Etat d'avancement du
projet</td><td><select  name="etat_proj"><option value="<?php echo $v_plan[1];?>"><?php echo $v_plan[1];?></option><?php $epce->texte('stade_projet');?></select></td></tr><tr><td>Points a evaluer
priorite</td><td><select name="pt_a_evaluer"><option value="<?php echo $v_plan[2];?>"><?php echo $v_plan[2];?></option><?php $epce->texte('pt');?></select></td></tr><tr><td>
</td><td><select name="pt_a_evaluer2"><option value="<?php echo $v_plan[14];?>"><?php echo $v_plan[14];?></option><?php $epce->texte('pt');?></select></td></tr><tr><td>
</td><td><select name="pt_a_evaluer3"><option value="<?php echo $v_plan[15];?>"><?php echo $v_plan[15];?></option><?php $epce->texte('pt');?></select></td></tr></table></center>
<br/>
<h3>2. Les attentes du beneficiaire</h3>
<br/><center><table width="833"><tr><td width="342">Attentes du beneficiaire</td><td width="479"><select name="attente_benef"><option value="<?php echo $v_plan[3];?>"><?php echo $v_plan[3];?></option><?php $epce->texte('Attentes du beneficiaire');?></select></td></tr><tr><td width="342"></td><td width="479"><select name="attente_benef2"><option value="<?php echo $v_plan[16];?>"><?php echo $v_plan[16];?></option><?php $epce->texte('Attentes du beneficiaire');?></select></td></tr><tr><td>Commentaires du
referent</td><td><textarea  name="comment_ref" cols="50" rows="3" ><?php echo $v_plan[4];?></textarea></td></tr><tr></table></center><br/>
<h3>Plan d'evaluation personnalise</h3>
<br/>
<center><table><tr><td>Contractualisation</td> 
<td><input name="sign" type="checkbox"  <?php if($v_plan[13]==1)echo 'checked="checked"'; ?>   value="1"/></td></tr></table>
<br/><?php $epce->selectionner_rdv_plan($choix); ?><br/><br/></center>
</div>

 <div style="display:none; border:2px solid #000; background-color:#D3FEC5"  id="coherence_hp">
        
    <h3>Formation, competences et capacites du porteur de projet</h3><br>

	 
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
       <center> <table width="537" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="137" align="center" class="td1">Experience Professionnelle</td><td></td><td></td><td align="center">Competences professionnelles</td>
             
                <td width="261" align="center" class="tdFin">Formation et savoirs theorique </td>
              </tr>
              <tr>
                <td class="td1 table1Col1"><input type="text" name="exp_pro"  size="45" value="<?php echo $v_hp[0];?>" /><br/><input size="45" type="text" name="exp_pro2" value="<?php echo $v_hp[1];?>" /><br/><input size="45" type="text" name="exp_pro3" value="<?php echo $v_hp[2];?>"  /><br/><input size="45" type="text" name="exp_pro4" value="<?php echo $v_hp[3];?>" /><br/><input size="45" type="text" name="exp_pro5" value="<?php echo $v_hp[4];?>"  /><br/><input size="45" type="text" name="exp_pro6" value="<?php echo $v_hp[5];?>"  /><br/>
              
                </td><td><td></a></td>
                <td class="td1 table1Col2">
                   <select name="comp_pro"><option value="<?php echo $v_hp[6];?>"> <?php echo $v_hp[6];?></option><?php $epce->texte('Competences professionnelles'); ?></select> <br/><select  name="comp_pro2"><option value="<?php echo $v_hp[7];?>"> <?php echo $v_hp[7];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select   name="comp_pro3"><option value="<?php echo $v_hp[8];?>"> <?php echo $v_hp[8];?></option><?php $epce->texte('Competences professionnelles'); ?></select>
                  <br/><select  name="comp_pro4"><option value="<?php echo $v_hp[9];?>"> <?php echo $v_hp[9];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select name="comp_pro5"><option value="<?php echo $v_hp[10];?>"> <?php echo $v_hp[10];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select  name="comp_pro6"><option value="<?php echo $v_hp[11];?>"> <?php echo $v_hp[11];?></option><?php $epce->texte('Competences professionnelles'); ?></select></td>
              <td class="tdFin table1Col3"><select name="form_savoir"><option value="<?php echo $v_hp[12];?>"> <?php echo $v_hp[12];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select> <br/><select  name="form_savoir2"><option value="<?php echo $v_hp[13];?>"> <?php echo $v_hp[13];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select   name="form_savoir3"><option value="<?php echo $v_hp[14];?>"> <?php echo $v_hp[14];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/>
                <span class="td1 table1Col2">
                <select  name="form_savoir4">
                  <option value="<?php echo $v_hp[15];?>"> <?php echo $v_hp[15];?></option>
                  <?php $epce->texte('Formation et savoirs theoriques'); ?>
                </select>
                </span><br/><select name="form_savoir5"><option value="<?php echo $v_hp[16];?>"> <?php echo $v_hp[16];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select name="form_savoir6"><option value="<?php echo $v_hp[17];?>"> <?php echo $v_hp[17];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select>
              </td>
              </tr>
            </tbody></table></center><br>

 <h3>Elements porteurs et points de vigilance par rapport au projet</h3><br>
    <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Elements porteurs</td>
                <td class="tdFin" align="center">Points de vigilance</td>
             
              </tr>
              <tr>
                <td class="td1 table2Col1"><select  name="element_porteur"><option value="<?php echo $v_hp[30];?>"> <?php echo $v_hp[30];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select   name="element_porteur2"><option value="<?php echo $v_hp[31];?>"> <?php echo $v_hp[31];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select  name="element_porteur3"><option value="<?php echo $v_hp[32];?>"> <?php echo $v_hp[32];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select  name="element_porteur4"><option value="<?php echo $v_hp[33];?>"> <?php echo $v_hp[33];?></option><?php $epce->texte('Elements porteurs'); ?></select></td>
                <td class="tdFin table2Col2"> <select  name="points_vigilance"><option value="<?php echo $v_hp[34];?>"> <?php echo $v_hp[34];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/> <select  name="points_vigilance2"><option value="<?php echo $v_hp[35];?>"> <?php echo $v_hp[35];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/><select   name="points_vigilance3"><option value="<?php echo $v_hp[36];?>"> <?php echo $v_hp[36];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/><select  name="points_vigilance4"><option value="<?php echo $v_hp[37];?>"> <?php echo $v_hp[37];?></option><?php $epce->texte('Points de vigilance'); ?></select>              
                </td>
            </tr>
            </tbody></table></td></center><br>
 <h3>Besoins de formation courte identifiee</h3>
 <br>
 <center><table width="635" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="233" align="center" class="td1">Competences a acquerir ou renforcer</td>
                <td width="178" align="center" class="td1">Delais/priorite</td>
                <td width="222" align="center" class="tdFin">Type de formation courte recommandee</td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><select  name="compt1"><option value="<?php echo $v_hp[18];?>"> <?php echo $v_hp[18];?></option><?php $epce->texte('Competence'); ?></select><br/> <select  name="compt2"><option value="<?php echo $v_hp[19];?>"> <?php echo $v_hp[19];?></option><?php $epce->texte('Competence'); ?></select><br/><select   name="compt3"><option value="<?php echo $v_hp[20];?>"> <?php echo $v_hp[20];?></option><?php $epce->texte('Competence'); ?></select><br/><select  name="compt4"><option value="<?php echo $v_hp[21];?>"> <?php echo $v_hp[21];?></option><?php $epce->texte('Competence'); ?></select> </td>
                <td class="td1 table3Col2"><select  name="delai1"><option value="<?php echo $v_hp[22];?>"> <?php echo $v_hp[22];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/> <select  name="delai2"><option value="<?php echo $v_hp[23];?>"> <?php echo $v_hp[23];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/><select   name="delai3"><option value="<?php echo $v_hp[24];?>"> <?php echo $v_hp[24];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/><select  name="delai4"><option value="<?php echo $v_hp[25];?>"> <?php echo $v_hp[25];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="type1"><option value="<?php echo $v_hp[26];?>"> <?php echo $v_hp[26];?></option><?php $epce->texte('Type de formation courte recommandee'); ?></select><br/> <select  name="type2"><option value="<?php echo $v_hp[27];?>"> <?php echo $v_hp[27];?></option><?php $epce->texte('Type de formation courte recommandee'); ?></select><br/><select   name="type3"><option value="<?php echo $v_hp[28];?>"> <?php echo $v_hp[28];?></option><?php $epce->texte('Type de formation courte recommandee'); ?></select><br/><select  name="type4"><option value="<?php echo $v_hp[29];?>"> <?php echo $v_hp[29];?></option><?php $epce->texte('Type de formation courte recommandee'); ?></select></td>
              </tr>
            </tbody></table></center>
 
        
</div>
        
        
             
        
        <div style="border:2px solid #000; background-color:#F9EF75; display:none"  id="financier">
        <h3>Points forts et points faibles du plan de financement</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
          
       <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="251" align="center" class="td1"></td>
                <td width="283" align="center" class="td1">Points forts</td>
                <td width="283" align="center" class="tdFin">Points faibles</td>
              </tr>
              <tr>
                <td class="td1 table1Col1">Apport et/ou recherche de financement</td>
                <td class="td1 table1Col2"><select  onchange="voir_select('an_be_cl_fi_pt_fort2');" name="an_be_cl_fi_pt_fort"><option value="<?php echo $v_fi[0];?>"> <?php echo $v_fi[0];?></option><?php $epce->texte('Points forts financements'); ?></select></td>
                <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_fi_pt_faible2');" name="an_be_cl_fi_pt_faible"><option value="<?php echo $v_fi[1];?>"> <?php echo $v_fi[1];?></option><?php $epce->texte('Points faibles financements'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_fi_pt_fort3');" id="an_be_cl_fi_pt_fort2" name="an_be_cl_fi_pt_fort2" style="display:none" ><option value="<?php echo $v_fi[23];?>"> <?php echo $v_fi[23];?></option><?php $epce->texte('Points forts financements'); ?></select></td>
                <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_fi_pt_faible3');" id="an_be_cl_fi_pt_faible2" style="display:none" name="an_be_cl_fi_pt_faible2"><option value="<?php echo $v_fi[26];?>"> <?php echo $v_fi[26];?></option><?php $epce->texte('Points faibles financements'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select style="display:none" onchange="voir_select('an_be_cl_fi_pt_fort4');" id="an_be_cl_fi_pt_fort3" name="an_be_cl_fi_pt_fort3">
                  <option value="<?php echo $v_fi[24];?>"> <?php echo $v_fi[24];?></option>
                  <?php $epce->texte('Points forts financements'); ?>
                </select></td>
                <td class="tdFin table1Col3"><select style="display:none" onchange="voir_select('an_be_cl_fi_pt_faible4');"  id="an_be_cl_fi_pt_faible3" name="an_be_cl_fi_pt_faible3"><option value="<?php echo $v_fi[27];?>"> <?php echo $v_fi[27];?></option><?php $epce->texte('Points faibles financements'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="an_be_cl_fi_pt_fort4"  name="an_be_cl_fi_pt_fort4"  value="<?php echo $v_fi[25]; ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_be_cl_fi_pt_faible4" name="an_be_cl_fi_pt_faible4"  value="<?php echo $v_fi[28]; ?>" /></td>
              </tr><tr><td><br/></td></tr>
                 <tr>
                <td class="td1 table1Col1">Calcul du point mort</td>
                <td class="td1 table1Col2"><select  onchange="voir_select('an_con_fi_pt_fort2');" name="an_con_fi_pt_fort"><option value="<?php echo $v_fi[2];?>"> <?php echo $v_fi[2];?></option><?php $epce->texte('Points forts point mort'); ?></select></td>
                <td class="tdFin table1Col3"><select     onchange="voir_select('an_con_fi_pt_faible2');" name="an_con_fi_pt_faible"><option value="<?php echo $v_fi[3];?>"> <?php echo $v_fi[3];?></option><?php $epce->texte('Points faibles point mort'); ?></select></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('an_con_fi_pt_fort3');" id="an_con_fi_pt_fort2" name="an_con_fi_pt_fort2"><option value="<?php echo $v_fi[29]; ?>"> <?php echo $v_fi[29]; ?></option><?php $epce->texte('Points forts point mort'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('an_con_fi_pt_faible3');"  id="an_con_fi_pt_faible2" name="an_con_fi_pt_faible2"><option value="<?php echo $v_fi[32]; ?>"> <?php echo $v_fi[32]; ?></option><?php $epce->texte('Points faibles point mort'); ?></select></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select  style="display:none"  onchange="voir_select('an_con_fi_pt_fort4');" id="an_con_fi_pt_fort3" name="an_con_fi_pt_fort3"><option value="<?php echo $v_fi[30]; ?>"><?php echo $v_fi[30]; ?> </option><?php $epce->texte('Points forts point mort'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('an_con_fi_pt_faible4');"  id="an_con_fi_pt_faible3" name="an_con_fi_pt_faible3"><option value="<?php echo $v_fi[33]; ?>"><?php echo $v_fi[33]; ?> </option><?php $epce->texte('Points faibles point mort'); ?></select></td>
              </tr>    <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="an_con_fi_pt_fort4" name="an_con_fi_pt_fort4"  value="<?php echo $v_fi[31]; ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_con_fi_pt_faible4" name="an_con_fi_pt_faible4"  value="<?php echo $v_fi[34]; ?>" /></td>
              </tr><tr><tr><td><br/></td></tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement initial</td>
                <td class="td1 table1Col2"><select    onchange="voir_select('stra_fi_pt_fort2');" name="stra_fi_pt_fort"><option value="<?php echo $v_fi[4];?>"> <?php echo $v_fi[4];?></option><?php $epce->texte('Points forts pfi'); ?></select></td>
                <td class="tdFin table1Col3"><select    onchange="voir_select('stra_fi_pt_faible2');" name="stra_fi_pt_faible"><option value="<?php echo $v_fi[5];?>"> <?php echo $v_fi[5];?></option><?php $epce->texte('Points faibles pfi'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select  style="display:none" onchange="voir_select('stra_fi_pt_fort3');" id="stra_fi_pt_fort2" name="stra_fi_pt_fort2"><option value="<?php echo $v_fi[35]; ?>"> <?php echo $v_fi[35]; ?></option><?php $epce->texte('Points forts pfi'); ?></select></td>
                <td class="tdFin table1Col3"><select  style="display:none"  onchange="voir_select('stra_fi_pt_faible3');" id="stra_fi_pt_faible2" name="stra_fi_pt_faible2"><option value="<?php echo $v_fi[38]; ?>"><?php echo $v_fi[38]; ?></option><?php $epce->texte('Points faibles pfi'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('stra_fi_pt_fort4');" id="stra_fi_pt_fort3" name="stra_fi_pt_fort3"><option value="<?php echo $v_fi[36]; ?>"> <?php echo $v_fi[36];?></option><?php $epce->texte('Points forts pfi'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('stra_fi_pt_faible4');" id="stra_fi_pt_faible3" name="stra_fi_pt_faible3"><option value="<?php echo $v_fi[39]; ?>"><?php echo $v_fi[39]; ?> </option><?php $epce->texte('Points faibles pfi'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="stra_fi_pt_fort4" name="stra_fi_pt_fort4"  value="<?php echo $v_fi[37]; ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="stra_fi_pt_faible4" name="stra_fi_pt_faible4"  value="<?php echo $v_fi[40]; ?>" /></td>
              </tr><tr><td><br/></td></tr>
              
                 <tr>
                <td class="td1 table1Col1">Plan de financement a trois ans</td>
                <td class="td1 table1Col2"><select    onchange="voir_select('plan_fi_pt_fort2');" name="plan_fi_pt_fort"><option value="<?php echo $v_fi[6];?>"> <?php echo $v_fi[6];?></option><?php $epce->texte('Points forts pf3'); ?></select></td>
                <td class="tdFin table1Col3"><select    onchange="voir_select('plan_fi_pt_faible2');" name="plan_fi_pt_faible"><option value="<?php echo $v_fi[7];?>"> <?php echo $v_fi[7];?></option><?php $epce->texte('Points faibles pf3'); ?></select></td>
              </tr>  <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('plan_fi_pt_fort3');" id="plan_fi_pt_fort2" name="plan_fi_pt_fort2"><option value="<?php echo $v_fi[41]; ?>"><?php echo $v_fi[41]; ?></option><?php $epce->texte('Points forts pf3'); ?></select></td>
                <td class="tdFin table1Col3"><select  style="display:none"  onchange="voir_select('plan_fi_pt_faible3');" id="plan_fi_pt_faible2" name="plan_fi_pt_faible2"><option value="<?php echo $v_fi[44]; ?>"><?php echo $v_fi[44]; ?> </option><?php $epce->texte('Points faibles pf3'); ?></select></td>
              </tr> 
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('plan_fi_pt_fort4');" id="plan_fi_pt_fort3" name="plan_fi_pt_fort3"><option value="<?php echo $v_fi[42]; ?>"><?php echo $v_fi[42]; ?> </option><?php $epce->texte('Points forts pf3'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('plan_fi_pt_faible4');" id="plan_fi_pt_faible3" name="plan_fi_pt_faible3"><option value="<?php echo $v_fi[45]; ?>"> <?php echo $v_fi[45]; ?></option><?php $epce->texte('Points faibles pf3'); ?></select></td>
              </tr> 
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="plan_fi_pt_fort4" name="plan_fi_pt_fort4"  value="<?php echo $v_fi[43]; ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="plan_fi_pt_faible4" name="plan_fi_pt_faible4"  value="<?php echo $v_fi[46]; ?>" /></td>
              </tr> <tr><td><br/></td></tr>
               <tr>
                <td class="td1 table1Col1">Autre points</td>
                <td class="td1 table1Col2"><select   style="display:block" onchange="voir_select('autre_fi_pt_fort2');" name="autre_fi_pt_fort"><option value="<?php echo $v_fi[8];?>"> <?php echo $v_fi[8];?></option><?php $epce->texte('Points forts'); ?></select></td>
                <td class="tdFin table1Col3"><select  style="display:block" onchange="voir_select('autre_fi_pt_faible2');" name="autre_fi_pt_faible"><option value="<?php echo $v_fi[9];?>"> <?php echo $v_fi[9];?></option><?php $epce->texte('Points faibles'); ?></select></td>
              </tr> <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('autre_fi_pt_fort3');"  id="autre_fi_pt_fort2" name="autre_fi_pt_fort2"><option value="<?php echo $v_fi[47]; ?>"> <?php echo $v_fi[47]; ?></option><?php $epce->texte('Points forts'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('autre_fi_pt_faible3');" id="autre_fi_pt_faible2" name="autre_fi_pt_faible2"><option value="<?php echo $v_fi[50]; ?>"><?php echo $v_fi[50]; ?></option><?php $epce->texte('Points faibles'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><select   style="display:none" onchange="voir_select('autre_fi_pt_fort4');" id="autre_fi_pt_fort3" name="autre_fi_pt_fort3"><option value="<?php echo $v_fi[48]; ?>"> <?php echo $v_fi[48]; ?></option><?php $epce->texte('Points forts'); ?></select></td>
                <td class="tdFin table1Col3"><select   style="display:none" onchange="voir_select('autre_fi_pt_faible4');" id="autre_fi_pt_faible3" name="autre_fi_pt_faible3"><option value="<?php echo $v_fi[51]; ?>"><?php echo $v_fi[51]; ?> </option><?php $epce->texte('Points faibles'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table1Col1">&nbsp;</td>
                <td class="td1 table1Col2"><input style="display:none" size="55" id="autre_fi_pt_fort4" name="autre_fi_pt_fort4"  value="<?php echo $v_fi[49]; ?>" /></td>
                <td class="tdFin table1Col3"><input style="display:none" size="55" id="autre_fi_pt_faible4" name="autre_fi_pt_faible4"  value="<?php echo $v_fi[52]; ?>" /></td>
              </tr>
            </tbody></table></center>
        <br>

 
 <h3>Plan d'actions</h3><br>
 <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td>
                <td class="td1" align="center">Delais de realisation</td>
                <td class="tdFin" align="center">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><select  name="action1_fi"><option value="<?php echo $v_fi[10];?>"> <?php echo $v_fi[10];?></option><?php $epce->texte('Actions'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai1_fi"><option value="<?php echo $v_fi[14];?>"> <?php echo $v_fi[14];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result1_fi"><option value="<?php echo $v_fi[18];?>"> <?php echo $v_fi[18];?></option><?php $epce->texte('Resultat attendu 2'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action2_fi"><option value="<?php echo $v_fi[11];?>"> <?php echo $v_fi[11];?></option><?php $epce->texte('Actions'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai2_fi"><option value="<?php echo $v_fi[15];?>"> <?php echo $v_fi[15];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result2_fi"><option value="<?php echo $v_fi[19];?>"> <?php echo $v_fi[19];?></option><?php $epce->texte('Resultat attendu 2'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action3_fi"><option value="<?php echo $v_fi[12];?>"> <?php echo $v_fi[12];?></option><?php $epce->texte('Actions'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai3_fi"><option value="<?php echo $v_fi[16];?>"> <?php echo $v_fi[16];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result3_fi"><option value="<?php echo $v_fi[20];?>"> <?php echo $v_fi[20];?></option><?php $epce->texte('Resultat attendu 2'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action4_fi"><option value="<?php echo $v_fi[13];?>"> <?php echo $v_fi[13];?></option><?php $epce->texte('Actions'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai4_fi"><option value="<?php echo $v_fi[17];?>"> <?php echo $v_fi[17];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result4_fi"><option value="<?php echo $v_fi[21];?>"> <?php echo $v_fi[21];?></option><?php $epce->texte('Resultat attendu 2'); ?></select></td>
              </tr>
            </tbody></table></center><br>
 <h3>Diagnostic et commentaires du referent</h3><br>
 <center><textarea name="diag_fi" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo $v_fi[22]; ?>
</textarea></center><br/>
     
        
</div>

<div  style="display:none; background-color: #DFE6FF;border:2px solid ; padding:15px" id="commerciaux">
        <h3>Points forts et points faibles de l’etude de marche</h3><br>
   
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
         
      <center>
        <table width="981" cellpadding="0" cellspacing="0" class="tableGen">
          <tbody>
            <tr>
              <td width="273" align="center" class="td1"></td>
              <td width="353" class="td1">Points forts</td>
              <td width="353"  class="tdFin">Points faibles</td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Analyse des besoins des clients</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_pt_fort2');" name="an_be_cl_pt_fort">
                <option value="<?php echo $v_co[0];?>"> <?php echo $v_co[0];?></option>
                <?php $epce->texte('Points forts clients'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select  onchange="voir_select('an_be_cl_pt_faible2');" name="an_be_cl_pt_faible">
                <option value="<?php echo $v_co[1];?>"> <?php echo $v_co[1];?></option>
                <?php $epce->texte('Points faibles clients'); ?>
              </select></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_be_cl_pt_fort3');"  id="an_be_cl_pt_fort2" style="display:none" name="an_be_cl_pt_fort2">
                <option value="<?php echo $v_co[21];?>"> <?php echo $v_co[21];?></option>
                <?php $epce->texte('Points forts clients'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('an_be_cl_pt_faible3');"  id="an_be_cl_pt_faible2" style="display:none" name="an_be_cl_pt_faible2">
                <option value="<?php  echo $v_co[24];?>"> <?php echo $v_co[24];?></option>
                <?php $epce->texte('Points faibles clients'); ?>
              </select></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><select style="display:none" id="an_be_cl_pt_fort3" onchange="voir_select('an_be_cl_pt_fort4');" name="an_be_cl_pt_fort3">
                <option value="<?php echo $v_co[22];?>"> <?php echo $v_co[22];?></option>
                <?php $epce->texte('Points forts clients'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select style="display:none" id="an_be_cl_pt_faible3" onchange="voir_select('an_be_cl_pt_faible4');"  name="an_be_cl_pt_faible3">
                <option value="<?php echo $v_co[25];?>"> <?php echo $v_co[25];?></option>
                <?php $epce->texte('Points faibles clients'); ?>
              </select></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">&nbsp;</td>
              <td class="td1 table1Col2"><input style="display:none" size="55" id="an_be_cl_pt_fort4"  name="an_be_cl_pt_fort4" value="<?php echo $v_co[23];?>" /></td>
              <td class="tdFin table1Col3"><input style="display:none" size="55" id="an_be_cl_pt_faible4" name="an_be_cl_pt_faible4"  value="<?php echo $v_co[26];?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Analyse de la concurrence</td>
              <td class="td1 table1Col2"><select onchange="voir_select('an_con_pt_fort2');"  name="an_con_pt_fort">
                <option value="<?php echo $v_co[2];?>"> <?php echo  $v_co[2];?></option>
                <?php $epce->texte('Points forts concurrence'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('an_con_pt_faible2');" name="an_con_pt_faible">
                <option value="<?php echo $v_co[3];?>"> <?php echo  $v_co[3];?></option>
                <?php $epce->texte('Points faibles concurrence'); ?>
              </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><select onchange="voir_select('an_con_pt_fort3');"  style="display:none"  id="an_con_pt_fort2" name="an_con_pt_fort2">
                <option value="<?php echo $v_co[27];?>"> <?php echo $v_co[27];?></option>
                <?php $epce->texte('Points forts concurrence'); ?>
              </select></td>
              <td><select  onchange="voir_select('an_con_pt_faible3');" style="display:none"  id="an_con_pt_faible2" name="an_con_pt_faible2">
                <option value="<?php echo $v_co[30];?>"><?php echo $v_co[30];?> </option>
                <?php $epce->texte('Points faibles concurrence'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('an_con_pt_fort4');"  style="display:none"  id="an_con_pt_fort3" name="an_con_pt_fort3">
                <option value="<?php echo $v_co[28];?>"><?php echo $v_co[28];?> </option>
                <?php $epce->texte('Points forts concurrence'); ?>
              </select></td>
              <td><select  onchange="voir_select('an_con_pt_faible4');" style="display:none"  id="an_con_pt_faible3" name="an_con_pt_faible3">
                <option value="<?php echo $v_co[31];?>"><?php echo $v_co[31];?> </option>
                <?php $epce->texte('Points faibles concurrence'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="an_con_pt_fort4"  name="an_con_pt_fort4" value="<?php echo $v_co[29];?>" /></td>
              <td><input style="display:none" size="55" id="an_con_pt_faible4"  name="an_con_pt_faible4" value="<?php echo $v_co[32];?>" /></td>
            </tr>
            <tr>
              <td><br/>
                <br/></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td1 table1Col1">Strategie commerciale envisagee</td>
              <td class="td1 table1Col2"><select onchange="voir_select('stra_pt_fort2');" id="stra_pt_fort" name="stra_pt_fort">
                <option value="<?php echo $v_co[4];?>">
                  <?php  echo $v_co[4];?>
                </option>
                <?php $epce->texte('Points forts strategie'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select  onchange="voir_select('stra_pt_faible2');" id="stra_pt_faible" name="stra_pt_faible">
                <option value="<?php echo $v_co[5];?>"> <?php echo $v_co[5];?></option>
                <?php $epce->texte('Points faibles strategie'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><select style="display:none" onchange="voir_select('stra_pt_fort3');" id="stra_pt_fort2" name="stra_pt_fort2">
                <option value="<?php echo $v_co[33];?>"><?php echo $v_co[33];?> </option>
                <?php $epce->texte('Points forts strategie'); ?>
              </select></td>
              <td><select style="display:none" onchange="voir_select('stra_pt_faible3');" id="stra_pt_faible2" name="stra_pt_faible2">
                <option value="<?php echo $v_co[36];?>"><?php echo $v_co[36];?> </option>
                <?php $epce->texte('Points faibles strategie'); ?>
              </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><select style="display:none" onchange="voir_select('stra_pt_fort4');" id="stra_pt_fort3"  name="stra_pt_fort3">
                <option value="<?php echo $v_co[34];?>"><?php echo $v_co[34];?> </option>
                <?php $epce->texte('Points forts strategie'); ?>
              </select></td>
              <td><select  style="display:none" onchange="voir_select('stra_pt_faible4');" id="stra_pt_faible3" name="stra_pt_faible3">
                <option value="<?php echo $v_co[37];?>"><?php echo $v_co[37];?></option>
                <?php $epce->texte('Points faibles strategie'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="stra_pt_fort4"  name="stra_pt_fort4" value="<?php echo $v_co[35];?>" /></td>
              <td><input style="display:none" size="55" id="stra_pt_faible4"  name="stra_pt_faible4" value="<?php echo $v_co[38];?>" /></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td><br/>
                <br/></td>
              <td></td>
            </tr>
            <tr></tr>
            <tr>
              <td class="td1 table1Col1">Autres points</td>
              <td class="td1 table1Col2"><select onchange="voir_select('autre_pt_fort2');" name="autre_pt_fort">
                <option value="<?php echo $v_co[6];?>"> <?php echo $v_co[6];?></option>
                <?php $epce->texte('Points forts'); ?>
              </select></td>
              <td class="tdFin table1Col3"><select onchange="voir_select('autre_pt_faible2');" id="autre_pt_faible" name="autre_pt_faible">
                <option value=""> <?php echo $v_co[7];?></option>
                <?php $epce->texte('Points faibles'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('autre_pt_fort3');" style="display:none"  id="autre_pt_fort2" name="autre_pt_fort2">
                <option value="<?php echo $v_co[39];?>"><?php echo $v_co[39];?> </option>
                <?php $epce->texte('Points forts'); ?>
              </select></td>
              <td><select  onchange="voir_select('autre_pt_faible3');" id="autre_pt_faible2" style="display:none"  name="autre_pt_faible2">
                <option value="<?php echo $v_co[42];?>"> <?php echo $v_co[42];?></option>
                <?php $epce->texte('Points faibles'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><select onchange="voir_select('autre_pt_fort4');" style="display:none"  id="autre_pt_fort3"  name="autre_pt_fort3">
                <option value="<?php echo $v_co[40];?>"><?php echo $v_co[40];?> </option>
                <?php $epce->texte('Points forts'); ?>
              </select></td><td><select onchange="voir_select('autre_pt_faible4');" style="display:none" id="autre_pt_faible3"  name="autre_pt_faible3">
                <option value="<?php echo $v_co[43];?>"><?php echo $v_co[43];?> </option>
                <?php $epce->texte('Points faibles'); ?>
              </select></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="display:none" size="55" id="autre_pt_fort4"  name="autre_pt_fort4" value="<?php echo $v_co[41];?>" /></td><td><input style="display:none" size="55" id="autre_pt_faible4"  name="autre_pt_faible4" value="<?php echo $v_co[44];?>" /></td><td></td>
            </tr>
          </tbody>
        </table>
  </center>
        <br>

 
 <h3>Plan d'actions</h3><br>
 <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td>
                <td class="td1" align="center">Delais de realisation</td>
                <td class="tdFin" align="center">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><select  name="action_commercial1"><option value="<?php echo $v_co[8];?>"> <?php echo $v_co[8];?></option><?php $epce->texte('Action'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai_commercial1"><option value="<?php echo $v_co[12];?>"> <?php echo $v_co[12];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result_commercial1"><option value="<?php echo $v_co[12];?>"> <?php echo $v_co[12];?></option><?php $epce->texte('Resultats attendus 1'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action_commercial2"><option value="<?php echo $v_co[9];?>"> <?php echo $v_co[9];?></option><?php $epce->texte('Action'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai_commercial2"><option value="<?php echo $v_co[13];?>"> <?php echo $v_co[13];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result_commercial2"><option value="<?php echo $v_co[17];?>"> <?php echo $v_co[17];?></option><?php $epce->texte('Resultats attendus 1'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action_commercial3"><option value="<?php echo $v_co[10];?>"> <?php echo $v_co[10];?></option><?php $epce->texte('Action'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai_commercial3"><option value="<?php echo $v_co[14];?>"> <?php echo $v_co[14];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result_commercial3"><option value="<?php echo $v_co[18];?>"> <?php echo $v_co[18];?></option><?php $epce->texte('Resultats attendus 1'); ?></select></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><select  name="action_commercial4"><option value="<?php echo $v_co[11];?>"> <?php echo $v_co[11];?></option><?php $epce->texte('Action'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai_commercial4"><option value="<?php echo $v_co[15];?>"> <?php echo $v_co[15];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result_commercial4"><option value="<?php echo $v_co[19];?>"> <?php echo $v_co[19];?></option><?php $epce->texte('Resultats attendus 1'); ?></select></td>
              </tr>
            </tbody></table></center><br>
 <h3>Diagnostic et commentaires du referent</h3><br>
 <center><textarea name="diag_commercial" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo $v_co[20];?></textarea></center>
      
        
</div>


<div style="border:2px solid #000; background-color:#F999A3 ;display:none" id="juridique">
        <h3>Points forts et points faibles du statut juridique choisi</h3><br>
    
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
        
<center> <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
              
                <td class="td1" align="center">Points forts</td>
                <td class="tdFin" align="center">Points faibles</td>
              </tr>
              <tr>
               
                <td class="td1 table1Col1"><select  name="pt_fort"><option value="<?php echo $v_ju[0];?>"> <?php echo $v_ju[0];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/> <select  name="pt_fort2"><option value="<?php echo $v_ju[1];?>"> <?php echo $v_ju[1];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/><select   name="pt_fort3"><option value="<?php echo $v_ju[2];?>"> <?php echo $v_ju[2];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/><select  name="pt_fort4"><option value="<?php echo $v_ju[3];?>"> <?php echo $v_ju[3];?></option><?php $epce->texte('Points forts statut juridique'); ?></select> </td>
                <td class="tdFin table1Col2"><select  name="pt_faible"><option value="<?php echo $v_ju[4];?>"> <?php echo $v_ju[4];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/> <select  name="pt_faible2"><option value="<?php echo $v_ju[5];?>"> <?php echo $v_ju[5];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/><select   name="pt_faible3"><option value="<?php echo $v_ju[6];?>"> <?php echo $v_ju[6];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/><select  name="pt_faible4"><option value="<?php echo $v_ju[7];?>"> <?php echo $v_ju[7];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select></td>
              </tr>
            </tbody></table></center>
        <br>

 
 <h3>Plan d'actions</h3><br>
 <center><table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td>
                <td class="td1" align="center">Delais de realisation</td>
                <td class="tdFin" align="center">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><select  name="ac1"><option value="<?php echo $v_ju[8];?>"><?php echo $v_ju[8];?></option><?php $epce->texte('Action'); ?></select><br/> <select  name="ac2"><option value="<?php echo $v_ju[9];?>"> <?php echo $v_ju[9];?></option><?php $epce->texte('Action'); ?></select><br/><select   name="ac3"><option value="<?php echo $v_ju[10];?>"> <?php echo $v_ju[10];?></option><?php $epce->texte('Action'); ?></select><br/><select  name="ac4"><option value="<?php echo $v_ju[11];?>"> <?php echo $v_ju[11];?></option><?php $epce->texte('Action'); ?></select></td>
                <td class="td1 table3Col2"><select  name="delai1_ju"><option value="<?php echo $v_ju[12];?>"><?php echo $v_ju[12];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/> <select  name="delai2_ju"><option value="<?php echo $v_ju[13];?>"><?php echo $v_ju[13];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/><select   name="delai3_ju"><option value="<?php echo $v_ju[14];?>"><?php echo $v_ju[14];?></option><?php $epce->texte('Delais / Priorite'); ?></select><br/><select  name="delai4_ju"><option value="<?php echo $v_ju[15];?>"><?php echo $v_ju[15];?></option><?php $epce->texte('Delais / Priorite'); ?></select></td>
                <td class="tdFin table3Col3"><select  name="result1_ju"><option value="<?php echo $v_ju[16];?>"><?php echo $v_ju[16];?></option><?php $epce->texte('Resultat attendu 3'); ?></select><br/> <select  name="result2_ju"><option value="<?php echo $v_ju[17];?>"><?php echo $v_ju[17];?></option><?php $epce->texte('Resultat attendu 3'); ?></select><br/><select   name="result3_ju"><option value="<?php echo $v_ju[18];?>"><?php echo $v_ju[18];?></option><?php $epce->texte('Resultat attendu 3'); ?></select><br/><select  name="result4_ju"><option value="<?php echo $v_ju[19];?>"><?php echo $v_ju[19];?></option><?php $epce->texte('Resultat attendu 3'); ?></select></td><td></td>
              </tr>
            </tbody></table></center>
 <h3>Diagnostic et commentaires du referent</h3>
 <center><textarea name="diag_ju" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaJuriDiagComm" class="commentaire"><?php echo $v_ju[20]; ?></textarea>
   </center>   <br/>            
   
        
</div><br/>
        
        
      
    
      
      
      
      
      
      
      
      

<center><input style="font-size:20px; background-color: #900    ; color:#FFF"  type="submit" value="Sauvegarder" /></center></form>
<br/><br/>
