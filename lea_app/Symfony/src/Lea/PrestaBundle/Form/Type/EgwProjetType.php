<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	  $builder->add('idProjet', 'hidden');
    	  $builder->add('intitule_projet', 'text');
    	  $builder->add('description_projet', 'text');
			
    }

    public function getName()
    {
        return 'EgwProjet';
    }
}
?>