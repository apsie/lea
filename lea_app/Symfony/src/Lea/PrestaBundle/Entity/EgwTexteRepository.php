<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EgwTypePrestationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EgwTexteRepository extends EntityRepository
{
	public function get()
	{
		/*
		 * 
		if($params['texte']!=null && isset($params['texte']))
		$sqlPlus .=' AND texte="'.$params['texte'].'"';
		
		if($params['id_texte_key']!=null && isset($params['id_texte_key']))
		$sqlPlus .=' AND t.id_texte_key="'.$params['id_texte_key'].'"';
		
		if($params['id_texte']!=null && isset($params['id_texte']))
		$sqlPlus .=' AND t.id_texte="'.$params['id_texte'].'"';
		
		$sql="SELECT * FROM apsie_texte t
		LEFT JOIN apsie_texte_key k
		ON k.id_texte_key = t.id_texte_key WHERE 1 
		".$sqlPlus."
		 order by libelle,texte asc";
		//die($sql);*/
		
			$dql="SELECT a,tk FROM LeaPrestaBundle:EgwTexte a
				 inner join a.texteKey tk
				 order by tk.libelle,a.texte asc";
			
			//die($dql);
			return $this->getEntityManager()
					->createQuery($dql)
					
					->getResult();
	}
}
