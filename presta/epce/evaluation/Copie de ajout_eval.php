<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>

</head>

<body>
<a href="javascript:voircoherence_hp()">Cohérence Homme/projet</a> | <a href="javascript:voircommerciaux()">Aspects commerciaux</a> | <a href="javascript:voirfinancier()">Aspects financiers</a> | <a href="javascript:voirjuridique()">Forme juridique</a> | <a href="javascript:voirreglementaire()">Aspect réglementaire</a>
<form name="form1" action="evaluation/eval.php" method="post">
<div style="display:block; border:1px dotted #0F6"  id="coherence_hp"><img src="coherence_homme_projet.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="coherence_homme_projet">
        
    <h2>Formation, compétences et capacités du porteur de projet</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	 
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td width="872" colspan="2">
        <table width="537" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="137" align="center" class="td1">Expérience Professionnelle</td><td></td><td></td><td>Compétences professionnelles</td>
                <td ></td><td></td>
                <td width="261" align="center" class="tdFin">Formation et savoirs théorique </td>
              </tr>
              <tr>
                <td class="td1 table1Col1">
                <textarea name="exp_pro" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheFormCapa"><?php echo $v_hp[0];?>
</textarea>
                </td><td><td></a></td>
                <td class="td1 table1Col2">
                    <textarea name="comp_pro" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheFormComp"><?php echo $v_hp[1];?></textarea></td><td><img onclick="document.getElementById('comp_pro').style.display='block'" border="0" src="./images/plus_16.png" /></td><td></a>
              <td class="tdFin table1Col3"><textarea name="form_savoir" rows="5" cols="40" id="form_savoir"><?php echo $v_hp[2];?></textarea>
              </td><td> <div  id="comp_pro" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 128px; overflow: hidden;" >
                      <p>Mots clés : Compétences</p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('comp_pro','Compétence Métier');" >Compétence Métier</a><br/>
<a onclick="ajout_string('comp_pro','Compétence en gestion financière');" >Compétence en gestion financière</a><br/>     
<a onclick="ajout_string('comp_pro','Compétence en gestion commerciale');" >Compétence en gestion commerciale</a><br/>
<a onclick="ajout_string('comp_pro','Compétence en gestion administrative');" >Compétence en gestion administrative</a><br/>
<a onclick="ajout_string('comp_pro','Capacité à gérer une équipe');" >Capacité à gérer une équipe</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('comp_pro').style.display='none'" >Fermer</a>
</div></td>
              </tr>
            </tbody></table><br>

 <h2>Eléments porteurs et points de vigilance par rapport au projet</h2><br>
    <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Eléments porteurs</td><td></td>
                <td class="tdFin" align="center">Points de vigilance</td><td></td>
             
              </tr>
              <tr>
                <td class="td1 table2Col1">
                <textarea name="element_porteur" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheElemPort"><?php echo $v_hp[15];?></textarea></td><td> <img onclick="document.getElementById('element_porteur').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="element_porteur" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 170px; overflow: hidden; ">
                      <p><h3>Mots clés : Eléments porteurs</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('element_porteur','Bonne adéquation Formation / Projet');" >Bonne adéquation Formation / Projet</a><br/>
<a onclick="ajout_string('element_porteur','Bonne adéquation Expérience / Projet');" >Bonne adéquation Expérience / Projet</a><br/>
<a onclick="ajout_string('element_porteur','Formation cohérence avec les besoins');" >Formation cohérence avec les besoins</a><br/>
<a onclick="ajout_string('element_porteur','Expérience professionnelle cohérente');" >Expérience professionnelle cohérente</a><br/>
<a onclick="ajout_string('element_porteur','Bonne répartition des rôles entre les associés');" >Bonne répartition des rôles entre les associés</a><br/>
<a onclick="ajout_string('element_porteur','Influence positive de l'environnement personnel');" >Influence positive de l'environnement personnel</a><br/>
<a onclick="ajout_string('element_porteur','Projet de valorisation professionnelle');" >Projet de valorisation professionnelle</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('element_porteur').style.display='none'" >Fermer</a>
</div>    </td>
                <td class="tdFin table2Col2">                
                <textarea name="points_vigilance" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheElemVigi"><?php echo $v_hp[16];?></textarea></td><td> <img onclick="document.getElementById('points_vigilance').style.display='block'" border="0" src="./images/plus_16.png" /><div id="points_vigilance" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 320px; height: 170px; overflow: hidden; ">
                      <p><h3>Mot clé : Points de vigilance</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('points_vigilance','Adéquation Formation /Projet à améliorer');" >Adéquation Formation /Projet à améliorer</a><br/>
<a onclick="ajout_string('points_vigilance','Adéquation Expérience / Projet à améliorer');" >Adéquation Expérience / Projet à améliorer</a><br/>
<a onclick="ajout_string('points_vigilance','Complément de formation à envisager');" >Complément de formation à envisager</a><br/>
<a onclick="ajout_string('points_vigilance','Complément d'expérience à envisager');" >Complément d'expérience à envisager</a><br/>
<a onclick="ajout_string('points_vigilance','Répartition des rôles entre les associés à définir');" >Répartition des rôles entre les associés à définir</a><br/>
<a onclick="ajout_string('points_vigilance','Influence négative de l'environnement personnel');" >Influence négative de l'environnement personnel</a><br/>
<a onclick="ajout_string('points_vigilance','Projet de rupture');" >Projet de rupture</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('points_vigilance').style.display='none'" >Fermer</a>
</div>                   </td> 
            </tr>
            </tbody></table><br>
 <h2>Besoins de formation courte identifiée</h2><br>
 <table width="635" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="233" align="center" class="td1">Compétences à acquérir ou renforcer</td><td></td>
                <td width="178" align="center" class="td1">Délais/priorité</td><td></td>
                <td width="222" align="center" class="tdFin">Type de formation courte recommandée</td><td></td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="compt1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesComp1"><?php echo $v_hp[3];?></textarea></td><td><img onclick="document.getElementById('compt1').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="compt1" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 128px; overflow: hidden; ">
                      <p><h3>Mots clés : Compétences à acquérir</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('compt1','Compétences en gestion financière à acquérir');" >Compétences en gestion financière à acquérir</a><br/>
<a onclick="ajout_string('compt1','Perfectionnement à la négociation commerciale');" >Perfectionnement à la négociation commerciale</a><br/>
<a onclick="ajout_string('compt1','Approche globale de la création d\'entreprise');" >Approche globale de la création d'entreprise</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('compt1').style.display='none'" >Fermer</a>
</div>                       </td>
                <td class="td1 table3Col2"><textarea name="delai1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesDel1"><?php echo $v_hp[7];?></textarea></td><td><img onclick="document.getElementById('delai1').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="delai1" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 150px; overflow: hidden; ">
                      <p><h3>Mots clés : Délais</h3> </p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('delai1','A réaliser pour le prochain rendez-vous');" >A réaliser pour le prochain rendez-vous</a><br/>
