	
	function lookup(inputString,champ) {
		
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$j('#suggestions').hide();
		} else if(champ=='ville' || champ=='cp') {
			$j.post("./index.php?page=ajaxContact&noTemplate=1&action=getVille&queryString="+inputString+"", function(data){
				if(data.length >0) {
					$j('#suggestions').show();
					$j('#autoSuggestionsList').html(data);
				}
			});
		}
		else if(champ=='nom') {
			$j.post("./index.php?page=ajaxContact&noTemplate=1&action=getBen&queryString="+inputString+"", function(data){
				if(data.length >0) {
					
					$j('#suggestions_').show();
					$j('#autoSuggestionsList_').html(data);
					//alert($j('#autoSuggestionsList_').html());
					//console.debug(data);
				}
			});
		}
		
	} // lookup
	
		function fill(cp,ville,region,pays) {
		$j('#cp_box').val(cp);
		$j('#ville_box').val(ville);
		$j('#region_box').val(region);
		$j('#pays_box').val(pays);
		
		
		setTimeout("$j('#suggestions').hide();", 200);
	}
	
		function fill_ben(id_ben,cat_id,civilite,nom,prenom,tel_domicile,tel_pro,email_pro,portable_perso,fax_pro,email_perso,fonction) {
			
			$j('#id_contact').val(id_ben);
			$j('#cat_id').val(cat_id);
			$j('#civilite').val(civilite);
			$j('#nom').val(nom);
			$j('#prenom').val(prenom);
			$j('#tel_domicile').val(tel_domicile);
			$j('#tel_pro').val(tel_pro);
			$j('#email_pro').val(email_pro);
			$j('#tel_perso').val(portable_perso);
			$j('#fax_pro').val(fax_pro);
			$j('#email_perso').val(email_perso);
			$j('#fonction').val(fonction);
			
			
			setTimeout("$j('#suggestions_').hide();", 200);
		}

	
		
		function lookup_naf(inputString) {
			if(inputString.length == 0) {
				// Hide the suggestion box.
				$j('#suggestions_naf').show();
			} else {
				$j.post("./index.php?page=ajaxOrganisation&noTemplate=1&action=getCodeNaf&queryString="+inputString+"", function(data){
					if(data.length >0) {
						$j('#suggestions_naf').show();
						$j('#autoSuggestionsList_naf').html(data);
					}
				});
			}
		} // l
		
		function fill_naf(thisValue) {
			$j('#code_naf_').val(thisValue);
			
			
			setTimeout("$j('#suggestions_naf').hide();", 200);
		}