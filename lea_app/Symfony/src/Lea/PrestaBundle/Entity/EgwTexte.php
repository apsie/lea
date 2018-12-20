<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwTexte
 *
 * @ORM\Table(name="egw_texte")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwTexteRepository")
 */
class EgwTexte
{
    /**
     * @var integer $idTexte
     *
     * @ORM\Column(name="id_texte", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTexte;

    /**
     * @var integer $idTexteKey
     *
     * @ORM\Column(name="id_texte_key", type="bigint", nullable=false)
     */
    private $idTexteKey;

    /**
     * @var string $texte
     *
     * @ORM\Column(name="texte", type="string", length=256, nullable=false)
     */
    private $texte;
    
    
    /**
	* @ORM\ManyToOne(targetEntity="EgwTexteKey", inversedBy="texte")
	* @ORM\JoinColumn(name="id_texte_key", referencedColumnName="id_texte_key")
	*/
    private $texteKey;



    /**
     * Get idTexte
     *
     * @return integer 
     */
    public function getIdTexte()
    {
        return $this->idTexte;
    }

    /**
     * Set idTexteKey
     *
     * @param integer $idTexteKey
     * @return EgwTexte
     */
    public function setIdTexteKey($idTexteKey)
    {
        $this->idTexteKey = $idTexteKey;
    
        return $this;
    }

    /**
     * Get idTexteKey
     *
     * @return integer 
     */
    public function getIdTexteKey()
    {
        return $this->idTexteKey;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return EgwTexte
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    
        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set texteKey
     *
     * @param Lea\PrestaBundle\Entity\EgwTexteKey $texteKey
     * @return EgwTexte
     */
    public function setTexteKey(\Lea\PrestaBundle\Entity\EgwTexteKey $texteKey = null)
    {
        $this->texteKey = $texteKey;
    
        return $this;
    }

    /**
     * Get texteKey
     *
     * @return Lea\PrestaBundle\Entity\EgwTexteKey 
     */
    public function getTexteKey()
    {
        return $this->texteKey;
    }
}