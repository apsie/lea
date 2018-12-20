<?php
class RedactionForm extends Zend_Form
{
/*
	protected $nbr_caractere_intro = 7100;
	protected $nbr_caractere_titre_1_1 = 7100;
	protected $nbr_caractere_titre_1_2 = 7100;
	protected $nbr_caractere_titre_2_1 = 7100;
	protected $nbr_caractere_titre_2_2 = 7100;
	protected $nbr_caractere_titre_2_3 = 7100;
	protected $nbr_caractere_titre_3_0 = 7100;
	protected $nbr_caractere_titre_3_1_1 = 7100;
	protected $nbr_caractere_titre_3_1_2 = 7100;
	protected $nbr_caractere_titre_3_2_1 = 7100;
	protected $nbr_caractere_titre_3_2_2 = 7100;
	protected $nbr_caractere_titre_3_2_3 = 7100;
	protected $nbr_caractere_titre_3_3_1 = 7100;
	protected $nbr_caractere_titre_3_3_2 = 7100;
	protected $nbr_caractere_titre_3_3_3 = 7100;
	protected $nbr_caractere_titre_3_4 = 7100;
	protected $nbr_caractere_titre_4_1 = 7100;
	protected $nbr_caractere_titre_4_2_1 = 7100;
	protected $nbr_caractere_titre_4_2_2 = 7100;
	protected $nbr_caractere_titre_4_2_3 = 7100;
	protected $nbr_caractere_titre_4_2_4 = 7100;
	protected $nbr_caractere_titre_4_3_1 = 7100;
	protected $nbr_caractere_titre_4_3_2 = 7100;
	protected $nbr_caractere_titre_4_3_3 = 7100;
	protected $nbr_caractere_titre_4_4_1 = 7100;
	protected $nbr_caractere_titre_4_4_2 = 7100;
	protected $nbr_caractere_titre_4_4_3 = 7100;
	protected $nbr_caractere_titre_5 = 7100;
	protected $nbr_caractere_titre_6_1 = 7100;
	protected $nbr_caractere_titre_6_2 = 7100;
	protected $nbr_caractere_titre_6_3 = 7100;
	protected $nbr_caractere_titre_7 = 7100;
	protected $nbr_caractere_titre_8 = 7100;
	protected $nbr_caractere_titre_9 = 7100;
	
*/

    public function __construct($options = null)
    {
        parent::__construct($options);
		
        $this->setName('Redaction');
		


$this->setAction('')
     ->setMethod('post');

/*
	 
 //intro  
 	   
       $intro=$this->CreateElement('textarea','intro');
   	   $intro->id = 'editor_office2003';
	   $intro->addValidator('StringLength', false,array(0,$this->nbr_caractere_intro));
       $intro->setValue(Zend_Registry::get('texte')->texte_titre_intro);
	   
 //texte_titre_1_1  
 	   
		$texte_titre_1_1=$this->CreateElement('textarea','texte_titre_1_1');
		$texte_titre_1_1->id = 'editor_office2003';
		$texte_titre_1_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_1_1));
		$texte_titre_1_1->setValue(Zend_Registry::get('texte')->texte_titre_1_1);	   
	 
 //texte_titre_1_2  
 	   
       //$texte_titre_1_2=$this->CreateElement('textarea','texte_titre_1_2');
   	   //$texte_titre_1_2->id = 'editor_office2003';
	   //$texte_titre_1_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_1_2));
	   //$texte_titre_1_2->setValue(Zend_Registry::get('texte')->texte_titre_1_2);	   
*/
     
      
      $texte_titre_financier_1_1=$this->CreateElement('textarea','texte_titre_financier_1_1');
   	   $texte_titre_financier_1_1->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_financier_1_1->setValue(Zend_Registry::get('texteFinancier')->texte_titre_1_1);
	   
	   
        $texte_titre_financier_1_2=$this->CreateElement('textarea','texte_titre_financier_1_2');
   	   $texte_titre_financier_1_2->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_financier_1_2->setValue(Zend_Registry::get('texteFinancier')->texte_titre_1_2);
	   
	   
      $texte_titre_aspect_1=$this->CreateElement('textarea','texte_titre_aspect_1');
   	   $texte_titre_aspect_1->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_aspect_1->setValue(Zend_Registry::get('texteAspect')->texte_titre_1);
	   
	       $texte_titre_aspect_2=$this->CreateElement('textarea','texte_titre_aspect_2');
   	   $texte_titre_aspect_2->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_aspect_2->setValue(Zend_Registry::get('texteAspect')->texte_titre_2);
	   
	       $texte_titre_aspect_3=$this->CreateElement('textarea','texte_titre_aspect_3');
   	   $texte_titre_aspect_3->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_aspect_3->setValue(Zend_Registry::get('texteAspect')->texte_titre_3);
	   
	   
     //texte_titre_2_1  
 	   
       $texte_titre_projet_2_1=$this->CreateElement('textarea','texte_titre_projet_2_1');
   	   $texte_titre_projet_2_1->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_2_1->setValue(Zend_Registry::get('texteProjet')->texte_titre_2_1);	
	   
	     //texte_titre_2_2  
 	   
       $texte_titre_projet_2_2=$this->CreateElement('textarea','texte_titre_projet_2_2');
   	   $texte_titre_projet_2_2->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_2_2->setValue(Zend_Registry::get('texteProjet')->texte_titre_2_2);
	   
	   
	        //texte_titre_2_3  
 	   
       $texte_titre_projet_2_3=$this->CreateElement('textarea','texte_titre_projet_2_3');
   	   $texte_titre_projet_2_3->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_2_3->setValue(Zend_Registry::get('texteProjet')->texte_titre_2_3);
	   
	   
	        //texte_titre_2_4  
 	   
       $texte_titre_projet_2_4=$this->CreateElement('textarea','texte_titre_projet_2_4');
   	   $texte_titre_projet_2_4->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_2_4->setValue(Zend_Registry::get('texteProjet')->texte_titre_2_4);
	   
	   
	   
     //texte_titre_1_1  
 	   
       $texte_titre_projet_1_1=$this->CreateElement('textarea','texte_titre_projet_1_1');
   	   $texte_titre_projet_1_1->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_1->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_1);	
	   
