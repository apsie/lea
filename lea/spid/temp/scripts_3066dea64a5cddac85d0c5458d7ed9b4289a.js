
			//Tableau des messages standard
			tab_reponse = new Object();
tab_reponse['0'] = new Object();
tab_reponse['0']['standard_reply_id'] = "1";
tab_reponse['0']['canned_content'] = "HelloBonjour,Nous fermons ici ce ticket.Cordialement,--Support techniqueSpireaCordialement";
tab_reponse['1'] = new Object();
tab_reponse['1']['standard_reply_id'] = "2";
tab_reponse['1']['canned_content'] = "HelloBonjour,Nous avons effectués la mise Cordialement";
tab_reponse['2'] = new Object();
tab_reponse['2']['standard_reply_id'] = "3";
tab_reponse['2']['canned_content'] = "HelloBonjour,Suite Cordialement";
tab_reponse['3'] = new Object();
tab_reponse['3']['standard_reply_id'] = "4";
tab_reponse['3']['canned_content'] = "Hellole gars est absent...<br />Cordialement";
tab_reponse[''] = new Object();
tab_reponse['']['standard_reply_id'] = null;
tab_reponse['']['canned_content'] = "Bonjour, /n/n Cordialement,";

			//Tableau des etats fermables
			tab_etat = new Object();
tab_etat['0'] = new Object();
tab_etat['0']['state_id'] = "33";
tab_etat['0']['state_close'] = "1";
tab_etat['1'] = new Object();
tab_etat['1']['state_id'] = "23";
tab_etat['1']['state_close'] = "1";
tab_etat['2'] = new Object();
tab_etat['2']['state_id'] = "24";
tab_etat['2']['state_close'] = "1";
tab_etat['3'] = new Object();
tab_etat['3']['state_id'] = "25";
tab_etat['3']['state_close'] = "1";
tab_etat['4'] = new Object();
tab_etat['4']['state_id'] = "26";
tab_etat['4']['state_close'] = "1";
tab_etat['5'] = new Object();
tab_etat['5']['state_id'] = "27";
tab_etat['5']['state_close'] = "1";
tab_etat['6'] = new Object();
tab_etat['6']['state_id'] = "28";
tab_etat['6']['state_close'] = "1";
tab_etat['7'] = new Object();
tab_etat['7']['state_id'] = "29";
tab_etat['7']['state_close'] = "1";
tab_etat['8'] = new Object();
tab_etat['8']['state_id'] = "30";
tab_etat['8']['state_close'] = "1";
tab_etat['9'] = new Object();
tab_etat['9']['state_id'] = "31";
tab_etat['9']['state_close'] = "1";

			//Tableau des categories
			tab_cat = new Object();
tab_cat['0'] = new Object();
tab_cat['0']['name'] = "Retour Emploi";
tab_cat['0']['cat_id'] = "361";
tab_cat['0']['cat_managementgroup'] = "-3007";
tab_cat['0']['cat_assignedto'] = "10";
tab_cat['0']['parent'] = "0";
tab_cat['0']['possible_select'] = "1";
tab_cat['0']['group_user'] = "-9,-3007";
tab_cat['1'] = new Object();
tab_cat['1']['name'] = "Creation d'entreprise";
tab_cat['1']['cat_id'] = "362";
tab_cat['1']['cat_managementgroup'] = "-3007";
tab_cat['1']['cat_assignedto'] = "10";
tab_cat['1']['parent'] = "0";
tab_cat['1']['possible_select'] = "1";
tab_cat['1']['group_user'] = "-9,-3007";
tab_cat['2'] = new Object();
tab_cat['2']['name'] = "Orientation pro";
tab_cat['2']['cat_id'] = "363";
tab_cat['2']['cat_managementgroup'] = "-3007";
tab_cat['2']['cat_assignedto'] = "10";
tab_cat['2']['parent'] = "0";
tab_cat['2']['possible_select'] = "1";
tab_cat['2']['group_user'] = "-9,-3007";

			
		//Fonction pour les réponses standard
		function message(id){
				var tab_id=id.split("-");
				var  oEditor = FCKeditorAPI.GetInstance("exec[reply_content]");
				
				if(tab_id[0]==0){
					//document.getElementById('exec[reply_content]').innerHTML='';	
					oEditor.SetHTML("");
				}else{
					//document.getElementById('exec[reply_content]').innerHTML=tab_reponse[(tab_id[0]-1)]['canned_content'];
					oEditor.SetHTML(tab_reponse[(tab_id[0]-1)]['canned_content']);
				}
				if(document.getElementById('exec[ticket_closed]') != null){
					document.getElementById('exec[ticket_closed]').value=tab_id[1];
				}
					document.getElementById('exec[transition]').value=tab_id[2];
				if((tab_id[1]==1)&&(document.getElementById('exec[ticket_closed]') != null)){
					document.getElementById('exec[ticket_closed]').removeAttribute("disabled");
				}
			}
			
		function etats(id){
				alert("ici");
				if(document.getElementById("exec[ticket_closed]") != null){
					var select_OpenClose = document.getElementById("exec[ticket_closed]");
					for(var i in tab_etat){
						if(tab_etat[i]['state_id']==id){
							
							select_OpenClose.removeAttribute("disabled");
							break;
						}else{
							select_OpenClose.value=0;
							select_OpenClose.setAttribute("disabled", "disabled");
						}
					
					}
				}
			}
			
		function categories(id){
				var possible=false;
				var valeur_default=0;
				for(var i in tab_cat){
					if(tab_cat[i]['parent']>999){
						if(tab_cat[i]['cat_id']==id){
							if(tab_cat[i]['possible_select']==1){
								possible=true;
							}else{
								var tab_user=tab_cat[i]['group_user'].split(",");
								for(j=0;j<tab_user.value;j++){
									if(tab_user[j]==tab_cat[i]['cat_managementgroup']){
										possible=true;
									}
								}
							}
							if(possible==false){
								valeur_default=tab_cat[i]['parent'];
							}
						}
					}
					if(tab_cat[i]['parent']==0){
						if(tab_cat[i]['cat_id']==id){
							if(tab_cat[i]['possible_select']==1){
								possible=true;
							}else{
								var tab_user=tab_cat[i]['group_user'].split(",");
								for(j=0;j<tab_user.value;j++){
									if(tab_user[j]==tab_cat[i]['cat_managementgroup']){
										possible=true;
									}
								}
							}
							if(possible==false){
								valeur_default=tab_cat[i]['parent'];
							}
						}
					}
				}
				if(possible==false){
					document.getElementById('exec[cat_id]').value=valeur_default;
				}else{
					document.getElementById('exec[cat_id]').value=id;
				}
			}
			
			//Fonction permettant de savoir si la variable passée en paramètre est un objet
			function is_object(obj){
				 return (typeof(obj)!="object")?false:true;
			}
			
				//Tableau des groupeClients
				groupeClients = new Object();
