<?php

class epce_mail
{
	
	
	function mail_fichier ($data,$to_address,$from_address,$subject)
	
	{	
	/*$to_address="recipient@example.com";
	$from_address="sender@example.com";
	$subject="File Contents";*/
	$headers = 'From: '.$from_address."\r\n".
	'Reply-To: '.$from_address."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	mail($to_address, $subject, $data, $headers);
    }
?>

