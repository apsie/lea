<?php class TexteTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp_texte';
	
	
	function  get_value($id_bp)
	{
		
		return $this->fetchRow(
						   $this->select()
						          ->where('id_bp = ?',$id_bp)
							
								 			);
		
		
	
	}
	function initialiser_texte($id_bp)
	{			
				//$data = array('egw_bp_texte.id_projet',Zend_Registry::get('session')->projet->id_projet);
				$row = $this->createRow();
				$row->id_bp = $id_bp;
				$row->save();
	}
	
	function get_html($id_bp)
	{
	/*
		  if(Zend_Registry::get('resacc')->date_immat>0)
	  {
	 $dateImmat = date('d/m/Y',Zend_Registry::get('resacc')->date_immat);
	  }
	  else
	  {
		   $dateImmat=NULL;
	   }
	     if(Zend_Registry::get('resacc')->date_debut_activite>0)
	  {
	  $dateDebutActivite = date('d/m/Y',Zend_Registry::get('resacc')->date_debut_activite);
	  }
	  else
	  {
		   $dateDebutActivite=NULL;
		  }
	  */
		$ressource = new RessourceTb();
		$ressCrea = $ressource->getList($id_bp,'createur');
		$ressCon = $ressource->getList($id_bp,'conjoint');
		$totalCrea = $ressCrea['revenu_pro_net']+$ressCrea['retraite']+$ressCrea['pole_emploi']+$ressCrea['pensions']+$ressCrea['rsa']+$ressCrea['prestation_familiales']+$ressCrea['aide_logement']+$ressCrea['allocations_diverses']+$ressCrea['autres'];
		$totalCon = $ressCon['revenu_pro_net']+$ressCon['retraite']+$ressCon['pole_emploi']+$ressCon['pensions']+$ressCon['rsa']+$ressCon['prestation_familiales']+$ressCon['aide_logement']+$ressCon['allocations_diverses']+$ressCon['autres'];
	
		$charge = new ChargeTb();
		$chargeMont = $charge->getList($id_bp,'montant');
		$chargeDur = $charge->getList($id_bp,'duree');
		$totalChargeMont = $chargeMont['loyer']+$chargeMont['credit_conso']+$chargeMont['credit_auto']+$chargeMont['credit_immo']+$chargeMont['pension_alimentaire']+$chargeMont['credit_revolving']+$chargeMont['autre'];
		$totalChargeDur = $chargeDur['loyer']+$chargeDur['credit_conso']+$chargeDur['credit_auto']+$chargeDur['credit_immo']+$chargeDur['pension_alimentaire']+$chargeDur['credit_revolving']+$chargeDur['autre'];
		
                $projet = unserialize($_SESSION['session']->projet);
                $bp = unserialize($_SESSION['session']->bp);
$html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style>
body,html {
	font-size:100%;	
	font-family: "Arial";
	font-size:14px;
	color: #000;
	background-color:#FFF;	
	margin:0;
	padding:0;
	/*height:100%;*/
	background:url(../images/bg.jpg) repeat-y; 
	
	

}
h5,h4
{
	margin:none;}
.sommaire
{
	font-size:9px;
	
}
.impression
{
	padding:40px;}
.conseiller{
float:right;	
color:#FFF;


}

.page
{
	
	height:920px;
	margin-bottom : 30px;

	
}
.header
{
	background-color:#006;
	color:#FFF;
	font-weight:bolder;
	padding:2px;
	padding-left:10px;
}

.menu_header
{
	background-color: #CCC;
	color:#000;
	height:22px;
}

.menu_header ul {
 padding:0;
 margin:0;
 list-style-type:none;
 }
.menu_header li {
 margin-left:2px;
 float:left; /*pour IE*/
 }
.menu_header ul li a {
 display:block;
 float:left;
 

 background-color: #CCC;
 color:black;
 text-decoration:none;
 text-align:center;
 padding-left:5px;
 padding-right:5px;
 padding-top:2px;


 }
.menu_header ul li a:hover {
 background-color: #C0C0C0;
 border:1px solid #D2D2D2;
 } 
<!--maj_so-->
#test { 
margin-bottom:45px;
background-color:#33F; 
height:1000px;
width: 1000px;   
}
.bloc_g{
margin-left: 10px;   
margin-right: auto;  
margin-top:15px;
text-align:center;
/*border:solid; border-color:#999;*/
float:left; 
background-color:#FFF; 
width:45%;

}

