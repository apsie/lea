	
	function lookup(inputString,champ) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else if(champ=='cp') {
			$.post("liste_aide.php", {cp: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
		
	} // lookup
	
		function fill(cp,ville,region,pays) {
		$('#cp').val(cp);
		$('#ville').val(ville);
		$('#region').val(region);
		$('#pays').val(pays);
		
		
		setTimeout("$('#suggestions').hide();", 200);
	}
	

	
		
	