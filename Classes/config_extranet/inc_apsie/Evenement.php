<?php
/**
 * @access public
 */
 
 require_once(realpath(dirname(__FILE__)) . '/Employee.php');
  require_once(realpath(dirname(__FILE__)) . '/Categorie.php');
   require_once(realpath(dirname(__FILE__)) . '/Prestation.php');
   require_once(realpath(dirname(__FILE__)) . '/Agence.php');
    require_once(realpath(dirname(__FILE__)) . '/Banque_Texte.php');
	require_once(realpath(dirname(__FILE__)) . '/Contact.php');
	require_once(realpath(dirname(__FILE__)) . '/Messager.php');
include('config/config.php');


class Evenement {

	/**
	 * @access public
	 */
	 
	 
	 
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	 
	 	
	public function __get($nom)
	{
		return $this->$nom;
	}
	
	public function __set($nom,$valeur)
	{
		$this->$nom = $valeur;
	}
	
	public function liste_aide_nom($string,$champ)
	{
		if($champ=="nom")
		{
	$requete="SELECT * FROM egw_contact WHERE  nom LIKE '$string%' order by nom asc limit 20";
	$result=$GLOBALS['db']->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
		echo '<li onClick="fill(\''.utf8_encode($result[$i]['nom']).'\',\''.utf8_encode($result[$i]['prenom']).'\',\''.utf8_encode($result[$i]['tel_pro_1']).'\',\''.utf8_encode($result[$i]['portable_perso']).'\',\''.utf8_encode($result[$i]['email_pro']).'\',\''.utf8_encode($result[$i]['email_perso']).'\',\''.utf8_encode($result[$i]['fonction']).'\',\''.utf8_encode($result[$i]['tel_domicile_1']).'\',\''.utf8_encode($result[$i]['fax_pro']).'\');">'.utf8_encode($result[$i]['nom']).' '.utf8_encode($result[$i]['prenom']).'</li>';
	}
	
		}
		elseif($champ=="societe")
		{
	$requete="SELECT * FROM egw_organisation WHERE  nom_organisme LIKE '$string%' order by nom_organisme asc limit 20";
	$result=$GLOBALS['db']->fetchAll($requete);
	for($i=0;$i<count($result);$i++)
	{
		//$result[$i]['secteur_activite']=str_replace('/r','',$result[$i]['secteur_activite']);
		echo '<li onClick="fill_org(\''.utf8_encode($result[$i]['nom_organisme']).'\');">'.utf8_encode($result[$i]['nom_organisme']).'</li>';
	}
	
		}
	}
	
	
	public function inserer_evenement($id_owner,$civilite,$nom,$prenom,$cat_id_contact,$tel_pro,$tel_perso,$tel_domicile,$fax,$email_pro,$email_perso,$situation_pro,$cat_id_organisme,$societe,$fonction,$secteur_activite,$objet,$id_liste_presta,$id_agence,$observations,$degre,$id_referent,$type_evenement,$statut) {
		// Not yet implemented
		
		
		$valeur_sit_pro=Banque_Texte::texte_id($situation_pro);
		$valeur_secteur=Banque_Texte::texte_id($secteur_activite);
		$valeur_type_evenement=Banque_Texte::texte_id($type_evenement);
		
		$id_contact=Contact::inserer_contact($id_owner, $cat_id_contact, $nom, $prenom,'','', $civilite,'', $fonction, '','','', '', '', '', $tel_pro,'', $tel_domicile,'',$fax,'','', $tel_perso, $email_pro, $email_perso,'');
	 if($valeur_sit_pro!=NULL)
	 {
	 Contact::inserer_exp_pro($id_owner,$id_contact[1],$valeur_sit_pro,'','','','');
	 }
	 if($societe!=NULL)
	 {
	 $id_organisation=Organisation::inserer_organisation($id_owner,$cat_id_organisme,str_replace(' ','_',$societe),$societe,'','','', '', '','', '', '','', '','',$valeur_secteur);
	 Organisation::lier($id_owner,$id_contact[1],$id_organisation[1]);
	 }
	 
	$data = array('id_contact'=>$id_contact[1],'id_owner' => $id_owner, 'date_creation' => time(),'observations' => $observations,'objet'=>$objet,'degre'=>$degre,'id_referent'=>$id_referent,'id_liste_presta'=>$id_liste_presta,'id_agence'=>$id_agence,'type_evenement'=>$valeur_type_evenement,'statut'=>$statut);		
	$GLOBALS['db']->insert('egw_evenement',$data);
	$val_c=Contact::get_contact($id_contact[1]);
	
	Messager::inserer_messager($id_referent, $id_owner, 'N','Nouvel évènement : '.$val_c[0].' '.$val_c[1].' - '.$objet, $observations);
	
echo '<SCRIPT LANGUAGE="JavaScript"> 
   $obj2 ="window.parent.opener.location.reload()";
    $obj3 ="window.close()";
    setTimeout($obj2,1000);
  setTimeout($obj3,1000);

  </script>';	
	
	}

	/**
	 * @access public
	 */
	
	/**
	 * @access public
	 */
	public function supprimer_evenement() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	
	

	public function form_ajouter_evenement()
	{
	  $tab_cat=Categorie::selectionner_categorie('contact');
	  $tab_cat_org=Categorie::selectionner_categorie('organisation');
	  $tab_liste_presta=Prestation::selectionner_liste_prestation();
	  $tab_employee=Employee::selectionner_employee();
	  $tab_agence=Agence::selectionner_Agence();
	  $tab_texte_statut=Banque_Texte::selectionner_texte('Statut 1');
	  $tab_texte_secteur_activite=Banque_Texte::selectionner_texte('secteur_activite');
	  $tab_texte_t_eve=Banque_Texte::selectionner_texte('type_evenement');
	  
echo'

<div style="border:1px solid #000; background-color:# E0E0E0; width:800px; height:550px; padding:10px;"><form method="get"><input type="hidden" name="domain" value="default" /><table  style="border:1px solid #CCC; background-color:#FFF; padding:10px;"><tr>
  <td>Type de contact</td><td><select name="cat_id_contact"><option></option>';

  for($i=0;$i<count($tab_cat);$i++)
  {
echo'<option value='.$tab_cat[$i]['cat_id'].'>'.$tab_cat[$i]['cat_name'].'</option>';
  }
  
  
  echo'</select></td><td width="132"></td><td width="158"></td></tr><tr><tr>
    <td>Civilit&eacute;</td>
    <td><select name="civilite"><option></option><option>Monsieur</option><option>Madame</option><option>Mademoiselle</option></select></td><td>Situation professionnelle</td><td><select name="situation_pro">
      <option></option>
      ';

  for($i=0;$i<count($tab_texte_statut);$i++)
  {
echo'
      <option value='.$tab_texte_statut[$i]['id'].'>'.$tab_texte_statut[$i]['valeur'].'</option>
      ';
  }
  
  
  echo'
    </select></td></tr><tr><td>Nom</td><td><input id="nom" onblur="fill();" onkeyup="lookup(this.value,\'nom\');"  autocomplete="off" name="nom" /> <img src="images/loupe.png"  title="Champ de recherche..." /></td><td>Pr&eacute;nom</td><td><input id="prenom"  autocomplete="off" name="prenom" /><div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList"> &nbsp; </div>
      </div></td></tr><tr>
    <td width="199">Tel domicile</td><td width="269"><input name="tel_domicile" id="tel_domicile"/></td>
    <td>Tel perso</td><td><input id="tel_perso" name="tel_perso" /></td></tr><tr>
    <td width="199">Tel pro</td><td width="269"><input name="tel_pro" id="tel_pro"/></td>
    <td>Fax</td><td><input id="fax" name="fax" /></td></tr><tr>
    <td width="199">Email pro</td>
    <td width="269"><input name="email_pro" id="email_pro" /></td>
    <td>Email perso</td>
    <td><input name="email_perso" id="email_perso"/></td></tr>
    </table><br/><table  style="border:1px solid #CCC; background-color:#FFF; padding:10px;"><tr>
  <td width="198">Cat&eacute;gorie de l\'organisme</td><td width="272"><select name="cat_id_organisme"><option></option>';

  for($i=0;$i<count($tab_cat_org);$i++)
  {
echo'<option value='.$tab_cat_org[$i]['cat_id'].'>'.$tab_cat_org[$i]['cat_name'].'</option>';
  }
  
  
  echo'</select></td><td width="132"></td><td width="156"></td></tr><tr>
  <td width="198">Soci&eacute;t&eacute;</td><td><input type="text"  id="societe" onblur="fill();" onkeyup="lookup(this.value,\'societe\');" autocomplete="off" name="societe" id="societe" value=""/> <img src="images/loupe.png"  title="Champ de recherche..." /> <div class="suggestionsBox" id="suggestions_org" style="display: none;"><img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList_org"> &nbsp; </div>
      </div></td><td>Fonction</td><td><input  name="fonction" id="fonction" /></td></tr><tr>
  <td width="198">Secteur d\'activit&eacute;</td>
  <th align="left" colspan="3"><select name="secteur_activite" >
    <option></option>
    ';

  for($i=0;$i<count($tab_texte_secteur_activite);$i++)
  {
echo'
    <option value='.$tab_texte_secteur_activite[$i]['id'].'>'.$tab_texte_secteur_activite[$i]['valeur'].'</option>
    ';
  }
  
  
  
  echo'
  </select></th></tr></table><br/><table  style="border:1px solid #CCC; background-color:#FFF; padding:10px;"><tr><td>Type d\'évènement</td><td><select name="type_evenement"><option></option>';  for($i=0;$i<count($tab_texte_t_eve);$i++)
  {
echo'
      <option value='.$tab_texte_t_eve[$i]['id'].'>'.$tab_texte_t_eve[$i]['valeur'].'</option>
      ';
  }
  echo'</select></td><td></td><td></td></tr><tr>
      <td width="203">Objet</td>
      <td width="209"><select name="objet"><option></option><option>Absence / Report de RDV</option><option>Demande d\'information</option><option>Demande de rappel</option><option>Demande de rendez-vous</option><option>Tâche en interne</option><option>Autre</option></select></td><td width="201">Type de prestation</td><td width="155"><select name="type_presta">
    <option></option>
    ';
    for($i=0;$i<count($tab_liste_presta);$i++)
  {
echo'
    <option value='.$tab_liste_presta[$i]['id_liste_prestation'].'>'.$tab_liste_presta[$i]['intitule_prestation'].'</option>
    ';
  }
 
  
  echo'
  </select></td></tr><tr>
 </tr></table><br/><table style="border:1px solid #CCC; background-color:#FFF; padding:10px;" ><tr>
  <td width="201">Lieu d\'accueil souhaité</td><td width="565"><select name="agence"><option></option>';

  for($i=0;$i<count($tab_agence);$i++)
  {
echo'<option value='.$tab_agence[$i]['id_organisation'].'>'.$tab_agence[$i]['nom_organisme'].'</option>';
  }
  
  
  echo'</select></td></tr><tr>
  <td width="201">Observations</td>
  <td width="565"><textarea name="observations"  style="border:1px solid #CCC; font-size:11px; color: #39F"  cols="60" rows="3"></textarea></td></tr><tr>
  <td width="201">&nbsp;</td><td width="565"><input name="degre" type="radio" value="Normal" />
Normal
  <input name="degre" type="radio" value="Urgent" />
Urgent</td></tr>
  <tr>
    <td>Transmis &agrave; </td>
    <td><select name="referent"><option></option>';

  for($i=0;$i<count($tab_employee);$i++)
  {
echo'<option value='.$tab_employee[$i]['account_id'].'>'.$tab_employee[$i]['account_firstname'].' '.$tab_employee[$i]['account_lastname'].' ( '.$tab_employee[$i]['nom'].' )</option>';
  }
  
  
  echo'</select></td>
  </tr>
</table>
<br/><center> <input type="submit" value="Enregistrer" name="enregistrer" /></center>
</div></form>
';
}
	
	public function rechercher_evenement($wid,$id_referent='',$statut='')
	{
		$tab_employee=Employee::selectionner_employee();
		
		
		
	
	echo'<form ><div ><div style="float:left;background: #E9E9E9; height=50px;border:1px solid  #999; width:35%"><input  onclick="window.open(\'ajouter.php?domain=default\',\'Ajouter un évènement\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=870, height=640\');" type="button" value="Ajouter un évènement" /> </div><div style="float:left;background: #E9E9E9; height=50px;width:64%;border:1px solid  #999">
    <input type="hidden" name="wid" value="'.$wid.'" /><input type="hidden" name="domain" value="default" /><input value="'.$_GET['mot'].'" name="mot" type="text" />  <select name="id_referent">';
	
	if($id_referent!='')
	{
		$val_employee=Employee::get_employee($id_referent);
		echo'<option value="'.$id_referent.'">'.$val_employee[0].' '.$val_employee[1].'</option>';
		echo'<option value="">Tous les conseillers</option>';}
	else
	{
	echo'<option value="">Tous les conseillers</option>';
	}

  for($i=0;$i<count($tab_employee);$i++)
  {
echo'<option value='.$tab_employee[$i]['account_id'].'>'.$tab_employee[$i]['account_firstname'].' '.$tab_employee[$i]['account_lastname'].' ( '.$tab_employee[$i]['nom'].' )</option>';
  }
  
  
  echo'</select><select name="statut">';
  
  if($statut!='')
	{
		
		echo'<option value="'.$statut.'">'.$statut.'</option>';
			echo'<option  value="">Tous</option><option>Ouvert</option><option>Terminé</option>';
		}
	else
	{
	echo'<option  value="">Tous</option><option>Ouvert</option><option>Terminé</option>';
	}
	
	echo'
</select><input type="submit" value="Rechercher" /></div></div></form><br/><br/>';

	}
	
	function details_evenement($id,$id_compte)
	{
	
	
	
	$requete = 'select  e.id_contact,pp.statut ps,o.nom_organisme,e.id_owner,e.id_evenement,e.degre,e.statut,e.observations,c.nom,c.prenom,c.fonction,c.email_pro,c.email_perso,c.tel_pro_1,c.portable_perso,e.id_referent,e.date_creation ,e.objet,p.intitule_prestation from egw_evenement e,egw_contact c,egw_liste_prestation p,egw_organisation o,egw_contact_parcours_pro pp where e.id_evenement='.$id.' and c.id_ben=e.id_contact and e.id_agence=o.id_organisation and e.id_contact=pp.id_ben';
	
		
	$requete2 = 'select e.id_contact,o.nom_organisme,e.id_owner,e.id_evenement,e.degre,e.statut,e.observations,c.nom,c.prenom,c.fonction,c.email_pro,c.email_perso,c.tel_pro_1,c.portable_perso,e.id_referent,e.date_creation ,e.objet,p.intitule_prestation from egw_evenement e,egw_contact c,egw_liste_prestation p,egw_organisation o where e.id_evenement='.$id.' and c.id_ben=e.id_contact and e.id_agence=o.id_organisation ';
	
	
	

$requete4 = 'select e.id_contact,e.id_owner,e.id_evenement,e.degre,e.statut,e.observations,c.nom,c.prenom,c.fonction,c.email_pro,c.email_perso,c.tel_pro_1,c.portable_perso,e.id_referent,e.date_creation ,e.objet from egw_evenement e,egw_contact c where e.id_evenement='.$id.' and c.id_ben=e.id_contact ';
	
	$requete3 = 'select e.id_contact,pp.statut ps,o.nom_organisme,e.id_owner,e.id_evenement,e.degre,e.statut,e.observations,c.nom,c.prenom,c.fonction,c.email_pro,c.email_perso,c.tel_pro_1,c.portable_perso,e.id_referent,e.date_creation ,e.objet,p.intitule_prestation from egw_evenement e,egw_contact c,egw_liste_prestation p,egw_organisation o,egw_contact_parcours_pro pp where e.id_evenement='.$id.' and c.id_ben=e.id_contact  and e.id_agence=o.id_organisation  and e.id_contact=pp.id_ben';
	
	$result=$GLOBALS['db']->fetchRow($requete);
	if(!$result)
	{
	$result=$GLOBALS['db']->fetchRow($requete2);
	}
	if(!$result)
	{
	$result=$GLOBALS['db']->fetchRow($requete3);
	}
if(!$result)
	{
	$result=$GLOBALS['db']->fetchRow($requete4);
	}
	
	

	$val_employee=Employee::get_employee($result['id_referent']);
	$val_compte=Employee::get_employee($id_compte);
	$val_owner=Employee::get_employee($result['id_owner']);
		if($result['statut']=="Nouveau")
		{
			$statut = "<img title='Nouveau évènement' src='images/nouveau.png' >";
		}
		if($result['degre']=="Normal")
		{
			$degre = "<img title='Normal' src='images/normal.png' >";
		}
		elseif($result['degre']=="Urgent")
		{
			$degre = "<img title='Urgent' src='images/urgent.png' >";
		}
		
		if($result['portable_perso']!=NULL)
		{
		$tel=$result['portable_perso'];
		}
		elseif($result['tel_pro_1']!=NULL)
		{
		$tel=$result['tel_pro_1'];
		}
		elseif($result['tel_domicile_1']!=NULL)
		{
		$tel=$result['tel_domicile_1'];
		}
		
		
		if($result['email_pro']!=NULL)
		{
		$email=$result['email_pro'];
		}
		elseif($result['email_perso']!=NULL)
		{
		$email=$result['email_perso'];
		}
		
	//$val_employee=Employee::get_employee($result['id_referent']);
	echo'<div><div style="float:left ; width:40%"><form method="get"><table style="padding:5px;border:1px solid #CCC; background-color:#FFF;-moz-border-radius-topright: 10px; -moz-border-radius-bottomright: 10px; -moz-border-radius-bottomleft: 10px; -moz-border-radius-topleft: 10px;""><tr><td width="152">Id Evènement</td>
<td width="252">'.$result['id_evenement'].'</td></tr><tr><td>Date</td><td>'.date('dmy',$result['date_creation']).'</td></tr><tr>
  <td>Objet</td>
  <td>'.$result['objet'].'</td></tr><tr>
  <td>Prestation</td>
  <td>'.$result['intitule_prestation'].'</td></tr><tr><tr>
  <td>Lieu souhaité</td>
  <td>'.$result['nom_organisme'].'</td></tr><tr>
  <td>Transmis &agrave;</td>
  <td>'.$val_employee[0].' '.$val_employee[1].'</td></tr><tr><td >Par</td><td>'.$val_owner[0].' '.$val_owner[1].'</td></tr><tr><td>Nom du contact</td><td><a onclick="window.open(\'../'.$GLOBALS['version_contact'].'/info.php?domain=default&id_ben='.$result['id_contact'].'\',\'Dossier du contact\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=1024, height=728\');"  href="javascript::void()">'.$result['nom'].' '.$result['prenom'].'</a></td></tr><tr>
      <td>Situation pro</td>
      <td>'.$result['ps'].'</td></tr><tr>
      <td>Fonction</td>
      <td>'.$result['fonction'].'</td></tr><tr><td>Tel</td><td>'.$tel.'</td></tr><tr>
          <td>Email</td>
          <td>'.$email.'</td></tr><tr>
  <td><br/><br/></td>
  <td></td></tr><tr>
  <td>Degré</td>
  <td>'.$result['degre'].'</td></tr><tr>
  <td>Statut</td>
 <td><select onchange="submit()" name="statut_event"><option>'.$result['statut'].'</option><option>En cours</option><option>Terminé</option></select></td></tr></table><input type="hidden" value="default" name="domain" /><input name="id_evenement" value="'.$id.'" type="hidden" /></form><br/>
  Observations : <br/><br/>'.$result['observations'].'</div>';  
  echo'</div><div style="float:left; width:25%; vertical-align:top; text-align:left" ><h3><img src="images/conversation.png" /> Historique de conversations</h3>';
   
 
	$requete = 'select * from egw_evenement_details where id_evenement='.$id.' order by date desc';
	
	$result=$GLOBALS['db']->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
		$val_messager=Employee::get_employee($result[$i]['id_conseiller']);
  echo'<strong>'.date('dmy',$result[$i]['date']).'</strong> - <img src="images/user_business.png" /> '.$val_messager[0].' '.$val_messager[1].'<br/>'.$result[$i]['message'].'<br/><br/>';
	}
	
	
	
  
  echo'</div><div style="float:left; width:25%;vertical-align:middle;"><form method="get"><input type="hidden" value="default" name="domain" /><input name="id_evenement" value="'.$id.'" type="hidden" /><input type="hidden" name="id_compte" value="'.$id_compte.'" /><table><tr><td><strong>'.$val_compte[0].' '.$val_compte[1].' dit : </strong></td></tr><tr><td><textarea name="message" style="border:1px solid #CCC; font-size:11px;" cols="40" rows="5"></textarea></td></tr><tr><td><input type="submit" value="Enregistrer" /></td></tr></table></form>
 
