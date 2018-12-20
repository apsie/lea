<?php
    
/**
*   APSIE - base de données Lea
*
*   Code revu par :
*   SPIREA- 16/20 avenue de l'agent Sarre
*   Tél : 0141192772
*   Email : contact@spirea.fr
*   www : www.spirea.fr
*
*   Reproduction, utilisation ou modification interdite sans autorisation
*/

/**
* Page detail.php
*
* Appelé depuis : Module Projet
* Traitement :
* Rendu : pages avec différents onglets chargés par ajax...
* Fonctions ou écrans suivants :
*/

    
    include("../../Classes/config/config_egw_version.php");
    $GLOBALS['egw_info'] = array(
        'flags' => array(
            'noheader'                => false,
            'nonavbar'                => false,
            'currentapp'              => 'Projet1_1',
            'enable_network_class'    => false,
            'enable_contacts_class'   => false,
            'enable_nextmatchs_class' => false
        )
    );

    include('../header.inc.php');
    // echo getcwd();
    include("inc/class.projet.inc.php");
    
    $projet = new projet();
    $val_projet=$projet->get_projet($_GET['id_projet']);

    if ($val_projet[5]!=0) {
        $val_projet[5] = date("d/m/Y", $val_projet[5]);
    } else {
        $val_projet[5]=null;
    }
    if ($val_projet[6]!=0) {
        $val_projet[6] = date("d/m/Y", $val_projet[6]);
    } else {
        $val_projet[6]=null;
    }
    if ($val_projet[7]!=0) {
        $val_projet[7] = date("d/m/Y", $val_projet[7]);
    } else {
        $val_projet[7]=null;
    }

    $retour_org_ben=$projet->return_org_ben($_GET['id_projet']);


?>
<html><head><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>   
<script type="text/javascript" src="js/jquery-1.2.1.pack.js"></script>

<script type="text/javascript" src="js/liste_aide.js"></script></head>
<style>	

    .suggestionsBox {
        position:absolute;
        
        left: 550px;
        margin: 10px 0px 0px 0px;
        width: 500px;
        
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #000; 
        color: #fff;
        background-color: #000;
        z-index:10;
        font-size:9px;
        
    }
    
    .suggestionList {
        margin: 0px;
        padding: 0px;
    }
    
    .suggestionList li {
        
        margin: 0px 0px 3px 0px;
        padding: 3px;
        cursor: pointer;
    }
    
    .suggestionList li:hover {
        background-color: #8B1B23;  
    }
	.suggestionsBox1 {
        position:absolute;
        
        left: 30px;
        margin: 10px 0px 0px 0px;
        width: 300px;
        background-color: #E0DB0C;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #000; 
        color: #fff;
        background-color: #000;
        z-index:10;
        font-size:9px;
        
    }

