<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwOrganisation
 *
 * @ORM\Table(name="egw_organisation")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwOrganisationRepository")
 */
class EgwOrganisation
{
    /**
     * @var integer $idOrganisation
     *
     * @ORM\Column(name="id_organisation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOrganisation;

    /**
     * @var string $idOwner
     *
     * @ORM\Column(name="id_owner", type="integer")
     */
    private $idOwner;

    /**
     * @var string $dateCreation
     *
     * @ORM\Column(name="date_creation", type="string", length=255)
     */
    private $dateCreation;

    /**
     * @var string $idModifier
     *
     * @ORM\Column(name="id_modifier", type="integer")
     */
    private $idModifier;

    /**
     * @var string $idDirecteur
     *
     * @ORM\Column(name="id_directeur", type="integer")
     */
    private $idDirecteur;

    /**
     * @var string $dateLastModified
     *
     * @ORM\Column(name="date_last_modified", type="string", length=255)
     */
    private $dateLastModified;

    /**
     * @var string $categorieOrg
     *
     * @ORM\Column(name="categorie_org", type="string", length=255)
     */
    private $categorieOrg;

    /**
     * @var string $codeOrg
     *
     * @ORM\Column(name="code_org", type="string", length=255)
     */
    private $codeOrg;

    /**
     * @var string $nomOrganisme
     *
     * @ORM\Column(name="nom_organisme", type="string", length=255)
     */
    private $nomOrganisme;

    /**
     * @var string $adresseLigne1
     *
     * @ORM\Column(name="adresse_ligne_1", type="string", length=255)
     */
    private $adresseLigne1;

    /**
     * @var string $adresseLigne2
     *
     * @ORM\Column(name="adresse_ligne_2", type="string", length=255)
     */
    private $adresseLigne2;

    /**
     * @var string $adresseLigne3
     *
     * @ORM\Column(name="adresse_ligne_3", type="string", length=255)
     */
    private $adresseLigne3;

    /**
     * @var string $cp
     *
     * @ORM\Column(name="cp", type="string", length=5)
     */
    private $cp;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string $region
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string $pays
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string $tel2
     *
     * @ORM\Column(name="tel2", type="string", length=255)
     */
    private $tel2;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string $siteWeb
     *
     * @ORM\Column(name="site_web", type="string", length=255)
     */
    private $siteWeb;

    /**
     * @var string $secteurActivite
     *
     * @ORM\Column(name="secteur_activite", type="string", length=255)
     */
    private $secteurActivite;

    /**
     * @var string $idProjet
     *
     * @ORM\Column(name="id_projet", type="integer")
     */
    private $idProjet;

    /**
     * @var string $idBen
     *
     * @ORM\Column(name="id_ben", type="integer")
     */
    private $idBen;

    /**
     * @var string $activitePrincipale
     *
     * @ORM\Column(name="activite_principale", type="string", length=255)
     */
    private $activitePrincipale;

    /**
     * @var string $raisonSociale
     *
     * @ORM\Column(name="raison_sociale", type="string", length=255)
     */
    private $raisonSociale;

    /**
     * @var string $typeAdresse
     *
     * @ORM\Column(name="type_adresse", type="string", length=255)
     */
    private $typeAdresse;

    /**
     * @var string $dateImmat
     *
     * @ORM\Column(name="date_immat", type="string", length=255)
     */
    private $dateImmat;

    /**
     * @var string $dateDebutActivite
     *
     * @ORM\Column(name="date_debut_activite", type="string", length=255)
     */
    private $dateDebutActivite;

    /**
     * @var string $formeJuridique
     *
     * @ORM\Column(name="forme_juridique", type="string", length=255)
     */
    private $formeJuridique;

    /**
     * @var string $siret
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret;

    /**
     * @var string $codeNaf
     *
     * @ORM\Column(name="code_naf", type="string", length=255)
     */
    private $codeNaf;

    /**
     * @var string $dirigeant
     *
     * @ORM\Column(name="dirigeant", type="string", length=255)
     */
    private $dirigeant;

    /**
     * @var string $implantation
     *
     * @ORM\Column(name="implantation", type="string", length=255)
     */
    private $implantation;

