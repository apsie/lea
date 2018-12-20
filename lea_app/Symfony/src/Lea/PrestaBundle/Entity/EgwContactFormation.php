<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwContactFormation
 *
 * @ORM\Table(name="egw_contact_formation")
 * @ORM\Entity
 */
class EgwContactFormation
{
    /**
     * @var integer $idFormation
     *
     * @ORM\Column(name="id_formation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormation;

    /**
     * @var integer $idOwner
     *
     * @ORM\Column(name="id_owner", type="bigint", nullable=false)
     */
    private $idOwner;

    /**
     * @var integer $dateCreation
     *
     * @ORM\Column(name="date_creation", type="bigint", nullable=false)
     */
    private $dateCreation;

    /**
     * @var integer $idModifier
     *
     * @ORM\Column(name="id_modifier", type="bigint", nullable=false)
     */
    private $idModifier;

    /**
     * @var integer $dateLastModified
     *
     * @ORM\Column(name="date_last_modified", type="bigint", nullable=false)
     */
    private $dateLastModified;

    /**
     * @var integer $idBen
     *
     * @ORM\Column(name="id_ben", type="bigint", nullable=false)
     */
    private $idBen;

    /**
     * @var string $statutFormation
     *
     * @ORM\Column(name="statut_formation", type="string", length=64, nullable=false)
     */
    private $statutFormation;

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
     * @var string $typeFormation
     *
     * @ORM\Column(name="type_formation", type="string", length=128, nullable=false)
     */
    private $typeFormation;

    /**
     * @var string $resultatFormation
     *
     * @ORM\Column(name="resultat_formation", type="string", length=128, nullable=false)
     */
    private $resultatFormation;

    /**
     * @var string $dateDebut
     *
     * @ORM\Column(name="date_debut", type="string", length=64, nullable=false)
     */
    private $dateDebut;

    /**
     * @var string $dateFin
     *
     * @ORM\Column(name="date_fin", type="string", length=64, nullable=false)
     */
    private $dateFin;

    /**
     * @var string $organismeFormation
     *
     * @ORM\Column(name="organisme_formation", type="string", length=128, nullable=false)
     */
    private $organismeFormation;

    /**
     * @var string $organismeCertification
     *
     * @ORM\Column(name="organisme_certification", type="string", length=128, nullable=false)
     */
    private $organismeCertification;



    /**
     * Get idFormation
     *
     * @return integer 
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * Set idOwner
     *
     * @param integer $idOwner
     * @return EgwContactFormation
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
     * @return EgwContactFormation
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
     * @return EgwContactFormation
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
     * @return EgwContactFormation
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
     * Set idBen
     *
     * @param integer $idBen
     * @return EgwContactFormation
     */
    public function setIdBen($idBen)
    {
        $this->idBen = $idBen;
    
        return $this;
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
     * Set statutFormation
     *
     * @param string $statutFormation
     * @return EgwContactFormation
     */
    public function setStatutFormation($statutFormation)
    {
        $this->statutFormation = $statutFormation;
    
        return $this;
    }

    /**
     * Get statutFormation
     *
     * @return string 
     */
    public function getStatutFormation()
    {
        return $this->statutFormation;
    }

    /**
     * Set niveauFormation
     *
     * @param string $niveauFormation
     * @return EgwContactFormation
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
     * @return EgwContactFormation
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
     * Set typeFormation
     *
     * @param string $typeFormation
     * @return EgwContactFormation
     */
    public function setTypeFormation($typeFormation)
    {
        $this->typeFormation = $typeFormation;
    
        return $this;
    }

    /**
     * Get typeFormation
     *
     * @return string 
     */
    public function getTypeFormation()
    {
        return $this->typeFormation;
    }

    /**
     * Set resultatFormation
     *
     * @param string $resultatFormation
     * @return EgwContactFormation
     */
    public function setResultatFormation($resultatFormation)
    {
        $this->resultatFormation = $resultatFormation;
    
        return $this;
    }

    /**
     * Get resultatFormation
     *
     * @return string 
     */
    public function getResultatFormation()
    {
        return $this->resultatFormation;
    }

    /**
     * Set dateDebut
     *
     * @param string $dateDebut
     * @return EgwContactFormation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     * @return EgwContactFormation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set organismeFormation
     *
     * @param string $organismeFormation
     * @return EgwContactFormation
     */
    public function setOrganismeFormation($organismeFormation)
    {
        $this->organismeFormation = $organismeFormation;
    
        return $this;
    }

    /**
     * Get organismeFormation
     *
     * @return string 
     */
    public function getOrganismeFormation()
    {
        return $this->organismeFormation;
    }

    /**
     * Set organismeCertification
     *
     * @param string $organismeCertification
     * @return EgwContactFormation
     */
    public function setOrganismeCertification($organismeCertification)
    {
        $this->organismeCertification = $organismeCertification;
    
        return $this;
    }

    /**
     * Get organismeCertification
     *
     * @return string 
     */
    public function getOrganismeCertification()
    {
        return $this->organismeCertification;
    }
}