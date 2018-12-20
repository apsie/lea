<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwEpceTexte
 *
 * @ORM\Table(name="egw_epce_texte")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwEpceTexteRepository")
 */
class EgwEpceTexte
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $intitule
     *
     * @ORM\Column(name="intitule", type="string", length=64, nullable=true)
     */
    private $intitule;

    /**
     * @var string $valeur
     *
     * @ORM\Column(name="valeur", type="string", length=128, nullable=true)
     */
    private $valeur;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return EgwEpceTexte
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return EgwEpceTexte
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}