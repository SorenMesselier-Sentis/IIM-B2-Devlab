<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class Insult extends Constraint
{
    public const INSULT_ERROR = 'This field contains offensive terms: {{ value }}';

    public function getDefaultOption(): ?string
    {
        return 'type';
    }
}