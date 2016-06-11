<?php


namespace CabinetBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HeureRDV extends Constraint
{
    public $message = 'Des autre RDV sont ajoutees dans le meme plage horaires +/-20 minutes';
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}