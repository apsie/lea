<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwContactPrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	 $builder->add('civilite', 'choice',array(
       	 'choices'   => array('' => '','Monsieur' => 'Monsieur', 'Madame' => 'Madame', 'Mademoiselle' => 'Mademoiselle')),array('required'=>false));
    	  $builder->add('nom', 'text');
    	  $builder->add('contactId', 'hidden');
    	  $builder->add('prenom', 'text',array('required'=>false));
    	  $builder->add('deuxiemePrenom', 'text',array('required'=>false));
    	  $builder->add('nomJeuneFille', 'text',array('required'=>false));
    	  $builder->add('portablePerso', 'text',array('required'=>false));
    	  $builder->add('portablePro', 'text',array('required'=>false));
    	  $builder->add('emailPerso', 'email',array('required'=>false));
    	  $builder->add('telDomicile1', 'text',array('required'=>false));
    	  $builder->add('emailPro', 'email',array('required'=>false));
    	  $builder->add('fonction', 'text',array('required'=>false));
    	  
			
    }

    public function getName()
    {
        return 'EgwAddressbook';
    }
}
?>