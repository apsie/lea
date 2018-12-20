<?php
namespace Lea\PrestaBundle\Models;
class Arr
{
	public  static function convertDataPresta($data)
	{
		$newData = array();
		foreach ($data as $id => $value):
		$newData[$value->getClef()] = trim($value->getValeur());
		endforeach;
		
		return $newData;
		
	}
}