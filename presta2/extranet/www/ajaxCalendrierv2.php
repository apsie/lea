<?php
global $conn;
$calendrier = new calendrier();
$p_database = new _database($conn);

header('Content-type:text/javascript;charset=UTF-8');
$action = $_GET["action"];
switch ($action) {
    case "getListCalendrier":
    	
    	
   $data =  $calendrier->getSemaine($_GET['date']);
  $dateArr =  explode('/',$_GET['date']);
  $tps = mktime(0,0,0,$dateArr[1],$dateArr[0],$dateArr[2]);
  
   $dataDate =  $calendrier->listCalendarByRange($data['TPS'][0], $data['TPS'][1],$_GET['id_referent']);
   
   for($i=0;$i<count( $dataDate);$i++)
   {
   	 $dataDate[$i]['date_debut'] = date('dmy H:i', $dataDate[$i]['StartTime']);
   	 $dataDate[$i]['Description'] = utf8_encode($dataDate[$i]['Description']);
   	 	 $dataDate[$i]['Subject'] = utf8_encode($dataDate[$i]['Subject']);
   }
   
   
  
   echo json_encode(array('DATE'=>$data,'DATA'=>$dataDate,'NEXTDATE'=>date('d/m/Y',$tps+7*24*60*60), 'PREVDATE'=>date('d/m/Y',$tps-7*24*60*60)));
    break;
	case "getDateTps":
		$date = date('d/m/Y',$_GET['tps']);
		$heure = date('H',$_GET['tps']);
		$min = date('i',$_GET['tps']);
		$data['date']=$date;
		$data['heure']=$heure;
		$data['min']=$min;
		echo json_encode($data);
	break;
	case "getDetailsCal":
	 $data = $calendrier->getDetailsCal($_GET['Id']);
	
	 	$data['Description'] = utf8_encode($data['Description']);
	 	$data['Subject'] = utf8_encode($data['Subject']);
	 	$data['date'] = date('d/m/Y',$data['StartTime']);
	 	$data['heure'] = date('H',$data['StartTime']);
	 	$data['min'] = date('i',$data['StartTime']);
	 	$data['id_presta'] = $_SESSION['TEMPS_ID_PRESTA'];
	 
	echo json_encode($data);
	
	break;
}




?>