<?php class Age
{
   
	
	public function __construct()
	{}
	
	public function get_age($timestamp_naissance) 
		{
			if($timestamp_naissance)
			{
     $dat= explode("/",date("d/m/Y", $timestamp_naissance));
	//Si on veut verifier � la date actuelle ( par d�faut )
	if(empty($timestamp))
		$timestamp = time();
 
	//On evalue l'age, � un an par exces
	$age = date('Y',$timestamp) - $dat[2];
 
	//On retire un an si l'anniversaire n'est pas encore pass�
	if($dat[1] > date('n', $timestamp) || ( $dat[1]== date('n', $timestamp) && $dat[0] > date('j', $timestamp)))
		$age--;
 
	return $age.' ans';
			}
		
}
	
	
}
?>