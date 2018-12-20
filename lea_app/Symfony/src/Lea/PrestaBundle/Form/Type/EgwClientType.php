<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
        $builder->add('nomOrganisme', 'text');
        $builder->add('idClient', 'hidden');
    	  
    }
		
			
    
    

    public function getName()
    {
        return 'Spiclient';
    }
}
?>