<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwTypePrestation
 *
 * @ORM\Table(name="egw_type_prestation")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwTypePrestationRepository")
 */
class EgwTypePrestation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=128)
     */
    private $libelle;

   
	/**
	* @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="typeprestation")
	*/
	protected $prestations;
	
	/**
	* @ORM\OneToMany(targetEntity="EgwTexteKey", mappedBy="typeprestation")
	*/
	protected $texte;
	
	
	/**
	* @ORM\OneToMany(targetEntity="EgwDispositif", mappedBy="typeprestation")
	*/
	protected $dispositifs;
	public function __construct()
	{
	$this->prestations = new ArrayCollection();
	$this->dispositifs = new ArrayCollection();
	$this->texte = new ArrayCollection();
	}
    
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
     * Set libelle
     *
     * @param string $libelle
     * @return EgwTypePrestation
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
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return EgwTypePrestation
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

    /**
     * Add dispositifs
     *
     * @param Lea\PrestaBundle\Entity\EgwDispositif $dispositifs
     * @return EgwTypePrestation
     */
    public function addDispositif(\Lea\PrestaBundle\Entity\EgwDispositif $dispositifs)
    {
        $this->dispositifs[] = $dispositifs;
    
        return $this;
    }

    /**
     * Remove dispositifs
     *
     * @param Lea\PrestaBundle\Entity\EgwDispositif $dispositifs
     */
    public function removeDispositif(\Lea\PrestaBundle\Entity\EgwDispositif $dispositifs)
    {
        $this->dispositifs->removeElement($dispositifs);
    }

    /**
     * Get dispositifs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDispositifs()
    {
        return $this->dispositifs;
    }

    /**
     * Add texte
     *
     * @param Lea\PrestaBundle\Entity\EgwTexteKey $texte
     * @return EgwTypePrestation
     */
    public function addTexte(\Lea\PrestaBundle\Entity\EgwTexteKey $texte)
    {
        $this->texte[] = $texte;
    
        return $this;
    }

    /**
     * Remove texte
     *
     * @param Lea\PrestaBundle\Entity\EgwTexteKey $texte
     */
    public function removeTexte(\Lea\PrestaBundle\Entity\EgwTexteKey $texte)
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
}