.bloc_d{
margin-right: auto;  
margin-left:auto;
margin-top:15px;	
float:left; 

/*border:solid;
border-color:#999;*/

text-align:center;

background-color:#FFF; 
width:45%;

}


.titre{
/*border-color:#999;*/
padding-top:100px;
color:#0A4B8C;
font-size:40px;
font-weight:bold;
/*height:25px;
width:100%;*/
text-align:center;
/*background-color:#F90; */
font-family:"Trebuchet MS";
}

.titreSommaire{


color:#0A4B8C;
font-size:40px;
font-weight:bold;

text-align:center;

font-family:"Trebuchet MS";
}
.intitule_dossier
{
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-bottomleft: 10px; 
	background-color:#006;
	font-size:12px;
	float:right;
	margin-left:30%;
	color:#FFF;
	margin-top:20px;
	padding-left:10px;
	padding:10px;
	border:2px solid #000
	
	
	}
.titre a:link{
	text-decoration:none;
	color:#006;
}
.titre a:hover{
	text-decoration:none;
	color:#F5DD94;
	
}
.titre a:visited{
	text-decoration:none;
	color:#006;
}
.contenu_redac{
margin-top:0px;
background-color:#E6E6E6;
padding-left:5px;
float:left;
font-size:12px;
font-weight:bold;
color: #333;
width:280px;
bottom:0px;
height:1300px;
}

.menu_g{
color:#000;
margin-top:10px;


}



.menu_g a{
color:#000;

}

.menu_g a:visited{
color:#000;

}

.menu_g a:hover{
color:#F90;
}
.s_menu_g{

padding-left:20px;

color: #A7A7A7;
}



.s_menu_g a{
text-decoration:none;
color: #A7A7A7;
padding-left:40px;

}
.s_menu_g a:hover{
text-decoration:none;
color: #F90;
font-weight:400;
}

/**/
.s_s_menu_g{

padding-left:40px;

}



.s_s_menu_g a{
text-decoration:none;
color: #333;
font-weight:400;
}
.s_s_menu_g a:hover{
text-decoration:none;
color: #F90;
font-weight:400;
}

/**/
.menu_d{
	
float:right;
margin:0px;
padding: 0px;
background-color: #F0F0F0;
width: 150px;
}

.menu_d ul {
list-style: none;
margin: 0;
padding: 0;

}

.menu_d li a {
height: 32px;
voice-family: "\"}\""; 
voice-family: inherit;

text-decoration: none;

} 

.menu_d li a:link, #menu19 li a:visited {
color: #333;
display: block;
background-color:#F0F0F0;
padding: 8px 0 0 10px;


}

.menu_d li a:hover {
color: #000;
background-color:#CF6;
padding: 8px 0 0 10px;

}

.contenu_ac
{
  position:absolute;
 margin-top:40px;
   top:10px;
   bottom:10px;
   left:320px;
   
}
.contenu_index
{
 position:static;
 margin-top:100px;
 }
.titre_redac 
{
	margin-left:10px;
	font-size:17px;
	font-weight:bold;
	color:#A7A7A7;
	font-family:"Trebuchet MS";

}
.titre_long 
{
	margin-left:10px;

	font-size:17px;
	font-weight:bold;
	color:  #FBA54F;
	font-family:"Trebuchet MS";

}
.titre_court 
{
	margin-left:10px;
	font-size:36px;
	font-weight:bold;
	color: #FBA54F;
	font-family:"Trebuchet MS";

}

