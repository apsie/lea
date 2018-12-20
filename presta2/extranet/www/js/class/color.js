    var Color = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
            this.parametre = new Array("Nouvelle","En cours","Complete","A cloturer","Annulee","Abandon","Aucunes Donnees");
            this.parametre ['Nouvelle'] = "#0071A9";
            this.parametre ['En cours'] = "#98002E";
            this.parametre ['Complete'] = "#7CA900";
            this.parametre ['A cloturer'] = "#DBCF2B";
            this.parametre ['Annulee'] = "#000000";
            this.parametre ['Abandon'] = "#5B5B5A";
            this.parametre ['Aucunes Donnees'] = "#CCCCCC";
            
        },
        getColorDefault:function($str)
        {
        return  this.parametre[$str];
        }
        
    });
    
    var Color_ = new Color();