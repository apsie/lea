<?php
 
class epce
{
	public $cat_id_owner ;
	//public $lid_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_employeur;
	public $usager_annee;

public $db_user ="lea";
	public $db_pass ="123456";
	public $db_host ="localhost";
	public $db_name ="lea";

	
	public $db;
/*public $db_host ="localhost";
	public $db_name ="lea";
	public $db_user ="root";
	public $db_pass ="Tim.01Mysqlv1";*/

public $compteur_date = 0;
	
	// constructeur 
	function __construct($annee)
	{
		
		//session_start();
	/*	if($annee!=NULL)
		{
				$this->usager_annee = $annee;
		}*/
		
			
	/*	 	
$db_host = $egw_info["server"]["db_host"] ; 
$db_name = $egw_info["server"]["db_name"] ;
$db_user = $egw_info["server"]["db_user"] ; 
$db_pass = $egw_info["server"]["db_pass"] ; */

// on se connecte à MySQL
$this->db = mysql_connect(''.$this->db_host.'', ''.$this->db_user.'', ''.$this->db_pass.'');

// on sélectionne la base
mysql_select_db(''.$this->db_name.'',$this->db); 
  
  

	$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="Usager_'.$annee.'"';
	
   //echo $requete;
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_beneficiaire=$row['cat_id'];	
	}

    $requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="PRESCRIPTEURS"';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_prescripteur=$row['cat_id'];	
	}
		
		$requete='SELECT cat_id FROM  egw_categories  WHERE cat_name="EMPLOYEURS"';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_employeur=$row['cat_id'];	
	}
	
	
	if($this->cat_id_owner==NULL)
	{
	$this->cat_id_owner=13;
	}