.gd_titre{
	font-size:16px;
	font-weight:bold;
	color:#000;
	padding:2px;


}
.gd_titre_apercu{
	font-size:18px;
	font-weight:bold;
	color: #003;
	padding:8px;

}
.error_pagination
{
	color: #F60;
	font-weight:bolder;
	font-size:14px;}
.sous_titre{
	font-size:14px;
	font-weight:bold;
	padding: 5px 0 1px 65px;
	color:#000;
}
.sous_s_titre{
	font-size:14px;
	padding:3px 0 0 95px;
	color:#000;
	font-style:italic;
}
input,select{
border:1px solid #CCC;
color:#036;
padding:2px;

	
}
input:hover,input:focus{
background-color:#FEF1C7;	
	
}
.titre_maj input{
width:180px;
font-size:10px;
border:none;
border-bottom:1px dashed;
	
}
.button{
background-color:#006;
color:#F90;
font-weight:bold;
-moz-border-radius: 10px;
padding:5px;
border:1px solid #CCC;
}
.autre{
margin-left:0;


}


.autre a{
text-decoration:none;
}
.premiere_page
{
	
	font-size:16px;
	color:#000;
	
	}
.premiere_page_presentation
{
	padding-top:50px;
	padding-left:50px;
}
.titre_outils
{

font-style : italic;
color : #F39A33;
font-weight:bolder;
background-color : #FEF1C7;
padding:2px;
}
.tableau_environnement_financier table, .tableau_environnement_financier tr
{
	border : 1px solid #000;
	padding :2px;
}
.tr_1 td
{
	background-color : #FFFFFF;
}
.tr_2 td
{
	background-color : #FAFAFA;
}
th
{
font-weight : bolder;
border-bottom : 2px solid;
background-color : #FAFAFA;

}
.trSousTitre td
{

border-bottom : 1px solid;
background-color : #FAFAFA;
font-style:italic;

}

</style>
</head>
<body>

<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");
  $size = 10;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - $text_height - 15;
  
  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);
  $pdf->line(16, 15, $w - 16, 15, $color, 0.5);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  $text = "Page {PAGE_NUM} sur {PAGE_COUNT}";  
  $text2 = "APSIE : Business Plan";
  $pdf->page_text(20, 4, $text2, $font, $size, $color);
  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 sur 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script><div class="impression">
<div class="premiere_page"><br/><center><img src="./images/logo_apsie.jpg" /></center><div class="titre">BUSINESS PLAN</div><div class="premiere_page_presentation">
<br/><br/><br/><br/><strong>NOM DU PROJET</strong><br/>'.$projet->description_projet.'<br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/>
<strong>NOM DU PORTEUR DE PROJET</strong><br/>'.$projet->nom_complet.'<br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/>
<strong>CONSEILLER APSIE</strong><br/>'.$bp->account_lid.'<br/><br/>
</div></div>
<div class="page">
<br/><br/><div class="titreSommaire">SOMMAIRE</div><br/><br/>
<h2>I.PRESENTATION DU PORTEUR DE PROJET</h2>
	
<div class="gd_titre">1 SITUATION PERSONNELLE DU CREATEUR</div>
	
<div class="sous_titre">1.1 Fiche signalétique</div> 	
<div class="sous_titre">1.2 Environnement financier</div>
	<br/><br/>
<div class="gd_titre">2 SITUATION PROFESSIONNELLE</div>
	
<div class="sous_titre">2.1 Expérience professionnelle et formation</div>
<div class="sous_titre">2.2 Historique du projet, motivations et objectifs poursuivis</div>
<div class="sous_titre">2.3 Atouts et faiblesses</div>
<div class="sous_titre">2.4 L\'entourage du porteur de projet</div>
<div class="sous_s_titre">2.4.1 Le soutiens </div>
<div class="sous_s_titre">2.4.2 Connaissance du secteur d\'activité ou du métier</div>
<div class="sous_s_titre">2.4.3 Accompagnement</div>


<h2>II.LE PROJET</h2>
	
<div class="gd_titre">1	LE PRODUIT/SERVICE ET LE MARCHE</div>
	
