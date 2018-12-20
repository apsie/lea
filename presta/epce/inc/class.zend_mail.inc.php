<?php


class mail_zend
{
	
	public $cat_id_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_contact_prescripteur ;
	public $cat_id_formation ;
	public $cat_id_certification ;
	public $cat_id_employeur;
	public $usager_annee;
	public $compteur_date = 0;
	public $cal_id_rejete=109;
	public $db;
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
	// constructeur 
	function __construct()
	{

	
		
	include('config/config.php');
    $this->db = $db;
				



	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	function mail_zend()
	{
     require_once 'Zend/Loader.php';
	Zend_Loader::registerAutoload();	
$tr = new Zend_Mail_Transport_Sendmail('drenault@apsie.org');
Zend_Mail::setDefaultTransport($tr);
	  $mail = new Zend_Mail();
	  $file = file_get_contents('../doc/form_bilanprest1.xls');
$at = $mail->createAttachment($file);
$at->type        = 'application/vnd.ms-excel';
$at->filename = 'form_bilanprest.xls'; 
$file2 = file_get_contents('../doc/BILAN_PRADIER.doc');
$at2 = $mail->createAttachment($file2);
$at2->type        = 'application/msword';
$at2->filename = 'BILAN_PRADIER Valerie_3204372.rtf';

      $mail->setBodyText('Mail automatique');
      $mail->setFrom('qualite@apsie.org', 'Qualite');
	  $mail->addTo('bilans-prestation.061@poleemploi.extelia.fr', 'bilans-prestation.061@poleemploi.extelia.fr');
	  $mail->addTo('drenault@apsie.org', 'Renault Dolyveen');
	   $mail->addTo('dolyveen_renault@hotmail.com', 'Renault Dolyveen');
      $mail->setSubject('BILAN_PRADIER (test7)');
      $mail->send();
	  echo'test';
	
	
		/*$requete = ' Select * from '.$this->table_validation.' where id_presta='.$id_presta.'';
		$result=$this->db->fetchRow($requete);
		return array($result['plan'],$result['coherence'],$result['commerciaux'],$result['financier'],$result['juridique']);
		
	*/
	
	}
	
	function _destruct()
	{
	mysql_close($this->db);
	

	
	}
	
}
?>