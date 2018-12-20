<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwTexteKeyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    		$builder->add('idTexteKey', 'entity', array(
				'class' 	=> 'LeaPrestaBundle:EgwTexteKey', 
				'property'  => 'libelle',
        		'label'  	=> 'libelle',
        		'required'  => true,
				'empty_value' => '',
				'query_builder' => function(EntityRepository $er) 
				{
        			return $er->createQueryBuilder('t')
        			
            		->orderBy('t.libelle','ASC');
    			},
			)); 
    
		
    }

    public function getName()
    {
        return 'EgwTexteKey';
    }
}
?>