	     //texte_titre_1_2  
 	   
       $texte_titre_projet_1_2=$this->CreateElement('textarea','texte_titre_projet_1_2');
   	   $texte_titre_projet_1_2->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_2->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_2);
	   
	   
	        //texte_titre_1_3  
 	   
       $texte_titre_projet_1_3=$this->CreateElement('textarea','texte_titre_projet_1_3');
   	   $texte_titre_projet_1_3->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_3->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_3);
	   
	   
	        //texte_titre_1_4  
 	   
       $texte_titre_projet_1_4=$this->CreateElement('textarea','texte_titre_projet_1_4');
   	   $texte_titre_projet_1_4->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_4->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_4);
	   
	   
	        //texte_titre_1_5  
 	   
       $texte_titre_projet_1_5=$this->CreateElement('textarea','texte_titre_projet_1_5');
   	   $texte_titre_projet_1_5->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_5->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_5);
	   
	   
	        //texte_titre_1_6  
 	   
       $texte_titre_projet_1_6=$this->CreateElement('textarea','texte_titre_projet_1_6');
   	   $texte_titre_projet_1_6->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_projet_1_6->setValue(Zend_Registry::get('texteProjet')->texte_titre_1_6);
	   
	      //texte_titre_3_3 
 	   
       $texte_titre_projet_3_3=$this->CreateElement('textarea','texte_titre_projet_3_3');
   	   $texte_titre_projet_3_3->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_projet_3_3->setValue(Zend_Registry::get('texteProjet')->texte_titre_3_3);
	   
	     //texte_titre_3_4 
 	   
       $texte_titre_projet_3_4=$this->CreateElement('textarea','texte_titre_projet_3_4');
   	   $texte_titre_projet_3_4->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_projet_3_4->setValue(Zend_Registry::get('texteProjet')->texte_titre_3_4);
	   
	   //texte_titre_3_5 
 	   
       $texte_titre_projet_3_5=$this->CreateElement('textarea','texte_titre_projet_3_5');
   	   $texte_titre_projet_3_5->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_projet_3_5->setValue(Zend_Registry::get('texteProjet')->texte_titre_3_5);
	   
//texte_titre_2_1  
 	   
       $texte_titre_presentation_2_1=$this->CreateElement('textarea','texte_titre_presentation_2_1');
   	   $texte_titre_presentation_2_1->id = 'editor_office2003';
	  // $texte_titre_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_1));
	   $texte_titre_presentation_2_1->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_1);	

//texte_titre_2_2  
 	   
       $texte_titre_presentation_2_2=$this->CreateElement('textarea','texte_titre_presentation_2_2');
   	   $texte_titre_presentation_2_2->id = 'editor_office2003';
	//   $texte_titre_2_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_2));
	   $texte_titre_presentation_2_2->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_2);	

//texte_titre_2_3  
 	   
       $texte_titre_presentation_2_3=$this->CreateElement('textarea','texte_titre_presentation_2_3');
   	   $texte_titre_presentation_2_3->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_presentation_2_3->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_3);

