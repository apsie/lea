// Cet objet va permettre de controler les champs et effectuer la recherche
function ajax_request(url)
{ 
	this.docXML='';
	this.methodeEnvoi = 'POST';
	this.fichierDAppel =url+'/js/ajax_request.php';
	this.xhr=null;
	
	this.LoadingInProgress = function()
	{
		Dialog.info("Chargement en cours<br/>Veuillez patientez...", {
			windowParameters: {
				className: "alphacube"
			},
			okLabel : "OK",
			height  : 80,
			width   : 200,
			showProgress : true
			}
		);
	}
	
	//Fonction permettant l'ouverture de felamimail, et d'ajouter la facture en pièce jointe ainsi que les destinataires et le message
	this.SendInvoiceByMail = function(client_id,numero_facture)
	{
		//alert(webServerURL);
		var self=this;
		self.envoi='select=sendEmail&id='+client_id+'&facture='+numero_facture+"&node=codes";
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementAddInvoice('code');
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	//Fonction de traitement pour ouvrir le popup de felamimail et y insérer les données provenant de la requete AJAX
	this.traitementAddInvoice = function(node)
	{
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node=this.docXML.getElementsByTagName(node);
		var count = verif_node.length;
		var webServerURL = url.substr(0,(longueur(url)-5));
		var get='';
		if(count>=1)
		{
			get+='&send_to='+base64_encode(this.docXML.getElementsByTagName("email_client")[0].firstChild.nodeValue);
			get+='&preset[subject]='+this.docXML.getElementsByTagName("subject")[0].firstChild.nodeValue;
			get+='&preset[body]='+this.docXML.getElementsByTagName("invoice_email")[0].firstChild.nodeValue;
			get+='&preset[file]='+this.docXML.getElementsByTagName("repertoire")[0].firstChild.nodeValue+'/'+this.docXML.getElementsByTagName("nom_facture")[0].firstChild.nodeValue;
			get+='&preset[name]='+this.docXML.getElementsByTagName("nom_facture")[0].firstChild.nodeValue;
			get+='&preset[type]='+this.docXML.getElementsByTagName("type")[0].firstChild.nodeValue;
			get+='&preset[size]='+this.docXML.getElementsByTagName("taille")[0].firstChild.nodeValue;
		}
		egw_openWindowCentered2(webServerURL+'/index.php?menuaction=felamimail.uicompose.compose'+get, 'popup_email', '600', '450', 'yes');
	}
	
	if(window.XMLHttpRequest)
	{ 
		this.xhr = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) 
	{
		try
		{
			this.xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			this.xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	
	
	this.nodeCleaner = function(n)
	{
		if(!n.data.replace(/\s/g,''))
		{
			n.parentNode.removeChild(n);
		}
	}

	this.getId =function(id)
	{
		return document.getElementById('exec['+id+']');
	}
	
	//Permet de "nettoyer le XML" c'est à dire pour être plus lisible vis à vis des navigateurs comme IE par exemple
	this.cleanXML = function()
	{
		var node = this.docXML.getElementsByTagName('*');
		for(i = 0; i < node.length; i++)
		{
			a = node[i].previousSibling;
			if(a && a.nodeType == 3)
			{
				this.nodeCleaner(a);
			}
			b = node[i].nextSibling;
			if(b && b.nodeType == 3)
			{
				this.nodeCleaner(b);
			}
		}
	}
	
	this.verifChamp = function ()
	{
		var retour="";
		return retour;
	}
	
	//Fonction qui va effectuer l'appel de la requete AJAX
	this.appel = function(source,destination,node,valeur)
	{
		var self=this;
		//self.envoi =this.verifChamp();
		self.envoi='select='+destination+'&node='+node+'s';
		// alert(valeur);
		if((valeur || 0))
		{
			self.envoi+='&valeur='+valeur;	
		}
		
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementXML(destination,node);
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 // alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	this.appelMultiple = function(source,dest1,dest2,node1,node2,valeur)
	{
		var self=this;
		//self.envoi =this.verifChamp();
		self.envoi='select='+dest1+'&node='+node1+'s';
		// alert(node2);
		if((valeur || 0))
		{
			self.envoi+='&valeur='+valeur;	
		}
		
		self.envoi+='&select2='+dest2+'&node2='+node2+'s';
		
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementXML(dest1,node1);
				self.traitementXML(dest2,node2);
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 // alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	//Fonction qui va effectuer l'appel de la requete AJAX
	this.assignedTo = function(source,destination,node,valeur)
	{
		var self=this;
		//self.envoi =this.verifChamp();
		self.envoi='select='+source+'&node='+node+'s';
		if((valeur || 0))
		{
			self.envoi+='&valeur='+valeur;
		}
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementAssignedToXML('exec[cats]['+destination+'][data][cat_assignedto]',node);
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	//Fonction qui va effectuer l'appel de la requete AJAX
	this.assignedToGeneral = function(source,destination,node,valeur)
	{
		var self=this;
		//self.envoi =this.verifChamp();
		self.envoi='select='+source+'&node='+node+'s';
		if((valeur || 0))
		{
			self.envoi+='&valeur='+valeur;
		}
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementAssignedToXML('exec'+destination,node);
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	this.initialize = function()
	{
		var self=this;
		//self.envoi =this.verifChamp();
		self.envoi='select=initialize';
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				// retrait de cette ligne validée - tch + ylf - self.traitementXML('cat_id','categorie');
				// self.traitementXML('account_id','societe');
				
				self.appel('client_id','ticket_assigned_by_contact','personne',self.getId('client_id').value);
				self.appel('cat_id','ticket_assigned_to','personne',self.getId('cat_id').value);
				// YLF
				self.appel('client_id','contract_id','personne',self.getId('client_id').value);
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	
	}
	
	this.reponse = function (valeur)
	{
		var self=this;
		self.envoi='select=reponse';
		self.envoi+='&valeur='+valeur;
		self.envoi+='&node=reponses';
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementResponseXML('reponses');
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	this.transition = function (valeur)
	{
		var self=this;
		self.envoi='select=transition';
		self.envoi+='&valeur='+valeur;
		self.envoi+='&node=transitions';
		var id='transition';
		self.xhr.onreadystatechange = function() 
		{
			if(self.xhr.readyState==4 && self.xhr.status==200){
				self.traitementTransitionXML(id,'transition');
			}
			else
			{
				//Chargement en cours
			}
		};
		self.xhr.open(self.methodeEnvoi, self.fichierDAppel, true);
		self.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//alert(self.envoi);
		self.xhr.send(self.envoi);
	}
	
	//Fonction de traitement du fichier XML, va permettre d'ajouter les nouvelles options sur les listes de choix voulues
	this.traitementXML = function(id,node)
	{
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node=this.docXML.getElementsByTagName(node);
		var count = verif_node.length;
		var element_name = element_id = nouvel_element = '';
		var valeurSelected = "";
		this.getId(id).options.length=1;
		if(count>=1)
		{	
			for(i = 0; i < count; i++)
			{
				element_name = this.docXML.getElementsByTagName("value_"+node)[i].firstChild.nodeValue;
				if((this.docXML.getElementsByTagName("id_"+node)[i].firstChild != null)&&(this.docXML.getElementsByTagName("id_"+node)[i].firstChild.nodeValue)){
					element_id = this.docXML.getElementsByTagName("id_"+node)[i].firstChild.nodeValue;
				}
				if(this.docXML.getElementsByTagName("id_"+node)[i].getAttribute('selected'))
				{
					valeurSelected=element_id;
				}
				nouvel_element = new Option(element_name,element_id,false,true);
				try{
					this.getId(id).add(nouvel_element,null);
				}catch(e){
					this.getId(id).add(nouvel_element);
				}
			}
		}
		//YLF
		if(this.getId(id).length == 2){
			valeurSelected = this.getId(id)[this.getId(id).length-1].value;
		}
		
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node_state=this.docXML.getElementsByTagName('select_state');
		
		if(document.getElementById('exec[cat_id]').value == ''){
			document.getElementById('exec[ticket_assigned_to]').setAttribute('disabled','disabled');
			if(document.getElementById('exec[state_id]') != null){
				document.getElementById('exec[state_id]').setAttribute('disabled','disabled');
			}
		}
		if(verif_node_state)
		{
			var count_state = verif_node_state.length;
			if(count_state>=1)
			{
				if(this.docXML.getElementsByTagName('select_state')[0].firstChild.nodeValue=='oui')
				{
					if(document.getElementById('exec[state_id]') != null){
						document.getElementById('exec[state_id]').removeAttribute('disabled');
					}
				}
			}
		}
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node_user=this.docXML.getElementsByTagName('select_user');
		if(verif_node_state)
		{
			var count_user = verif_node_user.length;
			
			if(count_user>=1)
			{
				if((this.docXML.getElementsByTagName('select_state')[0] != null)&&(this.docXML.getElementsByTagName('select_state')[0].firstChild.nodeValue=='oui'))
				{
					  document.getElementById('exec[ticket_assigned_to]').removeAttribute('disabled');
				}
			}
		}
		this.getId(id).value=valeurSelected;
		if(count<1)
		{
			this.getId(id).setAttribute("disabled", "disabled");
		}
		else
		{
			this.getId(id).removeAttribute("disabled");
			
		}
		
		if((this.docXML.getElementsByTagName('select_state')[0] != null)&&(this.docXML.getElementsByTagName('spidlevel')[0].firstChild.nodeValue==0))
		{
			document.getElementById('exec[ticket_assigned_to]').setAttribute('disabled','disabled');
		}
	}
	
	this.traitementAssignedToXML = function(id,node)
	{
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node=this.docXML.getElementsByTagName(node);
		var count = verif_node.length;
		var element_name = element_id = nouvel_element = '';
		var valeurSelected = "";
		document.getElementById(id).options.length=1;
		if(count>=1)
		{
			for(i = 0; i < count; i++)
			{
				element_name = this.docXML.getElementsByTagName("value_"+node)[i].firstChild.nodeValue;
				element_id = this.docXML.getElementsByTagName("id_"+node)[i].firstChild.nodeValue;
				if(this.docXML.getElementsByTagName("id_"+node)[i].getAttribute('selected'))
				{
					valeurSelected=element_id;
				}
				nouvel_element = new Option(element_name,element_id,false,true);
				try{
					document.getElementById(id).add(nouvel_element,null);
				}catch(e){
					document.getElementById(id).add(nouvel_element);
				}
			}
		}
		document.getElementById(id).value=valeurSelected;		
	}
	
	this.traitementTransitionXML = function(id,node)
	{
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node=this.docXML.getElementsByTagName(node);
		var count = verif_node.length;
		var element_name = element_id = nouvel_element = '';
		var valeurSelected = "";
		this.getId(id).options.length=1;
		if(count>=1)
		{
			for(i = 0; i < count; i++)
			{
				element_name = this.docXML.getElementsByTagName("state_name")[i].firstChild.nodeValue;
				element_id = this.docXML.getElementsByTagName("state_id")[i].firstChild.nodeValue;
				//if(this.docXML.getElementsByTagName("id_"+node)[i].getAttribute('selected'))
				//{
				//	valeurSelected=element_id;
				//}
				nouvel_element = new Option(element_name,element_id,false,true);
				try{
					this.getId(id).add(nouvel_element,null);
				}catch(e){
					this.getId(id).add(nouvel_element);
				}
			}
		}
	}
	
	this.traitementResponseXML = function(node)
	{
		this.docXML = this.xhr.responseXML.documentElement;
		this.cleanXML();
		var verif_node=this.docXML.getElementsByTagName(node);
		var count = verif_node.length;
		var message='';
		var  oEditor = FCKeditorAPI.GetInstance("exec[reply_content]");
		oEditor.SetHTML("");
		if(count==1)
		{
			message=this.docXML.getElementsByTagName("canned_content")[0].firstChild.nodeValue;
			oEditor.SetHTML(message);
			this.getId('ticket_closed').value=this.docXML.getElementsByTagName("close_ticket")[0].firstChild.nodeValue;
			this.getId('transition').value=this.docXML.getElementsByTagName("state_id")[0].firstChild.nodeValue;
			//alert(this.getId('transition').value+' --- '+this.docXML.getElementsByTagName("state_id")[0].firstChild.nodeValue);
			//this.transition(selectTransition);
		}
		this.getId('ticket_closed').setAttribute('disabled', 'disabled');
		if(this.getId('ticket_closed').value==1)
		{
			this.getId('ticket_closed').removeAttribute('disabled');
		}
		
		
	}
	
	
}