<?php

namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class SecuriteSocial
{
    public static function getTypes()
    {
        return [
            'tier-payant' => 'Tier-payant',
            'remboursement' => 'Remboursement',
            'publique' => 'Publique',
            'sans filiare' => 'Sans filiare'
        ];
    }
    /** @var  integer */
    private $id;
    /** @var  \DateTime */
    private $dateExpiration;
    /** @var  string */
    private $type;
    /** @var  Patient[]|ArrayCollection */
    private $patients;
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    /**
     * @param \DateTime $dateExpiration
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * Constructor
     */
    public function __construct()
    {
        $this->patients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patients
     *
     * @param \CabinetBundle\Entity\Patient $patients
     * @return SecuriteSocial
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