<div class="sous_titre">1.1 Description du produit ou du service</div> 	
<div class="sous_titre">1.2 Le marché</div>
<div class="sous_titre">1.3 Les clients</div>
<div class="sous_titre">1.4 La concurrence</div>
<div class="sous_titre">1.5 Les fournisseurs et sous traitants</div>
<div class="sous_titre">1.6 L\'emplacement géographique</div>
	<br/><br/>
<div class="gd_titre">2 LA STRATEGIE COMMERCIALE</div>
<div class="sous_titre">2.1 Les modes de commercialisation des produits ou services</div>
<div class="sous_titre">2.2 La politique de prix</div>
<div class="sous_titre">2.3 Les modes de communication et outils mis en place</div>
<div class="sous_titre">2.4 Chiffre d\'affaires prévisionnel</div>
</div>
<div class="page">
<div class="gd_titre">3 LES MOYENS DE PRODUCTION</div>
<div class="sous_titre">3.1 Les moyens humains</div>
<div class="sous_titre">3.2 Les moyens en immeuble et/ou en terrain</div>
<div class="sous_titre">3.3 Les moyens en matériel d\'exploitation et outillage</div>
<div class="sous_titre">3.4 Les moyens incorporels</div>
<div class="sous_titre">3.5 Les stocks</div>


<h2>III.LES ASPECTS JURIDIQUES, FISCAUX et SOCIAUX</h2>
<div class="gd_titre">1 LES ASPECTS JURIDIQUES</div>
<div class="gd_titre">2	LES ASPECTS FISCAUX</div>
<div class="gd_titre">3	LES ASPCETS SOCIAUX</div>

<h2>IV.LE DOSSIER FINANCIER</h2>
<div class="gd_titre">1. LES BESOINS DE FINANCEMENT</div>
<div class="sous_titre">1.1 Besoin de financement global</div>
<div class="sous_titre">1.2 Les demandes de financement</div>
<br/><br/>
<div class="gd_titre">2. COMPOSITION DU DOSSIER FINANCIER</div>


</div>
<div class="page">
<h2>I.PRESENTATION DU PORTEUR DE PROJET</h2>
	
<div class="gd_titre">1 SITUATION PERSONNELLE DU CREATEUR</div>
	
<div class="sous_titre">1.1 Fiche signalétique</div> 
<br/><br/><br/><br/>
<div style="margin:60px"><table style="border:1px solid #000;padding : 20px;">
<tr><td height="75px" width="200px"><strong>NOM</strong></td><td width="150px">:</td><td>'.$projet->nom.'</td></tr>
<tr><td height="75px" width="200px"><strong>PRENOM</strong></td><td width="150px">:</td><td>'.$projet->prenom.'</td></tr>
<tr><td height="75px" width="200px"><strong>AGE</strong></td><td width="150px">:</td><td>'.(isset($projet->date_naissance)?Age::get_age($projet->date_naissance) : '').'</td></tr>
<tr><td height="75px" width="200px"><strong>ADRESSE</strong></td><td width="150px">:</td><td>'.$projet->adresse_ligne_1.'</td></tr>
<tr><td height="75px" width="200px"><strong>VILLE</strong></td><td width="150px">:</td><td>'.$projet->ville.'</td></tr>
<tr><td height="75px" width="200px"><strong>CODE POSTAL</strong></td><td width="150px">:</td><td>'.$projet->cp.'</td></tr>
<tr><td height="75px" width="200px"><strong>TELEPHONE</strong></td><td width="150px">:</td><td>'.$projet->portable_perso.'</td></tr>
<tr><td height="75px" width="200px"><strong>EMAIL</strong></td><td width="150px">:</td><td>'.$projet->email_perso.'</td></tr>
<tr><td width="200px"><strong>SITUATION DE FAMILLE</strong></td><td width="150px">:</td><td>'.(isset($projet->situation_maritale)?$projet->situation_maritale:'').'</td></tr>


