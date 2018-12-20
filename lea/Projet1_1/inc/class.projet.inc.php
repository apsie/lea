<?php
/**
*   APSIE - base de données Lea
*
*   Code revu par :
*   SPIREA- 16/20 avenue de l'agent Sarre
*   Tél : 0141192772
*   Email : contact@spirea.fr
*   www : www.spirea.fr
*
*   Reproduction, utilisation ou modification interdite sans autorisation
*/

/**
* Classe projet  class.projet.inc.php
*
* Appelé depuis : Module Projet / page détail
* Traitement :
* R
* Fonctions ou écrans suivants :
*/

class projet
{
    public $table_dispositif = "egw_dispositif";
    public $table_critere = "egw_critere";
    public $table_objectif = "egw_objectif";
    public $table_prestation = "egw_prestation";
    public $table_projet = "egw_projet";
    public $table_accounts= "egw_accounts";
    public $table_projet_organisation = "egw_resacc";
    public $table_investissement ="egw_resacc_besoin_fi";
    public $table_financement ="egw_resacc_ressources_fi";
    public $table_produits ="egw_resacc_produits";
    public $table_cr3 ="egw_resacc_cr3";
    public $table_aide_crea ="egw_resacc_aide_creation";
    public $table_produits_evo ="egw_resacc_produits_evo";
    public $table_organisation ="egw_organisation";
    public $table_contact ="egw_contact";
    public $id_group_apsie = '-3007';
    public $id_group_stragefi = '-3008';
    public $cat_id_contact_financier=261;
    public $cat_id_org_financier=240;

     
     
    public $db;
 
    function __construct()
    {
        include('../../Classes/config/config.php');
        $this->db = $GLOBALS['db'];
    }
    public function __get($nom)
    {
        return $this->$nom;
    }
    
    public function __set($nom, $valeur)
    {
        $this->$nom = $valeur;
    }
    
    function texte($champ, $select = "asc", $table = "egw_epce_texte", $sous_famille = '')
    {
        if ($sous_famille!=null and is_numeric($sous_famille)) {
            $requete='SELECT * FROM  '.$table.' where id_sous_famille='.$sous_famille.' and  intitule="'.$champ.'" order by  valeur '.$select.'';
        } else {
            $requete='SELECT * FROM  '.$table.' where intitule="'.$champ.'" order by  valeur '.$select.'';
        }
        
        
        $result=$this->db->fetchAll($requete);

        for ($i=0; $i<count($result); $i++) {
            echo '<option value='.$result[$i]['id'].'>'.utf8_encode($result[$i]['valeur']).'</option>';
        }
    }
    function return_cr3($id_resacc_cr3)
    {
    // echo "ici";
        $requete='SELECT * FROM  '.$this->table_cr3.' where id_resacc_cr3="'.$id_resacc_cr3.'"';
        $result=$this->db->fetchRow($requete);
    
        return array($result['type_produits'],$result['intitule_compte'],$result['montant_a1'],$result['montant_a2'],$result['montant_a3'],$result['cf_a2'],$result['cf_a3'],$result['tva'],$result['delai'],$result['part_delai'],$result['vent'],$result['evo']);
    }
    function return_aide_crea($id_resacc_aide_crea)
    {
    
        $requete='SELECT * FROM  '.$this->table_aide_crea.'   where id_resacc_aide_creation='.$id_resacc_aide_crea.'';
        $result=$this->db->fetchRow($requete);
    
        $val_=$this->get_contact($result['id_contact']);
        $val=$this->get_org($result['id_organisation']);
        return array($result['nom_aide'],$result['nature_aide'],$result['type_aide'],$result['montant_demande'],$result['date_demande'],$result['date_reponse'],$result['reponse'],$result['montant_banque'],$result['motif_banque'],$result['decision_ben'],$result['motif_decision_ben'],$result['montant_obtenu'],$val[0],$result['id_organisation'],$val_[0],$val_[1],$result['initiative_demande'],$result['mode_depot'],$result['frais'],$result['date_frais'],$result['id_projet'],$result['id_resacc_ressources_fi'],$result['type_amt'],$result['duree_amt'],$result['tx_amt']);
    }
    
    function return_financement($id_resacc_fi)
    {
    
        $requete='SELECT * FROM  '.$this->table_financement.'   where id_resacc_ressources_fi="'.$id_resacc_fi.'"';
        $result=$this->db->fetchRow($requete);
    
        return array($result['designation'],$result['exercice'],$result['type_ressource'],$result['intitule_compte'],$result['montant'],$result['type_amt'],$result['duree_amt'],$result['tx_amt']);
    }
    function return_investissement($id_resacc_in)
    {
    
        $requete='SELECT * FROM  '.$this->table_investissement.'   where id_resacc_besoin_fi='.$id_resacc_in.'';
        $result=$this->db->fetchRow($requete);
    
        return array($result['type_immo'],$result['exercice'],$result['intitule_compte'],$result['quantite'],$result['pau_ht'],$result['montant_ht'],$result['tva'],$result['montant_tva'],$result['montant_ttc']);
    }
    
    function return_last_id($table)
    {
    
        $requete='SELECT * FROM  '.$table.'  order by id_resacc_ressources_fi desc limit 1';
     
        $result=$this->db->fetchRow($requete);
    
        return $result['id_resacc_ressources_fi'];
    }
    
    
    function return_produit($id_resacc_produit)
    {
    
        $requete='SELECT * FROM  '.$this->table_produits.'   where id_resacc_produits="'.$id_resacc_produit.'"';
        $result=$this->db->fetchRow($requete);
    
        return array($result['exercice'],$result['designation'],$result['type_produits'],$result['intitule_compte'],$result['quantite_jr'],$result['pvu_ht'],$result['nb_jrs_semaine'],$result['nb_mois_an'],$result['qt_annuelle'],$result['m1'],$result['m2'],$result['m3'],$result['m4'],$result['m5'],$result['m6'],$result['m7'],$result['m8'],$result['m9'],$result['m10'],$result['m11'],$result['m12'],$result['montant_ht']);
    }
    function update_org_ben($id_projet, $id_owner, $nom_commercial, $raison_sociale, $activite_principale, $type_adresse, $adresse_ligne_1, $adresse_ligne_2, $adresse_ligne_3, $cp, $ville, $region, $pays, $date_immat, $date_debut_activite, $forme_juridique, $siret, $secteur_activite, $dirigeant, $implantation, $regime_imposition, $regime_tva, $regime_fiscal, $regime_social_dirigeant, $statut, $code_naf)
    {   
        $dat_immat=explode("/", $date_immat);
        $dat_debut_activite=explode("/", $date_debut_activite);
                
        if ($regime_imposition!=null and is_numeric($regime_imposition)) {
            $regime_imposition=$this->texte_id($regime_imposition);
        } else {
            $regime_imposition=$regime_imposition;
        }
    
        if ($regime_social_dirigeant!=null and is_numeric($regime_social_dirigeant)) {
            $regime_social_dirigeant=$this->texte_id($regime_social_dirigeant);
        } else {
            $regime_social_dirigeant=$regime_social_dirigeant;
        }
    
        if ($type_adresse!=null and is_numeric($type_adresse)) {
            $type_adresse=$this->texte_id($type_adresse);
        } else {
            $type_adresse=$type_adresse;
        }
    
        if ($forme_juridique!=null and is_numeric($forme_juridique)) {
            $forme_juridique=$this->texte_id($forme_juridique);
        }
    

        if ($secteur_activite!=null and is_numeric($secteur_activite)) {
            $secteur_activite=$this->texte_id($secteur_activite);
        } else {
            $secteur_activite=$secteur_activite;
        }
        
        if ($regime_fiscal!=null and is_numeric($regime_fiscal)) {
            $regime_fiscal=$this->texte_id($regime_fiscal);
        } else {
            $regime_fiscal=$regime_fiscal;
        }
        
        if ($regime_tva!=null and is_numeric($regime_tva)) {
            $regime_tva=$this->texte_id($regime_tva);
        } else {
            $regime_tva=$regime_tva;
        }
    
        if ($implantation!=null and is_numeric($implantation)) {
            $implantation=$this->texte_id($implantation);
        } else {
            $implantation=$implantation;
        }
    
        $data = array('id_modifier' => $id_owner , 'date_last_modified'=> time() ,'nom_commercial' => $nom_commercial, 'raison_sociale'=> $raison_sociale, 'activite_principale'=>$activite_principale, 'type_adresse'=> $type_adresse,'adresse_ligne_1'=> $adresse_ligne_1, 'adresse_ligne_2'=> $adresse_ligne_2 ,'adresse_ligne_3'=>$adresse_ligne_3,'cp'=> $cp,'ville'=> $ville,'region'=> $region,'pays'=> $pays,'date_immat'=> mktime(0, 0, 0, $dat_immat[1], $dat_immat[0], $dat_immat[2]),'date_debut_activite'=>  mktime(0, 0, 0, $dat_debut_activite[1], $dat_debut_activite[0], $dat_debut_activite[2]),'forme_juridique'=> $forme_juridique,'siret'=> $siret,'secteur_activite'=> $secteur_activite,'dirigeant'=> $dirigeant,'implantation'=> $implantation,'regime_imposition'=> $regime_imposition,'regime_tva'=> $regime_tva,'regime_fiscal'=> $regime_fiscal,'regime_social_dirigeant'=> $regime_social_dirigeant,'statut'=>$statut,'code_naf'=>$code_naf);
                
        $this->db->update($this->table_projet_organisation, $data, 'id_projet='.$id_projet.'');
    }
    
    function texte_id($id, $table = "egw_epce_texte")
    {
        
    
    
        $requete='SELECT valeur FROM  '.$table.'   where id="'.$id.'" order by  valeur asc';
        $result=$this->db->fetchRow($requete);
        return $result['valeur'];
    }
    
    function selectionner_conseiller3($conseiller_id = '')
    {
        
        if ($conseiller_id!=null) {
            echo'<select style="width:120px" name="conseiller_id">';
                        
            $requete='SELECT * FROM  egw_accounts  where account_id='.$conseiller_id.'';
            $row = $this->db->fetchAll($requete);
        
            for ($i=0; $i<count($row); $i++) {
                $account_firstname=$row[$i]['account_firstname'];
                $account_lastname=$row[$i]['account_lastname'];
                $account_lid=$row[$i]['account_lid'];
                $account_id=$row[$i]['account_id'];
        
    
                echo'<option value='.$account_id.'>'.$account_lid.'</option>';
            }
        } else {
            echo'<select style="width:120px" name="conseiller_id"><option value=""></option>';
        }
        
        echo'<option  style="background-color: #75B4D2; color:#FFF" value="">APSIE</option>';
        $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_apsie.'    order by account_lid asc';
        $row = $this->db->fetchAll($requete);
        
        for ($i=0; $i<count($row); $i++) {
            $account_firstname=$row[$i]['account_firstname'];
            $account_lastname=$row[$i]['account_lastname'];
            $account_id=$row[$i]['account_id'];
            $account_lid=$row[$i]['account_lid'];
            
            echo'<option value='.$account_id.'>'.$account_lid.'</option>';
        }
        
                echo'<option style="background-color: #75B4D2; color:#FFF" value="">STRAGEFI</option>';
        $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group='.$this->id_group_stragefi.'  order by account_lid asc';
        $row = $this->db->fetchAll($requete);
        
        for ($i=0; $i<count($row); $i++) {
            $account_firstname=$row[$i]['account_firstname'];
            $account_lastname=$row[$i]['account_lastname'];
            $account_id=$row[$i]['account_id'];
            $account_lid=$row[$i]['account_lid'];
            
            echo'<option value='.$account_id.'>'.$account_lid.'</option>';
        }
        
        
        echo'</select>';
    }
    
    
    function selectionner_conseiller($conseiller, $id = '')
    {
        
        echo'<select style="width:120px"  name="conseiller_id">';
        if ($conseiller!=null) {
            echo'<option value='.$id.'>'.$conseiller.'</option>';
        } else {
            echo'<option value=""></option>';
        }
        
    
            
        $requete='SELECT * FROM  egw_accounts  where account_id>5 and account_status="A" and account_type="u" and account_primary_group=-9 order by account_lid asc';
        $result=$this->db->fetchAll($requete);
        
        for ($i=0; $i<count($result); $i++) {
            echo'<option value='.$result[$i]['account_id'].'>'.$result[$i]['account_lid'].'</option>';
        }
        
        echo'</select>';
    }
    
    function nbr_projet($categorie, $mot = '')
    {
        
        if ($categorie!=null and $mot!=null) {
             $requete='SELECT * FROM  '.$this->table_projet.' where (intitule_projet like "%'.$mot.'%" or  description_projet like "%'.$mot.'%") and categorie like "%'.$categorie.'%"';
        } elseif ($categorie!=null and $mot==null) {
            $requete='SELECT * FROM  '.$this->table_projet.' where categorie like "%'.$categorie.'%"';
        } elseif ($mot!=null and $categorie==null) {
            $requete='SELECT * FROM  '.$this->table_projet.' where intitule_projet like "%'.$mot.'%" or  description_projet like "%'.$mot.'%"';
        } else {
            $requete='SELECT * FROM  '.$this->table_projet.'';
        }
    
     
        $result=$this->db->fetchAll($requete);
        return count($result);
    }
    