<a onclick="ajout_string('delai1','A réaliser pendant la prestation');" >A réaliser pendant la prestation</a><br/>
<a onclick="ajout_string('delai1','A réaliser dans le mois qui suit la formation');" >A réaliser dans le mois qui suit la formation</a><br/>
<a onclick="ajout_string('delai1','A réaliser dans le mois qui précède l\'installation');" >A réaliser dans le mois qui précède l'installation</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('delai1').style.display='none'" >Fermer</a>
</div> </td>
                <td class="tdFin table3Col3"><textarea name="type1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesTyp1"><?php echo $v_hp[11];?></textarea></td><td><img onclick="document.getElementById('type1').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="type1" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 160px; overflow: hidden; ">
                      <p><h3>Mots clés : Type de formation courte</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('type1','Adéquation Formation / Projet à améliorer');" >Adéquation Formation / Projet à améliorer</a><br/>
<a onclick="ajout_string('type1','Adéquation Expérience / Projet à améliorer');" >Adéquation Expérience / Projet à améliorer</a><br/>
<a onclick="ajout_string('type1','Complément de formation à envisager');" >Complément de formation à envisager</a><br/>
<a onclick="ajout_string('type1','Complément d\'expérience à envisager');" >Complément d'expérience à envisager</a><br/>
<a onclick="ajout_string('type1','Répartition des rôles entre les associés à définir');" >Répartition des rôles entre les associés à définir</a><br/>
<a onclick="ajout_string('type1','Influence négative de l\'environnement personnel');" >Influence négative de l'environnement personnel</a><br/>
<a onclick="ajout_string('type1','Projet de rupture');" >Projet de rupture</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('type1').style.display='none'" >Fermer</a>
</div>  </td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="compt2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesComp2"><?php echo $v_hp[4];?></textarea></td><td><img onclick="document.getElementById('compt2').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="compt2" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 128px; overflow: hidden; ">
                      <p><h3>Mots clés : Compétences à acquérir</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('compt2','Compétences en gestion financière à acquérir');" >Compétences en gestion financière à acquérir</a><br/>
<a onclick="ajout_string('compt2','Perfectionnement à la négociation commerciale');" >Perfectionnement à la négociation commerciale</a><br/>
<a onclick="ajout_string('compt2','Approche globale de la création d\'entreprise');" >Approche globale de la création d'entreprise</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('compt2').style.display='none'" >Fermer</a>
</div>      </td>
                <td class="td1 table3Col2"><textarea name="delai2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesDel2"><?php echo $v_hp[8];?></textarea></td><td><img onclick="document.getElementById('delai2').style.display='block'" border="0" src="./images/plus_16.png" /></a><div  id="delai2" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 150px; overflow: hidden; ">
                      <p><h3>Mots clés : Délais</h3> </p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('delai2','A réaliser pour le prochain rendez-vous');" >A réaliser pour le prochain rendez-vous</a><br/>
<a onclick="ajout_string('delai2','A réaliser pendant la prestation');" >A réaliser pendant la prestation</a><br/>
<a onclick="ajout_string('delai2','A réaliser dans le mois qui suit la formation');" >A réaliser dans le mois qui suit la formation</a><br/>
<a onclick="ajout_string('delai2','A réaliser dans le mois qui précède l\'installation');" >A réaliser dans le mois qui précède l'installation</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('delai2').style.display='none'" >Fermer</a>
</div></td>
                <td class="tdFin table3Col3"><textarea name="type2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesTyp2"><?php echo $v_hp[12];?></textarea></td><td><img onclick="document.getElementById('type2').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="type2" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 160px; overflow: hidden; ">
                      <p><h3>Mots clés : Type de formation courte</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('type2','Adéquation Formation / Projet à améliorer');" >Adéquation Formation / Projet à améliorer</a><br/>
<a onclick="ajout_string('type2','Adéquation Expérience / Projet à améliorer');" >Adéquation Expérience / Projet à améliorer</a><br/>
<a onclick="ajout_string('type2','Complément de formation à envisager');" >Complément de formation à envisager</a><br/>
<a onclick="ajout_string('type2','Complément d\'expérience à envisager');" >Complément d'expérience à envisager</a><br/>
<a onclick="ajout_string('type2','Répartition des rôles entre les associés à définir');" >Répartition des rôles entre les associés à définir</a><br/>
<a onclick="ajout_string('type2','Influence négative de l\'environnement personnel');" >Influence négative de l'environnement personnel</a><br/>
<a onclick="ajout_string('type2','Projet de rupture');" >Projet de rupture</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('type2').style.display='none'" >Fermer</a>
</div></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="compt3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesComp3"><?php echo $v_hp[5];?></textarea></td>
                <td><img onclick="document.getElementById('compt3').style.display='block'" border="0" src="./images/plus_16.png" /></a><div  id="compt3" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 128px; overflow: hidden; ">
                      <p><h3>Mots clés : Compétences à acquérir</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('compt3','Compétences en gestion financière à acquérir');" >Compétences en gestion financière à acquérir</a><br/>
<a onclick="ajout_string('compt3','Perfectionnement à la négociation commerciale');" >Perfectionnement à la négociation commerciale</a><br/>
<a onclick="ajout_string('compt3','Approche globale de la création d\'entreprise');" >Approche globale de la création d'entreprise</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('compt3').style.display='none'" >Fermer</a>
</div>      </td><td class="td1 table3Col2"><textarea name="delai3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesDel3"><?php echo $v_hp[9];?></textarea></td><td><img onclick="document.getElementById('delai3').style.display='block'" border="0" src="./images/plus_16.png" /></a><div  id="delai3" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 150px; overflow: hidden; ">
                      <p><h3>Mots clés : Délais</h3> </p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('delai3','A réaliser pour le prochain rendez-vous');" >A réaliser pour le prochain rendez-vous</a><br/>
<a onclick="ajout_string('delai3','A réaliser pendant la prestation');" >A réaliser pendant la prestation</a><br/>
<a onclick="ajout_string('delai3','A réaliser dans le mois qui suit la formation');" >A réaliser dans le mois qui suit la formation</a><br/>
<a onclick="ajout_string('delai3','A réaliser dans le mois qui précède l\'installation');" >A réaliser dans le mois qui précède l'installation</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('delai3').style.display='none'" >Fermer</a>
</div></td>
                <td class="tdFin table3Col3"><textarea name="type3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesTyp3"><?php echo $v_hp[13];?></textarea></td><td><img onclick="document.getElementById('type3').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="type3" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 160px; overflow: hidden; ">
                      <p><h3>Mots clés : Type de formation courte</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('type3','Adéquation Formation / Projet à améliorer');" >Adéquation Formation / Projet à améliorer</a><br/>
