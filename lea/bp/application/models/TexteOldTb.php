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
	  
$html ='<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style>
body,html {
	font-size:100%;	
	font-family: "Arial";
	font-size:11px;
	color: #000;
	background-color:#FFF;	
	margin:0;
	padding:0;
	/*height:100%;*/
	background:url(../images/bg.jpg) repeat-y; 
	
	

}
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
	
	height:950px;
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
padding-top:180px;
color:#000;
font-size:50px;
font-weight:bold;
/*height:25px;
width:100%;*/
text-align:center;
/*background-color:#F90; */
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
	font-size:12px;
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
	font-size:12px;
	font-weight:bold;
	padding: 5px 0 1px 65px;
	color:#C55001;
}
.sous_s_titre{
	font-size:11px;
	padding:3px 0 0 95px;
	color:#666;
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
	padding-bottom:500px;
	}
.premiere_page_presentation
{
	padding-top:50px;
	padding-left:170px;
}
.titre_outils
{

font-style : italic;
color : #F39A33;
font-weight:bolder;
background-color : #FEF1C7;
padding:2px;
}
</style>
</head>
<body>

<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  $text = "Page {PAGE_NUM} sur {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 sur 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script><div class="impression">
<div class="premiere_page"><img src="images/logo_apsie.jpg" width="200" /><div class="titre">BUSINESS PLAN </div><div class="premiere_page_presentation"><table ><tr style="height:20px"><td width="135"><strong>BENEFICIAIRE</strong></td><td width="194">'.$GLOBALS['session']->projet->nom_complet.'</td></tr><tr ><td width="135"><strong>PROJET</strong></td><td style="height:40px" width="194">'.$GLOBALS['session']->projet->description_projet.'</td></tr>
<tr style="height:20px"><td width="135"><strong>REFERENT</strong></td><td width="194">'.$GLOBALS['session']->bp->account_firstname.' '.$GLOBALS['session']->bp->account_lastname.'</td></tr></table></div></div>
';
if(Zend_Registry::get('validation')->bool_titre_sommaire==1)
{
$html .='<div class="page">
<div class="sommaire">
<div class="gd_titre">'.Zend_Registry::get('titre')->titre_sommaire.'</div>';

if(Zend_Registry::get('validation')->bool_titre_intro==1)
{
	$html .='<div class="gd_titre">'.Zend_Registry::get('titre')->titre_intro.'</div>';
}
if(Zend_Registry::get('validation')->bool_titre_1==1)
{
	$html .='<div class="gd_titre">1. '.Zend_Registry::get('titre')->titre_1.'</div>';
}	
if(Zend_Registry::get('validation')->bool_titre_1_1==1)
{
$html .='<div class="sous_titre">1.1. '.Zend_Registry::get('titre')->titre_1_1.'</div>';
}
if(Zend_Registry::get('validation')->bool_titre_1_2==1)
{
	$html .='<div class="sous_titre">1.2. '.Zend_Registry::get('titre')->titre_1_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_2==1)
{
	$html .='<div class="gd_titre">2.  '.Zend_Registry::get('titre')->titre_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_2_1==1)
{	
	$html .='<div class="sous_titre">2.1. '.Zend_Registry::get('titre')->titre_2_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_2_2==1)
{
	$html .='<div class="sous_titre">2.2.  '.Zend_Registry::get('titre')->titre_2_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_2_3==1)
{
	$html .='<div class="sous_titre">2.3.  '.Zend_Registry::get('titre')->titre_2_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3==1)
{
	$html .='<div class="gd_titre">3.  '.Zend_Registry::get('titre')->titre_3.' </div>';
}
/*if(Zend_Registry::get('validation')->bool_titre_3_0==1)
{
	$html .='<div class="sous_titre">3.0.  '.Zend_Registry::get('titre')->titre_3_0.' </div>';
}*/
if(Zend_Registry::get('validation')->bool_titre_3_1==1)
{
	$html .='<div class="sous_titre">3.1. '.Zend_Registry::get('titre')->titre_3_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_1_1==1)
{
	$html .='<div class="sous_s_titre">3.1.1. '.Zend_Registry::get('titre')->titre_3_1_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_1_2==1)
{
	$html .='<div class="sous_s_titre">3.1.2.  '.Zend_Registry::get('titre')->titre_3_1_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_2==1)
{
	$html .='<div class="sous_titre">3.2. '.Zend_Registry::get('titre')->titre_3_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_2_1==1)
{
	$html .='<div class="sous_s_titre">3.2.1. '.Zend_Registry::get('titre')->titre_3_2_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_2_2==1)
{
	$html .='<div class="sous_s_titre">3.2.2. '.Zend_Registry::get('titre')->titre_3_2_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_2_3==1)
{
	$html .='<div class="sous_s_titre">3.2.3.  '.Zend_Registry::get('titre')->titre_3_2_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_3==1)
{
	$html .='<div class="sous_titre">3.3.  '.Zend_Registry::get('titre')->titre_3_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_3_1==1)
{
	$html .='<div class="sous_s_titre">3.3.1.  '.Zend_Registry::get('titre')->titre_3_3_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_3_2==1)
{
	$html .='<div class="sous_s_titre">3.3.2. '.Zend_Registry::get('titre')->titre_3_3_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_3_3==1)
{
	$html .='<div class="sous_s_titre">3.3.3.  '.Zend_Registry::get('titre')->titre_3_3_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_3_4==1)
{
	$html .='<div class="sous_titre">3.4.  '.Zend_Registry::get('titre')->titre_3_4.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4==1)
{
	$html .='<div class="gd_titre">4.  '.Zend_Registry::get('titre')->titre_4.'</div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_1==1)
{
	$html .='<div class="sous_titre">4.1. '.Zend_Registry::get('titre')->titre_4_1.' </div>';	
}
if(Zend_Registry::get('validation')->bool_titre_4_2==1)
{
	$html .='<div class="sous_titre">4.2.  '.Zend_Registry::get('titre')->titre_4_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_2_1==1)
{
	$html .='<div class="sous_s_titre">4.2.1.  '.Zend_Registry::get('titre')->titre_4_2_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_2_2==1)
{
	$html .='<div class="sous_s_titre">4.2.2.  '.Zend_Registry::get('titre')->titre_4_2_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_2_3==1)
{
	$html .='<div class="sous_s_titre">4.2.3.  '.Zend_Registry::get('titre')->titre_4_2_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_2_4==1)
{
	$html .='<div class="sous_s_titre">4.2.4.  '.Zend_Registry::get('titre')->titre_4_2_4.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_3==1)
{
	$html .='<div class="sous_titre">4.3.  '.Zend_Registry::get('titre')->titre_4_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_3_1==1)
{
	$html .='<div class="sous_s_titre">4.3.1. '.Zend_Registry::get('titre')->titre_4_3_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_3_2==1)
{
	$html .='<div class="sous_s_titre">4.3.2. '.Zend_Registry::get('titre')->titre_4_3_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_3_3==1)
{
	$html .='<div class="sous_s_titre">4.3.3. '.Zend_Registry::get('titre')->titre_4_3_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4==1)
{	  
	$html .='<div class="sous_titre">4.4. '.Zend_Registry::get('titre')->titre_4_4.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4_1==1)
{
	$html .='<div class="sous_s_titre">4.4.1. '.Zend_Registry::get('titre')->titre_4_4_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4_2==1)
{
	$html .='<div class="sous_s_titre">4.4.2. '.Zend_Registry::get('titre')->titre_4_4_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4_3==1)
{
	 $html .='<div class="sous_s_titre">4.4.3. '.Zend_Registry::get('titre')->titre_4_4_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_5==1)
{
	$html .='<div class="gd_titre">5.  '.Zend_Registry::get('titre')->titre_5.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_6==1)
{
	$html .='<div class="gd_titre">6.  '.Zend_Registry::get('titre')->titre_6.' </div>';
}	
if(Zend_Registry::get('validation')->bool_titre_6_1==1)
{							  
	$html .='<div class="sous_titre">6.1.  '.Zend_Registry::get('titre')->titre_6_1.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_6_2==1)
{
	$html .='<div class="sous_titre">6.2. '.Zend_Registry::get('titre')->titre_6_2.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_6_3==1)
{
	$html .='<div class="sous_titre">6.3.  '.Zend_Registry::get('titre')->titre_6_3.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_7==1)
{
	$html .='<div class="gd_titre">7. '.Zend_Registry::get('titre')->titre_7.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_8==1)
{
	$html .='<div class="gd_titre">8.  '.Zend_Registry::get('titre')->titre_8.' </div>';
}
if(Zend_Registry::get('validation')->bool_titre_9==1)
{
	$html .='<div class="gd_titre">9. '.Zend_Registry::get('titre')->titre_9.' </div>';
}
	$html .='</div>
	
</div>';
}

if(Zend_Registry::get('validation')->bool_titre_intro==1)
{
$html .='<div class="page">
	<div class="gd_titre_apercu">'.Zend_Registry::get('titre')->titre_intro.'</div>'.

Zend_Registry::get('texte')->texte_titre_intro

.'
</div>';
}

if(Zend_Registry::get('validation')->bool_titre_1==1)
{
	
$html .='<div class="page"><div class="gd_titre_apercu">1.'.Zend_Registry::get('titre')->titre_1.'</div>';

if(Zend_Registry::get('validation')->bool_titre_1_1==1)
{
$html .='<div class="sous_titre">1.1.'.Zend_Registry::get('titre')->titre_1_1.'</div><div>'.Zend_Registry::get('texte')->texte_titre_1_1.'</div><br/><br/>';
}
if(Zend_Registry::get('validation')->bool_titre_1_2==1)
{
$html .='<div class="sous_titre">1.2.'.Zend_Registry::get('titre')->titre_1_2.'</div>
	<br/><br/><table ><tr bgcolor="#F4F4FF">
      <td width="150" style="font-weight:bolder">Nom commercial</td>
      <td width="150" >'.Zend_Registry::get('resacc')->nom_commercial.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">Raison sociale</td>
      <td width="150" >'.Zend_Registry::get('resacc')->raison_sociale.'</td><td style="font-weight:bolder" width="136">
        Siret</td><td width="120"> 
         '.Zend_Registry::get('resacc')->siret.'</td></tr><tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder" >Activit&eacute; principale</td>
      <td width="150" >'.Zend_Registry::get('resacc')->activite_principale.'</td>
      <td style="font-weight:bolder">Code naf</td><td>'.Zend_Registry::get('resacc')->code_naf.'</td></tr>
	  <tr bgcolor="#FFF">
      <td style="font-weight:bolder">Date immat</td>
      <td width="150" >'.
		$dateImmat
	  .'</td>
      <td style="font-weight:bolder">Date d&eacute;but d\'activit&eacute;</td>
      <td  width="100" >'.
	  $dateDebutActivite
	
	  .'</td></tr>
	  <tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">Type d\'adresse</td>
      <td width="150">'.Zend_Registry::get('resacc')->type_adresse.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">Rue </td><td>'.Zend_Registry::get('resacc')->adresse_ligne_1.'</td><td></td><td></td></tr><tr bgcolor="#F4F4FF">
	      <td style="font-weight:bolder">Adresse ligne 2</td><td>'.Zend_Registry::get('resacc')->adresse_ligne_2.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
	        <td style="font-weight:bolder">Adressse ligne 3</td><td>'.Zend_Registry::get('resacc')->adresse_ligne_3.'</td><td></td><td></td></tr><tr bgcolor="#F4F4FF">
	        <td style="font-weight:bolder">
      Code postal</td><td>'.Zend_Registry::get('resacc')->cp.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
	          <td style="font-weight:bolder">Ville</td>
	            <td >'.Zend_Registry::get('resacc')->ville.'</td><td></td><td></td></tr><tr bgcolor="#F4F4FF">
                 <td style="font-weight:bolder">Region</td><td>'.Zend_Registry::get('resacc')->region.'</td><td></td><td></td></tr>
	        <tr bgcolor="#FFF"><td style="font-weight:bolder">Pays</td><td>'.Zend_Registry::get('resacc')->pays.'</td><td></td><td></td></tr>
			
			<tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">Dirigeant</td>
      <td width="150">'.Zend_Registry::get('resacc')->dirigeant.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">Forme juridique</td>
      <td width="150" >'.Zend_Registry::get('resacc')->forme_juridique.'</td><td></td><td></td></tr><tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">Implantation</td>
      <td width="150" >'.Zend_Registry::get('resacc')->implantation.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">Secteur d\'activit&eacute;</td>
      <td width="150" >'.Zend_Registry::get('resacc')->secteur_activite.'</td><td></td><td></td></tr>
	
	  <tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">R&eacute;gime d\'impostion</td>
      <td width="150">'.Zend_Registry::get('resacc')->regime_imposition.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">R&eacute;gime de TVA</td>
      <td width="150" >'.Zend_Registry::get('resacc')->regime_tva.'</td><td></td><td></td></tr><tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">R&eacute;gime fiscal</td>
      <td width="150">'.Zend_Registry::get('resacc')->regime_fiscal.'</td><td></td><td></td></tr><tr bgcolor="#FFF">
      <td style="font-weight:bolder">R&eacute;gime social du dirigeant</td>
      <td width="150" >'.Zend_Registry::get('resacc')->regime_social_dirigeant.'</td><td></td><td></td></tr>
	  <tr bgcolor="#F4F4FF">
      <td style="font-weight:bolder">Statut</td>
      <td width="150" >'.Zend_Registry::get('resacc')->statut.'</td><td></td><td></td></tr><tr bgcolor="#FFF"><td></td><td height="34" align="right">&nbsp;</td><td></td></tr></table>
';
}
$html .='</div>';
	}
if(Zend_Registry::get('validation')->bool_titre_2==1)
{
	$html .='
<div class="page">
<div class="gd_titre_apercu">2.'.Zend_Registry::get('titre')->titre_2.'</div> ';

	if(Zend_Registry::get('validation')->bool_titre_2_1==1)
{
	 $html .='<div class="sous_titre">2.1.'.Zend_Registry::get('titre')->titre_2_1.'</div><div>'.Zend_Registry::get('texte')->texte_titre_2_1.'</div><br/><br/>';
}
if(Zend_Registry::get('validation')->bool_titre_2_2==1)
{ 
	$html .='<div class="sous_titre">2.2.'.Zend_Registry::get('titre')->titre_2_2.'</div><div>'.Zend_Registry::get('texte')->texte_titre_2_2.'</div><br/><br/>';
}
if(Zend_Registry::get('validation')->bool_titre_2_3==1)
{ 
	 $html .='<div class="sous_titre">2.3.'.Zend_Registry::get('titre')->titre_2_3.'</div><div>'.Zend_Registry::get('texte')->texte_titre_2_3.'</div><br/><br/>';
}
$html .='</div>';	
}
if(Zend_Registry::get('validation')->bool_titre_3==1)
{ 
$html .='<div class="page">
	 <div class="gd_titre_apercu">3.'.Zend_Registry::get('titre')->titre_3.'</div> ';
if(Zend_Registry::get('validation')->bool_titre_3_1==1)
{ 
	 $html .='<div class="sous_titre">3.1.'.Zend_Registry::get('titre')->titre_3_1.'</div><br/><br/>';
	 
	 if(Zend_Registry::get('validation')->bool_titre_3_1_1==1)
{ 
	 $html .='<div class="sous_s_titre">3.1.1 '.Zend_Registry::get('titre')->titre_3_1_1.' </div>'.Zend_Registry::get('texte')->texte_titre_3_1_1.'<br/><br/>';
}
  if(Zend_Registry::get('validation')->bool_titre_3_1_2==1)
{ 
	  $html .='<div class="sous_s_titre">3.1.2 '.Zend_Registry::get('titre')->titre_3_1_2.' </div>'.Zend_Registry::get('texte')->texte_titre_3_1_2.'<br/><br/>';
}
}
 if(Zend_Registry::get('validation')->bool_titre_3_2==1)
{ 
	  $html .='<div class="sous_titre">3.2.'.Zend_Registry::get('titre')->titre_3_2.'</div><br/><br/>';
	   if(Zend_Registry::get('validation')->bool_titre_3_2_1==1)
{ 
	 $html .='<div class="sous_s_titre">3.2.1 '.Zend_Registry::get('titre')->titre_3_2_1.' </div>'.Zend_Registry::get('texte')->texte_titre_3_2_1.'<br/><br/>';
}
  if(Zend_Registry::get('validation')->bool_titre_3_2_2==1)
{ 
	  $html .='<div class="sous_s_titre">3.2.2 '.Zend_Registry::get('titre')->titre_3_2_2.' </div>'.Zend_Registry::get('texte')->texte_titre_3_2_2.'<br/><br/>';
}
  
}
if(Zend_Registry::get('validation')->bool_titre_3_1==1 and Zend_Registry::get('validation')->bool_titre_3_2==1)
{
	  $html .='</div>';
}
}

if(Zend_Registry::get('validation')->bool_titre_3_1==1 and Zend_Registry::get('validation')->bool_titre_3_2==1)
{ 
$html .='<div class="page">';
}
if(Zend_Registry::get('validation')->bool_titre_3_3==1)
{ 
	     $html .='<div class="sous_titre">3.3.'.Zend_Registry::get('titre')->titre_3_3.'</div><br/><br/>';
	 if(Zend_Registry::get('validation')->bool_titre_3_3_1==1)
{     
	 $html .='<div class="sous_s_titre">3.3.1 '.Zend_Registry::get('titre')->titre_3_3_1.' </div>'.Zend_Registry::get('texte')->texte_titre_3_3_1.'<br/><br/>';
}
	 	 if(Zend_Registry::get('validation')->bool_titre_3_3_2==1)
{ 
	$html .='<div class="sous_s_titre">3.3.2 '.Zend_Registry::get('titre')->titre_3_3_2.' </div>'.Zend_Registry::get('texte')->texte_titre_3_3_2.'<br/><br/>';
	//OUTILS Les produits concurrents
	$html .='<div class="sous_s_titre">Les produits concurrents</div><br/><br/>';
	$p = new ProduitsConcurrentsTb();
	$val = $p->getList($id_bp);
	
	$html .='<div style="padding-left:100px">';
	foreach($val as $valeur)
	{
		$html .='<div class="titre_outils">'.utf8_decode($valeur['libelle_produits_concurrents']).'</div>';
		$p_d = new ProduitsConcurrentsDetailsTb();
		$val_d = $p_d->getList($valeur['id_produits_concurrents']);
		$html .='<div style="padding-left:20px">';
		foreach($val_d as $valeur_d)
	{
	
		$html .='<br/>'.utf8_decode($valeur_d['libelle_details']).' : '.utf8_decode($valeur_d['valeur']);
	}
	$html .='<br/><br/></div>';
	}
	$html .='</div>';
	$html .='<br/><br/>';
}
	 if(Zend_Registry::get('validation')->bool_titre_3_3_3==1)
{ 
	  $html .='<div class="sous_s_titre">3.3.3 '.Zend_Registry::get('titre')->titre_3_3_3.' </div>'.Zend_Registry::get('texte')->texte_titre_3_3_3.'<br/><br/>';
	}          
	     
 if(Zend_Registry::get('validation')->bool_titre_3_4==1)
{ 
	 
	      $html .='<div class="sous_titre">3.4.'.Zend_Registry::get('titre')->titre_3_4.'</div>'.Zend_Registry::get('texte')->texte_titre_3_4.'<br/><br/>';
}

		  $html .='</div>';

}

 if(Zend_Registry::get('validation')->bool_titre_4==1)
{ 
		    $html .='<div class="page">';
		    
		$html .='<div class="gd_titre_apercu">4.'.Zend_Registry::get('titre')->titre_4.'</div>';
		   
		 if(Zend_Registry::get('validation')->bool_titre_4_1==1)
{
		 $html .='<div class="sous_titre">4.1.'.Zend_Registry::get('titre')->titre_4_1.'</div>'.Zend_Registry::get('texte')->texte_titre_4_1.'<br/><br/>';
}  
	 if(Zend_Registry::get('validation')->bool_titre_4_2==1)
{
		   $html .='<div class="sous_titre">4.2.'.Zend_Registry::get('titre')->titre_4_2.'</div><br/><br/>';
		   
	 if(Zend_Registry::get('validation')->bool_titre_4_2_1==1)
{
		   $html .='<div class="sous_s_titre">4.2.1 '.Zend_Registry::get('titre')->titre_4_2_1.' </div>'.Zend_Registry::get('texte')->texte_titre_4_2_1.'<br/><br/>';
} 
if(Zend_Registry::get('validation')->bool_titre_4_2_2==1)
{
			 $html .='<div class="sous_s_titre">4.2.2 '.Zend_Registry::get('titre')->titre_4_2_2.' </div>'.Zend_Registry::get('texte')->texte_titre_4_2_2.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_4_2_3==1)
{
			  $html .='<div class="sous_s_titre">4.2.3 '.Zend_Registry::get('titre')->titre_4_2_3.' </div>'.Zend_Registry::get('texte')->texte_titre_4_2_3.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_4_2_4==1)
{
			   $html .='<div class="sous_s_titre">4.2.4 '.Zend_Registry::get('titre')->titre_4_2_4.' </div>'.Zend_Registry::get('texte')->texte_titre_4_2_4.'<br/><br/>';
}
}

			$html .= '</div>';
		    
}
 if(Zend_Registry::get('validation')->bool_titre_4_3==1 or Zend_Registry::get('validation')->bool_titre_4_4==1)
 {
			 $html .= '<div class="page">';
	}
			    if(Zend_Registry::get('validation')->bool_titre_4_3==1)
{
	 $html .='<div class="sous_titre">4.3.'.Zend_Registry::get('titre')->titre_4_3.'</div><br/><br/>';
	  if(Zend_Registry::get('validation')->bool_titre_4_3_1==1)
{
		    $html .='<div class="sous_s_titre">4.3.1 '.Zend_Registry::get('titre')->titre_4_3_1.' </div>'.Zend_Registry::get('texte')->texte_titre_4_3_1.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_4_3_2==1)
{
			 $html .='<div class="sous_s_titre">4.3.2 '.Zend_Registry::get('titre')->titre_4_3_2.' </div>'.Zend_Registry::get('texte')->texte_titre_4_3_2.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_4_3_3==1)
{
			$html .='<div class="sous_s_titre">4.3.3 '.Zend_Registry::get('titre')->titre_4_3_3.' </div>'.Zend_Registry::get('texte')->texte_titre_4_3_3.'<br/><br/>';
}
}		
 if(Zend_Registry::get('validation')->bool_titre_4_4==1)
{  
		$html .='<div class="sous_titre">4.4.'.Zend_Registry::get('titre')->titre_4_4.'</div><br/><br/>';
		if(Zend_Registry::get('validation')->bool_titre_4_4_1==1)
{  
		   $html .='<div class="sous_s_titre">4.4.1 '.Zend_Registry::get('titre')->titre_4_4_1.' </div>'.Zend_Registry::get('texte')->texte_titre_4_4_1.'<br/><br/>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4_2==1)
{  
		$html .='<div class="sous_s_titre">4.4.2 '.Zend_Registry::get('titre')->titre_4_4_2.' </div>'.Zend_Registry::get('texte')->texte_titre_4_4_2.'<br/><br/>';
}
if(Zend_Registry::get('validation')->bool_titre_4_4_3==1)
{ 
			  $html .='<div class="sous_s_titre">4.4.3 '.Zend_Registry::get('titre')->titre_4_4_3.' </div>'.Zend_Registry::get('texte')->texte_titre_4_4_3.'<br/><br/>';
		ActionCommercialeTb::getList($GLOBALS['session']->bp->id_bp,'iso');
}
if(Zend_Registry::get('validation')->bool_titre_4_3==1 or Zend_Registry::get('validation')->bool_titre_4_4==1)
 {
	$html .='</div>';	
 }	    
}


if(Zend_Registry::get('validation')->bool_titre_5==1 or Zend_Registry::get('validation')->bool_titre_6==1 or Zend_Registry::get('validation')->bool_titre_7==1 or Zend_Registry::get('validation')->bool_titre_8==1 or Zend_Registry::get('validation')->bool_titre_9==1)
{
			    $html .='<div class="page">';
}
			    if(Zend_Registry::get('validation')->bool_titre_5==1)
{ 
			  $html .='<div class="gd_titre_apercu">5.'.Zend_Registry::get('titre')->titre_5.'</div>'.Zend_Registry::get('texte')->texte_titre_5.'<br/><br/>';
}	 
					    if(Zend_Registry::get('validation')->bool_titre_6==1)
{  
		  $html .='<div class="gd_titre_apercu">6.'.Zend_Registry::get('titre')->titre_6.'</div> '; 
 if(Zend_Registry::get('validation')->bool_titre_6_1==1)
{  
	 $html .='<div class="sous_titre">6.1.'.Zend_Registry::get('titre')->titre_6_1.'</div>'.Zend_Registry::get('texte')->texte_titre_6_1.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_6_2==1)
{ 
	  $html .='<div class="sous_titre">6.2.'.Zend_Registry::get('titre')->titre_6_2.'</div>'.Zend_Registry::get('texte')->texte_titre_6_2.'<br/><br/>';
}
 if(Zend_Registry::get('validation')->bool_titre_6_3==1)
{ 
	  $html .='<div class="sous_titre">6.3.'.Zend_Registry::get('titre')->titre_6_3.'</div>'.Zend_Registry::get('texte')->texte_titre_6_3.'<br/><br/>';
}
} 
if(Zend_Registry::get('validation')->bool_titre_5==1 or Zend_Registry::get('validation')->bool_titre_6==1 or Zend_Registry::get('validation')->bool_titre_7==1 or Zend_Registry::get('validation')->bool_titre_8==1 or Zend_Registry::get('validation')->bool_titre_9==1)
{
	 $html .='</div>';
}
	
	 if(Zend_Registry::get('validation')->bool_titre_7==1)
{
	  $html .='<div class="gd_titre_apercu">7.'.Zend_Registry::get('titre')->titre_7.'</div>
		 '.Zend_Registry::get('texte')->texte_titre_7.'<br/><br/>';
	  $val = TableauSwotTb::getText($GLOBALS['session']->bp->id_bp,'iso');
	 $html .='<div><table><tr><td width="200" class="titre_outils">Forces</td><td width="200" class="titre_outils">Faiblesses</td></tr><tr><td>'.utf8_decode($val['text_forces']).'</td><td>'.utf8_decode($val['text_faiblesses']).'</td></tr>';
	$html .='<tr><td width="200" class="titre_outils">Opportunités</td><td width="200" class="titre_outils">Menaces</td></tr><tr><td>'.utf8_decode($val['text_opportunites']).'</td><td>'.utf8_decode($val['text_menaces']).'</td></tr></table></div>';
}
	 if(Zend_Registry::get('validation')->bool_titre_8==1)
{	
		   $html .='<div class="gd_titre_apercu">8.'.Zend_Registry::get('titre')->titre_8.'</div>   
		 '.Zend_Registry::get('texte')->texte_titre_8.'<br/><br/>';
		 
}	
	 if(Zend_Registry::get('validation')->bool_titre_9==1)
{	
		     $html .='<div class="gd_titre_apercu">9.'.Zend_Registry::get('titre')->titre_9.'</div>   
		 '.Zend_Registry::get('texte')->texte_titre_9.'<br/><br/>';
}
	
	 
$html .='</div></body></html>';
		 return $html;
	
	}
	
	}

?>