//texte_titre_2_4_1  
 	   
      $texte_titre_presentation_2_4_1=$this->CreateElement('textarea','texte_titre_presentation_2_4_1');
   	   $texte_titre_presentation_2_4_1->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_presentation_2_4_1->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_4_1);	

//texte_titre_2_4_2 
 	   
       $texte_titre_presentation_2_4_2=$this->CreateElement('textarea','texte_titre_presentation_2_4_2');
   	   $texte_titre_presentation_2_4_2->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_presentation_2_4_2->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_4_2);		   

	   //texte_titre_2_4_3 
 	   
       $texte_titre_presentation_2_4_3=$this->CreateElement('textarea','texte_titre_presentation_2_4_3');
   	   $texte_titre_presentation_2_4_3->id = 'editor_office2003';
	  // $texte_titre_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_2_3));
	   $texte_titre_presentation_2_4_3->setValue(Zend_Registry::get('textePresentation')->texte_titre_2_4_3);	
	   
	   	
	   
	   /*	   
//texte_titre_3_0  
 	   
       $texte_titre_3_0=$this->CreateElement('textarea','texte_titre_3_0');
   	   $texte_titre_3_0->id = 'editor_office2003';
	   $texte_titre_3_0->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_0));
	   $texte_titre_3_0->setValue(Zend_Registry::get('texte')->texte_titre_3_0);
	   
//texte_titre_3_1_1 
 	   
       $texte_titre_3_1_1=$this->CreateElement('textarea','texte_titre_3_1_1');
   	   $texte_titre_3_1_1->id = 'editor_office2003';
	   $texte_titre_3_1_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_1_1));
	   $texte_titre_3_1_1->setValue(Zend_Registry::get('texte')->texte_titre_3_1_1);		   
//texte_titre_3_1_2  
 	   
       $texte_titre_3_1_2=$this->CreateElement('textarea','texte_titre_3_1_2');
   	   $texte_titre_3_1_2->id = 'editor_office2003';
	   $texte_titre_3_1_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_1_2));
	   $texte_titre_3_1_2->setValue(Zend_Registry::get('texte')->texte_titre_3_1_2);		   
//texte_titre_3_2_1 
 	   
       $texte_titre_3_2_1=$this->CreateElement('textarea','texte_titre_3_2_1');
   	   $texte_titre_3_2_1->id = 'editor_office2003';
	   $texte_titre_3_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_2_1));
	   $texte_titre_3_2_1->setValue(Zend_Registry::get('texte')->texte_titre_3_2_1);		   	   
//texte_titre_3_2_2  
 	   
       $texte_titre_3_2_2=$this->CreateElement('textarea','texte_titre_3_2_2');
   	   $texte_titre_3_2_2->id = 'editor_office2003';
	   $texte_titre_3_2_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_2_2));
	   $texte_titre_3_2_2->setValue(Zend_Registry::get('texte')->texte_titre_3_2_2);		   	   
//texte_titre_3_2_3   
 	   
       $texte_titre_3_2_3=$this->CreateElement('textarea','texte_titre_3_2_3');
   	   $texte_titre_3_2_3->id = 'editor_office2003';
	   $texte_titre_3_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_2_3));
	   $texte_titre_3_2_3->setValue(Zend_Registry::get('texte')->texte_titre_3_2_3);	
	   
//texte_titre_3_3_1 
 	   
       $texte_titre_3_3_1=$this->CreateElement('textarea','texte_titre_3_3_1');
   	   $texte_titre_3_3_1->id = 'editor_office2003';
	   $texte_titre_3_3_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_3_1));
	   $texte_titre_3_3_1->setValue(Zend_Registry::get('texte')->texte_titre_3_3_1);		   	   
//texte_titre_3_3_2  
 	   
       $texte_titre_3_3_2=$this->CreateElement('textarea','texte_titre_3_3_2');
   	   $texte_titre_3_3_2->id = 'editor_office2003';
	   $texte_titre_3_3_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_3_2));
	   $texte_titre_3_3_2->setValue(Zend_Registry::get('texte')->texte_titre_3_3_2);		   
//texte_titre_3_3_3  
 	   
       $texte_titre_3_3_3=$this->CreateElement('textarea','texte_titre_3_3_3');
   	   $texte_titre_3_3_3->id = 'editor_office2003';
	   $texte_titre_3_3_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_3_3));
	   $texte_titre_3_3_3->setValue(Zend_Registry::get('texte')->texte_titre_3_3_3);
	   
//texte_titre_3_4  
 	   
       $texte_titre_3_4=$this->CreateElement('textarea','texte_titre_3_4');
   	   $texte_titre_3_4->id = 'editor_office2003';
	   $texte_titre_3_4->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_3_4));
	   $texte_titre_3_4->setValue(Zend_Registry::get('texte')->texte_titre_3_4);		
	   
//texte_titre_4_1 
 	   
       $texte_titre_4_1=$this->CreateElement('textarea','texte_titre_4_1');
   	   $texte_titre_4_1->id = 'editor_office2003';
	   $texte_titre_4_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_1));
	   $texte_titre_4_1->setValue(Zend_Registry::get('texte')->texte_titre_4_1);		     	   
//texte_titre_4_2_1  
 	   
       $texte_titre_4_2_1=$this->CreateElement('textarea','texte_titre_4_2_1');
   	   $texte_titre_4_2_1->id = 'editor_office2003';
	   $texte_titre_4_2_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_2_1));
	   $texte_titre_4_2_1->setValue(Zend_Registry::get('texte')->texte_titre_4_2_1);		   
//texte_titre_4_2_2  
 	   
       $texte_titre_4_2_2=$this->CreateElement('textarea','texte_titre_4_2_2');
   	   $texte_titre_4_2_2->id = 'editor_office2003';
	   $texte_titre_4_2_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_2_2));
	   $texte_titre_4_2_2->setValue(Zend_Registry::get('texte')->texte_titre_4_2_2);	
	   
//texte_titre_4_2_3
 	   
       $texte_titre_4_2_3=$this->CreateElement('textarea','texte_titre_4_2_3');
   	   $texte_titre_4_2_3->id = 'editor_office2003';
	   $texte_titre_4_2_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_2_3));
	   $texte_titre_4_2_3->setValue(Zend_Registry::get('texte')->texte_titre_4_2_3);		   
//texte_titre_4_2_4  
 	   
       $texte_titre_4_2_4=$this->CreateElement('textarea','texte_titre_4_2_4');
   	   $texte_titre_4_2_4->id = 'editor_office2003';
	   $texte_titre_4_2_4->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_2_4));
	   $texte_titre_4_2_4->setValue(Zend_Registry::get('texte')->texte_titre_4_2_4);		   
//texte_titre_4_3_1 
 	   
       $texte_titre_4_3_1=$this->CreateElement('textarea','texte_titre_4_3_1');
   	   $texte_titre_4_3_1->id = 'editor_office2003';
	   $texte_titre_4_3_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_3_1));
	   $texte_titre_4_3_1->setValue(Zend_Registry::get('texte')->texte_titre_4_3_1);		   
//texte_titre_4_3_2 
 	   
       $texte_titre_4_3_2=$this->CreateElement('textarea','texte_titre_4_3_2');
   	   $texte_titre_4_3_2->id = 'editor_office2003';
	   $texte_titre_4_3_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_3_2));
	   $texte_titre_4_3_2->setValue(Zend_Registry::get('texte')->texte_titre_4_3_2);		   
//texte_titre_4_3_3
 	   
       $texte_titre_4_3_3=$this->CreateElement('textarea','texte_titre_4_3_3');
   	   $texte_titre_4_3_3->id = 'editor_office2003';
	   $texte_titre_4_3_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_3_3));
	   $texte_titre_4_3_3->setValue(Zend_Registry::get('texte')->texte_titre_4_3_3);		   
//texte_titre_4_4_1 
 	   
       $texte_titre_4_4_1=$this->CreateElement('textarea','texte_titre_4_4_1');
   	   $texte_titre_4_4_1->id = 'editor_office2003';
	   $texte_titre_4_4_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_4_1));
	   $texte_titre_4_4_1->setValue(Zend_Registry::get('texte')->texte_titre_4_4_1);		   
//texte_titre_4_4_2 
 	   
       $texte_titre_4_4_2=$this->CreateElement('textarea','texte_titre_4_4_2');
   	   $texte_titre_4_4_2->id = 'editor_office2003';
	   $texte_titre_4_4_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_4_2));
	   $texte_titre_4_4_2->setValue(Zend_Registry::get('texte')->texte_titre_4_4_2);		   
//texte_titre_4_4_3 
 	   
       $texte_titre_4_4_3=$this->CreateElement('textarea','texte_titre_4_4_3');
   	   $texte_titre_4_4_3->id = 'editor_office2003';
	   $texte_titre_4_4_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_4_4_3));
	   $texte_titre_4_4_3->setValue(Zend_Registry::get('texte')->texte_titre_4_4_3);	   
//texte_titre_5 
 	   
       $texte_titre_5=$this->CreateElement('textarea','texte_titre_5');
   	   $texte_titre_5->id = 'editor_office2003';
	   $texte_titre_5->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_5));
	   $texte_titre_5->setValue(Zend_Registry::get('texte')->texte_titre_5);

//texte_titre_6_1 
 	   
       $texte_titre_6_1=$this->CreateElement('textarea','texte_titre_6_1');
   	   $texte_titre_6_1->id = 'editor_office2003';
	   $texte_titre_6_1->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_6_1));
	   $texte_titre_6_1->setValue(Zend_Registry::get('texte')->texte_titre_6_1);

//texte_titre_6_2 
 	   
       $texte_titre_6_2=$this->CreateElement('textarea','texte_titre_6_2');
   	   $texte_titre_6_2->id = 'editor_office2003';
	   $texte_titre_6_2->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_6_2));
	   $texte_titre_6_2->setValue(Zend_Registry::get('texte')->texte_titre_6_2);

//texte_titre_6_3 
 	   
       $texte_titre_6_3=$this->CreateElement('textarea','texte_titre_6_3');
   	   $texte_titre_6_3->id = 'editor_office2003';
	   $texte_titre_6_3->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_6_3));
	   $texte_titre_6_3->setValue(Zend_Registry::get('texte')->texte_titre_6_3);

//texte_titre_7 
 	   
       $texte_titre_7=$this->CreateElement('textarea','texte_titre_7');
   	   $texte_titre_7->id = 'editor_office2003';
	   $texte_titre_7->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_7));
	   $texte_titre_7->setValue(Zend_Registry::get('texte')->texte_titre_7);

//texte_titre_8 
 	   
       $texte_titre_8=$this->CreateElement('textarea','texte_titre_8');
   	   $texte_titre_8->id = 'editor_office2003';
	   $texte_titre_8->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_8));
	   $texte_titre_8->setValue(Zend_Registry::get('texte')->texte_titre_8);

//texte_titre_9
 	   
       $texte_titre_9=$this->CreateElement('textarea','texte_titre_9');
   	   $texte_titre_9->id = 'editor_office2003';
	   $texte_titre_9->addValidator('StringLength', false,array(0,$this->nbr_caractere_titre_9));
	   $texte_titre_9->setValue(Zend_Registry::get('texte')->texte_titre_9);
	 */  
