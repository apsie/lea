<?php
namespace Lea\PrestaBundle\Models;
class Texte
{
	public static function getOptionByIdTexte($data)
	{
		$newData = array();
		foreach ($data as $key => $row):
		//\Doctrine\Common\Util\Debug::dump($row->getIdTexteKey(),2);die();
			if(!isset($newData[$row->getIdTexteKey()]))
			$newData[$row->getIdTexteKey()] = '';
			
			$texte = $row->getTexte();
			$Idtexte = $row->getIdTexteKey();
			$newData[$row->getIdTexteKey()] .= '<option class="text_option" value="'.$row->getTexte().'">'.$row->getTexte().'</option>';
			
		endforeach;
		return $newData;
	}

	public static function getListeByIdTexte($data)
	{
		$newData = array();
		foreach ($data as $key => $row){
			$newData[$row->getIdTexteKey()][$row->getIdTexte()] = $row->getTexte();
		}
		return $newData;
	}
	
	public static function getTelV2($entity)
		{
			
				if($entity->getPortablePerso()!="")
	        	return $entity->getPortablePerso(); 
	        	elseif($entity->getPortablePro()!="")
	        	return $entity->getPortablePro(); 
	        	else if($entity->getTelPro1()!="")
	        	return $entity->getTelPro1(); 
	        	else if($entity->getTelDomicile1()!="")
	        	return $entity->getTelDomicile1();
	        	
		}
public static function getTelV3($entity)
		{
			
				
	        	if($entity->getTelWork()!="")
	        	return $entity->getTelWork(); 
	        	else if($entity->getTelCell()!="")
	        	return $entity->getTelCell(); 
	        	
	        	
		}
	public static function getEmail($entity)
		{
			
				if($entity->getEmailPerso()!="")
	        	return $entity->getEmailPerso(); 
	        	elseif($entity->getEmailPro()!="")
	        	return $entity->getEmailPro(); 
	        	
	        	
		}
}
