<?php
class TitreValidationRedactionForm extends Zend_Form
{



    public function __construct($options = null)
    {
        parent::__construct($options);
		
        $this->setName('validation');
		


$this->setAction('')
     ->setMethod('post');

	
 //sommaire  
 	   $id_projet = Zend_Registry::get('session')->projet->id_projet;
       $bool_titre_sommaire=$this->CreateElement('checkbox','bool_titre_sommaire');
	   $bool_titre_sommaire->setAttrib('onClick', 'setValidation(this.checked,"titre_sommaire","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_sommaire==1)
	   {
	   $bool_titre_sommaire->setAttrib('checked', 'checked');
	   }

 //intro  
 	   
       $bool_titre_intro=$this->CreateElement('checkbox','bool_titre_intro');
	   $bool_titre_intro->setValue(Zend_Registry::get('validation')->bool_titre_intro);
       $bool_titre_intro->setAttrib('onClick', 'setValidation(this.checked,"titre_intro","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_intro==1)
	   {
	   $bool_titre_intro->setAttrib('checked', 'checked');
	   }

//bool_titre_1
 	   
       $bool_titre_1=$this->CreateElement('checkbox','bool_titre_1');
	   $bool_titre_1->setValue(Zend_Registry::get('validation')->bool_titre_1);	
       $bool_titre_1->setAttrib('onClick', 'setValidation(this.checked,"titre_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_1==1)
	   {
	   $bool_titre_1->setAttrib('checked', 'checked');
	   }
//bool_titre_1_1
 	   
       $bool_titre_1_1=$this->CreateElement('checkbox','bool_titre_1_1');
	   $bool_titre_1_1->setValue(Zend_Registry::get('validation')->bool_titre_1_1);	   
       $bool_titre_1_1->setAttrib('onClick', 'setValidation(this.checked,"titre_1_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_1_1==1)
	   {
	   $bool_titre_1_1->setAttrib('checked', 'checked');
	   }
//bool_titre_1_2
 	   
       $bool_titre_1_2=$this->CreateElement('checkbox','bool_titre_1_2');
	   $bool_titre_1_2->setValue(Zend_Registry::get('validation')->bool_titre_1_2);
       $bool_titre_1_2->setAttrib('onClick', 'setValidation(this.checked,"titre_1_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_1_2==1)
	   {
	   $bool_titre_1_2->setAttrib('checked', 'checked');
	   }
//bool_titre_2
 	   
       $bool_titre_2=$this->CreateElement('checkbox','bool_titre_2');
	   $bool_titre_2->setValue(Zend_Registry::get('validation')->bool_titre_2);	
       $bool_titre_2->setAttrib('onClick', 'setValidation(this.checked,"titre_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_2==1)
	   {
	   $bool_titre_2->setAttrib('checked', 'checked');
	   }
//bool_titre_2_1
 	   
       $bool_titre_2_1=$this->CreateElement('checkbox','bool_titre_2_1');
	   $bool_titre_2_1->setValue(Zend_Registry::get('validation')->bool_titre_2_1);	
       $bool_titre_2_1->setAttrib('onClick', 'setValidation(this.checked,"titre_2_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_2_1==1)
	   {
	   $bool_titre_2_1->setAttrib('checked', 'checked');
	   }
//bool_titre_2_2
 	   
       $bool_titre_2_2=$this->CreateElement('checkbox','bool_titre_2_2');
	   $bool_titre_2_2->setValue(Zend_Registry::get('validation')->bool_titre_2_2);
       $bool_titre_2_2->setAttrib('onClick', 'setValidation(this.checked,"titre_2_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_2_2==1)
	   {
	   $bool_titre_2_2->setAttrib('checked', 'checked');
	   }
//bool_titre_2_3
 	   
       $bool_titre_2_3=$this->CreateElement('checkbox','bool_titre_2_3');
	   $bool_titre_2_3->setValue(Zend_Registry::get('validation')->bool_titre_2_3);
       $bool_titre_2_3->setAttrib('onClick', 'setValidation(this.checked,"titre_2_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_2_3==1)
	   {
	   $bool_titre_2_3->setAttrib('checked', 'checked');
	   }
//bool_titre_3
 	   
       $bool_titre_3=$this->CreateElement('checkbox','bool_titre_3');
	   $bool_titre_3->setValue(Zend_Registry::get('validation')->bool_titre_3);
       $bool_titre_3->setAttrib('onClick', 'setValidation(this.checked,"titre_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3==1)
	   {
	   $bool_titre_3->setAttrib('checked', 'checked');
	   }
//bool_titre_3_0
 	   
       $bool_titre_3_0=$this->CreateElement('checkbox','bool_titre_3_0');
	   $bool_titre_3_0->setValue(Zend_Registry::get('validation')->bool_titre_3_0);
       $bool_titre_3_0->setAttrib('onClick', 'setValidation(this.checked,"titre_3_0","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_0==1)
	   {
	   $bool_titre_3_0->setAttrib('checked', 'checked');
	   }
//bool_titre_3_1
 	   
       $bool_titre_3_1=$this->CreateElement('checkbox','bool_titre_3_1');
	   $bool_titre_3_1->setValue(Zend_Registry::get('validation')->bool_titre_3_1);
       $bool_titre_3_1->setAttrib('onClick', 'setValidation(this.checked,"titre_3_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_1==1)
	   {
	   $bool_titre_3_1->setAttrib('checked', 'checked');
	   }
//bool_titre_3_1_1
 	   
       $bool_titre_3_1_1=$this->CreateElement('checkbox','bool_titre_3_1_1');
	   $bool_titre_3_1_1->setValue(Zend_Registry::get('validation')->bool_titre_3_1_1);	 
       $bool_titre_3_1_1->setAttrib('onClick', 'setValidation(this.checked,"titre_3_1_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_1_1==1)
	   {
	   $bool_titre_3_1_1->setAttrib('checked', 'checked');
	   }
//bool_titre_3_1_2
 	   
       $bool_titre_3_1_2=$this->CreateElement('checkbox','bool_titre_3_1_2');
	   $bool_titre_3_1_2->setValue(Zend_Registry::get('validation')->bool_titre_3_1_2);
       $bool_titre_3_1_2->setAttrib('onClick', 'setValidation(this.checked,"titre_3_1_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_1_2==1)
	   {
	   $bool_titre_3_1_2->setAttrib('checked', 'checked');
	   }

//bool_titre_3_2
 	   
       $bool_titre_3_2=$this->CreateElement('checkbox','bool_titre_3_2');
	   $bool_titre_3_2->setValue(Zend_Registry::get('validation')->bool_titre_3_2);	 
       $bool_titre_3_2->setAttrib('onClick', 'setValidation(this.checked,"titre_3_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_2==1)
	   {
	   $bool_titre_3_2->setAttrib('checked', 'checked');
	   }
//bool_titre_3_2_1
 	   
       $bool_titre_3_2_1=$this->CreateElement('checkbox','bool_titre_3_2_1');
	   $bool_titre_3_2_1->setValue(Zend_Registry::get('validation')->bool_titre_3_2_1);	 
       $bool_titre_3_2_1->setAttrib('onClick', 'setValidation(this.checked,"titre_3_2_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_2_1==1)
	   {
	   $bool_titre_3_2_1->setAttrib('checked', 'checked');
	   }
//bool_titre_3_2_2
 	   
       $bool_titre_3_2_2=$this->CreateElement('checkbox','bool_titre_3_2_2');
	   $bool_titre_3_2_2->setValue(Zend_Registry::get('validation')->bool_titre_3_2_2);	 
       $bool_titre_3_2_2->setAttrib('onClick', 'setValidation(this.checked,"titre_3_2_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_2_2==1)
	   {
	   $bool_titre_3_2_2->setAttrib('checked', 'checked');
	   }
//bool_titre_3_2_3
 	   
       $bool_titre_3_2_3=$this->CreateElement('checkbox','bool_titre_3_2_3');
	   $bool_titre_3_2_3->setValue(Zend_Registry::get('validation')->bool_titre_3_2_3);	
       $bool_titre_3_2_3->setAttrib('onClick', 'setValidation(this.checked,"titre_3_2_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_2_3==1)
	   {
	   $bool_titre_3_2_3->setAttrib('checked', 'checked');
	   }
//bool_titre_3_3
 	   
       $bool_titre_3_3=$this->CreateElement('checkbox','bool_titre_3_3');
	   $bool_titre_3_3->setValue(Zend_Registry::get('validation')->bool_titre_3_3);	
       $bool_titre_3_3->setAttrib('onClick', 'setValidation(this.checked,"titre_3_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_3==1)
	   {
	   $bool_titre_3_3->setAttrib('checked', 'checked');
	   }
//bool_titre_3_3_1
 	   
       $bool_titre_3_3_1=$this->CreateElement('checkbox','bool_titre_3_3_1');
	   $bool_titre_3_3_1->setValue(Zend_Registry::get('validation')->bool_titre_3_3_1);	
       $bool_titre_3_3_1->setAttrib('onClick', 'setValidation(this.checked,"titre_3_3_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_3_1==1)
	   {
	   $bool_titre_3_3_1->setAttrib('checked', 'checked');
	   }
//bool_titre_3_3_2
 	   
       $bool_titre_3_3_2=$this->CreateElement('checkbox','bool_titre_3_3_2');
	   $bool_titre_3_3_2->setValue(Zend_Registry::get('validation')->bool_titre_3_3_2);
       $bool_titre_3_3_2->setAttrib('onClick', 'setValidation(this.checked,"titre_3_3_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_3_2==1)
	   {
	   $bool_titre_3_3_2->setAttrib('checked', 'checked');
	   }
//bool_titre_3_3_3
 	   
       $bool_titre_3_3_3=$this->CreateElement('checkbox','bool_titre_3_3_3');
	   $bool_titre_3_3_3->setValue(Zend_Registry::get('validation')->bool_titre_3_3_3);
       $bool_titre_3_3_3->setAttrib('onClick', 'setValidation(this.checked,"titre_3_3_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_3_3==1)
	   {
	   $bool_titre_3_3_3->setAttrib('checked', 'checked');
	   }
//bool_titre_3_4
 	   
       $bool_titre_3_4=$this->CreateElement('checkbox','bool_titre_3_4');
	   $bool_titre_3_4->setValue(Zend_Registry::get('validation')->bool_titre_3_4);	
       $bool_titre_3_4->setAttrib('onClick', 'setValidation(this.checked,"titre_3_4","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_3_4==1)
	   {
	   $bool_titre_3_4->setAttrib('checked', 'checked');
	   }
//bool_titre_4
 	   
       $bool_titre_4=$this->CreateElement('checkbox','bool_titre_4');
	   $bool_titre_4->setValue(Zend_Registry::get('validation')->bool_titre_4);	
       $bool_titre_4->setAttrib('onClick', 'setValidation(this.checked,"titre_4","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4==1)
	   {
	   $bool_titre_4->setAttrib('checked', 'checked');
	   }
//bool_titre_4_1
 	   
       $bool_titre_4_1=$this->CreateElement('checkbox','bool_titre_4_1');
	   $bool_titre_4_1->setValue(Zend_Registry::get('validation')->bool_titre_4_1);	
       $bool_titre_4_1->setAttrib('onClick', 'setValidation(this.checked,"titre_4_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_1==1)
	   {
	   $bool_titre_4_1->setAttrib('checked', 'checked');
	   }
//bool_titre_4_2
 	   
       $bool_titre_4_2=$this->CreateElement('checkbox','bool_titre_4_2');
	   $bool_titre_4_2->setValue(Zend_Registry::get('validation')->bool_titre_4_2);	
       $bool_titre_4_2->setAttrib('onClick', 'setValidation(this.checked,"titre_4_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_2==1)
	   {
	   $bool_titre_4_2->setAttrib('checked', 'checked');
	   }
//bool_titre_4_2_1
 	   
       $bool_titre_4_2_1=$this->CreateElement('checkbox','bool_titre_4_2_1');
	   $bool_titre_4_2_1->setValue(Zend_Registry::get('validation')->bool_titre_4_2_1);
       $bool_titre_4_2_1->setAttrib('onClick', 'setValidation(this.checked,"titre_4_2_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_2_1==1)
	   {
	   $bool_titre_4_2_1->setAttrib('checked', 'checked');
	   }
//bool_titre_4_2_2
 	   
       $bool_titre_4_2_2=$this->CreateElement('checkbox','bool_titre_4_2_2');
	   $bool_titre_4_2_2->setValue(Zend_Registry::get('validation')->bool_titre_4_2_2);
       $bool_titre_4_2_2->setAttrib('onClick', 'setValidation(this.checked,"titre_4_2_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_2_2==1)
	   {
	   $bool_titre_4_2_2->setAttrib('checked', 'checked');
	   }
//bool_titre_4_2_3
 	   
       $bool_titre_4_2_3=$this->CreateElement('checkbox','bool_titre_4_2_3');
	   $bool_titre_4_2_3->setValue(Zend_Registry::get('validation')->bool_titre_4_2_3);
       $bool_titre_4_2_3->setAttrib('onClick', 'setValidation(this.checked,"titre_4_2_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_2_3==1)
	   {
	   $bool_titre_4_2_3->setAttrib('checked', 'checked');
	   }
//bool_titre_4_2_4
 	   
       $bool_titre_4_2_4=$this->CreateElement('checkbox','bool_titre_4_2_4');
	   $bool_titre_4_2_4->setValue(Zend_Registry::get('validation')->bool_titre_4_2_4);
       $bool_titre_4_2_4->setAttrib('onClick', 'setValidation(this.checked,"titre_4_2_4","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_2_4==1)
	   {
	   $bool_titre_4_2_4->setAttrib('checked', 'checked');
	   }
//bool_titre_4_3
 	   
       $bool_titre_4_3=$this->CreateElement('checkbox','bool_titre_4_3');
	   $bool_titre_4_3->setValue(Zend_Registry::get('validation')->bool_titre_4_3);
       $bool_titre_4_3->setAttrib('onClick', 'setValidation(this.checked,"titre_4_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_3==1)
	   {
	   $bool_titre_4_3->setAttrib('checked', 'checked');
	   }
//bool_titre_4_3_1
 	   
       $bool_titre_4_3_1=$this->CreateElement('checkbox','bool_titre_4_3_1');
	   $bool_titre_4_3_1->setValue(Zend_Registry::get('validation')->bool_titre_4_3_1);
       $bool_titre_4_3_1->setAttrib('onClick', 'setValidation(this.checked,"titre_4_3_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_3_1==1)
	   {
	   $bool_titre_4_3_1->setAttrib('checked', 'checked');
	   }
//bool_titre_4_3_2
 	   
       $bool_titre_4_3_2=$this->CreateElement('checkbox','bool_titre_4_3_2');
	   $bool_titre_4_3_2->setValue(Zend_Registry::get('validation')->bool_titre_4_3_2);
       $bool_titre_4_3_2->setAttrib('onClick', 'setValidation(this.checked,"titre_4_3_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_3_2==1)
	   {
	   $bool_titre_4_3_2->setAttrib('checked', 'checked');
	   }
//bool_titre_4_3_3
 	   
       $bool_titre_4_3_3=$this->CreateElement('checkbox','bool_titre_4_3_3');
	   $bool_titre_4_3_3->setValue(Zend_Registry::get('validation')->bool_titre_4_3_3);
       $bool_titre_4_3_3->setAttrib('onClick', 'setValidation(this.checked,"titre_4_3_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_3_3==1)
	   {
	   $bool_titre_4_3_3->setAttrib('checked', 'checked');
	   }
//bool_titre_4_4
 	   
       $bool_titre_4_4=$this->CreateElement('checkbox','bool_titre_4_4');
	   $bool_titre_4_4->setValue(Zend_Registry::get('validation')->bool_titre_4_4);
       $bool_titre_4_4->setAttrib('onClick', 'setValidation(this.checked,"titre_4_4","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_4==1)
	   {
	   $bool_titre_4_4->setAttrib('checked', 'checked');
	   }

//bool_titre_4_4_1
 	   
       $bool_titre_4_4_1=$this->CreateElement('checkbox','bool_titre_4_4_1');
	   $bool_titre_4_4_1->setValue(Zend_Registry::get('validation')->bool_titre_4_4_1);
       $bool_titre_4_4_1->setAttrib('onClick', 'setValidation(this.checked,"titre_4_4_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_4_1==1)
	   {
	   $bool_titre_4_4_1->setAttrib('checked', 'checked');
	   }

//bool_titre_4_4_2
 	   
       $bool_titre_4_4_2=$this->CreateElement('checkbox','bool_titre_4_4_2');
	   $bool_titre_4_4_2->setValue(Zend_Registry::get('validation')->bool_titre_4_4_2);
       $bool_titre_4_4_2->setAttrib('onClick', 'setValidation(this.checked,"titre_4_4_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_4_2==1)
	   {
	   $bool_titre_4_4_2->setAttrib('checked', 'checked');
	   }
//bool_titre_4_3_3
 	   
       $bool_titre_4_4_3=$this->CreateElement('checkbox','bool_titre_4_4_3');
	   $bool_titre_4_4_3->setValue(Zend_Registry::get('validation')->bool_titre_4_4_3);
       $bool_titre_4_4_3->setAttrib('onClick', 'setValidation(this.checked,"titre_4_4_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_4_4_3==1)
	   {
	   $bool_titre_4_4_3->setAttrib('checked', 'checked');
	   }
//bool_titre_5
 	   
       $bool_titre_5=$this->CreateElement('checkbox','bool_titre_5');
	   $bool_titre_5->setValue(Zend_Registry::get('validation')->bool_titre_5);
       $bool_titre_5->setAttrib('onClick', 'setValidation(this.checked,"titre_5","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_5==1)
	   {
	   $bool_titre_5->setAttrib('checked', 'checked');
	   }
//bool_titre_6
 	   
       $bool_titre_6=$this->CreateElement('checkbox','bool_titre_6');
	   $bool_titre_6->setValue(Zend_Registry::get('validation')->bool_titre_6);
       $bool_titre_6->setAttrib('onClick', 'setValidation(this.checked,"titre_6","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_6==1)
	   {
	   $bool_titre_6->setAttrib('checked', 'checked');
	   }
//bool_titre_6_1
 	   
       $bool_titre_6_1=$this->CreateElement('checkbox','bool_titre_6_1');
	   $bool_titre_6_1->setValue(Zend_Registry::get('validation')->bool_titre_6_1);
       $bool_titre_6_1->setAttrib('onClick', 'setValidation(this.checked,"titre_6_1","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_6_1==1)
	   {
	   $bool_titre_6_1->setAttrib('checked', 'checked');
	   }
//bool_titre_6_2
 	   
       $bool_titre_6_2=$this->CreateElement('checkbox','bool_titre_6_2');
	   $bool_titre_6_2->setValue(Zend_Registry::get('validation')->bool_titre_6_2);
       $bool_titre_6_2->setAttrib('onClick', 'setValidation(this.checked,"titre_6_2","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_6_2==1)
	   {
	   $bool_titre_6_2->setAttrib('checked', 'checked');
	   }
//bool_titre_6_3
 	   
       $bool_titre_6_3=$this->CreateElement('checkbox','bool_titre_6_3');
	   $bool_titre_6_3->setValue(Zend_Registry::get('validation')->bool_titre_6_3);
       $bool_titre_6_3->setAttrib('onClick', 'setValidation(this.checked,"titre_6_3","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_6_3==1)
	   {
	   $bool_titre_6_3->setAttrib('checked', 'checked');
	   }
//bool_titre_7
 	   
       $bool_titre_7=$this->CreateElement('checkbox','bool_titre_7');
	   $bool_titre_7->setValue(Zend_Registry::get('validation')->bool_titre_7);
       $bool_titre_7->setAttrib('onClick', 'setValidation(this.checked,"titre_7","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_7==1)
	   {
	   $bool_titre_7->setAttrib('checked', 'checked');
	   }
//bool_titre_8
 	   
       $bool_titre_8=$this->CreateElement('checkbox','bool_titre_8');
	   $bool_titre_8->setValue(Zend_Registry::get('validation')->bool_titre_8);
       $bool_titre_8->setAttrib('onClick', 'setValidation(this.checked,"titre_8","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_8==1)
	   {
	   $bool_titre_8->setAttrib('checked', 'checked');
	   }
//bool_titre_9
 	   
       $bool_titre_9=$this->CreateElement('checkbox','bool_titre_9');
	   $bool_titre_9->setValue(Zend_Registry::get('validation')->bool_titre_9);
   	   $bool_titre_9->setAttrib('onClick', 'setValidation(this.checked,"titre_9","'.$id_projet.'")');
	   if(Zend_Registry::get('validation')->bool_titre_9==1)
	   {
	   $bool_titre_9->setAttrib('checked', 'checked');
	   }


//submit		
       $submit=$this->CreateElement('submit','submit');
	   $submit->class = 'button';
	   
       $this->addElements(array(
              $bool_titre_sommaire,
			  $bool_titre_intro,
			  $bool_titre_1,
			  $bool_titre_1_1,
			  $bool_titre_1_2,
			  $bool_titre_2,
			  $bool_titre_2_1,
			  $bool_titre_2_2,
			  $bool_titre_2_3,
			  $bool_titre_3,
			  $bool_titre_3_0,
			  $bool_titre_3_1,
			  $bool_titre_3_1_1,
			  $bool_titre_3_1_2,
			  $bool_titre_3_2,
			  $bool_titre_3_2_1,
			  $bool_titre_3_2_2,
			  $bool_titre_3_2_3,
			  $bool_titre_3_3,
			  $bool_titre_3_3_1,
			  $bool_titre_3_3_2,
			  $bool_titre_3_3_3,
			  $bool_titre_3_4,
			  $bool_titre_4,
			  $bool_titre_4_1,
			  $bool_titre_4_2,
			  $bool_titre_4_2_1,
			  $bool_titre_4_2_2,
			  $bool_titre_4_2_3,
			  $bool_titre_4_2_4,
			  $bool_titre_4_3,
			  $bool_titre_4_3_1,
			  $bool_titre_4_3_2,
			  $bool_titre_4_3_3,
			  $bool_titre_4_4,
			  $bool_titre_4_4_1,
			  $bool_titre_4_4_2,
			  $bool_titre_4_4_3,
			  $bool_titre_5,
			  $bool_titre_6,
			  $bool_titre_6_1,
			  $bool_titre_6_2,
			  $bool_titre_6_3,
			  $bool_titre_7,
			  $bool_titre_8,
			  $bool_titre_9,
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