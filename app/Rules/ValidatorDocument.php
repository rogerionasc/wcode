<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use ParadiseSessions\Validator\Cpf;

class ValidatorDocument implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(empty($value)) {
            $fail('O CPF não deve ser vazio!');
            return;
        }

        $document = new Cpf($value);

        if (!$document->isValid()) {
            $fail('O CPF deve ser válido!');
        }
    }
}
