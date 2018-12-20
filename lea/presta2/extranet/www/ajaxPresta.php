<?php 
global $conn;
$database= new _database($conn);
$presta = new prestation($conn);
if(isset($_GET['action']) and $_GET['action']=="getDispositif")
{
	
	$data = $database->getDispositif($_GET['is_active']);
	echo json_encode($data);
}
elseif(isset($_GET['action']) and $_GET['action']=="getRepartition")
{
	
	$data = $presta->getRepartition($_GET['idDispositif'],$_GET['idReferent'],$_GET['mot']);
	echo json_encode($data);
}
elseif(isset($_GET['action']) and $_GET['action']=="getPrestationByRef")
{
	$data = $presta->getPrestationByRef($_GET['id_ref'],$_GET['id_dispositif'],$_GET['statut'],$_GET['mot']);
	for($i=0;$i<count($data);$i++)
	{
	if($data[$i]['date_debut']!=0)
	{
	$data[$i]['DATEDEB'] =   date('d/m/Y',$data[$i]['date_debut']);
	}
	else {
		$data[$i]['DATEDEB']="";
	}
	if($data[$i]['date_fin']!=0)
	{
	$data[$i]['DATEFIN'] =   date('d/m/Y',$data[$i]['date_fin']);
	}
	else {
		$data[$i]['DATEFIN']="";
	}
	if($data[$i]['date_fin_reelle']!=0)
	{
	$data[$i]['DATEFINREL'] =   date('d/m/Y',$data[$i]['date_fin_reelle']);
	}
	else {
		$data[$i]['DATEFINREL']="";
	}
	if($data[$i]['date_envoi_bilan']!=0)
	{
	$data[$i]['DATEENVOI'] =   date('d/m/Y',$data[$i]['date_envoi_bilan']);
	}
	else {
		$data[$i]['DATEENVOI']="";
	}
	$data[$i]['intitule']=utf8_encode($data[$i]['intitule']);
	
	}
	echo json_encode($data);
}

elseif(isset($_GET['action']) and $_GET['action']=="getPrestationByIdPresta")
{
	
	$data = $presta->getPrestationByIdPresta($_GET['idPresta']);
	if($data['date_debut']!=0)
	{
	$data['DATEDEB'] =   date('d/m/Y',$data['date_debut']);
	}
	else {
		$data['DATEDEB']="";
	}
	if($data['date_fin']!=0)
	{
	$data['DATEFIN'] =   date('d/m/Y',$data['date_fin']);
	}
	else {
		$data['DATEFIN']="";
	}
	if($data['date_fin_reelle']!=0)
	{
	$data['DATEFINREL'] =   date('d/m/Y',$data['date_fin_reelle']);
	}
	else {
		$data['DATEFINREL']="";
	}
	if($data['date_envoi_bilan']!=0)
	{
	$data['DATEENVOI'] =   date('d/m/Y',$data['date_envoi_bilan']);
	}
	else {
		$data['DATEENVOI']="";
	}
	
	
	
	echo json_encode($data);
}
elseif(isset($_GET['action']) and $_GET['action']=="updatePresta")
{
	// error_log("spirea");
	if(!isset($_GET['idPresta']))
	{
	$data = prestation::getSession();
	$_GET['idPresta'] = $data['IDPRESTA'];
	}
//die($_GET['statut']);
	if(isset($_GET['control']) && $_GET['control']!='' && ($_GET['control']==1 || $_GET['control']==0 || $_GET['control']==4))
	{
	$_GET['statut'] = outils::getStatutPresta($_GET['control']);
	$data = array (	
					"statut"			=>		$_GET['statut'],
					);
	$presta->updatePresta($_GET['idPresta'],$data);
	}
	else if(!isset($_GET['control']))
	{
	$data = array (	"lettre_de_commande"=>		 $_GET['lc'],
					"id_ref"			=>		 $_GET['id_ref'],
					"date_debut"		=>		outils::getTps($_GET['date_debut']),
					"date_fin"     		=>		outils::getTps($_GET['date_fin']),
					"statut"			=>		$_GET['statut'],
					"date_fin_reelle"	=>		outils::getTps($_GET['date_fin_reelle']),
					"date_envoi_bilan"		=>		outils::getTps($_GET['date_envoi']));
	$presta->updatePresta($_GET['idPresta'],$data);
	}
	elseif($_GET['control']==3)
	{
		$_GET['control'] = 1;
	}
	else
	{
		$_GET['control'] = "no";
	}
	
	echo json_encode($_GET['control']);
}
elseif(isset($_REQUEST['action']) and $_REQUEST['action']=="abandonPresta")
{
	$data = prestation::getSession();
	$params = array( 	"motif_abandon" 		=> 	$_REQUEST['motif_abandon'],
						"date_abandon"	=>	outils::getTps($_REQUEST['date_abandon'])
					);
	$presta_data = new presta_data();	
	$presta_data->id_presta	= $data['IDPRESTA'];
	$presta_data->set($params,$data['IDPRESTA']);

	prestation::updatePresta($data['IDPRESTA'],array('statut'=>'Abandon'));

	echo json_encode(1);
}
	
?>