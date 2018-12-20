<?php

$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'spid',
		'noheader' 		=> True,
		'nonavbar' 		=> True,
		'include_xajax'	=> true,
);

require_once('../../header.inc.php');

if(!isset($GLOBALS['egw_info']['user']['SpidLevel']))
{
	$spid_ui =& CreateObject('spid.spid_ui');
	$GLOBALS['egw_info']['user']['SpidLevel']=$spid_ui->isTechnicianOrManagerOrCustomer();
}
//Pour informations:
//- $SpidLevel=2  ==> Manager
//- $SpidLevel=1  ==> Technicien
//- $SpidLevel=0  ==> Client



$db=$GLOBALS['egw']->db;
header('Content-Type: text/xml');

$xml='<?xml version="1.0" ?>'."\n";
$xml.='<root>'."\n";
if($_REQUEST['select']!='initialize')
{
	$xml.=ArrayToXML($_REQUEST['select']($db),$_REQUEST['node']);
}
elseif($_REQUEST['select']=='initialize')
{
	$xml.=$_REQUEST['select']($db);
}

if($_REQUEST['select']=='ticket_assigned_to')
{
	$xml.=select_state($db);
}
$xml.=select_user();

$xml.='</root>'."\n";

echo $xml;
unset($db);

function ArrayToXML($data=array(),$rootNode='root')
{
	$xml='';
	$xml.='<'.$rootNode.'>'."\n";
	if(!empty($data))
	{
		foreach($data as $id=>$value)
		{
			if(!is_array($value))
			{
				$xml.='<'.substr($rootNode,0,-1).'>'."\n";
				if(strpos($value,'|'))
				{
					$ExplodeValue=explode('|',$value);
					$valeur=$ExplodeValue[0];
					$attribute='selected="true"';
				}
				else
				{
					$valeur=$value;
					$attribute='';
				}
				
				$xml.='<id_'.substr($rootNode,0,-1).' '.$attribute.'>'.$id.'</id_'.substr($rootNode,0,-1).'>'."\n";
				$xml.='<value_'.substr($rootNode,0,-1).'><![CDATA['.$valeur.']]></value_'.substr($rootNode,0,-1).'>'."\n";
				$xml.='</'.substr($rootNode,0,-1).'>'."\n";
			}
			else
			{
				$xml.='<'.substr($rootNode,0,-1).'>'."\n";	
				foreach($value as $cle=>$valeur)
				{				
					if(is_int($valeur))
					{
						$xml.='<'.$cle.'>'.$valeur.'</'.$cle.'>'."\n";
					}
					else
					{
						$xml.='<'.$cle.'><![CDATA['.$valeur.']]></'.$cle.'>'."\n";
					}
				}
				$xml.='</'.substr($rootNode,0,-1).'>'."\n";
			}
		}
		$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];
		$xml.='<spidlevel>'.$SpidLevel.'</spidlevel>';
	}
	$xml.='</'.$rootNode.'>'."\n";
	return $xml;
}

function select_state($db)
{
	$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];
	switch($SpidLevel)
	{
		case '0':
			$retour='<select_state>non</select_state>';
			break;
		case '2':
			$retour='<select_state>oui</select_state>';
			break;
		case '1':
			$valeur = (array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0;
			$SelectedCategorie=categorie($db,$valeur);
			$CatManagementGroup=$SelectedCategorie[$valeur]['cat_data']['cat_managementgroup'];
			$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
			$account_id = array_keys($accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
			if(in_array($CatManagementGroup,$account_id))
			{
				$retour='<select_state>oui</select_state>';
			}
			else
			{
				$retour='<select_state>non</select_state>';
			}
			break;
	}
	return $retour;
}

function select_user()
{
	$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];
	switch($SpidLevel)
	{
		case '0':
			$retour='<select_user>non</select_user>';
			break;
		case '1':
		case '2':
			$retour='<select_user>oui</select_user>';
			break;
	}
	return $retour;
}


//Fonction récursive pour lister les catégories mère et enfants...
function cat_id($db,$cat_parent=0)
{
	static $categories = array();
	$account_id = array();
	$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
	$table='egw_categories';
	$cat_appname='spid';
	$cols=array('cat_id','cat_name','cat_parent','cat_level','cat_data');
	$where=array
	(
		'cat_appname'	=> $cat_appname,
		'cat_access'	=> 'public',
		'cat_parent'	=> $cat_parent,
	);

	$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];
	switch($SpidLevel)
	{
		case 2:
			//Aucune particularité, vu que c'est un gestionnaire
			break;
		case 1:
			//On recherche les catégories dont ses groupes sont responsable, ainsi que les catégories qui sont géré par ses prestataires
			$account_id += array_keys($accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
		case 0:
		default:
			//On recherche les catégories de son ou ses prestataires
			$groupesDuUser = array_keys($accounts->memberships($GLOBALS['egw_info']['user']['account_id']));
			$account_id += prestataires($db,$groupesDuUser);
			break;
	}
	
	$append='order by cat_name ASC';
	${'rows'.$cat_parent}=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach(${'rows'.$cat_parent} as $row)
	{
		$cat_data=unserialize($row['cat_data']);
		if($cat_data['possible_select']==1 || $SpidLevel==1 & $cat_data['possible_select']==0)
		{
			if(in_array($cat_data['cat_managementgroup'],$account_id) || $SpidLevel==2)
			{
				$categories[$row['cat_id']]=str_repeat('-',$row['cat_level']).' '.$row['cat_name'];
			}
		}
		
		cat_id($db,$row['cat_id']);
	}
	return $categories;
}

