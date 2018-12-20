<?php
class ResaccRedactionForm extends Zend_Form
{

	


    public function __construct($options = null)
    {
        parent::__construct($options);
		
        $this->setName('resacc');
		


$this->setAction('')
     ->setMethod('post');

	
 //Nom commercial
 	   
       $nom_commercial=$this->CreateElement('text','nom_commercial');
	   $nom_commercial->setValue(Zend_Registry::get('resacc')->nom_commercial);

 //Raison sociale
 	   
       $raison_sociale=$this->CreateElement('text','raison_sociale');
	   $raison_sociale->setValue(Zend_Registry::get('resacc')->raison_sociale);
	   
//activite principale
 	   
       $activite_principale=$this->CreateElement('text','activite_principale');
	   $activite_principale->setValue(Zend_Registry::get('resacc')->activite_principale);	

//date immat
 	   
       $date_immat=$this->CreateElement('text','date_immat');
	   
	   $date_immat->setValue(date("d/m/Y",Zend_Registry::get('resacc')->date_immat));	   

//siret
 	   
       $siret=$this->CreateElement('text','siret');
	   $siret->setValue(Zend_Registry::get('resacc')->siret);
	   
//code naf
 	   
       $code_naf=$this->CreateElement('text','code_naf');
	   $code_naf->setValue(Zend_Registry::get('resacc')->code_naf);	
	   //pr�paration de la liste d'autocompl�mentation
	   $code_naf->id = 'code_naf';
	   $code_naf->setAttrib('autocomplete', 'off');
	   $code_naf->setAttrib('onBlur', 'fill_codenaf();');
	   $code_naf->setAttrib('onKeyUp', 'lookup("code_naf",this.value,"CodeNaf");');
	   
	   

//date debut activite
 	   
       $date_debut_activite=$this->CreateElement('text','date_debut_activite');
	   $date_debut_activite->setValue(date("d/m/Y",Zend_Registry::get('resacc')->date_debut_activite));	
	   $date_debut_activite->id = 'date_debut_activite';
//type adresse
 	   
        //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur = $BanqueTexte->get_value('type_adresse');
		//r�cup�ration de la valeur
		$tableau[''.Zend_Registry::get('resacc')->type_adresse.''] = Zend_Registry::get('resacc')->type_adresse;
		foreach( $valeur as $i=>$data )
		{
		$tableau[$data->valeur] =$data->valeur;
		
		}
	    $type_adresse=$this->CreateElement('select','type_adresse');
	  			
		$type_adresse->addMultiOptions($tableau);
		// permet de laisser passer les valeurs string
	    $type_adresse->setRegisterInArrayValidator(false);                  
		$type_adresse->setAttrib('style', 'width:250px');

//rue
 	   
       $adresse_ligne_1=$this->CreateElement('text','adresse_ligne_1');
	   $adresse_ligne_1->setValue(Zend_Registry::get('resacc')->adresse_ligne_1);

//adresse ligne 2
 	   
       $adresse_ligne_2=$this->CreateElement('text','adresse_ligne_2');
	   $adresse_ligne_2->setValue(Zend_Registry::get('resacc')->adresse_ligne_2);

//adresse ligne 3
 	   
       $adresse_ligne_3=$this->CreateElement('text','adresse_ligne_3');
	   $adresse_ligne_3->setValue(Zend_Registry::get('resacc')->adresse_ligne_3);
	   
//code postal
 	   
       $cp=$this->CreateElement('text','cp');
	   $cp->setValue(Zend_Registry::get('resacc')->cp);
	   //drenault pr�paration de la liste d'autocompl�mentation
	   $cp->id = 'cp';
	   $cp->setAttrib('autocomplete', 'off');
	   $cp->setAttrib('onBlur', 'fill_codepostal();');
	   $cp->setAttrib('onKeyUp', 'lookup("code_postal",this.value,"Cp");');
	 
	   ////////////////////////////////////////////////////////
//ville
 	   
       $ville=$this->CreateElement('text','ville');
	   $ville->setValue(Zend_Registry::get('resacc')->ville);	 
	   $ville->id = 'ville';
	   $ville->setAttrib('autocomplete', 'off');
	   $ville->setAttrib('onBlur', 'fill();');
	   $ville->setAttrib('onKeyUp', 'lookup("code_postal",this.value);');
//region
 	   
       $region=$this->CreateElement('text','region');
	   $region->setValue(Zend_Registry::get('resacc')->region);
	   $region->id = 'region';
//pays
 	   
       $pays=$this->CreateElement('text','pays');
	   $pays->setValue(Zend_Registry::get('resacc')->pays);	 
	   $pays->id = 'pays';
//dirigeant
 	   
       /*$dirigeant=$this->CreateElement('text','dirigeant');
	   $dirigeant->setValue(Zend_Registry::get('resacc')->dirigeant);*/
				
	    $dirigeant=$this->CreateElement('select','dirigeant');
	  			
		$dirigeant->addMultiOptions(array(''=>'', 'Le bénéficiaire'=>'Le bénéficiaire',"L'Associé"=>"L'Associé"));
		// permet de laisser passer les valeurs string
	    $dirigeant->setRegisterInArrayValidator(false);                  
		$dirigeant->setAttrib('style', 'width:250px');
		$dirigeant->setValue(Zend_Registry::get('resacc')->dirigeant);
		
		
	   

//forme juridique
 	   
			
		 //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_forme_juridique = $BanqueTexte->get_value('forme_juridique');
		//r�cup�ration de la valeur
		$tableau_forme_juridique[''.Zend_Registry::get('resacc')->forme_juridique.''] = Zend_Registry::get('resacc')->forme_juridique;
		foreach( $valeur_forme_juridique as $i=>$data_forme_juridique )
		{
		$tableau_forme_juridique[$data_forme_juridique->valeur] =$data_forme_juridique->valeur;
		
		}
	    $forme_juridique=$this->CreateElement('select','forme_juridique');
	  			
		$forme_juridique->addMultiOptions($tableau_forme_juridique);
		// permet de laisser passer les valeurs string
	    $forme_juridique->setRegisterInArrayValidator(false);                  
		$forme_juridique->setAttrib('style', 'width:250px');
	   

//implantation
 	   
       //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_implantation = $BanqueTexte->get_value('Implantation');
		//r�cup�ration de la valeur
		$tableau_implantation[''.Zend_Registry::get('resacc')->implantation.''] = Zend_Registry::get('resacc')->implantation;
		foreach( $valeur_implantation as $i=>$data_implantation )
		{
		$tableau_implantation[$data_implantation->valeur] =$data_implantation->valeur;
		
		}
	    $implantation=$this->CreateElement('select','implantation');
	  			
		$implantation->addMultiOptions($tableau_implantation);
		// permet de laisser passer les valeurs string
	    $implantation->setRegisterInArrayValidator(false);                  
		$implantation->setAttrib('style', 'width:250px');

//secteur d'activite
 	  
	    // drenault : recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_secteur_activite = $BanqueTexte->get_value('secteur_activite');
		//r�cup�ration de la valeur
		$tableau_secteur_activite[''.Zend_Registry::get('resacc')->secteur_activite.''] = Zend_Registry::get('resacc')->secteur_activite;
		foreach( $valeur_secteur_activite as $i=>$data_secteur_activite )
		{
		$tableau_secteur_activite[$data_secteur_activite->valeur] =$data_secteur_activite->valeur;
		
		}
	    $secteur_activite=$this->CreateElement('select','secteur_activite');
	  			
		$secteur_activite->addMultiOptions($tableau_secteur_activite);
		// permet de laisser passer les valeurs string
	    $secteur_activite->setRegisterInArrayValidator(false);                  
		$secteur_activite->setAttrib('style', 'width:250px');
	   
	   
//regime d'imposition
 	   
        //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_regime_imposition = $BanqueTexte->get_value('regime_imposition');
		//r�cup�ration de la valeur
		$tableau_regime_imposition[''.Zend_Registry::get('resacc')->regime_imposition.''] = Zend_Registry::get('resacc')->regime_imposition;
		foreach( $valeur_regime_imposition as $i=>$data_regime_imposition )
		{
		$tableau_regime_imposition[$data_regime_imposition->valeur] =$data_regime_imposition->valeur;
		
		}
	    $regime_imposition=$this->CreateElement('select','regime_imposition');
	  			
		$regime_imposition->addMultiOptions($tableau_regime_imposition);
		// permet de laisser passer les valeurs string
	    $regime_imposition->setRegisterInArrayValidator(false);                  
		$regime_imposition->setAttrib('style', 'width:250px');	

//regime de tva
 	   
       //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_regime_tva = $BanqueTexte->get_value('Regime_tva');
		//r�cup�ration de la valeur
		$tableau_regime_tva[''.Zend_Registry::get('resacc')->regime_tva.''] = Zend_Registry::get('resacc')->regime_tva;
		foreach( $valeur_regime_tva as $i=>$data_regime_tva )
		{
		$tableau_regime_tva[$data_regime_tva->valeur] =$data_regime_tva->valeur;
		
		}
	    $regime_tva=$this->CreateElement('select','regime_tva');
	  			
		$regime_tva->addMultiOptions($tableau_regime_tva);
		// permet de laisser passer les valeurs string
	    $regime_tva->setRegisterInArrayValidator(false);                  
		$regime_tva->setAttrib('style', 'width:250px');	

//regime fiscal
 	   
        //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_regime_fiscal = $BanqueTexte->get_value('regime_fiscal');
		//r�cup�ration de la valeur
		$tableau_regime_fiscal[''.Zend_Registry::get('resacc')->regime_fiscal.''] = Zend_Registry::get('resacc')->regime_fiscal;
		foreach( $valeur_regime_fiscal as $i=>$data_regime_fiscal )
		{
		$tableau_regime_fiscal[$data_regime_fiscal->valeur] =$data_regime_fiscal->valeur;
		
		}
	    $regime_fiscal=$this->CreateElement('select','regime_fiscal');
	  			
		$regime_fiscal->addMultiOptions($tableau_regime_fiscal);
		// permet de laisser passer les valeurs string
	    $regime_fiscal->setRegisterInArrayValidator(false);                  
		$regime_fiscal->setAttrib('style', 'width:250px');	
	   
//regime social du dirigeant
 	   
       //recup�ration des valeurs sous forme de tableau en fonction de la cl� get_value($cle);
		$BanqueTexte = new BanquetexteTb();
		$valeur_regime_social = $BanqueTexte->get_value('Regime_social_dirigeant');
		//r�cup�ration de la valeur
		$tableau_regime_social[''.Zend_Registry::get('resacc')->regime_social_dirigeant.''] = Zend_Registry::get('resacc')->regime_social_dirigeant;
		foreach( $valeur_regime_social as $i=>$data_regime_social )
		{
		$tableau_regime_social[$data_regime_social->valeur] =$data_regime_social->valeur;
		
		}
	    $regime_social_dirigeant=$this->CreateElement('select','regime_social_dirigeant');
	  			
		$regime_social_dirigeant->addMultiOptions($tableau_regime_social);
		// permet de laisser passer les valeurs string
	    $regime_social_dirigeant->setRegisterInArrayValidator(false);                  
		$regime_social_dirigeant->setAttrib('style', 'width:250px');	
	   
//statut
 	   
       /*$statut=$this->CreateElement('text','statut');
	   $statut->setValue(Zend_Registry::get('resacc')->statut);*/
	   
	   
	   $statut=$this->CreateElement('select','statut');
	  			
		$statut->addMultiOptions(array(''=>'', 'En cours'=>'En cours','Créé'=>'Créé','Annulé'=>'Annulé'));
		// permet de laisser passer les valeurs string
	    $statut->setRegisterInArrayValidator(false);                  
		$statut->setAttrib('style', 'width:250px');
	   $statut->setValue(Zend_Registry::get('resacc')->statut);
	   

//submit		
       $submit=$this->CreateElement('submit','submit');
	   $submit->class = 'button';
	   
       $this->addElements(array(
                 
    	   	$nom_commercial,
			$raison_sociale,
 			$activite_principale,
			$date_immat,  
			$siret,
 			$code_naf,
 			$date_debut_activite,
			$type_adresse,
			$adresse_ligne_1,
 			$adresse_ligne_2,
 			$adresse_ligne_3,
			$cp,
 			$ville,
			$region,
 			$pays,
 			$dirigeant,
 			$forme_juridique,
   			$implantation,
 			$secteur_activite,
 			$regime_imposition,   
  			$regime_tva,
  			$regime_fiscal,
 			$regime_social_dirigeant,	   
 			$statut,
			$submit,
			 
              
       ));
	foreach($this->getElements() as $element) {
$element->removeDecorator('DtDdWrapper');
$element->removeDecorator('HtmlTag'); 
$element->removeDecorator('Label');
}
  

     




	   
    }
}
?>