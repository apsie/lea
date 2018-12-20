<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwContract
 *
 * @ORM\Table(name="spiclient_contrats")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwContractRepository")
 */
class EgwContract
{
    /**
     * @var integer $contract_id
     *
     * @ORM\Column(name="contract_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $contract_id;

    /**
     * @var string $contract_title
     *
     * @ORM\Column(name="contract_title", type="string", length=50)
     */
    private $contract_title;

    /**
     * @var integer $contract_supplier
     *
     * @ORM\Column(name="contract_supplier", type="integer")
     */
    private $contract_supplier;

    /**
     * @var integer $contract_client
     *
     * @ORM\Column(name="contract_client", type="integer")
     */
    private $contract_client;

    /**
    * @ORM\OneToMany(targetEntity="EgwDispositif", mappedBy="typeprestation")
    */
    protected $dispositifs;

    public function __construct()
    {
        $this->dispositifs = new ArrayCollection();
    }

    /**
     * Set contract_id
     *
     * @param integer $contractId
     * @return EgwContract
     */
    public function setContractId($contractId)
    {
        $this->contract_id = $contractId;
    
        return $this;
    }

    /**
     * Get contract_id
     *
     * @return integer 
     */
    public function getContractId()
    {
        return $this->contract_id;
    }

    /**
     * Set contract_title
     *
     * @param string $contractTitle
     * @return EgwContract
     */
    public function setContractTitle($contractTitle)
    {
        $this->contract_title = $contractTitle;
    
        return $this;
    }

    /**
     * Get contract_title
     *
     * @return string 
     */
    public function getContractTitle()
    {
        return $this->contract_title;
    }

    /**
     * Set contract_supplier
     *
     * @param integer $contractSupplier
     * @return EgwContract
     */
    public function setContractSupplier($contractSupplier)
    {
        $this->contract_supplier = $contractSupplier;
    
        return $this;
    }

    /**
     * Get contract_supplier
     *
     * @return integer 
     */
    public function getContractSupplier()
    {
        return $this->contract_supplier;
    }

    /**
     * Set contract_client
     *
     * @param integer $contractClient
     * @return EgwContract
     */
    public function setContractClient($contractClient)
    {
        $this->contract_client = $contractClient;
    
        return $this;
    }

    /**
     * Get contract_client
     *
     * @return integer 
     */
    public function getContractClient()
    {
        return $this->contract_client;
    }

    /**
     * Add dispositifs
     *
     * @param Lea\PrestaBundle\Entity\EgwDispositif $dispositifs
     * @return EgwContract
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