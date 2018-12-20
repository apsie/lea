    var Calendrier = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
        this.id_lieu = new Array();
        this.id_lieu['matin'] = new Array();
        this.id_lieu['apres_midi'] = new Array();
        
        this.is_recherche_actif = 0;
        this.id_lieu_recherche="";
        this.titre_recherche="";
        this.presta_id_recherche="";
        this.dateTitre="";
        this.contact_rechercher = "";
        	
        },
        getListCalendrier:function(date,id_referent,id_presta)
        {
        	
        	$j('#dateCal').val(date);
        	var thisBis = this;
        	$j('.tooltip').html("");
        	$j('.wait').show();
        	$j.ajax({
        		url : "./index.php?page=ajaxCalendrierv2&noTemplate=1",
        		dataType : "json",
        		data : {
        			date : date,
        			id_referent : id_referent,
        			action : "getListCalendrier"
        		},success: function(data){
 
        			thisBis.dateTitre = data.DATE.DATETITRE ;
        	var html='<center><div style="text-align:center" ><img onclick="Calendrier.getListCalendrier(\''+data.PREVDATE+'\',$j(\'#calendrier_referent\').val());" style="cursor:pointer;" src="./images/ico/fleche_gauche.png" /><img onclick="Calendrier.getListCalendrier(\''+data.NEXTDATE+'\',$j(\'#calendrier_referent\').val());" style="cursor:pointer;" src="./images/ico/fleche_droite.png" /></div><div style="width:99%"><table cellspacing="0" class="tableau_calendrier" >';
        	html +='<tr><td  style="width:10px" class="jour" ></td><td class="jour2">Lundi '+data.DATE.SEMAINE[0]+'.</td><td class="jour">Mardi '+data.DATE.SEMAINE[1]+'.</td><td class="jour2">Mercredi '+data.DATE.SEMAINE[2]+'.</td><td class="jour">Jeudi '+data.DATE.SEMAINE[3]+'.</td><td class="jour2">Vendredi '+data.DATE.SEMAINE[4]+'.</td></tr>';
        	
        	
        	
        	html +='<tr class="paire"><td class="heure" >08:00</td><td id="rdv_8_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*8))+');" class="uniforme"></td><td id="rdv_8_1"  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*8)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*8)+(3600*48))+');" id="rdv_8_2" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*8)+(3600*72))+');" id="rdv_8_3"  class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*8)+(3600*96))+');" id="rdv_8_4"  class="uniforme"></td></tr>';
        	html +='<tr class="impaire" ><td class="heure">09:00</td><td id="rdv_9_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*9))+');"  class="uniforme"></td><td id="rdv_9_1"  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*9)+(3600*24))+');" class="uniforme"></td><td id="rdv_9_2" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*9)+(3600*48))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*9)+(3600*72))+');" id="rdv_9_3" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*9)+(3600*96))+');" id="rdv_9_4" class="uniforme"></td></tr>';
        	html +='<tr class="paire"><td class="heure">10:00</td><td id="rdv_10_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*10))+');" class="uniforme">';
        	//if(data.DATA.CHIFFRE[0])
        	html +='</td><td id="rdv_10_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*10)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*10)+(3600*48))+');" id="rdv_10_2" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*10)+(3600*72))+');" id="rdv_10_3" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*10)+(3600*96))+');"id="rdv_10_4" class="uniforme"></td></tr>';
        	html +='<tr class="impaire"><td class="heure">11:00</td><td id="rdv_11_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*11))+');" class="uniforme"></td><td id="rdv_11_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*11)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*11)+(3600*48))+');" id="rdv_11_2" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*11)+(3600*72))+');"  id="rdv_11_3" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*11)+(3600*96))+');"  id="rdv_11_4" class="uniforme"></td></tr>';
        	html +='<tr class="paire"><td class="heure">12:00</td><td id="rdv_12_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*12))+');" class="uniforme"></td><td id="rdv_12_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*12)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*12)+(3600*48))+');" id="rdv_12_2" class="uniforme"></td><td id="rdv_12_3" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*12)+(3600*72))+');"   class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*12)+(3600*96))+');"   id="rdv_12_4" class="uniforme"></td></tr>';
        	html +='<tr class="impaire"><td class="heure">13:00</td><td id="rdv_13_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*13))+');" class="uniforme"></td><td id="rdv_13_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*13)+(3600*24))+');" class="uniforme"></td><td  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*13)+(3600*48))+');"  id="rdv_13_2" class="uniforme"></td><td  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*13)+(3600*72))+');"   id="rdv_13_3" class="uniforme"></td><td  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*13)+(3600*96))+');" id="rdv_13_4" class="uniforme"></td></tr>';
        	html +='<tr class="paire"><td class="heure">14:00</td><td id="rdv_14_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*14))+');" class="uniforme"></td><td id="rdv_14_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*14)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*14)+(3600*48))+');"  id="rdv_14_2" class="uniforme"></td><td id="rdv_14_3" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*14)+(3600*72))+');"   class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*14)+(3600*96))+');"  id="rdv_14_4" class="uniforme"></td></tr>';
        	html +='<tr class="impaire"><td class="heure">15:00</td><td id="rdv_15_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*15))+');" class="uniforme"></td><td id="rdv_15_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*15)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*15)+(3600*48))+');"  id="rdv_15_2" class="uniforme"></td><td id="rdv_15_3" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*15)+(3600*72))+');"   class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*15)+(3600*96))+');"  id="rdv_15_4" class="uniforme"></td></tr>';
        	html +='<tr class="paire"><td class="heure">16:00</td><td id="rdv_16_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*16))+');" class="uniforme"></td><td id="rdv_16_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*16)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*16)+(3600*48))+');"  id="rdv_16_2" class="uniforme"></td><td  onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*16)+(3600*72))+');"  id="rdv_16_3" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*16)+(3600*96))+');"  id="rdv_16_4" class="uniforme"></td></tr>';
        	html +='<tr class="impaire"><td class="heure">17:00</td><td id="rdv_17_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*17))+');" class="uniforme"></td><td id="rdv_17_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*17)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*17)+(3600*48))+');" id="rdv_17_2" class="uniforme"></td><td id="rdv_17_3" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*17)+(3600*72))+');" class="uniforme"></td><td id="rdv_17_4" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*17)+(3600*96))+');" class="uniforme"></div></td></tr>';
        	html +='<tr class="paire"><td class="heure">18:00</td><td id="rdv_18_0" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*18))+');" class="uniforme"></td><td id="rdv_18_1" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*18)+(3600*24))+');" class="uniforme"></td><td onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*18)+(3600*48))+');" id="rdv_18_2" class="uniforme"></td><td id="rdv_18_3" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*18)+(3600*72))+');" class="uniforme"></td><td id="rdv_18_4" onclick="Template_.getDialogEvent(\'editCalendrier\',600,500,\'\Nouvel évènement\','+ (data.DATE.TPS[0]+(3600*18)+(3600*96))+');" class="uniforme"></div></td></tr>';
        	html +='</table></div></center>';
        	$j('.calendar').html(html);
        	$j('.wait').hide();
        	$j.each(data.DATA,function(i, obj){
        		if(obj.Color!="")
        			{
        			var couleur_titre ='background-color : #'+obj.Color+'';	
        			var couleur ='background : -moz-linear-gradient(#'+obj.Color+',#FFF)';	
        			//var couleur ='background-color:#'+obj.Color+'';
        			}
        		else
        			{
        			var couleur_titre ='background-color : #666';	
        			var couleur ='background : -moz-linear-gradient(#666,#FFF)';	
        			}
        		if(obj.cal_status=="R")
    			{var couleur_titre ='background-color : #000';	
        			var couleur ='background : -moz-linear-gradient(#000,#FFF)';}
        		
        		
        		var duree_ = obj.EndTime - obj.StartTime;
        		//console.debug(duree_);
        		  var height="";
        		  for(i=1;i<(1800*24);i++)
        			  {
        			  //alert(duree_);
        			  if(duree_==1800*i)
	           		   	{
	           		   	height = ';height:'+(20*i-8)+'px';
	           		   	}
        			  }
        		
        		/*  if(duree_==7200)
       		   {
       		   height = ';height:'+72+'px';
       		   }
       		  else if(duree_==10800)
      		   {
      		   height = ';height:'+112+'px';
      		   }
       		  else if(duree_==14400)
         		   {
         		   height = ';height:'+152+'px';
         		   }
        		*/
        		var bdcolor = 'border:2px solid #'+obj.Color+'';
        		if(obj.objet_dispositif==null)
        		obj.objet_dispositif="";
        		if(obj.nom_lieu==null)
            	obj.nom_lieu="";
        		if(obj.cal_cat_name==null)
                obj.cal_cat_name="";
        		var content = "<table><tr><td><strong>Date</strong></td><td>: "+obj.date_debut+"</td></tr><tr><td><strong>Titre</strong></td><td>: "+obj.Subject+"</td></tr></tr>";
        		content +="<tr><td><strong>Type évènement</strong></td><td>: "+obj.cal_cat_name+"</td></tr>";
        		content +="<tr><td><strong>Prestation</strong></td><td>: "+obj.objet_dispositif+"</td></tr>";
        		content +="<tr><td><strong>Lieu</strong></td><td>: "+obj.nom_lieu+"</td></tr>";
        		content +="<tr><td><strong>Status</strong></td><td>: "+obj.cal_status+"</td></tr>";
        		content +="<tr><td><strong>Description</strong></td><td style='width:300px;'>: <textarea rows='5' cols='60'>"+obj.Description+"</textarea></td>";
        		content +="</table>"; 
        		for(a=8;a<=18;a++)
        			{
        		if(data.DATE.TPS[0]+(3600*a)<=obj.StartTime && data.DATE.TPS[0]+(3600*a)>=obj.StartTime)
        		{ $j('#rdv_'+a+'_0').attr('onclick','');
        		if($j('#rdv_'+a+'_0').html()=="")
        			{
        			$j('#rdv_'+a+'_0').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'" id="example-target-'+a+'_0" style="'+couleur+height+'" class="rdv"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,20)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div  >'+obj.Subject.substr(0,25)+'</div></div>');
        			$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_0" >'+content+'</div>');}
        		else
        			{
        			$j('#rdv_'+a+'_0').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'" id="example-target-'+a+'_0_bis" style="'+couleur+height+'" class="rdv_bis"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,13)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,13)+'</div></div>');
        			$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_0_bis" >'+content+'</div>');
        			}
        		}

        		if(data.DATE.TPS[0]+((3600*a)+(3600*24))<=obj.StartTime && data.DATE.TPS[0]+((3600*a)+(3600*24))>=obj.StartTime)
        		{$j('#rdv_'+a+'_1').attr('onclick',''); 
        		if($j('#rdv_'+a+'_1').html()=="")
        			{
        		$j('#rdv_'+a+'_1').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'" id="example-target-'+a+'_1" style="'+couleur+height+'" class="rdv"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,20)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,25)+'</div></div></div>');
        		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_1" >'+content+'</div>');
        			}
        		else
        			{
        			$j('#rdv_'+a+'_1').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'" id="example-target-'+a+'_1_bis" style="'+couleur+height+'" class="rdv_bis"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,13)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,13)+'</div></div>');
            		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_1_bis" >'+content+'</div>');
            		
        			}}
        		
        		if(data.DATE.TPS[0]+((3600*a)+(3600*48))<=obj.StartTime && data.DATE.TPS[0]+((3600*a)+(3600*48))>=obj.StartTime)
        		{ $j('#rdv_'+a+'_2').attr('onclick','');
        		if($j('#rdv_'+a+'_2').html()=="")
        			{$j('#rdv_'+a+'_2').append('<div  onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_2" style="'+couleur+height+'" class="rdv"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,20)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,25)+'</div></div>');
        		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_2" >'+content+'</div>');
        			}
        		else
        			
        			{$j('#rdv_'+a+'_2').append('<div  onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_2_bis" style="'+couleur+height+'" class="rdv_bis"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,13)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,13)+'</div></div>');
            		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_2_bis" >'+content+'</div>');
            		
        			}}
        		
        		if(data.DATE.TPS[0]+((3600*a)+(3600*72))<=obj.StartTime && data.DATE.TPS[0]+((3600*a)+(3600*72))>=obj.StartTime)
        		{ $j('#rdv_'+a+'_3').attr('onclick','');
        		
        		if($j('#rdv_'+a+'_3').html()=="")
        			{	$j('#rdv_'+a+'_3').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')"  id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_3" style="'+couleur+height+'" class="rdv"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,20)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,25)+'</div></div>');
            		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_3" >'+content+'</div>');
        			
        			}
        		else
        		{	$j('#rdv_'+a+'_3').append('<div onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')"  id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_3_bis" style="'+couleur+height+'" class="rdv_bis"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,13)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,13)+'</div></div>');
        		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_3_bis" >'+content+'</div>');}
        	}
        		
        		if(data.DATE.TPS[0]+((3600*a)+(3600*96))<=obj.StartTime && data.DATE.TPS[0]+((3600*a)+(3600*96))>=obj.StartTime)
        		{ $j('#rdv_'+a+'_4').attr('onclick','');
        		
        		if($j('#rdv_'+a+'_4').html()=="")
        			{	$j('#rdv_'+a+'_4').append('<div  onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_4" style="'+couleur+height+'" class="rdv"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,20)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,25)+'</div></div>');
            		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_4" >'+content+'</div>');}
        		else
        		{	$j('#rdv_'+a+'_4').append('<div  onclick="Calendrier.getDialogEditRdv('+obj.Id+','+id_presta+')" id_lieu="'+obj.id_lieu+'"  id="example-target-'+a+'_4_bis" style="'+couleur+height+'" class="rdv_bis"><div style="'+couleur_titre+'" class="titre_rdv" ><span >'+obj.Subject.substr(0,13)+'</span><span class="participant" ><img src="./images/ico/ico_compte.png"> '+obj.NB+'</span></div><div>'+obj.Subject.substr(0,13)+'</div></div>');
        		$j('.tooltip').append('<div style="'+bdcolor+'" class="tool" id="example-content-'+a+'_4_bis" >'+content+'</div>');}
        	}
        		
        		
        		
        		
        		
        		 $j("#example-target-"+a+"_0").ezpz_tooltip();
        		 $j("#example-target-"+a+"_1").ezpz_tooltip();
        		 $j("#example-target-"+a+"_2").ezpz_tooltip();
        		 $j("#example-target-"+a+"_3").ezpz_tooltip();
        		 $j("#example-target-"+a+"_4").ezpz_tooltip();
        		 
        		
        			}
        	});
        	
        	
        		}});
        	
        	if(this.id_lieu_recherche!="")
    		{
        		this.id_lieu = new Array();
                this.id_lieu['matin'] = new Array();
                this.id_lieu['apres_midi'] = new Array();
        		setTimeout(function(){Calendrier.rechercheDispo();},1000);
    		}
        },
        getDialogEditRdv:function(Id,id_presta)
        {
        	
        		
        		
        	$j.ajax({
        		url : "./index.php?page=ajaxCalendrierv2&noTemplate=1",
        		dataType : "json",
        		data : {
        			Id : Id,
        			
        			action : "getDetailsCal"
        		},success: function(data){
        			if(data.id_presta!=null) 
        				{
        				if(confirm('Voulez vous ajouter ce contact au rendez-vous ?'))
                		{
                	$j.ajax({
                		url : "./index.php?page=ajaxCalendrier&noTemplate=1",
                		dataType : "json",
                		data : {
                			cal_id : Id,
                			
                			method : "quickLinkContact"
                		},success: function(data){
                			Calendrier.getCal();
                		}});
                	return false;
                		}
                	
        				}
        			
        			Calendrier.getParticipants(Id);	
        			Calendrier.navigationDialogCalendrier('general');
        			$j('#mot_contact').val('');
        			$j('#id_contact_a_lier').html('');
        			$j('#nb_participant').html('0');
        			$j('#liste_participant').html("");
        			
        			var duree_ = data.EndTime - data.StartTime;
        			
        			
    $j('#liste_participant').html("");
	$j('#CalendarTitle').val(data.Subject);
	$j('#Description').val(data.Description);
	$j('#id_lieu').val(data.id_lieu);
	$j('#id_referent').val(data.id_referent);
	$j('#id_cal_cat').val(data.id_cal_cat);
	$j('#idCal').val(Id);
	$j('#date1').val(data.date);
	if(parseInt(data.heure)<10)
	data.heure = data.heure.replace('0','');
	$j('#heure1').val(data.heure);
	$j('#min1').val(data.min);
	$j('#id_type_evenement').val(data.id_type_evenement);
	$j('#id_prestataire').val(data.id_prestataire),
	$j('#statut_cal').val(data.cal_status);
	
	var nb = duree_/3600;
	
	if((nb)%1!=0)
	var min = '30';
    else
     var min = '00';   
	
	$j('#duree').val('0'+(parseInt(nb))+':'+min);
		
	$j( "#editCalendrier" ).attr("title","Modifier évènement");
	$j( "#editCalendrier" ).dialog({height:600,width:600});
	//lierCalReferent();
	
	$j('#lierCalContact').attr('onclick','Calendrier.lierCalContact('+Id+')');
	$j('#lierCalReferent').attr('onclick','Calendrier.lierCalReferent('+Id+')');
	/*$j('#lierCalReferent').click(function()
			{
			Calendrier.lierCalReferent(Id);
			});
	$j('#lierCalContact').click(function()
			{
			;
			});*/
        		}});
        },
        rechercheContact:function(mot,suffixe)
        {
        	var val="";
        	if(suffixe!=undefined)
        		{
        		 val = suffixe;
        		}

        	$j.ajax({
        		url : "./index.php?page=ajaxContact&noTemplate=1",
        		dataType : "json",
        		data : {
        			
        			
        			mot :  mot,
        			
        			action : "rechercherContact"
        		    
        		},
        		success: function(data){
        			var html;
        			$j.each(data,function(i, obj){
        			html +="<option value='"+obj.id_ben+";"+obj.prenom+";"+obj.nom+"'>"+obj.nom+" "+obj.prenom+"</option>";	
        				
        			});
        			
        			$j('#contact_a_rechercher'+val).html(html);
        			$j('#contact_a_rechercher_texte'+val).hide();
        			
        			$j('#contact_a_rechercher'+val).show('fade');
        			$j('#image_retour'+val).show('fade');
        		}
        		
        		});
        }
        ,
        retourRechercheContact:function(suffixe)
        {
        	var val="";
        	if(suffixe!=undefined)
        		{
        		 val = suffixe;
        		}
        	$j('#contact_a_rechercher'+val).html("");
        	$j('#contact_a_rechercher'+val).hide();
        	$j('#image_retour'+val).hide();
        	$j('#contact_a_rechercher_texte'+val).show("fade");
        	
        },
        rechercheDispo:function()
        {
        	var cal = ($j('#id_cal_cat_recherche').val()).split(';');
        	if(cal[1]==undefined)
        		{
        		cal[1]="";
        		}
        	
        	var contact = new Array();
        	if($j('#contact_a_rechercher').val()!=null)
    		{
        	this.contact_rechercher = $j('#contact_a_rechercher').val();
           contact = 	this.contact_rechercher.split(';');}
        	else
        		{ 
        		contact[2]="";
        		contact[1]="";
        		
        		}
        	
        	this.presta_id_recherche= cal[0];
        	this.titre_recherche = this.dateTitre+'_'+cal[1]+'_'+contact[2]+' '+contact[1];
        	$j('.newRdv').remove();
        	
        	this.id_lieu_recherche = $j('#id_lieu_dispo').val();
        	var id_lieu = $j('#id_lieu_dispo').val();
        	for(i=0;i<=17;i++)
        		{
        		
        		
        		for(a=0;a<=4;a++)
        		{
        			if($j('#example-target-'+i+'_'+a+'').attr('id_lieu')!=undefined && i<=12)
        			{
        		Calendrier.id_lieu["matin"][a] = $j('#example-target-'+i+'_'+a+'').attr('id_lieu') ;
        			}
        			if($j('#example-target-'+i+'_'+a+'').attr('id_lieu')!=undefined && i>=13)
        			{
        		Calendrier.id_lieu["apres_midi"][a] = $j('#example-target-'+i+'_'+a+'').attr('id_lieu') ;
        			}
        		
        		
        		}
        		}
        	
        	for(i=0;i<=17;i++)
    		{
    		
    		
    		for(a=0;a<=4;a++)
    			{
    		
    		
    			
    		if($j('#rdv_'+i+'_'+a+'').html()=="")
    			{
    			
    			if(i==13)
    				{
    				$j('#rdv_'+i+'_'+a+'').append('<div  style="background : -moz-linear-gradient(#AE1F1F,#FFF)" class="rdv"><div style=""background-color:#AE1F1F" class="titre_rdv" >Déjeuner</div><div><img src="./images/ico/cafe.png" /> Déjeuner</div></div>');
    				}
    			else
    				{
    				if(i<=12)
    					{
    				if(id_lieu==Calendrier.id_lieu["matin"][a] || Calendrier.id_lieu["matin"][a]==undefined)
    					{
    			$j('#rdv_'+i+'_'+a+'').append('<div  style="background : -moz-linear-gradient(#DDD,#FFF);border: 1px solid #CCC;color:#000"  class="newRdv"><div style="background-color:#CCC;" class="titre_rdv" >Nouvel évènement</div><div>'+this.titre_recherche.substr(0,25)+'</div> </div>');
    					}
    					}
    				if(i>=13)
					{
				if(id_lieu==Calendrier.id_lieu["apres_midi"][a] || Calendrier.id_lieu["apres_midi"][a]==undefined)
					{
			$j('#rdv_'+i+'_'+a+'').append('<div  style=""background : -moz-linear-gradient(#DDD,#FFF);border: 1px solid #CCC;color:#000"  class="newRdv"><div style="background-color:#CCC;"  class="titre_rdv" >Nouvel évènement</div><div>'+this.titre_recherche.substr(0,25)+'</div></div>');
					}
					}
    				
    				}
    			}
    		
    		}
    		}
        	//console.debug(Calendrier.id_lieu);
        	this.is_recherche_actif = 1;
        },
        getParticipants:function(idCal)
        {
        	$j.ajax({
        		url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        		dataType : "html",
        		data : {
        			
        			idCal : idCal,
        			method : "getParticipants"
        		    
        		},
        		success: function(html){
        			
        				
        			$j('#liste_participants').html(html);
        			
        			
        			
        			/*var html="";
        			var compt =0;
        			$j.each(data.DATA_COMPTES,function(i, obj){
        				html +='<tr><td ><img src="./images/ico/ico_compte.png"> '+obj.account_firstname+ ' ' +obj.account_lastname+' </td>';
        				html +='<td></td>';
        				html +='<td><img style="cursor:pointer" onclick="Calendrier.deleteParticipant('+obj.account_id+',\'compte\')" src="./images/ico/croix.png"></td></tr>';
        			compt++;});
        			
        			$j.each(data.DATA_CONTACT,function(i, obj){
        			if(obj.id_ben!=null)
        			{
        				html +='<tr><td ><img src="./images/ico/ico_contact.png"> '+obj.prenom+ ' ' +obj.nom+' </td>';
        				
        				html +='<td><select><option>P</option><option>A</option><option>R</option></select> </td>';
        				html +='<td><img style="cursor:pointer" onclick="Calendrier.deleteParticipant('+obj.id_ben+',\'contact\')" src="./images/ico/croix.png"></td></tr>';
        			compt++;}
        			});
        			
        			$j('#liste_participant').html(html);
        			$j('#nb_participant').html(compt);*/
        			}
        		});
        	},

        	 navigationDialogCalendrier:function(classe_a_voir)
        	{
        		$j('.dialog_general').hide();
        		$j('.dialog_participant').hide();
        		$j('#cal_menu_general').attr('class','cal_menu_general');
        		$j('#cal_menu_participant').attr('class','cal_menu_participant');
        		$j('.dialog_'+classe_a_voir).show('fade');
        		$j('#cal_menu_'+classe_a_voir).attr('class','cal_menu_'+classe_a_voir+'_active');
        		
        		

        	},
        	
        	
        	rechecherContact:function()
        	{


        		$j.ajax({
        			url : "./index.php?page=ajaxContact&noTemplate=1",
        			dataType : "json",
        			data : {
        				
        				
        				mot :  $j('#mot_contact').val(),
        				
        				action : "rechercherContact"
        			    
        			},
        			success: function(data){
        				var html;
        				$j.each(data,function(i, obj){
        				html +="<option value="+obj.id_ben+";"+obj.prenom+";"+obj.nom+">"+obj.nom+" "+obj.prenom+"</option>";	
        					
        				});
        				$j('#id_contact_a_lier').html(html);
        			}
        			
        			});
        		
        	},
        	lierCalContact:function(id)
        	{
        		var c = new Array();
        		var boolnew;
        		if($j('#id_contact_a_lier').val())
        			{
	        		c = $j('#id_contact_a_lier').val().split(';');
	        		boolnew=0;
        			}
        		else if($j('#contact_a_rechercher').val())
    			{
        			c = $j('#contact_a_rechercher').val().split(';');
        			boolnew=1;
    			}
        		
        		
        		$j.ajax({
        			url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        			dataType : "json",
        			data : {
        				
        				
        				
        				cal_id : id,
        				id_contact :  c[0],
        				
        				method : "lierCalContact"
        			    
        			},
        			success: function(data){
        				//if(boolnew ==0)
        				Calendrier.getParticipants(id);
        			
        			}});
        		
        	},
        	lierCalReferent:function(id)
        	{
        		var r = new Array();
        		if($j('#id_referent_a_lier').val()!="")
        		{var r = $j('#id_referent_a_lier').val().split('-');
        		}
        		else
        		{
        			
        			r[0] = $j('#calendrier_referent').val();
        			/*r[1] = VARTEMPS['COMPTES']['PRENOM'];
        			r[2] = VARTEMPS['COMPTES']['NOM'];*/
        		}
        			
        		

        		
        		$j.ajax({
        			url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        			dataType : "json",
        			data : {
        				
        				
        				id_referent :  r[0],
        				cal_id : id,
        				
        				
        				method : "lierCalReferent"
        			    
        			},
        			success: function(data){
        			
        				Calendrier.getParticipants(id);
        			
        			}});

        		
        		
        	},
        	deleteParticipant:function(idCal,id,type)
        	{
        		$j.ajax({
        			url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        			dataType : "json",
        			data : {
        				
        				id_participant : id,
        				type : type,
        				method : "deleteParticipant"
        			    
        			},
        			success: function(data){
        				
        				Calendrier.getParticipants(idCal);
        			
        		}});
        		
        	},
        	
        	   addEvent:function()
            {
            	
        		
    if($j('#idCal').val()=="")
    { var method="add";}
    else
    {var method="update";

    }
                var strDeb = $j('#date1').val().split('/');
                var duree = $j('#duree').val().split(':');
                //console.debug(parseInt($j('#heure1').val())+parseInt(duree[0]));
                if((parseInt($j('#min1').val())+parseInt(duree[1])==60))
                {var addmin = 0;
                    duree[0] = parseInt(duree[0])+1;
                    }
                else
                {var addmin = parseInt($j('#min1').val())+parseInt(duree[1]);}
                
                var dateDebut = strDeb[1]+'/'+strDeb[0]+'/'+strDeb[2]+' '+$j('#heure1').val()+':'+$j('#min1').val();
                var dateFin = strDeb[1]+'/'+strDeb[0]+'/'+strDeb[2]+' '+(parseInt($j('#heure1').val())+parseInt(duree[0]))+':'+addmin;

            	$j.ajax({
        			url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        			dataType : "json",
        			data : {
        				CalendarEndTime : dateFin ,
        				CalendarStartTime :	dateDebut,
        				CalendarTitle : $j('#CalendarTitle').val(),
        				Description : $j('#Description').val(),
        				id_lieu : $j('#id_lieu').val(),
        				id_referent : $j('#id_referent').val(),
        				id_cal_cat : $j('#id_cal_cat').val(),
        				IsAllDayEvent : 0,
        				timezone : 2,
        				idCal : $j('#idCal').val(),
        				id_type_evenement : $j('#id_type_evenement').val(),
        				id_prestataire : $j('#id_prestataire').val(),
        				statut_cal : $j('#statut_cal').val(),
        				id_presta : $j('#id_presta').val(),
        				id_referent : $j('#calendrier_referent').val(),
        				method : method
        			    
        			},
        			success: function(data){
        				if(data.cal_id)
        				Calendrier.lierCalContact(data.cal_id);	
        				
            			$j('#editCalendrier').dialog('close');
            			Calendrier.getCal();
            			setTimeout(function(){
            			if(Calendrier.is_recherche_actif==1)
            			{
            				
                    			Calendrier.rechercheDispo();
                    			
            			}
            			},1000);
        	             }
            	});
            },
            
           delEvent:function()
            {
            if(!confirm('Etes vous sûr de vouloir supprimer ce rendez vous ?'))
            return false;
        		
    
          
            
            	$j.ajax({
        			url : "./index.php?page=ajaxCalendrier&noTemplate=1",
        			dataType : "json",
        			data : {
        				
        				idCal : $j('#idCal').val(),
        				method : 'del'
        			    
        			},
        			success: function(data){
            			$j('#editCalendrier').dialog('close');
            			Calendrier.getCal();
            			setTimeout(function(){
            			if(Calendrier.is_recherche_actif==1)
            			{
            				
                    			Calendrier.rechercheDispo();
                    			
            			}
            			},1000);
        	             }
            	});
            },
            
            
            getCal:function(id_presta)
            {
            	Calendrier.getListCalendrier($j("#dateCal").val(),$j("#calendrier_referent").val(),id_presta);
            },
            
            getRecherche:function()
            {
            	$j( "#dialogRechercheCal" ).attr("title","Recherche de ' "+$j("#mot_recherche").val()+" '  sur le calendrier");
            	$j( "#dialogRechercheCal" ).dialog({height:900,width:1200});

            	var pager="<div class='pager' id='pager'>	<form><table><tr><td>";
            	pager +='<img src="./images/ico/first.png" class="first"/><img src="./images/ico/prev.png" class="prev"/> Page : <input type="text" size="4" class="pagedisplay"/> ';
            	pager +='<img src="./images/ico/next.png" class="next"/>';
            	pager +='<img src="./images/ico/last.png" class="last"/>';
            	pager +=' - <span class="nb_resultats"></span> résultats - Afficher <select class="pagesize"><option selected="selected"  value="10">10</option><option  value="30">30</option></select> lignes</form></td></tr></table></div>';
            	
            	
            	$j('.page_recherche').html(pager);
            	
          	$j.ajax({
          		url : "./index.php?page=ajaxCalendrier&noTemplate=1",
          		dataType : "json",
          		data : {
          			mot : $j("#mot_recherche").val(),
          			method : "recherche"
          		    
          		},
          		success: function(data){
          			//console.debug('%o',data);
         var html='<table id="myTable" cellspacing="1" class="tablesorter"><thead><tr> ';

          html +='<th>Début & Fin</th><th>Titre & Description</th><th>Propriétaire</th><th>Emplacement</th><th>Participant</th><th></th>';

          html +='</thead></tr><tbody>';
          $j.each(data,function(i, obj){
          
          	
          	 html += "<tr><td>"+obj.DATEDEB+"<br/>"+obj.DATEFIN+"</td>";
          	 html += "<td><strong>"+obj.Subject+"</strong><br/><textarea cols='60'>"+obj.Description+"</textarea></td>";
          	 html += "<td>"+obj.prenom_proprietaire+" "+obj.nom_proprietaire+"</td>";
          	 html += "<td>"+obj.nom_lieu+"</td>";
          	 html += "<td>"+obj.prenom_referent+" "+obj.nom_referent+"</td>";
          	 html += "<td><img style='cursor:pointer' onclick='Calendrier.getDialogEditRdv("+obj.Id+")' src='./images/ico/edit.png' /></td></tr>";
          	  });
         
         html +="</tbody></table>";

          $j('.contenu_recherche').html(html);
          $j("#myTable").tablesorter({ widgets: ['zebra'] })
          			 .tablesorterPager({container: $j("#pager"),positionFixed: false });
                  
          	}});
          	
          	}
            ,
            deleteSessionIdPresta:function()
            {
            	
             	$j.ajax({
              		url : "./index.php?page=ajaxCalendrier&noTemplate=1",
              		dataType : "json",
              		data : {
              			
              			method : "deleteSessionIdPresta"
              		    
              		},
              		success: function(data){
              			$j('#temp_id_presta').hide('fade');
              		}
              		});
            	
            },
           controleRdv:function(id_contact,id_presta,presta)
            {

                //On récupère les informations du bénéficiaire
            	$j.ajax({
                      		url : "./index.php?page=rdvControl&noHeader=1",

                            data : {   			
                          		id_contact 		:	id_contact,
                          		id_presta		:	id_presta,
                          		presta		:	presta
                      		    
                      		},
                      		success: function(data){
                      			$j('#div_rdv_control').html(data);
                          		/*var question = data.DATA[0]['nom_complet']+' est t\'il présent ?';
                          		var info ="<br/>"+Contact.getTel(data.DATA[0]);
                          		    $j('.question').html(question);
                          		    $j('.info').html(info);*/
                      		}
                        });
            		
            }

        
        
    });
    
    var Calendrier = new Calendrier();