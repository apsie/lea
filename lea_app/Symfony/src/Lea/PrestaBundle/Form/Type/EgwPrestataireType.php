<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwPrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    $builder->add('id_prestataire', 'entity', array(
				'class' 	=> 'LeaPrestaBundle:Spiclient', 
				'property'  => 'nomOrganisme',
        		'label'  	=> 'nomOrganisme',
        		'required'  => true,
				'empty_value' => '',
    			
				'query_builder' => function(EntityRepository $er) 
				{
        			return $er->createQueryBuilder('c')
                    // SPIREA - Code en dur !!!!
                    ->where('c.type = 4')
            		->orderBy('c.nomOrganisme','ASC');
    			},
			));
    	  
    }
		
			
    
    

    public function getName()
    {
        return 'Spiclient';
    }
}
?>