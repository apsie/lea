<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
<style>
select
{
	height:19px;
	width:400px;
	}
textarea 
{
	font-family:Arial;
	font-size:12px;
	color: #0289A6;
}
</style>
</head>

<body>
<a href="javascript:voirplan_eval()">Plan d'evaluation</a> | <a href="javascript:voircoherence_hp()">Coherence Homme/projet</a> | <a href="javascript:voircommerciaux()">Aspects commerciaux</a> | <a href="javascript:voirfinancier()">Aspects financiers</a> | <a href="javascript:voirjuridique()">Forme juridique</a> | <a href="javascript:voirreglementaire()">Aspect reglementaire</a>
<form name="form1" action="evaluation/eval.php" method="post"><input type="hidden" name="id_beneficiaire" value="<?php echo $choix; ?>" />
<div style="display:none; border:1px dotted #0F6" id="plan"><h2>1. Le projet du beneficiaire</h2>
<br/><table><tr><td>Description succincte du
projet par le referent</td><td><input type="text" size="45" name="descrip_proj" value="<?php echo $v_plan[0]; ?>" /></td></tr><tr><td>Etat d'avancement du
projet</td><td><select  name="etat_proj"><option value="<?php echo $v_plan[1];?>"><?php echo $v_plan[1];?></option><?php $epce->texte('stade_projet');?></select></td></tr><tr><td>Points a evaluer
priorite</td><td><select name="pt_a_evaluer"><option value="<?php echo $v_plan[2];?>"><?php echo $v_plan[2];?></option><?php $epce->texte('pt');?></select></td></tr></table>
<br/>
<h2>2. Les attentes du beneficiaire</h2>
<br/><table width="711"><tr><td width="429">Attentes du beneficiaire</td><td width="270"><select name="attente_benef"><option value="<?php echo $v_plan[3];?>"><?php echo $v_plan[3];?></option><?php $epce->texte('Attentes du beneficiaire');?></select></td></tr><tr><td>Commentaires du
referent</td><td><input name="comment_ref" type="text" size="45" value="<?php echo $v_plan[4];?>" /></td></tr><tr></table><br/>
<h2>Plan d'evaluation personnalise</h2>
<br/>Contractualisation  <input name="sign" type="checkbox"  <?php if($v_plan[13]==1)echo 'checked="checked"'; ?>   value="1"/>
<br/><br/><br/>
<table width="857"><tr><td width="354">Entretien/Objectif</td><td width="144">Date Prevu</td>
<td width="343">Heure</td></tr>
<tr><td>1.Points forts / Points faibles</td><td><input  readonly="readonly" name="pt_date1" type="text" value="<?php echo $v_rdv_plan[0]; ?>" /></td><td> <input  readonly="readonly" name="pt_date2" type="text" value="<?php echo  $v_rdv_plan[4];  ?>" /></td></tr>
<tr>
  <td>2.<span id="ctl00_cph_contenu_fmv_page_PresPlanProgObj2">Diagnostic et plan d'actions commercial</span></td>
  <td><input name="diagnostic1_date1" type="text"  readonly="readonly" value="<?php echo $v_rdv_plan[1];  ?>"/></td><td> <input readonly="readonly" name="diagnostic1_date2" type="text" value="<?php echo  $v_rdv_plan[5];  ?>" /></td></tr>
<tr>
  <td><span id="ctl00_cph_contenu_fmv_page_PresPlanProgObj3">3.Diagnostic et plan d'actions financier et réglementaire</span></td><td><input name="diagnostic2_date1" type="text" readonly="readonly"  value="<?php echo  $v_rdv_plan[2]; ?>" /></td><td> <input  readonly="readonly"  name="diagnostic2_date2"type="text"  value="<?php echo  $v_rdv_plan[6]; ?>"/></td></tr>
<tr>
  <td>4.<span id="ctl00_cph_contenu_fmv_page_PresPlanProgObj4">Point sur les plans d'actions</span></td><td><input  readonly="readonly" name="pt_plan_date1" type="text" value="<?php echo  $v_rdv_plan[3];  ?>" /></td><td> <input readonly="readonly"  value="<?php echo $v_rdv_plan[7];  ?>"  name="pt_plan_date2" type="text" /></td></tr></table>