/*	$requete='SELECT * FROM  egw_accounts order by account_id asc limit 5';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_owner=$row['account_id'];	
	
	
	
	}
	
	$requete='SELECT * FROM  egw_accounts  where account_lid='.$lid_owner.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$this->cat_id_owner=$row['account_id'];	
	
	
	
	}*/
	
	
	}
	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	
	function inserer_beneficiaire_extra($contact_id,$cat_owner,$intitule,$valeur)
	
	{
		$requete = 'insert into egw_addressbook_extra values("'.$contact_id.'","'.$this->cat_id_owner.'","'.$intitule.'","'.$valeur.'")';
	

	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}
	
	function verif_ben($nom,$prenom)
	{
	
	$requete2='SELECT id FROM  egw_addressbook where n_family="'.$nom.'" and n_given="'.$prenom.'"';
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat2)){
	$id=$row['id'];
	return $id;
	}
	
	}
	
	function inserer_beneficiaire($id,$lid,$tid,$owner,$private,$cat_id,$fn,$n_family,$n_given,$n_middle,$n_prefix,$n_suffix,$sound,$bday,$note,$tz,$geo,$url,$pubkey,$org_name,$org_unit,$title,$adr_one_street,$adr_one_locality,$adr_one_region,$adr_one_postalcode,$adr_one_countryname,$adr_one_type,$label,$adr_two_street,$adr_two_locality,$adr_two_region,$adr_two_postalcode,$adr_two_countryname,$adr_two_type,$tel_work,$tel_home,$tel_voice,$tel_fax,$tel_msg,$tel_cell,$tel_pager,$tel_bbs,$tel_modem,$tel_car,$tel_isdn,$tel_video,$tel_prefer,$email,$email_type,$email_home,$email_home_type,$last_mod,$niveau_formation,$intitule_formation,$niveau_formation_projet,$intitule_formation_projet,$date_debut_projet,$date_fin_poste,$poste,$qualification,$type_contrat,$contrat_aide,$siret,$date_immat,$form_juri,$capital,$code_safir,$statut_formation1,$statut_formation2,$date_formation1,$date_formation2,$cote_formation1,$cote_formation2)
	{
	
		$immat=explode("/",$date_immat);
		if(is_numeric($form_juri))
	$form_juri=$this->texte_id($form_juri); 

 $im=mktime(0,0,0,$immat[1],$immat[0],$immat[2]);
 	$date_formation1=explode("/",$date_formation1);
	
 $date_formation1=mktime(0,0,0,$date_formation1[1],$date_formation1[0],$date_formation1[2]);
 
 	$date_formation2=explode("/",$date_formation2);
	
 $date_formation2=mktime(0,0,0,$date_formation2[1],$date_formation2[0],$date_formation2[2]);
 
 	if(is_numeric($form_juri))
	$form_juri=$this->texte_id($form_juri);	
	
		if(is_numeric($label))
	$label=$this->texte_id($label); 
		if(is_numeric($tel_pager))
	$tel_pager=$this->texte_id($tel_pager);
		if(is_numeric($tel_bbs))
	$tel_bbs=$this->texte_id($tel_bbs);
		if(is_numeric($tel_modem))
	$tel_modem=$this->texte_id($tel_modem);
		if(is_numeric($tel_car))
	$tel_car=$this->texte_id($tel_car);
		if(is_numeric($tel_video))
	$tel_video=$this->texte_id($tel_video);
	if(is_numeric($tel_prefer))
	$tel_prefer=$this->texte_id($tel_prefer);
	if(is_numeric($adr_two_type))
	$adr_two_type=$this->texte_id($adr_two_type);
		if(is_numeric($niveau_formation))
	$niveau_formation=$this->texte_id($niveau_formation);
		if(is_numeric($intitule_formation))
	$intitule_formation=$this->texte_id($intitule_formation);
		if(is_numeric($niveau_formation_projet))
	$niveau_formation_projet=$this->texte_id($niveau_formation_projet);
		if(is_numeric($intitule_formation_projet))
	$intitule_formation_projet=$this->texte_id($intitule_formation_projet);

$intitule_formation_projet=addslashes($intitule_formation_projet);

$intitule_formation=addslashes($intitule_formation);
$intitule_formation_projet=addslashes($intitule_formation_projet);
$adr_two_street=addslashes($adr_two_street);
$adr_one_street=addslashes($adr_one_street);
$tel_video=addslashes($tel_video);
$tel_car=addslashes($tel_car);
$title=addslashes($title);
$org_unit=addslashes($org_unit);
 

	//requête d'insertion
	$requete = "insert into egw_addressbook values(NULL,NULL,'$tid','$owner','$private','$cat_id','$fn','$n_family','$n_given','$n_middle','$n_prefix','$n_suffix',NULL,'$bday',NULL,'$tz','$geo','$url','$pubkey','$org_name','$org_unit','$title','$adr_one_street','$adr_one_locality','$adr_one_region','$adr_one_postalcode','$adr_one_countryname','$adr_one_type','$label','$adr_two_street','$adr_two_locality','$adr_two_region','$adr_two_postalcode','$adr_two_countryname','$adr_two_type','$tel_work','$tel_home','$tel_voice','$tel_fax','$tel_msg','$tel_cell','$tel_pager','$tel_bbs','$tel_modem','$tel_car','$tel_isdn','$tel_video','$tel_prefer','$email','$email_type','$email_home','$email_home_type','$last_mod','$niveau_formation','$intitule_formation','$niveau_formation_projet','$intitule_formation_projet','$date_debut_projet','$date_fin_poste','$poste','$qualification','$type_contrat','$contrat_aide','$siret','$im','$form_juri','$capital','$code_safir','$statut_formation1','$statut_formation2','$date_formation1','$date_formation2','$cote_formation1','$cote_formation2')";
	


	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	$requete2='SELECT id FROM  egw_addressbook where cat_id like "%'.$this->cat_id_beneficiaire.'%" order by id desc limit 1 ';
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	while($row = mysql_fetch_array($resultat2))
	{
	$id=$row['id'];
	}
	
	
	return $id;
	}
	
	function update_employeur($id,$lid,$tid,$owner,$private,$cat_id,$fn,$n_family,$n_given,$n_middle,$n_prefix,$n_suffix,$sound,$bday,$note,$tz,$geo,$url,$pubkey,$org_name,$org_unit,$title,$adr_one_street,$adr_one_locality,$adr_one_region,$adr_one_postalcode,$adr_one_countryname,$adr_one_type,$label,$adr_two_street,$adr_two_locality,$adr_two_region,$adr_two_postalcode,$adr_two_countryname,$adr_two_type,$tel_work,$tel_home,$tel_voice,$tel_fax,$tel_msg,$tel_cell,$tel_pager,$tel_bbs,$tel_modem,$tel_car,$tel_isdn,$tel_video,$tel_prefer,$email,$email_type,$email_home,$email_home_type,$last_mod)
	{
	
		
	



	//requête d'insertion
	$requete = "Update egw_addressbook set access='$private',fn='$fn',n_family='$n_family',n_given='$n_given',n_middle='$n_middle',n_prefix='$n_prefix',n_suffix='$n_suffix',sound='$sound',bday='$bday',note='$note',tz='$tz',geo='$geo',url='$url',pubkey='$pubkey',org_name='$org_name',org_unit='$org_unit',title='$title',adr_one_street='$adr_one_street',adr_one_locality='$adr_one_locality',adr_one_region='$adr_one_region',adr_one_postalcode='$adr_one_postalcode',adr_one_countryname='$adr_one_countryname',adr_two_street='$adr_two_street',adr_two_locality='$adr_two_locality',adr_two_region='$adr_two_region',adr_two_postalcode='$adr_two_postalcode',adr_two_countryname='$adr_two_countryname',adr_two_type='$adr_two_type',adr_one_type='$adr_one_type',tel_work='$tel_work',tel_home='$tel_home',tel_voice='$tel_voice',tel_fax='$tel_fax',tel_msg='$tel_msg',tel_cell='$tel_cell',tel_pager='$tel_pager',tel_bbs='$tel_bbs',tel_modem='$tel_modem',tel_car='$tel_car',tel_isdn='$tel_isdn',tel_video='$tel_video',email='$email',email_home='$email_home'where id=$id";
	
	//$requete2= "UPDATE egw_addressbook SET org_name= '$org_name' WHERE `egw_addressbook`.`id` =10962 LIMIT 1 ;

	
	$resultat = mysql_query($requete) or die(mysql_error());
		
	}
	
	function update_ben($id,$lid,$tid,$owner,$private,$cat_id,$fn,$n_family,$n_given,$n_middle,$n_prefix,$n_suffix,$sound,$bday,$note,$tz,$geo,$url,$pubkey,$org_name,$org_unit,$title,$adr_one_street,$adr_one_locality,$adr_one_region,$adr_one_postalcode,$adr_one_countryname,$adr_one_type,$label,$adr_two_street,$adr_two_locality,$adr_two_region,$adr_two_postalcode,$adr_two_countryname,$adr_two_type,$tel_work,$tel_home,$lettre,$tel_fax,$tel_msg,$tel_cell,$tel_pager,$tel_bbs,$tel_modem,$tel_car,$tel_isdn,$tel_video,$tel_prefer,$email,$email_type,$email_home,$email_home_type,$last_mod,$niveau_formation,$intitule_formation,$niveau_formation_projet,$intitule_formation_projet,$date_debut_epce,$date_fin_epce,$siret,$date_immat,$form_juri,$capital,$statut_formation1,$statut_formation2,$date_formation1,$date_formation2,$cote_formation1,$cote_formation2)
	{
	
	
		$immat=explode("/",$date_immat);
	
 $im=mktime(0,0,0,$immat[1],$immat[0],$immat[2]);
 
 	$date_formation1=explode("/",$date_formation1);
	
 $date_formation1=mktime(0,0,0,$date_formation1[1],$date_formation1[0],$date_formation1[2]);
 
 	$date_formation2=explode("/",$date_formation2);
	
 $date_formation2=mktime(0,0,0,$date_formation2[1],$date_formation2[0],$date_formation2[2]);

		if(is_numeric($form_juri))
	$form_juri=$this->texte_id($form_juri);	
	
		if(is_numeric($label))
	$label=$this->texte_id($label); 
		if(is_numeric($tel_pager))
	$tel_pager=$this->texte_id($tel_pager);
		if(is_numeric($tel_bbs))
	$tel_bbs=$this->texte_id($tel_bbs);
		if(is_numeric($tel_modem))
	$tel_modem=$this->texte_id($tel_modem);
		if(is_numeric($tel_car))
	$tel_car=$this->texte_id($tel_car);
		if(is_numeric($tel_video))
	$tel_video=$this->texte_id($tel_video);
	if(is_numeric($tel_prefer))
	$tel_prefer=$this->texte_id($tel_prefer);
	if(is_numeric($adr_two_type))
	$adr_two_type=$this->texte_id($adr_two_type);
		if(is_numeric($niveau_formation))
	$niveau_formation=$this->texte_id($niveau_formation);
		if(is_numeric($intitule_formation))
	$intitule_formation=$this->texte_id($intitule_formation);
		if(is_numeric($niveau_formation_projet))
	$niveau_formation_projet=$this->texte_id($niveau_formation_projet);
		if(is_numeric($intitule_formation_projet))
	$intitule_formation_projet=$this->texte_id($intitule_formation_projet);

$intitule_formation_projet=addslashes($intitule_formation_projet);

$intitule_formation=addslashes($intitule_formation);
$intitule_formation_projet=addslashes($intitule_formation_projet);
$adr_two_street=addslashes($adr_two_street);
$adr_one_street=addslashes($adr_one_street);
$title=addslashes($title);
$org_unit=addslashes($org_unit);
 
	//requête d'insertion
	$requete = "Update egw_addressbook set fn='$fn',n_family='$n_family',n_given='$n_given',n_middle='$n_middle',n_prefix='$n_prefix',n_suffix='$n_suffix',sound='$sound',bday='$bday',note='$note',tz='$tz',geo='$geo',url='$url',org_name='$org_name',org_unit='$org_unit',title='$title',adr_one_street='$adr_one_street',adr_one_locality='$adr_one_locality',adr_one_region='$adr_one_region',adr_one_postalcode='$adr_one_postalcode',adr_one_countryname='$adr_one_countryname',adr_one_type='$adr_one_type',label='$label',adr_two_street='$adr_two_street',adr_two_locality='$adr_two_locality',adr_two_region='$adr_two_region',adr_two_postalcode='$adr_two_postalcode',adr_two_countryname='$adr_two_countryname',adr_two_type='$adr_two_type',adr_one_type='$adr_one_type',tel_work='$tel_work',tel_home='$tel_home',tel_fax='$tel_fax',tel_msg='$tel_msg',tel_cell='$tel_cell',tel_pager='$tel_pager',tel_bbs='$tel_bbs',tel_modem='$tel_modem',tel_car='$tel_car',tel_isdn='$tel_isdn',tel_video='$tel_video',tel_prefer='$tel_prefer',email='$email',email_home='$email_home', niveau_formation='$niveau_formation' ,intitule_formation='$intitule_formation',niveau_formation_projet='$niveau_formation_projet',intitule_formation_projet='$intitule_formation_projet',siret='$siret',forme_juridique='$form_juri',capital='$capital',date_immat='$im',statut_formation1='$statut_formation1',statut_formation2='$statut_formation2',date_formation1='$date_formation1',date_formation2='$date_formation2',cote_formation1='$cote_formation1',cote_formation2='$cote_formation2'   where id=$id";

	
	//$requete2= "UPDATE egw_addressbook SET org_name= '$org_name' WHERE `egw_addressbook`.`id` =10962 LIMIT 1 ;

	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	if($lettre!=NULL)
	{
	$dat1=explode("/",$date_debut_epce);
	$time1=mktime(0, 0, 0, $dat1[1], $dat1[0], $dat1[2]);
	$dat2=explode("/",$date_fin_epce);
	$time2=mktime(0, 0, 0, $dat2[1], $dat2[0], $dat2[2]);
	
	
	
	$requete3="SELECT id_ben FROM  egw_prestation  WHERE id_ben=$id";
	
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	if(mysql_num_rows($resultat3)==1)
	{
					  
	$requete2 = "Update egw_prestation set  lettre_de_commande='$lettre',date_debut='$time1',date_fin='$time2'  where id_ben=$id";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());
		

	}
	elseif(mysql_num_rows($resultat3)==0)
	{
$prestataire="APSIE";
	//$resultat = $db->query($requete);
	$requete = "insert into egw_prestation value ('','$id','$id_ref','$prestataire','EPCE','$n_family $n_given','$lettre','$time1','$time2','En cours','0')";

	$resultat = mysql_query($requete) or die(mysql_error());
	}
		
	}
	}
	
	
	function liste_categorie()
	{
	
	

	$requete="SELECT * FROM  egw_categories  WHERE cat_id >5";
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	echo '<input type="radio" name="cat" value="'.$row['cat_name'].'" /> '.$row['cat_name'];
	echo "<br />";
	}


	}
	
	function link_new_prescripteur($id_ben,$code_safir,$nom,$prenom,$civilite,$tel_b,$tel_p,$email_b,$email_d,$fonction)
{


	$requete2="SELECT id FROM  egw_addressbook  WHERE code_safir=$code_safir limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_prescripteur=$row['id'];
	
	}



	//requête d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id_ben.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	$requete3 = 'insert into egw_contact_prescripteur value ("","'.$id_ben.'","'.$id_prescripteur.'","","","'.$civilite.'","'.$nom.'","'.$prenom.'","'.$tel_b.'","'.$tel_p.'","'.$email_b.'","'.$email_d.'","'.$fonction.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
}
	function link_beneficiaire_prescripteur($id,$beneficiaire,$prescripteur)
	{
	
	
	
 	
	
	
	/*$requete="SELECT * FROM  egw_addressbook  WHERE cat_id=$beneficiaire order by id desc limit 1";
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$id_beneficiaire=$row['id'];
	
	}
	$_SESSION['id_beneficiaire'] = $id_beneficiaire ;
	$T = $_SESSION['id_beneficiaire'];*/

	$requete2="SELECT * FROM  egw_addressbook  WHERE cat_id=$prescripteur order by id desc limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_prescripteur=$row['id'];
	
	}



	//requête d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}
	function pole_emploi($code_safir)
	{
	
	if(isset($code_safir))
	{
	
	$requete='SELECT * FROM  egw_addressbook  WHERE code_safir='.$code_safir.'';
	
	
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat))
	{
	$org_name=$row['org_name'];
	$email=$row['email'];
	$tel_fax=$row['tel_fax'];
	$tel_work=$row['tel_work'];
	$adr_one_street=$row['adr_one_street'];
	$adr_one_locality=$row['adr_one_locality'];
	$adr_one_postalcode=$row['adr_one_postalcode'];
	
	}


	
	return array($org_name,$tel_work,$tel_fax,$email,$adr_one_street,$adr_one_locality,$adr_one_postalcode);
	}
	else
	{
		return "";}
	

	}
	
	function link_safir($id_ben,$code_safir)
	{
	
	
	
	$requete='SELECT id FROM  egw_addressbook  WHERE code_safir='.$code_safir.'';
	
	
	
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat))
	{
	$id_prescripteur=$row['id'];
	
	}


	//requête d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id_ben.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	return $id_prescripteur;
	
	

	}
	
	function inserer_prescripteur_contact($id_ben,$id_p,$civilite,$nom,$prenom,$tel_bureau,$tel_portable,$email_bureau,$email_domicile,$fonction)
	{
	
	
	$requete='SELECT * FROM  egw_contact_prescripteur  WHERE nom="'.$nom.'" and  id_ben='.$id_ben.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	while($row = mysql_fetch_array($resultat))
	{
	$id_contact=$row['id_contact'];
	
	}
	if(isset($id_contact) and $id_contact!=NULL)
	{
	}
	else
	{
	
	$requete = 'insert into egw_contact_prescripteur value ("","'.$id_ben.'","'.$id_p.'","","","'.$civilite.'","'.$nom.'","'.$prenom.'","'.$tel_bureau.'","'.$tel_portable.'","'.$email_bureau.'","'.$email_domicile.'","'.$fonction.'")';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	}
	
	function ajout_prescripteur($id_beneficiaire,$id_prescripteur)
	{
	
	
	



	//requête d'insertion
	$requete3 = 'insert into egw_links value ("","addressbook","'.$id_beneficiaire.'","addressbook","'.$id_prescripteur.'","","","'.$this->cat_id_owner.'")';
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}
	
	function link_beneficiaire_employeur($id,$beneficiaire,$employeur)
	{
	
	


 	
	

	$requete2="SELECT * FROM  egw_addressbook  WHERE cat_id=$employeur order by id desc limit 1";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat2)){
	$id_employeur=$row['id'];
	
	}



	//requête d'insertion
	$requete3 = "insert into egw_links value ('','addressbook','$id','addressbook','$id_employeur','','','8')";
	$resultat3 = mysql_query($requete3) or die(mysql_error());
	
	

	}
	
	
	function chercher_beneficiaire($mot,$categorie)
	{
	
	


 	
	
	if ($categorie==NULL)
	{
		$requete="SELECT n_family,n_given,org_name,id FROM  egw_addressbook  WHERE (n_family like '%$mot%' or n_given like '%$mot%' or org_name like '%$mot%') order by n_family asc";
	}	
	else
	{
		$requete='SELECT n_family,n_given,org_name,id FROM  egw_addressbook  WHERE (n_family like "%'.$mot.'%" or n_given like "%'.$mot.'%" or org_name like "%'.$mot.'%") and (cat_id like "%'.$this->cat_id_beneficiaire.'%")  order by n_family asc';
		
	}
	$resultat = mysql_query($requete) or die(mysql_error());
	echo'<select style="width:150px;" name="choix">';
	while($row = mysql_fetch_array($resultat))
	{
	$n_family=$row['n_family'];
	$n_given=$row['n_given'];
	$org_name=$row['org_name'];
	$id=$row['id'];
	if($org_name==null)
	{
	$org_name="aucune entreprise ";
	}
	echo ' <option value='.$id.'>'.$n_family.' '.$n_given.'</option>';
	
	}
	echo'</select>';
	}
	
	function afficher_prescripteurs($choix,$categorie,$annee)
	{
		


		
		$requete="SELECT * FROM  egw_links  WHERE link_id1=$choix";
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
	{
	$link_id2[]=$row['link_id2'];
	}
	

	if(isset($link_id2) and $link_id2!=NULL)
	{
		$r_tableau=NULL;
	for($i=0 ; $i<count($link_id2) ; $i++)
	{
	
		$r_tableau=$r_tableau.' or id='.$link_id2[$i];
	}
	}
	
	/*echo'<form action="panel.php" method="get"><span class="titre">Ses prescripteurs</span>  | <select name="id_p">';
		$requete='SELECT * FROM  egw_addressbook  where cat_id like "%'.$this->cat_id_prescripteur.'%" order by org_name asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$id=$row['id'];
			$org_name=$row['org_name'];
			$n_family=$row['n_family'];
			$n_given=$row['n_given'];
			echo'<option value='.$id.'>'.$org_name.' | '.$n_family.' '.$n_given.'</option>';
			
		}echo'</select> <input type="hidden" name="page" value="presentation" /><input type="hidden" name="annee" value="'.$annee.'" /><input type="hidden" name="choix" value="'.$choix.'" /><input type="hidden" name="valid" value="1" /> <input type="hidden" name="domain" value="default" /><input type="submit"  value="Ajouter" /> ou <a  href="prescripteur.php?id='.$choix.'","fencent",10,10,850,450,"menubar=no,scrollbars=no,statusbar=no")"><img border="0" src="./images/plus_16.png" /> Nouveau prescripteur</a></form>';*/
		echo'<form id="form" action="intermediaire.php" method="post" ><input type="hidden" name="id_ben" value="'.$choix.'" /><strong>Le prescripteur</strong> <input onblur="fill_safir();" onkeyup="lookup_safir(this.value);"  id="code_safir"  name="code_safir" type="text" /> <img title="Ajouter / selectionner le contact du prescripteur" onclick="javascript:voir_contact();" src="../images/user_16.png" /> <div class="suggestionsBox" id="suggestions_safir" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList_safir"> &nbsp; </div>
      </div><div style="position:absolute; border:1px solid #666; background:#EEE; display:none;  top: 250px; left:300px; height: 237px; width: 212px;" id="contact_p"><center><strong>Contact du prescripteur</strong></center><br/><table><tr><td width="80">Civilite</td><td width="123"><select style="width:120px"  name="civilite_p"><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select></td></tr><tr><td>Nom</td><td><input style="border:1px solid #0C0" type="text" onchange="this.value=this.value.toUpperCase();"  name="nom_p" /></td></tr><tr><td>Prenom</td><td><input style="border:1px solid #0C0" type="text" onchange="mail();"  name="prenom_p" /></td></tr><tr><td>Fonction</td><td><select  style="width:120px" name="fonction_p"><option value="Conseiller">Conseiller</option></select></td></tr><tr><td>Tel bureau</td><td><input type="text"  name="tel_bureau_p" /></td></tr><tr><td>Fax</td><td><input type="text"  name="tel_portable_p" /></td></tr><tr><td>Email bureau</td><td><input type="text"  name="email_bureau_p" /></td><tr><td>Email domicile</td><td><input type="text"  name="email_domicile_p" /></td></tr><tr><td></td><td><input type="button" onclick="document.getElementById(\'contact_p\').style.display=\'none\'" value="Fermer"  /></td></tr></table></div> <input type="submit" value="Ajouter"/></form><hr style="border:1px dashed #CCC" />
<table width="100%">
  <tr  style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; "  ><td width="19%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="14%">Telephone bureau</td><td width="14%">Fax</td><td width="16%">Email</td><td width="12%">Fonction</td><td width="7%"></td></tr>';
  
  if(isset($link_id2[0]) and $link_id2[0]!=NULL)
	{
		$requete='SELECT * FROM  egw_addressbook  WHERE (id=0 '.$r_tableau.') and cat_id='.$this->cat_id_prescripteur.' order by org_name desc';
		//echo $requete;
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			$id_pr=$row['id'];
			$fn=$row['fn'];
			$id=$row['id'];
			$tel_cell=$row['tel_cell'];
			$tel_work=$row['tel_work'];
			$tel_fax=$row['tel_fax'];
			$url=$row['url'];
			$email=$row['email'];
		}
			if(isset($id_pr) and $id_pr!=NULL)
			{
			$requete='SELECT * FROM  egw_contact_prescripteur  WHERE id_prescripteur='.$id_pr.' and id_ben='.$choix.'';
			
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			
			$nom=$row['nom'];
			$civilite=$row['civilite'];
			$prenom=$row['prenom'];
			$email_bureau=$row['email_bureau'];
			$email_domicile=$row['email_domicile'];
			$tel_bureau=$row['tel_bureau'];
			$tel_portable=$row['tel_portable'];
			$fonction=$row['fonction'];
		
		}
		if($tel_bureau==NULL)
		$tel_bureau=$tel_work;
		if($tel_portable==NULL)
		$tel_portable=$tel_fax;
		if($email_bureau==NULL)
		$email_bureau=$email;
		echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_bureau.'</td><td width="14%">'.$tel_portable.'</td><td width="16%">'.$email_bureau.'</td><td width="12%">'.$fonction.'</td><td width="7%"> <a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
			else
			{
			echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_work.'</td><td width="14%">'.$tel_cell.'</td><td width="16%">'.$email.'</td><td width="12%">'.$fonction.'</td><td><a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
		
	}
		echo'</table><br/>';
		
		
		

	}
	function afficher_employeurs($choix)
	{
		
	
		$requete="SELECT * FROM  egw_links  WHERE link_id1=$choix";
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
	{
	$link_id2[]=$row['link_id2'];
	}
	

	if(isset($link_id2) and $link_id2!=NULL)
	{
		$r_tableau=NULL;
	for($i=0 ; $i<count($link_id2) ; $i++)
	{
	
		$r_tableau=$r_tableau.' or id='.$link_id2[$i];
	}
	}

	$confirm=utf8_encode('Avez-vous sauvegardé les données du bénéficiaire ?');
			echo'<span class="titre">Ses employeurs</span>  | <a href="javascript:if(confirm(\''.$confirm.'\')) document.location.href=\'employeur.php?id='.$choix.'\'"><img border="0" src="./images/plus_16.png" /> Ajouter un employeur</a><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="14%">Date</td><td width="10%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="14%">Telephone bureau</td><td width="14%">Telephone portable</td><td width="12%">Poste</td><td width="10%">Qualification</td><td width="6%">Contrat</td><td width="2%"></td></tr>';
  
  if(isset($link_id2[0]) and $link_id2[0]!=NULL)
	{
		$requete='SELECT * FROM  egw_addressbook  WHERE (id=0 '.$r_tableau.') and cat_id='.$this->cat_id_employeur.' order by org_name asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			$id=$row['id'];
			$fn=$row['fn'];
			$n_family=$row['n_family'];
			$n_given=$row['n_given'];
			$tel_cell=$row['tel_cell'];
			$tel_work=$row['tel_work'];
			$url=$row['url'];
			$email=$row['email'];
			$contrat=$row['contrat'];
			$poste=$row['poste'];
			$date_debut_poste=$row['date_debut_poste'];
			$date_fin_poste=$row['date_fin_poste'];
			$qualification=$row['qualification'];
			echo'<tr ><td width="14%">'.$date_debut_poste.' - '.$date_fin_poste.'</td><td width="10%" height="21" 
			><strong>'.$org_name.'</strong></td><td width="18%" >'.$fn.'</td><td width="14%">'.$tel_work.'</td><td width="14%">'.$tel_cell.'</td><td width="12%"><font color=red>'.$poste.'</font></td><td width="10%">'.$qualification.'</td><td width="6%">'.$contrat.'</td><td><a href="../inc/update.php?id_ben='.$choix.'&id='.$id.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
		}
	}
		echo'</table><br/><br/><br/>';
		
		

	}
	
	function liste_prescripteur()
	{
		
		
		
		$requete='SELECT * FROM  egw_addressbook  where cat_id like "%'.$this->cat_id_prescripteur.'%" order by org_name asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			
			echo'<option value='.$org_name.'>'.$org_name.'</option>';
		}
		
		
		
	}
	
	function variable_presta_epce($choix)
	{
		
	
		$requete='SELECT id_epce,intitule,lettre_de_commande,date_debut,date_fin FROM  egw_prestation  where id_ben='.$choix.'';
		//$requete='SELECT * FROM  egw_addressbook  where id=1033';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id_epce=$row['id_epce'];
			$lettre_de_commande=$row['lettre_de_commande'];
			$date_debut=$row['date_debut'];
			$date_fin=$row['date_fin'];
			
		
			
		}
		if(isset($id_epce) and $id_epce!=NULL)
		{
		return array($lettre_de_commande,$date_debut,$date_fin);
		}
	}
	function variable_beneficiaire($choix)
	{
		
	
		$requete='SELECT * FROM  egw_addressbook  where id='.$choix.'';
		//$requete='SELECT * FROM  egw_addressbook  where id=1033';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$org_name=$row['org_name'];
			$n_prefix=$row['n_prefix'];
			$n_middle=$row['n_middle'];
			$n_suffix=$row['n_suffix'];
			$n_given=$row['n_given'];
			$n_family=$row['n_family'];
			//$private=$row['private'];
			$tel_work=$row['tel_work'];
			$tel_home=$row['tel_home'];
			$tel_cell=$row['tel_cell'];
			$tel_voice=$row['tel_voice'];
			$tel_fax=$row['tel_fax'];
				$tel_msg=$row['tel_msg'];
					$tel_pager=$row['tel_pager'];
			$url=$row['url'];
			$bday=$row['bday'];
			$geo=$row['geo'];
			$pubkey=$row['pubkey'];
			$access=$row['access'];
			$email=$row['email'];
			$email_home=$row['email_home'];
			$title=$row['title'];
			$org_unit=$row['org_unit'];
			$adr_two_street=$row['adr_two_street'];
			$adr_two_locality=$row['adr_two_locality'];
			$adr_two_region=$row['adr_two_region'];
			$adr_two_postalcode=$row['adr_two_postalcode'];
			$adr_two_countryname=$row['adr_two_countryname'];
			$adr_one_street=$row['adr_one_street'];
			$adr_one_locality=$row['adr_one_locality'];
			$adr_one_region=$row['adr_one_region'];
			$adr_one_postalcode=$row['adr_one_postalcode'];
			$adr_one_countryname=$row['adr_one_countryname'];
			$label=$row['label'];
		    $tel_bbs=$row['tel_bbs'];
			$tel_modem=$row['tel_modem'];
			$tel_car=$row['tel_car'];
			$tel_video=$row['tel_video'];
			$tel_prefer=$row['tel_prefer'];
			$adr_two_type=$row['adr_two_type'];
			
			$niveau_formation=$row['niveau_formation'];
			$intitule_formation=$row['intitule_formation'];
			$niveau_formation_projet=$row['niveau_formation_projet'];
			$intitule_formation_projet=$row['intitule_formation_projet'];
			
			$siret=$row['siret'];
			$date_immat=$row['date_immat'];
			$capital=$row['capital'];
			$forme_juridique=$row['forme_juridique'];
			
			$statut_formation1=$row['statut_formation1'];
			$statut_formation2=$row['statut_formation2'];
			$date_formation1=$row['date_formation1'];
			$date_formation2=$row['date_formation2'];
			$cote_formation1=$row['cote_formation1'];
			$cote_formation2=$row['cote_formation2'];
			
			
				
		}
		
		return array($n_prefix,$n_given,$n_middle,$n_family,$n_suffix,$access,$org_name,$tel_work,$tel_home,$tel_cell,$url,$email,$email_home,$adr_two_street,$adr_two_locality,$adr_two_region,$adr_two_postalcode,$adr_two_countryname,$adr_one_street,$adr_one_locality,$adr_one_region,$adr_one_postalcode,$adr_one_countryname,$title,$org_unit,$tel_voice,$tel_fax,$pubkey,$tel_msg,$tel_pager,$label,$geo,$bday,$tel_bbs,$tel_modem,$tel_car,$tel_video,$tel_prefer,$adr_two_type,$niveau_formation,$intitule_formation,$niveau_formation_projet,$intitule_formation_projet,$siret,$date_immat,$capital,$forme_juridique,$statut_formation1,$statut_formation2,$date_formation1,$date_formation2,$cote_formation1,$cote_formation2);
		
		
		
	}
	
	function selectionner_rdv_plan($id_presta,$choix)
	{
	
	
	  echo'
<table style="border:1px dotted #CCC">
  <tr  style="font-weight:bolder" ><td width="300px"  class="titre2">Entretient / objectif</td><td >Date de prevu</td><td >heure</td></tr>';
		$requete='SELECT * FROM  egw_cal  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
		
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req=$req.' or cal_id='.$cal_id[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' ) and cal_status!="R" order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id2[]=$row['cal_id'];
		
		}
		for ($i=0;$i<count($cal_id2);$i++)
		{
		$req2=$req2.' or cal_id='.$cal_id2[$i];
		}
		$requete2='SELECT * FROM  egw_cal_dates  where cal_id=0 '.$req2.' order by cal_start asc limit 4';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		$tour=mysql_num_rows($resultat2);
		$c=1;
		$n=1;
		while($row = mysql_fetch_array($resultat2))
		{
		
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end_=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			//$cal_start_=date('d/m/Y | H\h i\m\i\n ', $cal_start);
			$cal_start_=date('d/m/Y', $cal_start);
			$heure_start_=date('H', $cal_start);
	
		
		if($tour==1)
		{
			if($c==1)
		$inti='Adequation personne / projet';
		}
		
		elseif($tour==2)
		{
				if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		}
		elseif($tour==3)
		{
				if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		if($c==3)
		$inti='Evaluation financiere du projet';
		}
		
		elseif($tour==4)
		{
		if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		if($c==3)
		$inti='Evaluation financiere du projet';
		if($c==4)
		$inti='Evaluation juridique';
		}
		
		
	
		echo'<tr><td width="200px" style="color:#059610">'.$inti.'</td><td>'.$cal_start_.'</td><td>'.$heure_start_.'h</td></tr>';
		
		
			$n++;	
		$c++;	
	
		}
		
		echo'</table>';
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
	}
	function nbre_rdv_plan($id_presta,$choix)
	{
	
	
	
		$requete='SELECT * FROM  egw_cal where id_presta='.$id_presta.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
		
		}
		
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req=$req.' or cal_id='.$cal_id[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' ) and cal_status!="R" order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
		
		return mysql_num_rows($resultat);
		
	}
	
	
	function selectionner_prestation($choix)
	{
	
	
	  echo'<a name="presta" id="presta"></a><strong>Ses Prestations</strong>  <hr style="border:1px dashed #CCC" />
<table width=100%>
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="200px" height="21" class="titre2">Prestation</td><td width="200px" >ID_Prestation</td><td width="200px">Conseiller</td><td width="200px">Date de debut</td><td width="200px">Date de fin</td><td width="200px">Lieu</td><td width="100px">Statut</td><td width="100px" ></td></tr>';
		
		$requete='SELECT * FROM  egw_prestation  where id_ben="'.$choix.'" order by date_debut desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id_epce[]=$row['id_epce'];
			$presta[]=$row['presta'];
			$lettre_de_commande[]=$row['lettre_de_commande'];
			$statut[]=$row['statut'];
			$date_debut[]=$row['date_debut'];
			$date_fin[]=$row['date_fin'];
			$id_ref[]=$row['id_ref'];
			$intitule[]=$row['intitule'];
			
			
		}
		
		for($i=0;$i<count($presta);$i++)
		{
	
	
		if($date_debut[$i]==0)
	{
		$dat_1=NULL;
	}
	else
	{$dat_1=date('d/m/Y',$date_debut[$i]);
		
	}
	
	if($date_fin[$i]==0)
	{
		$dat_2=NULL;
	}
	else
	{
		$dat_2=date('d/m/Y',$date_fin[$i]);
		
	}
	
	//$lieu=explode("_",$this->rdv_lieu($intitule));
	
	if($presta[$i]=="EPCE")
	{
	$type="LC_";
	}
		
		echo'<tr ><td  height="21">'.$presta[$i].'</td><td ><a href="panel.php?domain=default&choix='.$choix.'&id_presta='.$id_epce[$i].'&lc='.$lettre_de_commande[$i].'&display_eval=block">'.$type.$lettre_de_commande[$i].'</a></td><td >'.$this->get_conseiller($id_ref[$i]).'</td><td >'.$dat_1.'</td><td >'.$dat_2.'</td><td >'.$this->rdv_lieu($intitule[$i]).'</td><td>'.$statut[$i].'</td><td><a  href="panel.php?choix='.$choix.'&modif_id_presta='.$id_epce[$i].'&date_fin='.$dat_2.'&conseiller_id='.$id_ref[$i].'&conseiller='.$this->get_conseiller($id_ref[$i]).'&statut='.$statut[$i].'&lieu='.$this->rdv_lieu($intitule[$i]).'&date_debut='.$dat_1.'&presta='.$presta[$i].'&lettre_commande='.$lettre_de_commande[$i].'#presta"><img border="0" src="../images/edit.png" /></a></td></tr>';
		
		}
		echo'</table>';
		
	}
		function selectionner_rdv_grise($id_presta,$choix)
	{
	



	  echo'<center><font size=+1>RDV non lie(s) a cette prestation</font></center><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="19%" height="21" class="titre2">Intitule du rendez-vous</td><td width="18%" >Date de debut</td><td width="17%">Date de fin</td><td width="17%">Lieu</td><td width="12%">Participants</td><td width="5%">Statut</td><td  width="10%">
  </td></tr>';
		$retour=$this->variable_beneficiaire($choix);
		$requete='SELECT * from egw_cal where cal_title like "%EPC%_'.$retour[3].' '.$retour[1].'%" and  id_presta!='.$id_presta.' and id_presta=0 order by cal_id asc ';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
	
			$cal_title[]=$row['cal_title'];
			$cal_category[]=$row['cal_category'];
			
			
		}
		
		for($i=0;$i<count($cal_id);$i++)
		{
			if($cal_category[$i]!=NULL)
			{
				$requete4='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category[$i].'%" ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cat_name=$row['cat_name'];
			
		
			
		}
			}
				$requete4='SELECT cal_user_id ,cal_status FROM  egw_cal_user  where cal_id = '.$cal_id[$i].' ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cal_user_id=$row['cal_user_id'];
		    $cal_status=$row['cal_status'];
				$requete6='SELECT * FROM  egw_accounts  where account_id='.$cal_user_id.' ';
		$resultat6 = mysql_query($requete6) or die(mysql_error());
		while($row = mysql_fetch_array($resultat6))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
		}
			
		}
		
				$requete4='SELECT cal_end,cal_start FROM  egw_cal_dates  where cal_id = '.$cal_id[$i].' ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end_=date('w/d/n/Y', $cal_end);
			$cal_start_=date('w/d/n/Y', $cal_start);
         
			$cal_end_=$this->date_fr($cal_end_);
			$cal_start_=$this->date_fr($cal_start_);
		   $cal_end_m=date('- H\h i\m\i\n', $cal_end);
			$cal_start_m=date('- H\h i\m\i\n', $cal_start);
	
			
		}
	
		echo'<form action="panel.php" method="get"><tr><td>'.$cal_title[$i].'</td><td width="18%" >'.$cal_start_.' '.$cal_start_m.' </td><td width="17%">'.$cal_end_.' '.$cal_end_m.'</td><td width="17%"><font color="#FF3300">';
		
		 $val=explode("_",$cat_name);
		 if($cal_category[$i]!=NULL)
		 echo $val[2];
		
		
		
		
		
		echo'</font></td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td>'.$cal_status.'</td><td><input type="hidden" name="id_rdv" value="'.$cal_id[$i].'" /><input type="hidden" name="choix" value="'.$choix.'" /><input type="hidden" name="id_presta" value="'.$id_presta.'" /><input type="hidden" name="cal_status" value="'.$cal_status.'" /><input type="hidden" name="display_eval" value="block" /><input type="submit" value="Lier a cette prestation" name="lier" /></td></tr></form>';
			
		}
		
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
		
		
		
		
		
		
		////
			
		/*for($i=0;$i<$boucle;$i++)
		{
			$cal_start=$cal_start+604800;
			$cal_end=$cal_end+604800;
			
			
			$cal_dernier=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			$cal_premier=date('d/m/Y | H\h i\m\i\n ', $cal_start);
	echo'<tr style="color: #999"><td>'.$cal_title.'</td><td width="18%" >'.$cal_premier.'</td><td width="17%">'.$cal_dernier.'</td><td width="17%">'.$cat_name.'</td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="checkbox" /></td></tr>';
	
		}*/
		
		
		echo'</table><br/><br/><br/>';
		}
	function selectionner_rdv($id_presta,$choix)
	{
	
	
	  echo'<a name="rdv" id="rdv"></a><center><font size=+1>RDV de la prestation</font><br/> <a  href="../pose_rdv.php?id_presta='.$id_presta.'&choix='.$choix.'">Nouveau rendez-vous</a></center><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="19%" height="21" class="titre2">Intitule du rendez-vous</td><td width="18%" >Date de debut</td><td width="17%">Date de fin</td><td width="17%">Lieu</td><td width="12%">Participants</td><td width="5%">Statut</td><td  width="10%"></td></tr>';
		
		$requete='SELECT * from egw_cal where id_presta='.$id_presta.' order by cal_id asc ';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
	
			$cal_title[]=$row['cal_title'];
			$cal_category[]=$row['cal_category'];
			
			
		}
		
		for($i=0;$i<count($cal_id);$i++)
		{
			if($cal_category[$i]!=NULL)
			{
				$requete4='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category[$i].'%" ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cat_name=$row['cat_name'];
		
			
		}
			}
				$requete4='SELECT cal_user_id ,cal_status FROM  egw_cal_user  where cal_id ='.$cal_id[$i].'';
			
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat4))
		{
			$cal_user_id=$row['cal_user_id'];
		    $cal_status=$row['cal_status'];
				$requete6='SELECT * FROM  egw_accounts  where account_id='.$cal_user_id.' ';
		$resultat6 = mysql_query($requete6) or die(mysql_error());
		while($row = mysql_fetch_array($resultat6))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
		}
			
		}
		
				$requete4='SELECT cal_end,cal_start FROM  egw_cal_dates  where cal_id = '.$cal_id[$i].' ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end_=date('w/d/n/Y', $cal_end);
			$cal_start_=date('w/d/n/Y', $cal_start);
         
			$cal_end_=$this->date_fr($cal_end_);
			$cal_start_=$this->date_fr($cal_start_);
		   $cal_end_m=date('- H\h i\m\i\n', $cal_end);
			$cal_start_m=date('- H\h i\m\i\n', $cal_start);
	
			
		}
	
		echo'<form action="panel.php" method="get"><tr><td>'.$cal_title[$i].'</td><td width="18%" >'.$cal_start_.' '.$cal_start_m.'</td><td width="17%">'.$cal_end_.' '.$cal_end_m.'</td><td width="17%"><font color="#FF3300">';
		
		 $val=explode("_",$cat_name);
		 if($cal_category[$i]!=NULL)
		 echo $val[2];
		
		
		
		
		
		echo'</font></td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="hidden" name="id_presta" value="'.$id_presta.'" /><input type="hidden" name="display_eval" value="block" /><input type="hidden" name="id_rdv" value="'.$cal_id[$i].'" /><input type="hidden" name="choix" value="'.$choix.'" /><select onchange="submit()" name="stat" style="width:40px;"><option>'.$cal_status.'</option><option value="A">A</option><option value="R">R</option></select></td><td><a href="panel.php?choix='.$choix.'&id_presta='.$id_presta.'&display_eval=block&id_rdv_unlink='.$cal_id[$i].'" ><img border="0" title="Ne pas lier ce rdv a cette prestation" src="../images/icons/disconnect.png"  /></a></td></tr></form>';
			
	
		}
		
		
		if($nbreLignes==1)
		{$boucle=3;}
		elseif($nbreLignes==2)
		{$boucle=2;}
		elseif($nbreLignes==3)
		{$boucle=1;}
		else
		{$boucle=0;}
		
		
		
		
		
		
		
		
		
		
		
		////
			
		/*for($i=0;$i<$boucle;$i++)
		{
			$cal_start=$cal_start+604800;
			$cal_end=$cal_end+604800;
			
			
			$cal_dernier=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			$cal_premier=date('d/m/Y | H\h i\m\i\n ', $cal_start);
	echo'<tr style="color: #999"><td>'.$cal_title.'</td><td width="18%" >'.$cal_premier.'</td><td width="17%">'.$cal_dernier.'</td><td width="17%">'.$cat_name.'</td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="checkbox" /></td></tr>';
	
		}*/
		
		
		echo'</table><br/>';
	}
	
	function delete($id_p,$id_ben)
	{
		
	
	
 	
	

	$requete2="Delete FROM  egw_links  WHERE link_id2=$id_p and link_id1=$id_ben and link_app1='addressbook' and link_app2='addressbook' ";
	
	$resultat2 = mysql_query($requete2) or die(mysql_error());

	
	
	
	}
	function liste_option($choix)
	{
		echo '<div align="center"><form><table style="border:1px solid #999"><tr bgcolor="#E6E6E6"><td style="border-right:1px solid #CCC">Intitule </td><td style="border-right:1px solid #CCC">Date de debut</td><td style="border-right:1px solid #CCC">Date de fin</td><td ></td></tr>';
		$requete='SELECT * FROM  egw_cal  where cal_title like "%Option%"';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			$cal_title[]=$row['cal_title'];
		}
		
		
	
	
	$taille = count($cal_id);
	
	for($i=0 ; $i<$taille ; $i++)
	{
	
			
			$requete='SELECT * FROM  egw_cal_dates  where cal_id='.$cal_id[$i].' order by cal_id desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
			
			echo '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$cal_title[$i].'</font> </td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input type="checkbox" /></td></tr>';
			
	}
	 
			
		
			
		}
		
		echo'</table><br/><input type="submit" value="Valider"> <a href="../index.php?page=presentation&domain=default&choix='.$choix.'">Retour</a></form></div>';
	}
	
	
	function liste_confirmation_option($lieu,$date_inscription,$conseiller_id)
	{
		
		
		
	 $date_string = explode('/', $date_inscription);
	

	$timestamp = mktime(0, 0, 0, $date_string[1], $date_string[2], $date_string[0]);

	
	if($conseiller_id!=NULL)
	{
		$requete='SELECT * FROM  egw_accounts  WHERE account_id='.$conseiller_id.'';
 
	
   
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
		$account_id=$row['account_id'];	
	$account_firstname=$row['account_firstname'];	
	$account_lastname=$row['account_lastname'];	
	}
	}
	else
	{
	$account_firstname='Tous';
	$account_lastname=' les conseillers';
	}
		
		
	echo '<div align="center"><form action="../presentation/nouveau_beneficiaire.php" method="get"><table><tr><td><input type="hidden" name="conseiller_id" value="'.$conseiller_id.'"/><strong>Confirmer les options de <font color=red>'.$account_firstname.' '.$account_lastname.'</font> a partir du '.$date_inscription.' </strong> pour <select name="option_ben"><option value="nouveau">Nouveau beneficiaire</option>';
		
		
		
	
		
		$requete='SELECT * FROM  egw_categories  WHERE cat_name="Usager_%"';
	
   
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$id_beneficiaires[]=$row['cat_id'];	
	}
	
	$requete='SELECT * FROM  egw_addressbook  where cat_id like "%'.$id_beneficiaires[0].'%"  or cat_id like "%'.$id_beneficiaires[1].'%" or cat_id like "%'.$id_beneficiaires[2].'%" or cat_id like "%'.$id_beneficiaires[3].'%" or cat_id like "%'.$id_beneficiaires[4].'%" order by n_family asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
			$n_family=$row['n_family'];
			$n_given=$row['n_given'];
			
			echo'<option value='.$id.'>'.$n_family.' '.$n_given.'</option>';
		}
		
	
	
	
	
		echo'</select><td></tr></table><br/>
		<table style="border:1px solid #999"><tr bgcolor="#E6E6E6"><td style="border-right:1px solid #CCC">Intitule </td><td style="border-right:1px solid #CCC">Conseiller</td><td style="border-right:1px solid #CCC">Date de debut</td><td style="border-right:1px solid #CCC">Date de fin</td><td ></td></tr>';
		
		
		
		
		
		if($lieu==1)
		{
			 if($conseiller_id!=NULL)
 				{
	
				$requete='SELECT egw_cal_user.cal_id,egw_cal.cal_id,egw_cal.cal_title,egw_cal_user.cal_user_id FROM  egw_cal,egw_cal_user where egw_cal_user.cal_id=egw_cal.cal_id and cal_title like "%Option%"  and cal_user_id='.$conseiller_id.' order by egw_cal.cal_id desc';
				
				}
				else
				{
				$requete='SELECT egw_cal_user.cal_id,egw_cal.cal_id,egw_cal.cal_title,egw_cal_user.cal_user_id FROM  egw_cal,egw_cal_user  where cal_title like "%Option%" and egw_cal_user.cal_id=egw_cal.cal_id order by egw_cal.cal_id desc ';
				}
		
		}
		else
		{
			
			 if($conseiller_id!=NULL)
 				{
					$requete='SELECT egw_cal_user.cal_id,egw_cal.cal_id,egw_cal.cal_title,egw_cal_user.cal_user_id FROM  egw_cal,egw_cal_user where egw_cal_user.cal_id=egw_cal.cal_id and cal_title like "%Option_'.$lieu.'"  and cal_user_id='.$conseiller_id.' order by egw_cal.cal_id desc';
		
				}
				else
				{
				$requete='SELECT egw_cal_user.cal_id,egw_cal.cal_id,egw_cal.cal_title,egw_cal_user.cal_user_id FROM  egw_cal,egw_cal_user  where cal_title like "%Option_'.$lieu.'" and egw_cal_user.cal_id=egw_cal.cal_id order by egw_cal.cal_id desc';
				}
		}
	
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			$cal_title[]=$row['cal_title'];
			//$cal_owner[]=$row['cal_owner'];
			$cal_user_id[]=$row['cal_user_id'];
			
		}
		
		
	
	
	$taille = count($cal_id);
	$nb=0;
	for($i=0 ; $i<$taille ; $i++)
	{
	$nb++;
			
			$requete='SELECT * FROM  egw_accounts  WHERE account_id='.$cal_user_id[$i].' limit 1';
 

	
   
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat))
	{ 
	$account_firstname=$row['account_firstname'];	
	   $account_lastname=$row['account_lastname'];	
		
		$v[]=$row['account_id'];
	

	
	}

			$requete='SELECT * FROM  egw_cal_dates  where cal_id='.$cal_id[$i].' and cal_start >'.$timestamp.' order by cal_start desc';
			
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
			
			echo '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$cal_title[$i].'</font> </td><td style="border-right:1px solid #CCC">'.$account_firstname.' '.$account_lastname.'</td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input name="option[]" type="radio" value="'.$cal_id[$i].'-'.$v[$i].'" /></td></tr>';
		
		
	}
	
			
		
			
		}
		
		echo'</table><br/><input type="submit" value="Confirmer l\'option"></form></div>';
	}
	
	
		function link_rdv($id_recup,$id_cal)
	{
		
	

	
	
		
		$requete='Insert into egw_links value("","calendar","'.$id_cal.'","addressbook","'.$id_recup.'","","","'.$this->cat_id_owner.'")';
		//echo $requete;
		$resultat= mysql_query($requete) or die(mysql_error());
		
	
	}
	function link_beneficiaire_calendar($id_recup,$opt,$nb,$n_given,$n_family,$tel_work,$tel_cell,$lc,$pole_id,$nom_p,$prenom_p,$tel_home,$code_safir,$tel_contact,$tel_contact2,$date_deb,$id_presta)
	{
		
		
	

	
		$requete='Insert into egw_links value("","calendar","'.$opt.'","addressbook","'.$id_recup.'","","","'.$this->cat_id_owner.'")';
$resultat= mysql_query($requete) or die(mysql_error());
		
		
		
		$requete3='SELECT * FROM  egw_cal  where cal_id='.$opt.'';
		
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$cal_title=$row['cal_title'];
			$ti = explode("_", $cal_title);
			$ti[0];
			$ti[1];
			
		}
		
			$requete3='SELECT adr_one_street,adr_one_locality,adr_one_postalcode FROM egw_addressbook WHERE org_name like "%APSIE '.$ti[3].'" order by id desc limit 1';
	
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$adr_one_street=$row['adr_one_street'];
			$adr_one_locality=$row['adr_one_locality'];
			$adr_one_postalcode=$row['adr_one_postalcode'];
			
			
		}
		
		$requete_='SELECT cal_start FROM  egw_cal_dates  where cal_id='.$opt.'';
		
		$resultat_ = mysql_query($requete_) or die(mysql_error());
		while($row = mysql_fetch_array($resultat_))
		{
			$cal_start=$row['cal_start'];
			
			
		}
		if($code_safir!=NULL)
		{$pol=$this->pole_emploi($code_safir);}
		else
		{$pol="?";}
		
		if($tel_contact==NULL)
		$tel_contact=$pol[1];
		
		if($tel_contact2==NULL)
		$tel_contact2=$pol[2];
		
		if($lc==NULL)
		$lc="?";
		
		$requete2='Update egw_cal set id_presta='.$id_presta.',cal_description=" Tel Bureau : '.$tel_work.'\n Tel portable : '.$tel_cell.' \n Tel Privé : '.$tel_home.'\n \n Pôle emploi '.$code_safir.'_'.$pol[0].'\n LC N° '.$lc.' \n ID. '.$pole_id.'
