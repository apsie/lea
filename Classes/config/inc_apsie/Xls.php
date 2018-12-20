<?php
require_once(realpath(dirname(__FILE__)) . '/Employee.php');
require_once(realpath(dirname(__FILE__)) . '/Contact.php');
include('config/config.php');

/**
 * @access public
 */
class Xls {
	
	
	public function __construct() {
		// Not yet implemented
		
		
		
    	 
	}
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	/**
	 * @access public
	 */
	 
	function liste_contact_cochee($ids_contact,$id_employee,$intitule_requete)
	{
		include("PHPExcel/IOFactory.php");




if (!file_exists("./doc/liste_contact.xls")) {
	
	
	exit();
}

	

$objPHPExcel = PHPExcel_IOFactory::load("./doc/liste_contact.xls");
//$sheetupa=$objPHPExcel->getActiveSheet()->SetTitle('Feuil11');
$sheetupa=$objPHPExcel->getActiveSheet();
/*$objPHPExcel->getActiveSheet()->getStyle('C8')->getNumberFormat()
->setFormatCode('00000000000000'); */
/*$objPHPExcel->getActiveSheet()->getStyle('C13')->getNumberFormat()
->setFormatCode('00000000000000'); */

$id_contact = explode(',',$ids_contact);

$depart = 15;
for($i=0;$i<count($id_contact);$i++)
{
 $contact = Contact::get_contact_array($id_contact[$i]);
 //echo var_dump($contact);
 $sheetupa->setCellValue('A'.($depart+$i), $i+1);
 $sheetupa->setCellValue('B'.($depart+$i), utf8_encode($contact['nom_complet']));
 $sheetupa->setCellValue('C'.($depart+$i), utf8_encode($contact['fonction']));
 $sheetupa->setCellValue('D'.($depart+$i), $contact['tel_pro_1']);
 $sheetupa->setCellValue('E'.($depart+$i), $contact['tel_domicile_1']);
 $sheetupa->setCellValue('F'.($depart+$i), $contact['portable_perso']);
 $sheetupa->setCellValue('G'.($depart+$i), utf8_encode($contact['email_perso']));
 $sheetupa->setCellValue('H'.($depart+$i), utf8_encode($contact['adresse_ligne_1']).' '.utf8_encode($contact['adresse_ligne_2']).' '.utf8_encode($contact['adresse_ligne_3']));
 $sheetupa->setCellValue('I'.($depart+$i), $contact['cp']);
 $sheetupa->setCellValue('J'.($depart+$i), utf8_encode($contact['ville']));
 
}
$sheetupa->setCellValue('B12', count($id_contact));
$sheetupa->setCellValue('D5', date('d/m/Y'));
$account=Employee::get_employee($id_employee);
$sheetupa->setCellValue('D6',$account[0].' '.$account[1]);
$sheetupa->setCellValue('B9',utf8_encode($intitule_requete));



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Liste_contact.xls"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

	}
}
?>