</table></div>
</div>
<div class="page">
<div class="sous_titre">1.2 Environnement financier</div>
<br/>
<br/> <div  class="tableau_environnement_financier" style="padding-left:20px"><table><tr><th colspan="4">RESSOURCES</td><th colspan="3">CHARGES</th></tr>
<tr class="trSousTitre"><td>RESSOURCES</td><td>CREATEUR</td><td>CONJOINT</td><td>TOTAL</td><td>DEPENSES</td><td>MONTANT</td><td>DUREE</td></tr>
<tr class="tr_1"><td>Revenu professionnel mensuel en net</td><td>'.$ressCrea['revenu_pro_net'].' EUR</td><td>'.$ressCon['revenu_pro_net'].' EUR</td><td>'.($ressCrea['revenu_pro_net']+$ressCon['revenu_pro_net']).' EUR</td><td>Loyer</td><td>'.$chargeMont['loyer'].' EUR</td><td>'.$chargeDur['loyer'].'</td></tr>
<tr class="tr_2"><td>Retraite</td><td>'.$ressCrea['retraite'].' EUR</td><td>'.$ressCon['retraite'].' EUR</td><td>'.($ressCrea['retraite']+$ressCon['retraite']).' EUR</td><td>Crédit consommation</td><td>'.$chargeMont['credit_conso'].' EUR</td><td>'.$chargeDur['credit_conso'].'</td></tr>
<tr class="tr_1"><td>Pôle emploi</td><td>'.$ressCrea['pole_emploi'].' EUR</td><td>'.$ressCon['pole_emploi'].' EUR</td><td>'.($ressCrea['pole_emploi']+$ressCon['pole_emploi']).' EUR</td><td>Crédit automobile</td><td>'.$chargeMont['credit_auto'].' EUR</td><td>'.$chargeDur['credit_auto'].'</td></tr>
<tr class="tr_1"><td>RSA</td><td>'.$ressCrea['rsa'].' EUR</td><td>'.$ressCon['rsa'].' EUR</td><td>'.($ressCrea['rsa']+$ressCon['rsa']).' EUR</td><td>Pension alimentaire</td><td>'.$chargeMont['pension_alimentaire'].' EUR</td><td>'.$chargeDur['pension_alimentaire'].'</td></tr>
<tr class="tr_2"><td>Prestations familiales</td><td>'.$ressCrea['prestations_familiales'].' EUR</td><td>'.$ressCon['prestations_familiales'].' EUR</td><td>'.($ressCrea['prestation_familiales']+$ressCon['prestations_familiales']).' EUR</td><td>Crédit Revolving</td><td>'.$chargeMont['credit_revolving'].' EUR</td><td>'.$chargeDur['credit_revolving'].'</td></tr>
<tr class="tr_1"><td>Aide au logement</td><td>'.$ressCrea['aide_logement'].' EUR</td><td>'.$ressCon['aide_logement'].' EUR</td><td>'.($ressCrea['aide_logement']+$ressCon['aide_logement']).' EUR</td><td>Autres</td><td>'.$chargeMont['autre'].' EUR</td><td>'.$chargeDur['autre'].'</td></tr>
<tr class="tr_2"><td>Allocations diverses</td><td>'.$ressCrea['allocations_diverses'].' EUR</td><td>'.$ressCon['allocations_diverses'].' EUR</td><td>'.($ressCrea['allocations_diverses']+$ressCon['allocations_diverses']).' EUR</td><td></td><td></td><td></td></tr>
<tr class="tr_1"><td>Autres</td><td>'.$ressCrea['autres'].' EUR</td><td>'.$ressCon['autres'].' EUR</td><td>'.($ressCrea['autres']+$ressCon['autres']).' EUR</td><td></td><td></td><td></td></tr>
<tr class="tr_2"><td>TOTAL</td><td>'.$totalCrea.' EUR</td>
<td>'.$totalCon.' EUR</td><td>'.($totalCrea+$totalCon).' EUR</td><td>TOTAL</td><td>'.$totalChargeMont.' EUR</td><td>'.$totalChargeDur.' mois</td></tr>
</table><br/><br/><br/>
<table style=" border:none"><tr><td><img  src="./images/'.$bp->id_bp.'_ressource_charge.png" /></td>
<td><table style=" border:none"><tr><td style="background-color:#89AFBD;width:15px;height:15px"></td><td>Ressource</td></tr><tr><td  style="background-color:#F44853;width:15px;height:15px"><br/></td><td>Charge</td></tr></table></td></tr></table>
</div><br/><br/>
</div>
<div class="page">
<div class="gd_titre">2 SITUATION PROFESSIONNELLE</div>
<div class="sous_titre">2.1 Formation Expérience professionnelle</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_1.'
<br/>
<br/>
<div class="sous_titre">2.2 Historique du projet, motivations et objectifs poursuivis</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_2.'
<br/>
<br/>
<div class="sous_titre">2.3 Atouts et faiblesses</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_3.'
<br/>
<br/>
<div class="sous_titre">2.4 Atouts et faiblesses</div>
<br/>
<br/>
<div class="sous_s_titre">2.4.1 Le soutiens</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_4_1.'
<br/>
<br/>
<div class="sous_s_titre">2.4.2 Connaissance du secteur d\'activité ou du métier</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_4_2.'
<br/>
<br/>
<div class="sous_s_titre">2.4.3 Accompagnement</div>
<br/>
'.Zend_Registry::get('textePresentation')->texte_titre_2_4_3.'
<br/>
<br/>

