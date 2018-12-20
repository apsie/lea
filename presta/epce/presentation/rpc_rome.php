<?php
	
	include("/data/html/egw_apsie_143/Classes/config/config_ajax.php");
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	$db = new mysqli($db['host'], $db['username'] ,$db['password'],$db['dbname']);
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT intitule,code_rome,appellation FROM egw_code_rome WHERE appellation LIKE '$queryString%' LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					
						


	
	
	while ($result = $query ->fetch_object()) {
		$test=$result->intitule;
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
						//',\'La solution alternative à l\'emploi est '.$result->ville1.' ( '.$result->code_rome.' ) 
	         			echo '<li onClick="fill_rome(\''.$result->code_rome.'\',\'Nous préconisons une reprise des démarches de recherche d emploi sur un poste de : '.$test.' ( '.$result->code_rome.' ) \');">'.$result->appellation.'</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>