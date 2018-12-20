<?php 
class Form
{


	public function __construct() {
		// Not yet implemented
	}
	
	public function formulaire()
	{
	include "Zend/Loader.php";
    Zend_Loader::registerAutoload();


      $form = new Zend_Form;

      $form->setAction('')

           ->setMethod('get');

       

      // élément nom :

      $username = $form->createElement('text', 'username');

      $username->addValidator('alnum')

               ->addValidator('regex', false, array('/^[a-z]+/'))

               ->addValidator('stringLength', false, array(6, 20))

               ->setRequired(true)

               ->addFilter('StringToLower');

       

      // élément mot de passe :

      $password = $form->createElement('password', 'password');

      $password->addValidator('StringLength', false, array(6))

               ->setRequired(true);

       
 
      // Ajout des éléments au formulaire
 
      $form->addElement($username)

           ->addElement($password)

           // addElement() agit comme une fabrique qui crée un bouton 'Login'
 
           ->addElement('submit', 'login', array('label' => 'Se connecter'));
		   
		 $view = new Zend_View;
echo $form->render($view);
 
	}

}

?>