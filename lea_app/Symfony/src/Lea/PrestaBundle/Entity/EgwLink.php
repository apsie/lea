<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwLink
 *
 * @ORM\Table(name="egw_links")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwLinkRepository")
 */
class EgwLink
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="link_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $app1
     *
     * @ORM\Column(name="link_app1", type="integer")
     */
    private $app1;

    /**
     * @var integer $id1
     *
     * @ORM\Column(name="link_id1", type="string", length=50)
     */
    private $id1;

    /**
     * @var integer $app2
     *
     * @ORM\Column(name="link_app2", type="string", length=25)
     */
    private $app2;

    /**
     * @var integer $id2
     *
     * @ORM\Column(name="link_id2", type="string", length=50)
     */
    private $id2;

    /**
     * @var integer $remark
     *
     * @ORM\Column(name="link_remark", type="string", length=25)
     */
    private $remark;

    /**
     * @var integer $lastmod
     *
     * @ORM\Column(name="link_lastmod", type="bigint")
     */
    private $lastmod;

    /**
     * @var integer $owner
     *
     * @ORM\Column(name="link_owner", type="integer")
     */
    private $owner;

    /**
     * @var integer $deleted
     *
     * @ORM\Column(name="deleted", type="integer")
     */
    private $deleted;


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
     * Set app1
     *
     * @param integer $app1
     * @return EgwLink
     */
    public function setApp1($app1)
    {
        $this->app1 = $app1;
    
        return $this;
    }

    /**
     * Get app1
     *
     * @return integer 
     */
    public function getApp1()
    {
        return $this->app1;
    }

    /**
     * Set id1
     *
     * @param integer $id1
     * @return EgwLink
     */
    public function setId1($id1)
    {
        $this->id1 = $id1;
    
        return $this;
    }

    /**
     * Get id1
     *
     * @return integer 
     */
    public function getId1()
    {
        return $this->id1;
    }

    /**
     * Set app2
     *
     * @param integer $app2
     * @return EgwLink
     */
    public function setApp2($app2)
    {
        $this->app2 = $app2;
    
        return $this;
    }

    /**
     * Get app2
     *
     * @return integer 
     */
    public function getApp2()
    {
        return $this->app2;
    }

    /**
     * Set id2
     *
     * @param integer $id2
     * @return EgwLink
     */
    public function setId2($id2)
    {
        $this->id2 = $id2;
    
        return $this;
    }

    /**
     * Get id2
     *
     * @return integer 
     */
    public function getId2()
    {
        return $this->id2;
    }

    /**
     * Set remark
     *
     * @param string $remark
     * @return EgwLink
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    
        return $this;
    }

    /**
     * Get remark
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set lastmod
     *
     * @param integer $lastmod
     * @return EgwLink
     */
    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    
        return $this;
    }

    /**
     * Get lastmod
     *
     * @return integer 
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * Set owner
     *
     * @param integer $owner
     * @return EgwLink
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return integer 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return EgwLink
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}