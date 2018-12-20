<?php
namespace Lea\PrestaBundle\Models;
class Outils
{

	public static function supCaractere($string) 
	{ 
		$res=""; 
		        
		//pattern array 
		$search=array(		 
		"[Ç|¢|ç]", 
		"[ü|û|ù|Ü|ú|Ú|Û|Ù]", 
		"[é|ê|ë|è|É|Ê|Ë|È]", 
		"[â|ä|à|å|Ä|Å|á|Á|Â|À|ã|Ã]", 
		"[ï|î|ì|í|Í|Î|Ï|Ì]", 
		"[ô|ö|ò|Ö|ø|Ø|ó|Ó|Ô|Ò|õ|Õ]", 
		"[ÿ|ý|Ý]", 
		"[ñ|Ñ]", 
		"[Ð]" 
		); 
		
		//replacement array 
		$replace=array(
		"c", 
		"u", 
		"e", 
		"a", 
		"i", 
		"o", 
		"y", 
		"n", 
		"d" 
		); 
	
        $string = preg_replace($search,$replace,$string);       //remplacement 
        $string = trim($string); 
        /*$string = ereg_replace(" ","",$string); 

        $string = ereg_replace("[^0-9a-zA-Z]","",$string); 
        $string = strtoupper($string); 
        //dedoublement des lettres 
        while($i<strlen($string)) 
        { 
                if(strcmp($string[$i],$string[$i+1])) 
                        $res.=$string[$i]; 
                $i++; 
        } 
        
        */
        
        return $string; 
	} 
	
	
	function getDroit($str)
	{
		$droit = explode(',',$str);
		return $droit;
	}
	function getApplicationAafficher($application,$droit)
	{
		$appAff = array();
		for($i=0;$i<count($droit);$i++)
		{
			for($z=0;$z<count($application);$z++)
			{
				//echo $application[$z]['app_id']."=>".$droit[$i]['id_application']."<br/>";
				if($application[$z]['app_id'] == $droit[$i]['id_application'] and $droit[$i]['droit']==1)
				{

					$appAff[] = $application[$z];
					next($appAff);
				}
			}
		}
		return $appAff;
	}
	function getTps($date)
	{
		$d = explode('/',$date);
		return mktime(0,0,0,$d[1],$d[0],$d[2]);
	}
	
	function getStatutPresta($value)
	{
		if($value==1)
		return "En cours";
		elseif($value==0) 
		return "Annulee";
		elseif($value==4) 
		return "Complete";
	}
	
	function convertDataPresta($data)
	{
		foreach ($data as $id => $value):
		$newData[$value['clef']] = utf8_encode(trim($value['valeur']));
		endforeach;
		
		return $newData;
		
	}
	function setCheckbox($string,$match=1)
	{

		if($string==$match)
		$newData = "checked='checked'";
		else 
		$newData = "";
		
		return $newData;
		
	}
	function defaultCheckBox($data,$arrayMatch,$val=0)
	{
		foreach ($arrayMatch as $id => $val):
		
		if(!in_array($val, $data))
		$data[$val] = 0;
		
		endforeach;
	}
	public static function convertDate($tps)
	{
		
		
		if($tps == 0 || $tps == null)
		$date="";
		else
		$date = date('d/m/Y',$tps);
		
		return $date;
	}
	function padLeft( $int, $valLeft ='0')
	{
		
		if($int<10)
		$int = (int)$valLeft.$int;
		
		return $int;
	}
	function supLeft( $int, $valLeft ='0')
	{
		
		if($int<10)
		$int = substr($int,1, 1);
		
		return $int;
	}
public static  function getTmps($date,$separateur="/",$multiplicateur=1,$addition=0,$gmt = false)
	{
		if(!$date) return 0;
		list($d,$h) = explode(" ",$date);
		list($heure,$min) = explode(":",$h);
		
		if(!is_numeric($heure))
		$heure = 0;
		
		if(!is_numeric($min))
		$min = 0;
		
		list($d,$m,$y) = explode($separateur,$d);
		
		if($gmt)
		$tps = gmmktime($heure,$min,0, $m, $d, $y);
		else
		$tps = mktime($heure,$min,0, $m, $d, $y);
		

		if($multiplicateur!=1)
		$tps = $tps * $multiplicateur;
		
		if($addition!=0)
		$tps = $tps + $addition;

		return $tps;
	}

}

?>