<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\SpidTickets
 *
 * @ORM\Table(name="spid_tickets")
 * @ORM\Entity
 */
class SpidTickets
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="ticket_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $ticketNumGroup
     *
     * @ORM\Column(name="ticket_num_group", type="integer")
     */
    private $ticketNumGroup;

    /**
     * @var integer $catId
     *
     * @ORM\Column(name="cat_id", type="integer")
     */
    private $catId;

    /**
     * @var integer $accountId
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $accountId;

    /**
     * @var integer $stateId
     *
     * @ORM\Column(name="state_id", type="integer")
     */
    private $stateId;

    /**
     * @var integer $factureId
     *
     * @ORM\Column(name="facture_id", type="integer")
     */
    private $factureId;

    /**
     * @var integer $creatorId
     *
     * @ORM\Column(name="creator_id", type="integer")
     */
    private $creatorId;

    /**
     * @var string $ticketTitle
     *
     * @ORM\Column(name="ticket_title", type="string", length=255)
     */
    private $ticketTitle;

    /**
     * @var integer $ticketPriority
     *
     * @ORM\Column(name="ticket_priority", type="smallint")
     */
    private $ticketPriority;

    /**
     * @var integer $ticketAssignedTo
     *
     * @ORM\Column(name="ticket_assigned_to", type="integer")
     */
    private $ticketAssignedTo;

    /**
     * @var integer $ticketAssignedBy
     *
     * @ORM\Column(name="ticket_assigned_by", type="integer")
     */
    private $ticketAssignedBy;

    /**
     * @var float $ticketSpendTime
     *
     * @ORM\Column(name="ticket_spend_time", type="decimal")
     */
    private $ticketSpendTime;

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
     * @var integer $closedDate
     *
     * @ORM\Column(name="closed_date", type="integer")
     */
    private $closedDate;

    /**
     * @var integer $dueDate
     *
     * @ORM\Column(name="due_date", type="integer")
     */
    private $dueDate;

    /**
     * @var integer $ticketClosed
     *
     * @ORM\Column(name="ticket_closed", type="smallint")
     */
    private $ticketClosed;

    /**
     * @var integer $ticketInvoice
     *
     * @ORM\Column(name="ticket_invoice", type="smallint")
     */
    private $ticketInvoice;

    /**
     * @var integer $locationId
     *
     * @ORM\Column(name="location_id", type="integer")
     */
    private $locationId;

    /**
     * @var string $locationPrecision
     *
     * @ORM\Column(name="location_precision", type="string", length=255)
     */
    private $locationPrecision;

    /**
     * @var integer $ticketPrivate
     *
     * @ORM\Column(name="ticket_private", type="integer")
     */
    private $ticketPrivate;

    /**
     * @var float $ticketBudget
     *
     * @ORM\Column(name="ticket_budget", type="decimal")
     */
    private $ticketBudget;

    /**
     * @var integer $contractId
     *
     * @ORM\Column(name="contract_id", type="integer")
     */
    private $contractId;

    /**
     * @var integer $ticketUnitTime
     *
     * @ORM\Column(name="ticket_unit_time", type="integer")
     */
    private $ticketUnitTime;

    /**
     * @var integer $ticketNbStudent
     *
     * @ORM\Column(name="ticket_nb_student", type="integer")
     */
    private $ticketNbStudent;

    /**
     * @var float $ticketPriceStudent
     *
     * @ORM\Column(name="ticket_price_student", type="decimal")
     */
    private $ticketPriceStudent;

    /**
     * @var integer $clientId
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var integer $ticketAssignedByContact
     *
     * @ORM\Column(name="ticket_assigned_by_contact", type="integer")
     */
    private $ticketAssignedByContact;

    /**
     * @var string $ticketClientOrder
     *
     * @ORM\Column(name="ticket_client_order", type="string", length=50)
     */
    private $ticketClientOrder;

    /**
     * @var string $ticketClientOrderId
     *
     * @ORM\Column(name="ticket_client_order_id", type="string", length=50)
     */
    private $ticketClientOrderId;

    /**
     * @var string $ticketProvOrderId
     *
     * @ORM\Column(name="ticket_prov_order_id", type="string", length=50)
     */
    private $ticketProvOrderId;

    /**
     * @var string $ticketProvProId
     *
     * @ORM\Column(name="ticket_prov_pro_id", type="string", length=50)
     */
    private $ticketProvProId;

    /**
     * @var integer $ticketSite
     *
     * @ORM\Column(name="ticket_site", type="integer")
     */
    private $ticketSite;


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
     * Set ticketNumGroup
     *
     * @param integer $ticketNumGroup
     * @return SpidTickets
     */
    public function setTicketNumGroup($ticketNumGroup)
    {
        $this->ticketNumGroup = $ticketNumGroup;
    
        return $this;
    }

    /**
     * Get ticketNumGroup
     *
     * @return integer 
     */
    public function getTicketNumGroup()
    {
        return $this->ticketNumGroup;
    }

    /**
     * Set catId
     *
     * @param integer $catId
     * @return SpidTickets
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;
    
        return $this;
    }

    /**
     * Get catId
     *
     * @return integer 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return SpidTickets
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

    /**
     * Set stateId
     *
     * @param integer $stateId
     * @return SpidTickets
     */
    public function setStateId($stateId)
    {
        $this->stateId = $stateId;
    
        return $this;
    }

    /**
     * Get stateId
     *
     * @return integer 
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Set factureId
     *
     * @param integer $factureId
     * @return SpidTickets
     */
    public function setFactureId($factureId)
    {
        $this->factureId = $factureId;
    
        return $this;
    }

    /**
     * Get factureId
     *
     * @return integer 
     */
    public function getFactureId()
    {
        return $this->factureId;
    }

    /**
     * Set creatorId
     *
     * @param integer $creatorId
     * @return SpidTickets
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    
        return $this;
    }

    /**
     * Get creatorId
     *
     * @return integer 
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set ticketTitle
     *
     * @param string $ticketTitle
     * @return SpidTickets
     */
    public function setTicketTitle($ticketTitle)
    {
        $this->ticketTitle = $ticketTitle;
    
        return $this;
    }

    /**
     * Get ticketTitle
     *
     * @return string 
     */
    public function getTicketTitle()
    {
        return $this->ticketTitle;
    }

    /**
     * Set ticketPriority
     *
     * @param integer $ticketPriority
     * @return SpidTickets
     */
    public function setTicketPriority($ticketPriority)
    {
        $this->ticketPriority = $ticketPriority;
    
        return $this;
    }

    /**
     * Get ticketPriority
     *
     * @return integer 
     */
    public function getTicketPriority()
    {
        return $this->ticketPriority;
    }

    /**
     * Set ticketAssignedTo
     *
     * @param integer $ticketAssignedTo
     * @return SpidTickets
     */
    public function setTicketAssignedTo($ticketAssignedTo)
    {
        $this->ticketAssignedTo = $ticketAssignedTo;
    
        return $this;
    }

    /**
     * Get ticketAssignedTo
     *
     * @return integer 
     */
    public function getTicketAssignedTo()
    {
        return $this->ticketAssignedTo;
    }

    /**
     * Set ticketAssignedBy
     *
     * @param integer $ticketAssignedBy
     * @return SpidTickets
     */
    public function setTicketAssignedBy($ticketAssignedBy)
    {
        $this->ticketAssignedBy = $ticketAssignedBy;
    
        return $this;
    }

    /**
     * Get ticketAssignedBy
     *
     * @return integer 
     */
    public function getTicketAssignedBy()
    {
        return $this->ticketAssignedBy;
    }

    /**
     * Set ticketSpendTime
     *
     * @param float $ticketSpendTime
     * @return SpidTickets
     */
    public function setTicketSpendTime($ticketSpendTime)
    {
        $this->ticketSpendTime = $ticketSpendTime;
    
        return $this;
    }

    /**
     * Get ticketSpendTime
     *
     * @return float 
     */
    public function getTicketSpendTime()
    {
        return $this->ticketSpendTime;
    }

    /**
     * Set creationDate
     *
     * @param integer $creationDate
     * @return SpidTickets
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
     * @return SpidTickets
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
     * Set closedDate
     *
     * @param integer $closedDate
     * @return SpidTickets
     */
    public function setClosedDate($closedDate)
    {
        $this->closedDate = $closedDate;
    
        return $this;
    }

    /**
     * Get closedDate
     *
     * @return integer 
     */
    public function getClosedDate()
    {
        return $this->closedDate;
    }

    /**
     * Set dueDate
     *
     * @param integer $dueDate
     * @return SpidTickets
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    
        return $this;
    }

    /**
     * Get dueDate
     *
     * @return integer 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set ticketClosed
     *
     * @param integer $ticketClosed
     * @return SpidTickets
     */
    public function setTicketClosed($ticketClosed)
    {
        $this->ticketClosed = $ticketClosed;
    
        return $this;
    }

    /**
     * Get ticketClosed
     *
     * @return integer 
     */
    public function getTicketClosed()
    {
        return $this->ticketClosed;
    }

    /**
     * Set ticketInvoice
     *
     * @param integer $ticketInvoice
     * @return SpidTickets
     */
    public function setTicketInvoice($ticketInvoice)
    {
        $this->ticketInvoice = $ticketInvoice;
    
        return $this;
    }

    /**
     * Get ticketInvoice
     *
     * @return integer 
     */
    public function getTicketInvoice()
    {
        return $this->ticketInvoice;
    }

    /**
     * Set locationId
     *
     * @param integer $locationId
     * @return SpidTickets
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    
        return $this;
    }

    /**
     * Get locationId
     *
     * @return integer 
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Set locationPrecision
     *
     * @param string $locationPrecision
     * @return SpidTickets
     */
    public function setLocationPrecision($locationPrecision)
    {
        $this->locationPrecision = $locationPrecision;
    
        return $this;
    }

    /**
     * Get locationPrecision
     *
     * @return string 
     */
    public function getLocationPrecision()
    {
        return $this->locationPrecision;
    }

    /**
     * Set ticketPrivate
     *
     * @param integer $ticketPrivate
     * @return SpidTickets
     */
    public function setTicketPrivate($ticketPrivate)
    {
        $this->ticketPrivate = $ticketPrivate;
    
        return $this;
    }

    /**
     * Get ticketPrivate
     *
     * @return integer 
     */
    public function getTicketPrivate()
    {
        return $this->ticketPrivate;
    }

    /**
     * Set ticketBudget
     *
     * @param float $ticketBudget
     * @return SpidTickets
     */
    public function setTicketBudget($ticketBudget)
    {
        $this->ticketBudget = $ticketBudget;
    
        return $this;
    }

    /**
     * Get ticketBudget
     *
     * @return float 
     */
    public function getTicketBudget()
    {
        return $this->ticketBudget;
    }

    /**
     * Set contractId
     *
     * @param integer $contractId
     * @return SpidTickets
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    
        return $this;
    }

    /**
     * Get contractId
     *
     * @return integer 
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * Set ticketUnitTime
     *
     * @param integer $ticketUnitTime
     * @return SpidTickets
     */
    public function setTicketUnitTime($ticketUnitTime)
    {
        $this->ticketUnitTime = $ticketUnitTime;
    
        return $this;
    }

    /**
     * Get ticketUnitTime
     *
     * @return integer 
     */
    public function getTicketUnitTime()
    {
        return $this->ticketUnitTime;
    }

    /**
     * Set ticketNbStudent
     *
     * @param integer $ticketNbStudent
     * @return SpidTickets
     */
    public function setTicketNbStudent($ticketNbStudent)
    {
        $this->ticketNbStudent = $ticketNbStudent;
    
        return $this;
    }

    /**
     * Get ticketNbStudent
     *
     * @return integer 
     */
    public function getTicketNbStudent()
    {
        return $this->ticketNbStudent;
    }

    /**
     * Set ticketPriceStudent
     *
     * @param float $ticketPriceStudent
     * @return SpidTickets
     */
    public function setTicketPriceStudent($ticketPriceStudent)
    {
        $this->ticketPriceStudent = $ticketPriceStudent;
    
        return $this;
    }

    /**
     * Get ticketPriceStudent
     *
     * @return float 
     */
    public function getTicketPriceStudent()
    {
        return $this->ticketPriceStudent;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return SpidTickets
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    
        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set ticketAssignedByContact
     *
     * @param integer $ticketAssignedByContact
     * @return SpidTickets
     */
    public function setTicketAssignedByContact($ticketAssignedByContact)
    {
        $this->ticketAssignedByContact = $ticketAssignedByContact;
    
        return $this;
    }

    /**
     * Get ticketAssignedByContact
     *
     * @return integer 
     */
    public function getTicketAssignedByContact()
    {
        return $this->ticketAssignedByContact;
    }

    /**
     * Set ticketClientOrder
     *
     * @param string $ticketClientOrder
     * @return SpidTickets
     */
    public function setTicketClientOrder($ticketClientOrder)
    {
        $this->ticketClientOrder = $ticketClientOrder;
    
        return $this;
    }

    /**
     * Get ticketClientOrder
     *
     * @return string 
     */
    public function getTicketClientOrder()
    {
        return $this->ticketClientOrder;
    }

    /**
     * Set ticketClientOrderId
     *
     * @param string $ticketClientOrderId
     * @return SpidTickets
     */
    public function setTicketClientOrderId($ticketClientOrderId)
    {
        $this->ticketClientOrderId = $ticketClientOrderId;
    
        return $this;
    }

    /**
     * Get ticketClientOrderId
     *
     * @return string 
     */
    public function getTicketClientOrderId()
    {
        return $this->ticketClientOrderId;
    }

    /**
     * Set ticketProvOrderId
     *
     * @param string $ticketProvOrderId
     * @return SpidTickets
     */
    public function setTicketProvOrderId($ticketProvOrderId)
    {
        $this->ticketProvOrderId = $ticketProvOrderId;
    
        return $this;
    }

    /**
     * Get ticketProvOrderId
     *
     * @return string 
     */
    public function getTicketProvOrderId()
    {
        return $this->ticketProvOrderId;
    }

    /**
     * Set ticketProvProId
     *
     * @param string $ticketProvProId
     * @return SpidTickets
     */
    public function setTicketProvProId($ticketProvProId)
    {
        $this->ticketProvProId = $ticketProvProId;
    
        return $this;
    }

    /**
     * Get ticketProvProId
     *
     * @return string 
     */
    public function getTicketProvProId()
    {
        return $this->ticketProvProId;
    }

    /**
     * Set ticketSite
     *
     * @param integer $ticketSite
     * @return SpidTickets
     */
    public function setTicketSite($ticketSite)
    {
        $this->ticketSite = $ticketSite;
    
        return $this;
    }

    /**
     * Get ticketSite
     *
     * @return integer 
     */
    public function getTicketSite()
    {
        return $this->ticketSite;
    }
}
