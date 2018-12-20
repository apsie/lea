<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lea\PrestaBundle\Entity\EgwCal
 *
 * @ORM\Table(name="egw_cal")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwCalRepository")
 */
class EgwCal
{
    /**
     * @var integer $calId
     *
     * @ORM\Column(name="cal_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $calId;

    /**
     * @var string $calUid
     *
     * @ORM\Column(name="cal_uid", type="string", length=255, nullable=false)
     */
    private $calUid;

    /**
     * @var integer $calOwner
     *
     * @ORM\Column(name="cal_owner", type="integer", nullable=false)
     */
    private $calOwner;

    /**
     * @var string $calCategory
     *
     * @ORM\Column(name="cal_category", type="string", length=30, nullable=true)
     */
    private $calCategory;

    /**
     * @var integer $calModified
     *
     * @ORM\Column(name="cal_modified", type="bigint", nullable=true)
     */
    private $calModified;

    /**
     * @var integer $calPriority
     *
     * @ORM\Column(name="cal_priority", type="smallint", nullable=false)
     */
    private $calPriority;

    /**
     * @var integer $calPublic
     *
     * @ORM\Column(name="cal_public", type="smallint", nullable=false)
     */
    private $calPublic;

    /**
     * @var string $calTitle
     *
     * @ORM\Column(name="cal_title", type="string", length=255, nullable=false)
     */
    private $calTitle;

    /**
     * @var string $calDescription
     *
     * @ORM\Column(name="cal_description", type="text", nullable=true)
     */
    private $calDescription;

    /**
     * @var string $calLocation
     *
     * @ORM\Column(name="cal_location", type="string", length=255, nullable=true)
     */
    private $calLocation;

    /**
     * @var integer $calReference
     *
     * @ORM\Column(name="cal_reference", type="integer", nullable=false)
     */
    private $calReference;

    /**
     * @var integer $calModifier
     *
     * @ORM\Column(name="cal_modifier", type="integer", nullable=true)
     */
    private $calModifier;

    /**
     * @var integer $calNonBlocking
     *
     * @ORM\Column(name="cal_non_blocking", type="smallint", nullable=true)
     */
    private $calNonBlocking;

    /**
     * @var integer $calSpecial
     *
     * @ORM\Column(name="cal_special", type="smallint", nullable=true)
     */
    private $calSpecial;

    /**
     * @var integer $calEtag
     *
     * @ORM\Column(name="cal_etag", type="integer", nullable=true)
     */
    private $calEtag;

    /**
     * @var integer $calCreator
     *
     * @ORM\Column(name="cal_creator", type="integer", nullable=false)
     */
    private $calCreator;

    /**
     * @var integer $calCreated
     *
     * @ORM\Column(name="cal_created", type="bigint", nullable=false)
     */
    private $calCreated;

    /**
     * @var integer $calRecurrence
     *
     * @ORM\Column(name="cal_recurrence", type="bigint", nullable=false)
     */
    private $calRecurrence;

    /**
     * @var integer $tzId
     *
     * @ORM\Column(name="tz_id", type="integer", nullable=true)
     */
    private $tzId;

    /**
     * @var integer $calDeleted
     *
     * @ORM\Column(name="cal_deleted", type="bigint", nullable=true)
     */
    private $calDeleted;

    /**
     * @var string $caldavName
     *
     * @ORM\Column(name="caldav_name", type="string", length=64, nullable=true)
     */
    private $caldavName;

    /**
     * @var integer $idPresta
     *
     * @ORM\Column(name="id_presta", type="bigint", nullable=false)
     */
    private $idPresta;


    /**
     * @var string $calSite
     *
     * @ORM\Column(name="cal_site", type="integer", nullable=true)
     */
    private $calSite;

    /**
     * @var integer $rangeStart
     *
     * @ORM\Column(name="range_start", type="bigint", nullable=false)
     */
    private $rangeStart;

    
    /**
     * @var integer $rangeEnd
     *
     * @ORM\Column(name="range_end", type="bigint", nullable=false)
     */
    private $rangeEnd;

   
    
    /**
	*  @ORM\OneToOne(targetEntity="EgwCalDates", cascade={"persist", "merge", "remove"})
	*  @ORM\JoinColumn(name="cal_id", referencedColumnName="cal_id")
	*/
    protected $egwCalIdDates;
    
