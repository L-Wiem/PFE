<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 29/03/2016
 * Time: 10:54
 */

namespace CabinetBundle\Entity;


use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Rdv
{
    const  RDV_HEURE_MIN = 9;
    const  RDV_HEURE_MAX = 18;
    /** @var  integer */
    private $id;
    /** @var  Patient */
    private $patient;
    /** @var  \DateTime */
    private $date;
    /** @var  string */
    private $heure;
    /** @var  string */
    private $preferences;
    /** @var  Secretaire */
    private $creePar;
    /** @var  Consultation */
    private $consultation;
    

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * @return Secretaire
     */
    public function getCreePar()
    {
        return $this->creePar;
    }

    /**
     * @param Secretaire $creePar
     */
    public function setCreePar($creePar)
    {
        $this->creePar = $creePar;
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
     * @return \DateTime
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param \DateTime $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
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
     * @return string
     */
    public function getPreference()
    {
        return $this->preferences;
    }

    /**
     * @param string $preference
     */
    public function setPreference($preference)
    {
        $this->preferences = $preference;
    }

    public function validerHeure(ExecutionContextInterface $context)
    {
        if ($this->getHeure()) {
            $heureRDV = (int)$this->getHeure()->format("H");
            $date = new \DateTime("now");
            if ($heureRDV < self::RDV_HEURE_MIN || $heureRDV > self::RDV_HEURE_MAX) {
                $context->buildViolation('Heure de RDV doit etre entre ' . self::RDV_HEURE_MIN . ' et ' . self::RDV_HEURE_MAX)
                    ->atPath('heure')
                    ->addViolation();
            } elseif($date->format('d/m/Y') == $this->getDate()->format('d/m/Y')) {
                $minuteRDV = (int)$this->getHeure()->format("i");
                $heureNow = $date->format("H");
                $minuteNow = $date->format("i");

                if (($heureRDV < $heureNow) || ($heureRDV == $heureNow && $minuteRDV < $minuteNow)) {
                    $context->buildViolation('Heure RDV invalid')->atPath('heure')->addViolation();
                }

            }
        }
    }
}
