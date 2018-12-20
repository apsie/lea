<?php
 
class epce
{
	public $cat_id_owner ;
	//public $lid_owner ;
	public $cat_id_beneficiaire ;
	public $cat_id_prescripteur ;
	public $cat_id_employeur;
	public $usager_annee;

	/*public $db_user ="egroupware";
	public $db_pass ="123456";
	public $db_host ="localhost";
	public $db_name ="lea";
*/
	
	public $db;
public $db_host ="localhost";
	public $db_name ="lea";
	public $db_user ="root";
	public $db_pass ="Tim.01Mysqlv1";
	
	
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

	//$resultat = $db->query($requete);
	$requete = "insert into egw_prestation value ('','$id','EPCE','$n_family $n_given','$lettre','$time1','$time2','En cours')";

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
	
	function afficher_contact($choix,$categorie,$annee)
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
		echo'<form id="form" action="intermediaire.php" method="post" ><input type="hidden" name="id_ben" value="'.$choix.'" /><span class="titre">Ses prescripteurs</span> <input onblur="fill_safir();" onkeyup="lookup_safir(this.value);"  id="code_safir"  name="code_safir" type="text" /> <img title="Ajouter / selectionner le contact du prescripteur" onclick="javascript:voir_contact();" src="../images/user_16.png" /> <div class="suggestionsBox" id="suggestions_safir" style="display: none;"> <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList_safir"> &nbsp; </div>
      </div><div style="position:absolute; border:1px solid #666; background:#EEE; display:none;  top: 500px; left:300px; height: 237px; width: 212px;" id="contact_p"><center><strong>Contact du prescripteur</strong></center><br/><table><tr><td width="80">Civilite</td><td width="123"><select style="width:120px"  name="civilite_p"><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select></td></tr><tr><td>Nom</td><td><input style="border:1px solid #0C0" type="text"  name="nom_p" /></td></tr><tr><td>Prenom</td><td><input style="border:1px solid #0C0" type="text" onchange="mail();"  name="prenom_p" /></td></tr><tr><td>Fonction</td><td><select  style="width:120px" name="fonction_p"><option value="Conseiller">Conseiller</option></select></td></tr><tr><td>Tel bureau</td><td><input type="text"  name="tel_bureau_p" /></td></tr><tr><td>Tel portable</td><td><input type="text"  name="tel_portable_p" /></td></tr><tr><td>Email bureau</td><td><input type="text"  name="email_bureau_p" /></td><tr><td>Email domicile</td><td><input type="text"  name="email_domicile_p" /></td></tr></table></div> <input type="submit" value="Ajouter"/></form><hr style="border:1px dashed #CCC" />
<table width="100%">
  <tr  style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; "  ><td width="19%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="14%">Telephone bureau</td><td width="14%">Telephone portable</td><td width="16%">Email</td><td width="12%">Fonction</td><td width="7%"></td></tr>';
  
