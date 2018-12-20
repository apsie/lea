<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Lea\PrestaBundle\Entity\EgwPrestation
 *
 * @ORM\Table(name="egw_prestation")
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\EgwPrestationRepository")
 */
class EgwPrestation
{
    /**
     * @var integer $idPresta
     *
     * @ORM\Column(name="id_presta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPresta;

    /**
     * @var integer $idProjet
     *
     * @ORM\Column(name="id_projet", type="bigint", nullable=false)
     */
    private $idProjet;

    /**
     * @var integer $idBen
     *
     * @ORM\Column(name="id_ben", type="bigint", nullable=false)
     */
    private $idBen;

    /**
     * @var integer $idRef
     *
     * @ORM\Column(name="id_ref", type="bigint", nullable=false)
     */
    private $idRef;

    /**
     * @var integer $idContactPrescripteur
     *
     * @ORM\Column(name="id_contact_prescripteur", type="bigint", nullable=false)
     */
    private $idContactPrescripteur;

    /**
     * @var integer $idPrestataire
     *
     * @ORM\Column(name="id_prestataire", type="integer", nullable=false)
     */
    private $idPrestataire;


    /**
     * @var string $intitule
     *
     * @ORM\Column(name="intitule", type="string", length=60, nullable=false)
     */
    private $intitule;

    /**
     * @var string $lettreDeCommande
     *
     * @ORM\Column(name="lettre_de_commande", type="string", length=60, nullable=false)
     */
    private $lettreDeCommande;

    /**
     * @var integer $dateDebut
     *
     * @ORM\Column(name="date_debut", type="bigint", nullable=false)
     */
    private $dateDebut;

    /**
     * @var integer $dateFin
     *
     * @ORM\Column(name="date_fin", type="bigint", nullable=false)
     */
    private $dateFin;

    /**
     * @var integer $dateFinReelle
     *
     * @ORM\Column(name="date_fin_reelle", type="bigint", nullable=false)
     */
    private $dateFinReelle;

    /**
     * @var integer $dateEnvoiBilan
     *
     * @ORM\Column(name="date_envoi_bilan", type="bigint", nullable=false)
     */
    private $dateEnvoiBilan;

    /**
     * @var string $numeroFacturation
     *
     * @ORM\Column(name="numero_facturation", type="string", length=64, nullable=false)
     */
    private $numeroFacturation;

    /**
     * @var integer $dateFacturation
     *
     * @ORM\Column(name="date_facturation", type="bigint", nullable=false)
     */
    private $dateFacturation;

    /**
     * @var string $statut
     *
     * @ORM\Column(name="statut", type="string", length=60, nullable=false)
     */
    private $statut;

    /**
	* @ORM\OneToMany(targetEntity="EgwCalUser", mappedBy="idPrestation")
	*/
	protected $egwCalIdPrestation;
	public function __construct()
	{
	$this->egwCalIdPrestation = new ArrayCollection();
	}
    
	/**
	* @ORM\ManyToOne(targetEntity="EgwDispositif", inversedBy="prestations")
	* @ORM\JoinColumn(name="id_dispositif", referencedColumnName="id_dispositif")
	*/
    private $dispositif;
    
  	/**
	* @ORM\ManyToOne(targetEntity="Spiclient", inversedBy="prestations")
	* @ORM\JoinColumn(name="id_prestataire", referencedColumnName="client_id")
	*/
    private $prestataire;
    

    
    /**
	* @ORM\ManyToOne(targetEntity="EgwAccounts", inversedBy="prestations")
	* @ORM\JoinColumn(name="id_ref", referencedColumnName="account_id")
	*/
    private $account;
    
    /**
	* @ORM\ManyToOne(targetEntity="EgwContact", inversedBy="prestations")
	* @ORM\JoinColumn(name="id_ben", referencedColumnName="id_ben")
	*/
    private $contact;
    



    /**
	* @ORM\ManyToOne(targetEntity="EgwAddressbook", inversedBy="prestationsP")
	* @ORM\JoinColumn(name="id_contact_prescripteur", referencedColumnName="contact_id")
	*/
    private $contactP;
    
