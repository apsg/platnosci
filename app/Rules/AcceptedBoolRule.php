<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AcceptedBoolRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return (bool)$value === true;
    }

    public function message()
    {
        return 'Wymagana akceptacja';
    }
}
