<?php
class SommaireForm extends Zend_Form
{

	


    public function __construct($options = null)
    {
        parent::__construct($options);
		
        $this->setName('Sommaire');
		


$this->setAction('')
     ->setMethod('post');

	
 //sommaire  
 	   
       $sommaire=$this->CreateElement('textarea','sommaire');
       $sommaire->setRequired(true);
	   $sommaire->setValue(Zend_Registry::get('texte_titre_sommaire'));
//submit		
       $submit=$this->CreateElement('submit','submit');
	   $submit->class = 'button';
       $this->addElements(array(
              $sommaire,
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