    function modifier_in($id_owner, $id_resacc_in, $exercice, $immo, $intitule_compte, $quantite, $pau, $montant_ht, $tva)
    {
        

    
        if ($immo!=null and is_numeric($immo)) {
            $immo=$this->texte_id($immo, 'egw_texte_financement');
        } else {
            $immo=$immo;
        }
        
        if ($intitule_compte!=null and is_numeric($intitule_compte)) {
            $intitule_compte=$this->texte_id($intitule_compte, 'egw_texte_financement');
        } else {
            $intitule_compte=$intitule_compte;
        }
        
        $montant_tva=$montant_ht*$tva/100;
        $montant_ttc=$montant_ht + $montant_tva;
        
        $data = array('id_modifier'=>$id_owner,'type_immo'=>$immo,'intitule_compte'=>$intitule_compte,'quantite'=>$quantite,'pau_ht'=>$pau,'montant_ht'=>$montant_ht,'tva'=>$tva, 'montant_tva'=>$montant_tva ,'montant_ttc'=> $montant_ttc,'exercice'=>$exercice);
                                                                      
        $this->db->update($this->table_investissement, $data, 'id_resacc_besoin_fi='.$id_resacc_in);
    }
    
    function inserer_investissement($id_owner, $id_projet, $exercice, $immo, $intitule_compte, $quantite, $pau, $montant_ht, $tva)
    {
        
        
        $id_resacc=$this->get_id_resacc($id_projet);
    
        if ($immo!=null and is_numeric($immo)) {
            $immo=$this->texte_id($immo, 'egw_texte_financement');
        } else {
            $immo=$immo;
        }
        
        if ($intitule_compte!=null and is_numeric($intitule_compte)) {
            $intitule_compte=$this->texte_id($intitule_compte, 'egw_texte_financement');
        } else {
            $intitule_compte=$intitule_compte;
        }
        
        $montant_tva=$montant_ht*$tva/100;
        $montant_ttc=$montant_ht + $montant_tva;
        
        $data = array('id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'type_immo'=>$immo,'intitule_compte'=>$intitule_compte,'quantite'=>$quantite,'pau_ht'=>$pau,'montant_ht'=>$montant_ht,'tva'=>$tva, 'montant_tva'=>$montant_tva ,'montant_ttc'=> $montant_ttc,'exercice'=>$exercice);
                                                                      
        $this->db->insert($this->table_investissement, $data);
    }
    
    function inserer_financement($id_owner, $id_projet, $exercice, $ressource, $intitule_compte_ressource, $montant_ressource, $type_amt, $duree_amt, $tx_amt, $designation)
    {
        
        
        $id_resacc=$this->get_id_resacc($id_projet);
        
        if ($ressource!=null and is_numeric($ressource)) {
            $ressource=$this->texte_id($ressource, 'egw_texte_financement');
        } else {
            $ressource=$ressource;
        }
        if ($intitule_compte_ressource!=null and is_numeric($intitule_compte_ressource)) {
            $intitule_compte_ressource=$this->texte_id($intitule_compte_ressource, 'egw_texte_financement');
        } else {
            $intitule_compte_ressource=$intitule_compte_ressource;
        }

        
        $data = array('id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>$exercice,'type_ressource'=>$ressource,'intitule_compte'=>$intitule_compte_ressource,'montant'=>$montant_ressource,'type_amt'=>$type_amt,'duree_amt'=>$duree_amt,'tx_amt'=>$tx_amt,'designation'=>$designation);
                                                                      
        $this->db->insert($this->table_financement, $data);
    }
    
    function modifier_cr3($id_modifier, $id_resacc_edit, $nature, $entree_sortiee, $montant_a1, $montant_a2, $montant_a3, $cf_a2, $cf_a3, $tva, $delai, $part_delai, $vent, $evo)
    {
            
        if ($entree_sortiee!=null and is_numeric($entree_sortiee)) {
            $entree_sortiee=$this->texte_id($entree_sortiee, 'egw_texte_financement');
        } else {
            $entree_sortiee=$entree_sortiee;
        }
        

    
        if ($nature=="produit") {
            $data = array('date_last_modified'=>time(),'id_modifier'=>$id_modifier,'type_produits'=>$entree_sortiee,'montant_a1'=>$montant_a1,'montant_a2'=>$montant_a2,'montant_a3'=>$montant_a3,'cf_a2'=>$cf_a2,'cf_a3'=>$cf_a3,'tva'=>$tva,'delai'=>$delai,'part_delai'=>$part_delai,'vent'=>$vent,'evo'=>$evo);
        } elseif ($nature=="charge") {
            $data = array('date_last_modified'=>time(),'id_modifier'=>$id_modifier,'intitule_compte'=>$entree_sortiee,'montant_a1'=>$montant_a1,'montant_a2'=>$montant_a2,'montant_a3'=>$montant_a3,'cf_a2'=>$cf_a2,'cf_a3'=>$cf_a3,'tva'=>$tva,'delai'=>$delai,'part_delai'=>$part_delai,'vent'=>$vent,'evo'=>$evo);
        }
    
    
        $this->db->update($this->table_cr3, $data, 'id_resacc_cr3='.$id_resacc_edit);
    }
    
    function modifier_fi($id_modifier, $id_resacc_edit, $designation, $exercice, $type_ressource, $intitule_compte, $montant, $type_amt, $duree_amt, $tx_amt)
    {
            
        if ($type_ressource!=null and is_numeric($type_ressource)) {
            $type_ressource=$this->texte_id($type_ressource, 'egw_texte_financement');
        } else {
            $type_ressource=$type_ressource;
        }
        
        
        
        if ($intitule_compte!=null and is_numeric($intitule_compte)) {
            $intitule_compte=$this->texte_id($intitule_compte, 'egw_texte_financement');
        } else {
            $intitule_compte=$intitule_compte;
        }
        
        

    
    
        $data = array('date_last_modified'=>time(),'id_modifier'=>$id_modifier,'type_ressource'=>$type_ressource,'intitule_compte'=>$intitule_compte,'montant'=>$montant,'type_amt'=>$type_amt,'duree_amt'=>$duree_amt,'tx_amt'=>$tx_amt,'exercice'=>$exercice,'designation'=>$designation);
        
    
    
    
    
        $this->db->update($this->table_financement, $data, 'id_resacc_ressources_fi='.$id_resacc_edit);
    }
    
    function modifier_produit($id_modifier, $id_resacc, $id_resacc_pro_edit, $exercice, $designation, $compte_produits, $compte_achats, $pvu, $qt_j, $nb_sem, $nb_mois, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12)
    {
            
        if ($compte_produits!=null and is_numeric($compte_produits)) {
            $compte_produits=$this->texte_id($compte_produits, 'egw_texte_financement');
        } else {
            $compte_produits=$compte_produits;
        }
        
        if ($compte_achats!=null and is_numeric($compte_achats)) {
            $compte_achats=$this->texte_id($compte_achats, 'egw_texte_financement');
        } else {
            $compte_achats=$compte_achats;
        }
        $qt_an=$qt_j*$nb_sem*4*$nb_mois;
        
        if ($exercice=="annee1") {
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_modifier,'exercice'=>"annee1",'designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
            $this->db->update($this->table_produits, $data, 'id_resacc_produits='.$id_resacc_pro_edit);
    
    
    
    
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee2"';
            $result_evo2 = $this->db->fetchRow($requete);
            
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee3"';
            $result_evo3 = $this->db->fetchRow($requete);
    
            $pourcent1 = 1+ $result_evo2['pourcentage_evo']/100 ;
            $qt_j2=$pourcent1*$qt_j;
            $qt_an=$qt_j2*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent1;
            $m2 = $m2 * $pourcent1;
            $m3 = $m3 * $pourcent1;
            $m4 = $m4 * $pourcent1;
            $m5 = $m5 * $pourcent1;
            $m6 = $m6 * $pourcent1;
            $m7 = $m7 * $pourcent1;
            $m8 = $m8 * $pourcent1;
            $m9 = $m9 * $pourcent1;
            $m10 = $m10 * $pourcent1;
            $m11 = $m11 * $pourcent1;
            $m12 = $m12 * $pourcent1;
        
            $data2 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee2','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j2,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->update($this->table_produits, $data2, 'id_resacc_produits='.($id_resacc_pro_edit+1));
    
            $pourcent2 =1+ $result_evo3['pourcentage_evo']/100 ;
            $qt_j3=$pourcent2*$qt_j2;
            $qt_an=$qt_j3*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent2;
            $m2 = $m2 * $pourcent2;
            $m3 = $m3 * $pourcent2;
            $m4 = $m4 * $pourcent2;
            $m5 = $m5 * $pourcent2;
            $m6 = $m6 * $pourcent2;
            $m7 = $m7 * $pourcent2;
            $m8 = $m8 * $pourcent2;
            $m9 = $m9 * $pourcent2;
            $m10 = $m10 * $pourcent2;
            $m11 = $m11 * $pourcent2;
            $m12 = $m12 * $pourcent2;
        
            $data3 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee3','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j3,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->update($this->table_produits, $data3, 'id_resacc_produits='.($id_resacc_pro_edit+2));
        }
            
        if ($exercice=="annee2") {
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_modifier,'exercice'=>"annee2",'designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
            $this->db->update($this->table_produits, $data, 'id_resacc_produits='.$id_resacc_pro_edit);
    
    
            
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee3"';
            $result_evo3 = $this->db->fetchRow($requete);
    
    
    
            $pourcent2 =1+ $result_evo3['pourcentage_evo']/100 ;
            $qt_j3=$pourcent2*$qt_j;
            $qt_an=$qt_j3*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent2;
            $m2 = $m2 * $pourcent2;
            $m3 = $m3 * $pourcent2;
            $m4 = $m4 * $pourcent2;
            $m5 = $m5 * $pourcent2;
            $m6 = $m6 * $pourcent2;
            $m7 = $m7 * $pourcent2;
            $m8 = $m8 * $pourcent2;
            $m9 = $m9 * $pourcent2;
            $m10 = $m10 * $pourcent2;
            $m11 = $m11 * $pourcent2;
            $m12 = $m12 * $pourcent2;
        
            $data3 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee3','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j3,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->update($this->table_produits, $data3, 'id_resacc_produits='.($id_resacc_pro_edit+1));
        }
        if ($exercice=="annee3") {
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_modifier,'exercice'=>"annee3",'designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
            $this->db->update($this->table_produits, $data, 'id_resacc_produits='.$id_resacc_pro_edit);
        }
    }
    
    function verif_organisme($code_org, $id_owner)
    {
        
        $requete='SELECT id_organisation FROM  '.$this->table_organisation.' where code_org="'.$code_org.'"';

        $result=$this->db->fetchRow($requete);
        $add=0;
        if ($result['id_organisation']==0 and $code_org!=null) {
            $code=str_replace(' ', '_', $code_org);
            $data = array('date_creation'=>time(),'id_owner'=>$id_owner,'categorie_org'=>$this->cat_id_org_financier,'code_org'=>$code,'nom_organisme'=>$code_org);
            $this->db->insert($this->table_organisation, $data);
            $requete='SELECT id_organisation FROM  '.$this->table_organisation.' order by id_organisation desc limit 1';

                   $result=$this->db->fetchRow($requete);
                   $add=1;
        }

        return array($result['id_organisation'],$add);
    }
    function verif_contact($nom, $prenom, $id_org, $id_owner)
    {
        
        $requete='SELECT id_ben FROM  '.$this->table_contact.' where (nom="'.$nom.'" and prenom="'.$prenom.'") and cat_id="'.$this->cat_id_contact_financier.'"';

        $result=$this->db->fetchRow($requete);
        $add=0;
        if ($result['id_ben']==0 and $nom!=null) {
              $data = array('date_creation'=>time(),'id_owner'=>$id_owner,'cat_id'=>$this->cat_id_contact_financier,'nom_complet'=>$nom.' '.$prenom,'nom'=>$nom,'prenom'=>$prenom,'id_organisation'=>$id_org);
              $this->db->insert($this->table_contact, $data);
              $requete='SELECT id_ben FROM  '.$this->table_contact.' order by id_ben desc limit 1';

             $result=$this->db->fetchRow($requete);
             $add=1;
        }


        return array($result['id_ben'],$add);
    }
    
    function inserer_aide($id_owner, $id_projet, $id_resacc_fi, $nom_aide, $nature, $type, $montant_demande, $date_demande, $date_reponse, $reponse, $montant_obtenu, $code_org, $contact_nom, $contact_prenom, $motif_banque, $decision_ben, $motif_ben, $initiative, $mode, $frais, $date_frais, $type_amt, $duree_amt, $tx_amt)
    {
    
        $nature=$this->texte_id($nature, 'egw_texte_financement');
        $type=$this->texte_id($type, 'egw_texte_financement');
        
        
        if ($date_demande==null) {
            $date_demande_=null;
        } else {
            $date_demande=explode("/", $date_demande);
            $date_demande_=mktime(0, 0, 0, $date_demande[1], $date_demande[0], $date_demande[2]);
        }
        if ($date_reponse==null) {
            $date_reponse_=null;
        } else {
            $date_reponse=explode("/", $date_reponse);
            $date_reponse_=mktime(0, 0, 0, $date_reponse[1], $date_reponse[0], $date_reponse[2]);
        }
        
        if ($date_frais==null) {
            $date_frais_=null;
        } else {
            $date_frais=explode("/", $date_frais);
            $date_frais_=mktime(0, 0, 0, $date_frais[1], $date_frais[0], $date_frais[2]);
        }
        
     
        $val=$this->verif_organisme($code_org, $id_owner);
        $val_c=$this->verif_contact($contact_nom, $contact_prenom, $val[0], $id_owner);
        $data = array('id_projet'=>$id_projet,'id_owner'=>$id_owner,'id_resacc_ressources_fi'=>$id_resacc_fi,'date_enregistrement'=>time(),'nom_aide'=>$nom_aide,'nature_aide'=>$nature,'type_aide'=>$type,'montant_demande'=>$montant_demande,'date_demande'=> $date_demande_,'date_reponse'=> $date_reponse_,'reponse'=>$reponse,'montant_obtenu'=>$montant_obtenu,'id_organisation'=>$val[0],'id_contact'=>$val_c[0], 'motif_banque'=>$motif_banque,'decision_ben'=>$decision_ben,'motif_decision_ben'=>$motif_ben,'initiative_demande'=>$initiative,'mode_depot'=>$mode,'frais'=>$frais,'date_frais'=>$date_frais_,'type_amt'=>$type_amt,'duree_amt'=>$duree_amt,'tx_amt'=>$tx_amt);
                                                                      
        $this->db->insert($this->table_aide_crea, $data);
    
        $data= array();
    
    
        if ($frais!=null) {
            $id_resacc=$this->get_id_resacc($id_projet);
        
            $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.' and intitule_compte="Frais dossier banque+ frais garantie FAG ou FGIF"';
            $result = $this->db->fetchRow($requete);
        
            if ($result['montant_ttc']!=null) {
                $frais = $frais+$result['montant_ttc'];
        
                $data = array('montant_ttc'=>$frais);
                $where[]='id_resacc='.$id_resacc;
                $where[]='intitule_compte="Frais dossier banque+ frais garantie FAG ou FGIF"';
                $this->db->update($this->table_investissement, $data, $where);
            } else {
                $data = array('id_resacc'=>$id_resacc,'id_owner'=>$id_owner,'date_enregistrement'=>time(),'type_immo'=>'Immobilisations_incorporelles','exercice'=>'Depart','intitule_compte'=>'Frais dossier banque+ frais garantie FAG ou FGIF','montant_ttc'=>$frais);
                $this->db->insert($this->table_investissement, $data);
            }
        }
    
        return array($val[1],$val_c[1],$val[0],$val_c[0]);
    }
    
    function modifier_aide($id_owner, $id_projet, $id_resacc_fi, $nom_aide, $nature, $type, $montant_demande, $date_demande, $date_reponse, $reponse, $montant_obtenu, $code_org, $contact_nom, $contact_prenom, $motif_banque, $decision_ben, $motif_ben, $initiative, $mode, $frais, $date_frais, $id_aide)
    {
        
        
    
        
        if ($nature!=null and is_numeric($nature)) {
            $nature=$this->texte_id($nature);
        } else {
            $nature=$nature;
        }
        
        if ($type!=null and is_numeric($type)) {
            $type=$this->texte_id($type);
        } else {
            $type=$type;
        }
        
        
        if ($date_demande==null) {
            $date_demande_=null;
        } else {
            $date_demande=explode("/", $date_demande);
            $date_demande_=mktime(0, 0, 0, $date_demande[1], $date_demande[0], $date_demande[2]);
        }
        if ($date_reponse==null) {
            $date_reponse_=null;
        } else {
            $date_reponse=explode("/", $date_reponse);
            $date_reponse_=mktime(0, 0, 0, $date_reponse[1], $date_reponse[0], $date_reponse[2]);
        }
        
        if ($date_frais==null) {
            $date_frais_=null;
        } else {
            $date_frais=explode("/", $date_frais);
            $date_frais_=mktime(0, 0, 0, $date_frais[1], $date_frais[0], $date_frais[2]);
        }
     
        $val=$this->verif_organisme($code_org, $id_owner);
        $val_c=$this->verif_contact($contact_nom, $contact_prenom, $val[0], $id_owner);
        $data = array('id_modifier'=>$id_owner,'date_last_modified'=>time(),'nom_aide'=>$nom_aide,'nature_aide'=>$nature,'type_aide'=>$type,'montant_demande'=>$montant_demande,'date_demande'=> $date_demande_,'date_reponse'=> $date_reponse_,'reponse'=>$reponse,'montant_obtenu'=>$montant_obtenu,'id_organisation'=>$val[0],'id_contact'=>$val_c[0], 'motif_banque'=>$motif_banque,'initiative_demande'=>$initiative,'mode_depot'=>$mode,'frais'=>$frais,'date_frais'=>$date_frais_,'decision_ben'=>$decision_ben,'motif_decision_ben'=>$motif_ben);
                                                                      
        $this->db->update($this->table_aide_crea, $data, 'id_resacc_aide_creation='.$id_aide);
    
        if ($frais!=null) {
            $id_resacc=$this->get_id_resacc($id_projet);
        
            $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.' and intitule_compte="Frais dossier banque+ frais garantie FAG ou FGIF"';
            $result = $this->db->fetchRow($requete);
        
            if ($result['montant_ttc']!=null) {
                $frais = $frais+$result['montant_ttc'];
        
                $data = array('montant_ttc'=>$frais);
                $where[]='id_resacc='.$id_resacc;
                $where[]='intitule_compte="Frais dossier banque+ frais garantie FAG ou FGIF"';
                $this->db->update($this->table_investissement, $data, $where);
            } else {
                $data = array('id_resacc'=>$id_resacc,'id_owner'=>$id_owner,'date_enregistrement'=>time(),'type_immo'=>'Immobilisations_incorporelles','exercice'=>'Depart','intitule_compte'=>'Frais dossier banque+ frais garantie FAG ou FGIF','montant_ttc'=>$frais);
                $this->db->insert($this->table_investissement, $data);
            }
        }
    
        return array($val[0],$val_c[0]);
    }
    
    function inserer_cr3($id_owner, $id_projet, $nature, $compte_produits, $compte_achats, $annee1, $annee2, $annee3, $cf_a2, $cf_a3, $tva, $delai, $part_delai, $evo, $vent)
    {
        
        
        $id_resacc=$this->get_id_resacc($id_projet);
        
    
        $compte_achats=$this->texte_id($compte_achats, 'egw_texte_financement');
        $compte_produits=$this->texte_id($compte_produits, 'egw_texte_financement');
    
        
        $data = array('id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'montant_a1'=>$annee1,'montant_a2'=>$annee2,'montant_a3'=>$annee3,'type_produits'=>$compte_produits,'intitule_compte'=>$compte_achats,'nature'=>$nature,'tva'=>$tva,'delai'=>$delai,'part_delai'=>$part_delai,'cf_a2'=>$cf_a2,'cf_a3'=>$cf_a3,'evo'=>$evo,'vent'=>$vent);
                                                                      
        $this->db->insert($this->table_cr3, $data);
    }
    function inserer_effectif($id_owner, $id_projet, $exercice, $poste, $statut, $nb_mois, $remun_mens_brut)
    {
        
        
        $id_resacc=$this->get_id_resacc($id_projet);
        
    
    
        
        $data = array('id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_creation'=>time(),'exercice'=>$exercice,'poste'=>$poste,'statut'=>$statut,'nb_mois'=>$nb_mois,'renum_mens_brut'=>$remun_mens_brut);
                                                                      
        $this->db->insert('egw_resacc_effectif', $data);
    }
    
    function inserer_produit($id_owner, $id_projet, $designation, $compte_produits, $compte_achats, $pvu, $qt_j, $nb_sem, $nb_mois, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12, $exercice)
    {
        
        
        $id_resacc=$this->get_id_resacc($id_projet);
        
    
        $compte_achats=$this->texte_id($compte_achats, 'egw_texte_financement');
        $compte_produits=$this->texte_id($compte_produits, 'egw_texte_financement');
    
    
        $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.'';

        $result=$this->db->fetchRow($requete);
    
        if ($result['id_resacc_produits_evo']==null) {
            $data2 = array('id_resacc'=>$id_resacc,'exercice'=>'annee2','pourcentage_evo'=>10);
            $data3 = array('id_resacc'=>$id_resacc,'exercice'=>'annee3','pourcentage_evo'=>10);
    
            $this->db->insert($this->table_produits_evo, $data2);
            $this->db->insert($this->table_produits_evo, $data3);
        }
        
        
    
        if ($exercice=="annee1") {
            $qt_an=$qt_j*$nb_sem*4*$nb_mois;

        
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee1','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data);
    
    
        
            
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee2"';
            $result_evo2 = $this->db->fetchRow($requete);
            
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee3"';
            $result_evo3 = $this->db->fetchRow($requete);
    
            $pourcent1 = 1+ $result_evo2['pourcentage_evo']/100 ;
            $qt_j2=$pourcent1*$qt_j;
            $qt_an=$qt_j2*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent1;
            $m2 = $m2 * $pourcent1;
            $m3 = $m3 * $pourcent1;
            $m4 = $m4 * $pourcent1;
            $m5 = $m5 * $pourcent1;
            $m6 = $m6 * $pourcent1;
            $m7 = $m7 * $pourcent1;
            $m8 = $m8 * $pourcent1;
            $m9 = $m9 * $pourcent1;
            $m10 = $m10 * $pourcent1;
            $m11 = $m11 * $pourcent1;
            $m12 = $m12 * $pourcent1;
        
            $data2 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee2','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j2,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data2);
    
            $pourcent2 =1+ $result_evo3['pourcentage_evo']/100 ;
            $qt_j3=$pourcent2*$qt_j2;
            $qt_an=$qt_j3*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent2;
            $m2 = $m2 * $pourcent2;
            $m3 = $m3 * $pourcent2;
            $m4 = $m4 * $pourcent2;
            $m5 = $m5 * $pourcent2;
            $m6 = $m6 * $pourcent2;
            $m7 = $m7 * $pourcent2;
            $m8 = $m8 * $pourcent2;
            $m9 = $m9 * $pourcent2;
            $m10 = $m10 * $pourcent2;
            $m11 = $m11 * $pourcent2;
            $m12 = $m12 * $pourcent2;
        
            $data3 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee3','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j3,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data3);
        } elseif ($exercice=="annee2") {
            $qt_an=$qt_j*$nb_sem*4*$nb_mois;

        
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>"annee2",'designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data);
    
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee3"';
            $result_evo3 = $this->db->fetchRow($requete);
        
            $pourcent2 =1+ $result_evo3['pourcentage_evo']/100 ;
            $qt_j3=$pourcent2*$qt_j2;
            $qt_an=$qt_j3*$nb_sem*4*$nb_mois;
            $ca=$pvu*$qt_an;
            $m1 = $m1 * $pourcent2;
            $m2 = $m2 * $pourcent2;
            $m3 = $m3 * $pourcent2;
            $m4 = $m4 * $pourcent2;
            $m5 = $m5 * $pourcent2;
            $m6 = $m6 * $pourcent2;
            $m7 = $m7 * $pourcent2;
            $m8 = $m8 * $pourcent2;
            $m9 = $m9 * $pourcent2;
            $m10 = $m10 * $pourcent2;
            $m11 = $m11 * $pourcent2;
            $m12 = $m12 * $pourcent2;
        
            $data3 = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee3','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j3,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data3);
        } elseif ($exercice=="annee3") {
            $qt_an=$qt_j*$nb_sem*4*$nb_mois;

        
            $data = array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'id_owner'=>$id_owner,'id_resacc'=>$id_resacc,'date_enregistrement'=>time(),'exercice'=>'annee3','designation'=>$designation,'type_produits'=>$compte_achats,'intitule_compte'=>$compte_produits,'quantite_jr'=>$qt_j,'pvu_ht'=>$pvu,'nb_jrs_semaine'=>$nb_sem,'nb_mois_an'=>$nb_mois,'qt_annuelle'=>$qt_an,'montant_ht'=>($pvu*$qt_an));
                                                                      
