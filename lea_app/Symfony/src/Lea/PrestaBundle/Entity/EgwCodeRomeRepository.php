<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 *  EgwCodeRomeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EgwCodeRomeRepository extends EntityRepository
{
	
		
		public function get($string = null)
		{
			
			
			$dql="	SELECT c FROM LeaPrestaBundle:EgwCodeRome c
					where c.appellation like '".$string."%'
        			";
			
			
			
			return $this->getEntityManager()
					->createQuery($dql)
					->getResult();
		}
	
}