<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\Spiclient
 *
 * @ORM\Table(name="spiclient")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\SpiclientRepository")
 */
class Spiclient
{
     /**
     * @var integer $idOrganisation
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrganisation;


    /**
     * @var integer $idOwner
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId;

    /**
     * @var integer $idOwner
     *
     * @ORM\Column(name="creator_id", type="integer", nullable=false)
     */
    private $idOwner;

    /**
     * @var integer $dateCreation
     *
     * @ORM\Column(name="creation_date", type="integer", nullable=false)
     */
    private $dateCreation;

    /**
     * @var integer $idModifier
     *
     * @ORM\Column(name="maj_id", type="integer", nullable=false)
     */
    private $idModifier;

    /**
     * @var integer $dateLastModified
     *
     * @ORM\Column(name="change_date", type="integer", nullable=false)
     */
    private $dateLastModified;

    /**
     * @var string $codeOrg
     *
     * @ORM\Column(name="client_code_agency", type="string", length=255, nullable=false)
     */
    private $codeOrg;

    /**
     * @var string $nomOrganisme
     *
     * @ORM\Column(name="client_company", type="string", length=100, nullable=false)
     */
    private $nomOrganisme;

    /**
     * @var string $adresseLigne1
     *
     * @ORM\Column(name="client_adr_one_street", type="string", length=100, nullable=false)
     */
    private $adresseLigne1;

    /**
     * @var string $adresseLigne2
     *
     * @ORM\Column(name="client_adr_two_street", type="string", length=100, nullable=false)
     */
    private $adresseLigne2;

    /**
     * @var string $cp
     *
     * @ORM\Column(name="client_postalcode", type="string", length=10, nullable=false)
     */
    private $cp;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="client_locality", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var string $region
     *
     * @ORM\Column(name="client_region", type="integer", nullable=false)
     */
    private $region;

    /**
     * @var string $pays
     *
     * @ORM\Column(name="client_country", type="string", length=255, nullable=false)
     */
    private $pays;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="client_tel", type="string", length=40, nullable=false)
     */
    private $tel;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="client_fax", type="string", length=40, nullable=false)
     */
    private $fax;

    /**
     * @var string $email
     *
     * @ORM\Column(name="client_manager_email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string $secteurActivite
     *
     * @ORM\Column(name="client_sector", type="integer", nullable=true)
     */
    private $secteurActivite;

    /**
     * SPIREA
     *
     * @ORM\Column(name="client_type", type="integer", nullable=false)
     */
    private $type;
	
	/**
	 * @var string $siret
	 *
	 * @ORM\Column(name="client_siret", type="string", length=250, nullable=false)
	 */
	private $siret;
	
    /**
    * @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="prestataire")
    */
    protected $prestations;
    
    public function __construct()
    {
       $this->prestations = new ArrayCollection();
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
     * @param integer $idOwner
     * @return Spiclient
     */
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;
    
        return $this;
    }

    /**
     * Get idOwner
     *
     * @return integer 
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set dateCreation
     *
     * @param integer $dateCreation
     * @return Spiclient
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return integer 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set idModifier
     *
     * @param integer $idModifier
     * @return Spiclient
     */
    public function setIdModifier($idModifier)
    {
        $this->idModifier = $idModifier;
    
        return $this;
    }

    /**
     * Get idModifier
     *
     * @return integer 
     */
    public function getIdModifier()
    {
        return $this->idModifier;
    }

    /**
     * Set dateLastModified
     *
     * @param integer $dateLastModified
     * @return Spiclient
     */
    public function setDateLastModified($dateLastModified)
    {
        $this->dateLastModified = $dateLastModified;
    
        return $this;
    }

    /**
     * Get dateLastModified
     *
     * @return integer 
     */
    public function getDateLastModified()
    {
        return $this->dateLastModified;
    }

    /**
     * Set codeOrg
     *
     * @param string $codeOrg
     * @return Spiclient
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
     * @return Spiclient
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
     * @return Spiclient
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
     * @return Spiclient
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
     * Set cp
     *
     * @param string $cp
     * @return Spiclient
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
     * @return Spiclient
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
     * @param integer $region
     * @return Spiclient
     */
    public function setRegion($region)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return integer 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return Spiclient
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
     * @return Spiclient
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
     * Set fax
     *
     * @param string $fax
     * @return Spiclient
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
     * @return Spiclient
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
     * Set secteurActivite
     *
     * @param integer $secteurActivite
     * @return Spiclient
     */
    public function setSecteurActivite($secteurActivite)
    {
        $this->secteurActivite = $secteurActivite;
    
        return $this;
    }

    /**
     * Get secteurActivite
     *
     * @return integer 
     */
    public function getSecteurActivite()
    {
        return $this->secteurActivite;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Spiclient
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return Spiclient
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
     * Set accountId
     *
     * @param integer $accountId
     * @return Spiclient
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
	 * Get siret
	 *
	 * @param string $siret
	 * @return Spiclient
	 */
	public function setSiret($siret){
		$this->siret = $siret;
		
		return $this;
	}
	
	/**
	 * Get siret
	 *
	 * @return string
	 */
	public function getSiret(){
		return $this->siret;
	}
}