-->
</style>
<script language="javascript">
function voirdiv(nomdiv,nomdiv2,nomdiv3,nomdiv4,nomdiv5,nomdiv6,nomdiv7)
        {
            
        if(document.getElementById(nomdiv).style.display=='none')
        {
            document.getElementById(nomdiv).style.display='block';
            document.getElementById(nomdiv2).style.display='none';
            document.getElementById(nomdiv3).style.display='none';
            document.getElementById(nomdiv4).style.display='none';
            document.getElementById(nomdiv5).style.display='none';
            document.getElementById(nomdiv6).style.display='none';
            document.getElementById(nomdiv7).style.display='none';
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
        function remun_an(nb_mois,remun_mens,statut)
        {
            var remun_an;
        
            remun_an=nb_mois*remun_mens;
            
            
            
         document.getElementById("div_remun_an_brut").innerHTML=remun_an+' €';
         if(statut=="Non salarié")
         {
           document.getElementById("div_charges_ts").innerHTML=null;
           document.getElementById("div_charges_tns").innerHTML=remun_an*0.45+' €';
           document.getElementById("div_remun_an").innerHTML=(remun_an*0.45)+(remun_an) +' €';
           document.getElementById("div_salaire_net").innerHTML=remun_an +' €';
         }
         else if(statut=="Salarié")
         {
              document.getElementById("div_charges_tns").innerHTML=null;
              document.getElementById("div_charges_ts").innerHTML=remun_an*0.5+' €';
              document.getElementById("div_remun_an").innerHTML=(remun_an*0.5)+(remun_an) +' €';
              document.getElementById("div_salaire_net").innerHTML=remun_an*0.78 +' €';
             }
        
        
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
        
        function calcul_annee_suivante(a1,cfa2,cfa3)
        {
            var a2;
            var a3;
            a2=a1*cfa2;
            a3=a2*cfa3;
            
            
         document.getElementById("div_cr_annee2").innerHTML=Math.round(a2)+' €';
         document.getElementById("div_cr_annee3").innerHTML=Math.round(a3)+' €';
            
         document.getElementById("div_cr_annee2_c").innerHTML=Math.round(a2)+' €';
         document.getElementById("div_cr_annee3_c").innerHTML=Math.round(a3)+' €';
         
    
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
        //  mois4=(quantite_annuelle-mois1-mois2-mois3)/(nb_mois-3);
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
        
        
        
        function return_ressource(selectId)
        {
            
        
    /**On récupère l'élement html <select>*/
    var selectElmt = document.getElementById(selectId);
    
    /**
    selectElmt.options correspond au tableau des balises <option> du select
    selectElmt.selectedIndex correspond à l'index du tableau options qui est actuellement sélectionné
    */
    //document.getElementById('montant_ressource').value=selectElmt.options[selectElmt.selectedIndex].value;
    if(selectElmt.options[selectElmt.selectedIndex].value==114)
    {
    document.getElementById('intitule_compte_ressource').options[0].text="Aide à la reprise fds artisanal (Région)";
    document.getElementById('intitule_compte_ressource').options[1].text="Subventions investissement 1";
    document.getElementById('intitule_compte_ressource').options[2].text="Subventions investissement 2";
    document.getElementById('intitule_compte_ressource').options[3].text="Contrat Devlpt Trans°/Créat° OSEO";
    document.getElementById('intitule_compte_ressource').options[4].text="";
    document.getElementById('intitule_compte_ressource').options[5].text="";
    document.getElementById('intitule_compte_ressource').options[6].text="";
    document.getElementById('intitule_compte_ressource').options[7].text="";
    document.getElementById('intitule_compte_ressource').options[8].text="";
    document.getElementById('intitule_compte_ressource').options[9].text="";
    document.getElementById('intitule_compte_ressource').options[10].text="";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==111)
    {
    document.getElementById('intitule_compte_ressource').options[0].text="Capital numéraire Créateur";
    document.getElementById('intitule_compte_ressource').options[1].text="Capital en nature Créateur";
    document.getElementById('intitule_compte_ressource').options[2].text="Capital en industrie Créateur";
    document.getElementById('intitule_compte_ressource').options[3].text="Capital numéraire Associés";
    document.getElementById('intitule_compte_ressource').options[4].text="Capital en nature Associés";
    document.getElementById('intitule_compte_ressource').options[5].text="Capital en industrie Associés";
    document.getElementById('intitule_compte_ressource').options[6].text="";
    document.getElementById('intitule_compte_ressource').options[7].text="";
    document.getElementById('intitule_compte_ressource').options[8].text="";
    document.getElementById('intitule_compte_ressource').options[9].text="";
    document.getElementById('intitule_compte_ressource').options[10].text="";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==112)
    {
    document.getElementById('intitule_compte_ressource').options[0].text="Compte courant Créateur";
    document.getElementById('intitule_compte_ressource').options[1].text="Compte courant Associés";
    document.getElementById('intitule_compte_ressource').options[2].text="";
    document.getElementById('intitule_compte_ressource').options[3].text="";
    document.getElementById('intitule_compte_ressource').options[4].text="";
    document.getElementById('intitule_compte_ressource').options[5].text="";
    document.getElementById('intitule_compte_ressource').options[6].text="";
    document.getElementById('intitule_compte_ressource').options[7].text="";
    document.getElementById('intitule_compte_ressource').options[8].text="";
    document.getElementById('intitule_compte_ressource').options[9].text="";
    document.getElementById('intitule_compte_ressource').options[10].text="";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==113)
    {
    document.getElementById('intitule_compte_ressource').options[0].text="Prêt d'honneur - PFIL";
    document.getElementById('intitule_compte_ressource').options[1].text="Prêt NACRE";
    document.getElementById('intitule_compte_ressource').options[2].text="Emprunt bancaire";
    document.getElementById('intitule_compte_ressource').options[3].text="Emprunt PCE - OSEO";
    document.getElementById('intitule_compte_ressource').options[4].text="Crédit-vendeur";
    document.getElementById('intitule_compte_ressource').options[5].text="Emprunt solidaire - ADIE";
    document.getElementById('intitule_compte_ressource').options[6].text="Prêt d'honneur - ADIE";
    document.getElementById('intitule_compte_ressource').options[7].text="Autres emprunts";
    document.getElementById('intitule_compte_ressource').options[8].text="Escompte ou affacturage";
    document.getElementById('intitule_compte_ressource').options[9].text="Decouvert autorisé";
    document.getElementById('intitule_compte_ressource').options[10].text="Prêt relais de TVA sur immobilisations";
    }

    
}
        
        
    function return_immo(selectId)  {
        
    /**On récupère l'élement html <select>*/
    var selectElmt = document.getElementById(selectId);
    
    /**
    selectElmt.options correspond au tableau des balises <option> du select
    selectElmt.selectedIndex correspond à l'index du tableau options qui est actuellement sélectionné
    */
    //document.getElementById('pau_ht').value=selectElmt.options[selectElmt.selectedIndex].value;
	alert(selectElmt.options[selectElmt.selectedIndex].value);
    if(selectElmt.options[selectElmt.selectedIndex].value==110)
    {
        document.getElementById('intitule_compte').options[0].text="Stock de depart";
        document.getElementById('intitule_compte').options[1].text="Besoin en fonds de roulement (dont tréso au démarr.)";
        document.getElementById('intitule_compte').options[2].text="";
        document.getElementById('intitule_compte').options[3].text="";
        document.getElementById('intitule_compte').options[4].text="";
        document.getElementById('intitule_compte').options[5].text="";
        document.getElementById('intitule_compte').options[6].text="";
        document.getElementById('intitule_compte').options[7].text="";
        document.getElementById('intitule_compte').options[8].text="";
        document.getElementById('intitule_compte').options[9].text="";
        document.getElementById('intitule_compte').options[10].text="";
        document.getElementById('intitule_compte').options[11].text="";
        document.getElementById('intitule_compte').options[12].text="";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==108)
    {
        document.getElementById('intitule_compte').options[0].text="Fonds commerce (corporel)";
        document.getElementById('intitule_compte').options[1].text="Terrain";
        document.getElementById('intitule_compte').options[2].text="Matériel et outillage";
        document.getElementById('intitule_compte').options[3].text="Installation technique, aménagement";
        document.getElementById('intitule_compte').options[4].text="Matériel de transport";
        document.getElementById('intitule_compte').options[5].text="Matériel bureautique, informatique";
        document.getElementById('intitule_compte').options[6].text="Mobilier";
        document.getElementById('intitule_compte').options[7].text="Autre (préciser)";
        document.getElementById('intitule_compte').options[8].text="";
        document.getElementById('intitule_compte').options[9].text="";
        document.getElementById('intitule_compte').options[10].text="";
        document.getElementById('intitule_compte').options[11].text="";
        document.getElementById('intitule_compte').options[12].text="";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==107)
    {
        document.getElementById('intitule_compte').options[0].text="Frais d'établissement";
        document.getElementById('intitule_compte').options[1].text="Concession, brevet, marque, licences, logiciels";
        document.getElementById('intitule_compte').options[2].text="Droit de mutation";
        document.getElementById('intitule_compte').options[3].text="Honoraires";
        document.getElementById('intitule_compte').options[4].text="Frais dossier banque+ frais garantie FAG ou FGIF";
        document.getElementById('intitule_compte').options[5].text="Droits au bail - Pas de porte";
        document.getElementById('intitule_compte').options[6].text="Fonds commerce (incorporel)";
        document.getElementById('intitule_compte').options[7].text="Licence IV";
        document.getElementById('intitule_compte').options[8].text="Frais d'agence immobilière";
        document.getElementById('intitule_compte').options[9].text="Publicité de Démarrage";
        document.getElementById('intitule_compte').options[10].text="1er loyer crédit bail 1 HT";
        document.getElementById('intitule_compte').options[11].text="1er loyer crédit bail 2 HT";
        document.getElementById('intitule_compte').options[12].text="Frais soutien commercial";
    }
    else if(selectElmt.options[selectElmt.selectedIndex].value==109)
    {
        document.getElementById('intitule_compte').options[0].text="Participations";
        document.getElementById('intitule_compte').options[1].text="Dépôt de garantie, Caution";
        document.getElementById('intitule_compte').options[2].text="Caution bancaire (fonds bloqué)";
        document.getElementById('intitule_compte').options[3].text="Autres titres immobilisés";
        document.getElementById('intitule_compte').options[4].text="";
        document.getElementById('intitule_compte').options[5].text="";
        document.getElementById('intitule_compte').options[6].text="";
        document.getElementById('intitule_compte').options[7].text="";
        document.getElementById('intitule_compte').options[8].text="";
        document.getElementById('intitule_compte').options[9].text="";
        document.getElementById('intitule_compte').options[10].text="";
        document.getElementById('intitule_compte').options[11].text="";
        document.getElementById('intitule_compte').options[12].text="";

    }
    
    else if(selectElmt.options[selectElmt.selectedIndex].value==189)
    {
        document.getElementById('intitule_compte').options[0].text="Compte courant Créateur";
        document.getElementById('intitule_compte').options[1].text="Compte courant Associés";
        document.getElementById('intitule_compte').options[2].text="Prêt d'honneur - PFIL";
        document.getElementById('intitule_compte').options[3].text="Prêt NACRE";
        document.getElementById('intitule_compte').options[4].text="Emprunt bancaire";
        document.getElementById('intitule_compte').options[5].text="Emprunt PCE - OSEO";
        document.getElementById('intitule_compte').options[6].text="Crédit-vendeur";
        document.getElementById('intitule_compte').options[7].text="Emprunt solidaire - ADIE";
        document.getElementById('intitule_compte').options[8].text="Prêt d'honneur - ADIE";
        document.getElementById('intitule_compte').options[9].text="Autres emprunts";
        document.getElementById('intitule_compte').options[10].text="";
        document.getElementById('intitule_compte').options[11].text="";
        document.getElementById('intitule_compte').options[12].text="";
    }



    
}
        
        
    function lookup_naf(inputString) {
        if(inputString.length == 0) {
            // Hide the suggestion box.
            $('#suggestions_naf').show();
        } else {
            $.post("liste_aide_code_naf.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions_naf').show();
                    $('#autoSuggestionsList_naf').html(data);
                }
            });
        }
    } // l
    
    function fill_naf(code_naf, intitule_naf) {
        $('#code_naf').val(code_naf);
        $('#activite_principale').val(intitule_naf);
        setTimeout("$('#suggestions_naf').hide();", 200);
    }
          
        </script>
        
   
   </head><body>
<table bgcolor="#ebe8e4" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>


            <td width="1313">
                <center><input value="Retour" onClick="window.location.href='index.php?domain=default'" type="button"></center>
            </td>

        </tr>

    </tbody>
</table>
<center>
    <h2>PROJET :
        <?php echo utf8_encode($val_projet[0]); ?>
    </h2>
</center>
<div>
    <table style="border:1px solid #CCC">
        <tr>
            <td bgcolor="#EBF2FE"><a href="javascript:voirdiv('projet','projet_creation','investissement','financement','charge','produit','effectif');">Le projet</a>                </td>
            <td>|</td>
            <td> <a href="javascript:voirdiv('projet_creation','projet','investissement','financement','charge','produit','effectif');">Information sur l'organisation</a></td>
            <td>|</td>
            <td> <a href="javascript:voirdiv('investissement','projet','projet_creation','financement','charge','produit','effectif');">Investissement</a></td>
            <td>|</td>
            <td> <a href="javascript:voirdiv('financement','investissement','projet','projet_creation','charge','produit','effectif');">Financement</a></td>
            <td>|</td>
            <td> <a href="javascript:voirdiv('charge','financement','investissement','projet','projet_creation','produit','effectif');">Charges</a></td>
            <td>|</td>
            <td><a href="javascript:voirdiv('produit','projet_creation','financement','investissement','projet','charge','effectif');">Produits</a></td>
            <td>|</td>
            <td><a href="javascript:voirdiv('effectif','produit','projet_creation','financement','investissement','projet','charge');">Effectifs</a></td>
        </tr>
    </table>
    <div id="projet">
        <form method="post">
            <table style="border:1px solid #CCC">
                <tr bgcolor='#ECF3F4'><input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet'] ;?>" />
                    <td width="300">Intitulé du projet</td>
                    <td width="818">
                        <?php echo utf8_encode($val_projet[0]); ?>
                    </td>
                    <td width="172"></td>
                </tr>
                <tr bgcolor='#FFF'>
                    <td>Date de début</td>
                    <td>
                        <?php echo $val_projet[5]; ?>
                    </td>
                    <td></td>
                </tr>
                <tr bgcolor='#ECF3F4'>
                    <td>Date de fin prévisionnelle</td>
                    <td><input id="date_fin_pre_projet" name="date_fin_pre_projet" type="text" value="<?php echo $val_projet[7]; ?>">
                        <script type="text/javascript">
                            document.writeln(
                                '<img id="date_fin_pre_projet-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>'
                            );
                            Calendar.setup({
                                inputField: "date_fin_pre_projet",
                                button: "date_fin_pre_projet-trigger"
                            });
                        </script>
                    </td>
                    <td></td>
                </tr>
                <tr bgcolor='#FFF'>
                    <td>Date de fin réelle</td>
                    <td><input id="date_fin_projet" name="date_fin_projet" type="text" value="<?php echo $val_projet[6]; ?>">
                        <script type="text/javascript">
                            document.writeln(
                                '<img id="date_fin_projet-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>'
                            );
                            Calendar.setup({
                                inputField: "date_fin_projet",
                                button: "date_fin_projet-trigger"
                            });
                        </script>
                    </td>
                    <td></td>
                </tr>
                <tr bgcolor='#ECF3F4'>
                    <td>Coordinateur</td>
                    <td>
                        <?php $projet->selectionner_conseiller3($val_projet[1]) ?>
                    </td>
                    <td></td>
                </tr>
                <tr bgcolor='#FFF'>
                    <td>Description du projet</td>
                    <td><textarea name="description_projet" style="font-size:11px; border:1px solid #CCC; color: #069;" rows="5"
                            cols="100"><?php echo $val_projet[2]; ?></textarea></td>
                    <td></td>
                </tr>
                <tr bgcolor='#ECF3F4'>
                    <td>Statut</td>
                    <td><select name="statut_projet"><option><?php echo $val_projet[3]; ?></option><option>Abandon</option><option>Complet</option><option>En cours</option><option>Suspendu</option></select></td>
                    <td></td>
                </tr>
                <tr bgcolor='#FFF'>
                    <td>Résultat</td>
                    <td><select name="resultat_projet"><option><?php echo $val_projet[4]; ?></option><option>En attente de résultat</option><option>Entreprise Créée</option><option>Retour a l'emploi</option></select></td>
                    <td></td>
                </tr>
                <tr bgcolor='#ECF3F4'>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="enregistrer_projet" value="Enregistrer" /></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
    </div>

    <div style="display:none" id="projet_creation">
        <form method="get"> <input type="hidden" value="default" name="domain" /><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet']; ?>"
            />
            <table style="border:1px solid #CCC" width="1181">
                <tr bgcolor="#EBF2FE">
                    <td width="193">Nom commercial</td>
                    <td width="302"><input size="50" type="text" name="nom_commercial" value="<?php echo $retour_org_ben[0]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Raison social</td>
                    <td width="302"><input size="50" type="text" name="raison_sociale" value="<?php echo $retour_org_ben[1]; ?>" /> </td>
                    <td
                        width="136">
                        Siret</td>
                        <td>
                            <input type="text" value="<?php echo $retour_org_ben[14]; ?>" name="siret" /> </td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Activité principale</td>
                    <td width="302"><input size="50" type="text" name="activite_principale" id="activite_principale" value="<?php echo $retour_org_ben[2]; ?>" /></td>
                    <td>Code naf</td>
                    <td><input onKeyUp="lookup_naf(this.value);" name="code_naf" id="code_naf" type="text"
                            value="<?php echo $retour_org_ben[23]; ?>" />
                        <div class="suggestionsBox" id="suggestions_naf" style="display: none;">
                        <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="autoSuggestionsList_naf"> &nbsp; </div>
                        </div>
                    </td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Date immat</td>
                    <td width="302"><input name="date_immat" type="text" value="<?php if ($retour_org_ben[11]!=0) {
            echo date(" d/m/Y ", $retour_org_ben[11]);
} ?>" id="date_immat" />
                        <script type="text/javascript">
                            document.writeln(
                                '<img id="date_immat-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>'
                            );
                            Calendar.setup({
                                inputField: "date_immat",
                                button: "date_immat-trigger"
                            });
                        </script>
                    </td>
                    <td>Date début d'activité</td>
                    <td width="530"><input name="date_debut_activite" type="text" value="<?php if ($retour_org_ben[12]!=0) {
            echo date(" d/m/Y ", $retour_org_ben[12]);
} ?>" id="date_debut_activite" />
                        <script type="text/javascript">
                            document.writeln(
                                '<img id="date_debut_activite-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>'
                            );
                            Calendar.setup({
                                inputField: "date_debut_activite",
                                button: "date_debut_activite-trigger"
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <hr />
                    </td>
                    <td width="302">
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Type d'adresse</td>
                    <td width="302"><select name="type_adresse" style="width:160px"><option value="<?php echo  $retour_org_ben[3]; ?>"><?php echo  $retour_org_ben[3]; ?></option><?php $projet->texte('type_adresse');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Rue </td>
                    <td> <input size="50" name="adresse_ligne_1" type="text" value="<?php echo  $retour_org_ben[4]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Adresse ligne 2</td>
                    <td><input name="adresse_ligne_2" size="50" type="text" value="<?php echo $retour_org_ben[5]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Adressse ligne 3</td>
                    <td><input name="adresse_ligne_3" size="50" type="text" value="<?php echo  $retour_org_ben[6]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>
                        <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
                        </div>Code postal</td>
                    <td><input onBlur="fill();" autocomplete="off" id="cp" onKeyUp="lookup(this.value,'cp');" name="cp" type="text"
                            value="<?php echo $retour_org_ben[7]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Ville</td>
                    <td><input type="text" id="ville" name="ville" value="<?php echo $retour_org_ben[8]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Region</td>
                    <td><input name="region" id="region" type="text" value="<?php echo $retour_org_ben[9]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Pays</td>
                    <td><input name="pays" id="pays" type="text" value="<?php echo $retour_org_ben[10]; ?>" /></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Dirigeant</td>
                    <td width="302" style="font-weight:bolder"><select name="dirigeant" style="width:160px"><option value="<?php echo  $retour_org_ben[16]; ?>" ><?php echo $retour_org_ben[16]; ?></option><option value="Le beneficiaire">Le beneficiaire</option> <option value="L'Associe">L'Associe</option></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Forme juridique</td>
                    <td width="302" style="font-weight:bolder"><select name="forme_juridique" style="width:160px"><option value="<?php echo $retour_org_ben[13]; ?>" ><?php echo $retour_org_ben[13]; ?></option><?php $projet->texte('forme_juridique');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Implantation</td>
                    <td width="302" style="font-weight:bolder"><select name="implantation" style="width:160px"><option value="<?php echo  $retour_org_ben[17]; ?>"><?php echo $retour_org_ben[17]; ?></option><?php $projet->texte('Implantation');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Secteur d'activité</td>
                    <td width="302" style="font-weight:bolder"><select name="secteur_activite"><option value="<?php echo $retour_org_ben[15]; ?>"><?php echo $retour_org_ben[15]; ?></option><?php $projet->texte('secteur_activite');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Régime d'impostion</td>
                    <td width="302" style="font-weight:bolder"><select name="regime_imposition" style="width:160px"><option value="<?php echo  $retour_org_ben[18]; ?>"><?php echo $retour_org_ben[18]; ?><?php $projet->texte('Regime_imposition');?></option></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#FFF">
                    <td>Régime de TVA</td>
                    <td width="302" style="font-weight:bolder"><select name="regime_tva" style="width:160px"><option value="<?php echo $retour_org_ben[19]; ?>"><?php echo $retour_org_ben[19]; ?></option><?php $projet->texte('Regime_tva');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr bgcolor="#EBF2FE">
                    <td>Régime fiscal</td>
                    <td width="302" style="font-weight:bolder"><select name="regime_fiscal" style="width:160px"> <option value="<?php echo $retour_org_ben[20]; ?>"><?php echo $retour_org_ben[20]; ?></option><?php $projet->texte('regime_fiscal');?></select></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <tr bgcolor="#FFF">
                        <td>Régime social du dirigeant</td>
                        <td width="302" style="font-weight:bolder"><select name="regime_social_dirigeant" style="width:160px"><option value="<?php echo $retour_org_ben[21]; ?>"><?php echo $retour_org_ben[21]; ?><?php $projet->texte('Regime_social_dirigeant');?></option></select></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                    <td>
                        <hr />
                    </td>
                </tr>
                <tr>
                    <tr bgcolor="#EBF2FE">
                        <td>Statut</td>
                        <td width="302" style="font-weight:bolder"><select name="statut" style="width:160px"><option value="<?php echo $retour_org_ben[22]; ?>"><?php echo $retour_org_ben[22]; ?></option><option>En cours</option><option>Cree</option><option>Annulee</option></select></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr bgcolor="#FFF">
                        <td></td>
                        <td height="34" align="right">&nbsp;</td>
                        <td><input type="submit" name="modifier_org_ben" value="Enregistrer" /></td>
                        </td>
                    </tr>
            </table>
        </form>
    </div>
</div>

<div style="display:none" id="investissement"><br/>
    <form method="get"><input type="hidden" name="domain" value="default" />
        <center>
            <table style="border:1px solid #CCC">
                <tr style="font-weight:bold; background-color: #999; color:#FFF">
                    <td>Exercice</td>
                    <input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet'] ;?>" />
                    <td>Type immo</td>
                    <td>Intitulé du compte</td>
                    <td>Quantité</td>
                    <td>PAU HT</td>
                    <td>Montant HT</td>
                    <td>TVA</td>
                    <td>Montant TVA</td>
                    <td>Montant TTC</td>
                    <td></td>
                </tr>
                <?php $projet->voir_investissement($_GET['id_projet']) ;?>
                <tr style="text-align:right;border:1px solid #CCC" bgcolor='#ECF3F4'>
                    <td><select name="exercice_in">
          <option>Depart</option>
          <option>Annee 1</option>
          <option>Annee 2</option>
          <option>Annee 3</option>
        </select></td>
                    <td><select onChange="return_immo('immo');" id="immo" name="immo"><option></option><?php $projet->texte('Rubrique_planfi', '', 'egw_texte_financement');?></select></td>
                    <td><select id="intitule_compte" name="intitule_compte"><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option></select></td>
                    <td><input name="quantite" id="quantite" onChange="calcul_montant_ht(this.value,document.getElementById('pau_ht').value);"
                            size="1" type="text" /></td>
                    <td><input size="4" name="pau_ht" id="pau_ht" onFocus="calcul_montant_ht(document.getElementById('quantite').value,this.value);"
                            type="text" /></td>
                    <td><input size="4" name="montant_ht" onFocus="calcul_montant_ht(document.getElementById('quantite').value,document.getElementById('pau_ht').value);"
                            type="text" id="montant_ht" /></td>
                    <td><select name="tva" onChange="calcultva(document.getElementById('montant_ht').value,this.value);"><option></option><option value="0">0%</option><option value="5.5">5,5%</option><option value="10.0">10,0%</option><option value="20.0">20,0%</option></select></td>
                    <td>
                        <div style="color: #F00" id="div_montant_tva"></div>
                    </td>
                    <td>
                        <div style="color:#090" id="div_montant_ttc"></div>
                    </td>
                    <td><input name="enregistrer_investissement" type="submit" value="Enregistrer" /></td>
                </tr>
            </table>
        </center>
    </form><br/>
    <center><input type="button" onClick="window.location.href='xls.php?plan_3ans=1&id_projet=<?php echo $_GET['id_projet']; ?>'"
            value="Voir Plan de financement 3 ans" /></center>
</div>

<center>
    <div style="display:none" id="financement">
        <center></center><br/>
        <form method="get"><input type="hidden" name="domain" value="default" />
            <table style="border:1px solid #CCC">
                <tr style="font-weight:bold; background-color: #999; color:#FFF">
                    <td width="84">Désignation </td>
                    <input name="id_projet" type="hidden" value="<?php echo $_GET['id_projet'] ;?>" />
                    <td width="84">Exercice</td>
                    <td width="109">Type Ressource</td>
                    <td width="120">Intitulé du compte</td>
                    <td width="93">Montant prévisionnelle</td>
                    <td width="86">Montant Obtenu</td>
                    <td width="51">Ecart</td>
                    <td width="85">Type Amt</td>
                    <td width="75">Durée</td>
                    <td width="60">Taux</td>
                    <td width="64">Demande</td>
                    <td width="79"></td>
                </tr>
                <?php $projet->voir_financement($_GET['id_projet']) ;?>
                <tr style="text-align:right;border:1px solid #CCC" bgcolor='#ECF3F4'>
                    <td><input size="8" type="text" name="designation" /></td>
                    <td><select name="exercice"><option>Depart</option><option>Annee 1</option><option>Annee 2</option><option>Annee 3</option></select></td>
                    <td><select onChange="return_ressource('ressource');" id="ressource" name="ressource"><option></option><?php $projet->texte('Type ressources', '', 'egw_texte_financement');?></select></td>
                    <td><select id="intitule_compte_ressource" name="intitule_compte_ressource"><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option></select></td>
                    <td><input size="6" id="montant_ressource" name="montant_ressource" type="text" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><select name="type_amt">
     <option>Linéaire</option>
     <option>Dégressif</option>
   </select></td>
                    <td><input size="2" type="text" name="duree_amt" /> mois</td>
                    <td><input style="width:20px" type="text" name="tx_amt" /> %
                    </td>
                    <td>&nbsp;</td>
                    <td><input name="enregistrer_financement" type="submit" value="Enregistrer" /></td>
                </tr>
            </table>
        </form>
        <center><br/><input type="button" onClick="window.location.href='xls.php?plan_3ans=1&id_projet=<?php echo $_GET['id_projet']; ?>'"
                value="Voir Plan de financement 3 ans" /></center>
    </div>
</center>


<center>
    <div style="display:none;" id="produit"><br/>
        <center><strong>Produits</strong></center><br/>
        <form method="get"><input type="hidden" name="domain" value="default" />
            <table style="border:1px solid #CCC">
                <tr style="font-weight:bold; background-color: #999; color:#FFF">


                    <td>Compte Produits</td>
                    <td>Vent</td>
                    <td>Evo</td>
                    <td>Cf An2</td>
                    <td>Cf An3</td>
                    <td>Tva</td>
                    <td>Délai jrs</td>
                    <td>Part Délai</td>


                    <td>Annee 1</td>
                    <td>Annee 2</td>
                    <td>Annee 3</td>
                    <td></td>
                </tr>
                <?php $projet->voir_cr3($_GET['id_projet'], 'produit') ;?>
                <tr valign="bottom" style="text-align:left;border:1px solid #CCC" bgcolor='#ECF3F4'>



                    <td><select style=" width:150px" name="compte_produits">
            <?php $projet->texte('Entrees Exploitation', '', 'egw_texte_financement');?>
        </select></td>
                    <td><select name="vent_p">
          <option ></option>
          <option >Fix</option>
          <option >Var</option>
        </select></td>
                    <td><select name="evo_p">
        <option ></option>
          <option >Const</option>
          <option >Prop</option>
        </select></td>
                    <td><input onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,this.value,document.getElementById('cf_a3').value);"
                            style=" width:25px" id="cf_a2" name="cf_a2" type="text" value="1" /></td>
                    <td><input style=" width:25px" id="cf_a3" name="cf_a3" onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,document.getElementById('cf_a2').value,this.value);"
                            type="text" value="1" /></td>
                    <td><select name="tva_p"><option value="0">0%</option><option value="5.5">5,5%</option><option value="10.0">10,0%</option><option value="20">20,0%</option></select></td>
                    <td><select name="delai_p"><option>0</option><option >7</option><option >10</option><option >15</option><option selected='selected' >30</option><option >45</option><option >60</option><option >90</option><option >120</option><option >240</option><option >360</option></select></td>
                    <td><input size="2" name="part_delai_p" value="100" type="text" /> %</td>

                    <td><input size="2" name="cr_annee1" id="cr_annee1" onChange="calcul_annee_suivante(this.value,document.getElementById('cf_a2').value,document.getElementById('cf_a3').value);"
                            type="text" /></td>
                    <td>
                        <div id="div_cr_annee2"></div>
                    </td>
                    <td>
                        <div id="div_cr_annee3"></div>
                    </td>
                    <td><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet']; ?>" /><input type="hidden"
                            name="nature" value="produit" /><input name="enregistrer_cr3" type="submit" value="Enregistrer" /></td>
                </tr>
            </table>
        </form><br/><input type="button" onClick="window.location.href='xls.php?cr_3ans=1&id_projet=<?php echo $_GET['id_projet']; ?>'"
            value="Voir CR 3 ans" /></div>
