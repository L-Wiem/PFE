<?php

namespace CabinetBundle\Entity;


class Prescription
{
    /** @var  integer */
    private $id;
    /** @var  integer */
    private $quantite;
    /** @var  string */
    private $duree;
    /** @var  Ordonnance */
    private $ordonnance;
    /** @var  Medicament  */
    private $medicament;

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
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param string $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }
    
    /**
     * @return Ordonnance
     */
    public function getOrdonnance()
    {
        return $this->ordonnance;
    }

    /**
     * @param Ordonnance $ordonnance
     */
    public function setOrdonnance($ordonnance)
    {
        $this->ordonnance = $ordonnance;
    }

    /**
     * @return Medicament
     */
    public function getMedicament()
    {
        return $this->medicament;
    }

    /**
     * @param Medicament $medicament
     */
    public function setMedicament($medicament)
    {
        $this->medicament = $medicament;
    }

    
    
}
