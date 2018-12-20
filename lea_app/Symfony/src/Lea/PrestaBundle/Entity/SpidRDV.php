<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\SpidRDV
 *
 * @ORM\Table(name="spid_rendez_vous")
 * @ORM\Entity
 */
class SpidRDV
{
    /**
     * @var integer $ticketId
     *
     * @ORM\Column(name="ticket_id", type="integer")
     * @ORM\Id
     */
    private $ticketId;

    /**
     * @var integer $calId
     *
     * @ORM\Column(name="cal_id", type="integer")
     * @ORM\Id
     */
    private $calId;

    /**
     * @var integer $creationDate
     *
     * @ORM\Column(name="creation_date", type="integer")
     */
    private $creationDate;

    /**
     * @var integer $changeDate
     *
     * @ORM\Column(name="change_date", type="integer")
     */
    private $changeDate;

    /**
     * @var integer $createurId
     *
     * @ORM\Column(name="createur_id", type="integer")
     */
    private $createurId;

    /**
     * @var integer $majId
     *
     * @ORM\Column(name="maj_id", type="integer")
     */
    private $majId;

    /**
     * @var integer $accountId
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $accountId;

    /**
     * Set ticketId
     *
     * @param integer $ticketId
     * @return SpidRDV
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
    
        return $this;
    }

    /**
     * Get ticketId
     *
     * @return integer 
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * Set calId
     *
     * @param integer $calId
     * @return SpidRDV
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
     * Set creationDate
     *
     * @param integer $creationDate
     * @return SpidRDV
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return integer 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set changeDate
     *
     * @param integer $changeDate
     * @return SpidRDV
     */
    public function setChangeDate($changeDate)
    {
        $this->changeDate = $changeDate;
    
        return $this;
    }

    /**
     * Get changeDate
     *
     * @return integer 
     */
    public function getChangeDate()
    {
        return $this->changeDate;
    }

    /**
     * Set createurId
     *
     * @param integer $createurId
     * @return SpidRDV
     */
    public function setCreateurId($createurId)
    {
        $this->createurId = $createurId;
    
        return $this;
    }

    /**
     * Get createurId
     *
     * @return integer 
     */
    public function getCreateurId()
    {
        return $this->createurId;
    }

    /**
     * Set majId
     *
     * @param integer $majId
     * @return SpidRDV
     */
    public function setMajId($majId)
    {
        $this->majId = $majId;
    
        return $this;
    }

    /**
     * Get majId
     *
     * @return integer 
     */
    public function getMajId()
    {
        return $this->majId;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return SpidRDV
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    
        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }
}
