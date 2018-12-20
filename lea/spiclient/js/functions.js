//Fonction de controle de l'écran d'édition d'un client
/** @defgroup Scripts Scripts javascript. Fonction ajax_request
*	SpiD : SpireaDemandes
*	SPIREA - 23/12/2009
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaDemandes - Ce logiciel est un programme informatique servant à la gestion de tickets de demande dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*
*	Fonction de controle de l'écran d'édition d'un client
*
*	\author BBO
* @{
*/
function verif_champClients()
{
	/**
	* Cette fonction retourne false si le client courant (account_id) a mal rempli le formulaire d'inscription (il s'agit donc d'un nouveau client)
	*
	* @return bool
	*/
	var more="";
	var message="";
	var nb=0;
	var erreur=false;
	var group="";
	var company="";
	var address_one="";
	var postalcode="";
	var locality="";
	var tva="";
	//Si existe pas, alors le client est en fait déjà créé...
	// if(document.getElementById("exec[account_id]"))
	// {
		// group=document.getElementById("exec[account_id]").value;
		// if(group=="")
		// {
			// message+="- Nom du groupe\n";
			// erreur=true;
			// nb++;
		// }
	// }
	if(document.getElementById("exec[client_company]"))
	{
		company=document.getElementById("exec[client_company]").value;
		if(company=="")
		{
			message+="- Société\n";
			nb++;
			erreur=true;
		}
	}
	if(document.getElementById("exec[client_adr_one_street]"))
	{
		address_one=document.getElementById("exec[client_adr_one_street]").value;
		if(address_one=="")
		{
			message+="- Adresse 1\n";
			nb++;
			erreur=true;
		}
	}
	if(document.getElementById("exec[client_postalcode]"))
	{
		postalcode=document.getElementById("exec[client_postalcode]").value;
		if(postalcode=="")
		{
			message+="- Code postal\n";
			nb++;
			erreur=true;
		}
	}
	if(document.getElementById("exec[client_locality]"))
	{
		locality=document.getElementById("exec[client_locality]").value;
		if(locality=="")
		{
			message+="- Ville\n";
			nb++;
			erreur=true;
		}
	}
	/*if(document.getElementById("exec[client_tva]"))
	{
		tva=document.getElementById("exec[client_tva]").checked;
		if(tva==false)
		{
			message+="- Soumis à la TVA\n";
			nb++;
			erreur=true;
		}
	}*/	
	if(nb>1)
	{
		more="s";
	}
	message="Erreur"+more+" dans le"+more+" champ"+more+" suivant"+more+" :\n"+message;	
	if(erreur)
	{
		// Dialog.alert(message, {
		alert(message, {
			windowParameters: {
				className: "alphacube"
			},
			okLabel : "OK"
			}
		);
		return false;
	}
	return true;
}

//Fonction de controle de l'écran d'édition d'un ticket
function verif_champTickets()
{
	/**
	* Cette fonction retourne true si le formulaire de création d'un ticket a été correctement renseigné (il s'agit donc d'un nouveau ticket)
	*
	* @return bool
	*/
	var nb=0;
	var more="";
	var msg="";
	var category=document.getElementById("exec[cat_id]").value;
	var assigned_to=document.getElementById("exec[ticket_assigned_to]").value;
	var account_id=document.getElementById("exec[account_id]").value;
	var assigned_by=document.getElementById("exec[ticket_assigned_by]").value;
	var title=document.getElementById("exec[ticket_title]").value;
	var date_echeance=document.getElementById("exec[due_date][str]").value;
	
	if(category=="")
	{
		msg+="- Catégorie\n";
		nb++;
	}
	if(assigned_to=="")
	{
		msg+="- Assigné à\n";
		nb++;
	}
	if(account_id=="")
	{
		msg+="- Groupe\n";
		nb++;
	}
	if(assigned_by=="")
	{
		msg+="- Assigné par\n";
		nb++;
	}
	if(title=="")
	{
		msg+="- Objet\n";
		nb++;
	}
	
	
	if(!(DateFuture(date_echeance)) || date_echeance=="")
	{
		msg+="- Date d'échéance\n";
		nb++;
	}
	if(msg!=""){
		if(nb>1)
		{
			more="s";
		}
		msg="Erreur"+more+" avec le"+more+" champ"+more+" suivant"+more+" :\n"+msg;
		// Dialog.alert(msg, {
		alert(msg, {
			windowParameters: {
				className: "alphacube"
			},
			okLabel : "OK"
			}
		);
		return false;
	}else{
		document.getElementById("exec[ticket_assigned_to]").removeAttribute("disabled");
		document.getElementById("exec[account_id]").removeAttribute("disabled");
		document.getElementById("exec[ticket_priority]").removeAttribute("disabled");
		document.getElementById("exec[state_id]").removeAttribute("disabled");
		return true;
	}

}

