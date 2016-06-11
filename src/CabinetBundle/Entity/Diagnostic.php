<?php

namespace CabinetBundle\Entity;


class Diagnostic
{
    /** @var  integer */
    private $id;
    /** @var  string */
    private $symptome;
    /** @var  string */
    private $stade;
    /** @var  \DateTime */
    private $dateDiagnostic;

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
    public function getDateDiagnostic()
    {
        return $this->dateDiagnostic;
    }

    /**
     * @param \DateTime $dateDiagnostic
     */
    public function setDateDiagnostic($dateDiagnostic)
    {
        $this->dateDiagnostic = $dateDiagnostic;
    }

    
}