<?php
namespace App\Domains\Payments\Controllers\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
        ];
    }
}
