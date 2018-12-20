<?php
	
	include("../../Classes/config/inc_apsie/Contact.php");
	$contact= new Contact();
	
	if(isset($_POST['cp']))
	{
	$contact->liste_aide_contact($_POST['cp'],'cp');
	}
	

?>