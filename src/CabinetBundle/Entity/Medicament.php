<?php


namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Medicament
{
    /** @var  integer */
    private $id;
    /** @var  string */
    private $code;
    /** @var  string */
    private $nom;
    /** @var  Prescription[]|ArrayCollection */
    private $prescriptions;

    /**
     * Medicament constructor.
     * @param Prescription[]|ArrayCollection $prescriptions
     */
    public function __construct($prescriptions)
    {
        $this->prescriptions = new ArrayCollection();
    }


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
