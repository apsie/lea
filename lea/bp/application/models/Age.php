<?php class Age
{
   
	
	public function __construct()
	{}
	
	public function get_age($timestamp_naissance) 
		{
			if($timestamp_naissance)
			{
     $dat= explode("/",date("d/m/Y", $timestamp_naissance));
	//Si on veut verifier à la date actuelle ( par défaut )
	if(empty($timestamp))
		$timestamp = time();
 
	//On evalue l'age, à un an par exces
	$age = date('Y',$timestamp) - $dat[2];
 
	//On retire un an si l'anniversaire n'est pas encore passé
	if($dat[1] > date('n', $timestamp) || ( $dat[1]== date('n', $timestamp) && $dat[0] > date('j', $timestamp)))
		$age--;
 
	return $age.' ans';
			}
		
}
	
	
}
?>