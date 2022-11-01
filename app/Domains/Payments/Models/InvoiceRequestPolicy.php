<?php
namespace App\Domains\Payments\Models;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoiceRequestPolicy
{
    use HandlesAuthorization;

    public function view(User $user, InvoiceRequest $invoiceRequest): bool
    {
        return $invoiceRequest->order->sale->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, InvoiceRequest $invoiceRequest): bool
    {
        return $invoiceRequest->order->sale->user_id === $user->id;
    }

    public function delete(User $user, InvoiceRequest $invoiceRequest): bool
    {
        return $invoiceRequest->order->sale->user_id === $user->id;
    }

    public function restore(User $user, InvoiceRequest $invoiceRequest): bool
    {
        return $invoiceRequest->order->sale->user_id === $user->id;
    }

    public function forceDelete(User $user, InvoiceRequest $invoiceRequest): bool
    {
        return $invoiceRequest->order->sale->user_id === $user->id;
    }
}