</div>

<div class="page">
<h2>II. LE PROJET</h2>
	
<div class="gd_titre">1 LE PRODUIT/SERVICE ET LE MARCHE</div>
	
<div class="sous_titre">1.1 Description du produit ou du service</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_1.'
<br/><br/>
<div class="sous_titre">1.2 Le march�</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_2.'
<br/><br/>
<div class="sous_titre">1.3 Les clients</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_3.'
<br/><br/>';


$html .="";

$html .='<div class="sous_titre">1.4 La concurrence</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_4.'
<br/><br/><h4>Les produits concurrents</h4><br/>';
$p = new ProduitsConcurrentsTb();
	$val = $p->getList($id_bp);
	
	$html .='<div style="padding-left:10px">';
	foreach($val as $valeur)
	{
		$html .='<h5>+ '.utf8_decode($valeur['libelle_produit']).'</h5>';
		$p_d = new ProduitsConcurrentsDetailsTb();
		$val_d = $p_d->getList($valeur['id_produits_concurrents']);
		$html .='<div style="padding-left:20px">';
		foreach($val_d as $valeur_d)
	{
	
		$html .='- '.utf8_decode($valeur_d['libelle_details']).' : '.utf8_decode($valeur_d['valeur']).'<br/>';
	}
	$html .='</div>';
	}
	
$html.='</div><div class="sous_titre">1.5 Les fournisseurs et sous traitants</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_5.'
<br/><br/>
<div class="sous_titre">1.6 L\'emplacement géographique</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_1_6.'
<br/><br/>
</div>
<div class="page">
<div class="gd_titre">2 LA STRATEGIE COMMERCIALE</div>
	