</div>
';
  
 
}
	public function lister_evenement($largeur,$id_referent='',$statut='')
	{
		
	echo'<center><table  style=" border:1px solid #CCC;" width="'.($largeur-40).'"><tr height="25px" bgcolor="#B7B7B7"  style="color:#FFF; font-weight:bolder;text-align:center" ><td>ID</td><td ><a href="">Date</a></td><td ><a href="">Objet</a></td><td ><a href="">Type d\'évènement</a></td><td ><a href="">Nom du contact</a></td><td><a href="">Fonction</a></td><td ><a href="">Tel</a></td><td ><a href="">Presta</a></td><td><a href="">Réferent</a></td><td ><a href="">Degré</a></td><td ><a href="">Statut</a></td><td  ></td></tr>';
	
	if($_GET['mot']!=NULL and $id_referent!='' and $statut=="Ouvert")
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' and statut!="Terminé" and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction  like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
			 }
			 elseif($_GET['mot']!=NULL and $id_referent!='' and $statut=="Terminé")
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' and statut="Terminé" and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction  like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
			 }
			  elseif($_GET['mot']!=NULL and $id_referent=='' and $statut=="Terminé")
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and statut="Terminé" and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
				
				
			 }
			   elseif($_GET['mot']!=NULL and $id_referent=='' and $statut=="Ouvert")
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and statut!="Terminé" and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
				
			 }
			 
			  elseif($_GET['mot']!=NULL and $id_referent!='' and $statut=='')
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben id_referent='.$id_referent.' and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
			 }
			 
			 elseif($_GET['mot']!=NULL and $id_referent!='' and $statut=='')
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' and statut="Terminé" and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction  like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
			 }
			 elseif($_GET['mot']!=NULL and $id_referent=='' and $statut=='')
			 {
				 $requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and (e.objet like "%'.$_GET['mot'].'%" or e.type_evenement like "%'.$_GET['mot'].'%" or c.nom_complet like "%'.$_GET['mot'].'%" or c.fonction like "%'.$_GET['mot'].'%" )  order by e.date_creation desc';
				
			 }
			 
			
			 
		elseif($id_referent!='' and $statut=="Ouvert")
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' and statut!="Terminé" order by e.date_creation desc';}
	
	elseif($id_referent!='' and $statut=="Terminé")
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' and statut="Terminé" order by e.date_creation desc';}
	
	elseif($id_referent!='' and $statut=='')
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' order by e.date_creation desc';}
	
	elseif($id_referent!='')
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben and id_referent='.$id_referent.' order by e.date_creation desc';}
		
		elseif($statut=='Ouvert')
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben  and statut!="Terminé" order by e.date_creation desc';}
	
		
		elseif($statut=="Terminé")
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben  and statut="Terminé" order by e.date_creation desc';}
	
	else
	{$requete = 'select e.type_evenement,e.is_read,e.id_contact,e.id_evenement,e.date_creation,e.id_liste_presta,e.id_referent,c.cat_id,c.fonction,c.nom_complet,c.portable_perso,c.cat_id,e.objet,e.statut,e.degre from  egw_evenement e  ,egw_contact c where e.id_contact = c.id_ben order by e.date_creation desc';}
	
	
	$result=$GLOBALS['db']->fetchAll($requete);
	
	for($i=0;$i<count($result);$i++)
	{
		if($i%2 == NULL)
		{
		$color="#ECF3F4	";
		}
		else
		{
		$color="#FFF";
		}
		
		if($result[$i]['statut']=="Nouveau")
		{
			$statut = "<img title='Nouvel évènement' src='images/nouveau.png' >";
		}
		elseif($result[$i]['statut']=="En cours")
		{
			$statut = "<img title='Evènement en cours' src='images/en cours.png' >";
		}
		elseif($result[$i]['statut']=="Terminé")
		{
			$statut = "<img title='Evènement terminé' src='images/fermer.png' >";
		}
		if($result[$i]['degre']=="Normal")
		{
			$degre = "<img title='Normal' src='images/normal.png' >";
		}
		elseif($result[$i]['degre']=="Urgent")
		{
			$degre = "<img title='Urgent' src='images/urgent.png' >";
		}
		$valeur=Employee::get_employee($result[$i]['id_referent']);
	//	$valeur_cat=Categorie::get_categorie($result[$i]['cat_id']);
		$valeur_liste_presta=Prestation::get_liste_prestation($result[$i]['id_liste_presta']);
		
		if($result[$i]['tel_pro_1']!=NULL)
		{
		$tel[$i]=$result[$i]['tel_pro_1'];
		}
		elseif($result[$i]['tel_domicile_1']!=NULL)
		{
		$tel[$i]=$result[$i]['tel_domicile_1'];
		}
		elseif($result[$i]['portable_perso']!=NULL)
		{
		$tel[$i]=$result[$i]['portable_perso'];
		}
		
		if($result[$i]['is_read']==0)
		{
			$style='style="font-weight:bold"';
		}
		else
		{
		$style=NULL;
		}
		
	echo'<tr '.$style.' bgcolor="'.$color.'"><td><a href="details.php?domain=default&id_evenement='.$result[$i]['id_evenement'].'">'.$result[$i]['id_evenement'].'</a></td><td align="center">'.date('dmy | H:i',$result[$i]['date_creation']).'</td><td><a href="details.php?domain=default&id_evenement='.$result[$i]['id_evenement'].'">'.$result[$i]['objet'].'</a></td><td>'.$result[$i]['type_evenement'].'</td><td ><a  onclick="window.open(\'../'.$GLOBALS['version_contact'].'/info.php?domain=default&id_ben='.$result[$i]['id_contact'].'\',\'Dossier du contact\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=200px, width=1024, height=768\');"  href="javascript::void()">'.$result[$i]['nom_complet'].'</a></td><td >'.$result[$i]['fonction'].'</td><td >'.$tel[$i].'</td><td >'.$valeur_liste_presta.'</td><td>'.$valeur[0].' '.$valeur[1].'</td><td align="center">'.$degre.'</td><td align="center" >'.$statut.'</td><td><a href="details.php?domain=default&id_evenement='.$result[$i]['id_evenement'].'">+ de détails</a></td></tr>';
	
	}
    echo'</table></center>';
	}
	
	public function modifier_evenement_statut($id_modifier,$id_evenement,$statut)
	{
	$requete = 'select * from egw_evenement where id_evenement='.$id_evenement.'';
	$result=$GLOBALS['db']->fetchRow($requete);
	
	$data = array('date_last_modified'=>time(),'id_modifier'=>$id_modifier,'statut'=>$statut);
	$GLOBALS['db']->update('egw_evenement',$data,'id_evenement='.$id_evenement.'');
	Messager::inserer_messager($result['id_owner'], $id_modifier,'N', 'Mise à jour du statut de l\'évènement n°'.$result['id_evenement'].'', '') ;
	echo'<script>document.location.href="details.php?domain=default&id_evenement='.$id_evenement.'";</script>';
	
	}
	public function ecrire_message($id_owner,$id_evenement,$message)
	{
	
	$data = array('date'=>time(),'id_conseiller'=>$id_owner,'message'=>$message,'id_evenement'=>$id_evenement);
	$GLOBALS['db']->insert('egw_evenement_details',$data);
	
	
	$requete = 'select * from egw_evenement where id_evenement='.$id_evenement.'';
	$result=$GLOBALS['db']->fetchRow($requete);
	
	Messager::inserer_messager($result['id_referent'], $id_owner,'N', 'Nouveau message sur l\'évènement n°'.$result['id_evenement'].'', '') ;
	
	if($id_owner!=$result['id_owner'])
	{
		Messager::inserer_messager($result['id_owner'], $id_owner,'N', 'Nouveau message sur l\'évènement n°'.$result['id_evenement'].'', '') ;
	}
	
	echo'<script>document.location.href="details.php?domain=default&id_evenement='.$id_evenement.'";</script>';
	
	}

	function is_read($id_modifier,$id_evenement)
	{
		$result=$this->get_evenement($id_evenement);
		if($result['id_referent']==$id_modifier)
		{
		$data=array('is_read'=>1,'id_modifier'=>$id_modifier);
		$GLOBALS['db']->update('egw_evenement',$data,'id_evenement='.$id_evenement);
		//$this->modifier_evenement_statut($id_modifier,$id_evenement,'En cours');
		}
	}

 function get_evenement($id_evenement)
 {
		$requete = 'select * from egw_evenement where id_evenement='.$id_evenement.'';
		$result=$GLOBALS['db']->fetchRow($requete);
		return array('id_referent'=>$result['id_referent']);

 }
	/**
	 * @access public
	 */
	public function __destruct() {
		// Not yet implemented
	}
}
?>