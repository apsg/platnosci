<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InvoiceProviderRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return in_array($value, array_keys(config('invoice.providers')));
    }

    public function message(): string
    {
        return "Invalid invoice provider";
    }
}