<div class="sous_titre">2.1 Les modes de commercialisation des produits ou services</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_2_1.'
<br/><br/>
<div class="sous_titre">2.2 La politique de prix</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_2_2.'
<br/><br/>
<div class="sous_titre">2.3 Les modes de communication et outils mis en place</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_2_3.'
<br/><br/>
<div class="sous_titre">2.4 Chiffre d\'affaires prévisionnel</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_2_4.'
<br/>
<br/>
</div>';

    $moyen = new MoyenHumainTb();
    $bp = unserialize($_SESSION['session']->bp);
	$productif=$moyen->getList($bp->id_bp,'productif');
	$encadrement=$moyen->getList($bp->id_bp,'encadrement');
	$commercial=$moyen->getList($id_bp,'commercial');
	$administration=$moyen->getList($bp->id_bp,'administration');
	$ms_un_pro= $productif['salaire_brut_mensuel']*12*$productif['nombre_annee1'];
	$ms_un_en = $encadrement['salaire_brut_mensuel']*12*$encadrement['nombre_annee1'];
	$ms_un_com = $commercial['salaire_brut_mensuel']*12*$commercial['nombre_annee1'];
	$ms_un_ad = $administration['salaire_brut_mensuel']*12*$administration['nombre_annee1'];
	$ms_un = $ms_un_pro+$ms_un_en+$ms_un_com+$ms_un_ad;
	$ms_deux_pro= $productif['salaire_brut_mensuel']*12*$productif['nombre_annee2'];
	$ms_deux_en = $encadrement['salaire_brut_mensuel']*12*$encadrement['nombre_annee2'];
	$ms_deux_com = $commercial['salaire_brut_mensuel']*12*$commercial['nombre_annee2'];
	$ms_deux_ad = $administration['salaire_brut_mensuel']*12*$administration['nombre_annee2'];
	$ms_deux = $ms_deux_pro+$ms_deux_en+$ms_deux_com+$ms_deux_ad;
	$ms_trois_pro= $productif['salaire_brut_mensuel']*12*$productif['nombre_annee3'];
	$ms_trois_en = $encadrement['salaire_brut_mensuel']*12*$encadrement['nombre_annee3'];
	$ms_trois_com = $commercial['salaire_brut_mensuel']*12*$commercial['nombre_annee3'];
	$ms_trois_ad = $administration['salaire_brut_mensuel']*12*$administration['nombre_annee3'];
	$ms_trois = $ms_trois_pro+$ms_trois_en+$ms_trois_com+$ms_trois_ad;
$html.='<div class="page">
<div class="gd_titre">3 LES MOYENS DE PRODUCTION</div>
<div class="sous_titre">3.1 Les moyens humains</div>
<table style="border:1px solid #CCC">
<tr class="trSousTitre"><td></td><td></td>
<th class="trSousTitre" colspan="4" align="center">NOMBRE</th></tr>
<tr class="trSousTitre"><td></td><td>Salaire brut moyen actuel (mensuel)</td>
<td>En début d\'activité</td><td>1ere ann�e</td><td>2eme année</td><td>3eme ann""e</td></tr>
<tr class="tr_1"><td>Productifs</td><td align="center">'.number_format($productif['salaire_brut_mensuel'],0, ',', ' ').' EUR</td><td align="center">'.$productif['nombre_debut_activite'].'</td><td align="center">'.$productif['nombre_annee1'].'</td><td align="center">'.$productif['nombre_annee2'].'</td><td align="center">'.$productif['nombre_annee3'].'</td></tr>
<tr class="tr_2"><td>Encadrement</td><td align="center"">'.number_format($encadrement['salaire_brut_mensuel'],0, ',', ' ').' EUR</td><td align="center">'.$encadrement['nombre_debut_activite'].'</td><td align="center">'.$encadrement['nombre_annee1'].'</td><td align="center">'.$encadrement['nombre_annee2'].'</td><td align="center">'.$encadrement['nombre_annee3'].'</td></tr>
<tr class="tr_1"><td>Commercial</td><td align="center"">'.number_format($commercial['salaire_brut_mensuel'],0, ',', ' ').' EUR</td><td align="center">'.$commercial['nombre_debut_activite'].'</td><td align="center">'.$commercial['nombre_annee1'].'</td><td align="center">'.$commercial['nombre_annee2'].'</td><td align="center">'.$commercial['nombre_annee3'].'</td></tr>
<tr class="tr_2"><td>Administration et Direction</td><td align="center"">'.number_format($administration['salaire_brut_mensuel'],0, ',', ' ').' EUR</td><td align="center">'.$administration['nombre_debut_activite'].'</td><td align="center">'.$administration['nombre_annee1'].'</td><td align="center">'.$administration['nombre_annee2'].'</td><td align="center">'.$administration['nombre_annee3'].'</td></tr>
<tr class="tr_1"><th class="titre_outils2" colspan="3" align="center">Masse salariale annuelle en  EUR(Charges sociales incluses)
</th><td align="center">'. number_format($ms_un,0, ',', ' ').' EUR</td><td align="center">'.number_format($ms_deux,0, ',', ' ').' EUR</td><td align="center">'.number_format($ms_trois,0, ',', ' ').' EUR</td></tr></table>
<img  src="./images/'.$bp->id_bp.'_moyen_humain.png" /><br/><br/>';



    $moyen = new MoyenImmTerrainTb();
	$achat=$moyen->getList($bp->id_bp,'achat');
	$location=$moyen->getList($bp->id_bp,'location');
	$credit=$moyen->getList($bp->id_bp,'credit');
	
	