//Fonction qui récupère les account_id des prestataires en fonction de l'utilisateur connecté
function prestataires($db,$groupesDuUser)
{
	$prestataires = array();
	$table='spid_clients C, spid_clients_relations R';
	$cat_appname='spid';
	$cols='C.account_id';
	$sql2='SELECT client_id FROM spid_clients WHERE account_id IN ('.implode(',',$groupesDuUser).')';
	$where='C.client_id=R.societe_id';
	$where.=' AND R.client_id IN ('.$sql2.')';
	$append='order by account_id ASC';
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach($rows as $row)
	{
		$prestataires[]=$row['account_id'];
	}
	return $prestataires;
}

//Fonction qui récupère les account_id des clients en fonction de l'utilisateur connecté
// fonction select de class.egw_db.inc.php
function liste_clients($db,$groupesDuUser)
{
	$clients = array();
	$table='spid_clients C, spid_clients_relations R';
	$cat_appname='spid';
	$cols='C.account_id';
	$sql2='SELECT societe_id FROM spid_clients_relations WHERE spid_clients.account_id IN ('.implode(',',$groupesDuUser).')';
	$where='C.client_id=R.societe_id';
	$where.=' AND R.client_id IN ('.$sql2.')';
	$where.=' AND C.client_sleep = 0';
	$append='order by account_id ASC';
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	
	foreach($rows as $row)
	{
		$clients[]=$row['account_id'];
	}
	return $clients;
}

