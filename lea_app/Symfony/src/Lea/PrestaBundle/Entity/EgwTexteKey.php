<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwTexteKey
 *
 * @ORM\Table(name="egw_texte_key")
 * @ORM\Entity()
 */
class EgwTexteKey
{
    /**
     * @var integer $idTexteKey
     *
     * @ORM\Column(name="id_texte_key", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTexteKey;

    /**
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=128, nullable=false)
     */
    private $libelle;

    /**
	* @ORM\ManyToOne(targetEntity="EgwTypePrestation", inversedBy="texte")
	* @ORM\JoinColumn(name="id_type_prestation", referencedColumnName="id")
	*/
    private $typeprestation;
    
    /**
	* @ORM\OneToMany(targetEntity="EgwTexte", mappedBy="texteKey")
	*/
	protected $texte;
	public function __construct()
	{
	$this->texte = new ArrayCollection();
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
     * Set libelle
     *
     * @param string $libelle
     * @return EgwTexteKey
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set cle
     *
     * @param string $cle
     * @return EgwTexteKey
     */
    public function setCle($cle)
    {
        $this->cle = $cle;
    
        return $this;
    }

   

    /**
     * Remove texte
     *
     * @param Lea\PrestaBundle\Entity\EgwTexte $texte
     */
    public function removeTexte(\Lea\PrestaBundle\Entity\EgwTexte $texte)
    {
        $this->texte->removeElement($texte);
    }

    /**
     * Get texte
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set typeprestation
     *
     * @param Lea\PrestaBundle\Entity\EgwTypePrestation $typeprestation
     * @return EgwTexteKey
     */
    public function setTypeprestation(\Lea\PrestaBundle\Entity\EgwTypePrestation $typeprestation = null)
    {
        $this->typeprestation = $typeprestation;
    
        return $this;
    }

    /**
     * Get typeprestation
     *
     * @return Lea\PrestaBundle\Entity\EgwTypePrestation 
     */
    public function getTypeprestation()
    {
        return $this->typeprestation;
    }

    /**
     * Add texte
     *
     * @param Lea\PrestaBundle\Entity\EgwTexte $texte
     * @return EgwTexteKey
     */
    public function addTexte(\Lea\PrestaBundle\Entity\EgwTexte $texte)
    {
        $this->texte[] = $texte;
    
        return $this;
    }
}