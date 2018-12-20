<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
class DisponibiliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

   $builder->add('typeRecherche', 'choice', array(
    'choices'   => array(
        1 => 'Recherche de disponibilité',
        2 => 'Rendez-vous existants'
       
    ),
    'data'=>1,
    'multiple'  => false,
    'expanded' => true
));
	
      $builder->add('dateDebut', 'text',array(
     'data' => date('d/m/Y')
	));
      
      for ($i = 0; $i < 24; $i++) {
      	$p1[$i] = $i;
      }
       for ($i = 0; $i < 60; $i = $i + 15) {
      	$m1[$i] = $i;
      }
     for ($i = 1; $i <= 24; $i++) {
      	$p2[$i] = $i;
      }
      $builder->add('plageDebut', 'choice',		
      array('choices'   => $p1,
      'data' => 9));
      
      $builder->add('minDebut', 'choice',		
      array('choices'   => $m1));
      
      $builder->add('plageFin', 'choice',		
      array('choices'   => $p2,
      'data' => 17));
      
      $duree = array(	900   		=> '0:15',
      					1800   		=> '0:30',
      					3600   		=> '1:00',
     					3600+1800   => '1:30',
      					3600*2 		=> '2:00',
      					3600*2+1800	=> '2:30',
      					3600*3 		=> '3:00',
      					3600*3+1800	=> '3:30',
      					3600*4 		=> '4:00',
      					3600*4+1800 => '4:30',
      					3600*5 		=> '5:00',
      					3600*5+1800	=> '5:30',
      					3600*6 		=> '6:00',
      					3600*6+1800 => '6:30',
      					3600*7 		=> '7:00',
      					3600*7+1800	=> '7:30',
      					3600*8 		=> '8:00'
      					);
       $builder->add('duree', 'choice',array('choices'   => $duree,
      'data' => 3600));
       
        $sem = array(	7   		=> 1,
      					7*2   		=> 2,
     					7*3   		=> 3,
      					7*4 		=> 4,
      					7*5 		=> 5,
      					7*6 		=> 6,
      					7*7 		=> 7,
      					7*8 		=> 8,
      					7*9 		=> 9,
      					7*10 		=> 10,
      					7*11		=> 11,
      					7*12 		=> 12,
      					7*13 		=> 13,
      					7*14 		=> 14,
      					7*15 		=> 15,
      					7*16 		=> 16
      					
      					);
        $builder->add('nbJour', 'choice',array('choices'   => $sem,
      'data' => 7));
        
       $nbintervalle = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21);
       //$nbintervalle = array(0);
       $builder->add('nbIntervalle', 'choice',array('choices'   => $nbintervalle,'data' => 1));
       $builder->add('typeIntervalle', 'choice',array('choices'   => array(86400 =>"Jour(s)", 604800 => "Semaine(s)")));
       $builder->add('jours', 'choice',array('choices'   => array(12345=>"Jours ouvrés",1=>"Lundi",2=>"Mardi",3=>"Mercredi",4=>"Jeudi",5=>"Vendredi")));
    }

    public function getName()
    {
        return 'disponibilite';
    }
}
?>