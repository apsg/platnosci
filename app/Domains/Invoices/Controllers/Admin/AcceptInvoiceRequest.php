<?php
namespace App\Domains\Invoices\Controllers\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AcceptInvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('invoice'));
    }
}
