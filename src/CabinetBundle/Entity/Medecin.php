<?php

namespace CabinetBundle\Entity;


use UserBundle\Entity\User;

class Medecin extends Personne
{
    /** @var  string */
    private $matricule;
    /** @var User */
    private $user;
    /**
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param string $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    
}