$html.='<div class="sous_titre">3.2 Les moyens en immeubles et terrains</div>

<table style="border:1px solid #CCC">
<tr class="trSousTitre"><td></td><td>Coût en  EUR / an</td>
<td class="tr_1">Démarrage</td><td>1ere année</td><td>2eme année</td><td>3eme année</td></tr>
<tr class="tr_2"><td>ACHAT</td><td >Immobilisations corporelles</td><td align="right">'.$achat['demarrage'].' EUR </td><td align="right">'.$achat['annee1'].' EUR </td><td align="right">'.$achat['annee2'].' EUR </td><td align="right">'.$achat['annee3'].' EUR </td></tr>
<tr class="tr_1"><td>LOCATION</td><td >Charges loyer</td><td align="right">'.$location['demarrage'].' EUR </td><td align="right">'.$location['annee1'].' EUR </td><td align="right">'.$location['annee2'].' EUR </td><td align="right">'.$location['annee3'].' EUR </td></tr>
<tr class="tr_2"><td>CREDIT-BAIL</td><td >Charges  Crédit-bail</td><td align="right">'.$credit['demarrage'].' EUR </td><td align="right">'.$credit['annee1'].' EUR </td><td align="right">'.$credit['annee2'].' EUR </td><td align="right">'.$credit['annee3'].' EUR </td></tr>
</table><br/><br/>
<div class="sous_titre">3.3 Les moyens matériels d\'exploitation et outillage</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_3_3.'
<br/><br/>
<div class="sous_titre">3.4 Les moyens en éléments incorporels</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_3_4.'
<br/><br/>
<div class="sous_titre">3.5 Les stocks</div> 
<br/>
'.Zend_Registry::get('texteProjet')->texte_titre_3_5.'
<br/><br/>
</div>';
$html .='<div class="page">
<h2>I.LES ASPECTS JURIDIQUES, FISCAUX et SOCIAUX</h2>
	
<div class="gd_titre">1 LES ASPECTS JURIDIQUES</div>

<br/>
'.Zend_Registry::get('texteAspect')->texte_titre_1.'
<br/><br/>
<div class="gd_titre">2 LES ASPECTS FISCAUX</div>
<br/>
'.Zend_Registry::get('texteAspect')->texte_titre_2.'
<br/><br/>
<div class="gd_titre">3 LES ASPECTS SOCIAUX</div>
<br/>
'.Zend_Registry::get('texteAspect')->texte_titre_3.'
<br/><br/>
</div>';


$html .='<div class="page">
<h2>IV.LE DOSSIER FINANCIER</h2>
	
<div class="gd_titre">1 LES BESOINS DE FINANCEMENT</div>

<br/>
<div class="sous_titre">1.1 Besoin de financement global</div> 

'.Zend_Registry::get('texteFinancier')->texte_titre_1_1.'
<br/><br/>

<div class="sous_titre">1.2 Les demandes de financement</div> 
<br/>
'.Zend_Registry::get('texteFinancier')->texte_titre_1_2.'
<br/><br/>
</div>
<div class="page">
<div class="gd_titre">2 COMPOSITION DU DOSSIER FINANCIER</div>

</div>';
	 
$html .='</div></body></html>';
		 return $html;
	
	}
	
	}

?>