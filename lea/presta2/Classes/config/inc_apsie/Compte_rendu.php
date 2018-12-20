<?php
require_once(realpath(dirname(__FILE__)) . '/Employee.php');
require_once(realpath(dirname(__FILE__)) . '/Categorie.php');
require_once(realpath(dirname(__FILE__)) . '/Calendrier.php');
require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
require_once(realpath(dirname(__FILE__)) . '/Contact.php');
require_once(realpath(dirname(__FILE__)) . '/Projet.php');
include('config/config.php');
/**
 * @access public
 */
class Compte_rendu {
	
	
	public $table_contact = 'egw_contact';
	public $table_parcours_pro = 'egw_contact_parcours_pro';
	public $table_etat_civil = 'egw_contact_etat_civil';
	public $table_projet = 'egw_projet';
	public $table_dispositif = 'egw_dispositif';
	public $table_cal_dates = 'egw_cal_dates';
	public $table_cal_user= 'egw_cal_user';
	public $table_cal= 'egw_cal';
	public $table_prestation = 'egw_prestation';
	public $table_formation = 'egw_contact_formation';
	public $table_organisation = 'egw_organisation';
	public $table_projet_organisation ='egw_resacc';
	public $table_validation ='egw_epce_validation';
	public $table_accounts ='egw_accounts';
	public $table_compte_rendu ='egw_compte_rendu';
	public $table_theme_aborde ='egw_compte_rendu_theme_aborde';
	public $table_action = 'egw_compte_rendu_action';
	