groupeClients['-3023'] = new Object();
groupeClients['-3023']['3024'] = "admin Utilisateur";
groupeClients['-3023']['3013'] = "Samir Timsit";
groupeClients['-3007'] = new Object();
groupeClients['-3007']['10'] = "Ahmed Timsit";
groupeClients['-3007']['3064'] = "cweizmann Utilisateur";
groupeClients['-3007']['1003'] = "Denis Farcy";
groupeClients['-3007']['3052'] = "Fatima Benali";
groupeClients['-3007']['3028'] = "Irene Lindoubi";
groupeClients['-3007']['3031'] = "Laure Casset";
groupeClients['-3007']['3030'] = "Margot Guinet";
groupeClients['-3007']['3066'] = "mhure Utilisateur";
groupeClients['-3007']['13'] = "Maryse Sebille";
groupeClients['-3007']['3065'] = "mtaoualit Utilisateur";
groupeClients['-3007']['3047'] = "Pierre Fournier";
groupeClients['-3007']['3050'] = "Régis Gressier";
groupeClients['-3007']['1013'] = "Sandrine Meurgues";
groupeClients['-3007']['1036'] = "Sophie Tahri";
groupeClients['-3007']['3046'] = "Valerie Suon";
groupeClients['-9'] = new Object();
groupeClients['-9']['10'] = "Ahmed Timsit";
groupeClients['-9']['3064'] = "cweizmann Utilisateur";
groupeClients['-9']['1003'] = "Denis Farcy";
groupeClients['-9']['3028'] = "Irene Lindoubi";
groupeClients['-9']['3066'] = "mhure Utilisateur";
groupeClients['-9']['13'] = "Maryse Sebille";
groupeClients['-9']['3065'] = "mtaoualit Utilisateur";
groupeClients['-9']['3047'] = "Pierre Fournier";
groupeClients['-9']['3050'] = "Régis Gressier";
groupeClients['-9']['1013'] = "Sandrine Meurgues";
groupeClients['-9']['1036'] = "Sophie Tahri";
groupeClients['-9']['3046'] = "Valerie Suon";

				//Tableau des membrerGroupesDuUser
				membrerGroupesDuUser = new Object();
