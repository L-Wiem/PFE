<?php

namespace CabinetBundle\Validator\Constraints;


use CabinetBundle\Entity\Rdv;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HeureRDVValidator extends ConstraintValidator
{
    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param Rdv $rdv
     * @param Constraint $constraint
     */
    public function validate($rdv, Constraint $constraint)
    {
        /** @var Rdv $dernierRDV */
        $derniersRDV = $this->doctrine->getRepository('CabinetBundle:Rdv')->chercherRDV($rdv->getDate(), $rdv->getHeure());
        if (count($derniersRDV)) {
            $this->context->buildViolation($constraint->message)->addViolation();
            /** @var Rdv $rdv */
            foreach ($derniersRDV as $rdv) {
                $message = 'Rendez-vous existant a: ' . $rdv->getHeure()->format("H:i");
                $this->context->buildViolation($message)->addViolation();
            }
        }

    }

}