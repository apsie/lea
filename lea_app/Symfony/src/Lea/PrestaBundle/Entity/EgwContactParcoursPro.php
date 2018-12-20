<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwContactParcoursPro
 *
 * @ORM\Table(name="egw_contact_parcours_pro")
 * @ORM\Entity
 */
class EgwContactParcoursPro
{
    /**
     * @var integer $idParcours
     *
     * @ORM\Column(name="id_parcours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParcours;

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
     * @var string $identifiant
     *
     * @ORM\Column(name="identifiant", type="string", length=64, nullable=false)
     */
    private $identifiant;

    /**
     * @var string $personneConcernee
     *
     * @ORM\Column(name="personne_concernee", type="string", length=64, nullable=false)
     */
    private $personneConcernee;

    /**
     * @var string $statut
     *
     * @ORM\Column(name="statut", type="string", length=64, nullable=false)
     */
    private $statut;

    /**
     * @var string $poste
     *
     * @ORM\Column(name="poste", type="string", length=128, nullable=false)
     */
    private $poste;

    /**
     * @var string $intitulePoste
     *
     * @ORM\Column(name="intitule_poste", type="string", length=128, nullable=false)
     */
    private $intitulePoste;

    /**
     * @var string $codeRome
     *
     * @ORM\Column(name="code_rome", type="string", length=64, nullable=false)
     */
    private $codeRome;

    /**
     * @var string $categorieRome
     *
     * @ORM\Column(name="categorie_rome", type="string", length=128, nullable=false)
     */
    private $categorieRome;

    /**
     * @var string $service
     *
     * @ORM\Column(name="service", type="string", length=128, nullable=false)
     */
    private $service;

    /**
     * @var string $typeRemuneration
     *
     * @ORM\Column(name="type_remuneration", type="string", length=64, nullable=false)
     */
    private $typeRemuneration;

    /**
     * @var string $montantRemuneration
     *
     * @ORM\Column(name="montant_remuneration", type="string", length=64, nullable=false)
     */
    private $montantRemuneration;

    /**
     * @var integer $dateDebut
     *
     * @ORM\Column(name="date_debut", type="bigint", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer $dateFin
     *
     * @ORM\Column(name="date_fin", type="bigint", nullable=false)
     */
    private $dateFin;

    /**
     * @var string $typeContrat
     *
     * @ORM\Column(name="type_contrat", type="string", length=64, nullable=false)
     */
    private $typeContrat;

    /**
     * @var string $typeContratAide
     *
     * @ORM\Column(name="type_contrat_aide", type="string", length=64, nullable=false)
     */
    private $typeContratAide;

    /**
     * @var string $qualification
     *
     * @ORM\Column(name="qualification", type="string", length=64, nullable=false)
     */
    private $qualification;

    /**
     * @var string $tempsTravail
     *
     * @ORM\Column(name="temps_travail", type="string", length=64, nullable=false)
     */
    private $tempsTravail;

    /**
     * @var string $mobilite
     *
     * @ORM\Column(name="mobilite", type="string", length=128, nullable=false)
     */
    private $mobilite;

    /**
     * @var string $secteurActivite
     *
     * @ORM\Column(name="secteur_activite", type="string", length=64, nullable=false)
     */
    private $secteurActivite;

    /**
     * @var string $organisme
     *
     * @ORM\Column(name="organisme", type="string", length=128, nullable=false)
     */
    private $organisme;

	 /**
	* @ORM\ManyToOne(targetEntity="EgwContact", inversedBy="contactParcoursPro")
	* @ORM\JoinColumn(name="id_ben", referencedColumnName="id_ben")
	*/
    private $parcoursProContact;

    /**
     * Get idParcours
     *
     * @return integer 
     */
    public function getIdParcours()
    {
        return $this->idParcours;
    }

    /**
     * Set idBen
     *
     * @param integer $idBen
     * @return EgwContactParcoursPro
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
     * @return EgwContactParcoursPro
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
     * @return EgwContactParcoursPro
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
     * @return EgwContactParcoursPro
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
     * @return EgwContactParcoursPro
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
     * Set identifiant
     *
     * @param string $identifiant
     * @return EgwContactParcoursPro
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    
        return $this;
    }

    /**
     * Get identifiant
     *
     * @return string 
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Set personneConcernee
     *
     * @param string $personneConcernee
     * @return EgwContactParcoursPro
     */
    public function setPersonneConcernee($personneConcernee)
    {
        $this->personneConcernee = $personneConcernee;
    
        return $this;
    }

