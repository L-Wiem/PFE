<?php

namespace CabinetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;
use UserBundle\Entity\User;

class Secretaire extends Personne
{
    
    /** @var  string */
    private $cin;
    /** @var  string */
    private $numContrat;
    /** @var  Date */
    private $dateDebContrat;
    /** @var  Date */
    private $dateFinContrat;
    /** @var  Rdv[]|ArrayCollection*/
    private $rdvs;
    /** @var  Patient[]|ArrayCollection */
    private $patients;
    /** @var  User */
    private $user;
    
    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }
    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getNumContrat()
    {
        return $this->numContrat;
    }

    /**
     * @param string $numContrat
     */
    public function setNumContrat($numContrat)
    {
        $this->numContrat = $numContrat;
    }

    /**
     * @return mixed
     */
    public function getDateDebContrat()
    {
        return $this->dateDebContrat;
    }

    /**
     * @param mixed $dateDebContrat
     */
    public function setDateDebContrat($dateDebContrat)
    {
        $this->dateDebContrat = $dateDebContrat;
    }

    /**
     * @return mixed
     */
    public function getDateFinContrat()
    {
        return $this->dateFinContrat;
    }

    /**
     * @param mixed $dateFinContrat
     */
    public function setDateFinContrat($dateFinContrat)
    {
        $this->dateFinContrat = $dateFinContrat;
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
     * @return Patient[]|ArrayCollection
     */
    public function getPatients()
    {
        return $this->patients;
    }

    /**
     * @param Patient[]|ArrayCollection $patients
     */
    public function setPatients($patients)
    {
        $this->patients = $patients;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rdvs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->patients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rdvs
     *
     * @param \CabinetBundle\Entity\Rdv $rdvs
     * @return Secretaire
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
     * Add patients
     *
     * @param \CabinetBundle\Entity\Patient $patients
     * @return Secretaire
     */
    public function addPatient(\CabinetBundle\Entity\Patient $patients)
    {
        $this->patients[] = $patients;

        return $this;
    }

    /**
     * Remove patients
     *
     * @param \CabinetBundle\Entity\Patient $patients
     */
    public function removePatient(\CabinetBundle\Entity\Patient $patients)
    {
        $this->patients->removeElement($patients);
    }
}