</center>

<center>
    <div style="display:none" id="charge"><br/>
        <center><strong>Charges</strong></center><br/>
        <form id="form_charge" method="get"><input type="hidden" name="domain" value="default" />
            <table style="border:1px solid #CCC">
                <tr style="font-weight:bold; background-color: #999; color:#FFF">

                    <td>Compte Achats</td>
                    <td>Vent</td>
                    <td>Evo</td>
                    <td>Cf An2</td>
                    <td>Cf An3</td>
                    <td>Tva</td>
                    <td>Délai jrs</td>
                    <td>Part Délai</td>



                    <td>Annee 1</td>
                    <td>Annee 2</td>
                    <td>Annee 3</td>
                    <td></td>
                </tr>
                <?php $projet->voir_cr3($_GET['id_projet'], 'charge') ;?>
                <tr valign="bottom" style="text-align:left;border:1px solid #CCC" bgcolor='#ECF3F4'>


                    <td><select name="compte_achats">
            <?php $projet->texte('Sorties Exploitation', '', 'egw_texte_financement');?>
        </select></td>
                    <td><select name="vent_p">
          <option ></option>
          <option >Fix</option>
          <option >Var</option>
        </select></td>
                    <td><select name="evo_p">
          <option ></option>
          <option >Const</option>
          <option >Prop</option>
        </select></td>
                    <td><input onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,this.value,document.getElementById('cf_a3').value);"
                            style=" width:25px" id="cf_a2" name="cf_a2" type="text" value="1" /></td>
                    <td><input style=" width:25px" id="cf_a3" name="cf_a3" onChange="calcul_annee_suivante(document.getElementById('cr_annee1').value,document.getElementById('cf_a2').value,this.value);"
                            type="text" value="1" /></td>
                    <td><select name="tva_p">
          <option value="0">0%</option>
          <option value="5.5">5,5%</option>
          <option value="10.0">10,0%</option>
          <option value="20.0">20,0%</option>
        </select></td>
                    <td><select name="delai_p">
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
                    <td><input size="2" name="part_delai_p" value="100" type="text" /> %
                    </td>


                    <td><input size="2" name="cr_annee1" id="cr_annee1" onChange="calcul_annee_suivante(this.value,document.getElementById('cf_a2').value,document.getElementById('cf_a3').value);"
                            type="text" /></td>
                    <td>
                        <div id="div_cr_annee2_c"></div>
                    </td>
                    <td>
                        <div id="div_cr_annee3_c"></div>
                    </td>
                    <td><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet']; ?>" /><input type="hidden"
                            name="nature" value="charge" /><input name="enregistrer_cr3" type="submit" value="Enregistrer" /></td>
                </tr>
            </table>
        </form><br/><input type="button" onClick="window.location.href='xls.php?cr_3ans=1&id_projet=<?php echo $_GET['id_projet']; ?>'"
            value="Voir CR 3 ans" /></div>
