<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwContactEtatCivilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('idBen', 'hidden');
    $builder->add('idSecu', 'text',array('required'=>false));
	$builder->add('dateNaissance', 'text',array('required'=>false));
	$builder->add('lieuNaissance', 'text',array('required'=>false));
	$builder->add('paysNaissance', 'text',array('required'=>false));
	$builder->add('nationalite', 'choice',array(
       	'choices'   => array('' => '','Français' => 'Français', 'Etranger UE' => 'Etranger UE', 'Etranger hors UE' => 'Etranger hors UE')));
	$builder->add('situationMaritale', 'choice',array(
       	'choices'   => array('' => '','Celibataire' => 'Celibataire', 'Vie maritale' => 'Vie maritale', 'Pacs' => 'Pacs' , 'Divorce(e)' => 'Divorce(e)' ,'Veuf(ve)' => 'Veuf(ve)' ,'Marie(e)' => 'Marie(e)')));
	$builder->add('enfantsACharge', 'text',array('required'=>false));

    	 
    }

    public function getName()
    {
        return 'EgwContactEtatCivil';
    }
}

?>