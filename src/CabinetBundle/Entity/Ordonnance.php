<?php

namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Ordonnance
{
    /** @var  integer */
    private $id;
    /** @var  string */
    private $description;
    /** @var  string */
    private $conge;
    /** @var  Consultation */
    private $consultation;
    /** @var  Prescription[]|ArrayCollection */
    private $prescriptions;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }





    /**
     * @return string
     */
    public function getConge()
    {
        return $this->conge;
    }

    /**
     * @param string $conge
     */
    public function setConge($conge)
    {
        $this->conge = $conge;
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
     * @return Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * @param Consultation $consultation
     */
    public function setConsultation($consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * @return Prescription[]|ArrayCollection
     */
    public function getPrescriptions()
    {
        return $this->prescriptions;
    }

    /**
     * @param Prescription[]|ArrayCollection $prescriptions
     */
    public function setPrescriptions($prescriptions)
    {
        $this->prescriptions = $prescriptions;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prescriptions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prescriptions
     *
     * @param \CabinetBundle\Entity\Prescription $prescription
     * @return Ordonnance
     */
    public function addPrescription(\CabinetBundle\Entity\Prescription $prescriptions)
    {
        $this->prescriptions[] = $prescriptions;

        return $this;
    }

    /**
     * Remove prescriptions
     *
     * @param \CabinetBundle\Entity\Prescription $prescriptions
     */
    public function removePrescription(\CabinetBundle\Entity\Prescription $prescriptions)
    {
        $this->prescriptions->removeElement($prescriptions);
    }
}
