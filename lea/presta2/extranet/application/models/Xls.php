<?php

class _Xls
{		
	

	function genererXls($libelle_xls='')
	{
	//ini_set('mbstring.internal_encoding', 'ISO-8859-1');
ini_set('memory_limit','2048M');
			if(isset($_SESSION['TEMPS']['DATACONTACT']) and $_SESSION['TEMPS']['DATACONTACT']!=NULL and $libelle_xls=='contact')
			{
	//print_r($_SESSION['TEMPS']['CHAMPSCONTACT']);
	//ini_set('display_errors',"off");
	
		if(!file_exists('./doc/modele_contact.xls'))
								{
									exit();
								}
								else
								{
						
							$ligneDebut=6;
							$objPHPExcel = PHPExcel_IOFactory::load('./doc/modele_contact.xls');
							$objPHPExcel->getProperties()->setTitle('Contact');
							$sheetupa = $objPHPExcel->getActiveSheet();
							
							$objDrawing = new PHPExcel_Worksheet_Drawing();
							$objDrawing->setName('Logo');
							$objDrawing->setDescription('Logo');
							$objDrawing->setPath('./images/logo/apsie_extranet.png');
							$objDrawing->setHeight(58);
							$objDrawing->setWidth(156);
							$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
							$objPHPExcel->getDefaultStyle()->getFont()->setSize(8); 
							$key = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
								
							for($i=0;$i<count($_SESSION['TEMPS']['LIBELLECONTACT']);$i++)
							{
							$sheetupa->setCellValue($key[$i].'5',$_SESSION['TEMPS']['LIBELLECONTACT'][$i]);
							if($_SESSION['TEMPS']['CHAMPSCONTACT'][$i]=="nom_complet")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
							if($_SESSION['TEMPS']['CHAMPSCONTACT'][$i]=="cp")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(7);
							}
							if($_SESSION['TEMPS']['CHAMPSCONTACT'][$i]=="fonction")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
							if($_SESSION['TEMPS']['CHAMPSCONTACT'][$i]=="description_projet")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
					
							
							for($z=0;$z<count($_SESSION['TEMPS']['DATACONTACT']);$z++)
							{
							$sheetupa->setCellValue($key[$i].$ligneDebut,str_replace('<br/>',' - ',$_SESSION['TEMPS']['DATACONTACT'][$z][$_SESSION['TEMPS']['CHAMPSCONTACT'][$i]]));
							$ligneDebut++;
							}
							$ligneDebut=6;
							}
								
								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="Contact.xls"');
							header('Cache-Control: max-age=0');
							$objWriter->save('php://output');
							
							exit();
								}
							
			}
	if(isset($_SESSION['TEMPS']['DATAORGANISATION']) and $_SESSION['TEMPS']['DATAORGANISATION']!=NULL and $libelle_xls=='organisation')
			{
	//print_r($_SESSION['TEMPS']['CHAMPSCONTACT']);
	//ini_set('display_errors',"off");
	
		if(!file_exists('./doc/modele_contact.xls'))
								{
									exit();
								}
								else
								{
						
							$ligneDebut=6;
							$objPHPExcel = PHPExcel_IOFactory::load('./doc/modele_contact.xls');
							$objPHPExcel->getProperties()->setTitle('Organisation');
							$sheetupa = $objPHPExcel->getActiveSheet();
							
							$objDrawing = new PHPExcel_Worksheet_Drawing();
							$objDrawing->setName('Logo');
							$objDrawing->setDescription('Logo');
							$objDrawing->setPath('./images/logo/apsie_extranet.png');
							$objDrawing->setHeight(58);
							$objDrawing->setWidth(156);
							$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
							$objPHPExcel->getDefaultStyle()->getFont()->setSize(8); 
							$key = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
								
							for($i=0;$i<count($_SESSION['TEMPS']['LIBELLEORGANISATION']);$i++)
							{
							$sheetupa->setCellValue($key[$i].'5',$_SESSION['TEMPS']['LIBELLEORGANISATION'][$i]);
							if($_SESSION['TEMPS']['CHAMPSORGANISATION'][$i]=="nom_complet")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
							if($_SESSION['TEMPS']['CHAMPSORGANISATION'][$i]=="cp")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(7);
							}
							if($_SESSION['TEMPS']['CHAMPSORGANISATION'][$i]=="fonction")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
							if($_SESSION['TEMPS']['CHAMPSORGANISATION'][$i]=="description_projet")
							{
							$objPHPExcel->getActiveSheet()->getColumnDimension($key[$i])->setWidth(30);
							}
					
							
							for($z=0;$z<count($_SESSION['TEMPS']['DATAORGANISATION']);$z++)
							{
							$sheetupa->setCellValue($key[$i].$ligneDebut,str_replace('<br/>',' - ',$_SESSION['TEMPS']['DATAORGANISATION'][$z][$_SESSION['TEMPS']['CHAMPSORGANISATION'][$i]]));
							$ligneDebut++;
							}
							$ligneDebut=6;
							}
								
								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="Organisation.xls"');
							header('Cache-Control: max-age=0');
							$objWriter->save('php://output');
							
							exit();
								}
							
			}
			
		if(isset($_SESSION['TEMPS']['DATAPROJET']) and $_SESSION['TEMPS']['DATAPROJET']!=NULL and $libelle_xls=='projet')
			{
	//print_r($_SESSION['TEMPS']['CHAMPSCONTACT']);
	//ini_set('display_errors',"off");
	
		if(!file_exists('./doc/modele_projet.xls'))
								{
									exit();
								}
								else
								{
						
							$ligneDebut=6;
							$objPHPExcel = PHPExcel_IOFactory::load('./doc/modele_projet.xls');
							$objPHPExcel->getProperties()->setTitle('Projet');
							$sheetupa = $objPHPExcel->getActiveSheet();
							
							$objDrawing = new PHPExcel_Worksheet_Drawing();
							$objDrawing->setName('Logo');
							$objDrawing->setDescription('Logo');
							$objDrawing->setPath('./images/logo/apsie_extranet.png');
							$objDrawing->setHeight(58);
							$objDrawing->setWidth(156);
							$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
							$objPHPExcel->getDefaultStyle()->getFont()->setSize(8); 
						
								
							
					
							
							for($z=0;$z<count($_SESSION['TEMPS']['DATAPROJET']);$z++)
							{
							$sheetupa->setCellValue("A".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['intitule_projet']);
							$sheetupa->setCellValue("B".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['date_debut']);
							$sheetupa->setCellValue("C".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['date_fin_previsionnelle']);
							$sheetupa->setCellValue("D".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['date_fin_reelle']);
							$sheetupa->setCellValue("E".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['account_firstname'].' '.$_SESSION['TEMPS']['DATAPROJET'][$z]['account_lastname']);
							$sheetupa->setCellValue("F".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['description_projet']);
							$sheetupa->setCellValue("G".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['resultat']);
							$sheetupa->setCellValue("H".$ligneDebut,$_SESSION['TEMPS']['DATAPROJET'][$z]['statut']);
							$ligneDebut++;
							}
							$ligneDebut=6;
							}
								
								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="Projet.xls"');
							header('Cache-Control: max-age=0');
							$objWriter->save('php://output');
							
							exit();
								
								
							
			}
	
	}
	
}


?>