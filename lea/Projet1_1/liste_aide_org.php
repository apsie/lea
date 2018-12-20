<?php
// include("config/config_ajax.php");
include("/data/html/egw_apsie_143/Classes/config/config_ajax.php");

// PHP5 Implementation - uses MySQLi.
// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
$db = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']);
if (!$db) {
    // Show error if we cannot connect.
    echo 'ERROR: Could not connect to the database.';
} else {
	$query = $db->query("SELECT * FROM egw_projet_config WHERE config_name = 'client_financier'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	$type_client = $row['config_value'];

    // Is there a posted query string?
    if (isset($_POST['queryString'])) {
        $queryString = $db->real_escape_string($_POST['queryString']);
            
        // Is the string length greater than 0?
        if ($queryString==' ') {
            // $query = $db->query("SELECT code_org,id_organisation FROM egw_organisation WHERE  categorie_org like '%240%' order by code_org asc");
			$query = $db->query("SELECT client_id, client_company FROM spiclient WHERE  client_type = 8 order by client_id asc");
        } elseif (strlen($queryString) >0) {
            // $query = $db->query("SELECT code_org,id_organisation FROM egw_organisation WHERE code_org LIKE '$queryString%' and  categorie_org like '%240%' LIMIT 10");
			$query = $db->query("SELECT client_id, client_company FROM spiclient WHERE  client_type IN ($type_client) AND (client_company LIKE '$queryString%') order by client_id asc");
        }
            // Run the query: We use LIKE '$queryString%'
            // The percentage sign is a wild-card, in my example of countries it works like this...
            // $queryString = 'Uni';
            // Returned data = 'United States, United Kindom';
                
            // YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
            // eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
                
            //$query = $db->query("SELECT code_org,id_organisation FROM egw_organisation WHERE code_org LIKE '$queryString%' and  categorie_org like '%240%' LIMIT 10");
        if ($query) {
            // While there are results loop through them - fetching an Object (i like PHP5 btw!).
            while ($result = $query->fetch_object()) {
				// Format the results, im using <li> for the list, you can change it.
				// The onClick function fills the textbox with the result.
				
				// YOU MUST CHANGE: $result->value to $result->your_colum
				//',\'La solution alternative à l\'emploi est '.$result->ville1.' ( '.$result->code_rome.' )
				echo '<li onClick="fill(\''.$result->client_company.'\',\''.$result->client_id.'\');">'.$result->client_company.'</li>';
            }
        }
    }
}
