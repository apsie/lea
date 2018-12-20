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
    // Is there a posted query string?
    // $_POST['queryString'] = 'TR';
    // $_POST['id_organisation'] = 261;

    if (isset($_POST['queryString'])) {
        // $queryString = $db->real_escape_string($_POST['queryString']);
        $queryString = $_POST['queryString'];
        
		// echo $_POST['id_organisation'];
        // Is the string length greater than 0?
        if ($queryString==' ') {
            // $query = $db->query("SELECT nom, prenom, fonction FROM egw_contact WHERE id_organisation like '%".$_POST['id_organisation']."%'  and  cat_id like '%261%' LIMIT 10");
			$query = $db->query("SELECT n_family, n_given, link_remark FROM egw_links L, egw_addressbook A WHERE A.contact_id = L.link_id2 AND L.link_app1 = 'spiclient' AND L.link_id1 = '".$_POST['id_organisation']."'");
			
        } elseif (strlen($queryString) > 0) {
            // Run the query: We use LIKE '$queryString%'
            // The percentage sign is a wild-card, in my example of countries it works like this...
            // $queryString = 'Uni';
            // Returned data = 'United States, United Kindom';
                
            // YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
            // eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10               
            // $query = $db->query("SELECT nom,prenom,fonction FROM egw_contact WHERE id_organisation like '%".$_POST['id_organisation']."%' and  nom LIKE '$queryString%' and  cat_id like '%261%' LIMIT 10");
			$query = $db->query("SELECT n_family, n_given, link_remark FROM egw_links L, egw_addressbook A WHERE A.contact_id = L.link_id2 AND L.link_app1 = 'spiclient' AND L.link_id1 = '".$_POST['id_organisation']."' AND (n_family LIKE '".$queryString."%' OR n_given LIKE '".$queryString."%')");

            // echo "SELECT n_family, n_given, link_remark FROM egw_links L, egw_addressbook A WHERE A.contact_id = L.link_id2 AND L.link_app1 = 'spiclient' AND L.link_id1 = '".$_POST['id_organisation']."' AND (n_family LIKE '".$queryString."%' OR n_given LIKE '".$queryString."%')";
        }
        if ($query) {
            
            // While there are results loop through them - fetching an Object (i like PHP5 btw!).
            while ($result = $query->fetch_object()) {
                // Format the results, im using <li> for the list, you can change it.
				// The onClick function fills the textbox with the result.
				
				// YOU MUST CHANGE: $result->value to $result->your_colum
				//',\'La solution alternative à l\'emploi est '.$result->ville1.' ( '.$result->code_rome.' )
				echo '<li onClick="fill_contact_nom(\''.$result->n_family.'\',\''.$result->n_given.'\');">'.$result->n_family.' '.$result->n_given.' ( '.$result->link_remark.' )</li>';
            }
        }
    }
}
