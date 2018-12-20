<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    	  $builder->add('libelle', 'text');
    	  
			
    }

    public function getName()
    {
        return 'EgwActivite';
    }
}
?>