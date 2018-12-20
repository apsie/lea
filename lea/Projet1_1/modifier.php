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
$valeur=$projet->return_cr3($_GET['id_resacc_cr3_edit']);

if($_GET['nature']=="produit")
{
$compte = "Produits";
$val=$valeur[0];
}
elseif($_GET['nature']=="charge")
{
$compte = "Achats";
$val=$valeur[1];
}




?>
<html><head><script language="javascript">
function voirdiv(nomdiv,nomdiv2,nomdiv3,nomdiv4,nomdiv5,nomdiv6)
		{
			
		if(document.getElementById(nomdiv).style.display=='none')
		{
			document.getElementById(nomdiv).style.display='block';
			document.getElementById(nomdiv2).style.display='none';
			document.getElementById(nomdiv3).style.display='none';
			document.getElementById(nomdiv4).style.display='none';
			document.getElementById(nomdiv5).style.display='none';
			document.getElementById(nomdiv6).style.display='none';
		}
		else
		{
				document.getElementById(nomdiv).style.display='none';
		}
		
		}
			function calcul_montant_ht(quantite,pau_ht)
		{
			var montant_ht;
			montant_ht=quantite*pau_ht;
			
			
			
		 document.getElementById('montant_ht').value=montant_ht;
		
		
		}
		function calcul_annee_suivante(a1,cfa2,cfa3)
		{
			var a2;
			var a3;
			a2=a1*cfa2;
			a3=a2*cfa3;
			
			
		 document.getElementById("div_cr_annee2").innerHTML=Math.round(a2)+' €';
		 document.getElementById("div_cr_annee3").innerHTML=Math.round(a3)+' €';
	
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
		
		function recalcul_mois(mois_modif,nb_mois,quantite_annuelle,mois1,mois2,mois3,mois4,mois5,mois6,mois7,mois8,mois9,mois10,mois11,mois12)
		{
			if(mois_modif=="m1")
			{
			//mois1=quantite_annuelle/nb_mois;
			mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m2")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m3")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m4")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
		//	mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m5")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m6")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m7")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m8")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			//mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m9")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			//mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			//mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m10")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			//mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			//mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			//mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m11")
			{
			//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			//mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			//mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			//mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			//mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			else if(mois_modif=="m12")
			{
		//mois1=quantite_annuelle/nb_mois;
			//mois2=(quantite_annuelle-mois1)/(nb_mois-1);
			//mois3=(quantite_annuelle-mois1-mois2)/(nb_mois-2);
			//mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
			//mois5=(quantite_annuelle-mois1-mois2-mois3-mois4)/(nb_mois-4);
			//mois6=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5)/(nb_mois-5);
			//mois7=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6)/(nb_mois-6);
			//mois8=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7)/(nb_mois-7);
			//mois9=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8)/(nb_mois-8);
			//mois10=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9)/(nb_mois-9);
			//mois11=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10)/(nb_mois-10);
			mois12=(quantite_annuelle-mois1-mois2-mois3-mois4-mois5-mois6-mois7-mois8-mois9-mois10-mois11)/(nb_mois-11);
			}
			
		
		document.getElementById('m1').value=mois1;
		 document.getElementById('m2').value=mois2;
		 document.getElementById('m3').value=mois3;
		 document.getElementById('m4').value=mois4;
		 document.getElementById('m5').value=mois5;
		 document.getElementById('m6').value=mois6;
		 document.getElementById('m7').value=mois7;
		 document.getElementById('m8').value=mois8;
		 document.getElementById('m9').value=mois9;
		 document.getElementById('m10').value=mois10;
		 document.getElementById('m11').value=mois11;
		 document.getElementById('m12').value=mois12;
			
		
		}
		
		function calcul_quantite_annuelle(qt_j,nb_sem,nb_mois,pvu)
		{
			var quantite_annuelle;
			var ca;
			var mois;
			var pourcent;
		
			quantite_annuelle=((qt_j*nb_sem)*4)*nb_mois;
			ca=pvu*quantite_annuelle;
			mois=quantite_annuelle/nb_mois;
			
			
			
		 document.getElementById("hidden_qt_annuelle").value=quantite_annuelle;
		 document.getElementById("div_qt_annuelle").innerHTML=quantite_annuelle;
		 document.getElementById("div_ca").innerHTML=ca+' €';
		 
		 if(nb_mois==12)
		 {
		 document.getElementById('m1').value=mois;
		 document.getElementById('m2').value=mois;
		 document.getElementById('m3').value=mois;
		 document.getElementById('m4').value=mois;
		 document.getElementById('m5').value=mois;
		 document.getElementById('m6').value=mois;
		 document.getElementById('m7').value=mois;
		 document.getElementById('m8').value=mois;
		 document.getElementById('m9').value=mois;
		 document.getElementById('m10').value=mois;
		 document.getElementById('m11').value=mois;
		 document.getElementById('m12').value=mois;
		 
		
		 
		 }
		 else if(nb_mois==11)
		 {
		 document.getElementById('m1').value=mois;
		 document.getElementById('m2').value=mois;
		 document.getElementById('m3').value=mois;
		 document.getElementById('m4').value=mois;
		 document.getElementById('m5').value=mois;
		 document.getElementById('m6').value=mois;
		 document.getElementById('m7').value='';
		 document.getElementById('m8').value=mois;
		 document.getElementById('m9').value=mois;
		 document.getElementById('m10').value=mois;
		 document.getElementById('m11').value=mois;
		 document.getElementById('m12').value=mois;
		 
		
		 }
		 else if(nb_mois==10)
		 {
		 document.getElementById('m1').value=mois;
		 document.getElementById('m2').value=mois;
		 document.getElementById('m3').value=mois;
		 document.getElementById('m4').value=mois;
		 document.getElementById('m5').value=mois;
		 document.getElementById('m6').value='';
		 document.getElementById('m7').value='';
		 document.getElementById('m8').value=mois;
		 document.getElementById('m9').value=mois;
		 document.getElementById('m10').value=mois;
		 document.getElementById('m11').value=mois;
		 document.getElementById('m12').value=mois;
	
		 }
		
		}
		
	
		
		
		  
        </script>
        </head><body>
<center>
  <h2>Modification ( <?php echo $_GET['nature']; ?> )</h2></center> <center> <br/><br/><form method="get"><input type="hidden" name="domain" value="default" /><table style="border:1px solid #CCC"  ><tr style="font-weight:bold; background-color: #999; color:#FFF" >
       
        <td>Compte <?php echo $compte; ?></td>
        <td  >Vent</td>
        <td  >Evo</td>
        <td  >Cf An2</td>
        <td  >Cf An3</td>
        <td  >Tva</td>
        <td  >D&eacute;lai jrs</td>
        <td  >Part D&eacute;lai</td>
       
        
          <td  >Annee 1</td><td  >Annee 2</td><td  >Annee 3</td> <td></td></tr><tr valign="bottom" style="text-align:left;border:1px solid #CCC" bgcolor='#ECF3F4'>
        <td>
         <select style=" width:150px" name="entree_sortiee"><option><?php echo $val; ?></option> 
      <?php  
	  
	  if($_GET['nature']=="produit")
	  {
	  echo $projet->texte('Entrees Exploitation','','egw_texte_financement');
	  }
	     elseif($_GET['nature']=="charge")
	  {
	  echo $projet->texte('Sorties Exploitation','','egw_texte_financement');
	  }
	  ?>
        </select> </td>
        <td><select name="vent">
          <option value="<?php echo $valeur[10]; ?>" ><?php echo $valeur[10]; ?></option>
          <option >Fix</option>
          <option >Var</option>
        </select></td>
        <td><select name="evo">
          <option value="<?php echo $valeur[11]; ?>"><?php echo $valeur[11]; ?></option>
          <option >Const</option>
          <option >Prop</option>
        </select></td>
        <td><input onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,this.value,document.getElementById('cf_a3').value);" style=" width:25px" id="cf_a2" name="cf_a2"  type="text" value="<?php echo $valeur[5]; ?>" /></td>
        <td><input style=" width:25px" id="cf_a3" name="cf_a3" onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,document.getElementById('cf_a2').value,this.value);" type="text" value="<?php echo $valeur[6]; ?>" /></td>
        <td><select name="tva">
         <option  value="<?php echo $valeur[7]; ?>"><?php echo $valeur[7]; ?> %</option><option value="0">0%</option>
          <option value="5.5">5,5%</option>
          <option value="10.0">10,0%</option>
          <option value="20.0">20,0%</option>
        </select></td>
        <td><select name="delai">
         
          <option value="<?php echo $valeur[8]; ?>"><?php echo $valeur[8]; ?></option>
          <option>0</option>
          <option >7</option>
          <option >10</option>
          <option >15</option>
          <option selected='selected' >30</option>
          <option >45</option>
          <option >60</option>
          <option >90</option>
          <option >120</option>
          <option >240</option>
          <option >360</option>
        </select></td>
        <td><input size="2" name="part_delai" value="<?php echo $valeur[9]; ?>"  type="text" />
          %</td>
   <td><input value="<?php echo $valeur[2]; ?>" size="2" name="cr_annee1" id="cr_annee1" type="text" onChange="calcul_annee_suivante(this.value,document.getElementById('cf_a2').value,document.getElementById('cf_a3').value);"/></td><td><div id="div_cr_annee2"><?php echo $valeur[3]; ?> €</div></td><td><div id="div_cr_annee3"><?php echo $valeur[4]; ?> €</div></td>
   <td><input type="hidden" name="id_resacc_cr3_edit" value="<?php echo $_GET['id_resacc_cr3_edit']; ?>" /><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet']; ?>" /><input type="hidden" name="nature" value="<?php echo $_GET['nature']; ?>" /><input name="modifier_cr3" type="submit" value="Modifier" /></td></tr></table><br/></form></center>
   <?php
if(isset($_GET['modifier_cr3']))
{
	$projet->modifier_cr3($GLOBALS['egw_info']['user']['account_id'],$_GET['id_resacc_cr3_edit'],$_GET['nature'],$_GET['entree_sortiee'],$_GET['cr_annee1'],$_GET['cr_annee1']*$_GET['cf_a2'],$_GET['cr_annee1']*$_GET['cf_a2']*$_GET['cf_a3'],$_GET['cf_a2'],$_GET['cf_a3'],$_GET['tva'],$_GET['delai'],$_GET['part_delai'],$_GET['vent'],$_GET['evo']);
	/*echo '<script>window.parent.opener.location.reload()</script>';*/
	echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet='.$_GET['nature'].'";</script>';
	echo'<script>window.close();</script>';

}


echo $GLOBALS['egw']->common->egw_footer();
?>
        </body></html>