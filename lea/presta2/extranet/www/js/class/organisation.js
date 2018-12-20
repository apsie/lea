    var Organisation = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
            
            this.id_organisation; 
        },
        getContactOrganisation:function(id_organisation)
        {
        	 this.id_organisation=id_organisation;
        	$j( "#contact_org" ).dialog({height:1000,width:1000});
        	Contact.getContactByOrganisation()
        },
        getForm:function()
        {
        	$j( "#editContact_" ).dialog('close');
        	//$j('.verif_box').html("");
        	$j( "#editContact_" ).html("");
        	$j( "#editContact_" ).attr("title","Fiche Organisation : Créer une organisation");
        	
        	$j( "#editContact_" ).dialog({height:700,width:700});
        	$j('.ui-dialog-title').html("Fiche Organisation : Créer une organisation");

        	$j.ajax({
    			url : "./index.php?page=ajaxOrganisation&noTemplate=1",
    			dataType : "html",
    			data : {
    			
    				action : "getForm"
    			    
    			},
    			success: function(html){
    				$j('#editContact_').html(html);
    			}});
        	
        	
        },
        saveContact:function()
        {	var id_organisation = $j('#id_organisation_org').val();
        	var categorie = $j('#categorie_org').val();
        	var nom_organisme = $j('#nom_organisme_org').val();
        	var activite_principale = $j('#activite_principale_org').val();
        	var code_naf = $j('#code_naf_').val();
        	var raison_sociale = $j('#raison_sociale_org').val();
        	var type_adresse = $j('#type_adresse_org').val();
        	var rue = $j('#rue_org').val();
        	var adresse_ligne_2 = $j('#adresse_ligne_2_org').val();
        	var adresse_ligne_3 = $j('#adresse_ligne_3_org').val();
        	var cp = $j('#cp_box_org').val();
        	var ville = $j('#ville_box_org').val();
        	var region = $j('#region_box_org').val();
        	var pays = $j('#pays_box_org').val();
        	var tel = $j('#tel_org').val();
        	var fax = $j('#fax_org').val();
        	var email = $j('#email_org').val();
        	var site_web = $j('#site_web_org').val();
        	var date_immat = $j('#date_immat_org').val();
        	var date_debut_activite = $j('#date_debut_activite_org').val();
        	var forme_juridique = $j('#forme_juridique_org').val();
        	var siret = $j('#siret_org').val();
        	var secteur_activite = $j('#secteur_activite_org').val();
        	var dirigeant = $j('#dirigeant_org').val();
        	var implantation = $j('#implantation_org').val();
        	var regime_imposition = $j('#regime_imposition_org').val();
        	var regime_tva = $j('#regime_tva_org').val();
        	var regime_fiscal = $j('#regime_fiscal_org').val();
        	var regime_social_dirigeant = $j('#regime_social_dirigeant_org').val();
        	var statut = $j('#statut_org').val();
        	var code_organisme_org = $j('#code_organisme_org').val();

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

        				

        				notify('Organisation','L\'organisation a été modifié');
						$j( "#editContact_" ).dialog('close');
						
        				}
        		});
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

        			action : "saveOrganisation"
        		    
        		},
        		success: function(data){
        			$j('#id_organisation_org').val("");
        			$j('#categorie_org').val("");
        			$j('#code_organisme_org').val("");
        			$j('#nom_organisme_org').val("");
        			$j('#activite_principale_org').val("");
        			$j('#code_naf_').val("");
        			$j('#raison_sociale_org').val("");
        			$j('#type_adresse_org').val("");
        			$j('#rue_org').val("");
        			$j('#adresse_ligne_2_org').val("");
        			$j('#adresse_ligne_3_org').val("");
        			$j('#cp_box_org').val("");
        			$j('#ville_box_org').val("");
        			$j('#region_box_org').val("");
        			$j('#pays_box_org').val("");
        			$j('#code_organisme_org').val("");
        			$j('#tel_org').val("");
        			$j('#fax_org').val("");
        			$j('#email_org').val("");
        			$j('#site_web_org').val("");
        			$j('#date_immat_org').val("");
        			$j('#date_debut_activite_org').val("");
        			$j('#forme_juridique_org').val("");
        			$j('#siret_org').val("");
        			$j('#secteur_activite_org').val("");
        			$j('#dirigeant_org').val("");
        			$j('#implantation_org').val("");
        			$j('#regime_imposition_org').val("");
        			$j('#regime_tva_org').val("");
        			$j('#regime_fiscal_org').val("");
        			$j('#regime_social_dirigeant_org').val("");
        			$j('#statut_org').val("");


        			notify('Organisation','L\'organisation a été ajouté');
					$j( "#editContact_" ).dialog('close');
        			
        			}
        	});
        	}
        }

        
        
    });
    
    var Organisation = new Organisation();