//submit		
       $submit=$this->CreateElement('submit','submit');
	   $submit->class = 'button';
       $this->addElements(array(
              $intro,
			  $texte_titre_1_1,
			  $texte_titre_1_2,
			  $texte_titre_projet_1_1,
			  $texte_titre_projet_1_2,
			  $texte_titre_projet_1_3,
			  $texte_titre_projet_1_4,
			  $texte_titre_projet_1_5,
			  $texte_titre_projet_1_6, 
			  $texte_titre_projet_2_1,
			  $texte_titre_projet_2_2, 
			  $texte_titre_projet_2_3, 
			  $texte_titre_projet_2_4,    
			  $texte_titre_projet_3_3, 
			  $texte_titre_projet_3_4,
			  $texte_titre_projet_3_5,   
			  $texte_titre_presentation_2_1,
			  $texte_titre_presentation_2_2,
			  $texte_titre_presentation_2_3,
			  $texte_titre_presentation_2_4_1,
			  $texte_titre_presentation_2_4_2,
			  $texte_titre_presentation_2_4_3,
			  $texte_titre_aspect_1,
			  $texte_titre_aspect_2,
			  $texte_titre_aspect_3,
			  $texte_titre_financier_1_1,
			  $texte_titre_financier_1_2,
			  $texte_titre_3_0,			  
			  $texte_titre_3_1_1,
			  $texte_titre_3_1_2,
			  $texte_titre_3_2_1,
			  $texte_titre_3_2_2,
			  $texte_titre_3_2_3,
			  $texte_titre_3_3_1,
			  $texte_titre_3_3_2,
			  $texte_titre_3_3_3,
			  $texte_titre_3_4,
			  $texte_titre_4_1,
			  $texte_titre_4_2_1,
			  $texte_titre_4_2_2,
			  $texte_titre_4_2_3,
			  $texte_titre_4_2_4,
			  $texte_titre_4_3_1,
			  $texte_titre_4_3_2,
			  $texte_titre_4_3_3,
			  $texte_titre_4_4_1,
			  $texte_titre_4_4_2,
			  $texte_titre_4_4_3,
			  $texte_titre_5,
			  $texte_titre_6_1,
			  $texte_titre_6_2,
			  $texte_titre_6_3,
			  $texte_titre_7,
			  $texte_titre_8,
			  $texte_titre_9,
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