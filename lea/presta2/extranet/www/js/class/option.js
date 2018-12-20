    var Option = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
         
          this.id = "#option";
          this.id_entete = "#entete";
          this.id_contenu="#contenu";
        },
        anime:function()
        {
        
        
        		
        	$j(Option.id_entete).click(function() {
        		
        		if($j(Option.id).attr('etat')==0)
        		{
        		
        		$j(Option.id).attr('etat',1);
        		
        		  $j(Option.id).animate({
        		    width: '+=350',
        		  }, 500, function() {
        		    // Animation complete.
        		  });
        		  $j(Option.id_contenu).show();	
        		  $j(Option.id_entete).css('background-image',' url("./images/ico/option_ferme.png")');
        		}
       
        	
        		else if($j(Option.id).attr('etat')==1)
        		{
        		$j(Option.id_contenu).hide();

        	 		$j(Option.id).attr('etat',0);
            		
          		  $j(Option.id).animate({
          		    width: '-=350',
          		  }, 500, function() {
          		    // Animation complete.
          		  });
          		  $j(Option.id_entete).css('background-image',' url("./images/ico/option_ouvert.png")');
        		}
        	});
          		
        }
        
    });
    
    var Option = new Option();