  if(isset($link_id2[0]) and $link_id2[0]!=NULL)
	{
		$requete='SELECT * FROM  egw_addressbook  WHERE (id=0 '.$r_tableau.') and cat_id='.$this->cat_id_prescripteur.' order by org_name asc';
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
		echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_bureau.'</td><td width="14%">'.$tel_portable.'</td><td width="16%">'.$email_bureau.'</td><td width="12%">'.$fonction.'</td><td width="7%"><a target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.view&contact_id='.$id_pr.'"><img border="0" src="../images/view.png" /></a> <a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"><img border="0" src="../images/edit.png" /></a> <a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
			else
			{
			echo'<tr ><td width="19%" height="21" 
			><a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"">'.$org_name.'</a></td><td width="18%" >'.$civilite.' '.$nom.' '.$prenom.'</td><td width="14%">'.$tel_work.'</td><td width="14%">'.$tel_cell.'</td><td width="16%">'.$email.'</td><td width="12%">'.$fonction.'</td><td width="7%"><a target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.view&contact_id='.$id_pr.'"><img border="0" src="../images/view.png" /></a> <a  target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id_pr.'"><img border="0" src="../images/edit.png" /></a> <a href="../inc/update.php?id_ben='.$choix.'&id='.$id_pr.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
			}
		
	}
		echo'</table><br/><br/>';
			echo'<span class="titre">Ses employeurs</span>  | <a href="employeur.php?id='.$choix.'"><img border="0" src="./images/plus_16.png" /> Nouveau employeur</a><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="9%">Date</td><td width="10%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="14%">Telephone bureau</td><td width="14%">Telephone portable</td><td width="12%">Poste</td><td width="10%">Qualification</td><td width="6%">Contrat</td><td width="7%"></td></tr>';
  
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
			echo'<tr ><td width="9%">'.$date_debut_poste.' - '.$date_fin_poste.'</td><td width="10%" height="21" 
			><a target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id.'">'.$org_name.'</a></td><td width="18%" >'.$fn.'</td><td width="14%">'.$tel_work.'</td><td width="14%">'.$tel_cell.'</td><td width="12%">'.$poste.'</td><td width="10%">'.$qualification.'</td><td width="6%">'.$contrat.'</td><td width="7%"> <a target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.view&contact_id='.$id.'"><img border="0" src="../images/view.png" /></a> <a target="blank_" href="../../../index.php?menuaction=addressbook.uicontacts.edit&contact_id='.$id.'"><img border="0" src="../images/edit.png" /></a><a href="../inc/update.php?id_ben='.$choix.'&id='.$id.'&categorie='.$categorie.'&annee='.$annee.'"><img border="0" src="../images/delete.png" /></a></td></tr>';
		}
	}
		echo'</table><br/><br/><br/>';
		
		
		echo'<span class="titre">Ses Projets</span><hr style="border:1px dashed #CCC" /><table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; "><td width="19%" height="21" class="titre2">Id de projet</td><td width="7%" >Temps prevu</td><td width="7%">Temps poses</td><td width="17%">...</td><td width="12%">...</td><td width="12%">Etat</td><td width="5%"></td></tr>';
  
  		$requete='SELECT * FROM  egw_addressbook  WHERE id='.$choix.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$n_family2=$row['n_family'];
			$n_given2=$row['n_given'];
		}
		
		
		
		$requete='SELECT * FROM  phpgw_p_projects  WHERE title="'.$n_family2.' '.$n_given2.'"';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$p_number=$row['p_number'];
			$project_id=$row['project_id'];
				$time_planned=$row['time_planned'];
				$temps=$time_planned/60;
		}
		if(isset($project_id) and $project_id!=NULL)
		{
		$requete='SELECT * FROM  phpgw_p_hours  WHERE project_id='.$project_id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$minutes=$row['minutes'];
			$minutes=$minutes+$minutes;
			$minutes=$minutes/120;
		}
				echo'
<form><tr><td><a target="blank_" href="../index.php?menuaction=projects.uiprojecthours.list_hours&project_id='.$project_id.'&action=hours&pro_main=">'.$p_number.'</a></td><td><font color="#F00">'.$temps.'</font> h</td><td><font color="#F00">'.$minutes.'</font> h</td><td style="font-size:10px"></td></tr></form>';
		}
		/*else
		{
		echo'
<form><tr><td><a target="blank_" href="../index.php?menuaction=projects.uiprojecthours.list_hours&project_id='.$project_id.'&action=hours&pro_main=">'.$p_number.'</a></td><td></td><td></td><td style="font-size:10px"></td></tr></form>';

		}
	*/
  
echo'</table><br/><br/><br/>';
		
