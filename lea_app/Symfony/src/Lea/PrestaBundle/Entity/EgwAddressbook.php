<?php

namespace Lea\PrestaBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwAddressbook
 *
 * @ORM\Table(name="egw_addressbook")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwAddressbookRepository")
 */
class EgwAddressbook
{
    /**
     * @var integer $contactId
     *
     * @ORM\Column(name="contact_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contactId;

    /**
     * @var string $contactTid
     *
     * @ORM\Column(name="contact_tid", type="string", length=1, nullable=true)
     */
    private $contactTid;

    /**
     * @var integer $contactOwner
     *
     * @ORM\Column(name="contact_owner", type="bigint", nullable=false)
     */
    private $contactOwner;

    /**
     * @var boolean $contactPrivate
     *
     * @ORM\Column(name="contact_private", type="boolean", nullable=true)
     */
    private $contactPrivate;

    /**
     * @var string $catId
     *
     * @ORM\Column(name="cat_id", type="string", length=255, nullable=true)
     */
    private $catId;

    /**
     * @var string $nFamily
     *
     * @ORM\Column(name="n_family", type="string", length=64, nullable=true)
     */
    private $nFamily;

    /**
     * @var string $nGiven
     *
     * @ORM\Column(name="n_given", type="string", length=64, nullable=true)
     */
    private $nGiven;

    /**
     * @var string $nMiddle
     *
     * @ORM\Column(name="n_middle", type="string", length=64, nullable=true)
     */
    private $nMiddle;

    /**
     * @var string $nPrefix
     *
     * @ORM\Column(name="n_prefix", type="string", length=64, nullable=true)
     */
    private $nPrefix;

    /**
     * @var string $nSuffix
     *
     * @ORM\Column(name="n_suffix", type="string", length=64, nullable=true)
     */
    private $nSuffix;

    /**
     * @var string $nFn
     *
     * @ORM\Column(name="n_fn", type="string", length=128, nullable=true)
     */
    private $nFn;

    /**
     * @var string $nFileas
     *
     * @ORM\Column(name="n_fileas", type="string", length=255, nullable=true)
     */
    private $nFileas;

    /**
     * @var string $contactBday
     *
     * @ORM\Column(name="contact_bday", type="string", length=12, nullable=true)
     */
    private $contactBday;

    /**
     * @var string $orgName
     *
     * @ORM\Column(name="org_name", type="string", length=128, nullable=true)
     */
    private $orgName;

    /**
     * @var string $orgUnit
     *
     * @ORM\Column(name="org_unit", type="string", length=64, nullable=true)
     */
    private $orgUnit;

    /**
     * @var string $contactTitle
     *
     * @ORM\Column(name="contact_title", type="string", length=64, nullable=true)
     */
    private $contactTitle;

    /**
     * @var string $contactRole
     *
     * @ORM\Column(name="contact_role", type="string", length=64, nullable=true)
     */
    private $contactRole;

    /**
     * @var string $contactAssistent
     *
     * @ORM\Column(name="contact_assistent", type="string", length=64, nullable=true)
     */
    private $contactAssistent;

    /**
     * @var string $contactRoom
     *
     * @ORM\Column(name="contact_room", type="string", length=64, nullable=true)
     */
    private $contactRoom;

    /**
     * @var string $adrOneStreet
     *
     * @ORM\Column(name="adr_one_street", type="string", length=64, nullable=true)
     */
    private $adrOneStreet;

    /**
     * @var string $adrOneStreet2
     *
     * @ORM\Column(name="adr_one_street2", type="string", length=64, nullable=true)
     */
    private $adrOneStreet2;

    /**
     * @var string $adrOneLocality
     *
     * @ORM\Column(name="adr_one_locality", type="string", length=64, nullable=true)
     */
    private $adrOneLocality;

    /**
     * @var string $adrOneRegion
     *
     * @ORM\Column(name="adr_one_region", type="string", length=64, nullable=true)
     */
    private $adrOneRegion;

    /**
     * @var string $adrOnePostalcode
     *
     * @ORM\Column(name="adr_one_postalcode", type="string", length=64, nullable=true)
     */
    private $adrOnePostalcode;

    /**
     * @var string $adrOneCountryname
     *
     * @ORM\Column(name="adr_one_countryname", type="string", length=64, nullable=true)
     */
    private $adrOneCountryname;

    /**
     * @var string $contactLabel
     *
     * @ORM\Column(name="contact_label", type="text", nullable=true)
     */
    private $contactLabel;

    /**
     * @var string $adrTwoStreet
     *
     * @ORM\Column(name="adr_two_street", type="string", length=64, nullable=true)
     */
    private $adrTwoStreet;

    /**
     * @var string $adrTwoStreet2
     *
     * @ORM\Column(name="adr_two_street2", type="string", length=64, nullable=true)
     */
    private $adrTwoStreet2;

    /**
     * @var string $adrTwoLocality
     *
     * @ORM\Column(name="adr_two_locality", type="string", length=64, nullable=true)
     */
    private $adrTwoLocality;

    /**
     * @var string $adrTwoRegion
     *
     * @ORM\Column(name="adr_two_region", type="string", length=64, nullable=true)
     */
    private $adrTwoRegion;

    /**
     * @var string $adrTwoPostalcode
     *
     * @ORM\Column(name="adr_two_postalcode", type="string", length=64, nullable=true)
     */
    private $adrTwoPostalcode;

    /**
     * @var string $adrTwoCountryname
     *
     * @ORM\Column(name="adr_two_countryname", type="string", length=64, nullable=true)
     */
    private $adrTwoCountryname;

    /**
     * @var string $telWork
     *
     * @ORM\Column(name="tel_work", type="string", length=40, nullable=true)
     */
    private $telWork;

    /**
     * @var string $telCell
     *
     * @ORM\Column(name="tel_cell", type="string", length=40, nullable=true)
     */
    private $telCell;