\r Prescripteur : '.$nom_p.' '.$prenom_p.'\n T.'.$tel_contact.' \n F.'.$tel_contact2.' \n\n Lieu : '.$adr_one_street.' '.$adr_one_postalcode.' '.$adr_one_locality.'\n Prestation debut : '.date('d/m/Y à H:i',$cal_start).'",cal_title="'.$ti[0].'_'.$ti[1].'_'.$n_family.' '.$n_given.'" where cal_id='.$opt.'';
		$resultat2= mysql_query($requete2) or die(mysql_error());
		
		
	}
		
			function link_beneficiaire_option($id_beneficiaire,$nb,$opt)
	{
		$opt = explode("-", $opt);
	
	for($i=0;$i<$nb;$i++)
	{
		
		if($opt[$i]==NULL)
		{}
		else
		{
			
		$requete='Insert into egw_links value("","calendar","'.$opt[$i].'","addressbook","'.$id_beneficiaire.'","","","'.$this->cat_id_owner.'")';
		//echo $requete;
		//$requete='Insert into egw_links value("","calendar","'.$opt[$i].'","addressbook","'.$id_beneficiaire.'","","","'.$this->cat_id_owner.'")';
		$resultat= mysql_query($requete) or die(mysql_error());
		
		$requete3='SELECT * FROM  egw_cal  where cal_id='.$opt[$i].'';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$cal_title=$row['cal_title'];
			$ti = explode("_", $cal_title);
			$ti[0];
			$ti[1];
			
		}
		}
		
	
		$requete3='SELECT * FROM  egw_addressbook  where id='.$id_beneficiaire.'';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$n_family=$row['n_family'];
			$n_given=$row['n_given'];
			
			
		}
		
		if($opt[$i]==NULL)
		{}
		else
		{
		$requete2='Update egw_cal set cal_title="'.$ti[0].'_'.$ti[1].'_'.$n_family.' '.$n_given.'" where cal_id='.$opt[$i].'';
		$resultat2= mysql_query($requete2) or die(mysql_error());
		}
		
		
	}
		
	}
	
	function selectionner_lieu()
	{
		echo'<select name="lieu"><option value="">Choisir un lieu</option>';
		$requete3='SELECT * FROM  egw_cal  order by cal_location asc';
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$cal_location=$row['cal_location'];
			echo'<option value='.$cal_location.'>'.$cal_location.'</option>';
			
		}
	echo'</select>';
	
	}
	
	function selectionner_conseiller($conseiller,$id='')
	{
		
		echo'<select style="width:120px"  name="conseiller_id">';
		if($conseiller!=NULL)
		{
		
		echo'<option value='.$id.'>'.$conseiller.'</option>';
		}
		else
		{	echo'<option value=""></option>';}
		
	
			
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group=-9 order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		echo'</select>';
	}
	
	function selectionner_conseiller2()
	{
		
		echo'<select name="conseiller_id"><option value="">Tous les conseillers</option>';
		
		
			
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group=-9 order by account_firstname asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
			echo'<option value='.$account_id.'>'.$account_firstname.' '.$account_lastname.'</option>';
			
		}
		
		echo'</select>';
	}
	

	function selectionner_option($date_debut,$duree,$planification)
	{
		
		$requete='SELECT * FROM  egw_cal_dates  where cal_id='.$cal_id[$i].' order by cal_start desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
		}
		
	}
	
