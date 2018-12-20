<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwContactFichier
 *
 * @ORM\Table(name="egw_contact_fichier")
 * @ORM\Entity
 */
class EgwContactFichier
{
    /**
     * @var integer $idFichier
     *
     * @ORM\Column(name="id_fichier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFichier;

    /**
     * @var integer $idContact
     *
     * @ORM\Column(name="id_contact", type="bigint", nullable=false)
     */
    private $idContact;

    /**
     * @var integer $dateUpload
     *
     * @ORM\Column(name="date_upload", type="bigint", nullable=false)
     */
    private $dateUpload;

    /**
     * @var integer $idOwner
     *
     * @ORM\Column(name="id_owner", type="bigint", nullable=false)
     */
    private $idOwner;

    /**
     * @var string $typeDeFichier
     *
     * @ORM\Column(name="type_de_fichier", type="string", length=68, nullable=false)
     */
    private $typeDeFichier;

    /**
     * @var string $nomFichier
     *
     * @ORM\Column(name="nom_fichier", type="text", nullable=true)
     */
    private $nomFichier;

    /**
     * @var integer $tailleFichier
     *
     * @ORM\Column(name="taille_fichier", type="bigint", nullable=false)
     */
    private $tailleFichier;

    /**
     * @var boolean $isPrivate
     *
     * @ORM\Column(name="is_private", type="boolean", nullable=false)
     */
    private $isPrivate;



    /**
     * Get idFichier
     *
     * @return integer 
     */
    public function getIdFichier()
    {
        return $this->idFichier;
    }

    /**
     * Set idContact
     *
     * @param integer $idContact
     * @return EgwContactFichier
     */
    public function setIdContact($idContact)
    {
        $this->idContact = $idContact;
    
        return $this;
    }

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
     * Set dateUpload
     *
     * @param integer $dateUpload
     * @return EgwContactFichier
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;
    
        return $this;
    }

    /**
     * Get dateUpload
     *
     * @return integer 
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }

    /**
     * Set idOwner
     *
     * @param integer $idOwner
     * @return EgwContactFichier
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
     * Set typeDeFichier
     *
     * @param string $typeDeFichier
     * @return EgwContactFichier
     */
    public function setTypeDeFichier($typeDeFichier)
    {
        $this->typeDeFichier = $typeDeFichier;
    
        return $this;
    }

    /**
     * Get typeDeFichier
     *
     * @return string 
     */
    public function getTypeDeFichier()
    {
        return $this->typeDeFichier;
    }

    /**
     * Set nomFichier
     *
     * @param string $nomFichier
     * @return EgwContactFichier
     */
    public function setNomFichier($nomFichier)
    {
        $this->nomFichier = $nomFichier;
    
        return $this;
    }

    /**
     * Get nomFichier
     *
     * @return string 
     */
    public function getNomFichier()
    {
        return $this->nomFichier;
    }

    /**
     * Set tailleFichier
     *
     * @param integer $tailleFichier
     * @return EgwContactFichier
     */
    public function setTailleFichier($tailleFichier)
    {
        $this->tailleFichier = $tailleFichier;
    
        return $this;
    }

    /**
     * Get tailleFichier
     *
     * @return integer 
     */
    public function getTailleFichier()
    {
        return $this->tailleFichier;
    }

    /**
     * Set isPrivate
     *
     * @param boolean $isPrivate
     * @return EgwContactFichier
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;
    
        return $this;
    }

    /**
     * Get isPrivate
     *
     * @return boolean 
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }
}