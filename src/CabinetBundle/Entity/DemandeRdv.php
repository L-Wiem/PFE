<?php

namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Time;
use UserBundle\Entity\MobileUser;

class DemandeRdv
{
    /** @var  integer */
    private $id;
    /** @var  \DateTime */
    private $dateRdv;
    /** @var  Time */
    private $heureRdv;
    /** @var  string */
    private $preferences;
    /** @var  Patient */
    private $patient;

    /** @var  boolean */
    private $confirmee;

    /**
     * DemandeRdv constructor.
     */
    public function __construct()
    {
        $this->confirmee = false;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**
     * @param \DateTime $dateRdv
     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;
    }

    /**
     * @return \DateTime
     */
    public function getHeureRdv()
    {
        return $this->heureRdv;
    }

    /**
     * @param \DateTime $heureRdv
     */
    public function setHeureRdv($heureRdv)
    {
        $this->heureRdv = $heureRdv;
    }

    /**
     * @return string
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param string $preferences
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * @return Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param Patient $patient
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;
    }

    /**
     * @return boolean
     */
    public function isConfirmee()
    {
        return $this->confirmee;
    }

    /**
     * @param boolean $confirmee
     */
    public function setConfirmee($confirmee)
    {
        $this->confirmee = $confirmee;
    }

}