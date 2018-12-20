function lookup(action,inputString,list) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions'+list+'').hide();
		} else {
			$.get("../ajax/ajax", {action: ""+action+"",queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions'+list+'').show();
					$('#autoSuggestionsList'+list+'').html(data);
				}
			});
			
		}
		
	} 
	
	function fill_codepostal(cp,ville,region,pays) {
		$('#cp').val(cp);
		$('#ville').val(ville);
		$('#region').val(region);
		$('#pays').val(pays);
		
		
		setTimeout("$('#suggestionsCp').hide();", 200);
	}
	function fill_codenaf(code_naf) {
		$('#code_naf').val(code_naf);
	
		setTimeout("$('#suggestionsCodeNaf').hide();", 200);
	}
	
	    function addslashes( str ) {  
		     // Escapes single quote, double quotes and backslash characters in a string with backslashes    
		     //   
		      // version: 810.114  
		      // discuss at: http://phpjs.org/functions/addslashes  
		     // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
		       // +   improved by: Ates Goral (http://magnetiq.com)  
		       // +   improved by: marrtins  
		        // +   improved by: Nate  
		      // +   improved by: Onno Marsman  
		      // *     example 1: addslashes("kevin's birthday");  
		      // *     returns 1: 'kevin\'s birthday'  
		     
		      return (str+'').replace(/([\\"'])/g, "\\$1").replace(/\0/g, "\\0");  
		   }  