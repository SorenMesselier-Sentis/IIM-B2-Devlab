<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InsultValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $fileContent = file_get_contents(__DIR__ . '/../../data/insulte.txt');
        $words = explode("\r\n", $fileContent);

        if ($this->contains($value, $words)) {
            $this->context->buildViolation(Insult::INSULT_ERROR)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function contains($string, $array): bool
    {
        $stripedString = str_ireplace($array, '', $string);
        return strlen($stripedString) !== strlen($string);
    }
}