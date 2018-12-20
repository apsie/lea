<?php

require_once "class.writeexcel_workbook.inc.php";
require_once "class.writeexcel_worksheet.inc.php";

$fname = tempnam("/tmp", "textwrap.xls");
$workbook = &new writeexcel_workbook($fname);
$worksheet = &$workbook->addworksheet();



$worksheet->set_column('A:B', 25); // // le 30 représente la largeur de chaque colonne  
$worksheet->set_column('B:C', 45);
$worksheet->set_column('C:D', 25);
$worksheet->set_row('7:8', 25);
$worksheet->set_row('8:9', 25);
$worksheet->set_row('9:10', 25);
$worksheet->set_row('10:11', 25);
$worksheet->set_row('11:12', 25);
$worksheet->set_row('12:13', 25);
$worksheet->set_row('13:14', 25);
$worksheet->set_row('14:15', 25);
$worksheet->set_row('15:16', 25);
$worksheet->set_row('16:17', 25);
$worksheet->set_row('17:18', 25);
$worksheet->set_row('18:19', 25);

$heading_version  =& $workbook->addformat(array(  

'bold'    => 0,    // on met le texte en gras  

'color'   => 'grey', // de couleur noire  

'size'    => 10,    // de taille 12  

'merge'   => 0,    // avec une marge  


//'fg_color'    => 0x33 // coloration du fond des cellules  

));  

$heading_pole  =& $workbook->addformat(array(  

'bold'    => 1,    // on met le texte en gras  

'color'   => 'blue', // de couleur noire  

'size'    => 12,    // de taille 12  

'merge'   => 0,    // avec une marge  
'align'   => 'left',    // avec une marge 

//'fg_color'    => 0x33 // coloration du fond des cellules  

));
$heading_l1  =& $workbook->addformat(array(  

'fg_color'    => 47 // coloration du fond des cellules  

));
$heading_l2  =& $workbook->addformat(array(  

'fg_color'    => 15 // coloration du fond des cellules  

));

$worksheet->write("B5",'Pôle emploi : Gestion des bilans de prestation',$heading_pole);
$worksheet->write("B8",'Siret Mandataire',$heading_l1);
$worksheet->write("C8","",$heading_l1);
$worksheet->write("B9",'Adresse mail (pour la gestion des retours)',$heading_l2);
$worksheet->write("C9",'',$heading_l2);
$worksheet->write("B10",'N° Marché',$heading_l1);
$worksheet->write("C10",'',$heading_l1);
$worksheet->write("B11",'N° DE',$heading_l2);
$worksheet->write("C11",'',$heading_l2);
$worksheet->write("B12",'N° de département de résidence du DE',$heading_l1);
$worksheet->write("C12",'',$heading_l1);
$worksheet->write("B13",'Siret prestataire',$heading_l2);
$worksheet->write("C13",'',$heading_l2);
$worksheet->write("B14",'N° LC',$heading_l1);
$worksheet->write("C14",'',$heading_l1);
$worksheet->write("B15",'Date de démarrage',$heading_l2);
$worksheet->write("C15",'',$heading_l2);
$worksheet->write("B16",'Code Agence',$heading_l1);
$worksheet->write("C16",'',$heading_l1);
$worksheet->write("B17",'Type de prestation',$heading_l2);
$worksheet->write("C17",'',$heading_l2);
$worksheet->write("B18",'Date éventuelle d\'abandon',$heading_l1);
$worksheet->write("C18",'',$heading_l1);
$worksheet->write("A21",'Version 2.0',$heading_version);

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"example-textwrap.xls\"");
header("Content-Disposition: inline; filename=\"example-textwrap.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);

?>
