<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwTypePrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    		 
    
            		/*$data = array(''=>'');
            		foreach ($options['data'] as $key => $value) {
            			
            			$data[$value->getId()] = $value->getLibelle().$value->getZoneGeographique();
            		}
            		
    	  $builder->add('id', 'choice',array(
        'choices'   =>$data),array('required'=>false));*/
		 $builder->add('libelle', 'text');	
    }

    public function getName()
    {
        return 'EgwTypePrestation';
    }
}
?>