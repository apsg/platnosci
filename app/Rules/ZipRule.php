<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ZipRule implements Rule
{
    public function passes($attribute, $value)
    {
        if (preg_match('/^\d{5}|\d{2}-\d{3}$/', $value)) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return "Podaj prawidłowy kod pocztowy";
    }
}
