<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NipRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value) : bool
    {
        if (!preg_match('/^\d{10}$/', $value)) {
            return false;
        }

        return $this->checksum((string)$value);
    }

    public function message() : string
    {
        return 'Nieprawidłowy numer NIP';
    }

    protected function checksum(string $value) : bool
    {
        $digits = str_split($value);
        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $digits[$i] * $weights[$i];
        }

        return ($sum % 11) === (int)$digits[9];
    }
}
