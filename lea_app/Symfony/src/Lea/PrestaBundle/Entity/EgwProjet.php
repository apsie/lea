<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwProjet
 *
 * @ORM\Table(name="egw_projet")
 * * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwProjetRepository")
 */
class EgwProjet
{
    /**
     * @var integer $idProjet
     *
     * @ORM\Column(name="id_projet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProjet;

    /**
     * @var integer $idBen
     *
     * @ORM\Column(name="id_ben", type="bigint", nullable=false)
     */
    private $idBen;

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
     * @var integer $dateDebutPrevisionnelle
     *
     * @ORM\Column(name="date_debut_previsionnelle", type="bigint", nullable=false)
     */
    private $dateDebutPrevisionnelle;

    /**
     * @var integer $dateDebut
     *
     * @ORM\Column(name="date_debut", type="bigint", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer $dateFinPrevisionnelle
     *
     * @ORM\Column(name="date_fin_previsionnelle", type="bigint", nullable=false)
     */
    private $dateFinPrevisionnelle;

    /**
     * @var integer $dateFinReelle
     *
     * @ORM\Column(name="date_fin_reelle", type="bigint", nullable=false)
     */
    private $dateFinReelle;

    /**
     * @var string $intituleProjet
     *
     * @ORM\Column(name="intitule_projet", type="string", length=64, nullable=false)
     */
    private $intituleProjet;

    /**
     * @var integer $idCoordinateur
     *
     * @ORM\Column(name="id_coordinateur", type="bigint", nullable=false)
     */
    private $idCoordinateur;

    /**
     * @var integer $idIntervenants
     *
     * @ORM\Column(name="id_intervenants", type="bigint", nullable=false)
     */
    private $idIntervenants;

    /**
     * @var string $descriptionProjet
     *
     * @ORM\Column(name="description_projet", type="text", nullable=true)
     */
    private $descriptionProjet;

    /**
     * @var string $categorie
     *
     * @ORM\Column(name="categorie", type="string", length=64, nullable=false)
     */
    private $categorie;

    /**
     * @var string $resultat
     *
     * @ORM\Column(name="resultat", type="string", length=64, nullable=false)
     */
    private $resultat;

    /**
     * @var string $statut
     *
     * @ORM\Column(name="statut", type="string", length=64, nullable=false)
     */
    private $statut;

	/**
	* @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="projet")
	*/
	protected $prestations;
	public function __construct()
	{
	$this->prestations = new ArrayCollection();
	}

    /**
     * Get idProjet
     *
     * @return integer 
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set idBen
     *
     * @param integer $idBen
     * @return EgwProjet
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
     * Set idOwner
     *
     * @param integer $idOwner
     * @return EgwProjet
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
     * @return EgwProjet
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
     * @return EgwProjet
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
     * @return EgwProjet
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
     * Set dateDebutPrevisionnelle
     *
     * @param integer $dateDebutPrevisionnelle
     * @return EgwProjet
     */
    public function setDateDebutPrevisionnelle($dateDebutPrevisionnelle)
    {
        $this->dateDebutPrevisionnelle = $dateDebutPrevisionnelle;
    
        return $this;
    }

    /**
     * Get dateDebutPrevisionnelle
     *
     * @return integer 
     */
    public function getDateDebutPrevisionnelle()
    {
        return $this->dateDebutPrevisionnelle;
    }

    /**
     * Set dateDebut
     *
     * @param integer $dateDebut
     * @return EgwProjet
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
        return $this->dateDebut;
    }

    /**
     * Set dateFinPrevisionnelle
     *
     * @param integer $dateFinPrevisionnelle
     * @return EgwProjet
     */
    public function setDateFinPrevisionnelle($dateFinPrevisionnelle)
    {
        $this->dateFinPrevisionnelle = $dateFinPrevisionnelle;
    
        return $this;
    }

    /**
     * Get dateFinPrevisionnelle
     *
     * @return integer 
     */
    public function getDateFinPrevisionnelle()
    {
        return $this->dateFinPrevisionnelle;
    }

    /**
     * Set dateFinReelle
     *
     * @param integer $dateFinReelle
     * @return EgwProjet
     */
    public function setDateFinReelle($dateFinReelle)
    {
        $this->dateFinReelle = $dateFinReelle;
    
        return $this;
    }

    /**
     * Get dateFinReelle
     *
     * @return integer 
     */
    public function getDateFinReelle()
    {
        return $this->dateFinReelle;
    }

    /**
     * Set intituleProjet
     *
     * @param string $intituleProjet
     * @return EgwProjet
     */
    public function setIntituleProjet($intituleProjet)
    {
        $this->intituleProjet = $intituleProjet;
    
        return $this;
    }

    /**
     * Get intituleProjet
     *
     * @return string 
     */
    public function getIntituleProjet()
    {
        return $this->intituleProjet;
    }

    /**
     * Set idCoordinateur
     *
     * @param integer $idCoordinateur
     * @return EgwProjet
     */
    public function setIdCoordinateur($idCoordinateur)
    {
        $this->idCoordinateur = $idCoordinateur;
    
        return $this;
    }

    /**
     * Get idCoordinateur
     *
     * @return integer 
     */
    public function getIdCoordinateur()
    {
        return $this->idCoordinateur;
    }

    /**
     * Set idIntervenants
     *
     * @param integer $idIntervenants
     * @return EgwProjet
     */
    public function setIdIntervenants($idIntervenants)
    {
        $this->idIntervenants = $idIntervenants;
    
        return $this;
    }

    /**
     * Get idIntervenants
     *
     * @return integer 
     */
    public function getIdIntervenants()
    {
        return $this->idIntervenants;
    }

    /**
     * Set descriptionProjet
     *
     * @param string $descriptionProjet
     * @return EgwProjet
     */
    public function setDescriptionProjet($descriptionProjet)
    {
        $this->descriptionProjet = $descriptionProjet;
    
        return $this;
    }

    /**
     * Get descriptionProjet
     *
     * @return string 
     */
    public function getDescriptionProjet()
    {
        return $this->descriptionProjet;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return EgwProjet
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set resultat
     *
     * @param string $resultat
     * @return EgwProjet
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    
        return $this;
    }

    /**
     * Get resultat
     *
     * @return string 
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return EgwProjet
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return EgwProjet
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
}