function chercher_options($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nombre,$jour)
	{
		
		
			$requete='SELECT account_firstname,account_lastname FROM  egw_accounts where account_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
			
			
		}
		
		
		$z=1;
		/*$conseiller_id=9;
		$plage1=8;
		$plage2=17;
		$selection=1;
		$date_choisi = "2010/03/3";*/
		$chosi=explode('/',$date_choisi);
		
		$base= mktime(0,0,0,$chosi[1],$chosi[2],$chosi[0]);
		
		
		echo'<hr /><form name="test" action="poser.php" method="get"><table><tr><td><font color=red>'.$account_firstname.' '. $account_lastname.' </font>pour prestations</td><td><select name="prestation"> <option value="EPC93">EPC93</option><option value="EPC94">EPC94</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_SE">EPI_SE</option><option value="EPI_BP">EPI_BP</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$account_firstname.' '.$account_lastname.'" /></td></tr></table>';
		
		
		$requete='SELECT cal_id FROM  egw_cal_user where cal_user_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$cal_id[]=$row['cal_id'];
			
			
			
		}
		
		if(isset($cal_id[0]) and $cal_id[0]!=NULL)
		{
			$req=NULL;
				
				for ($i=0;$i<count($cal_id);$i++)

		{

		$req=$req.' or cal_id='.$cal_id[$i];

		}
		
		
		$requete='SELECT cal_end,cal_start FROM  egw_cal_dates  where (cal_start>'.$base.') and (cal_id=0 '.$req.')   order by cal_start desc';
		
		
		
		
		
		
		$resultat = mysql_query($requete) or die(mysql_error());
		$j=mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			
			$cal_end[]=$row['cal_end'];
			$cal_start[]=$row['cal_start'];
			/*$cal_e[]=date(' d/m/Y | H:00', $cal_end);
			$cal_s[]=date(' d/m/Y | H:00', $cal_start);*/
			
			
		}
		
		
		for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			
		
			
		
			if($jour==6)
			{
				if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
					
			 $_j6[]=date('l',$base + $dat1);
		
			
			$time16[]=$base + $dat1;
			$time26[]=$base + $dat1+($duree);
				}

				}
			else
			{
				
				if($heure>($plage1-1) and $heure<$plage2  and $jours==$jour)
				{
					
		  $_j[]=date('l',$base + $dat1);
		
			
			$time1[]=$base + $dat1;
			$time2[]=$base + $dat1+($duree);
			
		
		
				}
		
		
	
				
			}
	
		//	if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
			
			
			
		
		
		
		
		
		
		}
		if(isset($time1))
		{
		$d1=array_diff($time1,$cal_start);
		$d2=array_diff($time2,$cal_end);
		}
		if(isset($time16))
		{
		$d16=array_diff($time16,$cal_start);
		$d26=array_diff($time26,$cal_end);
		}
		if($jour!=6)
	{
foreach($d1 as $maCle=>$maValeur)
{
	if(date('H',$time1[$maCle])!=13)
	{
	
	
   echo '<table ><tr><td width="100">'.$_j[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time1[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time2[$maCle]).'</td><td ><input name="pose[]" value="'.$time1[$maCle].'-'.$time2[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z==$nombre)
	{
		break;
	}
	$z++;
}


	}
				
			
else
{
	
	foreach($d16 as $maCle=>$maValeur)
{
	if(date('H',$time16[$maCle])!=13)
	{
	
   echo '<table ><tr><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z==$nombre)
	{
		break;
	}
	$z++;
}


}	
		
			
				
			}
			
			//SI PAS DE CONTRAINTE
			else
			{	
			
			for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
				
		  $_j=date('l',$base + $dat1);
			$_dat=date(' d/m/Y | H:00',$base + $dat1);
			$__dat=date(' d/m/Y | H:00',$base + $dat1+($duree));
			
			$time1=$base + $dat1;
			$time2=$base + $dat1+($duree);
			
			if(date('H',$time1)!=13)
			{
					echo '<table ><tr><td width="100">'.$_j.'</td><td> '.$_dat.'</td><td >'.$__dat.'</td><td ><input name="pose[]" value="'.$time1.'-'.$time2.'" type="checkbox" /></td></tr></table>';
			}
			
				}
			}
			}
	echo '<a  onclick="javascript:Check_all(true);">Tout cocher</a> | <a onclick="javascript:Check_all(false);">Tout decocher</a> <input type="submit" value="Poser" /></form>';
	
	}
	
	// chercher rdv conseiller
	
	function chercher_rdv($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nombre,$jour,$choix,$intervalle)
	{
	if($selection==NULL)
		$selection=28;
		//$retour=$this->variable_beneficiaire($choix);
		/*
				$requete='SELECT account_firstname,account_lastname FROM  egw_accounts where account_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
			
			
		}
		*/
		
		$z=1;
		/*$conseiller_id=9;
		$plage1=8;
		$plage2=17;
		$selection=1;
		$date_choisi = "2010/03/3";*/
		$chosi=explode('/',$date_choisi);
		
		$base= mktime(8,0,0,$chosi[1],$chosi[0],$chosi[2]) + $intervalle;
		$base2= 3600+mktime(8,0,0,$chosi[1],$chosi[0],$chosi[2]) + $intervalle;
		
		
		
	/*	echo'<hr /><form name="test" action="poser_rdv.php" method="get"><table><tr><td><font color=red>'.$account_firstname.' '. $account_lastname.' </font>pour prestations</td><td><select name="prestation"> <option value="EPC93">EPC93</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_SE">EPI_SE</option><option value="EPI_BP">EPI_BP</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$account_firstname.' '.$account_lastname.'" /></td></tr></table>';*/
		
				$requete='SELECT cal_id FROM  egw_cal_user where cal_user_id='.$conseiller_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$cal_id[]=$row['cal_id'];
			
			
			
		}
		
		if(isset($cal_id[0]) and $cal_id[0]!=NULL)
		{
			$req=NULL;
				
				for ($i=0;$i<count($cal_id);$i++)

		{

		$req=$req.' or cal_id='.$cal_id[$i];

		}
		
		
		$requete='SELECT cal_end,cal_start FROM  egw_cal_dates  where (cal_start>'.$base.') and (cal_id=0 '.$req.')   order by cal_id desc';
		
		
		
		
		
		
		$resultat = mysql_query($requete) or die(mysql_error());
		$j=mysql_num_rows($resultat);
	
		while($row = mysql_fetch_array($resultat))
		{
			
		
			$cal_start[]=$row['cal_start'];
			$cal_end[]=$row['cal_end'];
			//$cal_end2[]=$row['cal_end']-3600;
			
			
		}
		
		
		for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			
	
			
		
			if($jour==6)
			{
				if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
					
			 $_j6[]=date('l',$base + $dat1);
		
			
			$time16[]=$base + $dat1;
			$time26[]=$base + $dat1+($duree);
				}

				}
			else
			{
				
				if($heure>($plage1-1) and $heure<$plage2  and $jours==$jour)
				{
					
		  $_j[]=date('l',$base + $dat1);
		
			
			$time1[]=$base + $dat1;
			$time2[]=$base + $dat1+($duree);
			
		
		
				}
		
		
	
				
			}
	
		//	if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
			
			
			
		
		
		
		
		
		
		}
			if(isset($time1))
		{
		$d1=array_diff($time1,$cal_start);
		$d2=array_diff($time2,$cal_end);
		//$d3=array_diff($time1,$cal_end2);
		}
		if(isset($time16))
		{
		$d16=array_diff($time16,$cal_start);
		$d26=array_diff($time26,$cal_end);
		}
		
		if($jour!=6)
	{
		echo'<br/><strong><font color="#FF0000">SEMAINE 1</font></strong>';
		$semaine=2;
for($i=0;$i<8*3600;$i=$i+3600)
{
	for($z=0;$z<count($cal_start);$z++)
{
	if($cal_start[$z]==$base+$i)
{
	$tab[$z]=$cal_start[$z];
	$tab2[$z]=$cal_end[$z];
   echo '<table bgcolor="#F2F2F2"><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.date('l',$base+$i).'</td><td> '.date(' d/m/Y | H:00',$base+$i).'</td><td >'.date(' d/m/Y | H:00',$cal_end[$z]).'</td><td ><input name="pose[]" value="'.$d1[$i].'-'.$d2[$i].'" type="checkbox" /><input type="hidden" name="date_choisi[]" value="'.date('d/m/Y',$d1[$i]).'" </td></tr></table>';
  $day =date('d',$d1[$i]);
   $month =date('m',$d1[$i]);
}

}

/*
	if(date('H',$d1[$i])!=13 and $d2[$i]-$d1[$i]==3600 )
	{
	$x++;
	if(date('d',$d1[$i])==($day+7) or date('m',$d1[$i])==($month+1) )
	{
	echo'<br/><strong><font color="#FF0000">SEMAINE '.$semaine.'</font></strong>';
	$semaine++;
	}*/
	
	
	if($z>$nombre)
	{
		break;
	}
	$z++;
}
echo $tab[0].'-'.$tab2[0];

	
}
			
