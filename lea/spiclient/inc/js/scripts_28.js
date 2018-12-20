
			//Tableau des messages standard
			tab_reponse = new Object();
tab_reponse['0'] = new Object();
tab_reponse['0']['standard_reply_id'] = "1";
tab_reponse['0']['canned_content'] = "Bonjour,  Nous fermons ici ce ticket.   Cordialement, -- Altidem";
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
tab_etat['7']['state_id'] = "17";
tab_etat['7']['state_close'] = "1";
tab_etat['8'] = new Object();
tab_etat['8']['state_id'] = "18";
tab_etat['8']['state_close'] = "1";

			//Tableau des categories
			tab_cat = new Object();
tab_cat['0'] = new Object();
tab_cat['0']['cat_id'] = "37";
tab_cat['0']['cat_managementgroup'] = "-6";
tab_cat['0']['cat_assignedto'] = "15";
tab_cat['0']['parent'] = "0";
tab_cat['0']['possible_select'] = "1";
tab_cat['0']['group_user'] = "-6,-29";
tab_cat['1'] = new Object();
tab_cat['1']['cat_id'] = "38";
tab_cat['1']['cat_managementgroup'] = "-6";
tab_cat['1']['cat_assignedto'] = "12";
tab_cat['1']['parent'] = "37";
tab_cat['1']['possible_select'] = "1";
tab_cat['1']['group_user'] = "-6,-29";
tab_cat['2'] = new Object();
tab_cat['2']['cat_id'] = "39";
tab_cat['2']['cat_managementgroup'] = "-6";
tab_cat['2']['cat_assignedto'] = "19";
tab_cat['2']['parent'] = "37";
tab_cat['2']['possible_select'] = "1";
tab_cat['2']['group_user'] = "-6,-29";
tab_cat['3'] = new Object();
tab_cat['3']['cat_id'] = "40";
tab_cat['3']['cat_managementgroup'] = "-6";
tab_cat['3']['cat_assignedto'] = "22";
tab_cat['3']['parent'] = "0";
tab_cat['3']['possible_select'] = "1";
tab_cat['3']['group_user'] = "-6,-29";
tab_cat['4'] = new Object();
tab_cat['4']['cat_id'] = "41";
tab_cat['4']['cat_managementgroup'] = "-6";
tab_cat['4']['cat_assignedto'] = "12";
tab_cat['4']['parent'] = "40";
tab_cat['4']['possible_select'] = "1";
tab_cat['4']['group_user'] = "-6,-29";
tab_cat['5'] = new Object();
tab_cat['5']['cat_id'] = "42";
tab_cat['5']['cat_managementgroup'] = "-6";
tab_cat['5']['cat_assignedto'] = "12";
tab_cat['5']['parent'] = "40";
tab_cat['5']['possible_select'] = "1";
tab_cat['5']['group_user'] = "-6,-29";
tab_cat['6'] = new Object();
tab_cat['6']['cat_id'] = "43";
tab_cat['6']['cat_managementgroup'] = "-6";
tab_cat['6']['cat_assignedto'] = "20";
tab_cat['6']['parent'] = "37";
tab_cat['6']['possible_select'] = "1";
tab_cat['6']['group_user'] = "-6,-29";

			
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
groupeClients['-11'] = new Object();
groupeClients['-11']['5'] = "administrateur administrateur";
groupeClients['-10'] = new Object();
groupeClients['-10']['5'] = "administrateur administrateur";
groupeClients['-9'] = new Object();
groupeClients['-9']['5'] = "administrateur administrateur";
groupeClients['-9']['27'] = "Boris Eltsine";
groupeClients['-8'] = new Object();
groupeClients['-8']['5'] = "administrateur administrateur";
groupeClients['-8']['26'] = "Yann Ducrot";
groupeClients['-7'] = new Object();
groupeClients['-7']['5'] = "administrateur administrateur";
groupeClients['-7']['25'] = "Thomas Chaillot";
groupeClients['-6'] = new Object();
groupeClients['-6']['5'] = "administrateur administrateur";
groupeClients['-6']['12'] = "Alexis Batard";
groupeClients['-6']['13'] = "Arnaud Gauci";
groupeClients['-6']['14'] = "Candida Leconte";
groupeClients['-6']['15'] = "cathy fourcade";
groupeClients['-6']['16'] = "Farah Majoubi";
groupeClients['-6']['17'] = "Floreal Sotto";
groupeClients['-6']['28'] = "Gregoire Gousseff";
groupeClients['-6']['18'] = "Julien Viteau";
groupeClients['-6']['20'] = "Sandrine Mendes-Furtado";
groupeClients['-6']['21'] = "simon Miclet";
groupeClients['-6']['22'] = "Sylvia Cleff";
groupeClients['-6']['23'] = "Sylvia Sagot";
groupeClients['-6']['24'] = "Wilfried Converti";

				//Tableau des membrerGroupesDuUser
				membrerGroupesDuUser = new Object();