<a onclick="ajout_string('type3','Adéquation Expérience / Projet à améliorer');" >Adéquation Expérience / Projet à améliorer</a><br/>
<a onclick="ajout_string('type3','Complément de formation à envisager');" >Complément de formation à envisager</a><br/>
<a onclick="ajout_string('type3','Complément d\'expérience à envisager');" >Complément d'expérience à envisager</a><br/>
<a onclick="ajout_string('type3','Répartition des rôles entre les associés à définir');" >Répartition des rôles entre les associés à définir</a><br/>
<a onclick="ajout_string('type3','Influence négative de l\'environnement personnel');" >Influence négative de l'environnement personnel</a><br/>
<a onclick="ajout_string('type3','Projet de rupture');" >Projet de rupture</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('type3').style.display='none'" >Fermer</a>
</div></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="compt4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesComp4"><?php echo $v_hp[6];?></textarea></td>
                <td><img onclick="document.getElementById('compt4').style.display='block'" border="0" src="./images/plus_16.png" /></a><div  id="compt4" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 128px; overflow: hidden; ">
                      <p><h3>Mots clés : Compétences à acquérir</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('compt4','Compétences en gestion financière à acquérir');" >Compétences en gestion financière à acquérir</a><br/>
<a onclick="ajout_string('compt4','Perfectionnement à la négociation commerciale');" >Perfectionnement à la négociation commerciale</a><br/>
<a onclick="ajout_string('compt4','Approche globale de la création d\'entreprise');" >Approche globale de la création d'entreprise</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('compt4').style.display='none'" >Fermer</a>
</div>      </td><td class="td1 table3Col2"><textarea name="delai4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesDel4"><?php echo $v_hp[10];?></textarea></td><td><img onclick="document.getElementById('delai4').style.display='block'" border="0" src="./images/plus_16.png" /></a><div  id="delai4" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 150px; overflow: hidden; ">
                      <p><h3>Mots clés : Délais</h3> </p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('delai4','A réaliser pour le prochain rendez-vous');" >A réaliser pour le prochain rendez-vous</a><br/>
<a onclick="ajout_string('delai4','A réaliser pendant la prestation');" >A réaliser pendant la prestation</a><br/>
<a onclick="ajout_string('delai4','A réaliser dans le mois qui suit la formation');" >A réaliser dans le mois qui suit la formation</a><br/>
<a onclick="ajout_string('delai4','A réaliser dans le mois qui précède l\'installation');" >A réaliser dans le mois qui précède l'installation</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('delai4').style.display='none'" >Fermer</a>
</div></td>
                <td class="tdFin table3Col3"><textarea name="type4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaCoheBesTyp4"><?php echo $v_hp[14];?></textarea></td><td><img onclick="document.getElementById('type4').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="type4" style="position:absolute; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 300px; height: 160px; overflow: hidden; ">
                      <p><h3>Mots clés : Type de formation courte</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('type4','Adéquation Formation / Projet à améliorer');" >Adéquation Formation / Projet à améliorer</a><br/>
<a onclick="ajout_string('type4','Adéquation Expérience / Projet à améliorer');" >Adéquation Expérience / Projet à améliorer</a><br/>
<a onclick="ajout_string('type4','Complément de formation à envisager');" >Complément de formation à envisager</a><br/>
<a onclick="ajout_string('type4','Complément d\'expérience à envisager');" >Complément d'expérience à envisager</a><br/>
<a onclick="ajout_string('type4','Répartition des rôles entre les associés à définir');" >Répartition des rôles entre les associés à définir</a><br/>
<a onclick="ajout_string('type4','Influence négative de l\'environnement personnel');" >Influence négative de l'environnement personnel</a><br/>
<a onclick="ajout_string('type4','Projet de rupture');" >Projet de rupture</a><br/>
</span>
  </p>
                        <a onclick="document.getElementById('type4').style.display='none'" >Fermer</a>
</div></td>
              </tr>
            </tbody></table><input type="hidden"  name="id_beneficiaire" value="<?php echo $choix; ?>" />
 <br>            
            </td>
		</tr><tr><td></td></tr>
	</tbody></table>
        
