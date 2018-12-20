    var Template  = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
          this.idCompte;
        }, 
        setTemplateDispositif:function(idCompte,mot)
        {
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1&noHeader=1",
        		dataType : "json",
        		data : {
        			
        			is_active : 1,
        			
        			action : "getDispositif"
        		    
        		},
        		success: function(data){
        			var html='';
        			$j('#presta_graph').html("");
        			$j.each(data,function(i, obj){
        				
        				var html ='<div style="float:left;margin:10px" ><div id="dispositif_'+obj.id_dispositif+'" ></div><div id="subtitle_'+obj.id_dispositif+'" ></div></div>';
        				
        				$j('#presta_graph').append(html);
        				
        				
        				Graph_.drawPie(obj.id_dispositif,idCompte,'Prestation '+obj.objet+'','dispositif_'+obj.id_dispositif+'',''+mot+'');
        				

        				
        				
        			});
        		
        			}
        		});
        },
        afficherLegendePresta:function(id)
        {
        	var html="<div style='width:400px'>";
        	
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['Nouvelle']+"'></div><div style='float:left;margin-right:15px;'>Nouvelle</div>";
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['En cours']+"'></div><div style='float:left;margin-right:15px;'>En cours</div>";
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['Complete']+"'></div><div style='float:left;margin-right:15px;'>Complète</div>";
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['A cloturer']+"'></div><div style='float:left;margin-right:15px;'>A clôturer</div></div>";
        	   html +="<div style='width:300px'>";
        		
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['Abandon']+"'></div><div style='float:left;margin-right:13px;'>Abandon</div>";
        		html +="<div style='float:left;margin-left:5px;margin-right:10px;width:10px;height:10px;background-color:"+Color_.parametre['Annulee']+"'></div><div style='float:left;margin-right:15px;'>Annulee</div>";
        		
        		html +="</div>";
        	
        		$j('#'+id).html(html);
        },
        afficherPopUpPresta:function(idPresta)
        {
        	this.getDialog("dialogPresta",350,350);
        	  $j( "#date_debut" ).datepicker($j.datepicker.regional[ "fr" ]);
        	  $j( "#date_fin_pre" ).datepicker($j.datepicker.regional[ "fr" ]);
        	  $j( "#date_fin_reelle" ).datepicker($j.datepicker.regional[ "fr" ]);
        	  $j( "#date_envoi" ).datepicker($j.datepicker.regional[ "fr" ]);
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1",
        		dataType : "json",
        		data : {
        			idPresta : idPresta,
        			action : "getPrestationByIdPresta"
        		},success: function(data){

        		
        			
        			$j('#prestataire').html(data.prestataire);
        			$j('#prestation').html(data.presta);
        			$j('#beneficiaire').html(data.intitule);
        			$j('#lc').val(data.lettre_de_commande);
        			$j('#conseiller').val(data.id_ref);
        			$j('#date_debut').val(data.DATEDEB);
        			$j('#date_fin_pre').val(data.DATEFIN);
        			$j('#date_fin_reelle').val(data.DATEFINREL);
        			$j('#date_envoi').val(data.DATEENVOI);
        			$j('#statut').val(data.statut);
        			$j('#id_presta').val(data.id_presta);
        			
        			//$j('#buttonPresta').attr('onclick','Presta_.updatePresta('+data.id_presta+',\''+data.lettre_de_commande+'\','+data.id_ref+','+data.date_debut+','+data.date_fin+','+data.date_fin_reelle+','+data.date_envoi_bilan+',\''+data.statut+'\')');
        		}
        		});
        	
        	
        },
        getDialog:function(id,width,height)
        {
        
    	$j( "#"+id ).dialog({height:height,width:width});
        },
        getDialogEvent:function(id,width,height,titre,tps)
        {
        	

        	$j.ajax({
        		url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			
        			method : "SESSION_DELETE_PARTICIPANT"
        		    
        		},
        		success: function(data){
        			Calendrier.navigationDialogCalendrier('general');
        			$j('#mot_contact').val('');
        			$j('#id_contact_a_lier').html('');
        			$j('#nb_participant').html('0');
        			$j('#liste_participant').html("");
        		}});
        	$j('#CalendarTitle').val("");
			$j('#Description').val("");
			$j('#id_lieu').val("");
			$j('#id_referent').val("");
			$j('#id_cal_cat').val("");
			$j('#idCal').val("");
			$j('#id_type_evenement').val("");
			$j('#id_prestataire').val(""),
			$j('#statut_cal').val("");
        		
			if(Calendrier.titre_recherche!="" &&  Calendrier.is_recherche_actif==1)
				{
				$j('#CalendarTitle').val(Calendrier.titre_recherche);
				$j('#id_lieu').val($j('#id_lieu_dispo').val());
				$j('#id_type_evenement').val(1);
				$j('#id_cal_cat').val(Calendrier.presta_id_recherche);
				
				
				}
        	$j( "#editCalendrier" ).attr("title","Fiche évènement");
        	$j( "#editCalendrier" ).dialog({height:600,width:600});
        	Calendrier.lierCalReferent();
        	//alert(Calendrier.contact_rechercher);
        	if(Calendrier.contact_rechercher!="")
        		{
        		Calendrier.lierCalContact(Calendrier.contact_rechercher);
        		}
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxCalendrierv2&noTemplate=1",
        		dataType : "json",
        		data : {
        			tps : tps,
        			action : "getDateTps"
        		},success: function(data){
        		
        			
        			var h;
        			if(parseInt(data.heure)<10)
        			h = data.heure.replace('0','');
        			else
        			h = data.heure;
        			
        			//console.debug(h);
        			$j( "#date1" ).val(data.date);
        			$j( "#heure1" ).val(h);
        			$j( "#min1" ).val(data.min);
                	
            	  
        		}});
        		
        
        
        },
        getDetailsEvenement:function(id,width,height,id_evenement,resultat)
        {
        	
        	$j('#resultat_statut').html("");
        	if(resultat==1)
        		{
        		
        		$j('#resultat_statut').html(" <img src='./images/ico/ok.png' />");
        		}
        	Evenement.id_evenement = id_evenement;
        
    	$j( "#"+id ).dialog({height:height,width:width});
    	$j.ajax({
    		url : "./index.php?page=ajaxEvenement&noTemplate=1",
    		dataType : "json",
    		data : {
    			id_evenement : id_evenement,
    			action : "getListEvenement"
    		},success: function(data){
    		
    			$j('#details_id_evenement').html('<strong>'+data.DATA[0]['id_evenement']+'</strong>');
    			$j('#details_date').html(data.DATA[0]['date_creation']);
    			$j('#details_objet').html(data.DATA[0]['objet']);
    			$j('#details_conseiller').html(data.DATA[0]['account_firstname']+' '+data.DATA[0]['account_lastname']);
    			$j('#details_nom').html(data.DATA[0]['nom']+' '+data.DATA[0]['prenom']);
    			$j('#details_fonction').html(data.DATA[0]['fonction']);
    			$j('#details_tel').html(data.DATA[0]['tel']);
    			$j('#details_email').html(data.DATA[0]['email']);
    			$j('#details_degre').html(data.DATA[0]['degre']);
    			$j('#details_owner').html(data.DATA[0]['account_firstname_ow']+' '+data.DATA[0]['account_lastname_ow']);
    			$j('#details_statut').val(data.DATA[0]['statut']);
    			$j('#details_observations').html(data.DATA[0]['observations']);
    		}});
    	$j.ajax({
    		url : "./index.php?page=ajaxEvenement&noTemplate=1",
    		dataType : "json",
    		data : {
    			id_evenement : id_evenement,
    			action : "getHistoriqueEvenement"
    		},success: function(data){
    		
    			var html="";
    			$j.each(data,function(i, obj){
    				html +="<strong>"+obj.date+"</strong> - <img src='./images/ico/user_business.png'> "+obj.account_firstname+" "+obj.account_lastname+"<br/>"+obj.message+"<br/>";
    			});
    			$j('#details_message').html(html);
    			
    			
    		}});
    	
    	Evenement.updateEvenementRead();
    		
        },
        addEvent:function()
        {
        	$j( "#addEvent" ).attr("title","Créer un évènement");
        	$j( "#addEvent" ).dialog({height:750,width:800});	
        }
         
      
        });
     
        
      
   
   
    
var Template_ = new Template();