<?php

namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use UserBundle\Entity\MobileUser;

class Patient extends Personne
{
    /** @var  string */
    private $code;
    /** @var  Secretaire */
    private $creePar;
    /** @var  SecuriteSocial[] | ArrayCollection */
    private $securiteSocials;
    /** @var  Consultation[] | ArrayCollection */
    private $consultations;
    /** @var  Rdv[] | ArrayCollection */
    private $rdvs;
    /** @var  Maladie[] | ArrayCollection */
    private $maladies;
    /** @var  Antecedent[] | ArrayCollection */
    private $antecedents;
    /** @var  MobileUser */
    private $mobileUser;
    /** @var  DemandeRdv[] | ArrayCollection */
    private $demandesRdvs;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return Secretaire
     */
    public function getCreePar()
    {
        return $this->creePar;
    }

    /**
     * @param Secretaire $creePar
     */
    public function setCreePar($creePar)
    {
        $this->creePar = $creePar;
    }

    /**
     * @return SecuriteSocial[]|ArrayCollection
     */
    public function getSecuriteSocials()
    {
        return $this->securiteSocials;
    }

    /**
     * @param SecuriteSocial[]|ArrayCollection $securiteSocials
     */
    public function setSecuriteSocials($securiteSocials)
    {
        $this->securiteSocials = $securiteSocials;
    }

    public function ajouterSecuriteSocial($securiteSocial)
    {
        if (!$this->getSecuriteSocials()->contains($securiteSocial)) {
            $this->securiteSocials->add($securiteSocial);
        }

    }


    /**
     * @return Consultation[]|ArrayCollection
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    /**
     * @param Consultation[]|ArrayCollection $consultations
     */
    public function setConsultations($consultations)
    {
        $this->consultations = $consultations;
    }

    /**
     * @return Rdv[]|ArrayCollection
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }

    /**
     * @param Rdv[]|ArrayCollection $rdvs
     */
    public function setRdvs($rdvs)
    {
        $this->rdvs = $rdvs;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rdvs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add consultations
     *
     * @param \CabinetBundle\Entity\Consultation $consultations
     * @return Patient
     */
    public function addConsultation(\CabinetBundle\Entity\Consultation $consultations)
    {
        $this->consultations[] = $consultations;

        return $this;
    }

    /**
     * Remove consultations
     *
     * @param \CabinetBundle\Entity\Consultation $consultations
     */
    public function removeConsultation(\CabinetBundle\Entity\Consultation $consultations)
    {
        $this->consultations->removeElement($consultations);
    }

    /**
     * Add rdvs
     *
     * @param \CabinetBundle\Entity\Rdv $rdvs
     * @return Patient
     */
    public function addRdv(\CabinetBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs[] = $rdvs;

        return $this;
    }

    /**
     * Remove rdvs
     *
     * @param \CabinetBundle\Entity\Rdv $rdvs
     */
    public function removeRdv(\CabinetBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs->removeElement($rdvs);
    }

    /**
     * @return Maladie[]|ArrayCollection
     */
    public function getMaladies()
    {
        return $this->maladies;
    }

    /**
     * @param Maladie[]|ArrayCollection $maladies
     */
    public function setMaladies($maladies)
    {
        $this->maladies = $maladies;
    }

    /**
     * @return Antecedent[]|ArrayCollection
     */
    public function getAntecedents()
    {
        return $this->antecedents;
    }

    /**
     * @param Antecedent[]|ArrayCollection $antecedents
     */
    public function setAntecedents($antecedents)
    {
        $this->antecedents = $antecedents;
    }

    /**
     * @return MobileUser
     */
    public function getMobileUser()
    {
        return $this->mobileUser;
    }

    /**
     * @param MobileUser $mobileUser
     */
    public function setMobileUser($mobileUser)
    {
        $this->mobileUser = $mobileUser;
    }

    /**
     * @return \CabinetBundle\Entity\DemandeRdv[]|ArrayCollection
     */
    public function getDemandesRdvs()
    {
        return $this->demandesRdvs;
    }

    /**
     * @param \CabinetBundle\Entity\DemandeRdv[]|ArrayCollection $demandesRdvs
     */
    public function setDemandesRdvs($demandesRdvs)
    {
        $this->demandesRdvs = $demandesRdvs;
    }

    /**
     * Add rdvs
     *
     * @param \CabinetBundle\Entity\Rdv $rdvs
     * @return Patient
     */
    public function addDemandeRDV(DemandeRdv $demandeRdv)
    {
        $this->demandesRdvs->add($demandeRdv);
        $demandeRdv->setPatient($this);
    }

}