else
{
	
	foreach($d16 as $maCle=>$maValeur)
{
	if(date('H',$time16[$maCle])!=13)
	{
	$x++;
	
   echo '<table ><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr></table>';
 
	
	}
	 

/*	if($z>$nombre)
	{
		break;
	}
	$z++;*/
}
	

}	
		
			
				
			}
			
			//SI PAS DE CONTRAINTE
			else
			{	
			
			for ($i=0;$i<24*$selection;$i++)
		{
			
		
		
			$dat1=$i*($duree);
			$heure=date('H',$base + $dat1);
			$jours=date('l',$base + $dat1);
			
			if($heure>($plage1-1) and $heure<$plage2 and $jours!='Sunday' and $jours!='Saturday')
				{
				
		  $_j=date('l',$base + $dat1);
			$_dat=date(' d/m/Y | H:00',$base + $dat1);
			$__dat=date(' d/m/Y | H:00',$base + $dat1+($duree));
			
			$time1=$base + $dat1;
			$time2=$base + $dat1+($duree);
			
			
			if(date('H',$time1)!=13)
			{
					echo '<table ><tr><td width="100">'.$_j.'</td><td> '.$_dat.'</td><td >'.$__dat.'</td><td ><input name="pose[]" value="'.$time1.'-'.$time2.'" type="checkbox" /></td></tr></table>';
			}
			
				}
			}
			}
	//echo '<a  onclick="javascript:Check_all(true);">Tout cocher</a> | <a onclick="javascript:Check_all(false);">Tout decocher</a> <input type="submit" value="Poser" /></form>';
	
	}
	
	function inserer_cal_dates($id,$cal_start, $cal_end)
	{
		
	$requete = 'insert into egw_cal_dates value ("'.$id.'","'.$cal_start.'", "'.$cal_end.'")';
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}	
	function selectionner_cal_dates($opt)
	{
		
	
	
		
	    $requete='SELECT * FROM  egw_cal_dates  where cal_id='.$opt.' order by cal_id asc limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_start=$row['cal_start'];
			$cal_end=$row['cal_end'];
		}
		
		return  array($cal_start,$cal_end);
	
	
	}	
	function inserer_cal_user($id,$conseiller_id)
	{
		
	
	$requete = 'insert into egw_cal_user value ("'.$id.'","0","u","'.$conseiller_id.'","U","1")';
	$resultat = mysql_query($requete) or die(mysql_error());
	}	
	
	function inserer_cal($titre,$lieu,$createur,$conseiller_id,$id_presta=0)
	{
		
		
		
		$requete='SELECT * FROM  egw_accounts where account_lid="'.$createur.'" limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$account_id=$row['account_id'];
			
		}
			
		
		if($lieu=='Gennevillers' or $lieu=='Courbevoie')
		{
		$requete='SELECT * FROM  egw_categories where cat_name="Crea_92_'.$lieu.'" limit 1';
		}
		elseif($lieu=='Saint-Maur' or $lieu=='Creteil' or $lieu=='Champigny')
		{
		$requete='SELECT * FROM  egw_categories where cat_name="Crea_94_'.$lieu.'" limit 1';
		}
		else
		{
		$requete='SELECT * FROM  egw_categories where cat_name="Crea_93_'.$lieu.'" limit 1';
		}
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cat_id=$row['cat_id'];
			
		}
			
	$requete='Insert into egw_cal value("","","'.$conseiller_id.'","'.$cat_id.'","'.time().'","2","1","'.$titre.'","","","0","'.$account_id.'","","'.$id_presta.'")';
	$resultat= mysql_query($requete) or die(mysql_error());
	
	
	
	$requete='SELECT * FROM  egw_cal order by cal_id desc limit 1';
	$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		return $cal_id;
		
}


