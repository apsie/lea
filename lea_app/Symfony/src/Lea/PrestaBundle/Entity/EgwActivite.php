<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwActivite
 *
 * @ORM\Table("egw_activite")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwActiviteRepository")
 */
class EgwActivite
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id_activite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    
	/**
	* @ORM\OneToMany(targetEntity="EgwDispositif", mappedBy="activites")
	*/
	protected $dispositifs;
	public function __construct()
	{
	$this->dispositifs = new ArrayCollection();
	
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
     * @return EgwActivite
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
     * Add dispositifs
     *
     * @param Lea\PrestaBundle\Entity\EgwDispositif $dispositifs
     * @return EgwActivite
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
}