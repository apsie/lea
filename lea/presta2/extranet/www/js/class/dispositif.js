    var Dispositif = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
        	
        },
        getDispositif:function()
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
    		url : "./index.php?page=ajaxDispositif&noTemplate=1",
    		dataType : "json",
    		data : {
    		is_active : $j("#etat").val(),
    	
    		action : "getDispositif"
    		    
    		},
    		success: function(data){
    			

    var html='<table id="myTable" cellspacing="1" class="tablesorter"><thead><tr><th>Nom du dispositif</th><th>Numéro de marché</th><th>Objet</th><th>Date de début</th><th>Date de fin</th><th>Etat</th> ';
    html +='<th></th></thead></tr><tbody>';


    			$j.each(data.DATA,function(i, obj){
    				if(obj.is_active==1)
    					{obj.is_active="Actif";}
    				else
    					{obj.is_active="Inactif";}
    				html +='<tr>';
    				
    				
    					html +='<td><a href="javascript:void(0);" onclick="Dispositif.addDispositifBox('+obj.id_dispositif+');" >'+obj.nom_dispositif+'</a></td><td>'+obj.numero_marche+'</td><td>'+obj.objet+'</td><td>'+obj.date_debut+'</td><td>'+obj.date_fin+'</td><td>'+obj.is_active+'</td>';
    				html +='<td><img style="cursor:pointer" onclick="Dispositif.addDispositifBox('+obj.id_dispositif+');"  src="./images/ico/edit.png" /></td></tr>';
    			});

    			html +="<tbody></table>";
    			$j('.contenu_flex').html(html);
    if(data.TOTAL!=0)
    {

    			
    			$j("#myTable").tablesorter({ widgets: ['zebra'] })
    						 .tablesorterPager({container: $j("#pager"),positionFixed: false });
    }
   
    			$j('.nb_resultats').html(data.TOTAL);

    			
    			
    		
    		
    			
    			//$j('.recherche').show();
    }
    	});	


		
    		



    

        },
        addDispositifBox:function(id_dispositif)
        {
        	$j('#id_dispositif').val("");
      		$j('#nom_dispositif').val("");
      		$j('#numero_marche').val("");
      		$j('#objet_dispositif').val("");
      		$j('#date_debut_dispositif').val("");
      		$j('#date_fin_dispositif').val("");
      		$j('#is_active').val("");
        	
        	if(id_dispositif!=undefined)
        		{
        		
        		//$j('#div_recherche_contact_projet').hide();
        		//$j('#tr_date_fin_projet').show();
        		var title="Fiche Dispositif : Modification du dispositif";
        		
        
               Dispositif.getDispositifById(id_dispositif);
            	
            	
         
				
        		}
        	else
        		{
        		//$j('#div_recherche_contact_projet').show();
        		//$j('#tr_date_fin_projet').hide();
        		var title="Fiche Dispositif : Créer un dispositif";
        		
        		}
        	$j('.verif_box').html("");
        	$j( "#dispositif_box" ).attr("title",title);
        	$j( ".ui-dialog-title" ).html(title);
        	
        	$j( "#dispositif_box" ).dialog({height:280,width:300});
        	
        	
        	
        	
        	
        }
        ,addDispositif:function()
        {
        	
        		
        		
        	  $j.ajax({
          		url : "./index.php?page=ajaxDispositif&noTemplate=1",
          		dataType : "json",
          		data : {
          		id_dispositif : $j('#id_dispositif').val(),
          		nom_dispositif : $j('#nom_dispositif').val(),
          		numero_marche : $j('#numero_marche').val(),
          		objet : $j('#objet_dispositif').val(),
          		date_debut : $j('#date_debut_dispositif').val(),
          		date_fin : $j('#date_fin_dispositif').val(),
          		is_active : $j('#is_active').val(),
          		
          		action : "addDispositif"
          		    
          		},
          		success: function(data){
          			$j('#id_dispositif').val("");
              		$j('#nom_dispositif').val("");
              		$j('#numero_marche').val("");
              		$j('#objet_dispositif').val("");
              		$j('#date_debut_dispositif').val("");
              		$j('#date_fin_dispositif').val("");
              		$j('#is_active').val("");
              		$j( "#dispositif_box" ).dialog("close");
          			Dispositif.getDispositif();	
          		}});
        }
        
        ,getDispositifById:function(id_dispositif)
        {
        	var retour =   $j.ajax({
          		url : "./index.php?page=ajaxDispositif&noTemplate=1",
          		dataType : "json",
          		data : {
          		id_dispositif : id_dispositif,
          		action : "getDispositif"
          		    
          		},
          		success: function(data){
          			$j('#id_dispositif').val("");
              		$j('#nom_dispositif').val("");
              		$j('#numero_marche').val("");
              		$j('#objet_dispositif').val("");
              		$j('#date_debut_dispositif').val("");
              		$j('#date_fin_dispositif').val("");
              		$j('#is_active').val("");
                	
              		$j('#id_dispositif').val(id_dispositif);
              		$j('#nom_dispositif').val(data.DATA[0]['nom_dispositif']);
              		$j('#numero_marche').val(data.DATA[0]['numero_marche']);
              		$j('#objet_dispositif').val(data.DATA[0]['objet']);
              		$j('#date_debut_dispositif').val(data.DATA[0]['date_debut']);
              		$j('#date_fin_dispositif').val(data.DATA[0]['date_fin']);
              		$j('#is_active').val(data.DATA[0]['is_active']);
              		
                	
                	
                	
          			
    				
    				
          			}
          		
        	  });
        	
        	 // console.debug(Projet.arrayOrg_v2);
        		//return arrayOrg[Projet.idOrganisation];
        }
        
        
    });
    
    var Dispositif = new Dispositif();