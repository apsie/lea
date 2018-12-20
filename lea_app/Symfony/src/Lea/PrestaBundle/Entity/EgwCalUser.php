<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwCalUser
 *
 * @ORM\Table(name="egw_cal_user")
 * @ORM\Entity
 */
class EgwCalUser
{
    /**
     * @var integer $calId
     *
     * @ORM\Column(name="cal_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calId;

    /**
     * @var integer $calRecurDate
     *
     * @ORM\Column(name="cal_recur_date", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calRecurDate;

    /**
     * @var string $calUserType
     *
     * @ORM\Column(name="cal_user_type", type="string", length=1, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calUserType;

    /**
     * @var string $calUserId
     *
     * @ORM\Column(name="cal_user_id", type="string", length=128, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calUserId;

    /**
     * @var string $calStatus
     *
     * @ORM\Column(name="cal_status", type="string", length=1, nullable=true)
     */
    private $calStatus;

    /**
     * @var integer $calQuantity
     *
     * @ORM\Column(name="cal_quantity", type="integer", nullable=true)
     */
    private $calQuantity;

    /**
     * @var string $calRole
     *
     * @ORM\Column(name="cal_role", type="string", length=64, nullable=true)
     */
    private $calRole;
    
   /**
	* @ORM\ManyToOne(targetEntity="EgwPrestation", inversedBy="egwCalIdPrestation", cascade={"remove"})
	* @ORM\JoinColumn(name="id_prestation", referencedColumnName="id_presta")
	*/
    private $idPrestation;
  	
  	/**
     * @var string $motifAbsence
     *
     * @ORM\Column(name="motif_absence", type="string", length=128, nullable=true)
     */
    private $motifAbsence;
    

    /**
     * @var \DateTime $calUserModified
     *
     * @ORM\Column(name="cal_user_modified", type="datetime", nullable=false)
     */
    private $calUserModified;

	/**
	* @ORM\ManyToOne(targetEntity="EgwCal", inversedBy="egwCalIdUser", cascade={"remove"})
	* @ORM\JoinColumn(name="cal_id", referencedColumnName="cal_id")
	*/
	protected $egwCalId;

    /**
     * Set calId
     *
     * @param integer $calId
     * @return EgwCalUser
     */
    public function setCalId($calId)
    {
        $this->calId = $calId;
    
        return $this;
    }

    /**
     * Get calId
     *
     * @return integer 
     */
    public function getCalId()
    {
        return $this->calId;
    }

    /**
     * Set calRecurDate
     *
     * @param integer $calRecurDate
     * @return EgwCalUser
     */
    public function setCalRecurDate($calRecurDate)
    {
        $this->calRecurDate = $calRecurDate;
    
        return $this;
    }

    /**
     * Get calRecurDate
     *
     * @return integer 
     */
    public function getCalRecurDate()
    {
        return $this->calRecurDate;
    }

    /**
     * Set calUserType
     *
     * @param string $calUserType
     * @return EgwCalUser
     */
    public function setCalUserType($calUserType)
    {
        $this->calUserType = $calUserType;
    
        return $this;
    }

    /**
     * Get calUserType
     *
     * @return string 
     */
    public function getCalUserType()
    {
        return $this->calUserType;
    }

    /**
     * Set calUserId
     *
     * @param string $calUserId
     * @return EgwCalUser
     */
    public function setCalUserId($calUserId)
    {
        $this->calUserId = $calUserId;
    
        return $this;
    }

    /**
     * Get calUserId
     *
     * @return string 
     */
    public function getCalUserId()
    {
        return $this->calUserId;
    }

    /**
     * Set calStatus
     *
     * @param string $calStatus
     * @return EgwCalUser
     */
    public function setCalStatus($calStatus)
    {
        $this->calStatus = $calStatus;
    
        return $this;
    }

    /**
     * Get calStatus
     *
     * @return string 
     */
    public function getCalStatus()
    {
        return $this->calStatus;
    }

    /**
     * Set calQuantity
     *
     * @param integer $calQuantity
     * @return EgwCalUser
     */
    public function setCalQuantity($calQuantity)
    {
        $this->calQuantity = $calQuantity;
    
        return $this;
    }

    /**
     * Get calQuantity
     *
     * @return integer 
     */
    public function getCalQuantity()
    {
        return $this->calQuantity;
    }

    /**
     * Set calRole
     *
     * @param string $calRole
     * @return EgwCalUser
     */
    public function setCalRole($calRole)
    {
        $this->calRole = $calRole;
    
        return $this;
    }

    /**
     * Get calRole
     *
     * @return string 
     */
    public function getCalRole()
    {
        return $this->calRole;
    }

    /**
     * Set calUserModified
     *
     * @param \DateTime $calUserModified
     * @return EgwCalUser
     */
    public function setCalUserModified($calUserModified)
    {
        $this->calUserModified = $calUserModified;
    
        return $this;
    }

    /**
     * Get calUserModified
     *
     * @return \DateTime 
     */
    public function getCalUserModified()
    {
        return $this->calUserModified;
    }

  

    /**
     * Set egwCalId
     *
     * @param Lea\PrestaBundle\Entity\EgwCal $egwCalId
     * @return EgwCalUser
     */
    public function setEgwCalId(\Lea\PrestaBundle\Entity\EgwCal $egwCalId = null)
    {
        $this->egwCalId = $egwCalId;
    
        return $this;
    }

    /**
     * Get egwCalId
     *
     * @return Lea\PrestaBundle\Entity\EgwCal 
     */
    public function getEgwCalId()
    {
        return $this->egwCalId;
    }

   
    
  
    

    /**
     * Set idPrestation
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $idPrestation
     * @return EgwCalUser
     */
    public function setIdPrestation(\Lea\PrestaBundle\Entity\EgwPrestation $idPrestation = null)
    {
        $this->idPrestation = $idPrestation;
    
        return $this;
    }

    /**
     * Get idPrestation
     *
     * @return Lea\PrestaBundle\Entity\EgwPrestation 
     */
    public function getIdPrestation()
    {
        return $this->idPrestation;
    }
    

    /**
     * Set motifAbsence
     *
     * @param string $motifAbsence
     * @return EgwCalUser
     */
    public function setMotifAbsence($motifAbsence)
    {
        $this->motifAbsence = $motifAbsence;
    
        return $this;
    }

    /**
     * Get motifAbsence
     *
     * @return string 
     */
    public function getMotifAbsence()
    {
        return $this->motifAbsence;
    }
}