<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class VideoAssert extends Constraint
{
    public $messageLien = 'Le lien {{ value }} n\'est pas valide.';
    public $messageVideo = 'La video {{ value }} n\'existe pas ou n\'est pas accessible';
}