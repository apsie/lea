<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwPrestaData
 *
 * @ORM\Table(name="egw_presta_data")
 * @ORM\Entity
 */
class EgwPrestaData
{
    /**
     * @var integer $idPrestaData
     *
     * @ORM\Column(name="id_presta_data", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrestaData;

    /**
     * @var integer $idPresta
     *
     * @ORM\Column(name="id_presta", type="bigint", nullable=false)
     */
    private $idPresta;

    /**
     * @var string $clef
     *
     * @ORM\Column(name="clef", type="string", length=128, nullable=false)
     */
    private $clef;

    /**
     * @var string $valeur
     *
     * @ORM\Column(name="valeur", type="text", nullable=true)
     */
    private $valeur;



    /**
     * Get idPrestaData
     *
     * @return integer 
     */
    public function getIdPrestaData()
    {
        return $this->idPrestaData;
    }

    /**
     * Set idPresta
     *
     * @param integer $idPresta
     * @return EgwPrestaData
     */
    public function setIdPresta($idPresta)
    {
        $this->idPresta = $idPresta;
    
        return $this;
    }

    /**
     * Get idPresta
     *
     * @return integer 
     */
    public function getIdPresta()
    {
        return $this->idPresta;
    }

    /**
     * Set clef
     *
     * @param string $clef
     * @return EgwPrestaData
     */
    public function setClef($clef)
    {
        $this->clef = $clef;
    
        return $this;
    }

    /**
     * Get clef
     *
     * @return string 
     */
    public function getClef()
    {
        return $this->clef;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return EgwPrestaData
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