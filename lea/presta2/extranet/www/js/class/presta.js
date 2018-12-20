    var Presta = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
           
        },
        updatePresta:function(idPresta,lc,id_ref,date_debut,date_fin,date_fin_reelle,date_envoi,statut)
        {
        	
        	var idPresta = $j('#id_presta').val();
        	var lc = $j('#lc').val();
        	var id_ref = $j('#conseiller').val();
        	var date_debut = $j('#date_debut').val();
        	var date_fin = $j('#date_fin_pre').val();
        	var date_fin_reelle= $j('#date_fin_reelle').val();
        	var date_envoi = $j('#date_envoi').val();
        	var statut = $j('#statut').val();
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1",
        		dataType : "json",
        		data : {
        			idPresta : idPresta,
        			lc : lc,
        			id_ref : id_ref,
        			date_debut : date_debut,
        			date_fin : date_fin,
        			date_fin_reelle : date_fin_reelle,
        			date_envoi : date_envoi,
        			statut : statut,
        			action : "updatePresta"
        		},success: function(data){
        			
        			Navigation_.showTableauPresta(''+Navigation_.Tab_id_ref+';'+Navigation_.Tab_id_dispositif+';'+Navigation_.Tab_statut+';'+Navigation_.Tab_mot);
        			Template_.setTemplateDispositif(Navigation_.Tab_id_ref);
        			$j('#dialogPresta').dialog( "close" );
        			}});
        }
        ,
        getPresta:function(presta,idPresta)
        {
        	//alert('trdt');
        	if(presta=='oem')
        	presta = "oe";
        	
        	if(presta=='opcre')
            presta = "opcrea";
        		
        		
        	$j.ajax({
        		url : "./index.php?page="+presta+"&noHeader=1",
        		type : "POST",
        		data :{
        			id_presta  : idPresta
        			},
        		success: function(html){
        		$j('#div_'+presta).html(html);
        		}});
        	
        }
        ,
        form_abandon:function()
        {
        	
        	$j( "#form_abandon" ).dialog({height:150,width:300});
        	
        },
        setAbandon:function()
        {
        	
        	var form  = $j("form[name='abandon'] ").serialize();
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1",
        		type : "POST",
        		dataType : "json",
        		data : form,
        		success: function(data){
        		if(data==1)
        			notify("Abandon de la prestation","Les données sont sauvegardées");
        		else
        			notify("Abandon de la prestation","Echec , veuillez réessayer");
        		}});
        	
        	$j('#form_abandon').dialog( "close" );
        	return false;
        },
        terminer:function()
        {
        	
        	
        	$j.ajax({
        		url : "./index.php?page=ajaxPresta&noTemplate=1&action=updatePresta",
        		type : "GET",
        		dataType : "json",
        		data :{
        			control  : 4,
        			},
        		success: function(data){
        		
        			notify("Terminer la prestation","Les données sont sauvegardées");
        			setTimeout(function()
        					{
        					window.location.href="index.php?page=Presta";
        					},2000);
        	
        		}});
        	
        
        }
       
        
        
    });
    
    var Presta_ = new Presta();