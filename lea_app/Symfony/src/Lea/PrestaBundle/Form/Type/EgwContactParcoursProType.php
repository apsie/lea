<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwContactParcoursProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	 if(isset($options['data'][1]))
           $identifiant = $options['data'][1]->getIdentifiant();
           else 
           $identifiant = null;
    	
    	  $builder->add('identifiant', 'text',array('required'=>false,'data'=>$identifiant));

    	 // print_r($options['data']); die();
    	 
    $data = array(''=>'');
            		foreach ($options['data'][0] as $key => $value) {
            			
            			$data[trim($value->getValeur())] = $value->getValeur();
            		}
          if(isset($options['data'][1]))
           $id = $options['data'][1]->getStatut();
           else 
           $id = null;
            		
    	  $builder->add('statut', 'choice',array(
        'choices'   =>$data,'data'=>$id));
    	  
    }

    public function getName()
    {
        return 'EgwContactParcoursPro';
    }
}
?>