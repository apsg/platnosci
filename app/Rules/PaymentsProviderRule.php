<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PaymentsProviderRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return in_array($value, array_keys(config('payments')));
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}