/*		<br/><br/>
<span class="titre">Employeur</span><?php echo ' de '.$choix;?>   | <a href="#"><img border="0" src="./images/plus_16.png" /> Creer un employeur</a>
<hr style="border:1px dashed #CCC" /><table style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; " width="100%">
  <tr class="titre"><td width="19%" height="21" class="titre2">Nom de la societe</td><td width="18%" >Contact</td><td width="17%">Telephone bureau</td><td width="17%">Telephone portable</td><td width="12%">Url</td><td width="12%">Email</td><td width="5%"></td></tr></table><br/><br/>*/
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
	
	function selectionner_rdv_plan($choix)
	{
	
	
	  echo'
<table style="border:1px dotted #CCC">
  <tr  style="font-weight:bolder" ><td width="300px"  class="titre2">Entretient / objectif</td><td >Date de prevu</td><td >heure</td></tr>';
		$requete='SELECT * FROM  egw_links  where link_app1="calendar" and link_app2="addressbook" and link_id2='.$choix.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$link_id1[]=$row['link_id1'];
		
		
		}
		
		for ($i=0;$i<count($link_id1);$i++)
		{
		$req=$req.' or cal_id='.$link_id1[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' ) and cal_status!="R" order by cal_id desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
		
		}
		for ($i=0;$i<count($cal_id);$i++)
		{
		$req2=$req2.' or cal_id='.$cal_id[$i];
		}
		$requete2='SELECT * FROM  egw_cal_dates  where cal_id=0 '.$req2.' order by cal_start asc';
	
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		$c=1;
		while($row = mysql_fetch_array($resultat2))
		{
			
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end_=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			//$cal_start_=date('d/m/Y | H\h i\m\i\n ', $cal_start);
			$cal_start_=date('d/m/Y', $cal_start);
			$heure_start_=date('H', $cal_start);
	
		if($c==1)
		$inti='Adequation personne / projet';
		if($c==2)
		$inti='Evaluation economique du projet';
		if($c==3)
		$inti='Evaluation financiere du projet';
		if($c==4)
		$inti='Evaluation juridique';
		
		
	
		echo'<tr><td width="200px" style="color:#059610">'.$inti.'</td><td>'.$cal_start_.'</td><td>'.$heure_start_.'h</td></tr>';
		
		
			
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
	function nbre_rdv_plan($choix)
	{
	
	
	
		$requete='SELECT * FROM  egw_links  where link_app1="calendar" and link_app2="addressbook" and link_id2='.$choix.' ';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$link_id1[]=$row['link_id1'];
		
		
		}
		
		for ($i=0;$i<count($link_id1);$i++)
		{
		$req=$req.' or cal_id='.$link_id1[$i];
		}
		$requete='SELECT cal_id FROM  egw_cal_user where (cal_id=0 '.$req.' ) and cal_status!="R" order by cal_id desc';
	
		$resultat = mysql_query($requete) or die(mysql_error());
	
		
		return mysql_num_rows($resultat);
		
	}
	
	
	function selectionner_rdv($choix)
	{
	
	
	  echo'<a name="rdv" id="rdv"></a><span class="titre">Ses rendez-vous</span> | <a  href="../pose_rdv.php?choix='.$choix.'">Nouveau rendez-vous</a><hr style="border:1px dashed #CCC" />
<table  width="100%">
  <tr style="background:url(./images/level2Bg.gif) repeat-x; background-position:bottom; height:25px; " ><td width="19%" height="21" class="titre2">Intitule du rendez-vous</td><td width="18%" >Date de debut</td><td width="17%">Date de fin</td><td width="17%">Categorie</td><td width="12%">Participants</td><td width="5%">Statut</td></tr>';
		$requete='SELECT * FROM  egw_links  where link_app1="calendar" and link_app2="addressbook" and link_id2='.$choix.'  order by link_id asc ';
		$resultat = mysql_query($requete) or die(mysql_error());
		$nbreLignes = mysql_num_rows($resultat);
		while($row = mysql_fetch_array($resultat))
		{
			$link_id1=$row['link_id1'];
		
		
		$requete2='SELECT * FROM  egw_cal_dates  where cal_id='.$link_id1.' order by cal_start asc';
		
		$resultat2 = mysql_query($requete2) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat2))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end_=date('d/m/Y | H\h i\m\i\n ', $cal_end);
			$cal_start_=date('d/m/Y | H\h i\m\i\n ', $cal_start);
		
		$requete3='SELECT * FROM  egw_cal  where cal_id='.$link_id1.' ';
		
		$resultat3 = mysql_query($requete3) or die(mysql_error());
		while($row = mysql_fetch_array($resultat3))
		{
			$cal_title=$row['cal_title'];
			$cal_category=$row['cal_category'];
			
		
			
				$requete4='SELECT cat_name FROM  egw_categories  where cat_id like "%'.$cal_category.'%" ';
				
		$resultat4 = mysql_query($requete4) or die(mysql_error());
		while($row = mysql_fetch_array($resultat4))
		{
			$cat_name[]=$row['cat_name'];
		
			
		}
			
				$requete5='SELECT * FROM  egw_cal_user  where cal_id='.$link_id1.' ';
		$resultat5 = mysql_query($requete5) or die(mysql_error());
		while($row = mysql_fetch_array($resultat5))
		{
			$cal_user_id=$row['cal_user_id'];
			$cal_status=$row['cal_status'];
			
			
		}
				$requete6='SELECT * FROM  egw_accounts  where account_id='.$cal_user_id.' ';
		$resultat6 = mysql_query($requete6) or die(mysql_error());
		while($row = mysql_fetch_array($resultat6))
		{
			$account_firstname=$row['account_firstname'];
			$account_lastname=$row['account_lastname'];
			
		}
		echo'<form action="panel.php#rdv" method="get"><tr><td><a target="_blank"  href="../../../index.php?menuaction=calendar.uiforms.view&cal_id='.$link_id1.'&date=">'.$cal_title.'</a></td><td width="18%" >'.$cal_start_.'</td><td width="17%">'.$cal_end_.'</td><td width="17%"><font color="#FF3300">';
		
		echo $cat_name[0];
		
		
		
		
		
		echo'</font></td><td width="12%">'.$account_firstname.' '.$account_lastname.'</td><td><input type="hidden" name="id_rdv" value="'.$link_id1.'" /><input type="hidden" name="choix" value="'.$choix.'" /><select onchange="submit()" name="stat" style="width:40px;"><option>'.$cal_status.'</option><option value="A">A</option><option value="R">R</option></select></td></tr></form>';
			}
	}
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
	
				$requete='SELECT * FROM  egw_cal  where cal_title like "%Option%" and cal_owner='.$conseiller_id.'';
				}
				else
				{
				$requete='SELECT * FROM  egw_cal  where cal_title like "%Option%" ';
				}
		
		}
		else
		{
			
			 if($conseiller_id!=NULL)
 				{
		$requete='SELECT * FROM  egw_cal  where cal_title like "%Option_'.$lieu.'"  and cal_owner='.$conseiller_id.'';
				}
				else
				{
				$requete='SELECT * FROM  egw_cal  where cal_title like "%Option_'.$lieu.'"';
				}
		}
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_id[]=$row['cal_id'];
			$cal_title[]=$row['cal_title'];
			$cal_owner[]=$row['cal_owner'];
		}
		
		
	
	
	$taille = count($cal_id);
	$nb=0;
	for($i=0 ; $i<$taille ; $i++)
	{
	$nb++;
			
			$requete='SELECT * FROM  egw_accounts  WHERE account_id='.$cal_owner[$i].'';
 
	
   
	$resultat = mysql_query($requete) or die(mysql_error());

	//$resultat = $db->query($requete);
	
	while($row = mysql_fetch_array($resultat)){
	$account_firstname=$row['account_firstname'];	
	$account_lastname=$row['account_lastname'];	
	}
	
			$requete='SELECT * FROM  egw_cal_dates  where cal_id='.$cal_id[$i].' and cal_start >'.$timestamp.' order by cal_start desc';
		$resultat = mysql_query($requete) or die(mysql_error());
		while($row = mysql_fetch_array($resultat))
		{
			$cal_end=$row['cal_end'];
			$cal_start=$row['cal_start'];
			$cal_end=date('d/m/Y  H\h i\m\i\n ', $cal_end);
			$cal_start=date('d/m/Y  H\h i\m\i\n ', $cal_start);
			
			echo '<tr><td style="border-right:1px solid #CCC"><font color="red">'.$cal_title[$i].'</font> </td><td style="border-right:1px solid #CCC">'.$account_firstname.' '.$account_lastname.'</td><td style="border-right:1px solid #CCC"> '.$cal_start.' </td><td style="border-right:1px solid #CCC"> '.$cal_end .'</td><td ><input name="option[]" type="checkbox" value="'.$cal_id[$i].'" /></td></tr>';
		
		
	}
	
			
		
			
		}
		
		echo'</table><br/><a href="#" onclick="javascript:Check_all(true);">Tout cocher</a> <input type="submit" value="Confirmer l\'option"></form></div>';
	}
	
	
		function link_rdv($id_recup,$id_cal)
	{
		
	

	
	
		
		$requete='Insert into egw_links value("","calendar","'.$id_cal.'","addressbook","'.$id_recup.'","","","'.$this->cat_id_owner.'")';
		//echo $requete;
		$resultat= mysql_query($requete) or die(mysql_error());
		
	
	}
	function link_beneficiaire_calendar($id_recup,$opt,$nb,$n_given,$n_family,$tel_work,$tel_cell,$lc,$pole_id,$nom_p,$prenom_p)
	{
		$opt = explode("-", $opt);
		
	

	
	for($i=0;$i<$nb;$i++)
	{
		
		$requete='Insert into egw_links value("","calendar","'.$opt[$i].'","addressbook","'.$id_recup.'","","","'.$this->cat_id_owner.'")';
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
		$requete2='Update egw_cal set cal_description="Tel Bureau : '.$tel_work.' - Tel portable : '.$tel_cell.' - LC N° '.$lc.' -
ID. '.$pole_id.'
- Prescripteur : '.$nom_p.' '.$prenom_p.'",cal_title="'.$ti[0].'_'.$ti[1].'_'.$n_family.' '.$n_given.'" where cal_id='.$opt[$i].'';
		$resultat2= mysql_query($requete2) or die(mysql_error());
		
		
	
	}
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
		
		echo'<select name="conseiller_id">';
		if($conseiller!=NULL)
		{
		
		echo'<option value='.$id.'>'.$conseiller.'</option>';
		}
		
	
			
		$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" order by account_firstname asc';
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
		
		
			
	$requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" order by account_firstname asc';
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
		
		
		echo'<hr /><form name="test" action="poser.php" method="get"><table><tr><td><font color=red>'.$account_firstname.' '. $account_lastname.' </font>pour prestations</td><td><select name="prestation"> <option value="EPC93">EPC93</option><option value="NACRE1">NACRE1</option><option value="NACRE3">NACRE3</option><option value="PDI92">PDI92</option><option value="MCA">MCA</option><option value="EPI_SE">EPI_SE</option><option value="EPI_BP">EPI_BP</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$account_firstname.' '.$account_lastname.'" /></td></tr></table>';
		
		
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
	
	function chercher_rdv($date_choisi,$selection,$plage1,$plage2,$duree,$conseiller_id,$lieu,$nombre,$jour,$choix)
	{
	
		$retour=$this->variable_beneficiaire($choix);
		
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
		
		echo'<hr /><form name="test" action="poser_rdv.php" method="get"><input type="hidden" name="choix" value="'.$choix.'"><input type="hidden" name="name" value="'.$retour[3].' '.$retour[1].'" <strong>BENEFICIAIRE</strong> : '.$retour[3].' '.$retour[1].'<table><tr><td><font color=red>'.$account_firstname.' '. $account_lastname.' </font>pour prestations</td><td><select name="prestation"> <option value="EPC93">EPC93</option></select> a partir du '.$date_choisi.'</td><td><input  name="lieu" type="hidden" value="'.$lieu.'" /><input type="hidden" name="conseiller_id" value='.$conseiller_id.' /><input type="hidden" name="date_choisi" value='.$date_choisi.' /><input type="hidden" name="conseiller" value="'.$account_firstname.' '.$account_lastname.'" /></td></tr></table>';
		
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
	$x++;
	
   echo '<table ><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.$_j[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time1[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time2[$maCle]).'</td><td ><input name="pose[]" value="'.$time1[$maCle].'-'.$time2[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z>$nombre)
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
	$x++;
   echo '<table ><tr><td width="50" style="color:#0C0" >'.$x.'</td><td width="100">'.$_j6[$maCle].'</td><td> '.date(' d/m/Y | H:00',$time16[$maCle]).'</td><td >'.date(' d/m/Y | H:00',$time26[$maCle]).'</td><td ><input name="pose[]" value="'.$time16[$maCle].'-'.$time26[$maCle].'" type="checkbox" /></td></tr></table>';
	}
	if($z>$nombre)
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
	
	function inserer_cal_dates($id,$cal_start, $cal_end)
	{
		
	$requete = 'insert into egw_cal_dates value ("'.$id.'","'.$cal_start.'", "'.$cal_end.'")';
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}	
	function selectionner_cal_dates($opt)
	{
		$opt = explode("-", $opt);
	
	
	
		
	    $requete='SELECT * FROM  egw_cal_dates  where cal_id='.$opt[0].' order by cal_id asc limit 1';
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
	
	function inserer_cal($titre,$lieu,$createur,$conseiller_id)
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
		else
		{
		$requete='SELECT * FROM  egw_categories where cat_name="Crea_93_'.$lieu.'" limit 1';
		}
		$resultat = mysql_query($requete) or die(mysql_error());
		
		while($row = mysql_fetch_array($resultat))
		{
			$cat_id=$row['cat_id'];
			
		}
			
	$requete='Insert into egw_cal value("","","'.$conseiller_id.'","'.$cat_id.'","'.time().'","2","1","'.$titre.'","","","0","'.$account_id.'","")';
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
	
	$opt = explode("-", $opt);
	
	
	
		
	    $requete='SELECT * FROM  egw_cal  where cal_id='.$opt[0].' limit 1';
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
			
			echo'<option value='.$id.'>'.$valeur.'</option>';
			
			
			
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

	
	function inserer_presta($id_ben,$nom,$prenom,$lettre_commande,$presta,$statut,$debut)
	{
		$deb=explode("/",$debut);
		 $deb=mktime(0,0,0,$deb[1],$deb[0],$deb[2]);
	$requete = "insert into egw_prestation value ('','$id_ben','$presta','$nom $prenom','$lettre_commande','$deb','','$statut')";
	//echo $requete;
	$resultat = mysql_query($requete) or die(mysql_error());
	
	}	
	function update_presta_epce($id_ben,$statut)
	{
	 $requete = 'Update egw_prestation set statut="'.$statut.'"  where  presta="EPCE" and id_ben='.$id_ben.'';
	
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
	
	function valider($id,$module)
	{	
	
		$requete='SELECT * FROM  egw_epce_validation  where id_beneficiaire='.$id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
				
		//Si la requete est null appeler la fonction inserer
		$nbr=mysql_num_rows($resultat);
		if ($nbr==0)
		{
			$this->inserer_valider($id,$module);
		}
		else
		{
		 $this->update_valider($id,$module);
		}
				
	}
	function inserer_valider($id,$module)
	{	
	
	if($module=="plan")
	{
	$a = 1;
	}
	if($module=="coherence")
	{
	$b = 1;
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
	$c = 1;
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
	$d = 1;
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
	$e = 1;
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
	$f = 1;
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
		$requete='insert into egw_epce_validation value ("","'.$id.'","'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","'.$f.'","'.$g.'")';
		
		$resultat = mysql_query($requete) or die(mysql_error());
	}
		
		function update_valider($id,$module)
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
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux="",financier="",juridique="" where id_beneficiaire='.$id.' ';
	}
	
	if($module=="commerciaux")
	{
	$requete='update  egw_epce_validation set commerciaux=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_commerciaux")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier="",juridique="" where id_beneficiaire='.$id.' ';
	}
	if($module=="financier")
	{
	$requete='update  egw_epce_validation set financier=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_financier")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique="" where id_beneficiaire='.$id.' ';
	}
	if($module=="juridique")
	{
	$requete='update  egw_epce_validation set juridique=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="ab_juridique")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence=1,commerciaux=1,financier=1,juridique=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="bilan")
	{
	$requete='update  egw_epce_validation set bilan=1 where id_beneficiaire='.$id.' ';
	}
	if($module=="tout_plan")
	{
	$requete='update  egw_epce_validation set epce=0,plan=1,bilan="",coherence="",commerciaux="",financier="",juridique="" where id_beneficiaire='.$id.' ';
	}
	if($module=="tout")
	{
	$requete='update  egw_epce_validation set epce=1,plan=1,bilan=1,coherence=1,commerciaux=1,financier=1,juridique=1 where id_beneficiaire='.$id.' ';
	}
	
		
		$resultat = mysql_query($requete) or die(mysql_error());
	}
	function voir_validation($id)
	{
		
		$requete='SELECT * FROM  egw_epce_validation  where id_beneficiaire='.$id.'';
		$resultat = mysql_query($requete) or die(mysql_error());
			
		
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
	
	
	function _destruct()
	{
	mysql_close($this->db);
	
	session_destroy();
	
	}
	
}
?>