</div>
<div style="display:none; border:1px dotted #0F6"  id="coherence_hp"><img src="coherence_homme_projet.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="coherence_homme_projet">
        
    <h2>Formation, competences et capacites du porteur de projet</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	 
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td width="872" colspan="2">
        <table width="537" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="137" align="center" class="td1">Experience Professionnelle</td><td></td><td></td><td align="center">Competences professionnelles</td>
             
                <td width="261" align="center" class="tdFin">Formation et savoirs theorique </td>
              </tr>
              <tr>
                <td class="td1 table1Col1"><input type="text" name="exp_pro"  size="45" value="<?php echo $v_hp[0];?>" /><br/><input size="45" type="text" name="exp_pro2" value="<?php echo $v_hp[1];?>" /><br/><input size="45" type="text" name="exp_pro3" value="<?php echo $v_hp[2];?>"  /><br/><input size="45" type="text" name="exp_pro4" value="<?php echo $v_hp[3];?>" /><br/><input size="45" type="text" name="exp_pro5" value="<?php echo $v_hp[4];?>"  /><br/><input size="45" type="text" name="exp_pro6" value="<?php echo $v_hp[5];?>"  /><br/>
              
                </td><td><td></a></td>
                <td class="td1 table1Col2">
                   <select name="comp_pro"><option value="<?php echo $v_hp[6];?>"> <?php echo $v_hp[6];?></option><?php $epce->texte('Competences professionnelles'); ?></select> <br/><select  name="comp_pro2"><option value="<?php echo $v_hp[7];?>"> <?php echo $v_hp[7];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select   name="comp_pro3"><option value="<?php echo $v_hp[8];?>"> <?php echo $v_hp[8];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select  name="comp_pro4"><option value="<?php echo $v_hp[9];?>"> <?php echo $v_hp[9];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select name="comp_pro5"><option value="<?php echo $v_hp[10];?>"> <?php echo $v_hp[10];?></option><?php $epce->texte('Competences professionnelles'); ?></select><br/><select  name="comp_pro6"><option value="<?php echo $v_hp[11];?>"> <?php echo $v_hp[11];?></option><?php $epce->texte('Competences professionnelles'); ?></select></td>
              <td class="tdFin table1Col3"><select name="form_savoir"><option value="<?php echo $v_hp[12];?>"> <?php echo $v_hp[12];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select> <br/><select  name="form_savoir2"><option value="<?php echo $v_hp[13];?>"> <?php echo $v_hp[13];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select   name="form_savoir3"><option value="<?php echo $v_hp[14];?>"> <?php echo $v_hp[14];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select  name="form_savoir4"><option value="<?php echo $v_hp[15];?>"> <?php echo $v_hp[15];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select name="form_savoir5"><option value="<?php echo $v_hp[16];?>"> <?php echo $v_hp[16];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select><br/><select name="form_savoir6"><option value="<?php echo $v_hp[17];?>"> <?php echo $v_hp[17];?></option><?php $epce->texte('Formation et savoirs theoriques'); ?></select>
              </td>
              </tr>
            </tbody></table><br>

 <h2>Elements porteurs et points de vigilance par rapport au projet</h2><br>
    <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Elements porteurs</td>
                <td class="tdFin" align="center">Points de vigilance</td>
             
              </tr>
              <tr>
                <td class="td1 table2Col1"><select  name="element_porteur"><option value="<?php echo $v_hp[30];?>"> <?php echo $v_hp[30];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select   name="element_porteur2"><option value="<?php echo $v_hp[31];?>"> <?php echo $v_hp[31];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select  name="element_porteur3"><option value="<?php echo $v_hp[32];?>"> <?php echo $v_hp[32];?></option><?php $epce->texte('Elements porteurs'); ?></select><br/><select  name="element_porteur4"><option value="<?php echo $v_hp[33];?>"> <?php echo $v_hp[33];?></option><?php $epce->texte('Elements porteurs'); ?></select></td>
                <td class="tdFin table2Col2"> <select  name="points_vigilance"><option value="<?php echo $v_hp[34];?>"> <?php echo $v_hp[34];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/> <select  name="points_vigilance2"><option value="<?php echo $v_hp[35];?>"> <?php echo $v_hp[35];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/><select   name="points_vigilance3"><option value="<?php echo $v_hp[36];?>"> <?php echo $v_hp[36];?></option><?php $epce->texte('Points de vigilance'); ?></select><br/><select  name="points_vigilance4"><option value="<?php echo $v_hp[37];?>"> <?php echo $v_hp[37];?></option><?php $epce->texte('Points de vigilance'); ?></select>              
                </td>
            </tr>
            </tbody></table><br>
 <h2>Besoins de formation courte identifiee</h2>
 <br>
 <table width="635" cellpadding="0" cellspacing="0" class="tableGen">
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
            </tbody></table>
 <br>            
            </td>
		</tr><tr><td></td></tr>
	</tbody></table>
        
