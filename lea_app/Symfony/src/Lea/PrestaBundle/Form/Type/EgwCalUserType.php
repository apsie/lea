<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwCalUserType extends AbstractType
{
	private $i = null;
	
	public function __construct($i = null){
		
		$this->i = $i;
	}

    public function buildForm(FormBuilderInterface $builder, array $options){
    	
		$builder->add('motifAbsence', 'text',array('required'=>false));
		$builder->add('calId', 'hidden');
		$builder->add('calUserId', 'hidden');
		$builder->add('calStatus', 'choice',array('choices'   => array('U' => 'U','A' => 'A', 'R' => 'R')));
			
		// $builder->add('checkAddRemove', 'checkbox', array('label' => 'Ajouter/Supprimer le rendez-vous'));
    }

    public function getName(){
        return 'EgwCalUser'.$this->i;
    }
}
?>