    /**
     * @var string $telFax
     *
     * @ORM\Column(name="tel_fax", type="string", length=40, nullable=true)
     */
    private $telFax;

    /**
     * @var string $telAssistent
     *
     * @ORM\Column(name="tel_assistent", type="string", length=40, nullable=true)
     */
    private $telAssistent;

    /**
     * @var string $telCar
     *
     * @ORM\Column(name="tel_car", type="string", length=40, nullable=true)
     */
    private $telCar;

    /**
     * @var string $telPager
     *
     * @ORM\Column(name="tel_pager", type="string", length=40, nullable=true)
     */
    private $telPager;

    /**
     * @var string $telHome
     *
     * @ORM\Column(name="tel_home", type="string", length=40, nullable=true)
     */
    private $telHome;

    /**
     * @var string $telFaxHome
     *
     * @ORM\Column(name="tel_fax_home", type="string", length=40, nullable=true)
     */
    private $telFaxHome;

    /**
     * @var string $telCellPrivate
     *
     * @ORM\Column(name="tel_cell_private", type="string", length=40, nullable=true)
     */
    private $telCellPrivate;

    /**
     * @var string $telOther
     *
     * @ORM\Column(name="tel_other", type="string", length=40, nullable=true)
     */
    private $telOther;

    /**
     * @var string $telPrefer
     *
     * @ORM\Column(name="tel_prefer", type="string", length=32, nullable=true)
     */
    private $telPrefer;

    /**
     * @var string $contactEmail
     *
     * @ORM\Column(name="contact_email", type="string", length=128, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string $contactEmailHome
     *
     * @ORM\Column(name="contact_email_home", type="string", length=128, nullable=true)
     */
    private $contactEmailHome;

    /**
     * @var string $contactUrl
     *
     * @ORM\Column(name="contact_url", type="string", length=128, nullable=true)
     */
    private $contactUrl;

    /**
     * @var string $contactUrlHome
     *
     * @ORM\Column(name="contact_url_home", type="string", length=128, nullable=true)
     */
    private $contactUrlHome;

    /**
     * @var string $contactFreebusyUri
     *
     * @ORM\Column(name="contact_freebusy_uri", type="string", length=128, nullable=true)
     */
    private $contactFreebusyUri;

    /**
     * @var string $contactCalendarUri
     *
     * @ORM\Column(name="contact_calendar_uri", type="string", length=128, nullable=true)
     */
    private $contactCalendarUri;

    /**
     * @var string $contactNote
     *
     * @ORM\Column(name="contact_note", type="text", nullable=true)
     */
    private $contactNote;

    /**
     * @var string $contactTz
     *
     * @ORM\Column(name="contact_tz", type="string", length=8, nullable=true)
     */
    private $contactTz;

    /**
     * @var string $contactGeo
     *
     * @ORM\Column(name="contact_geo", type="string", length=32, nullable=true)
     */
    private $contactGeo;

    /**
     * @var string $contactPubkey
     *
     * @ORM\Column(name="contact_pubkey", type="text", nullable=true)
     */
    private $contactPubkey;

    /**
     * @var integer $contactCreated
     *
     * @ORM\Column(name="contact_created", type="bigint", nullable=true)
     */
    private $contactCreated;

    /**
     * @var integer $contactCreator
     *
     * @ORM\Column(name="contact_creator", type="integer", nullable=false)
     */
    private $contactCreator;

    /**
     * @var integer $contactModified
     *
     * @ORM\Column(name="contact_modified", type="bigint", nullable=false)
     */
    private $contactModified;

    /**
     * @var integer $contactModifier
     *
     * @ORM\Column(name="contact_modifier", type="integer", nullable=true)
     */
    private $contactModifier;

    /**
     * @var string $contactJpegphoto
     *
     * @ORM\Column(name="contact_jpegphoto", type="blob", nullable=true)
     */
    private $contactJpegphoto;

     /**
     * @var string $accountId
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;
 
	
	
    /**
     * @var integer $contactEtag
     *
     * @ORM\Column(name="contact_etag", type="integer", nullable=true)
     */
    private $contactEtag;

    /**
     * @var string $contactUid
     *
     * @ORM\Column(name="contact_uid", type="string", length=255, nullable=true)
     */
    private $contactUid;

    /**
     * @var string $adrOneCountrycode
     *
     * @ORM\Column(name="adr_one_countrycode", type="string", length=2, nullable=true)
     */
    private $adrOneCountrycode;

    /**
     * @var string $adrTwoCountrycode
     *
     * @ORM\Column(name="adr_two_countrycode", type="string", length=2, nullable=true)
     */
    private $adrTwoCountrycode;

    /**
     * @var string $carddavName
     *
     * @ORM\Column(name="carddav_name", type="string", length=64, nullable=true)
     */
    private $carddavName;

    /**
     * @var string $niveauFormation
     *
     * @ORM\Column(name="niveau_formation", type="string", length=128, nullable=false)
     */
    private $niveauFormation;

    /**
     * @var string $intituleFormation
     *
     * @ORM\Column(name="intitule_formation", type="string", length=128, nullable=false)
     */
    private $intituleFormation;

    /**
     * @var string $niveauFormationProjet
     *
     * @ORM\Column(name="niveau_formation_projet", type="string", length=128, nullable=false)
     */
    private $niveauFormationProjet;

    /**
     * @var string $intituleFormationProjet
     *
     * @ORM\Column(name="intitule_formation_projet", type="string", length=128, nullable=false)
     */
    private $intituleFormationProjet;

    /**
     * @var string $dateDebutPoste
     *
     * @ORM\Column(name="date_debut_poste", type="string", length=64, nullable=false)
     */
    private $dateDebutPoste;

    /**
     * @var string $dateFinPoste
     *
     * @ORM\Column(name="date_fin_poste", type="string", length=64, nullable=false)
     */
    private $dateFinPoste;

    /**
     * @var string $poste
     *
     * @ORM\Column(name="poste", type="string", length=64, nullable=false)
     */
    private $poste;

