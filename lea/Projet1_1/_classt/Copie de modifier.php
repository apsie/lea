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
$valeur=$projet->return_produit($_GET['id_resacc_pro_edit']);

if($valeur[0]=='annee1')
{
$valeur_[0]="A1";
}
elseif($valeur[0]=='annee2')
{
$valeur_[0]="A2";
}
elseif($valeur[0]=='annee3')
{
$valeur_[0]="A3";
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
<center><h2>Modification du produit</h2></center><br><div  style="display:block;"id="produit"><form method="get"><input type="hidden" name="domain" value="default" /><table style="border:1px solid #CCC"  ><tr style="font-weight:bold; background-color: #999; color:#FFF" >
        <td>D&eacute;signation</td>
        <td>Compte Achats</td>
        <td>Compte Produits</td>
        <input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet']; ?>" />
          <td>PVU HT</td>
          <td  >Qt&eacute; J</td>
          <td >Jr/sem</td>
          <td >Mois/an</td>
          <td  >Qt an</td>
          <td  >M1</td>
          <td  >M2</td>
          <td  >M3</td>
          <td  >M4</td>
          <td  >M5</td>
          <td  >M6</td>
          <td  >M7</td>
          <td  >M8</td>
          <td  >M9</td>
          <td  >M10</td>
          <td  >M11</td>
          <td  >M12</td>
          <td  >CA</td> <td></td></tr><tr valign="bottom" style="text-align:left;border:1px solid #CCC" bgcolor='#ECF3F4'>
         
        <td><select name="exercice" style="width:40px;"><option value="<?php  echo $valeur[0];?>"><?php  echo $valeur_[0];?></option><option value="annee1">A1</option><option value="annee2">A2</option><option value="annee3">A3</option></select><input  name="designation"  value="<?php  echo $valeur[1];?>" size="7" type="text"/></td>
        <td><select style=" width:150px" name="compte_achats"><option value="<?php  echo $valeur[2];?>"><?php  echo $valeur[2];?></option>
          <?php $projet->texte('Sorties Exploitation','','egw_texte_financement');?>
        </select></td>
        <td><select style=" width:150px" name="compte_produits"><option value="<?php  echo $valeur[3];?>"><?php  echo $valeur[3];?></option>
          <?php $projet->texte('Entrees Exploitation','','egw_texte_financement');?>
        </select></td>
        <td><input id='pvu' onChange="calcul_quantite_annuelle(document.getElementById('qt_j').value,document.getElementById('nb_sem').value,document.getElementById('nb_mois').value,document.getElementById('pvu').value);" name='pvu' value="<?php  echo $valeur[5];?>" size="4" type="text"/></td><td><input value="<?php  echo $valeur[4];?>" id="qt_j" name="qt_j" onChange="calcul_quantite_annuelle(this.value,document.getElementById('nb_sem').value,document.getElementById('nb_mois').value,document.getElementById('pvu').value);" size="1" type="text" /></td>
   <td ><select onChange="calcul_quantite_annuelle(document.getElementById('qt_j').value,this.value,document.getElementById('nb_mois').value,document.getElementById('pvu').value);" id="nb_sem" name="nb_sem" /><option value="<?php  echo $valeur[6];?>"><?php  echo $valeur[6];?></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option></select></td><td><select onChange="calcul_quantite_annuelle(document.getElementById('qt_j').value,document.getElementById('nb_sem').value,this.value,document.getElementById('pvu').value);" id="nb_mois" name="nb_mois" /><option value="<?php  echo $valeur[7];?>"><?php  echo $valeur[7];?></option><option >12</option></select></td>
   <td><input type="hidden" id="hidden_qt_annuelle" name="hidden_qt_annuelle" value="<?php  echo round($valeur[8],0);?>"   /><div id="div_qt_annuelle"><?php  echo round($valeur[8],0);?></div></td>
   <td><input onChange="recalcul_mois('m1',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m1' id='m1' size="1" value="<?php  echo $valeur[9];?>"type="text"/></td>
   <td><input onChange="recalcul_mois('m2',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,this.value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m2' id='m2' size="1" value="<?php  echo $valeur[10];?>" type="text"/></td>
   <td><input onChange="recalcul_mois('m3',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,this.value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);"  name='m3' id='m3' size="1" value="<?php  echo $valeur[11];?>" type="text"/></td>
   <td><input onChange="recalcul_mois('m4',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,this.value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m4' id='m4' size="1" value="<?php  echo $valeur[12];?>" type="text"/></td>
   <td><input onChange="recalcul_mois('m5',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,this.value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m5' id='m5' size="1" value="<?php  echo $valeur[13];?>" type="text"/></td>
   <td><input onChange="recalcul_mois('m6',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m6' value="<?php  echo $valeur[14];?>" id='m6' size="1" type="text"/></td>
   <td><input onChange="recalcul_mois('m7',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m7' value="<?php  echo $valeur[15];?>" id='m7' size="1" type="text"/></td>
   <td><input onChange="recalcul_mois('m8',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m8' value="<?php  echo $valeur[16];?>" id='m8' size="1" type="text"/></td>
   <td><input onChange="recalcul_mois('m9',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m9' id='m9' value="<?php  echo $valeur[17];?>" size="1" type="text"/></td>
   <td><input onChange="recalcul_mois('m10',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m10' id='m10' value="<?php  echo $valeur[18];?>" size="1" type="text"/></td>
   <td><input onChange="recalcul_mois('m11',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m11' id='m11' size="1" value="<?php  echo $valeur[19];?>" type="text"/></td>
   <td><input onChange="recalcul_mois('m12',document.getElementById('nb_mois').value,document.getElementById('hidden_qt_annuelle').value,document.getElementById('m1').value,document.getElementById('m2').value,document.getElementById('m3').value,document.getElementById('m4').value,document.getElementById('m5').value,document.getElementById('m6').value,document.getElementById('m7').value,document.getElementById('m8').value,document.getElementById('m9').value,document.getElementById('m10').value,document.getElementById('m11').value,document.getElementById('m12').value);" name='m12' id='m12' size="1" value="<?php  echo $valeur[20];?>"type="text"/></td>
   <td><div id="div_ca"><?php  echo round($valeur[21],0);?>€</div></td>
   <td><input type="hidden" name="id_resacc" value="<?php echo $_GET['id_resacc'] ;?> "/><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet'] ;?> "/><input type="hidden" name="id_resacc_pro_edit" value="<?php echo $_GET['id_resacc_pro_edit'] ;?> "/><input name="modifier_produit" type="submit" value="Modifier" /></td></tr></table></form></div></center>
<?php
if(isset($_GET['modifier_produit']))
{
	$projet->modifier_produit($GLOBALS['egw_info']['user']['account_id'],$_GET['id_resacc'],$_GET['id_resacc_pro_edit'],$_GET['exercice'],$_GET['designation'],$_GET['compte_produits'],$_GET['compte_achats'],$_GET['pvu'],$_GET['qt_j'],$_GET['nb_sem'],$_GET['nb_mois'],$_GET['m1'],$_GET['m2'],$_GET['m3'],$_GET['m4'],$_GET['m5'],$_GET['m6'],$_GET['m7'],$_GET['m8'],$_GET['m9'],$_GET['m10'],$_GET['m11'],$_GET['m12']);
	/*echo '<script>window.parent.opener.location.reload()</script>';*/
	echo'<script>window.parent.opener.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=produit";</script>';
	echo'<script>window.close();</script>';

}


echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>