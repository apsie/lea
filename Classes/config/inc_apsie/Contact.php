<?php
/**
 * @access public
 */
    require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
	require_once(realpath(dirname(__FILE__)) . '/Employee.php');
 include('/data/html/egw_apsie_143/Classes/config/config.php');
//include('config/config.php');
class Contact {
	/**
	 * @AttributeType string
	 */
	private $categorie;
	/**
	 * @AttributeType string
	 */
	private $nom;
	/**
	 * @AttributeType string
	 */
	private $prenom;
	/**
	 * @AttributeType string
	 */
	private $tel_pro_1;
	/**
	 * @AttributeType string
	 */
	private $tel_pro_2;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	 
	 public function liste_aide_contact($string,$champ)
	{
		if($champ=="cp")
		{
	$requete="SELECT * FROM egw_code_postaux WHERE  cp LIKE '$string%' or ville1 like '$string%'  order by cp asc limit 50";
	$result=$GLOBALS['db']->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
		echo '<li onClick="fill(\''.utf8_encode($result[$i]['cp']).'\',\''.utf8_encode($result[$i]['ville1']).'\',\''.utf8_encode($result[$i]['region']).'\',\''.utf8_encode($result[$i]['pays']).'\');">'.utf8_encode($result[$i]['cp']).' '.utf8_encode($result[$i]['ville1']).'</li>';
	}
	
		}
		
		
	}
	
	public function inserer_contact($id_owner, $cat_id, $nom, $prenom, $deuxieme_prenom, $nom_jeune_fille, $civilite, $adresse_ligne_1, $fonction, $adresse_ligne_2, $adresse_ligne_3, $ville, $region, $cp, $pays, $tel_pro_1, $tel_pro_2, $tel_domicile_1, $tel_domicile_2, $fax_pro, $fax_perso, $portable_pro, $portable_perso, $email_pro, $email_perso, $site_perso) {
		// Not yet implemented
		
		//vérification
			$requete='SELECT * from egw_contact where nom="'.$nom.'"  and   prenom="'.$prenom.'" ';
			$result=$GLOBALS['db']->fetchRow($requete);
			
			if($result['id_ben']==0 or $result['id_ben']==NULL)
			{
		
		//insertion
		$data = array('id_owner' => $id_owner, 'date_creation' => time(), 'id_modifier' => $id_owner, 'date_last_modified' => time(),'cat_id' => $cat_id, 'nom_complet' => $civilite.' '.$nom.' '.$prenom, 'nom' => $nom, 'prenom' => $prenom, 'deuxieme_prenom' => $deuxieme_prenom, 'nom_jeune_fille' => $nom_jeune_fille, 'civilite' => $civilite,  'adresse_ligne_1' => $adresse_ligne_1, 'fonction' => $fonction, 'adresse_ligne_2'=> $adresse_ligne_2, 'adresse_ligne_3'=> $adresse_ligne_3, 'ville'=> $ville, 'region'=> $region, 'cp'=> $cp, 'pays'=> $pays, 'tel_pro_1'=> $tel_pro_1, 'tel_pro_2'=> $tel_pro_2, 'tel_domicile_1'=> $tel_domicile_1, 'tel_domicile_2'=> $tel_domicile_2, 'fax_pro'=> $fax_pro, 'fax_perso'=> $fax_perso, 'portable_pro'=> $portable_pro, 'portable_perso'=> $portable_perso, 'email_pro'=> $email_pro, 'email_perso'=> $email_perso, 'site_perso'=> $site_perso);
				
	$GLOBALS['db']->insert('egw_contact',$data);
		
		//retour
		$requete='SELECT id_ben from egw_contact order by id_ben  desc ';
		$result=$GLOBALS['db']->fetchRow($requete);
		return array(1,$result['id_ben']);
			}
			else
			{
	
			
			 
			 return array(0,$result['id_ben']);
			}
			

	
	}
	public function form_editeur_requete()
	{
		$liste_presta=Prestation::selectionner_liste_prestation();
		$employee=Employee::selectionner_employee();
		if(isset($_GET['conseiller_id']))
		{
		$employee_recup = Employee::get_employee($_GET['conseiller_id']);
		}
		else
		{
		$_GET['conseiller_id']=NULL;
		$employee_recup[0]=NULL;
		$employee_recup[1]=NULL;
		}
		echo'<html><head><link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue"><script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script> </head><body>
<br>


<div style=" width:400px; background-color:#FFF; padding:10px; border:1px solid #CCC"><center>
  <h2>Editeur de requ&ecirc;te</h2></center>
<strong>Rechercher les contacts par critères</strong> :<br/>
<br/><form method="get" ><table  >		
<tr bgcolor="#FFF">
  <td width="73"><i>Prestation</i></td>
  <td width="100" ><select name="type_presta"><option>'.$_GET['type_presta'].'</option>';
 for($i=0;$i<count($liste_presta);$i++)
 {
	 echo '<option>'.$liste_presta[$i]['intitule_prestation'].'</option>';}
  
  echo'</select></td><td>Statut</td><td><select name="statut_presta"><option>'.$_GET['statut_presta'].'</option><option>Nouvelle</option><option>En cours</option><option>Abandon</option><option>Annulee</option><option>Complete</option></select></td>
</tr><tr><td>Conseiller</td><td><select name="conseiller_id"><option value='.$_GET['conseiller_id'].'>'.$employee_recup[0].' '.$employee_recup[1].'</option>';

for($i=0;$i<count($employee);$i++)
 {
	 echo '<option value="'.$employee[$i]['account_id'].'">'.$employee[$i]['account_firstname'].' '.$employee[$i]['account_lastname'].'</option>';}

if(isset($_GET['date_debut']))
			   {
				  $val_deb = $_GET['date_debut'];
				}
				else
				{ $val_deb ='01/01/'.date('Y').'';
				}
if(isset($_GET['date_fin']))
			   {
				  $val_fin = $_GET['date_fin'];
				}
				else
				{ $val_fin =date('d/m/Y');
				}

if($_GET['delai']==3)
			   {
				  $val_delai = 'Moins de 3 mois';
				}
elseif($_GET['delai']==2)
			   {
				  $val_delai = 'Entre 3 à 6 mois';
				}
elseif($_GET['delai']==1)
			   {
				  $val_delai = 'Entre 6 mois à 1 an';
				}
if($_GET['avis']==1)
			   {
				  $val_avis = 'Négatif';
				}
elseif($_GET['avis']==2)
			   {
				  $val_avis = 'Positif sous réserve';
				}
elseif($_GET['avis']==3)
			   {
				  $val_avis = 'Positif';
				}
				
elseif($_GET['avis']!=NULL)
			   {
				  $val_avis = 'Positif - Positif sous réserve';
				}				
echo'</select></td><td></td></tr><tr><td>Du</td><td><input size="8" type="text" id="date_debut" name="date_debut" value="'.$val_deb.'"  /> <script type="text/javascript"> document.writeln(\'<img id="date_debut-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>\');
	Calendar.setup(
	{
		inputField  : "date_debut",
		button      : "date_debut-trigger"
	}
	);</script> </td><td>au</td><td><input size="8" type="text" id="date_fin" name="date_fin" value="'.$val_fin.'" /> <script type="text/javascript"> document.writeln(\'<img id="date_fin-trigger" src="index.php_fichiers/datepopup.gif" title="Selectionner la date" style="cursor:pointer; cursor:hand;"/>\');
	Calendar.setup(
	{
		inputField  : "date_fin",
		button      : "date_fin-trigger"
	}
	);</script></td></tr><tr><td>Avis</td><td><select name="avis"><option value='.$_GET['avis'].'>'.$val_avis.'</option><option value="3">Positif</option><option value="2">Positif sous réserve</option><option value="Positif - Positif sous réserve">Positif - Positif sous réserve</option><option value="1">Négatif</option></select></td><td>Délai</td><td><select name="delai"><option value='.$_GET['delai'].'>'.$val_delai.'</option><option value="3">Moins de 3 mois</option><option value="2">Entre 3 à 6 mois</option><option value="1">Entre 6 mois à 1 an</option></select></td></tr>
	<tr height="40px";><td></td><td><input name="enregistrer" type="submit" value="Rechercher"> <input onclick="window.location.href=\'editeur_requete.php?domain=default\'" type="button" value="Innitialiser"></td></tr>
</table></form></div>

</body></html>';
}
	function inserer_exp_pro($id_owner,$id_ben,$statut,$indemnite,$identifiant,$date_inscription,$organisme)
	{
		$dat=explode("/",$date_inscription);
	


	
    $data = array('id_owner' => $id_owner ,'id_ben' => $id_ben , 'date_creation'=> time() , 'id_modifier'=> $id_owner , 'date_last_modified'=> time() ,'statut' => $statut, 'identifiant'=> $identifiant , 'organisme'=> $organisme ) ;
			
		
	$GLOBALS['db']->insert('egw_contact_parcours_pro',$data);

	
	}
	public function controler_requete()
	{
	if(isset($_GET['enregistrer']))
			 
			 {
				
				echo '<script>window.parent.opener.location.href="index.php?domain=default&editeur='.$_GET['type_presta'].','.$_GET['statut_presta'].','.$_GET['conseiller_id'].','.$_GET['date_debut'].','.$_GET['date_fin'].','.$_GET['avis'].','.$_GET['delai'].'";</script>';
			 }
	}

function get_contact($id_contact=NULL)
	{
		if($id_contact!=NULL or $id_contact!=0)
		{
			$requete = 'Select *  from egw_contact where id_ben= '.$id_contact.'';
			
			}
		elseif($this->id_contact!=NULL or $this->id_contact!=0)
		{
		$requete = 'Select *  from egw_contact where id_ben= '.$this->id_contact.'';
		}
		else
		{return NULL;}
		
		$result=$GLOBALS['db']->fetchRow($requete);
		return array($result['nom'],$result['prenom']);
	}
	
	function get_contact_array($id_contact=NULL)
	{
		if($id_contact!=NULL or $id_contact!=0)
		{
			$requete = 'Select *  from egw_contact where id_ben= '.$id_contact.'';
			
			}
		elseif($this->id_contact!=NULL or $this->id_contact!=0)
		{
		$requete = 'Select *  from egw_contact where id_ben= '.$this->id_contact.'';
		}
		else
		{return NULL;}
		
		return $GLOBALS['db']->fetchRow($requete);
		
	}
	
	/**
	 * @access public
	 */
	public function supprimer_contact() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function modifier_contact() {
		// Not yet implemented
	}
}
?>