    /**
	* @ORM\ManyToOne(targetEntity="EgwProjet", inversedBy="prestations")
	* @ORM\JoinColumn(name="id_projet", referencedColumnName="id_projet")
	*/
    private $projet;

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
     * Set idProjet
     *
     * @param integer $idProjet
     * @return EgwPrestation
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    
        return $this;
    }

    /**
     * Get idProjet
     *
     * @return integer 
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set idBen
     *
     * @param integer $idBen
     * @return EgwPrestation
     */
    public function setIdBen($idBen)
    {
        $this->idBen = $idBen;
    
        return $this;
    }

    /**
     * Get idBen
     *
     * @return integer 
     */
    public function getIdBen()
    {
        return $this->idBen;
    }

    /**
     * Set idRef
     *
     * @param integer $idRef
     * @return EgwPrestation
     */
    public function setIdRef($idRef)
    {
        $this->idRef = $idRef;
    
        return $this;
    }

    /**
     * Get idRef
     *
     * @return integer 
     */
    public function getIdRef()
    {
        return $this->idRef;
    }

    /**
     * Set idContactPrescripteur
     *
     * @param integer $idContactPrescripteur
     * @return EgwPrestation
     */
    public function setIdContactPrescripteur($idContactPrescripteur)
    {
        $this->idContactPrescripteur = $idContactPrescripteur;
    
        return $this;
    }

    /**
     * Get idContactPrescripteur
     *
     * @return integer 
     */
    public function getIdContactPrescripteur()
    {
        return $this->idContactPrescripteur;
    }

    /**
     * Set idPrestataire
     *
     * @param integer $idPrestataire
     * @return EgwPrestation
     */
    public function setIdPrestataire($idPrestataire)
    {
        $this->idPrestataire = $idPrestataire;
    
        return $this;
    }

    /**
     * Get idPrestataire
     *
     * @return integer 
     */
    public function getIdPrestataire()
    {
        return $this->idPrestataire;
    }

  
    /**
     * Set intitule
     *
     * @param string $intitule
     * @return EgwPrestation
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set lettreDeCommande
     *
     * @param string $lettreDeCommande
     * @return EgwPrestation
     */
    public function setLettreDeCommande($lettreDeCommande)
    {
        $this->lettreDeCommande = $lettreDeCommande;
    
        return $this;
    }

    /**
     * Get lettreDeCommande
     *
     * @return string 
     */
    public function getLettreDeCommande()
    {
        return $this->lettreDeCommande;
    }

    /**
     * Set dateDebut
     *
     * @param integer $dateDebut
     * @return EgwPrestation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return integer 
     */
    public function getDateDebut()
    {
    	if($this->dateDebut>0)
    	    return date('d/m/Y',$this->dateDebut);
    	else
    	    return "";
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param integer $dateFin
     * @return EgwPrestation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return integer 
     */
    public function getDateFin()
    {
      if($this->dateFin>0)
    	return date('d/m/Y',$this->dateFin);
    	else
    	return "";
        return $this->datedateFin;
    }

    /**
     * Set dateFinReelle
     *
     * @param integer $dateFinReelle
     * @return EgwPrestation
     */
    public function setDateFinReelle($dateFinReelle)
    {
        $this->dateFinReelle = $dateFinReelle;
    
        return $this;
    }

    /**
     * Get dateFinReelle
     *
     * @return integer 
     */
    public function getDateFinReelle()
    {
        if($this->dateFinReelle>0)
    	return date('d/m/Y',$this->dateFinReelle);
    	else
    	return "";
        return $this->dateFinReelle;
    }

    /**
     * Set dateEnvoiBilan
     *
     * @param integer $dateEnvoiBilan
     * @return EgwPrestation
     */
    public function setDateEnvoiBilan($dateEnvoiBilan)
    {
        $this->dateEnvoiBilan = $dateEnvoiBilan;
    
        return $this;
    }

    /**
     * Get dateEnvoiBilan
     *
     * @return integer 
     */
    public function getDateEnvoiBilan()
    {
        if($this->dateEnvoiBilan>0)
    	return date('d/m/Y',$this->dateEnvoiBilan);
    	else
    	return "";
        return $this->dateEnvoiBilan;
    }

    /**
     * Set numeroFacturation
     *
     * @param string $numeroFacturation
     * @return EgwPrestation
     */
    public function setNumeroFacturation($numeroFacturation)
    {
        $this->numeroFacturation = $numeroFacturation;
    
        return $this;
    }

    /**
     * Get numeroFacturation
     *
     * @return string 
     */
    public function getNumeroFacturation()
    {
        return $this->numeroFacturation;
    }

    /**
     * Set dateFacturation
     *
     * @param integer $dateFacturation
     * @return EgwPrestation
     */
    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;
    
        return $this;
    }

    /**
     * Get dateFacturation
     *
     * @return integer 
     */
    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return EgwPrestation
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add egwCalIdPrestation
     *
     * @param Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdPrestation
     * @return EgwPrestation
     */
    public function addEgwCalIdPrestation(\Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdPrestation)
    {
        $this->egwCalIdPrestation[] = $egwCalIdPrestation;
    
        return $this;
    }

    /**
     * Remove egwCalIdPrestation
     *
     * @param Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdPrestation
     */
    public function removeEgwCalIdPrestation(\Lea\PrestaBundle\Entity\EgwCalUser $egwCalIdPrestation)
    {
        $this->egwCalIdPrestation->removeElement($egwCalIdPrestation);
    }

    /**
     * Get egwCalIdPrestation
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEgwCalIdPrestation()
    {
        return $this->egwCalIdPrestation;
    }

    /**
     * Set prestataire
     *
     * @param Lea\PrestaBundle\Entity\Spiclient $prestataire
     * @return EgwPrestation
     */
    public function setPrestataire(\Lea\PrestaBundle\Entity\Spiclient $prestataire = null)
    {
        $this->prestataire = $prestataire;
    
        return $this;
    }

    /**
     * Get prestataire
     *
     * @return Lea\PrestaBundle\Entity\Spiclient 
     */
    public function getPrestataire()
    {
        return $this->prestataire;
    }

   

    /**
     * Set account
     *
     * @param Lea\PrestaBundle\Entity\EgwAccounts $account
     * @return EgwPrestation
     */
    public function setAccount(\Lea\PrestaBundle\Entity\EgwAccounts $account = null)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return Lea\PrestaBundle\Entity\EgwAccounts 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set contact
     *
     * @param Lea\PrestaBundle\Entity\EgwContact $contact
     * @return EgwPrestation
     */
    public function setContact(\Lea\PrestaBundle\Entity\EgwContact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return Lea\PrestaBundle\Entity\EgwContact 
     */
    public function getContact()
    {
        return $this->contact;
    }


    /**
     * Set contactP
     *
     * @param Lea\PrestaBundle\Entity\EgwAddressbook $contactP
     * @return EgwPrestation
     */
    public function setContactP(\Lea\PrestaBundle\Entity\EgwAddressbook $contactP = null)
    {
        $this->contactP = $contactP;
    
        return $this;
    }

    /**
     * Get contactP
     *
     * @return Lea\PrestaBundle\Entity\EgwAddressbook 
     */
    public function getContactP()
    {
        return $this->contactP;
    }

    /**
     * Set dispositif
     *
     * @param Lea\PrestaBundle\Entity\EgwDispositif $dispositif
     * @return EgwPrestation
     */
    public function setDispositif(\Lea\PrestaBundle\Entity\EgwDispositif $dispositif = null)
    {
        $this->dispositif = $dispositif;
    
        return $this;
    }

    /**
     * Get dispositif
     *
     * @return Lea\PrestaBundle\Entity\EgwDispositif 
     */
    public function getDispositif()
    {
        return $this->dispositif;
    }

    /**
     * Set projet
     *
     * @param Lea\PrestaBundle\Entity\EgwProjet $projet
     * @return EgwPrestation
     */
    public function setProjet(\Lea\PrestaBundle\Entity\EgwProjet $projet = null)
    {
        $this->projet = $projet;
    
        return $this;
    }

    /**
     * Get projet
     *
     * @return Lea\PrestaBundle\Entity\EgwProjet 
     */
    public function getProjet()
    {
        return $this->projet;
    }
}