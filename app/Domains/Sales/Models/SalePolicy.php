<?php
namespace App\Domains\Sales\Models;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Sale $sale): bool
    {
        return $sale->user_id == $user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Sale $sale): bool
    {
        return $sale->user_id == $user->id;
    }

    public function delete(User $user, Sale $sale): bool
    {
        return $sale->user_id == $user->id;
    }

    public function restore(User $user, Sale $sale): bool
    {
        return $sale->user_id == $user->id;
    }

    public function forceDelete(User $user, Sale $sale): bool
    {
        return $sale->user_id == $user->id;
    }
}