	/**
	 * @AssociationType Prestation
	 */
	//public $a_Prestation;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param nom
	 * @param valeur
	 * @ParamType nom 
	 * @ParamType valeur 
	 */
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
	 function get_header()
	 {
		 $cal=Calendrier::get_date_by_id($_GET['cal_id']);
		 $presta=Prestation::get_prestation($_GET['id_presta']);
		  $contact=Contact::get_contact($_GET['id_ben']);
		  $employee=Employee::get_employee($presta['id_ref']);
		  $projet=Projet::get_projet($_GET['id_ben']);
	echo'<div class="header_cp"><div style="float:left; width:20%">
 <img style="width:200px;"  src="images/logo_apsie.png" /></div><div style="float:left;width:27%; margin-left:50px;"> <table><tr><td width="110">Bénéficiaire</td><td width="175"> <strong>'.$contact[0].' '.$contact[1].'</strong></td></tr><tr><td>Prestation </td><td><strong>'.$presta['presta'].'</strong></td></tr><tr>
   <td>R&eacute;f&eacute;rent</td>
   <td><strong>'.$employee[0].' '.$employee[1].'</strong></td></tr><tr><td>Compte rendu du </td><td><strong>'.Calendrier::get_date_by_tsp($cal['cal_start']).'</strong></td></tr></table>
</div><div style="float:left;width:45%; margin-left:5px; v"><h3><img src="./images/lumiere.png" />'.$projet['description_projet'].'</h3></div></div>';

}
function get_rdv_precedent()
{
	if(isset($_GET['id_projet']) and isset($_GET['id_presta']) and $this->get_nb_compte_rendu($_GET['id_projet'], $_GET['id_presta'])!=0)
	{
	$action_pre=$this->return_action_precedente();
	
	echo'Actions planifiées lors du RDV précédent : <br/><br/>
<table style="border:1px solid #CCC;"><tr style="font-size:12px; font-weight:bolder;color:#FFF " align="center" bgcolor="#FDCE6F">
<td width="180px">Thèmes</td><td width="180px"><strong>Demarches/actions pr&eacute;vues&nbsp;:</strong></td> <td width="180px">A faire par</td>
<td width="180px">Objectif :</td>
<td width="180px">Résultat :</td><td width="180px">Observation :</td></tr>';
for($i=0;$i<count($action_pre);$i++)
{
echo'<tr style="width:1080px; background-color:#FFF">
<td width="180px" ><input type="hidden" value="'.$action_pre[$i]['description'].'" name="id_pre_desc_'.$i.'" /><input type="hidden" value="'.$action_pre[$i]['id_compte_rendu'].'" name="id_pre_compte_rendu_'.$i.'" />'.$action_pre[$i]['theme'].'
 </td><td width="180px"  >'.$action_pre[$i]['description'].'</td>
  <td width="180px" >'.$action_pre[$i]['attribue_a'].'</td>
  <td width="180px" >'.$action_pre[$i]['objectif'].'</td><td width="180px" ><textarea name="resultat_'.$i.'" cols="20" rows="4">'.$action_pre[$i]['resultat'].'</textarea></td><td width="180px" ><textarea name="observation_'.$i.'" cols="20" rows="4">'.$action_pre[$i]['observation'].'</textarea></td>
</tr>
';
}
echo'</table>';
	}
	else
	{}

}
function return_action_precedente()
{
	$requete='select * from egw_compte_rendu_action where id_compte_rendu='.$this->get_id_compte_rendu($_GET['id_projet'], $_GET['id_presta']);
	
	return $GLOBALS['db']->fetchAll($requete);
	
}
	function inserer_compte_rendu($presentation_projet,$etat_avancement_projet,$id_rdv,$id_projet, $id_presta, $id_ben, $id_owner, $documents_elabores, $liens_web, $supports)
	{		
	
	
	if(isset($_GET['id_pre_compte_rendu_1']))
	{
	$data2 = array('resultat' => $_GET['resultat_1'] , 'observation'=> $_GET['observation_1']);
	$where2[]='id_compte_rendu='.$_GET['id_pre_compte_rendu_1'];
	$where2[]='description="'.$_GET['id_pre_desc_1'].'"';
	$GLOBALS['db']->update('egw_compte_rendu_action',$data2,$where2);
	}
	if(isset($_GET['id_pre_compte_rendu_2']))
	{
	$data3 = array('resultat' => $_GET['resultat_2'] , 'observation'=> $_GET['observation_2']);
	$where3[]='id_compte_rendu='.$_GET['id_pre_compte_rendu_2'];
	$where3[]='description="'.$_GET['id_pre_desc_2'].'"';
	$GLOBALS['db']->update('egw_compte_rendu_action',$data3,$where3);
	}
	if(isset($_GET['id_pre_compte_rendu_3']))
	{
	$data4 = array('resultat' => $_GET['resultat_3'] , 'observation'=> $_GET['observation_3']);
	$where4[]='id_compte_rendu='.$_GET['id_pre_compte_rendu_3'];
	$where4[]='description="'.$_GET['id_pre_desc_3'].'"';
	$GLOBALS['db']->update('egw_compte_rendu_action',$data4,$where4);
	
	}
	if(isset($_GET['id_pre_compte_rendu_0']))
	{
	$data = array('resultat' => $_GET['resultat_0'] , 'observation'=> $_GET['observation_0']);
	$where[]='id_compte_rendu='.$_GET['id_pre_compte_rendu_0'];
	$where[]='description="'.$_GET['id_pre_desc_0'].'"';
	$GLOBALS['db']->update('egw_compte_rendu_action',$data,$where);
	}
	
	$data = array('cal_id' => $id_rdv,'id_owner' => $id_owner, 'date_creation' => time(), 'id_projet' => $id_projet, 'id_presta' => $id_presta,'presentation_projet'=> $presentation_projet,'etat_avancement'=> $etat_avancement_projet, 'id_ben' => $id_ben, 'documents_elabores' => $documents_elabores,'liens_web' => $liens_web,'supports_communiques' => $supports );
				
	$GLOBALS['db']->insert($this->table_compte_rendu,$data);
	}
	
	/**
	 * @access public
	 */
	 
	 function get_nb_compte_rendu($id_projet, $id_presta)
	{
		$requete='SELECT id_compte_rendu FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.'';
		$result=$GLOBALS['db']->fetchAll($requete);
		return count($result);
	}
	 
	  function get_nb_compte_rendu_by_id_compte_rendu($id_projet, $id_presta,$id_compte_rendu)
	{
		$requete='SELECT id_compte_rendu FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.' order by id_compte_rendu asc';
		$result=$GLOBALS['db']->fetchRow($requete);
		if($result['id_compte_rendu']==$id_compte_rendu)
		{
		return true;
		}
				else
				{return false;}
	}
	