//fonction projets-----------------------------------


	function inserer_phpgw_p_hours($id, $employee, $project_id, $activity_id, $entry_date, $start_date, $end_date, $remark, $minutes, $status, $hours_descr, $dstatus, $pro_parent, $pro_main, $billable, $km_distance, $t_journey, $cost_id)
	{		

$requete = "insert into phpgw_p_hours value ('', '$employee', '$project_id', '$activity_id', '$entry_date', '$start_date', '$end_date', '$remark', '$minutes', '$status', '$hours_descr', '$dstatus', '$pro_parent', '$pro_main', '$billable', '$km_distance', '$t_journey', '$cost_id')";
	$resultat = mysql_query($requete) or die(mysql_error());
	}
	

	function inserer_phpgw_p_projects($project_id,$p_number,$owner,$access,$entry_date,$start_date,$end_date,$coordinator,$customer,$status,$descr,$title,$budget,$category,$parent,$time_planned,$date_created,$processor,$investment_nr,$main,$level,$previous,$customer_nr,$reference,$url,$result,$test,$quality,$accounting,$acc_factor,$billable,$psdate,$pedate,$priority,$discount,$e_budget,$inv_method,$acc_factor_d,$discount_type)
	{
		
	$requete = "insert into phpgw_p_projects value ('', '$p_number','$owner','$access','$entry_date','$start_date','$end_date','$coordinator','$customer','$status','$descr','$title','$budget','$category','$parent','$time_planned','$date_created','$processor','$investment_nr','$main','$level','$previous','$customer_nr','$reference','$url','$result','$test','$quality','$accounting','$acc_factor','$billable','$psdate','$pedate','$priority','$discount','$e_budget','$inv_method','$acc_factor_d','$discount_type')";
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	$requete='SELECT * FROM  phpgw_p_projects order by project_id desc limit 1';
	$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$project_id=$row['project_id'];
			
		}
		return $project_id;
	
	
	}	
	
	function selectionner_activite_id($titre)
	{
		
	
	
		
	    $requete='SELECT * FROM  phpgw_p_activities  where a_number="'.$titre.'" limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$id=$row['id'];
			
		}
		
		return  $id;
	
	
	}	
	
	function selectionner_calendar_conseiller_id($opt)
	{
	
	
	
	
	
		
	    $requete='SELECT * FROM  egw_cal  where cal_id='.$opt.' limit 1';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_owner=$row['cal_owner'];
		}
		
		return  $cal_owner;
	
	}
	
	
	function texte($champ)
	{
		
	
	
	    $requete='SELECT * FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$valeur=$row['valeur'];
			$id=$row['id'];
			
			echo'<option value='.$id.'>'.utf8_encode($valeur).'</option>';
			
			
			
		}
	}
	function texte2($champ)
	{
		
	
	
	    $requete='SELECT valeur FROM  egw_epce_texte   where intitule="'.$champ.'" order by  valeur asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$valeur=$row['valeur'];
			
			
			echo'<option value='.$valeur.'>'.$valeur.'</option>';
			
			
			
		}
	}
	function texte_id($id)
	{
		
	
	
	    $requete='SELECT valeur FROM  egw_epce_texte   where id="'.$id.'" order by  valeur asc';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$valeur=$row['valeur'];
			
			
		return $valeur;
			
			
			
		}
	
	
	
	}	
	

	function liste_dynamique_cp($valeur)
	{
		
	
	
	
	
	if(!$this->db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($valeur)) {
			$queryString = $db->real_escape_string($valeur);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT cp,ville1,departement FROM egw_code_postaux WHERE cp LIKE '$queryString%' LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			echo '<li onClick="fill(\''.$result->cp.'\');">'.$result->cp.' '.$result->ville1.'('.$result->departement.')</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
		
	}
	
		function age($annee_naissance, $mois_naissance, $jour_naissance, $timestamp = '') {
 
	//Si on veut verifier à la date actuelle ( par défaut )
	if(empty($timestamp))
		$timestamp = time();
 
	//On evalue l'age, à un an par exces
	$age = date('Y',$timestamp) - $annee_naissance;
 
	//On retire un an si l'anniversaire n'est pas encore passé
	if($mois_naissance > date('n', $timestamp) || ( $mois_naissance== date('n', $timestamp) && $jour_naissance > date('j', $timestamp)))
		$age--;
 
	return $age;
}

	
	function inserer_presta($id_ben,$id_ref,$prestataire,$nom,$prenom,$lettre_commande,$presta,$statut,$deb)
	{
		/*$deb=explode("/",$debut);
		 $deb=mktime(0,0,0,$deb[1],$deb[0],$deb[2]);*/
	$requete = "insert into egw_prestation value ('','$id_ben','$id_ref','$prestataire','$presta','$nom $prenom','$lettre_commande','$deb','','$statut','0')";
	
	$resultat = mysql_query($requete) or die(mysql_error());
		 
		 $requete='SELECT id_epce FROM  egw_prestation   where lettre_de_commande="'.$lettre_commande.'"  order by id_epce desc limit 1';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$id_epce=$row['id_epce'];
			
		}
		return $id_epce;
		
	}	
	function update_presta_epce($id_ben,$statut,$id_presta)
	{
	 $requete = 'Update egw_prestation set statut="'.$statut.'"  where id_epce='.$id_presta.'';

	$resultat = mysql_query($requete) or die(mysql_error());
	
	}
	function rdv_statut($beneficiaire,$statut)
	{
		 $requete='SELECT cal_id FROM  egw_cal   where cal_title like "%EPC93_'.$beneficiaire.'%" order by cal_id asc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id=$row['cal_id'];
			
		}
		
		 $requete = 'Update egw_cal_user set cal_status="'.$statut.'"  where  cal_id='.$cal_id.' order by cal_id desc';
		
	$resultat = mysql_query($requete) or die(mysql_error());

	
	}
	

	
	function rdv_change_statut($id_rdv,$statut)
	{
		 $requete = 'Update egw_cal_user set cal_status="'.$statut.'"  where  cal_id='.$id_rdv.'';
		 	$resultat = mysql_query($requete) or die(mysql_error());
				
	}
	
	function valider($id,$module,$id_presta)
	{	
	
		$requete='SELECT * FROM  egw_epce_validation  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$nbr=mysql_num_rows($resultat);
		if ($nbr==0)
		{
			$this->inserer_valider($id,$module,$id_presta);
		}
		else
		{
		 $this->update_valider($id,$module,$id_presta);
		}
				
	}
	function inserer_valider($id,$module,$id_presta)
	{	
	
	if($module=="plan")
	{
	$a = 1;
	$b = "?";
	$c = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	
	}
	if($module=="coherence")
	{
	$a = "?";
	$b = 1;
	$c = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_coherence")
	{
		$a = 1;
		$b = 1;
		$c = "";
		$d = "";
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="commerciaux")
	{
	$a = "?";
	$C = 1;
	$b = "?";
	$d = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_commerciaux")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = "";
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="financier")
	{
	$a = "?";
	$d = 1;
	$c = "?";
	$b = "?";
	$e = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_financier")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = 1;
		$e = "";
		$f = "";
	    $g = 0;
	
	}
	if($module=="juridique")
	{
	$a = "?";
	$e = 1;
	$c = "?";
	$d = "?";
	$b = "?";
	$f = "?";
    $g = 0;
	}
	if($module=="ab_juridique")
	{
		$a = 1;
		$b = 1;
		$c = 1;
		$d = 1;
		$e = 1;
		$f = "";
	    $g = 0;
	
	}
	if($module=="bilan")
	{
	$a = "?";
	$e = "?";
	$c = "?";
	$d = "?";
	$b = "?";
	$f = 1;
    $g = 0;
	}
	if($module=="tout_plan")
	{
	$f = "";
	$e = "";
	$d = "";
	$c = "";
	$b = "";
	$a = 1;
	$g = 0;
	
	}
	if($module=="tout")
	{
	$f = 1;
	$e = 1;
	$d = 1;
	$c = 1;
	$b = 1;
	$a = 1;
	$g = 1;
	
	}
	if($module=="NSPP")
	{
	$f = "";
	$e = "";
	$d = "";
	$c = "";
	$b = "";
	$a = "";
	$g = "";
	
	}
		$requete='insert into egw_epce_validation value ("","'.$id.'","'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","'.$f.'","'.$g.'","'.$id_presta.'")';
		
		$resultat = mysql_query($requete) or die(mysql_error());
	}
		
		function update_valider($id,$module,$id_presta)
	{	
	
	if($module=="plan")
	{
	$requete='update  egw_epce_validation set plan=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="coherence")
	{
	$requete='update  egw_epce_validation set coherence=1 where id_beneficiaire='.$id.'';
	}
	if($module=="ab_coherence")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	}
	
	if($module=="commerciaux")
	{
	$requete='update  egw_epce_validation set commerciaux=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_commerciaux")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier="",juridique="" where id_presta='.$id_presta.' ';
	}
	if($module=="financier")
	{
	$requete='update  egw_epce_validation set financier=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_financier")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique="" where id_presta='.$id_presta.' ';
	}
	if($module=="juridique")
	{
	$requete='update  egw_epce_validation set juridique=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_juridique")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique=1 where id_presta='.$id_presta.' ';
	}
	if($module=="bilan")
	{
	$requete='update  egw_epce_validation set bilan=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="tout_plan")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence="",commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	}
	if($module=="tout")
	{
	$requete='update  egw_epce_validation set epce=1,plan=1,bilan=1,coherence=1,commerciaux=1,financier=1,juridique=1 where id_presta='.$id_presta.' ';
	}
	if($module=="NSPP")
	{
	$requete='update  egw_epce_validation set epce="",plan="",bilan="",coherence="",commerciaux="",financier="",juridique="" where id_presta='.$id_presta.' ';
	}
	
		
		$resultat = mysql_query($requete) or die(mysql_error());
	}
	function voir_validation($id_presta,$id_ben)
	{
		$requete='SELECT * FROM  egw_epce_validation  where id_presta='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
	/*	if(mysql_num_rows($resultat)==1)
		{}
		else
		{
		$requete='SELECT * FROM  egw_epce_validation where id_beneficiaire='.$id_ben.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		}*/
		
			
		
		while($row = mysql_fetch_array($resultat))
		{
			$plan=$row['plan'];
			$coherence=$row['coherence'];
			$commerciaux=$row['commerciaux'];
			$financier=$row['financier'];
			$juridique=$row['juridique'];
			$bilan=$row['bilan'];
			
		}	
		return array($plan,$coherence,$commerciaux,$financier,$juridique,$bilan);
				
	
	}
	
		function get_conseiller($account_id)
	{
		
	
		
		
			
	$requete='SELECT * FROM  egw_accounts  where  account_id='.$account_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
		return $account_firstname.' '.$account_lastname;
		}
		
	}
	
	function rdv_lieu($intitule)
	{
		$requete='SELECT cal_category FROM  egw_cal  where cal_title like "%EPC93_'.$intitule.'" order by cal_id asc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
		
	while($row = mysql_fetch_array($resultat))
		{
			$cal_category=$row['cal_category'];
			
		}
		
		if($cal_category!=NULL)
		{
		$requete='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category.'%" order by cat_id asc';
		
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cat_name=$row['cat_name'];
			
		}
		
	$cat=explode("_",$cat_name);
		return $cat[2];
		}
		else
		{}
	}
	
	function update_presta($id_presta,$lc,$conseiller_id,$date_debut,$date_fin)
	{
		$deb1=explode("/",$date_debut);
		 $deb1=mktime(0,0,0,$deb1[1],$deb1[0],$deb1[2]);
		 
		 
		 $deb2=explode("/",$date_fin);
		 $deb2=mktime(0,0,0,$deb2[1],$deb2[0],$deb2[2]);
		 if($deb2=="")
		 {
			$deb2=0;
			}
	 $requete = 'Update egw_prestation set lettre_de_commande="'.$lc.'",id_ref='.$conseiller_id.',date_debut='.$deb1.',date_fin='.$deb2.'  where  id_epce='.$id_presta.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());

	$requete2='SELECT * FROM  egw_cal  where id_presta='.$id_presta.'';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat2))
		{
			$cal_description=$row['cal_description'];
			$cal_description_r=str_replace('?',''.$lc.'',$cal_description);
		
		}
		
		if(mysql_num_rows($resultat2)!=0)
		 $requete = 'Update egw_cal set cal_description="'.$cal_description_r.'"  where  id_presta='.$id_presta.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}
	function rdv_lier_presta($id_presta,$id_rdv,$cal_status)
	{
	
	 $requete = 'Update egw_cal set id_presta='.$id_presta.'  where  cal_id='.$id_rdv.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	 $requete = 'Update egw_cal_user set cal_status="'.$cal_status.'"  where  cal_id='.$id_rdv.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}
	function rdv_unlink($id_rdv)
	{
	
	 $requete = 'Update egw_cal set id_presta=0  where  cal_id='.$id_rdv.'';
	
	$resultat = mysql_query($requete) or die(mysql_error());
	
	
	
	}
	
	function date_fr($date_an)
	{
	
	//Voici les deux tableaux des jours et des mois traduits en français
$nom_jour_fr = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
$mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
        "septembre", "octobre", "novembre", "décembre");
// on extrait la date du jour
list($nom_jour, $jour, $mois, $annee) = explode('/', $date_an);

 
//Affichera par exemple : "date du jour en français : samedi 24 juin 2006."
return  $nom_jour_fr[$nom_jour].' '.$jour.' '.$mois_fr[$mois].' '.$annee;
}

	function get_conseiller_presta($id_presta)
	{
						
	$requete='SELECT id_ref FROM  egw_prestation  where  id_epce='.$id_presta.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$id_ref=$row['id_ref'];
		}
	$requete='SELECT * FROM  egw_accounts  where  account_id='.$id_ref.'';
	$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
		    $account_id=$row['account_id'];
			
		
		}
		return array($account_id,$account_lastname,$account_firstname);
	}
	
	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>