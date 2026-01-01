<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginAsUserController extends Controller
{
    public function login($data)
    {
        $decryptedData = Crypt::decrypt($data);

        $validDate = Carbon::createFromTimestamp($decryptedData['valid_to']);

        if ($validDate->isPast()) {
            return 'Outdated';
        }

        $user = User::findOrFail($decryptedData['id']);
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
