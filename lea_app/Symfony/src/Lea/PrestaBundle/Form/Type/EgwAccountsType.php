<?php

namespace Lea\PrestaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class EgwAccountsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
    	
    /*	$options =  $er->createQueryBuilder('a')
        			->select('p, a')
        			->innerJoin('a.accountId', 'p')
        			->where('a.accountType = :type')
        			->andwhere('a.accountStatus = :status')
        			->andwhere('a.accountPrimaryGroup = :g')
					->setParameter('type', 'u')
					->setParameter('status', 'A')
					->setParameter('g', -3007)
            		->orderBy('p.nFn','ASC');*/
    	// \Doctrine\Common\Util\Debug::dump($options);die();
            		$data = array(''=>'');
            		foreach ($options['data']['accounts'] as $key => $value) {
            			
            			$data[$value->getAccountId()->getAccountId()] = $value->getAccountId()->getNFn();
            		}
           if(isset($options['data']['session_user']))
           $id = $options['data']['session_user']->getAccountId()->getAccountId();
           else 
           $id = null;
            		
    	  $builder->add('account_id', 'choice',array(
        'choices'   =>$data,'data'=>$id));
    	  
    }
		
			
    
    

    public function getName()
    {
        return 'EgwAccounts';
    }
}
?>