</div>
        </div></div><div style="border:1px dotted #CF0; display:block"  id="financier"><img src="aspects_commerciaux.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="aspect_commerciaux">
        <h2>Points forts et points faibles de l’etude de marche</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td width="639" colspan="2">
       <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="251" align="center" class="td1"></td>
                <td width="137" align="center" class="td1">Points forts</td><td></td>
                <td width="213" align="center" class="tdFin">Points faibles</td><td></td>
              </tr>
              <tr>
                <td class="td1 table1Col1">Apport et/ou recherche de financement</td>
                <td class="td1 table1Col2"><textarea name="an_be_cl_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComCliFor"><?php echo $v_fi[0]; ?></textarea></td>
                <td><img onclick="document.getElementById('an_be_cl_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" > <p><h3>Mots cles : Apport recherche</h3> </p><p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Bon niveau d\'apport personnel');" >Bon niveau d'apport personnel</a><br/>
					   <a onclick="ajout_string('an_be_cl_fi_pt_fort','Activite beneficiant d\'un a priori positif des banques');" >Activite beneficiant d'un a priori positif des banques</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Bon equilibre apport/emprunt');" >Bon equilibre apport/emprunt</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Contacts bancaires en cours positifs');" >Contacts bancaires en cours positifs</a><br/>

                        </span></p><a onclick="document.getElementById('an_be_cl_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div>
                    </td><td class="tdFin table1Col3"><textarea name="an_be_cl_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComCliFaib"><?php echo $v_fi[1]; ?></textarea></td><td><img onclick="document.getElementById('an_be_cl_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots cles : Apport recherche</h3> </p><p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Apport personnel trop faible');" >Apport personnel trop faible</a><br/>
					   <a onclick="ajout_string('an_be_cl_fi_pt_faible','Activite peu prisee par les banques');" >Activite peu prisee par les banques</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Rapport apport/emprunt defavorable');" >Rapport apport/emprunt defavorable</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Demarches bancaires pas encore entamees');" >Demarches bancaires pas encore entamees</a><br/>

                        </span></p><a onclick="document.getElementById('an_be_cl_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Calcul du point mort</td>
                <td class="td1 table1Col2"><textarea name="an_con_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFor"><?php echo $v_fi[2]; ?></textarea></td><td><img onclick="document.getElementById('an_con_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots cles : Calcul points mort</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_con_fi_pt_fort','Point mort argumente et coherent');" >Point mort argumente et coherent</a><br/>
					   <a onclick="ajout_string('an_con_fi_pt_fort','Bonne connaissance des charges fixes');" >Bonne connaissance des charges fixes</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_fort','Bonne approche de la marge brute');" >Bonne approche de la marge brute</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_fort','Marge brut conforme a la profession');" >Marge brut conforme a la profession</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="an_con_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFaib"><?php echo $v_fi[3]; ?></textarea></td><td><img onclick="document.getElementById('an_con_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" >
                      <p><h3>Mots cles : Calcul points mort </h3> </p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('an_con_fi_pt_faible','Charges fixes non chiffrees');" >Charges fixes non chiffrees</a><br/>
					   <a onclick="ajout_string('an_con_fi_pt_faible','Marge brute de l\'activite meconnue');" >Marge brute de l'activite meconnue</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_faible','Point mort non argumente');" >Point mort non argumente</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_faible','Point mort trop eleve');" >Point mort trop eleve</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement initial</td>
                <td class="td1 table1Col2"><textarea name="stra_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFor"><?php echo $v_fi[4]; ?></textarea></td><td><img onclick="document.getElementById('stra_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" ><p><h3>Mots cles : Plan de financement</h3></p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('stra_fi_pt_fort','Investissements bien evalues');" >Investissements bien evalues</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_fort','Bonne estimation des besoins');" >Bonne estimation des besoins</a><br/>
                       <a onclick="ajout_string('stra_fi_pt_fort','BFR bien etudie');" >BFR bien etudie</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_fort','Aides et subventions potentielles non prises en compte');" >Aides et subventions potentielles non prises en compte</a><br/>

                        </span></p><a onclick="document.getElementById('stra_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div>
					</td>
                <td class="tdFin table1Col3"><textarea name="stra_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFaib"><?php echo $v_fi[5]; ?></textarea></td><td><img onclick="document.getElementById('stra_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" >   <p><h3>Mots cle : Plan de financement</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('stra_fi_pt_faible','Coût de demarrage approximatif');" >Coût de demarrage approximatif</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_faible','BFR sous estime');" >BFR sous estime</a><br/>
                       <a onclick="ajout_string('stra_fi_pt_faible','Attention aides et subvention non disponibles au demarrage');" >Attention aides et subventions non disponibles au demarrage</a><br/>


                        </span></p><a onclick="document.getElementById('stra_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement a trois ans</td>
                <td class="td1 table1Col2"><textarea name="plan_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFor"><?php echo $v_fi[6]; ?></textarea></td><td><img onclick="document.getElementById('plan_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="plan_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" > <p><h3>Mots cles : Plan de financement 3 ans</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('plan_fi_pt_fort','Evolution de la structure a moyen terme');" >Evolution de la structure a moyen terme</a><br/>
					   <a onclick="ajout_string('plan_fi_pt_fort','Embauches a moyen terme programmees');" >Embauches a moyen terme programmees</a><br/>
                       <a onclick="ajout_string('plan_fi_pt_fort','La taille de l\'entreprise au demarrage lui permet de fonctionner plusieurs annees');" >La taille de l'entreprise au demarrage lui permet de fonctionner plusieurs annees</a><br/>


                        </span></p><a onclick="document.getElementById('plan_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="plan_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFaib"><?php echo $v_fi[7]; ?></textarea></td><td><img onclick="document.getElementById('plan_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="plan_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots cles : Plan de financement 3 ans</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('plan_fi_pt_faible','Evolution de la structure a moyen terme');" >Evolution de la structure a moyen terme</a><br/>
					   <a onclick="ajout_string('plan_fi_pt_faible','Pas de gestion previsonnelle des ressources humaines');" >Pas de gestion previsonnelle des ressources humaines</a><br/>
                       

                        </span></p><a onclick="document.getElementById('plan_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>  <tr>
                <td class="td1 table1Col1">Autre points</td>
                <td class="td1 table1Col2"><textarea name="autre_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFor"><?php echo $v_fi[8]; ?></textarea></td><td></td>
                <td class="tdFin table1Col3"><textarea name="autre_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFaib"><?php echo $v_fi[9]; ?></textarea></td><td></td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td>
                <td class="td1" align="center">Delais de realisation</td>
                <td class="tdFin" align="center">Resultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="action1_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct1"><?php echo $v_fi[10]; ?></textarea></td>
                <td class="td1 table3Col2"><textarea name="delai1_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel1"><?php echo $v_fi[14]; ?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result1_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes1"><?php echo $v_fi[18]; ?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action2_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct2"><?php echo $v_fi[11]; ?></textarea></td>
                <td class="td1 table3Col2"><textarea name="delai2_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel2"><?php echo $v_fi[15]; ?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result2_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes2"><?php echo $v_fi[19]; ?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action3_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct3"><?php echo $v_fi[12]; ?>
</textarea></td>
                <td class="td1 table3Col2"><textarea name="delai3_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel3"><?php echo $v_fi[16]; ?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result3_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes3"><?php echo $v_fi[20]; ?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action4_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct4"><?php echo $v_fi[13]; ?></textarea></td>
                <td class="td1 table3Col2"><textarea name="delai4_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel4"><?php echo $v_fi[17]; ?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result4_fi" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes4"><?php echo $v_fi[21]; ?></textarea></td>
              </tr>
            </tbody></table><br>
 <h2>Diagnostic et commentaires du referent</h2><br>
 <textarea name="diag_fi" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo $v_fi[22]; ?>
</textarea>
              </td>
		</tr>
	</tbody></table>
        
</div>
        </div></div>
        
      
<div  style="display:none ; border:1px dotted #309"  id="commerciaux"><img src="aspects_commerciaux.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="aspect_commerciaux">
        <h2>Points forts et points faibles de l’etude de marche</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td width="1106" colspan="2">
       <table width="1076" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="274" align="center" class="td1"></td>
                <td width="400" align="center" class="td1">Points forts</td>
                <td width="400" align="center" class="tdFin">Points faibles</td>
              </tr>
              <tr>
                <td class="td1 table1Col1">Analyse des besoins des clients</td>
                <td class="td1 table1Col2"><select  name="an_be_cl_pt_fort"><option value="<?php echo $v_co[0];?>"> <?php echo $v_co[0];?></option><?php $epce->texte('Points forts clients'); ?></select></td>
                <td class="tdFin table1Col3"><select  name="an_be_cl_pt_faible"><option value="<?php echo $v_co[1];?>"> <?php echo $v_co[1];?></option><?php $epce->texte('Points faibles clients'); ?></select></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Analyse de la concurrence</td>
                <td class="td1 table1Col2"><select  name="an_con_pt_fort"><option value="<?php echo $v_co[2];?>"> <?php echo  $v_co[2];?></option><?php $epce->texte('Points forts concurrence'); ?></select></td>
                <td class="tdFin table1Col3"><select  name="an_con_pt_faible"><option value="<?php echo $v_co[3];?>"> <?php echo  $v_co[3];?></option><?php $epce->texte('Points faibles concurrence'); ?></select></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Strategie commerciale envisagee</td>
                <td class="td1 table1Col2"><select  name="stra_pt_fort"><option value="<?php echo $v_co[4];?>"> <?php  echo $v_co[4];?></option><?php $epce->texte('Points forts strategie'); ?></select></td>
                <td class="tdFin table1Col3"><select  name="stra_pt_faible"><option value="<?php echo $v_co[5];?>"> <?php echo $v_co[5];?></option><?php $epce->texte('Points faibles strategie'); ?></select></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Autres points</td>
                <td class="td1 table1Col2"><select  name="autre_pt_fort"><option value="<?php echo $v_co[6];?>"> <?php echo $v_co[6];?></option><?php $epce->texte('Points forts'); ?></select></td>
                <td class="tdFin table1Col3"><select  name="autre_pt_faible"><option value="<?php echo $v_co[7];?>"> <?php echo $v_co[7];?></option><?php $epce->texte('Points faibles'); ?></select></td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
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
                <td class="tdFin table3Col3"><select  name="result_commercial4"><option value="<?php echo $v_co[19];?>"> <?php echo $v_co[1];?></option><?php $epce->texte('Resultats attendus 1'); ?></select></td>
              </tr>
            </tbody></table><br>
 <h2>Diagnostic et commentaires du referent</h2><br>
 <textarea name="diag_commercial" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo $v_co[20];?></textarea>
                </td>
		</tr>
	</tbody></table>
        
</div>
        </div>
        
      </div>
      
      
      <div style="border:1px dotted #900; display:none" id="juridique"><img src="forme_juridique.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="forme_juridique">
        <h2>Points forts et points faibles du statut juridique choisi</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td colspan="2">
        <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
              
                <td class="td1" align="center">Points forts</td>
                <td class="tdFin" align="center">Points faibles</td>
              </tr>
              <tr>
               
                <td class="td1 table1Col1"><select  name="pt_fort"><option value="<?php echo $v_ju[0];?>"> <?php echo $v_ju[0];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/> <select  name="pt_fort2"><option value="<?php echo $v_ju[1];?>"> <?php echo $v_ju[1];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/><select   name="pt_fort3"><option value="<?php echo $v_ju[2];?>"> <?php echo $v_ju[2];?></option><?php $epce->texte('Points forts statut juridique'); ?></select><br/><select  name="pt_fort4"><option value="<?php echo $v_ju[3];?>"> <?php echo $v_ju[3];?></option><?php $epce->texte('Points forts statut juridique'); ?></select> </td>
                <td class="tdFin table1Col2"><select  name="pt_faible"><option value="<?php echo $v_ju[4];?>"> <?php echo $v_ju[4];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/> <select  name="pt_faible2"><option value="<?php echo $v_ju[5];?>"> <?php echo $v_ju[5];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/><select   name="pt_faible3"><option value="<?php echo $v_ju[6];?>"> <?php echo $v_ju[6];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select><br/><select  name="pt_faible4"><option value="<?php echo $v_ju[7];?>"> <?php echo $v_ju[7];?></option><?php $epce->texte('Points faibles statut juridique'); ?></select></td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
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
            </tbody></table><br>
 <h2>Diagnostic et commentaires du referent</h2><br>
 <textarea name="diag_ju" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaJuriDiagComm" class="commentaire"><?php echo $v_ju[20]; ?></textarea>                
              </td>
		</tr>
	</tbody></table>
        
</div>
        </div></div>
        
        <div id="reglementaire" style="border:1px dotted #909 ; display:none"><img src="aspects_reglementaires.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="forme_juridique">
        <h2>Points forts et points faibles (Aspects reglementaires) </h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td colspan="2">
        <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
              
                <td class="td1" align="center">Points forts</td><td></td>
                <td class="tdFin" align="center">Points faibles</td><td></td>
              </tr>
              <tr>
                <td class="td1 table1Col1"><textarea name="pt_fort_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPoinFor"><?php echo $v_re[0];?></textarea></td>
               <td><img onclick="document.getElementById('pt_fort_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_fort_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 450px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Aspect reglementaire</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('pt_fort_re','Les conditions d\'acces a la profession sont remplies');" >Les conditions d'acces a la profession sont remplies</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('pt_fort_re').style.display='none'" >Fermer</a>
</div>      
</td> <td class="tdFin table1Col2"><textarea name="pt_faible_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPoinFaib"><?php echo $v_re[1];?></textarea></td><td><img onclick="document.getElementById('pt_faible_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_faible_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Aspect reglementaire</h3></p>
                      <p>
<span style="text-align: left">


<a onclick="ajout_string('pt_faible_re','Pas encore d\'approche reglementaire');" >Pas encore d'approche reglementaire</a><br/>
<a onclick="ajout_string('pt_faible_re','Criteres de choix salarie/TNS mal connus en debut de prestation');" >Criteres de choix salarie/TNS mal connus en debut de prestation</a><br/>
<a onclick="ajout_string('pt_faible_re','Les conditions d\'acces a la profession ne sont pas encore remplies');" >Les conditions d'acces a la profession ne sont pas encore remplies</a><br/>
<a onclick="ajout_string('pt_faible_re','Necessite d\'obtenir la capacite de transport');" >Necessite d'obtenir la capacite de transport</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('pt_faible_re').style.display='none'" >Fermer</a>
</div>      </td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions a mener</td><td></td>
                <td class="td1" align="center">Delais de realisation</td><td></td>
                <td class="tdFin" align="center">Resultat
attendu
                </td><td></td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="ac1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct1"><?php echo $v_re[2];?></textarea></td><td><img onclick="document.getElementById('ac1_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac1_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Action a mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac1_re','Se procurer le formulaire ACCRE aupres du CFE competent');" >Se procurer le formulaire ACCRE aupres du CFE competent</a><br/>
<a onclick="ajout_string('ac1_re','Completer le formulaire ACCRE a deposer au CFE competent');" >Completer le formulaire ACCRE a deposer au CFE competent</a><br/>
<a onclick="ajout_string('ac1_re','Se renseigner sur le dispositif NACRE et les organismes agrees');" >Se renseigner sur le dispositif NACRE et les organismes agrees</a><br/>
<a onclick="ajout_string('ac1_re','Reflechir a la remuneration minimum du futur createur d\'entreprise');" >Reflechir a la remuneration minimum du futur createur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac1_re').style.display='none'" >Fermer</a>
</div>  </td>
                <td class="td1 table3Col2"><textarea name="delai1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel1"><?php echo $v_re[6];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes1"><?php echo $v_re[10];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct2"><?php echo $v_re[3];?></textarea></td><td><img onclick="document.getElementById('ac2_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac2_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Action a mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac2_re','Se procurer le formulaire ACCRE aupres du CFE competent');" >Se procurer le formulaire ACCRE aupres du CFE competent</a><br/>
<a onclick="ajout_string('ac2_re','Completer le formulaire ACCRE a deposer au CFE competent');" >Completer le formulaire ACCRE a deposer au CFE competent</a><br/>
<a onclick="ajout_string('ac2_re','Se renseigner sur le dispositif NACRE et les organismes agrees');" >Se renseigner sur le dispositif NACRE et les organismes agrees</a><br/>
<a onclick="ajout_string('ac2_re','Reflechir a la remuneration minimum du futur createur d\'entreprise');" >Reflechir a la remuneration minimum du futur createur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac2_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel2"><?php echo $v_re[7];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes2"><?php echo $v_re[11];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct3"><?php echo $v_re[4];?></textarea></td><td><img onclick="document.getElementById('ac3_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac3_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Action a mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac3_re','Se procurer le formulaire ACCRE aupres du CFE competent');" >Se procurer le formulaire ACCRE aupres du CFE competent</a><br/>
<a onclick="ajout_string('ac3_re','Completer le formulaire ACCRE a deposer au CFE competent');" >Completer le formulaire ACCRE a deposer au CFE competent</a><br/>
<a onclick="ajout_string('ac3_re','Se renseigner sur le dispositif NACRE et les organismes agrees');" >Se renseigner sur le dispositif NACRE et les organismes agrees</a><br/>
<a onclick="ajout_string('ac3_re','Reflechir a la remuneration minimum du futur createur d\'entreprise');" >Reflechir a la remuneration minimum du futur createur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac3_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel3"><?php echo $v_re[8];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes3"><?php echo $v_re[12];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct4"><?php echo $v_re[5];?></textarea></td><td><img onclick="document.getElementById('ac4_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac4_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots cles : Action a mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac4_re','Se procurer le formulaire ACCRE aupres du CFE competent');" >Se procurer le formulaire ACCRE aupres du CFE competent</a><br/>
<a onclick="ajout_string('ac4_re','Completer le formulaire ACCRE a deposer au CFE competent');" >Completer le formulaire ACCRE a deposer au CFE competent</a><br/>
<a onclick="ajout_string('ac4_re','Se renseigner sur le dispositif NACRE et les organismes agrees');" >Se renseigner sur le dispositif NACRE et les organismes agrees</a><br/>
<a onclick="ajout_string('ac4_re','Reflechir a la remuneration minimum du futur createur d\'entreprise');" >Reflechir a la remuneration minimum du futur createur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac4_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel4"><?php echo $v_re[9];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes4"><?php echo $v_re[13];?></textarea></td>
              </tr>              
            </tbody></table><br>
 <h2>Diagnostic et commentaires du referent</h2><br>
 <textarea name="diag_re" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaReglDiagComm" class="commentaire"><?php echo $v_re[14];?></textarea>                
                </td>
		</tr>
	</tbody></table>
        
</div>
        </div><img src="aspects_reglementaires.aspx_fichiers/bottom_blancSurCouleur.jpg" alt="" width="695" height="5"></div>
        
        <br/>
        <input type="submit" value="Enregistrer" />
        <br/></form>
<br/><br/>
</body>
</html>