	/**
	* @ORM\OneToMany(targetEntity="EgwCalUser", mappedBy="egwCalId")
	*/
	protected $egwCalIdUser;
	public function __construct()
	{
	$this->egwCalIdUser = new ArrayCollection();
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
     * Set calUid
     *
     * @param string $calUid
     * @return EgwCal
     */
    public function setCalUid($calUid)
    {
        $this->calUid = $calUid;
    
        return $this;
    }

    /**
     * Get calUid
     *
     * @return string 
     */
    public function getCalUid()
    {
        return $this->calUid;
    }

    /**
     * Set calOwner
     *
     * @param integer $calOwner
     * @return EgwCal
     */
    public function setCalOwner($calOwner)
    {
        $this->calOwner = $calOwner;
    
        return $this;
    }

    /**
     * Get calOwner
     *
     * @return integer 
     */
    public function getCalOwner()
    {
        return $this->calOwner;
    }

    /**
     * Set calCategory
     *
     * @param string $calCategory
     * @return EgwCal
     */
    public function setCalCategory($calCategory)
    {
        $this->calCategory = $calCategory;
    
        return $this;
    }

    /**
     * Get calCategory
     *
     * @return string 
     */
    public function getCalCategory()
    {
        return $this->calCategory;
    }

    /**
     * Set calModified
     *
     * @param integer $calModified
     * @return EgwCal
     */
    public function setCalModified($calModified)
    {
        $this->calModified = $calModified;
    
        return $this;
    }

    /**
     * Get calModified
     *
     * @return integer 
     */
    public function getCalModified()
    {
        return $this->calModified;
    }

    /**
     * Set calPriority
     *
     * @param integer $calPriority
     * @return EgwCal
     */
    public function setCalPriority($calPriority)
    {
        $this->calPriority = $calPriority;
    
        return $this;
    }

    /**
     * Get calPriority
     *
     * @return integer 
     */
    public function getCalPriority()
    {
        return $this->calPriority;
    }

    /**
     * Set calPublic
     *
     * @param integer $calPublic
     * @return EgwCal
     */
    public function setCalPublic($calPublic)
    {
        $this->calPublic = $calPublic;
    
        return $this;
    }

    /**
     * Get calPublic
     *
     * @return integer 
     */
    public function getCalPublic()
    {
        return $this->calPublic;
    }

    /**
     * Set calTitle
     *
     * @param string $calTitle
     * @return EgwCal
     */
    public function setCalTitle($calTitle)
    {
        $this->calTitle = $calTitle;
    
        return $this;
    }

    /**
     * Get calTitle
     *
     * @return string 
     */
    public function getCalTitle()
    {
        return $this->calTitle;
    }

    /**
     * Set calDescription
     *
     * @param string $calDescription
     * @return EgwCal
     */
    public function setCalDescription($calDescription)
    {
        $this->calDescription = $calDescription;
    
        return $this;
    }

    /**
     * Get calDescription
     *
     * @return string 
     */
    public function getCalDescription()
    {
        return $this->calDescription;
    }

    /**
     * Set calLocation
     *
     * @param string $calLocation
     * @return EgwCal
     */
    public function setCalLocation($calLocation)
    {
        $this->calLocation = $calLocation;
    
        return $this;
    }

    /**
     * Get calLocation
     *
     * @return string 
     */
    public function getCalLocation()
    {
        return $this->calLocation;
    }

    /**
     * Set calReference
     *
     * @param integer $calReference
     * @return EgwCal
     */
    public function setCalReference($calReference)
    {
        $this->calReference = $calReference;
    
        return $this;
    }

    /**
     * Get calReference
     *
     * @return integer 
     */
    public function getCalReference()
    {
        return $this->calReference;
    }

    /**
     * Set calModifier
     *
     * @param integer $calModifier
     * @return EgwCal
     */
    public function setCalModifier($calModifier)
    {
        $this->calModifier = $calModifier;
    
        return $this;
    }

    /**
     * Get calModifier
     *
     * @return integer 
     */
    public function getCalModifier()
    {
        return $this->calModifier;
    }

    /**
     * Set calNonBlocking
     *
     * @param integer $calNonBlocking
     * @return EgwCal
     */
    public function setCalNonBlocking($calNonBlocking)
    {
        $this->calNonBlocking = $calNonBlocking;
    
        return $this;
    }

    /**
     * Get calNonBlocking
     *
     * @return integer 
     */
    public function getCalNonBlocking()
    {
        return $this->calNonBlocking;
    }

    /**
     * Set calSpecial
     *
     * @param integer $calSpecial
     * @return EgwCal
     */
    public function setCalSpecial($calSpecial)
    {
        $this->calSpecial = $calSpecial;
    
        return $this;
    }

    /**
     * Get calSpecial
     *
     * @return integer 
     */
    public function getCalSpecial()
    {
        return $this->calSpecial;
    }

    /**
     * Set calEtag
     *
     * @param integer $calEtag
     * @return EgwCal
     */
    public function setCalEtag($calEtag)
    {
        $this->calEtag = $calEtag;
    
        return $this;
    }

    /**
     * Get calEtag
     *
     * @return integer 
     */
    public function getCalEtag()
    {
        return $this->calEtag;
    }

    /**
     * Set calCreator
     *
     * @param integer $calCreator
     * @return EgwCal
     */
    public function setCalCreator($calCreator)
    {
        $this->calCreator = $calCreator;
    
        return $this;
    }

    /**
     * Get calCreator
     *
     * @return integer 
     */
    public function getCalCreator()
    {
        return $this->calCreator;
    }

    /**
     * Set calCreated
     *
     * @param integer $calCreated
     * @return EgwCal
     */
    public function setCalCreated($calCreated)
    {
        $this->calCreated = $calCreated;
    
        return $this;
    }

    /**
     * Get calCreated
     *
     * @return integer 
     */
    public function getCalCreated()
    {
        return $this->calCreated;
    }

    /**
     * Set calRecurrence
     *
     * @param integer $calRecurrence
     * @return EgwCal
     */
    public function setCalRecurrence($calRecurrence)
    {
        $this->calRecurrence = $calRecurrence;
    
        return $this;
    }

    /**
     * Get calRecurrence
     *
     * @return integer 
     */
    public function getCalRecurrence()
    {
        return $this->calRecurrence;
    }

    /**
     * Set tzId
     *
     * @param integer $tzId
     * @return EgwCal
     */
    public function setTzId($tzId)
    {
        $this->tzId = $tzId;
    
        return $this;
    }

    /**
     * Get tzId
     *
     * @return integer 
     */
    public function getTzId()
    {
        return $this->tzId;
    }

    /**
     * Set calDeleted
     *
     * @param integer $calDeleted
     * @return EgwCal
     */
    public function setCalDeleted($calDeleted)
    {
        $this->calDeleted = $calDeleted;
    
        return $this;
    }

    /**
     * Get calDeleted
     *
     * @return integer 
     */
    public function getCalDeleted()
    {
        return $this->calDeleted;
    }

    /**
     * Set caldavName
     *
     * @param string $caldavName
     * @return EgwCal
     */
    public function setCaldavName($caldavName)
    {
        $this->caldavName = $caldavName;
    
        return $this;
    }

    /**
     * Get caldavName
     *
     * @return string 
     */
    public function getCaldavName()
    {
        return $this->caldavName;
    }

    /**
     * Set idPresta
     *
     * @param integer $idPresta
     * @return EgwCal
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
     * Set egwCalIdDates
     *
     * @param Lea\PrestaBundle\Entity\EgwCalDates $egwCalIdDates
     * @return EgwCal
     */
    public function setEgwCalIdDates(\Lea\PrestaBundle\Entity\EgwCalDates $egwCalIdDates = null)
    {
        $this->egwCalIdDates = $egwCalIdDates;
    
        return $this;
    }

    /**
     * Get egwCalIdDates
     *
     * @return Lea\PrestaBundle\Entity\EgwCalDates 
     */
    public function getEgwCalIdDates()
    {
        return $this->egwCalIdDates;
    }

    /**
     * Add egwCalIdUser
     *
     * @param Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdUser
     * @return EgwCal
     */
    public function addEgwCalIdUser(\Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdUser)
    {
        $this->egwCalIdUser[] = $egwCalIdUser;
    
        return $this;
    }

    /**
     * Remove egwCalIdUser
     *
     * @param Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdUser
     */
    public function removeEgwCalIdUser(\Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdUser)
    {
        $this->egwCalIdUser->removeElement($egwCalIdUser);
    }

    /**
     * Get egwCalIdUser
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEgwCalIdUser()
    {
        return $this->egwCalIdUser;
    }

    /**
     * Set calSite
     *
     * @param integer $calSite
     * @return EgwCal
     */
    public function setCalSite($calSite)
    {
        $this->calSite = $calSite;
    
        return $this;
    }

    /**
     * Get calSite
     *
     * @return integer 
     */
    public function getCalSite()
    {
        return $this->calSite;
    }

    /**
     * Set rangeStart
     *
     * @param integer $rangeStart
     * @return EgwCalDates
     */
    public function setRangeStart($rangeStart)
    {
        $this->rangeStart = $rangeStart;
    
        return $this;
    }

    /**
     * Get rangeStart
     *
     * @return integer 
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * Set rangeEnd
     *
     * @param integer $rangeEnd
     * @return EgwCalDates
     */
    public function setRangeEnd($rangeEnd)
    {
        $this->rangeEnd = $rangeEnd;
    
        return $this;
    }

    /**
     * Get rangeEnd
     *
     * @return integer 
     */
    public function getRangeEnd()
    {
        return $this->rangeEnd;
    }
}