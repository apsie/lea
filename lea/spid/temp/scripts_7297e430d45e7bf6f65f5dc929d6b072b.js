
			//Tableau des messages standard
			tab_reponse = new Object();
tab_reponse['0'] = new Object();
tab_reponse['0']['standard_reply_id'] = "1";
tab_reponse['0']['canned_content'] = "<p>Bonjour,<br /><br />Nous fermons ici ce ticket, n'hésitez pas à nous contacter pour toute  question.<br /><br />Cordialement,</p><p><br />-- <br />Support technique</p>";
tab_reponse['1'] = new Object();
tab_reponse['1']['standard_reply_id'] = "2";
tab_reponse['1']['canned_content'] = "<p>Bonjour,<br /><br />Nous avons implémenté la modification dans l'environnement de  production.<br /><br /><br />Cordialement,</p><p><br />-- <br />Support technique</p>";
tab_reponse['2'] = new Object();
tab_reponse['2']['standard_reply_id'] = "3";
tab_reponse['2']['canned_content'] = "<p>Bonjour,<br /><br />Nous avons bien reçu votre demande.<br /><br /><br />Cordialement,</p><p>-- <br />Support technique</p>";
tab_reponse[''] = new Object();
tab_reponse['']['standard_reply_id'] = null;
tab_reponse['']['canned_content'] = "Bonjour, Cordialement, ---- Test Spirea / SPIREA";

			//Tableau des etats fermables
			tab_etat = new Object();
tab_etat['0'] = new Object();
tab_etat['0']['state_id'] = "5";
tab_etat['0']['state_close'] = "1";
tab_etat['1'] = new Object();
tab_etat['1']['state_id'] = "7";
tab_etat['1']['state_close'] = "1";
tab_etat['2'] = new Object();
tab_etat['2']['state_id'] = "10";
tab_etat['2']['state_close'] = "1";
tab_etat['3'] = new Object();
tab_etat['3']['state_id'] = "11";
tab_etat['3']['state_close'] = "1";
tab_etat['4'] = new Object();
tab_etat['4']['state_id'] = "12";
tab_etat['4']['state_close'] = "1";
tab_etat['5'] = new Object();
tab_etat['5']['state_id'] = "14";
tab_etat['5']['state_close'] = "1";
tab_etat['6'] = new Object();
tab_etat['6']['state_id'] = "15";
tab_etat['6']['state_close'] = "1";
tab_etat['7'] = new Object();
tab_etat['7']['state_id'] = "16";
tab_etat['7']['state_close'] = "1";
tab_etat['8'] = new Object();
tab_etat['8']['state_id'] = "17";
tab_etat['8']['state_close'] = "1";
tab_etat['9'] = new Object();
tab_etat['9']['state_id'] = "18";
tab_etat['9']['state_close'] = "1";

			//Tableau des categories
			tab_cat = new Object();
tab_cat['0'] = new Object();
tab_cat['0']['name'] = "EQUIPEMENT";
tab_cat['0']['cat_id'] = "67";
tab_cat['0']['cat_managementgroup'] = "-19";
tab_cat['0']['cat_assignedto'] = "24";
tab_cat['0']['parent'] = "0";
tab_cat['0']['possible_select'] = "1";
tab_cat['0']['group_user'] = "-1,-28";
tab_cat['1'] = new Object();
tab_cat['1']['name'] = "Voirie";
tab_cat['1']['cat_id'] = "68";
tab_cat['1']['cat_managementgroup'] = "-19";
tab_cat['1']['cat_assignedto'] = "24";
tab_cat['1']['parent'] = "67";
tab_cat['1']['possible_select'] = "1";
tab_cat['1']['group_user'] = "-1,-28";
tab_cat['2'] = new Object();
tab_cat['2']['name'] = "Electricité";
tab_cat['2']['cat_id'] = "69";
tab_cat['2']['cat_managementgroup'] = "-19";
tab_cat['2']['cat_assignedto'] = "23";
tab_cat['2']['parent'] = "67";
tab_cat['2']['possible_select'] = "";
tab_cat['2']['group_user'] = "-1,-28";
tab_cat['3'] = new Object();
tab_cat['3']['name'] = "INFORMATIQUE";
tab_cat['3']['cat_id'] = "70";
tab_cat['3']['cat_managementgroup'] = "-20";
tab_cat['3']['cat_assignedto'] = "21";
tab_cat['3']['parent'] = "0";
tab_cat['3']['possible_select'] = "1";
tab_cat['3']['group_user'] = "-1,-28";
tab_cat['4'] = new Object();
tab_cat['4']['name'] = "Serveurs";
tab_cat['4']['cat_id'] = "71";
tab_cat['4']['cat_managementgroup'] = "-20";
tab_cat['4']['cat_assignedto'] = "22";
tab_cat['4']['parent'] = "70";
tab_cat['4']['possible_select'] = "0";
tab_cat['4']['group_user'] = "-1,-28";
tab_cat['5'] = new Object();
tab_cat['5']['name'] = "Postes de travail";
tab_cat['5']['cat_id'] = "72";
tab_cat['5']['cat_managementgroup'] = "-20";
tab_cat['5']['cat_assignedto'] = "21";
tab_cat['5']['parent'] = "70";
tab_cat['5']['possible_select'] = "0";
tab_cat['5']['group_user'] = "-1,-28";
tab_cat['6'] = new Object();
tab_cat['6']['name'] = "AUTRE";
tab_cat['6']['cat_id'] = "78";
tab_cat['6']['cat_managementgroup'] = "-19";
tab_cat['6']['cat_assignedto'] = "24";
tab_cat['6']['parent'] = "0";
tab_cat['6']['possible_select'] = "0";
tab_cat['6']['group_user'] = "-1,-28";
tab_cat['7'] = new Object();
tab_cat['7']['name'] = "LOGISTIQUE";
tab_cat['7']['cat_id'] = "136";
tab_cat['7']['cat_managementgroup'] = "-19";
tab_cat['7']['cat_assignedto'] = "";
tab_cat['7']['parent'] = "0";
tab_cat['7']['possible_select'] = "";
tab_cat['7']['group_user'] = "-1,-28";

			
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
groupeClients['']['8'] = "administrateur User";
groupeClients['']['30'] = "test Opus";
groupeClients['']['23'] = "tech1 tech1";
groupeClients['']['24'] = "tech2 tech2";
groupeClients['']['34'] = "Demo Zen";

				//Tableau des membrerGroupesDuUser
				membrerGroupesDuUser = new Object();
