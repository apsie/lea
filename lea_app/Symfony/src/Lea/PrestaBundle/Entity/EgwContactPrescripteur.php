<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwContactPrescripteur
 *
 * @ORM\Table(name="egw_contact_prescripteur")
 * @ORM\Entity
 */
class EgwContactPrescripteur
{
    /**
     * @var integer $idContact
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContact;

    /**
     * @var integer $idBen
     *
     * @ORM\Column(name="id_ben", type="bigint", nullable=false)
     */
    private $idBen;

    /**
     * @var integer $idPrescripteur
     *
     * @ORM\Column(name="id_prescripteur", type="bigint", nullable=false)
     */
    private $idPrescripteur;

    /**
     * @var integer $idPrescripteur2
     *
     * @ORM\Column(name="id_prescripteur2", type="bigint", nullable=false)
     */
    private $idPrescripteur2;

    /**
     * @var integer $idPrescripteur3
     *
     * @ORM\Column(name="id_prescripteur3", type="bigint", nullable=false)
     */
    private $idPrescripteur3;

    /**
     * @var string $civilite
     *
     * @ORM\Column(name="civilite", type="string", length=60, nullable=false)
     */
    private $civilite;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=60, nullable=false)
     */
    private $nom;

    /**
     * @var string $prenom
     *
     * @ORM\Column(name="prenom", type="string", length=60, nullable=false)
     */
    private $prenom;

    /**
     * @var string $telBureau
     *
     * @ORM\Column(name="tel_bureau", type="string", length=60, nullable=false)
     */
    private $telBureau;

    /**
     * @var string $telPortable
     *
     * @ORM\Column(name="tel_portable", type="string", length=60, nullable=false)
     */
    private $telPortable;

    /**
     * @var string $emailBureau
     *
     * @ORM\Column(name="email_bureau", type="string", length=60, nullable=false)
     */
    private $emailBureau;

    /**
     * @var string $emailDomicile
     *
     * @ORM\Column(name="email_domicile", type="string", length=60, nullable=false)
     */
    private $emailDomicile;

    /**
     * @var string $fonction
     *
     * @ORM\Column(name="fonction", type="string", length=60, nullable=false)
     */
    private $fonction;



    /**
     * Get idContact
     *
     * @return integer 
     */
    public function getIdContact()
    {
        return $this->idContact;
    }

    /**
     * Set idBen
     *
     * @param integer $idBen
     * @return EgwContactPrescripteur
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
     * Set idPrescripteur
     *
     * @param integer $idPrescripteur
     * @return EgwContactPrescripteur
     */
    public function setIdPrescripteur($idPrescripteur)
    {
        $this->idPrescripteur = $idPrescripteur;
    
        return $this;
    }

    /**
     * Get idPrescripteur
     *
     * @return integer 
     */
    public function getIdPrescripteur()
    {
        return $this->idPrescripteur;
    }

    /**
     * Set idPrescripteur2
     *
     * @param integer $idPrescripteur2
     * @return EgwContactPrescripteur
     */
    public function setIdPrescripteur2($idPrescripteur2)
    {
        $this->idPrescripteur2 = $idPrescripteur2;
    
        return $this;
    }

    /**
     * Get idPrescripteur2
     *
     * @return integer 
     */
    public function getIdPrescripteur2()
    {
        return $this->idPrescripteur2;
    }

    /**
     * Set idPrescripteur3
     *
     * @param integer $idPrescripteur3
     * @return EgwContactPrescripteur
     */
    public function setIdPrescripteur3($idPrescripteur3)
    {
        $this->idPrescripteur3 = $idPrescripteur3;
    
        return $this;
    }

    /**
     * Get idPrescripteur3
     *
     * @return integer 
     */
    public function getIdPrescripteur3()
    {
        return $this->idPrescripteur3;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     * @return EgwContactPrescripteur
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
     * Set nom
     *
     * @param string $nom
     * @return EgwContactPrescripteur
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
     * @return EgwContactPrescripteur
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
     * Set telBureau
     *
     * @param string $telBureau
     * @return EgwContactPrescripteur
     */
    public function setTelBureau($telBureau)
    {
        $this->telBureau = $telBureau;
    
        return $this;
    }

    /**
     * Get telBureau
     *
     * @return string 
     */
    public function getTelBureau()
    {
        return $this->telBureau;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     * @return EgwContactPrescripteur
     */
    public function setTelPortable($telPortable)
    {
        $this->telPortable = $telPortable;
    
        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string 
     */
    public function getTelPortable()
    {
        return $this->telPortable;
    }

    /**
     * Set emailBureau
     *
     * @param string $emailBureau
     * @return EgwContactPrescripteur
     */
    public function setEmailBureau($emailBureau)
    {
        $this->emailBureau = $emailBureau;
    
        return $this;
    }

    /**
     * Get emailBureau
     *
     * @return string 
     */
    public function getEmailBureau()
    {
        return $this->emailBureau;
    }

    /**
     * Set emailDomicile
     *
     * @param string $emailDomicile
     * @return EgwContactPrescripteur
     */
    public function setEmailDomicile($emailDomicile)
    {
        $this->emailDomicile = $emailDomicile;
    
        return $this;
    }

    /**
     * Get emailDomicile
     *
     * @return string 
     */
    public function getEmailDomicile()
    {
        return $this->emailDomicile;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return EgwContactPrescripteur
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
}