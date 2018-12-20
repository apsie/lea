    var Evenement = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
        	this.id_evenement;
            
        },
        getListEvenement:function()
        {
        	
        	
        	$j('#liste_evenement').html("<center><img src='./images/ico/load.gif' /></center>");
        	var pager="<div  class='pager' id='pager'>	<form><table><tr><td>";
        	pager +='<img src="./images/ico/first.png" class="first"/><img src="./images/ico/prev.png" class="prev"/> Page : <input type="text" size="4" class="pagedisplay"/> ';
        	pager +='<img src="./images/ico/next.png" class="next"/>';
        	pager +='<img src="./images/ico/last.png" class="last"/>';
        	pager +=' <select onchange="Evenement.getListEvenement()"  id="liste_conseiller" ></select> - <select onchange="Evenement.getListEvenement()" id="liste_statut" ></select> - <select onchange="Evenement.getListEvenement()" id="liste_lu" ></select> - Afficher <select class="pagesize"><option selected="selected"  value="30">30</option><option  value="60">60</option></select> lignes</form></td></tr></table></div>';
        	//var champ = $j('#select_champ').val();
        	//$j('.load').show();
        	if($j('.page').html()=="")
        		{
        	$j('.page').html(pager);
        		}
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxEvenement&noTemplate=1",
        		
        		dataType : "json",
        		data : {
        			id_referent : $j('#liste_conseiller').val(),
        			statut : $j('#liste_statut').val(),
        			is_read : $j('#liste_lu').val(),
        			action : "getListEvenement"
        		},success: function(data){
        			
        			$j('#liste_conseiller').html(data.CONSEILLERS);
        			$j('#liste_statut').html(data.STATUT);
        			$j('#liste_lu').html(data.LU);
var html='<table id="myTable_evenement" cellspacing="1" class="tablesorter"><thead><tr> ';
        			
        			html +='<th>ID</th><th>Date</th><th>Objet</th><th>Type d\'évènement</th><th>Nom du contact</th><th>Fonction</th><th>Tel</th><th>Référent</th><th>Degré</th><th>Statut</th><th></th></thead></tr><tbody>';

        						$j.each(data.DATA,function(i, obj){
        							
        							if(obj.is_read==0)
        								{
        								var style="font-weight:bolder;";
        								}
        							else
        								{
        								var style="";
        								}
        							html +='<tr style="'+style+'"><td>'+obj.id_evenement+'</td><td>'+obj.date_creation+'</td><td>'+obj.objet+'</td><td>'+obj.type_evenement+'</td><td>'+obj.nom+' '+obj.prenom+'</td><td>'+obj.fonction+'</td><td>'+obj.tel+'</td><td>'+obj.account_firstname+' '+obj.account_lastname+'</td><td>'+obj.degre+'</td><td>'+obj.statut+'</td><td><img onclick="Template_.getDetailsEvenement(\'detailsEvenement\',1000,600,'+obj.id_evenement+')" style="cursor:pointer" src="./images/ico/edit.png" /></td></tr>';
        							
        							
        });

        						html +="</tbody></table>";

        						//alert(html);
        						$j('#liste_evenement').html(html);
        						$j("#myTable_evenement").tablesorter({ widgets: ['zebra'] })
        						.tablesorterPager({container: $j("#pager"),positionFixed: false });
   
 
        		}});
        },
        addMessage:function()
        {
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxEvenement&noTemplate=1",
        		
        		dataType : "json",
        		data : {
        			id_referent : VARTEMPS['COMPTES']['ID'],
        			id_evenement : Evenement.id_evenement,
        			message : $j('#message').val(),
        			action : "addMessage"
        		},success: function(data){
        			
        			Template_.getDetailsEvenement('detailsEvenement',1000,600,Evenement.id_evenement);

        			$j('#message').val("");
   
 
        		}});
        	
        },
        updateEvenement:function()
        {
        	$j('#resultat_statut').html("");
        	$j.ajax({
        		url : "./index.php?page=ajaxEvenement&noTemplate=1",
        		
        		dataType : "json",
        		data : {
        			id_modifier : VARTEMPS['COMPTES']['ID'],
        			id_evenement : Evenement.id_evenement,
        			statut : $j('#details_statut').val(),
        			action : "updateEvenement"
        		},success: function(data){
        			
        			
        			Template_.getDetailsEvenement('detailsEvenement',1000,600,Evenement.id_evenement,1);

        			
   
 
        		}});
        	
        },
        updateEvenementRead:function()
        {
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxEvenement&noTemplate=1",
        		
        		dataType : "json",
        		data : {
        			id_evenement : Evenement.id_evenement,
        			is_read : 1,
        			action : "updateEvenementRead"
        		},success: function(data){
        			
        			
        			

        			
   
 
        		}});
        	
        },
        addEvent:function(radio)
        {
        	 
        	      for (var i=0; i<radio.length;i++) {
        	         if (radio[i].checked) {
        	           var degre = radio[i].value;
        	         }
        	      }
        	   
        	 
       	$j.ajax({
        		url : "./index.php?page=ajaxEvenement&noTemplate=1",
        		
        		dataType : "json",
        		data : {
        			cat_id : $j('#cat_id').val(),
        			id_contact : $j('#id_contact').val(),
        			fonction :  $j('#fonction').val(),
        			civilite :  $j('#civilite').val(),
        			nom :  $j('#nom').val(),
        			prenom :  $j('#prenom').val(),
        			tel_domicile :  $j('#tel_domicile').val(),
        			portable_perso :  $j('#portable_perso').val(),
        			tel_pro :  $j('#tel_pro').val(),
        			fax_pro :  $j('#fax').val(),
        			email_pro :  $j('#email_pro').val(),
        			email_perso :  $j('#email_perso').val(),
        			type_evenement :  $j('#type_evenement').val(),
        			observations :  $j('#observations').val(),
        			objet :  $j('#objet').val(),
        			degre : degre,
        			id_referent :  $j('#id_referent').val(),
        			action : "addEvent"
        		},success: function(data){
        			
        			
        			window.location.href="index.php?page=Evenement";
        			
        			
   
 
        		}});
        		 
        }
      
        
    });
    
    var Evenement = new Evenement();