    var Graph  = Class.create({  
        //Constructeur  
        initialize:function()  
        {  
            this.height =200;
            this.width =200;
            this.textTitle="";
            this.idRender="";
           
        }, 
        drawPie:function(idDispositif,idReferent,text,idRender,mot)
        {
thisBis =this;

ajaxManager.add({ success: function(data) {
	
	if(data=="")
	{ //$j('#'+idRender).append("<div style='padding-top:12px;'>"+text+"<br/><br/><br/><br/>Aucunes données...</div>");}
	serie1 = new Array();
	serie1Obj = new Object();
	serie1Obj.name = "Aucunes données...";
	//serie1Obj.category = idDispositif+';'+obj.STATUT;
	serie1Obj.color = Color_.getColorDefault("Aucunes Donnees");
	serie1Obj.y = 100;
	serie1.push(serie1Obj);
	$j('#subtitle_'+idDispositif).html('Total : <strong>0</strong>');
	}
else
	{
serie1 = new Array();

$j.each(data,function(i, obj){
	serie1Obj = new Object();
	serie1Obj.name = obj.STATUT+' ('+obj.NB+')';
	serie1Obj.category = idDispositif+';'+obj.STATUT;
	serie1Obj.color = Color_.getColorDefault(obj.STATUT);
	serie1Obj.y = Math.round((obj.NB/obj.TOTAL)*100);
	serie1Obj.total = obj.TOTAL;
	serie1.push(serie1Obj);
	$j('#subtitle_'+idDispositif).html('Total : <strong>'+obj.TOTAL+'</strong>');
	//Ob[Ob.length] = {"name":obj.STATUT,"color":"#000000","y":Math.round((obj.NB/obj.TOTAL)*100)};
});
	}

//console.debug(serie1);
var chart;
$j(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
        renderTo: idRender,
        height :  thisBis.height,
        width : thisBis.width,
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         backgroundColor : null
      },
      credits: {
          enabled: false
      },
      title: {
    	  text:  text,
          style: {
              color: '#000',
             
              fontSize : '11px'
          }
      },
    
      tooltip: {
         formatter: function() {
        	 if(data!="")
 			{
            return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
 			}
         }
      },
      plotOptions: {
    	  series: {
              cursor: 'pointer',
              point: {
                  events: {
                      click: function() {
                    	  if(data!="")
                    		  { 
                    	  Navigation_.showTableauPresta(idReferent+';'+this.category+';'+mot);
                    		  }
                      }
                  }
              }
          },
         pie: {
        	 size:"100%",
        	 allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                enabled: true,
                connectorWidth: 0,
                distance: -30,
                color: 'white',
                formatter: function() {
                	if(this.y >5)
                		{
                		 if(data!="")
         	 			{
                    return  this.y +' %';
         	 			}
                		 else
                			 {
                			 return "Aucunes données";
                			 }
                		}
                 }
            },
            showInLegend: true
         }
      },
      legend: {
          enabled: false
      },
       series: [{
         type: 'pie',
       
         data: serie1
      }]
   });
});

	

	
},url : "./index.php?page=ajaxPresta&noTemplate=1",
dataType : "json",
data : {
	
	
	idDispositif : idDispositif,
	idReferent : idReferent,
	mot : mot,
	
	action : "getRepartition"
    
} });


	

	


        
        	
        }
        
        
      
    }); 
    
    var GraphPresta  = Class.create(Graph,{  
        //Constructeur  
        initialize:function()  
        {  
            this.idDispositif;
            
           
        }
    });
    
    
   
    
var Graph_ = new Graph();
var GraphPresta_ = new GraphPresta();