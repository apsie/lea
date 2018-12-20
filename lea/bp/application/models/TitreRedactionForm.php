<?php
class TitreRedactionForm extends Zend_Form
{



    public function __construct($options = null)
    {
        parent::__construct($options);
		
        $this->setName('titre');
		


$this->setAction('')
     ->setMethod('post');

	
 //sommaire  
 	   
       $titre_sommaire=$this->CreateElement('text','titre_sommaire');
	   $titre_sommaire->setValue(Zend_Registry::get('titre')->titre_sommaire);
 	  
 //intro  
 	   
       $titre_intro=$this->CreateElement('text','titre_intro');
	   $titre_intro->setValue(Zend_Registry::get('titre')->titre_intro);
	

//titre_1
 	   
       $titre_1=$this->CreateElement('text','titre_1');
	 
	   $titre_1->setValue(Zend_Registry::get('titre')->titre_1);	
	  
//titre_1_1
 	   
       $titre_1_1=$this->CreateElement('text','titre_1_1');
	   
	   $titre_1_1->setValue(Zend_Registry::get('titre')->titre_1_1);	   
 	   
//titre_1_2
 	   
       $titre_1_2=$this->CreateElement('text','titre_1_2');
	   $titre_1_2->setValue(Zend_Registry::get('titre')->titre_1_2);
	   
//titre_2
 	   
       $titre_2=$this->CreateElement('text','titre_2');
	   $titre_2->setValue(Zend_Registry::get('titre')->titre_2);	

//titre_2_1
 	   
       $titre_2_1=$this->CreateElement('text','titre_2_1');
	   $titre_2_1->setValue(Zend_Registry::get('titre')->titre_2_1);	

//titre_2_2
 	   
       $titre_2_2=$this->CreateElement('text','titre_2_2');
	   $titre_2_2->setValue(Zend_Registry::get('titre')->titre_2_2);

//titre_2_3
 	   
       $titre_2_3=$this->CreateElement('text','titre_2_3');
	   $titre_2_3->setValue(Zend_Registry::get('titre')->titre_2_3);

//titre_3
 	   
       $titre_3=$this->CreateElement('text','titre_3');
	   $titre_3->setValue(Zend_Registry::get('titre')->titre_3);

//titre_3_0
 	   
       $titre_3_0=$this->CreateElement('text','titre_3_0');
	   $titre_3_0->setValue(Zend_Registry::get('titre')->titre_3_0);
	   
//titre_3_1
 	   
       $titre_3_1=$this->CreateElement('text','titre_3_1');
	   $titre_3_1->setValue(Zend_Registry::get('titre')->titre_3_1);

//titre_3_1_1
 	   
       $titre_3_1_1=$this->CreateElement('text','titre_3_1_1');
	   $titre_3_1_1->setValue(Zend_Registry::get('titre')->titre_3_1_1);	 

//titre_3_1_2
 	   
       $titre_3_1_2=$this->CreateElement('text','titre_3_1_2');
	   $titre_3_1_2->setValue(Zend_Registry::get('titre')->titre_3_1_2);

//titre_3_1_2
 	   
       $titre_3_1_2=$this->CreateElement('text','titre_3_1_2');
	   $titre_3_1_2->setValue(Zend_Registry::get('titre')->titre_3_1_2);	 

//titre_3_2
 	   
       $titre_3_2=$this->CreateElement('text','titre_3_2');
	   $titre_3_2->setValue(Zend_Registry::get('titre')->titre_3_2);	 

//titre_3_2_1
 	   
       $titre_3_2_1=$this->CreateElement('text','titre_3_2_1');
	   $titre_3_2_1->setValue(Zend_Registry::get('titre')->titre_3_2_1);	 

//titre_3_2_2
 	   
       $titre_3_2_2=$this->CreateElement('text','titre_3_2_2');
	   $titre_3_2_2->setValue(Zend_Registry::get('titre')->titre_3_2_2);	 

//titre_3_2_3
 	   
       $titre_3_2_3=$this->CreateElement('text','titre_3_2_3');
	   $titre_3_2_3->setValue(Zend_Registry::get('titre')->titre_3_2_3);	
	   
//titre_3_3
 	   
       $titre_3_3=$this->CreateElement('text','titre_3_3');
	   $titre_3_3->setValue(Zend_Registry::get('titre')->titre_3_3);	

//titre_3_3_1
 	   
       $titre_3_3_1=$this->CreateElement('text','titre_3_3_1');
	   $titre_3_3_1->setValue(Zend_Registry::get('titre')->titre_3_3_1);	

//titre_3_3_2
 	   
       $titre_3_3_2=$this->CreateElement('text','titre_3_3_2');
	   $titre_3_3_2->setValue(Zend_Registry::get('titre')->titre_3_3_2);
	   
//titre_3_3_3
 	   
       $titre_3_3_3=$this->CreateElement('text','titre_3_3_3');
	   $titre_3_3_3->setValue(Zend_Registry::get('titre')->titre_3_3_3);
	   
//titre_3_4
 	   
       $titre_3_4=$this->CreateElement('text','titre_3_4');
	   $titre_3_4->setValue(Zend_Registry::get('titre')->titre_3_4);	

//titre_4
 	   
       $titre_4=$this->CreateElement('text','titre_4');
	   $titre_4->setValue(Zend_Registry::get('titre')->titre_4);	

//titre_4_1
 	   
       $titre_4_1=$this->CreateElement('text','titre_4_1');
	   $titre_4_1->setValue(Zend_Registry::get('titre')->titre_4_1);	

//titre_4_2
 	   
       $titre_4_2=$this->CreateElement('text','titre_4_2');
	   $titre_4_2->setValue(Zend_Registry::get('titre')->titre_4_2);	

//titre_4_2_1
 	   
       $titre_4_2_1=$this->CreateElement('text','titre_4_2_1');
	   $titre_4_2_1->setValue(Zend_Registry::get('titre')->titre_4_2_1);

//titre_4_2_2
 	   
       $titre_4_2_2=$this->CreateElement('text','titre_4_2_2');
	   $titre_4_2_2->setValue(Zend_Registry::get('titre')->titre_4_2_2);

//titre_4_2_3
 	   
       $titre_4_2_3=$this->CreateElement('text','titre_4_2_3');
	   $titre_4_2_3->setValue(Zend_Registry::get('titre')->titre_4_2_3);

//titre_4_2_4
 	   
       $titre_4_2_4=$this->CreateElement('text','titre_4_2_4');
	   $titre_4_2_4->setValue(Zend_Registry::get('titre')->titre_4_2_4);
	   
//titre_4_3
 	   
       $titre_4_3=$this->CreateElement('text','titre_4_3');
	   $titre_4_3->setValue(Zend_Registry::get('titre')->titre_4_3);

//titre_4_3_1
 	   
       $titre_4_3_1=$this->CreateElement('text','titre_4_3_1');
	   $titre_4_3_1->setValue(Zend_Registry::get('titre')->titre_4_3_1);

//titre_4_3_2
 	   
       $titre_4_3_2=$this->CreateElement('text','titre_4_3_2');
	   $titre_4_3_2->setValue(Zend_Registry::get('titre')->titre_4_3_2);
	   
//titre_4_3_3
 	   
       $titre_4_3_3=$this->CreateElement('text','titre_4_3_3');
	   $titre_4_3_3->setValue(Zend_Registry::get('titre')->titre_4_3_3);
	   
//titre_4_4
 	   
       $titre_4_4=$this->CreateElement('text','titre_4_4');
	   $titre_4_4->setValue(Zend_Registry::get('titre')->titre_4_4);


//titre_4_4_1
 	   
       $titre_4_4_1=$this->CreateElement('text','titre_4_4_1');
	   $titre_4_4_1->setValue(Zend_Registry::get('titre')->titre_4_4_1);


//titre_4_4_2
 	   
       $titre_4_4_2=$this->CreateElement('text','titre_4_4_2');
	   $titre_4_4_2->setValue(Zend_Registry::get('titre')->titre_4_4_2);

//titre_4_3_3
 	   
       $titre_4_4_3=$this->CreateElement('text','titre_4_4_3');
	   $titre_4_4_3->setValue(Zend_Registry::get('titre')->titre_4_4_3);

//titre_5
 	   
       $titre_5=$this->CreateElement('text','titre_5');
	   $titre_5->setValue(Zend_Registry::get('titre')->titre_5);

//titre_6
 	   
       $titre_6=$this->CreateElement('text','titre_6');
	   $titre_6->setValue(Zend_Registry::get('titre')->titre_6);

//titre_6_1
 	   
       $titre_6_1=$this->CreateElement('text','titre_6_1');
	   $titre_6_1->setValue(Zend_Registry::get('titre')->titre_6_1);

//titre_6_2
 	   
       $titre_6_2=$this->CreateElement('text','titre_6_2');
	   $titre_6_2->setValue(Zend_Registry::get('titre')->titre_6_2);

//titre_6_3
 	   
       $titre_6_3=$this->CreateElement('text','titre_6_3');
	   $titre_6_3->setValue(Zend_Registry::get('titre')->titre_6_3);

//titre_7
 	   
       $titre_7=$this->CreateElement('text','titre_7');
	   $titre_7->setValue(Zend_Registry::get('titre')->titre_7);

//titre_8
 	   
       $titre_8=$this->CreateElement('text','titre_8');
	   $titre_8->setValue(Zend_Registry::get('titre')->titre_8);

//titre_9
 	   
       $titre_9=$this->CreateElement('text','titre_9');
	   $titre_9->setValue(Zend_Registry::get('titre')->titre_9);



//submit		
       $submit=$this->CreateElement('submit','submit');
	   $submit->class = 'button';
	   
       $this->addElements(array(
              $titre_sommaire,
			  $titre_intro,
			  $titre_1,
			  $titre_1_1,
			  $titre_1_2,
			  $titre_2,
			  $titre_2_1,
			  $titre_2_2,
			  $titre_2_3,
			  $titre_3,
			  $titre_3_0,
			  $titre_3_1,
			  $titre_3_1_1,
			  $titre_3_1_2,
			  $titre_3_2,
			  $titre_3_2_1,
			  $titre_3_2_2,
			  $titre_3_2_3,
			  $titre_3_3,
			  $titre_3_3_1,
			  $titre_3_3_2,
			  $titre_3_3_3,
			  $titre_3_4,
			  $titre_4,
			  $titre_4_1,
			  $titre_4_2,
			  $titre_4_2_1,
			  $titre_4_2_2,
			  $titre_4_2_3,
			  $titre_4_2_4,
			  $titre_4_3,
			  $titre_4_3_1,
			  $titre_4_3_2,
			  $titre_4_3_3,
			  $titre_4_4,
			  $titre_4_4_1,
			  $titre_4_4_2,
			  $titre_4_4_3,
			  $titre_5,
			  $titre_6,
			  $titre_6_1,
			  $titre_6_2,
			  $titre_6_3,
			  $titre_7,
			  $titre_8,
			  $titre_9,
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