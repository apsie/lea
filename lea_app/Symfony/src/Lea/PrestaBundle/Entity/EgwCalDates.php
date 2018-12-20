<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwCalDates
 *
 * @ORM\Table(name="egw_cal_dates")
 * @ORM\Entity
 */
class EgwCalDates
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
     * @var integer $calStart
     *
     * @ORM\Column(name="cal_start", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $calStart;

    /**
     * @var integer $calEnd
     *
     * @ORM\Column(name="cal_end", type="bigint", nullable=false)
     */
    private $calEnd;

	/**
	* @ORM\ManyToOne(targetEntity="EgwCal", inversedBy="egwCalIdDates", cascade={"remove"})
	* @ORM\JoinColumn(name="cal_id", referencedColumnName="cal_id")
	*/
	protected $egwCalId;

    /**
     * Set calId
     *
     * @param integer $calId
     * @return EgwCalDates
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
     * Set calStart
     *
     * @param integer $calStart
     * @return EgwCalDates
     */
    public function setCalStart($calStart)
    {
        $this->calStart = $calStart;
    
        return $this;
    }

    /**
     * Get calStart
     *
     * @return integer 
     */
    public function getCalStart()
    {
        return $this->calStart;
    }

    /**
     * Set calEnd
     *
     * @param integer $calEnd
     * @return EgwCalDates
     */
    public function setCalEnd($calEnd)
    {
        $this->calEnd = $calEnd;
    
        return $this;
    }

    /**
     * Get calEnd
     *
     * @return integer 
     */
    public function getCalEnd()
    {
        return $this->calEnd;
    }

    /**
     * Set egwCalId
     *
     * @param Lea\PrestaBundle\Entity\EgwCal $egwCalId
     * @return EgwCalDates
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
}