    /**
     * @var string $regimeImposition
     *
     * @ORM\Column(name="regime_imposition", type="string", length=255)
     */
    private $regimeImposition;

    /**
     * @var string $regimeTva
     *
     * @ORM\Column(name="regime_tva", type="string", length=255)
     */
    private $regimeTva;

    /**
     * @var string $regimeFiscal
     *
     * @ORM\Column(name="regime_fiscal", type="string", length=255)
     */
    private $regimeFiscal;

    /**
     * @var string $regimeSocialDirigeant
     *
     * @ORM\Column(name="regime_social_dirigeant", type="string", length=255)
     */
    private $regimeSocialDirigeant;

    /**
     * @var string $statutOrg
     *
     * @ORM\Column(name="statut_org", type="string", length=255)
     */
    private $statutOrg;

    /**
     * @var string $reseau
     *
     * @ORM\Column(name="reseau", type="string", length=255)
     */
    private $reseau;



    /**
     * @ORM\ManyToOne(targetEntity="EgwContact", inversedBy="organisations")
     * @ORM\JoinColumn(name="id_ben", referencedColumnName="id_ben")
     */
    private $contact;


    /**
     * Set contact
     *
     * @param Lea\PrestaBundle\Entity\EgwContact $contact
     * @return EgwPrestation
     */
    public function setContact(\Lea\PrestaBundle\Entity\EgwContact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return Lea\PrestaBundle\Entity\EgwContact 
     */
    public function getContact()
    {
        return $this->contact;
    }



    /**
     * Get idOrganisation
     *
     * @return integer 
     */
    public function getIdOrganisation()
    {
        return $this->idOrganisation;
    }

    /**
     * Set idOwner
     *
     * @param string $idOwner
     * @return EgwOrganisation
     */
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;
    
        return $this;
    }

    /**
     * Get idOwner
     *
     * @return string 
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set dateCreation
     *
     * @param string $dateCreation
     * @return EgwOrganisation
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return string 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set idModifier
     *
     * @param string $idModifier
     * @return EgwOrganisation
     */
    public function setIdModifier($idModifier)
    {
        $this->idModifier = $idModifier;
    
        return $this;
    }

    /**
     * Get idModifier
     *
     * @return string 
     */
    public function getIdModifier()
    {
        return $this->idModifier;
    }

    /**
     * Set idDirecteur
     *
     * @param string $idDirecteur
     * @return EgwOrganisation
     */
    public function setIdDirecteur($idDirecteur)
    {
        $this->idDirecteur = $idDirecteur;
    
        return $this;
    }

    /**
     * Get idDirecteur
     *
     * @return string 
     */
    public function getIdDirecteur()
    {
        return $this->idDirecteur;
    }

    /**
     * Set dateLastModified
     *
     * @param string $dateLastModified
     * @return EgwOrganisation
     */
    public function setDateLastModified($dateLastModified)
    {
        $this->dateLastModified = $dateLastModified;
    
        return $this;
    }

    /**
     * Get dateLastModified
     *
     * @return string 
     */
    public function getDateLastModified()
    {
        return $this->dateLastModified;
    }

    /**
     * Set categorieOrg
     *
     * @param string $categorieOrg
     * @return EgwOrganisation
     */
    public function setCategorieOrg($categorieOrg)
    {
        $this->categorieOrg = $categorieOrg;
    
        return $this;
    }

    /**
     * Get categorieOrg
     *
     * @return string 
     */
    public function getCategorieOrg()
    {
        return $this->categorieOrg;
    }

    /**
     * Set codeOrg
     *
     * @param string $codeOrg
     * @return EgwOrganisation
     */
    public function setCodeOrg($codeOrg)
    {
        $this->codeOrg = $codeOrg;
    
        return $this;
    }

    /**
     * Get codeOrg
     *
     * @return string 
     */
    public function getCodeOrg()
    {
        return $this->codeOrg;
    }

    /**
     * Set nomOrganisme
     *
     * @param string $nomOrganisme
     * @return EgwOrganisation
     */
    public function setNomOrganisme($nomOrganisme)
    {
        $this->nomOrganisme = $nomOrganisme;
    
        return $this;
    }

