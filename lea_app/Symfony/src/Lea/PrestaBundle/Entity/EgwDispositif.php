<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwDispositif
 *
 * @ORM\Table(name="egw_dispositif")
 * @ORM\Entity
 */
class EgwDispositif
{
    /**
     * @var integer $idDispositif
     *
     * @ORM\Column(name="id_dispositif", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispositif;

    /**
	* @ORM\ManyToOne(targetEntity="EgwTypePrestation", inversedBy="dispositifs")
	* @ORM\JoinColumn(name="id_type_prestation", referencedColumnName="id")
	*/
    private $idTypePrestation;
    
     /**
	* @ORM\ManyToOne(targetEntity="EgwActivite", inversedBy="dispositifs")
	* @ORM\JoinColumn(name="id_activite", referencedColumnName="id_activite")
	*/
    private $activite;

     /**
     * @var string $nomDispositif
     *
     * @ORM\Column(name="nom_dispositif", type="string", length=128, nullable=false)
     */
    private $nomDispositif;
    
    /**
     * @var string $numeroMarche
     *
     * @ORM\Column(name="numero_marche", type="string", length=64, nullable=false)
     */
    private $numeroMarche;

    /**
     * @var string $numeroLot
     *
     * @ORM\Column(name="numero_lot", type="string", length=128, nullable=true)
     */
    private $numeroLot;

    /**
     * @var string $objet
     *
     * @ORM\Column(name="objet", type="string", length=64, nullable=true)
     */
    private $objet;

    /**
     * @var integer $dateDebut
     *
     * @ORM\Column(name="date_debut", type="bigint", nullable=true)
     */
    private $dateDebut;

    /**
     * @var integer $dateFin
     *
     * @ORM\Column(name="date_fin", type="bigint", nullable=true)
     */
    private $dateFin;

    /**
     * @var string $zoneGeographique
     *
     * @ORM\Column(name="zone_geographique", type="string", length=32, nullable=true)
     */
    private $zoneGeographique;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /** SPIREA
    * @ORM\ManyToOne(targetEntity="EgwContract", inversedBy="dispositifs")
    * @ORM\JoinColumn(name="id_contract", referencedColumnName="contract_id")
    */
    private $idContract;

	/**
	* @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="dispositif")
	*/
	protected $prestations;
	public function __construct()
	{
	   $this->prestations = new ArrayCollection();
	}

    /**
     * Get idDispositif
     *
     * @return integer 
     */
    public function getIdDispositif()
    {
        return $this->idDispositif;
    }

    
     /**
     * Set nomDispositif
     *
     * @param string $nomDispositif
     * @return EgwDispositif
     */
    public function setNomDispositif($nomDispositif)
    {
        $this->nomDispositif = $nomDispositif;
    
        return $this;
    }

    /**
     * Get nomDispositif
     *
     * @return string 
     */
    public function getNomDispositif()
    {
        return $this->nomDispositif;
    }
    
    

    /**
     * Set numeroMarche
     *
     * @param string $numeroMarche
     * @return EgwDispositif
     */
    public function setNumeroMarche($numeroMarche)
    {
        $this->numeroMarche = $numeroMarche;
    
        return $this;
    }

    /**
     * Get numeroMarche
     *
     * @return string 
     */
    public function getNumeroMarche()
    {
        return $this->numeroMarche;
    }

    /**
     * Set numeroLot
     *
     * @param string $numeroLot
     * @return EgwDispositif
     */
    public function setNumeroLot($numeroLot)
    {
        $this->numeroLot = $numeroLot;
    
        return $this;
    }

    /**
     * Get numeroLot
     *
     * @return string 
     */
    public function getNumeroLot()
    {
        return $this->numeroLot;
    }

    /**
     * Set objet
     *
     * @param string $objet
     * @return EgwDispositif
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    
        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set dateDebut
     *
     * @param integer $dateDebut
     * @return EgwDispositif
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return integer 
     */
    public function getDateDebut()
    {
    	if($this->dateDebut>0)
    	return date('d/m/Y',$this->dateDebut);
    	else
    	return "";
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param integer $dateFin
     * @return EgwDispositif
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return integer 
     */
    public function getDateFin()
    {
    	if($this->dateFin>0)
    	return date('d/m/Y',$this->dateFin);
    	else
    	return "";
        return $this->dateFin;
    }

    /**
     * Set zoneGeographique
     *
     * @param string $zoneGeographique
     * @return EgwDispositif
     */
    public function setZoneGeographique($zoneGeographique)
    {
        $this->zoneGeographique = $zoneGeographique;
    
        return $this;
    }

    /**
     * Get zoneGeographique
     *
     * @return string 
     */
    public function getZoneGeographique()
    {
        return $this->zoneGeographique;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return EgwDispositif
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set idTypePrestation
     *
     * @param Lea\PrestaBundle\Entity\EgwTypePrestation $idTypePrestation
     * @return EgwDispositif
     */
    public function setIdTypePrestation(\Lea\PrestaBundle\Entity\EgwTypePrestation $idTypePrestation = null)
    {
        $this->idTypePrestation = $idTypePrestation;
    
        return $this;
    }

    /**
     * Get idTypePrestation
     *
     * @return Lea\PrestaBundle\Entity\EgwTypePrestation 
     */
    public function getIdTypePrestation()
    {
        return $this->idTypePrestation;
    }

    /**
     * Set activite
     *
     * @param Lea\PrestaBundle\Entity\EgwActivite $activite
     * @return EgwDispositif
     */
    public function setActivite(\Lea\PrestaBundle\Entity\EgwActivite $activite = null)
    {
        $this->activite = $activite;
    
        return $this;
    }

    /**
     * Get activite
     *
     * @return Lea\PrestaBundle\Entity\EgwActivite 
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return EgwDispositif
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
     * Set idContract
     *
     * @param Lea\PrestaBundle\Entity\EgwContract $idContract
     * @return EgwDispositif
     */
    public function setIdContract(\Lea\PrestaBundle\Entity\EgwContract $idContract = null)
    {
        $this->idContract = $idContract;
    
        return $this;
    }

    /**
     * Get idContract
     *
     * @return Lea\PrestaBundle\Entity\EgwContract 
     */
    public function getIdContract()
    {
        return $this->idContract;
    }
}