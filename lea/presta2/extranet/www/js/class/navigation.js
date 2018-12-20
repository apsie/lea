    var Navigation = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
           this.Tab_id_ref="";
           this.Tab_id_dispositif="";
           this.Tab_statut="";
           this.Tab_mot="";
        },
        showTableauPresta:function(category)
        {
        	
        	category = category.split(';');
        	 this.Tab_id_ref=  category[0];
             this.Tab_id_dispositif =  category[1];
             this.Tab_statut =  category[2];
             this.Tab_mot =  category[3];
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			id_ref : category[0],
        			id_dispositif : category[1],
        			statut : category[2],
        			mot : category[3],
        			
        			action : "getPrestationByRef"
        		    
        		},
        		success: function(data){
        			var html='<a onclick="$j(\'#myTable\').hide(\'fade\');" href="javascript:void(0);">Graphisme</a> | <a onclick="$j(\'#myTable\').show(\'fade\');" href="javascript:void(0);">Liste</a>';
        			html +="<table id='myTable'  cellspacing='1'  class='tablesorter'><thead><tr><th>Prestataire</th><th>Prestation</th><th>Bénéficiaire</th><th>ID.Prestation</th><th>Début</th><th>Fin</th><th>Fin réelle</th>"; 
       				html +="<th>Envoi du bilan</th><th>RDV P</th><th>RDV A</th><th>RDV R</th><th>Conseiller</th><th>Lieu</th><th>%</th><th>Statut</th><th></th></tr></thead><tbody>";
        			$j.each(data,function(i, obj){
        				//version 1
        				
        				if(obj.famille_presta=="OPCREA" || obj.famille_presta=="OE" || obj.famille_presta=="OPCRE" || obj.famille_presta=="OEM" )
        					{
        					if(obj.statut=="Nouvelle")
        						{	//version2
        						var lien="Calendrier.controleRdv("+obj.id_ben+","+obj.id_presta+",\""+obj.famille_presta+"\");";			
        						}
        					else
        						{
        						var lien="Calendrier.controleRdv("+obj.id_ben+","+obj.id_presta+",\""+obj.famille_presta+"\");";	
        						}
        					}
        				else if(obj.famille_presta=="EPCE" || obj.famille_presta=="NACRE1" ||  obj.famille_presta=="NACRE3" )
    					{
    				if(obj.statut=="Nouvelle")
    					{
    					var lien ="window.open(\"./presta/epce/premier_rdv.php?lc="+obj.lettre_de_commande+" &presta="+obj.presta+"&id_presta="+obj.id_presta+"&intitule="+obj.intitule+"&id="+VARTEMPS['COMPTES']['ID']+"&id_ben="+obj.id_ben+"\",\"PREMIER RENDEZ VOUS EPCE\",\"toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=420, height=330\");";
    			
    					}
    				else
    					{
    					var lien ="window.open(\"./presta/epce/control.php?lc="+obj.lettre_de_commande+"&presta="+obj.famille_presta+"&id_presta="+obj.id_presta+"&intitule="+obj.intitule+"&id="+VARTEMPS['COMPTES']['ID']+"&id_ben="+obj.id_ben+"&continuer=1\",\"control\",\"toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\");";
    	    			
    					}
        				}
        				
                        // SPIREA - Lien vers la fiche du beneficiaire
                        var lien_presta = "window.open(\"./presta/epce/presentation/panel.php?lc="+obj.lettre_de_commande+"&type_presta="+obj.famille_presta+"&id_presta="+obj.id_presta+"&choix="+obj.id_ben+"\",\"control\",\"toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=728\");";
        			
        				if(obj.NB_P==null)
        					{
        					obj.NB_P=0;
        					}
        				if(obj.NB_A==null)
    					{
    					obj.NB_A=0;
    					}
        				if(obj.NB_R==null)
    					{
    					obj.NB_R=0;
    					}
        				if(obj.nom_lieu==null)
    					{
    					obj.nom_lieu= "?";
    					}
        				html +="<tr><td>"+obj.prestataire+"</td><td>"+obj.presta+"</td><td><a onclick='"+lien_presta+"' style='text-decoration:underline' href='javascript:void(0);'>"+obj.intitule+"</a></td><td><a onclick='"+lien+"' style='text-decoration:underline' href='javascript:void(0);'>"+obj.lettre_de_commande+"</a></td><td>"+obj.DATEDEB+"</td><td>"+obj.DATEFIN+"</td><td>"+obj.DATEFINREL+"</td><td>"+obj.DATEENVOI+"</td><td align='center'>"+obj.NB_P+"</td><td align='center'>"+obj.NB_A+"</td><td align='center'>"+obj.NB_R+"</td><td>"+obj.account_firstname+" "+obj.account_lastname+"</td><td>"+obj.nom_lieu+"</td><td align='center'>"+obj.pourcent_epce+"%</td><td>"+obj.statut+"</td><td><img onclick='Template_.afficherPopUpPresta("+obj.id_presta+")' style='cursor:pointer' src='./images/ico/edit.png' /></td></tr>";
        			});
        			html +='<tbody></table>';
                	$j('#presta_tableau').show('fade');
                	$j('#presta_tableau').html(html+'<br/><br/><br/><hr/><br/>');
        			$j("#myTable").tablesorter({ widgets: ['zebra'] });
        						
        			}
        		});
        	
        	
        	
        },
      showHide:function(idTable)
        {
        	
        	if($j('#'+idTable).css('display') == "block" )
        	{
        		$j('#'+idTable).hide('blind');
        		
        	}
        	else
        	{
        		$j('#'+idTable).show('blind');
        	}
        },
        navigationDialogProjet:function(classe_a_voir)
     	{
     		$j('.dialog_general_projet').hide();
     		$j('.dialog_entreprise').hide();
     		$j('#projet_menu_general_projet').attr('class','projet_menu_general_projet');
     		$j('#projet_menu_entreprise').attr('class','projet_menu_entreprise');
     		$j('.dialog_'+classe_a_voir).show('fade');
     		$j('#projet_menu_'+classe_a_voir).attr('class','projet_menu_'+classe_a_voir+'_active');

     	},

      
        
    });
    
    var Navigation_ = new Navigation();