    /**
     * @var string $qualification
     *
     * @ORM\Column(name="qualification", type="string", length=64, nullable=false)
     */
    private $qualification;

    /**
     * @var string $contrat
     *
     * @ORM\Column(name="contrat", type="string", length=64, nullable=false)
     */
    private $contrat;

    /**
     * @var string $contratAide
     *
     * @ORM\Column(name="contrat_aide", type="string", length=64, nullable=false)
     */
    private $contratAide;

    /**
     * @var string $siret
     *
     * @ORM\Column(name="siret", type="string", length=64, nullable=false)
     */
    private $siret;

    /**
     * @var integer $dateImmat
     *
     * @ORM\Column(name="date_immat", type="bigint", nullable=false)
     */
    private $dateImmat;

    /**
     * @var string $formeJuridique
     *
     * @ORM\Column(name="forme_juridique", type="string", length=64, nullable=false)
     */
    private $formeJuridique;

    /**
     * @var integer $capital
     *
     * @ORM\Column(name="capital", type="integer", nullable=false)
     */
    private $capital;

    /**
     * @var string $codeSafir
     *
     * @ORM\Column(name="code_safir", type="string", length=64, nullable=false)
     */
    private $codeSafir;

    /**
     * @var string $statutFormation1
     *
     * @ORM\Column(name="statut_formation1", type="string", length=64, nullable=false)
     */
    private $statutFormation1;

    /**
     * @var string $statutFormation2
     *
     * @ORM\Column(name="statut_formation2", type="string", length=64, nullable=false)
     */
    private $statutFormation2;

    /**
     * @var integer $dateFormation1
     *
     * @ORM\Column(name="date_formation1", type="bigint", nullable=false)
     */
    private $dateFormation1;

    /**
     * @var integer $dateFormation2
     *
     * @ORM\Column(name="date_formation2", type="bigint", nullable=false)
     */
    private $dateFormation2;

    /**
     * @var integer $coteFormation1
     *
     * @ORM\Column(name="cote_formation1", type="integer", nullable=false)
     */
    private $coteFormation1;

    /**
     * @var integer $coteFormation2
     *
     * @ORM\Column(name="cote_formation2", type="integer", nullable=false)
     */
    private $coteFormation2;

     /**
    * @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="contact")
    */
    protected $prestations;
     /**
    * @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="contactP")
    */
    protected $prestationsP;
    
     /**
    * @ORM\OneToMany(targetEntity="EgwContactParcoursPro", mappedBy="parcoursProContact")
    */
    protected $contactParcoursPro;
    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->prestationsP = new ArrayCollection();
        $this->contactParcoursPro = new ArrayCollection();