membrerGroupesDuUser['-29'] = new Object();
membrerGroupesDuUser['-29']['12'] = "alexis.batard";
membrerGroupesDuUser['-29']['28'] = "gregoire.gousseff";
membrerGroupesDuUser['-6'] = new Object();
membrerGroupesDuUser['-6']['5'] = "administrateur";
membrerGroupesDuUser['-6']['12'] = "alexis.batard";
membrerGroupesDuUser['-6']['13'] = "arnaud.gauci";
membrerGroupesDuUser['-6']['14'] = "candida.leconte";
membrerGroupesDuUser['-6']['15'] = "cathy.fourcade";
membrerGroupesDuUser['-6']['16'] = "farah.majoubi";
membrerGroupesDuUser['-6']['17'] = "floreal.sotto";
membrerGroupesDuUser['-6']['28'] = "gregoire.gousseff";
membrerGroupesDuUser['-6']['18'] = "julien.viteau";
membrerGroupesDuUser['-6']['19'] = "louis.thomson";
membrerGroupesDuUser['-6']['20'] = "sandrine.mendesfurtado";
membrerGroupesDuUser['-6']['21'] = "simon.miclet";
membrerGroupesDuUser['-6']['22'] = "sylvia.cleff";
membrerGroupesDuUser['-6']['23'] = "sylvia.sagot";
membrerGroupesDuUser['-6']['24'] = "wilfried.converti";

				//Tableau des tabDefault
				tabDefault = new Object();
tabDefault['assigned_to_id'] = "5";
tabDefault['5'] = "administrateur";
tabDefault['group_management_id'] = "-6";
tabDefault['group_management_value'] = "ALTIDEM";
tabDefault['group_management_value_users'] = new Object();
tabDefault['group_management_value_users']['5'] = "administrateur";
tabDefault['group_management_value_users']['12'] = "alexis.batard";
tabDefault['group_management_value_users']['13'] = "arnaud.gauci";
tabDefault['group_management_value_users']['14'] = "candida.leconte";
tabDefault['group_management_value_users']['15'] = "cathy.fourcade";
tabDefault['group_management_value_users']['16'] = "farah.majoubi";
tabDefault['group_management_value_users']['17'] = "floreal.sotto";
tabDefault['group_management_value_users']['18'] = "julien.viteau";
tabDefault['group_management_value_users']['19'] = "louis.thomson";
tabDefault['group_management_value_users']['20'] = "sandrine.mendesfurtado";
tabDefault['group_management_value_users']['21'] = "simon.miclet";
tabDefault['group_management_value_users']['22'] = "sylvia.cleff";
tabDefault['group_management_value_users']['23'] = "sylvia.sagot";
tabDefault['group_management_value_users']['24'] = "wilfried.converti";
tabDefault['group_management_value_users']['28'] = "gregoire.gousseff";
tabDefault['demandeur'] = new Object();
tabDefault['demandeur']['28'] = "gregoire.gousseff";

				//Tableau des groupesDuUser
				groupesDuUser = new Object();
groupesDuUser['-6'] = "ALTIDEM";
groupesDuUser['-29'] = "ALTIDEM-GESTION";

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
							if(g==28){
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