</center>

<center>
    <div style="display:none" id="effectif"><br/>
        <center><strong>Effectifs</strong></center><br/>
        <form method="get"><input type="hidden" name="domain" value="default" />
            <table style="border:1px solid #CCC">
                <tr style="font-weight:bold; background-color: #999; color:#FFF">

                    <td>Exercice</td>


                    <td>Poste / Fonction</td>
                    <td>Statut</td>
                    <td>Nb mois</td>
                    <td>Rémun. m/brut</td>
                    <td>Rémun. a/brut</td>
                    <td>Charges sociales TNS</td>
                    <td>Charges patronales TS</td>
                    <td>Rémun. annuelle</td>
                    <td>Salaire net</td>
                    <td></td>
                </tr>
                <?php $projet->voir_effectif($_GET['id_projet']) ;?>
                <tr valign="bottom" style="text-align:left;border:1px solid #CCC" bgcolor='#ECF3F4'>


                    <td><select name="exercice">
        <option>Année 1</option><option>Année 2</option><option>Année 3</option>
        </select></td>


                    <td><input name="poste" type="text" /></td>
                    <td><select id="statut" name="statut" onChange="remun_an(document.getElementById('nb_mois').value,document.getElementById('remun_mens').value,this.value)">
        <option>Salarié</option><option>Non salarié</option>
        </select></td>
                    <td><select id="nb_mois" onChange="remun_an(this.value,document.getElementById('remun_mens').value,document.getElementById('statut').value)"
                            name="nb_mois"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option>
       <option>9</option><option>10</option> <option>11</option><option selected="selected">12</option>
        </select></td>
                    <td><input id="remun_mens" name="remun_mens" onChange="remun_an(document.getElementById('nb_mois').value,this.value,document.getElementById('statut').value)"
                            size="2" type="text" /></td>
                    <td>
                        <div id="div_remun_an_brut"></div>
                    </td>
                    <td>
                        <div id="div_charges_tns"></div>
                    </td>
                    <td>
                        <div id="div_charges_ts"></div>
                    </td>
                    <td>
                        <div id="div_remun_an"></div>
                    </td>
                    <td>
                        <div id="div_salaire_net"></div>
                    </td>
                    <td><input type="hidden" name="id_projet" value="<?php echo $_GET['id_projet']; ?>" /><input name="enregistrer_effectif"
                            type="submit" value="Enregistrer" /></td>
                </tr>
            </table>
        </form><br/></div>
