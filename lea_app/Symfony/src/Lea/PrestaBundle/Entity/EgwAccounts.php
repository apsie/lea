<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwAccounts
 *
 * @ORM\Table(name="egw_accounts")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwAccountsRepository")
 */
class EgwAccounts
{
    /**
     * @var integer $accountId
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="EgwAddressbook", cascade={"persist", "merge", "remove"})
	 * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     */
    private $accountId;

    /**
     * @var string $accountLid
     *
     * @ORM\Column(name="account_lid", type="string", length=64, nullable=false)
     */
    private $accountLid;

    /**
     * @var string $accountPwd
     *
     * @ORM\Column(name="account_pwd", type="string", length=128, nullable=false)
     */
    private $accountPwd;

    /**
     * @var integer $accountLastlogin
     *
     * @ORM\Column(name="account_lastlogin", type="integer", nullable=true)
     */
    private $accountLastlogin;

    /**
     * @var string $accountLastloginfrom
     *
     * @ORM\Column(name="account_lastloginfrom", type="string", length=255, nullable=true)
     */
    private $accountLastloginfrom;

    /**
     * @var integer $accountLastpwdChange
     *
     * @ORM\Column(name="account_lastpwd_change", type="integer", nullable=true)
     */
    private $accountLastpwdChange;

    /**
     * @var string $accountStatus
     *
     * @ORM\Column(name="account_status", type="string", length=1, nullable=false)
     */
    private $accountStatus;

    /**
     * @var integer $accountExpires
     *
     * @ORM\Column(name="account_expires", type="integer", nullable=true)
     */
    private $accountExpires;

    /**
     * @var string $accountType
     *
     * @ORM\Column(name="account_type", type="string", length=1, nullable=true)
     */
    private $accountType;

    /**
     * @var integer $accountPrimaryGroup
     *
     * @ORM\Column(name="account_primary_group", type="integer", nullable=false)
     */
    private $accountPrimaryGroup;

   /**
	* @ORM\OneToMany(targetEntity="EgwPrestation", mappedBy="account")
	*/
	protected $prestations;
	public function __construct()
	{
	$this->prestations = new ArrayCollection();
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
     * Set accountLid
     *
     * @param string $accountLid
     * @return EgwAccounts
     */
    public function setAccountLid($accountLid)
    {
        $this->accountLid = $accountLid;
    
        return $this;
    }

    /**
     * Get accountLid
     *
     * @return string 
     */
    public function getAccountLid()
    {
        return $this->accountLid;
    }

    /**
     * Set accountPwd
     *
     * @param string $accountPwd
     * @return EgwAccounts
     */
    public function setAccountPwd($accountPwd)
    {
        $this->accountPwd = $accountPwd;
    
        return $this;
    }

    /**
     * Get accountPwd
     *
     * @return string 
     */
    public function getAccountPwd()
    {
        return $this->accountPwd;
    }

    /**
     * Set accountLastlogin
     *
     * @param integer $accountLastlogin
     * @return EgwAccounts
     */
    public function setAccountLastlogin($accountLastlogin)
    {
        $this->accountLastlogin = $accountLastlogin;
    
        return $this;
    }

    /**
     * Get accountLastlogin
     *
     * @return integer 
     */
    public function getAccountLastlogin()
    {
        return $this->accountLastlogin;
    }

    /**
     * Set accountLastloginfrom
     *
     * @param string $accountLastloginfrom
     * @return EgwAccounts
     */
    public function setAccountLastloginfrom($accountLastloginfrom)
    {
        $this->accountLastloginfrom = $accountLastloginfrom;
    
        return $this;
    }

    /**
     * Get accountLastloginfrom
     *
     * @return string 
     */
    public function getAccountLastloginfrom()
    {
        return $this->accountLastloginfrom;
    }

    /**
     * Set accountLastpwdChange
     *
     * @param integer $accountLastpwdChange
     * @return EgwAccounts
     */
    public function setAccountLastpwdChange($accountLastpwdChange)
    {
        $this->accountLastpwdChange = $accountLastpwdChange;
    
        return $this;
    }

    /**
     * Get accountLastpwdChange
     *
     * @return integer 
     */
    public function getAccountLastpwdChange()
    {
        return $this->accountLastpwdChange;
    }

    /**
     * Set accountStatus
     *
     * @param string $accountStatus
     * @return EgwAccounts
     */
    public function setAccountStatus($accountStatus)
    {
        $this->accountStatus = $accountStatus;
    
        return $this;
    }

    /**
     * Get accountStatus
     *
     * @return string 
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }

    /**
     * Set accountExpires
     *
     * @param integer $accountExpires
     * @return EgwAccounts
     */
    public function setAccountExpires($accountExpires)
    {
        $this->accountExpires = $accountExpires;
    
        return $this;
    }

    /**
     * Get accountExpires
     *
     * @return integer 
     */
    public function getAccountExpires()
    {
        return $this->accountExpires;
    }

    /**
     * Set accountType
     *
     * @param string $accountType
     * @return EgwAccounts
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
    
        return $this;
    }

    /**
     * Get accountType
     *
     * @return string 
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * Set accountPrimaryGroup
     *
     * @param integer $accountPrimaryGroup
     * @return EgwAccounts
     */
    public function setAccountPrimaryGroup($accountPrimaryGroup)
    {
        $this->accountPrimaryGroup = $accountPrimaryGroup;
    
        return $this;
    }

    /**
     * Get accountPrimaryGroup
     *
     * @return integer 
     */
    public function getAccountPrimaryGroup()
    {
        return $this->accountPrimaryGroup;
    }

    /**
     * Set accountChallenge
     *
     * @param string $accountChallenge
     * @return EgwAccounts
     */
    public function setAccountChallenge($accountChallenge)
    {
        $this->accountChallenge = $accountChallenge;
    
        return $this;
    }

    /**
     * Get accountChallenge
     *
     * @return string 
     */
    public function getAccountChallenge()
    {
        return $this->accountChallenge;
    }

    /**
     * Set accountResponse
     *
     * @param string $accountResponse
     * @return EgwAccounts
     */
    public function setAccountResponse($accountResponse)
    {
        $this->accountResponse = $accountResponse;
    
        return $this;
    }

    /**
     * Get accountResponse
     *
     * @return string 
     */
    public function getAccountResponse()
    {
        return $this->accountResponse;
    }

    /**
     * Set accountIdPrestataire
     *
     * @param integer $accountIdPrestataire
     * @return EgwAccounts
     */
    public function setAccountIdPrestataire($accountIdPrestataire)
    {
        $this->accountIdPrestataire = $accountIdPrestataire;
    
        return $this;
    }

    /**
     * Get accountIdPrestataire
     *
     * @return integer 
     */
    public function getAccountIdPrestataire()
    {
        return $this->accountIdPrestataire;
    }

    /**
     * Set accountId
     *
     * @param Lea\PrestaBundle\Entity\EgwAddressbook $accountId
     * @return EgwAccounts
     */
    public function setAccountId(\Lea\PrestaBundle\Entity\EgwAddressbook $accountId)
    {
        $this->accountId = $accountId;
    
        return $this;
    }

    /**
     * Add prestations
     *
     * @param Lea\PrestaBundle\Entity\EgwPrestation $prestations
     * @return EgwAccounts
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

  
}
