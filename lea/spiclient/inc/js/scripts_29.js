
			//Tableau des messages standard
			tab_reponse = new Object();
tab_reponse['0'] = new Object();
tab_reponse['0']['standard_reply_id'] = "1";
tab_reponse['0']['canned_content'] = "Bonjour,  Nous fermons ici ce ticket.   Cordialement, -- Support technique Spirea";
tab_reponse['1'] = new Object();
tab_reponse['1']['standard_reply_id'] = "2";
tab_reponse['1']['canned_content'] = "Bonjour,  Nous avons effectués la mise";
tab_reponse['2'] = new Object();
tab_reponse['2']['standard_reply_id'] = "3";
tab_reponse['2']['canned_content'] = "Bonjour,  Suite";

			//Tableau des etats fermables
			tab_etat = new Object();
tab_etat['0'] = new Object();
tab_etat['0']['state_id'] = "5";
tab_etat['0']['state_close'] = "1";

			//Tableau des categories
			tab_cat = new Object();
tab_cat['0'] = new Object();
tab_cat['0']['cat_id'] = "29";
tab_cat['0']['cat_managementgroup'] = "-25";
tab_cat['0']['cat_assignedto'] = "19";
tab_cat['0']['parent'] = "0";
tab_cat['0']['possible_select'] = "1";
tab_cat['0']['group_user'] = "-26,-24";

			
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
				
					document.getElementById('exec[ticket_closed]').value=tab_id[1];
					document.getElementById('exec[transition]').value=tab_id[2];
				if(tab_id[1]==1){
					document.getElementById('exec[ticket_closed]').removeAttribute("disabled");
				}
			}
			
		function etats(id){
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
groupeClients[''] = new Object();
groupeClients['']['16'] = "administrateur User";
groupeClients['']['19'] = "gestionnaire";
groupeClients['']['17'] = "Yann Le frioux";
groupeClients['D'] = new Object();
groupeClients['D']['23'] = "demandeur demandeur";
groupeClients['D']['29'] = "tobias rilke";

				//Tableau des membrerGroupesDuUser
				membrerGroupesDuUser = new Object();
membrerGroupesDuUser['-26'] = new Object();
membrerGroupesDuUser['-26']['28'] = "test";
membrerGroupesDuUser['-26']['29'] = "test2";
membrerGroupesDuUser['-24'] = new Object();
membrerGroupesDuUser['-24']['23'] = "demandeur";
membrerGroupesDuUser['-24']['29'] = "test2";

				//Tableau des tabDefault
				tabDefault = new Object();
tabDefault['assigned_to_id'] = "16";
tabDefault['16'] = "administrateur";
tabDefault['group_management_id'] = "-25";
tabDefault['group_management_value'] = "GESTIONNAIRES";
tabDefault['group_management_value_users'] = new Object();
tabDefault['group_management_value_users']['8'] = false;
tabDefault['group_management_value_users']['16'] = "administrateur";
tabDefault['group_management_value_users']['17'] = "lfy";
tabDefault['group_management_value_users']['19'] = "gestionnaire";
tabDefault['demandeur'] = new Object();
tabDefault['demandeur']['29'] = "test2";

				//Tableau des groupesDuUser
				groupesDuUser = new Object();
groupesDuUser['-26'] = "Groupe1user";
groupesDuUser['-24'] = "DEMANDEURS";

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
							if(g==29){
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
					alert(info);
					return info;
				}