<?php


class AjaxController extends Zend_Controller_Action
{
  
  
  function ajaxAction()
	{
$bp = unserialize($_SESSION['session']->bp);
$this->view->setEncoding("UTF-8");
header('Content-Type: text/html; charset=UTF-8');

		if($_GET['action']=="code_postal")
			{
				//appel de la table (codepostal)	
				$cp = new CodePostalTb();
				$cp->ajaxSelectionnerData($_GET['queryString']);
			}
		elseif($_GET['action']=="code_naf")
			{
				//appel de la table (code_naf)	
				$code_naf = new CodeNafTb();
				$code_naf->ajaxSelectionnerData($_GET['queryString']);
			}
		elseif($_GET['action']=="setValidation")
			{
				
				
				//Set Validation
				$TitreValidation = new TitreValidationTb();
				$TitreValidation->updateValidation($_GET['val'],$_GET['champ'],$bp->id_bp);
			}
	elseif($_GET['action']=="ajouterProduitsConcurrents")
			{
				
				$produitsConcurrents = new ProduitsConcurrentsTb();
				$produitsConcurrents->ajouterProduits($bp->id_bp,$_GET['idProduit']);
			}
	elseif($_GET['action']=="deleteProduitsConcurrents")
			{
				
				$produitsConcurrents = new ProduitsConcurrentsTb();
				$produitsConcurrents->delete($_GET['idProduitsConcurrents']);
			}
	elseif($_GET['action']=="deleteProduitsConcurrentsDetails")
			{
				
				$produitsConcurrentsDetails = new ProduitsConcurrentsDetailsTb();
				$produitsConcurrentsDetails->delete($_GET['id_produits_concurrents_details']);
			}
	elseif($_GET['action']=="deleteActionCommerciale")
			{
				
				$actionCommerciale = new ActionCommercialeTb();
				$actionCommerciale->delete($_GET['id_action_commerciale']);
			}
		
	elseif($_GET['action']=="getListProduitsConcurrents")
			{
				
				$produitsConcurrents = new ProduitsConcurrentsTb();
				$list = $produitsConcurrents->getList($bp->id_bp);
				//print_r($list);
				echo json_encode($list);
			}
		elseif($_GET['action']=="getListProduitsConcurrentsDetails")
			{
				
				$produitsConcurrentsDetails = new ProduitsConcurrentsDetailsTb();
				$list = $produitsConcurrentsDetails->getList($_GET['id_produits_concurrents']);
				//print_r($list);
				echo json_encode($list);
			
			}
	elseif($_GET['action']=="getListActionCommerciale")
			{
				
				$actionCommerciale = new ActionCommercialeTb();
				$list = $actionCommerciale->getList($bp->id_bp);
				
				for($i=0;$i<count($list);$i++)
				{
					if($list[$i]['date_debut']!=0)
					{
						$list[$i]['date_debut'] = date('d/m/Y',$list[$i]['date_debut']) ;
					}
					else
					{
					$list[$i]['date_debut']='';
					}
				
					if($list[$i]['date_fin']!=0)
					{
						$list[$i]['date_fin'] = date('d/m/Y',$list[$i]['date_fin']) ;
					}
					else
					{
					$list[$i]['date_fin']='';
					}
					
				}
				echo json_encode($list);
			
			}
	elseif($_GET['action']=="ajouterProduitsConcurrentsDetails")
			{
				
				$produitsConcurrentsDetails = new ProduitsConcurrentsDetailsTb();
				$produitsConcurrentsDetails->ajouterProduitsDetails($_GET['id_produits_concurrents'],$_GET['libelle_details'],$_GET['valeur']);
		
			}
	elseif($_GET['action']=="ajouterActionCommerciale")
			{
				$dateDeb=explode('/',$_GET['dateDebut']);
				$dateDeb = mktime(0,0,0,$dateDeb[1],$dateDeb[0],$dateDeb[2]);
				$dateFin=explode('/',$_GET['dateFin']);
				$dateFin = mktime(0,0,0,$dateFin[1],$dateFin[0],$dateFin[2]);
				$ajouterActionCommerciale = new ActionCommercialeTb();
				$ajouterActionCommerciale->ajouterActionCommerciale($bp->id_bp,$_GET['action_commerciale'],$_GET['budget'],$dateDeb,$dateFin,$_GET['ca_escompte']);
		
			}
			
			elseif($_GET['action']=="modifierActionCommerciale")
			{
				
				$actionCommerciale = new ActionCommercialeTb();
				$actionCommerciale->modifierActionCommerciale($_GET['id_action_commerciale'],$_GET['action_commerciale'],$_GET['budget'],$_GET['periode'],$_GET['ca_escompte']);
			}
	elseif($_GET['action']=="getListTableauSwot")
			{				
				$tableauSwot = new TableauSwotTb();
				$text = $tableauSwot->getText($bp->id_bp);
				
			
				echo json_encode($text);
			
			}
	elseif($_GET['action']=="ajouterTableauSwot")
			{
				
				$tableauSwot = new TableauSwotTb();
				$tableauSwot->ajouterText($bp->id_bp,  unserialize($GLOBALS['session']->account)->account_id,$_GET['text_forces'],$_GET['text_faiblesses'],$_GET['text_opportunites'],$_GET['text_menaces']);
			}
			elseif($_GET['action']=="modifierTableauSwot")
			{
				
				$modifierTabSwot = new TableauSwotTb();
				$modifierTabSwot->modifierText($_GET['id_tableau_swot'],unserialize($GLOBALS['session']->account)->account_id,$_GET['text_forces'],$_GET['text_faiblesses'],$_GET['text_opportunites'],$_GET['text_menaces']);
			}
			
	elseif($_GET['action']=="ajouterFamilleProduits")
			{
				
				$famille = new GestionFamillesProduitsTb();
				$famille->ajouterFamille($bp->id_bp, $_GET['libelleFamille']);
			}
	elseif($_GET['action']=="modifierFamilleProduits")
			{
				
				$famille = new GestionFamillesProduitsTb();
				$famille->modifierFamille($_GET['idFamille'], $_GET['libelleFamille']);
			}
	elseif($_GET['action']=="getListFamilleProduits")
			{				
				$famille = new GestionFamillesProduitsTb();
				$list = $famille->getList();
				for($i=0;$i<count($list);$i++)
				{
					
					$list[$i]['date_creation'] = date('d/m/y',$list[$i]['date_creation']);
					
				}
			
				echo json_encode($list);
			
			}	
			
	elseif($_GET['action']=="deleteFamilleProduits")
			{
				
				$famille = new GestionFamillesProduitsTb();
				$famille->delete($_GET['idFamilleProduits']);
			}
			
	elseif($_GET['action']=="ajouterGammeProduits")
			{
				
				$gamme = new GestionGammesProduitsTb();
				$gamme->ajouterGamme($bp->id_bp,$_GET['idFamille'],$_GET['libelleGamme']);
			}
			
	elseif($_GET['action']=="getListGammeProduits")
			{				
				$gamme = new GestionGammesProduitsTb();
				$list = $gamme->getList('utf8',$_GET['idFamille']);
				
				echo json_encode($list);
			
			}
			
	elseif($_GET['action']=="modifierGammeProduits")
			{
				
				$gamme = new GestionGammesProduitsTb();
				$gamme->modifierGamme($_GET['idGamme'], $_GET['libelleGamme']);
			}
	elseif($_GET['action']=="deleteGammeProduits")
			{
				
				$gamme = new GestionGammesProduitsTb();
				$gamme->delete($_GET['idGammeProduits']);
			}
			
				
	elseif($_GET['action']=="ajouterProduits")
			{
				
				$produit = new GestionProduitsTb();
				$produit->ajouterProduit($bp->id_bp,$_GET['idFamille'],$_GET['idGamme'],$_GET['libelleProduit'],str_replace(',','.',$_GET['prixAchat']),str_replace(',','.',$_GET['prixVente']),$_GET['stock']);
			}
			
	elseif($_GET['action']=="getListProduits")
			{				
				$produit = new GestionProduitsTb();
				$list = $produit->getList('utf8',$bp->id_bp,$_GET['idProduit']);
				
				echo json_encode($list);
			
			}
			
	elseif($_GET['action']=="modifierProduits")
			{
				
				$produit = new GestionProduitsTb();
				$produit->modifierProduit($_GET['idFamille'],$_GET['idGamme'],$_GET['idProduit'], $_GET['libelleProduit'],str_replace(',','.',$_GET['prixAchat']),str_replace(',','.',$_GET['prixVente']),$_GET['stock']);
			}
			
	elseif($_GET['action']=="deleteProduits")
			{
				
				$produit = new GestionProduitsTb();
				$produit->delete($_GET['idProduit']);
			}
			
	elseif($_GET['action']=="ajouterRessource")
			{
				
				$ressource = new RessourceTb();
				$ressource->ajouterRessource($_GET['idRessourceCreateur'],  unserialize($_SESSION['session']->account)->account_id,$bp->id_bp,'createur',$_GET['revenuCreateur'],$_GET['revenuRetraiteCreateur'],$_GET['revenuPoleCreateur'],$_GET['revenuPensionCreateur'],$_GET['revenuRsaCreateur'],$_GET['revenuPfCreateur'],$_GET['revenuAideCreateur'],$_GET['revenuAlloCreateur'],$_GET['revenuAutreCreateur']);
				$ressource->ajouterRessource($_GET['idRessourceConjoint'],unserialize($_SESSION['session']->account)->account_id,$bp->id_bp,'conjoint',$_GET['revenuConjoint'],$_GET['revenuRetraiteConjoint'],$_GET['revenuPoleConjoint'],$_GET['revenuPensionConjoint'],$_GET['revenuRsaConjoint'],$_GET['revenuPfConjoint'],
				$_GET['revenuAideConjoint'],$_GET['revenuAlloConjoint'],$_GET['revenuAutreConjoint']);
			
				
				$revenuTotal = substr($_GET['revenuTotalTotal'],0,(strlen($_GET['revenuTotalTotal'])-1));
				$chargeTotal = substr($_GET['chargeMontantTotal'],0,(strlen($_GET['chargeMontantTotal'])-1));
				
				
				//creation du graphique
				//remplacement//
				unlink('./dompdf/www/test/images/'.$bp->id_bp.'_ressource_charge.png');
				
				$image = new ImageGraph();
				$data[0]=$revenuTotal;
				$data[1]=$chargeTotal;
				$dataColor[0]="#89AFBD";
				$dataColor[1]="#F44853";
				
				$image->createCamembert($data,$dataColor, $bp->id_bp.'_ressource_charge','Environnement financier');
				
			}
	elseif($_GET['action']=="ajouterCharge")
			{
				
				$charge = new ChargeTb();
				$charge->ajouterCharge($_GET['idChargeMontant'],unserialize($_SESSION['session']->account)->account_id,$bp->id_bp,'montant',$_GET['chargeLoyer'],$_GET['chargeCreCon'],$_GET['chargeCreAu'],$_GET['chargeCreIm'],$_GET['chargePa'],$_GET['chargeCr'],$_GET['chargeAutre']);
				$charge->ajouterCharge($_GET['idChargeDuree'],unserialize($_SESSION['session']->account)->account_id,$bp->id_bp,'duree',$_GET['chargeDureeLoyer'],$_GET['chargeDureeCreCon'],$_GET['chargeDureeCreAu'],$_GET['chargeDureeCreIm'],$_GET['chargeDureePa'],$_GET['chargeDureeCr'],$_GET['chargeDureeAutre']);
			}
			
	elseif($_GET['action']=="ajouterMoyenHumain")
			{
				
				$moyen = new MoyenHumainTb();
				$moyen->ajouterMoyenHumain($_GET['id_bp_moyen_humainP'],$bp->id_bp,"productif",$_GET['salaireProductif'],$_GET['debutProductif'],$_GET['unProductif'],$_GET['deuxProductif'],$_GET['troisProductif']);
				$moyen->ajouterMoyenHumain($_GET['id_bp_moyen_humainE'],$bp->id_bp,"encadrement",$_GET['salaireEncadrement'],$_GET['debutEncadrement'],$_GET['unEncadrement'],$_GET['deuxEncadrement'],$_GET['troisEncadrement']);
				$moyen->ajouterMoyenHumain($_GET['id_bp_moyen_humainC'],$bp->id_bp,"commercial",$_GET['salaireCommercial'],$_GET['debutCommercial'],$_GET['unCommercial'],$_GET['deuxCommercial'],$_GET['troisCommercial']);
				$moyen->ajouterMoyenHumain($_GET['id_bp_moyen_humainA'],$bp->id_bp,"administration",$_GET['salaireAdministration'],$_GET['debutAdministration'],$_GET['unAdministration'],$_GET['deuxAdministration'],$_GET['troisAdministration']);
				
				//creation du graphique
				//remplacement//
				unlink('./dompdf/www/test/images/'.$bp->id_bp.'_moyen_humain.png');
				$image = new ImageGraph();
				$data['intitule'][0]="Année 1";
				$data['intitule'][1]="Année 2";
				$data['intitule'][2]="Année 3";
				$data['valeur'][0]=$_GET['ms_un'];
				$data['valeur'][1]=$_GET['ms_deux'];
				$data['valeur'][2]=$_GET['ms_trois'];
				$image->createBarGradient($data, $bp->id_bp.'_moyen_humain','Moyen Humain : Masse salariale annuelle en E');
				
			}
			
		elseif($_GET['action']=="ajouterMoyenImmTerrain")
			{
				
				$moyen = new MoyenImmTerrainTb();
				$moyen->ajouterMoyenImmTerrain($_GET['id_bp_moyen_immA'],$bp->id_bp,"achat",$_GET['demarrageAchat'],$_GET['unAchat'],$_GET['deuxAchat'],$_GET['troisAchat']);
				$moyen->ajouterMoyenImmTerrain($_GET['id_bp_moyen_immL'],$bp->id_bp,"location",$_GET['demarrageLocation'],$_GET['unLocation'],$_GET['deuxLocation'],$_GET['troisLocation']);
				$moyen->ajouterMoyenImmTerrain($_GET['id_bp_moyen_immC'],$bp->id_bp,"credit",$_GET['demarrageCredit'],$_GET['unCredit'],$_GET['deuxCredit'],$_GET['troisCredit']);
				
				
			
			}
			
			
	}

	
}