membrerGroupesDuUser['-28'] = new Object();
membrerGroupesDuUser['-28']['8'] = "administrateur";
membrerGroupesDuUser['-28']['5'] = "demo";
membrerGroupesDuUser['-28']['6'] = "demo2";
membrerGroupesDuUser['-28']['7'] = "demo3";
membrerGroupesDuUser['-28']['14'] = "demo4";
membrerGroupesDuUser['-28']['25'] = "elu1";
membrerGroupesDuUser['-28']['26'] = "elu2";
membrerGroupesDuUser['-28']['27'] = "elu3";
membrerGroupesDuUser['-28']['21'] = "info1";
membrerGroupesDuUser['-28']['22'] = "info2";
membrerGroupesDuUser['-28']['32'] = "lc-01";
membrerGroupesDuUser['-28']['30'] = "opus-1";
membrerGroupesDuUser['-28']['23'] = "tech1";
membrerGroupesDuUser['-28']['24'] = "tech2";
membrerGroupesDuUser['-1'] = new Object();
membrerGroupesDuUser['-1']['8'] = "administrateur";
membrerGroupesDuUser['-1']['5'] = "demo";
membrerGroupesDuUser['-1']['6'] = "demo2";
membrerGroupesDuUser['-1']['7'] = "demo3";
membrerGroupesDuUser['-1']['14'] = "demo4";
membrerGroupesDuUser['-1']['25'] = "elu1";
membrerGroupesDuUser['-1']['26'] = "elu2";
membrerGroupesDuUser['-1']['27'] = "elu3";
membrerGroupesDuUser['-1']['21'] = "info1";
membrerGroupesDuUser['-1']['22'] = "info2";
membrerGroupesDuUser['-1']['32'] = "lc-01";
membrerGroupesDuUser['-1']['30'] = "opus-1";
membrerGroupesDuUser['-1']['36'] = "pok";
membrerGroupesDuUser['-1']['23'] = "tech1";
membrerGroupesDuUser['-1']['24'] = "tech2";
membrerGroupesDuUser['-1']['34'] = "zen";

				//Tableau des tabDefault
				tabDefault = new Object();
tabDefault['assigned_to_id'] = "23";
tabDefault['23'] = "tech1";
tabDefault['group_management_id'] = "-19";
tabDefault['group_management_value'] = "GROUPE TECHNIQUE";
tabDefault['group_management_value_users'] = new Object();
tabDefault['group_management_value_users']['8'] = "administrateur";
tabDefault['group_management_value_users']['23'] = "tech1";
tabDefault['group_management_value_users']['24'] = "tech2";
tabDefault['group_management_value_users']['30'] = "opus-1";
tabDefault['group_management_value_users']['34'] = "zen";
tabDefault['demandeur'] = new Object();
tabDefault['demandeur']['7'] = "demo3";

				//Tableau des groupesDuUser
				groupesDuUser = new Object();
groupesDuUser['-1'] = "Default";
groupesDuUser['-28'] = "GROUPE DEMO";

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
							if(g==7){
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