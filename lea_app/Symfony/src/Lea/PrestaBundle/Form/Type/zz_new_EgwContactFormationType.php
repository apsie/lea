<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwContactFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    	  $builder->add('idBen', 'hidden');
          $builder->add('niveauFormation', 'choice',array(
       	  'choices'   => array('' => '','Niveau VI - Etudes primaires' => 'Niveau VI - Etudes primaires', 'Niveau V - Sortie troisieme' => 'Niveau V - Sortie troisieme', 'Niveau IV - CAP / BEP' => 'Niveau IV - CAP / BEP' , 'Niveau III - BAC / BT' => 'Niveau III - BAC / BT' ,'Niveau II - BAC + 2' => 'Niveau II - BAC + 2' ,'Niveau I BAC + 3 et >' => 'Niveau I BAC + 3 et >')));
    	  $builder->add('intituleFormation', 'text');
    	  $builder->add('dateDebut', 'text',array('required'=>false));
    	  $builder->add('dateFin', 'text',array('required'=>false));
    	  $builder->add('typeFormation', 'text');
    	  $builder->add('resultatFormation', 'text',array('required'=>false));
    	  $builder->add('organismeFormation', 'text',array('required'=>false));
    	  $builder->add('organismeCertification', 'text',array('required'=>false));

   }

    public function getName()
    {
        return 'EgwFormationContact';
    }
}


