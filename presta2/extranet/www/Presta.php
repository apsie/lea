<?php 

$view->headScript()->appendFile('./js/prototype.js');
$view->headScript()->appendFile('./js/class/presta.js');
$view->headScript()->appendFile('./js/class/graph.js');
$view->headScript()->appendFile('./js/class/template.js');
$view->headScript()->appendFile('./js/class/color.js');
$view->headScript()->appendFile('./js/class/calendrier.js');
$view->headScript()->appendFile('./js/class/navigation.js');
$view->headScript()->appendFile('./js/class/option.js');
$view->headScript()->appendFile('./js/class/contact.js');
$view->headScript()->appendFile('./js/class/organisation.js');

/*$view->headLink()->appendStylesheet('./style/opcrea.css');
$view->headLink()->appendStylesheet('./style/oe.css');	
		
*/
$view->utilisateurs =utilisateur::getUtilisateurs("A");
?>