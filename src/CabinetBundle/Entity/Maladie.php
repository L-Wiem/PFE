<?php

namespace CabinetBundle\Entity;


class Maladie
{
    /** @var  integer */
    private $id;
    /** @var  string */
    private $nom;
    /** @var  string */
    private $symptome;
    /** @var  string */
    private $stade;
    /** @var  \DateTime */
    private $datePrescription;
    /** @var  Patient */
    private $patient;

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
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getSymptome()
    {
        return $this->symptome;
    }

    /**
     * @param string $symptome
     */
    public function setSymptome($symptome)
    {
        $this->symptome = $symptome;
    }

    /**
     * @return string
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * @param string $stade
     */
    public function setStade($stade)
    {
        $this->stade = $stade;
    }

    /**
     * @return \DateTime
     */
    public function getDatePrescription()
    {
        return $this->datePrescription;
    }

    /**
     * @param \DateTime $datePrescription
     */
    public function setDatePrescription($datePrescription)
    {
        $this->datePrescription = $datePrescription;
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

    

}
