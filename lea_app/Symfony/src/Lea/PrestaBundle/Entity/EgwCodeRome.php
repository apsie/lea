<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwCodeRome
 *
 * @ORM\Table(name="egw_code_rome")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwCodeRomeRepository")
 */
class EgwCodeRome
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
     * @var string $codeRome
     *
     * @ORM\Column(name="code_rome", type="string", length=64, nullable=false)
     */
    private $codeRome;

    /**
     * @var string $intitule
     *
     * @ORM\Column(name="intitule", type="string", length=64, nullable=false)
     */
    private $intitule;

    /**
     * @var string $appellation
     *
     * @ORM\Column(name="appellation", type="string", length=64, nullable=false)
     */
    private $appellation;



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
     * Set codeRome
     *
     * @param string $codeRome
     * @return EgwCodeRome
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
     * Set intitule
     *
     * @param string $intitule
     * @return EgwCodeRome
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
     * Set appellation
     *
     * @param string $appellation
     * @return EgwCodeRome
     */
    public function setAppellation($appellation)
    {
        $this->appellation = $appellation;
    
        return $this;
    }

    /**
     * Get appellation
     *
     * @return string 
     */
    public function getAppellation()
    {
        return $this->appellation;
    }
}