</center>
   
   
<?php
if (isset($_POST['enregistrer_projet'])) {
    $projet->update_projet($_POST['id_projet'], $GLOBALS['egw_info']['user']['account_id'], $_POST['conseiller_id'], $_POST['description_projet'], $_POST['statut_projet'], $_POST['resultat_projet'], $_POST['date_fin_projet'], $_POST['date_fin_pre_projet']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_POST['id_projet'].'"</script>';
}
if (isset($_GET['modifier_org_ben'])) {
    $projet->update_org_ben($_GET['id_projet'], $GLOBALS['egw_info']['user']['account_id'], $_GET['nom_commercial'], $_GET['raison_sociale'], $_GET['activite_principale'], $_GET['type_adresse'], $_GET['adresse_ligne_1'], $_GET['adresse_ligne_2'], $_GET['adresse_ligne_3'], $_GET['cp'], $_GET['ville'], $_GET['region'], $_GET['pays'], $_GET['date_immat'], $_GET['date_debut_activite'], $_GET['forme_juridique'], $_GET['siret'], $_GET['secteur_activite'], $_GET['dirigeant'], $_GET['implantation'], $_GET['regime_imposition'], $_GET['regime_tva'], $_GET['regime_fiscal'], $_GET['regime_social_dirigeant'], $_GET['statut'], $_GET['code_naf']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=entreprise";</script>';
}
if (isset($_GET['enregistrer_investissement'])) {
    $projet->inserer_investissement($GLOBALS['egw_info']['user']['account_id'], $_GET['id_projet'], $_GET['exercice_in'], $_GET['immo'], $_GET['intitule_compte'], $_GET['quantite'], $_GET['pau_ht'], $_GET['montant_ht'], $_GET['tva']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=investissement";</script>';
}
if (isset($_GET['enregistrer_produit'])) {
    $projet->inserer_produit($GLOBALS['egw_info']['user']['account_id'], $_GET['id_resacc'], $_GET['designation'], $_GET['compte_produits'], $_GET['compte_achats'], $_GET['pvu'], $_GET['qt_j'], $_GET['nb_sem'], $_GET['nb_mois'], $_GET['m1'], $_GET['m2'], $_GET['m3'], $_GET['m4'], $_GET['m5'], $_GET['m6'], $_GET['m7'], $_GET['m8'], $_GET['m9'], $_GET['m10'], $_GET['m11'], $_GET['m12'], $_GET['exercice']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=produit";</script>';
}

if (isset($_GET['enregistrer_cr3'])) {
    $projet->inserer_cr3($GLOBALS['egw_info']['user']['account_id'], $_GET['id_projet'], $_GET['nature'], $_GET['compte_produits'], $_GET['compte_achats'], $_GET['cr_annee1'], $_GET['cr_annee1'] *$_GET['cf_a2'], $_GET['cr_annee1'] *$_GET['cf_a2']*$_GET['cf_a3'], $_GET['cf_a2'], $_GET['cf_a3'], $_GET['tva_p'], $_GET['delai_p'], $_GET['part_delai_p'], $_GET['evo_p'], $_GET['vent_p']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet='.$_GET['nature'].'";</script>';
}
if (isset($_GET['enregistrer_effectif'])) {
    $projet->inserer_effectif($GLOBALS['egw_info']['user']['account_id'], $_GET['id_projet'], $_GET['exercice'], $_GET['poste'], $_GET['statut'], $_GET['nb_mois'], $_GET['remun_mens']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=effectif";</script>';
}


if (isset($_GET['enregistrer_financement'])) {
    $projet->inserer_financement($GLOBALS['egw_info']['user']['account_id'], $_GET['id_projet'], $_GET['exercice'], $_GET['ressource'], $_GET['intitule_compte_ressource'], $_GET['montant_ressource'], $_GET['type_amt'], $_GET['duree_amt'], $_GET['tx_amt'], $_GET['designation']);
    
    //$projet->return_last_id("egw_resacc_ressources_fi");
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
}

if (isset($_GET['id_resaac_in_delete'])) {
    $projet->delete_investissement($_GET['id_resaac_in_delete']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=investissement";</script>';
}
if (isset($_GET['id_resaac_fi_delete'])) {
    $projet->delete_financement($_GET['id_resaac_fi_delete']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=financement";</script>';
}
if (isset($_GET['id_resacc_effectif'])) {
    $projet->delete_effectif($_GET['id_resacc_effectif']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=effectif";</script>';
}
if (isset($_GET['id_resacc_cr3_delete'])) {
    $projet->delete_cr3($_GET['id_resacc_cr3_delete']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet='.$_GET['nature'].'";</script>';
}
if (isset($_GET['id_resacc_pro_delete'])) {
    $projet->delete_produits($_GET['id_resacc_pro_delete']);
    echo'<script>window.location.href="details.php?domain=default&id_projet='.$_GET['id_projet'].'&onglet=produit";</script>';
}

if (isset($_GET['pourcent_2']) and !isset($_GET['enregistrer_produit'])) {
    $projet->update_pourcentage($_GET['id_resacc'], $_GET['pourcent_2'], "annee2", $GLOBALS['egw_info']['user']['account_id']);
    
    echo'<script>window.location.href="details.php?domain=default&id_resacc='.$_GET['id_resacc'].'&id_projet='.$_GET['id_projet'].'&onglet=produit"</script>';
}
if (isset($_GET['pourcent_3']) and !isset($_GET['enregistrer_produit'])) {
    $projet->update_pourcentage($_GET['id_resacc'], $_GET['pourcent_3'], "annee3", $GLOBALS['egw_info']['user']['account_id']);
    
    echo'<script>window.location.href="details.php?domain=default&id_resacc='.$_GET['id_resacc'].'&id_projet='.$_GET['id_projet'].'&onglet=produit"</script>';
}

if ($_GET['onglet']=="entreprise") {
    echo'<script>voirdiv(\'projet_creation\',\'projet\',\'investissement\',\'financement\',\'charge\',\'produit\');</script>';
}
if ($_GET['onglet']=="investissement") {
    echo'<script>voirdiv(\'investissement\',\'projet_creation\',\'projet\',\'financement\',\'charge\',\'produit\');</script>';
}
if ($_GET['onglet']=="financement") {
    echo'<script>voirdiv(\'financement\',\'investissement\',\'projet_creation\',\'projet\',\'charge\',\'produit\');</script>';
}

if ($_GET['onglet']=="produit") {
    echo'<script>voirdiv(\'produit\',\'investissement\',\'projet_creation\',\'projet\',\'charge\',\'financement\');</script>';
}
if ($_GET['onglet']=="charge") {
    echo'<script>voirdiv(\'charge\',\'investissement\',\'projet_creation\',\'projet\',\'produit\',\'financement\');</script>';
}
if ($_GET['onglet']=="effectif") {
    echo'<script>voirdiv(\'effectif\',\'charge\',\'investissement\',\'projet_creation\',\'projet\',\'produit\',\'financement\');</script>';
}
if ($_GET['annexe']=="aide") {
    echo'<script>window.open(\'aide.php?domain=default&id_projet='.$_GET['id_projet'].'&id_resacc_fi='.$projet->return_last_id("egw_resacc_ressources_fi").'\',\'Aide financière\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=450, height=400\');</script>';
}



if (isset($_GET['id_contact']) and $_GET['id_contact']!=null) {
    echo'<script>window.open(\'../'.$contact_v.'/modifier.php?financement=1&id_ben='.$_GET['id_contact'].'&domain=default\',\'Mise à jour du contact\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=600, height=600\');</script>';
}
if (isset($_GET['id_organisme']) and  $_GET['id_organisme']!=null) {
    echo'<script>window.open(\'../Organisation1.0/modifier.php?financement=1&id_organisation='.$_GET['id_organisme'].'&domain=default\',\'Mise à jour de l organisme\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=600, height=600\');</script>';
}
echo $GLOBALS['egw']->common->egw_footer();
?>
</body></html>