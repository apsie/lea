<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder->add('civilite', 'choice',array(
       	'choices'   => array('' => '','Monsieur' => 'Monsieur', 'Madame' => 'Madame', 'Mademoiselle' => 'Mademoiselle')));
    	$builder->add('nom', 'text');
    	$builder->add('idBen', 'hidden');
    	$builder->add('prenom', 'text');
    	$builder->add('deuxiemePrenom', 'text',array('required'=>false));
    	$builder->add('nomJeuneFille', 'text',array('required'=>false));
    	$builder->add('portablePerso', 'text',array('required'=>false));
    	$builder->add('portablePro', 'text',array('required'=>false));
    	$builder->add('telPro1', 'text',array('required'=>false));
    	$builder->add('telPro2', 'text',array('required'=>false));
    	$builder->add('faxPro', 'text',array('required'=>false));
    	$builder->add('faxPerso', 'text',array('required'=>false));
    	$builder->add('telDomicile1', 'text',array('required'=>false));
    	$builder->add('telDomicile2', 'text',array('required'=>false));
    	$builder->add('emailPro', 'email',array('required'=>false));
    	$builder->add('emailPerso', 'email',array('required'=>false));
    	$builder->add('adresseLigne1', 'text',array('required'=>false));
    	$builder->add('adresseLigne2', 'text',array('required'=>false));
    	$builder->add('adresseLigne3', 'text',array('required'=>false));
    	$builder->add('cp', 'text',array('required'=>false));
    	$builder->add('region', 'text',array('required'=>false));
    	$builder->add('ville', 'text',array('required'=>false));
    	$builder->add('pays', 'text',array('required'=>false));
    	$builder->add('sitePerso', 'text',array('required'=>false));
        $builder->add('contactFormation', 'text',array('required'=>false));
    	$builder->add('fonction', 'text',array('required'=>false));
    	$builder->add('service', 'text',array('required'=>false));
    	$builder->add('organisation', 'text',array('required'=>false));
    	$builder->add('service', 'text',array('required'=>false));


	//Etat Civil 
	$builder->add('idSecu', 'text',array('required'=>false));
        $builder->add('dateNaissance', 'text',array('required'=>false));
        $builder->add('lieuNaissance', 'text',array('required'=>false));
        $builder->add('paysNaissance', 'text',array('required'=>false));
        $builder->add('nationalite', 'choice',array(
            'choices'   => array('' => '','Français' => 'Français', 'Etranger UE' => 'Etranger UE', 'Etranger hors UE' => 'Etranger hors UE')));
        $builder->add('situationMaritale', 'choice',array(
            'choices'   => array('' => '','Celibataire' => 'Celibataire', 'Vie maritale' => 'Vie maritale', 'Pacs' => 'Pacs' , 'Separe(e)' => 'Separe(e)' , 'Divorce(e)' => 'Divorce(e)' ,'Veuf(ve)' => 'Veuf(ve)' ,'Marie(e)' => 'Marie(e)')));
        $builder->add('enfantsACharge', 'text',array('required'=>false));
    }

    public function getName()
    {
        return 'EgwContact';
    }
}
?>