	 /**
	 * @access public
	 */
	function get_id_compte_rendu($id_projet, $id_presta)
	{
		$requete='SELECT id_compte_rendu FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.' order by id_compte_rendu desc  limit 1 ';
		$result=$GLOBALS['db']->fetchRow($requete);
		
		return $result['id_compte_rendu'];
	}
	function get_presentation($id_projet, $id_presta)
	{
		
		if($id_presta!=NULL and $id_projet!=NULL)
		   {
		$requete='SELECT presentation_projet FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.' order by id_compte_rendu desc  limit 1 ';
		
		$result=$GLOBALS['db']->fetchRow($requete);
		return $result['presentation_projet'];
		   }
	}
	
	
	function get_id_projet($id_presta)
	{
		$requete='SELECT id_projet FROM egw_prestation where id_presta ='.$id_presta.' limit 1 ';
		
		$result=$GLOBALS['db']->fetchRow($requete);
		return $result['id_projet'];
	}
	/**
	 * @access public
	 */
	function get_id_compte_rendu_prec($id_projet, $id_presta)
	{
		$requete='SELECT id_compte_rendu FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.' ORDER BY id_compte_rendu DESC LIMIT 2  ';
		$result=$GLOBALS['db']->fetchAll($requete);
		for($i=0;$i<count($result);$i++)
		{
			 $result[$i]['id_compte_rendu'];
		}
		return $result[1]['id_compte_rendu'];
	}
		
		function get_id_compte_rendu_prec_by_id_compte_rendu($id_projet, $id_presta,$id_compte_rendu='')
	{
		$requete='SELECT id_compte_rendu FROM egw_compte_rendu where id_projet ='.$id_projet.' and id_presta ='.$id_presta.' order by id_compte_rendu desc';
		$result=$GLOBALS['db']->fetchAll($requete);
		
		for($i=0;$i<count($result);$i++)
		{
			if(($result[$i]['id_compte_rendu'])<$id_compte_rendu)
			{
				return $result[$i]['id_compte_rendu'];
				break;
			}
		}
	}
	
	
	
	/**
	 * @access public
	 */
	function inserer_compte_rendu_theme_aborde($id_compte_rendu, $theme, $pt_traite, $objectif, $resultat, $observation)
	{		
	$data = array('id_compte_rendu' => $id_compte_rendu, 'theme' => $theme, 'pt_traite' => $pt_traite, 'objectif' => $objectif, 'resultat' => $resultat, 'observation' => $observation);
				
	$GLOBALS['db']->insert($this->table_theme_aborde,$data);
	}
	/**
	 * @access public
	 */
	function inserer_compte_rendu_action($id_compte_rendu, $theme, $description, $attribue_a, $objectif, $resultat, $observation)
	{		
	$data = array('id_compte_rendu' => $id_compte_rendu, 'theme' => $theme, 'description' => $description, 'attribue_a' => $attribue_a, 'objectif' => $objectif, 'resultat' => $resultat, 'observation' => $observation);
				
	$GLOBALS['db']->insert($this->table_action,$data);
	}	