    /**
     * Get nomOrganisme
     *
     * @return string 
     */
    public function getNomOrganisme()
    {
        return $this->nomOrganisme;
    }

    /**
     * Set adresseLigne1
     *
     * @param string $adresseLigne1
     * @return EgwOrganisation
     */
    public function setAdresseLigne1($adresseLigne1)
    {
        $this->adresseLigne1 = $adresseLigne1;
    
        return $this;
    }

    /**
     * Get adresseLigne1
     *
     * @return string 
     */
    public function getAdresseLigne1()
    {
        return $this->adresseLigne1;
    }

    /**
     * Set adresseLigne2
     *
     * @param string $adresseLigne2
     * @return EgwOrganisation
     */
    public function setAdresseLigne2($adresseLigne2)
    {
        $this->adresseLigne2 = $adresseLigne2;
    
        return $this;
    }

    /**
     * Get adresseLigne2
     *
     * @return string 
     */
    public function getAdresseLigne2()
    {
        return $this->adresseLigne2;
    }

    /**
     * Set adresseLigne3
     *
     * @param string $adresseLigne3
     * @return EgwOrganisation
     */
    public function setAdresseLigne3($adresseLigne3)
    {
        $this->adresseLigne3 = $adresseLigne3;
    
        return $this;
    }

