<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwCategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
            $builder->add('categories', 'entity', array(
				'class' 	=> 'LeaPrestaBundle:EgwCategories', 
				'property'  => 'catName',
        		'label'  	=> 'catName',
        		'required'  => true,
				'empty_value' => '',
				'query_builder' => function(EntityRepository $er) 
				{
        			return $er->createQueryBuilder('c')
        			->where('c.catAppname = :appname')
					->setParameter('appname', 'phpgw')
            		->orderBy('c.catName','ASC');
    			},
			));
    	  
            $builder->add('spid_categories', 'entity', array(
                'class'     => 'LeaPrestaBundle:EgwCategories', 
                'property'  => 'catName',
                'label'     => 'catName',
                'required'  => true,
                'empty_value' => '',
                'query_builder' => function(EntityRepository $er) 
                {
                    return $er->createQueryBuilder('c')
                    ->where('c.catAppname = :appname')
                    ->setParameter('appname', 'spid')
                    ->orderBy('c.catName','ASC');
                },
            ));
    }
		
			
    
    

    public function getName()
    {
        return 'EgwCategories';
    }
}
?>