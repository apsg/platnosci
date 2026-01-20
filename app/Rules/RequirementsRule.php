<?php
namespace App\Rules;

use App\Domains\Integrations\Access\AccessProvider;
use App\Domains\Sales\Models\Sale;
use Illuminate\Contracts\Validation\Rule;

class RequirementsRule implements Rule
{
    protected Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function passes($attribute, $value): bool
    {
        if ($this->sale->requirements == 0) {
            return true;
        }

        $checkResult = AccessProvider::make($this->sale->requirements_provider)
            ->checkUser($value);

        if ($checkResult->status() === 404) {
            return false;
        }

        $data = json_decode($checkResult->body(), true);

        if (!is_array($data)) {
            return false;
        }

        if ($this->sale->requirements == 2 && $data['has_full_access'] == false) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        if ($this->sale->requirements == 1) {
            return 'Musisz posiadać konto w serwisie';
        }

        if ($this->sale->requirements == 2) {
            return 'Musisz posiadać konto z aktywnym pełnym dostępem w serwisie';
        }

        return '';
    }
}
