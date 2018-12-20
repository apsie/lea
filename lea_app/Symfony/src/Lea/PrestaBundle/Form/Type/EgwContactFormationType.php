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
        if(isset($options['data'][1]))
            $intituleFormation = $options['data'][1]->getIntituleFormation();
        else 
            $intituleFormation = null;
    	
    	$builder->add('intituleFormation', 'text',array('required'=>false,'data'=>$intituleFormation));
 
        $data = array(''=>'');
        foreach ($options['data'][0] as $key => $value) {
            $data[trim($value->getValeur())] = $value->getValeur();
        }

        if(isset($options['data'][1]))
           $id = $options['data'][1]->getNiveauFormation();
        else 
           $id = null;
            		
    	$builder->add('niveauFormation', 'choice',array(
        'choices'   =>$data,'data'=>$id));    	  
    }

    public function getName()
    {
        return 'EgwFormationContact';
    }
}
?>