<?php

namespace CabinetBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Consultation
{
    /** @var  integer */
    private $id;
    /** @var  string */
    private $motif;
    /** @var  Patient */
    private $patient;
    /** @var  Ordonnance */
    private $ordonnance;
    /** @var  ExamenClinique[]|ArrayCollection */
    private $examensCliniques;
    /** @var  Analyse[]|ArrayCollection */
    private $analyses;
    /** @var  Rdv */
    private $rdv;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param string $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
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
     * @return ExamenClinique[]|ArrayCollection
     */
    public function getExamensCliniques()
    {
        return $this->examensCliniques;
    }

    /**
     * @param ExamenClinique[]|ArrayCollection $examensCliniques
     */
    public function setExamensCliniques($examensCliniques)
    {
        $this->examensCliniques = $examensCliniques;
    }



    /**
     * @return Analyse[]|ArrayCollection
     */
    public function getAnalyses()
    {
        return $this->analyses;
    }

    /**
     * @param Analyse[]|ArrayCollection $analyses
     */
    public function setAnalyses($analyses)
    {
        $this->analyses = $analyses;
    }

    /**
     * @return Rdv
     */
    public function getRdv()
    {
        return $this->rdv;
    }

    /**
     * @param Rdv $rdv
     */
    public function setRdv($rdv)
    {
        $this->rdv = $rdv;
    }
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examensCliniques = new \Doctrine\Common\Collections\ArrayCollection();
        $this->analyses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add examensCliniques
     *
     * @param \CabinetBundle\Entity\ExamenClinique $examensCliniques
     * @return Consultation
     */
    public function addExamenClinique(\CabinetBundle\Entity\ExamenClinique $examensCliniques)
    {
        $this->examensCliniques[] = $examensCliniques;

        return $this;
    }

    /**
     * Remove examensCliniques
     *
     * @param \CabinetBundle\Entity\ExamenClinique $examensCliniques
     */
    public function removeExamenClinique(\CabinetBundle\Entity\ExamenClinique $examensCliniques)
    {
        $this->$examensCliniques->removeElement($examensCliniques);
    }

    /**
     * Add analyses
     *
     * @param \CabinetBundle\Entity\Analyse $analyses
     * @return Consultation
     */
    public function addAnalysis(\CabinetBundle\Entity\Analyse $analyses)
    {
        $this->analyses[] = $analyses;

        return $this;
    }

    /**
     * Remove analyses
     *
     * @param \CabinetBundle\Entity\Analyse $analyses
     */
    public function removeAnalysis(\CabinetBundle\Entity\Analyse $analyses)
    {
        $this->analyses->removeElement($analyses);
    }
}