            $this->db->insert($this->table_produits, $data);
        }
    }
    function update_pourcentage($id_resacc, $val, $exercice, $id_owner)
    {
        $data = array("pourcentage_evo"=>$val);
        $where[] = 'id_resacc='.$id_resacc;
        $where[] = 'exercice="'.$exercice.'"';
        $this->db->update($this->table_produits_evo, $data, $where);
        
        if ($exercice=="annee2") {
            $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee1"';
            $result = $this->db->fetchAll($requete);
            for ($i=0; $i<count($result); $i++) {
                $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc_produits='.($result[$i]['id_resacc_produits']+1).' and exercice="annee2"';
                $result2= $this->db->fetchRow($requete);
                
                
        
                $pourcent1 = 1+ $val/100 ;
                $qt_j=$pourcent1*$result[$i]['quantite_jr'];
                $qt_an=$qt_j*$result2['nb_jrs_semaine']*4*$result2['nb_mois_an'];
                $ca=$result2['pvu_ht']*$qt_an;
        
                $m1 = $result[$i]['m1'] * $pourcent1;
                $m2 = $result[$i]['m2'] * $pourcent1;
                $m3 = $result[$i]['m3'] * $pourcent1;
                $m4 = $result[$i]['m4'] * $pourcent1;
                $m5 = $result[$i]['m5'] * $pourcent1;
                $m6 = $result[$i]['m6'] * $pourcent1;
                $m7 = $result[$i]['m7'] * $pourcent1;
                $m8 = $result[$i]['m8']* $pourcent1;
                $m9 = $result[$i]['m9'] * $pourcent1;
                $m10 = $result[$i]['m10'] * $pourcent1;
                $m11 = $result[$i]['m11'] * $pourcent1;
                $m12 = $result[$i]['m12'] * $pourcent1;
        
                $data= array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'quantite_jr'=>$qt_j,'qt_annuelle'=>$qt_an,'montant_ht'=>$ca);
                                                                      
                $this->db->update($this->table_produits, $data, 'id_resacc_produits='.($result[$i]['id_resacc_produits']+1));
            }
    
    
    
            $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee2"';
            $result = $this->db->fetchAll($requete);
        
            $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="annee3"';
            $result_evo = $this->db->fetchRow($requete);
        
            for ($i=0; $i<count($result); $i++) {
                $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc_produits='.($result[$i]['id_resacc_produits']+1).' and exercice="annee3"';
                $result2= $this->db->fetchRow($requete);
                
                
        
                $pourcent1 = 1+ $result_evo['pourcentage_evo']/100 ;
                $qt_j=$pourcent1*$result[$i]['quantite_jr'];
                $qt_an=$qt_j*$result2['nb_jrs_semaine']*4*$result2['nb_mois_an'];
                $ca=$result2['pvu_ht']*$qt_an;
        
                $m1 = $result[$i]['m1'] * $pourcent1;
                $m2 = $result[$i]['m2'] * $pourcent1;
                $m3 = $result[$i]['m3'] * $pourcent1;
                $m4 = $result[$i]['m4'] * $pourcent1;
                $m5 = $result[$i]['m5'] * $pourcent1;
                $m6 = $result[$i]['m6'] * $pourcent1;
                $m7 = $result[$i]['m7'] * $pourcent1;
                $m8 = $result[$i]['m8']* $pourcent1;
                $m9 = $result[$i]['m9'] * $pourcent1;
                $m10 = $result[$i]['m10'] * $pourcent1;
                $m11 = $result[$i]['m11'] * $pourcent1;
                $m12 = $result[$i]['m12'] * $pourcent1;
        
                $data= array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'quantite_jr'=>$qt_j,'qt_annuelle'=>$qt_an,'montant_ht'=>$ca);
                                                                      
                $this->db->update($this->table_produits, $data, 'id_resacc_produits='.($result[$i]['id_resacc_produits']+1));
            }
        }
        if ($exercice=="annee3") {
            $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee2"';
            $result = $this->db->fetchAll($requete);
            for ($i=0; $i<count($result); $i++) {
                $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc_produits='.($result[$i]['id_resacc_produits']+1).' and exercice="annee3"';
                $result2= $this->db->fetchRow($requete);
                
                
        
                $pourcent2 = 1+ $val/100 ;
                $qt_j=$pourcent2*$result[$i]['quantite_jr'];
                $qt_an=$qt_j*$result2['nb_jrs_semaine']*4*$result2['nb_mois_an'];
                $ca=$result2['pvu_ht']*$qt_an;
        
                $m1 = $result[$i]['m1'] * $pourcent2;
                $m2 = $result[$i]['m2'] * $pourcent2;
                $m3 = $result[$i]['m3'] * $pourcent2;
                $m4 = $result[$i]['m4'] * $pourcent2;
                $m5 = $result[$i]['m5'] * $pourcent2;
                $m6 = $result[$i]['m6'] * $pourcent2;
                $m7 = $result[$i]['m7'] * $pourcent2;
                $m8 = $result[$i]['m8']* $pourcent2;
                $m9 = $result[$i]['m9'] * $pourcent2;
                $m10 = $result[$i]['m10'] * $pourcent2;
                $m11 = $result[$i]['m11'] * $pourcent2;
                $m12 = $result[$i]['m12'] * $pourcent2;
        
                $data= array('m1'=>$m1,'m2'=>$m2,'m3'=>$m3,'m4'=>$m4,'m5'=>$m5,'m6'=>$m6,'m7'=>$m7,'m8'=>$m8,'m9'=>$m9,'m10'=>$m10,'m11'=>$m11,'m12'=>$m12,'id_modifier'=>$id_owner,'quantite_jr'=>$qt_j,'qt_annuelle'=>$qt_an,'montant_ht'=>$ca);
                                                                      
                $this->db->update($this->table_produits, $data, 'id_resacc_produits='.($result[$i]['id_resacc_produits']+1));
            }
        }
    }
    
    function get_id_resacc($id_projet)
    {
    
    // echo "get_id_resacc ".$id_projet;
        $requete='SELECT * FROM '.$this->table_projet_organisation.' where id_projet='.$id_projet.'';
     // echo $requete;
     
        $result=$this->db->fetchRow($requete);
     // print_r($result);

        return $result['id_resacc'];
    }
    
    
    function return_poucentage_evo($id_resacc, $exercice)
    {


        $requete='SELECT * FROM  '.$this->table_produits_evo.' where id_resacc='.$id_resacc.' and exercice="'.$exercice.'" order by id_resacc_produits_evo desc';

        $result=$this->db->fetchRow($requete);
        return $result['pourcentage_evo'];
    }
    
    function nb_aide($id_resacc_fi)
    {
    
        $requete='SELECT * FROM  '.$this->table_aide_crea.' where id_resacc_ressources_fi='.$id_resacc_fi.'';

        $result=$this->db->fetchAll($requete);
        return count($result);
    }
    function somme_aide($id_resacc_fi)
    {
    
        $requete='SELECT * FROM  '.$this->table_aide_crea.' where id_resacc_ressources_fi='.$id_resacc_fi.'';

        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            $montant_obtenu=$montant_obtenu + $result[$i]['montant_obtenu'];
        }
        if ($montant_obtenu==null) {
            $montant_obtenu=0;
        }
        return $montant_obtenu;
    }
    function voir_financement($id_projet)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
     
        $requete='SELECT * FROM  '.$this->table_financement.' where id_resacc='.$id_resacc.'';
     
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
            $somme_obtenu = $somme_obtenu + $this->somme_aide($result[$i]['id_resacc_ressources_fi']);
        
            echo'<tr bgcolor='.$color.' style="text-align:right;border:1px solid #CCC">
          <td ><a onclick="window.open(\'modifier_fi.php?domain=default&id_projet='.$id_projet.'&id_resacc='.$id_resacc.'&id_resaac_fi_edit='.$result[$i]['id_resacc_ressources_fi'].'\',\'Modification du produits\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1250, height=150\');" href="javascript::void();">'.$result[$i]['designation'].'</a></td><td >'.$result[$i]['exercice'].'</td><td >'.$result[$i]['type_ressource'].'</td>
          <td   >'.$result[$i]['intitule_compte'].'</td>
            <td >'.$result[$i]['montant'].' €</td><td>'.$this->somme_aide($result[$i]['id_resacc_ressources_fi']).' €</td><td style="color:#F00">'.($this->somme_aide($result[$i]['id_resacc_ressources_fi'])-$result[$i]['montant']).' €</td><td>'.$result[$i]['type_amt'].'</td><td>'.$result[$i]['duree_amt'].' mois</td><td>'.$result[$i]['tx_amt'].' %</td> <td><a onclick="window.open(\'details_aide.php?domain=default&id_projet='.$id_projet.'&id_resacc_fi='.$result[$i]['id_resacc_ressources_fi'].'\',\'Liste des aides financières\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1100, height=300\');" href="javascript::void();">'.$this->nb_aide($result[$i]['id_resacc_ressources_fi']).'</a></td><td><a onclick="window.open(\'aide.php?domain=default&id_projet='.$id_projet.'&id_resacc_fi='.$result[$i]['id_resacc_ressources_fi'].'\',\'Aide financiere\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=0px, width=600, height=800\');" href="javascript::void();"><img title="Ajouter une demande" src="images/financeur.png" /></a> <a onclick="window.open(\'modifier_fi.php?domain=default&id_projet='.$id_projet.'&id_resacc='.$id_resacc.'&id_resacc_fi_edit='.$result[$i]['id_resacc_ressources_fi'].'\',\'Modification du produits\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1250, height=150\');" href="javascript::void();"><img src="images/edit.png" /></a> <a href="details.php?domain=default&id_projet='.$id_projet.'&id_resaac_fi_delete='.$result[$i]['id_resacc_ressources_fi'].'"><img src="images/delete.png" /></a></td></tr>';
        }
        echo'<tr bgcolor="#CCCCCC" style="text-align:right;border:1px solid #CCC">
          <td  >'.$result[$i]['type_ressource'].'</td>
          <td  >'.$result[$i]['intitule_compte'].'</td>
          <td ></td>   <td></td><td  >'.$this->somme_financement($id_projet).' €</td><td >'.$somme_obtenu.' €</td><td style="color:#F00">'.($somme_obtenu - $this->somme_financement($id_projet)).' €</td><td></td><td></td><td></td><td></td><td>TOTAL</td></tr>';
    }
    
    function voir_produits($id_projet)
    {
        $id_resacc=$this->get_id_resacc($id_projet);
        $total_a1=$this->total($id_resacc, "annee1");
        $total_a2=$this->total($id_resacc, "annee2");
        $total_a3=$this->total($id_resacc, "annee3");
        
        $pa1_1 = $total_a1[3]/$total_a1[2]*100;
        $pa1_2 = $total_a1[4]/$total_a1[2]*100;
        $pa1_3 = $total_a1[5]/$total_a1[2]*100;
        $pa1_4 = $total_a1[6]/$total_a1[2]*100;
        $pa1_5 = $total_a1[7]/$total_a1[2]*100;
        $pa1_6 = $total_a1[8]/$total_a1[2]*100;
        $pa1_7 = $total_a1[9]/$total_a1[2]*100;
        $pa1_8 = $total_a1[10]/$total_a1[2]*100;
        $pa1_9 = $total_a1[11]/$total_a1[2]*100;
        $pa1_10 = $total_a1[12]/$total_a1[2]*100;
        $pa1_11 = $total_a1[13]/$total_a1[2]*100;
        $pa1_12 = $total_a1[14]/$total_a1[2]*100;
        
        $pa2_1 = $total_a2[3]/$total_a2[2]*100;
        $pa2_2 = $total_a2[4]/$total_a2[2]*100;
        $pa2_3 = $total_a2[5]/$total_a2[2]*100;
        $pa2_4 = $total_a2[6]/$total_a2[2]*100;
        $pa2_5 = $total_a2[7]/$total_a2[2]*100;
        $pa2_6 = $total_a2[8]/$total_a2[2]*100;
        $pa2_7 = $total_a2[9]/$total_a2[2]*100;
        $pa2_8 = $total_a2[10]/$total_a2[2]*100;
        $pa2_9 = $total_a2[11]/$total_a2[2]*100;
        $pa2_10 = $total_a2[12]/$total_a2[2]*100;
        $pa2_11 = $total_a2[13]/$total_a2[2]*100;
        $pa2_12 = $total_a2[14]/$total_a2[2]*100;
        
        $pa3_1 = $total_a3[3]/$total_a3[2]*100;
        $pa3_2 = $total_a3[4]/$total_a3[2]*100;
        $pa3_3 = $total_a3[5]/$total_a3[2]*100;
        $pa3_4 = $total_a3[6]/$total_a3[2]*100;
        $pa3_5 = $total_a3[7]/$total_a3[2]*100;
        $pa3_6 = $total_a3[8]/$total_a3[2]*100;
        $pa3_7 = $total_a3[9]/$total_a3[2]*100;
        $pa3_8 = $total_a3[10]/$total_a3[2]*100;
        $pa3_9 = $total_a3[11]/$total_a3[2]*100;
        $pa3_10 = $total_a3[12]/$total_a3[2]*100;
        $pa3_11 = $total_a3[13]/$total_a3[2]*100;
        $pa3_12 = $total_a3[14]/$total_a3[2]*100;
        
        echo'<table style="border:1px solid #CCC"  ><tr style="font-weight:bold; background-color: #999; color:#FFF" >
        <td>D&eacute;signation</td>
        <td>Compte Achats</td>
        <td>Compte Produits</td>
        <input name="id_projet" type="hidden" value="'.$id_projet.'" />
          <td>PVU HT</td>
          <td  >Qt&eacute; J</td>
          <td >Jr/sem</td>
          <td >Mois/an</td>
          <td  >Qt an</td>
          <td  >M1</td>
          <td  >M2</td>
          <td  >M3</td>
          <td  >M4</td>
          <td  >M5</td>
          <td  >M6</td>
          <td  >M7</td>
          <td  >M8</td>
          <td  >M9</td>
          <td  >M10</td>
          <td  >M11</td>
          <td  >M12</td>
          <td  >CA</td> <td></td></tr><tr><th BGCOLOR="#CCC" COLSPAN=22>ANNEE 1</th></tr>';
          echo'<tr bgcolor="#FFEAEA" style="  color: #666;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td ></td> <td ></td><td ></td><td ></td><td style=" font-size:9px; ">100%</td><td style=" font-size:9px; ">'.round($pa1_1, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_2, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_3, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_4, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_5, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_6, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_7, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_8, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_9, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_10, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_11, 0).'%</td><td style=" font-size:9px; ">'.round($pa1_12, 0).'%</td><td ></td><td></td></tr>';
    
    
     
        $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee1"';
        $requete2='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee2"';
        $requete3='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="annee3"';
     
        $result=$this->db->fetchAll($requete);
        $result2=$this->db->fetchAll($requete2);
        $result3=$this->db->fetchAll($requete3);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
        
            echo'<tr bgcolor='.$color.' style="text-align:right;border:1px solid #CCC">
          <td >'.$result[$i]['designation'].'</td><td >'.$result[$i]['type_produits'].'</td>
          <td  >'.$result[$i]['intitule_compte'].'</td>
            <td >'.$result[$i]['pvu_ht'].'€</td> <td >'.round($result[$i]['quantite_jr'], 0).'</td><td >'.$result[$i]['nb_jrs_semaine'].'</td><td >'.$result[$i]['nb_mois_an'].'</td><td >'.round($result[$i]['qt_annuelle'], 0).'</td><td >'.round($result[$i]['m1'], 0).'</td><td >'.round($result[$i]['m2'], 0).'</td><td >'.round($result[$i]['m3'], 0).'</td><td >'.round($result[$i]['m4'], 0).'</td><td >'.round($result[$i]['m5'], 0).'</td><td >'.round($result[$i]['m6'], 0).'</td><td >'.round($result[$i]['m7'], 0).'</td><td >'.round($result[$i]['m8'], 0).'</td><td >'.round($result[$i]['m9'], 0).'</td><td >'.round($result[$i]['m10'], 0).'</td><td >'.round($result[$i]['m11'], 0).'</td><td >'.round($result[$i]['m12'], 0).'</td><td >'.round($result[$i]['montant_ht'], 0).'€</td><td><a href="javascript::void();" onclick="window.open(\'modifier.php?domain=default&id_projet='.$id_projet.'&id_resacc='.$id_resacc.'&id_resacc_pro_edit='.$result[$i]['id_resacc_produits'].'\',\'Modification du produits\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1250, height=150\');"><img  src="images/edit.png" /></a><a href="details.php?domain=default&id_projet='.$id_projet.'&id_resacc_pro_delete='.$result[$i]['id_resacc_produits'].'"><img src="images/delete.png" /></a></td></tr>';
        }
        echo'<tr bgcolor="#E3FECB" style=" color:#060;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td >'.$total_a1[0].'€</td> <td >'.round($total_a1[1], 0).'</td><td ></td><td ></td><td >'.round($total_a1[2], 0).'</td><td >'.round($total_a1[3], 0).'</td><td >'.round($total_a1[4], 0).'</td><td >'.round($total_a1[5], 0).'</td><td >'.round($total_a1[6], 0).'</td><td >'.round($total_a1[7], 0).'</td><td >'.round($total_a1[8], 0).'</td><td >'.round($total_a1[9], 0).'</td><td >'.round($total_a1[10], 0).'</td><td >'.round($total_a1[11], 0).'</td><td >'.round($total_a1[12], 0).'</td><td >'.round($total_a1[13], 0).'</td><td >'.round($total_a1[14], 0).'</td><td >'.round($total_a1[15], 0).'€</td><td>TOTAL</td></tr>
			
			<tr><form method="get" ><input type="hidden" name="id_resacc"  value="'.$id_resacc.'" /><input type="hidden" name="id_projet"  value="'.$id_projet.'" /><input type="hidden" name="domain"  value="default" /><th BGCOLOR="#CCC" COLSPAN=22>ANNEE 2 | Evolution Quantites <input onchange="submit()" size="2" name="pourcent_2" type="text" value="'.$this->return_poucentage_evo($id_resacc, 'annee2').'" /> %</th></form></tr>';
             echo'<tr bgcolor="#FFEAEA" style="  color: #666;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td ></td> <td ></td><td ></td><td ></td><td style=" font-size:9px; ">100%</td><td style=" font-size:9px; ">'.round($pa2_1, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_2, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_3, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_4, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_5, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_6, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_7, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_8, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_9, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_10, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_11, 0).'%</td><td style=" font-size:9px; ">'.round($pa2_12, 0).'%</td><td ></td><td></td></tr>';
        for ($i=0; $i<count($result2); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
            /*
		
            $qt_jr=($this->return_poucentage_evo($id_resacc,'Annee 2')/100+1)*$result[$i]['quantite_jr'];
		
		
            $qt_an=$qt_jr*$result[$i]['nb_jrs_semaine']*4*$result[$i]['nb_mois_an'];
            $ca=$result[$i]['pvu_ht']*$qt_an;
            $mois =  $qt_an/12;*/
        
            echo'<tr bgcolor='.$color.' style="text-align:right;border:1px solid #CCC">
          <td >'.$result2[$i]['designation'].'</td><td >'.$result2[$i]['type_produits'].'</td>
          <td  >'.$result2[$i]['intitule_compte'].'</td>
            <td >'.$result2[$i]['pvu_ht'].'€</td> <td >'.round($result2[$i]['quantite_jr'], 0).'</td><td >'.$result2[$i]['nb_jrs_semaine'].'</td><td >'.$result2[$i]['nb_mois_an'].'</td><td >'.round($result2[$i]['qt_annuelle'], 0).'</td><td >'.round($result2[$i]['m1'], 0).'</td><td >'.round($result2[$i]['m2'], 0).'</td><td >'.round($result2[$i]['m3'], 0).'</td><td >'.round($result2[$i]['m4'], 0).'</td><td >'.round($result2[$i]['m5'], 0).'</td><td >'.round($result2[$i]['m6'], 0).'</td><td >'.round($result2[$i]['m7'], 0).'</td><td >'.round($result2[$i]['m8'], 0).'</td><td >'.round($result2[$i]['m9'], 0).'</td><td >'.round($result2[$i]['m10'], 0).'</td><td >'.round($result2[$i]['m11'], 0).'</td><td >'.round($result2[$i]['m12'], 0).'</td><td >'.round($result2[$i]['montant_ht'], 0).'€</td><td><a href="javascript::void();" onclick="window.open(\'modifier.php?domain=default&id_projet='.$id_projet.'&id_resacc='.$id_resacc.'&id_resacc_pro_edit='.$result2[$i]['id_resacc_produits'].'\',\'Modification du produits\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1250, height=150\');"><img  src="images/edit.png" /></a><a href="details.php?domain=default&id_projet='.$id_projet.'&id_resacc_pro_delete='.$result2[$i]['id_resacc_produits'].'"><img src="images/delete.png" /></a></td></tr>';
        }
        echo'<tr bgcolor="#E3FECB" style=" color:#060;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td >'.$total_a2[0].'€</td> <td >'.round($total_a2[1], 0).'</td><td ></td><td ></td><td >'.round($total_a2[2], 0).'</td><td >'.round($total_a2[3], 0).'</td><td >'.round($total_a2[4], 0).'</td><td >'.round($total_a2[5], 0).'</td><td >'.round($total_a2[6], 0).'</td><td >'.round($total_a2[7], 0).'</td><td >'.round($total_a2[8], 0).'</td><td >'.round($total_a2[9], 0).'</td><td >'.round($total_a2[10], 0).'</td><td >'.round($total_a2[11], 0).'</td><td >'.round($total_a2[12], 0).'</td><td >'.round($total_a2[13], 0).'</td><td >'.round($total_a2[14], 0).'</td><td >'.round($total_a2[15], 0).'€</td><td>TOTAL</td></tr>
			
			<tr><form method="get" > <input type="hidden" name="domain"  value="default" /><input type="hidden" name="id_projet"  value="'.$id_projet.'" /><input type="hidden" name="id_resacc"  value="'.$id_resacc.'" /> <th BGCOLOR="#CCC" COLSPAN=22>ANNEE 3 | Evolution Quantites <input onchange="submit()" size="2" name="pourcent_3" type="text" value="'.$this->return_poucentage_evo($id_resacc, 'annee3').'" /> %</th></form></tr>';
             echo'<tr bgcolor="#FFEAEA" style="  color: #666;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td ></td> <td ></td><td ></td><td ></td><td style=" font-size:9px; ">100%</td><td style=" font-size:9px; ">'.round($pa3_1, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_2, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_3, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_4, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_5, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_6, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_7, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_8, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_9, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_10, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_11, 0).'%</td><td style=" font-size:9px; ">'.round($pa3_12, 0).'%</td><td ></td><td></td></tr>';
        for ($i=0; $i<count($result3); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
    
            echo'<tr bgcolor='.$color.' style="text-align:right;border:1px solid #CCC">
          <td >'.$result3[$i]['designation'].'</td><td >'.$result3[$i]['type_produits'].'</td>
          <td  >'.$result3[$i]['intitule_compte'].'</td>
            <td >'.$result3[$i]['pvu_ht'].'€</td> <td >'.round($result3[$i]['quantite_jr'], 0).'</td><td >'.$result3[$i]['nb_jrs_semaine'].'</td><td >'.$result3[$i]['nb_mois_an'].'</td><td >'.round($result3[$i]['qt_annuelle'], 0).'</td><td >'.round($result3[$i]['m1'], 0).'</td><td >'.round($result3[$i]['m2'], 0).'</td><td >'.round($result3[$i]['m3'], 0).'</td><td >'.round($result3[$i]['m4'], 0).'</td><td >'.round($result3[$i]['m5'], 0).'</td><td >'.round($result3[$i]['m6'], 0).'</td><td >'.round($result3[$i]['m7'], 0).'</td><td >'.round($result3[$i]['m8'], 0).'</td><td >'.round($result3[$i]['m9'], 0).'</td><td >'.round($result3[$i]['m10'], 0).'</td><td >'.round($result3[$i]['m11'], 0).'</td><td >'.round($result3[$i]['m12'], 0).'</td><td >'.round($result3[$i]['montant_ht'], 0).'€</td><td><a href="javascript::void();" onclick="window.open(\'modifier.php?domain=default&id_projet='.$id_projet.'&id_resacc='.$id_resacc.'&id_resacc_pro_edit='.$result3[$i]['id_resacc_produits'].'\',\'Modification du produits\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=1250, height=150\');"><img  src="images/edit.png" /></a><a href="details.php?domain=default&id_projet='.$id_projet.'&id_resacc_pro_delete='.$result3[$i]['id_resacc_produits'].'"><img src="images/delete.png" /></a></td></tr>';
        }
        echo'<tr bgcolor="#E3FECB" style=" color:#060;text-align:right;border:1px solid #CCC">
          <td ></td><td ></td>
          <td  ></td>
            <td >'.$total_a3[0].'€</td> <td >'.round($total_a3[1], 0).'</td><td ></td><td ></td><td >'.round($total_a3[2], 0).'</td><td >'.round($total_a3[3], 0).'</td><td >'.round($total_a3[4], 0).'</td><td >'.round($total_a3[5], 0).'</td><td >'.round($total_a3[6], 0).'</td><td >'.round($total_a3[7], 0).'</td><td >'.round($total_a3[8], 0).'</td><td >'.round($total_a3[9], 0).'</td><td >'.round($total_a3[10], 0).'</td><td >'.round($total_a3[11], 0).'</td><td >'.round($total_a3[12], 0).'</td><td >'.round($total_a3[13], 0).'</td><td >'.round($total_a3[14], 0).'</td><td >'.round($total_a3[15], 0).'€</td><td>TOTAL</td></tr>
	<tr><th BGCOLOR="#CCC" COLSPAN=22><hr /></tr><tr style="font-weight:bold; background-color: #999; color:#FFF" >
        <td>D&eacute;signation</td>
        <td>Compte Achats</td>
        <td>Compte Produits</td>
        
          <td>PVU HT</td>
          <td  >Qt&eacute; J</td>
          <td >Jr/sem</td>
          <td >Mois/an</td>
          <td  >Qt an</td>
          <td  >M1</td>
          <td  >M2</td>
          <td  >M3</td>
          <td  >M4</td>
          <td  >M5</td>
          <td  >M6</td>
          <td  >M7</td>
          <td  >M8</td>
          <td  >M9</td>
          <td  >M10</td>
          <td  >M11</td>
          <td  >M12</td>
          <td  >CA</td> <td></td></tr><tr>';
    }
    function total($id_resacc, $exercice)
    {
         $requete='SELECT * FROM  '.$this->table_produits.' where id_resacc='.$id_resacc.' and exercice="'.$exercice.'"';
         $result=$this->db->fetchAll($requete);
         
        for ($i=0; $i<count($result); $i++) {
            $pvu = $pvu + $result[$i]['pvu_ht'];
            $qt_j = $qt_j + $result[$i]['quantite_jr'];
            $qt_a = $qt_a + $result[$i]['qt_annuelle'];
            $m1 = $m1 + $result[$i]['m1'];
            $m2 = $m2 + $result[$i]['m2'];
            $m3 = $m3 + $result[$i]['m3'];
            $m4 = $m4 + $result[$i]['m4'];
            $m5 = $m5 + $result[$i]['m5'];
            $m6 = $m6 + $result[$i]['m6'];
            $m7 = $m7 + $result[$i]['m7'];
            $m8 = $m8 + $result[$i]['m8'];
            $m9 = $m9 + $result[$i]['m9'];
            $m10 = $m10 + $result[$i]['m10'];
            $m11 = $m11 + $result[$i]['m11'];
            $m12 = $m12 + $result[$i]['m12'];
            $mt_ht = $mt_ht + $result[$i]['montant_ht'];
        }
         return array($pvu,$qt_j,$qt_a,$m1,$m2,$m3,$m4,$m5,$m6,$m7,$m8,$m9,$m10,$m11,$m12,$mt_ht);
    }
    
    function get_org($id_org)
    {
        if ($id_org!=0) {
            $requete='SELECT * FROM  '.$this->table_organisation.' where id_organisation='.$id_org.'';
     
            $result=$this->db->fetchRow($requete);
        }
        return array($result['code_org'],$result['tel'],$result['email']);
    }
    function get_contact($id_contact)
    {
        if ($id_contact!=0) {
            $requete='SELECT * FROM  '.$this->table_contact.' where id_ben='.$id_contact.'';
     
            $result=$this->db->fetchRow($requete);
        }
        return array($result['nom'],$result['prenom'],$result['tel_pro_1'],$result['email_pro']);
    }
    function voir_aide_financiere($id_resacc_fi)
    {
    
    
     
        $requete='SELECT * FROM  '.$this->table_aide_crea.' where id_resacc_ressources_fi='.$id_resacc_fi.'';
     
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
        
            if ($result[$i]['date_reponse']==0) {
                $dat_reponse=null;
            } else {
                $dat_reponse=date('d/m/Y', $result[$i]['date_reponse']);
            }
        
            if ($result[$i]['date_demande']==0) {
                $dat_demande=null;
            } else {
                $dat_demande=date('d/m/Y', $result[$i]['date_demande']);
            }
        
            if ($result[$i]['frais']==1) {
                $frais='<img src="./images/tick_16.png" />';
            }
        
        


 


            $val_c=$this->get_contact($result[$i]['id_contact']);
            $val=$this->get_org($result[$i]['id_organisation']);
            echo'<tr bgcolor='.$color.'><td>'.$result[$i]['nom_aide'].'</td><td>'.$result[$i]['nature_aide'].'</td><td>'.$result[$i]['type_aide'].'</td><td>'.$result[$i]['montant_demande'].' €</td><td>'.$dat_demande.'</td><td>'.$dat_reponse.'</td><td>'.$result[$i]['reponse'].'</td><td>'.$result[$i]['montant_obtenu'].' €</td><td>'.$result[$i]['decision_ben'].'</td><td><a href=""><span><img src="./images/bulles.png" /> <strong>Infobulle</strong><br/>Tel pro : '.$val[1].' <br/>Email pro : '.$val[2].' </span> '.$val[0].'</a></td><td><a  href=""><span><img src="./images/bulles.png" /> <strong>Infobulle</strong><br/>Tel pro : '.$val_c[2].' <br/>Email pro : '.$val_c[3].' </span>'.$val_c[0].' '.$val_c[1].'</a></td><td> <a href="javascript::void();" onclick="window.open(\'modifier_aide.php?id_resacc_aide_creation='.$result[$i]['id_resacc_aide_creation'].'&domain=default\',\'Modification\',\'menubar=no, status=no, scrollbars=yes, menubar=no, left=0px, width=600, height=800\');"><img  src="images/edit.png" /></a><a href="details_aide.php?domain=default&id_projet='.$result[$i]['id_projet'].'&id_resacc_aide_crea_delete='.$result[$i]['id_resacc_aide_creation'].'"><img src="images/delete.png" /></a></td></tr>';
        }
    }
    
    function voir_investissement($id_projet)
    {
        // echo "voir_investissement ". $id_projet;
        // echo "<br>";
    
        $id_resacc=$this->get_id_resacc($id_projet);
    // echo $id_resacc;
        $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.'';
    
    // echo $requete;

        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
        
            echo'<tr bgcolor='.$color.' style="text-align:right;border:1px solid #CCC">
         <td>'.$result[$i]['exercice'].'</td> <td  >'.$result[$i]['type_immo'].'</td>
          <td  >'.$result[$i]['intitule_compte'].'</td>
          <td >'.$result[$i]['quantite'].'</td>  <td  >'.$result[$i]['pau_ht'].' €</td> <td  >'.$result[$i]['montant_ht'].' €</td> <td  >'.$result[$i]['tva'].' %</td> <td >'.$result[$i]['montant_tva'].' €</td> <td  >'.$result[$i]['montant_ttc'].' €</td><td><a href="javascript::void();" onclick="window.open(\'modifier_in.php?id_resacc_in_edit='.$result[$i]['id_resacc_besoin_fi'].'&id_projet='.$id_projet.'\',\'Modification\',\'menubar=yes, status=no, scrollbars=yes, menubar=no, left=0px, width=1000, height=200\');"><img  src="images/edit.png" /></a> <a href="details.php?domain=default&id_projet='.$id_projet.'&id_resaac_in_delete='.$result[$i]['id_resacc_besoin_fi'].'"><img src="images/delete.png" /></a></td></tr>';
        }
        echo'<tr bgcolor="#CCCCCC" style="text-align:right;border:1px solid #CCC">
          <td></td><td  >'.$result[$i]['type_immo'].'</td>
          <td   >'.$result[$i]['intitule_compte'].'</td>
          <td ></td>  <td  ></td> <td >'.$this->somme_ht($id_projet).' €</td> <td ></td> <td style="color: #F00"   >'.$this->somme_tva($id_projet).' €</td> <td style="color:#090"   >'.$this->somme_ttc($id_projet).' €</td><td></td></tr>';
    }
    
    
    function voir_effectif($id_projet)
    {
    
        echo "voir_effectif";
        echo $id_projet;
        echo "<br>";
    
        $id_resacc=$this->get_id_resacc($id_projet);
    
    
        $requete='SELECT * FROM  egw_resacc_effectif where id_resacc='.$id_resacc.'  order by poste asc';

        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
        
            echo'<tr style=" background-color: '.$color.'; color:#000" >';
       
     
            if ($result[$i]['statut']=="Salarié") {
                $charge_ts = 0.50*$result[$i]['nb_mois']*$result[$i]['renum_mens_brut'].' €';
                $charge_tns=null;
            } else {
                $charge_tns = 0.45*$result[$i]['nb_mois']*$result[$i]['renum_mens_brut'].' €';
                $charge_ts=null;
            }
      
            $renum_mens_brut  =  $renum_mens_brut+$result[$i]['renum_mens_brut'];
              $charge_tns_  =  $charge_tns_+$charge_tns;
              $charge_ts_  =  $charge_ts_+$charge_ts;
      
    
             $renum_an_brut =  $renum_an_brut+($result[$i]['nb_mois']*$result[$i]['renum_mens_brut']);
            $salaire_net = $salaire_net+ ($result[$i]['nb_mois']*$result[$i]['renum_mens_brut']*0.78);
                  echo'
         
        
        <td>'.$result[$i]['exercice'].'</td>
      
       
   <td>'.$result[$i]['poste'].'</td><td>'.$result[$i]['statut'].'</td>
   <td>'.$result[$i]['nb_mois'].' mois</td>
   <td align="right">'.$result[$i]['renum_mens_brut'].' €</td>
   <td  align="right">'.$result[$i]['nb_mois']*$result[$i]['renum_mens_brut'].' €</td>
   <td  align="right">'.$charge_tns.'</td>
   <td  align="right">'.$charge_ts.'</td>
   <td  align="right">'.(($result[$i]['nb_mois']*$result[$i]['renum_mens_brut'])+$charge_ts+$charge_tns).' €</td>
   <td  align="right">'.($result[$i]['nb_mois']*$result[$i]['renum_mens_brut']*0.78).' €</td>
   <td><a href="details.php?id_projet='.$id_projet.'&id_resacc_effectif='.$result[$i]['id_resacc_effectif'].'&domain=default"><img src="index.php_fichiers/delete.png" title="Supprimer" border="0"></a></tr>';
        }
        echo'<tr style=" background-color: #CCC; " >
       
    
        <td></td>
      
       
   <td></td><td></td>
   <td></td>
   <td align="right">'.$renum_mens_brut.' €</td>
   <td  align="right">'.$renum_an_brut.' €</td>
   <td  align="right">'.$charge_tns_.' €</td>
   <td  align="right">'.$charge_ts_.' €</td>
   <td  align="right">'.($renum_an_brut+$charge_ts_+$charge_tns_).' €</td>
   <td  align="right">'.$salaire_net.' €</td>
   <td></td></tr>';
    }
    
    function voir_cr3($id_projet, $nature)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $somme=$this->somme_cr3($id_projet, $nature);
        if ($nature=="produit") {
            $requete='SELECT * FROM  '.$this->table_cr3.' where id_resacc='.$id_resacc.' and nature="'.$nature.'" order by type_produits asc';
        }
        if ($nature=="charge") {
            $requete='SELECT * FROM  '.$this->table_cr3.' where id_resacc='.$id_resacc.' and nature="'.$nature.'" order by intitule_compte asc';
        }
     
     
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#FFF";
            } else {
                $color="#ECF3F4";
            }
        
            echo'<tr style=" background-color: '.$color.'; color:#000" >';
       
            if ($nature=="produit") {
                echo' <td>'.$result[$i]['type_produits'].'</td>';
            } elseif ($nature=="charge") {
                echo'<td>'.$result[$i]['intitule_compte'].'</td>';
            }
       
        
                  echo'<td  align="right">'.$result[$i]['vent'].'</td><td  align="right">'.$result[$i]['evo'].'</td><td  align="right">'.$result[$i]['cf_a2'].'</td><td  align="right">'.$result[$i]['cf_a3'].'</td><td  align="right">'.$result[$i]['tva'].' %</td><td  align="right">'.$result[$i]['delai'].'</td><td  align="right">'.$result[$i]['part_delai'].' %</td><td  align="right">'.round($result[$i]['montant_a1'], 0).'€</td><td align="right"  >'.round($result[$i]['montant_a2'], 0).'€</td><td  align="right">'.round($result[$i]['montant_a3'], 0).'€</td> <td> <a href="javascript::void();" onclick="window.open(\'modifier.php?nature='.$nature.'&domain=default&id_projet='.$id_projet.'&id_resacc_cr3_edit='.$result[$i]['id_resacc_cr3'].'\',\'Modification\',\'menubar=no, status=no, scrollbars=no, menubar=no, left=0px, width=800, height=200\');"><img  src="images/edit.png" /></a> <a href="details.php?id_projet='.$id_projet.'&nature='.$nature.'&id_resacc_cr3_delete='.$result[$i]['id_resacc_cr3'].'&domain=default"><img src="index.php_fichiers/delete.png" title="Supprimer" border="0"></a></td></tr>';
        }
        echo'<tr style=" background-color: #CCC; " >
       
    
         <td></td> <td></td><td></td> <td></td> <td></td> <td></td> <td></td> <td></td>
       
        
          <td  style="color:#090" align="right">'.$somme[0].'€</td><td align="right" style="color:#090"  >'.$somme[1].'€</td><td style="color:#090"  align="right">'.$somme[2].'€</td> <td>TOTAL</td></tr>';
    }
    function somme_tva($id_projet)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.'';
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
              $somme_tva = $somme_tva + $result[$i]['montant_tva'];
        }
        if ($somme_tva!=0) {
            return $somme_tva;
        } else {
            return 0;
        }
    }
    function somme_ttc($id_projet)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.'';
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
              $somme_ttc = $somme_ttc + $result[$i]['montant_ttc'];
        }
        if ($somme_ttc!=0) {
            return $somme_ttc;
        } else {
            return 0;
        }
    }
    function somme_ht($id_projet)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $requete='SELECT * FROM  '.$this->table_investissement.' where id_resacc='.$id_resacc.'';
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
              $somme_ht = $somme_ht + $result[$i]['montant_ht'];
        }
        if ($somme_ht!=0) {
            return $somme_ht;
        } else {
            return 0;
        }
    }
    
    function somme_financement($id_projet)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $requete='SELECT * FROM  '.$this->table_financement.' where id_resacc='.$id_resacc.'';
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
              $somme_financement = $somme_financement + $result[$i]['montant'];
        }
        if ($somme_financement!=0) {
            return $somme_financement;
        } else {
            return 0;
        }
    }
    
    function somme_cr3($id_projet, $nature)
    {
    
        $id_resacc=$this->get_id_resacc($id_projet);
        $requete='SELECT * FROM  '.$this->table_cr3.' where id_resacc='.$id_resacc.' and nature="'.$nature.'"';
        $result=$this->db->fetchAll($requete);
        for ($i=0; $i<count($result); $i++) {
              $somme_a1 = $somme_a1 + $result[$i]['montant_a1'];
              $somme_a2 = $somme_a2 + $result[$i]['montant_a2'];
              $somme_a3 = $somme_a3 + $result[$i]['montant_a3'];
        }
    
    
        return array($somme_a1,$somme_a2,$somme_a3);
    }
    
    function get_projet($id_projet)
    {
        $requete='SELECT * FROM  '.$this->table_projet.' where id_projet='.$id_projet.'';
        $result=$this->db->fetchRow($requete);

        // SPIREA
        $requete = 'SELECT * FROM '.$this->table_projet_organisation.' where id_projet='.$id_projet.'';
        $result_resacc=$this->db->fetchRow($requete);
        if (empty($result_resacc)) {
            $data = array('id_projet' => $id_projet,'id_ben' => $result['id_ben']);
                                                                      
            $this->db->insert($this->table_projet_organisation, $data);
        }
        // FIN SPIREA
    
        return array($result['intitule_projet'],$result['id_coordinateur'],$result['description_projet'],$result['statut'],$result['resultat'],$result['date_debut'],$result['date_fin_reelle'],$result['date_fin_previsionnelle']);
    }
    function return_org_ben($id_projet)
    {
        
        $requete='SELECT * FROM  '.$this->table_projet_organisation.'  where  id_projet='.$id_projet.' ';
        $result=$this->db->fetchRow($requete);
        return array($result['nom_commercial'],$result['raison_sociale'],$result['activite_principale'],$result['type_adresse'],$result['adresse_ligne_1'],$result['adresse_ligne_2'],$result['adresse_ligne_3'],$result['cp'],$result['ville'],$result['region'],$result['pays'],$result['date_immat'],$result['date_debut_activite'],$result['forme_juridique'],$result['siret'],$result['secteur_activite'],$result['dirigeant'],$result['implantation'],$result['regime_imposition'],$result['regime_tva'],$result['regime_fiscal'],$result['regime_social_dirigeant'],$result['statut'],$result['code_naf']);
    }
    function get_identite($id_coordinateur)
    {
    
        $requete='SELECT * FROM  '.$this->table_accounts.' where account_id='.$id_coordinateur.'';
        $result=$this->db->fetchRow($requete);
     // spirea - pas de firstname/lastname dans la table contact
     //return $result['account_firstname'].' '.$result['account_lastname'];
        return $result['account_lid'];
    }
    function voir_projet($categorie, $mot = 'a', $ligne = 0, $limit = 50, $id_compte, $tri = 'date_debut', $cla = 'desc')
    {
        if ($tri=='') {
            $tri='intitule_projet';
        }
        if ($categorie!=null) {
            $requete='SELECT * FROM  '.$this->table_projet.' where (intitule_projet like "%'.$mot.'%" or  description_projet like "%'.$mot.'%" ) and categorie like "'.$categorie.'" order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
        } else {
            $requete='SELECT * FROM  '.$this->table_projet.' where (intitule_projet like "%'.$mot.'%" or  description_projet like "%'.$mot.'%") order by '.$tri.' '.$cla.' limit '.$ligne.','.$limit.'';
        }
 
        $result=$this->db->fetchAll($requete);

        for ($i=0; $i<count($result); $i++) {
            if ($i%2 == null) {
                $color="#ECF3F4	";
            } else {
                $color="#FFF";
            }
        
            echo'<tr bgcolor='.$color.'><td  height="21">
   <a href="details.php?id_projet='.$result[$i]['id_projet'].'&domain=default">'.utf8_encode($result[$i]['intitule_projet']).'</a>
  </td>
  <td  height="21">';
            if ($result[$i]['date_debut']!=null && $result[$i]['date_debut']!=0) {
                echo date("d/m/Y", $result[$i]['date_debut']);
            }
            echo' </td>
 
  <td  height="21">';
            if ($result[$i]['date_fin_reelle']!=null && $result[$i]['date_fin_reelle']!=0) {
                echo date("d/m/Y", $result[$i]['date_fin_reelle']);
            }
            echo'</font>
  </td>
  <td  height="21">
     '.utf8_encode($this->get_identite($result[$i]['id_coordinateur'])).'</font>
  </td>  <td height="21">
     '.$result[$i]['statut'].'</font>
  </td>
  <td  height="21">
    '.utf8_encode($result[$i]['description_projet']).'</font>
  </td>
<td class="body"><a href="details.php?id_projet='.$result[$i]['id_projet'].'&domain=default"><img src="index.php_fichiers/view.png" title="Voir" border="0"></a> <a href="details.php?id_projet='.$result[$i]['id_projet'].'&domain=default"><img src="index.php_fichiers/edit.png" title="Modifier" border="0"></a><a
target="_blank" href="/bp/public/?id_projet='.$result[$i]['id_projet'].'&id_employe='.$id_compte.'&domain=default" ><img src="index.php_fichiers/logo_apsie_bp_petit.png" title="Business Plan" border="0"/></a></td>
</tr>


';
        }
        echo'</table></center>';
    }
    
    function update_projet($id_projet, $id_modifier, $id_coordinateur, $description, $statut, $resultat, $date_fin, $date_fin_pre)
    {
        $date_fin_pre=explode("/", $date_fin_pre);
        $date_fin=explode("/", $date_fin);
        $data = array ('date_last_modified' => time() , 'id_modifier' => $id_modifier ,  'id_coordinateur' => $id_coordinateur ,  'description_projet' => $description , 'statut' => $statut, 'resultat' => $resultat ,  'date_fin_previsionnelle' => mktime(0, 0, 0, $date_fin_pre[1], $date_fin_pre[0], $date_fin_pre[2]) , 'date_fin_reelle' => mktime(0, 0, 0, $date_fin[1], $date_fin[0], $date_fin[2]));
        $this->db->update($this->table_projet, $data, 'id_projet='.$id_projet.'');
    }
    
    function delete_investissement($id_resacc_besoin_fi)
    {
        
        $data = array('id_resacc_besoin_fi='.$id_resacc_besoin_fi);
        $this->db->delete($this->table_investissement, $data);
    }
    function delete_effectif($id_resacc_effectif)
    {
        
        $data = array('id_resacc_effectif='.$id_resacc_effectif);
        $this->db->delete('egw_resacc_effectif', $data);
    }
    
    
    function delete_aide_crea($id_resacc_aide_creation)
    {
        
        $data = array('id_resacc_aide_creation='.$id_resacc_aide_creation);
        $this->db->delete($this->table_aide_crea, $data);
    }
    
    function delete_cr3($id_resacc_cr3, $nature)
    {
        
        $where[] = 'id_resacc_cr3='.$id_resacc_cr3;
        
    //$data = array('id_resacc_besoin_fi='.$id_resacc_besoin_fi);
        $this->db->delete($this->table_cr3, $where);
    }
    
    function delete_produits($id_resacc_produits)
    {
        
        $data = array('id_resacc_produits='.$id_resacc_produits);
        $this->db->delete($this->table_produits, $data);
    }
    
    
    function delete_financement($id_resacc_fi)
    {
        
        $data = array('id_resacc_ressources_fi='.$id_resacc_fi);
        $this->db->delete($this->table_financement, $data);
    }
    
    function xls_plan_fi_3ans($id_projet){
        $id_resacc=$this->get_id_resacc($id_projet);
        include("PHPExcel/IOFactory.php");

        if (!file_exists("../lea/Projet1_1/doc/plan_fi.xls")) {
            exit();
        }

        $objPHPExcel = PHPExcel_IOFactory::load("../lea/Projet1_1/doc/plan_fi.xls");
        $sheetupa=$objPHPExcel->getActiveSheet();
   
        $requete = 'SELECT * from '.$this->table_investissement.' where id_resacc='.$id_resacc.'';
        $result = $this->db->fetchAll($requete);
    // print_r($requete);exit;
		for ($i=0; $i<=count($result); $i++) {
            $valeur=$result[$i]['montant_ht'];
            $tva=$tva+$result[$i]['montant_tva'];
        // print_r($result);exit;
            //caracteres pas pris en compte
            $intitule=str_replace("é", "e", utf8_encode($result[$i]['intitule_compte']));
            $intitule=str_replace("+", " ", $intitule);
            $intitule=str_replace("(", " ", $intitule);
            $intitule=str_replace(")", " ", $intitule);
            $intitule=str_replace("ô", "o", $intitule);
            $intitule=str_replace("ê", "e", $intitule);
        
	        if ($result[$i]['exercice']=='Depart') {
                $lettre="B";
            } elseif ($result[$i]['exercice']=='Annee 1') {
                $lettre="C";
            } elseif ($result[$i]['exercice']=='Annee 2') {
                $lettre="D";
            } elseif ($result[$i]['exercice']=='Annee 3') {
                $lettre="E";
            }
        
        
            if (ereg("Frais d'etablissement", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'5', $valeur);
            }     
            if (ereg("Concession, brevet, marque, licences, logiciels", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'6', $valeur);
            }
            if (ereg("Frais de recherche et de developpement", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'7', $valeur);
            }
            if (ereg("Droit de mutation", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'8', $valeur);
            }
            if (ereg("Honoraires", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'9', $valeur);
            }
            if (ereg("Frais dossier banque  frais garantie FAG ou FGIF", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'10', $valeur);
            }
            if (ereg("Droits au bail - Pas de porte", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'11', $valeur);
            }
            if (ereg("Fonds commerce  incorporel ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'12', $valeur);
            }
            if (ereg("Publicite de Demarrage", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'13', $valeur);
            }
            if (ereg("1er loyer credit bail 1 HT", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'14', $valeur);
            }
            if (ereg("1er loyer credit bail 2 HT", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'15', $valeur);
            }
            if (ereg("Frais soutien commercial", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'16', $valeur);
            }
            if (ereg("Fonds commerce  corporel ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'18', $valeur);
            }
            if (ereg("Terrain", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'19', $valeur);
            }
            if (ereg("Construction", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'20', $valeur);
            }
            if (ereg("Materiel et outillage", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'21', $valeur);
            }
            if (ereg("Installation technique, amenagement", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'22', $valeur);
            }
            if (ereg("Materiel de transport", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'23', $valeur);
            }
            if (ereg("Materiel bureautique, informatique", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'24', $valeur);
            }
            if (ereg("Mobilier", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'25', $valeur);
            }
            if (ereg("Autre  preciser ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'26', $valeur);
            }
            if (ereg("Participations", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'28', $valeur);
            }
            if (ereg("Depot de garantie, Caution", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'29', $valeur);
            }
            if (ereg("Caution bancaire  fonds bloque ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'30', $valeur);
            }
            if (ereg("Autres titres immobilises", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'31', $valeur);
            }
            if (ereg("Compte courant Createur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'33', $valeur);
            }
            if (ereg("Compte courant Associes", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'34', $valeur);
            }
            if (ereg("Pret d'honneur - PFIL", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'35', $valeur);
            }
            if (ereg("Pret NACRE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'36', $valeur);
            }
            if (ereg("Emprunt bancaire", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'37', $valeur);
            }
            if (ereg("Emprunt PCE - OSEO", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'38', $valeur);
            }
            if (ereg("Credit-vendeur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'39', $valeur);
            }
            if (ereg("Emprunt solidaire - ADIE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'40', $valeur);
            }
            if (ereg("Pret d'honneur - ADIE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'41', $valeur);
            }
            if (ereg("Autres emprunts", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'42', $valeur);
            }
            if (ereg("Stock de depart", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'44', $valeur);
            }
            if (ereg("Besoin en fonds de roulement  dont treso au demarr. ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'45', $valeur);
            }
	        //somme TVA
	        $sheetupa->setCellValue(''.$lettre.'46', $tva);
        }

    
        $requete = 'SELECT * from '.$this->table_financement.' where id_resacc='.$id_resacc.'';
        $result = $this->db->fetchAll($requete);
    
        for ($i=0; $i<count($result); $i++) {
            $valeur=$result[$i]['montant'];
        
            //caracteres pas pris en compte
            $intitule=str_replace("é", "e", $result[$i]['intitule_compte']);
            $intitule=str_replace("+", " ", $intitule);
            $intitule=str_replace("(", " ", $intitule);
            $intitule=str_replace(")", " ", $intitule);
            $intitule=str_replace("ô", "o", $intitule);
            $intitule=str_replace("ê", "e", $intitule);
            $intitule=str_replace("°", " ", $intitule);
            $intitule=str_replace("à", "a", $intitule);
        
            if ($result[$i]['exercice']=='Depart') {
                $lettre="B";
            } elseif ($result[$i]['exercice']=='Annee 1') {
                $lettre="C";
            } elseif ($result[$i]['exercice']=='Annee 2') {
                $lettre="D";
            } elseif ($result[$i]['exercice']=='Annee 3') {
                $lettre="E";
            }
        
        
            if (ereg("Capital numeraire Createur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'52', $valeur);
            }
        
            
            if (ereg("Capital en nature Createur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'53', $valeur);
            }
        
            
            if (ereg("Capital en industrie Createur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'54', $valeur);
            }
        
            
            if (ereg("Capital numeraire Associes", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'55', $valeur);
            }
        
            
            if (ereg("Capital en nature Associes", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'56', $valeur);
            }
        
        
            if (ereg("Capital en industrie Associes", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'57', $valeur);
            }
        
            if (ereg("Compte courant Createur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'59', $valeur);
            }
        
            if (ereg("Compte courant Associes", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'60', $valeur);
            }
        
            if (ereg("Pret d'honneur - PFIL", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'62', $valeur);
            }
        
            if (ereg("Pret NACRE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'63', $valeur);
            }
        
            if (ereg("Emprunt bancaire", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'64', $valeur);
            }

            if (ereg("Emprunt PCE - OSEO", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'65', $valeur);
            }
        
            if (ereg("Credit-vendeur", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'66', $valeur);
            }
            
            if (ereg("Emprunt solidaire - ADIE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'67', $valeur);
            }
        
            if (ereg("Pret d'honneur - ADIE", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'68', $valeur);
            }
        
        
            if (ereg("Escompte ou affacturage", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'69', $valeur);
            }
        
            if (ereg("Pret relais de TVA sur immobilisations", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'70', $valeur);
            }
        
            if (ereg("Decouvert autorise", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'71', $valeur);
            }
        
        
            if (ereg("Autres emprunts", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'72', $valeur);
            }
        
            if (ereg("Subvention d'investissement 1", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'74', $valeur);
            }
        
            if (ereg("Subvention d'investissement 2", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'75', $valeur);
            }
        
            if (ereg("Aide a la reprise fds artisanal  Region ", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'76', $valeur);
            }
        
            if (ereg("Contrat Devlpt Trans /Creat  OSEO", $intitule)) {
                $sheetupa->setCellValue(''.$lettre.'77', $valeur);
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Plan_fi3ans.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    
    
    function xls_cr_3ans($id_projet)
    {
                                             
         $id_resacc=$this->get_id_resacc($id_projet);

        include("PHPExcel/IOFactory.php");



        if (!file_exists("../lea/Projet1_1/doc/CR_3ans.xls")) {
            exit();
        }

    

        $objPHPExcel = PHPExcel_IOFactory::load("../lea/Projet1_1/doc/CR_3ans.xls");
//$sheetupa=$objPHPExcel->getActiveSheet()->SetTitle('Feuil11');
//$objPHPExcel->setActiveSheetIndex(0);
        $sheetupa=$objPHPExcel->getActiveSheet();
/*$sheetupa->setCellValue('B28',$nbre);
$sheetupa->setCellValue('C28',$nbre2);*/

        $requete = 'SELECT * from '.$this->table_cr3.' where id_resacc='.$id_resacc.' and nature="produit"';
        $result = $this->db->fetchAll($requete);
    
        for ($i=0; $i<count($result); $i++) {
            //caracteres pas pris en compte
            $intitule=str_replace("é", "e", $result[$i]['type_produits']);
            $intitule=str_replace("+", " ", $intitule);
            $intitule=str_replace("(", " ", $intitule);
            $intitule=str_replace(")", " ", $intitule);
            $intitule=str_replace("ô", "o", $intitule);
            $intitule=str_replace("ê", "e", $intitule);
        
            if (ereg("Vente de produits finis, marchandises  5,5% ", $intitule)) {
                $sheetupa->setCellValue('B6', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D6', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F6', $result[$i]['montant_a3']);
            }
        
        
            if (ereg("Vente de produits finis, marchandises  10,0% ", $intitule)) {
                $sheetupa->setCellValue('B7', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D7', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F7', $result[$i]['montant_a3']);
            }
        
        
            if (ereg("Vente de produits finis, marchandises  20,0% ", $intitule)) {
                $sheetupa->setCellValue('B8', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D8', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F8', $result[$i]['montant_a3']);
            }
        
            if (ereg("Prestations de services  5,5% ", $intitule)) {
                $sheetupa->setCellValue('B9', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D9', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F9', $result[$i]['montant_a3']);
            }
            if (ereg("Prestations de services  10,0% ", $intitule)) {
                $sheetupa->setCellValue('B10', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D10', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F10', $result[$i]['montant_a3']);
            }

            if (ereg("Prestations de services  20,0% ", $intitule)) {
                $sheetupa->setCellValue('B11', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D11', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F11', $result[$i]['montant_a3']);
            }
        
            if (ereg("Commissions perçues", $intitule)) {
                $sheetupa->setCellValue('B12', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D12', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F12', $result[$i]['montant_a3']);
            }
        
            if (ereg("Subventions d'exploitation", $intitule)) {
                $sheetupa->setCellValue('B13', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D13', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F13', $result[$i]['montant_a3']);
            }
            if (ereg("Ristournes", $intitule)) {
                $sheetupa->setCellValue('B14', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D14', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F14', $result[$i]['montant_a3']);
            }
            if (ereg("Autres produits", $intitule)) {
                $sheetupa->setCellValue('B15', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D15', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F15', $result[$i]['montant_a3']);
            }
        }
    
    
        $requete = 'SELECT * from '.$this->table_cr3.' where id_resacc='.$id_resacc.' and nature="charge"';
		// print_r($requete);exit;
        $result = $this->db->fetchAll($requete);
    
        for ($i=0; $i<count($result); $i++) {
            //caracteres pas pris en compte
            $intitule=str_replace("é", "e", $result[$i]['intitule_compte']);
            $intitule=str_replace("+", " ", $intitule);
            $intitule=str_replace("(", " ", $intitule);
            $intitule=str_replace(")", " ", $intitule);
            $intitule=str_replace("ô", "o", $intitule);
            $intitule=str_replace("ê", "e", $intitule);
        
        
            if (ereg("Achats de marchandises  5,5% ", $intitule)) {
                $sheetupa->setCellValue('B19', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D19', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F19', $result[$i]['montant_a3']);
            }
            if (ereg("Achats de marchandises  20% ", $intitule)) {
				// echo 'ici';
                $sheetupa->setCellValue('B20', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D20', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F20', $result[$i]['montant_a3']);
            }
            if (ereg("Achats mat. Premières  5,5% ", $intitule)) {
                $sheetupa->setCellValue('B21', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D21', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F21', $result[$i]['montant_a3']);
            }
            if (ereg("Achats mat. Premières  20% ", $intitule)) {
                $sheetupa->setCellValue('B22', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D22', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F22', $result[$i]['montant_a3']);
            }
        
        
            if (ereg("Fournitures d'entretien", $intitule)) {
                $sheetupa->setCellValue('B23', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D23', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F23', $result[$i]['montant_a3']);
            }
            if (ereg("Emballages", $intitule)) {
                $sheetupa->setCellValue('B24', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D24', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F24', $result[$i]['montant_a3']);
            }
            if (ereg("Fournitures diverses", $intitule)) {
                $sheetupa->setCellValue('B25', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D25', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F25', $result[$i]['montant_a3']);
            }
            if (ereg("Petit materiel", $intitule)) {
                $sheetupa->setCellValue('B26', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D26', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F26', $result[$i]['montant_a3']);
            }
            if (ereg("Commissions versees - Redevances / CA", $intitule)) {
                $sheetupa->setCellValue('B29', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D29', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F29', $result[$i]['montant_a3']);
            }
        
            if (ereg("Sous-traitance", $intitule)) {
                $sheetupa->setCellValue('B30', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D30', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F30', $result[$i]['montant_a3']);
            }
        
            if (ereg("Credit-bail leasing", $intitule)) {
                $sheetupa->setCellValue('B31', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D31', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F31', $result[$i]['montant_a3']);
            }
        
            if (ereg("Locations immobilières", $intitule)) {
                $sheetupa->setCellValue('B32', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D32', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F32', $result[$i]['montant_a3']);
            }
        
            if (ereg("Charges locatives", $intitule)) {
                $sheetupa->setCellValue('B33', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D33', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F33', $result[$i]['montant_a3']);
            }
        
            if (ereg("Locations mobilières", $intitule)) {
                $sheetupa->setCellValue('B34', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D34', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F34', $result[$i]['montant_a3']);
            }
        
            if (ereg("Entretiens et reparations", $intitule)) {
                $sheetupa->setCellValue('B35', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D35', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F35', $result[$i]['montant_a3']);
            }
            if (ereg("Fournitures non stockees", $intitule)) {
                $sheetupa->setCellValue('B36', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D36', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F36', $result[$i]['montant_a3']);
            }
            if (ereg("Primes d'assurances", $intitule)) {
                $sheetupa->setCellValue('B37', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D37', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F37', $result[$i]['montant_a3']);
            }
            if (ereg("Personnel exterieur", $intitule)) {
                $sheetupa->setCellValue('B38', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D38', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F38', $result[$i]['montant_a3']);
            }
        
            if (ereg("Documentation", $intitule)) {
                $sheetupa->setCellValue('B39', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D39', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F39', $result[$i]['montant_a3']);
            }
            if (ereg("Publicite, communication", $intitule)) {
                $sheetupa->setCellValue('B40', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D40', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F40', $result[$i]['montant_a3']);
            }
        
            if (ereg("Frais postaux, Telephone", $intitule)) {
                $sheetupa->setCellValue('B41', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D41', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F41', $result[$i]['montant_a3']);
            }
            if (ereg("Autres", $intitule)) {
                $sheetupa->setCellValue('B42', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D42', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F42', $result[$i]['montant_a3']);
            }
            if (ereg("Honoraires", $intitule)) {
                $sheetupa->setCellValue('B43', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D43', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F43', $result[$i]['montant_a3']);
            }
            if (ereg("Deplacements, missions, receptions", $intitule)) {
                $sheetupa->setCellValue('B44', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D44', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F44', $result[$i]['montant_a3']);
            }
            if (ereg("Carburant", $intitule)) {
                $sheetupa->setCellValue('B45', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D45', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F45', $result[$i]['montant_a3']);
            }
            if (ereg("Transport", $intitule)) {
                $sheetupa->setCellValue('B46', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D46', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F46', $result[$i]['montant_a3']);
            }
            if (ereg("Services bancaires", $intitule)) {
                $sheetupa->setCellValue('B47', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D47', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F47', $result[$i]['montant_a3']);
            }
        
            if (ereg("Remuneration nette des salaries", $intitule)) {
                $sheetupa->setCellValue('B50', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D50', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F50', $result[$i]['montant_a3']);
            }
        
            if (ereg("Charges sociales des salaries", $intitule)) {
                $sheetupa->setCellValue('B51', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D51', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F51', $result[$i]['montant_a3']);
            }
        
            if (ereg("Remuneration du dirigeant", $intitule)) {
                $sheetupa->setCellValue('B52', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D52', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F52', $result[$i]['montant_a3']);
            }
            if (ereg("Charges sociales du dirigeant", $intitule)) {
                $sheetupa->setCellValue('B53', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D53', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F53', $result[$i]['montant_a3']);
            }
        
            if (ereg("Taxe d'apprentissage", $intitule)) {
                $sheetupa->setCellValue('B54', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D54', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F54', $result[$i]['montant_a3']);
            }
        
            if (ereg("Taxe sur les vehicule de societe", $intitule)) {
                $sheetupa->setCellValue('B55', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D55', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F55', $result[$i]['montant_a3']);
            }
        
            if (ereg("Contribution economique territoriale  CET ", $intitule)) {
                $sheetupa->setCellValue('B56', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D56', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F56', $result[$i]['montant_a3']);
            }
        
            if (ereg("Dotations aux amortissements et provisions", $intitule)) {
                $sheetupa->setCellValue('B60', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D60', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F60', $result[$i]['montant_a3']);
            }
            if (ereg("Impots sur les benefices  15% ", $intitule)) {
                $sheetupa->setCellValue('B68', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D68', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F68', $result[$i]['montant_a3']);
            }
            if (ereg("Impots sur les benefices  33% ", $intitule)) {
                $sheetupa->setCellValue('B70', $result[$i]['montant_a1']);
                $sheetupa->setCellValue('D70', $result[$i]['montant_a2']);
                $sheetupa->setCellValue('F70', $result[$i]['montant_a3']);
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="CR_3ans.xls"');
        header('Cache-Control: max-age=0');



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');


        $objWriter->save('php://output');



        exit;
    }
    
    function _destruct()
    {
        mysql_close($this->db);
    }
}
