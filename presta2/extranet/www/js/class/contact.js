    var Contact = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
            
            
        },
        getContactByOrganisation:function(id_div)
        {
        	//alert(Organisation.id_organisation);
        	$j.ajax({
        		url : "./index.php?page=ajaxOrganisation&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			id_organisation : Organisation.id_organisation,
        			
        			
        			action : "getContactByOrganisation"
        		    
        		},
        		success: function(data){
        			var html='<table id="myTable_contact" cellspacing="1" class="tablesorter"><thead><tr> ';
        			
        			html +='<th>Catégorie</th><th>Nom</th><th>Fonction</th><th>Cp</th><th>Ville</th><th>Tel pro</th><th>Tel domicile</th> <th>Tel perso</th><th></th></thead></tr><tbody>';

        						$j.each(data,function(i, obj){
        							
        							html +='<tr><td>'+obj.cat_name+'</td><td>'+obj.nom_complet+'</td><td>'+obj.fonction+'</td><td>'+obj.cp+'</td><td>'+obj.ville+'</td><td>'+obj.tel_pro_1+'</td><td>'+obj.tel_domicile_1+'</td><td>'+obj.portable_perso+'</td><td><img src="./images/ico/delete.png" onclick="Contact.delete_id_organisation('+obj.id_ben+');" title="supprimer ce contact"  style="cursor:pointer"  /></td></tr>';
        							
        							
        });
        						html +="</tbody></table>";

        						//alert(html);
        						$j('#liste_contacts_org').html(html);
        						$j("#myTable_contact").tablesorter({ widgets: ['zebra'] });
        }});
        },
       addContactBox:function()
        {
        	$j('.verif_box').html("");
        	$j( "#editContact_" ).attr("title","Fiche contact : Créer un contact");
        	$j( "#editContact_" ).dialog({height:570,width:600});

        
        	
        },
        editForm:function(id)
        {
        	$j( "#editContact_" ).dialog('close');
        	$j('.verif_box').html("");
        	$j( "#editContact_" ).html("");
        	$j( "#editContact_" ).attr("title","Fiche contact : Modification du contact");
        	
        	$j( "#editContact_" ).dialog({height:550,width:600});
        	$j('.ui-dialog-title').html("Fiche contact : Modification du contact");
        
        	$j.ajax({
    			url : "./index.php?page=ajaxContact&noTemplate=1",
    			dataType : "html",
    			data : {
    				id_contact : id,
    				action : "editForm"
    			    
    			},
    			success: function(html){
    				$j('#editContact_').html(html);
    			}});
        	
        },
        saveContact:function(noReload)
        {	var id_contact = $j('#idContact_box').val();
        	var civilite = $j('#civilite_box').val();
        	var cat_id = $j('#select_categorie_box').val();
        	var nom = $j('#nom_box').val();
        	var prenom = $j('#prenom_box').val();
        	var nom_jeune_fille = $j('#nom_jeune_fille_box').val();
        	var deuxieme_prenom = $j('#deuxieme_prenom_box').val();
        	var adresse_ligne_1 = $j('#adresse_box').val();
        	var adresse_ligne_2 = $j('#complement_adresse_box').val();
        	var cp = $j('#cp_box').val();
        	var ville = $j('#ville_box').val();
        	var region = $j('#region_box').val();
        	var pays = $j('#pays_box').val();
        	var tel_pro_1 = $j('#tel_pro_1_box').val();
        	var tel_pro_2 = $j('#tel_pro_2_box').val();
        	var tel_domicile_1 = $j('#tel_dom_1_box').val();
        	var tel_domicile_2 = $j('#tel_dom_2_box').val();
        	var fax_pro = $j('#fax_pro_box').val();
        	var fax_perso = $j('#fax_perso_box').val();
        	var portable_pro = $j('#portable_pro_box').val();
        	var portable_perso = $j('#portable_perso_box').val();
        	var email_pro = $j('#email_pro_box').val();
        	var email_perso = $j('#email_perso_box').val();
        	var fonction = $j('#fonction_box').val();
        	var site_web = $j('#site_web_box').val();

        	//alert( Organisation.id_organisation);
        	if(id_contact!="")
        	{
        		$j.ajax({
        			url : "./index.php?page=ajaxContact&noTemplate=1",
        			dataType : "json",
        			data : {
        				id_contact : id_contact,
        				id_organisation : Organisation.id_organisation,
        				cat_id :cat_id,
        				civilite : civilite,
        				nom : nom,
        				prenom : prenom ,
        				nom_jeune_fille : nom_jeune_fille,
        				deuxieme_prenom : deuxieme_prenom ,
        				adresse_ligne_1 : adresse_ligne_1 ,
        				adresse_ligne_2 : adresse_ligne_2,
        				cp : cp,
        				ville : ville ,
        				region : region ,
        				pays : pays ,
        				tel_pro_1 : tel_pro_1,
        				tel_pro_2 : tel_pro_2,
        				tel_domicile_1 : tel_domicile_1,
        				tel_domicile_2 : tel_domicile_2,
        				fax_pro : fax_pro,
        				fax_perso : fax_perso,
        				portable_pro : portable_pro,
        				portable_perso : portable_perso,
        				email_pro : email_pro ,
        				email_perso : email_perso,
        				fonction : fonction,
        				site_perso : site_web,
        				action : "updateContact"
        			    
        			},
        			success: function(data){

        				


        				$j('.verif_box').html("<img src='./images/ico/ok.png' /> Le contact a été modifié avec succès.");
        				if(Organisation.id_organisation!="" && Organisation.id_organisation!=undefined)
        					{Organisation.getContactOrganisation(Organisation.id_organisation);}
        				else if(noReload==undefined)
        					{
        				getContact();
        					}
        				else
        					{
        						notify('Contact','Le contact a été modifié');
        						$j( "#editContact_" ).dialog('close');
        					}
        				}
        		});
        		}
        	else
        	{
        	$j.ajax({
        		url : "./index.php?page=ajaxContact&noTemplate=1",
        		dataType : "json",
        		data : {
        			cat_id :cat_id,
        			id_organisation : Organisation.id_organisation,
        			civilite : civilite,
        			nom : nom,
        			prenom : prenom ,
        			nom_jeune_fille : nom_jeune_fille,
        			deuxieme_prenom : deuxieme_prenom ,
        			adresse_ligne_1 : adresse_ligne_1 ,
        			adresse_ligne_2 : adresse_ligne_2,
        			cp : cp,
        			ville : ville ,
        			region : region ,
        			pays : pays ,
        			tel_pro_1 : tel_pro_1,
        			tel_pro_2 : tel_pro_2,
        			tel_domicile_1 : tel_domicile_1,
        			tel_domicile_2 : tel_domicile_2,
        			fax_pro : fax_pro,
        			fax_perso : fax_perso,
        			portable_pro : portable_pro,
        			portable_perso : portable_perso,
        			email_pro : email_pro ,
        			email_perso : email_perso,
        			fonction : fonction,
        			site_perso : site_web,
        			action : "saveContact"
        		    
        		},
        		success: function(data){

        			$j('#idContact_box').val("");
        			$j('#civilite_box').val("");
        			$j('#select_categorie_box').val("");
        			$j('#nom_box').val("");
        			$j('#prenom_box').val("");
        			$j('#nom_jeune_fille_box').val("");
        			$j('#deuxieme_prenom_box').val("");
        			$j('#adresse_box').val("");
        			$j('#complement_adresse_box').val("");
        			$j('#cp_box').val("");
        			$j('#ville_box').val("");
        			$j('#region_box').val("");
        			$j('#pays_box').val("");
        			$j('#tel_pro_1_box').val("");
        			$j('#tel_pro_2_box').val("");
        			$j('#tel_dom_1_box').val("");
        			$j('#tel_dom_2_box').val("");
        			$j('#fax_pro_box').val("");
        			$j('#fax_perso_box').val("");
        			$j('#portable_pro_box').val("");
        			$j('#portable_perso_box').val("");
        			$j('#email_pro_box').val("");
        			$j('#email_perso_box').val("");
        			$j('#fonction_box').val("");
        			$j('#site_web_box').val("");


        			$j('.verif_box').html("<img src='./images/ico/ok.png' /> Le contact a été ajouté avec succès.");
        			if(Organisation.id_organisation!="")
					{Organisation.getContactOrganisation(Organisation.id_organisation);}
				else
					{
				getContact();
					}
				
        			
        			}
        	});
        	}
        },
        
        rechercheContact:function(mot)
        {

        	$j.ajax({
        		url : "./index.php?page=ajaxContact&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			
        			mot :  mot,
        			
        			action : "rechercherContact"
        		    
        		},
        		success: function(data){
        			var html="<option value=''>--Sélectionner le contact à lier--</option>";
        			$j.each(data,function(i, obj){
        			html +="<option value='"+obj.id_ben+"'>"+obj.nom+" "+obj.prenom+"</option>";	
        				
        			});
        			
        			$j('#contact_a_rechercher').html(html);
        			$j('#contact_a_rechercher_texte').hide();
        			
        			$j('#contact_a_rechercher').show('fade');
        			$j('#image_retour').show('fade');
        		}
        		
        		});
        },
        inserer_id_organisation : function(id_contact)
        {

        	$j.ajax({
        		url : "./index.php?page=ajaxContact&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			id_contact :  id_contact,
        			id_organisation :  Organisation.id_organisation,
        			
        			action : "inserer_id_organisation"
        		    
        		},
        		success: function(data){
        			Organisation.getContactOrganisation(Organisation.id_organisation);
        		}
        	});
        },
        delete_id_organisation : function(id_contact)
        {

        	$j.ajax({
        		url : "./index.php?page=ajaxContact&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			id_contact :  id_contact,
        			id_organisation :  Organisation.id_organisation,
        			
        			action : "delete_id_organisation"
        		    
        		},
        		success: function(data){
        			Organisation.getContactOrganisation(Organisation.id_organisation);
        		}
        	});
        },
       getTel:function(data)
        {
        	if(data['portable_perso']!="")
        	return "Portable Perso : <strong>" +data['portable_perso']+'</strong>'; 
        	if(data['portable_pro']!="")
        	return "Portable Pro : <strong>" +data['portable_pro']+'</strong>'; 
        	else if(data['tel_pro_1']!="")
        	return "Tel Pro 1 : <strong>" +data['tel_pro_1']+'</strong>'; 
        	else if(data['tel_domicile_1']!="")
        	return "Tel Domicile 1 : <strong>" +data['tel_domicile_1']+'</strong>';
        				
        	
        }
        
    });
    
    var Contact = new Contact();