    /**
     * Get personneConcernee
     *
     * @return string 
     */
    public function getPersonneConcernee()
    {
        return $this->personneConcernee;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return EgwContactParcoursPro
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
     * Set poste
     *
     * @param string $poste
     * @return EgwContactParcoursPro
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
     * Set intitulePoste
     *
     * @param string $intitulePoste
     * @return EgwContactParcoursPro
     */
    public function setIntitulePoste($intitulePoste)
    {
        $this->intitulePoste = $intitulePoste;
    
        return $this;
    }

    /**
     * Get intitulePoste
     *
     * @return string 
     */
    public function getIntitulePoste()
    {
        return $this->intitulePoste;
    }

    /**
     * Set codeRome
     *
     * @param string $codeRome
     * @return EgwContactParcoursPro
     */
    public function setCodeRome($codeRome)
    {
        $this->codeRome = $codeRome;
    
        return $this;
    }

    /**
     * Get codeRome
     *
     * @return string 
     */
    public function getCodeRome()
    {
        return $this->codeRome;
    }

    /**
     * Set categorieRome
     *
     * @param string $categorieRome
     * @return EgwContactParcoursPro
     */
    public function setCategorieRome($categorieRome)
    {
        $this->categorieRome = $categorieRome;
    
        return $this;
    }

    /**
     * Get categorieRome
     *
     * @return string 
     */
    public function getCategorieRome()
    {
        return $this->categorieRome;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return EgwContactParcoursPro
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
     * Set typeRemuneration
     *
     * @param string $typeRemuneration
     * @return EgwContactParcoursPro
     */
    public function setTypeRemuneration($typeRemuneration)
    {
        $this->typeRemuneration = $typeRemuneration;
    
        return $this;
    }

    /**
     * Get typeRemuneration
     *
     * @return string 
     */
    public function getTypeRemuneration()
    {
        return $this->typeRemuneration;
    }

    /**
     * Set montantRemuneration
     *
     * @param string $montantRemuneration
     * @return EgwContactParcoursPro
     */
    public function setMontantRemuneration($montantRemuneration)
    {
        $this->montantRemuneration = $montantRemuneration;
    
        return $this;
    }

    /**
     * Get montantRemuneration
     *
     * @return string 
     */
    public function getMontantRemuneration()
    {
        return $this->montantRemuneration;
    }

    /**
     * Set dateDebut
     *
     * @param integer $dateDebut
     * @return EgwContactParcoursPro
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
     * Set dateFin
     *
     * @param integer $dateFin
     * @return EgwContactParcoursPro
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
        return $this->dateFin;
    }

    /**
     * Set typeContrat
     *
     * @param string $typeContrat
     * @return EgwContactParcoursPro
     */
    public function setTypeContrat($typeContrat)
    {
        $this->typeContrat = $typeContrat;
    
        return $this;
    }

    /**
     * Get typeContrat
     *
     * @return string 
     */
    public function getTypeContrat()
    {
        return $this->typeContrat;
    }

    /**
     * Set typeContratAide
     *
     * @param string $typeContratAide
     * @return EgwContactParcoursPro
     */
    public function setTypeContratAide($typeContratAide)
    {
        $this->typeContratAide = $typeContratAide;
    
        return $this;
    }

    /**
     * Get typeContratAide
     *
     * @return string 
     */
    public function getTypeContratAide()
    {
        return $this->typeContratAide;
    }

    /**
     * Set qualification
     *
     * @param string $qualification
     * @return EgwContactParcoursPro
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
     * Set tempsTravail
     *
     * @param string $tempsTravail
     * @return EgwContactParcoursPro
     */
    public function setTempsTravail($tempsTravail)
    {
        $this->tempsTravail = $tempsTravail;
    
        return $this;
    }

    /**
     * Get tempsTravail
     *
     * @return string 
     */
    public function getTempsTravail()
    {
        return $this->tempsTravail;
    }

    /**
     * Set mobilite
     *
     * @param string $mobilite
     * @return EgwContactParcoursPro
     */
    public function setMobilite($mobilite)
    {
        $this->mobilite = $mobilite;
    
        return $this;
    }

    /**
     * Get mobilite
     *
     * @return string 
     */
    public function getMobilite()
    {
        return $this->mobilite;
    }

    /**
     * Set secteurActivite
     *
     * @param string $secteurActivite
     * @return EgwContactParcoursPro
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
     * Set organisme
     *
     * @param string $organisme
     * @return EgwContactParcoursPro
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;
    
        return $this;
    }

    /**
     * Get organisme
     *
     * @return string 
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set parcoursProContact
     *
     * @param Lea\PrestaBundle\Entity\EgwContact $parcoursProContact
     * @return EgwContactParcoursPro
     */
    public function setParcoursProContact(\Lea\PrestaBundle\Entity\EgwContact $parcoursProContact = null)
    {
        $this->parcoursProContact = $parcoursProContact;
    
        return $this;
    }

    /**
     * Get parcoursProContact
     *
     * @return Lea\PrestaBundle\Entity\EgwContact 
     */
    public function getParcoursProContact()
    {
        return $this->parcoursProContact;
    }
}