	/**
	 * @access public
	 */
	public function get_dernier_rdv() {
		// Not yet implemented
	}
	/**
	 * @access public
	 */
	function imprimer_compte_rendu_premier($id_employee,$id_compte_rendu, $nom_beneficiaire,$prenom_beneficiaire,$nom_complet,$agence,$prestation,$projet,$cal_start)
{
   //Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =COMPTE_RENDU_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');



//Ouvre le fichier modèle
$filename='./doc/premier_compte_rendu.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//**********
$output = str_replace('<<NOM_COMPLET>>',$nom_complet, $output);

//**********



//conseiller
$employee=Employee::get_employee($id_employee);
$output = str_replace('<<CONSEILLER>>',$employee[0].' '.$employee[1], $output);
//
$requete='SELECT presentation_projet from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
$output = str_replace('<<presentation_projet>>',$result['presentation_projet'], $output);
//
$output = str_replace('<<AGENCE>>',$agence, $output);
$output = str_replace('<<PRESTATION>>',$prestation, $output);
$output = str_replace('<<PROJET>>',$projet, $output);
$output = str_replace('<<DATE>>',date('d/m/Y',$cal_start), $output);
$output = str_replace('<<DATE_JOUR>>',date('d/m/Y'), $output);

//**********

//**********
	
	$requete='SELECT distinct theme FROM egw_compte_rendu_theme_aborde where id_compte_rendu like '.$id_compte_rendu.'';

	$result=$GLOBALS['db']->fetchAll($requete);

	
	for($i=0;$i<count($result);$i++)
		{
						
$output = str_replace('<<POINT_ABORDE_1>>',$result[0]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_2>>',$result[1]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_3>>',$result[2]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_4>>',$result[3]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_5>>',$result[4]['theme'], $output);

		}
//*****Actions planifiées lors du precedent RDV *****



	
		
$requete='SELECT * from egw_compte_rendu_theme_aborde where id_compte_rendu ='.$id_compte_rendu.' order by id asc';

	$result=$GLOBALS['db']->fetchAll($requete);

	
	for($i=0;$i<count($result);$i++)
		{
$output = str_replace('<<THEME_PT_1>>',$result[0]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_1>>',$result[0]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_1>>',$result[0]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_1>>',$result[0]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_1>>',$result[0]['observation'], $output);

$output = str_replace('<<THEME_PT_2>>',$result[1]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_2>>',$result[1]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_2>>',$result[1]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_2>>',$result[1]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_2>>',$result[1]['observation'], $output);

$output = str_replace('<<THEME_PT_3>>',$result[2]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_3>>',$result[2]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_3>>',$result[2]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_3>>',$result[2]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_3>>',$result[2]['observation'], $output);

$output = str_replace('<<THEME_PT_4>>',$result[3]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_4>>',$result[3]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_4>>',$result[3]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_4>>',$result[3]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_4>>',$result[3]['observation'], $output);
			}

//*****Actions à réaliser pour le prochain RV :*****


$requete='SELECT * from egw_compte_rendu_action where id_compte_rendu ='.$id_compte_rendu.' order by id asc';

	$result=$GLOBALS['db']->fetchAll($requete);

	
	for($i=0;$i<count($result);$i++)
		{
			
$output = str_replace('<<THEME_AC_1>>',$result[0]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_1>>',$result[0]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_1>>',$result[0]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_1>>',$result[0]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_1>>',$result[0]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_1>>',$result[0]['observation'], $output);

$output = str_replace('<<THEME_AC_2>>',$result[1]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_2>>',$result[1]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_2>>',$result[1]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_2>>',$result[1]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_2>>',$result[1]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_2>>',$result[1]['observation'], $output);

$output = str_replace('<<THEME_AC_3>>',$result[2]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_3>>',$result[2]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_3>>',$result[2]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_3>>',$result[2]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_3>>',$result[2]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_3>>',$result[2]['observation'], $output);

$output = str_replace('<<THEME_AC_4>>',$result[3]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_4>>',$result[3]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_4>>',$result[3]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_4>>',$result[3]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_4>>',$result[3]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_4>>',$result[3]['observation'], $output);
		}
	
//*****Documents élaborés au cours de la séance  :*****

	$requete='SELECT documents_elabores from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
		
			$doc_elab=explode(",", $result['documents_elabores']);
	for ($i=0; $i<count($doc_elab); $i++)
		{
$output = str_replace('<<DOCUMENTS_ELABORES_'.($i+1).'>>',$doc_elab[$i], $output);			
		}

//*****supports communiqués au cours de la séance  :*****


$requete='SELECT supports_communiques from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
								
			$support=explode(",", $result['supports_communiques']);
	for ($i=0; $i<count($support); $i++)
		{		
$output = str_replace('<<SUPPORT_'.($i+1).'>>',$support[$i], $output);
		}

//*****Liens web communiqués :*****
	$requete='SELECT liens_web from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
								
			$liens=explode(",", $result['liens_web']);
	for ($i=0; $i<count($liens); $i++)
		{
				
$output = str_replace('<<LIENS_WEB_'.($i+1).'>>',$liens[$i], $output);
		}	


//Envoie le document produit au navigateur
echo $output;
}

function imprimer_totalite_premier($id_employee,$id_ben, $id_projet, $id_presta,$id_compte_rendu)

	{	
	$requete='SELECT civilite, nom_complet, nom, prenom FROM  egw_contact  where id_ben='.$id_ben.'';
	$result=$GLOBALS['db']->fetchRow($requete);

	
	
			$nom_beneficiaire=$result['nom'];
			$prenom_beneficiaire=$result['prenom'];
			$nom_complet=$result['nom_complet'];
	
		
	$requete='SELECT presta FROM  egw_prestation  where id_presta='.$id_presta.'';
	$result=$GLOBALS['db']->fetchRow($requete);

	

			$prestation=$result['presta'];
			
		
	
	$requete='SELECT description_projet FROM  egw_projet  where id_projet='.$id_projet.'';
	$result=$GLOBALS['db']->fetchRow($requete);

		
		$projet=$result['description_projet'];
		
		$requete='SELECT cal_id FROM  egw_compte_rendu  where id_compte_rendu='.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);

		
		$cat=Categorie::get_cat_by_cal_id($result['cal_id']);
		$cal=Calendrier::get_date_by_id($result['cal_id']);
		$agence=explode('_',$cat['cat_name']);
		
		
		
	
	
	$this->imprimer_compte_rendu_premier($id_employee,$id_compte_rendu, $nom_beneficiaire, $prenom_beneficiaire, $nom_complet,'Apsie '.$agence[2], $prestation, $projet,$cal['cal_start']);			
		
	}


	/**
	 * @access public
	 */
	function imprimer_compte_rendu_milieu($id_employee,$id_compte_rendu, $id_compte_rendu_prec, $nom_beneficiaire,$prenom_beneficiaire,$nom_complet,$agence,$prestation,$projet,$cal_start)
{
   //Production d'en-têtes pour aider le navigateur à choisir la bonne application
header('Content-type: application/msword');
header('Content-disposition: inline, filename =COMPTE_RENDU_'.$nom_beneficiaire.'_'.$prenom_beneficiaire.'.doc');



//Ouvre le fichier modèle
$filename='./doc/compte_rendu_milieu.rtf';
$fp=fopen($filename, 'r+');

//Stocke le modèle dans une variable
$output=fread($fp, filesize($filename));

fclose($fp);

//Remplace les marqueurs du modèle par nos données

//**********
$output = str_replace('<<NOM_COMPLET>>',$nom_complet, $output);
//conseiller
$employee=Employee::get_employee($id_employee);
$output = str_replace('<<CONSEILLER>>',$employee[0].' '.$employee[1], $output);
//
$requete='SELECT etat_avancement,presentation_projet from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
$output = str_replace('<<presentation_projet>>',$result['presentation_projet'], $output);
$output = str_replace('<<etat_avancement>>',$result['etat_avancement'], $output);
//
//**********

$output = str_replace('<<AGENCE>>',$agence, $output);
$output = str_replace('<<PRESTATION>>',$prestation, $output);
$output = str_replace('<<PROJET>>',$projet, $output);
$output = str_replace('<<DATE>>',date('d/m/Y',$cal_start), $output);
$output = str_replace('<<DATE_JOUR>>',date('d/m/Y'), $output);

//**********

//**********
	
	$requete='SELECT distinct theme FROM egw_compte_rendu_theme_aborde where id_compte_rendu like '.$id_compte_rendu.'';

	$result=$GLOBALS['db']->fetchAll($requete);

	
	for($i=0;$i<count($result);$i++)
		{
						
$output = str_replace('<<POINT_ABORDE_1>>',$result[0]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_2>>',$result[1]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_3>>',$result[2]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_4>>',$result[2]['theme'], $output);
$output = str_replace('<<POINT_ABORDE_5>>',$result[2]['theme'], $output);
		}
//*****Actions planifiées lors du precedent RDV *****



	$requete2='SELECT * from egw_compte_rendu_action where id_compte_rendu = '.$id_compte_rendu_prec.' order by id asc  ';

	$result2=$GLOBALS['db']->fetchAll($requete2);

	
	for($i=0;$i<count($result);$i++)
		{
$output = str_replace('<<THEME_1>>',$result2[0]['theme'], $output);
$output = str_replace('<<DESCRIPTION_1>>',$result2[0]['description'], $output);
$output = str_replace('<<ATTRIBUE_A_1>>',$result2[0]['attribue_a'], $output);
$output = str_replace('<<OBJECTIF_1>>',$result2[0]['objectif'], $output);
$output = str_replace('<<RESULTAT_1>>',$result2[0]['resultat'], $output);
$output = str_replace('<<OBSERVATION_1>>',$result2[0]['observation'], $output);

$output = str_replace('<<THEME_2>>',$result2[1]['theme'], $output);
$output = str_replace('<<DESCRIPTION_2>>',$result2[1]['description'], $output);
$output = str_replace('<<ATTRIBUE_A_2>>',$result2[1]['attribue_a'], $output);
$output = str_replace('<<OBJECTIF_2>>',$result2[1]['objectif'], $output);
$output = str_replace('<<RESULTAT_2>>',$result2[1]['resultat'], $output);
$output = str_replace('<<OBSERVATION_2>>',$result2[1]['observation'], $output);

$output = str_replace('<<THEME_3>>',$result2[2]['theme'], $output);
$output = str_replace('<<DESCRIPTION_3>>',$result2[2]['description'], $output);
$output = str_replace('<<ATTRIBUE_A_3>>',$result2[2]['attribue_a'], $output);
$output = str_replace('<<OBJECTIF_3>>',$result2[2]['objectif'], $output);
$output = str_replace('<<RESULTAT_3>>',$result2[2]['resultat'], $output);
$output = str_replace('<<OBSERVATION_3>>',$result2[2]['observation'], $output);

$output = str_replace('<<THEME_4>>',$result2[3]['theme'], $output);
$output = str_replace('<<DESCRIPTION_4>>',$result2[3]['description'], $output);
$output = str_replace('<<ATTRIBUE_A_4>>',$result2[3]['attribue_a'], $output);
$output = str_replace('<<OBJECTIF_4>>',$result2[3]['objectif'], $output);
$output = str_replace('<<RESULTAT_4>>',$result2[3]['resultat'], $output);
$output = str_replace('<<OBSERVATION_4>>',$result2[3]['observation'], $output);
		}
		
$requete3='SELECT * from egw_compte_rendu_theme_aborde where id_compte_rendu ='.$id_compte_rendu.' order by id asc';

	$result3=$GLOBALS['db']->fetchAll($requete3);

	
	for($i=0;$i<count($result);$i++)
		{
$output = str_replace('<<THEME_PT_1>>',$result3[0]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_1>>',$result3[0]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_1>>',$result3[0]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_1>>',$result3[0]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_1>>',$result3[0]['observation'], $output);

$output = str_replace('<<THEME_PT_2>>',$result3[1]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_2>>',$result3[1]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_2>>',$result3[1]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_2>>',$result3[1]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_2>>',$result3[1]['observation'], $output);

$output = str_replace('<<THEME_PT_3>>',$result3[2]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_3>>',$result3[2]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_3>>',$result3[2]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_3>>',$result3[2]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_3>>',$result3[2]['observation'], $output);

$output = str_replace('<<THEME_PT_4>>',$result3[3]['theme'], $output);
$output = str_replace('<<THEME_POINT_TRAITE_4>>',$result3[3]['pt_traite'], $output);
$output = str_replace('<<THEME_OBJECTIF_4>>',$result3[3]['objectif'], $output);
$output = str_replace('<<THEME_RESULTAT_4>>',$result3[3]['resultat'], $output);
$output = str_replace('<<THEME_OBSERVATION_4>>',$result3[3]['observation'], $output);
			}

//*****Actions à réaliser pour le prochain RV :*****


$requete4='SELECT * from egw_compte_rendu_action where id_compte_rendu ='.$id_compte_rendu.' order by id asc';

	$result4=$GLOBALS['db']->fetchAll($requete4);

	
	for($i=0;$i<count($result4);$i++)
		{
			
$output = str_replace('<<THEME_AC_1>>',$result4[0]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_1>>',$result4[0]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_1>>',$result4[0]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_1>>',$result4[0]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_1>>',$result4[0]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_1>>',$result4[0]['observation'], $output);

$output = str_replace('<<THEME_AC_2>>',$result4[1]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_2>>',$result4[1]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_2>>',$result4[1]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_2>>',$result4[1]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_2>>',$result4[1]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_2>>',$result4[1]['observation'], $output);

$output = str_replace('<<THEME_AC_3>>',$result4[2]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_3>>',$result4[2]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_3>>',$result4[2]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_3>>',$result4[2]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_3>>',$result4[2]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_3>>',$result4[2]['observation'], $output);

$output = str_replace('<<THEME_AC_4>>',$result4[3]['theme'], $output);
$output = str_replace('<<ACTION_DESCRIPTION_4>>',$result4[3]['description'], $output);
$output = str_replace('<<ACTION_ATTRIBUE_A_4>>',$result4[3]['attribue_a'], $output);
$output = str_replace('<<ACTION_OBJECTIF_4>>',$result4[3]['objectif'], $output);
$output = str_replace('<<ACTION_RESULTAT_4>>',$result4[3]['resultat'], $output);
$output = str_replace('<<ACTION_OBSERVATION_4>>',$result4[3]['observation'], $output);
		}
	
//*****Documents élaborés au cours de la séance  :*****

	$requete='SELECT documents_elabores from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
		
			$doc_elab=explode(",", $result['documents_elabores']);
	for ($i=0; $i<count($doc_elab); $i++)
		{
$output = str_replace('<<DOCUMENTS_ELABORES_'.($i+1).'>>',$doc_elab[$i], $output);			
		}

//*****supports communiqués au cours de la séance  :*****

$requete='SELECT supports_communiques from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
								
			$support=explode(",", $result['supports_communiques']);
	for ($i=0; $i<count($support); $i++)
		{		
$output = str_replace('<<SUPPORT_'.($i+1).'>>',$support[$i], $output);
		}

//*****Liens web communiqués :*****
	$requete='SELECT liens_web from egw_compte_rendu where id_compte_rendu = '.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);
								
			$liens=explode(",", $result['liens_web']);
	for ($i=0; $i<count($liens); $i++)
		{
				
$output = str_replace('<<LIENS_WEB_'.($i+1).'>>',$liens[$i], $output);
		}	


//Envoie le document produit au navigateur
echo $output;
}

function imprimer_totalite_milieu($id_employee,$id_ben, $id_projet, $id_presta,$id_compte_rendu, $id_compte_rendu_prec)

	{	
	$requete='SELECT civilite, nom_complet, nom, prenom FROM  egw_contact  where id_ben='.$id_ben.'';
	$result=$GLOBALS['db']->fetchRow($requete);

			
			$nom_beneficiaire=$result['nom'];
			$prenom_beneficiaire=$result['prenom'];
			$nom_complet=$result['nom_complet'];
		
		
	$requete='SELECT presta FROM  egw_prestation  where id_presta='.$id_presta.'';
	$result=$GLOBALS['db']->fetchRow($requete);

	
			
			$prestation=$result['presta'];
			
		
	
	$requete='SELECT description_projet FROM  egw_projet  where id_projet='.$id_projet.'';
	$result=$GLOBALS['db']->fetchRow($requete);

	
		
		$projet=$result['description_projet'];
		
	
	
	$requete='SELECT cal_id FROM  egw_compte_rendu  where id_compte_rendu='.$id_compte_rendu.'';
	$result=$GLOBALS['db']->fetchRow($requete);

		
		$cat=Categorie::get_cat_by_cal_id($result['cal_id']);
		$cal=Calendrier::get_date_by_id($result['cal_id']);
		$agence=explode('_',$cat['cat_name']);
		
	$this->imprimer_compte_rendu_milieu($id_employee,$id_compte_rendu, $id_compte_rendu_prec, $nom_beneficiaire, $prenom_beneficiaire, $nom_complet,'Apsie '.$agence[2], $prestation, $projet,$cal['cal_start']);			
		
	}


	/**
	 * @access public
	 */
	public function __destruct() {
		// Not yet implemented
	}
}
?>