        // SPIREA - Code en dur
        $this->contactTid = 'n';
    }
    

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Get idBen
     *
     * @return integer 
     */
    public function getIdBen()
    {
        return $this->contactId;
    }

    /**
     * Set contactTid
     *
     * @param string $contactTid
     * @return EgwAddressbook
     */
    public function setContactTid($contactTid)
    {
        $this->contactTid = $contactTid;
    
        return $this;
    }

    /**
     * Get contactTid
     *
     * @return string 
     */
    public function getContactTid()
    {
        return $this->contactTid;
    }

    /**
     * Set contactOwner
     *
     * @param integer $contactOwner
     * @return EgwAddressbook
     */
    public function setContactOwner($contactOwner)
    {
        $this->contactOwner = $contactOwner;
    
        return $this;
    }

    /**
     * Get contactOwner
     *
     * @return integer 
     */
    public function getContactOwner()
    {
        return $this->contactOwner;
    }

    /**
     * Set contactPrivate
     *
     * @param boolean $contactPrivate
     * @return EgwAddressbook
     */
    public function setContactPrivate($contactPrivate)
    {
        $this->contactPrivate = $contactPrivate;
    
        return $this;
    }

    /**
     * Get contactPrivate
     *
     * @return boolean 
     */
    public function getContactPrivate()
    {
        return $this->contactPrivate;
    }

    /**
     * Set catId
     *
     * @param string $catId
     * @return EgwAddressbook
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;
    
        return $this;
    }

    /**
     * Get catId
     *
     * @return string 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set nFamily
     *
     * @param string $nFamily
     * @return EgwAddressbook
     */
    public function setNFamily($nFamily)
    {
        $this->nFamily = $nFamily;
    
        return $this;
    }

    /**
     * Get nFamily
     *
     * @return string 
     */
    public function getNFamily()
    {
        return $this->nFamily;
    }

    /**
     * Set nGiven
     *
     * @param string $nGiven
     * @return EgwAddressbook
     */
    public function setNGiven($nGiven)
    {
        $this->nGiven = $nGiven;
    
        return $this;
    }

    /**
     * Get nGiven
     *
     * @return string 
     */
    public function getNGiven()
    {
        return $this->nGiven;
    }

    /**
     * Set nMiddle
     *
     * @param string $nMiddle
     * @return EgwAddressbook
     */
    public function setNMiddle($nMiddle)
    {
        $this->nMiddle = $nMiddle;
    
        return $this;
    }

    /**
     * Get nMiddle
     *
     * @return string 
     */
    public function getNMiddle()
    {
        return $this->nMiddle;
    }

    /**
     * Set nPrefix
     *
     * @param string $nPrefix
     * @return EgwAddressbook
     */
    public function setNPrefix($nPrefix)
    {
        $this->nPrefix = $nPrefix;
    
        return $this;
    }

    /**
     * Get nPrefix
     *
     * @return string 
     */
    public function getNPrefix()
    {
        return $this->nPrefix;
    }

    /**
     * Set nSuffix
     *
     * @param string $nSuffix
     * @return EgwAddressbook
     */
    public function setNSuffix($nSuffix)
    {
        $this->nSuffix = $nSuffix;
    
        return $this;
    }

    /**
     * Get nSuffix
     *
     * @return string 
     */
    public function getNSuffix()
    {
        return $this->nSuffix;
    }

    /**
     * Set nFn
     *
     * @param string $nFn
     * @return EgwAddressbook
     */
    public function setNFn($nFn)
    {
        $this->nFn = $nFn;
    
        return $this;
    }

    /**
     * Get nFn
     *
     * @return string 
     */
    public function getNFn()
    {
        return $this->nFn;
    }

    /**
     * Set nFileas
     *
     * @param string $nFileas
     * @return EgwAddressbook
     */
    public function setNFileas($nFileas)
    {
        $this->nFileas = $nFileas;
    
        return $this;
    }

    /**
     * Get nFileas
     *
     * @return string 
     */
    public function getNFileas()
    {
        return $this->nFileas;
    }

    /**
     * Set contactBday
     *
     * @param string $contactBday
     * @return EgwAddressbook
     */
    public function setContactBday($contactBday)
    {
        $this->contactBday = $contactBday;
    
        return $this;
    }

    /**
     * Get contactBday
     *
     * @return string 
     */
    public function getContactBday()
    {
        return $this->contactBday;
    }

    /**
     * Set orgName
     *
     * @param string $orgName
     * @return EgwAddressbook
     */
    public function setOrgName($orgName)
    {
        $this->orgName = $orgName;
    
        return $this;
    }

    /**
     * Get orgName
     *
     * @return string 
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Set orgUnit
     *
     * @param string $orgUnit
     * @return EgwAddressbook
     */
    public function setOrgUnit($orgUnit)
    {
        $this->orgUnit = $orgUnit;
    
        return $this;
    }

    /**
     * Get orgUnit
     *
     * @return string 
     */
    public function getOrgUnit()
    {
        return $this->orgUnit;
    }

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     * @return EgwAddressbook
     */
    public function setContactTitle($contactTitle)
    {
        $this->contactTitle = $contactTitle;
    
        return $this;
    }

    /**
     * Get contactTitle
     *
     * @return string 
     */
    public function getContactTitle()
    {
        return $this->contactTitle;
    }

    /**
     * Set contactRole
     *
     * @param string $contactRole
     * @return EgwAddressbook
     */
    public function setContactRole($contactRole)
    {
        $this->contactRole = $contactRole;
    
        return $this;
    }

    /**
     * Get contactRole
     *
     * @return string 
     */
    public function getContactRole()
    {
        return $this->contactRole;
    }

    /**
     * Set contactAssistent
     *
     * @param string $contactAssistent
     * @return EgwAddressbook
     */
    public function setContactAssistent($contactAssistent)
    {
        $this->contactAssistent = $contactAssistent;
    
        return $this;
    }

    /**
     * Get contactAssistent
     *
     * @return string 
     */
    public function getContactAssistent()
    {
        return $this->contactAssistent;
    }

    /**
     * Set contactRoom
     *
     * @param string $contactRoom
     * @return EgwAddressbook
     */
    public function setContactRoom($contactRoom)
    {
        $this->contactRoom = $contactRoom;
    
        return $this;
    }

    /**
     * Get contactRoom
     *
     * @return string 
     */
    public function getContactRoom()
    {
        return $this->contactRoom;
    }

    /**
     * Set adrOneStreet
     *
     * @param string $adrOneStreet
     * @return EgwAddressbook
     */
    public function setAdrOneStreet($adrOneStreet)
    {
        $this->adrOneStreet = $adrOneStreet;
    
        return $this;
    }

    /**
     * Get adrOneStreet
     *
     * @return string 
     */
    public function getAdrOneStreet()
    {
        return $this->adrOneStreet;
    }

    /**
     * Set adrOneStreet2
     *
     * @param string $adrOneStreet2
     * @return EgwAddressbook
     */
    public function setAdrOneStreet2($adrOneStreet2)
    {
        $this->adrOneStreet2 = $adrOneStreet2;
    
        return $this;
    }

    /**
     * Get adrOneStreet2
     *
     * @return string 
     */
    public function getAdrOneStreet2()
    {
        return $this->adrOneStreet2;
    }

    /**
     * Set adrOneLocality
     *
     * @param string $adrOneLocality
     * @return EgwAddressbook
     */
    public function setAdrOneLocality($adrOneLocality)
    {
        $this->adrOneLocality = $adrOneLocality;
    
        return $this;
    }

    /**
     * Get adrOneLocality
     *
     * @return string 
     */
    public function getAdrOneLocality()
    {
        return $this->adrOneLocality;
    }

    /**
     * Set adrOneRegion
     *
     * @param string $adrOneRegion
     * @return EgwAddressbook
     */
    public function setAdrOneRegion($adrOneRegion)
    {
        $this->adrOneRegion = $adrOneRegion;
    
        return $this;
    }

    /**
     * Get adrOneRegion
     *
     * @return string 
     */
    public function getAdrOneRegion()
    {
        return $this->adrOneRegion;
    }

    /**
     * Set adrOnePostalcode
     *
     * @param string $adrOnePostalcode
     * @return EgwAddressbook
     */
    public function setAdrOnePostalcode($adrOnePostalcode)
    {
        $this->adrOnePostalcode = $adrOnePostalcode;
    
        return $this;
    }

    /**
     * Get adrOnePostalcode
     *
     * @return string 
     */
    public function getAdrOnePostalcode()
    {
        return $this->adrOnePostalcode;
    }

    /**
     * Set adrOneCountryname
     *
     * @param string $adrOneCountryname
     * @return EgwAddressbook
     */
    public function setAdrOneCountryname($adrOneCountryname)
    {
        $this->adrOneCountryname = $adrOneCountryname;
    
        return $this;
    }

    /**
     * Get adrOneCountryname
     *
     * @return string 
     */
    public function getAdrOneCountryname()
    {
        return $this->adrOneCountryname;
    }

    /**
     * Set contactLabel
     *
     * @param string $contactLabel
     * @return EgwAddressbook
     */
    public function setContactLabel($contactLabel)
    {
        $this->contactLabel = $contactLabel;
    
        return $this;
    }

    /**
     * Get contactLabel
     *
     * @return string 
     */
    public function getContactLabel()
    {
        return $this->contactLabel;
    }

    /**
     * Set adrTwoStreet
     *
     * @param string $adrTwoStreet
     * @return EgwAddressbook
     */
    public function setAdrTwoStreet($adrTwoStreet)
    {
        $this->adrTwoStreet = $adrTwoStreet;
    
        return $this;
    }

    /**
     * Get adrTwoStreet
     *
     * @return string 
     */
    public function getAdrTwoStreet()
    {
        return $this->adrTwoStreet;
    }

    /**
     * Set adrTwoStreet2
     *
     * @param string $adrTwoStreet2
     * @return EgwAddressbook
     */
    public function setAdrTwoStreet2($adrTwoStreet2)
    {
        $this->adrTwoStreet2 = $adrTwoStreet2;
    
        return $this;
    }

    /**
     * Get adrTwoStreet2
     *
     * @return string 
     */
    public function getAdrTwoStreet2()
    {
        return $this->adrTwoStreet2;
    }

    /**
     * Set adrTwoLocality
     *
     * @param string $adrTwoLocality
     * @return EgwAddressbook
     */
    public function setAdrTwoLocality($adrTwoLocality)
    {
        $this->adrTwoLocality = $adrTwoLocality;
    
        return $this;
    }

    /**
     * Get adrTwoLocality
     *
     * @return string 
     */
    public function getAdrTwoLocality()
    {
        return $this->adrTwoLocality;
    }

    /**
     * Set adrTwoRegion
     *
     * @param string $adrTwoRegion
     * @return EgwAddressbook
     */
    public function setAdrTwoRegion($adrTwoRegion)
    {
        $this->adrTwoRegion = $adrTwoRegion;
    
        return $this;
    }

    /**
     * Get adrTwoRegion
     *
     * @return string 
     */
    public function getAdrTwoRegion()
    {
        return $this->adrTwoRegion;
    }

    /**
     * Set adrTwoPostalcode
     *
     * @param string $adrTwoPostalcode
     * @return EgwAddressbook
     */
    public function setAdrTwoPostalcode($adrTwoPostalcode)
    {
        $this->adrTwoPostalcode = $adrTwoPostalcode;
    
        return $this;
    }

    /**
     * Get adrTwoPostalcode
     *
     * @return string 
     */
    public function getAdrTwoPostalcode()
    {
        return $this->adrTwoPostalcode;
    }

    /**
     * Set adrTwoCountryname
     *
     * @param string $adrTwoCountryname
     * @return EgwAddressbook
     */
    public function setAdrTwoCountryname($adrTwoCountryname)
    {
        $this->adrTwoCountryname = $adrTwoCountryname;
    
        return $this;
    }

    /**
     * Get adrTwoCountryname
     *
     * @return string 
     */
    public function getAdrTwoCountryname()
    {
        return $this->adrTwoCountryname;
    }

    /**
     * Set telWork
     *
     * @param string $telWork
     * @return EgwAddressbook
     */
    public function setTelWork($telWork)
    {
        $this->telWork = $telWork;
    
        return $this;
    }

    /**
     * Get telWork
     *
     * @return string 
     */
    public function getTelWork()
    {
        return $this->telWork;
    }

    /**
     * Set telCell
     *
     * @param string $telCell
     * @return EgwAddressbook
     */
    public function setTelCell($telCell)
    {
        $this->telCell = $telCell;
    
        return $this;
    }

    /**
     * Get telCell
     *
     * @return string 
     */
    public function getTelCell()
    {
        return $this->telCell;
    }

    /**
     * Set telFax
     *
     * @param string $telFax
     * @return EgwAddressbook
     */
    public function setTelFax($telFax)
    {
        $this->telFax = $telFax;
    
        return $this;
    }

    /**
     * Get telFax
     *
     * @return string 
     */
    public function getTelFax()
    {
        return $this->telFax;
    }

    /**
     * Set telAssistent
     *
     * @param string $telAssistent
     * @return EgwAddressbook
     */
    public function setTelAssistent($telAssistent)
    {
        $this->telAssistent = $telAssistent;
    
        return $this;
    }

    /**
     * Get telAssistent
     *
     * @return string 
     */
    public function getTelAssistent()
    {
        return $this->telAssistent;
    }

    /**
     * Set telCar
     *
     * @param string $telCar
     * @return EgwAddressbook
     */
    public function setTelCar($telCar)
    {
        $this->telCar = $telCar;
    
        return $this;
    }

    /**
     * Get telCar
     *
     * @return string 
     */
    public function getTelCar()
    {
        return $this->telCar;
    }

    /**
     * Set telPager
     *
     * @param string $telPager
     * @return EgwAddressbook
     */
    public function setTelPager($telPager)
    {
        $this->telPager = $telPager;
    
        return $this;
    }

    /**
     * Get telPager
     *
     * @return string 
     */
    public function getTelPager()
    {
        return $this->telPager;
    }

    /**
     * Set telHome
     *
     * @param string $telHome
     * @return EgwAddressbook
     */
    public function setTelHome($telHome)
    {
        $this->telHome = $telHome;
    
        return $this;
    }

    /**
     * Get telHome
     *
     * @return string 
     */
    public function getTelHome()
    {
        return $this->telHome;
    }

    /**
     * Set telFaxHome
     *
     * @param string $telFaxHome
     * @return EgwAddressbook
     */
    public function setTelFaxHome($telFaxHome)
    {
        $this->telFaxHome = $telFaxHome;
    
        return $this;
    }

    /**
     * Get telFaxHome
     *
     * @return string 
     */
    public function getTelFaxHome()
    {
        return $this->telFaxHome;
    }

    /**
     * Set telCellPrivate
     *
     * @param string $telCellPrivate
     * @return EgwAddressbook
     */
    public function setTelCellPrivate($telCellPrivate)
    {
        $this->telCellPrivate = $telCellPrivate;
    
        return $this;
    }

    /**
     * Get telCellPrivate
     *
     * @return string 
     */
    public function getTelCellPrivate()
    {
        return $this->telCellPrivate;
    }

    /**
     * Set telOther
     *
     * @param string $telOther
     * @return EgwAddressbook
     */
    public function setTelOther($telOther)
    {
        $this->telOther = $telOther;
    
        return $this;
    }

    /**
     * Get telOther
     *
     * @return string 
     */
    public function getTelOther()
    {
        return $this->telOther;
    }

    /**
     * Set telPrefer
     *
     * @param string $telPrefer
     * @return EgwAddressbook
     */
    public function setTelPrefer($telPrefer)
    {
        $this->telPrefer = $telPrefer;
    
        return $this;
    }

    /**
     * Get telPrefer
     *
     * @return string 
     */
    public function getTelPrefer()
    {
        return $this->telPrefer;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return EgwAddressbook
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    
        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string 
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactEmailHome
     *
     * @param string $contactEmailHome
     * @return EgwAddressbook
     */
    public function setContactEmailHome($contactEmailHome)
    {
        $this->contactEmailHome = $contactEmailHome;
    
        return $this;
    }

    /**
     * Get contactEmailHome
     *
     * @return string 
     */
    public function getContactEmailHome()
    {
        return $this->contactEmailHome;
    }

    /**
     * Set contactUrl
     *
     * @param string $contactUrl
     * @return EgwAddressbook
     */
    public function setContactUrl($contactUrl)
    {
        $this->contactUrl = $contactUrl;
    
        return $this;
    }

    /**
     * Get contactUrl
     *
     * @return string 
     */
    public function getContactUrl()
    {
        return $this->contactUrl;
    }

    /**
     * Set contactUrlHome
     *
     * @param string $contactUrlHome
     * @return EgwAddressbook
     */
    public function setContactUrlHome($contactUrlHome)
    {
        $this->contactUrlHome = $contactUrlHome;
    
        return $this;
    }

    /**
     * Get contactUrlHome
     *
     * @return string 
     */
    public function getContactUrlHome()
    {
        return $this->contactUrlHome;
    }

    /**
     * Set contactFreebusyUri
     *
     * @param string $contactFreebusyUri
     * @return EgwAddressbook
     */
    public function setContactFreebusyUri($contactFreebusyUri)
    {
        $this->contactFreebusyUri = $contactFreebusyUri;
    
        return $this;
    }

    /**
     * Get contactFreebusyUri
     *
     * @return string 
     */
    public function getContactFreebusyUri()
    {
        return $this->contactFreebusyUri;
    }

    /**
     * Set contactCalendarUri
     *
     * @param string $contactCalendarUri
     * @return EgwAddressbook
     */
    public function setContactCalendarUri($contactCalendarUri)
    {
        $this->contactCalendarUri = $contactCalendarUri;
    
        return $this;
    }

    /**
     * Get contactCalendarUri
     *
     * @return string 
     */
    public function getContactCalendarUri()
    {
        return $this->contactCalendarUri;
    }

    /**
     * Set contactNote
     *
     * @param string $contactNote
     * @return EgwAddressbook
     */
    public function setContactNote($contactNote)
    {
        $this->contactNote = $contactNote;
    
        return $this;
    }

    /**
     * Get contactNote
     *
     * @return string 
     */
    public function getContactNote()
    {
        return $this->contactNote;
    }

    /**
     * Set contactTz
     *
     * @param string $contactTz
     * @return EgwAddressbook
     */
    public function setContactTz($contactTz)
    {
        $this->contactTz = $contactTz;
    
        return $this;
    }

    /**
     * Get contactTz
     *
     * @return string 
     */
    public function getContactTz()
    {
        return $this->contactTz;
    }

    /**
     * Set contactGeo
     *
     * @param string $contactGeo
     * @return EgwAddressbook
     */
    public function setContactGeo($contactGeo)
    {
        $this->contactGeo = $contactGeo;
    
        return $this;
    }

    /**
     * Get contactGeo
     *
     * @return string 
     */
    public function getContactGeo()
    {
        return $this->contactGeo;
    }

    /**
     * Set contactPubkey
     *
     * @param string $contactPubkey
     * @return EgwAddressbook
     */
    public function setContactPubkey($contactPubkey)
    {
        $this->contactPubkey = $contactPubkey;
    
        return $this;
    }

    /**
     * Get contactPubkey
     *
     * @return string 
     */
    public function getContactPubkey()
    {
        return $this->contactPubkey;
    }

    /**
     * Set contactCreated
     *
     * @param integer $contactCreated
     * @return EgwAddressbook
     */
    public function setContactCreated($contactCreated)
    {
        $this->contactCreated = $contactCreated;
    
        return $this;
    }

    /**
     * Get contactCreated
     *
     * @return integer 
     */
    public function getContactCreated()
    {
        return $this->contactCreated;
    }

    /**
     * Set contactCreator
     *
     * @param integer $contactCreator
     * @return EgwAddressbook
     */
    public function setContactCreator($contactCreator)
    {
        $this->contactCreator = $contactCreator;
    
        return $this;
    }

    /**
     * Get contactCreator
     *
     * @return integer 
     */
    public function getContactCreator()
    {
        return $this->contactCreator;
    }

    /**
     * Set contactModified
     *
     * @param integer $contactModified
     * @return EgwAddressbook
     */
    public function setContactModified($contactModified)
    {
        $this->contactModified = $contactModified;
    
        return $this;
    }

    /**
     * Get contactModified
     *
     * @return integer 
     */
    public function getContactModified()
    {
        return $this->contactModified;
    }

    /**
     * Set contactModifier
     *
     * @param integer $contactModifier
     * @return EgwAddressbook
     */
    public function setContactModifier($contactModifier)
    {
        $this->contactModifier = $contactModifier;
    
        return $this;
    }

    /**
     * Get contactModifier
     *
     * @return integer 
     */
    public function getContactModifier()
    {
        return $this->contactModifier;
    }

    /**
     * Set contactJpegphoto
     *
     * @param string $contactJpegphoto
     * @return EgwAddressbook
     */
    public function setContactJpegphoto($contactJpegphoto)
    {
        $this->contactJpegphoto = $contactJpegphoto;
    
        return $this;
    }

    /**
     * Get contactJpegphoto
     *
     * @return string 
     */
    public function getContactJpegphoto()
    {
        return $this->contactJpegphoto;
    }

   
    /**
     * Set contactEtag
     *
     * @param integer $contactEtag
     * @return EgwAddressbook
     */
    public function setContactEtag($contactEtag)
    {
        $this->contactEtag = $contactEtag;
    
        return $this;
    }

    /**
     * Get contactEtag
     *
     * @return integer 
     */
    public function getContactEtag()
    {
        return $this->contactEtag;
    }

    /**
     * Set contactUid
     *
     * @param string $contactUid
     * @return EgwAddressbook
     */
    public function setContactUid($contactUid)
    {
        $this->contactUid = $contactUid;
    
        return $this;
    }

    /**
     * Get contactUid
     *
     * @return string 
     */
    public function getContactUid()
    {
        return $this->contactUid;
    }

    /**
     * Set adrOneCountrycode
     *
     * @param string $adrOneCountrycode
     * @return EgwAddressbook
     */
    public function setAdrOneCountrycode($adrOneCountrycode)
    {
        $this->adrOneCountrycode = $adrOneCountrycode;
    
        return $this;
    }

    /**
     * Get adrOneCountrycode
     *
     * @return string 
     */
    public function getAdrOneCountrycode()
    {
        return $this->adrOneCountrycode;
    }

    /**
     * Set adrTwoCountrycode
     *
     * @param string $adrTwoCountrycode
     * @return EgwAddressbook
     */
    public function setAdrTwoCountrycode($adrTwoCountrycode)
    {
        $this->adrTwoCountrycode = $adrTwoCountrycode;
    
        return $this;
    }

    /**
     * Get adrTwoCountrycode
     *
     * @return string 
     */
    public function getAdrTwoCountrycode()
    {
        return $this->adrTwoCountrycode;
    }

    /**
     * Set carddavName
     *
     * @param string $carddavName
     * @return EgwAddressbook
     */
    public function setCarddavName($carddavName)
    {
        $this->carddavName = $carddavName;
    
        return $this;
    }

    /**
     * Get carddavName
     *
     * @return string 
     */
    public function getCarddavName()
    {
        return $this->carddavName;
    }

    /**
     * Set niveauFormation
     *
     * @param string $niveauFormation
     * @return EgwAddressbook
     */
    public function setNiveauFormation($niveauFormation)
    {
        $this->niveauFormation = $niveauFormation;
    
        return $this;
    }

    /**
     * Get niveauFormation
     *
     * @return string 
     */
    public function getNiveauFormation()
    {
        return $this->niveauFormation;
    }

    /**
     * Set intituleFormation
     *
     * @param string $intituleFormation
     * @return EgwAddressbook
     */
    public function setIntituleFormation($intituleFormation)
    {
        $this->intituleFormation = $intituleFormation;
    
        return $this;
    }

    /**
     * Get intituleFormation
     *
     * @return string 
     */
    public function getIntituleFormation()
    {
        return $this->intituleFormation;
    }

    /**
     * Set niveauFormationProjet
     *
     * @param string $niveauFormationProjet
     * @return EgwAddressbook
     */
    public function setNiveauFormationProjet($niveauFormationProjet)
    {
        $this->niveauFormationProjet = $niveauFormationProjet;
    
        return $this;
    }

    /**
     * Get niveauFormationProjet
     *
     * @return string 
     */
    public function getNiveauFormationProjet()
    {
        return $this->niveauFormationProjet;
    }

    /**
     * Set intituleFormationProjet
     *
     * @param string $intituleFormationProjet
     * @return EgwAddressbook
     */
    public function setIntituleFormationProjet($intituleFormationProjet)
    {
        $this->intituleFormationProjet = $intituleFormationProjet;
    
        return $this;
    }

    /**
     * Get intituleFormationProjet
     *
     * @return string 
     */
    public function getIntituleFormationProjet()
    {
        return $this->intituleFormationProjet;
    }

    /**
     * Set dateDebutPoste
     *
     * @param string $dateDebutPoste
     * @return EgwAddressbook
     */
    public function setDateDebutPoste($dateDebutPoste)
    {
        $this->dateDebutPoste = $dateDebutPoste;
    
        return $this;
    }

    /**
     * Get dateDebutPoste
     *
     * @return string 
     */
    public function getDateDebutPoste()
    {
        return $this->dateDebutPoste;
    }

    /**
     * Set dateFinPoste
     *
     * @param string $dateFinPoste
     * @return EgwAddressbook
     */
    public function setDateFinPoste($dateFinPoste)
    {
        $this->dateFinPoste = $dateFinPoste;
    
        return $this;
    }

    /**
     * Get dateFinPoste
     *
     * @return string 
     */
    public function getDateFinPoste()
    {
        return $this->dateFinPoste;
    }

    /**
     * Set poste
     *
     * @param string $poste
     * @return EgwAddressbook
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return string 
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set qualification
     *
     * @param string $qualification
     * @return EgwAddressbook
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;
    
        return $this;
    }

    /**
     * Get qualification
     *
     * @return string 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set contrat
     *
     * @param string $contrat
     * @return EgwAddressbook
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;
    
        return $this;
    }

    /**
     * Get contrat
     *
     * @return string 
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set contratAide
     *
     * @param string $contratAide
     * @return EgwAddressbook
     */
    public function setContratAide($contratAide)
    {
        $this->contratAide = $contratAide;
    
        return $this;
    }

    /**
     * Get contratAide
     *
     * @return string 
     */
    public function getContratAide()
    {
        return $this->contratAide;
    }

    /**
     * Set siret
     *
     * @param string $siret
     * @return EgwAddressbook
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
     * Set dateImmat
     *
     * @param integer $dateImmat
     * @return EgwAddressbook
     */
    public function setDateImmat($dateImmat)
    {
        $this->dateImmat = $dateImmat;
    
        return $this;
    }

    /**
     * Get dateImmat
     *
     * @return integer 
     */
    public function getDateImmat()
    {
        return $this->dateImmat;
    }

    /**
     * Set formeJuridique
     *
     * @param string $formeJuridique
     * @return EgwAddressbook
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
     * Set capital
     *
     * @param integer $capital
     * @return EgwAddressbook
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;
    
        return $this;
    }

    /**
     * Get capital
     *
     * @return integer 
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set codeSafir
     *
     * @param string $codeSafir
     * @return EgwAddressbook
     */
    public function setCodeSafir($codeSafir)
    {
        $this->codeSafir = $codeSafir;
    
        return $this;
    }

    /**
     * Get codeSafir
     *
     * @return string 
     */
    public function getCodeSafir()
    {
        return $this->codeSafir;
    }

    /**
     * Set statutFormation1
     *
     * @param string $statutFormation1
     * @return EgwAddressbook
     */
    public function setStatutFormation1($statutFormation1)
    {
        $this->statutFormation1 = $statutFormation1;
    
        return $this;
    }

    /**
     * Get statutFormation1
     *
     * @return string 
     */
    public function getStatutFormation1()
    {
        return $this->statutFormation1;
    }

    /**
     * Set statutFormation2
     *
     * @param string $statutFormation2
     * @return EgwAddressbook
     */
    public function setStatutFormation2($statutFormation2)
    {
        $this->statutFormation2 = $statutFormation2;
    
        return $this;
    }

    /**
     * Get statutFormation2
     *
     * @return string 
     */
    public function getStatutFormation2()
    {
        return $this->statutFormation2;
    }

    /**
     * Set dateFormation1
     *
     * @param integer $dateFormation1
     * @return EgwAddressbook
     */
    public function setDateFormation1($dateFormation1)
    {
        $this->dateFormation1 = $dateFormation1;
    
        return $this;
    }

    /**
     * Get dateFormation1
     *
     * @return integer 
     */
    public function getDateFormation1()
    {
        return $this->dateFormation1;
    }

    /**
     * Set dateFormation2
     *
     * @param integer $dateFormation2
     * @return EgwAddressbook
     */
    public function setDateFormation2($dateFormation2)
    {
        $this->dateFormation2 = $dateFormation2;
    
        return $this;
    }

    /**
     * Get dateFormation2
     *
     * @return integer 
     */
    public function getDateFormation2()
    {
        return $this->dateFormation2;
    }

    /**
     * Set coteFormation1
     *
     * @param integer $coteFormation1
     * @return EgwAddressbook
     */
    public function setCoteFormation1($coteFormation1)
    {
        $this->coteFormation1 = $coteFormation1;
    
        return $this;
    }

    /**
     * Get coteFormation1
     *
     * @return integer 
     */
    public function getCoteFormation1()
    {
        return $this->coteFormation1;
    }

    /**
     * Set coteFormation2
     *
     * @param integer $coteFormation2
     * @return EgwAddressbook
     */
    public function setCoteFormation2($coteFormation2)
    {
        $this->coteFormation2 = $coteFormation2;
    
        return $this;
    }

    /**
     * Get coteFormation2
     *
     * @return integer 
     */
    public function getCoteFormation2()
    {
        return $this->coteFormation2;
    }

   

    

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return EgwAddressbook
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    
        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Add contactParcoursPro
     *
     * @param Lea\PrestaBundle\Entity\EgwContactParcoursPro $contactParcoursPro
     * @return EgwContact
     */
    public function addContactParcoursPro(\Lea\PrestaBundle\Entity\EgwContactParcoursPro $contactParcoursPro)
    {
        $this->contactParcoursPro[] = $contactParcoursPro;
    
        return $this;
    }

    /**
     * Remove contactParcoursPro
     *
     * @param Lea\PrestaBundle\Entity\EgwContactParcoursPro $contactParcoursPro
     */
    public function removeContactParcoursPro(\Lea\PrestaBundle\Entity\EgwContactParcoursPro $contactParcoursPro)
    {
        $this->contactParcoursPro->removeElement($contactParcoursPro);
    }

    /**
     * Get contactParcoursPro
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getContactParcoursPro()
    {
        return $this->contactParcoursPro;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return EgwAddressbook
     */
    public function addPrestation(\Lea\PrestaBundle\Entity\EgwPrestation $prestations)
    {
        $this->prestations[] = $prestations;
    
        return $this;
    }

    /**
     * Remove prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     */
    public function removePrestation(\Lea\PrestaBundle\Entity\EgwPrestation $prestations)
    {
        $this->prestations->removeElement($prestations);
    }

    /**
     * Get prestations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPrestations()
    {
        return $this->prestations;
    }

    /**
     * Add prestationsP
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestationsP
     * @return EgwAddressbook
     */
    public function addPrestationsP(\Lea\PrestaBundle\Entity\EgwPrestation $prestationsP)
    {
        $this->prestationsP[] = $prestationsP;
    
        return $this;
    }

    /**
     * Remove prestationsP
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestationsP
     */
    public function removePrestationsP(\Lea\PrestaBundle\Entity\EgwPrestation $prestationsP)
    {
        $this->prestationsP->removeElement($prestationsP);
    }

    /**
     * Get prestationsP
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPrestationsP()
    {
        return $this->prestationsP;
    }
}