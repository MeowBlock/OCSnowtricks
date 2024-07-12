<?php

namespace App\Validator;

use App\Entity\Trick;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TrickValidator extends ConstraintValidator
{
    public function validate($trick, Constraint $constraint)
    {
        if (!$constraint instanceof TrickAssert) {
            throw new UnexpectedTypeException($constraint, TrickValidator::class);
        }
        if (!$trick instanceof Trick) {
            throw new UnexpectedTypeException($trick, Trick::class);
        }

        $name = $trick->getName();


        if (null === $name || '' === $name) {
            return;
        }

        /**
         * @var TrickAssert $constraint
         */
        // if($response->getStatusCode() != 200) {
        //     $this->context->buildViolation($constraint->messageVideo)
        //         ->setParameter('{{ value }}', $url)
        //         ->addViolation();
        // }
    }
}