    /**
     * Get adresseLigne3
     *
     * @return string 
     */
    public function getAdresseLigne3()
    {
        return $this->adresseLigne3;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return EgwOrganisation
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return EgwOrganisation
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return EgwOrganisation
     */
    public function setRegion($region)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return EgwOrganisation
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return EgwOrganisation
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return EgwOrganisation
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;
    
        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return EgwOrganisation
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EgwOrganisation
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return EgwOrganisation
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;
    
        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set secteurActivite
     *
     * @param string $secteurActivite
     * @return EgwOrganisation
     */
    public function setSecteurActivite($secteurActivite)
    {
        $this->secteurActivite = $secteurActivite;
    
        return $this;
    }

    /**
     * Get secteurActivite
     *
     * @return string 
     */
    public function getSecteurActivite()
    {
        return $this->secteurActivite;
    }

    /**
     * Set idProjet
     *
     * @param string $idProjet
     * @return EgwOrganisation
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    
        return $this;
    }

    /**
     * Get id_projet
     *
     * @return string 
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set idBen
     *
     * @param string $idBen
     * @return EgwOrganisation
     */
    public function setIdBen($idBen)
    {
        $this->idBen = $idBen;
    
        return $this;
    }

    /**
     * Get idBen
     *
     * @return string 
     */
    public function getIdBen()
    {
        return $this->idBen;
    }

    /**
     * Set activitePrincipale
     *
     * @param string $activitePrincipale
     * @return EgwOrganisation
     */
    public function setActivitePrincipale($activitePrincipale)
    {
        $this->activitePrincipale = $activitePrincipale;
    
        return $this;
    }

    /**
     * Get activitePrincipale
     *
     * @return string 
     */
    public function getActivitePrincipale()
    {
        return $this->activitePrincipale;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return EgwOrganisation
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set typeAdresse
     *
     * @param string $typeAdresse
     * @return EgwOrganisation
     */
    public function setTypeAdresse($typeAdresse)
    {
        $this->typeAdresse = $typeAdresse;
    
        return $this;
    }

    /**
     * Get typeAdresse
     *
     * @return string 
     */
    public function getTypeAdresse()
    {
        return $this->typeAdresse;
    }

    /**
     * Set dateImmat
     *
     * @param string $dateImmat
     * @return EgwOrganisation
     */
    public function setDateImmat($dateImmat)
    {
        $this->dateImmat = $dateImmat;
    
        return $this;
    }

    /**
     * Get dateImmat
     *
     * @return string 
     */
    public function getDateImmat()
    {
        return $this->dateImmat;
    }

    /**
     * Set dateDebutActivite
     *
     * @param string $dateDebutActivite
     * @return EgwOrganisation
     */
    public function setDateDebutActivite($dateDebutActivite)
    {
        $this->dateDebutActivite = $dateDebutActivite;
    
        return $this;
    }

    /**
     * Get dateDebutActivite
     *
     * @return string 
     */
    public function getDateDebutActivite()
    {
        return $this->dateDebutActivite;
    }

    /**
     * Set formeJuridique
     *
     * @param string $formeJuridique
     * @return EgwOrganisation
     */
    public function setFormeJuridique($formeJuridique)
    {
        $this->formeJuridique = $formeJuridique;
    
        return $this;
    }

    /**
     * Get formeJuridique
     *
     * @return string 
     */
    public function getFormeJuridique()
    {
        return $this->formeJuridique;
    }

    /**
     * Set siret
     *
     * @param string $siret
     * @return EgwOrganisation
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }


    /**
     * Set codeNaf
     *
     * @param string $codeNaf
     * @return EgwOrganisation
     */
    public function setCodeNaf($codeNaf)
    {
        $this->codeNaf = $codeNaf;
    
        return $this;
    }

    /**
     * Get codeNaf
     *
     * @return string 
     */
    public function getCodeNaf()
    {
        return $this->codeNaf;
    }

    /**
     * Set dirigeant
     *
     * @param string $dirigeant
     * @return EgwOrganisation
     */
    public function setDirigeant($dirigeant)
    {
        $this->dirigeant = $dirigeant;
    
        return $this;
    }

    /**
     * Get dirigeant
     *
     * @return string 
     */
    public function getDirigeant()
    {
        return $this->dirigeant;
    }

    /**
     * Set implantation
     *
     * @param string $implantation
     * @return EgwOrganisation
     */
    public function setImplantation($implantation)
    {
        $this->implantation = $implantation;
    
        return $this;
    }

    /**
     * Get implantation
     *
     * @return string 
     */
    public function getImplantation()
    {
        return $this->implantation;
    }

    /**
     * Set regimeImposition
     *
     * @param string $regimeImposition
     * @return EgwOrganisation
     */
    public function setRegimeImposition($regimeImposition)
    {
        $this->regimeImposition = $regimeImposition;
    
        return $this;
    }

    /**
     * Get regimeImposition
     *
     * @return string 
     */
    public function getRegimeImposition()
    {
        return $this->regimeImposition;
    }

    /**
     * Set regimeTva
     *
     * @param string $regimeTva
     * @return EgwOrganisation
     */
    public function setRegimeTva($regimeTva)
    {
        $this->regimeTva = $regimeTva;
    
        return $this;
    }

    /**
     * Get regimeTva
     *
     * @return string 
     */
    public function getRegimeTva()
    {
        return $this->regimeTva;
    }

    /**
     * Set regimeFiscal
     *
     * @param string $regimeFiscal
     * @return EgwOrganisation
     */
    public function setRegimeFiscal($regimeFiscal)
    {
        $this->regimeFiscal = $regimeFiscal;
    
        return $this;
    }

    /**
     * Get regimeFiscal
     *
     * @return string 
     */
    public function getRegimeFiscal()
    {
        return $this->regimeFiscal;
    }

    /**
     * Set regimeSocialDirigeant
     *
     * @param string $regimeSocialDirigeant
     * @return EgwOrganisation
     */
    public function setRegimeSocialDirigeant($regimeSocialDirigeant)
    {
        $this->regimeSocialDirigeant = $regimeSocialDirigeant;
    
        return $this;
    }

    /**
     * Get regimeSocialDirigeant
     *
     * @return string 
     */
    public function getRegimeSocialDirigeant()
    {
        return $this->regimeSocialDirigeant;
    }

    /**
     * Set statutOrg
     *
     * @param string $statutOrg
     * @return EgwOrganisation
     */
    public function setStatutOrg($statutOrg)
    {
        $this->statutOrg = $statutOrg;
    
        return $this;
    }

    /**
     * Get statutOrg
     *
     * @return string 
     */
    public function getStatutOrg()
    {
        return $this->statutOrg;
    }

    /**
     * Set reseau
     *
     * @param string $reseau
     * @return EgwOrganisation
     */
    public function setReseau($reseau)
    {
        $this->reseau = $reseau;
    
        return $this;
    }

    /**
     * Get reseau
     *
     * @return string 
     */
    public function getReseau()
    {
        return $this->reseau;
    }
}