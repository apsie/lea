    var Projet = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
        	arrayProjet = new Array();
        	arrayOrg = new Array();
        	
        	this.idOrganisation;
           // var parametre = new Array();
            /*this.id_projet; 
            this.description; 
            this.date_debut;
            this.date_fin_previsionnelle;
            this.categorie;
            this.id_referent;
            this.statut;
            this.resultat;*/
        },
        getProjet:function(id_projet)
        {
        	
        	
        	var load="<br/><br/><center><img src='./images/ico/load.gif' /></center>";

    		$j('.contenu_flex').html(load);
    	var pager="<div class='pager' id='pager'>	<form><table><tr><td width='100px'><a  href='./index.php?page=xls&noHeader=1&libelle_xls=projet'><img src='./images/ico/excel.png' /> Export Excel</a></td><td> - </td><td>";
    	pager +='<img src="./images/ico/first.png" class="first"/><img src="./images/ico/prev.png" class="prev"/> Page : <input type="text" size="4" class="pagedisplay"/> ';
    	pager +='<img src="./images/ico/next.png" class="next"/>';
    	pager +='<img src="./images/ico/last.png" class="last"/>';
    	pager +=' - <span class="nb_resultats"></span> résultats - Afficher <select class="pagesize"><option selected="selected"  value="30">30</option><option  value="60">60</option></select> lignes</form></td></tr></table></div>';
    	var champ = $j('#select_champ').val();
    	$j('.load').show();
    	$j('.page').html(pager);
    	
    	



    	
    $j.ajax({
    		url : "./index.php?page=ajaxProjet&noTemplate=1",
    		dataType : "json",
    		data : {
    		mot : $j('#mot_recherche').val(),
    		id_projet : id_projet,
    		action : "getProjet"
    		    
    		},
    		success: function(data){
    			

    var html='<table id="myTable" cellspacing="1" class="tablesorter"><thead><tr><th>Intitulé du projet</th><th>Date de début</th><th>Date de fin prévisionelle</th><th>Date de fin</th><th>Référent</th><th>Description du projet</th><th>Résultat</th><th>Statut</th><th>BP</th> ';
    html +='<th></th></thead></tr><tbody>';


    			$j.each(data.DATA,function(i, obj){
    				
    				html +='<tr>';
    				
    				
    					html +='<td><a href="javascript:void(0);" onclick=\'\' >'+obj.intitule_projet+'</a></td><td>'+obj.date_debut+'</td><td>'+obj.date_fin_previsionnelle+'</td><td>'+obj.date_fin_reelle+'</td><td>'+obj.account_firstname+' '+obj.account_lastname+'</td><td>'+obj.description_projet+'</td><td>'+obj.resultat+'</td><td>'+obj.statut+'</td>';
    				
    				
    				arrayProjet[obj['id_projet']] = new Array();
    				arrayProjet[obj['id_projet']]['categorie'] = obj['categorie'];
    				arrayProjet[obj['id_projet']]['date_debut'] = obj['date_debut'];
    				arrayProjet[obj['id_projet']]['date_fin_previsionnelle'] = obj['date_fin_previsionnelle'];
    				arrayProjet[obj['id_projet']]['id_coordinateur'] = obj['id_coordinateur'];
    				arrayProjet[obj['id_projet']]['description_projet'] = obj['description_projet'];
    				arrayProjet[obj['id_projet']]['resultat'] = obj['resultat'];
    				arrayProjet[obj['id_projet']]['statut'] = obj['statut'];

    				
    			
    				html +='<td><a  href="/bp/public/?id_projet='+obj.id_projet+'&id_employe='+VARTEMPS['COMPTES']['ID']+'" target="_blank"><img style="cursor:pointer"  src="./images/ico/logo_apsie_bp_petit.png" /></a></td><td><img style="cursor:pointer" onclick="Projet.addProjetBox('+obj.id_projet+');"  src="./images/ico/edit.png" /></td></tr>';
    			});

    			html +="<tbody></table>";
    			$j('.contenu_flex').html(html);
    if(data.TOTAL!=0)
    {

    			
    			$j("#myTable").tablesorter({ widgets: ['zebra'] })
    						 .tablesorterPager({container: $j("#pager"),positionFixed: false });
    }
   
    			$j('.nb_resultats').html(data.TOTAL);

    			
    			
    		
    		
    			
    			$j('.recherche').show();
    }
    	});	


		
    		



    

        },
        addProjetBox:function(id_projet)
        {
        	
        	if(id_projet!=undefined)
        		{
        		
        		$j('#div_recherche_contact_projet').hide();
        		$j('#tr_date_fin_projet').show();
        		var title="Fiche Projet : Modification du projet";
        		
        
        	
            	
            	//Récup projet
            	Projet.geProjetById(id_projet);
            	
            	//Récup donnée entreprise
            	Projet.geProjetEntreprise(id_projet);
         
				
        		}
        	else
        		{
        		$j('#div_recherche_contact_projet').show();
        		$j('#tr_date_fin_projet').hide();
        		var title="Fiche Projet : Créer un projet";
        		$j('#resultat_projet').val('En attente de resultat');
            	$j('#statut_projet').val('En cours');
        		}
        	$j('.verif_box').html("");
        	$j( "#editProjet" ).attr("title",title);
        	
        	$j( "#editProjet" ).dialog({height:800,width:800});
        	
        	Calendrier.retourRechercheContact('_projet');
        	$j('#contact_a_rechercher_texte_projet').val('Rechercher un contact...');
        	
        	
        }
        ,addProjet:function()
        {
        	if($j('#id_projet').val()!="")
        		{
        		var id_organisation = $j('#id_organisation_').val();
        		var categorie = $j('#categorie_').val();
        		var nom_organisme = $j('#nom_organisme_').val();
        		var activite_principale = $j('#activite_principale_').val();
        		var code_naf = $j('#code_naf_').val();
        		var raison_sociale = $j('#raison_sociale_').val();
        		var type_adresse = $j('#type_adresse_').val();
        		var rue = $j('#rue_').val();
        		var adresse_ligne_2 = $j('#adresse_ligne_2_').val();
        		var adresse_ligne_3 = $j('#adresse_ligne_3_').val();
        		var cp = $j('#cp_box_').val();
        		var ville = $j('#ville_box_').val();
        		var region = $j('#region_box_').val();
        		var pays = $j('#pays_box_').val();
        		var tel = $j('#tel_').val();
        		var fax = $j('#fax_').val();
        		var email = $j('#email_').val();
        		var site_web = $j('#site_web_').val();
        		var date_immat = $j('#date_immat_').val();
        		var date_debut_activite = $j('#date_debut_activite_').val();
        		var forme_juridique = $j('#forme_juridique_').val();
        		var siret = $j('#siret_').val();
        		var secteur_activite = $j('#secteur_activite_').val();
        		var dirigeant = $j('#dirigeant_').val();
        		var implantation = $j('#implantation_').val();
        		var regime_imposition = $j('#regime_imposition_').val();
        		var regime_tva = $j('#regime_tva_').val();
        		var regime_fiscal = $j('#regime_fiscal_').val();
        		var regime_social_dirigeant = $j('#regime_social_dirigeant_').val();
        		var statut = $j('#statut_').val();
        		var code_organisme_org = $j('#code_organisme_').val();

        		if(id_organisation!="")
        		{
        			$j.ajax({
        				url : "./index.php?page=ajaxOrganisation&noTemplate=1",
        				dataType : "json",
        				data : {
        					id_organisation : id_organisation,
        					categorie :categorie,
        					nom_organisme :nom_organisme,
        					activite_principale :activite_principale,
        					code_naf :code_naf,
        					raison_sociale:raison_sociale,
        					type_adresse:type_adresse,
        					rue :rue,
        					adresse_ligne_2 :adresse_ligne_2,
        					adresse_ligne_3 :adresse_ligne_3,
        					cp:cp,
        					ville:ville,
        					region :region,
        					pays:pays,
        					tel :tel,
        					fax:fax,
        					email:email,
        					site_web :site_web,
        					date_immat :date_immat,
        					date_debut_activite :date_debut_activite,
        					forme_juridique:forme_juridique,
        					siret :siret,
        					secteur_activite :secteur_activite ,
        					dirigeant :dirigeant,
        					implantation:implantation,
        					regime_imposition :regime_imposition,
        				    regime_tva :regime_tva,
        					regime_fiscal :regime_fiscal,
        					regime_social_dirigeant:regime_social_dirigeant,
        					statut :statut,
        					code_organisme : code_organisme_org,
        					action : "updateOrganisation"
        				    
        				},
        				success: function(data){
        				}});
        		}
        		else
        		{
        		$j.ajax({
        			url : "./index.php?page=ajaxOrganisation&noTemplate=1",
        			dataType : "json",
        			data : {
        			
        				categorie :categorie,
        				nom_organisme :nom_organisme,
        				activite_principale :activite_principale,
        				code_naf :code_naf,
        				raison_sociale:raison_sociale,
        				type_adresse:type_adresse,
        				rue :rue,
        				adresse_ligne_2 :adresse_ligne_2,
        				adresse_ligne_3 :adresse_ligne_3,
        				cp:cp,
        				ville:ville,
        				region :region,
        				pays:pays,
        				tel :tel,
        				fax:fax,
        				email:email,
        				site_web :site_web,
        				date_immat :date_immat,
        				date_debut_activite :date_debut_activite,
        				forme_juridique:forme_juridique,
        				siret :siret,
        				secteur_activite :secteur_activite ,
        				dirigeant :dirigeant,
        				implantation:implantation,
        				regime_imposition :regime_imposition,
        			    regime_tva :regime_tva,
        				regime_fiscal :regime_fiscal,
        				regime_social_dirigeant:regime_social_dirigeant,
        				statut :statut,
        				code_organisme : code_organisme_org,
        				id_projet : $j('#id_projet').val(),

        				action : "saveOrganisation"
        			},
    				success: function(data){
    				}});
        			    
        			}
        					
        				
        		}
        	  $j.ajax({
          		url : "./index.php?page=ajaxProjet&noTemplate=1",
          		dataType : "json",
          		data : {
          		id_projet : $j('#id_projet').val(),
          		categorie : $j('#categorie_projet').val(),
          		contact_a_rechercher : $j('#contact_a_rechercher_projet').val(),
          		id_referent : $j('#referent_projet').val(),
          		description : $j('#desc_projet').val(),
          		resultat : $j('#resultat_projet').val(),
          		statut : $j('#statut_projet').val(),
          		date_debut : $j('#date_deb_projet').val(),
          		date_fin_previsionnelle : $j('#date_fin_pre_projet').val(),
          		date_fin : $j('#date_fin_projet').val(),
          		action : "addProjet"
          		    
          		},
          		success: function(data){
          			$j('#id_projet').val("");
          			$j('#categorie_projet').val("");
              		$j('#contact_a_rechercher_projet').val('');
              		$j('#referent_projet').val('');
              		$j('#desc_projet').val('');
              		$j('#resultat_projet').val('');
              		$j('#statut_projet').val('');
              		$j('#date_deb_projet').val('');
              		$j('#date_fin_pre_projet').val('');
              		$j('#date_fin_projet').val('');
          			$j( "#editProjet" ).dialog('close');
          			Projet.getProjet();	
          		}});
        }
        ,geProjetEntreprise:function(id_projet)
        {
        	var retour =   $j.ajax({
          		url : "./index.php?page=ajaxProjet&noTemplate=1",
          		dataType : "json",
          		data : {
          		id_projet : id_projet,
          		action : "getProjetEntreprise"
          		    
          		},
          		success: function(data){
          			
          		   	$j('#id_organisation_').val("");
                	$j('#categorie_').val("");
                	$j('#nom_organisme_').val("");
                	$j('#code_organisme_').val("");
                	$j('#activite_principale_').val("");
                	$j('#code_naf_').val("");
                	$j('#raison_sociale_').val("");
                	$j('#type_adresse_').val("");
                	$j('#rue_').val("");
                	$j('#adresse_ligne_2_').val("");
                	$j('#adresse_ligne_3_').val("");
                	$j('#cp_box_').val("");
                	$j('#ville_box_').val("");
                	$j('#region_box_').val("");
                	$j('#pays_box_').val("");
                	$j('#code_organisme').val("");
                	$j('#tel_').val("");
                	$j('#fax_').val("");
                	$j('#email_').val("");
                	$j('#site_web_').val("");
                	$j('#date_immat_').val("");
                	$j('#date_debut_activite_').val("");
                	$j('#forme_juridique_').val("");
                	$j('#siret_').val("");
                	$j('#secteur_activite_').val("");
                	$j('#dirigeant_').val("");
                	$j('#implantation_').val("");
                	$j('#regime_imposition_').val("");
                	$j('#regime_tva_').val("");
                	$j('#regime_fiscal_').val("");
                	$j('#regime_social_dirigeant_').val("");
                	$j('#statut_').val("");
                	
                	
                	
                	$j('#id_organisation_').val(data['id_organisation']);
                	$j('#categorie_').val(data['cat_id']);
                	$j('#nom_organisme_').val( data['nom_organisme']);
                	$j('#code_organisme_').val(data['code_org']);
                	$j('#activite_principale_').val(data['activite_principale']);
                	$j('#code_naf_').val(data['code_naf']);
                	$j('#raison_sociale_').val(data['raison_sociale']);
                	$j('#type_adresse_').val(data['type_adresse']);
                	$j('#rue_').val(data['adresse_ligne_1']);
                	$j('#adresse_ligne_2_').val(data['adresse_ligne_2']);
                	$j('#adresse_ligne_3_').val(data['adresse_ligne_3']);
                	$j('#cp_box_').val(data['cp']);
                	$j('#ville_box_').val(data['ville']);
                	$j('#region_box_').val(data['region']);
                	$j('#pays_box_').val(data['pays']);
                	$j('#code_organisme').val(data['code_org']);
                	$j('#tel_').val(data['tel']);
                	$j('#fax_').val(data['fax']);
                	$j('#email_').val(data['email']);
                	$j('#site_web_').val(data['site_web']);
                	$j('#date_immat_').val(data['date_immat']);
                	$j('#date_debut_activite_').val(data['date_debut_activite']);
                	$j('#forme_juridique_').val(data['forme_juridique']);
                	$j('#siret_').val(data['siret']);
                	$j('#secteur_activite_').val(data['secteur_activite']);
                	$j('#dirigeant_').val(data['dirigeant']);
                	$j('#implantation_').val(data['implantation']);
                	$j('#regime_imposition_').val(data['regime_imposition']);
                	$j('#regime_tva_').val(data['regime_tva']);
                	$j('#regime_fiscal_').val(data['regime_fiscal']);
                	$j('#regime_social_dirigeant_').val(data['regime_social_dirigeant']);
                	$j('#statut_').val(data['statut_org']);
                	
                	
          			
    				
    				
          			}
          		
        	  });
        	
        	 // console.debug(Projet.arrayOrg_v2);
        		//return arrayOrg[Projet.idOrganisation];
        }
        ,geProjetById:function(id_projet)
        {
        	var retour =   $j.ajax({
          		url : "./index.php?page=ajaxProjet&noTemplate=1",
          		dataType : "json",
          		data : {
          		id_projet : id_projet,
          		action : "getProjet"
          		    
          		},
          		success: function(data){
          			$j('#id_projet').val("");
          			$j('#categorie_projet').val("");
              		$j('#referent_projet').val("");
              		$j('#desc_projet').val("");
              		$j('#date_deb_projet').val("");
              		$j('#date_fin_pre_projet').val("");
              		$j('#date_fin_projet').val("");
            		$j('#resultat_projet').val("");
                	$j('#statut_projet').val("");
                	
                	$j('#id_projet').val(id_projet);
        		$j('#categorie_projet').val(data.DATA[0]['categorie']);
              		$j('#referent_projet').val(data.DATA[0]['id_coordinateur']);
              		$j('#desc_projet').val(data.DATA[0]['description_projet']);
              		$j('#date_deb_projet').val(data.DATA[0]['date_debut']);
              		$j('#date_fin_pre_projet').val(data.DATA[0]['date_fin_previsionnelle']);
              		$j('#date_fin_projet').val(data.DATA[0]['date_fin_reelle']);
            		$j('#resultat_projet').val(data.DATA[0]['resultat']);
                	$j('#statut_projet').val(data.DATA[0]['statut']);
                	
                	
          			
    				
    				
          			}
          		
        	  });
        	
        	 // console.debug(Projet.arrayOrg_v2);
        		//return arrayOrg[Projet.idOrganisation];
        }
        
        
    });
    
    var Projet = new Projet();