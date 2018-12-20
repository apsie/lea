<?php

namespace Lea\PrestaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lea\PrestaBundle\Entity\Resacc
 *
 * @ORM\Table(egw_resacc)
 * @ORM\Entity(repositoryClass="Lea\PrestaBundle\Entity\ResaccRepository")
 */
class Resacc
{
    /**
     * @var integer $idResacc
     *
     * @ORM\Column(name="id_resacc", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idResacc;

    /**
     * @var string $raisonSociale
     *
     * @ORM\Column(name="raison_sociale", type="string", length=255)
     */
    private $raisonSociale;

    /**
     * @var string $nomCommercial
     *
     * @ORM\Column(name="nom_commercial", type="string", length=255)
     */
    private $nomCommercial;

    /**
     * @var string $activitePrincipale
     *
     * @ORM\Column(name="activite_principale", type="string", length=255)
     */
    private $activitePrincipale;

    /**
     * @var string $typeEtablissement
     *
     * @ORM\Column(name="type_adresse", type="string", length=255)
     */
    private $typeEtablissement;

    /**
     * @var string $adresseLigne1
     *
     * @ORM\Column(name="adresse_ligne_1", type="string", length=255)
     */
    private $adresseLigne1;

    /**
     * @var string $adresseLigne2
     *
     * @ORM\Column(name="adresse_ligne_2", type="string", length=255)
     */
    private $adresseLigne2;

    /**
     * @var string $adresseLigne3
     *
     * @ORM\Column(name="adresse_ligne_3", type="string", length=255)
     */
    private $adresseLigne3;

    /**
     * @var string $Cp
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $Cp;

    /**
     * @var string $Ville
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $Ville;

    /**
     * @var string $dateImmat
     *
     * @ORM\Column(name="date_immat", type="string", length=255)
     */
    private $dateImmat;

    /**
     * @var string $dateDebutActivite
     *
     * @ORM\Column(name="date_debut_activite", type="string", length=255)
     */
    private $dateDebutActivite;

    /**
     * @var string $formeJuridique
     *
     * @ORM\Column(name="forme_juridique", type="string", length=255)
     */
    private $formeJuridique;

    /**
     * @var string $Siret
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $Siret;

    /**
     * @var string $codeNaf
     *
     * @ORM\Column(name="code_naf", type="string", length=255)
     */
    private $codeNaf;

    /**
     * @var string $secteurActivite
     *
     * @ORM\Column(name="secteur_activite", type="string", length=255)
     */
    private $secteurActivite;

    /**
     * @var string $typeImplantation
     *
     * @ORM\Column(name="implantation", type="string", length=255)
     */
    private $typeImplantation;

    /**
     * @var string $typeImposition
     *
     * @ORM\Column(name="regime_imposition", type="string", length=255)
     */
    private $typeImposition;

    /**
     * @var string $regimeTva
     *
     * @ORM\Column(name="regime_tva", type="string", length=255)
     */
    private $regimeTva;

    /**
     * @var string $regimeFiscal
     *
     * @ORM\Column(name="regime_fiscal", type="string", length=255)
     */
    private $regimeFiscal;

    /**
     * @var string $regimeSocialDirigeant
     *
     * @ORM\Column(name="regime_social_dirigeant", type="string", length=255)
     */
    private $regimeSocialDirigeant;


    /**
     * Get idResacc
     *
     * @return integer 
     */
    public function getIdResacc()
    {
        return $this->idResacc;
    }

    /**
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Resacc
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set nomCommercial
     *
     * @param string $nomCommercial
     * @return Resacc
     */
    public function setNomCommercial($nomCommercial)
    {
        $this->nomCommercial = $nomCommercial;
    
        return $this;
    }

    /**
     * Get nomCommercial
     *
     * @return string 
     */
    public function getNomCommercial()
    {
        return $this->nomCommercial;
    }

    /**
     * Set activitePrincipale
     *
     * @param string $activitePrincipale
     * @return Resacc
     */
    public function setActivitePrincipale($activitePrincipale)
    {
        $this->activitePrincipale = $activitePrincipale;
    
        return $this;
    }

    /**
     * Get activitePrincipale
     *
     * @return string 
     */
    public function getActivitePrincipale()
    {
        return $this->activitePrincipale;
    }

    /**
     * Set typeEtablissement
     *
     * @param string $typeEtablissement
     * @return Resacc
     */
    public function setTypeEtablissement($typeEtablissement)
    {
        $this->typeEtablissement = $typeEtablissement;
    
        return $this;
    }

    /**
     * Get typeEtablissement
     *
     * @return string 
     */
    public function getTypeEtablissement()
    {
        return $this->typeEtablissement;
    }

    /**
     * Set adresseLigne1
     *
     * @param string $adresseLigne1
     * @return Resacc
     */
    public function setAdresseLigne1($adresseLigne1)
    {
        $this->adresseLigne1 = $adresseLigne1;
    
        return $this;
    }

    /**
     * Get adresseLigne1
     *
     * @return string 
     */
    public function getAdresseLigne1()
    {
        return $this->adresseLigne1;
    }

    /**
     * Set adresseLigne2
     *
     * @param string $adresseLigne2
     * @return Resacc
     */
    public function setAdresseLigne2($adresseLigne2)
    {
        $this->adresseLigne2 = $adresseLigne2;
    
        return $this;
    }

