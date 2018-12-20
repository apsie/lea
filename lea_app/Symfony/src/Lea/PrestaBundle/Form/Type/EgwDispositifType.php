<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwDispositifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    	$builder->add('activite', 'entity', array(
				'class' 	=> 'LeaPrestaBundle:EgwActivite', 
				'property'  => 'libelle',
        		'label'  	=> 'libelle',
        		'required'  => true,
				'empty_value' => '',
				'query_builder' => function(EntityRepository $er) 
				{
        			return $er->createQueryBuilder('a')
            		->orderBy('a.libelle','ASC');
    			},
			));
			
		$builder->add('idTypePrestation', 'entity', array(
				'class' 	=> 'LeaPrestaBundle:EgwTypePrestation', 
				'property'  => 'libelle',
        		'label'  	=> 'libelle',
        		'required'  => true,
				'empty_value' => '',
				'query_builder' => function(EntityRepository $er) 
				{
        			return $er->createQueryBuilder('a')
            		->orderBy('a.libelle','ASC');
    			},
			));
		
		$builder->add('isActive', 'choice',array(
       	 'choices'   => array(''=>'',1 => 'Actif',0 => 'Inactif')));	
			
    	  $builder->add('numeroMarche', 'text',array('required'=>false));
    	  $builder->add('numeroLot', 'text',array('required'=>false));
    	  $builder->add('zoneGeographique', 'text',array('required'=>false));
    	  $builder->add('objet', 'text',array('required'=>false));
    	  $builder->add('dateDebut', 'text',array('required'=>false));
    	  $builder->add('dateFin', 'text',array('required'=>false));
    	  
		$builder->add('idContract', 'entity', array(
            'class'     => 'LeaPrestaBundle:EgwContract', 
            'property'  => 'contract_title',
            'label'     => 'contract_title',
            'required'  => true,
            'empty_value' => '',
            'query_builder' => function(EntityRepository $er) 
            {
                return $er->createQueryBuilder('a')
                    ->orderBy('a.contract_title','ASC');
            },
        ));
    }

    public function getName()
    {
        return 'EgwDispositif';
    }
}
?>