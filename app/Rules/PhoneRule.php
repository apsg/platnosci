<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value) : bool
    {
        if (!preg_match('/\+\d{11}|\d{9}/', str_replace([' ', '-'], '', $value))) {
            return false;
        }

        return true;
    }

    public function message() : string
    {
        return 'Nieprawidłowy numer telefonu';
    }
}