    /**
     * Get adresseLigne2
     *
     * @return string 
     */
    public function getAdresseLigne2()
    {
        return $this->adresseLigne2;
    }

    /**
     * Set adresseLigne3
     *
     * @param string $adresseLigne3
     * @return Resacc
     */
    public function setAdresseLigne3($adresseLigne3)
    {
        $this->adresseLigne3 = $adresseLigne3;
    
        return $this;
    }

    /**
     * Get adresseLigne3
     *
     * @return string 
     */
    public function getAdresseLigne3()
    {
        return $this->adresseLigne3;
    }

    /**
     * Set Cp
     *
     * @param string $cp
     * @return Resacc
     */
    public function setCp($cp)
    {
        $this->Cp = $cp;
    
        return $this;
    }

    /**
     * Get Cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->Cp;
    }

    /**
     * Set Ville
     *
     * @param string $ville
     * @return Resacc
     */
    public function setVille($ville)
    {
        $this->Ville = $ville;
    
        return $this;
    }

    /**
     * Get Ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->Ville;
    }

    /**
     * Set dateImmat
     *
     * @param string $dateImmat
     * @return Resacc
     */
    public function setDateImmat($dateImmat)
    {
        $this->dateImmat = $dateImmat;
    
        return $this;
    }

    /**
     * Get dateImmat
     *
     * @return string 
     */
    public function getDateImmat()
    {
        return $this->dateImmat;
    }

    /**
     * Set dateDebutActivite
     *
     * @param string $dateDebutActivite
     * @return Resacc
     */
    public function setDateDebutActivite($dateDebutActivite)
    {
        $this->dateDebutActivite = $dateDebutActivite;
    
        return $this;
    }

    /**
     * Get dateDebutActivite
     *
     * @return string 
     */
    public function getDateDebutActivite()
    {
        return $this->dateDebutActivite;
    }

    /**
     * Set formeJuridique
     *
     * @param string $formeJuridique
     * @return Resacc
     */
    public function setFormeJuridique($formeJuridique)
    {
        $this->formeJuridique = $formeJuridique;
    
        return $this;
    }

    /**
     * Get formeJuridique
     *
     * @return string 
     */
    public function getFormeJuridique()
    {
        return $this->formeJuridique;
    }

    /**
     * Set Siret
     *
     * @param string $siret
     * @return Resacc
     */
    public function setSiret($siret)
    {
        $this->Siret = $siret;
    
        return $this;
    }

    /**
     * Get Siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set codeNaf
     *
     * @param string $codeNaf
     * @return Resacc
     */
    public function setCodeNaf($codeNaf)
    {
        $this->codeNaf = $codeNaf;
    
        return $this;
    }

    /**
     * Get codeNaf
     *
     * @return string 
     */
    public function getCodeNaf()
    {
        return $this->codeNaf;
    }

    /**
     * Set secteurActivite
     *
     * @param string $secteurActivite
     * @return Resacc
     */
    public function setSecteurActivite($secteurActivite)
    {
        $this->secteurActivite = $secteurActivite;
    
        return $this;
    }

    /**
     * Get secteurActivite
     *
     * @return string 
     */
    public function getSecteurActivite()
    {
        return $this->secteurActivite;
    }

    /**
     * Set typeImplantation
     *
     * @param string $typeImplantation
     * @return Resacc
     */
    public function setTypeImplantation($typeImplantation)
    {
        $this->typeImplantation = $typeImplantation;
    
        return $this;
    }

    /**
     * Get typeImplantation
     *
     * @return string 
     */
    public function getTypeImplantation()
    {
        return $this->typeImplantation;
    }

    /**
     * Set typeImposition
     *
     * @param string $typeImposition
     * @return Resacc
     */
    public function setTypeImposition($typeImposition)
    {
        $this->typeImposition = $typeImposition;
    
        return $this;
    }

    /**
     * Get typeImposition
     *
     * @return string 
     */
    public function getTypeImposition()
    {
        return $this->typeImposition;
    }

    /**
     * Set regimeFiscal
     *
     * @param string $regimeFiscal
     * @return Resacc
     */
    public function setRegimeFiscal($regimeFiscal)
    {
        $this->regimeFiscal = $regimeFiscal;
    
        return $this;
    }

    /**
     * Get regimeFiscal
     *
     * @return string 
     */
    public function getRegimeFiscal()
    {
        return $this->regimeFiscal;
    }

    /**
     * Set regimeTva
     *
     * @param string $regimeTva
     * @return Resacc
     */
    public function setRegimeTva($regimeTva)
    {
        $this->regimeTva = $regimeTva;
    
        return $this;
    }

    /**
     * Get regimeTva
     *
     * @return string 
     */
    public function getRegimeTva()
    {
        return $this->regimeTva;
    }

    /**
     * Set regimeSocialDirigeant
     *
     * @param string $regimeSocialDirigeant
     * @return Resacc
     */
    public function setRegimeSocialDirigeant($regimeSocialDirigeant)
    {
        $this->regimeSocialDirigeant = $regimeSocialDirigeant;
    
        return $this;
    }

    /**
     * Get regimeSocialDirigeant
     *
     * @return string 
     */
    public function getRegimeSocialDirigeant()
    {
        return $this->regimeSocialDirigeant;
    }
}
