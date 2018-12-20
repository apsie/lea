<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwAdressbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	 $builder->add('n_prefix', 'choice',array(
       	 'choices'   => array('' => '','Monsieur' => 'Monsieur', 'Madame' => 'Madame')));
    	  $builder->add('n_family', 'text');
    	  $builder->add('n_given', 'text');
    	  $builder->add('n_middle', 'text');
    	  $builder->add('n_suffix', 'text');
    	  
			
    }

    public function getName()
    {
        return 'EgwAdressbook';
    }
}
?>