<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Lea\PrestaBundle\Entity\EgwContact
 *
 * @ORM\Table(name="egw_addressbook_test")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwContactPrRepository")
 */
class EgwContactPr
{
    /**
     * @var integer $idBen
     *
     * @ORM\Column(name="contact_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBen;

    // *
    //  * @var string $idOrganisation
    //  *
    //  * @ORM\Column(name="id_organisation", type="string", length=64, nullable=true)
     
    // private $idOrganisation;

    /**
     * @var integer $idOwner
     *
     * @ORM\Column(name="contact_owner", type="bigint", nullable=false)
     */
    private $idOwner;

    /**
     * @var integer $dateCreation
     *
     * @ORM\Column(name="contact_created", type="bigint", nullable=false)
     */
    private $dateCreation;

    /**
     * @var integer $idModifier
     *
     * @ORM\Column(name="contact_modifier", type="integer", nullable=false)
     */
    private $idModifier;

    /**
     * @var integer $dateLastModified
     *
     * @ORM\Column(name="contact_modified", type="bigint", nullable=false)
     */
    private $dateLastModified;

    /**
     * @var string $catId
     *
     * @ORM\Column(name="cat_id", type="string", length=255, nullable=false)
     */
    private $catId;

    /**
     * @var string $nomComplet
     *
     * @ORM\Column(name="n_fn", type="string", length=128, nullable=false)
     */
    private $nomComplet;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="n_family", type="string", length=64, nullable=false)
     */
    private $nom;

    /**
     * @var string $prenom
     *
     * @ORM\Column(name="n_given", type="string", length=64, nullable=false)
     */
    private $prenom;

    /**
     * @var string $deuxiemePrenom
     *
     * @ORM\Column(name="n_middle", type="string", length=64, nullable=false)
     */
    private $deuxiemePrenom;

    /**
     * @var string $nomJeuneFille
     *
     * @ORM\Column(name="n_suffix", type="string", length=64, nullable=false)
     */
    private $nomJeuneFille;

    /**
     * @var string $civilite
     *
     * @ORM\Column(name="n_prefix", type="string", length=64, nullable=false)
     */
    private $civilite;

    /**
     * @var string $organisation
     *
     * @ORM\Column(name="org_name", type="string", length=128, nullable=true)
     */
    private $organisation;

    /**
     * @var string $fonction
     *
     * @ORM\Column(name="contact_role", type="string", length=64, nullable=true)
     */
    private $fonction;

    /**
     * @var string $service
     *
     * @ORM\Column(name="org_unit", type="string", length=64, nullable=true)
     */
    private $service;

    /**
     * @var string $adresseLigne1
     *
     * @ORM\Column(name="adr_one_street", type="string", length=64, nullable=true)
     */
    private $adresseLigne1;

    /**
     * @var string $adresseLigne2
     *
     * @ORM\Column(name="adr_one_street2", type="string", length=64, nullable=true)
     */
    private $adresseLigne2;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="adr_one_locality", type="string", length=64, nullable=true)
     */
    private $ville;

    /**
     * @var string $region
     *
     * @ORM\Column(name="adr_one_region", type="string", length=64, nullable=true)
     */
    private $region;

    /**
     * @var string $cp
     *
     * @ORM\Column(name="adr_one_postalcode", type="string", length=64, nullable=false)
     */
    private $cp;

    /**
     * @var string $pays
     *
     * @ORM\Column(name="adr_one_countryname", type="string", length=64, nullable=false)
     */
    private $pays;

    /**
     * @var string $telPro1
     *
     * @ORM\Column(name="tel_work", type="string", length=40, nullable=false)
     */
    private $telPro1;

    /**
     * @var string $telDomicile1
     *
     * @ORM\Column(name="tel_home", type="string", length=14, nullable=false)
     */
    private $telDomicile1;

    /**
     * @var string $faxPro
     *
     * @ORM\Column(name="tel_fax", type="string", length=40, nullable=false)
     */
    private $faxPro;

    /**
     * @var string $faxPerso
     *
     * @ORM\Column(name="tel_fax_home", type="string", length=64, nullable=true)
     */
    private $faxPerso;

    /**
     * @var string $portablePro
     *
     * @ORM\Column(name="tel_cell", type="string", length=64, nullable=true)
     */
    private $portablePro;

    /**
     * @var string $portablePerso
     *
     * @ORM\Column(name="tel_cell_private", type="string", length=40, nullable=false)
     */
    private $portablePerso;

    /**
     * @var string $emailPro
     *
     * @ORM\Column(name="contact_email", type="string", length=64, nullable=false)
     */
    private $emailPro;

    /**
     * @var string $emailPerso
     *
     * @ORM\Column(name="contact_email_home", type="string", length=64, nullable=false)
     */
    private $emailPerso;

    /**
     * @var string $sitePerso
     *
     * @ORM\Column(name="contact_url_home", type="string", length=64, nullable=false)
     */
    private $sitePerso;

   
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
	}
	
  
	

    /**
     * Get idBen
     *
     * @return integer 
     */
    public function getIdBen()
    {
        return $this->idBen;
    }

    /**
     * Set idOrganisation
     *
     * @param string $idOrganisation
     * @return EgwContact
     */
    public function setIdOrganisation($idOrganisation = null)
    {
        $this->idOrganisation = $idOrganisation;
    
        return $this;
    }

    /**
     * Get idOrganisation
     *
     * @return string 
     */
    public function getIdOrganisation()
    {
        return $this->idOrganisation;
    }

    /**
     * Set idOwner
     *
     * @param integer $idOwner
     * @return EgwContact
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
     * @return EgwContact
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
     * @return EgwContact
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
     * @return EgwContact
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
     * Set catId
     *
     * @param string $catId
     * @return EgwContact
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
     * Set nomComplet
     *
     * @param string $nomComplet
     * @return EgwContact
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;
    
        return $this;
    }

    /**
     * Get nomComplet
     *
     * @return string 
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return EgwContact
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return EgwContact
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set deuxiemePrenom
     *
     * @param string $deuxiemePrenom
     * @return EgwContact
     */
    public function setDeuxiemePrenom($deuxiemePrenom)
    {
        $this->deuxiemePrenom = $deuxiemePrenom;
    
        return $this;
    }

    /**
     * Get deuxiemePrenom
     *
     * @return string 
     */
    public function getDeuxiemePrenom()
    {
        return $this->deuxiemePrenom;
    }

    /**
     * Set nomJeuneFille
     *
     * @param string $nomJeuneFille
     * @return EgwContact
     */
    public function setNomJeuneFille($nomJeuneFille)
    {
        $this->nomJeuneFille = $nomJeuneFille;
    
        return $this;
    }

    /**
     * Get nomJeuneFille
     *
     * @return string 
     */
    public function getNomJeuneFille()
    {
        return $this->nomJeuneFille;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     * @return EgwContact
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    
        return $this;
    }

    /**
     * Get civilite
     *
     * @return string 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set organisation
     *
     * @param string $organisation
     * @return EgwContact
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;
    
        return $this;
    }

    /**
     * Get organisation
     *
     * @return string 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return EgwContact
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    
        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return EgwContact
     */
    public function setService($service)
    {
        $this->service = $service;
    
        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set adresseLigne1
     *
     * @param string $adresseLigne1
     * @return EgwContact
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
     * @return EgwContact
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
     * @return EgwContact
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
     * Set ville
     *
     * @param string $ville
     * @return EgwContact
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
     * @return EgwContact
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
     * Set cp
     *
     * @param string $cp
     * @return EgwContact
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
     * Set pays
     *
     * @param string $pays
     * @return EgwContact
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
     * Set telPro1
     *
     * @param string $telPro1
     * @return EgwContact
     */
    public function setTelPro1($telPro1)
    {
        $this->telPro1 = $telPro1;
    
        return $this;
    }

    /**
     * Get telPro1
     *
     * @return string 
     */
    public function getTelPro1()
    {
        return $this->telPro1;
    }

    /**
     * Set telPro2
     *
     * @param string $telPro2
     * @return EgwContact
     */
    public function setTelPro2($telPro2)
    {
        $this->telPro2 = $telPro2;
    
        return $this;
    }

    /**
     * Get telPro2
     *
     * @return string 
     */
    public function getTelPro2()
    {
        return $this->telPro2;
    }

    /**
     * Set telDomicile1
     *
     * @param string $telDomicile1
     * @return EgwContact
     */
    public function setTelDomicile1($telDomicile1)
    {
        $this->telDomicile1 = $telDomicile1;
    
        return $this;
    }

    /**
     * Get telDomicile1
     *
     * @return string 
     */
    public function getTelDomicile1()
    {
        return $this->telDomicile1;
    }

    /**
     * Set telDomicile2
     *
     * @param string $telDomicile2
     * @return EgwContact
     */
    public function setTelDomicile2($telDomicile2)
    {
        $this->telDomicile2 = $telDomicile2;
    
        return $this;
    }

    /**
     * Get telDomicile2
     *
     * @return string 
     */
    public function getTelDomicile2()
    {
        return $this->telDomicile2;
    }

    /**
     * Set faxPro
     *
     * @param string $faxPro
     * @return EgwContact
     */
    public function setFaxPro($faxPro)
    {
        $this->faxPro = $faxPro;
    
        return $this;
    }

    /**
     * Get faxPro
     *
     * @return string 
     */
    public function getFaxPro()
    {
        return $this->faxPro;
    }

    /**
     * Set faxPerso
     *
     * @param string $faxPerso
     * @return EgwContact
     */
    public function setFaxPerso($faxPerso)
    {
        $this->faxPerso = $faxPerso;
    
        return $this;
    }

    /**
     * Get faxPerso
     *
     * @return string 
     */
    public function getFaxPerso()
    {
        return $this->faxPerso;
    }

    /**
     * Set portablePro
     *
     * @param string $portablePro
     * @return EgwContact
     */
    public function setPortablePro($portablePro)
    {
        $this->portablePro = $portablePro;
    
        return $this;
    }

    /**
     * Get portablePro
     *
     * @return string 
     */
    public function getPortablePro()
    {
        return $this->portablePro;
    }

    /**
     * Set portablePerso
     *
     * @param string $portablePerso
     * @return EgwContact
     */
    public function setPortablePerso($portablePerso)
    {
        $this->portablePerso = $portablePerso;
    
        return $this;
    }

    /**
     * Get portablePerso
     *
     * @return string 
     */
    public function getPortablePerso()
    {
        return $this->portablePerso;
    }

    /**
     * Set emailPro
     *
     * @param string $emailPro
     * @return EgwContact
     */
    public function setEmailPro($emailPro)
    {
        $this->emailPro = $emailPro;
    
        return $this;
    }

    /**
     * Get emailPro
     *
     * @return string 
     */
    public function getEmailPro()
    {
        return $this->emailPro;
    }

    /**
     * Set emailPerso
     *
     * @param string $emailPerso
     * @return EgwContact
     */
    public function setEmailPerso($emailPerso)
    {
        $this->emailPerso = $emailPerso;
    
        return $this;
    }

    /**
     * Get emailPerso
     *
     * @return string 
     */
    public function getEmailPerso()
    {
        return $this->emailPerso;
    }

    /**
     * Set sitePerso
     *
     * @param string $sitePerso
     * @return EgwContact
     */
    public function setSitePerso($sitePerso)
    {
        $this->sitePerso = $sitePerso;
    
        return $this;
    }

    /**
     * Get sitePerso
     *
     * @return string 
     */
    public function getSitePerso()
    {
        return $this->sitePerso;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwContact $prestations
     * @return EgwContact
     */
    public function addPrestation(\Lea\PrestaBundle\Entity\EgwContact $prestations)
    {
        $this->prestations[] = $prestations;
    
        return $this;
    }

    /**
     * Remove prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwContact $prestations
     */
    public function removePrestation(\Lea\PrestaBundle\Entity\EgwContact $prestations)
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
     * @return EgwContact
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
}