membrerGroupesDuUser['-3007'] = new Object();
membrerGroupesDuUser['-3007']['10'] = "atimsit";
membrerGroupesDuUser['-3007']['3064'] = "cweizmann";
membrerGroupesDuUser['-3007']['1003'] = "dfarcy";
membrerGroupesDuUser['-3007']['3052'] = "fbenali";
membrerGroupesDuUser['-3007']['3028'] = "ilindoubi";
membrerGroupesDuUser['-3007']['3031'] = "lcasset";
membrerGroupesDuUser['-3007']['3030'] = "mguinet";
membrerGroupesDuUser['-3007']['3066'] = "mhure";
membrerGroupesDuUser['-3007']['13'] = "msebille";
membrerGroupesDuUser['-3007']['3065'] = "mtaoualit";
membrerGroupesDuUser['-3007']['3047'] = "pfournier";
membrerGroupesDuUser['-3007']['3050'] = "rgressier";
membrerGroupesDuUser['-3007']['1013'] = "smeurgues";
membrerGroupesDuUser['-3007']['1036'] = "stahri";
membrerGroupesDuUser['-3007']['3046'] = "vsuon";
membrerGroupesDuUser['-9'] = new Object();
membrerGroupesDuUser['-9']['10'] = "atimsit";
membrerGroupesDuUser['-9']['3064'] = "cweizmann";
membrerGroupesDuUser['-9']['1003'] = "dfarcy";
membrerGroupesDuUser['-9']['3028'] = "ilindoubi";
membrerGroupesDuUser['-9']['3066'] = "mhure";
membrerGroupesDuUser['-9']['13'] = "msebille";
membrerGroupesDuUser['-9']['3065'] = "mtaoualit";
membrerGroupesDuUser['-9']['3047'] = "pfournier";
membrerGroupesDuUser['-9']['3050'] = "rgressier";
membrerGroupesDuUser['-9']['1013'] = "smeurgues";
membrerGroupesDuUser['-9']['1036'] = "stahri";
membrerGroupesDuUser['-9']['3046'] = "vsuon";

				//Tableau des tabDefault
				tabDefault = new Object();
tabDefault['assigned_to_id'] = "";
tabDefault[''] = "mhure";
tabDefault['group_management_id'] = "-2";
tabDefault['group_management_value'] = "Admins";
tabDefault['group_management_value_users'] = new Object();
tabDefault['group_management_value_users']['5'] = "egwadmin";
tabDefault['group_management_value_users']['10'] = "atimsit";
tabDefault['group_management_value_users']['3024'] = "admin";
tabDefault['demandeur'] = new Object();
tabDefault['demandeur']['3066'] = "mhure";

				//Tableau des groupesDuUser
				groupesDuUser = new Object();
groupesDuUser['-9'] = "conseillers";
groupesDuUser['-3007'] = "APSIE";

				//Valeur par défaut;
				
				function ajouterAssigneA(forms,assigne){
					// mise à jour du champs assigne_a
					if(document.getElementById("exec[cat_id]") != null){
						var cat_info=catInfo(document.getElementById("exec[cat_id]").value);
						var cat_managementgroup=cat_info[0]; // ok
						//var cat_assignedto=cat_info[1]; // ok
						var cat_assignedto=assigne; // ok
						var cat_groupUser=cat_info[2];	// ok
						var groupManagement=false;
						for(var g in tabDefault["group_management_value_users"]){
							if(g==3066){
								groupManagement=true;
							}
						}
						var myselect=document.getElementById("exec[ticket_assigned_to]");
						// alert("valeur asisgned_to");
						// alert(myselect);
						// myselect=19;
						myselect.options.length=1;
						if(cat_managementgroup==""){
							cat_managementgroup=tabDefault["group_management_id"];
						}
						for(var i in groupeClients[cat_managementgroup]){
							element=groupeClients[cat_managementgroup][i];
							if(i==cat_assignedto){
								nouvel_element = new Option(element,i,false,true);
							}else{
								nouvel_element = new Option(element,i,false,false);
							}
							try{
								myselect.add(nouvel_element,null);
							}catch(e){
								myselect.add(nouvel_element);
							}
						}
						
						if(groupManagement==false){
							if(cat_groupUser==false){
								document.getElementById("exec[ticket_assigned_to]").setAttribute("disabled", "disabled");
							}
						}
						visibleChamp(cat_managementgroup);
					}
				}
				
				function visibleChamp(visibleTemps){
					document.getElementById("exec[ticket_spend_time]").setAttribute("disabled", "disabled");
					if(visibleTemps!=""){
						for(var i in groupesDuUser){
							if(i==visibleTemps){
								document.getElementById("exec[ticket_spend_time]").removeAttribute("disabled");
							}
						}
					}
				}
				
				function ajouterDemandeur(forms) {
					var idGroupe=document.getElementById("exec[account_id]").value;
					var myselect=document.getElementById("exec[ticket_assigned_by]");
					myselect.options.length=1;
					for(var i in groupeClients[idGroupe]){
						element=groupeClients[idGroupe][i];
						if(UnDemandeur(i)==true){
							nouvel_element = new Option(element,i,false,true);
						}else{
							nouvel_element = new Option(element,i,false,false);
						}
						try{
							myselect.add(nouvel_element,null);
						}catch(e){
							myselect.add(nouvel_element);
						}
					}	
				}
				
				function UnDemandeur(i){
					if(tabDefault["demandeur"][i]){
						return true;
					}else{
						return false;
					}
				}
				
				function catInfo(id){
					var info=new Array();
					for(var i in tab_cat){
						if(tab_cat[i]["cat_id"]==id){
							info[0]=tab_cat[i]["cat_managementgroup"];
							info[1]=tab_cat[i]["cat_assignedto"];
							info[2]=false;
							var tab_group_user=tab_cat[i]["group_user"].split(",");
							for(var j=0;j<tab_group_user.length;j++){
								if(tab_group_user[j]==info[0]){
									info[2]=true;
									break;
								}
							}
						}
					}
					// alert(info);
					return info;
				}