</div>
        </div></div><div style="border:1px dotted #CF0; display:none"  id="financier"><img src="aspects_commerciaux.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="aspect_commerciaux">
        <h2>Points forts et points faibles de l’étude de marché</h2><br>
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
                <td><img onclick="document.getElementById('an_be_cl_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" > <p><h3>Mots clés : Apport recherche</h3> </p><p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Bon niveau d\'apport personnel');" >Bon niveau d'apport personnel</a><br/>
					   <a onclick="ajout_string('an_be_cl_fi_pt_fort','Activité bénéficiant d\'un a priori positif des banques');" >Activité bénéficiant d'un a priori positif des banques</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Bon équilibre apport/emprunt');" >Bon équilibre apport/emprunt</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_fort','Contacts bancaires en cours positifs');" >Contacts bancaires en cours positifs</a><br/>

                        </span></p><a onclick="document.getElementById('an_be_cl_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div>
                    </td><td class="tdFin table1Col3"><textarea name="an_be_cl_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComCliFaib"><?php echo $v_fi[1]; ?></textarea></td><td><img onclick="document.getElementById('an_be_cl_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots clés : Apport recherche</h3> </p><p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Apport personnel trop faible');" >Apport personnel trop faible</a><br/>
					   <a onclick="ajout_string('an_be_cl_fi_pt_faible','Activité peu prisée par les banques');" >Activité peu prisée par les banques</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Rapport apport/emprunt défavorable');" >Rapport apport/emprunt défavorable</a><br/>
                       <a onclick="ajout_string('an_be_cl_fi_pt_faible','Démarches bancaires pas encore entamées');" >Démarches bancaires pas encore entamées</a><br/>

                        </span></p><a onclick="document.getElementById('an_be_cl_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Calcul du point mort</td>
                <td class="td1 table1Col2"><textarea name="an_con_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFor"><?php echo $v_fi[2]; ?></textarea></td><td><img onclick="document.getElementById('an_con_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots clés : Calcul points mort</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_con_fi_pt_fort','Point mort argumenté et cohérent');" >Point mort argumenté et cohérent</a><br/>
					   <a onclick="ajout_string('an_con_fi_pt_fort','Bonne connaissance des charges fixes');" >Bonne connaissance des charges fixes</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_fort','Bonne approche de la marge brute');" >Bonne approche de la marge brute</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_fort','Marge brut conforme à la profession');" >Marge brut conforme à la profession</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="an_con_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFaib"><?php echo $v_fi[3]; ?></textarea></td><td><img onclick="document.getElementById('an_con_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" >
                      <p><h3>Mots clés : Calcul points mort </h3> </p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('an_con_fi_pt_faible','Charges fixes non chiffrées');" >Charges fixes non chiffrées</a><br/>
					   <a onclick="ajout_string('an_con_fi_pt_faible','Marge brute de l\'activité méconnue');" >Marge brute de l'activité méconnue</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_faible','Point mort non argumenté');" >Point mort non argumenté</a><br/>
                       <a onclick="ajout_string('an_con_fi_pt_faible','Point mort trop élevé');" >Point mort trop élevé</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement initial</td>
                <td class="td1 table1Col2"><textarea name="stra_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFor"><?php echo $v_fi[4]; ?></textarea></td><td><img onclick="document.getElementById('stra_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" ><p><h3>Mots clés : Plan de financement</h3></p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('stra_fi_pt_fort','Investissements bien évalués');" >Investissements bien évalués</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_fort','Bonne estimation des besoins');" >Bonne estimation des besoins</a><br/>
                       <a onclick="ajout_string('stra_fi_pt_fort','BFR bien étudié');" >BFR bien étudié</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_fort','Aides et subventions potentielles non prises en compte');" >Aides et subventions potentielles non prises en compte</a><br/>

                        </span></p><a onclick="document.getElementById('stra_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div>
					</td>
                <td class="tdFin table1Col3"><textarea name="stra_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFaib"><?php echo $v_fi[5]; ?></textarea></td><td><img onclick="document.getElementById('stra_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" >   <p><h3>Mots clé : Plan de financement</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('stra_fi_pt_faible','Coût de démarrage approximatif');" >Coût de démarrage approximatif</a><br/>
					   <a onclick="ajout_string('stra_fi_pt_faible','BFR sous estimé');" >BFR sous estimé</a><br/>
                       <a onclick="ajout_string('stra_fi_pt_faible','Attention aides et subvention non disponibles au démarrage');" >Attention aides et subventions non disponibles au démarrage</a><br/>


                        </span></p><a onclick="document.getElementById('stra_fi_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Plan de financement à trois ans</td>
                <td class="td1 table1Col2"><textarea name="plan_fi_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFor"><?php echo $v_fi[6]; ?></textarea></td><td><img onclick="document.getElementById('plan_fi_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="plan_fi_pt_fort" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 150px; overflow: hidden;" > <p><h3>Mots clés : Plan de financement 3 ans</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('plan_fi_pt_fort','Evolution de la structure à moyen terme');" >Evolution de la structure à moyen terme</a><br/>
					   <a onclick="ajout_string('plan_fi_pt_fort','Embauches à moyen terme programmées');" >Embauches à moyen terme programmées</a><br/>
                       <a onclick="ajout_string('plan_fi_pt_fort','La taille de l\'entreprise au démarrage lui permet de fonctionner plusieurs années');" >La taille de l'entreprise au démarrage lui permet de fonctionner plusieurs années</a><br/>


                        </span></p><a onclick="document.getElementById('plan_fi_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="plan_fi_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFaib"><?php echo $v_fi[7]; ?></textarea></td><td><img onclick="document.getElementById('plan_fi_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="plan_fi_pt_faible" style="position:absolute; border:1px solid  #000; display:none; left: 1118px; top: 581px; width: 269px; height: 128px; overflow: hidden;" > <p><h3>Mots clés : Plan de financement 3 ans</h3> </p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('plan_fi_pt_faible','Evolution de la structure à moyen terme');" >Evolution de la structure à moyen terme</a><br/>
					   <a onclick="ajout_string('plan_fi_pt_faible','Pas de gestion prévisonnelle des ressources humaines');" >Pas de gestion prévisonnelle des ressources humaines</a><br/>
                       

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
                <td class="td1" align="center">Actions à mener</td>
                <td class="td1" align="center">Délais de réalisation</td>
                <td class="tdFin" align="center">Résultat
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
 <h2>Diagnostic et commentaires du référent</h2><br>
 <textarea name="diag_fi" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaComDiagComm" class="commentaire"><?php echo $v_fi[22]; ?>
</textarea>
              </td>
		</tr>
	</tbody></table>
        
</div>
        </div></div>
        
      
<div  style="display:none ; border:1px dotted #309"  id="commerciaux"><img src="aspects_commerciaux.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="aspect_commerciaux">
        <h2>Points forts et points faibles de l’étude de marché</h2><br>
     <div id="ctl00_cph_contenu_UpdatePanel1">
	  
          <span id="ctl00_cph_contenu_lbl_msg" class="msg"></span>
           <table id="ctl00_cph_contenu_fmv_page" style="border-collapse: collapse;" border="0" cellspacing="0">
		<tbody><tr>
			<td width="992" colspan="2">
       <table width="1024" cellpadding="0" cellspacing="0" class="tableGen">
              <tbody><tr>
                <td width="444" align="center" class="td1"></td>
                <td width="257" align="center" class="td1">Points forts</td><td width="16"></td>
                <td width="257" align="center" class="tdFin">Points faibles</td><td width="48"></td>
              </tr>
              <tr>
                <td class="td1 table1Col1">Analyse des besoins des clients</td>
                <td class="td1 table1Col2"><textarea name="an_be_cl_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComCliFor"><?php echo $v_co[0];?></textarea></td><td><img onclick="document.getElementById('an_be_cl_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_pt_fort" style="position:absolute; background-color:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 150px; overflow: hidden; "><p><h3>Mots clés : Analyse besoin clients</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('an_be_cl_pt_fort','Etude de marché bien menée');" >Etude de marché bien menée</a><br/>
					   <a onclick="ajout_string('an_be_cl_pt_fort','Etude de marché formalisée par écrit');" >Etude de marché formalisée par écrit</a><br/>
                       <a onclick="ajout_string('an_be_cl_pt_fort','Besoins bien définis');" >Besoins bien définis</a><br/>
                       <a onclick="ajout_string('an_be_cl_pt_fort','Bonne exploitation d\'un questionnaire d\'enquête');" >Bonne exploitation d'un questionnaire d'enquête</a><br/>
			
                        </span></p><a onclick="document.getElementById('an_be_cl_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="an_be_cl_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComCliFaib"><?php echo $v_co[1];?></textarea></td><td><img onclick="document.getElementById('an_be_cl_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_be_cl_pt_faible" style="position:absolute; background-color:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 150px; overflow: hidden; ">
                      <p><h3>Mots clés : Analyse besoin clients</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('an_be_cl_pt_faible','Pas de véritable étude de besoin');" >Pas de véritable étude de besoin</a><br/>
					   <a onclick="ajout_string('an_be_cl_pt_faible','L\'existence du besoin client est supposée mais pas encore démontrée');" >L'existence du besoin client est supposée mais pas encore démontrée</a><br/>
                       <a onclick="ajout_string('an_be_cl_pt_faible','Attention à la différence entre le besoin et la demande');" >Attention à la différence entre le besoin et la demande</a><br/>
			
                        </span></p><a onclick="document.getElementById('an_be_cl_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Analyse de la concurrence</td>
                <td class="td1 table1Col2"><textarea name="an_con_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFor"><?php echo $v_co[2];?></textarea></td><td><img onclick="document.getElementById('an_con_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_pt_fort" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Analyse concurrence</h3></p>
                      <p>
                       <span style="text-align: center">
                       <a onclick="ajout_string('an_con_pt_fort','Concurrence directe et indirecte bien étudiée');" >Concurrence directe et indirecte bien étudiée</a><br/>
					   <a onclick="ajout_string('an_con_pt_fort','Analyse des points forts et faibles des concurrents bien menées');" >Analyse des points forts et faibles des concurrents bien menées</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="an_con_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComConcFaib"><?php echo $v_co[3];?></textarea></td><td><img onclick="document.getElementById('an_con_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="an_con_pt_faible" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 150px; overflow: hidden;">
                      <p><h3>Mots clés : Analyse concurrence</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('an_con_pt_faible','Pas de véritable étude de la concurrence');" >Pas de véritable étude de la concurrence</a><br/>
					   <a onclick="ajout_string('an_con_pt_faible','Concurrence bien connue mais étude non formalisée');" >Concurrence bien connue mais étude non formalisée</a><br/>
                       <a onclick="ajout_string('an_con_pt_faible','La concurrence directe et indirecte est visiblement sous estimée');" >La concurrence directe et indirecte est visiblement sous estimée</a><br/>

                        </span></p><a onclick="document.getElementById('an_con_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Stratégie commerciale envisagée</td>
                <td class="td1 table1Col2"><textarea name="stra_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFor"><?php echo $v_co[4];?></textarea></td><td><img onclick="document.getElementById('stra_pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_pt_fort" style="position:absolute; background-color:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 150px; overflow: hidden; "><p><h3>Mots clés : Stratégie</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('stra_pt_fort','Gamme de produits bien dédinie en largeur et profondeur');" >Gamme de produits bien dédinie en largeur et profondeur</a><br/>
					   <a onclick="ajout_string('stra_pt_fort','Clientèle bien ciblée');" >Clientèle bien ciblée </a><br/>
					   <a onclick="ajout_string('stra_pt_fort','Politique de prix définie et cohérente');" >Politique de prix définie et cohérente</a><br/>
					   <a onclick="ajout_string('stra_pt_fort','Stratégie de communication planifiée et budgétée');" >Stratégie de communication planifiée et budgétée</a><br/>

                        </span></p><a onclick="document.getElementById('stra_pt_fort').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="tdFin table1Col3"><textarea name="stra_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComStraFaib"><?php echo $v_co[5];?></textarea></td><td><img onclick="document.getElementById('stra_pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div  id="stra_pt_faible" style="position:absolute; background-color:#FFF; border:1px solid  #000; display:none; left: 956px; top: 540px; width: 269px; height: 160px; overflow: hidden; "><p><h3>Mots clés : Stratégie</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('stra_pt_faible','Pas encore de réflexion sur la notion de gamme: Formaliser par écrit largeur et profondeur');" >Pas encore de réflexion sur la notion de gamme: Formaliser par écrit largeur et profondeur</a><br/>
					   <a onclick="ajout_string('stra_pt_faible','Critères de ciblage de clientèle non définis');" >Critères de ciblage de clientèle non définis</a><br/>
					   <a onclick="ajout_string('stra_pt_faible','Politique de prix définie sans tester le marché');" >Politique de prix définie sans tester le marché</a><br/>
					   <a onclick="ajout_string('stra_pt_faible','Pas encore d\'approche de la communication de lancement');" >Pas encore d'approche de la communication de lancement</a><br/>

                        </span></p><a onclick="document.getElementById('stra_pt_faible').style.display='none'" >Fermer</a>
                    </div></td>
              </tr>
                 <tr>
                <td class="td1 table1Col1">Autres points</td>
                <td class="td1 table1Col2"><textarea name="autre_pt_fort" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFor"><?php echo $v_co[6];?></textarea></td><td></td>
                <td class="tdFin table1Col3"><textarea name="autre_pt_faible" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComAutrFaib"><?php echo $v_co[7];?></textarea></td><td></td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions à mener</td><td></td>
                <td class="td1" align="center">Délais de réalisation</td>
                <td class="tdFin" align="center">Résultat
attendu
                </td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="action_commercial1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct1"><?php echo $v_co[8];?></textarea></td><td><img onclick="document.getElementById('action_commercial1').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="action_commercial1" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 300px; overflow: hidden;">
                      <p><h3>Mots clés : Action à mener</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('action_commercial1','Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles');" >Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles</a><br/>
					   <a onclick="ajout_string('action_commercial1','Définir quel est le coeur de cible, les clients principaux et les clients secondaires ');" >Définir quel est le coeur de cible, les clients principaux et les clients secondaires</a><br/>
                       <a onclick="ajout_string('action_commercial1','Se procurer des fichiers de prospection pour cibler les futurs clients');" >Se procurer des fichiers de prospection pour cibler les futurs clients</a><br/>
					   <a onclick="ajout_string('action_commercial1','Faire le point sur les clients presque acquis et sur le CA généré potentiellement');" >Faire le point sur les clients presque acquis et sur le CA généré potentiellement</a><br/>
					   <a onclick="ajout_string('action_commercial1','Se renseigner sur les habitudes d\'achat, motivations, freins, comportements, attentes');" >Se renseigner sur les habitudes d'achat, motivations, freins, comportements, attentes</a><br/>
					   <a onclick="ajout_string('action_commercial1','Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible');" >Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible</a><br/>
					   <a onclick="ajout_string('action_commercial1','Réactiver les carnets d\'adresses personnel et professionnel');" >Réactiver les carnets d'adresses personnel et professionnel</a><br/>
					   <a onclick="ajout_string('action_commercial1','Définir la répartition: entreprises, associations, institutions, collectivités, individus');" >Définir la répartition: entreprises, associations, institutions, collectivités, individus</a><br/>
					   <a onclick="ajout_string('action_commercial1','Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d\'affaires');" >Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d'affaires</a><br/>
					   <a onclick="ajout_string('action_commercial1','La clientèle est-elle concentrée, dispersée, de passage, de proximité ?');" >La clientèle est-elle concentrée, dispersée, de passage, de proximité ?</a><br/>
					   <a onclick="ajout_string('action_commercial1','Evaluer le nombre de clients potentiels sur sa zone d\'intervention et mesurer leur volume');" >Evaluer le nombre de clients potentiels sur sa zone d'intervention et mesurer leur volume</a><br/>

                        </span></p><a onclick="document.getElementById('action_commercial1').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="td1 table3Col2"><textarea name="delai_commercial1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel1"><?php echo $v_co[12];?>
</textarea></td>
                <td class="tdFin table3Col3"><textarea name="result_commercial1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes1"><?php echo $v_co[16];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action_commercial2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct2"><?php echo $v_co[9];?></textarea></td><td><img onclick="document.getElementById('action_commercial2').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="action_commercial2" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 300px; overflow: hidden;">
                      <p><h3>Mots clés : Action à mener</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('action_commercial2','Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles');" >Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles</a><br/>
					   <a onclick="ajout_string('action_commercial2','Définir quel est le coeur de cible, les clients principaux et les clients secondaires ');" >Définir quel est le coeur de cible, les clients principaux et les clients secondaires</a><br/>
                       <a onclick="ajout_string('action_commercial2','Se procurer des fichiers de prospection pour cibler les futurs clients');" >Se procurer des fichiers de prospection pour cibler les futurs clients</a><br/>
					   <a onclick="ajout_string('action_commercial2','Faire le point sur les clients presque acquis et sur le CA généré potentiellement');" >Faire le point sur les clients presque acquis et sur le CA généré potentiellement</a><br/>
					   <a onclick="ajout_string('action_commercial2','Se renseigner sur les habitudes d\'achat, motivations, freins, comportements, attentes');" >Se renseigner sur les habitudes d'achat, motivations, freins, comportements, attentes</a><br/>
					   <a onclick="ajout_string('action_commercial2','Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible');" >Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible</a><br/>
					   <a onclick="ajout_string('action_commercial2','Réactiver les carnets d\'adresses personnel et professionnel');" >Réactiver les carnets d'adresses personnel et professionnel</a><br/>
					   <a onclick="ajout_string('action_commercial2','Définir la répartition: entreprises, associations, institutions, collectivités, individus');" >Définir la répartition: entreprises, associations, institutions, collectivités, individus</a><br/>
					   <a onclick="ajout_string('action_commercial2','Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d\'affaires');" >Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d'affaires</a><br/>
					   <a onclick="ajout_string('action_commercial2','La clientèle est-elle concentrée, dispersée, de passage, de proximité ?');" >La clientèle est-elle concentrée, dispersée, de passage, de proximité ?</a><br/>
					   <a onclick="ajout_string('action_commercial2','Evaluer le nombre de clients potentiels sur sa zone d\'intervention et mesurer leur volume');" >Evaluer le nombre de clients potentiels sur sa zone d'intervention et mesurer leur volume</a><br/>

                        </span></p><a onclick="document.getElementById('action_commercial2').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="td1 table3Col2"><textarea name="delai_commercial2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel2"><?php echo $v_co[13];?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result_commercial2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes2"><?php echo $v_co[17];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action_commercial3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct3"><?php echo $v_co[10];?></textarea></td><td><img onclick="document.getElementById('action_commercial3').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="action_commercial3" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 300px; overflow: hidden;">
                      <p><h3>Mots clés : Action à mener</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('action_commercial3','Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles');" >Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles</a><br/>
					   <a onclick="ajout_string('action_commercial3','Définir quel est le coeur de cible, les clients principaux et les clients secondaires ');" >Définir quel est le coeur de cible, les clients principaux et les clients secondaires</a><br/>
                       <a onclick="ajout_string('action_commercial3','Se procurer des fichiers de prospection pour cibler les futurs clients');" >Se procurer des fichiers de prospection pour cibler les futurs clients</a><br/>
					   <a onclick="ajout_string('action_commercial3','Faire le point sur les clients presque acquis et sur le CA généré potentiellement');" >Faire le point sur les clients presque acquis et sur le CA généré potentiellement</a><br/>
					   <a onclick="ajout_string('action_commercial3','Se renseigner sur les habitudes d\'achat, motivations, freins, comportements, attentes');" >Se renseigner sur les habitudes d'achat, motivations, freins, comportements, attentes</a><br/>
					   <a onclick="ajout_string('action_commercial3','Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible');" >Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible</a><br/>
					   <a onclick="ajout_string('action_commercial3','Réactiver les carnets d\'adresses personnel et professionnel');" >Réactiver les carnets d'adresses personnel et professionnel</a><br/>
					   <a onclick="ajout_string('action_commercial3','Définir la répartition: entreprises, associations, institutions, collectivités, individus');" >Définir la répartition: entreprises, associations, institutions, collectivités, individus</a><br/>
					   <a onclick="ajout_string('action_commercial3','Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d\'affaires');" >Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d'affaires</a><br/>
					   <a onclick="ajout_string('action_commercial3','La clientèle est-elle concentrée, dispersée, de passage, de proximité ?');" >La clientèle est-elle concentrée, dispersée, de passage, de proximité ?</a><br/>
					   <a onclick="ajout_string('action_commercial3','Evaluer le nombre de clients potentiels sur sa zone d\'intervention et mesurer leur volume');" >Evaluer le nombre de clients potentiels sur sa zone d'intervention et mesurer leur volume</a><br/>

                        </span></p><a onclick="document.getElementById('action_commercial3').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="td1 table3Col2"><textarea name="delai_commercial3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel3"><?php echo $v_co[14];?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result_commercial3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes3"><?php echo $v_co[18];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="action_commercial4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanAct4"><?php echo $v_co[11];?></textarea></td><td><img onclick="document.getElementById('action_commercial4').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="action_commercial4" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 300px; overflow: hidden;">
                      <p><h3>Mots clés : Action à mener</h3></p>
                      <p>
                       <span style="text-align: left">
                       <a onclick="ajout_string('action_commercial4','Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles');" >Identifier et dresser le profil quantitatif et qualitatif des différentes cibles potentielles</a><br/>
					   <a onclick="ajout_string('action_commercial4','Définir quel est le coeur de cible, les clients principaux et les clients secondaires ');" >Définir quel est le coeur de cible, les clients principaux et les clients secondaires</a><br/>
                       <a onclick="ajout_string('action_commercial4','Se procurer des fichiers de prospection pour cibler les futurs clients');" >Se procurer des fichiers de prospection pour cibler les futurs clients</a><br/>
					   <a onclick="ajout_string('action_commercial4','Faire le point sur les clients presque acquis et sur le CA généré potentiellement');" >Faire le point sur les clients presque acquis et sur le CA généré potentiellement</a><br/>
					   <a onclick="ajout_string('action_commercial4','Se renseigner sur les habitudes d\'achat, motivations, freins, comportements, attentes');" >Se renseigner sur les habitudes d'achat, motivations, freins, comportements, attentes</a><br/>
					   <a onclick="ajout_string('action_commercial4','Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible');" >Identifier et lister les entreprises pour lesquelles un travail en sous-traitance est possible</a><br/>
					   <a onclick="ajout_string('action_commercial4','Réactiver les carnets d\'adresses personnel et professionnel');" >Réactiver les carnets d'adresses personnel et professionnel</a><br/>
					   <a onclick="ajout_string('action_commercial4','Définir la répartition: entreprises, associations, institutions, collectivités, individus');" >Définir la répartition: entreprises, associations, institutions, collectivités, individus</a><br/>
					   <a onclick="ajout_string('action_commercial4','Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d\'affaires');" >Quelles sont les caractéristiques de la clientèle ? Taille, activité, chiffre d'affaires</a><br/>
					   <a onclick="ajout_string('action_commercial4','La clientèle est-elle concentrée, dispersée, de passage, de proximité ?');" >La clientèle est-elle concentrée, dispersée, de passage, de proximité ?</a><br/>
					   <a onclick="ajout_string('action_commercial4','Evaluer le nombre de clients potentiels sur sa zone d\'intervention et mesurer leur volume');" >Evaluer le nombre de clients potentiels sur sa zone d'intervention et mesurer leur volume</a><br/>

                        </span></p><a onclick="document.getElementById('action_commercial4').style.display='none'" >Fermer</a>
                    </div></td>
                <td class="td1 table3Col2"><textarea name="delai_commercial4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanDel4"><?php echo $v_co[15];?></textarea></td>
                <td class="tdFin table3Col3"><textarea name="result_commercial4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaComPlanRes4"><?php echo $v_co[19];?></textarea></td>
              </tr>
            </tbody></table><br>
 <h2>Diagnostic et commentaires du référent</h2><br>
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
              
                <td class="td1" align="center">Points forts</td><td></td>
                <td class="tdFin" align="center">Points faibles</td><td></td>
              </tr>
              <tr>
               
                <td class="td1 table1Col1"><textarea name='pt_fort' rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPoinFor"><?php echo $v_ju[0]; ?></textarea></td><td><img onclick="document.getElementById('pt_fort').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_fort" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Aspect juridique</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('pt_fort','Choix juridique bien argumenté ');" >Choix juridique bien argumenté </a><br/>
<a onclick="ajout_string('pt_fort','Choix juridiques, sociaux et fiscaux cohérents');" >Choix juridiques, sociaux et fiscaux cohérents</a><br/>
<a onclick="ajout_string('pt_fort','Statut de TNS bien analysé');" >Statut de TNS bien analysé</a><br/>
<a onclick="ajout_string('pt_fort','Statut juridique choisi cohérent avec l\'image à dégager');" >Statut juridique choisi cohérent avec l'image à dégager</a><br/>
<a onclick="ajout_string('pt_fort','Les rôles des associés sont bien définis');" >Les rôles des associés sont bien définis</a><br/>
<a onclick="ajout_string('pt_fort','Le statut d\'EURL permet de bénéficier de l\'image de la SARL');" >Le statut d'EURL permet de bénéficier de l'image de la SARL</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('pt_fort').style.display='none'" >Fermer</a>
</div>      </td>
                <td class="tdFin table1Col2"><textarea name='pt_faible' rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPoinFaib"><?php echo $v_ju[1]; ?></textarea></td><td><img onclick="document.getElementById('pt_faible').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_faible" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Aspect juridique</h3></p><p>
<span style="text-align: center">

<a onclick="ajout_string('pt_faible','Pas encore d\'approche règlementaire');" >Pas encore d'approche règlementaire</a><br/>
<a onclick="ajout_string('pt_faible','Critères de choix salarié/TNS mal connus en début de prestation');" >Critères de choix salarié/TNS mal connus en début de prestation</a><br/>
<a onclick="ajout_string('pt_faible','Les conditions d'accès à la profession ne sont pas encore remplies');" >Les conditions d'accès à la profession ne sont pas encore remplies</a><br/>
<a onclick="ajout_string('pt_faible','Nécessité d\'obtenir la capacité de transport');" >Nécessité d'obtenir la capacité de transport</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('pt_faible').style.display='none'" >Fermer</a>
</div>      </td>
              </tr>
            </tbody></table>
        <br>

 
 <h2>Plan d'actions</h2><br>
 <table class="tableGen" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="td1" align="center">Actions à mener</td><td></td>
                <td class="td1" align="center">Délais de réalisation</td><td></td>
                <td class="tdFin" align="center">Résultat
attendu
                </td><td></td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="ac1" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanAct1"><?php echo $v_ju[2]; ?></textarea></td><td><img onclick="document.getElementById('ac1').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac1" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p><p>
<span style="text-align: left">

<a onclick="ajout_string('ac1','Aller sur le site de l\'APCE pour comparer les avantages et inconvénients des différents....');" >Aller sur le site de l'APCE pour comparer les avantages et inconvénients des différents....</a><br/>
<a onclick="ajout_string('ac1','Se procurer des modèles de statuts (site www.apce.com)');" >Se procurer des modèles de statuts (site www.apce.com)</a><br/>
<a onclick="ajout_string('ac1','Rencontrer un avocat');" >Rencontrer un avocat</a><br/>
<a onclick="ajout_string('ac1','Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA');" >Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('ac1').style.display='none'" >Fermer</a>
</div>  </td>
                <td class="td1 table3Col2"><textarea name="delai1_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanDel1"><?php echo $v_ju[6]; ?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result1_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanRes1"><?php echo $v_ju[10]; ?></textarea></td><td></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac2" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanAct2"><?php echo $v_ju[3]; ?></textarea></td><td><img onclick="document.getElementById('ac2').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac2" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p><p>
<span style="text-align: left">

<a onclick="ajout_string('ac2','Aller sur le site de l\'APCE pour comparer les avantages et inconvénients des différents....');" >Aller sur le site de l'APCE pour comparer les avantages et inconvénients des différents....</a><br/>
<a onclick="ajout_string('ac2','Se procurer des modèles de statuts (site www.apce.com)');" >Se procurer des modèles de statuts (site www.apce.com)</a><br/>
<a onclick="ajout_string('ac2','Rencontrer un avocat');" >Rencontrer un avocat</a><br/>
<a onclick="ajout_string('ac2','Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA');" >Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('ac2').style.display='none'" >Fermer</a>
</div> </td>
                <td class="td1 table3Col2"><textarea name="delai2_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanDel2"><?php echo $v_ju[7]; ?></textarea></td><td></td><td class="tdFin table3Col3"><textarea name="result2_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanRes2"><?php echo $v_ju[11]; ?></textarea></td><td></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac3" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanAct3"><?php echo $v_ju[4]; ?></textarea></td><td><img onclick="document.getElementById('ac3').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac3" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p><p>
<span style="text-align: left">

<a onclick="ajout_string('ac3','Aller sur le site de l\'APCE pour comparer les avantages et inconvénients des différents....');" >Aller sur le site de l'APCE pour comparer les avantages et inconvénients des différents....</a><br/>
<a onclick="ajout_string('ac3','Se procurer des modèles de statuts (site www.apce.com)');" >Se procurer des modèles de statuts (site www.apce.com)</a><br/>
<a onclick="ajout_string('ac3','Rencontrer un avocat');" >Rencontrer un avocat</a><br/>
<a onclick="ajout_string('ac3','Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA');" >Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('ac3').style.display='none'" >Fermer</a>
</div> </td>
                <td class="td1 table3Col2"><textarea name="delai3_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanDel3"><?php echo $v_ju[8]; ?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result3_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanRes3"><?php echo $v_ju[12]; ?></textarea></td><td></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac4" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanAct4"><?php echo $v_ju[5]; ?></textarea></td><td><img onclick="document.getElementById('ac4').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac4" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p><p>
<span style="text-align: left">

<a onclick="ajout_string('ac4','Aller sur le site de l\'APCE pour comparer les avantages et inconvénients des différents....');" >Aller sur le site de l'APCE pour comparer les avantages et inconvénients des différents....</a><br/>
<a onclick="ajout_string('ac4','Se procurer des modèles de statuts (site www.apce.com)');" >Se procurer des modèles de statuts (site www.apce.com)</a><br/>
<a onclick="ajout_string('ac4','Rencontrer un avocat');" >Rencontrer un avocat</a><br/>
<a onclick="ajout_string('ac4','Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA');" >Se rapprocher du Centre de Formalités des Entreprises (CFE) de la CCI, de la CMA</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('ac4').style.display='none'" >Fermer</a>
</div> </td>
                <td class="td1 table3Col2"><textarea name="delai4_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanDel4"><?php echo $v_ju[9]; ?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result4_ju" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaJuriPlanRes4"><?php echo $v_ju[13]; ?></textarea></td><td></td>
              </tr>
            </tbody></table><br>
 <h2>Diagnostic et commentaires du référent</h2><br>
 <textarea name="diag_ju" rows="5" cols="125" id="ctl00_cph_contenu_fmv_page_EvaJuriDiagComm" class="commentaire"><?php echo $v_ju[14]; ?></textarea>                
                </td>
		</tr>
	</tbody></table>
        
</div>
        </div></div>
        
        <div id="reglementaire" style="border:1px dotted #909 ; display:none"><img src="aspects_reglementaires.aspx_fichiers/top_blancSurCouleur.jpg" alt="" width="695" height="5"><div id="contenuFinal" class="forme_juridique">
        <h2>Points forts et points faibles (Aspects réglementaires) </h2><br>
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
               <td><img onclick="document.getElementById('pt_fort_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_fort_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 450px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Aspect reglementaire</h3></p>
                      <p>
<span style="text-align: left">

<a onclick="ajout_string('pt_fort_re','Les conditions d\'accès à la profession sont remplies');" >Les conditions d'accès à la profession sont remplies</a><br/>

</span>
  </p>
                        <a onclick="document.getElementById('pt_fort_re').style.display='none'" >Fermer</a>
</div>      
</td> <td class="tdFin table1Col2"><textarea name="pt_faible_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPoinFaib"><?php echo $v_re[1];?></textarea></td><td><img onclick="document.getElementById('pt_faible_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="pt_faible_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Aspect reglementaire</h3></p>
                      <p>
<span style="text-align: left">


<a onclick="ajout_string('pt_faible_re','Pas encore d\'approche règlementaire');" >Pas encore d'approche règlementaire</a><br/>
<a onclick="ajout_string('pt_faible_re','Critères de choix salarié/TNS mal connus en début de prestation');" >Critères de choix salarié/TNS mal connus en début de prestation</a><br/>
<a onclick="ajout_string('pt_faible_re','Les conditions d\'accès à la profession ne sont pas encore remplies');" >Les conditions d'accès à la profession ne sont pas encore remplies</a><br/>
<a onclick="ajout_string('pt_faible_re','Nécessité d\'obtenir la capacité de transport');" >Nécessité d'obtenir la capacité de transport</a><br/>

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
                <td class="td1" align="center">Actions à mener</td><td></td>
                <td class="td1" align="center">Délais de réalisation</td><td></td>
                <td class="tdFin" align="center">Résultat
attendu
                </td><td></td>
              </tr>
              <tr>
                <td class="td1 table3Col1"><textarea name="ac1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct1"><?php echo $v_re[2];?></textarea></td><td><img onclick="document.getElementById('ac1_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac1_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac1_re','Se procurer le formulaire ACCRE auprès du CFE compétent');" >Se procurer le formulaire ACCRE auprès du CFE compétent</a><br/>
<a onclick="ajout_string('ac1_re','Compléter le formulaire ACCRE à déposer au CFE compétent');" >Compléter le formulaire ACCRE à déposer au CFE compétent</a><br/>
<a onclick="ajout_string('ac1_re','Se renseigner sur le dispositif NACRE et les organismes agréés');" >Se renseigner sur le dispositif NACRE et les organismes agréés</a><br/>
<a onclick="ajout_string('ac1_re','Réfléchir à la rémunération minimum du futur créateur d\'entreprise');" >Réfléchir à la rémunération minimum du futur créateur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac1_re').style.display='none'" >Fermer</a>
</div>  </td>
                <td class="td1 table3Col2"><textarea name="delai1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel1"><?php echo $v_re[6];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result1_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes1"><?php echo $v_re[10];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct2"><?php echo $v_re[3];?></textarea></td><td><img onclick="document.getElementById('ac2_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac2_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac2_re','Se procurer le formulaire ACCRE auprès du CFE compétent');" >Se procurer le formulaire ACCRE auprès du CFE compétent</a><br/>
<a onclick="ajout_string('ac2_re','Compléter le formulaire ACCRE à déposer au CFE compétent');" >Compléter le formulaire ACCRE à déposer au CFE compétent</a><br/>
<a onclick="ajout_string('ac2_re','Se renseigner sur le dispositif NACRE et les organismes agréés');" >Se renseigner sur le dispositif NACRE et les organismes agréés</a><br/>
<a onclick="ajout_string('ac2_re','Réfléchir à la rémunération minimum du futur créateur d\'entreprise');" >Réfléchir à la rémunération minimum du futur créateur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac2_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel2"><?php echo $v_re[7];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result2_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes2"><?php echo $v_re[11];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct3"><?php echo $v_re[4];?></textarea></td><td><img onclick="document.getElementById('ac3_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac3_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac3_re','Se procurer le formulaire ACCRE auprès du CFE compétent');" >Se procurer le formulaire ACCRE auprès du CFE compétent</a><br/>
<a onclick="ajout_string('ac3_re','Compléter le formulaire ACCRE à déposer au CFE compétent');" >Compléter le formulaire ACCRE à déposer au CFE compétent</a><br/>
<a onclick="ajout_string('ac3_re','Se renseigner sur le dispositif NACRE et les organismes agréés');" >Se renseigner sur le dispositif NACRE et les organismes agréés</a><br/>
<a onclick="ajout_string('ac3_re','Réfléchir à la rémunération minimum du futur créateur d\'entreprise');" >Réfléchir à la rémunération minimum du futur créateur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac3_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel3"><?php echo $v_re[8];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result3_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes3"><?php echo $v_re[12];?></textarea></td>
              </tr>
               <tr>
                <td class="td1 table3Col1"><textarea name="ac4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanAct4"><?php echo $v_re[5];?></textarea></td><td><img onclick="document.getElementById('ac4_re').style.display='block'" border="0" src="./images/plus_16.png" /><div   id="ac4_re" style="position:absolute; background:#FFF; border:1px solid  #000; display:none; left: 750px; top: 540px; width: 550px; height: 150px; overflow: hidden;"><p><h3>Mots clés : Action à mener</h3></p> 
                      <p>
<span style="text-align: center">


<a onclick="ajout_string('ac4_re','Se procurer le formulaire ACCRE auprès du CFE compétent');" >Se procurer le formulaire ACCRE auprès du CFE compétent</a><br/>
<a onclick="ajout_string('ac4_re','Compléter le formulaire ACCRE à déposer au CFE compétent');" >Compléter le formulaire ACCRE à déposer au CFE compétent</a><br/>
<a onclick="ajout_string('ac4_re','Se renseigner sur le dispositif NACRE et les organismes agréés');" >Se renseigner sur le dispositif NACRE et les organismes agréés</a><br/>
<a onclick="ajout_string('ac4_re','Réfléchir à la rémunération minimum du futur créateur d\'entreprise');" >Réfléchir à la rémunération minimum du futur créateur d'entreprise</a><br/>


</span>
  </p>
                        <a onclick="document.getElementById('ac4_re').style.display='none'" >Fermer</a>
</div></td>
                <td class="td1 table3Col2"><textarea name="delai4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanDel4"><?php echo $v_re[9];?></textarea></td><td></td>
                <td class="tdFin table3Col3"><textarea name="result4_re" rows="5" cols="40" id="ctl00_cph_contenu_fmv_page_EvaReglPlanRes4"><?php echo $v_re[13];?></textarea></td>
              </tr>              
            </tbody></table><br>
 <h2>Diagnostic et commentaires du référent</h2><br>
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