//Fonction qui récupère les informations d'une catégorie
function categorie($db,$cat_id=0)
{
	$cat = array();
	$table='egw_categories';
	$cat_appname='spid';
	$cols='*';
	$where=array
	(
		'cat_id'	=> $cat_id,
	);
	$append='';
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach($rows as $row)
	{
		$cat_data=unserialize($row['cat_data']);
		$cat[$cat_id]=$row;
		$cat[$cat_id]['cat_data']=$cat_data;
	}
	return $cat;
}
//Fonction qui va permettre de lister les personnes assigné à 
function ticket_assigned_to($db)
{
	$valeur = (array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0;
	$cat=categorie($db,$valeur);
	$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
	
	$AssignedTo=$accounts->members($cat[$valeur]['cat_data']['cat_managementgroup']);
	foreach($AssignedTo as $id=>$value)
	{
		$details=$accounts->read($id);
		$AssignedTo[$id]=$details['account_firstname'].' '.$details['account_lastname'];
	}
	$AssignedTo[$cat[$valeur]['cat_data']['cat_assignedto']]=$AssignedTo[$cat[$valeur]['cat_data']['cat_assignedto']].'|selected';
	return $AssignedTo;
}

//Fonction qui va permettre de lister la liste des clients (Nom de l'entreprise) -  qui ne sont pas en sommeil...
function account_id($db)
{
	$societe = array();
	$table='spid_clients';
	$cat_appname='spid';
	$cols=array('account_id','client_company');
	$where=array();
	$SpidLevel=$GLOBALS['egw_info']['user']['SpidLevel'];
	if($SpidLevel<1)
	{
		$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
		$where=array
		(
			'account_id'	=> array_keys($accounts->memberships($GLOBALS['egw_info']['user']['account_id'])),
		);
	}
	if($SpidLevel==1)
	{
		$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
		$where=array
		(
			'account_id'	=> array_keys($accounts->liste_clients($db,$groupesDuUser)),
			//'account_id'	=> array_keys($accounts->memberships($GLOBALS['egw_info']['user']['account_id'])),
		);
	}
	$where+=array
	(
		'client_sleep'	=> '0',
	);
	$append='order by spid_clients.client_company ASC';

	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	
	foreach($rows as $row)
	{
		$societe[$row['account_id']]=$row['client_company'];
	}
	if(count($rows)==1)
	{
		$societe[key($societe)]=$societe[key($societe)].'|selected';
	}
	
	return $societe;
	
}

//Fonction qui va permettre de lister les utilisateurs demandeur
function ticket_assigned_by($db)
{
	$valeur = (array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0;
	$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
	$AssignedBy=$accounts->members($valeur);
	foreach($AssignedBy as $id=>$value)
	{
		$details=$accounts->read($id);
		$AssignedBy[$id]=$details['account_firstname'].' '.$details['account_lastname'];
	}
	
	if(count($rows)==1)
	{
		$AssignedBy[key($AssignedBy)]=$AssignedBy[key($AssignedBy)].'|selected';
	}
	else
	{
		foreach($AssignedBy as $id=>$value)
		{
			if($id==$GLOBALS['egw_info']['user']['account_id'])
			{
				 $AssignedBy[$id]=$AssignedBy[$id].'|selected';
			}
		}
	}
	return $AssignedBy;
}

function initialize($db){
	$xml='';
	$xml.=ArrayToXML(cat_id($db),'categories');
	$xml.=ArrayToXML(account_id($db),'societes');
	return $xml;
}

function reponse($db)
{
	$reponse = array();
	$table='spid_reponses_standard R left join spid_etats E on R.state_id=E.state_id';
	$cat_appname='spid';
	$cols=array('R.standard_reply_id','R.canned_content','R.close_ticket','E.state_id','E.state_name','E.state_description');
	$where='R.standard_reply_id='.((array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0);
	//$db->Debug=5;
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach($rows as $row)
	{
		$reponse[$row['standard_reply_id ']]=$row;
	}
	return $reponse;
}

function transition($db)
{
	
	$transition = array();
	$table='spid_transitions T,spid_etats E';
	$cat_appname='spid';
	$cols=array('E.state_id','E.state_name');
	$where='T.target_id=E.state_id AND T.source_id='.((array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0);
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach($rows as $row)
	{
		$transition[$row['state_id']]=$row;

	}
	return $transition;
}

function cat_assignedto($db)
{
	$valeur = (array_key_exists('valeur',$_REQUEST)) ? $_REQUEST['valeur'] : 0;
	$accounts =& CreateObject('phpgwapi.accounts',-1,'u');
	$account=$accounts->members($valeur);
	if(!is_array($account))
	{
		$account=array();
	}
	foreach($account as $id=>$value)
	{
		$details=$accounts->read($id);
		$account[$id]=$details['account_firstname'].' '.$details['account_lastname'];
	}
//	_debug_array($account);
	return $account;
}

//Fonction qui va permettre d'ajouter la facture en pièce jointe ainsi que les destinataires, expéditeur + message...
function sendEmail($db)
{
	$client_id = (array_key_exists('id',$_REQUEST)) ? $_REQUEST['id'] : '';
	$facture_number = (array_key_exists('facture',$_REQUEST)) ? $_REQUEST['facture'] : '';
	if(empty($client_id) || empty($facture_number))
	{
		//a faire
		return "KO";
	}
	$infos = array();
	$table='spifina_factures F LEFT JOIN spid_clients S ON S.client_id=F.client_id,spid_clients_relations R,spid_clients C';
	$cat_appname='spid';
	$cols=array
	(
		'R.operation_code',
		'C.client_company as "prestataire"',
		'S.client_company as "client"',
		'S.client_email as "email_client"',
		'C.client_email as "email_prestataire"',
	);
	$where='C.client_id=F.societe_id AND R.societe_id=F.societe_id AND F.client_id='.$client_id.' AND F.facture_number ="'.$facture_number.'"';
	//$db->Debug=5;
	$rows=$db->select($table,$cols,$where,__LINE__,__FILE__,false,$append,$cat_appname);
	foreach($rows as $row)
	{
		$infos[]=$row;
		
	}

	$preferences=& $GLOBALS['egw_info']['user']['preferences']['spid'];
	$message=explode("\n",$preferences['invoice_email']);
	$infos[0]['invoice_email']=implode("<br/>",$message);
	
	$infos[0]['subject']=$infos[0]['prestataire'].' - '.$infos[0]['client']. ' : facture sur les tickets de demande et le suivi';
	
	// $repertoire=EGW_SERVER_ROOT.'/spid/FACTURES/presta_'.$infos[0]['prestataire'].'/'.$infos[0]['operation_code'];
	$repertoire=$GLOBALS['egw_info']['server']['files_dir'].'/spid/presta_'.$infos[0]['prestataire'].'/'.$infos[0]['operation_code'];
	$infos[0]['repertoire']='/tmp';
	$infos[0]['nom_facture']=$facture_number.'.pdf';
	$infos[0]['type']='application/pdf';
	$infos[0]['taille']=filesize($repertoire.'/'.$facture_number.'.pdf');
	exec('cp '.$repertoire.'/'.$facture_number.'.pdf /tmp');
	return $infos;
}
?>