function ConvNum(tabDeDate)
{
	/**
	* Supprime le premier caractère d'un tableau si c'est un 0
	*
	* NOTE : ca DOIT planter de temps en temps ...
	*
	* @param array tabDeDate
	*
	* @return array
	*/
	for (i=0; i<tabDeDate.length; i++)
	{
		tabDeDate[i] = (tabDeDate[i].charAt(0)=='0')?tabDeDate[i].charAt(1):tabDeDate[i];
	}
	return tabDeDate;
} 

function DateFuture(valeur_date)
{
	/**
	* Retourne true si la date passée en argument est après la date du jour
	*
	* NOTE : et si le séparateur de date n'est pas - ?
	*
	* @param date valeur_date
	*
	* @return bool
	*/
	var tabDate = valeur_date.split('-');
	var datAujourdhui = new Date();
	tabDate = ConvNum(tabDate);
	if (valeur_date.length > 0)
	{
		var datTest_Date = new Date(parseInt(tabDate[2]), parseInt(tabDate[1])-1, parseInt(tabDate[0]));
		if (datTest_Date <= datAujourdhui)
		{
			return false;
		}
	}
	return true;
} 


function confirmDeleteClient(nomClient)
{
	/**
	* Affiche une boite de dialogue de confirmation de suppression d'un client. Retourne true si l'utilisateur confirme la suppression, false sinon
	*
	* @param string nomClient nom de la société à supprimer
	*
	* @return bool
	*/
	Dialog.confirm("Suppression de la société "+nomClient+"<br/>Êtes-vous sûr ?", {
		windowParameters: {
			className: "alphacube"
		},
		okLabel : "Oui",
		cancelLabel : "Non",
		onOk : true,
		onCancel : false
		}
	);
}

function confirmDeleteFacture(numFacture)
{
	/**
	* Affiche une boite de dialogue de confirmation de suppression d'une facture. Retourne true si l'utilisateur confirme la suppression, false sinon
	*
	* @param string numFacture numéro de la facture à supprimer
	*
	* @return bool
	*/
	Dialog.confirm("Suppression de la facture "+numFacture+"<br/>Êtes-vous sûr ?", {
		windowParameters: {
			className: "alphacube"
		},
		okLabel : "Oui",
		cancelLabel : "Non",
		onOk : true,
		onCancel : false
		}
	);
}

function longueur(chaine)
{
	/**
	* Retourne la longueur d'une chaine de caractères.
	*
	* NOTE : cette méthode est certainement déjà intégrée à javascript
	*
	* @param string chaine
	*
	* @return int
	*/
	var i = 0, a = 0;
	while (chaine[i++])
	{
		a++;
	}
	return a;
}

function base64_encode (data) {
    // http://kevin.vanzonneveld.net
    // +   original by: Tyler Akins (http://rumkin.com)
    // +   improved by: Bayron Guevara
    // +   improved by: Thunder.m
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Pellentesque Malesuada
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // -    depends on: utf8_encode
    // *     example 1: base64_encode('Kevin van Zonneveld');
    // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='

    // mozilla has this native
    // - but breaks in 2.0.0.12!
    //if (typeof this.window['atob'] == 'function') {
    //    return atob(data);
    //}
        
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, enc="", tmp_arr = [];

    if (!data) {
        return data;
    }

    data = this.utf8_encode(data+'');
    
    do { // pack three octets into four hexets
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++);

        bits = o1<<16 | o2<<8 | o3;

        h1 = bits>>18 & 0x3f;
        h2 = bits>>12 & 0x3f;
        h3 = bits>>6 & 0x3f;
        h4 = bits & 0x3f;

        // use hexets to index into b64, and append result to encoded string
        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    } while (i < data.length);
    
    enc = tmp_arr.join('');
    
    switch (data.length % 3) {
        case 1:
            enc = enc.slice(0, -2) + '==';
        break;
        case 2:
            enc = enc.slice(0, -1) + '=';
        break;
    }

    return enc;
}

function utf8_encode ( argString ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: sowberry
    // +    tweaked by: Jack
    // +   bugfixed by: Onno Marsman
    // +   improved by: Yves Sucaet
    // +   bugfixed by: Onno Marsman
    // +   bugfixed by: Ulrich
    // *     example 1: utf8_encode('Kevin van Zonneveld');
    // *     returns 1: 'Kevin van Zonneveld'

    var string = (argString+''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");

    var utftext = "";
    var start, end;
    var stringl = 0;

    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {
            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.substring(start, end);
            }
            utftext += enc;
            start = end = n+1;
        }
    }

    if (end > start) {
        utftext += string.substring(start, string.length);
    }

    return utftext;
}

// @}