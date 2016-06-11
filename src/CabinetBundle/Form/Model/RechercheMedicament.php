<?php


namespace CabinetBundle\Form\Model;


class RechercheMedicament
{
    /** @var  string */
    public $nom;

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
    
}