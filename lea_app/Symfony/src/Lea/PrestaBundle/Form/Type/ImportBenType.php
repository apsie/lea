<?php 
namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class ImportBenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('importFile', 'file', array('label' => 'Fichier à importer'));

        $hours = array(
            '8' => '08h',
            '9' => '09h',
            '10' => '10h',
            '11' => '11h',
            '12' => '12h',
            '13' => '13h',
            '14' => '14h',
            '15' => '15h',
            '16' => '16h',
            '17' => '17h',
            '18' => '18h',
            '19' => '19h'
        );

        $durations = array(
            '900' =>  '0:15',
            '1800' =>  '0:30',
            '3600' =>  '1:00',
            '5400' =>  '1:30',
            '7200' =>  '2:00'
        );

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

        $builder->add('dateDebut', 'text', array('label' => 'date de début'));
        $builder->add('startTime', 'choice', array('choices' => $hours));
        $builder->add('endTime', 'choice', array('choices' => $hours));
        $builder->add('startPause', 'choice', array('choices' => $hours));
        $builder->add('endPause', 'choice', array('choices' => $hours));
        $builder->add('duration', 'choice', array('choices' => $durations));
        $builder->add('jours', 'choice',array('choices' => array(12345=>"Jours ouvrés", 1=>"Lundi", 2=>"Mardi", 3=>"Mercredi", 4=>"Jeudi", 5=>"Vendredi"), 'multiple' => true));

        $dureePresta = array(
            '30' => '30 jours',
            '60' => '60 jours',
            '90' => '90 jours',
            '120' => '120 jours',
        );
        $builder->add('dureePresta', 'choice', array('choices' => $dureePresta));
    }

    public function getName()
    {
        return 'ImportBen';
    }
}