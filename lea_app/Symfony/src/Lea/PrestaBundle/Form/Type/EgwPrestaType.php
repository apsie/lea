<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwPrestaType extends AbstractType
{
 	private $em = null;

    public function __construct(\Doctrine\ORM\EntityManager $em = null){
    	if($em !=null)
        $this->em = $em; 
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
		//\Doctrine\Common\Util\Debug::dump( $options,2);die();
		$builder->add('dispositif', 'entity', array(
			'class' 	=> 'LeaPrestaBundle:EgwDispositif', 
			'property'  => 'nomDispositif',
			'label'  	=> 'nomDispositif',
			'required'  => true,
			'empty_value' => '',
			'query_builder' => function(EntityRepository $er) 
			{
			return $er->createQueryBuilder('d')
			->where('d.isActive = :isActive')
			->setParameter('isActive', 1)
			->orderBy('d.nomDispositif','ASC');
			},
		));

		$builder->add('dateDebut', 'text',array('required'=>false));
		$builder->add('dateFin', 'text',array('required'=>false));
		$builder->add('dateFinReelle', 'text',array('required'=>false));
		$builder->add('dateEnvoiBilan', 'text',array('required'=>false));

		$builder->add('intitule', 'text',array('required'=>false));
		$builder->add('lettreDeCommande', 'text');

    	$builder->add('statut', 'choice',array(
			'choices'    => array('' => '',
			'Nouvelle'   => 'Nouvelle',
			'En cours'   => 'En cours',
			'Complete'   => 'Complete',
			'Abandon'    =>	'Abandon',
			'A cloturer' =>	'A cloturer',
			'Annulee'    =>	'Annulee'),'required' => false)
		);
    	  
        if($this->em!=null)
        {
            $ac = $this->em->getRepository('LeaPrestaBundle:EgwAccounts')->getAccounts();
            $data = array();
            foreach ($ac as $key => $value) {
                $data[$value->getAccountId()->getAccountId()] = $value->getAccountId()->getNFn();
            }

            $builder->add('idRef', 'choice',array(
            'choices'   =>$data,'data'=>$options['data']->getIdRef()));
        }else{
			$builder->add('champDate', 'choice',array(
				'choices'   => array(
					'dateDebut' => 'Date de debut',
					'dateFin' => 'Date de fin',
					'dateFinReelle'	=>	'Date de fin réelle',
					'dateEnvoiBilan'	=>	'Date d\'envoi du bilan')
				,'required' => false)
			);
		}
			
    }

    public function getName()
    {
        return 'EgwPresta';
    }
}
?>