<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TrickAssert extends Constraint
{
    public $messageUnique = 'Un trick du nom de {{ value }} existe déjà';
}