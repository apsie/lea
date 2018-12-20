<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\EgwCategories
 *
 * @ORM\Table(name="egw_categories")
 * @ORM\Entity
 */
class EgwCategories
{
    /**
     * @var integer $catId
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catId;

    /**
     * @var integer $catMain
     *
     * @ORM\Column(name="cat_main", type="integer", nullable=false)
     */
    private $catMain;

    /**
     * @var integer $catParent
     *
     * @ORM\Column(name="cat_parent", type="integer", nullable=false)
     */
    private $catParent;

    /**
     * @var integer $catLevel
     *
     * @ORM\Column(name="cat_level", type="smallint", nullable=false)
     */
    private $catLevel;

    /**
     * @var string $catOwner
     *
     * @ORM\Column(name="cat_owner", type="string", length=255, nullable=false)
     */
    private $catOwner;

    /**
     * @var string $catAccess
     *
     * @ORM\Column(name="cat_access", type="string", length=7, nullable=true)
     */
    private $catAccess;

    /**
     * @var string $catAppname
     *
     * @ORM\Column(name="cat_appname", type="string", length=50, nullable=false)
     */
    private $catAppname;

    /**
     * @var string $catName
     *
     * @ORM\Column(name="cat_name", type="string", length=150, nullable=false)
     */
    private $catName;

    /**
     * @var string $catDescription
     *
     * @ORM\Column(name="cat_description", type="string", length=255, nullable=false)
     */
    private $catDescription;

    /**
     * @var string $catData
     *
     * @ORM\Column(name="cat_data", type="text", nullable=true)
     */
    private $catData;

    /**
     * @var integer $lastMod
     *
     * @ORM\Column(name="last_mod", type="bigint", nullable=false)
     */
    private $lastMod;



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
     * Set catMain
     *
     * @param integer $catMain
     * @return EgwCategories
     */
    public function setCatMain($catMain)
    {
        $this->catMain = $catMain;
    
        return $this;
    }

    /**
     * Get catMain
     *
     * @return integer 
     */
    public function getCatMain()
    {
        return $this->catMain;
    }

    /**
     * Set catParent
     *
     * @param integer $catParent
     * @return EgwCategories
     */
    public function setCatParent($catParent)
    {
        $this->catParent = $catParent;
    
        return $this;
    }

    /**
     * Get catParent
     *
     * @return integer 
     */
    public function getCatParent()
    {
        return $this->catParent;
    }

    /**
     * Set catLevel
     *
     * @param integer $catLevel
     * @return EgwCategories
     */
    public function setCatLevel($catLevel)
    {
        $this->catLevel = $catLevel;
    
        return $this;
    }

    /**
     * Get catLevel
     *
     * @return integer 
     */
    public function getCatLevel()
    {
        return $this->catLevel;
    }

    /**
     * Set catOwner
     *
     * @param string $catOwner
     * @return EgwCategories
     */
    public function setCatOwner($catOwner)
    {
        $this->catOwner = $catOwner;
    
        return $this;
    }

    /**
     * Get catOwner
     *
     * @return string 
     */
    public function getCatOwner()
    {
        return $this->catOwner;
    }

    /**
     * Set catAccess
     *
     * @param string $catAccess
     * @return EgwCategories
     */
    public function setCatAccess($catAccess)
    {
        $this->catAccess = $catAccess;
    
        return $this;
    }

    /**
     * Get catAccess
     *
     * @return string 
     */
    public function getCatAccess()
    {
        return $this->catAccess;
    }

    /**
     * Set catAppname
     *
     * @param string $catAppname
     * @return EgwCategories
     */
    public function setCatAppname($catAppname)
    {
        $this->catAppname = $catAppname;
    
        return $this;
    }

    /**
     * Get catAppname
     *
     * @return string 
     */
    public function getCatAppname()
    {
        return $this->catAppname;
    }

    /**
     * Set catName
     *
     * @param string $catName
     * @return EgwCategories
     */
    public function setCatName($catName)
    {
        $this->catName = $catName;
    
        return $this;
    }

    /**
     * Get catName
     *
     * @return string 
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * Set catDescription
     *
     * @param string $catDescription
     * @return EgwCategories
     */
    public function setCatDescription($catDescription)
    {
        $this->catDescription = $catDescription;
    
        return $this;
    }

    /**
     * Get catDescription
     *
     * @return string 
     */
    public function getCatDescription()
    {
        return $this->catDescription;
    }

    /**
     * Set catData
     *
     * @param string $catData
     * @return EgwCategories
     */
    public function setCatData($catData)
    {
        $this->catData = $catData;
    
        return $this;
    }

    /**
     * Get catData
     *
     * @return string 
     */
    public function getCatData()
    {
        return $this->catData;
    }

    /**
     * Set lastMod
     *
     * @param integer $lastMod
     * @return EgwCategories
     */
    public function setLastMod($lastMod)
    {
        $this->lastMod = $lastMod;
    
        return $this;
    }

    /**
     * Get lastMod
     *
     * @return integer 
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }
}